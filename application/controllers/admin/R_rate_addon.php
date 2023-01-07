<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class r_rate_addon extends CI_Controller
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
			
			$query = $this->db->query("SELECT tbl_add_on.*, n.name as newspaper_name, m.name as newspaper,t.name as type_name, c.name as cat_name FROM tbl_add_on INNER JOIN tbl_newspapers n ON n.id=tbl_add_on.m_paper_id INNER JOIN tbl_news_type t ON t.id=tbl_add_on.ad_type INNER JOIN tbl_newspapers m ON m.id=tbl_add_on.a_paper_id INNER JOIN tbl_categories c ON c.id=tbl_add_on.ad_cat_id WHERE (tbl_add_on.ad_type='1')
AND (n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%') order by tbl_add_on.id desc");
			
			$config["base_url"] = base_url() . "admin/r_rate_addon/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['ad_prices']= $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT tbl_add_on.*, n.name as newspaper_name, m.name as newspaper,t.name as type_name, c.name as cat_name FROM tbl_add_on INNER JOIN tbl_newspapers n ON n.id=tbl_add_on.m_paper_id INNER JOIN tbl_news_type t ON t.id=tbl_add_on.ad_type INNER JOIN tbl_newspapers m ON m.id=tbl_add_on.a_paper_id INNER JOIN tbl_categories c ON c.id=tbl_add_on.ad_cat_id WHERE (tbl_add_on.ad_type='1')
");
			
			$config["base_url"] = base_url(). "admin/r_rate_addon/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_add_on.*, n.name as newspaper_name, m.name as newspaper,t.name as type_name, c.name as cat_name FROM tbl_add_on INNER JOIN tbl_newspapers n ON n.id=tbl_add_on.m_paper_id INNER JOIN tbl_news_type t ON t.id=tbl_add_on.ad_type INNER JOIN tbl_newspapers m ON m.id=tbl_add_on.a_paper_id INNER JOIN tbl_categories c ON c.id=tbl_add_on.ad_cat_id WHERE (tbl_add_on.ad_type='1')
 order by tbl_add_on.id desc limit {$config['per_page']} offset {$page}");
			$data['ad_prices']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/ad_r_rate_list', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function revise($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('newspaper_group', 'Group', 'required');
			$this->form_validation->set_rules('m_newspaper', 'newspaper', 'required');
			$this->form_validation->set_rules('a_newspaper', 'add on newspaper', 'required');
			$this->form_validation->set_rules('ad_cat[]', 'Heading', 'required');
			$this->form_validation->set_rules('ins_from', 'Insertion', 'required');
			$this->form_validation->set_rules('ins_to', 'Insertion', 'required');
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('f_unit', 'From Unit', 'required');
			$this->form_validation->set_rules('t_unit', 'To Unit', 'required');
			$this->form_validation->set_rules('mul', 'Add/Multiple', 'required');
			//$this->form_validation->set_rules('date_t', 'Date To', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
			    	$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
			
			$query = $this->db->get_where('tbl_add_on', array('id' => $id));
			$data['add_on']= $query->row();

			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
				$query =$this->db->get_where('tbl_add_on', array('id' => $id));
				$ap=$query->result();
				$data['ad_price']=$ap[0];
			
				$query =$this->db->get_where('tbl_newspapers', array('id' => $ap[0]->newspaper_id));
				$paper_name= $query->row();
			
				$query =$this->db->get_where('tbl_cities', array('id' => $ap[0]->city));
				$city_name= $query->row();
			
				$data['s_newspaper']= $paper_name->name ." , ".$city_name->name;
			//$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
				$query =$this->db->get_where('tbl_categories', array('id' => $ap[0]->ad_cat_id));
				$data['cat_name']= $query->row();
			
			
			
			
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
				$data['newspapers']= $query->result();
			
											
			
				$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$ap[0]->newspaper_id."'");
		
				$data['cats']= $query->result();
			//$query = $this->db->get('tbl_categories');
			//$data['cats']= $query->result();
			
				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
			
			
				$this->load->view('admin/header');
				$this->load->view('admin/ad_r_rate_set',$data);
				$this->load->view('admin/footer');
			}
			else			
			{
				$date_t=date_create($this->input->post('date_from'));
								
				date_sub($date_t,date_interval_create_from_date_string("1 day"));
				$values1 = array(
									'revise_rate'=>1,
									'date_to'=>date_format($date_t,"Y-m-d"),
								);
				
				
			//	$this->db->update('tbl_add_on',$values1, "id=".$id);
				
				$days=implode(",",$this->input->post('days[]'));
			$cats=$this->input->post('ad_cat[]');
		
				//$query =$this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				//$paper=$query->row();
				
				$query =$this->db->get_where('tbl_add_on', array('id' => $id));
				$ap=$query->row();
				
				$date_f=date_create($this->input->post('date_from'));
				
			$values = array(
					'g_id'=>$this->input->post('newspaper_group'),
					'm_paper_id'=>$this->input->post('m_newspaper'),
					'a_paper_id'=>$this->input->post('a_newspaper'),
					'ad_type'=>1,
					'revise_rate'=>0,
					'ad_cat_id'=>$this->input->post('a_newspaper'),
					'ins_from'=>$this->input->post('ins_from'),
					'ins_to'=>$this->input->post('ins_to'),
					'day_id'=>$days,
					'unit'=>$this->input->post('unit'),
					'date_from'=>date_format($date_f,"Y-m-d"),
				   	'f_unit'=>$this->input->post('f_unit'),
					't_unit'=>$this->input->post('t_unit'),
					'price'=>$this->input->post('price'),
					'e_price'=>$this->input->post('eprice'),
					'add_mul'=>$this->input->post('mul')
				);
		//	$this->db->insert('tbl_add_on', $values);
					$f=0;
				$add_id='';
				
					foreach($cats as $cat)
					{
						$flag=0;
						
						$query = $this->db->query("SELECT * FROM tbl_add_on WHERE g_id='".$values['g_id']."' AND m_paper_id='".$values['m_paper_id']."' AND a_paper_id='".$values['a_paper_id']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$cat."' and ins_to='".$values['ins_to']."' AND ins_from='".$values['ins_from']."'AND f_unit='".$values['f_unit']."' AND t_unit='".$values['t_unit']."'");
				
						$prices=$query->result();
												
						if(!empty($prices))
						{
							foreach($prices as $price)
							{
								$this->db->update('tbl_add_on',$values1, "id=".$price->id);
							
							}
							
						}
							$values['ad_cat_id']=$cat;
						
								$this->db->insert('tbl_add_on', $values);
							
								
					
					}
					
			//	$this-> db->insert('tbl_add_on', $values);
								//$this->db->update('tbl_add_on',$values, "id=".$id);
				$this->session->set_flashdata('msg', 'Price Successfully Revise');
				redirect('admin/r_rate_addon');				
			}
		}
		else
		{
		    	$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
			
			$query = $this->db->get_where('tbl_add_on', array('id' => $id));
			$data['add_on']= $query->row();

			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
			$query =$this->db->get_where('tbl_add_on', array('id' => $id));
			$ap=$query->result();
			$data['ad_price']=$ap[0];
			
			$query =$this->db->get_where('tbl_newspapers', array('id' => $ap[0]->newspaper_id));
			$paper_name= $query->row();
			
			$query =$this->db->get_where('tbl_cities', array('id' => $ap[0]->city));
			$city_name=$query->row();
			$data['city_name']= $city_name;
			$data['newspaper_id']=$paper_name->id;
			$data['s_newspaper']= $paper_name->name ." , ".$city_name->name;
			//$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
			$query =$this->db->get_where('tbl_categories', array('id' => $ap[0]->ad_cat_id));
			$data['cat_name']= $query->row();
			
			
			
			
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
			$data['newspapers']= $query->result();
			
											
			
			$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$ap[0]->newspaper_id."'");
		
		//	$data['cats']= $query->result();
			//$query = $this->db->get('tbl_categories');
			//$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
			
			
			$this->load->view('admin/header');
			$this->load->view('admin/ad_r_rate_set',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	
	
	
	
	
	
	
	
	public function get_city()
	{
		$newspaper_id=$_POST['newspaper_id'];
		
		$query = $this->db->query("SELECT tbl_paper_city.*, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE paper_id='".$newspaper_id."'");
				
		$cities= $query->result();						
				
		echo json_encode($cities);
	}
	

	public function add()
	{
		if (!empty($this->input->post())) 
		{						
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('ad_cat[]', 'Ad Category', 'required');			
			$this->form_validation->set_rules('ins_from', 'Insertion From', 'required');
			$this->form_validation->set_rules('ins_to', 'Insertion To', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('eprice', 'Extra Price', 'required');
			$this->form_validation->set_rules('max_w', 'Maximum Word', 'required');
			$this->form_validation->set_rules('min_w', 'Minimum Word', 'required');
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('date_f', 'Date From', 'required');
			//$this->form_validation->set_rules('date_t', 'Date To', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{				
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
				$data['newspapers']= $query->result();
				
				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/price_set', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$date_f=date_create($this->input->post('date_f'));
				//$date_t=date_create($this->input->post('date_t'));
			
				$days=implode(",",$this->input->post('days[]'));
				$cats=$this->input->post('ad_cat[]');
				
				$query =$this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$paper=$query->row();
				
				$values = array(
								'newspaper_id'=>$paper->paper_id,
								'city'=>$paper->city_id,
								'ad_type'=>1,
								'ad_cat_id'=>0,
								'unit'=>$this->input->post('unit'),
								'color_type'=>'B',
								'ad_price'=>$this->input->post('price'),
								'extra_price'=>$this->input->post('eprice'),
								'day_id'=>$days,
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'date_from'=>date_format($date_f,"Y-m-d"),
								'revise_rate'=>0,
								'duration'=>$this->input->post('duration'),
								'duration_type'=>$this->input->post('dur_type'),
								'min_w'=>$this->input->post('min_w'),
								'max_w'=>$this->input->post('max_w'),
								'discount'=>$this->input->post('dis'),
								'mul_ex'=>$this->input->post('mer'),
								'mul_rate'=>$this->input->post('mr'),
								'mul'=>$this->input->post('mul'),
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
						
						$query = $this->db->query("SELECT * FROM tbl_add_on WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$cat."'");
				
						$prices=$query->result();
												
						if($prices==NULL OR $prices[0]->id==NULL)
						{
							$values['ad_cat_id']=$cat;
							$this-> db->insert('tbl_add_on', $values);
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
								$this-> db->insert('tbl_add_on', $values);
							}
							
						}
										
					}
				
				if($f==0)
				{					
					$this->session->set_flashdata('msg', 'All Ad price Successfully Added');
					redirect('admin/price');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Some price allreday Added with this details '.$add_id);
					redirect('admin/price');
				}				
			}
		}
		else
		{
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name, c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id");
			$data['newspapers']= $query->result();
			
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
						
			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
						
			$this->load->view('admin/header');
			$this->load->view('admin/price_set', $data);
			$this->load->view('admin/footer');
		}
	}
	
	
	
	
	
	public function del($id)
	{
		if($this->db->delete("tbl_add_on",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Ad price Delete Successfully.');
			redirect('admin/price');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Ad price not Delete Successfully.');
			redirect('admin/price');
		}		
	}
	
	
	public function get_heading11111()
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
	
	
	public function date_deff()
	{		
$date=date_create("2013-03-15");
date_sub($date,date_interval_create_from_date_string("1 day"));
echo date_format($date,"Y-m-d");
	}


	
}
?>