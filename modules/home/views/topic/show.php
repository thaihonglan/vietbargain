<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider app\modules\home\models\PostSearch */
?>

<?php foreach ($dataProvider->getModels() as $model): ?>
<!-- POST -->
<div class="post">
	<div class="topwrap">
		<div class="userinfo pull-left">
			<div class="avatar">
				<img src="<?= Yii::$app->params['userImagePath']['icon'] . (($model->user->avatar) ? $model->user->avatar : Yii::$app->params['userNoImage']) ?>" alt="" height="37" width="37" />
				<div class="status red">&nbsp;</div>
			</div>
		</div>
		<div class="posttext pull-left">
			<h2><?= Html::a($model->title, ['topic/view', 'p' => $model->id]) ?></h2>
			<p><?= $model->short_content ?></p>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="postinfobot">
		<div class="likeblock pull-left">
			<a href="#" class="up"><i class="fa fa-thumbs-o-up"></i><?= $model->like_number ?></a>
			<a href="#" class="down"><i class="fa fa-thumbs-o-down"></i><?= $model->dislike_number ?></a>
		</div>

		<div class="prev pull-left">
			<a href="#"><i class="fa fa-reply"></i></a>
		</div>

		<div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : <?= Yii::$app->formatter->asDatetime($model->create_datetime, 'long') ?></div>

		<div class="next pull-right">
<!-- 			<a href="#"><i class="fa fa-share"></i></a> -->

<!-- 			<a href="#"><i class="fa fa-flag"></i></a> -->
		</div>

		<div class="clearfix"></div>
	</div>
</div><!-- POST -->
<?php endforeach; ?>