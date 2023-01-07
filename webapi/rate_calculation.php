 <?php
 require "config.php";
$u_id      =$_REQUEST['u_id'];        //client id;
$client    =$_REQUEST['client'];       //client name;
$newspaper = $_REQUEST['newspaper']; //publication id;
$cat_id     =$_REQUEST['cat_id'];     //heading
$inse       = $_REQUEST['inse'];        //insertion
$state      = $_REQUEST['state'];
$type_id    = $_REQUEST['type_id'];
$dates      = $_REQUEST['dates'];

 $a_dates    =$_REQUEST['a_dates'];
$a_newspaper=array($_REQUEST['a_newspaper']); // array of add on newspaper;
$book_date  = '2020-02-05';//  $_REQUEST['book_date'];

//$dates     =array("04-03-2019","07-03-2019");
$w_count1  =$_REQUEST['w_count1']; // no. of words.
$add_on     =$_REQUEST['add_on']; // id add_on is on /off value should be 1/0; 
$free_days  =$_REQUEST['free_days']; //free_days
$prem_id    =$_REQUEST['prem_id'];
$scheme_id  =$_REQUEST['scheme_id'];
$paid_days  =$_REQUEST['paid_days']; //paid days
//$p_type=$_REQUEST['p_type'];
 $premimum   = $_REQUEST['premimum'];
$pack       =$_REQUEST['pack'];// package id
$package    =$_REQUEST['package'];// package value;

$matter     =$_REQUEST['matter'];
$base_id     =0;
$rate1=array();

//$arr=array();
//$a_newspaper=$_REQUEST['a_newspaper'];// array of add on newspaper;
        // array of dates with index as id
 
 //http://dukeinfosys.org/amsons/webapi/rate_calculation.php?u_id=1&&%20client=%27veena%27&&newspaper=1&&cat_id=1&&inse=1&&city=6&&type_id=1&&dates[0]=2020-03-03&&a_dates[0]=0&&a_newspaper=0&&w_count1=18&&add_on=0&&free_days=0&&prem_id=0&&premimum=0&&scheme_id=0&&paid_days=0&&pack=1&&package=1+1&&matter=veena is doing well
 //http://dukeinfosys.org/amsons/webapi/rate_calculation.php?u_id=1&&%20client=%27veena%27&&newspaper=1&&cat_id=1&&inse=1&&city=6&&type_id=1&&dates[0]=2020-03-03&&a_dates[0]=0&&a_newspaper=0&&w_count1=18&&add_on=0&&free_days=0&&prem_id=0&&premimum=0&&scheme_id=0&&paid_days=0&&pack=0&&package=0&&matter=veena%20is%20doing%20well
 //http://dukeinfosys.org/amsons/webapi/rate_calculation.php?u_id=1&&%20client=%27veena%27&&newspaper=4&&cat_id=1&&inse=2&&state=6&&type_id=1&&dates[0]=2020-03-03&&dates[1]=2020-01-12&&a_dates[0]=2019-01-12,2019-01-15&&a_dates[1]=2020-01-15&&a_newspaper=13&&w_count1=18&&add_on=1&&free_days=0&&prem_id=1&&p_type=TOP%20OF%20COLOUMN&&premimum=25.00,%&&scheme_id=0&&paid_days=0&&pack=0&&package=0&&matter=veena%20is%20doing%20well
 // Get Client Discount 
 $query="select * from tbl_client where id='".$u_id."'";
 $query_result=mysqli_query($con,$query);

 if($client_value=mysqli_fetch_array($query_result))
 {
      $discount=$client_value['discount'];
      $data['discount']=$discount;
 }
 //
 
 

 /* $sqlLogin1="select * from tbl_newspapers where id='".$count['paper_id']."'";
       $queryLogin1=mysqli_query($con,$sqlLogin1); 
     $count1=mysqli_fetch_array($queryLogin1);*/
