<?php include "../auth.php"; 
		include('../db_conn.php');
		include "../classes/functions.php";
?>

<!DOCTYPE html>
<html>

 <head>
 <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
 <link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
 <link rel="stylesheet" type="text/css" href="../templates/format.css">
 <script type="text/javascript" src="textarea.js"></script>
 <script type="text/javascript" src="schuelerFertig.js"></script>
  <title>Lernziele meiner Klasse</title>
  
  </head>
  
   <body>
   <?php include('../headline.php');?>
   <ul id="tabmenue">
		<li><a href="./menue_lehrer.php" >Startseite</a></li>
  		<li><a  href="./lehrer_pers.php">Anfragen</a></li>
  		<li><a href="../start.php">Kompetenzen</a></li>
  		<?php
  		if($_SESSION['myclass'] !== "") {
	echo "<li><a href=\"./lehrer_myclass.php\">Klassendaten - ".$_SESSION['myclass']."</a></li>";
	echo "<li><a href=\"./myclass_lernziele.php\">Lernziele - ".$_SESSION['myclass']."</a></li>";
	
}	
 	?>
 		<li><a id="lehrerpers" href="./myclass_medienpass.php">Medienpass</a></li>
	</ul>
 <!-- <?php error_reporting(E_ALL ^ E_NOTICE);?>
  <?php error_reporting(0);?>-->
  <h1>Zum Gebrauch:</h1>
  <p>Die nachstehende Funktion biete die Möglichkeit, die wichtigen Medienpässe mit erträglichem Aufwand herzustellen.
  Die angegebenen Lernbereiche wurden vom Kultusministerium definiert. Bitte tragen Sie die erworbenen Kompetenzen in den jeweiligen Lernbereichszeilen ein.
  Dazu die korrespondierenden Fächer, in denen die integrative Wissensvermittlung stattfand. Leere Kompetenzfelder bleiben beim Ausdruck unberücksichtigt.
  Bei Betätigung des Buttons (rechts unten) wird eine Druckversion erzeugt und im Browser angezeigt. Hier können Sie wie gewohnt Speichern, Drucken etc. Bitte beachten Sie, dass 
  Ihre Eingaben nur für die Dauer Ihrer Session gespeichert bleiben. Speichern Sie die Ausdrucke also bitte individuell ab. Während der Dauer Ihrer Session können Sie beliebig oft zwischen der Entwurfs- und Druckansicht wechseln.     </p>
  <p>Ich hoffe es hilft.</br> Ich wünsche allen Lehrern schöne Ferien.</br>RFT</p> 
   
   
   <?php
$anzahlKlassen = count($_SESSION['alleKlassen']);
$meineSchueler_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$_SESSION['myclass']."' ORDER BY lastname");
echo "<form action=\"../tex/medienpass.php\" method=\"POST\">"; 
echo "<table border=\"1\">";
	echo "<tr>";
		echo "<th>";
			echo "Lernbereich";
		echo "</th>";
		echo "<th>";
			echo "Kompetenzen und Inhalte des Kurses Medienkunde mit Bezug zum Fachlehrplan";
		echo "</th>";
		echo "<th>";
			echo "Fach";
		echo "</th>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Information und Daten";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_1\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_1']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_1\" cols=\"5\" rows=\"3\">".$_SESSION['fach_1']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Kommunikation und Kooperation";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_2\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_2']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_2\" cols=\"5\" rows=\"3\">".$_SESSION['fach_2']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Medienproduktion, informatische Modellierung und Interpretation";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_3\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_3']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_3\" cols=\"5\" rows=\"3\">".$_SESSION['fach_3']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Präsentation";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_4\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_4']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_4\" cols=\"5\" rows=\"3\">".$_SESSION['fach_4']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Analyse, Begründung und Bewertung";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_5\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_5']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_5\" cols=\"5\" rows=\"3\">".$_SESSION['fach_5']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Mediengesellschaft";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_6\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_6']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_6\" cols=\"5\" rows=\"3\">".$_SESSION['fach_6']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Recht, Datensicherheit und Jugendmedienschutz";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"lernbereich_7\" cols=\"50\" rows=\"3\">".$_SESSION['lernbereich_7']."</textarea>";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"fach_7\" cols=\"5\" rows=\"3\">".$_SESSION['fach_7']."</textarea>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Name des Unterzeichnenden";
		echo "</td>";
		echo "<td>";
			echo "<textarea id=\"medienpass\" name=\"unterzeichner\" cols=\"5\" rows=\"1\">".$_SESSION['unterzeichner']."</textarea>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td>";
			echo "Dieser Medienpass wird erstellt f&uuml;r Klasse:";
		echo "</td>";
		echo "<td>";
			echo "<select name = \"klasse\" size =\"1\">";
				for($a=0; $a<$anzahlKlassen;$a++) {			
				echo "<option selected>".$_SESSION['alleKlassen'][$a]."</option>";}
			echo "</select>";
		echo "</td>";	
		echo "<td>";
			echo "<input type=\"submit\" value=\"Medienp&auml;sse f&uuml;r ausgew&auml;hlte Klasse drucken\">";
		echo "</td>";
	echo "</tr>";
echo "</table>"; 
echo "</form>"; 


  echo "<p>Wenn Ihnen nichts einf&auml;llt, so finden Sie <a href=\"medienpassbeispiel.php\">hier</a> ein Beispiel Das ist keine Vorlage und keine Referenz,
   muss auch nicht diskutiert werden. Es ist nur eine Anregung und f&uuml;hrt hoffentlich zu keiner Aufregung. </p>";
  
  mysql_close($verbindung);

   ?>
   </body>
   </html>