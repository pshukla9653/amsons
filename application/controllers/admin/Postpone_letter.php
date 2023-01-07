<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postpone_letter extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		} 
		if($this->session->userdata('access')->letters==0)
		{
			redirect('admin/dashboard');
		}
		$this->load->library("pagination");
	}
	
	public function index()
	{
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			
			$query = $this->db->query("SELECT tbl_ad_price.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, city.name as city_name FROM tbl_ad_price 
INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_ad_price.ad_type
INNER JOIN tbl_cities city ON city.id=tbl_ad_price.city
INNER JOIN tbl_categories c ON c.id=tbl_ad_price.ad_cat_id WHERE (tbl_ad_price.ad_type='1') AND (n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%')");

			$config = array();
			$config["base_url"] = base_url() . "admin/postpone_letter/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['ad_prices']= $query->result();
		}
		else
		{
			/*$query = $this->db->query("SELECT tbl_ad_price.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, city.name as city_name FROM tbl_ad_price 
INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_ad_price.ad_type
INNER JOIN tbl_cities city ON city.id=tbl_ad_price.city
INNER JOIN tbl_categories c ON c.id=tbl_ad_price.ad_cat_id WHERE tbl_ad_price.ad_type='1'");*/

$query = $this->db->get('tbl_letters');
			$data['letters']= $query->result();
			
			$config = array();
			$config["base_url"] = base_url(). "admin/postpone_letter/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			/*
			$query = $this->db->query("SELECT tbl_ad_price.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, city.name as city_name FROM tbl_ad_price 
INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_ad_price.ad_type
INNER JOIN tbl_cities city ON city.id=tbl_ad_price.city
INNER JOIN tbl_categories c ON c.id=tbl_ad_price.ad_cat_id WHERE tbl_ad_price.ad_type='1' order by tbl_ad_price.id desc limit {$config['per_page']} offset {$page}");
			$data['ad_prices']= $query->result();
			*/
			$query = $this->db->get('tbl_letters');
			$data['letters']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/postpone_letter_list', $data);
		$this->load->view('admin/footer');
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
						
						$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$cat."'");
				
						$prices=$query->result();
												
						if($prices==NULL OR $prices[0]->id==NULL)
						{
							$values['ad_cat_id']=$cat;
							$this-> db->insert('tbl_ad_price', $values);
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
						
			//$query = $this->db->get('tbl_days');
			//$data['days']= $query->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
						
			$this->load->view('admin/header');
			$this->load->view('admin/postpone_letter_add', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function get_ros()
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('date_f', 'Date From', 'required');
			$this->form_validation->set_rules('date_t', 'Date To', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
				$date_f=date_create($this->input->post('date_f'));
				$date_t=date_create($this->input->post('date_t'));
				$date_f1=date_format($date_f,"Y-m-d");
				$date_t1=date_format($date_t,"Y-m-d");			
				
				$client=$this->input->post('client');
		
											
				$query = $this->db->query("SELECT * FROM tbl_book_ads WHERE u_id='".$client."' AND book_date > '".$date_f1."' AND book_date < '".$date_t1."'");	
		
				$ros= $query->result();
							
				if(empty($ros))
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{
					echo json_encode($ros);
					return;
				}
			}
		}
		else
		{
			$msg="1";
			echo $msg;
			return;
		}
		
	}
	
	
	public function get_ro_details()
	{
		$id=$this->input->post('ro_id');
		
		$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
		$book_ad=$ad->row();
		$data['book_ad']=$book_ad;
		
		if($book_ad->cat_id=='3')
		{
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, po.position as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_position po ON po.id=tbl_book_ads.cat_id
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."'");
		}
		else
		{
			
		
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, sh.sub_heading as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_sub_heading sh ON sh.id=tbl_book_ads.sub_heading
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."' GROUP BY tbl_book_ads.id");

		}
		
		$book_ad= $book_ads->row();
		
		if(empty($book_ad))
		{
			$msg="1";
			echo $msg;
			return;
		}
		else
		{
			echo json_encode($book_ad);
			return;
		}
		
	}
	
	
	
	public function edit($id)
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
				$query =$this->db->get_where('tbl_ad_price', array('id' => $id));
				$ap=$query->result();
				$data['ad_price']=$ap[0];
			
				$query = $this->db->query("SELECT * FROM `tbl_paper_city` WHERE `paper_id`='".$ap[0]->newspaper_id ."' AND `city_id`='".$ap[0]->city ."'");
				$data['s_newspaper']= $query->row();
			
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
				$this->load->view('admin/price_edit',$data);
				$this->load->view('admin/footer');
			}
			else			
			{
				$date_f=date_create($this->input->post('date_f'));
				//$date_t=date_create($this->input->post('date_t'));
				
				$days=implode(",",$this->input->post('days[]'));
				
				$query =$this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$paper=$query->row();
				
				$values = array(
								'newspaper_id'=>$paper->paper_id,
								'city'=>$paper->city_id,
								'ad_type'=>1,
								'ad_cat_id'=>$this->input->post('ad_cat'),
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
								'non_focus_charge'=>$this->input->post('nfdc')
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
						
						$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['ad_type']."' AND ad_cat_id='".$values['ad_cat_id']."'");
				
						$prices=$query->result();
												
						if($prices==NULL OR $prices[0]->id==NULL)
						{							
							$this->db->update('tbl_ad_price',$values, "id=".$id);
							$this->session->set_flashdata('msg', 'Price Successfully edit');
							redirect('admin/price');							
						}
						else
						{
							foreach($prices as $price)
							{
								if($price->id==$id)
								{
									continue;
								}
								/*
								if(($price->ins_to < $values['ins_from'] OR $price->ins_from > $values['ins_to']) OR ($price->date_to < $values['date_from'] OR $price->date_from > $values['date_to']))
								*/	
								if(($price->ins_to < $values['ins_from'] OR $price->ins_from > $values['ins_to']))							
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
								redirect('admin/price');
							}
							else
							{
								$this->session->set_flashdata('msg', 'Ad price already Added with this details');
								redirect('admin/price');
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
			$this->load->view('admin/price_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_ad_price",array('id' => $id)))
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
		
		$query =$this->db->get_where('tbl_paper_city', array('id' => $id));
		$paper=$query->row();		
		
		$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$paper->paper_id ."'");
		$heading= $query->result();
		
		echo json_encode($heading);
	}	
	
	


	
}
?>