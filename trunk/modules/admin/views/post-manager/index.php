<?php

use yii\grid\GridView;
use app\models\Post;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 post-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo Yii::t('admin', 'Post list'); ?>
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">

				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'columns' => [
						'title',
						'user.fullName',
						[
							'attribute' => 'postType',
							'value' => function($model) {
								return implode(', ', ArrayHelper::getColumn($model->postType, 'name'));
							},
						],
						'dealType.name',
						'deal_begin_date',
						'deal_end_date',
						[
							'attribute' => 'status',
							'value' => function($model) {
								return Post::getStatusOptions($model->status);
							},
						],
						'create_datetime',
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
					'rowOptions' => function($model, $key, $index, $grid) {
						switch ($model->status) {
							case Post::STATUS_UNLIKED:
								return ['class' => 'danger'];
							case Post::STATUS_UNAPPROVED:
								return ['class' => 'warning'];
						}
					}
				]); ?>

			</div>
			<!-- /.table-responsive -->
		</div>
	</div>
</div>
<!-- /.col-lg-12 -->