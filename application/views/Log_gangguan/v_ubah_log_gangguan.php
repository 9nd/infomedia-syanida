        <!-- Begin Page Content -->
         <br><br><br><br><br>
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Log Gangguan</h6>
                        </div>
                <div class="card-body">
                     <?php foreach ($log_gangguan as $lg) : ?>
                        <form method="POST" action="<?php echo base_url('Log_gangguan/log_gangguan/updateDataLogGangguanAksi'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama TL : </label>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $lg->id ?>" >
                                <!-- <input type="text" readonly name="nama_tl" class="form-control" value="<?php echo $userdata->nama ?>">
                                <input hidden type="text" name="show_nama" class="form-control" value="<?php echo $userdata->agentid ?>"> --> 
                                  <input type="text" readonly name="nama_tl" class="form-control" value="<?php echo $lg->nama_tl ?>">
                                  <?php echo form_error('nama_tl','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Agent ID : </label>
                                <!-- <input type="text" name="agentid" class="form-control" value="<?php echo $userdata->agentid ?>">
                                  <input hidden type="text" name="show_agentid" class="form-control" value="<?php echo $userdata->agentid ?>"> --> 
                                <input type="text"  readonly name="agentid" class="form-control" value="<?php echo $lg->agentid ?>">
                                <?php echo form_error('agentid','<div class="text-small text-danger"></div>')?>
                            </div>
                      
                            <div class="form-group">
                                <label>Kategori Gangguan :  </label>
                                <select name="kategori_gangguan" class="form-control">
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
                                <?php echo form_error('kategori_gangguan','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Detail Kendala : </label>
                                <textarea name="detail_kendala" rows="20" cols="100" class="form-control"><?php echo $lg->detail_kendala ?></textarea>
                                <?php echo form_error('detail_kendala','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Waktu Kendala : </label>
                                <input type="datetime-local" name="tanggal" class="form-control" value="<?php echo $lg->tanggal ?>">
                                <?php echo form_error('tanggal','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>No Ticket : </label>
                                <input type="text" readonly name="no_ticket" class="form-control" value="<?php echo $lg->no_ticket ?>">
                                <?php echo form_error('no_ticket','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                               <label>No Ticket IOC : </label>
                               <input type="text" name="no_ticket_ioc" class="form-control" value="<?php echo $lg->no_ticket_ioc ?>">
                               <?php echo form_error('no_ticket_ioc','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Evidence : </label><br>
                                <input type="file" name="evidence" class="form-control-file"><br>
                                <img src="<?php echo base_url().'assets/uploads/log_problemwfh/'.$lg->evidence ?>" width="150" height="200">
                                <p><b><?php echo $lg->evidence ?></b></p>
                               <?php echo form_error('evidence','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Status : </label>
                               <!--  <select class="form-control" id="status" name="status" value="">
                                    <option value="">-- Pilih --</option>
                                    <option value="3" <?php if($lg->status=='3'){echo 'selected';}?>>Open</option>
                                    <option value="2" <?php if($lg->status=='2'){echo 'selected';}?>>On Progress</option>
                                    <option value="1" <?php if($lg->status=='1'){echo 'selected';}?>>Done</option>
                                </select>-->
                                 <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="tidak" value="3" <?php 
                                    echo set_value('Open', $lg->status) == 3 ? "checked" : ""; 
                                ?>>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Open
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="tidak2" value="2" <?php 
                                    echo set_value('On Progress', $lg->status) == 2 ? "checked" : ""; 
                                ?>>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    On Progress
                                  </label>
                                </div>
                                 <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="ya" value="1" <?php 
                                    echo set_value('Done', $lg->status) == 1 ? "checked" : ""; 
                                ?>>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Done
                                  </label>
                                </div>
                                <textarea id="solusi" name="solusi" rows="20" cols="100" class="form-control" placeholder="Tuliskan Solusi" style="margin-top: 1%"><?php echo $lg->solusi ?></textarea>
                                
                                <?php echo form_error('status','<div class="text-small text-danger"></div>')?>
                            </div>
                           <!--  <div class="form-group">
                                <label>Apakah Case Ini Sudah Selesai?</label><br>
                                <a class="btn btn-info" id="ya">Sudah</a>
                                <a class="btn btn-info" id="tidak">Belum</a>
                                <textarea id="solusi" name="solusi" rows="20" cols="100" class="form-control" placeholder="Tuliskan Solusi" style="margin-top: 1%"><?php echo $lg->solusi ?></textarea>
                            </div> -->
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-danger" href="<?php echo base_url();?>Log_gangguan/log_gangguan">Cancel</a>
                            </form>
                          <?php endforeach; ?> 
                        </div>
                    </div>               
            </div>
        </div>