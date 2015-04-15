<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->fullName;
?>

<div class="user-form">

<?php if (!$model->isNewRecord): ?>
	<img src="<?= Yii::$app->params['userImagePath']['scaled'] . $model->avatar ?>" height="160" width="160"/>
<?php endif; ?>

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'email')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= ($model->isNewRecord)
				? $form->field($model, 'password')
						->passwordInput(['maxlength' => 64])
				: '' ?>

		<?= $form->field($model, 'facebook_login_id')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'first_name')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'last_name')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'identifier')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'city_id')
				->textInput(['maxlength' => 8, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'address')
				->textInput(['maxlength' => 45, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'age')
				->textInput(['maxlength' => 3, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'contact_number')
				->textInput(['maxlength' => 32, 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]) ?>

		<?= $form->field($model, 'type')
				->dropDownList(User::getTypeOptions(), ($model->isNewRecord) ? ['prompt' => Yii::t('admin', 'Please choose your type')] : []) ?>

		<?= $form->field($model, 'status')
				->dropDownList(User::getStatusOptions(), ($model->isNewRecord) ? ['prompt' => Yii::t('admin', 'Please choose your status')] : []) ?>

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
