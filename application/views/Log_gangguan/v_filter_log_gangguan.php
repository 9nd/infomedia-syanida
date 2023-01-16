        <!-- Begin Page Content -->
            <br><br><br><br><br>
            <!-- START: Main Menu-->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Filter Log Gangguan</h6>
                        </div>
                     <div class="card-body"> 
                      <form method="POST" action="<?php echo base_url('Log_gangguan/log_gangguan/filter_log_gangguan')?>">
                        <div class="form-group">
                          <label>Dari Tanggal</label>
                          <input type="date" name="dari" class="form-control" value="<?php echo $this->input->post('dari') ?>" >
                          <?php echo form_error('dari','<span class="text-small text-danger">','</span>')?>
                        </div>
                        <div class="form-group">
                          <label>Sampai Tanggal</label>
                          <input type="date" name="sampai" class="form-control" value="<?php echo $this->input->post('sampai') ?>" >
                          <?php echo form_error('sampai','<span class="text-small text-danger">','</span>')?>
                        </div>
                          <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i>Tampilkan Data</button>
                          <a href="<?php echo base_url() . "Log_gangguan/log_gangguan" ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                      </form>   
                        </div>
                     </div>               
                  </div>
                </div>