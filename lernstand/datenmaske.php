<?php include('auth.php'); 
		include('./db_conn.php');	
		include "./classes/functions.php";
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<link type="text/css" rel="stylesheet" href="./templates/tooltip.css" />
<link type="text/css" rel="stylesheet" href="./templates/format.css" />
<link rel="stylesheet" type="text/css" href="./templates/menue_lehrer.css">

<script type="text/javascript" src="tooltip.js"></script>
<script type="text/javascript" src="rbcheck.js"></script>


</head>
<body  onload="initTooltips()">
<?php include('headline.php');?>
<ul id="tabmenue">
	<li><a  href="./lehrer/menue_lehrer.php" >Startseite</a></li>
  	<li><a  href="./lehrer/lehrer_pers.php">Anfragen zur Beurteilung</a></li>
  	<li><a id="lehrerstart" href="./start.php">Kompetenzen</a></li>
 <?php
 error_reporting(0);//wegen sarah hesse, da sie keine alten Daten zur Vorbelegung der Kompetenzen hat TODO bessere Loesung finden
if($_SESSION['myclass'] !== "") {
	echo "<li><a href=\"./lehrer/lehrer_myclass.php\">Klassendaten - ".$_SESSION['myclass']."</a></li>";
	echo "<li><a href=\"./lehrer/myclass_lernziele.php\">Lernziele der ".$_SESSION['myclass']."</a></li>";
}
	?>
</ul>



<?php
if(isset($_POST['Fach'])) {
$_SESSION['zu_bewertendes_Fach'] = $_POST['Fach'];
//$_SESSION['zu_bewertende_Klasse'] = $_POST['Klasse'];
}
$_create_schuelerdaten="CREATE TABLE IF NOT EXISTS schuelerdaten (uid INTEGER, username VARCHAR(50), firstname VARCHAR(50), lastname VARCHAR(50), klasse VARCHAR(10),sex VARCHAR(1), fremdsprache VARCHAR(15),PRIMARY KEY (uid))";
$_create_bewertung = "CREATE TABLE IF NOT EXISTS bewertung (uid INTEGER, tmstamp TIMESTAMP, fach VARCHAR(10), wert INTEGER, frage INTEGER, FOREIGN KEY (uid) REFERENCES schuelerdaten(uid))";
$_create_frage = "CREATE TABLE IF NOT EXISTS frage (frage_nr INTEGER, frage_lang VARCHAR(200), kategorie VARCHAR(10), kompetenz VARCHAR(50), PRIMARY KEY (frage_nr))";
$_create_fach = "CREATE TABLE IF NOT EXISTS fach (fach_kurz VARCHAR(10), fach_lang VARCHAR(50), bewertung_klasse VARCHAR(5), PRIMARY KEY (fach_lang))";
$_create_kompetenz = "CREATE TABLE IF NOT EXISTS kompetenz (kompetenz_nr INTEGER, kompetenz VARCHAR(50),PRIMARY KEY(kompetenz_nr))";
$_create_kategorie = "CREATE TABLE IF NOT EXISTS kategorie (kategorie_nr INTEGER, kategorie VARCHAR(50), PRIMARY KEY(kategorie_nr))";
$_create_klassenstufe = "CREATE TABLE IF NOT EXISTS klassenstufe (klassenstufe_nr INTEGER, klassenstufe VARCHAR(10), PRIMARY KEY(klassenstufe_nr))";
$_drop_schuelerdaten = "DROP TABLE  IF EXISTS schuelerdaten";
$_drop_bewertung = "DROP TABLES IF EXISTS bewertung";
$_drop_frage = "DROP TABLE  IF EXISTS frage";
$_drop_fach = "DROP TABLE IF EXISTS fach";
$_drop_kompetenz = "DROP TABLE IF EXISTS kompetenz";
$_drop_kategorie = "DROP TABLE IF EXISTS kategorie";
$_drop_klassenstufe = "DROP TABLE IF EXISTS klassenstufe";

//$cc = $_POST['Klasse']; 
$cc = $_SESSION['zu_bewertende_Klasse'];
$dd = $_SESSION['zu_bewertendes_Fach'];
$klassenstufe = preg_replace('![^5-9]!', '', $cc);//Variable fuer Auswahl aus DB/Fach und extrahiere erste Ziffer 


$abfrageSchuelerDaten = "SELECT ilias.usr_data.firstname, ilias.usr_data.lastname, ilias.usr_data.usr_id FROM ilias.usr_data 
INNER JOIN  ilias.udf_text ON ilias.usr_data.usr_id = ilias.udf_text.usr_id AND ilias.udf_text.value = '".$cc."'
WHERE NOT EXISTS (SELECT * FROM lernstand.bewertung  WHERE lernstand.bewertung.uid = ilias.usr_data.usr_id AND lernstand.bewertung.fach = '".$dd."'
AND lernstand.bewertung.term = '".$_SESSION['aktueller_term_nr']."')ORDER BY ilias.usr_data.lastname";
 
