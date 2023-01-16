<?php echo _css("selectize,multiselect,datatables") ?>
<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header  justify-content-between align-items-center">
            <h4 class="card-title">Result</h4>
        </div>
        <div class="card-body">
            <div class="box-body table-responsive" id='box-table'>

                <small>
                    <?php
                    echo "jumlah agentid";
                    echo $debug_jumlah;
                    ?>
                    <table class='timecard display responsive nowrap' id="report_table_reg" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>no</th>
                                <!-- <th>id</th>
                                <th>idx</th> -->
                                <th>no_telp</th>
                                <th>no_internet</th>
                                <th>ncli</th>
                                <th>nama_pelanggan</th>
                                <th>relasi</th>
                                <th>jk</th>
                                <th>no_hp</th>
                                <th>no_hp_lain</th>
                                <th>wa</th>
                                <th>email_utama</th>
                                <th>email_lain</th>
                                <th>fb</th>
                                <th>tw</th>
                                <th>ig</th>
                                <th>v_nama</th>
                                <th>v_alamat</th>
                                <th>v_kota</th>
                                <th>v_kecepatan</th>
                                <th>v_tagihan</th>
                                <th>tp_bayar</th>
                                <th>th_pasang</th>
                                <th>v_email</th>
                                <th>v_sms</th>
                                <th>opsi_call</th>
                                <th>sub_call</th>
                                <th>status_call</th>
                                <th>veri_upd</th>
                                <th>nama_agent</th>
                                <th>veri_lup</th>
                                <th>lup</th>
                                <th>keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            
                            foreach ($datanya  as $datana) {

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
                                        <!-- <td><?php echo $datana->id; ?></td>
                                        <td><?php echo $datana->idx; ?></td> -->
                                        <td><?php echo $datana->no_telp; ?></td>
                                        <td><?php echo $datana->no_internet; ?></td>
                                        <td><?php echo $datana->ncli; ?></td>
                                        <td><?php echo $datana->nama_pelanggan; ?></td>
                                        <td><?php echo $datana->relasi; ?></td>
                                        <td><?php echo $datana->jk; ?></td>
                                        <td><?php echo $datana->no_hp; ?></td>
                                        <td><?php echo $datana->no_hp_lain; ?></td>
                                        <td><?php echo $datana->wa; ?></td>
                                        <td><?php echo $datana->email_utama; ?></td>
                                        <td><?php echo $datana->email_lain; ?></td>
                                        <td><?php echo $datana->fb; ?></td>
                                        <td><?php echo $datana->tw; ?></td>
                                        <td><?php echo $datana->ig; ?></td>
                                        <td><?php echo $datana->v_nama; ?></td>
                                        <td><?php echo $datana->v_alamat; ?></td>
                                        <td><?php echo $datana->v_kota; ?></td>
                                        <td><?php echo $datana->v_kecepatan; ?></td>
                                        <td><?php echo $datana->v_tagihan; ?></td>
                                        <td><?php echo $datana->tp_bayar; ?></td>
                                        <td><?php echo $datana->th_pasang; ?></td>
                                        <td><?php echo $datana->v_email; ?></td>
                                        <td><?php echo $datana->v_sms; ?></td>
                                        <td><?php echo $datana->opsi_call; ?></td>
                                        <td><?php 
                                        $nama_reason = $this->db->query("SELECT id_reason, nama_reason FROM status_call WHERE id_reason='$datana->sub_call'")->row()->nama_reason;
                                        echo $nama_reason; ?></td>
                                        <td><?php 
                                        $status_call_ar = array(
                                            "1"=>"Verified",
                                            "2"=>"Not Verified",
                                            "3"=>"Ditelpon Kembali",
                                        );
                                        echo $status_call_ar[$datana->status_call]; ?></td>
                                        <td><?php echo $datana->veri_upd; ?></td>
                                        <?php $nama_agent = $this->db->query("SELECT nama FROM sys_user WHERE agentid='$datana->veri_upd'")->row()->nama;
                                         ?>
                                        <td><?php echo $nama_agent; ?></td>
                                        <td><?php echo $datana->veri_lup; ?></td>
                                        <td><?php echo $datana->lup; ?></td>
                                        <td><?php echo $datana->keterangan; ?></td>


                                    </tr>

                            <?php
                                    $n++;
                                }
                            }
                            ?>



                        </tbody>
                    </table>
                    <?php
                  
                    ?>
                </small>
            </div>
        </div>
    </div>
</div>

<?php echo _js("ybs,selectize,multiselect,datatables") ?>
<script type="text/javascript">
    $('#agentid').selectize({});
</script>
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