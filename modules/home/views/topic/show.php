<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider app\modules\home\models\PostSearch */

$this->title = Yii::t('home', 'Home');

$dataProvider->setPagination([
	'pageSize' => 20,
	'pageParam' => 'p-p',
	'pageSizeParam' => false,
]);

$dataProvider->prepare();
$pages = $dataProvider->getPagination();
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

<div class="paginationf">
<?php if ($pages->getPage() > 0): ?>
	<div class="pull-left"><a href="<?= Url::to(['topic/show', 'pt' => Yii::$app->request->get('pt'), 'dt' => Yii::$app->request->get('dt'), 'p-p' => $pages->getPage()]) ?>" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
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
	<div class="pull-left"><a href="<?= Url::to(['topic/show', 'pt' => Yii::$app->request->get('pt'), 'dt' => Yii::$app->request->get('dt'), 'p-p' => $pages->getPage() + 2]) ?>" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
<?php endif; ?>
	<div class="clearfix"></div>
</div>