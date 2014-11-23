<?php
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
        toolbar1: "newdocument fullpage | fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
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
	<form action="#" class="form newtopic" method="post">
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
					<input type="text" placeholder="Enter Topic Title" class="form-control" />
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<select name="category" id="category"  class="form-control" >
							<option value="" disabled selected>Select Category</option>
							<option value="op1">Option1</option>
							<option value="op2">Option2</option>
						</select>
					</div>
					<div class="col-lg-6 col-md-6">
						<select name="subcategory" id="subcategory"  class="form-control" >
							<option value="" disabled selected>Select Subcategory</option>
							<option value="op1">Option1</option>
							<option value="op2">Option2</option>
						</select>
					</div>
				</div>

				<div>
					<textarea name="desc" id="desc" placeholder="Description" ></textarea>
				</div>
				<div class="row newtopcheckbox">
					<div class="col-lg-6 col-md-6">
						<div><p>Who can see this?</p></div>
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="everyone" /> Everyone
									</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="friends"  /> Only Friends
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div>
							<p>Share on Social Networks</p>
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
				<label for="note"> Email me when some one post a reply</label>
			</div>

			<div class="pull-right postreply">
				<div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
				<div class="pull-left"><button type="submit" class="btn btn-primary">Post</button></div>
				<div class="clearfix"></div>
			</div>


			<div class="clearfix"></div>
		</div>
	</form>
</div><!-- POST -->

