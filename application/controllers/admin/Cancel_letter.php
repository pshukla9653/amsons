<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_letter extends CI_Controller
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
			$config["base_url"] = base_url() . "admin/cancel_letter/index";
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
			$config["base_url"] = base_url(). "admin/cancel_letter/index";
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
			$this->db->select('tbl_letters.*,tbl_client.client_name');
            $this->db->from('tbl_letters');
			$this->db->where('letter_type!="IN"');
			$this->db->join('tbl_client','tbl_client.id = tbl_letters.client_id');
			$query = $this->db->get();
			
			$data['letters']= $query->result();
		}		

		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/cancel_letter_list', $data);
		$this->load->view('admin/footer');
	}
	
	
public function add()
	{
		if (!empty($this->input->post()))
		{	
			$this->form_validation->set_rules('client', 'Client', 'required');
			
			//$this->form_validation->set_rules('date_t', 'Date To', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{				
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
			    //$insertion=$this->input->post('inse');
			    
			    $letter_type=$this->input->post('letter_type');
				$l_no=letter_no_gen();
				$values = array(								
								'letter_no'=>$l_no,
								'letter_type'=>$letter_type,
								'ro_no'=>$this->input->post('ro_no'),
								'client_id'=>$this->input->post('client'),
								'ro_id'=>$this->input->post('ro_id'),
								'ro_date'=>$this->input->post('ro_date'),
								'heading'=>$this->input->post('sheading'),
								'scheme'=>$this->input->post('scheme'),
								'material'=>$this->input->post('material'),
								'remark'=>$this->input->post('remark'),
								'work_year'=>$this->session->userdata('amsons_wy')['year'],
								'c_date'=>date('Y-m-d')
							);
				
				$query = $this-> db->insert('tbl_letters', $values);
		
				$in_id=$this->db->insert_id();
				$publish_date=$this->input->post('p_date');
				
	
				foreach($publish_date as $dates)
				{ 
				   
				    
					$values1 = array(
									'inse_letter_id'=>$in_id,
									'paper_id'=>$dates['id'],
									'last_dop'=>$dates['dop'],
									'dops'=>$dates['new_dop'],
									'insertion_no'=>$dates['insertion_no'],
									'c_date'=> date('Y-m-d H:i:s')
								);
				$query = $this-> db->insert('tbl_letter_dops', $values1);
					if($letter_type == 'C'){
					$this->db->query("update tbl_ro_dop set cancel_no='$in_id' ,letter_status='CCL' where id='".$dates['ro_main_id']."'");
					}
					if($letter_type == 'Pre'){
					$this->db->query("update tbl_ro_dop set postpone_no='$in_id' , letter_status='PRE' where id='".$dates['ro_main_id']."'");
					}
					if($letter_type == 'Post'){
					$this->db->query("update tbl_ro_dop set postpone_no='$in_id' , letter_status='POST' where id='".$dates['ro_main_id']."'");
					}
				
			
				}
				
			
		
				$msg="5";
				echo $msg;						
				return;
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
			$this->load->view('admin/cancel_letter_add', $data);
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
		
	
				$query = $this->db->query("SELECT t.*,s.scheme_name FROM tbl_book_ads t left JOIN tbl_scheme s on s.scheme_id=t.scheme WHERE t.u_id='".$client."' AND t.book_date >= '".$date_f1."' AND t.book_date <= '".$date_t1."'");	
		
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
		
		if($book_ad->type_id=='3')
		{
			$book_ads=$this->db->query("SELECT tbl_book_ads.*,sch.scheme_name, n.name as newspaper_name, t.name as type_name, po.position as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_position po ON po.id=tbl_book_ads.cat_id
LEFT JOIN tbl_scheme sch ON sch.scheme_id=tbl_book_ads.scheme
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."' and letter_status!='CCL'");
		}
		else
		{
			
		
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name,sch.scheme_name, t.name as type_name, sh.sub_heading as cat_name, u.email, u.mobile, u.client_name,d.dop,sch.scheme_name  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_sub_heading sh ON sh.id=tbl_book_ads.sub_heading
LEFT JOIN tbl_scheme sch ON sch.scheme_id=tbl_book_ads.scheme
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$id."' and letter_status!='CCL' GROUP BY tbl_book_ads.id");

		}
		
		$data['book_ad']= $book_ads->row();
		
		$dops = $this->db->query("SELECT distinct tbl_ro_dop.paper_id,tbl_ro_dop.ro_no,tbl_ro_dop.ro_id, n.name as newspaper_name, c.name as city_name FROM tbl_ro_dop 
INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
INNER JOIN tbl_cities c ON c.id=pc.city_id WHERE tbl_ro_dop.ro_id='".$id."' and tbl_ro_dop.dop >= '".date('Y-m-d')."'");

		$dops1 = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name, c.name as city_name FROM tbl_ro_dop 
INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
INNER JOIN tbl_cities c ON c.id=pc.city_id WHERE tbl_ro_dop.ro_id='".$id."' and letter_status!='CCL' ");		
		$data['dops1']=$dops1->result();
	//echo $this->db->last_query();die;
			$data['dops']=$dops->result();
		if(empty($book_ad))
		{
			$msg="1";
			echo $msg;
			return;
		}
		else
		{
			echo json_encode($data);
			return;
		}
		
	}
	
	
	
public function edit($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('client', 'client', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
			 redirect('admin/cancel_letter/edit/'.$id);
			}
			else			
			{
			    $in_id=$this->input->post('letter_id');
			    $l_no=$this->input->post('letter_no');
			 $letter_type=$this->input->post('letter_type');
					$values = array(								
								'letter_no'=>$l_no,
								'letter_type'=>$letter_type,
								'ro_no'=>$this->input->post('ro_no'),
								'client_id'=>$this->input->post('client'),
								'ro_id'=>$this->input->post('ro_id'),
								'ro_date'=>$this->input->post('ro_date'),
								'heading'=>$this->input->post('sheading'),
								'scheme'=>$this->input->post('scheme'),
								'material'=>$this->input->post('material'),
								'remark'=>$this->input->post('remark'),
								'work_year'=>$this->session->userdata('amsons_wy')['year'],
								'c_date'=>date('Y-m-d')
							);
				
				$query = $this-> db->update('tbl_letters', $values,'id='.$in_id);
	//	echo $this->db->last_query();
				$publish_date=$this->input->post('p_date');
				
	
				foreach($publish_date as $dates)
				{ 
				    // $Paid=$this->input->post('Paid');
				    // $Free=$this->input->post('Free');
				    
					$values1 = array(
									'inse_letter_id'=>$in_id,
									'paper_id'=>$dates['id'],
									'last_inse'=>$dates['last_ins'],
									'last_dop'=>$dates['dop'],
									'dops'=>$dates['new_dop'],
									'c_date'=> date('Y-m-d H:i:s')
								);
				$query = $this-> db->update('tbl_letter_dops', $values1,'id='.$dates['ro_main_id']);
			//	echo $this->db->last_query();die;
			//	$this->db->query("Delete from tbl_ro_dop where Letter_no='$in_id'");
					
				// 	if($dates['dop']!=''||$dates['dop']!='undefined')
				//  	{
				//  	    $dop1=explode(',',$dates['dop']);
				//  	    $totalInsertion=count($dop1)+$dates['last_ins'];
				 	  
				//  	    if($insertion==$totalInsertion)
				//  	    {
				 	        
				//  	        $this->db->query("UPDATE tbl_book_ads set other_day_f=0 where id='".$this->input->post('ro_id')."'");
				//  	    }
				 	  
				 	    
				//  	    $count=1;
				 	   
				 	    
				 	   
				//  	    foreach($dop1 as $dd)
				//  	    {
				//  	         if($Paid==""||$Paid==0)
    // 				 	    {
    // 				 	         $values2 = array(
    //                                     'ro_id'=>$this->input->post('ro_id'),
    //                                     'ro_no'=>$this->input->post('ro_no'),
    //                                     'work_year'=>$this->input->post('work_year'),
    //                                     'paper_id'=>$values1['paper_id'],
    //                                     'dop'=>date('Y-m-d',strtotime($dd)),
    //                                     'dop_amount'=>$dates['dop_amount'],
    //                                     'Letter_no'=>$in_id,
    //                                     'letter_status'=>'INS',
    //                                     'c_date'=> date('Y-m-d H:i:s')
    //                                 );
    				 	       
    // 				 	    }
    // 				 	    else
    // 				 	    {
    // 				 	         $Pleft=$Paid-$dates['last_ins'];
    // 				 	          if($Pleft>=$count)
    //     				 	        {
    //             					    $values2 = array(
    //                                         'ro_id'=>$this->input->post('ro_id'),
    //                                         'ro_no'=>$this->input->post('ro_no'),
    //                                         'work_year'=>$this->input->post('work_year'),
    //                                         'paper_id'=>$values1['paper_id'],
    //                                         'dop'=>date('Y-m-d',strtotime($dd)),
    //                                         'dop_amount'=>$dates['dop_amount'],
    //                                         'Letter_no'=>$in_id,
    //                                         'letter_status'=>'INS',
    //                                         'c_date'=> date('Y-m-d H:i:s')
    //                                     );
    //     				 	        }
    //     				 	        else
    //     				 	        {
    //     				 	             $values2 = array(
    //                                         'ro_id'=>$this->input->post('ro_id'),
    //                                         'ro_no'=>$this->input->post('ro_no'),
    //                                         'work_year'=>$this->input->post('work_year'),
    //                                         'paper_id'=>$values1['paper_id'],
    //                                         'dop'=>date('Y-m-d',strtotime($dd)),
    //                                         'dop_amount'=>0,
    //                                         'Letter_no'=>$in_id,
    //                                         'letter_status'=>'INS',
    //                                         'c_date'=> date('Y-m-d H:i:s')
    //                                     );
    //     				 	        }
    // 				 	    }
				 	       
    //                     $query = $this-> db->insert('tbl_ro_dop', $values2);
                     
    //                     $count++;
				//  	    }
				// }
				
			
					}
		
		
				$msg="5";
				echo $msg;						
				return;
			}
		}
		else
		{
		    	$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
			$query =$this->db->get_where('tbl_letters', array('id' => $id));
			$ap=$query->result();
			$data['letters']=$ap[0];
			$query=$this->db->query("select * from tbl_letter_dops where inse_letter_id='$id' ");
			$data['letter_dops']=$query->result();
			
			$query1 =$this->db->query("select t.*, n.name as newspaper_name, c.name as city_name  from tbl_letter_dops t INNER JOIN tbl_paper_city pc ON pc.id=t.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
INNER JOIN tbl_cities c ON c.id=pc.city_id where t.inse_letter_id ='$id'");
			$ap1=$query1->result();
			$data['letters_details']=$ap1;
				$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
		$book_ad=$ad->result();
			$dops1 = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name, c.name as city_name FROM tbl_ro_dop 
INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
INNER JOIN tbl_cities c ON c.id=pc.city_id WHERE tbl_ro_dop.ro_id='".$ap[0]->ro_id."'");		
		$data['dops1']=$dops1->result();
	    
	    $kad = $this->db->get_where('tbl_book_ads', array('id' => $ap[0]->ro_id));
		$book_ad=$kad->row();
		//$data['book_ad']=$book_ad;
		
		if($book_ad->type_id=='3')
		{
			$book_ads=$this->db->query("SELECT tbl_book_ads.*,sch.scheme_name, n.name as newspaper_name, t.name as type_name, po.position as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_position po ON po.id=tbl_book_ads.cat_id
LEFT JOIN tbl_scheme sch ON sch.scheme_id=tbl_book_ads.scheme
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$ap[0]->ro_id."'");
		}
		else
		{
			
		
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name,sch.scheme_name, t.name as type_name, sh.sub_heading as cat_name, u.email, u.mobile, u.client_name,d.dop,sch.scheme_name  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_sub_heading sh ON sh.id=tbl_book_ads.sub_heading
LEFT JOIN tbl_scheme sch ON sch.scheme_id=tbl_book_ads.scheme
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$ap[0]->ro_id."' GROUP BY tbl_book_ads.id");

		}
		
		$data['book_ad']= $book_ads->row();
			
	
			
			$this->load->view('admin/header');
			$this->load->view('admin/cancel_letter_edit',$data);
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
	
	public function letter_print($id)
	{
		$ins_letters = $this->db->query("SELECT tbl_letters.*, n.name as newspaper_name, t.name as type_name, e.e_name, u.email,u.city as client_city, u.mobile, u.client_name,b.newspaper_id,b.color,b.package,b.insertion,b.size_words,b.ex_price,b.box_charge,c.name as city_name FROM tbl_letters INNER JOIN tbl_book_ads b ON b.id=tbl_letters.ro_id INNER JOIN tbl_newspapers n ON n.id=b.newspaper_id INNER JOIN tbl_cities c ON c.id=b.city INNER JOIN tbl_news_type t ON t.id=b.type_id INNER JOIN tbl_employee e ON e.e_id=b.e_id INNER JOIN tbl_client u ON u.id=b.u_id WHERE tbl_letters.id ='".$id."'" );
				
		$a= $ins_letters->result();
		$data['ins_letter']=$a[0];	
		
		$ins_dop = $this->db->query("SELECT tbl_letter_dops.*, n.name as newspaper_name FROM tbl_letter_dops
INNER JOIN tbl_paper_city pc ON pc.id=tbl_letter_dops.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_letter_dops.inse_letter_id = '".$id."'" );
				
	
		$data['ins_dops']=$ins_dop->result();
		
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/ins_letter_print',$data);
		$this->load->view('admin/footer');
	}
	


	
}
?>