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
                        <tr>
                            <th><b>No</b></th>
                            <th><b>Nama Agent</b></th>
                            <th><b>NO. PERNER</b></th>
                            <th>Jml Hadir</th>
                            <th>Jml Absen</th>
                            <th>Jml Tepat Waktu</th>
                            <th>Jml Telat</th>
                            <th>Akm. Telat</th>
                            <th>Rasio Ontime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sysuserreg->result() as $isinya) {
                            $nama = $isinya->nama;
                            $nik = $isinya->nik_absensi;
                            $queryin = $controller->db->query("SELECT sys_user.nama, sys_user.kategori,sys_user.nik_absensi, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
                                FROM sys_user
                                LEFT JOIN t_absensi
                                ON sys_user.nik_absensi = t_absensi.nik
                                where  sys_user.opt_level=8
                                AND sys_user.kategori = 'REG'
                                    AND MONTH(waktu_in) = MONTH(CURDATE())
                                AND t_absensi.stts = 'in'
                                    AND day(t_absensi.waktu_in) = $no
                                    AND methode=1
                                    AND (sys_user.nik_absensi = '$nik' or sys_user.nama = '$nama')
                                ");

                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td style="text-align:left;"><?php echo $isinya->nama; ?></td>
                                <td style="text-align:left;"><?php echo $isinya->nik_absensi; ?></td>

                                <td style="text-align:left;">
                                    <?php
                                    $start = $_GET['start'];
                                    $end = $_GET['end'];
                                    $nama = $isinya->nama;
                                    $nik = $isinya->nik_absensi;
                                    $queryjmlhadir = $controller->db->query("SELECT
                                    sys_user.nama,
                                    sys_user.kategori,
                                    sys_user.opt_level,
                                    t_absensi.waktu_in,
                                    t_absensi.stts 
                                FROM
                                    sys_user
                                    LEFT JOIN t_absensi ON sys_user.nik_absensi = t_absensi.nik 
                                WHERE
                                    ( date(t_absensi.waktu_in) BETWEEN '$start' AND '$end' ) 
                                    AND sys_user.opt_level = 8 
                                    AND sys_user.kategori = 'REG' 
                                    AND t_absensi.stts = 'in' 
                                    AND methode=1
                                    AND sys_user.nik_absensi = '$nik'
                                        ");
                                    $results = $queryjmlhadir->num_rows();
                                    $jmlresuls += $results;
                                    echo $results;

                                    ?>


                                </td>
                                <td><?php

                                    $jmlabsen =  $results - $weekdays;
                                    echo abs($jmlabsen);
                                    ?></td>
                                <td style="text-align:left;">

                                    <?php
                                    $start = $_GET['start'];
                                    $end = $_GET['end'];
                                    $nama = $isinya->nama;
                                    $nik = $isinya->nik_absensi;
                                    $queryjmlhadir = $controller->db->query("SELECT
                                    sys_user.nama,
                                    sys_user.kategori,
                                    sys_user.opt_level,
                                    t_absensi.waktu_in,
                                    t_absensi.stts 
                                FROM
                                    sys_user
                                    LEFT JOIN t_absensi ON sys_user.nik_absensi = t_absensi.nik 
                                WHERE
                                    ( date(t_absensi.waktu_in) BETWEEN '$start' AND '$end' ) 
                                    AND sys_user.opt_level = 8 
                                    AND sys_user.kategori = 'REG' 
                                    AND t_absensi.stts = 'in' 
                                    AND sys_user.nik_absensi = '$nik'
                                    AND methode=1
                                    AND time(waktu_in) <= '08:00:00'
                                        ");
                                    $resultsontime = $queryjmlhadir->num_rows();
                                    $jmlresultontime += $resultsontime;
                                    echo $resultsontime;
                                    ?>
                                </td>
                                <td style="text-align:left;">
                                    <?php
                                    $jmltelat = $results - $resultsontime;
                                    echo $jmltelat;

                                    ?>

                                </td>
                                <td style="text-align:center;"><?php

                                                                $start = $_GET['start'];
                                                                $end = $_GET['end'];
                                                                $nama = $isinya->nama;
                                                                $nik = $isinya->nik_absensi;
                                                                $queryjmlhadirmnt = $controller->db->query("SELECT
                                                                                sys_user.nama,
                                                                                sys_user.kategori,
                                                                                sys_user.opt_level,
                                                                                t_absensi.waktu_in,
                                                                                t_absensi.stts,
                                                                                SUM(TIMESTAMPDIFF(MINUTE, CONCAT(DATE(waktu_in),' 08:00:00'),t_absensi.waktu_in)) AS selisih
                                                                                FROM
                                                                                sys_user
                                                                                LEFT JOIN t_absensi ON sys_user.nik_absensi = t_absensi.nik 
                                                                                WHERE
                                                                                
                                                                                ( date(t_absensi.waktu_in) BETWEEN '$start' AND '$end' ) 
                                                                                AND sys_user.opt_level = 8 
                                                                                AND sys_user.kategori = 'REG' 
                                                                                AND t_absensi.stts = 'in' 
                                                                                AND sys_user.nik_absensi = '$nik'
                                                                                AND methode=1
                                                                                AND time(waktu_in) > '08:00:00'
                                                                                    ");
                                                                $resultslate = $queryjmlhadirmnt->num_rows();
                                                                $jmlresultlate += $resultslate;

                                                                if ($queryjmlhadirmnt->row('selisih') != 0) {
                                                                    echo "<b>" . $queryjmlhadirmnt->row('selisih') . "</b>" ;
                                                                } else {
                                                                    echo "-";
                                                                }


                                                                ?>
                                </td>
                                <td style="text-align:left;"><?php

                                                                if ($results == 0) {
                                                                    echo "-";
                                                                } else {
                                                                    $rasio = $resultsontime / $results * 100;
                                                                    echo number_format($rasio) . "%";
                                                                }
                                                                ?>
                                </td>

                                <?php


                                ?>



                            </tr>

                        <?php
                            $no++;
                        }
                        ?>
                    <tfoot style="display: none;">
                        <tr>
                            <td colspan=3>Jumlah</td>
                            <td><?php echo $jmlresuls; ?></td>
                            <td><?php echo $jmlresultontime; ?></td>
                            <td><?php echo $jmlresultlate; ?></td>
                            <td><?php

                                if ($jmlresuls == 0) {
                                    echo "-";
                                } else {
                                    $jmlrasio = $jmlresultontime / $jmlresuls * 100;
                                    echo number_format($jmlrasio) . "%";
                                }
                                ?></td>
                        </tr>
                    </tfoot>

                    </tbody>
                </table>
            </small>
        </div>
    </div>
</div>
<?php echo _js('datatables,icheck') ?>
<?php
$agent = count($sysuserreg->result_array());
$jmlweekend = $weekdays * $agent;
$jmlabsen = $jmlweekend - $jmlresuls;

?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#jml_agent").text('<?php echo number_format(count($sysuserreg->result_array())); ?>');
        $("#kehadiran").text('<?php echo number_format($jmlresuls); ?>');
        $("#absen").text('<?php echo $jmlabsen; ?>');
        $("#ontime").text('<?php echo number_format($jmlresultontime); ?>');
        $("#late").text('<?php echo number_format($jmlresultlate); ?>');
        $("#rasio").text('<?php echo number_format($jmlrasio) . "%"; ?>');

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