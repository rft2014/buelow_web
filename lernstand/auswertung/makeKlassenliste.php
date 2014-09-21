<?php include "../auth.php"; 
		include('../db_conn.php');

require_once('tcpdf/tcpdf.php');
ob_clean();
		
		$timestamp = time();
		$datum = date("d.m.Y", $timestamp);
		$_SESSION['datum'] = $datum;
		
		$style1 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style2 = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		
		
		$meineSchueler_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$_SESSION['myclass']."' ORDER BY lastname");
 
class MYPDF extends TCPDF {
	
    //Page header
    public function Header() {
    
        // Title
        $this->SetXY(25,15);
        $this->SetFont('helvetica', 'I', 14);
        $this->Cell(0, 15, 'Klassenliste der '.$_SESSION['myclass'], 0, 0, 'L', 0, '', 0, false, 'C', 'C');
        $this->Cell(0, 15, 'Datum: '.$_SESSION['datum'] , 0, 1, 'R', 0, '', 0, false, 'C', 'C');
        
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

// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('von-Buelow-Gymnasium');
$pdf->SetTitle('Klassenliste');
$pdf->SetSubject('');
$pdf->SetKeywords('');

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set marginsfile:///home/rft/Buelow/webform/auswertung

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, 25);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('times', '', 14);
$pdf->setPrintHeader(true);
// add a page
$pdf->AddPage('P','A4');
$pdf->Line(25, 20, 185, 20, $style1);
$lfdnr=0;
$dist=0;
$pdf->setY(30);
while($meineSchueler = mysql_fetch_assoc($meineSchueler_tmp)) {
			$dist=$dist+7.5;
			$lfdnr++	;		
			$schueler_vorname = $meineSchueler['firstname'];
			$schueler_nachname = $meineSchueler['lastname'];
			$pdf->setX(25);
	$pdf->Cell(10, 15, $lfdnr.'.  ' , 0, 0, 'L', 0, '', 0, false, 'C', 'C');	
	$pdf->Cell(0, 15, $schueler_nachname.', '.$schueler_vorname , 0, 1, 'L', 0, '', 0, false, 'C', 'C');		
	$pdf->Line(25, 26+$dist, 185, 26+$dist, $style2);		
			}

$pdf->Output('Klassenliste_'.$_SESSION['myclass'].'.pdf', 'I');

mysql_close($verbindung);
?>