<?php

use app\models\City;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\User;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-search">
	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?php $form = ActiveForm::begin(); ?>
		<!-- acc section -->
		<div class="accsection">
			<div class="topwrap">
				<div class="row">
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'type')
								->dropDownList(User::getTypeOptions(), ['prompt' => Yii::t('admin', 'Please choose your type')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'status')
								->dropDownList(User::getStatusOptions(), ['prompt' => Yii::t('admin', 'Please choose your status')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'email')
								->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'Email')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'facebook_login_id')
								->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'Facebook login id')]) ?>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'first_name')
								->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'First name')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'last_name')
								->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'Last name')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'identifier')
								->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'Identifier')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'age')
								->textInput(['maxlength' => 2, 'placeholder' => Yii::t('admin', 'Age')]) ?>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'address')
								->textInput(['maxlength' => 45, 'placeholder' => Yii::t('admin', 'Address')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'city_id')
								->dropDownList(ArrayHelper::map(City::find()->all(), 'id', 'name'), ['prompt' => Yii::t('admin', 'Please choose your city')]) ?>
					</div>
					<div class="col-lg-3 col-md-3">
						<?= $form->field($model, 'contact_number')
								->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'Phone')]) ?>
					</div>
				</div>

					<div class="clearfix"></div>
					<div>
						<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
						<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
					</div>
			</div>
		</div><!-- acc section END -->
	<?php ActiveForm::end(); ?>
	<br /><?php if (Yii::$app->session->getFlash('update_success')) {?><div class='message_success'><?= Yii::$app->session->getFlash('update_success'); ?> <?= Yii::$app->session->getFlash('account_delete'); ?></div><br /><?php } ?>
</div><!-- POST -->
