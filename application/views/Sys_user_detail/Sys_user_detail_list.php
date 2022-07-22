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
                        <th><b>Perner</b></th>
						<th><b>Nama Agent</b></th>
						<th><b>No HP</b></th>
						<th><b>Email</b></th>
                        <th><b>Tempat Tgl Lahir</b></th>
                        <th><b>Tanggal Gabung</b></th>
                        <th><b>Jenis Kelamin</b></th>
                       
                        
                        <th><b>Status</b></th>
                        <th><b>Alamat</b></th>

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
                                    <a href="<?php echo base_url()."Sys_user_detail/Sys_user_detail/detail/".$datana['id'] ?>" class="btn btn-default text-red btn-sm " title="detail"><i class="fa fa-info"></i></a>
                                    <a href="<?php echo $link_update . "/" . $datana['id'] ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo $link_delete . "/" . $datana['id'] ?>" class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php echo $datana['id']; ?>)"><i class="fa fa-trash"></i></a>
                                </td>
								<td><?php echo $datana['perner']; ?></td>
								<td><?php echo $datana['nama_lengkap']; ?></td>
								<td><?php echo $datana['no_hp']; ?></td>
								<td><?php echo $datana['email']; ?></td>
                                <td><?php echo $datana['tempat_lahir'] . ", " . $datana['tanggal_lahir']; ?></td>
                                <td><?php echo $datana['tanggal_gabung']; ?></td>
                                <td><?php echo $datana['jenis_kelamin']; ?></td>
                               
                                
                                <td><?php echo $datana['status_perkawinan']; ?></td>
                                <td><?php echo $datana['alamat']; ?></td>
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