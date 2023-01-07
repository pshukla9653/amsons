<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm extends CI_Controller
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
	
	
//FM Group functions 

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
			
			$newspaper_group= $this->db->query("SELECT * from tbl_fm_group WHERE ng_name LIKE '%".$name."%'");
			
			
			$config["base_url"] = base_url() . "admin/fm/index";
			$config["total_rows"] = $newspaper_group->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
						
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->db->query("SELECT * from tbl_news_group WHERE ng_name LIKE '%".$name."%' order by ng_id desc limit {$config['per_page']} offset {$page}");
			
			$data['newspaper_groups']= $newspaper_group->result();
			$news_address=$this->db->query("SELECT * from tbl_fm_group as Ng  LEFT OUTER JOIN tbl_fm_group_details as ngd ON Ng.ng_id=ngd.fm_group_id LEFT JOIN tbl_cities as tc ON tc.id=ngd.state order by Ng.ng_id asc");
			$data['address']=$news_address->result();
		}
		else
		{
			$newspaper_group = $this->db->get('tbl_fm_group');
		
			$config["base_url"] = base_url(). "admin/fm/index";
			$config["total_rows"] = $newspaper_group->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	
			
			$newspaper_group = $this->db->get('tbl_fm_group',$config['per_page'],$page);
			$data['newspaper_groups']= $newspaper_group->result();
			$news_address=$this->db->query("SELECT * from tbl_fm_group as Ng  LEFT OUTER JOIN tbl_fm_group_details as ngd ON Ng.ng_id=ngd.fm_group_id LEFT JOIN tbl_cities as tc ON tc.id=ngd.state order by Ng.ng_id asc");
			$data['address']=$news_address->result();
			
		}
        $data["links"] = $this->pagination->create_links();
        $data['per_page'] = 20;
        $data['offset'] = $page ;
        $data["total_rows"] = $config["total_rows"];
        $data["curr_page"] = $this->pagination->cur_page ; 


        $this->load->view('admin/header');	
        $this->load->view('admin/fm_group_list', $data);
        $this->load->view('admin/footer');
    }

	public function group_add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'Group Name', 'required|is_unique[tbl_fm_group.ng_name]',array('required' => 'You must provide a %s.','is_unique'=>'FM Group with this name already Added.'));
		//	$this->form_validation->set_rules('city', 'City', 'required');
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
			     $query = $this->db->get('states');
                $data['states']= $query->result();

             
				$this->load->view('admin/header');
				$this->load->view('admin/fm_group_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				/*			
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
					echo $this->upload->display_errors();
					die;
				}
				//If the upload success
				$data = array('upload_data' => $this->upload->data());
				$logo = $data['upload_data']['file_name'] ;
				*/

				
				$values = array(
								'ng_name' =>$this->input->post('name'),
							
								'ng_fax' =>$this->input->post('fax'),
							'ng_contact_parson' =>$this->input->post('c_p'),
								'ng_no_of_additions' =>$this->input->post('addition'), 
								'ng_cdate' =>date('Y-m-d H:i:s'),
								'ng_opening' =>$this->input->post('opening'),
								'ng_fm' =>(($this->input->post('fm') == 'on') ? 1 : 0)
							);
				$query = $this-> db->insert('tbl_fm_group', $values);
				
                $nid=$this->db->insert_id();

                for($i=0;$i<count($_POST['state']); $i++){
                    $values = array(
                        'fm_group_id' =>$nid,
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

                
				$this->session->set_flashdata('msg', 'FM Group Successfully Added');
				redirect('admin/fm');
			}
		}
		else
		{
		    $query = $this->db->get('states');
                $data['states']= $query->result();
			$this->load->view('admin/header');
			$this->load->view('admin/fm_group_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function group_edit($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('name', 'Group Name', 'required');
			if($this->input->post('name')!=$this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Group Name', 'required|is_unique[tbl_fm_group.ng_name]',array('required' => 'You must provide a %s.','is_unique'=>'FM Group with this name already Added.'));			
			}			
			
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get_where('tbl_fm_group', array('ng_id' => $id));
				$data['newspaper_group']= $query->row();
			
				$this->load->view('admin/header');
				$this->load->view('admin/fm_group_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
								'ng_name' =>$this->input->post('name'),
								'ng_phone' =>$this->input->post('mobile'),
								'ng_email' =>$this->input->post('email'),
								'ng_fax' =>$this->input->post('fax'),
								'ng_address' =>$this->input->post('address'),
								'ng_city' =>$this->input->post('city'),
								'ng_state' =>$this->input->post('state'),'ng_contact_parson' =>$this->input->post('c_p'),'ng_no_of_additions' =>$this->input->post('addition'),
								'ng_opening' =>$this->input->post('opening'),
								'ng_fm' =>(($this->input->post('fm') == 'on') ? 1 : 0)
							);
				$this->db->update('tbl_fm_group',$values, "ng_id =".$id);
				$this->session->set_flashdata('msg', 'FM Group edit Successfully');
				redirect('admin/fm');
			}
		}
		else
		{
			$query = $this->db->get_where('tbl_fm_group', array('ng_id' => $id));
			$data['newspaper_group']= $query->row();
			
			$this->load->view('admin/header');
			$this->load->view('admin/fm_group_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function group_del($id)
	{	
		if($this->db->delete("tbl_fm_group",array('ng_id' => $id)))
		{
			$this->session->set_flashdata('msg', 'FM Group Delete Successfully.');
			redirect('admin/fm');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'FM Group not Delete Successfully.');
			redirect('admin/fm');
		}		
	}
	
	
	
//fm channels functions 	
	
	public function show()
	{
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			
			$newspaper = $this->db->query("SELECT * from tbl_fm_channels WHERE name LIKE '%".$name."%'");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/fm/show";
			$config["total_rows"] = $newspaper->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->db->query("SELECT * from tbl_fm_channels WHERE name LIKE '%".$name."%' order by id desc limit {$config['per_page']} offset {$page}");
			
			$data['newspapers']= $newspaper->result();
		}
		else
		{
			$newspaper = $this->db->get('tbl_fm_channels');
					
			$config = array();
			$config["base_url"] = base_url(). "admin/fm/show";
			$config["total_rows"] = $newspaper->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;	
			
			$newspaper = $this->db->get('tbl_fm_channels',$config['per_page'],$page);
			$data['newspapers']= $newspaper->result();
			
		}
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;
		$data['offset'] = $page ;
		$data["total_rows"] = $newspaper->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/list_fm_channel', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_fm_channels.name]',array('required' => 'You must provide a %s.','is_unique'=>'FM Channel with this name already Added.'));
			$this->form_validation->set_rules('g_id', 'FM Group', 'required');
			
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_cities');
				$data['cities']= $query->result();
			
				$newspaper_group = $this->db->get('tbl_fm_group');
				$data['news_groups']= $newspaper_group->result();
			
								
				$this->load->view('admin/header');
				$this->load->view('admin/add_fm_channel',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$cities=implode(",",$this->input->post('cities[]'));				
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
					echo $this->upload->display_errors();
					die;
				}
				//If the upload success
				$data = array('upload_data' => $this->upload->data());
				$logo = $data['upload_data']['file_name'] ;
				
				$values = array(
								'g_id'=>$this->input->post('g_id'),
								'name' =>$this->input->post('name'),
								'short_name' =>$this->input->post('sname'),
								'language' =>$this->input->post('language'),
								'address' =>$this->input->post('address'),
								'city' =>$cities,
								'logo' =>$logo,
								'c_date' => date('Y-m-d H:i:s')
							);
				$query = $this-> db->insert('tbl_fm_channels', $values);
				$this->session->set_flashdata('msg', 'FM Channel Successfully Added');
				redirect('admin/fm/show');
			}
		}
		else
		{
			$query = $this->db->get('tbl_cities');
			$data['cities']= $query->result();
			
			$newspaper_group = $this->db->get('tbl_fm_group');
			$data['news_groups']= $newspaper_group->result();
			
						
			$this->load->view('admin/header');
			$this->load->view('admin/add_fm_channel',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function edit_channel($id)
	{
		if (!empty($this->input->post())) 
		{
			
			$this->form_validation->set_rules('name', 'Name', 'required');
			if($this->input->post('name')!=$this->input->post('old_name'))
			{
				$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_fm_channels.name]',array('required' => 'You must provide a %s.','is_unique'=>'FM Channel with this name already Added.'));
			}
			$this->form_validation->set_rules('cities[]', 'City', 'required');
			//$this->form_validation->set_rules('word-price', 'Word Price', 'required');
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_cities');
				$data['cities']= $query->result();
			
				$newspaper_group = $this->db->get('tbl_fm_group');
				$data['news_groups']= $newspaper_group->result();
			
							
				$query = $this->db->get_where('tbl_fm_channels', array('id' => $id));
				$data['newspaper']= $query->row();
						
				$p_cities=explode(",",$data['newspaper']->city);			
				$data['p_cities']= $p_cities;
				$this->load->view('admin/header');
				$this->load->view('admin/edit_fm_channel',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$cities=implode(",",$this->input->post('cities[]'));				
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
								'g_id'=>$this->input->post('g_id'),
								'name' =>$this->input->post('name'),
								'short_name' =>$this->input->post('sname'),
								'language' =>$this->input->post('language'),
								'address' =>$this->input->post('address'),
								'city' =>$cities,
								'logo' =>$logo,
							);
				$this->db->update('tbl_fm_channels',$values, "id =".$id);
				$this->session->set_flashdata('msg', 'FM Channel edit Successfully');
				redirect('admin/fm/show');
			}
		}
		else
		{
			$query = $this->db->get('tbl_cities');
			$data['cities']= $query->result();
			
			$newspaper_group = $this->db->get('tbl_fm_group');
			$data['news_groups']= $newspaper_group->result();
			
						
			$query = $this->db->get_where('tbl_fm_channels', array('id' => $id));
			$data['newspaper']= $query->row();
						
			$p_cities=explode(",",$data['newspaper']->city);			
			$data['p_cities']= $p_cities;
			$this->load->view('admin/header');
			$this->load->view('admin/edit_fm_channel',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del_channel($id)
	{		
		$this->db->select('logo');
		$this->db->from('tbl_fm_channels');
		$this->db->where('id',$id);
		//slider Icon file path 
		$file=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/logo_image/".$this->db->get()->row('logo');
	
		if($this->db->delete("tbl_fm_channels",array('id' => $id))&&unlink($file))
		{
			$this->session->set_flashdata('msg', 'FM Channel Delete Successfully.');
			redirect('admin/fm/show');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'FM Channel not Delete Successfully.');
			redirect('admin/fm/show');
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
}
?>