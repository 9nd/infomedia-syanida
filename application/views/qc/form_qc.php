<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form Quality control ', 'bg-green', true) ?>
<!-- Tab links -->
<div class="tab">
    <ul class="nav nav-tabs" id="myTab3" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="interaction-tab" data-toggle="tab" href="#interaction" role="tab" aria-controls="interaction" aria-selected="true"  style="color:black">Quality Monitoring </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="multikontak-tab" data-toggle="tab" href="#multikontak" role="tab" aria-controls="multikontak" aria-selected="false" style="color:black">Quality Score</a>
        </li>


    </ul>
    <br><br>
    <div class="tab-content">
        <div class="tab-pane active" id="interaction" role="tabpanel" aria-labelledby="interaction-tab">
            <form id='form-a'>

                <div class="row">
                    <div class='col-md-6 col-xl-6'>
                        <div class='form-group'>
                            <input hidden type='text' readonly class='form-control data-sending focus-color' id='id_qc' name='id_qc' value='<?php if (isset($loginid)) echo $loginid->id_user; ?>'>
                            <label class='form-label'>Nama Agent </label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='nama_agent' name='nama_agent' placeholder='Nama Agent' value='<?php if (isset($agent)) echo $agent->nama ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Nama Pelanggan</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='nama' name='nama' placeholder='nama' value='<?php if (isset($data)) echo $data->nama ?>'>
                        </div>

                        <div class='form-group'>
                            <label class='form-label'>Alamat Lengkap</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='alamat' name='alamat' placeholder='alamat' value='<?php if (isset($data)) echo $data->alamat ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Kecepatan</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='kec_speedy' name='kec_speedy' placeholder='kec_speedy' value='<?php if (isset($data)) echo $data->kec_speedy ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Tagihan</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='billing' name='billing' placeholder='billing' value='<?php if (isset($data)) echo $data->billing ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Tahun pemasangan Produk Telkom</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='waktu_psb' name='waktu_psb' placeholder='waktu_psb' value='<?php if (isset($data)) echo $data->waktu_psb ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Tempat Pembayaran</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='payment' name='payment' placeholder='payment' value='<?php if (isset($data)) echo $data->payment ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Kode Verifikasi</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='veri_system' name='veri_system' placeholder='veri_system' value='<?php if (isset($data)) echo $data->veri_system ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>NCLI</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='ncli' value='<?php if (isset($data)) echo $data->ncli ?>'>
                        </div>

                        <div class='form-group'>
                            <label class='form-label'>No.PSTN</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='pstn1' name='pstn1' placeholder='pstn1' value='<?php if (isset($data)) echo $data->pstn1 ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>No.Internet</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='no_speedy' name='no_speedy' placeholder='no_speedy' value='<?php if (isset($data)) echo $data->no_speedy ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Dial To</label>
                            <input type='text' readonly class='form-control data-sending focus-color' value='
                <?php if (isset($data)) $verket = $data->veri_keterangan;
                if ($verket === NULL) {
                    echo $data->handphone;
                } else {
                    echo $data->veri_keterangan;
                }
                ?>'>
                        </div>

                        <div class='form-group'>
                            <label class='form-label'>No Handphone</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Handphone Lain</label>
                            <input type='text' readonly class='form-control focus-color' placeholder='handphone_lain' value='<?php if (isset($data)) echo $data->handphone_lain ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Email</label>
                            <input type='text' readonly class='form-control data-sending focus-color' id='email' name='email' placeholder='email' value='<?php if (isset($data)) echo $data->email ?>'>
                        </div>

                        <div class='form-group'>
                            <label class='form-label'>Opsi Channel (Hp, Email, dsb)</label>
                            <input type='text' readonly class='form-control data-sending focus-color' value='
                <?php if (isset($data))
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
                        </div>

                        <div class='form-group'>
                            <label class='form-label'>Kode Verifikasi Email</label>
                            <input type='text' readonly class='form-control data-sending focus-color' placeholder='verfi_email' value='<?php if (isset($data)) echo $data->verfi_email ?>'>
                        </div>
                        <div class='form-group'>
                            <label class='form-label'>Kode Verifikasi Password</label>
                            <input type='text' readonly class='form-control data-sending focus-color' placeholder='verfi_handphone' value='<?php if (isset($data)) echo $data->verfi_handphone ?>'>
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
                    <div class='col-md-6 col-xl-6' style="background-color:#f5f7fb;">
                        <table width="100%">

                            <tr>
                                <td colspan=2>Nama Pelanggan</td>
                            </tr>
                            <tr>
                                <td width="10px"><input type="checkbox" value='0' class='data-sending' id="status_validate_1" name="status_validate_1"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='validate_1' name='validate_1' placeholder='Nama Pelanggan' value='<?php if (isset($data)) echo $data->nama ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Alamat</td>
                            </tr>
                            <tr>
                                <td width="10px"><input type="checkbox" value='0' class='data-sending' name="status_validate_2" id="status_validate_2"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='validate_2' name='validate_2' placeholder='Alamat' value='<?php if (isset($data)) echo $data->alamat ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Kecepatan</td>
                            </tr>
                            <tr>
                                <td width="10px"><input type="checkbox" value='0' class='data-sending' name="status_validate_3" id="status_validate_3"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='validate_3' name='validate_3' placeholder='Kecepatan' value='<?php if (isset($data)) echo $data->kec_speedy ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Tagihan</td>
                            </tr>
                            <tr>
                                <td width="10px"><input type="checkbox" value='0' class='data-sending' name="status_validate_4" id="status_validate_4"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='validate_4' name='validate_4' placeholder='Tagihan' value='<?php if (isset($data)) echo $data->billing ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Tahun pemasangan Produk Telkom</td>
                            </tr>
                            <tr>
                                <td width="10px"><input type="checkbox" value='0' class='data-sending' id="status_validate_5" name="status_validate_5"></td>
                                <td> <input type='year' class='form-control data-sending focus-color' id='validate_5' name='validate_5' placeholder='Tahun pemasangan Produk Telkom' value='<?php if (isset($data)) echo $data->waktu_psb ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Tempat Pembayaran</td>
                            </tr>
                            <tr>
                                <td width="10px"><input type="checkbox" value='0' class='data-sending' name="status_validate_6" id="status_validate_6"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='validate_6' name='validate_6' placeholder='Tempat Pembayaran' value='<?php if (isset($data)) echo $data->payment ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Opsi Channel (Hp, Email, dsb)</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='opsi_call' name='opsi_call' placeholder='opsi_call'>
                                        <option value="0">Pilih</option>
                                        <option value="1">Telepon Rumah</option>
                                        <option value="2">Handphone</option>
                                        <option value="3">Email</option>
                                        <option value="4">Chat</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Kode Verifikasi</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='veri_system_qc' name='veri_system_qc' placeholder='Kode Verifikasi' value=''>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Keterangan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='keterangan_qc' name='keterangan_qc' placeholder='Keterangan' value=''>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Durasi</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='durasi_qc' name='durasi_qc' placeholder='Durasi' value=''>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 class="aht_qc">AHT > 3menit</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td>
                                    <!--<input type='text' class='form-control data-sending focus-color' id='aht_qc' name='aht_qc' placeholder='AHT > 3menit' value=''> -->
                                    <select class="form-control data-sending focus-color" id='aht_qc' name='aht_qc'>
                                        <option value="-">Pilih</option>
                                        <option value="Agent Melakukan Carring">Agent Melakukan Carring</option>
                                        <option value="Pelanggan Ragu - Ragu">Pelanggan Ragu - Ragu</option>
                                        <option value="Pelanggan Meminta Menunggu">Pelanggan Meminta Menunggu</option>
                                        <option value="Pertanyaan Agent berbelit - belit">Pertanyaan Agent berbelit - belit</option>
                                        <option value="Tidak Langsung bertemu DM">Tidak Langsung bertemu DM</option>
                                        <option value='Spelling'>Spelling</option>
                                        <option value='Keluhan Pelanggan'>Keluhan Pelanggan</option>
                                        <option value='Tanya Promo/Produk'>Tanya Promo/Produk</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Note</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <input type='text' class='form-control data-sending focus-color' id='note_qc' name='note_qc' placeholder='Note' value=''>
                                </td>
                            </tr>

                            <tr>
                                <td colspan='2'>
                                    <br>
                                    <div class='form-group'>
                                        <button id='btn-approve' type='button' class='btn btn-success btn-block'><i class='fe fe-check'></i> APPROVE</button>
                                    </div>

                                </td>

                            </tr>
                            <tr class="elem_not_approve">
                                <td colspan=2>Reason QA</td>
                            </tr>
                            <tr class="elem_not_approve">
                                <td width="1%"></td>
                                <td>
                                    <select class="form-control data-sending focus-color elem_not_approve" id='reason_qa' name='reason_qa'>

                                        <option value="">Pilih Reason NOT APPROVE</option>
                                        <option value="DM Tidak Valid">DM Tidak Valid</option>
                                        <option value="HP salah">HP salah</option>
                                        <option value="Email salah">Email salah</option>
                                        <option value="Alamat salah">Alamat salah</option>
                                        <option value="Socmed salah">Socmed salah</option>
                                        <option value="Nama Pelanggan Salah">Nama Pelanggan Salah</option>
                                        <option value="Kecepatan Salah">Kecepatan Salah</option>
                                        <option value="Kode Verifikasi Handphone Salah">Kode Verifikasi Handphone Salah</option>
                                        <option value="Tagihan Salah">Tagihan Salah</option>
                                        <option value="Waktu bayar Salah">Waktu bayar Salah</option>
                                        <option value="Tidak bersedia">Tidak bersedia</option>
                                        <option value="Tidak tanya HP pelanggan">Tidak tanya HP pelanggan</option>
                                        <option value="Tidak tanya email">Tidak tanya email</option>
                                        <option value="Tidak tanya Alamat">Tidak tanya Alamat</option>
                                        <option value="Tidak tanya socmed">Tidak tanya socmed</option>
                                        <option value="Rekaman tidak ditemukan">Rekaman tidak ditemukan</option>
                                        <option value="Validate Form < 4">Validate Form < 4</option>
                                        <option value="Tidak minta kode verivikasi">Tidak minta kode verifikasi</option>
                                        <option value="Tidak speling Email">Tidak speling Email</option>
                                        <option value="No PSTN Tidak Sesuai">No PSTN Tidak Sesuai</option>
                                        <option value="Tidak Konfirmasi no PSTN">Tidak Konfirmasi no PSTN</option>
                                        <option value="Lainnya">Lainnya</option>


                                    </select>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <div class='form-group'>
                                        <button id='btn-not-approve' type='button' class='btn btn-danger btn-block notapprove'><i class='fe fe-x'></i> NOT APPROVE</button>
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <div class='form-group'>
                                        <input type='hidden' id="status_approve" name="status_approve" class="data-sending">
                                        <input type='hidden' id="agentid" name="agentid" class="data-sending" value="<?php echo $_GET['agentid'] ?>">
                                        <input type='hidden' id="lup" name="lup" class="data-sending" value="<?php echo $data->lup ?>">
                                        <button disabled='' id='btn-save' type='button' class='btn btn-primary btn-block'><i class="fe fe-save"></i> <?php echo $title->general->button_save ?></button>
                                    </div>

                                </td>

                            </tr>
                            <tr>

                                <td colspan='2'>
                                    <div class='form-group'>
                                        <a href='<?php echo base_url() . 'Qc/Qc/check_verified?start=' . $_GET['start'] . '&end=' . $_GET['end'] . '&agentid=' . $_GET['agentid'] ?>' id='btn-close' class='btn btn-warning btn-block'> Back</a>
                                    </div>

                                </td>
                            </tr>
                        </table>


                    </div>
                </div>

            </form>
        </div>
        <div class="tab-pane" id="multikontak" role="tabpanel" aria-labelledby="multikontak-tab">
            <form action="<?= base_url('Qc/Qc/create_score_action'); ?>" method="post" enctype="multipart/form-data">

                <div class="row">

                    <div class='col-md-6 col-xl-6'>
                        <table width="100%">

                            <tr>
                                <td colspan=2>Salam pembuka</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_1' name='skill_communication_1'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Salam Penutup</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_2' name='skill_communication_2'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Mengucapkan nama pelanggan minimal 3 kali (awal, tengah & akhir) selama percakapan.</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_3' name='skill_communication_3'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>Menyampaikan informasi/pertanyaan dengan jelas, lengkap dan sistematis (tidak berbelit-belit)</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_4' name='skill_communication_4'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Menggunakan bahasa Indonesia/inggris dengan baik & benar, serta sopan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_5' name='skill_communication_5'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Intonasi & artikulasi</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_6' name='skill_communication_6'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Memberikan perhatian kepada pelanggan secara aktif dan berempati</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_7' name='skill_communication_7'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Agent menanyakan kabar pelanggan/kondisi inet pelanggan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='skill_communication_8' name='skill_communication_8'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>
                                    <h3>Validation</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Alamat Pelanggan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_1' name='validation_1'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Kecepatan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_2' name='validation_2'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>Tagihan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_3' name='validation_3'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>Tahun Pemasangan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_4' name='validation_4'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Tempat Bayar</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_5' name='validation_5'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>Salah menyebutkan Nomer INET / PSTN pelanggan atau tidak konfirmasi nomer INET/PSTN pelanggan
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_6' name='validation_6'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Nama Pelanggan Salah
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_7' name='validation_7'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>Decision Maker
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_8' name='validation_8'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Verifikasi HP
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_9' name='validation_9'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>

                        </table>


                    </div>
                    <div class='col-md-6 col-xl-6'>
                        <table width="100%">


                            <tr>
                                <td colspan=2>Verifikasi Email
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_10' name='validation_10'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Kode Verifikasi
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='validation_11' name='validation_11'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    <h3>Documentation & Information</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Dapat memberikan informasi tujuan Profiling
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='documentation_1' name='documentation_1'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Melakukan dokumentasi pada aplikasi terkait
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='documentation_2' name='documentation_2'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Menanyakan opsi channel kepada pelanggan
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='documentation_3' name='documentation_3'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    <h3>AHT > 3menit</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Agent melakukan carring
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_1' name='aht_1'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Pelanggan Ragu - Ragu
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_2' name='aht_2'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Pelanggan meminta menunggu
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_3' name='aht_3'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Pertanyaan agent berbelit- belit
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_4' name='aht_4'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Tidak langsung bertemu DM
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_5' name='aht_5'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Spelling
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_6' name='aht_6'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Keluhan pelanggan
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_7' name='aht_7'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Tanya Promo/Produk
                                </td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <select class="form-control data-sending focus-color" id='aht_8' name='aht_8'>
                                        <option value="0">Tidak</option>
                                        <option value="1" selected>Ya</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>Keterangan</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <input type='text' class='form-control data-sending2 focus-color' id='keterangan' name='keterangan' placeholder='Keterangan'>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2>Note</td>
                            </tr>
                            <tr>
                                <td width="1%"></td>
                                <td> <input type='text' class='form-control data-sending2 focus-color' id='note' name='note' placeholder='Note'>
                                </td>
                            </tr>
                            <!-- <input type='hidden' id="total_skill_communication" name="total_skill_communication" class='form-control data-sending2 focus-color'>
                            <input type='hidden' id="total_validation" name="total_validation" class='form-control data-sending2 focus-color'>
                            <input type='hidden' id="total_documentation" name="total_documentation" class='form-control data-sending2 focus-color'>
                            <input type='hidden' id="end_score" name="end_score" class='form-control data-sending2 focus-color'> -->

                            <tr>
                                <td colspan='2'>
                                    <div class='form-group'>
                                        <br>
                                        <input type='hidden' id="agent_id" name="agent_id" class="data-sending2" value="<?php echo $_GET['agentid'] ?>">
                                        <input type='hidden' id="dial" name="dial" class="data-sending2" value='
                                            <?php if (isset($data)) $verket = $data->veri_keterangan;
                                            if ($verket === NULL) {
                                                echo $data->handphone;
                                            } else {
                                                echo $data->veri_keterangan;
                                            }
                                            ?>'>
                                        <input type='hidden' id="lup" name="lup" class="data-sending2" value="<?php echo $data->lup ?>">
                                        <input type='hidden' id="tgl_taping" name="tgl_taping" class="data-sending2" value="<?php echo $data->lup ?>">
                                        <input type='hidden' id="tgl_respon_limit" name="tgl_respon_limit" class="data-sending2" value="<?php echo $data->lup ?>">
                                        <button type="submit" id="submits" class="submit btn btn-primary btn-block"><span class="fe fe-save"></span> Submit</button>
                                    </div>

                                </td>

                            </tr>

                        </table>


                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
