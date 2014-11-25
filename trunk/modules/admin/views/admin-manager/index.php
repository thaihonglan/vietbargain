<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerAssetBundle('dataTables');

$this->title = Yii::t('app', 'Admins Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
<?= Html::a(Yii::t('app', 'Create {modelClass}', [
	'modelClass' => 'Admin',
]), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Admin list
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [

			'username',
			'first_name',
			'last_name',
			[
				'attribute' => 'has_admin_authority',
				'value' => function($model) {
					return ($model->has_admin_authority == 1) ? Yii::t('app', 'Yes') : '';
				},
			],
			[
			'attribute' => 'has_user_authority',
				'value' => function($model) {
					return ($model->has_user_authority == 1) ? Yii::t('app', 'Yes') : '';
				},
			],
			[
			'attribute' => 'has_deal_authority',
				'value' => function($model) {
					return ($model->has_deal_authority == 1) ? Yii::t('app', 'Yes') : '';
				},
			],
			[
			'attribute' => 'has_dashboard_authority',
				'value' => function($model) {
					return ($model->has_dashboard_authority == 1) ? Yii::t('app', 'Yes') : '';
				},
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'buttons' => [
					'update' => function($url, $model) {
						return '<a href="' . $url . '"><button type="button" class="btn btn-primary">Update</button></a>';
					},
				],
			],
		],
	]); ?>
			</div>
			<!-- /.table-responsive -->
		</div>
	</div>
</div>
<!-- /.col-lg-12 -->

