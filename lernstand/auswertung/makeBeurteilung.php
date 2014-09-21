<?php include "../auth.php"; 
		include('../db_conn.php');

require_once('tcpdf/tcpdf.php');
ob_clean();
//diverse Variablendefinitionen

$klassenbezeichner;
$kl;

	if(isset($_POST['admindruck']) && $_POST['admindruck']=='admindruck')
		 {
			$kl = $_POST['klasseZumDruck'];
		}
	else
		{
			$kl = $_SESSION['myclass'];
		}


if(strpos($kl, '5') !== false) {$klassenbezeichner = 'Klasse';$x = '5';}//x= variable fuer auswahl $faecherTableHeader, Faulheitsloesung
if(strpos($kl, '6') !== false) {$klassenbezeichner = 'Stammgruppe';$x = '6';}
if(strpos($kl, '7') !== false) {$klassenbezeichner = 'Klasse';$x = '7';}
if(strpos($kl, '8') !== false) {$klassenbezeichner = 'Klasse';$x = '8';}
if(strpos($kl, '9') !== false) {$klassenbezeichner = 'Klasse';$x = '9';}

$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
$style2 = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(255, 0, 0));

//Datenbankabfragen
$meineSchueler_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$kl."' ORDER BY lastname");
$faecherTableHeader = mysql_query("SELECT * FROM fach WHERE bewertung_klasse LIKE '%$x%'");	
$fachAnzahl = mysql_num_rows($faecherTableHeader);

$abfrageFragen = "SELECT frage.frage_lang,frage.frage_nr, kompetenz.kompetenz, kategorie.kategorie FROM frage, kompetenz, kategorie WHERE klassenstufe LIKE '%$x%' AND frage.kompetenz = kompetenz.kompetenz_nr AND frage.kategorie = kategorie.kategorie_nr ORDER BY frage.kategorie";
$fragen = mysql_query($abfrageFragen);
$fragenAnzahl = mysql_num_rows($fragen);

	while($item = mysql_fetch_assoc($fragen)) 
		{
			$frageNr[] = $item['frage_nr'];
			$fragetext[] = $item['frage_lang'];
		}
		 
