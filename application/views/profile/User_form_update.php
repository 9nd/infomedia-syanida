<?php echo _css('selectize') ?>
<div class="col-md-12 col-xl-12">
	<?php echo card_open('<i class="fe fe-list"> </i> ', 'bg-red', true) ?>
	<form id="form-a">
		<input hidden class="data-sending" id="id" value="<?php echo $id ?>">
		<div class="form-group">
			<label class="form-label">Nama Lengkap</label>
			<input type="text" readonly class="form-control data-sending focus-color" id="input-nama" name='nama' placeholder="Nama Lengkap" value="<?php echo $nama; ?>">
		</div>
		<div class="form-group">
			<label class="form-label">Agent ID</label>
			<input type="text" readonly class="form-control data-sending focus-color" id="input-agentid" name='agentid' placeholder="Agent ID" value="<?php echo $agentid; ?>">
		</div>
		<div class="form-group">
			<label class="form-label">Nama Pengguna</label>
			<input type="text" readonly class="form-control data-sending focus-color" id="input-nama-user" name='nmuser' placeholder="Nama pengguna" value="<?php echo $nmuser; ?>">
		</div>

		<div class="form-group">
			<div class="form-label">Upload Foto</div>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="inputfile" name="inputfile">
				<label class="custom-file-label">Choose file</label>
			</div>
		</div>

		<br>
		<br>
		<br>
		<br>
		<div class="text-center">
			<div id="img-container">
				<img style="cursor:pointer; width:150px; max-width:150px; max-height:150px;" class="card-profile-img profile-user-img ybs-image-slider data-sending" name="picture" data-image="<?php echo $nmuser ?>" src="<?php echo $picture ?>" id="img-detail">

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

	$('.data-sending').keydown(function(e) {
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
			return;
		}

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
		$('#inputfile').attr('disabled', true);
		$('#select-reset').attr('disabled', true);
		$('.form-control').attr('disabled', true);
		$('#btn-apply').attr('disabled', true);
		$('#btn-cancel').attr('disabled', false);
		$('#btn-save').attr('disabled', false);
		$('#btn-save').focus();

	}

	function cancel() {
		$('#inputfile').attr('disabled', false);
		$('#select-reset').attr('disabled', false);
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
		}
		a.onFailed = function(data) {
			cancel();
			$(data.elementid).focus();
			show_error_message(data.message);
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
					$('.profile-user-img').attr('src', "<?php echo $picture; ?>");

				}



			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {

			},

		});

	}
</script>