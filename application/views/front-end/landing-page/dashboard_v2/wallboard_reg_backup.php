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
$thn = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
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
        <div class="site-width" style="max-width:100% !important;">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="index.html" class="horizontal-logo text-left">
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php echo  $thn[intval($bulan)]; ?></span>
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
        <div class="container-fluid site-width" style="max-width:100% !important;">
            <form method="GET" action="#">
                MONTH
                <select name="bulan" id="bulan">
                    <?php
                    $lb = 0;
                    for ($lb = 0; $lb <= 11; $lb++) {
                        $n_lb = sprintf("%02d", $lb);
                        $selected = "";
                        if ($n_lb == $bulan) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $n_lb . "' " . $selected . ">" . $thn[$lb] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
            </form>

            <!-- START: Card Data-->
            <div class="row">

                <div class="col-12 col-lg-3  mt-3">
                    <div class="card overflow-hidden">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 col-lg-12 d-block d-md-flex d-lg-block">
                                        <div class="card rounded-0 col-12 col-md-4 col-lg-12" style='background-color:red;'>
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <i class="fas fa-address-card   card-liner-icon mt-2 text-white"></i>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title text-white" id="dapros"><?php echo number_format($wo); ?></h2>
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
                                                        <h2 class="card-liner-title text-white" id="wo"><?php echo number_format($datana->co); ?></h2>
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
                                                        <h2 class="card-liner-title text-white" id="callorder_reguler"><?php echo number_format($datana->co); ?></h2>
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
                                                    <span class="h1 mb-0" id='verified_reguler'><?php echo number_format($datana->verified); ?></span><br>
                                                    VERIFIED
                                                </div>
                                            </div>
                                            <div class="d-flex mt-3">
                                                <div class="border-0 outline-badge-info  w-50 p-3 rounded text-center">
                                                    <span class="h6 mb-0" id="hp_email_rate"><?php echo number_format(($datana->hp_email / ($datana->verified)) * 100, 2); ?></span><br>
                                                    <span class="h6 mb-0" id='hp_email'><?php echo number_format($datana->hp_email); ?></span>
                                                    <br>HP+EMAIL
                                                </div>
                                                <div class="border-0 outline-badge-warning w-50 p-3 rounded ml-2 text-center">
                                                    <span class="h6 mb-0" id="hp_only_rate"><?php echo number_format(($datana->hp_only / ($datana->verified)) * 100); ?></span><br>
                                                    <span class="h6 mb-0" id='hp_only'><?php echo number_format($datana->hp_only); ?></span>
                                                    <br>HP ONLY
                                                </div>
                                            </div>
                                            <div class="d-flex  mt-4">
                                                <div class="media-body align-self-center ">
                                                    <span class="mb-0 h6 font-w-600">CONVERTION RATE</span><br>
                                                </div>
                                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0" id='convention_rate'><?php echo number_format(($datana->verified / $datana->contacted) * 100, 2); ?></span></div>
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
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_bank"><?php echo number_format($datana->channel_payment_1); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_ecommerce"><?php echo number_format($datana->channel_payment_2); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_minimarket"><?php echo number_format($datana->channel_payment_3); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_office"><?php echo number_format($datana->channel_payment_4); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_psb"><?php echo number_format($datana->channel_payment_5); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="payment_others"><?php echo $datana->channel_payment_6; ?></p>
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
                                                <p class="mb-0 font-w-500 tx-s-12" id="jk_l"><?php echo $datana->gender_l; ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id="jk_p"><?php echo $datana->gender_p; ?></p>
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
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_1'><?php echo number_format($datana->opsi_call_1); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_2'><?php echo number_format($datana->opsi_call_2); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_3'><?php echo number_format($datana->opsi_call_3); ?></p>
                                                <p class="mb-0 font-w-500 tx-s-12" id='opsi_4'><?php echo number_format($datana->opsi_call_4); ?></p>
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
                                            <td style='color:#cd7f32;text-align:center;' id="regional_1_bronze"><?php echo number_format($datana->reg_1_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_1_silver"><?php echo number_format($datana->reg_1_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_1_gold"><?php echo number_format($datana->reg_1_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_1_platinum"><?php echo number_format($datana->reg_1_4); ?></td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>2</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_2_bronze"><?php echo number_format($datana->reg_2_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_2_silver"><?php echo number_format($datana->reg_2_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_2_gold"><?php echo number_format($datana->reg_2_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_2_platinum"><?php echo number_format($datana->reg_2_4); ?></td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>3</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_3_bronze"><?php echo number_format($datana->reg_3_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_3_silver"><?php echo number_format($datana->reg_3_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_3_gold"><?php echo number_format($datana->reg_3_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_3_platinum"><?php echo number_format($datana->reg_3_4); ?></td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>4</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_4_bronze"><?php echo number_format($datana->reg_4_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_4_silver"><?php echo number_format($datana->reg_4_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_4_gold"><?php echo number_format($datana->reg_4_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_4_platinum"><?php echo number_format($datana->reg_4_4); ?></td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>5</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_5_bronze"><?php echo number_format($datana->reg_5_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_5_silver"><?php echo number_format($datana->reg_5_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_5_gold"><?php echo number_format($datana->reg_5_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_5_platinum"><?php echo number_format($datana->reg_5_4); ?></td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>6</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_6_bronze"><?php echo number_format($datana->reg_6_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_6_silver"><?php echo number_format($datana->reg_6_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_6_gold"><?php echo number_format($datana->reg_6_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_6_platinum"><?php echo number_format($datana->reg_6_4); ?></td>
                                        </tr>
                                        <tr class="zoom">
                                            <td>7</td>
                                            <td style='color:#cd7f32;text-align:center;' id="regional_7_bronze"><?php echo number_format($datana->reg_7_1); ?></td>
                                            <td style='color:#c0c0c0;text-align:center;' id="regional_7_silver"><?php echo number_format($datana->reg_7_2); ?></td>
                                            <td style='color:#ffd700;text-align:center;' id="regional_7_gold"><?php echo number_format($datana->reg_7_3); ?></td>
                                            <td style='color:#a8a7ae;text-align:center;' id="regional_7_platinum"><?php echo number_format($datana->reg_7_4); ?></td>
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
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted"><?php echo number_format($datana->contacted); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted_verified"><?php echo number_format($datana->verified); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted_decline"><?php echo number_format($datana->contacted_1); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="contacted_followup"><?php echo number_format($datana->contacted_2); ?></p>
                                                    </div>

                                                </div>
                                            </li>
                                            <li class="p-2 border-bottom zoom">
                                                <div class="media d-flex w-100">
                                                    <div class="media-body align-self-center pl-2">
                                                        <h6 class="mb-0 ">NOT CONTACTED</h6>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_1_text"><?php echo $datana->not_contacted_1_text; ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_2_text"><?php echo $datana->not_contacted_2_text; ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_3_text"><?php echo $datana->not_contacted_3_text; ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12">Others</p>
                                                    </div>
                                                    <div class="ml-auto my-auto font-weight-bold text-right text-danger">
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted"><?php echo number_format($datana->not_contacted); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_1"><?php echo number_format($datana->not_contacted_1); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_2"><?php echo number_format($datana->not_contacted_2); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_3"><?php echo number_format($datana->not_contacted_3); ?></p>
                                                        <p class="mb-0 font-w-500 tx-s-12" id="notcontacted_4"><?php echo number_format($datana->not_contacted_4); ?></p>
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
                                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/".$agent_data_1->picture ?>" alt="Agent" id="best_agent_foto_1" class="rounded-circle " width="65px" height="65px">

                                                    </td>
                                                    <td style="text-align:center;" width="33%">
                                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/".$agent_data_2->picture ?>" alt="Agent" id="best_agent_foto_2" class="rounded-circle" width="65px" height="65px">

                                                    </td>
                                                    <td style="text-align:center;" width="33%">
                                                        <img src="<?php echo base_url() . "YbsService/get_foto_agent/".$agent_data_3->picture ?>" alt="Agent" id="best_agent_foto_3" class="rounded-circle " width="65px" height="65px">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:center;" id="best_agent_num_1" width="33%">
                                                        <?php echo number_format($datana->agent_1_num); ?>
                                                    </td>
                                                    <td style="text-align:center;" id="best_agent_num_2" width="33%">
                                                        <?php echo number_format($datana->agent_2_num); ?>
                                                    </td>
                                                    <td style="text-align:center;" id="best_agent_num_3" width="33%">
                                                        <?php echo number_format($datana->agent_3_num); ?>
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

                                            <?php echo $datana->agent_online; ?></span>

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
                                        <span class="mb-0">0</span><br>
                                        Lunch
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0">0</span><br>
                                        Idle
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mt-3">
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded text-center">
                                        <span class="mb-0">0</span><br>
                                        Toilet
                                    </div>
                                    <div class="border-0 outline-badge-danger w-50 p-1 rounded ml-2 text-center">
                                        <span class="mb-0">0</span><br>
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
    <script type="text/javascript">
        var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');



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

                                echo intval(($datana->jam_8_c/$datana->jam_8_oc)*100) . ",";
                                echo intval(($datana->jam_9_c/$datana->jam_9_oc)*100) . ",";
                                echo intval(($datana->jam_10_c/$datana->jam_10_oc)*100) . ",";
                                echo intval(($datana->jam_11_c/$datana->jam_11_oc)*100) . ",";
                                echo intval(($datana->jam_12_c/$datana->jam_12_oc)*100) . ",";
                                echo intval(($datana->jam_13_c/$datana->jam_13_oc)*100) . ",";
                                echo intval(($datana->jam_14_c/$datana->jam_14_oc)*100) . ",";
                                echo intval(($datana->jam_15_c/$datana->jam_15_oc)*100) . ",";
                                echo intval(($datana->jam_16_c/$datana->jam_16_oc)*100) . ",";
                                echo intval(($datana->jam_17_c/$datana->jam_17_oc)*100) . ",";
                                echo intval(($datana->jam_18_c/$datana->jam_18_oc)*100) . ",";
                                echo intval(($datana->jam_19_c/$datana->jam_19_oc)*100) . ",";
                                echo intval(($datana->jam_20_c/$datana->jam_20_oc)*100) . ",";


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
                                echo $datana->jam_8_v . ",";
                                echo $datana->jam_9_v . ",";
                                echo $datana->jam_10_v . ",";
                                echo $datana->jam_11_v . ",";
                                echo $datana->jam_12_v . ",";
                                echo $datana->jam_13_v . ",";
                                echo $datana->jam_14_v . ",";
                                echo $datana->jam_15_v . ",";
                                echo $datana->jam_16_v . ",";
                                echo $datana->jam_17_v . ",";
                                echo $datana->jam_18_v . ",";
                                echo $datana->jam_19_v . ",";
                                echo $datana->jam_20_v;


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