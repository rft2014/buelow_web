<?php include "../auth.php"; 
		include "../classes/functions.php";
		include "../templates/frame_header.php";
?>

	<frameset rows="20%,*,20%">
		<frame src="./frame1.php" name = "frame3">
			<frameset cols="50%,50%">
				<frame src="./myclass_lernziele.php" name = "frame1">
				<frame src="./frame2.htm" name = "frame4">
			</frameset>
		<frame src="./frame2.htm" name = "frame2">
	</frameset>
</html>