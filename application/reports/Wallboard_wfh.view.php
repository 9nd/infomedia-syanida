<?php
//MyReport.view.php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\Gauge;
use \koolreport\widgets\google\BarChart;

function filter_by_hp_email($array, $index, $value)
{
    if (is_array($array) && count($array) > 0) {
        foreach (array_keys($array) as $key) {
            if (is_array($index) && count($index) > 0) {
                $email = 0;
                $handphone = 0;
                foreach ($index as $idx => $idv) {
                    $temp[$key] = $array[$key][$idv];

                    if ($idv == "email") {
                        if (stripos($temp[$key], $value[$idx]) !== false) {
                            // if (stripos($temp[$key], $value[$idx]) !== true) {
                            $email = 1;
                        }
                    }
                    if ($idv == "handphone") {
                        if (stripos($temp[$key], $value[$idx]) !== false) {
                            // if (stripos($temp[$key], $value[$idx]) !== true) {

                            $handphone = 1;
                        }
                    }
                    if ($email == 1 && $handphone == 1) {
                        $newarray[$key] = $array[$key];
                    }
                }
            }
        }
    }
    return $newarray;
}
function filter_by_hp_only($array, $index, $value)
{
    if (is_array($array) && count($array) > 0) {
        foreach (array_keys($array) as $key) {
            if (is_array($index) && count($index) > 0) {
                $email = 0;
                $handphone = 0;
                foreach ($index as $idx => $idv) {
                    $temp[$key] = $array[$key][$idv];

                    if ($idv == "email") {
                        if ($temp[$key] == '') {
                            // if (stripos($temp[$key], $value[$idx]) !== true) {
                            $email = 1;
                        }
                    }
                    if ($idv == "handphone") {
                        if (stripos($temp[$key], $value[$idx]) !== false) {
                            // if (stripos($temp[$key], $value[$idx]) !== true) {

                            $handphone = 1;
                        }
                    }
                    if ($email == 1 && $handphone == 1) {
                        $newarray[$key] = $array[$key];
                    }
                }
            }
        }
    }
    return $newarray;
}
?>

<?php

/*---------------------- REGULER AREA------------------*/
$total = array();
$total['contacted'] = 0;
$total['uncontacted'] = 0;
$agent_online = 0;
for ($i = 1; $i < 16; $i++) {
    $total[$i] = 0;
}
$bucket_data_reguler = $this->dataStore("reguler");

$bucket_data_moss = $this->dataStore("moss");
$agent_moss_avaliable = $this->dataStore("agent_moss_avaliable");
$activity_login = $this->dataStore("activity_login");
$activity_logout = $this->dataStore("activity_logout");
// $wo = $this->dataStore("wo")->mode('num_wo');
$agent_reguler = $this->dataSTore('agent_reguler')->toArray();
$activity_aux = $this->dataSTore('activity_aux');
$agent_moss = $this->dataSTore('agent_moss')->toArray();
$idle_agent = $this->dataSTore('idle_data');
$reguler_peformance = array();
$data_agent = array();
$agent_on_duty = 0;
$agent_idle_detail = array();
$agent_offline = array();
$agent_login = array();
$agent_aux = array();
if ($activity_login->count() > 0) {
    foreach ($activity_login->toArray() as $ad) {
        $agent_login[$ad['agentid']][$ad['methode']] = $ad['methode'];
    }
}
if ($activity_logout->count() > 0) {
    foreach ($activity_logout->toArray() as $ad) {
        $agent_offline[$ad['agentid']][$ad['methode']] = $ad['methode'];
    }
}

$agent_wfo = array();
$agent_wfh = array();

if (count($agent_login) > 0) {
    foreach ($agent_login as $ag => $methode) {
        if (in_array(0, $methode)) {
            $agent_wfo[] = $ag;
        } else {
            $agent_wfh[] = $ag;
        }
    }
}

