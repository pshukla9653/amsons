<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nis_api extends CI_Controller{




    public function __construct()
    {
        parent::__construct();
    }





    function index(){
        echo "working fine";
    }





    public function sign_up(){
        if(isset($_POST['email']) && isset($_POST['passcode']) && isset($_POST['mobile']) && isset($_POST['client_name']) && isset($_POST['device_type']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pin_code']) && isset($_POST['gst_no']))
        {
            $this->load->model("site_model");
            $result=$this->site_model->get_data("tbl_client",['email'=>$_POST['email']]);
            if($_POST['email']==$result[0]['email']){
                $response=array(
                    'error'=>true,
                    'message'=>'Email id is already exists.'
                );
                echo json_encode($response);
                retrun;  
            }else{
                $_POST['passcode']=password_hash($_POST['passcode'], PASSWORD_DEFAULT);
                $id=$this->site_model->insert_data("tbl_client",$_POST);
                if($id){
                    $response=array(
                        'error'=>false,
                        'message'=>'User Added Successfully.'
                    );
                    echo json_encode($response);    
                    retrun;
                }else{
                    $response=array(
                        'error'=>false,
                        'message'=>'User cannot be added.'
                    );
                    echo json_encode($response);    
                    retrun; 
                } 
            }

        }else{
            $response=array(
                'error'=>true,
                'message'=>'Required parameters are missing.'
            );
            echo json_encode($response);
            retrun;
        }
    }





    function login(){
        $this->load->model("site_model");
        if(isset($_POST['email']) && isset($_POST['passcode']))
        {
            $result=$this->site_model->get_data('tbl_client',['email'=>$_POST['email']]);
            if(!empty($result[0]['email']))
            {
                if(password_verify($_POST['passcode'],$result[0]['passcode']))
                {
                    $response=array(
                        'error'=>false,
                        'data'=>$result[0]
                    );
                    echo json_encode($response);
                    retrun;
                }else{
                    $response=array(
                        'error'=>true,
                        'message'=>'Invalid password.'
                    );
                    echo json_encode($response);
                    retrun;    
                }
            }else{
                $response=array(
                    'error'=>true,
                    'message'=>'Invalid email.'
                );
                echo json_encode($response);
                retrun;    
            }

        }else{
            $response=array(
                'error'=>true,
                'message'=>'Required parameters are missing.'
            );
            echo json_encode($response);
            retrun;
        }
    }



    public function user_edit(){
        if(isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['client_name'])  && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pin_code']) && isset($_POST['gst_no']))
        {
            $this->load->model("site_model");
            $email=$_POST['email'];
            unset($_POST['email']);
            $id=$this->site_model->update_data("tbl_client",$_POST,['email'=>$email]);
            if($id){
                $response=array(
                    'error'=>false,
                    'message'=>'User updated successfully.'
                );
                echo json_encode($response);
                retrun;  

            }
            else{
                $response=array(
                    'error'=>true,
                    'message'=>'User cannot be updated.'
                );
                echo json_encode($response);    
                retrun; 
            } 
        }else{
            $response=array(
                'error'=>true,
                'message'=>'Required parameters are missing.'
            );
            echo json_encode($response);
            retrun;
        }
    }




    function user_change_password(){
        $this->load->model("site_model");
        if(isset($_POST['email']) && isset($_POST['old_passcode']) && isset($_POST['new_passcode']) && isset($_POST['confirm_passcode']))
        {
            if($_POST['new_passcode']==$_POST['confirm_passcode']){
                $result=$this->site_model->get_data('tbl_client',['email'=>$_POST['email']]);
                if(!empty($result[0]['email']))
                {
                    if(password_verify($_POST['old_passcode'],$result[0]['passcode']))
                    {
                        $email=$_POST['email'];
                        unset($_POST['email']);
                        $pass=password_hash($_POST['new_passcode'], PASSWORD_DEFAULT);
                        $id=$this->site_model->update_data("tbl_client",['passcode'=>$pass],['email'=>$email]);
                        if($id){
                            $response=array(
                                'error'=>false,
                                'message'=>'Password changed successfully.'
                            );
                            echo json_encode($response);
                            retrun;  

                        }else{
                            $response=array(
                                'error'=>true,
                                'message'=>'Password cannot changed.'
                            );
                            echo json_encode($response);
                            retrun;    
                        }
                    }else{
                        $response=array(
                            'error'=>true,
                            'message'=>'Invalid old password.'
                        );
                        echo json_encode($response);
                        retrun;    
                    } 
                }else{
                    $response=array(
                        'error'=>true,
                        'message'=>'Invalid email.'
                    );
                    echo json_encode($response);
                    retrun;    
                } 


            }else{
                $response=array(
                    'error'=>true,
                    'message'=>'New password & confirm password not match.'
                );
                echo json_encode($response);
                retrun;    
            } 
        }else{
            $response=array(
                'error'=>true,
                'message'=>'Required parameters are missing.'
            );
            echo json_encode($response);
            retrun;
        }
    }




    //    function publications_newspapers(){
    //        $this->load->model("site_model");
    //        $result=$this->site_model->get_data('tbl_paper_city',null,'id,name');
    //        $id=array();
    //        $name=array();
    //        foreach($result as $row){
    //            $id[]=$row['id'];
    //            $name[]=$row['name'];
    //        }
    //        $response=array(
    //            'error'=>false,
    //            'id'=>$id,
    //            'name'=>$name
    //        );
    //        echo json_encode($response);
    //    }

    function publications_newspapers(){
        $this->load->model("api_model");
        $result=$this->api_model->get_publication_newspapers();
        $id=array();
        $name=array();
        $city=array();
        foreach($result as $row){
            $id[]=$row['id'];
            $newspaper[]=$row['newspaper'];
            $city[]=$row['city'];
        }
        $response=array(
            'error'=>false,
            'id'=>$id,
            'newspaper'=>$newspaper,
            'city'=>$city,
        );
        echo json_encode($response);
    }
    
    function get_add_on_newspapers(){
        
        $this->load->model("api_model");
        $result=$this->api_model->get_add_on_newspapers(1);
       
        
        $response=array(
            'error'=>false,
            'data'=>$result
        );
        echo json_encode($response);
    }

}
?>
