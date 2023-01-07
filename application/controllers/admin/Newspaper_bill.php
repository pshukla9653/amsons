<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newspaper_bill extends CI_Controller
{ 
	function __construct()
	{		
		parent::__construct();
		if(!isset($this->session->userdata['admin']))
		{ 
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
INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id LIKE '%".$name."%' OR c.client_name LIKE '%".$name."%'");

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
			$query = $this->db->query("SELECT tbl_publication_bill.*, p.ng_name FROM tbl_publication_bill
INNER JOIN tbl_news_group p ON p.ng_id=tbl_publication_bill.publication");

			$config["base_url"] = base_url(). "admin/newspaper_bill/index";
			$config["total_rows"] = $query->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;

			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$query = $this->db->query("SELECT tbl_publication_bill.*, p.ng_name FROM tbl_publication_bill
INNER JOIN tbl_news_group p ON p.ng_id=tbl_publication_bill.publication where tbl_publication_bill.work_year='".$_SESSION['work_year']."' order by tbl_publication_bill.id desc ");//limit {$config['per_page']} offset {$page}
			$data['bills']= $query->result();
		}		

	//	$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
	//	$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/newspaper_bill_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function get_ro()
	{
		if (!empty($this->input->post())) 
		{	
		//	$this->form_validation->set_rules('ro_no', 'Ro No', 'required');
			$this->form_validation->set_rules('bill_a', 'Bill Amount', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{	
			    $dop1=date_create($this->input->post('dop'));
				$ro_no=$this->input->post('ro_no');
		
				$bill_a=$this->input->post('bill_a');
			    $gid=$this->input->post('publication');
			
				$year=$_SESSION['work_year'];
				  $b_date=$this->input->post('b_date');
			         $b_date=date('Y-m-d',strtotime($b_date));
        	  
                 if($dop1!='' && $ro_no =='')
                 
        		{
        		     $dop=date_format($dop1,"Y-m-d");
			    $dop2=date_format($dop1,"Y-m-d");
        		    
        		    
        		    // `tbl_book_ads`.`work_year`='".$year."' and  t.news_bill_status='N'
        		    $query = $this->db->query("SELECT t.*,s.state_id , n.name as newspaper_name FROM `tbl_ro_dop` t  LEFT outer JOIN tbl_book_ads s on  s.id=t.ro_id INNER JOIN tbl_newspapers n ON n.id=t.paper_id WHERE n.g_id='$gid' and t.dop<='$b_date'  and (t.dop='$dop' or t.dop='$dop2' ) ");
        		    
        		$ro= $query->result();
        			
        				if(empty($ro))
        				{
        					$msg="2";
        					echo $msg;
        					return;
        				}
        				else
        				{  
        				    	
        			
        					$ro_dop = $ro;
        				
        					$ro_dops= $ro;
        					
        					$data['ro']=$ro;
        					$data['ro_dops']=$ro_dops;
        					
        					echo json_encode($ro_dops);
        					return;
        			
        				}
        		    
        		}
                else  if($ro_no!='')
                		{
                		    
		        		   // and t.news_bill_status='N'
                                                 $ro_dop = $this->db->query("SELECT t.*,s.state_id , n.name as newspaper_name FROM `tbl_ro_dop` t  LEFT outer JOIN tbl_book_ads s on  s.id=t.ro_id INNER JOIN tbl_newspapers n ON n.id=t.paper_id WHERE n.g_id='$gid' and t.dop<='".$b_date."' and t.ro_no = '".$ro_no."'  " );
												 //and news_bill_status='N'
												  				 	$ro_dops= $ro_dop->result();
                            				
                            					$data['ro']=$ro;
                            					$data['ro_dops']=$ro_dops;
                            					
                            					echo json_encode($ro_dops);
                             					return;
                			            
                		}
                		else
                		{
                		  	$msg="2";
                					echo $msg;
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
		public function get_ro1()
	{
		if (!empty($this->input->post())) 
		{	
		//	$this->form_validation->set_rules('ro_no', 'Ro No', 'required');
			$this->form_validation->set_rules('bill_a', 'Bill Amount', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{	
			    $dop1=date_create($this->input->post('dop'));
				$ro_no=$this->input->post('ro_no');
		
				$bill_a=$this->input->post('bill_a');
			    $gid=$this->input->post('publication');
				$year=$_SESSION['work_year'];
			    $dop=date("Y-m-d",strtotime($this->input->post('dop')));
			    $dop2=date("Y-m-d",strtotime($this->input->post('dop')));
                 if($dop1!='' && $ro_no =='')
                 
        		{
        		    
        		    
        		    
        		    // `tbl_book_ads`.`work_year`='".$year."' and  t.news_bill_status='N'
        		    $query = $this->db->query("SELECT t.*,s.state_id , n.name as newspaper_name FROM `tbl_ro_dop` t  LEFT outer JOIN tbl_book_ads s on  s.id=t.ro_id INNER JOIN tbl_newspapers n ON n.id=t.paper_id WHERE n.g_id='$gid'  and (t.dop<='$dop' or t.dop<='$dop2') and news_bill_status='N'");
        		   // echo $this->db->last_query();
        		   //die;
        		$ro= $query->result();
        			
        				if(empty($ro))
        				{
        					$msg="2";
        					echo $msg;
        					return;
        				}
        				else
        				{  
        				    	
        			
        				//	$ro= $query->row();
        				/*	if($bill_a > $ro->p_amount )
        					{
        						$msg="3";
        						echo $msg;
        						return;
        					}*/
        				
        					$ro_dop = $ro;
        				
        					$ro_dops= $ro;
        					
        					$data['ro']=$ro;
        					$data['ro_dops']=$ro_dops;
        					
        					echo json_encode($ro_dops);
        					return;
        			
        				}
        		    
        		}
                else  if($ro_no!='')
                		{
                		   // and t.news_bill_status='N'
                                                 $ro_dop = $this->db->query("SELECT t.*,s.state_id , n.name as newspaper_name FROM `tbl_ro_dop` t  LEFT outer JOIN tbl_book_ads s on  s.id=t.ro_id INNER JOIN tbl_newspapers n ON n.id=t.paper_id WHERE n.g_id='$gid' and t.ro_no = '".$ro_no."'   " );
                                                  				 	$ro_dops= $ro_dop->result();
                            					
                            					$data['ro']=$ro;
                            					$data['ro_dops']=$ro_dops;
                            					
                            					echo json_encode($ro_dops);
                             					return;
                			            
                		}
                		else
                		{
                		  	$msg="2";
                					echo $msg;
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
	public function get_state($newspaper_id=null)
{
    $newspaper_id=$_POST['newspaper_id'];
   $re= $this->db->query("SELECT * FROM `tbl_news_group` t INNER JOIN tbl_news_group_details s on s.newsgroup_id=t.ng_id INNER join states u on u.id=s.state WHERE t.ng_id='".$newspaper_id."' ");
   $data=$re->result();
   echo json_encode($data);
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
			
		if(!empty($this->input->post()))
		{
		    
			$this->form_validation->set_rules('publication', 'Publication', 'required');			
			$this->form_validation->set_rules('b_date', 'Bill Date', 'required');
			$this->form_validation->set_rules('bill_no', 'Bill No', 'required');
			$this->form_validation->set_rules('bill_a', 'Bill Amount', 'required');			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['publications']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/newspaper_bill_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
			    
				$b_date=date_create($this->input->post('b_date'));
				$dop=($this->input->post('dop'));
				 $dop_r=$this->input->post('p_dop_ro');
			
	        	$state=$this->input->post('state');
	        	$bill_amount=$this->input->post('bill_a');
	        	$gst_b=$this->input->post('gst');
	        	$sgst_b=$this->input->post('sgst');
	        	$igst_b=$this->input->post('igst');
	        	$billamount=$this->input->post('billamount');
	        	$remark=$this->input->post('remark');
	        	$billNo=$this->input->post('bill_no');
	        //	$slip_no=$this->input->post('slip_no');
	        	$query=$this->db->query("select * from tbl_running_year");
                                $year=$query->result();
                               //$billsession=$work_year;
                                $bill_date=date_format($b_date,"Y-m-d");
                                foreach($year as $y)
                                {
                                    if($y->from_date <= $bill_date and $bill_date <= $y->to_date  )
                                    {
                                        $billsession=$y->year;
                                    }
                                }
	        	$this->load->model("ro_model");
                $slip_no=$this->ro_model->gen_slip_no($billsession);
                $status=$this->input->post('status');
                if($status==1)
                {
                    $remark="OK";
                    
                }
                else
                {
                    $remark="Disputed";
                }
				$values = array(								
								'slip_no'=> $slip_no,
								'publication'=> $this->input->post('publication'),
								'bill_no'=> $this->input->post('bill_no'),
								'bill_amount'=> $this->input->post('bill_a'),
								'cgst'=>$this->input->post('gst'),
								'sgst'=>$this->input->post('sgst'),
								'igst'=>$this->input->post('igst'),
								'net_amount'=>$this->input->post('billamount'),
								'dated'=> date_format($b_date,"Y-m-d"),
								'dop'=> date("Y-m-d",strtotime($dop)),
								'ro_no'=> $this->input->post('ro_no'),
								'work_year'=>$_SESSION['work_year'],
								'emp_id'=>$_SESSION['admin']['id'],
								'add_no'=> $this->input->post('add_no'),
								'status'=> $status,
								'remark'=> $remark
							);						
			$query = $this-> db->insert('tbl_publication_bill', $values);
		
				$in_id=$this->db->insert_id();
				
				$ro_id=$this->input->post('ro_id');
			
				$ro_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop
INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$ro_id."'" );
				$ro_dops= $ro_dop->result();
				$count=count($dop_r);
				$query=$this->db->query("select * from tbl_news_group where ng_id='".$values['publication']."'");
				$newsRe=$query->row();
				$newspaper_name=$newsRe->ng_name;
				"select * from tbl_ledgers where master_id='".$values['publication']."' and group_id='1'";
				  	$result=$this->db->query("select * from tbl_ledgers where master_id='".$values['publication']."' and group_id='1'");
                                                                        						
                                                                                                    $re=$result->result();
                                                                                                    if(!empty($re))
                                                                                                    {
                                                                                                    foreach($re as $re1)
                                                                                                    {
                                                                                            					$ledger_id=$re1->ledger_id;
                                                                                                        
                                                                                                    }
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        	$values2 = array(
                                                                                            							'group_id'=>1,
                                                                                            							'master_id'=> $values['publication'],
                                                                                            							'ledger_name'=> $newspaper_name,
                                                                                            							'opening_balance'=>0,
                                                                                            							'editable'=>'no'
                                                                                            						);
                                                                                            						$ledger_id=$this->db->insert('tbl_ledgers', $values2)->insert_id;
                                                                                                    }
                                                                                                    
                
                                                                                        // echo $ledger_id ;  die;		
				$total = 0;
				foreach($_POST['dop_amount'] as $key54=>$row)
				{
				    
				    $total += $row;
				    
				}
				foreach($dop_r as $key=>$ro)
				{
				    	$ro_dop = $this->db->query("SELECT * FROM tbl_ro_dop  WHERE id = '".$ro."'" );
				$ro_dops= $ro_dop->result();
				    
					foreach ($ro_dops as $dop)
					{
						$rdate = date('Y-m-d',strtotime(str_replace('-','/',$dop->dop)));
					     
					    $dop_amount=$dop->dop_amount;
					     $bill=$dop->newspaper_bill_no;
        				        if($bill=="")
        				        {
        				            $billno=$values['bill_no'];
        				            
        				        }
        				        else
        				        {
        				            $billno=$bill.','.$values['bill_no'];
        				        }
        			    if($count==1)
					    
        				    { 
        				        $billed_amount=$dop->newspaper_billed_amount;
        				       $bill_amount =$_POST['bill_a'];
        				          $cities=implode(",",$this->input->post('cities[]'));
        				      //  $billed_amount1=	number_format(floatval($bill_amount)+floatval($billed_amount), 2, '.', '');
        				      //  $billed_amount1=	number_format(floatval($bill_amount),2)/count($dop_r);
        			         $billed_amount1 = str_replace(',','',number_format(($dop_amount/$total)*$bill_amount,2))+$billed_amount;
        				        if($remark=="OK")
        				        {
        				        $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='".$rdate."',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$dop->id."'");

        				        }
        				        else
        				        {
        				          $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='".$rdate."',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$dop->id."'");
        				        }
        				    }
        				    else
        				    { 
        				        $billed_amount=$dop->newspaper_billed_amount;
        				       // $billed_amount1=	number_format(floatval($dop_amount)+floatval($billed_amount), 2, '.', '');
        				         $bill_amount =$_POST['bill_a'];
        				         $billno =$_POST['bill_no'];
        				    
        				      //  $billed_amount1=	number_format(floatval($bill_amount),2)/count($dop_r);
        				      $billed_amount1 = str_replace(',','',number_format(($dop_amount/$total)*$bill_amount,2))+$billed_amount;
        				        if($remark=="OK")
        				        {
        				      //      echo "update tbl_ro_dop set news_bill_status='Y',p_bill_dop='".$rdate."',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$dop->id."'";
        				        //    die;
        				        $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='".$rdate."',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$dop->id."'");
        				        }
        				        else
        				        {
        				            $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='".$rdate."',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$dop->id."'");  
        				        }
        				    }
			
					
			
					    $first_date=date('Y-m-d',strtotime($dop->dop));
                         $second_date=date('Y-m-d',strtotime("2017-07-01")); 
                          $second_date1="01/07/2017"; 
                           $second_date2="01-07-2017";
                             $dop_amount=$dop->dop_amount;
                                $billed_amount=$dop->newspaper_billed_amount;
                          // $am=floatval($dop_amount)-floatval($billed_amount);
                            $am=number_format(floatval($dop_amount)-floatval($billed_amount), 2, '.', '');
                                if($first_date>=$second_date ){

                                    if($state==6){
                
                                       $cgst=number_format(((floatval($am)*(floatval(5)/2))/100), 2, '.', '');
                
                                        $sgst=number_format(((floatval($am)*(floatval(5)/2))/100), 2, '.', '');
                
                                        $igst=0;
                
                                    } else {
                
                                        $cgst=0;
                
                                        $sgst=0;
                
                                        $igst=number_format(((floatval($am)*floatval(5))/100), 2, '.', '');
                
                                    } 
                
                                }
                
                                else{
                
                                      $cgst=0;
                
                                        $sgst=0;
                
                                        $igst=0;
                
                                }
                               
                				 $a=($am+$cgst+$isgt+$sgst);
                				//	 echo $a;
                					 $amount=number_format(((floatval($am))+(floatval($cgst))+(floatval($isgt))+(floatval($sgst))), 2, '.', '');
					    
						$values1 = array(
						    	'ro_main_id'=>$ro,
								'p_bill_id'=>$in_id,
								'ro_id'=>$dop->ro_id,
								'ro_no'=>$dop->ro_no,
								'paper_id'=>$dop->paper_id,
								'dop_amount'=>$dop->dop_amount,
								'cgst'=>$cgst,
								'sgst'=>$sgst,
								'igst'=>$igst,
								'dop'=>$dop->dop,
								'amount'=>$a,
								'work_year'=>$dop->work_year
								
							);
						
						$query = $this-> db->insert('tbl_publication_bill_details', $values1);
						
							    if($ledger_id !="")
                                                                                            {
                                                                                            					$values = array(
                                                                                            						'group_id'=>1,
                                                                                            						'ledger_id'=> $ledger_id,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'cr',
                                                                                            						'amount'=>$billamount,
                                                                                            						'narration'=>"Bill generated for ".$newspaper_name."No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            				//	$this->site_model->insert_data('tbl_vouchers', $values); 
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            				//	 echo $this->db->last_query(); 
                                                                                            	//	echo $this->db->last_query();
                                                                                            
                                                                                            				
                                                                                            
                                                                                            					$values = array(
                                                                                            						'group_id'=>9,
                                                                                            						'ledger_id'=>16,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$bill_amount,
                                                                                            						'narration'=>"Advertisement Expense on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            			//	echo $this->db->last_query(); 
                                                                                            
                                                                                            				
                                                                                            					$values = array(
                                                                                            						'group_id'=>15,
                                                                                            						'ledger_id'=>13,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$igst_b,
                                                                                            						'narration'=>"IGST on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            			//	echo $this->db->last_query(); 
                                                                                            				
                                                                                            
                                                                                            				
                                                                                            					$values = array(
                                                                                            						'group_id'=>15,
                                                                                            						'ledger_id'=>14,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$gst_b,
                                                                                            						'narration'=>"CGST on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            		//	echo $this->db->last_query(); 
                                                                                            			
                                                                                            
                                                                                            			
                                                                                            					$values = array(
                                                                                            						'group_id'=>15,
                                                                                            						'ledger_id'=>15,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$sgst_b,
                                                                                            						'narration'=>"SGST on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            				//	 echo $this->db->last_query(); 
                                                                        						
                                                                                            }
				//	echo $this->db->last_query();
						
					}					
			//e();	
				 }				
				$this->session->set_flashdata('msg', 'Bill Successfully Added');
				redirect('admin/newspaper_bill');
//die();
			}
		}
		else
		{
		    $this->load->model("ro_model");
		$data['slip_no']=$this->ro_model->gen_slip_no($_SESSION['work_year']);
			
		  $query=$this->db->get('tbl_publication_bill');
	     $data['bills']=$query->result();
			  
			$query = $this->db->get('tbl_news_group');
			$data['publications']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/newspaper_bill_add',$data);
			$this->load->view('admin/footer');
		}
	}
		public function edit($id)
	{
		if(!empty($this->input->post()))
		{
			$this->form_validation->set_rules('publication', 'Publication', 'required');			
			$this->form_validation->set_rules('b_date', 'Bill Date', 'required');
			$this->form_validation->set_rules('bill_no', 'Bill No', 'required');
			$this->form_validation->set_rules('bill_a', 'Bill Amount', 'required');			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['publications']= $query->result();
			
				$this->load->view('admin/header');
				$this->load->view('admin/newspaper_bill_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$b_date=date_create($this->input->post('b_date'));
				$bill_id=$this->input->post('bill_id');
				$billdop=date_create($this->input->post('dop'));
				 $dop_r=$this->input->post('p_dop_ro');
			//	echo var_dump($dop_r);die;
	        	$state=$this->input->post('state');
	        	$bill_amount=$this->input->post('bill_a');
	        	$gst=$this->input->post('gst');
	        	$sgst=$this->input->post('sgst');
	        	$igst=$this->input->post('igst');
	        	$billamount=$this->input->post('billamount');
	        	$bill_no=$this->input->post('bill_no');
	        		$billNo=$this->input->post('bill_no');
	        	$work_year=$this->input->post('work_year');
	        	$query=$this->db->query("select * from tbl_running_year");
                                $year=$query->result();
                               //$billsession=$work_year;
                                $bill_date=date_format($b_date,"Y-m-d");
                                foreach($year as $y)
                                {
                                    if($y->from_date <= $bill_date and $bill_date <= $y->to_date  )
                                    {
                                        $billsession=$y->year;
                                    }
                                }
                $status=$this->input->post('status');
                if($status==1)
                {
                    $remark="OK";
                    
                }
                else
                {
                    $remark="Disputed";
                }
				$values = array(								
								'slip_no'=> $this->input->post('slip_no'),
								'publication'=> $this->input->post('publication'),
								'bill_no'=> $this->input->post('bill_no'),
								'bill_amount'=> $this->input->post('bill_a'),
								'cgst'=>$gst,
								'sgst'=>$sgst,
								'igst'=>$igst,
								'net_amount'=>$billamount,
								'dated'=> date_format($b_date,"Y-m-d"),
								'dop'=> date_format($billdop,"Y-m-d"),
								'ro_no'=> $this->input->post('ro_no'),
								'work_year'=>$work_year,
								'emp_id'=>$_SESSION['admin']['id'],
								'add_no'=> $this->input->post('add_no'),
								'status'=> $this->input->post('status'),
								'remark'=> $remark
							);						
				$query = $this-> db->update('tbl_publication_bill', $values,"id =".$bill_id);
			$result=$this->db->query("select * from tbl_ledgers where master_id='".$values['publication']."' and group_id='1'");
                                                                        						
                                                                                                    $re=$result->result();
                                                                                                    
                                                                                                    if(!empty($re))
                                                                                                    {
                                                                                                    foreach($re as $re1)
                                                                                                    {
                                                                                            					$ledger_id=$re1->ledger_id;
                                                                                                        
                                                                                                    }
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        	$values2 = array(
                                                                                            							'group_id'=>1,
                                                                                            							'master_id'=> $values['publication'],
                                                                                            							'ledger_name'=> $newspaper_name,
                                                                                            							'opening_balance'=>0,
                                                                                            							'editable'=>'no'
                                                                                            						);
                                                                                            		$ledger_id=$this->db->insert('tbl_ledgers', $values2)->insert_id;
                                                                                                    }
                                                                                                    
			$billedro=$this->input->post('billedro');
			foreach($billedro as $bid)
			{
				$robill = $this->db->query("SELECT * FROM tbl_ro_dop WHERE tbl_ro_dop.id = '".$bid."'");
				$roresult= $robill->row();
				if(!empty($roresult))
				{
				    $billval=$roresult->newspaper_bill_no;
				    $billarray=explode(',',$billval);
				   
				  $rr= array_diff( $billarray, $bill_no );
				    // echo var_dump($rr);
				      $newbill=implode(",",$rr);
				     // echo $newbill;
				      if($newbill==NULL)
				      {
				    
        			  $this->db->query("update tbl_ro_dop set news_bill_status='N',p_bill_dop='0',newspaper_billed_amount='0',newspaper_bill_no='' where id='".$roresult->id."'");
				      }
				      else
				      {
				      $dopamount=$roresult->dop_amount;
				      $billedamount=$roresult->newspaper_billed_amount;
        			  $billedamount1=	number_format(floatval($billedamount)-floatval($dopamount), 2, '.', '');
        			  $this->db->query("update tbl_ro_dop set newspaper_billed_amount='".$billedamount1."',newspaper_bill_no='$newbill', p_bill_dop = '$rdate', where id='".$roresult->id."'");  
				      }
				}
				
			
			}
				$this->db->query("delete from tbl_publication_bill_details where p_bill_id='$bill_id'");
				$count=count($dop_r);
				foreach($dop_r as $key=>$ro)
				{
				    	$ro_dop = $this->db->query("SELECT * FROM tbl_ro_dop  WHERE id = '".$ro."'" );
				$ro_dops= $ro_dop->result();
			
				    
			
					
			
			 
					foreach ($ro_dops as $dop)
					{
					     $dop_amount=$dop->dop_amount;
					     
					     $bill=$dop->newspaper_bill_no;
        				        if($bill=="")
        				        {
        				            $billno=$values['bill_no'];
        				            
        				        }
        				        else
        				        {
        				            $billno=$bill.','.$values['bill_no'];
        				        }
					    if($count==1)
					    
        				    { 
        				        $billed_amount=$dop->newspaper_billed_amount;
        				       
        				         
        				        $billed_amount1=	number_format(floatval($bill_amount)+floatval($billed_amount), 2, '.', '');
        				        if($remark=="OK")
        				        {
        				        $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='$rdate',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$ro."'");
        				       // echo $this->db->last_query();
        				        }
        				        else
        				        {
        				          $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='$rdate',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$ro."'");  
        				         // echo $this->db->last_query();
        				        }
        				    }
        				    else
        				    { $billed_amount=$dop->newspaper_billed_amount;
        				        $billed_amount1=	number_format(floatval($dop_amount)+floatval($billed_amount), 2, '.', '');
        				        if($remark=="OK")
        				        {
        				        $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop=='$rdate',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$ro."'");
        				      //  echo $this->db->last_query();
        				        }
        				        else
        				        {
        				            $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='$rdate',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$billno' where id='".$ro."'");  
        				           // echo $this->db->last_query();
        				        }
        				    }
					   // 	$first_date=$dop->dop;
                        //  $second_date="2017-07-01"; 
                          	$first_date=date('Y-m-d',strtotime($dop->dop));
                            $second_date=date('Y-m-d',strtotime("2017-07-01"));
                             $dop_amount=$dop->dop_amount;
                                $billed_amount=$dop->newspaper_billed_amount;
                           $am=floatval($dop_amount)-floatval($billed_amount);
                                if($first_date>=$second_date){

                                    if($state==6){
                
                                       $cgst=number_format(((floatval($am)*(floatval(5)/2))/100), 2, '.', '');
                
                                        $sgst=number_format(((floatval($am)*(floatval(5)/2))/100), 2, '.', '');
                
                                        $igst=0;
                
                                    } else {
                
                                        $cgst=0;
                
                                        $sgst=0;
                
                                        $igst=number_format(((floatval($am)*floatval(5))/100), 2, '.', '');
                
                                    } 
                
                                }
                
                                else{
                
                                      $cgst=0;
                
                                        $sgst=0;
                
                                        $igst=0;
                
                                }
                               
                				 $a=($am+$cgst+$isgt+$sgst);
                				//	 echo $a;
                					 $amount=number_format(((floatval($am))+(floatval($cgst))+(floatval($isgt))+(floatval($sgst))), 2, '.', '');
					    
						$values1 = array(								
								'p_bill_id'=>$bill_id,
								'ro_main_id'=>$dop->id,
								'ro_id'=>$dop->ro_id,
								'ro_no'=>$dop->ro_no,
								'paper_id'=>$dop->paper_id,
								'dop_amount'=>$dop->dop_amount,
								'cgst'=>$cgst,
								'sgst'=>$sgst,
								'igst'=>$igst,
								'dop'=>$dop->dop,
								'amount'=>$a,
								'work_year'=>$dop->work_year
								
							);
					
						$query = $this-> db->insert('tbl_publication_bill_details', $values1);
				$this->db->query("DELETE from tbl_vouchers where group_id= '1' and screen='Publication Bill' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '9' and screen='Publication Bill' and ledger_id='16' and screen_id='$bill_id'");
            		
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='13' and screen='Publication Bill' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='14' and screen='Publication Bill' and screen_id='$bill_id'");
            			$this->db->query("DELETE from tbl_vouchers where group_id= '15' and ledger_id='15' and screen='Publication Bill' and screen_id='$bill_id'");
            			
   if($ledger_id !="")
                                                                                            {
                                                                                            					$values = array(
                                                                                            						'group_id'=>1,
                                                                                            						'ledger_id'=> $ledger_id,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'cr',
                                                                                            						'amount'=>$billamount,
                                                                                            						'narration'=>"Bill generated for ".$newspaper_name."No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$bill_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            				//	$this->site_model->insert_data('tbl_vouchers', $values); 
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            				 //echo $this->db->last_query(); die;
                                                                                            	//	echo $this->db->last_query();
                                                                                            
                                                                                            				
                                                                                            
                                                                                            					$values = array(
                                                                                            						'group_id'=>9,
                                                                                            						'ledger_id'=>16,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$bill_amount,
                                                                                            						'narration'=>"Advertisement Expense on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$bill_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            			//	echo $this->db->last_query(); 
                                                                                            
                                                                                            				
                                                                                            					$values = array(
                                                                                            						'group_id'=>15,
                                                                                            						'ledger_id'=>13,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$igst_b,
                                                                                            						'narration'=>"IGST on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$bill_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            			//	echo $this->db->last_query(); 
                                                                                            				
                                                                                            
                                                                                            				
                                                                                            					$values = array(
                                                                                            						'group_id'=>15,
                                                                                            						'ledger_id'=>14,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$gst_b,
                                                                                            						'narration'=>"CGST on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$bill_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            		//	echo $this->db->last_query(); 
                                                                                            			
                                                                                            
                                                                                            			
                                                                                            					$values = array(
                                                                                            						'group_id'=>15,
                                                                                            						'ledger_id'=>15,
                                                                                            						'voucher_date'=> $bill_date,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$sgst_b,
                                                                                            						'narration'=>"SGST on Bill No: ".$billNo,
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$bill_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            				//	 echo $this->db->last_query(); 
                                                                        						
                                                                                            }
				//	echo $this->db->last_query();
						
					}					
		
				 }				
				$this->session->set_flashdata('msg', 'Bill updated Successfully Added');
				redirect('admin/newspaper_bill');
//die();
			}
		}
		else
		{
		    $this->load->model("ro_model");
	$query=$this->db->query("SELECT t.*,s.ng_name as Publication,u.state as State,v.name as StateName FROM `tbl_publication_bill` t INNER join tbl_news_group s on s.ng_id=t.publication INNER join tbl_news_group_details u on u.newsgroup_id=s.ng_id INNER join states v ON v.id=u.state where t.id='$id'");
		//	$query=$this->db->get_where('tbl_publication_bill',array('id' =>$id));
			$billdata=$query->row();
			$data['bills']=$billdata;
	  $slip_no=$billdata->id;
	    $this->db->join('tbl_ro_dop','tbl_ro_dop.id=tbl_publication_bill_details.ro_main_id');
	            $this->db->join('tbl_newspapers','tbl_newspapers.id=tbl_publication_bill_details.paper_id');
			  	$query=$this->db->get_where('tbl_publication_bill_details',array('p_bill_id' =>$slip_no));
			  //	echo $this->db->last_query();
			$data['billdetails']=$query->result();
			$query = $this->db->get('tbl_news_group');
			$data['publications']= $query->result();
	//	echo var_dump($data);
	//	die;
			$this->load->view('admin/header');
			$this->load->view('admin/newspaper_bill_edit',$data);
			$this->load->view('admin/footer');
		}
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
				if($this->input->post('bill_detail') ==null)
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{
					$days=$this->input->post('due_day')." days";
					$date=date_create();
					date_add($date,date_interval_create_from_date_string($days));
					$due_date=date_format($date,"Y-m-d");
					
					$values = array(								
								'client_id'=> $this->input->post('client'),
								'amount'=> $this->input->post('amount'),
								'box_charges'=> $this->input->post('box_c'),
								'total'=> $this->input->post('total'),
								'discount'=> $this->input->post('discount'),
								'at_work_charges'=> $this->input->post('at_work_c'),
								'net_amount'=> $this->input->post('net_amount'),
								'bill_date'=> date('Y-m-d'),
								'due_date'=> $due_date
							);
					$query = $this-> db->insert('tbl_bill', $values);
					$in_id=$this->db->insert_id();
					
					
					$bill_taxs=$this->input->post('bill_taxs');
					
					foreach($bill_taxs as $tax)
					{
						$values1 = array(										
										'bill_id'=>$in_id,
										'tax_id'=>$tax['id'],
										'tax_rate'=>$tax['rate'],
										'tax_name'=>$tax['name'],
										'tax_amount'=>$tax['tax_amt'],
										'c_date'=> date('Y-m-d H:i:s')
									);
						$query = $this-> db->insert('tbl_bill_taxes', $values1);
					}
					
					
					$bill_detail=$this->input->post('bill_detail');
					
					foreach($bill_detail as $ro)
					{
						//UPDATE `tbl_employee` SET `e_cr_limit`=`e_cr_limit`+'500' WHERE 1
						$values1 = array(										
										'bill_id'=>$in_id,
										'ro_id'=>$ro['ro_id'],
										'insertion'=>$ro['inse'],
										'heading'=>$ro['cat'],
										'pack'=>$ro['pack'],
										'scheme'=>$ro['scheme'],
										'premium'=>$ro['premimum'],
										'word_size'=>$ro['w_count'],
										'rate'=>$ro['price'],
										'amount'=>$ro['t_amount'],
										'c_date'=> date('Y-m-d')
									);
									
						if($ro['ro_type']=="N")
						{
							$values1['pub_date']=$ro['p_date'];
							$values1['paper']=$ro['newspaper'];
							
							$query = $this-> db->insert('tbl_bill_details', $values1);
						}
						else
						{
							foreach($ro['p_date'] as $dop)
							{
								$values1['pub_date']=$dop['dop'];
								$values1['paper']=$dop['id'];
							
								$query = $this-> db->insert('tbl_bill_details', $values1);
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
	public function import()
	{
	     $this->load->model("ro_model");
		$data['slip_no']=$this->ro_model->gen_slip_no($_SESSION['work_year']);
			
		  $query=$this->db->get('tbl_publication_bill');
	     $data['bills']=$query->result();
			  
			$query = $this->db->get('tbl_news_group');
			$data['publications']= $query->result();
				$this->load->view('admin/header');
			$this->load->view('admin/newspaper_import',$data);
			$this->load->view('admin/footer');
	    
	}
	 public function importFile(){
 
      if ($this->input->post('submit')) {
                // echo "newspaper";
             
//echo $_FILES["uploadFile"]["name"];
            $path = $_FILES["uploadFile"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
     $address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
     $postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
     $country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
     $data[] = array(
      'CustomerName'  => $customer_name,
      'Address'   => $address,
      'City'    => $city,
      'PostalCode'  => $postal_code,
      'Country'   => $country
     );
    }
   }
                    //echo var_dump($data);die();
                    redirect('admin/newspaper_bill');
                  }
        //	$this->load->view('admin/newspaper_import');
               
               
          
      }
                
    
     

	public function bill_print($id)
	{
		$query = $this->db->query("SELECT tbl_bill.*, c.city, c.client_name FROM tbl_bill
		INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id ='".$id."'" );
		$data['bill']= $query->row();
		
		
		$query = $this->db->get_where('tbl_bill_taxes', array('bill_id' => $id));
		$data['bill_taxes']= $query->result();
		
		
		
		
		$bill_detail = $this->db->query("SELECT tbl_bill_details.*, n.name as newspaper_name FRom tbl_bill_details
INNER JOIN tbl_newspapers n ON n.id=tbl_bill_details.paper
WHERE tbl_bill_details.bill_id='".$id."'
" );
				
		$bill_details= $bill_detail->result();
		$data['bill_details']=$bill_details;
		
		
		
				
		$this->load->view('admin/header');
		$this->load->view('admin/client_bill_print',$data);
		$this->load->view('admin/footer');
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
public function checkbill()
{
    $billno=$this->input->post('billno');
    $remark="";
    $billd=date('Y-m-d',strtotime($this->input->post('billdate')));
             $query=$this->db->query("select * from tbl_running_year");
                                $year=$query->result();
                               // $billsession=$work_year;
                                foreach($year as $y)
                                {
                                    if($y->from_date <= $billd and $billd <= $y->to_date  )
                                    {
                                        $wy=$y->year;
                                    }
                                }
             $query=$this->db->query("select bill_no from tbl_publication_bill where work_year='$wy'");
	     $bills=$query->result();
	   //  echo  $this->db->last_query();
	     $billarray=array();
           foreach($bills as $bn)
        {  $bn->bill_no;
            array_push($billarray, $bn->bill_no);
        }
	      if(in_array($billno,$billarray))
	      {
	          $slip_no=0;
	          $remark="Bill alreay exists";
	      }
	      echo json_encode($billarray);
}
	
}
?>