$agent_out_wfo = array();
$agent_out_wfh = array();

if (count($activity_logout) > 0) {
    foreach ($activity_logout as $ag => $methode) {
        if (in_array(0, $methode)) {
            $agent_out_wfo[] = $ag;
        } else {
            $agent_out_wfh[] = $ag;
        }
    }
}
$on_duty = count($agent_wfo) + count($agent_wfh);



if ($activity_aux->count() > 0) {
    foreach ($activity_aux->toArray() as $ad) {
        $agent_aux[] = $ad['agentid'];
    }
}
$agent_out = array_merge($agent_out_wfo, $agent_out_wfh);
$agent_break = array_merge($agent_out, $agent_aux);

$idle_agent = $idle_agent->whereNotIn('veri_upd', $agent_break);

$aval = $on_duty - (count($agent_out) + $idle_agent->count());
/*----------------------END MOSS AREA------------------*/

?>
<?php echo _css('datatables,icheck') ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fw/css/font-awesome.min.css">

<link rel="stylesheet" href="<?php echo base_url() ?>assets/tabler/bower_components/Ionicons/css/ionicons.min.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr-master/toastr.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.css">
<table width="100%">
    <tr>
        <td width="33%">
            <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
        </td>
        <td width="34%" style="text-align:center;">

            <h1>PROFILING AGENT MONITORING</h1>
        </td>
        <td width="33%" style="text-align:right;">
            <span id="tick2">
                <script>
                    function show2() {
                        if (!document.all && !document.getElementById)
                            return
                        thelement = document.getElementById ? document.getElementById("tick2") : document.all.tick2
                        var Digital = new Date()
                        var hours = Digital.getHours()
                        var minutes = Digital.getMinutes()
                        var seconds = Digital.getSeconds()
                        var dn = "PM"
                        if (hours < 12)
                            dn = "AM"
                        if (hours > 12)
                            hours = hours - 12
                        if (hours == 0)
                            hours = 12
                        if (minutes <= 9)
                            minutes = "0" + minutes
                        if (seconds <= 9)
                            seconds = "0" + seconds
                        var ctime = "<span style='font-size:50px;'>" + hours + ":" + minutes + "</span><span style='font-size:50px;'> " + dn + "</span>"
                        thelement.innerHTML = ctime
                        setTimeout("show2()", 60000)
                    }
                    window.onload = show2
                    //-->
                </script>
            </span>
        </td>

    </tr>
</table>

