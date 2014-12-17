<?php

namespace app\modules\home\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    public $pt;
    public $dt;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//             [['pt', 'dt'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function safeAttributes()
    {
        return ['pt', 'dt'];
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
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        if (!($this->load($params, '') && $this->validate())) {
            return $dataProvider;
        }

        if ($this->pt) {

        } elseif ($this->dt) {
            $query->andFilterWhere(['deal_type' => $this->dt]);
        }

        return $dataProvider;
    }
}
