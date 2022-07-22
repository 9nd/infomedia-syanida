

<div style="font-size:14px">
<b>Upload File :</b>  
  <ul class="">
	  <li><a href="#upload-single-file">  Single File with YBS REQUEST</a></li>
	  <li><a href="<?php echo base_url()?>sistem/Dokumentasi_109/pengaturan_menu">  Multiple File With Dropzone</a></li>
  </ul>
  

<br> 
<h3 class="text-mute" id="upload-single-file"><b>Single File with YBS REQUEST</b></h3>
<div style="font-size:14px">
untuk mengupload file ,dilakukan dalam beberapa langkah :<br>
<ul>
	<li>1. membuat element untuk memilih file yang akan di upload.</li>
	<li>2. menjalankan proses upload ke folder temp saat file di pilih.</li>
	<li>3. menampilkan nama file yang berhasil terupload</li>
	<li>4. menyimpan <span class="tag tag-indigo" style="font-size:10px">TIMEPOST</span> hasil upload pada <span class="tag tag-indigo" style="font-size:10px">DATABASE</span>  yang akan di gunakan untuk mengakses file.</li>
</ul>

<span class="tag tag-red" style="font-size:10px">PENTING : </span> <br>
- File yang telah terupload hanya dapat di akses <br>
menggunakan <span class="tag tag-indigo" style="font-size:10px">TIMEPOST</span> yang di peroleh <br>
setelah file tersebut berhasil di upload.
<br>
<br>

CONTOH 1. <br>
Membuat form upload di lengkapi dengan <br>
keterangan dan preview foto,dan display private Storage<br>

<img class="ybs-image-slider" data-image="upload_file" src="<?php echo base_url()?>images/dokumentasi/60.png" style="border:1px solid black ;width:300px;height:300px">
<br>
<br>
<code>1. Buat table database : </code><br>
<pre>
table name :sample_upload_single_file
field name: id (int 11 , primary key , autoincreament)
field name: image (int 11)
field name: keterangan (varchar 200)
</pre>


<code>2. Buat file view : </code><br>
<code>Application/views/mysample/sample_upload_1.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&ltdiv class="col-md-6 col-xl-6">
&lt?php echo card_open('Upload File','bg-blue',true)?>	

&lt!-- element html untuk memilih file -->
&ltform id="form-data">
&lt!-- browse file -->
&ltdiv class="form-group">
    &ltlabel>Upload Foto&lt/label>
    &ltdiv class="custom-file">
        &ltinput type="file" class="custom-file-input " id="inputfile" name="file" >
        &ltlabel id="nama-file"class="custom-file-label form-control">Choose file&lt/label>
    &lt/div>
&lt/div>


&lt!-- image container -->
&ltdiv class="form-group">
  &ltdiv class="text-center ">
    &ltimg id="image-preview" src="" class="form-control" alt="" style="width:250px;height:250px">
  &lt/div>
&lt/div>


&lt!-- input keterangan -->
&ltdiv class="form-group">
    &ltlabel>Keterangan&lt/label>
    &ltdiv >
        &ltinput type="text" class=" form-control " name="keterangan" >
    &lt/div>
&lt/div>

&ltdiv class="form-group">
    &ltbutton id="btn-save" type="button" onclick="simpan()" class="btn btn-primary">&lti class="fe fe-save"> &lt/i> Simpan &lt/button>  
&lt/div>
&lt/form>


&lt?php echo card_close()?>		
&lt/div>



&ltdiv class="col-md-6 col-xl-6">
&lt?php echo card_open('YBS Storage','bg-green',true)?>	

&lt!--container display storage -->
&ltdiv id="storage">
&lt/div>

&lt?php echo card_close()?>		
&lt/div>

&lt!-- end element  -->


