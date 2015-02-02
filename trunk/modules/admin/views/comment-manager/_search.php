<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CommentSearch */
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
					<div class="col-lg-3 col-md-3"><?= $form->field($model, 'user_full_name')->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'user_full_name')])  ?></div>
					<div class="col-lg-3 col-md-3"><?= $form->field($model, 'user_type')->dropDownList(ArrayHelper::map($type, 'id', 'name'), ['prompt' => Yii::t('admin', 'All')]) ?></div>
					
					<div class="col-lg-3 col-md-3"><?= $form->field($model, 'content')->textInput(['maxlength' => 32, 'placeholder' => Yii::t('admin', 'Content')]) ?></div>
					<div class="col-lg-3 col-md-3"> 
						<?php
						echo $form->field($model, 'create_datetime')
						->widget(DatePicker::className(), [
								'dateFormat' => 'php:d-m-Y',
								'clientOptions' => [
									'defaultDate' => '',
								],
								'options' => [
									'class' => 'form-control',
										'placeholder' => 'Create date'
									],
								]);
						?>
						</div>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3"><?= $form->field($model, 'is_approved')->dropDownList(ArrayHelper::map($is_approved, 'id', 'name'), ['prompt' => Yii::t('admin', 'All')]) ?></div>
					<div class="col-lg-3 col-md-3">
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
