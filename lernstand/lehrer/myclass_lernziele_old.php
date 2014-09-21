<?php include "../auth.php"; 
		include('../db_conn.php');
		include "../classes/functions.php";
?>

<!DOCTYPE html>
<html>

 <head>
 <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
 <link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
  <title>Lernziele meiner Klasse</title>
  <?php include('../headline.php');?>
  </head>
  
   <body>
   <a href="./lehrer_myclass.php" >zur&uuml;ck</a></br>
   
   <?php
$uid_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$_SESSION['myclass']."' ORDER BY lastname");
  
$lehrer_tmp = mysql_query("SELECT lastname, firstname FROM ilias.usr_data WHERE EXISTS(SELECT * FROM ilias.udf_text WHERE udf_text.usr_id = usr_data.usr_id AND udf_text.value = 'Lehrer') ORDER BY lastname");
$paukermenge = mysql_num_rows($lehrer_tmp);
$lehrer = array();
$lehrer[] = "selbst";
while($row = mysql_fetch_array($lehrer_tmp)){
	
	$lehrer[] = $row[0].", ".$row[1];	
	
	};
	
while($uid = mysql_fetch_assoc($uid_tmp)) {
	$z = $uid['usr_id'];
	$lz_tmp = mysql_query("SELECT * FROM lernziele WHERE uid = '".$z."' ");
	
	$lz1 = mysql_result($lz_tmp, '0', 'lz_text');
	$lz2 = mysql_result($lz_tmp, '1', 'lz_text');
	$lz3 = mysql_result($lz_tmp, '2', 'lz_text');
	$lz4 = mysql_result($lz_tmp, '3', 'lz_text');
	$lz5 = mysql_result($lz_tmp, '4', 'lz_text');
	echo "<div id=\"lzframe\">";
	echo "<div id=\"lzname\">".$uid['lastname'].", ".$uid['firstname']."</div></br> ";
	echo "<div id=\"lz\">";
	echo "<div id=\"lz_ht\">".ht('lernziel_1')."</div>";
	echo $lz1."</br>";
	echo "<div id=\"lz_ht\">".ht('lernziel_2')."</div>";
	echo $lz2."</br>";
	echo "<div id=\"lz_ht\">".ht('lernziel_3')."</div>";
	echo $lz3."</br>";
	echo "<div id=\"lz_ht\">".ht('lernziel_4')."</div>";
	echo $lz4."</br>";
	echo "<div id=\"lz_ht\">".ht('lernziel_5')."</div>";
	echo $lz5."</div></br>";
	echo "Beurteilung wird erstellt von: ";
	echo "<form action=\"schuelerschieben.php\" method=\"POST\">";
	echo "<select name = \"lehrerauswahl\" size =\"1\">";
	
	for($i=0; $i<$paukermenge;$i++) {
	echo "<option>".$lehrer[$i]."</option>";
	

}

	echo "</select>";
	
	echo "<input action=\"schuelerschieben.php\" type=\"submit\" value=\"Speichern\">";
	echo "</form>";
	echo "</div>";
	}  
   
   mysql_close($verbindung);
   ?>
   </body>
   </html>