<?php include "../auth.php";
require "../classes/functions.php";
include('../db_conn.php'); 

?>


<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="de" />
 	<link rel="stylesheet" type="text/css" href="../templates/format.css">
	<link rel="stylesheet" type="text/css" href="../templates/menue_schueler.css">
  	<title>Lernzielvereinbarung</title>
  	<?php include "../headline.php"; ?>
	</head>
		<body>
  			<ul id="tabmenue">
				<li><a  href="./menue_schueler.php" >Startseite</a></li>
  				<li><a id="schuelerlzv" href="./schueler_lzv.php">Lernzielvereinbarung</a></li>
  				<li><a href="./schueler_ses.php">Kompetenzen</a></li>
 			</ul>

<?php 

hinweis("../templates/hinweis3_50.jpg", "Bitte alle Felder ausf&uuml;llen und anschlie&szlig;end die Daten speichern.
			Die Eingaben k&ouml;nnen jederzeit erg&auml;nzt werden. 
			Du kannst auch einzelne Felder ausf&uuml;llen und speichern. Einmal gespeichertes kann jedoch nicht gel&ouml;scht werden.
			Im grau hinterlegten Bereich kannst du alle deine bisherigen Eintragungen lesen.
			Unter dem jeweiligen Eintrag in Klammern findest du das Datum, wann du es eingetragen hast. ");
?>

<form action = "./speichern_lzv.php" method="GET">
	<div id="lz">
	<div id="lz_header">
		<?php echo ht("lernziel_1");?>
	</div>
	<div id="old_lz_text">
		<!--<?php echo $_SESSION['lernziel_1']."</br>";?>-->
		<?php echo lernziel_aktualisieren("1");?>
	</div>
<textarea id="lz_eingabefeld" name="lz1"  cols="30" rows="40"></textarea>
	</div>
	</div>
	<div id="lz">
	<div id="lz_header">
		<?php echo ht("lernziel_2");?>
	</div>
	<div id="old_lz_text">
	<!--	<?php echo $_SESSION['lernziel_2']."</br>";?>-->
		<?php echo lernziel_aktualisieren("2");?>
	</div>
<textarea id="lz_eingabefeld" name="lz2"  cols="30" rows="40"></textarea>
</div>
</div>
<div id="lz">
<div id="lz_header">
<?php echo ht("lernziel_3");?>
</div>	
<div id="old_lz_text">
<!--<?php echo $_SESSION['lernziel_3']."</br>";?>-->
<?php echo lernziel_aktualisieren("3");?>
</div>
<textarea id="lz_eingabefeld" name="lz3"  cols="30" rows="40"></textarea>
</div>
</div>
<div id="lz">
<div id="lz_header">
<?php echo ht("lernziel_4");?>
</div>
<div id="old_lz_text">
<!--<?php echo $_SESSION['lernziel_4']."</br>";?>-->
<?php echo lernziel_aktualisieren("4");?>
</div>
<textarea id="lz_eingabefeld" name="lz4"  cols="30" rows="40"></textarea>
</div>
</div>
<div id="lz">
<div id="lz_header">
<?php echo ht("lernziel_5");?>
</div>
<div id="old_lz_text">
<!--<?php echo $_SESSION['lernziel_5']."</br>";?>-->
<?php echo lernziel_aktualisieren("5");?>
</div>
<textarea id="lz_eingabefeld" name="lz5"  cols="30" rows="40"></textarea>
</div>
</div>
<input type="submit" value="Eingaben speichern" >
</form>

</body>
</html>
