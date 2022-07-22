<?php echo _css('datatables') ?>

<?php echo card_open('Form Audit Multi Inet ' . $hp . '(' . $count_multiinet . ')', 'bg-green', true) ?>


<div class="col">
    <div class='col-md'>
        <div class='box-body table-responsive' id='box-table'>
            <small>
                <label class='form-label'>Multi No Internet </label>
                <table id="byhandphone" class="table dataTable table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Ncli</td>
                            <td>Nomor PSTN</td>
                            <td>Nomor speedy</td>
                            <td>lup</td>
                            <td>Nama Pastel</td>
                            <td>Nama Pelanggan</td>                            
                            <td>Alamat</td>
                            <td>Update By</td>
                            <td>Handphone</td>
                            <td>Email</td>
                            <td>Relasi</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($resultm as $datanya) {

                        ?>

                            <tr>
                                <td align="center"><?php echo $no ?></td>
                                <td><?php echo $datanya->ncli ?></td>
                                <td><?php echo $datanya->no_pstn ?></td>
                                <td><?php echo $datanya->no_speedy ?></td>
                                <td><?php echo $datanya->lup ?></td>
                                <td><?php echo $datanya->nama_pastel ?></td>
                                <td><?php echo $datanya->nama_pelanggan ?></td>
                                <td><?php echo $datanya->alamat ?></td>
                                <td><?php echo $datanya->update_by ?></td>
                                <td><?php echo $datanya->no_handpone ?></td>
                                <td><?php echo $datanya->email ?></td>
                                <td><?php echo $datanya->relasi ?></td>

                            </tr>


                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>


        </div>
    </div>
</div>
<hr>
<div class="col">
    <div class='col-md'>
        <form action="<?php echo base_url() ?>Fraud_alert/Fraud_alert/Insert" method="POST">
            <div class='form-group'>
                <label class='form-label'>Approval</label>
                <input hidden type="text" name="handphone" value="<?php echo $_GET['hp']; ?>"><br>
                <input type="radio" id="app" name="approval" value="Approve"> Approve<br>
                <input type="radio" id="noapp" name="approval" value="NotApprove"> Not Approve
                <br>
            </div>
            <div class='form-group'>
                <label class='form-label'>Reason</label>
                <textarea class="form form-control" name="reason">

                </textarea>
                <br>
            </div>
            <div class='form-group'>
                <input type="submit" class="btn btn-block btn-primary">
                <br>
            </div>
        </form>
    </div>
</div>




<?php echo card_close() ?>

<?php echo _js('datatables') ?>

<script>
    var page_version = "1.0.8"
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#byhandphone").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    });
</script>