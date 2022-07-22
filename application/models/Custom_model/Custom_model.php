<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Custom_model extends CI_Model
{
    protected $tbl;
    protected $limit = 0;
    protected $offset = 10;

    function __construct()
    {
        parent::__construct();
    }

    function live_query($query)
    {
        $query = $this->db->query($query);
        return $query;
    }
    function add($table, $data = array())
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
};
