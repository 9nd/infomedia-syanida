<?php echo _css('selectize,datepicker') ?>
<?php
if (isset($_GET['success'])) {
?>
    <div class="col-lg-12 col-xs-12 blink_me_veri">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="verified"><?php echo number_format($_GET['dibagi']); ?></h3>
                <p>Jumlah Data Yang Dibagikan</p>
            </div>
            <div class="icon-counter">
                <i class="fa fa-check-square-o"></i>
            </div>
        </div>
    </div>
<?php
}
?>
<?php echo card_open('Form', 'bg-green', true) ?>


<form method="POST" action="<?php echo $link_filter; ?>">
    <div class='row'>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>SUMBER</label>
                <select id="sumber" name="sumber" class="form-control">
                    <?php
                    if (isset($sumbernya)) {
                        echo "<option value='$sumbernya' selected>$sumbernya</option>";
                    }
                    ?>
                    <option value="semua">Semua Sumber</option>
                    <option value="MYCX">MYCX</option>
                    <option value="UPLOAD">UPLOAD</option>
                    <option value="DBPROFILE">DBPROFILE</option>
                    <option value="MYCX-147">MYCX-147</option>
                    <option value="MYCX-PLASA">MYCX-PLASA</option>
                    <option value="MYCX-SOCMED">MYCX-SOCMED</option>
                    <option value="MYCX-OTHERS">MYCX-OTHERS</option>
                    <option value="CONSENT_UPLOAD">CONSENT_UPLOAD</option>
                    <option value="IRMA">IRMA</option>        


                </select>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4 col-xl-4'>
            <div class='form-group'>
                <label class='form-label'>LENGTH NCLI</label>
                <input type='number' class='form-control data-sending focus-color' id='length_ncli' name='length_ncli' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>
        <div class='col-md-4 col-xl-4'>
            <div class='form-group'>
                <label class='form-label'>Operator NCLI</label>
                <select id="operator_ncli" name="operator_ncli" class="form-control">
                    <option value="LIKE">LIKE</option>
                    <option value="NOT LIKE">NOT LIKE</option>
                </select>
            </div>
        </div>
        <div class='col-md-4 col-xl-4'>
            <div class='form-group'>
                <label class='form-label'>NCLI</label>
                <input type='text' class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>Operator NO PSTN</label>
                <select id="operator_no_pstn" name="operator_no_pstn" class="form-control">
                    <option value="LIKE">LIKE</option>
                    <option value="NOT LIKE">NOT LIKE</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>NO PSTN</label>
                <input type='text' class='form-control data-sending focus-color' id='no_pstn' name='no_pstn' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>Operator NO INTERNET</label>
                <select id="operator_no_speedy" name="operator_no_speedy" class="form-control">
                    <option value="LIKE">LIKE</option>
                    <option value="NOT LIKE">NOT LIKE</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>NO INTERNET</label>
                <input type='text' class='form-control data-sending focus-color' id='no_speedy' name='no_speedy' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>FILTER HANDPHONE</label>
                <select id="no_handpone" name="no_handpone" class="form-control">
                    <option value="semua">Tidak Difilter</option>
                    <option value="LIKE">Filter LIKE</option>
                    <option value="NOT LIKE">Filter NOT LIKE</option>
                    <option value="IS NULL">IS NULL</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>NO.HANDPHONE</label>
                <input type='text' class='form-control data-sending focus-color' id='no_handpone_filter' name='no_handpone_filter' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>
        <div class='col-md-12 col-xl-12'>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Check</button>
                <a href='<?php echo $link_duplicate ?>' id='btn-close' class='btn btn-danger'>Check NCLI Duplicate</a>
                <a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>
            </div>

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
    $('.input-simple-date').datepicker({
        autoclose: true,
        format: 'dd.mm.yyyy',
    })

    $('#btn-apply').click(function() {
        apply();
        play_sound_apply();
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
</script>