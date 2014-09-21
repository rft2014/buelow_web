<?php


header('Content-Type: application/pdf');
  $pdf = file_get_contents('medienpass6.pdf');
  echo $pdf;


?>