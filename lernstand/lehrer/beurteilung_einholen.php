<?php include "../auth.php"; 
		include('../db_conn.php');
		
	
		
		foreach ($_POST['lehrer_consult'] as $lehrerlein) {
		mysql_query("INSERT INTO lernstand.beurteilung_consult (uid_schueler, uid_anforderer,uid_geforderter, term) VALUES ('".$_SESSION['akt_schueler_uid']."', '".$_SESSION['uid']."', '".$lehrerlein."', '".$_SESSION['aktueller_term_nr']."') ON DUPLICATE KEY UPDATE beantwortet = '0'");    
    
       
		}
		mysql_close($verbindung);
		
		 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/myclass_lernziele.php');
       exit;
		?>