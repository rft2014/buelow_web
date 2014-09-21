<?php //include "../auth.php"; 
		include('../db_conn.php');
/*
	$kalData_tmp = mysql_query("SELECT * FROM lernstand.kalender");
	echo "<table border =\"1\">";
	while($row = mysql_fetch_assoc($kalData_tmp))
			{
				echo "<tr>";
				echo "<td>".$row['lfdnr']."</td>";
				echo "<td>".$row['datum']."</td>";
				echo "<td>".$row['zeit']."</td>";
				echo "<td>".$row['titel_kurz']."</td>";
				echo "<td>".$row['ort']."</td>";
				echo "<td>".$row['uid']."</td>";
				echo "<td>".$row['ws_apf']."</td>";
				echo "<td>".$row['ws_ndf']."</td>";
				echo "<td>".$row['kal_56']."</td>";
				echo "<td>".$row['kal_712']."</td>";
				echo "<td>".$row['kal_lehrer']."</td>";
				echo "<td>".$row['alle']."</td>";
				echo "</tr>END:VEVENT";
			}
	echo "</table>";
	*/
					echo "BEGIN:VCALENDAR"."\n";
$kalData_tmp = mysql_query("SELECT * FROM lernstand.kalender");
	while($row = mysql_fetch_assoc($kalData_tmp))
			{	
				echo "BEGIN:VEVENT"."\n";
				echo "DTSTART:".str_replace("-", "", $row['datum'])."\n";
				echo "SUMMARY:".$row['titel_kurz']."\n";
				echo "DESCRIPTION:".$row['titel_lang']."\n";
				echo "LOCATION:".$row['ort']."\n";
				echo "END:VEVENT"."\n";
			}
				echo "END:VCALENDAR"."\n";
?>	
	
	
	
	
	</body>
</html>