$abfrageFragen = "SELECT frage.frage_lang,frage.frage_nr, kompetenz.kompetenz, kategorie.kategorie FROM frage, kompetenz, kategorie WHERE klassenstufe LIKE '%$klassenstufe%' AND frage.kompetenz = kompetenz.kompetenz_nr AND frage.kategorie = kategorie.kategorie_nr ORDER BY frage.kategorie"; 
$ergebnisSchuelerDaten = mysql_query($abfrageSchuelerDaten);
$ergebnisFragen = mysql_query($abfrageFragen);
$zeilenSchuelerDaten = mysql_num_rows($ergebnisSchuelerDaten);
$zeilenFragen = mysql_num_rows($ergebnisFragen);
?>

<?php

echo "<div id=\"outer_wrapper\">";
echo "<div id = \"oben\">";
echo "ausgew&auml;hlte Klasse:  "  . $_SESSION['zu_bewertende_Klasse'] . "   ";
echo "Sch&uuml;lerzahl:  " . $zeilenSchuelerDaten . "   ";
echo "Fach: " . $_SESSION['zu_bewertendes_Fach']."  ";
//echo "<form action=\"index.html\"><input type=\"submit\" value=\"Programm verlassen\"></form>";
echo "</div>";


//mysql_query($_drop_schuelerdaten);
//mysql_query($_drop_bewertung);
//mysql_query($_drop_frage);
//mysql_query($_drop_fach);
//mysql_query($_drop_kompetenz);
//mysql_query($_drop_kategorie);
//mysql_query($_drop_klassenstufe);
mysql_query($_create_schuelerdaten);
mysql_query($_create_bewertung);
mysql_query($_create_frage);
mysql_query($_create_fach);
mysql_query($_create_kompetenz);
mysql_query($_create_kategorie);
mysql_query($_create_klassenstufe);

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
	

  while($dsatzSchuelerDaten = mysql_fetch_assoc($ergebnisSchuelerDaten)){
  $schuelerNr += 1; 
  $name = $dsatzSchuelerDaten["lastname"];
  $vorname =$dsatzSchuelerDaten["firstname"] ;
  $uid	=$dsatzSchuelerDaten["usr_id"];
  $fa = $_SESSION['zu_bewertendes_Fach'];
  $kl = $_SESSION['zu_bewertende_Klasse'];
  echo  " <form name=\"abfragen\" action=\"speichern.php\" method=\"POST\" onSubmit=\"javascript:return rbcheck($zeilenFragen,$schuelerNr)\"><tr><td id=\"schueler\">$name,<br> $vorname</td><td id=\"noten\">stimme voll zu<br/>stimme zu<br/>stimme weniger zu<br/>stimme nicht zu<br/>keine Angabe<td>";
  echo	" <input type=\"hidden\" name=\"vn\" value=\"$uid\">";
  echo "<input type=\"hidden\" name=\"fw\"  value=\"$fa\" >";
  echo "<input type=\"hidden\" name=\"kl\"  value=\"$kl\" >";
	for ($i=0;$i<$zeilenFragen;$i++){
	$wert_tmp = mysql_query("SELECT wert FROM lernstand.bewertung WHERE uid = '".$uid."' AND fach = '".$fa."' AND frage =  '".$dsatzFragen_Nr[$i]."' AND term = '".$_SESSION['aktueller_term_nr']."'-1");
	$wert = mysql_result($wert_tmp,'0','wert');	
	$frage=$schuelerNr."Frage".$i;
	$frage_id="frage_id".$i;
	echo  "<td class=\"tooltip\"><span><b>$vorname $name</b>$dsatzFragen[$i]</span>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"4\" ".preselect($wert,'4')."><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"3\" ".preselect($wert,'3')."><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"2\" ".preselect($wert,'2')."><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"1\" ".preselect($wert,'1')."><br>"
	  ."<input type=\"Radio\" name=\"$frage\" value=\"9\" ".preselect($wert,'9')."><br>" //'9' steht fuer keine Angabe
	  ."<input type=\"hidden\" name=\"$frage_id\" value=\"$dsatzFragen_Nr[$i]\">"
	."</td>";
 
	  }
    echo "<td  action=\"speichern.php\" method=\"POST\" ><input type=\"submit\"  value=\"Datensatz speichern\"></form></td>";
  }
  
   mysql_close($verbindung); 
  ?>
  
    </tr>
  </table>
 </div> 
 

</body>
</html>
