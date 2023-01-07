<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm_bill extends CI_Controller
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
			$query = $this->db->query("SELECT tbl_bill.*, c.client_name FROM tbl_bill
			INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id LIKE '%".$name."%' OR c.client_name LIKE '%".$name."%'and tbl_bill.type='FM'");
			$config["base_url"] = base_url() . "admin/fm_bill/index";
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
			INNER JOIN tbl_client c ON c.id=tbl_bill.client_id ");
			$config["base_url"] = base_url(). "admin/fm_bill/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$query = $this->db->query("SELECT tbl_bill.*, c.client_name FROM tbl_bill
			INNER JOIN tbl_client c ON c.id=tbl_bill.client_id and tbl_bill.type='FM' order by tbl_bill.id desc limit {$config['per_page']} offset {$page}");
			$data['bills']= $query->result();
		}		
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/fm_bill_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function get_ros()
	{
		//$this->db->truncate("tbl_bill_temp");
	//	$this->db->truncate("tbl_bill_temp_details");
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
				$date_t=date_create($this->input->post('date_t'));			
				$date_t1=date_format($date_t,"Y-m-d");			
				//$date_d=$this->input->post('date_t');
				$client=$this->input->post('client');
			
				$query =$this->db->query("Select tbl_fm_ro.*, d.`date_from`, d.`date_to`, d.`total_day`,d. `slot_dur`, d.`day_times`, d.`total_sec`, d.`rate_per_10`, d.`rate_one`, d.`com1`, d.`com2`, d.`material`, d.`amount`, d.`tax`, d.total_com as tcom,d.tax_a as txa,d.pay_amount as pmt from tbl_fm_ro inner join tbl_fm_ro_details as d on d.ro_no=tbl_fm_ro.ro_no  where tbl_fm_ro.c_id=	'".$client."' and tbl_fm_ro.ro_date<='$date_t1'   and tbl_fm_ro.bill_status='N'" );
			
		
			//	echo $this->db->last_query(); 
				//die;
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
		//	$this->db->truncate("tbl_bill_temp");
		//	$this->db->truncate("tbl_bill_temp_details");
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
			
			// $query = $this->db->get('tbl_tax');
			// $data['taxs']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/fm_bill',$data);
			$this->load->view('admin/footer');
		
	}
	
	
	public function edit($id)
	{
		
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();

			

			$query = $this->db->where(["bill_no"=>$id])->get('tbl_bill');
			$data['bill']= $query->result()[0];
			
			
			$query = $this->db->query("SELECT * from  tbl_fm_ro WHERE c_id='".$data['bill']->client_id."' and ro_date >'0' and bill_status='N'");
            //echo $this->db->last_query();
            if(!empty($query->result()))
                {
                			$data['unbilled_ros']= $query->result();
                }
	
			
			$query=$this->db->query("select tbl_fm_ro.*,b.client_id as client_id,c.ng_name as newspaper_name,e.name as cat_name from tbl_fm_ro INNER JOIN tbl_fm_ro_details as d on d.ro_no=tbl_fm_ro.ro_no INNER JOIN tbl_bill as b on b.bill_no=tbl_fm_ro.bill_number INNER JOIN tbl_fm_group as c on c.ng_id=tbl_fm_ro.g_id INNER JOIN tbl_fm_channels as e on e.id = tbl_fm_ro.fmc_id where tbl_fm_ro.bill_number='$id'");
	
		//echo $this->db->last_query();
			$data['bill_details']=$query->result();
		//	echo '<pre>'; var_dump($data['bill_details']);

		foreach($data['bill_details'] as $row){
			$values=array(
					'bill_id'=>$row->bill_id,
					'ro_id'=>$row->ro_id,
					'client_id'=>$row->client_id,
					'newspaper_id'=>$row->paper,
					'cat_id'=>$row->heading,
					'size_words'=>$row->word_size,
					'min_w'=>$row->min_w,
					'insertion'=>$row->insertion,
					'p_date'=>$row->pub_date,
					'price'=>$row->rate,
					'eprice'=>$row->e_rate,
					'amount'=>$row->amount,
					'premimum'=>$row->premimum,
					'extra_price'=>(($row->word_size-$row->min_w)*$row->e_rate)*$row->insertion,
					'add_on_amount'=>$row->add_on_amount,
					'dis_per'=>$row->dis_per,
					'discount'=>$row->discount,
					'height'=>$row->height,
					'width'=>$row->width,
					'box_charges'=>$row->box_charges,
					'payable_amount'=>($row->amount+$row->box_charges+((($row->word_size-$row->min_w)*$row->e_rate)*$row->insertion))-$row->discount
				);
				//echo '<pre>'; var_dump($values); die;
			//	$this->temp_save($values);
			}
//die;
		//$result=$this->db->get("tbl_bill_temp");
	/*	$this->db->select('tbl_bill_temp.*,tbl_client.client_name as client_name,tbl_newspapers.name as newspaper_title,tbl_categories.name as cat_title');
		$this->db->from('tbl_bill_temp');
		$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_temp.newspaper_id');
		$this->db->join('tbl_client', 'tbl_client.id = tbl_bill_temp.client_id');
		$this->db->join('tbl_categories', 'tbl_categories.id = tbl_bill_temp.cat_id');

		$result = $this->db->get();
		$data['temp_details']=($result->result()); */
		//echo '<pre>'; var_dump($data['temp_details']); return;	

		$this->load->view('admin/header');
		$this->load->view('admin/fm_bill_edit',$data);
		$this->load->view('admin/footer');		
	}





		
	public function temp_save($data)
	{
		//echo '<pre>'; var_dump($data); die;
		$query = $this->db->where(['ro_id'=>$data['ro_id']])->get('tbl_bill_temp');
		if($query->num_rows()){
			//echo "exists"; return;
			$values = array(
				'ro_id'=>$data['ro_id'],
				'bill_id'=>$data['bill_id'],
				'client_id' => $data['client_id'],
				//'emp_id' => $data['emp_id'],
				'newspaper_id' =>$data['newspaper_id'],
				'cat_id' =>$data['cat_id'],
				'insertion' => $data['insertion'],
				'p_date' => $data['p_date'],
				'size_words' => $data['size_words'],
				'min_w' => $data['min_w'],
				'price' => $data['price'],
				'eprice' => $data['eprice'],
				'height' => $data['height'],
				'width' => $data['width'],
				'amount' =>$data['amount'] ,
				'premimum' =>$data['premimum'] ,
				'extra_price' => $data['extra_price'],
				'add_on_amount' => $data['add_on_amount'],
				'dis_per' => $data['dis_per'],
				'discount' => $data['discount'],
				'box_charges' => $data['box_charges'],
				'payable_amount' => $data['payable_amount']
			);		

			$this->db->where(["ro_no"=>$data['ro_no']])->update('tbl_bill_temp',$values);
			
		}
		else{
			$values = array(
				'bill_id'=>$data['bill_id'],
				'ro_id'=>$data['ro_id'],
				'client_id' => $data['client_id'],
				//'emp_id' => $data['emp_id'],
				'newspaper_id' =>$data['newspaper_id'],
				'cat_id' =>$data['cat_id'],
				'insertion' => $data['insertion'],
				'p_date' => $data['p_date'],
				'size_words' => $data['size_words'],
				'min_w' => $data['min_w'],
				'price' => $data['price'],
				'eprice' => $data['eprice'],
				'height' => $data['height'],
				'width' => $data['width'],
				'amount' =>$data['amount'] ,
				'premimum' =>$data['premimum'] ,
				'extra_price' => $data['extra_price'],
				'add_on_amount' => $data['add_on_amount'],
				'dis_per' => $data['dis_per'],
				'discount' => $data['discount'],
				'box_charges' => $data['box_charges'],
				'payable_amount' => $data['payable_amount']
			);							
			$this-> db->insert('tbl_bill_temp', $values);
			
		}
		//var_dump($this->db->last_query()); die;
		//echo '<pre>'; var_dump($_POST); return;				
	}





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
				INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."'");
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
			INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."'");
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
					//$date=date_create();
					//date_add($date,date_interval_create_from_date_string($days));
					//$due_date=date_format($date,"Y-m-d");
					$bill_no=bill_no_gen();
                                    
                    
					$values = array(
						'bill_no'=>$bill_no,
						'work_year'=> $this->session->userdata('amsons_wy')['year'],
						'client_id'=> $this->input->post('client'),
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
						'due_date'=> $due_date
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('amount')-$this->input->post('discount')+$this->input->post('igst')+$this->input->post('sgst')+$this->input->post('cgst')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Bill generated for ".$client_name."No: ".$in_id,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>8,
						'ledger_id'=>12,
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('discount'),
						'narration'=>"Discount generated for ".$ledger_name." Bill No: ".$in_id,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>6,
						'ledger_id'=>9,
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'cr',
						'amount'=>$this->input->post('total')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Advertisement Income on Bill No: ".$in_id,
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'cr',
						'amount'=>$this->input->post('igst'),
						'narration'=>"IGST on Bill No: ".$in_id,
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('cgst'),
						'narration'=>"CGST on Bill No: ".$in_id,
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('sgst'),
						'narration'=>"UGST on Bill No: ".$in_id,
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

					$days=array();
					foreach($result as $ro){
						$values1=array();
						$values1['bill_id']=$in_id;
						$values1['ro_id']=$ro->ro_id;
						$values1['insertion']=$ro->insertion;
						$values1['paper']=$ro->newspaper_id;
						$values1['heading']=$ro->cat_id;
						$values1['pack']=0;
						$values1['scheme']=0;
						$values1['premimum']=$ro->premimum;
						$values1['word_size']=$ro->size_words;
						$values1['rate']=$ro->price;
						$values1['e_rate']=$ro->eprice;
						$values1['min_w']=$ro->min_w;
						$values1['amount']=$ro->amount;
						$values1['dis_per']=$ro->dis_per;
                        $premimum=explode(",",$ro->premimum);                       
                        if($premimum[0]){
                            $amt=($ro->price+(($ro->size_words-$ro->min_w)*$ro->eprice));
                            $pre=$amt*$premimum[0]/100;
                            $values1['discount']=($amt+$pre)*$ro->dis_per/100;
                        }else{
                            $amt=($ro->price+(($ro->size_words-$ro->min_w)*$ro->eprice));
                            $values1['discount']=$amt*$ro->dis_per/100;
                        }
						
						$values1['box_charges']=$ro->box_charges;
						//$values1['p_amount']=($ro->amount+$ro->discount);
						$values1['status']="Y";
						//$days=explode(", ",$ro->p_date);
						//foreach($days as $value){
						//$values1['pub_date']=$value;
						//$this->db->insert('tbl_bill_details', $values1);
						//}
						$values1['pub_date']=$ro->p_date;
						$this->db->insert('tbl_bill_details', $values1);
						//echo $this->db->last_query();

						$resp=$this->site_model->get_data("tbl_bill_temp_details",['ro_id'=>$ro->ro_id]);
						foreach($resp as $row){
							$amount=0;
							$discount=0;
							if($row['rate']>0){
								$amount=$row['rate']*$row['insertion'];
								$discount=($row['rate']+(($values1['word_size']-$values1['min_w'])*$row['erate']))*$values1['dis_per']/100;
                                
							}
							
							$table_data=array(
								'bill_id'=>$in_id,
								'ro_id'=>$row['ro_id'],
								'insertion'=>$row['insertion'],
								'pub_date'=>$row['dop'],
								'paper'=>$row['paper_id'],
								'heading'=>0,
								'pack'=>0,
								'scheme'=>0,
								'premimum'=>$values1['premimum'],
								'word_size'=>$ro->size_words,
								'rate'=>$row['rate'],
								'e_rate'=>$row['erate'],
								'min_w'=>$ro->min_w,
								'amount'=>$amount,
								'box_charges'=>0,
								'dis_per'=>$ro->dis_per,
								'discount'=>$discount,
								'status'=>"Y");
							$this->db->insert('tbl_bill_details', $table_data);
							//echo $this->db->last_query(); //return;
						}
						//$this->db->where('id', $values1['ro_id']);
						//$this->db->update('tbl_book_ads',['publish_day'=>0]);
					}

					$this->db->truncate("tbl_bill_temp");
					$this->db->truncate("tbl_bill_temp_details");
				//	var_dump($value1); 
					$result=$this->db->select("publish_day")->where(["id"=>$values1['ro_id']])->get("tbl_book_ads")->row();
					$this->db->where('id',$values1['ro_id']);
					$this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day-$values1['insertion'])]);
					$result=$this->db->select("bill_dop")->where(["ro_id"=>$values1['ro_id']])->get("tbl_ro_dop")->row();
					if($result->bill_dop){
						//echo "found";
						$this->db->where('ro_id',$values1['ro_id']);
						$this->db->update("tbl_ro_dop",["bill_dop"=>$result->bill_dop.", ".$values1['pub_date']]);
					}else
					{
						//echo "not found";
						$this->db->where('ro_id',$values1['ro_id']);
						$this->db->update("tbl_ro_dop",["bill_dop"=>$values1['pub_date']]);
					}
					$msg="5";
					echo $msg;
					return;					
				}
			}			
		}
	}
	public function fm_save_bill()
	{
		if (!empty($this->input->post())) 
		{
			//$this->form_validation->set_rules('amount', 'Amount', 'required');			
			$this->form_validation->set_rules('net_amount', 'Net Amount', 'required');
		//	$this->form_validation->set_rules('due_day', 'Due Day', 'required');
	//		$this->form_validation->set_rules('total', 'total', 'required');
			$this->form_validation->set_rules('client', 'client', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
			/*	$tbl_fm_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_fm_bill_temp");
				if($tbl_fm_bill_temp->num_rows()==0)
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{*/
				$ro_no=$this->input->post('ro_no');
			
				
					$this->load->model("site_model");
					$res=$this->site_model->get_data("tbl_client",['id'=>$this->input->post('client')])[0];
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
						'work_year'=> $this->session->userdata('amsons_wy')['year'],
						'client_id'=> $this->input->post('client'),
						'type'=>'FM',
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
						'due_date'=> $due_date
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('amount')-$this->input->post('discount')+$this->input->post('igst')+$this->input->post('sgst')+$this->input->post('cgst')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Bill generated for ".$client_name."No: ".$in_id,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>8,
						'ledger_id'=>12,
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('discount'),
						'narration'=>"Discount generated for ".$ledger_name." Bill No: ".$in_id,
						'voucher_no'=>1,
						'screen'=>"Client Bill",
						'screen_id'=>$in_id,
						'voucher_session'=>1
					);
					$this->site_model->insert_data('tbl_vouchers', $values); 
				//	echo $this->db->last_query(); 

					$values = array(
						'group_id'=>6,
						'ledger_id'=>9,
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'cr',
						'amount'=>$this->input->post('total')+$this->input->post('box_c')+$this->input->post('at_w')+$this->input->post('other_c'),
						'narration'=>"Advertisement Income on Bill No: ".$in_id,
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'cr',
						'amount'=>$this->input->post('igst'),
						'narration'=>"IGST on Bill No: ".$in_id,
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('cgst'),
						'narration'=>"CGST on Bill No: ".$in_id,
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
						'voucher_date'=> date("Y-m-d H:i:s"),
						'entry_type'=>'dr',
						'amount'=>$this->input->post('sgst'),
						'narration'=>"UGST on Bill No: ".$in_id,
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
				/*	$result=$tbl_bill_temp->result();
					$bill_detail=array();
					$c=0;

					$days=array();
					foreach($result as $ro){
						$values1=array();
						$values1['bill_id']=$in_id;
						$values1['ro_id']=$ro->ro_id;
						$values1['insertion']=$ro->insertion;
						$values1['paper']=$ro->newspaper_id;
						$values1['heading']=$ro->cat_id;
						$values1['pack']=0;
						$values1['scheme']=0;
						$values1['premimum']=$ro->premimum;
						$values1['word_size']=$ro->size_words;
						$values1['rate']=$ro->price;
						$values1['e_rate']=$ro->eprice;
						$values1['min_w']=$ro->min_w;
						$values1['amount']=$ro->amount;
						$values1['dis_per']=$ro->dis_per;
                        $premimum=explode(",",$ro->premimum);                       
                        if($premimum[0]){
                            $amt=($ro->price+(($ro->size_words-$ro->min_w)*$ro->eprice));
                            $pre=$amt*$premimum[0]/100;
                            $values1['discount']=($amt+$pre)*$ro->dis_per/100;
                        }else{
                            $amt=($ro->price+(($ro->size_words-$ro->min_w)*$ro->eprice));
                            $values1['discount']=$amt*$ro->dis_per/100;
                        }
						
						$values1['box_charges']=$ro->box_charges;*/
						//$values1['p_amount']=($ro->amount+$ro->discount);
						
						//$days=explode(", ",$ro->p_date);
						//foreach($days as $value){
						//$values1['pub_date']=$value;
						//$this->db->insert('tbl_bill_details', $values1);
						//}
					//	$values1['pub_date']=$ro->p_date;
					$values1['bill_status']="Y";
					$values1['bill_number']=$bill_no;
						$values1['bill_date']=$bill_date;
							foreach($ro_no as $ro)
				{
			
						$this->db->where('ro_no',$ro["ro_no"]);
						$this->db->update('tbl_fm_ro', $values1);
						
				}
						//echo $this->db->last_query();

					/*	$resp=$this->site_model->get_data("tbl_bill_temp_details",['ro_id'=>$ro->ro_id]);
						foreach($resp as $row){
							$amount=0;
							$discount=0;
							if($row['rate']>0){
								$amount=$row['rate']*$row['insertion'];
								$discount=($row['rate']+(($values1['word_size']-$values1['min_w'])*$row['erate']))*$values1['dis_per']/100;
                                
							}
							
							$table_data=array(
								'bill_id'=>$in_id,
								'ro_id'=>$row['ro_id'],
								'insertion'=>$row['insertion'],
								'pub_date'=>$row['dop'],
								'paper'=>$row['paper_id'],
								'heading'=>0,
								'pack'=>0,
								'scheme'=>0,
								'premimum'=>$values1['premimum'],
								'word_size'=>$ro->size_words,
								'rate'=>$row['rate'],
								'e_rate'=>$row['erate'],
								'min_w'=>$ro->min_w,
								'amount'=>$amount,
								'box_charges'=>0,
								'dis_per'=>$ro->dis_per,
								'discount'=>$discount,
								'status'=>"Y");
							$this->db->insert('tbl_bill_details', $table_data);
							//echo $this->db->last_query(); //return;
						}
						//$this->db->where('id', $values1['ro_id']);
						//$this->db->update('tbl_book_ads',['publish_day'=>0]);
					}
*/
					//$this->db->truncate("tbl_bill_temp");
				//	$this->db->truncate("tbl_bill_temp_details");
				//	var_dump($value1); 
				/*	$result=$this->db->select("publish_day")->where(["id"=>$values1['ro_id']])->get("tbl_book_ads")->row();
					$this->db->where('id',$values1['ro_id']);
					$this->db->update("tbl_book_ads",["publish_day"=>($result->publish_day-$values1['insertion'])]);
					$result=$this->db->select("bill_dop")->where(["ro_id"=>$values1['ro_id']])->get("tbl_ro_dop")->row();
					if($result->bill_dop){
						
						$this->db->where('ro_id',$values1['ro_id']);
						$this->db->update("tbl_ro_dop",["bill_dop"=>$result->bill_dop.", ".$values1['pub_date']]);
					}else
					{
					
						$this->db->where('ro_id',$values1['ro_id']);
						$this->db->update("tbl_ro_dop",["bill_dop"=>$values1['pub_date']]);
					}*/
					$msg="5";
					echo $msg;
					return;					
				//}
			}			
		}
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
				$tbl_bill_temp=$this->db->where(['client_id'=>$this->input->post('client')])->get("tbl_bill_temp");
				$result=$tbl_bill_temp->result();
				//echo $result[0]->bill_id;  die;
				if($tbl_bill_temp->num_rows()==0)
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{
					//echo '<pre>'; var_dump($_POST); die;
					$days=$this->input->post('due_day')." days";
					$date=date_create();
					date_add($date,date_interval_create_from_date_string($days));
					$due_date=date_format($date,"Y-m-d");
					//$bill_no=bill_no_gen();
					$values = array(
						'work_year'=> $this->session->userdata('amsons_wy')['year'],
						'client_id'=> $this->input->post('client'),
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
						'bill_date'=> date('Y-m-d'),
						'due_date'=> $due_date
					);
					//echo '<pre>'; var_dump($values); die;
					$query = $this->db->where(['id'=>$result[0]->bill_id])->update('tbl_bill', $values);
					//echo $this->db->last_query(); return;
					//$in_id=$this->db->insert_id();
				
					
					$days=array();
					foreach($result as $ro){
						$values1=array();
						//$values1['bill_id']=$result[0]->bill_id;
						$values1['ro_id']=$ro->ro_id;
						$values1['insertion']=$ro->insertion;
						$values1['paper']=$ro->newspaper_id;
						$values1['heading']=$ro->cat_id;
						$values1['pack']=0;
						$values1['scheme']=0;
						$values1['premium']=0;
						$values1['word_size']=$ro->size_words;
						$values1['rate']=$ro->price;
						$values1['e_rate']=$ro->eprice;
						//$values1['min_w']=$ro->min_w;
						$values1['amount']=$ro->amount;
						$values1['dis_per']=$ro->dis_per;
						$values1['discount']=$ro->discount;
						$values1['box_charges']=$ro->box_charges;
						//$values1['p_amount']=($ro->amount+$ro->discount);
						$values1['status']="Y";
						//$days=explode(", ",$ro->p_date);
						//foreach($days as $value){
						//	$values1['pub_date']=$value;
						//	$this->db->insert('tbl_bill_details', $values1);
						//}
						$values1['pub_date']=$ro->p_date;
						//echo "<pre>"; var_dump($values1); die;
						$this->db->where(['bill_id'=>$result[0]->bill_id])->update('tbl_bill_details', $values1);
						//$this->db->where('id', $values1['ro_id']);
						//$this->db->update('tbl_book_ads',['publish_day'=>0]);
					}
					//$this->db->truncate("tbl_bill_temp");
					//var_dump($value1); 
					$result=$this->db->select("publish_day")->where(["id"=>$values1['ro_id']])->get("tbl_book_ads")->row();
					$this->db->where('id',$values1['ro_id']);
					$this->db->update("tbl_book_ads",["publish_day"=>($result->insertion-$values1['insertion'])]);
					$result=$this->db->select("bill_dop")->where(["ro_id"=>$values1['ro_id']])->get("tbl_ro_dop")->row();
					if($result->bill_dop){
						//echo "found";
						$this->db->where('ro_id',$values1['ro_id']);
						$this->db->update("tbl_ro_dop",["bill_dop"=>$result->bill_dop.", ".$values1['pub_date']]);
					}else
					{
						//echo "not found";
						$this->db->where('ro_id',$values1['ro_id']);
						$this->db->update("tbl_ro_dop",["bill_dop"=>$values1['pub_date']]);
					}
					$this->db->truncate("tbl_bill_temp");
					$this->db->truncate("tbl_bill_temp_details");
					$msg="5";
					echo $msg;
					return;					
				}
			}
			
		}
	}
	
	public function bill_print($id)
	{
		$query = $this->db->query("SELECT tbl_bill.*, c.city, c.client_name FROM tbl_bill
		INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id ='".$id."'" );
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
		INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id ='".$id."' and type='FM'" );
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
		
		$this->load->view('admin/header');
		$this->load->view('admin/fm_bill_edit',$data);
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
	
}
?>