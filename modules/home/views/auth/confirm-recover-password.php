<?php
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\home\models\PasswordResetForm */
?>
<div class="post">
<?php if ($message = $model->getErrorMessage()):?>

    <?= $message ?>

<?php elseif ($message = $model->getSuccessMessage()):?>

    <?= $message ?>

<?php else: ?>

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic', 'id' => 'confirm-recover-password'], 'enableClientValidation' => false]); ?>
        <div class="postinfotop">
            <h2><?php echo Yii::t('home', 'Change password'); ?></h2>
        </div>

        <div class="login-panel panel panel-default">
            <div class="panel-body">
                <fieldset>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                    <?= $form->field($model, 'confirmPassword')->passwordInput(['placeholder' => 'Confirm password']) ?>

                    <!-- Change this to a button or input when using this as a form -->
                    <a href="javascript:void(0)" onClick="$('form#confirm-recover-password').submit();" class="btn btn-lg btn-success btn-block">
                        <?php echo Yii::t('home', 'Change'); ?>
                    </a>
                </fieldset>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

<?php endif; ?>
</div>
