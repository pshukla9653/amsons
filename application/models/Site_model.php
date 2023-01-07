<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_data($table=null, $where=null,$select=null,$sort=null, $like=null, $limit=null, $distinct=null,$sort_field=null)
    {
        if (isset($where)) {
            $this->db->where($where);
        }
        if (isset($select)) {
            $this->db->select($select);
        }
        if (isset($distinct)) {
            $this->db->distinct();
            $this->db->group_by($distinct);
        }
        if (isset($like)) {
            $this->db->like($like);
        }
        if (isset($limit)) {
            $this->db->limit($limit);
        }
        if(isset($sort)) {
            $this->db->order_by($sort_field, $sort);
        }
        $resultset = $this->db->get($table);
     
       
        return ($resultset->result_array());
    }

    public function insert_data($table = null, $table_data = null)
    {
        $this->db->insert($table, $table_data);
        return $this->db->insert_id();
    }

    
    
    public function update_data($table = null, $table_data = null, $where = null)
    {
        if (isset($where)) {
            $this->db->where($where);
        }
        $this->db->update($table, $table_data);
        if($this->db->affected_rows() >= 0) {
            return true;
        } else 
        {
            return false;
        }
    }

    public function delete_data($table = null, $where = null)
    {
        if (isset($where)) {
            $this->db->where($where);
        }
        $this->db->delete($table);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function count_data($table = null, $where = null, $select = null, $sort = "desc", $like = null, $limit = null, $distinct = null)
    {
        if (isset($where)) {
            $this->db->where($where);
        }
        if (isset($select)) {
            $this->db->select($select);
        }
        if (isset($distinct)) {
            $this->db->distinct();
            $this->db->group_by($distinct);
        }
        if (isset($like)) {
            $this->db->like($like);
        }
        if (isset($limit)) {
            $this->db->limit($limit);
        }
        if (isset($sort)) {
            $this->db->order_by('id', $sort);
        }
        $resultset = $this->db->get($table);
        return ($resultset->num_rows());
    }

    public function get_max($table = null, $field_name=null, $where = null)
    {
        if (isset($where)) {
            $this->db->where($where);
        }
        if (isset($field_name)) {
            $this->db->select_max($field_name);
        }

        $result = $this->db->get($table)->row();  
        return $result->$field_name;
    }
}
?>