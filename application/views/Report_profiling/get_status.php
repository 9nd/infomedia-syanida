<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="card-title"><?php echo $titlena; ?></h6>
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
                if (count($status['status_performance']['axis_param']) > 0) {
                    foreach ($status['status_performance']['axis_param'] as $k => $v) {
                        echo "'" . $v . "',";
                    }
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

                // if (count($status['status_performance']['axis_param']) > 0) {
                //     $n = 0;
                //     foreach ($status['status_performance']['axis_param'] as $k => $v) {
                //         if (isset($v)) {

                ?> {
                    label: ' <?php echo $titlena; ?>',
                    type: 'line',
                    backgroundColor: "<?php echo $color[0] ?>",
                    borderColor: "<?php echo $color[0] ?>",
                    fill: false,
                    yAxisID: 'y-axis-2',
                    data: [

                        <?php
                        $cvr = 0;
                        if (count($status['status_performance']['axis_param']) > 0) {
                            foreach ($status['status_performance']['axis_param'] as $k => $v) {
                                if (isset($status['status_performance'][$k]['_' . $veri_call]['numna'])) {
                                    $cvr = $status['status_performance'][$k]['_' . $veri_call]['numna'];
                                    echo $cvr . ",";
                                }
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
                //         }
                //         $n++;
                //     }
                // }

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