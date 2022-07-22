<?php echo _css('selectize') ?>

<div class="col-md-12 col-xl-12">
	<?php echo card_open('<i class="fe fe-list"> </i> ', 'bg-red', true) ?>
	<form id="form-a">
		<input hidden class="data-sending" id="id" value="<?php echo $id ?>">

		<div class="form-group">
			<label class="form-label">Nama Lengkap</label>
			<input type="text" class="form-control data-sending focus-color" id="input-nama" name='nama' placeholder="Nama Lengkap" value="<?php echo $nama; ?>">
		</div>
		<div class="form-group">
			<label class="form-label">Agent ID</label>
			<input type="text" class="form-control data-sending focus-color" id="input-agentid" name='agentid' placeholder="AGENTID" value="<?php echo $agentid; ?>">
		</div>
		<div class="form-group">
			<label class="form-label">Team Leader</label>
			<input type="text" class="form-control data-sending focus-color" id="input-tl" name='tl' placeholder="Team Leader" value="<?php echo $tl; ?>">
		</div>
		<div class="form-group">
			<label class="form-label">Kategori</label>
			<input type="text" class="form-control data-sending focus-color" id="input-kategori" name='kategori' placeholder="Kategori" value="<?php echo $kategori; ?>">
		</div>
		<div class="form-group">
			<label class="form-label">Nama Pengguna</label>
			<input type="text" class="form-control data-sending focus-color" id="input-nama-user" name='nmuser' placeholder="Nama pengguna" value="<?php echo $nmuser; ?>">
		</div>


		<div class="form-group">
			<label class="form-label">Password</label>
			<input type="password" class="form-control data-sending focus-color" id="input-pass-user" name='passuser' placeholder="Password" value="">
		</div>

		<div class="form-group">
			<label class="form-label">Konfirm Password</label>
			<input type="password" class="form-control focus-color" id="input-repass-user" placeholder="Password" value="">
		</div>


		<div class="form-group">
			<label class="form-label">Level</label>
			<select id="select-level-user" name='opt_level' class="form-control data-sending custom-select focus-color">
				<?php foreach ($data_level as $val) {
					if ($val['id'] > 1) {
						echo '<option value="' . $val['id'] . '" >' . $val['nmlevel'] . '</option>';
					}
				}
				?>


			</select>
		</div>

		<div class="form-group">
			<label class="form-label">Status</label>
			<select id="select-status-user" name='opt_status' class="form-control data-sending custom-select focus-color">
				<option selected value="1">AKTIF</option>
				<option value="2">NON AKTIF</option>
			</select>
		</div>

		<div class="form-group">
			<div class="form-label">Upload Foto</div>
			<div class="custom-file">
				<input type="file" class="custom-file-input " id="inputfile" name="inputfile">
				<label class="custom-file-label form-control">Choose file</label>
			</div>
		</div>

		<br>
		<br>
		<br>
		<br>
		<div class="text-center">
			<div id="img-container">
				<img style="cursor:pointer; width:150px; max-width:150px; max-height:150px;" class="card-profile-img profile-user-img ybs-image-slider data-sending" name="picture" data-image="<?php echo $nmuser ?>" src="<?php echo base_url('YbsService/get_default_picture_profile/' . $this->_token); ?>" id="img-detail">

			</div>
			<h3 class="mb-1"><?php echo $nmpicture ?></h3>
			<p class="mb-1">
				<?php echo $nmlevel ?>
			</p>
		</div>






		<br>
		<br>

		<div class="form-group">
			<button id="btn-apply" type="button" class="btn btn-primary"><i class="fe fe-check"></i> Setuju</button>
			<button disabled id="btn-save" type="button" class="btn btn-primary"><i class="fe fe-save"></i> Simpan</button>
			<button disabled id="btn-cancel" type="button" class="btn btn-primary">Batal</button>
			<a href="<?php echo $link_back ?>" id="btn-close" class="btn btn-primary">Tutup</a>
		</div>
	</form>



	<br>
	<br>
	<br>
	<br>
	<br>

	<?php echo card_close() ?>
