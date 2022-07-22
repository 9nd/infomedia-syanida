<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form Call Work Code', 'bg-green', true) ?>
<!-- <fieldset id="buildyourform">
    <legend>Build your own form!</legend>
</fieldset>
<input type="button" value="Preview form" class="add" id="preview" />
<input type="button" value="Add a field" class="add" id="add" /> -->


<form action="<?php echo base_url() ?>Outbound/Outbound/insertdata" method="post" enctype="multipart/form-data">
    <div class="panel panel-lte">
        <div class="panel-heading lte-heading-success">Salam Pembuka</div>
        <div class="panel-body row">
            <div class="col-md-7">
                <?php
                echo $ucapan->salam_pembuka;
                
                ?>
                </p>
            </div>
            <div class="col-md border-left">
                <table width="100%">
                    <tr>
                        <td>Nomor Telepon</td>
                        <td><?php echo $datanya->no_pstn;?><input hidden type="text" class="form-control data-sending focus-color" id="no_pstn"
                                name="no_pstn" value="<?php if(isset($datanya))echo $datanya->no_pstn; ?>"></td>
                    </tr>
                    <tr>
                        <td>Nomor Internet</td>
                        <td><?php echo $datanya->no_speedy;?><input hidden type="text" class="form-control data-sending focus-color" id="no_speedy"
                                name="no_speedy" value="<?php if(isset($datanya))echo $datanya->no_speedy; ?>"></td>
                    </tr>
                    <tr>
                        <td>NCLI</td>
                        <td><?php echo $datanya->ncli;?><input hidden type="text" class="form-control data-sending focus-color" id="ncli"
                                name="ncli" value="<?php if(isset($datanya))echo $datanya->ncli; ?>"></td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="nama_pelanggan"
                                name="nama_pelanggan"
                                value="<?php if(isset($datanya))echo $datanya->nama_pelanggan; ?>"></td>
                    </tr>
                    <tr>
                        <td>Relasi Kepemilikan</td>
                        <?php if(isset($datanya))
                            echo "<option value=".$datanya->relasi.">".$datanya->relasi."</option>"
                            

                        ?>
                        <td><select name="relasi" id="relasi" class="form-control data-sending focus-color">
                                <option value="Pilih">-- Pilih --</option>
                                <option value="Pemilik">Pemilik</option>
                                <option value="Bapak/Ibu">Bapak / Ibu</option>
                                <option value="Suami/Istri">Suami / Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Keluarga">Keluarga</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <input type="radio" id="jk" name="gender" value="male">
                            <label for="male">Male</label> &nbsp; &nbsp;
                            <input type="radio" id="jk" name="gender" value="female">
                            <label for="female">Female</label>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
    <div class="panel panel-lte">
        <div class="panel-heading lte-heading-success">Konfirmasi Email dan No HP</div>
        <div class="panel-body row">
            <div class="col-md-7">
                <?php
                echo $ucapan->konfirmasi_emailhp;
                ?>

            </div>
            <div class="col-md border-left">
                <table width="100%">
                    <tr>
                        <td>Email Utama</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="email" name="email"
                                value="<?php if(isset($datanya))echo $datanya->email; ?>"></td>
                    </tr>
                    <tr class="text_validation">
                        <td colspan="2" align="right">
                            <p style="color: red;"><small>This is a text validation</small></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Email Lainnya</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="email_lainnya"
                                name="email_lainnya">
                        </td>
                    </tr>
                    <tr class="text_validation">
                        <td colspan="2" align="right">
                            <p style="color: red;"><small>This is a text validation</small></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Handphone Utama</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="no_handpone"
                                name="no_handpone" value="<?php if(isset($datanya))echo $datanya->no_handpone; ?>"></td>
                    </tr>
                    <tr class="text_validation">
                        <td colspan="2" align="right">
                            <p style="color: red;"><small>This is a text validation</small></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Handphone Lainnya</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="handphone_lainnya"
                                name="handphone_lainnya"></td>
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
                            <div class="btn btn-warning" id="add"><span class="fe fe-plus-circle"></span>
                                <div>
                        </td>
                    </tr>
                    <tr class="text_validation">
                        <td colspan="2" align="right">
                            <p style="color: red;"><small>This is a text validation</small></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Opsi Call</td>
                        <td><select name="opsi_call" id="opsi_call" class="form-control">
                                <option value="0">-- Pilih --</option>
                                <option value="1">Telepon Rumah</option>
                                <option value="2">Handphone</option>
                                <option value="3">Email</option>
                                <option value="4">Chat</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="keterangan"
                                name="keterangan" value="<?php if(isset($datanya))echo $datanya->keterangan; ?>">
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
                        <td><input type="text" class="form-control data-sending focus-color" id="facebook"
                                name="facebook"></td>

                    </tr>
                    <tr>
                        <td><span class="fe fe-twitter"></span>Twitter</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="twitter"
                                name="twitter"></td>
                    </tr>
                    <tr>
                        <td><span class="fe fe-instagram"></span>Instagram</td>
                        <td><input type="text" class="form-control data-sending focus-color" id="instagram"
                                name="instagram"></td>
                    </tr>

                </table>

            </div>

        </div>

    </div>
    <div class="panel panel-lte">
        <div class="panel-heading lte-heading-success">Verifikasi</div>
        <div class="panel-body row">
            <div class="col-md-7">
                <?php
                echo $ucapan->verifikasi;
                ?>
            </div>
            <div class="col-md border-left">
                <div class="panel panel-lte">
                    <div class="panel-heading lte-heading-important">Verifikasi</div>
                    <div lass="panel-body">
                        <table width="100%">
                            <tr>
                                <td>Nama</td>
                                <td width="10px"><input type="checkbox" class="data-sending"></td>
                                <td><input type="text" class="form-control data-sending focus-color" id="nama_pastel"
                                        name="nama_pastel"></td>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td width="10px"><input type="checkbox" class="data-sending"></td>
                                <td><textarea class="form-control data-sending focus-color" id="alamat"
                                        name="alamat"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2">kota</td>
                                <td><input type="Text" class="form-control data-sending focus-color" id="kota"
                                        name="kota"></td>
                            </tr>
                            <tr>
                                <td>Kecepatan</td>
                                <td width="10px"><input type="checkbox" class="data-sending"></td>
                                <td><select name="kec_speedy" id="kec_speedy" class="form-control data-sending">
                                        <option value="10">10 Mbps</option>
                                        <option value="20">20 Mbps</option>
                                        <option value="30">30 Mbps</option>
                                        <option value="40">40 Mbps</option>
                                        <option value="50">50 Mbps</option>
                                        <option value="60">60 Mbps</option>
                                        <option value="70">70 Mbps</option>
                                        <option value="80">80 Mbps</option>
                                        <option value="10">90 Mbps</option>
                                        <option value="100">100 Mbps</option>
                                    </select>
                                    <!-- <input type="Text" class="form-control data-sending focus-color" id="kec_speedy"
                                        name="kec_speedy"></td> -->
                            </tr>
                            <tr>
                                <td>Tagihan</td>
                                <td width="10px"><input type="checkbox" class="data-sending"></td>
                                <td><input type="Text" class="form-control data-sending focus-color" id="billing"
                                        name="billing"></td>
                            </tr>
                            <tr>
                                <td>Tempat Bayar</td>
                                <td width="10px"><input type="checkbox" class="data-sending"></td>
                                <td>
                                    <select class="form-control data-sending focus-color" id="payment" name="payment">
                                        <option value="banking">Banking</option>
                                        <option value="ecommerce">E-commerce</option>
                                        <option value="minimarket">Minimarket</option>
                                        <option value="telkom dan pos">Telkom & POS</option>
                                        <option value="others">Others</option>
                                    </select>
                                    <input hidden type="Text" class="form-control data-sending focus-color">
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Pasang</td>
                                <td width="10px"><input type="checkbox" class="data-sending"></td>
                                <td><input type="month" id="waktu_psb" name="waktu_psb"
                                        class="form-control data-sending focus-color"></td>
                            </tr>

                            <tr>
                                <td colspan="3" align="center"><small>--moss--</small></td>

                                </select></td>
                            </tr>
                            <tr>
                                <td>Produk MOSS</td>
                                <td></td>

                                <td><select id="produk_moss" name="produk_moss" class="form-control data-sending">
                                        <option>Pilih Produk Moss</option>
                                        <?php
                                        foreach ($produk_moss as $datamoss){
                                            echo "<option value='$datamoss->kode_chanel'>$datamoss->nama_chanel | $datamoss->harga</option>";
                                        }
                                        ?>
                                    </select></td>
                            </tr>
                            
                            <tr>
                                <td>Jenis Aktivasi</td>
                                <td></td>

                                <td><select id="jenis_aktivasi" name="jenis_aktivasi" class="form-control data-sending">
                                        <option>Pilih Jenis Aktivasi</option>
                                        <option value="langsung">Aktivasi Langsung</option>
                                        <option value="manual">Aktivasi Manual</option>
                                    </select></td>
                            </tr>
                        </table>
                        <div id="labelvalidated" class="panel-footer text-center text-white"
                            style="background-color: #ff0100">Not Valid
                            
                        </div>
                        <div id="labelvalidate" class="panel-footer text-center text-white bg-success">Valid
                        <select id="status_validate" name="status_validate" hidden>
                                <option value="x">select</option>
                                <option value="valid">valid</option>
                                <option value="notvalid">valid</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="panel panel-lte">
        <div class="panel-heading lte-heading-success">Closing</div>
        <div class="panel-body row">
            <div class="col-md-7">
                <?php echo $ucapan->closing?>
            </div>
            <div class="col-md border-left">
                <table width="100%">
                    <tr>
                        <td width="35%">Verifikasi Email</td>
                        <td><a id="byemail">
                                <div class="btn btn-success"><span class="fe fe-mail"> kirim</span></div>
                        </td>
                        <td width="65%">
                            <table width="100%">
                                <tr>
                                    <td width="35%">
                                        <input id="otpemail" name="otpemail" type="Text"
                                            class="form-control data-sending focus-color"  placeholder="C Email">
                                        <input type="hidden" class="form-control" id="code_email" name="code_email"
                                            placeholder="Code Verifikasi Email" style="width:70px;"
                                            value="" />
                                    </td>
                                    <td width="65%">
                                        <i> <label id="lblEmail"
                                                style="font-family:Courier; color:red; font-size: 10px;"></label>
                                            <label id="lblValidEmail"
                                                style="font-family:Courier; color:red; font-size: 10px;"></label></i>
                                        </i>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>Verifikasi HP</td>
                        <td><a id="byphone">
                                <div class="btn btn-success"><span class="fe fe-phone"> kirim</span>
                                </div>
                            </a></td>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td width="35%">
                                        <input id="otpphone" name="otpphone" type="Text"
                                            class="form-control data-sending focus-color"  placeholder="C HP">
                                        <input type="hidden" class="form-control" id="code_handphone"
                                            name="code_handphone" placeholder="Code Verifikasi" style="width:70px;"
                                            value="" />
                                    </td>
                                    <td>
                                        <i><label id="lblHandphone"
                                                style="font-family:Courier; color:red; font-size: 10px;"></label> <label
                                                id="lblValidHandphone"
                                                style="font-family:Courier; color:red; font-size: 10px;"></label></i>
                                    </td width="65%">
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <!-- <tr>
                        <td colspan=3 align="right"></td>
                    </tr> -->
                    <tr style="background-color:#28a745; color: white;">
                        <td colspan=3 align="right"><input type="checkbox" class="bysistem" id="bysistem" value=1
                                name="bysistem"> &nbsp;Verifikasi by sistem &nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=3 align="right">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Kategori Call</td>
                        <td colspan="2"><select class="form-control data-sending focus-color" id="kategori_call"
                                name="kategori_call">
                                <option value="x">Pilih..</option>
                                <option value="1">Contacted</option>
                                <option value="0">Not Contacted</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Sub Kategori Call</td>
                        <div class="skcall" style=" display: none;">

                        </div>
                        <td colspan="2"><select class="form-control data-sending focus-color" id="veri_call"
                                name="veri_call">
                                <option value="Pilih">-- Pilih --</option>
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
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Status Call</td>
                        <td colspan="2"><select name="veri_status" id="veri_status" class="form-control">
                                <option class="veri_statusopt_p" value="Pilih">-- Pilih --</option>
                                <option class="veri_statusopt_v" value="1">Verified</option>
                                <option class="veri_statusopt_nv" value="2">Not Verified</option>
                                <option class="veri_statusopt_dk" value="3">Ditelepon Kembali</option>
                            </select>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <a href="<?php echo $link_back;?>"> <button class="btn btn-cancel pull-undo"> cancel</button></a>
        </div>
        <div class="col-md">
            <button class="btn btn-primary pull-right"><span class="fe fe-save"></span> Submit</button>
        </div>

    </div>
    </div>
