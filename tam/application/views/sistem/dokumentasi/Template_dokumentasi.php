
<div class="col-lg-3">

    <div class="card-header">
    <h3 class="card-title">Petunjuk Penggunaan</h3>
    </div>
	
    <div class="card-body o-auto" style="height: 27rem">
	<ul class="list-unstyled list-separated">	
	<div class="list-group list-group-transparent mb-0">
	
	<a href="<?php echo base_url()?>sistem/Dokumentasi/general" class="list-group-item list-group-item-action <?php if(strtolower($page)=="general"){ echo " active";}?>"><span class="icon mr-3"><i class="fe fe-flag"></i></span>Introduction</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/system_requirtment" class="list-group-item list-group-item-action <?php if(strtolower($page)=="requirtment"){ echo " active";}?>" ><span class="icon mr-3"><i class="fe fe-alert-triangle"></i></span>System Requirtment</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/pengaturan_menu" class="list-group-item list-group-item-action <?php if(strtolower($page)=="pengaturan_menu"){ echo " active";}?>"><span class="icon mr-3"><i class="fe fe-align-center"></i></span>Pengaturan Menu</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-plus-square"></i></span>Buttons</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-feather"></i></span>Colors</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-image"></i></span>Cards</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-pie-chart"></i></span>Charts</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-check-square"></i></span>Form components</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-tag"></i></span>Tags</a>
	<a href="<?php echo base_url()?>sistem/Dokumentasi/" class="list-group-item list-group-item-action"><span class="icon mr-3"><i class="fe fe-type"></i></span>Typography</a>
	
	</div>				
	</ul>				 
	</div>

</div>


<div class="col-lg-9">
<div class="card">
    <div class="card-header">
    <h3 class="card-title"><?php echo $title_dokumentasi?></h3>
    </div>
	
    <div class="card-body o-auto">
					<div class="media">
                      <span class="avatar avatar-xxl mr-5" style="background-image: url(<?php echo base_url()?>demo/faces/male/sayyaf.png)"></span>
                      <div class="media-body">
                        <h4 class="m-0">Dhiya As Sayyaf</h4>
                        <p class="text-muted mb-0">ybs-system</p>
                        <ul class="social-links list-inline mb-0 mt-2">
                          <li class="list-inline-item">
                            <a href="https://id-id.facebook.com/people/Dhiya-As-Sayyaf/100008796433530" title="Facebook" data-toggle="tooltip" target="_blank"><i class="text-blue fa fa-facebook"></i></a>
                          </li>
                          <li class="list-inline-item">
                            <a href="https://wa.me/6281342046414?text=Assalamualaikum..%20" title="whatsapp" data-toggle="tooltip" target="_blank"><i class="text-green fa fa-whatsapp"></i></a>
                          </li>
     
                          <li class="list-inline-item">
                            <a href="https://www.youtube.com/playlist?list=PLa5lI5XCqbP55HISIuBnjAIXgVSwtBAGl" target="_blank" title="ybs-system" data-toggle="tooltip"><i class="text-red fa fa-youtube-play"></i></a>
                          </li>
                        </ul>
                      </div>
                    </div>
					
				<br>
				
				<?php echo $body_dokumentasi?>
				
	</div>

</div>
</div>





				