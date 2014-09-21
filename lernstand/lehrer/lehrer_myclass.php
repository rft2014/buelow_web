<?php include "../auth.php"; 
		include('../db_conn.php');
?>

<!DOCTYPE html>
<html>
	<head>
 	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
 	<link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
 	<link rel="stylesheet" type="text/css" href="../templates/format.css">
  	<title>Klassenlehrerseite</title>
  	<?php include('../headline.php');?>
  	</head>
  		<body>
 			<ul id="tabmenue">
				<li><a href="./menue_lehrer.php" >Startseite</a></li>
  				<li><a  href="./lehrer_pers.php">Anfragen</a></li>
  				<li><a href="../start.php">Kompetenzen</a></li>
 				<li><a id = "lehrerpers" href="./lehrer_myclass.php">Klassendaten -  <?php echo $_SESSION['myclass'];?></a></li>
 				<li><a href="./myclass_lernziele.php">Lernziele -  <?php echo $_SESSION['myclass'];?></a></li>
 				<li><a href="./myclass_medienpass.php">Medienpass</a></li>
			</ul>

<?php

	$classmember_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON
	 usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$_SESSION['myclass']."' ORDER BY lastname");
	echo "<table>";
		echo "<tr><th>Nr.</th><th>Nachname</th><th>Vorname</th><th>Klasse</th><th>2. FS</th><th>Eth/Rel</th><th>Lernziel<br/> aktualisiert</th><th>Kompetenzen<br/>aktualisiert</th><th>Action</th></tr>";
		$i = 0;
		while ($classmember = mysql_fetch_assoc($classmember_tmp))
			{
				$i++;
				$x = $classmember['usr_id'];
				$erledigt_lz = mysql_num_rows(mysql_query("SELECT * FROM lernstand.lernziele WHERE  lernziele.uid = '".$x."' AND term = '".$_SESSION['aktueller_term_nr']."'"));
				$erledigt_komp = mysql_num_rows(mysql_query("SELECT * FROM lernstand.bewertung WHERE  uid = '".$x."' AND fach = 'selbst' AND term = '".$_SESSION['aktueller_term_nr']."'"));
				echo "<form action=\"schuelerdateneditieren.php\" method=\"POST\">";
					echo "<input type=\"hidden\" name=\"schueler\" value=\"$x\">";
					echo "<tr>";
						echo "<td>";
						echo $i."</td><td>";
							$y = $classmember['lastname'];
					echo "<input class=\"text\"type=\"text\" name=\"lastname\" value=\"$y\">";
						echo "</td><td>";
							$z = $classmember['firstname'];
					echo "<input class=\"text\" type=\"text\" name=\"firstname\" value=\"$z\">";
						echo "</td><td>";
			//Klasse
				$anzahlKlassen = count($_SESSION['alleKlassen']);
					if(mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '".$x."' AND field_id = '1'")) > '0')
						{
							$klassedesSchuelers = mysql_result(mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '".$x."' AND field_id = '1';"),'0','value');
						}
					else 
						{
							$klassedesSchuelers = ' ';
						}
					echo "<select name = \"klasse\" size =\"1\">";
					for($a=0; $a<$anzahlKlassen;$a++)
						{
							if($a+1 == mysql_result(mysql_query("SELECT lfdnr FROM lernstand.klassenstufe WHERE klasse = '".$klassedesSchuelers."'"),'0','lfdnr')) 
								{
									echo "<option selected>".$_SESSION['alleKlassen'][$a]."</option>";
								}
							else
								{
									echo "<option>".$_SESSION['alleKlassen'][$a]."</option>";
								}
						}
					echo "</select>";
			
						echo "</td><td>";
	//zweite Fremdsprache
							$anzahlFaecher = count($_SESSION['alleFaecher']);
					if(mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '".$x."' AND field_id = '3'")) > '0')
						{
							$zweiteFSdesSchuelers = mysql_result(mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '".$x."' AND field_id = '3';"),'0','value');
						}
					else 
						{
							$zweiteFSdesSchuelers = ' ';
						}
					echo "<select name = \"sprache\" size =\"1\">";
					for($a=0; $a<$anzahlFaecher;$a++) 
						{
							if($a+1 == mysql_result(mysql_query("SELECT lfdnr FROM lernstand.fach WHERE fach_kurz = '".$zweiteFSdesSchuelers."'"),'0','lfdnr')) 
								{
									echo "<option selected>".$_SESSION['alleFaecher'][$a]."</option>";
								}
							else
							{
								echo "<option>".$_SESSION['alleFaecher'][$a]."</option>";
							}
						}
					echo "</select>";
					echo "</td><td>";
	
	//Ethik/Religion
							$anzahlFaecher = count($_SESSION['alleFaecher']);
					if(mysql_num_rows(mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '".$x."' AND field_id = '4'")) > '0')
						{
							$religiondesSchuelers = mysql_result(mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '".$x."' AND field_id = '4';"),'0','value');
						}
					else 
						{
							$religiondesSchuelers = ' ';
						}
						echo "<select name = \"reli\" size =\"1\">";
					for($a=0; $a<$anzahlFaecher;$a++) 
						{
							if($a+1 == mysql_result(mysql_query("SELECT lfdnr FROM lernstand.fach WHERE fach_kurz = '".$religiondesSchuelers."'"),'0','lfdnr')) 
								{
									echo "<option selected>".$_SESSION['alleFaecher'][$a]."</option>";
								}
							else
								{
									echo "<option>".$_SESSION['alleFaecher'][$a]."</option>";
								}
						}
						echo "</select>";
						echo "</td>";
						echo "<td align=\"center\">";
	
					if($erledigt_lz > 0)
						{
							echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";
						}
						else
							{
								echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";
							}
						echo "</td><td align=\"center\">";	
					if($erledigt_komp > 0)
						{
							echo "<img src=\"../auswertung/checked.jpeg\" width=\"18px\" heigth=\"18px\">";
						}
					else
						{
							echo "<img src=\"../auswertung/notchecked.jpeg\" width=\"18px\" heigth=\"18px\">";
						}
						echo "</td><td>";
						echo "<input type=\"submit\" value=\"&Auml;nderungen speichern\"></td>";
				echo "</tr>";
			echo "</form>";
		};
	echo "</table";
	echo "</br>";
	echo "<table>";
		echo "<tr><form name=\"klassenliste\" action=\"../auswertung/makeKlassenliste.php\">";
			echo "<td colspan =\"2\">";
				echo "Vollst&auml;ndige Namensliste meiner Klasse drucken";
			echo "</td>";
		echo "<td colspan=\"7\" align=\"right\">";
		echo "<input type=\"submit\" value=\"Liste drucken\">";
		echo "</td></tr></form>";
	
		echo "<tr><form name=\"klassenliste_filter\" action=\"../auswertung/makeKlassenliste_gefiltert.php\" method=\"POST\">";
			echo "<td colspan =\"2\">";
				echo "Gefilterte Namensliste meiner Klasse drucken";
			echo "</td>";
			echo "<td colspan=\"4\">";
			echo "Filterkriterium (bezieht sich auf 2.FS und Eth/Re):";
			echo "<td colspan=\"1\">";
			echo "<select name = \"klassenliste_filter\" size =\"1\">";
			for($a=0; $a<$anzahlFaecher;$a++) 
				{
					echo "<option>".$_SESSION['alleFaecher'][$a]."</option>";
				}
			echo "</select>";	
			echo "</td>";
			echo "<td colspan=\"2\" align=\"right\">";
			echo "<input type=\"submit\" value=\"Liste drucken\">";
			echo "</td>";
	echo "</tr></form>";
	echo "<tr><form name=\"notenliste\" action=\"../auswertung/makeNotenliste.php\" method=\"GET\">";
			echo "<td colspan =\"2\">";
				echo "Notenliste fuer meine Klasse drucken";
			echo "</td>";
			echo "<td colspan=\2\>";
				echo "Zeilenh&ouml;he: ";
			echo "</td>";
			echo "<td colspan=\"3\">";
				echo "<input name=\"zeilenh\" type=\"text\" value=\"7.35\">";
			echo "</td>";	
			echo "<td colspan=\"2\" align=\"right\">";
				echo "<input type=\"submit\" value=\"Liste drucken\">";
			echo "</td></tr></form>";
	echo "</table>";
mysql_close($verbindung);
?>

</body>
</html>