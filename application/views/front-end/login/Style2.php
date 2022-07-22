<!DOCTYPE html>
<?php
/*
 =========================================================
 * Material Kit - v2.0.5
 =========================================================

 * Product Page: https://www.creative-tim.com/product/material-kit
 * Copyright 2019 Creative Tim (http://www.creative-tim.com)
   Licensed under MIT (https://github.com/creativetimofficial/material-kit/blob/master/LICENSE.md)


 =========================================================
 * ENGLISH	
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. 

 * INDONESIA
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus dimasukkan dalam semua salinan atau bagian penting Perangkat Lunak.
*/
?>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('api/Public_Access/get_logo_title_bar') ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url('api/Public_Access/get_logo_title_bar') ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo $this->_appinfo['login_title_bar'] ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <!-- CSS Files -->
  <link href="<?php echo base_url() ?>assets/front-end/material-kit/assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url() ?>assets/front-end/material-kit/assets/demo/demo.css" rel="stylesheet" />
</head>
<style>
  p {
    font-size: 12px;
    margin: 10px;
  }
</style>

<body class="login-page sidebar-collapse">
<div style="position:absolute;top:0; right:0; z-index: 2; ">
    <img src="<?php echo base_url();?>assets/images/logo_profilling.png" alt="" width="180px">
  </div>
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
     

    </div>
  </nav>
  <div class="page-header header-filter" style="background-image: url('<?php echo base_url() ?>assets/front-end/material-kit/assets/img/profile_city.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <?php echo form_open('auth', 'class="form"'); ?>

            <div class="card-header card-header-danger text-center">

              <h1 style="font-family: calibri;">Sy-ANIDA</h1>
 		<h8><i>System Analitics & Information Dashboard</i></h8>

            </div>
            <div class="text-center mb-6">
              <br>
              <img width="100px" src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="h-<?php echo $this->_appinfo['login_logo_size'] ?> fontlogo" alt="">
            </div>
            <div class="card-body">

              <div class="input-group">

                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <!-- <i class="material-icons">face</i> -->
                  </span>
                </div>
                <?php
                echo _create_random_div()
                ?>

                <input type="text" class="form-control" placeholder="<?php echo $this->_appinfo['login_label_user'] ?>" id="cd\ #?';/\%&<?php echo $element_name_iduser ?> .body.form-control" name="<?php echo $element_name_iduser ?>" value="<?php echo set_value($this->_old_label_name); ?>">

              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <!-- <i class="material-icons">lock_outline</i> -->
                  </span>
                </div>
                <?php
                echo _create_random_div()
                ?>
                <input type="password" autocomplete="current-password" class="form-control" placeholder="<?php echo $this->_appinfo['login_label_password'] ?>..." id="cd\ #?';/\%&<?php echo $element_name_password ?> .body.form-control" name="<?php echo $element_name_password ?>" value="<?php echo set_value($this->_old_label_pass); ?>">
              </div>
            </div>
              <br>
              <br>
              <br>
            <div class="footer text-center">
              <small> <span class="text-danger"><?php echo form_error($this->_old_label_name); ?></span> </small>
              <small> <span class="text-danger" id='label_error_bottom'><?php echo form_error($this->_old_label_pass); ?></span> </small>
              <button type="submit" id="cd\ #?';/\%& .body.form-control" class="btn btn-danger btn-block"><?php echo $this->_appinfo['login_label_button'] ?></button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url() ?>assets/front-end/material-kit/assets/js/material-kit.js" type="text/javascript"></script>

  <script src="<?php echo base_url() ?>assets/ybs.min.js"></script>

  <script>
    $(document).ready(function() {


      var data_error = "<?php echo $this->session->flashdata('auth_login') ?>";
      if (data_error !== "") {
        $('#label_error_bottom').append("<p>" + data_error + "</p>");
      }

    })
  </script>

</body>

</html>