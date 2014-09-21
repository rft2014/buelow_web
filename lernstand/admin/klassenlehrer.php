<?php include "../auth.php"; 
		include('../db_conn.php');
		
		
		
$x = count($_POST);


$spar = array();
$spar = (array_values($_POST));



$i = 0;
$j = 1;
 for($i;$i<$x;$i=$i+2) {
 
 	
	mysql_query("INSERT INTO lernstand.klassenlehrer (uid, klasse) VALUES ('".$spar[$i]."', '".$spar[$j]."') ON DUPLICATE KEY UPDATE klasse = '".$spar[$j]."';"); 	


 	$j = $j+2;
 	}
mysql_close($verbindung);
 	
 	 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/admin_klassenlehrer.php');
       exit;
?>