if($add_on==1)
{
    
    $arr = $a_newspaper;
    $newspaper= $newspaper;
    array_push($arr,$newspaper);

   foreach($dates as $dt=>$value)
   {
        $data= get_base_dop_price($value,$arr,$newspaper,$cat_id,$inse,$con);
   }
       // $data= get_base_dop_price($dates,$arr,$newspaper,$cat_id,$inse,$con);
     $base_id=$data['rates']['newspaper_id'];
   // echo "base_id".$base_id;
     $rate1[$base_id]=$data['rates']['ad_price'];
      $erate1[$base_id] =$data['rates']['extra_price'];
      $brate1[$base_id]=$data['rates']['b_rate'];
      $berate1[$base_id]=0;
      $min_w=$data['rates']['min_w'];
      $m_unit=$data['rates']['unit'];
      $days[$base_id]=$data['rates']['day_id'];

      $nfdc=$data['rates']['non_focus_charge'];
   // } 
    
  
    foreach($a_newspaper as $key=>$addon)
    {
       
        $dates1=explode(',',$a_dates[$key]);
        
      //  echo var_dump($dates1);
        foreach($dates1 as $s_date)
        {
            $data1= get_addon_dop_price($s_date,$addon,$newspaper,$cat_id,$inse,$con,$w_count1);
        }
           $add_on1=$data1['rates1']['a_paper_id'];
         
          $rate1[$add_on1]=$data1['rates1']['price'];
         
          $erate1[$add_on1] =$data1['rates1']['e_price'];
          $brate1[$add_on1]=0;
          $berate1[$add_on1]=0;
       // $min_w=$data1['rates1']['min_w'];
        //  $m_unit[$add_on]=$data1['rates1']['unit'];
          $days[$add_on1]=$data1['rates1']['day_id'];
    
          $nfdc=$data1['rates1']['non_focus_charge'];
          
    }
      
}
else if($pack!=0)
{
   
    $data=get_package_price($pack,$con);
   // echo var_dump($data);
   $rate1[0]=$data['pack']['rate'];
   $erate1[0]=$data['pack']['e_rate'];
   $brate1[0]=$data['pack']['b_rate'];
   $berate1[0]=0;
}
else
{

    foreach($dates as $dt=>$value)
    { 
        $data= get_dop_price($value,$newspaper,$cat_id,$inse,$con);
    
      $base_id=$data['rates']['newspaper_id'];
     
      $rate1[$base_id]=$data['rates']['ad_price'];
      
      $erate1[$base_id] =$data['rates']['extra_price'];
      $brate1[$base_id]=$data['rates']['b_rate'];
       $berate1[$base_id]=0;
      $min_w=$data['rates']['min_w'];
      $m_unit=$data['rates']['unit'];
      $days[$base_id]=$data['rates']['day_id'];

      $nfdc=$data['rates']['non_focus_charge'];
    }
   
}

           $w_count1= floatval($w_count1);
          
            $inse= intval($inse);

            $non_fdc= floatval($nfdc);
            $add_on_a=0.0;
         //  $add_on_a= floatval($add_a);

            $dis= floatval($discount);

            $box_c= floatval($box_c);

            $extra_ca=0;

            $amount= 0;

            $t_amount=0;	

            $p_amount=0;

            $dis_a=0;
            
             $inse_dop= $inse-$free_days;

            $inse=$inse-$free_days;
            
           // $pack= "";

           

            if ($add_on==1) 

            {

               // echo "add_on";

                $rate= floatval($rate1[$base_id]);
                $erate=floatval($erate1[$base_id]);
                 $brate= floatval($brate1[$base_id]);
                 $berate=floatval($berate1[$base_id]);

                if($brate>0)

                {

                    $amount=$amount+$brate*$inse;

                }

                else



                {

         $amount=$amount+$rate*$inse;

                }

                if($berate>0)

                {

                    if($min_w < $w_count1)

                    {

                        $extra_ca=$extra_ca+($w_count1 - $min_w)*$berate*$inse;

                    }

                    else

                    {

                        $extra_ca=$extra_ca+0;

                    }

                }

                else

                {echo "m_w".$min_w;

                    if($min_w < $w_count1){
                        echo "ec".$extra_ca."$w_count1 - $min_w"."erate".$erate."inse".$inse;
echo "less";
                        $extra_ca=$extra_ca+($w_count1 - $min_w)*$erate*$inse;

                    }

                    else{



                        $extra_ca=$extra_ca+0;

                    }

                }
echo $extra_ca;
                $arr = $a_newspaper;
                $newspaper= $newspaper;
                array_unshift($arr,$newspaper);
              //  print_r($arr);
            // alert("amount_calculate "+arr);
                
                foreach($arr as $ar=>$id)
                 {

                    if($id==$base_id){

                        
 $rate= 0;

                    $erate= 0;

                   $brate= 0;

                    $berate= 0;
                    }
else{
                    $rate= floatval($rate1[$id]);

                    $erate= floatval($erate1[$id]);

                   $brate= floatval($brate1[$id]);

                    $berate= floatval($berate1[$id]);
}


                    if($brate>0){

                        $add_on_a=$add_on_a+($brate*$inse);

                    }
                    else{

                       $add_on_a=$add_on_a+($rate*$inse);

                    }

                    if($berate>0){

                        if($min_w < $w_count1){

                            $add_on_a=$add_on_a+($w_count1-$min_w)*($berate*$inse);

                        }				

                    }else{

                        if($min_w < $w_count1){

                            $add_on_a=$add_on_a+($w_count1-$min_w)*($erate*$inse);

                        }				

                    }

                }

            }
            
            else if($pack!=0)
            {
      
            
                $rate= floatval($rate1[0]);

                    $erate= floatval($erate1[0]);

                    $brate= floatval($brate1[0]);

                    $berate= floatval($berate1[0]);

                    if($brate>0){

                        $amount=$amount+($brate*$inse);

                    }

                    else

                    {

                        $amount=$amount+($rate*$inse);

                    }

                    if($berate>0)

                    {

                        if($min_w < $w_count1){

                            $extra_ca=$extra_ca+($w_count1 - $min_w)*($berate*$inse);

                        }else{

                            $extra_ca=0;

                        }

                    }
                    else
                    {

                        if($min_w < $w_count1)

                        {

                            $extra_ca=$extra_ca+($w_count1 - $min_w)*(erate*$inse);

                        }else{

                            $extra_ca=0;

                        }

                    }

                }

                else

                {

                $rate= floatval($rate1[$base_id]);
                $erate=floatval($erate1[$base_id]);
                $brate= floatval($brate1[$base_id]);
                $berate=floatval($berate1[$base_id]);

                if($brate>0)

                {

                    $amount=$amount+$brate*$inse;

                }

                else



                {

                    $amount=$amount+$rate*$inse;

                }

                if($berate>0)

                {

                    if($min_w < $w_count1)

                    {

                        $extra_ca=$extra_ca+($w_count1 - $min_w)*$berate*$inse;

                    }

                    else

                    {

                        $extra_ca=$extra_ca+0;

                    }

                }

                else

                {

                    if($min_w < $w_count1){

                        $extra_ca=$extra_ca+($w_count1 - $min_w)*$erate*$inse;

                    }

                    else{



                        $extra_ca=$extra_ca+0;

                    }

                
                    }

                }

             

                $condition=non_focus_day($dates,$days[$base_id]);	
               
                if($condition==1){		

                    if($nfdc[1]== "Rs"){

                        if(floatval($amount)>0){

                            $t_amount=$t_amount+$amount;

                        }

                        if(floatval($premimum_a)>0){

                            $t_amount=$t_amount+$premimum_a;

                        }

                        if(floatval($extra_ca)>0){

                            $t_amount=$t_amount+$extra_ca;

                        }

                        if(floatval($non_fdc)>0){

                            $t_amount=$t_amount+($non_fdc);

                        }

                        if(floatval($add_on_a)>0){

                            $t_amount=$t_amount+$add_on_a;

                        }

                        if(floatval($box_c)>0){

                            $t_amount=$t_amount+$box_c;

                        }

                    } 
                    else
                    {

                        $non_focus_day_charge=0;

                        $non_focus_day_charge=($amount + $extra_ca )* $non_fdc /100;
                        $nfdc=$non_focus_day_charge;
                      // echo "nfdc".$nfdc;
                      if($prem_id!=0 ||$prem_id!='')
                            {
                              $premimum_a = get_premium_price($premimum,$nfdc,$box_c,$extra_ca,$amount,$add_on_a);
                            }
                            else
                            {
                                     $premimum_a= 0;
                            }
                        if(floatval($amount)>0){

                           $t_amount=$t_amount+$amount;

                        }

                        if(floatval($premimum_a)>0){

                            $t_amount=$t_amount+$premimum_a;

                        }

                        if(floatval($extra_ca)>0){

                            $t_amount=$t_amount+$extra_ca;

                        }

                        if(floatval($non_focus_day_charge)>0){

                            $t_amount=$t_amount+$non_focus_day_charge;

                        }

                        if(floatval($add_on_a)>0){

                            $t_amount=$t_amount+$add_on_a;

                        }

                        if(floatval($box_c)>0){

                            $t_amount=$t_amount+$box_c;

                        }

                     //  $t_amount=$amount+$premimum_a+$extra_ca+$non_focus_day_charge+$add_on_a+$box_c;

                    }

                    //t_amount=amount+premimum_a+$extra_ca+non_fdc+add_on_a+box_c;

                }
                else
                {
                   
                    if(floatval($amount)>0){

                        $t_amount=$t_amount+$amount;

                    }

                    if(floatval($premimum_a)>0){

                        $t_amount=$t_amount+$premimum_a;

                    }

                    if(floatval($extra_ca)>0){

                        $t_amount=$t_amount+$extra_ca;

                    }

                    if(floatval($add_on_a)>0){

                        $t_amount=$t_amount+$add_on_a;

                    }

                    if(floatval($box_c)>0){

                        $t_amount=$t_amount+$box_c;

                    }

                }



                $dis_a=($t_amount-$box_c)*$dis/100;

                $p_amount=$t_amount-$dis_a;

                //console.log("amount: "+amount.toFixed(2));

                //console.log("city: "+document.getElementById('city').value);

                
