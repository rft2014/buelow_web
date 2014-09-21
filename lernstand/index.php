<?php include('auth.php'); 
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
 <meta http-equiv="content-type" content="text/html; charset=UTF8" />
  <title>Geschützter Bereich</title>
 </head>
 <body>
  <h1>Herzlichen Glückwunsch!</h1>
  <p>Sie sind nun angemeldet.</p>
  <p>Sie können sich auch wieder <a href="logout.php">abmelden</a>.</p>
  
  <?php
  echo "Name der Session: " . session_name();
  echo "<br/>";
  echo "ID der Session: " . session_id();
  echo "<br/>";
  echo "Hallo " . $_SESSION["vn"]." ".$_SESSION["nn"];
  
  ?>
 </body>
</html>
