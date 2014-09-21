<?php include "../auth.php"; 
		include('../db_conn.php');
		
		
		
		
		$schueleruid_tmp = $_SESSION['akt_schueler_uid'];	
		$beurteilung_tmp = $_POST['beurteilung'];
		mysql_query("INSERT INTO lernstand.beurteilung (uid,term, beurteilung) VALUES ('".$schueleruid_tmp."','".$_SESSION['aktueller_term_nr']."', '".$beurteilung_tmp."') ON DUPLICATE KEY UPDATE beurteilung = '".$beurteilung_tmp."';");


		
	mysql_close($verbindung);
	
		
		header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/myclass_lernziele.php');
       exit;
     
     
     
?>