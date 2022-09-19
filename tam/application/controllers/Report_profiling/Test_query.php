<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_query extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Trans_profiling_model', 'trans_profiling');
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling_infomedia');
    }

    public function mirroring(){
        $data = array(
			'title_page_big'		=> 'Mirroring Profiling',
			'title'					=> 'Mirroring Profiling',
			'link_refresh_table'	=> site_url() . 'Status_call/Status_call/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Status_call/Status_call/create',
			'link_update'			=> site_url() . 'Status_call/Status_call/update',
			'link_delete'			=> site_url() . 'Status_call/Status_call/delete_multiple',
		);
        $data['start_data']=0;
        $last_local=$this->trans_profiling->get_results(array(),array("*"),array("limit"=>1,"offset"=>0),array("idx"=>"DESC"));
        
        $data['idx']=0;
        foreach($last_local['results'] as $dl){
            $data['idx']=$dl->idx;
        }

        $last_server=$this->trans_profiling_infomedia->get_results_array(array(),array("*"),array("limit"=>1,"offset"=>0),array("idx"=>"DESC"));
        // echo "Local : ".$last_local->idx;
        $data['idx_server']="-";
        foreach($last_server['results'] as $rs){
            $data['idx_server']=$rs['idx'];
        }
		$this->template->load('Custom_view/mirroring', $data);
    }

    public function tarik_data($number_add)
    {
        $data = array();
        // $number_add=$this->input->get('number_add');
        $last_local=$this->trans_profiling->get_results(array(),array("*"),array("limit"=>1,"offset"=>0),array("idx"=>"DESC"));
        $idx_local=0;
        foreach($last_local['results'] as $dl){
            $idx_local=$dl->idx;
        }
       
        $last_server=$this->trans_profiling_infomedia->get_results_array(array("idx >"=>$idx_local),array("*"),array("limit"=>1,"offset"=>0),array("idx"=>"ASC"));
        // echo "Local : ".$last_local->idx;
        $data_insert=array();
        foreach($last_server['results'] as $rs){
            $idx_terakhir=$rs['idx'];
            foreach($rs as $fs=>$vs){
                $data_insert[$fs]=$vs;
            }
        }
        $this->trans_profiling->add($data_insert);
        $number_add++;
        $return_arr=array(
            'idx_terakhir'=>$idx_terakhir,
            'number_add'=>$number_add
        );
        echo json_encode($return_arr);
        
    }
    
};
