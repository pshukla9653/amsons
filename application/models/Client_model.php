<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model
{
	 public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

     function get($c_email)
     {
		 $query = $this->db->get_where('tbl_client', array('email' => $c_email));
         return $query->result();
	 }
	 
	 function update($c_email)
     {
		 $query = $this->db->get_where('tbl_admin', array('email' => $c_email));
         return $query->result();
	 }
}
?>