<?php echo _css('datatables,icheck') ?>

<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>
            <table class='display responsive nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="font-size: 12px"><b>No</b></th>
                        <th style="font-size: 12px"><b>Option</b></th>
                        <th style="font-size: 12px"><b>NCLI</b></th>
                        <th style="font-size: 12px"><b>NO PSTN</b></th>
                        <th style="font-size: 12px"><b>No Speedy</b></th>
                        <th style="font-size: 12px"><b>Nama Pelanggan</b></th>
                        <th style="font-size: 12px"><b>Email</b></th>
                        <th style="font-size: 12px"><b>No Handphone</b></th>
                        <th style="font-size: 12px"><b>Reason Call</b></th>
                        <th style="font-size: 12px"><b>UpdateBY</b></th>
                        <th style="font-size: 12px"><b>LUP</b></th>
                        <th style="font-size: 12px"><b>Keterangan</b></th>

                        <th style="font-size: 12px"><b>Copy</b></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($indibox as $datana) {

                    ?>
                        <tr>
                            <td style="font-size: 11px"><?php echo $nomor; ?></td>
                            <td style="font-size: 11px">
                                <a href="<?php echo base_url() . "Landing_page/Landing_page/detail/" . $datana['idx'] ?>" class="btn btn-default text-red btn-sm " title="detail"><i class="fa fa-info"></i></a>
                                <a href="<?php echo $link_update . "/" . $datana['idx'] ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>
                                <!-- <a href="
							<?php //echo $link_delete . "/" . $datana['idx'] 
                            ?>
							" class="btn btn-default text-red btn-sm" title="delete" onclick="deleteItem(<?php // echo $datana['id']; 
                                                                                                            ?>)"><i class="fa fa-trash"></i></a> -->


                            </td>

                            <td style="font-size: 11px"><?php echo $datana['ncli']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['no_pstn']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['no_speedy']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['nama_pelanggan']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['email']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['no_handpone']; ?></td>
                            <td style="font-size: 11px"><?php $rscall = $datana['reason_call'];
                                                        $stats = $Status_call_model->get_by_id($rscall);
                                                        echo $stats->nama_reason;
                                                        ?></td>
                            <td style="font-size: 11px"><?php echo $datana['update_by']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['lup']; ?></td>
                            <td style="font-size: 11px"><?php echo $datana['keterangan']; ?></td>


                            <td>
                                <div onClick='copyText(this)'>
                                    <!-- <a href="javascript:void(0)" onclick="copypaste<?php echo $datana['idx']; ?>()">
                                        <div class="btn-sm btn-warning"><i class="fa fa-copy"></i> Copy No HP</div>
                                    </a> -->
                                    <br>
                                    No PSTN : <?php echo $datana['no_pstn']; ?><br>
                                    No Inet : <?php echo $datana['no_speedy']; ?><br>
                                    Nama Pelanggan : <?php echo $datana['nama_pelanggan']; ?><br>
                                    Relasi : <?php echo $datana['relasi']; ?><br>
                                    Nama Pastel : <?php echo $datana['nama_pastel']; ?><br>
                                    NO HP : <?php echo $datana['no_handpone']; ?><br>
                                    Email : <?php echo $datana['email']; ?><br>
                                    Alamat : <?php echo $datana['alamat']; ?><br>                                   
                                    Kecepatan : <?php echo $datana['kecepatan']; ?><br>
                                    Tagihan : <?php echo $datana['tagihan']; ?><br>
                                    Tahun Pemasangan : <?php echo $datana['tahun_pemasangan']; ?><br>
                                    Lokasi Pembayaran : <?php echo $datana['tempat_bayar']; ?><br>
                                </div>
                            </td>
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
    </script>

    <script>
        function deleteItem() {
            if (confirm("anda ingin hapus data ini?")) {
                // your deletion code
            }
            return false;
        }
    </script>
    <script>
        function copyText(element) {
            var range, selection, worked;

            if (document.body.createTextRange) {
                range = document.body.createTextRange();
                range.moveToElementText(element);
                range.select();
            } else if (window.getSelection) {
                selection = window.getSelection();
                range = document.createRange();
                range.selectNodeContents(element);
                selection.removeAllRanges();
                selection.addRange(range);
            }

            try {
                document.execCommand('copy');
                alert('text copied');
            } catch (err) {
                alert('unable to copy text');
            }
        }
    </script>