$taxable_amount = number_format((floatval($t_amount)-floatval($dis_a)), 2, '.', '');
                



               
 

           


                $res =$dates;// from_date.split(", ", 1);
                $gst=5;
                $first_date=$res[0]; 
                 $state;
                $second_date="2017-07-01"; 

                //console.log(ro_date);

                if(date_create($first_date)>=date_create($second_date)){

                    if($state=="6"){

                        $cgst=number_format(((floatval($taxable_amount)*(floatval($gst)/2))/100),2,'.','');

                       $sgst=number_format(((floatval($taxable_amount)*(floatval($gst)/2))/100),2,'.','');

                       $igst=0;

                    } else {

                        $cgst=0;

                       $sgst=0;

                       $igst=number_format(((floatval($taxable_amount)*floatval($gst))/100),2,'.','');

                    } 

                }

                else{

                   $cgst=0;

                    $sgst=0;

                    $igst=0;

                }









              $dis_a = number_format($dis_a,2,'.','');

             $p_amount = ($p_amount+(floatval($igst)+(floatval($sgst))+(floatval($cgst))));	
////   put into an array  //////

foreach($rate1 as $key=>$value)
{
   $dd['newspaper_id']=$key;
   $dd['rate']=$value;
    $dd['erate']=$erate1[$key];
    $dd['brate']=$brate1[$key];;
    $dd['berate']=$berate1[$key];;
    $json['data'][]=$dd;
}
//$data_d['rate']=$rate1;
//$data_d['erate']=$erate1;
//$data_d['brate']=$brate1;
//$data_d['berate']=$berate1;
$data_d['cgst']=$cgst;
$data_d['sgst']=$sgst;
$data_d['igst']=$igst;
$data_d['discount']=$discount;
$data_d['dis_a']=$dis_a;
$data_d['amount']=$amount;
$data_d['extra_ca']=$extra_ca;
$data_d['nfdc']=$nfdc;
$data_d['t_amount']=$t_amount;
$data_d['taxable_amount']=$taxable_amount;
$data_d['p_amount']=$p_amount;
$data_d['$add_on_a']=$add_on_a;
$data_d['premimum_a']=$premimum_a;
 $json['data'][]=$data_d;
 
 
 
    function get_dop_price($s_date,$newspaper,$cat_id,$inse,$con)
    {
        
           
       $date=date_create($s_date);		
     $sqlLogin="select * from tbl_paper_city where id='".$newspaper."'";
       $queryLogin=mysqli_query($con,$sqlLogin);
      
       if( $count=mysqli_fetch_array($queryLogin))
         	{
                
            
                $values = array(
                    'count'=>0,
                    'newspaper_id' => $count['paper_id'],
                    'type_id' => 1,
                    'cat_id' => $cat_id,
                    'insertion' =>$inse,
                    'city' => $count['city_id'],
                    's_date'=>date_format($date,"Y-m-d")
                );
            }
            
        $query1= "SELECT * FROM `tbl_ad_price` WHERE `newspaper_id` = '".$values['newspaper_id']."' AND city='".$values['city']."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'  " ;
           $result= mysqli_query($con,$query1);
         
        
          $rate_count= mysqli_num_rows($result);
            if($rate_count>0)
            {
               
               while( $rates= mysqli_fetch_array($result))
                {
                   
                    
                    if($rates['revise_rate']==1)
                    {
                        if($rates['date_from'] <= $values['s_date'] AND $rates['date_to'] >= $values['s_date'])
                        {
                            $rate1=$rates;
                           
                        }
                        else
                        {
                            continue;
                        }
                    }
                    else
                    {
                        if($rates['date_from'] <= $values['s_date'] )
                        {
                            $rate1=$rates;
                          
                        }
                        else
                        {
                            continue;
                        }
                    }
                }
               
    }
    
            if(empty($rate1))
            {
               $data['rates']="";
                $data['values']="";
              
          //   echo $json['data'][]=$data; 
               
            }
            else
            {
              
               $data['rates']=$rate1;
                $data['values']=$values;
           
//echo json_encode( $json['data'][]=$data); 
               
            }
          
    
        return $data;
        }
      function get_base_dop_price($s_date,$arr,$newspaper,$cat_id,$inse,$con)
                        {
                          // echo var_dump($arr);
                             $date=date_create($s_date);	
                           $add_paper=$arr;
                                    $i=0;
                                    $f=0;
                                    $paper=0;
                                    foreach($add_paper as $p_id)
                                    {
                              $sqlLogin="select * from tbl_paper_city where id='".$p_id."'";
                                    
                                    $queryLogin=mysqli_query($con,$sqlLogin);
                          
                                   if( $count=mysqli_fetch_array($queryLogin))
                                         	{
                                                
                                            
                                                $values = array(
                                                    'count'=>0,
                                                    'newspaper_id' => $count['paper_id'],
                                                    'type_id' => 1,
                                                    'cat_id' => $cat_id,
                                                    'insertion' =>$inse,
                                                    'city' => $count['city_id'],
                                                    's_date'=>date_format($date,"Y-m-d")
                                                );
                                            }
                    
                              $query = "SELECT tbl_ad_price.*,n.name as newspaper_name,c.name as city_name FROM `tbl_ad_price`
                    					LEFT JOIN tbl_newspapers n ON n.id=tbl_ad_price.newspaper_id
                    					LEFT JOIN tbl_cities c ON c.id=tbl_ad_price.city
                    					WHERE tbl_ad_price.newspaper_id= '".$values['newspaper_id']."' AND tbl_ad_price.city='".$values['city']."' AND tbl_ad_price.ad_type = '". $values['type_id'] ."' AND tbl_ad_price.ad_cat_id = '".$values['cat_id']."' AND tbl_ad_price.ins_from <= '".$values['insertion']."' AND tbl_ad_price.ins_to >= '".$values['insertion']."'";
                                        $rate_result=mysqli_query($con,$query);
                                        while($rates= mysqli_fetch_array($rate_result))
                                        {
                                                
                                            if($rates['revise_rate']==1)
                                                {
                                                    if($rates['date_from'] <= $values['s_date'] AND $rates['date_to'] >= $values['s_date'])
                                                    {
                                                        $rate1=$rates;
                                                       
                                                    }
                                                    else
                                                    {
                                                        continue;
                                                    }
                                                }
                                                else
                                                {
                                                    if($rates['date_from'] <= $values['s_date'] )
                                                    {
                                                        $rate1=$rates;
                                                      
                                                    }
                                                    else
                                                    {
                                                        continue;
                                                    }
                                                }
                                            
                                                if($f==0 && !empty($rate1))
                                                {
                                                    $f=1;
                                                    $base_rate=$rate1;
                                                    $paper=$p_id;
                                                }
                                                else
                                                {  //echo $rates['ad_price']."bb".$base_rate['ad_price'];
                                                    if(!empty($rate1)&&($rate1['ad_price'] > $base_rate['ad_price']))
                                                    {
                                                        $base_rate=$rate1;
                                                        $paper=$p_id;
                                                    }						
                                                }
                                        }
                                       
                                                $i++;
                                   }	
                                    if(empty($base_rate))
                                    {
                                         $data['rates']="";
                                         $data['values']="";
                                    }
                                    else
                                    {
                                         
                                        $data['value']=$paper;
                                        $data['values']=$values;
                                        $data['rates']=$base_rate;
                                    
                                       
                                    }
                                
                           return $data;

    }
  function get_addon_dop_price($s_date,$addon,$newspaper,$cat_id,$inse,$con,$w_count1)
    {
          $date=date_create($s_date);		

       		
   
       $sqlLogin ="SELECT tbl_paper_city.*,n.name as newspaper_name,c.name as city_name FROM tbl_paper_city  LEFT JOIN tbl_newspapers n ON n.id=tbl_paper_city.`paper_id` LEFT JOIN tbl_cities c ON c.id=tbl_paper_city.`city_id`WHERE tbl_paper_city.id='". $addon."'";			
               
             
       $queryLogin=mysqli_query($con,$sqlLogin);
        
       if( $count=mysqli_fetch_array($queryLogin))
         	{
                
           $td=$count['newspaper_name'];
               

                $values = array(								
                 'm_newspaper_id' => $newspaper,
                 'a_newspaper_id' => $addon,
                 'type_id' => 1,
                 'cat_id' => $cat_id,
                 'insertion' => $inse,
                 'city' =>  $count['city_id'],
                 'size'=>$w_count1,
                 's_date'=>date_format($date,"Y-m-d")
        );

        $query = "SELECT * FROM tbl_add_on WHERE (`m_paper_id` = '".$values['m_newspaper_id']."' AND `a_paper_id` = '".$values['a_newspaper_id']."' AND `ad_type` = '". $values['type_id'] ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."' AND `f_unit` <= '".$values['size']."' AND `t_unit` >= '".$values['size']."' ) ";

            $result= mysqli_query($con,$query);
         
        
          $rate_count= mysqli_num_rows($result);
            if($rate_count>0)
            {
               
               while( $rates= mysqli_fetch_array($result))
                {
                   

                    if(empty($rates))
                    {
                        //"select * from tbl_paper_city where id='".$addon."'"
                        $sqlcity = "select * from tbl_paper_city where id='".$addon."'";
                        $paper_result= mysqli_query($con,$sqlcity);
                        $paper_value=mysqli_fetch_array($paper_result);
                        $query = "SELECT id, `ad_price` as price, `extra_price` as e_price FROM `tbl_ad_price` WHERE `newspaper_id` = '".$paper_value['paper_id'] ."' AND city='".$paper_value['city_id'] ."' AND `ad_type` = '". 1 ."' AND `ad_cat_id` = '".$values['cat_id']."' AND `ins_from` <= '".$values['insertion']."' AND `ins_to` >= '".$values['insertion']."'";
                        $rate_result=mysqli_query($con,$query);
                        while($rates1=mysqli_fetch_array($rate_result))
                        {
                          
        
                            if(!empty($rates1))
                            {
                               $rates1 = $rates1;
                             }
                             else
                             {
                                $rates1="";
                             }
                              
                        }
                    }
                else
                {
                    
                    $rates1=$rates;
                }
            
                    if($rates1['revise_rate']==1)
                    {
                        if($rates1['date_from'] <= $values['s_date'] AND $rates1['date_to'] >= $values['s_date'])
                        {
                            $rate1=$rates1;
                           
                        }
                        else
                        {
                            continue;
                        }
                        if(empty($rate1)){echo "no Add on rate found";}
                    }
                    else
                    { 
                        if($rates1['date_from'] <= $values['s_date'] )
                        {
                            $rate1=$rates1;
                          
                        }
                        else
                        {
                            continue;
                        }
                         if(empty($rate1)){echo "no Add on rate found";}
                    }
                }
                
            }
}
//echo var_dump($rate1);
     /*   foreach($rates1 as $rate)
        { echo var_dump($rate);
            
            if($rate['revise_rate']==1)
            {
                if($rate['date_from'] <= $values['s_date'] AND $rate['date_to'] >= $values['s_date'] AND $rate['date_to']!="0000-00-00")
                {
                    $rate1=$rate;
                }
                else
                {
                    continue;
                }
            }
            else
            {
                if($rate['date_from'] <= $values['s_date'] )
                {
                    $rate1=$rate;
                }
                else
                {
                    continue;
                }
            }
        }
*/
       if(empty($rate1))
            {
               $data['rates1']="";
                $data['values1']="";
              
            // echo $json['data'][]=$data; 
               
            }
            else
            {
              
               $data['rates1']=$rate1;
                $data['values1']=$values;
           
//echo json_encode( $json['data'][]=$data); 
               
            }
return $data;
    }
