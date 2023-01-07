 <?php
 require "config.php";
 $id          = $_REQUEST['id'];
$cat_id      = $_REQUEST['cat_id'];
$insertion   = $_REQUEST['ins'];
//$city        = $_REQUEST['city'];
$type_id     = $_REQUEST['type_id'];
  $sqlLogin="select * from tbl_paper_city where id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin); 
     $count=mysqli_fetch_array($queryLogin);

  $sqlLogin1="select * from tbl_newspapers where id='".$count['paper_id']."'";
       $queryLogin1=mysqli_query($con,$sqlLogin1); 
     $count1=mysqli_fetch_array($queryLogin1);


 if(!empty($count1['g_id']))
 { 

    $sqlLogin2="SELECT * FROM `tbl_package` WHERE `g_id`='".$count1['g_id'] ."' AND `cat_id`='". $cat_id ."' AND type_id='".$type_id."' AND `ins_from` <= '".$insertion."' AND `ins_to` >= '".$insertion."'"; 
   
       $queryLogin2=mysqli_query($con,$sqlLogin2); 
    // $count2=mysqli_fetch_array($queryLogin2);
     $counghfhcgt1 = mysqli_num_rows($queryLogin2);
  
    if($counghfhcgt1>0){

        while($count2 = mysqli_fetch_array($queryLogin2)){


            if($count2['package']==''){

                    $data['package'] ="";

             }
             else 
             {
               $data['package'] =  $count2['package']; 
               $data['pack_id']=$count2['id'];
            }
         $json['data'][]=$data;  


 
       }
    }
    else
    {
    
     $data['package'] = "";
      $data['pack_id']="";
      $json['data'][]=$data;  
    
    
    }

}

   echo json_encode($json);
  
?>