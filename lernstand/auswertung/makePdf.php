<html>
<head>

</head>
<body>
<?php
 
$verbindung = mysql_connect ("localhost",
"root", "Kallimann")
or die ("keine Verbindung möglich.
 Benutzername oder Passwort sind falsch");

mysql_select_db("lernstand")
or die ("Die Datenbank existiert nicht.");
$klassenbezeichner;
$kl;

$kl = $_POST['klasse'];
if(strpos($kl, '5') !== false) {$klst = 'daten56'; $klassenbezeichner = 'Stammgruppe';$x = '5';}//x= variable fuer auswahl $faecherTableHeader, Faulheitsloesung
if(strpos($kl, '6') !== false) {$klst = 'daten56'; $klassenbezeichner = 'Klasse';$x = '6';}
if(strpos($kl, '7') !== false) {$klst = 'daten78'; $klassenbezeichner = 'Klasse';$x = '7';}
if(strpos($kl, '8') !== false) {$klst = 'daten78'; $klassenbezeichner = 'Klasse';$x = '8';}
if(strpos($kl, '9') !== false) {$klst = 'daten9'; $klassenbezeichner = 'Klasse';$x = '9';}


$schuelerdaten = "SELECT * From schuelerdaten WHERE klasse = '".$kl."' ORDER BY lastname";
$afsd = mysql_query($schuelerdaten);//afsd abfrage schuelerdaten
$nachname = array();
$vorname = array();
$gender = array();
$anzahlSchueler = mysql_num_rows(mysql_query($schuelerdaten));
while($namen = mysql_fetch_array($afsd)){
	$nachname[] = ($namen[3]);
	$vorname[]  = ($namen[2]);
	$gender[]  = $namen[5];
	$uid[] = $namen[0];	
	};
$komp1query = "SELECT * FROM frage WHERE kompetenz = '1' AND klassenstufe LIKE '%$x%'"; 
$komp1 = mysql_num_rows(mysql_query($komp1query));	
$komp2query = "SELECT * FROM frage WHERE kompetenz = '2' AND klassenstufe LIKE '%$x%'"; 
$komp2 = mysql_num_rows(mysql_query($komp2query));	
$komp3query = "SELECT * FROM frage WHERE kompetenz = '3' AND klassenstufe LIKE '%$x%'"; 
$komp3 = mysql_num_rows(mysql_query($komp3query));	


$faecherTableHeader = mysql_query("SELECT * FROM fach WHERE bewertung_klasse LIKE '%$x%'");	
$fachAnzahl = mysql_num_rows($faecherTableHeader);

$abfrageFragen = "SELECT frage.frage_lang,frage.frage_nr, kompetenz.kompetenz, kategorie.kategorie FROM frage, kompetenz, kategorie WHERE klassenstufe LIKE '%$x%' AND frage.kompetenz = kompetenz.kompetenz_nr AND frage.kategorie = kategorie.kategorie_nr ORDER BY frage.kategorie";
$fragen = mysql_query($abfrageFragen);
$fragenAnzahl = mysql_num_rows($fragen);

while($item = mysql_fetch_assoc($fragen)) {
	$frageNr[] = $item['frage_nr'];
	$fragetext[] = $item['frage_lang'];

}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
ob_clean();

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
       
        $this->Image('logo.jpg', 20, 10, 35, 25,  'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 16);
        // Title
        $this->SetXY(0,15);
        $this->Cell(0, 15, 'von-Bülow-Gymnasium Neudietendorf', 0, 1, 'R', 0, '', 0, false, 'C', 'C');
        $this->SetFont('helvetica', 'B', 20);
        $this->SetXY(60,25);
        $this->Cell(125, 0, 'Bemerkungen zur Lernentwicklung 2013/14', 0, 1, 'R', 0, '', 2, false, 'C', 'C');
        $this->SetFont('helvetica','',14);
        $this->SetXY(10,45);
       // $this->Cell(80, 0, 'Schuljahr 2013/14', 0, 0, 'L', 0, '', 0, false, 'C', 'C');
       // $this->Cell(30, 0, 'Halbjahr', 0, 0, 'C', 0, '', 0, false, 'C', 'C');
       // $this->Cell(0, 0,  , 0, 1, 'R', 0, '', 0, false, 'C', 'C');
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
$pdf->SetTitle('Bemerkungen zur Lernentwicklung');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Hallo Welt', PDF_HEADER_STRING);

// set header and footer fonts
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

// ---------------------------------------------------------
for($i=0;$i<$anzahlSchueler;$i++) {
// set font
$pdf->SetFont('times', '', 14);
$pdf->setPrintHeader(true);
// add a page
$pdf->AddPage('P','A4');

//personenbezogene Kopfdaten
$pdf->SetXY(20,42);
$pdf->Cell(45, 5, ucfirst(utf8_encode($nachname[$i])).', '.ucfirst(utf8_encode($vorname[$i])) , 0, 0, 'L', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(35, 5, ucfirst(utf8_encode($vorname[$i])) , 0, 0, 'L', 0, '', 0, false, 'C', 'C');
$pdf->Cell(0, 5, $klassenbezeichner.': '. $kl  , 0, 1, 'R', 0, '', 0, false, 'C', 'C');
//$pdf->SetY(35);
//$pdf->Cell(0, 5, 'Schuljahr 2013/14'  , 0, 0, 'L', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(0, 5, 'Halbjahr' , 0, 1, 'R', 0, '', 0, false, 'C', 'C');


$ks = array(100,5,5,5);//statisch,laenger als je noetig, da alle nach der ersten gleich lang;ks=kopfspalten
//$pdf->SetXY(20,45);

$pdf->SetFont('times','',9);
$pdf->Cell($ks[0],5, '' , 0, 0, 'C', 0, '', 0, false, 'M', 'M');
$pdf->SetXY(122.5,68);//alt 78
$pdf->StartTransform();
$pdf->Rotate(90);
$pdf->Cell(15,5,  'Schüler' , 1, 2, 'C', 0, '', 0, false, 'M', 'M');
$fach[]=array();
while($item = mysql_fetch_array($faecherTableHeader)) {
	$fach[] = $item[0];
		}
		
		for($a=1;$a<=$fachAnzahl;$a++){
		$pdf->Cell(15, 5, $fach[$a] , 1, 2, 'C', 0, '', 3, false, 'T', 'C');
	}
		//reset(mysql_fetch_assoc($faecherTableHeader));
$pdf->Cell(15, 5, 'Eltern' , 1, 1, 'C', 0, '', 0, false, 'T', 'C');
$pdf->StopTransform();	
	
	

$kompBreite = 100 + ($fachAnzahl + 2) * 5;		
$pdf->Ln();
$pdf->SetY(68);
for($k=0;$k<$fragenAnzahl;$k++) {
//$punkte = mysql_query("SELECT * FROM bewertung WHERE uid = '".$uid[$i]."' AND frage = '".$frageNr[$k]."'");	
	//erste Kompetenz
	$pdf->SetX(20);
	$pdf->SetFont('helvetica','b','9');	
	if($k == 0) {$pdf->MultiCell($kompBreite, 5, 'Sachkompetenz' , 'LRT',  'L', 0 , 1, '','',true);}
	$pdf->SetFont('times','','9');
	$pdf->SetX(20);
	//Erste Spalte mit Fragetexten
	if($frageNr[$k] !== '39' && $frageNr[$k] !== '71' && $frageNr[$k] !== '77' && $frageNr[$k] !== '78') {$fragetextneu[$k] = 'Ich kann '.$fragetext[$k];}
	else {$fragetextneu[$k] = $fragetext[$k];}
	$pdf->MultiCell($ks[0], 5, utf8_encode($fragetextneu[$k]) , 'LRT',  'L', 0 , 0, '','',true);
	
	//Zweite Spalte mit Selbsteinschaetzung der Schueler
	$selbst = mysql_fetch_assoc(mysql_query("SELECT * FROM $klst WHERE uid = '".$uid[$i]."' " ));
	
	$pdf->MultiCell($ks[1],5,$selbst[$frageNr[$k]], 'LTR','C',0,0,'','',false);
	
//Punktebewertung der Lehrer 
for($f=1;$f<=$fachAnzahl;$f++) {
	$punkte = mysql_fetch_assoc( mysql_query("SELECT * FROM bewertung WHERE uid = '".$uid[$i]."' AND frage = '".$frageNr[$k]."' AND fach = '".$fach[$f]."'"));
//punktevergabe von den Radiobuttons war nicht gemaess der beauftragten Legende, darum erfolgt Invertierung	
	$z = '';
	if($punkte['wert'] == 1) { $z = 4;}
	if($punkte['wert'] == 2) { $z = 3;}	
	if($punkte['wert'] == 3) { $z = 2;}	
	if($punkte['wert'] == 4) { $z = 1;}		
	$pdf->MultiCell(5,5,$z, 'LTR','C',0,0,'','',false);	
		}
	//Spalte fuer Einschaetzung der Eltern	
$pdf->MultiCell(5,5,' ', 'LTR','C',0,1,'','',false);
//Setzen der Kompetenzen
$pdf->SetX(20);
$pdf->SetFont('helvetica','b','9');	
if($k == $komp1 - 1) {$pdf->MultiCell($kompBreite, 5, 'Methodenkompetenz' , 'LRT',  'L', 0 , 1, '','',true);	}
if($k == $komp1 + $komp2 - 1) {$pdf->MultiCell($kompBreite, 5, 'Selbstkompetenz' , 'LRT',  'L', 0 , 1, '','',true);	}
if($k == $komp1 + $komp2 + $komp3 - 1) {$pdf->MultiCell($kompBreite, 5, 'Sozialkompetenz' , 'LRT',  'L', 0 , 1, '','',true);	}
$pdf->SetFont('times','','9');
	}
	

$breiteLegende = 100 + (($fachAnzahl + 2) * 5);
$pdf->SetX(20);
$pdf->MultiCell($breiteLegende,5,'1 = stimme voll zu, 2 = stimme zu, 3 = stimme weniger zu, 4 = stimme nicht zu', '1','C',0,1,'','',false);	
//$pdf->SetXY(20,260);
//$pdf->Cell(30, 0, 'Datum', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(8, 0, '', '0', 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(30, 0, 'Schüler', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(8, 0, '', '0', 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(30, 0, 'Eltern', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(8, 0, '', '0', 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(30, 0, 'Klassenlehrer', 'T', 1, 'C', 0, '', 0, false, 'C', 'C');


//header fuer 2. Seite abschalten
$pdf->setPrintHeader(false);
//zweite Seite
$pdf->AddPage('L','A4');

$lernziel = mysql_query("SELECT * FROM $klst WHERE uid = '".$uid[$i]."' "); 
$eintrag = mysql_num_rows($lernziel);
while($item = mysql_fetch_assoc($lernziel)) {
$lernziel1 = utf8_encode($item['lernziel1']);
$lernziel2 = utf8_encode($item['lernziel2']);
$lernziel3 = utf8_encode($item['lernziel3']);
$lernziel4 = utf8_encode($item['lernziel4']);
$lernziel5 = utf8_encode($item['lernziel5']);

$name = utf8_encode($item['name']);	
	}



// Textfelder fuer Lernziele
 $pdf->SetFont('helvetica', 'B', 16);
 $pdf->Cell(0, 0, 'Festlegung individueller Lernziele:', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
 $pdf->SetFont('times', '', 10);
 
 $pdf->MultiCell(120, 60, 'DAS IST MEIN ZIEL:'."\n" .$lernziel1."\n".$name, 1, 'L', 0, 0, '', '35', true);
 $pdf->MultiCell(127, 55, 'DAS WERDE ICH DAFÜR TUN:'."\n" .$lernziel2, 1, 'L', 0, 0, '143', '45', true);
 $pdf->MultiCell(85, 55, 'DIESE UNTERSTÜTZUNG BENÖTIGE ICH:'."\n" .$lernziel3, 1, 'L', 0, 0, '', '100', true);
 $pdf->MultiCell(85, 55, 'DARAN KANN ICH ERKENNEN, DASS ICH MEIN ZIEL ERREICHT HABE:'."\n" .$lernziel4, 1, 'L', 0, 0, '100', '100', true);
 $pdf->MultiCell(85, 55, 'DIE ZIELVEREINBARUNG WIRD ÜBERPRÜFT:'."\n" .$lernziel5, 1, 'L', 0, 0, '185', '100', true);
 
 $pdf->SetXY(48,180);
$pdf->Cell(40, 0, 'Datum', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(8, 0, '', '0', 0, 'R', 0, '', 0, false, 'C', 'C');
$pdf->Cell(40, 0, 'Schüler', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(8, 0, '', '0', 0, 'R', 0, '', 0, false, 'C', 'C');
$pdf->Cell(40, 0, 'Eltern', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Cell(8, 0, '', '0', 0, 'R', 0, '', 0, false, 'C', 'C');
$pdf->Cell(40, 0, 'Klassenlehrer', 'T', 1, 'C', 0, '', 0, false, 'C', 'C');
// ---------------------------------------------------------
}
//Close and output PDF document
$pdf->Output('lernentwicklung_2013_14.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
mysql_close($verbindung); 
?>
</body>
</html>
