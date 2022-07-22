

<div style="font-size:14px">
<b>Tingkat Dasar :</b>  
  <ul class="">
	  <li><a href="#membuat-form">Membuat Form</a></li>
			<ul class="">
				<li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/panduan_form/#desain-view">  Create File View</a></li>
				<li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/panduan_form/#create-controller">  Create File Controller</a></li>
				<li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/panduan_form/#default-content-user-login">  Data User Login</a></li>
			</ul>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/registrasi_form">  Registrasi URL Form</a></li>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/pengaturan_menu">  Buat Menu Baru / Update Menu.(Optional)</a></li>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/level_konfigurasi">  Konfigurasi Level Akses</a></li>
  </ul>

  
<br>
<b>Tingkat Lanjut :</b> 
  <ul class="">
	  <li><a href="#tingkat-lanjut" >Ajax Request menggunakan Object ybsRequest</a></li>
			<ul class="">
		
				<li><a href="#type-get" > Akses ke server (Request GET)</a></li>
				<li><a href="#type-post"> Mengirim data ke server (Request POST)</a></li>
				<li><a href="#modify-action" >  Menambahkan Aksi Setelah Proses Request</a></li>
				<li><a href="#get-data-in-server" >  Menangkap data di server (type GET)</a></li>
				<li><a href="#post-data-in-server" >  Menangkap data di server (type POST)</a></li>
				<li><a href="#send-data-to-client" >  Mengirim data ke Client</a></li>
				<li><a href="#redirect-page" >  Mengalihkan Halaman (Redirect Page)</a></li>
				<li><a href="#contoh-penggunaan" >  Contoh Penggunaan</a>
					<ul>
						<li><a href="#contoh-a" >1.  Sample Form A</a></li>
						<li><a href="#contoh-b" >2.  Sample Form B</a></li>
						<li><a href="#contoh-c" >2.  Sample Form C</a></li>
					
					</ul>
				</li>
				
			</ul>
  </ul>
<br> 
  
<h2 id="tingkat-lanjut"><u>TINGKAT LANJUT</u></h2>

<span class="tag tag-indigo"><b>ybsRequest</b></span> tidak lain adalah <span class="tag tag-indigo" style="font-size:10px">AJAX REQUEST</span> yang telah di sesuaikan dengan
sistem pada template ini.<br>
format request telah di sediakan sehingga dapat mempersingkat code anda.</p><br>
cara menggunakan pada file View:<br><br>
<h4 id='type-get'>Akses ke server (Request GET)</h4>

<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt!-- start -->

&ltbutton type="button" class="btn btn-sm btn-success" onclick="test_request()">Test Request TYPE GET&lt/button>

&ltscript>
	function test_request(){
		var req = new ybsRequest();
		req.process("YOUR_URL");
	}
&lt/script>
	
	
	
&lt!-- end -->
</pre> 



<code id="object-request"> var req = new ybsRequest();</code><br>
 - membuat object request<br><br>


<code id="type-get"> req.process("YOUR_URL");</code><br>
 - menjalankan Request type GET<br>
 - YOUR_URL : isi dengan URL anda <br><br><br>

 
 
 
<h4 id='type-post'>Mengirim data ke server (Request POST)</h4>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt!-- start -->

&ltbutton type="button" class="btn btn-sm btn-success" onclick="test_request()">Kirim ke server&lt/button>
	
&ltscript>
	function test_request(){
		var a = get_json_format('a','isi data pertama');
		var b = get_json_format('b','isi data kedua');
		var send_data = ybs_dataSending([a,b]);
			
		var req = new ybsRequest();
		req.process("YOUR_URL",send_data,"POST");
	}
&lt/script>
	
	
&lt!-- end -->
</pre>  <br><br>
 
 
<h4 id='type-post'>Mengirim data ke server (Request POST), dengan menggunakan tag form</h4>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt!-- start -->
	
&ltform id="id-form">
	&ltlabel>Nama&lt/label>
	&ltinput type="text" value="" class="data-sending" placeholder="username" name="username" value="">
		
	&ltbr>
		
	&ltlabel>Password&lt/label>
	&ltinput type="text" value="" class="data-sending" placeholder="password" name="password" value="">
	
	&ltbr>
		
	&ltbutton type="button" class="btn btn-sm btn-success" onclick="test_request()">Kirim ke server&lt/button>
