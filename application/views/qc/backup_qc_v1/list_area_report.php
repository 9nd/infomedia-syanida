<?php echo _css('datatables,icheck') ?>
<div class="card">
    <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Quality Control Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

        </h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class='box-body table-responsive' id='box-table'>
            <small>
                <table class='timecard' style="width: 100%;">
                    <thead>
                        <tr>
                            <th rowspan='22'><b>NOT APPROVE</b></th>
                            <th><b>KATEGORI</b></th>
                            <th><b>JUMLAH</b></th>
                            <th  rowspan='22' width="50%">Grafik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($i=1;$i<=22;$i++){
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo 'Nama Kategori';?></td>
                                <td><?php echo $i;?></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
                
            </small>
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