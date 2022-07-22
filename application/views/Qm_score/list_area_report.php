<?php echo _css('datatables,icheck') ?>


<div class="card">
    <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Quality Monitoring Score Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

        </h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div>


    <div class="card-body">

        <div class='box-body table-responsive' id='box-table'>
            <small>
                <table class='timecard display responsive nowrap' id="report_table_reg">
                    <thead>
                        <tr>
                            <th rowspan="2">NO</th>
                            <th rowspan="2">Kategori</th>
                            <th rowspan="2">Parameter</th>
                            <th rowspan="2">Bobot</th>
                            <th colspan="3">Jumlah Sampel</th>
                            <th colspan="2">Persentase (%)</th>
                            <th rowspan="2">Pencapaian</th>
                        </tr>
                        <tr>
                            <th>Nilai 1</th>
                            <th>Nilai 0</th>
                            <th>Total</th>
                            <th>Nilai 1</th>
                            <th>Nilai 0</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $no = 1;
                        foreach ($data_qm['results'] as $dataqm) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $dataqm->kategori; ?></td>
                                <td><?php echo wordwrap($dataqm->keterangan, 30, "<br>"); ?></td>
                                <td><?php echo $dataqm->bobot; ?></td>
                                <td><?php $jmls_1 = count($controller->qc->live_query("SELECT * FROM qm_score WHERE hasil = '1' AND id_qm_score = $dataqm->id AND  DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter' ")->result());
                                    echo $jmls_1;
                                    ?></td>
                                <td><?php $jmls_0 = count($controller->qc->live_query("SELECT * FROM qm_score WHERE hasil = '0' AND id_qm_score = $dataqm->id AND  DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter' ")->result());
                                    echo $jmls_0;
                                    ?></td>
                                <td><?php echo $jmls_all; ?></td>
                                <td><?php $hasil1 = $jmls_1 / $jmls_all * 100;
                                    echo $hasil1 . " %";
                                    ?></td>
                                <td><?php $hasil0 = $jmls_0 / $jmls_all * 100;
                                    echo $hasil0 . " %";
                                    ?></td>
                                <td>
                                    <?php
                                    $bobot = $dataqm->bobot;
                                    $penc = (($bobot / 100) * $jmls_1) / $jmls_all * 100;
                                    echo $penc . " %";
                                    ?></td>
                            </tr>
                        <?php
                            $no++;
                        }

                        ?>

                    </tbody>

                </table>

            </small>
        </div>

    </div>

</div>
<div class="card">
    <!-- <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Form Report Kualitas <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>
        </h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div> -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Target</th>
                                    <th>Pencapaian</th>
                                    <th>% Pencapaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Phone and Communication Skill</td>
                                    <td>35%</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Validation</td>
                                    <td>50%</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Documentation & Information</td>
                                    <td>35%</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>

                    </small>
                </div>
            </div>
            <div class="col-md">

            </div>
        </div>

    </div>
</div>

</div>
<?php echo _js('datatables,icheck') ?>

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

<?php

?>