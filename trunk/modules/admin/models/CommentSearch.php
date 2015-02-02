<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\comment;
use app\models\User;
use app\models\Post;

/**
 * CommentSearch represents the model behind the search form about `app\models\comment`.
 */
class CommentSearch extends comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_approved'], 'integer'],
            [['content', 'create_datetime', 'user_type', 'user_full_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = comment::find()->innerJoinWith(['user', 'post'])
        	->orderBy([
        		'is_approved'    => SORT_ASC, 
        		'create_datetime'=> SORT_DESC
			]);

        $dataProvider = new ActiveDataProvider([
        		'query' => $query,
        		'pagination' => array('pageSize' => 50),
        ]);

        if (!($this->load($params) && $this->validate())) {
        }
        
        //config sort param
        //sort type
        $dataProvider->sort->attributes['user.type'] = [
	        'asc' => ['user.type' => SORT_ASC],
	        'desc' => ['user.type' => SORT_DESC],
        ];
        // sort fullname
        $dataProvider->sort->attributes['user.FullName'] = [
	        'asc' => ['user.last_name' => SORT_ASC],
	        'desc' => ['user.first_name' => SORT_DESC],
        ];
        
        // sort title
        $dataProvider->sort->attributes['post.title'] = [
	        'asc' => ['post.title' => SORT_ASC],
	        'desc' => ['post.title' => SORT_DESC],
        ];
        
        // sort status
        $dataProvider->sort->attributes['status'] = [
	        'asc' => ['commnet.status' => SORT_ASC],
	        'desc' => ['commnet.status' => SORT_DESC],
        ];
        
        
        $dataProvider->query->andWhere(['in', 'user.status', User::STATUS_ACTIVE]);
        $dataProvider->query->andWhere(['in', 'post.status', Post::STATUS_APPROVED]);
        
        if (!isset($params['CommentSearch']['status']) || ($params['CommentSearch']['status'] != Comment::STATUS_BANNER ) ) {
        	$dataProvider->query->andWhere(['<>', 'is_approved',  Comment::STATUS_BANNER] );
        }
        
        $query->andFilterWhere(['like', 'comment.create_datetime', $this->create_datetime])
        ->andFilterWhere(['like', 'comment.content', $this->content])
        ;
        
        $query->andFilterWhere([
            'user.type' => isset($params['CommentSearch']['user_type']) ? $params['CommentSearch']['user_type'] : '' ,
            'is_approved' => $this->is_approved,
        ]);

        $query->andFilterWhere(['like', 'comment.content', $this->content]);
        $query->andFilterWhere(['like', 'comment.create_datetime', $this->create_datetime]);
        return $dataProvider;
    }
}
