<?php echo _css('datatables,icheck,multiselect,selectize') ?>


    <div class="col-md-12 col-xl-12" id="panel-form-reguler">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Report Efisiensi Periode <?php echo date('Y-m-d'); ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='timecard' id="report_table" width="100%">
                            <thead>
                                <tr>
                                    <th><b>No</b></th>
                                    <th nowrap><b>Nama Agent</b></th>
                                    <th nowrap><b>User ID</b></th>
                                    <th nowrap><b>TL</b></th>
                                    <th nowrap><b>Status</b></th>
                                    <th nowrap><b>Ket</b></th>
                                    <th nowrap><b>Jam Login</b></th>
                                    <th nowrap><b>Jam Logout</b></th>
                                    <th nowrap><b>Jam Duduk</b></th>
                                    <th nowrap><b>Jam Diluar</b></th>
                                    <th nowrap><b>Total</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                // $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();
                                // $check_veri = count($controller->filter_by_value($data_profiling, 'veri_call', '13'));
                                if ($agent['num'] > 0) {
                                    foreach ($agent['results'] as $ag) {
                                        $color = "danger";
                                        $ket="Offline";
                                        $login = $this->sys_user_log_login->get_row(array("id_user" => $ag->id, "DATE_FORMAT(FROM_UNIXTIME(login_time), '%Y-%m-%d') =" => date('Y-m-d')), array("*"), array("id" => "DESC"));
                                        if ($login) {
                                            $color = "success";
                                            $ket="Online";
                                            $logout = $this->sys_user_log_login->get_row(array("id" => $login->id), array("*"), array("id" => "DESC"));
                                            if ($logout->logout_time != '') {
                                                $color = "danger";
                                                $ket="Logout";
                                            } else {
                                                $log_keluar = $this->Sys_log->get_row(array("id_user" => $ag->id, "DATE_FORMAT(login_time, '%Y-%m-%d') =" => date('Y-m-d')), array("*"), array("id" => "DESC"));
                                                if ($log_keluar) {
                                                    if ($log_keluar->logout_time == '') {
                                                        $ket="Break";
                                                        $color = "warning";
                                                    }
                                                }
                                            }
                                        }
                                        $diluar = $this->Sys_log->get_results(array("id_user" => $ag->id, "DATE_FORMAT(login_time, '%Y-%m-%d') =" => date('Y-m-d')), array("TIMESTAMPDIFF(SECOND, login_time, logout_time) as jam "));
                                        $in = $this->sys_user_log_login->get_row(array("id_user" => $ag->id, "DATE_FORMAT(FROM_UNIXTIME(login_time), '%Y-%m-%d') =" => date('Y-m-d')), array("DATE_FORMAT(FROM_UNIXTIME(login_time), '%Y-%m-%d %H:%i:%s') as date_login"), array("id" => "ASC"));
                                        $out = $this->sys_user_log_login->get_row(array("id_user" => $ag->id, "DATE_FORMAT(FROM_UNIXTIME(login_time), '%Y-%m-%d') =" => date('Y-m-d')), array("DATE_FORMAT(FROM_UNIXTIME(logout_time), '%Y-%m-%d %H:%i:%s') as date_logout"), array("id" => "DESC"));
                                        $datetime1 = new DateTime($in->date_login);
                                        $datetime2 = new DateTime(date('Y-m-d H:i:s'));
                                        if ($out) {
                                            $datetime2 = new DateTime($out->date_logout);
                                        }

                                        $interval = $datetime1->diff($datetime2);
                                        $diff = $datetime2->getTimestamp() - $datetime1->getTimestamp();
                                        $total_diluar = 0;
                                        if ($diluar['num'] > 0) {
                                            foreach ($diluar['results'] as $dl) {
                                                $total_diluar = $dl->jam + $total_diluar;
                                            }
                                        }
                                        $waktu_duduk = $diff - $total_diluar;
                                ?>

                                        <tr class="data-<?php echo $color; ?>">
                                            <td><?php echo $no; ?></td>
                                            <td style="text-align:left;"><?php echo $ag->nama; ?></td>
                                            <td style="text-align:left;"><?php echo $ag->agentid; ?></td>
                                            <td style="text-align:left;"><?php echo $ag->tl; ?></td>
                                            <td style="text-align:center;"><button type="button" class="btn btn-<?php echo $color; ?> btn-filter"></button></td>
                                            <td style="text-align:center;"><?php echo $ket;?></td>
                                            <td><?php echo $in->date_login; ?></td>
                                            <td><?php echo $out->date_logout; ?></td>
                                            <td><?php echo gmdate("H:i:s", $waktu_duduk); ?></td>
                                            <td><?php echo gmdate("H:i:s", $total_diluar); ?></td>
                                            <td><?php echo $interval->format('%H:%I:%S'); ?></td>
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
    </div>
<?php echo _js('datatables,icheck,ybs,selectize,multiselect') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#report_table").DataTable();
    });
</script>
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>