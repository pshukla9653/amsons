<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Bank_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_bank($id=null){
        
        $this->db->select('tbl_bank.*,tbl_admin.name as user_name,tbl_admin.id as user_id');
        $this->db->from('tbl_bank');
        $this->db->join('tbl_admin', 'tbl_admin.id = tbl_bank.user_id', 'left');
        if($id){
            $this->db->where('tbl_bank.id',$id);
        }
        $query = $this->db->get();
        return($query->result_array());
    }
}