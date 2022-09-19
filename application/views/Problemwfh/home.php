<?php echo _css('datatables,icheck') ?>

<div class="container">
  <h1>Proglem Log WFH</h1>
  <hr>
  <a href="<?php echo base_url() ?>Problemwfh/Problemwfh/tambah" class="btn btn-success">Create Log</a>
 
</div>


<div class="container">
 
  
  <div class="row">
  <br>
    <table class="display responsive nowrap" id="tabel_problem" style="width: 100%;">
      <tr>
        <th>No</th>
        <th>Agent Name</th>
        <th>Issue</th>
        <th>Solution</th>
        <th>Picture</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
      <?php
      $i = 1;
      foreach ($namaagent as $data) {
        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . $data->nama . "</td>";
        echo "<td>" . $data->kendala . "</td>";
        echo "<td>" . $data->solusi . "</td>";
        echo "<td><img src=";
        echo base_url()."images/user_profile/uploadlog/". $data->attachment." alt='foto' name='foto'></td>";
        echo "<td>" . $data->waktu_kejadian . "</td>";
        echo "<td>";
      ?>
        <a href="<?php echo base_url(); ?>Problemwfh/Problemwfh/edit/<?php echo $data->idproblem ?>"><i class="fa fa-edit"></i></a>
        &nbsp;<a href="<?php echo base_url() ?>Problemwfh/Problemwfh/deletedata/<?php echo $data->idproblem ?>"  onclick="return confirm('Hapus data <?php echo ''.$data->kendala.'|'.$data->waktu_kejadian.'|'.$data->nama; ?>?')"><i class="fa  fa-trash-o"></i></a>
        </td>
        </tr>
        <?php
      }
  ?>
    </table> <br>

 
<?php echo _js('datatables,icheck') ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tabel_problem").DataTable();

	});
</script>
