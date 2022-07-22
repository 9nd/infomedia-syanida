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
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>


</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">

    <!-- START: Pre Loader-->
    <!-- <div class="se-pre-con">
        <div class="loader"></div>
    </div> -->
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

    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
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

                <div class="col-9">
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
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="wizard-tab mb-4">
                                <ul class="nav nav-tabs d-block d-sm-flex">
                                    <li class="nav-item mr-auto mb-4">
                                        <a class="nav-link p-0 active" id="lastcall_tab" data-toggle="tab" href="#tab1">
                                            <div class="d-flex">
                                                <div class="media-body align-self-center">
                                                    <h6 class="mb-0 text-uppercase font-weight-bold">Last Call</h6>
                                                    Basic account info
                                                </div>
                                            </div>

                                        </a>
                                    </li>


                                    <li class="nav-item mb-4">
                                        <a class="nav-link p-0 " id="oncall_tab" data-toggle="tab" href="#tab3">
                                            <div class="d-flex">
                                                <div class="media-body align-self-center">
                                                    <h6 class="mb-0 text-uppercase font-weight-bold">On Call</h6>
                                                    Thanks for information
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="form" id="last_call_block">

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    <div class="form" id="on_call_block">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3" id="call_control" style="display:none;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Call Control</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-12 mb-3">
                                                    <label for="username">Destination number</label>

                                                    <input type="text" class="form-control" placeholder="Destination number" id="destnumber" autocapitalize="off">

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-12 mb-3">
                                                    <button class="btn btn-success btn-block" type="button" id="btn_call" onclick="Call();">Call</button>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <button type="button" class="btn btn-primary btn-block" id="btn_hold" onclick="Hold(true);">Hold</button>
                                                </div>
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
                                                <div class="col-12 mb-3 ">
                                                    <div class="pill cl-personal py-1 px-2 mr-md-2 text-center my-1 text-bold">
                                                        <i class="ion ion-clock"></i> <span id="duration_status"></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- <div class="col-12 mizu_custom_control">
                                        <div id="divMizuvoipControl">
                                            <div id="divMizuvoipControlBody" style="background-color: rgba(0, 0, 0, 0);">
                                                <div class="row py-1">
                                                    <div class="input-group w-100"><input type="text" class="form-control" placeholder="Destination number" id="destnumber" autocapitalize="off">
                                                        <div class="input-group-append" id="dial_group"><button class="btn btn-success" type="button" id="btn_call" onclick="Call();"><i class="fas fa-phone"></i></button></div>
                                                    </div>
                                                </div>
                                                <div class="row py-1" id="incoming_call_layout">
                                                    <div class="btn-group w-100" role="group"><button type="button" class="btn btn-success" id="btn_accept" onclick="Accept();">Accept</button><button type="button" class="btn btn-danger" id="btn_reject" onclick="Reject();">Reject</button></div>
                                                </div><iframe allow="microphone; camera" style="display:none" height="0" width="0" id="loader"></iframe>
                                                <div id="video_container" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div> -->
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
    <script>
        var campaignChangeId = null;
        var dataID = null;
        var campaignType = null;
        var delayedCallNumber = null;
        var mizuUniqueKey = null;
        var mizuCategorieId = null;
        var mizuUniqueKeyDelayed = null;
        var mizuCategorieIdDelayed = null;

        function catchStateEvent(event) {

            console.log(event)
            switch (event) {
                case 'App Started':
                    // document.getElementById('btn_start').innerText = 'Stop';
                    // document.getElementById("btn_start").onclick = function () {
                    //     Stop();
                    // };
                    break;
                case 'App Loaded':
                case 'App Stopped':
                    var status_ready = $("#status_ready").val();
                    if (status_ready == 1) {
                        if (campaignChangeId != null) {
                            setCampaignId(campaignChangeId);
                            Start();
                            campaignChangeId = null;
                        }
                    } else {
                        // if (document.getElementById("divMizuvoipControl")) {
                        //     document.getElementById("divMizuvoipControl").remove();
                        // }
                        // if (document.getElementById("divMizuvoipSideControl")) {
                        //     document.getElementById("divMizuvoipSideControl").remove();
                        // }
                    }
                    // document.getElementById('btn_start').innerText = 'Start';
                    // document.getElementById("btn_start").onclick = function () {
                    //     Start();
                    // };
                    break;
                case 'Ext Registered':
                    showElement(campaignType);
                    callDelayedNumber();
                    break;
                case 'Ext UnRegistered':
                    hideElement();
                    break;
                case 'Call disconnected':
                    var status_ready = $("#status_ready").val();
                    if (status_ready == 1) {
                        getTicket();
                    }
                    break;
                default:
                    break;
            }
        }

        function callDelayedNumber() {
            if (delayedCallNumber != null) {
                console.log('CALL' + delayedCallNumber);
                mizuUniqueKey = mizuUniqueKeyDelayed;
                mizuCategorieId = mizuCategorieIdDelayed;
                Call(delayedCallNumber);
                delayedCallNumber = null;
            } else {
                stop();
            }
        }

        function catchOnCdrTranslatedReason(data) {
            console.log(data);
            let submitStatus;
            let pointIndex = null;
            for (let index = 0; index < assignedData.length; index++) {
                if (assignedData[index].unique_key == mizuUniqueKey && assignedData[index].categorie_id == mizuCategorieId) {
                    pointIndex = index;
                }
            }
            if (pointIndex != null) {
                switch (data) {
                    case 'RNA':
                        submitStatus = {
                            status: 3,
                            attempt: assignedData[pointIndex].attempt + 1,
                            datetime: "NOW() + INTERVAL '1 HOUR'",
                        };
                        break;
                    case 'ACCEPTED':
                        submitStatus = {
                            status: 4,
                        };
                        break;
                    default:
                        break;
                }
                if (assignedData[pointIndex].statusUpdate === false) {
                    updateStatus(submitStatus, assignedData[pointIndex].unique_key, assignedData[pointIndex].categorie_id);
                }
            }
        }
    </script>

    <script>
        var assignedData = new Array;
        var assignedDataCounter = 0;
        var table;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        function getTicket() {

            let formData;
            try {
                formData = {
                    campaign_id: getCampaignId(),
                    pbx_login_time: getLoginTime(),
                };
            } catch (err) {
                formData = {
                    campaign_id: null,
                    pbx_login_time: null,
                };
            }
            setCampaignId(1);

            $.ajax({
                url: base_url + "/Mizu/Mizu/get_ticket",
                data: formData,
                type: "POST",
                dataType: 'json',
                success: function(result) {
                    dataID = result.id;

                    if (result.hasOwnProperty('pbx_campaign_id')) {

                        //kalau campaign_id sama dengan previous, maka langsung call, kalau tidak sama atau prev nya null, maka harus login
                        if (result.pbx_campaign_id != null) {
                            campaignChangeId = setCampaignId(result.pbx_campaign_id);
                            if ((checkState() == 'App Loaded' || checkState() == 'App Stopped')) {
                                Start();
                            }
                        } else {
                            console.log('ERR pbx_campaign_id');
                        }
                        campaignType = 'outbound';

                        if (result.limit == 1) {

                            if (result.hasOwnProperty('calling_pty')) {
                                //CALL NUMBER
                                console.log(checkState());
                                if (checkState() == 'Ext Registered') {
                                    mizuUniqueKey = result.unique_key;
                                    mizuCategorieId = result.categorie_id;
                                    console.log('CALL' + result.calling_pty);
                                    Call(result.calling_pty);
                                    // Call('61081221609591');
                                } else {
                                    mizuUniqueKeyDelayed = result.unique_key;
                                    mizuCategorieIdDelayed = result.categorie_id;
                                    delayedCallNumber = result.calling_pty;
                                    console.log('SUCCESS delayedCallNumber' + result.calling_pty);
                                    // delayedCallNumber = '61081221609591';
                                }
                            } else {
                                console.log('DATA KOSONG');
                                // Stop();
                            }
                        } else {
                            console.log('ERR limit');
                        }
                    } else {
                        console.log('ERR pbx_campaign_id');
                        // hideElement();
                    }

                },
                error: function(data) {
                    console.log('ERR get_ticket');
                    console.log(data);
                    getTicket();
                }
            });
            displayData(dataID);
        }
        // function Reschedule(dataPoint) {
        //     let time = $('#rescheduleDateTime'+dataPoint).datetimepicker('viewDate');
        //     let submitStatus= {
        //         status: 3,
        //         attempt: 0,
        //         datetime: "'"+document.getElementById('inputReschedule'+dataPoint).value+"'",
        //     };
        //     let pointIndex;
        //     for (let index = 0; index < assignedData.length; index++) {
        //         if (assignedData[index].counter == dataPoint) {
        //             pointIndex = index;
        //         }
        //     }
        //     let updateStatusSuccessBool = false;
        //     while (!updateStatusSuccessBool) {
        //         if (updateStatus(submitStatus,assignedData[pointIndex].unique_key,assignedData[pointIndex].categorie_id,true)) {
        //             clearUnusedForm();
        //             updateStatusSuccessBool = true;
        //         }
        //         if (!updateStatusSuccessBool) {
        //             updateStatusSuccessBool = !confirm("Update Status Failed, Resend Data ?");
        //         }
        //     }
        // }
        // function clearReschedule(dataPoint) {
        //     $('#rescheduleDateTime'+dataPoint).datetimepicker('clear');
        //     document.getElementById('btn_reschedule'+dataPoint).disabled = true;
        // }
        function clearUnusedForm(pointIndex, mode) {

            callDelayedNumber();

        }

        function submitData() {

            // assignedData.dataSubmit = true;
            clearUnusedForm();

            // return data;

        }

        function updateStatus(dataStatus, uniqueKey, categoryId, reschedule = false) {
            let pointIndex;
            for (let index = 0; index < assignedData.length; index++) {
                if (assignedData[index].unique_key == uniqueKey && assignedData[index].categorie_id == categoryId) {
                    pointIndex = index;
                }
            }
            let formData = assignedData[pointIndex];
            if (reschedule || !formData.statusUpdate) {
                if (typeof dataStatus === 'number') {
                    let temp = {
                        status: dataStatus,
                    };
                    formData.curr_status = temp;
                } else {
                    formData.curr_status = dataStatus;
                }
                assignedData[pointIndex].statusUpdate = null;
                $.ajax({
                    url: "/dynamicticket/updateStatus",
                    data: formData,
                    type: "POST",
                    // async: false,
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        if (data) {
                            // assignedData.statusUpdate = true;
                            clearUnusedForm(pointIndex, 'statusUpdate');
                        } else {
                            assignedData[pointIndex].statusUpdate = false;
                        }
                        // return data;
                    },
                    error: function(data) {
                        console.log('ERR updateStatus');
                        console.log(data);
                    }
                });
            }
        }

        function displayData(id) {
            $("#load_block").prependTo("#last_call_block");
            $("#load_block").attr("id", "last-call");
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
                },
                error: function(response) {
                    console.log('ERR Display Data');
                }
            });
            $("#oncall_tab").click();
            // if (result.limit == 1) {

            //intercept submit -> ajax, submit data tiket
            document.getElementById("button_untuk_submit_"+id).addEventListener("click", function(e) {

                // updateStatus(4, assignedData[pointIndex].unique_key, assignedData[pointIndex].categorie_id)
                submitData();

                return false;
            });



            // } else if (limit > 1) {

            // }
        }

        function readyEscalationState() {
            var status_ready = $("#status_ready").val();
            if (status_ready == 1) {
                initCustomWebphone();

                // hideElement();
                getTicket();
            } else {

                Stop();
                //TODO clear cache abandon ?????
            }
        }

        function change_status() {
            var status_ready = $("#status_ready").val();
            if (status_ready == 1) {
                let logoutConfirmBool = confirm("Logout ?");
                if (logoutConfirmBool) {
                    $("#call_control").hide();
                    $("#status_ready").val(0);
                    $("#text_status").html('<i class="icon-close" ></i> OFFLINE');
                    $("#text_status").attr('class', 'btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event');
                }
            } else {

                $("#call_control").show();
                $("#status_ready").val(1);
                $("#text_status").html('<i class="icon-check" ></i> ONLINE');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');

            }
            readyEscalationState();

        }

        $(document).ready(function() {
            <?php
            // if ($status_agent != "App Stopped") {
            ?>
            // $("#call_control").show();
            // $("#status_ready").val(1);
            // $("#text_status").html('<i class="icon-check" ></i> ONLINE');
            // $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');

            // readyEscalationState();
            <?php

            // }
            ?>
        });
    </script>
</body>
<!-- END: Body-->

</html>