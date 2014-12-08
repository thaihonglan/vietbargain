<?php
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
?>

<div class="post">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic', 'id' => 'forget-password-form']]); ?>
        <div class="postinfotop">
            <h2><?php echo Yii::t('home', 'Recover password'); ?></h2>
        </div>

        <div class="login-panel panel panel-default">
            <div class="panel-body">
                <fieldset>
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>

                    <?= $form->field($model, 'captcha')->widget(Captcha::className(), ['options' => ['class' => 'form-control', 'placeholder' => 'Captcha']]) ?>

                    <!-- Change this to a button or input when using this as a form -->
                    <a href="javascript:$('form#forget-password-form').submit();" class="btn btn-lg btn-success btn-block">
                        <?php echo Yii::t('home', 'Send'); ?></a>
                </fieldset>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>