<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Book_ads extends CI_Controller
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

        if(!empty($this->input->post('search_text')))
        {
            $name=$this->input->post('search_text');
            $data['name']= $name;
            $book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
			LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
			LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE (tbl_book_ads.pending='C' AND tbl_book_ads.type_id='1' AND tbl_book_ads.work_year='".$_SESSION['work_year']."') AND (tbl_book_ads.ro_no LIKE '%".$name."%' OR n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%' OR u.client_name LIKE '%".$name."%' OR u.email LIKE '%".$name."%') ORDER BY ro_no ASC");
          // echo $this->db->last_query();
          // die;
            $config["base_url"] = base_url() . "admin/book_ads/index";
          $config["total_rows"] = $book_ads->num_rows();
            $config["per_page"] = 20;
            $config["uri_segment"] = 4;			

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
			LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
			LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE (tbl_book_ads.pending='C' AND tbl_book_ads.type_id='1' AND tbl_book_ads.work_year='".$_SESSION['work_year']."') AND (tbl_book_ads.ro_no LIKE '%".$name."%' OR n.name LIKE '%".$name."%' OR t.name LIKE '%".$name."%' OR c.name LIKE '%".$name."%' OR u.user_name LIKE '%".$name."%' OR u.email LIKE '%".$name."%') ORDER BY ro_no ASC");

            $data['book_ads']= $book_ads->result();
        }
        else
        {
            //die();
          
            $book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile FROM tbl_book_ads
			LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
			LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE (tbl_book_ads.pending='C' AND tbl_book_ads.type_id='1' AND tbl_book_ads.work_year='".$_SESSION['work_year']."')  ORDER BY id DESC ");
            $config = array();
            $config["base_url"] = base_url(). "admin/book_ads/index";
            $config["total_rows"] = $book_ads->num_rows();
            $config["per_page"] = 60;
            $config["uri_segment"] = 4;
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
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
			LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
			LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
			LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
			LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE (tbl_book_ads.pending='C' AND tbl_book_ads.type_id='1' AND tbl_book_ads.work_year='".$_SESSION['work_year']."')   ORDER BY id DESC limit {$config['per_page']} offset {$page} ");//limit {$config['per_page']} offset {$page}
            $data['book_ads']= $book_ads->result();
          // echo $this->db->last_query(); die;
        }

        $data["links"] = $this->pagination->create_links();
        $data['per_page'] = 20;
        $data['offset'] = $page ;
        $data["total_rows"] = $config["total_rows"];
        $data["curr_page"] = $this->pagination->cur_page ; 

        $this->load->view('admin/header');
        $this->load->view('admin/book_ads_list',$data);
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
			
        $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
            LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
            LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id order by newspaper_name ");
            

        $data['newspapers']= $query->result();

        $query = $this->db->get_where('tbl_news_type', array('base_type' => 'T'));
        $data['types']= $query->result();

        $query = $this->db->get('tbl_categories');
        $data['cats']= $query->result();
        
        $this->db->select('*');
        $this->db->from('tbl_client');
        $this->db->order_by('client_name','ASC');
        $query = $this->db->get(); 
        $data['clients']= $query->result();
        
        $query = $this->db->get('tbl_tax');
        $data['taxs']= $query->result();

        $query = $this->db->get('tbl_employee');
        $data['employees']= $query->result();
        
        $query=$this->db->get_where('tbl_scheme');
        $data['schemes']=$query->result();

         $client_id=$_POST['client'];
         echo $client_id;
        $agencyid=$this->db->query("SELECT agency_id from tbl_client where id='".$client_id."'");
        $data['ag_id']=$agencyid->result();
        $query = $this->db->query("select * from tbl_agency where agency_id='".$ag_id."'");
        $data['agencies']= $query->result();
        //echo "<pre>"; var_dump($data['agencies']); 

        //echo json_encode($data); die;
        $this->load->view('admin/header');
        $this->load->view('admin/book_ads_add',$data);
        $this->load->view('admin/footer');
    }

    public function get_agency()
    {
       $id=$_POST['id'];

         
        $query = $this->db->get_where('tbl_client', array('id' => $id));
        $ng= $query->row();
        $id1=array_map('intval',explode(",",$ng->agency_id));
        $id='2';
        $this->db->select('*');
        $this->db->where_in('agency_id',$id1);
        $agency1=$this->db->get('tbl_agency');
        
    
           $agency=$agency1->result();
        echo json_encode($agency);

    }
    
    
    public function get_newspaper()
    {
        $id=$_POST['paper'];

        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
        $ng1= $query->row();

        $query = $this->db->get_where('tbl_newspapers', array('id' => $ng1->paper_id));
        $ng= $query->row();

        $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE n.g_id='".$ng->g_id."' AND tbl_paper_city.id !='".$id."'");
      
        $newspaper= $query->result();

        echo json_encode($newspaper);

    }


    public function get_price()
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
                    'type_id' => 1,
                    'cat_id' => $this->input->post('cat'),
                    'insertion' => $this->input->post('inse'),
                    'city' => $ng->city_id
                    
                );

                $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '1' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `date_to` ='0000-00-00'");	
              
                $rates=array();
                $rates=$query->row();

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


    public function get_dop_price()
    {
        $date=($this->input->post('s_date'));		

        $id=$this->input->post('newspaper');

        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
        $ng= $query->row();	

        $values = array(
            'count'=>$this->input->post('count'),
            'newspaper_id' => $ng->paper_id,
            'type_id' => 1,
            'cat_id' => $this->input->post('cat'),
            'insertion' => $this->input->post('inse'),
            'city' => $ng->city_id,
            's_date'=>date("Y-m-d",strtotime($date))
        );

        $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `date_from`<='".$values['s_date']."'") ;
       //$query =  $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `date_from`<='".$values['s_date']."' and  `date_to` >='".$values['s_date']."' and `date_to`!='0000-00-00'");
       //echo $this->db->last_query();
        //die;

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
     public function get_base_dop_price()
    {
        $date=($this->input->post('s_date'));		

        $id=$this->input->post('newspaper');

        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
        $ng= $query->row();	

        $values = array(
            'count'=>$this->input->post('count'),
            'newspaper_id' => $ng->paper_id,
            'type_id' => 1,
            'cat_id' => $this->input->post('cat'),
            'insertion' => $this->input->post('inse'),
            'city' => $ng->city_id,
            's_date'=>date("Y-m-d",strtotime($date))
        );

        $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `date_from`<='".$values['s_date']."'") ;
     

        $rates= $query->result();

        foreach($rates as $rate)
        {
            
            if($rate->revise_rate==1)
            {
                if($rate->date_from <= $values['s_date'] AND $rate->date_to >= $values['s_date'] AND $rate->date_to!="0000-00-00")
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
 public function get_addon_dop_price()
    {
        $date=($this->input->post('s_date'));		

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
                 'type_id' => 1,
                 'cat_id' => $this->input->post('cat'),
                 'insertion' => $this->input->post('inse'),
                 'city' => $ng->city_id,
                 'size'=>$this->input->post('size'),
                 's_date'=>date("Y-m-d",strtotime($date))
        );

         $query = $this->db->query("SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."' ) ");

            $rates=$query->result();


                if(empty($rates))
                {

                    $query = $this->db->get_where('tbl_paper_city', array('id' => $values['a_newspaper_id']));
                    $np= $query->row();	

                    $query = $this->db->query("SELECT id, `ad_price` as price, `extra_price` as e_price FROM `tbl_ad_price` WHERE `newspaper_id` = '".$np->paper_id ."' AND city='".$np->city_id ."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");

                    $rates1= $query->result();
                  

                    if(!empty($rates1))
                    {
                       $rates = $rates1;
                     }
                     else
                     {
                        $msg="1";
                        echo $msg;
                        return;  
                     }
                }

     //  echo var_dump($rates);

        foreach($rates as $rate)
        {
            
            if($rate->revise_rate==1)
            {
                if($rate->date_from <= $values['s_date'] AND $rate->date_to >= $values['s_date'] AND $rate->date_to!="0000-00-00")
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
//echo var_dump($rate1);
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
                    'newspaper_id' => $id,
                    'type_id' => 1,
                    'cat_id' => $this->input->post('cat'),
                    'city' => $this->input->post('city')
                );

                $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."'");	

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



    public function save()
    {

        //var_dump($_POST); return;
        $this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
        $this->form_validation->set_rules('client', 'Client', 'required');
        $this->form_validation->set_rules('cat', 'Heading', 'required');
        $this->form_validation->set_rules('w_count', 'No. of words', 'required');
        //$this->form_validation->set_rules('matter', 'Matter', 'required');
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
           // echo $this->db->last_query();
            $gid=$query1->row();
           // echo var_dump($gid);
            if($this->input->post('premimum')!=null)
            {
                $premimum=implode(",",$this->input->post('premimum'));
            }
            else
            {
                $premimum="";
            }
            $this->load->model("ro_model");
            $ro_no=$this->ro_model->gen_ro_no("NP",$_SESSION['work_year']); 
           // $result=$this->db->where(array('work_year'=>$_SESSION['work_year'],'type_id'=>1))->select_max('ro_no')->get('tbl_book_ads')->row();
            //$ro_no=$result->ro_no+1; 

            $upload_file_name="";
            if($_FILES['upload_file']['name']){
                //print_r(images'); die;
                $config['upload_path']   = './images/ro/'; 
                $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|cdr'; 
                $config['max_size']      = 5248; 
                // $config['max_width']     = 1024; 
                // $config['max_height']    = 768;  
                $upload_file_name=$ro_no."-".$_SESSION['work_year'].".".end(explode(".",$_FILES['upload_file']['name']));
                $config['file_name'] = $upload_file_name;
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);
                //$this->upload->initialize($config);
                //print_r($this->upload->do_upload('upload_file')); die;
                if (!$this->upload->do_upload('upload_file')){
                    die($this->upload->display_errors());
                    $error = array('error' => $this->upload->display_errors());
                    $this->add();
                }
            }  


            if($this->input->post('add_a')==0.00){
                $ro_type="N";
            }else{
                $ro_type="M";
            }
            

            $values = array(
                'ro_no' => $ro_no,
                'ngb_id' =>$gid->g_id,
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
                'min_words'=>$this->input->post('min_w'),
                'size_words' => $this->input->post('w_count'),
                'unit'=>$this->input->post('unit'),
                'tax' => 0,
                'publish_day'=> $this->input->post('inse'),
                'other_day_f'=> $this->input->post('nfdc'),
                'ro_type' =>$this->input->post('ro_type'),
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
 $prem=$this->input->post('prem');          
$inse_dop = $this->input->post('dop_inse');
$free_days=$this->input->post('free_days');
$amount=$values['t_amount']-$values['add_on_a'];
$dop_amt = ($amount - (($amount * $values['dis_per'])/100)- (($amount * $prem)/100))/ ($inse_dop);
$dop_amt_a = ($values['add_on_a']- ($values['add_on_a']*$values['dis_per'])/100)/($inse_dop);

         $publish_date=array($this->input->post('p_date'));
  //    echo var_dump($publish_date);
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
                         
                        $c=count($days);
                        
                        if($c < $values['insertion'])
                        {
                            $msg="2";
                            echo $msg;						
                            return;
                        }
                        }
                    }
                   // die();
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

//echo $values['pending'];
                //$values['tax_a']=$ro_a*$values['tax']/100;

                $values['p_amount']=$values['ad_cost'];

                //				$ro_no=ro_no_gen("NP");
                //				$values['ro_no']=$ro_no;
                $in_id=0;
           
               if($values['pending']=="P")
                {  
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
                            'paper_id'=>$this->input->post('newspaper'),
                            'dop'=>date('Y-m-d',strtotime($dd)),
                            'dop_amount'=>number_format($dop_amount, 2),
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
                            'paper_id'=>$this->input->post('newspaper'),
                            'dop'=>date('Y-m-d',strtotime($dd)),
                            'dop_amount'=>number_format($dop_amount, 2),
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
                            'dop'=>date('Y-m-d',strtotime($dd)),
                            'dop_amount'=>number_format($dop_amount, 2),
                            'c_date'=> date('Y-m-d H:i:s')
                        );
                    $query = $this-> db->insert('tbl_ro_dop_temp', $values1);
               
                    $i++;
                         }
                    }
                    
                  
                }	
                }
                    
                }
                else
                {
                            if($values['ro_type']=="N")
                    {
                        $query = $this-> db->insert('tbl_book_ads', $values);
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
                                'ro_no'=>$ro_no,
                                'work_year'=>$_SESSION['work_year'],
                                'paper_id'=>$this->input->post('newspaper'),
                                  'price'=>$values['price'],
                            'eprice'=>$values['ex_price'],
                                'dop'=>date('Y-m-d',strtotime($dd)),
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
                        $values['book_id']=0;
                        $values['ro_no']=0;
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
                                'paper_id'=>$this->input->post('newspaper'), 
                                'price'=>$values['price'],
                                'eprice'=>$values['ex_price'],
                                'dop'=>date('Y-m-d',strtotime($dd)),
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
                        $query = $this-> db->insert('tbl_book_ads', $values);
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
                                'ro_no'=>$ro_no,
                                'work_year'=>$_SESSION['work_year'],
                                'paper_id'=>$row['id'],
                                 'price'=>$row['price'],
                                'eprice'=>$row['eprice'],
                                'dop'=>date('Y-m-d',strtotime($dd)),
                                'dop_amount'=>$dop_amount,
                                'c_date'=> date('Y-m-d H:i:s')
                            );
                        $query = $this-> db->insert('tbl_ro_dop', $values1);
                        $i++;
                             }
                        }
                        
                      
                    }	
                    }
                }
                /* update ro number into tbl_ro_no if ro number is greater than previous into same working year */
            if($values['pending']=='C'){  
$where= array(  
                    'ro_no'=>$ro_no,
                    'ro_type'=>"NP",
                    'year'=>$_SESSION['work_year']
                );
               $this->ro_model->update_ro_no($where);
                $book_ads=$this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, po.name as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads
INNER JOIN tbl_ro_dop d ON d.ro_id=tbl_book_ads.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_categories po ON po.id=tbl_book_ads.cat_id
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$in_id."'");
}
else
{
    $book_ads=$this->db->query("SELECT tbl_book_ads_temp.*, n.name as newspaper_name, t.name as type_name, po.name as cat_name, u.email, u.mobile, u.client_name,d.dop  FROM tbl_book_ads_temp
INNER JOIN tbl_ro_dop_temp d ON d.ro_id=tbl_book_ads_temp.id
INNER JOIN tbl_paper_city p ON p.id=d.paper_id
INNER JOIN tbl_newspapers n ON n.id=p.paper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads_temp.type_id
INNER JOIN tbl_categories po ON po.id=tbl_book_ads_temp.cat_id
INNER JOIN tbl_client u ON u.id=tbl_book_ads_temp.u_id WHERE tbl_book_ads_temp.id='".$in_id."'");

}
    $book_ad= $book_ads->result();

                echo json_encode($book_ad);
                return;
redirect("admin/book_ads");
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

                $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");	
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
                LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
                LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
                LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
                LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id='".$in_id."'");
                $book_ad= $book_ads->result();
                echo json_encode($book_ad);
                return;
            }
        }
    }

    //    public function get_city()
    //    {
    //        $newspaper_id=$_POST['newspaper_id'];
    //        $query = $this->db->get_where('tbl_paper_city', array('id' => $newspaper_id));
    //        $newspaper= $query->row();
    //        $query=$this->db->query("SELECT tbl_paper_city.*,c.name FROM tbl_paper_city 
    //		LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE paper_id='".$newspaper_id."'");
    //        $city= $query->result();
    //        echo json_encode($city);
    //    }

    public function get_city_by_id()
    {
        $newspaper_id=$_POST['newspaper_id'];
        $this->db->select('tbl_news_group.ng_name');
        $this->db->from('tbl_news_group');
        $this->db->join('tbl_newspapers', 'tbl_newspapers.g_id = tbl_news_group.ng_id');
        $this->db->where(['id' => $newspaper_id]);
        $query = $this->db->get()->row();

        $this->db->select('tbl_news_group.ng_city');
        $this->db->from('tbl_news_group');
        $this->db->where(['ng_name' => $query->ng_name]);
        $query = $this->db->get()->result();
        echo json_encode($query);
    }



    public function get_state($newspaper_id=null)
    {
        $this->load->model("ro_model");
        echo json_encode($this->ro_model->get_states($_POST['newspaper_id']));
    }


    public function get_heading()
    {
        $id=$_POST['id'];		
        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
        $ng= $query->row();	
        $id=$ng->paper_id;
               $query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
                LEFT JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
                LEFT JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$id."'");
      //  $query = $this->db->query("SELECT id,name as cat_name FROM tbl_categories");
     // echo $this->db->last_query(); return;
        $heading= $query->result();
        echo json_encode($heading);
    }

    public function get_sub_heading()
    {
        $id=$_POST['cat_id'];
        $query = $this->db->get_where('tbl_sub_heading', array('cat_id' => $id));
      // echo $this->db->last_query(); return;
        $sh= $query->result();
        echo json_encode($sh);
    }

    public function get_scheme()
    {
        $id=$_POST['n_id'];
        $cat_id=$_POST['cat_id'];		
        $query = $this->db->query("SELECT * FROM `tbl_paper_scheme` WHERE `np_id`='".$id."' AND `type_id`='1' AND `cat_id`='".$cat_id."' GROUP BY `scheme_id`");
        $sch= $query->result();
        echo json_encode($sch);
    }

    public function get_scheme_price()
    {
        $id=$_POST['s_id'];
        $query = $this->db->get_where('tbl_scheme', array('scheme_id' => $id));
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
        $query = $this->db->get_where('tbl_premimum', array('g_id' =>$ng->g_id,'type_id'=>1));
//echo $this->db->last_query();
//die;
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
        $city=$_POST['city'];
     //   $id=1;
		$query = $this->db->get_where('tbl_paper_city', array('id' => $id));
		$ng= $query->row();
		$id=$ng->paper_id;

		$query = $this->db->get_where('tbl_newspapers', array('id' => $id));
		$ng= $query->row();

       // $query = $this->db->query("SELECT tbl_package .* ,p.paper_id FROM tbl_package
        //LEFT JOIN tbl_pack_paper p ON p.pack_id=tbl_package.id
        //WHERE p.paper_id='".$id."' AND tbl_package.cat_id='". $cat_id ."' AND tbl_package.type_id='1' AND tbl_package.ins_from <= '".$insertion."' AND tbl_package.ins_to >= '".$insertion."' GROUP BY tbl_package.id");
       // echo  $this->db->last_query();
      //  die;
      $query = $this->db->query("SELECT * FROM `tbl_package` WHERE `g_id`='".$ng->g_id ."' AND `cat_id`='". $cat_id ."' AND type_id='1' AND `ins_from` <= '".$insertion."' AND `ins_to` >= '".$insertion."'");
        $pack= $query->result();
        echo json_encode($pack);
    }
