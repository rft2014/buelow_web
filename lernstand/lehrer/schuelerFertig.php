<?php include "../auth.php"; 
		include('../db_conn.php');
?>


<?php //var_dump($_GET);
if($_GET['fertisch'] == 1) {
	mysql_query("UPDATE lernstand.beurteilung SET fertig=1 WHERE uid = '".$_GET['schueler']."'");
	//echo $_GET['schueler']." ist fertiggestellt.";}
}
if($_GET['fertisch'] == 0){
//	echo $_GET['schueler'].' muss noch bearbeitet werden';}
	mysql_query("UPDATE lernstand.beurteilung SET fertig=0 WHERE uid = '".$_GET['schueler']."'");
}

mysql_close($verbindung);

 ?>