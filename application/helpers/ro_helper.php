<?php 

if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('ro_no_gen')) 
{
  function ro_no_gen($ro_type) 
  {
	 //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database(); 
	
	$year=$ci->session->userdata('amsons_wy')['year'];
	
	$ci->db->order_by('id', 'DESC');
	$query = $ci->db->get('tbl_ro_no', 1);
	
	$ro=$query->row();
	if(empty($ro))
	{
		$ro_no=0001;
	}
	else
	{
		if($ro->year < $year)
		{
			$ro_no=0001;
		}
		else
		{
			$ro_no=$ro->ro_no +1;
		}
	}
	
    $values = array(
						'ro_no'=>$ro_no,
						'ro_type'=>$ro_type,
						'year'=>$year,
						'c_date'=> date('Y-m-d')
					);
				
			$ci-> db->insert('tbl_ro_no', $values);
			$in_id=$ci->db->insert_id();
				
    return $ro_no;
  }  
}


if(!function_exists('bill_no_gen')) 
{
  function bill_no_gen() 
  {
	//get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database(); 
	
//	$year=$ci->session->userdata('amsons_wy')['year'];
	
//	$ci->db->order_by('id', 'DESC');
//	$ci->db->where('wor_year',$year);
//$query = $ci->db->get('tbl_bill', 1);
	$query=$ci->db->query("select * from tbl_bill  where work_year='".$_SESSION['work_year']."' order by id DESC");
	$n=$query->num_rows();
	$bill_no=$query->row();
	
	
	if($n<1)
	{
		$b_no=1;
	}
	else
	{
/*	if($bill_no->work_year < $year)
		{
			$b_no=1;
		}
		else
		{*/
			$b_no=$bill_no->bill_no +1;
	//	}
	}
	
    return $b_no;
  }  
}


if(!function_exists('letter_no_gen')) 
{
  function letter_no_gen() 
  {
	//get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database(); 
	
	$year=$ci->session->userdata('amsons_wy')['year'];
	
	$ci->db->order_by('id', 'DESC');
	$query = $ci->db->get('tbl_letters', 1);
	
	$n=$query->num_rows();
	$letter_no=$query->row();
	
	
	if($n<1)
	{
		$l_no=1;
	}
	else
	{
		if($letter_no->work_year < $year)
		{
			$l_no=1;
		}
		else
		{
			$l_no=$letter_no->letter_no +1;
		}
	}
	
    return $l_no;
  }  
}

?>