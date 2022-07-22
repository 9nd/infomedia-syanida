<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function card_open($title_card,$style="",$expand=true,$attr=""){
	$ex='';
	if($expand !==true){
		$ex = 'card-collapsed';
	}
	
	$card = '<div class="card '.$ex.'" ' .$attr.' >'.
			 '<div class="card-status '.$style.'"></div>'.
                  '<div class="card-header">'.
                    '<h3 class="card-title">'.$title_card.'</h3>'.
                    '<div class="card-options">'.
                      '<a href="javascript:void(0)" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>'.
					  '<a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>'.
                    '</div>'.
                  '</div>'.
                  '<div class="card-body">';
                 
	return $card;
}

function card_close(){
	$m = '</div>'.
         '</div>';
	return $m;	 
}

/**
*
*
*/
function button_card($title1,$title2,$style_text,$style_button,$icon,$style_icon,$id='',$link='javascript:void(0)'){
	$m = '<a  href="'.$link.'" id="'.$id.'" class="card p-3 btn btn-card '.$style_button.'" >'.
         '<div class="d-flex align-items-center">'.
            '<span class="stamp stamp-md '.$style_icon.' mr-3">'.
            '<i class="'.$icon.'"></i>'.
            '</span>'.
            '<div class="text-left">'.
            '<p class="m-0 '.$style_text.'"> '.$title1.'</p>'.
            '<small class="text-muted"> '.$title2.'</small>'.
            '</div>'.
         '</div>'.
         '</a>';
	return $m;
}


function menu_parent_open($title,$icon,$link='',$active=false,$haschild=false,$id=""){
	$ac = '';
	$data_toggle =''; 
	$data_dropdown ='';
	if( $link == 'javascript:void(0)'){
		$data_toggle =' data-toggle="dropdown"'; 
		$data_dropdown= 'dropdown';
	}
	
	// if($id=='ybs-dash'){
		// $data_dropdown ='';
		// $data_toggle="";
	// }
	
	if(!$haschild){
		$data_dropdown ='';
		$data_toggle="";
	}
	
	if($active){
		$ac = 'active'	;
	}
	$m = '<li class="nav-item '.$data_dropdown.'">'."\n".
		 '<a href="'.$link.'" class="nav-link '. $ac.'" '.$data_toggle.'><i class="'.$icon.'" id="'.$id.'"></i> '.$title.'</a>'."\n"
			;
	
	
	return $m;
}

function menu_parent_close(){
	$m = '</li>'."\n";
	return $m;
}

function menu_child_open(){
	$m ='<div class="dropdown-menu dropdown-menu-arrow">'."\n";
	return $m;
} 

function menu_child_close(){
	$m='</div>'."\n";
	return $m;
}

function create_menu_child($title,$link,$icon,$active){
	$ac='';
	if($active){
		$ac = 'active'	;
	}
	$m =' <a href="'.$link.' " class="dropdown-item '. $ac .'"><i class="'.$icon.'"></i>'.$title.'</a>'."\n";
	return $m;
}


