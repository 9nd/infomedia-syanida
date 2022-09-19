<?php echo _css("dropzone") ?>
<?php echo _css('datatables,icheck') ?>
<?php echo _css('selectize,datepicker') ?>
<?php echo card_open('Form', 'bg-green', true) ?>
<div class="row">
    <div class="col-sm-3">
        <form action="<?php echo base_url() ?>Pengajuan_absen/Pengajuan_absen/insertdata" method="post"
            enctype="multipart/form-data">
            <div class='form-group'>
                <label class='form-label'>Agent Name</label>
                <div class='form-group'>
                    <input readonly type='text' class='form-control data-sending '
                        value='<?php echo $userdata->agentid . "-" . $userdata->nama ?>'>
                    <input hidden type='text' class='form-control data-sending' id='agentid' name='agentid'
                        value='<?php echo $userdata->agentid ?>'>
                </div>
            </div>

            <div class='form-group'>
                <label class='form-label'>Status</label>
                <div class='form-group'>
                    <select class='form-control data-sending' name="stts" id="stts">
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                    </select>
                </div>

            </div>

            <div class='form-group'>
                <label class='form-label'>Date</label>
                <div class='input-group'>
                    <span class='input-group-prepend' id='basic-addon1'>
                        <span class='input-group-text'><i class="fa fa-calendar"></i></span>
                    </span>
                    <input class='form-control data-sending input-simple-date' id='waktu_in' name="waktu_in">
                </div>
            </div>

            <div class='form-group'>
                <label class='form-label'>Photo <small><i>Max. 1 MB (1024 KB)</i></small></label>
                <input type="file" class='form-control data-sending focus-color' id="photo" name="photo">
                <!-- <input type='text' class='form-control data-sending focus-color' id='no_ktp' name='no_ktp' placeholder='' value='<?php if (isset($data)) echo $data->no_ktp ?>' autocomplete='off'> -->
            </div>

            <div class='form-group'>
                <label class='form-label'>Reason</label>
                <textarea class='form-control data-sending focus-color' id="reason" name="reason">test</textarea>
                <!-- <input type='text' class='form-control data-sending focus-color' id='no_ktp' name='no_ktp' placeholder='' value='<?php if (isset($data)) echo $data->no_ktp ?>' autocomplete='off'> -->
            </div>
            <div class='form-group text-right'>
                <input type='submit' class='btn btn-primary' value="Tambah Pengajuan">
            </div>


        </form>

    </div>
    <div class="col-sm-9">
        <table class='display responsive nowrap' id="example" style="width: 100%;">
            <thead>
                <tr>
                    <th><b>No</b></th>
                    <th><small>Status Approve by TL</small></th>
                    <th><small>Status Approve by Admin</small></th>
                    <th><b>Name</b></th>
                    <th><b>TL</b></th>
                    <th><b>Category</b></th>
                    <th><b>Date</b></th>
                    <th><b>Photo</b></th>
                    <th><b>Reason</b></th>
                    <?php
					if ($userdata->opt_level == 11 || $userdata->opt_level == 1 || $userdata->opt_level == 9) {
						echo "<th><b>Opsi</b></th>";
					}
					?>
                </tr>
            </thead>
            <tbody>
                <?php
				$nomor = 1;

				if ($query->num_rows() > 0) {
					foreach ($query->result_array() as $datana) {
						

				?>
                
                <tr class="bg bg-<?php
								if ($datana['approve_tl'] == 'Approved' && $datana['approve_adm'] == 'Approved') {
									echo "success";
								} else if ($datana['approve_tl'] == 'Not Approve' && $datana['approve_adm'] == 'Not Approve') {
									echo "pink";
								}; ?>">
                    <td><?php echo $nomor; ?></td>
                    <td><?php
								if ($datana['approve_tl'] == null) {
									echo "<span class='fa fa-clock'></span> On Check";
								} else if($datana['approve_tl'] == "Not Approve") {
									echo "<span class='fa fa-close'></span> ".$datana['approve_tl'];
								} else if ($datana['approve_tl'] == "Approved"){
									echo "<span class='fa fa-check'></span> ".$datana['approve_tl'];
								}; ?></td>
                    <td><?php
								if ($datana['approve_adm'] == null) {
									echo "<span class='fa fa-clock'></span> On Check";
								} else if($datana['approve_adm'] == "Not Approve") {
									echo "<span class='fa fa-close'></span> ".$datana['approve_adm'];
								} else if ($datana['approve_adm'] == "Approved"){
									echo "<span class='fa fa-check'></span> ".$datana['approve_adm'];
								}; ?></td>
                    <td><?php echo $datana['nama']; ?></td>
                    <td><?php
								$agen = $datana['agentid'];
								$datanya = $Sys_user_table_model->live_query("SELECT * FROM sys_user WHERE agentid = '$agen' ")->row();

								// echo var_dump($datanya);
								echo $datanya->tl;
								?></td>
                    <td><?php echo $datana['stts']; ?></td>
                    <td><?php echo $datana['tanggal']; ?></td>
					<td><a href="<?php echo base_url() . "YbsService/get_foto_absent_submission/" .$datana['picture']; ?>" target="_blank"><span class="fa fa-download"></span></a></td>	
                    <td><?php echo $datana['reason']; ?></td>

                    <?php
							if ($userdata->opt_level == 11 || $userdata->opt_level == 1) {


							?>

                    <td><a
                            href="<?php echo base_url(); ?>Pengajuan_absen/Pengajuan_absen/approve/<?php echo $datana['id']; ?>"><button
                                id="approve" class="btn btn-outline-primary btn-sm">
                                <span class="fa fa-check"></span>
                            </button></a>

                        <a
                            href="<?php echo base_url(); ?>Pengajuan_absen/Pengajuan_absen/notapprove/<?php echo $datana['id']; ?>"><button
                                class='btn btn-outline-danger btn-sm'>
                                <span class='fa fa-times'></span>
                            </button></a></td>

                    <?php
							}else if($userdata->opt_level == 9 || $userdata->opt_level == 1){
								?>

                    <td><a
                            href="<?php echo base_url(); ?>Pengajuan_absen/Pengajuan_absen/approvetl/<?php echo $datana['id']; ?>"><button
                                id="approve" class="btn btn-outline-primary btn-sm">
                                <span class="fa fa-check"></span>
                            </button></a>

                        <a
                            href="<?php echo base_url(); ?>Pengajuan_absen/Pengajuan_absen/notapprovetl/<?php echo $datana['id']; ?>"><button
                                class='btn btn-outline-danger btn-sm'>
                                <span class='fa fa-times'></span>
                            </button></a></td>

                    <?php
							}
							?>
                </tr>
                <?php
				
						$nomor++;
					}
				} else {
					echo "<td colspan='10'>Tidak ada data</td>";
				}
				?>
            </tbody>
        </table>
    </div>
