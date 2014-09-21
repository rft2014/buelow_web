<?php 
include "../auth.php";
require "../classes/functions.php";
require "../db_conn.php";
?>
<html>
	<head>
	<link type="text/css" rel="stylesheet" href="../templates/format.css" />
	</head>
	<body>

<?php


for ($i=1; $i<6; $i++)
	{
		if($_GET['lz'.$i] != '') 
		{
			$eingabe = $_GET['lz'.$i];
			$eingabe_clean = htmlspecialchars($eingabe);

			mysql_query("INSERT INTO lernziele (lfdnr, uid, tmstmp, lz_nr, lz_text, term) VALUES (DEFAULT, '".$_SESSION['uid']."',
 			DEFAULT, '".$i."', '".$eingabe_clean."', '".$_SESSION['aktueller_term_nr']."')");
		}
	}
	
mysql_close($verbindung); 
?>

		<div id="speichern">
		<p>Daten erfolgreich gespeichert!</p>
			<form action="./schueler_lzv.php">
				<input type="submit" value="OK">
			</form>
		</div>
	</body>
</html>
