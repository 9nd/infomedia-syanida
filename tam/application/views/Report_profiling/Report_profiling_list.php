<!-- load css selectize--> 
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize")?> 


<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">FILTER
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">

					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Mulai Dari</label>
							<input type='date' class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Sampai </label>
							<input type='date' class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Agent </label>
							<select name='agentid' id="select-agent" class="form-control custom-select">
								<option value="0">--Semua Agent--</option>
								<?php
								if($list_agent_d['num'] > 0){
									foreach($list_agent_d['results'] as $list_agent){
										$selected="";
										if(isset($_GET['agentid'])){
											$selected = ($list_agent->agentid == $_GET['agentid']) ? 'selected' : '';
										}
										echo "<option value='".$list_agent->agentid."' ".$selected.">".$list_agent->agentid."-".$list_agent->nama."</option>";
									}
								}
								?>
								
							</select>
						</div>
					</div>	


					<div class='col-md-12 col-xl-12'>

						<div class='form-group'>
							<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
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
	<div class='col-md-6 col-xl-6'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Regular Periode <?php echo $_GET['start']." sd ".$_GET['start']?>
				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table'>
							<thead>
								<tr>
									<th>Total Order Call</th>
									<th>Total Contacted</th>
									<th>Total Verified</th>
									<th>Agen Online</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo number_format($status_call_data['reguler_order_call_reg']); ?></td>
									<td><?php echo number_format($status_call_data['query_reguler_contacted_reg']); ?></td>
									<td><?php echo number_format($status_call_data['query_reguler_verified_reg']); ?></td>
									<td><?php echo number_format($status_call_data['query_reguler_count_reg']); ?></td>
								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class='col-md-6 col-xl-6'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">PROFILING 108 Periode <?php echo $_GET['start']." sd ".$_GET['start']?>

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table'>
							<thead>
								<tr>
									<th>Total Order Call</th>
									<th>Total Contacted</th>
									<th>Total Verified</th>
									<th>Agen Online</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo number_format($status_call_data['reguler_order_call_108']); ?></td>
									<td><?php echo number_format($status_call_data['query_reguler_contacted_108']); ?></td>
									<td><?php echo number_format($status_call_data['query_reguler_verified_108']); ?></td>
									<td><?php echo number_format($status_call_data['query_reguler_count_108']); ?></td>
								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div> -->
	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report Call Periode <?php echo $_GET['start']." sd ".$_GET['start']?>

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table'>
							<thead>
								<tr>
									<th rowspan="2">No</th>
									<th rowspan="2">Nama Agent</th>
									<th rowspan="2">User ID</th>
									<th colspan="5">Contacted</th>
									<th rowspan="2">Total Cotacted</th>
									<th colspan="5">Not Cotacted</th>
									<th rowspan="2">Total</th>
								</tr>
								<tr>
									<th>BP</th>
									<th>Verified</th>
									<th>TBP</th>
									<th>FLUP</th>
									<th>RNA</th>
									<th>SS</th>
									<th>Isolir</th>
									<th>Decline</th>
									<th>Reject</th>
									<th>Lain Reject</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$total = array();
								$total['contacted'] = 0;
								$total['uncontacted'] = 0;
								for ($i = 1; $i < 16; $i++) {
									$total[$i] = 0;
								}
								if ($agent['num'] > 0) {
									$sub_total_contacted = 0;

									foreach ($agent['results'] as $ag) {
										$sub_total_contacted = $detail_call[$ag->agentid][1] + $detail_call[$ag->agentid][13] + $detail_call[$ag->agentid][3] + $detail_call[$ag->agentid][12] + $detail_call[$ag->agentid][2];
										$sub_total_uncontacted = $detail_call[$ag->agentid][4] + $detail_call[$ag->agentid][7] + $detail_call[$ag->agentid][11] + $detail_call[$ag->agentid][10] + $detail_call[$ag->agentid][14];
										$total['contacted'] = $total['contacted'] + $sub_total_contacted;
										$total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
										for ($i = 1; $i < 16; $i++) {
											$total[$i] = $detail_call[$ag->agentid][$i] + $total[$i];
										}
								?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $ag->nama; ?></td>
											<td><?php echo $ag->agentid; ?></td>
											<td><?php echo $detail_call[$ag->agentid][1]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][13]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][3]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][12]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][2]; ?></td>
											<td><?php echo $sub_total_contacted; ?></td>
											<td><?php echo $detail_call[$ag->agentid][4]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][7]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][11]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][10]; ?></td>
											<td><?php echo $detail_call[$ag->agentid][14]; ?></td>
											<td><?php echo $sub_total_uncontacted; ?></td>

										</tr>
								<?php
										$no++;
									}
								}

								?>
								<tr>
									<td colspan="3">TOTAL</td>
									<td><?php echo $total[1]; ?></td>
									<td><?php echo $total[13]; ?></td>
									<td><?php echo $total[3]; ?></td>
									<td><?php echo $total[12]; ?></td>
									<td><?php echo $total[2]; ?></td>
									<td><?php echo $total['contacted']; ?></td>
									<td><?php echo $total[4]; ?></td>
									<td><?php echo $total[7]; ?></td>
									<td><?php echo $total[11]; ?></td>
									<td><?php echo $total[10]; ?></td>
									<td><?php echo $total[14]; ?></td>
									<td><?php echo $total['uncontacted']; ?></td>

								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>

<?php
}

?>

<!-- load library selectize --> 
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize")?> 
<script>
	$('#select-agent').selectize({}); 
	var page_version = "1.0.8"
</script>