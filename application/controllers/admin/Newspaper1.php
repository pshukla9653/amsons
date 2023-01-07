<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newspaper extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		}
		if($this->session->userdata('access')->settings==0)
		{
			redirect('admin/dashboard');
		}
		$this->load->library("pagination");
	}
	
	
//Newspaper Group functions 

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
			
			$newspaper_group= $this->db->query("SELECT * from tbl_news_group WHERE ng_name LIKE '%".$name."%'");
			
			
			$config["base_url"] = base_url() . "admin/newspaper/index";
			$config["total_rows"] = $newspaper_group->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
						
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->db->query("SELECT * from tbl_news_group WHERE ng_name LIKE '%".$name."%' order by ng_id desc limit {$config['per_page']} offset {$page}");
			
			$data['newspaper_groups']= $newspaper_group->result();
		}
		else
		{
			$newspaper_group = $this->db->get('tbl_news_group');
		
			$config["base_url"] = base_url(). "admin/newspaper/index";
			$config["total_rows"] = $newspaper_group->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	
			
			$newspaper_group = $this->db->get('tbl_news_group',$config['per_page'],$page);
			$data['newspaper_groups']= $newspaper_group->result();
			
		}
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $config["total_rows"];
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		
		$this->load->view('admin/header');	
		$this->load->view('admin/news_group_list', $data);
		$this->load->view('admin/footer');
	}

	public function group_add()
	{
		$this->load->model("site_model");
		if (!empty($this->input->post()))
		{
			//echo "<pre>";  var_dump($_POST); die;
			$this->form_validation->set_rules('name', 'Group Name', 'required',array('required' => 'You must provide a %s.','is_unique'=>'Newspaper Group with this name already Added.'));
			if ($this->form_validation->run() == FALSE)
			{
				$query = $this->db->get('states');
				$data['states']= $query->result();

				$this->load->view('admin/header');
				$this->load->view('admin/news_group_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				
				$values = array(
					'ng_name' =>$this->input->post('name'),
					'ng_fax' =>$this->input->post('fax'),
					'ng_contact_person' =>$this->input->post('c_p'),
					'ng_no_of_additions' =>$this->input->post('addition'), 
					'ng_cdate' =>date('Y-m-d H:i:s'),
					'ng_opening' =>$this->input->post('opening'),
					'ng_fm' =>(($this->input->post('fm') == 'on') ? 1 : 0)
				);
				$query = $this->site_model->insert_data('tbl_news_group', $values);
				$nid=$this->db->insert_id();
				
				for($i=0;$i<count($_POST['state']); $i++){
				$values = array(
					'newsgroup_id' =>$nid,
					'phone' =>$this->input->post('contact')[$i],
					'email' =>$this->input->post('email')[$i],
					'address' =>$this->input->post('address')[$i],
					'city' =>$this->input->post('city')[$i],
					'state' =>$this->input->post('state')[$i],
					'gst_no' =>$this->input->post('gst')[$i],
					'created_at'=>date("Y-m-d H:i:s")
				);
				$query = $this-> db->insert('tbl_news_group_details', $values);
				//$nid=$this->db->insert_id();
				$values=array(
						"group_id"=>1,
						"ledger_name"=>$this->input->post('name'),
						"opening_balance"=>$this->input->post('opening'),
						"ob_type"=>"debit",
						"editable"=>"yes",
						"master_id"=>$nid,
						"is_deleted"=>"no"
					);
					$query=$this->db->insert('tbl_ledgers',$values);
				}
				// $state_gsts=implode("|:|",$gst);
				// echo "<pre>"; var_dump($state_gsts); die;

				$this->session->set_flashdata('msg', 'Newspaper Group Successfully Added');
				redirect('admin/newspaper');
			}
		}
		else
		{
			$query = $this->db->get('states');
			$data['states']= $query->result();
			$this->load->view('admin/header');
			$this->load->view('admin/news_group_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function get_city()
	{
		$state_id=$this->input->post('state');
		
		// $query = $this->db->get_where('states', array('id' => $s_name));
		// $state= $query->row();
		
		$query = $this->db->get_where('tbl_cities', array('state_id' => $state_id));				
		$cities= $query->result();
		
		echo json_encode($cities);
		
	}
	
	public function group_edit($id)
	{
		$this->load->model("site_model");
		if (!empty($this->input->post())) 
		{			
			$this->site_model->delete_data("tbl_news_group_details",['newsgroup_id'=>$this->input->post('id')]);
			$values = array(
				'ng_name' =>$this->input->post('name'),
				'ng_fax' =>$this->input->post('fax'),
				'ng_contact_person' =>$this->input->post('c_p'),
				'ng_no_of_additions' =>$this->input->post('addition'), 
				'ng_opening' =>$this->input->post('opening'),
				'ng_fm' =>(($this->input->post('fm') == 'on') ? 1 : 0)
			);
			$query = $this->site_model->update_data('tbl_news_group', $values,['ng_id'=>$this->input->post('id')]);
			//$nid=$this->db->insert_id();
			//echo $this->db->last_query(); die;
			for($i=0;$i<count($_POST['state']); $i++){
			$values = array(
				'newsgroup_id' =>$this->input->post('id'),
				'phone' =>$this->input->post('contact')[$i],
				'email' =>$this->input->post('email')[$i],
				'address' =>$this->input->post('address')[$i],
				'city' =>$this->input->post('city')[$i],
				'state' =>$this->input->post('state')[$i],
				'gst_no' =>$this->input->post('gst')[$i],
				'created_at'=>date("Y-m-d H:i:s")
			);
			$query = $this-> db->insert('tbl_news_group_details', $values);
			//$nid=$this->db->insert_id();
			}	
			$this->session->set_flashdata('msg', 'Newspaper Group Successfully Added');
			redirect('admin/newspaper');
		
	}
		else
		{

			$query = $this->db->get_where('tbl_news_group', array('ng_id' => $id));
			$data['newspaper_group']= $query->row();
			
			$query = $this->db->get_where('tbl_news_group_details', array('newsgroup_id' => $id));
			$data['newspaper_group_details']= $query->result();
			
			//echo "<pre>"; var_dump($data); die;

			$query = $this->db->get('states');				
			$data['states']= $query->result();
			$data['id']=$id;
			
			foreach($data['newspaper_group_details'] as $row){
				//echo $row->state."<br>";
				$query = $this->db->get_where('tbl_cities',['state_id'=>$row->state]);				
				$data['cities'][$row->state]=$query->result();
			
			}
			//echo "<pre>"; var_dump($data['cities']); 
			//die;
			
			// $query = $this->db->get('cities',('state_id'=$data['newspaper_group_details']));				
			// $data['states']= $query->result();

			// $query = $this->db->get_where('states', array('country_id' => 101));				
			// $data['states']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/news_group_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function group_del($id)
	{	
		if($this->db->delete("tbl_news_group",array('ng_id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Newspaper Group Delete Successfully.');
			redirect('admin/newspaper');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Newspaper Group not Delete Successfully.');
			redirect('admin/newspaper');
		}		
	}
	
	
	
//Newspaper functions 	
	
	public function show()
	{
		$data['newspapers']=array();
		$c=0;
		$data['result']=$this->db->get('tbl_newspapers')->result();
		
		foreach($data['result'] as $row){
			$city="";
			$data['newspapers'][$c]['id']=$row->id;
			$data['newspapers'][$c]['name']=$row->name;
			$cities=explode(",",$row->city);
			//echo '<pre>'; var_dump($cities); die;
			foreach($cities as $value){
				$data['city']=$this->db->where(['id'=>$value])->get('tbl_cities')->row();
				$city=$city.", ".$data['city']->name;
			}
			$data['newspapers'][$c]['city']=substr($city,2);
			$c++;
		}
		//echo '<pre>'; var_dump($data['newspapers']); die;
		//die;
		$this->load->view('admin/header', $data);
		$this->load->view('admin/list_newspaper');
		$this->load->view('admin/footer');
	}

	public function get_newspaper()
    {
        $name=$this->input->post('name');
        $gid=$this->input->post('group');
      	//$newspaper = $this->db->query("SELECT * from tbl_newspapers WHERE name='".$name."' AND g_id='".$gid."'");
        $newspaper = $this->db->query("SELECT * from tbl_newspapers WHERE name='".$name."'");
        if($newspaper->num_rows())
        {
            echo "Y";
        }
        else
        {
            echo "N";
        }
           
    }


    public function get_mul_city()
	{
		$states=$this->input->post('state[]');

		//var_dump($states);
		//die;
		//$query = $this->db->get_where('states', array('name' => $s_name));
		//$state= $query->row();
		$result=array();

		foreach ($states as $state) 
		{
			$query = $this->db->get_where('tbl_cities', array('state_id' => $state));
			$cities= $query->result();

			foreach ($cities as $city) 
			{
				array_push($result,$city);
			}
		}
		
		echo json_encode($result);
		
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_newspapers.name]',array('required' => 'You must provide a %s.','is_unique'=>'Newspaper with this name already Added.'));
			$this->form_validation->set_rules('g_id', 'Newspaper Group', 'required');


			
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get_where('tbl_cities', array('state_id' => 101));	
				$data['states']= $query->result();

				$query = $this->db->get('tbl_languages');
				$data['languages']= $query->result();

				$query = $this->db->get('tbl_news_type');
				$data['types']= $query->result();
			
				$newspaper_group = $this->db->get('tbl_news_group');
				$data['news_groups']= $newspaper_group->result();
			
				$query = $this->db->get('tbl_paper_type');
				$data['paper_types']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/add_newspaper',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				//$cities=implode(",",$this->input->post('cities[]'));				
				//Set the config
				$config['upload_path'] = 'include/backend/img/logo_image/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '1000';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				$this->load->library('upload', $config);
				
				//Upload file
				if( ! $this->upload->do_upload("logo"))
				{
					//echo the errors
					//echo $this->upload->display_errors();
					$logo="";
				}
				else
				{
					//If the upload success
					$data = array('upload_data' => $this->upload->data());
					$logo = $data['upload_data']['file_name'] ;
				}

				if(!empty($this->input->post('cities[]')))
				{
					$cities=array_merge($this->input->post('states[]'),$this->input->post('cities[]'));
				}
				else
				{
					$cities=$this->input->post('states[]');
				}
				
				$con=($this->input->post('main_p') == 'on') ? '1' : '0';
				if($con=='0')
				{
					$cities=$this->input->post('cities[]');
				}
				

				$c=implode(",", $cities);
				
				$no_of_add=count($cities);

				$ad_types=$this->input->post('type[]');
				$ad_type1=0;
				$ad_type2=0;
				$ad_type3=0;

				foreach ($ad_types as $ad) 
				{
					switch ($ad) 
					{
						case '1':
							$ad_type1=1;
							break;
						case '2':
							$ad_type2=1;
							break;
						case '3':
							$ad_type3=1;
							break;
						
						default:
							
							break;
					}
				}
				
				$values = array(
								'g_id'=>$this->input->post('g_id'),
								'name' =>$this->input->post('name'),
								'short_name' =>$this->input->post('sname'),
								'language' =>$this->input->post('language'),
								'address' =>$this->input->post('address'),
								
								'p_type' =>$this->input->post('nt'),
								'main_type' =>($this->input->post('main_p') == 'on') ? '1' : '0',
								'no_of_additions' =>$no_of_add,
								'no_of_copies' =>$this->input->post('copy'),
								'city' =>$c,
								'logo' =>$logo,
								'text_ad' =>$ad_type1,
								'c_display' =>$ad_type2,
								'hd_display' =>$ad_type3,
								'print'=>($this->input->post('print') == 'on') ? '1' : '0',
								'outdoor'=>($this->input->post('outdoor') == 'on') ? '1' : '0',
								'c_date' => date('Y-m-d H:i:s')						
							);
				$query = $this-> db->insert('tbl_newspapers', $values);
				$p_id=$this->db->insert_id();

				foreach($cities as $city)
				{
					$values = array(
								'paper_id'=>$p_id,
								'city_id' =>$city
							);
					$this-> db->insert('tbl_paper_city', $values);
				}
				
				$this->session->set_flashdata('msg', 'Newspaper Successfully Added');
				redirect('admin/newspaper/show');
			}
		}
		else
		{
			$query = $this->db->get_where('tbl_cities', array('state_id' => 101));	
			$data['states']= $query->result();

			$query = $this->db->get('tbl_languages');
			$data['languages']= $query->result();

			$query = $this->db->get('tbl_news_type');
			$data['types']= $query->result();
			
			$newspaper_group = $this->db->get('tbl_news_group');
			$data['news_groups']= $newspaper_group->result();
			
			$query = $this->db->get('tbl_paper_type');
			$data['paper_types']= $query->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/add_newspaper',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function edit_newspaper($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($this->input->post('name')!=$this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_newspapers.name]',array('required' => 'You must provide a %s.','is_unique'=>'Newspaper with this name already Added.'));
			}
			//$this->form_validation->set_rules('cities[]', 'City', 'required');
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_cities');
				$data['cities']= $query->result();
				
				$newspaper_group = $this->db->get('tbl_news_group');
				$data['news_groups']= $newspaper_group->result();
				
				$query = $this->db->get('tbl_paper_type');
				$data['paper_types']= $query->result();
				
				$query = $this->db->get_where('tbl_newspapers', array('id' => $id));
				$data['newspaper']= $query->row_array();
				
				//echo '<pre>'; var_dump($data['newspaper']); echo  $id; die;

				$query = $this->db->get('tbl_languages');
				$data['languages']= $query->result();
							
				$p_cities=explode(",",$data['newspaper']->city);			
				$data['p_cities']= $p_cities;
				
				$this->load->view('admin/header',$data);
				$this->load->view('admin/edit_newspaper');
				$this->load->view('admin/footer');
			}
			else
			{
				$cities=implode(",",$this->input->post('cities[]'));

				$no_of_add=count($cities);				
				//Set the config
				$config['upload_path'] = 'include/backend/img/logo_image/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '100';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				$this->load->library('upload', $config);
				
				//Upload file
				if( ! $this->upload->do_upload("logo"))
				{
					//echo the errors
					$error= $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					$logo =$this->input->post("logo_pic");
				}
				else
				{
					$file=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/logo_image/".$this->input->post("logo_pic");
					unlink($file);
				//If the upload success
					$data = array('upload_data' => $this->upload->data());
					$logo = $data['upload_data']['file_name'] ;
				}
				$values = array(
								// 'g_id'=>$this->input->post('g_id'),
								'name' =>$this->input->post('name'),
								'short_name' =>$this->input->post('sname'),
								// 'language' =>$this->input->post('language'),
								'address' =>$this->input->post('address'),
								//'discount_percentage' =>$this->input->post('discount_percentage'),
								// 'main_type' =>($this->input->post('main_p') == 'on') ? '1' : '0',
								// 'p_type' =>$this->input->post('nt'),
								// 'no_of_additions' =>$no_of_add,
								// 'no_of_copies' =>$this->input->post('copy'),
								// 'city' =>$cities,
								// 'logo' =>$logo,
								// 'text_ad' =>($this->input->post('text_ad') == 'on') ? '1' : '0',
								// 'c_display' =>($this->input->post('c_display') == 'on') ? '1' : '0',
								// 'hd_display' =>($this->input->post('hd_display') == 'on') ? '1' : '0',
								// 'print'=>($this->input->post('print') == 'on') ? '1' : '0',
								// 'outdoor'=>($this->input->post('outdoor') == 'on') ? '1' : '0',			
							);
				$p_id=$id;
				// $this->db->delete("tbl_paper_city",array('paper_id' => $id));
				// foreach($this->input->post('cities[]') as $city)
				// {
				// 	$values1 = array(
				// 				'paper_id'=>$p_id,
				// 				'city_id' =>$city
				// 			);
				// 	$this->db->insert('tbl_paper_city', $values1);
				// }
				
				$this->db->update('tbl_newspapers',$values, "id =".$id);
				$this->session->set_flashdata('msg', 'Newspaper edit Successfully');
				redirect('admin/newspaper/show');
			}
		}
		else
		{
			$query = $this->db->get('tbl_cities');
			$data['cities']= $query->result();
			
			$newspaper_group = $this->db->get('tbl_news_group');
			$data['news_groups']= $newspaper_group->result();
			
			$query = $this->db->get('tbl_paper_type');
			$data['paper_types']= $query->result();
			
			$query = $this->db->get_where('tbl_newspapers', array('id' => $id));
			$data['newspaper']= $query->row();
			
			//echo '<pre>'; var_dump($data['news_groups']); die;

			$query = $this->db->get('tbl_languages');
			$data['languages']= $query->result();
						
			$p_cities=explode(",",$data['newspaper']->city);			
			$data['p_cities']= $p_cities;
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/edit_newspaper');
			$this->load->view('admin/footer');
		}
	}
	
	public function del_newspaper($id)
	{		
		$this->db->select('logo');
		$this->db->from('tbl_newspapers');
		$this->db->where('id',$id);
		$f=$this->db->get()->row('logo');
		//slider Icon file path 
		$file=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/logo_image/".$f;
		
		if(!empty($f))
		{
			unlink($file);
		}
	
		if($this->db->delete("tbl_newspapers",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Newspaper Delete Successfully.');
			redirect('admin/newspaper/show');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Newspapers not Delete Successfully.');
			redirect('admin/newspaper/show');
		}
		
	}
}
?>
