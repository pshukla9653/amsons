<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
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
		$cat = $this->db->get('tbl_categories');
		$data['cats'] = $cat->result();
		
		$data["total_rows"] = $cat->num_rows();
		$this->load->view('admin/header');
		$this->load->view('admin/categories', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			//$this->form_validation->set_rules('category_name', 'Category', 'required');
			$this->form_validation->set_rules('category_name', 'Category', 'required|is_unique[tbl_categories.name]',array('is_unique' => 'The Category already added.'));
			$this->form_validation->set_rules('cat_status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/header');
				$this->load->view('admin/category_add');
				$this->load->view('admin/footer');
			}
			else
			{
				//Set the config
				$config['upload_path'] = 'include/backend/img/cat_icon/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '100';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				//$this->load->library('upload', $config);
				
				//Upload file
				/*if( ! $this->upload->do_upload("cat_icon")){
					//echo the errors
					echo $this->upload->display_errors();
					die;
				}*/

				//If the upload success
				//$data = array('upload_data' => $this->upload->data());
				//$cat_icon = $data['upload_data']['file_name'] ;
				$cat_icon ="";
				
				$values = array(
					'name' => $this->input->post('category_name'),
					'status' => $this->input->post('cat_status'),
				//	'description' => $this->input->post('cat_desc'),
					'cat_icon' => $cat_icon,
					'c_date'=> date('Y-m-d H:i:s')
				);
				$query = $this-> db->insert('tbl_categories', $values);
				$this->session->set_flashdata('msg', 'Category Successfully Added');
				redirect('admin/categories');
			}
		} else 
		{
			$this->load->view('admin/header');
			$this->load->view('admin/category_add');
			$this->load->view('admin/footer');
			
		}
	}
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('category_name', 'Category', 'required');
			$this->form_validation->set_rules('cat_status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$cat = $query = $this->db->get_where('tbl_categories', array('id' => $id));
				$data['cat_details'] = $cat->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/category_edit', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				if(!empty($_FILES['cat_icon']['name']))
				{
					//Set the config
					$config['upload_path'] = 'include/backend/img/cat_icon/'; //Use relative or absolute path
					$config['allowed_types'] = 'gif|jpg|png'; 
					$config['max_size'] = '100';
					$config['max_width'] = '1024';
					$config['max_height'] = '768';
					$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
					$this->load->library('upload', $config);
				
					//Upload file
					if( ! $this->upload->do_upload("cat_icon"))
					{
						//echo the errors
						echo $this->upload->display_errors();
						die;
					}
					//If the upload success
					$data = array('upload_data' => $this->upload->data());
					$cat_icon = $data['upload_data']['file_name'] ;
					
					//get old pic name
					$cat = $this->db->query("SELECT cat_icon FROM tbl_categories where id = ".$id."" );
					$icon=$cat->result();
					
					//update new pic name
					$this->db->update('tbl_categories',array('cat_icon' => $cat_icon), "id =".$id);
					
					//delete old pic 
					$path=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/cat_icon/".$icon[0]->cat_icon;
					unlink($path);
				}
				
				$values = array(
					'name' => $this->input->post('category_name'),
					'status' => $this->input->post('cat_status'),					
					'description' => $this->input->post('cat_desc'),					
				);
				$this->db->update('tbl_categories', $values, "id =".$id);
				//$query = $this-> db->insert('tbl_categories', $values);
				$this->session->set_flashdata('msg', 'Category Successfully Edit..');
				redirect('admin/categories');
			}
		
		} 
		else 
		{
			$cat = $query = $this->db->get_where('tbl_categories', array('id' => $id));
			$data['cat_details'] = $cat->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/category_edit', $data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function del($id)
	{
		//delete pic
		$cat = $this->db->query("SELECT cat_icon FROM tbl_categories where id = ".$id."" );
		$icon=$cat->result();
		
		$path=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/cat_icon/".$icon[0]->cat_icon;
		unlink($path);
		$this->db->delete("tbl_categories",array('id' => $id));	
		
		$this->session->set_flashdata('msg', 'Category Successfully Deleted');
		redirect('admin/categories');	
	}
	
	//sub heading master function
	public function sub_list()
	{
		$query = $this->db->query("SELECT tbl_sub_heading.*, c.name as cat_name FROM tbl_sub_heading
INNER JOIN tbl_categories c ON c.id=tbl_sub_heading.cat_id");

		$data['sub_heads']= $query->result();
		$data["total_rows"] = $query->num_rows();
		
		$this->load->view('admin/header');
		$this->load->view('admin/sub_heading',$data);
		$this->load->view('admin/footer');
	}
	
	public function sub_add()
	{
		if (!empty($this->input->post())) 
		{
			//$this->form_validation->set_rules('heading', 'Sub Heading', 'required');
			$this->form_validation->set_rules('heading', 'Sub Heading', 'required|is_unique[tbl_sub_heading.sub_heading]',array('is_unique' => 'The Sub Heading already added.'));
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/sub_heading_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
					'cat_id' => $this->input->post('cat'),
					'sub_heading' => $this->input->post('heading'),
					'c_date'=> date('Y-m-d H:i:s')
				);
				$query = $this-> db->insert('tbl_sub_heading', $values);
				$this->session->set_flashdata('msg', 'Sub Heading Successfully Added');
				redirect('admin/categories/sub_list');
			}
		} 
		else 
		{
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/sub_heading_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function sub_edit($id)
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('heading', 'Sub Heading', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get_where('tbl_sub_heading', array('id' => $id));
				$data['sub_heading'] = $query->row();
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/sub_heading_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
					'cat_id' => $this->input->post('cat'),
					'sub_heading' => $this->input->post('heading')
				);
				$this->db->update('tbl_sub_heading', $values, "id =".$id);
				
				$this->session->set_flashdata('msg', 'Sub Heading Successfully Edit..');
				redirect('admin/categories/sub_list');
				
			}
		} 
		else 
		{
			$query = $this->db->get_where('tbl_sub_heading', array('id' => $id));
			$data['sub_heading'] = $query->row();
				
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/sub_heading_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function sub_del($id)
	{
		$this->db->delete("tbl_sub_heading",array('id' => $id));	
		
		$this->session->set_flashdata('msg', 'Sub Heading Successfully Deleted');
		redirect('admin/categories/sub_list');	
	}
}
