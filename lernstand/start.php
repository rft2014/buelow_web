<?php include('auth.php'); 
	
	
?>

<html>
<head>

 <link rel="stylesheet" type="text/css" href="./templates/format.css">
 <link rel="stylesheet" type="text/css" href="./templates/menue_lehrer.css">
<script type="text/javascript" src="rbcheck_klasse.js"></script>

</head>
<body>
<?php include('headline.php');?>

<ul id="tabmenue">
<li><a  href="./lehrer/menue_lehrer.php" >Startseite</a></li>
  <li><a href="./lehrer/lehrer_pers.php">Anfragen</a></li>
  <li><a id="lehrertask" href="../start.php">Kompetenzen</a></li>
  
 <?php
if($_SESSION['myclass'] !== "") {
	echo "<li><a href=\"./lehrer/lehrer_myclass.php\">Klassendaten - ".$_SESSION['myclass']."</a></li>";
	echo "<li><a href=\"./lehrer/myclass_lernziele.php\">Lernziele - ".$_SESSION['myclass']."</a></li>";
}
?>
<li><a href="./lehrer/myclass_medienpass.php">Medienpass</a></li>
<div class="selectClass"> Bitte w&auml;hlen Sie die zu bearbeitende Klasse!

<div class="f">

<form action="select_fach.php" name="Klasse" method="POST" onSubmit="javascript:return rbcheck_klasse()">
<input type="Radio" name="Klasse" value="5a">5a
<input type="Radio" name="Klasse" value="5b">5b
<input type="Radio" name="Klasse" value="6/1">6/1
<input type="Radio" name="Klasse" value="6/2">6/2
<input type="Radio" name="Klasse" value="6/3">6/3
<input type="Radio" name="Klasse" value="7a">7a
<input type="Radio" name="Klasse" value="7b">7b
<input type="Radio" name="Klasse" value="8a">8a
<input type="Radio" name="Klasse" value="8b">8b
<input type="Radio" name="Klasse" value="8c">8c
<input type="Radio" name="Klasse" value="9a">9a
<input type="Radio" name="Klasse" value="9b">9b
<input type="Radio" name="Klasse" value="9c">9c
<!--<input type="Radio" name="Klasse" value="9c">9c
<input type="Radio" name="Klasse" value="9d">9d-->
</div>

<div class = "a">
<input type="submit" value="Weiter">
</form>
</div>
</div>


</body>
</html>
