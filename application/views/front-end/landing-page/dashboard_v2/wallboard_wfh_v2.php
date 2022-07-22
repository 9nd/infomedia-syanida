<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // if ($start == $end) {
    ?>
        <!-- <meta http-equiv="refresh" content="300"> -->
    <?php
    // }
    ?>
 <meta http-equiv="refresh" content="300">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>Profiling - WALLBOARD</title>
    <script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
    <script>
        var data_token = "<?php echo  $this->_token ?>";
        var sec_val = "<?php echo $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() ?>&";
        var xax = "<?php echo $fparent ?>"
    </script>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fw/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/tabler/bower_components/Ionicons/css/ionicons.min.css" />

</head>

<!-- <body style="background-color:#202938;color:#efeef0; font-family:'Open Sans',Helvetica,Arial,sans-serif;"> -->

<body style="background-color:#202938;color:#efeef0; font-family:Arial, Helvetica, sans-serif;">
   
<?php
$report->render();

?>

    <script id="src_ybs" src="<?php echo base_url() ?>assets/ybs.js"></script>
    
</body>

</html>