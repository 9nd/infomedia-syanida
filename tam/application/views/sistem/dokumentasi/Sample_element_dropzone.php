<?php echo _css('dropzone')?>

<ul id="top-page" class="">
	  <li><a href="#penjelasan-dropzone">Penjelasan Dropzone for Upload File</a></li>
		<ul>
		<li><a href="#html-dropzone-snap">Snapshot Html Code</a></li>
		<li><a href="#script-dropzone-snap">Snapshot Upload Script</a></li>
		<li><a href="#script-dropzone-result-snap">Snapshot Dropzone Result Script</a></li>
		<li><a href="#set-folder">Set Folder Upload</a></li>
		<li><a href="#type-upload">Type Upload</a></li>
		<li><a href="#auto-save">AutoSave</a></li>
		<li><a href="#remove-file">Remove File in Server</a></li>
		<li><a href="#max-size">Max Size & Max File Upload</a></li>
		<li><a href="#return-var">Variable Return From Server</a></li>
		
		</ul>
		<br>
	  <li><a href="#akses-file-upload">Cara Akses File yang telah di upload</a></li>
		 <ul>
		 <li><a href="#akses-php">Menggunakan PHP</a></li>
		 <li><a href="#akses-javascript">Menggunakan JavaScript</a></li>
		</ul>		 
		<br>
	  <li><a href="#sample-dropzone">Copy Dropzone Code</a></li>
	
</ul>

<div class="container">
<br>
<div class="col-md-12 col-xl-12" >
<h3></h3>
</div>
</div>

<div class="col-md-12 col-xl-12" id="penjelasan-dropzone">
<b>Penjelasan singkat</b>
<div class="alert alert-secondary" role="alert" >	
Kombinasi <b>Dropzone.js + Ace-Master style + YBS System</b>,<br>
membuat upload file semakin mudah..<br><br>
<b>Dropzone dan YBS System</b> menghandel coding anda dalam mengupload file,<br>
sehingga anda tidak perlu melakukan coding dari awal untuk mengupload file.<br><br>
file secara otomatis akan terupload saat anda selesai memilih file,<br>
dan akan mengembalikan nilai timestamp yang dapat anda gunakan,<br>
untuk menjadi referensi (join table) dalam mengakses file yang di upload tadi.<br><br>
data file yang terupload otomatis tersimpan dalam table <span class="tag tag-indigo" style="font-size:10px">sys_user_upload</span>,sehingga<br>
anda tidak perlu lagi menyimpan data file dalam database kecuali nilai <span class="tag tag-indigo" style="font-size:10px">timestamp</span><br>
yang akan di gunakan sebagai referensi.   

</div>
<br>
<br>
</div>

<div class="col-sm-12 col-lg-12"  id="html-dropzone-snap">
<b>Snapshot Html Code</b>
                <div class="card p-3">
                  <a href="javascript:void(0)" class="mb-3">
                    <img src="<?php echo base_url() ?>images/sample/dropzone_html.png" alt="dropzone_html" class="rounded ybs-image-slider" data-image="Html Dropzone" >
                  </a>
                  <div class="d-flex align-items-center px-2">
                    
                    <div>
                      <div>Potongan Html</div>
                    </div>
                 
                  </div>
                </div>
</div>

<div class="col-md-12 col-xl-12" id="set-folder">
<b>Set Folder Upload</b>
<div class="alert alert-secondary" role="alert">
Seluruh file yang di upload akan di arahkan ke folder <span class="tag tag-indigo" style="font-size:10px"> upload_files</span>.<br><br>

anda dapat membuat sub-sub folder didalam folder <span class="tag tag-indigo" style="font-size:10px"> upload_files</span><br>
dengan mengeset <span class="tag tag-indigo" style="font-size:10px">Attribut Html</span> data-folder dropzone<br>

contoh :  <br>
<span class="tag tag-indigo" style="font-size:14px">data-folder="your_subfolder/my_document"</span><br><br>
output folder: <code >upload_files/your_subfolder/my_document </code>

