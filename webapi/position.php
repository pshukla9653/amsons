<?php 
require "config.php";
 $id=$_REQUEST['id'];
  $sqlLogin1="select * from tbl_paper_city where id='$id'";
       $queryLogin=mysqli_query($con,$sqlLogin1); 
     $count=mysqli_fetch_array($queryLogin);
$sqlLogin="select * from tbl_position  ";
//echo  $sqlLogin="SELECT distinct tbl_cat_with_paper.cat_id, n.name as newspaper_name, c.name as cat_name FROM tbl_cat_with_paper 
          //  INNER JOIN tbl_newspapers n ON n.id=tbl_cat_with_paper.newspaper_id
           // INNER JOIN tbl_position c ON c.id=tbl_cat_with_paper.cat_id WHERE tbl_cat_with_paper.newspaper_id ='".$count['paper_id']."'"; 
       $queryLogin=mysqli_query($con,$sqlLogin); 
       if($count=mysqli_num_rows($queryLogin)=='0')
       {
       	$json['data'][]=array('id'=>'','Heading'=>'');
       } else{
     while($row=mysqli_fetch_array($queryLogin))
{
	 $json['data'][]=array('id'=>$row['id'],'Heading'=>$row['position'] );
}}
echo json_encode($json);
/*
  var  inse= parseInt($("#inse").val());

                    var day=parseInt(scheme.free) + parseInt(scheme.paid);

                    if((day <= inse) && (inse%day==0))

                    {

                        free_days=(inse/day)*scheme.free;

                        alert("Scheme applied. Free Days :-"+free_days);

                    }

                    else

                    {

                        free_days = 0;

                        alert("Scheme Not applicable.");

                        document.getElementById("scheme").selectedIndex = 0;

                    }
*/
?>
