<?php echo _css('datatables,icheck') ?>

<div class="card-body">
    <div class='box-body table-responsive' id='box-table'>
        <small>
            <table class='display responsive nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <?php
                        foreach ($fmoss as $field) {
                            echo " <th style='font-size: 12px'><b>" . $field . "</b></th>";
                        }
                        ?>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $nomor = 1;
                    foreach ($moss as $datana) {

                    ?>
                        <tr>
                            <?php
                            foreach ($fmoss as $field) {
                                echo " <td style='font-size: 11px'>".$datana[$field]."</td>";
                            }
                            ?>
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