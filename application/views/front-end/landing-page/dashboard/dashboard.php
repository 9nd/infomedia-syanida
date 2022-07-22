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

<?php
$thn = array("jan", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);


if ($userdata->opt_level == 9 || $userdata->opt_level == 8) {
    if ($userdata->opt_level == 9) {
        $lap = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15');
    } else {
        $lap = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15');
    }
} else {
    $lap = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
}


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
                text: ''
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
                    <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"><input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                </form>
                <br>
<?php
    }else{
        ?>
        <form method="GET" action="#">
                    From <input type="date" name="start" id="start" value="<?php echo $start; ?>"><input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form>
                <br>
        <?php
    }
?>
                
            <div class="col-lg-12 col-xs-12 blink_me_veri">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="verified">-</h3>
                        <p>VERIFIED</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-check-square-o"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">
                        Download Report Verified <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                </div>
            </div>
        </td>
        <td rowspan="2" colspan="3" width="70%">
            <div class="col-xl-12">
                <div class="panel panel-lte">
                    <div class="panel-body">
                        <div class='row' id="content-body">
                            <div class="col-xl-12">
                                <div id="chard_data_ajax" style="min-width: 800px; height: 270px; margin: 0 auto"></div>
                                <div id="grafik_area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 id="hp_email">-</h3>
                        <p>HANDPHONE EMAIL</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-vcard"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Only <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                </div>
            </div>
        </td>
    <tr>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="hp_only">-</h3>
                        <p>HANDPHONE ONLY</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-phone"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                </div>
            </div>
        </td>
        <?php

        if ($userdata->opt_level == 9 || $userdata->opt_level == 8) {
            if ($userdata->kategori != "MOS") {
        ?>
                <td width="23%">
                    <div class="col-lg-12 col-xs-6 blink_me_veri">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3 id="order_call">-</h3>
                                <p>ORDER CALL</p>
                            </div>
                            <div class="icon-counter">
                                <i class="fa fa-user"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                        </div>
                    </div>
                </td>
            <?php
            }
            ?>
            <td width="23%">
                <div class="col-lg-12 col-xs-6 blink_me_veri">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 id="connected">-</h3>
                            <p>CONTACTED</p>
                        </div>
                        <div class="icon-counter">
                            <i class="fa fa-user"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                    </div>
                </div>
            </td>
            <td width="23%">
                <div class="col-lg-12 col-xs-6 blink_me_veri">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3 id="notconnected">-</h3>
                            <p>NOT CONTACTED</p>
                        </div>
                        <div class="icon-counter">
                            <i class="fa fa-user"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                    </div>
                </div>
            </td>
            <?php
            if ($userdata->kategori == "MOS") {
            ?>
                <td width="18%">

                    <div id="slg_chart"></div>

                </td>
            <?php
            }
        } else {
            ?>
            <td>
                <div class="col-lg-12 col-xs-6 blink_me_veri">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 id="tllia">-</h3>
                            <p>VERIFIED TLLIA</p>
                        </div>
                        <div class="icon-counter" style="top:-39px;right:-10px;">
                            <span class="avatar avatar-xxl mr-5" id="agent_2_foto" style="background-image: url(<?php echo base_url() . "YbsService/get_foto_agent/" . $tllia->picture ?>)"></span>

                        </div>
                        <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                    </div>
                </div>
            </td>
            <td>
                <div class="col-lg-12 col-xs-6 blink_me_veri">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 id="tlita">-</h3>
                            <p>VERIFIED TLITA</p>
                        </div>
                        <div class="icon-counter" style="top:-39px;right:-10px;">
                            <span class="avatar avatar-xxl mr-5" id="agent_2_foto" style="background-image: url(<?php echo base_url() . "YbsService/get_foto_agent/" . $tlita->picture ?>)"></span>

                        </div>
                        <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                    </div>
                </div>
            </td>
            <td>
                <div class="col-lg-12 col-xs-6 blink_me_veri">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 id="tlateu">-</h3>
                            <p>VERIFIED TLATEU</p>
                        </div>
                        <div class="icon-counter" style="top:-39px;right:-10px;">
                            <span class="avatar avatar-xxl mr-5" id="agent_2_foto" style="background-image: url(<?php echo base_url() . "YbsService/get_foto_agent/" . $tlateu->picture ?>)"></span>

                        </div>
                        <!-- <a href="#" class="small-box-footer">
                        Download Report Handphone Email <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                    </div>
                </div>
            </td>

        <?php
        }
        ?>

    </tr>
    
