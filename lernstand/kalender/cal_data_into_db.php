<?php include "../auth.php"; 
		include('../db_conn.php');
		include "../classes/functions.php";

var_dump($_POST);



mysql_query("INSERT INTO lernstand.kalender SET datum_von = '".$_POST['datum_von']."', zeit_von = '".$_POST['zeit_von']."', titel_kurz = '".$_POST['titel_kurz']."'");






mysql_close($verbindung);
?>