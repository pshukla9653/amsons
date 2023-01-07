<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ro_billing extends CI_Controller
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

	
	public function text_edit_ro($id,$go="")
	{		
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'No. of words', 'required');
			$this->form_validation->set_rules('matter', 'Matter', 'required');
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				redirect('admin/book_ads/edit/'.$id);
				/*$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
				$a=$ad->result();
				$data['book_ad']=$a[0];
			
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
				INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
				INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
				$data['newspapers']= $query->result();
			
				$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
				$data['dops']=$dops->result();
			
				//$data['dops_json']=json_encode($data['dops']);
				//$query = $this->db->get('tbl_newspapers');
				//$data['newspapers']= $query->result();
									
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
			
				$query = $this->db->get('tbl_employee');
				$data['employees']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/book_ads_edit',$data);
				$this->load->view('admin/footer'); */
			}
			else
			{
				$query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$ng= $query->row();
				
				if($this->input->post('premimum') !=null)
				{
					$premimum=implode(",",$this->input->post('premimum'));
				}
				else
				{
					$premimum="";
				}
				
				
				$values = array(
								'u_id' => $this->input->post('client'),
								'e_id' =>  $_SESSION['admin']['id'],
								'newspaper_id' => $ng->paper_id,
								'paper_city_id' => $this->input->post('newspaper'),
								'title' => $this->input->post('title'),
								'content' => $this->input->post('matter'),
								'type_id' => 1,
								'cat_id' => $this->input->post('cat'),
								'sub_heading' => $this->input->post('sheading'),
								'package' => $this->input->post('pack'),
								'insertion' => $this->input->post('inse'),
								'scheme' => $this->input->post('scheme'),
								'material' => $this->input->post('material'),
								'party' => $this->input->post('party'),
								'box' => $this->input->post('box'),
								'premimum' =>$premimum ,
								'remark' => $this->input->post('remark'),
								'price' => $this->input->post('price'),
								'ex_price' => $this->input->post('eprice'),
								'ad_cost' => $this->input->post('p_amount'),
								't_amount' => $this->input->post('t_amount'),
								'discount' => $this->input->post('dis_a'),
								'city' => $ng->city_id,
								'size_words' => $this->input->post('w_count'),
								'tax' => 0,
								'publish_day'=> $this->input->post('inse'),
								'other_day_f'=> $this->input->post('odf'),
								'ro_type' => $this->input->post('ro_type'),
								'comm1' => $this->input->post('comm1'),
								'comm2' => $this->input->post('comm2'),
								'comm3' => $this->input->post('comm3'),
								'comm4' => $this->input->post('comm4'),
								'comm5' => $this->input->post('comm5'),
								'comm6' => $this->input->post('comm6'),
								'comm7' => $this->input->post('comm7'),
								'comm8' => $this->input->post('comm8'),
								'box_charge'=>$this->input->post('box_c'),
								'add_on_a'=>$this->input->post('add_a'),
								'book_date'=>date('Y-m-d'),
								'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
								'c_date' => date('Y-m-d H:i:s')
							);							
				
				$publish_date=$this->input->post('p_date');
				$odf=$this->input->post('odf');
				
				if($values['ro_type']=="N" && $odf=='0')
				{
					$days=explode(", ",$publish_date);
					$c=count($days);
					if($c<$values['insertion'])
					{
						$msg="2";
						echo $msg;						
						return;
					}
				}
				if($values['ro_type']=="P" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
				if($values['ro_type']=="M" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
								
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
				$ro= $query->row();
				$old_amount =$ro->ad_cost;
				
				$query = $this->db->get_where('tbl_client', array('id' => $values['u_id']));				
				$client= $query->row();
				
				if(($client->credit_bal-$old_amount+$values['ad_cost'])>$client->credit_limit)
				{
					$values['pending']='P';
				}
				else
				{
					$values['pending']='C';
					$bal=$client->credit_bal-$old_amount+$values['ad_cost'];
					$values1 = array('credit_bal' =>$bal);
					$this->db->update('tbl_client',$values1, "id =".$client->id);
				}
				
				
				//$values['tax_a']=$ro_a*$values['tax']/100;
			
				$values['p_amount']=$values['ad_cost'];
				
				if($values['ro_type']=="N")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					$values1 = array(
						'ro_id'=>$in_id,
						'paper_id'=>$this->input->post('newspaper'),
						'dop'=>$publish_date,
						'c_date'=> date('Y-m-d H:i:s')
					);
					$query = $this-> db->insert('tbl_ro_dop', $values1);
				}
				if($values['ro_type']=="P")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;

					foreach($publish_date as $dates)
					{
						$values1 = array(
							'ro_id'=>$in_id,
							'paper_id'=>$dates['id'],
							'dop'=>$dates['dop'],
							'c_date'=> date('Y-m-d H:i:s')
						);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}

				if($values['ro_type']=="M")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;

					foreach($publish_date as $dates)
					{
						$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$dates['id'],
										'dop'=>$dates['dop'],
										'c_date'=> date('Y-m-d H:i:s')
									);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}				

				$msg="5";
				echo $msg;						
				return;
			}
		}
		else
		{
				$this->load->model("site_model");
			$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
			$a=$ad->result();
			$data['book_ad']=$a[0];
$this->load->model("ro_model");
            $data['states']=$this->ro_model->get_states($a[0]->paper_city_id);
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
			INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
			INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");

			$data['newspapers']= $query->result();
$dops=$this->db->query("select * from tbl_ro_dop where ro_id='$id' and bill_status='N'");
		//	$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
			$data['dops']=$dops->result();
$dops_1=$this->db->query("select * from tbl_ro_dop where ro_id='$id' and bill_dop=''");
		//	$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
			$data['dops_1']=$dops_1->result();
			//$data['dops_json']=json_encode($data['dops']);
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
			
			$query = $this->db->get_where('tbl_client',array('id' => $id));
			$data['clients']= $query->row();

			$data['go']= $go;
			
			$where=array(
				"client_id"=>$data['book_ad']->u_id,
				"type_id"=>1,
				"cat_id"=>$data['book_ad']->cat_id,
				"newspaper_id"=>$data['book_ad']->paper_city_id
			);

			$data['discount_percentage']=$this->site_model->get_data("tbl_discount",$where,"discount_percentage")[0]['discount_percentage'];
			//echo '<pre>'; var_dump($where); die;
			$query = $this->db->get('tbl_employee');
			$data['employees']= $query->result();
			//echo '<pre>'; var_dump($data['dops']); die;
			$this->load->view('admin/header');
			$this->load->view('admin/text_ro',$data);
			$this->load->view('admin/footer');
		}
	}	
	public function text_edit($id,$go="")
	{		
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'No. of words', 'required');
			$this->form_validation->set_rules('matter', 'Matter', 'required');
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				redirect('admin/book_ads/edit/'.$id);
				/*$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
				$a=$ad->result();
				$data['book_ad']=$a[0];
			
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
				INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
				INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
				$data['newspapers']= $query->result();
			
				$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
				$data['dops']=$dops->result();
			
				//$data['dops_json']=json_encode($data['dops']);
				//$query = $this->db->get('tbl_newspapers');
				//$data['newspapers']= $query->result();
									
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
			
				$query = $this->db->get('tbl_employee');
				$data['employees']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/book_ads_edit',$data);
				$this->load->view('admin/footer'); */
			}
			else
			{
				$query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$ng= $query->row();
				
				if($this->input->post('premimum') !=null)
				{
					$premimum=implode(",",$this->input->post('premimum'));
				}
				else
				{
					$premimum="";
				}
				
				
				$values = array(
								'u_id' => $this->input->post('client'),
								'e_id' =>  $_SESSION['admin']['id'],
								'newspaper_id' => $ng->paper_id,
								'paper_city_id' => $this->input->post('newspaper'),
								'title' => $this->input->post('title'),
								'content' => $this->input->post('matter'),
								'type_id' => 1,
								'cat_id' => $this->input->post('cat'),
								'sub_heading' => $this->input->post('sheading'),
								'package' => $this->input->post('pack'),
								'insertion' => $this->input->post('inse'),
								'scheme' => $this->input->post('scheme'),
								'material' => $this->input->post('material'),
								'party' => $this->input->post('party'),
								'box' => $this->input->post('box'),
								'premimum' =>$premimum ,
								'remark' => $this->input->post('remark'),
								'price' => $this->input->post('price'),
								'ex_price' => $this->input->post('eprice'),
								'ad_cost' => $this->input->post('p_amount'),
								't_amount' => $this->input->post('t_amount'),
								'discount' => $this->input->post('dis_a'),
								'city' => $ng->city_id,
								'size_words' => $this->input->post('w_count'),
								'tax' => 0,
								'publish_day'=> $this->input->post('inse'),
								'other_day_f'=> $this->input->post('odf'),
								'ro_type' => $this->input->post('ro_type'),
								'comm1' => $this->input->post('comm1'),
								'comm2' => $this->input->post('comm2'),
								'comm3' => $this->input->post('comm3'),
								'comm4' => $this->input->post('comm4'),
								'comm5' => $this->input->post('comm5'),
								'comm6' => $this->input->post('comm6'),
								'comm7' => $this->input->post('comm7'),
								'comm8' => $this->input->post('comm8'),
								'box_charge'=>$this->input->post('box_c'),
								'add_on_a'=>$this->input->post('add_a'),
								'book_date'=>date('Y-m-d'),
								'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
								'c_date' => date('Y-m-d H:i:s')
							);							
				
				$publish_date=$this->input->post('p_date');
				$odf=$this->input->post('odf');
				
				if($values['ro_type']=="N" && $odf=='0')
				{
					$days=explode(", ",$publish_date);
					$c=count($days);
					if($c<$values['insertion'])
					{
						$msg="2";
						echo $msg;						
						return;
					}
				}
				if($values['ro_type']=="P" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
				if($values['ro_type']=="M" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
								
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
				$ro= $query->row();
				$old_amount =$ro->ad_cost;
				
				$query = $this->db->get_where('tbl_client', array('id' => $values['u_id']));				
				$client= $query->row();
				
				if(($client->credit_bal-$old_amount+$values['ad_cost'])>$client->credit_limit)
				{
					$values['pending']='P';
				}
				else
				{
					$values['pending']='C';
					$bal=$client->credit_bal-$old_amount+$values['ad_cost'];
					$values1 = array('credit_bal' =>$bal);
					$this->db->update('tbl_client',$values1, "id =".$client->id);
				}
				
				
				//$values['tax_a']=$ro_a*$values['tax']/100;
			
				$values['p_amount']=$values['ad_cost'];
				
				if($values['ro_type']=="N")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					$values1 = array(
						'ro_id'=>$in_id,
						'paper_id'=>$this->input->post('newspaper'),
						'dop'=>$publish_date,
						'c_date'=> date('Y-m-d H:i:s')
					);
					$query = $this-> db->insert('tbl_ro_dop', $values1);
				}
				if($values['ro_type']=="P")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;

					foreach($publish_date as $dates)
					{
						$values1 = array(
							'ro_id'=>$in_id,
							'paper_id'=>$dates['id'],
							'dop'=>$dates['dop'],
							'c_date'=> date('Y-m-d H:i:s')
						);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}

				if($values['ro_type']=="M")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;

					foreach($publish_date as $dates)
					{
						$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$dates['id'],
										'dop'=>$dates['dop'],
										'c_date'=> date('Y-m-d H:i:s')
									);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}				

				$msg="5";
				echo $msg;						
				return;
			}
		}
		else
		{
				$this->load->model("site_model");
			$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
			$a=$ad->result();
			$data['book_ad']=$a[0];
$this->load->model("ro_model");
            $data['states']=$this->ro_model->get_states($a[0]->paper_city_id);
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
			INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
			INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");

			$data['newspapers']= $query->result();
$dops=$this->db->query("select * from tbl_ro_dop where ro_id='$id' and bill_status='N'");
		//	$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
			$data['dops']=$dops->result();
$dops_1=$this->db->query("select * from tbl_ro_dop where ro_id='$id' and bill_dop='0000-00-00'");
		//	$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
			$data['dops_1']=$dops_1->result();
			//$data['dops_json']=json_encode($data['dops']);
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();

			$data['go']= $go;
			
			$where=array(
				"client_id"=>$data['book_ad']->u_id,
				"type_id"=>1,
				"cat_id"=>$data['book_ad']->cat_id,
				"newspaper_id"=>$data['book_ad']->paper_city_id
			);

			$data['discount_percentage']=$this->site_model->get_data("tbl_discount",$where,"discount_percentage")[0]['discount_percentage'];
			//echo '<pre>'; var_dump($where); die;
			$query = $this->db->get('tbl_employee');
			$data['employees']= $query->result();
			//echo '<pre>'; var_dump($data['dops']); die;
			$this->load->view('admin/header');
			$this->load->view('admin/text_ro_billing',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
		
	public function bill_text_edit($ro_id,$bill_id)
	{		
		$ad = $this->db->get_where('tbl_book_ads', array('id' => $ro_id));
		$a=$ad->row();
		$data['book_ad']=$a;

		$query= $this->db->get_where('tbl_bill', array('id' => $bill_id));
		$bill=$query->row();
		$data['bill']=$bill;
		
		//echo '<pre>'; var_dump($data['bill']); die;
		$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
		INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
		INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
		$data['newspapers']= $query->result();

		$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $ro_id));
		$data['dops']=$dops->result();
		
		$bill_details = $this->db->get_where('tbl_bill_details', array('ro_id' => $ro_id));
		$data['bill_details']=$bill_details->result()[0];
		//$data['dops_json']=json_encode($data['dops']);
		//$query = $this->db->get('tbl_newspapers');
		//$data['newspapers']= $query->result();
		
		$query = $this->db->get('tbl_client');
		$data['clients']= $query->result();

		$query = $this->db->get('tbl_employee');
		$data['employees']= $query->result();
		//echo '<pre>'; var_dump($data['dops']); die;
		$this->load->view('admin/header');
		$this->load->view('admin/text_client_bill_edit',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function cd_edit($id,$go="")
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'Size', 'required');
			//$this->form_validation->set_rules('matter', 'Matter', 'required');
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				redirect('admin/display_ro/edit/'.$id);
				/*
				$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
				$a=$ad->result();
				$data['book_ad']=$a[0];
			
			
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
				$data['newspapers']= $query->result();
			
				$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
				$data['dops']=$dops->result();
			
				//$data['dops_json']=json_encode($data['dops']);
				//$query = $this->db->get('tbl_newspapers');
				//$data['newspapers']= $query->result();
									
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
			
				$query = $this->db->get('tbl_employee');
				$data['employees']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/display_ro_edit',$data);
				$this->load->view('admin/footer');
				*/
			}
			else
			{
				$query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$ng= $query->row();
				
				if($this->input->post('premimum') !=null)
				{
					$premimum=implode(",",$this->input->post('premimum'));
				}
				else
				{
					$premimum="";
				}
				
				$values = array(
					'u_id' => $this->input->post('client'),
					'e_id' => $this->input->post('employee'),
					'newspaper_id' => $ng->paper_id,
					'paper_city_id' => $this->input->post('newspaper'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('matter'),
					'type_id' => 2,
					'cat_id' => $this->input->post('cat'),
					'color'=>$this->input->post('color'),
					'sub_heading' => $this->input->post('sheading'),
					'package' => $this->input->post('pack'),
					'insertion' => $this->input->post('inse'),
					'scheme' => $this->input->post('scheme'),
					'material' => $this->input->post('material'),
					'party' => $this->input->post('party'),
					'box' => $this->input->post('box'),
					'premimum' => $premimum,
					'remark' => $this->input->post('remark'),
					'price' => $this->input->post('price'),
					'ex_price' => $this->input->post('price'),
					'ad_cost' => $this->input->post('p_amount'),
					't_amount' => $this->input->post('t_amount'),
					'discount' => $this->input->post('dis_a'),
					'city' => $ng->city_id,
					'size_words' => $this->input->post('w_count'),
					'size_type' => $this->input->post('size_type'),
					'tax' => 0,
					'publish_day'=> $this->input->post('inse'),
					'other_day_f'=> $this->input->post('odf'),
					'ro_type' => $this->input->post('ro_type'),
					'comm1' => $this->input->post('comm1'),
					'comm2' => $this->input->post('comm2'),
					'comm3' => $this->input->post('comm3'),
					'comm4' => $this->input->post('comm4'),
					'comm5' => $this->input->post('comm5'),
					'comm6' => $this->input->post('comm6'),
					'comm7' => $this->input->post('comm7'),
					'comm8' => $this->input->post('comm8'),
					'box_charge'=>$this->input->post('box_c'),
					'add_on_a'=>$this->input->post('add_a'),
					'book_date'=>date('Y-m-d'),
					'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
					'c_date' => date('Y-m-d H:i:s')
				);
				
				
				$publish_date=$this->input->post('p_date');
				$odf=$this->input->post('odf');
				
				
				if($values['ro_type']=="N" && $odf=='0')
				{
					$days=explode(", ",$publish_date);
					$c=count($days);
					if($c<$values['insertion'])
					{
						$msg="2";
						echo $msg;						
						return;
					}
				}
				if($values['ro_type']=="P" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
				if($values['ro_type']=="M" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
								
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
				$ro= $query->row();
				$old_amount =$ro->ad_cost;
				
				$query = $this->db->get_where('tbl_client', array('id' => $values['u_id']));				
				$client= $query->row();
				
				if(($client->credit_bal-$old_amount+$values['ad_cost'])>$client->credit_limit)
				{
					$values['pending']='P';
				}
				else
				{
					$values['pending']='C';
					$bal=$client->credit_bal-$old_amount+$values['ad_cost'];
					$values1 = array('credit_bal' =>$bal);
					$this->db->update('tbl_client',$values1, "id =".$client->id);
				}
				
				
				//$values['tax_a']=$ro_a*$values['tax']/100;
			
				$values['p_amount']=$values['ad_cost'];
				
				if($values['ro_type']=="N")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$this->input->post('newspaper'),
										'dop'=>$publish_date,
										'c_date'=> date('Y-m-d H:i:s')
									);
					$query = $this-> db->insert('tbl_ro_dop', $values1);
				}
				if($values['ro_type']=="P")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					foreach($publish_date as $dates)
					{
						$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$dates['id'],
										'dop'=>$dates['dop'],
										'c_date'=> date('Y-m-d H:i:s')
									);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}
				
				if($values['ro_type']=="M")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					foreach($publish_date as $dates)
					{
						$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$dates['id'],
										'dop'=>$dates['dop'],
										'c_date'=> date('Y-m-d H:i:s')
									);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}				
				
				$msg="5";
				echo $msg;						
				return;
			}
		}
		else
		{
				 $ad = $this->db->get_where('tbl_book_ads', array('id' => $id,'type_id'=>'2'));
       //  echo $this->db->last_query();
        //  die;
            $a=$ad->result();
            //echo "<pre>"; var_dump($a[0]->newspaper_id); die;
            $data['book_ad']=$a[0];
          //  echo "<pre>"; var_dump($data['book_ad']); die;
            $data['states']=$this->get_st($a[0]->newspaper_id,$a[0]->city);
          // echo $this->db->last_query();
         //die;

            $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
            INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
            INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
            $data['newspapers']= $query->result();
            $dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id,'bill_status' =>'N'));
            $data['dops']=$dops->result();

			//$data['dops_json']=json_encode($data['dops']);
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();

			$data['go']= $go;
			 $query=$this->db->query("select * from tbl_discount where client_id='".$data['book_ad']->u_id."' and type_id='2' and cat_id='".$data['book_ad']->cat_id."' and newspaper_id='".$data['book_ad']->paper_city_id."'");
           // echo $this->db->last_query();
            $ds=$query->row();
            
            $data['discount_percentage']=$ds->discount_percentage;
			$where=array(
				"client_id"=>$data['book_ad']->u_id,
				"type_id"=>2,
				"cat_id"=>$data['book_ad']->cat_id,
				"newspaper_id"=>$data['book_ad']->paper_city_id
			);

		//	$data['discount_percentage']=$this->site_model->get_data("tbl_discount",$where,"discount_percentage")[0]['discount_percentage'];
			//echo '<pre>'; var_dump($where); die;
			$query = $this->db->get('tbl_employee');
			$data['employees']= $query->result();
			//echo '<pre>'; var_dump($data['dops']); die;
			
			$this->load->view('admin/header');
			$this->load->view('admin/cd_ro_billing',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
		public function hd_edit($id,$go="")
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'Size', 'required');
			//$this->form_validation->set_rules('matter', 'Matter', 'required');
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				redirect('admin/hd_ro/edit/'.$id);
				/*
				$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
				$a=$ad->result();
				$data['book_ad']=$a[0];
			
			
				$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
				$data['newspapers']= $query->result();
			
				$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
				$data['dops']=$dops->result();
			
				//$data['dops_json']=json_encode($data['dops']);
				//$query = $this->db->get('tbl_newspapers');
				//$data['newspapers']= $query->result();
									
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
			
				$query = $this->db->get('tbl_employee');
				$data['employees']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/display_ro_edit',$data);
				$this->load->view('admin/footer');
				*/
			}
			else
			{
				$query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$ng= $query->row();
				
				if($this->input->post('premimum') !=null)
				{
					$premimum=implode(",",$this->input->post('premimum'));
				}
				else
				{
					$premimum="";
				}
				
				$values = array(
								'u_id' => $this->input->post('client'),
								'e_id' => $this->input->post('employee'),
								'newspaper_id' => $ng->paper_id,
								'paper_city_id' => $this->input->post('newspaper'),
								'title' => $this->input->post('title'),
								'content' => $this->input->post('matter'),
								'type_id' => 3,
								'cat_id' => $this->input->post('cat'),
								'color'=>$this->input->post('color'),
								'sub_heading' => $this->input->post('sheading'),
								'package' => $this->input->post('pack'),
								'insertion' => $this->input->post('inse'),
								'scheme' => $this->input->post('scheme'),
								'material' => $this->input->post('material'),
								'party' => $this->input->post('party'),
								'box' => $this->input->post('box'),
								'premimum' => $premimum,
								'remark' => $this->input->post('remark'),
								'price' => $this->input->post('price'),
								'ex_price' => $this->input->post('price'),
								'ad_cost' => $this->input->post('p_amount'),
								't_amount' => $this->input->post('t_amount'),
								'discount' => $this->input->post('dis_a'),
								'city' => $ng->city_id,
								'size_words' => $this->input->post('w_count'),
								'size_type' => $this->input->post('size_type'),
								'tax' => 0,
								'publish_day'=> $this->input->post('inse'),
								'other_day_f'=> $this->input->post('odf'),
								'ro_type' => $this->input->post('ro_type'),
								'comm1' => $this->input->post('comm1'),
								'comm2' => $this->input->post('comm2'),
								'comm3' => $this->input->post('comm3'),
								'comm4' => $this->input->post('comm4'),
								'comm5' => $this->input->post('comm5'),
								'comm6' => $this->input->post('comm6'),
								'comm7' => $this->input->post('comm7'),
								'comm8' => $this->input->post('comm8'),
								'box_charge'=>$this->input->post('box_c'),
								'add_on_a'=>$this->input->post('add_a'),
								'book_date'=>date('Y-m-d'),
								'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
								'c_date' => date('Y-m-d H:i:s')
							);
							
				$publish_date=$this->input->post('p_date');
				$odf=$this->input->post('odf');
				
				if($values['ro_type']=="N" && $odf=='0')
				{
					$days=explode(", ",$publish_date);
					$c=count($days);
					if($c<$values['insertion'])
					{
						$msg="2";
						echo $msg;						
						return;
					}
				}
				if($values['ro_type']=="P" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
				if($values['ro_type']=="M" && $odf=='0')
				{
					foreach($publish_date as $dates)
					{
						$days=explode(", ",$dates['dop']);
						$c=count($days);
						if($c<$values['insertion'])
						{
							$msg="2";
							echo $msg;						
							return;
						}
					}
				}
				
								
				$query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
				$ro= $query->row();
				$old_amount =$ro->ad_cost;
				
				$query = $this->db->get_where('tbl_client', array('id' => $values['u_id']));				
				$client= $query->row();
				
				if(($client->credit_bal-$old_amount+$values['ad_cost'])>$client->credit_limit)
				{
					$values['pending']='P';
				}
				else
				{
					$values['pending']='C';
					$bal=$client->credit_bal-$old_amount+$values['ad_cost'];
					$values1 = array('credit_bal' =>$bal);
					$this->db->update('tbl_client',$values1, "id =".$client->id);
				}
				
				
				//$values['tax_a']=$ro_a*$values['tax']/100;
			
				$values['p_amount']=$values['ad_cost'];
				
				if($values['ro_type']=="N")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$this->input->post('newspaper'),
										'dop'=>$publish_date,
										'c_date'=> date('Y-m-d H:i:s')
									);
					$query = $this-> db->insert('tbl_ro_dop', $values1);
				}
				if($values['ro_type']=="P")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					foreach($publish_date as $dates)
					{
						$values1 = array(
										'ro_id'=>$in_id,
										'paper_id'=>$dates['id'],
										'dop'=>$dates['dop'],
										'c_date'=> date('Y-m-d H:i:s')
									);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}
				
				if($values['ro_type']=="M")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
					foreach($publish_date as $dates)
					{
						$values1 = array(
							'ro_id'=>$in_id,
							'paper_id'=>$dates['id'],
							'dop'=>$dates['dop'],
							'c_date'=> date('Y-m-d H:i:s')
						);
						$query = $this-> db->insert('tbl_ro_dop', $values1);
					}
				}				
				
				$msg="5";
				echo $msg;						
				return;
			}
		}
		else
		{
			 $ad = $this->db->get_where('tbl_book_ads', array('id' => $id,'type_id'=>'3'));
       //  echo $this->db->last_query();
        //  die;
            $a=$ad->result();
            //echo "<pre>"; var_dump($a[0]->newspaper_id); die;
            $data['book_ad']=$a[0];
          //  echo "<pre>"; var_dump($data['book_ad']); die;
            $data['states']=$this->get_st($a[0]->newspaper_id,$a[0]->city);
          // echo $this->db->last_query();
         //die;
      //  echo "<pre>"; var_dump($data['book_ad']); die;

            $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
            INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
            INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
            $data['newspapers']= $query->result();
            $dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id,'bill_status' =>'N','letter_status!=' =>'CCL'));
            $data['dops']=$dops->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
		//	echo '<pre>'; var_dump($data['clients']); die;
			$data['go']= $go;
			
			$where=array(
				"client_id"=>$data['book_ad']->u_id,
				"type_id"=>3,
				"cat_id"=>$data['book_ad']->cat_id,
				"newspaper_id"=>$data['book_ad']->paper_city_id
			);
            $query=$this->db->query("select * from tbl_discount where client_id='".$data['book_ad']->u_id."' and type_id='3' and cat_id='".$data['book_ad']->cat_id."' and newspaper_id='".$data['book_ad']->paper_city_id."'");
           // echo $this->db->last_query();
            $ds=$query->row();
            
            $data['discount_percentage']=$ds->discount_percentage;
