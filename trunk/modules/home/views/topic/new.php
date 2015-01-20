<?php
use yii\widgets\ActiveForm;
use app\widgets\chosen\Chosen;
use yii\jui\DatePicker;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
?>
<div class="post">
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic', 'enctype' => 'multipart/form-data'], 'enableClientValidation' => false]); ?>
		<div class="topwrap">
			<div class="userinfo pull-left">
				<div class="avatar">
					<img src="<?= Yii::$app->params['userImagePath']['icon'] . ((Yii::$app->user->identity->avatar) ? Yii::$app->user->identity->avatar : Yii::$app->params['postNoImage']) ?>" alt="" height="37" width="37" />
					<div class="status green">&nbsp;</div>
				</div>
			</div>
			<div class="posttext pull-left">

				<div>
					<?= $form->field($model, 'title', ['template' => '{input} {error}'])
							->textInput(['placeholder' => Yii::t('admin', 'Enter Topic Title')]) ?>
				</div>

				<div>
					<?= $form->field($model, 'shortContent', ['template' => '{input} {error}'])
							->textarea(['placeholder' => Yii::t('admin', 'Short content')]) ?>
				</div>

				<div>
					<?= $form->field($model, 'content', ['template' => '{input} {error}'])
							->widget(TinyMce::className(), [
								'options' => ['rows' => 30],
								'language' => 'vi',
								'clientOptions' => [
									'plugins' => [
										"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
										"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
										"table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
									],
									'toolbar1' => "newdocument fullpage | fontselect | fontsizeselect | styleselect | formatselect",
									'toolbar2' => "forecolor | backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify",
									'toolbar3' => "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview",
									'toolbar4' => "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
									'menubar' => false,
									'toolbar_items_size' => 'small',
									'style_formats' => [
										['title' => 'Bold text', 'inline' => 'b'],
										['title' => 'Red text', 'inline' => 'span', 'styles' => ['color' => '#ff0000']],
										['title' => 'Red header', 'block' => 'h1', 'styles' => ['color' => '#ff0000']],
										['title' => 'Example 1', 'inline' => 'span', 'classes' => 'example1'],
										['title' => 'Example 2', 'inline' => 'span', 'classes' => 'example2'],
										['title' => 'Table styles'],
										['title' => 'Table row 1', 'selector' => 'tr', 'classes' => 'tablerow1']
									],
								]
							]) ?>
<!-- 					<= $form->field($model, 'content', ['template' => '{input} {error}'])->textarea(['placeholder' => Yii::t('admin', 'Content')]) ?> -->
				</div>

				<div style="height: 60px;">
					<?= Chosen::widget([
						'model' => $model,
						'attribute' => 'postType',
						'items' => $model->getPostTypeOptions(),
						'multiple' => true,
						'placeholder' => 'Please choose post type',
					]);?>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
					<?php
						echo $form->field($model, 'dealBeginDate', ['template' => '{input} {error}'])
								->widget(DatePicker::className(), [
									'dateFormat' => 'php:d-m-Y',
									'clientOptions' => [
										'minDate' => 0,
									],
									'options' => [
										'class' => 'form-control',
										'placeholder' => 'Deal from'
									],
								]);
						echo $this->registerJs('$("#topicform-dealbegindate").datepicker("option", "onSelect", function(selectedDate) {$("#topicform-dealenddate").datepicker("option", "minDate", selectedDate);});');
					?>
					</div>
					<div class="col-lg-6 col-md-6">
					<?php
						echo $form->field($model, 'dealEndDate', ['template' => '{input} {error}'])
								->widget(DatePicker::className(), [
									'dateFormat' => 'php:d-m-Y',
									'options' => [
										'class' => 'form-control',
										'placeholder' => 'Deal to'
									],
								]);
						echo $this->registerJs('$("#topicform-dealenddate").datepicker("option", "onSelect", function(selectedDate) {$("#topicform-dealbegindate").datepicker("option", "maxDate", selectedDate);});');
					?>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<?= $form->field($model, 'dealType', ['template' => '{input} {error}'])
								->dropDownList($model->getDealTypeOptions(), ['prompt' => Yii::t('admin', 'Please choose deal type')]) ?>
					</div>
					<div class="col-lg-6 col-md-6">
						<?= $form->field($model, 'discountCode', ['template' => '{input} {error}'])
								->textInput(['placeholder' => 'Discount code']) ?>
					</div>
				</div>

				<div>
					<?= $form->field($model, 'storeAddress', ['template' => '{input} {error}'])
							->textInput(['placeholder' => 'Store address']) ?>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<?= $form->field($model, 'contactNumber', ['template' => '{input} {error}'])
								->textInput(['placeholder' => 'Contact number']) ?>
					</div>
					<div class="col-lg-6 col-md-6">
						<?= $form->field($model, 'link', ['template' => '{input} {error}'])
								->textInput(['placeholder' => 'Deal link']) ?>
					</div>
				</div>

				<div>
					<?= $form->field($model, 'image', ['template' => '{input} {error}'])
							->fileInput() ?>
				</div>

				<div class="row newtopcheckbox">
					<div class="col-lg-6 col-md-6">
						<?= $form->field($model, 'isOwner', ['template' => '{input} {error}'])
								->checkbox() ?>
					</div>
				</div>


			</div>
			<div class="clearfix"></div>
		</div>
		<div class="postinfobot">
			<div class="pull-right postreply">
				<div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
				<div class="pull-left"><button type="submit" class="btn btn-primary">Post</button></div>
				<div class="clearfix"></div>
			</div>


			<div class="clearfix"></div>
		</div>
	<?php ActiveForm::end(); ?>
</div><!-- POST -->

