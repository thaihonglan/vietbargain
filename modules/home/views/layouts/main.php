<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use app\modules\home\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body<?php if ($this->context->id == 'topic'): ?> class="topic"<?php endif; ?>>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-56823696-1', 'auto');
ga('send', 'pageview');

</script>
<?php $this->beginBody() ?>
	<div class="container-fluid">

		<!-- Slider -->
		<div class="tp-banner-container">
			<div class="tp-banner" >
				<ul>
					<!-- SLIDE  -->
<!--                     <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > -->
						<!-- MAIN IMAGE -->
						<p style="text-align:center"><img src="/home/images/deal_banner.jpg" alt="slidebg1"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat"></p>
						<!-- LAYERS -->
<!--                     </li> -->
				</ul>
			</div>
		</div>
		<!-- //Slider -->

		<div class="headernav">
			<div class="container">
				<div class="row">
					<div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><?= Html::a(Html::img('/home/images/logo.jpg'), '/') ?></div>
					<div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
						<div class="dropdown">
							<a data-toggle="dropdown" href="#" >
								<?= (isset($this->context->data['currentPostTypeName'])) ? $this->context->data['currentPostTypeName'] : 'All'?>
							</a>
							<b class="caret"></b>
							<ul class="dropdown-menu" role="menu">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="<?= Url::to(['topic/show']) ?>" style="padding-left: 20px;">All</a></li>
<?php
function _processLoopPostType($items, $level = 1)
{
	foreach ($items as $item):
		if ($item->is_parent):
?>
	<li role="presentation"><a role="menuitem" href="<?= Url::to(['topic/show', 'pt' => $item->id]) ?>" style="padding-left: <?= $level * 20 ?>px;"><?= $item->name ?></a></li>
	<?php _processLoopPostType($item->children, $level + 1) ?>
<?php
		else:
?>
	<li role="presentation"><a role="menuitem" href="<?= Url::to(['topic/show', 'pt' => $item->id]) ?>" style="padding-left: <?= $level * 20 ?>px;"><?= $item->name ?></a></li>
<?php
		endif;
	endforeach;
}
?>
							<?php _processLoopPostType($this->context->data['postType']) ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
						<div class="wrap">
							<form action="#" method="post" class="form">
								<div class="pull-left txt"><input type="text" placeholder=<?php echo Yii::t('model', 'Search Topics'); ?> class="form-control"> </div>
								<div class="pull-right"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
					<div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
						<div class="stnt pull-left">
							<a href="<?= Url::to(['/topic/new']) ?>">
								<button class="btn btn-primary"><?php echo Yii::t('model','Start New Topic'); ?></button>
							</a>
						</div>
						<div class="env pull-left"><i class="fa fa-envelope"></i></div>

						<div class="avatar pull-left dropdown">
							<a data-toggle="dropdown" href="javascript:void(0)" title="<?= (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->first_name : '' ?>">
								<img src="<?= Yii::$app->params['userImagePath']['icon'] . (((!Yii::$app->user->isGuest) && Yii::$app->user->identity->avatar) ? Yii::$app->user->identity->avatar : Yii::$app->params['postNoImage']) ?>" alt="" height="37" width="37" />
							</a> <b class="caret"></b>
							<div class="status green">&nbsp;</div>
							<?php
								echo Nav::widget([
									'options' => ['class' => 'dropdown-menu', 'role' => 'menu'],
									'items' => (!Yii::$app->user->isGuest)
										? [
											['label' => Yii::t('model', 'My Profile'), 'url' => ['/account/edit-profile'], 'options' => ['role' => 'menuitem', 'tabindex' => '-1'], 'linkOptions' => ['role' => 'menuitem']],
											['label' => Yii::t('model', 'My posts'), 'url' => ['/account/show-post'], 'options' => ['role' => 'menuitem', 'tabindex' => '-2'], 'linkOptions' => ['role' => 'menuitem']],
											['label' => Yii::t('model', 'Logout') . ' (' . Yii::$app->user->identity->first_name . ')', 'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post'], 'options' => ['role' => 'menuitem', 'tabindex' => '-3'], 'linkOptions' => ['role' => 'menuitem']],
										]
										: [
											['label' => Yii::t('model', 'Login'), 'url' => ['/auth/login']],
											['label' => Yii::t('model', 'Create account'), 'url' => ['/auth/register']],
										]
									,
								]);
							?>
						</div>

						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container">
				<div class="row">
				<!-- Breadcrumb -->
					<div class="col-lg-8 breadcrumbf">
						<a href="javascript:void(0)">
						<?= $this->title ?>
						</a>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8">
						<?= $content ?>
					</div>
					<div class="col-lg-4 col-md-4">

						<!-- -->
						<div class="sidebarblock">
							<h3><?php echo Yii::t('model', 'Deal types'); ?></h3>
							<div class="divline"></div>
							<div class="blocktxt">
								<ul class="cats">
								<?php foreach ($this->context->data['dealType'] as $dealType): ?>
									<li>
										<a href="<?= Url::to(['topic/show', 'dt' => $dealType->id]) ?>"><?= $dealType->name ?> <!-- <span class="badge pull-right">20</span> --></a>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-1 col-xs-3 col-sm-2 logo "><a href="#"><img src="home/images/logo.jpg" alt=""  /></a></div>
					<div class="col-lg-8 col-xs-9 col-sm-5 ">Copyrights 2014, vietbargain.com</div>
					<div class="col-lg-3 col-xs-12 col-sm-5 sociconcent">
						<ul class="socialicons">
							<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-cloud"></i></a></li>
							<li><a href="#"><i class="fa fa-rss"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
