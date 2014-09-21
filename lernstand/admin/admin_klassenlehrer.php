<?php include "../auth.php"; 
		include('../db_conn.php');

?>


<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="content-type" content="text/html" charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="../templates/format.css">
 <link rel="stylesheet" type="text/css" href="../templates/menue_admin.css">
  <title>Sch&uuml;lerbewertungen</title>
  <?php include "../headline.php"; ?>
  </head>
  
  <body>
  
<ul id="tabmenue">
<li><a  href="./menue_admin.php" >Startseite</a></li>
  <li><a  href="./admin_globalsettings.php">Lehrer/F&auml;cher/Kompetenzen</a></li>
  <li><a  href="./admin_erfassungsstand.php">Stand der Eingabe</a></li>
 <li><a id="adminglobal" href="./admin_klassenlehrer.php">Klassenlehrer</a></li>
</ul>

<?php
$klassen = array();
$klassen_tmp = mysql_query("SELECT * FROM lernstand.klassenstufe ORDER BY lfdnr");
$anzahlKlassen = mysql_num_rows($klassen_tmp);
while($row = mysql_fetch_array($klassen_tmp)){
	$klassen[] = $row[1];	
	
	};


$lehrer_tmp = mysql_query("SELECT * FROM ilias.usr_data WHERE EXISTS(SELECT * FROM ilias.udf_text WHERE udf_text.usr_id = usr_data.usr_id AND udf_text.value = 'Lehrer') ORDER BY lastname");
$x = mysql_num_rows($lehrer_tmp);
$lehrer_nr = 0;

//echo "<form action=\"klassenlehrer.php\" method=\"POST\">";

echo "<table border = \"1\">";
echo "<tr><th>lfd. Nr.</th><th>Name</th><th>Vorname</th><th>Klasse</th><th>Aktion</th></tr>";
while($_lehrer = mysql_fetch_assoc($lehrer_tmp)) {
	echo "<form action=\"klassenlehrer.php\" method=\"POST\">";
$lehrer_nr = $lehrer_nr + 1;	
$z = $_lehrer['usr_id'];
$var_name = "uid_".$lehrer_nr;
$var_klassenauswahl = "klassenauswahl_".$lehrer_nr;
echo "<tr>";
echo "<td>$lehrer_nr</td>";	
echo "<td>".$_lehrer['lastname']."</td>";
echo "<td>".$_lehrer['firstname'];
echo "<input type=\"hidden\" name=\"$var_name\" value=\"$z\">";

echo "</td>";


$klasseDesLehrers = mysql_result(mysql_query("SELECT klasse FROM lernstand.klassenlehrer WHERE uid = '".$z."';"),'0','klasse');

echo "<td>";

echo "<select name = \"$var_klassenauswahl\" size =\"1\">";
for($i=0; $i<$anzahlKlassen;$i++) {
	if($i+1 == mysql_result(mysql_query("SELECT lfdnr FROM lernstand.klassenstufe WHERE klasse = '".$klasseDesLehrers."'"),'0','lfdnr')) {
	echo "<option selected>".$_SESSION['alleKlassen'][$i]."</option>";}
	else{echo "<option>".$_SESSION['alleKlassen'][$i]."</option>";}

}
echo "</select>";
echo "</td>";
echo "<td><input action=\"klassenlehrer.php\" type=\"submit\" value=\"&Auml;nderungen speichern\"></td>";
echo "</tr>";

echo "</form>";
	}
//echo "<tr><td align=\"right\" colspan=\"5\"><input action=\"klassenlehrer.php\" type=\"submit\" value=\"Speichern\"></td></tr>";
echo "</table>";



//echo "</form>";
mysql_close($verbindung);
?>

</body>
</html>
