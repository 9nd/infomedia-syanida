<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lockscreen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_lte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_lte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_lte/dist/css/AdminLTE.min.css">
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">

        <!-- User name -->
        <div class="lockscreen-name"><?php echo $userdata->nama; ?></div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="<?php echo base_url() . 'YbsService/get_picture_profile/' . $this->_token ?>" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials" method="POST" action="<?php echo base_url(); ?>Lockscreen/login">
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="password">

                    <div class="input-group-btn">
                        <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                </div>
            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Masukkan Password Akun Anda Untuk Masuk Kembali
        </div>
        <?php
        if (isset($_GET['status'])) {
        ?>
            <div class="alert alert-icon alert-danger" role="alert">
                <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                <?php echo $_GET['status'];?>

            </div>
        <?php
        }
        ?>

        <div class="lockscreen-footer text-center">
            Copyright &copy; 2020 <br>
            All rights reserved
        </div>
    </div>
    <!-- /.center -->

    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/admin_lte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>assets/admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>