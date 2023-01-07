<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	 public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

     function get($a_email)
     {
		 $query = $this->db->get_where('tbl_admin', array('email' => $a_email,'status'=='A'));
         return $query->result();
	 }
	 
	 function update($a_email)
     {
		 $query = $this->db->get_where('tbl_admin', array('email' => $a_email));
         return $query->result();
	 }
	 
	 function get_running_year($billd)
     {
			$query=$this->db->query("select * from tbl_running_year where from_date <= '$billd' and  to_date <= '$billd'  ");
			$year=$query->row();
			return ($year)?$year->year:0;
	 }
	 
	function get_bills($wy)
     {
			$query=$this->db->query("select bill_no from tbl_publication_bill where work_year='$wy'");
			$result=$query->result();
			return ($result)?$result:0;
	 }
	 
	 
	 function get_book($ro_no,$ro_date,$ro_date1,$ro_date2,$ro_date3,$ro_date4,$gid)
     {
			  $query=$this->db->query("SELECT tbl_book_ads.* FROM tbl_book_ads WHERE tbl_book_ads.ro_no = '".$ro_no."' and (tbl_book_ads.book_date='".$ro_date."' or tbl_book_ads.book_date='".$ro_date1."'or tbl_book_ads.book_date='".$ro_date2."' or tbl_book_ads.book_date='".$ro_date3."'or tbl_book_ads.book_date='".$ro_date4."') and tbl_book_ads.ngb_id='".$gid."' ");
              $roresult=$query->result();
                      
			return ($roresult)?$roresult:0;
	 }
	 
	 function get_ledgers($gid)
     {
		  $query=$this->db->query("select * from tbl_ledgers where master_id='$gid' and group_id='1'");
		  $roresult=$query->row();
				  
		  return ($roresult)?$roresult->ledger_id:0;
	 }
}
?>