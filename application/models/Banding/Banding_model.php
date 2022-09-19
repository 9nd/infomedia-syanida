<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banding_model extends CI_Model
{

    function get_notapp($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = "'qc.agentid' like '%" . $searchValue . "%' or pstn1 like '%" . $searchValue . "%' or ncli like'%" . $searchValue . "%'";
        }


        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        if ($userdata->opt_level == 9) {
            $agent = $this->db->query("SELECT * FROM sys_user WHERE tl = '$userdata->agentid'")->result();
            $no = 1;
            foreach ($agent as $dataagnt) {

                if ($no == 1) {
                    $filteragnt = "qc.agentid = '$dataagnt->agentid'";
                } else {
                    $filteragnt = "";
                }

                $filteragnts = $filteragnt . $filteragnts . " OR qc.agentid = '$dataagnt->agentid'";
                $no++;
            }
        }

        if ($userdata->opt_level == 8) {
            $filtertambahan = " AND (qc.agentid='$userdata->agentid' or qc.agentid='$userdata->agentid_mos' )";
        } else if ($userdata->opt_level == 9) {
            $filtertambahan = " AND ($filteragnts)";
        } else {
            $filtertambahan = "";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('qc');
        $this->db->join('sys_user', 'qc.agentid = sys_user.agentid');
        if ($userdata->opt_level == 8) {
            $this->db->where('qc.agentid', $userdata->agentid);
        }
        if ($userdata->opt_level == 9) {
            $this->db->where('(' . $filteragnts . ')');
        }
        $this->db->where('qc.status_approve', '0');
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        if ($userdata->opt_level == 8) {
            $this->db->where('qc.agentid', $userdata->agentid);
        }
        if ($userdata->opt_level == 9) {
            $this->db->where('(' . $filteragnts . ')');
        }

        $this->db->where('qc.status_approve', '0');

        $records = $this->db->get('qc')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records

        // $this->db->limit($rowperpage, $start);
        $records = $this->db->query("SELECT
        qc.*,
        sys_user.agentid AS agentsys,
        sys_user.tl,
        sys_user.nama 
    FROM
        qc
        INNER JOIN sys_user ON sys_user.agentid = qc.agentid
    WHERE
        status_approve = '0'
        $searchQuery $filtertambahan 
    ORDER BY qc.tanggal DESC
    LIMIT $start, $rowperpage
    ")->result();


        $data = array();
        $no = 1;
        foreach ($records as $record) {
            if ($userdata->opt_level == "8") {
                $opsi = "<span class='banding fa fa-hand-grab-o' id='$record->id'><a href='#'>Banding</a></span>&nbsp;&nbsp;&nbsp;<span class='detail fa fa-list' id='$record->id'><a target='_blank' href='" . base_url() . "Banding/Banding/Detail/?id=$record->id'>detail</a></span>";
            } elseif ($userdata->opt_level == "9" || $userdata->opt_level == "10" && $record->status_approve == 3) {
                $opsi = "<span class='approve fa fa-check' id='$record->id'><a href='#'>approve</a></span><span class='detail fa fa-list' id='$record->id'><a target='_blank' href='" . base_url() . "Banding/Banding/Detail/?id=$record->id'>detail</a></span>";
            } else {
                $opsi = "<span class='banding fa fa-hand-grab-o' id='$record->id'><a href='#'>Banding</a></span>&nbsp;<span class='approve fa fa-check' id='$record->id'><a href='#'>approve</a></span>&nbsp;<span class='detail fa fa-list' id='$record->id'><a target='_blank' href='" . base_url() . "Banding/Banding/Detail/?id=$record->id'>detail</a></span>";
            }

            $status_banding = "-";
            if ($record->app_tl == "" && $record->tanggal_banding != "" && $record->app_qc == "") {
                $status_banding = "Pengajuan";
            } elseif ($record->app_tl == "1" && $record->tanggal_banding != "" && $record->app_qc != "1") {
                $status_banding = "Approve";
            } elseif (($record->app_tl == "" || $record->app_qc == "") && $record->tanggal_banding != "") {
                $status_banding = "Not Approve";
            }
            if ($record->id_qc != "") {
                $id_qc = $this->db->query("SELECT nama from sys_user where id='$record->id_qc'")->row()->nama;
            } else {
                $id_qc = "";
            }


            $data[] = array(
                "no" => $start + $no,
                "opsi" => $opsi,
                "tanggal_kejadian" => $record->lup,
                "status_banding" => $status_banding,
                "id_qc" => $id_qc,
                "nama_agent" => $record->nama,
                "pstn1" => $record->pstn1,
                "handphone" => $record->handphone,
                "email" => $record->email,
                "alamat" => $record->alamat,
                "opsi_call" => $record->opsi_call,
                "validate_1" => $record->validate_1,
                "validate_2" => $record->validate_2,
                "validate_3" => $record->validate_3,
                "validate_4" => $record->validate_4,
                "validate_5" => $record->validate_5,
                "validate_6" => $record->validate_6,
                "veri_system_qc" => $record->veri_system_qc,
                "keterangan_qc" => $record->keterangan_qc,
                "reason_qa" => $record->reason_qa,
                "aht_qc" => $record->aht_qc,
                "durasi_qc" => $record->durasi_qc,
                "note_qc" => $record->note_qc
            );
            $no++;
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );


        return $response;
    }
}
