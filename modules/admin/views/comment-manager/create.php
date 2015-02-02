<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\comment */

$this->title = 'Create Comment';
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 comment-create">
	<div class="panel panel-default">
		<div class="panel-heading">
			Create Comment form
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