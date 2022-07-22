<div class="col-sm-12 col-lg-12">

<b>Tingkat Lanjut :</b> 
  <ul class="">
	  <li><a href="#">Data Proses : Ajax Request menggunakan Object ybsRequest</a></li>
			<ul class="">
				<li><a href="#object-request">  Membuat Object Request</a></li>
				<li><a href="#type-get"> Menjalankan Request type GET</a></li>
				<li><a href="#type-post"> Menjalankan Request type POST</a></li>
				<li><ul><a href="#type-post"> - manual data</a></ul></li>
				<li><ul><a href="#type-post"> - data form</a></ul></li>
				<li><a href="#modify-action">  Modify Action Setelah Proses Request</a></li>
				<li><a href="#get-data-in-server">  Proses Penangkapan data pada server</a></li>
				<li><a href="#send-data-to-client">  Proses Pengiriman data ke Client</a></li>
				<li><a href="#desain-view">  Desain View</a></li>
				<li><a href="#create-code-request">  Code Request</a></li>
				<li><a href="#create-controller">  Create Controller</a></li>
			</ul>
  </ul>
<br>
<h2 id="membuat-form">Tingkat Lanjut</h2>
<p><b><u>ybsRequest</u></b> tidak lain adalah Ajax Request yang telah di sesuaikan dengan
sistem pada template ini.<br>
format request telah di sediakan sehingga dapat mempersingkat code anda.</p>
<p>cara menggunakan :</p>
<b id="object-request">Membuat object request:</b>
<code> var req = new ybsRequest();</code><br>
<b id="type-get">menjalankan Request type GET:</b>
<code> req.process(url);</code><br>
<b id="type-post">menjalankan Request type POST:</b>
<b>- manual data :</b>
<code>var a = get_json_format('a','isi data');<br>
var b = get_json_format('b','isi data');<br>
var send_data = ybs_dataSending([a,b]);<br><br>
req.process(url,send_data,"POST");<br><br>
</code><br>
<b>- data form :</b>
<code>
var a = get_dataSending('id-form')<br>
var send_data = ybs_dataSending(a);<br><br>
req.process(url,send_data,"POST");<br><br>
</code>
<div class="card-alert alert alert-danger mb-0">
   <small>note:<br>
    - semua input form yang akan dikirim harus memiliki class data-sending.<br>
    - get_dataSending('id-form') akan membaca semua input yang memiliki class data-sending,<br>
	   yang terdapat pada container dengan id="id-form"</small>
</div>
<br>
<b id="modify-action">Modify Action Setelah Proses Request</b>
<code>
req.onBeforeSuccess = function(data){}<br>
req.onSuccess = function(data){}<br>
req.onAfterSuccess = function(data){}<br><br>
req.onBeforeFailed = function(data){}<br>
req.onFailed = function(data){}<br>
req.onAfterFailed = function(data){}<br><br><br>
req.onError= function(xhr, status, error){}<br>
req.onComplite= function(){}<br>
</code>
<div class="card-alert alert alert-danger mb-0">
   <small>note:<br>
    - onSuccess,onFailed,onError sudah di setting dari awal<br>
    sehingga jika anda mengaktifkan function tersebut maka otomatis<br>
	settingan awal sistem tidak di gunakan,,ini di sebut sebagai ovveride function<br></small>
</div>
<br>
<b id="get-data-in-server">Proses Penangkapan data pada server</b>
<code>
?php<br>
$data 	= $this->input->get('data_ajax',true); //proses penangkapan data type get dan filtering data dari script2 xss attack<br>
$val	= json_decode($data,true); //mengubah format ke type array()<br><br>
//or<br><br>
$data 	= $this->input->post('data_ajax',true); //proses penangkapan data type post dan filtering data dari script2 xss attack<br>
$val	= json_decode($data,true); //mengubah format ke type array()
</code>
<div class="card-alert alert alert-danger mb-0">
   <small>note:<br>
    - parameter "data_ajax" merupakan format pengiriman dari ybsRequest</small>
</div>

<br>
<b id="send-data-to-client">Proses Pengiriman data ke Client</b>
<code>
?php<br><br>
//membuat  object Outputview<br>
$o = new Outputview(); <br><br>
//menyiapkan type pesan<br>
$o->success = "true"; //type pesan : true,false,redirect<br><br>
//menyiapkan pesan output<br>
$o->message = "Haloo";<br>
echo $o->result();<br>
return;<br><br><br>

