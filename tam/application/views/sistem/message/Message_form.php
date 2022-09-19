<div class="col-md-3 col-xl-3" > 
<div class="list-group list-group-transparent mb-0">

					<h3 class="page-title mb-5">Pesan</h3>
					 <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-send"></i></span>Kirim Pesan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">
                      <span class="icon mr-3"><i class="fe fe-inbox"></i></span>Kotak Masuk <span class="ml-auto badge badge-primary">14</span>
                    </a>
                   
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-file"></i></span>Drafts
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                      <span class="icon mr-3"><i class="fe fe-trash-2"></i></span>Dibuang
                    </a>
</div>
</div>

<div class="col-md-9 col-xl-9" > 
	<?php echo card_open('Kotak Masuk','bg-green',true)?> 
			
                     <a href="#" class="d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(<?php echo site_url('demo/faces/male/41.jpg')?>)"></span>
                      <div>
                        <strong>Alice</strong> started new task: Tabler UI design.
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
					<br	>
                    <a href="#" class="d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(<?php echo site_url('demo/faces/female/1.jpg')?>)"></span>
                      <div>
                        <strong>Alice</strong> started new task: Tabler UI design.
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
					<br	>
					<a href="#" class="d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(<?php echo site_url('demo/faces/female/1.jpg')?>)"></span>
                      <div>
                        <strong>Alice</strong> deployed new version of NodeJS REST Api V3
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
					
                    <br	>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
            
	<?php echo card_close()?> 
</div>