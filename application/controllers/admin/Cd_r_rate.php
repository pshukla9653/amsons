<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cd_r_rate extends CI_Controller
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
			
			$query = $this->db->query("SELECT tbl_ad_price.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, city.name as city_name FROM tbl_ad_price 
INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_ad_price.ad_type
INNER JOIN tbl_cities city ON city.id=tbl_ad_price.city
INNER JOIN tbl_categories c ON c.id=tbl_ad_price.ad_cat_id WHERE (tbl_ad_price.ad_type='2') AND (n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%') order by tbl_ad_price.id desc");
			
			$config["base_url"] = base_url() . "admin/cd_r_rate/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['ad_prices']= $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT tbl_ad_price.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name FROM tbl_ad_price 
INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_ad_price.ad_type
INNER JOIN tbl_categories c ON c.id=tbl_ad_price.ad_cat_id WHERE tbl_ad_price.ad_type='2'");
			
			$config["base_url"] = base_url(). "admin/cd_r_rate/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_ad_price.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, city.name as city_name FROM tbl_ad_price 
INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_ad_price.ad_type
INNER JOIN tbl_cities city ON city.id=tbl_ad_price.city
INNER JOIN tbl_categories c ON c.id=tbl_ad_price.ad_cat_id WHERE tbl_ad_price.ad_type='2' order by tbl_ad_price.id desc limit {$config['per_page']} offset {$page}");
			$data['ad_prices']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/cd_r_rate_list', $data);
		$this->load->view('admin/footer');
	}
	
	
public function revise($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('ad_cat[]', 'Ad Category', 'required');			
			$this->form_validation->set_rules('ins_from', 'Insertion From', 'required');
			$this->form_validation->set_rules('ins_to', 'Insertion To', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			//$this->form_validation->set_rules('eprice', 'Extra Price', 'required');
			$size_type="";
			if(($this->input->post('fix_p') == 'on'))
			{
				$size_type='F';
				$this->form_validation->set_rules('f_min_l', 'Fix Column', 'required');
				$this->form_validation->set_rules('f_min_r', 'Fix Column', 'required');
			}
			else
			{
				if(($this->input->post('dc') == 'on'))
				{
					$size_type='D';
					$this->form_validation->set_rules('s_max_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_max_r', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_r', 'Single Column', 'required');
					$this->form_validation->set_rules('d_max_l', 'Double Column', 'required');
					$this->form_validation->set_rules('d_min_l', 'Double Column', 'required');
					$this->form_validation->set_rules('d_max_r', 'Double Column', 'required');
					$this->form_validation->set_rules('d_min_r', 'Double Column', 'required');
				}
				else
				{
					$size_type='S';
					$this->form_validation->set_rules('s_max_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_max_r', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_r', 'Single Column', 'required');
				}
			}
			
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('date_f', 'Date From', 'required');			
			
			if ($this->form_validation->run() == FALSE)
			{
				$query =$this->db->get_where('tbl_ad_price', array('id' => $id));
				$ap=$query->result();
				$data['ad_price']=$ap[0];
			
			
				$query =$this->db->get_where('tbl_newspapers', array('id' => $ap[0]->newspaper_id));
				$paper_name= $query->row();
			
				$query =$this->db->get_where('tbl_cities', array('id' => $ap[0]->city));
				$city_name= $query->row();
			
				$data['s_newspaper']= $paper_name->name ." , ".$city_name->name;
				//$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
				//$data['s_newspaper']= $query->row();
			
				//$query = $this->db->get('tbl_newspapers');
				//$data['newspapers']= $query->result();
				$query =$this->db->get_where('tbl_categories', array('id' => $ap[0]->ad_cat_id));
				$data['cat_name']= $query->row();
			
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
				$data['newspapers']= $query->result();
			
				//$query = $this->db->get('tbl_categories');
				//$data['cats']= $query->result();
			
				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
			
			
				$this->load->view('admin/header');
				$this->load->view('admin/cd_r_rate_set',$data);
				$this->load->view('admin/footer');
			}
			else			
			{
				$date_t=date_create($this->input->post('date_f'));
								
				date_sub($date_t,date_interval_create_from_date_string("1 day"));
				$values1 = array(
									'revise_rate'=>1,
									'date_to'=>date_format($date_t,"Y-m-d"),
								);
								
			//	$this->db->update('tbl_ad_price',$values1, "id=".$id);
					$cats=$this->input->post('ad_cat[]');
				$days=implode(",",$this->input->post('days[]'));
				
				$query =$this->db->get_where('tbl_ad_price', array('id' => $id));
				$ap=$query->row();
				
				$date_f=date_create($this->input->post('date_f'));
				
								
				$values = array(
								'newspaper_id'=>$ap->newspaper_id,
								'city'=>$ap->city,
								'ad_type'=>2,
								'ad_cat_id'=>$ap->ad_cat_id,
								'unit'=>$this->input->post('unit'),
								'color_type'=>$this->input->post('color'),
								'ad_price'=>$this->input->post('price'),
								'day_id'=>$days,
								'ins_from'=>$ap->ins_from,
								'ins_to'=>$ap->ins_to,
								'date_from'=>date_format($date_f,"Y-m-d"),
								'revise_rate'=>0,
								'duration'=>$ap->duration,
								'duration_type'=>$ap->duration_type,
								'f_size'=>$ap->f_size,
								'size_type'=>$size_type,
								'f_min_l'=>$this->input->post('f_min_l'),
								'f_min_r'=>$this->input->post('f_min_r'),
								's_min_l'=>$this->input->post('s_min_l'),
								's_min_r'=>$this->input->post('s_min_r'),
								's_max_l'=>$this->input->post('s_max_l'),
								's_max_r'=>$this->input->post('s_max_r'),
								'd_min_l'=>$this->input->post('d_min_l'),
								'd_min_r'=>$this->input->post('d_min_r'),
								'd_max_l'=>$this->input->post('d_max_l'),
								'd_max_r'=>$this->input->post('d_max_r'),
								'discount'=>$this->input->post('dis'),
								'non_focus_charge'=>$this->input->post('nfdc'),
								'c_date'=>date('Y-m-d H:i:s')
							);
														
				if($this->input->post('nfdc')==NULL)
				{
					$values['non_focus_charge']=0 .','.$this->input->post('nfdct');
				}
				else
				{
					$values['non_focus_charge']=$this->input->post('nfdc').','.$this->input->post('nfdct');
				}
				
				
					foreach($cats as $cat)
					{
						$flag=0;
						
						$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$cat."' AND color_type='".$values['color_type']."'");
				
						$prices=$query->result();
												
						if(!empty($prices))
						{
							foreach($prices as $price)
							{
								$this->db->update('tbl_ad_price',$values1, "id=".$price->id);
							
							}
							
						}
							$values['ad_cat_id']=$cat;
								$this-> db->insert('tbl_ad_price', $values);
										
					}
				
				
				$this->session->set_flashdata('msg', 'Price Successfully Revise');
				redirect('admin/cd_r_rate');
				
			}
		}
		else
		{
			$query =$this->db->get_where('tbl_ad_price', array('id' => $id));
			$ap=$query->result();
			$data['ad_price']=$ap[0];
			
			
			$query =$this->db->get_where('tbl_newspapers', array('id' => $ap[0]->newspaper_id));
			$paper_name= $query->row();
			
			$query =$this->db->get_where('tbl_cities', array('id' => $ap[0]->city));
			$city_name= $query->row();
		    $data['city_name']= $city_name;
			$data['newspaper_id']=$paper_name->id;
			$data['s_newspaper']= $paper_name->name ." , ".$city_name->name;
			//$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
			//$data['s_newspaper']= $query->row();
			
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
			$query =$this->db->get_where('tbl_categories', array('id' => $ap[0]->ad_cat_id));
			$data['cat_name']= $query->row();
			
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
			$data['newspapers']= $query->result();
			
			//$query = $this->db->get('tbl_categories');
			//$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
			
			
			$this->load->view('admin/header');
			$this->load->view('admin/cd_r_rate_set',$data);
			$this->load->view('admin/footer');
		}
	}













	

	public function add()
	{		
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('ad_cat[]', 'Ad Category', 'required');			
			$this->form_validation->set_rules('ins_from', 'Insertion From', 'required');
			$this->form_validation->set_rules('ins_to', 'Insertion To', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			//$this->form_validation->set_rules('eprice', 'Extra Price', 'required');
			$size_type="";
			if(($this->input->post('fix_p') == 'on'))
			{
				$size_type='F';
				$this->form_validation->set_rules('f_min_l', 'Fix Column', 'required');
				$this->form_validation->set_rules('f_min_r', 'Fix Column', 'required');
			}
			else
			{
				if(($this->input->post('dc') == 'on'))
				{
					$size_type='D';
					$this->form_validation->set_rules('s_max_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_max_r', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_r', 'Single Column', 'required');
					$this->form_validation->set_rules('d_max_l', 'Double Column', 'required');
					$this->form_validation->set_rules('d_min_l', 'Double Column', 'required');
					$this->form_validation->set_rules('d_max_r', 'Double Column', 'required');
					$this->form_validation->set_rules('d_min_r', 'Double Column', 'required');
				}
				else
				{
					$size_type='S';
					$this->form_validation->set_rules('s_max_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_max_r', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_r', 'Single Column', 'required');
				}
			}
			
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('date_f', 'Date From', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
				$data['newspapers']= $query->result();
				
				//$query = $this->db->get('tbl_categories');
				//$data['cats']= $query->result();
				
				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/disp_price_set', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$date_f=date_create($this->input->post('date_f'));
				
				$days=implode(",",$this->input->post('days[]'));
				$cats=$this->input->post('ad_cat[]');
				
				$query =$this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$paper=$query->row();
				
				$values = array(
								'newspaper_id'=>$paper->paper_id,
								'city'=>$paper->city_id,
								'ad_type'=>2,
								'ad_cat_id'=>0,
								'unit'=>$this->input->post('unit'),
								'color_type'=>$this->input->post('color'),
								'ad_price'=>$this->input->post('price'),
								'day_id'=>$days,
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'date_from'=>date_format($date_f,"Y-m-d"),
								'revise_rate'=>0,
								'duration'=>$this->input->post('duration'),
								'duration_type'=>$this->input->post('dur_type'),
								'f_size'=>$this->input->post('size'),
								'size_type'=>$size_type,
								'f_min_l'=>$this->input->post('f_min_l'),
								'f_min_r'=>$this->input->post('f_min_r'),
								's_min_l'=>$this->input->post('s_min_l'),
								's_min_r'=>$this->input->post('s_min_r'),
								's_max_l'=>$this->input->post('s_max_l'),
								's_max_r'=>$this->input->post('s_max_r'),
								'd_min_l'=>$this->input->post('d_min_l'),
								'd_min_r'=>$this->input->post('d_min_r'),
								'd_max_l'=>$this->input->post('d_max_l'),
								'd_max_r'=>$this->input->post('d_max_r'),
								'discount'=>$this->input->post('dis'),
								'non_focus_charge'=>$this->input->post('nfdc'),
								'c_date'=>date('Y-m-d H:i:s')
							);
				if($this->input->post('nfdc')==NULL)
				{
					$values['non_focus_charge']=0 .','.$this->input->post('nfdct');
				}
				else
				{
					$values['non_focus_charge']=$this->input->post('nfdc').','.$this->input->post('nfdct');
				}
				
				
				$f=0;
				$add_id='';
				
					foreach($cats as $cat)
					{
						$flag=0;
						
						$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$cat."' AND color_type='".$values['color_type']."'");
				
						$prices=$query->result();
												
						if($prices==NULL OR $prices[0]->id==NULL)
						{
							$values['ad_cat_id']=$cat;
							$this->db->insert('tbl_ad_price', $values);
						}
						else
						{
							foreach($prices as $price)
							{
								if($price->ins_to < $values['ins_from'] OR $price->ins_from > $values['ins_to'])
								{
									continue;
								}
								else
								{
									$add_id=$add_id.",".$price->id ;
									$f=1;
									$flag=1;
								}		
							}
							if($flag==0)
							{
								$values['ad_cat_id']=$cat;
								$this-> db->insert('tbl_ad_price', $values);
							}
							
						}
										
					}
				
				if($f==0)
				{					
					$this->session->set_flashdata('msg', 'All Ad price Successfully Added');
					redirect('admin/disp_price');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Some price allreday Added with this details ');
					redirect('admin/disp_price');
				}				
			}
		}
		else
		{
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
			$data['newspapers']= $query->result();
						
			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
						
			$this->load->view('admin/header');
			$this->load->view('admin/disp_price_set', $data);
			$this->load->view('admin/footer');
		}
	}

	public function revise11($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('ad_cat[]', 'Ad Category', 'required');			
			$this->form_validation->set_rules('ins_from', 'Insertion From', 'required');
			$this->form_validation->set_rules('ins_to', 'Insertion To', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			//$this->form_validation->set_rules('eprice', 'Extra Price', 'required');
			$size_type="";
			if(($this->input->post('fix_p') == 'on'))
			{
				$size_type='F';
				$this->form_validation->set_rules('f_min_l', 'Fix Column', 'required');
				$this->form_validation->set_rules('f_min_r', 'Fix Column', 'required');
			}
			else
			{
				if(($this->input->post('dc') == 'on'))
				{
					$size_type='D';
					$this->form_validation->set_rules('s_max_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_max_r', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_r', 'Single Column', 'required');
					$this->form_validation->set_rules('d_max_l', 'Double Column', 'required');
					$this->form_validation->set_rules('d_min_l', 'Double Column', 'required');
					$this->form_validation->set_rules('d_max_r', 'Double Column', 'required');
					$this->form_validation->set_rules('d_min_r', 'Double Column', 'required');
				}
				else
				{
					$size_type='S';
					$this->form_validation->set_rules('s_max_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_l', 'Single Column', 'required');
					$this->form_validation->set_rules('s_max_r', 'Single Column', 'required');
					$this->form_validation->set_rules('s_min_r', 'Single Column', 'required');
				}
			}
			
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('date_f', 'Date From', 'required');			
			
			if ($this->form_validation->run() == FALSE)
			{
				//$query = $this->db->get('tbl_newspapers');
				//$data['newspapers']= $query->result();
				
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
				$data['newspapers']= $query->result();
											
				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
			
				$query =$this->db->get_where('tbl_ad_price', array('id' => $id));
				$ap=$query->result();
				$data['ad_price']=$ap[0];
				
				$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
				$data['s_newspaper']= $query->row();
				
				$this->load->view('admin/header');
				$this->load->view('admin/disp_price_edit',$data);
				$this->load->view('admin/footer');
			}
			else			
			{
				$date_f=date_create($this->input->post('date_f'));
				
				$days=implode(",",$this->input->post('days[]'));
				$cats=$this->input->post('ad_cat[]');
				
				$query =$this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$paper=$query->row();
				
				$values = array(
								'newspaper_id'=>$paper->paper_id,
								'city'=>$paper->city_id,
								'ad_type'=>2,
								'ad_cat_id'=>$this->input->post('ad_cat'),
								'unit'=>$this->input->post('unit'),
								'color_type'=>$this->input->post('color'),
								'ad_price'=>$this->input->post('price'),
								'day_id'=>$days,
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'date_from'=>date_format($date_f,"Y-m-d"), 
								'revise_rate'=>0,
								'duration'=>$this->input->post('duration'),
								'duration_type'=>$this->input->post('dur_type'),
								'f_size'=>$this->input->post('size'),
								'size_type'=>$size_type,
								'f_min_l'=>$this->input->post('f_min_l'),
								'f_min_r'=>$this->input->post('f_min_r'),
								's_min_l'=>$this->input->post('s_min_l'),
								's_min_r'=>$this->input->post('s_min_r'),
								's_max_l'=>$this->input->post('s_max_l'),
								's_max_r'=>$this->input->post('s_max_r'),
								'd_min_l'=>$this->input->post('d_min_l'),
								'd_min_r'=>$this->input->post('d_min_r'),
								'd_max_l'=>$this->input->post('d_max_l'),
								'd_max_r'=>$this->input->post('d_max_r'),
								'discount'=>$this->input->post('dis'),
								'non_focus_charge'=>$this->input->post('nfdc'),
								'c_date'=>date('Y-m-d H:i:s')
							);
				if($this->input->post('nfdc')==NULL)
				{
					$values['non_focus_charge']=0 .','.$this->input->post('nfdct');
				}
				else
				{
					$values['non_focus_charge']=$this->input->post('nfdc').','.$this->input->post('nfdct');
				}
				
				$f=0;
				$add_id='';				
						
						//$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$values['ad_cat_id']."'");
						
						$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$values['ad_cat_id']."' AND color_type='".$values['color_type']."'");
				
						$prices=$query->result();
												
						if($prices==NULL OR $prices[0]->id==NULL)
						{							
							$this->db->update('tbl_ad_price',$values, "id=".$id);
							$this->session->set_flashdata('msg', 'Price Successfully edit');
							redirect('admin/disp_price');							
						}
						else
						{
							foreach($prices as $price)
							{
								if($price->id==$id)
								{
									continue;
								}
								if($price->ins_to < $values['ins_from'] OR $price->ins_from > $values['ins_to'])
								{
									continue;
								}
								else
								{
									$add_id=$add_id.",".$price->id ;
									$f=1;									
								}		
							}
							if($f==0)
							{
								$this->db->update('tbl_ad_price',$values, "id=".$id);
								$this->session->set_flashdata('msg', 'Price Successfully edit');
								redirect('admin/disp_price');
							}
							else
							{
								$this->session->set_flashdata('msg', 'Ad price already Added with this details');
								redirect('admin/disp_price');
							}
							
						}
				
			}
		}
		else
		{
			$query =$this->db->get_where('tbl_ad_price', array('id' => $id));
			$ap=$query->result();
			$data['ad_price']=$ap[0];
			
			$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
			$data['s_newspaper']= $query->row();
			
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
			$data['newspapers']= $query->result();
			
			//$query = $this->db->get('tbl_categories');
			//$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
			
			
			$this->load->view('admin/header');
			$this->load->view('admin/disp_price_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_ad_price",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Ad price Delete Successfully.');
			redirect('admin/disp_price');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Ad price not Delete Successfully.');
			redirect('admin/disp_price');
		}		
	}
	
	
	public function get_heading111()
	{
		$id=$_POST['id'];
		
		$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$id."'");
		$heading= $query->result();
		
		echo json_encode($heading);
	}
	
	
	
	public function get_heading()
	{
		$id=$_POST['id'];
		
	//	$query =$this->db->get_where('tbl_paper_city', array('id' => $id));
	//	$paper=$query->row();		
		
		$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$id."'");

		$heading= $query->result();
		
		echo json_encode($heading);
	}


	
}
?>