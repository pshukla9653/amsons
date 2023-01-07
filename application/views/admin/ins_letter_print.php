<style>
 @media print {
    @page {
        size: letter;
        margin: 0cm;
   }
    }
}


</style>

<script>
function goBack() {
    window.history.back();
}
</script>


<?php //echo var_dump($ins_letter); ?>


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

<table style="width:100%; margin-top:150px" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table style="width:100%;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:33.3%"></td>
				<td style="width:33.3%; text-align:center;">Insertion Letter</td>
				<td style="width:33.3%;text-align:right;">Date: <?php echo $ins_letter->c_date; ?></td>
			</tr>
		</table>
		
		</td>
	</tr>
	<tr>
		<td>
		<table style="width:100%;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:97%; padding-left:3%;">To</td>				
			</tr>
			<tr>
				<td style="width:100%">
					<span style="width:90%; float:left;padding-left:6%;">The advertising Manager</span>
					<span style="width:90%; float:left;padding-left:6%;">The <?php echo $ins_letter->newspaper_name ;?></span>
					<span style="width:90%; float:left;padding-left:6%;">
					<?php echo $ins_letter->city_name ;?>
					</span>				
				</td>				
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table style="width:100%;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:97%; padding-left:3%;">Subject : NEW INSERTION(s)DATE(s)</td>				
			</tr>
			<tr>
				<td style="width:100%">					
					<span style="width:90%; float:left;padding-left:6%;">This is Ref to our RO.NO.: <?php echo $ins_letter->ro_no ;?> Dated :<?php echo $ins_letter->ro_date ;?>. Details of Which given below. </span>							
				</td>				
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; border-bottom:none; padding:1%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:10%">Client:</td>
					<td style="width:35%"><?php echo $ins_letter->client_name ; echo "<br>".$ins_letter->client_city ;?></td>
					<td style="width:15%">Insertion No:</td>
					<td style="width:40%"><?php echo $ins_letter->client_name ; echo "<br>".$ins_letter->client_city ;?></td>					
				</tr>
				
			</table>
		</td>
	
	</tr>
	<tr>
		<td>
		<table style="width:100%; border:1px solid #000; padding:1%; border-top:none;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:10%">Type:</td>
					<td style="width:35%"><?php echo ($ins_letter->color=='C')?"Color":"B/W";?></td>
					<td style="width:15%">Position:</td>
					<td style="width:40%"><?php echo $ins_letter->heading ; ?></td>					
				</tr>
				<tr>
					<td style="width:10%">Package:</td>
					<td style="width:35%"><?php echo $ins_letter->package;?></td>
					<td style="width:15%">Box Charges:</td>
					<td style="width:40%"><?php echo $ins_letter->box_charge ; ?></td>					
				</tr>
			</table>
		
		</td>
	</tr>
	
	
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; padding:1%; text-align:left;" cellpadding="0" cellspacing="0">
			  <tr>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">Publications</th>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">Last DOP</th> 
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">DOPS</th> 
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">SIZE</th>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">Rate</th>					
			  </tr>
			  <?php foreach($ins_dops as $ins_dop)
						{							
				?>
				  <tr>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php echo $ins_dop->newspaper_name;?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">
					<?php echo $ins_dop->last_dop; ?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">
					<?php echo $ins_dop->dops; ?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php 
					if($ins_letter->newspaper_id==$ins_dop->paper_id)
						echo $ins_letter->size_words;					
					?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php 
					if($ins_letter->newspaper_id==$ins_dop->paper_id)
					echo $ins_letter->ex_price." /-";?></td>					
				  </tr>
				<?php   } ?>
			   <!--<tr>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">Tribute classfied plus</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">23-oct-16</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">29 word</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">18/-per word</td>
					<td style="border-top:1px solid #000;width:139px; padding-left: 10px;">5</td>
			  </tr>-->
			   
			
 
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; padding:1%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:100%">
					<span style="width:90%; float:left;">Material:</strong> <?php echo $ins_letter->material;?></span>					
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
					<span style="width:90%; float:left;">Remarks:</strong> <?php echo $ins_letter->remark;?></span>					
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
					<span style="width:90%; float:left;">Under Scheme:</strong> <?php echo $ins_letter->scheme;?></span>
					<span style="width:90%; float:left; margin-top:100px;"><strong> For amsons communication PVT.LTD.</strong> </span>
					</td>					
				</tr>				
			</table>
		</td>
	</tr>
	
</table>

<br>

<input id="printpagebutton" type="button" value="Print Letter" onclick="printpage()"/>
<!--<input id="goback" type="button" value="Go Back" onclick="goBack()"/>-->
</div>			
				
			
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>