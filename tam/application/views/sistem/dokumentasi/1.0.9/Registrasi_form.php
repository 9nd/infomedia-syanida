<br>
<div style="font-size:14px">
Agar <b><u>form / url function</u></b> dapat digunakan <br>
dalam sistem otorisasi  dan pengaturan menu,<br>
maka form harus di <b>registrasi</b> terlebih dahulu .
</div>
<br>
<br>

<div style="font-size:14px">
<b><u>form / url function</u></b> yang tidak di registrasi <br>
akan bersifat public, dan dapat diakses oleh semua user login<br>
tanpa batasan
</div>
<br>
<br>

<div style="font-size:14px">
untuk melakukan registrasi :
</div>
<br>
<br>


<div class="alert alert-icon alert-success" role="alert">
  <i class="fe fe-check mr-2" aria-hidden="true"></i>1. Pilih Menu > Sistem
</div>

<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/1.png" style="border:1px solid black">

<br>
<br>
<br>
<br>


<div class="alert alert-icon alert-success" role="alert">
  <i class="fe fe-check mr-2" aria-hidden="true"></i>2. Klik Registrasi URL / FORM
</div>

<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/11.png" style="border:1px solid black">
<br>
<br>
<br>
<br>

<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/12.png" style="border:1px solid black">
<br>
<br>
<br>
<br>

<div class="alert alert-icon alert-success" role="alert">
  <i class="fe fe-check mr-2" aria-hidden="true"></i>3. Klik Registrasi Baru
</div>

<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/12.png" style="border:1px solid black">
<br>
<br>
<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/14.png" style="border:1px solid black">
<br>
<br>
<br>
<br>
<a href="javascript:void(0)" class="btn btn-success">PENJELASAN FORM REGISTRASI URL</a>
<br>
<br>
<h3 class="text-mute"><b>A. Folder Controller</b></h3>
<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/15.png" style="border:1px solid black">
<br>
<br>
<div style="font-size:14px">
pilih folder yang menampung file controller yang akan di register.<br>
jika berhasil maka akan muncul pilihan file pada  combobox <b>File--Function</b>
</div>
<br>
<br>
<h3 class="text-mute"><b>B. File -- Function</b></h3>
<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/16.png" style="border:1px solid black">
<div style="font-size:14px">
( contoh file hasil generate crud generator )
</div>
<br>
<br>
<div style="font-size:14px">
pilih file dan function yang akan di registrasi<br><br>
jika yang di register adalah file hasil  generate crud generator<br>
maka function <b>refresh_table</b> tidak perlu di register.

	<div class='box-body table-responsive'  id='box-table'>
	<br>
	<div style="font-size:14px">
	<b>sample function hasil generate crud generator</b>
	</div>
		<small>
		<table class='table' >
		<thead>
	
            <tr>
			<th>Methode / Function Name</th>
			<th>Fungsi</th>
			<th>Register</th>
            </tr>

        </thead>
		<tbody>
			<tr>
				<td>index</td>
				<td>Meload <span class="tag tag-indigo" style="font-size:10px">Form List Data</span></td>
				<td><span class="tag tag-lime" style="font-size:8px">YES</span></td>
			</tr>
			
			<tr>
				<td>refresh_table</td>
				<td>Meload data table pada <span class="tag tag-indigo" style="font-size:10px">Form List data</span></td>
				<td><span class="tag tag-red" style="font-size:8px">NO</span></td>
			</tr>
			
			<tr>
				<td>create</td>
				<td>Meload <span class="tag tag-indigo" style="font-size:10px">Form Create Data</span></td>
				<td><span class="tag tag-lime" style="font-size:8px">YES</span></td>
			</tr>
			
			<tr>
				<td>create_action</td>
				<td>Menyimpan data saat tombol simpan pada <span class="tag tag-indigo" style="font-size:10px">Form Create Data</span> di tekan</td>
				<td><span class="tag tag-lime" style="font-size:8px">YES</span></td>
			</tr>
			
			<tr>
				<td>update</td>
				<td>Meload <span class="tag tag-indigo" style="font-size:10px">Form Update Data</span></td>
				<td><span class="tag tag-lime" style="font-size:8px">YES</span></td>
			</tr>
			
			<tr>
				<td>update_action</td>
				<td>Menyimpan data saat tombol simpan pada <span class="tag tag-indigo" style="font-size:10px">Form Update Data</span> di tekan</td>
				<td><span class="tag tag-lime" style="font-size:8px">YES</span></td>
			</tr>
			
			<tr>
				<td>delete_multiple</td>
				<td>Menghapus data saat tombol hapus pada <span class="tag tag-indigo" style="font-size:10px">Form List Data</span> di tekan</td>
				<td><span class="tag tag-lime" style="font-size:8px">YES</span></td>
			</tr>
			
		</tbody>
		</table>

		</small>
		</div>



