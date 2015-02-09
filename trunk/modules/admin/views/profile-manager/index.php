<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\admin */

$this->title = Yii::t('admin', 'User Profile');
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-view">
    <?php
	    echo DetailView::widget([
	        'model' => $model,
	        'attributes' => [
	            'username',
	            'first_name',
	            'last_name',
	        ],
	    ]) 
	?>
	 <p>
        <?= Html::a('Update', ['editprofile'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
