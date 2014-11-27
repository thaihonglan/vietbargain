<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-type-form">

    <?php $form = ActiveForm::begin(); ?>

<?php
    foreach (Yii::$app->params['languages'] as $code => $name):
        list($shortCode) = explode('-', $code);
?>
    <?= $form->field($model, 'name_' . $shortCode)->textInput() ?>
<?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