</div>

<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>
<?php echo _js('selectize,datepicker') ?>
<?php echo _js("ybs,dropzone") ?>
<script>
dropzone_area({
    elementID: "#my_dropzone", //--> element id 
    type: "image", //--> type file 
    autosave: false, //--> autosave to destination 
    allowRemoveFile: false, //--> allow remove file in server when autosave is true 
    max_files: 10, //--> Max file upload on page 
    max_size: 100, //--> max..Mb/file 
});



//script ini hanya digunakan jika menggunakan autosave= false 
//jalankan script ini dalam sebuah action baru.
//script ini menyimpan file secara permanent,jalankan jika semua proses insert data telah selesai 
</script>
<script>
var page_version = "1.0.8"
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
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
    format: 'yyyy-mm-dd',
})


$('#btn-save').click(function() {
    simpan();
})
$('#approve').click(function() {
    simpan();
})
$('#notapprove').click(function() {
        simpan();
    })


    // function simpan() {
    // 	dropzone_save("#my_dropzone");
    // 	<?php
    // 	/* mengambil data yang akan di kirim dari form-a */
    // 	/* dalam bentuk array json tanpa penutup.. */
    // 	/* memungkinkan penambahan data dengan cara push */
    // 	/* ex. data.push */
    // 	
    ?>
    // 	var data = get_dataSending('form-a');


    // 	<?php
    // 	/* complite json format */
    // 	/* ybs_dataSending(array); */
    // 	
    ?>
// 	send_data = ybs_dataSending(data);
// 	var a = new ybsRequest();
// 	// var tm = $("#my_dropzone").attr("data-time")
// 	// window.alert(tm)
// 	a.process('<?php echo $link_save ?>', send_data, 'POST');

// 	a.onAfterSuccess = function() {
// 		cancel();

// 	}
// 	a.onBeforeFailed = function() {
// 		cancel();
// 	}
// }
</script>