/*
*|------------------------------------------------------------|
*|				background-color input text	,box		          |
*|------------------------------------------------------------|
*/
if (!window.location.origin) {
  window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
};

	

	function get_random_color(){
		var c = Array('bg-blue-lightest','bg-green-lightest','bg-red-lightest','bg-indigo-lightest','bg-purple-lightest','bg-pink-lightest','bg-orange-lightest','bg-yellow-lightest','bg-lime-lightest','bg-teal-lightest','bg-gray-lightest');
		var i = c[Math.floor(Math.random()*c.length)];
		return i;
	};
	
	
	
	$(".focus-color").focus(function(){
		$(this).css("background-color","#fff09e");
	});
	
	

		var color_entered="";
		var def_color_t1="";
		var def_color_t2="";
		var title1="";
		var title2="";
		$(".btn-card").mouseenter(function(){		
			title1 =$(this)[0].children[0].children[1].children[0];
			title2 =$(this)[0].children[0].children[1].children[1]; 
			def_color_t1 = title1.classList[2];
			def_color_t2 = title2.classList[2];
			color_entered = 'text-white';
			$(title1).removeClass(def_color_t1);
			$(title2).removeClass(def_color_t2);
			
			$(title1).addClass(color_entered);
			$(title2).addClass(color_entered);
			
			
		}).mouseleave(function(){
			$(title1).removeClass(color_entered);
			$(title2).removeClass(color_entered);
			// $(title1).addClass(def_color_t1);
			// $(title2).addClass(def_color_t2);
		})
		
		
		
		
		
	
	
		
	
	$(".focus-color").blur(function(){
		$(this).css({"background-color":""});
	});
	

function ucfirst (str){
  if (typeof str !== 'string') return ''
  return str.charAt(0).toUpperCase() + str.slice(1)
}

/*--------------------------end-------------------------------|

	
/*	
*|------------------------------------------------------------|
*|				check uncheck header table				      |
*|------------------------------------------------------------|
*/
	$('#general_check').change(function (){
		var status = $('#general_check').prop('checked');
		$('.checkbox').prop('checked',status).iCheck('update');
	});
		
	$('.checkbox , input[type="checkbox"].flat-red').click(function(){		
		var status = $(this).prop('checked');
		if(false==status){
			$('#general_check').prop('checked',false);
		}
			
		var count_checkbox = $('.checkbox').length;
		var count_check	=$('.checkbox:checked').length;
							
		if(count_check==count_checkbox){
			$('#general_check').prop('checked',true);
		}
						
	});
	

	function action_change(id_table,id_header){
		$('#'+id_header).change(function (){
				var status = $('#'+id_header).prop('checked');
				$('#' + id_table +' .checkbox').prop('checked',status).iCheck('update');
		});
	}	


	var ybs_table = $('table.ybs-table');
	$.each(ybs_table,function(key,val){
		id_table = val.id;

			$('#'+id_table+'.ybs-table th.checkbox-header').append('<label><input id="'+'header-checkbox-'+id_table+'" type="checkbox" class="header-checkbox"> </label>');
			id_header = 'header-checkbox-'+id_table;
			action_change(id_table,id_header)

	})
	

	$('.header-checkbox').change(function(){
		var id_header = $(this).attr('id');
		var it = id_header.toString();
		var id_table = it.replace('header-checkbox-',""); 	
		action_change(id_table,id_header)
	});



	
 /*--------------------------end------------------------------|




/*
*|------------------------------------------------------------|
*|				       click row table		    	          |
*|------------------------------------------------------------|
*/

	var stop = "false";
	$('.table').delegate("tr.ybs-rows-click","click",function(e){
		
		if(e.target.type!=='checkbox'){
				$(':checkbox',this).trigger('click');
				var status = $(':checkbox',this).prop('checked');
				$(':checkbox',this).prop('checked',!status).iCheck('update');
				stop ="true";
		}
							
	});
	
	var stops = "false";
	$('.table').delegate("tr.ybs-rows-click.sound-table","click",function(e){
		
		if(e.target.type!=='checkbox'){
				$(':checkbox',this).trigger('click');
				var status = $(':checkbox',this).prop('checked');
				$(':checkbox',this).prop('checked',!status).iCheck('update');
				play_sound_apply();
				stops ="true";
		}
							
	});

	
/*--------------------------end--------------------------------|


/*
*|------------------------------------------------------------|
*|				       get row table checked	   	          |
*|------------------------------------------------------------|
*/
	(function( $ ){
		$.fn.get_checked = function(id){
			if(id== "" || id==null){
				id = $(this).attr('id');
			}
			var check_value =[];
			var count_checkbox = $('#'+id + ' .checkbox').length;
			var count_check	=$('#'+id +' .checkbox:checked').length;
			var data=$('#'+id +' .checkbox:checked');
			for(x=0;x<count_check;x++){
				var d ="";
				d = data[x].value;
				check_value.push( d.trim());
			}		
			return check_value;
		};
			
	}( jQuery ));

	function get_checked_table(){
		var check_value =[];
		var count_checkbox = $('.checkbox').length;
		var count_check	=$('.checkbox:checked').length;
		var data=$('.checkbox:checked');
		for(x=0;x<count_check;x++){
            var d ="";
            d = data[x].value;
			check_value.push( d.trim());
		}		
		return check_value;
	}
	
	function get_total_value_table(id_col){
		var check_value =[];
		var count_col = $(id_col).length;
		var data=$(id_col);
	
		for(x=0;x<count_col;x++){
			ss = data[x].text;
		
		}		
		return ss;
	}	

