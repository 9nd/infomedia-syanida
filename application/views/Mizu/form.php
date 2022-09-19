<div class="card ">
    <div class="card-status bg-green"></div>
    <div class="card-header">
        <h3 class="card-title">Form Call Work Code</h3>
    </div>
    <div class="card-body">
        <form id="form_untuk_submit_<?php echo $datana->id; ?>" method="post">
            <input hidden id="idx" name="idx" value="<?php if (isset($idx)) echo $idx ?>">
            <input hidden id="regional" name="regional" value="<?php if (isset($datanya)) echo $datanya->regional ?>">
            <input hidden id="sumber" name="sumber" value="<?php if (isset($datanya)) echo $datanya->sumber ?>">
            <input hidden id="click_session" name="click_session" value="<?php if (isset($datanya)) echo $datanya->click_session ?>">
            <div class="panel panel-lte">
                <div class="panel-heading lte-heading-primary">Salam Pembuka</div>
                <div class="panel-body row">
                    <div class="col-md-6">
                        <?php
                        echo $ucapan->salam_pembuka;
                        ?>
                        </p>
                    </div>
                    <div class="col-md border-left">
                        <table width="100%">
                            <tr>
                                <td>Nomor Telepon</td>
                                <td><input type="text" class="form-control data-sending" id="no_pstn" name="no_pstn" value="<?php if (isset($datanya)) echo $datanya->pstn1; ?>"></td>
                            </tr>
                            <tr>
                                <td>Nomor Internet</td>
                                <td>
                                    <table widht="100%">
                                        <tr>
                                            <td width="70%"><input type="text" class="form-control data-sending" id="no_speedy" name="no_speedy" value="<?php if (isset($datanya)) echo $datanya->no_speedy; ?>">
                                            </td>
                                            <td width="30%"><a class="btn btn-primary" href="javascript:void(0)" onclick="copypaste2()">Copy</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>NCLI</td>
                                <td><input type="text" class="form-control data-sending" id="ncli" name="ncli" value="<?php if (isset($datanya)) echo $datanya->ncli; ?>">
                                    <!-- <?php echo $datanya->ncli; ?><input hidden type="text" class="form-control data-sending" id="ncli" name="ncli" value="<?php if (isset($datanya)) echo $datanya->ncli; ?>"> -->
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pelanggan</td>
                                <td><input type="text" class="form-control data-sending" id="nama_pelanggan" name="nama_pelanggan" value="<?php if (isset($datanya)) echo $datanya->nama; ?>"></td>
                            </tr>
                            <?php
                            if ($userdata->kategori == "MOS") {
                            ?>
                                <tr>
                                    <td>Layanan</td>
                                    <td><input type="text" class="form-control data-sending" id="layanan" name="layanan" value="<?php if (isset($datanya)) echo $datanya->layanan; ?>"></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td>Relasi Kepemilikan</td>
                                <?php if (isset($datanya))
                                    echo "<option required value=" . $datanya->relasi . ">" . $datanya->relasi . "</option>"


                                ?>
                                <td><select name="relasi" id="relasi" class="form-control data-sending">
                                        <option value="">-- Pilih --</option>
                                        <option value="Pemilik">Pemilik</option>
                                        <option value="Bapak/Ibu">Bapak / Ibu</option>
                                        <option value="Suami/Istri">Suami / Istri</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Keluarga">Keluarga</option>
                                        <option value="Kontrak">Kontrak</option>
                                        <option value="Karyawan">Karyawan</option>
                                        <?php
                                        if ($userdata->kategori == "MOS") {
                                        ?>
                                            <option value="" selected>Pilih</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>
                                    <input type="radio" id="jk_l" name="jk" value="L">
                                    <label for="male">Male</label> &nbsp; &nbsp;
                                    <input type="radio" id="jk_p" name="jk" value="P">
                                    <label for="female">Female</label>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>
            <div class="panel panel-lte">
                <div class="panel-heading lte-heading-primary">Konfirmasi Email dan No HP</div>
                <div class="panel-body row">
                    <div class="col-md-6">
                        <?php
                        echo $ucapan->konfirmasi_emailhp;
                        ?>

                    </div>
                    <div class="col-md border-left">
                        <table width="100%">

                            <tr>
                                <td>Handphone Utama</td>
                                <td>
                                    <input required type="tel" class="form-control data-sending" id="no_handpone" name="no_handpone" value="<?php if (isset($datanya)) echo trim($datanya->handphone); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a id="byphone">
                                        <div class="btn btn-success">
                                            <span class="fe fe-phone"> kirim</span>
                                        </div>
                                        <span class="fe fe-clock" id="lblHandphone" style="font-family:Courier; color:red; font-size: 12px;"> 2020-07-27 14:50:22 </span>

                                    </a>
                                </td>
                            </tr>
                            <tr class="text_validation">
                                <td colspan="2" align="right">
                                    <p style="color: red;"><small>This is a text validation</small></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Handphone Lainnya</td>
                                <td><input type="text" class="form-control data-sending" id="handphone_lainnya" name="handphone_lainnya"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <fieldset id="buildyourform">
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 align="right">
                                    <div class="btn btn-warning" id="add"><span class="icon-plus icons"></span>
                                        <div>
                                </td>
                            </tr>
                            <tr class="text_validation">
                                <td colspan="2" align="right">
                                    <p style="color: red;"><small>This is a text validation</small></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Utama</td>
                                <td>
                                    <input type="email" name="email" class="form-control data-sending" id="email" name="email" value="<?php if (isset($datanya)) echo $datanya->email; ?>">
                                </td>
                            </tr>
                            <tr id="suggestion">

                            </tr>
                            <tr>
                                <td></td>
                                <td><a id="byemail">
                                        <div class="btn btn-success"><span class="fe fe-mail"> kirim</span></div>
                                    </a>
                                    <span class="fe fe-clock" id="lblEmail" style="font-family:Courier; color:red; font-size: 12px;"> </span>

                                </td>
                            </tr>


                            <tr class="text_validation">
                                <td colspan="2" align="right">
                                    <p style="color: red;"><small>This is a text validation</small></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Lainnya</td>
                                <td><input type="text" class="form-control data-sending" id="email_lainnya" name="email_lainnya">
                                </td>
                            </tr>
                            <tr class="text_validation">
                                <td colspan="2" align="right">
                                    <p style="color: red;"><small>This is a text validation</small></p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <fieldset id="buildyourformemail">
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2 align="right">
                                    <div class="btn btn-warning" id="add2"><span class="icon-plus icons"></span>
                                        <div>
                                </td>
                            </tr>


                        </table>
                        <hr>
                        <table width="100%">
                            <tr>
                                <td colspan="2"><strong>Sosial Media</strong></td>
                            </tr>
                            <tr>
                                <td><span class="fe fe-facebook"></span>Facebook</td>
                                <td><input type="text" class="form-control data-sending" id="facebook" name="facebook"></td>

                            </tr>
                            <tr>
                                <td><span class="fe fe-twitter"></span>Twitter</td>
                                <td><input type="text" class="form-control data-sending" id="twitter" name="twitter"></td>
                            </tr>
                            <tr>
                                <td><span class="fe fe-instagram"></span>Instagram</td>
                                <td><input type="text" class="form-control data-sending" id="instagram" name="instagram"></td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>
            <div class="panel panel-lte">
                <div class="panel-heading lte-heading-primary">Verifikasi</div>
                <div class="panel-body row">
                    <div class="col-md-6">
                        <?php
                        echo $ucapan->verifikasi;
                        ?>
                    </div>
                    <div class="col-md border-left">
                        <div class="panel panel-lte">


                            <table width="100%">
                                <tr>
                                    <td>Nama</td>
                                    <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                    <td><input type="text" class="form-control data-sending" id="nama_pastel" name="nama_pastel" value="<?php if (isset($datanya)) echo $datanya->nama_p; ?>"></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                    <td><textarea class="form-control data-sending" id="alamat" name="alamat"><?php if (isset($datanya)) echo $datanya->alamat_p; ?></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2">kota</td>
                                    <td><input type="Text" class="form-control data-sending" id="kota" name="kota" value="<?php if (isset($datanya)) echo $datanya->kota; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Kecepatan</td>
                                    <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                    <td>

                                        <select name="kec_speedy" id="kec_speedy" class="form-control data-sending">
                                            <option value="">Pilih Kecepatan</option>
                                            <option value="Telpon Rumah Saja">Telpon Rumah Saja</option>
                                            <option value="384k">384 Kbps</option>
                                            <option value="512k">512 Kbps</option>
                                            <option value="1">1 Mbps</option>
                                            <option value="2">2 Mbps</option>
                                            <option value="3">3 Mbps</option>
                                            <option value="5">5 Mbps</option>
                                            <option value="10">10 Mbps</option>
                                            <option value="20">20 Mbps</option>
                                            <option value="30">30 Mbps</option>
                                            <option value="40">40 Mbps</option>
                                            <option value="50">50 Mbps</option>
                                            <option value="100">100 Mbps</option>
                                            <option value="200">200 Mbps</option>
                                            <option value="300">300 Mbps</option>
                                        </select>

                                    </td>
                                    <!-- <input type="Text" class="form-control data-sending" id="kec_speedy"
                                        name="kec_speedy"></td> -->
                                </tr>
                                <tr>
                                    <td>Tagihan</td>
                                    <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                    <td>

                                        <input pattern="[0-9]" type="number" class="form-control data-sending" id="billing" name="billing" value="<?php if (isset($datanya)) echo str_replace(array('.', ',00'), '', $datanya->tagihan); ?>">
                                    </td>

                                </tr>
                                <?php
                                if ($userdata->kategori == "MOS") {
                                ?>
                                    <tr>
                                        <td>Tempat Bayar</td>
                                        <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                        <td>
                                            <select class="form-control data-sending" id="payment" name="payment">
                                                <option value="">Pilih payment</option>
                                                <option value="Banking - CR">Bank - Kredit</option>
                                                <option value="Banking - DB">Bank - Debit</option>
                                                <option value="ecommerce">E-commerce</option>
                                                <option value="minimarket">Minimarket</option>
                                                <option value="telkom dan pos">Telkom & POS</option>
                                                <option value="psb">PSB</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Bayar</td>
                                        <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                        <td>
                                            <input type="text" id="waktu_psb" name="waktu_psb" class="form-control data-sending" value="<?php if (isset($datanya)) echo $datanya->tgl_bayar; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><small>--moss--</small></td>

                                        </select></td>
                                    </tr>


                                    <tr>
                                        <td>Jenis Aktivasi</td>
                                        <td></td>

                                        <td>
                                            <!-- <input type="checkbox" id="jenis_aktivasi" name="jenis_aktivasi" class="jenis_aktivasi" value="agent"> <small>Aktivasi By Agent</small> -->
                                            <select id="jenis_aktivasi" name="jenis_aktivasi" class="form-control data-sending">
                                                <option value="0">Pilih Jenis Aktivasi</option>
                                                <option value="pelanggan">Aktivasi Oleh Pelanggan</option>
                                                <option value="agent">Aktivasi Oleh Agent</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Produk MOSS</td>
                                        <td></td>

                                        <td><select id="produk_moss" name="produk_moss" class="form-control custom-select">
                                                <option>Pilih Produk Moss</option>
                                                <?php
                                                foreach ($produk_moss as $datamoss) {
                                                    echo "<option value='$datamoss->kode_chanel'>$datamoss->nama_chanel | $datamoss->harga</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reason Aktivasi Pelanggan</td>
                                        <td></td>
                                        <td>
                                            <select id="aktivasi_pelangganr" name="aktivasi_pelangganr" class="form-control">
                                                <option value="0">Pilih</option>
                                                <option value="Perbedaan Harga">Perbedaan Harga</option>
                                                <option value="Pelanggan lupa dan bingung dengan channel yg akan diaktivasi">Pelanggan lupa dan bingung dengan channel yg akan diaktivasi</option>
                                                <option value="channel tidak ada di mosstools">channel tidak ada di mosstools</option>
                                                <option value="Pelanngan hanya ingin mengubah nomor hp saja">Pelanngan hanya ingin mengubah nomor hp saja</option>
                                                <option value="STB 2 dan STB 3"> STB 2 dan STB 3</option>
                                                <option value="Pelanggan memilih pembayaran prepaid"> Pelanggan memilih pembayaran prepaid</option>
                                                <option value="Pelanggan lebih nyaman di aktivasi sendiri">Pelanggan lebih nyaman di aktivasi sendiri</option>
                                                <option value="Sudah aktivasi moostools tapi gagal maka disarankan manual"> Sudah aktivasi moostools tapi gagal maka disarankan manual</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <td>Tempat Bayar</td>
                                        <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                        <td>
                                            <select class="form-control data-sending" id="payment" name="payment">
                                                <option value="">Pilih payment</option>
                                                <option value="Banking - CR">Bank - Kredit</option>
                                                <option value="Banking - DB">Bank - Debit</option>
                                                <option value="ecommerce">E-commerce</option>
                                                <option value="minimarket">Minimarket</option>
                                                <option value="telkom dan pos">Telkom & POS</option>
                                                <option value="psb">PSB</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bulan & Tahun Pasang</td>
                                        <td width="10px"><input type="checkbox" class="data-sending validate"></td>
                                        <td>
                                            <input type="text" id="waktu_psb" name="waktu_psb" class="form-control data-sending" value="<?php if (isset($datanya)) echo $datanya->waktu_psb; ?>">
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>


                            </table>
                            <!-- <div style="background-color: #ff0100">Not Valid</div> -->

                            <input type="text" id="labelvalidated" name="labelvalidated" class="form-control panel-footer text-center text-white" style="background-color: #ff0100" readonly />

                            <!-- <div id="labelvalidate" class="panel-footer text-center text-white bg-success">Valid -->
                            <select id="status_validate" name="status_validate" hidden>
                                <option value="x">select</option>
                                <option value="valid">valid</option>
                                <option value="notvalid">valid</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>



            <div class="panel panel-lte">
                <div class="panel-heading lte-heading-primary">Closing</div>
                <div class="panel-body row">
                    <div class="col-md-6">
                        <?php echo $ucapan->closing ?>
                    </div>
                    <div class="col-md border-left">
                        <table width="100%">
                            <tr>
                                <td width="35%">Verifikasi Email</td>
                                <!-- <td><a id="byemail">
                                <div class="btn btn-success"><span class="fe fe-mail"> kirim</span></div>
                        </td> -->
                                <td width="65%">
                                    <table width="100%">
                                        <tr>
                                            <td width="35%">
                                                <input id="otpemail" name="otpemail" type="Text" class="form-control data-sending" placeholder="C Email">
                                                <input type="hidden" class="form-control" id="code_email" name="code_email" placeholder="Code Verifikasi Email" style="width:70px;" value="" />
                                            </td>
                                            <td width="65%"><i>
                                                    <span id="lblValidEmail" class="fe fe-check" style="font-family:Courier; color:red; font-size: 12px;"></span>
                                                </i>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td colspan=2>
                            <span class="fe fe-clock" id="lblEmail" style="font-family:Courier; color:red; font-size: 12px;"> </span>


                        </td>
                    </tr> -->

                            <tr>
                                <td>Verifikasi HP</td>
                                <td>
                                    <table width="100%">
                                        <tr>
                                            <td width="35%">
                                                <input id="otpphone" name="otpphone" type="Text" class="form-control data-sending" placeholder="C HP">
                                                <input type="hidden" class="form-control" id="code_handphone" name="code_handphone" placeholder="Code Verifikasi" style="width:70px;" value="" />
                                            </td>
                                            <td>
                                                <i>
                                                    <span id="lblValidHandphone" class="fe fe-check" style="font-family:Courier; color:red; font-size: 12px;"></span>


                                                </i>
                                            </td width="65%">
                                        </tr>

                                    </table>

                                </td>
                            </tr>
                            <!-- <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td colspan=2>
                            <span class="fe fe-clock" id="lblHandphone" style="font-family:Courier; color:red; font-size: 12px;"> 2020-07-27 14:50:22 </span>
                        </td>
                    </tr> -->
                            <!-- <tr>
                        <td colspan=3 align="right"></td>
                    </tr> -->
                            <?php
                            if ($userdata->kategori != "MOS") {
                            ?>
                                <tr style="background-color:#28a745; color: white;">
                                    <td colspan=3 align="right"><input type="checkbox" class="bysistem" id="bysistem" value=1 name="bysistem"> &nbsp;Verifikasi by sistem &nbsp;</td>
                                </tr>
                            <?php
                            }
                            ?>

                            <tr>
                                <td colspan=3 align="right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Opsi Call</td>
                                <td colspan="2"><select name="opsi_call" id="opsi_call" class="form-control">
                                        <option value="0">-- Pilih --</option>
                                        <option value="1">Telepon Rumah</option>
                                        <option value="2">Handphone</option>
                                        <option value="3">Email</option>
                                        <option value="4">Chat</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori Call</td>
                                <td colspan="2"><select class="form-control data-sending" id="kategori_call" name="kategori_call">
                                        <option value="x">Pilih..</option>
                                        <option value="1">Contacted</option>
                                        <option value="0">Not Contacted</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Sub Kategori Call</td>
                                <div class="skcall" style=" display: none;">

                                </div>
                                <td colspan="2">
                                    <select class="form-control data-sending" id="veri_call" name="veri_call">
                                        <option value="0">-- Pilih --</option>
                                        <option class="opsinc" value="2">RNA</option>
                                        <option class="opsinc" value="4">Salah Sambung</option>
                                        <option class="opsinc" value="7">Isolir</option>
                                        <option class="opsinc" value="8">Mailbox</option>
                                        <option class="opsinc" value="9">Telepon Sibuk</option>
                                        <option class="opsinc" value="10">Rejected</option>
                                        <option class="opsicontacted" value="11">Decline</option>
                                        <option class="opsicontacted" value="12">Follow Up</option>
                                        <option class="opsicontacted" value="13">Verified</option>
                                        <option class="opsinc" value="14">Reject By System</option>
                                        <option class="opsinc" value="15">Cabut</option>
                                        <option class="opsinc" value="16">Invalid Number</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="rdeclinewrap">
                                <td>Reason Decline</td>
                                <td colspan="2">
                                    <select class="form-control data-sending" id="reason_decline" name="reason_decline">
                                        <option value="0">-- Pilih --</option>
                                        <option class="reg" value="111">Bukan PJ Pembayaran</option>
                                        <option class="reg" value="112">PJ menolak verifikasi</option>
                                        <?php
                                        if ($userdata->kategori == "MOS") {
                                        ?>
                                            <option class="moss" value="113">Pelanggan Cancel Beli Produk</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Status Call</td>
                                <td colspan="2"><select name="veri_status" id="veri_status" class="form-control">
                                        <option class="veri_statusopt_p" value="0">-- Pilih --</option>
                                        <option class="veri_statusopt_v" value="1">Verified</option>
                                        <option class="veri_statusopt_nv" value="2">Not Verified</option>
                                        <option class="veri_statusopt_dk" value="3">Ditelepon Kembali</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td colspan="2"><input type="text" class="form-control data-sending" id="keterangan" name="keterangan" value="<?php if (isset($datanya)) echo $datanya->keterangan; ?>">
                                </td>
                            </tr>

                        </table>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-md">
                        <button type="button" id="button_untuk_submit_<?php echo $datana->id; ?>" class="submit btn btn-primary btn-block"><span class="fe fe-save"></span> Submit</button>
                    </div>


                </div>

            </div>

            <div class="panel panel-lte">
                <div class="panel-heading lte-heading-important">History Call</div>
                <div class="panel-body">
                    <small>
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        EmailCode
                                    </th>
                                    <th>
                                        Handphon
                                    </th>
                                    <th>
                                        HPCode
                                    </th>
                                    <th>
                                        FB
                                    </th>
                                    <th>
                                        Twitter
                                    </th>
                                    <th>
                                        Agent
                                    </th>
                                    <th>
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($datahc->num_rows() > 0) {
                                    foreach ($datahc->result() as $dataskuy) {
                                ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $dataskuy->nama_pelanggan; ?></td>
                                            <td><?php echo $dataskuy->email; ?></td>
                                            <td><?php echo $dataskuy->status_email; ?></td>
                                            <td><?php echo $dataskuy->no_handpone; ?></td>
                                            <td><?php echo $dataskuy->status_handpone; ?></td>
                                            <td><?php echo $dataskuy->facebook; ?></td>
                                            <td><?php echo $dataskuy->twitter; ?></td>
                                            <td><?php echo $dataskuy->update_by; ?></td>
                                            <td><?php echo $dataskuy->lup; ?></td>
                                        </tr>

                                <?php
                                        $no++;
                                    }
                                } else {
                                    echo "<td colspan='10'>History Call Not Found</td>";
                                }
                                ?>


                            </tbody>
                        </table>
                    </small>



                </div>

            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/mailcheck.js"></script>
<script>
    $("#closet").click(function() {
        $('[name=kategori_call]').val(0);
        $('[name=veri_status]').val(2);
        $('.opsinc').show();
        $('.opsicontacted').hide();
        $('[name=veri_status]').val(2);
        $('[name=veri_call]').val(0);
        $('.veri_statusopt_p').hide();
        $('.veri_statusopt_v').hide();
        $('.veri_statusopt_dk').hide();
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#kategori_call").offset().top
        }, 100);
    });
</script>
<script>
    $(document).ready(function() {

        $('.text_validation').hide();
        <?php
        if ($userdata->kategori == "REG") {
        ?>
            // $("input").prop('readonly', true);
            $("#nama_pelanggan").prop('readonly', false);
            $("#no_speedy").prop('readonly', false);
            $("#no_pstn").prop('readonly', false);
            $("#ncli").prop('readonly', false);
            $("#regional").prop('readonly', false);
            $("#sumber").prop('readonly', false);
            $("#click_session").prop('readonly', false);
            $("#click_time").prop('readonly', false);
            $("#keterangan").prop('readonly', false);
            $("#idx").prop('readonly', false);
            $("#no_handpone").prop('readonly', false);
            $("#email").prop('readonly', false);
        <?php
        }
        ?>
    });
</script>


<script>
    $(document).ready(function() {
        $("#banking").hide();
        $(".rdeclinewrap").hide();
        $("#lblValidHandphone").hide();
        $("#lblEmail").hide();
        $("#lblHandphone").hide();
        $("#lblValidEmail").hide();
        $("#phone").keydown(function(e) {
            if ($.inArray(e.keyCode, [46, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $("#phone").on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event
                    .which > 57)) {
                event.preventDefault();
            }
        });

        $("#no_speedy").keydown(function(e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


        
        document.getElementById("button_untuk_submit_<?php echo $datana->id; ?>").addEventListener("click", function(e) {

            var relasi = $.trim($('#relasi').val());
            var otpphone = $.trim($('#otpphone').val());
            var labelvalidated = $.trim($('#labelvalidated').val());
            var no_handpone = $.trim($('#no_handpone').val());
            var nama_pelanggan = $.trim($('#nama_pelanggan').val());
            var ncli = $.trim($('#ncli').val());
            var veri_call = $.trim($('#veri_call').val());
            var reason_decline = $.trim($('#reason_decline').val());
            var veri_status = $.trim($('#veri_status').val());
            var jenis_aktivasi = $.trim($('#jenis_aktivasi').val());
            var layanan = $.trim($('#layanan').val());
            var produk_moss = $.trim($('#produk_moss').val());
            var aktivasi_pelangganr = $.trim($('#aktivasi_pelangganr').val());
            var agentid = "<?php echo $_GET['userid']; ?>";

            if (relasi === '' && veri_status == '1') {
                alert('Relasi kepemilikan tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#relasi").offset().top
                }, 100);
                return false;
            } else if (veri_call === '11' && reason_decline === '0' && veri_status === '2') {
                alert('reason decline tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#veri_call").offset().top
                }, 100);
                return false;
            } else if (nama_pelanggan === '' && veri_status === 1) {
                alert('Nama tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#nama_pelanggan").offset().top
                }, 100);
                return false;
            } else if (ncli === '') {
                alert('NCLI tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#ncli").offset().top
                }, 100);
                return false;
            } else if (veri_call === '0') {
                alert('Sub Kategori call tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#veri_call").offset().top
                }, 100);
                return false;
            } else if (veri_call === '' || veri_call === 'undefined') {
                alert('data sudah tersubmit');
                return false;
            } else if (no_handpone === '' && veri_status == '1') {
                alert('Nomor Handphone tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#no_handphone").offset().top
                }, 100);
                return false;
            } else if (veri_status === '0') {
                alert('status call tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#veri_status").offset().top
                }, 100);
                return false;

            } else if (!$('#jk_l').is(':checked') && !$('#jk_p').is(':checked') && veri_status == '1') {
                alert('Jenis Kelamin tidak boleh kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#jk_l").offset().top
                }, 100);
                return false;

            } else if (veri_status == '1' && labelvalidated != 'valid') {
                // alert(veri_status);

                alert('Anda tidak dapat menyimpan verified, Karena Belum belum memenuhi syarat min 4 Verifikasi');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#nama_pastel").offset().top
                }, 100);
                return false;
            } else if (layanan == 'minipack' && veri_status == '1' && jenis_aktivasi === '0') {
                alert('Silahkan pilih jenis aktivasi');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#jenis_aktivasi").offset().top
                }, 100);
                return false;
            } else if (layanan == 'minipack' && veri_status == '1' && jenis_aktivasi === 'agent' && produk_moss == "Pilih Produk Moss") {


                alert('Silahkan pilih produk mos');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#jenis_aktivasi").offset().top
                }, 100);
                return false;
            } else if (layanan == 'minipack' && veri_status == '1' && jenis_aktivasi === 'pelanggan' && aktivasi_pelangganr == "0") {
                alert('Silahkan pilih reason aktivasi pelanggan');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#aktivasi_pelangganr").offset().top
                }, 100);
                return false;
            } else {
                $("#button_untuk_submit_<?php echo $datana->id; ?>").type = 'button';
                $("#button_untuk_submit_<?php echo $datana->id; ?>").prop('disabled', true);
                //e.preventDefault(); // before the code
                var datana = $('#form_untuk_submit_<?php echo $datana->id; ?>').serialize();
                // updateStatus(4, assignedData[pointIndex].unique_key, assignedData[pointIndex].categorie_id)
                submitData(datana);
                // return false;
            }

        });



        $("#no_handpone, #handphone_lainnya, #hptambahan1, #hptambahan2, hptambahan3").keydown(function(e) {
            var handphone = $('#no_handpone');
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            } else {
                if (handphone.val().length < 1) {
                    if (e.keyCode != "48") {
                        alert("Angka Pertama Harus Nol ( 0 ) ");
                        $('#handphone').val('0');
                    }
                } else if (handphone.val().length < 2) {
                    if (e.keyCode != "56") {
                        alert("Angka Kedua Harus Delapan ( 8 ) ");
                        $('#handphone').val('08');
                    }
                }
            }
        });

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(
                /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
            );
            return pattern.test(emailAddress);
        }

        $('#otpphone').blur(function() {
            var code_handphone = $('#code_handphone').val();
            var otpphone = $('#otpphone').val();
            if (otpphone != "") {
                $("#lblValidHandphone").show();
                if (code_handphone != otpphone) {
                    $("#lblValidHandphone").html(" Not Verified");
                    $('#otpphone').val("");
                } else {
                    $("#lblValidHandphone").html(" Verified");
                }
            }
        });

        $('#otpemail').blur(function() {
            var code_email = $('#code_email').val();
            var otpemail = $('#otpemail').val();
            if (otpemail != "") {
                $("#lblValidEmail").show();
                if (code_email != otpemail) {
                    $("#lblValidEmail").html(" Not Verified");
                    $('#otpemail').val("");
                } else {
                    $("#lblValidEmail").html(" Verified");
                }
            }
        });

        $('#byemail').click(function() {
            $("byemail").prop('disabled', true);
            var nama = $('#nama_pelanggan');
            var ncli = $('#ncli');
            var pstn1 = $('#no_pstn');
            var email = $('#email');
            if (nama.val() == "") {
                alert('Nama Pelanggan Tidak Boleh Kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#nama_pelanggan").offset().top
                }, 100);
            }

            // else if (pstn1.val() == "") {
            //     alert('Nomor Telp Tidak Boleh Kosong');
            //     $([document.documentElement, document.body]).animate({
            //         scrollTop: $("#no_pstn").offset().top
            //     }, 100);
            // } 
            else {
                if (isValidEmailAddress(email.val())) {
                    $.ajax({
                        type: "POST",
                        url: "../../../../profilling/app/ajax_sendCode.php",
                        data: {
                            by: 1,
                            email: email.val()
                        },
                        success: function(e) {
                            $("byemail").prop('disabled', false);
                            var word = e.split(",");
                            $('#vemail').val(word[2]);
                            if (parseInt(word[4]) > 0) {
                                alert('Email : ' + email.val() +
                                    ' sudah ada dalam database sebanyak ' + word[4]);
                            } else {
                                $("#lblEmail").show();
                                alert('Kode Verifikasi Email sudah terkirim ');
                                $('#code_email').val(word[2]);
                                $('#lblEmail').html(word[5]);
                                $('#bysistem').click(function() {
                                    if ($('input.bysistem').is(':checked')) {
                                        //alert('asdfasdf');
                                        // $('#otpemail').val(word[2]);
                                        $('#code_email').val(word[2]);
                                    };
                                });

                                // $("#lblHandphone").show();
                                // $('#lblHandphone').html(word[5] + " ");
                                // var msg = "Kode verifikasi data Anda adalah " + word[2] +
                                //     " silakan infokan kepada petugas  kami yang sedang menghubungi Bpk/Ibu. Tks";
                                // alert('Kode Verifikasi SMS sudah terkirim');

                                // $('#bysistem').click(function() {
                                //     if ($('input.bysistem').is(':checked')) {
                                //         //alert('asdfasdf');
                                //         $('#otpphone').val(word[2]);
                                //     };
                                // });




                            }
                        }
                    });
                } else {
                    alert('email tidak valid, Harus menggunakan @ dan . dalam penulisan');
                }
            }

        });

        $('#bytwitter').click(function() {
            var sosmed = $('#twitter');
            $('#verfi_twitter').val("");
            $.ajax({
                type: "POST",
                url: "http://10.194.194.61/profilling/app/ajax_sosmed.php",
                data: "by=1&sosmed=" + sosmed.val(),
                processData: false,
                success: function(e) {
                    if (e != 'Invalid Account Name') {
                        $('#verfi_twitter').val(e);
                    } else {
                        alert(e);
                    }
                }
            });
        });



        function addNumbers() {
            var val1 = val(word[2]);
            // var val2 = parseInt(document.getElementById("my_value_2").value);
            // var ansD = document.getElementById("total");
            // ansD.value = val1 + val2;
            $('#total_div').text(otpphone);
        }

        $('#byphone').click(function() {

            var nama = $('#nama_pelanggan');
            var ncli = $('#ncli');
            var pstn1 = $('#no_pstn');
            var no_speedy = $('#no_speedy');
            var handphone = $('#no_handpone');
            $("byphone").prop('disabled', true);


            var str = handphone.val();
            var patt1 = /\s/g;
            var result = str.match(patt1);

            var msisdn = '62' + handphone.val().slice(1, 30);

            //alert(msisdn);

            // var str = "08903014";
            var patt = /[^Z0-9@]+/g;
            var result1 = str.match(patt);

            if (nama.val() == "") {
                alert('Nama Pelanggan Tidak Boleh Kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#nama_pelanggan").offset().top
                }, 100);
            } else if (handphone.val() == "") {
                alert('Nomor handphone Tidak Boleh Kosong');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#no_handpone").offset().top
                }, 100);
            } else if (result != null) {
                alert('Nomor handphone Tidak Sesuai');
            } else if (result1 != null) {
                alert('Nomor handphone Tidak Sesuai');
            } else {
                $.ajax({
                    type: "POST",
                    url: "../../../../profilling/app/ajax_sendCode.php",
                    data: {
                        by: 2,
                        nama: nama.val(),
                        handphone: msisdn
                    },

                    success: function(e) {
                        $("byphone").prop('disabled', false);
                        var word = e.split(",");
                        $('#vhandphone').val(word[2]);
                        if (parseInt(word[4]) > 0) {
                            alert('Handphone : ' + handphone.val() +
                                ' sudah ada dalam database sebanyak ' + word[4]);
                        } else {
                            $('#code_handphone').val(word[2]);
                            $("#lblHandphone").show();
                            $('#lblHandphone').html(word[5] + " ");
                            var msg = "Kode verifikasi data Anda adalah " + word[2] +
                                " silakan infokan kepada petugas  kami yang sedang menghubungi Bpk/Ibu. Tks";
                            alert('Kode Verifikasi SMS sudah terkirim');


                            $('#bysistem').click(function() {
                                if ($('input.bysistem').is(':checked')) {
                                    //alert('asdfasdf');
                                    // $('#otpphone').val(word[2]);
                                    $('#code_handphone').val(word[2]);
                                };
                            });
                        }
                    }
                });
            }
        });

    });
