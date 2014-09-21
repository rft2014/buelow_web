<?php 
// create curl resource
         
$ch = curl_init(); 
		
// set url 
//curl_setopt($ch, CURLOPT_URL, "http://www.kunstkombinat5.org/calendar.php?client_id=rfteichert&token=9a571f91efb483ec7505749e226eaab5"); 
curl_setopt($ch, CURLOPT_URL, "http://www.kunstkombinat5.org/lernstand/kalender/kalender.php"); 
//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CRLF, true);
// $output contains the output string 
$output = curl_exec($ch); 
$out = nl2br($output);
//echo $out.'<br />';
/*
echo 'Anzahl der Events: '. substr_count($out, 'BEGIN:VEVENT').'<br />';
echo 'Heute: '.date('Ymd').'<br />'; 
$arr1 = explode('<br />',$out);
echo 'Das erste Element: '.$arr1[0].'<br />';
echo 'Anzahl der Elemente: '.count($arr1).'<br />';
for ($i=0;$i<count($arr1)-1;$i++){
	if(strpos($arr1[$i], 'DTSTART:'.date('Ymd'))>0){
	echo 'Heute ist was los! <br />';
}
}
echo "This file full path and file name is '" . __FILE__ . "' <br />";

echo "This file full path is '" . __DIR__ . "'.<br />";

        // close curl resource to free up system resources 
        curl_close($ch);  */
          
//Anzahl der events im Zeitraum
//$num_events = substr_count($output,'BEGIN:VEVENT');
//echo "Anzahl: ".$num_events."<br />";

//events in der Reihenfolge anzeigen
$z=0;
$str = str_replace('END:VEVENT', '', $out);
$events_tmp = explode('BEGIN:VEVENT',$str);
foreach ($events_tmp as $value)
		{echo $value;
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
