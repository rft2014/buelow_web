<?php include "../auth.php"; 
		include('../db_conn.php');
		include "../classes/functions.php";
?>

<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
	<link rel="stylesheet" type="text/css" href="../templates/format.css">
	<script type="text/javascript" src="textarea.js"></script>
	<script type="text/javascript" src="schuelerFertig.js"></script>
	<title>Lernziele meiner Klasse</title>
	</head>
		<body>
<?php include('../headline.php');?>
   		<ul id="tabmenue">
				<li><a href="./menue_lehrer.php" >Startseite</a></li>
  				<li><a  href="./lehrer_pers.php">Anfragen</a></li>
  				<li><a href="../start.php">Kompetenzen</a></li>
 				<li><a href="./lehrer_myclass.php">Klassendaten -  <?php echo $_SESSION['myclass'];?></a></li>
 				<li><a id= "lehrerpers" href="./myclass_lernziele.php">Lernziele -  <?php echo $_SESSION['myclass'];?></a></li>
 				<li><a href="./myclass_medienpass.php">Medienpass</a></li>
			</ul>
<?php error_reporting(E_ALL ^ E_NOTICE);?>
<?php error_reporting(0);?>
<?php
	$meineSchueler_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON
	 usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$_SESSION['myclass']."' ORDER BY lastname");
	$lehrer_tmp = mysql_query("SELECT lastname, firstname, usr_id FROM ilias.usr_data WHERE EXISTS(SELECT * FROM ilias.udf_text WHERE
	 udf_text.usr_id = usr_data.usr_id AND udf_text.value = 'Lehrer') ORDER BY lastname");
	$paukermenge = mysql_num_rows($lehrer_tmp);
	$lehrer = array();

	
	echo "<div id=\"linksaussen\">";
	echo "<div id=\"button_schuelernamen\">";
		echo "<table>";
		$i=0;
		$val1;

		while($meineSchueler = mysql_fetch_assoc($meineSchueler_tmp)) 
			{
				$i++;
				echo "<form action=\"myclass_schueler_session_uid_setzen.php\" method=\"POST\">";
				$val1 = $i.".  ".$meineSchueler['lastname'].", ".$meineSchueler['firstname'];
				$val2 = $meineSchueler['usr_id'];
				$fertig = "fertig".$val2;
				echo "<tr><td><input type=\"submit\" name=\"akt_schueler_name\" value=\"$val1\" id=\"button_schuelernamen\"></td>";
				echo "<input type=\"hidden\" name=\"akt_schueler_uid\" value=\"$val2\"></form>";
				echo "<form name=\"sfertig\" action=\"\"><td><input type=\"checkbox\" id=\"$fertig\" value=\"\" ".druckfertig($val2)." onclick=\"schuelerFertig($val2)\"></td></form></tr>";
			}
	echo "</table>";
	echo "</div>";

/*
Druck der Beurteilungen
*/


?>
		<div id="druckbutton_beurteilung">
		<a href="../auswertung/makeBeurteilung.php">Beurteilungen betrachten</a>
		</div>
<?php	

		echo "</div>";

		if(isset($_SESSION['akt_schueler_uid'])) 
			{
				$angeforderte_tmp = mysql_query("SELECT * FROM lernstand.beurteilung_consult WHERE uid_schueler = '".$_SESSION['akt_schueler_uid']."' AND uid_anforderer = '".$_SESSION['uid']."' AND beantwortet ='0' AND term = '".$_SESSION['aktueller_term_nr']."'");
				$anzahl_gefordert = mysql_num_rows($angeforderte_tmp);
				$angeforderte = array();
					while($rowx = mysql_fetch_assoc($angeforderte_tmp)) 
						{
							$angeforderte[] = $rowx['uid_geforderter'];
						}

				echo "<div id=\"rechtsaussen\">";
				echo "<div id=\"header_rechts\">Um einen Kollegen um seine Beurteilung zu bitten: Haken rein und auf \"Absenden\" klicken.</div>";
				echo "<form action=\"beurteilung_einholen.php\" method=\"POST\">";
				echo "<input type=\"submit\" name=\"lehrer_consult\" value=\"Anfrage absenden\"></br>";
					while($row = mysql_fetch_assoc($lehrer_tmp))
						{
							$val1 = $row['lastname'].", ".$row['firstname'];
							$val2 = $row['usr_id'];
								foreach($angeforderte as $nr)
									{
										if($nr == $val2) 
											{
												echo "<font size=\"4\">?</font>";	
											}								
									}
							echo "<input type=\"checkbox\" name=\"lehrer_consult[]\" value=\"$val2\">".$val1."<br/>";
						};
			}	
				echo "</form>";	
				echo "</div>";	


