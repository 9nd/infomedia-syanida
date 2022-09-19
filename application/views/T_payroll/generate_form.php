<?php echo _css('datatables,icheck') ?>
<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>

<?php echo card_open('Generate Form', 'bg-teal', true) ?>
<form id='form-a' methode="GET">
	<div class="row">

		<div class='col-md border-left'>
			<div class='form-group'>
				<table width="100%">
					<tr>
						<td width="50%">

							<label class='form-label'>Pick Periode</label>
							<div class="row">
							<input type="date" class="data-sending focus-color form-control col-2" id="start" name="start" value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>">
							<input type="date" class="data-sending focus-color form-control col-2" id="end" name="end" value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>">
							
								&nbsp;&nbsp;&nbsp;<button id='btn-save' type='submit' class='btn btn-primary col-2'><i class="fe fe-save"></i>Generate</button>
							</div>
						</td>

					</tr>
				</table>



			</div>
		</div>
	</div>
</form>





<script>
	var page_version = "1.0.8"
</script>

<?php
if (isset($_GET['start']) && isset($_GET['end'])) {



?>
	<div class='col-md-12 col-xl-12' id="list_area">
		<div class="loading-progress" style="width:100%;"></div>
	</div>
	<script type="text/javascript">
		var progress = $(".loading-progress").progressTimer({
			timeLimit: 90,
			onFinish: function() {
				// alert('completed!');
			}
		});

		function update_base_list_area() {
			var start = $("#start").val();
			var end = $("#end").val();
			$.ajax({
				url: "<?php echo base_url() . "T_payroll/T_payroll/get_data_list" ?>",
				data: {
					start: start,
					end: end
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
<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>