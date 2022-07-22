<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form Quality control ', 'bg-green', true) ?>

<form id='form-a'>
    <div class="row">
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <input hidden type='text' readonly class='form-control data-sending focus-color' id='id_qc' name='id_qc' value='<?php if (isset($loginid)) echo $loginid->id_user; ?>'>
                <input hidden readonly type='text' readonly class='form-control data-sending focus-color' id='lup' name='lup' value='<?php if (isset($data)) echo $data->lup; ?>'>
                <label class='form-label'>Nama Agent </label>
                <input type='text' readonly class='form-control focus-color' id='nama_agent' name='nama_agent' placeholder='Nama Agent' value='<?php if (isset($agent)) echo $agent->nama ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Nama Pelanggan</label>
                <input type='text' readonly class='form-control focus-color' id='nama' name='nama' placeholder='nama' value='<?php if (isset($data)) echo $data->nama ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>Alamat Lengkap</label>
                <input type='text' readonly class='form-control focus-color' id='alamat' name='alamat' placeholder='alamat' value='<?php if (isset($data)) echo $data->alamat ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kecepatan</label>
                <input type='text' readonly class='form-control focus-color' id='kec_speedy' name='kec_speedy' placeholder='kec_speedy' value='<?php if (isset($data)) echo $data->kec_speedy ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tagihan</label>
                <input type='text' readonly class='form-control focus-color' id='billing' name='billing' placeholder='billing' value='<?php if (isset($data)) echo $data->billing ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tahun pemasangan Produk Telkom</label>
                <input type='text' readonly class='form-control focus-color' id='waktu_psb' name='waktu_psb' placeholder='waktu_psb' value='<?php if (isset($data)) echo $data->waktu_psb ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tempat Pembayaran</label>
                <input type='text' readonly class='form-control focus-color' id='payment' name='payment' placeholder='payment' value='<?php if (isset($data)) echo $data->payment ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kode Verifikasi</label>
                <input type='text' readonly class='form-control  focus-color' id='veri_system' name='veri_system' placeholder='veri_system' value='<?php if (isset($data)) echo $data->veri_system ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>NCLI</label>
                <input type='text' readonly class='form-control focus-color' id='ncli' name='ncli' placeholder='ncli' value='<?php if (isset($data)) echo $data->ncli ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>No.PSTN</label>
                <input type='text' readonly class='form-control focus-color' id='pstn1' name='pstn1' placeholder='pstn1' value='<?php if (isset($data)) echo $data->pstn1 ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>No.Internet</label>
                <input type='text' readonly class='form-control focus-color' id='no_speedy' name='no_speedy' placeholder='no_speedy' value='<?php if (isset($data)) echo $data->no_speedy ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Dial To</label>
                <input type='text' readonly class='form-control data-sending focus-color' id="dial_to" name="dial_to" value='<?php if (isset($data)) $verket = $data->veri_keterangan;
                                                                                                                                if ($verket === NULL) {
                                                                                                                                    echo $data->handphone;
                                                                                                                                } else {
                                                                                                                                    echo $data->veri_keterangan;
                                                                                                                                }
                                                                                                                                ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>No Handphone</label>
                <input type='text' readonly class='form-control focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Email</label>
                <input type='text' readonly class='form-control focus-color' id='email' name='email' placeholder='email' value='<?php if (isset($data)) echo $data->email ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>Opsi Channel (Hp, Email, dsb)</label>
                <input type='text' readonly class='form-control focus-color' value='<?php if (isset($data))

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
                                                                                    } ?>'> </div>

            <div class='form-group'>
                <label class='form-label'>Kode Verifikasi Email</label>
                <input type='text' readonly class='form-control focus-color' placeholder='verfi_email' value='<?php if (isset($data)) echo $data->verfi_email ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kode Verifikasi Password</label>
                <input type='text' readonly class='form-control focus-color' placeholder='verfi_handphone' value='<?php if (isset($data)) echo $data->verfi_handphone ?>'>
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
                <?php
                if ($qm_score_parameter['num']) {
                    foreach ($qm_score_parameter['results'] as $qm_param) {
                ?>
                        <tr>
                            <td width="90%"><input type='text' readonly class='form-control' placeholder='verfi_handphone' value='<?php echo $qm_param->keterangan; ?>'></td>
                            <td width="1%"><input type="checkbox" checked value='1' class='data-sending' id="qm_score_param_<?php echo $qm_param->id; ?>" name="qm_score_param_<?php echo $qm_param->id; ?>"></td>

                        </tr>
                        <tr style="display:none;" id='keterangan_label_<?php echo $qm_param->id; ?>'>
                            <td colspan=2><table width="100%"><tr><td align="right">Keterangan</td><td  style="display:none;" id='keterangan_form_<?php echo $qm_param->id; ?>'><input type='text' class='form-control data-sending focus-color' id="keterangan_<?php echo $qm_param->id; ?>" name="keterangan_<?php echo $qm_param->id; ?>" placeholder='Keterangan <?php echo $qm_param->keterangan; ?>' value=''></td></tr></table></td>
                        </tr>
                        
                <?php
                    }
                }
                ?>





                <tr>
                    <td colspan='2'>
                        <div class='form-group'>
                            <input type='hidden' id="idx" name="idx" class="data-sending" value="<?php echo $data->idx ?>">
                            <input type='hidden' id="agentid" name="agentid" class="data-sending" value="<?php echo $data->veri_upd ?>">
                            <input type='hidden' id="lup" name="lup" class="data-sending" value="<?php echo $data->lup ?>">
                            <button id='btn-apply' type='button' class='btn btn-primary'><i class='fe fe-check'></i> <?php echo $title->general->button_apply ?></button>
                            <button disabled='' id='btn-save' type='button' class='btn btn-primary'><i class="fe fe-save"></i> <?php echo $title->general->button_save ?></button>
                            <button disabled='' id='btn-cancel' type='button' class='btn btn-primary'> <?php echo $title->general->button_cancel ?></button>
                            <a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>

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
    <?php
    if ($qm_score_parameter['num']) {
        foreach ($qm_score_parameter['results'] as $qm_param) {
    ?>
            $("#qm_score_param_<?php echo $qm_param->id; ?>").change(function() {
                if ($('#qm_score_param_<?php echo $qm_param->id; ?>').is(":checked")) {
                    $("#qm_score_param_<?php echo $qm_param->id; ?>").val(1);
                    $("#keterangan_<?php echo $qm_param->id; ?>").val("");
                    $("#keterangan_label_<?php echo $qm_param->id; ?>").hide();
                    $("#keterangan_form_<?php echo $qm_param->id; ?>").hide();
                } else {
                    $("#qm_score_param_<?php echo $qm_param->id; ?>").val(0);
                    $("#keterangan_label_<?php echo $qm_param->id; ?>").show();
                    $("#keterangan_form_<?php echo $qm_param->id; ?>").show();

                }
            });

    <?php
        }
    }
    ?>

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
            alert('Data berhasil ditambahkan');
            window.top.close();
        }
        a.onBeforeFailed = function() {
            cancel();
        }
    }
</script>