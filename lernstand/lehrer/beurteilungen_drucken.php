<?php include "../auth.php"; 
		include('../db_conn.php');
/*ruft makeBeurteilung.php fuer jede Klasse auf
	Klasse wird mitgegeben
*
*/









mysql_close($verbindung);

header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/menue_admin.php');
       exit;
?>