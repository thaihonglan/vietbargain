<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'City',
]), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="col-lg-12 city-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			City list
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
            'id',
            'name',
		    'code',
		    'zip',

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