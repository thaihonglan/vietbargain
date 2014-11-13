<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Post',
]), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="col-lg-12 post-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			Post list
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'content:ntext',
            'user_id',
            'contact_number',
            // 'store_address',
            // 'link',
            // 'discount_code',
            // 'is_owner',
            // 'image',
            // 'deal_type',
            // 'deal_begin_date',
            // 'deal_end_date',
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