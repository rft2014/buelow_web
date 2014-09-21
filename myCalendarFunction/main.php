<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<style type="text/css">

p {
font-size:80%;
font-family:sans-serif;
	}
#datum {
	background-color:whitesmoke;
	padding:3px;
	border-style:solid;
	border-width:0px;
	text-align:center;
	}
	
</style>

<script type="text/javascript"><!--

function uhr() {
var Jetzt = new Date();
var Tag = Jetzt.getDate();
var Monat = Jetzt.getMonth() + 1;
var Jahr = Jetzt.getFullYear();
var Stunden = Jetzt.getHours();
var Minuten = Jetzt.getMinutes();
var Sekunden = Jetzt.getSeconds();
var NachVollm = ((Minuten < 10) ? ":0" : ":");
var NachVolls = ((Sekunden < 10) ? ":0" : ":");
var tage = new Array()
tage[1] = "Montag";
tage[2] = "Dienstag";
tage[3] = "Mittwoch";
tage[4] = "Donnerstag";
tage[5] = "Freitag";
tage[6] = "Samstag";
tage[0] = "Sonntag";
var wochentag = tage[Jetzt.getDay()];
document.getElementById("uhr").innerHTML="Heute ist " + wochentag + " der " + Tag + "." + Monat + "." + Jahr + ".<br /> Es ist jetzt " +
               Stunden + NachVollm + Minuten + NachVolls + Sekunden +" Uhr.";
}

function ferienRest(){
var jetzt = new Date();
var y = jetzt.getTime();
var endeFerien = new Date(2014,9,1,0,0,0)
var x = endeFerien.getTime();
var restFerien = Math.round((x - y)/1000);

document.getElementById("ferienRest").innerHTML= "Willkommen im neuen Schuljahr. Es ist viel zu tun.<br /> Wir freuen uns auf das Herbstfest in " + restFerien + " Sekunden.<br /> Bis dahin, viel Erfolg!";
}

--></script>
</head>

<body>

<div id="datum">
<script type="text/javascript">
window.setInterval("uhr()", 1000)
window.setInterval("ferienRest()", 1000)
</script>
<p id="uhr"></p>
<p id="ferienRest"></p>

<?php 
         
$ch = curl_init(); 
		 
curl_setopt($ch, CURLOPT_URL, "http://www.kunstkombinat5.org/lernstand/kalender/kalender.php"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CRLF, true);
 
$output = curl_exec($ch); 
$out = nl2br($output);

curl_close($ch);  
//$num_events = substr_count($out,'BEGIN:VEVENT');

$z=0;
$events_tmp = explode('BEGIN:VEVENT',$out);
foreach ($events_tmp as $value)
		{
			$event_array[$z] = $value; 			
			
			preg_match("/DTSTART:(.*)<br \/>/i",$event_array[$z],$datum);
			preg_match("/SUMMARY:(.*)<br \/>/i",$event_array[$z],$summary);
		
			$z++;
			$tag = substr($datum[1],6,2).".".substr($datum[1], 4, -2).".".substr($datum[1], 0, 4);
			echo $tag."<br />";
			echo $summary[1];
			echo "<hr>";
		}
	   	
?>

</div>

</body>
</html>