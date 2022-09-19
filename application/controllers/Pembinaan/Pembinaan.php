<?php


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pembinaan extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();

		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/qc_model', 'qc');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
	}

	public function insertk()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

		if (isset($_POST["idtemuan"])) {
			$idtemuan = $_POST["idtemuan"];
			$tanggal = $_POST["tanggal"];
			$agentid = $_POST["agentid"];
			$tingkat_pembinaan = $_POST["tingkat_pembinaan"];

			if ($idtemuan != '') {
				$queryx = $this->db->query('INSERT INTO t_pembinaan(id_kasus, tanggal_pembinaan, tingkat_pembinaan,  agentid, input_by, jenis) 
				VALUES("' . $idtemuan . '", "' . $tanggal . '", "' . $tingkat_pembinaan . '", "' . $agentid . '", "' . $data['userdata']->agentid . '", "k")');
			}

			if ($queryx != '') {
				if ($queryx) {
					echo 'Item Data Inserted';
				} else {
					echo 'Error';
				}
			} else {
				echo 'All Fields are Required';
			}
		}
	}

	public function fetch()
	{

		$agentid = $_POST["agentid"];
		$tanggal = $_POST["tanggal"];
		$resulta = $this->db->query("SELECT * FROM t_pembinaan WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal' ORDER BY id DESC")->result();
		$resultas = $this->db->query("SELECT penyuluhan, action_plan, tingkat_pembinaan FROM t_pembinaan WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal'");
?>
		<br />
		<h3 align="center">Agent Name : <?php echo $agentid; ?> | Pembinaan Tanggal: <?php echo $tanggal; ?> </h3>
		<table class="table table-bordered table-striped">
			<tr>
				<th>TGL</th>
				<th>Parameter</th>
				<th>No HP</th>
				<th>Detail Not Approve</th>
				<th>Hapus</th>
			</tr>
			<?php

			foreach ($resulta as $row) {
				echo " <tr> ";
				echo "  <td>";
				$kasus = $row->id_kasus;
				$query = $this->db->query("SELECT lup, reason_qa, handphone, keterangan_qc FROM qc WHERE id='$kasus' ORDER BY id DESC")->row();
				echo $query->lup;
				echo "</td>";
				echo "  <td>" . $query->reason_qa . "</td>";
				echo "  <td>" . $query->handphone . "</td>";
				echo "  <td>" . $query->keterangan_qc . "</td>";
				echo "  <td><div class='hapus' id='$row->id'><button type='button' class='btn btn-danger'><span class='fe fe-minus-circle'></span></button></div></td>";
				echo " </tr>";
			}
			echo "	</table>";
			?>

			<div class="form form-group">
				Penyuluhan
				<input type="text" class="form form-control" name="penyuluhan" id="penyuluhan" value="<?php if (isset($resultas->row()->penyuluhan)) {
																											echo $resultas->row()->penyuluhan;
																										} ?>">
				Tingkat Pembinaan
				<select class="form form-control" name="tingkat_pembinaan" id="tingkat_pembinaan">
					<?php if (isset($resultas->row()->tingkat_pembinaan)) {
						echo "<option value='" . $resultas->row()->tingkat_pembinaan . "'>" . $resultas->row()->tingkat_pembinaan . "</option>";
					} ?>
					<option value='Coaching 1'>Coaching 1</option>
					<option value='Coaching 2'>Coaching 2</option>
					<option value='Coaching 3'>Coaching 3</option>
				</select>
				<button type="button" class="btn btn-success update">Simpan</button>
			</div>
			<button onclick="printDiv('printableArea')" class="btn btn-primary pull-right">Print</button>
			<div id="printableArea">
				<table width="100%" height="82" border="1">
					<tbody>
						<tr>
							<td colspan="8"><img src='<?php echo base_url(); ?>assets/images/logopembnaan.png'></td>
						</tr>
						<tr>
							<td colspan="8">
								<div align="center" style="padding-left: 2px;"><b>FORM COACHING</b></div>
							</td>
						</tr>
						<tr>
							<td colspan="8">
								<div align="center" style="padding-left: 2px;">
									<table border="0" width="100%">
										<tr>
											<td colspan="3" style="padding-left: 10px;">Tanggal</td>
											<td colspan="2" style="padding-left: 2px;">: <?php echo $tanggal ?></td>
											<td width="59"></td>
											<td width="173" style="padding-left: 10px;">Nama SDM</td>
											<td width="372" style="padding-left: 2px;">: <?php $agentnama = $this->db->query("SELECT nama FROM sys_user WHERE agentid ='$agentid'")->row()->nama;
																							echo $agentnama;
																							?></td>
										</tr>
										<tr>
											<td colspan="3" style="padding-left: 10px;">Departemen/Layanan</td>
											<td colspan="2" style="padding-left: 2px;">: TELKOM DIV.2/PROFILING CONSUMER</td>
											<td>&nbsp;</td>
											<td style="padding-left: 10px;">Paraf SDM yang di coaching</td>
											<td style="padding-left: 2px;">: </td>
										</tr>
										<tr>
											<td colspan="3" style="padding-left: 10px;">Lokasi</td>
											<td colspan="2" style="padding-left: 2px;">: Ters. Buah Batu No. 31-33 Bandung</td>
											<td>&nbsp;</td>
											<td style="padding-left: 10px;">Atasan Langsung</td>
											<td style="padding-left: 2px;">: <?php $agentnama = $this->db->query("SELECT tl FROM sys_user WHERE agentid ='$agentid'")->row()->tl;
																				$agenttl = $this->db->query("SELECT nama FROM sys_user WHERE agentid ='$agentnama'")->row()->nama;
																				echo $agenttl;
																				?></td>
										</tr>
										<tr>
											<td colspan="3">&nbsp;</td>
											<td colspan="2">&nbsp;</td>
											<td>&nbsp;</td>
											<td style="padding-left: 10px;" style="padding-left: 10px;">Paraf Atasan Langsung</td>
											<td style="padding-left: 2px;">: </td>
										</tr>
										<tr>
											<td colspan="3">&nbsp;</td>
											<td colspan="2">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>

						<tr>
							<td colspan="6">
								<div align="center"><b>PERMASALAHAN</b></div>
							</td>
							<td colspan="2" align="center" style="padding-left: 10px;"><b>PENYULUHAN</b></td>
						</tr>
						<tr>
							<td width="46">
								<div align="center">Tgl</div>
							</td>
							<td width="135">
								<div align="center">PARAMETER</div>
							</td>
							<td width="104">
								<div align="center">NO HP</div>
							</td>
							<td colspan="3">
								<div align="center">DETAIL NOT APPROVE</div>
							</td>
							<td colspan="2" rowspan="5" valign="top" style="padding-left: 10px;"><?php if (isset($resultas->row()->penyuluhan)) {
																										echo $resultas->row()->penyuluhan;
																									} ?></td>
						</tr>
						<tr>
							<td><?php if (isset($resulta[0]->id_kasus)) {
									$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->lup;
									echo substr("$hasils", 5, 5);
								} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[0]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[0]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[0]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td><?php if (isset($resulta[1]->id_kasus)) {
									$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->lup;
									echo substr("$hasils", 5, 5);
								} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[1]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[1]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[1]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td><?php if (isset($resulta[2]->id_kasus)) {
									$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->lup;
									echo substr("$hasils", 5, 5);
								} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[2]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[2]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[2]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td><?php if (isset($resulta[3]->id_kasus)) {
									$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->lup;
									echo substr("$hasils", 5, 5);
								} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[3]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[3]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[3]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td><?php if (isset($resulta[4]->id_kasus)) {
									$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->lup;
									echo substr("$hasils", 5, 5);
								} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[4]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[4]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[4]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
							<td colspan="2" style="padding-left: 10px;">
								<div align="center" style="padding-left: 10px;"><b>ACTION PLAN:</b></div>
							</td>
						</tr>
						<tr>
							<td style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->lup;
																echo substr("$hasils", 5, 5);
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
							<td colspan="2" rowspan="5" valign="top" style="padding-left: 10px;"><?php if (isset($resultas->row()->action_plan)) {
																										echo $resultas->row()->action_plan;
																									} ?></td>
						</tr>
						<tr>
							<td style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->lup;
																echo substr("$hasils", 5, 5);
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->lup;
																echo substr("$hasils", 5, 5);
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->lup;
																echo substr("$hasils", 5, 5);
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->lup;
																echo substr("$hasils", 5, 5);
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->reason_qa;
																echo $hasils;
															} ?></td>
							<td style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->handphone;
																echo $hasils;
															} ?></td>
							<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																			$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->keterangan_qc;
																			echo $hasils;
																		} ?>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="3" width="5000">
								<div align="center"><b>JENIS COACHING</b></div>
							</td>
							<td width="87">
								<div align="center"><b>Batas Waktu Verifikasi</b></div>
							</td>
							<td colspan="2" style="padding-left: 10px;">Tgl. Verifikasi</td>
							<td style="padding-left: 2px;">:</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox" id="checkbox">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Tidak memenuhi Target Verified</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
							<td colspan="2" style="padding-left: 10px;">Paraf Atasan Langsung</td>
							<td style="padding-left: 2px;">:</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox2" id="checkbox2">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Gagal Tes Perbaikan target nilai PnP</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
							<td colspan="2" style="padding-left: 10px;">Paraf Pegawai Subjek Coaching</td>
							<td style="padding-left: 2px;">:</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox3" id="checkbox3">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Tidak mencapai target PPCO</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
							<td colspan="3">
								<div align="center"><b>HASIL PERBAIKAN COACHING (VERIFIKASI)</b></div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox4" id="checkbox4">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Kesalahan pembuatan Ticket ( Handling / Complaint / Request )*</td>
							<td>
								<div align="center">10 Harian</div>
							</td>
							<td colspan="3" rowspan="7" align="left" valign="top" style="padding-left: 10px;">&nbsp;</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox5" id="checkbox5">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">LOG IN terlambat (maksimum 10 menit akumulasi 25 hari)</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox6" id="checkbox6">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Tidak hadir ( Training / Sosialisasi / Meeting )*</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox7" id="checkbox7">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Pelanggaran Sopan santun / Komitmen CO (Performance)</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox8" id="checkbox8">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Softskills</td>
							<td>
								<div align="center">Bulanan</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox9" id="checkbox9">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Product Knowledge</td>
							<td>
								<div align="center">2 Mingguan</div>
							</td>
						</tr>
						<tr>
							<td>
								<div align="center">
									<input type="checkbox" name="checkbox10" id="checkbox10">
								</div>
							</td>
							<td colspan="3" style="padding-left: 10px;">Not Approve 5x (<?php echo $resultas->row()->tingkat_pembinaan ?>)</td>
							<td>
								<div align="center">2 Mingguan</div>
							</td>
						</tr>

					</tbody>
				</table>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Coret yang tidak perlu
				<br>
				<br>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISH.OPR.03.27 Rev. 01
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$(".hapus").click(function() {
						var del_id = $(this).attr('id');
						$.ajax({
							type: 'POST',
							url: "<?php echo base_url() . "Pembinaan/Pembinaan/hapus" ?>",
							data: 'delete_id=' + del_id,
							success: function(data) {
								alert('berhasil hapus');
								fetch_item_data();
							}
						});

					});
				});
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
							url: "<?php echo base_url() . "Pembinaan/Pembinaan/updatep" ?>",
							data: {
								agentid: agentid,
								tanggal: tanggal,
								penyuluhan: penyuluhan,
								tingkat_pembinaan: tingkat_pembinaan
							},
							success: function(data) {
								alert('berhasil update');
								fetch_item_data();
							}
						});

					});
				});
			</script>
			<script>
				function printDiv(divName) {

					var printContents = document.getElementById(divName).innerHTML;
					var originalContents = document.body.innerHTML;
					var css = '@page { size: landscape; }',
						head = document.head || document.getElementsByTagName('head')[0],
						style = document.createElement('style');

					style.type = 'text/css';
					style.media = 'print';

					if (style.styleSheet) {
						style.styleSheet.cssText = css;
					} else {
						style.appendChild(document.createTextNode(css));
					}

					document.body.innerHTML = printContents;

					window.print();

					document.body.innerHTML = originalContents;
				}
			</script>
		<?php
	}
	public function hapus()
	{
		$delete_id = $_POST["delete_id"];
		$this->db->query("DELETE FROM t_pembinaan WHERE id='$delete_id'");
	}
	public function updatep()
	{

		$penyuluhan = $_POST["penyuluhan"];
		$agentid = $_POST["agentid"];
		$tanggal = $_POST["tanggal"];
		$tingkat_pembinaan = $_POST["tingkat_pembinaan"];
		if ($agentid != "" && $tanggal != "") {
			$this->db->query("UPDATE t_pembinaan SET penyuluhan='$penyuluhan',  tingkat_pembinaan='$tingkat_pembinaan' WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal' ");



			$this->load->library('telegram');
			$pesan = "<b>Coaching Quality ditambahkan</b> 
	Tanggal: " . $tanggal . " 
	penyuluhan : " . $penyuluhan . "
	agentid : " . $agentid . "
	coaching : " . $tingkat_pembinaan;

			$query = $this->db->query("SELECT agentid, opt_level, chat_id_telegram, tl FROM sys_user WHERE agentid='$agentid'")->row();
			$querytl = $this->db->query("SELECT agentid, opt_level, chat_id_telegram FROM sys_user WHERE agentid='$query->tl'")->row();
			if ($query->chat_id_telegram != "" || $query->chat_id_telegram != NULL) {
				$this->telegram->send_manual($pesan, $query->agentid, $query->opt_level, $query->chat_id_telegram);
				$this->telegram->send_manual($pesan, $querytl->agentid, $querytl->opt_level, $querytl->chat_id_telegram);
			}
		}
	}
	public function Tambah_form()
	{

		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$this->template->load('Pembinaan/Form_tambah', $data);
	}

	public function get_kasus()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$agentid = $_GET['agentid'];
		$agentmos = $this->db->query("SELECT agentid_mos FROM sys_user WHERE agentid='$agentid'")->row()->agentid_mos;
		$list_qc = $this->db->query("
		
		SELECT
	qc.id,
	qc.lup,
	qc.reason_qa,
	qc.keterangan_qc,
	qc.handphone 
FROM
	qc
	LEFT JOIN t_pembinaan ON t_pembinaan.id_kasus = qc.id 
WHERE
	qc.status_approve = '0' 
	AND ( qc.agentid = '$agentid' OR qc.agentid = '$agentmos' ) 
	AND
	t_pembinaan.id_kasus IS NULL
ORDER BY
	lup DESC
		")->result();
		// var_dump($list_qc);
		$user_categori = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user))->opt_level;
		// var_dump($user_categori);
		?>
			<?php echo _css("selectize,multiselect,datatables") ?>
			<select name='kasus' id="kasus" class="form-control custom-select">
				<?php
				if ($user_categori != 8) {
				?>
					<option value="0">--Semua Kasus--</option>
				<?php
				}
				if (COUNT($list_qc) > 0) {
					foreach ($list_qc as $list_kasus) {
						$selected = "";
						echo "<option value='" . $list_kasus->id . "' " . $selected . ">" . $list_kasus->id . " | " . substr($list_kasus->lup, 0, 10) . " | " . $list_kasus->reason_qa . " | " . $list_kasus->handphone . " | " . $list_kasus->keterangan_qc . "</option>";
					}
				}
				?>

			</select>
			<?php echo _js("selectize,multiselect,datatables") ?>
			<script type="text/javascript">
				$('#kasus').selectize({});
				// $('#agentid').multiselect();
				var page_version = "1.0.8"
			</script>
		<?php
	}
	// public function index()
	// {
	// 	$data = array(
	// 		'title_page_big'		=> 'Coaching List',
	// 		'title'					=> $this->title,
	// 	);
	// 	if (isset($_GET['start']) && isset($_GET['end'])) {
	// 		$start = $_GET['start'];
	// 		$end = $_GET['end'];
	// 	}


	// 	$idlogin = $this->session->userdata('idlogin');
	// 	$logindata = $this->log_login->get_by_id($idlogin);
	// 	if (isset($agentid)) {
	// 		if ($agentid) {
	// 			if (count($_GET['agentid']) > 1) {
	// 				$n_agent_pick = count($_GET['agentid']);
	// 				foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
	// 					if ($k_agentid == 0) {
	// 						$filter_agent = " AND (qm_score.agentid = '$v_agentid'";
	// 						$where_agent_multi = "AND ( qm_score.agentid = '$v_agentid'";
	// 					} else {
	// 						if ($k_agentid == ($n_agent_pick - 1)) {
	// 							$where_agent_multi = $where_agent_multi . " OR qm_score.agentid = '$v_agentid' )";
	// 							$filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
	// 						} else {
	// 							$where_agent_multi = $where_agent_multi . " OR qm_score.agentid = '$v_agentid' ";
	// 							$filter_agent = $filter_agent . " OR qm_score.agentid = '$agentid' ";
	// 						}
	// 					}
	// 				}
	// 				$where_agent['or_where_null'] = array($where_agent_multi);
	// 			} else {
	// 				if ($agentid[0] != '0') {
	// 					$where_agent['agentid'] = $agentid[0];
	// 					$filter_agent = " AND qm_score.agentid = '$agentid[0]' ";
	// 					$where_agent_multi = "AND ( qm_score.agentid = '$agentid[0]')";
	// 				}
	// 			}
	// 		}
	// 	}

	// 	$filter_agent = array("opt_level" => 8, "tl !=" => "-");
	// 	$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
	// 	$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
	// 	$data['controller'] = $this;
	// 	$this->template->load('Pembinaan/Pembinaan_date', $data);
	// }

	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Pembinaan',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;

		$data['qc'] = $this->qc->get_results();
		$where_agent = array("kategori" == "REG");

		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if ($userdata->opt_level == 9) {
			$where_agent['tl'] = $userdata->agentid;
		}


		if ($userdata->opt_level == 8) {
			$data['data_tapping'] = $this->db->query("SELECT
			* 
		FROM
			t_pembinaan 
		WHERE  		
		agentid = '$userdata->agentid'
		AND
		 jenis='k'
		GROUP BY tanggal_pembinaan, agentid")->result();
		} else {
			$data['data_tapping'] = $this->db->query("SELECT
			* 
		FROM
			t_pembinaan 
		WHERE  		
		jenis='k'
		GROUP BY tanggal_pembinaan, agentid")->result();
		}


		$data['controller'] = $this;
		$data['opt_level'] = $userdata->opt_level;
		$data['userdata'] = $userdata->agentid;
		$this->template->load('Pembinaan/Pembinaan_date', $data);
	}


	public function detail($id)
	{
		$data = array(
			'title_page_big'		=> 'Detail ',
			'title'					=> $this->title,
			'link_back'				=> $this->agent->referrer(),
		);

		$data['data_qc'] = $this->qc->get_row(array("id" => $id));
		$ncli = $data['data_qc']->ncli;
		$agentid = $data['data_qc']->agentid;
		$lup = $data['data_qc']->lup;
		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->trans_profiling->live_query(
			"SELECT trans_profiling.*,DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') as lup_date FROM trans_profiling 
			WHERE trans_profiling.lup = '$lup'
			AND trans_profiling.veri_call='13'
			AND trans_profiling.veri_upd='$agentid'
			AND trans_profiling.ncli='$ncli'
			$filter_agent
			GROUP BY idx"
		);
		$data['agent'] = $this->sys_user->get_row(array("agentid" => $agentid));
		$data['data'] = $data['query_trans_profiling']->row();
		$data['recording'] = false;
		$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
		if (!$data['q_recording']) {
			$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
		}
		if ($data['q_recording']) {
			$data['recording'] = $data['q_recording']->recordingfile;
		}
		$data['qc'] = $this->qc->live_query(
			"SELECT * FROM qc WHERE id = $id"
		)->row();


		$this->template->load('Pembinaan/detail_pembinaan', $data);
	}



	public function Pembinaan_list()
	{
		$data = array(
			'title_page_big'		=> 'Pembinaan',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

			$data['qc'] = $this->qc->get_results();
			$where_agent = array("kategori" == "REG");
			$filter_agent = "";

			$this->load->model('sys/Sys_user_log_model', 'log_login');
			$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);

			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}

			if (isset($agentid)) {
				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (trans_profiling_last_month.veri_upd = '$v_agentid'";
								$filter_agent_veri = " AND (update_by = '$v_agentid'";
								$where_agent_multi = "( agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR trans_profiling_last_month.veri_upd = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR trans_profiling_last_month.veri_upd = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						$where_agent['agentid'] = $agentid[0];
						$filter_agent = " AND trans_profiling_last_month.veri_upd = '$agentid[0]'";
						$filter_agent_veri = " AND update_by = '$agentid[0]'";
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
		}

		if ($userdata->opt_level == 8) {
			$data['data_tapping'] = $this->db->query("SELECT
			* 
		FROM
			t_pembinaan 
		WHERE  
		
		agentid = '$userdata->agentid'
		AND
		DATE( tanggal_pembinaan ) BETWEEN '$start_filter' AND '$end_filter' 
		AND tingkat_pembinaan IS NULL
		GROUP BY tanggal_pembinaan, agentid")->result();
		} else {
			$data['data_tapping'] = $this->db->query("SELECT
			* 
		FROM
			t_pembinaan 
		WHERE  
		
		DATE( tanggal_pembinaan ) BETWEEN '$start_filter' AND '$end_filter' 
		AND tingkat_pembinaan IS NULL
		GROUP BY tanggal_pembinaan, agentid")->result();
		}

		$data['start'] = $_GET['start'];
		$data['end'] = $_GET['end'];

		$data['controller'] = $this;
		$data['opt_level'] = $userdata->opt_level;
		$data['userdata'] = $userdata->agentid;
		$this->load->view('Pembinaan/Pembinaan_list', $data);
	}

	function detailagent()
	{
		$agentid = $_GET["agentid"];
		$tanggal = $_GET["tanggal"];
		$resulta = $this->db->query("SELECT * FROM t_pembinaan WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal' ORDER BY id DESC")->result();
		$resultas = $this->db->query("SELECT penyuluhan, action_plan FROM t_pembinaan WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal'");
		?>
			<html>

			<head>
				<style>
					@media print {
						body {
							font-size: 9pt
						}
					}
				</style>
			</head>

			<body>

				<?php echo _css('datatables') ?>
				<button onclick="printDiv('printableArea')" class="btn btn-primary pull-right">Print</button>
				<div id="printableArea">
					<table width="100%" style="border-collapse: collapse; font-family: calibri; font-size:1em;" border=1>
						<tbody>
							<tr>
								<td colspan="8"><img src='<?php echo base_url(); ?>assets/images/logopembnaan.png'></td>
							</tr>
							<tr>
								<td colspan="8">
									<div align="center" style="padding-left: 2px;"><b>FORM COACHING</b></div>
								</td>
							</tr>
							<tr>
								<td colspan="8">
									<div align="center" style="padding-left: 2px;">
										<table border="0" width="100%" style="font-size: 9pt">
											<tr>
												<td colspan="3" style="padding-left: 10px;">Tanggal</td>
												<td colspan="2" style="padding-left: 2px;">: <?php echo $tanggal ?></td>
												<td width="9,8%"></td>
												<td width="20,6%" style="padding-left: 10px;">Nama SDM</td>
												<td width="61,6%" style="padding-left: 2px;">: <?php $agentnama = $this->db->query("SELECT nama FROM sys_user WHERE agentid ='$agentid'")->row()->nama;
																								echo $agentnama;
																								?></td>
											</tr>
											<tr>
												<td colspan="3" style="padding-left: 10px;">Departemen/Layanan</td>
												<td colspan="2" style="padding-left: 2px;">: TELKOM DIV.2/PROFILING CONSUMER</td>
												<td>&nbsp;</td>
												<td style="padding-left: 10px;">Paraf SDM yang di coaching</td>
												<td style="padding-left: 2px;">: </td>
											</tr>
											<tr>
												<td colspan="3" style="padding-left: 10px;">Lokasi</td>
												<td colspan="2" style="padding-left: 2px;">: Ters. Buah Batu No. 31-33 Bandung</td>
												<td>&nbsp;</td>
												<td style="padding-left: 10px;">Atasan Langsung</td>
												<td style="padding-left: 2px;">: <?php $agentnama = $this->db->query("SELECT tl FROM sys_user WHERE agentid ='$agentid'")->row()->tl;
																					$agenttl = $this->db->query("SELECT nama FROM sys_user WHERE agentid ='$agentnama'")->row()->nama;
																					echo $agenttl;
																					?></td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td colspan="2">&nbsp;</td>
												<td>&nbsp;</td>
												<td style="padding-left: 10px;" style="padding-left: 10px;">Paraf Atasan Langsung</td>
												<td style="padding-left: 2px;">: </td>
											</tr>
											<tr>
												<td colspan="3">&nbsp;</td>
												<td colspan="2">&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>

							<tr>
								<td colspan="6">
									<div align="center"><b>PERMASALAHAN</b></div>
								</td>
								<td colspan="2" align="center" style="padding-left: 10px;"><b>PENYULUHAN</b></td>
							</tr>
							<tr>
								<td width="46">
									<div align="center">Tgl</div>
								</td>
								<td width="135">
									<div align="center">PARAMETER</div>
								</td>
								<td width="10%">
									<div align="center">NO HP</div>
								</td>
								<td colspan="3">
									<div align="center">DETAIL NOT APPROVE</div>
								</td>
								<td colspan="2" rowspan="5" valign="top" style="padding-left: 10px;"><?php if (isset($resultas->row()->penyuluhan)) {
																											echo $resultas->row()->penyuluhan;
																										} ?></td>
							</tr>
							<tr>
								<td><?php if (isset($resulta[0]->id_kasus)) {
										$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->lup;
										echo substr("$hasils", 5, 5);
									} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[0]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[0]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[0]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[0]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td><?php if (isset($resulta[1]->id_kasus)) {
										$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->lup;
										echo substr("$hasils", 5, 5);
									} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[1]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[1]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[1]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[1]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td><?php if (isset($resulta[2]->id_kasus)) {
										$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->lup;
										echo substr("$hasils", 5, 5);
									} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[2]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[2]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[2]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[2]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td><?php if (isset($resulta[3]->id_kasus)) {
										$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->lup;
										echo substr("$hasils", 5, 5);
									} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[3]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[3]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[3]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[3]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td><?php if (isset($resulta[4]->id_kasus)) {
										$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->lup;
										echo substr("$hasils", 5, 5);
									} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[4]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[4]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[4]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[4]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
								<td colspan="2" style="padding-left: 10px;">
									<div align="center" style="padding-left: 10px;"><b>ACTION PLAN:</b></div>
								</td>
							</tr>
							<tr>
								<td style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																	$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->lup;
																	echo substr("$hasils", 5, 5);
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[5]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[5]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
								<td colspan="2" rowspan="5" valign="top" style="padding-left: 10px;"><?php if (isset($resultas->row()->action_plan)) {
																											echo $resultas->row()->action_plan;
																										} ?></td>
							</tr>
							<tr>
								<td style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																	$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->lup;
																	echo substr("$hasils", 5, 5);
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[6]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[6]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																	$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->lup;
																	echo substr("$hasils", 5, 5);
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[7]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[7]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																	$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->lup;
																	echo substr("$hasils", 5, 5);
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[8]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[8]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																	$hasils = $this->db->query("SELECT lup FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->lup;
																	echo substr("$hasils", 5, 5);
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																	$hasils = $this->db->query("SELECT reason_qa FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->reason_qa;
																	echo $hasils;
																} ?></td>
								<td style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																	$hasils = $this->db->query("SELECT handphone FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->handphone;
																	echo $hasils;
																} ?></td>
								<td colspan="3" style="padding-left: 10px;"><?php if (isset($resulta[9]->id_kasus)) {
																				$hasils = $this->db->query("SELECT keterangan_qc FROM qc where id='" . $resulta[9]->id_kasus . "'")->row()->keterangan_qc;
																				echo $hasils;
																			} ?>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td colspan="3" width="5000">
									<div align="center"><b>JENIS COACHING</b></div>
								</td>
								<td width="87">
									<div align="center"><b>Batas Waktu Verifikasi</b></div>
								</td>
								<td colspan="2" style="padding-left: 10px;">Tgl. Verifikasi</td>
								<td style="padding-left: 2px;">:</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox" id="checkbox">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Tidak memenuhi Target Verified</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
								<td colspan="2" style="padding-left: 10px;">Paraf Atasan Langsung</td>
								<td style="padding-left: 2px;">:</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox2" id="checkbox2">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Gagal Tes Perbaikan target nilai PnP</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
								<td colspan="2" style="padding-left: 10px;">Paraf Pegawai Subjek Coaching</td>
								<td style="padding-left: 2px;">:</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox3" id="checkbox3">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Tidak mencapai target PPCO</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
								<td colspan="3">
									<div align="center"><b>HASIL PERBAIKAN COACHING (VERIFIKASI)</b></div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox4" id="checkbox4">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Kesalahan pembuatan Ticket ( Handling / Complaint / Request )*</td>
								<td>
									<div align="center">10 Harian</div>
								</td>
								<td colspan="3" rowspan="7" align="left" valign="top" style="padding-left: 10px;">&nbsp;</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox5" id="checkbox5">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">LOG IN terlambat (maksimum 10 menit akumulasi 25 hari)</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox6" id="checkbox6">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Tidak hadir ( Training / Sosialisasi / Meeting )*</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox7" id="checkbox7">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Pelanggaran Sopan santun / Komitmen CO (Performance)</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox8" id="checkbox8">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Softskills</td>
								<td>
									<div align="center">Bulanan</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox9" id="checkbox9">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Product Knowledge</td>
								<td>
									<div align="center">2 Mingguan</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="center">
										<input type="checkbox" name="checkbox10" id="checkbox10">
									</div>
								</td>
								<td colspan="3" style="padding-left: 10px;">Not Approve 5x (Coaching 1)</td>
								<td>
									<div align="center">2 Mingguan</div>
								</td>
							</tr>

						</tbody>
					</table>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Coret yang tidak perlu
					<br>
					<br>

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISH.OPR.03.27 Rev. 01
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
						$(".hapus").click(function() {
							var del_id = $(this).attr('id');
							$.ajax({
								type: 'POST',
								url: "<?php echo base_url() . "Pembinaan/Pembinaan/hapus" ?>",
								data: 'delete_id=' + del_id,
								success: function(data) {
									alert('berhasil hapus');
									fetch_item_data();
								}
							});

						});
					});
				</script>

				<script>
					function printDiv(divName) {

						var printContents = document.getElementById(divName).innerHTML;
						var originalContents = document.body.innerHTML;
						var css = '@page { size: landscape; }',
							head = document.head || document.getElementsByTagName('head')[0],
							style = document.createElement('style');

						style.type = 'text/css';
						style.media = 'print';

						if (style.styleSheet) {
							style.styleSheet.cssText = css;
						} else {
							style.appendChild(document.createTextNode(css));
						}

						document.body.innerHTML = printContents;

						window.print();

						document.body.innerHTML = originalContents;
					}
				</script>
			</body>

			</html>

	<?php
	}

	function get_data_list()
	{
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		if (isset($_GET['start'])) {
			$start_filter = $_GET['start'];


			$data['status'] = $this->status_call->get_results();
			$where_agent = array("opt_level" => 8);
			$filter_agent = "";

			$this->load->model('sys/Sys_user_log_model', 'log_login');
			$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);

			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}


			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
			$data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));
			$filter = array();
			$data['query_trans_profiling'] = $this->trans_profiling_daily->live_query(
				"SELECT trans_profiling_last_month.* FROM trans_profiling_last_month 
				WHERE DATE(trans_profiling_last_month.lup) = '$start_filter'
				AND trans_profiling_last_month.veri_call='13'
				"
			);
		}
		$this->load->view('qc/agent_area', $data);
	}

	function edit_form_approve()
	{
		$data = array(
			'title_page_big'		=> 'Edit Quality Control ',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Qc/Qc/update_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$data['data_qc'] = $this->qc->get_row(array("id" => $_GET['id']));
		$ncli = $data['data_qc']->ncli;
		$agentid = $data['data_qc']->agentid;
		$lup = $data['data_qc']->lup;

		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->trans_profiling->live_query(
			"SELECT trans_profiling.*,DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') as lup_date FROM trans_profiling 
			WHERE trans_profiling.lup = '$lup'
			AND trans_profiling.veri_call='13'
			AND trans_profiling.veri_upd='$agentid'
			AND trans_profiling.ncli='$ncli'
			$filter_agent
			GROUP BY idx
			"
		);
		$data['agent'] = $this->sys_user->get_row(array("agentid" => $agentid));
		$data['data'] = $data['query_trans_profiling']->row();
		$data['recording'] = false;
		$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
		if (!$data['q_recording']) {
			$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
		}
		if ($data['q_recording']) {
			$data['recording'] = $data['q_recording']->recordingfile;
		}
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$data['loginid'] = $this->log_login->get_by_id($idlogin);


		$this->template->load('qc/edit_form_qc', $data);
	}

	function form_approve()
	{
		$data = array(
			'title_page_big'		=> 'Quality Control ',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Qc/Qc/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$ncli = $_GET['ncli'];
		$agentid = $_GET['agentid'];
		$start_filter = $_GET['start'];
		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->trans_profiling->live_query(
			"SELECT trans_profiling.* FROM trans_profiling
			WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') >= '$start_filter' 
			AND trans_profiling.veri_call='13'
			AND trans_profiling.veri_upd='$agentid'
			AND trans_profiling.ncli='$ncli'
			$filter_agent
			GROUP BY idx"
		);
		$data['agent'] = $this->sys_user->get_row(array("agentid" => $agentid));
		$data['data'] = $data['query_trans_profiling']->row();
		$data['recording'] = false;
		$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
		if (!$data['q_recording']) {
			$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
		}
		if ($data['q_recording']) {
			$data['recording'] = $data['q_recording']->recordingfile;
		}

		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$idlogin = $this->session->userdata('idlogin');
		$data['loginid'] = $this->log_login->get_by_id($idlogin);

		$this->template->load('qc/form_qc', $data);
	}

	public function update_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$o		= new Outputview();

		/* 
		*	untuk mengganti message output
		* tambahkan perintah : $o->message = 'isi pesan'; 
 		* sebelum perintah validasi.
		* ex.
		* 	$o->message = 'halo ini pesan baru';
		* 	if(!$o->not_empty($val['descriptions'],'#descriptions')){
		*		echo $o->result();	
		*		return;
		*  	}
		*
		*/

		//mencegah data kosong
		$idlogin = $this->session->userdata('idlogin');
		$val['idlogin'] = $idlogin;
		$val['tanggal'] = date('Y-m-d H:i:s');
		$id = $val['id'];
		unset($val['id']);
		$success = $this->qc->update($id, $val);
		echo $o->auto_result($success);
	}
	public function report()
	{
		$data = array(
			'title_page_big'		=> 'Report Quality Control',
			'title'					=> $this->title,
		);
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');

		if (isset($_GET['start']) && isset($_GET['end'])) {

			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}
		$this->template->load('qc/report_ajax', $data);
	}
	function get_data_list_report()
	{
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];


			$data['data_qc'] = $this->qc->get_results(array('DATE(lup) >=' => $start_filter, 'DATE(lup) <=' => $end_filter));
		}
		$this->load->view('qc/list_area_report', $data);
	}
	function filter_by_value($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				$temp[$key] = $array[$key][$index];

				if ($temp[$key] == $value) {
					$newarray[$key] = $array[$key];
				}
			}
		}
		return $newarray;
	}
};
