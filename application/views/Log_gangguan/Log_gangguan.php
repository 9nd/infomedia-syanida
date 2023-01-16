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
                    <a href="<?php echo base_url() . "Log_gangguan/Log_gangguan/log_gangguan" ?>"><i class="icon-chart mr-1"></i> Log Gangguan</a>
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
            <form method="POST" action="<?php echo base_url('Log_gangguan/Log_gangguan')?>">
                <div class="row">
                    <div class="col-12">
                        <div class="form-row">
                            <div class='col-md-2 col-xl-2'>
                                <div class="form-group">
                                  <label>Start</label>
                                  <input type="date" name="dari" class="form-control" value="<?php echo $this->input->post('dari') ?>" >
                                  <?php echo form_error('dari','<span class="text-small text-danger">','</span>')?>
                               </div>
                            </div>
                            <div class='col-md-2 col-xl-2'>
                                <div class='form-group'><label class='form-label'>End </label>
                                    <input type="date" name="sampai" class="form-control" value="<?php echo $this->input->post('sampai') ?>" >
                                    <?php echo form_error('sampai','<span class="text-small text-danger">','</span>')?>
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                <input type='submit' class='btn btn-primary' value='search'></input>
                                <a class="btn btn-danger" href="<?php echo base_url();?>Log_gangguan/log_gangguan">Reset</a>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <!-- START: Card Data-->
            <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">  
                                <h4 class="card-title">Tabel Log Gangguan</h4><br>
                                <?php echo $this->session->flashdata('pesan') ?> 
                                <a style="float:right; font-size: 12px" class="btn btn-primary" href="<?php echo base_url();?>Log_gangguan/log_gangguan/tambahDataLogGangguan"><i class="icon icon-plus"></i> Tambah Gangguan</a>
                            </div>
                                   
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tbl_log" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>No. Ticket</th>
                                                <th>Nama TL</th>
                                                <th>Jenis Kendala</th>
                                                <th>Detail Kendala</th>
                                                <th>Waktu Kendala</th>
                                                <th>Tanggal Selesai</th>
                                                <th>No. Ticket IOC</th>
                                                <th>Evidence</th>
                                                <th>Status</th>
                                                <th>Waktu Penyelesaian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              $pengerjaan_bulan = 0;
                                              $pengerjaan_hari = 0;
                                              $pengerjaan_jam = 0;
                                              $pengerjaan_menit = 0;
                                              $pengerjaan_detik = 0;

                                            ?>
                                            <?php $i = 1;$no=1; foreach($laporan as $lg) : ?>

                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $lg->no_ticket?></td>
                                                <td><?php echo $lg->nama_tl?></td>
                                                <td>
                                                <?php
                                                if ($lg->kategori_gangguan == "17"){
                                                  ?>
                                                  <span for="" class="badge bg-info" style="color: #ffffff;">Tidak bisa buka Ipayment dan Siskatool</span>
                                                  <?php
                                              }
                                                if ($lg->kategori_gangguan == "16"){
                                                  ?>
                                                  <span for="" class="badge bg-info" style="color: #ffffff;">wifi tidak terdetek di pc atau tidak bisa konek</span>
                                                  <?php
                                              }
                                            if ($lg->kategori_gangguan == "15"){
                                                  ?>
                                                  <span for="" class="badge bg-warning" style="color: #ffffff;">EYEBEAM EXTENSION 61 BUSSY</span>
                                                  <?php
                                              }
                                              if ($lg->kategori_gangguan == "14"){
                                                  ?>
                                                  <span for="" class="badge bg-success" style="color: #ffffff;">SY-Anida Loading</span>
                                                  <?php
                                              }
                                              if($lg->kategori_gangguan == "13"){
                                                  ?>
                                                  <span for="" class="badge bg-danger" style="color: #ffffff;">Calling</span>
                                                  <?php
                                              }       
                                            if ($lg->kategori_gangguan == "12"){
                                                  ?>
                                                  <span for="" class="badge bg-info" style="color: #ffffff;">MYCX GAK BISA LOGIN</span>
                                                  <?php
                                              }
                                             if ($lg->kategori_gangguan == "11"){
                                                  ?>
                                                  <span for="" class="badge bg-warning" style="color: #ffffff;">VPN CONNECTING</span>
                                                  <?php
                                              }
                                              if ($lg->kategori_gangguan == "10"){
                                                  ?>
                                                  <span for="" class="badge bg-success" style="color: #ffffff;">KEYBOARD NOT WORK</span>
                                                  <?php
                                              }
                                              if($lg->kategori_gangguan == "9"){
                                                  ?>
                                                  <span for="" class="badge bg-danger" style="color: #ffffff;">UPDATE WINDOWS</span>
                                                  <?php
                                              }
                                              if ($lg->kategori_gangguan == "8"){
                                                  ?>
                                                  <span for="" class="badge bg-info" style="color: #ffffff;">EYEBEAM FEEZ</span>
                                                  <?php
                                              }
                                              if ($lg->kategori_gangguan == "7"){
                                                  ?>
                                                  <span for="" class="badge bg-warning" style="color: #ffffff;">GAK STABIL</span>
                                                  <?php
                                              }
                                              if ($lg->kategori_gangguan == "6"){
                                                  ?>
                                                  <span for="" class="badge bg-success" style="color: #ffffff;">SUARA EARPHONE GAK KELUAR</span>
                                                  <?php
                                              }
                                              if($lg->kategori_gangguan == "5"){
                                                  ?>
                                                  <span for="" class="badge bg-danger" style="color: #ffffff;">SUBMIT SY-ANIDA LOADING</span>
                                                  <?php
                                              }
                                             if ($lg->kategori_gangguan == "4"){
                                                  ?>
                                                  <span for="" class="badge bg-info" style="color: #ffffff;">NO INET</span>
                                                  <?php
                                              }
                                             if ($lg->kategori_gangguan == "3"){
                                                  ?>
                                                  <span for="" class="badge bg-warning" style="color: #ffffff;">MYCX LOADING DENGAN VPN TERSAMBUNG</span>
                                                  <?php
                                              }
                                              if ($lg->kategori_gangguan == "2"){
                                                  ?>
                                                  <span for="" class="badge bg-success" style="color: #ffffff;">INTERMITTEN EYEBEAM RTO</span>
                                                  <?php
                                              }
                                              if($lg->kategori_gangguan == "1"){
                                                  ?>
                                                  <span for="" class="badge bg-danger" style="color: #ffffff;">VPN LOSS - RECONNECT NEED</span>
                                                  <?php
                                              }
                                              ?>
                                                </td>
                                                <td><?php echo character_limiter($lg->detail_kendala, 20)?></td>
                                                <td><?php echo $lg->tanggal?></td>
                                                <td><?php echo $lg->tanggal_selesai?></td>
                                                <td><?php echo $lg->no_ticket_ioc?></td>
                                                <td><img width = "70px" src="<?php echo base_url().'assets/uploads/log_problemwfh/' .$lg->evidence ?>"></td>
                                                <td>
                                        <?php 
                                            if ($lg->status == "3"){
                                                  ?>
                                                   <span class="badge p-2 badge-success mb-1">Open</span>
                                                  <?php
                                              }
                                              if ($lg->status == "2"){
                                                  ?>
                                                   <span class="badge p-2 badge-warning mb-1">On Progress</span><br/>
                                                  <?php
                                              }
                                              if($lg->status == "1"){
                                                  ?>
                                                   <span class="badge p-2 badge-primary mb-1">Done</span>
                                                  <?php
                                              }
                                              ?>
                                                   <br/>
                                                   
                                                   <br/>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($lg->tanggal != "" && $lg->tanggal_selesai == "") {
                                                            echo "-";
                                                        }elseif($lg->status == "2" ){
                                                            echo "-";
                                                        }else{
                                                            $date1=date_create($lg->tanggal);
                                                            $date2=date_create($lg->tanggal_selesai);
                                                            $diff=date_diff($date1,$date2);
                                                            echo $diff->format("%R%m Bulan, %R%d Hari,%R%h Jam, %R%i Menit, %R%s Detik ");
                                                            $bulan = $diff->format("%m");
                                                            $hari = $diff->format("%d");
                                                            $jam = $diff->format("%h");
                                                            $menit = $diff->format("%i");
                                                            $detik = $diff->format("%s");   
                                                        }
                                                        $pengerjaan_bulan = $pengerjaan_bulan + $bulan;
                                                        $pengerjaan_hari = $pengerjaan_hari + $hari;
                                                        $pengerjaan_jam = $pengerjaan_jam + $jam;
                                                        $pengerjaan_menit = $pengerjaan_menit + $menit;
                                                        $pengerjaan_detik = $pengerjaan_detik + $detik;

                                                    ?>
                                                </td>
                                                <td style="width:150px;">
                                          <?php 
                                            if ($lg->status == "1"){
                                                  ?>
                                                   <a class="btn btn-sm btn-success"data-toggle="modal" data-target="#exampleModal<?php echo $i?>"><i class="icon icon-eye"></i></a>   
                                                  <?php
                                              }
                                              if ($lg->status == "2"){
                                                  ?>
                                                   <a class="btn btn-sm btn-primary" href="<?php echo base_url('Log_gangguan/log_gangguan/updateDataLogGangguan/'.$lg->id) ?>"><i class="icon icon-pencil"></i></a>
                                                        <a onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger" href="<?php echo base_url('Log_gangguan/log_gangguan/deleteDataLogGangguan/'.$lg->id)?>"><i class="icon icon-trash"></i></a>
                                                  <?php
                                              }
                                               if ($lg->status == "3"){
                                                  ?>
                                                   <a class="btn btn-sm btn-primary" href="<?php echo base_url('Log_gangguan/log_gangguan/updateDataLogGangguan/'.$lg->id) ?>"><i class="icon icon-pencil"></i></a>
                                                        <a onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger" href="<?php echo base_url('Log_gangguan/log_gangguan/deleteDataLogGangguan/'.$lg->id)?>"><i class="icon icon-trash"></i></a>
                                                  
                                                  <?php
                                              }
                                              ?>   
                                                </td> 
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <h4>Total Waktu Penyelesaian : </h4>
                                    <label><?php echo $pengerjaan_bulan ."-". "BULAN"; ?></label>
                                    <label><?php echo $pengerjaan_hari ."-". "HARI"; ?></label>
                                    <label><?php echo $pengerjaan_jam ."-". "JAM"; ?></label>
                                    <label><?php echo $pengerjaan_menit ."-". "MENIT"; ?></label>
                                    <label><?php echo $pengerjaan_detik ."-". "DETIK"; ?></label>
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
    foreach ($laporan as $lg) :
    ?>

