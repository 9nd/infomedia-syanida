<div class="col-sm-12 col-lg-12">
Template ini menggunakan Framework <b>CodeIgniter Version 3.1.9</b>
<br>

dilengkapi dengan fitur :

  <ul class="">
	  <li> Registrasi URL</li>
	  <li> Menu Management</li>
	  <li> Level Akses</li>
	  <li> User Konfigurasi</li>
	  <li> YBS CRUD Generator</li>
  </ul>
  <br> 
  <br> 
agar anda dapat menggunakan fitur diatas secara otomatis <br>
maka anda harus mengikut panduan berikut dalam pembuatan sistem aplikasi :
<br> 
<br>
<b>Tingkat Dasar :</b>  
  <ul class="">
	  <li><a href="#membuat-form">Membuat Form</a></li>
			<ul class="">
				<li><a href="#desain-view">  Desain View</a></li>
				<li><a href="#create-controller">  Create Controller</a></li>
				<li><a href="#default-content-controller">  Isi default file controller</a></li>
				<li><a href="#default-content-user-login">  Data User Login</a></li>
			</ul>
	  <li><a href="#registrasi-url">  Registrasi URL Form</a></li>
	  <li><a href="#membuat-menu">  Buat Menu Baru / Update Menu.(Optional)</a></li>
	  <li><a href="#konfigurasi-level">  Konfigurasi Level Akses</a></li>
  </ul>


<br>
<b>Tingkat Lanjut :</b> 
  <ul class="">
	  <li><a href="<?php echo $link_tahap_lanjut?>" target="_blank">Data Proses : Ajax Request menggunakan Object ybsRequest</a></li>
			<ul class="">
				<li><a href="<?php echo $link_tahap_lanjut?>#object-request" target="_blank">  Membuat Object Request</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#type-get" target="_blank"> Menjalankan Request type GET</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#type-post" target="_blank"> Menjalankan Request type POST</a></li>
				<li><ul><a href="<?php echo $link_tahap_lanjut?>#type-post" target="_blank"> - manual data</a></ul></li>
				<li><ul><a href="<?php echo $link_tahap_lanjut?>#type-post" target="_blank"> - data form</a></ul></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#modify-action" target="_blank">  Modify Action Setelah Proses Request</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#get-data-in-server" target="_blank">  Proses Penangkapan data pada server</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#send-data-to-client" target="_blank">  Proses Pengiriman data ke Client</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#desain-view" target="_blank">  Desain View</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#create-code-request" target="_blank">  Code Request</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>#create-controller" target="_blank">  Create Controller</a></li>
			</ul>
  </ul>
<br>
<h2 id="membuat-form">Tingkat Dasar</h2>
<h2 id="membuat-form">Tahap 1: Membuat Form.</h2>
<h4 id='desain-view'>A. Desain View</h4>
buka folder : 
<br> 
<code>Application/views/</code>
<br>
buat folder dan file<br>
contoh :	<br>
<ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>mysample</li>
	  <li><a href="javascrip:void(0)">  nama file: </a>sample_view_1.php</li>
</ul>
path:
<code>Application/views/mysample/sample_view_1.php</code>
<br>
isi file :
<code>
Halo.. pesan ini berasal dari file sample_view_1.php
</code>
<br>
<br>
<br>
<h4 id="create-controller">B. Create Controller</h4>
buka folder : 
<br>
 <code>Application/Controllers/</code>
 <br>
 buat folder dan file
 <br>
  contoh :	<br>
 <ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>sample_controller</li>
	  <li><a href="javascrip:void(0)">  nama file: </a>pengaturan_awal.php</li>
</ul>
  <code>Application/Controllers/sample_controller/pengaturan_awal.php</code>
  
 <div class="card-alert alert alert-danger mb-0">
   <small>note: file harus di simpan didalam sub folder Controllers.</small><br>
    <small>ex. Application/Controllers/your_sub_folder/your_file.php</small>
 </div>

 <br>