//jika menggunakan redirect<br>
$o->success = "redirect";<br>
$o->message = url;<br><br>

//menyiapkan pesan output<br>
//type message redirect_success,redirect-failed,redirect-warning <br>
$this->session->set_flashdata('redirect_success','ini sukses');<br>
echo $o->result();<br>
return;<br><br>
</code>
<div class="card-alert alert alert-danger mb-0">
   <small>note:<br>
    - echo merupakan proses terakhir,,jika ada proses setelah echo maka harus menggunakan return; untuk menghentikan proses selanjutnya<br>
	</small>
</div>
<br>
<br>
<br>
<h4 id='desain-view'>A. Desain View</h4>
buka folder : 
<br> 
<code>Application/views/</code>
<br>
buat folder dan file<br>
contoh :	<br>
<ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>mysample</li>
	  <li><a href="javascrip:void(0)">  nama file: </a>sample_view_ybsRequest.php</li>
</ul>
path:
<code>Application/views/mysample/sample_view_ybsRequest.php</code>
<br>
isi file :
<code>

<<span>div class="col-md-12 col-xl-12"></span><br>
haloo..ini adalah contoh ybsRequest<br>
<<span>/div></span><br><br>

	<<span>div class="col-md-12 col-xl-12"><br>
	<<span>form id='form-a'><</span>br><br><br>
		<<span>div class="form-group"></span><br>
		<<span>label class="form-label">Input Nama</span><<span>/label></span><br>
		<<span>input type="text" class="form-control data-sending focus-color" id="form_name" name='form_name' placeholder="Nama" ></span><br>
		<<span>/div></span>
		<br><br>
		<<span>div class="form-group"></span><br>
		<<span>label class="form-label">Input Alamat<<span>/label><br>
		<<span>input type="text" class="form-control data-sending focus-color" id="form_alamat" name='form_alamat' placeholder="Alamat" ></span><br>
		<<span>/div></span><br>
	
	<br>
	<<span>/form><span><br>
	<<span>/div></span>
	<br>
	<br>
	<br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_no_parameter()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request Tanpa Parameter<<span>/button></span>	
	<br>	   <<span>/div></span>		 
	<br><<span>/div>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_with_parameter()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Parameter Manual<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_with_parameter_element()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Parameter Element<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>

	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_beforeProcess()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action Before Process<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onBeforeSuccess()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnBeforeSuccess<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onSuccess()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnSuccess<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onAfterSuccess()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnAfterSuccess<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>	
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onBeforeFailed()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnBeforeFailed<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onFailed()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnFailed<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>	
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onAfterFailed()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnAfterFailed<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>	
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_onError()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action OnError<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>
<br>
	<br><br><<span>div class="col-md-4 col-xl-12"></span>
	<br>	   <<span>div class="form-group"></span>
	<br>		<<span>button id="btn-apply" type="button" class="btn btn-primary" onclick="sample_request_action_Redirect()"></span><<span>i class="fe fe-check"></span><<span>/i></span> Request dengan Action Redirect<<span>/button></span>
	<br>	   <<span>/div></span>		 
	<br><<span>/div></span>	
	
	
	
</code>
<br>
<br>
<br>

