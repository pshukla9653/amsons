<style>
 @media print {
    @page {
        //size: letter;
        //margin: 0cm;
        size: auto;   /* auto is the initial value */
    size: A4 portrait;
    margin: 0;  /* this affects the margin in the printer settings */
    border: 1px solid red; 
   }
    }
}


</style>

<script>
function goBack() {
    window.history.back();
}
</script>


<?php //echo var_dump($book_ad); ?>


<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	
	<!-- END Quick Stats -->
	<!-- All Products Block -->
	<div class="block full">
		<!-- All Products Title -->
		
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			
<div style="width:700px; background-color: #ffffff; border:0px; margin:0 auto; ">
<div id="ro_print">
<table style="width:100%; margin-top:150px" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table style="width:100%;" cellpadding="0" cellspacing="0">
		    <tr>
				<td style="width:33.3%"></td>
				<td style="width:33.3%; text-align:center;"><b>Release Order</b></td>
				<td style="width:33.3%;text-align:right;">
				</td>
			</tr>
			<tr>
				<td style="width:33.3%"><b>Ro No: </b><?php echo $book_ad->ro_no; ?></td>
				<td style="width:33.3%; text-align:center;"><b> <?php echo $book_ad->type_name;?></b></td>
				<td style="width:33.3%;text-align:right;"><b>Ro Date:</b> 
				<?php
					$createDate = new DateTime($book_ad->c_date);
					echo $createDate->format('Y-m-d'); 
				?>
				</td>
			</tr>
		</table>
		
		</td>
	</tr>
		<tr>
			  <td><br/></td>  
			</tr>
	<tr>
		<td>
		<table style="width:100%;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:97%; padding-left:3%;"><b>To</b></td>				
			</tr>
		
			<tr>
				<td style="width:100%">
					<span style="width:90%; float:left;padding-left:6%;"><b>The advertising Manager</b></span>
					<span style="width:90%; float:left;padding-left:6%;"><b>The <?php echo $book_ad->newspaper_name ;?></b></span>
					<span style="width:90%; float:left;padding-left:6%;">
				<b>	<?php echo $book_ad->city_name ;?></b>
					</span>				
				</td>				
			</tr>
		</table>
		</td>
	</tr>
		<tr>
			  <td><br/></td>  
			</tr>
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; border-bottom:none; padding:1%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:33.3%"><b>Client: </b>&nbsp;&nbsp;&nbsp;<?php echo $book_ad->client_name ;?></td>
					<td style="width:33.3%; text-align:center;"><b>No of ins:</b><?php echo $book_ad->insertion ;?></td>
					<td style="width:33.3%;text-align:right;"><b>Scheme :</b><?php echo $book_ad->scheme_name ;?></td>
				</tr>
				
			</table>
		</td>
	
	</tr>
	<tr>
		<td>
		<table style="width:100%; border:1px solid #000; padding:1%; border-top:none;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:50%">
					<span style="width:90%; float:left;"><b>Type:</b> <?php echo $book_ad->type_name;?></span>
					<span style="width:90%; float:left;"><b>Package:</b></span>
					<span style="width:90%; float:left;"><b>Caption:</b> <?php echo $book_ad->cat_name;?></span>
									
					</td>
					
					<td style="width:50%;text-align:right;">
					<span style="width:90%; float:left;"><b>Premium</b> :<?php if($book_ad->premimum) {echo $book_ad->p_type;}else{echo "None";}?></span>
					<span style="width:90%; float:left;"><b>Box Changes</b> : <?php if($book_ad->box_charge) {echo $book_ad->box_charge;}else{echo "None";}?></span>
				
					
					</td>
				</tr>
				
			</table>
		
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; padding:0%; text-align:left;" cellpadding="0" cellspacing="0">
			  <tr>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;"><b>Publications</b></th>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;"><b>DOPS</b></th> 
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;"><b>SIZE</b></th>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;"><b>Rate</b></th>
					<th style="width:139px; padding-left: 10px;"><b>Add on rate</b></th>
			  </tr>
			 <?php foreach($paper as $pp)
						{							
				?>
				  <tr>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php echo $pp->newspaper_name;?></td>
						<td style="border-top:1px solid #000;width:600px; border-right:1px solid #000;padding-left: 10px;">
					  <?php foreach($ad_dops as $ad_dop)
						{			if($pp->paper_id==$ad_dop->paper_id){					
				?>
				
					<?php $d=date_create($ad_dop->dop) ;
					
					echo date_format($d,'d-M-Y').','; ?>
						<?php }  } ?>
						</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php 
					if($book_ad->newspaper_id==$pp->paper_id)
						echo $book_ad->size_words;					
					?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php 
								if($book_ad->newspaper_id==$pp->paper_id)		echo $book_ad->ex_price." /-";?></td>
					<td style="border-top:1px solid #000;width:139px; padding-left: 10px;"><?php 
					if($book_ad->newspaper_id!=$pp->paper_id)
					echo (($book_ad->add_on_a/$book_ad->size_words)/ $book_ad->paid )." /-";?></td>
				  </tr>
				<?php   } ?>
			   <!--<tr>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">Tribute classfied plus</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">23-oct-16</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">29 word</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">18/-per word</td>
					<td style="border-top:1px solid #000;width:139px; padding-left: 10px;">5</td>
			  </tr>-->
			   <tr>
				<td  style="border-top:1px solid #000"><strong><b>Material:</b></strong>.</td>
				<td  colspan="2" style="border-top:1px solid #000; border-right:1px solid #000;"><?php echo $book_ad->content;?> </td>
				<td colspan="2"  style="border-top:1px solid #000; padding-left:10px;  solid #000;">
				    <table style="width:100%; border:0px solid #000; padding:1%;" cellpadding="0" cellspacing="0" >
				        <tr>
				            <td><b>TOTAL: </b></td>
				            <td style="text-align:right;"> <?php echo number_format((float)$book_ad->t_amount, 2, '.', '');?><br/></td>
				        </tr>
				        <tr>
				            <td><b>Discount(<?php echo $book_ad->dis_per;?>%): </b> </td>
				            <td style="padding-left:30px;text-align:right;"><?php echo number_format((float)$book_ad->discount, 2, '.', '');?><br/></td>
				        </tr>
				        <tr>
				            <td><b>CGST(2.5%): </b> </td>
				            <td style="padding-left:30px;text-align:right;"><?php echo number_format((float)$book_ad->cgst, 2, '.', '');?><br/></td>
				        </tr>
				        <tr>
				            <td><b>SGST(2.5%) </b> </td>
				            <td style="padding-left:30px;text-align:right;"><?php echo number_format((float)$book_ad->sgst, 2, '.', '');?><br/></td>
				        </tr>
				        <tr>
				            <td><b>IGST: </b></td>
				            <td style="padding-left:30px;text-align:right;"><?php echo number_format((float)$book_ad->igst, 2, '.', '');?><br/></td>
				        </tr>
				        <tr>
				            <td><b>RO AMOUNT: </b> </td>
				            <td style="padding-left:30px;text-align:right;"><?php echo number_format((float)$book_ad->p_amount, 2, '.', '');?><br/></td>
				        </tr>
				    </table>
				</td>
				</tr>
			
 
			</table>
		</td>
	</tr>
	<tr>
	<td>
			<table style="width:100%; border:1px solid #000; padding:1%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:100%">
					<span style="width:90%; float:left; margin-left:10px;"><b>Remarks:</b></strong> <?php echo $book_ad->remark;?></span>
					<span style="width:90%; float:left; margin-top:100px; margin-left:10px;"><strong><b> For amsons communication PVT.LTD.</b></strong> </span>
					<span style="width:90%; float:left; margin-top:100px; margin-left:10px;"><strong><b> Media Manager</b></strong> </span>
					<span style="width:90%; float:left; margin-top:100px; margin-left:10px;"><strong><b> </b></strong> </span>
					</td>					
				</tr>				
			</table>
	</td>
	</tr>
	
</table>

<br>
</div>
<input id="printpagebutton" type="button" value="Print Ro" onclick="printdiv()"/>
<!--<input id="goback" type="button" value="Go Back" onclick="goBack()"/>-->
</div>			
				
			
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>
	<script>function printdiv()
{
    //your print div data
    //alert(document.getElementById("printpage").innerHTML);
    var newstr=document.getElementById("ro_print").innerHTML;

    var header='<header><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><div align="center"><h3 style="color:#EB5005"> Your HEader </h3></div><br></header><hr><br>'

    //var footer ="Your Footer";

    //You can set height width over here
    var popupWin = window.open('', '_blank', 'width=1100,height=600');
    popupWin.document.open();
    popupWin.document.write('<html> <body onload="window.print()">'+ newstr + '</html>' );
    popupWin.document.close(); 
    return false;
}</script>