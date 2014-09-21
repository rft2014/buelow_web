<?php include "../auth.php"; 
		include('../db_conn.php');
		include "../classes/functions.php";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
 	<meta http-equiv="content-type" content="text/html" charset="UTF-8" />
  	<link rel="stylesheet" type="text/css" href="../templates/format.css">
 	<link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
 	<script type="text/javascript" src="textarea.js"></script>
 	<script type="text/javascript" src="bestaetigung.js"></script>
  	<title>Lernziele Bewertung</title>
  <?php include "../headline.php"; ?>
  </head>
  
  <body>
 <?php error_reporting(E_ALL ^ E_NOTICE);?>
  <?php error_reporting(0);?>
  
<ul id="tabmenue">
<li><a href="./menue_lehrer.php" >Startseite</a></li>
  <li><a id="lehrerpers" href="./lehrer_pers.php">Anfragen</a></li>
  <li><a href="../start.php">Kompetenzen</a></li>
  
 <?php
if($_SESSION['myclass'] !== "") {
	echo "<li><a href=\"./lehrer_myclass.php\">Klassendaten -  ".$_SESSION['myclass']."</a></li>";
	echo "<li><a href=\"./myclass_lernziele.php\">Lernziele -  ".$_SESSION['myclass']."</a></li>";
	echo "<li><a href=\"./myclass_medienpass.php\">Medienpass</a></li>";
}else{
		echo "<li><a href=\"./myclass_medienpass.php\">Medienpass</a></li>";
	}
	?>
</ul>
<?php
$uid_tmp =mysql_query("SELECT firstname, lastname, usr_id FROM ilias.usr_data JOIN lernstand.beurteilung_consult ON ilias.usr_data.usr_id = lernstand.beurteilung_consult.uid_schueler AND lernstand.beurteilung_consult.uid_geforderter = '".$_SESSION['uid']."' AND lernstand.beurteilung_consult.beantwortet = '0' AND lernstand.beurteilung_consult.term = '".$_SESSION['aktueller_term_nr']."' ORDER BY lastname");
  

//diese Variable ist notwendig, damit die js-function Bestaetigung nicht undefiniert ist
$aktuellerSchueler = " ";
if(isset($_SESSION['akt_schueler_name_fremd'])) {$aktuellerSchueler = $_SESSION['akt_schueler_name_fremd'];}
	
echo	"<div id=\"linksaussen_ohnerechts\">";
echo "<div id=\"button_schuelernamen\">";
echo "<table>";

