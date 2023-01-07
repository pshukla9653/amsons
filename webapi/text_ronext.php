<?php 
require "config.php";
$id=$_REQUEST['id'];
 $sqlLogin="select * from tbl_paper_city where id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin); 
     $count=mysqli_fetch_array($queryLogin);

     $sqlLogin1="select * from tbl_cities where id='".$count['city_id']."'";
       $queryLogin1=mysqli_query($con,$sqlLogin1); 
     $count1=mysqli_fetch_array($queryLogin1);


$sqlLogin2="select * from states where id='".$count1['state_id']."'"; 
       $queryLogin2=mysqli_query($con,$sqlLogin2); 
     $count2=mysqli_fetch_array($queryLogin2);

     if(empty($count2['name'])){ 
     	
 $json['data'][]=array('Id'=> '','State'=> '');

     }
     else{
 $json['data'][]=array('Id'=> $count2['id'], 'State'=> $count2['name']);
 
}

echo json_encode($json);

?>




