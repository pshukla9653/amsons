 <?php
require "config.php";
$id          = $_REQUEST['id'];
$sqlLogin    = "select * from tbl_paper_city where id='$id'";
$queryLogin  = mysqli_query($con, $sqlLogin);
$count       = mysqli_fetch_array($queryLogin);
$sqlLogin1   = "select * from tbl_newspapers where id='" . $count['paper_id'] . "'";
$queryLogin1 = mysqli_query($con, $sqlLogin1);
$count1      = mysqli_fetch_array($queryLogin1);
$sqlLogin3   = "select * from tbl_newspapers where g_id='" . $count1['g_id'] . "'";
$queryLogin3 = mysqli_query($con, $sqlLogin3);
 $sqlLogin2   = "SELECT tbl_paper_city.*, n.name as newspaper_name,n.g_id , c.name as city_name,c.id as cityid FROM tbl_paper_city LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.paper_id LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.city_id WHERE n.g_id='".$count1['g_id'] ."' AND tbl_paper_city.id !='".$id."'";
        $queryLogin2 = mysqli_query($con, $sqlLogin2);
        
while ($count2 = mysqli_fetch_array($queryLogin2)) { 
  
      
         $data['newspaperid']=$count2['id'];
         $data['newspaper']=$count2['newspaper_name'];
          $data['cityid']=$count2['cityid'];
        $data['city']=$count2['city_name'];
 
         $json['data'][]=$data;
   
}
echo json_encode($json);
?> 
