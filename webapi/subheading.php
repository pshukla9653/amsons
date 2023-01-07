<?php 
require "config.php";
  $id=$_REQUEST['id'];
 
 		 $sqlLogin="select * from tbl_sub_heading where cat_id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin); 
 		while($row=mysqli_fetch_array($queryLogin))
 {
	 $json['data'][]=array('Id' => $row['id'], 'Sub Heading'=>$row['sub_heading'] );
 }

echo json_encode($json);
?>
