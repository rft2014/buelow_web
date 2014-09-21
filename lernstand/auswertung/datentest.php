<?php
$verbindung = mysql_connect ("localhost",
"root", "Kallimann")
or die ("keine Verbindung möglich.
 Benutzername oder Passwort sind falsch");

mysql_select_db("lernstand")
or die ("Die Datenbank existiert nicht.");

$kl = $_POST['klasse'];


echo 'Klasse: '.$kl.'<br/>';
//$punkte = mysql_query("SELECT wert FROM bewertung WHERE uid ='3710' AND frage = '22' AND fach = 'Eth/Re'");
//$punkt = mysql_fetch_assoc($punkte);
//echo 'Punktwert: '.$punkt['wert'];
$column = '16';
$table = 'daten56';
$uid = '3701';
$punkt = mysql_fetch_assoc(mysql_query("SELECT * FROM $table WHERE uid = '".$uid."' " ));
//$punkt = mysql_fetch_assoc($punkte);
echo 'Punktwert: '.$punkt[$column];
?>