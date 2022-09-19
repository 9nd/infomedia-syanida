<div class="col-xl-12">
<div class="panel panel-lte">
<div class="panel-heading lte-heading-success"><i class="fas fa-desktop"></i> &nbsp; Tampilan</div>
<div class="panel-body">

		<a href='<?php echo $link_menu_management?>' class="btn-lte3 btn-app text-black">
			<i class="fas fa-archive"></i> Menu management
		</a>
		
		<a href='<?php echo $link_pengaturan_template?>' class="btn-lte3 btn-app text-black">
			<i class="fas fa-desktop"></i> Pengaturan template
		</a>
		
		
		
</div>
</div>
</div>


<div class="col-xl-12">
<div class="panel panel-lte">
<div class="panel-heading lte-heading-primary"><i class="fas fa-users"></i> &nbsp;Pengguna</div>
<div class="panel-body">
		<a href="<?php echo $link_registrasi_form?>" class="btn-lte3 btn-app text-black">
			
			<i class="fas fa-tag"></i> Registrasi url
		</a>
		
		<a  href="<?php echo $link_level_konfigurasi;?>" class="btn-lte3 btn-app text-black">
			<span class="badge bg-purple"><?php echo number_format($total_level)?> Levels</span>
			<i class="fas fa-bar-chart"></i> Level konfigurasi
		</a>
		
		<a href="<?php echo $link_user_konfigurasi;?>" class="btn-lte3 btn-app text-black">
			<span class="badge bg-danger"><?php echo number_format($total_users)?> Users</span>
			<i class="fas fa-users"></i> User konfigurasi
		</a>
		
		<a href="<?php echo $link_crud_generator?>" class="btn-lte3 btn-app text-black">
			<i class="fas fa-american-sign-language-interpreting"></i> CRUD generator
		</a>
		
		
</div>
</div>
</div>



<div class="col-xl-12">
<div class="panel panel-lte">
<div class="panel-heading lte-heading-danger"><i class="fa fa-diamond"></i> &nbsp;Keamanan</div>
<div class="panel-body">
		<a href="<?php echo $link_error_report?>" class="btn-lte3 btn-app text-black">
			
			<i class="fa fa-google-wallet"></i> Error report
		</a>
		
		<a href="<?php echo $link_csrf_protection?>" class="btn-lte3 btn-app text-black">
			<i class="fas fa-key"></i> CSRF Protection
		</a>
		
		<a href="<?php echo $link_access_front_end?>"  class="btn-lte3 btn-app text-black">
			<i class="fas fa-home"></i> Access Front End
		</a>
		
		<a href="<?php echo $link_login_activity?>"  class="btn-lte3 btn-app text-black">
			<span class="badge bg-danger"><?php echo number_format($total_aktifitas)?> Aktifity</span>
			<i class="fas fa-user-secret"></i> Login Activity
		</a>
		
		
		
</div>
</div>
</div>

<div class="col-xl-12">
<div class="panel panel-lte">
<div class="panel-heading lte-heading-important"><i class="fas fa-ambulance"></i> &nbsp;Maintenance</div>
<div class="panel-body">
		<a  href="<?php echo $link_maintenance_setting?>" class="btn-lte3 btn-app text-black">
			
			<i class="fas fa-cogs"></i> Run Page Maintenance
		</a>
		
		
		
		
		
</div>
</div>
</div>

<!--

<?php echo card_open('Tampilan','bg-teal',true)?>
<div class='row'>
				<div class="col-sm-12 col-lg-3">
                <a href='<?php echo $link_menu_management?>' class="card p-3 btn btn-success btn-card" >
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-list"></i>
                    </span>
                    <div class='text-left'>
                      <p class="m-0 text-green">Menu management</p>
                      <small class="text-muted">pengaturan menu</small>
                    </div>
                  </div>
                </a>
              </div>
			  
			  <div class="col-sm-12 col-lg-3">
                <a href='<?php echo $link_pengaturan_template?>' class="card p-3 btn btn-info btn-card" >
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-list"></i>
                    </span>
                    <div class='text-left'>
                      <p class="m-0 text-blue">Pengaturan Template</p>
                      <small class="text-muted">template setting</small>
                    </div>
                  </div>
                </a>
              </div>
			  
</div>			  
<?php echo card_close();?>



<?php echo card_open('Pengguna','bg-red',true)?>
<div class='row'>
				<div class="col-sm-12 col-lg-3">
                <a href="<?php echo $link_registrasi_form?>" class="card p-3 btn btn-info btn-card" >
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-orange mr-3">
                      <i class="fe fe-tag"></i>
                    </span>
                    <div class='text-left'>
                      <p class="m-0 text-orange">Registrasi URL / FORM</p>
                      <small class="text-muted">pendaftaran URL / FORM baru</small>
                    </div>
                  </div>
                </a>
              </div>


				<div class="col-sm-12 col-lg-3">
                <a href="<?php echo $link_level_konfigurasi;?>" class="card p-3 btn btn-primary btn-card" >
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-bar-chart"></i>
                    </span>
                    <div class='text-left'>
                      <p class="m-0 text-blue">Level konfigurasi</p>
                      <small class="text-muted">pengaturan level</small>
                    </div>
                  </div>
                </a>
              </div>
			  
			  <div class="col-sm-12 col-lg-3">
                <a href="<?php echo $link_user_konfigurasi;?>" class="card p-3 btn btn-danger btn-card" >
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div class='text-left'>
                      <p class="m-0 text-red">User konfigurasi</p>
                      <small class="text-muted">pengaturan pengguna</small>
                    </div>
                  </div>
                </a>
              </div>
			  
			  
			 <div class="col-sm-12 col-lg-3"> 
				<?php echo button_card("CRUD Generator","form generator","text-blue","btn-info","fa fa-american-sign-language-interpreting","bg-green","btn-crud",$link_crud_generator)?> 
			</div>

			  
</div>			  
<?php echo card_close();?>





<?php echo card_open('Keamanan','bg-blue',true)?>
<div class='row'>
	<div class="col-sm-12 col-lg-6"> 
		<?php echo button_card("Error Report",
							   "Disable/Enable error_reporting","text-red",
							   "btn-info",
							   "fe fe-activity","bg-red",
							   "btn-registrasi",$link_error_report)?> 
	</div>
	<div class="col-sm-12 col-lg-6"> 
		<?php echo button_card("CSRF PROTECTION",
							   "Disable/Enable CSRF","text-red",
							   "btn-info",
							   "fe fe-shield","bg-red",
							   "btn-monitoring",$link_csrf_protection)?> 
	</div>
</div>	

<div class='row'>



	<div class="col-sm-12 col-lg-6"> 
		<?php echo button_card("Access Front End",
							   "halaman depan","text-red",
							   "btn-info",
							   "fe fe-slack","bg-red",
							   "btn-monitoring",$link_access_front_end)?> 
	</div>
</div>


<?php echo card_close();?>



<?php echo card_open('Maintenance','bg-blue',true)?>


<div class='row'>

	<div class="col-sm-12 col-lg-6"> 
		<?php echo button_card("Run Page Maintenance",
							   "redirect all to page maintenance","text-blue",
							   "btn-info",
							   "fe fe-airplay","bg-green",
							   "btn-monitoring",$link_maintenance_setting)?> 
	</div>

	
</div>
	

<?php echo card_close();?>




-->


