<?php 
require "config.php";
$id=$_REQUEST['id'];
 $sqlLogin="select * from tbl_client where id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin); 
     $count=mysqli_fetch_array($queryLogin);

 //     if(empty($count2['name'])){ 
     	
 // $json['data'][]=array('State'=> '');

 //     }
 //     else{
 $json['data'][]=array('Bill To'=> $count['client_name'],'Client Name'=> $count['client_name']); 
 
// }

echo json_encode($json);

?>

