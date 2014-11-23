<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
?>
<!-- POST -->
<div class="post">
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form newtopic']]); ?>
		<div class="postinfotop">
			<h2>Create New Account</h2>
		</div>

		<!-- acc section -->
		<div class="accsection">
			<div class="acccap">
				<div class="userinfo pull-left">&nbsp;</div>
				<div class="posttext pull-left">
					<h3>Required Fields</h3>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="topwrap">
				<div class="userinfo pull-left">
					<div class="avatar">
						<img src="home/images/avatar-blank.jpg" alt="" />
						<div class="status green">&nbsp;</div>
					</div>
					<div class="imgsize">60 x 60</div>
					<div>
						<button class="btn">Add</button>
					</div>
				</div>
				<div class="posttext pull-left">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'lastName', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Last Name']) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'firstName', ['template' => '{input} {error}'])->textInput(['placeholder' => 'First Name']) ?>
						</div>
					</div>
					<div>
						<?= $form->field($model, 'email', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Email']) ?>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'password', ['template' => '{input} {error}'])->passwordInput(['placeholder' => 'Password']) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'confirmPassword', ['template' => '{input} {error}'])->passwordInput(['placeholder' => 'Retype Password']) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'identifier', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Identifier']) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'city', ['template' => '{input} {error}'])->dropDownList(ArrayHelper::map($cityList, 'id', 'name'), ['prompt' => 'Please choose your city']) ?>
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
							<?= $form->field($model, 'contactNumber', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Contact Number']) ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?= $form->field($model, 'age', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Age']) ?>
						</div>
					</div>
					<div>
						<?= $form->field($model, 'address', ['template' => '{input} {error}'])->textInput(['placeholder' => 'Address']) ?>
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
						<h3>Social Networks ( Optional )</h3>
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
							<button class="btn btn-fb">Link Facebook Account</button>
						</div>
					</div>

				</div>
				<div class="clearfix"></div>
			</div>
		</div><!-- acc section END -->

		<div class="postinfobot">
			<div class="pull-left lblfch">
				<label for="note">Click Sign Up to agree with the Terms and Conditions of this site.</label>
			</div>

			<div class="pull-right postreply">
				<div class="pull-left smile">
					<a href="javascript:void(0)"><i class="fa fa-smile-o"></i></a>
				</div>
				<div class="pull-left">
					<?= Html::submitButton(Yii::t('app', 'Sign Up'), ['class' => 'btn btn-primary']) ?>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
		</div>
	<?php ActiveForm::end(); ?>
</div><!-- POST -->



