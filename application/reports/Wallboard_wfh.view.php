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
$agent_offline=array();
$agent_aux=array();
if($activity_logout->count() > 0){
    foreach($activity_logout->toArray() as $ad){
        $agent_offline[]=$ad['agentid'];
    }
}
if($activity_aux->count() > 0){
    foreach($activity_aux->toArray() as $ad){
        $agent_aux[]=$ad['agentid'];
    }
}
$agent_break=array_merge($agent_offline,$agent_aux);

$idle_agent=$idle_agent->whereNotIn('veri_upd',$agent_break);
// if (count($agent_reguler) > 0) {
//     foreach ($agent_reguler as $ag) {

//         $data_agent = $bucket_data_reguler->where('veri_upd', $ag['agentid']);


//         $status[$ag['agentid']]['verified'] = $data_agent->filter('veri_call', "=", '13')->toArray();
//         for ($i = 1; $i < 16; $i++) {
//             $status[$ag['agentid']][$i] = count($data_agent->filter('veri_call', "=", $i)->toArray());
//             $total[$i] = $total[$i] + $status[$ag['agentid']][$i];
//         }
//         if ($data_agent->count() > 0) {
//             if ($agent_moss_avaliable->where('agentid', $ag['agentid'])->count() == 0) {
//                 $agent_on_duty++;
//             }
//         }
//         // if($idle_agent->where('veri_upd', $ag['agentid'])->sum('idle') > 0){
//         if ($idle_agent->where('veri_upd', $ag['agentid'])->count() > 0) {
//             $agent_idle_detail[$ag['agentid']] = $idle_agent->where('veri_upd', $ag['agentid'])->sum('idle');
//         }
//         $reguler_peformance[$ag['agentid']] = count($status[$ag['agentid']]['verified']);
//         $sub_total_contacted = $status[$ag['agentid']][1] + $status[$ag['agentid']][13] + $status[$ag['agentid']][3] + $status[$ag['agentid']][12];
//         $sub_total_uncontacted =  $status[$ag['agentid']][4]  +  $status[$ag['agentid']][7] +  $status[$ag['agentid']][11] +  $status[$ag['agentid']][10] +  $status[$ag['agentid']][14] +  $status[$ag['agentid']][2];
//         $detail_agent[$ag['agentid']]['nama'] = $ag['nama'];
//         $detail_agent[$ag['agentid']]['ordercall'] = $sub_total_contacted + $sub_total_uncontacted;
//         $total['contacted'] = $total['contacted'] + $sub_total_contacted;
//         $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
//         $hp_email = filter_by_hp_email($status[$ag['agentid']]['verified'], array("handphone", "email"), array("08", "@"));
//         $hp_only = filter_by_hp_only($status[$ag['agentid']]['verified'], array("handphone", "email"), array("08", "@"));
//     }
// }
// $total_oc = ($total['contacted'] + $total['uncontacted']) + $wo;
// $verified = ($total[13]);
// $oc = ($total['contacted'] + $total['uncontacted']);
// $percent_oc = (($total['contacted'] + $total['uncontacted']) / $total_oc) * 100;
// $rating_agent_reguler = array();
// if (count($reguler_peformance) > 0) {
//     arsort($reguler_peformance);
//     $rating_agent_reguler = array_slice($reguler_peformance, 0, 5);
//     $n = 1;

//     foreach ($rating_agent_reguler as $k => $v) {
//         // echo $k."<br>";
//         $category_amount_reg[] = array(
//             "category" => $detail_agent[$k]['nama'],
//             "verified" => $v,
//             "callorder" => $detail_agent[$k]['ordercall']
//         );
//     }
// }

/*----------------------END REGULER AREA------------------*/

/*---------------------- MOSS AREA------------------*/
// $total_moss = array();
// $total_moss['sum'] = 0;
// $total_moss['slfc'] = 0;
// $total_moss['count'] = 0;
// $moss_peformance = array();


