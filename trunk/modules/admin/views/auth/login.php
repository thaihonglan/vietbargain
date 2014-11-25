<?php
use yii\helpers\Html;
use app\modules\admin\AppAsset;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

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
<body>

<?php $this->beginBody() ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">

						<?php $form = ActiveForm::begin(); ?>

							<fieldset>

								<?= $form->field($model, 'username')->textInput(['placeholder' => 'Username']) ?>

								<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

								<?= $form->field($model, 'rememberMe', ['template' => '<div class="checkbox">{input} {label}</div>'])->checkbox() ?>

								<!-- Change this to a button or input when using this as a form -->
								<a href="javascript:$('form').submit();" class="btn btn-lg btn-success btn-block">Login</a>
							</fieldset>

						<?php ActiveForm::end(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
