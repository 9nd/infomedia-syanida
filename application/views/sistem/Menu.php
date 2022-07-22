<?php
	/*
		membuat menu dinamis, dilakukan dengan membandingkan url database menu.
	*/
	
		$this->CI = & get_instance();
	
		$arr = explode("/",uri_string());
		$dropdown=FALSE;
		$initial_selected="";
		$controller_selected="";
		$function_selected="";
		$link_selected='';

		$otorisasi_menu_parent	= $auth_menu->get_parent_by_idlevel($this->CI->_user_level_id);
	
		//mencetak menu dashboard setting,hanya dicetak jika form.shortcut=1
		$star_light = 'dash-unselect';
		if($this->CI->_is_dashboard){
			  $star_light= 'dash-select' ;
		}
			   
		if($this->CI->_user_form_shortcut=='1'){
				echo menu_parent_open('','fa fa-star '. $star_light,"javascript:void(0)",false,false,'ybs-dash');	//membuat menu home dan menjadikan NON Aktif
				echo menu_parent_close();
		}
		
		
		
		switch(count($arr)){
			case 1:	//tidak ada link  ex. #		
				$link_selected=$arr[0];
				
				$active = false;
				if($link_selected=='home'){
					$active = true;
				}	

				
				echo menu_parent_open('Home Page','fe fe-airplay',site_url()."home",$active,false);	//membuat menu home dan menjadikan NON AKtif
				echo menu_parent_close();
				
				break;
			case 2:	//hanya berisi folder & file controller 	ex. sys/pengaturan
				$controller_selected=$arr[0];
				$function_selected = $arr[1];
				$link_selected = $controller_selected .'/'. $function_selected;
			
				echo menu_parent_open('Home Page','fe fe-airplay',site_url()."home",false,false);	//membuat menu home dan menjadikan NON Aktif
				echo menu_parent_close();
				
				break;
			default:			//berisi initial, file controller & function		ex.	sys/pengaturan/module
				$initial_selected 	 = $arr[0];
				$controller_selected = $arr[1];
				$function_selected	 = $arr[2];
				$link_selected 		 = $initial_selected .'/' . $controller_selected .'/' .	$function_selected;
				


				echo menu_parent_open('Home Page','fe fe-airplay',site_url()."home",false,false);	//membuat menu home dan menjadikan NON AKtif
				echo menu_parent_close();
			
				break;
		}	
		
		//mengulang menu parent
		foreach($otorisasi_menu_parent as $key =>$value){
			
	
			$id_menu   = $value['id_menu'];
			$id_level  = $value['id_level'];
			$nama_menu = $value['name'];
			$icon_menu = $value['icon'];
			$link	   = $value['link'];

			//mendapatkan menu child
			$child_menu = $auth_menu->get_child_by_idmenu($id_menu,$id_level); 
			
			
			
			if(count($child_menu)>0){
				//mengecek jika url sama dengan link child mengaktifkan menu parent
				$active_parent = false;
				foreach($child_menu as $key_child =>$value_child){
					if($link_selected==$value_child['link']){
						$active_parent=true;
					}
				}
				
						echo menu_parent_open($nama_menu,$icon_menu,'javascript:void(0)',$active_parent,true);
						echo menu_child_open();
						//mengecek jika url sama dengan link child mengaktifkan menu child dan membuat menu child
						foreach($child_menu as $key_child =>$value_child){
							$active_child=false;
							
							if($link_selected==$value_child['link']){
								$active_child=true;
							}
							
							$link= base_url().$value_child['link'].'/';
							if($value_child['link']=='#'){
								$link='javascript:void(0)';
							}
							
							echo create_menu_child($value_child['name'],$link,$value_child['icon'],$active_child);
						}

						echo menu_child_close();
						echo menu_parent_close();
				
				
			}else{
				$active = false;
				
				if($link==""||$link=="#"){
					$link="javascript:void(0)";
				}else{
					if($link_selected==$link){
						$active=true;
					}
					$link = site_url(). $link;
				}
				
				echo menu_parent_open($nama_menu,$icon_menu,$link,$active,false);
				echo menu_parent_close();	
			}

			
		}
		
		
		//logout
		echo menu_parent_open('Logout','fe fe-log-out',site_url().'sistem/logout',false);
		echo menu_parent_close();	
		



