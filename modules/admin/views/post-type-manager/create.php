<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PostType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Post Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 post-type-create">
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Post Type form (parent: <strong><?= $parentName ?></strong>)
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