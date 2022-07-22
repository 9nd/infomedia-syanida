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
    <title><?php echo $this->_appinfo['login_title_bar']?></title>
	<link href="<?php echo base_url() ?>assets/css/dashboard.css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png')?>">
	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	
	<script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>

	
	<script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
	<script src="<?php echo base_url() ?>assets/js/core.js"></script>

    <!-- Dashboard Core -->
  
 
  </head>
  <body class="" style="background-color:#00A471;background-image: url(<?php echo base_url();?>assets/images/login-images/asd.png);">
    <div class="page">
	
      <div class="page-single" >
        <div class="container">
		
          <div class="row">
            <div class="col col-login mx-auto" >
              <div class="text-center mb-6">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login')?>" class="h-<?php echo $this->_appinfo['login_logo_size']?> fontlogo" alt="">
              </div>
               <?php echo form_open('auth'); ?> 
			   <input type="hidden" name="" value="">
			   <div class='card'>
                <div class="card-body p-6">
					<?php  //create random div menghentikan brute force attack yang melakukan injeksi  melalui posisi element
							echo _create_random_div()
					?>	
                  <div class="card-title" style="text-align: center;"><?php echo $this->_appinfo['login_title_box']?></div>
					<div class="form-group">
					  <label class="form-label">
                      <?php echo $this->_appinfo['login_label_user']?>

                    </label>
						<?php  //create id random menghentikan brute force attack yang melakukan injeksi  melalui element id
							   //create name random	menghentikan brute force attack yang melakukan injeksi  melalui element name,dan mencegah percobaan request dari luar sistem
						?>	
						<input type="text" autocomplete="current-password" id="cd\ #?';/\%&<?php echo $element_name_iduser ?> .body.form-control" class="form-control focus-color" placeholder="nama pengguna" name="<?php echo $element_name_iduser ?>"  value="<?php echo set_value($this->_old_label_name); ?>"  >
						<div class="form-group">
							<small> <span class="text-red"><?php echo form_error($this->_old_label_name); ?></span> </small>
						</div>
					</div>
                  <div class="form-group">
                    <label class="form-label">
                        <?php echo $this->_appinfo['login_label_password']?>

                    </label>
                    <input type="password" autocomplete="current-password" id="cd\ #?';/\%&<?php echo $element_name_password ?> .body.form-control" class="form-control focus-color" placeholder="sandi"  name="<?php echo $element_name_password ?>" value="<?php echo set_value($this->_old_label_pass); ?>" >
						<div class="form-group">
							<small> <span class="text-red" id='label_error_bottom'><?php echo form_error($this->_old_label_pass); ?></span> </small>
						</div>
                  </div>

                  <div class="form-footer">
                    <button type="submit" id="cd\ #?';/\%& .body.form-control" class="btn btn-primary btn-block"><?php echo $this->_appinfo['login_label_button']?></button>
				 </div>
                </div>
				
				</div>
              </form>
		
            </div>
			
          </div>
        </div>
      </div>
    </div>
	
	<script src="<?php echo base_url() ?>assets/ybs.min.js"></script>
	
	<script>
	
		$(document).ready(function () {

		
		var data_error = "<?php echo $this->session->flashdata('auth_login') ?>";
			if(data_error !==""){
				$('#label_error_bottom').text(data_error);				
			}
	
		})
	


		  
</script>
  </body>
  

</html>