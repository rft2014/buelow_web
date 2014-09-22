<?php include "../auth.php"; ?>

<!DOCTYPE html>
<html>

 <head>
 <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
 <link rel="stylesheet" type="text/css" href="../templates/menue_lehrer.css">
  <link rel="stylesheet" type="text/css" href="../templates/format.css">
  <title>Arbeitsbereich f&uuml;r Lehrer</title>
  <?php include('../headline.php');?>
  </head>
  
  <body>
<ul id="tabmenue">
<li><a id="lehrerstart" href="./menue_lehrer.php" >Startseite</a></li>
  <li><a  href="./lehrer_pers.php">Anfragen</a></li>
  <li><a  href="../start.php">Kompetenzen</a></li>
 
 <?php
if($_SESSION['myclass'] !== "") {
	echo "<li><a href=\"./lehrer_myclass.php\">Klassendaten - ".$_SESSION['myclass']."</a></li>";
	echo "<li><a href=\"./myclass_lernziele.php\">Lernziele - ".$_SESSION['myclass']."</a></li>";
	
}	
	?>
	 <li><a href="./myclass_medienpass.php">Medienpass</a></li>
<?php

if($_SESSION['uid'] == '7568') 
	{
		echo "<li><a href=\"../kalender/index.php\">Kalender</a></li>";
	}
?>
</ul>
<div id="outer-wrapper">

<h1>Terminplan Schuljahr 2014/15</h1>
<h2>1. Halbjahr</h2>
<table summary="" >
<tr><td>bis 12.09.2014</td><td>Klassenlehrer aktualisieren die Daten ihrer Klasse (Name, 2. FS, Eth/Re) s. Klassendaten weiter unten</td></tr>
<tr><td>bis 26.09.2014</td><td>S erarbeiten sich ihre Lernziele für das 1. Halbjahr anhand der Endjahreseinschätzung vom vergangenen Schuljahr; online - Eingabe der neuen Lernziele; </td></tr>
<tr><td>bis 09.01.2015</td><td>Online Selbsteinsch&auml;tzung der Kompetenzen erfolgt durch S</td></tr>
<tr><td>bis 16.01.2015</td><td>Online Einsch&auml;tzung der Kompetenzen durch FL erfolgt</td></tr>
<tr><td>bis 23.01.2015</td><td>Ausdruck der Kompetenzb&ouml;gen zum 1. Halbjahr</td></tr>
<tr><td>am  27.01.2015</td><td>Abgabe Kompetenzb&ouml;gen Schulleitung</td></tr>
</table>
<h2>2. Halbjahr</h2>
<table summary="" >
<tr><td>ab  09.02.2015<br />bis 08.03.2015</td><td>Gespr&auml;che zur Lernentwicklung durch Klassenlehrer/Team<br />(Grundlage ist Kompetenzbogen, Reflexion Lernziele bisher, &Uuml;berarbeitung Lernziele falls notwendig)
</td></tr>
<tr><td>bis 08.03.2015</td><td>&Auml;nderungen der Lernziele online durch S, S erstellen Karteikarten und lassen sich diese vom betreffenden FL abzeichnen</td></tr>
<tr><td>bis 12.06.2015</td><td>Online Selbsteinsch&auml;tzung durch S fertig. Online Kompetenzeinsch&auml;tzung durch FL fertig. Zuarbeit Bemerkungen zur Lernentwicklung fertig.</td></tr>
<tr><td>bis 22.06.2015</td><td>Bemerkungen zur Lernentwicklung durch KL fertig</td></tr>
<tr><td>bis 29.06.2015</td><td>Ausdruck der Bemerkungen zur Lernentwicklung 2. Halbjahr</td></tr>
<tr><td>am  03.07.2015</td><td>Abgabe Bemerkungen Lernentwicklung Schulleitung</td></tr>
</table>
<!--<img src="./zeitplan.png" width="900" >-->
<!--<img src="./kompetenz.png" width="900"  >-->
<img src="./anfragen.png" width="900"  >
<img src="./kompetenzen.png" width="900"  >
<img src="./klassendaten.png" width="900"  >
<img src="./lernziele.png" width="900"  >
<!--
<div id="wasBox">
<p>
<div id="titelWort">Anfragen</div>
<p><div id="unterTitelWort">Was?</div>	Hier ist ihr Urteil aus Sicht des Fachlehrers gefragt! Lesen Sie sich die Lernziele der einzelnen Schüler durch und unterstützen Sie den Klassenlehrer durch Ihre Beurteilung bei der Erstellung der Zeugnisbemerkung.</p>
<p><div id="unterTitelWort">Wie?</div>		„Übernehmen“ Sie die Ihrer Meinung nach passenden Einschätzungen, soweit es Ihnen möglich ist. Zusätzliche Hinweise können bei Bedarf im Textfeld eingegeben und abgesendet werden. Haben Sie einen Schüler bearbeitet, löschen Sie ihn aus Ihrer Liste durch das Klicken des Buttons „Fertig“.</p>
<p><div id="unterTitelWort">Wann?</div>			Das Bearbeiten der Anfragen fällt einmalig zum Schuljahresende an. Bearbeitungsfrist: 	bis 3 Wochen vor Schuljahresende.</p>
</p>
</div>
<div id="wasBox">
<p><div id="titelWort">Kompetenzen</div></p>
<p><div id="unterTitelWort">Was?</div>	Hier schätzen Sie die Kompetenzen aller Schüler einer Klasse in Ihrem Fach ein. Die Schüler erhalten diese Einschätzung als tabellarische Übersicht zum Halb- und Endjahr und nutzen dies als Vorbereitung auf das Lernentwicklungsgespräch sowie als Basis für die Lernzielformulierung. Beachten Sie den Hinweis, in welchen Klassenstufen und Fächern eine Einschätzung von Ihnen erwartet wird.</p>
<p><div id="unterTitelWort">Wie?</div>	Wählen Sie Ihre Klasse und anschließend Ihr Fach. In der Gesamtübersicht erstellen Sie die Kompetenzeinschätzung eines Schülers durch Anklicken der entsprechenden Abstufungen. Sie haben die Möglichkeit, Einschätzungen auszulassen und speichern entweder nach jedem bearbeiteten Schüler oder abschließend den gesamten Datensatz. </p>
<p><div id="unterTitelWort">Wann?</div>		Die Bearbeitung fällt zweimal im Schuljahr an, wird jedoch durch die Möglichkeit der bloßen Überarbeitung im zweiten Halbjahr maßgeblich erleichtert. 				Bearbeitungsfrist:	1.Halbjahr – 2 Wochen vor Halbjahresende (konkretes Datum?)							2. Halbjahr – 2 Wochen vor Schuljahresende</p>
</div>

