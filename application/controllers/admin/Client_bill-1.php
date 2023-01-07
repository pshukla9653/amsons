<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_bill extends CI_Controller
{ 
    public  $cl="6";
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
		$query=$this->db->query("delete from `tbl_bill_temp_details` where   emp_id='".$_SESSION['admin']['id']."'  ");
		$query=$this->db->query("delete from `tbl_bill_temp` where  emp_id='".$_SESSION['admin']['id']."'  ");
	//	$query=$this->db->query("delete from `tbl_bill_temppp` where bill_id='0'");
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			$query = $this->db->query("SELECT tbl_bill.*, c.client_name FROM tbl_bill
			INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE (tbl_bill.work_year='".$_SESSION['work_year']."')AND( tbl_bill.id LIKE '%".$name."%'  OR c.client_name LIKE '%".$name."%' and tbl_bill.type=''");
			$config["base_url"] = base_url() . "admin/client_bill/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['ad_prices']= $query->result();
		}
		else
		{
			$query = $this->db->query("SELECT tbl_bill.*, c.client_name FROM tbl_bill
			INNER JOIN tbl_client c ON c.id=tbl_bill.client_id  WHERE (tbl_bill.work_year='".$_SESSION['work_year']."')");
			$config["base_url"] = base_url(). "admin/client_bill/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$query = $this->db->query("SELECT tbl_bill.*, c.client_name FROM tbl_bill
			INNER JOIN tbl_client c ON c.id=tbl_bill.client_id and tbl_bill.type_id=''  WHERE (tbl_bill.work_year='".$_SESSION['work_year']."')order by tbl_bill.id desc ");
		
			$data['bills']= $query->result();
		}		
	//	$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
	//	$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/client_bill_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function get_bill()
	{
	    
		if (!empty($this->input->post())) 
		{	
	//		$this->form_validation->set_rules('date_t', 'Date To', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{ 
			    	$date_t=($this->input->post('date_t'));			
				$date_t1=date_format("Y-m-d",strtotime($date_t));			
				//$date_d=$this->input->post('date_t');
				$client=$this->input->post('client');

		$query1=$this->db->query("SELECT `tbl_bill`.`id`, `tbl_bill`.`bill_no`, `tbl_bill`.`work_year`, `tbl_bill`.`client_id`, `tbl_bill`.`emp_id`, `tbl_bill`.`type_id`, `tbl_bill`.`amount`,
 `tbl_bill`.`igst`, `tbl_bill`.`cgst`, `tbl_bill`.`sgst`, `tbl_bill`.`box_charges`, `tbl_bill`.`total`, `tbl_bill`.`dis_per`, `tbl_bill`.`discount`, 
 `tbl_bill`.`art_work_charges`, `tbl_bill`.`other_charges`, `tbl_bill`.`art_w_igst`, `tbl_bill`.`art_w_cgst`, `tbl_bill`.`art_w_sgst`, `tbl_bill`.`art_w_gsta`,
  `tbl_bill`.`bill_date`, `tbl_bill`.`due_date`, `tbl_bill`.`Shared`, `tbl_bill`.`Shared_id`,
  `tbl_bill`.`Shared_Per`, `tbl_bill`.`Shared_Status`, `tbl_bill`.`c_date`, 
  tbl_bill.net_amount ,`tbl_client`.client_name as 'client_name'  FROM `tbl_bill` 
		INNER join `tbl_client` on `tbl_client`.`id`=`tbl_bill`.`client_id`
		
		WHERE
		`tbl_bill`.`client_id`=$client  and tbl_bill.work_year='".$_SESSION['work_year']."'  and `tbl_bill`.`net_amount`>0
ORDER BY `tbl_bill`.`id` ASC");
		
		$data['client_data']=$query1->result();
		
		foreach($data['client_data'] as $key=>$datas){
		$bill_no = $datas->bill_no;
		$bill_id = $datas->id;
		
		$query1=$this->db->query("SELECT Net FROM `tbl_reciept_details`
		
		WHERE
		`tbl_reciept_details`.`Bill_id`=$bill_id order by Reciept_No desc");
		$queryw = $query1->row();
		    if($queryw){
		   $data['client_data'][$key]->net_amount = $queryw->Net; 
		        
		    } else {
		   $data['client_data'][$key]->net_amount = number_format($datas->net_amount,2); 
		    }
		    
		    if($data['client_data'][$key]->net_amount!='0.00'){
		        
		    } else {
		        
		        unset($data['client_data'][$key]);
		    }
		}

					echo json_encode($data);
					return;
				
			}
		}
		else
		{
			$msg="1";
			echo $msg;
			return;
		}
	}
	

	public function get_pay_bill()
	{
	    
		if (!empty($this->input->post())) 
		{	
	//		$this->form_validation->set_rules('date_t', 'Date To', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{ 
			    	$date_t=($this->input->post('date_t'));			
				$date_t1=date_format("Y-m-d",strtotime($date_t));			
				//$date_d=$this->input->post('date_t');
				$client=$this->input->post('client');
				$from=$this->input->post('from');
				$to=$this->input->post('to');
				
					$from=date("Y-m-d",strtotime($from));			
					$to=date("Y-m-d",strtotime($to));			
	
		$query1=$this->db->query("select tbl_publication_bill.`id`, tbl_publication_bill.`slip_no`, tbl_publication_bill.`publication`, tbl_publication_bill.`bill_no`, tbl_publication_bill.`bill_amount`, tbl_publication_bill.`dop_amount`, tbl_publication_bill.`igst`, tbl_publication_bill.`cgst`, tbl_publication_bill.`sgst`, tbl_publication_bill.`gsta`, tbl_publication_bill.`net_amount`, tbl_publication_bill.`dated`, tbl_publication_bill.`dop`, tbl_publication_bill.`ro_no`, tbl_publication_bill.`work_year`, tbl_publication_bill.`emp_id`, tbl_publication_bill.`add_no`, tbl_publication_bill.`status`, tbl_publication_bill.`remark`, tbl_publication_bill.`c_date`
         FROM `tbl_publication_bill` 
		
		WHERE
		`tbl_publication_bill`.`publication`=$client  and tbl_publication_bill.work_year='".$_SESSION['work_year']."' 
		and 
		`tbl_publication_bill`.`net_amount`>0
		and		`tbl_publication_bill`.`dated` >='".$from."'
		and		`tbl_publication_bill`.`dated` <='".$to."'
ORDER BY `tbl_publication_bill`.`id` ASC");
		
		$data['client_data']=$query1->result();
		
		foreach($data['client_data'] as $key=>$datas){
		$bill_no = $datas->bill_no;
		$bill_id = $datas->id;
		
		$query1=$this->db->query("SELECT Net FROM `tbl_payments_details`
		
		WHERE
		`tbl_payments_details`.`Bill_id`=$bill_id order by Reciept_No desc");
		$queryw = $query1->row();
		    if($queryw){
		   $data['client_data'][$key]->net_amount = $queryw->Net; 
		        
		    } else {
		   $data['client_data'][$key]->net_amount = number_format($datas->net_amount,2); 
		    }
		    
		    if($data['client_data'][$key]->net_amount!='0.00'){
		        
		    } else {
		        
		        unset($data['client_data'][$key]);
		    }
		}

					echo json_encode($data);
					return;
				
			}
		}
		else
		{
			$msg="1";
			echo $msg;
			return;
		}
	}
	
	
	public function get_ros()
	{
	    
	$query=$this->db->query("delete from `tbl_bill_temp_details` where  emp_id='".$_SESSION['admin']['id']."' ");
		$query=$this->db->query("delete from `tbl_bill_temp` where  emp_id='".$_SESSION['admin']['id']."' ");
		if (!empty($this->input->post())) 
		{	
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
			    	$date_t=($this->input->post('date_t'));			
				$date_t1=date_format("Y-m-d",strtotime($date_t));			
				//$date_d=$this->input->post('date_t');
				$client=$this->input->post('client');
			
		$query1=$this->db->query("SELECT `tbl_shared_bill_party`.*,`tbl_client`.client_name as 'client_name'  FROM `tbl_shared_bill_party` INNER join `tbl_client` on `tbl_client`.`id`=`tbl_shared_bill_party`.`client_id` WHERE `tbl_shared_bill_party`.`group_head`=$client  and `tbl_shared_bill_party`.`client_id`!= $client
ORDER BY `tbl_shared_bill_party`.`client_id` ASC");
		
		$data['client_data']=$query1->result();
		
		
			
			
			//	$query = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name,IF(tbl_book_ads.type_id=1,f.position,c.name )as cat_name, e.name, u.email, u.mobile, u.client_name FROM tbl_book_ads INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id INNER JOIN tbl_position f ON f.id=tbl_book_ads.cat_id INNER JOIN tbl_admin e ON e.id=tbl_book_ads.e_id INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.u_id='".$client."' and tbl_book_ads.pending='C' AND tbl_book_ads.publish_day >'0' AND tbl_book_ads.book_date <= '$date_t1' order by tbl_book_ads.book_date ");
						$query = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, e.name, u.email, u.mobile, u.client_name FROM tbl_book_ads INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id  INNER JOIN tbl_admin e ON e.id=tbl_book_ads.e_id INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.u_id='".$client."' and tbl_book_ads.pending='C' AND tbl_book_ads.publish_day >'0' AND tbl_book_ads.book_date <= '$date_t1' order by tbl_book_ads.book_date,tbl_book_ads.ro_no ");
				//AND tbl_book_ads.work_year='".$_SESSION['work_year']."'
				
			//	$fm_query = $this->db->query("Select * from tbl_fm_ro where c_id='".$client."' and ro_date <='$date_t1' ");
				//echo $this->db->last_query(); 
			//	die;
				//$data['fm']=$fm_query->result();
				$ros=$query->result();
				$data['ros']= $ros;
				if(empty($ros))
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{
					echo json_encode($data);
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
	
	
	public function get_states()
	{
		if (!empty($this->input->post())) 
		{	
			$this->form_validation->set_rules('client', 'Client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{				
				$client=$this->input->post('client');
				//echo $client; die;
				$query = $this->db->where(["uid"=>$client])->get('tbl_client_details');
				$ros= $query->result();
				//echo "<pre>"; var_dump($ros); die;			
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
	
	public function update_client_details_table(){
		$this->load->model("site_model");
		$results=$this->site_model->get_data("tbl_client",null,"id,email,mobile,address,city,state,gst_no");
		//echo "<pre>";  var_dump($results); die;
		foreach($results as $row){
			//echo "<pre>";  var_dump($row); die;
			if($row['state']){
			$values=array(
				"uid"=>$row['id'],
				"email"=>$row['email'],
				"contact"=>$row['mobile'],
				"address"=>$row['address'],
				"state"=>$row['state'],
				"city"=>$row['city'],
				"gst_no"=>$row['gst_no'],
			);
				$result=$this->site_model->get_data("tbl_client_details",['uid'=>$row['id']],"id,email,contact,address,city,state,gst_no")[0];		
				//echo "<pre>";  var_dump($result); die;
				if(empty($result)){
					$this->site_model->insert_data("tbl_client_details",$values);
				}
			}
		}
		
	}
	
	public function add()
	{
			$query2 = $this->db->select('*')->from('tbl_tax')->where('title','IGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['igst']= $query2->get()->row();
	
	
			$cgst = $this->db->select('*')->from('tbl_tax')->where('title','CGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['cgst']= $cgst->get()->row();
	
			$sgst = $this->db->select('*')->from('tbl_tax')->where('title','SGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['sgst']= $sgst->get()->row();
			
			$this->db->order_by('client_name','ASC');
	
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
			
			// $query = $this->db->get('tbl_tax');
			// $data['taxs']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/client_bill',$data);
			$this->load->view('admin/footer');
		
	}
	
	
	public function edit($id)
	{
		//	$this->db->truncate("tbl_bill_temp");
		//	$this->db->truncate("tbl_bill_temp_details");
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();

			

			$query = $this->db->where(array("id"=>$id))->get('tbl_bill');
			
			$data['bill']= $query->result()[0];
			if($data['bill']->Shared_id=='')
			{
		
			$query = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name,  e.e_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
			INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
		
			INNER JOIN tbl_employee e ON e.e_id=tbl_book_ads.e_id
			INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.u_id='".$data['bill']->client_id."' AND tbl_book_ads.book_date <= '".$data['bill']->bill_date."' AND tbl_book_ads.publish_day >'0'");
	
			$data['unbilled_ros1']= $query->result();
			// echo $this->db->last_query();
			// echo '<pre>'; var_dump($data['unbilled_ros']); die;
			$query = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, e.name, u.email, u.mobile, u.client_name FROM tbl_book_ads INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id  INNER JOIN tbl_admin e ON e.id=tbl_book_ads.e_id INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.u_id='".$data['bill']->client_id."' and tbl_book_ads.pending='C' AND tbl_book_ads.publish_day >'0' AND tbl_book_ads.book_date <= '".$data['bill']->bill_date."' order by tbl_book_ads.book_date,tbl_book_ads.ro_no ");
			$data['unbilled_ros']=$query->result();
			$this->db->select( 'tbl_bill_details.*,tbl_book_ads.ro_no as ro_no,tbl_bill.client_id as client_id,tbl_bill_temp.payable_amount as payable_amount,tbl_client.client_name as client_name,tbl_newspapers.name as newspaper_title,tbl_categories.name as cat_title,tbl_bill.bill_date');
			$this->db->from('tbl_bill_details');
			$this->db->join('tbl_book_ads', 'tbl_book_ads.id = tbl_bill_details.ro_id',left);
			$this->db->join('tbl_bill', 'tbl_bill.id = tbl_bill_details.bill_id',left);
		    $this->db->join('tbl_client', 'tbl_client.id = client_id');
			$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_details.paper',left);
			$this->db->join('tbl_categories', 'tbl_categories.id = tbl_bill_details.heading',left);
			$this->db->join('tbl_bill_temp', 'tbl_bill_temp.bill_id = tbl_bill_details.bill_id',left);
			$this->db->distinct();
			$query = $this->db->where(array("tbl_bill_details.bill_id"=>$id))->get();
			$data['bill_details']=$query->result();
	//	echo $this->db->last_query();
		
		$query1=$this->db->query("SELECT `tbl_shared_bill_party`.*,`tbl_client`.client_name as 'client_name'  FROM `tbl_shared_bill_party` INNER join `tbl_client` on `tbl_client`.`id`=`tbl_shared_bill_party`.`client_id` WHERE `tbl_shared_bill_party`.`group_head`='".$data['bill']->client_id."'  and `tbl_shared_bill_party`.`client_id`!= '".$data['bill']->client_id."' ORDER BY `tbl_shared_bill_party`.`client_id` ASC");
		
		$data['client_data1']=$query1->result();
			$query2=$this->db->query("SELECT * from tbl_bill  WHERE Shared_id ='".$data['bill']->id."'  and Shared_status!='Cancel'");
		
		$data['sh_parties']=$query2->result();
	//		echo '<pre>'; var_dump($data['bill_details']); die;
// //	die;
// 		foreach($data['bill_details'] as $row){
// 			$values=array(
// 					'bill_id'=>$row->bill_id,
// 					'ro_id'=>$row->ro_id,
// 					'client_id'=>$row->client_id,
// 					'newspaper_id'=>$row->paper,
// 					'cat_id'=>$row->heading,
// 					'size_words'=>$row->word_size,
// 					'min_w'=>$row->min_w,
// 					'insertion'=>$ro->insertion,
// 					'p_date'=>$row->pub_date,
// 					'price'=>$row->rate,
// 					'eprice'=>$row->e_rate,
// 					'amount'=>$row->amount,
// 					'premimum'=>$row->premimum,
// 					'extra_price'=>(($row->word_size-$row->min_w)*$row->e_rate)*$row->insertion,
// 					'add_on_amount'=>$row->add_on_amount,
// 					'dis_per'=>$row->dis_per,
// 					'discount'=>$row->discount,
// 					'height'=>$row->height,
// 					'width'=>$row->width,
// 					'box_charges'=>$row->box_charges,
// 					'payable_amount'=>($row->amount+$row->box_charges+((($row->word_size-$row->min_w)*$row->e_rate)*$row->insertion))-$row->discount
// 				);
// 				//echo '<pre>'; var_dump($values); die;
// 			//	$this->temp_save($values);
// 			}
			
// 			$this->db->select('tbl_bill_edit.*,tbl_newspapers.name as newspaper_title');
// 		$this->db->from('tbl_bill_edit');
// 		$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_edit.newspaper_id');
// 		 $this->db->where(['bill_id'=> $id]);
		 
		 $ress=$this->db->query("SELECT distinct ro_id FROM `tbl_bill_details` where bill_id='$id'");
		 $this->db->last_query();
//die;
	$data['bill_details1'] =$ress ->result();  
	
		//$result=$this->db->get("tbl_bill_temp");
		$this->db->select('tbl_bill_temp.*,tbl_client.client_name as client_name,tbl_newspapers.name as newspaper_title,tbl_categories.name as cat_title');
		$this->db->from('tbl_bill_temp');
		$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_temp.newspaper_id');
		$this->db->join('tbl_client', 'tbl_client.id = tbl_bill_temp.client_id');
		$this->db->join('tbl_categories', 'tbl_categories.id = tbl_bill_temp.cat_id');

		$result = $this->db->get();
		$data['temp_details']=($result->result()); 
		//echo '<pre>'; var_dump($data['temp_details']); return;	
		
				$query2 = $this->db->select('*')->from('tbl_tax')->where('title','IGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['igst']= $query2->get()->row();
	
	
			$cgst = $this->db->select('*')->from('tbl_tax')->where('title','CGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['cgst']= $cgst->get()->row();
	
			$sgst = $this->db->select('*')->from('tbl_tax')->where('title','SGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['sgst']= $sgst->get()->row();
	

		$this->load->view('admin/header');
		$this->load->view('admin/client_bill_edit',$data);
		$this->load->view('admin/footer');
			}
			else
			{
			    $this->session->set_flashdata('msg', 'it Is Shared bill');
			    redirect('admin/client_bill');
			}
	}





		
// 	public function temp_save($data)
// 	{
// 		//echo '<pre>'; var_dump($data); die;
// 		$query = $this->db->where(['ro_id'=>$data['ro_id']])->get('tbl_bill_temp');
// 		if($query->num_rows()){
// 			//echo "exists"; return;
// 			$values = array(
// 				'ro_id'=>$data['ro_id'],
// 				'bill_id'=>$data['bill_id'],
// 				'client_id' => $data['client_id'],
// 				//'emp_id' => $data['emp_id'],
// 				'newspaper_id' =>$data['newspaper_id'],
// 				'cat_id' =>$data['cat_id'],
// 				'insertion' => $data['insertion'],
// 				'p_date' => $data['p_date'],
// 				'size_words' => $data['size_words'],
// 				'min_w' => $data['min_w'],
// 				'price' => $data['price'],
// 				'eprice' => $data['eprice'],
// 				'height' => $data['height'],
// 				'width' => $data['width'],
// 				'amount' =>$data['amount'] ,
// 				'premimum' =>$data['premimum'] ,
// 				'extra_price' => $data['extra_price'],
// 				'add_on_amount' => $data['add_on_amount'],
// 				'dis_per' => $data['dis_per'],
// 				'discount' => $data['discount'],
// 				'box_charges' => $data['box_charges'],
// 				'payable_amount' => $data['payable_amount']
// 			);		

// 			$this->db->where(["ro_no"=>$data['ro_no']])->update('tbl_bill_temp',$values);
			
// 		}
// 		else{
// 			$values = array(
// 				'bill_id'=>$data['bill_id'],
// 				'ro_id'=>$data['ro_id'],
// 				'client_id' => $data['client_id'],
// 				//'emp_id' => $data['emp_id'],
// 				'newspaper_id' =>$data['newspaper_id'],
// 				'cat_id' =>$data['cat_id'],
// 				'insertion' => $data['insertion'],
// 				'p_date' => $data['p_date'],
// 				'size_words' => $data['size_words'],
// 				'min_w' => $data['min_w'],
// 				'price' => $data['price'],
// 				'eprice' => $data['eprice'],
// 				'height' => $data['height'],
// 				'width' => $data['width'],
// 				'amount' =>$data['amount'] ,
// 				'premimum' =>$data['premimum'] ,
// 				'extra_price' => $data['extra_price'],
// 				'add_on_amount' => $data['add_on_amount'],
// 				'dis_per' => $data['dis_per'],
// 				'discount' => $data['discount'],
// 				'box_charges' => $data['box_charges'],
// 				'payable_amount' => $data['payable_amount']
// 			);							
// 			$this-> db->insert('tbl_bill_temp', $values);
			
// 		}
// 		//var_dump($this->db->last_query()); die;
// 		//echo '<pre>'; var_dump($_POST); return;				
// 	}





	public function get($id)
	{	
		if(!empty($this->input->post()))
		{
			$this->form_validation->set_rules('net', 'Net', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));
				$ro= $query->row();
			
				$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name, u.discount as client_discount FROM tbl_book_ads
				INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
				INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
				INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
				INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."' and  tbl_book_ads.work_year='".$_SESSION['work_year']."'");
				$book_ad= $book_ads->row();
			
				$data['book_ad']=$book_ad;
				$data['discount']=$book_ad->ad_cost*$book_ad->client_discount/100;
				$data['net']=$book_ad->ad_cost-$data['discount'];
			
				$this->load->view('admin/header');
				$this->load->view('admin/client_bill_get',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
					'ro_id' => $id,
					'client_id' => $this->input->post('c_id'),
					'amount' => $this->input->post('amt'),
					'box_charges' => $this->input->post('bc'),
					'el_charges' => $this->input->post('elc'),
					'non_focus' => $this->input->post('nfd'),
					'premium' => $this->input->post('premium'),
					'total' => $this->input->post('total'),
					'discount' => $this->input->post('dis'),
					'at_work_charges' => 0,
					'net_amount' => $this->input->post('net'),
					'bill_date' => date('Y-m-d')
				);
				
				$query = $this-> db->insert('tbl_bill', $values);
				$in_id=$this->db->insert_id();

				$query = $this->db->get_where('tbl_client', array('id' => $values['client_id']));
				$client= $query->row();
				
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
				$ro= $query->row();	
			
				if($ro->pending=='C')
				{
					if(($client->credit_bal-$values['amount'])>0)
					{					
						$bal=$client->credit_bal-$values['amount'];
						$values = array('credit_bal' =>$bal);
						$this->db->update('tbl_client',$values, "id =".$client->id);
					}
				}
				else
				{
					$values = array('pending' => 'C');
					$this->db->update('tbl_book_ads',$values, "id =".$id);	
				}
			
				$values = array('status' => 'I');
				$this->db->update('tbl_book_ads',$values, "id =".$id);	
				$this->session->set_flashdata('msg', 'Bill Successfully add');
			
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));
				$ro= $query->row();
			
				redirect('admin/client_bill/add/'.$ro->u_id);
			}
		}
		else
		{
		
			$query = $this->db->get_where('tbl_book_ads', array('id' => $id));
			$ro= $query->row();
			
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name, u.discount as client_discount FROM tbl_book_ads
			INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
			INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."' and tbl_book_ads.work_year='".$_SESSION['work_year']."'");
			$book_ad= $book_ads->row();
			
			$data['book_ad']=$book_ad;
			$data['discount']=$book_ad->client_discount;
			
			$query = $this->db->get('tbl_tax');
			$data['taxs']= $query->result();
			
			
			$this->load->view('admin/header');
			$this->load->view('admin/client_bill_get',$data);
			$this->load->view('admin/footer');
		
		}
	}

	public function save_bill()
	{

		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('amount', 'Amount', 'required');			
			$this->form_validation->set_rules('net_amount', 'Net Amount', 'required');
			$this->form_validation->set_rules('due_day', 'Due Day', 'required');
			$this->form_validation->set_rules('total', 'total', 'required');
			$this->form_validation->set_rules('client', 'client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
			   
			    $shared_client=$this->input->post('shared_client');
			   if(!empty($shared_client))
			   {
			       
			       $amount=0;
			        $count=count($shared_client);
			        array_unshift($shared_client,$this->input->post('client'));
    			    $shared_per =$this->input->post('shared_per');
    			    $main_shared_per =$this->input->post('mshare');
    			//  echo $shared_per;
    			 //  echo $count;
    			   $mshare=floatval(($this->input->post('amount'))*floatval($main_shared_per)/100);
    			   $s_share=floatval(($this->input->post('amount'))*floatval($shared_per)/100)/floatval($count);
    			  // echo "mshare".$mshare;
    			 //  echo "share".$s_share;
    			 //  die;
    			 $shared_id='';
    			  $Shared_amount='';
    			  
    			  		$query2 = $this->db->select('*')->from('tbl_tax')->where('title','IGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['igst']= $query2->get()->row();
	 
	
			$cgst = $this->db->select('*')->from('tbl_tax')->where('title','CGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['cgst']= $cgst->get()->row();
	
			$sgst = $this->db->select('*')->from('tbl_tax')->where('title','SGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['sgst']= $sgst->get()->row();
			
			            foreach($shared_client as $cs)
			            {
    			                if($cs==$this->input->post('client'))
    			                {
    			                  $Shared_amount=$mshare;
    			                    $amount =$mshare;
    			                }
    			               else
    			               {
    			                    $Shared_amount=$mshare;
    			                    $amount =$s_share;
    			               }
			                 $query=$this->db->query("SELECT id from states where name=(SELECT state FROM `tbl_client_details` where uid='$cs' limit 1)");
			             
    			              $state=$query->row();
    			                 if($state==null){
    			                   if($data['cgst']){
                                    $cgst=(floatval($amount)*$data['cgst']->tax_rate)/100;
                                   } else {
                                    $cgst=(floatval($amount)*2.5)/100;
                                   }
                                   
                                   if($data['sgst']){
                                    $sgst=(floatval($amount)*$data['sgst']->tax_rate)/100;
                                   } else {
                                    $sgst=(floatval($amount)*2.5)/100;
                                   }
                                    $igst=0;	
                                }
                                else if($state=="Chandigarh"){
                                   if($data['cgst']){
                                    $cgst=(floatval($amount)*$data['cgst']->tax_rate)/100;
                                      
                                   } else {
                                    $cgst=(floatval($amount)*2.5)/100;
                                   }
                                   if($data['sgst']){
                                    $sgst=(floatval($amount)*$data['sgst']->tax_rate)/100;
                                   } else {
                                    $sgst=(floatval($amount)*2.5)/100;
                                   }
                                    $igst=0;
                                }
                                else{
                                    $cgst=0;
                                    $sgst=0;
                                    if($data['igst']){
                                    $igst=(floatval($amount)*$data['igst']->tax_rate)/100;
                                        
                                    } else {
                                    $igst=(floatval($amount)*5)/100;
                                    }
                                }
			               $total=$amount+$this->input->post('box_c');
			               $net_amount=$total+ $this->input->post('dis_per')+$this->input->post('discount')+$this->input->post('art_work_charges')+$this->input->post('other_charges')+$igst+$cgst+$sgst;
			               
			            	$tbl_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_bill_temp");
			            
			       
            				if($tbl_bill_temp->num_rows()==0)
            				{
            					$msg="2";
            					echo $msg;
            					return;
            				}
            				else
            				{
            					$this->load->model("site_model");
            					$res=$this->site_model->get_data("tbl_client",['id'=>$cs])[0];
            					$client_name=$res['client_name'];
            					
            					//echo '<pre>'; var_dump($_POST); die;
            					$days=$this->input->post('due_day')." days";
                                
                                
                                $dt=new DateTime($this->input->post('bill_date'));
                                $bill_date=$dt->format("Y-m-d");    
                                

                                $due_date=date('Y-m-d',strtotime( $bill_date . ' +30 day'));
            					//$date=date_create();
            					//date_add($date,date_interval_create_from_date_string($days));
            					//$due_date=date_format($date,"Y-m-d");
            					$bill_no=bill_no_gen();
                                                
                                
            					$values = array(
            						'bill_no'=>$bill_no,
            						'work_year'=> $_SESSION['work_year'],
            						'client_id'=> $cs,
            						'emp_id'=>$_SESSION['admin']['id'],
                                    'bill_date'=> $bill_date,
            						'amount'=> floatval($amount),
            						'box_charges'=> $this->input->post('box_c'),
            						'total'=> $this->input->post('total'),
            						'dis_per'=> $this->input->post('dis_per'),
            						'discount'=> $this->input->post('discount'),
            						'art_work_charges'=> $this->input->post('art_work_charges'),
            						'other_charges'=> $this->input->post('other_charges'),
            						'net_amount'=> $net_amount,
            						'igst'=> $igst,
            						'cgst'=>$cgst,
            						'sgst'=>$sgst,
            						'due_date'=> $due_date,
            						'Shared'=>'YES',
						            'Shared_id'=>$shared_id,
						            'Shared_Per'=>$Shared_amount
            					);
            					$query = $this->db->insert('tbl_bill', $values);
            				//	echo $this->db->last_query(); 
            				
            					$in_id=$this->db->insert_id();
            if($cs==$this->input->post('client'))
    			                {
    			                    $shared_id=$in_id;
    			                    
    			                }
            					$result=$this->site_model->get_data("tbl_ledgers",['master_id'=>$cs])[0];
            				//	echo "result id:".$result['ledger_id'];
            					$ledger_id=$result['ledger_id'];
            					if(empty($result['ledger_id'])){
            						$values = array(
            							'group_id'=>2,
            							'master_id'=> $cs,
            							'ledger_name'=> $client_name,
            							'opening_balance'=>0,
            							'editable'=>'no'
            						);
            						$ledger_id=$this->site_model->insert_data('tbl_ledgers', $values); 
            					//	echo $this->db->last_query(); 
            					}
            
            					$values = array(
            						'group_id'=>2,
            						'ledger_id'=> $ledger_id,
	                                'voucher_date'=> $bill_date,
            						'entry_type'=>'dr',
            						'amount'=>$amount-$this->input->post('discount')+$igst+$sgst+$cgst+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
            						'narration'=>"Bill generated for ".$client_name."No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            		
            
            					$values = array(
            						'group_id'=>9,
            						'ledger_id'=>12,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$this->input->post('discount'),
            						'narration'=>"Discount generated for ".$ledger_name." Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            			//	echo $this->db->last_query(); 
            
            					$values = array(
            						'group_id'=>7,
            						'ledger_id'=>9,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$amount+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
            						'narration'=>"Advertisement Income on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            				//	echo $this->db->last_query(); 
            
            					if($igst){
            					$values = array(
            						'group_id'=>15,
            						'ledger_id'=>13,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$igst,
            						'narration'=>"IGST on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            				//	echo $this->db->last_query(); 
            					}
            
            					if($cgst){
            					$values = array(
            						'group_id'=>15,
            						'ledger_id'=>14,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$cgst,
            						'narration'=>"CGST on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            			//	echo $this->db->last_query(); 
            				}
            
            				if($sgst){
            					$values = array(
            						'group_id'=>15,
            						'ledger_id'=>15,
            						'voucher_date'=>  $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$sgst,
            						'narration'=>"UGST on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            				//	echo $this->db->last_query(); 
            				}
            
            					//echo $this->db->last_query(); return;
            					//$in_id=$this->db->insert_id();
            					$result=$tbl_bill_temp->result();
            					
            					$bill_detail=array();
            					$c=0;
                                 $heading_main=0;
            					$days=array();
            				foreach($result as $ro){
					     $this->db->query("INSERT INTO `tbl_bill_edit`( `bill_id`, `ro_id`, `work_year`, `ro_no`, `client_id`, `emp_id`, `newspaper_id`, `type_id`, `cat_id`, `size_words`, `min_w`, `insertion`, `p_date`, `price`, `eprice`, `amount`, `scheme`, `pack`, `premimum`, `extra_price`, `add_on_amount`, `dis_per`, `discount`, `height`, `width`, `box_charges`, `payable_amount`, `ro_date`) values ('$in_id', '$ro->ro_id', '$ro->work_year', '$ro->ro_no', '$ro->client_id', '$ro->emp_id', '$ro->newspaper_id', '$ro->type_id', '$ro->cat_id', '$ro->size_words', '$ro->min_w', '$ro->insertion', '$ro->p_date', '$ro->price', '$ro->eprice', '$ro->amount', '$ro->scheme', '$ro->pack', '$ro->premimum', '$ro->extra_price', '$ro->add_on_amount', '$ro->dis_per', '$ro->discount', '$ro->height', '$ro->width', '$ro->box_charges', '$ro->payable_amount', '$ro->ro_date' ) ");    
                      
						$values1['box_charges']=$ro->box_charges;
						//$values1['p_amount']=($ro->amount+$ro->discount);
						$values1['status']="Y";
				
						/************* Enter into tbl_bill_details *********************************/
            					
            						  $tempdop=$ro->p_date;
                                    		    $tempro_id=$ro->ro_id;
                                    		    $Free=$ro->Free;
                                    		    $Paid=$ro->Paid;
                                    		  $size_type=$ro->size_type;
                                    		    $p_datetemp=explode(',',$tempdop);
                                    		    $pcount=1;
                                    		   
                                    		    foreach($p_datetemp as $dt)
                                    		    { 
                                    		        $ddtemp=date('Y-m-d',strtotime($dt));
                                    		        $query2=$this->db->query("select * from tbl_ro_dop where ro_id='$tempro_id' and dop='$ddtemp'");
                                    		       
                                    		        $result1=$query2->row();
                                    		        
                                    		        $dop_amount=floatval($result1->dop_amount);
                                    		       // $values1['insertion']=1;
                                    		        
                                                            	$c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($ro->eprice);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				           
                                    				            if($ro->type_id==2|| $ro->type_id==3)
                                    				            {
                                    				            if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($ro->price)*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				            	$word_size=split('X',$ro->size_words);
                                    				            	$len=$word_size[0];
                                    				            	$width=$word_size[1];
                                    				            	$c_amount+=floatval($ro->price)*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            }
                                    				            else
                                    				            {
                                    				               
                                    				            $c_amount+= floatval($ro->price)+(floatval($ro->size_words-$ro->min_w)*floatval($ro->eprice));
                                    				            
                                    				        	}
                                    				            $prem=explode(",",$ro->premimum);
                                                                $am=$c_amount;
                                    				           if($prem[1] == 'Rs')
                                    				            { 
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				               
                                    				            }
                                                                
                                                                
                                                                if($premimum==NULL)
                                                                {
                                                                    $premimum=0;
                                                                }
                                    				            //premimum+=parseFloat(d.premimum);
                                    				            $dis_per=$ro->dis_per;
                                    				          $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                    				         	      
                                    				             $heading_main=$ro->cat_id;
                                            						$values1=array();
                                            						$values1['ro_main_id']=$result1->id;
                                            						$values1['bill_id']=$in_id;
                                            						$values1['ro_id']=$ro->ro_id;
                                            						$values1['type_id']=$ro->type_id;
                                            						$values1['ro_session']=$ro->work_year;
                                            						$values1['insertion']=$ro->insertion;
                                            						$values1['pub_date']=$ddtemp;
                                            						$values1['paper']=$ro->newspaper_id;
                                            						$values1['heading']=$ro->cat_id;
                                            						$values1['pack']=$ro->pack;
                                            						$values1['scheme']=$ro->scheme;
                                            						$values1['premimum']=$ro->premimum;
                                            						$values1['premimum_val']=$premimum;
                                            						$values1['word_size']=$ro->size_words;
                                            						$values1['rate']=$ro->price;
                                            						$values1['e_rate']=$ro->eprice;
                                            						$values1['min_w']=$ro->min_w;
                                            						 $values1['amount']=$c_amount;
                                            						 $values1['box_charges']=$box_charges;
                                            						$values1['dis_per']=$ro->dis_per;
                                            					    $values1['discount']=$dis;
                                    				                 $values1['net_amount']=$p_amount;
                                    				                 $values1['status']="Y";
                                    				                
                                    				                  $values1['Ad_type']="Paid";
                                    				                  $values1['size_type']=$size_type;
                                    				                   
                                    				                   if($pcount > $Paid)
                                    				          
                                    				           {
                                    				               $values1['amount']=0;
                                    				               $values1['discount']=0;$values1['net_amount']=0;
                                    				               $values1['Ad_type']="Free";
                                    				           }
                                    		   
            						            $this->db->insert('tbl_bill_details', $values1);
            						            
            						            	$pcount++;
                                    		    }
            						//echo $this->db->last_query();
            /************* Enter into tbl_bill_details *********************************/
            						$resp=$this->site_model->get_data("tbl_bill_temp_details",['ro_id'=>$ro->ro_id]);
            						$pcount1=1;
            						if(!empty($resp))
            						{
            						foreach($resp as $row){
            						  
                                    		        $query=$this->db->query("select * from tbl_ro_dop where id='".$row['ro_main_id']."'");
                                    		       
                                    		        $result2=$query->row();
                                    		        $dop_amount2=floatval($result2->dop_amount);
            						                  $c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($row['erate']);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				            if($row['type_id']==2 || $row['type_id']==3)
                                    				            {
                                    				                 if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($row['rate'])*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				               $xx =$ro->size_words;
                                    				            	$word_size=split("X",$xx);
                                    				            	 $len=$word_size[0];
                                    				             	$width=$word_size[1];
                                    				             
                                    				            	$c_amount+=$row['rate']*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            
                                    				            }
                                    				            else
                                    				            {
                                    				            $c_amount+=floatval($row['rate'])+(floatval($ro->size_words-$ro->min_w)*floatval($row['erate']));
                                    				        	}
                                    				             $prem=explode(",",$ro->premimum);
                                                                 $am=$c_amount;
                                    				            if($prem[1] == 'Rs')
                                    				            {
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				            }
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				          
                                    				          
                                    				           if($premimum==NULL)
                                    				           {
                                    				           $premimum=0;
                                    				           }
                                    				             
                                    				            $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                    				           
                                                				       
                                                				           

            							$table_data=array(
            							    'ro_main_id'=>$row['ro_main_id'],
            								'bill_id'=>$in_id,
            								'ro_id'=>$row['ro_id'],
            								'type_id'=>$row['type_id'],
            								'ro_session'=>$row['work_year'],
            								'insertion'=>$ro->insertion,
            								'pub_date'=>$row['dop'],
            								'paper'=>$row['paper_id'],
            								'heading'=>$heading_main,
            								'pack'=>$ro->pack,
					
            								'scheme'=>$ro->scheme,
            								'premimum'=>$values1['premimum'],
            								'premimum_val'=>$premimum,
            								'word_size'=>$ro->size_words,
            								'rate'=>$row['rate'],
            								'e_rate'=>$row['erate'],
            								'min_w'=>$ro->min_w,
            								'amount'=>$c_amount,
            								'box_charges'=>0,
            								'dis_per'=>$ro->dis_per,
            								'discount'=>$dis,
            								'net_amount'=>$p_amount,
            								'status'=>"Y",
            								'Ad_type'=>"Paid",
            										'size_type'=>$size_type,
            								);
            									               
                                    		      if($pcount1 > $Paid)
                                    				          
                                    				           { $table_data['amount']=0;
                                    				           $table_data['discount']=0;
                                    				               $table_data['net_amount']=0;
                                    				               $table_data['Ad_type']="Free";
                                    				           }
            						
            						
            							$this->db->insert('tbl_bill_details', $table_data);
            							$pcount1++;
            							
            						//	echo $this->db->last_query();
            							$word_size=split("X",$ro->size_words);
            						//	echo $ro->size_words."vv".var_dump($word_size)."</br>".var_dump($table_data);
            						//die;
            					
					}
            						    
            						}
}
            						$query=$this->db->query("select DISTINCT ro_id,insertion from tbl_bill_details where bill_id ='".$in_id."'" );
            						$ro_data=$query->result();
            						foreach($ro_data as $bd)
            						{
            					   $result=$this->db->select("*")->where(["id"=>$bd->ro_id])->get("tbl_book_ads")->row();
						            $this->db->where('id',$bd->ro_id);
                    	            $this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day-$bd->insertion)]);
            						}
					$query=$this->db->query("select * from tbl_bill_details where bill_id ='".$in_id."'" );
	             // echo $this->db->last_query();
					$bill_data=$query->result();
					foreach($bill_data as $bd){
					    
					  
        					$query=$this->db->query("select * from tbl_ro_dop where ro_id ='".$bd->ro_id."' and work_year='".$bd->ro_session."' and paper_id='".$bd->paper."'" );
        				//	echo $this->db->last_query();
        					$rem=$query->result();
        					
        					
                                    $dates=explode(",",$bd->pub_date);
        					       // echo var_dump($dates);
        					        foreach($dates as $dt)
        					        {
                					          $dd=date_create($dt);
                					          if(isset($dd)){
                					          $dt1=date_format($dd,"Y-m-d");
                					          $dt2=date_format($dd,"m/d/Y");
                					          foreach($rem as $re)
                					          {
                					                    $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='$dt1', bill_status='Y',bill_number='$bill_no' where  `id`=$re->id  and (dop='".$dt1."')  ");
                					      //	echo $this->db->last_query();
                					          }
        					                }
        					        
            					        }
        					    
        				
					
					
            					
            					
            			
            					
            		
					}}}  
					$query=$this->db->query("delete from `tbl_bill_temp_details` where  emp_id='".$_SESSION['admin']['id']."' ");
		$query=$this->db->query("delete from `tbl_bill_temp` where  emp_id='".$_SESSION['admin']['id']."' ");

            						
            		$msg="5";
					echo $msg;
					return;	
			  
			           
			   }
			   else
			   {
			   
				$tbl_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_bill_temp");
		
				if($tbl_bill_temp->num_rows()==0)
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{
					$this->load->model("site_model");
					$res=$this->site_model->get_data("tbl_client",['id'=>$this->input->post('client')])[0];
					$client_name=$res['client_name'];
					
					//echo '<pre>'; var_dump($_POST); die;
					$days=$this->input->post('due_day')." days";
                    
                    
                    $dt=new DateTime($this->input->post('bill_date'));
                    $bill_date=$dt->format("Y-m-d");    
                    
                    
                    $due_date=date('Y-m-d',strtotime( $bill_date . ' +30 day'));
					$bill_no=bill_no_gen();
                                    
                    
					$values = array(
						'bill_no'=>$bill_no,
						'work_year'=> $_SESSION['work_year'],
						'client_id'=> $this->input->post('client'),
						'emp_id'=>$_SESSION['admin']['id'],
                        'bill_date'=> $bill_date,
						'amount'=> $this->input->post('amount'),
						'box_charges'=> $this->input->post('box_c'),
						'total'=> $this->input->post('total'),
						'dis_per'=> $this->input->post('dis_per'),
						'discount'=> $this->input->post('discount'),
						'art_work_charges'=> $this->input->post('art_work_charges'),
						'other_charges'=> $this->input->post('other_charges'),
						'net_amount'=> $this->input->post('net_amount'),
						'igst'=> $this->input->post('igst'),
						'cgst'=> $this->input->post('cgst'),
						'sgst'=> $this->input->post('sgst'),
						'due_date'=> $due_date,
						'Shared'=>'NO',
						'Shared_id'=>''
					);
					$query = $this->db->insert('tbl_bill', $values);
				//	echo $this->db->last_query(); 
					$in_id=$this->db->insert_id();

					$result=$this->site_model->get_data("tbl_ledgers",['master_id'=>$this->input->post('client')])[0];
				//	echo "result id:".$result['ledger_id'];
					$ledger_id=$result['ledger_id'];
					if(empty($result['ledger_id'])){
						$values = array(
							'group_id'=>2,
							'master_id'=> $this->input->post('client'),
							'ledger_name'=> $client_name,
							'opening_balance'=>0,
							'editable'=>'no'
						);
						$ledger_id=$this->site_model->insert_data('tbl_ledgers', $values); 
					}

					$values = array(
						'group_id'=>2,
						'ledger_id'=> $ledger_id,
						'voucher_date'=>  $bill_date,
						'entry_type'=>'dr',
						'amount'=>$this->input->post('amount')-$this->input->post('discount')+$this->input->post('igst')+$this->input->post('sgst')+$this->input->post('cgst')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Bill generated for ".$client_name."No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>9,
						'ledger_id'=>12,
						'voucher_date'=>  $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('discount'),
						'narration'=>"Discount generated for ".$ledger_name." Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>7,
						'ledger_id'=>9,
						'voucher_date'=>  $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('total')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Advertisement Income on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					if($this->input->post('igst')){
					$values = array(
						'group_id'=>15,
						'ledger_id'=>13,
						'voucher_date'=>  $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('igst'),
						'narration'=>"IGST on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 
					}

					if($this->input->post('cgst')){
					$values = array(
						'group_id'=>15,
						'ledger_id'=>14,
						'voucher_date'=>  $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('cgst'),
						'narration'=>"CGST on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 
				}

				if($this->input->post('sgst')){
					$values = array(
						'group_id'=>15,
						'ledger_id'=>15,
						'voucher_date'=>  $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('sgst'),
						'narration'=>"UGST on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				
				}

					
					$result=$tbl_bill_temp->result();
					$bill_detail=array();
					$c=0;
                    $heading_main=0;
					$days=array();
			foreach($result as $ro){
					     $this->db->query("INSERT INTO `tbl_bill_edit`( `bill_id`, `ro_id`, `work_year`, `ro_no`, `client_id`, `emp_id`, `newspaper_id`, `type_id`, `cat_id`, `size_words`, `min_w`, `insertion`, `p_date`, `price`, `eprice`, `amount`, `scheme`, `pack`, `premimum`, `extra_price`, `add_on_amount`, `dis_per`, `discount`, `height`, `width`, `box_charges`, `payable_amount`, `ro_date`) values ('$in_id', '$ro->ro_id', '$ro->work_year', '$ro->ro_no', '$ro->client_id', '$ro->emp_id', '$ro->newspaper_id', '$ro->type_id', '$ro->cat_id', '$ro->size_words', '$ro->min_w', '$ro->insertion', '$ro->p_date', '$ro->price', '$ro->eprice', '$ro->amount', '$ro->scheme', '$ro->pack', '$ro->premimum', '$ro->extra_price', '$ro->add_on_amount', '$ro->dis_per', '$ro->discount', '$ro->height', '$ro->width', '$ro->box_charges', '$ro->payable_amount', '$ro->ro_date' ) ");    
                      
						$values1['box_charges']=$ro->box_charges;
						//$values1['p_amount']=($ro->amount+$ro->discount);
						$values1['status']="Y";
				
						/************* Enter into tbl_bill_details *********************************/
            					
            						  $tempdop=$ro->p_date;
                                    		    $tempro_id=$ro->ro_id;
                                    		    $Free=$ro->Free;
                                    		    $Paid=$ro->Paid;
                                    		  $size_type=$ro->size_type;
                                    		    $p_datetemp=explode(',',$tempdop);
                                    		    $pcount=1;
                                    		   
                                    		    foreach($p_datetemp as $dt)
                                    		    { 
                                    		        $ddtemp=date('Y-m-d',strtotime($dt));
                                    		        $query2=$this->db->query("select * from tbl_ro_dop where ro_id='$tempro_id' and dop='$ddtemp'");
                                    		       
                                    		        $result1=$query2->row();
                                    		        
                                    		        $dop_amount=floatval($result1->dop_amount);
                                    		       // $values1['insertion']=1;
                                    		        
                                                            	$c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($ro->eprice);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				           
                                    				            if($ro->type_id==2|| $ro->type_id==3)
                                    				            {
                                    				            if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($ro->price)*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				            	$word_size=split('X',$ro->size_words);
                                    				            	$len=$word_size[0];
                                    				            	$width=$word_size[1];
                                    				            	$c_amount+=floatval($ro->price)*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            }
                                    				            else
                                    				            {
                                    				               
                                    				            $c_amount+= floatval($ro->price)+(floatval($ro->size_words-$ro->min_w)*floatval($ro->eprice));
                                    				            
                                    				        	}
                                    				            $prem=explode(",",$ro->premimum);
                                                                $am=$c_amount;
                                    				           if($prem[1] == 'Rs')
                                    				            { 
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				               
                                    				            }
                                                                
                                                                
                                                                if($premimum==NULL)
                                                                {
                                                                    $premimum=0;
                                                                }
                                    				            //premimum+=parseFloat(d.premimum);
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				             $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                    				         	      
                                    				             $heading_main=$ro->cat_id;
                                            						$values1=array();
                                            						$values1['ro_main_id']=$result1->id;
                                            						$values1['bill_id']=$in_id;
                                            						$values1['ro_id']=$ro->ro_id;
                                            						$values1['type_id']=$ro->type_id;
                                            						$values1['ro_session']=$ro->work_year;
                                            						$values1['insertion']=$ro->insertion;
                                            						$values1['pub_date']=$ddtemp;
                                            						$values1['paper']=$ro->newspaper_id;
                                            						$values1['heading']=$ro->cat_id;
                                            						$values1['pack']=$ro->pack;
                                            						$values1['scheme']=$ro->scheme;
                                            						$values1['premimum']=$ro->premimum;
                                            						$values1['premimum_val']=$premimum;
                                            						$values1['word_size']=$ro->size_words;
                                            						$values1['rate']=$ro->price;
                                            						$values1['e_rate']=$ro->eprice;
                                            						$values1['min_w']=$ro->min_w;
                                            						 $values1['amount']=$c_amount;
                                            						 $values1['box_charges']=$box_charges;
                                            						$values1['dis_per']=$ro->dis_per;
                                            					    $values1['discount']=$dis;
                                    				                 $values1['net_amount']=$p_amount;
                                    				                 $values1['status']="Y";
                                    				                
                                    				                  $values1['Ad_type']="Paid";
                                    				                  $values1['size_type']=$size_type;
                                    				                   
                                    				                   if($pcount > $Paid)
                                    				          
                                    				           {
                                    				               $values1['amount']=0;
                                    				               $values1['discount']=0;$values1['net_amount']=0;
                                    				               $values1['Ad_type']="Free";
                                    				           }
                                    		   
            						            $this->db->insert('tbl_bill_details', $values1);
            						            
            						            	$pcount++;
                                    		    }
            						//echo $this->db->last_query();
            /************* Enter into tbl_bill_details *********************************/
            						$resp=$this->site_model->get_data("tbl_bill_temp_details",['ro_id'=>$ro->ro_id]);
            						$pcount1=1;
            						if(!empty($resp))
            						{
            						foreach($resp as $row){
            						  
                                    		        $query=$this->db->query("select * from tbl_ro_dop where id='".$row['ro_main_id']."'");
                                    		       
                                    		        $result2=$query->row();
                                    		        $dop_amount2=floatval($result2->dop_amount);
            						                  $c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($row['erate']);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				            if($row['type_id']==2 || $row['type_id']==3)
                                    				            {
                                    				                 if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($row['rate'])*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				               $xx =$ro->size_words;
                                    				            	$word_size=split("X",$xx);
                                    				            	 $len=$word_size[0];
                                    				             	$width=$word_size[1];
                                    				             
                                    				            	$c_amount+=$row['rate']*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            
                                    				            }
                                    				            else
                                    				            {
                                    				            $c_amount+=floatval($row['rate'])+(floatval($ro->size_words-$ro->min_w)*floatval($row['erate']));
                                    				        	}
                                    				             $prem=explode(",",$ro->premimum);
                                                                 $am=$c_amount;
                                    				            if($prem[1] == 'Rs')
                                    				            {
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				            }
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				           
                                    				          
                                    				           if($premimum==NULL)
                                    				           {
                                    				           $premimum=0;
                                    				           }
                                    				           
                                    				              $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                                				       
                                                				           

            							$table_data=array(
            							    'ro_main_id'=>$row['ro_main_id'],
            								'bill_id'=>$in_id,
            								'ro_id'=>$row['ro_id'],
            								'type_id'=>$row['type_id'],
            								'ro_session'=>$row['work_year'],
            								'insertion'=>$ro->insertion,
            								'pub_date'=>$row['dop'],
            								'paper'=>$row['paper_id'],
            								'heading'=>$heading_main,
            								'pack'=>$ro->pack,
					
            								'scheme'=>$ro->scheme,
            								'premimum'=>$values1['premimum'],
            								'premimum_val'=>$premimum,
            								'word_size'=>$ro->size_words,
            								'rate'=>$row['rate'],
            								'e_rate'=>$row['erate'],
            								'min_w'=>$ro->min_w,
            								'amount'=>$c_amount,
            								'box_charges'=>0,
            								'dis_per'=>$ro->dis_per,
            								'discount'=>$dis,
            								'net_amount'=>$p_amount,
            								'status'=>"Y",
            								'Ad_type'=>"Paid",
            										'size_type'=>$size_type,
            								);
            									               
                                    		      if($pcount1 > $Paid)
                                    				          
                                    				           { $table_data['amount']=0;
                                    				           $table_data['discount']=0;
                                    				               $table_data['net_amount']=0;
                                    				               $table_data['Ad_type']="Free";
                                    				           }
            						
            						
            							$this->db->insert('tbl_bill_details', $table_data);
            							$pcount1++;
            							
            						//	echo $this->db->last_query();
            							$word_size=split("X",$ro->size_words);
            						//	echo $ro->size_words."vv".var_dump($word_size)."</br>".var_dump($table_data);
            						//die;
            					
					}
            						    
            						}
}
					$query=$this->db->query("delete from `tbl_bill_temp_details` where  emp_id='".$_SESSION['admin']['id']."' ");
		$query=$this->db->query("delete from `tbl_bill_temp` where  emp_id='".$_SESSION['admin']['id']."' ");

				}
			   
				
				$query=$this->db->query("select DISTINCT ro_id,insertion from tbl_bill_details where bill_id ='".$in_id."'" );
            	$ro_data=$query->result();
            	foreach($ro_data as $bd)
            			{
            			   $result=$this->db->select("*")->where(["id"=>$bd->ro_id])->get("tbl_book_ads")->row();
				           $this->db->where('id',$bd->ro_id);
                           $this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day-$bd->insertion)]);
            			}
				
					
					$query=$this->db->query("select * from tbl_bill_details where bill_id ='".$in_id."'" );
				//	echo $this->db->last_query();
	           
					$bill_data=$query->result();
					foreach($bill_data as $bd){	
					    
					   
                    		
        					$query=$this->db->query("select * from tbl_ro_dop where ro_id ='".$bd->ro_id."' and work_year='".$bd->ro_session."' and paper_id='".$bd->paper."'" );
        				
        				
        					$rem=$query->result();
        					
        					
                                    $dates=explode(",",$bd->pub_date);
        					     
        					        foreach($dates as $dt)
        					        {
                					          $dd=date_create($dt);
                					          if(isset($dd)){
                					          $dt1=date_format($dd,"Y-m-d");
                					         // $dt2=date_format($dd,"m/d/Y");
                					          foreach($rem as $re)
                					          {
                					                    $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='$dt1', bill_status='Y',bill_number='$bill_no' where  `id`=$re->id  and (dop='".$dt1."')  ");
                		
                					          }
                					          }
        					        
            					        }
        					  
        				
					
					}
			
			   
					$msg="5";
					echo $msg;
					return;					
				}
			}			
		}
	}
	
	public function shared_bill_generate($client,$shared_per,$main_shared_per,$amount)
	{
	    
	}

	public function update_bill()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('amount', 'Amount', 'required');			
			$this->form_validation->set_rules('net_amount', 'Net Amount', 'required');
			$this->form_validation->set_rules('due_day', 'Due Day', 'required');
			$this->form_validation->set_rules('total', 'total', 'required');
			$this->form_validation->set_rules('client', 'client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
				/******************************/
				/* Code to retrive bill_no */
				/*****************************/
				 $rembill=$_POST['remove_bill'];
				 $cancel_parties=$_POST['cancel_parties'];
				 
				 if(!empty($cancel_parties))
				 {
				     
				     foreach($cancel_parties as $cparty)
				     {
				         $this->db->query("update tbl_bill set Shared_Status='".Cancel."' where id='$cparty'");
				           $this->db->query("delete from tbl_bill_details  where bill_id='$cparty'");
				         $this->db->query("DELETE from tbl_vouchers where group_id= '2' and screen='Client Bill' and screen_id='$cparty'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '9' and ledger_id='12' and screen='Client Bill' and screen_id='$cparty'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '7' and ledger_id='9' and screen='Client Bill' and screen_id='$cparty'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='13' and screen='Client Bill' and screen_id='$cparty'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='14' and screen='Client Bill' and screen_id='$cparty'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='15' and screen='Client Bill' and screen_id='$cparty'");
				     
				    }
				 }
				  $bill_id=$this->input->post('bill_id');
				     for($i=0;$i<count($rembill);$i++)
				     {
                    	      //query to add insertions back into the tbl_book_ads//
                    	      	$query=$this->db->query("select * from tbl_bill_details where bill_id ='".$bill_id."' and ro_id='$rembill[$i]'" );
                                						$ro_data=$query->result();
                                						$insertion=$ro_data[0]->insertion;
                                					
                                					   $resultbook=$this->db->select("*")->where(["id"=>$rembill[$i]])->get("tbl_book_ads")->row();
                                					   	
                    						            $this->db->where('id',$rembill[$i]);
                                        	            $this->db->update("tbl_book_ads",["publish_day"=>($resultbook->publish_day+$insertion)]);
                                					
                    	      
                    	      	
                    	   foreach($ro_data as $rod)
                    	   {
                    				    
                                    					                    $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='', bill_status='N',bill_number='0' where  `id`=$rod->ro_main_id ");
                                    		
                                    					         
                    		}
                    	 
                    	  
                    	
                             $this->db->query("delete from tbl_bill_details where ro_id ='".$rembill[$i]."' and bill_id ='".$bill_id."' " );
                    
                    
                         
				     }
				 
//echo"select * from tbl_bill_details where bill_id ='".$bill_id."' and ro_id='$rembill[0]'";
			    
			    //die;
			  //  $ro_main_id =$this->input->post('ro_main_id');
			    
			  
			    //$bill_id;
			    $sqlbill=$this->db->query("select * from `tbl_bill` where `id`='".$bill_id."'");
	

			    $resultbill=$sqlbill->row();
			    
			    	$bill_no=$resultbill->bill_no;
			    
			  
			    $shared_client=$this->input->post('shared_client');
		 if(!empty($shared_client))
			   {
			    
			       $amount=0;
			        $count=count($shared_client);
			        array_unshift($shared_client,$this->input->post('client'));
    			    $shared_per =$this->input->post('shared_per');
    			  //echo "</br>";
    			    $main_shared_per =$this->input->post('mshare');
    			 //  echo "</br>";
    			 // echo $shared_per;
    			 // echo $count;die;
    			   $mshare=floatval(($this->input->post('amount'))*floatval($main_shared_per)/100);
    			   $s_share=floatval(($this->input->post('amount'))*floatval($shared_per)/100)/floatval($count);
    			 //  echo "mshare".$mshare;
    			 //   echo "</br>";
    			 //  echo "share".$s_share;
    			 //   echo "</br>";
    			 //  die;
    			$pshare=floatval($shared_per)/floatval($count);
    // 			echo $pshare;
    // 		echo number_format($pshare,2);
    // 		die;
    			 $shared_id='';
			           $Shared_amount='';
			            foreach($shared_client as $cs)
			            {
    			                if($cs==$this->input->post('client'))
    			                {
    			                  $Shared_amount=$main_shared_per;
    			                    $amount =$mshare;
    			                }
    			               else
    			               {
    			                    $Shared_amount=number_format($pshare,2);
    			                    $amount =$s_share;
    			               }
    			               		$query2 = $this->db->select('*')->from('tbl_tax')->where('title','IGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['igst']= $query2->get()->row();
	
	
			$cgst = $this->db->select('*')->from('tbl_tax')->where('title','CGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['cgst']= $cgst->get()->row();
	
			$sgst = $this->db->select('*')->from('tbl_tax')->where('title','SGST')->where('date_from <=', date('Y-m-d'))
            ->where('date_to >=', date('Y-m-d'));
           $data['sgst']= $sgst->get()->row();
	
			                 $query=$this->db->query("SELECT id from states where name=(SELECT state FROM `tbl_client_details` where uid='$cs' limit 1)");
			             
    			              $state=$query->row();
    			             
    			             
    			                 if($state->id==null){
                                   if($data['cgst']){
                                    $cgst=(floatval($amount)*$data['cgst']->tax_rate)/100;
                                   } else {
                                    $cgst=(floatval($amount)*2.5)/100;
                                   }
                                   
                                   if($data['sgst']){
                                    $sgst=(floatval($amount)*$data['sgst']->tax_rate)/100;
                                   } else {
                                    $sgst=(floatval($amount)*2.5)/100;
                                   }
                                
                                    $igst=0;	
                                }
                                else if($state->id=="6"){
                                     if($data['cgst']){
                                    $cgst=(floatval($amount)*$data['cgst']->tax_rate)/100;
                                   } else {
                                    $cgst=(floatval($amount)*2.5)/100;
                                   }
                                   
                                   if($data['sgst']){
                                    $sgst=(floatval($amount)*$data['sgst']->tax_rate)/100;
                                   } else {
                                    $sgst=(floatval($amount)*2.5)/100;
                                   }
                                
                                    $igst=0;
                                }
                                else{
                                    $cgst=0;
                                    $sgst=0;
                                              if($data['igst']){
                                    $igst=(floatval($amount)*$data['igst']->tax_rate)/100;
                                        
                                    } else {
                                    $igst=(floatval($amount)*5)/100;
                                    }
                          
                                }
			               $total=$amount+$this->input->post('box_c');
			               $net_amount=$total+ $this->input->post('dis_per')+$this->input->post('discount')+$this->input->post('art_work_charges')+$this->input->post('other_charges')+$igst+$cgst+$sgst;
			               
			            	$tbl_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_bill_temp");
			            
			       
            				// if($tbl_bill_temp->num_rows()==0)
            				// {
            				// 	$msg="2";
            				// 	echo $msg;
            				// 	return;
            				// }
            				// else
            				// {
            				 	$this->load->model("site_model");
            			
            					$res=$this->site_model->get_data("tbl_client",['id'=>$cs])[0];
            					$client_name=$res['client_name'];
            					  
            					
            					//echo '<pre>'; var_dump($_POST); die;
            					$days=$this->input->post('due_day')." days";
                                
                                
                                $dt=new DateTime($this->input->post('bill_date'));
                                $bill_date=$dt->format("Y-m-d");    
                                

                                $due_date=date('Y-m-d',strtotime( $bill_date . ' +30 day'));
            					//$date=date_create();
            					//date_add($date,date_interval_create_from_date_string($days));
            					//$due_date=date_format($date,"Y-m-d");
            				//	$bill_no=bill_no_gen();
                                  if($cs==$this->input->post('client'))
    			                {
    			                    $shared_id='';
    			                    
    			                } 
    			                else
    			                {
    			                     $shared_id=$bill_id;
    			                }
                               
            					$values = array(
            						
            						
            				 		'client_id'=> $cs,
            				 		'emp_id'=>$_SESSION['admin']['id'],
                                    'bill_date'=> $bill_date,
            						'amount'=> floatval($amount),
            						'box_charges'=> $this->input->post('box_c'),
            						'total'=> $total,
            						'dis_per'=> $this->input->post('dis_per'),
            						'discount'=> $this->input->post('discount'),
            						'art_work_charges'=> $this->input->post('art_work_charges'),
            						'other_charges'=> $this->input->post('other_charges'),
            						'net_amount'=> $net_amount,
            						'igst'=> $igst,
            						'cgst'=>$cgst,
            						'sgst'=>$sgst,
            						'due_date'=> $due_date,
            						'Shared'=>'YES',
						            'Shared_id'=>$shared_id,
						             'Shared_Per'=>$Shared_amount
            					);
            			//	$query = $this->db->update('tbl_bill', $values,['id'=>$bill_id]);
            			//	echo $this->db->last_query();   
            				if($cs==$this->input->post('client'))
            				{
            				$this->db->where(['id'=>$bill_id])->update('tbl_bill', $values);
            			//	echo $this->db->last_query();
            				$in_id=$bill_id;
            				}
            				else
            				{
            				    $findCl=$this->db->query("select * from tbl_bill where Shared_id='$bill_id' and client_id='$cs' and Shared_Status!='Cancel'");
            				 //  echo $this->db->last_query();
            				    $clRes=$findCl->row();
            				    if(!empty($clRes))
            				    {
            				        
            				        if($cs==$clRes->client_id)
            				        {
            				        $this->db->where(['id'=>$clRes->id])->update('tbl_bill', $values);
            				      //  echo $this->db->last_query();
            				        $in_id=$clRes->id;
            				        }
            				       
            				        
            				    }
            				    else
            				    {
            				       	$bill_no=bill_no_gen();
                                                
                                
            					$values = array(
            						'bill_no'=>$bill_no,
            						'work_year'=> $_SESSION['work_year'],
            						'client_id'=> $cs,
            						'emp_id'=>$_SESSION['admin']['id'],
                                    'bill_date'=> $bill_date,
            						'amount'=> floatval($amount),
            						'box_charges'=> $this->input->post('box_c'),
            						'total'=> $total,
            						'dis_per'=> $this->input->post('dis_per'),
            						'discount'=> $this->input->post('discount'),
            						'art_work_charges'=> $this->input->post('art_work_charges'),
            						'other_charges'=> $this->input->post('other_charges'),
            						'net_amount'=> $net_amount,
            						'igst'=> $igst,
            						'cgst'=>$cgst,
            						'sgst'=>$sgst,
            						'due_date'=> $due_date,
            						'Shared'=>'YES',
						            'Shared_id'=>$shared_id,
						            'Shared_Per'=>$Shared_amount
            					);
            					$query = $this->db->insert('tbl_bill', $values);
            		//	echo $this->db->last_query();
            					$in_id=$this->db->insert_id(); 
            				    }
            				}
            			
           
            					$result=$this->site_model->get_data("tbl_ledgers",['master_id'=>$cs])[0];
            			$this->db->query("DELETE from tbl_vouchers where group_id= '2' and screen='Client Bill' and screen_id='$in_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '9' and screen='Client Bill' and ledger_id='12' and screen_id='$in_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '7' and screen='Client Bill' and ledger_id='9' and screen_id='$in_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and screen='Client Bill' and ledger_id='13' and screen_id='$in_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and screen='Client Bill' and ledger_id='14' and screen_id='$in_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and screen='Client Bill' and ledger_id='15' and screen_id='$in_id'");
            					$ledger_id=$result['ledger_id'];
            					if(empty($result['ledger_id'])){
            						$values = array(
            							'group_id'=>2,
            							'master_id'=> $cs,
            							'ledger_name'=> $client_name,
            							'opening_balance'=>0,
            							'editable'=>'no'
            						);
            						$ledger_id=$this->site_model->insert_data('tbl_ledgers', $values); 
            					//	echo $this->db->last_query(); 
            					}
            
            					$values = array(
            						'group_id'=>2,
            						'ledger_id'=> $ledger_id,
            						'voucher_date'=>$bill_date,
            						'entry_type'=>'dr',
            						'amount'=>$amount-$this->input->post('discount')+$igst+$sgst+$cgst+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
            						'narration'=>"Bill generated for ".$client_name."No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            	
            
            					$values = array(
            						'group_id'=>9,
            						'ledger_id'=>12,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$this->input->post('discount'),
            						'narration'=>"Discount generated for ".$ledger_name." Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            			//	echo $this->db->last_query(); 
            
            					$values = array(
            						'group_id'=>7,
            						'ledger_id'=>9,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$amount+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
            						'narration'=>"Advertisement Income on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            				//	echo $this->db->last_query(); 
            
            					if($igst){
            					$values = array(
            						'group_id'=>15,
            						'ledger_id'=>13,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$igst,
            						'narration'=>"IGST on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            				//	echo $this->db->last_query(); 
            					}
            
            					if($cgst){
            					$values = array(
            						'group_id'=>15,
            						'ledger_id'=>14,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$cgst,
            						'narration'=>"CGST on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            			//	echo $this->db->last_query(); 
            				}
            
            				if($sgst){
            					$values = array(
            						'group_id'=>15,
            						'ledger_id'=>15,
            						'voucher_date'=> $bill_date,
            						'entry_type'=>'cr',
            						'amount'=>$sgst,
            						'narration'=>"UGST on Bill No: ".$bill_no,
            						'voucher_no'=>1,
            						'screen'=>"Client Bill",
            						'screen_id'=>$in_id,
            						'voucher_session'=>1
            					);
            					$this->site_model->insert_data('tbl_vouchers', $values); 
            				//	echo $this->db->last_query(); 
            				}
            
            					//echo $this->db->last_query(); return;
            					//$in_id=$this->db->insert_id();
            					$result=$tbl_bill_temp->result();
            					
            					$bill_detail=array();
            					$c=0;
                                 $heading_main=0;
            					$days=array();
            			foreach($result as $ro){
					     $this->db->query("INSERT INTO `tbl_bill_edit`( `bill_id`, `ro_id`, `work_year`, `ro_no`, `client_id`, `emp_id`, `newspaper_id`, `type_id`, `cat_id`, `size_words`, `min_w`, `insertion`, `p_date`, `price`, `eprice`, `amount`, `scheme`, `pack`, `premimum`, `extra_price`, `add_on_amount`, `dis_per`, `discount`, `height`, `width`, `box_charges`, `payable_amount`, `ro_date`) values ('$in_id', '$ro->ro_id', '$ro->work_year', '$ro->ro_no', '$ro->client_id', '$ro->emp_id', '$ro->newspaper_id', '$ro->type_id', '$ro->cat_id', '$ro->size_words', '$ro->min_w', '$ro->insertion', '$ro->p_date', '$ro->price', '$ro->eprice', '$ro->amount', '$ro->scheme', '$ro->pack', '$ro->premimum', '$ro->extra_price', '$ro->add_on_amount', '$ro->dis_per', '$ro->discount', '$ro->height', '$ro->width', '$ro->box_charges', '$ro->payable_amount', '$ro->ro_date' ) ");    
                      
						$values1['box_charges']=$ro->box_charges;
						//$values1['p_amount']=($ro->amount+$ro->discount);
						$values1['status']="Y";
				
						/************* Enter into tbl_bill_details *********************************/
            					
            						  $tempdop=$ro->p_date;
                                    		    $tempro_id=$ro->ro_id;
                                    		    $Free=$ro->Free;
                                    		    $Paid=$ro->Paid;
                                    		  $size_type=$ro->size_type;
                                    		    $p_datetemp=explode(',',$tempdop);
                                    		    $pcount=1;
                                    		   
                                    		    foreach($p_datetemp as $dt)
                                    		    { 
                                    		        $ddtemp=date('Y-m-d',strtotime($dt));
                                    		        $query2=$this->db->query("select * from tbl_ro_dop where ro_id='$tempro_id' and dop='$ddtemp'");
                                    		       
                                    		        $result1=$query2->row();
                                    		        
                                    		        $dop_amount=floatval($result1->dop_amount);
                                    		       // $values1['insertion']=1;
                                    		        
                                                            	$c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($ro->eprice);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				           
                                    				            if($ro->type_id==2|| $ro->type_id==3)
                                    				            {
                                    				            if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($ro->price)*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				            	$word_size=split('X',$ro->size_words);
                                    				            	$len=$word_size[0];
                                    				            	$width=$word_size[1];
                                    				            	$c_amount+=floatval($ro->price)*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            }
                                    				            else
                                    				            {
                                    				               
                                    				            $c_amount+= floatval($ro->price)+(floatval($ro->size_words-$ro->min_w)*floatval($ro->eprice));
                                    				            
                                    				        	}
                                    				            $prem=explode(",",$ro->premimum);
                                                                $am=$c_amount;
                                    				           if($prem[1] == 'Rs')
                                    				            { 
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				               
                                    				            }
                                                                
                                                                
                                                                if($premimum==NULL)
                                                                {
                                                                    $premimum=0;
                                                                }
                                    				            //premimum+=parseFloat(d.premimum);
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				             $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                    				         	      
                                    				             $heading_main=$ro->cat_id;
                                            						$values1=array();
                                            						$values1['ro_main_id']=$result1->id;
                                            						$values1['bill_id']=$in_id;
                                            						$values1['ro_id']=$ro->ro_id;
                                            						$values1['type_id']=$ro->type_id;
                                            						$values1['ro_session']=$ro->work_year;
                                            						$values1['insertion']=$ro->insertion;
                                            						$values1['pub_date']=$ddtemp;
                                            						$values1['paper']=$ro->newspaper_id;
                                            						$values1['heading']=$ro->cat_id;
                                            						$values1['pack']=$ro->pack;
                                            						$values1['scheme']=$ro->scheme;
                                            						$values1['premimum']=$ro->premimum;
                                            						$values1['premimum_val']=$premimum;
                                            						$values1['word_size']=$ro->size_words;
                                            						$values1['rate']=$ro->price;
                                            						$values1['e_rate']=$ro->eprice;
                                            						$values1['min_w']=$ro->min_w;
                                            						 $values1['amount']=$c_amount;
                                            						 $values1['box_charges']=$box_charges;
                                            						$values1['dis_per']=$ro->dis_per;
                                            					    $values1['discount']=$dis;
                                    				                 $values1['net_amount']=$p_amount;
                                    				                 $values1['status']="Y";
                                    				                
                                    				                  $values1['Ad_type']="Paid";
                                    				                  $values1['size_type']=$size_type;
                                    				                   
                                    				                   if($pcount > $Paid)
                                    				          
                                    				           {
                                    				               $values1['amount']=0;
                                    				               $values1['discount']=0;$values1['net_amount']=0;
                                    				               $values1['Ad_type']="Free";
                                    				           }
                                    		   
            						            $this->db->insert('tbl_bill_details', $values1);
            						            
            						            	$pcount++;
                                    		    }
            						//echo $this->db->last_query();
            /************* Enter into tbl_bill_details *********************************/
            						$resp=$this->site_model->get_data("tbl_bill_temp_details",['ro_id'=>$ro->ro_id]);
            						$pcount1=1;
            						if(!empty($resp))
            						{
            						foreach($resp as $row){
            						  
                                    		        $query=$this->db->query("select * from tbl_ro_dop where id='".$row['ro_main_id']."'");
                                    		       
                                    		        $result2=$query->row();
                                    		        $dop_amount2=floatval($result2->dop_amount);
            						                  $c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($row['erate']);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				            if($row['type_id']==2 || $row['type_id']==3)
                                    				            {
                                    				                 if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($row['rate'])*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				               $xx =$ro->size_words;
                                    				            	$word_size=split("X",$xx);
                                    				            	 $len=$word_size[0];
                                    				             	$width=$word_size[1];
                                    				             
                                    				            	$c_amount+=$row['rate']*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            
                                    				            }
                                    				            else
                                    				            {
                                    				            $c_amount+=floatval($row['rate'])+(floatval($ro->size_words-$ro->min_w)*floatval($row['erate']));
                                    				        	}
                                    				             $prem=explode(",",$ro->premimum);
                                                                 $am=$c_amount;
                                    				            if($prem[1] == 'Rs')
                                    				            {
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				            }
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				            //$dis=($c_amount*$dis_per)/100;
                                    				          
                                    				           if($premimum==NULL)
                                    				           {
                                    				           $premimum=0;
                                    				           }
                                    				            $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                    				           
                                                				       
                                                				           

            							$table_data=array(
            							    'ro_main_id'=>$row['ro_main_id'],
            								'bill_id'=>$in_id,
            								'ro_id'=>$row['ro_id'],
            								'type_id'=>$row['type_id'],
            								'ro_session'=>$row['work_year'],
            								'insertion'=>$ro->insertion,
            								'pub_date'=>$row['dop'],
            								'paper'=>$row['paper_id'],
            								'heading'=>$heading_main,
            								'pack'=>$ro->pack,
					
            								'scheme'=>$ro->scheme,
            								'premimum'=>$values1['premimum'],
            								'premimum_val'=>$premimum,
            								'word_size'=>$ro->size_words,
            								'rate'=>$row['rate'],
            								'e_rate'=>$row['erate'],
            								'min_w'=>$ro->min_w,
            								'amount'=>$c_amount,
            								'box_charges'=>0,
            								'dis_per'=>$ro->dis_per,
            								'discount'=>$dis,
            								'net_amount'=>$p_amount,
            								'status'=>"Y",
            								'Ad_type'=>"Paid",
            										'size_type'=>$size_type,
            								);
            									               
                                    		      if($pcount1 > $Paid)
                                    				          
                                    				           { $table_data['amount']=0;
                                    				           $table_data['discount']=0;
                                    				               $table_data['net_amount']=0;
                                    				               $table_data['Ad_type']="Free";
                                    				           }
            						
            						
            							$this->db->insert('tbl_bill_details', $table_data);
            							$pcount1++;
            							
            						//	echo $this->db->last_query();
            							$word_size=split("X",$ro->size_words);
            						//	echo $ro->size_words."vv".var_dump($word_size)."</br>".var_dump($table_data);
            						//die;
            					
					}
            						    
            						}
}
            						$query=$this->db->query("select DISTINCT ro_id,insertion from tbl_bill_details where bill_id ='".$in_id."'" );
            						$ro_data=$query->result();
            						foreach($ro_data as $bd)
            						{
            					   $result=$this->db->select("*")->where(["id"=>$bd->ro_id])->get("tbl_book_ads")->row();
						            $this->db->where('id',$bd->ro_id);
                    	            $this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day-$bd->insertion)]);
            						}
					$query=$this->db->query("select * from tbl_bill_details where bill_id ='".$in_id."'" );
	             // echo $this->db->last_query();
					$bill_data=$query->result();
					foreach($bill_data as $bd){
					    
					  
        					$query=$this->db->query("select * from tbl_ro_dop where ro_id ='".$bd->ro_id."' and work_year='".$bd->ro_session."' and paper_id='".$bd->paper."'" );
        				//	echo $this->db->last_query();
        					$rem=$query->result();
        					
        					
                                    $dates=explode(",",$bd->pub_date);
        					       // echo var_dump($dates);
        					        foreach($dates as $dt)
        					        {
                					          $dd=date_create($dt);
                					        if(isset($dd)){
                					          $dt1=date_format($dd,"Y-m-d");
                					          $dt2=date_format($dd,"Y-m-d");
                					          foreach($rem as $re)
                					          {
                					                    $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='$dt1', bill_status='Y',bill_number='$bill_no' where  `id`=$re->id  and (dop='".$dt1."' OR dop='".$dt2."')  ");
                					      //	echo $this->db->last_query();
                					          }
                					        }
        					        
            					        }
        					    
        				
					
					
            					
            					
            			
            					
            		
					}} 
					$query=$this->db->query("delete from `tbl_bill_temp_details` where  emp_id='".$_SESSION['admin']['id']."' ");
		$query=$this->db->query("delete from `tbl_bill_temp` where  emp_id='".$_SESSION['admin']['id']."' ");

            						
            		$msg="5";
					echo $msg;
					return;	
			  
			           
			   }
			   else
			   {
			   
				$tbl_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_bill_temp");
		
			
					$this->load->model("site_model");
					$res=$this->site_model->get_data("tbl_client",['id'=>$this->input->post('client')])[0];
					$client_name=$res['client_name'];
					
					//echo '<pre>'; var_dump($_POST); die;
					$days=$this->input->post('due_day')." days";
                    
                    
                    $dt=new DateTime($this->input->post('bill_date'));
                    $bill_date=$dt->format("Y-m-d");    
                    
                    
                    $due_date=date('Y-m-d',strtotime( $bill_date . ' +30 day'));
				//	$bill_no=bill_no_gen();
                                    
                    
					$values = array(
				// 		'bill_no'=>$bill_no,
				// 		'work_year'=> $_SESSION['work_year'],
				// 		'client_id'=> $this->input->post('client'),
				// 		'emp_id'=>$_SESSION['admin']['id'],
    //                     'bill_date'=> $bill_date,
						'amount'=> $this->input->post('amount'),
						'box_charges'=> $this->input->post('box_c'),
						'total'=> $this->input->post('total'),
						'dis_per'=> $this->input->post('dis_per'),
						'discount'=> $this->input->post('discount'),
						'art_work_charges'=> $this->input->post('art_work_charges'),
						'other_charges'=> $this->input->post('other_charges'),
						'net_amount'=> $this->input->post('net_amount'),
						'igst'=> $this->input->post('igst'),
						'cgst'=> $this->input->post('cgst'),
						'sgst'=> $this->input->post('sgst'),
						'due_date'=> $due_date,
						'Shared'=>'NO',
						'Shared_id'=>''
					);
					$query = $this->db->update('tbl_bill', $values,['id'=>$bill_id]);
				//	echo $this->db->last_query(); 
					$in_id=$bill_id;

					$result=$this->site_model->get_data("tbl_ledgers",['master_id'=>$this->input->post('client')])[0];
				//	echo "result id:".$result['ledger_id'];
					$ledger_id=$result['ledger_id'];
					if(empty($result['ledger_id'])){
						$values = array(
							'group_id'=>2,
							'master_id'=> $this->input->post('client'),
							'ledger_name'=> $client_name,
							'opening_balance'=>0,
							'editable'=>'no'
						);
						$ledger_id=$this->site_model->insert_data('tbl_ledgers', $values); 
					}

 $this->db->query("DELETE from tbl_vouchers where group_id= '2' and screen='Client Bill' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '9' and screen='Client Bill' and ledger_id='12' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '7' and screen='Client Bill' and ledger_id='9' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='13' and screen='Client Bill' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='14' and screen='Client Bill' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='15' and screen='Client Bill' and screen_id='$bill_id'");
					$values = array(
						'group_id'=>2,
						'ledger_id'=> $ledger_id,
						'voucher_date'=> $bill_date,
						'entry_type'=>'dr',
						'amount'=>$this->input->post('amount')-$this->input->post('discount')+$this->input->post('igst')+$this->input->post('sgst')+$this->input->post('cgst')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Bill generated for ".$client_name."No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>9,
						'ledger_id'=>12,
						'voucher_date'=> $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('discount'),
						'narration'=>"Discount generated for ".$ledger_name." Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>7,
						'ledger_id'=>9,
						'voucher_date'=> $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('total')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Advertisement Income on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					if($this->input->post('igst')){
					$values = array(
						'group_id'=>15,
						'ledger_id'=>13,
						'voucher_date'=> $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('igst'),
						'narration'=>"IGST on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 
					}

					if($this->input->post('cgst')){
					$values = array(
						'group_id'=>15,
						'ledger_id'=>14,
						'voucher_date'=> $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('cgst'),
						'narration'=>"CGST on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 
				}

				if($this->input->post('sgst')){
					$values = array(
						'group_id'=>15,
						'ledger_id'=>15,
						'voucher_date'=> $bill_date,
						'entry_type'=>'cr',
						'amount'=>$this->input->post('sgst'),
						'narration'=>"UGST on Bill No: ".$bill_no,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				
				}

					
					$result=$tbl_bill_temp->result();
					$bill_detail=array();
					$c=0;
                    $heading_main=0;
					$days=array();
				foreach($result as $ro){
					     $this->db->query("INSERT INTO `tbl_bill_edit`( `bill_id`, `ro_id`, `work_year`, `ro_no`, `client_id`, `emp_id`, `newspaper_id`, `type_id`, `cat_id`, `size_words`, `min_w`, `insertion`, `p_date`, `price`, `eprice`, `amount`, `scheme`, `pack`, `premimum`, `extra_price`, `add_on_amount`, `dis_per`, `discount`, `height`, `width`, `box_charges`, `payable_amount`, `ro_date`) values ('$in_id', '$ro->ro_id', '$ro->work_year', '$ro->ro_no', '$ro->client_id', '$ro->emp_id', '$ro->newspaper_id', '$ro->type_id', '$ro->cat_id', '$ro->size_words', '$ro->min_w', '$ro->insertion', '$ro->p_date', '$ro->price', '$ro->eprice', '$ro->amount', '$ro->scheme', '$ro->pack', '$ro->premimum', '$ro->extra_price', '$ro->add_on_amount', '$ro->dis_per', '$ro->discount', '$ro->height', '$ro->width', '$ro->box_charges', '$ro->payable_amount', '$ro->ro_date' ) ");    
                      
						$values1['box_charges']=$ro->box_charges;
						//$values1['p_amount']=($ro->amount+$ro->discount);
						$values1['status']="Y";
				
						/************* Enter into tbl_bill_details *********************************/
            					
            						  $tempdop=$ro->p_date;
                                    		    $tempro_id=$ro->ro_id;
                                    		    $Free=$ro->Free;
                                    		    $Paid=$ro->Paid;
                                    		  $size_type=$ro->size_type;
                                    		    $p_datetemp=explode(',',$tempdop);
                                    		    $pcount=1;
                                    		   
                                    		    foreach($p_datetemp as $dt)
                                    		    { 
                                    		        $ddtemp=date('Y-m-d',strtotime($dt));
                                    		        $query2=$this->db->query("select * from tbl_ro_dop where ro_id='$tempro_id' and dop='$ddtemp'");
                                    		       
                                    		        $result1=$query2->row();
                                    		        
                                    		        $dop_amount=floatval($result1->dop_amount);
                                    		       // $values1['insertion']=1;
                                    		        
                                                            	$c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($ro->eprice);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				           
                                    				            if($ro->type_id==2|| $ro->type_id==3)
                                    				            {
                                    				            if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($ro->price)*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				            	$word_size=split('X',$ro->size_words);
                                    				            	$len=$word_size[0];
                                    				            	$width=$word_size[1];
                                    				            	$c_amount+=floatval($ro->price)*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            }
                                    				            else
                                    				            {
                                    				               
                                    				            $c_amount+= floatval($ro->price)+(floatval($ro->size_words-$ro->min_w)*floatval($ro->eprice));
                                    				            
                                    				        	}
                                    				            $prem=explode(",",$ro->premimum);
                                                                $am=$c_amount;
                                    				           if($prem[1] == 'Rs')
                                    				            { 
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				               
                                    				            }
                                                                
                                                                
                                                                if($premimum==NULL)
                                                                {
                                                                    $premimum=0;
                                                                }
                                    				            //premimum+=parseFloat(d.premimum);
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				             $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                    				         	      
                                    				             $heading_main=$ro->cat_id;
                                            						$values1=array();
                                            						$values1['ro_main_id']=$result1->id;
                                            						$values1['bill_id']=$in_id;
                                            						$values1['ro_id']=$ro->ro_id;
                                            						$values1['type_id']=$ro->type_id;
                                            						$values1['ro_session']=$ro->work_year;
                                            						$values1['insertion']=$ro->insertion;
                                            						$values1['pub_date']=$ddtemp;
                                            						$values1['paper']=$ro->newspaper_id;
                                            						$values1['heading']=$ro->cat_id;
                                            						$values1['pack']=$ro->pack;
                                            						$values1['scheme']=$ro->scheme;
                                            						$values1['premimum']=$ro->premimum;
                                            						$values1['premimum_val']=$premimum;
                                            						$values1['word_size']=$ro->size_words;
                                            						$values1['rate']=$ro->price;
                                            						$values1['e_rate']=$ro->eprice;
                                            						$values1['min_w']=$ro->min_w;
                                            						 $values1['amount']=$c_amount;
                                            						 $values1['box_charges']=$box_charges;
                                            						$values1['dis_per']=$ro->dis_per;
                                            					    $values1['discount']=$dis;
                                    				                 $values1['net_amount']=$p_amount;
                                    				                 $values1['status']="Y";
                                    				                
                                    				                  $values1['Ad_type']="Paid";
                                    				                  $values1['size_type']=$size_type;
                                    				                   
                                    				                   if($pcount > $Paid)
                                    				          
                                    				           {
                                    				               $values1['amount']=0;
                                    				               $values1['discount']=0;$values1['net_amount']=0;
                                    				               $values1['Ad_type']="Free";
                                    				           }
                                    		   
            						            $this->db->insert('tbl_bill_details', $values1);
            						            
            						            	$pcount++;
                                    		    }
            						//echo $this->db->last_query();
            /************* Enter into tbl_bill_details *********************************/
            						$resp=$this->site_model->get_data("tbl_bill_temp_details",['ro_id'=>$ro->ro_id]);
            						$pcount1=1;
            						if(!empty($resp))
            						{
            						foreach($resp as $row){
            						  
                                    		        $query=$this->db->query("select * from tbl_ro_dop where id='".$row['ro_main_id']."'");
                                    		       
                                    		        $result2=$query->row();
                                    		        $dop_amount2=floatval($result2->dop_amount);
            						                  $c_amount=0;
                                    							$p_amount=0;
                                                                $discount=0;
                                    							 $extra_price=floatval($row['erate']);
                                    				            $box_charges=floatval($ro->box_charges);
                                    				            if($row['type_id']==2 || $row['type_id']==3)
                                    				            {
                                    				                 if($size_type=="F")
                                    				                {
                                    				                    	$c_amount+=floatval($row['rate'])*(1);
                                    				                }
                                    				                else
                                    				                {
                                    				               $xx =$ro->size_words;
                                    				            	$word_size=split("X",$xx);
                                    				            	 $len=$word_size[0];
                                    				             	$width=$word_size[1];
                                    				             
                                    				            	$c_amount+=$row['rate']*floatval($len)*floatval($width)*(1);
                                    				                }
                                    				            
                                    				            }
                                    				            else
                                    				            {
                                    				            $c_amount+=floatval($row['rate'])+(floatval($ro->size_words-$ro->min_w)*floatval($row['erate']));
                                    				        	}
                                    				             $prem=explode(",",$ro->premimum);
                                                                 $am=$c_amount;
                                    				            if($prem[1] == 'Rs')
                                    				            {
                                    				                $premimum=($am)+$prem[0];
                                    				            }
                                    				            if($prem[1] == '%')
                                    				            {
                                    				                $premimum=($am*$prem[0])/100;
                                    				            }
                                    				            $dis_per=$ro->dis_per;
                                    				          
                                    				          //  $dis=($c_amount*$dis_per)/100;
                                    				          
                                    				           if($premimum==NULL)
                                    				           {
                                    				           $premimum=0;
                                    				           }
                                    				           
                                    				            $c_amount=$c_amount+$premimum;
                                    				            $dis=($c_amount*$dis_per)/100;
                                    				           //$premimum
                                    				             $p_amount=$c_amount-$dis+$box_charges;
                                    				             $discount=$dis;
                                                				       
                                                				           

            							$table_data=array(
            							    'ro_main_id'=>$row['ro_main_id'],
            								'bill_id'=>$in_id,
            								'ro_id'=>$row['ro_id'],
            								'type_id'=>$row['type_id'],
            								'ro_session'=>$row['work_year'],
            								'insertion'=>$ro->insertion,
            								'pub_date'=>$row['dop'],
            								'paper'=>$row['paper_id'],
            								'heading'=>$heading_main,
            								'pack'=>$ro->pack,
					
            								'scheme'=>$ro->scheme,
            								'premimum'=>$values1['premimum'],
            								'premimum_val'=>$premimum,
            								'word_size'=>$ro->size_words,
            								'rate'=>$row['rate'],
            								'e_rate'=>$row['erate'],
            								'min_w'=>$ro->min_w,
            								'amount'=>$c_amount,
            								'box_charges'=>0,
            								'dis_per'=>$ro->dis_per,
            								'discount'=>$dis,
            								'net_amount'=>$p_amount,
            								'status'=>"Y",
            								'Ad_type'=>"Paid",
            										'size_type'=>$size_type,
            								);
            									               
                                    		      if($pcount1 > $Paid)
                                    				          
                                    				           { $table_data['amount']=0;
                                    				           $table_data['discount']=0;
                                    				               $table_data['net_amount']=0;
                                    				               $table_data['Ad_type']="Free";
                                    				           }
            						
            						
            							$this->db->insert('tbl_bill_details', $table_data);
            							$pcount1++;
            							
            						//	echo $this->db->last_query();
            							$word_size=split("X",$ro->size_words);
            						//	echo $ro->size_words."vv".var_dump($word_size)."</br>".var_dump($table_data);
            						//die;
            					
					}
            						    
            						}
}
					$query=$this->db->query("delete from `tbl_bill_temp_details` where  emp_id='".$_SESSION['admin']['id']."' ");
		$query=$this->db->query("delete from `tbl_bill_temp` where  emp_id='".$_SESSION['admin']['id']."' ");

				
			   
				
				$query=$this->db->query("select DISTINCT ro_id,insertion from tbl_bill_details where bill_id ='".$in_id."'" );
            	$ro_data=$query->result();
            	foreach($ro_data as $bd)
            			{
            			   $result=$this->db->select("*")->where(["id"=>$bd->ro_id])->get("tbl_book_ads")->row();
				           $this->db->where('id',$bd->ro_id);
                          $this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day-$bd->insertion)]);
            			}
				
					
					$query=$this->db->query("select * from tbl_bill_details where bill_id ='".$in_id."'" );
				//	echo $this->db->last_query();
	           
					$bill_data=$query->result();
					foreach($bill_data as $bd){	
					    
					   
                    		
        					$query=$this->db->query("select * from tbl_ro_dop where ro_id ='".$bd->ro_id."' and work_year='".$bd->ro_session."' and paper_id='".$bd->paper."'" );
        				
        				
        					$rem=$query->result();
        					
        					
                                    $dates=explode(",",$bd->pub_date);
        					     
        					        foreach($dates as $dt)
        					        {
        					            
                					          $dd=date_create($dt);
                					            if(isset($dd)) {      
                					          $dt1=date_format($dd,"Y-m-d");
                					          //$dt2=date_format($dd,"m/d/Y");
                					          foreach($rem as $re)
                					          {
                					                    $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='$dt1', bill_status='Y',bill_number='$bill_no' where  `id`=$re->id  and (dop='$dt1')  ");
                		
                					          }
                					            }
        					        
            					        }
        					  
        				
					
					}
			
			   
					$msg="5";
					echo $msg;
					return;					
				}
			}			
		}
	}
// 	public function update_bill11()
// 	{
// 		if (!empty($this->input->post())) 
// 		{
// 			$this->form_validation->set_rules('amount', 'Amount', 'required');			
// 			$this->form_validation->set_rules('net_amount', 'Net Amount', 'required');
// 			$this->form_validation->set_rules('due_day', 'Due Day', 'required');
// 			$this->form_validation->set_rules('total', 'total', 'required');
// 			$this->form_validation->set_rules('client', 'client', 'required');
// 			if ($this->form_validation->run() == FALSE) 
// 			{
// 				$msg="1";
// 				echo $msg;
// 				return;
// 			}
// 			else
// 			{
// 				$tbl_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_bill_temp");
// 				$result=$tbl_bill_temp->result();
// 				//echo $result[0]->bill_id;  die;
// 				if($tbl_bill_temp->num_rows()==0)
// 				{
// 					$msg="2";
// 					echo $msg;
// 					return;
// 				}
// 				else
// 				{
// 					//echo '<pre>'; var_dump($_POST); die;
// 					$days=$this->input->post('due_day')." days";
// 					$date=date_create();
// 					date_add($date,date_interval_create_from_date_string($days));
// 					$due_date=date_format($date,"Y-m-d");
// 					//$bill_no=bill_no_gen();
// 					$values = array(
// 						'work_year'=> $_SESSION['work_year'],
// 						'client_id'=> $this->input->post('client'),
// 						'amount'=> $this->input->post('amount'),
// 						'box_charges'=> $this->input->post('box_c'),
// 						'total'=> $this->input->post('total'),
// 						'dis_per'=> $this->input->post('dis_per'),
// 						'discount'=> $this->input->post('discount'),
// 						'art_work_charges'=> $this->input->post('art_work_charges'),
// 						'other_charges'=> $this->input->post('other_charges'),
// 						'net_amount'=> $this->input->post('net_amount'),
// 						'igst'=> $this->input->post('igst'),
// 						'cgst'=> $this->input->post('cgst'),
// 						'sgst'=> $this->input->post('sgst'),
// 						'bill_date'=> date('Y-m-d'),
// 						'due_date'=> $due_date
// 					);
// 					//echo '<pre>'; var_dump($values); die;
// 					$query = $this->db->where(['id'=>$result[0]->bill_id])->update('tbl_bill', $values);
// 					//echo $this->db->last_query(); return;
// 					//$in_id=$this->db->insert_id();
				
					
// 					$days=array();
// 					foreach($result as $ro){
// 						$values1=array();
// 						//$values1['bill_id']=$result[0]->bill_id;
// 						$values1['ro_id']=$ro->ro_id;
// 						$values1['insertion']=$ro->insertion;
// 						$values1['paper']=$ro->newspaper_id;
// 						$values1['heading']=$ro->cat_id;
// 						$values1['pack']=0;
// 						$values1['scheme']=0;
// 						$values1['premium']=0;
// 						$values1['word_size']=$ro->size_words;
// 						$values1['rate']=$ro->price;
// 						$values1['e_rate']=$ro->eprice;
// 						//$values1['min_w']=$ro->min_w;
// 						$values1['amount']=$ro->amount;
// 						$values1['dis_per']=$ro->dis_per;
// 						$values1['discount']=$ro->discount;
// 						$values1['box_charges']=$ro->box_charges;
// 						//$values1['p_amount']=($ro->amount+$ro->discount);
// 						$values1['status']="Y";
// 						//$days=explode(", ",$ro->p_date);
// 						//foreach($days as $value){
// 						//	$values1['pub_date']=$value;
// 						//	$this->db->insert('tbl_bill_details', $values1);
// 						//}
// 						$values1['pub_date']=$ro->p_date;
// 						//echo "<pre>"; var_dump($values1); die;
// 						$this->db->where(['bill_id'=>$result[0]->bill_id])->update('tbl_bill_details', $values1);
// 						//$this->db->where('id', $values1['ro_id']);
// 						//$this->db->update('tbl_book_ads',['publish_day'=>0]);
// 					}
// 					//$this->db->truncate("tbl_bill_temp");
// 					//var_dump($value1); 
// 					$result=$this->db->select("publish_day")->where(["id"=>$values1['ro_id']])->get("tbl_book_ads")->row();
// 					$this->db->where('id',$values1['ro_id']);
// 					$this->db->update("tbl_book_ads",["publish_day"=>($result->insertion-$values1['insertion'])]);
// 					$result=$this->db->select("bill_dop")->where(["ro_id"=>$values1['ro_id']])->get("tbl_ro_dop")->row();
// 					if($result->bill_dop){
// 						//echo "found";
// 						$this->db->where('ro_id',$values1['ro_id']);
// 						$this->db->update("tbl_ro_dop",["bill_dop"=>$result->bill_dop.", ".$values1['pub_date']]);
// 					}else
// 					{
// 						//echo "not found";
// 						$this->db->where('ro_id',$values1['ro_id']);
// 						$this->db->update("tbl_ro_dop",["bill_dop"=>$values1['pub_date']]);
// 					}
// 					$this->db->truncate("tbl_bill_temp");
// 					$this->db->truncate("tbl_bill_temp_details");
// 					$msg="5";
// 					echo $msg;
// 					return;					
// 				}
// 			}
			
// 		}
// 	}
	
	public function bill_print($id)
	{
		$query = $this->db->query("SELECT tbl_bill.*, c.city, c.client_name,d.* FROM tbl_bill
		INNER JOIN tbl_client c ON c.id=tbl_bill.client_id INNER JOIN tbl_client_details d ON d.uid=tbl_bill.client_id  WHERE tbl_bill.id ='".$id."'" );
		$data['bill']= $query->row();
		
		$amount=number_format((float)$data['bill']->net_amount, 2, '.', '');
		$data['amount_words']=$this->get_words($amount); 
		
		$query = $this->db->get_where('tbl_bill_taxes', array('bill_id' => $id));
		$data['bill_taxes']= $query->result();
		
		$bill_detail = $this->db->query("SELECT tbl_bill_details.*, n.name as newspaper_name,n.short_name,ng.ng_name,ba.type_id,ba.color, p.position,s.scheme_name FROM tbl_bill_details
		INNER JOIN tbl_paper_city pc ON pc.id=tbl_bill_details.paper
		INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
		INNER JOIN tbl_news_group ng ON ng.ng_id=n.g_id
		INNER JOIN tbl_book_ads ba ON ba.id=tbl_bill_details.ro_id
		LEFT JOIN tbl_position p ON p.id=tbl_bill_details.heading
		LEFT JOIN tbl_paper_scheme s ON s.id=tbl_bill_details.scheme
		WHERE tbl_bill_details.bill_id='".$id."'" );
		//LEFT JOIN tbl_premimum pr ON pr.id=tbl_bill_details.premium
        
		//echo $this->db->last_query(); die;
		
        $data['bill_details']=$bill_detail->result();
		//var_dump($data['bill_details']); die;
$posiSQL=$this->db->query("select * from tbl_position");
$posi=$posiSQL->result();
$position=[];
foreach($posi as $pp)
{
    $position[$pp->id]=$pp->position;
    
}
$catSQL=$this->db->query("select * from tbl_position");
$cati=$catSQL->result();
$cat=[];
foreach($cati as $cc)
{
    $cat[$cc->id]=$cc->cat_name;
    
}
$data['cat']=$cat;
$data['position']=$position;

//		$bill_detail = $this->db->query("SELECT tbl_bill_details.*, n.name as newspaper_name,n.short_name,ng.ng_name,ba.type_id,ba.color, p.position,s.scheme_name FROM tbl_bill_details
//		LEFT JOIN tbl_paper_city pc ON pc.id=tbl_bill_details.paper
//		LEFT JOIN tbl_newspapers n ON n.id=pc.paper_id
//		LEFT JOIN tbl_news_group ng ON ng.ng_id=n.g_id
//		LEFT JOIN tbl_book_ads ba ON ba.id=tbl_bill_details.ro_id
//		LEFT JOIN tbl_position p ON p.id=tbl_bill_details.heading
//		LEFT JOIN tbl_paper_scheme s ON s.id=tbl_bill_details.scheme
//		WHERE tbl_bill_details.bill_id='".$id."'" );
//		//LEFT JOIN tbl_premimum pr ON pr.id=tbl_bill_details.premium
//		
//		$data['ro_details']=$bill_detail->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/client_bill_print',$data);
		$this->load->view('admin/footer');
	}	
	
	public function bill_edit($id){
		$query = $this->db->query("SELECT tbl_bill.*, c.city, c.client_name FROM tbl_bill
		INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id ='".$id."'" );
		$data['bill']= $query->row();
		
		$amount=number_format((float)$data['bill']->net_amount, 2, '.', '');
		$data['amount_words']=$this->get_words($amount); 
		
		$query = $this->db->get_where('tbl_bill_taxes', array('bill_id' => $id));
		$data['bill_taxes']= $query->result();
		
		$bill_detail = $this->db->query("SELECT tbl_bill_details.*, n.name as newspaper_name,n.short_name,ng.ng_name,ba.type_id,ba.color, p.position,s.scheme_name,pr.premimum FRom tbl_bill_details
		INNER JOIN tbl_newspapers n ON n.id=tbl_bill_details.paper
		INNER JOIN tbl_news_group ng ON ng.ng_id=n.g_id
		INNER JOIN tbl_book_ads ba ON ba.id=tbl_bill_details.ro_id
		LEFT JOIN tbl_position p ON p.id=tbl_bill_details.heading
		LEFT JOIN tbl_paper_scheme s ON s.id=tbl_bill_details.scheme
		LEFT JOIN tbl_premimum pr ON pr.id=tbl_bill_details.premium
		WHERE tbl_bill_details.bill_id='".$id."' Group by tbl_bill_details.ro_id" );
		
		$bill_details= $bill_detail->result();
		$data['bill_details']=$bill_details;

		$bill_detail = $this->db->query("SELECT tbl_bill_details.*, n.name as newspaper_name,n.short_name,ng.ng_name,ba.type_id,ba.color, p.position,s.scheme_name,pr.premimum FRom tbl_bill_details
		INNER JOIN tbl_newspapers n ON n.id=tbl_bill_details.paper
		INNER JOIN tbl_news_group ng ON ng.ng_id=n.g_id
		INNER JOIN tbl_book_ads ba ON ba.id=tbl_bill_details.ro_id
		LEFT JOIN tbl_position p ON p.id=tbl_bill_details.heading
		LEFT JOIN tbl_paper_scheme s ON s.id=tbl_bill_details.scheme
		LEFT JOIN tbl_premimum pr ON pr.id=tbl_bill_details.premium
		WHERE tbl_bill_details.bill_id='".$id."'" );
		
		$data['ro_details']=$bill_detail->result();
		
			echo $this->db->last_query();
			die;
		$this->load->view('admin/header');
		$this->load->view('admin/client_bill_edit',$data);
		$this->load->view('admin/footer');
	}
	
	
	public function get_words($a)
	{	
		$q = strstr ( $a, '.' );
		$x=0;
		if(!empty($q))
		{
			$x=$q['1'].$q['2'];
		}
		$x=(int)$x;
		$y = floor($a);	
		
		//var_dump($y);
		
		//var_dump($x);
		
		
		$result=$this->convert_number_to_words($y)." Rupees";
		
		if(!empty($a=$this->convert_number_to_words($x)))
			$result=$result." AND ".$a." Paise";
		
		return $result;	
	}
	
	public function get_shared_parties()
	{
	    
	}
	public function convert_number_to_words($number) 
	{

		//$number = 168201.26;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  return $result;		
}

	
	
	public function index123()
	{
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			$users=$this->db->query("SELECT * FROM tbl_client WHERE `client_name` LIKE '%".$name."%' OR `mobile` LIKE '%".$name."%' OR `email` LIKE '%".$name."%' ORDER BY id DESC");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/client_bill/index";
			$config["total_rows"] = $users->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['users']= $users->result();
		}
		else
		{
			$users = $this->db->query("SELECT * FROM tbl_client order by id desc" );
			$config = array();
			$config["base_url"] = base_url() . "admin/client_bill/index";
			$config["total_rows"] = $users->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
			$users=$this->db->query("SELECT * FROM tbl_client ORDER BY id DESC limit {$config['per_page']} offset {$page}");
			
			$data['users']= $users->result();
		}
				
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;      
		$data['offset'] = $page ;
		$data["total_rows"] = $users->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/client_bill',$data);
		$this->load->view('admin/footer');
	}
	
	public function del($ro_id,$bill_id)
	{
		$in_id=$bill_id;
	 
	  if(!empty($in_id))
	  {
	      //query to add insertions back into the tbl_book_ads//
	      	$query=$this->db->query("select * from tbl_bill_details where bill_id ='".$in_id."' and ro_id='$ro_id'" );
            						$ro_data=$query->result();
            						$insertion=$ro_data[0]->insertion();
            					
            					   $result=$this->db->select("*")->where(["id"=>$ro_id])->get("tbl_book_ads")->row();
						            $this->db->where('id',$ro_id);
                    	            $this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day+$insertion)]);
            						
	      
	      	
	   foreach($ro_data as $rod)
	   {
				    
     $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='', bill_status='N',bill_number='0' where  `id`=$rod->ro_main_id ");
                		
                					         
		}
	 
	  
	
         $this->db->query("delete from tbl_bill_details where ro_id ='".$ro_id."' and bill_id ='".$in_id."' " );

        }
       
	}
	
	public function remove_ro()
	{
	    $ro_id=$this->input->post('ro_id');
	     $work_year=$this->input->post('work_year');
	     $emp_id=$this->input->post('emp_id');
	 if($this->db->query("delete from `tbl_bill_temp` where ro_id='".$ro_id."' and  emp_id='".$_SESSION['admin']['id']."'  "))
	 {
	     $this->db->query("delete from `tbl_bill_temp_details` where  ro_id='".$ro_id."' and emp_id='".$_SESSION['admin']['id']."'  ");
	     echo "delete from `tbl_bill_temp` where ro_id='".$ro_id."' and  emp_id='".$_SESSION['admin']['id']."'  ";
	     return;
	 }
	else
	{$this->db->query("delete from `tbl_bill_temp_details` where  ro_id='".$ro_id."' and emp_id='".$_SESSION['admin']['id']."'  ");
	    echo "Failure";
	    return;
	}
		
	}
	public function del_bill($bill_id)
	{
		//echo "hi";
		 $in_id=$bill_id;
		 echo $in_id;
	
	  if(!empty($in_id))
	  {
	      //query to add insertions back into the tbl_book_ads//
	      	$query=$this->db->query("select DISTINCT ro_id,insertion from tbl_bill_details where bill_id ='".$in_id."'" );
	      	echo $this->db->last_query();
            						$ro_data=$query->result();
            						foreach($ro_data as $bd)
            						{
            					   $result=$this->db->select("*")->where(["id"=>$bd->ro_id])->get("tbl_book_ads")->row();
            					   echo $this->db->last_query();
						            $this->db->where('id',$bd->ro_id);
                    	            $this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day+$bd->insertion)]);
                    	            echo $this->db->last_query();
            						}
	      
	      	$query=$this->db->query("select * from tbl_bill where id ='".$in_id."'" );
	      	echo $this->db->last_query();
	      	$res=$query->result();
	      	echo var_dump($res);
	      	foreach ($res as $key => $value) {
	      		$bill_no=$value->bill_no;
	      	}
	      	
	      	$this->db->query("delete from tbl_vouchers where screen_id='".$bill_no."'");
	      	echo $this->db->last_query();
				// qurey to change status of ros//
	           $query=$this->db->query("select * from tbl_bill_details where bill_id ='".$in_id."'" );
	           echo $this->db->last_query();
				$bill_data=$query->result();
		    	foreach($bill_data as $bd)
		    	{	
		    	    $query=$this->db->query("select * from tbl_ro_dop where ro_id ='".$bd->ro_id."'  and paper_id='".$bd->paper."'" );
		    	    echo $this->db->last_query();
        	        	$rem=$query->result();
        					
        					
                                    $dates=explode(",",$bd->pub_date);
        					     
        					        foreach($dates as $dt)
        					        {
                					          $dd=date_create($dt);
                					          if(isset($dd)){
                					          $dt1=date_format($dd,"Y-m-d");
                					          $dt2=date_format($dd,"Y-m-d");
                					          foreach($rem as $re)
                					          {
                					                    $this->db->query("UPDATE `tbl_ro_dop` set `bill_dop`='', bill_status='N',bill_number='0' where  `id`=$re->id  and (dop='".$dt1."' OR dop='".$dt2."')  ");
                	                            //	echo $this->db->last_query();
                					          }
        					                }
        					        
            					        }
        		}
        		$this->db->query("delete from tbl_bill where id='".$bill_id."'");
        		echo $this->db->last_query();
        		$this->db->query("delete from tbl_bill_details where bill_id='".$bill_id."'");
        		echo $this->db->last_query();
	 
	  
	echo $this->session->flashdata('Deleted');
        redirect('admin/client_bill/') ;

        }
        else
        {echo $this->session->flashdata('Not Deleted');
        	redirect('admin/client_bill/');
        }
       
	}
	
}
?>