/*--------------------------end-------------------------------|


/*
*|------------------------------------------------------------|
*|				convert data to format json 	          	  |
*|------------------------------------------------------------|
*/
	function convert_to_editor(val){
		var data = val.toString();
		v1 = data.replace(/\\/gi,'\\\\');
		v2 = v1.replace(/\"/gi,'\\"');
		v3 = v2.replace(/\'/gi,'\'');
		return v3;
	}
	
	function get_json_format(key,val){
		try{
			var data = val.toString();	
			v1 = data.replace(/\\/gi,'\\\\');
			v2 = v1.replace(/\"/gi,'\\"');
		
			v2 = v2.replace(/\&/gi,'%26');
			v2 = v2.replace(/\+/gi,'%2B');
		
		
			
			k1 = key.replace(/\\/gi,'\\\\');
			k2 = k1.replace(/\"/gi,'\\"');
					
			k2 = k2.replace(/\&/gi,'%26');
			
			var nmbr = $('#'+key); 
			
			if(nmbr === undefined){
				
			}else{

				if($(nmbr).hasClass('ybs-input-number')){
					v2 = v2.replace(/\,/gi,""); 
				}
			}
			
			obj = '"'+k2.trim()+'":"'+v2.trim()+'"';
			return obj;
		}catch(error){
			return   '"'+key+'":""';
		
		}
		
	
	}
	
	function get_post_format(key,val){
		try{
			var data = val.toString();	
			v1 = data.replace(/\\/gi,'\\\\');
			v2 = v1.replace(/\"/gi,'\\"');
		
			v2 = v2.replace(/\&/gi,'%26');
			v2 = v2.replace(/\+/gi,'%2B');
		
		
			
			k1 = key.replace(/\\/gi,'\\\\');
			k2 = k1.replace(/\"/gi,'\\"');
					
			k2 = k2.replace(/\&/gi,'%26');
			
			var nmbr = $('#'+key); 
			
			if(nmbr === undefined){
				
			}else{

				if($(nmbr).hasClass('ybs-input-number')){
					v2 = v2.replace(/\,/gi,""); 
				}
			}
			
			obj = k2.trim()+'='+v2.trim();
			return obj;
		}catch(error){
			return   key+'=';
		
		}
		
	
	}

(function( $ ){
	$.fn.ybs_json= function(name_element){
		var name = name_element;
	
		if(name== "" || name==null || name===undefined){
			name = $(this).attr('name');
			if(name== "" || name==null || name===undefined){
				name = $(this).attr('id');
			}
		}
	
		var a;
		if(name===undefined){
			
		}else{
			a = get_json_format(name,$(this).val());
		}
	
		return a;
	};
		
}( jQuery ));

function ybs_dataSending(arr){
  	    var d_open  = "data_ajax={" ;
		var d_body  = "";
		var d_close = "}";
		$.each(arr, function(index,val){
			d_body = d_body + val + ",";
		});
	
		
		d_body =d_body.substr(0,d_body.length-1 );
		
		return d_open+d_body+d_close;
}

function get_dataSending(id_form){
	var x = $('#'+id_form+' .data-sending');
	var data=[];
	$.each(x,function(key,val){
			var d = $(val).ybs_json();
			if(d===undefined){}else{
				data.push(d);
			}
			
	});
	
	
	return data;
}

function getForm(id_form){
	var summary = [];
	$('#'+id_form).each(function () {
		var a = $(this).find(':input');
		$(a).each(function () {
			if(this.type=="radio" || this.type=="checkbox"){
				if(this.name !=="" && $(this).attr("checked") !== undefined){
					var a  = get_json_format(this.name,this.value);
					summary.push(a);
				}
				
			}else{
				if(this.name !=="" ){
					var a  = get_json_format(this.name,this.value);
					summary.push(a);
				}
			}
			
		})
	
	});
	
	
	return summary;
}




function ybs_dtSending(arr){
  	    var d_open  = "{" ;
		var d_body  = "";
		var d_close = "}";
		$.each(arr, function(index,val){
			d_body = d_body + val + ",";
		});
	
		
		d_body =d_body.substr(0,d_body.length-1 );
		
		return d_open+d_body+d_close;
}


	
	
/*--------------------------end-------------------------------|



/*	
*|------------------------------------------------------------|
*|				      sound click				 	          |
*|------------------------------------------------------------|
*/
	$('.sound-apply').click(function(){
		play_sound_apply();	
	});
	$('.sound-entered').click(function(){
		play_sound_entered();	
	});
	$('.sound-click').click(function(){
		play_sound_click();	
	});
	$('.sound-success').click(function(){
		play_sound_success();	
	});
	$('.sound-failed').click(function(){
		play_sound_failed();	
	});





	var sound_click = $("#sound_click")[0];
	var sound_entered = $("#sound_entered")[0];
	var sound_apply = $("#sound_apply")[0];
	var sound_success = $("#sound_success")[0];
	var sound_failed = $("#sound_failed")[0];

	function play_sound_click(){
		sound_stop();
		prepare_sound();
		sound_click.play();
	}
	function play_sound_entered(){
		sound_stop();
		prepare_sound();
		sound_entered.play();
	}
	function play_sound_apply(){
		sound_stop();
		prepare_sound();
		sound_apply.play();
	}
	function play_sound_success(){
		sound_stop();
		prepare_sound();
		sound_success.play();
	}
	function play_sound_failed(){
		sound_stop();
		prepare_sound();
		sound_failed.play();
	}
	
	function sound_stop(){
		sound_click = "";
		sound_entered = "";
		sound_apply = "";
		sound_success = "";
		sound_failed = "";
	}
	
	function prepare_sound(){
		sound_click = $("#sound_click")[0];
		sound_entered = $("#sound_entered")[0];
		sound_apply = $("#sound_apply")[0];
		sound_success = $("#sound_success")[0];
		sound_failed = $("#sound_failed")[0];
	}
/*--------------------------end-------------------------------|


/*
*|------------------------------------------------------------|
*|				      ICHECK & SELECT2 STYLE	 	          |
*|------------------------------------------------------------|
*/
	function load_style_icheck(){
	  $(function () {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Datemask dd/mm/yyyy
		$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		//Datemask2 mm/dd/yyyy
		$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
		//Money Euro
		$('[data-mask]').inputmask()

		//Date range picker
		$('#reservation').daterangepicker()
		//Date range picker with time picker
		$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
		//Date range as a button
		$('#daterange-btn').daterangepicker(
		  {
			ranges   : {
			  'Today'       : [moment(), moment()],
			  'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			  'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
			  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			  'This Month'  : [moment().startOf('month'), moment().endOf('month')],
			  'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			startDate: moment().subtract(29, 'days'),
			endDate  : moment()
		  },
		  function (start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
		  }
		)

		//Date picker
		$('#datepicker').datepicker({
		  autoclose: true
		})
		$('.datepicker').datepicker({
		  autoclose: true,
		  format:'dd.mm.yyyy'
		})

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		  checkboxClass: 'icheckbox_minimal-blue',
		  radioClass   : 'iradio_minimal-blue'
		})
		//Red color scheme for iCheck
		$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		  checkboxClass: 'icheckbox_minimal-red',
		  radioClass   : 'iradio_minimal-red'
		})
		//Flat red color scheme for iCheck
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		  checkboxClass: 'icheckbox_flat-green',
		  radioClass   : 'iradio_flat-green'
		})


		//Colorpicker
		$('.my-colorpicker1').colorpicker()
		//color picker with addon
		$('.my-colorpicker2').colorpicker()

		//Timepicker
		$('.timepicker').timepicker({
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false,
			showInputs: false
			
	
		})
		


		
		
	  })

	}
