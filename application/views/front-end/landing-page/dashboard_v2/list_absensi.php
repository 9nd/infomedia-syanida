<?php echo _css('datatables,icheck') ?>


<div class="col-md-12 col-xl-12">
    <div class="form-group">
        <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                <span class="selectgroup-button selectgroup-button-icon" title="Agent Reguler"><i class="fe fe-shield"></i> All Agent</span>
            </label>
            <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                    </label>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-12" id="panel-form-reguler">
    <div class="card">
        <div class="card-status bg-orange"></div>
        <div class="card-header">
            <h3 class="card-title">Data Absensi Hari Ini

            </h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class='box-body table-responsive' id='box-table'>
                <small>
                    <table class='timecard' id="tabel_absensi_reg" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><b>No</b></th>
                                <th nowrap><b>Nama Agent</b></th>
                                <th nowrap><b>NIK</b></th>
                                <th nowrap><b>IN</b></th>
                                <th nowrap><b>Out</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($sysuserreg->result() as $isinya) {
                                $nama = $isinya->nama;
                                $nik = $isinya->nik_absensi;
                                $queryin = $controller->db->query("SELECT * FROM t_absensi WHERE date(waktu_in) = '$start_filter' AND nik = '$nik' AND stts = 'in'");
                                $queryout = $controller->db->query("SELECT * FROM t_absensi WHERE date(waktu_in) = '$start_filter' AND nik = '$nik' AND stts = 'out'");




                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td style="text-align:left;"><?php echo $isinya->nama; ?></td>
                                    <td style="text-align:left;"><?php echo $isinya->nik_absensi; ?></td>
                                    <td style="text-align:left;"><?php
                                                                    $score = $queryin->num_rows();
                                                                    $rowdata = $queryin->row();
                                                                    if (!$rowdata) {
                                                                        echo "0";
                                                                    } else {
                                                                        //  echo ($score >= 1 ? $sdfs : 'no value');
                                                                        echo $rowdata->waktu_in;
                                                                    }
                                                                    ?></td>
                                    <td style="text-align:left;"><?php
                                                                    $score = $queryout->num_rows();
                                                                    $rowdata = $queryout->row();
                                                                    if (!$rowdata) {
                                                                        echo "0";
                                                                    } else {
                                                                        //  echo ($score >= 1 ? $sdfs : 'no value');
                                                                        echo $rowdata->waktu_in;
                                                                    }
                                                                    ?>
                                    </td>

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
</div>

<?php echo _js('datatables,icheck') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#order_call").text('<?php echo number_format($total['contacted'] + $total['uncontacted']); ?>');
        $("#hp_email").text('<?php echo number_format($total['hp_email']); ?>');
        $("#hp_only").text('<?php echo number_format($total['hp_only']); ?>');

        $("#connected").text('<?php echo number_format($total['contacted']); ?>');
        $("#notconnected").text('<?php echo number_format($total['uncontacted']); ?>');
        $("#verified").text('<?php echo number_format($total[13]); ?>');
        // $("#verified").text('<?php echo number_format($check_veri); ?>');
        // $("#agent_online").text('<?php echo number_format($total['agent_online']); ?>');
        // $("#total_hp_email").text('<?php echo number_format($total['hp_email'] + $total['hp_only']); ?>');
        $("#tllia").text('<?php echo number_format($total['TLLIA']); ?>');
        $("#tlita").text('<?php echo number_format($total['TLITA']); ?>');
        $("#tlateu").text('<?php echo number_format($total['TLATEU']); ?>');
        $("#tabel_absensi_reg").DataTable();
        $("#tabel_absensi_moss").DataTable();
        $("#report_table_moss").DataTable();
        $("#panel-form-reguler").show();
        $("#panel-form-moss").hide();

        $(".selectgroup-input").change(function() {
            if ($(this).val() == "1") {
                $("#panel-form-reguler").show();
                $("#panel-form-moss").hide();
            } else {
                $("#panel-form-reguler").hide();
                $("#panel-form-moss").show();
            }
        });
    });
</script>