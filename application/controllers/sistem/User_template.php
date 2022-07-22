
<?php
class User_template extends CI_Controller {
	
    public function __construct() {
        parent::__construct();

    }
	
	

    public function download_template($token) {
		// if($token== $this->_token && $this->_user_id==1){
			$this->download_template_user();
		// }else{
			// redirect("Auth");
		// }	
    }
	
	public function upload_template($token){
		
	}
	
	
	
	private function download_template_user(){
		$this->load->library("PHPExcel");
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("YBS SYSTEM")
							 ->setLastModifiedBy("YBS SYSTEM")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


		//========================================//
		/* 	 MEMBUAT TABLE ISIAN PADA COLUMN A1	  */
		//========================================//					 

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'ISI PADA TABEL DI BAWAH INI')
					->setCellValue('A2', 'pastikan anda mengisi dengan benar, cek kembali isian anda sebelum melakukan upload ke system')
					->setCellValue('A3', 'USER NAME')
					->setCellValue('B3', 'PASSWORD')
					->setCellValue('C3', 'KODE_LEVEL')
					->setCellValue('D3', 'KODE_STATUS');
					
		//MERGE COLOMN A1-D1 UNTUK TITLE KETERANGAN
		$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');	
		
		//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
		$objPHPExcel->getActiveSheet()->mergeCells('A2:D2');	
		
			
		//MEMBUAT COLOR FONT RED A1
		$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getFont()
					->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);		
		
		
		//WRAP TEST A2
		$objPHPExcel->getActiveSheet()->getStyle('A2')
					->getAlignment()->setWrapText(true);
		
		//Set Height Row 2
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);			

		
		//SET ALIGNMENT -CENTER-CENTER A1-A2
		$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
		
		
		//MEMBUAT COLOR FONT WHITE A3-D3	
		$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->getFont()
					->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
					
		
		//BOLD A1
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		//BOLD A3-D3
		$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->getFont()->setBold(true);
		
		
		//SET WIDTH COLUMN
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);	
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		
		
		
		//SET COLOR CELL BLACK A3-D3
		$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
					
					
		//========================================//
		/* 	 END TABLE ISIAN PADA COLUMN A1	  */
		//========================================//	

				


		
					
		
		//========================================//
		/*MEMBUAT TABLE CODE LEVEL PADA COLUMN G3*/
		//========================================//
		
			//MENULIS PADA COLUMN G3
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('G3', 'KODE_LEVEL')
						->setCellValue('G4', 'KODE_LEVEL')
						->setCellValue('H4', 'DESKRIPSI');
			
			//MERGE COLOMN G3-H3 SEBAGAI TABLE TITLE
			$objPHPExcel->getActiveSheet()->mergeCells('G3:H3');
			
			//SET COLOR CELL BLACK G3
			$objPHPExcel->getActiveSheet()->getStyle('G3')->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
						->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);	
			
			//MEMBUAT COLOR FONT WHITE G3-H3	
			$objPHPExcel->getActiveSheet()->getStyle('G3:H3')->getFont()
						->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);	

			//BOLD G3-H4
			$objPHPExcel->getActiveSheet()->getStyle('G3:H4')->getFont()->setBold(true);						
						
			
			//SET ALIGNMENT  TITLE CENTER-CENTER G3-H4
			$objPHPExcel->getActiveSheet()->getStyle('G3:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('G3:H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
			
			//SET WIDTH Column G-H
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			
			
						
						
			
							
			$thick = array ();
			$thick['borders']=array();
			$thick['borders']['allborders']=array();
			$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
			$objPHPExcel->getActiveSheet()->getStyle ( 'G3:H7' )->applyFromArray ($thick);
		
		//========================================//
		/* END TABLE CODE LEVEL PADA COLUMN G3*/
		//========================================//


		
		
		//========================================//
		/*MEMBUAT TABLE CODE STATUS PADA COLUMN J3*/
		//========================================//
		
			$objPHPExcel->setActiveSheetIndex(0) 
						->setCellValue('J3', 'KODE_STATUS')
						->setCellValue('J4', 'KODE_STATUS')
						->setCellValue('K4', 'DESKRIPSI');
			
			//MERGE COLOMN J3-K3
			$objPHPExcel->getActiveSheet()->mergeCells('J3:K3');
			
			//SET COLOR CELL BLACK J3
			$objPHPExcel->getActiveSheet()->getStyle('J3')->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
						->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);	
			
			//MEMBUAT COLOR FONT WHITE J3-K3	
			$objPHPExcel->getActiveSheet()->getStyle('J3:K3')->getFont()
						->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);	

			//BOLD J3-K4
			$objPHPExcel->getActiveSheet()->getStyle('J3:K4')->getFont()->setBold(true);						

			//SET ALIGNMENT TITLE -CENTER-CENTER J3-K4
			$objPHPExcel->getActiveSheet()->getStyle('J3:J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('J3:J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	

			//SET WIDTH Column J-K
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);			
		
			//MEMBUAT BORDER TABLE
			$thick = array ();
			$thick['borders']=array();
			$thick['borders']['allborders']=array();
			$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
			$objPHPExcel->getActiveSheet()->getStyle ( 'J3:K6' )->applyFromArray ($thick);
			
			//MENGISI DATA
			$objPHPExcel->setActiveSheetIndex(0) 
						->setCellValue('J5', '1')
						->setCellValue('J6', '2')
						->setCellValue('K5', 'AKTIF')
						->setCellValue('K6', 'NON AKTIF');
			//set ALIGNMENT DATA			
			$objPHPExcel->getActiveSheet()->getStyle('J5:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('J5:J6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
		
		//========================================//
		/* END TABLE CODE STATUS PADA COLUMN J3*/
		//========================================//
		
			
		
		

					
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('TEMPLATE');		

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Template_User.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;	
					
	}
	
	
	
	
	
}


?>	