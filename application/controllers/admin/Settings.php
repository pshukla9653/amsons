<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller
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
	}

	public function index()
	{
		$slider = $this->db->query("SELECT * FROM tbl_slider" );
		$data['sliders']= $slider->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/slider_list', $data);
		$this->load->view('admin/footer');
	}

	public function slider()
	{
		$slider = $this->db->query("SELECT * FROM tbl_slider" );
		$data['sliders']= $slider->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/slider_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function del_slider($id)
	{
		$did="id=".$id;
		$this->db->select('slider_img');
		$this->db->from('tbl_slider');
		$this->db->where('id',$id);
		//slider Icon file path 
		$file=$_SERVER['DOCUMENT_ROOT']."/amson/include/backend/img/slider_image/".$this->db->get()->row('slider_img');
		if($this->db->delete("tbl_slider",$did)&&unlink($file))
		{
			$this->session->set_flashdata('slider_del', 'Slider Delete Successfully.');
			$this->slider();
		}
		else
		{	
			$this->session->set_flashdata('slider_del', 'Slider not Delete Successfully.');
			$this->slider();
		}
	}	
		
	public function slider_add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('slider_title', 'Slider Title', 'required');
			$this->form_validation->set_rules('slider_status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$this->load->view('admin/header');
				$this->load->view('admin/slider_add');
				$this->load->view('admin/footer');
			}
			else
			{
				//Set the config
				$config['upload_path'] = 'include/backend/img/slider_image/'; //Use relative or absolute path
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size'] = '500';
				$config['max_width'] = '2000';
				$config['max_height'] = '1050';
				$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended
				$this->load->library('upload', $config);
				
				//Upload file
				if( ! $this->upload->do_upload("slider_img"))
				{
					//echo the errors
					echo $this->upload->display_errors();
					die;
				}
				//If the upload success
				$data = array('upload_data' => $this->upload->data());
				$slider = $data['upload_data']['file_name'] ;
				$values = array(
					'slider_title' => $this->input->post('slider_title'),
					'status' => $this->input->post('slider_status'),
					'slider_img' => $slider,
					'dated' => date('Y-m-d H:i:s')
				);
				$query = $this-> db->insert('tbl_slider', $values);
				$this->session->set_flashdata('success_msg', 'Slider Successfully Added');
				redirect('admin/settings/slider');
			}
		}
		else 
		{
			$this->load->view('admin/header');
			$this->load->view('admin/slider_add');
			$this->load->view('admin/footer');
		}
	}

	public function pass_c()
	{	
        //echo "reache here"; die;
		if (!empty($this->input->post()))
		{
			//$old_pass=$this->input->post('old-password');
			$id=$this->session->admin['id'];

//			$query = $this->db->get_where('tbl_admin', array('id' => $id));
//			$data=$query->row();
//			if(password_verify ($old_pass,$data->pass))
//			{
				$pass['np']=password_hash($this->input->post('new-password'), PASSWORD_DEFAULT);	
				$data = array('pass' => $pass['np']);
				
				if($this->db->update('tbl_admin', $data, "id =".$id))
				{
					$this->session->set_flashdata('pass_err', 'Password Changed Successfully.');
					redirect('admin/settings/pass_c');
				}
				else
				{
					$this->session->set_flashdata('pass_err', 'Error in Password Changing.');
					redirect('admin/settings/pass_c');
				}
//			}
//			else
//			{
//				$this->session->set_flashdata('pass_err', 'Incorrect Old Password.');
//				redirect('admin/settings/pass_c');
//			}
		}
		else
		{	
			$this->load->view('admin/header');
			$this->load->view('admin/pass_c');
			$this->load->view('admin/footer');
		}
	}
}
?>