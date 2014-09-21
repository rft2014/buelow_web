<?php include "../auth.php"; 
		include('../db_conn.php');?>

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
	mysql_query("INSERT INTO lernstand.bewertung (ID,uid,tmstamp,fach,wert,frage,term) VALUES (DEFAULT,'".$spAr['0']."',DEFAULT,'selbst','".$spAr[$j]."','".$spAr[$k]."','".$_SESSION['aktueller_term_nr']."')  ");	
		
 	}

 
 
 
 mysql_close($verbindung); 
//$_SESSION['zu_bewertende_Klasse'] =  $spAr[2];
//$_SESSION['zu_bewertendes_Fach'] = $spAr[1];
 
 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/schueler_ses.php');
       exit;
?>