</div>
<br>
</div>



<div class="col-sm-12 col-lg-12"  id="script-dropzone-snap">
<b>Snapshot Upload Script</b>
                <div class="card p-3">
                  <a href="javascript:void(0)" class="mb-3">
                    <img src="<?php echo base_url() ?>images/sample/dropzone_script.png" alt="dropzone_script" class="rounded ybs-image-slider" data-image="Script Dropzone" >
                  </a>
                  <div class="d-flex align-items-center px-2">
                    
                    <div>
                      <div>Potongan Script</div>
                   
                    </div>
                 
                  </div>
                </div>
				
</div>

<div class="col-md-12 col-xl-12" id="type-upload">

<b>Type Upload</b>
<div class="alert alert-secondary" role="alert">
<b>Dropzone - YBS System</b> memiliki 5 Type file upload, yaitu :<br>
 <ul class=""><br>
 <li>"all" ( image , audio , vidio , document ).</li><br>
 <li>"image" ( png | jpg | jpeg | img | bmp | gif | ico).</li><br>
 <li>"audio" ( mp3 | wav).</li><br>
 <li>"vidio" ( ogv | wmv | mov | mpg | mp4 | avi | mpeg).</li><br>
 <li>"document" ( txt | doc | docx | xls | xlsx | ppt | pptx | pdf | zip | rar | iso).</li><br>
 </ul>

<span class="tag tag-indigo" style="font-size:10px">SISTEM FILTER</span> dilakukan pada sisi <span class="tag tag-indigo" style="font-size:10px">CLIENT</span> dan <span class="tag tag-indigo" style="font-size:10px">SERVER</span>, sehingga <br>
jika anda ingin menambahkan extension baru,, anda dapat menambahkan pada File <br>
<code>Application/Controller/Service_Upload.php</code> , tepatnya pada <span class="tag tag-indigo" style="font-size:10px">LINE 56 </span>   <span class="tag tag-indigo" style="font-size:10px">$config['allowed_types']</span><br><br>
<span class="tag tag-red" style="font-size:10px">CATATAN :</span>
<div style="font-size:14px">
jika anda mengubah pengaturan  <span class="tag tag-indigo" style="font-size:10px">$config['allowed_types']</span>,<br>
pastikan bahwa <span class="tag tag-indigo" style="font-size:10px">type vidio</span></span> berada <span class="tag tag-indigo" style="font-size:10px">paling depan</span> , <br>
jika tidak maka akan terjadi error saat upload.
</div>
</div>
</div>

<div class="col-md-12 col-xl-12" id="auto-save">
<b>AutoSave</b>
<div class="alert alert-secondary" role="alert">
agar lebih dinamis ,YBS system menyediakan fitur AutoSave <span class="tag tag-indigo" style="font-size:10px">TRUE</span> or <span class="tag tag-indigo" style="font-size:10px">FALSE</span><br><br>
Pada dasarnya konsep upload multiple file hanyala trik belaka..<br>
file tidak di upload langsung secara bersamaan dalam sekali pengiriman.<br><br>

Jika anda memperhatikan secara detail bagaimana email(gmail,yahoo,etc) bekerja saat attachment multiple file,<br>
youtube,google drive,dropbox,dll. anda akan mendapatkan bahwa file yg telah di attachment tidak di kirim<br>
bersamaan dengan data-data lain saat tombol "send","upload" di tekan.<br><br>
bahkan file sama sekali tidak di upload/kirim pada saat tombol itu ditekan.<br><br>
jika anda memperhatikan dengan seksama..<br>
maka anda akan mendapati ketika<br>
selesai memilih file untuk di attachment pada saat itu juga lah<br>
seluruh file yang telah terpilih akan terupload ke server secara berurutan.<br>
dengan memanfaatkan fitur Asycn yang memungkinkan sebuah proses dapat berjalan tanpa<br>
harus menunggu proses lain selesai..<br><br>

