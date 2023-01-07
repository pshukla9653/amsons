<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Client extends CI_Controller { 
    public function __construct(){ 
        parent::__construct(); 
    }

    public function index(){
        $this->load->model("site_model");
        $data['results']=$this->site_model->get_data("tbl_client");
        //echo "<pre>"; var_dump($data['results']);
        $this->load->view("admin/header",$data);
        $this->load->view("admin/client");
        $this->load->view("admin/footer");
    } 

    public function add(){
        if($_POST){
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('user_name', 'User name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
            $this->form_validation->set_rules('client_name', 'Client name', 'trim|required');
            $this->form_validation->set_rules('c_date', 'C date', 'trim|required');

            //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64

            $this->load->model("site_model");
            if ($this->form_validation->run() == FALSE)
            {
                $data['results']=$this->site_model->get_data("tbl_client");
                //echo "<pre>"; var_dump($data['results']);
                $this->load->view("admin/header",$data);
                $this->load->view("admin/client");
                $this->load->view("admin/footer");
            }
            else
            {
            $values=array(
                'agency_id' => $this->input->post('agency_id'),
                'user_name' => $this->input->post('user_name'),
                'email' => $this->input->post('email'),
                'passcode' => $this->input->post('passcode'),
                'mobile' => $this->input->post('mobile'),
                'client_name' => $this->input->post('client_name'),
                'device_type' => $this->input->post('device_type'),
                'imei_number' => $this->input->post('imei_number'),
                'device_id' => $this->input->post('device_id'),
                'login_type' => $this->input->post('login_type'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'pin_code' => $this->input->post('pin_code'),
                'fax' => $this->input->post('fax'),
                'vat_no' => $this->input->post('vat_no'),
                'cst_no' => $this->input->post('cst_no'),
                'discount' => $this->input->post('discount'),
                'ser_tax_no' => $this->input->post('ser_tax_no'),
                'tin_no' => $this->input->post('tin_no'),
                'gst_no' => $this->input->post('gst_no'),
                'it_no' => $this->input->post('it_no'),
                'contact_person' => $this->input->post('contact_person'),
                'website' => $this->input->post('website'),
                'opening_bal' => $this->input->post('opening_bal'),
                'credit_bal' => $this->input->post('credit_bal'),
                'account' => $this->input->post('account'),
                'credit_period' => $this->input->post('credit_period'),
                'credit_limit' => $this->input->post('credit_limit'),
                'client_type' => $this->input->post('client_type'),
                'agency' => $this->input->post('agency'),
                'group_head' => $this->input->post('group_head'),
                'shared' => $this->input->post('shared'),
                'c_date' => $this->input->post('c_date'),
            );
                $this->site_model->insert_data("tbl_client",$values);
                redirect("admin/client");
            } 
        } 
        else 
        { 
            $this->load->view("admin/header"); 
            $this->load->view("admin/client_add"); 
            $this->load->view("admin/footer");
        }
    }



    public function edit($id=null){
        $this->load->model("site_model");
        if($_POST){
            $this->load->helper(array('form'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('agency_id', 'Agency id', 'trim|required');
            $this->form_validation->set_rules('user_name', 'User name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('passcode', 'Passcode', 'trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
            $this->form_validation->set_rules('client_name', 'Client name', 'trim|required');
            $this->form_validation->set_rules('device_type', 'Device type', 'trim|required');
            $this->form_validation->set_rules('imei_number', 'Imei number', 'trim|required');
            $this->form_validation->set_rules('device_id', 'Device id', 'trim|required');
            $this->form_validation->set_rules('login_type', 'Login type', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('pin_code', 'Pin code', 'trim|required');
            $this->form_validation->set_rules('fax', 'Fax', 'trim|required');
            $this->form_validation->set_rules('vat_no', 'Vat no', 'trim|required');
            $this->form_validation->set_rules('cst_no', 'Cst no', 'trim|required');
            $this->form_validation->set_rules('discount', 'Discount', 'trim|required');
            $this->form_validation->set_rules('ser_tax_no', 'Ser tax no', 'trim|required');
            $this->form_validation->set_rules('tin_no', 'Tin no', 'trim|required');
            $this->form_validation->set_rules('gst_no', 'Gst no', 'trim|required');
            $this->form_validation->set_rules('it_no', 'It no', 'trim|required');
            $this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required');
            $this->form_validation->set_rules('website', 'Website', 'trim|required');
            $this->form_validation->set_rules('opening_bal', 'Opening bal', 'trim|required');
            $this->form_validation->set_rules('credit_bal', 'Credit bal', 'trim|required');
            $this->form_validation->set_rules('account', 'Account', 'trim|required');
            $this->form_validation->set_rules('credit_period', 'Credit period', 'trim|required');
            $this->form_validation->set_rules('credit_limit', 'Credit limit', 'trim|required');
            $this->form_validation->set_rules('client_type', 'Client type', 'trim|required');
            $this->form_validation->set_rules('agency', 'Agency', 'trim|required');
            $this->form_validation->set_rules('group_head', 'Group head', 'trim|required');
            $this->form_validation->set_rules('shared', 'Shared', 'trim|required');
            $this->form_validation->set_rules('c_date', 'C date', 'trim|required');

            //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64

            if ($this->form_validation->run() == FALSE)
            {
                $data['results']=$this->site_model->get_data("tbl_client");
                //echo "<pre>"; var_dump($data['results']);
                $this->load->view("admin/header",$data);
                $this->load->view("admin/tbl_client");
                $this->load->view("admin/footer");
            }
            else
            {
                $this->load->model('site_model');
                $id=$_POST['id'];
                unset($_POST['id']);
                $this->site_model->update_data("tbl_client",array_filter($_POST),("id=".$id));
                redirect(base_url("admin/tbl_client")); 
            } 
        } 
        else 
        { 
            $data['results']=$this->site_model->get_data("tbl_client",['id'=>$id])[0]; 
            //echo '<pre>'; var_dump($results); die; 
            $this->load->view("admin/header",$data); 
            $this->load->view("admin/tbl_client_edit"); 
            $this->load->view("admin/footer");
        }
    }




    public function delete($id){ 
        $this->load->model('site_model'); 
        $this->site_model->delete_data("tbl_client",['id'=>$id]); 
        redirect("admin/tbl_client"); 
    } 
}


