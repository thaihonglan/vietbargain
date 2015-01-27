<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'is_owner', 'deal_type', 'status'], 'integer'],
            [['title', 'content', 'contact_number', 'store_address', 'link', 'discount_code', 'image', 'deal_begin_date', 'deal_end_date'], 'safe'],
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
    	// @NOTE tam thoi chua biet quan he the nao cu left join choi toi
    	$query = Post::find()->innerJoinWith(['user', 'postType']);

        $dataProvider = new ActiveDataProvider(
        		[
	        		'query' => $query,
	        		'pagination' => array('pageSize' => 20),
        		]);
       
        // add function sort in grid view
        $dataProvider->sort->attributes['user.email'] = [
        	'asc' => ['user.email' => SORT_ASC],
        	'desc' => ['user.email' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['fullName'] = [
        	'asc' => ['user.first_name' => SORT_ASC],
        	'desc' => ['user.first_name' => SORT_DESC],
        ];
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'deal_type' => $this->deal_type,
            'deal_begin_date' => $this->deal_begin_date,
            'deal_end_date' => $this->deal_end_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'store_address', $this->store_address])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'discount_code', $this->discount_code])
            ->andFilterWhere(['like', 'image', $this->image]);
        
        return $dataProvider;
    }
}
