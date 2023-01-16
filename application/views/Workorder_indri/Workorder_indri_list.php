<?php echo _css('datatables') ?>

<?php echo card_open('List Workorder Indri', 'bg-teal', true) ?>
<div class='row'>
    <!-- <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div> -->
</div>

<div class="card-body">
    <a href="<?php echo base_url();?>Workorder_indri/Workorder_indri/get"><button id="submitbutton" onclick="document.getElementById('submitbutton').disabled = true;document.getElementById('submitbutton').style.opacity='0.5';" class="btn btn-success pull-left" style="margin-top: -40px;margin-bottom: 20px;"><span class="fa fa-plus-circle"></span> Tambah Workorder Indri</button></a>

    <div class='box-body ' id='box-table'>
        <small>
            <table class='responsive display nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th><b>No</b></th>                 
                        <th><b>No Internet</b></th>
                        <th><b>No Indri</b></th>
                         <th><b>NCLI</b></th>
                        <th><b>Nama Pelanggan</b></th>
                        <th><b>Nomer HP</b></th>
                        <th><b>Email</b></th>
                        <th><b>souce</b></th>
                        <th><b>Keterangan</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list_outbound as $datana) {
                    ?>
                        <tr>
                            <td><?php echo $no?></td>
                            <td><a class='btn btn-primary' href='<?php echo base_url()?>Workorder_indri/Workorder_indri/edit?id=<?php echo $datana->id?>' target='_blank'><?php echo $datana->no_internet?></a></td>
                            <td><?php echo $datana->no_indri?></td>
                            <td><?php echo $datana->ncli?></td>
                            <td><?php echo $datana->v_nama?></td>
                            <td><?php echo $datana->no_hp?></td>
                            <td><?php echo $datana->email_utama?></td>
                            <td><?php echo $datana->sumber?></td>
                            <td><?php echo $datana->keterangan?></td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>


                </tbody>
            </table>
        </small>
    </div>
</div>

<?php echo card_close() ?>
<?php echo _js('datatables') ?>
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

    <?php //MEMBUAT INPUT SEARCH  
    ?>
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