function create_select_icon($id_select,$list_class=""){
	
	$a= '<select id="'.$id_select.'" name="icon" class="form-control custom-select data-sending">
		<option value="# "  data-data=\'{"icon": "# "}\'>--pilih icon-- </option>
		<option value="fe fe-activity "  data-data=\'{"icon": "fe fe-activity "}\'>fe fe-activity </option>
		<option value="fe fe-airplay "  data-data=\'{"icon": "fe fe-airplay "}\'>fe fe-airplay </option>
		<option value="fe fe-alert-circle "  data-data=\'{"icon": "fe fe-alert-circle "}\'>fe fe-alert-circle </option>
		<option value="fe fe-alert-octagon "  data-data=\'{"icon": "fe fe-alert-octagon "}\'>fe fe-alert-octagon </option>
		<option value="fe fe-alert-triangle "  data-data=\'{"icon": "fe fe-alert-triangle "}\'>fe fe-alert-triangle </option>
		<option value="fe fe-align-center "  data-data=\'{"icon": "fe fe-align-center "}\'>fe fe-align-center </option>
		<option value="fe fe-align-justify "  data-data=\'{"icon": "fe fe-align-justify "}\'>fe fe-align-justify </option>
		<option value="fe fe-align-left "  data-data=\'{"icon": "fe fe-align-left "}\'>fe fe-align-left </option>
		<option value="fe fe-align-right "  data-data=\'{"icon": "fe fe-align-right "}\'>fe fe-align-right </option>
		<option value="fe fe-anchor "  data-data=\'{"icon": "fe fe-anchor "}\'>fe fe-anchor </option>
		<option value="fe fe-aperture "  data-data=\'{"icon": "fe fe-aperture "}\'>fe fe-aperture </option>
		<option value="fe fe-arrow-down "  data-data=\'{"icon": "fe fe-arrow-down "}\'>fe fe-arrow-down </option>
		<option value="fe fe-arrow-down-circle "  data-data=\'{"icon": "fe fe-arrow-down-circle "}\'>fe fe-arrow-down-circle </option>
		<option value="fe fe-arrow-down-left "  data-data=\'{"icon": "fe fe-arrow-down-left "}\'>fe fe-arrow-down-left </option>
		<option value="fe fe-arrow-down-right "  data-data=\'{"icon": "fe fe-arrow-down-right "}\'>fe fe-arrow-down-right </option>
		<option value="fe fe-arrow-left "  data-data=\'{"icon": "fe fe-arrow-left "}\'>fe fe-arrow-left </option>
		<option value="fe fe-arrow-left-circle "  data-data=\'{"icon": "fe fe-arrow-left-circle "}\'>fe fe-arrow-left-circle </option>
		<option value="fe fe-arrow-right "  data-data=\'{"icon": "fe fe-arrow-right "}\'>fe fe-arrow-right </option>
		<option value="fe fe-arrow-right-circle "  data-data=\'{"icon": "fe fe-arrow-right-circle "}\'>fe fe-arrow-right-circle </option>
		<option value="fe fe-arrow-up "  data-data=\'{"icon": "fe fe-arrow-up "}\'>fe fe-arrow-up </option>
		<option value="fe fe-arrow-up-circle "  data-data=\'{"icon": "fe fe-arrow-up-circle "}\'>fe fe-arrow-up-circle </option>
		<option value="fe fe-arrow-up-left "  data-data=\'{"icon": "fe fe-arrow-up-left "}\'>fe fe-arrow-up-left </option>
		<option value="fe fe-arrow-up-right "  data-data=\'{"icon": "fe fe-arrow-up-right "}\'>fe fe-arrow-up-right </option>
		<option value="fe fe-at-sign "  data-data=\'{"icon": "fe fe-at-sign "}\'>fe fe-at-sign </option>
		<option value="fe fe-award "  data-data=\'{"icon": "fe fe-award "}\'>fe fe-award </option>
		<option value="fe fe-bar-chart "  data-data=\'{"icon": "fe fe-bar-chart "}\'>fe fe-bar-chart </option>
		<option value="fe fe-bar-chart-2 "  data-data=\'{"icon": "fe fe-bar-chart-2 "}\'>fe fe-bar-chart-2 </option>
		<option value="fe fe-battery "  data-data=\'{"icon": "fe fe-battery "}\'>fe fe-battery </option>
		<option value="fe fe-battery-charging "  data-data=\'{"icon": "fe fe-battery-charging "}\'>fe fe-battery-charging </option>
		<option value="fe fe-bell "  data-data=\'{"icon": "fe fe-bell "}\'>fe fe-bell </option>
		<option value="fe fe-bell-off "  data-data=\'{"icon": "fe fe-bell-off "}\'>fe fe-bell-off </option>
		<option value="fe fe-bluetooth "  data-data=\'{"icon": "fe fe-bluetooth "}\'>fe fe-bluetooth </option>
		<option value="fe fe-bold "  data-data=\'{"icon": "fe fe-bold "}\'>fe fe-bold </option>
		<option value="fe fe-book "  data-data=\'{"icon": "fe fe-book "}\'>fe fe-book </option>
		<option value="fe fe-book-open "  data-data=\'{"icon": "fe fe-book-open "}\'>fe fe-book-open </option>
		<option value="fe fe-bookmark "  data-data=\'{"icon": "fe fe-bookmark "}\'>fe fe-bookmark </option>
		<option value="fe fe-box "  data-data=\'{"icon": "fe fe-box "}\'>fe fe-box </option>
		<option value="fe fe-briefcase "  data-data=\'{"icon": "fe fe-briefcase "}\'>fe fe-briefcase </option>
		<option value="fe fe-calendar "  data-data=\'{"icon": "fe fe-calendar "}\'>fe fe-calendar </option>
		<option value="fe fe-camera "  data-data=\'{"icon": "fe fe-camera "}\'>fe fe-camera </option>
		<option value="fe fe-camera-off "  data-data=\'{"icon": "fe fe-camera-off "}\'>fe fe-camera-off </option>
		<option value="fe fe-cast "  data-data=\'{"icon": "fe fe-cast "}\'>fe fe-cast </option>
		<option value="fe fe-check "  data-data=\'{"icon": "fe fe-check "}\'>fe fe-check </option>
		<option value="fe fe-check-circle "  data-data=\'{"icon": "fe fe-check-circle "}\'>fe fe-check-circle </option>
		<option value="fe fe-check-square "  data-data=\'{"icon": "fe fe-check-square "}\'>fe fe-check-square </option>
		<option value="fe fe-chevron-down "  data-data=\'{"icon": "fe fe-chevron-down "}\'>fe fe-chevron-down </option>
		<option value="fe fe-chevron-left "  data-data=\'{"icon": "fe fe-chevron-left "}\'>fe fe-chevron-left </option>
		<option value="fe fe-chevron-right "  data-data=\'{"icon": "fe fe-chevron-right "}\'>fe fe-chevron-right </option>
		<option value="fe fe-chevron-up "  data-data=\'{"icon": "fe fe-chevron-up "}\'>fe fe-chevron-up </option>
		<option value="fe fe-chevrons-down "  data-data=\'{"icon": "fe fe-chevrons-down "}\'>fe fe-chevrons-down </option>
		<option value="fe fe-chevrons-left "  data-data=\'{"icon": "fe fe-chevrons-left "}\'>fe fe-chevrons-left </option>
		<option value="fe fe-chevrons-right "  data-data=\'{"icon": "fe fe-chevrons-right "}\'>fe fe-chevrons-right </option>
		<option value="fe fe-chevrons-up "  data-data=\'{"icon": "fe fe-chevrons-up "}\'>fe fe-chevrons-up </option>
		<option value="fe fe-chrome "  data-data=\'{"icon": "fe fe-chrome "}\'>fe fe-chrome </option>
		<option value="fe fe-circle "  data-data=\'{"icon": "fe fe-circle "}\'>fe fe-circle </option>
		<option value="fe fe-clipboard "  data-data=\'{"icon": "fe fe-clipboard "}\'>fe fe-clipboard </option>
		<option value="fe fe-clock "  data-data=\'{"icon": "fe fe-clock "}\'>fe fe-clock </option>
		<option value="fe fe-cloud "  data-data=\'{"icon": "fe fe-cloud "}\'>fe fe-cloud </option>
		<option value="fe fe-cloud-drizzle "  data-data=\'{"icon": "fe fe-cloud-drizzle "}\'>fe fe-cloud-drizzle </option>
		<option value="fe fe-cloud-lightning "  data-data=\'{"icon": "fe fe-cloud-lightning "}\'>fe fe-cloud-lightning </option>
		<option value="fe fe-cloud-off "  data-data=\'{"icon": "fe fe-cloud-off "}\'>fe fe-cloud-off </option>
		<option value="fe fe-cloud-rain "  data-data=\'{"icon": "fe fe-cloud-rain "}\'>fe fe-cloud-rain </option>
		<option value="fe fe-cloud-snow "  data-data=\'{"icon": "fe fe-cloud-snow "}\'>fe fe-cloud-snow </option>
		<option value="fe fe-code "  data-data=\'{"icon": "fe fe-code "}\'>fe fe-code </option>
		<option value="fe fe-codepen "  data-data=\'{"icon": "fe fe-codepen "}\'>fe fe-codepen </option>
		<option value="fe fe-command "  data-data=\'{"icon": "fe fe-command "}\'>fe fe-command </option>
		<option value="fe fe-compass "  data-data=\'{"icon": "fe fe-compass "}\'>fe fe-compass </option>
		<option value="fe fe-copy "  data-data=\'{"icon": "fe fe-copy "}\'>fe fe-copy </option>
		<option value="fe fe-corner-down-left "  data-data=\'{"icon": "fe fe-corner-down-left "}\'>fe fe-corner-down-left </option>
		<option value="fe fe-corner-down-right "  data-data=\'{"icon": "fe fe-corner-down-right "}\'>fe fe-corner-down-right </option>
		<option value="fe fe-corner-left-down "  data-data=\'{"icon": "fe fe-corner-left-down "}\'>fe fe-corner-left-down </option>
		<option value="fe fe-corner-left-up "  data-data=\'{"icon": "fe fe-corner-left-up "}\'>fe fe-corner-left-up </option>
		<option value="fe fe-corner-right-down "  data-data=\'{"icon": "fe fe-corner-right-down "}\'>fe fe-corner-right-down </option>
		<option value="fe fe-corner-right-up "  data-data=\'{"icon": "fe fe-corner-right-up "}\'>fe fe-corner-right-up </option>
		<option value="fe fe-corner-up-left "  data-data=\'{"icon": "fe fe-corner-up-left "}\'>fe fe-corner-up-left </option>
		<option value="fe fe-corner-up-right "  data-data=\'{"icon": "fe fe-corner-up-right "}\'>fe fe-corner-up-right </option>
		<option value="fe fe-cpu "  data-data=\'{"icon": "fe fe-cpu "}\'>fe fe-cpu </option>
		<option value="fe fe-credit-card "  data-data=\'{"icon": "fe fe-credit-card "}\'>fe fe-credit-card </option>
		<option value="fe fe-crop "  data-data=\'{"icon": "fe fe-crop "}\'>fe fe-crop </option>
		<option value="fe fe-crosshair "  data-data=\'{"icon": "fe fe-crosshair "}\'>fe fe-crosshair </option>
		<option value="fe fe-database "  data-data=\'{"icon": "fe fe-database "}\'>fe fe-database </option>
		<option value="fe fe-delete "  data-data=\'{"icon": "fe fe-delete "}\'>fe fe-delete </option>
		<option value="fe fe-disc "  data-data=\'{"icon": "fe fe-disc "}\'>fe fe-disc </option>
		<option value="fe fe-dollar-sign "  data-data=\'{"icon": "fe fe-dollar-sign "}\'>fe fe-dollar-sign </option>
		<option value="fe fe-download "  data-data=\'{"icon": "fe fe-download "}\'>fe fe-download </option>
		<option value="fe fe-download-cloud "  data-data=\'{"icon": "fe fe-download-cloud "}\'>fe fe-download-cloud </option>
		<option value="fe fe-droplet "  data-data=\'{"icon": "fe fe-droplet "}\'>fe fe-droplet </option>
		<option value="fe fe-edit "  data-data=\'{"icon": "fe fe-edit "}\'>fe fe-edit </option>
		<option value="fe fe-edit-2 "  data-data=\'{"icon": "fe fe-edit-2 "}\'>fe fe-edit-2 </option>
		<option value="fe fe-edit-3 "  data-data=\'{"icon": "fe fe-edit-3 "}\'>fe fe-edit-3 </option>
		<option value="fe fe-external-link "  data-data=\'{"icon": "fe fe-external-link "}\'>fe fe-external-link </option>
		<option value="fe fe-eye "  data-data=\'{"icon": "fe fe-eye "}\'>fe fe-eye </option>
		<option value="fe fe-eye-off "  data-data=\'{"icon": "fe fe-eye-off "}\'>fe fe-eye-off </option>
		<option value="fe fe-facebook "  data-data=\'{"icon": "fe fe-facebook "}\'>fe fe-facebook </option>
		<option value="fe fe-fast-forward "  data-data=\'{"icon": "fe fe-fast-forward "}\'>fe fe-fast-forward </option>
		<option value="fe fe-feather "  data-data=\'{"icon": "fe fe-feather "}\'>fe fe-feather </option>
		<option value="fe fe-file "  data-data=\'{"icon": "fe fe-file "}\'>fe fe-file </option>
		<option value="fe fe-file-minus "  data-data=\'{"icon": "fe fe-file-minus "}\'>fe fe-file-minus </option>
		<option value="fe fe-file-plus "  data-data=\'{"icon": "fe fe-file-plus "}\'>fe fe-file-plus </option>
		<option value="fe fe-file-text "  data-data=\'{"icon": "fe fe-file-text "}\'>fe fe-file-text </option>
		<option value="fe fe-film "  data-data=\'{"icon": "fe fe-film "}\'>fe fe-film </option>
		<option value="fe fe-filter "  data-data=\'{"icon": "fe fe-filter "}\'>fe fe-filter </option>
		<option value="fe fe-flag "  data-data=\'{"icon": "fe fe-flag "}\'>fe fe-flag </option>
		<option value="fe fe-folder "  data-data=\'{"icon": "fe fe-folder "}\'>fe fe-folder </option>
		<option value="fe fe-folder-minus "  data-data=\'{"icon": "fe fe-folder-minus "}\'>fe fe-folder-minus </option>
		<option value="fe fe-folder-plus "  data-data=\'{"icon": "fe fe-folder-plus "}\'>fe fe-folder-plus </option>
		<option value="fe fe-git-branch "  data-data=\'{"icon": "fe fe-git-branch "}\'>fe fe-git-branch </option>
		<option value="fe fe-git-commit "  data-data=\'{"icon": "fe fe-git-commit "}\'>fe fe-git-commit </option>
		<option value="fe fe-git-merge "  data-data=\'{"icon": "fe fe-git-merge "}\'>fe fe-git-merge </option>
		<option value="fe fe-git-pull-request "  data-data=\'{"icon": "fe fe-git-pull-request "}\'>fe fe-git-pull-request </option>
		<option value="fe fe-github "  data-data=\'{"icon": "fe fe-github "}\'>fe fe-github </option>
		<option value="fe fe-gitlab "  data-data=\'{"icon": "fe fe-gitlab "}\'>fe fe-gitlab </option>
		<option value="fe fe-globe "  data-data=\'{"icon": "fe fe-globe "}\'>fe fe-globe </option>
		<option value="fe fe-grid "  data-data=\'{"icon": "fe fe-grid "}\'>fe fe-grid </option>
		<option value="fe fe-hard-drive "  data-data=\'{"icon": "fe fe-hard-drive "}\'>fe fe-hard-drive </option>
		<option value="fe fe-hash "  data-data=\'{"icon": "fe fe-hash "}\'>fe fe-hash </option>
		<option value="fe fe-headphones "  data-data=\'{"icon": "fe fe-headphones "}\'>fe fe-headphones </option>
		<option value="fe fe-heart "  data-data=\'{"icon": "fe fe-heart "}\'>fe fe-heart </option>
		<option value="fe fe-help-circle "  data-data=\'{"icon": "fe fe-help-circle "}\'>fe fe-help-circle </option>
		<option value="fe fe-home "  data-data=\'{"icon": "fe fe-home "}\'>fe fe-home </option>
		<option value="fe fe-image "  data-data=\'{"icon": "fe fe-image "}\'>fe fe-image </option>
		<option value="fe fe-inbox "  data-data=\'{"icon": "fe fe-inbox "}\'>fe fe-inbox </option>
		<option value="fe fe-info "  data-data=\'{"icon": "fe fe-info "}\'>fe fe-info </option>
		<option value="fe fe-instagram "  data-data=\'{"icon": "fe fe-instagram "}\'>fe fe-instagram </option>
		<option value="fe fe-italic "  data-data=\'{"icon": "fe fe-italic "}\'>fe fe-italic </option>
		<option value="fe fe-layers "  data-data=\'{"icon": "fe fe-layers "}\'>fe fe-layers </option>
		<option value="fe fe-layout "  data-data=\'{"icon": "fe fe-layout "}\'>fe fe-layout </option>
		<option value="fe fe-life-buoy "  data-data=\'{"icon": "fe fe-life-buoy "}\'>fe fe-life-buoy </option>
		<option value="fe fe-link "  data-data=\'{"icon": "fe fe-link "}\'>fe fe-link </option>
		<option value="fe fe-link-2 "  data-data=\'{"icon": "fe fe-link-2 "}\'>fe fe-link-2 </option>
		<option value="fe fe-linkedin "  data-data=\'{"icon": "fe fe-linkedin "}\'>fe fe-linkedin </option>
		<option value="fe fe-list "  data-data=\'{"icon": "fe fe-list "}\'>fe fe-list </option>
		<option value="fe fe-loader "  data-data=\'{"icon": "fe fe-loader "}\'>fe fe-loader </option>
		<option value="fe fe-lock "  data-data=\'{"icon": "fe fe-lock "}\'>fe fe-lock </option>
		<option value="fe fe-log-in "  data-data=\'{"icon": "fe fe-log-in "}\'>fe fe-log-in </option>
		<option value="fe fe-log-out "  data-data=\'{"icon": "fe fe-log-out "}\'>fe fe-log-out </option>
		<option value="fe fe-mail "  data-data=\'{"icon": "fe fe-mail "}\'>fe fe-mail </option>
		<option value="fe fe-map "  data-data=\'{"icon": "fe fe-map "}\'>fe fe-map </option>
		<option value="fe fe-map-pin "  data-data=\'{"icon": "fe fe-map-pin "}\'>fe fe-map-pin </option>
		<option value="fe fe-maximize "  data-data=\'{"icon": "fe fe-maximize "}\'>fe fe-maximize </option>
		<option value="fe fe-maximize-2 "  data-data=\'{"icon": "fe fe-maximize-2 "}\'>fe fe-maximize-2 </option>
		<option value="fe fe-menu "  data-data=\'{"icon": "fe fe-menu "}\'>fe fe-menu </option>
		<option value="fe fe-message-circle "  data-data=\'{"icon": "fe fe-message-circle "}\'>fe fe-message-circle </option>
		<option value="fe fe-message-square "  data-data=\'{"icon": "fe fe-message-square "}\'>fe fe-message-square </option>
		<option value="fe fe-mic "  data-data=\'{"icon": "fe fe-mic "}\'>fe fe-mic </option>
		<option value="fe fe-mic-off "  data-data=\'{"icon": "fe fe-mic-off "}\'>fe fe-mic-off </option>
		<option value="fe fe-minimize "  data-data=\'{"icon": "fe fe-minimize "}\'>fe fe-minimize </option>
		<option value="fe fe-minimize-2 "  data-data=\'{"icon": "fe fe-minimize-2 "}\'>fe fe-minimize-2 </option>
		<option value="fe fe-minus "  data-data=\'{"icon": "fe fe-minus "}\'>fe fe-minus </option>
		<option value="fe fe-minus-circle "  data-data=\'{"icon": "fe fe-minus-circle "}\'>fe fe-minus-circle </option>
		<option value="fe fe-minus-square "  data-data=\'{"icon": "fe fe-minus-square "}\'>fe fe-minus-square </option>
		<option value="fe fe-monitor "  data-data=\'{"icon": "fe fe-monitor "}\'>fe fe-monitor </option>
		<option value="fe fe-moon "  data-data=\'{"icon": "fe fe-moon "}\'>fe fe-moon </option>
		<option value="fe fe-more-horizontal "  data-data=\'{"icon": "fe fe-more-horizontal "}\'>fe fe-more-horizontal </option>
		<option value="fe fe-more-vertical "  data-data=\'{"icon": "fe fe-more-vertical "}\'>fe fe-more-vertical </option>
		<option value="fe fe-move "  data-data=\'{"icon": "fe fe-move "}\'>fe fe-move </option>
		<option value="fe fe-music "  data-data=\'{"icon": "fe fe-music "}\'>fe fe-music </option>
		<option value="fe fe-navigation "  data-data=\'{"icon": "fe fe-navigation "}\'>fe fe-navigation </option>
		<option value="fe fe-navigation-2 "  data-data=\'{"icon": "fe fe-navigation-2 "}\'>fe fe-navigation-2 </option>
		<option value="fe fe-octagon "  data-data=\'{"icon": "fe fe-octagon "}\'>fe fe-octagon </option>
		<option value="fe fe-package "  data-data=\'{"icon": "fe fe-package "}\'>fe fe-package </option>
		<option value="fe fe-paperclip "  data-data=\'{"icon": "fe fe-paperclip "}\'>fe fe-paperclip </option>
		<option value="fe fe-pause "  data-data=\'{"icon": "fe fe-pause "}\'>fe fe-pause </option>
		<option value="fe fe-pause-circle "  data-data=\'{"icon": "fe fe-pause-circle "}\'>fe fe-pause-circle </option>
		<option value="fe fe-percent "  data-data=\'{"icon": "fe fe-percent "}\'>fe fe-percent </option>
		<option value="fe fe-phone "  data-data=\'{"icon": "fe fe-phone "}\'>fe fe-phone </option>
		<option value="fe fe-phone-call "  data-data=\'{"icon": "fe fe-phone-call "}\'>fe fe-phone-call </option>
		<option value="fe fe-phone-forwarded "  data-data=\'{"icon": "fe fe-phone-forwarded "}\'>fe fe-phone-forwarded </option>
		<option value="fe fe-phone-incoming "  data-data=\'{"icon": "fe fe-phone-incoming "}\'>fe fe-phone-incoming </option>
		<option value="fe fe-phone-missed "  data-data=\'{"icon": "fe fe-phone-missed "}\'>fe fe-phone-missed </option>
		<option value="fe fe-phone-off "  data-data=\'{"icon": "fe fe-phone-off "}\'>fe fe-phone-off </option>
		<option value="fe fe-phone-outgoing "  data-data=\'{"icon": "fe fe-phone-outgoing "}\'>fe fe-phone-outgoing </option>
		<option value="fe fe-pie-chart "  data-data=\'{"icon": "fe fe-pie-chart "}\'>fe fe-pie-chart </option>
		<option value="fe fe-play "  data-data=\'{"icon": "fe fe-play "}\'>fe fe-play </option>
		<option value="fe fe-play-circle "  data-data=\'{"icon": "fe fe-play-circle "}\'>fe fe-play-circle </option>
		<option value="fe fe-plus "  data-data=\'{"icon": "fe fe-plus "}\'>fe fe-plus </option>
		<option value="fe fe-plus-circle "  data-data=\'{"icon": "fe fe-plus-circle "}\'>fe fe-plus-circle </option>
		<option value="fe fe-plus-square "  data-data=\'{"icon": "fe fe-plus-square "}\'>fe fe-plus-square </option>
		<option value="fe fe-pocket "  data-data=\'{"icon": "fe fe-pocket "}\'>fe fe-pocket </option>
		<option value="fe fe-power "  data-data=\'{"icon": "fe fe-power "}\'>fe fe-power </option>
		<option value="fe fe-printer "  data-data=\'{"icon": "fe fe-printer "}\'>fe fe-printer </option>
		<option value="fe fe-radio "  data-data=\'{"icon": "fe fe-radio "}\'>fe fe-radio </option>
		<option value="fe fe-refresh-ccw "  data-data=\'{"icon": "fe fe-refresh-ccw "}\'>fe fe-refresh-ccw </option>
		<option value="fe fe-refresh-cw "  data-data=\'{"icon": "fe fe-refresh-cw "}\'>fe fe-refresh-cw </option>
		<option value="fe fe-repeat "  data-data=\'{"icon": "fe fe-repeat "}\'>fe fe-repeat </option>
		<option value="fe fe-rewind "  data-data=\'{"icon": "fe fe-rewind "}\'>fe fe-rewind </option>
		<option value="fe fe-rotate-ccw "  data-data=\'{"icon": "fe fe-rotate-ccw "}\'>fe fe-rotate-ccw </option>
		<option value="fe fe-rotate-cw "  data-data=\'{"icon": "fe fe-rotate-cw "}\'>fe fe-rotate-cw </option>
		<option value="fe fe-rss "  data-data=\'{"icon": "fe fe-rss "}\'>fe fe-rss </option>
		<option value="fe fe-save "  data-data=\'{"icon": "fe fe-save "}\'>fe fe-save </option>
		<option value="fe fe-scissors "  data-data=\'{"icon": "fe fe-scissors "}\'>fe fe-scissors </option>
		<option value="fe fe-search "  data-data=\'{"icon": "fe fe-search "}\'>fe fe-search </option>
		<option value="fe fe-send "  data-data=\'{"icon": "fe fe-send "}\'>fe fe-send </option>
		<option value="fe fe-server "  data-data=\'{"icon": "fe fe-server "}\'>fe fe-server </option>
		<option value="fe fe-settings "  data-data=\'{"icon": "fe fe-settings "}\'>fe fe-settings </option>
		<option value="fe fe-share "  data-data=\'{"icon": "fe fe-share "}\'>fe fe-share </option>
		<option value="fe fe-share-2 "  data-data=\'{"icon": "fe fe-share-2 "}\'>fe fe-share-2 </option>
		<option value="fe fe-shield "  data-data=\'{"icon": "fe fe-shield "}\'>fe fe-shield </option>
		<option value="fe fe-shield-off "  data-data=\'{"icon": "fe fe-shield-off "}\'>fe fe-shield-off </option>
		<option value="fe fe-shopping-bag "  data-data=\'{"icon": "fe fe-shopping-bag "}\'>fe fe-shopping-bag </option>
		<option value="fe fe-shopping-cart "  data-data=\'{"icon": "fe fe-shopping-cart "}\'>fe fe-shopping-cart </option>
		<option value="fe fe-shuffle "  data-data=\'{"icon": "fe fe-shuffle "}\'>fe fe-shuffle </option>
		<option value="fe fe-sidebar "  data-data=\'{"icon": "fe fe-sidebar "}\'>fe fe-sidebar </option>
		<option value="fe fe-skip-back "  data-data=\'{"icon": "fe fe-skip-back "}\'>fe fe-skip-back </option>
		<option value="fe fe-skip-forward "  data-data=\'{"icon": "fe fe-skip-forward "}\'>fe fe-skip-forward </option>
		<option value="fe fe-slack "  data-data=\'{"icon": "fe fe-slack "}\'>fe fe-slack </option>
		<option value="fe fe-slash "  data-data=\'{"icon": "fe fe-slash "}\'>fe fe-slash </option>
		<option value="fe fe-sliders "  data-data=\'{"icon": "fe fe-sliders "}\'>fe fe-sliders </option>
		<option value="fe fe-smartphone "  data-data=\'{"icon": "fe fe-smartphone "}\'>fe fe-smartphone </option>
		<option value="fe fe-speaker "  data-data=\'{"icon": "fe fe-speaker "}\'>fe fe-speaker </option>
		<option value="fe fe-square "  data-data=\'{"icon": "fe fe-square "}\'>fe fe-square </option>
		<option value="fe fe-star "  data-data=\'{"icon": "fe fe-star "}\'>fe fe-star </option>
		<option value="fe fe-stop-circle "  data-data=\'{"icon": "fe fe-stop-circle "}\'>fe fe-stop-circle </option>
		<option value="fe fe-sun "  data-data=\'{"icon": "fe fe-sun "}\'>fe fe-sun </option>
		<option value="fe fe-sunrise "  data-data=\'{"icon": "fe fe-sunrise "}\'>fe fe-sunrise </option>
		<option value="fe fe-sunset "  data-data=\'{"icon": "fe fe-sunset "}\'>fe fe-sunset </option>
		<option value="fe fe-tablet "  data-data=\'{"icon": "fe fe-tablet "}\'>fe fe-tablet </option>
		<option value="fe fe-tag "  data-data=\'{"icon": "fe fe-tag "}\'>fe fe-tag </option>
		<option value="fe fe-target "  data-data=\'{"icon": "fe fe-target "}\'>fe fe-target </option>
		<option value="fe fe-terminal "  data-data=\'{"icon": "fe fe-terminal "}\'>fe fe-terminal </option>
		<option value="fe fe-thermometer "  data-data=\'{"icon": "fe fe-thermometer "}\'>fe fe-thermometer </option>
		<option value="fe fe-thumbs-down "  data-data=\'{"icon": "fe fe-thumbs-down "}\'>fe fe-thumbs-down </option>
		<option value="fe fe-thumbs-up "  data-data=\'{"icon": "fe fe-thumbs-up "}\'>fe fe-thumbs-up </option>
		<option value="fe fe-toggle-left "  data-data=\'{"icon": "fe fe-toggle-left "}\'>fe fe-toggle-left </option>
		<option value="fe fe-toggle-right "  data-data=\'{"icon": "fe fe-toggle-right "}\'>fe fe-toggle-right </option>
		<option value="fe fe-trash "  data-data=\'{"icon": "fe fe-trash "}\'>fe fe-trash </option>
		<option value="fe fe-trash-2 "  data-data=\'{"icon": "fe fe-trash-2 "}\'>fe fe-trash-2 </option>
		<option value="fe fe-trending-down "  data-data=\'{"icon": "fe fe-trending-down "}\'>fe fe-trending-down </option>
		<option value="fe fe-trending-up "  data-data=\'{"icon": "fe fe-trending-up "}\'>fe fe-trending-up </option>
		<option value="fe fe-triangle "  data-data=\'{"icon": "fe fe-triangle "}\'>fe fe-triangle </option>
		<option value="fe fe-truck "  data-data=\'{"icon": "fe fe-truck "}\'>fe fe-truck </option>
		<option value="fe fe-tv "  data-data=\'{"icon": "fe fe-tv "}\'>fe fe-tv </option>
		<option value="fe fe-twitter "  data-data=\'{"icon": "fe fe-twitter "}\'>fe fe-twitter </option>
		<option value="fe fe-type "  data-data=\'{"icon": "fe fe-type "}\'>fe fe-type </option>
		<option value="fe fe-umbrella "  data-data=\'{"icon": "fe fe-umbrella "}\'>fe fe-umbrella </option>
		<option value="fe fe-underline "  data-data=\'{"icon": "fe fe-underline "}\'>fe fe-underline </option>
		<option value="fe fe-unlock "  data-data=\'{"icon": "fe fe-unlock "}\'>fe fe-unlock </option>
		<option value="fe fe-upload "  data-data=\'{"icon": "fe fe-upload "}\'>fe fe-upload </option>
		<option value="fe fe-upload-cloud "  data-data=\'{"icon": "fe fe-upload-cloud "}\'>fe fe-upload-cloud </option>
		<option value="fe fe-user "  data-data=\'{"icon": "fe fe-user "}\'>fe fe-user </option>
		<option value="fe fe-user-check "  data-data=\'{"icon": "fe fe-user-check "}\'>fe fe-user-check </option>
		<option value="fe fe-user-minus "  data-data=\'{"icon": "fe fe-user-minus "}\'>fe fe-user-minus </option>
		<option value="fe fe-user-plus "  data-data=\'{"icon": "fe fe-user-plus "}\'>fe fe-user-plus </option>
		<option value="fe fe-user-x "  data-data=\'{"icon": "fe fe-user-x "}\'>fe fe-user-x </option>
		<option value="fe fe-users "  data-data=\'{"icon": "fe fe-users "}\'>fe fe-users </option>
		<option value="fe fe-video "  data-data=\'{"icon": "fe fe-video "}\'>fe fe-video </option>
		<option value="fe fe-video-off "  data-data=\'{"icon": "fe fe-video-off "}\'>fe fe-video-off </option>
		<option value="fe fe-voicemail "  data-data=\'{"icon": "fe fe-voicemail "}\'>fe fe-voicemail </option>
		<option value="fe fe-volume "  data-data=\'{"icon": "fe fe-volume "}\'>fe fe-volume </option>
		<option value="fe fe-volume-1 "  data-data=\'{"icon": "fe fe-volume-1 "}\'>fe fe-volume-1 </option>
		<option value="fe fe-volume-2 "  data-data=\'{"icon": "fe fe-volume-2 "}\'>fe fe-volume-2 </option>
		<option value="fe fe-volume-x "  data-data=\'{"icon": "fe fe-volume-x "}\'>fe fe-volume-x </option>
		<option value="fe fe-watch "  data-data=\'{"icon": "fe fe-watch "}\'>fe fe-watch </option>
		<option value="fe fe-wifi "  data-data=\'{"icon": "fe fe-wifi "}\'>fe fe-wifi </option>
		<option value="fe fe-wifi-off "  data-data=\'{"icon": "fe fe-wifi-off "}\'>fe fe-wifi-off </option>
		<option value="fe fe-wind "  data-data=\'{"icon": "fe fe-wind "}\'>fe fe-wind </option>
		<option value="fe fe-x "  data-data=\'{"icon": "fe fe-x "}\'>fe fe-x </option>
		<option value="fe fe-x-circle "  data-data=\'{"icon": "fe fe-x-circle "}\'>fe fe-x-circle </option>
		<option value="fe fe-x-square "  data-data=\'{"icon": "fe fe-x-square "}\'>fe fe-x-square </option>
		<option value="fe fe-zap "  data-data=\'{"icon": "fe fe-zap "}\'>fe fe-zap </option>
		<option value="fe fe-zap-off "  data-data=\'{"icon": "fe fe-zap-off "}\'>fe fe-zap-off </option>
		<option value="fe fe-zoom-in "  data-data=\'{"icon": "fe fe-zoom-in "}\'>fe fe-zoom-in </option>
		<option value="fe fe-zoom-out "  data-data=\'{"icon": "fe fe-zoom-out "}\'>fe fe-zoom-out </option>
		<option value="fa fa-500px"  data-data=\'{"icon": "fa fa-500px"}\'>fa fa-500px</option>
		<option value="fa fa-address-book"  data-data=\'{"icon": "fa fa-address-book"}\'>fa fa-address-book</option>
		<option value="fa fa-address-book-o"  data-data=\'{"icon": "fa fa-address-book-o"}\'>fa fa-address-book-o</option>
		<option value="fa fa-address-card"  data-data=\'{"icon": "fa fa-address-card"}\'>fa fa-address-card</option>
		<option value="fa fa-address-card-o"  data-data=\'{"icon": "fa fa-address-card-o"}\'>fa fa-address-card-o</option>
		<option value="fa fa-adjust"  data-data=\'{"icon": "fa fa-adjust"}\'>fa fa-adjust</option>
		<option value="fa fa-adn"  data-data=\'{"icon": "fa fa-adn"}\'>fa fa-adn</option>
		<option value="fa fa-align-center"  data-data=\'{"icon": "fa fa-align-center"}\'>fa fa-align-center</option>
		<option value="fa fa-align-justify"  data-data=\'{"icon": "fa fa-align-justify"}\'>fa fa-align-justify</option>
		<option value="fa fa-align-left"  data-data=\'{"icon": "fa fa-align-left"}\'>fa fa-align-left</option>
		<option value="fa fa-align-right"  data-data=\'{"icon": "fa fa-align-right"}\'>fa fa-align-right</option>
		<option value="fa fa-amazon"  data-data=\'{"icon": "fa fa-amazon"}\'>fa fa-amazon</option>
		<option value="fa fa-ambulance"  data-data=\'{"icon": "fa fa-ambulance"}\'>fa fa-ambulance</option>
		<option value="fa fa-american-sign-language-interpreting"  data-data=\'{"icon": "fa fa-american-sign-language-interpreting"}\'>fa fa-american-sign-language-interpreting</option>
		<option value="fa fa-anchor"  data-data=\'{"icon": "fa fa-anchor"}\'>fa fa-anchor</option>
		<option value="fa fa-android"  data-data=\'{"icon": "fa fa-android"}\'>fa fa-android</option>
		<option value="fa fa-angellist"  data-data=\'{"icon": "fa fa-angellist"}\'>fa fa-angellist</option>
		<option value="fa fa-angle-double-down"  data-data=\'{"icon": "fa fa-angle-double-down"}\'>fa fa-angle-double-down</option>
		<option value="fa fa-angle-double-left"  data-data=\'{"icon": "fa fa-angle-double-left"}\'>fa fa-angle-double-left</option>
		<option value="fa fa-angle-double-right"  data-data=\'{"icon": "fa fa-angle-double-right"}\'>fa fa-angle-double-right</option>
		<option value="fa fa-angle-double-up"  data-data=\'{"icon": "fa fa-angle-double-up"}\'>fa fa-angle-double-up</option>
		<option value="fa fa-angle-down"  data-data=\'{"icon": "fa fa-angle-down"}\'>fa fa-angle-down</option>
		<option value="fa fa-angle-left"  data-data=\'{"icon": "fa fa-angle-left"}\'>fa fa-angle-left</option>
		<option value="fa fa-angle-right"  data-data=\'{"icon": "fa fa-angle-right"}\'>fa fa-angle-right</option>
		<option value="fa fa-angle-up"  data-data=\'{"icon": "fa fa-angle-up"}\'>fa fa-angle-up</option>
		<option value="fa fa-apple"  data-data=\'{"icon": "fa fa-apple"}\'>fa fa-apple</option>
		<option value="fa fa-archive"  data-data=\'{"icon": "fa fa-archive"}\'>fa fa-archive</option>
		<option value="fa fa-area-chart"  data-data=\'{"icon": "fa fa-area-chart"}\'>fa fa-area-chart</option>
		<option value="fa fa-arrow-circle-down"  data-data=\'{"icon": "fa fa-arrow-circle-down"}\'>fa fa-arrow-circle-down</option>
		<option value="fa fa-arrow-circle-left"  data-data=\'{"icon": "fa fa-arrow-circle-left"}\'>fa fa-arrow-circle-left</option>
		<option value="fa fa-arrow-circle-o-down"  data-data=\'{"icon": "fa fa-arrow-circle-o-down"}\'>fa fa-arrow-circle-o-down</option>
		<option value="fa fa-arrow-circle-o-left"  data-data=\'{"icon": "fa fa-arrow-circle-o-left"}\'>fa fa-arrow-circle-o-left</option>
		<option value="fa fa-arrow-circle-o-right"  data-data=\'{"icon": "fa fa-arrow-circle-o-right"}\'>fa fa-arrow-circle-o-right</option>
		<option value="fa fa-arrow-circle-o-up"  data-data=\'{"icon": "fa fa-arrow-circle-o-up"}\'>fa fa-arrow-circle-o-up</option>
		<option value="fa fa-arrow-circle-right"  data-data=\'{"icon": "fa fa-arrow-circle-right"}\'>fa fa-arrow-circle-right</option>
		<option value="fa fa-arrow-circle-up"  data-data=\'{"icon": "fa fa-arrow-circle-up"}\'>fa fa-arrow-circle-up</option>
		<option value="fa fa-arrow-down"  data-data=\'{"icon": "fa fa-arrow-down"}\'>fa fa-arrow-down</option>
		<option value="fa fa-arrow-left"  data-data=\'{"icon": "fa fa-arrow-left"}\'>fa fa-arrow-left</option>
		<option value="fa fa-arrow-right"  data-data=\'{"icon": "fa fa-arrow-right"}\'>fa fa-arrow-right</option>
		<option value="fa fa-arrow-up"  data-data=\'{"icon": "fa fa-arrow-up"}\'>fa fa-arrow-up</option>
		<option value="fa fa-arrows"  data-data=\'{"icon": "fa fa-arrows"}\'>fa fa-arrows</option>
		<option value="fa fa-arrows-alt"  data-data=\'{"icon": "fa fa-arrows-alt"}\'>fa fa-arrows-alt</option>
		<option value="fa fa-arrows-h"  data-data=\'{"icon": "fa fa-arrows-h"}\'>fa fa-arrows-h</option>
		<option value="fa fa-arrows-v"  data-data=\'{"icon": "fa fa-arrows-v"}\'>fa fa-arrows-v</option>
		<option value="fa fa-asl-interpreting"  data-data=\'{"icon": "fa fa-asl-interpreting"}\'>fa fa-asl-interpreting</option>
		<option value="fa fa-assistive-listening-systems"  data-data=\'{"icon": "fa fa-assistive-listening-systems"}\'>fa fa-assistive-listening-systems</option>
		<option value="fa fa-asterisk"  data-data=\'{"icon": "fa fa-asterisk"}\'>fa fa-asterisk</option>
		<option value="fa fa-at"  data-data=\'{"icon": "fa fa-at"}\'>fa fa-at</option>
		<option value="fa fa-audio-description"  data-data=\'{"icon": "fa fa-audio-description"}\'>fa fa-audio-description</option>
		<option value="fa fa-automobile"  data-data=\'{"icon": "fa fa-automobile"}\'>fa fa-automobile</option>
		<option value="fa fa-backward"  data-data=\'{"icon": "fa fa-backward"}\'>fa fa-backward</option>
		<option value="fa fa-balance-scale"  data-data=\'{"icon": "fa fa-balance-scale"}\'>fa fa-balance-scale</option>
		<option value="fa fa-ban"  data-data=\'{"icon": "fa fa-ban"}\'>fa fa-ban</option>
		<option value="fa fa-bandcamp"  data-data=\'{"icon": "fa fa-bandcamp"}\'>fa fa-bandcamp</option>
		<option value="fa fa-bank"  data-data=\'{"icon": "fa fa-bank"}\'>fa fa-bank</option>
		<option value="fa fa-bar-chart"  data-data=\'{"icon": "fa fa-bar-chart"}\'>fa fa-bar-chart</option>
		<option value="fa fa-bar-chart-o"  data-data=\'{"icon": "fa fa-bar-chart-o"}\'>fa fa-bar-chart-o</option>
		<option value="fa fa-barcode"  data-data=\'{"icon": "fa fa-barcode"}\'>fa fa-barcode</option>
		<option value="fa fa-bars"  data-data=\'{"icon": "fa fa-bars"}\'>fa fa-bars</option>
		<option value="fa fa-bath"  data-data=\'{"icon": "fa fa-bath"}\'>fa fa-bath</option>
		<option value="fa fa-bathtub"  data-data=\'{"icon": "fa fa-bathtub"}\'>fa fa-bathtub</option>
		<option value="fa fa-battery"  data-data=\'{"icon": "fa fa-battery"}\'>fa fa-battery</option>
		<option value="fa fa-battery-0"  data-data=\'{"icon": "fa fa-battery-0"}\'>fa fa-battery-0</option>
		<option value="fa fa-battery-1"  data-data=\'{"icon": "fa fa-battery-1"}\'>fa fa-battery-1</option>
		<option value="fa fa-battery-2"  data-data=\'{"icon": "fa fa-battery-2"}\'>fa fa-battery-2</option>
		<option value="fa fa-battery-3"  data-data=\'{"icon": "fa fa-battery-3"}\'>fa fa-battery-3</option>
		<option value="fa fa-battery-4"  data-data=\'{"icon": "fa fa-battery-4"}\'>fa fa-battery-4</option>
		<option value="fa fa-battery-empty"  data-data=\'{"icon": "fa fa-battery-empty"}\'>fa fa-battery-empty</option>
		<option value="fa fa-battery-full"  data-data=\'{"icon": "fa fa-battery-full"}\'>fa fa-battery-full</option>
		<option value="fa fa-battery-half"  data-data=\'{"icon": "fa fa-battery-half"}\'>fa fa-battery-half</option>
		<option value="fa fa-battery-quarter"  data-data=\'{"icon": "fa fa-battery-quarter"}\'>fa fa-battery-quarter</option>
		<option value="fa fa-battery-three-quarters"  data-data=\'{"icon": "fa fa-battery-three-quarters"}\'>fa fa-battery-three-quarters</option>
		<option value="fa fa-bed"  data-data=\'{"icon": "fa fa-bed"}\'>fa fa-bed</option>
		<option value="fa fa-beer"  data-data=\'{"icon": "fa fa-beer"}\'>fa fa-beer</option>
		<option value="fa fa-behance"  data-data=\'{"icon": "fa fa-behance"}\'>fa fa-behance</option>
		<option value="fa fa-behance-square"  data-data=\'{"icon": "fa fa-behance-square"}\'>fa fa-behance-square</option>
		<option value="fa fa-bell"  data-data=\'{"icon": "fa fa-bell"}\'>fa fa-bell</option>
		<option value="fa fa-bell-o"  data-data=\'{"icon": "fa fa-bell-o"}\'>fa fa-bell-o</option>
		<option value="fa fa-bell-slash"  data-data=\'{"icon": "fa fa-bell-slash"}\'>fa fa-bell-slash</option>
		<option value="fa fa-bell-slash-o"  data-data=\'{"icon": "fa fa-bell-slash-o"}\'>fa fa-bell-slash-o</option>
		<option value="fa fa-bicycle"  data-data=\'{"icon": "fa fa-bicycle"}\'>fa fa-bicycle</option>
		<option value="fa fa-binoculars"  data-data=\'{"icon": "fa fa-binoculars"}\'>fa fa-binoculars</option>
		<option value="fa fa-birthday-cake"  data-data=\'{"icon": "fa fa-birthday-cake"}\'>fa fa-birthday-cake</option>
		<option value="fa fa-bitbucket"  data-data=\'{"icon": "fa fa-bitbucket"}\'>fa fa-bitbucket</option>
		<option value="fa fa-bitbucket-square"  data-data=\'{"icon": "fa fa-bitbucket-square"}\'>fa fa-bitbucket-square</option>
		<option value="fa fa-bitcoin"  data-data=\'{"icon": "fa fa-bitcoin"}\'>fa fa-bitcoin</option>
		<option value="fa fa-black-tie"  data-data=\'{"icon": "fa fa-black-tie"}\'>fa fa-black-tie</option>
		<option value="fa fa-blind"  data-data=\'{"icon": "fa fa-blind"}\'>fa fa-blind</option>
		<option value="fa fa-bluetooth"  data-data=\'{"icon": "fa fa-bluetooth"}\'>fa fa-bluetooth</option>
		<option value="fa fa-bluetooth-b"  data-data=\'{"icon": "fa fa-bluetooth-b"}\'>fa fa-bluetooth-b</option>
		<option value="fa fa-bold"  data-data=\'{"icon": "fa fa-bold"}\'>fa fa-bold</option>
		<option value="fa fa-bolt"  data-data=\'{"icon": "fa fa-bolt"}\'>fa fa-bolt</option>
		<option value="fa fa-bomb"  data-data=\'{"icon": "fa fa-bomb"}\'>fa fa-bomb</option>
		<option value="fa fa-book"  data-data=\'{"icon": "fa fa-book"}\'>fa fa-book</option>
		<option value="fa fa-bookmark"  data-data=\'{"icon": "fa fa-bookmark"}\'>fa fa-bookmark</option>
		<option value="fa fa-bookmark-o"  data-data=\'{"icon": "fa fa-bookmark-o"}\'>fa fa-bookmark-o</option>
		<option value="fa fa-braille"  data-data=\'{"icon": "fa fa-braille"}\'>fa fa-braille</option>
		<option value="fa fa-briefcase"  data-data=\'{"icon": "fa fa-briefcase"}\'>fa fa-briefcase</option>
		<option value="fa fa-btc"  data-data=\'{"icon": "fa fa-btc"}\'>fa fa-btc</option>
		<option value="fa fa-bug"  data-data=\'{"icon": "fa fa-bug"}\'>fa fa-bug</option>
		<option value="fa fa-building"  data-data=\'{"icon": "fa fa-building"}\'>fa fa-building</option>
		<option value="fa fa-building-o"  data-data=\'{"icon": "fa fa-building-o"}\'>fa fa-building-o</option>
		<option value="fa fa-bullhorn"  data-data=\'{"icon": "fa fa-bullhorn"}\'>fa fa-bullhorn</option>
		<option value="fa fa-bullseye"  data-data=\'{"icon": "fa fa-bullseye"}\'>fa fa-bullseye</option>
		<option value="fa fa-bus"  data-data=\'{"icon": "fa fa-bus"}\'>fa fa-bus</option>
		<option value="fa fa-buysellads"  data-data=\'{"icon": "fa fa-buysellads"}\'>fa fa-buysellads</option>
		<option value="fa fa-cab"  data-data=\'{"icon": "fa fa-cab"}\'>fa fa-cab</option>
		<option value="fa fa-calculator"  data-data=\'{"icon": "fa fa-calculator"}\'>fa fa-calculator</option>
		<option value="fa fa-calendar"  data-data=\'{"icon": "fa fa-calendar"}\'>fa fa-calendar</option>
		<option value="fa fa-calendar-check-o"  data-data=\'{"icon": "fa fa-calendar-check-o"}\'>fa fa-calendar-check-o</option>
		<option value="fa fa-calendar-minus-o"  data-data=\'{"icon": "fa fa-calendar-minus-o"}\'>fa fa-calendar-minus-o</option>
		<option value="fa fa-calendar-o"  data-data=\'{"icon": "fa fa-calendar-o"}\'>fa fa-calendar-o</option>
		<option value="fa fa-calendar-plus-o"  data-data=\'{"icon": "fa fa-calendar-plus-o"}\'>fa fa-calendar-plus-o</option>
		<option value="fa fa-calendar-times-o"  data-data=\'{"icon": "fa fa-calendar-times-o"}\'>fa fa-calendar-times-o</option>
		<option value="fa fa-camera"  data-data=\'{"icon": "fa fa-camera"}\'>fa fa-camera</option>
		<option value="fa fa-camera-retro"  data-data=\'{"icon": "fa fa-camera-retro"}\'>fa fa-camera-retro</option>
		<option value="fa fa-car"  data-data=\'{"icon": "fa fa-car"}\'>fa fa-car</option>
		<option value="fa fa-caret-down"  data-data=\'{"icon": "fa fa-caret-down"}\'>fa fa-caret-down</option>
		<option value="fa fa-caret-left"  data-data=\'{"icon": "fa fa-caret-left"}\'>fa fa-caret-left</option>
		<option value="fa fa-caret-right"  data-data=\'{"icon": "fa fa-caret-right"}\'>fa fa-caret-right</option>
		<option value="fa fa-caret-square-o-down"  data-data=\'{"icon": "fa fa-caret-square-o-down"}\'>fa fa-caret-square-o-down</option>
		<option value="fa fa-caret-square-o-left"  data-data=\'{"icon": "fa fa-caret-square-o-left"}\'>fa fa-caret-square-o-left</option>
		<option value="fa fa-caret-square-o-right"  data-data=\'{"icon": "fa fa-caret-square-o-right"}\'>fa fa-caret-square-o-right</option>
		<option value="fa fa-caret-square-o-up"  data-data=\'{"icon": "fa fa-caret-square-o-up"}\'>fa fa-caret-square-o-up</option>
		<option value="fa fa-caret-up"  data-data=\'{"icon": "fa fa-caret-up"}\'>fa fa-caret-up</option>
		<option value="fa fa-cart-arrow-down"  data-data=\'{"icon": "fa fa-cart-arrow-down"}\'>fa fa-cart-arrow-down</option>
		<option value="fa fa-cart-plus"  data-data=\'{"icon": "fa fa-cart-plus"}\'>fa fa-cart-plus</option>
		<option value="fa fa-cc"  data-data=\'{"icon": "fa fa-cc"}\'>fa fa-cc</option>
		<option value="fa fa-cc-amex"  data-data=\'{"icon": "fa fa-cc-amex"}\'>fa fa-cc-amex</option>
		<option value="fa fa-cc-diners-club"  data-data=\'{"icon": "fa fa-cc-diners-club"}\'>fa fa-cc-diners-club</option>
		<option value="fa fa-cc-discover"  data-data=\'{"icon": "fa fa-cc-discover"}\'>fa fa-cc-discover</option>
		<option value="fa fa-cc-jcb"  data-data=\'{"icon": "fa fa-cc-jcb"}\'>fa fa-cc-jcb</option>
		<option value="fa fa-cc-mastercard"  data-data=\'{"icon": "fa fa-cc-mastercard"}\'>fa fa-cc-mastercard</option>
		<option value="fa fa-cc-paypal"  data-data=\'{"icon": "fa fa-cc-paypal"}\'>fa fa-cc-paypal</option>
		<option value="fa fa-cc-stripe"  data-data=\'{"icon": "fa fa-cc-stripe"}\'>fa fa-cc-stripe</option>
		<option value="fa fa-cc-visa"  data-data=\'{"icon": "fa fa-cc-visa"}\'>fa fa-cc-visa</option>
		<option value="fa fa-certificate"  data-data=\'{"icon": "fa fa-certificate"}\'>fa fa-certificate</option>
		<option value="fa fa-chain"  data-data=\'{"icon": "fa fa-chain"}\'>fa fa-chain</option>
		<option value="fa fa-chain-broken"  data-data=\'{"icon": "fa fa-chain-broken"}\'>fa fa-chain-broken</option>
		<option value="fa fa-check"  data-data=\'{"icon": "fa fa-check"}\'>fa fa-check</option>
		<option value="fa fa-check-circle"  data-data=\'{"icon": "fa fa-check-circle"}\'>fa fa-check-circle</option>
		<option value="fa fa-check-circle-o"  data-data=\'{"icon": "fa fa-check-circle-o"}\'>fa fa-check-circle-o</option>
		<option value="fa fa-check-square"  data-data=\'{"icon": "fa fa-check-square"}\'>fa fa-check-square</option>
		<option value="fa fa-check-square-o"  data-data=\'{"icon": "fa fa-check-square-o"}\'>fa fa-check-square-o</option>
		<option value="fa fa-chevron-circle-down"  data-data=\'{"icon": "fa fa-chevron-circle-down"}\'>fa fa-chevron-circle-down</option>
		<option value="fa fa-chevron-circle-left"  data-data=\'{"icon": "fa fa-chevron-circle-left"}\'>fa fa-chevron-circle-left</option>
		<option value="fa fa-chevron-circle-right"  data-data=\'{"icon": "fa fa-chevron-circle-right"}\'>fa fa-chevron-circle-right</option>
		<option value="fa fa-chevron-circle-up"  data-data=\'{"icon": "fa fa-chevron-circle-up"}\'>fa fa-chevron-circle-up</option>
		<option value="fa fa-chevron-down"  data-data=\'{"icon": "fa fa-chevron-down"}\'>fa fa-chevron-down</option>
		<option value="fa fa-chevron-left"  data-data=\'{"icon": "fa fa-chevron-left"}\'>fa fa-chevron-left</option>
		<option value="fa fa-chevron-right"  data-data=\'{"icon": "fa fa-chevron-right"}\'>fa fa-chevron-right</option>
		<option value="fa fa-chevron-up"  data-data=\'{"icon": "fa fa-chevron-up"}\'>fa fa-chevron-up</option>
		<option value="fa fa-child"  data-data=\'{"icon": "fa fa-child"}\'>fa fa-child</option>
		<option value="fa fa-chrome"  data-data=\'{"icon": "fa fa-chrome"}\'>fa fa-chrome</option>
		<option value="fa fa-circle"  data-data=\'{"icon": "fa fa-circle"}\'>fa fa-circle</option>
		<option value="fa fa-circle-o"  data-data=\'{"icon": "fa fa-circle-o"}\'>fa fa-circle-o</option>
		<option value="fa fa-circle-o-notch"  data-data=\'{"icon": "fa fa-circle-o-notch"}\'>fa fa-circle-o-notch</option>
		<option value="fa fa-circle-thin"  data-data=\'{"icon": "fa fa-circle-thin"}\'>fa fa-circle-thin</option>
		<option value="fa fa-clipboard"  data-data=\'{"icon": "fa fa-clipboard"}\'>fa fa-clipboard</option>
		<option value="fa fa-clock-o"  data-data=\'{"icon": "fa fa-clock-o"}\'>fa fa-clock-o</option>
		<option value="fa fa-clone"  data-data=\'{"icon": "fa fa-clone"}\'>fa fa-clone</option>
		<option value="fa fa-close"  data-data=\'{"icon": "fa fa-close"}\'>fa fa-close</option>
		<option value="fa fa-cloud"  data-data=\'{"icon": "fa fa-cloud"}\'>fa fa-cloud</option>
		<option value="fa fa-cloud-download"  data-data=\'{"icon": "fa fa-cloud-download"}\'>fa fa-cloud-download</option>
		<option value="fa fa-cloud-upload"  data-data=\'{"icon": "fa fa-cloud-upload"}\'>fa fa-cloud-upload</option>
		<option value="fa fa-cny"  data-data=\'{"icon": "fa fa-cny"}\'>fa fa-cny</option>
		<option value="fa fa-code"  data-data=\'{"icon": "fa fa-code"}\'>fa fa-code</option>
		<option value="fa fa-code-fork"  data-data=\'{"icon": "fa fa-code-fork"}\'>fa fa-code-fork</option>
		<option value="fa fa-codepen"  data-data=\'{"icon": "fa fa-codepen"}\'>fa fa-codepen</option>
		<option value="fa fa-codiepie"  data-data=\'{"icon": "fa fa-codiepie"}\'>fa fa-codiepie</option>
		<option value="fa fa-coffee"  data-data=\'{"icon": "fa fa-coffee"}\'>fa fa-coffee</option>
		<option value="fa fa-cog"  data-data=\'{"icon": "fa fa-cog"}\'>fa fa-cog</option>
		<option value="fa fa-cogs"  data-data=\'{"icon": "fa fa-cogs"}\'>fa fa-cogs</option>
		<option value="fa fa-columns"  data-data=\'{"icon": "fa fa-columns"}\'>fa fa-columns</option>
		<option value="fa fa-comment"  data-data=\'{"icon": "fa fa-comment"}\'>fa fa-comment</option>
		<option value="fa fa-comment-o"  data-data=\'{"icon": "fa fa-comment-o"}\'>fa fa-comment-o</option>
		<option value="fa fa-commenting"  data-data=\'{"icon": "fa fa-commenting"}\'>fa fa-commenting</option>
		<option value="fa fa-commenting-o"  data-data=\'{"icon": "fa fa-commenting-o"}\'>fa fa-commenting-o</option>
		<option value="fa fa-comments"  data-data=\'{"icon": "fa fa-comments"}\'>fa fa-comments</option>
		<option value="fa fa-comments-o"  data-data=\'{"icon": "fa fa-comments-o"}\'>fa fa-comments-o</option>
		<option value="fa fa-compass"  data-data=\'{"icon": "fa fa-compass"}\'>fa fa-compass</option>
		<option value="fa fa-compress"  data-data=\'{"icon": "fa fa-compress"}\'>fa fa-compress</option>
		<option value="fa fa-connectdevelop"  data-data=\'{"icon": "fa fa-connectdevelop"}\'>fa fa-connectdevelop</option>
		<option value="fa fa-contao"  data-data=\'{"icon": "fa fa-contao"}\'>fa fa-contao</option>
		<option value="fa fa-copy"  data-data=\'{"icon": "fa fa-copy"}\'>fa fa-copy</option>
		<option value="fa fa-copyright"  data-data=\'{"icon": "fa fa-copyright"}\'>fa fa-copyright</option>
		<option value="fa fa-creative-commons"  data-data=\'{"icon": "fa fa-creative-commons"}\'>fa fa-creative-commons</option>
		<option value="fa fa-credit-card"  data-data=\'{"icon": "fa fa-credit-card"}\'>fa fa-credit-card</option>
		<option value="fa fa-credit-card-alt"  data-data=\'{"icon": "fa fa-credit-card-alt"}\'>fa fa-credit-card-alt</option>
		<option value="fa fa-crop"  data-data=\'{"icon": "fa fa-crop"}\'>fa fa-crop</option>
		<option value="fa fa-crosshairs"  data-data=\'{"icon": "fa fa-crosshairs"}\'>fa fa-crosshairs</option>
		<option value="fa fa-css3"  data-data=\'{"icon": "fa fa-css3"}\'>fa fa-css3</option>
		<option value="fa fa-cube"  data-data=\'{"icon": "fa fa-cube"}\'>fa fa-cube</option>
		<option value="fa fa-cubes"  data-data=\'{"icon": "fa fa-cubes"}\'>fa fa-cubes</option>
		<option value="fa fa-cut"  data-data=\'{"icon": "fa fa-cut"}\'>fa fa-cut</option>
		<option value="fa fa-cutlery"  data-data=\'{"icon": "fa fa-cutlery"}\'>fa fa-cutlery</option>
		<option value="fa fa-dashboard"  data-data=\'{"icon": "fa fa-dashboard"}\'>fa fa-dashboard</option>
		<option value="fa fa-dashcube"  data-data=\'{"icon": "fa fa-dashcube"}\'>fa fa-dashcube</option>
		<option value="fa fa-database"  data-data=\'{"icon": "fa fa-database"}\'>fa fa-database</option>
		<option value="fa fa-deaf"  data-data=\'{"icon": "fa fa-deaf"}\'>fa fa-deaf</option>
		<option value="fa fa-deafness"  data-data=\'{"icon": "fa fa-deafness"}\'>fa fa-deafness</option>
		<option value="fa fa-dedent"  data-data=\'{"icon": "fa fa-dedent"}\'>fa fa-dedent</option>
		<option value="fa fa-delicious"  data-data=\'{"icon": "fa fa-delicious"}\'>fa fa-delicious</option>
		<option value="fa fa-desktop"  data-data=\'{"icon": "fa fa-desktop"}\'>fa fa-desktop</option>
		<option value="fa fa-deviantart"  data-data=\'{"icon": "fa fa-deviantart"}\'>fa fa-deviantart</option>
		<option value="fa fa-diamond"  data-data=\'{"icon": "fa fa-diamond"}\'>fa fa-diamond</option>
		<option value="fa fa-digg"  data-data=\'{"icon": "fa fa-digg"}\'>fa fa-digg</option>
		<option value="fa fa-dollar"  data-data=\'{"icon": "fa fa-dollar"}\'>fa fa-dollar</option>
		<option value="fa fa-dot-circle-o"  data-data=\'{"icon": "fa fa-dot-circle-o"}\'>fa fa-dot-circle-o</option>
		<option value="fa fa-download"  data-data=\'{"icon": "fa fa-download"}\'>fa fa-download</option>
		<option value="fa fa-dribbble"  data-data=\'{"icon": "fa fa-dribbble"}\'>fa fa-dribbble</option>
		<option value="fa fa-drivers-license"  data-data=\'{"icon": "fa fa-drivers-license"}\'>fa fa-drivers-license</option>
		<option value="fa fa-drivers-license-o"  data-data=\'{"icon": "fa fa-drivers-license-o"}\'>fa fa-drivers-license-o</option>
		<option value="fa fa-dropbox"  data-data=\'{"icon": "fa fa-dropbox"}\'>fa fa-dropbox</option>
		<option value="fa fa-drupal"  data-data=\'{"icon": "fa fa-drupal"}\'>fa fa-drupal</option>
		<option value="fa fa-edge"  data-data=\'{"icon": "fa fa-edge"}\'>fa fa-edge</option>
		<option value="fa fa-edit"  data-data=\'{"icon": "fa fa-edit"}\'>fa fa-edit</option>
		<option value="fa fa-eercast"  data-data=\'{"icon": "fa fa-eercast"}\'>fa fa-eercast</option>
		<option value="fa fa-eject"  data-data=\'{"icon": "fa fa-eject"}\'>fa fa-eject</option>
		<option value="fa fa-ellipsis-h"  data-data=\'{"icon": "fa fa-ellipsis-h"}\'>fa fa-ellipsis-h</option>
		<option value="fa fa-ellipsis-v"  data-data=\'{"icon": "fa fa-ellipsis-v"}\'>fa fa-ellipsis-v</option>
		<option value="fa fa-empire"  data-data=\'{"icon": "fa fa-empire"}\'>fa fa-empire</option>
		<option value="fa fa-envelope"  data-data=\'{"icon": "fa fa-envelope"}\'>fa fa-envelope</option>
		<option value="fa fa-envelope-o"  data-data=\'{"icon": "fa fa-envelope-o"}\'>fa fa-envelope-o</option>
		<option value="fa fa-envelope-open"  data-data=\'{"icon": "fa fa-envelope-open"}\'>fa fa-envelope-open</option>
		<option value="fa fa-envelope-open-o"  data-data=\'{"icon": "fa fa-envelope-open-o"}\'>fa fa-envelope-open-o</option>
		<option value="fa fa-envelope-square"  data-data=\'{"icon": "fa fa-envelope-square"}\'>fa fa-envelope-square</option>
		<option value="fa fa-envira"  data-data=\'{"icon": "fa fa-envira"}\'>fa fa-envira</option>
		<option value="fa fa-eraser"  data-data=\'{"icon": "fa fa-eraser"}\'>fa fa-eraser</option>
		<option value="fa fa-etsy"  data-data=\'{"icon": "fa fa-etsy"}\'>fa fa-etsy</option>
		<option value="fa fa-eur"  data-data=\'{"icon": "fa fa-eur"}\'>fa fa-eur</option>
		<option value="fa fa-euro"  data-data=\'{"icon": "fa fa-euro"}\'>fa fa-euro</option>
		<option value="fa fa-exchange"  data-data=\'{"icon": "fa fa-exchange"}\'>fa fa-exchange</option>
		<option value="fa fa-exclamation"  data-data=\'{"icon": "fa fa-exclamation"}\'>fa fa-exclamation</option>
		<option value="fa fa-exclamation-circle"  data-data=\'{"icon": "fa fa-exclamation-circle"}\'>fa fa-exclamation-circle</option>
		<option value="fa fa-exclamation-triangle"  data-data=\'{"icon": "fa fa-exclamation-triangle"}\'>fa fa-exclamation-triangle</option>
		<option value="fa fa-expand"  data-data=\'{"icon": "fa fa-expand"}\'>fa fa-expand</option>
		<option value="fa fa-expeditedssl"  data-data=\'{"icon": "fa fa-expeditedssl"}\'>fa fa-expeditedssl</option>
		<option value="fa fa-external-link"  data-data=\'{"icon": "fa fa-external-link"}\'>fa fa-external-link</option>
		<option value="fa fa-external-link-square"  data-data=\'{"icon": "fa fa-external-link-square"}\'>fa fa-external-link-square</option>
		<option value="fa fa-eye"  data-data=\'{"icon": "fa fa-eye"}\'>fa fa-eye</option>
		<option value="fa fa-eye-slash"  data-data=\'{"icon": "fa fa-eye-slash"}\'>fa fa-eye-slash</option>
		<option value="fa fa-eyedropper"  data-data=\'{"icon": "fa fa-eyedropper"}\'>fa fa-eyedropper</option>
		<option value="fa fa-fa"  data-data=\'{"icon": "fa fa-fa"}\'>fa fa-fa</option>
		<option value="fa fa-facebook"  data-data=\'{"icon": "fa fa-facebook"}\'>fa fa-facebook</option>
		<option value="fa fa-facebook-f"  data-data=\'{"icon": "fa fa-facebook-f"}\'>fa fa-facebook-f</option>
		<option value="fa fa-facebook-official"  data-data=\'{"icon": "fa fa-facebook-official"}\'>fa fa-facebook-official</option>
		<option value="fa fa-facebook-square"  data-data=\'{"icon": "fa fa-facebook-square"}\'>fa fa-facebook-square</option>
		<option value="fa fa-fast-backward"  data-data=\'{"icon": "fa fa-fast-backward"}\'>fa fa-fast-backward</option>
		<option value="fa fa-fast-forward"  data-data=\'{"icon": "fa fa-fast-forward"}\'>fa fa-fast-forward</option>
		<option value="fa fa-fax"  data-data=\'{"icon": "fa fa-fax"}\'>fa fa-fax</option>
		<option value="fa fa-feed"  data-data=\'{"icon": "fa fa-feed"}\'>fa fa-feed</option>
		<option value="fa fa-female"  data-data=\'{"icon": "fa fa-female"}\'>fa fa-female</option>
		<option value="fa fa-fighter-jet"  data-data=\'{"icon": "fa fa-fighter-jet"}\'>fa fa-fighter-jet</option>
		<option value="fa fa-file"  data-data=\'{"icon": "fa fa-file"}\'>fa fa-file</option>
		<option value="fa fa-file-archive-o"  data-data=\'{"icon": "fa fa-file-archive-o"}\'>fa fa-file-archive-o</option>
		<option value="fa fa-file-audio-o"  data-data=\'{"icon": "fa fa-file-audio-o"}\'>fa fa-file-audio-o</option>
		<option value="fa fa-file-code-o"  data-data=\'{"icon": "fa fa-file-code-o"}\'>fa fa-file-code-o</option>
		<option value="fa fa-file-excel-o"  data-data=\'{"icon": "fa fa-file-excel-o"}\'>fa fa-file-excel-o</option>
		<option value="fa fa-file-image-o"  data-data=\'{"icon": "fa fa-file-image-o"}\'>fa fa-file-image-o</option>
		<option value="fa fa-file-movie-o"  data-data=\'{"icon": "fa fa-file-movie-o"}\'>fa fa-file-movie-o</option>
		<option value="fa fa-file-o"  data-data=\'{"icon": "fa fa-file-o"}\'>fa fa-file-o</option>
		<option value="fa fa-file-pdf-o"  data-data=\'{"icon": "fa fa-file-pdf-o"}\'>fa fa-file-pdf-o</option>
		<option value="fa fa-file-photo-o"  data-data=\'{"icon": "fa fa-file-photo-o"}\'>fa fa-file-photo-o</option>
		<option value="fa fa-file-picture-o"  data-data=\'{"icon": "fa fa-file-picture-o"}\'>fa fa-file-picture-o</option>
		<option value="fa fa-file-powerpoint-o"  data-data=\'{"icon": "fa fa-file-powerpoint-o"}\'>fa fa-file-powerpoint-o</option>
		<option value="fa fa-file-sound-o"  data-data=\'{"icon": "fa fa-file-sound-o"}\'>fa fa-file-sound-o</option>
		<option value="fa fa-file-text"  data-data=\'{"icon": "fa fa-file-text"}\'>fa fa-file-text</option>
		<option value="fa fa-file-text-o"  data-data=\'{"icon": "fa fa-file-text-o"}\'>fa fa-file-text-o</option>
		<option value="fa fa-file-video-o"  data-data=\'{"icon": "fa fa-file-video-o"}\'>fa fa-file-video-o</option>
		<option value="fa fa-file-word-o"  data-data=\'{"icon": "fa fa-file-word-o"}\'>fa fa-file-word-o</option>
		<option value="fa fa-file-zip-o"  data-data=\'{"icon": "fa fa-file-zip-o"}\'>fa fa-file-zip-o</option>
		<option value="fa fa-files-o"  data-data=\'{"icon": "fa fa-files-o"}\'>fa fa-files-o</option>
		<option value="fa fa-film"  data-data=\'{"icon": "fa fa-film"}\'>fa fa-film</option>
		<option value="fa fa-filter"  data-data=\'{"icon": "fa fa-filter"}\'>fa fa-filter</option>
		<option value="fa fa-fire"  data-data=\'{"icon": "fa fa-fire"}\'>fa fa-fire</option>
		<option value="fa fa-fire-extinguisher"  data-data=\'{"icon": "fa fa-fire-extinguisher"}\'>fa fa-fire-extinguisher</option>
		<option value="fa fa-firefox"  data-data=\'{"icon": "fa fa-firefox"}\'>fa fa-firefox</option>
		<option value="fa fa-first-order"  data-data=\'{"icon": "fa fa-first-order"}\'>fa fa-first-order</option>
		<option value="fa fa-flag"  data-data=\'{"icon": "fa fa-flag"}\'>fa fa-flag</option>
		<option value="fa fa-flag-checkered"  data-data=\'{"icon": "fa fa-flag-checkered"}\'>fa fa-flag-checkered</option>
		<option value="fa fa-flag-o"  data-data=\'{"icon": "fa fa-flag-o"}\'>fa fa-flag-o</option>
		<option value="fa fa-flash"  data-data=\'{"icon": "fa fa-flash"}\'>fa fa-flash</option>
		<option value="fa fa-flask"  data-data=\'{"icon": "fa fa-flask"}\'>fa fa-flask</option>
		<option value="fa fa-flickr"  data-data=\'{"icon": "fa fa-flickr"}\'>fa fa-flickr</option>
		<option value="fa fa-floppy-o"  data-data=\'{"icon": "fa fa-floppy-o"}\'>fa fa-floppy-o</option>
		<option value="fa fa-folder"  data-data=\'{"icon": "fa fa-folder"}\'>fa fa-folder</option>
		<option value="fa fa-folder-o"  data-data=\'{"icon": "fa fa-folder-o"}\'>fa fa-folder-o</option>
		<option value="fa fa-folder-open"  data-data=\'{"icon": "fa fa-folder-open"}\'>fa fa-folder-open</option>
		<option value="fa fa-folder-open-o"  data-data=\'{"icon": "fa fa-folder-open-o"}\'>fa fa-folder-open-o</option>
		<option value="fa fa-font"  data-data=\'{"icon": "fa fa-font"}\'>fa fa-font</option>
		<option value="fa fa-font-awesome"  data-data=\'{"icon": "fa fa-font-awesome"}\'>fa fa-font-awesome</option>
		<option value="fa fa-fonticons"  data-data=\'{"icon": "fa fa-fonticons"}\'>fa fa-fonticons</option>
		<option value="fa fa-fort-awesome"  data-data=\'{"icon": "fa fa-fort-awesome"}\'>fa fa-fort-awesome</option>
		<option value="fa fa-forumbee"  data-data=\'{"icon": "fa fa-forumbee"}\'>fa fa-forumbee</option>
		<option value="fa fa-forward"  data-data=\'{"icon": "fa fa-forward"}\'>fa fa-forward</option>
		<option value="fa fa-foursquare"  data-data=\'{"icon": "fa fa-foursquare"}\'>fa fa-foursquare</option>
		<option value="fa fa-free-code-camp"  data-data=\'{"icon": "fa fa-free-code-camp"}\'>fa fa-free-code-camp</option>
		<option value="fa fa-frown-o"  data-data=\'{"icon": "fa fa-frown-o"}\'>fa fa-frown-o</option>
		<option value="fa fa-futbol-o"  data-data=\'{"icon": "fa fa-futbol-o"}\'>fa fa-futbol-o</option>
		<option value="fa fa-gamepad"  data-data=\'{"icon": "fa fa-gamepad"}\'>fa fa-gamepad</option>
		<option value="fa fa-gavel"  data-data=\'{"icon": "fa fa-gavel"}\'>fa fa-gavel</option>
		<option value="fa fa-gbp"  data-data=\'{"icon": "fa fa-gbp"}\'>fa fa-gbp</option>
		<option value="fa fa-ge"  data-data=\'{"icon": "fa fa-ge"}\'>fa fa-ge</option>
		<option value="fa fa-gear"  data-data=\'{"icon": "fa fa-gear"}\'>fa fa-gear</option>
		<option value="fa fa-gears"  data-data=\'{"icon": "fa fa-gears"}\'>fa fa-gears</option>
		<option value="fa fa-genderless"  data-data=\'{"icon": "fa fa-genderless"}\'>fa fa-genderless</option>
		<option value="fa fa-get-pocket"  data-data=\'{"icon": "fa fa-get-pocket"}\'>fa fa-get-pocket</option>
		<option value="fa fa-gg"  data-data=\'{"icon": "fa fa-gg"}\'>fa fa-gg</option>
		<option value="fa fa-gg-circle"  data-data=\'{"icon": "fa fa-gg-circle"}\'>fa fa-gg-circle</option>
		<option value="fa fa-gift"  data-data=\'{"icon": "fa fa-gift"}\'>fa fa-gift</option>
		<option value="fa fa-git"  data-data=\'{"icon": "fa fa-git"}\'>fa fa-git</option>
		<option value="fa fa-git-square"  data-data=\'{"icon": "fa fa-git-square"}\'>fa fa-git-square</option>
		<option value="fa fa-github"  data-data=\'{"icon": "fa fa-github"}\'>fa fa-github</option>
		<option value="fa fa-github-alt"  data-data=\'{"icon": "fa fa-github-alt"}\'>fa fa-github-alt</option>
		<option value="fa fa-github-square"  data-data=\'{"icon": "fa fa-github-square"}\'>fa fa-github-square</option>
		<option value="fa fa-gitlab"  data-data=\'{"icon": "fa fa-gitlab"}\'>fa fa-gitlab</option>
		<option value="fa fa-gittip"  data-data=\'{"icon": "fa fa-gittip"}\'>fa fa-gittip</option>
		<option value="fa fa-glass"  data-data=\'{"icon": "fa fa-glass"}\'>fa fa-glass</option>
		<option value="fa fa-glide"  data-data=\'{"icon": "fa fa-glide"}\'>fa fa-glide</option>
		<option value="fa fa-glide-g"  data-data=\'{"icon": "fa fa-glide-g"}\'>fa fa-glide-g</option>
		<option value="fa fa-globe"  data-data=\'{"icon": "fa fa-globe"}\'>fa fa-globe</option>
		<option value="fa fa-google"  data-data=\'{"icon": "fa fa-google"}\'>fa fa-google</option>
		<option value="fa fa-google-plus"  data-data=\'{"icon": "fa fa-google-plus"}\'>fa fa-google-plus</option>
		<option value="fa fa-google-plus-circle"  data-data=\'{"icon": "fa fa-google-plus-circle"}\'>fa fa-google-plus-circle</option>
		<option value="fa fa-google-plus-official"  data-data=\'{"icon": "fa fa-google-plus-official"}\'>fa fa-google-plus-official</option>
		<option value="fa fa-google-plus-square"  data-data=\'{"icon": "fa fa-google-plus-square"}\'>fa fa-google-plus-square</option>
		<option value="fa fa-google-wallet"  data-data=\'{"icon": "fa fa-google-wallet"}\'>fa fa-google-wallet</option>
		<option value="fa fa-graduation-cap"  data-data=\'{"icon": "fa fa-graduation-cap"}\'>fa fa-graduation-cap</option>
		<option value="fa fa-gratipay"  data-data=\'{"icon": "fa fa-gratipay"}\'>fa fa-gratipay</option>
		<option value="fa fa-grav"  data-data=\'{"icon": "fa fa-grav"}\'>fa fa-grav</option>
		<option value="fa fa-group"  data-data=\'{"icon": "fa fa-group"}\'>fa fa-group</option>
		<option value="fa fa-h-square"  data-data=\'{"icon": "fa fa-h-square"}\'>fa fa-h-square</option>
		<option value="fa fa-hacker-news"  data-data=\'{"icon": "fa fa-hacker-news"}\'>fa fa-hacker-news</option>
		<option value="fa fa-hand-grab-o"  data-data=\'{"icon": "fa fa-hand-grab-o"}\'>fa fa-hand-grab-o</option>
		<option value="fa fa-hand-lizard-o"  data-data=\'{"icon": "fa fa-hand-lizard-o"}\'>fa fa-hand-lizard-o</option>
		<option value="fa fa-hand-o-down"  data-data=\'{"icon": "fa fa-hand-o-down"}\'>fa fa-hand-o-down</option>
		<option value="fa fa-hand-o-left"  data-data=\'{"icon": "fa fa-hand-o-left"}\'>fa fa-hand-o-left</option>
		<option value="fa fa-hand-o-right"  data-data=\'{"icon": "fa fa-hand-o-right"}\'>fa fa-hand-o-right</option>
		<option value="fa fa-hand-o-up"  data-data=\'{"icon": "fa fa-hand-o-up"}\'>fa fa-hand-o-up</option>
		<option value="fa fa-hand-paper-o"  data-data=\'{"icon": "fa fa-hand-paper-o"}\'>fa fa-hand-paper-o</option>
		<option value="fa fa-hand-peace-o"  data-data=\'{"icon": "fa fa-hand-peace-o"}\'>fa fa-hand-peace-o</option>
		<option value="fa fa-hand-pointer-o"  data-data=\'{"icon": "fa fa-hand-pointer-o"}\'>fa fa-hand-pointer-o</option>
		<option value="fa fa-hand-rock-o"  data-data=\'{"icon": "fa fa-hand-rock-o"}\'>fa fa-hand-rock-o</option>
		<option value="fa fa-hand-scissors-o"  data-data=\'{"icon": "fa fa-hand-scissors-o"}\'>fa fa-hand-scissors-o</option>
		<option value="fa fa-hand-spock-o"  data-data=\'{"icon": "fa fa-hand-spock-o"}\'>fa fa-hand-spock-o</option>
		<option value="fa fa-hand-stop-o"  data-data=\'{"icon": "fa fa-hand-stop-o"}\'>fa fa-hand-stop-o</option>
		<option value="fa fa-handshake-o"  data-data=\'{"icon": "fa fa-handshake-o"}\'>fa fa-handshake-o</option>
		<option value="fa fa-hard-of-hearing"  data-data=\'{"icon": "fa fa-hard-of-hearing"}\'>fa fa-hard-of-hearing</option>
		<option value="fa fa-hashtag"  data-data=\'{"icon": "fa fa-hashtag"}\'>fa fa-hashtag</option>
		<option value="fa fa-hdd-o"  data-data=\'{"icon": "fa fa-hdd-o"}\'>fa fa-hdd-o</option>
		<option value="fa fa-header"  data-data=\'{"icon": "fa fa-header"}\'>fa fa-header</option>
		<option value="fa fa-headphones"  data-data=\'{"icon": "fa fa-headphones"}\'>fa fa-headphones</option>
		<option value="fa fa-heart"  data-data=\'{"icon": "fa fa-heart"}\'>fa fa-heart</option>
		<option value="fa fa-heart-o"  data-data=\'{"icon": "fa fa-heart-o"}\'>fa fa-heart-o</option>
		<option value="fa fa-heartbeat"  data-data=\'{"icon": "fa fa-heartbeat"}\'>fa fa-heartbeat</option>
		<option value="fa fa-history"  data-data=\'{"icon": "fa fa-history"}\'>fa fa-history</option>
		<option value="fa fa-home"  data-data=\'{"icon": "fa fa-home"}\'>fa fa-home</option>
		<option value="fa fa-hospital-o"  data-data=\'{"icon": "fa fa-hospital-o"}\'>fa fa-hospital-o</option>
		<option value="fa fa-hotel"  data-data=\'{"icon": "fa fa-hotel"}\'>fa fa-hotel</option>
		<option value="fa fa-hourglass"  data-data=\'{"icon": "fa fa-hourglass"}\'>fa fa-hourglass</option>
		<option value="fa fa-hourglass-1"  data-data=\'{"icon": "fa fa-hourglass-1"}\'>fa fa-hourglass-1</option>
		<option value="fa fa-hourglass-2"  data-data=\'{"icon": "fa fa-hourglass-2"}\'>fa fa-hourglass-2</option>
		<option value="fa fa-hourglass-3"  data-data=\'{"icon": "fa fa-hourglass-3"}\'>fa fa-hourglass-3</option>
		<option value="fa fa-hourglass-end"  data-data=\'{"icon": "fa fa-hourglass-end"}\'>fa fa-hourglass-end</option>
		<option value="fa fa-hourglass-half"  data-data=\'{"icon": "fa fa-hourglass-half"}\'>fa fa-hourglass-half</option>
		<option value="fa fa-hourglass-o"  data-data=\'{"icon": "fa fa-hourglass-o"}\'>fa fa-hourglass-o</option>
		<option value="fa fa-hourglass-start"  data-data=\'{"icon": "fa fa-hourglass-start"}\'>fa fa-hourglass-start</option>
		<option value="fa fa-houzz"  data-data=\'{"icon": "fa fa-houzz"}\'>fa fa-houzz</option>
		<option value="fa fa-html5"  data-data=\'{"icon": "fa fa-html5"}\'>fa fa-html5</option>
		<option value="fa fa-i-cursor"  data-data=\'{"icon": "fa fa-i-cursor"}\'>fa fa-i-cursor</option>
		<option value="fa fa-id-badge"  data-data=\'{"icon": "fa fa-id-badge"}\'>fa fa-id-badge</option>
		<option value="fa fa-id-card"  data-data=\'{"icon": "fa fa-id-card"}\'>fa fa-id-card</option>
		<option value="fa fa-id-card-o"  data-data=\'{"icon": "fa fa-id-card-o"}\'>fa fa-id-card-o</option>
		<option value="fa fa-ils"  data-data=\'{"icon": "fa fa-ils"}\'>fa fa-ils</option>
		<option value="fa fa-image"  data-data=\'{"icon": "fa fa-image"}\'>fa fa-image</option>
		<option value="fa fa-imdb"  data-data=\'{"icon": "fa fa-imdb"}\'>fa fa-imdb</option>
		<option value="fa fa-inbox"  data-data=\'{"icon": "fa fa-inbox"}\'>fa fa-inbox</option>
		<option value="fa fa-indent"  data-data=\'{"icon": "fa fa-indent"}\'>fa fa-indent</option>
		<option value="fa fa-industry"  data-data=\'{"icon": "fa fa-industry"}\'>fa fa-industry</option>
		<option value="fa fa-info"  data-data=\'{"icon": "fa fa-info"}\'>fa fa-info</option>
		<option value="fa fa-info-circle"  data-data=\'{"icon": "fa fa-info-circle"}\'>fa fa-info-circle</option>
		<option value="fa fa-inr"  data-data=\'{"icon": "fa fa-inr"}\'>fa fa-inr</option>
		<option value="fa fa-instagram"  data-data=\'{"icon": "fa fa-instagram"}\'>fa fa-instagram</option>
		<option value="fa fa-institution"  data-data=\'{"icon": "fa fa-institution"}\'>fa fa-institution</option>
		<option value="fa fa-internet-explorer"  data-data=\'{"icon": "fa fa-internet-explorer"}\'>fa fa-internet-explorer</option>
		<option value="fa fa-intersex"  data-data=\'{"icon": "fa fa-intersex"}\'>fa fa-intersex</option>
		<option value="fa fa-ioxhost"  data-data=\'{"icon": "fa fa-ioxhost"}\'>fa fa-ioxhost</option>
		<option value="fa fa-italic"  data-data=\'{"icon": "fa fa-italic"}\'>fa fa-italic</option>
		<option value="fa fa-joomla"  data-data=\'{"icon": "fa fa-joomla"}\'>fa fa-joomla</option>
		<option value="fa fa-jpy"  data-data=\'{"icon": "fa fa-jpy"}\'>fa fa-jpy</option>
		<option value="fa fa-jsfiddle"  data-data=\'{"icon": "fa fa-jsfiddle"}\'>fa fa-jsfiddle</option>
		<option value="fa fa-key"  data-data=\'{"icon": "fa fa-key"}\'>fa fa-key</option>
		<option value="fa fa-keyboard-o"  data-data=\'{"icon": "fa fa-keyboard-o"}\'>fa fa-keyboard-o</option>
		<option value="fa fa-krw"  data-data=\'{"icon": "fa fa-krw"}\'>fa fa-krw</option>
		<option value="fa fa-language"  data-data=\'{"icon": "fa fa-language"}\'>fa fa-language</option>
		<option value="fa fa-laptop"  data-data=\'{"icon": "fa fa-laptop"}\'>fa fa-laptop</option>
		<option value="fa fa-lastfm"  data-data=\'{"icon": "fa fa-lastfm"}\'>fa fa-lastfm</option>
		<option value="fa fa-lastfm-square"  data-data=\'{"icon": "fa fa-lastfm-square"}\'>fa fa-lastfm-square</option>
		<option value="fa fa-leaf"  data-data=\'{"icon": "fa fa-leaf"}\'>fa fa-leaf</option>
		<option value="fa fa-leanpub"  data-data=\'{"icon": "fa fa-leanpub"}\'>fa fa-leanpub</option>
		<option value="fa fa-legal"  data-data=\'{"icon": "fa fa-legal"}\'>fa fa-legal</option>
		<option value="fa fa-lemon-o"  data-data=\'{"icon": "fa fa-lemon-o"}\'>fa fa-lemon-o</option>
		<option value="fa fa-level-down"  data-data=\'{"icon": "fa fa-level-down"}\'>fa fa-level-down</option>
		<option value="fa fa-level-up"  data-data=\'{"icon": "fa fa-level-up"}\'>fa fa-level-up</option>
		<option value="fa fa-life-bouy"  data-data=\'{"icon": "fa fa-life-bouy"}\'>fa fa-life-bouy</option>
		<option value="fa fa-life-buoy"  data-data=\'{"icon": "fa fa-life-buoy"}\'>fa fa-life-buoy</option>
		<option value="fa fa-life-ring"  data-data=\'{"icon": "fa fa-life-ring"}\'>fa fa-life-ring</option>
		<option value="fa fa-life-saver"  data-data=\'{"icon": "fa fa-life-saver"}\'>fa fa-life-saver</option>
		<option value="fa fa-lightbulb-o"  data-data=\'{"icon": "fa fa-lightbulb-o"}\'>fa fa-lightbulb-o</option>
		<option value="fa fa-line-chart"  data-data=\'{"icon": "fa fa-line-chart"}\'>fa fa-line-chart</option>
		<option value="fa fa-link"  data-data=\'{"icon": "fa fa-link"}\'>fa fa-link</option>
		<option value="fa fa-linkedin"  data-data=\'{"icon": "fa fa-linkedin"}\'>fa fa-linkedin</option>
		<option value="fa fa-linkedin-square"  data-data=\'{"icon": "fa fa-linkedin-square"}\'>fa fa-linkedin-square</option>
		<option value="fa fa-linode"  data-data=\'{"icon": "fa fa-linode"}\'>fa fa-linode</option>
		<option value="fa fa-linux"  data-data=\'{"icon": "fa fa-linux"}\'>fa fa-linux</option>
		<option value="fa fa-list"  data-data=\'{"icon": "fa fa-list"}\'>fa fa-list</option>
		<option value="fa fa-list-alt"  data-data=\'{"icon": "fa fa-list-alt"}\'>fa fa-list-alt</option>
		<option value="fa fa-list-ol"  data-data=\'{"icon": "fa fa-list-ol"}\'>fa fa-list-ol</option>
		<option value="fa fa-list-ul"  data-data=\'{"icon": "fa fa-list-ul"}\'>fa fa-list-ul</option>
		<option value="fa fa-location-arrow"  data-data=\'{"icon": "fa fa-location-arrow"}\'>fa fa-location-arrow</option>
		<option value="fa fa-lock"  data-data=\'{"icon": "fa fa-lock"}\'>fa fa-lock</option>
		<option value="fa fa-long-arrow-down"  data-data=\'{"icon": "fa fa-long-arrow-down"}\'>fa fa-long-arrow-down</option>
		<option value="fa fa-long-arrow-left"  data-data=\'{"icon": "fa fa-long-arrow-left"}\'>fa fa-long-arrow-left</option>
		<option value="fa fa-long-arrow-right"  data-data=\'{"icon": "fa fa-long-arrow-right"}\'>fa fa-long-arrow-right</option>
		<option value="fa fa-long-arrow-up"  data-data=\'{"icon": "fa fa-long-arrow-up"}\'>fa fa-long-arrow-up</option>
		<option value="fa fa-low-vision"  data-data=\'{"icon": "fa fa-low-vision"}\'>fa fa-low-vision</option>
		<option value="fa fa-magic"  data-data=\'{"icon": "fa fa-magic"}\'>fa fa-magic</option>
		<option value="fa fa-magnet"  data-data=\'{"icon": "fa fa-magnet"}\'>fa fa-magnet</option>
		<option value="fa fa-mail-forward"  data-data=\'{"icon": "fa fa-mail-forward"}\'>fa fa-mail-forward</option>
		<option value="fa fa-mail-reply"  data-data=\'{"icon": "fa fa-mail-reply"}\'>fa fa-mail-reply</option>
		<option value="fa fa-mail-reply-all"  data-data=\'{"icon": "fa fa-mail-reply-all"}\'>fa fa-mail-reply-all</option>
		<option value="fa fa-male"  data-data=\'{"icon": "fa fa-male"}\'>fa fa-male</option>
		<option value="fa fa-map"  data-data=\'{"icon": "fa fa-map"}\'>fa fa-map</option>
		<option value="fa fa-map-marker"  data-data=\'{"icon": "fa fa-map-marker"}\'>fa fa-map-marker</option>
		<option value="fa fa-map-o"  data-data=\'{"icon": "fa fa-map-o"}\'>fa fa-map-o</option>
		<option value="fa fa-map-pin"  data-data=\'{"icon": "fa fa-map-pin"}\'>fa fa-map-pin</option>
		<option value="fa fa-map-signs"  data-data=\'{"icon": "fa fa-map-signs"}\'>fa fa-map-signs</option>
		<option value="fa fa-mars"  data-data=\'{"icon": "fa fa-mars"}\'>fa fa-mars</option>
		<option value="fa fa-mars-double"  data-data=\'{"icon": "fa fa-mars-double"}\'>fa fa-mars-double</option>
		<option value="fa fa-mars-stroke"  data-data=\'{"icon": "fa fa-mars-stroke"}\'>fa fa-mars-stroke</option>
		<option value="fa fa-mars-stroke-h"  data-data=\'{"icon": "fa fa-mars-stroke-h"}\'>fa fa-mars-stroke-h</option>
		<option value="fa fa-mars-stroke-v"  data-data=\'{"icon": "fa fa-mars-stroke-v"}\'>fa fa-mars-stroke-v</option>
		<option value="fa fa-maxcdn"  data-data=\'{"icon": "fa fa-maxcdn"}\'>fa fa-maxcdn</option>
		<option value="fa fa-meanpath"  data-data=\'{"icon": "fa fa-meanpath"}\'>fa fa-meanpath</option>
		<option value="fa fa-medium"  data-data=\'{"icon": "fa fa-medium"}\'>fa fa-medium</option>
		<option value="fa fa-medkit"  data-data=\'{"icon": "fa fa-medkit"}\'>fa fa-medkit</option>
		<option value="fa fa-meetup"  data-data=\'{"icon": "fa fa-meetup"}\'>fa fa-meetup</option>
		<option value="fa fa-meh-o"  data-data=\'{"icon": "fa fa-meh-o"}\'>fa fa-meh-o</option>
		<option value="fa fa-mercury"  data-data=\'{"icon": "fa fa-mercury"}\'>fa fa-mercury</option>
		<option value="fa fa-microchip"  data-data=\'{"icon": "fa fa-microchip"}\'>fa fa-microchip</option>
		<option value="fa fa-microphone"  data-data=\'{"icon": "fa fa-microphone"}\'>fa fa-microphone</option>
		<option value="fa fa-microphone-slash"  data-data=\'{"icon": "fa fa-microphone-slash"}\'>fa fa-microphone-slash</option>
		<option value="fa fa-minus"  data-data=\'{"icon": "fa fa-minus"}\'>fa fa-minus</option>
		<option value="fa fa-minus-circle"  data-data=\'{"icon": "fa fa-minus-circle"}\'>fa fa-minus-circle</option>
		<option value="fa fa-minus-square"  data-data=\'{"icon": "fa fa-minus-square"}\'>fa fa-minus-square</option>
		<option value="fa fa-minus-square-o"  data-data=\'{"icon": "fa fa-minus-square-o"}\'>fa fa-minus-square-o</option>
		<option value="fa fa-mixcloud"  data-data=\'{"icon": "fa fa-mixcloud"}\'>fa fa-mixcloud</option>
		<option value="fa fa-mobile"  data-data=\'{"icon": "fa fa-mobile"}\'>fa fa-mobile</option>
		<option value="fa fa-mobile-phone"  data-data=\'{"icon": "fa fa-mobile-phone"}\'>fa fa-mobile-phone</option>
		<option value="fa fa-modx"  data-data=\'{"icon": "fa fa-modx"}\'>fa fa-modx</option>
		<option value="fa fa-money"  data-data=\'{"icon": "fa fa-money"}\'>fa fa-money</option>
		<option value="fa fa-moon-o"  data-data=\'{"icon": "fa fa-moon-o"}\'>fa fa-moon-o</option>
		<option value="fa fa-mortar-board"  data-data=\'{"icon": "fa fa-mortar-board"}\'>fa fa-mortar-board</option>
		<option value="fa fa-motorcycle"  data-data=\'{"icon": "fa fa-motorcycle"}\'>fa fa-motorcycle</option>
		<option value="fa fa-mouse-pointer"  data-data=\'{"icon": "fa fa-mouse-pointer"}\'>fa fa-mouse-pointer</option>
		<option value="fa fa-music"  data-data=\'{"icon": "fa fa-music"}\'>fa fa-music</option>
		<option value="fa fa-navicon"  data-data=\'{"icon": "fa fa-navicon"}\'>fa fa-navicon</option>
		<option value="fa fa-neuter"  data-data=\'{"icon": "fa fa-neuter"}\'>fa fa-neuter</option>
		<option value="fa fa-newspaper-o"  data-data=\'{"icon": "fa fa-newspaper-o"}\'>fa fa-newspaper-o</option>
		<option value="fa fa-object-group"  data-data=\'{"icon": "fa fa-object-group"}\'>fa fa-object-group</option>
		<option value="fa fa-object-ungroup"  data-data=\'{"icon": "fa fa-object-ungroup"}\'>fa fa-object-ungroup</option>
		<option value="fa fa-odnoklassniki"  data-data=\'{"icon": "fa fa-odnoklassniki"}\'>fa fa-odnoklassniki</option>
		<option value="fa fa-odnoklassniki-square"  data-data=\'{"icon": "fa fa-odnoklassniki-square"}\'>fa fa-odnoklassniki-square</option>
		<option value="fa fa-opencart"  data-data=\'{"icon": "fa fa-opencart"}\'>fa fa-opencart</option>
		<option value="fa fa-openid"  data-data=\'{"icon": "fa fa-openid"}\'>fa fa-openid</option>
		<option value="fa fa-opera"  data-data=\'{"icon": "fa fa-opera"}\'>fa fa-opera</option>
		<option value="fa fa-optin-monster"  data-data=\'{"icon": "fa fa-optin-monster"}\'>fa fa-optin-monster</option>
		<option value="fa fa-outdent"  data-data=\'{"icon": "fa fa-outdent"}\'>fa fa-outdent</option>
		<option value="fa fa-pagelines"  data-data=\'{"icon": "fa fa-pagelines"}\'>fa fa-pagelines</option>
		<option value="fa fa-paint-brush"  data-data=\'{"icon": "fa fa-paint-brush"}\'>fa fa-paint-brush</option>
		<option value="fa fa-paper-plane"  data-data=\'{"icon": "fa fa-paper-plane"}\'>fa fa-paper-plane</option>
		<option value="fa fa-paper-plane-o"  data-data=\'{"icon": "fa fa-paper-plane-o"}\'>fa fa-paper-plane-o</option>
		<option value="fa fa-paperclip"  data-data=\'{"icon": "fa fa-paperclip"}\'>fa fa-paperclip</option>
		<option value="fa fa-paragraph"  data-data=\'{"icon": "fa fa-paragraph"}\'>fa fa-paragraph</option>
		<option value="fa fa-paste"  data-data=\'{"icon": "fa fa-paste"}\'>fa fa-paste</option>
		<option value="fa fa-pause"  data-data=\'{"icon": "fa fa-pause"}\'>fa fa-pause</option>
		<option value="fa fa-pause-circle"  data-data=\'{"icon": "fa fa-pause-circle"}\'>fa fa-pause-circle</option>
		<option value="fa fa-pause-circle-o"  data-data=\'{"icon": "fa fa-pause-circle-o"}\'>fa fa-pause-circle-o</option>
		<option value="fa fa-paw"  data-data=\'{"icon": "fa fa-paw"}\'>fa fa-paw</option>
		<option value="fa fa-paypal"  data-data=\'{"icon": "fa fa-paypal"}\'>fa fa-paypal</option>
		<option value="fa fa-pencil"  data-data=\'{"icon": "fa fa-pencil"}\'>fa fa-pencil</option>
		<option value="fa fa-pencil-square"  data-data=\'{"icon": "fa fa-pencil-square"}\'>fa fa-pencil-square</option>
		<option value="fa fa-pencil-square-o"  data-data=\'{"icon": "fa fa-pencil-square-o"}\'>fa fa-pencil-square-o</option>
		<option value="fa fa-percent"  data-data=\'{"icon": "fa fa-percent"}\'>fa fa-percent</option>
		<option value="fa fa-phone"  data-data=\'{"icon": "fa fa-phone"}\'>fa fa-phone</option>
		<option value="fa fa-phone-square"  data-data=\'{"icon": "fa fa-phone-square"}\'>fa fa-phone-square</option>
		<option value="fa fa-photo"  data-data=\'{"icon": "fa fa-photo"}\'>fa fa-photo</option>
		<option value="fa fa-picture-o"  data-data=\'{"icon": "fa fa-picture-o"}\'>fa fa-picture-o</option>
		<option value="fa fa-pie-chart"  data-data=\'{"icon": "fa fa-pie-chart"}\'>fa fa-pie-chart</option>
		<option value="fa fa-pied-piper"  data-data=\'{"icon": "fa fa-pied-piper"}\'>fa fa-pied-piper</option>
		<option value="fa fa-pied-piper-alt"  data-data=\'{"icon": "fa fa-pied-piper-alt"}\'>fa fa-pied-piper-alt</option>
		<option value="fa fa-pied-piper-pp"  data-data=\'{"icon": "fa fa-pied-piper-pp"}\'>fa fa-pied-piper-pp</option>
		<option value="fa fa-pinterest"  data-data=\'{"icon": "fa fa-pinterest"}\'>fa fa-pinterest</option>
		<option value="fa fa-pinterest-p"  data-data=\'{"icon": "fa fa-pinterest-p"}\'>fa fa-pinterest-p</option>
		<option value="fa fa-pinterest-square"  data-data=\'{"icon": "fa fa-pinterest-square"}\'>fa fa-pinterest-square</option>
		<option value="fa fa-plane"  data-data=\'{"icon": "fa fa-plane"}\'>fa fa-plane</option>
		<option value="fa fa-play"  data-data=\'{"icon": "fa fa-play"}\'>fa fa-play</option>
		<option value="fa fa-play-circle"  data-data=\'{"icon": "fa fa-play-circle"}\'>fa fa-play-circle</option>
		<option value="fa fa-play-circle-o"  data-data=\'{"icon": "fa fa-play-circle-o"}\'>fa fa-play-circle-o</option>
		<option value="fa fa-plug"  data-data=\'{"icon": "fa fa-plug"}\'>fa fa-plug</option>
		<option value="fa fa-plus"  data-data=\'{"icon": "fa fa-plus"}\'>fa fa-plus</option>
		<option value="fa fa-plus-circle"  data-data=\'{"icon": "fa fa-plus-circle"}\'>fa fa-plus-circle</option>
		<option value="fa fa-plus-square"  data-data=\'{"icon": "fa fa-plus-square"}\'>fa fa-plus-square</option>
		<option value="fa fa-plus-square-o"  data-data=\'{"icon": "fa fa-plus-square-o"}\'>fa fa-plus-square-o</option>
		<option value="fa fa-podcast"  data-data=\'{"icon": "fa fa-podcast"}\'>fa fa-podcast</option>
		<option value="fa fa-power-off"  data-data=\'{"icon": "fa fa-power-off"}\'>fa fa-power-off</option>
		<option value="fa fa-print"  data-data=\'{"icon": "fa fa-print"}\'>fa fa-print</option>
		<option value="fa fa-product-hunt"  data-data=\'{"icon": "fa fa-product-hunt"}\'>fa fa-product-hunt</option>
		<option value="fa fa-puzzle-piece"  data-data=\'{"icon": "fa fa-puzzle-piece"}\'>fa fa-puzzle-piece</option>
		<option value="fa fa-qq"  data-data=\'{"icon": "fa fa-qq"}\'>fa fa-qq</option>
		<option value="fa fa-qrcode"  data-data=\'{"icon": "fa fa-qrcode"}\'>fa fa-qrcode</option>
		<option value="fa fa-question"  data-data=\'{"icon": "fa fa-question"}\'>fa fa-question</option>
		<option value="fa fa-question-circle"  data-data=\'{"icon": "fa fa-question-circle"}\'>fa fa-question-circle</option>
		<option value="fa fa-question-circle-o"  data-data=\'{"icon": "fa fa-question-circle-o"}\'>fa fa-question-circle-o</option>
		<option value="fa fa-quora"  data-data=\'{"icon": "fa fa-quora"}\'>fa fa-quora</option>
		<option value="fa fa-quote-left"  data-data=\'{"icon": "fa fa-quote-left"}\'>fa fa-quote-left</option>
		<option value="fa fa-quote-right"  data-data=\'{"icon": "fa fa-quote-right"}\'>fa fa-quote-right</option>
		<option value="fa fa-ra"  data-data=\'{"icon": "fa fa-ra"}\'>fa fa-ra</option>
		<option value="fa fa-random"  data-data=\'{"icon": "fa fa-random"}\'>fa fa-random</option>
		<option value="fa fa-ravelry"  data-data=\'{"icon": "fa fa-ravelry"}\'>fa fa-ravelry</option>
		<option value="fa fa-rebel"  data-data=\'{"icon": "fa fa-rebel"}\'>fa fa-rebel</option>
		<option value="fa fa-recycle"  data-data=\'{"icon": "fa fa-recycle"}\'>fa fa-recycle</option>
		<option value="fa fa-reddit"  data-data=\'{"icon": "fa fa-reddit"}\'>fa fa-reddit</option>
		<option value="fa fa-reddit-alien"  data-data=\'{"icon": "fa fa-reddit-alien"}\'>fa fa-reddit-alien</option>
		<option value="fa fa-reddit-square"  data-data=\'{"icon": "fa fa-reddit-square"}\'>fa fa-reddit-square</option>
		<option value="fa fa-refresh"  data-data=\'{"icon": "fa fa-refresh"}\'>fa fa-refresh</option>
		<option value="fa fa-registered"  data-data=\'{"icon": "fa fa-registered"}\'>fa fa-registered</option>
		<option value="fa fa-remove"  data-data=\'{"icon": "fa fa-remove"}\'>fa fa-remove</option>
		<option value="fa fa-renren"  data-data=\'{"icon": "fa fa-renren"}\'>fa fa-renren</option>
		<option value="fa fa-reorder"  data-data=\'{"icon": "fa fa-reorder"}\'>fa fa-reorder</option>
		<option value="fa fa-repeat"  data-data=\'{"icon": "fa fa-repeat"}\'>fa fa-repeat</option>
		<option value="fa fa-reply"  data-data=\'{"icon": "fa fa-reply"}\'>fa fa-reply</option>
		<option value="fa fa-reply-all"  data-data=\'{"icon": "fa fa-reply-all"}\'>fa fa-reply-all</option>
		<option value="fa fa-resistance"  data-data=\'{"icon": "fa fa-resistance"}\'>fa fa-resistance</option>
		<option value="fa fa-retweet"  data-data=\'{"icon": "fa fa-retweet"}\'>fa fa-retweet</option>
		<option value="fa fa-rmb"  data-data=\'{"icon": "fa fa-rmb"}\'>fa fa-rmb</option>
		<option value="fa fa-road"  data-data=\'{"icon": "fa fa-road"}\'>fa fa-road</option>
		<option value="fa fa-rocket"  data-data=\'{"icon": "fa fa-rocket"}\'>fa fa-rocket</option>
		<option value="fa fa-rotate-left"  data-data=\'{"icon": "fa fa-rotate-left"}\'>fa fa-rotate-left</option>
		<option value="fa fa-rotate-right"  data-data=\'{"icon": "fa fa-rotate-right"}\'>fa fa-rotate-right</option>
		<option value="fa fa-rouble"  data-data=\'{"icon": "fa fa-rouble"}\'>fa fa-rouble</option>
		<option value="fa fa-rss"  data-data=\'{"icon": "fa fa-rss"}\'>fa fa-rss</option>
		<option value="fa fa-rss-square"  data-data=\'{"icon": "fa fa-rss-square"}\'>fa fa-rss-square</option>
		<option value="fa fa-rub"  data-data=\'{"icon": "fa fa-rub"}\'>fa fa-rub</option>
		<option value="fa fa-ruble"  data-data=\'{"icon": "fa fa-ruble"}\'>fa fa-ruble</option>
		<option value="fa fa-rupee"  data-data=\'{"icon": "fa fa-rupee"}\'>fa fa-rupee</option>
		<option value="fa fa-s15"  data-data=\'{"icon": "fa fa-s15"}\'>fa fa-s15</option>
		<option value="fa fa-safari"  data-data=\'{"icon": "fa fa-safari"}\'>fa fa-safari</option>
		<option value="fa fa-save"  data-data=\'{"icon": "fa fa-save"}\'>fa fa-save</option>
		<option value="fa fa-scissors"  data-data=\'{"icon": "fa fa-scissors"}\'>fa fa-scissors</option>
		<option value="fa fa-scribd"  data-data=\'{"icon": "fa fa-scribd"}\'>fa fa-scribd</option>
		<option value="fa fa-search"  data-data=\'{"icon": "fa fa-search"}\'>fa fa-search</option>
		<option value="fa fa-search-minus"  data-data=\'{"icon": "fa fa-search-minus"}\'>fa fa-search-minus</option>
		<option value="fa fa-search-plus"  data-data=\'{"icon": "fa fa-search-plus"}\'>fa fa-search-plus</option>
		<option value="fa fa-sellsy"  data-data=\'{"icon": "fa fa-sellsy"}\'>fa fa-sellsy</option>
		<option value="fa fa-send"  data-data=\'{"icon": "fa fa-send"}\'>fa fa-send</option>
		<option value="fa fa-send-o"  data-data=\'{"icon": "fa fa-send-o"}\'>fa fa-send-o</option>
		<option value="fa fa-server"  data-data=\'{"icon": "fa fa-server"}\'>fa fa-server</option>
		<option value="fa fa-share"  data-data=\'{"icon": "fa fa-share"}\'>fa fa-share</option>
		<option value="fa fa-share-alt"  data-data=\'{"icon": "fa fa-share-alt"}\'>fa fa-share-alt</option>
		<option value="fa fa-share-alt-square"  data-data=\'{"icon": "fa fa-share-alt-square"}\'>fa fa-share-alt-square</option>
		<option value="fa fa-share-square"  data-data=\'{"icon": "fa fa-share-square"}\'>fa fa-share-square</option>
		<option value="fa fa-share-square-o"  data-data=\'{"icon": "fa fa-share-square-o"}\'>fa fa-share-square-o</option>
		<option value="fa fa-shekel"  data-data=\'{"icon": "fa fa-shekel"}\'>fa fa-shekel</option>
		<option value="fa fa-sheqel"  data-data=\'{"icon": "fa fa-sheqel"}\'>fa fa-sheqel</option>
		<option value="fa fa-shield"  data-data=\'{"icon": "fa fa-shield"}\'>fa fa-shield</option>
		<option value="fa fa-ship"  data-data=\'{"icon": "fa fa-ship"}\'>fa fa-ship</option>
		<option value="fa fa-shirtsinbulk"  data-data=\'{"icon": "fa fa-shirtsinbulk"}\'>fa fa-shirtsinbulk</option>
		<option value="fa fa-shopping-bag"  data-data=\'{"icon": "fa fa-shopping-bag"}\'>fa fa-shopping-bag</option>
		<option value="fa fa-shopping-basket"  data-data=\'{"icon": "fa fa-shopping-basket"}\'>fa fa-shopping-basket</option>
		<option value="fa fa-shopping-cart"  data-data=\'{"icon": "fa fa-shopping-cart"}\'>fa fa-shopping-cart</option>
		<option value="fa fa-shower"  data-data=\'{"icon": "fa fa-shower"}\'>fa fa-shower</option>
		<option value="fa fa-sign-in"  data-data=\'{"icon": "fa fa-sign-in"}\'>fa fa-sign-in</option>
		<option value="fa fa-sign-language"  data-data=\'{"icon": "fa fa-sign-language"}\'>fa fa-sign-language</option>
		<option value="fa fa-sign-out"  data-data=\'{"icon": "fa fa-sign-out"}\'>fa fa-sign-out</option>
		<option value="fa fa-signal"  data-data=\'{"icon": "fa fa-signal"}\'>fa fa-signal</option>
		<option value="fa fa-signing"  data-data=\'{"icon": "fa fa-signing"}\'>fa fa-signing</option>
		<option value="fa fa-simplybuilt"  data-data=\'{"icon": "fa fa-simplybuilt"}\'>fa fa-simplybuilt</option>
		<option value="fa fa-sitemap"  data-data=\'{"icon": "fa fa-sitemap"}\'>fa fa-sitemap</option>
		<option value="fa fa-skyatlas"  data-data=\'{"icon": "fa fa-skyatlas"}\'>fa fa-skyatlas</option>
		<option value="fa fa-skype"  data-data=\'{"icon": "fa fa-skype"}\'>fa fa-skype</option>
		<option value="fa fa-slack"  data-data=\'{"icon": "fa fa-slack"}\'>fa fa-slack</option>
		<option value="fa fa-sliders"  data-data=\'{"icon": "fa fa-sliders"}\'>fa fa-sliders</option>
		<option value="fa fa-slideshare"  data-data=\'{"icon": "fa fa-slideshare"}\'>fa fa-slideshare</option>
		<option value="fa fa-smile-o"  data-data=\'{"icon": "fa fa-smile-o"}\'>fa fa-smile-o</option>
		<option value="fa fa-snapchat"  data-data=\'{"icon": "fa fa-snapchat"}\'>fa fa-snapchat</option>
		<option value="fa fa-snapchat-ghost"  data-data=\'{"icon": "fa fa-snapchat-ghost"}\'>fa fa-snapchat-ghost</option>
		<option value="fa fa-snapchat-square"  data-data=\'{"icon": "fa fa-snapchat-square"}\'>fa fa-snapchat-square</option>
		<option value="fa fa-snowflake-o"  data-data=\'{"icon": "fa fa-snowflake-o"}\'>fa fa-snowflake-o</option>
		<option value="fa fa-soccer-ball-o"  data-data=\'{"icon": "fa fa-soccer-ball-o"}\'>fa fa-soccer-ball-o</option>
		<option value="fa fa-sort"  data-data=\'{"icon": "fa fa-sort"}\'>fa fa-sort</option>
		<option value="fa fa-sort-alpha-asc"  data-data=\'{"icon": "fa fa-sort-alpha-asc"}\'>fa fa-sort-alpha-asc</option>
		<option value="fa fa-sort-alpha-desc"  data-data=\'{"icon": "fa fa-sort-alpha-desc"}\'>fa fa-sort-alpha-desc</option>
		<option value="fa fa-sort-amount-asc"  data-data=\'{"icon": "fa fa-sort-amount-asc"}\'>fa fa-sort-amount-asc</option>
		<option value="fa fa-sort-amount-desc"  data-data=\'{"icon": "fa fa-sort-amount-desc"}\'>fa fa-sort-amount-desc</option>
		<option value="fa fa-sort-asc"  data-data=\'{"icon": "fa fa-sort-asc"}\'>fa fa-sort-asc</option>
		<option value="fa fa-sort-desc"  data-data=\'{"icon": "fa fa-sort-desc"}\'>fa fa-sort-desc</option>
		<option value="fa fa-sort-down"  data-data=\'{"icon": "fa fa-sort-down"}\'>fa fa-sort-down</option>
		<option value="fa fa-sort-numeric-asc"  data-data=\'{"icon": "fa fa-sort-numeric-asc"}\'>fa fa-sort-numeric-asc</option>
		<option value="fa fa-sort-numeric-desc"  data-data=\'{"icon": "fa fa-sort-numeric-desc"}\'>fa fa-sort-numeric-desc</option>
		<option value="fa fa-sort-up"  data-data=\'{"icon": "fa fa-sort-up"}\'>fa fa-sort-up</option>
		<option value="fa fa-soundcloud"  data-data=\'{"icon": "fa fa-soundcloud"}\'>fa fa-soundcloud</option>
		<option value="fa fa-space-shuttle"  data-data=\'{"icon": "fa fa-space-shuttle"}\'>fa fa-space-shuttle</option>
		<option value="fa fa-spinner"  data-data=\'{"icon": "fa fa-spinner"}\'>fa fa-spinner</option>
		<option value="fa fa-spoon"  data-data=\'{"icon": "fa fa-spoon"}\'>fa fa-spoon</option>
		<option value="fa fa-spotify"  data-data=\'{"icon": "fa fa-spotify"}\'>fa fa-spotify</option>
		<option value="fa fa-square"  data-data=\'{"icon": "fa fa-square"}\'>fa fa-square</option>
		<option value="fa fa-square-o"  data-data=\'{"icon": "fa fa-square-o"}\'>fa fa-square-o</option>
		<option value="fa fa-stack-exchange"  data-data=\'{"icon": "fa fa-stack-exchange"}\'>fa fa-stack-exchange</option>
		<option value="fa fa-stack-overflow"  data-data=\'{"icon": "fa fa-stack-overflow"}\'>fa fa-stack-overflow</option>
		<option value="fa fa-star"  data-data=\'{"icon": "fa fa-star"}\'>fa fa-star</option>
		<option value="fa fa-star-half"  data-data=\'{"icon": "fa fa-star-half"}\'>fa fa-star-half</option>
		<option value="fa fa-star-half-empty"  data-data=\'{"icon": "fa fa-star-half-empty"}\'>fa fa-star-half-empty</option>
		<option value="fa fa-star-half-full"  data-data=\'{"icon": "fa fa-star-half-full"}\'>fa fa-star-half-full</option>
		<option value="fa fa-star-half-o"  data-data=\'{"icon": "fa fa-star-half-o"}\'>fa fa-star-half-o</option>
		<option value="fa fa-star-o"  data-data=\'{"icon": "fa fa-star-o"}\'>fa fa-star-o</option>
		<option value="fa fa-steam"  data-data=\'{"icon": "fa fa-steam"}\'>fa fa-steam</option>
		<option value="fa fa-steam-square"  data-data=\'{"icon": "fa fa-steam-square"}\'>fa fa-steam-square</option>
		<option value="fa fa-step-backward"  data-data=\'{"icon": "fa fa-step-backward"}\'>fa fa-step-backward</option>
		<option value="fa fa-step-forward"  data-data=\'{"icon": "fa fa-step-forward"}\'>fa fa-step-forward</option>
		<option value="fa fa-stethoscope"  data-data=\'{"icon": "fa fa-stethoscope"}\'>fa fa-stethoscope</option>
		<option value="fa fa-sticky-note"  data-data=\'{"icon": "fa fa-sticky-note"}\'>fa fa-sticky-note</option>
		<option value="fa fa-sticky-note-o"  data-data=\'{"icon": "fa fa-sticky-note-o"}\'>fa fa-sticky-note-o</option>
		<option value="fa fa-stop"  data-data=\'{"icon": "fa fa-stop"}\'>fa fa-stop</option>
		<option value="fa fa-stop-circle"  data-data=\'{"icon": "fa fa-stop-circle"}\'>fa fa-stop-circle</option>
		<option value="fa fa-stop-circle-o"  data-data=\'{"icon": "fa fa-stop-circle-o"}\'>fa fa-stop-circle-o</option>
		<option value="fa fa-street-view"  data-data=\'{"icon": "fa fa-street-view"}\'>fa fa-street-view</option>
		<option value="fa fa-strikethrough"  data-data=\'{"icon": "fa fa-strikethrough"}\'>fa fa-strikethrough</option>
		<option value="fa fa-stumbleupon"  data-data=\'{"icon": "fa fa-stumbleupon"}\'>fa fa-stumbleupon</option>
		<option value="fa fa-stumbleupon-circle"  data-data=\'{"icon": "fa fa-stumbleupon-circle"}\'>fa fa-stumbleupon-circle</option>
		<option value="fa fa-subscript"  data-data=\'{"icon": "fa fa-subscript"}\'>fa fa-subscript</option>
		<option value="fa fa-subway"  data-data=\'{"icon": "fa fa-subway"}\'>fa fa-subway</option>
		<option value="fa fa-suitcase"  data-data=\'{"icon": "fa fa-suitcase"}\'>fa fa-suitcase</option>
		<option value="fa fa-sun-o"  data-data=\'{"icon": "fa fa-sun-o"}\'>fa fa-sun-o</option>
		<option value="fa fa-superpowers"  data-data=\'{"icon": "fa fa-superpowers"}\'>fa fa-superpowers</option>
		<option value="fa fa-superscript"  data-data=\'{"icon": "fa fa-superscript"}\'>fa fa-superscript</option>
		<option value="fa fa-support"  data-data=\'{"icon": "fa fa-support"}\'>fa fa-support</option>
		<option value="fa fa-table"  data-data=\'{"icon": "fa fa-table"}\'>fa fa-table</option>
		<option value="fa fa-tablet"  data-data=\'{"icon": "fa fa-tablet"}\'>fa fa-tablet</option>
		<option value="fa fa-tachometer"  data-data=\'{"icon": "fa fa-tachometer"}\'>fa fa-tachometer</option>
		<option value="fa fa-tag"  data-data=\'{"icon": "fa fa-tag"}\'>fa fa-tag</option>
		<option value="fa fa-tags"  data-data=\'{"icon": "fa fa-tags"}\'>fa fa-tags</option>
		<option value="fa fa-tasks"  data-data=\'{"icon": "fa fa-tasks"}\'>fa fa-tasks</option>
		<option value="fa fa-taxi"  data-data=\'{"icon": "fa fa-taxi"}\'>fa fa-taxi</option>
		<option value="fa fa-telegram"  data-data=\'{"icon": "fa fa-telegram"}\'>fa fa-telegram</option>
		<option value="fa fa-television"  data-data=\'{"icon": "fa fa-television"}\'>fa fa-television</option>
		<option value="fa fa-tencent-weibo"  data-data=\'{"icon": "fa fa-tencent-weibo"}\'>fa fa-tencent-weibo</option>
		<option value="fa fa-terminal"  data-data=\'{"icon": "fa fa-terminal"}\'>fa fa-terminal</option>
		<option value="fa fa-text-height"  data-data=\'{"icon": "fa fa-text-height"}\'>fa fa-text-height</option>
		<option value="fa fa-text-width"  data-data=\'{"icon": "fa fa-text-width"}\'>fa fa-text-width</option>
		<option value="fa fa-th"  data-data=\'{"icon": "fa fa-th"}\'>fa fa-th</option>
		<option value="fa fa-th-large"  data-data=\'{"icon": "fa fa-th-large"}\'>fa fa-th-large</option>
		<option value="fa fa-th-list"  data-data=\'{"icon": "fa fa-th-list"}\'>fa fa-th-list</option>
		<option value="fa fa-themeisle"  data-data=\'{"icon": "fa fa-themeisle"}\'>fa fa-themeisle</option>
		<option value="fa fa-thermometer"  data-data=\'{"icon": "fa fa-thermometer"}\'>fa fa-thermometer</option>
		<option value="fa fa-thermometer-0"  data-data=\'{"icon": "fa fa-thermometer-0"}\'>fa fa-thermometer-0</option>
		<option value="fa fa-thermometer-1"  data-data=\'{"icon": "fa fa-thermometer-1"}\'>fa fa-thermometer-1</option>
		<option value="fa fa-thermometer-2"  data-data=\'{"icon": "fa fa-thermometer-2"}\'>fa fa-thermometer-2</option>
		<option value="fa fa-thermometer-3"  data-data=\'{"icon": "fa fa-thermometer-3"}\'>fa fa-thermometer-3</option>
		<option value="fa fa-thermometer-4"  data-data=\'{"icon": "fa fa-thermometer-4"}\'>fa fa-thermometer-4</option>
		<option value="fa fa-thermometer-empty"  data-data=\'{"icon": "fa fa-thermometer-empty"}\'>fa fa-thermometer-empty</option>
		<option value="fa fa-thermometer-full"  data-data=\'{"icon": "fa fa-thermometer-full"}\'>fa fa-thermometer-full</option>
		<option value="fa fa-thermometer-half"  data-data=\'{"icon": "fa fa-thermometer-half"}\'>fa fa-thermometer-half</option>
		<option value="fa fa-thermometer-quarter"  data-data=\'{"icon": "fa fa-thermometer-quarter"}\'>fa fa-thermometer-quarter</option>
		<option value="fa fa-thermometer-three-quarters"  data-data=\'{"icon": "fa fa-thermometer-three-quarters"}\'>fa fa-thermometer-three-quarters</option>
		<option value="fa fa-thumb-tack"  data-data=\'{"icon": "fa fa-thumb-tack"}\'>fa fa-thumb-tack</option>
		<option value="fa fa-thumbs-down"  data-data=\'{"icon": "fa fa-thumbs-down"}\'>fa fa-thumbs-down</option>
		<option value="fa fa-thumbs-o-down"  data-data=\'{"icon": "fa fa-thumbs-o-down"}\'>fa fa-thumbs-o-down</option>
		<option value="fa fa-thumbs-o-up"  data-data=\'{"icon": "fa fa-thumbs-o-up"}\'>fa fa-thumbs-o-up</option>
		<option value="fa fa-thumbs-up"  data-data=\'{"icon": "fa fa-thumbs-up"}\'>fa fa-thumbs-up</option>
		<option value="fa fa-ticket"  data-data=\'{"icon": "fa fa-ticket"}\'>fa fa-ticket</option>
		<option value="fa fa-times"  data-data=\'{"icon": "fa fa-times"}\'>fa fa-times</option>
		<option value="fa fa-times-circle"  data-data=\'{"icon": "fa fa-times-circle"}\'>fa fa-times-circle</option>
		<option value="fa fa-times-circle-o"  data-data=\'{"icon": "fa fa-times-circle-o"}\'>fa fa-times-circle-o</option>
		<option value="fa fa-times-rectangle"  data-data=\'{"icon": "fa fa-times-rectangle"}\'>fa fa-times-rectangle</option>
		<option value="fa fa-times-rectangle-o"  data-data=\'{"icon": "fa fa-times-rectangle-o"}\'>fa fa-times-rectangle-o</option>
		<option value="fa fa-tint"  data-data=\'{"icon": "fa fa-tint"}\'>fa fa-tint</option>
		<option value="fa fa-toggle-down"  data-data=\'{"icon": "fa fa-toggle-down"}\'>fa fa-toggle-down</option>
		<option value="fa fa-toggle-left"  data-data=\'{"icon": "fa fa-toggle-left"}\'>fa fa-toggle-left</option>
		<option value="fa fa-toggle-off"  data-data=\'{"icon": "fa fa-toggle-off"}\'>fa fa-toggle-off</option>
		<option value="fa fa-toggle-on"  data-data=\'{"icon": "fa fa-toggle-on"}\'>fa fa-toggle-on</option>
		<option value="fa fa-toggle-right"  data-data=\'{"icon": "fa fa-toggle-right"}\'>fa fa-toggle-right</option>
		<option value="fa fa-toggle-up"  data-data=\'{"icon": "fa fa-toggle-up"}\'>fa fa-toggle-up</option>
		<option value="fa fa-trademark"  data-data=\'{"icon": "fa fa-trademark"}\'>fa fa-trademark</option>
		<option value="fa fa-train"  data-data=\'{"icon": "fa fa-train"}\'>fa fa-train</option>
		<option value="fa fa-transgender"  data-data=\'{"icon": "fa fa-transgender"}\'>fa fa-transgender</option>
		<option value="fa fa-transgender-alt"  data-data=\'{"icon": "fa fa-transgender-alt"}\'>fa fa-transgender-alt</option>
		<option value="fa fa-trash"  data-data=\'{"icon": "fa fa-trash"}\'>fa fa-trash</option>
		<option value="fa fa-trash-o"  data-data=\'{"icon": "fa fa-trash-o"}\'>fa fa-trash-o</option>
		<option value="fa fa-tree"  data-data=\'{"icon": "fa fa-tree"}\'>fa fa-tree</option>
		<option value="fa fa-trello"  data-data=\'{"icon": "fa fa-trello"}\'>fa fa-trello</option>
		<option value="fa fa-tripadvisor"  data-data=\'{"icon": "fa fa-tripadvisor"}\'>fa fa-tripadvisor</option>
		<option value="fa fa-trophy"  data-data=\'{"icon": "fa fa-trophy"}\'>fa fa-trophy</option>
		<option value="fa fa-truck"  data-data=\'{"icon": "fa fa-truck"}\'>fa fa-truck</option>
		<option value="fa fa-try"  data-data=\'{"icon": "fa fa-try"}\'>fa fa-try</option>
		<option value="fa fa-tty"  data-data=\'{"icon": "fa fa-tty"}\'>fa fa-tty</option>
		<option value="fa fa-tumblr"  data-data=\'{"icon": "fa fa-tumblr"}\'>fa fa-tumblr</option>
		<option value="fa fa-tumblr-square"  data-data=\'{"icon": "fa fa-tumblr-square"}\'>fa fa-tumblr-square</option>
		<option value="fa fa-turkish-lira"  data-data=\'{"icon": "fa fa-turkish-lira"}\'>fa fa-turkish-lira</option>
		<option value="fa fa-tv"  data-data=\'{"icon": "fa fa-tv"}\'>fa fa-tv</option>
		<option value="fa fa-twitch"  data-data=\'{"icon": "fa fa-twitch"}\'>fa fa-twitch</option>
		<option value="fa fa-twitter"  data-data=\'{"icon": "fa fa-twitter"}\'>fa fa-twitter</option>
		<option value="fa fa-twitter-square"  data-data=\'{"icon": "fa fa-twitter-square"}\'>fa fa-twitter-square</option>
		<option value="fa fa-umbrella"  data-data=\'{"icon": "fa fa-umbrella"}\'>fa fa-umbrella</option>
		<option value="fa fa-underline"  data-data=\'{"icon": "fa fa-underline"}\'>fa fa-underline</option>
		<option value="fa fa-undo"  data-data=\'{"icon": "fa fa-undo"}\'>fa fa-undo</option>
		<option value="fa fa-universal-access"  data-data=\'{"icon": "fa fa-universal-access"}\'>fa fa-universal-access</option>
		<option value="fa fa-university"  data-data=\'{"icon": "fa fa-university"}\'>fa fa-university</option>
		<option value="fa fa-unlink"  data-data=\'{"icon": "fa fa-unlink"}\'>fa fa-unlink</option>
		<option value="fa fa-unlock"  data-data=\'{"icon": "fa fa-unlock"}\'>fa fa-unlock</option>
		<option value="fa fa-unlock-alt"  data-data=\'{"icon": "fa fa-unlock-alt"}\'>fa fa-unlock-alt</option>
		<option value="fa fa-unsorted"  data-data=\'{"icon": "fa fa-unsorted"}\'>fa fa-unsorted</option>
		<option value="fa fa-upload"  data-data=\'{"icon": "fa fa-upload"}\'>fa fa-upload</option>
		<option value="fa fa-usb"  data-data=\'{"icon": "fa fa-usb"}\'>fa fa-usb</option>
		<option value="fa fa-usd"  data-data=\'{"icon": "fa fa-usd"}\'>fa fa-usd</option>
		<option value="fa fa-user"  data-data=\'{"icon": "fa fa-user"}\'>fa fa-user</option>
		<option value="fa fa-user-circle"  data-data=\'{"icon": "fa fa-user-circle"}\'>fa fa-user-circle</option>
		<option value="fa fa-user-circle-o"  data-data=\'{"icon": "fa fa-user-circle-o"}\'>fa fa-user-circle-o</option>
		<option value="fa fa-user-md"  data-data=\'{"icon": "fa fa-user-md"}\'>fa fa-user-md</option>
		<option value="fa fa-user-o"  data-data=\'{"icon": "fa fa-user-o"}\'>fa fa-user-o</option>
		<option value="fa fa-user-plus"  data-data=\'{"icon": "fa fa-user-plus"}\'>fa fa-user-plus</option>
		<option value="fa fa-user-secret"  data-data=\'{"icon": "fa fa-user-secret"}\'>fa fa-user-secret</option>
		<option value="fa fa-user-times"  data-data=\'{"icon": "fa fa-user-times"}\'>fa fa-user-times</option>
		<option value="fa fa-users"  data-data=\'{"icon": "fa fa-users"}\'>fa fa-users</option>
		<option value="fa fa-vcard"  data-data=\'{"icon": "fa fa-vcard"}\'>fa fa-vcard</option>
		<option value="fa fa-vcard-o"  data-data=\'{"icon": "fa fa-vcard-o"}\'>fa fa-vcard-o</option>
		<option value="fa fa-venus"  data-data=\'{"icon": "fa fa-venus"}\'>fa fa-venus</option>
		<option value="fa fa-venus-double"  data-data=\'{"icon": "fa fa-venus-double"}\'>fa fa-venus-double</option>
		<option value="fa fa-venus-mars"  data-data=\'{"icon": "fa fa-venus-mars"}\'>fa fa-venus-mars</option>
		<option value="fa fa-viacoin"  data-data=\'{"icon": "fa fa-viacoin"}\'>fa fa-viacoin</option>
		<option value="fa fa-viadeo"  data-data=\'{"icon": "fa fa-viadeo"}\'>fa fa-viadeo</option>
		<option value="fa fa-viadeo-square"  data-data=\'{"icon": "fa fa-viadeo-square"}\'>fa fa-viadeo-square</option>
		<option value="fa fa-video-camera"  data-data=\'{"icon": "fa fa-video-camera"}\'>fa fa-video-camera</option>
		<option value="fa fa-vimeo"  data-data=\'{"icon": "fa fa-vimeo"}\'>fa fa-vimeo</option>
		<option value="fa fa-vimeo-square"  data-data=\'{"icon": "fa fa-vimeo-square"}\'>fa fa-vimeo-square</option>
		<option value="fa fa-vine"  data-data=\'{"icon": "fa fa-vine"}\'>fa fa-vine</option>
		<option value="fa fa-vk"  data-data=\'{"icon": "fa fa-vk"}\'>fa fa-vk</option>
		<option value="fa fa-volume-control-phone"  data-data=\'{"icon": "fa fa-volume-control-phone"}\'>fa fa-volume-control-phone</option>
		<option value="fa fa-volume-down"  data-data=\'{"icon": "fa fa-volume-down"}\'>fa fa-volume-down</option>
		<option value="fa fa-volume-off"  data-data=\'{"icon": "fa fa-volume-off"}\'>fa fa-volume-off</option>
		<option value="fa fa-volume-up"  data-data=\'{"icon": "fa fa-volume-up"}\'>fa fa-volume-up</option>
		<option value="fa fa-warning"  data-data=\'{"icon": "fa fa-warning"}\'>fa fa-warning</option>
		<option value="fa fa-wechat"  data-data=\'{"icon": "fa fa-wechat"}\'>fa fa-wechat</option>
		<option value="fa fa-weibo"  data-data=\'{"icon": "fa fa-weibo"}\'>fa fa-weibo</option>
		<option value="fa fa-weixin"  data-data=\'{"icon": "fa fa-weixin"}\'>fa fa-weixin</option>
		<option value="fa fa-whatsapp"  data-data=\'{"icon": "fa fa-whatsapp"}\'>fa fa-whatsapp</option>
		<option value="fa fa-wheelchair"  data-data=\'{"icon": "fa fa-wheelchair"}\'>fa fa-wheelchair</option>
		<option value="fa fa-wheelchair-alt"  data-data=\'{"icon": "fa fa-wheelchair-alt"}\'>fa fa-wheelchair-alt</option>
		<option value="fa fa-wifi"  data-data=\'{"icon": "fa fa-wifi"}\'>fa fa-wifi</option>
		<option value="fa fa-wikipedia-w"  data-data=\'{"icon": "fa fa-wikipedia-w"}\'>fa fa-wikipedia-w</option>
		<option value="fa fa-window-close"  data-data=\'{"icon": "fa fa-window-close"}\'>fa fa-window-close</option>
		<option value="fa fa-window-close-o"  data-data=\'{"icon": "fa fa-window-close-o"}\'>fa fa-window-close-o</option>
		<option value="fa fa-window-maximize"  data-data=\'{"icon": "fa fa-window-maximize"}\'>fa fa-window-maximize</option>
		<option value="fa fa-window-minimize"  data-data=\'{"icon": "fa fa-window-minimize"}\'>fa fa-window-minimize</option>
		<option value="fa fa-window-restore"  data-data=\'{"icon": "fa fa-window-restore"}\'>fa fa-window-restore</option>
		<option value="fa fa-windows"  data-data=\'{"icon": "fa fa-windows"}\'>fa fa-windows</option>
		<option value="fa fa-won"  data-data=\'{"icon": "fa fa-won"}\'>fa fa-won</option>
		<option value="fa fa-wordpress"  data-data=\'{"icon": "fa fa-wordpress"}\'>fa fa-wordpress</option>
		<option value="fa fa-wpbeginner"  data-data=\'{"icon": "fa fa-wpbeginner"}\'>fa fa-wpbeginner</option>
		<option value="fa fa-wpexplorer"  data-data=\'{"icon": "fa fa-wpexplorer"}\'>fa fa-wpexplorer</option>
		<option value="fa fa-wpforms"  data-data=\'{"icon": "fa fa-wpforms"}\'>fa fa-wpforms</option>
		<option value="fa fa-wrench"  data-data=\'{"icon": "fa fa-wrench"}\'>fa fa-wrench</option>
		<option value="fa fa-xing"  data-data=\'{"icon": "fa fa-xing"}\'>fa fa-xing</option>
		<option value="fa fa-xing-square"  data-data=\'{"icon": "fa fa-xing-square"}\'>fa fa-xing-square</option>
		<option value="fa fa-y-combinator"  data-data=\'{"icon": "fa fa-y-combinator"}\'>fa fa-y-combinator</option>
		<option value="fa fa-y-combinator-square"  data-data=\'{"icon": "fa fa-y-combinator-square"}\'>fa fa-y-combinator-square</option>
		<option value="fa fa-yahoo"  data-data=\'{"icon": "fa fa-yahoo"}\'>fa fa-yahoo</option>
		<option value="fa fa-yc"  data-data=\'{"icon": "fa fa-yc"}\'>fa fa-yc</option>
		<option value="fa fa-yc-square"  data-data=\'{"icon": "fa fa-yc-square"}\'>fa fa-yc-square</option>
		<option value="fa fa-yelp"  data-data=\'{"icon": "fa fa-yelp"}\'>fa fa-yelp</option>
		<option value="fa fa-yen"  data-data=\'{"icon": "fa fa-yen"}\'>fa fa-yen</option>
		<option value="fa fa-yoast"  data-data=\'{"icon": "fa fa-yoast"}\'>fa fa-yoast</option>
		<option value="fa fa-youtube"  data-data=\'{"icon": "fa fa-youtube"}\'>fa fa-youtube</option>
		<option value="fa fa-youtube-play"  data-data=\'{"icon": "fa fa-youtube-play"}\'>fa fa-youtube-play</option>
		<option value="fa fa-youtube-square"  data-data=\'{"icon": "fa fa-youtube-square"}\'>fa fa-youtube-square</option>
		<option value="fa fa-youtube-square"  data-data=\'{"icon": "fa fa-youtube-square"}\'>fa fa-youtube-square</option>
	 </select>';
	return $a;
}

