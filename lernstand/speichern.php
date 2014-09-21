<?php include "./auth.php"; 
		include('./db_conn.php');?>

<html>
<head>
<link type="text/css" rel="stylesheet" href="format.css" />
</head>
<body>
<?php
///$verbindung = mysql_connect ("localhost",
//"root", "Kallimann")
//or die ("keine Verbindung möglich.
// Benutzername oder Passwort sind falsch");

//mysql_select_db("lernstand")
//or die ("Die Datenbank existiert nicht.");

//Erstellen des Array mit den Daten die gespeichert werden sollen

$spAr = array();
$spAr = (array_values($_POST));
$x = count($_POST);
 

	for($j=3;$j<$x-1;$j=$j+2) {
	$k=$j+1;		
	mysql_query("INSERT INTO lernstand.bewertung (ID,uid,tmstamp,fach,wert,frage,term) VALUES (DEFAULT,'".$spAr['0']."',DEFAULT,'".$spAr['1']."','".$spAr[$j]."','".$spAr[$k]."','".$_SESSION['aktueller_term_nr']."')  ");	
		
 	}

 
 
 
 mysql_close($verbindung); 
$_SESSION['zu_bewertende_Klasse'] =  $spAr[2];
$_SESSION['zu_bewertendes_Fach'] = $spAr[1];
 
 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/datenmaske.php');
       exit;
?>
<div id="speichern">
<p>Der Datensatz wurde erfolgreich gespeichert!</p>
<p>Wie m&ouml;chten Sie fortfahren?</p>
<form  action="datenmaske.php" method="POST">

<input type="submit"  value="Bearbeitung fortsetzen">
<?php
echo "<input type=\"hidden\" name=\"Fach\" value=\"$spAr[1]\">";
echo "<input type=\"hidden\" name=\"Klasse\" value=\"$spAr[2]\">";

?>
</form>
<form action="start.php" method="POST">
<input type="submit" value="Neue Klasse w&auml;hlen">
<input type="hidden" name='pw' value="lemontree">
</form>
<form action="index.html">
<input type="submit" value="Programm verlassen">
</form>
</div>
</body>
</html>



