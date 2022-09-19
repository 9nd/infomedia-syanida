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
    <title>Sy-Anida : Edit CWC</title>
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
                                        <form action="<?php echo base_url() ?>New_cwc/New_cwc/updatedata" method="post" enctype="multipart/form-data">

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
                                                                <input type="text" class="form-control" name='no_indri' placeholder="TRACK ID" value="<?php if (isset($datana)) {
                                                                                                                                                echo $datana->no_indri;
                                                                                                                                            } ?>" required>
                                                                <input type="text" class="form-control" name='id' placeholder="id" value="<?php if (isset($datana)) {
                                                                                                                                                echo $datana->id;
                                                                                                                                            } ?>" hidden>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="no_telp" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" name='no_telp' placeholder="Nomor Telepon" value="<?php if (isset($datana)) {
                                                                                                                                                    echo $datana->no_telp;
                                                                                                                                                } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="no_internet" class="col-sm-4 col-form-label">Nomor Internet</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control" name='no_internet' placeholder="Nomor Internet" value="<?php if (isset($datana)) {
                                                                                                                                                        echo $datana->no_internet;
                                                                                                                                                    } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama_pelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" name='nama_pelanggan' class="form-control" placeholder="Nama Pelanggan" value="<?php if (isset($datana)) {
                                                                                                                                                            echo $datana->nama_pelanggan;
                                                                                                                                                        } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="relasi" class="col-sm-4 col-form-label">Relasi Kepemilikan</label>
                                                            <div class="col-sm-7">
                                                            <select class="form-control" id="relasi" name="relasi" value="">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="pemilik" <?php if ($datana->relasi == 'pemilik') {
                                                                                            echo "selected";
                                                                                        } ?>>Pemilik</option>
                                                                <option value="bi" <?php if ($datana->relasi == 'bi') {
                                                                                        echo "selected";
                                                                                    } ?>>Bapak / Ibu</option>
                                                                <option value="si" <?php if ($datana->relasi == 'si') {
                                                                                        echo "selected";
                                                                                    } ?>>Suami / Istri</option>
                                                                <option value="anak" <?php if ($datana->relasi == 'anak') {
                                                                                            echo "selected";
                                                                                        } ?>>Anak</option>
                                                                <option value="kel" <?php if ($datana->relasi == 'kel') {
                                                                                        echo "selected";
                                                                                    } ?>>Keluarga</option>
                                                                <option value="kontrak" <?php if ($datana->relasi == 'kontrak') {
                                                                                             "selected";
                                                                                        } ?>>Kontrak</option>
                                                                <option value="karyawan" <?php if ($datana->relasi == 'karyawan') {
                                                                                                echo "selected";
                                                                                            } ?>>Karyawan</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-3">
                                                                <div class="col-sm-2 ml-2">
                                                                    <input class="form-check-input" type="radio" name="jk" id="l" value='l' <?php if ($datana->jk == 'l') {
                                                                                                                                    echo "checked='checked'";
                                                                                                                                } ?>>
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 ml-2">
                                                                    <input class="form-check-input" type="radio" name="jk" id="p" value='p' <?php if ($datana->jk == 'p') {
                                                                                                                                    echo "checked='checked'";
                                                                                                                                } ?>>
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
                                                            <input type="text" class="form-control" name='no_hp' placeholder="Handphone Utama" value="<?php if (isset($datana)) {
                                                                                                                                                echo $datana->no_hp;
                                                                                                                                            } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="no_hp_lain" class="col-sm-4 col-form-label">Handphone Lainnya</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='no_hp_lain' placeholder="Handphone Lainnya" value="<?php if (isset($datana)) {
                                                                                                                                                        echo $datana->no_hp_lain;
                                                                                                                                                    } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="wa" class="col-sm-4 col-form-label">Whatsapp</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='wa' placeholder="Whatsapp" value="<?php if (isset($datana)) {
                                                                                                                                    echo $datana->wa;
                                                                                                                                } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email_utama" class="col-sm-4 col-form-label">Email Utama</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='email_utama' placeholder="Email Utama" value="<?php if (isset($datana)) {
                                                                                                                                                echo $datana->email_utama;
                                                                                                                                            } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="email_lain" class="col-sm-4 col-form-label">Email Lainnya</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='email_lain' placeholder="Email Lainnya" value="<?php if (isset($datana)) {
                                                                                                                                                    echo $datana->email_lain;
                                                                                                                                                } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="fb" class="col-sm-4 col-form-label">Facebook</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='fb' placeholder="Facebook" value="<?php if (isset($datana)) {
                                                                                                                                    echo $datana->fb;
                                                                                                                                } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tw" class="col-sm-4 col-form-label">Twitter</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='tw' placeholder="Twitter" value="<?php if (isset($datana)) {
                                                                                                                                    echo $datana->tw;
                                                                                                                                } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ig" class="col-sm-4 col-form-label">Instagram</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='ig' placeholder="Instagram" value="<?php if (isset($datana)) {
                                                                                                                                        echo $datana->ig;
                                                                                                                                    } ?>">
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
                                                        Untuk mempermudah mendapat informasi terkait produk/promo, maaf bapak/ibu (nama pelanggan), apakah bapak/ibu aktif menggunakan media sosial seperti facebook, instagram, dan twitter? 
                                                        <br><br>
                                                        Boleh disebutkan nama akun bapak/ibu? ((agent menyebutkan ulang nama akun lalu spelling)
                                                    </label>

                                                </div>
                                                <hr style="border-left: 3px solid rgba(72, 94, 144, 0.16); min-height: 100%; max-height: 100vh; margin: 0; " />
                                                <div class="col-6 mb-2">
                                                    <div class="form-group row">
                                                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='v_nama' placeholder="Nama" value="<?php if (isset($datana)) {
                                                                                                                                    echo $datana->v_nama;
                                                                                                                                } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_alamat" class="col-sm-4 col-form-label">Alamat</label>
                                                        <div class="col-sm-7">
                                                            <textarea class="form-control" name='v_alamat' placeholder="Alamat" value="<?php if (isset($datana)) {
                                                                                                                                        echo $datana->v_alamat;
                                                                                                                                    } ?>"></textarea>
                                                            <!-- <input type="text" class="form-control" name='v_alamat' placeholder="Alamat" value=""> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_kota" class="col-sm-4 col-form-label">Kota</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='v_kota' placeholder="Kota" value="<?php if (isset($datana)) {
                                                                                                                                    echo $datana->igv_kota;
                                                                                                                                } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kecepatan" class="col-sm-4 col-form-label">Kecepatan</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="kecepatan" name="v_kecepatan" value="<?php if (isset($datana)) {
                                                                                                                            echo $datana->v_kecepatan;
                                                                                                                        } ?>">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="telp" <?php if ($datana->kecepatan == 'telp') {
                                                                                            echo "selected";
                                                                                        } ?>>Telpon Rumah Saja</option>
                                                                <option value="384" <?php if ($datana->kecepatan == '384') {
                                                                                        echo "selected";
                                                                                    } ?>>384 Kbps</option>
                                                                <option value="512" <?php if ($datana->kecepatan == '512') {
                                                                                        echo "selected";
                                                                                    } ?>>512 Kbps</option>
                                                                <option value="1" <?php if ($datana->kecepatan == '1') {
                                                                                        echo "selected";
                                                                                    } ?>>1 Mbps</option>
                                                                <option value="2" <?php if ($datana->kecepatan == '2') {
                                                                                        echo "selected";
                                                                                    } ?>>2 Mbps</option>
                                                                <option value="3" <?php if ($datana->kecepatan == '3') {
                                                                                        echo "selected";
                                                                                    } ?>>3 Mbps</option>
                                                                <option value="5" <?php if ($datana->kecepatan == '5') {
                                                                                        echo "selected";
                                                                                    } ?>>5 Mbps</option>
                                                                <option value="10" <?php if ($datana->kecepatan == '10') {
                                                                                        echo "selected";
                                                                                    } ?>>10 Mbps</option>
                                                                <option value="20" <?php if ($datana->kecepatan == '20') {
                                                                                        echo "selected";
                                                                                    } ?>>20 Mbps</option>
                                                                <option value="30" <?php if ($datana->kecepatan == '30') {
                                                                                        echo "selected";
                                                                                    } ?>>30 Mbps</option>
                                                                <option value="40" <?php if ($datana->kecepatan == '40') {
                                                                                        echo "selected";
                                                                                    } ?>>40 Mbps</option>
                                                                <option value="50" <?php if ($datana->kecepatan == '50') {
                                                                                        echo "selected";
                                                                                    } ?>>50 Mbps</option>
                                                                <option value="100" <?php if ($datana->kecepatan == '100') {
                                                                                        echo "selected";
                                                                                    } ?>>100 Mbps</option>
                                                                <option value="200" <?php if ($datana->kecepatan == '200') {
                                                                                        echo "selected";
                                                                                    } ?>>200 Mbps</option>
                                                                <option value="300" <?php if ($datana->kecepatan == '300') {
                                                                                        echo "selected";
                                                                                    } ?>>300 Mbps</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_tagihan" class="col-sm-4 col-form-label">Tagihan</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name="v_tagihan" placeholder="Tagihan" value="<?php if (isset($datana)) {
                                                                                                                                            echo $datana->v_tagihan;
                                                                                                                                        } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tp_bayar" class="col-sm-4 col-form-label">Tempat Bayar</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="tp_bayar" name="tp_bayar" value="">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="kredit" <?php if ($datana->tp_bayar == 'kredit') {
                                                                                            echo "selected";
                                                                                        } ?>>Bank - Kredit</option>
                                                                <option value="debit" <?php if ($datana->tp_bayar == 'debit') {
                                                                                            echo "selected";
                                                                                        } ?>>Bank - Debit</option>
                                                                <option value="e_com" <?php if ($datana->tp_bayar == 'e_com') {
                                                                                            echo "selected";
                                                                                        } ?>>E-commerce</option>
                                                                <option value="mm" <?php if ($datana->tp_bayar == 'mm') {
                                                                                        echo "selected";
                                                                                    } ?>>Minimarket</option>
                                                                <option value="telkom" <?php if ($datana->tp_bayar == 'telkom') {
                                                                                            echo "selected";
                                                                                        } ?>>Telkom & POS</option>
                                                                <option value="psb" <?php if ($datana->tp_bayar == 'psb') {
                                                                                        echo "selected";
                                                                                    } ?>>PSB</option>
                                                                <option value="others" <?php if ($datana->tp_bayar == 'others') {
                                                                                            echo "selected";
                                                                                        } ?>>Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_tagihan" class="col-sm-4 col-form-label">Bulan & Tahun Pasang</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name='th_pasang' placeholder="Bulan & Tahun Pasang" value="<?php if (isset($datana)) {
                                                                                                                                                        echo $datana->th_pasang;
                                                                                                                                                    } ?>">
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
                                                        Baik terima kasih Bapak/Ibu datanya sudah lengkap, <strong>perihal perubahan/penambahan pada (no hp/whatsapps/email)</strong> sudah kami perbarui dan sebagai bentuk verifikasinya, kami mengirimkan pesan ke (no hp/email terbaru) apakah Ibu/Bapak [nama_pelanggan] sudah menerima pesan dari IndiHome?
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
                                                                <option value="0" <?php if ($datana->v_email == '0') {
                                                                                        echo "selected";
                                                                                    } ?>>Belum Dicek</option>
                                                                <option value="13" <?php if ($datana->v_email == '13') {
                                                                                        echo "selected";
                                                                                    } ?>>verified</option>
                                                                <option value="11" <?php if ($datana->v_email == '11') {
                                                                                        echo "selected";
                                                                                    } ?>>decline</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="v_sms" class="col-sm-4 col-form-label">Verifikasi SMS</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="v_sms" name="v_sms">
                                                                <option value="0" <?php if ($datana->v_sms == '0') {
                                                                                        echo "selected";
                                                                                    } ?>>Belum Dicek</option>
                                                                <option value="13" <?php if ($datana->v_sms == '13') {
                                                                                        echo "selected";
                                                                                    } ?>>verified</option>
                                                                <option value="11" <?php if ($datana->v_sms == '11') {
                                                                                        echo "selected";
                                                                                    } ?>>decline</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="opsi_call" class="col-sm-4 col-form-label">Opsi Call</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="opsi_call" name="opsi_call" value="">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="telp_rumah" <?php if ($datana->opsi_call == 'telp_rumah') {
                                                                                                echo "selected";
                                                                                            } ?>>Telepon Rumah</option>
                                                                <option value="hp" <?php if ($datana->opsi_call == 'hp') {
                                                                                        echo "selected";
                                                                                    } ?>>Handphone</option>
                                                                <option value="email" <?php if ($datana->opsi_call == 'email') {
                                                                                            echo "selected";
                                                                                        } ?>>Email</option>
                                                                <option value="wa" <?php if ($datana->opsi_call == 'wa') {
                                                                                        echo "selected";
                                                                                    } ?>>Whatsapp</option>
                                                                <option value="sms" <?php if ($datana->opsi_call == 'sms') {
                                                                                        echo "selected";
                                                                                    } ?>>SMS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="kat_call" class="col-sm-4 col-form-label">Kategori Call</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="kat_call" name="kat_call" value="" required>
                                                                <option value="x">Pilih..</option>
                                                                <option value="1" <?php if ($datana->kat_call == '1') {
                                                                                        echo "selected";
                                                                                    } ?>>Contacted</option>
                                                                <option value="0" <?php if ($datana->kat_call == '0') {
                                                                                        echo "selected";
                                                                                    } ?>>Not Contacted</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="sub_call" class="col-sm-4 col-form-label">Sub Kategori Call</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control data-sending" id="sub_call" name="sub_call" value="" required>
                                                                <option value="0">-- Pilih --</option>
                                                                <option class="opsinc" value="2" <?php if ($datana->sub_call == '2') {
                                                                                                        echo "selected";
                                                                                                    } ?>>RNA</option>
                                                                <option class="opsinc" value="4" <?php if ($datana->sub_call == '4') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Salah Sambung</option>
                                                                <option class="opsinc" value="7" <?php if ($datana->sub_call == '7') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Isolir</option>
                                                                <option class="opsinc" value="8" <?php if ($datana->sub_call == '8') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Mailbox</option>
                                                                <option class="opsinc" value="9" <?php if ($datana->sub_call == '9') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Telepon Sibuk</option>
                                                                <option class="opsinc" value="10" <?php if ($datana->sub_call == '10') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Rejected</option>
                                                                <option class="opsicontacted" value="11" <?php if ($datana->sub_call == '11') {
                                                                                                                echo "selected";
                                                                                                            } ?>>Decline</option>
                                                                <option class="opsicontacted" value="12" <?php if ($datana->sub_call == '12') {
                                                                                                                echo "selected";
                                                                                                            } ?>>Follow Up</option>
                                                                <option class="opsicontacted" value="13" <?php if ($datana->sub_call == '13') {
                                                                                                                echo "selected";
                                                                                                            } ?>>Verified</option>
                                                                <option class="opsinc" value="14" <?php if ($datana->sub_call == '14') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Reject By System</option>
                                                                <option class="opsinc" value="15" <?php if ($datana->sub_call == '15') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Cabut</option>
                                                                <option class="opsinc" value="16" <?php if ($datana->sub_call == '16') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Invalid Number</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" id='reason_decline_holder'>
                                                        <label for="reason_decline" class="col-sm-4 col-form-label">Reason Decline</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control data-sending" id="reason_decline" name="reason_decline">
                                                                <option value="0">-- Pilih --</option>
                                                                <option class="reg" value="111" <?php if ($datana->reason_decline == '111') {
                                                                                                    echo "selected";
                                                                                                } ?>>Bukan PJ Pembayaran</option>
                                                                <option class="reg" value="112" <?php if ($datana->reason_decline == '112') {
                                                                                                    echo "selected";
                                                                                                } ?>>PJ menolak verifikasi</option>
                                                                <option class="moss" value="113" <?php if ($datana->reason_decline == '113') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Pelanggan Cancel Beli Produk</option>
                                                                <option class="moss" value="114" <?php if ($datana->reason_decline == '114') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Dimatikan Pelanggan</option>
                                                                <option class="moss" value="115" <?php if ($datana->reason_decline == '115') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Caring</option>
                                                                <option class="moss" value="116" <?php if ($datana->reason_decline == '116') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Tidak Merasa Menginputkan No Hp</option>
                                                                <option class="moss" value="117" <?php if ($datana->reason_decline == '117') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Didiamkan Pelanggan</option>
                                                                <option class="moss" value="118" <?php if ($datana->reason_decline == '118') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Cuma Coba-Coba</option>
                                                                <option class="moss" value="119" <?php if ($datana->reason_decline == '119') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Channel Sudah Aktif</option>
                                                                <option class="moss" value="120" <?php if ($datana->reason_decline == '120') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Data Beda</option>
                                                                <option class="moss" value="121" <?php if ($datana->reason_decline == '121') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Tidak Mau Ada Biaya Tambahan</option>
                                                                <option class="moss" value="122" <?php if ($datana->reason_decline == '122') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Sdh Di Validasi</option>
                                                                <option class="moss" value="123" <?php if ($datana->reason_decline == '123') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Menggunakan Prepaid</option>
                                                                <option class="moss" value="124" <?php if ($datana->reason_decline == '124') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Masih Pikir - Pikir</option>
                                                                <option class="moss" value="125" <?php if ($datana->reason_decline == '125') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Harga Mahal</option>
                                                                <option class="moss" value="126" <?php if ($datana->reason_decline == '126') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Belum Perlu</option>
                                                                <option class="moss" value="127" <?php if ($datana->reason_decline == '127') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Jarang Digunakan/Tonton</option>
                                                                <option class="moss" value="128" <?php if ($datana->reason_decline == '128') {
                                                                                                        echo "selected";
                                                                                                    } ?>>Sudah Berlangganan/Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="status_call" class="col-sm-4 col-form-label">Status Call</label>
                                                        <div class="col-sm-7">
                                                            <select name="status_call" id="status_call" class="form-control" value="" required>
                                                                <option class="veri_statusopt_p" value="0" <?php if ($datana->status_call == '0') {
                                                                                                                echo "selected";
                                                                                                            } ?>>-- Pilih --</option>
                                                                <option class="veri_statusopt_v" value="1" <?php if ($datana->status_call == '1') {
                                                                                                                echo "selected";
                                                                                                            } ?>>Verified</option>
                                                                <option class="veri_statusopt_nv" value="2" <?php if ($datana->status_call == '2') {
                                                                                                                echo "selected";
                                                                                                            } ?>>Not Verified</option>
                                                                <option class="veri_statusopt_dk" value="3" <?php if ($datana->status_call == '3') {
                                                                                                                echo "selected";
                                                                                                            } ?>>Ditelepon Kembali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                                        <div class="col-sm-7">
                                                            <textarea type="text" class="form-control" name='keterangan' placeholder="Keterangan"><?php if (isset($datana)) {
                                                                                                                                            echo $datana->keterangan;
                                                                                                                                        } ?></textarea>
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
<!--END: Body-- >

</html>