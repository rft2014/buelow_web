<?php include "../auth.php"; 
		include('../db_conn.php');

?>

<!DOCTYPE html>
<html>

 	<head>
  	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
 	<link rel="stylesheet" type="text/css" href="../templates/menue_admin.css">
 	<link rel="stylesheet" type="text/css" href="../templates/format.css">
 	<script src="../ckeditor/ckeditor.js"></script>
  	<title>Arbeitsbereich f&uuml;r Administratoren</title>
  	<?php include('../headline.php');?>
  	</head>
  
  <body>
<ul id="tabmenue">
	<li><a id="adminstart" href="./menue_admin.php" >Startseite</a></li>
  	<li><a  href="./admin_globalsettings.php">Lehrer/F&auml;cher/Kompetenzen,</a></li>
  	<li><a  href="./admin_erfassungsstand.php">Stand der Eingabe</a></li>
  	<li><a  href="./admin_klassenlehrer.php">Klassenlehrer</a></li>
</ul>
<div id="outer-wrapper">
<h1>Das aktuelle Schulhalbjahr: <?php echo $_SESSION['aktueller_term_name']?></h1>
<?php
$terms_tmp = mysql_query("SELECT * FROM lernstand.term");

echo "<form name=\"termauswahl\" action=\"termauswahl.php\" method=\"POST\">";
echo "<select name=\"termauswahl\" size=\"1\">";
while($terms = mysql_fetch_assoc($terms_tmp)) {
	$term = $terms['term'];
	$nr	= $terms['lfdnr'];
	echo "<option value=".$nr.">".$term."</option>";
}
echo "</select>";
echo "<input type=\"submit\"  value=\"Schulhalbjahr systemweit festlegen\">";
echo "</form>";
echo "<hr/>";
echo "<h1>Beurteilungen ausdrucken</h1>";
echo "<form action=\"../auswertung/makeBeurteilung.php\" method=\"POST\">";
//echo "<form action=\"./beurteilungen_drucken.php\" method=\"POST\">";
echo "<table><tr>";
for($i=1;$i<14;$i++) {
	$x=$_SESSION['alleKlassen'][$i];
echo "<td><input type=\"submit\" name=\"klasseZumDruck\" value =\"$x\"></td>";
echo "<input type=\"hidden\" name=\"admindruck\" value=\"admindruck\">";

}

echo "</tr></table></form><hr/>";

mysql_close($verbindung);
?>
 <form action="../lehrer/hinweise_lehrer.php" method="POST">
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                ...Dieser Texteditor ist noch im Testbetrieb und nur als Spielzeug fuer Herrn Teichert geeignet. Sinnvolles geht noch nicht...
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
            <input type="submit" name="text" value="Text speichern">
        </form>
</div>
</body>
</html>