sehingga pada saat tombol <span class="tag tag-indigo" style="font-size:10px">SEND</span> ditekan, yang dikirim hanya tinggal text,dan variable2 lainnya.<br><br>
<div style="font-size:14px"><b>
Teknik ini memisahkan pengiriman file dengan text-text/variable-variable lainnya<br>
sehingga mengurangi resiko kegagalan pengiriman, dan <br>
loading time, karena jumlah data yang besar.
</b></div><br><br>

Dropzone.js juga menerapkan hal yang sama dalam mengupload multiple file.<br>
seluruh file yang terpilih akan diupload secara otomatis ke server,<br><br>
proses Server di handle oleh YBS System dengan memanfaatkan <b>fitur CI</b>. <br>
Fungsi AutoSave sendiri adalah fungsi untuk mengarahkan file upload ke<br>
<b>folder temporary</b> atau ke <b>folder tujuan yang sebenarnya</b>.<br><br>
file yang berada pada folder temporary akan segera di hapus saat halaman<br>
yang menggunakan Dropzone-YBS system di refresh/di panggil.<br><br>
jika anda menggunakan <span class="tag tag-indigo" style="font-size:10px">AutoSave = false</span> ,maka file yang di kirim ke server<br>
akan di arahkan ke <span class="tag tag-indigo" style="font-size:10px">folder temp_upload</span> (folder temporary).<br>
untuk memindahkannya kembali ke folder tujuan yang sebenarnya <br>
anda dapat menggunakan perintah javascript berikut :<br><br>

<span class="tag tag-green" style="font-size:10px">Menyimpan Permanent File Upload (Javascript code)</span><br>
<b><pre>dropzone_save('#id_dropzone');</pre></b>
<span class="tag tag-red" style="font-size:10px">CATATAN :</span>
<div style="font-size:14px">
fungsi ini di jalankan ketika semua proses upload data selesai dilakukan.
</div>

</div>
</div>

<div class="col-md-12 col-xl-12" id="remove-file">
<b>allowRemoveFile</b>
<div class="alert alert-secondary" role="alert">
default Dropzone.js- dilengkapi dengan tombol Remove file,<br>
namun tombol ini hanya Meremove File dari tampilan Upload Dropzone,<br>
tidak meremove file yang sesungguhnya..<br><br>
YBS Sytem menambahkan fungsi Remove File Pada Server saat tombol tersebut di tekan.<br>
jika menggunakan <span class="tag tag-indigo" style="font-size:12px">allowRemoveFile = true</span> maka file di server juga akan di hapus saat <br>
<span class="tag tag-indigo" style="font-size:10px">TOMBOL REMOVE FILE</span> ditekan. namun hal ini hanya berlaku untuk penggunaan <span class="tag tag-indigo" style="font-size:10px">AutoSave = true</span> 
 
</div>
</div>

<div class="col-md-12 col-xl-12" id="max-size">
<b>Max File & Size</b>
<div class="alert alert-secondary" role="alert">
Pengaturan Max File dan Max Size file upload dilakukan pada Sisi Client dan Server.<br><br>
Default value dari sisi client :<br>
<span class="tag tag-indigo" style="font-size:14px">max_size : 25 Mb/file</span><br>
<span class="tag tag-indigo" style="font-size:14px">max_files: 20 file</span> <br><br>  

Default value dari sisi server :<br>
<span class="tag tag-indigo" style="font-size:14px">max_size : 500 Mb/file</span><br><br>
<span class="tag tag-red" style="font-size:10px">CATATAN : </span><br>
<div style="font-size:14px">jika anda bekerja lokal , dan mengupload file > 2Mb maka anda harus mengubah<br>
pengaturan file <b>php.ini</b> pada :<br>
<span class="tag tag-indigo" style="font-size:10px">post_max_size</span> dan 
<span class="tag tag-indigo" style="font-size:10px">upload_max_filesize</span></div>

</div>
</div>

