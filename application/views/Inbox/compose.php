<?php echo _css("selectize,multiselect,datepicker") ?>
<?php echo card_open('Form', 'bg-green', true) ?>

<form id='form-a'>
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <h3 class="mb-4">MESSAGE</h3>

            <div>
                <div class="list-group list-group-transparent mb-0">
				<a href="<?php echo $link_inbox; ?>" class="list-group-item list-group-item-action d-flex align-items-center active">
                    <span class="icon mr-3"></span>Inbox <span class="ml-auto badge bg-blue"><div  id="get_inbox">0</div></span>
                </a>
                <!-- <a href="<?php echo $link_compose; ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Sent Mail
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Important <span class="ml-auto badge bg-gray">3</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Starred
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Drafts
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Tags
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"></span>Trash
                </a> -->
            </div>

            <div class="mt-4">
                <a href="<?php echo $link_compose; ?>" class="btn btn-secondary btn-block">Compose new Message</a>
            </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Compose new message</h3>
                </div>

                <div class="card-body">

                    <form action="">
                        <div class="mb-2">
                            <div class="row align-items-center">
                                <label class="col-sm-2">To:</label>
                                <div class="col-sm-10">
                                    <select name='agentid' id="agentid" class="form-control data-sending custom-select" >

                                        <?php
                                        if ($user_categori != 8) {
                                        ?>
                                            <option value="1">--Semua--</option>
                                            <option value="2">--Semua Agent--</option>
                                            <option value="3">--Semua TL--</option>
                                            <option value="4">--Semua Administrator--</option>
                                            <option value="5">--SPV--</option>
                                        <?php
                                        }
                                        if ($list_agent_d['num'] > 0) {
                                            foreach ($list_agent_d['results'] as $list_agent) {
                                                $selected = "";
                                                if (isset($_GET['agentid'])) {

                                                    if (count($_GET['agentid']) > 1) {

                                                        foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
                                                            if ($v_agentid == $list_agent->agentid) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    } else {
                                                        $selected = ($list_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
                                                    }
                                                }
                                                echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . "-" . $list_agent->nama . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="row align-items-center">
                                <label class="col-sm-2">Subject:</label>
                                <div class="col-sm-10">
                                    <input type="text" id='subject' required name='subject' class="form-control data-sending ">
                                </div>
                            </div>
                        </div>

                        <textarea rows="10" id='conten' name='conten' class="form-control data-sending "></textarea>

                        <div class="btn-list mt-4 text-right">
                            <button id='btn-apply' type='button' class='btn btn-primary'><i class='fe fe-check'></i> Apply</button>
                            <button disabled='' id='btn-save' type='button' class='btn btn-primary'><i class="fe fe-save"></i> Sent</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</form>
<?php echo card_close() ?>

<?php echo _js("ybs,selectize,multiselect,datepicker") ?>
<script type="text/javascript">
    // $('#agentid').selectize({});
    // $('#agentid').multiselect();

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
		$.each(custom_select_link,function(key,val){
				val.selectize.disable();
		});

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
		$.each(custom_select_link,function(key,val){
				val.selectize.enable();
		});

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
			cancel();
		}
		a.onBeforeFailed = function() {
			cancel();
		}
	}
</script>
<script type="text/javascript">
    function get_inbox() {
        $.ajax({
            url: "<?php echo base_url() . "Inbox/Inbox/get_inbox" ?>",
            methode: "get",
            dataType: 'JSON',
            success: function(response) {
                $("#get_inbox").text(response.get_inbox);

            }
        });
    } 


    setInterval(function () { }, 300000);
    setInterval(function () {
        get_inbox();
    }, 5000);


    

    $(document).ready(function() {
        get_inbox();

    });
</script>