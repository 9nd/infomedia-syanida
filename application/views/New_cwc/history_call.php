<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <?php
    if (isset($_GET['start'])) {
    } else {
    ?>
        <!-- <meta http-equiv="refresh" content="300"> -->
    <?php
    }
    function nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n / 1000000000000), 2) . ' T';
        elseif ($n > 1000000000) return round(($n / 1000000000), 2) . ' B';
        elseif ($n > 1000000) return round(($n / 1000000), 2) . ' M';
        elseif ($n > 1000) return $n;

        return number_format($n);
    }

    ?>

    <meta charset="UTF-8">
    <title>Sy-Anida : History Call</title>
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
    <link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/select2-bootstrap.min.css">
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <!-- END: Page CSS-->
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">

            </nav>
        </div>
    </div>
    <!-- END: Header-->
    <!-- START: Main Menu-->
    <div class="sidebar">
        <div class="site-width">

            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Dashboard</a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . "New_cwc/New_cwc" ?>"><i class="icon-chart mr-1"></i> Input CWC</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . "New_cwc/New_cwc/report" ?>"><i class="icon-chart mr-1"></i> Report</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url() . "New_cwc/New_cwc/history_call" ?>"><i class="icon-chart mr-1"></i> History Call</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">History Call</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Breadcrumbs-->
            <form id='form-a' methode="GET">
                <div class="row">
                    <div class="col-12">
                        <div class="form-row">
                            <div class='col-md-2 col-xl-2'>
                                <div class='form-group'>
                                    <label class='form-label'>Start</label>
                                    <input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
                                </div>
                            </div>
                            <div class='col-md-2 col-xl-2'>
                                <div class='form-group'><label class='form-label'>End </label>
                                    <input type='date' class='form-control data-sending focus-color' id='end' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
                                </div>
                            </div>
                            <div class='col-md-4 col-xl-4'>
                                <div class='form-group'>
                                    <label class='form-label'>Agent </label>
                                    <select multiple data-allow-clear="1" name='agentid[]' id="agentid">

                                        <?php
                                        if ($user_categori != 8) {
                                        ?>
                                            <option value="0">--Semua Agent--</option>
                                        <?php
                                        }
                                        if ($list_agent_d['num'] > 0) {
                                            foreach ($list_agent_d['results'] as $list_agent) {
                                                $selected = "";
                                                if (isset($_GET['agentid'])) {

                                                    if (count($_GET['agentid']) > 1) {

                                                        foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
                                                            if ($v_agentid == $list_agent->agentid) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    } else {
                                                        $selected = ($list_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
                                                    }
                                                }
                                                echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . " | " . $list_agent->nama . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                <input type='submit' class='btn btn-primary' value='search'></input>
                            </div>
                        </div>
                    </div>
                </div>
            </form>






            <div id="list_area">

            </div>


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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

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
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- START page datatable--->
    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/select2.script.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
    <!-- END: Page Script JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>

    <!---- END page datatable--->

    <!-- END: Back to top-->
    <?php echo _js("ybs,selectize,multiselect") ?>
    <script type="text/javascript">
        $('#agentid').selectize({});
        // $('#agentid').multiselect();
        var page_version = "1.0.8"
        $(document).ready(function() {
            update_base_list_area();
            // update_base_num_hp_email_area();
            // update_base_num_area();
        });

        function update_base_list_area() {
            var start = $("#start").val();
            var end = $("#end").val();
            var agentid = $("#agentid").val();
            $.ajax({
                url: "<?php echo base_url() . "New_cwc/New_cwc/history_call_list" ?>",
                data: {
                    start: start,
                    end: end,
                    agentid: agentid
                },
                methode: "get",
                success: function(response) {
                    $("#list_area").html(response);
                }
            });
        }
    </script>
</body>
<!-- END: Body-->

</html>