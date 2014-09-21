<?php
$verbindung = mysql_connect ("localhost",
"root", "Kallimann")
or die ("Keine Verbindung zur Datenbank möglich.
 Bitte informieren Sie den Systemadministrator.");
mysql_set_charset ('utf8');
mysql_select_db("lernstand")

or die ("Die Datenbank existiert nicht.");
  


?>