/*--------------------------end--------------------------------|



/*
 *|------------------------------------------------------------|
 *|				      button header form list	 	           |
 *|------------------------------------------------------------|
*/
	function  action_button_header(link_create,link_delete,link_excel,link_pdf,link_word,link_update,tableID){
				$('#menu_link_create').click(function(){
					$('#button_front_c_d').removeClass('btn-delete');
					$('#button_front_c_d').removeClass('btn-update');
					$('#button_front_c_d').addClass('btn-create');
					
					$('#button_front_c_d').attr('title','create');
					$('#button_front_c_d').html('<i class="fa  fa-file-o"></i>  Create');
					$('#btn-general-1').attr('onclick','load_paging("'+link_create+'","")');
					$('#btn-general-1').click();

				});
				
				$('#menu_link_update').click(function(){
					$('#button_front_c_d').removeClass('btn-delete');
					$('#button_front_c_d').removeClass('btn-create');
					$('#button_front_c_d').addClass('btn-update');
					var data =get_checked_table();
					$('#button_front_c_d').attr('title','Update Checked');
					$('#button_front_c_d').html('<i class="fa fa-pencil-square-o"></i>  Update Checked');
					
					$('#btn-general-1').attr('onclick','load_paging("'+link_update+'","'+data +'")');
					$('#btn-general-1').click();
				
					
				});
				
				$('#menu_link_delete').click(function(){
					$('#button_front_c_d').removeClass('btn-create');
					$('#button_front_c_d').removeClass('btn-update');
					$('#button_front_c_d').addClass('btn-delete');
					
					var data =get_checked_table();
					var fdata=[];
					var id_data=[];
					var sdata;
					var x=0;
					for(x=0;x<data.length;x++){
						sdata = data[x].split("-");
						id_data.push(sdata[0]); 
						fdata.push((x+1)+". "+sdata[1]);
					}
						$('.modal-body').empty();
						$('#button_front_c_d').attr('title','delete');
						$('#button_front_c_d').html('<i class="fa fa-trash-o"></i>  Delete Checked');
					
					if(data.length>0){
						$('.modal-body').empty();
						$('.modal-body').append("<p>Data yang akan di hapus :</p>");
						$('.modal-body').append("<p>"+fdata+"</p>");
						$('#button_konfirm_delete').attr('onclick','ybsProcDelTable("'+id_data +'","'+link_delete+'","'+tableID+'")');
						
						$('#button_front_c_d').attr('data-toggle','modal');
						$('#button_front_c_d').attr('data-target','#modal-danger');
						$('#menu_link_delete').attr('data-toggle','modal');
						$('#menu_link_delete').attr('data-target','#modal-danger');
						
						
					}
				
				});
				
				
				$('#button_front_c_d').click(function(){

					var data =get_checked_table();
					var fdata=[];
					var sdata;
					var x=0;
					for(x=0;x<data.length;x++){
						sdata = data[x].split("-");
						fdata.push((x+1)+". "+sdata[1]);
					}
						$('.modal-body').empty();
						$('#button_front_c_d').attr('data-toggle','');
						$('#button_front_c_d').attr('data-target','');

						
					if($('#button_front_c_d').hasClass('btn-create')){
						$('#btn-general-1').attr('onclick','load_paging("'+link_create+'","'+data +'")');
						$('#btn-general-1').click();
					}else if($('#button_front_c_d').hasClass('btn-delete')){	
						if(data.length>0){
							if($('#button_front_c_d').hasClass('btn-delete')){
								$('.modal-body').empty();
								$('.modal-body').append("<p>Data yang akan di hapus :</p>");
								$('.modal-body').append("<p>"+fdata+"</p>");
								$('#button_konfirm_delete').attr('onclick','ybsProcDelTable("'+data +'","'+link_delete+'","'+tableID+'")');
								$('#button_front_c_d').attr('data-toggle','modal');
								$('#button_front_c_d').attr('data-target','#modal-danger');

							}	
						
						}	
					}
						
						
				});	
				
				
				$('#button_front_download').click(function(){
				//	alert('ok');
				});
				$('#download_pdf').click(function(){	
				    $('#button_front_download').attr('href',link_pdf);
					$('#button_front_download').html('<i class="fa fa-arrow-circle-down"></i>  download pdf');
				});
				
				$('#download_word').click(function(){
						$('#button_front_download').attr('href',link_word);
						$('#button_front_download').html('<i class="fa fa-arrow-circle-down"></i>  download word');
				});
				$('#download_excel').click(function(){
						$('#button_front_download').attr('href',link_excel);
						$('#button_front_download').html('<i class="fa fa-arrow-circle-down"></i>  download excel');
				});	
	


	}

/*--------------------------end--------------------------------|


/*
 *|------------------------------------------------------------|
 *|				      Table Filtering			 	           |
 *|------------------------------------------------------------|
 */

	function ybs_table_filter(table_id,txtsearch){
		var input,filter,tr,td,i,column_search;
		
		input = document.getElementById(txtsearch);
		filter = input.value.toUpperCase();
		
		columnsearch = document.getElementById('button_filter').value;
		
		
		table = document.getElementById(table_id);
		tr = table.getElementsByTagName('tr'); 

		
		for(i=0; i<tr.length; i++){
			td = tr[i].getElementsByTagName('td')[columnsearch]; 

			if(td){
				if(td.innerHTML.toUpperCase().indexOf(filter)>-1){
					tr[i].style.display="";
				}else{
					tr[i].style.display="none";
				}
			}
			
		}
		
		
	}

/*--------------------------end--------------------------------|





/*
 *|------------------------------------------------------------|
 *|				      Table Filtering 2			 	           |
 *|------------------------------------------------------------|
 */

	$(".filter-table").click(function(){
		var id_ft = $(this).prop('id');
		var s = id_ft.split('--');
		$('#button_filter').val(s[1]);
		$('#button_filter').html($('#'+id_ft).text() + "&nbsp; <span class='caret'></span><span class='sr-only'>Toggle Dropdown</span>");
	});
	

 
 
 /*--------------------------end--------------------------------|






/*
*|------------------------------------------------------------|
*|				      Show message				 	          |
*|------------------------------------------------------------|
*/
	function show_error_message(data){
		//$('#message_error').html('<div class="alert alert-danger alert-dismissible" id="message_box"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa  fa-exclamation"></i>'+data+'</div>');
		config_toast_master();
		toastr["error"](data);
	}	

	function show_warning_message(data){
		//$('#message_error').html('<div class="alert alert-danger alert-dismissible" id="message_box"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa  fa-exclamation"></i>'+data+'</div>');
		config_toast_master();
		toastr["warning"](data);
	}	

	
	function remove_message(){
		//config_toast_master();
		toastr.clear();
	}	
	function show_success_message(data){
		//$('#message_error').html('<div class="alert alert-success alert-dismissible" id="message_box"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fa  fa-check"></i>'+data+'</div>');
		config_toast_master();
		toastr["success"](data);
	}
		
	function config_toast_master(){
		toastr.clear();
		toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-bottom-full-width",
				  "preventDuplicates": true,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "20000",
				  "timeOut": "20000",
				  "extendedTimeOut": "20000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				}
	}	


	function start_loading_in(element){
		var ie = element;
		ie= ie.replace("#","_");
		ie= ie.replace(".","_");
		ie= ie.replace(" ","");
		//alert(ie);
		if($('#loading_progress'+ie).hasClass('overlay')){
			
		}else{
			$(element).append('<div class="overlay" id="loading_progress'+ie+'"> <i class="fa fa-refresh fa-spin"></i></div>');
		}
		
	}

	function stop_loading_in(element){
		var ie = element;
		ie= ie.replace("#","_");
		ie= ie.replace(".","_");
		ie= ie.replace(" ","");
		//alert(ie);
		$('#loading_progress'+ie).remove();
	}

/*--------------------------end--------------------------------|



/*
*|------------------------------------------------------------|
*|			Load View,search form,request process	          |
*|------------------------------------------------------------|
*/

var svrUFile 			= '/Service_Upload/upload/';	
var svrRFile  			= '/Service_Upload/remove_upload/';

