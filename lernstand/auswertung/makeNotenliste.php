<?php include "../auth.php"; 
		include('../db_conn.php');
		require_once('tcpdf/tcpdf.php');
ob_clean();
$style1 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$style2 = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		
$meineSchueler_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$_SESSION['myclass']."' ORDER BY lastname");
 
class MYPDF extends TCPDF {
	
    //Page header
    public function Header() {
    
        // Title
        $this->SetXY(25,15);
        $this->SetFont('helvetica', 'I', 14);
      //  $this->Cell(0, 15, 'Klassenliste der '.$_SESSION['myclass'], 0, 0, 'L', 0, '', 0, false, 'C', 'C');
      //  $this->Cell(0, 15, 'Datum: '.$_SESSION['datum'] , 0, 1, 'R', 0, '', 0, false, 'C', 'C');
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
       // $this->Cell(0, 10, 'Seite 1 von 2 ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetFillColor(150,150,150);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('von-Buelow-Gymnasium');
$pdf->SetTitle('Notenliste');
$pdf->SetSubject('');
$pdf->SetKeywords('');

$pdf->AddPage('P','A4');


$lfdnr=0;
$dist=0;
$pdf->setY(30);
while($meineSchueler = mysql_fetch_assoc($meineSchueler_tmp)) {
			$zeilenhoehe = $_GET['zeilenh'];
			$lfdnr++	;		
			$schueler_vorname = $meineSchueler['firstname'];
			$schueler_nachname = $meineSchueler['lastname'];
			$pdf->setX(25);
			if($lfdnr % 2 == 0) {
				$pdf->Cell(10, $zeilenhoehe, $lfdnr.'.  ' ,  'LTRB', 0,'L', true, '', 0, false, 'C', 'C');
				$pdf->Cell(60,$zeilenhoehe, $schueler_nachname.', '.$schueler_vorname , 'LTRB', 0, 'L', true, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, true, 'C', 'C');
				$pdf->ln();	
								}
			else {
				$pdf->Cell(10, $zeilenhoehe, $lfdnr.'.  ' , 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(60, $zeilenhoehe, $schueler_nachname.', '.$schueler_vorname , 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');	
				$pdf->Cell(5, $zeilenhoehe,'', 'LTRB', 0, 'L', false, '', 0, false, 'C', 'C');			
				$pdf->ln();
				}		
			}

$pdf->Output('Notenliste_'.$_SESSION['myclass'].'.pdf', 'I');


	mysql_close($verbindung);
?>

