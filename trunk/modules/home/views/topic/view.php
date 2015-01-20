<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider app\modules\home\models\PostSearch */
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

		<div class="next pull-right">
<!-- 			<a href="#"><i class="fa fa-share"></i></a> -->

<!-- 			<a href="#"><i class="fa fa-flag"></i></a> -->
		</div>

		<div class="clearfix"></div>
	</div>
</div><!-- POST -->

<?php echo LinkPager::widget([
	'pagination' => $pages,
	'options' => ['class' => 'paginationforum'],
	'linkOptions' => ['class' => 'item'],
	'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
	'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
	'nextPageCssClass' => 'prevnext last',
]) ?>

<div class="paginationf">
	<div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
	<div class="pull-left">
		<ul class="paginationforum">
			<li class="hidden-xs"><a href="#">1</a></li>
			<li class="hidden-xs"><a href="#">2</a></li>
			<li class="hidden-xs"><a href="#">3</a></li>
			<li class="hidden-xs"><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">6</a></li>
			<li><a href="#" class="active">7</a></li>
			<li><a href="#">8</a></li>
			<li class="hidden-xs"><a href="#">9</a></li>
			<li class="hidden-xs"><a href="#">10</a></li>
			<li class="hidden-xs hidden-md"><a href="#">11</a></li>
			<li class="hidden-xs hidden-md"><a href="#">12</a></li>
			<li class="hidden-xs hidden-sm hidden-md"><a href="#">13</a></li>
			<li><a href="#">1586</a></li>
		</ul>
	</div>
	<div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
	<div class="clearfix"></div>
</div>

<?php foreach ($comments as $comment): ?>
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
				<div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
				<div class="pull-left"><button type="button" class="btn btn-primary">Post Reply</button></div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
		</div>
	<?php ActiveForm::end(); ?>
</div><!-- POST -->
<?php endif; ?>