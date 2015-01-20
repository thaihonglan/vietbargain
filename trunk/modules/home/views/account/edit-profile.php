<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\ProfileForm */
?>
<div class="post">
<?php if (\Yii::$app->request->get('success') == 1): ?>
	<div class="alert alert-success">
		You have successfully updated profile.
	</div>
<?php endif; ?>

	<!-- Update personal data -->
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'enableClientValidation' => false]); ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Personal Data
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<?= $form->field($model, 'firstName', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'First name'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'lastName', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'Last name'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'age', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'Age'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'identifier', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'Identifier'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'city', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->dropDownList($model->getCityOptions())
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'address', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'Address'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'contactNumber', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'Contact number'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= Html::submitButton('Save data', ['class' => 'btn btn-success', 'name' => 'action', 'value' => $model::ACTION_UPDATE_DATA]) ?>
					</div>
				</div>
			</div>
		</div>
	<?php ActiveForm::end(); ?>

	<!-- Update email -->
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'enableClientValidation' => false]); ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Change email
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<?= $form->field($model, 'email', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->textInput(['placeholder' => 'Email'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= Html::submitButton('Change email', ['class' => 'btn btn-success', 'name' => 'action', 'value' => $model::ACTION_UPDATE_EMAIL]) ?>
					</div>
				</div>
			</div>
		</div>
	<?php ActiveForm::end(); ?>

	<!-- Update password -->
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'enableClientValidation' => false]); ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Update password
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<?= $form->field($model, 'oldPassword', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->passwordInput(['placeholder' => 'Old password'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'newPassword', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->passwordInput(['placeholder' => 'New password'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= $form->field($model, 'confirmPassword', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->passwordInput(['placeholder' => 'Repeat password'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?= Html::submitButton('Update password', ['class' => 'btn btn-success', 'name' => 'action', 'value' => $model::ACTION_UPDATE_PASSWORD]) ?>
					</div>
				</div>
			</div>
		</div>
	<?php ActiveForm::end(); ?>

	<!-- Update avatar -->
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'id' => 'update-avatar', 'enctype' => 'multipart/form-data'], 'enableClientValidation' => false]); ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Change avatar
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<div class="form-group avatar-box">
							<img src="<?= Yii::$app->params['userImagePath']['scaled'] . $model->avatar ?>" height="120" width="120"/>
						</div>

						<?= $form->field($model, 'avatar', ['template' => '{label}<div class="col-sm-10">{input}{error}</div>'])
								->fileInput(['placeholder' => 'Avatar', 'accept' => '.jpg, .jpeg, .png'])
								->label(null, ['class' => 'col-sm-2 control-label']) ?>

						<?php
							$js = <<<SCRIPT
$("input#profileform-avatar").change(function(e) {
	for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
		var file = e.originalEvent.srcElement.files[i];
		var reader = new FileReader();
		reader.onloadend = function() {
			$("#update-avatar img").prop("src", reader.result);
		}
		reader.readAsDataURL(file);
	}
});
SCRIPT;
							$this->registerJs($js); ?>

						<?= Html::submitButton('Change avatar', ['class' => 'btn btn-success', 'name' => 'action', 'value' => $model::ACTION_UPDATE_AVATAR]) ?>
					</div>
				</div>
			</div>
		</div>
	<?php ActiveForm::end(); ?>

</div>