<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\City */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'City',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 city-create">
	<div class="panel panel-default">
		<div class="panel-heading">
			Create City form
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