<br>
	<span id="default-content-controller"><b>Isi default file controller :</b></span>
	<code>
		<<span>?</span>php <br>
		class nama_file extends CI_Controller {
		<br>
		<br>
			
			<ul>public function __construct() {</ul>
			<ul><ul>parent::__construct();</ul></ul>
			<ul>}</ul>
		<br>				
		<br>
		}
		<br>	
	</code>
<br>
<span id="">contoh isi file controller :</span>
	<code>
		<<span>?</span>php <br>
		class pengaturan_awal extends CI_Controller {
		<br>
		<br>
			
			<ul>public function __construct() {</ul>
			<ul><ul>parent::__construct();</ul></ul>
			<ul>}</ul>
		<br>				
		<br>
		}
		<br>	
	</code>	
<div class="card-alert alert alert-danger mb-0">
   <small>note: nama class harus sama dengan nama file,<br>
   dalam contoh ini nama class dan nama file adalah "pengaturan_awal"</small>
</div>

<br>
<span id="default-content-user-login"><b>Controller - Data Standar User Login :</b></span>
<span>anda dapat mengambil data user login tanpa perlu melakukan query lagi.</span>
<code>
	
	<ul>$this->_user_id;</ul>
	<ul>$this->_user_name;</ul>
	<ul>$this->_user_picture;</ul>
	<ul>$this->_user_level_id;</ul>
	<ul>$this->_user_level_name;</ul>
	<ul>$this->_user_form_id;</ul>
	<ul>$this->_user_form_code;</ul>
	<ul>$this->_user_form_name;</ul>
	<ul>$this->_user_form_shortcut;</ul>
	<ul>$this->_is_dashboard;</ul>
	<ul>$this->_token;</ul>

</code>

<br>
file controller berfungsi untuk meload halaman view.
<br>
untuk itu maka pada controller tambahkan fungsi meload file view yang tadi kita buat.<br>
<code>
			<ul>public function tampilkan_view_awal() {</ul>
			<ul><ul>$data = array();</ul></ul>
			<ul><ul>$data['title_page_big'] = 'SAMPLE PENGATURAN AWAL';</ul></ul>
			<ul><ul>$data['pesan'] = 'ini pesan dari controller';</ul></ul>
			<ul><ul>$this->template->load('mysample/sample_view_1',$data);</ul></ul>
			
			
			
			<ul>}</ul>

</code>
<br>
penjelasan singkat :
<br>
<br>
<b>public function tampilkan_view_awal()</b>
adalah fungsi untuk menampilkan view,yang akan di panggil/di exekusi melalui url..<br>
<code>http://yourdomain/project_name/sub_folder_controller/file_controller/function</code>
<br>
maka url pemanggilan:
<br>
<code>http://localhost/ybs-public/sample_controller/pengaturan_awal/tampilkan_view_awal</code>

<br>
<br>
<b>$data = array()</b>
digunakan untuk mengirim variable ke file view.
<br>
<br>
<b>$data['title_page_big']</b> 
merupakan variable title halaman yang akan dikirim file view.
<br>
<br>
<b>$data['pesan']</b> 
merupakan variable tambahan yang akan di kirim ke file view.
<br>
<br>
<b>$this->template->load("mysample/sample_view_1",$data)</b>
<span>fungsi ini meload file view yang berada pada folder <b>views/mysample/sample_view_1.php</b></span>
<span>dan mengirim <b>$data</b> ke file view tersebut.</span>
 
<br>
isi file controller : 
<code>
		<<span>?</span>php <br>
		class pengaturan_awal extends CI_Controller {
		<br>
		<br>
			
			<ul>public function __construct() {</ul>
			<ul><ul>parent::__construct();</ul></ul>
			<ul>}</ul>
		<br>	
			<ul>public function tampilkan_view_awal() {</ul>
			<ul><ul>$data = array();</ul></ul>
			<ul><ul>$data['title_page_big'] = 'SAMPLE PENGATURAN AWAL';</ul></ul>
			<ul><ul>$data['pesan'] = 'pesan ini dari controller';</ul></ul>
			<ul><ul>$this->template->load('mysample/sample_view_1',$data);</ul></ul>
			<ul>}</ul>
		<br>				
		<br>
		
		
		}
		<br>
			

