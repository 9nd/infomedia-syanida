<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dapros_local_model extends CI_Model
{
    protected $tbl;
    protected $limit = 0;
    protected $offset = 10;

    function __construct()
    {
        parent::__construct();
        $this->tbl = "dapros_validate_forcall_3p";
        $this->db_telkom_local = $this->load->database('db_telkom_local',TRUE);
    }

    function get_results($where = array(), $fields = array('*'), $limit = array(), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db_telkom_local->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_telkom_local->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_telkom_local->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                                $this->db_telkom_local->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db_telkom_local->order_by($field, $typ);
            }
        }
        //limit
        if (count($limit) > 0) {
            $query = $this->db_telkom_local->get($this->tbl, $limit['limit'], $limit['offset']);
        } else {
            $query = $this->db_telkom_local->get($this->tbl);
        }
        if ($result = $query->result()) {
            $data['results'] = $result;
        }
        $data['num'] = $query->num_rows();
        return $data;
    }
    function get_results_array($where = array(), $fields = array('*'), $limit = array(), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db_telkom_local->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_telkom_local->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_telkom_local->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                                $this->db_telkom_local->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db_telkom_local->order_by($field, $typ);
            }
        }
        //limit
        if (count($limit) > 0) {
            $query = $this->db_telkom_local->get($this->tbl, $limit['limit'], $limit['offset']);
        } else {
            $query = $this->db_telkom_local->get($this->tbl);
        }
        if ($result = $query->result_array()) {
            $data['results'] = $result;
        }
        $data['num'] = $query->num_rows();
        return $data;
    }

    function get_row($where = array(), $fields = array('*'), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db_telkom_local->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_telkom_local->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_telkom_local->where($val, NULL, FALSE);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db_telkom_local->order_by($field, $typ);
            }
        }
        $query = $this->db_telkom_local->get($this->tbl);
        if ($result = $query->row()) {
            $data = $result;
        }
        return $data;
    }

    function get_count($where = array(), $limit = array())
    {
        $data = array();
        //select field
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db_telkom_local->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_where($fi, $val);
                        }
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db_telkom_local->where($val, NULL, FALSE);
                        }
                        break;
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }

        return $this->db_telkom_local->count_all_results($this->tbl);
    }

    function add($data = array())
    {
        $this->db_telkom_local->insert($this->tbl, $data);
        return $this->db_telkom_local->insert_id();
    }

    function get_field($data = array())
    {
        $fields = $this->db_telkom_local->list_fields($this->tbl);
        return $fields;
    }

    function edit($where = array(), $data = array())
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                $this->db_telkom_local->where($field, $value);
            }
            $this->db_telkom_local->update($this->tbl, $data);
            return TRUE;
        }
        return false;
    }

    function delete($where = array())
    {
        if (is_array($where) && count($where) > 0) {
            foreach ($where as $field => $value) {
                $this->db_telkom_local->where($field, $value);
            }
            $this->db_telkom_local->delete($this->tbl);
        }
    }

    function get_sum($where = array(), $fields)
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $query = $this->db_telkom_local->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_telkom_local->or_where($fi, $val);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_telkom_local->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_telkom_local->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $query = $this->db_telkom_local->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db_telkom_local->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        $query = $this->db_telkom_local->select_sum($fields, 'num');
        $query = $this->db_telkom_local->get($this->tbl);
        $result = $query->result();
        return $result[0]->num;
    }

    function live_query($query)
    {
        $query = $this->db_telkom_local->query($query);
        return $query;
    }
};
