<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <title>YBS Pages</title>
	<!-- first load script -->	
	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script>var data_token 	= "<?php echo  $this->_token?>";var sec_val="<?php echo  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()?>&";</script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" /> 
	
	 
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr-master/toastr.min.css"> 
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.css">	
	
	<script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>	
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
	<script src="<?php echo base_url() ?>assets/js/core.js"></script>
	<script src="<?php echo base_url()?>assets/toastr-master/toastr.js"></script>

	
   
    
	

  </head>
  <body>
  <!-- sidebar menu belum selesai-->
  <div id="container-sidebar" class="open-container">
  <div id="sidebar" class="">
	<a id="btn-container"><!--&#10094;--></a>
	<ul id="sidebar-nav">
			<div id="sidebar-header" class="header py-4">
			<div class="container">
			  <span class="logo-mini">YBS</span>
			  <span class="logo-lg"><b>YBS</b> System</span>
				 <a class="header-brand" href="#sidebar-btn-header"  id="sidebar-btn-header">
					&#9776;
				  </a>
			</div>
			</div>	
	
			<li>
				<div id="sidebar-search">
				<form><input type="search" class="form-control header-search focus-color" placeholder="kode form" tabindex="1"></form>
				</div>
			</li>
			
			
			<li>
				
				<a class="menu-item" href="#">
					<i class="fe fe-home"></i>
					<span class="title-item">Home</span>
					<span class="pull-right-container title-item">
					  <i class="fa fa-angle-left right-icon"></i>
					</span>
				</a>
				
				<ul class="sub-item">
					<li><a href="#"><i class="fe fe-user"></i><span>Pengaturan</span></a></li>
					
					<li>
						<a class="menu-item" href="#"><i class="fe fe-airplay">
						</i><span>Sub menu</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left right-icon"></i>
						</span>
						</a>
						
						<ul class="sub-item">
							<li><a href="#"><i class="fe fe-user"></i><span>1Pengaturan</span></a></li>
							<li>
							<a class="menu-item"  href="#">
							<i class="fe fe-airplay"></i>
							<span>2Pengaturan</span>
							<span class="pull-right-container">
							  <i class="fa fa-angle-left right-icon"></i>
							</span>
							
							</a>
							
							<ul class="sub-item">
								<li><a href="#"><i class="fe fe-user"></i><span>1Pengaturan</span></a></li>
								<li><a href="#"><i class="fe fe-airplay"></i><span>2Pengaturan</span></a></li>
								<li><a href="#"><i class="fe fe-airplay"></i><span>3Pengaturan</span></a></li>
								<li><a href="#"><i class="fe fe-airplay"></i><span>4Pengaturan</span></a></li>
							</ul>
							
							
							</li>
							
							<li><a href="#"><i class="fe fe-airplay"></i><span>3Pengaturan</span></a></li>
							<li><a href="#"><i class="fe fe-airplay"></i><span>4Pengaturan</span></a></li>
						</ul>
						
					</li>					
					<li><a href="#"><i class="fe fe-airplay"></i><span>Pengaturan</span></a></li>
				</ul>
			</li>
			
			<li>
				<a class="menu-item" href="#"><i class="fe fe-box"></i><span>Box</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left right-icon"></i>
						</span>
				</a>
			</li>
			<li>
				 <a href="#"><i class="fe fe-lock"></i><span>Gembok</span></a>
			</li>
			<li>
				 <a class="menu-item" href="#">
					<i class="fe fe-user"></i>
					<span>Pengguna</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left right-icon"></i>
					</span>
				 </a>
			
				 <ul class="sub-item">
					<li><a href="#"><i class="fe fe-user"></i><span>1Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>2Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>3Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>4Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>5Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-user"></i><span>6Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>7Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>8Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>9Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>10Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-user"></i><span>1Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>2Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>3Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>4Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>5Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-user"></i><span>6Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>7Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>8Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>9Pengaturan</span></a></li>
					<li><a href="#"><i class="fe fe-airplay"></i><span>10Pengaturan</span></a></li>
					
					
				</ul>
			</li>
    </ul>
