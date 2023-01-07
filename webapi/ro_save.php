<?php
 require "config.php";
$u_id      =$_REQUEST['u_id'];        //client id;
$client    =$_REQUEST['client'];       //client name;
$newspaper = $_REQUEST['newspaper']; //publication id;
$cat_id     =$_REQUEST['cat_id'];     //heading
$inse       = $_REQUEST['inse'];        //insertion
$state      = $_REQUEST['state'];
$type_id    = $_REQUEST['type_id'];
$dates      = $_REQUEST['dates'];

 $a_dates    =$_REQUEST['a_dates'];
$a_newspaper=array($_REQUEST['a_newspaper']); // array of add on newspaper;
$book_date  = '2020-02-05';//  $_REQUEST['book_date'];

//$dates     =array("04-03-2019","07-03-2019");
$w_count1  =$_REQUEST['w_count1']; // no. of words.
$add_on     =$_REQUEST['add_on']; // id add_on is on /off value should be 1/0; 
$free_days  =$_REQUEST['free_days']; //free_days
$prem_id    =$_REQUEST['prem_id'];
$scheme_id  =$_REQUEST['scheme_id'];
$paid_days  =$_REQUEST['paid_days']; //paid days
//$p_type=$_REQUEST['p_type'];
 $premimum   = $_REQUEST['premimum'];
$pack       =$_REQUEST['pack'];// package id
$package    =$_REQUEST['package'];// package value;

