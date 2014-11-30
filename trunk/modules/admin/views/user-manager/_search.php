<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'email') ?>

	<?= $form->field($model, 'password') ?>

	<?= $form->field($model, 'facebook_login_id') ?>

	<?= $form->field($model, 'first_name') ?>

	<?php // echo $form->field($model, 'last_name') ?>

	<?php // echo $form->field($model, 'identifier') ?>

	<?php // echo $form->field($model, 'city_id') ?>

	<?php // echo $form->field($model, 'address') ?>

	<?php // echo $form->field($model, 'age') ?>

	<?php // echo $form->field($model, 'contact_number') ?>

	<?php // echo $form->field($model, 'avatar') ?>

	<?php // echo $form->field($model, 'is_power') ?>

	<?php // echo $form->field($model, 'create_datetime') ?>

	<?php // echo $form->field($model, 'status') ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
