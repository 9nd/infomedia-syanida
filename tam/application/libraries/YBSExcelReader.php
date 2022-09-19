<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';





class YBSExcelReader{
private $inputFileType = 'Excel5';
private $inputFileName = '';
private $sheetname = '';
	
	public function __construct() {
	
	}

	public function set_file($inputFileName,$sheetname ) {
		$this->inputFileName=$inputFileName;
		$this->sheetname=$sheetname;
	}
	
	
	public function read($startRow, $endRow, $columns){
		$filterSubset = new MyReadFilter($startRow, $endRow, $columns);
		$objReader = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setLoadSheetsOnly($this->sheetname);
		$objReader->setReadFilter($filterSubset);
		$objPHPExcel = $objReader->load($this->inputFileName);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		
		$v = array();
		$result =array();
		foreach($sheetData as $val){
			
			
			foreach($columns as $col){
				if($val[$col]!==NULL){
					$v[$col] = $val[$col];
				}else{
					$v[$col] ="";
				}
			}
			
			
			//hanya mendapatkan nilai yang tidak kosong
			$cc = $columns[0];
			if($val[$cc]!==NULL){
				$result[] = $v;
			}

		}
		
		
		
		return $result;
	}
	
	

}


class MyReadFilter implements PHPExcel_Reader_IReadFilter
{
	private $_startRow = 0;

	private $_endRow = 0;

	private $_columns = array();

	public function __construct($startRow, $endRow, $columns) {
		$this->_startRow	= $startRow;
		$this->_endRow		= $endRow;
		$this->_columns		= $columns;
	}

	public function readCell($column, $row, $worksheetName = '') {
		if ($row >= $this->_startRow && $row <= $this->_endRow) {
			if (in_array($column,$this->_columns)) {
				return true;
			}
		}
		return false;
	}
}
