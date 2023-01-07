<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		}
		
		$query = $this->db->query("SELECT * FROM `tbl_running_year` WHERE `to_date`>= CURDATE() ORDER BY id DESC LIMIT 1");
		$working_year=$query->row();
		if($query->num_rows()==0)
		{
			$query = $this->db->query("SELECT * FROM tbl_running_year ORDER BY id DESC LIMIT 1");
			$working_year=$query->row_array();
			$new_year=$working_year->year+1;
						
			$r_year=date("Y");
			
			$str_date="April 01 ".$r_year;
			$d=strtotime($str_date);
			$from_date= date("Y-m-d", $d);
			
			$r_year=$r_year+1;
			
			$str_date="March 31 ".$r_year;
			$d=strtotime($str_date);
			$to_date= date("Y-m-d", $d);			
			
			$values = array(								
								'year'=>$new_year,
								'from_date'=> date_format($from_date,"Y-m-d"),
								'to_date'=> date_format($to_date,"Y-m-d"),
								'admin_id'=> $this->session->userdata('admin')['id'] ,
								'c_date'=>date('Y-m-d H:i:s')
							);
			$query = $this-> db->insert('tbl_running_year', $values);
		}

		$query = $this->db->query("SELECT * FROM tbl_running_year ORDER BY id DESC LIMIT 1");
		$working_year=$query->row_array();
		
		$this->session->set_userdata('amsons_wy',$working_year);
		
		//echo ro_no_gen("NP");
		/* $data=$working_year->year+1;
		$this->db->update('tbl_running_year',array('year'=>$data), "id =".$id);
		$this->session->set_flashdata('msg', 'Year update Successfully.');
		redirect('admin/dashboard'); */
	}

	
	public function index()
	{			
		$this->load->model("ro_model");
        $data['total_ros']=$this->ro_model->get_session_ros();
        $data['total_bills']=$this->ro_model->get_session_bills();
        $this->load->view('admin/header',$data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('msg', 'Logout Successfully.');
		redirect('admin/login');
	}
	
	
}
?>