$komp1query = "SELECT * FROM frage WHERE kompetenz = '1' AND klassenstufe LIKE '%$x%'"; 
$komp1 = mysql_num_rows(mysql_query($komp1query));	
$komp2query = "SELECT * FROM frage WHERE kompetenz = '2' AND klassenstufe LIKE '%$x%'"; 
$komp2 = mysql_num_rows(mysql_query($komp2query));	
$komp3query = "SELECT * FROM frage WHERE kompetenz = '3' AND klassenstufe LIKE '%$x%'"; 
$komp3 = mysql_num_rows(mysql_query($komp3query));	 
 
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
        $this->Cell(135, 0, 'Bemerkungen zur Lernentwicklung 2013/14', 0, 1, 'R', 0, '', 2, false, 'C', 'C');
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
// set pdf viewer preferences
$pdf->setViewerPreferences(array('Duplex' => 'DuplexFlipLongEdge'));
//Doppelseitiger Druck in einem Befehl
$pdf->SetBooklet(true, 15, 25);
// start of creating the documents
	while($meineSchueler = mysql_fetch_assoc($meineSchueler_tmp)) 
		{
			$schueler_uid = $meineSchueler['usr_id'];
			$schueler_vorname = $meineSchueler['firstname'];
			$schueler_nachname = $meineSchueler['lastname'];

			$pdf->SetFont('times', '', 14);
			$pdf->setPrintHeader(true);
// add a page
			$pdf->AddPage('P','A4');

//personenbezogene Kopfdaten
			$pdf->SetXY(20,42);
			$pdf->Cell(45, 5, $schueler_nachname.', '.$schueler_vorname , 0, 0, 'L', 0, '', 0, false, 'C', 'C');
			$pdf->Cell(0, 5, $klassenbezeichner.': '. $kl  , 0, 1, 'R', 0, '', 0, false, 'C', 'C');
			$pdf->Line(20, 47, 195, 47, $style2);
			$pdf->SetFont('helvetica', '', 14);
			$pdf->SetY(52);
			$pdf->SetFont('helvetica', 'B', 14);
			$pdf->MultiCell(0, 2, '', 0, 'L', 0, 1, '', '', true); //als verticaler Abstand, mir fiel grad nichts besseres ein
			$pdf->Cell(45, 5, 'Deine Lernziele im '.$_SESSION['aktueller_term_name'], 0, 1, 'L', 0, '', 0, false, 'C', 'C');
			$pdf->MultiCell(0, 1, '', 0, 'L', 0, 1, '', '', true); //als verticaler Abstand, mir fiel grad nichts besseres ein

//Ausdrucken von Lernziel 1 und 2

			$lz1_tmp=mysql_query("SELECT * FROM lernstand.lernziele WHERE uid = '".$schueler_uid."' AND lz_nr = '1' AND term = '".$_SESSION['aktueller_term_nr']."'");
			$lz2_tmp=mysql_query("SELECT * FROM lernstand.lernziele WHERE uid = '".$schueler_uid."' AND lz_nr = '2' AND term = '".$_SESSION['aktueller_term_nr']."'");
			$lz1='';
			$lz2='';
			if(mysql_num_rows($lz1_tmp)>0) 
				{
					$lz1 = mysql_result($lz1_tmp,'0','lz_text');
				}
			if(mysql_num_rows($lz2_tmp)>0) 
				{
					$lz2 = mysql_result($lz2_tmp,'0','lz_text');
				}
		$pdf->SetFont('times', 'I', 9);
		$pdf->MultiCell(0, 5, 'DAS IST MEIN ZIEL:', 'LTR', 'L', 0, 1, '', '', true);
		$pdf->SetFont('times', '', 11);
		$pdf->MultiCell(0, 5, $lz1, 'LBR', 'L', 0, 1, '', '', true);
		$pdf->MultiCell(0, 1, '', 0, 'L', 0, 1, '', '', true); //als verticaler Abstand, mir fiel grad nichts besseres ein
		$pdf->SetFont('times', 'I', 9);
		$pdf->MultiCell(0, 5, 'DAS WERDE ICH DAFÜR TUN:', 'LTR', 'L', 0, 1, '', '', true);
		$pdf->SetFont('times', '', 11);
		$pdf->MultiCell(0, 5, $lz2, 'LBR', 'L', 0, 1, '', '', true);
		$pdf->MultiCell(0, 8, '', 0, 'L', 0, 1, '', '', true); //als verticaler Abstand, mir fiel grad nichts besseres ein

//Ausdrucken der Beurteilung
		$pdf->SetFont('helvetica', 'B', 14);
		$pdf->Cell(45, 5, 'Bemerkungen zur Arbeit an Deinen Zielen:', 0, 1, 'L', 0, '', 0, false, 'C', 'C');
		$pdf->MultiCell(0, 1, '', 0, 'L', 0, 1, '', '', true); //als verticaler Abstand, mir fiel grad nichts besseres ein
		$beurteilung_tmp = mysql_query("SELECT beurteilung FROM lernstand.beurteilung WHERE uid = '".$schueler_uid."' AND term = '".$_SESSION['aktueller_term_nr']."'");
		$beurteilung = '';
		if(mysql_num_rows($beurteilung_tmp)>0 ) 
			{
				$beurteilung = mysql_result($beurteilung_tmp,'0','beurteilung');
			}
		$pdf->SetFont('times', '', 12);
		$pdf->MultiCell(0, 10, $beurteilung, 0, 'L', 0, 1, '', '', true);



//Unterschriftenleiste
		$pdf->SetXY(25,260);
		$pdf->Cell(40, 0, 'Datum', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
		$pdf->Cell(2, 0, '', '0', 0, 'R', 0, '', 0, false, 'C', 'C');
		$pdf->Cell(40, 0, 'Schüler', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
		$pdf->Cell(2, 0, '', '0', 0, 'R', 0, '', 0, false, 'C', 'C');
		$pdf->Cell(40, 0, 'Eltern', 'T', 0, 'C', 0, '', 0, false, 'C', 'C');
		$pdf->Cell(2, 0, '', '0', 0, 'R', 0, '', 0, false, 'C', 'C');
		$pdf->Cell(40, 0, 'Klassenlehrer', 'T', 1, 'C', 0, '', 0, false, 'C', 'C');



//header fuer 2. Seite abschalten
		$pdf->setPrintHeader(false);
//zweite Seite
		$pdf->AddPage('P','A4');

//Erstellen des Tabellenkopfes

		$ks = array(100,8,8,8);//statisch,laenger als je noetig, da alle nach der ersten gleich lang;ks=kopfspalten
//$pdf->SetXY(20,45);

		$pdf->SetFont('times','',9);
		$pdf->Cell($ks[0],5, '' , 0, 0, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->SetXY(119,68);//alt 78
		$pdf->StartTransform();
		$pdf->Rotate(90);
		$pdf->Cell(15,8,  'Schüler' , 1, 2, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(5,6, '',0,2,'C',0,'',0,false,'M','M');//Anjas Wunschabstand zu den Schuelern
		$fach[]=array();
		while($item = mysql_fetch_array($faecherTableHeader)) 
			{
				$fach[] = $item[1];
			}
		for($a=1;$a<=$fachAnzahl;$a++)
			{
				$pdf->Cell(15, 8, $fach[$a] , 1, 2, 'C', 0, '', 3, false, 'T', 'C');
			}
		
//$pdf->Cell(15, 5, 'Eltern' , 1, 1, 'C', 0, '', 0, false, 'T', 'C');//entfaellt im 2. Halbjahr
		$pdf->StopTransform();	


		$kompBreite = 103 + ($fachAnzahl + 1) * 8;		
		$pdf->Ln();
		$pdf->SetY(68);
		for($k=0;$k<$fragenAnzahl;$k++) 
			{
//$punkte = mysql_query("SELECT * FROM bewertung WHERE uid = '".$uid[$i]."' AND frage = '".$frageNr[$k]."'");	
	//erste Kompetenz
//	$pdf->SetX(20);
				$pdf->SetFont('helvetica','b','9');	
				if($k == 0) 
					{
						$pdf->MultiCell($kompBreite, 5, 'Sachkompetenz' , 'LRT',  'L', 0 , 1, '','',true);
					}
				$pdf->SetFont('times','','9');
//	$pdf->SetX(20);
	//Erste Spalte mit Fragetexten
				if($frageNr[$k] !== '39' && $frageNr[$k] !== '71' && $frageNr[$k] !== '77' && $frageNr[$k] !== '78') 
				{
					$fragetextneu[$k] = 'Ich kann '.$fragetext[$k];
				}
				else 
					{
						$fragetextneu[$k] = $fragetext[$k];
					}
				$pdf->MultiCell($ks[0], 5, $fragetextneu[$k] , 'LRT',  'L', 0 , 0, '','',true);
	
	//Zweite Spalte mit Selbsteinschaetzung der Schueler
				$selbst_tmp = mysql_query("SELECT * FROM bewertung WHERE uid = '".$schueler_uid."' AND frage = '".$frageNr[$k]."' AND fach = 'selbst' AND term = '".($_SESSION['aktueller_term_nr']-1)."'");
				$selbst = mysql_fetch_assoc($selbst_tmp);
	
	$selbst_neu_tmp = mysql_query("SELECT * FROM bewertung WHERE uid = '".$schueler_uid."' AND frage = '".$frageNr[$k]."' AND fach = 'selbst' AND term = '".$_SESSION['aktueller_term_nr']."'");
	$selbst_neu	= mysql_fetch_assoc($selbst_neu_tmp);
	$x_neu = '';
	if($selbst_neu['wert'] == 1) { $x_neu = 4;}
	if($selbst_neu['wert'] == 2) { $x_neu = 3;}	
	if($selbst_neu['wert'] == 3) { $x_neu = 2;}	
	if($selbst_neu['wert'] == 4) { $x_neu = 1;}
	$x_alt = '';
	if($selbst['wert'] == 1) { $x_alt = 4;}
	if($selbst['wert'] == 2) { $x_alt = 3;}	
	if($selbst['wert'] == 3) { $x_alt = 2;}	
	if($selbst['wert'] == 4) { $x_alt = 1;}
	
	if(mysql_num_rows($selbst_neu_tmp) > 0 && mysql_num_rows($selbst_tmp) > 0) { //nur wenn zwei Eintraege vorhanden sind, macht ein Vergleich Sinn
	if($x_alt == $x_neu) {//keine Veraenderung
	$pdf->MultiCell(4,5,$x_alt, 'LT','C',0,0,'','',false);
	$pdf->MultiCell(4,5,$x_neu, 'TR','C',0,0,'','',false);
	
	}
	if($x_alt > $x_neu) {//Verbesserung
	$pdf->setFillColor(0,255,14);
	$pdf->MultiCell(4,5,$x_alt, 'LT','C',1,0,'','',false);
	$pdf->MultiCell(4,0,$x_neu, 'TR','C',1,0,'','',false);
	
	}
	if($x_alt < $x_neu) {//Verschlechterung
	$pdf->setFillColor(255,43,0);
	$pdf->MultiCell(4,5,$x_alt, 'LT','C',1,0,'','',false);
	$pdf->MultiCell(4,5,$x_neu, 'TR','C',1,0,'','',false);
	
	}
}
	else {//keine Veraenderung
		$pdf->MultiCell(4,5,$x_alt, 'LT','C',0,0,'','',false);
		$pdf->MultiCell(4,5,$x_neu, 'TR','C',0,0,'','',false);
	
	}
$pdf->MultiCell(3,5, '','','C',0,0,'','',false);//Anjas Wunschabstand zu den Schuelern
//Punktebewertung der Lehrer 
for($f=1;$f<=$fachAnzahl;$f++) {
	$punkte_alt_tmp = mysql_query("SELECT * FROM bewertung WHERE uid = '".$schueler_uid."' AND frage = '".$frageNr[$k]."' AND fach = '".$fach[$f]."' AND term = '".($_SESSION['aktueller_term_nr']-1)."'");
	$punkte_alt = mysql_fetch_assoc($punkte_alt_tmp);	
	$punkte_neu_tmp = mysql_query("SELECT * FROM bewertung WHERE uid = '".$schueler_uid."' AND frage = '".$frageNr[$k]."' AND fach = '".$fach[$f]."' AND term = '".$_SESSION['aktueller_term_nr']."'");
	$punkte_neu = mysql_fetch_assoc($punkte_neu_tmp);

//punktevergabe von den Radiobuttons war nicht gemaess der beauftragten Legende, darum erfolgt Invertierung	
	$z_alt = '';
	if($punkte_alt['wert'] == 1) { $z_alt = 4;}
	if($punkte_alt['wert'] == 2) { $z_alt = 3;}	
	if($punkte_alt['wert'] == 3) { $z_alt = 2;}	
	if($punkte_alt['wert'] == 4) { $z_alt = 1;}
	$z_neu = '';
	if($punkte_neu['wert'] == 1) { $z_neu = 4;}
	if($punkte_neu['wert'] == 2) { $z_neu = 3;}	
	if($punkte_neu['wert'] == 3) { $z_neu = 2;}	
	if($punkte_neu['wert'] == 4) { $z_neu = 1;}
	if($punkte_neu['wert'] == 9) { $z_neu = ' ';}
	if(mysql_num_rows($punkte_alt_tmp) > 0 && mysql_num_rows($punkte_neu_tmp) > 0) {//nur wenn zwei Werte vorhanden, macht Vergleichen Sinn
	
	if($z_neu == $z_alt || $z_neu == ' ') {//keine Veraenderung oder zweiter Wert keine Angabe
			$pdf->MultiCell(4,5,$z_alt, 'LT','C',0,0,'','',false);
			$pdf->MultiCell(4,5,$z_neu, 'TR','C',0,0,'','',false);
			}
			
			else{
	if($z_neu < $z_alt ) {//Verbesserung
			$pdf->setFillColor(0,255,14);
			$pdf->MultiCell(4,5,$z_alt, 'LT','C',1,0,'','',false);
			$pdf->MultiCell(4,5,$z_neu, 'TR','C',1,0,'','',false);
	}
	if($z_neu > $z_alt) {//Verschlechterung
			$pdf->setFillColor(255,43,0);
			$pdf->MultiCell(4,5,$z_alt, 'LT','C',1,0,'','',false);
			$pdf->MultiCell(4,5,$z_neu, 'TR','C',1,0,'','',false);
		}
		}
		}
		else 
		{
			$pdf->MultiCell(4,5,$z_alt, 'LT','C',0,0,'','',false);
			$pdf->MultiCell(4,5,$z_neu, 'TR','C',0,0,'','',false);
	}
	}
	
	//Spalte fuer Einschaetzung der Eltern	
//$pdf->MultiCell(0,0,' ', 'LTR','C',0,1,'','',false);//dient nur als Umbruch
$pdf->Ln();
//Setzen der Kompetenzen
//	$pdf->SetX(20);

$pdf->SetFont('helvetica','b','9');	
if($k == $komp1 - 1) {$pdf->MultiCell($kompBreite, 5, 'Methodenkompetenz' , 'LRT',  'L', 0 , 1, '','',true);	}
if($k == $komp1 + $komp2 - 1) {$pdf->MultiCell($kompBreite, 5, 'Selbstkompetenz' , 'LRT',  'L', 0 , 1, '','',true);	}
if($k == $komp1 + $komp2 + $komp3 - 1) {$pdf->MultiCell($kompBreite, 5, 'Sozialkompetenz' , 'LRT',  'L', 0 , 1, '','',true);	}
$pdf->SetFont('times','','9');
	}
	

$breiteLegende = 103 + (($fachAnzahl + 1) * 8);
//	$pdf->SetX(20);
$pdf->MultiCell($breiteLegende,5,'1 = stimme voll zu, 2 = stimme zu, 3 = stimme weniger zu, 4 = stimme nicht zu', 'LTR','C',0,1,'','',false);	
//	$pdf->SetX(20);
$pdf->MultiCell($breiteLegende,5,'Der linke Wert ist jeweils die Bewertung aus dem 1. Halbjahr, der rechte aus dem 2. Halbjahr.', 'LR','C',0,1,'','',false);
//	$pdf->SetX(20);
$pdf->MultiCell($breiteLegende,5,'Grüne Felder bedeuten eine Verbesserung, rote eine Verschlechterung gegenüber dem 1. Halbjahr. ', 'LRB','C',0,0,'','',false);		
}
//Close and output PDF document
$pdf->Output('lernentwicklung_2013_14_2_'.$kl.'.pdf', 'I');

mysql_close($verbindung);
?>