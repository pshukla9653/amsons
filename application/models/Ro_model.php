<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ro_model extends CI_Model
{
    public function __construct()
    {
       parent::__construct();
    }

    
    
    
    
    public function gen_ro_no($ro_type=null,$work_year=null){
        $this->db->select_max('ro_no');
        if($work_year){
            $this->db->where(['ro_type'=>$ro_type,'year'=>$work_year]);
        }else if($work_year==0){
            $this->db->where(['ro_type'=>$ro_type,'year'=>0]);
        }
        $result = $this->db->get('tbl_ro_no')->row();  
        return(($result->ro_no)+1);
    }

     public function gen_slip_no($work_year=null){
        $this->db->select_max('slip_no');
        if($work_year){
            $this->db->where(['work_year'=>$work_year]);
        }else if($work_year==0){
            $this->db->where(['work_year'=>0]);
        }
        $result = $this->db->get('tbl_publication_bill')->row();  
        return(($result->slip_no)+1);
    }
    
    
    
    public function update_ro_no($where){
        $ro_no=$where['ro_no'];
        unset($where['ro_no']);
        $query=$this->db->get_where("tbl_ro_no",$where);
        if($query->num_rows()){
            $old_ro_no=$query->result()[0]->ro_no;
            if($old_ro_no<$ro_no){
                $this->db->where($where);
                $this->db->update('tbl_ro_no',array('ro_no'=>$ro_no));
            }  
        }
        else{
            $where['ro_no'] = $ro_no;
            $this->db->insert('tbl_ro_no', $where);             
        }
    }

    
    
    
    
    public function get_states($n_id){
        $this->db->select('tbl_news_group.ng_id');
        $this->db->from('tbl_newspapers');
        $this->db->join('tbl_paper_city', 'tbl_newspapers.id = tbl_paper_city.paper_id');
        $this->db->join('tbl_news_group', 'tbl_newspapers.g_id = tbl_news_group.ng_id');
        $this->db->where(['tbl_paper_city.id'=>$n_id]);
        //echo $this->db->last_query();
        
        $query = $this->db->get();
        $ng_id=$query->row()->ng_id;
        $this->db->select('states.id,states.name');
        $this->db->from('tbl_news_group_details');
        $this->db->join('states', 'states.id = tbl_news_group_details.state');
        $this->db->where(['tbl_news_group_details.newsgroup_id'=>$ng_id]);
        $result=$this->db->get();
       // echo $this->db->last_query();
      //  die;
        return ($result->result());
    }
    
       
    public function get_session_ros(){
        $results=$this->db->get_where("tbl_book_ads",['work_year'=>$_SESSION['admin']['work_year']]);
        return($results->num_rows());
    }
    
    public function get_session_bills(){
        $results=$this->db->get_where("tbl_bill",['work_year'=>$_SESSION['admin']['work_year']]);
        return($results->num_rows());
    }

}
?>