<?php echo card_close() ?>

<?php echo _js('selectize,datepicker') ?>

<script>
    var page_version = "1.0.8"
</script>

<script>
    var custom_select = $('.custom-select').selectize({});
    var custom_select_link = $('.custom-select-link');

    $(document).ready(function() {
        $("#aht_qc").show();
        $(".aht_qc").show();
        $(".elem_not_approve").hide();

        <?php
        /*
	|--------------------------------------------------------------
	| CARA MEMBUAT COMBOBOX LINK
	|--------------------------------------------------------------
	| COMBOBOX LINK adalah proses membuat sebuah combobox menjadi 
	| referensi combobox lainnya dalam menampilkan data.
	| misal :
	|  combobox grup menjadi referensi combobox subgrup.
	|  perubahan/pemilihan data combobox grup menyebabkan 
	|  perubahan data combobox subgrup. 
	|--------------------------------------------------------------
	| cara :
	|  - isi "field_link" pada combobox target 
	| 	 'field_link'	=>'nama_field_join_database'.
	|  - gunakan class "custom-select-link" pada kedua combobox ,
	|	 referensi dan target.
	|  - tambahkan script :
	|     linkToSelectize('id_cmb_referensi','id_cmb_target');
	|--------------------------------------------------------------
	| note :
	|   - struktur database harus menggunakan field id sebagai primary key
	|   - combobox harus di buat dengan php code
	|	-  "create_cmb_database" untuk row < 1000
	|	-  dan linkToSelectize untuk row < 1000
	|
	|	-  "create_cmb_database_bigdata" untuk row > 1000
	|	-  dan linkToSelectize_Big untuk row > 1000
	|   - 
	|   - class harus menggunakan "custom-select-link"
	|
	*/
        ?>
    })


    $('.data-sending').keydown(function(e) {
        remove_message();
        switch (e.which) {
            case 13:
                apply();
                return false;
        }
    });
