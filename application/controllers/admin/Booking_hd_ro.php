<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_hd_ro extends CI_Controller
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
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, p.position as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
			INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			INNER JOIN tbl_position p ON p.id=tbl_book_ads.cat_id
			INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE (tbl_book_ads.pending='C' AND tbl_book_ads.type_id='3') AND (n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR p.position LIKE '%".$name."%' OR u.mobile LIKE '%".$name."%' OR u.email LIKE '%".$name."%') ORDER BY id DESC");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/booking_hd_ro/index";
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
			$book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, p.position as cat_name, u.email, u.mobile FROM tbl_book_ads
			INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			INNER JOIN tbl_position p ON p.id=tbl_book_ads.cat_id
			INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.pending='C' AND tbl_book_ads.type_id='3' order by tbl_book_ads.id desc" );
			$config = array();
			$config["base_url"] = base_url(). "admin/booking_hd_ro/index";
			$config["total_rows"] = $book_ads->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
			$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, p.position as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
			INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			INNER JOIN tbl_position p ON p.id=tbl_book_ads.cat_id
			INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.pending='C' AND tbl_book_ads.type_id='3' order by tbl_book_ads.id desc limit {$config['per_page']} offset {$page}");
			
			$data['book_ads']= $book_ads->result();
		}
		
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		$this->load->view('admin/header');
		$this->load->view('admin/hd_ro_list',$data);
		$this->load->view('admin/footer');
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
			
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
			//$this->form_validation->set_rules('cities[]', 'City', 'required');
			//$this->form_validation->set_rules('dis', 'discount', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_newspapers');
				$data['newspapers']= $query->result();
			
				$query = $this->db->get('tbl_cities');
				$data['cities']= $query->result();
			
				$query = $this->db->get('tbl_news_type');
				$data['types']= $query->result();
			
				$query = $this->db->get('tbl_categories');
				$data['cats']= $query->result();
			
				$query = $this->db->get('tbl_client');
				$data['clients']= $query->result();
			
				$query = $this->db->get('tbl_tax');
				$data['taxs']= $query->result();
			
				$query = $this->db->get('tbl_employee');
				$data['employees']= $query->result();
			
			
				$this->load->view('admin/header');
				$this->load->view('admin/b_hd_ro_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{								
				$values = array(
					'u_id' => $this->input->post('client'),
					'e_id' => $this->input->post('employee'),
					'newspaper_id' => $this->input->post('newspaper'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('matter'),
					'type_id' => $this->input->post('type'),
					'cat_id' => $this->input->post('cat'),
					'sub_heading' => $this->input->post('sheading'),
					'package' => $this->input->post('pack'),
					'insertion' => $this->input->post('inse'),
					'scheme' => $this->input->post('scheme'),
					'material' => $this->input->post('material'),
					'party' => $this->input->post('party'),
					'box' => $this->input->post('box'),
					'premimum' => $this->input->post('premimum'),
					'remark' => $this->input->post('remark'),
					'price' => 0,
					'ad_cost' => 0,
					'discount' => 0,
					'city' => $this->input->post('city'),
					'size_words' => $this->input->post('w_count1'),
					'tax' => 0,
					'publish_day' => 1,
					'publish_date'  => $this->input->post('p_date'),
					'book_date'=>date('Y-m-d'),
					'comm1' => $this->input->post('comm1'),
					'comm2' => $this->input->post('comm2'),
					'comm3' => $this->input->post('comm3'),
					'comm4' => $this->input->post('comm4'),
					'comm5' => $this->input->post('comm5'),
					'comm6' => $this->input->post('comm6'),
					'comm7' => $this->input->post('comm7'),
					'comm8' => $this->input->post('comm8'),
					'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
					'c_date' => date('Y-m-d H:i:s')
				);
							
				$days=explode(", ",$values['publish_date']);
				$c=count($days);
				if($c<$values['insertion'])
				{
					$this->session->set_flashdata('msg', 'Date of publish must be equal to insertion.');
					redirect('admin/book_ads/add');
				}								
									
				$query = $this->db->query("SELECT * FROM tbl_ad_price WHERE newspaper_id='".$values['newspaper_id']."' AND city='".$values['city']."' AND ad_type='".$values['type_id']."' AND ad_cat_id='".$values['cat_id']."' AND ins_from <'".$values['insertion']."' AND ins_to >'".$values['insertion']."'");
				
				$rates= $query->row();
							
				if(empty($rates))
				{
					$this->session->set_flashdata('msg', 'Rate Not Set with this newspaper.');
					redirect('admin/book_ads/add');
				}
				else
				{
					if($values['size_words']<$rates->min_w)
					{
						$this->session->set_flashdata('msg', 'Minimum word required '.$rates->min_w);
						redirect('admin/book_ads/add');
					}
					
					if($values['size_words']>$rates->min_w)
					{
						$sub_amount=$rates->ad_price;
						
						$extra_w=$values['size_words']-$rates->max_w;
						
						$sub_amount=$sub_amount+$extra_w*$rates->extra_price;
					}
					else
					{
						$sub_amount=$rates->ad_price;
					}
										
					
					if(!empty($values['scheme']))
					{
						$query = $this->db->get_where('tbl_scheme', array('scheme_id' => $values['scheme']));
						$sch= $query->row();
						if(!empty($sch))
						{
							$insertion=$values['insertion']-$sch->free;
						}						
					}
					if(isset($insertion))
					{
						$sub_amount=$sub_amount*$insertion;
					}
					else
					{
						$sub_amount=$sub_amount*$values['insertion'];
					}
					
					if(!empty($values['premimum']))
					{
						$query = $this->db->get_where('tbl_premimum', array('id' => $values['premimum']));
						$pre= $query->row();
						if(!empty($pre))
						{
							$sub_amount=$sub_amount+$sub_amount*$pre->premimum/100;
						}
					}
					else
					{
						$values['premimum']=0;
					}
					$values['ad_cost']=$sub_amount;
				}
				
				$ro_a=$values['ad_cost'];
				$comm_a=0;
				$comm=$ro_a*$values['comm1']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm;
				$comm=$ro_a*$values['comm2']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm3']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm4']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm5']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm6']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm7']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm8']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$values['comm_a']=$comm_a;
				
			
				//$values['tax_a']=$ro_a*$values['tax']/100;
			
				$values['p_amount']=$ro_a-$comm_a;
						
				$query = $this-> db->insert('tbl_book_ads', $values);
				$in_id=$this->db->insert_id();
			
				$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
				INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
				INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
				INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
				INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$in_id."'");
				$book_ad= $book_ads->result();
		
				echo json_encode($book_ad);
				
				
			}
		}
		else
		{			
			$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
			$data['newspapers']= $query->result();
			
			$query = $this->db->get_where('tbl_news_type', array('base_type' => 'T'));
			$data['types']= $query->result();
			
			$query = $this->db->get('tbl_position');
			$data['cats']= $query->result();
			
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
			
			$query = $this->db->get('tbl_tax');
			$data['taxs']= $query->result();
			
			$query = $this->db->get('tbl_employee');
			$data['employees']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/b_hd_ro_add',$data);
			$this->load->view('admin/footer');
		}
	}
	

    public function get_price()
    {
        if (!empty($this->input->post())) 
        {
            $this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
            //$this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('cat', 'Heading', 'required');
            $this->form_validation->set_rules('inse', 'Insertion', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $msg="1";
                echo $msg;
                return;
            }
            else
            {
                $id=$this->input->post('newspaper');

                $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                $ng= $query->row();	

                $values = array(								
                    'newspaper_id' => $ng->paper_id,
                    'type_id' => 3,
                    'cat_id' => $this->input->post('cat'),
                    'insertion' => $this->input->post('inse'),
                    'color' => $this->input->post('color'),
                    //'size_type' => $this->input->post('size_type'),
                    'city' => $ng->city_id
                );

                $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 3 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `color_type` = '".$values['color']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'AND `date_to` =''");
               
                //$query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 3 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");
                $rates= $query->row();

                $query=$this->db->where(["tax_type"=>"newspaper"])->get("tbl_tax")->row();
                $rates->gst=$query->tax_rate;

                if(empty($rates))
                {
                    $msg="2";
                    echo $msg;
                    return;
                }
                else
                {
                    echo json_encode($rates);
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

    public function get_fdays()
    {
        if (!empty($this->input->post())) 
        {
            $this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
            //$this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('cat', 'Heading', 'required');
            $this->form_validation->set_rules('inse', 'Insertion', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $msg="1";
                echo $msg;
                return;
            }
            else
            {
                $id=$this->input->post('newspaper');

                $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                $ng= $query->row();	

                $values = array(								
                    'newspaper_id' => $ng->paper_id,
                    'type_id' => 3,
                    'cat_id' => $this->input->post('cat'),
                    'city' => $ng->city_id
                );

                $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 3 ."' AND `ad_cat_id` = '".$values['cat_id']."'");	

                $rates= $query->row();

                if(empty($rates))
                {
                    $msg="2";
                    echo $msg;
                    return;
                }
                else
                {
                    echo json_encode($rates);
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


    public function get_dop_price()
    {
        //echo '<pre>'; var_dump($_POST); die;
        $date=date_create($this->input->post('s_date'));		
        $id=$this->input->post('newspaper');
        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
        $ng= $query->row();		
        $values = array(
            'count'=>$this->input->post('count'),
            'newspaper_id' => $ng->paper_id,
            'type_id' => 3,
            'cat_id' => $this->input->post('cat'),
            'insertion' => $this->input->post('inse'),
            'city' => $ng->city_id,
            'color'=> $this->input->post('color'),
            //'size_type'=> $this->input->post('size_type'),
            's_date'=>date_format($date,"Y-m-d")
        );			
        $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 3 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `color_type` = '".$values['color']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'AND `date_to` =''");
        $rates= $query->result();
        foreach($rates as $rate)
        {
            if($rate->revise_rate==1)
            {
                if($rate->date_from <= $values['s_date'] AND $rate->date_to >= $values['s_date'])
                {
                    $rate1=$rate;
                }
                else
                {
                    continue;
                }
            }
            else
            {
                if($rate->date_from <= $values['s_date'] )
                {
                    $rate1=$rate;
                }
                else
                {
                    continue;
                }
            }
        }

        if(empty($rate1))
        {
            $msg="1";
            echo $msg;
            return;
        }
        else
        {
            $data['rates']=$rate1;
            $data['values']=$values;
            echo json_encode($data);
            return;
        }
        return;
    }
	
	public function save()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'Size', 'required');			
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			$this->form_validation->set_rules('inse', 'Insertion', 'required');
			
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
					'paper_city_id' => $this->input->post('newspaper'),
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
                  //  echo $this->db->last_query();
                    $in_id=$this->db->insert_id();
                    //echo $in_id;
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
                 //   echo $this->db->last_query();
                    $i++;
                         }
                    }
                    
                  
                }	
                }
				
			
				$book_ads=$this->db->query("SELECT tbl_book_ads_temp.*, n.name as newspaper_name, t.name as type_name, po.position as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads_temp
				INNER JOIN tbl_ro_dop_temp d ON d.ro_id=tbl_book_ads_temp.id
				INNER JOIN tbl_paper_city p ON p.id=d.paper_id
				INNER JOIN tbl_newspapers n ON n.id=p.paper_id
				INNER JOIN tbl_news_type t ON t.id=tbl_book_ads_temp.type_id
				INNER JOIN tbl_position po ON po.id=tbl_book_ads_temp.cat_id
				INNER JOIN tbl_client u ON u.id=tbl_book_ads_temp.u_id WHERE tbl_book_ads_temp.id='".$in_id."'");
				$book_ad= $book_ads->result();
		
				echo json_encode($book_ad);
				return;
				
				
			}
		}
	}
	
	
	
	
	public function save1234()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('size_l', 'Size', 'required');
			$this->form_validation->set_rules('size_r', 'Size', 'required');			
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{								
				$values = array(
					'u_id' => $this->input->post('client'),
					'e_id' => $this->input->post('employee'),
					'newspaper_id' => $this->input->post('newspaper'),
					'title' => $this->input->post('title'),
					'content' => $this->input->post('matter'),
					'type_id' => 2,
					'cat_id' => $this->input->post('cat'),
					'sub_heading' => $this->input->post('sheading'),
					'package' => $this->input->post('pack'),
					'insertion' => $this->input->post('inse'),
					'scheme' => $this->input->post('scheme'),
					'material' => $this->input->post('material'),
					'party' => $this->input->post('party'),
					'box' => $this->input->post('box'),
					'premimum' => $this->input->post('premimum'),
					'remark' => $this->input->post('remark'),
					'price' => $this->input->post('price'),
					'ex_price' => $this->input->post('price'),
					'ad_cost' => $this->input->post('p_amount'),
					't_amount' => $this->input->post('t_amount'),
					'discount' => $this->input->post('dis_a'),
					'city' => $this->input->post('city'),
					'size_words' => $this->input->post('size_l'),
					'tax' => 0,
					'publish_day' => $this->input->post('inse'),
					'publish_date'  => $this->input->post('p_date'),
					'comm1' => $this->input->post('comm1'),
					'comm2' => $this->input->post('comm2'),
					'comm3' => $this->input->post('comm3'),
					'comm4' => $this->input->post('comm4'),
					'comm5' => $this->input->post('comm5'),
					'comm6' => $this->input->post('comm6'),
					'comm7' => $this->input->post('comm7'),
					'comm8' => $this->input->post('comm8'),
					'book_date'=>date('Y-m-d'),
					'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
					'c_date' => date('Y-m-d H:i:s')
				);
							
				$values['size_words']=$values['size_words']."X".$this->input->post('size_r');
							
				$days=explode(", ",$values['publish_date']);
				$c=count($days);
				if($c<$values['insertion'])
				{
					$msg="2";
					echo $msg;						
					return;
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
						
				$query = $this-> db->insert('tbl_book_ads', $values);
				$in_id=$this->db->insert_id();
			
				$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
				INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
				INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
				INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
				INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$in_id."'");
				$book_ad= $book_ads->result();
		
				echo json_encode($book_ad);
				return;
				
				
			}
		}
	}
	
	public function save12()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('cat', 'Heading', 'required');
			$this->form_validation->set_rules('w_count', 'No. of words', 'required');
			$this->form_validation->set_rules('matter', 'Matter', 'required');
			$this->form_validation->set_rules('employee', 'Employee', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{								
				$values = array(
					'u_id' => $this->input->post('client'),
					'e_id' => $this->input->post('employee'),
					'newspaper_id' => $this->input->post('newspaper'),
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
					'premimum' => $this->input->post('premimum'),
					'remark' => $this->input->post('remark'),
					'price' => 0,
					'ad_cost' => 0,
					'discount' => 0,
					'city' => $this->input->post('city'),
					'size_words' => $this->input->post('w_count'),
					'tax' => 0,
					'publish_day' => 1,
					'publish_date'  => $this->input->post('p_date'),
					'book_date'=>date('Y-m-d'),
					'comm1' => $this->input->post('comm1'),
					'comm2' => $this->input->post('comm2'),
					'comm3' => $this->input->post('comm3'),
					'comm4' => $this->input->post('comm4'),
					'comm5' => $this->input->post('comm5'),
					'comm6' => $this->input->post('comm6'),
					'comm7' => $this->input->post('comm7'),
					'comm8' => $this->input->post('comm8'),
					'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
					'c_date' => date('Y-m-d H:i:s')
				);
							
				$days=explode(", ",$values['publish_date']);
				$c=count($days);
				if($c<$values['insertion'])
				{
					$msg="2";
					echo $msg;						
					return;
				}								
									
				$query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 3 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");	
				
				
				
				$rates= $query->row();
							
				if(empty($rates))
				{
					$msg="3";
					echo $msg;
					return;
				}
				else
				{
										
					if($values['size_words']>$rates->min_w)
					{
						$sub_amount=$rates->ad_price;
						
						$extra_w=$values['size_words']-$rates->min_w;
						
						$sub_amount=$sub_amount+$extra_w*$rates->extra_price;
						$values['price']=$rates->extra_price;
					}
					else
					{
						$sub_amount=$rates->ad_price;
						$values['price']=$rates->extra_price;
					}
										
					
					if(!empty($values['scheme']))
					{
						$query = $this->db->get_where('tbl_scheme', array('scheme_id' => $values['scheme']));
						$sch= $query->row();
						if(!empty($sch))
						{
							if(($sch->free+$sch->paid)<=$insertion=$values['insertion'])
							{
								$insertion=$values['insertion']-$sch->free;
							}
						}						
					}
					if(isset($insertion))
					{
						$sub_amount=$sub_amount*$insertion;
					}
					else
					{
						$sub_amount=$sub_amount*$values['insertion'];
					}
					
					if(!empty($values['premimum']))
					{
						$query = $this->db->get_where('tbl_premimum', array('id' => $values['premimum']));
						$pre= $query->row();
						if(!empty($pre))
						{
							$sub_amount=$sub_amount+$sub_amount*$pre->premimum/100;
						}
					}
					$values['ad_cost']=$sub_amount;
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
				
				
				$ro_a=$values['ad_cost'];
				$comm_a=0;
				$comm=$ro_a*$values['comm1']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm;
				$comm=$ro_a*$values['comm2']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm3']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm4']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm5']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm6']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm7']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$comm=$ro_a*$values['comm8']/100;
				$ro_a=$ro_a-$comm;
				$comm_a=$comm_a+$comm;
				$values['comm_a']=$comm_a;
				
			
				//$values['tax_a']=$ro_a*$values['tax']/100;
			
				$values['p_amount']=$ro_a-$comm_a;
						
				$query = $this-> db->insert('tbl_book_ads', $values);
				$in_id=$this->db->insert_id();
			
				$book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
				INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
				INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
				INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
				INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$in_id."'");
				$book_ad= $book_ads->result();
		
				echo json_encode($book_ad);
				return;
				
				
			}
		}
	}
	
 public function get_city($newspaper_id=null)
    {
        $this->load->model("ro_model");
        echo json_encode($this->ro_model->get_states($_POST['newspaper_id']));
    }
	
	public function get_heading()
	{
		$id=$_POST['id'];		
		
		//$query = $this->db->get_where('tbl_paper_city', array('id' => $id));
		//$ng= $query->row();	
		
		//$id=$ng->paper_id;
		
		/*$query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$id."'");*/
		
		$query = $this->db->get('tbl_position');
		$heading= $query->result();
		
		echo json_encode($heading);
	}
	
	public function get_sub_heading()
	{
		$id=$_POST['cat_id'];
		
		$query = $this->db->get_where('tbl_sub_heading', array('cat_id' => $id));
		$sh= $query->result();
		
		echo json_encode($sh);
	}
	
	public function get_scheme()
	{
		$id=$_POST['n_id'];
		$cat_id=$_POST['cat_id'];		
		
		$query = $this->db->query("SELECT * FROM `tbl_hd_scheme` WHERE `np_id`='".$id."' AND `type_id`='3' AND `cat_id`='".$cat_id."' GROUP BY `scheme_id`");
		$sch= $query->result();
		
		echo json_encode($sch);
	}
	
	public function get_scheme_price()
	{
		$id=$_POST['s_id'];
		
		$query = $this->db->get_where('tbl_hd_scheme', array('id' => $id));
		$scheme= $query->row();
		
		if(!empty($scheme))
		{
			echo json_encode($scheme);
		}
		else
		{
			echo "1";
		}
	}
	
	
	public function get_premimum()
	{
		$id=$_POST['n_id'];
		//$id=1;
		$query = $this->db->get_where('tbl_paper_city', array('id' => $id));
		$ng= $query->row();
		$id=$ng->paper_id;
		
		$query = $this->db->get_where('tbl_newspapers', array('id' => $id));
		$ng= $query->row();
		$query = $this->db->get_where('tbl_premimum', array('g_id' =>$ng->g_id));
		
		$ng= $query->result();
		
		echo json_encode($ng);
	}
	
	public function get_premimum_price()
	{
		$id=$_POST['pre_id'];		
		
		$query = $this->db->get_where('tbl_premimum', array('id' => $id));		
		
		$pre= $query->row();
		
		if(!empty($pre))
		{
			echo json_encode($pre);
		}
		else
		{
			echo "1";
		}
	}
	
	
	public function get_package()
	{
		$id=$_POST['n_id'];
		$cat_id=$_POST['cat_id'];
		$insertion=$_POST['ins'];
		/*$id=1;
		$query = $this->db->get_where('tbl_paper_city', array('id' => $id));
		$ng= $query->row();
		$id=$ng->paper_id;
		
		$query = $this->db->get_where('tbl_newspapers', array('id' => $id));
		$ng= $query->row();
		$query = $this->db->query("SELECT * FROM `tbl_package` WHERE `g_id`='".$ng->g_id ."' AND `cat_id`='". $cat_id ."' AND type_id='3' AND `ins_from` <= '".$insertion."' AND `ins_to` >= '".$insertion."'");
		*/
		$query = $this->db->query("SELECT tbl_package .* ,p.paper_id FROM tbl_package
INNER JOIN tbl_pack_paper p ON p.pack_id=tbl_package.id

WHERE p.paper_id='".$id."' AND tbl_package.cat_id='". $cat_id ."' AND tbl_package.type_id='3' AND tbl_package.ins_from <= '".$insertion."' AND tbl_package.ins_to >= '".$insertion."' GROUP BY tbl_package.id");
		
		$pack= $query->result();		
		echo json_encode($pack);
	}
	
	
	public function get_package_price()
	{
		//sleep(50);
		$pack_id=$this->input->post('pack_id');
			
		$query = $this->db->get_where('tbl_package', array('id' => $pack_id));
		$data['pack']= $query->row();
		//$id=$ng->paper_id;
		
		$query = $this->db->query("SELECT tbl_pack_paper.*, n.name as newspaper_name FROM tbl_pack_paper INNER JOIN tbl_paper_city c ON c.id=tbl_pack_paper.paper_id INNER JOIN tbl_newspapers n ON n.id=c.paper_id WHERE tbl_pack_paper.pack_id ='".$pack_id."'");
		
		$data['pack_paper']= $query->result();				
		
		echo json_encode($data);
	}
	
	public function get_newspaper()
	{
		$id=$_POST['paper'];
		
		$query = $this->db->get_where('tbl_paper_city', array('id' => $id));
		$ng= $query->row();
		
		$query = $this->db->get_where('tbl_newspapers', array('id' => $ng->paper_id));
		$ng= $query->row();
		
		$query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE n.g_id='".$ng->g_id."' AND tbl_paper_city.id !='".$id."'");
		
		$newspaper= $query->result();
		
		echo json_encode($newspaper);
		
	}
	
    public function get_base_price()
    {
        if (!empty($this->input->post())) 
        {
            $this->form_validation->set_rules('newspaper', 'Newspaper', 'required');
            $this->form_validation->set_rules('arr[]', 'Add on Newspaper', 'required');
            //$this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('cat', 'Heading', 'required');
            $this->form_validation->set_rules('inse', 'Insertion', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $msg="1";
                echo $msg;
                return;
            }
            else
            {
                $add_paper=$this->input->post('arr');
                $i=0;

                $f=0;
                $paper=0;
                foreach($add_paper as $p_id)
                {					
                    $query = $this->db->get_where('tbl_paper_city', array('id' => $p_id));
                   $ng= $query->row();

                    $values = array(								
                        'newspaper_id' =>$ng->paper_id,
                        'type_id' => 3,
                        'cat_id' => $this->input->post('cat'),
                        'insertion' => $this->input->post('inse'),
                        'color' => $this->input->post('color'),
                        'city' => $ng->city_id
                    );

                    $query = $this->db->query("SELECT tbl_ad_price.*,n.name as newspaper_name,c.name as city_name FROM `tbl_ad_price`
					INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
					INNER JOIN tbl_cities c ON c.id=tbl_ad_price.city
					WHERE tbl_ad_price.newspaper_id= '".$values['newspaper_id']."' AND tbl_ad_price.city='".$values['city']."' AND tbl_ad_price.ad_type = '". $values['type_id'] ."' AND tbl_ad_price.ad_cat_id = '".$values['cat_id']."'  AND tbl_ad_price.color_type = '".$values['color']."' AND tbl_ad_price.ins_from <= '".$values['insertion']."' AND tbl_ad_price.ins_to >= '".$values['insertion']."'");

                    //$query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 2 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");

                    $rates= $query->row();
                     $query=$this->db->where(["tax_type"=>"newspaper"])->get("tbl_tax")->row();
                $rates->gst=$query->tax_rate;
 //$paper=$p_id;
                    if($f==0 && !empty($rates))
                    {
                        $f=1;
                        $base_rate=$rates;
                        $paper=$p_id;
                    }
                    else
                    {
                        if(!empty($rates)&&($rates->ad_price > $base_rate->ad_price))
                        {
                            $base_rate=$rates;
                           $paper=$p_id;
                        }						
                    }

                    $i++;
                }

                if(empty($base_rate))
                {
                    $msg="2";
                    echo $msg;
                    return;
                }
                else
                {
                    $data['value']=$paper;
                    $data['rates']=$base_rate;
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

	
	
  public function get_ad_on_price1()
    {
        if (!empty($this->input->post())) 
        {
            $this->form_validation->set_rules('m_newspaper', 'Newspaper', 'required');
            $this->form_validation->set_rules('a_newspaper[]', 'Add on Newspaper', 'required');
            //$this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('cat', 'Heading', 'required');
            $this->form_validation->set_rules('inse', 'Insertion', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                //$data['id']=$id;
                $data['msg']="1";
                echo json_encode($data);
                return;
            }
            else
            {
                $id=$this->input->post('m_newspaper');
                $query = $this->db->query("SELECT tbl_paper_city.*,n.name as newspaper_name,c.name as city_name FROM tbl_paper_city
                LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.`paper_id`
                LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.`city_id`
                WHERE tbl_paper_city.id='". $this->input->post('a_newspaper')."'
                ");			
               
                $p_n=$query->row();
                $td=$p_n->newspaper_name ." ,".$p_n->city_name;

                $values = array(								
                    'm_newspaper_id' => $this->input->post('m_newspaper'),
                    'a_newspaper_id' => $this->input->post('a_newspaper'),
                    'type_id' => 3,
                    'cat_id' => $this->input->post('cat'),
                    'insertion' => $this->input->post('inse'),
                    'city' =>$this->input->post('city'),
                    'data'=>$td,
                    'color'=>$this->input->post('color')
                );

               // $query = $this->db->query("SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' ) OR (`m_paper_id` = '".$values['a_newspaper_id']."' AND `a_paper_id` = '".$values['m_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' )");
 $query = $this->db->query("SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' ) ");


                $rates=$query->row();
               
               
                if(empty($rates))
                {

                     $query = $this->db->get_where('tbl_paper_city', array('id' => $values['a_newspaper_id']));
                    $np= $query->row();	

                    $query = $this->db->query("SELECT id, `ad_price` as price, `extra_price` as e_price FROM `tbl_ad_price` WHERE `newspaper_id` = '".$np->paper_id ."' AND city='".$np->city_id ."' AND `ad_type` = '". 3 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");

                    $rates1= $query->row();
                   
                    if(empty($rates1))
                    {
                        $data['id']=$id;
                        $data['msg']="2";
                        echo json_encode($data);
                        return;
                    }
                    else
                    {                
                        $data['rates']= $rates1;
                         $data['values']= $values;
                        echo json_encode($data);
                        return;
                    }
                }
                else
                {
                   $data['rates']= $rates;
                $data['values']= $values;
                        echo json_encode($data);
                        return;
                }
            }
        }
        else
        {
            //$data['id']=$id;
            $data['msg']="1";
            echo json_encode($data);
            return;
        }
    }
	
	public function commission($id)
	{
		if (!empty($this->input->post())) 
		{
			$values = array(
				'comm1' => $this->input->post('comm1'),
				'comm2' => $this->input->post('comm2'),
				'comm3' => $this->input->post('comm3'),
				'comm4' => $this->input->post('comm4'),
				'comm5' => $this->input->post('comm5'),
				'comm6' => $this->input->post('comm6'),
				'comm7' => $this->input->post('comm7'),
				'comm8' => $this->input->post('comm8'),
				'tax' => $this->input->post('tax'),
				'comm_a' =>0,
				'tax_a' =>0,
				'p_amount' =>0,
			);
			$ro_a=$this->input->post('ro_a');
			$comm_a=0;
			$comm=$ro_a*$values['comm1']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm;
			$comm=$ro_a*$values['comm2']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$comm=$ro_a*$values['comm3']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$comm=$ro_a*$values['comm4']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$comm=$ro_a*$values['comm5']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$comm=$ro_a*$values['comm6']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$comm=$ro_a*$values['comm7']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$comm=$ro_a*$values['comm8']/100;
			$ro_a=$ro_a-$comm;
			$comm_a=$comm_a+$comm;
			$values['comm_a']=$comm_a;
			
			
			$values['tax_a']=$ro_a*$values['tax']/100;
			
			$values['p_amount']=$ro_a+$values['tax_a'];
			
			$this->db->update('tbl_book_ads',$values, "id =".$id);	
			$this->session->set_flashdata('msg', 'Ad commission and tax Successfully add');
			redirect('admin/book_ads');
							
		}
		else
		{
			$query = $this->db->get('tbl_tax');
			$data['taxs']= $query->result();
			
			$query = $this->db->get_where('tbl_book_ads', array('id' => $id));
			$data['ro']= $query->result();
							
			$this->load->view('admin/header');
			$this->load->view('admin/book_ro_comm',$data);
			$this->load->view('admin/footer');
		}
	}

	
	public function edit($id,$go="")
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
				redirect('admin/booking_hd_ro/edit/'.$id);
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
				    'ngb_id' =>$gid->g_id,
					'u_id' => $this->input->post('client'),
					'e_id' => $this->input->post('employee'),
					'newspaper_id' => $ng->paper_id,
					'paper_city_id' => $this->input->post('newspaper'),
				//	'title' => $this->input->post('title'),
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
				
				
         $publish_date=array($this->input->post('p_date'));$inse_dop = $this->input->post('dop_inse');
$free_days=$this->input->post('free_days');
$dop_amt = ($values['t_amount'] - ($values['t_amount'] * $values['dis_per'])/100)/ ($inse_dop);
$dop_amt_a = ($values['add_on_a']- ($values['add_on_a']*$values['dis_per'])/100)/($inse_dop);

     
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
                            'ro_no'=>$ro_no,
                            'work_year'=>$_SESSION['work_year'],
                            'paper_id'=>$dates['id'],
                            'dop'=>$dd,
                            'dop_amount'=>$dop_amount,
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop', $values1);
                    $i++;
                    //  echo $this->db->last_query();
                         }
                    }
                  
				}
				if($values['ro_type']=="P")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
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
                            'ro_no'=>$ro_no,
                            'work_year'=>$_SESSION['work_year'],
                            'paper_id'=>$dates['id'],
                            'dop'=>$dd,
                            'dop_amount'=>$dop_amount,
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop', $values1);
                    $i++;
                         }
                    }
                  
                }
				}
				
				if($values['ro_type']=="M")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$this->db->delete("tbl_ro_dop","ro_id=".$id);
					$in_id=$id;
					
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
                            'ro_no'=>$ro_no,
                            'work_year'=>$_SESSION['work_year'],
                            'paper_id'=>$row['id'],
                            'dop'=>$dd,
                            'dop_amount'=>$dop_amount,
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop', $values1);
                    $i++;
                         }
                    }
                    
                  
                }	
				}				
				
				$msg="5";
				echo $msg;						
				return;
			}
		}
		else
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
			
			//$data['dops_json']=json_encode($data['dops']);
			//$query = $this->db->get('tbl_newspapers');
			//$data['newspapers']= $query->result();
									
			$query = $this->db->get('tbl_client');
			$data['clients']= $query->result();
			
			$query = $this->db->get('tbl_employee');
			$data['employees']= $query->result();
			
			$data['go']= $go;
			
			$this->load->view('admin/header');
			$this->load->view('admin/hd_ro_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function del($id)
	{
		$query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
		$ro= $query->row();
		$old_amount =$ro->ad_cost;
			
		if($this->db->delete("tbl_book_ads","id=".$id) && $this->db->delete("tbl_ro_dop","ro_id=".$id))
		{
			
			$query = $this->db->get_where('tbl_client', array('id' => $ro->u_id));				
			$client= $query->row();
			if($client->credit_bal > $old_amount && $ro->pending=='C' )
			{
				$bal=$client->credit_bal+$old_amount;
				$values1 = array('credit_bal' =>$bal);
				$this->db->update('tbl_client',$values1, "id =".$client->id);
			}
			
			$this->session->set_flashdata('msg', 'Ad Delete Successfully.');
			redirect('admin/booking_hd_ro');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Ad not Delete Successfully.');
			redirect('admin/booking_hd_ro');
		}
	}
	
	
	public function info($id)
	{
		$book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, p.position as cat_name, e.e_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
		INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
		INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
		INNER JOIN tbl_position p ON p.id=tbl_book_ads.cat_id
		INNER JOIN tbl_employee e ON e.e_id=tbl_book_ads.e_id
		INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id = '".$id."'" );
		
		$a= $book_ads->result();
		$data['book_ad']=$a[0];	
		
		$ads_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop
		INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
		INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."'" );
				
	
		$data['ad_dops']=$ads_dop->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/hd_ro_info',$data);
		$this->load->view('admin/footer');
	}
	
	public function ro($id)
	{
		$book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, p.position as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
		INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
		INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
		INNER JOIN tbl_position p ON p.id=tbl_book_ads.cat_id
		INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id = '".$id."'" );
		
		$a= $book_ads->result();
		$data['book_ad']=$a[0];	
		
		$ads_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop
		INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
		INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."'" );
				
	
		$data['ad_dops']=$ads_dop->result();
		
		$p_cities=explode(",",$data['book_ad']->city);
		$data['p_cities']= $p_cities;
		
		$query = $this->db->get('tbl_cities');
		$data['cities']= $query->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/book_ads_ro',$data);
		$this->load->view('admin/footer');
	}	
}
?>