&lt/form>

&ltscript>
	function test_request(){
		var a = get_dataSending('id-form');
		var send_data = ybs_dataSending(a);
			
		var req = new ybsRequest();
		req.process("YOUR_URL",send_data,"POST");
	}	
&lt/script>
	
	

&lt!-- end -->	
</pre> 

<span class="tag tag-red" style="font-size:10px">ATURAN : </span>
<ul>
	<li>Semua input form yang akan dikirim harus memiliki class <span class="tag tag-red" style="font-size:10px">data-sending</span>.</li>
	<li>Tag <span class="tag tag-indigo" style="font-size:10px">FORM</span> harus memiliki id</li>
</ul>


<br>
<br>

<h4 id="modify-action">Menambahkan Aksi Setelah Proses Request</h4>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt!-- start -->

&ltbutton type="button" class="btn btn-sm btn-success" onclick="test_request()">Kirim ke server&lt/button>
	
&ltscript>
	function test_request(){
		var a = get_json_format('a','isi data pertama');
		var b = get_json_format('b','isi data kedua');
		var send_data = ybs_dataSending([a,b]);
			
		var req = new ybsRequest();
		req.process("YOUR_URL",send_data,"POST");
			
		//modify Action Setelah Proses Request
		req.onBeforeSuccess = function(data){
			//your code
		};
			
		//req.onSuccess = function(data){
			//your code
		//};
			
		req.onAfterSuccess = function(data){
			//your code
		};
			
		req.onBeforeFailed = function(data){
			//your code
		};
			
		//req.onFailed = function(data){
			//your code
		//};
			
		req.onAfterFailed = function(data){
			//your code
		};
			
		//req.onError= function(xhr, status, error){
			//your code
		//};

		req.onComplite= function(){
			//your code
		};
	}
&lt/script>
	
	
&lt!-- end -->
</pre> 
<span class="tag tag-red" style="font-size:10px">CATATAN PENTING : </span><br>
<span class="tag tag-indigo" style="font-size:10px">onSuccess</span> , <span class="tag tag-indigo" style="font-size:10px">onFailed</span> , 
<span class="tag tag-indigo" style="font-size:10px">onError</span><br>
isi pesan nya sudah di setting dari sistem, <br>
jika anda mengaktifkan function tersebut maka otomatis<br>
settingan sistem tidak di gunakan..<br></small><br><br>



<h4 id='get-data-in-server'>Menangkap data di server (type GET)</h4>
<pre data-enlighter-language="php" data-enlighter-highlight="5">
&lt?php

//menangkap data type GET dan filtering data dari script2 xss attack
$data 	= $this->input->get('data_ajax',TRUE); 

//mengubah format ke type array
$val	= json_decode($data,TRUE); 

</pre>  

<h4 id='post-data-in-server'>Menangkap data di server (type POST)</h4>
<pre data-enlighter-language="php" data-enlighter-highlight="5">
&lt?php

//menangkap data type POST dan filtering data dari script2 xss attack
$data 	= $this->input->post('data_ajax',TRUE); 

//mengubah format ke type array
$val	= json_decode($data,TRUE); 

</pre>  <br><br><br>

<h4 id='send-data-to-client'>Mengirim data ke client</h4>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">

&lt?php

//membuat  object Outputview
$o = new Outputview(); 

//menyiapkan type pesan : true,false,redirect
$o->success = "true"; 

//menyiapkan pesan output
$o->message = "Haloo";

echo $o->result();
return; 
</pre>  <br><br>


<h4 id='redirect-page'>Mengalihkan Halaman (Redirect Page)</h4>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">

&lt?php

//membuat  object Outputview
$o = new Outputview(); 

$o->success = "redirect"; 

//menyiapkan URL Redirect
$o->message = "YOUR_URL";

//menyiapkan pesan output
//type message redirect_success,redirect-failed,redirect-warning 
$this->session->set_flashdata('redirect_success','ini sukses');
echo $o->result();
return; 
</pre>  <br><br><br>


