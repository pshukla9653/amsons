<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hd_scheme_attach extends CI_Controller
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
			
			$query = $this->db->query("SELECT tbl_hd_scheme.*, n.name as newspaper_name, p.position as cat_name ,city.name as city_name, d.day as day_name FROM tbl_hd_scheme INNER JOIN tbl_paper_city pc ON pc.id=tbl_hd_scheme.np_id INNER JOIN tbl_cities city ON city.id=pc.city_id INNER JOIN tbl_newspapers n ON n.id=pc.paper_id 
			INNER JOIN tbl_days d ON d.id=tbl_hd_scheme.days
			INNER JOIN tbl_position p ON p.id=tbl_hd_scheme.cat_id WHERE tbl_hd_scheme.type_id='3' AND (n.name LIKE '%".$name."%' OR d.day LIKE '%".$name."%' OR city.name LIKE '%".$name."%')");
			
			$config["base_url"] = base_url() . "admin/hd_scheme_attach/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['schemes']= $query->result();
		}
		else
		{
			$query = $this->db->get('tbl_hd_scheme');
			$data['schemes']= $query->result();

			$config["base_url"] = base_url(). "admin/hd_scheme_attach/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_hd_scheme.*, n.name as newspaper_name, p.position as cat_name ,city.name as city_name, d.day as day_name FROM tbl_hd_scheme INNER JOIN tbl_paper_city pc ON pc.id=tbl_hd_scheme.np_id INNER JOIN tbl_cities city ON city.id=pc.city_id INNER JOIN tbl_newspapers n ON n.id=pc.paper_id 
			INNER JOIN tbl_days d ON d.id=tbl_hd_scheme.days
			INNER JOIN tbl_position p ON p.id=tbl_hd_scheme.cat_id WHERE tbl_hd_scheme.type_id='3' order by tbl_hd_scheme.id desc limit {$config['per_page']} offset {$page}");
			$data['schemes']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/hd_scheme_attach_list', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('ad_cat[]', 'Ad Category', 'required');
			$this->form_validation->set_rules('schemes[]', 'Schemes', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
				$data['newspapers']= $query->result();
			
				$query = $this->db->get('tbl_position');
				$data['cats']= $query->result();
			
				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
				
				$query = $this->db->get('tbl_scheme');
				$data['schemes']= $query->result();
												
				$this->load->view('admin/header');
				$this->load->view('admin/hd_scheme_attach', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$date_f=date_create($this->input->post('date_f'));
				$cats=$this->input->post('ad_cat[]');
				$schemes=$this->input->post('schemes[]');
				$days=$this->input->post('days[]');
			
				$values = array(
								'scheme_id'=>0,
								'scheme_name'=>"",
								'paid'=>0,
								'free'=>0,
								'np_id'=>$this->input->post('newspaper'),
								'cat_id'=>0,
								'type_id'=>3,
								'days'=>0,
								'dis'=>$this->input->post('dis'),
								'dis_type'=>$this->input->post('dis_type'),
								'duration'=>$this->input->post('duration'),
								'duration_type'=>$this->input->post('dur_type'),
								'scheme_from'=>date_format($date_f,"Y-m-d"),
								'c_date'=>date('Y-m-d H:i:s')
							);
				
				$f=0;
				$add_id='';
				
					foreach($schemes as $scheme)
					{
						$query = $this->db->get_where('tbl_scheme', array('scheme_id' => $scheme));
						$scheme_data= $query->row();
						foreach($cats as $cat)
						{
							foreach($days as $day)
							{
								$query = $this->db->query("SELECT * FROM `tbl_hd_scheme` WHERE `scheme_id`='".$scheme."' AND `np_id`='".$values['np_id']."' AND `cat_id`='".$cat."' AND  `type_id`='3' AND `days`='".$day."'");
								$scheme=$query->row();
								if($scheme==NULL)
								{
									$values['scheme_name']=$scheme_data->scheme_name;
									$values['paid']=$scheme_data->paid;
									$values['free']=$scheme_data->free;
									$values['cat_id']=$cat;
									$values['scheme_id']=$scheme_data->scheme_id;
									$values['days']=$day;
									$this->db->insert('tbl_hd_scheme', $values);
								}
								else
								{
									$add_id=$add_id.",".$scheme->id;
									$f=1;
								}
							}
						}
					}
				
				if($f==0)
				{
					$this->session->set_flashdata('msg', 'All Scheme attach Successfully');
					redirect('admin/hd_scheme_attach');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Some Scheme allreday attach with this Newspaper ');
					redirect('admin/hd_scheme_attach');
				}				
			}
		}
		else
		{
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
			$data['newspapers']= $query->result();
			
			$query = $this->db->get('tbl_position');
			$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
				
			$query = $this->db->get('tbl_scheme');
			$data['schemes']= $query->result();
												
			$this->load->view('admin/header');
			$this->load->view('admin/hd_scheme_attach', $data);
			$this->load->view('admin/footer');
		}
	}

	
	
	public function edit($id)
	{
		
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_hd_scheme",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Scheme Delete Successfully.');
			redirect('admin/hd_scheme_attach');
		}
		else
		{
			$this->session->set_flashdata('msg', 'Scheme not Delete Successfully.');
			redirect('admin/hd_scheme_attach');
		}		
	}	
}
?>