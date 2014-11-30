<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DealType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deal-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_vi')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => 64]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
