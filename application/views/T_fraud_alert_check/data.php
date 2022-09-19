<?php echo _css('datatables,icheck') ?>

<!-- START: Card Data-->
<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>
            <table class='display responsive' id="byhandphone" style="width: 100%;">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>No.Handphone</td>
                        <td>Tanggal Check</td>
                        <td>Update By</td>
                        <td>Reason</td>
                        <td>status approve</td>
                        <td>action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n = 1;
                    foreach ($rec->result() as $datanas) {
                    ?>
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $datanas->no_handphone; ?></td>
                            <td><?php echo $datanas->tanggal_check; ?></td>
                            <td><?php echo $datanas->update_by; ?></td>
                            <td><?php echo $datanas->reason; ?></td>
                            <td><?php echo $datanas->status_approve; ?></td>
                            <td>
                                <a href="<?php echo base_url() . "T_fraud_alert_check/T_fraud_alert_check/update/" . $datanas->id ?>" class="btn btn-default text-red btn-sm " title="edit"><i class="fa fa-edit"></i></a>
                                  <a href="<?php echo base_url() . "T_fraud_alert_check/T_fraud_alert_check/delete_multiple/" . $datanas->id ?> " class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php echo $datanas->id; 
                                                                                                            ?>)"><i class="fa fa-trash"></i></a>
                            



                            </td>

                        </tr>
                    <?php
                        $n++;
                    }
                    ?>
                </tbody>
            </table>
        </small>
    </div>

    <?php echo card_close() ?>
    <?php echo _js('datatables,icheck') ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#byhandphone").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf'
                ]
            });
        });
    </script>
    <script>
        function deleteItem() {
            if (confirm("anda ingin hapus data ini?")) {
                // your deletion code
            }
            return false;
        }
    </script>



    </body>
    <!-- END: Body-->

    </html>