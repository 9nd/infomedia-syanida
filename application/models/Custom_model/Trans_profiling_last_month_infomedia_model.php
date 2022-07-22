<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_last_month_infomedia_model extends CI_Model
{
    protected $tbl;
    protected $limit = 0;
    protected $offset = 10;

    function __construct()
    {
        parent::__construct();
        $this->tbl = "trans_profiling_last_month";
        $this->infomedia = $this->load->database('infomedia_infomedia_app',TRUE);
    }

    function live_query($query)
    {
        $query = $this->infomedia->query($query);
        return $query;
    }
};
