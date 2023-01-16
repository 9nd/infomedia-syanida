<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize,multiselect") ?>

<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">New CWC Report
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Start</label>
								<input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>End </label>
								<input type='date' class='form-control data-sending focus-color' id='end' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Agent </label>
								<select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">

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
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Reason Call </label>
								<select name='reason_call[]' id="reason_call" class="form-control custom-select">
									<option value="0" <?php if($reason_call == 2){ echo "selected";};?>>--Semua Reason Call--</option>
									<option class="opsinc" value="2" <?php if($reason_call == 2){ echo "selected";};?>>RNA</option>
									<option class="opsinc" value="4" <?php if($reason_call == 4){ echo "selected";};?>>Salah Sambung</option>
									<option class="opsinc" value="7" <?php if($reason_call == 7){ echo "selected";};?>>Isolir</option>
									<option class="opsinc" value="8" <?php if($reason_call == 8){ echo "selected";};?>>Mailbox</option>
									<option class="opsinc" value="9" <?php if($reason_call == 9){ echo "selected";};?>>Telepon Sibuk</option>
									<option class="opsinc" value="10" <?php if($reason_call == 10){ echo "selected";};?>>Rejected</option>
									<option class="opsicontacted" value="11" <?php if($reason_call == 11){ echo "selected";};?>>Decline</option>
									<option class="opsicontacted" value="12" <?php if($reason_call == 12){ echo "selected";};?>>Follow Up</option>
									<option class="opsicontacted" value="13" <?php if($reason_call == 13){ echo "selected";};?>>Verified</option>
									<option class="opsinc" value="14" <?php if($reason_call == 14){ echo "selected";};?>>Reject By System</option>
									<option class="opsinc" value="15" <?php if($reason_call == 15){ echo "selected";};?>>Cabut</option>
									<option class="opsinc" value="16" <?php if($reason_call == 16){ echo "selected";};?>>Invalid Number</option>
								</select>
							</div>
						</div>

						<div class='col-md-12 col-xl-12'>

							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>

							</div>

						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {


?>


	<div class='col-md-12 col-xl-12' id="list_area">

	</div>
	<script type="text/javascript">
		function update_base_list_area() {
			var start = $("#start").val();
			var end = $("#end").val();
			var agentid = $("#agentid").val();
			var reason_call = $("#reason_call").val();
			$.ajax({
				url: "<?php echo base_url() . "New_cwc/New_cwc/report_list" ?>",
				data: {
					start: start,
					end: end,
					agentid: agentid,
					reason_call: reason_call
				},
				methode: "get",
				success: function(response) {
					$("#list_area").html(response);
				}
			});
		}

		$(document).ready(function() {
			update_base_list_area();
			// update_base_num_hp_email_area();
			// update_base_num_area();
		});
	</script>
<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize,multiselect") ?>
<script type="text/javascript">
	$('#agentid').selectize({});
	$('#reason_call').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>