</table>
<div class="col-md-12 col-xl-12" id="list_area">
    <div class="col-md-12 col-xl-12">
        <div class="form-group">
            <div class="selectgroup selectgroup-pills">
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon" title="Agent Reguler"><i class="fe fe-shield"></i> REGULER</span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                    <span class="selectgroup-button selectgroup-button-icon" title="Setting Halaman Utama"><i class="fe fe-home"></i> MOSS</span>
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-12" id="panel-form-reguler">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Report Call Reguler Periode <?php echo date('Y-m-d'); ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        Please Wait....

                    </small>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-xl-12" id="panel-form-moss">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Report Call MOSS Periode <?php echo date('Y-m-d'); ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        Please Wait....

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
<script type="text/javascript">
    function thousands_separators(num) {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }

    function update_base_contacted() {

        $.ajax({
            url: "<?php echo base_url() . "Home/get_curl_contacted" ?>",
            dataType: 'JSON',
            success: function(response) {
                var data = response.result[0];
                $("#verified").text(thousands_separators(data.closed));
            }
        });
    }

    

    function get_grafik() {

        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_grafik_verified_yearly" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $.each(response.data, function(key, val) {
                    chart.addSeries({
                        name: key,
                        data: val
                    });
                });
                $("#grafik_status").val(1);
                var best_agent = $("#best_agent_status").val();
                if (best_agent == 0) {
                    get_best_agent();
                }

            }
        });
    }

    function get_grafik_tl() {

        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_grafik_tl" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $.each(response.data, function(key, val) {
                    chart.addSeries({
                        name: key,
                        data: val
                    });
                });

            }
        });
    }

   
    function get_grafik_agent() {

        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_grafik_agent" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $.each(response.data, function(key, val) {
                    chart.addSeries({
                        name: key,
                        data: val
                    });
                });


            }
        });
    }

    function update_base_list_area() {
        var start = $("#start").val();
        var end = $("#end").val();
        var agentid = $("#agentid").val();
        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_data_list" ?>",
            data: {
                start: start,
                end: end,
                agentid: agentid
            },
            methode: "get",
            success: function(response) {
                $("#list_area").html(response);
            }
        });
    }

    function get_slg_mos() {

        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_slg_mos" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $("#slg").text(response.slg);

                $("#slg_chart").html("");
                let element = document.querySelector('#slg_chart');

                // Properties of the gauge

                var slg_num = response.slg;
                var slg_label = response.slg;
                switch (true) {
                    case (parseInt(slg_num) > 10):
                        var slg_num = 10;
                        var slg_label = '>10';
                        var bar_color = "red";
                        break;
                    case (parseInt(slg_num) >= 7):
                        var bar_color = "red";
                        break;
                    case (parseInt(slg_num) > 4):
                        var bar_color = "yellow";
                        break;
                    default:
                        var bar_color = "green";
                        break;

                }
                let gaugeOptions = {
                    hasNeedle: true,
                    needleColor: bar_color,
                    needleUpdateSpeed: 1000,
                    arcColors: [bar_color, 'lightgray'],
                    arcDelimiters: [response.slg * 10],
                    rangeLabel: ['0', '10'],
                    centralLabel: response.slg,
                };
                GaugeChart
                    .gaugeChart(element, 200, gaugeOptions)
                    .updateNeedle(response.slg * 10);
            }
        });
    }
    setInterval(function() {
        update_base_list_area();
    }, 300000);

    $(document).ready(function() {
        <?php
        // if (isset($_GET['update_dashboard'])) {
        ?>
        // update_base_contacted();
        <?php

        if ($userdata->opt_level == 9 || $userdata->opt_level == 8) {
            if ($userdata->opt_level == 9) {
        ?>
                get_grafik_tl();

            <?php
            } else {
            ?>
                get_grafik();

                <?php
                if ($userdata->kategori == "MOS") {
                ?>
                    get_slg_mos();
            <?php
                }
            }
        } else {
            ?>
            get_grafik();
        <?php
        }
        ?>
        update_base_list_area();
        $("#panel-form-reguler").show();
        $("#panel-form-moss").hide();
        $(".selectgroup-input").change(function() {
            if ($(this).val() == "1") {
                $("#panel-form-reguler").show();
                $("#panel-form-moss").hide();
            } else {
                $("#panel-form-reguler").hide();
                $("#panel-form-moss").show();
            }
        });
    });

    $("#btn-dasboard").click(function() {
        show_success_message("untuk mengaktifkan,tekan icon bintang di samping menu HOME");
    });
</script>