// if (count($agent_moss) > 0) {
//     foreach ($agent_moss as $ag) {
//         $data_agent = $bucket_data_moss->where('update_by', $ag['agentid']);
//         if ($data_agent->count() > 0) {
//             // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
//             // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
//             $total_moss['sum'] = $total_moss['sum'] + $data_agent->sum('slg');
//             $total_moss['slfc'] = $total_moss['slfc'] + $data_agent->sum('slfc');
//             $total_moss['count'] = $total_moss['count'] + $data_agent->count();
//             $moss_peformance[$ag['agentid']] = ($data_agent->sum('slg') / $data_agent->count()) / 60;
//             $detail_agent[$ag['agentid']]['nama'] = $ag['nama'];
//             $detail_agent[$ag['agentid']]['ordercall'] = $data_agent->count();
//             $no++;
//             if ($agent_moss_avaliable->where('agentid', $ag['agentid'])->count() > 0) {
//                 $agent_on_duty++;
//             }
//         }
//     }
// }
// $total_moss['slg'] = ($total_moss['sum'] / $total_moss['count']) / 60;
// $total_moss['slfc'] = ($total_moss['slfc'] / $total_moss['count']) / 60;
// $rating_agent_moss = array();
// if (count($moss_peformance) > 0) {
//     asort($moss_peformance);
//     $rating_agent_moss = array_slice($moss_peformance, 0, 5);
//     $n = 1;

//     foreach ($rating_agent_moss as $k => $v) {
//         // echo $k."<br>";
//         $category_amount_moss[] = array(
//             "category" => $detail_agent[$k]['nama'],
//             "slg" => $v,
//             "callorder" => $detail_agent[$k]['ordercall']
//         );
//     }
// }
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
                    <td rowspan='2'><i class="fa fa-cog"></i> ON DUTY<br><span style="color:#fff;font-size:200px;text-align:center;"><?php echo $activity_login->count(); ?></span></td>
                    <td><i class="fa fa-cog"></i> AVAILABLE<br><span style="color:#a0bc2e;font-size:75px;text-align:center;"><?php echo ($activity_login->count() - ($activity_aux->count() + $activity_logout->count())); ?></span></td>
                    <td><i class="fa fa-cog"></i> AUX/BREAK <br><span style="color:#ff8e35;font-size:75px;text-align:center;"><?php echo $activity_aux->count(); ?></span></td>
                </tr>
                <tr>
                    <td><i class="fa fa-cog"></i> OFFLINE<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo $activity_logout->count(); ?></span></td>
                    <td><i class="fa fa-cog"></i> IDLE<br><span style="color:#ce2f4f;font-size:75px;text-align:center;"><?php echo $idle_agent->count(); ?></span></td>
                </tr>
                <tr>
                    <td colspan='3'>
                        <div class="col-md-12 col-xl-12" id="panel-form-moss">
                            <div class="card">
                                <div class="card-status bg-orange"></div>
                                <!-- <div class="card-header">
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <div class='box-body table-responsive' id='box-table'>
                                        <small>
                                            <table class='timecard' style="width: 100%;color:#000;">
                                                <thead>
                                                    <tr>
                                                        <th nowrap><b></b></th>
                                                        <th nowrap><b></b></th>
                                                        <th style="background-color:red;color:white;"><b>Idle Time</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($idle_agent->count() > 0) {
                                                        foreach ($idle_agent->toArray() as $detail_agent_idle) {
                                                            if ($activity_aux->where('agentid', $detail_agent_idle['veri_upd'])->count() == 0) {
                                                                if ($activity_logout->where('agentid', $detail_agent_idle['veri_upd'])->count() == 0) {

                                                    ?>

                                                                    <tr>
                                                                        <td style="text-align:left;"><?php echo $detail_agent_idle['nama']; ?></td>
                                                                        <td style="text-align:left;"></td>
                                                                        <td><?php echo number_format($detail_agent_idle['idle'] / 60); ?> Menit</td>
                                                                    </tr>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                </tbody>
                                            </table>
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
            <div class="col-md-12 col-xl-12" id="panel-form-moss">
                <div class="card">
                    <div class="card-status bg-orange"></div>
                    <div class="card-header">
                        <h3 class="card-title" style="color:#a3a8ac;text-align:center;">Reguler Performance

                        </h3>
                        <!-- <div class="card-options">
                            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class='box-body table-responsive' id='box-table'>
                            <small>
                                <table class='timecard' id="report_table_reg" style="width: 100%;color:#000;">
                                    <thead>
                                        <tr>
                                            <th><b>No</b></th>
                                            <th nowrap><b>Nama Agent</b></th>
                                            <th nowrap><b>User ID</b></th>
                                            <th style="background-color:green;color:white;"><b>Verified</b></th>
                                            <th style="background-color:green;color:white;"><b>BP</b></th>
                                            <th style="background-color:green;color:white;"><b>TBP</b></th>
                                            <th style="background-color:green;color:white;"><b>FLUP</b></th>
                                            <th style="background-color:blue;color:white;"><b>HPE</b></th>
                                            <th style="background-color:blue;color:white;"><b>HPO</b></th>
                                            <th style="background-color:red;color:white;"><b>RNA</b></th>
                                            <th style="background-color:red;color:white;"><b>SS</b></th>
                                            <th style="background-color:red;color:white;"><b>Isolir</b></th>
                                            <th style="background-color:red;color:white;"><b>Decline</b></th>
                                            <th style="background-color:red;color:white;"><b>Reject</b></th>
                                            <th style="background-color:red;color:white;"><b>LR</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (count($agent_reguler) > 0) {
                                            foreach ($agent_reguler as $ag) {

                                                $data_agent = $bucket_data_reguler->where('veri_upd', $ag['agentid']);


                                                $status[$ag['agentid']]['verified'] = $data_agent->filter('veri_call', "=", '13')->toArray();
                                                for ($i = 1; $i < 16; $i++) {
                                                    $status[$ag['agentid']][$i] = count($data_agent->filter('veri_call', "=", $i)->toArray());
                                                    $total[$i] = $total[$i] + $status[$ag['agentid']][$i];
                                                }
                                                $hp_email = filter_by_hp_email($status[$ag['agentid']]['verified'], array("handphone", "email"), array("08", "@"));
                                                $hp_only = filter_by_hp_only($status[$ag['agentid']]['verified'], array("handphone", "email"), array("08", "@"));
                                        ?>

                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td style="text-align:left;"><?php echo $ag['nama']; ?></td>
                                                    <td style="text-align:left;"><?php echo $ag['agentid']; ?></td>
                                                    <td><?php echo number_format(count($status[$ag['agentid']]['verified'])); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][1]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][3]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][12]); ?></td>
                                                    <td><?php echo number_format(count($hp_email)); ?></td>
                                                    <td><?php echo number_format(count($hp_only)); ?></td>

                                                    <td><?php echo number_format($status[$ag['agentid']][2]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][4]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][7]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][11]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][10]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][14]); ?></td>

                                                </tr>
                                        <?php
                                                $no++;
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
            <div class="col-md-12 col-xl-12" id="panel-form-moss">
                <div class="card">
                    <div class="card-status bg-orange"></div>
                    <div class="card-header">
                    <h3 class="card-title" style="color:#a3a8ac;text-align:center;">Moss Performance

