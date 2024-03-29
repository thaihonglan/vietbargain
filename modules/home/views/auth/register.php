<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
?>
<!-- POST -->
<div class="post">
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic', 'enctype' => 'multipart/form-data']]); ?>
		<div class="postinfotop">
			<h2><?php echo Yii::t('home', 'Create New account'); ?></h2>
		</div>

		<!-- acc section -->
		<div class="accsection">
			<div class="acccap">
				<div class="userinfo pull-left">&nbsp;</div>
				<div class="posttext pull-left">
					<h3><?php echo Yii::t('home', 'Required Fields'); ?></h3>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="topwrap">
				<div class="userinfo pull-left">
					<div class="avatar">
						<img src="/home/images/avatar-blank.jpg" alt="" height="60" width="60"/>
					</div>
					<div class="imgsize">60 x 60</div>
					<div>
						<label for="signupform-avatar">
							<button class="btn" type="button"><?php echo Yii::t('home', 'Add'); ?></button>
							<?php
								echo $form->field($model, 'avatar', ['template' => '{input} {error}'])->fileInput(['style' => 'display:none;', 'accept' => '.jpg, .jpeg, .png']);

								echo $this->registerJs(
'$("input#signupform-avatar").change(function(e) {
	for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
		var file = e.originalEvent.srcElement.files[i];
		var reader = new FileReader();
		reader.onloadend = function() {
			$("div.accsection div.avatar img").prop("src", reader.result);
		}
		reader.readAsDataURL(file);
	}
});'
								);
							?>
						</label>
					</div>
				</div>
				<div class="posttext pull-left">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'lastName', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('home', 'Last Name')]) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'firstName', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('home', 'First Name')]) ?>
						</div>
					</div>
					<div>
						<?= $form->field($model, 'email', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Email']) ?>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'password', ['template' => '{input} {error}'])->passwordInput(['placeholder' => Yii::t('home', 'Password')]) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'confirmPassword', ['template' => '{input} {error}'])->passwordInput(['placeholder' => Yii::t('home', 'Retype Password')]) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'city', ['template' => '{input} {error}'])->dropDownList(ArrayHelper::map($cityList, 'id', 'name'), ['prompt' => Yii::t('home', 'Please choose your city')]) ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- acc section END -->

		<!-- acc section -->
		<div class="accsection survey">
			<div class="acccap">
				<div class="userinfo pull-left">&nbsp;</div>
				<div class="posttext pull-left">
					<div class="htext">
						<h3>Optional Fields</h3>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="topwrap">
				<div class="userinfo pull-left">&nbsp;</div>
				<div class="posttext pull-left">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'identifier', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('home', 'Identifier')]) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'age', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('home', 'Age')]) ?>
						</div>
					</div>
					<div>
						<?= $form->field($model, 'contactNumber', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('home', 'Contact Number')]) ?>
					</div>
					<div>
						<?= $form->field($model, 'address', ['template' => '{input} {error}'])->textInput(['placeholder' => Yii::t('home', 'Address')]) ?>
					</div>
					<div>
						<?= $form->field($model, 'captcha')->widget('Zelenin\yii\widgets\Recaptcha\widgets\Recaptcha', [
						    'clientOptions' => [
						        'data-sitekey' => Yii::$app->params['recaptcha']['sitekey']
						    ]
						]) ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- acc section END -->

		<!-- acc section -->
		<div class="accsection networks">
			<div class="acccap">
				<div class="userinfo pull-left">&nbsp;</div>
				<div class="posttext pull-left">
					<div class="htext">
						<h3><?php echo Yii::t('home', 'Social Networks (Optional)') ?></h3>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="topwrap">
				<div class="userinfo pull-left">&nbsp;</div>
				<div class="posttext pull-left">

					<div class="row">
						<div class="col-lg-6 col-md-6">
							<button class="btn btn-fb"><?php echo Yii::t('home', 'Link with Facebook account'); ?></button>
						</div>
					</div>

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- acc section END -->

		<div class="postinfobot">
			<div class="pull-left lblfch">
				<label for="note"><?php echo Yii::t('home', 'Click Sign Up to agree with the Terms and Conditions of this site'); ?>.</label>
			</div>

			<div class="pull-right postreply">
				<div class="pull-left smile">
					<a href="javascript:void(0)"><i class="fa fa-smile-o"></i></a>
				</div>
				<div class="pull-left">
					<?= Html::submitButton(Yii::t('home', 'Sign Up'), ['class' => 'btn btn-primary']) ?>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
		</div>
	<?php ActiveForm::end(); ?>
</div><!-- POST -->



