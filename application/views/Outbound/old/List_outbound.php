<?php echo _css('datatables,icheck') ?>

<?php echo card_open('List Agent Profile', 'bg-teal', true) ?>
<div class='row'>
    <!-- <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div> -->
</div>

<div class="card-body">
    <a href="<?php echo base_url()?>Outbound/Outbound/get"><button class="btn btn-success pull-left" style="margin-top: -40px;margin-bottom: 20px;"><span class="fa fa-plus-circle"></span> Get Data Profilling</button></a>

    <div class='box-body table-responsive' id='box-table'>
        <small>

            <table class='display responsive nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th><b>No</b></th>
                        <th><b>NCLI</b></th>
                        <th><b>No PSTN</b></th>
                        <th><b>DM</b></th>
                        <th><b>Nama</b></th>
                        <th><b>Nama Pastel</b></th>
                        <th><b>Nomer HP</b></th>
                        <th><b>Email</b></th>
                        <th><b>Verifikasi</b></th>
                        <th><b>Keterangan</b></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;

                    if ($list_count->hitung > 0) {
                        foreach ($list_outbound as $datana) {
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td>
                            <a target="_blank"
                                href="<?php echo base_url()?>Outbound/Outbound/edit?phone=<?php echo $datana->no_pstn;?>&ncli=<?php echo $datana->ncli;?>"><span
                                    class="btn btn-primary"><?php echo $datana->ncli;?></span></a>
                        </td>
                        <td><?php echo $datana->no_pstn;?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $datana->nama_pastel;?></td>
                        <td><?php echo $datana->no_handpone;?></td>
                        <td><?php echo $datana->email;?></td>
                        <td><?php echo $datana->STATUS;?></td>
                        <td><?php echo $datana->keterangan;?></td>
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
    $('#example').DataTable();
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

<
?
php //MEMBUAT INPUT SEARCH  
    ?
    >
    $('#table-detail thead tr').clone(true).appendTo('#table-detail thead');
$('#table-detail thead tr:eq(1) th').each(function(i) {
    if ($(this).hasClass('nst')) {
        $(this).html('');
    } else {
        var bb = '<input hidden  type="text" placeholder=" filter by.." class="column-search" data_index="' +
            i + '"/>';
        $(this).html(bb);
    }
});






$('#btn-delete').click(function() {
    ybsDeleteTableChecked('<?php echo $link_delete ?>', '#table-detail');
});
</script>