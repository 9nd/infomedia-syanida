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
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
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
  <!-- <div style="position:absolute;top:0; right:0; z-index: 2; ">
    <img width="180px" src="<?php echo base_url(); ?>assets/images/logo_profilling.png" alt="">
  </div> -->

  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">

      <div class="navbar-translate">
        <a class="navbar-brand" href="https://demos.creative-tim.com/material-kit/index.html">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

    </div>
  </nav>

  <div class="page-header" style="background-image: url('<?php echo base_url() ?>assets/front-end/material-kit/assets/img/bg_login.jpg'); background-size: cover; background-position: top center;">

    <div class="container">


      <div class="row">

        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login" style="
          background-image: url('<?php echo base_url() ?>assets/front-end/material-kit/assets/img/bg_login.jpg'); background-size: cover; background-position: top center;
          border-radius: 40px;
          opacity: 1;
          filter: drop-shadow(3px 3px 3px #222);
          ">
            <?php echo form_open('auth', 'class="form"'); ?>

            <div style="border-radius: 50px;
  height: 75px;
  width: 250px;
  margin: auto;">


              <img style="border-radius: 30px;
  
  position:absolute;
  width: 70px;
  margin-left: auto;
margin-right: auto;
margin-top: 10px;
left: 0;
right: 0;
text-align: center;
filter: drop-shadow(2px 2px 2px #222);" src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="h-<?php echo $this->_appinfo['login_logo_size'] ?> fontlogo" alt="">
              <br>
              <h9 style="border-radius: 30px;
  
  position:absolute;
  width: 200px;
  margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
color: white;
margin-top: 70px;
 font-size: 10px;"><b>SYstem ANalitics & Information DAshboard</b></h9>

            </div>
            <div class="text-center mb-6">
              <br>
            </div>
            <div class="card-body" style="padding-left:20px; padding-right:20px;">

              <div class="input-group">


                <?php
                echo _create_random_div()
                ?>

                <input type="text" style="border-radius: 18px;
    background: #0092a1;
    padding: 20px; 
    width: 200px;
    height: 15px; color:white;" class="form-control" placeholder="<?php echo $this->_appinfo['login_label_user'] ?>" id="cd\ #?';/\%&<?php echo $element_name_iduser ?> .body.form-control" name="<?php echo $element_name_iduser ?>" value="<?php echo set_value($this->_old_label_name); ?>">

              </div>

              <div class="input-group">

                <?php
                echo _create_random_div()
                ?>
                <input type="password" style="border-radius: 18px;
    background: #0092a1;
    margin-top: -30px;
    padding: 20px; 
    width: 200px;
    height: 15px; color:white;" autocomplete="current-password" class="form-control" placeholder="<?php echo $this->_appinfo['login_label_password'] ?>..." id="cd\ #?';/\%&<?php echo $element_name_password ?> .body.form-control" name="<?php echo $element_name_password ?>" value="<?php echo set_value($this->_old_label_pass); ?>">
              </div>
              <button type="submit" id="cd\ #?';/\%& .body.form-control" class="btn pull-right" style="width: 60px; 
              opacity: 0.75; padding: 6px;background-color:white; color: black;"><b><?php echo $this->_appinfo['login_label_button'] ?></b></button>
              <br>
              <br>
              <img style="border-radius: 30px;
  
  position:absolute;
  width: 200px;
  margin-left: auto;
margin-right: auto;
left: 0;
right: 0;
text-align: center;
  margin-top: -70px;
  opacity: 1;" src="<?php echo base_url() ?>assets/front-end/material-kit/assets/img/infomed_white.png">
            </div>


            <div class="footer text-center">
              <small> <span class="text-danger"><?php echo form_error($this->_old_label_name); ?></span> </small>
              <small> <span class="text-danger" id='label_error_bottom'><?php echo form_error($this->_old_label_pass); ?></span> </small>
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
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
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