<div class="col-md-12 col-xl-12" id="return-var">
<b>Variable Return From Server</b>
<div class="alert alert-secondary" role="alert">
setelah file terupload server akan mengirim nilai balikan yang dapat anda gunakan.<br>
seperti : <span class="tag tag-indigo" style="font-size:14px">timestamp</span> , <span class="tag tag-indigo" style="font-size:14px">extension</span> , <span class="tag tag-indigo" style="font-size:14px">original name</span> dari setiap file yang di upload.<br>  <br>  
untuk mengaksesnya anda dapat mengambilnya dari attribut html dropzone<br><br>
mendapatkan data timestamp :<br>
<b><pre>var tm = $("#my_dropzone").attr("data-time");</pre></b>
mendapatkan data extension :<br>
<b><pre>var xt = $("#my_dropzone").attr("data-ext");</pre></b>
mendapatkan data Original File :<br>
<b><pre>var om = $("#my_dropzone").attr("data-orig-name");</pre></b>

<span class="tag tag-red" style="font-size:10px">CATATAN : </span><br>
- Jika upload multiple file,maka data <span class="tag tag-indigo" style="font-size:10px">TIMESTAMP</span> , <span class="tag tag-indigo" style="font-size:10px"> EXTENSION </span> , <span class="tag tag-indigo" style="font-size:10px"> ORIGINAL FILE NAME</span> dipisahkan dengan spasi.<br>
- Data tersebut <span class="tag tag-red" style="font-size:10px">HANYA TERSEDIA</span> saat proses upload selesai,jika halaman di refresh, maka <span class="tag tag-red" style="font-size:10px">data akan direset</span>.<br>
- untuk memisahkan data return multiple upload dapat menggunakan <span class="tag tag-indigo" style="font-size:10px">FUNGSI SPLIT</span>.<br>
</div>
<br>
<br>
</div>






<div class="col-md-12 col-xl-12" id="akses-file-upload">
<b>Cara Akses File yang telah di upload</b>
<div class="alert alert-secondary" role="alert">
File yang telah di upload tidak dapat <br>di akses langsung dengan menggunakan url path asli dari file tersebut.<br><br>

folder upload telah di proteksi dengan penggunaan htaccess <br>
guna mencegah akses data dari luar sistem<br><br>

Untuk mengakses file yang telah di upload dapat dilakukan dengan 2 cara :<br>
menggunakan <b>PHP code</b> atau <b>JavaScript</b>.<br><br> 
</div>
</div>

<div class="col-md-12 col-xl-12" id="akses-php">
<b>Akses File Upload dengan PHP code</b>
<div class="alert alert-secondary" role="alert">
Memanfaatkan Class <b>YbsServiceStorage.</b><br>
YbsServiceStorage memiliki 2 function/methode yang dapat digunakan yaitu : <br><br>
<span class="tag tag-indigo" style="font-size:14px">get_access_file(uploadtime,TRUE);</span> <br>
<div class="alert alert-primary" role="alert">
mendapatkan informasi <b>type , link , orig_name</b> dari file untuk keperluan display atau download.<br>
uploadtime dapat berisi beberapa nilai timestamp dengan delimeter spasi  " ".<br>
atau uploadtime dapat berisi array timestamp.
</div><br>
<span class="tag tag-indigo" style="font-size:14px">remove_file(uploadtime,TRUE);</span> <br>
<div class="alert alert-primary" role="alert">
meremove/delete file dari server. delete hanya dapat dilakukan satu persatu,tidak dapat menghapus file sekaligus.<br>
ini berarti uploadtime hanya dapat berisi 1 nilai timestamp
</div>
<br>
<b>Membuat Object YbsServiceStorage</b> <br>
<pre>
$storage  = new YbsServiceStorage();
</pre>
akses file :<br>
<pre>
$files = $storage->get_access_file(uploadtime,TRUE);
</pre><br><br>
remove file :<br>
<pre>
$storage->remove_file(uploadtime,TRUE);
</pre><br>

