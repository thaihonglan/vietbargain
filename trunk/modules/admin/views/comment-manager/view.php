<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Comment;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\comment */

$this->title = Yii::t('admin', 'Update Commnet');
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'user.Fullname',
			'create_datetime',
			[
				'attribute' => 'is_approved',
				'value' => Comment::getStatusOptions($model->is_approved),
			],


// 			 [
// 		        'attribute'=>'create_datetime',
// 		        'format'=>'date',
// 		        'type'=>DetailView::INPUT_DATE,
// 		        'widgetOptions'=>[
// 		            'pluginOptions'=>['format'=>'yyyy-mm-dd']
// 		        ],
// 		        'inputWidth'=>'40%'
// 		    ],

			'content:ntext',
		],
	]) ?>
	<p>
		<?php $form = ActiveForm::begin(); ?>
		<?=  Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('admin', 'Are you sure you want to delete this commnet?'),
				'method' => 'post',
			],
		]) ?>
		<?= Html::a(Html::button(Yii::t('app', 'Back'), ['class' => 'btn btn-default']), ['index']) ?>
		<?php ActiveForm::end(); ?>
	</p>

</div>
<!-- /.col-lg-12 -->