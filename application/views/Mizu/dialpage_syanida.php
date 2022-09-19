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
    <title>OBC</title>
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

    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <!-- END: Page CSS-->
    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/sweetalert/sweetalert.css">
    <!-- END: Page CSS-->


    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->

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
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Mizu/Mizu"; ?>"><i class="icon-phone mr-1"></i> Outbound Call</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Ebs/Ebs" ?>"><i class="icon-envelope mr-1"></i> History Call</a>
                </li>


            </ul>
            <!-- END: Menu-->

        </div>
    </div>
    <!-- END: Main Menu-->



    <!-- START: Main Content-->
    <main>
        <div class="container-fluid ">
            <!-- START: Breadcrumbs-->
            <div class="row">


                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0"></h4>
                            <!-- <i>*Last Update at <?php echo  date("d F Y h:i A", strtotime($last_update)); ?></i> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-9" id="on_call_block">
                    &nbsp;
                </div>
                <div class="col-3">
                    <div class="alert alert-primary" id="box_kosong" style="display:none;" role="alert">
                        Data Order Kosong, Harap Hubungi Teamleader
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-md-flex text-center">
                                    <ul class="d-md-flex m-0 pl-0 list-unstyled">
                                        <li class="pill cl-personal py-1 px-2 mr-md-2 text-center my-1" id="status_highlight">
                                            Loading
                                        </li>
                                    </ul>
                                    <button class="btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event" id='text_status' onclick="change_status();"><i class="icon-close"></i> OFFLINE</button>

                                    <input type="hidden" id='status_ready' value='0'>
                                    <input type="hidden" id="statusmna" value="0">
                                    <input type="hidden" id="status_register">
                                    <input type="hidden" id="status_call_agent" value="Ready">
                                    <input type="hidden" id="dial_num" value="0">
                                    <input type="hidden" id="number_dial" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="call_control" style="display:none;">
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="card-title">Call Control</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <form>
                                                    <div class="form-row" id="mizu_control">
                                                        <div class="col-12 mb-3">
                                                            <label for="username">Destination number</label>

                                                            <input type="text" readonly class="form-control" placeholder="Destination number" id="destnumber" autocapitalize="off">

                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <button class="btn btn-success btn-block" type="button" id="btn_call" onclick="Call();">Call</button>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <button type="button" class="btn btn-primary btn-block" id="btn_hold" onclick="Hold(true);">Hold</button>
                                                        </div>
                                                    </div>
                                                    <div class="form-row" id="aux_control">
                                                        <div class="col-12 mb-3">
                                                            <select class="form-control" id="drp_aux" onchange="Aux()">
                                                                <option value="0" selected="">Ready</option>
                                                                <option value="1" id="drp_aux_1">1 Konsultasi</option>
                                                                <option value="2" id="drp_aux_2">2 Supporting</option>
                                                                <option value="3" id="drp_aux_3">3 CatHSTR</option>
                                                                <option value="4" id="drp_aux_4">4 Toilet</option>
                                                                <option value="5" id="drp_aux_5">5 Air Minum</option>
                                                                <option value="6" id="drp_aux_6">6 Sholat</option>
                                                                <option value="7" id="drp_aux_7">7 Lunch</option>
                                                                <option value="8" id="drp_aux_8">8 Briefing</option>
                                                                <option value="9" id="drp_aux_9">9 Update System</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-12 mb-3 ">
                                                            <div class="pill cl-personal py-1 px-2 mr-md-2 text-center my-1 text-bold">
                                                                <i class="ion ion-clock"></i> <span id="duration_status"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
    <!-- END: Page Vendor JS-->

    <!-- START: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
    <!-- END: Page Script JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>

    <!---- END page datatable--->


    <!----MIZU MODUL--->
    <!-- END: Custom CSS-->
    <script src="<?php echo base_url(); ?>assets/mizu/js/webphone_api.js?jscodeversion=510"></script>
    <script src="<?php echo base_url(); ?>assets/mizu/js/custom_webphone.js"></script>
    <script src="<?php echo base_url(); ?>assets/mizu/js/dynamicticket.js"></script>
    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/sweetalert/sweetalert.min.js"></script>
    <!-- END: Page Vendor JS-->

    <script type="text/javascript">
        var loopGetticket = 0;
        var delayedCallNumber = null;
        var id_tiket = false;
        var gtc;
        var loopFlagDelay = false;
        var submit_data = true;
        var formload = false;

        function catchStateEvent(event) {

            console.log("catchStateEvent " + event)
            switch (event) {
                case 'App Started':
                    // document.getElementById('btn_start').innerText = 'Stop';
                    // document.getElementById("btn_start").onclick = function () {
                    //     Stop();
                    // };
                    break;
                case 'App Loaded':
                case 'App Stopped':

                    break;
                case 'Ext Registered':
                    // showElement(campaignType);
                    // callDelayedNumber();
                    callDelayedNumber();
                    break;
                case 'Ext UnRegistered':
                    // hideElement();
                    break;
                case 'Call disconnected':
                    // getTicket();
                    if (loopGetticket == 1) {
                        getTicket();
                    } else {
                        loopGetticket = 1;
                    }
                    $("#aux_control").show();
                    break;
                case 'Call setup':

                    $("#aux_control").hide();
                    break;
                default:
                    break;
            }
        }

        function cek_delaycall() {
            console.log('cek delay');
            $("#on_call_block").empty();
            if (webphone_api.isincall()) {
                if (loopFlagDelay) {
                    tid2 = setTimeout(cek_delaycall, 5000);
                }
            } else {
                loopFlagDelay = false;
                clearTimeout(tid2);
                callDelayedNumber();
            }

        }

        function submitData(formData) {
            if (submit_data == false) {
                $.ajax({
                    url: base_url + '/Mizu/Mizu/submitData',
                    data: formData,
                    type: "POST",
                    // async: false,
                    dataType: 'json',
                    success: function(response) {
                        submit_data = true;
                        swal({
                            title: "Data Berhasil Disimpan",
                            text: "",
                            type: "success",
                            showCancelButton: false,
                            cancelButtonClass: 'btn-danger',
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: 'Close!'
                        });
                        if (webphone_api.isincall()) {
                            loopFlagDelay = true;
                            cek_delaycall();
                        } else {
                            if (aux_flag == false) {
                                callDelayedNumber();

                                $("#on_call_block").empty();
                            }
                        }

                    }
                });
            }

        }

        function displayData(id) {
            if (id) {

                let formData = {
                    id: id,
                };
                $.ajax({
                    type: 'POST',
                    url: base_url + '/Mizu/Mizu/get_formna',
                    data: formData,
                    dataType: 'html',
                    success: function(response) {

                        $("#on_call_block").html(response);
                        submit_data = false;

                    },
                    error: function(response) {
                        console.log('ERR Display Data');
                    }
                });
                $("#oncall_tab").click();


            }


        }



        function callDelayedNumber() {
            if (delayedCallNumber != null) {
                console.log('CALL' + delayedCallNumber);
                Call(delayedCallNumber);
                delayedCallNumber = null;
                $("#aux_control").hide();
                displayData(id_tiket);
            }
        }

        function getTicket() {
            if (delayedCallNumber === null) {

                // delayedCallNumber = null;

                let formData = {
                    agent_status: ""
                };
                $.ajax({
                    url: base_url + "/Mizu/Mizu/get_ticket",
                    data: formData,
                    type: "POST",
                    dataType: 'json',
                    success: function(result) {
                        //kalau campaign_id sama dengan previous, maka langsung call, kalau tidak sama atau prev nya null, maka harus login
                        campaignType = 'outbound';

                        if (result.hasOwnProperty('calling_pty')) {
                            //CALL NUMBER
                            console.log(checkState());
                            if (checkState() == 'Ext Registered') {
                                console.log('CALL' + result.calling_pty);
                                Call(result.calling_pty);
                                // Call('61081221609591');
                                id_tiket = result.id;
                            } else {
                                // if (checkState() != 'Call disconnected') {
                                delayedCallNumber = result.calling_pty;
                                console.log('SUCCESS delayedCallNumber' + result.calling_pty);
                                id_tiket = result.id;
                                // }

                                // delayedCallNumber = '61081221609591';
                            }
                            
                        } else {
                            console.log('DATA KOSONG');
                            $("#box_kosong").show();
                            // Stop();
                        }

                    },
                    error: function(data) {
                        console.log('ERR get_ticket');
                        console.log(data);
                    }
                });
                loopGetticket = 0;
            }

        }

        function init_mizu() {
            Start();
            getTicket();
            console.log("Init Mizu");

        }

        function change_status() {
            var status_ready = $("#status_ready").val();
            if (status_ready == 1) {
                let logoutConfirmBool = confirm("Logout ?");
                if (logoutConfirmBool) {
                    Stop();
                    $("#on_call_block").empty();
                    $("#call_control").hide();
                    $("#status_ready").val(0);
                    $("#text_status").html('<i class="icon-close" ></i> OFFLINE');
                    $("#text_status").attr('class', 'btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event');
                }
            } else {
                init_mizu();
                $("#call_control").show();
                $("#status_ready").val(1);
                $("#text_status").html('<i class="icon-check" ></i> ONLINE');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
            }
        }

        $(document).ready(function() {
            <?php
            if ($status_agent->status_ready == 1) {
            ?>
                init_mizu();
                $("#call_control").show();
                $("#status_ready").val(1);
                $("#text_status").html('<i class="icon-check" ></i> ONLINE');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
            <?php
            }
            if (isset($data_aux)) {
            ?>
                $("#call_control").show();
                $("#status_ready").val(1);
                $("#text_status").html('<i class="icon-check" ></i> ONLINE');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
                aux_flag = true;
                document.getElementById('mizu_control').style.display = 'none';
                $("#drp_aux").val('<?php echo $data_aux->id; ?>');
                loopFlag = true;
                updateAgentStatus('<?php echo $data_aux->aux_val; ?>', '', <?php echo $data_aux->id; ?>);
            <?php
            }
            ?>
        });
    </script>
</body>
<!-- END: Body-->

</html>