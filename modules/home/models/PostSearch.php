<?php

namespace app\modules\home\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Post;
use app\models\PostType;

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
			[['pt', 'dt'], 'integer'],
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
		$query = Post::find()->joinWith('user');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params, '') && $this->validate())) {
			return $dataProvider;
		}

		if ($this->pt) {
			$postTypeOptions = PostType::findAllAsFiliation($this->pt);
			$postTypeIds = array_unique($this->_getPostTypeIdFromFiliation($postTypeOptions));

			$query->joinWith('postType')->andFilterWhere(['post_type.id' => $postTypeIds]);
		} elseif ($this->dt) {
			$query->andFilterWhere(['deal_type' => $this->dt]);
		}

		return $dataProvider;
	}

	/**
	 *
	 * @param array
	 */
	private function _getPostTypeIdFromFiliation($items)
	{
		$return = [];
		foreach ($items as $item) {
			if ($item->is_parent) {
				$return = array_merge($return, $this->_getPostTypeIdFromFiliation($item->children));
			}
			$return[] = $item->id;
		}
		return $return;
	}
}