<table width="100%">

    <tr>

        <td width="30%" valign="top">
            <table width="100%" style="color:#a3a8ac;font-size:25px;text-align:center;">
                <tr>
                    <td rowspan='2'><i class="fa fa-cog"></i> ON DUTY<br><span style="color:#fff;font-size:200px;text-align:center;"><?php echo $on_duty; ?></span></td>
                    <td><i class="fa fa-cog"></i> AVAILABLE<br><span style="color:#a0bc2e;font-size:75px;text-align:center;"><?php echo $aval; ?></span></td>
                    <td><i class="fa fa-cog"></i> AUX/BREAK <br><span style="color:#ff8e35;font-size:75px;text-align:center;"><?php echo $activity_aux->count(); ?></span></td>
                </tr>
                <tr>
                    <td><i class="fa fa-cog"></i> OFFLINE<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo count($agent_out); ?></span></td>
                    <td><i class="fa fa-cog"></i> IDLE<br><span style="color:#ce2f4f;font-size:75px;text-align:center;"><?php echo $idle_agent->count(); ?></span></td>
                </tr>
                <!-- <tr>
                    <td><i class="fa fa-cog"></i> WFH<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo count($agent_wfh) ?></span></td>
                    <td><i class="fa fa-cog"></i> WFO<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo count($agent_wfo) ?></span></td>
                </tr> -->
                <tr>
                    <td colspan='3'>
                        <div class="col-md-12 col-xl-12" id="panel-form-moss">
                            <div class="card">
                                <div class="card-status bg-danger"></div>
                                <!-- <div class="card-header">
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <div class='box-body table-responsive' id='box-table'>
                                        <small>
                                            <?php
                                            if ($idle_agent->count() > 0) {
                                            ?>
                                                <table class='timecard' style="width: 100%;color:#000;">
                                                    <thead>
                                                        <tr>
                                                            <th nowrap><b></b></th>
                                                            <th nowrap><b></b></th>
                                                            <th nowrap><b></b></th>
                                                            <th style="background-color:red;color:white;"><b>Idle Time</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        foreach ($idle_agent->toArray() as $detail_agent_idle) {
                                                            $style = "background-color:blue;color:white;";
                                                            if (in_array($detail_agent_idle['agentid'], $agent_wfh)) {
                                                                $style = "background-color:green;color:white;";
                                                            }

                                                        ?>

                                                            <tr>
                                                                <td style="<?php echo $style; ?>padding:5px;"></td>
                                                                <td style="text-align:left;"><?php echo $detail_agent_idle['nama']; ?></td>
                                                                <td style="text-align:left;"></td>
                                                                <td><?php echo number_format($detail_agent_idle['idle'] / 60); ?> Menit</td>
                                                            </tr>
                                                        <?php
                                                        }


                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($activity_aux->count() > 0) {
                                            ?>
                                                <table class='timecard' style="width: 100%;color:#000;">
                                                    <thead>
                                                        <tr>
                                                            <th nowrap><b></b></th>
                                                            <th nowrap><b></b></th>
                                                            <th nowrap><b></b></th>
                                                            <th style="background-color:yellow;color:white;"><b>AUX</b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        foreach ($activity_aux->toArray() as $detail_agent_idle) {
                                                            $style = "background-color:blue;color:white;";
                                                            if (in_array($detail_agent_idle['agentid'], $agent_wfh)) {
                                                                $style = "background-color:green;color:white;";
                                                            }
                                                        ?>

                                                            <tr>
                                                                <td style="<?php echo $style; ?>padding:5px;"></td>
                                                                <td style="text-align:left;"><?php echo $detail_agent_idle['nama']; ?></td>
                                                                <td style="text-align:left;"></td>
                                                                <td><?php echo number_format($detail_agent_idle['aux'] / 60); ?> Menit</td>
                                                            </tr>
                                                        <?php

                                                        }


                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td width="70%" style="text-align:center;" valign="top">
            <span style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> PERFORMANCE DAILY</span>
            <br>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th rowspan="4"><?php echo date('d'); ?></th>
                        <th>Order Call</th>
                        <th>Contacted</th>
                        <th>Verified</th>
                        <th>PPA</th>
                        <th>AUX TIME</th>
                        <th>Agent On Duty</th>
                        <th>Productivity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <th>24.000</th>
                        <th>7.000</th>
                        <th>6.000</th>
                        <th>110</th>
                        <th>60</th>
                        <th>61</th>
                        <th>WFH</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>24.000</th>
                        <th>7.000</th>
                        <th>6.000</th>
                        <th>110</th>
                        <th>60</th>
                        <th>61</th>
                        <th>WFO</th>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>24.000</th>
                        <th>7.000</th>
                        <th>6.000</th>
                        <th>110</th>
                        <th>60</th>
                        <th>61</th>
                        <th>ALL</th>
                    </tr>
                </tfoot>
            </table>
        </td>
    </tr>
</table>
<?php echo _js('datatables,icheck') ?>
<script type="text/javascript">
    $(document).ready(function() {

        $("#report_table_moss").DataTable();
        $("#report_table_reg").DataTable();

    });
</script>
<?php
        // echo $this->dataStore("agent")->count()."<br>";
        // echo "Order Call Agent DR2891 : ".$data_co_reguler->filter("veri_call","=",13)->filter("veri_status","=",1)->count();
