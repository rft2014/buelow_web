<?php include('auth.php'); ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="./templates/format.css">
</head>
<body>
<?php include('headline.php');?>

<?php

if($_SESSION["rolle"] == "1") {
	
	
 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/lehrer/menue_lehrer.php');
};
if($_SESSION["rolle"] == "2"){
	

 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/schueler/menue_schueler.php');

	};
if($_SESSION["rolle"] == "3"){
	

 header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/admin/menue_admin.php');

	};

?>
</body>
</html>			
