

<div style="font-size:14px">
<b>Tingkat Dasar :</b>  
  <ul class="">
	  <li><a href="#membuat-form">Membuat Form</a></li>
			<ul class="">
				<li><a href="#desain-view">  Create File View</a></li>
				<li><a href="#create-controller">  Create File Controller</a></li>
				<li><a href="#default-content-user-login">  Data User Login</a></li>
			</ul>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/registrasi_form">  Registrasi URL Form</a></li>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/pengaturan_menu">  Buat Menu Baru / Update Menu.(Optional)</a></li>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/level_konfigurasi">  Konfigurasi Level Akses</a></li>
  </ul>

  
<br>
<b>Tingkat Lanjut :</b> 
  <ul class="">
	  <li><a href="<?php echo $link_tahap_lanjut?>/#tingkat-lanjut" >Ajax Request menggunakan Object ybsRequest</a></li>
			<ul class="">
				<li><a href="<?php echo $link_tahap_lanjut?>/#type-get" >  Akses ke server (Request GET)</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#type-post" > Mengirim data ke server (Request POST)</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#modify-action" >  Menambahkan Aksi Setelah Proses Request</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#get-data-in-server" >  Menangkap data di server (type GET)</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#post-data-in-server" >  Menangkap data di server (type POST)</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#send-data-to-client" >  Mengirim data ke Client</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#redirect-page" >  Mengalihkan Halaman (Redirect Page)</a></li>
				<li><a href="<?php echo $link_tahap_lanjut?>/#contoh-penggunaan" >  Contoh Penggunaan</a>
					<ul>
						<li><a href="<?php echo $link_tahap_lanjut?>/#contoh-a" >1.  Sample Form A</a></li>
						<li><a href="<?php echo $link_tahap_lanjut?>/#contoh-b" >2.  Sample Form B</a></li>
						<li><a href="<?php echo $link_tahap_lanjut?>/#contoh-c" >3.  Sample Form C</a></li>
					</ul>
				</li>
			</ul>
  </ul>
<br> 
  
<h2 id="membuat-form"><u>TINGKAT DASAR</u></h2>
<h4 id="membuat-form">TAHAP 1:  MEMBUAT FORM.</h4><br>
<h4 id='desain-view'>A. Desain View</h4>

buat folder dan file view.<br>
contoh :	
<ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a><span class="tag tag-indigo" style="font-size:10px">mysample</span></li>
	  <li><a href="javascrip:void(0)">  nama file: </a><span class="tag tag-indigo" style="font-size:10px">sample_view_1.php</span></li>
</ul>
path :   <br>
<code>Application/views/mysample/sample_view_1.php</code>
<br> 
<br>   
isi file : 
<b>
<pre data-enlighter-language="php" data-enlighter-highlight="5">
&lth1>FILE VIEW&lt/h1>
&ltp>Halo.. pesan ini berasal dari file sample_view_1.php &lt/p>

</pre> 
</b>
<br> 
<br>
<h4 id="create-controller">B. Create Controller</h4>

buat folder dan file Controller.
<br>
 contoh :	
 <ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>sample_controller</li>
	  <li><a href="javascrip:void(0)">  nama file: </a>pengaturan_awal.php</li>
</ul>
path : <br>
<code>Application/Controllers/sample_controller/pengaturan_awal.php</code>
  


 <br>  

<br>
<span id="">isi file :</span> 

<pre data-enlighter-language="php" data-enlighter-highlight="5">

&lt?php

class pengaturan_awal extends CI_Controller {
		
	public function __construct() {
		parent:: __construct();
	}
	
	
}
</pre>  

<div class="card-alert alert alert-danger mb-0">
   <small>note: nama class harus sama dengan nama file,<br>
   dalam contoh ini  <span class="tag tag-indigo">NAMA CLASS</span> dan <span class="tag tag-indigo">NAMA FILE</span> adalah <span class="tag tag-indigo">pengaturan_awal</span></small>
</div>
 