<h4 id='create-code-request'>B. Script Code Request</h4>
masih pada halaman view
<br>
tambahkan script :

	<code>
		<<span>script></span><br>
			<ul>function sample_request_no_parameter(){</ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_get ?></span>");//type get</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_with_parameter(){</ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>var b = get_json_format("param1","Halo ini Data 1");</ul></ul>
			<ul><ul>var c = get_json_format("param2","Halo ini Data 2");</ul></ul>
			<ul><ul>var send_data = ybs_dataSending([b,c]);</ul></ul>
			<ul><ul>a.process("<<span>?php echo  $link_sample_post_param_manual?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_with_parameter_element(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_param_element?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_beforeProcess(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.beforeProcess = function(){</ul></ul>
			<ul><ul><ul> show_success_message('ini function beforeProcess');</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>

			<ul>function sample_request_action_onBeforeSuccess(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onBeforeSuccess = function(data){</ul></ul>
			<ul><ul><ul> show_success_message('ini function onBeforeSuccess,  message dari server adalah ='+data.message);</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_onSuccess(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onSuccess = function(data){</ul></ul>
			<ul><ul><ul> show_success_message('ini function onSuccess, Mengganti Pesan Asli dari server..pesan dari server adalah = '+data.message);</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_onAfterSuccess(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onAfterSuccess = function(data){</ul></ul>
			<ul><ul><ul> show_success_message('ini function onAfterSuccess');</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_onBeforeFailed(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action_failed?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onBeforeFailed = function(data){</ul></ul>
			<ul><ul><ul> show_warning_message('ini function onBeforeFailed,  message dari server adalah ='+data.message);</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_onFailed(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action_failed?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onFailed = function(data){</ul></ul>
			<ul><ul><ul> show_error_message('ini function onFailed,  message dari server adalah ='+data.message);</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_onAfterFailed(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action_failed?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onAfterFailed = function(data){</ul></ul>
			<ul><ul><ul> show_error_message('ini function onAfterFailed,  message dari server adalah ='+data.message);</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_onError(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_post_action_failed?></span>",send_data,"POST");</ul></ul>
			<ul><ul>a.onError = function(xhr, status, error){</ul></ul>
			<ul><ul><ul> show_error_message('ini function onError');</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul><ul>a.onComplite = function(){</ul></ul>
			<ul><ul><ul> //action complite</ul></ul></ul>
			<ul><ul>}</ul></ul>
			<ul>}</ul>
			
			<ul>function sample_request_action_Redirect(){</ul>
			<ul><ul>var data = get_dataSending('form-a');</ul></ul>
			<ul><ul>var send_data = ybs_dataSending(data);</ul></ul>
			<ul><ul>var a = new ybsRequest();</ul></ul>
			<ul><ul>a.process("<<span>?php echo $link_sample_redirect?></span>",send_data,"POST");</ul></ul>
			<ul>}</ul>
			

			
		<br>	
		<<span>/script></span>
	</code>
<br>


<h4 id="create-controller">C. Create Controller</h4>
buka folder : 
<br>
 <code>Application/Controllers/</code>
 <br>
 buat folder dan file
 <br>
  contoh :	<br>
 <ul class="">
	  <li><a href="javascrip:void(0)">  nama folder : </a>sample_controller</li>
	  <li><a href="javascrip:void(0)">  nama file: </a>Sample_ybsRequest.php</li>
</ul>
  <code>Application/Controllers/sample_controller/Sample_ybsRequest.php</code>
  
 <div class="card-alert alert alert-danger mb-0">
   <small>note: file harus di simpan didalam sub folder Controllers.</small><br>
    <small>ex. Application/Controllers/your_sub_folder/your_file.php</small>
 </div>

 <br>


<br>

isi file controller : 
<code>
		<<span>?</span>php <br>
		class Sample_ybsRequest extends CI_Controller {
		<br>
		<br>
			
			<ul>public function __construct() {</ul>
			<ul><ul>parent::__construct();</ul></ul>
			<ul>}</ul>
		<br>
		<ul>public function index() {</ul>
			<ul><ul>$data = array();</ul></ul>
			<ul><ul>$data["title_page_big"] = "Sample Request";</ul></ul>
			<ul><ul>$data["link_sample_get"] = site_url()."sample_controller/Sample_ybsRequest/proses_data_get";</ul></ul>
			<ul><ul>$data["link_sample_post_param_manual"] = site_url()."sample_controller/Sample_ybsRequest/proses_data_post_manual";</ul></ul>
			<ul><ul>$data["link_sample_post_param_element"] = site_url()."sample_controller/Sample_ybsRequest/proses_data_post_element";</ul></ul>
			<ul><ul>$data["link_sample_post_action"] = site_url()."sample_controller/Sample_ybsRequest/proses_data_post_action";</ul></ul>
			<ul><ul>$data["link_sample_post_action_failed"] = site_url()."sample_controller/Sample_ybsRequest/proses_data_post_action_failed";</ul></ul>
			<ul><ul>$data["link_sample_redirect"]= site_url()."sample_controller/Sample_ybsRequest/proses_redirect";</ul></ul>
			<ul><ul>$this->template->load('mysample/sample_view_ybsRequest',$data);</ul></ul>
			<ul>}</ul>
			
		<br>		
			<ul>public function proses_data_get() {</ul>
			<ul><ul>$o		= new Outputview(); </ul></ul>
			<ul><ul>$o->success = 'true'; </ul></ul>
			<ul><ul>$o->message = 'Mantaps..pesan ini berasal dari server'; </ul></ul>
			<ul><ul>echo $o->result(); </ul></ul>
			<ul>}</ul>
		<br>
			
			<ul>public function proses_data_post_manual() {</ul>
			<ul><ul>$data 	= $this->input->post('data_ajax',true);</ul></ul>
			<ul><ul>$val	= json_decode($data,true);</ul></ul>
			<ul><ul>$o		= new Outputview(); </ul></ul>
			<ul><ul>$o->success = 'true'; </ul></ul>
			<ul><ul>$o->message = "Berhasil..pesan ini dari Server,,data client param1= ". $val['param1'] .",,data param2= ".$val['param2']; </ul></ul>
			<ul><ul>echo $o->result(); </ul></ul>
			<ul>}</ul>
		<br>	
			<ul>public function proses_data_post_element() {</ul>
			<ul><ul>$data = $this->input->post('data_ajax',true);</ul></ul>
			<ul><ul>$val	= json_decode($data,true);</ul></ul>
			<ul><ul>$o	= new Outputview();</ul></ul>
				
			<ul><ul>//validasi mencegah data kosong</ul></ul>
			<ul><ul>if(!$o->not_empty($val['form_name'],'#form_name')){</ul></ul>
			<ul><ul>	echo $o->result();</ul></ul>
			<ul><ul>	return;</ul></ul>
			<ul><ul>}</ul></ul>
				
			<ul><ul>//validasi mencegah data kosong</ul></ul>
			<ul><ul>if(!$o->not_empty($val['form_alamat'],'#form_alamat')){</ul></ul>
			<ul><ul>	echo $o->result();</ul></ul>
			<ul><ul>	return;</ul></ul>
			<ul><ul>}</ul></ul>
				
			<ul><ul>$o->success = 'true';</ul></ul>
			<ul><ul>$o->message = "Berhasil..pesan ini dari Server,,Input nama= ". $val['form_name'] .",,Input alamat= ".$val['form_alamat'];</ul></ul>
			<ul><ul>echo $o->result();</ul></ul>
			<ul>}</ul>

		<br>
	
			<ul>public function proses_data_post_action() {</ul>
			<ul><ul>$data = $this->input->post('data_ajax',true);</ul></ul>
			<ul><ul>$val	= json_decode($data,true);</ul></ul>
		
			<ul><ul>$o	= new Outputview();</ul></ul>
			<ul><ul>$o->success = 'true';</ul></ul>
			<ul><ul>$o->message = 'Mantaps..pesan ini berasal dari server';</ul></ul>
			<ul><ul>echo $o->result();</ul></ul>
			<ul>}</ul>
	
		<br>
			<ul>public function proses_data_post_action_failed() {</ul>
			<ul><ul>$data = $this->input->post('data_ajax',true);</ul></ul>
			<ul><ul>$val	= json_decode($data,true);</ul></ul>
		
			<ul><ul>$o	= new Outputview();</ul></ul>
			<ul><ul>$o->success = 'false';</ul></ul>
			<ul><ul>$o->message = 'Failed...pesan ini berasal dari server Input nama= '. $val['form_name'] .",,Input alamat= ".$val['form_alamat'];</ul></ul>
			<ul><ul>echo $o->result();</ul></ul>
			<ul>}</ul>
		<br>
			<ul>public function proses_redirect(){</ul>
			<ul><ul>$data = $this->input->post('data_ajax',true);</ul></ul>
			<ul><ul>$val	= json_decode($data,true);</ul></ul>
		
			<ul><ul>$o	= new Outputview();</ul></ul>
			<ul><ul>$o->success = 'redirect';</ul></ul>
			<ul><ul>$o->message = site_url().'home';</ul></ul>
			<ul><ul>//redirect_success,redirect_failed,redirect_warning</ul></ul>
			<ul><ul>$this->session->set_flashdata('redirect_warning','Pesan dari Server...Input nama= '. $val['form_name'] .",,Input alamat= ".$val['form_alamat']);</ul></ul>
			<ul><ul>echo $o->result();</ul></ul>
			<ul>}</ul>
		
		<br>
		<br>
		
		
		}
		<br>
			

</code> 
<br>
output link :
<code><?php echo site_url()?>sample_controller/Sample_ybsRequest</code>




</div>


