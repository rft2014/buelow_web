<?php include "../auth.php"; 
		include('../db_conn.php');
		
		
	
$x = count($_POST);

var_dump($_POST);
//echo $_POST['uid_1'];
//echo $_POST['klassenauswahl_1'];
$spar = array();
$spar = (array_values($_POST));

/*

$i = 0;
$j = 1;
 for($i;$i<$x;$i=$i+2) {
 
 	
	mysql_query("INSERT INTO lernstand.klassenlehrer (uid, klasse) VALUES ('".$spar[$i]."', '".$spar[$j]."') ON DUPLICATE KEY UPDATE klasse = '".$spar[$j]."';"); 	


 	$j = $j+2;
 	}
 	*/
 //	 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/myclass_lernziele.php');
 //      exit;
?>