<h4 id='contoh-penggunaan'>Contoh Penggunaan</h4>
<br>
<br>
<h4 id='contoh-a'>1. Sample Form A</h4>
<h5 id='contoh-a'>Request tanpa data & dengan data disi manual</h5><br>
buat folder dan file<br>
contoh :	<br>
<ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>mysample</li>
	  <li><a href="javascrip:void(0)">  nama file VIEW: </a>View_A.php</li>
	  <li><a href="javascrip:void(0)">  nama file CONTROLLER: </a>YbsRequest_A.php</li>
</ul>
path view:<code>Application/views/mysample/View_A.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">

&ltdiv class="col-md-4 col-xl-12">
	&ltdiv class="form-group">
	&ltbutton id="btn-apply" type="button" class="btn btn-primary" onclick="req_no_data()">&lti class="fe fe-check">&lt/i> Request Tanpa Data&lt/button>	
	&lt/div>		 
&lt/div>


&ltdiv class="col-md-4 col-xl-12">
		   &ltdiv class="form-group">
			&ltbutton id="btn-apply" type="button" class="btn btn-primary" onclick="req_with_data()">&lti class="fe fe-check">&lt/i> Request dengan Data Manual&lt/button>
		   &lt/div>		 
&lt/div>


&ltscript>
	function req_no_data(){
		var a = new ybsRequest();
			a.process("&lt?php echo $link_a ?>");//type get
	}
			
	function req_with_data(){
		var a = new ybsRequest();
		var b = get_json_format("param1","Halo ini Data 1");
		var c = get_json_format("param2","Halo ini Data 2");
	
		var send_data = ybs_dataSending([b,c]);
		a.process("&lt?php echo  $link_b?>",send_data,"POST");
		a.onComplite = function(){
			 //action complite
		}
	}
&lt/script>


&lt!-- end script -->
</pre>





path controller:<code>Application/Controllers/mysample/YbsRequest_A.php</code>
<pre data-enlighter-language="php" data-enlighter-highlight="5">
&lt?php 
	
	class YbsRequest_A extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$data = array();
			$data["title_page_big"] = "Sample Request";
			$data["link_a"] = site_url()."mysample/YbsRequest_A/proses_data_get";
			$data["link_b"] = site_url()."mysample/YbsRequest_A/proses_data_post_manual";
			$this->template->load('mysample/View_A',$data);
			}
			
				
		public function proses_data_get() {
			$o		= new Outputview(); 
			$o->success = 'true'; 
			$o->message = 'Mantaps..pesan ini berasal dari server'; 
			echo $o->result(); 
		}
		
			
		public function proses_data_post_manual() {
			$data 	= $this->input->post('data_ajax',true);
			$val	= json_decode($data,true);
			$o		= new Outputview(); 
			$o->success = 'true'; 
			$o->message = "Berhasil..pesan ini dari Server,,data client param1= ". $val['param1'] .",,data param2= ".$val['param2']; 
			echo $o->result(); 
		}
			
	}
	
	
//end 
</pre>  <br><br>

<br>
<br>
<h4 id='contoh-b'>2. Sample Form B</h4>
<h5 id='contoh-b'>Request Menggunakan  Tag Form</h5><br>
buat folder dan file<br>
contoh :	<br>
<ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>mysample</li>
	  <li><a href="javascrip:void(0)">  nama file VIEW: </a>View_B.php</li>
	  <li><a href="javascrip:void(0)">  nama file CONTROLLER: </a>YbsRequest_B.php</li>
</ul>
path view:<code>Application/views/mysample/View_B.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&ltdiv class="col-md-12 col-xl-12">
&ltform id='form-a'>
		
		&ltdiv class="form-group">
		&ltlabel class="form-label">Input Nama&lt/label>
		&ltinput type="text" class="form-control data-sending" id="form_name" name='form_name' placeholder="Nama" >
		&lt/div>
		
		&ltdiv class="form-group">
		&ltlabel class="form-label">Input Alamat&lt/label>
		&ltinput type="text" class="form-control data-sending" id="form_alamat" name='form_alamat' placeholder="Alamat" >
		&lt/div>
	
	
&lt/form>
&lt/div>



&ltdiv class="col-md-4 col-xl-12">
	&ltdiv class="form-group">
	&ltbutton id="btn-apply" type="button" class="btn btn-primary" onclick="req_with_data()">&lti class="fe fe-check">&lt/i> Request dengan Data Form&lt/button>
	&lt/div>		 
&lt/div>