//	$data['discount_percentage']=$this->site_model->get_data("tbl_discount",$where,"discount_percentage")[0]['discount_percentage'];
		
			$query = $this->db->get('tbl_employee');
			$data['employees']= $query->result();
	//	echo '<pre>'; var_dump($data); die;
			$this->load->view('admin/header');
			$this->load->view('admin/hd_ro_billing',$data);
			$this->load->view('admin/footer');
		}
	}
	 public function get_st($n_id,$c_id){
        $where=array('tbl_paper_city.paper_id'=>$n_id , 'tbl_paper_city.city_id'=>$c_id);
        $this->db->select('tbl_news_group.ng_id');
        $this->db->from('tbl_newspapers');
        $this->db->join('tbl_paper_city', 'tbl_newspapers.id = tbl_paper_city.paper_id');
        $this->db->join('tbl_news_group', 'tbl_newspapers.g_id = tbl_news_group.ng_id');
      
        $this->db->where($where);
       
        $query = $this->db->get();
        //echo $this->db->query();
        //die;
        // $this->db->select('tbl_paper_city.paper_id');
        // $this->db->from('tbl_paper_city');
        // $this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_paper_city.paper_id');
        // $this->db->where(['id'=>$newspaper_id]);
        // $query = $this->db->get();
        $ng_id=$query->row()->ng_id;
        //echo $ng_id;
        $this->db->select('states.id,states.name');
        $this->db->from('tbl_news_group_details');
        $this->db->join('states', 'states.id = tbl_news_group_details.state');
        $this->db->where(['tbl_news_group_details.newsgroup_id'=>$ng_id]);
        $result=$this->db->get();
        return ($result->result());
    }

	public function fm_edit($id,$go="")
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
			$this->load->view('admin/fm_ro_billing',$data);
			$this->load->view('admin/footer');
		}
	}

	public function update_discount(){
	
		$where=array(
			"client_id"=>$_POST['client_id'],
			"type_id"=>$_POST['type_id'],
			"cat_id"=>$_POST['cat_id'],
			"newspaper_id"=>$_POST['newspaper_id']
		);
		$result=$this->db->where($where)->get("tbl_discount");
	
		if($result->num_rows()){
			$this->db->where($where);
			$this->db->update('tbl_discount', $_POST);
		}else{
			$this->db->insert("tbl_discount",$_POST);
		}
		
	}

	public function temp_save()
	{		
		$type_id=$this->input->post('type_id');
		$query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper_id')));
		$ng= $query->row();
		$query = $this->db->where(['ro_no'=>$this->input->post('ro_no')])->get('tbl_bill_temp');
		if($query->num_rows()){
			//echo "exists"; return;
			$values = array(
				'ro_id'=>$this->input->post('ro_id'),
				'work_year'=>$this->input->post('work_year'),
				'client_id' => $this->input->post('client_id'),
				'emp_id' =>  $_SESSION['admin']['id'],
				'newspaper_id' =>$ng->paper_id,
				'type_id'=>$this->input->post('type_id'),
				'cat_id' =>$this->input->post('cat_id'),
				'insertion' => $this->input->post('insertion'),
				'size_words' => $this->input->post('size_words'),
				'min_w' => $this->input->post('min_w'),
				'price' => $this->input->post('price'),
				'eprice' => $this->input->post('eprice'),
				'height' => $this->input->post('height'),
				'width' => $this->input->post('width'),
				'amount' =>$this->input->post('amount') ,
				'scheme'=>$this->input->post('scheme'),
				'pack' =>$this->input->post('pack'),
				'premimum' =>$this->input->post('premimum') ,
				'extra_price' => $this->input->post('extra_price'),
				'add_on_amount' => $this->input->post('add_on_amount'),
				'dis_per' => $this->input->post('dis_per'),
				'discount' => $this->input->post('discount'),
				'Free' => $this->input->post('Free'),
				'Paid' => $this->input->post('Paid'),
				'size_type' => $this->input->post('size_type'),
				'box_charges' => $this->input->post('box_charges'),
				'payable_amount' => $this->input->post('payable_amount'),
				'ro_date' => $this->input->post('ro_date'),
				'p_date' => $this->input->post('p_date')
			);		

			$this->db->where(array("ro_no"=>$this->input->post('ro_no'),'work_year'=>$this->input->post('work_year')))->update('tbl_bill_temp',$values);
	//	var_dump($this->db->last_query()); return;
		}
		else{
		    
			$values = array(
			   // 'bill_id'=>$result->id,
				'ro_id'=>$this->input->post('ro_id'),
				'work_year'=>$this->input->post('work_year'),
				'ro_no' => $this->input->post('ro_no'),
				'client_id' => $this->input->post('client_id'),
				'emp_id' =>  $_SESSION['admin']['id'],
				'newspaper_id' =>$ng->paper_id,
				'type_id'=>$this->input->post('type_id'),
				'cat_id' =>$this->input->post('cat_id'),
				'insertion' => $this->input->post('insertion'),
				'size_words' => $this->input->post('size_words'),
				'min_w' => $this->input->post('min_w'),
				'price' => $this->input->post('price'),
				'eprice' => $this->input->post('eprice'),
				'height' => $this->input->post('height'),
				'width' => $this->input->post('width'),
				'amount' =>$this->input->post('amount') ,
				'scheme'=>$this->input->post('scheme'),
				'pack' =>$this->input->post('pack'),
				'premimum' =>$this->input->post('premimum') ,
				'extra_price' => $this->input->post('extra_price'),
				'add_on_amount' => $this->input->post('add_on_amount'),
				'dis_per' => $this->input->post('dis_per'),
				'discount' => $this->input->post('discount'),
				'Free' => $this->input->post('Free'),
				'Paid' => $this->input->post('Paid'),
				'size_type' => $this->input->post('size_type'),
				'box_charges' => $this->input->post('box_charges'),
				'payable_amount' => $this->input->post('payable_amount'),
				'ro_date' => $this->input->post('ro_date'),
				'p_date' => $this->input->post('p_date')
			);							
			$this->db->insert('tbl_bill_temp', $values);
		
		    
		}
// 		if($type_id==1 or $type_id==2)
// 		{
		$this->db->select('tbl_bill_temp.*,tbl_newspapers.name as newspaper_title');
		$this->db->from('tbl_bill_temp');
	//	$this->db->join('tbl_paper_city', 'tbl_paper_city.paper_id = tbl_bill_temp.newspaper_id');
		$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_temp.newspaper_id');
	//	$this->db->join('tbl_categories', 'tbl_categories.id = tbl_bill_temp.cat_id');
		 $this->db->where(['emp_id'=> $_SESSION['admin']['id']]);
		  $this->db->where(['client_id'=> $this->input->post('client_id')]);
		  // $this->db->where(['work_year'=> $this->input->post('work_year')]);
		  //  $this->db->where(['bill_id'=> 0]);
		  	$result = $this->db->get()->result();  
// 		}
// 		else if($type_id==3)
// 		{
// 		    $this->db->select('tbl_bill_temp.*,tbl_newspapers.name as newspaper_title,tbl_position.position as cat_title');
// 		$this->db->from('tbl_bill_temp');
// 	$this->db->join('tbl_paper_city', 'tbl_paper_city.paper_id = tbl_bill_temp.newspaper_id');
// 		$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_temp.newspaper_id');
// 		$this->db->join('tbl_position', 'tbl_position.id = tbl_bill_temp.cat_id');
// 		 $this->db->where(['emp_id'=> $_SESSION['admin']['id']]);
// 		   $this->db->where(['client_id'=> $this->input->post('client_id')]);
// 		 //  $this->db->where(['work_year'=> $this->input->post('work_year')]);
// 		     $this->db->where(['bill_id'=> 0]);
// 		   $result = $this->db->get()->result(); 
// 		}
	//	echo $this->db->last_query();
	

		echo json_encode($result);	
	}


	
	public function set_temp_details()
	{ 
	    $dop=$this->input->post('p_date');
		    $ro_id=$this->input->post('ro_id');
		    $p_date=explode(',',$dop);
		    foreach($dop as $dt)
		    { 
		        $query=$this->db->query("select * from tbl_ro_dop where ro_id='$ro_id' and dop='".date('Y-m-d',strtotime($dt))."'");
		       
		        $result=$query->row();
		       
			$values = array(
			    'ro_main_id'=>$result->id,
				'ro_id'=>$this->input->post('ro_id'),
				'work_year'=>$this->input->post('work_year'),
				'ro_no' => $this->input->post('ro_no'),
		
				'emp_id' =>  $_SESSION['admin']['id'],
			
				'type_id'=>$this->input->post('type_id'),
				'paper_id' =>$this->input->post('paper_id'),
				'dop' => date('Y-m-d',strtotime($dt)),
				'rate' => $this->input->post('rate'),
				'erate' => $this->input->post('erate'),
				'insertion' => 1
			
			);							
			$this->db->insert('tbl_bill_temp_details', $values);
			
		    }
		    echo var_dump($dop).$this->db->last_query();
		   // echo $this->db->last_query();
//die;
	//	$this->db->insert('tbl_bill_temp_details', $_POST);
	
		
			
	}
	
	// public function get_bill_details(){
	// 	$this->db->select('tbl_bill_temp.*,tbl_newspapers.name as newspaper_title,tbl_categories.name as cat_title');
	// 	$this->db->from('tbl_bill_temp');
	// 	$this->db->join('tbl_paper_city', 'tbl_paper_city.id = tbl_bill_temp.newspaper_id');
	// 	$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_paper_city.paper_id');
	// 	$this->db->join('tbl_categories', 'tbl_categories.id = tbl_bill_temp.cat_id');
	// 	$this->db->where('emp_id',  $_SESSION['admin']['id']);
	// 	$result = $this->db->get()->result();
	// 	echo json_encode($result);
	// }
	
	public function edit_temp_save()
	{
		//echo '<pre>'; var_dump($_POST); die;
		 
		$query = $this->db->where(['ro_id'=>$this->input->post('ro_id')])->get('tbl_bill_temp');
		if($query->num_rows()){
			//echo "exists"; return;
			$values = array(
				'ro_id'=>$this->input->post('ro_id'),
				'client_id' => $this->input->post('client_id'),
			//	'emp_id' =>  $_SESSION['admin']['id'],
				'newspaper_id' =>$this->input->post('newspaper_id'),
				'cat_id' =>$this->input->post('cat_id'),
				'insertion' => $this->input->post('insertion'),
				'size_words' => $this->input->post('size_words'),
				'min_w' => $this->input->post('min_w'),
				'price' => $this->input->post('price'),
				'eprice' => $this->input->post('eprice'),
				'height' => $this->input->post('height'),
				'width' => $this->input->post('width'),
				'amount' =>$this->input->post('amount') ,
				'premimum' =>$this->input->post('premimum') ,
				'extra_price' => $this->input->post('extra_price'),
				'add_on_amount' => $this->input->post('add_on_amount'),
				'dis_per' => $this->input->post('dis_per'),
				'discount' => $this->input->post('discount'),
				'box_charges' => $this->input->post('box_charges'),
				'payable_amount' => $this->input->post('payable_amount'),
				'ro_date' => $this->input->post('ro_date'),
				'p_date' => $this->input->post('p_date')
			);		

			$this->db->where(["ro_id"=>$this->input->post('ro_id')])->update('tbl_bill_temp',$values);
			//var_dump($this->db->last_query()); return;
		}
		else{
			//echo "not exists"; return;
			$values = array(
				'ro_id'=>$this->input->post('ro_id'),
				'ro_no' => $this->input->post('ro_no'),
				'client_id' => $this->input->post('client_id'),
				'emp_id' =>  $_SESSION['admin']['id'],
				'newspaper_id' =>$this->input->post('newspaper_id'),
				'cat_id' =>$this->input->post('cat_id'),
				'insertion' => $this->input->post('insertion'),
				'size_words' => $this->input->post('size_words'),
				'min_w' => $this->input->post('min_w'),
				'price' => $this->input->post('price'),
				'eprice' => $this->input->post('eprice'),
				'height' => $this->input->post('height'),
				'width' => $this->input->post('width'),
				'amount' =>$this->input->post('amount') ,
				'premimum' =>$this->input->post('premimum') ,
				'extra_price' => $this->input->post('extra_price'),
				'add_on_amount' => $this->input->post('add_on_amount'),
				'dis_per' => $this->input->post('dis_per'),
				'discount' => $this->input->post('discount'),
				'box_charges' => $this->input->post('box_charges'),
				'payable_amount' => $this->input->post('payable_amount'),
				'ro_date' => $this->input->post('ro_date'),
				'p_date' => $this->input->post('p_date')
			);							
			$this-> db->insert('tbl_bill_temp', $values);
			//var_dump($this->db->last_query()); return;	
		}
		
		//$result=$this->db->get("tbl_bill_temp");
		$this->db->select('tbl_bill_temp.*,tbl_client.client_name as client_name,tbl_newspapers.name as newspaper_title,tbl_categories.name as cat_title');
		$this->db->from('tbl_bill_temp');
		$this->db->join('tbl_client', 'tbl_client.id = tbl_bill_temp.client_id');
		$this->db->join('tbl_newspapers', 'tbl_newspapers.id = tbl_bill_temp.newspaper_id');
		$this->db->join('tbl_categories', 'tbl_categories.id = tbl_bill_temp.cat_id');
        $this->db->where(['emp_id'=> $_SESSION['admin']['id']]);
		$result = $this->db->get();
		echo json_encode($result->result()); 
		//echo '<pre>'; var_dump($_POST); return;				
		
	}


	public function text_client_bill_edit($id)
	{			
		$ad = $this->db->get_where('tbl_book_ads', array('id' => $id));
		$a=$ad->result();
		$data['book_ad']=$a[0];
		
		$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
		INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
		INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");

		$data['newspapers']= $query->result();
		
		$dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
		$data['dops']=$dops->result();
								
		$query = $this->db->get('tbl_client');
		$data['clients']= $query->result();
		
		$query = $this->db->get('tbl_employee');
		$data['employees']= $query->result();
		//echo '<pre>'; var_dump($data['dops']); die;
		$this->load->view('admin/header');
		$this->load->view('admin/text_client_bill_edit',$data);
		$this->load->view('admin/footer');
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
}
?>