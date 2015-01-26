<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'city_id', 'age', 'status', 'type'], 'integer'],
			[['email', 'password', 'facebook_login_id', 'first_name', 'last_name', 'identifier', 'address', 'contact_number', 'avatar', 'create_datetime'], 'safe'],
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
		$query = User::find()->joinWith('city');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		    'pagination' => array('pageSize' => 20),
		]);
		
		$dataProvider->sort->attributes['city.name'] = [
			'asc' => ['city.name' => SORT_ASC],
			'desc' => ['city.name' => SORT_DESC],
		];

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'type' => $this->type,
			'city_id' => $this->city_id,
			'age' => $this->age,
			'create_datetime' => $this->create_datetime,
			'status' => $this->status,
		]);

		$query->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'password', $this->password])
			->andFilterWhere(['like', 'facebook_login_id', $this->facebook_login_id])
			->andFilterWhere(['like', 'first_name', $this->first_name])
			->andFilterWhere(['like', 'last_name', $this->last_name])
			->andFilterWhere(['like', 'identifier', $this->identifier])
			->andFilterWhere(['like', 'address', $this->address])
			->andFilterWhere(['like', 'contact_number', $this->contact_number])
			->andFilterWhere(['like', 'avatar', $this->avatar]);

		return $dataProvider;
	}
}
