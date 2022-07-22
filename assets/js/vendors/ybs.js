var toastr;
define(['toastr'],function(toastrx){
	toastr=toastrx;
});
/*
*|------------------------------------------------------------|
*|				background-color input text	,box		          |
*|------------------------------------------------------------|
*/


	$(".focus-color").focus(function(){
		$(this).css("background-color","#fff09e");
	});
	
	var color_entered="";
	var def_color_t1="";
	var def_color_t2="";
	var title1="";
	var title2="";
	$(".btn-card").mouseenter(function(){		
		title1 =$(this)[0].children[0].children[1].children[0]; //$(this)[0].children[0].children[1].children[0].classList[2];
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
		$(title1).addClass(def_color_t1);
		$(title2).addClass(def_color_t2);
	})
		
	
	$(".focus-color").blur(function(){
		$(this).css({"background-color":""});
	});
	



/*--------------------------end-------------------------------|

	


/*
*|------------------------------------------------------------|
*|				background-color Slider Syiria		          |
*|------------------------------------------------------------|
*/


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
	

	
	
	
	(function( $ ){
		$.fn.set_header_checked = function(id_table){
			id_check = $(this).attr('id');
			action_change(id_table,id_check)
		};
			
	}( jQuery ));
	
	function action_change(id_table,id_check){
		$('#'+id_check).change(function (){
				var status = $('#'+id_check).prop('checked');
				$('#' + id_table +' .checkbox').prop('checked',status).iCheck('update');
		});
	}	

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
				play_sound_apply();
				stop ="true";
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


	function get_json_format(key,val){
		try{
			var data = val.toString();	
			v1 = data.replace(/\\/gi,'\\\\');
			v2 = v1.replace(/\"/gi,'\\"');
			
			k1 = key.replace(/\\/gi,'\\\\');
			k2 = k1.replace(/\"/gi,'\\"');
			obj = '"'+k2+'":"'+v2+'"';
			return obj;
		}catch(error){
			return   '"'+key+'":""';
			//return   '"data":"null"';
		}
		
	
	}

(function( $ ){
	$.fn.ybs_json= function(name){
		if(name== "" || name==null){
			name = $(this).attr('name');
		}
		return get_json_format(name,$(this).val());
	};
		
}( jQuery ));

function ybs_dataSending(arr){
  	    var d_open  = "data_ajax={" ;
		var d_body  = "";
		var d_close = "}";
		$.each(arr, function(index,val){
			d_body = d_body + val + ",";
		});
	
		//menghilangkan koma yang terakhir
		d_body =d_body.substr(0,d_body.length-1 );
		
		return d_open+d_body+d_close;
}

function ybs_dtSending(arr){
  	    var d_open  = "{" ;
		var d_body  = "";
		var d_close = "}";
		$.each(arr, function(index,val){
			d_body = d_body + val + ",";
		});
	
		//menghilangkan koma yang terakhir
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

	function remove_error_message(){
		config_toast_master();
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

	
	
	function show_popup_error(message,element){
	}
	
	function close_popup(){
	}	
	$('.ybs-popup').keyup(function(e){
	});
	

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
		show_error_message(data.message)
		$(data.elementid).focus();
		play_sound_failed();
	}
	
	ybsRequest.prototype.onAfterFailed =function(data){
		
	}
	
	ybsRequest.prototype.onError = function(xhr, status, error){
		show_error_message(status)
		play_sound_failed();
	}
	
	ybsRequest.prototype.compliteProcess = function(){
		
	}
	

	ybsRequest.prototype.process = function(url_form,param,type){
		var req = this; 
		if(type==null || type ==""){
					type=="GET";
		}
				
				d = url_form;
				send_data = param;
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
							var a =JSON.parse(data);
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
									$('#redirect-button').click();
									break;

							}
					},
					error: function(xhr, status, error){
						req.onError(xhr, status, error);
					},
					complete: function(){
							req.compliteProcess();
							stop_loading_in(req.loadingIn());
					},
									
				});
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
		 
	function ybsProcDelTable(data,url,tableID){
			 dt = get_json_format('data_delete',data);
			 send_data = ybs_dataSending([dt]);
			 
			 var a = new ybsRequest();
			 a.process(url, send_data );
			 a.compliteProcess = function(){
						var table= $(tableID).DataTable();
						table.clear().draw();
						table.destroy();
						search_default();	
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
*|				        Format Angka 			 	          |
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
		//return this;
		
	};
		
}( jQuery ));

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




/*--------------------------end--------------------------------|

*/