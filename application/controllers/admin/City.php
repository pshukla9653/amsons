<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller
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
		$query = $this->db->get('tbl_cities');
		$data['cities']= $query->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/cities_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add_city()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('city', 'City', 'required|is_unique[tbl_cities.name]',array('required' => 'You must provide a %s.','is_unique'=>'City already Added.'));
			
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/header');
				$this->load->view('admin/add_city');
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array('name' => $this->input->post('city'));
				$query = $this-> db->insert('tbl_cities', $values);
				$this->session->set_flashdata('msg', 'City Successfully Added');
				redirect('admin/city');
			}
		}
		else 
		{
			$this->load->view('admin/header');
			$this->load->view('admin/add_city');
			$this->load->view('admin/footer');
		}
	}

	
	public function del_city($id)
	{
		if($this->db->delete("tbl_cities",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'City Delete Successfully.');
			redirect('admin/city');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'City not Delete Successfully.');
			redirect('admin/city');
		}
		
	}	
		
	
}
?>