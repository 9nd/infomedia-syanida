<div class="m-3">
    <b>List Table Verified Invalid Email Format <?php echo $_GET['date'] ?></b>
    <table id="datalist" class="table dataTable table-striped table-bordered display responsive nowrap" width="100%">
        <thead>
            <tr style="height: 5px; font-size: 10px;">
                <th><input type='checkbox' id='selectAll'></th>
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
                    <td><input type='checkbox' value='<?php echo $vtabledata->idx ?>' id='ck-<?php echo $vtabledata->idx ?>' name="ceklist_revalidate"></td>
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
    <div class="col-12 col-lg-6 mt-3">
        <div class="card">
            <div class="card-header">

                <h4 class="card-title">Re-Validate Form</h4>
                <i id='countcheck'></i> Checked
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                <div class="form-group">
                                    <textarea class="form-control" id="reason">
        </textarea>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="action_simpan" class="btn btn-primary pull-right">Submit</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var numberOfChecked = $('input:checkbox:checked').length;
        var totalCheckboxes = $('input:checkbox').length;
        var numberNotChecked = totalCheckboxes - numberOfChecked;
        $('#countcheck').html('#');

    });
</script>
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

    $('#selectAll').click(function(e) {
        var table = $('#datalist');
        $('td input:checkbox', table).prop('checked', this.checked);
        // alert("asdf");

    });

    // $(document).ready(function() {
    //     $('#datalist').DataTable({
    //         scrollY: 300,
    //         scrollX: true,
    //         scrollCollapse: true,
    //         paging: false,
    //         fixedColumns: {
    //             leftColumns: 2
    //         },
    //         columnDefs: [{
    //             orderable: false,
    //             className: 'select-checkbox',
    //             targets: 0
    //         }],
    //         select: {
    //             style: 'os',
    //             selector: 'td:first-child'
    //         },
    //         order: [
    //             [1, 'asc']
    //         ]
    //     });
    // });
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
    $("#action_simpan").click(function() {
        var reason = $("#reason").val();
        var cek_box = [];
        var sumber = "<?php echo $_GET['sumber']?>";
        $.each($("input[name='ceklist_revalidate']:checked"), function() {
            cek_box.push($(this).val());
        });
        if (reason != null && cek_box != null) {
            $.ajax({
                url: "<?php echo base_url() ?>dc_qc/dc_qc/email_submit_bulk_invalid",
                type: "get",
                data: {
                    reason: reason,
                    cek_box: cek_box,
                    sumber: sumber
                },
                success: function(response) {
                    // $('#' + cek_box).hide();
                    alert(response);
                },
                error: function(xhr) {
                    alert("data GAGAL di re-validate" + xhr);
                }
            });
        }else{
            alert("reson call tidak boleh kosong");
        }
        // alert(sumber);
    });
</script>