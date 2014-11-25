<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_parent')->textInput() ?>

    <?= $form->field($model, 'parent_id')->textInput(['maxlength' => 8]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
