<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheme extends CI_Controller
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
		$this->load->library("pagination");
	}
	
	
	public function index()
	{
		$scheme = $this->db->get("tbl_scheme");
		
		$data['schemes']= $scheme->result();
		$data["total_rows"] = $scheme->num_rows();
		
		$this->load->view('admin/header');
		$this->load->view('admin/scheme_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			//$this->form_validation->set_rules('scheme', 'Scheme', 'required');
			$this->form_validation->set_rules('scheme', 'Scheme', 'required|is_unique[tbl_scheme.scheme_name]',array('is_unique' => 'The Sceme already added.'));

			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
			
			
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/header');
				$this->load->view('admin/scheme_add');
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
								'scheme_name'=>$this->input->post('scheme'),
								'paid' =>$this->input->post('paid'),
								'free' =>$this->input->post('free'),
								'c_date' =>date('Y-m-d H:i:s')
							);
				$query = $this-> db->insert('tbl_scheme', $values);
				$this->session->set_flashdata('msg', 'Scheme Successfully Added');
				redirect('admin/scheme');
			}
		}
		else
		{							
			$this->load->view('admin/header');
			$this->load->view('admin/scheme_add');
			$this->load->view('admin/footer');
		}
	}
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('scheme', 'Scheme', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
						
			
			if($this->form_validation->run() == FALSE) 
			{								
				$query = $this->db->get_where('tbl_scheme', array('scheme_id' => $id));
				$data['scheme']= $query->row();
				
				$this->load->view('admin/header');
				$this->load->view('admin/scheme_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
								'scheme_name'=>$this->input->post('scheme'),
								'paid' =>$this->input->post('paid'),
								'free' =>$this->input->post('free')
							);
				$this->db->update('tbl_scheme',$values, "scheme_id =".$id);
				$this->session->set_flashdata('msg', 'Scheme edit Successfully');
				redirect('admin/scheme');
			}
		}
		else
		{							
			$query = $this->db->get_where('tbl_scheme', array('scheme_id' => $id));
			$data['scheme']= $query->row();
				
			$this->load->view('admin/header');
			$this->load->view('admin/scheme_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del($id)
	{	
		if($this->db->delete("tbl_scheme",array('scheme_id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Scheme Delete Successfully.');
			redirect('admin/scheme');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Scheme not Delete Successfully.');
			redirect('admin/scheme');
		}
	}
}
?>