<span class="tag tag-indigo" style="font-size:10px">uploadtime</span> = timestamp yang di dapatkan ketika anda selesai mengupload file.<br>
<span class="tag tag-indigo" style="font-size:10px">TRUE</span> 		= akses file terbatas, akses hanya pada file yang di upload oleh user bersangkutan.<br>
<span class="tag tag-indigo" style="font-size:10px">FALSE</span> 		= akses file tidak terbatas ,dapat mengakses file user lain, dengan menggunakan nilai uploadtime.<br><br>


contoh :<br> 
<pre>
upt =  "1553473119 1553473958";
$storage  = new YbsServiceStorage();
$files = $storage->get_access_file(upt,TRUE);
</pre>

output array :<br>
<pre>
$files = 
			{	0 : {'type':'...', 'link':'...', 'orig_name':'...' }
				 1 : {'type':'...', 'link':'...', 'orig_name':'...' }
			};
		  
		  
</pre>

<span class="tag tag-indigo" style="font-size:10px">type</span> = type file ('image,vidio,audio,application')<br>
<span class="tag tag-indigo" style="font-size:10px">link</span> = url untuk mengakses file,dapat langsung di gunakan pada tag link<br>
<span class="tag tag-indigo" style="font-size:10px">orig_name</span> = nama asli file sebelum di upload.<br>
 
 
</div>
</div>

<div class="col-md-12 col-xl-12" id="akses-javascript">
<b>Akses File Upload dengan JavaScript</b>
<div class="alert alert-secondary" role="alert">
Memanfaatkan fitur <b>dropzone_result.</b> <br>
akses file dengan menggunakan javascript merupakan akses terbatas.<br>
hal ini dilakukan untuk tujuan pengamanan, memperkecil request dari client.<br><br>
Membuat object dari dropzone_result<br>
<pre>
var dr = new dropzone_result(uploadtime);
</pre><br><br>

untuk lebih jelasnya dapat melihat <br>
<b>Snapshot script di bawah ini :</b>

</div>
</div>

<div class="col-sm-12 col-lg-12"  id="script-dropzone-result-snap">
<b>Snapshot Dropzone Result Script</b>
                <div class="card p-3">
                  <a href="javascript:void(0)" class="mb-3">
                    <img src="<?php echo base_url() ?>images/sample/dropzone_result.png" alt="dropzone_script" class="rounded ybs-image-slider" data-image="Script Dropzone" >
                  </a>
                  <div class="d-flex align-items-center px-2">
                    
                    <div>
                      <div>Potongan Script</div>
                   
                    </div>
                 
                  </div>
                </div>
				
</div>







<div class="col-md-12 col-xl-12">
<div class="" id="sample-dropzone">
<div class="form-group">
	<label class="form-label">Contoh Element Dropzone</label>
		<div class="dropzone" id="my_dropzone" data-folder="">
		<div class="fallback">
			<input name="file"  type="file" multiple="" />
		</div>
	</div>
</div>
</div>
</div>



<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code load css dan library Dropzone :</label>
<textarea id="text-code-loadcss" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>			
</div>
<br>






<br>
<br>
<br>
<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">copy code html:</label>
<textarea id="text-dropzone" class="form-control bg-dark text-white" rows="10" readonly></textarea>
</div>			
</div>
<br>




<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">dan copy script upload file:</label>
<textarea id="text-script-dropzone" class="form-control bg-dark text-white" rows="5" readonly></textarea>
</div>	
<br>
<br>		
</div>


<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">Mendapatkan TimeStamp,extension,orig_name dari file yang baru di upload</label>
<textarea id="script-get-data" class="form-control bg-dark text-white" rows="5" readonly></textarea>
</div>			
</div>
<br>

<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">Akses File dengan menggunakan PHP Code</label>
<textarea id="php-code-akses-file" class="form-control bg-dark text-white" rows="5" readonly></textarea>
</div>			
</div>
<br>

<div class="col-md-12 col-xl-12" >
<div class="form-group">
 <label class="form-label">Akses File menggunakan javascript:</label>
<textarea id="text-script-akses-file" class="form-control bg-dark text-white" rows="5" readonly></textarea>
</div>			
</div>
<br>




			  

