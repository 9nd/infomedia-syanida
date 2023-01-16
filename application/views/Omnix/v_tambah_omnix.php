        <!-- Begin Page Content -->
        <br>
        <main>
            <div class="container-fluid site-width">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title"><i class="icon icon-plus"></i> Tambah Data Omnix Multichannel Profiling</h4> 
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo base_url('Omnix/Omnix/tambahOmnixAksi')?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Tanggal Pengerjaan <span style="color: red">*</span> : </label>
                                        <input type="date" name="tanggal_pengerjaan" value="<?php echo date("Y-m-d")?>" class="form-control" required readonly>
                                    </div>
                                     <div class="form-group">
                                        <label>Tanggal Call INDRI <span style="color: red">*</span> : </label>
                                        <input type="datetime-local" step=".1" name="tanggal_call_indri" value="<?php echo date("Y-m-d H:i:s")?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Internet <span style="color: red">*</span> : </label>
                                        <input type="text" name="no_internet" value="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Handphone 1 <span style="color: red">*</span> : </label>
                                        <input type="text" name="hp_1" value="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Handphone 2 : </label>
                                        <input type="text" name="hp_2" value="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Handphone 3 : </label>
                                        <input type="text" name="hp_3" value="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email 1 <span style="color: red">*</span> : </label>
                                        <input type="text" name="email_1" value="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email 2 : </label>
                                        <input type="text" name="email_2" value="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email 3 : </label>
                                        <input type="text" name="email_3" value="" class="form-control">
                                    </div>
                                     <div class="form-group">
                                         <label>Reason Omnix :  </label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="reason_omnix" id="ya" value="1">
                                          <label class="form-check-label" for="flexRadioDefault1">
                                            Ada di Omnix
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="reason_omnix" id="tidak" value="0">
                                          <label class="form-check-label" for="flexRadioDefault2">
                                           Tidak Ada di Omnix
                                          </label>
                                        </div><br>  
                                        <div class="form-group">
                                            <label id="channel_available_label">Channel Available : </label>
                                            <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="channel_available" id="twitter_avail" value="1">
                                                  <label class="form-check-label" id="twitter_label" for="flexRadioDefault1">
                                                    Twitter
                                                  </label>
                                                  <div class="form-group">
                                                      <input type="text" name="twitter" id="input_twitter" placeholder="Masukkan Username Twitter" class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                    <label id="status_tw_label">Status Twitter : </label>
                                                      <select class="form-control" id="status_tw" name="status_tw" value="">
                                                        <option value="">-- Pilih Status Twitter --</option>
                                                        <option value="1">Twitter Succesfully Sent</option>
                                                        <option value="0">Twitter Failed Sent</option>
                                                     </select>
                                                  </div>
                                            </div>
                                            <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="channel_available" id="facebook_avail" value="2">
                                                  <label class="form-check-label" id="facebook_label" for="flexRadioDefault2">
                                                   Facebook
                                                  </label>
                                                  <div class="form-group">
                                                    <input type="text" name="facebook" id="facebook_input" placeholder="Masukkan Username Facebook" class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                        <label id="status_fb_label">Status Facebook : </label>
                                                        <select class="form-control" id="status_fb" name="status_fb" value="">
                                                            <option value="">-- Pilih --</option>
                                                            <option value="1">Facebook Succesfully Sent</option>
                                                            <option value="0">Facebook Failed Sent</option>
                                                        </select>                 
                                                    </div>
                                            </div>
                                             <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="channel_available" id="instagram_avail" value="3">
                                                  <label class="form-check-label" id="instagram_label"  for="flexRadioDefault2">
                                                   Instagram
                                                  </label>
                                                  <div class="form-group">
                                                        <input type="text" name="instagram" placeholder="Masukkan Username Instagram" id="ig" class="form-control">
                                                    </div>
                                                     <div class="form-group">
                                                        <label id="status_ig_label">Status Instagram : </label>
                                                        <select class="form-control" id="status_ig" name="status_ig" value="">
                                                            <option value="">-- Pilih --</option>
                                                            <option value="1">Instagram Succesfully Sent</option>
                                                            <option value="0">Instagram Failed Sent</option>
                                                        </select>                 
                                                     </div>
                                                    </div>
                                            <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="channel_available" id="whatsapp_avail" value="4">
                                                  <label class="form-check-label" id="whatsapp_label" for="flexRadioDefault2">
                                                   Whatsapp
                                                  </label>
                                                  <div class="form-group">
                                                        <input type="text" name="wa_kirim" id="wa_kirim" value="" class="form-control">
                                                    </div>
                                                        <div class="form-group">
                                                            <label id="status_wa_label">Status Whatsapp : </label>
                                                            <select class="form-control" id="status_wa" name="status_wa" value="">
                                                                <option value="">-- Pilih --</option>
                                                                <option value="1">Whatsapp Succesfully Sent</option>
                                                                <option value="0">Whatsapp Failed Sent</option>
                                                            </select>                 
                                                         </div>
                                                </div>
                                            <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="channel_available" id="telegram_avail" value="5">
                                                  <label class="form-check-label" id="telegram_label" for="flexRadioDefault2">
                                                   Telegram
                                                  </label>
                                                  <div class="form-group">
                                                    <label id="keterangan_label_telegram">Keterangan : </label>
                                                    <textarea type="text" id="keterangan_telegram" name="keterangan_telegram" class="form-control"></textarea>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label id="email_label">Email Kirim : </label>
                                            <input type="text" name="email_kirim" id="email_kirim" value="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label id="status_email_label">Status Email : </label>
                                            <select class="form-control" id="status_email" name="status_email" value="">
                                                <option value="">-- Pilih --</option>
                                                <option value="1">Email Succesfully Sent</option>
                                                <option value="0">Email Failed Sent</option>
                                            </select>                 
                                         </div>
                                            <div class="form-group">
                                                <label id="keterangan_label">Keterangan : </label>
                                                <textarea type="text" id="keterangan" name="keterangan" class="form-control"></textarea>
                                            </div>          
                                        </div>
                                        <div class="form-group">
                                            <label>Agent : </label>
                                            <input type="text" name="agentid" value="<?php if(isset($userdata->agentid)){echo $userdata->agentid;}; ?>" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Status :  </label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="status" value="1" required>
                                          <label class="form-check-label" for="flexRadioDefault2">
                                            On Progress
                                          </label>
                                        </div>
                                         <div class="form-check">
                                          <input class="form-check-input" type="radio" name="status" value="2" required>
                                          <label class="form-check-label" for="flexRadioDefault2">
                                            Done
                                          </label>
                                        </div>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-danger" href="<?php echo base_url();?>Omnix/omnix">Cancel</a>
                                </form> 
                            </div>
                        </div>               
                    </div>
                </div>
            </div>