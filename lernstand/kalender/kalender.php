<?php //include "../auth.php"; 
		include('../db_conn.php');

					echo "BEGIN:VCALENDAR"."\n";
$kalData_tmp = mysql_query("SELECT * FROM lernstand.kalender");
	while($row = mysql_fetch_assoc($kalData_tmp))
			{	
				echo "BEGIN:VEVENT"."\n";
				echo "DTSTART:".str_replace("-", "", $row['datum_von'])."\n";
				echo "SUMMARY:".$row['titel_kurz']."\n";
				echo "DESCRIPTION:".$row['titel_lang']."\n";
				echo "LOCATION:".$row['ort']."\n";
				echo "END:VEVENT"."\n";
			}
				echo "END:VCALENDAR"."\n";
				
mysql_close($verbindung);
?>	
	
	
	
	
	</body>
</html>