$i=0;
$val1;
while($schueler = mysql_fetch_assoc($uid_tmp)) {
	$i++;
	echo "<tr>";
	echo "<td>";
	echo "<form action=\"fremdclass_schueler_session_uid_setzen.php\" method=\"POST\">"; //...fremdclass... wegen anderer Ruecksprungseite als bei myclass
	
	$val1 = $i.".  ".$schueler['lastname'].", ".$schueler['firstname'];
	$val2 = $schueler['usr_id'];
	echo "<input type=\"submit\" name=\"akt_schueler_name_fremd\" value=\"$val1\" id=\"button_schuelernamen\">";
	echo "<input type=\"hidden\" name=\"akt_schueler_uid_fremd\" value=\"$val2\">";
	echo "</form>";
	echo "</td><td>";
	echo "<form action=\"fremdschueler_fertig.php\" method=\"POST\" name=\"fertig\" onsubmit=\"return Bestaetigung('".$aktuellerSchueler."')\">";
	echo "<input type=\"submit\" value=\"Fertig\">";
	echo "<input type=\"hidden\" value=\"1\" name=\"fertig\">";
	echo "<input type=\"hidden\" value=\"$val2\" name=\"schueleruid\">";
	echo "</form>";
	echo "</td></tr>";
}
echo "</table>";
echo	"</div></div>";


	
	echo "<div id=\"mitte_ohnerechts\">";
	
	if(isset($_SESSION['akt_schueler_name_fremd'])){
		echo "<div id=\"schuelername\">".$_SESSION['akt_schueler_name_fremd']." ( uid: ".$_SESSION['akt_schueler_uid_fremd'].")</div>";
			





	$lz_tmp = mysql_query("SELECT * FROM lernziele WHERE uid = '".$_SESSION['akt_schueler_uid_fremd']."' ");
	
	$lz1 = mysql_result($lz_tmp, '0', 'lz_text');
	$lz2 = mysql_result($lz_tmp, '1', 'lz_text');
	$lz3 = mysql_result($lz_tmp, '2', 'lz_text');
	$lz4 = mysql_result($lz_tmp, '3', 'lz_text');
	$lz5 = mysql_result($lz_tmp, '4', 'lz_text');
		
			
				echo "<div id=\"lz_ht\">".ht('lernziel_1')."</div>";
			echo "<div id=\"lz\">".$lz1."</br></div>";
				echo "<div id=\"lz_ht\">".ht('lernziel_2')."</div>";
			echo "<div id=\"lz\">".$lz2."</br></div>";
				echo "<div id=\"lz_ht\">".ht('lernziel_3')."</div>";
			echo "<div id=\"lz\">".$lz3."</br></div>";
				echo "<div id=\"lz_ht\">".ht('lernziel_4')."</div>";
			echo "<div id=\"lz\">".$lz4."</br></div>";
				echo "<div id=\"lz_ht\">".ht('lernziel_5')."</div>";
			echo "<div id=\"lz\">".$lz5."</br></div>";
			
	$beurteilung_tmp = mysql_query("SELECT * FROM lernstand.beurteilung WHERE uid = '".$_SESSION['akt_schueler_uid_fremd']."'");
	if(mysql_num_rows($beurteilung_tmp) == 0){}else {  
	$beurteilung = mysql_result($beurteilung_tmp,'0','beurteilung');}	
	$var3 = $_SESSION['akt_schueler_uid'];
			echo "<form name=\"textarea_beurteilung\" action=\"fremdclass_beurteilung_maschine.php\" method=\"POST\">";
			echo "<textarea id=\"texteingabefeld\" name=\"hinweis\" cols=\"180\" rows=\"3\">";
			//echo $beurteilung;
			echo "Hier k&ouml;nnen zus&auml;tzliche Hinweise mitgegeben werden...";
			echo "</textarea>";
			echo "<input type=\"submit\" name=\"beurteilung_speichern\" value=\"Hinweise absenden\">";
			echo "<input type=\"hidden\" name=\"akt_schueler_uidx\" value=\"$var3\">";
			echo "</form>";

	/*Erstellen der Tabelle mit den Textbloecken fuer die Beurteilung*/
	
	$beurteilungskategorie_tmp = mysql_query("SELECT * FROM lernstand.kategorien_beurteilung");	
	$kategorien_anzahl = mysql_num_rows($beurteilungskategorie_tmp);
	
	echo "<table class=\"beurteilungswahl\">";
	$kp=0;
	
	while($row = mysql_fetch_array($beurteilungskategorie_tmp)) {
			$beurteilungskategorie[] = $row[1];
			$kategorienr[] = $row[0];
			
		$beurteilungstexte_tmp = mysql_query("SELECT * FROM lernstand.textbausteine_beurteilung WHERE kategorie_nr = '".$kategorienr[$kp]."'");
		$text1 = mysql_result($beurteilungstexte_tmp, '0', 'beurteilung_text');
		$text2 = mysql_result($beurteilungstexte_tmp, '1', 'beurteilung_text');
		$text3 = mysql_result($beurteilungstexte_tmp, '2', 'beurteilung_text');
		$text4 = mysql_result($beurteilungstexte_tmp, '3', 'beurteilung_text');
		
		
		
		
		
		if($kp % 2 == 0) {$td1='td_1';$td2='td_2';$td4='td_4';}else{$td1='td_1a';$td2='td_2a';$td4='td_4a';}
	echo		"<tr><td class=$td1 rowspan=\"5\">".$beurteilungskategorie[$kp]."</td></tr>";	
	echo		"<tr><td class=$td2>".$text1."</td><td class=$td4>1</td><td class=\"td_3\"><form action=\"./wertespeichern.php\" method=\"POST\"><input type=\"submit\" name=\"wertspeichern\" value=".uebernahme($kategorienr[$kp], '1')."><input type=\"hidden\" name=\"wert\" value=\"1\"><input type=\"hidden\" name=\"kat\" value=\"$kategorienr[$kp]\"></form></td></tr>";
	echo		"<tr><td class=$td2>".$text2."</td><td class=$td4>2</td><td class=\"td_3\"><form action=\"./wertespeichern.php\" method=\"POST\"><input type=\"submit\" name=\"wertspeichern\" value=".uebernahme($kategorienr[$kp], '2')."><input type=\"hidden\" name=\"wert\" value=\"2\"><input type=\"hidden\" name=\"kat\" value=\"$kategorienr[$kp]\"></form></td></tr>";
	echo		"<tr><td class=$td2>".$text3."</td><td class=$td4>3</td><td class=\"td_3\"><form action=\"./wertespeichern.php\" method=\"POST\"><input type=\"submit\" name=\"wertspeichern\" value=".uebernahme($kategorienr[$kp], '3')."><input type=\"hidden\" name=\"wert\" value=\"3\"><input type=\"hidden\" name=\"kat\" value=\"$kategorienr[$kp]\"></form></td></tr>";
	echo		"<tr><td class=$td2>".$text4."</td><td class=$td4>4</td><td class=\"td_3\"><form action=\"./wertespeichern.php\" method=\"POST\"><input type=\"submit\" name=\"wertspeichern\" value=".uebernahme($kategorienr[$kp], '4')."><input type=\"hidden\" name=\"wert\" value=\"4\"><input type=\"hidden\" name=\"kat\" value=\"$kategorienr[$kp]\"></form></td></tr>";	
	$kp++;
	
		}
	echo "</table>";		
		
		
	echo "</div>";
	
	}else{	 hinweis("../templates/hinweis3_50.jpg", "Wenn links Namen stehen, so w&auml;hlen Sie bitte einen Sch&uuml;ler aus, um dem anfragenden Kollegen
	 bei der Erstellung der Beurteilung zu helfen. Wenn dort keine Name steht, gibt es hier f&uuml;r Sie nichts zu tun. ");}



mysql_close($verbindung);
?>


</body>
</html>
