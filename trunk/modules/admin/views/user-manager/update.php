<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 user-update">
	<div class="panel panel-default">
		<div class="panel-heading">
			Update User form
		</div>

		<div class="panel-body admin-create">
			<?php $form = ActiveForm::begin(); ?>
				<!-- acc section -->
				<div class="accsection">
					<div class="topwrap">
						<?php if (Yii::$app->session->getFlash('update_success')) {?><div class='message_success'><?= Yii::$app->session->getFlash('update_success'); ?></div><?php } ?>
						<div class="row"> 
							<div class="col-lg-3 col-md-3"><?= $form->field($model, 'type')->dropDownList(ArrayHelper::map($type, 'id', 'name'), ['prompt' => Yii::t('admin', 'Please choose your type')]) ?></div>
							<div class="col-lg-3 col-md-3"><?= $form->field($model, 'status')->dropDownList(ArrayHelper::map($status, 'id', 'name'), ['prompt' => Yii::t('admin', 'Please choose your status')]) ?></div>
						</div>
						<div>
							<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
							<?= Html::a(Html::button(Yii::t('app', 'Back'), ['class' => 'btn btn-default']), $this->context->getBacklink('user-manager/index')) ?>
							<?php echo $model->isNewRecord;
								if (!$model->isNewRecord) {
									echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
										'class' => 'btn btn-danger',
										'data' => [
											'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
											'method' => 'post',
										],
									]);
								}
							?>
						</div>	
					</div>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
		
	</div>
</div>
<!-- /.col-lg-12 -->