<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'password')->passwordInput(['maxlength' => 64]) ?>

	<?= $form->field($model, 'facebook_login_id')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'first_name')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'last_name')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'identifier')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'city_id')->textInput(['maxlength' => 8]) ?>

	<?= $form->field($model, 'address')->textInput(['maxlength' => 45]) ?>

	<?= $form->field($model, 'age')->textInput() ?>

	<?= $form->field($model, 'contact_number')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'avatar')->textInput(['maxlength' => 64]) ?>

	<?= $form->field($model, 'is_unlimited_user')->textInput() ?>

	<?= $form->field($model, 'create_datetime')->textInput() ?>

	<?= $form->field($model, 'status')->textInput() ?>

	<div class="form-group">
		<?= Html::a(Html::button(Yii::t('app', 'Back'), ['class' => 'btn btn-default']), $this->context->getBacklink('user-manager/index')) ?>
		<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

	<div>
		<?php
			if (!$model->isNewRecord) {
				echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
						'method' => 'post',
					],
				]);
			}
		?>
	</div>
</div>
