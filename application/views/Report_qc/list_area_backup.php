<?php echo _css('datatables,icheck') ?>
<?php echo _css("chartjs") ?>
<div class="card">
    <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Report QC | periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

        </h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div>
    <div class="card-body">
        <table width=100%>

            <tr>
                <td rowspan=2 width="30%" valign="top">
                    <div class="card">
                        <div class="panel-heading lte-heading-warning">
                            <h4 class="card-title">Not Approved</h4>
                        </div>
                        <small>
                            <table class="table card-table">
                                <tbody>
                                    <?php
                                    if ($na->num_rows() <= 0) {
                                        echo "<tr><td colspan='3'>-</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($na->result() as $nan) {
                                    ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $nan->reason_qa ?></td>
                                                <td class="text-right"><span class="text-muted"><?php echo $nan->jml ?></span></td>
                                            </tr>



                                    <?php $no++;
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </small>
                    </div>


                </td>
                <td colspan=2 width="35%" valign="top">

                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-warning">Not Approve Bar Chart</div>
                        <div class="panel-body">
                            <?php
                            if ($na->num_rows() <= 0 ) {
                                echo "-";
                            } else {
                            ?>
                                <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                            <?php } ?>
                        </div>
                    </div>


                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div class="card">
                        <div class="panel-heading lte-heading-success">
                            <h4 class="card-title">AHT > 3 Menit</h4>
                        </div>
                        <small>
                            <table class="table card-table">
                                <tbody>
                                    <?php
                                    if ($aht->num_rows() <= 0) {
                                        echo "<tr><td colspan='3'>-</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($aht->result() as $ahts) {
                                    ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $ahts->aht_qc ?></td>
                                                <td class="text-right"><span class="text-muted"><?php echo $ahts->jml ?></span></td>
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


                </td>
                <td valign="top">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-success">AHT > 3 Menit Bar Chart</div>
                        <div class="panel-body">
                            <?php
                            if ($aht->num_rows() <= 0) {
                                echo "-";
                            } else {
                            ?>
                                <canvas id="barChart2" style="height:200px; min-height:200px"></canvas>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </td>
            </tr>

        </table>
        <div class="card">
            <div class="panel-heading lte-heading-primary">
                <h4 class="card-title">Report QC <?php echo $_GET['start'] . " - " . $_GET['end'] ?></h4>
            </div>
            <div class="box-body table-responsive" id='box-table'>

                <small>
                    <table class='timecard display responsive nowrap' id="report_table_reg" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama QA</th>
                                <th>Nama Agent</th>
                                <th style="background-color: red; color: white;">No PSTN</th>
                                <th style="background-color: red; color: white;">Dial To</th>
                                <th style="background-color: red; color: white;">No Handphone</th>
                                <th style="background-color: red; color: white;">Email</th>
                                <th style="background-color: red; color: white;">Alamat Lengkap</th>
                                <th style="background-color: red; color: white;">Opsi Chanel</th>
                                <th style="background-color: yellow;">Nama Pelanggan</th>
                                <th style="background-color: yellow;">Alamat</th>
                                <th style="background-color: yellow;">Kecepatan</th>
                                <th style="background-color: yellow;">Tagihan</th>
                                <th style="background-color: yellow;">Tahun Pasang</th>
                                <th style="background-color: yellow;">Tempat Pembayaran</th>
                                <th>Kode Verifikasi</th>
                                <th>Keterangan</th>
                                <th>Reason QA</th>
                                <th>Status QA</th>
                                <th>AHT >3 Menit</th>
                                <th>Durasi</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            foreach ($data_tapping  as $datana) {

                                $start = $_GET['start'];
                                $end = $_GET['end'];
                                // $jmldataagree = $controller->qc->live_query("SELECT * FROM qc WHERE agentid = '$datana->agentid' AND (DATE(lup) BETWEEN '$start' AND '$end')")->num_rows();
                                // $jmldatavalid = $controller->qc->live_query("SELECT * FROM qc WHERE agentid = '$datana->agentid' AND status_approve = 1 AND (DATE(lup) BETWEEN '$start' AND '$end')")->num_rows();
                                // $jmldatainvalid = $controller->qc->live_query("SELECT * FROM qc WHERE agentid = '$datana->agentid' AND status_approve = 0 AND (DATE(lup) BETWEEN '$start' AND '$end')")->num_rows();
                                // if ($jmldataagree > 0)
                                {
                            ?>
                                    <tr>
                                        <td><?php echo $n; ?></td>
                                        <td><?php
                                            $idqc = $datana->id_qc;
                                            $queryqc = $controller->qc->live_query("SELECT nmuser FROM sys_user WHERE id = '$idqc'")->row();
                                            echo $queryqc->nmuser;
                                            ?></td>
                                        <td><?php echo $datana->nama_agent; ?></td>
                                        <td><?php echo $datana->pstn1; ?></td>
                                        <td><?php
                                            $agent = $datana->agentid;
                                            $ncli = $datana->ncli;
                                            $pstn1 = $datana->pstn1;
                                            $query =  $controller->qc->live_query("SELECT veri_keterangan FROM trans_profiling_last_month WHERE veri_upd = '$agent' AND ncli = '$ncli' AND pstn1 = '$pstn1' ")->row();
                                            echo $query->veri_keterangan;
                                            ?></td>
                                        <td><?php echo $datana->handphone; ?></td>
                                        <td><?php echo $datana->email; ?></td>
                                        <td><?php echo $datana->alamat; ?></td>
                                        <td><?php
                                            $opsi = $datana->opsi_call;
                                            if ($opsi == 1) {
                                                echo "Telepon Rumah";
                                            } elseif ($opsi == 2) {
                                                echo "Handphone";
                                            } elseif ($opsi == 3) {
                                                echo "Email";
                                            } elseif ($opsi == 4) {
                                                echo "Chat";
                                            } else {
                                                echo "0";
                                            }

                                            ?></td>
                                        <td><?php echo $datana->validate_1; ?></td>
                                        <td><?php echo $datana->validate_2; ?></td>
                                        <td><?php echo $datana->validate_3; ?></td>
                                        <td><?php echo $datana->validate_4; ?></td>
                                        <td><?php echo $datana->validate_5; ?></td>
                                        <td><?php echo $datana->validate_6; ?></td>
                                        <td><?php echo $datana->veri_system_qc; ?></td>
                                        <td><?php echo $datana->keterangan_qc; ?></td>
                                        <td><?php echo $datana->reason_qa; ?></td>
                                        <td>
                                            <?php
                                            $statusapp = $datana->status_approve;
                                            if ($statusapp == 0) {
                                                echo "Not Approved";
                                            } elseif ($statusapp == 1) {
                                                echo "Approved";
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $datana->aht_qc; ?></td>
                                        <td><?php echo $datana->durasi_qc; ?></td>
                                        <td><?php echo $datana->note_qc; ?></td>

                                    </tr>

                            <?php
                                    $n++;
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
</div>
</div>
<!--<div class="col-md-6">
                <div class="panel panel-lte">
                    <div class="panel-heading lte-heading-success">Bar Chart</div>
                    <div class="panel-body">
                        <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                    </div>
                </div>
            </div>-->
<?php echo _js('datatables,icheck') ?>
<?php echo _js("chartjs") ?>

<script type="text/javascript">
    $(document).ready(function() {

        $("#report_table_reg").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    });
</script>
<script>
    //---bar chart---// 
    var areaChartData = {
        labels: [
            <?php $no = 1;
            foreach ($na->result() as $nan) {
                echo $no . ",";
                $no++;
            } ?>
        ],
        datasets: [{
            label: 'Not Approved',
            backgroundColor: 'rgba(253,126,20,1)',
            borderColor: 'rgba(253,126,20,1))',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(253,126,20,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(253,126,20,1)',
            data: [
                <?php foreach ($na->result() as $nan) {
                    echo $nan->jml . ",";
                } ?>
            ]
        }, ]
    }

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>
<script>
    //---bar chart---// 
    var areaChartData = {
        labels: [
            <?php $no = 1;
            foreach ($aht->result() as $ahtx) {
                echo $no . ",";
                $no++;
            } ?>
        ],
        datasets: [{
            label: 'AHT > 3',
            backgroundColor: 'rgba(40, 167, 69, 1)',
            borderColor: 'rgba(40, 167, 69, 1)',
            pointRadius: false,
            pointColor: 'rgba(40, 167, 69, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(40, 167, 69, 1)',
            data: [
                <?php foreach ($aht->result() as $ahtx) {
                    echo $ahtx->jml . ",";
                } ?>

            ]
        }, ]
    }

    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]

    barChartData.datasets[0] = temp0


    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>