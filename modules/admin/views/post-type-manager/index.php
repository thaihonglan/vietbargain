<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use app\widgets\jstree\widgets\JsTree;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Post Types');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<form action="<?= Url::to(['create']) ?>" type="get" id="addForm">
		<input name="id" value="0" type="hidden">
		<?= Html::a(Yii::t('app', 'Create {modelClass}', [
		'modelClass' => 'Post Type',
		]), 'javascript:document.getElementById("addForm").submit()', ['class' => 'btn btn-success']) ?>
	</form>

	<form action="<?= Url::to(['update']) ?>" type="get" id="addForm">
		<input name="id" value="0" type="hidden">
		<?= Html::a(Yii::t('app', 'Update {modelClass}', [
		'modelClass' => 'Post Type',
		]), 'javascript:document.getElementById("addForm").submit()', ['class' => 'btn btn-success']) ?>
	</form>

</p>

<div id='abc'></div>

<div class="col-lg-12 post-type-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			Post Type tree
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">
		<?= JsTree::widget([
			'attribute' => 'is_parent',
			'model' => $model,
			'checkbox' => false,
			'core' => [
				'data' => $data,
			],
			'bindChanged' => [
				['type' => 'html', 'selector' => '#abc', 'attribute' => 'id'],
			]
		]); ?>

			</div>
			<!-- /.table-responsive -->
		</div>
	</div>
</div>
<!-- /.col-lg-12 -->