<div class="col-md-12 col-xl-12" >

<h5>untuk sample element lainnya anda dapat melihat pada Source code Original Template Tabler.</h5>


</div>




<?php echo _js('ybs,dropzone')?>

<script>
$(document).ready(function(){
	//------------dropzone----------------//
	var a = '<\!-- load css--\> \n'+
		'<\!-- tempatkan code ini pada top page view--\>\n'+
		'<\?php echo _css("dropzone")\?> \n' +
		'\n'+
		'\n'+
		'<\!-- load library --\> \n'+
		'<\!-- tempatkan code ini pada akhir code html sebelum masuk tag script--\>\n'+
		'<\?php echo _js("ybs,dropzone")\?> \n' +
		'';
	$('#text-code-loadcss').val(a);
	
	
	
	var a = '<div class="col-md-12 col-xl-12" > \n' +
			'<div class="form-group"> \n'+
			'	<label class="form-label">Dropzone</label>\n'+
			'		<div class="dropzone" id="my_dropzone" data-folder=""> \n'+
			'		<div class="fallback">\n'+
			'			<input name="file"  type="file" multiple="" />\n'+
			'		</div>\n'+
			'	</div>\n'+
			'</div>\n'+
			'</div>\n'+
			'';
	

	
	
	
	$('#text-dropzone').val(a);
	
	var a ='';
		a = '<script> \n'+
			'	dropzone_area({ \n'+
			'		elementID 				: "#my_dropzone",	//--\> element id \n'+
			'		type					: "all",			//--\> type file \n'+
			'		autosave				: false, 			//--\> autosave to destination \n'+		
			'		allowRemoveFile			: false,			//--\> allow remove file in server when autosave is true \n'+
			'		max_files				: 10, 				//--\> Max file upload on page \n'+
			'		max_size				: 100, 				//--\> max..Mb/file \n'+
			'	});\n'+
			' \n'+
			' \n'+
			' \n'+
			' //script ini hanya digunakan jika menggunakan autosave= false \n'+
			' //jalankan script ini dalam sebuah action baru.\n' +
			' //script ini menyimpan file secara permanent,jalankan jika semua proses insert data telah selesai \n' +
			' //dropzone_save("#my_dropzone"); \n'+
			' \n'+
			' \n'+
			'<\/script>';
	
	
	$('#text-script-dropzone').val(a);
	
	
	
	
	var a = '';
		a =	'<script> \n'+
			'	var tm = $("#my_dropzone").attr("data-time"); \n'+
			'	var xt = $("#my_dropzone").attr("data-ext"); \n'+
			'	var om = $("#my_dropzone").attr("data-orig-name"); \n'+
			'<\/script>';
	
	
	$('#script-get-data').val(a);
	
	
	
	
	var a = '';
		a =	' //membuat object YbsServiceStorage \n'+
			' $storage = new YbsServiceStorage();  \n'+
			' \n'+
			' //akses file\n'+
			' $files = $storage->get_access_file("..masukkan uploadtime..",TRUE);\n'+
			' \n'+
			' //delete or remove file\n'+
			' $storage->remove_file("..masukkan uploadtime..",TRUE);\n'+
			'';
	
	
	$('#php-code-akses-file').val(a);
	
	
	
	
	var a = '';
		a =	'	var a = new dropzone_result("..masukkan uploadtime.."); \n'+
			'	a.onComplite = function(data){ \n'+
			'		var f = JSON.parse(data.message); \n' +
			'		$.each(f,function(k,y){ \n' +
			'			var orig_name	= y.orig_name;	\n'+
			'			var type_file	= y.type;	\n'+
			'			var url			= y.link;	\n'+
			'		}) \n'+
			'	}';
	
	
	$('#text-script-akses-file').val(a);
	
	
	
	
	
	
	//------------END Card----------------//
})	
</script>



<script>
	dropzone_area({
		elementID 			: '#my_dropzone',	//--> element id
		type				: 'all',
		autosave			: false, 
		allowRemoveFile		: false,
	});
</script>	
	