<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
	<?= Html::a(Yii::t('admin', 'Create {modelClass}', [
    'modelClass' => 'Post',
]), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="col-lg-12 post-index">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo Yii::t('admin', 'Post list'); ?>
		</div>
		<!-- /.panel-heading -->

		<div class="panel-body">
			<div class="table-responsive">

			<?= $this->render('_search', [
						'searchModel' => $searchModel,
								
					]
				); 
	?>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
// 			'filterModel' => $searchModel,
        'columns' => [
			'id',
// 			'PostTypeAllocation.id',
			'user.email',
			'fullName',

			'postType.name',
			// get email of user by id


				
				
				
				
//             'title',
//             'short_content',
//             'content:ntext',
//             'user_id',
//             'contact_number',
            // 'store_address',
            // 'link',
            // 'discount_code',
            // 'image',
            // 'deal_type',
            // 'deal_begin_date',
            // 'deal_end_date',
            // 'status',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'buttons' => [
					'update' => function($url, $model) {
						return '<a href="' . $url . '"><button type="button" class="btn btn-primary">Update</button></a>';
					},
				],
			],
		],
	]); ?>
			</div>
			<!-- /.table-responsive -->
		</div>
	</div>
</div>
<!-- /.col-lg-12 -->