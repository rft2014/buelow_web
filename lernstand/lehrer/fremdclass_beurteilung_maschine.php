<?php include "../auth.php"; 
		include('../db_conn.php');
		
		
		
		
		$schueleruid_tmp = $_SESSION['akt_schueler_uid_fremd'];	
		$beurteilung_tmp = $_POST['beurteilung'];
		$hinweis_tmp = $_POST['hinweis'];
		mysql_query("INSERT INTO lernstand.beurteilung_antwort (uid_schueler,uid_angeforderter, kategorie, wert,term) VALUES ('".$schueleruid_tmp."','".$_SESSION['uid']."','99', '".$hinweis_tmp."', '".$_SESSION['aktueller_term_nr']."') ON DUPLICATE KEY UPDATE wert = '".$hinweis_tmp."';");


		
	mysql_close($verbindung);
	//var_dump($_POST);
		
		header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/lehrer_pers.php');
       exit;
     
     
     //TODO term implementieren
?>