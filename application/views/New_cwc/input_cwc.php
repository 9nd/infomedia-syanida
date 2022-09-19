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
    <title>Sy-Anida : Input CWC</title>
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
                <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Dashboard</a>
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url() . "New_cwc/New_cwc" ?>"><i class="icon-chart mr-1"></i> Input CWC</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . "New_cwc/New_cwc/report" ?>"><i class="icon-chart mr-1"></i> Report</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . "New_cwc/New_cwc/history_call" ?>"><i class="icon-chart mr-1"></i> History Call</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- START: Main Content-->
    <!-- <div id="mySidebar" class="sidebar2 w3-animate-left">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>

        <h6>SALAM PEMBUKA</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Halo, Selamat Pagi/Siang/Sore/ Malam
                Perkenalkan dengan saya (nama agent) dari Team Profiling Customer Indihome PT. Telkom Indonesia.
                <br><br>
                Maaf mengganggu waktunya sebentar pak/ bu.
                <br>
                Apakah betul saya terhubung di nomor telepon/internet xxxx xxxx xxxx, atas nama (title) (nama tertera di aplikasi)?
                Maaf, dengan bapak/ibu siapa saya berbicara?
                <br><br>
                Jika tidak terhubung dengan pemilik
                Baik, pak/bu, hubungan kekerabatan bapak/ ibu dengan bapak/ ibu (nama tertera di aplikasi), selaku siapanya?

            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>MEMASTIKAN YANG BERTANGGUNG JAWAB</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Jika terhubung dengan pemilik telepon:
                Yang bertanggung jawab untuk pembayaran tagihan produk telkomnya, dengan bapak/ ibu sendiri?
                <br><br>
                Jika tidak terhubung dengan pemilik telepon:
                Yang bertanggung jawab untuk pembayaran tagihan produk telkom dinomor xxx xxxxx dengan siapa pak/ bu?
                <br><br>
                Bisa saya berbicara dengan bapak/ ibu (sebutkan nama yang diinformasikan pelanggan)
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>MENANYAKAN KABAR</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Bagaimana keadaan bapak/ ibu (nama tertera di aplikasi) sehat? (tunggu jawaban pelanggan)
                Semoga sehat selalu ya, pak/ bu.
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>TUJUAN</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Begini pak/bu. kami ditugaskan pihak Telkom untuk mengupdate data tujuan kedepannya *mempermudah Bapak/Ibu menerima informasi mengenai Program Loyalti, Produk dan Promo Telkom terbaru serta Percepatan Perbaikan jika berkendala pada Telepon rumah atau Internet nya*
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>VERIFIKASI HP & EMAIL</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                mohon dibantu sebentar untuk kelengkapan datanya
                <br><br>
                Untuk nomor handphone yang kami hubungi di nomor ini ya pak/ ibu (nama pelanggan) (sebutkan no nya)?
                No handphone bapak/ ibu (nama pelanggan) apakah terhubung dengan whatsApp?
                <br><br>
                Untuk alamat email pak/ bu apakah ada?
                Apabila sudah tercantum di aplikasi, tanyakan kembali,
                <br><br>
                Di sini tertera alamat emailnya xxxxxxxxxx, apakah masih aktif pak/bu? Kami ejakan...
                <br><br>
                * Apabila ada pergantian PJP/pelanggan meminta menambahkan/mengganti no hp /emainya, agent wajib menanyakan kembali no/email yang aktif
                <br><br>
                Handphone
                Untuk no handphonenya bisa disebutkan ulang pak/bu? (agent mengulang no hp pelanggan yang terbaru)
                No handphone bapak/ ibu (nama pelanggan) apakah terhubung dengan whatsApp? (apabila tidak terhubung, agent wajib menanyakan no hp yang terhubung whatsapp pelanggan)
                Email
                Untuk alamat email aktifnya apa ya pak/bu?(agent menyebutkan ulang email lalu spelling)
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>VERIFIKASI</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                a. Untuk alamat, apakah ada perubahan pak/ bu (nama pelanggan)? baik pak/ bu, boleh disebutkan di jalan (sebutkan nama jalan besarnya saja) no rumahnya no berapa ya? Rt berapa? Rw berapa?
                <br><br>
                b. Maaf pak/ bu (nama pelanggan) untuk persamaan data, apakah betul tagihan terakhir yang dibayarkan berjumlah (cek aplikasi) ?
                <br><br>
                c. Jika pak/ bu (nama pelanggan), tidak keberatan, bisa disebutkan untuk tempat pembayaran terakhir dilakukan dimana?
                <br><br>
                d. Apakah betul Bapak/ ibu (nama pelanggan) menggunakan produk Telkom mulai tahun xxxx?
                <br><br>
                e. Selain telepon, apakah bapak/ ibu (nama pelanggan) juga menggunakan internet? Boleh dibantu untuk kecepatan internet yang bapak/ ibu gunakan sekarang?
                Bagaimana telepon/internet yang bapak/ ibu (nama tertera di aplikasi) gunakan, lancar? Semoga lancar selalu ya, pak/ bu.
                *apabila pl mengeluhkan kondisinya, agent wajib menyampaikan permohonan maaf atas ketidaknyamannya dan berikan solusi.
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>OPSI CHANNEL</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Kedepannya Bapak/Ibu Lebih berkenan kami hubungi kembali melalu Telepon Rumah, Handphone, Email, Pesan Whatsapp, atau SMS?
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>KODE VERIFIKASI</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                "Baik terima kasih Bapak/Ibu datanya sudah lengkap, perihal perubahan/penambahan pada (no hp/whatsapps/email) sudah kami perbarui dan sebagai bentuk verifikasinya, kami mengirimkan pesan ke (no hp/email terbaru) apakah Ibu/Bapak [nama_pelanggan] sudah menerima pesan dari IndiHome?
                <br><br>
                Jika pelanggan infokan sudah masuk
                Agent menjawab Setelah telepon ini berakhir, mohon dicek bapak/ibu, pada pesan (sms/wa/email) yang kami kirimkan. Pada pesan yang kami kirimkan terdapat link dari Indihome, Silakan klik link tersebut sebagai bentuk approval/persetujuan bahwa data yang bapak/ibu berikan kepada kami sudah SESUAI dan DATA SUDAH TERVERIFIKASI"
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>KONFIRMASI</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Baik bapak/ibu verifikasi sudah selesai. <br>
                Perihal informasinya sudah cukup jelas ya Bapak/Ibu? <br>
                Ada lagi yang bisa kami bantu, pak/bu? <br>
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>SALAM PENUTUP</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Terimakasih atas waktunya Bapak/Ibu (Nama Pelanggan), kami senantiasa menjamin kerahasiaan data pelanggan.
                Selamat (Pagi/Siang/Sore/Malam) Selamat beraktifitas kembali/Semoga sehat selalu
            </label>
        </ul>
        <hr class="float-left w-100" />

        <h6>CALL BACK</h6>
        <ul class="list-inline float-left claerfix">
            <label>
                Halo, Selamat Pagi/Siang/Sore/ Malam <br>
                Perkenalkan dengan saya (nama agent) dari Team Profiling Customer Indihome PT. Telkom Indonesia.
                <br><br>
                Dengan ibu (nama pelanggan yang terverifikasi) saya berbicara?
                <br><br>
                Maaf mengganggu waktunya sebentar pak/ bu.
                terkait verifikasi yang kami lakukan (sebutkan waktu; misal kemarin), apakah bapak/ibu sudah menerima pesan dari indihomenya?
                pesan dari indihome berupa link, (apabila sudah) Silakan klik link tersebut sebagai sebagai bentuk approval bahwa data yang ibu berikan kepada kami sudah SESUAI dan DATA SUDAH TERVERIFIKASI.
                <br><br>
                Terimakasih atas waktunya Bapak/Ibu (Nama Pelanggan), kami senantiasa menjamin kerahasiaan data pelanggan.
            </label>
        </ul>
        <hr class="float-left w-100" />
    </div> -->
    <main id="main">

        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">

                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <!-- <button class="openbtn" onclick="openNav()">☰ SCRIPT</button> -->
                            <h4 class="mb-0">Input CWC</h4>

                        </div>
                        <div class="btn-sm btn-danger col-2" id="closet">
                            <i class="fa fa-close"></i>Not Contacted
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-12 mt-1">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Form Call Work Code</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <form action="<?php echo base_url() ?>New_cwc/New_cwc/insertdata" method="post" enctype="multipart/form-data">

                                            <div class="form-row">
                                                <div class="vertikal" style="display: flex;">
                                                    <div class="col-6 mb-2">
                                                        <h6>SALAM PEMBUKA</h6>
                                                        <br>
                                                        <label>
                                                            Halo, Selamat Pagi/Siang/Sore/ Malam
                                                            <br>
                                                            Perkenalkan dengan saya (nama agent) dari Team Profiling Customer Indihome PT. Telkom Indonesia.
                                                            <br><br>
                                                            Maaf mengganggu waktunya sebentar pak/ bu.
                                                            <br><br>
                                                            Apakah betul saya terhubung di nomor telepon/internet xxxx xxxx xxxx, atas nama (title) (nama tertera di aplikasi)?
                                                            <br>
                                                            Maaf, dengan bapak/ibu siapa saya berbicara?
                                                            <br><br>
                                                            <strong><u>Jika tidak terhubung dengan pemilik</u>
                                                            <br>
                                                            Baik, pak/bu, hubungan kekerabatan bapak/ ibu dengan bapak/ ibu (nama tertera di aplikasi), selaku siapanya?
                                                            <br><br>
                                                            Jika terhubung dengan pemilik telepon:
                                                            <br>
                                                            Yang bertanggung jawab untuk pembayaran tagihan produk telkomnya, dengan bapak/ ibu sendiri?
                                                            <br><br>
                                                            Jika tidak terhubung dengan pemilik telepon:
                                                            <br>
                                                            Yang bertanggung jawab untuk pembayaran tagihan produk telkom dinomor xxx xxxxx dengan siapa pak/ bu?</strong>
                                                            <br><br>
                                                            Bisa saya berbicara dengan bapak/ ibu (sebutkan nama yang diinformasikan pelanggan)
                                                            <br><br>
                                                            Bagaimana keadaan bapak/ ibu (nama tertera di aplikasi) sehat? (tunggu jawaban pelanggan)
                                                            <br>
                                                            Semoga sehat selalu ya, pak/ bu.
                                                            <br><br>
                                                            Begini pak/bu. kami ditugaskan pihak Telkom untuk mengupdate data tujuan kedepannya <strong>*mempermudah Bapak/Ibu menerima informasi mengenai Program Loyalti, Produk dan Promo Telkom terbaru serta Percepatan Perbaikan jika berkendala pada Telepon rumah atau Internet nya*</strong>
                                                        </label>

                                                    </div>
                                                    <hr style="border-left: 3px solid rgba(72, 94, 144, 0.16); min-height: 100%; max-height: 100vh; margin: 0; " />
                                                    <div class="col-6 mb-2">
                                                        <div class="form-group row">
                                                            <label for="no_indri" class="col-sm-4 col-form-label">Track ID</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" name='no_indri' placeholder="Track ID" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="no_telp" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" name='no_telp' placeholder="Nomor Telepon" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="no_internet" class="col-sm-4 col-form-label">Nomor Internet</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" name='no_internet' placeholder="Nomor Internet" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama_pelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name='nama_pelanggan' class="form-control" placeholder="Nama Pelanggan" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="relasi" class="col-sm-4 col-form-label">Relasi Kepemilikan</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control" id="relasi" name="relasi" value="">
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
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-3">
                                                                <div class="col-sm-2 ml-2">
                                                                    <input class="form-check-input" type="radio" name="jk" id="l" value='l' value="">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 ml-2">
                                                                    <input class="form-check-input" type="radio" name="jk" id="p" value='p' value="">
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
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Konfirmasi Email & Nomor HP</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-row">
                                            <div class="vertikal" style="display: flex;">
                                                <div class="col-6 mb-2">
                                                    <h6>VERIFIKASI HP & EMAIL</h6>
                                                    <br>
                                                    <label>
                                                        Mohon dibantu sebentar untuk kelengkapan datanya
                                                        <br><br>
                                                        Untuk nomor handphone yang kami hubungi di nomor ini ya pak/ ibu (nama pelanggan) (sebutkan no nya)?
                                                        <br>
                                                        No handphone bapak/ ibu (nama pelanggan) apakah terhubung dengan whatsApp?
                                                        <br><br>
                                                        Untuk alamat email pak/ bu apakah ada?
                                                        <br><br>
                                                        <strong>Apabila sudah tercantum di aplikasi, tanyakan kembali,</strong>
                                                        <br>
                                                        Di sini tertera alamat emailnya xxxxxxxxxx, apakah masih aktif pak/bu? Kami ejakan...
                                                        <br><br>
                                                        <i>* Apabila ada pergantian PJP/pelanggan meminta menambahkan/mengganti no hp /emainya, agent wajib menanyakan kembali no/email yang aktif</i>
                                                        <br><br>
                                                        <strong>Handphone</strong>
                                                        <br>
                                                        Untuk no handphonenya bisa disebutkan ulang pak/bu? (agent mengulang no hp pelanggan yang terbaru)
                                                        <br>
                                                        No handphone bapak/ ibu (nama pelanggan) apakah terhubung dengan whatsApp? (apabila tidak terhubung, agent wajib menanyakan no hp yang terhubung whatsapp pelanggan)
                                                        <br><br>
                                                        <strong>Email</strong>
                                                        <br>
                                                        Boleh dibantu, untuk alamat email aktifnya apa ya pak/bu?(agent menyebutkan ulang email lalu spelling)
                                                    </label>
                                                </div>
                                                <hr style="border-left: 3px solid rgba(72, 94, 144, 0.16); min-height: 100%; max-height: 100vh; margin: 0; " />
                                                <div class="col-6 mb-2">
                                                    <div class="form-group row">
                                                        <label for="no_hp" class="col-sm-4 col-form-label">Handphone Utama</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='no_hp' placeholder="Handphone Utama" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="no_hp_lain" class="col-sm-4 col-form-label">Handphone Lainnya</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='no_hp_lain' placeholder="Handphone Lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="wa" class="col-sm-4 col-form-label">Whatsapp</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='wa' placeholder="Whatsapp" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email_utama" class="col-sm-4 col-form-label">Email Utama</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='email_utama' placeholder="Email Utama" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email_lain" class="col-sm-4 col-form-label">Email Lainnya</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='email_lain' placeholder="Email Lainnya">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="fb" class="col-sm-4 col-form-label">Facebook</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='fb' placeholder="Facebook">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tw" class="col-sm-4 col-form-label">Twitter</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='tw' placeholder="Twitter">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ig" class="col-sm-4 col-form-label">Instagram</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='ig' placeholder="Instagram">
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
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Verifikasi</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-row">
                                            <div class="vertikal" style="display: flex;">
                                                <div class="col-6 mb-2">
                                                    <h6>VERIFIKASI</h6>
                                                    <br>
                                                    <label>
                                                        a. Untuk alamat, apakah ada perubahan pak/ bu (nama pelanggan)? baik pak/ bu, boleh disebutkan di jalan (sebutkan nama jalan besarnya saja) no rumahnya no berapa ya? Rt berapa? Rw berapa?
                                                        <br><br>
                                                        b. Maaf pak/ bu (nama pelanggan) untuk persamaan data, apakah betul tagihan terakhir yang dibayarkan berjumlah (cek aplikasi) ?
                                                        <br><br>
                                                        c. Jika pak/ bu (nama pelanggan), tidak keberatan, bisa disebutkan untuk tempat pembayaran terakhir dilakukan dimana?
                                                        <br><br>
                                                        d. Apakah betul Bapak/ ibu (nama pelanggan) menggunakan produk Telkom mulai tahun xxxx?
                                                        <br><br>
                                                        e. Selain telepon, apakah bapak/ ibu (nama pelanggan) juga menggunakan internet? Boleh dibantu untuk kecepatan internet yang bapak/ ibu gunakan sekarang?
                                                        <br>
                                                        Bagaimana telepon/internet yang bapak/ ibu (nama tertera di aplikasi) gunakan, lancar? Semoga lancar selalu ya, pak/ bu.
                                                        <br><i>*apabila pl mengeluhkan kondisinya, agent wajib menyampaikan permohonan maaf atas ketidaknyamannya dan berikan solusi.</i>
                                                        <br><br>
                                                        Kedepannya Bapak/Ibu (nama pelanggan) lebih berkenan kami hubungi kembali melalu Telepon Rumah, Handphone, Email, Pesan Whatsapp, atau SMS?
                                                        <br><br>
                                                        Untuk mempermudah mendapat informasi terkait produk/promo, maaf bapak/ibu (nama pelanggan), apakah bapak/ibu aktif menggunakan media ssosial seperti facebook, instagram, dan twitter? 
                                                        <br><br>
                                                        Boleh disebutkan nama akun bapak/ibu? ((agent menyebutkan ulang nama akun lalu spelling)
                                                    </label>

                                                </div>
                                                <hr style="border-left: 3px solid rgba(72, 94, 144, 0.16); min-height: 100%; max-height: 100vh; margin: 0; " />
                                                <div class="col-6 mb-2">
                                                    <div class="form-group row">
                                                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='v_nama' placeholder="Nama" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_alamat" class="col-sm-4 col-form-label">Alamat</label>
                                                        <div class="col-sm-7">
                                                            <textarea class="form-control" name='v_alamat' placeholder="Alamat" value=""></textarea>
                                                            <!-- <input type="text" class="form-control" name='v_alamat' placeholder="Alamat" value=""> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_kota" class="col-sm-4 col-form-label">Kota</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='v_kota' placeholder="Kota" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kecepatan" class="col-sm-4 col-form-label">Kecepatan</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="kecepatan" name="v_kecepatan" value="">
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
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_tagihan" class="col-sm-4 col-form-label">Tagihan</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name="v_tagihan" placeholder="Tagihan" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tp_bayar" class="col-sm-4 col-form-label">Tempat Bayar</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="tp_bayar" name="tp_bayar" value="">
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
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_tagihan" class="col-sm-4 col-form-label">Bulan & Tahun Pasang</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='th_pasang' placeholder="Bulan & Tahun Pasang" value="">
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
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Closing</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-row">
                                            <div class="vertikal" style="display: flex;">
                                                <div class="col-6 mb-2">
                                                    <h6>KODE VERIFIKASI & KONFIRMASI</h6>
                                                    <br>
                                                    <label>
                                                        "Baik terima kasih Bapak/Ibu datanya sudah lengkap, <strong>perihal perubahan/penambahan pada (no hp/whatsapps/email)</strong> sudah kami perbarui dan sebagai bentuk verifikasinya, kami mengirimkan pesan ke (no hp/email terbaru) apakah Ibu/Bapak [nama_pelanggan] sudah menerima pesan dari IndiHome?
                                                        <br><br>
                                                        <strong>Jika pelanggan infokan sudah masuk
                                                        <br>
                                                        Agent menjawab;</strong>
                                                        <br>
                                                        Setelah telepon ini berakhir, mohon dicek bapak/ibu, pada pesan (sms/wa/email) yang kami kirimkan. <strong>Pada pesan yang kami kirimkan terdapat link dari Indihome, Silakan klik link tersebut sebagai bentuk approval/persetujuan bahwa data yang bapak/ibu berikan kepada kami sudah SESUAI dan DATA SUDAH TERVERIFIKASI</strong>
                                                        <br><br>
                                                        Baik bapak/ibu verifikasi sudah selesai. <br>
                                                        Perihal informasinya sudah cukup jelas ya Bapak/Ibu? <br>
                                                        Ada lagi yang bisa kami bantu, pak/bu? <br>
                                                        <br><br>
                                                        Terimakasih atas waktunya Bapak/Ibu (Nama Pelanggan), kami senantiasa menjamin kerahasiaan data pelanggan.
                                                        <br>
                                                        (Selamat (Pagi/Siang/Sore/Malam) <i>*(Selamat beraktifitas kembali/Semoga sehat selalu/Selamat beristirahat, Sukses selalu)</i>
                                                        <br><br>
                                                        <h6>CALL BACK</h6>
                                                        <br>
                                                        Halo, Selamat Pagi/Siang/Sore/ Malam <br>
                                                        Perkenalkan dengan saya (nama agent) dari Team Profiling Customer Indihome PT. Telkom Indonesia.
                                                        <br><br>
                                                        Dengan ibu (nama pelanggan yang terverifikasi) saya berbicara?
                                                        <br><br>
                                                        Maaf mengganggu waktunya sebentar pak/ bu.
                                                        <br><br>
                                                        terkait verifikasi yang kami lakukan (sebutkan waktu; misal kemarin), apakah bapak/ibu (nama pelanggan) sudah menerima pesan dari indihomenya?
                                                        <br><br>
                                                        Apakah ada kendala yang dirasakan, bapak/ibu (nama pelanggan)
                                                        <br><br>
                                                        pesan yang kami kirimkan dari IndiHome ini isinya berupa link, (apabila sudah) Silakan klik link tersebut sebagai sebagai bentuk approval/persetujuan bahwa data yang ibu berikan kepada kami sudah SESUAI dan DATA SUDAH TERVERIFIKASI.
                                                        <br><br>
                                                        Terimakasih atas waktunya Bapak/Ibu (Nama Pelanggan), kami senantiasa menjamin kerahasiaan data pelanggan.
                                                    </label>

                                                </div>
                                                <hr style="border-left: 3px solid rgba(72, 94, 144, 0.16); min-height: 100%; max-height: 100vh; margin: 0; " />
                                                <div class="col-6 mb-2">
                                                    <div class="form-group row">
                                                        <label for="v_email" class="col-sm-4 col-form-label">Verifikasi Email</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="v_email" name="v_email">
                                                                <option value="0">Belum Dicek</option>
                                                                <option value="13">verified</option>
                                                                <option value="11">decline</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_sms" class="col-sm-4 col-form-label">Verifikasi SMS</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="v_sms" name="v_sms">
                                                                <option value="0">Belum Dicek</option>
                                                                <option value="13">verified</option>
                                                                <option value="11">decline</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="opsi_call" class="col-sm-4 col-form-label">Opsi Call</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="opsi_call" name="opsi_call" value="">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="telp_rumah">Telepon Rumah</option>
                                                                <option value="hp">Handphone</option>
                                                                <option value="email">Email</option>
                                                                <option value="wa">Whatsapp</option>
                                                                <option value="sms">SMS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kat_call" class="col-sm-4 col-form-label">Kategori Call</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="kat_call" name="kat_call" value="" required>
                                                                <option value="x">Pilih..</option>
                                                                <option value="1">Contacted</option>
                                                                <option value="0">Not Contacted</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="sub_call" class="col-sm-4 col-form-label">Sub Kategori Call</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control data-sending" id="sub_call" name="sub_call" value="" required>
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
                                                    </div>
                                                    <div class="form-group row" id='reason_decline_holder'>
                                                        <label for="reason_decline" class="col-sm-4 col-form-label">Reason Decline</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control data-sending" id="reason_decline" name="reason_decline" value="">
                                                                <option value="0">-- Pilih --</option>
                                                                <option class="reg" value="111">Bukan PJ Pembayaran</option>
                                                                <option class="reg" value="112">PJ menolak verifikasi</option>
                                                                <!-- <option class="moss" value="113">Pelanggan Cancel Beli Produk</option>
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
                                                                <option class="moss" value="128">Sudah Berlangganan/Aktif</option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="status_call" class="col-sm-4 col-form-label">Status Call</label>
                                                        <div class="col-sm-7">
                                                            <select name="status_call" id="status_call" class="form-control" value="">
                                                                <option class="veri_statusopt_p" value="0">-- Pilih --</option>
                                                                <option class="veri_statusopt_v" value="1">Verified</option>
                                                                <option class="veri_statusopt_nv" value="2">Not Verified</option>
                                                                <option class="veri_statusopt_dk" value="3">Ditelepon Kembali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                                        <div class="col-sm-7">
                                                            <textarea type="text" class="form-control" name='keterangan' placeholder="Keterangan"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right mt-4">
                                                        <button type="submit" class="submit-btn btn btn-primary">Submit</button>
                                                    </div>
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


    <script>
        function openbtn() {
            document.getElementById("main").style.marginLeft = "25%";
            document.getElementById("mySidebar").style.width = "25%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openbtn").style.display = 'none';
        }

        function closebtn() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openbtn").style.display = "inline-block";
        }
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "300px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
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
            //prevent reason call kosong

            $('form').submit(function() {

                var kat_call = $.trim($('#kat_call').val()); //x
                var sub_call = $.trim($('#sub_call').val()); //0
                var status_call = $.trim($('#status_call').val()); //0

                if (kat_call === 'x') {
                    alert('kategori call tidak boleh kosong');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#kat_call").offset().top
                    }, 100);
                    return false;
                } else if (sub_call === '0') {
                    alert('sub call tidak boleh kosong');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#sub_call").offset().top
                    }, 100);
                    return false;
                } else if (status_call === '0') {
                    alert('status call tidak boleh kosong');
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#status_call").offset().top
                    }, 100);
                    return false;
                }

            });

            //end prevent

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
    <script>
        $("#closet").click(function() {
            $('[name=kat_call]').val(0);
            $('[name=sub_call]').val(2);
            $('.opsinc').show();
            $('.opsicontacted').hide();
            $('[name=status_call]').val(2);
            $('[name=kat_call]').val(0);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#kat_call").offset().top
            }, 100);
        });
    </script>
</body>
<!--END: Body-- >

            <
            /html>