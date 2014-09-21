<?php include "../auth.php"; ?>


<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="content-type" content="text/html" charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="../templates/format.css">
 <link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
  <title>Sch&uuml;lerbewertungen</title>
  <?php include "../headline.php"; ?>
  </head>
  
  <body>
  
<ul id="tabmenue">
<li><a  href="./menue_lehrer.php" >MENUE1</a></li>
  <li><a href="./lehrer_pers.php">Anfragen zur Beurteilung</a></li>
  <li><a id="lehrertask" href="../start.php">Kompetenzen</a></li>
 <?php
if($_SESSION['myclass'] !== "") {
	echo "<li><a href=\"./lehrer_myclass.php\">Meine Klasse ".$_SESSION['myclass']." (organisatorisches)</a></li>";
	echo "<li><a href=\"./myclass_lernziele.php\">Lernziele der ".$_SESSION['myclass']."</a></li>";
}
if($_SESSION['uid'] == '177') {
	echo "<li><a href=\"./myclass_medienpass.php\">Medienpass</a></li>";
	}
	?>
</ul>
</body>
</html>
