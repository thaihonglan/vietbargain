<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PostType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Post Type',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-lg-12 post-type-update">
	<div class="panel panel-default">
		<div class="panel-heading">
			Update Post Type form
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