</div>
<div id="">
    <div class="container-fluid">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
			 
			 
              <a class="header-brand" href="javascript:void(0)">
                <img src="<?php echo base_url() ?>images/logo/logo.svg" class="header-brand-img"  alt="ybs logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <!--<div class="nav-item d-none d-md-flex">
                  <a href="https://github.com/tabler/tabler" class="btn btn-sm btn-outline-primary" target="_blank">Original Source code</a>
                </div>-->
				
				<!-- menu notify belum selesai-->
				<!--
				<div class="dropdown d-none d-md-flex">
                  <a href="<?php echo site_url()?>sistem/message" class="nav-link icon icon-shake-jump" >
                    <i class="fe fe-mail "> </i>
                    <span class="nav-unread-message ">90</span>
                  </a>
				   
                </div>-->
				<!-- end menu motify -->
				
				
				<!-- menu notify  belum selesai-->
				<!--
				<div class="dropdown d-none d-md-flex">
                  <a class="nav-link icon icon-shake-bell" data-toggle="dropdown">
                    <i class="fe fe-bell "> </i>
                    <span class=""></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                      <div>
                        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                        <div class="small text-muted">10 minutes ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                      <div>
                        <strong>Alice</strong> started new task: Tabler UI design.
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                      <div>
                        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                        <div class="small text-muted">2 hours ago</div>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
                  </div>
                </div>-->
				
				
				<!-- end menu motify -->
			  
			  
			  
			  
			  
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar ybs-image-slider" data-image="<?php echo $this->_user_name?>" src="<?php echo base_url().'images/user_profile/'.$this->_user_picture ?>" style="background-image: url(<?php echo base_url().'images/user_profile/'.$this->_user_picture ?>);"></span>
					
				   <span class="ml-2 d-none d-lg-block">
                      <span class="text-default"><?php echo $this->_user_name?></span>
                      <small class="text-muted d-block mt-1"><?php echo $this->_user_level_name?></small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <!--<a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>-->
					   <a class="dropdown-item" href="<?php echo site_url()?>sistem/profile/setting">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="<?php echo site_url()?>/sistem/logout">
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
               <!-- <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search focus-color" placeholder="kode form" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>-->
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
				
				<?php echo $menu?>
				
                </ul>
              </div>
            </div>
          </div>
      </div>
  
		<div class="my-3 my-md-5">
			<div class="container">
				 <div class='page-header'>
					<p class='page-title'><?php echo $title_page_big?> </p>
				 </div>
				
 				 <div class="container">
					 <div class='row row-cards'>	
						<?php  echo $content_body; ?>
					 </div>
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
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                    <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                  </ul>
                </div>
                <div class="col-auto">
                  <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Original Source code</a>
                </div>
				
				
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2018 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
            </div>
          </div>
        </div>
		 <div class="content-general">
		<!--berfungsi melakukan redirect dengan ajax halaman-->
		<form id="redirect-form" action="#" method="post" accept-charset="utf-8">
		<button hidden id="redirect-button" type="submit" ></button>
		</form>

		<audio id="sound_click">
		<source src="<?php echo base_url('sound/click.wav') ?>"  type="audio/mpeg" >  
		</audio>

		<audio id="sound_entered">
		<source src="<?php echo base_url('sound/entered.wav') ?>"  type="audio/mpeg" >  
		</audio>
			
		<audio id="sound_apply">
		<source src="<?php echo base_url('sound/apply.wav') ?>"  type="audio/mpeg" >  
		</audio>
			
		<audio id="sound_success">
		<source src="<?php echo base_url('sound/success.wav') ?>"  type="audio/mpeg" >  
		</audio>

		<audio id="sound_failed">
		<source src="<?php echo base_url('sound/failed.wav') ?>"  type="audio/mpeg" >  
		</audio>	

		
			
			
			<div id='general-helper'>
			<p id="test_time"></p>
			<!-- popup Message Delete -->
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
				<a href="#" class="btn btn-outline-light" title="delete" id="button_konfirm_delete"  data-dismiss="modal"><i class="fa fa-trash-o"></i><span> Hapus</span></a>
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
	<script  src="<?php echo base_url()?>assets/ybs-slider/ybs-slider.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/input-mask/js/jquery.mask.min.js"></script>
	<script>
		
		$(document).ready(function(){
			var data_error  	=  "<?php  echo $this->session->flashdata('auth_form') ?>";
			var data_success 	= "<?php echo $this->session->flashdata('redirect_success') ?>";
			var data_failed  	= "<?php echo $this->session->flashdata('redirect_failed') ?>";
			var data_warning 	= "<?php echo $this->session->flashdata('redirect_warning') ?>";
			
			
			if(data_error !==""){
				show_error_message(data_error);	
				play_sound_failed();				
			}
			if(data_success !==""){
				show_success_message(data_success);	
				play_sound_success();				
			}
			if(data_failed!==""){
				show_error_message(data_failed);	
				play_sound_failed();				
			}
			if(data_warning!==""){
				show_warning_message(data_warning);	
				play_sound_failed();				
			}
			
			$('#ybs-dash').click(function(){
					var select='0';
					if($('#ybs-dash').hasClass('text-dark')){
						$('#ybs-dash').removeClass('text-dark');
						$('#ybs-dash').addClass('text-orange');
						select = '1';
					}else{
						$('#ybs-dash').removeClass('text-orange');
						$('#ybs-dash').addClass('text-dark');	
						select='0';
					}
					var y = get_json_format('idform',"<?php echo $this->_user_form_id?>");
					var z = get_json_format('select',select);
					send_data = ybs_dataSending([y,z]);
					var a = new ybsRequest();
					a.loadingIn = function(){
						return '';
					}
					a.process("<?php echo site_url('sistem/sys_dashboard/change/').$this->_token?>",send_data,'POST');
			});
		});
		
		$(window).resize(function() {
			clearTimeout(window.resizedFinished);
			window.resizedFinished = setTimeout(function(){
				  refresh_content_template();
			}, 400);
		});
		 
		$("a.sidebar-toggle").click(function(){
			  $('body').one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(event) {
				   refresh_content_template();
			  });
		});

		function refresh_content_template(){
			try{
				$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust().responsive.recalc();
			}catch(err){
				
			}
			
		}
		

	</script>
	</section>
	    </div>
</div>
</div>
  </body>
</html>