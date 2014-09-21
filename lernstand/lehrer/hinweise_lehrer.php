<?php include "../auth.php"; 
		include('../db_conn.php');

mysql_query("INSERT INTO lernstand.hinweise (tmstmp, text) VALUES (NOW(), '".$_POST['editor1']."')");

header('Location: http://'.$hostname.'/lernstand/admin/menue_admin.php');
       	exit;


mysql_close($verbindung);

?>