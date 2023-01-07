<style>
 @media print {
    @page {
        size: letter;
        margin: 0cm;
   }
    }
}
</style>
<div id="page-content" style="min-height: 1189px;">
	<!-- Quick Stats -->
	
	<!-- END Quick Stats -->
	<!-- All Products Block -->
	<div class="block full">
		<!-- All Products Title -->
		
		<!-- END All Products Title -->
		<!-- All Products Content -->
		<div id="ecom-products_wrapper" class="dataTables_wrapper form-inline no-footer">
			
<div style="width:700px; margin:0 auto;">

<table style="width:100%; margin-top:150px" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table style="width:100%;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:33.3%">Ro No: <?php echo $book_ro->id; ?></td>
				<td style="width:33.3%; text-align:center;">Release Order: FM RO</td>
				<td style="width:33.3%;text-align:right;">Ro Date: <?php echo date('d-m-Y',strtotime($book_ro->ro_date)); ?></td>
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
					<span style="width:90%; float:left;padding-left:6%;">The <?php echo $book_ro->group_name ;?></span>
					<span style="width:90%; float:left;padding-left:6%;">
					<?php echo $book_ro->city ;?>
					</span>
				
				</td>				
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; border-bottom:none; padding:1%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:33.3%">Client: <?php echo $book_ro->client_name;?></td>
					<td style="width:33.3%; text-align:center;">No of ins:0</td>
					<td style="width:33.3%;text-align:right;">Scheme :none</td>
				</tr>
				
			</table>
		</td>
	
	</tr>
	<tr>
		<td>
		<table style="width:100%; border:1px solid #000; padding:1%; border-top:none;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:50%">
					<span style="width:90%; float:left;">Type: FM</span>
					<span style="width:90%; float:left;">Package:</span>
					<span style="width:90%; float:left;">Caption: </span>
									
					</td>
					
					<td style="width:50%;text-align:right;">
					<span style="width:90%; float:left;">Premium : None</span>
					<span style="width:90%; float:left;">Box Changes : None</span>
				
					
					</td>
				</tr>
				
			</table>
		
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%; border:1px solid #000; padding:1%; text-align:left;" cellpadding="0" cellspacing="0">
			  <tr>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">FM Channel</th>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">DOPS</th> 
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">Total Second</th>
					<th style="width:139px; border-right:1px solid #000;padding-left: 10px;">Rate</th>
					<th style="width:139px; padding-left: 10px;">Add on rate</th>
			  </tr>
				  <tr>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php echo $book_ro->channel_name;?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php echo date('d-m-Y',strtotime($book_ro->date_from))." To<br>".date('d-m-Y',strtotime($book_ro->date_to)) ;?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php echo $book_ro->total_sec;?></td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;"><?php echo $book_ro->rate_per_10;?>/10 Second</td>
					<td style="border-top:1px solid #000;width:139px; padding-left: 10px;">-</td>
				  </tr>
			   <!--<tr>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">Tribute classfied plus</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">23-oct-16</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">29 word</td>
					<td style="border-top:1px solid #000;width:139px; border-right:1px solid #000;padding-left: 10px;">18/-per word</td>
					<td style="border-top:1px solid #000;width:139px; padding-left: 10px;">5</td>
			  </tr>-->
			   <tr>
				<td  style="border-top:1px solid #000"><strong>Material:</strong>.</td>
				<td  colspan="3" style="border-top:1px solid #000; border-right:1px solid #000;"><?php echo $book_ro->material;?> </td>
				<td  style="border-top:1px solid #000; padding-left:10px;">RO AMOUNT:  <?php echo $book_ro->amount;?></td>
				</tr>
			
 
			</table>
		</td>
	</tr>
	<tr>
	<td>
			<table style="width:100%; border:1px solid #000; padding:1%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:100%">
					<span style="width:90%; float:left;">Remarks:</strong> <?php echo $book_ro->remark;?></span>
					<span style="width:90%; float:left; margin-top:100px;"><strong> For amsons communication PVT.LTD.</strong> </span>
					</td>					
				</tr>				
			</table>
	</td>
	</tr>
	
</table>

<br>

<input id="printpagebutton" type="button" value="Print Ro" onclick="printpage()"/>
</div>	
			</div>
			<!-- END All Products Content -->
		</div>
		<!-- END All Products Block -->
	</div>