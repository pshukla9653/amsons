 <?php
 require "config.php";
$id          = $_REQUEST['id'];
$cat_id      = $_REQUEST['cat_id'];
$type_id     = $_REQUEST['type_id'];
if( $type_id==1||$type_id==2)
{
 $query = "SELECT * FROM `tbl_paper_scheme` WHERE `np_id`='".$id."' AND `type_id`='".$type_id."' AND `cat_id`='".$cat_id."' GROUP BY `scheme_id`"; 
}
else{
	$query = "SELECT * FROM `tbl_hd_scheme` WHERE `np_id`='".$id."' AND `type_id`='".$type_id."' AND `cat_id`='".$cat_id."' GROUP BY `scheme_id`"; 
	
}

 
$sch= mysqli_query($con, $query);
   $counghfhcgt1 = mysqli_num_rows($sch);


 if($counghfhcgt1>0){

 while($count1 = mysqli_fetch_array($sch)){


 if($count1['scheme_name']==''){

   $data['scheme_name'] ="";

 }else 
 {
   $data['scheme_name'] =  $count1['scheme_name']; 
   $data['scheme_id']=$count1['id'];
}
  $json['data'][]=$data;  


 
   }
}else
{



 $data['scheme_name'] = "";
  $json['data'][]=$data;  


}



   echo json_encode($json);
?>