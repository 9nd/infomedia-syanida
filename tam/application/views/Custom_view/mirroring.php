<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-orange">
        <div class="inner">
            <h3 id="call_order"><?php echo $idx; ?></h3>
            <p>IDX Awal Local</p>
        </div>
        <div class="icon-counter">
            <i class="fa fa-address-book-o"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-azure">
        <div class="inner">
            <h3 id="idx_terakhir">0</h3>
            <p>IDX Local Terakhir</p>
        </div>
        <div class="icon-counter">
            <i class="fa fa-comments-o"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
        <div class="inner">
            <h3 id="verified"><?php echo $idx_server; ?></h3>
            <p>IDX Terakhir Server</p>
        </div>
        <div class="icon-counter">
            <i class="fa fa-check-square-o"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
        <div class="inner">
            <h3 id="number_add">0</h3>
            <p>Tambahan Data</p>
        </div>
        <div class="icon-counter">
            <i class="fa fa-clock-o"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<script type="text/javascript">
	function update_base() {
        var number_data=$("#number_add").text();
		$.ajax({
			url: "<?php echo base_url() . "Report_profiling/Test_query/tarik_data/" ?>"+number_data,
            dataType: 'JSON',
			success: function(response) {
                
                $("#number_add").text(response.number_add);
                $("#idx_terakhir").text(response.idx_terakhir);
				show_success_message("Berhasil Tambah Data.!");
			}
		});
	}

	setInterval(function() {
		update_base();
	}, 1000);
    // update_base();
</script>