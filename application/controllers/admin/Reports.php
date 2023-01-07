<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{
 
	function __construct()
	{
		parent::__construct();
		if(!isset($this->session->userdata['admin'])){
			redirect('admin/login');
		} 
		if($this->session->userdata('access')->admin==0)
		{
			redirect('admin/dashboard');
		}
	}

	public function index()
	{
$query = $this->db->get('tbl_news_group');
			$data['publications']= $query->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/ro_report',$data);
		$this->load->view('admin/footer');
	}
	
	
	public function get()
	{
$query = $this->db->get('tbl_news_group');
			$data['publications']= $query->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/get_ro_report',$data);
		$this->load->view('admin/footer');
	}
	
	
		public function cash_report()
	{
$query = $this->db->where('group_id',2)->get('tbl_ledgers');
			$data['publications']= $query->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/cash_report',$data);
		$this->load->view('admin/footer');
	}
	public function add()
	{
		if (!empty($this->input->post()))
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile No.', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required');
			$this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('c_pass', 'Password Confirmation', 'required|matches[pass]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_admin.email]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/header');
				$this->load->view('admin/add_admin');//,$data);
				$this->load->view('admin/footer');
			}
			else
			{				
				$values = array(
								'name'=>$this->input->post('name'),
								'mobile'=>$this->input->post('mobile'),
								'email'=>$this->input->post('email'),
								'pass'=>password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
								'address'=>$this->input->post('address'),
								'status'=>($this->input->post('status') == 'on') ? 'A' : 'I',
								'c_date'=>date('Y-m-d H:i:s')
							   );
							   
					$query = $this-> db->insert('tbl_admin', $values);
					$insert_id = $this->db->insert_id();
					$this-> db->insert('tbl_admin_access', array(
							'a_id'=>$insert_id));
					
					$this->session->set_flashdata('msg', 'Sub Admin Add.');
					redirect('admin/sub_admin');
			}				
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/add_admin');//,$data);
			$this->load->view('admin/footer');
		}

	}
	
	
	public function edit($id)
	{
		if (!empty($this->input->post()))
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile No.', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required');			
			if ($this->form_validation->run() == FALSE)
			{
				$admins = $this->db->get_where('tbl_admin', array('id' => $id));
				$a=$admins->result();
				$data['admin']=$a[0];
				
				$this->load->view('admin/header');
				$this->load->view('admin/edit_admin',$data);
				$this->load->view('admin/footer');
			}
			else
			{
				$values = array(
								'name'=>$this->input->post('name'),
								'mobile'=>$this->input->post('mobile'),
								'email'=>$this->input->post('email'),
								'address'=>$this->input->post('address'),
								'status'=>($this->input->post('status') == 'on') ? 'A' : 'I'
							   );
					$this->db->update('tbl_admin',$values, "id =".$id);	
					
					$this->session->set_flashdata('msg', 'Sub Admin update.');

					redirect('admin/sub_admin');				
				
			} 
				
		}
		else
		{
			$admins = $this->db->get_where('tbl_admin', array('id' => $id));
			$a=$admins->result();
			$data['admin']=$a[0];
				
			$this->load->view('admin/header');
			$this->load->view('admin/edit_admin',$data);
			$this->load->view('admin/footer');		
		}
	}
	 
	 public function get_ro_report()
	 {
	     $gid=$this->input->post('newspaper_id');
	     $state=$this->input->post('state');
	     $from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
	     $to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
	  
	        $query="select s.ro_no,s.book_date,x.ng_name,y.client_name,v.name,t.dop,t.bill_number,t.bill_amount, t.newspaper_bill_no,t.dop_amount  as price,t.newspaper_billed_amount as eprice from tbl_book_ads s  
left JOIN tbl_client y on y.id=s.u_id INNER JOIN tbl_news_group x on x.ng_id=s.ngb_id 
left join tbl_ro_dop t on t.ro_id=s.id  

left join tbl_paper_city u on u.id=t.paper_id 
left join tbl_newspapers v on v.id=u.paper_id   
left join tbl_publication_bill pd on pd.bill_no=t.newspaper_bill_no where  s.ngb_id='".$gid."'  and s.book_date >= '$from_date' and s.book_date<='$to_date'   ";
	     $sqlResult=$this->db->query($query);
	     $report=$sqlResult->result();
	     echo json_encode($report);
	 }
	 
	 
	  public function cash_report_ajax()
	 {
	     $gid=$this->input->post('client_id');
	     $state=$this->input->post('state');
	     $from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
	     $to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
	  
	      $query="SELECT * FROM `tbl_vouchers` where (screen ='Cash Bill' || screen ='Client Bill') and 
  ledger_id='".$gid."'  and voucher_date >= '$from_date' and voucher_date<='$to_date'";
	     $sqlResult=$this->db->query($query);
	     $report=$sqlResult->result();
	     if($report){
	     foreach($report as $key=>$s){
	           $report[$key]->debit = 0;  
	           $report[$key]->credit = 0;  
	            $report[$key]->date = $s->voucher_date;  
	          
	         if($s->entry_type=='dr'){
	             
	           $report[$key]->debit = $s->amount;  
	         } else {
	           $report[$key]->credit = $s->amount;
	             
	             
	         }
	     }
	         
	     }
	     echo json_encode($report);
	 }
	 
	 
	 public function get2_ro_report()
	 {
	     $gid=$this->input->post('newspaper_id');
	     $from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
	     $to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
	  
	      $query="SELECT tbl_publication_bill.*,tbl_payments.Amount as paid FROM `tbl_publication_bill` inner join tbl_payments on tbl_payments.ClinetId=tbl_publication_bill.publication where  tbl_publication_bill.publication='".$gid."'  and tbl_publication_bill.dated >= '$from_date' and tbl_publication_bill.dated<='$to_date' ";
	     $sqlResult=$this->db->query($query);
	     $report=$sqlResult->result();
	     echo json_encode($report);
	 }
	public function del($id)
	{		
		
		if($this->db->delete("tbl_admin","id=".$id)&&$this->db->delete("tbl_admin_access","a_id=".$id))
		{
			$this->session->set_flashdata('msg', 'Admin Delete Successfully.');
			$this->index();
		}
		else
		{	
			$this->session->set_flashdata('msg', 'Admin not Delete Successfully.');
			$this->index();
		}
	}

	public function act($id)
	{
		
		$query = $this->db->get_where('tbl_admin', array('id' => $id));
		$row = $query->row();
		if($row->status=='A')
		{
			$this->db->update('tbl_admin',array('status' => 'I'), "id =".$id);
			$this->index();
		}
		else
		{
			$this->db->update('tbl_admin',array('status' => 'A'), "id =".$id);
			$this->index();
		}
	}
	
	public function access($id)
	{
		if (!empty($this->input->post()))
		{
			$values = array(
							'a_id'=>$id,
							'newspaper'=>($this->input->post('newspaper') == 'on') ? 1 : 0,
							'ads'=>($this->input->post('ads') == 'on') ? 1 : 0,
							'city'=>($this->input->post('city') == 'on') ? 1 : 0,
							'category'=>($this->input->post('category') == 'on') ? 1 : 0,
							'news_type'=>($this->input->post('news_type') == 'on') ? 1 : 0,
							'price'=>($this->input->post('price') == 'on') ? 1 : 0,
							'settings'=>($this->input->post('settings') == 'on') ? 1 : 0,
							'transaction'=>($this->input->post('transaction') == 'on') ? 1 : 0,
							'ro_booking'=>($this->input->post('ro_booking') == 'on') ? 1 : 0,
							'ro_entery'=>($this->input->post('ro_entery') == 'on') ? 1 : 0,
							'fm_ro'=>($this->input->post('fm_ro') == 'on') ? 1 : 0,
							'client_billing'=>($this->input->post('client_billing') == 'on') ? 1 : 0,
							'letters'=>($this->input->post('letters') == 'on') ? 1 : 0,
							'creat_m'=>($this->input->post('creat_m') == 'on') ? 1 : 0,
							'reports'=>($this->input->post('reports') == 'on') ? 1 : 0
						);
			
				$this->db->update('tbl_admin_access',$values, "a_id =".$id);
				
				$this->session->set_flashdata('msg', 'Changes Saved Successfully');
				
				redirect('admin/sub_admin');
			
		}
		else
		{
			$admins = $this->db->get_where('tbl_admin', array('id' => $id));
			$a=$admins->result();
			$data['admin']=$a[0];
			
			$access = $this->db->get_where('tbl_admin_access', array('a_id' => $id));
			$ac=$access->result();
			if(isset($ac[0]))
			$data['access']=$ac[0];
		
			$this->load->view('admin/header');
			$this->load->view('admin/access_admin',$data);
			$this->load->view('admin/footer');
		}
	}	
}
?>