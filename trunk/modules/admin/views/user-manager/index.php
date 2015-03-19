<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?php
// 	Html::a(Yii::t('app', 'Create {modelClass}', [
// 	'modelClass' => 'User',
// ]), ['create'], ['class' => 'btn btn-success'])
	?>
</p>

<div class="col-lg-12 user-index">
	<div class="panel panel-default">
		<div class="panel-heading"> Search User</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">
	<?= $this->render('_search', [
			'model' => $model,
		]);
	?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'type',
				'value' => function($model) {
					return User::getTypeOptions($model->type);
				},
			],
			[
				'attribute' => 'status',
				'value' => function($model) {
					return User::getStatusOptions($model->status);
				},
			],
			'email:email',
			'facebook_login_id',
			'first_name',
			'last_name',
			'identifier',
			'city.name',
			'address',
			'age',
			'contact_number',
			[
				'attribute' => 'is_comment_unlimited',
				'value' => function($model) {
					return ($model->is_comment_unlimited == 1) ? Yii::t('app', 'Yes') : '';
				},
			],
			[
				'attribute' => 'create_datetime',
				'format' => ['date', 'php:d-m-Y']
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