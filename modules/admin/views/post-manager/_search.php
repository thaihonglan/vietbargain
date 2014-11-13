<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'contact_number') ?>

    <?php // echo $form->field($model, 'store_address') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'discount_code') ?>

    <?php // echo $form->field($model, 'is_owner') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'deal_type') ?>

    <?php // echo $form->field($model, 'deal_begin_date') ?>

    <?php // echo $form->field($model, 'deal_end_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
