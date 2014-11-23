<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	mode : "textareas",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar1: "newdocument fullpage | fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        menubar: false,
        toolbar_items_size: 'small',
        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ]
});
</script>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'cols' => 500]) ?>

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
