<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta http-equiv="refresh" content="300">
    <meta charset="UTF-8">
    <title>Profiling - WALLBOARD</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->
<?php
$thn = array("januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
$lap = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15');

?>

<body id="main-container" class="default dark horizontal-menu">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="index.html" class="horizontal-logo text-left">
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php echo  date("h:i A", strtotime($last_update->lup)); ?></span>
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>
                <form class="float-left d-none d-lg-block search-form">
                    <div class="form-group mb-0 position-relative">
                        Sy-ANIDA WALLBOARD PROFILING
                    </div>
                </form>
                <div class="navbar-right ml-auto h-100">

                    <div class="media">
                        <img src="<?php echo base_url(); ?>assets/new_theme/dist/images/logo2.png" alt="" class="d-flex img-fluid mt-1" width="150">
                    </div>

                </div>

            </nav>
        </div>
    </div>
    <!-- END: Header-->



    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">


            <!-- START: Card Data-->
            <div class="row">

                <div class="col-12 col-lg-3  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-12 d-block d-md-flex d-lg-block">
                                        <div class="card rounded-0 col-12 col-md-4 col-lg-12"  style='background-color:red;'>
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <i class="fas fa-address-card   card-liner-icon mt-2 text-white"></i>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title text-white" id="dapros">-</h2>
                                                        <h6 class="card-liner-subtitle text-white">DATA WAITLIST
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card rounded-0 col-12 col-md-4 col-lg-12" style='background-color:#ffc107;'>
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-3 align-self-center'>
                                                    <i class="fas fa-address-card   card-liner-icon mt-2 text-white"></i>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title text-white" id="wo">-</h2>
                                                        <h6 class="card-liner-subtitle text-white">DATA DISTRIBUTION
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card rounded-0 col-12 col-md-4 col-lg-12" style='background-color:green;'>
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <i class="fab fa-teamspeak  card-liner-icon mt-2 text-white"></i>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title text-white" id="callorder_reguler">-</h2>
                                                        <h6 class="card-liner-subtitle text-white">DATA CONSUME</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-3  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-md-12  col-lg-12 mt-3">
                                        <div class="p-2">

                                            <div class="d-flex mt-0">
                                                <div class="border-0 outline-badge-success w-100 p-3 rounded text-center">
                                                    <span class="h1 mb-0" id='verified_reguler'>-</span><br>
                                                    VERIFIED
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="border-0 outline-badge-info  w-50 p-3 rounded text-center">
                                                    <span class="h6 mb-0" id="hp_email_rate">-</span><br>
                                                    <span class="h6 mb-0" id='hp_email'>-</span>
                                                    <br>HP+EMAIL
                                                </div>
                                                <div class="border-0 outline-badge-warning w-50 p-3 rounded ml-2 text-center">
                                                    <span class="h6 mb-0" id="hp_only_rate">-</span><br>
                                                    <span class="h6 mb-0" id='hp_only'>-</span>
                                                    <br>HP ONLY
                                                </div>
                                            </div>
                                            <div class="d-flex  mt-4">
                                                <div class="media-body align-self-center ">
                                                    <span class="mb-0 h6 font-w-600">CONVERTION RATE</span><br>
                                                </div>
                                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0" id='convention_rate'>-</span></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3  mt-3">
                    <div class="card overflow-hidden mt-10">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <li class="p-2 border-bottom zoom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <h6 class="mb-0 ">Channel Payment</h6>
                                                <p class="mb-0 font-w-500 tx-s-12">BANK</p>
                                                <p class="mb-0 font-w-500 tx-s-12">ECOMMERCE</p>
                                                <p class="mb-0 font-w-500 tx-s-12">MINIMARKET</p>
                                                <p class="mb-0 font-w-500 tx-s-12">OFFICE</p>
                                                <p class="mb-0 font-w-500 tx-s-12">PSB</p>
                                                <p class="mb-0 font-w-500 tx-s-12">OTHERS</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-success">
                                                <p class="mb-0 font-w-500 tx-s-12">&nbsp;</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_bank">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_ecommerce">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_minimarket">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_office">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_psb">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_others">-</p>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom zoom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <h6 class="mb-0 ">Gender</h6>
                                                <p class="mb-0 font-w-500 tx-s-12">Men</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Women</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                <p class="mb-0 font-w-500 tx-s-12">&nbsp;</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="jk_l">-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="jk_p">-</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-2 border-bottom zoom">
                                        <div class="media d-flex w-100">
                                            <div class="media-body align-self-center pl-2">
                                                <h6 class="mb-0 ">Opsi Call</h6>
                                                <p class="mb-0 font-w-500 tx-s-12">Telepon Rumah</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Handphone</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Email</p>
                                                <p class="mb-0 font-w-500 tx-s-12">Chat</p>
                                            </div>
                                            <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                <p class="mb-0 font-w-500 tx-s-12">&nbsp;</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_1'>-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_2'>-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_3'>-</p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_4'>-</p>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-12 col-md-8  col-lg-3   mt-3">
                    <div class="card overflow-hidden mt-10">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <table class="table font-w-600 mb-0">
                                    <tbody>
                                        <tr class="zoom">
                                            <td>REG</td>
                                            <td> <img src="<?php echo base_url() . "assets/images/bronze.png" ?>" alt="Bronze" width="30px" height="30px">
                                            </td>
                                            <td> <img src="<?php echo base_url() . "assets/images/silver.png" ?>" alt="Silver" width="30px" height="30px">
                                            </td>
                                            <td> <img src="<?php echo base_url() . "assets/images/gold.png" ?>" alt="Gold" width="30px" height="30px">
                                            </td>
                                            <td> <img src="<?php echo base_url() . "assets/images/platinum.png" ?>" alt="Platinum" width="30px" height="30px">
                                            </td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>1</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_1_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_1_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_1_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_1_platinum">-</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>2</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_2_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_2_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_2_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_2_platinum">-</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>3</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_3_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_3_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_3_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_3_platinum">-</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>4</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_4_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_4_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_4_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_4_platinum">-</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>5</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_5_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_5_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_5_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_5_platinum">-</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>6</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_6_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_6_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_6_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_6_platinum">-</td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>7</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_7_bronze">-</td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_7_silver">-</td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_7_gold">-</td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_7_platinum">-</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        
                        <div class="col-6">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-unstyled">
                                            <li class="p-2 border-bottom zoom">
                                                <div class="media d-flex w-100">
                                                    <div class="media-body align-self-center pl-2">
                                                        <h6 class="mb-0 ">CONTACTED</h6>
                                                        <p class="mb-0 font-w-500 tx-s-12">Verified</p>
                                                        <p class="mb-0 font-w-500 tx-s-12">Decline</p>
                                                        <p class="mb-0 font-w-500 tx-s-12">Follow Up</p>
                                                    </div>
                                                    <div class="ml-auto my-auto font-weight-bold text-right text-success">
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted_verified">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted_decline">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted_followup">-</p>
                                                    </div>

                                                </div>
                                            </li>
                                            <li class="p-2 border-bottom zoom">
                                                <div class="media d-flex w-100">
                                                    <div class="media-body align-self-center pl-2">
                                                        <h6 class="mb-0 ">NOT CONTACTED</h6>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_1_text">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_2_text">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_3_text">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12">Others</p>
                                                    </div>
                                                    <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_1">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_2">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_3">-</p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_4">-</p>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-bottom-0   mt-3">
                                <div class="card-content border-bottom border-primary border-w-5">
                                    <div class="card-body p-2">
                                        <div class="d-flex">
                                            <table width="100%">
                                                <tr>
                                                    <td style="text-align:center;" width="33%">
                                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/default.png" ?>" alt="Agent" id="best_agent_foto_1" class="rounded-circle " width="65px" height="65px">

                                                    </td>
                                                    <td style="text-align:center;" width="33%">
                                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/default.png" ?>" alt="Agent" id="best_agent_foto_2" class="rounded-circle" width="65px" height="65px">

                                                    </td>
                                                    <td style="text-align:center;" width="33%">
                                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/default.png" ?>" alt="Agent" id="best_agent_foto_3" class="rounded-circle " width="65px" height="65px">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:center;" id="best_agent_num_1" width="33%">
                                                        -
                                                    </td>
                                                    <td style="text-align:center;" id="best_agent_num_2" width="33%">
                                                        -
                                                    </td>
                                                    <td style="text-align:center;" id="best_agent_num_3" width="33%">
                                                        -
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-primary text-white h-10">
                                <div class="card-body text-center p-1 d-flex">
                                    <div class="align-self-top text-center w-100">
                                        <h6 class="card-title mt-2">AGENT ONLINE</h6>
                                        <span class="h4">

                                            <?php
                                            if ($cache_monev_realtime['aval_num'] < 0) {
                                                echo 0;
                                            } else {
                                                echo $cache_monev_realtime['aval_num'];
                                            }
                                            ?></span>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="d-flex mt-3">
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded text-center"><span
                                            class=" mb-0">40</span><br>
                                        WFH
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0">60</span><br>
                                        WFO
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-12">
                                <div class="d-flex mt-3">
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['lunch']; ?></span><br>
                                        Lunch
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['idle_num']; ?></span><br>
                                        Idle
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mt-3">
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['toilet']; ?></span><br>
                                        Toilet
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0"><?php echo $cache_monev_realtime['pray']; ?></span><br>
                                        Pray
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card border-bottom-0  mt-3">
                                    <div class="card-content border-bottom border-primary border-w-5">
                                        <div class="card-body p-2">
                                            <div class="d-flex">
                                                <img src="<?php echo base_url() . "YbsService/get_foto_agent/" . $picture_leader_on_duty ?>" alt="author" class="rounded-circle  ml-auto" width="65px" height="65px">
                                                <div class="media-body align-self-center pl-3">
                                                    <span class="mb-0 font-w-600"><?php echo $nama_leader_on_duty ?></span><br>
                                                    <p class="mb-0 font-w-500 tx-s-12">DESK CONTROL</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6  mt-3">



                        </div>

                    </div>
                </div>


                <div class="col-12 col-md-8  col-lg-6">
                    <canvas id="chartjs-account-chart"></canvas>
                </div>

            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        2020 © Sy-ANIDA
    </footer>
    <!-- END: Footer-->



    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->


    <!-- START: Template JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script>
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- CUSTOM JS ---->
    <input type="hidden" id="agent_online_reg" value="0">
    <input type="hidden" id="agent_online_moss" value="0">
    <input type="hidden" id="daily_status" value="0">
    <input type="hidden" id="mos_status" value="0">
    <input type="hidden" id="reguler_status" value="0">
    <input type="hidden" id="grafik_status" value="0">
    <input type="hidden" id="best_agent_status" value="0">
    <script type="text/javascript">
        var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');




        function get_profiling_reguler() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_profiling_reguler" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    // $("#reguler_area").slideToggle();
                    
                    $("#dapros").text(response.dapros);
                    $("#wo").text(response.wo);
                    $("#agent_online").text(response.agent_online);
                    $("#contacted").text(response.contacted);
                    $("#hp_email").text(response.hp_email);
                    $("#hp_only").text(response.hp_only);
                    $("#connected_rate").text(response.contacted_rate + "%");
                    $("#verified_reguler").text(response.status_13);
                    $("#notcontacted").text(response.uncontacted);
                    $("#notcontacted_1").text(response.not.urut_0.valna);
                    $("#notcontacted_2").text(response.not.urut_1.valna);
                    $("#notcontacted_3").text(response.not.urut_2.valna);
                    $("#notcontacted_4").text(response.not.other);
                    $("#notcontacted_1_text").text(response.not.urut_0.textna);
                    $("#notcontacted_2_text").text(response.not.urut_1.textna);
                    $("#notcontacted_3_text").text(response.not.urut_2.textna);
                    $("#notconnected_rate").text(response.uncontacted_rate + "%");
                    $("#callorder_reguler").text(response.callorder);
                    $("#convention_rate").text(response.convention_rate + "%");
                    $("#1_reguler").text(response.status_1);
                    $("#2_reguler").text(response.status_2);
                    $("#3_reguler").text(response.status_3);
                    $("#4_reguler").text(response.status_4);
                    $("#5_reguler").text(response.status_5);
                    $("#6_reguler").text(response.status_6);
                    $("#7_reguler").text(response.status_7);
                    $("#8_reguler").text(response.status_8);
                    $("#9_reguler").text(response.status_9);
                    $("#10_reguler").text(response.status_10);
                    $("#11_reguler").text(response.status_11);
                    $("#12_reguler").text(response.status_12);
                    $("#contacted_verified").text(response.status_13);
                    $("#contacted_followup").text(response.status_12);
                    $("#contacted_decline").text(response.status_11);
                    $("#jk_l").text(response.jk.l);
                    $("#jk_p").text(response.jk.p);
                    $("#opsi_1").text(response.opsi.opsi_1);
                    $("#opsi_2").text(response.opsi.opsi_2);
                    $("#opsi_3").text(response.opsi.opsi_3);
                    $("#opsi_4").text(response.opsi.opsi_4);

                    $("#13_reguler").text(response.status_13);
                    $("#14_reguler").text(response.status_14);
                    $("#15_reguler").text(response.status_15);
                    $("#16_reguler").text(response.status_16);
                    // $("#payment_bank").text(response.payment.bank);
                    // $("#payment_ecommerce").text(response.payment.ecommerce);
                    // $("#payment_minimarket").text(response.payment.minimarket);
                    // $("#payment_office").text(response.payment.office);
                    // $("#payment_psb").text(response.payment.psb);
                    // $("#payment_others").text(response.payment.others);
                    $("#hp_only_rate").text(response.hp_only_rate + "%");
                    $("#hp_email_rate").text(response.hp_email_rate + "%");
                    <?php
                    for ($r = 1; $r <= 7; $r++) {
                        echo "$('#regional_" . $r . "_platinum').text(response.regional.platinum.reg_" . $r . ");";
                        echo "$('#regional_" . $r . "_silver').text(response.regional.silver.reg_" . $r . ");";
                        echo "$('#regional_" . $r . "_gold').text(response.regional.gold.reg_" . $r . ");";
                        echo "$('#regional_" . $r . "_bronze').text(response.regional.bronze.reg_" . $r . ");";
                    }
                    ?>
                    $("#best_agent_num_1").text(response.best_agent.numna_1);
                    $("#best_agent_num_2").text(response.best_agent.numna_2);
                    $("#best_agent_num_3").text(response.best_agent.numna_3);
                    $("#best_agent_foto_1").attr('src', "<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + response.best_agent.picture_1);
                    $("#best_agent_foto_2").attr('src', "<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + response.best_agent.picture_2);
                    $("#best_agent_foto_3").attr('src', "<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + response.best_agent.picture_3);

                    // document.getElementById("best_agent_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";

                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }
        function get_payment() {
            var start = $("#start").val();
            var end = $("#end").val();
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_payment" ?>",
                data: {
                    start: start,
                    end: end
                },
                methode: "get",
                dataType: 'JSON',
                success: function(response) {
                    // $("#reguler_area").slideToggle();
                    
                    $("#payment_bank").text(response.payment.bank);
                    $("#payment_ecommerce").text(response.payment.ecommerce);
                    $("#payment_minimarket").text(response.payment.minimarket);
                    $("#payment_office").text(response.payment.office);
                    $("#payment_psb").text(response.payment.psb);
                    $("#payment_others").text(response.payment.others);
                    
                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }



        function get_best_agent() {
            $("#best_agent_status").val(0);
            $.ajax({
                url: "<?php echo base_url() . "api/Dashboard_v2/get_best_agent" ?>",
                methode: "get",
                async: true,
                dataType: 'JSON',
                success: function(response) {

                    $.each(response.agent, function(key, val) {
                        $("#best_agent_nama").text(val.nama);
                        // $("#best_agent_foto").attr('src',"<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture);

                        // document.getElementById("best_agent_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });
                    $.each(response.tl, function(key, val) {
                        $("#best_tl_nama").text(val.nama);
                        $("#best_tl_num").text(val.num);
                        // $("#best_tl_foto").attr('src',"<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture);

                        // document.getElementById("best_tl_foto").style.backgroundImage = "url('<?php echo base_url() . "YbsService/get_foto_agent/" ?>" + val.picture + "')";
                    });
                },
                error: function() {
                    alert('There was an error processing your information!');
                }
            });
        }
        /*
         * Custom Label formatter
         * ----------------------
         */
        function labelFormatter(label, series) {
            return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
                label +
                '<br>' +
                Math.round(series.percent) + '%</div>'
        }




        $(document).ready(function() {

            // get_performance();
            get_profiling_reguler();
            get_payment();
            var chartjs_multiaxis_bar = document.getElementById("chartjs-account-chart");
            if (chartjs_multiaxis_bar) {
                var barmultiaxisChartData = {
                    labels: ['08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'],
                    datasets: [

                        {
                            label: 'Contacted Rate (%)',
                            type: 'line',
                            // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: primarycolor,
                            fill: false,
                            yAxisID: 'Contacted Rate',
                            borderWidth: 2,
                            data: [
                                <?php
                                foreach ($rate_contacted['rate_contacted'] as $bulanna => $valna) {
                                    echo intval($valna) . ',';
                                }

                                ?>
                            ]
                        }, {
                            label: 'Verified',
                            type: 'bar',
                            backgroundColor: 'green',
                            borderColor: bodycolor,
                            borderWidth: 1,
                            yAxisID: 'Verified',
                            data: [
                                <?php
                                foreach ($grafik_verified['verified'] as $bulanna => $valna) {
                                    echo intval($valna) . ',';
                                }
                                ?>
                            ]
                        },
                    ]

                };
                ctx = document.getElementById('chartjs-account-chart').getContext('2d');
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barmultiaxisChartData,
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: ' '
                        },
                        scales: {
                            yAxes: [{
                                id: 'Verified',
                                position: 'right',
                            }, {
                                id: 'Contacted Rate',
                                position: 'left',
                                ticks: {
                                    max: 100,
                                    min: 0
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
</body>
<!-- END: Body-->

</html>