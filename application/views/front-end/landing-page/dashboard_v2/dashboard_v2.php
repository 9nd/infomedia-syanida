<style>
    .blink_me {
        animation: blinker 1s linear infinite;
    }

    /* .blink_me_veri {
		animation: blinker 5s linear infinite;
	} */
    .circle-40 {
        width: 40px;
        height: 40px;
        line-height: 38px;
        border-radius: 50%;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
    }

    .outline-badge-primary {
        border: 1px solid #1e3d73;
        color: #1e3d73;
        position: relative;
        overflow: hidden;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
<!-- END: Page CSS-->
<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
<link href="<?php echo base_url(); ?>assets/progress_bar/css/static.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>

<script src="<?php echo base_url(); ?>assets/progress_bar/js/static.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
<script type="text/javascript">
    var chart;
    var slg_chart;
    var slfc_chart;
    var cfh_chart;
    var target_chart;
</script>
<div class="col-12">
    <?php

    if ($userdata->opt_level == 8) {
    ?>
        <form method="GET" action="#">
            <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"><input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
        </form>
        <br>
    <?php
    } else {
    ?>
        <form method="GET" action="#">
            From <input type="date" name="start" id="start" value="<?php echo $start; ?>"><input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
        </form>
        <br>
    <?php
    }
    ?>
</div>
<div class="col-4">
    <div class="row">
        <div class="col-6 blink_me_veri">
            <div class="small-box bg-blue">
                <div class="inner">
                    <center>
                        <h3><?php echo number_format($oc); ?></h3>
                        <p>CALL ORDER</p>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-6 blink_me_veri">
            <div class="small-box bg-green">
                <div class="inner">
                    <center>
                        <h3><?php echo number_format($status_call[13]) ?></h3>
                        <p>VERIFIED</p>
                    </center>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo number_format(($status_call[13] / $contacted) * 100) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format(($status_call[13] / $contacted) * 100) ?>%">
                        <?php echo number_format(($status_call[13] / $contacted) * 100) ?>%
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 blink_me_veri">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <center>
                        <h3><?php echo number_format($contacted); ?></h3>
                        <p>CONTACTED</p>
                    </center>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo number_format(($contacted / $oc) * 100) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format(($contacted / $oc) * 100) ?>%">
                        <?php echo number_format(($contacted / $oc) * 100) ?>%
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 blink_me_veri">
            <div class="small-box bg-red">
                <div class="inner">
                    <center>
                        <h3><?php echo number_format($uncontacted); ?></h3>
                        <p>NOT CONTACTED</p>
                    </center>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo number_format(($uncontacted / $oc) * 100) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format(($uncontacted / $oc) * 100) ?>%">
                        <?php echo number_format(($uncontacted / $oc) * 100) ?>%
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<div class="col-5">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="d-flex">
                    <div class="media-body align-self-center ">
                        <span class="mb-0 h5 font-w-600">STATUS CALL </span>
                    </div>
                </div>
                <div id="apex_bar_chart"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-3">
    <div calss="row">
        <div class="col-12 blink_me_veri">
            <div class="small-box bg-green">
                <div class="inner">
                    <center>
                        <h3 id="verified"><?php echo number_format($status_call[13] / count($agent), 2) ?></h3>
                        <p>PPA</p>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-12 blink_me_veri">
            <div class="row">
                <div class="col-6 blink_me_veri">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <center>
                                <h3><?php echo number_format($hpemail); ?></h3>
                                <p>HP + EMAIL</p>
                            </center>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo number_format(($hpemail / $status_call[13]) * 100) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format(($hpemail / $status_call[13]) * 100) ?>%">
                                <?php echo number_format(($hpemail / $status_call[13]) * 100) ?>%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 blink_me_veri">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <center>
                                <h3><?php echo number_format($hponly); ?></h3>
                                <p>HP ONLY</p>
                            </center>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo number_format(($hponly / $status_call[13]) * 100) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo number_format(($hponly / $status_call[13]) * 100) ?>%">
                                <?php echo number_format(($hponly / $status_call[13]) * 100) ?>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-3">
    <div style="font-size:25px;text-align:center;position:absolute;margin-left:120px;">SLG</div>

    <div id="slg_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:120px;" id='slg'></div>
</div>
<div class="col-3">
    <div style="font-size:25px;text-align:center;position:absolute;margin-left:120px;">SLFC</div>

    <div id="slfc_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:120px;" id='slfc'></div>

</div>
<div class="col-3">
    <div style="font-size:25px;text-align:center;position:absolute;margin-left:50px;">CALL PER HOURS</div>
    <div id="cfh_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:120px;" id='cfh'><?php echo number_format($cph); ?></div>
</div>
<div class="col-3">
    <div style="font-size:25px;text-align:center;position:absolute;margin-left:120px;">TARGET</div>
    <div id="target_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:120px;" id='target'><?php echo number_format($status_call[13]) ?></div>
</div>

<div class="col-6">
    <canvas id="chartjs-account-chart-reguler"></canvas>
</div>
<div class="col-6">
    <canvas id="chartjs-account-chart-moss"></canvas>
</div>
<div class="col-4">
    <div class="row">
        <div class="col-12 blink_me_veri">
            <div class="small-box bg-green">
                <div class="inner">
                    <center>
                        <h3><?php
                            if ($cache_monev_realtime['aval_num'] < 0) {
                                echo 0;
                            } else {
                                echo $cache_monev_realtime['aval_num'];
                            }
                            ?></h3>
                        <p>ONLINE</p>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-6 blink_me_veri">
            <div class="small-box bg-red">
                <div class="inner">
                    <center>
                        <h3><?php echo $cache_monev_realtime['idle_num']; ?></h3>
                        <p>IDLE</p>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-6 blink_me_veri">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <center>
                        <h3><?php echo $cache_monev_realtime['idle_num']; ?></h3>
                        <p>BREAK</p>
                    </center>
                </div>
            </div>
        </div>


    </div>

</div>
<div class="col-4">
    <div style="font-size:25px;text-align:center;position:absolute;margin-left:160px;">BREAK</div>
    <div id="break_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:160px;" id='break'><?php echo number_format($break['total']); ?></div>
</div>

<div class="col-4">
    <div style="height:200px;">
        <canvas id="chartjs-other-pie"></canvas>
    </div>

</div>
<div class="col-md-6 col-lg-4 mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="card-title">PERFORMANCE DAILY</h6>
        </div>
        <div class="card-content">
            <div class="card-body p-0">
                <ul class="list-group list-unstyled">
                    <?php
                    if (count($agent_rating) > 0) {
                        foreach ($agent_rating as $ida => $va) {
                    ?>
                            <li class="p-2 border-bottom">
                                <div class="media d-flex w-100">
                                    <div class="circle-40 outline-badge-primary"><span><?php echo $controller->Sys_user_table_model->get_row(array("agentid" =>  $controller->Sys_user_table_model->get_row(array("agentid" => $ida))->tl))->nama; ?></span></div>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600"><?php echo $controller->Sys_user_table_model->get_row(array("agentid" => $ida))->nama; ?></span><br>
                                        <small class="mb-0 font-w-500"><?php echo $ida; ?></small>
                                    </div>
                                    <div class="ml-auto my-auto font-weight-bold">
                                        <?php echo number_format($va); ?>
                                    </div>
                                </div>
                            </li>
                    <?php
                        }
                    }

                    ?>



                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-4 mt-3">
    <div class="card border-top-0">
        <div class="card-content border-top border-primary border-w-5">
            <div class="card-body p-0">
                <ul class="list-group list-unstyled">
                    <?php
                    $oc_best = 0;
                    $contacted_best = 0;
                    $uncontacted_best = 0;
                    $agentid_best = "";
                    if (count($best_agent) > 0) {
                        foreach ($best_agent as $ida => $va) {
                    ?>
                            <li class="p-4 border-bottom">
                                <div class="media d-flex w-100">
                                    <div class="circle-40 outline-badge-primary"><span><?php echo $controller->Sys_user_table_model->get_row(array("agentid" => $controller->Sys_user_table_model->get_row(array("agentid" => $ida))->tl))->nama; ?></span></div>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600"><?php echo $controller->Sys_user_table_model->get_row(array("agentid" => $ida))->nama; ?></span><br>
                                        <small class="mb-0 font-w-500"><?php echo $ida; ?></small>
                                    </div>
                                    <div class="ml-auto my-auto font-weight-bold">
                                        <?php echo number_format($va); ?>
                                    </div>
                                </div>
                            </li>
                    <?php
                            $oc_best = $agent[$ida]['oc'];
                            $agentid_best = $ida;
                            $contacted_best = $agent[$ida][1] + $agent[$ida][13] + $agent[$ida][3] + $agent[$ida][12] + $agent[$ida][11];
                            $uncontacted_best = $agent[$ida][15] + $agent[$ida][9] + $agent[$ida][8] + $agent[$ida][4] + $agent[$ida][7] + $agent[$ida][10] + $agent[$ida][14] + $agent[$ida][2];
                        }
                    }

                    ?>

                </ul>
                <div class="table-responsive">
                    <table class="table table-borderless pick-table mb-2">
                        <thead>
                            <tr>
                                <th>Variabel</th>
                                <th class="text-right">Num</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Order Call</td>
                                <td class="text-right text-success"><?php echo $oc_best; ?></td>
                            </tr>
                            <tr>
                                <td>Contacted</td>
                                <td class="text-right text-success"><?php echo $contacted_best; ?></td>
                            </tr>
                            <tr>
                                <td>Not Contacted</td>
                                <td class="text-right text-danger"><?php echo $uncontacted_best; ?></td>
                            </tr>
                            <tr>
                                <td>Break</td>
                                <td class="text-right text-success"><?php echo number_format($break['agent'][$agentid_best] / 60); ?> Minutes</td>
                            </tr>
                            <tr>
                                <td>Call Per Hour</td>
                                <td class="text-right text-danger"><?php echo number_format(($oc_best / $duration)); ?>/Hours</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-4 mt-3">
    <div class="card border-bottom-0">
        <div class="card-content border-bottom border-info border-w-5">
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="border-bottom border-primary">
                            <span class="text-muted font-w-600">This Week</span><br>
                            <?php
                            $total_week = 0;
                            if (count($log_veri) > 0) {
                                foreach ($log_veri as $r_lv) {
                                    $total_week = $total_week + $r_lv->num;
                                }
                            }
                            ?>
                            <p class="mb-0 font-w-500 h3"><?php echo number_format($total_week); ?></p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless pick-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="text-right">Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($log_veri) > 0) {
                                        foreach ($log_veri as $r_lv) {
                                    ?>
                                            <tr>
                                                <td><?php echo $r_lv->lupna; ?></td>
                                                <td class="text-right text-success"><?php echo number_format($r_lv->num); ?> </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (count($tl)) {
    foreach ($tl as $id_tl => $data_tl) {
?>
        <div class="col-md-6 col-lg-4 mt-3">
            <div class="card border-top-0">
                <div class="card-content border-top border-warning border-w-5">
                    <div class="card-body p-0">
                        <ul class="list-group list-unstyled">
                            <?php
                            $oc_best = 0;
                            $contacted_best = 0;
                            $uncontacted_best = 0;
                            $agentid_best = "";
                            ?>
                            <li class="p-4 border-bottom">
                                <div class="media d-flex w-100">
                                    <!-- <div class="circle-40 outline-badge-primary"><span><?php echo $controller->Sys_user_table_model->get_row(array("nmuser" => $id_tl))->nama; ?></span></div> -->
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600"><?php echo $controller->Sys_user_table_model->get_row(array("nmuser" => $id_tl))->nama; ?></span><br>
                                        <!-- <small class="mb-0 font-w-500"><?php echo $id_tl; ?></small> -->
                                    </div>
                                    <div class="ml-auto my-auto font-weight-bold">
                                        <?php echo number_format($tl[$id_tl][13]); ?>
                                    </div>
                                </div>
                            </li>
                            <?php
                            $oc_best = $tl[$id_tl]['oc'];
                            $agentid_best = $id_tl;
                            $contacted_best = $tl[$id_tl][1] + $tl[$id_tl][13] + $tl[$id_tl][3] + $tl[$id_tl][12] + $tl[$id_tl][11];
                            $uncontacted_best = $tl[$id_tl][15] + $tl[$id_tl][9] + $tl[$id_tl][8] + $tl[$id_tl][4] + $tl[$id_tl][7] + $tl[$id_tl][10] + $tl[$id_tl][14] + $tl[$id_tl][2];

                            ?>

                        </ul>
                        <div class="table-responsive">
                            <table class="table table-borderless pick-table mb-2">
                                <thead>
                                    <tr>
                                        <th>Variabel</th>
                                        <th class="text-right">Num</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Underteam</td>
                                        <td class="text-right text-success"><?php echo count($tl[$id_tl]['underteam']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Order Call</td>
                                        <td class="text-right text-success"><?php echo $oc_best; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contacted</td>
                                        <td class="text-right text-success"><?php echo $contacted_best; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Not Contacted</td>
                                        <td class="text-right text-danger"><?php echo $uncontacted_best; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Break</td>
                                        <td class="text-right text-success"><?php echo number_format($break['tl'][$agentid_best] / 60); ?> Minutes</td>
                                    </tr>
                                    <tr>
                                        <td>Call Per Hour</td>
                                        <td class="text-right text-danger"><?php echo number_format((($oc_best / count($tl[$id_tl]['underteam'])) / $duration)); ?>/Hours</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
<script type="text/javascript">
    ///////////////////////////////// Bar Chart /////////////////////
    if ($("#apex_bar_chart").length > 0) {
        options = {
            grid: {

                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            chart: {
                height: 190,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: '10',
                }
            },
            dataLabels: {
                enabled: true
            },
            colors: ['#cd201f'],
            series: [{
                data: [
                    <?php

                    if (count($status_rating) > 0) {
                        foreach ($status_rating as $key => $val) {
                            echo $val . ",";
                        }
                    }

                    ?>
                ]
            }],
            xaxis: {
                categories: [
                    <?php
                    if (count($status_rating) > 0) {
                        foreach ($status_rating as $key => $val) {
                            echo "'" . $controller->status_call->get_row(array("id_reason" => str_replace('status_call_', '', $key)))->nama_reason . "',";
                        }
                    }

                    ?>
                ]
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#apex_bar_chart"),
            options
        );
        chart.render();
    }

    function get_slg_mos() {
        var start = $("#start").val();
        var end = $("#end").val();
        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard_v2/get_slg_mos" ?>",
            data: {
                start: start,
                end: end
            },
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $("#slg").text(response.slg);
                $("#slfc").text(response.slfc);


                // Element inside which you want to see the chart
                $("#slg_chart").html("");
                let element = document.querySelector('#slg_chart');

                // Properties of the gauge

                var slg_num = response.slg;
                var slg_label = response.slg;
                var slg_length = "lightgray";
                switch (true) {
                    case (parseInt(slg_num) > 9):
                        var bar_color = "#ce2f4f";
                        var slg_length = "#ce2f4f";
                        var slg_num = 9.9;
                        break;
                    case (parseInt(slg_num) > 4):
                        var bar_color = "#ce2f4f";
                        break;
                    default:
                        var bar_color = "#a0bc2e";
                        break;

                }
                let gaugeOptions = {
                    hasNeedle: true,
                    needleColor: bar_color,
                    needleUpdateSpeed: 1000,
                    arcColors: [bar_color, slg_length],
                    arcDelimiters: [slg_num * 10],
                    rangeLabel: ['0', '10'],
                    centralLabel: "",
                };
                GaugeChart
                    .gaugeChart(element, 300, gaugeOptions)
                    .updateNeedle(slg_num * 10);

                // Element inside which you want to see the chart
                $("#slfc_chart").html("");
                let element2 = document.querySelector('#slfc_chart');

                // // Properties of the gauge

                var slfc_num = response.slfc;
                var slfc_label = response.slfc;
                var slfc_length = "lightgray";
                switch (true) {
                    case (parseInt(slfc_num) > 9):
                        var slfc_num = 9.9;
                        var bar_color = "#ce2f4f";
                        var slfc_length = "#ce2f4f";
                        break;
                    case (parseInt(slfc_num) > 4):
                        var bar_color = "#ce2f4f";
                        break;
                    default:
                        var bar_color = "#a0bc2e";
                        break;

                }
                let gaugeOptions2 = {
                    hasNeedle: true,
                    needleColor: bar_color,
                    needleUpdateSpeed: 1000,
                    arcColors: [bar_color, slfc_length],
                    arcDelimiters: [slfc_num * 10],
                    rangeLabel: ['0', '10'],
                    centralLabel: "",
                };
                GaugeChart
                    .gaugeChart(element2, 300, gaugeOptions2)
                    .updateNeedle(slfc_num * 10);

                // Element inside which you want to see the chart
                $("#cfh_chart").html("");
                let element3 = document.querySelector('#cfh_chart');

                // // Properties of the gauge

                var cfh_num = <?php echo $cph_persen; ?>;
                var cfh_label = <?php echo $cph; ?>;
                var cfh_length = "lightgray";
                switch (true) {
                    case (parseInt(cfh_num) > 100):
                        var cfh_num = 99.99;
                        var bar_color = "#ce2f4f";
                        var cfh_length = "#ce2f4f";
                        break;
                    case (parseInt(cfh_num) > 25):
                        var bar_color = "#ce2f4f";
                        break;
                    default:
                        var bar_color = "#a0bc2e";
                        break;

                }
                let gaugeOptions3 = {
                    hasNeedle: true,
                    needleColor: bar_color,
                    needleUpdateSpeed: 1000,
                    arcColors: [bar_color, cfh_length],
                    arcDelimiters: [cfh_num],
                    rangeLabel: ['0', '100'],
                    centralLabel: "",
                };
                GaugeChart
                    .gaugeChart(element3, 300, gaugeOptions3)
                    .updateNeedle(cfh_num);

                // Element inside which you want to see the chart
                $("#target_chart").html("");
                let element4 = document.querySelector('#target_chart');

                // // Properties of the gauge

                var target_num = <?php echo $target_persen; ?>;
                var target_label = <?php echo $target_persen; ?>;
                var target_length = "lightgray";
                switch (true) {
                    case (parseInt(target_num) > 99):
                        var target_num = 99.99;
                        var bar_color = "#a0bc2e";
                        var target_length = "#a0bc2e";
                        break;
                    case (parseInt(target_num) > 40):
                        var bar_color = "#ce2f4f";
                        break;
                    default:
                        var bar_color = "#ce2f4f";
                        // var target_length = "#ce2f4f";
                        break;

                }
                let gaugeOptions4 = {
                    hasNeedle: true,
                    needleColor: bar_color,
                    needleUpdateSpeed: 1000,
                    arcColors: [bar_color, target_length],
                    arcDelimiters: [target_num],
                    rangeLabel: ['0', '<?php echo number_format($target); ?>'],
                    centralLabel: "",
                };
                GaugeChart
                    .gaugeChart(element4, 300, gaugeOptions4)
                    .updateNeedle(target_num);

                // Element inside which you want to see the chart
                $("#break_chart").html("");
                let element5 = document.querySelector('#break_chart');

                // // Properties of the gauge

                var break_num = <?php echo $break['break_persen'] ?>;
                var break_label = <?php echo $break['break_persen'] ?>;
                var break_length = "lightgray";
                switch (true) {
                    case (parseInt(break_num) > 100):
                        var break_num = 99.99;
                        var bar_color = "#ce2f4f";
                        var break_length = "#ce2f4f";
                        break;
                    case (parseInt(break_num) > 40):
                        var bar_color = "#ce2f4f";
                        break;
                    default:
                        var bar_color = "#a0bc2e";
                        break;

                }
                let gaugeOptions5 = {
                    hasNeedle: true,
                    needleColor: bar_color,
                    needleUpdateSpeed: 1000,
                    arcColors: [bar_color, break_length],
                    arcDelimiters: [break_num],
                    rangeLabel: ['0', '<?php echo number_format($break['max']); ?>'],
                    centralLabel: "",
                };
                GaugeChart
                    .gaugeChart(element5, 400, gaugeOptions5)
                    .updateNeedle(break_num);
            },

            error: function() {
                alert('There was an error processing your information!');
            }
        });
    }
    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
            label +
            '<br>' +
            Math.round(series.percent) + '%</div>'
    }
    get_slg_mos();
    var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
    var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
    var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');

    // CHART();
    var chartjs_multiaxis_bar_moss = document.getElementById("chartjs-account-chart-moss");
    if (chartjs_multiaxis_bar_moss) {
        var barmultiaxisChartData_moss = {
            labels: ['08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'],
            datasets: [

                {
                    label: 'Contacted Rate (%)',
                    type: 'line',
                    // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: primarycolor,
                    fill: false,
                    yAxisID: 'Contacted Rate',
                    borderWidth: 2,
                    data: [
                        <?php
                        foreach ($rate_contacted['rate_contacted'] as $bulanna => $valna) {
                            echo intval($valna) . ',';
                        }

                        ?>
                    ]
                }, {
                    label: 'Verified',
                    type: 'bar',
                    backgroundColor: 'green',
                    borderColor: bodycolor,
                    borderWidth: 1,
                    yAxisID: 'Verified',
                    data: [
                        <?php
                        foreach ($grafik_verified['verified'] as $bulanna => $valna) {
                            echo intval($valna) . ',';
                        }
                        ?>
                    ]
                },
            ]

        };
        ctx_moss = document.getElementById('chartjs-account-chart-moss').getContext('2d');
        window.myBar = new Chart(ctx_moss, {
            type: 'bar',
            data: barmultiaxisChartData_moss,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ' '
                },
                scales: {
                    yAxes: [{
                        id: 'Verified',
                        position: 'right',
                    }, {
                        id: 'Contacted Rate',
                        position: 'left',
                        ticks: {
                            max: 100,
                            min: 0
                        }
                    }]
                }
            }
        });
    }

    var chartjs_multiaxis_bar_reguler = document.getElementById("chartjs-account-chart-reguler");
    if (chartjs_multiaxis_bar_reguler) {
        var barmultiaxisChartData_reguler = {
            labels: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
            datasets: [

                {
                    label: 'Waiting',
                    type: 'line',
                    // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: primarycolor,
                    fill: false,
                    borderWidth: 2,
                    data: [
                        <?php
                        foreach ($grafik['Waiting'] as $bulanna => $valna) {
                            echo intval($valna) . ',';
                        }

                        ?>
                    ]
                }, {
                    label: 'Verified',
                    type: 'line',
                    // backgroundColor: 'green',
                    borderColor: 'green',
                    fill: false,
                    borderWidth: 2,
                    data: [
                        <?php
                        foreach ($grafik['Verified'] as $bulanna => $valna) {
                            echo intval($valna) . ',';
                        }
                        ?>
                    ]
                },
            ]

        };
        ctx_reguler = document.getElementById('chartjs-account-chart-reguler').getContext('2d');
        window.myBar = new Chart(ctx_reguler, {
            type: 'bar',
            data: barmultiaxisChartData_reguler,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ' '
                }
            }
        });
    }

    var config_break = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [<?php echo intval($break['Break'] / 60) . "," . intval($break['Pray'] / 60) . "," . intval($break['Toilet'] / 60) . "," . intval($break['Handsup'] / 60); ?>],
                backgroundColor: [
                    '#1e3d73',
                    '#17a2b8',
                    '#ffc107',
                    '#fd9644',
                ],
                label: 'Break'
            }],
            labels: [
                'Lunch',
                'Pray',
                'Toilet',
                'Handsup'
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'left',
                labels: {
                    fontColor: bodycolor
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
        }
    };
    var chartjs_other_pie = document.getElementById("chartjs-other-pie");
    if (chartjs_other_pie) {
        var ctx_break = document.getElementById('chartjs-other-pie').getContext('2d');
        window.myDoughnut = new Chart(ctx_break, config_break);
    }
</script>