var svrCMB 				= '/YbsService/combobox_data'; 
var svrTMP      		= '/Service_Upload/save_temp/';
var svrAccessFile		= '/Service_Storage/get_access_file/';
var svrAccessFileTMP	= '/Service_Storage/get_access_file_temp/';
var svrClearTMP			= '/Service_Upload/clear_temp/';




	function load_paging(url_form,param){
		start_loading_in('#box-content-body');
		d = url_form;
		dt = get_json_format('data',param);
		send_data = ybs_dataSending([dt]);
		
		$.ajax({type:'GET',
				url:d,
				data: send_data,
				processData:false,
				cache:false,
				success:function(data){
					var a =JSON.parse(data);
					switch(a.success){
						case 'true' :
							remove_error_message();
							
							stop_loading_in('#box-content-body');
							$('#box-content-body').hide();
							$('#box-content-body').html(a.message);
							$('#box-content-body').fadeIn();
							$('.box').boxWidget();
							
							$('#count-notification').remove();
							$('#id-notify').after(a.count_notify);
							
							$('#id-list-notify').empty();
							$('#id-list-notify').append(a.data_notify);
							
							$('#menu-notification').after(a.menu_configurator);
							
							$('#id-title-page').empty();
							$('#id-title-page').append(a.title_page);
							
							$('.breadcrumb').remove();
							$('#id-title-page').after(a.breadcrumb);

							break;
						case 'false' :
							show_error_message(a.message)
							$(a.elementid).focus();
							play_sound_failed();
							stop_loading_in('#box-content-body');
							break;
						case 'redirect' :
					     	load_paging(a.message,a.param);
							break;
						case 'redirect-no-ajax' :
					     	$('#redirect-form').prop('action',a.message);
							$('#redirect-button').click();
							break;	
					}
				},
								
		});
	}
	
	function search_form(url_form){
		start_loading_in('#box-content-body');
		d = url_form;
		code = $('#txt_search_form').ybs_json();
		send_data = ybs_dataSending([code]);

		$.ajax({type:'GET',
				url:d,
				data: send_data,
				processData:false,
				cache:false,
				success:function(data){
					var a =JSON.parse(data);
					switch(a.success){
						case 'true' :
							load_paging(a.message,"");
							
							break;
						case 'false' :
							show_error_message(a.message)
							$(a.elementid).focus();
							play_sound_failed();
							stop_loading_in('#box-content-body');
							break;
						case 'redirect' :
					     	load_paging(a.message,a.param);
							break;
						case 'redirect-no-ajax' :
					     	$('#redirect-form').prop('action',a.message);
							$('#redirect-button').click();
							break;	
					}
					
				},
								
		});
	}
	
	function ybsRequest(){
	
	}
	ybsRequest.prototype.loadingIn = function(){
			return '#box-content-body';
	}
	
	ybsRequest.prototype.beforeProcess = function(){
		
	}
	
	
	ybsRequest.prototype.onBeforeSuccess = function(data){

	}
	
	ybsRequest.prototype.onSuccess = function(data){
		show_success_message(data.message);							
		play_sound_success();
	}
	
	ybsRequest.prototype.onAfterSuccess = function(data){

	}
	
	
	ybsRequest.prototype.onBeforeFailed =function(data){
		
	}
	
	ybsRequest.prototype.onFailed = function(data){
		$(data.elementid).focus();
		show_error_message(data.message)
		play_sound_failed();
	}
	
	ybsRequest.prototype.onAfterFailed =function(data){
		
	}
	
	ybsRequest.prototype.onError = function(xhr, status, error){
		if(error=="Forbidden"){
			show_error_message("Opps..akses ditolak..!! refresh halaman ini..");
		}else{
			show_error_message(error);
		}
		
		play_sound_failed();
	}
	
	ybsRequest.prototype.onComplite = function(){
		
	}
	

	ybsRequest.prototype.process = function(url_form,param,type){
		var req = this; 
		
		var ar = Array.isArray(param);
		if(ar==true){
			param = ybs_dataSending(param);
		}
		
		if(type==null || type ==""){
					type="GET";
		}

				d = url_form;
				send_data = sec_val + param;
				if(sec_val===undefined){
					send_data = param;
				}
				
				
				$.ajax({type:type,
					url:d,
					data: send_data,
					processData:false,
					cache:false,
					
					beforeSend: function(){
						start_loading_in(req.loadingIn());
						req.beforeProcess();
					},
					
					success:function(data){
						try{
							var a =JSON.parse(data);
							sec_val = a.sec_val;
							switch(a.success){
								case 'true' :
									req.onBeforeSuccess(a);
									req.onSuccess(a);
									req.onAfterSuccess(a);
									break;
								case 'false' :
									req.onBeforeFailed(a);
									req.onFailed(a);
									req.onAfterFailed(a);
									break;
								case 'redirect' :
									$('#redirect-form').prop('action',a.message);
									var t = get_sec_val();
									$('#redirect-form-tk').val(t);
									$('#redirect-button').click();
									break;

							}
							
						}catch(error){
							req.onBeforeSuccess(data);
							req.onSuccess(data);
							req.onAfterSuccess(data);
						}
							
					},
					error: function(xhr, status, error){
						req.onError(xhr, status, error);
					},
					complete: function(){						
							req.onComplite();
							stop_loading_in(req.loadingIn());
					},
									
				});
	}
	
	ybsRequest.prototype.processUploadFile = function(idform,path_upload,autosave){
		var f="";
		var host = document.location.origin;
		
		if(xax==""){
			f = "";
		}else{
			f = "/" + xax;
		}
		
		link_data 	=host +f+svrUFile+data_token;	  
		link_data 	= link_data.replace(/([^:]\/)\/+/g, "$1");
		
		
				var req = this; 
				var form_el = $("#"+idform)[0] ;
			
				var form_data = new FormData(form_el);
				form_data.append(get_sec_name(),get_sec_val());
				
				if(autosave =="" || autosave ===null || autosave !=="false"){
					autosave="true";
				}
				
				form_data.append("autosave",autosave);
				form_data.append("path_upload",path_upload);
				
				$.ajax({
					type:'POST',
					enctype:'multipart/form-data',
					url:link_data,
					data: form_data,
							
					processData:false,
					contentType:false,
					cache:false,
					
					beforeSend: function(){
						start_loading_in(req.loadingIn());
						req.beforeProcess();
					},
					
					success:function(data){
						try{
							var a =JSON.parse(data);
							sec_val = a.sec_val;
							switch(a.success){
								case 'true' :
								
									req.onBeforeSuccess(a);
									req.onSuccess(a);
									req.onAfterSuccess(a);
									break;
								case 'false' :
									req.onBeforeFailed(a);
									req.onFailed(a);
									req.onAfterFailed(a);
									break;
								case 'redirect' :
									$('#redirect-form').prop('action',a.message);
									var t = get_sec_val();
									$('#redirect-form-tk').val(t);
									$('#redirect-button').click();
									break;

							}
							
						}catch(error){
							req.onBeforeSuccess(data);
							req.onSuccess(data);
							req.onAfterSuccess(data);
						}
							
					},
					error: function(xhr, status, error){
						req.onError(xhr, status, error);
					},
					complete: function(){						
							req.onComplite();
							stop_loading_in(req.loadingIn());
					},
									
				});
	}
	

	
	function get_sec_val(){
				var s = sec_val.split('=');
				var x = s[1].substring(0, s[1].length-1);
				return x;
	}
	
	function get_sec_name(){
				var s = sec_val.split('=');
				return s[0];
	}
	
	function set_sec_val(response){
		var a = JSON.parse(response);	
		sec_val = a.sec_val;
	}

	
	
	function ybsDeleteTable(value,url,tableID){
			 var data = value; 
			 var sdata = data.split("-"); 
			 
			 var x = 1;
			 
			 var info ='';
			 if(sdata.length>1){
				 info = value.replace(sdata[0]+'-','');
			 }
			 $('.modal-body').empty(); 
			 $('.modal-body').append("<p>Data yang akan di hapus :</p>");
			 $('.modal-body').append("<p>"+info+"</p>");
			 $('#button_konfirm_delete').attr('onclick','ybsProcDelTable("'+sdata[0] +'","'+url+'","'+tableID+'")');
			 $('#button_delete_single').click();
	}
	
	function ybsDeleteTableChecked(link_delete,tableID){
			var data =get_checked_table();
			var fdata=[];
			var id_data=[];
			var sdata;
			var x=0;
			for(x=0;x<data.length;x++){
				sdata = data[x].split("-");
				id_data.push(sdata[0]); 
				fdata.push((x+1)+". "+sdata[1]);
			}
			$('.modal-body').empty();
					
			if(data.length>0){
				$('.modal-body').empty();
				$('.modal-body').append("<p>Data yang akan di hapus :</p>");
				$('.modal-body').append("<p>"+fdata+"</p>");
				$('#button_konfirm_delete').attr('onclick','ybsProcDelTable("'+id_data +'","'+link_delete+'","'+tableID+'")');	
				$('#button_delete_single').click();				
			}
	}
	
	
	
	function show_konfirm_delete(content,methode){
		$('.modal-body').empty();
		$('.modal-body').append("<p>Data yang akan di hapus :</p>");
		$('.modal-body').append("<p>"+content+"</p>");
		$('#button_konfirm_delete').attr('onclick',methode);	
		
	}
	
	
	
	function ybsProcDelTable(data,url,tableID){
			dt = get_json_format('data_delete',data);
			send_data = ybs_dataSending([dt]);
			 
			var a = new ybsRequest();
			a.process(url, send_data );
			a.onComplite = function(){
				try{
						var table= $(tableID).DataTable();
						var txt_search = table.search();
						
						//deprecated ,di gantikan dengan destroy pada initial dataTable
						//untuk form yang di generate <=1.0.7
						var ver = ["1.0.1","1.0.2","1.0.3","1.0.4","1.0.5","1.0.6","1.0.7"];
						
						if(page_version===undefined || page_version==null){
							//jika tidak di temukan maka dianggap adalah versi terbaru
							refresh_table(txt_search);
						}else{
							var old_page = ver.includes(page_version);
							//mencegah error untuk versi page yang lama
							if(old_page==true){
								table.clear().draw();
								table.destroy();
								refresh_table(txt_search);								
							}else{
								refresh_table(txt_search);
							}
						}
						
				 }catch(error){
					 //saat page_version tidak di isi maka akan terjadi error.
					 //jika page version tidak ada maka di anggap versi terbaru
					refresh_table(txt_search);
				 }
						
			}

	}
	
	
	
	function update_form_dashboard(url,initial,idform){
		var select='0';
		if($('#ybs-dash').hasClass('text-dark')){
			$('#ybs-dash').removeClass('text-dark');
			$('#ybs-dash').addClass('text-orange');
			select = '1';
		}else{
			$('#ybs-dash').removeClass('text-orange');
			$('#ybs-dash').addClass('text-dark');	
			select='0';
		}
		var x = get_json_format('initial',initial);
		var y = get_json_format('idform',idform);
		var z = get_json_format('select',select);
		send_data = ybs_dataSending([x,y,z]);
		var a = new ybsRequest();
		a.loadingIn = function(){
			return '';
		}
		a.process(url,send_data,'POST');
	}
		 

