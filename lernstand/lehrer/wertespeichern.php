<?php include "../auth.php"; 
		include('../db_conn.php');






mysql_query("INSERT INTO lernstand.beurteilung_antwort (uid_schueler, uid_angeforderter,kategorie, wert, term) VALUES ('".$_SESSION['akt_schueler_uid_fremd']."','".$_SESSION['uid']."', '".$_POST['kat']."', '".$_POST['wert']."','".$_SESSION['aktueller_term_nr']."') ON DUPLICATE KEY UPDATE wert = '".$_POST['wert']."'");

			header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/lehrer_pers.php');
       	exit;

mysql_close($verbindung);
?>
