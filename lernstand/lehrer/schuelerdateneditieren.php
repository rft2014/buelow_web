<?php include "../auth.php"; 
		include('../db_conn.php');
		
		
var_dump($_POST);		

 mysql_query("INSERT INTO ilias.udf_text (usr_id, field_id, value) VALUES ('".$_POST['schueler']."','3', '".$_POST['sprache']."') ON DUPLICATE KEY UPDATE value = '".$_POST['sprache']."'");	
 mysql_query("INSERT INTO ilias.udf_text (usr_id, field_id, value) VALUES ('".$_POST['schueler']."','4', '".$_POST['reli']."') ON DUPLICATE KEY UPDATE value = '".$_POST['reli']."'");	
 mysql_query("INSERT INTO ilias.udf_text (usr_id, field_id, value) VALUES ('".$_POST['schueler']."','1', '".$_POST['klasse']."') ON DUPLICATE KEY UPDATE value = '".$_POST['klasse']."'");		 
 mysql_query("INSERT INTO ilias.usr_data (usr_id, firstname, lastname) VALUES ('".$_POST['schueler']."', '".$_POST['firstname']."', '".$_POST['lastname']."') ON DUPLICATE KEY UPDATE 	firstname = '".$_POST['firstname']."', lastname = '".$_POST['lastname']."' ");
 	 
 	 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/lehrer_myclass.php');
       exit;
?>