</script>
<script>

</script>
<script>
   

    // $('form').preventDoubleSubmission();
    function copypaste() {
        /* Get the text field */
        var copyText = document.getElementById("no_handpone");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        // alert("Copied the text: " + copyText.value);
    }

    function copypaste2() {
        /* Get the text field */
        var copyText = document.getElementById("no_speedy");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        // alert("Copied the text: " + copyText.value);
    }
    $(document).ready(function() {


        $('.veri_statusopt_v').hide();
        $('.veri_statusopt_dk').hide();
        $('.veri_statusopt_nv').hide();

        $("#add").click(function() {
            var lastField = $("#buildyourform div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $(
                "<td width=\"100%\"><input type=\"text\" id=\"hptambahan" + intId +
                "\" name=\"hptambahan" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td>"
            );
            var fType = $(
                ""
            );
            var removeButton = $(
                "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
            );
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(fType);
            fieldWrapper.append(removeButton);
            $("#buildyourform").append(fieldWrapper);
        });
        $("#add2").click(function() {
            var lastField = $("#buildyourformemail div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $(
                "<td width=\"100%\"><input type=\"email\" id=\"emailtambahan" + intId +
                "\" name=\"emailtambahan" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td>"
            );
            var fType = $(
                ""
            );
            var removeButton = $(
                "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
            );
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(fType);
            fieldWrapper.append(removeButton);
            $("#buildyourformemail").append(fieldWrapper);
        });
        $("#billing").change(function() {
            var valna = $(this).val();
            var comma = valna.replace(",", "");
            var titik = comma.replace(".", "");
            var res = titik.replace("e", "");
            $(this).val(res);
        });
    });
    $('.opsicontacted').hide();
    $('.opsinc').hide();
    $("#labelvalidated").show();
    $("#labelvalidate").hide();
    var Privileges = jQuery('#kategori_call');
    var select = this.value;
    Privileges.change(function() {
        if ($(this).val() == '1') {
            $('.opsicontacted').show();
            $('.opsinc').hide();
            $('.veri_statusopt_p').show();
            $('.veri_statusopt_v').show();
            $('.veri_statusopt_dk').show();
            $('.veri_statusopt_nv').show();
        } else if ($(this).val() == '0') {
            $('.opsinc').show();
            $('.opsicontacted').hide();
            $('[name=veri_status]').val(2);
            $('[name=veri_call]').val(0);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
        } else if ($(this).val() == 'x') {
            $('.opsinc').hide();
            $('.opsicontacted').hide();
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').hide();
        }
        //     $('.opsicontacted').hide(); // hide div if value is not "custom"
        //     $('.opsinc').show(); // hide div if value is not "custom"
    });

    var Privileges = jQuery('#veri_call');
    var select = this.value;
    Privileges.change(function() {
        if ($(this).val() == '13') {
            $('[name=veri_status]').val(1);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').show();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').hide();
        } else if ($(this).val() == '12') {
            $('[name=veri_status]').val(3);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').show();
            $('.veri_statusopt_nv').hide();
        } else if ($(this).val() == '11') {
            $('[name=veri_status]').val(2);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').show();
            $('.rdeclinewrap').show();
        } else if ($(this).val() != '11' || $(this).val() != '12' || $(this).val() != '13' || $(this).val() != '0') {
            $('[name=veri_status]').val(2);
            $('[name=kategori_call]').val(0);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').show();
        }
        //     $('.opsicontacted').hide(); // hide div if value is not "custom"
        //     $('.opsinc').show(); // hide div if value is not "custom"
    });




    var countChecked = function() {
        var n = $("input.validate:checked").length;
        var valid =
            '<option selected="selected" value=""> --Pilih-- </option><option value="1">Verified</option><option value="3">Ditelepon kembali</option>';
        var notvalid =
            '<option value="Pilih"> --Pilih-- </option><option value="2" selected="selected">Not Verified</option><option value="3" >Ditelepon kembali</option>';

        if (n > 3) {
            // $("#labelvalidate").show();
            //$("#veri_status").children("option[value=1]").show());
            $("#labelvalidated").val("valid");
            $('#labelvalidated').css({
                'background-color': '#28a745'
            });
            // $('[name=status_validate]').val("valid");
        } else {
            // $("#labelvalidate").hide();
            //$("#veri_status").children("option[value=1]").show());
            $("#labelvalidated").val("not valid");
            $('#labelvalidated').css({
                'background-color': '#ff0100'
            });
        }
    };
    countChecked();
    $("input[type=checkbox]").on("click", countChecked);
</script>
<script>
    var domains = ['hotmail.com', 'gmail.com', 'aol.com'];
    var topLevelDomains = ["com", "net", "org"];

    $('#email').on('blur', function(event) {
        console.log("event ", event);
        console.log("this ", $(this));
        $(this).mailcheck({
            domains: domains, // optional
            topLevelDomains: topLevelDomains, // optional
            suggested: function(element, suggestion) {
                // callback code
                console.log("suggestion ", suggestion.full);
                $('#suggestion').html("<td align='right' style='color: red;'>Did you mean: </td><td> <input readonly class='form-control' value='" + suggestion.full + "'></td>");
            },
            empty: function(element) {
                // callback code
                $('#suggestion').html('');

            }
        });
    });
</script>