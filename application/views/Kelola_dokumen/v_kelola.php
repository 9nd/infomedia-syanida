<?php if ($this->session->flashdata('flash')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data
        <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="content">
        <div class="container-fluid">
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('kelola/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i> Tambah Data</a>
                <!-- <a href="<?= base_url('') ?>" class="btn btn-danger btn-sm"><i class="fas fa-print"></i> Print</a> -->

            </div>

            <div style="margin-top: 50px;">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Sortir Jenis Dokumen</label>
                        <select class="form-control jenis_dokumen" name="">
                            <option>-- Pilih --</option>
                            <option value="Png">Png</option>
                            <option value="Jpg">Jpg</option>
                            <option value="Doc">Doc</option>
                            <option value="Pdf">Pdf</option>
                            <option value="Xls">Xls</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="tabelData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dokumen</th>
                            <th>Jenis Dokumen</th>
                            <th>Nama Dokumen</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 1;
                        foreach ($tbl_coba as $c) : ?>
                            <tr>
                                <td><?= $id++ ?></td>
                                <td><?= $c->dokumen ?></td>
                                <td><?= $c->jenis_dokumen ?></td>
                                <td><?= $c->nama_dokumen ?></td>
                                <td><?= $c->keterangan ?></td>
                                <td>
                                    <a href="<?= base_url('kelola/edit/' . $c->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('kelola/hapus/' . $c->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><i class="fas fa-trash"></i></a>
                                    <a target='_blank' href="<?= base_url('kelola/download/?dokumen=' . $c->dokumen) ?>" class="btn btn-secondary btn-sm"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>