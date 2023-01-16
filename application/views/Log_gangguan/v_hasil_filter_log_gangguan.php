<!-- Begin Page Content -->
<br><br><br><br><br>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hasil Filter Log Gangguan</h6>
            </div>
              <div class="card-body"> 
                <form method="POST" action="<?php echo base_url('Log_gangguan/Log_gangguan/filter_log_gangguan')?>">
                  <div class="form-group">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="<?php echo $this->input->post('dari') ?>">
                    <?php echo form_error('dari','<span class="text-small text-danger">','</span>')?>
                  </div>
                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="<?php echo $this->input->post('sampai') ?>">
                    <?php echo form_error('sampai','<span class="text-small text-danger">','</span>')?>
                  </div>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i>Tampilkan Data</button>
                    <a href="<?php echo base_url() . "Log_gangguan/log_gangguan" ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Back to List</a>
                </form><hr>

            <!-- /.card-header -->
              <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama TL</th>
                                                <th>Jenis Kendala</th>
                                                <th>Detail Kendala</th>
                                                <th>Waktu Kendala</th>
                                                <th>No. Ticket</th>
                                                <th>Evidence</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach($laporan as $lg) : ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
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
                                                <td><?php echo $lg->detail_kendala?></td>
                                                <td><?php echo $lg->tanggal?></td>
                                                <td><?php echo $lg->no_ticket?></td>
                                                <td><img width = "70px" src="<?php echo base_url().'assets/uploads/log_problemwfh/' .$lg->evidence ?>"></td>
                                                <td><?php 
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
                                                <td style="width:150px;">
                                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('Log_gangguan/log_gangguan/updateDataLogGangguan/'.$lg->id) ?>"><i class="icon icon-pencil"></i></a>
                                                    <a onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger" href="<?php echo base_url('Log_gangguan/log_gangguan/deleteDataLogGangguan/'.$lg->id)?>"><i class="icon icon-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
              <!-- /.card-body -->
              </div>
           </div>               
        </div>
      </div>