function create_cmb_database_mto($data){
	$ci = get_instance();
	
	$id 	= $data['id'];
	$pk 	= $data['primary_key'];
	$name 	= $data['name'];
	$class 	= $data['class']; 
	$table 	= $data['table']; 
	$selected = $data['selected'];
	$field_show = $data['field_show'];
	
	
	$afield = array();
	$afield[] = $table . "." . $pk . " as " . $pk ;
	$afield[] = $table . "." .  $field_show . " as " .  $field_show ;
	
	foreach($data['field_link'] as $key => $val){
		$afield[] = $table  . "." .  $key . " as " . $table  . "_" .  $key;
		$afield[] = $val['table']  . "." .  $val['field_show'] . " as " . $val['table']  . "_" .  $val['field_show'];
	}
	
	$ci->db->select($afield);
	
	foreach($data['field_link'] as $key => $val){
		$t1 = $table.'.'.$key;
		$t2 = $val['table'].'.id';
		$ci->db->join($val['table'],$t2.'='.$t1,'left');
	}
	
	$cmb = "<select  id='$id' name='$name' class='form-control $class' >";
	
	$row =  $ci->db->get("$table")->result();
	
	
	$data_link='';
	$cmb .="<option value=null>--Pilih Data--</option>";

    foreach ($row as $key => $val){
		$dt='';
		foreach($data['field_link'] as $key_i => $val_i){
			$fs =$val_i['table']."_". $val_i['field_show'];
			
			$flink = $table.'_'.$key_i; 
			
			$dt .= 'data-link-'.$key_i .'="'. $val->$flink . '"  data-show-' .  $val_i['field_show'] .'="'.$val->$fs . '" ';
		}	
		
		
        $cmb .="<option $dt value='".$val->$pk."'";
		
        $cmb .= $selected==$val->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($val->$field_show)."</option>";
    }
	
    $cmb .="</select>";
    return $cmb;
}




