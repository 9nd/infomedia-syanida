<body>
    <!-- <body style="background-color:#00acee;color:white;"> -->
    <!--
	Ideally these elements aren't created until it's confirmed that the 
	client supports video/camera, but for the sake of illustrating the 
	elements involved, they are created with markup (not JavaScript)
-->
    <!-- <table width="100%">
        <tr>
            <td width="33%">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>
            <td width="34%" style="text-align:center;">
                <h1>PROFILING HOME PAGE</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
            </td>
        </tr>
    </table> -->
    <table width="100%">
        <?php
        if ($input_absen || isset($_GET['pulang'])) {
        ?>
            <tr style="display:none;" id="camera_area">
                <td width="15%">

                </td>
                <td width="35%"><video id="video" width="420px" height="313px"></video></td>
                <td width="35%"><canvas id="canvas" width="420px" height="313px"></canvas></td>
                <td width="15%">

                </td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td width="15%"></td>
            <td colspan="2" width="70%">
                <div class="card-body">

                    <div class="row">

                        <?php
                        if ($input_absen) {
                        ?>
                            <div class="col-sm-6">
                                <button id="snap" class="card p-3 btn btn-danger btn-card">
                                    <div class="d-flex align-items-center">
                                        <span class="stamp stamp-md bg-red mr-3">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                        <div class="text-left">
                                            <p class="m-0 text-red">Check In</p>
                                            <small class="text-muted">Click tombol absen!</small>
                                        </div>
                                    </div>

                                </button>
                            </div>
                        <?php
                        }
                        ?>




                        <?php
                        if (!$input_absen) {
                        ?>
                            <div class="col-sm-6">
                                <?php
                                if (isset($_GET['pulang'])) {
                                ?>
                                    <button id="snap" class="card p-3 btn btn-danger btn-card">
                                        <div class="d-flex align-items-center">
                                            <span class="stamp stamp-md bg-red mr-3">
                                                <i class="fe fe-camera"></i>
                                            </span>
                                            <div class="text-left">
                                                <p class="m-0 text-red">Proses Check Out</p>
                                                <small class="text-muted">Click tombol absen pulang!</small>
                                            </div>
                                        </div>

                                    </button>

                                <?php
                                } else {
                                ?>
                                    <a href="<?php echo base_url() . "Home?pulang=1" ?>" class="card p-3 btn btn-danger btn-card">
                                        <div class="d-flex align-items-center">
                                            <span class="stamp stamp-md bg-red mr-3">
                                                <i class="fe fe-camera"></i>
                                            </span>
                                            <div class="text-left">
                                                <p class="m-0 text-red">Check Out</p>
                                                <small class="text-muted">Click tombol absen pulang!</small>
                                            </div>
                                        </div>

                                    </a>

                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>



                        <div class="col-sm-12">
                            <div class="card card-collapsed">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">INFORMATION </h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 col-xl-12">
                                        <?php


                                        foreach ($berita['results'] as $result) {

                                            $case = $result->optlevel_receiver;
                                            switch ($case) {
                                                case 0:
                                                    echo '<div class="card-alert alert alert-';
                                                    if ($result->kategori_news == "Low Priority") {
                                                        echo 'warning mb-0"  style="text-align: left;">';
                                                    } elseif ($result->kategori_news == "Middle Priority") {
                                                        echo 'primary mb-0"  style="text-align: left;">';
                                                    } else {
                                                        echo 'danger mb-0"  style="text-align: left;">';
                                                    }

                                                    //$jmlread = $read['num'];
                                                    $id_news = $result->id;
                                                    $id_pembaca = $userdata->id;

                                                    $this->db->where('id_news =', $id_news);
                                                    $this->db->where('id_user =', $id_pembaca);
                                                    $query = $this->db->get('t_baca_news');


                                                    echo '<small><b>';
                                                    echo $result->title . '</b>';
                                                    echo ' - <i>';
                                                    echo $result->nama;
                                                    echo '</i> - <i>' . $result->tanggal_publish . '</i><br>';
                                                    echo '</small>';
                                                    echo '<small>';
                                                    echo $result->isi_berita;
                                                    echo '</small>';
                                                    echo '</div><br>';
                                                    break;


                                                default:

                                                    if ($userdata->opt_level == $result->optlevel_receiver && $result->nmuser == $userdata->tl) {

                                                        echo '<div class="card-alert alert alert-';
                                                        if ($result->kategori_news == "Low Priority") {
                                                            echo 'warning mb-0"  style="text-align: left;">';
                                                        } elseif ($result->kategori_news == "Middle Priority") {
                                                            echo 'primary mb-0"  style="text-align: left;">';
                                                        } else {
                                                            echo 'danger mb-0"  style="text-align: left;">';
                                                        }
                                                        //$jmlread = $read['num'];
                                                        $id_news = $result->id;
                                                        $id_pembaca = $userdata->id;
                                                        $this->db->where('id_news =', $id_news);
                                                        $this->db->where('id_user =', $id_pembaca);
                                                        $query = $this->db->get('t_baca_news');

                                                        echo '<small><b>';
                                                        echo $result->title . '</b>';
                                                        echo ' - <i>';
                                                        echo $result->nama;
                                                        echo '</i> - <i>' . $result->tanggal_publish . '</i><br>';
                                                        echo '</small>';
                                                        echo '<small>';
                                                        echo $result->isi_berita;
                                                        echo $userdata->tl;
                                                        echo '</small>';
                                                        echo '</div><br>';
                                                    }
                                            }
                                        }




                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-status bg-green"></div>
                                <div class="card-header">
                                    <h3 class="card-title">Quick Link</h3>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        if ($userdata->opt_level != 8) {
                                        ?>

                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url() . "dashboard_v2/wallboard_moss_v3"; ?>" class="card p-3 btn btn-info btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-orange mr-3">
                                                            <i class="fe fe-tag"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-orange">WALLBOARD MOSS DAILY</p>
                                                            <small class="text-muted">Moss Wallboard Daily</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>


                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url() . "dashboard_v2/wallboard_reguler_v3"; ?>" class="card p-3 btn btn-primary btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-blue mr-3">
                                                            <i class="fe fe-users"></i>

                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-blue">WALLBOARD REGULER DAILY</p>
                                                            <small class="text-muted">Reguler Wallboard Daily</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                        <?php
                                        if ($userdata->opt_level != 8) {
                                        ?>
                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url() . "dashboard_v2/dashboard"; ?>" class="card p-3 btn btn-danger btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-red mr-3">
                                                            <i class="fe fe-bar-chart"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-red">DASHBOARD</p>
                                                            <small class="text-muted">Daily Dashboard</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url() . "Analitics/Analitics/kpi_agent"; ?>" class="card p-3 btn btn-danger btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-red mr-3">
                                                            <i class="fe fe-bar-chart"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-red">DASHBOARD</p>
                                                            <small class="text-muted">Daily Dashboard</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        <?php
                                        }
                                        ?>                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "Report_profiling/Report_profiling/"; ?>" class="card p-3 btn btn-success btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-green mr-3">
                                                        <i class="fe fe-bar-chart"></i>
                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-green">REPORT</p>
                                                        <small class="text-muted">Report By Date</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                        if ($userdata->opt_level != 8) {
                                        ?>

                                            <div class="col-sm-12">
                                                <a href="<?php echo "http://10.194.52.203/infomedia_app/dashboard/wallboard_telkom"; ?>" target="_blank" class="card p-3 btn btn-info btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-orange mr-3">
                                                            <i class="fe fe-tag"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-orange">WALLBOARD ALL CHANNEL</p>
                                                            <small class="text-muted">Wallboard Daily For All Channel</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-status bg-orange"></div>
                                <div class="card-header">
                                    <h3 class="card-title">Break</h3>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Break"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Lunch</p>
                                                        <small class="text-muted">Jika anda akan istirahat makan siang</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Pray"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Pray</p>
                                                        <small class="text-muted">Jika anda akan melakukan ibadah</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Toilet"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Toilet</p>
                                                        <small class="text-muted">Jika anda akan ke Kamar Kecil</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Handsup"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Hands Up</p>
                                                        <small class="text-muted">Jika anda akan melakukan koordinasi ke Team Leader</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </td>
            <td width="15%"></td>
        </tr>
    </table>


    <?php
    if ($_GET['pulang']) {
        echo "<input type='hidden' id='pulang' value='1'>";
    } else {
        echo "<input type='hidden' id='pulang' value='0'>";
    }
    echo "<input type='hidden' id='latitude' value='0'>";
    echo "<input type='hidden' id='longitude' value='0'>";
    ?>
    <?php
    if ($input_absen || $_GET['pulang']) {
    ?>
        <script type="text/javascript">
            // Grab elements, create settings, etc.
            $("#camera_area").show();
            var video = document.getElementById('video');

            // Get access to the camera!
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Not adding `{ audio: true }` since we only want video now
                navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(function(stream) {
                    //video.src = window.URL.createObjectURL(stream);
                    video.srcObject = stream;
                    video.play();
                });
            }
            // Elements for taking the snapshot
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            // Trigger photo take
            document.getElementById("snap").addEventListener("click", function() {
                var latitude = $("#latitude").val();
                var longitude = $("#longitude").val();
                var pulang = $("#pulang").val();
                if (pulang == 0) {
                    uri = "<?php echo base_url() . "sistem/Profile/prepare_absen"; ?>";
                } else {
                    uri = "<?php echo base_url() . "sistem/Profile/prepare_absen_pulang"; ?>";
                }
                context.drawImage(video, 0, 0, 420, 313);
                var dataURL = canvas.toDataURL();
                $.ajax({
                    type: "POST",
                    url: uri,
                    data: {
                        imgBase64: dataURL,
                        longitude: longitude,
                        latitude: latitude
                    }
                }).done(function(o) {
                    console.log('saved');
                    alert("Data Absensi Berhasil Disimpan.!");
                    <?php
                    if ($_GET['pulang']) {
                    ?>
                        window.location.assign("<?php echo base_url() ?>sistem/logout");
                    <?php
                    }
                    if ($input_absen) {
                    ?>
                        window.location.assign("<?php echo base_url() ?>");
                    <?php
                    } ?>
                });
            });

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.watchPosition(showPosition);
                }
            }

            function showPosition(position) {
                $("#latitude").val(position.coords.latitude);
                $("#longitude").val(position.coords.longitude);
            }
            getLocation();
        </script>
    <?php
    }
    ?>

</body>