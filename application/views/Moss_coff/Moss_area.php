<?php echo _css('datatables,icheck') ?>
<?php
function convert_to_s($val)
{
    $newval = explode(":", $val);
    $jam = $newval[0] * 3600;
    $menit = $newval[1] * 60;
    $detik = $newval[2];
    $newformat = $jam + $menit + $detik;
    return $newformat;
}
?>
<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>
            <table class='display nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <td>Interval</td>
                        <td>COF</td>
                        <td>SLG</td>
                        <td>SLFC</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($waktu as $datana) {

                    ?>
                        <tr>
                            <td><?php echo $datana ?></td>
                            <td><?php if (isset($coff['jml_data'][$datana])) {
                                    echo $coff['jml_data'][$datana];
                                } else {
                                    echo 0;
                                };
                                ?></td>
                            <td><?php echo convert_to_s($coff['SLG'][$datana]);
                                ?></td>
                            <td><?php echo convert_to_s($coff['SLFC'][$datana]);
                                ?></td>
                        </tr>
                    <?php

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
                "paging": false,
                "ordering": false,
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