/*--------------------------end--------------------------------|

/*
*|------------------------------------------------------------|
*|				         KONVERSI BULAN			 	          |
*|------------------------------------------------------------|
*/

	function konversi_nomor_ke_bulan(number){
			switch(number){
				case '01' :
					number= 'JANUARI';
					break;
				case '02' :
					number= 'FEBRUARI';
					break;
				case '03' :
					number= 'MARET';
					break;
				case '04' :
					number= 'APRIL';
					break;
				case '05' :
					number= 'MEI';
					break;
				case '06' :
					number= 'JUNI';
					break;
				case '07' :
					number= 'JULI';
					break;
				case '08' :
					number= 'AGUSTUS';
					break;
				case '09' :
					number= 'SEPTEMBER';
					break;
				case '10' :
					number= 'OKTOBER';
					break;
				case '11' :
					number= 'NOVEMBER';
					break;
				case '12' :
					number= 'DESEMBER';
					break;
				}
		return number;			
	}	




/*--------------------------end--------------------------------|



/*
*|------------------------------------------------------------|
*|				        Format Text-Angka 		 	          |
*|------------------------------------------------------------|
*/



 
 function numberFormat(val){
	try{
		
		//memisahkan nilai desimal
		val = val.toString(); 
		val = val.split('.');

		//menghilangkan separator ribuan
		val1 = val[0].replace(/\,/gi,""); 
	
		rev = val1.toString().split('').reverse().join(''); 
		ribuan = rev.match(/\d{1,3}/g); 
		ribuan = ribuan.join(',').split('').reverse().join('');
	
		
		des="";
		if(val.length==2){
				des='.'+val[1];
		}
		
		return ribuan+des;
	} catch(error){
		return '' ;
	}

}


(function( $ ){
	$.fn.ybs_inputNumber= function(){
		this.keyup(function(e){
			d = numberFormat(this.value);
			this.value=d;
		});
		
		this.keydown(function(e){
				var key = e.keyCode;
				//pembatasan input yang dapat di input hany 0-10, backspace,panah kiri,panah kanan,panah kiri,panah kanan,
				return ((key >=48 && key <=57) || key ==8|| key ==37 || key ==39 || key ==190 || (key >=96 && key <=105 ));	
		
		});
	
		
	};
		
}( jQuery ));

$('.input-number').on('keydown',function(e){
	var key = e.keyCode;
	//pembatasan input yang dapat di input hany 0-10, backspace,panah kiri,panah kanan,panah kiri,panah kanan,
	return ((key >=48 && key <=57) || key ==8|| key ==37 || key ==39 || (key >=96 && key <=105 ));	
});	

$('.input-alfa').on('keydown',function(e){
	var key = e.keyCode;
	//pembatasan input yang dapat di input hanya a-z, backspace,panah kiri,panah kanan,panah kiri,panah kanan,
	return ( (key >=65 && key <=90) || key ==8|| key ==37 || key ==39 );	
});	

$('.input-alfa-number').on('keydown',function(e){
	var key = e.keyCode;
	//pembatasan input yang dapat di input hany 0-10,a-z, backspace,panah kiri,panah kanan,panah kiri,panah kanan,
	return ((key >=48 && key <=57) || (key >=65 && key <=90) || key ==8|| key ==37 || key ==39 || (key >=96 && key <=105 ));	
});	



$('.ybs-input-number').ybs_inputNumber();

/*--------------------------end--------------------------------|



/*
*|------------------------------------------------------------|
*|				         element stay in position		      |
*|------------------------------------------------------------|
*/
(function( $ ){
	$.fn.show_onscroll= function(position_show){
			id_element = $(this).attr('id');
			
			
			window.onscroll = function(){
				scrollFunction(id_element,position_show);
			};
	};
		
}( jQuery ));

