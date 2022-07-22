<?php echo _css('datatables,icheck') ?>

<div class="card "><div class="card-status bg-teal"></div><div class="card-header"><h3 class="card-title">List MOS &nbsp; &nbsp; &nbsp;</h3><span class="label btn btn-success" id="lblatas">0</span><div class="card-options"><a href="javascript:void(0)" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a></div></div><div class="card-body">
<div class='row'>
    <!-- <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
        
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div> -->
    
</div>

<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>

            <table class='display responsive nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th><b>No</b></th>
                        <th><b>NCLI</b></th>
                        <th><b>No PSTN</b></th>
                        <th><b>No Indihome</b></th>
                        <th><b>Nama Pastel</b></th>
                        <th><b>Handphone</b></th>
                        <th><b>Email</b></th>
                        <th><b>Layanan</b></th>
                        <th><b>Lup</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;


                    foreach ($list_outbound as $datana) {
                    ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td>
                                <a target="_blank" href="<?php echo base_url() ?>Outbound/Outbound/edit?idx=<?php echo $datana->idx ?>&phone=<?php echo $datana->no_pstn; ?>&ncli=<?php echo $datana->ncli; ?>&hp=<?php echo $datana->no_handpone; ?>"><span class="btn btn-primary"><?php echo $datana->ncli; ?></span></a>
                            </td>
                            <td><?php echo $datana->no_pstn; ?></td>
                            <td></td>
                            <td><?php echo $datana->nama_pastel; ?></td>
                            <td><?php echo $datana->no_handpone; ?></td>
                            <td><?php echo $datana->email; ?></td>
                            <td><?php echo $datana->layanan; ?></td>
                            <td><?php echo $datana->tgl_insert; ?></td>
                        </tr>
                    <?php
                        $nomor++;
                    }
                    // } else {
                    //     echo "<td colspan='10'>Tidak ada data</td>";

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

        function refresh_div() {
            $.ajax({
                url: '<?php echo base_url() ?>Outbound/Outbound/get_list_mos',
                type: 'POST',
                success: function(results) {
                    $("#lblatas").html(results);
                    $("#lblbawah").html(results);
                }
            });
        }
        t = setInterval(refresh_div, 1000);
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