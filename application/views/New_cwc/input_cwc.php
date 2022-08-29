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
    <title>Digital Channel - Input CWC</title>
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
                <li class="active">
                    <a href="<?php echo base_url() . "New_cwc/New_cwc" ?>"><i class="icon-chart mr-1"></i> Input CWC</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "New_cwc/New_cwc/report" ?>"><i class="icon-chart mr-1"></i> Report</a>
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
                                        <form action="<?php echo base_url() ?>New_cwc/New_cwc/insertdata" method="post" enctype="multipart/form-data">

                                            <div class="form-row">
                                                <div class="col-4 mb-3">
                                                    <label for="no_indri">ID INDRI</label>
                                                    <input type="text" class="form-control" name='no_indri' placeholder="ID INDRI">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label for="no_telp">Nomor Telepon</label>
                                                    <input type="text" class="form-control" name='no_telp' placeholder="Nomor Telepon">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label for="no_internet">Nomor Internet</label>
                                                    <input type="text" class="form-control" name='no_internet' placeholder="Nomor Internet">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                                    <input type="text" name='nama_pelanggan' class="form-control" placeholder="Nama Pelanggan">
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
                                                        <input class="form-check-input" type="radio" name="jk" id="l" value='l'>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-2 ml-2">
                                                        <input class="form-check-input" type="radio" name="jk" id="p" value='p'>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

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

                                        <div class="form-row">
                                            <div class="col-3 mb-3">
                                                <label for="no_hp">Handphone Utama</label>
                                                <input type="text" class="form-control" name='no_hp' placeholder="Handphone Utama">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="no_hp_lain">Handphone Lainnya</label>
                                                <input type="text" class="form-control" name='no_hp_lain' placeholder="Handphone Lainnya">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="wa">Whatsapp</label>
                                                <input type="text" class="form-control" name='wa' placeholder="Whatsapp">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="email_utama">Email Utama</label>
                                                <input type="text" class="form-control" name='email_utama' placeholder="Email Utama">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="email_lain">Email Lainnya</label>
                                                <input type="text" class="form-control" name='email_lain' placeholder="Email Lainnya">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="fb">Facebook</label>
                                                <input type="text" class="form-control" name='fb' placeholder="Facebook">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="tw">Twitter</label>
                                                <input type="text" class="form-control" name='tw' placeholder="Twitter">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="ig">Instagram</label>
                                                <input type="text" class="form-control" name='ig' placeholder="Instagram">
                                            </div>
                                        </div>

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

                                        <div class="form-row">
                                            <div class="col-3 mb-3">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" name='v_nama' placeholder="Nama">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" name='v_alamat' placeholder="Alamat">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="kota">Kota</label>
                                                <input type="text" class="form-control" name='v_kota' placeholder="Kota">
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label for="kecepatan">Kecepatan</label>
                                                <select class="form-control" id="kecepatan" name="v_kecepatan">
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
                                                <input type="text" class="form-control" name="v_tagihan" placeholder="Tagihan">
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
                                                <input type="text" class="form-control" name='th_pasang' placeholder="Bulan & Tahun Pasang">
                                            </div>
                                        </div>

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

                                        <div class="form-row">
                                            <div class="col-4 mb-3">
                                                <label for="v_email">Verifikasi Email</label>
                                                <select class="form-control" id="v_email" name="v_email">
                                                    <option value="0">Belum Dicek</option>
                                                    <option value="13">verified</option>
                                                    <option value="11">decline</option>

                                                </select>
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="v_sms">Verifikasi SMS</label>
                                                <select class="form-control" id="v_sms" name="v_sms">
                                                    <option value="0">Belum Dicek</option>
                                                    <option value="13">verified</option>
                                                    <option value="11">decline</option>
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
                                                    <option value="x">Pilih..</option>
                                                    <option value="1">Contacted</option>
                                                    <option value="0">Not Contacted</option>
                                                </select>
                                            </div>
                                            <div class="col-4 mb-3">
                                                <!--ini kalo kategori callnya contacted-->
                                                <label for="sub_call">Sub Kategori Call</label>
                                                <select class="form-control data-sending" id="sub_call" name="sub_call">
                                                    <option value="0">-- Pilih --</option>
                                                    <option class="opsinc" value="2">RNA</option>
                                                    <option class="opsinc" value="4">Salah Sambung</option>
                                                    <option class="opsinc" value="7">Isolir</option>
                                                    <option class="opsinc" value="8">Mailbox</option>
                                                    <option class="opsinc" value="9">Telepon Sibuk</option>
                                                    <option class="opsinc" value="10">Rejected</option>
                                                    <option class="opsicontacted" value="11">Decline</option>
                                                    <option class="opsicontacted" value="12">Follow Up</option>
                                                    <option class="opsicontacted" value="13">Verified</option>
                                                    <option class="opsinc" value="14">Reject By System</option>
                                                    <option class="opsinc" value="15">Cabut</option>
                                                    <option class="opsinc" value="16">Invalid Number</option>
                                                </select>
                                            </div>
                                            <div class="col-4 mb-3" id='reason_decline_holder'>
                                                <!--ini kalo kategori callnya contacted-->
                                                <label for="reason_decline">Reason Decline</label>
                                                <select class="form-control data-sending" id="reason_decline" name="reason_decline">
                                                    <option value="0">-- Pilih --</option>
                                                    <option class="reg" value="111">Bukan PJ Pembayaran</option>
                                                    <option class="reg" value="112">PJ menolak verifikasi</option>
                                                    <option class="moss" value="113">Pelanggan Cancel Beli Produk</option>
                                                    <option class="moss" value="114">Dimatikan Pelanggan</option>
                                                    <option class="moss" value="115">Caring</option>
                                                    <option class="moss" value="116">Tidak Merasa Menginputkan No Hp</option>
                                                    <option class="moss" value="117">Didiamkan Pelanggan</option>
                                                    <option class="moss" value="118">Cuma Coba-Coba</option>
                                                    <option class="moss" value="119">Channel Sudah Aktif</option>
                                                    <option class="moss" value="120">Data Beda</option>
                                                    <option class="moss" value="121">Tidak Mau Ada Biaya Tambahan</option>
                                                    <option class="moss" value="122">Sdh Di Validasi</option>
                                                    <option class="moss" value="123">Menggunakan Prepaid</option>
                                                    <option class="moss" value="124">Masih Pikir - Pikir</option>
                                                    <option class="moss" value="125">Harga Mahal</option>
                                                    <option class="moss" value="126">Belum Perlu</option>
                                                    <option class="moss" value="127">Jarang Digunakan/Tonton</option>
                                                    <option class="moss" value="128">Sudah Berlangganan/Aktif</option>
                                                </select>
                                            </div>

                                            <div class="col-4 mb-3">
                                                <label for="status_call">Status Call</label>
                                                <select name="status_call" id="status_call" class="form-control">
                                                    <option class="veri_statusopt_p" value="0">-- Pilih --</option>
                                                    <option class="veri_statusopt_v" value="1">Verified</option>
                                                    <option class="veri_statusopt_nv" value="2">Not Verified</option>
                                                    <option class="veri_statusopt_dk" value="3">Ditelepon Kembali</option>
                                                </select>

                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea type="text" class="form-control" name='keterangan' placeholder="Keterangan"></textarea>
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
    <script>
        // jQuery plugin to prevent double submission of forms
        jQuery.fn.preventDoubleSubmission = function() {
            $(this).on('submit', function(e) {
                var $form = $(this);

                if ($form.data('submitted') === true) {
                    // Previously submitted - don't submit again
                    e.preventDefault();
                } else {
                    // Mark it so that the next submit can be ignored
                    $form.data('submitted', true);

                }
            });

            // Keep chainability
            return this;
        };


        $(document).ready(function() {


            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').hide();

            $("#add").click(function() {
                var lastField = $("#buildyourform div:last");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
                var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
                fieldWrapper.data("idx", intId);
                var fName = $(
                    "<td width=\"100%\"><input type=\"text\" id=\"hptambahan" + intId +
                    "\" name=\"hptambahan" + intId +
                    "\" class=\"fieldname form-control data-sending\" /></td>"
                );
                var fType = $(
                    ""
                );
                var removeButton = $(
                    "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
                );
                removeButton.click(function() {
                    $(this).parent().remove();
                });
                fieldWrapper.append(fName);
                fieldWrapper.append(fType);
                fieldWrapper.append(removeButton);
                $("#buildyourform").append(fieldWrapper);
            });
            $("#add2").click(function() {
                var lastField = $("#buildyourformemail div:last");
                var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
                var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
                fieldWrapper.data("idx", intId);
                var fName = $(
                    "<td width=\"100%\"><input type=\"email\" id=\"emailtambahan" + intId +
                    "\" name=\"emailtambahan" + intId +
                    "\" class=\"fieldname form-control data-sending\" /></td>"
                );
                var fType = $(
                    ""
                );
                var removeButton = $(
                    "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
                );
                removeButton.click(function() {
                    $(this).parent().remove();
                });
                fieldWrapper.append(fName);
                fieldWrapper.append(fType);
                fieldWrapper.append(removeButton);
                $("#buildyourformemail").append(fieldWrapper);
            });

            $("#billing").change(function() {
                var valna = $(this).val();
                var comma = valna.replace(",", "");
                var titik = comma.replace(".", "");
                var res = titik.replace("e", "");
                $(this).val(res);
            });
        });
        $('.opsicontacted').hide();
        $('#reason_decline_holder').hide();
        $('.opsinc').hide();
        $("#labelvalidated").show();
        $("#labelvalidate").hide();
        var Privileges = jQuery('#kat_call');
        var select = this.value;
        Privileges.change(function() {
            if ($(this).val() == '1') {
                $('.opsicontacted').show();
                $('.opsinc').hide();
                $('.veri_statusopt_p').show();
                $('.veri_statusopt_v').show();
                $('.veri_statusopt_dk').show();
                $('.veri_statusopt_nv').show();
            } else if ($(this).val() == '0') {
                $('.opsinc').show();
                $('.opsicontacted').hide();
                $('[name=status_call]').val(2);
                $('[name=sub_call]').val(0);
                $('.veri_statusopt_p').hide();
                $('.veri_statusopt_v').hide();
                $('.veri_statusopt_dk').hide();
            } else if ($(this).val() == 'x') {
                $('.opsinc').hide();
                $('.opsicontacted').hide();
                $('.veri_statusopt_p').hide();
                $('.veri_statusopt_v').hide();
                $('.veri_statusopt_dk').hide();
                $('.veri_statusopt_nv').hide();
            }

        });

        var Privileges = jQuery('#sub_call');
        var select = this.value;
        Privileges.change(function() {
            if ($(this).val() == '13') {
                $('[name=status_call]').val(1);
                $('.veri_statusopt_p').hide();
                $('.veri_statusopt_v').show();
                $('.veri_statusopt_dk').hide();
                $('.veri_statusopt_nv').hide();
                $('#reason_decline_holder').hide();
            } else if ($(this).val() == '12') {
                $('[name=status_call]').val(3);
                $('.veri_statusopt_p').hide();
                $('.veri_statusopt_v').hide();
                $('.veri_statusopt_dk').show();
                $('.veri_statusopt_nv').hide();
                $('#reason_decline_holder').hide();
            } else if ($(this).val() == '11') {
                $('[name=status_call]').val(2);
                $('.veri_statusopt_p').hide();
                $('.veri_statusopt_v').hide();
                $('.veri_statusopt_dk').hide();
                $('.veri_statusopt_nv').show();
                $('.rdeclinewrap').show();
                $('#reason_decline_holder').show();
            } else if ($(this).val() != '11' || $(this).val() != '12' || $(this).val() != '13' || $(this).val() != '0') {
                $('[name=status_call]').val(2);
                $('[name=kat_call]').val(0);
                $('.veri_statusopt_p').hide();
                $('.veri_statusopt_v').hide();
                $('.veri_statusopt_dk').hide();
                $('.veri_statusopt_nv').show();
                $('#reason_decline_holder').hide();
            }
            //     $('.opsicontacted').hide(); // hide div if value is not "custom"
            //     $('.opsinc').show(); // hide div if value is not "custom"
        });
    </script>
</body>
<!-- END: Body-->

</html>