<div id="wasBox">
<p><div id="titelWort">Klassendaten</div></p>
<p><div id="unterTitelWort">Was?</div>	Hier verwaltet der Klassenlehrer die wichtigsten Daten seiner Klasse und überblickt den Bearbeitungsstand hinsichtlich der Eingabe der Lernziele seiner Schüler. (Was passiert, wenn sie nicht eingetragen haben?)</p>
<p><div id="unterTitelWort">Wie?</div>	Der Vor- und Nachname kann durch direkte Eingabe verändert werden. Bezüglich der Klasse, der 2. Fremdsprache und der Teilnahme Ethik/ Religion wählen Sie das Zutreffende aus einer Liste. Abschließend das Abspeichern nicht vergessen! Möchten Sie einen Schüler aus der Klasse entfernen, wählen Sie im Bereich „Klasse 5x“.</p>
<p><div id="unterTitelWort">Wann?</div>		Das Bearbeiten der Klassendaten obliegt dem Klassenlehrer zu Beginn des Schuljahres sowie zeitnah nach Veränderung der Klassensituation.						 Bearbeitungsfrist: </p>
</div>

<div id="wasBox">
<p><div id="titelWort">Lernziele</div></p>
<p><div id="unterTitelWort">Was?</div>	Hier kann der Klassenlehrer die Lernziele seiner Klasse einsehen und schätzt zum Schuljahresende im Rahmen der Zeugnisbemerkung den Umgang mit den Lernzielen ein. Benötigt er dabei Hilfe oder möchte er eine gesamte Einschätzung durch einen Fachkollegen vornehmen lassen, so übermittelt er diesem den entsprechenden Schüler.  Im Textfeld können die standardisierten Sätze bei Bedarf abgeändert oder ergänzt werden. Abschließend druckt der Klassenlehrer die fertigen Beurteilungen aus.</p>
<p><div id="unterTitelWort">Wie?</div>	Öffnen Sie einen Schüler Ihrer Klasse und wählen Sie durch Anklicken in der Liste  rechts einen oder mehrere Fachkollegen zur Unterstützung aus. „?“ signalisiert, an wen sie diesen Schüler übermittelt haben. Nach Bearbeitung durch den oder die Fachkollegen erhalten Sie dessen Einschätzungen als Zahlenwerte hinter den Kompetenzen. „Übernehmen“ Sie nun die Ihrer Meinung nach passende Beurteilung. Der Text wird automatisch erstellt. Ergänzen, löschen und kopieren Sie beliebig im Textfeld und speichern Sie abschließend.</p>
<p><div id="unterTitelWort">Wann?</div> 		Das Bearbeiten der Anfragen fällt einmalig zum Schuljahresende an.</p>
</div>-->
</body>
</html>
