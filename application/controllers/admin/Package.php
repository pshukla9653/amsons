<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller
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
		
	$packs = $this->db->query("SELECT tbl_package.*,t.name as type_name, c.name as cat_name,ng.ng_name FROM tbl_package
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_package.g_id
INNER JOIN tbl_categories c ON c.id=tbl_package.cat_id
INNER JOIN tbl_news_type t ON t.id=tbl_package.type_id WHERE tbl_package.type_id<'3'order by id ASC ");
/*	$packs = $this->db->query("SELECT tbl_package.*,t.name as type_name,ng.ng_name FROM tbl_package
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_package.g_id

INNER JOIN tbl_news_type t ON t.id=tbl_package.type_id  order by id ASC ");*/

		$config["base_url"] = base_url(). "admin/package/index/";
		$config["total_rows"] = $packs->num_rows();
		$config["per_page"] = 20;
		$config["uri_segment"] = 4;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$packs = $this->db->query("SELECT tbl_package.*,t.name as type_name, c.name as cat_name,ng.ng_name FROM tbl_package
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_package.g_id
INNER JOIN tbl_categories c ON c.id=tbl_package.cat_id
INNER JOIN tbl_news_type t ON t.id=tbl_package.type_id WHERE tbl_package.type_id<'3' order by id ASC limit {$config['per_page']} offset {$page}");
/*	$packs = $this->db->query("SELECT tbl_package.*,t.name as type_name,ng.ng_name FROM tbl_package
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_package.g_id

INNER JOIN tbl_news_type t ON t.id=tbl_package.type_id  order by id ASC limit {$config['per_page']} offset {$page}");	*/
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
			
		$data['packs']= $packs->result();		
		
		$this->load->view('admin/header');
		$this->load->view('admin/package_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function index11()
	{
		$packs = $this->db->query("SELECT tbl_package.*,c.name as cat_name,n.name as paper_id, ng.ng_name FROM tbl_package
INNER JOIN tbl_pack_paper p ON p.pack_id=tbl_package.id
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_package.g_id
INNER JOIN tbl_categories c ON c.id=p.cat_id
INNER JOIN tbl_categories c ON c.id=p.cat_id");

$packs = $this->db->query("SELECT tbl_package.*,c.name as cat_name,n.name as paper_name,city.name as city_name, ng.ng_name FROM tbl_package
INNER JOIN tbl_pack_paper p ON p.pack_id=tbl_package.id
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_package.g_id
INNER JOIN tbl_categories c ON c.id=p.cat_id
INNER JOIN tbl_paper_city pc ON pc.id=p.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
INNER JOIN tbl_cities city ON city.id=pc.city_id ");

		$data['packs']= $packs->result();
		$data["total_rows"] = $packs->num_rows();
		
		$this->load->view('admin/header');
		$this->load->view('admin/package_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('p_title', 'Package Name', 'required');
			//$this->form_validation->set_rules('p_title', 'Package Name', 'required|is_unique[tbl_package.package]',array('required' => 'You must provide a %s.','is_unique'=>'Package with this name already Added.'));
			
			
			$this->form_validation->set_rules('newspaper_group', 'Group', 'required');
			$this->form_validation->set_rules('newspaper[]', 'Newspaper', 'required');
			$this->form_validation->set_rules('ad_cat[]', 'Heading', 'required');
			$this->form_validation->set_rules('rate', 'Rate', 'required');
			$this->form_validation->set_rules('e_rate', 'Extra Rate', 'required');
			
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['news_groups']= $query->result();
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
				
				$query = $this->db->query("SELECT * FROM tbl_news_type WHERE id !='3'");
				$data['paper_types']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/package_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{

				$date_f=date_create($this->input->post('date_f'));
                
				$values = array(
								'g_id'=>$this->input->post('newspaper_group'),
								'package'=>$this->input->post('p_title'),
								'type_id'=>$this->input->post('nt'),
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'from_date'=>date_format($date_f,"Y-m-d"),
								'rate'=>$this->input->post('rate'),
								'e_rate'=>$this->input->post('e_rate'),
								'discount'=>$this->input->post('dis'),
								'cat_id'=>0,
								'c_date' =>date('Y-m-d H:i:s')
							);
 

				foreach($this->input->post('ad_cat[]') as $cat)
				{
					$values['cat_id']=$cat;
					
					$pack = $this->db->query("SELECT * FROM tbl_package WHERE g_id='".$values['g_id']."' AND cat_id='".$values['cat_id']."' AND type_id ='".$values['type_id']."' AND package ='".$values['package']."'");

					$packs=$pack->result();
					 
					if($packs==NULL OR $packs[0]->id==NULL)
					{							
											
						$query = $this->db->insert('tbl_package', $values);
							
						$p_id=$this->db->insert_id();
								
						foreach($this->input->post('newspaper[]') as $newspaper)
						{
					
							$values1 = array(
								'pack_id'=>$p_id,
								'paper_id'=>$newspaper
								);
							$this-> db->insert('tbl_pack_paper', $values1);
					
						}
						$this->session->set_flashdata('msg', 'Package add successfully');
					}
					else
					{
						$add_id=0;
						$f=0;
						foreach($packs as $pack)
						{
							if(($pack->ins_to < $values['ins_from'] OR $pack->ins_from > $values['ins_to']))
							{
								continue;
							}
							else
							{
								$add_id=$add_id.",".$pack->id ;
								$f=1;									
							}		
						}
						if($f==0)
						{
							$query = $this-> db->insert('tbl_package', $values);
							echo $this->db->last_query();
							die();
							$p_id=$this->db->insert_id();
								
							foreach($this->input->post('newspaper[]') as $newspaper)
							{
					
								$values1 = array(
									'pack_id'=>$p_id,
									'paper_id'=>$newspaper
									);
								$this-> db->insert('tbl_pack_paper', $values1);
					
							}
							$this->session->set_flashdata('msg', 'Package add successfully');
						}
						else
						{
							$this->session->set_flashdata('msg', 'Some Package already Added with this details');								
						}
					}
				}				
				redirect('admin/package');
			}
		}
		else
		{
			$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
			
			
			
			$query = $this->db->query("SELECT * FROM tbl_news_type WHERE id !='3'");
			$data['paper_types']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/package_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function del($id)
	{	
		if($this->db->delete("tbl_package",array('id' => $id)) && $this->db->delete("tbl_pack_paper",array('pack_id' => $id)))
		{
			$this->session->set_flashdata('msg', 'package Delete Successfully.');
			redirect('admin/package');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'package not Delete Successfully.');
			redirect('admin/package');
		}
	}
	
	
	public function get_newspaper()
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
			$this->form_validation->set_rules('p_title', 'Package Name', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
				
			
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['news_groups']= $query->result();
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
				
				$query = $this->db->get('tbl_news_type');
				$data['paper_types']= $query->result();
				
				$query = $this->db->get_where('tbl_package', array('id' => $id));
				$data['pack']= $query->row();
			
				$query = $this->db->get_where('tbl_pack_paper', array('pack_id' => $id));
				$data['pack_paper']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/package_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(								
								'g_id'=>$this->input->post('newspaper_group'),
								'package'=>$this->input->post('p_title'),
								'type_id'=>$this->input->post('nt'),
								'ins_from'=>$this->input->post('ins_from'),
								'ins_to'=>$this->input->post('ins_to'),
								'rate'=>$this->input->post('rate'),
								'e_rate'=>$this->input->post('e_rate'),
								'discount'=>$this->input->post('dis'),
								'cat_id'=>$this->input->post('ad_cat')
							);
				
				$pack=$this->db->query("SELECT * FROM `tbl_package` WHERE `g_id`='".$values['g_id']."' AND `cat_id`='".$values['cat_id']."' AND `type_id` ='".$values['type_id']."'");
				$packs= $pack->result();
				//	if($packs==NULL OR $packs[0]->id==NULL)
				if(!empty($packs))
				{
					$this->db->update('tbl_package', $values,"id =".$id);
					$this->db->delete("tbl_pack_paper",array('pack_id' => $id));
								
					foreach($this->input->post('newspaper[]') as $newspaper)
					{					
						$values1 = array(
								'pack_id'=>$id,
								'paper_id'=>$newspaper
								);
						$this-> db->insert('tbl_pack_paper', $values1);
					}
									
					$this->session->set_flashdata('msg', 'package edit Successfully');
				}
				else
				{
					$add_id=0;
					$f=0;
					foreach($packs as $pack)
					{
						if($pack->id==$id)
						{
							continue;
						}
						else
						{
							if(($pack->ins_to < $values['ins_from'] OR $pack->ins_from > $values['ins_to']))
							{
								continue;
							}
							else
							{
								$add_id=$add_id.",".$pack->id ;
								$f=1;									
							}							
						}
					}
					if($f==0)
					{
						$this->db->update('tbl_package', $values,"id =".$id);
						$this->db->delete("tbl_pack_paper",array('pack_id' => $id));
								
						foreach($this->input->post('newspaper[]') as $newspaper)
						{					
								$values1 = array(
									'pack_id'=>$id,
									'paper_id'=>$newspaper
									);
								$this-> db->insert('tbl_pack_paper', $values1);
						}
						$this->session->set_flashdata('msg', 'package edit Successfully');
					}
					else
					{
						$this->session->set_flashdata('msg', 'Some Package already Added with this details');								
					}
				}
				redirect('admin/package/');
			}
		}
		else
		{
			$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_news_type');
			$data['paper_types']= $query->result();
										
			$query = $this->db->get_where('tbl_package', array('id' => $id));
			$data['pack']= $query->row();
			
			$query = $this->db->get_where('tbl_pack_paper', array('pack_id' => $id));
			$data['pack_paper']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/package_edit',$data);
			$this->load->view('admin/footer');
		}
	}
		
}
?>