<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_pdf extends CI_Controller
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
         
		 }

        $this->load->view('admin/header');
        $this->load->view('admin/print_pdf');
        $this->load->view('admin/footer');
    }



  }
?>