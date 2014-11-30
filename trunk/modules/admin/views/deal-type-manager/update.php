<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DealType */

$this->title = Yii::t('admin', 'Update {modelClass}: ', [
    'modelClass' => 'Deal Type',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Deal Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="col-lg-12 deal-type-update">
	<div class="panel panel-default">
		<div class="panel-heading">
			Update Deal Type form
		</div>

		<div class="panel-body admin-create">
			<div class="row">
				<div class="col-lg-6">

					<?= $this->render('_form', [
						'model' => $model,
					]) ?>

				</div>
			</div>
		</div>

	</div>
</div>
<!-- /.col-lg-12 -->