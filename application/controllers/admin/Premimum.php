<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premimum extends CI_Controller
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
	
	
	public function index()
	{
		$pre = $this->db->query("SELECT tbl_premimum.*, ng.ng_name as ng_name, t.name as type_name FROM tbl_premimum
INNER JOIN tbl_news_group ng ON ng.ng_id=tbl_premimum.g_id
INNER JOIN tbl_news_type t ON t.id=tbl_premimum.type_id");
		$data['pres']= $pre->result();
		$data["total_rows"] = $pre->num_rows();
		
		$this->load->view('admin/header');
		$this->load->view('admin/premimum_list', $data);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		if (!empty($this->input->post())) 
		{
			$this->form_validation->set_rules('premimum', 'Premimum', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
			
			
			if ($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['news_groups']= $query->result();
						
				$query = $this->db->get('tbl_news_type');
				$data['types']= $query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/premimum_add',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$types=$this->input->post('type[]');

				foreach ($types as $type) 
				{
					$values = array(								
								'type_id'=>$type,
								'g_id'=>$this->input->post('newspaper_group'),
								'p_type'=>$this->input->post('p_title'),
								'premimum'=>$this->input->post('premimum'),
								'color'=>$this->input->post('color'),
								'c_date' =>date('Y-m-d H:i:s'),
								'sdate'=>$this->input->post('s_date'),
							//	'edate'=>$this->input->post('e_date')
							);

					$values['premimum']=$values['premimum'].','.$this->input->post('p_type');

					$premimum = $this->db->query("SELECT * FROM tbl_premimum WHERE `g_id`='".$values['g_id']."' AND `type_id`='".$values['type_id']."' AND `color`='".$values['color']."' AND `p_type`='".$values['p_type']."'");
							//var_dump($discount);
							//die;
					if($premimum->num_rows()==0)
					{
						$query = $this-> db->insert('tbl_premimum', $values);
					}
					else
					{
						continue;
					}

				}
				
				$this->session->set_flashdata('msg', 'Premimum Successfully Added');
				redirect('admin/premimum');
			}
		}
		else
		{
			$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
						
			$query = $this->db->get('tbl_news_type');
			$data['types']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/premimum_add',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function edit($id)
	{
		if (!empty($this->input->post())) 
		{			
			$this->form_validation->set_rules('premimum', 'Premimum', 'required');
			//$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');
				
			
			if($this->form_validation->run() == FALSE) 
			{
				$query = $this->db->get('tbl_news_group');
				$data['news_groups']= $query->result();
						
				$query = $this->db->get('tbl_news_type');
				$data['types']= $query->result();			
							
				$query = $this->db->get_where('tbl_premimum', array('id' => $id));
				$data['pre']= $query->row();
				
				$this->load->view('admin/header');
				$this->load->view('admin/premimum_edit',$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
								'type_id'=>$this->input->post('type'),
								'g_id'=>$this->input->post('newspaper_group'),
								'p_type'=>$this->input->post('p_title'),
								'premimum'=>$this->input->post('premimum'),
								'color'=>$this->input->post('color'),
								'sdate'=>$this->input->post('s_date'),
								'edate'=>$this->input->post('e_date')
							);
				$values['premimum']=$values['premimum'].','.$this->input->post('p_type');			
				
				$this->db->update('tbl_premimum',$values, "id =".$id);
				$this->session->set_flashdata('msg', 'Premimum edit Successfully');
				redirect('admin/premimum');
			}
		}
		else
		{
			$query = $this->db->get('tbl_news_group');
			$data['news_groups']= $query->result();
						
			$query = $this->db->get('tbl_news_type');
			$data['types']= $query->result();			
							
			$query = $this->db->get_where('tbl_premimum', array('id' => $id));
			$data['pre']= $query->row();
				
			$this->load->view('admin/header');
			$this->load->view('admin/premimum_edit',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function del($id)
	{	
		if($this->db->delete("tbl_premimum",array('id' => $id)))
		{
			$this->session->set_flashdata('msg', 'Premimum Delete Successfully.');
			redirect('admin/premimum');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Premimum not Delete Successfully.');
			redirect('admin/premimum');
		}
	}
}
?>