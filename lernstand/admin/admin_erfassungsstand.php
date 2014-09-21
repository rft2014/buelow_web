<?php include "../auth.php"; 
		include('../db_conn.php');
?>


<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="content-type" content="text/html" charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="../templates/format.css">
 <link rel="stylesheet" type="text/css" href="../templates/menue_admin.css">
  <title>Sch&uuml;lerbewertungen</title>
  <?php include "../headline.php"; ?>
  </head>
  
  <body>
  
<ul id="tabmenue">
<li><a  href="./menue_admin.php" >Startseite</a></li>
  <li><a  href="./admin_globalsettings.php">Lehrer/F&auml;cher/Kompetenzen</a></li>
  <li><a id = "adminerfassung" href="./admin_erfassungsstand.php">Stand der Eingabe</a></li>
 <li><a  href="./admin_klassenlehrer.php">Klassenlehrer</a></li>
</ul>
<h2>Stand der &Uuml;berarbeitung der Lernziele im Zeitraum <?php echo $_SESSION['aktueller_term_name']?></h2>

<?php
$_5a_soll = mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '5a'"));
$_5b_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '5b' "));
$_6_1_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '6/1' "));
$_6_2_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '6/2'  "));
$_6_3_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '6/3'  "));
$_7a_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '7a'  "));
$_7b_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '7b'  "));
$_8a_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '8a'  "));
$_8b_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '8b'  "));
$_8c_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '8c'  "));
$_9a_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '9a'  "));
$_9b_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '9b'  "));
$_9c_soll= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE value = '9c'  "));
$_5a_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '5/1'"));;
$_5b_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '5/2'"));;
$_6_1_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '5/3'"));;
$_6_2_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '6a'"));;
$_6_3_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '6b'"));;
$_7a_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '7a'"));;
$_7b_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '7b'"));;
$_8a_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '8a'"));;
$_8b_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '8b'"));;
$_8c_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '8c'"));;
$_9a_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '9a'"));;
$_9b_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '9b'"));;
$_9c_haben= mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE EXISTS (SELECT * FROM lernziele WHERE ilias.udf_text.usr_id = lernziele.uid AND term = '".$_SESSION['aktueller_term_nr']."') AND ilias.udf_text.value = '9c'"));;


mysql_close($verbindung);
?>

<table border="1">
<tr>
<th>Klasse</th><th>Anzahl Sch&uuml;ler</th><th>LZ bearbeitet</th><th>Status</th>
</tr>

<tr><td>5a</td><td><?php echo $_5a_soll; ?></td><td><?php echo $_5a_haben; ?></td><td><?php if($_5a_soll - $_5a_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>5b</td><td><?php echo $_5b_soll; ?></td><td><?php echo $_5b_haben; ?></td><td><?php if($_5b_soll - $_5b_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>6/1</td><td><?php echo $_6_1_soll; ?></td><td><?php echo $_6_1_haben; ?></td><td><?php if($_6_1_soll - $_6_1_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>6/2</td><td><?php echo $_6_2_soll; ?></td><td><?php echo $_6_2_haben; ?></td><td><?php if($_6_2_soll - $_6_2_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>6/3</td><td><?php echo $_6_3_soll; ?></td><td><?php echo $_6_3_haben; ?></td><td><?php if($_6_3_soll - $_6_3_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>7a</td><td><?php echo $_7a_soll; ?></td><td><?php echo $_7a_haben; ?></td><td><?php if($_7a_soll - $_7a_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>7b</td><td><?php echo $_7b_soll; ?></td><td><?php echo $_7b_haben; ?></td><td><?php if($_7b_soll - $_7b_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>8a</td><td><?php echo $_8a_soll; ?></td><td><?php echo $_8a_haben; ?></td><td><?php if($_8a_soll - $_8a_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>8b</td><td><?php echo $_8b_soll; ?></td><td><?php echo $_8b_haben; ?></td><td><?php if($_8b_soll - $_8b_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>8c</td><td><?php echo $_8c_soll; ?></td><td><?php echo $_8c_haben; ?></td><td><?php if($_8c_soll - $_8c_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>9a</td><td><?php echo $_9a_soll; ?></td><td><?php echo $_9a_haben; ?></td><td><?php if($_9a_soll - $_9a_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>9b</td><td><?php echo $_9b_soll; ?></td><td><?php echo $_9b_haben; ?></td><td><?php if($_9b_soll - $_9b_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
<tr><td>9c</td><td><?php echo $_9c_soll; ?></td><td><?php echo $_9c_haben; ?></td><td><?php if($_9c_soll - $_9c_haben > 0){echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";}else{echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";} ?></td></tr>
</table>
</body>
</html>
