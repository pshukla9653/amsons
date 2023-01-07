<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vouchers extends CI_Controller
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
    
    public function index(){
        $this->load->model("site_model");
        $data['results']=$this->site_model->get_data("tbl_vouchers");
       		if(!empty($this->input->post("draw"))){
			$draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'voucher_no',
            1=>'group_id',
            2=>'ledger_id',
            3=>'voucher_date',
            4=>'entry_type',
            5=>'voucher_type',
            6=>'amount',
            7=>'narration'
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);
		

        $employees =    $this->db->select('tbl_vouchers.*')->from('tbl_vouchers')->get();
      
        $data = array();
        foreach($employees->result() as $rows)
        {

            $data[]= array(
                $rows->voucher_no,
                $rows->group_id,
                $rows->ledger_id,
                $rows->voucher_date,
                $rows->entry_type,
                
                $rows->voucher_type,
                $rows->amount,
                $rows->narration,
                
                '<div class="btn-group btn-group-xs">
									<a class="btn btn-default" title="" data-toggle="tooltip" href="vouchers/update/'.$rows->id.'" data-original-title="Print">
										<i class="fa fa-list"></i>
									</a>
									
								</div>' 
            );     
        }
        $total_employees = $this->totalEmployees();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
			
		} else { 
		$data = array();
		$this->load->view('admin/header');

		$this->load->view('admin/vouchers', $data);

		$this->load->view('admin/footer');		
		
		}

    } 
    	public function totalEmployees()
    {
        $query = $this->db->select("COUNT(*) as num")->get("tbl_vouchers");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    public function insert(){
        $this->load->model("site_model");
        if($_POST){
            //echo '<pre>'; var_dump($_POST);
            
            for($i=0; $i<count($_POST['ledger_id']); $i++){
                //echo "ledger_id: ".$_POST['ledger_id'][$i]."<br>";
                $result=$this->site_model->get_data("tbl_ledgers",['ledger_id'=>$_POST['ledger_id'][$i]],"group_id");
                //echo var_dump($result[0]['group_id']); 
                $values=array(
                    'group_id' => $result[0]['group_id'],
                    'ledger_id' => $_POST['ledger_id'][$i],
                    'voucher_date' => $this->input->post('voucher_date'),
                    'entry_type' => $_POST['entry_type'][$i],
                    'voucher_type' => $_POST['voucher_type'][$i],
                    'amount' =>  $_POST['amount'][$i],
                    'narration' => $this->input->post('narration'),
                    'voucher_no' => $this->input->post('voucher_no'),
                    //'voucher_session' => $this->input->post('voucher_session'),
                    //'screen' => $this->input->post('screen'),
                    //'screen_id' => $this->input->post('screen_id'),
                    'created_at' => date("Y-m-d H:i:s")
                );
                    $this->site_model->insert_data("tbl_vouchers",$values);     
            }
            redirect("admin/vouchers");
            //die;
            // $this->load->helper(array('form'));
            // $this->load->library('form_validation');
    
            // $this->form_validation->set_rules('group_id', 'Group id', 'trim|required');
            // $this->form_validation->set_rules('ledger_id', 'Ledger id', 'trim|required');
            // $this->form_validation->set_rules('voucher_date', 'Voucher date', 'trim|required');
            // $this->form_validation->set_rules('entry_type', 'Entry type', 'trim|required');
            // $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            // $this->form_validation->set_rules('narration', 'Narration', 'trim|required');
            // $this->form_validation->set_rules('voucher_no', 'Voucher no', 'trim|required');
            // $this->form_validation->set_rules('voucher_session', 'Voucher session', 'trim|required');
            // $this->form_validation->set_rules('screen', 'Screen', 'trim|required');
            // $this->form_validation->set_rules('screen_id', 'Screen id', 'trim|required');
            // $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
            // $this->form_validation->set_rules('modified_at', 'Modified at', 'trim|required');
            // $this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
    
            // //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64
            // if ($this->form_validation->run() == FALSE)
            // {
            //     $data['results']=$this->site_model->get_data("tbl_vouchers");
            //     //echo "<pre>"; var_dump($data['results']);
            //     $this->load->view("admin/header",$data);
            //     $this->load->view("admin/vouchers/insert");
            //     $this->load->view("admin/footer");
            // }
            // else
            // {
                // $this->site_model->insert_data("tbl_vouchers",array_filter($_POST));
                // echo $this->db->last_query(); die;
                // redirect("admin/vouchers");
           // } 
        } 
        else 
        { 
            $data['voucher_no']=$this->site_model->get_max("tbl_vouchers","voucher_no",['voucher_type'=>"cash_payment"])[0]['voucher_no'];
            //echo '<pre>'; var_dump($data); die;
            $data['ledger_results']=$this->site_model->get_data("tbl_ledgers");
            $this->load->view("admin/header",$data); 
            $this->load->view("admin/voucher_insert"); 
            $this->load->view("admin/footer");
        }
    }
    
    public function get_last_voucher_date(){
        $this->load->model("site_model");
        $voucher_type=$this->input->post('voucher_type');			
        $voucher_no=$this->site_model->get_max("tbl_vouchers","voucher_no",['voucher_type'=>$voucher_type])[0]['voucher_no'];
        if(!$voucher_no){
            $voucher_no=1;
        }else{
            $voucher_no++;
        }
        echo $voucher_no;
        return;
    }

    public function update($id){
        $this->load->model("site_model");
        if($_POST){
            $this->load->helper(array('form'));
            $this->load->library('form_validation');
    
            $this->form_validation->set_rules('group_id', 'Group id', 'trim|required');
            $this->form_validation->set_rules('ledger_id', 'Ledger id', 'trim|required');
            $this->form_validation->set_rules('voucher_date', 'Voucher date', 'trim|required');
            $this->form_validation->set_rules('entry_type', 'Entry type', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('narration', 'Narration', 'trim|required');
            $this->form_validation->set_rules('voucher_no', 'Voucher no', 'trim|required');
            $this->form_validation->set_rules('voucher_session', 'Voucher session', 'trim|required');
            $this->form_validation->set_rules('screen', 'Screen', 'trim|required');
            $this->form_validation->set_rules('screen_id', 'Screen id', 'trim|required');
            $this->form_validation->set_rules('created_at', 'Created at', 'trim|required');
            $this->form_validation->set_rules('modified_at', 'Modified at', 'trim|required');
            $this->form_validation->set_rules('is_deleted', 'Is deleted', 'trim|required');
    
            //Other validations: min_length[5]|max_length[12]|matches[password]|is_unique[table.field]|exact_length|greater_than_equal_to[8]|in_list[red,blue,green]|alpha_numeric|alpha_numeric_spaces|alpha_dash|numeric|integer|decimal|is_natural|is_natural_no_zero|valid_url|valid_base64
    
                if ($this->form_validation->run() == FALSE)
                {
                    $data['results']=$this->site_model->get_data("tbl_vouchers",['id'=>$id]);
                    //echo "<pre>"; var_dump($data['results']);
                    $this->load->view("admin/header",$data);
                    $this->load->view("admin/voucher_update");
                    $this->load->view("admin/footer");
                }
                else
                {
                    $id=$_POST['id'];
                    unset($_POST['id']);
                    $this->site_model->update_data("tbl_vouchers",array_filter($_POST),("id=".$id));
                    redirect(base_url("admin/vouchers")); 
            } 
        } 
        else 
        {
            //echo "here"; die;
            $data['results']=$this->site_model->get_data("tbl_vouchers",['id'=>$id]);
            //echo "<pre>"; var_dump($data['results']);
            $this->load->view("admin/header",$data); 
            $this->load->view("admin/voucher_update"); 
            $this->load->view("admin/footer");
        }
    }
    
    function get_ledgers(){
        //echo '<pre>'; var_dump($_POST); die;
        if (!empty($this->input->post())) 
		{	
			$this->form_validation->set_rules('entry_type', 'Entry type', 'required');
			$this->form_validation->set_rules('voucher_type', 'Voucher type', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$msg="1";
				echo $msg;
				return;
			}
			else
			{
				$entry_type=$this->input->post('entry_type');			
				$voucher_type=$this->input->post('voucher_type');			
				if($voucher_type=='contra' and $entry_type=='dr'){
                    $query = $this->db->query("SELECT * FROM tbl_ledgers WHERE ledger_name LIKE '%cash%' OR ledger_name LIKE '%bank%'");
                }else if($voucher_type=='cash_receipt' and $entry_type=='dr'){
                    $query = $this->db->query("SELECT * FROM tbl_ledgers WHERE ledger_name LIKE '%cash%'");
                }else if($voucher_type=='bank_receipt' and $entry_type=='dr'){
                    $query = $this->db->query("SELECT * FROM tbl_ledgers WHERE ledger_name LIKE '%bank%'");
                }
                
                else if($voucher_type=='contra' and $entry_type=='cr'){
                    $query = $this->db->query("SELECT * FROM tbl_ledgers WHERE ledger_name LIKE '%cash%' OR ledger_name LIKE '%bank%'");
                }else if($voucher_type=='cash_payment' and $entry_type=='cr'){
                    $query = $this->db->query("SELECT * FROM tbl_ledgers WHERE ledger_name LIKE '%cash%'");
                }else if($voucher_type=='bank_payment' and $entry_type=='cr'){
                    $query = $this->db->query("SELECT * FROM tbl_ledgers WHERE ledger_name LIKE '%bank%'");
                }
                
                else{
                    $query = $this->db->query("SELECT * FROM tbl_ledgers");
                }
				
				//echo $this->db->last_query(); return;
				$ros= $query->result();
				if(empty($ros))
				{
					$msg="2";
					echo $msg;
					return;
				}
				else
				{
					echo json_encode($ros);
					return;
				}
			}
		}
		else
		{
			$msg="1";
			echo $msg;
			return;
		}
    }
}
?>