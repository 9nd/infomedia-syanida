        <!-- Begin Page Content -->
        <br><br><br><br><br>
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Log Gangguan</h6>
                        </div>
                <div class="card-body">
                        <form method="POST" action="<?php echo base_url('Log_gangguan/log_gangguan/tambahDataLogGangguanAksi')?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama TL  : </label>
                                 <!-- <input type="text" readonly name="show_nama" class="form-control" value="<?php if(isset($userdata->agentid)){echo $userdata->nama;}; ?>">
                                <input hidden type="text" name="nama_tl" class="form-control" value='
                                <?php if(isset($userdata->agentid)){echo $userdata->agentid;}; ?>'> -->
                                <input type="text" name="nama_tl" value="<?php if(isset($userdata->agentid)){echo $userdata->nama;}; ?>"class="form-control">
                                <?php echo form_error('nama_tl','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Agent ID  : </label>
                               <input type="text" name="agentid" readonly value="<?php if(isset($userdata->agentid)){echo $userdata->agentid;}; ?>"class="form-control">
                                <?php echo form_error('agentid','<div class="text-small text-danger"></div>')?>
                            </div>
                      
                            <div class="form-group">
                                <label>Jenis Kendala  : </label><br>
                                 <select class="form-control" id="jenis_kendala" name="kategori_gangguan" value="">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">VPN LOSS - RECONNECT NEED</option>
                                    <option value="2">INTERMITTEN EYEBEAM RTO</option>
                                    <option value="3">MYCX LOADING DENGAN VPN TERSAMBUNG</option>
                                    <option value="4">NO INET</option>
                                    <option value="5">SUBMIT SY-ANIDA LOADING</option>
                                    <option value="6">SUARA EARPHONE GAK KELUAR</option>
                                    <option value="7">GAK STABIL</option>
                                    <option value="8">EYEBEAM FEEZ</option>
                                    <option value="9">UPDATE WINDOWS</option>
                                    <option value="10">KEYBOARD NOT WORK</option>
                                    <option value="11">VPN CONNECTING</option>
                                    <option value="12">MYCX GAK BISA LOGIN</option>
                                    <option value="13">Calling</option>
                                    <option value="14">SY-ANIDA LOADING</option>
                                    <option value="15">EYEBEAM EXTENSION 61 BUSSY</option>
                                    <option value="16">WIFI TIDAK TEDETEK DI PC ATAU TIDAK BISA KONEK</option>
                                    <option value="17">TIDAK BISA BUKA IPAYMENT DAN SISKATOOL </option>
                                </select>
                                <?php echo form_error('jenis_kendala','<div class="text-small text-danger"></div>')?>                  
                            </div>
                            <div class="form-group">
                                <label>Detail Kendala : </label>
                                <textarea name="detail_kendala" rows="20" cols="100" class="form-control"></textarea>
                                <?php echo form_error('detail_kendala','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>Waktu Kendala :  </label>
                                <input type="datetime-local" name="tanggal" class="form-control">
                                <?php echo form_error('tanggal','<div class="text-small text-danger"></div>')?>
                            </div>
                            <div class="form-group">
                                <label>No. Ticket IOC : </label>
                                <input type="text" name="no_ticket_ioc" class="form-control">
                                <?php echo $this->session->flashdata('pesan') ?> 
                            </div>
                            <div class="form-group">
                                <label>No. Ticket : </label>
                                <input type="text" name="no_ticket" id="no_ticket" onclick="load()" placeholder="No Ticket" value="<?php echo kodeTiketOtomatis(); ?>" readonly  class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Evidence : </label>
                             <input type="file" name="evidence" class="form-control">
                                <?php echo form_error('evidence','<div class="text-small text-danger"></div>')?>
                             </div>       
                             <div class="form-group">
                                <label>Status :  </label>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="status" value="3">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Open
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="status" value="2">
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    On Progress
                                  </label>
                                </div>
                                 <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="status" value="1">
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Done
                                  </label>
                                </div>
                                <?php echo form_error('status','<div class="text-small text-danger"></div>')?>
                                                    
                            </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-danger" href="<?php echo base_url();?>Log_gangguan/Log_gangguan">Cancel</a>
                            </form> 
                        </div>
                    </div>               
            </div>
        </div>