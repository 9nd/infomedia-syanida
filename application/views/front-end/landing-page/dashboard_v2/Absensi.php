<style>
    .blink_me {
        animation: blinker 1s linear infinite;
    }

    /* .blink_me_veri {
		animation: blinker 5s linear infinite;
	} */

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
<?php echo _css('datatables,icheck') ?>


<?php
/*$thn = array("jan", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
*/


$lap = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);




?>
<script type="text/javascript">
    var chart;
    var slg_chart;
    var dapros_chart;
    $(document).ready(function() {

        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'chard_data_ajax',
            },
            title: {
                text: 'Line Chart Perbandingan Absensi Agent Reguler'
            },
            xAxis: {
                categories: [
                    <?php

                    foreach ($lap as $ta) {
                        echo "'" . $ta . "',";
                    }
                    ?>
                ]
            },
            labels: {
                items: [{
                    html: '',
                    style: {
                        left: '40px',
                        top: '8px',
                        color: 'black'
                    }
                }]
            },
            series: []
        });




    });
</script>
<table width="100%">
    <tr>
        <td width="30%">
            <?php

            if ($userdata->opt_level == 8) {
            ?>
                <form method="GET" action="#">
                    <input type="hidden" name="start" id="start" value="<?php echo $start; ?>">
                    <input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                </form>
                <br>
            <?php
            } else {
            ?>
                <form method="GET" action="#">
                    Pilih Tanggal <input type="date" name="start" id="start" value="<?php echo $start; ?>">
                    <!--<input type="date" name="end" id="end" value="<?php echo $end; ?>">-->
                    <button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form>
                <br>
            <?php
            }
            ?>

            <div class="col-lg-12 col-xs-12 blink_me_veri">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?php echo $agent_reg['num']; ?></h3>
                        <p>Jumlah Agent</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-vcard"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">
                        Download Report Verified <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                </div>
            </div>
        </td>
        <td>
        <br>
        <br>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?php echo count($jumlah['reg']['agent']); ?></h3>
                        <p>Agent Reguler</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-vcard"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
        <br>
        <br>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?php echo count($jumlah['moss']['agent']); ?></h3>
                        <p>Agent Moss</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-vcard"></i>
                    </div>
                </div>
            </div>

        </td>
    </tr>
    <tr>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo count($list_absen['reg']) + count($list_absen['moss']); ?></h3>
                        <p>Agent Hadir</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-check-square-o"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo count($list_absen['reg']); ?></h3>
                        <p>Reguler Hadir</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-check-square-o"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo count($list_absen['moss']); ?></h3>
                        <p>Moss Hadir</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-check-square-o"></i>
                    </div>
                </div>
            </div>

        </td>
    </tr>
    <tr>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $agent_reg['num'] - (count($list_absen['reg']) + count($list_absen['moss'])); ?></h3>
                        <p>Agent Tidak/Belum Hadir</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-close"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo count($jumlah['reg']['agent']) - count($list_absen['reg']); ?></h3>
                        <p>Reguler Tidak/Belum Hadir</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-close"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo count($jumlah['moss']['agent']) - count($list_absen['moss']); ?></h3>
                        <p>Moss Tidak/Belum Hadir</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-close"></i>
                    </div>
                </div>
            </div>

        </td>


    </tr>
    <tr>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo count($jumlah['reg']['late']) ; ?></h3>
                        <p>Agent Terlambat</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-calendar-times-o"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo count($jumlah['reg']['late']); ?></h3>
                        <p>Reguler Terlambat</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-calendar-times-o"></i>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo count($jumlah['moss']['late']); ?></h3>
                        <p>Moss Terlambat</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-calendar-times-o"></i>
                    </div>
                </div>
            </div>

        </td>


    </tr>

</table>

<div class="col-md-12 col-xl-12" id="list_area">
    <div class="col-md-12 col-xl-12">
        <div class="form-group">
            <div class="selectgroup selectgroup-pills">
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon" title="Agent Reguler"><i class="fe fe-shield"></i> All Agent</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                </label>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-xl-12" id="panel-form-moss">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Today Attendance Recapitulation <?php echo $start; ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='timecard' id="tabel_absensi_reg" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><b>No</b></th>
                                    <th nowrap><b>Agentid</b></th>
                                    <th nowrap><b>Nama Agent</b></th>
                                    <th nowrap><b>NIK</b></th>
                                    <th nowrap><b>TL</b></th>
                                    <th nowrap><b>WFH/WFO</b></th>
                                    <th nowrap><b>REG/MOSS</b></th>
                                    <th nowrap><b>IN</b></th>
                                    <th nowrap><b>Out</b></th>
                                    <th nowrap><b>Late</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    $n=1;
                                    if($agent_reg['num'] > 0){
                                        $array_lok=array("WFO","WFH");
                                        foreach($agent_reg['results'] as $reg){
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $n;?></td>
                                                <td><?php echo $reg->agentid;?></td>
                                                <td nowrap><?php echo $reg->nama;?></td>
                                                <td><?php echo $reg->nik_absensi;?></td>
                                                <td><?php echo $reg->tl;?></td>
                                                <td><?php echo $array_lok[$agent[$reg->agentid]['lokasi']];?></td>
                                                <td><?php echo $agent[$reg->agentid]['type'];?></td>
                                                <td nowrap><?php echo $agent[$reg->agentid]['in'];?></td>
                                                <td nowrap><?php echo $agent[$reg->agentid]['out'];?></td>
                                                <td nowrap><?php echo $agent[$reg->agentid]['late'];?></td>
                                            </tr>
                                            <?php
                                            $n++;
                                        }
                                    }
                                    
                                    ?>
                            </tbody>
                        </table>

                    </small>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-md-12 col-lg-12">

    <?php
    $thn = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
    $data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
    $data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
    $data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
    $lap = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    ?>

    <div class="dashboard-1 clearfix">

    </div>
    <hr>
</div>
<?php echo _js('datatables,icheck') ?>
<script type="text/javascript">
    $(document).ready(function() {
       
        $("#tabel_absensi_reg").DataTable();
    });
</script>
<script>
    var i = 0;
    var elem = document.getElementById("progressbar");
    var width = 10;
    var id = setInterval(frame, 10);
    $(document).ready(function() {
                if (i == 0) {
                    i = 1;

                    function frame() {
                        if (width >= 100) {
                            clearInterval(id);
                            i = 0;
                        } else {
                            width++;
                            elem.style.width = width + "%";
                            elem.innerHTML = width + "%";
                        }
                    }
                }
            }
</script>