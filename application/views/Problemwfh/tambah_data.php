

<!-- KONTEN UTAMA -->
    <div class="container">
      <h2>Tambah User</h2>
      <div class="row">
        <form action="<?php base_url()?>insertdata" method="post" enctype="multipart/form-data">
          <label>Nama</label><br>
          <select class="form-control data-sending focus-color" name="id_agent">
          <?php foreach($listagent as $datana){
            echo "<option value=".$datana->id.">".$datana->tl."|".$datana->nama."</option>";
          }?>
          </select> </br>
          <label>kendala</label><br>
          <textarea name="kendala" rows="3" cols="80"></textarea><br><br>
          <label>Solusi</label><br>
          <textarea name="solusi" rows="3" cols="80"></textarea><br><br>
          <label>foto</label><br>
          <input type="file" name="fotopost"><br><br>
          <label>Waktu Kejadian</label><br>
          <input type="datetime-local" name="waktu_kejadian"><br><br>

          <input type="submit" name="submit" value="Submit" class="btn btn-default">
        </form>

      </div>
    </div>
