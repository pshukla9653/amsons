<?php 
class Pdf_ro extends CI_Controller{
      function __construct() { 
 parent::__construct();
 } 
     function index($id)
	{ 
		$book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, d.name as city_name,  u.email, u.mobile, u.client_name d.city FROM tbl_book_ads
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
INNER JOIN tbl_cities d ON d.id=tbl_book_ads.city

INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id = '".$id."'" );
	//INNER JOIN tbl_employee e ON e.e_id=tbl_book_ads.e_id			
		$a= $book_ads->result();
		$book_ad=$a[0];	
		
		$ads_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop
INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_id = '".$id."'" );
		
		$ad_dops=$ads_dop->result();
		
		$publish_date="";
		
		foreach($ad_dops as $ad_dop)
		{
			//$publish_date=$publish_date.($ad_dop->newspaper_name ." :- ".$ad_dop->dop ." .<br>");
			$publish_date=$publish_date.($ad_dop->dop ." .<br>");
		}
		
		/*
		$book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name, u.email, u.mobile, u.client_name FROM tbl_book_ads
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id
INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.id = '".$id."'"  );
		
		$a= $book_ads->result();
		$book_ad=$a[0];
		*/
		
		
		$a=545;
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
// set document information
//s$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('invoice');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
$img=base_url().IMG ."favicon.png";
$pdf->setJPEGQuality(75);
$pdf->SetXY(5,10);
$pdf->Image($img, '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);



$img=base_url().IMG ."address.png";
$pdf->setJPEGQuality(75);
$pdf->SetXY(120,10);
$pdf->Image($img, '', '', 70, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
// create some HTML content

$pdf->SetFont('helvetica', '', 8);

$tbl = <<<EOD
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br>
<table width="585" height="200" border="0">
      <tr>
        <td width="70">Ro No : $book_ad->ro_no</td>
        <td width="180">&nbsp;</td>
        <td width="128">Release Order : $book_ad->type_name</td>
        <td width="46">&nbsp;</td>
        <td width="127">Ro Date : date('Y-m-d',strototime($book_ad->c_date))</td>
      </tr>
      <tr>
        <td align="right"><strong>To </strong>,</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp; </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;    </td>
        <td><strong>The Advertising Manager,</strong><br>
    		<strong> $book_ad->newspaper_name </strong><br>
    		<strong> $book_ad->city_name </strong></tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
</table>

<br></br>
<br></br>
<br></br>

<table width="550" height="200" border="1" table-layout: fixed;>
  <tr>
          <td>
                <table width="545" height="200" border="0">
                  <tr>
                    <td width="60"><strong> Client </strong></td>
                    <td width="168"><p>: $book_ad->client_name </p></td>
                    <td width="107"><strong>NO of ins : </strong> $book_ad->insertion</td>
                    <td width="54">&nbsp;</td>
                    <td width="122"><strong>Scheme </strong> none</td>
                  </tr>
                  <tr>
                    <td><strong>&nbsp;</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp; </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><strong> Type </strong></td>
                    <td>: $book_ad->type_name</td>
                    <td><strong> Caption </strong></td>
                    <td colspan="2">: $book_ad->cat_name</td>
                  </tr>
                  <tr>
                    <td><strong> Package </strong></td>
                    <td>:&nbsp;</td>
                    <td><strong> Box Charges </strong></td>
                    <td colspan="2">: None</td>
                  </tr>
                  <tr>
                    <td><strong> Premium </strong></td>
                    <td>: None</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
        </td>
  </tr>
</table>
<table width="584" height="90" border="1">
      <tr>
        <td width="121"><strong>Publications</strong></td>
        <td width="81" align="center"><strong>DOPS</strong></td>
        <td width="134" align="center"><strong>SIZE </strong></td>
        <td width="130" align="center"><strong>Rate </strong></td>
        <td  align="center" width="84"><strong>Add on Rate</strong></td>
      </tr>
      foreach($ad_dops as $ad)
      {
      <tr>
        <td>$ad->newspaper_name</td>
        <td align="center">$ad->dop</td>
        <td align="center">$book_ad->size_words</td>
        <td align="center">$ad->price</td>
        <td align="center">$ad->eprice</td>
      </tr>
      }
      <tr>
        <td colspan="3" align="right">
        	<table width="315" border="0">
                  <tr>
                    <td width="54" align="right" valign="middle"><strong> Material : </strong></td>
                    <td width="245" align="left" valign="middle"> $book_ad->content </td>
                  </tr>
            </table>
	
	    </td>
        <td colspan="2" align="center"><strong> RO Amount : </strong>$book_ad->ad_cost/-</td>
      </tr>
</table>
<table width="550" height="200" border="1">
      <tr>
        <td>
    		<strong>Remarks :</strong> Best Position requested
    		<pre>
    		
    		
    		
    		
    		</pre>
    		<strong> For Amsons Communication PVT.LTD.</strong>
    		<pre>
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		</pre>
    	</td>
      </tr>
  
</table>


EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// move pointer to last page


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('amsons_invoice.pdf', 'I');

	}


     function all()
	{
		for($id=$_POST['from'];$id<$_POST['to'];$id++){
		$book_ads = $this->db->query("SELECT tbl_book_ads.*, n.name as newspaper_name, t.name as type_name, c.name as cat_name,  u.email, u.mobile, u.client_name FROM tbl_book_ads
INNER JOIN tbl_newspapers n ON n.id=tbl_book_ads.newspaper_id
INNER JOIN tbl_news_type t ON t.id=tbl_book_ads.type_id
INNER JOIN tbl_categories c ON c.id=tbl_book_ads.cat_id

INNER JOIN tbl_client u ON u.id=tbl_book_ads.u_id WHERE tbl_book_ads.ro_no = '".$id."' and tbl_book_ads.work_year='".$_SESSION['work_year']."'" );
	//INNER JOIN tbl_employee e ON e.e_id=tbl_book_ads.e_id			
		$a= $book_ads->result();
		$book_ad=$a[0];	
		
		$ads_dop = $this->db->query("SELECT tbl_ro_dop.*, n.name as newspaper_name FROM tbl_ro_dop
INNER JOIN tbl_paper_city pc ON pc.id=tbl_ro_dop.paper_id
INNER JOIN tbl_newspapers n ON n.id=pc.paper_id WHERE tbl_ro_dop.ro_no = '".$id."' and tbl_ro_dop.work_year='".$_SESSION['work_year']."'" );
		
		$ad_dops=$ads_dop->result();
		$publish_date="";
		
		foreach($ad_dops as $ad_dop)
		{
			//$publish_date=$publish_date.($ad_dop->newspaper_name ." :- ".$ad_dop->dop ." .<br>");
			$publish_date=$publish_date.($ad_dop->dop ." .<br>");
		}
		
		
		
		$a=545;
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
// set document information
//s$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('invoice');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
$img=base_url().IMG ."favicon.png";
$pdf->setJPEGQuality(75);
$pdf->SetXY(5,10);
$pdf->Image($img, '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);



$img=base_url().IMG ."address.png";
$pdf->setJPEGQuality(75);
$pdf->SetXY(120,10);
$pdf->Image($img, '', '', 70, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
// create some HTML content

$pdf->SetFont('helvetica', '', 8);

$tbl .= <<<EOD
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br>
<table width="585" height="200" border="0">
      <tr>
        <td width="70">Ro No : $book_ad->ro_no</td>
        <td width="180">&nbsp;</td>
        <td width="128">Release Order : $book_ad->type_name</td>
        <td width="46">&nbsp;</td>
        <td width="127">Ro Date : date('Y-m-d',strtotime($book_ad->c_date))</td>
      </tr>
      <tr>
        <td align="right"><strong>To </strong>,</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp; </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;    </td>
        <td><strong>The Advertising Manager,</strong><br>
    		<strong>The $book_ad->newspaper_name </strong><br>
    		<strong>$book_ad->city</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
</table>

<br></br>
<br></br>
<br></br>

<table width="550" height="200" border="1" table-layout: fixed;>
  <tr>
          <td>
                <table width="545" height="200" border="0">
                  <tr>
                    <td width="60"><strong> Client </strong></td>
                    <td width="168"><p>: $book_ad->client_name </p></td>
                    <td width="107"><strong>NO of ins : </strong> $book_ad->insertion</td>
                    <td width="54">&nbsp;</td>
                    <td width="122"><strong>Scheme </strong> none</td>
                  </tr>
                  <tr>
                    <td><strong>&nbsp;</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp; </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><strong> Type </strong></td>
                    <td>: $book_ad->type_name</td>
                    <td><strong> Caption </strong></td>
                    <td colspan="2">: $book_ad->cat_name</td>
                  </tr>
                  <tr>
                    <td><strong> Package </strong></td>
                    <td>:&nbsp;</td>
                    <td><strong> Box Charges </strong></td>
                    <td colspan="2">: None</td>
                  </tr>
                  <tr>
                    <td><strong> Premium </strong></td>
                    <td>: None</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
        </td>
  </tr>
</table>
<table width="584" height="90" border="1">
      <tr>
        <td style="padding-left:30px;text-align:center;"  width="121" align="center"><strong>Publications</strong></td>
        <td style="padding-left:30px;text-align:right;" width="81" align="center"><strong>DOPS</strong></td>
        <td style="padding-left:30px;text-align:right;" width="134" align="center"><strong>SIZE </strong></td>
        <td style="padding-left:30px;text-align:right;" width="130" align="center"><strong>Rate </strong></td>
        <td  style="padding-left:30px;text-align:right;" align="center" width="84"><strong>Add on Rate</strong></td>
      </tr>
EOD;
      foreach($ad_dops as $ad)
      {
 $tbl .= <<<EOD
     <tr>
        <td align="center">$ad->newspaper_name</td>
        <td align="center">$ad->dop</td>
        <td align="center">$book_ad->size_words</td>
        <td align="center">$ad->price</td>
        <td align="center">$ad->eprice</td>
      </tr>
EOD;
      }
$tbl .= <<<EOD
 <tr>
				<td  style="border-top:1px solid #000"><strong><b>Material:</b></strong>.</td>
				<td  colspan="2" style="border-top:1px solid #000; border-right:1px solid #000;"> $book_ad->content; </td>
				<td colspan="2"  style="border-top:1px solid #000; padding-left:10px;  solid #000;">
				    <table cellpadding="0" cellspacing="0" >
				        <tr>
				            <td><b>TOTAL: </b></td>
				            <td style="text-align:left;">  $book_ad->t_amount<br/></td>
				        </tr>
				        <tr>
				            <td><b>Discount( $book_ad->dis_per;%): </b> </td>
				            <td style="padding-left:30px;text-align:left;"> $book_ad->discount<br/></td>
				        </tr>
				        <tr>
				            <td><b>CGST</b> </td>
				            <td style="padding-left:30px;text-align:left;"> $book_ad->cgst<br/></td>
				        </tr>
				        <tr>
				            <td><b>SGST</b> </td>
				            <td style="padding-left:30px;text-align:left;"> $book_ad->sgst<br/></td>
				        </tr>
				        <tr>
				            <td><b>IGST: </b></td>
				            <td style="padding-left:30px;text-align:left;"> $book_ad->igst<br/></td>
				        </tr>
				        <tr>
				            <td><b>RO AMOUNT: </b> </td>
				            <td style="padding-left:30px;text-align:left;"> $book_ad->p_amount<br/></td>
				        </tr>
				    </table>
				</td>
				</tr>
</table>
<table width="550" height="200" border="1">
      <tr>
        <td>
    		<strong>Remarks :</strong> Best Position requested
    		<pre>
    		
    		
    		
    		
    		</pre>
    		<strong> For amsons communication PVT.LTD.</strong>
    		<pre>
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		</pre>
    	</td>
      </tr>
  
</table>


EOD;



	}
	
	$pdf->writeHTML($tbl, true, false, false, false, '');
// move pointer to last page


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('amsons_invoice.pdf', 'I');
	}

} 
?>