</div>
<br>
<br>
<h3 class="text-mute"><b>C. Nama URL / Form</b></h3>
<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/17.png" style="border:1px solid black">
<br>
<br>
<div style="font-size:14px">
Isi Nama URL / Form,<br>
nama ini akan di tampilkan pada   <span class="tag tag-indigo" style="font-size:10px">Menu Management</span>, dan  <span class="tag tag-indigo" style="font-size:10px">Level Konfigurasi</span> <br>
<br>
<span class="tag tag-green" style="font-size:10px">Tips membuat Nama URL / Form :</span><br><br>
Misal File yang akan di Register Adalah File <b>Master Data</b><br>
1. Gunakan nama file pada awal kalimat, <br>
2. Gunakan  Nama yang mudah di mengerti dari Methode / Function pada Akhir Kalimat<br>
3. Gunakan ":" sebagai pemisah nama file dan fungsi<br>

<div class='box-body table-responsive'  id='box-table'>
	<br>
	<div style="font-size:14px">
	<b>Contoh Pembuatan Nama URL <span class="tag tag-indigo" style="font-size:10px">File  Master Data</span></b>
	</div>
		<small>
		<table class='table' >
		<thead>
	
            <tr>
			<th>Methode / Function Name</th>
			<th>Nama URL / Form</th>
			
            </tr>

        </thead>
		<tbody>
			<tr>
				<td>index</td>
				<td>MASTER DATA : Form List Data</td>
				
			</tr>
			
			
			<tr>
				<td>create</td>
				<td>MASTER DATA : Form Create Data</td>
				
			</tr>
			
			<tr>
				<td>create_action</td>
				<td>MASTER DATA : Tombol Simpan Form Create Data</td>
				
			</tr>
			
			<tr>
				<td>update</td>
				<td>MASTER DATA : Form Update Data</td>
				
			</tr>
			
			<tr>
				<td>update_action</td>
				<td>MASTER DATA : Tombol Simpan Form Update Data</td>
				
			</tr>
			
			<tr>
				<td>delete_multiple</td>
				<td>MASTER DATA : Hapus Data</td>
				
			</tr>
			
		</tbody>
		</table>

		</small>
		</div>
</div>
<br>
<br>

<h3 class="text-mute"><b>D. Kode URL / FORM</b></h3>
<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/18.png" style="border:1px solid black">
<div style="font-size:14px">
kode ini di gunakan untuk mengakses form tanpa harus melalui sebuah menu<br>
kode ini digunakan pada fitur yang akan datang<br><br>
untuk pembuatan kode<br>
- sebaiknya panjang kode 3-4 digit,<br>
- gunakan huruf / angka, <br>
- sebaiknya initial dari Nama URL<br>

 
</div>
<br>
<br>

<h3 class="text-mute"><b>E. Shortcut</b></h3>
<img class="ybs-image-slider" data-image="registrasi_form" src="<?php echo base_url()?>images/dokumentasi/19.png" style="border:1px solid black">
<div style="font-size:14px">
<br>
<span class="tag tag-lime" style="font-size:10px">YES</span> : Untuk Form/Function yang dapat di akses langsung tanpa melalui menu<br><br>
<b>contoh :</b> <span class="tag tag-gray" style="font-size:10px">Form List Data</span>
<span class="tag tag-gray" style="font-size:10px">Form Create Data</span>
<br>
<br>
<br>
<br>
<span class="tag tag-red" style="font-size:10px">NO</span> : Untuk Form/Function yang hanya dapat di akses melalui sebuah menu / form lainnya<br><br>
<b>contoh :</b> <span class="tag tag-gray" style="font-size:10px">Form Update Data</span>
<span class="tag tag-gray" style="font-size:10px">Function Hapus Data</span>
<span class="tag tag-gray" style="font-size:10px">Tombol Simpan Form Create Data</span>
<span class="tag tag-gray" style="font-size:10px">Tombol Simpan Form Update Data</span><br><br>

<span class="tag tag-indigo" style="font-size:10px">Form Update Data</span>
<span class="tag tag-indigo" style="font-size:10px">Function Hapus Data</span>
 tentunya harus memilih terlebih dahulu data yang akan di update / delete,<br>
sehingga untuk menjalankan fungsi tersebut harus mengakses terlebih dahulu sebuah form / menu<br>
yang menyajikan data yang akan di update/delete.<br><br>
<span class="tag tag-indigo" style="font-size:10px">Tombol Simpan Form Create Data</span> tentunya hanya berada pada <span class="tag tag-indigo" style="font-size:10px">Form Create Data</span> 
jadi tidak dapat di akses langsung<br>
tanpa melalui <span class="tag tag-indigo" style="font-size:10px">Form Create Data</span>




</div>
<br>
<br>
		