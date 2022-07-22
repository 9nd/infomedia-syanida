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
                            <button class="btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event" id='text_status' onclick="change_status();"><i class="icon-close"></i> NOT READY</button>
                            <input type="hidden" id='status_ready' value='0'>
                            <input type="hidden" id="statusmna" value="0">
                            <input type="hidden" id="status_register">
                            <input type="hidden" id="status_call_agent" value="Ready">
                            <input type="hidden" id="dial_num" value="0">
                            <input type="hidden" id="number_dial" value="0">
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Interaction Data</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-6 mb-3">
                                                    <label for="username">Status bayar</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="email">Tgl Janji Bayar</label>
                                                    <input type="email" class="form-control">
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="username"><b>Alasan Belum Bayar</b></label>

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="email">kategori</label>
                                                    <input type="email" class="form-control">
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="username">Kendala</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Keterangan</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-8">

                                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>

                                                </div>
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-danger btn-block" onclick='back_home();'>Back</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Interaction Status Call</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-6 mb-3">
                                                    <label for="username">No.Kontak</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="email">Type Kontak</label>
                                                    <input type="email" class="form-control">
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="username">Status Call</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="email">Reason Status</label>
                                                    <input type="email" class="form-control">
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="username">Status Detail</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Status Multikontak</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Nama Penerima</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Hubungan</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Preperence Channel</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Preperence Channel GSM</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Preperence Channel Email</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">TS19</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Reason TS19</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Catatan</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Multi Kontak</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-6 mb-3">
                                                    <label for="username">Line</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Telegram</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Whatsapp</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Facebook</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Path</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Twitter</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Phone Mobile</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Phone Work</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Phone Home</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Fax</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Other Phone</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Fax</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Main Email</label>

                                                    <input type="text" class="form-control">

                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Other Email 1</label>

                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="username">Other Email 2</label>
                                                    <input type="text" class="form-control">

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Call Control</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mizu_custom_control">

                                    </div>
                                    <div class="col-12" id="mizuSideControl">

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
    <script>
        var campaignChangeId = null;
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

                    // initCustomWebphone();
                    // console.log("load callback");
                    // setCampaignId(1);
                    // // var msg
                    // // var msg={"msg":["serveraddress":"asteris-t2.infomedia.co.id","name":"name","password":"TAMDCS147","id":1,"login_time":"2021-08-12 12:02:01","reason":' {"defined": [], "undefined": []}']};
                    // var temp = Array();
                    // temp['serveraddress'] = 'asteris-t2.infomedia.co.id';
                    // temp['name'] = '1750';
                    // temp['password'] = 'TAMDCS147';
                    // temp['id'] = 1;
                    // temp['login_time'] = '2021-08-12 12:02:01';
                    // temp['reason'] = '{"defined": [], "undefined": []}';
                    // var data = {
                    //     msg: [temp]
                    // };

                    // // var datapush={"msg":msg};

                    // callbackStart(data);


                    break;
                case 'App Stopped':
                    if (document.getElementById("readyEscalationSwitch").checked) {
                        if (campaignChangeId != null) {
                            setCampaignId(campaignChangeId);
                            Start();
                            campaignChangeId = null;
                        }
                    } else {
                        if (document.getElementById("divMizuvoipControl")) {
                            document.getElementById("divMizuvoipControl").remove();
                        }
                        if (document.getElementById("divMizuvoipSideControl")) {
                            document.getElementById("divMizuvoipSideControl").remove();
                        }
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
                    if (document.getElementById("readyEscalationSwitch").checked) {
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
            Start();
            if ((checkState() == 'App Loaded' || checkState() == 'App Stopped')) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Mizu/Mizu/get_ticket",
                    type: "POST",
                    dataType: 'json',
                    success: function(result) {
                        // displayData(result);
                        //kalau campaign_id sama dengan previous, maka langsung call, kalau tidak sama atau prev nya null, maka harus login

                        //CALL NUMBER
                        res = result;

                        if (res.status != "kosong") {
                            // console.log("melakukan call");
                            // console.log('CALL' + result.no_hp);
                            if (checkState() == 'Ext Registered') {
                                console.log('CALL' + res.no_hp);
                                // Call(tempParse.calling_pty);
                                Call(result.no_hp);
                            } else {
                                // delayedCallNumber = tempParse.calling_pty;
                                delayedCallNumber = res.no_hp;
                            }

                        } else {
                            console.log('Data Kosong');
                            hideElement();
                        }


                    },
                    error: function(data) {
                        console.log('ERR get_ticket');
                        console.log(data);
                    }
                });
            }
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
            if (mode == 'statusUpdate') {
                assignedData[pointIndex].statusUpdate = true;
                if (assignedData[pointIndex].unique_key == mizuUniqueKey && assignedData[pointIndex].categorie_id == mizuCategorieId) {
                    mizuUniqueKey = null;
                    mizuCategorieId = null;
                }
                callDelayedNumber();
            }
            if (mode == 'dataSubmit') {
                assignedData[pointIndex].dataSubmit = true;
            }
            if (assignedData[pointIndex].statusUpdate && assignedData[pointIndex].dataSubmit) {
                document.getElementById('form' + assignedData[index].counter).remove();
            }

            // let pointIndex;
            // for (let index = 0; index < assignedData.length; index++) {
            //     if (assignedData[index].statusUpdate && assignedData[index].dataSubmit) {
            //         document.getElementById('form'+assignedData[index].counter).remove();
            //     }
            // }
        }

        function submitData(formData, pointIndex) {
            $.ajax({
                url: "/dynamicticket/submitData",
                data: formData,
                type: "POST",
                // async: false,
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        // assignedData.dataSubmit = true;
                        clearUnusedForm(pointIndex, 'dataSubmit');
                    }
                    // return data;
                },
                error: function(data) {
                    console.log('ERR submitData');
                    console.log(data);
                }
            });
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

        function displayData(result) {
            if (result.limit > 1) {
                assignedData = new Array;
                assignedDataCounter = 0;
            }
            // console.log(result);
            result.data.forEach(value => {
                assignedDataCounter++;
                assignedData.push({
                    counter: assignedDataCounter,
                    data: JSON.parse(value.data),
                    unique_key: value.unique_key,
                    status: value.status,
                    categorie_id: value.dynamicticket_categorie_id,
                    attempt: value.attempt,
                    statusUpdate: false,
                    dataSubmit: false,
                });
            });
            if (result.limit == 1) {
                let newCard = createNewElement(document.getElementById('escalationDiv'), {
                    kind: 'form',
                    class: 'card card-primary',
                    id: 'form' + assignedDataCounter,
                    method: 'post',
                    action: '/dynamicticket/submitData'
                });
                //intercept submit -> ajax, submit data tiket
                newCard.addEventListener("submit", function(e) {
                    e.preventDefault(); // before the code
                    var $theForm = $(this);
                    // console.log($theForm.serialize());

                    var data = $theForm.serialize().split("&");
                    // console.log(data);
                    var obj = {};
                    for (var key in data) {
                        // console.log(data[key]);
                        obj[data[key].split("=")[0]] = decodeURIComponent(data[key].split("=")[1]);
                    }
                    // console.log(obj);

                    let pointIndex;
                    for (let index = 0; index < assignedData.length; index++) {
                        if (assignedData[index].counter == dataPoint) {
                            pointIndex = index;
                        }
                    }
                    if (typeof obj.reschedule != 'undefined') { //Reschedule
                        // let time = $('#rescheduleDateTime'+dataPoint).datetimepicker('viewDate');
                        let submitStatus = {
                            status: 3,
                            attempt: 0,
                            datetime: "'" + obj.reschedule_datetime + "'",
                        };
                        updateStatus(submitStatus, assignedData[pointIndex].unique_key, assignedData[pointIndex].categorie_id, true)
                    }
                    // updateStatus(4, assignedData[pointIndex].unique_key, assignedData[pointIndex].categorie_id)
                    submitData($theForm.serialize(), pointIndex);





                    // send xhr request

                    // $.ajax({
                    //     type: $theForm.attr('method'),
                    //     url: $theForm.attr('action'),
                    //     data: $theForm.serialize(),
                    //     success: function(data) {
                    //         // console.log('Yay! Form sent.');
                    //         console.log(data);
                    //     }
                    // });


                    // Should be triggered on form submit
                    // console.log('hi');
                    return false;
                });

                let newCardHeader = createNewElement(newCard, {
                    kind: 'div',
                    class: 'card-header'
                });
                let newCardTitle = createNewElement(newCardHeader, {
                    kind: 'div',
                    class: 'card-title',
                    innerhtml: result.escalation_campaign_name
                });
                let newCardTool = createNewElement(newCardHeader, {
                    kind: 'div',
                    class: 'card-tools',
                    innerhtml: '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>'
                });
                let newCardBody = createNewElement(newCard, {
                    kind: 'div',
                    class: 'card-body'
                });
                let newRow = createNewElement(newCardBody, {
                    kind: 'div',
                    class: 'row'
                });
                let newDataCol = createNewElement(newRow, {
                    kind: 'div',
                    class: 'col-lg-6',
                    id: 'data_input' + assignedDataCounter
                });

                let resultData = JSON.parse(result.data[0].data);
                Object.entries(resultData).forEach(([key_result, value_result]) => {
                    if (key_result != 'calling_pty') {
                        let newForm = createNewElement(newDataCol, {
                            kind: 'div',
                            class: 'form-inline'
                        });
                        let newFormGroup = createNewElement(newForm, {
                            kind: 'div',
                            class: 'form-group'
                        });
                        let newLabel = createNewElement(newFormGroup, {
                            kind: 'label',
                            for: key_result,
                            innerhtml: key_result
                        });
                        let newInput = createNewElement(newFormGroup, {
                            kind: 'input',
                            class: 'form-control mx-sm-3 my-1',
                            id: key_result,
                            value: value_result,
                            readonly: true
                        });
                    }
                })
                createNewElement(newDataCol, {
                    kind: 'input',
                    type: 'hidden',
                    name: 'unique_key',
                    value: result.data[0].unique_key
                });
                createNewElement(newDataCol, {
                    kind: 'input',
                    type: 'hidden',
                    name: 'dynamicticket_categorie_id',
                    value: result.data[0].dynamicticket_categorie_id
                });
                createNewElement(newDataCol, {
                    kind: 'input',
                    type: 'hidden',
                    name: 'escalation_campaign_id',
                    value: result.escalation_campaign_id
                });
                if (typeof result.data_input != 'undefined') {
                    recursiveInput('add', result.data_input, 'data_input' + assignedDataCounter);
                }

                let newSubmitCol = createNewElement(newRow, {
                    kind: 'div',
                    class: 'col-lg-6',
                    id: 'input' + assignedDataCounter
                });
                recursiveInput(null, result.input, 'input' + assignedDataCounter);

                let newRescheduleRow = createNewElement(document.getElementById('input' + assignedDataCounter), {
                    kind: 'div',
                    class: 'row'
                });
                let newRescheduleColToggle = createNewElement(newRescheduleRow, {
                    kind: 'div',
                    class: 'col-md-3'
                });
                let newRescheduleToggleGroup = createNewElement(newRescheduleColToggle, {
                    kind: 'div',
                    class: 'form-group mb-0'
                });
                let newRescheduleToggleCustomControlDiv = createNewElement(newRescheduleToggleGroup, {
                    kind: 'div',
                    class: 'custom-control custom-switch custom-switch-md custom-switch-off-secondary custom-switch-on-warning'
                });
                let newRescheduleToggleInput = createNewElement(newRescheduleToggleCustomControlDiv, {
                    kind: 'input',
                    type: 'checkbox',
                    name: 'reschedule',
                    class: 'custom-control-input',
                    id: 'rescheduleToggle' + assignedDataCounter
                });
                createNewElement(newRescheduleToggleCustomControlDiv, {
                    kind: 'label',
                    class: 'custom-control-label py-0',
                    for: 'rescheduleToggle' + assignedDataCounter,
                    innerhtml: 'Reschedule'
                });


                let newRescheduleDiv = createNewElement(newRescheduleRow, {
                    kind: 'div',
                    class: 'col-md-9'
                });
                let newRescheduleInputGroupDiv = createNewElement(newRescheduleDiv, {
                    kind: 'div',
                    class: 'input-group date',
                    id: 'rescheduleDateTime' + assignedDataCounter,
                    data_target_input: 'nearest'
                });
                let newRescheduleInput = createNewElement(newRescheduleInputGroupDiv, {
                    kind: 'input',
                    type: 'text',
                    class: 'form-control datetimepicker-input',
                    name: 'reschedule_datetime',
                    data_target: '#rescheduleDateTime' + assignedDataCounter,
                    id: 'inputReschedule' + assignedDataCounter,
                    placeholder: 'Reschedule'
                });
                createNewElement(newRescheduleInputGroupDiv, {
                    kind: 'div',
                    class: 'input-group-append',
                    data_target: '#rescheduleDateTime' + assignedDataCounter,
                    data_toggle: 'datetimepicker',
                    innerhtml: '<div class="input-group-text"><i class="fa fa-calendar"></i></div>'
                });
                // let newRescheduleClearButton = createNewElement(newRescheduleInputGroupDiv,{kind:'button',type:'button',class:'btn btn-danger',innerhtml:'Clear'});
                // newRescheduleClearButton.addEventListener('click',function(e) {
                //     $('#rescheduleDateTime'+assignedDataCounter).datetimepicker('clear');
                // });



                $('#rescheduleDateTime' + assignedDataCounter).datetimepicker({
                    icons: {
                        time: 'far fa-clock'
                    },
                    format: 'YYYY-MM-DD HH:mm:ss',
                    ignoreReadonly: true
                });
                document.getElementById('inputReschedule' + assignedDataCounter).setAttribute('readonly', true);
                $('#rescheduleDateTime' + assignedDataCounter).datetimepicker('disable');



                let newSubmit = createNewElement(document.getElementById('input' + assignedDataCounter), {
                    kind: 'input',
                    type: 'submit',
                    class: 'btn btn-success',
                    innerhtml: 'Submit'
                });

                newRescheduleToggleInput.addEventListener('change', function(e) {
                    if (newRescheduleToggleInput.checked) {
                        $('#rescheduleDateTime' + assignedDataCounter).datetimepicker('enable');
                        newSubmit.disabled = true;
                    } else {
                        $('#rescheduleDateTime' + assignedDataCounter).datetimepicker('clear');
                        $('#rescheduleDateTime' + assignedDataCounter).datetimepicker('disable');
                        newSubmit.disabled = false;
                    }
                });
                $('#rescheduleDateTime' + assignedDataCounter).on("change.datetimepicker", function(e) {
                    if (newRescheduleInput.value != '') {
                        newSubmit.disabled = false;
                    } else {
                        newSubmit.disabled = true;
                    }
                });

                // let newSubmit = document.createElement('input');
                // newSubmit.setAttribute('type','submit');
                // newSubmit.setAttribute('class','btn btn-success');
                // newSubmit.value = 'Submit';

                // document.getElementById('input'+assignedDataCounter).appendChild(newSubmit);


            } else if (limit > 1) {
                let newDivPanel = document.createElement('div');
                newDivPanel.setAttribute('class', 'panel box box-primary');
                let newDivBox = document.createElement('div');
                newDivBox.setAttribute('class', 'box-body');
                newDivPanel.appendChild(newDivBox);
                let newDivTable = document.createElement('div');
                newDivTable.setAttribute('class', 'table-responsive');
                newDivPanel.appendChild(newDivTable);
                let newTable = document.createElement('table');
                newTable.setAttribute('id', 'tableEscalationData');
                newTable.setAttribute('class', 'table-striped no-margin');
                newTable.setAttribute('style', 'width:100%');
                newDivTable.appendChild(newTable);
                escalationData.appendChild(newDivPanel);
                if ($.fn.DataTable.isDataTable('#tableEscalationData')) {
                    table.destroy();
                    $('#tableEscalationData').empty();
                }
                let tableHeader = new Array;
                Object.entries(assignedData[0].data).forEach(([key_result, value_result]) => {
                    let temp = {
                        title: key_result,
                        data: key_result,
                    };
                    if (key_result == 'calling_pty') {
                        temp.render = function(data, type, row) {
                            return '<button class="btn btn-success bulkDialButton" type="button" onclick="Call(\'' + data + '\');">' + data + '&nbsp&nbsp&nbsp<i class="fas fa-phone"></i></button>';
                        }
                    }
                    tableHeader.push(temp);
                });
                table = $('#tableEscalationData').DataTable({
                    "fixedHeader": {
                        header: true,
                        footer: true
                    },
                    "scrollX": true,
                    "lengthMenu": [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    "stateSave": true,
                    "data": assignedData.data,
                    "columns": tableHeader,
                });


                let x = document.getElementsByClassName('bulkDialButton');
                for (let value of x) {
                    value.disabled = true;
                }
            }
        }

        function readyEscalationState() {
            var status_ready = $("#status_ready").val();
            if (status_ready == 1) {
                initCustomWebphone();
                getTicket();
            } else {
                Stop();
            }
        }

        function change_status() {
            var status_ready = $("#status_ready").val();
            if (status_ready == 1) {
                $("#status_ready").val(0);
                $("#text_status").html('<i class="icon-close" ></i> NOT READY');
                $("#text_status").attr('class', 'btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event');

            } else {
                $("#status_ready").val(1);

                $("#text_status").html('<i class="icon-check" ></i> READY');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
            }
            readyEscalationState();

        }
        $(document).ready(function() {
            // updateAgentStatus();
        });
    </script>
</body>
<!-- END: Body-->

</html>