<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form Quality control ', 'bg-green', true) ?>

<form id='form-a'>
    <div class="row">
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>

                <input hidden type='text' readonly class='form-control data-sending focus-color' id='id_qc' name='id_qc' value='<?php if (isset($loginid)) echo $loginid->id_user; ?>'>
                <label class='form-label'>Nama Agent</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='nama_agent' name='nama_agent' placeholder='Nama Agent' value='<?php if (isset($agent)) echo $agent->nama ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Nama Pelanggan</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='nama' name='nama' placeholder='nama' value='<?php if (isset($data)) echo $data->nama ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>Alamat Lengkap</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='alamat' name='alamat' placeholder='alamat' value='<?php if (isset($data)) echo $data->alamat ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kecepatan</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='kec_speedy' name='kec_speedy' placeholder='kec_speedy' value='<?php if (isset($data)) echo $data->kec_speedy ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tagihan</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='billing' name='billing' placeholder='billing' value='<?php if (isset($data)) echo $data->billing ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tahun pemasangan Produk Telkom</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='waktu_psb' name='waktu_psb' placeholder='waktu_psb' value='<?php if (isset($data)) echo $data->waktu_psb ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tempat Pembayaran</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='payment' name='payment' placeholder='payment' value='<?php if (isset($data)) echo $data->payment ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kode Verifikasi</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='veri_system' name='veri_system' placeholder='veri_system' value='<?php if (isset($data)) echo $data->veri_system ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>NCLI</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='ncli' value='<?php if (isset($data)) echo $data->ncli ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>No.PSTN</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='pstn1' name='pstn1' placeholder='pstn1' value='<?php if (isset($data)) echo $data->pstn1 ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>No.Internet</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='no_speedy' name='no_speedy' placeholder='no_speedy' value='<?php if (isset($data)) echo $data->no_speedy ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Dial To</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>No Handphone</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Email</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' id='email' name='email' placeholder='email' value='<?php if (isset($data)) echo $data->email ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Keterangan</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' value='<?php if (isset($data)) echo $data->veri_keterangan ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>Opsi Channel (Hp, Email, dsb)</label>
                <input readonly type='text' readonly class='form-control data-sending focus-color' value='<?php if (isset($data))

                                                                                                                $opsc = $data->opsi_call;
                                                                                                            if ($opsc == 1) {
                                                                                                                echo "Telepon rumah";
                                                                                                            } elseif ($opsc == 2) {
                                                                                                                echo "Handphone";
                                                                                                            } elseif ($opsc == 3) {
                                                                                                                echo "Email";
                                                                                                            } elseif ($opsc == 4) {
                                                                                                                echo "Chat";
                                                                                                            } else {
                                                                                                                echo "-";
                                                                                                            } ?>'>

                <div class='form-group'>
                    <label class='form-label'>Kode Verifikasi Email</label>
                    <input readonly type='text' readonly class='form-control data-sending focus-color' placeholder='verfi_email' value='<?php if (isset($data)) echo $data->verfi_email ?>'>
                </div>
                <div class='form-group'>
                    <label class='form-label'>Kode Verifikasi Password</label>
                    <input readonly type='text' readonly class='form-control data-sending focus-color' placeholder='verfi_handphone' value='<?php if (isset($data)) echo $data->verfi_handphone ?>'>
                </div>

                <div class='form-group'>
                    <label class='form-label'>Recording</label>
                    <?php
                    if ($recording) {
                    ?>
                        <audio controls>
                            <source src="<?php
                                            $dataplode = explode("/mount/recording", $recording);

                                            echo "https://10.194.176.161:9443/apprecording/recording" . $dataplode[1]; ?>" type="audio/wav">
                            Your browser does not support the audio element.
                        </audio>
                        <br>
                        <a href="<?php
                                    $dataplode = explode("/mount/recording", $recording);

                                    echo "https://10.194.176.161:9443/apprecording/recording" . $dataplode[1]; ?>" target="_blank"><button type="button" class="btn btn-success"><i class="fe fe-download"></i> Download</button></a>

                    <?php
                    } else {
                        echo "File Recording Tidak Tersedia";
                        // echo $recording;

                    }
                    ?>

                </div>

            </div>
        </div>
        <div class='col-md-6 col-xl-6' style="background-color:#f5f7fb;">
            <table width="100%">
                <tr>
                    <td colspan=2>Nama QC</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_1' name='validate_1' placeholder='Nama Pelanggan' value='<?php if (isset($data_qc)) echo $data_qc->validate_1 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Nama Pelanggan</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_1' name='validate_1' placeholder='Nama Pelanggan' value='<?php if (isset($data_qc)) echo $data_qc->validate_1 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Alamat</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_2' name='validate_2' placeholder='Alamat' value='<?php if (isset($data_qc)) echo $data_qc->validate_2 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Kecepatan</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_3' name='validate_3' placeholder='Kecepatan' value='<?php if (isset($data_qc)) echo $data_qc->validate_3 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Tagihan</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_4' name='validate_4' placeholder='Tagihan' value='<?php if (isset($data_qc)) echo $data_qc->validate_4 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Tahun pemasangan Produk Telkom</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_5' name='validate_5' placeholder='Tahun pemasangan Produk Telkom' value='<?php if (isset($data_qc)) echo $data_qc->validate_5 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Tempat Pembayaran</td>
                </tr>
                <tr>
                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_6' name='validate_6' placeholder='Tempat Pembayaran' value='<?php if (isset($data_qc)) echo $data_qc->validate_6 ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Opsi Channel (Hp, Email, dsb)</td>
                </tr>
                <tr>

                    <td> <input readonly type='text' class='form-control data-sending focus-color' value='<?php if (isset($data))

                                                                                                                $opsc = $data->opsi_call;
                                                                                                            if ($opsc == 1) {
                                                                                                                echo "Telepon rumah";
                                                                                                            } elseif ($opsc == 2) {
                                                                                                                echo "Handphone";
                                                                                                            } elseif ($opsc == 3) {
                                                                                                                echo "Email";
                                                                                                            } elseif ($opsc == 4) {
                                                                                                                echo "Chat";
                                                                                                            } else {
                                                                                                                echo "-";
                                                                                                            } ?>'>

                    </td>
                </tr>

                <tr>
                    <td colspan=2>Kode Verifikasi</td>
                </tr>
                <tr>

                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='veri_system_qc' name='veri_system_qc' placeholder='Kode Verifikasi' value='<?php if (isset($data_qc)) echo $data_qc->veri_system_qc ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Keterangan</td>
                </tr>
                <tr>

                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='keterangan_qc' name='keterangan_qc' placeholder='Keterangan' value='<?php if (isset($data_qc)) echo $data_qc->keterangan_qc ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Durasi</td>
                </tr>
                <tr>

                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='durasi_qc' name='durasi_qc' placeholder='Durasi' value='<?php if (isset($data_qc)) echo $data_qc->durasi_qc ?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 class="aht_qc">AHT > 3menit</td>
                </tr>
                <tr>

                    <!--  <td> <input readonly type='text' class='form-control data-sending focus-color' id='aht_qc' name='aht_qc' placeholder='AHT > 3menit' value='<?php if (isset($data_qc)) echo $data_qc->aht_qc ?>'>
                    </td> -->
                    <td>
                        <input readonly type='text' class='form-control data-sending focus-color' value='<?php if (isset($data_qc)) echo $data_qc->aht_qc ?>'>

                        <!--<input readonly type='text' class='form-control data-sending focus-color' id='aht_qc' name='aht_qc' placeholder='AHT > 3menit' value=''> -->

                    </td>
                </tr>
                <tr>
                    <td colspan=2>Note</td>
                </tr>
                <tr>

                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='note_qc' name='note_qc' placeholder='Note' value='<?php if (isset($data_qc)) echo $data_qc->note_qc ?>'>
                    </td>
                </tr>


                <tr id="hidereason" class="elem_not_approve" <?php echo ($data_qc->status_approve == 1) ? "style='display:none;'" : ""; ?>>
                    <td colspan=2>Reason QA</td>
                </tr>
                <tr id="hidereason" class="elem_not_approve" <?php echo ($data_qc->status_approve == 1) ? "style='display:none;'" : ""; ?>>


                    <td> <input readonly type='text' class='form-control data-sending focus-color' id='reason_qa' name='reason_qa' placeholder='' value='<?php if (isset($data_qc)) echo $data_qc->reason_qa ?>'>
                    </td>
                    <!--<input readonly type='text' class='form-control data-sending focus-color' id='reason_qa' name='reason_qa' placeholder='Reason QA' value='<?php if (isset($data_qc)) echo $data_qc->reason_qa ?>'> -->

                </tr>

                <?php
                if (isset($data_qc->tanggal_banding)) {

                ?>
                    <tr>

                        <td colspan='2'>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2><b>Reason Banding</b></td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp; &nbsp; &nbsp;<?php echo $data_qc->tanggal_banding . "|" . $data_qc->reason_banding ?></td>
                    </tr>
                    <tr>
                        <td colspan=2><b>Status Approve TL</b></td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp; &nbsp; &nbsp;<?php echo $data_qc->tanggal_tl . "|";
                                                            if ($data_qc->app_tl == 1) {
                                                                echo "Approve";
                                                            } else if ($data_qc->app_tl == 0) {
                                                                echo "Not Approve";
                                                            } else {
                                                                echo "Belum di Cek";
                                                            }
                                                            ?></b></td>
                    </tr>
                    <tr>
                        <td colspan=2><b>Reason TL</b></td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp; &nbsp; &nbsp;<?php echo $data_qc->reason_tl ?></b></td>
                    </tr>
                    <tr>
                        <td colspan=2><b>Status Approve QC</b></td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp; &nbsp; &nbsp;<?php echo $data_qc->tanggal_qc . "|";
                                                            if ($data_qc->app_qc  == 1) {
                                                                echo "Approve";
                                                            } else if ($data_qc->app_qc  == 0) {
                                                                echo "Not Approve";
                                                            } else {
                                                                echo "Belum di Cek";
                                                            }
                                                            ?></td>
                    </tr>
                    <tr>
                        <td colspan=2><b>Reason QC</b></td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp; &nbsp; &nbsp;
                            <?php
                            if (isset($data_qc->reason_qcb)) {
                                echo $data_qc->reason_qcb;
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }

                ?>

                <tr>

                    <td colspan='2'>
                        <div class='form-group'>
                            <a href='<?php echo base_url() . 'Banding/Banding' ?>' id='btn-close' class='btn btn-warning btn-block'> Back</a>
                        </div>

                    </td>
                </tr>

            </table>

        </div>
    </div>

</form>


<?php echo card_close() ?>

<?php echo _js('selectize,datepicker') ?>

<script>
    var page_version = "1.0.8"
</script>