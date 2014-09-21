<?php
		include('db_conn.php');
		include "./classes/functions.php";
		header('Content-type: text/html; charset=utf-8');
		
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

	/*Anlegen der Sessionvar mit dem aktuellen Schulhalbjahr beim Start
		diese Variable wird in admin/termauswahl.php aktualisiert und in DB 
		festgelegt. Hier nur fuer den Start initialisiert	
	*/
	$_SESSION['aktueller_term_nr'] = mysql_result(mysql_query("SELECT * FROM akt_term"),'0','nr');
	$_SESSION['aktueller_term_name'] = mysql_result(mysql_query("SELECT term FROM lernstand.term WHERE lernstand.term.lfdnr = '".$_SESSION['aktueller_term_nr']."' "),'0','term');

	/*Anlegen der Sessionvar mit allen Klassen als array*/
		
		$_SESSION['alleKlassen'] = array();
		$alleklassen_tmp = mysql_query("SELECT * FROM lernstand.klassenstufe ORDER BY lfdnr");
		$klassen_tmp=array();
			while($row = mysql_fetch_array($alleklassen_tmp))
			{
				$klassen_tmp[] = $row[1];	
			};	
		$_SESSION['alleKlassen'] = $klassen_tmp;	
	
/*Anlegen der Sessionvar mit allen Faechern als array*/
		
		$_SESSION['alleFaecher'] = array();
		$allefaecher_tmp = mysql_query("SELECT * FROM lernstand.fach ORDER BY lfdnr");
		$faecher_tmp=array();
			while($row = mysql_fetch_array($allefaecher_tmp))
				{
				$faecher_tmp[] = $row[1];	
				};	
		$_SESSION['alleFaecher'] = $faecher_tmp;		

