<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">

            </nav>
        </div>
    </div>
    <!-- END: Header-->
    <!-- START: Main Menu-->
    <div class="sidebar">
        <div class="site-width">

            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Omnix/Omnix/omnix" ?>"><i class="icon-chart mr-1"></i> Omnix Multichannel Profiling</a>
                </li>
            </ul>

        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                        </div>
                    </div>
                </div>
            </div>

            <!-- END: Breadcrumbs-->
            <form method="POST" action="<?php echo base_url('Omnix/Omnix')?>">
                <div class="row">
                    <div class="col-12">
                        <div class="form-row">
                            <div class='col-md-2 col-xl-2'>
                                <div class="form-group">
                                  <label>Start</label>
                                  <input type="date" name="dari" class="form-control" value="<?php 
                                  if($this->input->post('dari') != ''){
                                    echo $this->input->post('dari');
                                  }else{
                                     echo date("Y-m-d");
                                  }
                                  ?>">
                               </div>
                            </div>
                            <div class='col-md-2 col-xl-2'>
                                <div class='form-group'><label class='form-label'>End </label>
                                    <input type="date" name="sampai" class="form-control" value="<?php 
                                  if($this->input->post('end') != ''){
                                    echo $this->input->post('end');
                                  }else{
                                     echo date("Y-m-d");
                                  }
                                  ?>" >
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                <button name="tombol" type="submit" class='btn btn-primary' value="search">search</button>
                                <!-- <input type='submit'  name='tombol' class='btn btn-primary' value='search'></input> -->
                                <a class="btn btn-danger" href="<?php echo base_url();?>Omnix/Omnix">Reset</a>
                            </div>

                        </div>
                    </div>
                </div>
            <!-- </form> -->
            <!-- START: Card Data-->
            <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">  
                                <h4 class="card-title">Omnix Multichannel Profiling
                                
                                <a style="float:right; font-size: 12px" class="btn btn-primary" href="<?php echo base_url();?>Omnix/Omnix/tambahDataOmnix"><i class="icon icon-plus"></i> Tambah Data</a></h4><br>
                                <?php echo $this->session->flashdata('notif');?>
                                <?php echo $this->session->flashdata('sukses');?>
                                <?php if ($optlevel != 8): ?>
                                <button name="tombol" type="submit" style="float:left; font-size: 12px" class="btn btn-success" value="export"><i class="fa fa-upload"></i>EXPORT EXCEL (ALL)</button><br><br>
                                <button name="tombol" type="submit" style="float:left; font-size: 12px" class="btn btn-success" value="export_done"><i class="fa fa-upload"></i>EXPORT EXCEL (DONE)</button>
				<?php endif ?>
                                
                                <!-- <a style="float:left; font-size: 12px" class="btn btn-success" href="<?php echo base_url();?>Omnix/Omnix/export"><i class="icon icon-file-export"></i> Export Excel</a></h4><br> -->
                            </div>
                        </form>
                                   
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tbl_omnix" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Tanggal Pengerjaan</th>
                                                <th class="text-center">Tanggal Call INDRI</th>
                                                <th class="text-center">No. Internet</th>
                                                <th class="text-center">HP 1</th>
                                                <th class="text-center">HP 2</th>
                                                <th class="text-center">HP 3</th>
                                                <th class="text-center">Email 1</th>
                                                <th class="text-center">Email 2</th>
                                                <th class="text-center">Email 3</th>
                                                <th class="text-center">Reason Omnix</th>
                                                <th class="text-center">Channel Available</th>
                                                <th class="text-center">Whatsapp Kirim</th>
                                                <th class="text-center">Status Whatsapp</th>
                                                <th class="text-center">Email Kirim</th>
                                                <th class="text-center">Status Email</th>
                                                <th class="text-center">Instagram</th>
                                                <th class="text-center">Status Instagram</th>
                                                <th class="text-center">Facebook</th>
                                                <th class="text-center">Status Facebook</th>
                                                <th class="text-center">Twitter</th>
                                                <th class="text-center">Status Twitter</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Agent</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;$no=1; foreach($omnix_report as $or) : ?>

                                            <tr>
                                                <td class="text-center"><?php echo $no++ ?></td>
                                                <td><?php echo $or->tanggal_pengerjaan?></td>
                                                <td><?php echo $or->tanggal_call_indri?></td>
                                                <td><?php echo $or->no_internet?></td>
                                                <td><?php echo $or->hp_1?></td>
                                                <td><?php echo $or->hp_2?></td>
                                                <td><?php echo $or->hp_3?></td>
                                                <td><?php echo $or->email_1?></td>
                                                <td><?php echo $or->email_2?></td>
                                                <td><?php echo $or->email_3?></td>
                                                <td><?php
                                                      if ($or->reason_omnix == "1") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;">Ada di Omnix</span>
                                                   <?php
                                                      }
                                                      if ($or->reason_omnix == "0") {
                                                    ?>
                                                    <span for="" class="badge bg-danger" style="color: #ffffff;">Tidak Ada di Omnix</span>
                                                    <?php
                                                      }
                                                      if ($or->reason_omnix == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?>
                                                </td>
                                                <td><?php
                                                      if ($or->channel_available == "5") {
                                                      ?>
                                                     <span for="" class="badge bg-info" style="color: #ffffff;">Telegram</span>
                                                   <?php
                                                      }
                                                      if ($or->channel_available == "4") {
                                                    ?>
                                                    <span for="" class="badge bg-info" style="color: #ffffff;">Whatsapp</span>
                                                    <?php
                                                      }
                                                      if ($or->channel_available == "3") {
                                                    ?>
                                                    <span for="" class="badge bg-info" style="color: #ffffff;">Instagram</span>
                                                    <?php
                                                      }
                                                      if ($or->channel_available == "2") {
                                                    ?>
                                                    <span for="" class="badge bg-info" style="color: #ffffff;">Facebook</span>
                                                    <?php
                                                      }
                                                      if ($or->channel_available == "1") {
                                                    ?>
                                                    <span for="" class="badge bg-info" style="color: #ffffff;">Twitter</span>
                                                    <?php
                                                      }
                                                      if ($or->channel_available == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php echo $or->wa_kirim?></td>
                                                <td><?php
                                                      if ($or->status_wa == "1") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;">WhatsApp Succesfully Sent</span>
                                                   <?php
                                                      }
                                                      if ($or->status_wa == "0") {
                                                    ?>
                                                    <span for="" class="badge bg-danger" style="color: #ffffff;">WhatsApp Failed Sent</span>
                                                    <?php
                                                      }
                                                      if ($or->status_wa == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php
                                                      if ($or->email_kirim != "") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;"><?php echo $or->email_kirim?></span>
                                                    <?php
                                                      }
                                                      if ($or->email_kirim == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php
                                                      if ($or->status_email == "1") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;">Email Succesfully Sent</span>
                                                   <?php
                                                      }
                                                      if ($or->status_email == "0") {
                                                    ?>
                                                    <span for="" class="badge bg-danger" style="color: #ffffff;">Email Failed Sent</span>
                                                    <?php
                                                      }
                                                      if ($or->status_email == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php echo $or->instagram?></td>
                                                <td><?php
                                                      if ($or->status_ig == "1") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;">Instagram Succesfully Sent</span>
                                                   <?php
                                                      }
                                                      if ($or->status_ig == "0") {
                                                    ?>
                                                    <span for="" class="badge bg-danger" style="color: #ffffff;">Instagram Failed Sent</span>
                                                    <?php
                                                      }
                                                      if ($or->status_ig == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php echo $or->facebook?></td>
                                                <td><?php
                                                      if ($or->status_fb == "1") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;">Facebook Succesfully Sent</span>
                                                   <?php
                                                      }
                                                      if ($or->status_fb == "0") {
                                                    ?>
                                                    <span for="" class="badge bg-danger" style="color: #ffffff;">Facebook Failed Sent</span>
                                                    <?php
                                                      }
                                                      if ($or->status_fb == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php echo $or->twitter?></td>
                                                <td><?php
                                                      if ($or->status_tw == "1") {
                                                      ?>
                                                     <span for="" class="badge bg-success" style="color: #ffffff;">Twitter Succesfully Sent</span>
                                                   <?php
                                                      }
                                                      if ($or->status_tw == "0") {
                                                    ?>
                                                    <span for="" class="badge bg-danger" style="color: #ffffff;">Twitter Failed Sent</span>
                                                    <?php
                                                      }
                                                      if ($or->status_tw == "") {
                                                        echo "-";
                                                    ?>
                                                    <?php
                                                      }
                                                    ?></td>
                                                <td><?php echo $or->keterangan?></td>
                                                <td><?php echo $or->agentid?></td>
                                                <td><?php 
                                                      if ($or->status == "1"){
                                                          ?>
                                                           <span class="badge p-2 badge-warning mb-1">On Progress</span><br/>
                                                          <?php
                                                      }
                                                      if($or->status == "2"){
                                                          ?>
                                                           <span class="badge p-2 badge-primary mb-1">Done</span>
                                                          <?php
                                                      }
                                                      ?>
                                                  </td>
                                                <td>
                                                    <?php 
                                              if ($or->status == "1"){
                                                  ?>
                                                   <a class="btn btn-sm btn-primary" href="<?php echo base_url('Omnix/omnix/updateDataOmnix/'.$or->id) ?>"><i class="icon icon-pencil"></i></a>
                                                  <?php
                                              }
                                               if ($or->status == "2"){
                                                  ?>
                                                   <a class="btn btn-sm btn-success"data-toggle="modal" data-target="#exampleModal<?php echo $i?>"><i class="icon icon-eye"></i></a> 
                                                  
                                                  <?php
                                              }
                                              ?>
                                                    
                                                </td>
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>                  
                </div>
                <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->

    <?php
    $i = 1;
    foreach ($omnix_report as $or) :
    ?>

<!-- Modal -->

<div class="modal fade" id="exampleModal<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a class="modal-title" style="font-weight:bold;" id="exampleModalLabel<?php echo $i?>">Detail Data Omnix</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
                <div class="form-group">
                    <label>Tanggal Pengerjaan : </label>
                    <input type="date" disabled name="tanggal_pengerjaan" value="<?php echo $or->tanggal_pengerjaan?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tanggal Call INDRI : </label>
                    <input type="datetime-local" step=".1" disabled name="tanggal_call_indri" value="<?php echo $or->tanggal_call_indri?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>No. Internet : </label>
                    <input type="text" readonly name="no_internet" value="<?php echo $or->no_internet?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Handphone 1 : </label>
                    <input type="text" readonly name="hp_1" value="<?php echo $or->hp_1?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Handphone 2 : </label>
                    <input type="text" readonly name="hp_2" value="<?php echo $or->hp_2?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Handphone 3 : </label>
                    <input type="text" readonly name="hp_3" value="<?php echo $or->hp_3?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email 1 : </label>
                    <input type="text" readonly name="email_1" value="<?php echo $or->email_1?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email 2 : </label>
                    <input type="text" readonly name="email_2" value="<?php echo $or->email_2?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email 3 : </label>
                    <input type="text" readonly name="email_3" value="<?php echo $or->email_3?>" class="form-control">
                </div>
                <div class="form-group">
                <label class="col-form-label">Status Email : </label>
                <select class="form-control" disabled name="status_email" value="">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($or->status_email=='1'){echo 'selected';}?>>Email Succesfully Sent</option>
                    <option value="0" <?php if($or->status_email=='0'){echo 'selected';}?>>Email Failed Sent</option>
                </select>                 
             </div>
                  <div class="form-group">
                    <label for="status" class="col-form-label">Reason Omnix :</label>
                        <select class="form-control" disabled name="reason_omnix" value="">
                            <option value="">-- Pilih --</option>
                            <option value="3" <?php if($or->reason_omnix=='1'){echo 'selected';}?>>Ada di Omnix</option>
                            <option value="2" <?php if($or->reason_omnix=='0'){echo 'selected';}?>>Tidak Ada di Omnix</option>
                        </select>
                  </div>
              <div class="form-group">
                <label for="solusi" class="col-form-label">Channel Available :</label>
              </div>
              <div class="form-group">
                <label for="solusi" class="col-form-label">Twitter :</label>
                <input type="text"value="<?php echo $or->twitter?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label">Status Twitter : </label>
                  <select class="form-control" disabled name="status_tw" value="">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($or->status_tw=='1'){echo 'selected';}?>>Twitter Succesfully Sent</option>
                    <option value="0" <?php if($or->status_tw=='0'){echo 'selected';}?>>Twitter Failed Sent</option>
                 </select>
              </div>
              <div class="form-group">
                <label for="solusi" class="col-form-label">Facebook :</label>
                <input type="text"value="<?php echo $or->facebook?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label">Status Facebook : </label>
                  <select class="form-control" disabled name="status_fb" value="">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($or->status_fb=='1'){echo 'selected';}?>>Facebook Succesfully Sent</option>
                    <option value="0" <?php if($or->status_fb=='0'){echo 'selected';}?>>Facebook Failed Sent</option>
                 </select>
              </div>
              <div class="form-group">
                <label for="solusi" class="col-form-label">Instagram :</label>
                <input type="text"value="<?php echo $or->instagram?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label">Status Instagram : </label>
                  <select class="form-control" disabled name="status_ig" value="">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($or->status_ig=='1'){echo 'selected';}?>>Instagram Succesfully Sent</option>
                    <option value="0" <?php if($or->status_ig=='0'){echo 'selected';}?>>Instagram Failed Sent</option>
                 </select>
              </div>
              <div class="form-group">
                <label class="col-form-label">Whatsapp :</label>
                <input type="text"value="<?php echo $or->whatsapp?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label">Status whatsapp : </label>
                  <select class="form-control" disabled name="status_ig" value="">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($or->status_whatsapp=='1'){echo 'selected';}?>>Whatsapp Succesfully Sent</option>
                    <option value="0" <?php if($or->status_whatsapp=='0'){echo 'selected';}?>>Whatsapp Failed Sent</option>
                 </select>
              </div>
              <div class="form-group">
                <label class="col-form-label">Telegram : </label>
                  <textarea type="text" readonly name="keterangan_telegram" class="form-control"><?php echo $or->keterangan_telegram?></textarea>
              </div>
              <div class="form-group">
                <label class="col-form-label">Keterangan : </label>
                  <textarea type="text" readonly name="keterangan_telegram" class="form-control"><?php echo $or->keterangan?></textarea>
              </div>
              <div class="form-group">
                <label>Status : </label>
                <select class="form-control" disabled name="status" value="">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($or->status=='1'){echo 'selected';}?>>On Progress</option>
                    <option value="2" <?php if($or->status=='2'){echo 'selected';}?>>Done</option>
                 </select>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $i++; endforeach; ?>
   
    