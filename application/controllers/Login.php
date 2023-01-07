<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
    }
    
    // load codeigniter view
    function index(){
		echo "working";
        $this->load->view("login");
    }
    
    
    function inactive(){
        $this->load->view("inactive");
    }
    
    // fn to which form 'll be submitted via ajax
//    function submit()
//    {
//        //set validation rule
//        $this->form_validation->set_rules('email', 'Email', 'required');
//        
//        if ($this->form_validation->run() == FALSE)
//        {   
//            //validation fails
//            echo validation_errors();
//        }
//        else
//        {
//            // get post data
//            $emailid = $this->input->post('email');
//          
//			
//            // write your database insert code here
//                     
//            echo "<div class='alert'>Thanks for Subscribing! ".$emailid."Please stay tuned to get awesome tips...</div>";
//        }
//    }
}
?>