/*Anlegen der Sessionvar mit allen Lehrern als array*/
		
		$_SESSION['alleLehrer'] = array();
		$allelehrer_tmp = mysql_query("SELECT lastname, firstname, usr_id FROM ilias.usr_data 
		WHERE EXISTS(SELECT * FROM ilias.udf_text WHERE udf_text.usr_id = usr_data.usr_id AND udf_text.value = 'Lehrer') ORDER BY lastname");
		$lehrer_tmp=array();
			while($row = mysql_fetch_array($allelehrer_tmp))
			{
				$lehrer_tmp[] = $row[0];	
				$lehrer_tmp[] = $row[1];	
				$lehrer_tmp[] = $row[2];	
			};	
		$_SESSION['alleLehrer'] = $lehrer_tmp;	

/*Ich weiss grad nicht wozu hier nochmal mit dem Passwort rumhantiert wird, ansonsten geht es hier nur um Definition der SESSION[uid] des akt. Benutzers
* Das sollte einfacher gehen. TODO
*/	
	
		$nachname;
      $username = $_POST['username'];
      $passwort = $_POST['passwort'];
		$md5Passwort = md5($passwort);
		$pw = mysql_query("SELECT * FROM ilias.usr_data WHERE login = '$username' AND passwd = '$md5Passwort'");
		$uid = mysql_result($pw,'0','usr_id');
		$_SESSION['uid'] = $uid;
		$role = mysql_query("SELECT * FROM ilias.udf_text WHERE usr_id = '$uid'" );
		$_SESSION['klasse'] = mysql_result($role,'0','value');
/* Festlegen der Rolle in SESSIONVAR*/
		
		
		$ro = mysql_result($role, '0', 'value');
		switch ($ro) {
				case  'Lehrer'	:
					$_SESSION["rolle"] = "1";
					break;
				case 'Administrator':
					$_SESSION["rolle"] = "3";
					break;
					default:
					$_SESSION["rolle"] = "2";
			}
			
			/*pruefen auf Klassenlehrertaetigkeit und festlegen der Klasse in SESSIONVAR*/
		if($_SESSION['rolle'] == '1') 
			{	
				$klasse_tmp = mysql_query("SELECT klasse FROM lernstand.klassenlehrer WHERE uid = '".$_SESSION['uid']."'");
				$_SESSION['myclass'] = mysql_result($klasse_tmp,'0','klasse');
			}			
		 	
		/* 
		 $_SESSION['lernziel_1'] = "";
		 $_SESSION['lernziel_2'] = "";
		 $_SESSION['lernziel_3'] = "";
		 $_SESSION['lernziel_4'] = "";
		 $_SESSION['lernziel_5'] = "";
		*/
		
/* Laden der alten Lernziele in $_SESSION['lzv_1']...['lzv_4']
	Zuerst Ermittlung der Tabelle. Ueberfluessig seit term 4
	$table;
	if(strpos($_SESSION['klasse'],'5')!==false) {$table = 'daten56';};
	if(strpos($_SESSION['klasse'],'6')!==false) {$table = 'daten56';};
	if(strpos($_SESSION['klasse'],'7')!==false) {$table = 'daten78';};
	if(strpos($_SESSION['klasse'],'8')!==false) {$table = 'daten78';};
	if(strpos($_SESSION['klasse'],'9')!==false) {$table = 'daten9';};	
	
	$lzv = mysql_query("SELECT * FROM $table WHERE uid = '".$uid."'");
	/*Schreiben der Lernziele in $_SESSION[] 
	while($lernziele = mysql_fetch_assoc($lzv)){
		$_SESSION['lernziel_1'] ='';// $lernziele['lernziel1'];
		$_SESSION['lernziel_2'] ='';// $lernziele['lernziel2'];
		$_SESSION['lernziel_3'] ='';// $lernziele['lernziel3'];
		$_SESSION['lernziel_4'] ='';// $lernziele['lernziel4'];
		$_SESSION['lernziel_5'] ='';// $lernziele['lernziel5'];
				}
*/
		mysql_close($verbindung);
		$vorname = mysql_result($pw, '0','firstname');
		$nachname = mysql_result($pw,'0','lastname');
		$_SESSION["vn"] = $vorname;
		$_SESSION["nn"] = $nachname;
	
      $hostname = $_SERVER['HTTP_HOST'];
      $path = dirname($_SERVER['PHP_SELF']);

      /* Benutzername und Passwort werden überprft*/
     
     	if (mysql_num_rows($pw)){
       $_SESSION['angemeldet'] = true;

       // Weiterleitung zur geschützten Startseite
       if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        if (php_sapi_name() == 'cgi') {
         header('Status: 303 See Other');
         }
        else {
         header('HTTP/1.1 303 See Other');
         }
        }

       header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/start1.php');
       exit;
       }
      }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="de">
 <head>
  	<link rel="stylesheet" type="text/css" href="templates/start.css">
 	<link rel="stylesheet" type="text/css" href="./templates/format.css">
  <title>Lernstand</title>
 </head>
 <body>
 
  
  <div class ="login"><p>Hier gelten Ihre Anmeldedaten<br/>des virtuellen vBG</p> 
  <p>Wir wünschen allen Lehrern und Schülern erholsame und erlebnisreiche Ferien!</p>
  
 
<div class="pwfield">

<form  action="loginLS.php" method="post">
<fieldset>
<legend>Anmeldung</legend>
<label>Login: <input type="text" name="username" /></label><br/>
<label>Passwort: <input type="password" name="passwort"/></label><br/>
<input type="submit" value="Anmelden"/>
</fieldset>
</form>
</div>
<p class="browserunterstuetzung">Die Darstellung der Seiten ist getestet mit Firefox (v24.6.0), Google Chrome (v35.0.1916.153),
 Opera (v12.16) unter Debian 7.0, Safari 1.3.2(v312.6) unter Mac OS X 10.3 sowie mit Firefox 20.0.1 unter WinXP.
  Sollte Ihr Browser Probleme bereiten, so informieren Sie mich bitte oder wechseln den Browser. Der IE von MS wird nicht besonders unterst&uuml;tzt.</p>
</div>

 </body>
</html>
