<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends CI_Controller
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


		$discount = $this->db->query("SELECT tbl_discount.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_discount
INNER JOIN tbl_newspapers n ON n.id=tbl_discount.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_discount.type_id
INNER JOIN tbl_categories c ON c.id=tbl_discount.cat_id
INNER JOIN tbl_client u ON u.id=tbl_discount.client_id");

		$data['discounts']= $discount->result();
		$data["total_rows"] = $discount->num_rows();

			$query = $this->db->query("SELECT tbl_discount.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_discount
INNER JOIN tbl_newspapers n ON n.id=tbl_discount.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_discount.type_id
INNER JOIN tbl_categories c ON c.id=tbl_discount.cat_id
INNER JOIN tbl_client u ON u.id=tbl_discount.client_id");

			$config["base_url"] = base_url(). "admin/discount/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_discount.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_discount
INNER JOIN tbl_newspapers n ON n.id=tbl_discount.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_discount.type_id
INNER JOIN tbl_categories c ON c.id=tbl_discount.cat_id
INNER JOIN tbl_client u ON u.id=tbl_discount.client_id order by tbl_discount.id desc limit {$config['per_page']} offset {$page}");
		
		$data['discounts']= $query->result();	

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/discount_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('dis', 'Discount', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
			
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_newspapers');
				$data['newspapers']= $query->result();
			
				$query = $this->db->get('tbl_news_type');
				$data['types']= $query->result();
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
			
				$query = $this->db->get('tbl_users');
				$data['users']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/discount_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$types=$this->input->post('type[]');
				$cats=$this->input->post('cat[]');
				$newspapers=$this->input->post('newspaper[]');

//var_dump($types);
//var_dump($cats);
//var_dump($newspapers);
				//die;

				foreach ($types as $type) 
				{
					foreach ($cats as $cat) 
					{
						foreach ($newspapers as $newsp) 
						{
							$values = array(
								'client_id' =>$this->input->post('client'),
								'type_id' =>$type,
								'discount_percentage' =>$this->input->post('dis'),
								'newspaper_id' =>$newsp,
								'cat_id' =>$cat,
								'c_date' =>date('Y-m-d H:i:s')
							);
	                        //$query = $this->db->insert('tbl_discount', $values);
							$discount = $this->db->query("SELECT * FROM tbl_discount WHERE `client_id`='".$values['client_id']."' AND `type_id`='".$values['type_id']."' AND `newspaper_id`='".$values['newspaper_id']."' AND `cat_id`='".$values['cat_id']."'");
							//var_dump($discount);
							//die;
							if($discount->num_rows()==0)
							{
								$query = $this-> db->insert('tbl_discount', $values);
							}
							else
							{
								continue;
							}
						}
					}
				}
				
				$this->session->set_flashdata('msg', 'Discount, veena Successfully Added');
				redirect('admin/discount');
			}
		}
		else
		{
			$query = $this->db->get('tbl_newspapers');
			$data['newspapers']= $query->result();
						
			$query = $this->db->get('tbl_news_type');
			$data['types']= $query->result();
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/discount_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('dis', 'Discount', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
						
			
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_newspapers');
				$data['newspapers']= $query->result();
						
				$query = $this->db->get('tbl_news_type');
				$data['types']= $query->result();
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
			
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
				
				$query = $this->db->get_where('tbl_discount', array('id' => $id));
				$data['discount']= $query->row();
				
				$this->load->view('admin/header');
				$this->load->view('admin/discount_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
								'client_id' =>$this->input->post('client'),
								'type_id' =>$this->input->post('type'),
								'discount' =>$this->input->post('dis'),
								'newspaper_id' =>$this->input->post('newspaper'),
								'cat_id' =>$this->input->post('cat')
							);
				$this->db->update('tbl_discount',$values, "id =".$id);
				$this->session->set_flashdata('msg', 'Discount edit Successfully');
				redirect('admin/discount');
			}
		}
		else
		{
			$query = $this->db->get('tbl_newspapers');
			$data['newspapers']= $query->result();
						
			$query = $this->db->get('tbl_news_type');
			$data['types']= $query->result();
			
			$query = $this->db->get('tbl_categories');
			$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
				
			$query = $this->db->get_where('tbl_discount', array('id' => $id));
			$data['discount']= $query->row();
				
			$this->load->view('admin/header');
			$this->load->view('admin/discount_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del($id)
	{	
		if($this->db->delete("tbl_discount",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Discount Delete Successfully.');
			redirect('admin/discount');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Discount not Delete Successfully.');
			redirect('admin/discount');
		}
	}
}
?>