&ltscript>		
	function req_with_data(){
			var data = get_dataSending('form-a');
			var send_data = ybs_dataSending(data);
			var a = new ybsRequest();
			a.process("&lt?php echo $link_a?>",send_data,"POST");
			a.onComplite = function(){
			 //action complite
			}
	}

&lt/script>



&lt!-- end -->

</pre>

path controller:<code>Application/Controller/mysample/YbsRequest_B.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt?php 
	
	class YbsRequest_B extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$data = array();
			$data["title_page_big"] = "Sample Request";
			$data["link_a"] = site_url()."mysample/YbsRequest_B/proses_data";
		
			$this->template->load('mysample/View_B',$data);
			}
			
				
		public function proses_data() {
			$data 	= $this->input->post('data_ajax',true);
			$val	= json_decode($data,true);
			$o		= new Outputview(); 
			$o->success = 'true'; 
			$o->message = "Berhasil..pesan ini dari Server,,data client param1= ". $val['form_name'] .",,data param2= ".$val['form_alamat']; 
			echo $o->result(); 
		}
		
			

	}
	
	
//end 
</pre>

<br>
<br>
<h4 id='contoh-c'>3. Sample Form C</h4>
<h5 id='contoh-c'>Request & Redirect Page onSuccess</h5><br>
buat folder dan file<br>
contoh :	<br>
<ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>mysample</li>
	  <li><a href="javascrip:void(0)">  nama file VIEW: </a>View_C.php & View_C1.php</li>
	  <li><a href="javascrip:void(0)">  nama file CONTROLLER: </a>YbsRequest_C.php</li>
</ul>
path view:<code>Application/views/mysample/View_C.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&ltdiv class="col-md-12 col-xl-12">
&ltform id='form-a'>
		
		&ltdiv class="form-group">
		&ltlabel class="form-label">Input Nama&lt/label>
		&ltinput type="text" class="form-control data-sending" id="form_name" name='form_name' placeholder="Nama" >
		&lt/div>
		
		&ltdiv class="form-group">
		&ltlabel class="form-label">Input Alamat&lt/label>
		&ltinput type="text" class="form-control data-sending" id="form_alamat" name='form_alamat' placeholder="Alamat" >
		&lt/div>
	
	
&lt/form>
&lt/div>



&ltdiv class="col-md-4 col-xl-12">
	&ltdiv class="form-group">
	&ltbutton id="btn-apply" type="button" class="btn btn-primary" onclick="req_redirect()">&lti class="fe fe-check">&lt/i> Request & Redirect On Success&lt/button>
	&lt/div>		 
&lt/div>


&ltscript>		
	function req_redirect(){
			var data = get_dataSending('form-a');
			var send_data = ybs_dataSending(data);
			var a = new ybsRequest();
			a.process("&lt?php echo $link_a?>",send_data,"POST");
			a.onComplite = function(){
			 //action complite
			}
	}

&lt/script>



&lt!-- end -->

</pre>
path view:<code>Application/views/mysample/View_C1.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&ltp>Haloo..ini page sukses&lt/p>
</pre>


path controller:<code>Application/Controller/mysample/YbsRequest_C.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt?php 
	
	class YbsRequest_C extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$data = array();
			$data["title_page_big"] = "Sample Request";
			$data["link_a"] = site_url()."mysample/YbsRequest_C/proses_data";
		
			$this->template->load('mysample/View_C',$data);
			}
			
				
		public function proses_data() {
			$data 	= $this->input->post('data_ajax',true);
			$val	= json_decode($data,true);
			
			$o		= new Outputview(); 
			
			if($val['form_name']=='dhiya'){
				$o->success = 'redirect'; 
				$o->message = site_url() . 'mysample/YbsRequest_C/load_view_C';
				
				$this->session->set_flashdata('redirect_success','Sukses dan berhasil di redirect');
				echo $o->result(); 
				
			}else{
				$o->success = 'false'; 
				$o->message = "Isi Nama dengan 'dhiya' agar redirect dijalankan"; 
				echo $o->result(); 
			}
		}
		
		public function load_view_C() {
			$data = array();
			$data["title_page_big"] = "Page Redirect";
			
			$this->template->load('mysample/View_C1',$data);
	    }			

	}
	
	
//end 
</pre>

<script>
 $( window ).on( "load", function() {
		$('#content-body').addClass("fadeIn");  
    });
</script>	