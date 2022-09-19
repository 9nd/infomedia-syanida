    <!DOCTYPE html>
    <html lang="en">
    <!-- START: Head-->

    <head>
        <meta charset="UTF-8">
        <title>Digital Channel - Campaign</title>
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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/richtext.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/font-awesome.min.css">

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
        <link href="<?php echo base_url(); ?>assets/progress_bar/css/static.min.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>

        <script src="<?php echo base_url(); ?>assets/progress_bar/js/static.min.js"></script>
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

                    <li class="active">
                        <a href="<?php echo base_url() . "dc_qc/dc_qc" ?>"><i class="icon-chart mr-1"></i> Check Data</a>
                    </li>

                </ul>
                <!-- END: Menu-->

            </div>
        </div>
        <!-- END: Main Menu-->
        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                <!-- START: Breadcrumbs-->

                <!-- END: Breadcrumbs-->
                <form id='form-a' methode="GET">
                    <div class="row">
                        <div class="col-6">

                            <div class="form row">
                                <div class="form-group">
                                    <select class="form form-control mt-3 col-12" name="sumber" id="sumber">
                                        <option <?php if (isset($_GET['sumber']) && $_GET['sumber'] == "obc") {
                                                    echo "selected ";
                                                } ?> value="digital">Digital Channel profiling</option>
                                        <option <?php
                                                if (isset($_GET['sumber']) && $_GET['sumber'] == "obc") {
                                                    echo "selected ";
                                                } ?> value="obc">OBC Profiling</option>
                                        <option <?php
                                                if (isset($_GET['sumber']) && $_GET['sumber'] == "dbprofile") {
                                                    echo "selected ";
                                                } ?> value="dbprofile">DBProfile</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <input required type="date" class="form form-control mt-3 ml-2 col-11" name="date" id="date" value="<?php if (isset($date)) {
                                                                                                                                            echo $date;
                                                                                                                                        } ?>">
                                </div>
                                <div class="form-group">
                                    <button id='btn-save' type='submit' class='btn btn-primary mt-3'><i class="fe fe-save"></i> Search</button>
                                </div>

                            </div>

                        </div>


                    </div>

                </form>

            </div>
            <div class="container-fluid site-width mt-2">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="media-body align-self-center ">
                                            <span class="mb-0 h5 font-w-600">Handphone</span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">Status Nomor Handphone</p>
                                            <hr>
                                        </div>
                                        <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="fa fa-phone"></i></span></div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="border-0 outline-badge-info w-50 p-3 rounded text-center btn" id="notlike"><span class="h8 mb-0">Not Like 08</span><br>
                                            <?php echo $count_status['status']['hp']['notlike']; ?>
                                        </div>
                                        <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center btn" id="notnumber"><span class="h8 mb-0">Not Number</span><br>
                                            <?php echo $count_status['status']['hp']['notnumber']; ?>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-3">
                                        <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center btn" id="contains"><span class="h8 mb-0">Contains Illegal Character</span><br>
                                            <?php echo $count_status['status']['hp']['contains']; ?>
                                        </div>
                                        <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center btn" id="others"><span class="h8 mb-0">Others</span><br>
                                            <?php echo $count_status['status']['hp']['others']; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="media-body align-self-center ">
                                            <span class="mb-0 h5 font-w-600">Email</span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">Status Alamat Email</p>
                                            <hr>
                                        </div>
                                        <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="fa fa-envelope"></i></span></div>

                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="border-0 outline-badge-info w-50 p-3 rounded text-center btn" id="e_kosong"><span class="h8 mb-0">Email Kosong</span><br>
                                            <?php echo  $count_status['status']['email']['kosong']; ?>
                                        </div>
                                        <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center btn" id="e_invalid"><span class="h8 mb-0">Invalid Format Email</span><br>
                                            <?php echo  $count_status['status']['email']['invalid']; ?>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-3">
                                        <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center btn" id="e_illegal"><span class="h8 mb-0">Contains Illegal Character</span><br>
                                            <?php echo  $count_status['status']['email']['ilegal']; ?>
                                        </div>
                                        <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center btn" id="e_tdkada"><span class="h8 mb-0">tdkadaemail@gmail.com</span><br>
                                            <?php echo  $count_status['status']['email']['tdkada']; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_GET['date']) && isset($_GET['sumber'])) { ?>
                <div class="container-fluid site-width mt-2">
                    <!-- START: Breadcrumbs-->
                    <div class="row">
                        <div class="col-12  align-self-center">
                            <div class="card">
                                <div class="loading-progress" style="width:100%;"></div>
                                <div id="list_area">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            };
            ?>
            </div>


            <!-- END: Breadcrumbs-->

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
        <!-- <script src="<?php echo base_url(); ?>assets/datatable_editor/js/dataTables.editor.js"></script>
        <script src="<?php echo base_url(); ?>assets/datatable_editor/js/dataTables.editor.min.js"></script> -->
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
        <!-- END: Page Vendor JS-->
        <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/jquery.richtext.js"></script>

        <!---- END page datatable--->

        <!-- END: Back to top-->

        <script type="text/javascript">
            // var progress = $(".loading-progress").progressTimer({
            //     timeLimit: 90,
            //     onFinish: function() {
            //         // alert('completed!');
            //     }
            // });

            // function update_base_list_area() {
            //     var date = $("#date").val();
            //     var sumber = $("#sumber").val();
            //     $.ajax({
            //         url: "<?php echo base_url() . "dc_qc/dc_qc/get_data_list" ?>",
            //         data: {
            //             sumber: sumber,
            //             date: date
            //         },
            //         methode: "get",
            //         success: function(response) {
            //             $("#list_area").html(response);
            //             // progress.progressTimer('complete');
            //         },
            //         error: function() {

            //         }
            //     });
            // }
            $(document).ready(function() {
                update_base_list_area();
                // update_base_num_hp_email_area();
                // update_base_num_area();
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.temp_wa').richText({
                    ol: false,
                    ul: false,
                    heading: false,
                    imageUpload: false,
                    fileUpload: false,
                    removeStyles: false,

                });
                $('.temp_sms').richText();
                $('.temp_email').richText({
                    ol: false,
                    ul: false,
                    heading: false,
                    imageUpload: false,
                    fileUpload: false,
                    removeStyles: false,

                });
            });

            function countChar(val) {
                var len = val.value.length;
                if (len >= 160) {
                    val.value = val.value.substring(0, 160);
                } else {
                    $('#charNum').text(160 - len);
                }
            };



            $("#notlike").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/notlike" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#notnumber").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/notnumber" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#contains").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/contains" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#others").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/others" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#e_illegal").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/illegal_e" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#e_kosong").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/kosong_e" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#e_invalid").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/invalid_e" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
            $("#e_tdkada").click(function() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/tdkada_e" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        progress.progressTimer('complete');
                    },
                    error: function() {
                        progress.progressTimer('error', {
                            errorText: 'ERROR!',
                            onFinish: function() {
                                alert('There was an error processing your information!');
                            }
                        });
                    }
                });
            });
        </script>

    </body>
    <!-- END: Body-->

    </html>