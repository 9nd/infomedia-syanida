<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <?php echo form_open_multipart('kelola_dokumen/kelola/tambah'); ?>
                <div class="custom-file">
                    <label>Dokumen</label>
                    <input type="file" name="dokumen" class="form-control" id="dokumen" required>
                </div><br><br>
                <!-- <div class="form-group">
                    <label for="jenis_dokumen">Jenis Dokumen</label>
                    <select class="form-control" id="jenis_dokumen" name="jenis_dokumen">
                        <option>-- Pilih --</option>
                        <option value="Png">Png</option>
                        <option value="Jpg">Jpg</option>
                        <option value="Docx">Docx</option>
                        <option value="Pdf">Pdf</option>
                        <option value="Xlsx">Xlsx</option>
                    </select>
                </div> -->
                <div class="form-group">
                    <label for="nama_dokumen">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" class="form-control" id="nama_dokumen">
                    <small class="form-text text-danger"><?= form_error('nama_dokumen'); ?></small>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea type="text" name="keterangan" class="form-control" id="keterangan"></textarea>
                    <small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>