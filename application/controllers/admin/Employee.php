<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{ 
	function __construct()
	{		
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		}
		if($this->session->userdata('access')->user==0)
		{
			redirect('admin/dashboard');
		}
		$this->load->library("pagination");
	}

	
	public function index()
	{
		$config = array();
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul><!--pagination-->';
		
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>'; 

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			$employees=$this->db->query("SELECT * FROM tbl_employee WHERE `e_name` LIKE '%".$name."%' OR `e_phone` LIKE '%".$name."%' OR `e_email` LIKE '%".$name."%' ORDER BY e_id DESC");

			$config["base_url"] = base_url() . "admin/employee/index";
			$config["total_rows"] = $employees->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;

			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['employees']= $employees->result();
		}
		else
		{
			$employees = $this->db->query("SELECT * FROM tbl_employee order by e_id desc" );
		
			$config["base_url"] = base_url() . "admin/employee/index";
			$config["total_rows"] = $employees->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
			$employees=$this->db->query("SELECT * FROM tbl_employee ORDER BY e_id DESC limit {$config['per_page']} offset {$page}");
			
			$data['employees']= $employees->result();
		}
				
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;      
		$data['offset'] = $page ;
		$data["total_rows"] = $employees->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/employee_list',$data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post()))
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('user', 'Login Name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->db->select('id, name');			
				$query = $this->db->get('tbl_admin');				
				$data['users']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/employee_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
								'e_name'=>$this->input->post('name'),
								'e_phone'=>$this->input->post('mobile'),
								'e_email'=>$this->input->post('email'),
								'e_address1'=>$this->input->post('address'),
								'e_city'=>$this->input->post('city'),
								'e_state'=>$this->input->post('state'),
								'e_pin_code'=>$this->input->post('pin'),
								'e_cr_limit'=>$this->input->post('crlimit'),
								'user_id'=>$this->input->post('user'),
								'e_join_date'=>date('Y-m-d')
							   );
							   
					$query = $this-> db->insert('tbl_employee', $values);
					
					$this->session->set_flashdata('msg', 'Employee Add.');
					redirect('admin/employee');
			}
		}
		else
		{
			$this->db->select('id, name');			
			$query = $this->db->get('tbl_admin');				
			$data['users']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/employee_add',$data);
			$this->load->view('admin/footer');
		}

	}
	
	public function edit($id)
	{
		if (!empty($this->input->post()))
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('user', 'Login Name', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$employee = $this->db->get_where('tbl_employee', array('e_id' => $id));
				$e=$employee->result();
				$data['employee']=$e[0];
				
				$this->db->select('id, name');			
				$query = $this->db->get('tbl_admin');				
				$data['users']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/employee_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
								'e_name'=>$this->input->post('name'),
								'e_phone'=>$this->input->post('mobile'),
								'e_email'=>$this->input->post('email'),
								'e_address1'=>$this->input->post('address'),
								'e_city'=>$this->input->post('city'),
								'e_state'=>$this->input->post('state'),
								'e_pin_code'=>$this->input->post('pin'),
								'e_cr_limit'=>$this->input->post('crlimit'),
								'user_id'=>$this->input->post('user'),
								'e_last_date'=>$this->input->post('last_date')
							   );
							    
					$this->db->update('tbl_employee',$values, "e_id =".$id);
					
					$this->session->set_flashdata('msg', 'Employee update.');

					redirect('admin/employee');
			} 
				
		}
		else
		{
			$employee = $this->db->get_where('tbl_employee', array('e_id' => $id));
			$e=$employee->result();
			$data['employee']=$e[0];
			
			$this->db->select('id, name');			
			$query = $this->db->get('tbl_admin');				
			$data['users']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/employee_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_employee","e_id=".$id))
		{
			$this->session->set_flashdata('msg', 'Employee Delete Successfully.');
			redirect('admin/employee');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Employee not Delete Successfully.');
			redirect('admin/employee');
		}
	}

}
?>