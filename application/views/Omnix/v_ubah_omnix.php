        <!-- Begin Page Content -->
         <br><br><br><br><br>
                <div class="container-fluid site-width">
                    <div class="row">
                    <div class="col-12 mt-3">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Omnix Multichannel Profiling</h6>
                        </div>
                <div class="card-body">
                     <?php foreach ($omnix_report as $or) : ?>
                        <form method="POST" action="<?php echo base_url('Omnix/Omnix/updateOmnixAksi'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tanggal Pengerjaan : </label>
                                <input type="hidden"  name="id" value="<?php echo $or->id?>">
                                <input type="date" name="tanggal_pengerjaan" value="<?php echo $or->tanggal_pengerjaan?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Call INDRI : </label>
                                <input type="datetime-local" readonly step=".1" name="tanggal_call_indri" value="<?php echo $or->tanggal_call_indri?>" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>No. Internet : </label>
                                <input type="text" readonly name="no_internet" value="<?php echo $or->no_internet?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Handphone 1 : </label>
                                <input type="text" readonly name="hp_1" value="<?php echo $or->hp_1?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Handphone 2 : </label>
                                <input type="text" name="hp_2" value="<?php echo $or->hp_2?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Handphone 3 : </label>
                                <input type="text" name="hp_3" value="<?php echo $or->hp_3?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email 1 : </label>
                                <input type="text" name="email_1" value="<?php echo $or->email_1?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email 2 : </label>
                                <input type="text" name="email_2" value="<?php echo $or->email_2?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email 3 : </label>
                                <input type="text" name="email_3" value="<?php echo $or->email_3?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Reason Omnix : </label>
                                <div class="form-check">
                                  <input type="radio" name="reason_omnix" id="ya2" value="1" <?php 
                                  if($or->reason_omnix == 1){
                                     echo "checked";
                                  }else{
                                    echo "";
                                  }
                                 ?>>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Ada di Omnix 
                                  </label>
                                </div>
                                 <div class="form-check">
                                  <input  type="radio" name="reason_omnix" id="tidak2" value="0" 
                                   <?php 
                                  if($or->reason_omnix == 0 && $or->reason_omnix != NULL){
                                     echo "checked";
                                  }else{
                                    echo "";
                                  }
                                 ?>
                                 >
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Tidak Ada di Omnix
                                  </label>
                                </div><br>
                                <div class="form-group">
                                    <label id="channel_available_label_2">Channel Available : </label>
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="channel_available" id="twitter_avail_2" value="1" <?php 
                                    echo set_value('Twitter', $or->channel_available) == 1 ? "checked" : "";?>>
                                          <label class="form-check-label" id="twitter_label_2" for="flexRadioDefault1">
                                            Twitter
                                          </label>
                                          <div class="form-group">
                                              <input type="text" name="twitter" id="input_twitter_2" value="<?php echo $or->twitter?>" placeholder="Masukkan Username Twitter" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            <label id="status_tw_label">Status Twitter : </label>
                                              <select class="form-control" id="status_tw_2" name="status_tw" value="">
                                                <option value="">-- Pilih --</option>
                                                <option value="1" <?php if($or->status_tw=='1'){echo 'selected';}?>>Twitter Succesfully Sent</option>
                                                <option value="0" <?php if($or->status_tw=='0'){echo 'selected';}?>>Twitter Failed Sent</option>
                                             </select>
                                          </div>
                                    </div>
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="channel_available" id="facebook_avail_2" value="2" <?php 
                                    echo set_value('Facebook', $or->channel_available) == 2 ? "checked" : "";?>>
                                          <label class="form-check-label" id="facebook_label_2" for="flexRadioDefault2">
                                           Facebook
                                          </label>
                                          <div class="form-group">
                                            <input type="text" name="facebook" id="facebook_input_2" value="<?php echo $or->facebook?>" placeholder="Masukkan Username Facebook" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            <label id="status_fb_label">Status Facebook : </label>
                                              <select class="form-control" id="status_fb_2" name="status_fb" value="">
                                                <option value="">-- Pilih --</option>
                                                <option value="1" <?php if($or->status_fb=='1'){echo 'selected';}?>>Facebook Succesfully Sent</option>
                                                <option value="0" <?php if($or->status_fb=='0'){echo 'selected';}?>>Facebook Failed Sent</option>
                                             </select>
                                          </div>
                                    </div>
                                     <div class="form-check">
                                          <input class="form-check-input" type="radio" name="channel_available" id="instagram_avail_2" value="3" <?php 
                                    echo set_value('Instagram', $or->channel_available) == 3 ? "checked" : "";?>>
                                          <label class="form-check-label" id="instagram_label_2"  for="flexRadioDefault2">
                                           Instagram
                                          </label>
                                          <div class="form-group">
                                                <input type="text" name="instagram" placeholder="Masukkan Username Instagram" id="ig_2" class="form-control">
                                            </div>
                                             <div class="form-group">
                                                <label id="status_ig_label">Status Instagram : </label>
                                                <select class="form-control" id="status_ig_2" name="status_ig" value="">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="1" <?php if($or->status_ig=='1'){echo 'selected';}?>>Instagram Succesfully Sent</option>
                                                    <option value="0" <?php if($or->status_ig=='0'){echo 'selected';}?>>Instagram Failed Sent</option>
                                                </select>                 
                                             </div>
                                            </div>
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="channel_available" id="whatsapp_avail_2" value="4" <?php 
                                    echo set_value('Whatsapp', $or->channel_available) == 4 ? "checked" : "";?>>
                                          <label class="form-check-label" id="whatsapp_label_2" for="flexRadioDefault2">
                                           Whatsapp
                                          </label>
                                          <div class="form-group">
                                                <input type="text" name="wa_kirim" id="wa_kirim_2" value="" class="form-control">
                                            </div>
                                                <div class="form-group">
                                                    <label id="status_wa_label_2">Status Whatsapp : </label>
                                                    <select class="form-control" id="status_wa_2" name="status_wa" value="">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="1" <?php if($or->status_wa=='1'){echo 'selected';}?>>Whatsapp Succesfully Sent</option>
                                                        <option value="0" <?php if($or->status_wa=='0'){echo 'selected';}?>>Whatsapp Failed Sent</option>
                                                    </select>                 
                                                 </div>
                                        </div>
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="channel_available" id="telegram_avail_2" value="5" <?php 
                                    echo set_value('Telegram', $or->channel_available) == 5 ? "checked" : "";?>>
                                          <label class="form-check-label" id="telegram_label_2" for="flexRadioDefault2">
                                           Telegram
                                          </label>
                                          <div class="form-group">
                                            <label id="keterangan_label_telegram_2">Keterangan : </label>
                                            <textarea type="text" id="keterangan_telegram_2" name="keterangan_telegram" class="form-control"><?php echo $or->keterangan_telegram?></textarea>
                                        </div>  
                                    </div>

                                </div>
                                <div class="form-group">
                                        <label id="email_label_2">Email Kirim : </label>
                                        <input type="email" name="email_kirim" id="email_kirim_2" value="" class="form-control">
                                    </div>
                                <div class="form-group">
                                        <label id="status_email_label_2">Status Email : </label>
                                        <select class="form-control" id="status_email_2" name="status_email" value="">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" <?php if($or->status_email=='1'){echo 'selected';}?>>Email Succesfully Sent</option>
                                            <option value="0" <?php if($or->status_email=='0'){echo 'selected';}?>>Email Failed Sent</option>
                                        </select>                 
                                     </div>
                            </div>
                            
                            <div class="form-group">
                                <label id="keterangan_label_2">Keterangan : </label>
                                <textarea type="text" id="keterangan_2" name="keterangan" class="form-control"><?php echo $or->keterangan?></textarea>
                            </div>   
                            <div class="form-group">
                                <label>Agent ID : </label>
                                <input type="text"  readonly name="agentid" class="form-control" value="<?php echo $or->agentid ?>">
                            </div>
                            <div class="form-group">
                                <label>Status : </label>
                                <!--  <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status"  value="0" <?php 
                                    echo set_value('Open', $or->status) == 0 ? "checked" : ""; 
                                ?>>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Open
                                  </label>
                                </div> -->
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status"  value="1" <?php 
                                    echo set_value('On Progress', $or->status) == 1 ? "checked" : ""; 
                                ?>>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    On Progress
                                  </label>
                                </div>
                                 <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status"  value="2" <?php 
                                    echo set_value('Done', $or->status) == 2 ? "checked" : ""; 
                                ?>>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Done
                                  </label>
                                </div>
                            </div>
                           
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-danger" href="<?php echo base_url();?>Omnix/omnix">Cancel</a>
                            </form>
                          <?php endforeach; ?> 
                        </div>
                    </div>               
            </div>
        </div>
    </div>