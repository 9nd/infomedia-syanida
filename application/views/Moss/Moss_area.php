<?php echo _css('datatables,icheck') ?>

<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>
            <table class='display responsive nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th>NO </th>
                        <th>ncli </th>
                        <th>no_pstn </th>
                        <th>relasi </th>
                        <th>no_speedy </th>
                        <th>nama_pelanggan </th>
                        <th>no_handpone </th>
                        <th>email </th>
                        <th>nama_pastel </th>
                        <th>alamat </th>
                        <th>kota </th>
                        <th>regional </th>
                        <th>update_by </th>
                        <th>TGL_KELUAR</th>
                        <th>Jam_keluar</th>
                        <th>sumber </th>
                        <th>TGL_Masuk</th>
                        <th>Jam_Masuk</th>
                        <th>SLG</th>
                        <th>layanan </th>
                        <th>reason_call </th>
                        <th>STATUS </th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;


                    ?>
                   
                        <?php
                        foreach ($moss as $datana) {
                            echo "<tr>";
                            echo "<td style='font-size: 11px'>" . $no . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->ncli . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->no_pstn . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->relasi . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->no_speedy . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->nama_pelanggan . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->no_handpone . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->email . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->nama_pastel . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->alamat . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->kota . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->regional . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->update_by . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->TGL_Keluar . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->Jam_Keluar . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->sumber . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->TGL_Masuk . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->Jam_Masuk . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->SLG . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->layanan . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->reason_call . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->STATUS . "</td>";
                            echo "<td style='font-size: 11px'>" . $datana->keterangan . "</td>";
                            echo "</tr>";
                            $no++;
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