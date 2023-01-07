<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magazine extends CI_Controller
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
	
	
//Magazine Group functions 

	public function index()
	{
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			
			$newspaper_group= $this->db->query("SELECT * from tbl_mag_group WHERE name LIKE '%".$name."%'");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/magazine/index";
			$config["total_rows"] = $newspaper_group->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->db->query("SELECT * from tbl_mag_group WHERE name LIKE '%".$name."%' order by id desc limit {$config['per_page']} offset {$page}");
			
			$data['newspaper_groups']= $newspaper_group->result();
		}
		else
		{
			$newspaper_group = $this->db->get('tbl_mag_group');
		
			$config = array();
			$config["base_url"] = base_url(). "admin/magazine/index";
			$config["total_rows"] = $newspaper_group->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	
			
			$newspaper_group = $this->db->get('tbl_mag_group',$config['per_page'],$page);
			$data['newspaper_groups']= $newspaper_group->result();
			
		}
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $newspaper_group->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/m_group_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function group_add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'Group Name', 'required|is_unique[tbl_mag_group.ng_name]',array('required' => 'You must provide a %s.','is_unique'=>'Magazine Group with this name already Added.'));
			$this->form_validation->set_rules('city', 'City', 'required');
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/header');
				$this->load->view('admin/m_group_add');
				$this->load->view('admin/footer');
			}
			else
			{
				/*			
				//Set the config
				$config['upload_path'] = 'include/backend/img/logo_image/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '100';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				$this->load->library('upload', $config);
				
				//Upload file
				if( ! $this->upload->do_upload("logo"))
				{
					//echo the errors
					echo $this->upload->display_errors();
					die;
				}
				//If the upload success
				$data = array('upload_data' => $this->upload->data());
				$logo = $data['upload_data']['file_name'] ;
				*/

				
				$values = array(
								'ng_name' =>$this->input->post('name'),
								'ng_phone' =>$this->input->post('mobile'),
								'ng_email' =>$this->input->post('email'),
								'ng_fax' =>$this->input->post('fax'),
								'ng_address' =>$this->input->post('address'),
								'ng_city' =>$this->input->post('city'),
								'ng_state' =>$this->input->post('state'),'ng_contact_parson' =>$this->input->post('c_p'),'ng_no_of_additions' =>$this->input->post('addition'), 'ng_cdate' =>date('Y-m-d H:i:s'),
								'ng_opening' =>$this->input->post('opening') 
							);
				$query = $this-> db->insert('tbl_mag_group', $values);
				$this->session->set_flashdata('msg', 'magazine Group Successfully Added');
				redirect('admin/magazine');
			}
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/m_group_add');
			$this->load->view('admin/footer');
		}
	}
	
	public function group_edit($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('name', 'Group Name', 'required');
			if($this->input->post('name')!=$this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Group Name', 'required|is_unique[tbl_mag_group.ng_name]',array('required' => 'You must provide a %s.','is_unique'=>'Magazine Group with this name already Added.'));			
			}	
			
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get_where('tbl_mag_group', array('ng_id' => $id));
				$data['newspaper_group']= $query->row();
			
				$this->load->view('admin/header');
				$this->load->view('admin/m_group_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
								'ng_name' =>$this->input->post('name'),
								'ng_phone' =>$this->input->post('mobile'),
								'ng_email' =>$this->input->post('email'),
								'ng_fax' =>$this->input->post('fax'),
								'ng_address' =>$this->input->post('address'),
								'ng_city' =>$this->input->post('city'),
								'ng_state' =>$this->input->post('state'),'ng_contact_parson' =>$this->input->post('c_p'),'ng_no_of_additions' =>$this->input->post('addition'),
								'ng_opening' =>$this->input->post('opening')
							);
				$this->db->update('tbl_mag_group',$values, "ng_id =".$id);
				$this->session->set_flashdata('msg', 'Magazine Group edit Successfully');
				redirect('admin/magazine');
			}
		}
		else
		{
			$query = $this->db->get_where('tbl_mag_group', array('ng_id' => $id));
			$data['newspaper_group']= $query->row();
			
			$this->load->view('admin/header');
			$this->load->view('admin/m_group_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function group_del($id)
	{	
		if($this->db->delete("tbl_mag_group",array('ng_id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Magazine Group Delete Successfully.');
			redirect('admin/magazine');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'magazine Group not Delete Successfully.');
			redirect('admin/magazine');
		}		
	}
	
	
	
//Magazine functions 	
	
	public function show()
	{
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			
			$newspaper = $this->db->query("SELECT * from tbl_mag WHERE name LIKE '%".$name."%'");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/magazine/show";
			$config["total_rows"] = $newspaper->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->db->query("SELECT * from tbl_mag WHERE name LIKE '%".$name."%' order by id desc limit {$config['per_page']} offset {$page}");
			
			$data['newspapers']= $newspaper->result();
		}
		else
		{
			$newspaper = $this->db->get('tbl_mag');
					
			$config = array();
			$config["base_url"] = base_url(). "admin/magazine/show";
			$config["total_rows"] = $newspaper->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	
			
			$newspaper = $this->db->get('tbl_mag',$config['per_page'],$page);
			$data['newspapers']= $newspaper->result();
			
		}
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $newspaper->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/mag_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_mag.name]',array('required' => 'You must provide a %s.','is_unique'=>'magazine with this name already Added.'));
			$this->form_validation->set_rules('g_id', 'magazine Group', 'required');
			
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_cities');
				$data['cities']= $query->result();
			
				$newspaper_group = $this->db->get('tbl_mag_group');
				$data['news_groups']= $newspaper_group->result();
			
				$query = $this->db->get('tbl_paper_type');
				$data['paper_types']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/mag_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$cities=implode(",",$this->input->post('cities[]'));				
				//Set the config
				$config['upload_path'] = 'include/backend/img/logo_image/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '100';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				$this->load->library('upload', $config);
				
				//Upload file
				if( ! $this->upload->do_upload("logo"))
				{
					//echo the errors
					echo $this->upload->display_errors();
					die;
				}
				//If the upload success
				$data = array('upload_data' => $this->upload->data());
				$logo = $data['upload_data']['file_name'] ;
				
				$values = array(
								'g_id'=>$this->input->post('g_id'),
								'name' =>$this->input->post('name'),
								'short_name' =>$this->input->post('sname'),
								'language' =>$this->input->post('language'),
								'address' =>$this->input->post('address'),
								'p_type' =>$this->input->post('nt'),
								'no_of_additions' =>$this->input->post('addition'),
								'no_of_copies' =>$this->input->post('copy'),
								'city' =>$cities,
								'logo' =>$logo,
								'c_date' => date('Y-m-d H:i:s')					
							);
				$query = $this-> db->insert('tbl_mag', $values);
				$this->session->set_flashdata('msg', 'Magazine Successfully Added');
				redirect('admin/magazine/show');
			}
		}
		else
		{
			$query = $this->db->get('tbl_cities');
			$data['cities']= $query->result();
			
			$newspaper_group = $this->db->get('tbl_mag_group');
			$data['news_groups']= $newspaper_group->result();
			
			$query = $this->db->get('tbl_paper_type');
			$data['paper_types']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/mag_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function edit_mag($id)
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($this->input->post('name')!=$this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_mag.name]',array('required' => 'You must provide a %s.','is_unique'=>'magazine with this name already Added.'));
			}
			$this->form_validation->set_rules('cities[]', 'City', 'required');
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_cities');
				$data['cities']= $query->result();
			
				$newspaper_group = $this->db->get('tbl_mag_group');
				$data['news_groups']= $newspaper_group->result();
			
				$query = $this->db->get('tbl_paper_type');
				$data['paper_types']= $query->result();
			
				$query = $this->db->get_where('tbl_mag', array('id' => $id));
				$data['newspaper']= $query->row();
						
				$p_cities=explode(",",$data['newspaper']->city);			
				$data['p_cities']= $p_cities;
				$this->load->view('admin/header');
				$this->load->view('admin/mag_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$cities=implode(",",$this->input->post('cities[]'));				
				//Set the config
				$config['upload_path'] = 'include/backend/img/logo_image/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '100';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				$this->load->library('upload', $config);
				
				//Upload file
				if( ! $this->upload->do_upload("logo"))
				{
					//echo the errors
					$error= $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					$logo =$this->input->post("logo_pic");
				}
				else
				{
					$file=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/logo_image/".$this->input->post("logo_pic");
					unlink($file);
				//If the upload success
					$data = array('upload_data' => $this->upload->data());
					$logo = $data['upload_data']['file_name'] ;
				}
				$values = array(
								'g_id'=>$this->input->post('g_id'),
								'name' =>$this->input->post('name'),
								'short_name' =>$this->input->post('sname'),
								'language' =>$this->input->post('language'),
								'address' =>$this->input->post('address'),
								'p_type' =>$this->input->post('nt'),
								'no_of_additions' =>$this->input->post('addition'),
								'no_of_copies' =>$this->input->post('copy'),
								'city' =>$cities,
								'logo' =>$logo,
							);
				$this->db->update('tbl_mag',$values, "id =".$id);
				$this->session->set_flashdata('msg', 'magazine edit Successfully');
				redirect('admin/magazine/show');
			}
		}
		else
		{
			$query = $this->db->get('tbl_cities');
			$data['cities']= $query->result();
			
			$newspaper_group = $this->db->get('tbl_mag_group');
			$data['news_groups']= $newspaper_group->result();
			
			$query = $this->db->get('tbl_paper_type');
			$data['paper_types']= $query->result();
			
			$query = $this->db->get_where('tbl_mag', array('id' => $id));
			$data['newspaper']= $query->row();
						
			$p_cities=explode(",",$data['newspaper']->city);			
			$data['p_cities']= $p_cities;
			$this->load->view('admin/header');
			$this->load->view('admin/mag_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del_mag($id)
	{		
		$this->db->select('logo');
		$this->db->from('tbl_mag');
		$this->db->where('id',$id);
		//slider Icon file path 
		$file=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/logo_image/".$this->db->get()->row('logo');
	
		if($this->db->delete("tbl_mag",array('id' => $id))&&unlink($file))
		{
			$this->session->set_flashdata('msg', 'magazine Delete Successfully.');
			redirect('admin/magazine/show');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'magazines not Delete Successfully.');
			redirect('admin/magazine/show');
		}
		
	}
}
?>