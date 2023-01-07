<?php 
require "config.php";
 $id=$_REQUEST['id'];
  $sqlLogin1="select * from tbl_paper_city where id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin1); 
     $count=mysqli_fetch_array($queryLogin);
// $sqlLogin="select * from tbl_categories where status='A' ";
 $sqlLogin="SELECT distinct tbl_cat_with_paper.cat_id, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
            INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
            INNER JOIN tbl_categories c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$count['paper_id']."'"; 
       $queryLogin=mysqli_query($con,$sqlLogin); 
       if($count=mysqli_num_rows($queryLogin)=='0')
       {
       	$json['data'][]=array('id'=>'','Heading'=>'');
       } else{
     while($row=mysqli_fetch_array($queryLogin))
{
	 $json['data'][]=array('id'=>$row['cat_id'],'Heading'=>$row['cat_name'] );
}}
echo json_encode($json);
?>
