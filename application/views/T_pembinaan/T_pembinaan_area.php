<?php echo _css('datatables,icheck') ?>
<?php echo card_open('Tambah Rekap Pembinaan', 'bg-green', true) ?>

<div class='box-body table-responsive' id='box-table'>
    <a href="<?php echo base_url() ?>T_pembinaan/T_pembinaan/create"><input type="button" class="btn btn-primary" value="Tambah"></a>

    <small>
        <table class='display responsive' id="example" style="width: 100%;">
            <thead>
                <tr>
                    <th style="font-size: 12px"><b>No</b></th>
                    <th style="font-size: 12px"><b>Opsi</b></th>
                    <th style="font-size: 12px"><b>Agent</b></th>
                    <th style="font-size: 12px"><b>TL</b></th>
                    <th style="font-size: 12px"><b>Tanggal Pembinaan</b></th>
                    <th style="font-size: 12px"><b>Tingkat Pembinaan</b></th>
                    <th style="font-size: 12px"><b>Keterangan</b></th>


                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                foreach ($tpembinaan as $datana) {

                ?>
                    <tr>
                        <td style="font-size: 11px"><?php echo $nomor; ?></td>
                        <td style="font-size: 11px">
                            <!-- <a href="<?php echo base_url() . "T_pembinaan/T_pembinaan/detail/" . $datana['id'] ?>" class="btn btn-default text-red btn-sm " title="detail"><i class="fa fa-info"></i></a> -->
                            <a href="<?php echo $link_update . "/" . $datana['id'] ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>
                            <div class="hapus btn btn-default text-red btn-sm" id="<?php echo $datana['id'] ?>"><span class="fa fa-trash"></span></div>
                            <!-- <a href="
							<?php //echo $link_delete . "/" . $datana['idx'] 
                            ?>
							" class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php // echo $datana['id']; 
                                                                                                            ?>)"><i class="fa fa-trash"></i></a> -->


                        </td>
                        <?php
                        $dtaagn = $controller->db->query("SELECT nama, tl FROM sys_user WHERE agentid='" . $datana['agentid'] . "'")->row();
                        ?>
                        <td style="font-size: 11px"><?php echo $dtaagn->nama ?></td>
                        <td style="font-size: 11px"><?php echo $dtaagn->tl ?></td>
                        <td style="font-size: 11px"><?php echo $datana['tanggal_pembinaan']; ?></td>
                        <td style="font-size: 11px"><?php echo $datana['tingkat_pembinaan']; ?></td>
                        <td style="font-size: 11px"><?php echo $datana['keterangan']; ?></td>

                    </tr>
                <?php
                    $nomor++;
                }
                ?>
            </tbody>
        </table>

        <div hidden>
            <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger' id='button_delete_single'></button>
        </div>
    </small>
</div>
<hr>
<div class="row">
    <div class='box-body table-responsive col-6' id='box-table'>
        <small>
            <table class='display nowrap' id="report" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="font-size: 12px"><b>No</b></th>
                        <th style="font-size: 12px"><b>Opsi</b></th>
                        <th style="font-size: 12px"><b>Agent</b></th>
                        <th style="font-size: 12px"><b>TL</b></th>
                        <th style="font-size: 12px"><b>Jumlah Pembinaan</b></th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($list_agent_d['results'] as $datanya) {

                    ?>
                        <tr>
                            <td style="font-size: 11px"><?php echo $nomor; ?></td>
                            <td style="font-size: 11px">
                                <input type="button" value='detail' id='<?php echo $datanya->agentid ?>' class='detaileds'>

                            </td>
                            <?php
                            $jml = $controller->db->query("SELECT COUNT(*) as jml FROM t_pembinaan WHERE agentid='" . $datanya->agentid . "' AND jenis is null")->row();
                            ?>
                            <td style="font-size: 11px"><?php echo $datanya->nama ?></td>
                            <td style="font-size: 11px"><?php echo $datanya->tl ?></td>
                            <td style="font-size: 11px"><?php echo $jml->jml ?></td>

                        </tr>
                    <?php
                        $nomor++;
                    }
                    ?>
                </tbody>
            </table>

            <div hidden>
                <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger' id='button_delete_single'></button>
            </div>
        </small>
    </div>
    <div class='col-md' id='detail-agent'>
        <div id="datadetailedpembinaan">

        </div>

    </div>


    <?php echo card_close() ?>

    <?php echo _js('datatables,icheck') ?>

    <script>
        var page_version = "1.0.8"
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#example").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf'
                ]
            });
        });
        $(document).ready(function() {
            $("#report").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf'
                ]
            });
        });
        $("#report").on("click", ".detaileds", function() {
            var agentid = $(this).attr('id');
            $.ajax({
                url: "<?php echo base_url() . "T_pembinaan/T_pembinaan/get_detailed" ?>",
                data: {
                    agentid: agentid
                },
                methode: "get",
                success: function(response) {
                    $("#datadetailedpembinaan").html(response);
                    // fetch_item_data();
                }
            });
        });
        // $(document).ready(function() {
        //     $(".detaileds").click(function() {
        //         var agentid = $(this).attr('id');
        //         $.ajax({
        //             url: "<?php echo base_url() . "T_pembinaan/T_pembinaan/get_detailed" ?>",
        //             data: {
        //                 agentid: agentid
        //             },
        //             methode: "get",
        //             success: function(response) {
        //                 $("#datadetailedpembinaan").html(response);
        //                 // fetch_item_data();
        //             }
        //         });
        //     });
        // })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example tbody').on('click', 'tr td div.hapus', function() {
                // $('.hapus').click(function() {
                if (confirm("Are you sure?")) {
                    var del_id = $(this).attr('id');
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>T_pembinaan/T_pembinaan/deletekasus',
                        data: {
                            'del_id': del_id
                        },
                        success: function(data) {
                            location.reload();
                        }


                    });
                }
                return false;
            });
        });
    </script>