<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }

    public function get_publication_newspapers()
    {
    
        $this->db->select('tbl_newspapers.id as id,tbl_newspapers.name as newspaper, tbl_cities.name as city')
            ->from('tbl_paper_city')
            ->join('tbl_newspapers', 'tbl_newspapers.id = tbl_paper_city.paper_id','left')
            ->join('tbl_cities', 'tbl_cities.id = tbl_paper_city.city_id','left');
        $result = $this->db->get();
        return ($result->result_array());
    }
    
     public function get_add_on_newspapers($newspaper_id)
    {
    
        $this->db->select('tbl_add_on.a_paper_id')
            ->from('tbl_add_on')
            //->join('tbl_newspapers', 'tbl_newspapers.id = tbl_add_on.a_paper_id','left')
//            ->join('tbl_cities', 'tbl_cities.id = tbl_newspapers.city_id','left');
             ->where('tbl_add_on.ad_type',1)
            ->where('tbl_add_on.m_paper_id',$newspaper_id);
         
        $result = $this->db->get();
        return ($result->result_array());
    }


}
?>