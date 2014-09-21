<?php include('../auth.php'); 
		include('../db_conn.php');	
		include "../classes/functions.php";
?>

<!DOCTYPE html>
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<link type="text/css" rel="stylesheet" href="../templates/tooltip.css" />
 	<link rel="stylesheet" type="text/css" href="../templates/format.css">
 	<link rel="stylesheet" type="text/css" href="../templates/menue_schueler.css">
 	<link rel="stylesheet" type="text/css" href="./templates/menue_lehrer.css">
 	<script type="text/javascript" src="../tooltip.js"></script>
<script type="text/javascript" src="./rbcheck.js"></script>
  	<title>Kompetenzen</title>
  <?php include "../headline.php"; ?>
  </head>
  
  <body onload="initTooltips()">
  
<ul id="tabmenue">
	<li><a href="./menue_schueler.php" >Startseite</a></li>
  <li><a href="./schueler_lzv.php">Lernzielvereinbarung</a></li>
  <li><a id="schuelerses" href="./schueler_ses.php">Kompetenzen</a></li>
 
</ul>


<?php

$_SESSION['zu_bewertendes_Fach'] = 'selbst';
$_SESSION['zu_bewertende_Klasse'] = $_SESSION['klasse'];
$cc = $_SESSION['zu_bewertende_Klasse'];
$dd = $_SESSION['zu_bewertendes_Fach'];
$klassenstufe = preg_replace('![^5-9]!', '', $cc);//Variable fuer Auswahl aus DB/Fach und extrahiere erste Ziffer 


$abfrageSchuelerDaten = "SELECT ilias.usr_data.firstname, ilias.usr_data.lastname, ilias.usr_data.usr_id FROM ilias.usr_data 
INNER JOIN  ilias.udf_text ON ilias.usr_data.usr_id = ilias.udf_text.usr_id AND ilias.udf_text.value = '".$cc."'
WHERE NOT EXISTS (SELECT * FROM lernstand.bewertung  WHERE lernstand.bewertung.uid = ilias.usr_data.usr_id AND lernstand.bewertung.fach = '".$dd."'
AND lernstand.bewertung.term = '22013')ORDER BY ilias.usr_data.lastname";
 
$abfrageFragen = "SELECT frage.frage_lang,frage.frage_nr, kompetenz.kompetenz, kategorie.kategorie FROM frage, kompetenz, kategorie WHERE klassenstufe LIKE '%$klassenstufe%' AND frage.kompetenz = kompetenz.kompetenz_nr AND frage.kategorie = kategorie.kategorie_nr ORDER BY frage.kategorie"; 
$ergebnisSchuelerDaten = mysql_query($abfrageSchuelerDaten);
$ergebnisFragen = mysql_query($abfrageFragen);
$zeilenSchuelerDaten = mysql_num_rows($ergebnisSchuelerDaten);
$zeilenFragen = mysql_num_rows($ergebnisFragen);
?>

<?php

echo "<div id=\"outer_wrapper\">";
echo "<div id = \"oben\">";


echo "</div>";



?>

<table align="center" border = "2" rules="rows">
<?php
$schuelerNr = 0;
$dsatzFragen = array();
$dsatzKompetenz = array();
$dsatzKategorie = array();
while($row = mysql_fetch_array($ergebnisFragen)){
	$dsatzFragen[] = $row[0];
	$dsatzFragen_Nr[] = $row[1];
	$dsatzKompetenz[] = $row[2];
	$dsatzKategorie[] = $row[3];
	}
	

 // while($dsatzSchuelerDaten = mysql_fetch_assoc($ergebnisSchuelerDaten)){
  $schuelerNr += 1; 
  $name = $_SESSION['nn'];
  $vorname = $_SESSION['vn'];
  $uid	= $_SESSION['uid'];
  $fa = $_SESSION['zu_bewertendes_Fach'];
  $kl = $_SESSION['zu_bewertende_Klasse'];
  echo  " <form name=\"abfragen\" action=\"speichern_kompetenzen.php\" method=\"POST\" onSubmit=\"javascript:return rbcheck($zeilenFragen,$schuelerNr)\"><tr><td id=\"schueler\">$name,<br> $vorname</td><td id=\"noten\">stimme voll zu<br/>stimme zu<br/>stimme weniger zu<br/>stimme nicht zu<td>";
  echo	" <input type=\"hidden\" name=\"vn\" value=\"$uid\">";
  echo "<input type=\"hidden\" name=\"fw\"  value=\"$fa\" >";
  echo "<input type=\"hidden\" name=\"kl\"  value=\"$kl\" >";
	for ($i=0;$i<$zeilenFragen;$i++){
//	$wert_tmp = mysql_query("SELECT wert FROM lernstand.bewertung WHERE uid = '".$uid."' AND fach = '".$fa."' AND frage =  '".$dsatzFragen_Nr[$i]."' AND term = '12013'");
//	$wert = mysql_result($wert_tmp,'0','wert');	
	$frage=$schuelerNr."Frage".$i;
	$frage_id="frage_id".$i;
	echo  "<td class=\"tooltip\"><span><b>$vorname $name</b>$dsatzFragen[$i]</span>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"4\" ><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"3\" ><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"2\" ><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"1\" ><br>"
	//  ."<input type=\"Radio\" name=\"$frage\" value=\"9\" ><br>" //'9' steht fuer keine Angabe
	  ."<input type=\"hidden\" name=\"$frage_id\" value=\"$dsatzFragen_Nr[$i]\">"
	."</td>";
 
	  }
    echo "<td  action=\"speichern.php\" method=\"POST\" ><input type=\"submit\"  value=\"Datensatz speichern\"></form></td>";
//  }
  
   mysql_close($verbindung); 
  ?>
  
    </tr>
  </table>
 </div> 
 

</body>
</html>