function scrollFunction(id_element,position_show){
	try{
		if(document.body.scrollTop>position_show || document.documentElement.scrollTop>position_show){
			document.getElementById(id_element).style.display = "block";
		}else{
			document.getElementById(id_element).style.display="none";
		}
	}catch(error){
		
	}		
			

}
function go_top(){
		document.body.scrollTop=0;
		document.documentElement.scrollTop=0;
}

function scroll_to(x,y){
	 window.scrollTo(x, y);
}




/*--------------------------end--------------------------------|


/*
*|------------------------------------------------------------|
*|				         combo box link			 	          |
*|------------------------------------------------------------|
*/
(function( $ ){
	$.fn.linkTo= function(elementid){
			parentid = $(this).attr('id');
			
			
			$(this).ready(function(){
				 option_hide(parentid,elementid);
			});
			
			$(this).change(function(){
				 option_hide(parentid,elementid);
			});
	};
		
}( jQuery ));


function linkToSelectize(parentid,elementid){
			var el = $('#'+elementid + ' option');
			var option_model = [];
		
			$.each(el,function(k,y){
				var t = $(y).text();
				var val = $(y).val();
				var dlink = $(y).attr('data-link');
				var selected = $(y).attr('selected');
				var i = [];
				i['text'] = t;
				i['value'] = val;
				i['data_link'] = dlink;
				i['selected'] = selected;
				option_model.push(i);
			})
		
			
			
			$('#'+parentid).ready(function(){
				var value = $('#'+parentid).val();
				refresh_child(value,option_model,elementid);
			});
			
			$('#'+parentid).selectize({
				 onChange: function(value){
					refresh_child(value,option_model,elementid);
							 
				 }
			});
			
}

function refresh_child(value,option_model,elementid){
var new_option_model = [];	
var i={text:'--Pilih Data--',value:'null'};
new_option_model.push(i);
			var x=0;
			var select = '';
			var first_data='';
			$.each(option_model,function(k,y){
					if(y.data_link==value){
						var t = y.text;
						var val = y.value;
						var dlink = y.data_link;
						var i ;
						i={text:t,value:val};
						new_option_model.push(i);
						
						if(y.selected=='selected'){
							 select=y.value;
						}
						if(x==0){
							first_data =y.value;
						}
						x++;
					}
					
			 })
			
			if(select==""){
				select=first_data;
			}
			
		
			var sel2 = $('#'+elementid).selectize({});
			
			var i = sel2[0].selectize; 
			i.clear();
			i.clearOptions(); 
			i.addOption(new_option_model);	
			i.setValue(select);
			if(i.getValue()==''){
				i.setValue('null');
			}
			
}




function option_hide(parentid,elementid){
	var a  = $('#'+elementid+' option');
	var b = $('#'+parentid).val();
	var xx = 0;
	var v = '';
	$.each(a,function(k,y){
		var c = $(y).attr('data-link');
		if(c==b){
			$(this).attr('hidden',false);
			if(xx==0){
				v = $(this).val();
			}
			xx++;
		}else{
			$(this).attr('hidden',true);
		}
	
	});
	
	$('#'+elementid).val(v);
}

function linkToSelectize_mto(data){
		var old_opt  		= $('#'+data.comboboxID + ' option');

		var def_val = $('#'+data.comboboxID).val();
		var pr = 	$('#'+data.comboboxID).selectize({
						 onChange: function(value){
								
								
								$.each(old_opt,function(k,y){
									
									if(value==$(y).val()){	

										$.each(data.field_link,function(m,n){
				
											var option_target_model = [];
											var selected ='';
											
											var t = $(y).attr('data-show-'+n.field_show);
											var val = $(y).attr('data-link-'+n.field_link);
											selected = val;
											var i ;
											i={text:t,value:val};
											option_target_model.push(i);
											
											
											var sel2 = $('#'+n.comboboxTargetID).selectize({});
											var ix = sel2[0].selectize; 
											ix.clear();
											ix.clearOptions(); 
											ix.addOption(option_target_model);	
											ix.setValue(selected);	
				
										})
									}
								})
						
						
						
								
											
						 }	
					});
					
		var spr = pr[0].selectize;  
		spr.setValue(def_val);
		
}


var waiting_process=0;
function linkToSelectize_Big(parentid,targetid){
		var table  		=  $('#'+parentid).attr('data-table');
		var primary  	=  $('#'+parentid).attr('data-primary');
		var field_link	=  $('#'+parentid).attr('data-flink');
		var field_show	=  $('#'+parentid).attr('data-fshow');
		var selected	=  $('#'+parentid).attr('data-select');
		
		var tr_table  		=  $('#'+targetid).attr('data-table');
		var tr_primary  	=  $('#'+targetid).attr('data-primary');
		var tr_field_link	=  $('#'+targetid).attr('data-flink');
		var tr_field_show	=  $('#'+targetid).attr('data-fshow');
		var tr_selected		=  $('#'+targetid).attr('data-select');
		
		var default_option = [];	
		var i={text:'--Pilih Data--',value:'null'};
		default_option.push(i);
		
		var f="";
		var host = document.location.origin;
		
		if(xax==""){ //di ambil dari lib/Template.php
			f = "";
		}else{
			f = "/" + xax;
		}

		link_data = host + f +svrCMB;

		link_data = link_data.replace(/([^:]\/)\/+/g, "$1");
		

	$('#'+parentid).ready(function(){

			if(field_link=='' || field_link == null || field_link===undefined){
			
				
				a  =  get_json_format('t',table);
				b  =  get_json_format('fs',field_show);
				c  =  get_json_format('w','');
				x  =  get_json_format('wv','');
				y  =  get_json_format('tk',data_token);

				send_data = ybs_dataSending([y,a,b,c,x]);

				var req = new ybsRequest();
				req.process(link_data,send_data);
				waiting_process= 1;
				req.onSuccess = function(data){
				
				var pr = 	$('#'+parentid).selectize({
							options : data.message,
							onChange: function(value){
											if(waiting_process==0){
											
												waiting_process= 1;
												
												var req_link = new ybsRequest();
												e  =  get_json_format('t',tr_table);
												f  =  get_json_format('fs',tr_field_show);
												g  =  get_json_format('w',tr_field_link);
												h  =  get_json_format('wv',value);
												y  =  get_json_format('tk',data_token);
												send_data = ybs_dataSending([y,e,f,g,h]);	
												
												req_link.process(link_data,send_data);
												req_link.onSuccess = function(datatarget){
													
													waiting_process= 0;
													;
													var sel2 = $('#'+targetid).selectize({});
													var i = sel2[0].selectize; 
													
													
													i.clear(true);
													i.clearOptions(); 
													i.addOption(datatarget.message);
													
													i.setValue(tr_selected);
													
													if(i.getValue()==''){
														i.setValue('null');
													}
												
												
												}
											}
									  }
					});	
					waiting_process = 0;
					
					var spr = pr[0].selectize;  
					spr.setValue(selected);
					if(spr.getValue()==''){
						spr.setValue('null');
					}
					
				}
						
				
			}else{
				
				var pr = $('#'+parentid).selectize({
									onChange: function(value){
											if(waiting_process==0){
												
												waiting_process=1;
												
												var req_link = new ybsRequest();
												e  =  get_json_format('t',tr_table);
												f  =  get_json_format('fs',tr_field_show);
												g  =  get_json_format('w',tr_field_link);
												h  =  get_json_format('wv',value);
												y  =  get_json_format('tk',data_token);
												send_data = ybs_dataSending([y,e,f,g,h]);	
												
												
												
												req_link.process(link_data,send_data);
												req_link.onSuccess = function(datatarget){
													
													
													waiting_process=0;
													
												
													var sel2 = $('#'+targetid).selectize({});
													var i = sel2[0].selectize; 
													
													i.clear(true);
													i.clearOptions(); 
													i.addOption(datatarget.message);	
												
													i.setValue(tr_selected);
													
													if(i.getValue()==''){
														i.setValue('null');
													}
													
												
												}
											}											
									  }
				});	
		
			}
			
			
	});
	

}

