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
    <div class="sidebar">
        <div class="site-width">

            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">

                <li class="active">
                    <a href="<?php echo base_url() . "dc_campaign/dc_campaign" ?>"><i class="icon-chart mr-1"></i> Campaign</a>
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
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Form Campaign</h4>

                        </div>


                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <form method="GET" action="#">
                <div class="row">
                    <div class="col-6">

                        <div class="form">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lp">Landing Page</label>
                                <select class="form-control" name="lp" id="lp">
                                    <option value='lp1'>Landing Page 1</option>
                                    <option value='lp1'>Landing Page 1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_online">Date Online</label>
                                <input type="date" name="date_online" id="date_online" class="form-control">
                            </div>

                        </div>

                    </div>
                    <div class="col-md">
                        <div class="form">
                            <div class="form-group">
                                <label for="temp_sms">Template SMS</label>
                                <textarea class="form-control row-5" name="temp_sms" onkeyup="countChar(this)"></textarea>
                                <div id="charNum"></div>
                            </div>
                            <div class="form-group">
                                <label for="temp_wa">Template Whatsapp</label>
                                <textarea class="temp_wa" name="temp_wa"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="temp_email">Template Email</label>
                                <textarea class="temp_email" name="temp_email"></textarea>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="btn btn-primary">Submit</div>
                <div class="btn btn-success ml-3">Start</div>
                <div class="btn btn-danger ml-3">Stop</div>
                <div class="btn btn-info pull-right">Test Send</div>
        </div>
        <div class="container-fluid site-width mt-5">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Campaign Data List</h6>
                        </div>
                        <div class="card-body">
                            <table id="datalist" class="table dataTable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Title</td>
                                        <td nowrap style='text-align:center;'>Landing Page</td>
                                        <td style='text-align:center;'>Date Start</td>
                                        <td nowrap style='text-align:center;'>Date End</td>
                                        <td style='text-align:center;'>Status</td>
                                        <td nowrap style='text-align:center;'>Total Data Leads</td>
                                        <td style='text-align:center;'>Opsi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td align="center">
                                            <div class="btn btn-info btn-sm ml-2"><i class="fa fa-pencil"></i></div>
                                            <div class="btn btn-primary btn-sm ml-2"><i class="fa fa-eye"></i></div>
                                            <div class="btn btn-success btn-sm ml-2"><i class="fa fa-video-camera"></i></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

        </div>
        <div class="container-fluid site-width mt-5">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Dashboard Monitoring</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Waiting Order</div>
                                            <div class="h1 mb-3 text-center">75000</div>


                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-blue" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden">75% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Whatsapp</div>
                                            <div class="h1 mb-3 text-center">75000</div>


                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-blue" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden">75% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Email</div>
                                            <div class="h1 mb-3 text-center">75000</div>


                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-blue" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden">75% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">SMS</div>
                                            <div class="h1 mb-3 text-center">75000</div>


                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-blue" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden">75% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="mt-3">
                                <b>Latest Send</b>
                                <table id="datalist" class="table dataTable table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>No Internet</td>
                                            <td>PSTN</td>
                                            <td>NO HP</td>
                                            <td>Email</td>
                                            <td>Campaign</td>
                                            <td>Status</td>
                                            <td>Channel</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        $('#datalist').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true
        });
    </script>

</body>
<!-- END: Body-->

</html>