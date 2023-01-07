<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
 
	function __construct()
	{		
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		} 
		if($this->session->userdata('access')->user==0)
		{
			redirect('admin/dashboard');
		}
		$this->load->library("pagination");
	}

	
	public function index()
	{
		$config = array();
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul><!--pagination-->';
		
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>'; 

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
			
		if(!empty($this->input->post('name')))
		{
			$name=$this->input->post('name');
			$data['name']= $name;
			$users=$this->db->query("SELECT * FROM tbl_client WHERE `client_name` LIKE '%".$name."%' OR `mobile` LIKE '%".$name."%' OR `email` LIKE '%".$name."%' ORDER BY id DESC");
			
			$config = array();
			$config["base_url"] = base_url() . "admin/user/index";
			$config["total_rows"] = $users->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;	
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$users=$this->db->query("SELECT * FROM tbl_client WHERE `client_name` LIKE '%".$name."%' OR `mobile` LIKE '%".$name."%' OR `email` LIKE '%".$name."%' ORDER BY id DESC  limit {$config['per_page']} offset {$page}");
			$data['users']= $users->result();
			 $query=$this->db->query("SELECT * FROM tbl_agency   ");
			    $data['agencydata']=$query->result();
		}
		else
		{
			$users = $this->db->query("SELECT * FROM tbl_client order by id desc" );
			
			$config["base_url"] = base_url() . "admin/user/index";
			$config["total_rows"] = $users->num_rows();
			$config["per_page"] = 20;
			$config["uri_segment"] = 4;
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
			$users=$this->db->query("SELECT * FROM tbl_client ORDER BY id DESC limit {$config['per_page']} offset {$page}");
			
			$data['users']= $users->result();
			 $query=$this->db->query("SELECT * FROM tbl_agency   ");
			    $data['agencydata']=$query->result();
		}
				
		$data["links"] = $this->pagination->create_links();
		$data['per_page'] = 20;      
		$data['offset'] = $page ;
		$data["total_rows"] = $users->num_rows();
		$data["curr_page"] = $this->pagination->cur_page ; 
		$data['curr_index']=$this->uri->segment(4);
        
        $users = $this->db->query("SELECT * FROM tbl_client order by id desc" );
        $data["total_rows"] = $users->num_rows();
        
		$this->load->view('admin/header');
		$this->load->view('admin/user_list',$data);
		$this->load->view('admin/footer');
	}
	
	
	public function get_username()
    {
        $name=$this->input->post('name');
        //$gid=$this->input->post('group');
      	//$newspaper = $this->db->query("SELECT * from tbl_newspapers WHERE name='".$name."' AND g_id='".$gid."'");
        $newspaper = $this->db->query("SELECT * from tbl_client WHERE user_name='".$name."'");
        if($newspaper->num_rows())
        {
            echo "Y";
        }
        else
        {
            echo "N";
        }
           
    }
    public function get_clientname()
    {
        $name=$this->input->post('name');
        //$gid=$this->input->post('group');
      	//$newspaper = $this->db->query("SELECT * from tbl_newspapers WHERE name='".$name."' AND g_id='".$gid."'");
        $newspaper = $this->db->query("SELECT * from tbl_client WHERE client_name='".$name."'");
        if($newspaper->num_rows())
        {
            echo "Y";
        }
        else
        {
            echo "N";
        }
           
    }
	
	
	public function add()
	{
		if (!empty($this->input->post()))
		{
			//echo '<pre>'; var_dump($_POST); die;
			$this->form_validation->set_rules('name', 'Name', 'required|is_unique[tbl_client.client_name]');
			$this->form_validation->set_rules('uname', 'User Name', 'required|is_unique[tbl_client.user_name]');
			
		//	$this->form_validation->set_rules('mobile', 'Mobile No.', 'max_length[10]|min_length[10]|xss_clean|
//callback_isphoneExist');
			//$this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
			//$this->form_validation->set_rules('c_pass', 'Password Confirmation', 'required|matches[pass]');
			//$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
			if ($this->form_validation->run() == FALSE)
			{
				$users=$this->db->query("SELECT id,client_name FROM tbl_client WHERE `group_head`= '1'");
				$data['users']= $users->result();
				
				$query=$this->db->query("SELECT id,client_name FROM tbl_client WHERE `agency`= '1'");
				$data['agency']= $query->result();
				
//				$query = $this->db->get_where('states', array('country_id' => 101));			
				$data['states']= $query->result();
				
			    $query=$this->db->query("SELECT * FROM tbl_agency");
			    $data['agencydata']=$query->result();
				
				$this->load->view('admin/header');
				$this->load->view('admin/add_user',$data);
				$this->load->view('admin/footer');
			}
			else
			{
			    $agencyid=$this->input->post('agency_id[]');
			     $agency_id=implode( ",", $agencyid );
			  
			    $query=$this->db->query("SELECT * FROM tbl_agency   ");
			    $data['agencydata']=$query->result();
				$ct=($this->input->post('ct') == 'on') ? 'I' : 'D';
//$agencyid=($ct=='I')?$this->input->post('agency_id'):0;

				$pass=$this->generatePassword();
				if($ct == 'I')
				{$agency_id1 = $agency_id;}
				else
				{
				    $agency_id1=0;
				}
				
				$values = array(
								'client_name'=>$this->input->post('name'),
								'user_name'=>$this->input->post('uname'),
								'passcode'=>password_hash($pass, PASSWORD_DEFAULT),
								'pin_code' =>$this->input->post('pin'),
								'fax' =>$this->input->post('fax'),
								'discount' =>$this->input->post('dis'),
								'contact_person' =>$this->input->post('cp'),
								'website' =>$this->input->post('website'),
								'opening_bal' =>$this->input->post('ob'),
								'account' =>$this->input->post('acc'),
								'credit_period' =>$this->input->post('cp'),
								'credit_limit' =>$this->input->post('cl'),
								'client_type' =>($this->input->post('ct') == 'on') ? 'I' : 'D',
								'agency'=>($this->input->post('agency') == 'on') ? '1' : '0',
								'agency_id'=>$agency_id1,
								'group_head' =>($this->input->post('gh') == 'on') ? '1' : '0',
								'shared' =>($this->input->post('sbp') == 'on') ? '1' : '0',
								'c_date'=>date('Y-m-d H:i:s')
							   );
				
					$query = $this-> db->insert('tbl_client', $values);
			//	echo $this->input->post('agency_id');
			//	echo $this->db->last_query(); die;
					$uid=$this->db->insert_id();
				
						if($this->input->post('agency') == 'on'){
					       
					        $values1= array(
                                    'client_id'=>$uid,
                                    'agency_name'=> $this->input->post('name')
                                    );
                        $query=$this->db->insert('tbl_agency',$values1);
                        
					    $agencyid=$this->db->insert_id();
					   $query=$this->db->query("update table tbl_client set agency_id='".$agencyid."' where id='".$uid."' ");
					}
				
					
                    
                        
                        
					$values=array(
					    
						"group_id"=>2,
						"ledger_name"=>$this->input->post('name'),
						"opening_balance"=>$this->input->post('ob'),
						"ob_type"=>"debit",
						"editable"=>"yes",
						"master_id"=>$uid,
						"is_deleted"=>"no"
					);
					$query=$this->db->insert('tbl_ledgers',$values);
//echo $this->db->last_query();

					for($i=0;$i<count($_POST['state']); $i++){
						// $gst[]=$_POST['address'][$i]."|-|".$_POST['state'][$i]."|-|".$_POST['gst'][$i];
						$values = array(
						'uid'=>$uid,
						'email' =>$this->input->post('email')[$i],
						'contact' =>$this->input->post('contact')[$i],
						'address' =>$this->input->post('address')[$i],
						'state' =>$this->input->post('state')[$i],
						'city' =>$this->input->post('city')[$i],
						'gst_no' =>$this->input->post('gst_no')[$i],
					);
					$query = $this->db->insert('tbl_client_details', $values);
					//echo $this->db->last_query(); die;
					}
					
					$sb=($this->input->post('sbp') == 'on') ? '1' : '0';
					if($sb=='1')
					{
						$s_party=$this->input->post('s_party[]');
						foreach($s_party as $party)
						{
							$values = array(
								'client_id'=>$u_id,
								'group_head' =>$party,
								'c_date'=>date('Y-m-d H:i:s')
								);
							$this-> db->insert('tbl_shared_bill_party', $values);
						
						}
					}


					$mobile=$this->input->post('mobile');
					$sms="Dear, ".$this->input->post('name')." Your Profile has been Created successfully on www.amsonsgroup.com and Your username is (" .$values['user_name']. ") and password is (".$pass."). Now you will use your account.";

					$r=$this->sendSmsApi($mobile,$sms);

					
					$this->session->set_flashdata('msg', 'Client Add.');
					redirect('admin/user');
			}				
		}
		else
		{
			$users=$this->db->query("SELECT id,client_name FROM tbl_client WHERE `group_head`= '1'");
			$data['users']= $users->result();
			
			$query=$this->db->query("SELECT id,client_name FROM tbl_client WHERE `agency`= '1'");
			$data['agency']= $query->result(); 
			
			$query = $this->db->get_where('states');
			$data['states']= $query->result();
			
			$query=$this->db->query("SELECT * FROM tbl_agency");
			$data['agencydata']=$query->result();
				
		
			$this->load->view('admin/header');
			$this->load->view('admin/add_user',$data);
			$this->load->view('admin/footer');
		}
	}
	public function get_city()
	{
	    
        //$_POST['state']=13;
		$query = $this->db->get_where('tbl_cities', array('state_id' => $this->input->post('state')));				
	    $cities= $query->result();
		echo json_encode($cities);
	}
	
	public function edit($id)
	{
		if (!empty($this->input->post()))
		{
			//echo "<pre>"; var_dump($_POST); die;
			//$this->form_validation->set_rules('name', 'Name', 'required');
			//$this->form_validation->set_rules('mobile', 'Mobile No.', 'required');
			//$this->form_validation->set_rules('email', 'E-mail', 'required');			
			// if ($this->form_validation->run() == FALSE)
			// {
			// 	$user = $this->db->get_where('tbl_client', array('id' => $id));
			// 	$u=$user->result();
			// 	$data['user']=$u[0];
				
			// 	$query = $this->db->get_where('states', array('country_id' => 101));			
			// 	$data['states']= $query->result();
				
			// 	$this->load->view('admin/header');
			// 	$this->load->view('admin/edit_user',$data);
			// 	$this->load->view('admin/footer');
			// }
			// else
			// {
			 $query=$this->db->query("SELECT * FROM tbl_agency   ");
			    $data['agencydata']=$query->result();
				$values = array(
					'id'=>$this->input->post('user_id'),
					'client_name'=>$this->input->post('name'),
					// 'mobile'=>$this->input->post('mobile'),
					// 'email'=>$this->input->post('email'),
					// 'address'=>$this->input->post('address'),
					// 'city'=>$this->input->post('city'),
					// 'state'=>$this->input->post('state'),
					//'pin_code' =>$this->input->post('pin'),
					'fax' =>$this->input->post('fax'),
					//'vat_no' =>$this->input->post('vat'),
					//'cst_no' =>$this->input->post('cst'),
					'discount' =>$this->input->post('dis'),
					//'ser_tax_no' =>$this->input->post('stn'),
					//'tin_no' =>$this->input->post('tin'),
					//'it_no' =>$this->input->post('itn'),
					'contact_person' =>$this->input->post('cp'),
					'website' =>$this->input->post('website'),
					'opening_bal' =>$this->input->post('ob'),
					'account' =>$this->input->post('acc'),
					'credit_period' =>$this->input->post('cp'),
					'credit_limit' =>$this->input->post('cl'),
					'client_type' =>$this->input->post('ct'),
					'group_head' =>($this->input->post('gh') == 'on') ? '1' : '0',
					'shared' =>($this->input->post('sbp') == 'on') ? '1' : '0'
					);
					$this->db->update('tbl_client',$values, "id =".$id);	
					for($i=0;$i<count($_POST['state']); $i++){
						// $gst[]=$_POST['address'][$i]."|-|".$_POST['state'][$i]."|-|".$_POST['gst'][$i];
						$values = array(
						'uid'=>$this->input->post('user_id'),
						'email' =>$this->input->post('email')[$i],
						'contact' =>$this->input->post('contact')[$i],
						'address' =>$this->input->post('address')[$i],
						'state' =>$this->input->post('state')[$i],
						'city' =>$this->input->post('city')[$i],
						'gst_no' =>$this->input->post('gst_no')[$i],
					);
					$query = $this->db->update('tbl_client_details', $values, "id =".$this->input->post('id')[$i]);
					if($this->input->post('id')[$i]==0){
						$query = $this->db->insert('tbl_client_details', $values);
					}
					$sb=($this->input->post('sbp') == 'on') ? '1' : '0';
					if($sb=='1')
					{
						$s_party=$this->input->post('s_party[]');
						foreach($s_party as $party)
						{
							$values = array(
								'client_id'=>$this->input->post('user_id'),
								'group_head' =>$party,
								'c_date'=>date('Y-m-d H:i:s')
								);
							$this-> db->insert('tbl_shared_bill_party', $values);
							
						}
					}

					//echo $this->db->last_query(); die;
					}
					$this->session->set_flashdata('msg', 'Record updated.');

					redirect('admin/user');
			// } 
				
		}
		else
		{
			$user=$this->db->get_where('tbl_client', array('id' => $id));
			$u=$user->result();
			$data['user']=$u[0];
        	$users=$this->db->query("SELECT id,client_name FROM tbl_client WHERE `group_head`= '1' ");
        
			$data['users']= $users->result();
			$user = $this->db->get_where('tbl_client_details', array('uid' => $id));
			$data['client_details']=$user->result();
			$shared=$this->db->get_where('tbl_shared_bill_party', array('client_id' => $id));
			$data['share_party']=$shared->result();
			$states=array();
			foreach($data['client_details'] as $row){
				$user=$this->db->get_where('states', array('name' => $row->state));
				$result=$user->row();
				$states[]=$result->id;
			}
			$data['cities']=array();
			$c=1;
			foreach($states as $value){
				$query = $this->db->get_where('tbl_cities', array('state_id' => $value));
				$data['cities'][$c]=$query->result();
				$c++;
			}
			

			
			//echo '<pre>'; var_dump($data['cities']); die;

			$query = $this->db->get_where('states');				
			$data['states']= $query->result();
				
			$this->load->view('admin/header');
			$this->load->view('admin/edit_user',$data);
			$this->load->view('admin/footer');		
		}
	}
	
	public function del($id)
	{
		if($this->db->delete("tbl_client","id=".$id))
		{
			$this->session->set_flashdata('msg', 'Client Delete Successfully.');
			redirect('admin/user');
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Client not Delete Successfully.');
			redirect('admin/user');
		}
	}
	
	public function info($id)
	{
		$user = $this->db->get_where('tbl_client', array('id' => $id));
			$u=$user->result();
			$data['user']=$u[0];
				
			$this->load->view('admin/header');
			$this->load->view('admin/user_info',$data);
			$this->load->view('admin/footer');
	}


	function sendSmsApi($mobile,$sms)
	{
            //Your authentication key
            //$authKey = "128895A8QgwvwyPgK5808a994";
            $authKey = "145922AQOoNLQedm59422ed6";
			
            //Multiple mobiles numbers separated by comma
            $mobileNumber = $mobile;

            //Sender ID,While using route4 sender id should be 6 characters long.
            $senderId = "AMSONS";

            //Your message to send, Add URL encoding here.
            $message = $sms;

            //Define route 
            $route = "1";
            //Prepare you post parameters
            $postData = array(
                'authkey' => $authKey,
                'mobiles' => $mobileNumber,
                'message' => $message,
                'sender' => $senderId,
                'route' => $route
            );

            //API URL
            $url="http://sms.rpsms.in/api/sendhttp.php";

            // init the resource
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postData
                //,CURLOPT_FOLLOWLOCATION => true
            ));


            //Ignore SSL certificate verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


            //get response
            $output = curl_exec($ch);

            //Print error if any
            if(curl_errno($ch))
            {
                $output='error:' . curl_error($ch);
				curl_close($ch);
				return  $output;
            }

            curl_close($ch);

           return  $output;
    }


    public function generatePassword($length = 8) 
    {
        $possibleChars = "abcdefghijklmnopqrstuvwxyz123456789";
        $password = '';

        for($i = 0; $i < $length; $i++) {
            $rand = rand(0, strlen($possibleChars) - 1);
            $password .= substr($possibleChars, $rand, 1);
        }

        return $password;
    }

}
?>