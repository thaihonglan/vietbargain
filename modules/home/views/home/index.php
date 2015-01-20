<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<?php foreach ($dataProvider->getModels() as $post): ?>
<!-- POST -->
<div class="post">
	<div class="wrap-ut pull-left">
		<div class="userinfo pull-left">
			<div class="avatar">
				<img src="<?= Yii::$app->params['userImagePath']['icon'] . (($post->user->avatar) ? $post->user->avatar : Yii::$app->params['userNoImage']) ?>" alt="" height="37" width="37" />
				<div class="status green">&nbsp;</div>
			</div>
		</div>
		<div class="posttext pull-left">
			<h2><?= Html::a($post->title, ['topic/view', 'p' => $post->id]) ?></h2>
			<p><?= $post->short_content ?></p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="postinfo pull-left">
		<div class="comments">
			<div class="commentbg">
				<?= $post->comment_number ?>
				<div class="mark"></div>
			</div>

		</div>
		<div class="views"><i class="fa fa-eye"></i> <?= $post->view_number ?></div>
		<div class="time"><i class="fa fa-clock-o"></i> <?= $post->create_datetime ?></div>
	</div>
	<div class="clearfix"></div>
</div><!-- POST -->
<?php endforeach; ?>
