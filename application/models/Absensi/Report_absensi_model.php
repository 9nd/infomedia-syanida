<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_absensi_model extends CI_Model
{
    protected $tbl;
    protected $limit = 0;
    protected $offset = 10;

    function __construct()
    {
        parent::__construct();
        $this->tbl = "t_absensi";
    }  
    
    
    function curl()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('d/m/y');
        $post = [
            'dtstart' => $today,
            'status' => 0
        ];

        $ch = curl_init('http://10.194.52.142/absensi/lpr_date.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);
        $pecah = explode('<td bgcolor="#9FE89B"><table border="1" align="top">', $response);

        echo '<table border="1" hidden>';
        echo '<tr>';
        echo '<td>';
        echo 'No';
        echo '</td>';
        echo '<td>';
        echo 'Nama';
        echo '</td>';
        echo '<td>';
        echo 'NIK';
        echo '</td>';
        echo '<td>';
        echo 'Departemen';
        echo '</td>';
        echo '<td>';
        echo 'Status';
        echo '</td>';
        echo '<td>';
        echo 'Time';
        echo '</td>';
        echo '</tr>';
    }

    function get_results($where = array(), $fields = array('*'), $limit = array(), $order_by = array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
            $this->db->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                                $this->db->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db->order_by($field, $typ);
            }
        }
        //limit
        if (count($limit) > 0) {
            $query = $this->db->get($this->tbl, $limit['limit'], $limit['offset']);
        } else {
            $query = $this->db->get($this->tbl);
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
            $this->db->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                                $this->db->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db->order_by($field, $typ);
            }
        }
        //limit
        if (count($limit) > 0) {
            $query = $this->db->get($this->tbl, $limit['limit'], $limit['offset']);
        } else {
            $query = $this->db->get($this->tbl);
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
            $this->db->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db->where($val, NULL, FALSE);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
                $this->db->order_by($field, $typ);
            }
        }
        $query = $this->db->get($this->tbl);
        if ($result = $query->row()) {
            $data = $result;
        }
        return $data;
    }

    function live_query($query)
    {
        $query = $this->db->query($query);
        return $query;
    }

    function get_count($where = array(), $limit = array())
    {
        $data = array();
        //select field
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $this->db->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $this->db->or_where($fi, $val);
                        }
                    case "or_where_null":
                        foreach ($value as $val) {
                            $this->db->where($val, NULL, FALSE);
                        }
                        break;
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $this->db->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $this->db->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }

        return $this->db->count_all_results($this->tbl);
    }

    function add($data = array())
    {
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    function get_field($data = array())
    {
        $fields = $this->db->list_fields($this->tbl);
        return $fields;
    }

    function edit($where = array(), $data = array())
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                $this->db->where($field, $value);
            }
            $this->db->update($this->tbl, $data);
            return TRUE;
        }
        return false;
    }

    function delete($where = array())
    {
        if (is_array($where) && count($where) > 0) {
            foreach ($where as $field => $value) {
                $this->db->where($field, $value);
            }
            $this->db->delete($this->tbl);
        }
    }

    function get_sum($where = array(), $fields)
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $query = $this->db->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $query = $this->db->or_where($fi, $val);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $query = $this->db->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $query = $this->db->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $query = $this->db->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                            $this->db->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        $query = $this->db->select_sum($fields, 'num');
        $query = $this->db->get($this->tbl);
        $result = $query->result();
        return $result[0]->num;
    }
};