/*--------------------------end--------------------------------|




/*
*|------------------------------------------------------------|
*|				         upload file	 	        		  |
*|------------------------------------------------------------|
*/

var cupt = 0;


function dropzone_area(data){
	
	//jika belum di clear
	if(cupt==0){
		clear_temp_upload();
		cupt=1;
	}
	
	var elementid 	= data.elementID;
	var max_files 	= data.max_files;
	var max_size  	= data.max_size;
	var type	  	= data.type;
	var removefile	= data.allowRemoveFile;
	var path_upload	= $(elementid).attr('data-folder'); 
	var time		= data.timeout;
	var autosave	= data.autosave;
	
	
	if(max_files==null){
		max_files=20;
	}
	if(max_size==null){
		max_size=25; 
	}
	
	if(removefile==null){
		removefile=false;
	}

	if(time==null){
		time = 180000;
	}
	
	if(autosave==null ){
		autosave=true;
	}

	var type_file ='';
	switch(type){
		case 'image' :
			type_file = "image/*";
			break;
		case 'audio':
			type_file = "audio/*";	
			break;
		case 'vidio':
			type_file = "video/*";	
			break;	
		case 'all':
			type_file = '';	
			break;	
		case 'document':
			type_file = "application/.xls,.xlsx,.pdf,.doc,.docx,.ppt,.pptx,.txt";
			break;
		default :
			type_file = "";
	}
	
	
	
	
		var f="";
		var host = document.location.origin;
		
		if(xax==""){
			f = "";
		}else{
			f = "/" + xax;
		}
		
		link_data 	= host + f + svrUFile + data_token;
		link_remove = host + f + svrRFile + data_token;
		
		link_data 	= link_data.replace(/([^:]\/)\/+/g, "$1");
		link_remove = link_remove.replace(/([^:]\/)\/+/g, "$1");
	  
				Dropzone.autoDiscover = false;
				var myDropzone = new Dropzone(elementid , {
				maxFilesize				: 	max_size, // MB
				maxFiles				:	max_files,
				acceptedFiles			:	type_file,
				url 					:	link_data ,
			    paramName				: 	"file", 
			    dictFileTooBig			:	"File Terlalu Besar ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
				dictInvalidFileType		:	"Type file ini tidak dizinkan",
				dictMaxFilesExceeded	:	"Opps..Max fileUpload : {{maxFiles}} Files",
				dictResponseError		:	'Error while uploading file!',
				addRemoveLinks 			: 	true,
				timeout					: 	time,
				
				//change the previewTemplate to use Bootstrap progress bars
				previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail data-image=\"Preview\" class=\"ybs-image-slider\"/>\n  </div>\n  <div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",

				init: function() {
					this.on("sending",function(file,response,form_data){
						form_data.append("path_upload",path_upload);
						var sec  = sec_val.split("=");	
						form_data.append("autosave",autosave);
						form_data.append(sec[0],sec[1].replace("&",""));
					});
					
					this.on("success", function(file, response) {
						
						try{
								var a = JSON.parse(response);
								sec_val = a.sec_val;
								if(a.success=='false'){
									$(file.previewElement).addClass("dz-error").find('.dz-error-message').text(a.message);
								}else{
									var data_upload 	= $(elementid).attr('data-upload');
									var data_time		= $(elementid).attr('data-time');
									var data_ext		= $(elementid).attr('data-ext');
									var orig_name		= $(elementid).attr('data-orig-name');
									
									if(data_upload==null){
										data_upload = a.message;
										data_time	= a.time_post;
										data_ext	= a.ext;
										orig_name	= a.orig_name;
									}else{
										data_upload = data_upload + ' ' +a.message;
										data_time	= data_time+ ' ' + a.time_post;
										data_ext	= data_ext+ ' ' + a.ext;
										orig_name	= orig_name + ' ' + a.orig_name;
									}
									
									$(elementid).attr('data-upload',data_upload );
									$(elementid).attr('data-time',data_time);
									$(elementid).attr('data-ext',data_ext);
									$(elementid).attr('data-orig-name',orig_name);
									
									
									file.upload_id 			= a.message;
									file.upload_time		= a.time_post;
									file.upload_ext			= a.ext;
									file.upload_orig_name	= a.orig_name;
									
								}
						}catch(e){
							$(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response);
							
						}
					
						
					
						
					});
					
						
					this.on("removedfile",function(file){
							if(removefile==true && autosave==true){
								var req = new ybsRequest();
								s = get_json_format('upload_id',file.upload_time);
								send_data = ybs_dataSending([s]);
								req.process(link_remove,send_data);
								req.onSuccess = function(data){
										show_success_message(data.message);
								}
								req.onFailed = function(data){
									
								}
								
								var data_upload 	= $(elementid).attr('data-upload');
								data_upload 		= data_upload.replace(file.upload_id,"");
								data_upload			= data_upload.replace(/^\s+|\s+$/gm,'');
								$(elementid).attr('data-upload',data_upload);
								
								var data_time		= $(elementid).attr('data-time');
								data_time 			= data_time.replace(file.upload_time,"");
								data_time 			= data_time.replace(/^\s+|\s+$/gm,'');
								$(elementid).attr('data-time',data_time);
							
								var data_ext		= $(elementid).attr('data-ext');
								data_ext 			= data_ext.replace(file.upload_ext,"");
								data_ext 			= data_ext.replace(/^\s+|\s+$/gm,'');
								$(elementid).attr('data-ext',data_ext);
								
								var data_orig_name	= $(elementid).attr('data-orig-name');
								data_orig_name 		= data_orig_name.replace(file.upload_orig_name,"");
								data_orig_name 		= data_orig_name.replace(/^\s+|\s+$/gm,'');
								$(elementid).attr('data-orig-name',data_orig_name);
								
							
							}else{
								var data_upload = $(elementid).attr('data-upload');
								if(data_upload !== undefined){
									data_upload = data_upload.replace(file.upload_id,"");
									data_upload = data_upload.replace(/^\s+|\s+$/gm,'');
									$(elementid).attr('data-upload',data_upload);
									
									var data_time		= $(elementid).attr('data-time');
									data_time 			= data_time.replace(file.upload_time,"");
									data_time 			= data_time.replace(/^\s+|\s+$/gm,'');
									$(elementid).attr('data-time',data_time);
								
									var data_ext		= $(elementid).attr('data-ext');
									data_ext 			= data_ext.replace(file.upload_ext,"");
									data_ext 			= data_ext.replace(/^\s+|\s+$/gm,'');
									$(elementid).attr('data-ext',data_ext);
									
									var data_orig_name	= $(elementid).attr('data-orig-name');
									data_orig_name 		= data_orig_name.replace(file.upload_orig_name,"");
									data_orig_name 		= data_orig_name.replace(/^\s+|\s+$/gm,'');
									$(elementid).attr('data-orig-name',data_orig_name);
								}
							}
								
					});
					
					
					
					
				}	

				});
				
			
							  
			   $(document).on('ajaxloadstart.page', function(e) {
					try {
						myDropzone.destroy();
					} catch(e) {}
			   });
			   
	
}

