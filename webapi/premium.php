<?php
 require "config.php";
$id          = $_REQUEST['id'];
$type_id     = $_REQUEST['type_id'];
$sqlLogin="select * from tbl_paper_city where id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin); 
     $count=mysqli_fetch_array($queryLogin);

  $sqlLogin1="select * from tbl_newspapers where id='".$count['paper_id']."'";
       $queryLogin1=mysqli_query($con,$sqlLogin1); 
     $count1=mysqli_fetch_array($queryLogin1);


 if(!empty($count1['g_id']))
 { 

  $sqlLogin2="SELECT * FROM `tbl_premimum` WHERE `g_id`='".$count1['g_id'] ."' and  `type_id`='".$type_id."' "; 
   
       $queryLogin2=mysqli_query($con,$sqlLogin2); 
  //   $count2=mysqli_fetch_array($queryLogin2);
   $counghfhcgt1 = mysqli_num_rows($queryLogin2);

    if($counghfhcgt1>0){

      while( $count2=mysqli_fetch_array($queryLogin2)){

               $data['id'] =  $count2['id']; 
               $data['p_type']=$count2['p_type'];
               $data['premimum']=$count2['premimum'];
       }
    }
    else
    {
    
     $data['id'] = "";
      $data['p_type']="";
       $data['premimum']="";
     
    
    
    }
     $json['data'][]=$data;  

}

   echo json_encode($json);
?>