echo "<div id=\"mitte\">";
	echo "<div id=\"lernziele\">";
		if(isset($_SESSION['akt_schueler_name']))
			{
				echo "<div id=\"schuelername\">".$_SESSION['akt_schueler_name']." ( uid: ".$_SESSION['akt_schueler_uid'].")</div>";
				$lz_tmp = mysql_query("SELECT * FROM lernziele WHERE uid = '".$_SESSION['akt_schueler_uid']."' AND term = '".$_SESSION['aktueller_term_nr']."' ");
				$lz1 = mysql_result($lz_tmp, '0', 'lz_text');
				$lz2 = mysql_result($lz_tmp, '1', 'lz_text');
				$lz3 = mysql_result($lz_tmp, '2', 'lz_text');
				$lz4 = mysql_result($lz_tmp, '3', 'lz_text');
				$lz5 = mysql_result($lz_tmp, '4', 'lz_text');
				echo "<div id=\"lernziel\">";		
					echo "<fieldset>";
						echo "<legend>".ht('lernziel_1')."</legend>";
						echo "<div class=\"lernziele\">".lernziel_aktualisieren_lehrersicht('1')."</div>";
					echo "</fieldset>";	
					echo "<fieldset>";
						echo "<legend>".ht('lernziel_2')."</legend>";
						echo "<div class=\"lernziele\">".lernziel_aktualisieren_lehrersicht('2')."</div>";
					echo "</fieldset>";	
					echo "<fieldset>";
						echo "<legend>".ht('lernziel_3')."</legend>";
						echo "<div class=\"lernziele\">".lernziel_aktualisieren_lehrersicht('3')."</div>";
					echo "</fieldset>";	
					echo "<fieldset>";
						echo "<legend>".ht('lernziel_4')."</legend>";
						echo "<div class=\"lernziele\">".lernziel_aktualisieren_lehrersicht('4')."</div>";
					echo "</fieldset>";	
					echo "<fieldset>";
						echo "<legend>".ht('lernziel_5')."</legend>";
						echo "<div class=\"lernziele\">".lernziel_aktualisieren_lehrersicht('5')."</div>";
					echo "</fieldset>";	
	echo "</div>";			

/*Einfuegen von Hinweisen consultierter Kollegen, falls vorhanden
*/

	$hinweise_tmp = mysql_query("SELECT wert FROM lernstand.beurteilung_antwort WHERE uid_schueler='".$_SESSION['akt_schueler_uid']."' AND
	 kategorie = '99' AND term = '".$_SESSION['aktueller_term_nr']."'");	
	$hweise=array();
	if(mysql_num_rows($hinweise_tmp) > 0) 
		{
			while($hw = mysql_fetch_array($hinweise_tmp)) 
				{
					$hweise[] = $hw['0'];
				}
					
			$str = implode("<br/>",$hweise);
			echo "<div id=\"hinweisblock_consult\"><div id=\"hinweise_consult_header\">Hinweise der konsultierten Kollegen</div><div id=\"hinweise_consult\">".$str."</div></div>";
		}
		
/* Erstellen des Beurteilungstextes
*/		
	echo "<div id=\"beurteilungsblock\">";	
		echo "<div id=\"beurteilungsblock_header\">Beurteilungstext</div>";
		$beurteilung_tmp = mysql_query("SELECT * FROM lernstand.beurteilung WHERE uid = '".$_SESSION['akt_schueler_uid']."' AND term = '".$_SESSION['aktueller_term_nr']."'");
			if(mysql_num_rows($beurteilung_tmp) == 0)
				{
				}
					else 
						{  
							$beurteilung = mysql_result($beurteilung_tmp,'0','beurteilung');
						}	
		$var3 = $_SESSION['akt_schueler_uid'];
		echo "<form name=\"textarea_beurteilung\" action=\"myclass_beurteilungs_maschine.php\" method=\"POST\">";
				echo "<textarea class=\"textarea\" id=\"texteingabefeld\" name=\"beurteilung\" cols=\"180\" rows=\"6\">";
					echo $beurteilung;
				echo "</textarea>";
				echo "<input type=\"submit\" name=\"beurteilung_speichern\" value=\"Beurteilungstext speichern\">";
				echo "<input type=\"hidden\" name=\"akt_schueler_uidx\" value=\"$var3\">";
		echo "</form>";
			
			
	/*Ermittlung der Beurteilungszuarbeit durch angeforderte Kollegen*/
	//TODO term implementieren auch in der Tabelle
	$zuarbeit_beurteilung = array();
	$zuarbeit_beurteilung_tmp = mysql_query("SELECT * FROM ilias.usr_data, lernstand.beurteilung_antwort WHERE lernstand.beurteilung_antwort.uid_schueler = '".$_SESSION['akt_schueler_uid']."' AND ilias.usr_data.usr_id = lernstand.beurteilung_antwort.uid_angeforderter");
		while($row = mysql_fetch_assoc($zuarbeit_beurteilung_tmp)) 
			{
				$zuarbeit_beurteilung[] = $row['kategorie'];
				$zuarbeit_beurteilung[] = $row['wert']; 
				$zuarbeit_beurteilung[] = $row['firstname'];
				$zuarbeit_beurteilung[] = $row['lastname'];
			}
			$zuarbeit_anzahl = mysql_num_rows($zuarbeit_beurteilung_tmp);
	echo "</div>"; //beurteilungsblock	
		
		
		
	/*Erstellen der Tabelle mit den Textbloecken fuer die Beurteilung*/
	
	$beurteilungskategorie_tmp = mysql_query("SELECT * FROM lernstand.kategorien_beurteilung");	
	$kategorien_anzahl = mysql_num_rows($beurteilungskategorie_tmp);
	
	echo "<table class=\"beurteilungswahl\">";
		$kp=0;
			while($row = mysql_fetch_array($beurteilungskategorie_tmp)) 
				{
					$beurteilungskategorie[] = $row[1];
					$kategorienr[] = $row[0];
					$beurteilungstexte_tmp = mysql_query("SELECT * FROM lernstand.textbausteine_beurteilung WHERE kategorie_nr = '".$kategorienr[$kp]."'");
					$text1 = mysql_result($beurteilungstexte_tmp, '0', 'beurteilung_text');
					$text2 = mysql_result($beurteilungstexte_tmp, '1', 'beurteilung_text');
					$text3 = mysql_result($beurteilungstexte_tmp, '2', 'beurteilung_text');
					$text4 = mysql_result($beurteilungstexte_tmp, '3', 'beurteilung_text');
					if($kp % 2 == 0) 
						{
							$td0='td_0';$td1='td_1';$td2='td_2';$td4='td_4';
						}
					else
						{
							$td0='td_0a'; $td1='td_1a';$td2='td_2a';$td4='td_4a';
						}
						
	echo		"<tr><td class=$td1 rowspan=\"5\">".$beurteilungskategorie[$kp]."</td>";
	echo		"<td class=$td0 rowspan=\"5\">".beurteilung_zuarbeit($zuarbeit_beurteilung,$kategorienr[$kp])."</td></tr>";		
	echo		"<tr><td class=$td2>".$text1."</td><td class=$td4>1</td><td class=\"td_3\"><a id=\"txt1\" href=\"#\" onclick=\"texterstellen('".$text1."');return false\">&Uuml;bernehmen</a></td></tr>";
	echo		"<tr><td class=$td2>".$text2."</td><td class=$td4>2</td><td class=\"td_3\"><a id=\"txt2\" href=\"#\" onclick=\"texterstellen('".$text2."');return false\">&Uuml;bernehmen</a></td></tr>";
	echo		"<tr><td class=$td2>".$text3."</td><td class=$td4>3</td><td class=\"td_3\"><a id=\"txt3\" href=\"#\" onclick=\"texterstellen('".$text3."');return false\">&Uuml;bernehmen</a></td></tr>";
	echo		"<tr><td class=$td2>".$text4."</td><td class=$td4>4</td><td class=\"td_3\"><a id=\"txt4\" href=\"#\" onclick=\"texterstellen('".$text4."');return false\">&Uuml;bernehmen</a></td></tr>";	
	$kp++;
					}
					
	echo "</table>";		
		
	echo "</div>";
	
		}
	else
		{	 
			hinweis("../templates/hinweis3_50.jpg", "Bitte w&auml;hlen Sie im linken Men&uuml; einen Sch&uuml;ler zur weiteren Bearbeitung seiner Beurteilung aus. ");
		}	
mysql_close($verbindung);
//TODO: term implementieren
?>
   </body>
</html>
  
  