&ltscript>
	//menyiapkan display private storage
	$(document).ready(function(){
		$('#storage').ybsPrivateStorage({
			images 			: "&lt?php echo $images?>",
			itemSM			: 1,
			itemMD  		: 4,
			itemLG  		: 4,
			btnDownload 	: true,
			btnRemove		: true,
			relation		:{table:'sample_upload_single_file', field: 'image' , actionRow: 'delete'},				
		});
	});
	
	//menjalankan proses upload saat file selesai dipilih
	$('#inputfile').change(function(){
		upload_temp_file();
	});

	
	function upload_temp_file(){
			//membuat object ybsRequest
			var a = new ybsRequest();
	
			//memanggil fungsi upload file
			//"form-data" = id form
			//"my_foto" = folder tujuan upload 
			//"false" = Autosave false	
			a.processUploadFile("form-data","my_foto","false");
			a.onSuccess = function(data){
				//menampilkan nama file yang baru di upload
				$("#nama-file").text(data.orig_name);
				
				//menyimpan sementara extension file yg baru di upload
				var ext = data.ext;
				$('#inputfile').attr("data-ext",ext);
				
				//menyimpan sementara timpost yang baru di upload
				var timepost = data.time_post;
				$('#inputfile').attr("data-time",timepost);
				
				
				set_preview(timepost,"#image-preview");
			
			}  
		
	}
	
	
	function set_preview(time_post,id_element){
		//menggunakan object dropzone_result untuk mengakses folder temp
		//berdasarkan timepost
		var a = new dropzone_result(time_post,'temp');
		a.onComplite = function(data){
			var b = JSON.parse(data.message);
			$.each(b,function(k,y){
				$(id_element).attr("src",y.link);
			})
		}
	}
	
	function simpan(){
		//mengambil nilai timepost
		var timepost_image = $("#inputfile").attr('data-time');
		
		//menyiapkan timepost image dalam bentuk json sebelum dikirim  ke server
		var tm = get_json_format("image",timepost_image);
		
		//mengambil data di tag form	
		var send_data = getForm('form-data');
		
		//menyisipkan timepost_image ke dalam data form 
		send_data.push(tm);
		
		//mengirim ke server
		var a = new ybsRequest();
		a.process('&lt?php echo base_url()?>Sample/upload_file/simpan',send_data,'POST');
		
		//saat proses selesai 
		a.onComplite = function(data){
			//menyimpan foto secara permanent
			dropzone_save("#inputfile"); 
			
			//clear image,nama file,keterangan
			$('#image-preview').attr("src","");	
			$("#nama-file").text("");	
			$("#keterangan").val("");			
		}
	}
	

	&lt/script>
</pre>

<code>3. Buat file model : </code><br>
<code>Application/models/sample/model_upload_file.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class model_upload_file extends CI_Model {
	
    
	
	function __construct(){
        parent::__construct();
	}	
	
	public function get_all(){
	  return $this->db->get('sample_upload_single_file')->result_array();
	}
  
	
	public function insert($data){
		return $this->db->insert('sample_upload_single_file',$data);
	}


}
</pre>


<code>4. Buat file controller : </code><br>
<code>Application/controllers/Sample/upload_file.php</code>
<pre data-enlighter-language="jquery" data-enlighter-highlight="5">
&lt?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Upload_file extends CI_Controller {
   
   function __construct(){
        parent::__construct();
   }
   


	public function index(){
		$this->load->model("sample/model_upload_file","tupload");
		$image = $this->tupload->get_all();
		
		$images ="";
		foreach($image as $val){
			$images .= " " . $val['image']; 
		}
		
		
		$data = array(
		  'title_page_big'   	 => 'Upload file',
		  'images'				 => $images,
		
		);
		
		$this->template->load('mysample/sample_upload_1',$data);
	}

	  
	public function simpan(){
	
		//menangkap data yang di kirim 	
		$data  	= $this->input->post('data_ajax',TRUE);
		
		//mengubah ke format array
		$val 	= json_decode($data,TRUE);
		
		$d = array();
		$d['image'] = $val['image'];
		$d['keterangan'] = $val['keterangan'];
		
		//memanggil model
		$this->load->model("sample/model_upload_file","tupload");
			
		//insert ke database
		$success  = $this->tupload->insert($d);
		$o = new Outputview(); 
		if($success){
			$o->success = "redirect";
			$o->message = site_url().'sample/upload_file';
			echo $o->result();	
		}else{
			$o->success = "false";
			$o->message = "data gagal di simpan";
			echo $o->result();
		}
	
	}
  
}	
</pre>
</div><br>
  

