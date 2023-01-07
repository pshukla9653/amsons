<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//require APPPATH . '/libraries/REST_Controller.php';

class Amsons_api extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function jsoncateror($req) {
        if (!empty($req)) {
            $requestName = $req;
            $validRequests = ['user_register', 'user_login', 'get_state', 'get_city', 'forgot_password', 'get_newspapers', 'get_add_on_papers', 'get_heading', 'get_sub_heading', 'get_scheme', 'get_packages', 'get_premium', 'get_info', 'get_addon_details', 'get_focus_day', 'calculate_amount', 'get_activity_cats', 'get_blogs', 'get_blog_details', 'get_guides', 'guide_apply', 'get_guide_details', 'app_feedback', 'user_profile_save', 'cities_list', 'search_package', 'bucketlist_packages', 'my_bucketlist', 'remove_bucketlist_pack', 'bucketlist_activities', 'remove_bucketlist_act', 'my_bucketlist_act', 'guide_login', 'guide_profile_update', 'guide_blog_upload', 'user_referal', 'search_destinations', 'get_theme_packages', 'get_all_theme', 'upload_guide_img', 'my_blogs', 'blog_like', 'remove_blog_like', 'book_package', 'active_bookings', 'past_bookings', 'past_booking', 'get_token', 'send_message', 'get_messages', 'chat_history'];
            if (!in_array($requestName, $validRequests)) {
                //$this->response->statusCode(404);
                echo json_encode(['error' => 'Your Request is Invalid']);
                exit;
            }
            /*             * ********** Handle User Registration Request from App with Email **************** */
            if ($requestName == 'user_register') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['email']) && !empty($requestParams['imeiNumber']) && !empty($requestParams['password']) && !empty($requestParams['deviceId']) && !empty($requestParams['type']) && !empty($requestParams['mobile'])) 
                    {
                        if (!empty($requestParams['type']) && $requestParams['type'] == 'free') 
                        {
                            if (filter_var($requestParams['email'], FILTER_VALIDATE_EMAIL) == false) 
                            {
                                $this->response->statusCode(203);
                                $result['status'] = 'false';
                                $result['error'] = 'Invalid Email Address';
                                echo json_encode($result);
                                return $this->response;
                                exit;
                            }
                        }
                        if ($requestParams['type'] == 'email') 
                        {
                            $ult = 1;
                        } else if ($requestParams['type'] == 'facebook') 
                        {
                            $ult = 2;
                        } else if ($requestParams['type'] == 'gplus') {
                            $ult = 3;
                        } else {
                            $ult = 4;
                        }
                        $count = $this->db->query('SELECT * FROM tbl_client where email = \'' . $requestParams['email'] . '\' OR mobile= \'' . $requestParams['mobile'] . '\'');
                       
                       if ($count->num_rows() == 0) 
                       {
                            //$uref_code = $this->refralcode(5);
                            $values = array(
                                'email' => $requestParams['email'],
                                'passcode' => password_hash($requestParams['password'], PASSWORD_DEFAULT),
                                'mobile' => $requestParams['mobile'],
                                'client_name' => $requestParams['userName'],
                                'address' => $requestParams['address'],
                                'city' => $requestParams['city'],
                                'state' => $requestParams['state'],
                                'pin_code' => $requestParams['pinCode'],
                                'contact_person' => $requestParams['contactPerson'],
                                'login_type' => $ult,                                
                                'device_type' => $requestParams['deviceType'],
                                'imei_number' => $requestParams['imeiNumber'],
                                'device_id' => $requestParams['deviceId'],
                                'c_date' => date('Y-m-d H:i:s')
                            );
                            $query = $this->db->insert('tbl_client', $values);
                            $last_id = $this->db->insert_id();
                            
                            $result['status'] = 'true';
                            $result['userId'] = (string) $last_id;
                            $result['userName'] = $requestParams['userName'];
                            $result['mobileNo'] = $requestParams['mobile'];
                            $result['email'] = $requestParams['email'];
                            $result['success'] = 'Registration was successful.';
                        } 
                        else 
                        {
                            $result['status'] = 'false';
                            $result['error'] = 'Your Email Id or Mobile no. is already Registered';
                        }
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;

                /*                 * ********** Handle User Login from email, FB, G+ Request from App  **************** */
            } 
            else if($requestName == 'get_state')
            {
                $result = array();
                if (empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    $query = $this->db->get_where('states', array('country_id' => 101));
                    
                    if ($query->num_rows() > 0) 
                    {
                        $result['states']= $query->result();
                        $result['success'] = 'States are fetched.';
                    } 
                    else 
                    {
                        $result['success'] = 'No State Found.';
                    }
                    $result['status'] = 'true';

                    echo json_encode($result);
                    exit;                    
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be GET only';
                    echo json_encode($result);
                }
                exit;
            }
            else if($requestName == 'get_city')
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['stateId']) )
                    {
                        $query = $this->db->get_where('cities', array('state_id' => $requestParams['stateId']));
                        if ($query->num_rows() > 0) 
                        {
                            $result['cities']= $query->result();
                            $result['success'] = 'Cities are fetched.';
                        } 
                        else 
                        {
                            $result['success'] = 'No City Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit; 
                    }
                    else
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'State Id is missing';
                    }
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            }
            else if ($requestName == 'user_profile_save') 
            {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['userId']) && !empty($requestParams['address']) && !empty($requestParams['gender']) && !empty($requestParams['userImg'])) {
                        $count = $this->db->query('SELECT * FROM tbl_users where id = \'' . $requestParams['userId'] . '\'');
                        if ($count->num_rows() == 1) {
                            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/images/user_imgs/' . $requestParams['userId'])) {
                                $mask = umask(0);
                                mkdir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/images/user_imgs/' . $requestParams['userId'], 0777);
                                umask($mask);
                            }
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/hm/include/images/user_imgs/' . $requestParams['userId'] . '/';

                            $data = base64_decode($requestParams['userImg']);
                            $source_img = imagecreatefromstring($data);
                            $img_name = "user-img-" . $requestParams['userId'] . ".jpg";
                            $file = $uploaddir . "/" . $img_name;
                            $imageSave = imagejpeg($source_img, $file, 80);
                            imagedestroy($source_img);
                            $uref_code = $this->refralcode(5);
                            $values = array(
                                'user_id' => $requestParams['userId'],
                                'address' => $requestParams['address'],
                                'gender' => $requestParams['gender'],
                                'latitude' => '0',
                                'longitude' => '0',
                                'pic' => $img_name
                            );
                            $query = $this->db->insert('tbl_userprofile', $values);
                            $datauser = array(
                                'mobile' => $requestParams['mobileNo'],
                            );
                            $this->db->update('tbl_users', $datauser, array('id' => $requestParams['userId']));

                            $last_id = $this->db->insert_id();

                            $result['status'] = 'true';
                            $result['userId'] = $requestParams['userId'];
                            $result['success'] = 'Registration was successful.';
                        } else {

                            $result['status'] = 'false';
                            $result['error'] = 'User Not Found';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;

                /*                 * ********** Handle User Login from email, FB, G+ Request from App  **************** */
            } 
            else if ($requestName == 'user_login') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['email']) && !empty($requestParams['imeiNumber']) && !empty($requestParams['deviceId'])) 
                    {
                        if ($requestParams['type'] == 'facebook' || $requestParams['type'] == 'gplus' || $requestParams['type'] == 'twitter') 
                        {
                            $result['status'] = 'false';
                            $result['error'] = 'Invalid login Type';
                            echo json_encode($result);
                            exit;
                        } 
                        else 
                        {
                            if (!empty($requestParams['type']) && $requestParams['type'] == 'email') 
                            {
                                if (filter_var($requestParams['email'], FILTER_VALIDATE_EMAIL) == false) 
                                {
                                    $result['status'] = 'false';
                                    $result['error'] = 'Invalid Email Address';
                                    echo json_encode($result);
                                    exit;
                                }
                            
                                $this->load->model('client_model');
                                $email=$requestParams['email'];
                                $pass=$requestParams['password'];
            
                                $result1= $this->client_model->get($email);
                                
                                //var_dump($result);
                                //exit;
                                if(!empty($result1))
                                {
                                    //var_dump($result);
                                    if(password_verify ($pass,$result1[0]->passcode))
                                    {
                                        $count=$result1[0];
                                    }
                                }
                            }
                            // print_r($count);
                            if (!empty($count)) 
                            {
                                $userExist = $count; 
                                $data = array(
                                        'device_type' => $requestParams['deviceType'],
                                        'imei_number' => $requestParams['imeiNumber'],
                                        'device_id' => $requestParams['deviceId']
                                    );
                                    
                                $this->db->update('tbl_client', $data, array('id' => $userExist->id));
                                
                                $result['status'] = 'true';
                                $result['userId'] = (string) $userExist->id;
                                $result['userName'] = $userExist->client_name;
                                $result['email'] = $userExist->email;
                                $result['phone'] = $userExist->mobile;
                                $result['success'] = 'Login Successfully ';
                            } 
                            else 
                            {
                                $result['status'] = 'false';
                                $result['error'] = 'Incorrect Username or Password';
                            }
                        }
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'forgot_password') 
            {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['email'])) {
                        if (filter_var($requestParams['email'], FILTER_VALIDATE_EMAIL) == false) {
                            $get_user = $this->db->query("SELECT * FROM tbl_users where mobile = '" . $requestParams['email'] . "'");
                        } else {
                            $get_user = $this->db->query("SELECT * FROM tbl_users where email = '" . $requestParams['email'] . "'");
                        }

                        if ($get_user->num_rows() > 0) {
                            $u_det = $get_user->row();
                            $cnfLink = base_url("users/forgotpass/" . $this->encryptStringArray($u_det->id));
                            $config = Array(
                                'mailtype' => 'html',
                                'charset' => 'iso-8859-1'
                            );
                            $this->load->library('email', $config);
                            $this->email->from('noreply@highmountains.in', "High Mountains");
                            $this->email->to($requestParams['email']);
                            $this->email->subject("High Mountains Password Reset");
                            $this->email->message('Hey , <br /><br />A request to change your password has been made. <br /><br />To reset your password, click on the link below :<br /><br/><a href="' . $cnfLink . '">' . $cnfLink . '</a><br /><br/>If the above URL does not work, try copying and pasting it into your browser. Please feel free to contact us, if you continue to face any problems.<br /><br/>Regards,<br/>High Mountain Team');
                            if ($this->email->send()) {
                                $result['status'] = 'true';
                                $result['success'] = 'Password Reset link is sent to your mail.';
                            } else {
                                $result['status'] = 'false';
                            }
                            echo json_encode($result);
                            exit;
                        } else {
                            $result['status'] = 'false';
                            $result['error'] = 'User Not Found';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_newspapers') 
            {
                $result = array();
                $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                
                //$get_user = $this->db->query("SELECT * FROM tbl_users where id = '".$requestParams['userId']. "'" );
                //$user_det = $get_user->row_array();
               /*
                $get_banners = $this->db->query("SELECT * FROM tbl_slider WHERE status=1");
                $banners = $get_banners->result();
                
                foreach ($banners as $banner) {
                    // Special Offers
                    array_push($result['payload']['special'], [
                        'bannerImage' => base_url() . 'include/backend/img/slider_image/' . $banner->slider_img
                    ]);
                }*/
                $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id ");
                                
                if ($query->num_rows() > 0) 
                {
                    $result['newsPapers']=array();
                    $newspapers=$query->result();
                    foreach ($newspapers as $newspaper)
                    {
                        array_push($result['newsPapers'], ['id' => $newspaper->id, 'newspaper_name' => $newspaper->newspaper_name, 'city_name' => $newspaper->city_name]);
                    }
                    $result['success'] = 'Newspapers are fetched.';
                } 
                else 
                {
                    $result['success'] = 'No Newspaper Found.';
                }
                

                //$result['inviteCode'] = $user_det['ref_code'] ;
                //$result['inviteText'] = "Invite Your friends on HM to Earn Credit";
                //$result['inviteUrl'] = "Hey!Want to invite https://HM.com/invite/ Use my referral code '".$result['inviteCode']."' ";
                $result['status'] = 'true';
                $result['success'] = 'Content Successfully Fetched.';
                echo json_encode($result);
                exit;
                 
            } 
            else if ($requestName == 'get_add_on_papers') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId'])) 
                    {
                        $id=$requestParams['newspaperId'];
                        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                        $ng= $query->row();
                        
                        $query = $this->db->get_where('tbl_newspapers', array('id' => $ng->paper_id));
                        $ng= $query->row();
                        
                        $query = $this->db->query("SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE n.g_id='".$ng->g_id."' AND tbl_paper_city.id !='".$id."'");                
                
                        if ($query->num_rows() > 0)
                        {
                            $result['newsPapers']=array();
                            $newspapers=$query->result();
                            foreach ($newspapers as $newspaper)
                            {
                                array_push($result['newsPapers'], ['id' => $newspaper->id, 'newspaper_name' => $newspaper->newspaper_name, 'city_name' => $newspaper->city_name]);
                            }
                            $result['success'] = 'Newspapers are fetched.';
                        } 
                        else 
                        {
                            $result['success'] = 'No Newspaper Found.';
                        }
                        $result['status'] = 'true';
                        $result['success'] = 'Content Successfully Fetched.';
                        echo json_encode($result);
                        exit;
                    }
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'Newspaper Id is missing';
                        exit;
                    }
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_heading') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId'])) 
                    {
                        $id=$requestParams['newspaperId'];
                        
                        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                        $ng= $query->row();
                        $id=$ng->paper_id;
                        
                        $query = $this->db->query("SELECT tbl_cat_with_paper.*, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$id."'");
                        
                        //$heading= $query->result();
                        
                        if ($query->num_rows() > 0)
                        {
                            $result['heading']=array();
                            $heading=$query->result();
                            foreach ($heading as $h)
                            {
                                array_push($result['heading'], ['id' => $h->cat_id, 'heading_name' => $h->cat_name]);
                            }
                            $result['success'] = 'Heading are fetched.';
                        }  
                        else 
                        {
                            $result['success'] = 'No Heading Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_sub_heading') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['catId'])) 
                    {
                        $id=$requestParams['catId'];
                        
                        $query = $this->db->get_where('tbl_sub_heading', array('cat_id' => $id));
                        
                        //$sh= $query->result();
                        
                        //$heading= $query->result();
                        
                        if ($query->num_rows() > 0)
                        {
                            $result['subHeading']=array();
                            $heading=$query->result();
                            foreach ($heading as $h)
                            {
                                array_push($result['subHeading'], ['id' => $h->id, 'sub_heading' => $h->sub_heading]);
                            }
                            $result['success'] = 'Heading are fetched.';
                        }  
                        else 
                        {
                            $result['success'] = 'No Heading Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'catId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_scheme') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId'])&& !empty($requestParams['catId']))
                    {
                        $id=$requestParams['newspaperId'];
                        $cat_id=$requestParams['catId'];
                        $query = $this->db->query("SELECT * FROM `tbl_paper_scheme` WHERE `np_id`='".$id."' AND `type_id`='1' AND `cat_id`='".$cat_id."' GROUP BY `scheme_id`");
                        //$sch= $query->result();
                        
                        //$sh= $query->result();
                        
                        //$heading= $query->result();
                        
                        if ($query->num_rows() > 0)
                        {
                            $result['scheme']=array();
                            $scheme=$query->result();
                            foreach ($scheme as $s)
                            {
                                array_push($result['scheme'], ['id' => $s->id, 'scheme_name' => $s->scheme_name]);
                            }
                            $result['success'] = 'Scheme are fetched.';
                        }  
                        else 
                        {
                            $result['success'] = 'No scheme Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'catId or newspaperId is missing';
                    }
                    echo json_encode($result);
                    exit;                    
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_packages') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId'])&& !empty($requestParams['catId'])&& !empty($requestParams['insertion'])) 
                    {                        
                        $id=$requestParams['newspaperId'];
                        $cat_id=$requestParams['catId'];
                        $insertion=$requestParams['insertion'];
                        
                        $query = $this->db->query("SELECT tbl_package .* ,p.paper_id FROM tbl_package
INNER JOIN tbl_pack_paper p ON p.pack_id=tbl_package.id
WHERE p.paper_id='".$id."' AND tbl_package.cat_id='". $cat_id ."' AND tbl_package.type_id='1' AND tbl_package.ins_from <= '".$insertion."' AND tbl_package.ins_to >= '".$insertion."' GROUP BY tbl_package.id");

                        if ($query->num_rows() > 0) 
                        {
                            $result['packages']=array();
                            $packages = $query->result();
                            
                            foreach ($packages as $package) 
                            {
                                array_push($result['packages'], ['id' => $package->id, 'package_name' => $package->package]);
                            }
                            $result['success'] = 'Packages are fetched.';
                        } 
                        else 
                        {
                            $result['success'] = 'No Package Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            }
            else if ($requestName == 'get_info') 
            {
                
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['addOn'])) 
                    {
                        $add_papers=$requestParams['addOn'];
                        
                        //$add_paper=explode(",",$add_papers);
                        $add_paper=json_decode($add_papers, true);
                        
                        //var_dump($add_paper);
                        //die;
                        $i=0;
                        $f=0;
                        $paper=0;
                        foreach($add_paper as $p_id)
                        {
                            $query = $this->db->get_where('tbl_paper_city', array('id' => $p_id));
                            $ng= $query->row();
                            $values = array(                                
                                'newspaper_id' => $ng->paper_id,
                                'type_id' => $requestParams['typeId'],
                                'cat_id' => $requestParams['catId'],
                                'insertion' => $requestParams['insertion'],
                                'city' => $ng->city_id
                            );
                            
                            $query = $this->db->query("SELECT tbl_ad_price.*,n.name as newspaper_name,c.name as city_name FROM `tbl_ad_price`
                    INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
                    INNER JOIN tbl_cities c ON c.id=tbl_ad_price.city
                    WHERE tbl_ad_price.newspaper_id= '".$values['newspaper_id']."' AND tbl_ad_price.city='".$values['city']."' AND tbl_ad_price.ad_type = '". $values['type_id'] ."' AND tbl_ad_price.ad_cat_id = '".$values['cat_id']."' AND tbl_ad_price.ins_from <= '".$values['insertion']."' AND tbl_ad_price.ins_to >= '".$values['insertion']."'");
                
                    //$query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 2 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");
        
                            $rates= $query->row();
                    
                            if($f==0 && !empty($rates))
                            {
                                $f=1;
                                $base_rate=$rates;
                                $paper=$p_id;
                            }
                            else
                            {
                                if(!empty($rates)&&($rates->ad_price > $base_rate->ad_price))
                                {
                                    $base_rate=$rates;
                                    $paper=$p_id;
                                }                       
                            }
                    
                            $i++;
                        }
                            
                        if(empty($base_rate))
                        {                           
                            $result['success'] = 'Base Rate not Set with this Heading.';
                        }
                        else
                        {
                            $result['info']=array();
                            
                            array_push($result['info'], ['baseId' => $paper,'newspaper_name'=>$base_rate->newspaper_name, 'unit' => $base_rate->unit,'color_type'=>$base_rate->color_type,'minWorld'=>$base_rate->min_w]);
                            //array_push($result['info'], ['baseId' => $paper,'newspaper_name'=>$base_rate->newspaper_name, 'unit' => $base_rate->unit,'color_type'=>$base_rate->color_type,'minWorld'=>$base_rate->min_w,'daysId'=>$base_rate->day_id]);
                            
                            //$data['value']=$paper;
                            //$data['rates']=$base_rate;
                            $result['success'] = 'Base Rate Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                }
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
                
            }
            else if ($requestName == 'get_info_cd') 
            {
                
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['addOn'])) 
                    {
                        $add_papers=$requestParams['addOn'];
                        
                        //$add_paper=explode(",",$add_papers);
                        $add_paper=json_decode($add_papers, true);
                        
                        //var_dump($add_paper);
                        //die;
                        $i=0;
                        $f=0;
                        $paper=0;
                        foreach($add_paper as $p_id)
                        {
                            $query = $this->db->get_where('tbl_paper_city', array('id' => $p_id));
                            $ng= $query->row();
                            $values = array(                                
                                'newspaper_id' => $ng->paper_id,
                                'type_id' => $requestParams['typeId'],
                                'cat_id' => $requestParams['catId'],
                                'insertion' => $requestParams['insertion'],
                                'color' => $requestParams['color'],
                                'size_type' => $requestParams['size_type'],
                                'city' => $ng->city_id
                            );
                            
                            $query = $this->db->query("SELECT tbl_ad_price.*,n.name as newspaper_name,c.name as city_name FROM `tbl_ad_price`
                    INNER JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
                    INNER JOIN tbl_cities c ON c.id=tbl_ad_price.city
                    WHERE tbl_ad_price.newspaper_id= '".$values['newspaper_id']."' AND tbl_ad_price.city='".$values['city']."' AND tbl_ad_price.ad_type = '". $values['type_id'] ."' AND tbl_ad_price.ad_cat_id = '".$values['cat_id']."' AND tbl_ad_price.ins_from <= '".$values['insertion']."' AND tbl_ad_price.ins_to >= '".$values['insertion']."'");
                
                    //$query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 2 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");
        
                            $rates= $query->row();
                    
                            if($f==0 && !empty($rates))
                            {
                                $f=1;
                                $base_rate=$rates;
                                $paper=$p_id;
                            }
                            else
                            {
                                if(!empty($rates)&&($rates->ad_price > $base_rate->ad_price))
                                {
                                    $base_rate=$rates;
                                    $paper=$p_id;
                                }                               
                            }
                    
                            $i++;
                        }
                            
                        if(empty($base_rate))
                        {                           
                            $result['success'] = 'Base Rate not Set with this Heading or color.';
                        }
                        else
                        {
                            $result['info']=array();
                            
                            array_push($result['info'], ['baseId' => $paper,'newspaper_name'=>$base_rate->newspaper_name, 'unit' => $base_rate->unit,'color_type'=>$base_rate->color_type,'minWorld'=>$base_rate->min_w]);
                            //array_push($result['info'], ['baseId' => $paper,'newspaper_name'=>$base_rate->newspaper_name, 'unit' => $base_rate->unit,'color_type'=>$base_rate->color_type,'minWorld'=>$base_rate->min_w,'daysId'=>$base_rate->day_id]);
                            
                            //$data['value']=$paper;
                            //$data['rates']=$base_rate;
                            $result['success'] = 'Base Rate Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                }
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
                
            }
            else if ($requestName == 'get_premium') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId'])) 
                    {
                        $id=$requestParams['newspaperId'];
                        
                        $id=$requestParams['newspaperId'];
                        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                        $ng= $query->row();
                        $id=$ng->paper_id;
                        $query = $this->db->get_where('tbl_newspapers', array('id' => $id));
                        $ng= $query->row();
                        
                        $query = $this->db->get_where('tbl_premimum', array('g_id' =>$ng->g_id));
                        
                        if ($query->num_rows() > 0)
                        {
                            $result['premium']=array();
                            $premium=$query->result();
                            foreach ($premium as $p)
                            {
                                array_push($result['premium'], ['id' => $p->id, 'heading_name' => $p->p_type]);
                            }
                            $result['success'] = 'Premium are fetched.';
                        }  
                        else 
                        {
                            $result['success'] = 'No Premium Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_addon_details') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId'])) 
                    {
                        $id=$requestParams['newspaperId'];
                        $addonId=$requestParams['addonId'];
                        //$query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                        //$ng= $query->row();
                        
                        $query = $this->db->query("SELECT tbl_paper_city.*,n.name as newspaper_name,c.name as city_name FROM tbl_paper_city
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.`paper_id`
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.`city_id`
WHERE tbl_paper_city.id='". $addonId."'
");         
                        $p_n=$query->row();
                        $td=$p_n->newspaper_name ." ,".$p_n->city_name;
                        
                        $values = array(                                
                                'm_newspaper_id' => $requestParams['newspaperId'],
                                'a_newspaper_id' => $requestParams['addonId'],
                                'type_id' =>$requestParams['typeId'],
                                'cat_id' => $requestParams['catId'],
                                'insertion' => $requestParams['insertion'],
                                'size' =>$requestParams['size'],
                                'data'=>$td,
                                'count'=>$requestParams['newspaperId']
                            );
                        
                        /*$query = $this->db->query("SELECT * FROM tbl_add_on WHERE `m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."'");    */
                        
                        $query = $this->db->query("SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."') OR (`m_paper_id` = '".$values['a_newspaper_id']."' AND `a_paper_id` = '".$values['m_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."')");
                        
                        $rates=$query->row();
                        $data['rates']= $rates;
                        $data['values']= $values;
                        
                        if(empty($rates))
                        {
                            $query = $this->db->get_where('tbl_paper_city', array('id' => $values['a_newspaper_id']));
                            $np= $query->row();
                            $query = $this->db->query("SELECT id, `ad_price` as price, `extra_price` as e_price FROM `tbl_ad_price` WHERE `newspaper_id` = '".$np->paper_id ."' AND city='".$np->city_id ."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");
                            
                            $rates= $query->row();
                            $data['rates']= $rates;
                            
                            if(empty($rates))
                            {
                                $result['success'] = 'Add on Rate not Set with Some Newspaper or Heading.';
                            }
                            else
                            {
                                $result['status'] = 'true';
                                $result['success'] = 'Add on Rate Found.';
                            }
                        }
                        else
                        {
                            $result['status'] = 'true';
                            $result['success'] = 'Add on Rate Found.';
                            //echo json_encode($data);
                            //return;
                        }
                        $result['rates']=$data['rates'];
                        $result['values']=$data['values'];
                        echo json_encode($result);
                        exit;
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                }
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'get_focus_day') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['newspaperId']) && !empty($requestParams['catId']) && !empty($requestParams['insertion']) && !empty($requestParams['typeId'])) 
                    {
                        $id=$requestParams['newspaperId'];
                        
                        $query = $this->db->get_where('tbl_paper_city', array('id' => $id));
                        $ng= $query->row();
                        
                        $values = array(                                
                                'newspaper_id' => $ng->paper_id,
                                'type_id' => $requestParams['typeId'],
                                'cat_id' => $requestParams['catId'],
                                'city' => $ng->city_id
                            );
                            
                        $query = $this->db->query("SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."'");
                        
                        $rates= $query->row();
                        
                        if(empty($rates))
                        {
                            $result['status'] = 'true';
                            $result['success'] = 'Rate not Set with this Newspaper or Heading.';
                        }
                        else
                        {
                            $result['status'] = 'true';
                            //$result['focus_day'] = array();
                            
                            $days=explode(",",$rates->day_id);
                            $result['focus_day']=$days;
                            
                            //array_push($result['focus_day'], ['baseId' => $paper,'newspaper_name'=>$base_rate->newspaper_name, 'unit' => $base_rate->unit,'color_type'=>$base_rate->color_type,'minWorld'=>$base_rate->min_w,'daysId'=>$base_rate->day_id]);
                        }
                    } 
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'calculate_amount') 
            {
                $result = array();
                if (!empty($this->input->post())) 
                {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    
                    if (!empty($requestParams['userId'])&&!empty($requestParams['paperId'])&&!empty($requestParams['ro_type'])&&!empty($requestParams['catId'])&&!empty($requestParams['subHeading'])&&!empty($requestParams['insertion'])&&!empty($requestParams['schemeId'])&&!empty($requestParams['matter'])&&!empty($requestParams['noofLine'])&&!empty($requestParams['packageId'])&&!empty($requestParams['dates'])&&!empty($requestParams['premium'])) 
                    {                        
                        if(requestParams['ro_type']=="M")
                        {
                            foreach($requestParams['paperId'] as $addon_id)
                            //add on calculate_amount start
                            $query = $this->db->query("SELECT tbl_paper_city.*,n.name as newspaper_name,c.name as city_name FROM tbl_paper_city
INNER JOIN tbl_newspapers n ON n.id=tbl_paper_city.`paper_id`
INNER JOIN tbl_cities c ON c.id=tbl_paper_city.`city_id`
WHERE tbl_paper_city.id='". $addon_id."'
");         
                            $p_n=$query->row();
                            $paper_name=$p_n->newspaper_name ." ,".$p_n->city_name;
                
                            $values = array(                                
                                'm_newspaper_id' => $this->input->post('m_newspaper'),
                                'a_newspaper_id' => $this->input->post('a_newspaper'),
                                'type_id' => 1,
                                'cat_id' => $this->input->post('cat'),
                                'insertion' => $this->input->post('inse'),
                                'size' =>$this->input->post('size'),
                                'data'=>$td,
                                'count'=>$this->input->post('count')
                            );
                            
                            /*$query = $this->db->query("SELECT * FROM tbl_add_on WHERE `m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."'");    */
                
                            $query = $this->db->query("SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."') OR (`m_paper_id` = '".$values['a_newspaper_id']."' AND `a_paper_id` = '".$values['m_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."')");
        
                            $rates=$query->row();
                            $data['rates']= $rates;
                            $data['values']= $values;
                            
                            if(empty($rates))
                            {
                                        
                                $query = $this->db->get_where('tbl_paper_city', array('id' => $values['a_newspaper_id']));
                                $np= $query->row(); 
                    
                                $query = $this->db->query("SELECT id, `ad_price` as price, `extra_price` as e_price FROM `tbl_ad_price` WHERE `newspaper_id` = '".$np->paper_id ."' AND city='".$np->city_id ."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'");
        
                                $rates= $query->row();
                                $data['rates']= $rates;
                    
                                if(empty($rates))
                                {
                                    $data['id']=$id;
                                    $data['msg']="2";
                                    echo json_encode($data);
                                    return;
                                }
                                else
                                {
                                    echo json_encode($data);
                                    return;
                                }
                            }
                            else
                            {
                                echo json_encode($data);
                                return;
                            }
                            //add on calculate_amount end
                        }
                    }
                    else 
                    {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more Parameter is missing';
                    }
                    echo json_encode($result);
                    exit;
                } 
                else 
                {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } 
            else if ($requestName == 'past_booking') 
            {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['userId'])) {
                        /* $get_user = $this->db->query("SELECT * FROM tbl_users where id = '".$requestParams['userId']. "'" );
                          $user_det = $get_user->row(); */
                        $result['payload']['packages'] = array();
                        $get_package = $this->db->query("SELECT tbl_book_packages.*, p.name as pack_name, p.main_img , p.valid_to, p.fromCity, p.valid_from FROM tbl_book_packages
INNER JOIN tbl_package p ON p.id=tbl_book_packages.pack_id
WHERE tbl_book_packages.user_id='" . $requestParams['userId'] . "' AND tbl_book_packages.pack_type='0' AND p.valid_to < DATE(NOW())");

                        if (($get_package->num_rows() > 0)) {
                            $packages = $get_package->result();
                            foreach ($packages as $p_package) {
                                $pac_image = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id=" . $p_package->pack_id . " LIMIT 0, 1");
                                $pack_image = $pac_image->row_array();
                                $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/package_img/" . $p_package->pack_id . "/" . $pack_image['images'];

                                array_push($result['payload']['packages'], ['package_id' => $p_package->pack_id, 'name' => $p_package->pack_name, 'pack_type' => $p_package->pack_type, 'icon' => $pImage, 'date_from' => $p_package->valid_from, 'city' => $p_package->fromCity, 'amount' => $p_package->pack_price]);
                            }

                            $result['success'] = 'Booked Packages are fetched.';
                        } else {
                            $result['success'] = 'No Booking Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'past_bookings') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['userId'])) {
                        /* $get_user = $this->db->query("SELECT * FROM tbl_users where id = '".$requestParams['userId']. "'" );
                          $user_det = $get_user->row(); */
                        $result['payload']['packages'] = array();
                        $get_package = $this->db->query("SELECT tbl_book_packages.*, p.name as pack_name, p.main_img , p.valid_to, p.fromCity, p.valid_from FROM tbl_book_packages
INNER JOIN tbl_package p ON p.id=tbl_book_packages.pack_id
WHERE tbl_book_packages.user_id='" . $requestParams['userId'] . "' AND tbl_book_packages.pack_type='0' AND p.valid_to < DATE(NOW())");

                        $cust_package = $this->db->query("SELECT tbl_book_packages.*, cp.name as pack_name, cp.main_img, cp.valid_to, cp.fromCity, cp.valid_from FROM tbl_book_packages INNER JOIN tbl_custom_package cp ON cp.id=tbl_book_packages.pack_id WHERE tbl_book_packages.user_id='" . $requestParams['userId'] . "' AND tbl_book_packages.pack_type='1' AND cp.valid_to < DATE(NOW())");

                        if (($get_package->num_rows() > 0) || ($cust_package->num_rows() > 0)) {
                            if (($get_package->num_rows() > 0)) {
                                $packages = $get_package->result();
                                foreach ($packages as $p_package) {
                                    $pac_image = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id=" . $p_package->pack_id . " LIMIT 0, 1");
                                    $pack_image = $pac_image->row_array();
                                    $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/package_img/" . $p_package->pack_id . "/" . $pack_image['images'];

                                    array_push($result['payload']['packages'], ['package_id' => $p_package->pack_id, 'name' => $p_package->pack_name, 'pack_type' => $p_package->pack_type, 'icon' => $pImage, 'date_from' => $p_package->valid_from, 'city' => $p_package->fromCity, 'amount' => $p_package->pack_price]);
                                }
                            }
                            if (($cust_package->num_rows() > 0)) {
                                $packages = $cust_package->result();
                                foreach ($packages as $p_package) {
                                    $pac_image = $this->db->query("SELECT * FROM    tbl_cust_pack_attachments WHERE pack_id=" . $p_package->pack_id . " LIMIT 0, 1");
                                    $pack_image = $pac_image->row_array();
                                    $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/custom_pack_image/" . $p_package->pack_id . "/" . $pack_image['images'];

                                    array_push($result['payload']['packages'], ['package_id' => $p_package->pack_id, 'name' => $p_package->pack_name, 'pack_type' => $p_package->pack_type, 'icon' => $pImage, 'date_from' => $p_package->valid_from, 'city' => $p_package->fromCity, 'amount' => $p_package->pack_price]);
                                }
                            }

                            $result['success'] = 'Booked Packages are fetched.';
                        } else {
                            $result['success'] = 'No Booking Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_activity_cats') {
                $result = array();
                //$requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                $result['payload']['activity_cat'] = array();
                $get_cats = $this->db->query("SELECT * FROM tbl_act_cat WHERE status='A'");
                if ($get_cats->num_rows() > 0) {
                    $act_cats = $get_cats->result();
                    foreach ($act_cats as $act_cat) {
                        $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/activities_img/cat/" . $act_cat->image;
                        array_push($result['payload']['activity_cat'], ['activity_cat_id' => $act_cat->id, 'name' => $act_cat->name, 'icon' => $pImage]);
                    }
                    $result['success'] = 'Activity category are fetched.';
                } else {
                    $result['success'] = 'No Activity category Found.';
                }
                $result['status'] = 'true';

                echo json_encode($result);
                exit;
            } else if ($requestName == 'get_activities') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['activityCatId'])) {
                        $result['payload']['activities'] = array();
                        $get_activity = $this->db->query("SELECT * FROM tbl_activities WHERE cat_id='" . $requestParams['activityCatId'] . "' AND status='A'");
                        if ($get_activity->num_rows() > 0) {
                            $activities = $get_activity->result();
                            foreach ($activities as $activity) {
                                if (isset($requestParams['userId']) && !empty($requestParams['userId'])) {
                                    $get_like_det = $this->db->query("SELECT * FROM tbl_activity_bucketlist WHERE user_id = '" . $requestParams['userId'] . "' AND activity_id = '" . $activity->id . "'");
                                    $likeDet = $get_like_det->row();
                                    if ($get_like_det->num_rows() == 0) {
                                        $like = "false";
                                    } else {
                                        $like = "true";
                                    }
                                } else {
                                    $like = "false";
                                }
                                $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/activities_img/" . $activity->img;
                                array_push($result['payload']['activities'], ['activity_id' => $activity->id, 'name' => $activity->name, 'icon' => $pImage, 'bucketlist' => $like]);
                            }
                            $result['success'] = 'Activities are fetched.';
                        } else {
                            $result['success'] = 'No Activities Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_activity_details') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['activityId'])) {
                        $get_activity = $this->db->query("SELECT * FROM tbl_activities WHERE id='" . $requestParams['activityId'] . "'");
                        $activity = $get_activity->row_array();
                        /* $result['payload']['images'] = array();
                          $get_package_imgs = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id='".$package['id']."'" );
                          $package_imgs = $get_package_imgs->result_array();
                          foreach($package_imgs as $package_img) {
                          array_push($result['payload']['images'], [
                          'bannerImage' => base_url()."include/backend/img/package_img/"  . $requestParams['packageId'] ."/" . $package_img['images']
                          ]);
                          } */
                        if (isset($requestParams['userId']) && !empty($requestParams['userId'])) {
                            $get_like_det = $this->db->query("SELECT * FROM tbl_activity_bucketlist WHERE user_id = '" . $requestParams['userId'] . "' AND activity_id = '" . $requestParams['activityId'] . "'");
                            $likeDet = $get_like_det->row();
                            if ($get_like_det->num_rows() == 0) {
                                $like = "false";
                            } else {
                                $like = "true";
                            }
                        } else {
                            $like = "false";
                        }
                        $result['title'] = $activity['name'];
                        $result['desc'] = $activity['overview'];
                        $result['price'] = $activity['price'];
                        $result['image'] = base_url() . "include/backend/img/activities_img/" . $activity['img'];
                        $result['bucketlist'] = $like;
                        $result['success'] = 'Activity Details are fetched.';
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_rentouts_cats') {
                $result = array();
                //$requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                $result['payload']['rentsouts_cat'] = array();
                $get_rentsouts = $this->db->query("SELECT * FROM tbl_rent_cat WHERE status='A'");
                if ($get_rentsouts->num_rows() > 0) {
                    $rentsouts = $get_rentsouts->result();
                    foreach ($rentsouts as $rentsout) {
                        $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/rentouts/" . $rentsout->image;
                        array_push($result['payload']['rentsouts_cat'], ['rentout_cat_id' => $rentsout->id, 'name' => $rentsout->name, 'icon' => $pImage]);
                    }
                    $result['success'] = 'rentsouts category are fetched.';
                } else {
                    $result['success'] = 'No rentsouts category Found.';
                }
                $result['status'] = 'true';

                echo json_encode($result);
                exit;
            } else if ($requestName == 'get_rentouts') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['reantCatId'])) {
                        /* $get_user = $this->db->query("SELECT * FROM tbl_users where id = '".$requestParams['userId']. "'" );
                          $user_det = $get_user->row(); */
                        $result['payload']['rentouts'] = array();
                        $get_rentouts = $this->db->query("SELECT * FROM tbl_rent WHERE type='" . $requestParams['reantCatId'] . "' AND status='A'");
                        if ($get_rentouts->num_rows() > 0) {
                            $rentouts = $get_rentouts->result();
                            foreach ($rentouts as $rentout) {
                                $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/rentouts/" . $rentout->img;
                                array_push($result['payload']['rentouts'], ['rentout_id' => $rentout->id, 'name' => $rentout->name, 'icon' => $pImage]);
                            }
                            $result['success'] = 'Rentouts are fetched.';
                        } else {
                            $result['success'] = 'No Rentouts Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_rentout_details') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['rentoutId'])) {
                        $get_rentout = $this->db->query("SELECT * FROM tbl_rent WHERE id='" . $requestParams['rentoutId'] . "'");
                        $rentout = $get_rentout->row_array();
                        /* $result['payload']['images'] = array();
                          $get_package_imgs = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id='".$package['id']."'" );
                          $package_imgs = $get_package_imgs->result_array();
                          foreach($package_imgs as $package_img) {
                          array_push($result['payload']['images'], [
                          'bannerImage' => base_url()."include/backend/img/package_img/"  . $requestParams['packageId'] ."/" . $package_img['images']
                          ]);
                          } */
                        $result['title'] = $rentout['name'];
                        $result['desc'] = $rentout['des'];
                        $result['price'] = $rentout['price'];
                        $result['image'] = base_url() . "include/backend/img/rentouts" . $rentout['img'];
                        $result['success'] = 'Rentout Details are fetched.';
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_blogs') {
                $result = array();
                //$requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                $result['payload']['blogs'] = array();
                $get_blogs = $this->db->query("SELECT * FROM tbl_blog WHERE status='A'");
                if ($get_blogs->num_rows() > 0) {
                    $blogs = $get_blogs->result();
                    foreach ($blogs as $blog) {
                        $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/blog_img/" . $blog->img;
                        array_push($result['payload']['blogs'], ['blog_id' => $blog->id, 'name' => $blog->title, 'content' => substr($blog->content, 0, 150)]);
                    }
                    $result['success'] = 'Blogs are fetched.';
                } else {
                    $result['success'] = 'No Blogs category Found.';
                }
                $result['status'] = 'true';

                echo json_encode($result);
                exit;
            } else if ($requestName == 'my_blogs') {
                $result = array();
                $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                if (!empty($requestParams['userId'])) {
                    $result['payload']['blogs'] = array();
                    $get_blogs = $this->db->query("SELECT * FROM tbl_blog WHERE status='A' AND gid='" . $requestParams['userId'] . "'");
                    if ($get_blogs->num_rows() > 0) {
                        $blogs = $get_blogs->result();
                        foreach ($blogs as $blog) {
                            $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/blog_img/" . $blog->img;
                            array_push($result['payload']['blogs'], ['blog_id' => $blog->id, 'name' => $blog->title, 'content' => substr($blog->content, 0, 150)]);
                        }
                        $result['success'] = 'Blogs are fetched.';
                    } else {
                        $result['success'] = 'No Blogs category Found.';
                    }
                    $result['status'] = 'true';
                } else {
                    $result['status'] = 'false';
                    $result['error'] = 'One or more out of userId is missing';
                }
                echo json_encode($result);
                exit;
            } else if ($requestName == 'get_blog_details') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['blogId'])) {
                        $get_blog = $this->db->query("SELECT * FROM tbl_blog WHERE id='" . $requestParams['blogId'] . "'");
                        $blog = $get_blog->row_array();
                        /* $result['payload']['images'] = array();
                          $get_package_imgs = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id='".$package['id']."'" );
                          $package_imgs = $get_package_imgs->result_array();
                          foreach($package_imgs as $package_img) {
                          array_push($result['payload']['images'], [
                          'bannerImage' => base_url()."include/backend/img/package_img/"  . $requestParams['packageId'] ."/" . $package_img['images']
                          ]);
                          } */
                        $result['title'] = $blog['title'];
                        $result['desc'] = $blog['content'];
                        $result['image'] = base_url() . "include/backend/img/blog_img" . $blog['img'];
                        $result['success'] = 'Blog Details are fetched.';
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_guides') {
                $result = array();
                //$requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                $result['payload']['guides'] = array();
                $get_guides = $this->db->query("SELECT * FROM tbl_guides WHERE status='A'");
                if ($get_guides->num_rows() > 0) {
                    $guides = $get_guides->result();
                    foreach ($guides as $guide) {
                        $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/guide/" . $guide->id . "/" . $guide->img;

                        $query = $this->db->query("SELECT * FROM tbl_guide_reviews WHERE g_id='" . $guide->id . "'");
                        $review_count = $query->num_rows();

                        //$result['guide_user_id'] = $guide['user_id'];
                        array_push($result['payload']['guides'], ['guide_id' => $guide->id, 'guide_user_id' => $guide->user_id, 'name' => $guide->name, 'about' => $guide->bio, 'rating' => $guide->rating, 'image' => $pImage, 'location' => $guide->address, 'charges' => $guide->charges, 'review_count' => $review_count]);
                    }
                    $result['success'] = 'Guides are fetched.';
                } else {
                    $result['success'] = 'No Guides category Found.';
                }
                $result['status'] = 'true';

                echo json_encode($result);
                exit;
            } else if ($requestName == 'app_feedback') {
                $result = array();
                $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                $values = array(
                    'user_id' => $requestParams['userId'],
                    'aap_experince' => $requestParams['appExperince'],
                    'commets' => $requestParams['comments'],
                    'dated' => date('Y-m-d H:i:s')
                );
                $query = $this->db->insert('tbl_aapfeedback', $values);
                $result['success'] = 'Feedback Successfully Saved.';
                $result['status'] = 'true';

                echo json_encode($result);
                exit;
            } else if ($requestName == 'cities_list') {
                $result = array();
                $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                $get_cities = $this->db->query("SELECT * FROM cities");
                $cities = $get_cities->result_array();
                $result['cities'] = array();
                foreach ($cities as $city) {
                    $ct = array();
                    $get_states = $this->db->query("SELECT * FROM states WHERE id=" . $city['state_id']);
                    $states = $get_states->row_array();
                    $get_country = $this->db->query("SELECT * FROM countries WHERE id=" . $states['country_id']);
                    $country = $get_country->row_array();
                    //array_push($ct, ['city_name'=>$city['name'], 'state'=>$states['name'], 'country_id'=>$country['name']]);
                    array_push($result['cities'], ['city_name' => $city['name'], 'state' => $states['name'], 'country_id' => $country['name']]);
                }
                $result['success'] = 'Cities Successfully Fetched.';
                $result['status'] = 'true';

                echo json_encode($result);
                exit;
            } else if ($requestName == 'search_package') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['fromCity']) && !empty($requestParams['toCity']) && !empty($requestParams['month'])) {
                        $result['payload']['packages'] = array();
                        $get_package = $this->db->query("SELECT tbl_package.*, tbl_destinations.title as destination, tbl_destinations.country FROM tbl_package INNER JOIN tbl_destinations ON tbl_package.dest_id = tbl_destinations.id where tbl_package.status = 'A' AND tbl_destinations.city = '" . $requestParams['toCity'] . "' AND tbl_package.fromCity = '" . $requestParams['fromCity'] . "' ");
                        if ($get_package->num_rows() > 0) {
                            $packages = $get_package->result();
                            foreach ($packages as $p_package) {
                                $pac_image = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id=" . $p_package->id . " LIMIT 0, 1");
                                $pack_image = $pac_image->row_array();
                                $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/package_img/" . $p_package->id . "/" . $pack_image['images'];
                                array_push($result['payload']['packages'], ['package_id' => $p_package->id, 'name' => $p_package->name, 'icon' => $pImage]);
                            }
                            $result['success'] = 'Packages are fetched.';
                        } else {
                            $result['success'] = 'No Package Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_guide_details') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['guideId'])) {
                        $get_guide = $this->db->query("SELECT * FROM tbl_guides WHERE id='" . $requestParams['guideId'] . "'");
                        $guide = $get_guide->row_array();
                        $result['payload']['reviews'] = array();
                        $result['payload']['blogs'] = array();
                        $get_reviews = $this->db->query("SELECT *, tbl_users.user_name, tbl_userprofile.pic FROM tbl_guide_reviews INNER JOIN tbl_users ON tbl_guide_reviews.u_id=tbl_users.id INNER JOIN tbl_userprofile ON tbl_users.id=tbl_userprofile.user_id WHERE g_id='" . $requestParams['guideId'] . "'");
                        $reviews = $get_reviews->result_array();
                        foreach ($reviews as $review) {
                            array_push($result['payload']['reviews'], [
                                'review' => $review['text'], 'rating' => $review['rating'], 'reviewer_name' => $review['user_name'], 'reviewer_pic' => base_url() . "include/images/user_imgs/" . $review['u_id'] . "/" . $review['pic']
                            ]);
                        }
                        $get_blog = $this->db->query("SELECT * FROM tbl_blog WHERE gid='" . $requestParams['guideId'] . "'");
                        $blogs = $get_blog->result_array();
                        foreach ($blogs as $blog) {
                            array_push($result['payload']['blogs'], ['id' => $blog['id'],
                                'title' => $blog['title'], 'content' => $blog['content']
                            ]);
                        }
                        $result['name'] = $guide['name'];
                        $result['guide_user_id'] = $guide['user_id'];
                        $result['mobile'] = $guide['mobile'];
                        $result['email'] = $guide['email'];
                        $result['address'] = $guide['address'];
                        $result['bio'] = $guide['bio'];
                        $result['language'] = $guide['languages'];
                        $result['activities'] = $guide['activities'];
                        $result['act_expert'] = "dummy1,dummy2";
                        $result['places_travelled'] = "dummy1,dummy2";
                        $result['loc_expert'] = "dummy1,dummy2";
                        $result['iWillShowYou'] = $guide['i_show_you'];
                        $result['rating'] = $guide['rating'];
                        $result['charges'] = $guide['charges'];
                        $result['image'] = base_url() . "include/backend/img/guide/" . $requestParams['guideId'] . "/" . $guide['img'];
                        $result['success'] = 'Guide Details are fetched.';
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of userId is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'guide_apply') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['name']) && !empty($requestParams['address']) && !empty($requestParams['mobileNo']) && !empty($requestParams['email']) && !empty($requestParams['password'])) {
                        $values = array(
                            'name' => $requestParams['name'],
                            'user_id' => $requestParams['userId'],
                            'mobile' => $requestParams['mobileNo'],
                            'email' => $requestParams['email'],
                            'address' => $requestParams['address'],
                            'location_expertise' => $requestParams['locationExpertise'],
                            'bio' => $requestParams['bio'],
                            'i_show_you' => $requestParams['iWillShowU'],
                            'activities' => $requestParams['activities'],
                            'activities_expertise' => $requestParams['activitiesExpertise'],
                            'languages' => $requestParams['languages'],
                            'charges' => $requestParams['charges'],
                            'places_traveled' => $requestParams['placesTraveled'],
                            'status' => 'A',
                            'c_date' => date('Y-m-d H:i:s')
                        );
                        $query = $this->db->insert('tbl_guides', $values);
                        $last_id = $this->db->insert_id();
                        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $last_id)) {
                            $mask = umask(0);
                            mkdir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $last_id, 0777);
                            umask($mask);
                        }
                        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $last_id . '/';
                        if (isset($requestParams['idProof']) && !empty($requestParams['idProof'])) {
                            $data = base64_decode($requestParams['idProof']);
                            $source_img = imagecreatefromstring($data);
                            $img_name = "id_proof-" . $last_id . ".jpg";
                            $file = $uploaddir . "/" . $img_name;
                            $imageSave = imagejpeg($source_img, $file, 80);
                            imagedestroy($source_img);
                        } else {
                            $img_name = "";
                        }
                        if (isset($requestParams['guideImg']) && !empty($requestParams['guideImg'])) {
                            $dataGuideImg = base64_decode($requestParams['guideImg']);
                            $source_guide_img = imagecreatefromstring($dataGuideImg);
                            $guide_img_name = "guide_img-" . $last_id . ".jpg";
                            $save_img_file = $uploaddir . "/" . $guide_img_name;
                            $guideImageSave = imagejpeg($source_guide_img, $save_img_file, 80);
                            imagedestroy($source_guide_img);
                        } else {
                            $guide_img_name = "";
                        }
                        $update_values = array(
                            'img' => $guide_img_name,
                            'id_doc' => $img_name
                        );
                        $this->db->update('tbl_guides', $update_values, array('id' => $last_id));
                        $result['status'] = 'true';
                        $result['userId'] = (string) $last_id;
                        $result['success'] = 'Registration was successful.';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;

                /*                 * ********** Handle User Login from email, FB, G+ Request from App  **************** */
            } else if ($requestName == 'upload_guide_img') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['gId'])) {
                        $last_id = $requestParams['gId'];
                        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $last_id)) {
                            $mask = umask(0);
                            mkdir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $last_id, 0777);
                            umask($mask);
                        }
                        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $last_id . '/';
                        $oja = json_decode($requestParams['imgs'], true);
                        $in = 1;
                        foreach ($oja as $img) {
                            $data = base64_decode($img['img']);
                            $source_img = imagecreatefromstring($data);
                            $img_name = "id_proof-" . $last_id . "-" . $in . ".jpg";
                            $file = $uploaddir . "/" . $img_name;
                            $imageSave = imagejpeg($source_img, $file, 80);
                            imagedestroy($source_img);

                            $update_values = array(
                                'g_id' => $last_id,
                                'images' => $guide_img_name,
                                'modified' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tbl_guide_img', $update_values);
                            $in++;
                        }
                        $result['status'] = 'true';
                        $result['userId'] = (string) $last_id;
                        $result['success'] = 'Registration was successful.';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;

                /*                 * ********** Handle User Login from email, FB, G+ Request from App  **************** */
            } else if ($requestName == 'bucketlist_packages') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId']) && !empty($requestParams['packageId'])) {
                        $get_likes = $this->db->query("SELECT * FROM tbl_bucketlist WHERE user_id = " . $requestParams['userId'] . " AND package_id = " . $requestParams['packageId'] . " ");
                        if ($get_likes->num_rows() == 0) {
                            $values = array(
                                'user_id' => $requestParams['userId'],
                                'package_id' => $requestParams['packageId'],
                                'dated' => date('Y-m-d H:i:s')
                            );
                            $query = $this->db->insert('tbl_bucketlist', $values);
                            $last_id = $this->db->insert_id();
                            $result['status'] = 'true';
                            $result['success'] = 'Package added in bucketlist successfully ';
                        } else {
                            $result['status'] = 'false';
                            $result['error'] = 'You already added in bucketlist this Package';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'remove_bucketlist_pack') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId']) && !empty($requestParams['packageId'])) {
                        $del = $this->db->query("Delete FROM tbl_bucketlist where user_id = " . $requestParams['userId'] . " AND package_id=" . $requestParams['packageId'] . "");
                        $result['status'] = 'true';
                        $result['success'] = 'Deleted successfully ';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'my_bucketlist') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId'])) {

                        $result['payload']['packages'] = array();
                        $get_package = $this->db->query("SELECT * FROM tbl_package WHERE id IN (SELECT package_id FROM tbl_bucketlist WHERE user_id='" . $requestParams['userId'] . "')");
                        if ($get_package->num_rows() > 0) {
                            $packages = $get_package->result();
                            foreach ($packages as $p_package) {
                                $pac_image = $this->db->query("SELECT * FROM tbl_pack_attachments WHERE pack_id=" . $p_package->id . " LIMIT 0, 1");
                                $pack_image = $pac_image->row_array();
                                $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/package_img/" . $p_package->id . "/" . $pack_image['images'];
                                array_push($result['payload']['packages'], ['package_id' => $p_package->id, 'name' => $p_package->name, 'icon' => $pImage]);
                            }
                            $result['success'] = 'Packages are fetched.';
                        } else {
                            $result['success'] = 'No Package Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'bucketlist_activities') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId']) && !empty($requestParams['activityId'])) {
                        $get_likes = $this->db->query("SELECT * FROM tbl_activity_bucketlist WHERE user_id = " . $requestParams['userId'] . " AND activity_id = " . $requestParams['activityId'] . " ");
                        if ($get_likes->num_rows() == 0) {
                            $values = array(
                                'user_id' => $requestParams['userId'],
                                'activity_id' => $requestParams['activityId'],
                                'dated' => date('Y-m-d H:i:s')
                            );
                            $query = $this->db->insert('tbl_activity_bucketlist', $values);
                            $last_id = $this->db->insert_id();
                            $result['status'] = 'true';
                            $result['success'] = 'Activity added in bucketlist successfully ';
                        } else {
                            $result['status'] = 'false';
                            $result['error'] = 'You already added in bucketlist this Activity';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'remove_bucketlist_act') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId']) && !empty($requestParams['activityId'])) {
                        $del = $this->db->query("Delete FROM tbl_activity_bucketlist where user_id = " . $requestParams['userId'] . " AND activity_id=" . $requestParams['activityId'] . "");
                        $result['status'] = 'true';
                        $result['success'] = 'Deleted successfully ';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'my_bucketlist_act') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId'])) {

                        $result['payload']['activities'] = array();
                        $get_activity = $this->db->query("SELECT * FROM tbl_activities WHERE id IN (SELECT activity_id FROM tbl_activity_bucketlist WHERE user_id='" . $requestParams['userId'] . "')");
                        if ($get_activity->num_rows() > 0) {
                            $activities = $get_activity->result();
                            foreach ($activities as $activity) {
                                $pImage = "http://" . $_SERVER['HTTP_HOST'] . "/hm/include/backend/img/activities_img/" . $activity->img;
                                array_push($result['payload']['activities'], ['activity_id' => $activity->id, 'name' => $activity->name, 'icon' => $pImage]);
                            }
                            $result['success'] = 'Activities are fetched.';
                        } else {
                            $result['success'] = 'No Activities Found.';
                        }
                        $result['status'] = 'true';

                        echo json_encode($result);
                        exit;
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'blog_like') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId']) && !empty($requestParams['blogId'])) {
                        $get_likes = $this->db->query("SELECT * FROM tbl_blog_likes WHERE user_id = " . $requestParams['userId'] . " AND blog_id = " . $requestParams['blogId'] . " ");
                        if ($get_likes->num_rows() == 0) {
                            $values = array(
                                'user_id' => $requestParams['userId'],
                                'blog_id' => $requestParams['blogId'],
                                'dated' => date('Y-m-d H:i:s')
                            );
                            $query = $this->db->insert('tbl_blog_likes', $values);
                            $last_id = $this->db->insert_id();
                            $result['status'] = 'true';
                            $result['success'] = 'Like successfully ';
                        } else {
                            $result['status'] = 'false';
                            $result['error'] = 'You already Like';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'remove_blog_like') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['userId']) && !empty($requestParams['blogId'])) {
                        $del = $this->db->query("Delete FROM tbl_blog_likes where user_id = " . $requestParams['userId'] . " AND blog_id=" . $requestParams['blogId'] . "");
                        $result['status'] = 'true';
                        $result['success'] = 'Deleted successfully ';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id, offer id, is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'guide_login') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();

                    if (!empty($requestParams['email']) && !empty($requestParams['password'])) {
                        $count = $this->db->query('SELECT * FROM tbl_guides where email = \'' . $requestParams['email'] . '\' AND passcode=\'' . md5($requestParams['password']) . '\'');

                        // print_r($count);
                        if ($count->num_rows() > 0) {
                            $userExist = $count->result();
                            if ($userExist[0]->status == 'A') {
                                /* $data = array(
                                  'device_type' => $requestParams['deviceType'],
                                  'imei_number' => $requestParams['imeiNumber'],
                                  'device_id' => $requestParams['deviceId']
                                  );
                                  $this->db->update('tbl_executives', $data, array('id' => $userExist->result()[0]->id)); */
                                $result['payload']['reviews'] = array();
                                $result['payload']['blogs'] = array();
                                $result['payload']['imgs'] = array();
                                $get_reviews = $this->db->query("SELECT *, tbl_users.user_name, tbl_userprofile.pic FROM tbl_guide_reviews INNER JOIN tbl_users ON tbl_guide_reviews.u_id=tbl_users.id INNER JOIN tbl_userprofile ON tbl_users.id=tbl_userprofile.user_id WHERE g_id='" . $userExist[0]->id . "'");
                                $reviews = $get_reviews->result_array();
                                foreach ($reviews as $review) {
                                    array_push($result['payload']['reviews'], [
                                        'review' => $review['text'], 'rating' => $review['rating'], 'reviewer_name' => $review['user_name'], 'reviewer_pic' => base_url() . "include/images/user_imgs/" . $review['u_id'] . "/" . $review['pic']
                                    ]);
                                }
                                $get_blog = $this->db->query("SELECT * FROM tbl_blog WHERE gid='" . $userExist[0]->id . "'");
                                $blogs = $get_blog->result_array();
                                foreach ($blogs as $blog) {
                                    array_push($result['payload']['blogs'], ['id' => $blog['id'],
                                        'title' => $blog['title'], 'content' => $blog['content']
                                    ]);
                                }
                                $get_imgs = $this->db->query("SELECT * FROM tbl_guide_img WHERE g_id='" . $userExist[0]->id . "'");
                                $imgs = $get_imgs->result_array();
                                foreach ($imgs as $img) {
                                    array_push($result['payload']['imgs'], ['id' => $img['id'],
                                        'image' => base_url() . "include/backend/img/guide/" . $userExist[0]->id . "/" . $img['images']
                                    ]);
                                }
                                $result['name'] = $userExist[0]->name;
                                $result['mobile'] = $userExist[0]->mobile;
                                $result['email'] = $userExist[0]->email;
                                $result['address'] = $userExist[0]->address;
                                $result['bio'] = $userExist[0]->bio;
                                $result['language'] = $userExist[0]->languages;
                                $result['activities'] = $userExist[0]->activities;
                                $result['iWillShowYou'] = $userExist[0]->i_show_you;
                                $result['rating'] = $userExist[0]->rating;
                                $result['charges'] = $userExist[0]->charges;
                                $result['location_expertise'] = $userExist[0]->location_expertise;
                                $result['activities_expertise'] = $userExist[0]->activities_expertise;
                                $result['places_traveled'] = $userExist[0]->places_traveled;
                                //$result['image'] = base_url()."include/backend/img/guide/".$userExist[0]->id."/". $userExist[0]->img ;
                                $result['status'] = 'true';
                                $result['guideId'] = (string) $userExist[0]->id;
                                //$result['qrCode'] = 'BMV-'.(string) $userExist[0]->id ;
                                $result['success'] = 'Login Successfully ';
                            } else {
                                $result['status'] = 'false';
                                $result['error'] = 'Your Account is not active Yet.';
                            }
                        } else {
                            $result['status'] = 'false';
                            $result['error'] = 'Incorrect Username or Password';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'guide_profile_update') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['name']) && !empty($requestParams['address']) && !empty($requestParams['guideId']) && !empty($requestParams['mobileNo']) && !empty($requestParams['email'])) {
                        $values = array(
                            'name' => $requestParams['name'],
                            'mobile' => $requestParams['mobileNo'],
                            'email' => $requestParams['email'],
                            'address' => $requestParams['address'],
                            'location_expertise' => $requestParams['locationExpertise'],
                            'bio' => $requestParams['bio'],
                            'i_show_you' => $requestParams['iWillShowU'],
                            'activities' => $requestParams['activities'],
                            'activities_expertise' => $requestParams['activitiesExpertise'],
                            'languages' => $requestParams['languages'],
                            'charges' => $requestParams['charges'],
                            'places_traveled' => $requestParams['placesTraveled']
                        );
                        $query = $this->db->update('tbl_guides', $values, array('id' => $requestParams['guideId']));
                        //$last_id = $this->db->insert_id() ;
                        if (!empty($requestParams['guideImg'])) {
                            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $requestParams['guideId'])) {
                                $mask = umask(0);
                                mkdir($_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $requestParams['guideId'], 0777);
                                umask($mask);
                            }
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/hm/include/backend/img/guide/' . $requestParams['guideId'] . '/';
                            $dataGuideImg = base64_decode($requestParams['guideImg']);
                            $source_guide_img = imagecreatefromstring($dataGuideImg);
                            $guide_img_name = "guide_img-" . $requestParams['guideId'] . ".jpg";
                            $save_img_file = $uploaddir . "/" . $guide_img_name;
                            $guideImageSave = imagejpeg($source_guide_img, $save_img_file, 80);
                            imagedestroy($source_guide_img);
                            $update_values = array(
                                'img' => $guide_img_name
                            );
                            $this->db->update('tbl_guides', $update_values, array('id' => $requestParams['guideId']));
                        }
                        $result['status'] = 'true';
                        $result['guideId'] = (string) $requestParams['guideId'];
                        $result['success'] = 'Updated successful.';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'user_referal') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['userId']) && !empty($requestParams['referralCode']) && !empty($requestParams['deviceId'])) {
                        $getUserDet = $this->db->query("SELECT * FROM tbl_users where id = '" . $requestParams['userId'] . "' ");
                        if ($getUserDet->num_rows() > 0) {
                            $getRefId = $this->db->query("SELECT * FROM tbl_users where ref_code = '" . $requestParams['referralCode'] . "' ");
                            $refId = $getRefId->result();
                            $referUserId = $refId[0]->id;
                            if ($referUserId != $requestParams['userId']) {
                                $CheckUser = $this->db->query("SELECT * FROM tbl_users where id = '" . $referUserId . "'");
                                if ($CheckUser->num_rows() > 0) {
                                    $check_history = $this->db->query("SELECT * FROM tbl_referal_history where refrer = '" . $referUserId . "' AND refer_user = '" . $requestParams['userId'] . "'");
                                    if ($check_history->num_rows() == 0) {
                                        $checkdevice = $this->db->query("SELECT * FROM tbl_referal_history where refer_user = '" . $requestParams['userId'] . "' AND device_id = '" . $requestParams['deviceId'] . "'");
                                        if ($checkdevice->num_rows() == 0) {
                                            $c_values = array(
                                                'user_id' => $referUserId,
                                                'credit_amt' => 1500,
                                                'transaction_type' => 'C',
                                                'remark' => 'Refer to someone',
                                                'dated' => date('Y-m-d H:i:s')
                                            );
                                            $this->db->insert('tbl_user_credits', $c_values);
                                            $nc_values = array(
                                                'user_id' => $requestParams['userId'],
                                                'credit_amt' => 1500,
                                                'transaction_type' => 'C',
                                                'remark' => 'Refer by someone',
                                                'dated' => date('Y-m-d H:i:s')
                                            );
                                            $this->db->insert('tbl_user_credits', $nc_values);
                                            $this->db->query("INSERT INTO tbl_referal_history SET credit=1500, refrer='" . $referUserId . "',refer_user='" . $requestParams['userId'] . "', device_id='" . $requestParams['deviceId'] . "', dated=NOW()");
                                            $this->db->query("INSERT INTO tbl_referal_history SET credit=1500, refrer='" . $requestParams['userId'] . "',refer_user='" . $referUserId . "', device_id='referrer', dated=NOW()");
                                            $new_user_info = $this->db->query("SELECT sum(IF(`transaction_type`='C', `credit_amt`, 0))-sum(IF(`transaction_type`='D', `credit_amt`, 0)) 
                                            AS `total_points`
                                            FROM `tbl_user_credits` 
                                            WHERE 1
                                            AND `user_id` = '" . $requestParams['userId'] . "'
                                            ");
                                            $new_user_wallet = $new_user_info->row();
                                            $referer_info = $this->db->query("SELECT sum(IF(`transaction_type`='C', `credit_amt`, 0))-sum(IF(`transaction_type`='D', `credit_amt`, 0)) 
                                            AS `total_points`
                                            FROM `tbl_user_credits` 
                                            WHERE 1
                                            AND `user_id` = '" . $referUserId . "'
                                            ");
                                            $referer_wallet = $referer_info->row();
                                            $offer = [
                                                'status' => 'true',
                                                'success' => 'Your wallet is updated',
                                                'notification_title' => 'Wallet Updated',
                                                'notification_message' => 'You earned credit 1500 as your friend used you referral code.',
                                                'wallet_amt' => $referer_wallet->total_points,
                                            ];
                                            //$this->sendWalletNotifiacation($referer_wallet->device_id, "Congratulations! you just Earned 5 Monsters", $offer);
                                            $result['status'] = 'true';
                                            $result['userId'] = $requestParams['userId'];
                                            $result['wallet_amt'] = $new_user_wallet->total_points;
                                            $result['success'] = 'Wallet is Update';
                                            echo json_encode($result);
                                            exit;
                                        } else {
                                            $result['status'] = 'false';
                                            $result['error'] = 'Your device already got the Bonus';
                                            echo json_encode($result);
                                            exit;
                                        }
                                    } else {
                                        $result['status'] = 'false';
                                        $result['userId'] = $requestParams['userId'];
                                        $result['error'] = 'You already get Referral Bonus';
                                        echo json_encode($result);
                                        exit;
                                    }
                                } else {
                                    $result['status'] = 'false';
                                    //$result['userId'] = $requestParams['userId'];
                                    $result['error'] = 'Incorrect Referral Code';
                                    echo json_encode($result);
                                    exit;
                                }
                            } else {
                                $result['status'] = 'false';
                                $result['error'] = 'You cannot put your own invite code';
                                echo json_encode($result);
                                exit;
                            }
                        } else {
                            $result['status'] = 'false';
                            $result['error'] = 'User Id Not found';
                        }
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of user id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'guide_blog_upload') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['guideId']) && !empty($requestParams['title']) && !empty($requestParams['content'])) {
                        $values = array(
                            'title' => $requestParams['title'],
                            'content' => $requestParams['content'],
                            'tags' => $requestParams['tags'],
                            'gid' => $requestParams['guideId'],
                            'c_date' => date('Y-m-d H:i:s'),
                            'status' => 'I'
                        );
                        $query = $this->db->insert('tbl_blog', $values);
                        $last_id = $this->db->insert_id();

                        $result['status'] = 'true';
                        //$result['userId'] = (string) $requestParams['guideId'];
                        $result['success'] = 'Added successful.';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of Email, Type, IMEI, Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_token') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['userId']) && !empty($requestParams['regToken'])) {
                        $values = array(
                            'fcm_token' => $requestParams['regToken']
                        );
                        $this->db->update('tbl_users', $values, "id =" . $requestParams['userId']);
                        //$last_id = $this->db->insert_id() ;

                        $result['status'] = 'true';
                        //$result['userId'] = (string) $requestParams['guideId'];
                        $result['success'] = 'Added successful.';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of User Id or Device Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'send_message') {
                $result = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['senderId']) && !empty($requestParams['receiverId']) && !empty($requestParams['message'])) {
                        $query = $this->db->get_where('tbl_users', array('id' => $requestParams['senderId']));
                        $user_data = $query->row();
                        
                        $query = $this->db->get_where('tbl_userprofile', array('user_id' => $requestParams['senderId']));
                        $user_data1 = $query->row();
                        
                        $image=base_url() . '/include/images/user_imgs/' . $requestParams['senderId'] . '/' . $user_data1->pic;

                        $msg = array(
                            'body' => $requestParams['message'],
                            'title' => $user_data->user_name,
                            'sender_id' => $requestParams['senderId'],
                            'pic' => $image,
                            'vibrate' => 1,
                            'sound' => 1,
                            'type' => '2'
                        );
                        
                        $query = $this->db->get_where('tbl_users', array('id' => $requestParams['receiverId']));
                        $user_data2 = $query->row();

                        $result['api_response'] = $this->sendMessage($msg, $user_data2->fcm_token);

                        //var_dump($api_result);
                        //die;
                        $values = array(
                            'sender_id' => $requestParams['senderId'],
                            'receiver_id' => $requestParams['receiverId'],
                            'message' => $requestParams['message']
                        );

                        $query = $this->db->insert('tbl_chat_messages', $values);
                        //$last_id = $this->db->insert_id() ;

                        $result['status'] = 'true';
                        //$result['userId'] = (string) $requestParams['guideId'];
                        $result['success'] = 'Message Send successful.';
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of User Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'get_messages') {
                $result['payload']['messages'] = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['senderId']) && !empty($requestParams['receiverId'])) {
                        $send = $this->db->query("SELECT * FROM tbl_chat_messages WHERE (sender_id = '" . $requestParams['senderId'] . "' AND receiver_id = '" . $requestParams['receiverId'] . "') OR (sender_id = '" . $requestParams['receiverId'] . "' AND receiver_id = '" . $requestParams['senderId'] . "')  order by date_time");


                        if (($send->num_rows() > 0)) {
                            if ($send->num_rows() > 0) {
                                $msgs = $send->result();
                                foreach ($msgs as $msg) {
                                    array_push($result['payload']['messages'], ['senderId' => $msg->sender_id, 'receiverId' => $msg->receiver_id, 'message' => $msg->message, 'date_time' => $msg->date_time]);
                                }
                            }
                            $result['success'] = 'Messages are fetched.';
                        } else {
                            $result['success'] = 'No Message Found.';
                        }
                        $result['status'] = 'true';
                        //$result['userId'] = (string) $requestParams['guideId'];
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of User Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            } else if ($requestName == 'chat_history') {
                $result['payload']['history'] = array();
                if (!empty($this->input->post())) {
                    $requestParams = !empty($this->input->post('json_decode')) ? $this->input->post('json_decode') : $this->input->post();
                    if (!empty($requestParams['senderId'])) {
                        $query = $this->db->query("SELECT tbl_chat_messages.*,u.user_name,up.pic FROM tbl_chat_messages
INNER JOIN tbl_users u ON u.id=tbl_chat_messages.receiver_id
INNER JOIN tbl_userprofile up ON up.user_id=tbl_chat_messages.receiver_id WHERE tbl_chat_messages.sender_id='" . $requestParams['senderId'] . "' GROUP BY tbl_chat_messages.receiver_id ORDER BY tbl_chat_messages.id DESC");

                        if ($query->num_rows() > 0) {
                            $histories = $query->result();
                            foreach ($histories as $history) {
                                
                                $image=base_url() . '/include/images/user_imgs/' . $history->receiver_id . '/' . $history->pic;

                                array_push($result['payload']['history'], ['name' => $history->user_name, 'message' => $history->message,'time' => $history->date_time,'receiverId' => $history->receiver_id,'pic' => $image]);
                            }
                            $result['success'] = 'Messages history are fetched.';
                        } else {
                            $result['success'] = 'No History Found.';
                        }
                        $result['status'] = 'true';
                        //$result['userId'] = (string) $requestParams['guideId'];
                    } else {
                        $result['status'] = 'false';
                        $result['error'] = 'One or more out of User Id is missing';
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $result['status'] = 400;
                    $result['error'] = 'Request Type must be POST only';
                    echo json_encode($result);
                }
                exit;
            }
        }
    }

    public function refralcode($length) {
        $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'y', 'z');
        $numeric = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $pass = array();
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0) {
                $pass[] = $numeric[rand(0, 9)];
            } else {
                $pass[] = $alphabet[rand(0, 24)];
            }
        }

        return implode($pass);
    }

    public function decryptStringArray($stringArray, $key = "HIGHMOUNTAIN") {
        $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));
        return $s;
    }

    public function encryptStringArray($stringArray, $key = "HIGHMOUNTAIN") {
        $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
        return $s;
    }

    public function sendWalletNotifiacation($registration_id, $message = 'This is one of bulk notification', $offerAr) {
        $googleApiKey = 'AIzaSyBMjheA3VSszhV6jzkwukph0NhXkCSyG0U';
        $registrationIds = array($registration_id);
        $msg = array(
            'message' => $message,
            'title' => 'Got MCOIN',
            'subtitle' => 'We deliver service where you stand',
            'tickerText' => 'Ticker text here',
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon',
            'vibrate' => 1,
            'sound' => 1,
            'type' => '2'
        );
        if (!empty($offerAr)) {
            $msg['type'] = '2';
            $msg['data'] = json_encode($offerAr);
        }
        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => $msg
        );
        $headers = array(
            'Authorization: key=' . $googleApiKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function sendMessage($data, $target) {
        //FCM api URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAApShB36c:APA91bFrwPPQDU3ew6qR-ohg5gTdzK-s3jvNfegonifNP7_8LP-B5uQtWCzJFGizp0i9c0QVjGxSxd6fwr3o4uw7j1D_sOa8LNSMA4MJY8h1ro__vBW7EdvtPwu0WtDj0uWOp_-CX6fO';

        $fields = array();
        $fields['data'] = $data;
        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}
