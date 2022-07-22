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


<table width="100%">
    <tr>
        <td>
            <div class="col-lg-12 col-xs-6 blink_me_veri">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 id="dapros">-</h3>
                        <p>Dapros</p>
                    </div>
                    <div class="icon-counter">
                        <i class="fa fa-phone"></i>
                    </div>
                </div>
            </div>
        </td>

    </tr>
    <tr>
        <td>
            <div id="dapros_chart"></div>
        </td>
    </tr>

</table>
<script type="text/javascript">
    function thousands_separators(num) {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }

    function get_dapros() {

        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_dapros" ?>",
            dataType: 'JSON',
            success: function(response) {
                var data = response.jumlah_data;
                $("#dapros").text(thousands_separators(data));
            }
        });
    }

    function get_grafik_dapros() {
        $.ajax({
            url: "<?php echo base_url() . "api/Dashboard/get_dapros_grapik" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                var cat = [];
                var seriesna = [];
                $.each(response.categories, function(key, val) {
                    cat.push(val);
                });
                dapros_chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'dapros_chart',
                        type: 'column'
                    },
                    title: {
                        text: 'Sumber Data Prospek'
                    },
                    xAxis: {
                        categories: cat
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Value'
                        }
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Sumber Data',
                        data: response.jumlah_data
                    }]
                });

            }
        });

    }


    $(document).ready(function() {

        get_dapros();
        get_grafik_dapros();

    });

    $("#btn-dasboard").click(function() {
        show_success_message("untuk mengaktifkan,tekan icon bintang di samping menu HOME");
    });
</script>