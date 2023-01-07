<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm_ro extends CI_Controller
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
			$book_ro=$this->db->query("SELECT tbl_fm_ro.*, c.name as channel_name, g.ng_name as group_name, cl.client_name as client_name FROM tbl_fm_ro
INNER JOIN tbl_fm_channels c ON c.id=tbl_fm_ro.fmc_id
INNER JOIN tbl_fm_group g ON g.ng_id=tbl_fm_ro.g_id
INNER JOIN tbl_fm_ro_details d ON d.ro_no=tbl_fm_ro.ro_no
INNER JOIN tbl_client cl ON cl.id=tbl_fm_ro.c_id WHERE tbl_fm_ro.heading LIKE '%".$name."%' OR cl.name LIKE '%".$name."%' OR g.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%' ORDER BY id DESC");
			
			
			$config["base_url"] = base_url() . "admin/fm_ro/index";
			$config["total_rows"] = $book_ro->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['book_ros']= $book_ro->result();
		}
		else
		{
			$book_ro = $this->db->query("SELECT tbl_fm_ro.*, c.name as channel_name, g.ng_name as group_name, cl.client_name as client_name FROM tbl_fm_ro
INNER JOIN tbl_fm_channels c ON c.id=tbl_fm_ro.fmc_id
INNER JOIN tbl_fm_group g ON g.ng_id=tbl_fm_ro.g_id

INNER JOIN tbl_client cl ON cl.id=tbl_fm_ro.c_id order by tbl_fm_ro.id desc" );
			
			$config["base_url"] = base_url(). "admin/fm_ro/index";
			$config["total_rows"] = $book_ro->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
			$book_ro=$this->db->query("SELECT tbl_fm_ro.*, c.name as channel_name, g.ng_name as group_name, cl.client_name as client_name FROM tbl_fm_ro
INNER JOIN tbl_fm_channels c ON c.id=tbl_fm_ro.fmc_id

INNER JOIN tbl_fm_group g ON g.ng_id=tbl_fm_ro.g_id
INNER JOIN tbl_client cl ON cl.id=tbl_fm_ro.c_id order by tbl_fm_ro.id desc limit {$config['per_page']} offset {$page}");
			
			$data['book_ros']= $book_ro->result();
		}
		
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $book_ro->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/fm_ro_list',$data);
		$this->load->view('admin/footer');
	}
	
	
	public function add()
	{
					if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('fm_group', 'FM Group', 'required');
$this->form_validation->set_rules('fmc', 'FM Channels', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('date_f', 'Date From', 'required');
			$this->form_validation->set_rules('date_t', 'Date To', 'required');
			$this->form_validation->set_rules('total', 'Total', 'required');
			$this->form_validation->set_rules('net_a', 'NET Amount', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_fm_group');
				$data['fm_groups']= $query->result();
									
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
			
				$query = $this->db->get('tbl_tax');
				$data['taxs']= $query->result();
						
				$this->load->view('admin/header');
				$this->load->view('admin/fm_ro_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{	$this->load->model("ro_model");
            $ro_no=$this->ro_model->gen_ro_no("NP",$_SESSION['work_year']);
				$values = array(
								'ro_date' => $this->input->post('ro_date'),
								'ro_no'=>$ro_no,
								'work_year'=>$this->session->userdata('amsons_wy')['year'],
								'g_id' => $this->input->post('fm_group'),
								'fmc_id' => $this->input->post('fmc'),
								'city' => $this->input->post('city'),
								'c_id' => $this->input->post('client'),
								'heading' => $this->input->post('heading'),
								'remark' => $this->input->post('remarks'),
								'date_from' => $this->input->post('date_f'),
								'date_to' => $this->input->post('date_t'),
								'total_day' => $this->input->post('day'),
								'slot_dur' => $this->input->post('sd'),
								'day_times' => $this->input->post('day_times'),
								'total_sec' => $this->input->post('ts'),
								'rate_per_10' => $this->input->post('rp10'),
								'rate_one' => $this->input->post('slot_rate'),
								'material' => $this->input->post('matter'),
								'amount' => $this->input->post('total'),
								'com1' => $this->input->post('comm1'),
								'com2' => $this->input->post('comm2'),
								'total_com' => $this->input->post('comm_a'),
								'tax' => $this->input->post('tax'),
								'tax_a' =>$this->input->post('tax_a'),
								'pay_amount' => $this->input->post('net_a'),
								'c_date' =>date('Y-m-d H:i:s')
							);
				$query = $this-> db->insert('tbl_fm_ro', $values);
				$this->session->set_flashdata('msg', 'FM Ro book Successfully');
				redirect('admin/fm_ro');
			}
		}
		else
		{
			$query = $this->db->get('tbl_fm_group');
			$data['fm_groups']= $query->result();
									
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();

            $this->db->where('tax_type','fm');
			$query = $this->db->get('tbl_tax');
			$data['taxs']= $query->result();
			
			//echo json_encode($data);
			//die;
			$this->load->view('admin/header');
			$this->load->view('admin/fm_ro_add',$data);
			$this->load->view('admin/footer');
	//	}
	}
	}
	public function get_channels()
	{
		$id=$_POST['fmg_id'];
		
		$query = $this->db->get_where('tbl_fm_channels', array('g_id' => $id));
		$fmc= $query->result();
		
		echo json_encode($fmc);
	}
	
	public function get_city()
	{
		$id=$_POST['fmc_id'];
		
		$query = $this->db->get_where('tbl_fm_channels', array('id' => $id));
		$fmc= $query->row();						
		$cities=explode(",",$fmc->city);
		
		$city = new stdClass();
		foreach ($cities as $key => $value)
		{
			$city->$key = $value;
		}
		
		echo json_encode($city);
	}
	
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{
		    $ro_no=$_POST['ro_no'];
		     $g_id = $_POST["fm_group1"];
        $fmc_id = $_POST["fmc"];
		$city = $_POST["city"];
		$c_id = $_POST["client"];
		$ro_date  = date_create($_POST["ro_date"]);
		$heading = $_POST["heading"];
		$remark = $_POST["remarks"];
	    $comm_a = $_POST["comm_amount"];
       $tax_total= $_POST["total_tax"];
       $t_amount =$_POST["t_amount"];
       $p_amount=$_POST["net_amount"];
	     $date_from=$_POST['date_f_1'];	
	    $date_to=$_POST['date_t_1'];	
		     $total_day=$_POST['day_1'];	
		      $slot_dur=$_POST['sd_1'];	
		       $day_times=$_POST['day_times_1'];	
		        $total_sec=$_POST['ts_1'];	
		         $rate_per_10=$_POST['rp10_1'];	
		          $rate_one=$_POST['slot_rate_1'];	
		           $material=$_POST['matter_1'];	
		            $tamount=$_POST['total_1'];	
		             $com1=$_POST['com1'];	
		             $com2=$_POST['com2'];
		             $total_com=$_POST['com_a'];
		             $tax=$_POST['tax_1'];
		             $tax_a=$_POST['taxa'];
		             $pay_amount=$_POST['neta'];
		           	
		 	$values = array(
								//'ro_date' => date_format($ro_date,"Y-m-d"),
						    	//'ro_no'=>$ro_no,
								//'work_year'=>$this->session->userdata('amsons_wy')['year'],
								'g_id' =>$g_id ,
								'fmc_id' => $fmc_id,
								'city' => $city,
								'c_id' => $c_id,
								'heading' => $heading,
								'remark' => $remark,
								't_amount' => $t_amount,
								'com1' => 0,
								'com2' => 0,
								'total_com' => $comm_a,
								'tax' => 0,
								'tax_a' =>$tax_total,
								'pay_amount' => $p_amount,
								'bill_status'=>'N',
								'c_date' =>date('Y-m-d H:i:s')
							);
						
							$this->db->update('tbl_fm_ro',$values, "id =".$id);
							
							$this->db->query("delete from tbl_fm_ro_details WHERE ro_no='$ro_no'");
							
							for($i=0;$i<count($date_from);$i++)
							{
                                $values1=array(
                                        'ro_date' => date_format($ro_date,"Y-m-d"),
        						    	'ro_no'=>$ro_no,
        								'work_year'=>$this->session->userdata('amsons_wy')['year'],
        								'date_from' => date_format(date_create($date_from[$i]),"Y-m-d"),
        								'date_to' => date_format(date_create($date_to[$i]),"Y-m-d"),
        								'total_day' => $total_day[$i],
        								'slot_dur' => $slot_dur[$i],
        								'day_times' => $day_times[$i],
        								'total_sec' => $total_sec[$i],
        								'rate_per_10' => $rate_per_10[$i],
        								'rate_one' => $rate_one[$i],
        								'com1' =>$com1[$i],
        								'com2' =>$com2[$i],
        								'total_com' =>$total_com[$i],
        								'tax' =>$tax[$i],
        								'tax_a' =>$tax_a[$i],
        								'material' => $material[$i],
        								'amount' => $tamount[$i],
        								'pay_amount' =>$pay_amount[$i]
        							);
        							
        						$this->db->insert('tbl_fm_ro_details',$values1);
        				
							}
		  
			$this->session->set_flashdata('msg', 'Ro updated Successfully.');
			redirect('admin/fm_ro');
		}
		else
		{ 
		    $this->db->where('id',$id);
		    $fm_ro=$this->db->get('tbl_fm_ro');
		    $fm=$fm_ro->row();
		    $fm_details=$this->db->query("SELECT tbl_fm_ro.* ,d.date_from as date_from ,d.date_to,d.total_day,d.slot_dur,d.day_times,d.total_sec,d.rate_per_10,d.rate_one,d.material,d.amount,d.com1 as COMM1,d.com2 as COMM2,d.total_com as tcom,d.tax as tax1,d.tax_a as TAX,d.pay_amount as net FROM `tbl_fm_ro` INNER JOIN tbl_fm_ro_details as d on d.ro_no= tbl_fm_ro.ro_no  WHERE tbl_fm_ro.id ='$id'");
		    $fm_d= $fm_details->result_array();
	
		    $data['fm']=$fm ;
		     $data['fm_d']=$fm_d ;
		    $query = $this->db->get('tbl_fm_group');
			$data['fm_groups']= $query->result();
									
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
			$this->db->where('tax_type','fm');
			$query = $this->db->get('tbl_tax');
			$data['taxs']= $query->row();
			
			$query = $this->db->get_where('tbl_fm_channels', array('g_id' => $fm->g_id));
		    $data['fmc']= $query->row();
			//echo json_encode($data);
			//die;
			$this->load->view('admin/header');
			$this->load->view('admin/fm_ro_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function del($id)
	{
	    $this->db->where('id',$id);
	    $ro=$this->db->get("tbl_fm_ro");
	    $ro_no=$ro->row()->ro_no;
	   // echo ($ro_no);
	   // die();
	   $this->db->delete('tbl_fm_ro_details',"ro_no=".$ro_no);
		if($this->db->delete("tbl_fm_ro","id=".$id))
		{
			$this->session->set_flashdata('msg', 'Ro Delete Successfully.');
			redirect('admin/fm_ro');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Ro not Delete Successfully.');
			redirect('admin/fm_ro');
		}
	}
	
	
	public function info($id)
	{
		$book_ro = $this->db->query("SELECT tbl_fm_ro.*, c.name as channel_name, g.ng_name as group_name, cl.client_name as client_name FROM tbl_fm_ro
INNER JOIN tbl_fm_channels c ON c.id=tbl_fm_ro.fmc_id
INNER JOIN tbl_fm_ro_details d ON d.ro_no=tbl_fm_ro.ro_no
INNER JOIN tbl_fm_group g ON g.ng_id=tbl_fm_ro.g_id
INNER JOIN tbl_client cl ON cl.id=tbl_fm_ro.c_id WHERE tbl_fm_ro.id = '".$id."'" );
		
		$ro= $book_ro->result();
		$data['book_ro']=$ro[0];	
		$this->load->view('admin/header');
		$this->load->view('admin/fm_ro_info',$data);
		$this->load->view('admin/footer');
	}
	
	public function ro($id)
	{
		$book_ro = $this->db->query("SELECT tbl_fm_ro.*, c.name as channel_name, g.ng_name as group_name, cl.client_name as client_name FROM tbl_fm_ro
INNER JOIN tbl_fm_channels c ON c.id=tbl_fm_ro.fmc_id
INNER JOIN tbl_fm_group g ON g.ng_id=tbl_fm_ro.g_id
INNER JOIN tbl_client cl ON cl.id=tbl_fm_ro.c_id WHERE tbl_fm_ro.id = '".$id."'" );
		
		$ro= $book_ro->result();
		$data['book_ro']=$ro[0];
		
		$this->load->view('admin/header');
		$this->load->view('admin/fm_ro_print',$data);
		$this->load->view('admin/footer');
	}	
	public function show_data()
	{
	   $ro_no=0;
	  $values=array();
	 
	    $td=json_decode($_POST['td']);
	  
	      $ro = $this->db->query('select MAX(ro_no) as `ro` from `tbl_fm_ro`')->row();
	 
	
	  echo $ro->ro;
	   if($ro->ro)
	   {
	  $ro_no=$ro->ro + 1;
	   }
	   else
	   {
	 $ro_no=1;
	   
	   }
	   $g_id = $this->input->post("FMG");
        $fmc_id = $this->input->post("fmc");
		$city = $this->input->post("city");
		$c_id = $this->input->post("client");
		$ro_date  = date_create($this->input->post("Ro_Date"));
		$heading = $this->input->post("heading");
		$remark = $this->input->post("remarks");
	    $comm_a = $this->input->post("comm_a");
	    echo ($comm_a);
       $tax_total= $this->input->post("tax_a");
       $t_amount =$this->input->post("t_amount");
       $p_amount=$this->input->post("p_amount");
  if(($client->credit_bal+ $p_amount )>$client->credit_limit)
                {
                    $values['pending']='P';
                }
                else
                {
                    $values['pending']='C';
                    $bal=$client->credit_bal + $p_amount;
                    $values1 = array('credit_bal' =>$bal);
                    $this->db->update('tbl_client',$values1, "id =".$client->id);
                }
	                 
	   	$values = array(
								'ro_date' => date_format($ro_date,"Y-m-d"),
						    	'ro_no'=>$ro_no,
								'work_year'=>$this->session->userdata('amsons_wy')['year'],
								'g_id' =>$g_id ,
								'fmc_id' => $fmc_id,
								'city' => $city,
								'c_id' => $c_id,
								'heading' => $heading,
								'remark' => $remark,
								't_amount' => $t_amount,
								'com1' => 0,
								'com2' => 0,
								'total_com' => $comm_a,
								'tax' => 0,
								'tax_a' =>$tax_total,
								'pay_amount' => $p_amount,
								'bill_status'=>'N',
								'c_date' =>date('Y-m-d H:i:s')
							);  
						//	echo var_dump($values);
		$query = $this-> db->insert('tbl_fm_ro', $values);
	//  echo 	$this->db->last_query();		
foreach($td as $key => $a)
	  { 
	     
	   
	      $t=(array)$a;
		   
		    
								$date_from = date_create($t["date_f"]);
								$date_to = date_create($t["date_t"]);
								$total_day = $t["day"];
								$slot_dur = $t["sd"];
								$day_times = $t["day_times"];
								$total_sec = $t["ts"];
								$rate_per_10 = $t["rp10"];
								$rate_one = $t["slot_rate"];
								$material = $t["matter"];
								$tamount = $t["total"];
								$com1 = $t["comm1"];
								$com2 = $t["comm2"];
								$total_com = $t["comm_a"];
								$tax = $t["tax"];
								$tax_a =$t["tax_a"];
								$pay_amount = $t["net_a"];
  

  
			
						
                $values1=array(
                                'ro_date' => date_format($ro_date,"Y-m-d"),
						    	'ro_no'=>$ro_no,
								'work_year'=>$this->session->userdata('amsons_wy')['year'],
								'date_from' => date_format($date_from,"Y-m-d"),
								'date_to' => date_format($date_to,"Y-m-d"),
								'total_day' => $total_day,
								'slot_dur' => $slot_dur,
								'day_times' => $day_times,
								'total_sec' => $total_sec,
								'rate_per_10' => $rate_per_10,
								'rate_one' => $rate_one,
								'com1' =>$com1,
								'com2' =>$com2,
								'total_com' =>$total_com,
								'tax' =>$tax,
								'tax_a' =>$tax_a,
								'material' => $material,
								'amount' => $tamount,
								'pay_amount' =>$pay_amount
							);							
	
			$query=$this->db->insert('tbl_fm_ro_details',$values1);
		
		
	  } 
	  
	  $data='1';
return json_encode($data);
	$this->session->set_flashdata('msg', 'FM Ro book Successfully');
	redirect('admin/fm_ro');
				
	  	}
}
?>