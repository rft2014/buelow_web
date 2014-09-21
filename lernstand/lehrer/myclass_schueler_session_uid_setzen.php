<?php include "../auth.php"; 


		$_SESSION['akt_schueler_uid'] = $_POST['akt_schueler_uid'];
		$_SESSION['akt_schueler_name'] = $_POST['akt_schueler_name'];
		
		header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/myclass_lernziele.php');
      exit;
       
?>