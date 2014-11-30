<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Deal Types');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?= Html::a(Yii::t('admin', 'Create {modelClass}', [
	'modelClass' => 'Deal Type',
]), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="col-lg-12 deal-type-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			Deal Type list
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			'name_vi',
			'name_en',

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