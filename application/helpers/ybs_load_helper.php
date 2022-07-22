<?php



function _css($plugin)
{
	$ar = explode(',', $plugin);
	$result = '';
	foreach ($ar as $key) {
		switch ($key) {
			case 'ybs':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/ybs.css"/>';
				break;
			case 'datatables':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/DataTablesResponsive/datatables.min.css"/>';

				break;

			case 'icheck':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/tabler/plugins/iCheck/all.css"/>';
				break;

			case 'select2':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/tabler/bower_components/select2/dist/css/select2.min.css"/>';
				break;

			case 'datepicker':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/tabler/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">';
				break;

			case 'dropzone':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/css/dropzone.css">';
				break;

			case 'selectize':
				$result .= '';
				break;

			case 'b3':
				$result .= '';
				break;
			case 'b3-cdn':
				$result .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">';
				break;

			case 'editor':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/plugins/summernote/summernote-bs4.css">';
				break;
			case 'chartjs':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/plugins/chart.js/Chart.min.css">';
				break;
			case 'multiselect':
				$result .= '<link rel="stylesheet" href="' . base_url() . 'assets/css/bootstrap-multiselect.css">';
				break;
		}
	}


	return $result;
}

function _js($plugin)
{
	$ar = explode(',', $plugin);
	$result = '';

	foreach ($ar as $key) {
		switch ($key) {
			case 'ybs':
				$result .= '<script src="' . base_url() . 'assets/ybs.js"></script>';
				break;
			case 'datatables':
				$result .= '<script src="' . base_url() . 'assets/DataTablesResponsive/datatables.min.js"></script>	
						<script src="' . base_url() . 'assets/DataTablesResponsive/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
						<script src="' . base_url() . 'assets/DataTablesResponsive/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
						<script src="' . base_url() . 'assets/DataTablesResponsive/Buttons-1.5.2/js/buttons.flash.min.js"></script>
						<script src="' . base_url() . 'assets/DataTablesResponsive/Buttons-1.5.2/js/buttons.html5.min.js"></script>
						<script src="' . base_url() . 'assets/DataTablesResponsive/Buttons-1.5.2/js/buttons.colVis.min.js"></script>';
				break;
			case 'icheck':
				$result .= '<script src="' . base_url() . 'assets/tabler/plugins/iCheck/icheck.min.js"></script>';
				break;
			case 'select2':
				$result .= '<script src="' . base_url() . 'assets/tabler/bower_components/select2/dist/js/select2.full.min.js"></script>';
				break;

			case 'datepicker':
				$result .= '<script src="' . base_url() . 'assets/tabler/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>';
				break;
			case 'dropzone':
				$result .= '<script src="' . base_url() . 'assets/js/dropzone.min.js"></script>';
				break;
			case 'selectize':
				$result .= '<script src="' . base_url() . 'assets/js/vendors/selectize.min.js"></script>';
				break;
			case 'b3':
				$result .= '';
				break;
			case 'b3-cdn':
				$result .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
							<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>';
				break;
			case 'editor':
				$result .= '<script src="' . base_url() . 'assets/plugins/summernote/summernote-bs4.min.js"></script>';
				break;
			case 'chartjs':
				$result .= '<script src="' . base_url() . 'assets/plugins/chart.js/Chart.min.js"></script>';
				break;
			case 'multiselect':
				$result .= '<script src="' . base_url() . 'assets/js/bootstrap-multiselect.js"></script>';
				break;
		}
	}

	return $result;
}
