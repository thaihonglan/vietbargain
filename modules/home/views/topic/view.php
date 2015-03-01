<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider app\modules\home\models\PostSearch */

$this->title = Yii::t('home', 'View detail: {title}', [
	'title' => $model->title
]);

$commentsProvider->setPagination([
	'pageSize' => 10,
	'pageParam' => 'cm-p',
	'pageSizeParam' => false,
]);

$commentsProvider->prepare();
$pages = $commentsProvider->getPagination();
?>

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
			<h2><?= $model->title ?></h2>
			<p><?= $model->content ?></p>
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

	<?php if (Yii::$app->user->id == $model->user->id): ?>
		<div class="next pull-right">
			<a href="<?= Url::to(['topic/edit', 'p' => Yii::$app->request->get('p')]) ?>">
				<button class="btn btn-primary">Edit post</button>
			</a>
		</div>
	<?php endif; ?>

		<div class="clearfix"></div>
	</div>
</div><!-- POST -->

<div class="paginationf">
<?php if ($pages->getPage() > 0): ?>
	<div class="pull-left"><a href="<?= Url::to(['topic/view', 'p' => Yii::$app->request->get('p'), 'cm-p' => $pages->getPage()]) ?>" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
<?php endif; ?>
	<div class="pull-left">
		<?php echo LinkPager::widget([
			'pagination' => $pages,
			'options' => ['class' => 'paginationforum'],
			'linkOptions' => ['class' => 'item'],
			'prevPageLabel' => false,
			'nextPageLabel' => false,
			'hideOnSinglePage' => false,
		]) ?>
	</div>
<?php if ($pages->getPage() < ($pages->getPageCount() - 1)): ?>
	<div class="pull-left"><a href="<?= Url::to(['topic/view', 'p' => Yii::$app->request->get('p'), 'cm-p' => $pages->getPage() + 2]) ?>" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
<?php endif; ?>
	<div class="clearfix"></div>
</div>

<?php foreach ($commentsProvider->getModels() as $comment): ?>
<!-- POST -->
<div class="post">
	<div class="topwrap">
		<div class="userinfo pull-left">
			<div class="avatar">
				<img src="<?= Yii::$app->params['userImagePath']['icon'] . (($comment->user->avatar) ? $comment->user->avatar : Yii::$app->params['userNoImage']) ?>" alt="" height="37" width="37" />
				<div class="status red">&nbsp;</div>
			</div>
		</div>
		<div class="posttext pull-left">
			<p><?= $comment->content ?></p>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="postinfobot">
		<div class="prev pull-left">
			<a href="#"><i class="fa fa-reply"></i></a>
		</div>

		<div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : <?= Yii::$app->formatter->asDatetime($comment->create_datetime, 'long') ?></div>

		<div class="next pull-right">
<!-- 			<a href="#"><i class="fa fa-share"></i></a> -->

<!-- 			<a href="#"><i class="fa fa-flag"></i></a> -->
		</div>

		<div class="clearfix"></div>
	</div>
</div><!-- POST -->
<?php endforeach; ?>

<?php if ($commentForm): ?>
<!-- POST -->
<div class="post">
	<?php $form = ActiveForm::begin(['action' => 'javascript:void(0)', 'options' => ['id' => 'comment-form', 'class' => 'form'], 'enableClientValidation' => false]); ?>
		<div class="topwrap">
			<div class="userinfo pull-left">
				<div class="avatar">
					<img src="<?= Yii::$app->params['userImagePath']['icon'] . ((Yii::$app->user->identity->avatar) ? Yii::$app->user->identity->avatar : Yii::$app->params['postNoImage']) ?>" alt="" height="37" width="37" />
					<div class="status green">&nbsp;</div>
				</div>
			</div>
			<div class="posttext pull-left">
				<div class="textwraper">
					<div class="postreply">Post a Reply</div>
					<?= $form->field($commentForm, 'content', ['template' => '{input} {error}', 'options' => ['class' => '']])
							->textarea(['placeholder' => 'Type your message here']) ?>
					<?php
						$commentUrl = Url::to(['topic/comment-post']);
						$postId = Yii::$app->request->get('p');
						$js = <<<SCRIPT
$("#comment-form button").click(function() {
	$.post('{$commentUrl}', {
		'postId': $postId,
		'content': $("#commentform-content").val(),
	}).success(function() {
		location.reload();
	});
});
SCRIPT;
						$this->registerJs($js); ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="postinfobot">

			<div class="pull-right postreply">
				<div class="pull-left smile"><a href="javascript:void(0)"><i class="fa fa-smile-o"></i></a></div>
				<div class="pull-left"><button type="button" class="btn btn-primary">Post Reply</button></div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
		</div>
	<?php ActiveForm::end(); ?>
</div><!-- POST -->
<?php endif; ?>

<div class="paginationf">
<?php if ($pages->getPage() > 0): ?>
	<div class="pull-left"><a href="<?= Url::to(['topic/view', 'p' => Yii::$app->request->get('p'), 'cm-p' => $pages->getPage()]) ?>" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
<?php endif; ?>
	<div class="pull-left">
		<?php echo LinkPager::widget([
			'pagination' => $pages,
			'options' => ['class' => 'paginationforum'],
			'linkOptions' => ['class' => 'item'],
			'prevPageLabel' => false,
			'nextPageLabel' => false,
			'hideOnSinglePage' => false,
		]) ?>
	</div>
<?php if ($pages->getPage() < ($pages->getPageCount() - 1)): ?>
	<div class="pull-left"><a href="<?= Url::to(['topic/view', 'p' => Yii::$app->request->get('p'), 'cm-p' => $pages->getPage() + 2]) ?>" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
<?php endif; ?>
	<div class="clearfix"></div>
</div>