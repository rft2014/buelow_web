<?php include('auth.php'); 
		
?>

<html>
<head>
<script type="text/javascript" src="rbcheck_fach.js"></script>
<link type="text/css" rel="stylesheet" href="templates/format.css" />
</head>

<body>
<?php include('headline.php');?>
<?php
$verbindung = mysql_connect ("localhost",
"root", "Kallimann")
or die ("keine Verbindung möglich.
 Benutzername oder Passwort sind falsch");

mysql_select_db("lernstand")
or die ("Die Datenbank existiert nicht.");

$cc = $_POST['Klasse']; 
$_SESSION['zu_bewertende_Klasse'] = $cc;
$klassenstufe = preg_replace('![^5-9]!', '', $cc);//Variable fuer Auswahl aus DB/Fach und extrahiere erste Ziffer 
?>


<div id = "selectCourse">
<p>Bitte w&auml;hlen Sie Ihr Fach!</p>
<form action="datenmaske.php" name="Fach" id="Fachwahl" method="POST" onSubmit="javascript:return rbcheck_fach()">


<?php
$bewertungsfach = mysql_query("SELECT * FROM fach WHERE bewertung_klasse LIKE '%$klassenstufe%'");
$fach_anzahl = mysql_num_rows($bewertungsfach);
while($x = mysql_fetch_assoc($bewertungsfach)){
echo "<input type=\"Radio\" name=\"Fach\" id=\"Fach\" value=\"$x[fach_kurz]\">$x[fach_kurz]";
}
echo "<div class = \"a\">";
echo "<input type=\"submit\" value=\"Weiter\">";
echo "<input type=\"hidden\" name = \"Klasse\" value=\"$cc\">";
echo "</form></div>";
?>
</body>
</html>