function create_cmb_database($data){
    $ci = get_instance();
	
	$id 			= $data['id'];
	$pk 			= $data['primary_key'];
	$name 			= $data['name'];
	$class 			= $data['class']; 
	$table 			= $data['table']; 
	$field_link 	= $data['field_link'];
	$selected 		= $data['selected'];
	$field_show 	= $data['field_show'];
	
    $cmb = "<select  id='$id' name='$name' class='form-control $class' >";
    $row = $ci->db->get("$table")->result();
	$data_link='';
	
	$afs =explode(",",$field_show);
	
	$cmb .="<option value=null>--Pilih Data--</option>";
    foreach ($row as $d){
		if($field_link !==''){
			$data_link = $d->$field_link;
		}
		
        $cmb .="<option data-link='$data_link' value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected' >":'>';
		
		foreach($afs as $v){
			 $cmb .= strtoupper($d->$v) . " - ";
		}
		
		$ec  = substr($cmb,-3);
		if($ec==" - "){
			$cmb = substr($cmb,0,-3);	
		}
		
		$cmb .="</option>";
    }
	
    $cmb .="</select>";
    return $cmb;  
}

function create_cmb_database_bigdata($data){
    $ci = get_instance();
	
	$id 	= $data['id'];
	$name 	= $data['name'];
	$pk 	= $data['primary_key'];
	$class 	= $data['class']; 
	$table 	= $data['table']; 
	$field_link = $data['field_link'];
	$selected = $data['selected'];
	$field_show = $data['field_show'];
	
	
	
    $cmb = "<select  id='$id' name='$name' class='form-control $class' 
					 data-table='$table' 
					 data-primary = '$pk'
					 data-flink='$field_link' 
					 data-select='$selected' 
					 data-fshow='$field_show'>";
	
	$cmb .="<option value=null>--Pilih Data--</option>";
    $cmb .="</select>";
    return $cmb;  
}

