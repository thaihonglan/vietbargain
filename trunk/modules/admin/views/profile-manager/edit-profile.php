<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="admin-form">
    <?php  $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'enableClientValidation' => false]); ?>
   		<div class="panel panel-default">
			<div class="panel-heading">
				<?= Yii::t('admin', 'Update Profile');  ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= $form->field($model, 'first_name', ['template' => '{label}<div class="col-sm-3">{input}{error}</div>'])
								->textInput(['placeholder' => 'First name'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>
					</div>
					<div class="col-lg-12">
						<?= $form->field($model, 'last_name', ['template' => '{label}<div class="col-sm-3">{input}{error}</div>'])
								->textInput(['placeholder' => Yii::t('admin' ,'Last name')])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>
					</div>
					<div class="col-lg-12">
						<?= $form->field($model, 'oldPassword', ['template' => '{label}<div class="col-sm-3">{input}{error}</div>'])
								->passwordInput(['placeholder' => 'Old password'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>
					</div>
					<div class="col-lg-12">
						<?= $form->field($model, 'newPassword', ['template' => '{label}<div class="col-sm-3">{input}{error}</div>'])
								->passwordInput(['placeholder' => 'New password'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>
					</div>
					<div class="col-lg-12">
						<?= $form->field($model, 'confirmPassword', ['template' => '{label}<div class="col-sm-3">{input}{error}</div>'])
								->passwordInput(['placeholder' => 'Repeat password'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

					</div>
					<div class="col-lg-12">
						<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
					</div>
				</div>
			</div>
		</div>
    <?php ActiveForm::end(); ?>
</div>