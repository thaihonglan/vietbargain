<?php

use yii\grid\GridView;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseStringHelper;
use app\models\Comment;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 comment-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			Comment list
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">
				<?php echo $this->render('_search', ['model' => $searchModel, 'type' => $type, 'is_approved' => $is_approved ]); ?>

				<?=
					GridView::widget([
						'dataProvider' => $dataProvider,
						'columns' => [
							'user.FullName',
							[
								'attribute' => 'user.type',
								'value' => function($model) {
									return User::getTypeOptions(ArrayHelper::getValue($model, 'user.type'));
								},
							],
							'post.title:ntext',
							[
								'attribute' => 'content',
								'value' => function($model) {
									return  BaseStringHelper::truncate($model->content, 100);
								}
							],

							[
								'attribute' => 'status',
								'value' => function($model) {
									return Comment::getStatusOptions($model->is_approved);
								},
							],
							[
								'attribute' => 'create_datetime',
								'format' => ['date', 'php:d-m-Y h:i']
							],

							[
								'class' => 'yii\grid\ActionColumn',
								'template' => '{view}',
								'buttons' => [
									'view' => function($url, $model) {
										return '<a href="' . $url . '"><button type="button" class="btn btn-primary">'. Yii::t('admin', 'View') .'</button></a>';
									},
								],
							],
						],
					]);
				?>
			</div>
			<!-- /.table-responsive -->
		</div>
	</div>
</div>
<!-- /.col-lg-12 -->