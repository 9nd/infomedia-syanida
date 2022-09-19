<?php echo _css("selectize,multiselect,datatables") ?>
<?php echo card_open('Form Tambah', 'bg-green', true) ?>

<form id='form-a'>
	<div class='form-group'>
		<label class='form-label'>Tanggal Pembinaan</label>
		<input type='date' class='form-control data-sending focus-color' id='tanggal' name='tanggal'>
	</div>
	<div class='form-group'>
		<label class='form-label'>Nama Agent</label>
		<select name='agentid' id="agentid" class="form-control custom-select">

			<?php
			if ($user_categori != 8) {
			?>
				<option value="0">--Semua Agent--</option>
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
					echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . " | " . $list_agent->nama . "</option>";
				}
			}
			?>

		</select>
	</div>

	<div class='form-group'>
		<label class='form-label'>Permasalahan</label>
		<form>
			<table class="timecard display nowrap" width="100%">

				<tr>
					<td colspan="6">&nbsp;</td>
				<tr>

				<tr>
					<td width="20%">Tgl</td>
					<td>Detail Not Approvve</td>
					<td></td>
				<tr>

				</tr>
				<tr>


					<td><input type="date" name="tanggalk" id="tanggalk" class="form-control data-sending" value=""></td>
					<td><textarea name="detail_not_approve" id="detail_not_approve" class="form-control data-sending"></textarea></td>
					<td>
						<button type="button" name="insertk" id="save" class="btn btn-info"><span class="fe fe-plus-circle"></span></button>
						<div>
					</td>
				</tr>
			</table>
			<div id='datakasus'>

			</div>
			<div class='form-group'>
				<label class='form-label'>Jenis Pembinaan</label>
				<select class='form-control data-sending focus-color col-2' id='tingkat_pembinaan' name='tingkat_pembinaan'>
					<option value="1">Coaching 1</option>
					<option value="2">Coaching 2</option>
					<option value="3">Coaching 3</option>
				</select>
			</div>
			<div class='form-group'>
				<label class='form-label'>Penyuluhan</label>
				<textarea class='form-control data-sending focus-color col-6' id='penyuluhan' name='penyuluhan'></textarea>
			</div>
			<button type="button" class="btn btn-success update">Simpan</button>
		</form>
		<hr>


		<div id="formnya">

		</div>
	</div>


</form>


<?php echo card_close() ?>

<?php echo _js("selectize,multiselect,datatables") ?>
<script>
	var page_version = "1.0.8"
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".update").click(function() {
			var penyuluhan = $('#penyuluhan').val();
			var agentid = $('#agentid').val();
			var tanggal = $('#tanggal').val();
			var tingkat_pembinaan = $('#tingkat_pembinaan').val();
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/updatep" ?>",
				data: {
					agentid: agentid,
					tanggal: tanggal,
					penyuluhan: penyuluhan,
					tingkat_pembinaan: tingkat_pembinaan
				},
				success: function(data) {
					alert('berhasil update');
					ambil_form();
				}
			});

		});
	});
</script>
<script>
	$(document).ready(function() {
		$(".add-row").click(function() {
			var idtemuan = $("#idtemuan").val();
			var tanggalk = $("#tanggalk").val();
			var parameter = $("#parameter").val();
			var no_hp = $("#no_hp").val();
			var detail_not_approve = $("#detail_not_approve").val();
			var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + idtemuan + "</td><td>" + tanggalk + "</td><td>" + parameter + "</td><td>" + no_hp + "</td><td>" + detail_not_approve + "</td></tr>";
			$("#report_table_reg").append(markup);
		});

		// Find and remove selected table rows
		$(".delete-row").click(function() {
			$("table tbody").find('input[name="record"]').each(function() {
				if ($(this).is(":checked")) {
					$(this).parents("tr").remove();
				}
			});
		});
	});
