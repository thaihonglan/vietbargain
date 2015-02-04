<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider app\modules\home\models\PostSearch */

$this->title = Yii::t('home', 'Home');
?>

<?php foreach ($dataProvider->getModels() as $model): ?>
<!-- POST -->
<div class="post">
	<div class="wrap-ut pull-left">
		<div class="userinfo pull-left">
			<div class="avatar">
				<img src="<?= Yii::$app->params['userImagePath']['icon'] . (($model->user->avatar) ? $model->user->avatar : Yii::$app->params['userNoImage']) ?>" alt="" height="37" width="37" />
				<div class="status green">&nbsp;</div>
			</div>
		</div>
		<div class="posttext pull-left">
			<h2><?= Html::a($model->title, ['topic/view', 'p' => $model->id]) ?></h2>
			<p><?= $model->short_content ?></p>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="postinfo pull-left">
		<div class="comments">
			<div class="commentbg">
				<?= $model->comment_number ?>
				<div class="mark"></div>
			</div>

		</div>
		<div class="views"><i class="fa fa-eye"></i> <?= $model->view_number ?></div>
		<div class="time"><i class="fa fa-clock-o"></i> <?= $model->create_datetime ?></div>
	</div>
	<div class="clearfix"></div>
</div><!-- POST -->
<?php endforeach; ?>