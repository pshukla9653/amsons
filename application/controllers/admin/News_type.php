<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_type extends CI_Controller
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
		$cat = $this->db->get('tbl_news_type');
		$data['types'] = $cat->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/news_types', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'News Type', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('bt', 'Base Type', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/header');
				$this->load->view('admin/add_news_type');
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'base_type' => $this->input->post('bt'),
					'description' => $this->input->post('type_desc'),
					'c_date'=> date('Y-m-d H:i:s')
				);
				$query = $this-> db->insert('tbl_news_type', $values);
				$this->session->set_flashdata('msg', 'News type Successfully Added');
				redirect('admin/news_type');
			}
		} else 
		{
			$this->load->view('admin/header');
			$this->load->view('admin/add_news_type');
			$this->load->view('admin/footer');
			
		}
	}
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'News Type', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$news_type = $query = $this->db->get_where('tbl_news_type', array('id' => $id));
				$data['news_type'] = $news_type->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/edit_news_type', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
					'name' => $this->input->post('name'),
					'base_type' => $this->input->post('bt'),
					'status' => $this->input->post('status'),
					'description' => $this->input->post('type_desc'),
				);
				$this->db->update('tbl_news_type', $values, "id =".$id);
				//$query = $this-> db->insert('tbl_categories', $values);
				$this->session->set_flashdata('msg', 'News Type Successfully Edit..');
				redirect('admin/news_type');
			}
		
		} 
		else 
		{
			$news_type = $query = $this->db->get_where('tbl_news_type', array('id' => $id));
			$data['news_type'] = $news_type->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/edit_news_type', $data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function del($id)
	{
		if($this->db->delete("tbl_news_type",array('id' => $id)))
		{			
			$this->session->set_flashdata('msg', 'News Type Successfully Deleted');
			redirect('admin/news_type');
		}
		else
		{			
			$this->session->set_flashdata('msg', 'News Type not Successfully Deleted');
			redirect('admin/news_type');
		}		
	}
}
