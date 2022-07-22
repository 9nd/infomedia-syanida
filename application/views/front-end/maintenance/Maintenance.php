<!DOCTYPE html>
<html lang="en">
<head>
	<title>Maintenance</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/front-end/maintenance/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/vendor/countdowntime/flipclock.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/front-end/maintenance/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="bg-img1 size1 overlay1 p-t-24" style="background-image: url('<?php echo base_url() ?>assets/front-end/maintenance/images/bg01.jpg');">
		<div class="flex-w flex-sb-m p-l-80 p-r-74 p-b-175 respon5">
			

			<div class="flex-w m-t-10 m-b-10">
				<a href="https://id-id.facebook.com/people/Dhiya-As-Sayyaf/100008796433530" class="size3 flex-c-m how-social trans-04 m-r-6">
					<i class="fa fa-facebook"></i>
				</a>

				<a  href="https://wa.me/6281342046414?text=Assalamualaikum..%20" class="size3 flex-c-m how-social trans-04 m-r-6">
					<i class="fa fa-whatsapp"></i>
				</a>

				<a href="https://www.youtube.com/playlist?list=PLa5lI5XCqbP55HISIuBnjAIXgVSwtBAGl" class="size3 flex-c-m how-social trans-04 m-r-6">
					<i class="fa fa-youtube-play"></i>
				</a>
			</div>
		</div>

		<div class="flex-w flex-sa p-r-200 respon1">
			<div class="p-t-34 p-b-60 respon3">
				<p class="l1-txt1 p-b-10 respon2">
					YBS Sistem is
				</p>

				<h3 class="l1-txt2 p-b-45 respon2 respon4">
					Coming Soon
				</h3>

				<div class="cd100"></div>
				 <p class="s1-txt2 p-b-10 ">
					<b><?php echo $this->_maintenance_desc?></b>
				</p>
			</div>

			
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/countdowntime/flipclock.min.js"></script>
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/countdowntime/moment.min.js"></script>
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			//endtimeYear: 0,
			//endtimeMonth: 1,
			endtimeDate:  <?php echo $this->_maintenance_days?>,
			endtimeHours: <?php echo $this->_maintenance_hours?>,
			endtimeMinutes:  <?php echo $this->_maintenance_minutes?>,
			endtimeSeconds: <?php echo $this->_maintenance_second?>,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});

		
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/front-end/maintenance/js/main.js"></script>

</body>
</html>