<!-- Modal -->

<div class="modal fade" id="exampleModal<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a class="modal-title" style="font-weight:bold;" id="exampleModalLabel<?php echo $i?>">Detail Data Log Gangguan</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="nama_tl" class="col-form-label">Nama TL :</label>
            <input type="text" readonly value="<?php echo $lg->nama_tl?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="agentid" class="col-form-label">Agent ID:</label>
            <input type="text" readonly value="<?php echo $lg->agentid?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="kategori_gangguan" class="col-form-label">Jenis Kendala :</label>
            <select name="kategori_gangguan" disabled class="form-control">
            <option selected disabled value="">--Pilih--</option>
            <option value="1" <?php if($lg->kategori_gangguan=='1'){echo 'selected';}?>>VPN LOSS - RECONNECT NEED</option>
            <option value="2" <?php if($lg->kategori_gangguan=='2'){echo 'selected';}?>>INTERMITTEN EYEBEAM RTO</option>
            <option value="3" <?php if($lg->kategori_gangguan=='3'){echo 'selected';}?>>MYCX LOADING DENGAN VPN TERSAMBUNG</option>
            <option value="4" <?php if($lg->kategori_gangguan=='4'){echo 'selected';}?>>NO INET</option>
            <option value="5" <?php if($lg->kategori_gangguan=='5'){echo 'selected';}?>>SUBMIT SY-ANIDA LOADING</option>
            <option value="6" <?php if($lg->kategori_gangguan=='6'){echo 'selected';}?>>SUARA EARPHONE GAK KELUAR</option>
            <option value="7" <?php if($lg->kategori_gangguan=='7'){echo 'selected';}?>>GAK STABIL</option>
            <option value="8" <?php if($lg->kategori_gangguan=='8'){echo 'selected';}?>>EYEBEAM FEEZ</option>
            <option value="9" <?php if($lg->kategori_gangguan=='9'){echo 'selected';}?>>UPDATE WINDOWS</option>
            <option value="10" <?php if($lg->kategori_gangguan=='10'){echo 'selected';}?>>KEYBOARD NOT WORK</option>
            <option value="11" <?php if($lg->kategori_gangguan=='11'){echo 'selected';}?>>VPN CONNECTING</option>
            <option value="12" <?php if($lg->kategori_gangguan=='12'){echo 'selected';}?>>MYCX GAK BISA LOGIN</option>
            <option value="13" <?php if($lg->kategori_gangguan=='13'){echo 'selected';}?>>CALLING</option>
            <option value="14" <?php if($lg->kategori_gangguan=='14'){echo 'selected';}?>>SY-ANIDA LOADING</option>
            <option value="15" <?php if($lg->kategori_gangguan=='15'){echo 'selected';}?>>EYEBEAM EXTENSION 61 BUSSY</option>
            <option value="16" <?php if($lg->kategori_gangguan=='16'){echo 'selected';}?>>WIFI TIDAK TEDETEK DI PC ATAU TIDAK BISA KONEK</option>
            <option value="17" <?php if($lg->kategori_gangguan=='17'){echo 'selected';}?>>TIDAK BISA BUKA IPAYMENT DAN SISKATOOL </option>
        </select>
          </div>
          <div class="form-group">
            <label for="detail_kendala" class="col-form-label">Detail Kendala :</label>
            <textarea readonly rows="20" cols="100" class="form-control" value="<?php echo $lg->detail_kendala?>"><?php echo $lg->detail_kendala?> </textarea>
          </div>
          <div class="form-group">
            <label for="tanggal" class="col-form-label">Waktu Kendala :</label>
            <input readonly type="datetime-local" value="<?php echo $lg->tanggal?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="tanggal" class="col-form-label">Tanggal Selesai :</label>
            <input readonly type="datetime-local" value="<?php echo $lg->tanggal_selesai?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="no_ticket_ioc" class="col-form-label">No Ticket IOC :</label>
            <input readonly type="text" value="<?php echo $lg->no_ticket_ioc?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="no_ticket" class="col-form-label">No Ticket :</label>
            <input readonly type="text" value="<?php echo $lg->no_ticket?>" class="form-control">
          </div>
          <div class="form-group">
              <img src="<?php echo base_url().'assets/uploads/log_problemwfh/'.$lg->evidence ?>" style="width: 100%;height: auto;"><hr>
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status :</label>
                <select class="form-control" disabled id="status" name="status" value="">
                    <option value="">-- Pilih --</option>
                    <option value="3" <?php if($lg->status=='3'){echo 'selected';}?>>Open</option>
                    <option value="2" <?php if($lg->status=='2'){echo 'selected';}?>>On Progress</option>
                    <option value="1" <?php if($lg->status=='1'){echo 'selected';}?>>Done</option>
                </select>
          </div>
          <div class="form-group">
            <label for="solusi" class="col-form-label">Solusi :</label>
            <textarea readonly rows="20" cols="100" class="form-control" value="<?php echo $lg->solusi?>"><?php echo $lg->solusi ?> </textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $i++; endforeach; ?>
    