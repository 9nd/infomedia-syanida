<?php echo _css('selectize,datepicker') ?>
<?php
if (isset($_GET['success'])) {
    if ($_GET['success'] == 1) {
        $color = "green";
        $icon = "check";
        $status = "Berhasil";
    } else {
        $color = "red";
        $icon = "cross";
        $status = "Gagal";
    }
?>
    <div class="col-lg-12 col-xs-12 blink_me_veri">
        <div class="small-box bg-<?php echo $color; ?>">
            <div class="inner">
                <p>Data TVV <?php echo $status; ?> Disubmit</p>
            </div>
            <div class="icon-counter">
                <i class="fa fa-<?php echo $icon; ?>-square-o"></i>
            </div>
        </div>
    </div>
<?php
}
?>
<?php echo card_open('Form', 'bg-green', true) ?>


<form method="POST" action="<?php echo $link_create; ?>">
    <div class='row'>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>NCLI</label>
                <input type="hidden" name='token_form' value='<?php echo $token_form;?>'>
                <input type='text' class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='<?php echo $title->general->desc_required ?>' value=''>
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
                <label class='form-label'>NO INTERNET</label>
                <input type='text' class='form-control data-sending focus-color' id='no_speedy' name='no_speedy' placeholder='<?php echo $title->general->desc_required ?>' value='' required>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>NO HANDPHONE</label>
                <input type='text' class='form-control data-sending focus-color' id='no_handphone' name='no_handphone' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>

        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>EMAIL</label>
                <input type='email' class='form-control data-sending focus-color' id='email' name='email' placeholder='<?php echo $title->general->desc_required ?>' value=''>
            </div>
        </div>

        <div class='col-md-12 col-xl-12'>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Submit</button>
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