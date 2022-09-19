<?php echo _css('datatables,icheck') ?>

<?php echo card_open('List Agent Profile', 'bg-teal', true) ?>
<div class='row'>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div>
</div>

<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>

            <table class='display responsive nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th><b>No</b></th>
                        <th><b>Opsi</b></th>
                        <th><b>Nama Agent</b></th>
                        <th><b>Tempat Lahir</b></th>
                        <th><b>Tgl Lahir</b></th>
                        <th><b>Tanggal Gabung</b></th>
                        <th><b>Jenis Kelamin</b></th>
                        <th><b>email</b></th>
                        <th><b>status_perkawinan</b></th>
                        <th><b>kelurahan</b></th>
                        <th><b>kecamatan</b></th>
                        <th><b>kabupaten_kota</b></th>
                        <th><b>provinsi</b></th>
                        <th><b>no_hp</b></th>
                        <th><b>no_hp_lain</b></th>
                        <th><b>no_ktp</b></th>
                        <th><b>pendidikan</b></th>
                        <th><b>jurusan</b></th>
                        <th><b>sekolah</b></th>
                        <th><b>tahun_lulus</b></th>
                        <th><b>no_rekening</b></th>
                        <th><b>nama_bank</b></th>
                        <th><b>npwp</b></th>
                        <th><b>perner</b></th>
                        <th><b>no_pkwt</b></th>
                        <th><b>nama_lengkap</b></th>
                        <th><b>alamat_kosan</b></th>
                        <th><b>nama_sutri</b></th>
                        <th><b>tanggal_menikah</b></th>
                        <th><b>tanggal_lhrsutri</b></th>
                        <th><b>jml_anak</b></th>
                        <th><b>u_anakterakhir</b></th>
                        <th><b>emergency_kontak</b></th>
                        <th><b>nama_emergency</b></th>
                        <th><b>nomor_emergency</b></th>
                        <th><b>bank_an</b></th>
                        <th><b>npwp_nama</b></th>
                        <th><b>bpjs_ket</b></th>
                        <th><b>bpjs_kes</b></th>
                        <th><b>tanggal_akhir</b></th>
                        <th><b>fb</b></th>
                        <th><b>twitter</b></th>
                        <th><b>ig</b></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;

                    if ($agentcount > 0) {
                        foreach ($agent as $datana) {
                    ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td> 
                                    <a href="<?php echo base_url()."Sys_user_detail/Sys_user_detail/detail?id=".$datana['id'] ?>" class="btn btn-default text-red btn-sm " title="detail"><i class="fa fa-info"></i></a>
                                    <a href="<?php echo $link_update . "/" . $datana['id'] ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo $link_delete . "/" . $datana['id'] ?>" class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php echo $datana['id']; ?>)"><i class="fa fa-trash"></i></a>
                                </td>
                                <td><?php echo $datana['nama_lengkap']; ?></td>
                                <td><?php echo $datana['tempat_lahir']; ?></td>
                                <td><?php echo $datana['tanggal_lahir']; ?></td>
                                <td><?php echo $datana['tanggal_gabung']; ?></td>
                                <td><?php echo $datana['jenis_kelamin']; ?></td>
                                <td><?php echo $datana['email']; ?></td>
                                <td><?php echo $datana['status_perkawinan']; ?></td>
                                <td><?php echo $datana['kelurahan']; ?></td>
                                <td><?php echo $datana['kecamatan']; ?></td>
                                <td><?php echo $datana['kabupaten_kota']; ?></td>
                                <td><?php echo $datana['provinsi']; ?></td>
                                <td><?php echo $datana['no_hp']; ?></td>
                                <td><?php echo $datana['no_hp_lain']; ?></td>
                                <td><?php echo $datana['no_ktp']; ?></td>
                                <td><?php echo $datana['pendidikan']; ?></td>
                                <td><?php echo $datana['jurusan']; ?></td>
                                <td><?php echo $datana['sekolah']; ?></td>
                                <td><?php echo $datana['tahun_lulus']; ?></td>
                                <td><?php echo $datana['no_rekening']; ?></td>
                                <td><?php echo $datana['nama_bank']; ?></td>
                                <td><?php echo $datana['npwp']; ?></td>
                                <td><?php echo $datana['perner']; ?></td>
                                <td><?php echo $datana['no_pkwt']; ?></td>
                                <td><?php echo $datana['nama_lengkap']; ?></td>
                                <td><?php echo $datana['alamat_kosan']; ?></td>
                                <td><?php echo $datana['nama_sutri']; ?></td>
                                <td><?php echo $datana['tanggal_menikah']; ?></td>
                                <td><?php echo $datana['tanggal_lhrsutri']; ?></td>
                                <td><?php echo $datana['jml_anak']; ?></td>
                                <td><?php echo $datana['u_anakterakhir']; ?></td>
                                <td><?php echo $datana['emergency_kontak']; ?></td>
                                <td><?php echo $datana['nama_emergency']; ?></td>
                                <td><?php echo $datana['nomor_emergency']; ?></td>
                                <td><?php echo $datana['bank_an']; ?></td>
                                <td><?php echo $datana['npwp_nama']; ?></td>
                                <td><?php echo $datana['bpjs_ket']; ?></td>
                                <td><?php echo $datana['bpjs_kes']; ?></td>
                                <td><?php echo $datana['tanggal_akhir']; ?></td>
                                <td><?php echo $datana['fb']; ?></td>
                                <td><?php echo $datana['twitter']; ?></td>
                                <td><?php echo $datana['ig']; ?></td>
                            </tr>
                    <?php
                            $nomor++;
                        }
                    } else {
                        echo "<td colspan='10'>Tidak ada data</td>";
                    }
                    ?>
                </tbody>
            </table>
        </small>
    </div>
</div>

<?php echo card_close() ?>
<?php echo _js('datatables,icheck') ?>
<script>
    var page_version = "1.0.8"
</script>
<script>
     $(document).ready(function() {
      
        $("#example").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    });
    function deleteItem() {
        if (confirm("anda ingin hapus data ini?")) {
            // your deletion code
        }
        return false;
    }
</script>
<script>
    var resp_table = true;
    var table_detail;
    $(document).ready(function() {

        $('#hscroll-table').prop('checked', true);
        set_scroll_table();

        $('#hscroll-table').change(function() {
            set_scroll_table();
        });

    });

    function set_scroll_table() {
        resp_table = !$('#hscroll-table').prop('checked');
        refresh_table();
    }

    <?php //MEMBUAT INPUT SEARCH  
    ?>
    $('#table-detail thead tr').clone(true).appendTo('#table-detail thead');
    $('#table-detail thead tr:eq(1) th').each(function(i) {
        if ($(this).hasClass('nst')) {
            $(this).html('');
        } else {
            var bb = '<input hidden  type="text" placeholder=" filter by.." class="column-search" data_index="' + i + '"/>';
            $(this).html(bb);
        }
    });



    


    $('#btn-delete').click(function() {
        ybsDeleteTableChecked('<?php echo $link_delete ?>', '#table-detail');
    });
</script>