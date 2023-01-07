<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Scripts extends CI_Controller
{
    //delete all existing bill and effect of existing bills into database than start bill numbers from 1
    public function make_all_unbilled(){
        //$this->db->truncate("tbl_ro_no");
        $this->db->truncate("tbl_bill");
        $this->db->truncate("tbl_bill_details");
        $this->load->model("site_model");
        $data=array(
            'bill_dop'=>'' 
        );
        $this->site_model->update_data("tbl_ro_dop",$data);
        $results=$this->site_model->get_data("tbl_book_ads");
        foreach($results as $row){
            $where=array(
                "id"=>$row['id']
            );
            $data=array(
                'publish_day'=>$row['insertion']
            );
            $this->site_model->update_data("tbl_book_ads",$data,$where);
            //echo "insertion: ".$row['insertion']."Pubilish_days: ".$row['publish_day']."<br>";
        }
        echo "Done";
    }
    public function set_newsgroup_address(){
        $this->load->model("site_model");
        $result=$this->site_model->get_data("tbl_news_group");
        foreach($result as $row){
            echo "<br>ng_id".$row['ng_id']."ng_email".$row['ng_email']."ng_address".$row['ng_address']."ng_state".$row['ng_state']."ng_city".$row['ng_city']."gst_no".$row['gst_no']."ng_phone".$row['ng_phone'];
            $values=array(
                'newsgroup_id'=>$row['ng_id'],
                "email"=>$row['ng_email'],
                "phone"=>$row['ng_phone'],
                "address"=>$row['ng_address'],
                "state"=>$row['ng_state'],
                "city"=>$row['ng_city'],
                "gst_no"=>$row['gst_no']   
            );
            $this->site_model->insert_data("tbl_news_group_details",$values);
        }
    }
    
    
    public function set_work_year_0_ro_dops(){
        $this->load->model("site_model");
        $result=$this->site_model->get_data("tbl_book_ads",['work_year'=>'0']);
        echo '<pre>'; var_dump($result); 
        foreach($result as $row){
            //echo "<br>Ro No:".$row['ro_no'];
            $result=$this->site_model->get_data("tbl_ro_dop_temp",['ro_no'=>$row['ro_no']]);
            foreach($result as $row1){
            unset($row1['id']);
            $row1['ro_id']=$row['id'];
            var_dump($row1);
            $this->site_model->insert_data("tbl_ro_dop",$result[0]);
            } 
        }
    }
    
    
    //ro script calculation
    public function set_all_ro_total(){
        $this->load->model("site_model");
        $result=$this->site_model->get_data("tbl_book_ads",['work_year'=>'3','ro_no'=>'702']);
        //echo '<pre>'; var_dump($result); 
        foreach($result as $row){
            echo "<br>Ro No:".$row['ro_no']."<br>Price:".$row['price']."<br>Ex price:".$row['ex_price']."<br>insertion:".$row['insertion'];
            echo ($row['price']+$row['ex_price'])/$row['insertion'];
            //$this->site_model->update('tbl_book_ads',);
//            $result=$this->site_model->get_data("tbl_ro_dop_temp",['ro_no'=>$row['ro_no']]);
//            foreach($result as $row1){
//            unset($row1['id']);
//            $row1['ro_id']=$row['id'];
//            var_dump($row1);
//            $this->site_model->insert_data("tbl_ro_dop",$result[0]);
//            } 
            
        }
    }
    
    //give table name where to apply new city ids and filed which filed have city id
    public function set_city_new_ids($table=null,$city_field=null){
        
        $this->load->model("site_model");
        $result=$this->site_model->get_data($table,null,$city_field.",id");
        //var_dump($result); die;
        foreach($result as $row){
            $existing_city_id=$row[$city_field]; 
            $existing_id=$row['id']; 
            //echo "<br>Existing city id is: ".$existing_city_id;
            $res=$this->site_model->get_data('temp_cities',['id'=>$existing_city_id],"new_city_id");
            $new_city_id=$res[0]['new_city_id'];
            //echo "<br>New city id is: ".$new_city_id;
            $update=array($city_field=>$new_city_id);
            $where=array($city_field=>$existing_city_id,"id"=>$existing_id);
            $this->site_model->update_data($table,$update,$where);
            //echo $this->db->last_query(); 
        }
        echo "Done, Please don't run again."; 
    }

    
    public function set_roid_in_rodop_table(){
        
        $this->load->model("site_model");
        $result=$this->site_model->get_data(tbl_book_ads,null,"id,ro_no,price,work_year");
        //echo "<pre>"; var_dump($result); //die; 
        $updated=0;
        foreach($result as $row){
            $ro_id=$row['id']; 
            $ro_no=$row['ro_no'];
             $work_year=$row['work_year'];
            
            echo "<br>Ro id: ".$ro_id;
            echo " / Ro no: ".$ro_no;
            echo "Work Year: ".$_SESSION['work_year']."<br>"; 
            $updated++;
//            $res=$this->site_model->get_data('temp_cities',['id'=>$existing_city_id],"new_city_id");
//            $new_city_id=$res[0]['new_city_id'];
//            //echo "<br>New city id is: ".$new_city_id;
//            $update=array('ro_id'=>$ro_id);
//           $where=array('work_year'=>$work_year,"ro_no"=>$ro_no);
//           $this->site_model->update_data('tbl_ro_dop',$update,$where);
            //echo $this->db->last_query()."<br>";
        } 
        echo $updated. " Done, Please don't run again."; 
    }

    
}