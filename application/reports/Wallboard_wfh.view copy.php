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
$wo = $this->dataStore("wo")->mode('num_wo');
$agent_reguler = $this->dataSTore('agent_reguler')->toArray();
$activity_aux = $this->dataSTore('activity_aux');
$agent_moss = $this->dataSTore('agent_moss')->toArray();
$idle_agent = $this->dataSTore('idle_data');
$reguler_peformance = array();
$data_agent = array();
$agent_on_duty = 0;
$agent_idle_detail = array();

if (count($agent_reguler) > 0) {
    foreach ($agent_reguler as $ag) {

        $data_agent = $bucket_data_reguler->where('veri_upd', $ag['agentid']);


        $status[$ag['agentid']]['verified'] = $data_agent->filter('veri_call', "=", '13')->toArray();
        for ($i = 1; $i < 16; $i++) {
            $status[$ag['agentid']][$i] = count($data_agent->filter('veri_call', "=", $i)->toArray());
            $total[$i] = $total[$i] + $status[$ag['agentid']][$i];
        }
        if ($data_agent->count() > 0) {
            if ($agent_moss_avaliable->where('agentid', $ag['agentid'])->count() == 0) {
                $agent_on_duty++;
            }
        }
        // if($idle_agent->where('veri_upd', $ag['agentid'])->sum('idle') > 0){
        if ($idle_agent->where('veri_upd', $ag['agentid'])->count() > 0) {
            $agent_idle_detail[$ag['agentid']] = $idle_agent->where('veri_upd', $ag['agentid'])->sum('idle');
        }
        $reguler_peformance[$ag['agentid']] = count($status[$ag['agentid']]['verified']);
        $sub_total_contacted = $status[$ag['agentid']][1] + $status[$ag['agentid']][13] + $status[$ag['agentid']][3] + $status[$ag['agentid']][12];
        $sub_total_uncontacted =  $status[$ag['agentid']][4]  +  $status[$ag['agentid']][7] +  $status[$ag['agentid']][11] +  $status[$ag['agentid']][10] +  $status[$ag['agentid']][14] +  $status[$ag['agentid']][2];
        $detail_agent[$ag['agentid']]['nama'] = $ag['nama'];
        $detail_agent[$ag['agentid']]['ordercall'] = $sub_total_contacted + $sub_total_uncontacted;
        $total['contacted'] = $total['contacted'] + $sub_total_contacted;
        $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
        $hp_email = filter_by_hp_email($status[$ag['agentid']]['verified'], array("handphone", "email"), array("08", "@"));
        $hp_only = filter_by_hp_only($status[$ag['agentid']]['verified'], array("handphone", "email"), array("08", "@"));
    }
}
$total_oc = ($total['contacted'] + $total['uncontacted']) + $wo;
$verified = ($total[13]);
$oc = ($total['contacted'] + $total['uncontacted']);
$percent_oc = (($total['contacted'] + $total['uncontacted']) / $total_oc) * 100;
$rating_agent_reguler = array();
if (count($reguler_peformance) > 0) {
    arsort($reguler_peformance);
    $rating_agent_reguler = array_slice($reguler_peformance, 0, 5);
    $n = 1;

    foreach ($rating_agent_reguler as $k => $v) {
        // echo $k."<br>";
        $category_amount_reg[] = array(
            "category" => $detail_agent[$k]['nama'],
            "verified" => $v,
            "callorder" => $detail_agent[$k]['ordercall']
        );
    }
}

/*----------------------END REGULER AREA------------------*/

/*---------------------- MOSS AREA------------------*/
$total_moss = array();
$total_moss['sum'] = 0;
$total_moss['slfc'] = 0;
$total_moss['count'] = 0;
$moss_peformance = array();


