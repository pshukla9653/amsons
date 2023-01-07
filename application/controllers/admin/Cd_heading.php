<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cd_heading extends CI_Controller
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
			
			$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE n.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%'");
			
			$config["base_url"] = base_url() . "admin/cd_heading/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['papers']= $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id");
			
			$config["base_url"] = base_url(). "admin/cd_heading/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id order by tbl_cat_with_paper.id desc limit {$config['per_page']} offset {$page}");
			$data['papers']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/cd_heading_attach_list', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('ad_cat[]', 'Ad Category', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_newspapers');
				$data['newspapers']= $query->result();			
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
												
				$this->load->view('admin/header');
				$this->load->view('admin/cd_heading_attach', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				
				$cats=$this->input->post('ad_cat[]');
				
				$values = array(
								'newspaper_id'=>$this->input->post('newspaper'),
								'cat_id'=>0,
								'c_date'=>date('Y-m-d H:i:s')
							);
				
				$f=0;
				$add_id='';
				
					foreach($cats as $cat)
					{
						$query = $this->db->query("SELECT * FROM tbl_cat_with_paper WHERE newspaper_id='".$values['newspaper_id']."' AND cat_id='".$cat."'");
				
						$papers=$query->result();
												
						if($papers==NULL OR $papers[0]->id==NULL)
						{
							$values['cat_id']=$cat;
							$this->db->insert('tbl_cat_with_paper', $values);
						}
						else
						{
							$add_id=$add_id.",".$papers[0]->id;
							$f=1;
						}
										
					}
				
				if($f==0)
				{
					$this->session->set_flashdata('msg', 'All Heading attach Successfully');
					redirect('admin/cd_heading');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Some Heading allreday attach with this Newspaper ');
					redirect('admin/cd_heading');
				}				
			}
		}
		else
		{
			$query = $this->db->get('tbl_newspapers');
			$data['newspapers']= $query->result();			
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
												
			$this->load->view('admin/header');
			$this->load->view('admin/cd_heading_attach', $data);
			$this->load->view('admin/footer');
		}
	}

	public function edit($id)
	{
		
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_cat_with_paper",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Heading Delete Successfully.');
			redirect('admin/cd_heading');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Heading not Delete Successfully.');
			redirect('admin/cd_heading');
		}		
	}	
}
?>