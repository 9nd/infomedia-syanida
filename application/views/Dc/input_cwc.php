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
    <title>Digital Channel - Multi Contact</title>
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
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc" ?>"><i class="icon-chart mr-1"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/dalalead" ?>"><i class="icon-chart mr-1"></i> Data Lead</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/engine" ?>"><i class="icon-chart mr-1"></i> Engine</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/lp" ?>"><i class="icon-chart mr-1"></i> landing Page</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/campaign" ?>"><i class="icon-chart mr-1"></i> Campaign</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/multi_contact" ?>"><i class="icon-chart mr-1"></i> Multi Contact</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Dc/Dc/input_cwc" ?>"><i class="icon-chart mr-1"></i> Input CWC</a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url() . "Dc/Dc/qc" ?>"><i class="icon-chart mr-1"></i> Quality Control</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/report" ?>"><i class="icon-chart mr-1"></i> Report</a>
                </li> -->


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
                            <h4 class="mb-0">Input CWC</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-12 mt-1">
                    <div class="card">
                        <div class="card-header">                               
                            <h4 class="card-title">Form Call Work Code</h4>                                
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">                                           
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-4 mb-3">
                                                    <label for="no_telp">Nomor Telepon</label>
                                                    <input type="text" class="form-control" placeholder="Nomor Telepon">
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="no_internet">Nomor Internet</label>                                               
                                                    <input type="text" class="form-control" placeholder="Nomor Internet">
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="ncli">NCLI</label>                                               
                                                    <input type="text" class="form-control" placeholder="NCLI">
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="nama_pelanggan">Nama Pelanggan</label>                                               
                                                    <input type="text" class="form-control" placeholder="Nama Pelanggan">
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="relasi">Relasi Kepemilikan</label> 
                                                    <select class="form-control" id="relasi" name="relasi">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="pemilik">Pemilik</option>
                                                        <option value="bi">Bapak / Ibu</option>
                                                        <option value="si">Suami / Istri</option>
                                                        <option value="anak">Anak</option>
                                                        <option value="kel">Keluarga</option>
                                                        <option value="kontrak">Kontrak</option>
                                                        <option value="karyawan">Karyawan</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="jk">Jenis Kelamin</label>
                                                    <div class="col-sm-2 ml-2">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-2 ml-2">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Female
                                                        </label>
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

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">                               
                            <h4 class="card-title">Konfirmasi Email & Nomor HP</h4>                                
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">                                           
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-3 mb-3">
                                                    <label for="no_hp">Handphone Utama</label>
                                                    <input type="text" class="form-control" placeholder="Handphone Utama">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="no_hp_lain">Handphone Lainnya</label>                                               
                                                    <input type="text" class="form-control" placeholder="Handphone Lainnya">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="wa">Whatsapp</label>                                               
                                                    <input type="text" class="form-control" placeholder="Whatsapp">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="email_utama">Email Utama</label>                                               
                                                    <input type="text" class="form-control" placeholder="Email Utama">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="email_lain">Email Lainnya</label>                                               
                                                    <input type="text" class="form-control" placeholder="Email Lainnya">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="fb">Facebook</label>                                               
                                                    <input type="text" class="form-control" placeholder="Facebook">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="tw">Twitter</label>                                               
                                                    <input type="text" class="form-control" placeholder="Twitter">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="ig">Instagram</label>                                               
                                                    <input type="text" class="form-control" placeholder="Instagram">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">                               
                            <h4 class="card-title">Verifikasi</h4>                                
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">                                           
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-3 mb-3">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" placeholder="Nama">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="alamat">Alamat</label>                                               
                                                    <input type="text" class="form-control" placeholder="Alamat">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="kota">Kota</label>                                               
                                                    <input type="text" class="form-control" placeholder="Kota">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="kecepatan">Kecepatan</label>
                                                    <select class="form-control" id="kecepatan" name="kecepatan">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="telp">Telpon Rumah Saja</option>
                                                        <option value="384">384 Kbps</option>
                                                        <option value="512">512 Kbps</option>
                                                        <option value="1">1 Mbps</option>
                                                        <option value="2">2 Mbps</option>
                                                        <option value="3">3 Mbps</option>
                                                        <option value="5">5 Mbps</option>
                                                        <option value="10">10 Mbps</option>
                                                        <option value="20">20 Mbps</option>
                                                        <option value="30">30 Mbps</option>
                                                        <option value="40">40 Mbps</option>
                                                        <option value="50">50 Mbps</option>
                                                        <option value="100">100 Mbps</option>
                                                        <option value="200">200 Mbps</option>
                                                        <option value="300">300 Mbps</option>
                                                    </select>
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="tagihan">Tagihan</label>                                               
                                                    <input type="text" class="form-control" placeholder="Tagihan">
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="tp_bayar">Tempat Bayar</label>
                                                    <select class="form-control" id="tp_bayar" name="tp_bayar">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="kredit">Bank - Kredit</option>
                                                        <option value="debit">Bank - Debit</option>
                                                        <option value="e_com">E-commerce</option>
                                                        <option value="mm">Minimarket</option>
                                                        <option value="telkom">Telkom & POS</option>
                                                        <option value="psb">PSB</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="col-3 mb-3"> 
                                                    <label for="th_pasang">Bulan & Tahun Pasang</label>                                               
                                                    <input type="text" class="form-control" placeholder="Bulan & Tahun Pasang">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">                               
                            <h4 class="card-title">Closing</h4>                                
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">                                           
                                    <div class="col-12">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-4 mb-3"> 
                                                    <label for="v_email">Verifikasi Email</label>
                                                    <select class="form-control" id="v_email" name="v_email">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="email_sdh_dicek">Sudah Dicek</option>
                                                        <option value="email_blm_dicek">Belum Dicek</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="v_sms">Verifikasi SMS</label>
                                                    <select class="form-control" id="v_sms" name="v_sms">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="sms_sdh_dicek">Sudah Dicek</option>
                                                        <option value="sms_blm_dicek">Belum Dicek</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="opsi_call">Opsi Call</label>
                                                    <select class="form-control" id="opsi_call" name="opsi_call">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="telp_rumah">Telepon Rumah</option>
                                                        <option value="hp">Handphone</option>
                                                        <option value="email">Email</option>
                                                        <option value="wa">Whatsapp</option>
                                                        <option value="sms">SMS</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3"> 
                                                    <label for="kat_call">Kategori Call</label>
                                                    <select class="form-control" id="kat_call" name="kat_call">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="contacted">Contacted</option>
                                                        <option value="n_contacted">Not Contacted</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3"> <!--ini kalo kategori callnya contacted-->
                                                    <label for="sub_call">Sub Kategori Call</label>
                                                    <select class="form-control" id="sub_call" name="sub_call">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="decline">Decline</option>
                                                        <option value="fu">Follow up</option>
                                                        <option value="verified">Verified</option>
                                                    </select>
                                                </div>

                                                <!-- ini kalo kategori callnya Not Contacted -->

                                                <!-- <div class="col-4 mb-3"> 
                                                    <label for="sub_call">Sub Kategori Call</label>
                                                    <select class="form-control" id="sub_call" name="sub_call">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="rna">RNA</option>
                                                        <option value="salah_sambung">Salah Sambung</option>
                                                        <option value="isolir">Isolir</option>
                                                        <option value="mailbox">Mailbox</option>
                                                        <option value="telp_sibuk">Telepon Sibuk</option>
                                                        <option value="rejected">Rejected</option>
                                                        <option value="reject_system">Reject By System</option>
                                                        <option value="cabut">Cabut</option>
                                                        <option value="ivalid">Invalid Number</option>
                                                    </select>
                                                </div> -->

                                                <!-- ini kalo Sub Kategori Callnya Decline -->
                                                
                                                <!-- <div class="col-4 mb-3"> 
                                                    <label for="reason_dec">Reason Decline</label>
                                                    <select class="form-control" id="reason_dec" name="reason_dec">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="bukan_pj">Bukan PJ Pembayaran</option>
                                                        <option value="pj_menolak">PJ menolak verifikasi</option>
                                                    </select>
                                                </div> -->
                                                <div class="col-4 mb-3"> 
                                                    <label for="status_call">Status Call</label>
                                                    <select class="form-control" id="status_call" name="status_call">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="telp_kembali">Ditelepon Kembali</option>
                                                        <option value="verified">Verified</option>
                                                        <option value="n_verified">Not Verified</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3 text-right"> 
                                                    <button type="submit" class="submit-btn btn btn-primary">Submit</button>
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

    <!---- END page datatable--->

    <!-- END: Back to top-->

</body>
<!-- END: Body-->

</html>