 <div class="col-md-12 col-xl-12">
 	<div class="form-group">
		<div class="selectgroup selectgroup-pills">
 			<label class="selectgroup-item">
 				<input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
 				<span class="selectgroup-button selectgroup-button-icon" title="Setting Halaman Login"><i class="fe fe-shield"></i></span>
 			</label>
 			<label class="selectgroup-item">
 				<input type="radio" name="icon-input" value="2" class="selectgroup-input">
 				<span class="selectgroup-button selectgroup-button-icon" title="Setting Halaman Utama"><i class="fe fe-home"></i></span>
 			</label>
 			<label class="selectgroup-item">
 				<input type="radio" name="icon-input" value="3" class="selectgroup-input">
 				<span class="selectgroup-button selectgroup-button-icon" title="Setting Login Style"><i class="fe fe-airplay"></i></span>
 			</label>
 		</div>
 	</div>
 </div>

 <div class="col-md-12 col-xl-12">
 	<div class="panel panel-info" id="panel-form-login">
 		<div class="panel-heading">Halaman Login</div>
 		<div class="panel-body">
 			<form id="form-login">
 				<div class="form-group">
 					<label>Title Bar</label>
 					<div class="input-icon">
 						<span class="input-icon-addon">
 							<i class="fe fe-edit-3"></i>
 						</span>
 						<input type="text" class="form-control focus-color text-blue data-sending" id="login_title_bar" name="login_title_bar" value="<?php echo $this->_appinfo['login_title_bar'] ?>">
 					</div>
 				</div>

 				<div class="form-group">
 					<label>Upload Logo</label>
 					<div class="custom-file">
 						<input type="file" class="custom-file-input " id="inputfile" name="file">
 						<label id="logo-login-name" class="custom-file-label form-control">Choose file</label>
 					</div>

 				</div>

 				<div class="form-group">
 					<div class="text-center mb-6">
 						<img id="logo-login" src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="h-<?php echo $this->_appinfo['login_logo_size'] ?> fontlogo" alt="">
 					</div>
 				</div>

 				<div class="form-group">
 					<label class="form-label">Size Logo range ( 1 - 9 )</label>
 					<div class="row align-items-center">
 						<div class="col">
 							<input id="login_logo_size" name="login_logo_size" type="range" class="form-control custom-range data-sending" step="1" min="1" max="9" value="<?php echo $this->_appinfo['login_logo_size'] ?>">
 						</div>
 						<div class="col-auto">
 							<input disabled type="number" id="number-size-logo-login" class="form-control w-8" value="<?php echo $this->_appinfo['login_logo_size'] ?>">
 						</div>
 					</div>
 				</div>



 				<div class="form-group">
 					<label>Title Box Login</label>
 					<div class="input-icon">
 						<span class="input-icon-addon">
 							<i class="fe fe-edit-3"></i>
 						</span>
 						<input type="text" class="form-control focus-color text-blue data-sending" id="login_title_box" name="login_title_box" value="<?php echo $this->_appinfo['login_title_box'] ?>">
 					</div>
 				</div>

 				<div class="form-group">
 					<label>Label User</label>
 					<div class="input-icon">
 						<span class="input-icon-addon">
 							<i class="fe fe-edit-3"></i>
 						</span>
 						<input type="text" class="form-control focus-color text-blue data-sending" id="login_label_user" name="login_label_user" value="<?php echo $this->_appinfo['login_label_user'] ?>">
 					</div>
 				</div>

 				<div class="form-group">
 					<label>Label Password</label>
 					<div class="input-icon">
 						<span class="input-icon-addon">
 							<i class="fe fe-edit-3"></i>
 						</span>
 						<input type="text" class="form-control focus-color text-blue data-sending" id="login_label_password" name="login_label_password" value="<?php echo $this->_appinfo['login_label_password'] ?>">
 					</div>
 				</div>

 				<div class="form-group">
 					<label>Label Button</label>
 					<div class="input-icon">
 						<span class="input-icon-addon">
 							<i class="fe fe-edit-3"></i>
 						</span>
 						<input type="text" class="form-control focus-color text-blue data-sending" id="login_label_button" name="login_label_button" value="<?php echo $this->_appinfo['login_label_button'] ?>">
 					</div>
 				</div>

 				<div class="form-group text-right">
 					<a href="javascript:void(0)" onclick="updateLoginSetting()" class="btn btn-success">simpan</a>
 				</div>



 			</form>
 		</div>

 	</div>
 </div>



 <div class="col-md-12 col-xl-12">
 	<div class="panel panel-danger" id="panel-form-utama">
 		<div class="panel-heading">Halaman Utama</div>
 		<div class="panel-body">
 			<form id="form-utama">

 				<div class="form-group">
 					<label>Title Bar</label>
 					<div class="input-icon">
 						<span class="input-icon-addon">
 							<i class="fe fe-edit-3"></i>
 						</span>
 						<input id="template_title_bar" name="template_title_bar" type="text" class="form-control focus-color data-sending" value="<?php echo $this->_appinfo['template_title_bar'] ?>">
 					</div>
 				</div>

 				<div class="form-group">
 					<label>Logo</label>
 					<!--<div class="form-label ">Upload File Template</div>-->
 					<div class="custom-file ">
 						<input type="file" class="custom-file-input " id="file-template-logo" name="file">
 						<label class="custom-file-label form-control" id="template_logo_name">Choose file</label>
 					</div>

 				</div>

 				<div class="form-group">
 					<div class="text-center mb-6">
 						<img id="template_logo" src="<?php echo base_url('api/Public_Access/get_logo_template') ?>" class="h-<?php echo $this->_appinfo['template_logo_size'] ?> fontlogo" alt="">
 					</div>
 				</div>

 				<div class="form-group">
 					<label class="form-label">Size Logo range ( 1 - 9 )</label>
 					<div class="row align-items-center">
 						<div class="col">
 							<input id="template_logo_size" name="template_logo_size" type="range" class="form-control custom-range data-sending" step="1" min="1" max="9" value="<?php echo $this->_appinfo['template_logo_size'] ?>">
 						</div>
 						<div class="col-auto">
 							<input disabled type="number" id="number-size-logo-template" class="form-control w-8" value="<?php echo $this->_appinfo['template_logo_size'] ?>">
 						</div>
 					</div>
 				</div>




 				<div class="form-group">
 					<label>Footer Left</label>
 					<div class="input-icon">
 						<textarea id="text-footer-left" name="template_footer_left" class="form-control bg-dark text-white data-sending" rows="3"></textarea>
 					</div>
 					<code class="text-danger">note : jangan menggunakan tanda kutip satu <b> ' </b> , dan jangan menggunakan enter </code>
 				</div>


 				<div class="form-group">
 					<label>Footer Right</label>
 					<div class="input-icon">
 						<textarea id="text-footer-right" name="template_footer_right" class="form-control bg-dark text-white data-sending" rows="3"></textarea>
 					</div>
 					<code class="text-danger">note : jangan menggunakan tanda kutip satu <b> ' </b> , dan jangan menggunakan enter </code>
 				</div>

 				<div class="form-group text-right">
 					<a href="javascript:void(0)" onclick="updateTemplateSetting()" class="btn btn-success">simpan</a>
 				</div>

 			</form>
 		</div>
 	</div>



 </div>




 <div class="col-md-12 col-xl-12">
 	<div class="panel panel-danger" id="panel-style-login">
 		<div class="panel-heading">Style Login</div>
 		<div class="panel-body">
 			<form id="form-utama">

 				<div class="row gutters-sm">
 					<div class="col-6 col-sm-4">
 						<label class="imagecheck mb-4">
 							<input name="imagecheck" id="style1" type="checkbox" value="Style1" class="imagecheck-input" />
 							<figure class="imagecheck-figure">
 								<img src="<?php echo base_url() ?>images/login/style1.png" alt="}" class="imagecheck-image">
 							</figure>
 						</label>
 					</div>
 					<div class="col-6 col-sm-4">
 						<label class="imagecheck mb-4">
 							<input name="imagecheck" id="style2" type="checkbox" value="Style2" class="imagecheck-input" />
 							<figure class="imagecheck-figure">
 								<img src="<?php echo base_url() ?>images/login/style2.png" alt="}" class="imagecheck-image">
 							</figure>
 						</label>
 					</div>

 				</div>

 			</form>
 		</div>
 	</div>



 </div>


 <script>
 	$('#text-footer-right').val('<?php echo $this->_appinfo['template_footer_right'] ?>');
 	$('#text-footer-left').val('<?php echo $this->_appinfo['template_footer_left'] ?>');
 </script>



 <script>
 	$(".imagecheck-input").click(function() {
 		$(".imagecheck-input").prop('checked', false);
 		$(this).prop('checked', true);
 		setLoginStyle($(this).val());
 	});


 	function setLoginStyle(value) {
 		var d = get_json_format('login_style', value);
 		data_sending = ybs_dataSending([d]);
 		var a = new ybsRequest();
 		a.process("<?php echo $link_set_login_style ?>", data_sending, "POST");
 	}


 	$(document).ready(function() {
 		clear_temp_upload();
 		$("#panel-form-login").show();
 		$("#panel-form-utama").hide();
 		$("#panel-style-login").hide();

 		$(".selectgroup-input").change(function() {
 			if ($(this).val() == "1") {
 				$("#panel-form-login").show();
 				$("#panel-form-utama").hide();
 				$("#panel-style-login").hide();
 			} else if ($(this).val() == "2") {
 				$("#panel-form-login").hide();
 				$("#panel-form-utama").show();
 				$("#panel-style-login").hide();
 			} else {
 				$("#panel-form-login").hide();
 				$("#panel-form-utama").hide();
 				$("#panel-style-login").show();
 			}
 		});

 		$('#inputfile').change(function() {
 			prepare_logo_login();
 		});

 		$('#file-template-logo').change(function() {
 			prepare_template_logo();
 		});


 		$("#login_logo_size").change(function() {
 			var a = $("#login_logo_size").val();
 			$("#number-size-logo-login").val(a);
 			remove_class_h("#logo-login");
 			$("#logo-login").addClass("h-" + a);
 		});

 		$("#template_logo_size").change(function() {
 			var a = $("#template_logo_size").val();
 			$("#number-size-logo-template").val(a);
 			remove_class_h("#template_logo");
 			$("#template_logo").addClass("h-" + a);
 		});




 		//style-login


 		$.each($(".imagecheck-input"), function() {
 			var style = "<?php echo $this->_appinfo['login_style'] ?>";
 			if ($(this).val() == style) {
 				$(this).prop("checked", true);
 			}
 		})


 	});

 	function remove_class_h(id) {
 		var x = 1;
 		for (x = 1; x <= 9; x++) {
 			$(id).removeClass("h-" + x);
 		}

 	}


 	var logo_login_post = "";
 	var ext_logo_login = "";

 	function prepare_logo_login() {
 		var a = new ybsRequest();
 		//upload file ke folder temp
 		a.processUploadFile("form-login", 'none', "false");
 		a.onSuccess = function(data) {
 			//menampilkan nama file yang baru di upload
 			$("#logo-login-name").text(data.orig_name);

 			//mendapatkan extension file yg baru di upload
 			ext_logo_login = data.ext;

 			//menampilkan file yang baru di upload pada img
 			logo_login_post = data.time_post;
 			set_preview(logo_login_post, "#logo-login");
 		}
 	}



 	var template_logo_post = "";
 	var ext_template_logo = "";

 	function prepare_template_logo() {
 		var a = new ybsRequest();
 		//upload file ke folder temp
 		a.processUploadFile("form-utama", "none", "false");
 		a.onSuccess = function(data) {
 			$("#template_logo_name").text(data.orig_name);
 			//mendapatkan extension file yg baru di upload
 			ext_template_logo = data.ext;

 			//menampilkan file yang baru di upload pada img
 			template_logo_post = data.time_post;
 			set_preview(template_logo_post, "#template_logo");
 		}
 	}


 	function set_preview(time_post, id_element) {
 		//menggunakan object dropzone_result untuk mengakses folder temp
 		//berdasarkan timepost
 		var a = new dropzone_result(time_post, 'temp');
 		a.onComplite = function(data) {
 			var b = JSON.parse(data.message);
 			$.each(b, function(k, y) {
 				$(id_element).attr("src", y.link);
 			})
 		}
 	}

 	function updateLoginSetting() {
 		var data = get_dataSending('form-login');
 		var t = get_json_format('login_logo', logo_login_post);
 		var ex = get_json_format('ext', ext_logo_login);
 		data.push(t);
 		data.push(ex);
 		data_sending = ybs_dataSending(data);
 		var a = new ybsRequest();
 		a.process("<?php echo $link_update_login_setting ?>", data_sending, "POST");
 	}

 	function updateTemplateSetting() {
 		var data = get_dataSending('form-utama');
 		var t = get_json_format('template_logo', template_logo_post);
 		var ex = get_json_format('ext', ext_template_logo);
 		data.push(t);
 		data.push(ex);
 		data_sending = ybs_dataSending(data);
 		var a = new ybsRequest();
 		a.process("<?php echo $link_update_template_setting ?>", data_sending, "POST");
 	}
 </script>