</script>
<script>
	// var custom_select = $('.custom-select').selectize({});
	// var custom_select_link = $('.custom-select-link');
	$(document).ready(function() {
		$("#add").click(function() {
			var lastField = $("#buildyourform tr:last");
			var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
			var fieldWrapper = $("<tr class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
			fieldWrapper.data("idx", intId);
			var fName = $(
				"<td><input type=\"date\" id=\"tanggal" + intId +
				"\" name=\"tanggal" + intId +
				"\" class=\"fieldname form-control data-sending\" /></td><td><input type=\"text\" id=\"parameter" + intId +
				"\" name=\"parameter" + intId +
				"\" class=\"fieldname form-control data-sending\" /></td><td><input type=\"text\" id=\"nohp" + intId +
				"\" name=\"nohp" + intId +
				"\" class=\"fieldname form-control data-sending\" /></td><td><input type=\"text\" id=\"detail" + intId +
				"\" name=\"detail" + intId +
				"\" class=\"fieldname form-control data-sending\" /></td></tr>"
			);
			var fType = $(
				""
			);
			var removeButton = $(
				"<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
			);
			removeButton.click(function() {
				$(this).parent().alert();

			});
			fieldWrapper.append(fName);
			fieldWrapper.append(fType);
			fieldWrapper.append(removeButton);
			$("#buildyourform").append(fieldWrapper);
		});
	})
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$("#report_table_reg").DataTable({
			dom: 'Bfrtip'
		});


	});
</script>
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>
<script>
	function ambil_form() {
		var tanggal = $("#tanggal").val();
		var agentid = $("#agentid").val();
		$.ajax({
			url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/ambilform" ?>",
			data: {
				tanggal: tanggal,
				agentid: agentid
			},
			methode: "get",
			success: function(response) {
				$("#formnya").html(response);
			},

		});
	}

	function rekasus() {
		var tanggal = $("#tanggal").val();
		var agentid = $("#agentid").val();
		$.ajax({
			url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/get_kasus" ?>",
			data: {
				agentid: agentid,
				tanggal: tanggal
			},
			methode: "get",
			success: function(response) {
				$("#datakasus").html(response);
				ambil_form();
			}
		});
	}

	function tanggal() {
		var start = $("#start").val();
		var end = $("#end").val();
		var agentid = $("#agentid").val();
		$.ajax({
			url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/get_tanggalk" ?>",
			data: {
				start: start,
				end: end,
				agentid: agentid
			},
			methode: "get",
			success: function(response) {
				$("#tanggalk").html(response);
			}
		});
	}

	$('#save').click(function() {
		var tanggal = $("#tanggal").val();
		var agentid = $("#agentid").val();
		var tanggalk = $("#tanggalk").val();
		var parameter = $("#parameter").val();
		var no_hp = $("#no_hp").val();
		var detail_not_approve = $("#detail_not_approve").val();
		$.ajax({
			url: "<?php echo base_url() ?>T_pembinaan_nonq/T_pembinaan_nonq/insertk",
			method: "POST",
			data: {
				agentid: agentid,
				tanggal: tanggal,
				tanggalk: tanggalk,
				parameter: parameter,
				no_hp: no_hp,
				detail_not_approve: detail_not_approve
			},
			success: function(data) {
				alert('sukses');
				ambil_form();
				rekasus();
			}
		});
	});
</script>
<script type="text/javascript">
	$('body').on('change', '#agentid', function() {
		var agentid = $("#agentid").val();
		var tanggal = $("#tanggal").val();
		$.ajax({
			url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/get_kasus" ?>",
			data: {
				agentid: agentid,
				tanggal: tanggal
			},
			methode: "get",
			success: function(response) {
				$("#datakasus").html(response);
				ambil_form();
			}
		});
	});

	$(document).ready(function() {
		$(".hapus").click(function() {
			var del_id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url() . "T_pembinaan_nonq/T_pembinaan_nonq/hapus" ?>",
				data: 'delete_id=' + del_id,
				success: function(data) {
					alert('berhasil hapus');
					ambil_form();
				}
			});

		});
	});
</script>