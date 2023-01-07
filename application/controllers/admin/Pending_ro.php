<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_ro extends CI_Controller
{ 
	function __construct()
	{		
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		}
		if($this->session->userdata('access')->ads==0)
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
			$book_ads=$this->db->query("SELECT tbl_book_ads_temp.*, n.name as newspaper_name, t.name as type_name,  u.email, u.mobile, u.client_name FROM tbl_book_ads_temp
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads_temp.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads_temp.type_id

INNER JOIN tbl_client u ON u.id=tbl_book_ads_temp.u_id WHERE tbl_book_ads_temp.pending='P' AND n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR  OR u.mobile LIKE '%".$name."%' OR u.email LIKE '%".$name."%' ORDER BY id DESC");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/pending_ro/index";
			$config["total_rows"] = $book_ads->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['book_ads']= $book_ads->result();
		}
		else
		{
			$book_ads = $this->db->query("SELECT tbl_book_ads_temp.*, n.name as newspaper_name, t.name as type_name,  u.email, u.mobile FROM tbl_book_ads_temp
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads_temp.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads_temp.type_id

INNER JOIN tbl_client u ON u.id=tbl_book_ads_temp.u_id WHERE tbl_book_ads_temp.pending='P' order by tbl_book_ads_temp.id desc" );
			$config = array();
			$config["base_url"] = base_url(). "admin/pending_ro/index";
			$config["total_rows"] = $book_ads->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		/*	$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.pending='P' order by tbl_book_ads.id desc limit {$config['per_page']} offset {$page}");*/
$book_ads=$this->db->query("SELECT tbl_book_ads_temp.*, n.name as newspaper_name, t.name as type_name,  u.email, u.mobile, u.client_name FROM tbl_book_ads_temp
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads_temp.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads_temp.type_id

INNER JOIN tbl_client u ON u.id=tbl_book_ads_temp.u_id WHERE tbl_book_ads_temp.pending='P' order by tbl_book_ads_temp.id desc limit {$config['per_page']} offset {$page}");
			
			$data['book_ads']= $book_ads->result();
		}
		
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $book_ads->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/pending_ro_list',$data);
		$this->load->view('admin/footer');
	}
	
	function move($id)
	{
		$query = $this->db->get_where('tbl_book_ads_temp', array('id' => $id));				
		$ro_m= $query->row();
		$u_id =$ro_m->u_id;
		$ad_cost=$ro_m->ad_cost;
		
		$query = $this->db->get_where('tbl_client', array('id' => $u_id));
		$client= $query->row();
				
		if(($client->credit_bal+$ad_cost)>$client->credit_limit)
			{
			//$values['pending']='I';
			
			$this->session->set_flashdata('msg', 'Client has not sufficient credit limit ');
			redirect('admin/pending_ro');
		}
		else
		{
		     $this->load->model("ro_model");
             $ro=$this->ro_model->gen_ro_no("NP",$_SESSION['work_year']);
            
	         $query=$this->db->query("SELECT  `ro_no`, `ngb_id`, `pub_id`, `work_year`, `book_date`, `u_id`, `e_id`, `newspaper_id`, `state_id`, `content`, `uploaded_file`, `type_id`, `sub_heading`, `color`, `cat_id`, `package`, `insertion`, `paid`, `free`, `billed_insertion`, `scheme`, `material`, `party`, `box`, `premimum`, `remark`, `price`, `ex_price`, `b_price`, `b_ex_price`, `ad_cost`, `dis_per`, `discount`, `city`, `min_words`, `size_words`, `unit`, `size_l`, `size_r`, `unit_type`, `size_type`, `height`, `width`, `tax`, `publish_day`, `other_day_f`, `ro_type`, `comm1`, `comm2`, `comm3`, `comm4`, `comm5`, `comm6`, `comm7`, `comm8`, `comm_a`, `box_charge`, `tax_a`, `p_amount`, `t_amount`, `cgst`, `sgst`, `igst`, `gst_amount`, `dop_amount`, `add_on_a`, `dop_add_on_a`, `status`, `bill_status`, `pending`, `c_date`, `paper_city_id` FROM `tbl_book_ads_temp`  where id='$id'");
	         $values1=$query->row();
	         $values1['pending']='C';
	         $values1["ro_no"]=$ro;
	         $query = $this->db->insert('tbl_book_ads', $values1);
	       
             $in_id=$this->db->insert_id();
	         $query=$this->db->query("SELECT `ro_id`,`ro_no`,`work_year`, `paper_id`, `dop`, `dop_amount`, `bill_dop`, `bill_inse`, `newspaper_bill`, `c_date` FROM `tbl_ro_dop_temp` where ro_id='$id'");
	         $values =$query->result();
	        
	         $values["ro_id"]=$in_id;
	         $values["ro_no"]=$ro;
	       
	      
	        $this->db->insert('tbl_ro_dop',$values);
	      $this->db->query("Delete from tbl_book_ads_temp where id='$id'");
	      $this->db->query("Delete from tbl_ro_dop_temp where ro_id='$id'");
	      
	        $where= array(  
                    'ro_no'=>$ro,
                    'ro_type'=>"NP",
                    'year'=>$_SESSION['work_year']
                ); 
	       $this->ro_model->update_ro_no($where);
		//	$values['pending']='C';
			$bal=$client->credit_bal+$ad_cost;
			$values_1 = array('credit_bal' =>$bal);
			$this->db->update('tbl_client',$values_1, "id =".$u_id);
			//$this->db->update('tbl_book_ads',$values, "id =".$id);
			
			$this->session->set_flashdata('msg', 'Ro Move Successfully');
			redirect('admin/pending_ro');
		}
		
		
	}
	
}