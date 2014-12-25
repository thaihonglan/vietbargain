<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8">
		<?php foreach ($dataProvider->getModels() as $post): ?>
			<!-- POST -->
			<div class="post">
				<div class="wrap-ut pull-left">
					<div class="userinfo pull-left">
						<div class="avatar">
							<img src="<?= Yii::$app->params['postImagePath']['icon'] . (($post->user->avatar) ? $post->user->avatar : Yii::$app->params['postNoImage']) ?>" alt="" />
							<div class="status green">&nbsp;</div>
						</div>

						<div class="icons">
<!-- 							<img src="/home/images/icon1.jpg" alt="" /><img src="/home/images/icon4.jpg" alt="" /> -->
						</div>
					</div>
					<div class="posttext pull-left">
						<h2><?= Html::a($post->title, ['topic/view', 'p' => $post->id]) ?></h2>
						<p>It's one thing to subject yourself to a Halloween costume mishap because, hey, that's your prerogative.</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="postinfo pull-left">
					<div class="comments">
						<div class="commentbg">
							560
							<div class="mark"></div>
						</div>

					</div>
					<div class="views"><i class="fa fa-eye"></i> 1,568</div>
					<div class="time"><i class="fa fa-clock-o"></i> 24 min</div>
				</div>
				<div class="clearfix"></div>
			</div><!-- POST -->
		<?php endforeach; ?>
