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
			
			/*
			* Funktion gibt ein select Feld aus
			*/
			function tag($name) 
				{
					$ausgabe = "<select> name=".$name." size=\"1\">
									<option>01</option>
									<option>02</option>
									<option>03</option>
									<option>04</option>
									<option>05</option>
									<option>06</option>
									<option>07</option>
									<option>08</option>
									<option>09</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
									<option>13</option>
									<option>14</option>
									<option>15</option>
									<option>16</option>
									<option>17</option>
									<option>18</option>
									<option>19</option>
									<option>20</option>
									<option>21</option>
									<option>22</option>
									<option>23</option>
									<option>24</option>
									<option>25</option>
									<option>26</option>
									<option>27</option>
									<option>28</option>
									<option>29</option>
									<option>30</option>
									<option>31</option>
									</select>";
									
					return $ausgabe;			
				
				}
			
			function monat($name)
				{
					$ausgabe = "<select> name=".$name." size=\"1\">
									<option>01</option>
									<option>02</option>
									<option>03</option>
									<option>04</option>
									<option>05</option>
									<option>06</option>
									<option>07</option>
									<option>08</option>
									<option>09</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
									</select>";
					
					return $ausgabe;
				}
				
			
			function jahr($name)
				{
					$ausgabe = "<select> name=".$name." size=\"1\">
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>
									<option>2019</option>
									<option>2020</option>
									</select>";
					
					return $ausgabe;
				}
?>

	