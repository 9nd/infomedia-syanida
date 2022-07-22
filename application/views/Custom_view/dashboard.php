<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-orange">
		<div class="inner">
			<h3 id="call_order"><?php echo count($trans_profiling); ?></h3>
			<p>CALL ORDER</p>
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
	<div class="small-box bg-red">
		<div class="inner">
			<h3 id="not_contacted"><?php echo $veri_call[4] + $veri_call[7] + $veri_call[11] + $veri_call[10] + $veri_call[14]; ?></h3>
			<p>NOT CONTACTED</p>
		</div>
		<div class="icon-counter">
			<i class="fa fa-clock-o"></i>
		</div>
		<a href="#" class="small-box-footer">
			More info <i class="fa fa-arrow-circle-right"></i>
		</a>
	</div>
</div>
<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-azure">
		<div class="inner">
			<h3 id="contacted">0</h3>
			<p>CONTACTED</p>
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
			<h3 id="verified">0</h3>
			<p>VERIFIED</p>
		</div>
		<div class="icon-counter">
			<i class="fa fa-check-square-o"></i>
		</div>
		<a href="#" class="small-box-footer">
			More info <i class="fa fa-arrow-circle-right"></i>
		</a>
	</div>
</div>
<div class="col-xl-12">
	<div class="panel panel-lte">
		<div class="panel-heading lte-heading-primary"></div>
		<div class="panel-body">
			<center>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="bp">0</span>
					<i class="fas fa-edit"></i> Bertemu Pelanggan
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="tbp">0</span>
					<i class="fas fa-pause"></i> Tidak Bertemu Pemilik
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="fu">0</span>
					<i class="fas fa-heart"></i> Follow Up
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="rna">0</span>
					<i class="fas fa-play"></i> RNA
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="decline">0</span>
					<i class="fas fa-heart"></i> Decline
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="mailbox">0</span>
					<i class="fas fa-inbox"></i> Mailbox
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="rbs">0</span>
					<i class="fas fa-heart"></i> Reject By System
				</a>
				<a class="btn-lte3 btn-app text-black">
					<span class="badge bg-danger" id="reject">0</span>
					<i class="fas fa-heart"></i> Rejected
				</a>
			</center>

		</div>
	</div>
</div>