<br>
salah satu fungsi controller adalah untuk meload view.<br>
<br>
untuk itu maka pada controller tambahkan fungsi <br>
meload file view yang telah di buat sebelumnya.<br>	
<br>
<pre data-enlighter-language="php" data-enlighter-highlight="5">

&lt?php

class pengaturan_awal extends CI_Controller {
		
	public function __construct() {
		parent:: __construct();
	}
	
	public function tampilkan_view_awal() {
		$data = array();
		$data['title_page_big'] = 'SAMPLE PENGATURAN AWAL';
		$data['pesan'] = 'ini pesan dari controller';
		$this->template->load('mysample/sample_view_1',$data);	
	}

}
</pre>


<br>
penjelasan singkat :
<br>
<br>
<span class="tag tag-indigo">public function tampilkan_view_awal()</span><br>
adalah fungsi untuk menampilkan view,<br>
yang akan di panggil melalui url :<br>
<code>http://localhost/ybs-public/sample_controller/pengaturan_awal/tampilkan_view_awal</code><br><br>


<br>
<br>
<span class="tag tag-indigo">$data = array()</span><br>
digunakan untuk mengirim variable ke file view.
<br>
<br>
<span class="tag tag-indigo">$data['title_page_big']</span><br>
merupakan variable title halaman yang akan dikirim file view.
<br>
<br>
<span class="tag tag-indigo">$data['pesan']</span><br>
merupakan variable tambahan yang akan di kirim ke file view.
<br>
<br>
<span class="tag tag-indigo">$this->template->load("mysample/sample_view_1",$data)</span><br>
<span>fungsi ini meload file view yang berada <br>
pada folder <b>views/mysample/sample_view_1.php</b></span>
<span>dan <br>
mengirim <b>$data</b> ke file view tersebut.</span><br><br>


<br>
revisi isi file <span class="tag tag-indigo">views/mysample/sample_view_1.php</span> <br>
untuk menampilkan variable pesan yang dikirim dari controller


<pre data-enlighter-language="php" data-enlighter-highlight="5">
	<h1>FILE VIEW</h1>
	<p>Halo.. pesan ini berasal dari file sample_view_1.php</p>
	&lt?php echo $pesan ;?>
</pre> 
<br>
<br>
<b><u>Complite Sample code :</u></b><br><br>
CONTROLLER : Application/Controllers/sample_controller/pengaturan_awal.php <br>
<pre data-enlighter-language="php" data-enlighter-highlight="5">

&lt?php

class pengaturan_awal extends CI_Controller {
		
	public function __construct() {
		parent:: __construct();
	}
	
	public function tampilkan_view_awal() {
		$data = array();
		$data['title_page_big'] = 'SAMPLE PENGATURAN AWAL';
		$data['pesan'] = 'ini pesan dari controller';
		$this->template->load('mysample/sample_view_1',$data);	
	}

}
</pre>
VIEW : Application/views/mysample/sample_view_1.php
<br>
<pre data-enlighter-language="php" data-enlighter-highlight="5">
	<h1>FILE VIEW</h1>
	<p>Halo.. pesan ini berasal dari file sample_view_1.php</p>
	&lt?php echo $pesan ;?>
</pre> 


<br>









YBS Sistem di lengkapi dengan <br>
<span id="default-content-user-login"><b>Data Standar User Login :</b></span>
<span>anda dapat mengambil data user login tanpa perlu melakukan query lagi.</span>  

	<ul>
	<li>$this->_user_id;</li>
	<li>$this->_user_name;</li>
	<li>$this->_user_picture;</li>
	<li>$this->_user_level_id;</li>
	<li>$this->_user_level_name;</li>
	<li>$this->_user_form_id;</li>
	<li>$this->_user_form_code;</li>
	<li>$this->_user_form_name;</li>
	<li>$this->_user_form_shortcut;</li>
	<li>$this->_is_dashboard;</li>
	<li>$this->_token;</li>
	</ul>



	
	
	
	
	
	
	
	
	
	
  
</div><br>



