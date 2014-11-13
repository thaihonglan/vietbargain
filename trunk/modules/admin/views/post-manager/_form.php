<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'store_address')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'discount_code')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'is_owner')->textInput() ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'deal_type')->textInput() ?>

    <?= $form->field($model, 'deal_begin_date')->textInput() ?>

    <?= $form->field($model, 'deal_end_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
