<?php
 
function ht($lernziel){
	
	$headertext;	
	
	if($lernziel == 'lernziel_1') {$headertext = 'Das ist mein Ziel:';}
	if($lernziel == 'lernziel_2') {$headertext = 'Das werde ich daf&uuml;r tun:';}
	if($lernziel == 'lernziel_3') {$headertext = 'Diese Unterst&uuml;tzung ben&ouml;tige ich:';}
	if($lernziel == 'lernziel_4') {$headertext = 'Daran kann ich erkennen, dass ich mein Ziel erreicht habe:';}
	if($lernziel == 'lernziel_5') {$headertext = 'Die Zielvereinbarung wird &uuml;berpr&uuml;ft:';}
	
	return $headertext;
		
}

function hinweis($url, $hinweistext){
	error_reporting(0);  
	
	echo "<div id=\"hinweis\">";
	echo "<div id=\"hinweislogo\">";
	echo "<img src=$url>";
	echo "</div>";
	echo "<div id=\"hinweistext\">";
	echo $hinweistext;
	echo "</div>";
	echo "</div>";
}

/*lernziele fuer schuelersicht anders, da die SESSION[uid] genutzt wird
* entgegen der wechselnden SESSION[akt_schueler_uid]
*/
function lernziel_aktualisieren ($lernzielNr) 
{
	$x = $_SESSION['uid'];
	$lernziel_tmp = mysql_query("SELECT * FROM lernstand.lernziele WHERE uid = '".$x."' AND lz_nr = '".$lernzielNr."' AND term = '".$_SESSION['aktueller_term_nr']."' ORDER BY tmstmp ASC");	
	$result = array();
	while($row = mysql_fetch_assoc($lernziel_tmp)) 
		{
			if($row["lz_text"] !== '') 
				{
					$result[] = $row["lz_text"];
					$result[] = "(".$row["tmstmp"].")";
				}
		}
	$lernziel_aktuell = implode("</br>",  $result);
	mysql_close($verbindung);
	return $lernziel_aktuell;	
}
	
function lernziel_aktualisieren_lehrersicht ($lernzielNr) 
{
	$x = $_SESSION['akt_schueler_uid'];
	$lernziel_tmp = mysql_query("SELECT * FROM lernstand.lernziele WHERE uid = '".$x."' AND lz_nr = '".$lernzielNr."' AND term = '".$_SESSION['aktueller_term_nr']."' ORDER BY tmstmp ASC");	
	$result = array();
		while($row = mysql_fetch_assoc($lernziel_tmp)) 
			{
				if($row["lz_text"] !== '') 
					{
						$result[] = $row["lz_text"];
						//$result[] = "(".$row["tmstmp"].")";
					}
			}
	$lernziel_aktuell = implode(" - ",  $result);
	mysql_close($verbindung);
	return $lernziel_aktuell;	
}	
	
	function beurteilung_zuarbeit($beurteilungs_zuarbeit,$kategorienr){
	/*wird aufgerufen in myclass_lernziele line 184 ungefaehr */	
	
		$ausgabe = array();
		
		$a = array_chunk($beurteilungs_zuarbeit, '4');
		$b = count($a);
		
		for($i=0; $i<$b; $i++) {
			$teil_array = $a[$i];
			if($teil_array['0'] == $kategorienr) {
				array_splice($teil_array,0,1,"");
				foreach($teil_array as $value){
					$ausgabe[] = $value;					
						}
					}
			}	
					
		$result = implode('<br/>',$ausgabe);
	return $result;
	
		}
		
		function uebernahme($kat, $wert){
			/* Aufruf aus lehrer_pers.php signalisiert dem user die erfolgte
			Registrierung der Eingabe
			*/
				
				$x = mysql_num_rows(mysql_query("SELECT * FROM lernstand.beurteilung_antwort WHERE uid_schueler = '".$_SESSION['akt_schueler_uid_fremd']."' AND  uid_angeforderter = '".$_SESSION['uid']."' AND kategorie = '".$kat."' AND wert = '".$wert."' AND term = '".$_SESSION['aktueller_term_nr']."'"));
				if($x > 0) {				

			$rw = "Gespeichert";
			}else 
			{$rw = "&Uuml;bernehmen";}
			
			return $rw;			
		}
		
	 function preselect($wert_aus_db, $wert_des_button ){
	 	
	 	$checked = 'checked';
	 	$not_checked = ' ';
	 	
	 	if($wert_aus_db !== $wert_des_button) {
	 		
	 		return $not_checked;
	 	
	 	}	else {
	return $checked;	 		
	 		}
		}
		
		
		function druckfertig($schueler_uid) 
			{
				$x = $schueler_uid;
				$checked = "checked";
				$notchecked = " ";
				$fertig = mysql_num_rows(mysql_query("SELECT * FROM lernstand.beurteilung WHERE uid = '".$x."' AND fertig = 1"));
					if($fertig == 1) 
						{
							return $checked;				
						}
					else 
						{
							return $notchecked;
						}
			
			}
?>

	