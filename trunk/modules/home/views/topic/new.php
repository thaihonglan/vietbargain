<?php
use yii\widgets\ActiveForm;
use app\widgets\chosen\Chosen;

/* @var $this yii\web\View */
?>
<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	mode : "textareas",
		plugins: [
				"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
				"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				"table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
		],
		toolbar1: "newdocument fullpage | fontselect | fontsizeselect | styleselect | formatselect",
		toolbar2: "forecolor | backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify",
		toolbar3: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview",
		toolbar4: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
		menubar: false,
		toolbar_items_size: 'small',
		style_formats: [
				{title: 'Bold text', inline: 'b'},
				{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
				{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
				{title: 'Example 1', inline: 'span', classes: 'example1'},
				{title: 'Example 2', inline: 'span', classes: 'example2'},
				{title: 'Table styles'},
				{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],
		templates: [
				{title: 'Test template 1', content: 'Test 1'},
				{title: 'Test template 2', content: 'Test 2'}
		]
});
</script>
<div class="post">
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic']]); ?>
<!-- 	<form action="#" class="form newtopic" method="post"> -->
		<div class="topwrap">
			<div class="userinfo pull-left">
				<div class="avatar">
					<img src="images/avatar4.jpg" alt="" />
					<div class="status red">&nbsp;</div>
				</div>

				<div class="icons">
					<img src="images/icon3.jpg" alt="" /><img src="images/icon4.jpg" alt="" /><img src="images/icon5.jpg" alt="" /><img src="images/icon6.jpg" alt="" />
				</div>
			</div>
			<div class="posttext pull-left">

				<div>
					<?= $form->field($model, 'title', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('admin', 'Enter Topic Title')]) ?>
				</div>

				<div>
					<?= $form->field($model, 'content', ['template' => '{input} {error}'])->textarea(['placeholder' => Yii::t('admin', 'Content')]) ?>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<?= Chosen::widget([
							'model' => $model,
							'attribute' => 'postType',
							'items' => $model->getPostTypeOptions(),
							'multiple' => true,
						]);?>
					</div>
					<div class="col-lg-6 col-md-6">
						<?= $form->field($model, 'dealType', ['template' => '{input} {error}'])->dropDownList($model->getDealTypeOptions(), ['prompt' => Yii::t('admin', 'Please choose deal type')]) ?>
					</div>
				</div>

				<div class="row newtopcheckbox">
					<div class="col-lg-6 col-md-6">
						<div><p><?php echo Yii::t('admin', 'Who can see this') . '?' ?></p></div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="everyone" />
										<?php echo Yii::t('admin', 'Everyone'); ?>
									</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="friends"  /> 
										<?php echo Yii::t('admin', 'Only Friends'); ?>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div>
							<p><?php echo Yii::t('admin', 'Share on Social Networks'); ?></p>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="fb"/> <i class="fa fa-facebook-square"></i>
									</label>
								</div>
							</div>
							<div class="col-lg-3 col-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="tw" /> <i class="fa fa-twitter"></i>
									</label>
								</div>
							</div>
							<div class="col-lg-3 col-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="gp"  /> <i class="fa fa-google-plus-square"></i>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
			<div class="clearfix"></div>
		</div>
		<div class="postinfobot">

			<div class="notechbox pull-left">
				<input type="checkbox" name="note" id="note" class="form-control" />
			</div>

			<div class="pull-left">
				<label for="note"> Gửi email cho tôi khi có người đăng bài trả lời</label>
			</div>

			<div class="pull-right postreply">
				<div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
				<div class="pull-left"><button type="submit" class="btn btn-primary">Đăng</button></div>
				<div class="clearfix"></div>
			</div>


			<div class="clearfix"></div>
		</div>
<!-- 	</form> -->
	<?php ActiveForm::end(); ?>
</div><!-- POST -->
