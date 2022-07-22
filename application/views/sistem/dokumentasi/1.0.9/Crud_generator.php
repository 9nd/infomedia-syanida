
<div style="font-size:14px">
<span class="tag tag-indigo" style="font-size:10px">CRUD Generator</span> digunakan untuk menggenerate form berdasarkan database yang ada.<br>
hasil generate berupa :<br>
- 1 file controller<br>
- 1 file config <br>
- 1 file model<br>
- 1 file view form create-update<br>
- 1 file view list data<br><br>

untuk menggunakan <span class="tag tag-indigo" style="font-size:10px">CRUD Generator</span> pastikan Database anda mengikuti aturan berikut:<br><br>
1. Table data base harus memiliki <span class="tag tag-indigo" style="font-size:10px">Field Primary Key</span> dengan : <br>
<ul>
	<li>nama field "id"</li>
	<li>bertype int or double</li>
	<li>dan autoincreament"</li>
</ul>

2. Nama field dan database <span class="tag tag-indigo" style="font-size:10px">HANYA BOLEH</span> menggunakan karakter (a-z) dan underscore "_" <br>
<span class="tag tag-red" style="font-size:10px">JANGAN MENGGUNAKAN</span> karakter lainnya termasuk spasi.<br><br>
3. Table tidak bisa join ke dirinya sendiri. <br><br>
4. Relasi antar table menggunakan field "id" . <br><br>

<br><br>


Untuk menggunakan CRUD Generator anda dapat mengikuti langkah berikut :<br><br>
</div>

<div class="alert alert-icon alert-success" role="alert">
  <i class="fe fe-check mr-2" aria-hidden="true"></i>1. Pilih Menu > Sistem
</div>

<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/1.png" style="border:1px solid black">

<br>
<br>
<br>
<br>
<div class="alert alert-icon alert-success" role="alert">
  <i class="fe fe-check mr-2" aria-hidden="true"></i>2. Pilih CRUD Generator
</div>

<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/33.png" style="border:1px solid black">

<br>
<br>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/34.png" style="border:1px solid black">

<br>
<br>
<br>
<br>
<a href="javascript:void(0)" class="btn btn-success">PENJELASAN FORM CRUD GENERATOR</a>
<br>
<br>
<h3 class="text-mute"><b>A. Pilih Table Database</b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/35.png" style="border:1px solid black">
<br>
<br>
<div style="font-size:14px">
Pilih database yang akan di generate,pastikan sudah mengikuti aturan di atas.
</div>
<br>
<br>

<h3 class="text-mute"><b>B. Folder Name</b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/36.png" style="border:1px solid black">
<br>
<br>

<div style="font-size:14px">
Masukkan nama folder tempat penyimpanan output file generate,<br>
- folder ini akan dibuat secara otomatis saat dilakukan generate database,<br>
- folder ini akan menjadi <span class="tag tag-indigo"  style="font-size:10px">SUB FOLDER</span> pada folder <span class="tag tag-indigo"  style="font-size:10px">CONTROLLER</span> ,   
<span class="tag tag-indigo"  style="font-size:10px">VIEW</span> dan  <span class="tag tag-indigo"  style="font-size:10px">MODEL</span>
</div>

<br>
<br>

<h3 class="text-mute"><b>C. File Name</b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/37.png" style="border:1px solid black">
<br>
<br>

<div style="font-size:14px">
Masukkan nama file <br>
Nama ini digunakan untuk :<br>
<ul>
	<li><span class="tag tag-indigo"  style="font-size:10px">NAMA FILE CONTROLLER</span></li>
	<li><span class="tag tag-indigo"  style="font-size:10px">NAMA DEPAN FILE VIEW</span></li>
	<li><span class="tag tag-indigo"  style="font-size:10px">NAMA DEPAN FILE MODEL</span></li>
</ul>

</div>

<br>
<br>

<h3 class="text-mute"><b>E. Output URL</b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/38.png" style="border:1px solid black">
<br>
<br>

<div style="font-size:14px">
URL yang nanti nya akan di gunakan. <br>
<br>
Contoh URL di atas : <br>
FOLDER NAME = Sample_karyawan<br>
FILE NAME = Sample_karyawan<br>


</div>

<br>
<br>

<h3 class="text-mute"><b>F. Pilih sistem validasi </b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/39.png" style="border:1px solid black">
Contoh table :   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span>
<br>
<br>

<div style="font-size:14px">
Validasi input data di lakukan di controller. <br> <br>
FIELD NAME merupakan FIELD dari TABLE DATABASE yang di Generate<br><br>
DATA KEMBAR 
<ul>
	<li>CEGAH : Mencegah Field Table Database tersebut di isi dengan data yang sama.</li>
	<li>IZINKAN : Mengizinkan Field Table Database tersebut di isi dengan data yang sama.</li>
</ul>

DATA KOSONG 
<ul>
	<li>CEGAH : Mencegah Field Table Database tersebut tidak di isi/ di isi dengan data kosong.</li>
	<li>IZINKAN : Mengizinkan Field Table Database tersebut tidak di isi/ di isi dengan data kosong.</li>
</ul>

</div>


<br>
<br>

