<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class query_sub extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function query_join()
    {
        $db = $this->load->database("dbprofile_verified", TRUE);
        $DB_info = $this->load->database("db_profiling", TRUE);
        
        // $DB->join($db->database.'.y','x.y_id = y.id');
        // $query="SELECT * FROM DBPROFILE_VERIFIED WHERE ROWNUM <= 10";
        // $queryna = $db->query($query);
        // $DB_info->select("a.ND_SPEEDY as speedy_excel,x.NO_SPEEDY as speedy_dbprofile");
        // $DB_info->from('dbprofilekw3 a');
        // $DB_info->join($db->database.'.DBPROFILE_VERIFIED x','x.NO_SPEEDY = a.ND_SPEEDY');
        // $DB_info->limit(1);
        // $datana=$DB_info->get();  
        // $hasil=$datana->row();
        // echo  $hasil->speedy_excel." : ".  $hasil->speedy_dbprofile;


        $datana=$DB_info->query("SELECT id,ND_SPEEDY as speedy_excel FROM dbprofilekw3 WHERE cek IS NULL ");
        // $datana=$DB_info->get();  
        $hasil=$datana->result();
        foreach($hasil as $rowna){
            $datana_telkom=$db->query("SELECT NO_SPEEDY as speedy_dbprofile FROM DBPROFILE_VERIFIED WHERE NO_SPEEDY = '$rowna->speedy_excel' ");
            $hasil_telkom=$datana_telkom->num_rows();
            ////update data
            $DB_info->query("UPDATE dbprofilekw3 SET dbprofile = $hasil_telkom,cek=1 WHERE id = $rowna->id");
        }
      
        
    }
    public function query_join_kw4()
    {
        $db = $this->load->database("dbprofile_verified", TRUE);
        $DB_info = $this->load->database("db_profiling", TRUE);
        
        // $DB->join($db->database.'.y','x.y_id = y.id');
        // $query="SELECT * FROM DBPROFILE_VERIFIED WHERE ROWNUM <= 10";
        // $queryna = $db->query($query);
        // $DB_info->select("a.ND_SPEEDY as speedy_excel,x.NO_SPEEDY as speedy_dbprofile");
        // $DB_info->from('dbprofilekw3 a');
        // $DB_info->join($db->database.'.DBPROFILE_VERIFIED x','x.NO_SPEEDY = a.ND_SPEEDY');
        // $DB_info->limit(1);
        // $datana=$DB_info->get();  
        // $hasil=$datana->row();
        // echo  $hasil->speedy_excel." : ".  $hasil->speedy_dbprofile;


        $datana=$DB_info->query("SELECT id,ND_SPEEDY as speedy_excel FROM dbprofilekw4 WHERE cek IS NULL ");
        // $datana=$DB_info->get();  
        $hasil=$datana->result();
        foreach($hasil as $rowna){
            $datana_telkom=$db->query("SELECT NO_SPEEDY as speedy_dbprofile FROM DBPROFILE_VERIFIED WHERE NO_SPEEDY = '$rowna->speedy_excel' ");
            $hasil_telkom=$datana_telkom->num_rows();
            ////update data
            $DB_info->query("UPDATE dbprofilekw4 SET dbprofile = $hasil_telkom,cek=1 WHERE id = $rowna->id");
        }
      
        
    }
}
