<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\comment */

$this->title = 'Update Comment: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="col-lg-12 comment-update">
	<div class="panel panel-default">
		<div class="panel-heading">
			Update Comment form
		</div>

		<div class="panel-body admin-create">
			<div class="row">
				<div class="col-lg-6">

					<?= $this->render('_form', [
						'model' => $model,
						'status' => $status,
					]) ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.col-lg-12 -->