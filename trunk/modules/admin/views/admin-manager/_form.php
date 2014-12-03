<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'password')->passwordInput(['maxlength' => 64]) ?>

	<?= $form->field($model, 'first_name')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'last_name')->textInput(['maxlength' => 32]) ?>

	<div class="form-group field-admin-authority">
		<label class="control-label"><?= Yii::t('admin', 'Authority') ?></label>

		<?= $form->field($model, 'has_admin_authority', ['template' => '{input} {label}', 'options' => ['class' => '']])->checkbox() ?>

		<?= $form->field($model, 'has_user_authority', ['template' => '{input} {label}', 'options' => ['class' => '']])->checkbox() ?>

		<?= $form->field($model, 'has_deal_authority', ['template' => '{input} {label}', 'options' => ['class' => '']])->checkbox() ?>

		<?= $form->field($model, 'has_dashboard_authority', ['template' => '{input} {label}', 'options' => ['class' => '']])->checkbox() ?>
	</div>

	<div class="form-group">
		<?= Html::a(Html::button(Yii::t('app', 'Back'), ['class' => 'btn btn-default']), $this->context->getBacklink('admin-manager/index')) ?>
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
