<?php include "../auth.php"; 


		$_SESSION['akt_schueler_uid_fremd'] = $_POST['akt_schueler_uid_fremd'];
		$_SESSION['akt_schueler_name_fremd'] = $_POST['akt_schueler_name_fremd'];
		
		header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/lehrer_pers.php');
      exit;
       
?>