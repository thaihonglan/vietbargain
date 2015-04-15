<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use app\models\Post;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->title;
?>

<div class="post-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'content', ['template' => '{input} {error}'])
							->widget(TinyMce::className(), [
								'options' => ['rows' => 30],
								'language' => 'vi',
								'clientOptions' => [
									'readonly' => 1,
									'menubar' => false,
									'toolbar_items_size' => 'small',
								]
							]) ?>

	<?php if (!$model->isNewRecord): ?>
		<?= Html::activeLabel($model, 'user_fullName', ['class' => 'control-label']) ?>
		<p><?= $model->user->fullName ?></p>
	<?php endif; ?>

		<?= $form->field($model, 'contact_number')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'store_address')
				->textInput(['maxlength' => 128, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'link')
				->textInput(['maxlength' => 64, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'discount_code')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'deal_type_id')
				->dropDownList([$model->deal_type_id => $model->dealType->name], ['disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'deal_begin_date')
				->textInput(['disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'deal_end_date')
				->textInput(['disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'is_owner', ['template' => '{label} <p>{input}</p>'])
				->checkbox(['label' => '', 'disabled' => (!$model->isNewRecord) ? 'disabled' : false])->label('Is Owner') ?>

		<?= $form->field($model, 'status')
				->dropDownList(Post::getStatusOptions()) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
