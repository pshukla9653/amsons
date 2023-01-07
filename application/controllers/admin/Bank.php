<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Bank extends CI_Controller { 


    public function __construct(){ 
        parent::__construct(); 
    }


    public function index(){
        $this->load->model("bank_model");
        $data['results']=$this->bank_model->get_bank();
        //echo "<pre>"; var_dump($data['results']);
        $this->load->view("admin/header",$data);
        $this->load->view("admin/bank");
        $this->load->view("admin/footer");
    } 



    public function add(){

        if($_POST){
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('bank_name', 'Bank name', 'trim|required');
            $this->form_validation->set_rules('acc_name', 'Acc name', 'trim|required');
            $this->form_validation->set_rules('acc_number', 'Acc number', 'trim|required');
            $this->form_validation->set_rules('ifsc', 'Ifsc', 'trim|required');
            //        $this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
            //        $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
            //        $this->form_validation->set_rules('updated_at', 'Updated at', 'trim|required');

            //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64

            $this->load->model("site_model");
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->model("site_model");
                $data['results']=$this->site_model->get_data("tbl_admin",null,"id,name");

                $this->load->view("admin/header",$data);
                $this->load->view("admin/bank_add");
                $this->load->view("admin/footer");
            }
            else
            {
                $values=array(
                    'user_id' => $this->input->post('user_id'),
                    'bank_name' => $this->input->post('bank_name'),
                    'acc_name' => $this->input->post('acc_name'),
                    'acc_number' => $this->input->post('acc_number'),
                    'ifsc' => $this->input->post('ifsc'),
                    'is_deleted' => 'no',
                    'created_at' => date("Y-m-d"),
                    'updated_at' => date("Y-m-d")
                );
                $this->site_model->insert_data("tbl_bank",$values);
                redirect("admin/bank");
            } 
        } 
        else 
        { 

            $this->load->model("site_model");
            $data['results']=$this->site_model->get_data("tbl_admin",null,"id,name");

            $this->load->view("admin/header",$data); 
            $this->load->view("admin/bank_add"); 
            $this->load->view("admin/footer");
        }
    }



    public function edit($id=null){
        $this->load->model("bank_model");
        $this->load->model("site_model");
        if($_POST){

            $this->load->model('site_model');
            $id=$_POST['id'];
            unset($_POST['id']);
            $this->site_model->update_data("tbl_bank",array_filter($_POST),("id=".$id));
            redirect(base_url("admin/bank")); 

        } 
        else 
        { 
        
            $data['users']=$this->site_model->get_data("tbl_admin",null,"id,name");
            $data['results']=$this->bank_model->get_bank($id)[0];
            //echo '<pre>'; var_dump($data); die; 
            $this->load->view("admin/header",$data); 
            $this->load->view("admin/bank_edit"); 
            $this->load->view("admin/footer");
        }
    }



    public function delete($id){ 
        $this->load->model('site_model'); 
        $this->site_model->delete_data("tbl_client",['id'=>$id]); 
        redirect("admin/client"); 
    } 
}

?>