<?php echo _css('datatables,icheck') ?>
<div class="card">
    <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Verified Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

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
                        <tr>
                            <th><b>No</b></th>
                            <th nowrap><b>Nama Agent</b></th>
                            <th nowrap><b>User ID</b></th>
                            <th style="background-color:green;color:white;"><b>Verified</b></th>
                            <th style="background-color:green;color:white;"><b>Approve</b></th>
                            <th style="background-color:red;color:white;"><b>Not Approve</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        $data_profiling = $query_trans_profiling->result_array();
                        // $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();

                        if ($agent['num'] > 0) {
                            foreach ($agent['results'] as $ag) {
                                $data_agent = $controller->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);
                                $approve=$controller->qc->get_count(array("status_approve"=> 1,"agentid"=> $ag->agentid,"DATE_FORMAT(lup,'%Y-%m-%d') >="=>$_GET['start'],"DATE_FORMAT(lup,'%Y-%m-%d') <="=>$_GET['end']));
                                $not_approve=$controller->qc->get_count(array("status_approve"=> 0,"agentid"=> $ag->agentid,"DATE_FORMAT(lup,'%Y-%m-%d') >="=>$_GET['start'],"DATE_FORMAT(lup,'%Y-%m-%d') <="=>$_GET['end']));
                        ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td style="text-align:left;"><a href="<?php echo base_url()."Qc/Qc/check_verified?agentid=".$ag->agentid."&start=".$_GET['start']."&end=".$_GET['end'];?>"><?php echo $ag->nama; ?></a></td>
                                    <td style="text-align:left;"><?php echo $ag->agentid; ?></td>
                                    <td><?php echo number_format(count($data_agent)); ?></td>
                                    <td><?php echo number_format($approve); ?></td>
                                    <td><?php echo number_format($not_approve); ?></td>


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