if (count($agent_moss) > 0) {
    foreach ($agent_moss as $ag) {
        $data_agent = $bucket_data_moss->where('update_by', $ag['agentid']);
        if ($data_agent->count() > 0) {
            // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
            // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
            $total_moss['sum'] = $total_moss['sum'] + $data_agent->sum('slg');
            $total_moss['slfc'] = $total_moss['slfc'] + $data_agent->sum('slfc');
            $total_moss['count'] = $total_moss['count'] + $data_agent->count();
            $moss_peformance[$ag['agentid']] = ($data_agent->sum('slg') / $data_agent->count()) / 60;
            $detail_agent[$ag['agentid']]['nama'] = $ag['nama'];
            $detail_agent[$ag['agentid']]['ordercall'] = $data_agent->count();
            $no++;
            if ($agent_moss_avaliable->where('agentid', $ag['agentid'])->count() > 0) {
                $agent_on_duty++;
            }
        }
    }
}
$total_moss['slg'] = ($total_moss['sum'] / $total_moss['count']) / 60;
$total_moss['slfc'] = ($total_moss['slfc'] / $total_moss['count']) / 60;
$rating_agent_moss = array();
if (count($moss_peformance) > 0) {
    asort($moss_peformance);
    $rating_agent_moss = array_slice($moss_peformance, 0, 5);
    $n = 1;

    foreach ($rating_agent_moss as $k => $v) {
        // echo $k."<br>";
        $category_amount_moss[] = array(
            "category" => $detail_agent[$k]['nama'],
            "slg" => $v,
            "callorder" => $detail_agent[$k]['ordercall']
        );
    }
}
/*----------------------END MOSS AREA------------------*/

?>
<script id="src_ybs" src="<?php echo base_url() ?>assets/js/Chart.js"></script>
<table width="100%">
    <tr>
        <td width="33%">
            <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">


        </td>
        <td width="34%" style="text-align:center;">


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

        <td width="15%" valign="top">
            <?php

            Gauge::create(array(
                "dataSource" => array(
                    array("label" => "SLG", "value" => 5),
                ),
                "columns" => array(
                    "label",
                    "value" => array(
                        "suffix" => "Mnt",
                    )
                ),
                "options" => array(
                    "redFrom" => 5,
                    "redTo" => 10,
                    "yellowFrom" => 4,
                    "yellowTo" => 5,
                    "minorTicks" => 5,
                    "max" => 10
                ),
            ));
            ?>
        </td>
        <td width="10%" valign="top">
            <?php

            Gauge::create(array(
                "dataSource" => array(
                    array("label" => "SLFC", "value" => $total_moss['slfc']),
                ),
                "columns" => array(
                    "label",
                    "value" => array(
                        "suffix" => "Mnt",
                    )
                ),
                "options" => array(
                    "redFrom" => 5,
                    "redTo" => 10,
                    "yellowFrom" => 4,
                    "yellowTo" => 5,
                    "minorTicks" => 5,
                    "max" => 10
                )
            ));
            ?></td>
        <td width="15%" valign="top">
            <?php

            Gauge::create(array(
                "dataSource" => array(
                    array("label" => "Verified", "value" => $verified),
                ),
                "columns" => array(
                    "label",
                    "value" => array(
                        "suffix" => "",
                    )
                ), "options" => array(
                    "redFrom" => 0,
                    "redTo" => 2000,
                    "yellowFrom" => 2001,
                    "yellowTo" => 4000,
                    "greenFrom" => 4001,
                    "greenTo" => 5000,
                    "minorTicks" => 5,
                    "max" => 5000
                )
            ));
            ?></td>
        <td width="20%" valign="top">
            <table width="100%" style="color:#ce2f4f;font-size:35px;text-align:center;">
                <tr>
                    <td>
                        Waiting
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom:4px solid #ce2f4f;">
                        -
                    </td>
                </tr>
                <tr>
                    <td>
                        Work Order
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $wo; ?>
                    </td>
                </tr>
            </table>
        </td>
        <td width="35%" valign="top" rowspan="2">
           
            
        </td>
        <td width="5%" rowspan="2"></td>
    </tr>
    <tr>
       
        <td colspan="3" valign="top">
            <table width="100%"  style="color:#a3a8ac;font-size:25px;text-align:center;">
                <tr>
                    <td rowspan='2'> ON DUTY<br><span style="color:#fff;font-size:200px;text-align:center;"><?php echo $activity_login->count(); ?></span></td>
                    <td>AVAILABLE<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo ($activity_login->count() - ($activity_aux->count() + $activity_logout->count())); ?></span></td>
                    <td>AUX/BREAK <br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo $activity_aux->count(); ?></span></td>
                </tr>
                <tr>
                    <td>OFFLINE<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo $activity_logout->count(); ?></span></td>
                    <td>IDLE<br><span style="color:#fff;font-size:75px;text-align:center;"><?php echo count($agent_idle_detail); ?></span></td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
</table>

<?php
        // echo $this->dataStore("agent")->count()."<br>";
        // echo "Order Call Agent DR2891 : ".$data_co_reguler->filter("veri_call","=",13)->filter("veri_status","=",1)->count();
