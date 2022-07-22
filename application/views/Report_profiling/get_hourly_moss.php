<?php
$title=array(
    "oc"=>"Order Call",
    "contacted"=>"Contacted",
    "not_contacted"=>"Not Contacted",
    "verified"=>"Verified"
);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="card-title"><?php echo $title[$filter_condition];?></h6>
    </div>
    <div class="card-body" style="height: 400px">
        <canvas id="chartjs-multiaxis-data-week"></canvas>
    </div>
</div>
<script type="text/javascript">
    ////////////////////////////////// status Stats Chart /////////////////////////////
    var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
    $(document).ready(function() {
        /////////////////////////////////  Multi Axis ///////////////////////////
        
        ////hourly

        var barmultiaxisChartData_week = {
            labels: [
                <?php
                for ($i = 0; $i <= 23; $i++) {
                    $n_show = $i + 1;
                    echo "'" . $n_show . "',";
                }
                ?>
            ],
            datasets: [
                <?php
                $color = array(
                    "#800080",
                    "#FF00FF",
                    "#000080",
                    "#0000FF",
                    "#008080",
                    "#00FFFF",
                    "#008000",
                    "#00FF00",
                    "#808000",
                    "#FFFF00",
                    "#800000",
                    "#FF0000",
                );
                
                if (count($hourly['hourly_performance']['axis_param']) > 0) {
                    $n = 0;
                    foreach ($hourly['hourly_performance']['axis_param'] as $k => $v) {
                        if (isset($v)) {

                ?> {
                                label: ' <?php echo $v ?>',
                                type: 'line',
                                backgroundColor: "<?php echo $color[$n] ?>",
                                borderColor: "<?php echo $color[$n] ?>",
                                fill: false,
                                yAxisID: 'y-axis-2',
                                data: [

                                    <?php
                                    $cvr = 0;
                                    for ($i = 0; $i <= 23; $i++) {
                                        if (isset($hourly['hourly_performance'][$k]['_' . $i][$filter_condition])) {
                                            $cvr = number_format($hourly['hourly_performance'][$k]['_' . $i][$filter_condition]);
                                            echo $cvr . ",";
                                        }
                                    }

                                    ?>
                                ],
                                datalabels: {
                                    color: '#FFFFFF',
                                    display: false,
                                    // backgroundColor: '#ffc107',
                                    formatter: function(value, ctx) {
                                        return value;
                                    }
                                }
                            },
                <?php
                        }
                        $n++;
                    }
                }

                ?>
            ]

        };

        var chartjs_multiaxis_bar_week = document.getElementById("chartjs-multiaxis-data-week");

        if (chartjs_multiaxis_bar_week) {
            ctx_week = document.getElementById('chartjs-multiaxis-data-week').getContext('2d');
            var mixedChart_week = new Chart(ctx_week, {
                type: 'bar',
                data: barmultiaxisChartData_week,
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'right',
                                id: 'y-axis-2',
                                ticks: {
                                    suggestedMin: 0
                                }
                            },
                            {
                                id: 'y-axis-1',
                                display: true,
                                ticks: {
                                    suggestedMin: 0
                                }
                            }
                        ]
                    }
                }
            });

        }

    });
</script>