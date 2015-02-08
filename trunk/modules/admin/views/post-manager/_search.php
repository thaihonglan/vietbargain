<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($searchModel, 'id') ?>

    <?= $form->field($searchModel, 'title') ?>

    <?= $form->field($searchModel, 'content') ?>

    <?= $form->field($searchModel, 'user_id') ?>

    <?= $form->field($searchModel, 'contact_number') ?>

    <?php // echo $form->field($searchModel, 'store_address') ?>

    <?php // echo $form->field($searchModel, 'link') ?>

    <?php // echo $form->field($searchModel, 'discount_code') ?>

    <?php // echo $form->field($searchModel, 'is_owner') ?>

    <?php // echo $form->field($searchModel, 'image') ?>

    <?php // echo $form->field($searchModel, 'deal_type') ?>

    <?php // echo $form->field($searchModel, 'deal_begin_date') ?>

    <?php // echo $form->field($searchModel, 'deal_end_date') ?>

    <?php // echo $form->field($searchModel, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