</code> 
<br>
revisi isi file sample_view_1.php  :<br>
untuk menampilkan variable pesan yang dikirim dari controller
<code>
Halo.. pesan ini berasal dari file sample_view_1.php
<br>
<<span>?php echo $pesan;?></span>
</code> 
 


<br>
<br>
<br>
<h2 id="registrasi-url">Tahap 2: Registrasi URL/Form.</h2>
 <div class="card-alert alert alert-danger mb-0">
   <small>note:</small><br>
   <small>- <b>url/form, yang tidak di registrasi akan bersifat public dan dapat di akses oleh semua user account </b></small>
 </div>
<br>
login dengan accout configurator,
<br>
lalu masuk ke menu :<code>pengaturan > sistem > registrasi url > registrasi baru</code>
<br>
<br>
pilih folder controller <code>sample_controller</code>
<br>
pilih file <code>pengaturan_awal</code>
<br>
pilih function <code>tampilkan_view_awal</code>
<br>
<b>Nama url form</b>
<span>Masukkan Nama form /nama alias dari url link yang di gunakan.(bebas)</span>
<br>
<b>Kode URL / Form</b>
<span>Masukkan Kode URL / Form (3 - 4 digit)..<br>
sebaiknya huruf /angka / gabungan huruf dan angka.
<br>
kode ini berfungsi untuk pengembangan selanjutnya.</span>
<br>
<b>Shortcut</b>
yes ,dapat diakses langsung melalui header menu <br>
no, tidak dapat di akses langsung melalui header menu..<br>
contoh : <span>pilihan <b>no</b>,, pada form yang memiliki parameter pengiriman,</br> 
yang harus melalui proses terlebih dahulu (form update,delete..)  </span>
<br>

<br>
<br>
<h2 id="membuat-menu">Tahap 3: Membuat Menu Baru/Update Menu.</h2>
setelah berhasil melakukan registrasi url,
<br> 
maka selanjutnya membuat menu baru jika url/form tersebut 
<br>
di izinkan untuk di akses melalui header menu. 
<br>
<br>
masuk ke menu :<code>pengaturan > sistem > menu management > Buat menu baru</code>
<br>
saya menganggap anda sudah paham menu tersebut..hehe..
<br>
<code>bla..bla..setuju ..simpan..ok</code>
menu yang berhasil dibuat secara otomatis terpasang pada account configurator

<br>
<br>
<br>
<br>
<h2 id="konfigurasi-level">Tahap 4: Konfigurasi Level Akses.</h2>
membuat level akses menu dan url 
<br>
masuk ke menu :<code>pengaturan > sistem > level konfigurasi > Buat baru</code>
atau update level dengan menekan tombol update pada table
<br>
saya menganggap anda sudah paham menu tersebut..hehe..
<br>
<code>bla..bla..setuju ..simpan..ok</code>
<span>pada <b>pilihan Otorisasi Menu</b>, menu yang di pilih adalah menu yang akan di tampilkan,
<br>
pada level tersebut.</span>
<br>
Level yang berhasil di buat nantinya tinggal di pasangkan pada user Account.
<br>
 <div class="card-alert alert alert-danger mb-0">
   <small>note:</small><br>
   <small>- menu, url/form sistem, dan status aktif  pada Level Configurator tidak dapat di ubah </small><br><br>
   <small>- otorisasi menu hanya untuk show hide menu,bukan pembatasan akses,,artinya jika url di akses melalui addressbar browser,maka url tersebut dapat di buka
   <br> oleh karena itu untuk pembatasan menu harus juga dilakukan pembatasan url/form..</small><br><br>
 </div>











</div>