<h3 class="text-mute"><b>G. Pilih join table </b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/40.png" style="border:1px solid black">
Contoh table :   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span>
<br>
<br>

<div style="font-size:14px">
Pilih FIELD dan TABLE yang akan di joinkan.<br>
<br>
<ul>
	<li>FIELD NAME : Field Table</li>
	<li>JOIN TABLE : Table yang akan di joinkan dengan Field yang bersangkutan</li>
	<li>*FIELD SHOW : Field yang akan di tampilkan pada  <span class="tag tag-indigo" style="font-size:10px">FORM CREATE-UPDATE</span></li>
	<li>TYPE INPUT : Type Element Input pada <span class="tag tag-indigo" style="font-size:10px">FORM CREATE-UPDATE</span></li>
	<li>ALIAS TABLE JOIN : Nama Alias Table, dibutuhkan untuk Query SQL pada <span class="tag tag-indigo" style="font-size:10px">FILE MODEL</span></li>
</ul>
Contoh :   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span><br>
DATA FIELD SHOW akan di tampilkan pada Combobox <span class="tag tag-indigo" style="font-size:10px">FORM CREATE-UPDATE</span>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/41.png" style="border:1px solid black">
</div>

<br>
<br>

<h3 class="text-mute"><b>H. Alias Field Form </b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/42.png" style="border:1px solid black">
Contoh table :   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span>
<br>
<br>

<div style="font-size:14px">
<ul>
	<li>TITLE ALIAS FORM : Title yang akan di gunakan di setiap form</li>
</ul>
Title ini dapat di set juga setelah form di generate,<br>
pengaturan title ada pada <span class="tag tag-indigo" style="font-size:10px">FILE CONFIG CONTROLLER</span> yang bersangkutan.<br><br>
Contoh Title pada  : <span class="tag tag-indigo" style="font-size:10px">FORM CREATE-UPDATE</span>   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span><br>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/43.png" style="border:1px solid black">
<br><br>
Contoh Title pada  : <span class="tag tag-indigo" style="font-size:10px">FORM LIST DATA</span>   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span><br>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/44.png" style="border:1px solid black">

<br><br>
Contoh Pengaturan TITLE Manual pada  : <span class="tag tag-indigo" style="font-size:10px">FILE Config Controller</span>   <span class="tag tag-indigo" style="font-size:10px">sample_karyawan</span><br>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/45.png" style="border:1px solid black"><br>
lokasi file Application/controller/your subfolder/yourfile_config.php
</div>


<br>
<br>

<h3 class="text-mute"><b>I. Tampilkan data CRUD untuk semua user </b></h3>
<img class="ybs-image-slider" data-image="crud_generator" src="<?php echo base_url()?>images/dokumentasi/46.png" style="border:1px solid black">

<br>
<br>
<div style="font-size:14px">
<span class="tag tag-green" style="font-size:10px">YA , TAMPILKAN</span> : CRUD Data bersifat <span class="tag tag-indigo" style="font-size:10px">PUBLIC</span> dapat di lihat/update/hapus oleh user yang memiliki otorisasi yang sama.<br>
contoh : <span class="tag tag-indigo"  style="font-size:10px">DATA PENJUALAN</span>,<span class="tag tag-indigo"  style="font-size:10px">DATA PEMBELIAN</span>,Data ini dapat di input,edit ,delete oleh user yang memiliki otorisasi yang sama
<br><br>
<span class="tag tag-red" style="font-size:10px">TIDAK</span> : CRUD Data bersifat <span class="tag tag-indigo" style="font-size:10px">PRIVATE</span>, hanya user yg melakukan input yang dapat melihat/update/hapus.<br>
contoh : <span class="tag tag-indigo"  style="font-size:10px">DATA CUTI KARYAWAN</span>,<span class="tag tag-indigo"  style="font-size:10px">DATA PINJAMAN KARYAWAN</span>,<span class="tag tag-indigo"  style="font-size:10px">DATA ABSENSI KARYAWAN</span> data ini hanya dapat di lihat dan di edit oleh user yang bersangkutan.
<br><br>
<br><br>

<span class="tag tag-green" style="font-size:10px">TIPS MEMBUAT FORM LIST DATA BERJENJANG :</span><br><br>
FORM LIST DATA BERJENJANG adalah <br>
FORM  yang mana DATA nya hanya dapat di lihat oleh :<br>
- user yang bersangkutan, <br>
- dan oleh Atasan / pimpinan / yang di berikan wewenang<br><br>

Langkah : 
<ul>
	<li>Generate Table Database dengan <span class="tag tag-indigo" style="font-size:10px">PRIVATE</span> CRUD</li>
	tujuannya agar setiap user hanya dapat melihat data masing-masing.<br>
	<li>Berikan Otorisasi FORM PRIVATE untuk semua user / sesuai kebutuhan</li>
	<li>Generate Table Database untuk kedua kali nya dengan nama file yang berbeda dan  <span class="tag tag-indigo" style="font-size:10px">PUBLIC</span> CRUD</li>
	<li>Berikan Otorisasi FORM PUBLIC hanya untuk Atasan / pimpinan / yang di berikan wewenang</li>
</ul> 

</div>