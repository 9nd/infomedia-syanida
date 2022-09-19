<!doctype html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#4188c9">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<title><?php echo $this->_appinfo['template_title_bar'] ?></title>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	-->

	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script>
		var data_token = "<?php echo  $this->_token ?>";
		var sec_val = "<?php echo $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() ?>&";
		var xax = "<?php echo $fparent ?>"
	</script>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fw/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/tabler/bower_components/Ionicons/css/ionicons.min.css" />

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr-master/toastr.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.css">

	<script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
	<script src="<?php echo base_url() ?>assets/js/core.js"></script>
	<script src="<?php echo base_url() ?>assets/toastr-master/toastr.js"></script>


	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.css" />
	<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Resources/MooTools-Core-1.6.0.js"></script>


	<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.js"></script>
	<meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-language="javascript" data-indent="2" data-selector-block="pre" data-selector-inline="code" />
	<style type="text/css">
		/* custom hover effect using specific css class */
		.EnlighterJS.myHoverClass li:hover {
			background-color: #c0c0c0;
		}
	</style>



</head>

<body class="">
	<div class="page">
		<div class="page-main">
			<div class="header py-4">
				<div class="container">
					<div class="d-flex">

						<a class="header-brand" href="javascript:void(0)">
							<img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">
						</a>

						<div class="d-flex order-lg-2 ml-auto">

							<!-- menu notify -->

							<?php echo $menu_notify_security ?>

							<!-- end menu motify -->





							<div class="dropdown">
								<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
									<span class="avatar ybs-image-slider" data-image="<?php echo $this->_user_name ?>" src="<?php echo base_url() . 'YbsService/get_picture_profile/' . $this->_token ?>" style="background-image: url(<?php echo base_url() . 'YbsService/get_picture_profile/' . $this->_token ?>);"></span>

									<span class="ml-2 d-none d-lg-block">
										<span class="text-default"><?php echo $this->_user_name ?></span>
										<small class="text-muted d-block mt-1"><?php echo $this->_user_level_name ?></small>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

									<a class="dropdown-item" href="<?php echo site_url() ?>sistem/profile/setting">
										<i class="dropdown-icon fe fe-settings"></i> Settings
									</a>
									<a class="dropdown-item" href="<?php echo site_url() ?>sistem/profile/profile">
										<i class="dropdown-icon fe fe-user"></i> Profile
									</a>
									<a class="dropdown-item" href="<?php echo site_url() ?>/sistem/logout">
										<i class="dropdown-icon fe fe-log-out"></i> Logout
									</a>
								</div>
							</div>
						</div>
						<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
							<span class="header-toggler-icon"></span>
						</a>
					</div>
				</div>
			</div>
			<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-3 ml-auto">

						</div>
						<div class="col-lg order-lg-first">
							<ul class="nav nav-tabs border-0 flex-column flex-lg-row">

								<?php echo $menu ?>

							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="my-3 my-md-5">
				<div class="container">

					<div class='page-header'>
						<p class='page-title'><?php echo ucwords(strtolower($title_page_big)) ?> </p>

					</div>

					<div id="loading-page" class="">
						<div></div>
						<div></div>
						<div></div>
					</div>
					<div class='row' style="display:none" id="content-body">
						<!--row-card-->


						<?php echo $content_body; ?>
					</div>


				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="row align-items-center flex-row-reverse">
					<div class="col-auto ml-lg-auto">
						<div class="row align-items-center">
							<div class="col-auto">
								<?php echo $this->_appinfo['template_footer_right'] ?>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
						<?php echo $this->_appinfo['template_footer_left'] ?>
					</div>
				</div>
			</div>
			<div class="content-general">
				<?php //berfungsi melakukan redirect dengan ajax halaman 
				?>
				<form id="redirect-form" action="#" method="post" accept-charset="utf-8">
					<input id="redirect-form-tk" type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="">
					<button hidden id="redirect-button" type="submit"></button>
				</form>

				<audio id="sound_click">
					<source src="<?php echo base_url('sound/click.wav') ?>" type="audio/mpeg">
				</audio>

				<audio id="sound_entered">
					<source src="<?php echo base_url('sound/entered.wav') ?>" type="audio/mpeg">
				</audio>

				<audio id="sound_apply">
					<source src="<?php echo base_url('sound/apply.wav') ?>" type="audio/mpeg">
				</audio>

				<audio id="sound_success">
					<source src="<?php echo base_url('sound/success.wav') ?>" type="audio/mpeg">
				</audio>

				<audio id="sound_failed">
					<source src="<?php echo base_url('sound/failed.wav') ?>" type="audio/mpeg">
				</audio>




				<div id='general-helper'>
					<p id="test_time"></p>
					<?php //popup Message Delete 
					?>
					<div class="modal modal-danger fade" id="modal-danger">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Konfirmasi Penghapusan Data</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									</button>

								</div>

								<div class="modal-body">
									<p>Data yang akan di hapus :</p>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-outline-light pull-left" data-dismiss="modal"> Batal</button>
									<a href="#" class="btn btn-outline-light" title="delete" id="button_konfirm_delete" data-dismiss="modal"><i class="fa fa-trash-o"></i><span> Hapus</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>

		</footer>
	</div>
	<section id="section_script">

		<script id="src_ybs" src="<?php echo base_url() ?>assets/ybs.js"></script>
		<script src="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/input-mask/js/jquery.mask.min.js"></script>
		<script>
			$(window).on("load", function() {
				if (!$('#content-body').hasClass("fadeIn")) {
					$('#content-body').addClass("slideUp");

				}

				$('#content-body').css('display', 'flex');
				clearTimeout(window.resizedFinished);
				window.resizedFinished = setTimeout(function() {
					refresh_content_template();
				}, 400);
			});

			$(document).ready(function() {
				//	$('#loading-page').addClass("lds-facebook");
				var data_error = "<?php echo $this->session->flashdata('auth_form') ?>";
				var data_success = "<?php echo $this->session->flashdata('redirect_success') ?>";
				var data_failed = "<?php echo $this->session->flashdata('redirect_failed') ?>";
				var data_warning = "<?php echo $this->session->flashdata('redirect_warning') ?>";


				if (data_error !== "") {
					show_error_message(data_error);
					play_sound_failed();
				}
				if (data_success !== "") {
					show_success_message(data_success);
					play_sound_success();
				}
				if (data_failed !== "") {
					show_error_message(data_failed);
					play_sound_failed();
				}
				if (data_warning !== "") {
					show_warning_message(data_warning);
					play_sound_failed();
				}

				$('#ybs-dash').click(function() {
					var select = '0';
					if ($('#ybs-dash').hasClass('dash-unselect')) {
						$('#ybs-dash').removeClass('dash-unselect');
						$('#ybs-dash').addClass('dash-select');
						select = '1';
					} else {
						$('#ybs-dash').removeClass('dash-select');
						$('#ybs-dash').addClass('dash-unselect');
						select = '0';
					}
					var y = get_json_format('idform', "<?php echo $this->_user_form_id ?>");
					var z = get_json_format('select', select);
					send_data = ybs_dataSending([y, z]);
					var a = new ybsRequest();
					a.loadingIn = function() {
						return '';
					}
					a.process("<?php echo site_url('sistem/sys_dashboard/change/') . $this->_token ?>", send_data, 'POST');
				});
			});

			$(window).resize(function() {

				clearTimeout(window.resizedFinished);
				window.resizedFinished = setTimeout(function() {
					refresh_content_template();
				}, 400);
			});

			$("a.sidebar-toggle").click(function() {
				$('body').one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(event) {
					refresh_content_template();
				});
			});

			function refresh_content_template() {
				try {

					$.fn.dataTable.tables({
						visible: true,
						api: true
					}).columns.adjust().responsive.recalc();
				} catch (err) {

				}

			}
		</script>
	</section>
</body>

</html>