</div>
<?php echo _js('selectize') ?>
<script>
	$(document).ready(function() {
		$('#inputfile').change(function() {
			prepare_picture();
		});
		$('.profile-user-img').val('default.png');
	});

	$('#select-status-user').ready(function() {
		$('#select-status-user').val("<?php echo $selected_status ?>");
		$('#select-status-user').change();
	});

	$('#select-level-user').ready(function() {
		var a = "<?php echo $selected_level ?>";
		if (a !== "") {
			$('#select-level-user').val("<?php echo $selected_level ?>");
			$('#select-level-user').change();
		}

	});



	$('.data-sending , #input-repass-user').keydown(function(e) {
		switch (e.which) {
			case 13:
				$('#btn-apply').click();
				return false;
		}
	})




	$('#btn-apply').click(function() {

		if ($('#input-nama-user').val() == "" || $('#input-nama-user').val() == null) {
			show_error_message('Nama pengguna tidak boleh kosong !');
			play_sound_failed();
			$('#input-nama-user').focus();
			return false;
		}
		if ($('#input-pass-user').val() == "" || $('#input-pass-user').val() == null) {
			show_error_message('Password tidak boleh kosong !');
			play_sound_failed();
			$('#input-pass-user').focus();
			return false;
		}

		if ($('#input-repass-user').val() == "" || $('#input-repass-user').val() == null) {
			show_error_message('Tulis ulang password anda !');
			play_sound_failed();
			$('#input-repass-user').focus();
			return false;
		}

		if ($('#input-pass-user').val() !== $('#input-repass-user').val()) {
			show_error_message('Password tidak sama!');
			play_sound_failed();
			$('#input-repass-user').focus();
			return false;
		}

		if ($('#select-level-user').val() == "" || $('#select-level-user').val() == null) {
			show_error_message('Level belum di pilih !!');
			play_sound_failed();
			$('#select-level-user').focus();
			return false;
		}


		apply();
		play_sound_apply();
		remove_message();

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
		$('#inputfile').attr('disabled', true);
		$('.form-control').attr('disabled', true);
		$('#btn-apply').attr('disabled', true);
		$('#btn-cancel').attr('disabled', false);
		$('#btn-save').attr('disabled', false);
		$('#btn-save').focus();

	}

	function cancel() {
		$('#inputfile').attr('disabled', false);
		$('.form-control').attr('disabled', false);
		$('#btn-cancel').attr('disabled', true);
		$('#btn-save').attr('disabled', true);
		$('#btn-apply').attr('disabled', false);



	}

	function simpan() {
		send_data = ybs_dataSending(get_dataSending('form-a'));

		var a = new ybsRequest();
		a.process("<?php echo $link_save ?>", send_data, 'POST');
		a.onAfterSuccess = function() {
			cancel();
			$('#input-nama').val("");
			$('#input-agentid').val("");
			$('#input-kategori').val("");
			$('#input-nama-user').val("");
			$('#input-pass-user').val("");
			$('#input-repass-user').val("");
			$('.custom-file-label').text('Choose file');
			$('.profile-user-img').val('default.png');
			$('.profile-user-img').attr('src', "<?php echo base_url('YbsService/get_default_picture_profile/' . $this->_token); ?>");

		}
		a.onFailed = function(data) {
			cancel();
			show_error_message(data.message);
			$(data.elementid).focus();
		}
	}
</script>


<script>
	function prepare_picture() {


		var form_el = $('#form-a')[0];

		var form_data = new FormData(form_el);
		form_data.append("<?php echo $this->security->get_csrf_token_name() ?>", get_sec_val());

		$.ajax({
			type: 'POST',
			enctype: 'multipart/form-data',
			url: "<?php echo $link_prepare_picture ?>",
			data: form_data,

			processData: false,
			contentType: false,
			cache: false,

			success: function(data) {
				var a = JSON.parse(data);
				sec_val = a.sec_val;
				var b = sec_val.split("=");
				var c = b[1].replace("&", "");
				$("#sec").val(c);

				if (a.success !== "false") {
					var img_new = " <?php echo base_url() ?>" + a.message;
					$('.profile-user-img').attr('src', img_new);
					$('.profile-user-img').val(a.message);
					$('.custom-file-label').text(a.original_name);

				} else {
					show_error_message(a.message);
					play_sound_failed();
					$('.custom-file-label').text('Choose file');
					$('.profile-user-img').val('default.png');
					$('.profile-user-img').attr('src', "<?php echo base_url('YbsService/get_default_picture_profile/' . $this->_token); ?>");

				}



			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {

			},

		});

	}
</script>