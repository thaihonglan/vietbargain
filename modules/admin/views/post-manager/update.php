<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Post',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 post-update">
	<div class="panel panel-default">
		<div class="panel-heading">
			Update Post form
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