function get_premium_price($premimum,$nfdc,$box_c,$extra_ca,$amount,$add_on_a)
{
    $prem=explode(',',$premimum);

                     

                    $premimum_type=$prem[1];

                       $premimum_value=$prem[0];

                        if($prem[1] == 'Rs'){

                            $pa=floatval($pa+$prem[0]);

                            return false;

                        }

                        if($prem[1] == '%'){

                              $non_fdc= floatval($nfdc);

                              $add_on_a= floatval($add_on_a);						

                              $box_c= floatval($box_c);

                              $amount= floatval($amount);						

                              $extra_ca= floatval($extra_ca);

                             $p_a=($amount + $extra_ca +$non_fdc + $add_on_a)* floatval($prem[0])/100;

                            $pa=floatval($pa + $p_a);

                          

                            $premimum_a =$pa;

                            //document.getElementById("premimum_a").value =pa;

                            //amount_calculate();

                            return $premimum_a;

                        }


}

    function amount_calculate()

        {	

            $premimum_a= floatval($premimum_a);

           $w_count1= floatval($w_count1);
           echo $w_count1;

            $inse= intval($inse);

            $non_fdc= floatval($nfdc);

            $add_on_a= floatval($add_a);

            $dis= floatval($dis);

            $box_c= floatval($box_c);

            $extra_ca=0;

            $amount= 0;

            $t_amount=0;	

            $p_amount=0;

            $dis_a=0;
            
             $inse_dop= $inse-$free_days;

            $inse=$inse-$free_days;
            
             $pack= $pack;

           

            if ($add_on==1) 

            {

                

                $rate= floatval($rate[$base_id]);

                $erate=floatval($erate[$base_id]);
                $brate= floatval($brate[$base_id]);
                $berate=floatval($berate[$base_id]);

                if($brate>0)

                {

                    $amount=$amount+$brate*$inse;

                }

                else



                {

                    $amount=$amount+$rate*$inse;

                }

                if($berate>0)

                {

                    if($min_w < $w_count1)

                    {

                        $extra_ca=$extra_ca+($w_count1 - $min_w)*$berate*$inse;

                    }

                    else

                    {

                        $extra_ca=$extra_ca+0;

                    }

                }

                else

                {

                    if($min_w < $w_count1){

                        $extra_ca=$extra_ca+($w_count1 - $min_w)*$erate*$inse;

                    }

                    else{



                        $extra_ca=$extra_ca+0;

                    }

                }

                $arr = $a_newspaper;
                $newspaper= $newspaper;
                array_unshift($arr,$newspaper);
                
               // alert("amount_calculate "+arr);
                $add_on_a=0.0;
                foreach($arr as $ar=>$id)
                 {

                    if($id==$base_id){

                        return;

                    }

                   $rate= floatval($rate[$id]);

                    $erate= floatval($erate[$id]);

                   $brate= floatval($brate[$id]);

                    $berate= floatval($berate[$id]);



                    if($brate>0){

                        $add_on_a=$add_on_a+($brate*$inse);

                    }
                    else{

                        $add_on_a=$add_on_a+($rate*$inse);

                    }

                    if($berate>0){

                        if($min_w < $w_count1){

                            $add_on_a=$add_on_a+($w_count1-$min_w)*($berate*$inse);

                        }				

                    }else{

                        if($min_w < $w_count1){

                           echo $add_on_a=$add_on_a+($w_count1-$min_w)*($erate*$inse);

                        }				

                    }

                }

            }
            
            else if($pack!="")
            {
            
            
                    $rate= floatval($rate);

                    $erate= floatval($erate);

                    $brate= floatval($brate);

                    $berate= floatval($berate);

                    if($brate>0){

                        $amount=$amount+($brate*$inse);

                    }

                    else

                    {

                        $amount=$amount+($rate*$inse);

                    }

                    if($berate>0)

                    {

                        if($min_w < $w_count1){

                            $extra_ca=$extra_ca+($w_count1 - $min_w)*($berate*$inse);

                        }else{

                            $extra_ca=0;

                        }

                    }
                    else
                    {

                        if($min_w < $w_count1)

                        {

                            $extra_ca=$extra_ca+($w_count1 - $min_w)*(erate*$inse);

                        }else{

                            $extra_ca=0;

                        }

                    }

                }

                else

                {

                    $rate=0;

                    $erate=0;

                    $brate=0;

                    $berate=0;

                    $i;

                    $brate= floatval($brate0);

                    $berate= floatval($berate0);

                    if($brate>0)

                    {

                        $amount=$amount+($brate*$inse);

                        if($berate > 0)

                        {

                            if($min_w < $w_count1)

                            {

                                $extra_ca=$extra_ca+($w_count1 - $min_w)*($berate*$inse);

                            }

                        }

                    }

                    else

                    {

                        

                        $s_days=$dates;

                        $c=$s_days.length;

                        if($c>$free_days)

                        {

                            $c=$c-$free_days;

                        }

                        for($i=0 ; $i < $c ;$i++){

                            //rate= floatval($rate"+i);

                            //erate= floatval($erate"+i);

                            //brate= floatval($brate"+i);

                            //berate= floatval($berate"+i);

                            $rate= floatval($rate);

                            $erate= floatval($erate[$base_id]);

                            $brate= floatval($brate[$base_id]);

                            $berate= floatval($berate[$base_id]);

                            $amount=$amount+$rate;

                            if($min_w < $w_count1){

                                $extra_ca=$extra_ca+($w_count1 - $min_w)*$erate;

                            } else{

                                $extra_ca=$extra_ca+0;

                            }

                        }

                    }

                }

           

            //$amount=rate*inse;	

            if(! isNaN( $amount)){	
             /*   if  (non_fdays != 0)
{
    alert("number of non focus day charges "+ non_fdays);
                        non_focus_day_charge=(t_$amount)+(non_fdc * non_fdays);
                        document.getElementById("nfdc").value = non_focus_day_charge;
}*/
     

                $condition=non_focus_day();	

                if($condition==1){		

                    if($nfdc[1]== "Rs"){

                        if(floatval($amount)>0){

                            $t_amount=$t_amount+$amount;

                        }

                        if(floatval($premimum_a)>0){

                            $t_amount=$t_amount+$premimum_a;

                        }

                        if(floatval($extra_ca)>0){

                            $t_amount=$t_amount+$extra_ca;

                        }

                        if(floatval($non_fdc)>0){

                            $t_amount=$t_amount+($non_fdc);

                        }

                        if(floatval($add_on_a)>0){

                            $t_amount=$t_amount+$add_on_a;

                        }

                        if(floatval($box_c)>0){

                            $t_amount=$t_amount+$box_c;

                        }

                    } else{

                        $non_focus_day_charge=0;

                        $non_focus_day_charge=($amount + $extra_ca )* $non_fdc /100;
                        if(! isNaN($non_focus_day_charge)){

                     //   document.getElementById("nfdc").value = non_focus_day_charge;
}
                        if(floatval($amount)>0){

                           $t_amount=$t_amount+$amount;

                        }

                        if(floatval($premimum_a)>0){

                            $t_amount=$t_amount+$premimum_a;

                        }

                        if(floatval($extra_ca)>0){

                            $t_amount=$t_amount+$extra_ca;

                        }

                        if(floatval($non_focus_day_charge)>0){

                            $t_amount=$t_amount+$non_focus_day_charge;

                        }

                        if(floatval($add_on_a)>0){

                            $t_amount=$t_amount+$add_on_a;

                        }

                        if(floatval($box_c)>0){

                            $t_amount=$t_amount+$box_c;

                        }

                        //t_amount=amount+premimum_a+$extra_ca+non_focus_day_charge+add_on_a+box_c;

                    }

                    //t_amount=amount+premimum_a+$extra_ca+non_fdc+add_on_a+box_c;

                }else{

                    if(floatval($amount)>0){

                        $t_amount=$t_amount+$amount;

                    }

                    if(floatval($premimum_a)>0){

                        $t_amount=$t_amount+$premimum_a;

                    }

                    if(floatval($extra_ca)>0){

                        $t_amount=$t_amount+$extra_ca;

                    }

                    if(floatval($add_on_a)>0){

                        $t_amount=$t_amount+$add_on_a;

                    }

                    if(floatval($box_c)>0){

                        $t_amount=$t_amount+$box_c;

                    }

                }



                $dis_a=($t_amount-$box_c)*$dis/100;

                $p_amount=$t_amount-$dis_a;

                //console.log("amount: "+amount.toFixed(2));

                //console.log("city: "+document.getElementById('city').value);

                
$taxable_amount = (floatval($t_amount)-floatval($dis_a)).toFixed(2);}
                



               
 if ($add_on==1) 
 {
     
$newspaper= $newspaper;

             /*   if($from-input'+newspaper).length){

                    from_date=document.getElementById("from-input"+newspaper).value;  

                }

                    
     

 }
 else if (pack!="")
 {
 $.each(packs, function(i, d)
                    {
                        if($from-input'+d.paper_id).length)
                        {
                             from_date= document.getElementById("from-input"+d.paper_id).value;
                        }
                    
                    });
}
else
{
      if($from-input').length)
      {
        from_date= document.getElementById("from-input").value;
      }
}*/


                $res =$dates;// from_date.split(", ", 1);
                $gst=5;
                $first_date=$book_date; 

                $second_date="2017-07-01"; 

                //console.log(ro_date);

                if(new Date($first_date)>=new Date($second_date)){

                    if($state=="6"){

                        $cgst=(floatval($taxable_amount)*(floatval($gst)/2))/100;

                       $sgst=(floatval($taxable_amount)*(floatval($gst)/2))/100;

                       $igst=0;

                    } else {

                        $cgst=0;

                       $sgst=0;

                       $igst=(floatval($taxable_amount)*floatval($gst))/100;

                    } 

                }

                else{

                   $cgst=0;

                    $sgst=0;

                    $igst=0;

                }









              $dis_a = $dis_a.toFixed(2);

             $p_amount = ($p_amount+(floatval($igst)+(floatval($sgst))+(floatval($cgst)))).toFixed(2);	

            }



        }

