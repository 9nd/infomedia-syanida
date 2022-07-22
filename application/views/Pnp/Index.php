<?php
// echo "INFORMATION DAPROS";
?>
<div class="col-sm-12 col-lg-12">


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Upload File PNP</h3>
        </div>
        <div class="card-body">
            <div class="dimmer" id="box-upload">

                <div class="loader align-bottom text-center" style="width:200px">mohon tunggu..</div>
                <div class="dimmer-content">
                    <form id="form-a" action="<?php echo base_url() ?>Pnp/Pnp/upload_template_user" method="post" enctype="multipart/form-data">
                        <div class='form-group'>
                            <label class='form-label'>Judul</label>
                            <input type="text" class="form-control " value="<?php echo $datanya->judul; ?>" id="judul" name="judul">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>waktu_mulai</label>
                            <input type="datetime-local" class="form-control " value="<?php echo $datanya->waktu_mulai; ?>" id="waktu_mulai" name="waktu_mulai">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>waktu_selesai</label>
                            <input type="datetime-local" class="form-control " value="<?php echo $datanya->waktu_selesai; ?>" id="waktu_selesai" name="waktu_selesai">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>durasi_waktu *Dalam Menit</label>
                            <input type="number" class="form-control " value="<?php echo $datanya->durasi_waktu; ?>" id="durasi_waktu" name="durasi_waktu">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>tanggal</label>
                            <input type="date" class="form-control " value="<?php echo $datanya->tanggal; ?>" id="tanggal" name="tanggal">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>catatan</label>
                            <input type="text" class="form-control " value="<?php echo $datanya->catatan; ?>" id="catatan" name="catatan">

                        </div>
                        <div class='form-group'>
                            <label class='form-label'>jumlah_soal</label>
                            <input type="text" class="form-control " value="<?php echo $datanya->jumlah_soal; ?>" id="jumlah_soal" name="jumlah_soal">

                        </div>
                        <!--<div class="form-label ">Upload File Template</div>-->
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input " id="inputfile" name="inputfile">
                            <label class="custom-file-label form-control" id="label-input-file">Choose file </label>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url() ?>Pnp/Pnp">
                                    <div class="btn btn-default pull-left"> cancel</div>
                                </a>
                            </div>
                            <div class="col-md">
                                <button type="submit" id="submits" class="submit btn btn-primary pull-right"><span class="fe fe-save"></span> Submit</button>
                            </div>

                        </div>
                    </form>



                </div>


            </div>
        </div>
    </div>
    
</div>



<script>
    $(document).ready(function() {


    });
</script>