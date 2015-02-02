<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="accsection">
			<div class="topwrap">
				<div class="row">
					<div class="col-lg-6 col-md-6"><?= $form->field($model, 'is_approved')->dropDownList(ArrayHelper::map($status, 'id', 'name'), ['prompt' => Yii::t('admin', 'Please choose your status')]) ?></div>
				</div>
			</div>
		</div>
		
    	
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    	<?= Html::a(Html::button(Yii::t('app', 'Back'), ['class' => 'btn btn-default']), ['index']) ?>

    <?php ActiveForm::end(); ?>

</div>
