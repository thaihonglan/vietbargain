<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?= Html::a(Yii::t('app', 'Create {modelClass}', [
	'modelClass' => 'User',
]), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="col-lg-12 user-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			User list
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'email:email',
			'facebook_login_id',
			'first_name',
			'last_name',
			'identifier',
			// 'city_id',
			'address',
			'age',
			'contact_number',
			// 'avatar',
			// 'is_power',
			// 'create_datetime',
			// 'status',

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