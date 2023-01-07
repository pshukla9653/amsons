<?php 
class Pdf1_bill extends CI_Controller{
      function __construct() { 
 parent::__construct();
 } 
 	public function get_words($a)
	{	
		$q = strstr ( $a, '.' );
		$x=0;
		if(!empty($q))
		{
			$x=$q['1'].$q['2'];
		}
		$x=(int)$x;
		$y = floor($a);	
		
		//var_dump($y);
		
		//var_dump($x);
		
		
		$result=$this->convert_number_to_words($y)." Rupees";
		
		if(!empty($a=$this->convert_number_to_words($x)))
			$result=$result." AND ".$a." Paise";
		
		return $result;	
	}
	
	
	public function convert_number_to_words($number) 
	{

		//$number = 168201.26;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  return $result;		
}
     function index($id)
	{
	    	$query = $this->db->query("SELECT tbl_bill.*, c.city, c.client_name FROM tbl_bill
		INNER JOIN tbl_client c ON c.id=tbl_bill.client_id WHERE tbl_bill.id ='".$id."'" );
		$bill= $query->row();
		
		$amount=number_format((float)$bill->net_amount, 2, '.', '');
		$amount_words = $this->get_words($amount); 
		
		$query = $this->db->get_where('tbl_bill_taxes', array('bill_id' => $id));
		$bill_taxes= $query->result();
		
		$bill_detail = $this->db->query("SELECT tbl_bill_details.*, n.name as newspaper_name,n.short_name,ng.ng_name,ba.type_id,ba.color, p.position,s.scheme_name FROM tbl_bill_details
		INNER JOIN tbl_paper_city pc ON pc.id=tbl_bill_details.paper
		INNER JOIN tbl_newspapers n ON n.id=pc.paper_id
		INNER JOIN tbl_news_group ng ON ng.ng_id=n.g_id
		INNER JOIN tbl_book_ads ba ON ba.id=tbl_bill_details.ro_id
		LEFT JOIN tbl_position p ON p.id=tbl_bill_details.heading
		LEFT JOIN tbl_paper_scheme s ON s.id=tbl_bill_details.scheme
		WHERE tbl_bill_details.bill_id='".$id."'" );
		//LEFT JOIN tbl_premimum pr ON pr.id=tbl_bill_details.premium
        
		//echo $this->db->last_query(); die;
		
        $bill_details=$bill_detail->row();
		//var_dump($data['bill_details']); die;
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
<table width="585" height="192" border="0">
                    <tr>
                        <td>
                            <table >
                                <tr>
                                    <td rowspan="4"  ><b> $bill->client_name ."<br>". $bill->city </b></td>				
                                    <td ><b>Service No.</b></td>
                                    <td >: AAJCA5752HSD002</td>
                                </tr>
                                <tr>				
                                    <td ><b>Bill No.</b></td>
                                    <td >:$bill->id</td>
                                </tr>
                                <tr>	
                               
                                    <td ><b>Bill Date</b></td>
                                    <td >:$bill->date </td>
                                </tr>
                                <tr>				
                                    <td ><b>Due Date</b></td>
                                    <td >:  $bill->due_date</td>
                                </tr>
                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td>
                            <table >
                                <tr>
                                    <th > Publication</th>
                                    <th > DOPS</th> 
                                    <th > Position/Type</th> 
                                    <th > Premimum</th>
                                    <th > No.of Ins.</th>
                                    <th > Scheme</th>
                                    <th > Size</th>
                                    <th > Rate</th>
                                    <th > Amount</th>
                                </tr>
                                
                               <tr>
                               
                                    <td style="text-align:left;">
                                         
                                                 $bill_details->newspaper_name	  
                                      				
                                    </td>
                                    <td >
                                        
                                                 $bill_details->pub_date
                                               "<br>";	
                                        
                                    </td>
                                    <td >
                                    
                                   $bill_details->position
                                    </td>
                                    <td >
                                        
                                           $bill_details->premimum
                                           
                                        </td>
                                    <td >  $bill_details->insertion</td>
                                    <td >  $bill_details->scheme_name</td>
                                    <td >  $bill_details->word_size</td>
                                     
                                    <td >
                                        
                                     $bill_details->rate
                                     </td>
                                    <td >
                                       $bill_details->amount 	
                                    </td>
                                
                                   
                                  </tr> 
                                   
                            </table>
                        </td>
                    </tr>
                </table>
                <br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br><br></br>
<br></br>

                <table >
                    <tr >
                        <td>
                            <table >
                                <tr>
                                    <td ><b>Term and Condition:</b></td>				
                                    <td ><b>Amount</b></td>
                                    <td >$bill->amount-$bill->discount</td>
                                </tr>
                                <tr>
                                    <td  >1. FOR CASH PAYMENT INSIST FOR ORIGINAL RECEIPT " </td>
                                    <td ><b>Box Charges</b></td>
                                    <td >$bill->box_charges</td>
                                </tr>
                                <tr>
                                    <td >2. The Cheque/D.D should be made in favour of AMSONS COMMUNICATIONS PVT. LTD. only</td>	
                                    <td ><b>Total</b></td>
                                    <td > $bill->total</td>
                                </tr>
                                <tr>
                                    <td  >3. If payment is not paid within 5 days from Rill Date, Interest @5% interest per month will be charged </td>
                                    <td ><b>Art Work Charges</b></td>
                                    <td > $bill->art_work_charges</td>
                                </tr>
                                <tr>
                                    <td  >4. All disputes re subjected to Chandigarh Jurisdiction </td>
                                    <td ><b>Other Charges</b></td>
                                    <td >$bill->other_charges</td>
                                </tr>
                                <tr>
                                    <td ></td>
                                    <td ><b>CGST</b></td>
                                    <td >$bill->cgst</td>
                                </tr>
                                <tr>
                                    <td  ></td>
                                    <td ><b> $bill->sgst </td>
                                </tr>

                                <tr>
                                    <td  ></td>
                                    <td ><b>IGST</b></td>
                                    <td > $bill->igst</td>
                                </tr>
                                <tr >
                                    <td  >CHECKED BY</td>
                                    <td ><b>Payable Amount</b></td>
                                    <td >$bill->net_amount</td>
                                </tr>
                                <tr >
                                    <td colspan="3"><b>Amount in words: </b>$amount_words</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                        </td>
                    </tr>
                </table>
                <br>

EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// move pointer to last page


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('amsons_invoice.pdf', 'I');

	}
	
}

?>