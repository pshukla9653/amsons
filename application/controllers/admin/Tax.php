<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller
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
		$tax = $this->db->get('tbl_tax');
		$data['taxs']= $tax->result();
		$data["total_rows"] = $tax->num_rows();

		$this->load->view('admin/header');
		$this->load->view('admin/tax_list', $data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
	    
	    $query = $this->db->get_where('tax_type');
		$data['tax_type']= $query->result();

		if (!empty($this->input->post()))
		{
			$this->form_validation->set_rules('title', 'Tax Name', 'required');
			$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');


			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/header');
				$this->load->view('admin/tax_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$date_f=date_create($this->input->post('df'));
				$date_t=date_create($this->input->post('dt'));
				$values = array(
								'title' =>$this->input->post('title'),
								'tax_rate' =>$this->input->post('tax_rate'),
								'date_from' =>date_format($date_f,"Y-m-d"),
								'date_to' =>date_format($date_t,"Y-m-d"),
								'status' =>$this->input->post('status'),
								'tax_type' =>$this->input->post('tax_type'),
								'c_date' =>date('Y-m-d H:i:s')
							);
				$query = $this-> db->insert('tbl_tax', $values);
				$this->session->set_flashdata('msg', 'Tax Successfully Added');
				redirect('admin/tax');
			}
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/tax_add',$data);
			$this->load->view('admin/footer');
		}
	}

	public function edit($id)
	{
	    
	     	$query = $this->db->get_where('tax_type');
			$data['tax_type']= $query->result();
				
		if (!empty($this->input->post()))
		{
			$this->form_validation->set_rules('title', 'Tax Name', 'required');
			$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');

			if($this->form_validation->run() == FALSE)
			{
				$query = $this->db->get_where('tbl_tax', array('id' => $id));
				$data['tax']= $query->row();

				$this->load->view('admin/header');
				$this->load->view('admin/tax_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$date_f=date_create($this->input->post('df'));
				$date_t=date_create($this->input->post('dt'));
				$values = array(
								'title' =>$this->input->post('title'),
								'tax_rate' =>$this->input->post('tax_rate'),
								'date_from' =>date_format($date_f,"Y-m-d"),
								'date_to' =>date_format($date_t,"Y-m-d"),
								'tax_type' =>$this->input->post('tax_type'),
								'status' =>$this->input->post('status')
							);
				$this->db->update('tbl_tax',$values, "id =".$id);
				$this->session->set_flashdata('msg', 'Tax edit Successfully');
				redirect('admin/tax');
			}
		}
		else
		{
			$query = $this->db->get_where('tbl_tax', array('id' => $id));
			$data['tax']= $query->row();

			$this->load->view('admin/header');
			$this->load->view('admin/tax_edit',$data);
			$this->load->view('admin/footer');
		}
	}

	public function del($id)
	{
		if($this->db->delete("tbl_tax",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Tax Delete Successfully.');
			redirect('admin/tax');
		}
		else
		{
			$this->session->set_flashdata('msg', 'Tax not Delete Successfully.');
			redirect('admin/tax');
		}
	}

}
?>
