<?php echo _css('datatables,icheck') ?>
<div class="card">
    <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Report Call Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

        </h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class='box-body table-responsive' id='box-table'>
            <small>
                <table class='timecard' id="report_table_reg" style="width: 100%;">
                    <thead>
                            <th><b>No</b></th>
                            <th><b>Agent ID</b></th>
                            <th><b>Agent Name</b></th>
                            <th><b>PERNER</b></th>
                            <th><b>TL</b></th>
                            <th>HK</th>
                            <th>Attendance</th>
                            <th>Absent</th>
                            <th>Sick</th>
                            <th>late (in minutes)</th>

                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($agent_reg['results'] as $ag) {
  ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td style="text-align:left;"><?php echo $ag->agentid; ?></td>
                                <td style="text-align:left;"><?php echo $ag->nama; ?></td>
                                <td style="text-align:left;"><?php echo $ag->nik_absensi; ?></td>
                                <td style="text-align:left;"><?php echo $ag->tl; ?></td>
                                <td style="text-align:left;"> <?php echo $hk; ?></td>
                                <td><?php echo $agent[$ag->agentid]['in'];?></td>
                                <td style="text-align:left;"><?php echo $hk-$agent[$ag->agentid]['in'];?></td>
                                <td style="text-align:left;"></td>
                                <td style="text-align:left;"><?php echo $agent[$ag->agentid]['late'];?></td>
                            </tr>

                        <?php
                            $no++;
                        }
                        ?>
                    <tfoot style="display: none;">
                        <tr>
                            <td colspan=3>Jumlah</td>
                           
                        </tr>
                    </tfoot>

                    </tbody>
                </table>
            </small>
        </div>
    </div>
</div>
<?php echo _js('datatables,icheck') ?>
<
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