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

        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Form Quality Controll</h4>
                            </div>

                            <!-- <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Form</li>
                                <li class="breadcrumb-item active"><a href="#">Basic</a></li>
                            </ol> -->
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Form Inputs</h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control rounded" id="inputEmail4" placeholder="Email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4">Password</label>
                                                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress2">Address 2</label>
                                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <select id="inputState" class="form-control">
                                                            <option selected="">Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputZip">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputDate">Date</label>
                                                        <input type="text" class="form-control datepicker hasDatepicker" id="inputDate">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <!-- END: Page Vendor JS-->
        <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/jquery.richtext.js"></script>

        <!---- END page datatable--->

        <!-- END: Back to top-->

        <script type="text/javascript">
            function update_base_list_area() {
                var date = $("#date").val();
                var sumber = $("#sumber").val();
                $.ajax({
                    url: "<?php echo base_url() . "dc_qc/dc_qc/get_data_list" ?>",
                    data: {
                        sumber: sumber,
                        date: date
                    },
                    methode: "get",
                    success: function(response) {
                        $("#list_area").html(response);
                        // progress.progressTimer('complete');
                    },
                    error: function() {

                    }
                });
            }
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
        </script>

    </body>
    <!-- END: Body-->

    </html>