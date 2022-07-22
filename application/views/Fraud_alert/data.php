<?php echo _css('datatables,icheck') ?>

<!-- START: Card Data-->
<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>
            <table class='display responsive nowrap' id="byhandphone" style="width: 100%;">
                <thead>
                    <tr>
                        <td>No.Handphone</td>
                        <td>AgentID</td>
                        <td style='text-align:center;'>Dial</td>
                        <td nowrap style='text-align:center;'>Duration (Minutes)</td>
                        <td nowrap style='text-align:center;'>Multi No.Internet</td>
                        <td nowrap style='text-align:center;'>Opsi</td>
                        <td nowrap style='text-align:center;'>date check</td>
                        <td nowrap style='text-align:center;'>check by</td>
                        <td nowrap style='text-align:left;'>reason</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n = 0;
                    if (count($rec['rec_hp']) > 0) {
                        foreach ($rec['rec_hp'] as $hp => $datana) {
                            $n++;

                            if ($datana['dup'] > 0) {
                                $inputfraud = $this->db->query("SELECT * FROM t_fraud_alert_check WHERE no_handphone='$hp'")->row();

                                $controller = $this->trans_profiling_daily->live_query("SELECT COUNT(*) as jml, status_approve FROM t_fraud_alert_check WHERE no_handphone='$hp'")->row();
                                if ($controller->jml > 0 && $controller->status_approve == "Approve") {
                                    echo "<tr style='background-color: green; color: white  ;'>";
                                } else if ($controller->jml > 0 && $controller->status_approve == "NotApprove") {
                                    echo "<tr style='background-color: red; color: white;'>";
                                }
                                // echo "<td>" . $n . "</td>";
                                // echo "<td nowrap>" . $controller->Sys_user_table_model->get_row(array("nmuser" =>  $controller->Sys_user_table_model->get_row(array("nmuser" => $kode_tl))->tl))->nama . "</td>";
                                echo "<td nowrap>" . $hp . "</td>";
                                echo "<td>" . $datana['agentid'] . "</td>";
                                echo "<td style='text-align:center;'>" . number_format($datana['çount']) . "</td>";
                                echo "<td style='text-align:center;'>" . number_format(($datana['sum'] / 60)) . "</td>";
                                echo "<td style='text-align:center;'>" . number_format($datana['dup']) . "</td>";
                                echo "<td style='text-align:center;'><a target='_blank' href='" . base_url() . "Fraud_alert/Fraud_alert/audit?hp=" . $hp . "'>Audit</a></td>";
                                if(isset($inputfraud->tanggal_check)){
                                    echo "<td style='text-align:center;'>" . $inputfraud->tanggal_check . "</td>";
                                    echo "<td style='text-align:center;'>" . $inputfraud->update_by . "</td>";
                                    echo "<td style='text-align:left;'>" . $inputfraud->reason . "</td>";
                              
                                }else{
                                    echo "<td style='text-align:center;'>-</td>";
                                    echo "<td style='text-align:center;'>-</td>";
                                    echo "<td style='text-align:center;'>-</td>";
                                }
                                echo "</tr>";
                            }
                        }
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



    </body>
    <!-- END: Body-->

    </html>