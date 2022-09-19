<?php echo _css('datatables,icheck') ?>
<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>

<?php echo card_open('Edit Payroll', 'bg-teal', true) ?>
<form id='form-a' methode="GET">
	<div class="row">
		<div class="col-3  border-top">
			<div class='col-md btn-primary'>1 Edit Variabel</div>
			<div class='form-group'>
				<input hidden type='text' readonly class='form-control data-sending focus-color' id='id' name='id' value='<?php if (isset($t_payroll->id)) echo $t_payroll->id; ?>'>
				<label class='form-label'>Periode</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='periode' name='periode' placeholder='periode' value='<?php if (isset($t_payroll->periode)) echo $t_payroll->periode ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>agentid</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='agentid' name='agentid' placeholder='agentid' value='<?php if (isset($t_payroll->agentid)) echo $t_payroll->agentid ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>HK Agent</label>
				<input type='text' class='form-control data-sending focus-color' id='hadir' name='hadir' placeholder='hadir' value='<?php if (isset($t_payroll->hadir)) echo $t_payroll->hadir ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jml_verified</label>
				<input type='text' class='form-control data-sending focus-color' id='jml_verified' name='jml_verified' placeholder='jml_verified' value='<?php if (isset($t_payroll->jml_verified)) echo $t_payroll->jml_verified ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jml_contacted</label>
				<input type='text' class='form-control data-sending focus-color' id='jml_contacted' name='jml_contacted' placeholder='jml_contacted' value='<?php if (isset($t_payroll->jml_contacted)) echo $t_payroll->jml_contacted ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jml_hpemail</label>
				<input type='text' class='form-control data-sending focus-color' id='jml_hpemail' name='jml_hpemail' placeholder='jml_hpemail' value='<?php if (isset($t_payroll->jml_hpemail)) echo $t_payroll->jml_hpemail ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jmlhp</label>
				<input type='text' class='form-control data-sending focus-color' id='jmlhp' name='jmlhp' placeholder='jmlhp' value='<?php if (isset($t_payroll->jmlhp)) echo $t_payroll->jmlhp ?>'>
			</div>
		</div>
		<div class="col-3 border-right border-top">
			<div class='col-md btn-primary'>2 Edit Tambahan</div>

			<div class='form-group'>
				<label class='form-label'>Tambahan HP+Email</label>
				<input type='text' class='form-control data-sending focus-color' id='tbh_jml_hpemail' name='tbh_jml_hpemail' placeholder='tbh_jml_hpemail' value='<?php if (isset($t_payroll->tbh_jml_hpemail)) echo $t_payroll->tbh_jml_hpemail ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>Tambahan Tunjangan Level</label>
				<input type='text' class='form-control data-sending focus-color' id='tbh_tl' name='tbh_tl' placeholder='tbh_tl' value='<?php if (isset($t_payroll->tbh_tl)) echo $t_payroll->tbh_tl ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>Tambahan Verified</label>
				<input type='text' class='form-control data-sending focus-color' id='tbh_ver' name='tbh_ver' placeholder='tbh_ver' value='<?php if (isset($t_payroll->tbh_ver)) echo $t_payroll->tbh_ver ?>'>
			</div>
			<div class='form-group'>
				<div id="calculate" class='btn btn-success col-5 pull-right hitung'><i class="fe fe-save"></i>Hitung</div>
			</div>
		</div>

		<div class='col-md border-left'>
			<div class="row">
				<div class='col-md btn-primary'>3 Result</div>
			</div>
			<div class='form-group'>
				<label class='form-label'>kehadiran</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='kehadiran' name='kehadiran' placeholder='kehadiran' value='<?php if (isset($t_payroll->kehadiran)) echo $t_payroll->kehadiran ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>contacted</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='contacted' name='contacted' placeholder='contacted' value='<?php if (isset($t_payroll->contacted)) echo $t_payroll->contacted ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>verified</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='verified' name='verified' placeholder='verified' value='<?php if (isset($t_payroll->verified)) echo $t_payroll->verified ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>tenur</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='tenur' name='tenur' placeholder='tenur' value='<?php if (isset($t_payroll->tenur)) echo $t_payroll->tenur ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>pendidikan</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='pendidikan' name='pendidikan' placeholder='pendidikan' value='<?php if (isset($t_payroll->pendidikan)) echo $t_payroll->pendidikan ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>foreign</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='foreign' name='foreign' placeholder='foreign' value='<?php if (isset($t_payroll->foreign)) echo $t_payroll->foreign ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>s_contacted</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='s_contacted' name='s_contacted' placeholder='s_contacted' value='<?php if (isset($t_payroll->s_contacted)) echo $t_payroll->s_contacted ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>s_verified</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='s_verified' name='s_verified' placeholder='s_verified' value='<?php if (isset($t_payroll->s_verified)) echo $t_payroll->s_verified ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>s_tenur</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='s_tenur' name='s_tenur' placeholder='s_tenur' value='<?php if (isset($t_payroll->s_tenur)) echo $t_payroll->s_tenur ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>s_reward</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='s_reward' name='s_reward' placeholder='s_reward' value='<?php if (isset($t_payroll->s_reward)) echo $t_payroll->s_reward ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>s_pendidikan</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='s_pendidikan' name='s_pendidikan' placeholder='s_pendidikan' value='<?php if (isset($t_payroll->id)) echo $t_payroll->s_pendidikan ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>score</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='score' name='score' placeholder='score' value='<?php if (isset($t_payroll->score)) echo $t_payroll->score ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>level</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='level' name='level' placeholder='level' value='<?php if (isset($t_payroll->level)) echo $t_payroll->level ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>t_trasnport</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='t_trasnport' name='t_trasnport' placeholder='t_trasnport' value='<?php if (isset($t_payroll->t_trasnport)) echo $t_payroll->t_trasnport ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>komisi</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='komisi' name='komisi' placeholder='komisi' value='<?php if (isset($t_payroll->komisi)) echo $t_payroll->komisi ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>tunj_level</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='tunj_level' name='tunj_level' placeholder='tunj_level' value='<?php if (isset($t_payroll->tunj_level)) echo $t_payroll->tunj_level ?>'>
			</div>
		</div>
		<div class='col-md-3 border-top'>
			<br>
			<div class='form-group'>
				<label class='form-label'>ot_moss</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='ot_moss' name='ot_moss' placeholder='ot_moss' value='<?php if (isset($t_payroll->ot_moss)) echo $t_payroll->ot_moss ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>other_fee</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='other_fee' name='other_fee' placeholder='other_fee' value='<?php if (isset($t_payroll->other_fee)) echo $t_payroll->other_fee ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>tunj_skill</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='tunj_skill' name='tunj_skill' placeholder='tunj_skill' value='<?php if (isset($t_payroll->tunj_skill)) echo $t_payroll->tunj_skill ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>perbantuan_hpemail</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='perbantuan_hpemail' name='perbantuan_hpemail' placeholder='perbantuan_hpemail' value='<?php if (isset($t_payroll->perbantuan_hpemail)) echo $t_payroll->perbantuan_hpemail ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>perbantuan_hponly</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='perbantuan_hponly' name='perbantuan_hponly' placeholder='perbantuan_hponly' value='<?php if (isset($t_payroll->perbantuan_hponly)) echo $t_payroll->perbantuan_hponly ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>nominal_perbantuan</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='nominal_perbantuan' name='nominal_perbantuan' placeholder='nominal_perbantuan' value='<?php if (isset($t_payroll->id)) echo $t_payroll->id ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>total_thp</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='total_thp' name='total_thp' placeholder='total_thp' value='<?php if (isset($t_payroll->total_thp)) echo $t_payroll->total_thp ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>non_thp</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='non_thp' name='non_thp' placeholder='non_thp' value='<?php if (isset($t_payroll->non_thp)) echo $t_payroll->non_thp ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>benefit_lain</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='benefit_lain' name='benefit_lain' placeholder='benefit_lain' value='<?php if (isset($t_payroll->benefit_lain)) echo $t_payroll->benefit_lain ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>m_fee</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='m_fee' name='m_fee' placeholder='m_fee' value='<?php if (isset($t_payroll->m_fee)) echo $t_payroll->m_fee ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>headcount</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='headcount' name='headcount' placeholder='headcount' value='<?php if (isset($t_payroll->headcount)) echo $t_payroll->headcount ?>'>
			</div>
			<hr>
			<div class='form-group'>
				<label class='form-label'>jml_verified</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_jml_verified' name='_jml_verified' placeholder='_jml_verified' value='<?php if (isset($t_payroll->jml_verified)) echo $t_payroll->jml_verified ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jml_contacted</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_jml_contacted' name='_jml_contacted' placeholder='_jml_contacted' value='<?php if (isset($t_payroll->jml_contacted)) echo $t_payroll->jml_contacted ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jml_hpemail</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_jml_hpemail' name='_jml_hpemail' placeholder='_jml_hpemail' value='<?php if (isset($t_payroll->jml_hpemail)) echo $t_payroll->jml_hpemail ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>jmlhp</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_jmlhp' name='_jmlhp' placeholder='_jmlhp' value='<?php if (isset($t_payroll->jmlhp)) echo $t_payroll->jmlhp ?>'>
			</div>
			<hr>
			<div class='form-group'>
				<label class='form-label'>Tambahan HP+Email</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_tbh_jml_hpemail' name='_tbh_jml_hpemail' placeholder='_tbh_jml_hpemail' value='<?php if (isset($t_payroll->_tbh_jml_hpemail)) echo $t_payroll->_tbh_jml_hpemail ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>Tambahan Tunjangan Level</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_tbh_tl' name='_tbh_tl' placeholder='_tbh_tl' value='<?php if (isset($t_payroll->_tbh_tl)) echo $t_payroll->_tbh_tl ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>Tambahan Verified</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_tbh_ver' name='_tbh_ver' placeholder='_tbh_ver' value='<?php if (isset($t_payroll->_tbh_ver)) echo $t_payroll->_tbh_ver ?>'>
			</div>
			<div class='form-group'>
				<label class='form-label'>Total Tambahan</label>
				<input type='text' readonly class='form-control data-sending focus-color' id='_tot_tbh' name='_tot_tbh' placeholder='_tot_tbh' value='<?php if (isset($t_payroll->_tot_tbh)) echo $t_payroll->_tot_tbh ?>'>
			</div>






		</div>
	</div>
