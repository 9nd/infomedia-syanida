<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Lihat Temuan', 'bg-green', true) ?>


<div class="row">
    <div class='col-md-6 col-xl-6'>
        <div class='form-group'>

            <input hidden type='text' readonly class='form-control data-sending focus-color' id='id_qc' name='id_qc' value='<?php if (isset($loginid)) echo $loginid->id_user; ?>'>
            <label class='form-label'>Nama Agent</label>
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
            <input type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
        </div>
        <div class='form-group'>
            <label class='form-label'>No Handphone</label>
            <input type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
        </div>
        <div class='form-group'>
            <label class='form-label'>Email</label>
            <input type='text' readonly class='form-control data-sending focus-color' id='email' name='email' placeholder='email' value='<?php if (isset($data)) echo $data->email ?>'>
        </div>

        <div class='form-group'>
            <label class='form-label'>Opsi Channel (Hp, Email, dsb)</label>
            <input type='text' readonly class='form-control data-sending focus-color' value='<?php if (isset($data))

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
    </div>
    <div class='col-md-6 col-xl-6' style="background-color:#f5f7fb;">
        <table width="100%">
            <tr>
                <td colspan=2>Nama Pelanggan</td>
            </tr>
            <tr>
                <td width="10px"><input readonly type="checkbox" <?php echo ($data_qc->status_validate_1 == 1) ? "value='1' checked" : "value='0'"; ?> class='data-sending' id="status_validate_1" name="status_validate_1"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_1' name='validate_1' placeholder='Nama Pelanggan' value='<?php if (isset($data_qc)) echo $data_qc->validate_1 ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Alamat</td>
            </tr>
            <tr>
                <td width="10px"><input type="checkbox" <?php echo ($data_qc->status_validate_2 == 1) ? "value='1' checked" : "value='0'"; ?> class='data-sending' name="status_validate_2" id="status_validate_2"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_2' name='validate_2' placeholder='Alamat' value='<?php if (isset($data_qc)) echo $data_qc->validate_2 ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Kecepatan</td>
            </tr>
            <tr>
                <td width="10px"><input type="checkbox" <?php echo ($data_qc->status_validate_3 == 1) ? "value='1' checked" : "value='0'"; ?> class='data-sending' name="status_validate_3" id="status_validate_3"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_3' name='validate_3' placeholder='Kecepatan' value='<?php if (isset($data_qc)) echo $data_qc->validate_3 ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Tagihan</td>
            </tr>
            <tr>
                <td width="10px"><input type="checkbox" <?php echo ($data_qc->status_validate_4 == 1) ? "value='1' checked" : "value='0'"; ?> class='data-sending' name="status_validate_4" id="status_validate_4"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_4' name='validate_4' placeholder='Tagihan' value='<?php if (isset($data_qc)) echo $data_qc->validate_4 ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Tahun pemasangan Produk Telkom</td>
            </tr>
            <tr>
                <td width="10px"><input type="checkbox" <?php echo ($data_qc->status_validate_5 == 1) ? "value='1' checked" : "value='0'"; ?> class='data-sending' id="status_validate_5" name="status_validate_5"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_5' name='validate_5' placeholder='Tahun pemasangan Produk Telkom' value='<?php if (isset($data_qc)) echo $data_qc->validate_5 ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Tempat Pembayaran</td>
            </tr>
            <tr>
                <td width="10px"><input type="checkbox" <?php echo ($data_qc->status_validate_6 == 1) ? "value='1' checked" : "value='0'"; ?> class='data-sending' name="status_validate_6" id="status_validate_6"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='validate_6' name='validate_6' placeholder='Tempat Pembayaran' value='<?php if (isset($data_qc)) echo $data_qc->validate_6 ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Opsi Channel (Hp, Email, dsb)</td>
            </tr>
            <tr>
                <td width="1%"></td>
                <td> <input readonly type="text" class="form-control data-sending focus-color" id='opsi_call' name='opsi_call' placeholder='opsi_call' value='<?php if (isset($data))

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
                <td width="1%"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='veri_system_qc' name='veri_system_qc' placeholder='Kode Verifikasi' value='<?php if (isset($data_qc)) echo $data_qc->veri_system_qc ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Keterangan</td>
            </tr>
            <tr>
                <td width="1%"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='keterangan_qc' name='keterangan_qc' placeholder='Keterangan' value='<?php if (isset($data_qc)) echo $data_qc->keterangan_qc ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2>Durasi</td>
            </tr>
            <tr>
                <td width="1%"></td>
                <td> <input readonly type='text' class='form-control data-sending focus-color' id='durasi_qc' name='durasi_qc' placeholder='Durasi' value='<?php if (isset($data_qc)) echo $data_qc->durasi_qc ?>'>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="aht_qc">AHT > 3menit</td>
            </tr>
            <tr>
                <td width="1%"></td>
                <!--  <td> <input type='text' class='form-control data-sending focus-color' id='aht_qc' name='aht_qc' placeholder='AHT > 3menit' value='<?php if (isset($data_qc)) echo $data_qc->aht_qc ?>'>
                    </td> -->
                <td>
                    <!--<input type='text' class='form-control data-sending focus-color' id='aht_qc' name='aht_qc' placeholder='AHT > 3menit' value=''> -->
                    <input  readonly type="text" class="form-control data-sending focus-color" id='aht_qc' name='aht_qc' value='<?php if (isset($data_qc)) echo $data_qc->aht_qc ?>'>
                       
                </td>
            </tr>
            <tr>
                <td colspan=2>Note</td>
            </tr>
            <tr>
                <td width="1%"></td>
                <td> <input  readonly type='text' class='form-control data-sending focus-color' id='note_qc' name='note_qc' placeholder='Note' value='<?php if (isset($data_qc)) echo $data_qc->note_qc ?>'>
                </td>
            </tr>


            <tr id="hidereason" class="elem_not_approve" <?php echo ($data_qc->status_approve == 1) ? "style='display:none;'" : ""; ?>>
                <td colspan=2>Reason QA</td>
            </tr>
            <tr id="hidereason" class="elem_not_approve" <?php echo ($data_qc->status_approve == 1) ? "style='display:none;'" : ""; ?>>
                <td width="1%"></td>
                <td>
                    <!--<input type='text' class='form-control data-sending focus-color' id='reason_qa' name='reason_qa' placeholder='Reason QA' value='<?php if (isset($data_qc)) echo $data_qc->reason_qa ?>'> -->
                    <input  readonly type="text" class="form-control data-sending focus-color" id='reason_qa' value='<?php if (isset($data_qc)) echo $data_qc->reason_qa ?>'>
                      
                    <br>
                </td>
            </tr>

            <tr>
                <td colspan='2'>
                    <div class='form-group'>
                        <input type='hidden' id="status_approve" name="status_approve" value="<?php if (isset($data_qc)) echo $data_qc->status_approve ?>" class="data-sending">
                        <input type='hidden' id="agentid" name="agentid" class="data-sending" value="<?php echo $data->veri_upd ?>">
                        <input type='hidden' id="lup" name="lup" class="data-sending" value="<?php echo $data->lup ?>">
                        <input type='hidden' id="id" name="id" class="data-sending" value="<?php echo $data_qc->id ?>">

                    </div>

                </td>

            </tr>
            <tr>

                <td colspan='2'>
                    <div class='form-group'>
                        <a href='<?php echo base_url() ?>Home' id='btn-close' class='btn btn-warning btn-block'> Back</a>
                    </div>

                </td>
            </tr>
        </table>

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
    $('#btn-not-approve').click(function() {
        apply();
        play_sound_apply();
        $("#status_approve").val(0);
        $('#btn-approve').attr('disabled', true);
        $(".elem_not_approve").show();
    });
    $("#status_validate_1").change(function() {
        if ($('#status_validate_1').is(":checked")) {
            $("#status_validate_1").val(1);
        } else {
            $("#status_validate_1").val(0);
        }
    });
    $("#status_validate_2").change(function() {
        if ($('#status_validate_2').is(":checked")) {
            $("#status_validate_2").val(1);
        } else {
            $("#status_validate_2").val(0);
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
        $('#reason_qa').attr('disabled', false);
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