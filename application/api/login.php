<?php 
require "config.php";

$email=$_REQUEST['email'];
$pass=$_REQUEST['password'];
 $sqlLogin="select * from tbl_client where email='$email' and passcode='$pass'";

// $sqlLogin="select * from tbl_client";
       $queryLogin=mysqli_query($con,$sqlLogin); 
     $count=mysqli_num_rows($queryLogin);
     //echo $count;
  if($count>0)
     {
    
    $json['cat_msg']="Successfully";
    $json['status']=true;
    $json['email']=$email;
    while($row=mysqli_fetch_array($queryLogin))
    {
       
            $json['id']=$row['id'];
            $json['client_name']=$row['client_name'];
    }

    $query = mysqli_query($con,"SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name FROM tbl_paper_city 
            LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id
            LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id order by newspaper_name ");
     $newspaper_id=array();
     $newspaper_name=array();
   while( $row=mysqli_fetch_array($query))
   {
    array_push($newspaper_id,$row['id']);
    array_push($nespaper_name,$row['newspaper_name']);
    
   }

  
           
           
       
     }
 else
     {
         
         
         
         $json['status']=false;
        $json['cat_msg']="No client!";
    } 

echo json_encode($json);
//echo json_encode($row);
?>