</form>





<script>
	var page_version = "1.0.8"
</script>

<script type="text/javascript">
	$('#calculate').click(function() {
		// apply();
		var hadir = $("#hadir").val();
		var jml_verified = $("#jml_verified").val();
		var jml_contacted = $("#jml_contacted").val();
		var jml_hpemail = $("#jml_hpemail").val();
		var jmlhp = $("#jmlhp").val();
		var tbh_jml_hpemail = $("#tbh_jml_hpemail").val();
		var tbh_tl = $("#tbh_tl").val();
		var tbh_ver = $("#tbh_ver").val();
		var tot_tbh = $("#tot_tbh").val();
		var agentid = $("#agentid").val();
		if (hadir === '' || jml_verified == '' || jml_contacted == '' || jml_hpemail == '') {
			alert('Variabel penggajihan tidak boleh kosong');

			return false;
		}
		$.ajax({
			url: "<?php echo base_url() . "T_payroll/T_payroll/kalkulasi_tambahan" ?>",
			data: {
				hadir: hadir,
				jml_verified: jml_verified,
				jml_contacted: jml_contacted,
				jml_hpemail: jml_hpemail,
				jmlhp: jmlhp,
				tbh_jml_hpemail: tbh_jml_hpemail,
				tbh_tl: tbh_tl,
				agentid: agentid,
				tbh_ver: tbh_ver
			},
			type: "post",
			
			success: function(response) {
				var jsonData = JSON.parse(response);
				// alert(jsonData.tbh_ver);
				$("#kehadiran").val(jsonData.kehadiran);
				$("#contacted").val(jsonData.contacted);
				$("#verified").val(jsonData.verified);
				$("#tenur").val(jsonData.tenur);
				$("#pendidikan").val(jsonData.pendidikan);
				$("#foreign").val(jsonData.foreign);
				$("#s_contacted").val(jsonData.s_contacted);
				$("#s_verified").val(jsonData.s_verified);
				$("#s_tenur").val(jsonData.s_tenur);
				$("#s_reward").val(jsonData.s_reward);
				$("#s_pendidikan").val(jsonData.s_pendidikan);
				$("#score").val(jsonData.score);
				$("#level").val(jsonData.level);
				$("#t_trasnport").val(jsonData.t_trasnport);
				$("#komisi").val(jsonData.komisi);
				$("#tunj_level").val(jsonData.tunj_level);
				$("#ot_moss").val(jsonData.ot_moss);
				$("#other_fee").val(jsonData.other_fee);
				$("#tunj_skill").val(jsonData.tunj_skill);
				$("#perbantuan_hpemail").val(jsonData.perbantuan_hpemail);
				$("#perbantuan_hponly").val(jsonData.perbantuan_hponly);
				$("#nominal_perbantuan").val(jsonData.nominal_perbantuan);
				$("#total_thp").val(jsonData.total_thp);
				$("#non_thp").val(jsonData.non_thp);
				$("#benefit_lain").val(jsonData.benefit_lain);
				$("#m_fee").val(jsonData.m_fee);
				$("#headcount").val(jsonData.headcount);
				$("#_jml_verified").val(jsonData.jml_verified);
				$("#_jml_contacted").val(jsonData.jml_contacted);
				$("#_jml_hpemail").val(jsonData.jml_hpemail);
				$("#_jmlhp").val(jsonData.jml_hp);
				$("#_tbh_jml_hpemail").val(jsonData.tbh_jml_hpemail);
				$("#_tbh_tl").val(jsonData.tbh_tl);
				$("#_tbh_ver").val(jsonData.tbh_ver);
			}
		});
	});
</script>
<?php echo card_close() ?>
<?php echo _js('datatables,icheck') ?>