</h3>
                        <!-- <div class="card-options">
                            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class='box-body table-responsive' id='box-table'>
                            <small>
                                <table class='timecard' id="report_table_moss" style="width: 100%;color:#000;">
                                    <thead>
                                        <tr>
                                            <th><b>No</b></th>
                                            <th nowrap><b>Nama Agent</b></th>
                                            <th nowrap><b>User ID</b></th>
                                            <th style="background-color:green;color:white;"><b>Verified</b></th>
                                            <th style="background-color:green;color:white;"><b>BP</b></th>
                                            <th style="background-color:green;color:white;"><b>TBP</b></th>
                                            <th style="background-color:green;color:white;"><b>FLUP</b></th>
                                            <th style="background-color:red;color:white;"><b>RNA</b></th>
                                            <th style="background-color:red;color:white;"><b>SS</b></th>
                                            <th style="background-color:red;color:white;"><b>Isolir</b></th>
                                            <th style="background-color:red;color:white;"><b>Decline</b></th>
                                            <th style="background-color:red;color:white;"><b>Reject</b></th>
                                            <th style="background-color:red;color:white;"><b>LR</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (count($agent_moss) > 0) {
                                            foreach ($agent_moss as $ag) {

                                                $data_agent = $bucket_data_moss->where('update_by', $ag['agentid']);


                                                $status[$ag['agentid']]['verified'] = $data_agent->filter('reason_call', "=", '13')->toArray();
                                                for ($i = 1; $i < 16; $i++) {
                                                    $status[$ag['agentid']][$i] = count($data_agent->filter('reason_call', "=", $i)->toArray());
                                                    $total[$i] = $total[$i] + $status[$ag['agentid']][$i];
                                                }
                                        ?>

                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td style="text-align:left;"><?php echo $ag['nama']; ?></td>
                                                    <td style="text-align:left;"><?php echo $ag['agentid']; ?></td>
                                                    <td><?php echo number_format(count($status[$ag['agentid']]['verified'])); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][1]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][3]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][12]); ?></td>

                                                    <td><?php echo number_format($status[$ag['agentid']][2]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][4]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][7]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][11]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][10]); ?></td>
                                                    <td><?php echo number_format($status[$ag['agentid']][14]); ?></td>

                                                </tr>
                                        <?php
                                                $no++;
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
