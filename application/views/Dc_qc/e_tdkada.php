<div class="m-3">
    <b>List Table Verified Email "tdkada@gmail.com" <?php echo $_GET['date'] ?></b>
    <table id="datalist" class="table dataTable table-striped table-bordered display responsive nowrap" width="100%">
        <thead>
            <tr style="height: 5px; font-size: 10px;">
                <th>No</th>
                <th>Opsi</th>
                <th>NCLI</th>
                <th>NO Internet</th>
                <th>PSTN</th>
                <th>Nama Pelanggan</th>
                <th>HP 1</th>
                <th>Email 1</th>
                <th>HP 2</th>
                <th>Email 2</th>
                <th>Tanggal Verifikasi</th>
                <th>Σ Multi Inet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($tabledata as $vtabledata) {

            ?>
                <tr style="height: 5px; font-size: 8px;">
                    <td><?php echo $no; ?></td>
                    <!-- <td align="center"><a href="<?php echo base_url() ?>dc_qc/dc_qc/form_revalidate?sumber=obc&idx=<?php echo $vtabledata->idx ?>&ncli=<?php echo $vtabledata->ncli; ?>&no_speedy=<?php echo $vtabledata->no_speedy; ?>&lup=<?php echo $vtabledata->lup; ?>" target="_blank"><button class="btn btn-outline-danger mb-2">Re-Validate</button></a></td> -->
                    <td><button class="btn btn-outline-danger mb-2 addedBtn" id="<?php echo $vtabledata->idx . "_obc_" . $vtabledata->ncli . "_" . $vtabledata->no_speedy; ?>" onClick="prompt_revalidate(this.id)">Re-Validate</button></td>
                    <td><?php echo $vtabledata->ncli; ?></td>
                    <td><?php echo $vtabledata->no_speedy; ?></td>
                    <td><?php echo $vtabledata->pstn1; ?></td>
                    <td><?php echo $vtabledata->nama; ?></td>
                    <td><?php echo $vtabledata->handphone; ?></td>
                    <td><?php echo $vtabledata->email; ?></td>
                    <td><?php echo $vtabledata->handphone_lain; ?></td>
                    <td><?php echo $vtabledata->email2; ?></td>
                    <td><?php echo $vtabledata->lup; ?></td>
                    <td><?php echo $vtabledata->no_speedy; ?></td>

                </tr>
            <?php

                $no++;
            }
            ?>
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Modal body text goes here.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#datalist').removeAttr('width').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            responsive: true
        });
    });
    // $('#datalist').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ],
    //     responsive: true
    // });
</script>
<script>
    function prompt_revalidate(idx) {
        var reason = prompt("Reason QC");
        let addedBtn = $(this);
        if (reason != null && idx != null) {
            $.ajax({
                url: "<?php echo base_url() ?>dc_qc/dc_qc/submit_obc",
                type: "get",
                data: {
                    reason: reason,
                    idx: idx
                },
                success: function(response) {
                    $('#' + idx).hide();
                    alert(response);
                },
                error: function(xhr) {
                    alert("data GAGAL di re-validate" + xhr);
                }
            });
        }
    }
</script>