function dropzone_save(data){
	
	var f="";
		var host = document.location.origin;
		
		if(xax==""){
			f = "";
		}else{
			f = "/" + xax;
		}
	var ret			= false;

	link_sv 	= host + f + svrTMP + data_token;
	
	var xx = data.split(',');
	$.each(xx,function(k,y){
		times = $(y).attr('data-time');
		
		if(times=="" ||times==null || times ===undefined){
			return false;
		}else{
			var r = new ybsRequest();
			a = get_json_format('time',times);
			send_data = ybs_dataSending([a]);
			r.process(link_sv,send_data);
			r.onSuccess = function(){
				$(y).attr('data-time','');
				$(y).attr('data-upload','');
				$(y).attr('data-ext','');
				$(y).attr('data-orig-name','');
			}
		}
		
	});
	
}


function dropzone_result(atime,temp){
	var drop		= this;
	var f="";
		var host = document.location.origin;
		
		if(xax==""){
			f = "";
		}else{
			f = "/" + xax;
		}
	var ret			= false;

	if(temp==null || temp==""){
		link_gf 	= host + f + svrAccessFile + data_token;
	}else{
		link_gf 	= host + f + svrAccessFileTMP + data_token;
	}
	
	var t = get_json_format('time',atime);
	send_data = ybs_dataSending([t]);
	var a = new ybsRequest();
	a.process(link_gf,send_data);
	a.onSuccess = function(data){
			drop.onComplite(data);
	}

}

dropzone_result.prototype.onComplite = function(data){

}



var dataRemx=[];

function remove_img(index){
		var f="";
		var host = document.location.origin;
		
		if(xax==""){
			f = "";
		}else{
			f = "/" + xax;
		}
		
		link_remove = host + f + svrRFile + data_token;		
		link_remove = link_remove.replace(/([^:]\/)\/+/g, "$1");

		var req = new ybsRequest();
		r = get_json_format('relation',dataRemx[index].relationTable);
		s = get_json_format('upload_id',dataRemx[index].time);
		t = get_json_format('action',dataRemx[index].actionRow);
		u = get_json_format('field',dataRemx[index].field);
		
		send_data = ybs_dataSending([r,s,t,u]);

		req.process(link_remove,send_data);
		
			req.onSuccess = function(data){
				show_success_message(data.message);
				$(".file-"+index).remove();
			}
			
			req.onFailed = function(data){
									
			}
		
		
		
		
}

(function( $ ){

	$.fn.ybsPrivateStorage= function(options){
		var cnt = this;

		if(options.images !==undefined && options.images !==""){
			var img = $.trim(options.images);
			var iSM="";
			var iMD="";
			var iLG="";
			if(options.itemSM !== undefined){
				iSM = 12 / options.itemSM;
				iSM = "col-sm-" + iSM;
			}
			if(options.itemMD !== undefined){
				iMD = 12 / options.itemMD;
				iMD = "col-md-" + iMD;
			}
			if(options.itemLG !== undefined){
				iLG = 12 / options.itemLG;
				iLG = "col-lg-" + iLG;
			}
			
			var dr = new dropzone_result(img);
				dr.onComplite = function(data){
					
				try{
					var f = JSON.parse(data.message);
					var s="";
					var xx=0;
					$.each(f,function(k,y){
						
						var rel ="";
						var act = "";
						var fil="";
					
						if(options.relation !== undefined && options.relation !== ""){
							rel  = options.relation.table;
							fil  = options.relation.field;
							act  = options.relation.actionRow;
														
						}
										
						dataRemx[xx] =	{	time  			: y.time,
											relationTable 	: rel,
											field			: fil,
											actionRow		: act,
										
										}
						
						var def_thumb="";
						
						var btnDownload = "";
						var btnRemove = "";
						
						if(options.btnDownload){
							btnDownload = '<a href="'+y.link+'" class="ybs-storage icon  d-md-inline-block ml-3" style="font-size:18px" title="download"><i class="text-orange fa fa-cloud-download m-1"></i></a>';
						}
						
						if(options.btnRemove){
							btnRemove = '<a href="javascript:void(0)" onclick="show_konfirm_delete(\''+y.orig_name+'\',\'remove_img('+xx+')\')" class="ybs-storage icon " data-toggle="modal" data-target="#modal-danger" style="font-size:18px"><i class="text-red fa fa-close m-1" title="remove"></i></a>';
						}
						
						
						
						
						if(y.type !=="image"){
							def_thumb='<h1><i class="fe fe-file"></i></h1>';
						}else{
							def_thumb='<a href="javascript:void(0)" class="mb-3"> <img src="'+y.link+'" alt=""  class="rounded"> </a>';
						};
							s = s +'<div class="'+iSM+" "+iMD+" "+iLG+' file-'+xx+'">'+
										'<div class="card p-3" style="box-shadow:2px 2px 10px gray">'+
										
											def_thumb +
										
										   '<div style="font-size:12px">'+y.orig_name+'</div>'+
										  '<div class="d-flex align-items-center px-2">'+
											'<div class="ml-auto text-muted">'+
											  btnDownload +
											  btnRemove +
											'</div>'+
										  '</div>'+
										'</div>'+
									'</div>';
						
						
						xx++;
					})
					
					var co 	='<div class="row row-cards" >';
					var cc ='</div>';
					$(cnt).append(co+s+cc);
					
					
				}catch(error){
					
				}
				
				
				
				
				
				
			}
		}	
		
		
		
		
	};
	
	
		
}( jQuery ));






function clear_temp_upload(){
	var f="";
		var host = document.location.origin;
		
		if(xax==""){
			f = "";
		}else{
			f = "/" + xax;
		}


	link_clear = host + f + svrClearTMP + data_token;
	link_clear = link_clear.replace(/([^:]\/)\/+/g, "$1");
	var a = new ybsRequest();
	a.process(link_clear);
	a.onSuccess = function(data){
		
	};
}





/*--------------------------end--------------------------------|







/*
*|------------------------------------------------------------|
*|				         reload ybs script		 	          |
*|------------------------------------------------------------|
*/

	function reload_script(id_script,link_script){
				$(id_script).remove();
				var script = document.createElement('script');
					var sname = id_script;
						sname= sname.replace("#","");
						sname= sname.replace(".","");
				script.type = 'text/javascript';
				script.src = link_script;
				script.id = sname;
 				$('#section_script').append(script);			
	}	
	
	function reload_css(){
			var q ='?reload='+new Date().getTime();
			$('link[rel="stylesheet"]').each(function(){
				this.href = this.href.replace(/\?.*|$/,q);
			})
	}




/*--------------------------end--------------------------------|


/*
*|------------------------------------------------------------|
*|				         side bar 				 	          |
*|------------------------------------------------------------|
*/


		
	
		

/*--------------------------end--------------------------------|









*/