public function get_package_dop_price()
{
    $pack_id=$this->input->post('pack_id');		
        $query = $this->db->get_where('tbl_package', array('id' => $pack_id));
        $pack= $query->row();
         $query=$this->db->where(["tax_type"=>"newspaper"])->get("tbl_tax")->row();
                $pack->gst=$query->tax_rate;
        $data['pack']=$pack;
        //$id=$ng->paper_id;
        $date=date_create($this->input->post('s_date'));
        $query = $this->db->query("SELECT tbl_pack_paper.*, n.name as newspaper_name FROM tbl_pack_paper LEFT JOIN tbl_paper_city c ON c.id=tbl_pack_paper.paper_id LEFT JOIN tbl_newspapers n ON n.id=c.paper_id WHERE tbl_pack_paper.pack_id ='".$pack_id."'");
       $rates= $query->result();	
         foreach($rates as $rate)
        {
            
            if($rate->revise_rate==1)
            {
                if($rate->from_date <= $date AND $rate->to_date >= $date)
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
                if($rate->from_date <= $date )
                {
                    $rate1=$rate;
                }
                else
                {
                    continue;
                }
            }
        }
    $data['pack_paper']= $rate1;	
        echo json_encode($data);

    
}
    public function get_package_price()
    {
        //sleep(50);
        $pack_id=$this->input->post('pack_id');		
        $query = $this->db->get_where('tbl_package', array('id' => $pack_id));
        $pack= $query->row();
         $query=$this->db->where(["tax_type"=>"newspaper"])->get("tbl_tax")->row();
                $pack->gst=$query->tax_rate;
        $data['pack']=$pack;
        //$id=$ng->paper_id;
        $query = $this->db->query("SELECT tbl_pack_paper.*, n.name as newspaper_name FROM tbl_pack_paper LEFT JOIN tbl_paper_city c ON c.id=tbl_pack_paper.paper_id LEFT JOIN tbl_newspapers n ON n.id=c.paper_id WHERE tbl_pack_paper.pack_id ='".$pack_id."'");
       	
         
    $data['pack_paper']=  $query->result();	
        echo json_encode($data);
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
                  //  echo $this->db->last_query();
//die;
                    $values = array(								
                        'newspaper_id' => $ng->paper_id,
                        'type_id' => 1,
                        'cat_id' => $this->input->post('cat'),
                        'insertion' => $this->input->post('inse'),
                        'city' =>$ng->city_id
                    );

                    $query = $this->db->query("SELECT tbl_ad_price.*,n.name as newspaper_name,c.name as city_name FROM `tbl_ad_price`
					LEFT JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
					LEFT JOIN tbl_cities c ON c.id=tbl_ad_price.city
					WHERE tbl_ad_price.newspaper_id= '".$values['newspaper_id']."' AND tbl_ad_price.city='".$values['city']."' AND tbl_ad_price.ad_type = '". $values['type_id'] ."' AND tbl_ad_price.ad_cat_id = '".$values['cat_id']."' AND tbl_ad_price.ins_from <= '".$values['insertion']."' AND tbl_ad_price.ins_to >= '".$values['insertion']."'");
//echo $this->db->last_query();
//die;
                    //$query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 2 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");

                    $rates= $query->row();
                    $query=$this->db->where(["tax_type"=>"newspaper"])->get("tbl_tax")->row();
                $rates->gst=$query->tax_rate;	

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
                    $data['values']=$values;
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

    public function get_ad_on_price()
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
                    'type_id' => 1,
                    'cat_id' => $this->input->post('cat'),
                    'insertion' => $this->input->post('inse'),
                    //'size' =>$this->input->post('size'),
                    'data'=>$td,
                    //'city'=>$p_n->city_name
                );

                $query = $this->db->query("SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' ) ");
            $rates=$query->row();


                if(empty($rates))
                {

                    $query = $this->db->get_where('tbl_paper_city', array('id' => $values['a_newspaper_id']));
                    $np= $query->row();	

                    $query = $this->db->query("SELECT id, `ad_price` as price, `extra_price` as e_price FROM `tbl_ad_price` WHERE `newspaper_id` = '".$np->paper_id ."' AND city='".$np->city_id ."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");

                    $rates1= $query->row();
                   // $data['rates']= $rates;

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
            $dt=new DateTime($this->input->post('book_date'));
            //echo "<pre>"; var_dump($dt->format("Y-m-d")); die;
            $this->form_validation->set_rules('newspaper', 'Newspaper', 'required');			
            $this->form_validation->set_rules('client', 'Client', 'required');
            $this->form_validation->set_rules('cat', 'Heading', 'required');
            $this->form_validation->set_rules('w_count', 'No. of words', 'required');
            $this->form_validation->set_rules('matter', 'Matter', 'required');

            if ($this->form_validation->run() == FALSE)
            {

                redirect('admin/book_ads/edit/'.$id);
            }
            else
            {
                $query = $this->db->get_where('tbl_paper_city', array('id' => $this->input->post('newspaper')));
            $ng= $query->row();
            $query1=$this->db->get_where('tbl_newspapers',array('id'=>$ng->paper_id));
           // echo $this->db->last_query();
            $gid=$query1->row();
                if($this->input->post('premimum') !=null)
                {
                    $premimum=implode(",",$this->input->post('premimum'));
                }
                else
                {
                    $premimum="";
                }
                 $ro_no=$this->input->post('ro_no');
                $values = array(
                'ngb_id' =>$gid->g_id,
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
                'min_words'=>$this->input->post('min_w'),
                'size_words' => $this->input->post('w_count'),
                'unit'=>$this->input->post('unit'),
                'tax' => 0,
                'publish_day'=> $this->input->post('inse'),
                'other_day_f'=> $this->input->post('nfdc'),
                'ro_type' =>$this->input->post('ro_type'),
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
               'book_date'=>date("Y-m-d",strtotime($this->input->post('book_date'))),
                'status' => ($this->input->post('status') == 'on') ? 'A' : 'A'
                    //'status' => ($this->input->post('status') == 'on') ? 'A' : 'A',
                    //'c_date' => date('Y-m-d H:i:s')
                );
               
             
  $prem=$this->input->post('prem');          
$inse_dop = $this->input->post('dop_inse');
$free_days=$this->input->post('free_days');
$amount=$values['t_amount']-$values['add_on_a'];
$dop_amt = ($amount - (($amount * $values['dis_per'])/100)- (($amount * $prem)/100))/ ($inse_dop);
$dop_amt_a = ($values['add_on_a']- ($values['add_on_a']*$values['dis_per'])/100)/($inse_dop);
         $publish_date=array($this->input->post('p_date'));
    // echo var_dump($publish_date);
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

                $ro_no=$ro->ro_no;
                $upload_file_name="";
                if($_FILES['upload_file']['name']){
                    //print_r(images'); die;
                    $config['upload_path']   = './images/ro/'; 
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|cdr'; 
                    $config['max_size']      = 5248; 
                    // $config['max_width']     = 1024; 
                    // $config['max_height']    = 768;  
                    $upload_file_name=$ro_no."-".$_SESSION['work_year'].".".end(explode(".",$_FILES['upload_file']['name']));
                    $config['file_name'] = $upload_file_name;
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    //$this->upload->initialize($config);
                    //print_r($this->upload->do_upload('upload_file')); die;

                    if (!$this->upload->do_upload('upload_file')){
                        die($this->upload->display_errors());
                    }
                }  



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
			
					$query=	$this->db->query("select * from tbl_ro_dop where ro_id='".$id."' ");
        			 $result=$query->result();
        			 $msg="";
        			 foreach($result as $re)
        			 {
        			     if($re->bill_status=='Y' || $re->news_bill_status=='Y')
        			     {
        			         $msg="6";
        			     }
        			 }
        			 if( $msg=="6")
        			 {
        			     	echo $msg;						
				            return;
        			 }
        			 else
        			 {
        					if(!empty($query->result()))
        					{
        					$this->db->delete("tbl_ro_dop","ro_id=".$id);
        					}
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
                                    'paper_id'=>$this->input->post('newspaper'),
                                    'price'=>$values['price'],
                                    'eprice'=>$values['ex_price'],
                                    'dop'=>date('Y-m-d',strtotime($dd)),
                                    'dop_amount'=>number_format($dop_amount, 2, '.', ''),
                                    'c_date'=> date('Y-m-d H:i:s')
                                );
                          //      echo var_dump($values1);
                            $query = $this-> db->insert('tbl_ro_dop', $values1);
                            $i++;
                            //  echo $this->db->last_query();
                                 }
                                
                            }
        			 }
                  
				}
				if($values['ro_type']=="P")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
					$query=	$this->db->query("select * from tbl_ro_dop where ro_id='".$id."' ");
					 $result=$query->result();
        			 $msg="";
        			 foreach($result as $re)
        			 {
        			     if($re->bill_status=='Y' || $re->news_bill_status=='Y')
        			     {
        			         $msg="6";
        			     }
        			 }
        			 if( $msg=="6")
        			 {
        			     	echo $msg;						
				            return;
        			 }
        			 else
        			 {
        					if(!empty($query->result()))
        					{
        					$this->db->delete("tbl_ro_dop","ro_id=".$id);
        					}
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
                                    'dop'=>date('Y-m-d',strtotime($dd)),
                                    'dop_amount'=>number_format($dop_amount, 2),
                                    'c_date'=> date('Y-m-d H:i:s')
                                );
                            $query = $this-> db->insert('tbl_ro_dop', $values1);
                            $i++;
                                 }
                            }
                            }
                }
				}
				
				if($values['ro_type']=="M")
				{
					$this->db->update('tbl_book_ads',$values, "id =".$id);
				//	echo $this->db->last_query();
					$query=	$this->db->query("select * from tbl_ro_dop where ro_id='".$id."' ");
					 $result=$query->result();
        			 $msg="";
        			 foreach($result as $re)
        			 {
        			     if($re->bill_status=='Y' || $re->news_bill_status=='Y')
        			     {
        			         $msg="6";
        			     }
        			 }
        			 if( $msg=="6")
        			 {
        			     	echo $msg;						
				            return;
        			 }
        			 else
        			 {
            					if(!empty($query->result()))
            					{
            					$this->db->delete("tbl_ro_dop","ro_id=".$id);
            			
            					}
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
                                         'price'=>$row['price'],
                                        'eprice'=>$row['eprice'],
                                        'dop'=>date('Y-m-d',strtotime($dd)),
                                        'dop_amount'=>number_format($dop_amount, 2),
                                        'c_date'=> date('Y-m-d H:i:s')
                                    );
                                $query = $this-> db->insert('tbl_ro_dop', $values1);
                              
                                $i++;
                                     }
                                }
                              
                              
                            }	
        			 }
				}				
				// 	 $this->session->set_flashdata('msg', 'Updated Successfully.');
    //         redirect('admin/book_ads');			
				
				$msg="5";
				echo $msg;						
				return;
			}
        }
        else
        {
            $ad = $this->db->get_where('tbl_book_ads', array('id' => $id,'work_year'=>$_SESSION['work_year']));
            $a=$ad->row();
            $data['book_ad']=$a;

            $this->load->model("ro_model");
            $data['states']=$this->ro_model->get_states($a->paper_city_id);
            $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
			LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
			LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
            $data['newspapers']= $query->result();

            $dops = $this->db->get_where('tbl_ro_dop', array('ro_id' => $id));
            $data['dops']=$dops->result();
            
          
            $query = $this->db->get('tbl_client');
            $data['clients']= $query->result();

            $data['go']= $go;

            $query = $this->db->get('tbl_employee');
            $data['employees']= $query->result();

            $this->load->view('admin/header');
            $this->load->view('admin/book_ads_edit',$data);
            $this->load->view('admin/footer');
        }
    }


    public function del($id)
    {
        //        $this->session->set_flashdata('msg', 'Cannot deleted right now.');
        //        redirect('admin/book_ads');
        $query = $this->db->get_where('tbl_book_ads', array('id' => $id));				
        $ro= $query->row();
        $old_amount =$ro->ad_cost;
      

        


        if($this->db->delete("tbl_book_ads","id=".$id))
        {
 $this->db->delete("tbl_ro_dop","id=".$id);


            //die($this->db->last_query());
            $query = $this->db->get_where('tbl_client', array('id' => $ro->u_id));				
            $client= $query->row();
            if(($client->credit_bal + $old_amount) < $client->credit_limit  && $ro->pending=='C' )
            {
                $bal=$client->credit_bal+$old_amount;
                $values1 = array('credit_bal' =>$bal);
                $this->db->update('tbl_client',$values1, "id =".$client->id);
            }			
            //update max ro number from current session
           $this->session->set_flashdata('msg', 'Ad Delete Successfully.');
        redirect('admin/book_ads');
         

        }
        else
        {	
        
            $this->session->set_flashdata('msg', 'Ad not Delete Successfully.');
            redirect('admin/book_ads');

        }
        $this->update_ro_no();
      
    }
    //
    //    public function update_ro_no(){
    //
    //        $result=$this->db->select('ro_no')->limit(1)->order_by(ro_no,"desc")->get_where("tbl_book_ads",['work_year'=>$_SESSION['work_year']]);
    //        $rs=$result->result();
    //
    //        $this->db->update("tbl_ro_no",["ro_no"=>($rs[0]->ro_no)-1],['work_year'=>$_SESSION['work_year']]);
    //    }
    //    
    public function info($id)
    {
        $book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name,  u.email, u.mobile, u.client_name FROM tbl_book_ads
        LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
        LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
        LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id

        LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id = '".$id."'" );
        //LEFT JOIN tbl_employee e ON e.e_id=tbl_book_ads.e_id
        $a= $book_ads->result();
        //echo "<pre>"; var_dump($a); die;
        $data['book_ad']=$a[0];	

        $ads_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop
        LEFT JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
        LEFT JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."'" );

        $data['ad_dops']=$ads_dop->result();
        $this->load->view('admin/header');
        $this->load->view('admin/book_ads_info',$data);
        $this->load->view('admin/footer');
    }

    public function ro($id)
    {

        $book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name,s.scheme_name,s.paid,p.p_type, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name, b.ad_price as b_ad_price, d.price as d_add_price FROM tbl_book_ads LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id LEFT JOIN tbl_ad_price b ON b.newspaper_id=tbl_book_ads.newspaper_id AND b.ad_type=tbl_book_ads.type_id AND b.ad_cat_id=tbl_book_ads.cat_id AND b.city=tbl_book_ads.state_id LEFT JOIN tbl_add_on d ON d.a_paper_id=tbl_book_ads.add_on_a AND d.ad_type=tbl_book_ads.type_id AND d.ad_cat_id=tbl_book_ads.cat_id 
        LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id LEFT JOIN tbl_scheme s ON s.scheme_id=tbl_book_ads.scheme
        LEFT JOIN tbl_premimum p ON p.id=tbl_book_ads.premimum WHERE tbl_book_ads.id = '".$id."'" );
        //LEFT JOIN tbl_employee e ON e.e_id=tbl_book_ads.e_id
        $a= $book_ads->result();
        //echo "<pre>"; var_dump($a); die;
        $data['book_ad']=$a[0];	

        $ads_dop = $this->db->query("SELECT tbl_ro_dop.*,  n.name as newspaper_name FROM tbl_ro_dop
        LEFT JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
        LEFT JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."'" );
 
        $data['ad_dops']=$ads_dop->result();	
        $ads_dop1 = $this->db->query("SELECT distinct tbl_ro_dop.paper_id,  n.name as newspaper_name FROM tbl_ro_dop
        LEFT JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
        LEFT JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."'" );
         $data['paper']=$ads_dop1->result();
        $this->load->view('admin/header');
        $this->load->view('admin/book_ads_ro',$data);
        $this->load->view('admin/footer');
    }

    public function ro1($id)
    {
        $book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
        LEFT JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
        LEFT JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
        LEFT JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
        LEFT JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id = '".$id."'" );

        $a= $book_ads->result();
        $data['book_ad']=$a[0];	

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