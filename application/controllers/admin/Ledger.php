<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger extends CI_Controller
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
    
    public function all(){
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model("site_model");
        $data['main_group']=$this->site_model->get_data("tbl_main_group");
        $data['results']=$this->site_model->get_data("tbl_ledgers");
        //echo "<pre>"; var_dump($data['results']);
        $this->load->view("admin/header",$data);
        $this->load->view("admin/ledger_all");
        $this->load->view("admin/footer");
    } 

    public function add(){
        $this->load->model("site_model");
        if(count($_POST)){
            /*echo '<pre>'; var_dump($_POST); die;
            array(6) {
                ["group_id"]=>
                string(1) "2"
                ["ledger_name"]=>
                string(4) "name"
                ["opening_balance"]=>
                string(4) "4000"
                ["ob_type"]=>
                string(5) "debit"
                ["editable"]=>
                string(3) "yes"
                ["is_deleted"]=>
                string(2) "no"
            }*/
            $this->load->helper(array('form'));
            $this->load->library('form_validation');
        
            //$this->form_validation->set_rules('ledger_id', 'Ledger id', 'trim|required');
            $this->form_validation->set_rules('group_id', 'Group id', 'trim|required');
            $this->form_validation->set_rules('ledger_name', 'Ledger name', 'trim|required|is_unique[tbl_ledgers.ledger_name]');
            $this->form_validation->set_rules('opening_balance', 'Opening balance', 'trim|required');
            $this->form_validation->set_rules('editable', 'Editable', 'trim|required');
            //$this->form_validation->set_rules('master_id', 'Master id', 'trim|required');
            $this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
            // $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
            // $this->form_validation->set_rules('updated_at', 'Updated at', 'trim|required');
            
            //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64
                
            if ($this->form_validation->run() == FALSE)
            {
                $data['results']=$this->site_model->get_data("tbl_ledgers");
                //echo "<pre>"; var_dump($data['results']);
                $data['main_group']=$this->site_model->get_data("tbl_main_group");
                $this->load->view("admin/header",$data);
                //$this->load->view("admin/sidebar");
                $this->load->view("admin/ledger_add");
                $this->load->view("admin/footer");
            }
            else
            {
                $this->site_model->insert_data("tbl_ledgers",array_filter($_POST));
                redirect("admin/ledger/all");
            }
        }else{
            $data['results']=$this->site_model->get_data("tbl_ledgers");
            $data['main_group']=$this->site_model->get_data("tbl_main_group");
            //echo "<pre>"; var_dump($data['results']);
            $this->load->view("admin/header",$data);
            //$this->load->view("admin/sidebar");
            $this->load->view("admin/ledger_add");
            $this->load->view("admin/footer");
        }        
    } 

    public function update($id){ 
        unset($_SESSION['error']);      
        $this->load->model("site_model");
        if(count($_POST)){
            $id=$_POST['ledger_id'];
            //echo '<pre>'; var_dump($_POST); die;
            $this->load->library('form_validation');            
              //$this->form_validation->set_rules('ledger_id', 'Ledger id', 'trim|required');
              $this->form_validation->set_rules('group_id', 'Group id', 'trim|required');
              $this->form_validation->set_rules('ledger_name', 'Ledger name', 'trim|required');
              $this->form_validation->set_rules('opening_balance', 'Opening balance', 'trim|required');
              $this->form_validation->set_rules('editable', 'Editable', 'trim|required');
              //$this->form_validation->set_rules('master_id', 'Master id', 'trim|required');
              $this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
              // $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
              // $this->form_validation->set_rules('updated_at', 'Updated at', 'trim|required');
              
            if ($this->form_validation->run() == FALSE)
            {
                $_SESSION['error']=validation_errors();
               redirect(base_url()."admin/ledger/update/".$id);
            }
            else
            {
                $where=array('ledger_id'=>$_POST['ledger_id']);
                $this->site_model->update_data("tbl_ledgers",array_filter($_POST),$where);
                redirect("admin/ledger/all");
            }
        }
        else{
            $where=array('ledger_id'=>$id);
            $data['main_group']=$this->site_model->get_data("tbl_main_group");
            $data['results']=$this->site_model->get_data("tbl_ledgers",$where)[0];
            $this->load->view("admin/header",$data);
            $this->load->view("admin/ledger_update");
            $this->load->view("admin/footer");
        }  
    }           
}
?>