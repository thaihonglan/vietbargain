<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<div class="post">
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic', 'id' => 'login-form']]); ?>
		<div class="postinfotop">
			<h2><?php echo Yii::t('home', 'Login'); ?></h2>
		</div>

		<div class="login-panel panel panel-default">
			<div class="panel-body">
				<fieldset>
					<?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>

					<?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('home', 'Password')]) ?>
					<!-- Change this to a button or input when using this as a form -->
					<a href="javascript:void(0)" class="btn btn-lg btn-success btn-block" onClick="$('form#login-form').submit();">
						<?php echo Yii::t('home', 'Login'); ?></a>
				</fieldset>

				<?= Html::a(Yii::t('home', 'Forget password?'), ['recover-password']) ?>
			</div>
		</div>

	<?php ActiveForm::end(); ?>

</div>