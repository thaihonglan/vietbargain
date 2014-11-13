<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'City',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 city-update">
	<div class="panel panel-default">
		<div class="panel-heading">
			Update City form
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