</script>
<script>
    $("#durasi_qc").on("keyup", function() {
        if ($(this).val() >= 3)
            $("#aht_qc").show();
        $(".aht_qc").show();
    });
</script>
<script>
    $('.input-simple-date').datepicker({
        autoclose: true,
        format: 'dd.mm.yyyy',
    })
    $('#btn-apply').click(function() {
        apply();
        play_sound_apply();
    });
    $('#btn-approve').click(function() {
        apply();
        play_sound_apply();
        $("#status_approve").val(1);
        $('#btn-not-approve').attr('disabled', true);
        $("#reason_qa").val("");
        $(".elem_not_approve").hide();
    });
    $("#reason_qa").change(function() {
        apply();
        play_sound_apply();
    });
    $('#btn-not-approve').click(function() {
        // apply();
        play_sound_apply();
        $("#status_approve").val(0);
        $('#btn-approve').attr('disabled', true);
        $(".elem_not_approve").show();
    });
    $("#skill_communication_1").change(function() {
        if ($('#skill_communication_1').is(":checked")) {
            $("#skill_communication_1").val(1);
        } else {
            $("#skill_communication_1").val(0);
        }
    });
    $("#skill_communication_2").change(function() {
        if ($('#skill_communication_2').is(":checked")) {
            $("#skill_communication_2").val(1);
        } else {
            $("#skill_communication_2").val(0);
        }
    });
    $("#status_validate_3").change(function() {
        if ($('#status_validate_3').is(":checked")) {
            $("#status_validate_3").val(1);
        } else {
            $("#status_validate_3").val(0);
        }
    });
    $("#status_validate_4").change(function() {
        if ($('#status_validate_4').is(":checked")) {
            $("#status_validate_4").val(1);
        } else {
            $("#status_validate_4").val(0);
        }
    });
    $("#status_validate_5").change(function() {
        if ($('#status_validate_5').is(":checked")) {
            $("#status_validate_5").val(1);
        } else {
            $("#status_validate_5").val(0);
        }
    });
    $("#status_validate_6").change(function() {
        if ($('#status_validate_6').is(":checked")) {
            $("#status_validate_6").val(1);
        } else {
            $("#status_validate_6").val(0);
        }
    });
    $('#btn-close').click(function() {
        play_sound_apply();
    });

    $('#btn-cancel').click(function() {
        cancel();
        play_sound_apply();
    });

    $('#btn-save').click(function() {
        simpan();
    })

    function apply() {
        $.each(custom_select, function(key, val) {
            val.selectize.disable();
        });

        <?php
        // NOTE : FOR DISABLE CUSTOM-SELECT-LINK 
        ?>
        // $.each(custom_select_link,function(key,val){
        // 		val.selectize.disable();
        // });

        $('.form-control').attr('disabled', true);
        $('#btn-apply').attr('disabled', true);
        $('#btn-cancel').attr('disabled', false);
        $('#btn-save').attr('disabled', false);
        $('#btn-save').focus();
    }

    function cancel() {
        $.each(custom_select, function(key, val) {
            val.selectize.enable();
        });
        <?php
        // NOTE : FOR ENABLE CUSTOM-SELECT-LINK  
        ?>
        // $.each(custom_select_link,function(key,val){
        // 		val.selectize.enable();
        // });

        $('.form-control').attr('disabled', false);
        $('#btn-cancel').attr('disabled', true);
        $('#btn-save').attr('disabled', true);
        $('#btn-apply').attr('disabled', false);

    }


    function simpan() {
        <?php
        /* mengambil data yang akan di kirim dari form-a */
        /* dalam bentuk array json tanpa penutup.. */
        /* memungkinkan penambahan data dengan cara push */
        /* ex. data.push */
        ?>
        var data = get_dataSending('form-a');

        <?php
        /* complite json format */
        /* ybs_dataSending(array); */
        ?>
        send_data = ybs_dataSending(data);

        var a = new ybsRequest();
        a.process('<?php echo $link_save ?>', send_data, 'POST');
        a.onAfterSuccess = function() {
            // cancel();
            window.location.href = '<?php echo base_url() . "Qc/Qc" ?>';
        }
        a.onBeforeFailed = function() {
            cancel();
        }
    }
</script>