</form>


<?php echo card_close() ?>

<?php echo _js('selectize,datepicker') ?>

<script>
var page_version = "1.0.8"
</script>

<script>
$(document).ready(function() {
    $('.text_validation').hide();
});
</script>


<script>
$(document).ready(function() {
    $("#banking").hide();
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

    $('#byncli').click(function(e) {
        $("#form1").submit();
    });

    $('form').submit(function() {
        var relasi = $.trim($('#relasi').val());
        var no_pstn = $.trim($('#no_pstn').val());
        var otpphone = $.trim($('#otpphone').val());
        var no_speedy = $.trim($('#no_speedy').val());
        var no_handpone = $.trim($('#no_handpone').val());
        var nama_pelanggan = $.trim($('#nama_pelanggan').val());
        var ncli = $.trim($('#ncli').val());
        var veri_call = $.trim($('#veri_call').val());
        var veri_status = $.trim($('#veri_status').val());
        if (relasi === 'Pilih') {
            alert('Relasi kepemilikan tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#relasi").offset().top
            }, 100);
            return false;
        } else if (nama_pelanggan === '') {
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
        } else if (veri_call === 'Pilih') {
            alert('Kategori call tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#veri_call").offset().top
            }, 100);
            return false;
        } else if (no_pstn === '') {
            alert('Nomor PSTN tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#no_pstn").offset().top
            }, 100);
            return false;
        } else if (otpphone === '') {
            alert('Kode Verifikasi tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#otpphone").offset().top
            }, 100);
            return false;
        } else if (no_speedy === '') {
            alert('Nomor Speedy tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#no_speedy").offset().top
            }, 100);
            return false;
        } else if (no_handpone === '') {
            alert('Nomor Handphone tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#no_handphone").offset().top
            }, 100);
            return false;
        } else if (veri_status === 'Pilih') {
            alert('status call tidak boleh kosong');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#veri_status").offset().top
            }, 100);
            return false;
        }

        /*
        if(veri_status=='1'){
        		alert(veri_status);
        		var kode_email = $.trim($('#verfi_email').val());
        		var kode_sms = $.trim($('#verfi_handphone').val());
        		return false;
        		if(kode_email=='' && kode_sms==''){
        			alert('Anda tidak dapat menyimpan verified, Karena kode 4 digit tidak terisi');
        			return false;
        		}
        }*/

    });

    $("#no_handpone").keydown(function(e) {
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

    $('#verfi_handphone').blur(function() {
        var code_handphone = $('#code_handphone').val();
        var verfi_handphone = $('#verfi_handphone').val();
        if (verfi_handphone != "") {
            $("#lblValidHandphone").show();
            if (code_handphone != verfi_handphone) {
                $("#lblValidHandphone").html(" - Not Verified");
                $('#verfi_handphone').val("");
            } else {
                $("#lblValidHandphone").html(" - Verified");
            }
        }
    });

    $('#verfi_email').blur(function() {
        var code_email = $('#code_email').val();
        var verfi_email = $('#verfi_email').val();
        if (verfi_email != "") {
            $("#lblValidEmail").show();
            if (code_email != verfi_email) {
                $("#lblValidEmail").html(" - Not Verified");
                $('#verfi_email').val("");
            } else {
                $("#lblValidEmail").html(" - Verified");
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
        } else if (pstn1.val() == "") {
            alert('Nomor Telp Tidak Boleh Kosong');
        } else {
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
                                    $('#otpemail').val(word[2]);
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
        } else if (handphone.val() == "") {
            alert('Nomor handphone Tidak Boleh Kosong');
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
                        $("#lblHandphone").show();
                        $('#lblHandphone').html(word[5] + " ");
                        var msg = "Kode verifikasi data Anda adalah " + word[2] +
                            " silakan infokan kepada petugas  kami yang sedang menghubungi Bpk/Ibu. Tks";
                        alert('Kode Verifikasi SMS sudah terkirim');
                        

                        $('#bysistem').click(function() {
                            if ($('input.bysistem').is(':checked')) {
                                //alert('asdfasdf');
                                $('#otpphone').val(word[2]);
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
$(document).ready(function() {

    $("#add").click(function() {
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $(
            "<td width=\"100%\"><input type=\"text\" id=\"hptambahan" + intId +
            "\" name=\"hptambahan" + intId +
            "\" class=\"fieldname form-control data-sending focus-color\" /></td>"
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
    // $("#preview").click(function() {
    //     $("#yourform").remove();
    //     var fieldSet = $("<fieldset id=\"yourform\"><legend>Your Form</legend></fieldset>");
    //     $("#buildyourform div").each(function() {
    //         var id = "input" + $(this).attr("id").replace("field", "");
    //         var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname").first()
    //             .val() + "</label>");
    //         var input;
    //         switch ($(this).find("select.fieldtype").first().val()) {
    //             case "checkbox":
    //                 input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id +
    //                     "\" />");
    //                 break;
    //             case "textbox":
    //                 input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id + "\" />");
    //                 break;
    //             case "textarea":
    //                 input = $("<textarea id=\"" + id + "\" name=\"" + id + "\" ></textarea>");
    //                 break;
    //         }
    //         fieldSet.append(label);
    //         fieldSet.append(input);
    //     });
    //     $("body").append(fieldSet);
    // });
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
    }
    //     $('.opsicontacted').hide(); // hide div if value is not "custom"
    //     $('.opsinc').show(); // hide div if value is not "custom"
});




var countChecked = function() {
    var n = $("input:checked").length;
    var valid =
        '<option selected="selected" value=""> --Pilih-- </option><option value="1">Verified</option><option value="3">Ditelepon kembali</option>';
    var notvalid =
        '<option value="Pilih"> --Pilih-- </option><option value="2" selected="selected">Not Verified</option><option value="3" >Ditelepon kembali</option>';

    if (n > 3) {
        $("#labelvalidate").show();
        //$("#veri_status").children("option[value=1]").show());
        $("#labelvalidated").hide();
        $('[name=status_validate]').val("valid");
    } else {
        $("#labelvalidate").hide();
        //$("#veri_status").children("option[value=1]").show());
        $("#labelvalidated").show();
    }
};
countChecked();
$("input[type=checkbox]").on("click", countChecked);
</script>