function non_focus_day($dates,$days){
          
          /* if ($add_on==1)
           {
             $dates= $dates;
          
           }

           else
           {
                 $dates= $dates;
           }*/
         //   $s_days=explode($dates,",");
//echo var_dump($dates);
$s_days=$dates;
            $i;

            $f=1;

            for($i=0; $i<count($s_days);$i++)	

            {

                $fl=0;
                 $d = date_format(date_create($s_days[$i]),'Y-m-d');
//echo "date".$s_days[$i];
                 $day_id=date(w,strtotime($d));
//echo "day_id".$day_id;
                 $j;
//echo var_dump($days);
                for($j=0; $j < count($days); $j++){

                    if($day_id == $days[$j]){

                        $fl=1;				

                    }			
                    else
                    {
                        $non_fdays=$non_fdays+1;
                    }

                }

                if($fl==0){

                    $f=0;

                }

            }



            if($f==0){

                return 1;	

            } else {

                return 0;

            }

        }

 function get_package_price($pack_id,$con)
    {
         $query = "SELECT * FROM `tbl_package` WHERE `id`='".$pack_id ."' ";
        $pack_query= mysqli_query($con,$query);
         $pack_result=mysqli_num_rows($pack_query);
         if($pack_result>0)
         {
             //while($pack=mysqli_fetch_array($pack_query))
           //  {
                 $pack=mysqli_fetch_array($pack_query);
                
                  $data['pack']=$pack;
            // }
         }
         
       $query = "SELECT tbl_pack_paper.*, n.name as newspaper_name FROM tbl_pack_paper LEFT JOIN tbl_paper_city c ON c.id=tbl_pack_paper.paper_id LEFT JOIN tbl_newspapers n ON n.id=c.paper_id WHERE tbl_pack_paper.pack_id ='".$pack_id."'";
       	$result=mysqli_query($con,$query);
       	$rows=mysqli_num_rows($result);
       	if($rows>0){
       	   // while($pack_result=mysqli_fetch_array($result))
       	   // {
       	        $pack_result=mysqli_fetch_array($result);
       	        
       	         $data['pack_paper']=$pack_result;
       	    //}
       	}
         
       return $data;
    }



   echo json_encode($json);
  
?>