<?php 
require "config.php";

$id=$_REQUEST['id'];
$pass=$_REQUEST['password'];
 $sqlLogin="select * from tbl_client where id='$id'";

// $sqlLogin="select * from tbl_client";
       $queryLogin=mysqli_query($con,$sqlLogin); 
     $count=mysqli_num_rows($queryLogin);
     //echo $count;
  if($count>0)
     {
    
    $query = mysqli_query($con,"SELECT tbl_paper_city.id, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
            LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
            LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id order by newspaper_name ");
     $newspaper=array();
     $newspaper_name=array();
   while( $row=mysqli_fetch_array($query))
   {
   $json['data'][]=array('id'=>$row[id],'newspaper_name'=>$row['newspaper_name'],'city'=>$row['city_name']);
   }}
 else
     {    
         $json['status']=false;
        $json['cat_msg']="No client!";
    } 
echo json_encode($json);
?>