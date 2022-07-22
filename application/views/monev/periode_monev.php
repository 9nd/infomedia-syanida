<?php echo _css('datatables') ?>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Monitoring dan Evaluasi Periode
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['aux_num'] != 0) {
                        if ($cache_monev_realtime['aux_num'] < $aux_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['aux_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['aux_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo number_format($aux_total_status['aux'] / 60, 2); ?></div>
                    <div class="text-muted mb-4">AUX TIME</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-white">
                        <?php
                        echo $aht;
                        // echo '<i class="fe fe-chevron-down"></i>';
                        ?>
                    </div>
                    <div class="h1 m-0"><?php echo number_format(($aht / 60), 2); ?></div>
                    <div class="text-muted mb-4">AHT</div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">AGENT STATUS</h3>
                </div>
                <div class="card-body">
                    <div class='box-body table-responsive' id='box-table'>
                        <small>
                            *<i>Dalam Satuan Menit</i>
                            <table class='timecard' id="report_table_reg" style="width: 100%;">
                                <thead>

                                    <tr>
                                        <th>AGENTID</th>
                                        <th>Nama</th>
                                        <th>TL</th>
                                        <th>CO</th>
                                        <th>Verified</th>
                                        <th>AHT</th>
                                        <th>CRC</th>
                                        <th>CRD</th>
                                        <th>IDLE</th>
                                        <th>AFK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($agent['num']) > 0) {
                                        foreach ($agent['results'] as $ag) {
                                            $agent_peformance = $agent_status[$ag->agentid];
                                            $sub_total_contacted = $agent_status[$ag->agentid][1] + $agent_status[$ag->agentid][13] +  $agent_status[$ag->agentid][3] + $agent_status[$ag->agentid][12];
                                            $sub_total_uncontacted = $agent_status[$ag->agentid][4] + $agent_status[$ag->agentid][7] + $agent_status[$ag->agentid][11] + $agent_status[$ag->agentid][10] + $agent_status[$ag->agentid][14] + $agent_status[$ag->agentid][2];

                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $ag->agentid; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ag->nama; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ag->tl; ?>
                                                </td>
                                                <td>
                                                    <?php echo $sub_total_contacted + $sub_total_uncontacted; ?>
                                                </td>
                                                <td>
                                                    <?php echo $agent_peformance[13]; ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format((($effective_time[$ag->agentid]['aht_sum'] / $effective_time[$ag->agentid]['aht_count']) / 60), 2); ?>
                                                </td>
                                                <td>
                                                    <?php echo $effective_time[$ag->agentid]['call_count']; ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format(($effective_time[$ag->agentid]['call_sum'] / 60), 2); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $date1 = strtotime(date('Y-m-d') . ' 08:00:00');
                                                    $date2 = strtotime(date('Y-m-d H:i:s'));
                                                    if (strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d') . ' 17:00:00')) {
                                                        $date2 = strtotime(date('Y-m-d 17:00:00'));
                                                    }
                                                    $waktu_diluar = ($aux_all_status[$ag->agentid]['Break'] + $aux_all_status[$ag->agentid]['aux'] + $aux_all_status[$ag->agentid]['ibadah'] + $aux_all_status[$ag->agentid]['toilet']);
                                                    
                                                    $interval = $date2 - $date1;
                                                    $productive_time_total=$waktu_diluar+$effective_time[$ag->agentid]['call_sum'];
                                                    // echo $interval;
                                                    if (($interval - $productive_time_total) > 0) {
                                                        echo number_format((($interval - $productive_time_total) / 60), 2);
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo number_format(($waktu_diluar / 60));
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </small>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#report_table_reg').DataTable();
                    });
                </script>
            </div>
        </div>
    </div>
</div>

</div>
<?php echo _js('datatables') ?>