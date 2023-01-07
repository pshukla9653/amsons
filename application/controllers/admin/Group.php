<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller
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
		$query = $this->db->get('tbl_main_group');
		$data['groups']= $query->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/group_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('g_name', 'Group Name', 'required|is_unique[tbl_group.g_name]',array('required' => 'You must provide a %s.','is_unique'=>'Group already Added.'));
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_group');
				$data['groups']= $query->result();
		
				$this->load->view('admin/header');
				$this->load->view('admin/group_list', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array('g_name' => $this->input->post('g_name'));
				$query = $this-> db->insert('tbl_group', $values);
				$this->session->set_flashdata('msg', 'Group Successfully Added');
				redirect('admin/group');
			}
		}
		else 
		{
			$query = $this->db->get('tbl_group');
			$data['groups']= $query->result();
		
			$this->load->view('admin/header');
			$this->load->view('admin/group_list', $data);
			$this->load->view('admin/footer');
		}
	}

	
	public function del($id)
	{
		if($this->db->delete("tbl_group",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Group Delete Successfully.');
			redirect('admin/group');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Group not Delete Successfully.');
			redirect('admin/group');
		}
		
	}	
		
	
}
?>