<?php include "../auth.php"; 
		include('../db_conn.php');?>

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
  <li><a id = "adminglobal" href="./admin_globalsettings.php">Lehrer/F&auml;cher/Kompetenzen</a></li>
  <li><a  href="./admin_erfassungsstand.php">Stand der Eingabe</a></li>
 <li><a  href="./admin_klassenlehrer.php">Klassenlehrer</a></li>
</ul>
<h1>Aufgabenverteilung</h1>
<?php
$numteacher = count($_SESSION['alleLehrer']);
$numrows = count($_SESSION['alleFaecher']);
$numcolumns = count($_SESSION['alleKlassen']);
$var1 = array(); 
$var1[]="aa ";
$var1[]="bb ";
	for($k=0;$k<($numteacher-3);$k=$k+3) {
		$var1[]=	$_SESSION['alleLehrer'][$k];
		$var1[]= $_SESSION['alleLehrer'][$k+1];
	}
echo "<form action=\"aufgabenverteilung\" method=\"POST\">";
echo "<table border=\"1\"><tr>";

	for($l=0;$l<$numcolumns;$l++) {//Spaltenbezeichner
	
			echo "<th>".$_SESSION['alleKlassen'][$l]."</th>";}
			echo "</tr>";
			
	for($i=1;$i<($numrows);$i++) {//Zeilenbezeichner
	
			echo "<tr><th>".$_SESSION['alleFaecher'][$i]."</th>";
			
	for($j=0;$j<$numcolumns-1;$j++) {//Selectboxen
			echo "<td>";
			
			$anzahlLehrer = count($_SESSION['alleLehrer']);
			
		echo "<select name = \"var_lehrerauswahl\" size =\"1\">";

		echo "<option></option>";
	for($m=0; $m<$numteacher;$m=$m+3) {
		echo "<option>".$_SESSION['alleLehrer'][$m].", ".$_SESSION['alleLehrer'][$m+1]."</option>";}	
			
	echo "</td>";
	
	
	
	
		}
	}
	echo "</tr>";	

echo "</table>";
echo "</form>";
//var_dump($_SESSION);
mysql_close($verbindung);
?>
</body>
</html>
