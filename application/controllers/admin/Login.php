<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//if(!isset($this->session->userdata['admin'])){
			//redirect('admin/login');
		//}
	}

	public function index()
	{
		//echo "Hello";
        $this->load->model("site_model");
        $data['result']=$this->site_model->get_data("tbl_running_year",null,null,'asc',null,null,null,"id");
       // echo  var_dump($result); die;
		$this->load->view('admin/login',$data);
	}

	public function auth()
    {
        $_SESSION['work_year']=$_POST['work_year'];
        
		$this->form_validation->set_rules('login-email', 'Admin Email', 'trim|required|valid_email',array('required' => 'You must provide a %s.', 'alphanumeric'=>"Wrong %s "));
		$this->form_validation->set_rules('login-password', 'Password', 'trim|required|min_length[6]|max_length[25]');

		if($this->form_validation->run() == FALSE)
		{
			//die("reached");
			$this->index();
		}
		else
		{
			//echo "<pre>"; var_dump($_POST);
			//die("cant");
			$this->load->model('admin_model');
			$email=$this->input->post('login-email');
			$pass=$this->input->post('login-password');

			$result= $this->admin_model->get($email);
            //echo "<pre>"; var_dump($result); die;
			if(!empty($result))
			{
				if(password_verify ($pass,$result[0]->pass))
				{
                    if($result[0]->status=="I"){
                        redirect('login/inactive');
                    }
					$this->db->select('e_id,e_name');
					$query = $this->db->get_where('tbl_employee', array('user_id' => $result[0]->id));
					$emp= $query->row();
					$emp_id=(!(empty($emp)))? $emp->e_id:"0";
                    $query = $this->db->get_where('tbl_running_year', array('year' => $_POST['work_year']));
                    $work_year= $query->row();
                    $from=explode('-',$work_year->from_date);
                    $to=explode('-',$work_year->to_date);
                    $_SESSION['from']=$from[0];
                     $_SESSION['to']=$to[0];
                    //print_r($work_year); die;                           
					$session_data = array(
                        'work_year'=>$work_year->year,
                        'from_date'=>$work_year->from_date,
                        'to_date'=>$work_year->to_date,
                        'name' => $result[0]->name,
                        'email' => $result[0]->email,
                        'id' => $result[0]->id,
                        'emp_id'=>$emp_id,
                        'user_type' => 'admin',
                        'last_login'=> $result[0]->last_login,
                     );
					$access = $this->db->get_where('tbl_admin_access', array('a_id' => $result[0]->id));
					$ac=$access->result();

					$taxes=$this->db->get("tbl_tax")->result_array();

					//echo "<pre>"; var_dump($taxes); die;

					if(isset($ac[0]))
					$this->session->set_userdata('access', $ac[0]);
					$this->session->set_userdata('admin', $session_data);

					$data = array('last_login' =>date('Y-m-d H:i:s'));
					$this->db->where('id', $result[0]->id);
					//$this->db->update('tbl_users', $data);

					redirect('admin/work_year');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Wrong Password.');
					$this->load->model("site_model");
                    $data['result']=$this->site_model->get_data("tbl_running_year",null,null,'asc',null,null,null,"id");
                    //echo "<pre>"; var_dump($result); die;
                    $this->load->view('admin/login',$data);
				}
			}
			else
			{
				$this->session->set_flashdata('msg', 'Wrong Admin Email.');
				$this->load->model("site_model");
                $data['result']=$this->site_model->get_data("tbl_running_year",null,null,'asc',null,null,null,"id");
                    //echo "<pre>"; var_dump($result); die;
                    $this->load->view('admin/login',$data);
			}

		}

    }
}
?>