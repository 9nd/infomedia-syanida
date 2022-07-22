<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<?php
$thn = array("jan", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
$lap = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#chard_data_ajax').highcharts({
            chart: {},
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
            tooltip: {
                formatter: function() {
                    var s;
                    if (this.point.name) { // the pie chart
                        s = '' +
                            this.point.name + ': ' + this.y + ' ';
                    } else {
                        s = '' +
                            this.x + ': ' + this.y;
                    }
                    return s;
                }
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
            series: [
                <?php
                if ($tahun['num'] > 0) {
                    foreach ($tahun['results'] as $th) {
                ?> {
                            type: 'spline',
                            name: '<?php echo $th->tahun; ?>',
                            data: [
                                <?php
                                foreach ($value[$th->tahun] as $val) {
                                    if($val > 0){
                                        echo $val . ",";
                                    }
                                    
                                }
                                ?>
                            ]


                        },
                <?php
                    }
                }
                ?>
            ]
        });
    });
</script>
