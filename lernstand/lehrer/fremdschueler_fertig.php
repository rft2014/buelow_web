<?php include "../auth.php"; 
		include('../db_conn.php');


/* funktion setzt beantwortete auf 1 damit der Schueler aus der Liste verschwindet
	 also beim Aufruf der Seite nicht beruecksichtigt wird
*/



$_SESSION['akt_schueler_uid_fremd'] = $_POST['schueleruid'];
mysql_query("UPDATE lernstand.beurteilung_consult SET beantwortet = '1' WHERE uid_schueler = '".$_SESSION['akt_schueler_uid_fremd']."' AND uid_geforderter = '".$_SESSION['uid']."'");
unset($_SESSION['akt_schueler_name']);			
			
			header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/lehrer_pers.php');
       	exit;

mysql_close($verbindung);
?>