$matter     =$_REQUEST['matter'];
$base_id     =0;
$rate1=array();
	 function save()
	{
		if (!empty($this->input->post())) 
		{
		   
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'No. of words', 'required');
		//	$this->form_validation->set_rules('matter', 'Matter', 'required');
		//	$this->form_validation->set_rules('employee', 'Employee', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
			    
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
				$query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
				$ng= $query->row();
				 $query1=$this->db->get_where('tbl_newspapers',array('id'=>$ng->paper_id));
            $gid=$query1->row();
				if($this->input->post('premimum') !=null)
				{
					$premimum=implode(",",$this->input->post('premimum'));
				}
				else
				{
					$premimum="";
				}
				
				
			  $values = array(
			      'book_id'=>$this->input->post('book_id'),
			       'ngb_id' =>$gid->g_id,
                'ro_no' => 0,
                'work_year'=>$_SESSION['work_year'],
                'u_id' => $this->input->post('client'),
                'e_id' => $_SESSION['admin']['id'],
                'newspaper_id' => $ng->paper_id,
                'state_id' =>$this->input->post('state_id'),
                'pub_id' => $this->input->post('pub_id'),
                'paper_city_id' => $this->input->post('newspaper'),
                'content' => $this->input->post('matter'),
                'uploaded_file'=>$upload_file_name,
                'type_id' => 1,
                'cat_id' => $this->input->post('cat'),
                'sub_heading' => $this->input->post('sheading'),
                'package' => $this->input->post('pack'),
                'insertion' => $this->input->post('inse'),
                'scheme' => $this->input->post('scheme'),
                'material' => $this->input->post('material'),
                'party' => $this->input->post('party'),
                'box' => $this->input->post('box'),
                'premimum' =>$premimum,
                'remark' => $this->input->post('remark'),
                'price' => $this->input->post('price'),
                'ex_price' => $this->input->post('eprice'),
                'ad_cost' => $this->input->post('p_amount'),
                't_amount' => $this->input->post('t_amount'),
                'dis_per' => $this->input->post('dis'),
                'discount' => $this->input->post('dis_a'),
                'city' => $ng->city_id,
                'size_words' => $this->input->post('w_count'),
                'unit'=>$this->input->post('unit'),
                'tax' => 0,
                'publish_day'=> $this->input->post('inse'),
                'other_day_f'=> $this->input->post('ndfc'),
                'ro_type' => $this->input->post('ro_type'),
                'comm1' => $this->input->post('comm1'),
                'comm2' => $this->input->post('comm2'),
                'comm3' => $this->input->post('comm3'),
                'comm4' => $this->input->post('comm4'),
                'comm5' => $this->input->post('comm5'),
                'comm6' => $this->input->post('comm6'),
                'comm7' => $this->input->post('comm7'),
                'comm8' => $this->input->post('comm8'),
                'box_charge'=>$this->input->post('box'),
                'add_on_a'=>$this->input->post('add_a'),
                'igst'=>$this->input->post('igst'),
                'cgst'=>$this->input->post('cgst'),
                'sgst'=>$this->input->post('sgst'),
                'book_date'=>date('Y-m-d'),
                'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
                'c_date' => date('Y-m-d H:i:s')
            );								
	
	
$inse_dop = $this->input->post('dop_inse');
$free_days=$this->input->post('free_days');
$dop_amt = ($values['t_amount'] - ($values['t_amount'] * $values['dis_per'])/100)/ ($inse_dop);
$dop_amt_a = ($values['add_on_a']- ($values['add_on_a']*$values['dis_per'])/100)/($inse_dop);

         $publish_date=array($this->input->post('p_date'));
         
      //  echo var_dump($publish_date);
                $odf=$this->input->post('odf');

                if($values['ro_type']=="N" && $odf==0)
                {
                   foreach($publish_date as $dates)
                    {
                        $days=explode(", ",$dates);
                         
                        $c=count($days);
                        
                        if($c < $values['insertion'])
                        {
                            $msg="2";
                            echo $msg;						
                            return;
                        }
                    }
                }
                 
                if($values['ro_type']=="P" && $odf==0)
                {
                    foreach($publish_date as $dates)
                    {
                        $days=explode(", ",$dates);
                         
                        $c=count($days);
                        
                        if($c < $values['insertion'])
                        {
                            $msg="2";
                            echo $msg;						
                            return;
                        }
                    }
                }

               if($values['ro_type']=="M" && $odf==0)
                {
                    foreach($publish_date as $dates)
                    {
                        foreach($dates as $row){
                        $days=explode(", ",$row['dop']);
                         //echo var_dump($days);
                        $c=count($days);
                        //echo $c;
                        if($c < $values['insertion'])
                        {
                            $msg="2";
                            echo $msg;						
                            return;
                        }
                        }
                    }
                }


               $query = $this->db->get_where('tbl_client', array('id' => $values['u_id']));
                $client= $query->row();

                if(($client->credit_bal+$values['ad_cost'])>$client->credit_limit)
                {
                    $values['pending']='P';
                }
                else
                {
                    $values['pending']='C';
                    $bal=$client->credit_bal+$values['ad_cost'];
                    $values1 = array('credit_bal' =>$bal);
                    $this->db->update('tbl_client',$values1, "id =".$client->id);
                }


                //$values['tax_a']=$ro_a*$values['tax']/100;

                $values['p_amount']=$values['ad_cost'];

                //				$ro_no=ro_no_gen("NP");
                //				$values['ro_no']=$ro_no;
                $in_id=0;
                if($values['ro_type']=="N")
                {
                    $query = $this-> db->insert('tbl_book_ads_temp', $values);
                    $in_id=$this->db->insert_id();

                   foreach($publish_date as $dates)
                    {
                        $d=explode(", ",$dates);
                          $i=0;
                         foreach($d as $dd){
                           
                             if($i< $inse_dop)
                             {
                                 $dop_amount= $dop_amt;
                             }
                             else
                             {
                                 $dop_amount= 0;
                             }
                         $values1 = array(
                            'ro_id'=>$in_id,
                            'ro_no'=>0,
                            'work_year'=>$_SESSION['work_year'],
                            'paper_id'=>$dates['id'],
                            'dop'=>$dd,
                            'dop_amount'=>$dop_amount,
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop_temp', $values1);
                    $i++;
                    //  echo $this->db->last_query();
                         }
                    }
                  
                }
                if($values['ro_type']=="P")
                {
                    $query = $this-> db->insert('tbl_book_ads_temp', $values);
                    $in_id=$this->db->insert_id();
                    
 foreach($publish_date as $dates)
                    {
 foreach($dates as $row)
                        {
                        $d=explode(", ",$row['dop']);
                    
                         $i=0;
                         foreach($d as $dd)
                         {
                             if($i < $inse_dop)
                             {
                               
                                 if($row['id'] == $values['newspaper_id'])
                                 {
                                     $dop_amount = $dop_amt;
                                 }
                                 else
                                 {
                                     $dop_amount = $dop_amt_a;
                                 }
                              
                             }
                             else
                             {
                               
                                 $dop_amount = 0;
                             }
                         $values1 = array(
                            'ro_id'=>$in_id,
                            'ro_no'=>0,
                            'work_year'=>$_SESSION['work_year'],
                            'paper_id'=>$dates['id'],
                            'dop'=>$dd,
                            'dop_amount'=>$dop_amount,
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop_temp', $values1);
                    $i++;
                         }
                    }
                  
                }
}
                if($values['ro_type']=="M")
                {
                    $query = $this-> db->insert('tbl_book_ads_temp', $values);
               
                    $in_id=$this->db->insert_id();
                   
                  foreach($publish_date as $dates)
                    {
 foreach($dates as $row)
                        {
                        $d=explode(", ",$row['dop']);
                    
                         $i=0;
                         foreach($d as $dd)
                         {
                             if($i < $inse_dop)
                             {
                               
                                 if($row['id'] == $values['newspaper_id'])
                                 {
                                     $dop_amount = $dop_amt;
                                 }
                                 else
                                 {
                                     $dop_amount = $dop_amt_a;
                                 }
                              
                             }
                             else
                             {
                               
                                 $dop_amount = 0;
                             }
                         $values1 = array(
                            'ro_id'=>$in_id,
                            'ro_no'=>0,
                            'work_year'=>$_SESSION['work_year'],
                            'paper_id'=>$row['id'],
                            'dop'=>$dd,
                            'dop_amount'=>$dop_amount,
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop_temp', $values1);
               
                    $i++;
                         }
                    }
                    
                  
                }	
                }
                /* update ro number into tbl_ro_no if ro number is greater than previous into same working year */
              

               
                $book_ads=$this->db->query("SELECT tbl_book_ads_temp.*, n.name as newspaper_name, t.name as type_name, po.name as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads_temp
INNER JOIN tbl_ro_dop_temp d ON d.ro_id=tbl_book_ads_temp.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads_temp.type_id
INNER JOIN tbl_categories po ON po.id=tbl_book_ads_temp.cat_id
INNER JOIN tbl_client u ON u.id=tbl_book_ads_temp.u_id WHERE tbl_book_ads_temp.id='".$in_id."'");

    $book_ad= $book_ads->result();

                echo json_encode($book_ad);
                return;
//redirect("admin/book_ads");
            }
        }
         
         
         echo json_encode($json);
  
?>
	}