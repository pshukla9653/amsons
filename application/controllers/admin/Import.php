<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
				$this->load->model('excel_import_model');
		$this->load->library('excel');

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
        $this->load->view('admin/header');
        $this->load->view('admin/import');
        $this->load->view('admin/footer');		
    }
	
	
	public function import()
	{
		 if($_FILES['csv_file']['name']){
       {
			$path = $_FILES["csv_file"]["tmp_name"];
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
						'CustomerName'		=>	$customer_name,
						'Address'			=>	$address,
						'City'				=>	$city,
						'PostalCode'		=>	$postal_code,
						'Country'			=>	$country
					);
				}
				print_r($data);
				die;
				
			}
			$this->excel_import_model->insert($data);
			echo 'Data Imported successfully';
		}	
	}
	}
	

 public function year()
    {		
	
		     $this->load->model("ro_model");
		$data['slip_no']=$this->ro_model->gen_slip_no($_SESSION['work_year']);
			
		  $query=$this->db->get('tbl_publication_bill');
	     $data['bills']=$query->result();
			  
			$query = $this->db->get('tbl_news_group');
			$data['publications']= $query->result();
        $this->load->view('admin/header');
        $this->load->view('admin/year_import',$data);
        $this->load->view('admin/footer');		
    }
	
	
	public function year_import()
	{
		 if($_FILES['csv_file']['name']){
       {
		$path = $_FILES["csv_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $key=>$worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$ro_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$ro_date = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$ro_date = \PHPExcel_Style_NumberFormat::toFormattedString($ro_date, 'YYYY-MM-DD');
				
					$newspaper = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			
					$bill_no = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$date = \PHPExcel_Style_NumberFormat::toFormattedString($date, 'YYYY-MM-DD');
					$amount = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$igst = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$cgst = $worksheet->getCellByColumnAndRow(7, $row)->getCalculatedValue();
					$sgst = $worksheet->getCellByColumnAndRow(8, $row)->getCalculatedValue();
					$total_amount = $worksheet->getCellByColumnAndRow(9, $row)->getCalculatedValue();
					$data[] = array(
						'0'		=>	$ro_no,
						'1'			=>	$ro_date,
						'2'				=>	$newspaper,
						'3'		=>	$bill_no,
						'4'			=>	$date,
						'5'			=>	$amount,
						'6'			=>	$igst,
						'7'			=>	$cgst,
						'8'			=>	$sgst,
						'9'			=>	$total_amount
					);
					
					$data_array=$data;
				}
				
			}
 $mydata=array();

   
        $fields=array($data_array[0]);
    $status=0;
    $remark="";
	       foreach($data_array as $row)
        {
            $billd=date('Y-m-d',strtotime($row[4]));
        //    echo "select * from tbl_running_year where from_date <= '$billd' and '$billd' <= to_date";
          // die;
             $query=$this->db->query("select * from tbl_running_year where from_date <= '$billd' and $billd <= to_date");
                                $year=$query->row();
                               // $billsession=$work_year;
                             /*   $wy = '';
                                if(isset($row[4])){
                                foreach($year as $y)
                                {
                                    if($y->from_date <= $billd and $billd <= $y->to_date  )
                                    {
                                        $wy=$y->year;
                                    }
                                }
                                }*/
                            $wy = $year->year;
       
 $data=array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$wy); 
  array_push($mydata,$data);

    } 
  $filename = 'users_'.date('Ymd').'.csv'; 
  header("Content-Description: File Transfer"); 
  header("Content-Disposition: attachment; filename=$filename"); 
  header("Content-Type: application/csv; ");
   
  // get data 
  
  // file creation 
  $file = fopen('php://output', 'w');
 
  $header = array("Ro_No","Ro_Date","Newspaper","Bill_No","Date","Amount","IGST","CGST","SGST","Total Amaount","Year");
  fputcsv($file, $header);
  foreach ($mydata as $key=>$line){ 
     fputcsv($file,$line); 
  } fclose($file);
  
  
  
//  echo $updated." records added/updated successfully.";
     die;
        	redirect('admin/newspaper_bill/year_import');
        //echo $this->db->last_query();
    }	
	}
	}
	
    public function add()
    {	
   
       // $table=$this->input->post("veena");
        $updated=0;
        //die($table);
       /* if($_FILES['csv_file']['name']){
            //print_r($_FILES); die;
            $config['upload_path']   = './upload/csv/'; 
           // $config['allowed_types'] = 'csv/xls/xlsx'; 
            $config['max_size']      = (1024*2000); 
            // $config['max_width']     = 1024; 
            // $config['max_height']    = 768;  
            $upload_file_name="csv-".date("Y-m-d").".".end(explode(".",$_FILES['csv_file']['name']));
            $config['file_name'] = $upload_file_name;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('csv_file')){
                die($this->upload->display_errors());
            }
        }*/  
        /* Gather data from CSV and create an array */
    //    $f = fopen('./upload/csv/'.$upload_file_name, "rw");
        $data_array=array();
       /* $r=0;
        while (($line = fgetcsv($f)) !== false) {
            $c=0;
            foreach ($line as $cell) {
                $data_array[$r][$c]=htmlspecialchars($cell);
                $c++;
            }
            $r++;
        }
        fclose($f);*/
		
		
		$path = $_FILES["csv_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $key=>$worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$ro_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$ro_date = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$ro_date = \PHPExcel_Style_NumberFormat::toFormattedString($ro_date, 'YYYY-MM-DD');
				
					$newspaper = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			
					$bill_no = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$date = \PHPExcel_Style_NumberFormat::toFormattedString($date, 'YYYY-MM-DD');
					$amount = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$igst = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$cgst = $worksheet->getCellByColumnAndRow(7, $row)->getCalculatedValue();
					$sgst = $worksheet->getCellByColumnAndRow(8, $row)->getCalculatedValue();
					$total_amount = $worksheet->getCellByColumnAndRow(9, $row)->getCalculatedValue();
					$year = $worksheet->getCellByColumnAndRow(10, $row)->getCalculatedValue();
					$data[] = array(
						'0'		=>	$ro_no,
						'1'			=>	$ro_date,
						'2'				=>	$newspaper,
						'3'		=>	$bill_no,
						'4'			=>	$date,
						'5'			=>	$amount,
						'6'			=>	$igst,
						'7'			=>	$cgst,
						'8'			=>	$sgst,
						'9'			=>	$total_amount,
						'10'			=>	$year
					);
					
					$data_array=$data;
				}
				
			}
 $mydata=array();

   
        $fields=array($data_array[0]);
      //      unset($data_array[0]);
        //       echo var_dump($data_array);
        //  die;
        /* Insert or update query on array */
    $status=0;
    $remark="";
	       foreach($data_array as $row)
        {
            $billd=date('Y-m-d',strtotime($row[4]));
            /* $query=$this->db->query("select * from tbl_running_year");
                                $year=$query->result();
                               // $billsession=$work_year;
                                foreach($year as $y)
                                {
                                    if($y->from_date <= $billd and $billd <= $y->to_date  )
                                    {
                                        $wy=$y->year;
                                    }
                                }*/
			$wy = $row[10];					
             $query=$this->db->query("select bill_no from tbl_publication_bill where work_year='$wy'");
	     $bills=$query->result();
	   //  echo  $this->db->last_query();
	     $billarray=array();
           foreach($bills as $bn)
        {  $bn->bill_no;
            array_push($billarray, $bn->bill_no);
        }
          if(in_array($row[3],$billarray))
	      {
	          $slip_no=0;
	          $remark="Bill alreay exists";
	      }
      
	      else
	      { $checked=array();
                 $ro_no=$row[0];
                if($ro_no!="")
                 {
                        $ro_date=date('Y-m-d',strtotime($row[1]));
                        $ro_date1=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $row[1]) ) ));
                         $ro_date2=date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $row[1]) ) ));
                          $ro_date3=date('Y-m-d',(strtotime ( '+2 day' , strtotime ( $row[1]) ) ));
                           $ro_date4=date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $row[1]) ) ));
                        // $ro_date1;
               
                        $gid=$this->input->post('publication');
                      
                      
                        $query=$this->db->query("SELECT tbl_book_ads.* FROM tbl_book_ads WHERE tbl_book_ads.ro_no = '".$ro_no."' and (tbl_book_ads.book_date='".$ro_date."' or tbl_book_ads.book_date='".$ro_date1."'or tbl_book_ads.book_date='".$ro_date2."' or tbl_book_ads.book_date='".$ro_date3."'or tbl_book_ads.book_date='".$ro_date4."') and tbl_book_ads.ngb_id='".$gid."' ");
                 //   echo $this->db->last_query();
                      	// "</br>";
                        $roresult=$query->result();
                        if(!empty($roresult))
                        {
                            foreach($roresult as $ros)
                            {
                                 $gst=0;
                                $sgst=0;
                                $igst=0;
                                $am=0;
                                $a=0;
                                $rate1=0;
                    	        $limit=0;
                                $ratemin=0;
                                 $ratemax=0;
                                 	$dop_amount=0;
                                $billed_amount=0;
                                $rdate6=date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $row[4]) ) ));
                                $rdate7=date('Y-m-d',(strtotime ( '-5 day' , strtotime ( $row[4]) ) ));
                                $rdate8=date('Y-m-d',(strtotime ( '-6 day' , strtotime ( $row[4]) ) ));
                                $rdate=date('Y-m-d',strtotime($row[4]));
                                $rdate1=date('Y-m-d',strtotime($row[4]));
                                $rdate2=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $row[4]) ) ));
                                $rdate3=date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $row[4]) ) ));
                                $rdate4=date('Y-m-d',(strtotime ( '-3 day' , strtotime ( $row[4]) ) ));
                                $rdate5=date('Y-m-d',(strtotime ( '-4 day' , strtotime ( $row[4]) ) ));
                               
                                $state=$this->input->post('state');
                              //  echo "state".$state."</br>";
                                $ro_id=$ros->id;
                                $work_year=$ros->work_year;
                               
                                $query=$this->db->query("select * from tbl_running_year");
                                $year=$query->result();
                                $billsession=$work_year;
                                foreach($year as $y)
                                {
                                    if($y->from_date <= $rdate and $rdate <= $y->to_date  )
                                    {
                                        $billsession=$y->year;
                                    }
                                }
                                	
                                //	echo $billsession;die;
                                	$query=$this->db->query("select * from tbl_news_group where ng_id='$gid'");
                    				$newsRe=$query->row();
                    				$newspaper_name=$newsRe->ng_name;        
                    				
                    				
                                
                                $status=0;
                                        					$remark="";
                                        					  $slip_no=0;
                                            				    $cgst=0;
                                                                $sgst=0;
                                                                $igst=0;
                                                                $am=0;
                                                                $a=0;
                                                                $rate1=0;
                                                    	         $ratemin=0;
                                                    	          $ratemax=0;
                                                                $dop_amount=0;
                                                                $billed_amount=0;
                                                                $id="";
                                     	       $paper_id="";
                                $mainros = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$ro_id."' and tbl_ro_dop.work_year='".$work_year."' and tbl_ro_dop.dop<='".$rdate."' and tbl_ro_dop.news_bill_status='N' " );
                                // echo $this->db->last_query();die;
                                $roresult=$mainros->result();
                                if(!empty($roresult))
                                {
                                    
                                    foreach ($roresult as $re)
                                    {                   $limit=0;
                                                        $ratemin=0;
                                                        $ratemax=0;
                                                        $rate1=0;
                                        	$rate1=$re->dop_amount;
                    	                    $limit=number_format(((floatval($rate1)*25)/100), 2, '.', '');
                                             $ratemin=floatval($rate1)-$limit;
                                     	       $ratemax=floatval($rate1)+$limit;
                                     	       
                                     	//  echo var_dump($checked);
                                     	   if($rate1==0 and $row[5]==0)
                                     	   {
                                     	        $id=$re->ro_id;
                                     	       $paper_id=$re->paper_id;
                                     	       break;
                                     	   }
                                     	       
                                     	   
                    	                    else if($ratemin < $row[5] and $row[5] <= $ratemax)
                    	                    {
                    	                         
                    	                       $id=$re->ro_id;
                                     	       $paper_id=$re->paper_id;
                                     	       break;
                    	                    }
                    	                    else
                    	                    {	$id = -1;
                    	                    	$paper_id = -1;
                    	                        $remark="Dop amount Did not Match"; 
                    	                    }
                                    }
                                } 
                                
                                
                                
                                	$result=$this->db->query("select * from tbl_ledgers where master_id='$gid' and group_id='1'");
                                                                        						
                                                                                                    $rel=$result->result();
                                                                                                    if(!empty($rel))
                                                                                                    {
                                                                                                    foreach($rel as $re11)
                                                                                                    {
                                                                                            					$ledger_id=$re11->ledger_id;
                                                                                                        
                                                                                                    }
                                                                                                    }
                                                                                            				
                    	                                                                                
                                                   if($id!="-1" and $paper_id!="-1")
                                                   {
                                                                                            				
                    	                        	$ro_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."' and tbl_ro_dop.paper_id='$paper_id' and   (tbl_ro_dop.dop='$rdate' or tbl_ro_dop.dop='$rdate1' or tbl_ro_dop.dop='$rdate2' or tbl_ro_dop.dop='$rdate3' or tbl_ro_dop.dop='$rdate4' or tbl_ro_dop.dop='$rdate5' or tbl_ro_dop.dop='$rdate6' or tbl_ro_dop.dop='$rdate7' or tbl_ro_dop.dop='$rdate8') and tbl_ro_dop.work_year='".$work_year."' and tbl_ro_dop.news_bill_status='N' " );
                    	                     // echo $this->db->last_query();die;
                    	                        	 $ro_dops= $ro_dop->result();
                    				        	if(!empty($ro_dops))
                                    				{   
                                    					foreach ($ro_dops as $dop)
                                        					{
                                                	             
                                                	             
                                                	             		$igst = $this->db->select('*')->from('tbl_tax')->where('title','IGST')->where('date_from <=', date('Y-m-d'))
                                                                    ->where('date_to >=', date('Y-m-d'));
                                                                   $data['igst']= $igst->get()->row();
                                                        	 
                                                        	
                                                        			$cgst = $this->db->select('*')->from('tbl_tax')->where('title','CGST')->where('date_from <=', date('Y-m-d'))
                                                                    ->where('date_to >=', date('Y-m-d'));
                                                                   $data['cgst']= $cgst->get()->row();
                                                        	
                                                        			$sgst = $this->db->select('*')->from('tbl_tax')->where('title','SGST')->where('date_from <=', date('Y-m-d'))
                                                                    ->where('date_to >=', date('Y-m-d'));
                                                                   $data['sgst']= $sgst->get()->row();
                                                        			                                      
                    	                                                            	        
                                                            			    	$first_date=date('Y-m-d',strtotime($dop->dop));
                                                                                $second_date=date('Y-m-d',strtotime("2017-07-01")); 
                                                                                $second_date1=date('d/m/Y',strtotime("01/07/2017"));
                                                                                $second_date2=date('m-d-Y',strtotime("01-07-2017"));
                                                                                $dop_amount=$dop->dop_amount;
                                                                                       
                                                                                 $billed_amount=$dop->newspaper_billed_amount;
                                                                                 $am=number_format(floatval($dop_amount)-floatval($billed_amount), 2, '.', '');
                                                                                   
                                                                                            if($first_date>=$second_date)
                                                                                            {
                                                            
                                                                                                    if($state==6){
                                                                                                        
                                                                                                   if($data['cgst']){
                                                                                                        $cgst=number_format(((floatval($am)*(floatval($data['cgst']->tax_rate)))/100), 2, '.', '');
                                                                                                       } else {
                                                                                                        $cgst=0;
                                                                                                       }
                                                                                                       
                                                                                                       if($data['sgst']){
                                                                                                         $sgst=number_format(((floatval($am)*(floatval($data['sgst']->tax_rate)))/100), 2, '.', '');
                                                                                                    
                                                                                                       } else {
                                                                                                        $sgst=0;
                                                                                                       }
                                                                                                       $igst=0;
                                                                                
                                                                                                    } 
                                                                                                    else 
                                                                                                    {
                                                                                
                                                                                                        $cgst=0;
                                                                                
                                                                                                        $sgst=0;
                                                                                                      if($data['igst']){
                                                                                                         $igst=number_format(((floatval($am)*(floatval($data['igst']->tax_rate)))/100), 2, '.', '');
                                                                                                    
                                                                                                       } else {
                                                                                                        $igst=0;
                                                                                                       }
                                                                                
                                                                                                    } 
                                                                            
                                                                                            }
                                                                            
                                                                                            else{
                                                                            
                                                                                                  $cgst=0;
                                                                            
                                                                                                    $sgst=0;
                                                                            
                                                                                                    $igst=0;
                                                                            
                                                                                            }
                                                                                            
                                                                                             $a=($am+$cgst+$igst+$sgst);
                                                                                if($row[5] > $a)
                                                                            			 {
                                                                            			    //  array_push($checked,$id);
                                                                            			         $status=0;
                                                                            			         $remark="Disputed";
                                                                            			           $this->load->model("ro_model");
                                                    	                    	$slip_no=$this->ro_model->gen_slip_no($billsession);	 
                                                                            		$values = array(								
                                                            								'slip_no'=> $slip_no,
                                                            								'publication'=> $gid,
                                                            								'bill_no'=> $row[3],
                                                            								'bill_amount'=> $row[5],
                                                            								'cgst'=>$row[7],
                                                            								'sgst'=>$row[8],
                                                            								'igst'=>$row[6],
                                                            								'net_amount'=>$row[9],
                                                            								'dated'=> $rdate,
                                                            								'dop'=> $dop->dop,
                                                            								'ro_no'=> $row[0],
                                                            								'work_year'=>$billsession,
                                                            								'emp_id'=>$_SESSION['admin']['id'],
                                                            								'add_no'=> "",
                                                            								'status'=> $status,
                                                            								'remark'=> $remark
                                                                        							);						
                                                                        				$query = $this-> db->insert('tbl_publication_bill', $values);
                                                                        				$in_id=$this->db->insert_id();
                                                                        			//	$billed_amount=floatval($row[5])+floatval($billed_amount);
                                                                        			
                                                                        			 	$billed_amount1=	number_format(floatval($row[5])+floatval($billed_amount), 2, '.', '');
                                                                        				
                                                                        				     $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='".$rdate."',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$row[3]' where id='".$dop->id."'");	
                                                                        			
                                                                                                  //echo $this->db->last_query();
                                                                                                 	$values1 = array(	
                                                                                                 	    	'ro_main_id'=>$dop->id,
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'cr',
                                                                                            						'amount'=>$row[9],
                                                                                            						'narration'=>"Bill generated for ".$newspaper_name."No: ".$row[3],
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            				//	$this->site_model->insert_data('tbl_vouchers', $values); 
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            					// echo $this->db->last_query(); 
                                                                                            	//	echo $this->db->last_query();
                                                                                            
                                                                                            				
                                                                                            
                                                                                            					$values = array(
                                                                                            						'group_id'=>9,
                                                                                            						'ledger_id'=>16,
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[5],
                                                                                            						'narration'=>"Advertisement Expense on Bill No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[6],
                                                                                            						'narration'=>"IGST on Bill No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[7],
                                                                                            						'narration'=>"CGST on Bill No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[8],
                                                                                            						'narration'=>"UGST on Bill No: ".$row[3],
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            				//	 echo $this->db->last_query(); 
                                                                        						
                                                                                            }
                                                                        						
                                                                                                			     $updated=$updated+1;
                                                                                                			     break;
                                                                            			     
                                                                            			      
                                                                         }
                                                                                  else	        
                                                                            		
                                                                            			 {
                                                                            			    //  array_push($checked,$id);
                                                                            			     $status=1;
                                                                            			     $remark="OK";
                                                                            			    $this->load->model("ro_model");
                                                    	                    	$slip_no=$this->ro_model->gen_slip_no($billsession);	 
                                                                            		$values = array(								
                                                            								'slip_no'=> $slip_no,
                                                            								'publication'=> $gid,
                                                            								'bill_no'=> $row[3],
                                                            								'bill_amount'=> $row[5],
                                                            								'cgst'=>$row[7],
                                                            								'sgst'=>$row[8],
                                                            								'igst'=>$row[6],
                                                            								'net_amount'=>$row[9],
                                                            								'dated'=> $rdate,
                                                            								'dop'=> $dop->dop,
                                                            								'ro_no'=> $row[0],
                                                            								'work_year'=>$billsession,
                                                            								'emp_id'=>$_SESSION['admin']['id'],
                                                            								'add_no'=> "",
                                                            								'status'=> $status,
                                                            								'remark'=> $remark
                                                                        							);						
                                                                        				$query = $this-> db->insert('tbl_publication_bill', $values);
                                                                        				$in_id=$this->db->insert_id();
                                                                        			//	$billed_amount=floatval($row[5])+floatval($billed_amount);
                                                                        			
                                                                        			 	$billed_amount1=	number_format(floatval($row[5])+floatval($billed_amount), 2, '.', '');
                                                                        			
                                                                                                 $this->db->query("update tbl_ro_dop set news_bill_status='Y',p_bill_dop='$rdate',newspaper_billed_amount='".$billed_amount1."',newspaper_bill_no='$row[3]' where id='".$dop->id."'");	
                                                                        			
                                                                                                  //echo $this->db->last_query();
                                                                                                 	$values1 = array(	
                                                                                                 	    'ro_main_id'=>$dop->id,
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'cr',
                                                                                            						'amount'=>$row[9],
                                                                                            						'narration'=>"Bill generated for ".$newspaper_name."No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[5],
                                                                                            						'narration'=>"Advertisement Expense on Bill No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[6],
                                                                                            						'narration'=>"IGST on Bill No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[7],
                                                                                            						'narration'=>"CGST on Bill No: ".$row[3],
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
                                                                                            						'voucher_date'=> $rdate,
                                                                                            						'entry_type'=>'dr',
                                                                                            						'amount'=>$row[8],
                                                                                            						'narration'=>"UGST on Bill No: ".$row[3],
                                                                                            						'voucher_no'=>2,
                                                                                            						'screen'=>"Publication Bill",
                                                                                            						'screen_id'=>$in_id,
                                                                                            						'voucher_session'=>$billsession
                                                                                            					);
                                                                                            					 $this-> db->insert('tbl_vouchers', $values);
                                                                                            				//	 echo $this->db->last_query(); 
                                                                        						
                                                                                            }
                                                                                                			     $updated=$updated+1;
                                                                                                			     
                                                                                                			     break;
                                                                            			 }
                                                                            	 $remark="";		
                                            	                  
                                                              
                                        					}
                                    				}
                    	                    
                    	                  	else
                				{
                				    $remark="No amount match";
                				   //  echo "Dop issue";
                				}
                                            
                                        
                                    
                                                   } else if(($id=='-1') && ($paper_id=='-1')){
															$remark="Dop amount Did not Match"; 
                    	                    
												   }else
                				{
                				    $remark="Dop issue";
                				   //  echo "Dop issue";
                				}
                            }
                       
                        }
            			else
            			{
            			     $remark="Not updated";
            			   // echo "Not updated";
            			}
                   }
                  else
                   {
                    
            	    $remark="Empty ro_no"; 
                   }
            
	      }           
        
 $data=array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$remark,$slip_no,$first_date,$am,$cgst,$igst,$sgst,$a); 
  array_push($mydata,$data);

    } 
 // $this->dataimport($mydata);
  //echo var_dump($mydata);
  $filename = 'users_'.date('Ymd').'.csv'; 
  header("Content-Description: File Transfer"); 
  header("Content-Disposition: attachment; filename=$filename"); 
  header("Content-Type: application/csv; ");
   
  // get data 
  
  // file creation 
  $file = fopen('php://output', 'w');
 
  $header = array("Ro_No","Ro_Date","Newspaper","Bill_No","Date","Amount","IGST","CGST","SGST","Total Amaount","Remarks","SlipNO","DOP","dop_amount","CGST","IGST","SGST","ROAM");
  fputcsv($file, $header);
  foreach ($mydata as $key=>$line){ 
     fputcsv($file,$line); 
  } fclose($file);
  
  
  
//  echo $updated." records added/updated successfully.";
     die;
        	redirect('admin/newspaper_bill');
        //echo $this->db->last_query();
    }
    // public function dataimport($mydata)
    // {
    //       $filename = 'users_'.date('Ymd').'.csv'; 
    //           header("Content-Description: File Transfer"); 
    //           header("Content-Disposition: attachment; filename=$filename"); 
    //           header("Content-Type: application/csv; ");
               
    //           // get data 
              
    //           // file creation 
    //           $file = fopen('php://output', 'w');
             
    //           $header = array("Ro_No","Ro_Date","Newspaper","Bill_No","Date","Amount","IGST","CGST","SGST","Total Amaount","Remarks","SlipNO","DOP","dop_amount","CGST","IGST","SGST","ROAM");
    //           fputcsv($file, $header);
    //           foreach ($mydata as $key=>$line){ 
    //              fputcsv($file,$line); 
    //           } 
    //           fclose($file);
    // }
    
}
?>