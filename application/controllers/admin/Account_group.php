<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account_group extends CI_Controller
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

    public function main_group_insert(){
    //echo "fine"; die;
    $this->load->model("site_model");
    if(count($_POST)){
        $this->load->library('form_validation');            
        //$this->form_validation->set_rules('group_id', 'Group id', 'trim|required');
        $this->form_validation->set_rules('group_name', 'Group name', 'trim|required|is_unique[tbl_main_group.group_name]');
        $this->form_validation->set_rules('group_type', 'Group type', 'trim|required');
        //$this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
        //$this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
        //$this->form_validation->set_rules('updated_at', 'Updated at', 'trim|required');
        //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['results']=$this->site_model->get_data("tbl_main_group");
            //echo "<pre>"; var_dump($data['results']);
            $this->load->view("admin/header",$data);
            $this->load->view("admin/main_group_insert");
            $this->load->view("admin/footer");
        }
        else
        {
            $this->site_model->insert_data("tbl_main_group",array_filter($_POST));
            redirect("admin/account_group/main_group");
        }
        }
        else{
            $this->load->view("admin/header");
            $this->load->view("admin/main_group_insert");
            $this->load->view("admin/footer");
        }  
    }

    public function main_group(){
        $this->load->model("site_model");
        $data['results']=$this->site_model->get_data("tbl_main_group");
        // echo "<pre>"; var_dump($data['results']); die;
        $this->load->view("admin/header",$data);
        $this->load->view("admin/main_group");
        $this->load->view("admin/footer");               
    }

    public function main_group_edit($id){
    $this->load->model("site_model");
    if(count($_POST)){
        //echo '<pre>'; var_dump($_POST); die;
        $this->load->library('form_validation');            
        //$this->form_validation->set_rules('group_id', 'Group id', 'trim|required');
        $this->form_validation->set_rules('group_name', 'Group name', 'trim|required');
        $this->form_validation->set_rules('group_type', 'Group type', 'trim|required');
        //$this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
        //$this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
        //$this->form_validation->set_rules('updated_at', 'Updated at', 'trim|required');
        //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['results']=$this->site_model->get_data("tbl_main_group");
            //echo "<pre>"; var_dump($data['results']);
            $this->load->view("admin/header",$data);
            $this->load->view("admin/main_group_edit");
            $this->load->view("admin/footer");
        }
        else
        {
            $where=array('group_id'=>$_POST['group_id']);
            $this->site_model->update_data("tbl_main_group",array_filter($_POST),$where);
            redirect("admin/account_group/main_group");
        }
        }
        else{
            $where=array('group_id'=>$id);
            $data['results']=$this->site_model->get_data("tbl_main_group",$where)[0];
            //echo "<pre>"; var_dump($data['results']);
            $this->load->view("admin/header",$data);
            $this->load->view("admin/main_group_edit");
            $this->load->view("admin/footer");
        }  
    }
            
}
?>