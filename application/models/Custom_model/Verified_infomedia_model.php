<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verified_infomedia_model extends CI_Model
{
    protected $tbl;
    protected $limit = 0;
    protected $offset = 10;

    function __construct()
    {
        parent::__construct();
        $this->tbl = "trans_profiling_verifikasi";
        $this->infomedia = $this->load->database('infomedia',TRUE);
    }

    function get_results($where = array(), $fields = array('*'), $limit = array(), $order_by = array(),$groupby=false,$having=array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
           $this->infomedia->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                       $this->infomedia->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                           $this->infomedia->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                               $this->infomedia->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
               $this->infomedia->order_by($field, $typ);
            }
        }
        if($groupby){
            $this->infomedia->group_by($groupby);
         }
         if(count($having) > 0){
            foreach ($having as $field => $typ) {
                $this->infomedia->having($field, $typ);
             }
         }
        //limit
        if (count($limit) > 0) {
            $query =$this->infomedia->get($this->tbl, $limit['limit'], $limit['offset']);
        } else {
            $query =$this->infomedia->get($this->tbl);
        }
        if ($result = $query->result()) {
            $data['results'] = $result;
        }
        $data['num'] = $query->num_rows();
        return $data;
    }
    function get_results_array($where = array(), $fields = array('*'), $limit = array(), $order_by = array(),$groupby=false,$having=array())
    {
        $data = array();
        //select field
        if (is_array($fields)) {
           $this->infomedia->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                       $this->infomedia->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                           $this->infomedia->where($val, NULL, FALSE);
                        }
                        break;
                    case "or_where_null_multi":
                        foreach ($value as $val_arr) {
                            foreach ($val_arr as $val) {
                               $this->infomedia->where($val, NULL, FALSE);
                            }
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val, "INNER");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
               $this->infomedia->order_by($field, $typ);
            }
        }
        if($groupby){
            $this->infomedia->group_by($groupby);
         }
         if(count($having) > 0){
            foreach ($having as $field => $typ) {
                $this->infomedia->having($field, $typ);
             }
         }
        //limit
        if (count($limit) > 0) {
            $query =$this->infomedia->get($this->tbl, $limit['limit'], $limit['offset']);
        } else {
            $query =$this->infomedia->get($this->tbl);
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
           $this->infomedia->select(implode(',', $fields));
        }
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                       $this->infomedia->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                           $this->infomedia->where($val, NULL, FALSE);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        //order
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
               $this->infomedia->order_by($field, $typ);
            }
        }
        $query =$this->infomedia->get($this->tbl);
        if ($result = $query->row()) {
            $data = $result;
        }
        return $data;
    }

    function get_count($where = array(), $limit = array(),$groupby=false,$select=array("*"),$having=array())
    {
        $data = array();
        //select field
       $this->infomedia->select($select);
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                       $this->infomedia->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_where($fi, $val);
                        }
                        break;
                    case "or_where_null":
                        foreach ($value as $val) {
                           $this->infomedia->where($val, NULL, FALSE);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->like($fi, $val);
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->or_like($fi, $val);
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        if($groupby){
           $this->infomedia->group_by($groupby);
        }
         if(count($having) > 0){
             foreach ($having as $field => $typ) {
                 $this->infomedia->having($field, $typ);
              }
          }
        return$this->infomedia->count_all_results($this->tbl);
    }

    function add($data = array())
    {
       $this->infomedia->insert($this->tbl, $data);
        return$this->infomedia->insert_id();
    }

    function get_field($data = array())
    {
        $fields =$this->infomedia->list_fields($this->tbl);
        return $fields;
    }

    function edit($where = array(), $data = array(),$limit=false,$order_by = array())
    {
        if (count($order_by) > 0) {
            foreach ($order_by as $field => $typ) {
               $this->db->order_by($field, $typ);
            }
        }
        if($limit){
            $this->infomedia->limit($limit);
        }
        
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
               $this->infomedia->where($field, $value);
            }
           $this->infomedia->update($this->tbl, $data);
            return TRUE;
        }
        return false;
    }

    function delete($where = array())
    {
        if (is_array($where) && count($where) > 0) {
            foreach ($where as $field => $value) {
               $this->infomedia->where($field, $value);
            }
           $this->infomedia->delete($this->tbl);
        }
    }

    function get_sum($where = array(), $fields)
    {
        if (count($where) > 0) {
            foreach ($where as $field => $value) {
                switch ($field) {
                    default:
                        $query =$this->infomedia->where($field, $value);
                        break;
                    case "or_where":
                        foreach ($value as $fi => $val) {
                            $query =$this->infomedia->or_where($fi, $val);
                        }
                        break;
                    case "like":
                        foreach ($value as $fi => $val) {
                            $query =$this->infomedia->like($fi, $val, 'both');
                        }
                        break;
                    case "or_like":
                        foreach ($value as $fi => $val) {
                            $query =$this->infomedia->or_like($fi, $val, 'both');
                        }
                        break;
                    case "join":
                        foreach ($value as $fi => $val) {
                            $query =$this->infomedia->join($fi, $val);
                        }
                        break;
                    case "join_left":
                        foreach ($value as $fi => $val) {
                           $this->infomedia->join($fi, $val, "left");
                        }
                        break;
                }
            }
        }
        $query =$this->infomedia->select_sum($fields, 'num');
        $query =$this->infomedia->get($this->tbl);
        $result = $query->result();
        return $result[0]->num;
    }
    function live_query($query)
    {
        $query = $this->infomedia->query($query);
        return $query;
    }
};
