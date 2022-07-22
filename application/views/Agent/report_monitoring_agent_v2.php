<?php echo _css('datatables,icheck,multiselect,selectize') ?>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {
    $start=$_GET['start'];
    $end=$_GET['end'];
}else{
    $start=date('Y-m-d');
    $end=date('Y-m-d');
}
?>
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
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' class='form-control data-sending focus-color' id='end' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
							</div>
						</div>
						<div class="clearfix"></div>
						
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

    <div class="col-md-12 col-xl-12" id="panel-form-reguler">
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Report Efisiensi Periode <?php echo $start." Sampai ".$end; ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='timecard' id="report_table" width="100%">
                            <thead>
                                <tr>
                                    <th><b>No</b></th>
                                    <th nowrap><b>Nama Agent</b></th>
                                    <th nowrap><b>User ID</b></th>
                                    <th nowrap><b>Jam Kerja</b></th>
                                    <th nowrap><b>Jam Diluar</b></th>
                                    <th nowrap><b>Effective Time</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                
                                // $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();
                                // $check_veri = count($controller->filter_by_value($data_profiling, 'veri_call', '13'));
                                if ($agent['num'] > 0) {
                                    foreach ($agent['results'] as $ag) {
                                        

                                        ////waktu diluar
                                        $diluar = $this->Sys_log->get_results(array("id_user" => $ag->id, "DATE_FORMAT(login_time, '%Y-%m-%d') >=" => $start, "DATE_FORMAT(login_time, '%Y-%m-%d') <=" => $end), array("TIMESTAMPDIFF(SECOND, login_time, logout_time) as jam "));
                                       
                                        $datetime1 = new DateTime(date($start.' H:i:s'));
                                        $datetime2 = new DateTime(date($end.' H:i:s'));
                                        // $datetime1 = date_create('2017-06-28'); 
                                        // $datetime2 = date_create('2018-06-28'); 
                                        
                                        // calculates the difference between DateTime objects 
                                        $interval = date_diff($datetime1, $datetime2); 
                                        // echo $interval;
                                        // printing result in days format 
                                        // echo $interval->format('%R%a'); 
                                        $total_diluar = 0;
                                        if ($diluar['num'] > 0) {
                                            foreach ($diluar['results'] as $dl) {
                                                $total_diluar = $dl->jam + $total_diluar;
                                            }
                                        }
                                        $diff = ((($interval->format('%R%a')+1)*60)*60)*8;
                                        $waktu_duduk = $diff - ($total_diluar*60);
                                        $waktu_total=($waktu_duduk/$diff)*100 ;
                                       
                                ?>

                                        <tr class="data-<?php echo $color; ?>">
                                            <td><?php echo $no; ?></td>
                                            <td style="text-align:left;"><?php echo $ag->nama; ?></td>
                                            <td style="text-align:left;"><?php echo $ag->agentid; ?></td>
                                            <td><?php echo $controller->convert_second($diff); ?></td>
                                            <td><?php echo $controller->convert_second($total_diluar); ?></td>
                                            <td><?php echo $waktu_total."%"; ?></td>
                                        </tr>
                                <?php

                                        $no++;
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </small>
                </div>

            </div>

        </div>
    </div>
<?php echo _js('datatables,icheck,ybs,selectize,multiselect') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#report_table").DataTable();
    });
</script>
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();
	var page_version = "1.0.8"
</script>