<?php include "../auth.php"; 
		include('../db_conn.php');
		
		
		

var_dump($_POST);

mysql_query("UPDATE lernstand.akt_term SET nr='".$_POST['termauswahl']."'");
$_SESSION['aktueller_term_name'] = mysql_result(mysql_query("SELECT term FROM lernstand.term WHERE lfdnr='".$_POST['termauswahl']."'"),'0','term');













mysql_close($verbindung);
 	
 	 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/menue_admin.php');
       exit;
?>