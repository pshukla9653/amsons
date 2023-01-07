<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hd_add_on extends CI_Controller
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
			
			$query = $this->db->query("SELECT tbl_add_on.*,p.position as cat_name,ng.ng_name,n.name,an.name as add_name FROM tbl_add_on
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_add_on.g_id
INNER JOIN tbl_paper_city pc ON pc.id=tbl_add_on.m_paper_id
INNER JOIN tbl_position p ON p.id=tbl_add_on.ad_cat_id
INNER JOIN tbl_paper_city cp ON cp.id=tbl_add_on.a_paper_id
INNER JOIN tbl_newspapers an ON an.id=cp.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE (tbl_add_on.ad_type='3') AND (n.name LIKE '%".$name."%' OR p.position LIKE '%".$name."%') ");

			$config["base_url"] = base_url() . "admin/hd_add_on/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['adds']= $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT tbl_add_on.*,p.position as cat_name,ng.ng_name,n.name,an.name as add_name FROM tbl_add_on
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_add_on.g_id
INNER JOIN tbl_paper_city pc ON pc.id=tbl_add_on.m_paper_id
INNER JOIN tbl_position p ON p.id=tbl_add_on.ad_cat_id
INNER JOIN tbl_paper_city cp ON cp.id=tbl_add_on.a_paper_id
INNER JOIN tbl_newspapers an ON an.id=cp.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_add_on.ad_type='3'");

			$config["base_url"] = base_url(). "admin/hd_add_on/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
	
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_add_on.*,p.position as cat_name,ng.ng_name,n.name,an.name as add_name FROM tbl_add_on
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_add_on.g_id
INNER JOIN tbl_paper_city pc ON pc.id=tbl_add_on.m_paper_id
INNER JOIN tbl_position p ON p.id=tbl_add_on.ad_cat_id
INNER JOIN tbl_paper_city cp ON cp.id=tbl_add_on.a_paper_id
INNER JOIN tbl_newspapers an ON an.id=cp.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_add_on.ad_type='3' order by tbl_add_on.id desc limit {$config['per_page']} offset {$page}");
			$data['adds']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/hd_add_on_list', $data);
		$this->load->view('admin/footer');
		
	}
		
	
	public function add()
	{
	
		$query = $this->db->get('tbl_news_group');
		$data['news_groups']= $query->result();
			
		$query = $this->db->get('tbl_position');
		$data['cats']= $query->result();
			
		$query = $this->db->get('tbl_newspapers');
		$data['papers']= $query->result();

		$query = $this->db->get('tbl_days');
		$data['days']= $query->result();
				
		$this->load->view('admin/header');
		$this->load->view('admin/hd_add_on_add',$data);
		$this->load->view('admin/footer');
		
	}
	
	
	public function save()
	{		
		$this->form_validation->set_rules('newspaper_group', 'Group', 'required');
		$this->form_validation->set_rules('m_newspaper', 'newspaper', 'required');
		$this->form_validation->set_rules('a_newspaper[]', 'add on newspaper', 'required');
		$this->form_validation->set_rules('ad_cat', 'Heading', 'required');
		$this->form_validation->set_rules('ins_from', 'Insertion', 'required');
		$this->form_validation->set_rules('ins_to', 'Insertion', 'required');
		$this->form_validation->set_rules('unit', 'Unit', 'required');
		$this->form_validation->set_rules('f_unit', 'From Unit', 'required');
		$this->form_validation->set_rules('t_unit', 'To Unit', 'required');
		$this->form_validation->set_rules('mul', 'Add/Multiple', 'required');
				
		
		if ($this->form_validation->run() == FALSE) 
		{
			$msg="1";
			echo $msg;
			return;
		}
		else
		{
			$days=implode(",",$this->input->post('days'));
            $date_f=date_create($this->input->post('date_f'));
		    $date_t=date_create($this->input->post('date_t'));
			$values = array(
								'g_id'=>$this->input->post('newspaper_group'),
								'm_paper_id'=>$this->input->post('m_newspaper'),
								'a_paper_id'=>0,
								'ad_type'=>3,
								'ad_cat_id'=>$this->input->post('ad_cat'),
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'day_id'=>$days,
								'unit'=>$this->input->post('unit'),
								'date_from'=>date_format($date_f,"Y-m-d"),
				                'date_to'=>date_format($date_f,"Y-m-d"),
								'f_unit'=>$this->input->post('f_unit'),
								't_unit'=>$this->input->post('t_unit'),
								'price'=>$this->input->post('price'),
								'e_price'=>0,
								'add_mul'=>$this->input->post('mul'),
								'c_date' =>date('Y-m-d H:i:s')
						);
			
			$newspapers=$this->input->post('a_newspaper[]');
			
			//var_dump($newspapers);
			//die;
			
			foreach($newspapers as $newspaper)
			{
				$values['a_paper_id']=$newspaper;
				
				$add = $this->db->query("SELECT * FROM tbl_add_on WHERE (g_id='".$values['g_id']."' AND m_paper_id='".$values['m_paper_id']."' AND a_paper_id='".$values['a_paper_id']."' AND ad_cat_id='".$values['ad_cat_id']."' AND ad_type='".$values['ad_type']."') OR (g_id='".$values['g_id']."' AND m_paper_id='".$values['a_paper_id']."' AND a_paper_id='".$values['m_paper_id']."' AND ad_cat_id='".$values['ad_cat_id']."' AND ad_type='".$values['ad_type']."')");
				
				$adds=$add->result();
				
					if($adds==NULL OR $adds[0]->id==NULL)
					{							
						$this->db->insert('tbl_add_on', $values);
						$msg='Add on add successfully continue with next Size.';
					}
					else
					{
						$add_id=0;
						$f=0;
						foreach($adds as $add)
						{
							if(($add->ins_to < $values['ins_from'] OR $add->ins_from > $values['ins_to']) OR ($add->t_unit < $values['f_unit'] OR $add->f_unit > $values['t_unit']))
							{
								continue;
							}
							else
							{
								$add_id=$add_id.",".$add->id ;
								$f=1;									
							}		
						}
						if($f==0)
						{
							$this->db->insert('tbl_add_on', $values);
							$msg='Add on add successfully continue with next Size.';
						}
						else
						{
							$msg='Add on already Added with this details';
						}							
					}
				
			}
			echo $msg;
			return;
		}
		
	}
	
	
	public function del($id)
	{	
		if($this->db->delete("tbl_add_on",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Add on Delete Successfully.');
			redirect('admin/hd_add_on');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Add on not Delete Successfully.');
			redirect('admin/hd_add_on');
		}
	}
	
	
	public function get_newspaper()
	{
		$g_id=$_POST['news_g'];
		
		$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE n.g_id='".$g_id."' ");
		
		$newspaper= $query->result();
		
		echo json_encode($newspaper);
		
	}
	
	public function get_add_newspaper()
	{
		$g_id=$_POST['news_g'];
		
		$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE n.g_id='".$g_id."'");
		
		$newspaper= $query->result();
		
		echo json_encode($newspaper);
		
	}
	
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('newspaper_group', 'Group', 'required');
			$this->form_validation->set_rules('m_newspaper', 'newspaper', 'required');
			$this->form_validation->set_rules('a_newspaper', 'add on newspaper', 'required');
			$this->form_validation->set_rules('ad_cat', 'Heading', 'required');
			$this->form_validation->set_rules('ins_from', 'Insertion', 'required');
			$this->form_validation->set_rules('ins_to', 'Insertion', 'required');
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('f_unit', 'From Unit', 'required');
			$this->form_validation->set_rules('t_unit', 'To Unit', 'required');
			$this->form_validation->set_rules('mul', 'Add/Multiple', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
				
			
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['news_groups']= $query->result();
			
				$query = $this->db->get('tbl_position');
				$data['cats']= $query->result();
			
				$query = $this->db->get_where('tbl_add_on', array('id' => $id));
				$data['add_on']= $query->row();

				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/hd_add_on_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{		

				$days=implode(",",$this->input->post('days[]'));	
                $date_f=date_create($this->input->post('date_from'));
		        $date_t=date_create($this->input->post('date_to'));
				$values = array(
								'g_id'=>$this->input->post('newspaper_group'),
								'm_paper_id'=>$this->input->post('m_newspaper'),
								'a_paper_id'=>$this->input->post('a_newspaper'),
								'ad_type'=>3,
								'ad_cat_id'=>$this->input->post('ad_cat'),
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'day_id'=>$days,
								'unit'=>$this->input->post('unit'),
								'date_from'=>date_format($date_f,"Y-m-d"),
				                'date_to'=>date_format($date_f,"Y-m-d"),
								'f_unit'=>$this->input->post('f_unit'),
								't_unit'=>$this->input->post('t_unit'),
								'price'=>$this->input->post('price'),
								'add_mul'=>$this->input->post('mul')
							);
							
				$query=$this->db->query("SELECT * FROM tbl_add_on WHERE (g_id='".$values['g_id']."' AND m_paper_id='".$values['m_paper_id']."' AND a_paper_id='".$values['a_paper_id']."' AND ad_cat_id='".$values['ad_cat_id']."' AND ad_type='".$values['ad_type']."') OR (g_id='".$values['g_id']."' AND m_paper_id='".$values['a_paper_id']."' AND a_paper_id='".$values['m_paper_id']."' AND ad_cat_id='".$values['ad_cat_id']."' AND ad_type='".$values['ad_type']."')");
				$add_ons= $query->result();
				
				if($add_ons==NULL OR $add_ons[0]->id==NULL)
				{
					$this->db->update('tbl_add_on', $values,"id =".$id);					
										
					$this->session->set_flashdata('msg', 'Add on edit Successfully');
				}
				else
				{
					
					$add_id=0;
					$f=0;
					foreach($add_ons as $add)
					{
						if($add->id==$id)
						{
							continue;
						}
						else
						{
							if(($add->ins_to < $values['ins_from'] OR $add->ins_from > $values['ins_to']) OR ($add->t_unit < $values['f_unit'] OR $add->f_unit > $values['t_unit']))
							{
								continue;
							}
							else
							{
								$add_id=$add_id.",".$add->id ;
								$f=1;									
							}
						}
					}
					if($f==0)
					{
						$this->db->update('tbl_add_on', $values,"id =".$id);
								$this->session->set_flashdata('msg', 'Add on edit Successfully');
					}
					else
					{
						$this->session->set_flashdata('msg', 'Add on already Added with this details');								
					}
					
				}
				redirect('admin/hd_add_on');
			}
		}
		else
		{
			$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
			
			$query = $this->db->get('tbl_position');
			$data['cats']= $query->result();
			
			$query = $this->db->get_where('tbl_add_on', array('id' => $id));
			$data['add_on']= $query->row();

			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/hd_add_on_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function set()
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('mp_price', 'Main Paper Price', 'required');
			
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['news_groups']= $query->result();
			
				$query = $this->db->get('tbl_position');
				$data['cats']= $query->result();

				$query = $this->db->get('tbl_days');
				$data['days']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/add_on_add',$data);
			$this->load->view('admin/footer');
			}
			else
			{
				$count=$this->input->post('count');
				$m_newspaper=$this->input->post('m_newspaper');
				$add_on_id=$this->input->post('add_on_id');
				$mp_price=$this->input->post('mp_price');
				$emp_price=$this->input->post('emp_price');
				for($i=0;$i<$count;$i++)
				{
					
						$paper_id=$this->input->post('paper'.$i);
						$price=$this->input->post('price'.$i);
						$eprice=$this->input->post('eprice'.$i);
						//echo $paper_id;
						//echo $price;
						
						$this->db->query("UPDATE `tbl_add_on_price` SET `price`='".$price."',`e_price`='".$eprice."' WHERE `add_on_id`='".$add_on_id."' AND `n_id`='".$paper_id."'");
						//$this->db->update('mytable', $data, array('id' => $id));
						//$this-> db->insert('tbl_add_on_price', $values);						
				}
				$values = array(
								'add_on_id'=>$add_on_id,
								'n_id'=>$m_newspaper,
								'price'=>$mp_price,
								'e_price'=>$emp_price
								);
						$this-> db->insert('tbl_add_on_price', $values);
				redirect('admin/add_on');
			}
		}
		else
		{
			$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
			
			$query = $this->db->get('tbl_position');
			$data['cats']= $query->result();

			$query = $this->db->get('tbl_days');
			$data['days']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/add_on_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
		
}
?>