<?php //echo "<pre>"; echo "<br><br><br>Bill"; var_dump($bill);  echo "<br><br><br>bill details"; var_dump($bill_details); die;?>
<style>
    @media print {
        @page {
            size: letter;
            margin: 0cm;
        }
    }
</style>

<script>
    function goBack() {
        window.history.back();
    }
</script>
<div id="page-content" style="min-height: 1189px;">
    <div class="block full">
        <div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
            <div style="width:700px; background-color: #ffffff; border:0px; margin:0 auto; ">
                <img src=base_url().IMG ."favicon.png"></img>
                <table style="width:100%; margin-top:150px" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table style="width:100%;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td  style="width:66%;" ><b><?php echo $bill->client_name ."<br>". $bill->city;?> </b></td>				
                                    <td style="width:14%;"><b></b></td>
                                    <td style="width:20%;">City<?php echo $bill->city ?></td>
                                    <td style="width:20%;">State<?php echo $bill->state ?></td>
                                </tr>
                                <tr> <td style="width:14%;"><b>Address: <?php echo $bill->address ?></b></td>				
                                    <td style="width:14%;text-align:left;"><b>Bill No.</b></td>
                                    <td style="width:20%;text-align:left;">: <?php echo $bill->bill_no;?></td>
                                </tr>
                                <tr>
                                     <td style="width:20%;">City<?php echo $bill->city ?></td>				
                                    <td style="width:14%;text-align:left;"><b>Bill Date</b></td>
                                    <td style="width:20%;text-align:left;">: <?php $dt=new DateTime($bill->bill_date); echo $dt->format("d-M-Y");?></td>
                                </tr>
                                <tr>
                                     <td style="width:20%;">State<?php echo $bill->state ?></td>				
                                    <td style="width:14%;text-align:left;"><b>Due Date</b></td>
                                    <td style="width:20%;text-align:left;">: <?php $dt=new DateTime($bill->due_date); echo $dt->format("d-M-Y");?></td>
                                </tr>
                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td>
                            <table style="width:100%; border:0px; padding:1%; text-align:center;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th style="width:150px; border:1px solid #000;"> Publication</th>
                                    <th style="width:100px; border:1px solid #000;"> DOPS</th> 
                                    <th style="width:75px; border:1px solid #000;"> Position/Type</th> 
                                    <th style="width:50px; border:1px solid #000;"> Premimum</th>
                                    <th style="width:50px; border:1px solid #000;"> No.of Ins.</th>
                                    <th style="width:50px; border:1px solid #000;"> Scheme</th>
                                    <th style="width:50px; border:1px solid #000;"> Size</th>
                                    <th style="width:50px; border:1px solid #000;"> Rate</th>
                                    <th style="width:25px; border:1px solid #000;"> Discount(%)</th>
                                    <th style="width:50px; border:1px solid #000;"> Amount</th>
                                </tr>
                                <?php
                                $ro_id=63;
                                foreach($bill_details as $bill_detail){
                                //    if($ro_id==$bill_detail->ro_id){
                                       ?>  <tr style="border-bottom:1px solid #000;">
                                      
                               
                                    <td style="text-align:left;">
                                        <?php 
                                                echo $bill_detail->newspaper_name .", ";	  
                                        ?>					
                                    </td>
                                    <td style="border:0px solid #000; text-align:left;">
                                        <?php
                                                echo "(".$bill_detail->short_name .")";
                                                $dt=new DateTime($bill_detail->pub_date);
                                                echo $dt->format("d-M-Y")."<br>";	
                                        ?>
                                    </td>
                                    <td style="border:0px solid #000;">
                                    <?php
                                    //if($bill_detail->color=='C')echo "Color"; 
                                    //if($bill_detail->color=='B')echo "Black/White";
                                    ?>
                                    <?php 
                                    if ($bill_detail->type_id=='3'){echo $position[$bill_detail->heading];}
                                    if ($bill_detail->type_id=='1'){echo $cat[ $bill_detail->heading];}
                                    if ($bill_detail->type_id=='2'){echo $cat[ $bill_detail->heading];}
                                    ?>
                                    </td>
                                    <td style="border:0px solid #000;">
                                        <?php
                                            $premimum=explode(",",$bill_detail->premimum);
                                            if($premimum[0]>0 && $premimum[1]=="%"){
                                               // echo $premimum[0].$premimum[1]; 
                                            }
                                            if($premimum[0]>0 && $premimum[1]=="Rs"){
                                              //  echo $premimum[1].$premimum[0]; 
                                            }
                                            echo $bill_detail->premimum;
                                            
                                        ?></td>
                                    <td style="border:0px solid #000;"><?php echo 1;?></td>
                                    <td style="border:0px solid #000;"><?php echo $bill_detail->scheme_name;?></td>
                                    <td style="border:0px solid #000;"><?php echo $bill_detail->word_size;?></td>
                                    <?php 
                                        if($bill_detail->type_id=='1')
                                        {							
                                            $size=$bill_detail->word_size;
                                        }
                                        else
                                        {
                                            $s=explode("X",$bill_detail->word_size);
                                            $size=$s[0]*$s[1];
                                        }
                                        if(!empty($bill_detail->scheme))
                                        {
                                          echo $ $bill_detail->scheme;							
                                        }
                                        
                                    ?>
                                    <td style="border:0px solid #000;">
                                        <?php
                                        echo $bill_detail->rate;              
                                     ?></td>
                                      <td style="border:0px solid #000;">
                                        <?php	echo $bill_detail->dis_per; ?>
                                    </td>
                                    <td style="border:0px solid #000;">
                                        <?php	echo number_format((float)$bill_detail->net_amount, 2, '.', ''); ?>
                                    </td>
                            <?php    
                                    //($ro_id==$bill_detail->ro_id){
                                ?>  </tr> <?php
                                   // }
                                    $ro_id=$bill_detail->ro_id; }// }?>
                            </table>
                        </td>
                    </tr>
                </table>
                <table style="width:100%; margin-top:450px" cellpadding="0" cellspacing="0">
                    <tr style="border-bottom:1px solid #000;border-top:1px solid #000;">
                        <td>
                            <table style="width:100%;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width:66%;" ><b>Term and Condition:</b></td>				
                                    <td style="width:14%;text-align:left;"><b>Amount</b></td>
                                    <td style="width:20%;text-align:right;"> <?php echo number_format((float)$bill->amount-$bill->discount, 2, '.', '');?></td>
                                </tr>
                                <tr>
                                    <td style="width:66%;font-size:8px;" >1. FOR CASH PAYMENT INSIST FOR ORIGINAL RECEIPT " </td>
                                    <td style="width:14%;text-align:left;"><b>Box Charges</b></td>
                                    <td style="width:20%;text-align:right;"> <?php echo number_format((float)$bill->box_charges, 2, '.', '');?></td>
                                </tr>
                                <tr>
                                    <td style="width:66%;font-size:8px;" >2. The Cheque/D.D should be made in favour of AMSONS COMMUNICATIONS PVT. LTD. only</td>	
                                    <td style="width:14%;text-align:left;"><b>Total</b></td>
                                    <td style="width:20%;text-align:right;"> <?php echo number_format((float)$bill->total, 2, '.', '');?></td>
                                </tr>
                                <tr>
                                    <td style="width:66%;font-size:8px;" >3. If payment is not paid within 5 days from Rill Date, Interest @5% interest per month will be charged </td>
                                    <td style="width:14%;text-align:left;"><b>Art Work Charges</b></td>
                                    <td style="width:20%;text-align:right;"> <?= number_format((float)$bill->art_work_charges, 2, '.', '');?></td>
                                </tr>
                                <tr>
                                    <td style="width:66%;font-size:8px;" >4. All disputes re subjected to Chandigarh Jurisdiction </td>
                                    <td style="width:14%;text-align:left;"><b>Other Charges</b></td>
                                    <td style="width:20%;text-align:right;"><?= number_format((float)$bill->other_charges, 2, '.', '');?></td>
                                </tr>
                                <tr>
                                    <td style="width:66%;font-size:8px;" ></td>
                                    <td style="width:14%;text-align:left;"><b>CGST</b></td>
                                    <td style="width:20%;text-align:right;"><?= number_format((float)$bill->cgst, 2, '.', ''); ?></td>
                                </tr>
                                <tr>
                                    <td style="width:66%;font-size:8px;" ></td>
                                    <td style="width:14%;text-align:left;"><b>SGST</b></td>
                                    <td style="width:20%;text-align:right;"> <?= number_format((float)$bill->sgst, 2, '.', ''); ?></td>
                                </tr>

                                <tr>
                                    <td style="width:66%;font-size:8px;" ></td>
                                    <td style="width:14%;text-align:left;"><b>IGST</b></td>
                                    <td style="width:20%;text-align:right;"><?= number_format((float)$bill->igst, 2, '.', ''); ?></td>
                                </tr>
                                <tr style="font-size:16px ;">
                                    <td style="width:56%;" >CHECKED BY</td>
                                    <td style="width:24%; text-align:left;"><b>Payable Amount</b></td>
                                    <td style="width:20%; text-align:right;"><?php echo number_format((float)$bill->net_amount, 2, '.', '');?></td>
                                <tr style="font-size:12px ; text-align:right;">
                                    <td colspan="3"><b>Amount in words: </b><?php echo $amount_words; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                        </td>
                    </tr>
                </table>
                <br>
                <input id="printpagebutton" type="button" value="Print Bill" onclick="printpage()"/>
                	<a class="" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/Pdf1_bill/index/<?php echo $bill->id;
								?>" data-original-title="Save Ro As PDF">
									<span class='label label-info'>Save PDF </span>
								</a>
            </div>
        </div>
        <!-- END All Products Content -->
    </div>
    <!-- END All Products Block -->
</div>