<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		}
		if($this->session->userdata('access')->settings==0)
		{
			redirect('admin/dashboard');
		}
	}
	
	
	public function index()
	{
		$cat = $this->db->get('tbl_position');
		$data['positions'] = $cat->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/position_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('position', 'Position', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$cat = $this->db->get('tbl_position');
				$data['positions'] = $cat->result();
		
				$this->load->view('admin/header');
				$this->load->view('admin/position_list', $data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
					'position' => $this->input->post('position'),					
					'c_date'=> date('Y-m-d H:i:s')
				);
				$query = $this-> db->insert('tbl_position', $values);
				$this->session->set_flashdata('msg', 'Position Successfully Added');
				redirect('admin/position');
			}
		} else 
		{
			$cat = $this->db->get('tbl_position');
			$data['positions'] = $cat->result();
		
			$this->load->view('admin/header');
			$this->load->view('admin/position_list', $data);
			$this->load->view('admin/footer');
			
		}
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_position",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Position Delete Successfully.');
			redirect('admin/position');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Position not Delete Successfully.');
			redirect('admin/position');
		}
	}

}
?>