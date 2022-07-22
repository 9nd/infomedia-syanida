<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/reports/Wallboard_reguler.php";

class Koolreport_c extends CI_Controller {

	public function index()
	{
		$report = new Wallboard_reguler;
		$report->run()->render();
	}
}