<?php echo _css('datatables,icheck') ?>

<div class="col-sm-12 col-lg-12">


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Hasil PNP</h3>
        </div>
        <div class="card-body">
            <div class="dimmer" id="box-upload">

                <div class="loader align-bottom text-center" style="width:200px">mohon tunggu..</div>
                <div class="dimmer-content">
                    <form id="form-a" method="post" enctype="multipart/form-data">
                        <div class='form-group'>
                            <label class='form-label'>Judul</label>
                            <input type="text" class="form-control " value="<?php echo $datanya->judul; ?>" readonly id="judul" name="judul">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>waktu_mulai</label>
                            <input type="datetime-local" class="form-control " value="<?php echo $datanya->waktu_mulai; ?>" readonly id="waktu_mulai" name="waktu_mulai">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>waktu_selesai</label>
                            <input type="datetime-local" class="form-control " value="<?php echo $datanya->waktu_selesai; ?>" readonly id="waktu_selesai" name="waktu_selesai">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>durasi_waktu *Dalam Menit</label>
                            <input type="number" class="form-control " value="<?php echo $datanya->durasi_waktu; ?>" readonly id="durasi_waktu" name="durasi_waktu">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>tanggal</label>
                            <input type="date" class="form-control " value="<?php echo $datanya->tanggal; ?>" readonly id="tanggal" name="tanggal">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>catatan</label>
                            <input type="text" class="form-control " value="<?php echo $datanya->catatan; ?>" readonly id="catatan" name="catatan">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>jumlah_soal</label>
                            <input type="text" class="form-control " value="<?php echo $datanya->jumlah_soal; ?>" readonly id="jumlah_soal" name="jumlah_soal">

                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url() ?>Pnp/Pnp">
                                    <div class="btn btn-default pull-left"> Back</div>
                                </a>
                            </div>
                        </div>
                    </form>



                </div>


            </div>
        </div>
    </div>
</div>

<?php echo card_open('', 'bg-teal', true) ?>

<div class='box-body table-responsive' id='box-table'>
    <small>

        <table class='display nowrap' id="example2" style="width: 100%;">
            <thead>
                <tr>
                    <th><b>No</b></th>
                    <th nowrap><b>AgentID</b></th>
                    <th nowrap><b>Nama</b></th>
                    <th nowrap><b>Benar</b></th>
                    <th nowrap><b>Salah</b></th>
                    <th nowrap><b>Nilai</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;


                foreach ($agent['results'] as $datana) {
                    $num_jawaban = $controller->jawaban_agent->get_count(array("join" => array("siakad_jawaban_ujian b" => "b.id_soal = siakad_jawaban_agent.id_soal AND b.urutan = siakad_jawaban_agent.urutan AND b.jawaban=siakad_jawaban_agent.jawaban AND siakad_jawaban_agent.veri_upd = '" . $datana->agentid . "' AND siakad_jawaban_agent.id_soal='" . $datanya->id . "' ")));
                    $num_ujian = $controller->ujian_agent->get_count(array("id_soal" => $datanya->id, "veri_upd" => $datana->agentid));
                ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $datana->agentid; ?></td>
                        <td><?php echo $datana->nama; ?></td>
                        <?php
                        if ($num_ujian == 0) {
                            echo "<td>No Data</td>";
                            echo "<td>No Data</td>";
                            echo "<td>No Data</td>";
                        } else {
                        ?>
                            <td><?= $num_jawaban ?></td>
                            <td><?= $datanya->jumlah_soal - $num_jawaban ?> </td>
                            <td><?= $num_jawaban / $datanya->jumlah_soal * 100 ?> </td>
                        <?php
                        }
                        ?>

                    </tr>
                <?php
                    $nomor++;
                }
                ?>
            </tbody>
        </table>

    </small>
</div>





<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
    var page_version = "1.0.8"
</script>
<script>
    $(document).ready(function() {
        $('#example2').DataTable();
    });
</script>