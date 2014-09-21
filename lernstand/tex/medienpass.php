<?php  include "../auth.php";
		include('../db_conn.php');
$klasse = $_POST['klasse'];
$meineSchueler_tmp =mysql_query("SELECT firstname, lastname, usr_data.usr_id FROM ilias.usr_data JOIN ilias.udf_text ON usr_data.usr_id = udf_text.usr_id AND udf_text.value = '".$klasse."' ORDER BY lastname");
$inhalt_1="";
$inhalt_2="";
$inhalt_3="";
$inhalt_4="";
$inhalt_5="";
$inhalt_6="";
$inhalt_7="";
$_SESSION['lernbereich_1'] = $_POST['lernbereich_1'];
$_SESSION['lernbereich_2'] = $_POST['lernbereich_2'];
$_SESSION['lernbereich_3'] = $_POST['lernbereich_3'];
$_SESSION['lernbereich_4'] = $_POST['lernbereich_4'];
$_SESSION['lernbereich_5'] = $_POST['lernbereich_5'];
$_SESSION['lernbereich_6'] = $_POST['lernbereich_6'];
$_SESSION['lernbereich_7'] = $_POST['lernbereich_7'];
$_SESSION['fach_1'] = $_POST['fach_1'];
$_SESSION['fach_2'] = $_POST['fach_2'];
$_SESSION['fach_3'] = $_POST['fach_3'];
$_SESSION['fach_4'] = $_POST['fach_4'];
$_SESSION['fach_5'] = $_POST['fach_5'];
$_SESSION['fach_6'] = $_POST['fach_6'];
$_SESSION['fach_7'] = $_POST['fach_7'];
$_SESSION['unterzeichner'] = $_POST['unterzeichner'];
//$klasse = $_SESSION['myclass'];

$vorspann="
\documentclass[a4paper,10pt]{scrartcl}
\usepackage[utf8]{inputenc}
\usepackage{ngerman}
\usepackage{graphicx}
\usepackage{booktabs, tabularx}
\pagestyle{empty}
\begin{document}";

$seitenende = "\bottomrule
\end{tabularx}\\\\[1cm]

".$_SESSION['unterzeichner']."
\\newpage";


file_put_contents('medienpass.tex', $vorspann); 

while($meineSchueler = mysql_fetch_assoc($meineSchueler_tmp)) {
			$schueler_vorname = $meineSchueler['firstname'];
			$schueler_nachname = $meineSchueler['lastname'];
			
$seitenbeginn = "	
	
	\begin{minipage}[c]{0.3\\textwidth}
	\includegraphics[width=\\textwidth]{../auswertung/logo.jpg}
	\end{minipage}
	\hfill
	\begin{minipage}[c]{0.6\\textwidth} 
	\Huge \\textsf{von-B\"ulow-Gymnasium Neudietendorf}
	
	\end{minipage} 

\subsubsection*{Anlage zum Zeugnis}
\\vspace{1cm}
\large\\textbf{".$schueler_nachname.", ".$schueler_vorname."}\hfill \\textbf{Klasse: ".$klasse."}\\normalsize
\section*{Medienpass - Dokumentation der Kompetenzentwicklung im Fach Medienkunde}


\begin{tabularx}{\linewidth}{p{.2\linewidth} p{.5\linewidth} p{.2\linewidth}}
   \\toprule
   \\textbf{Lernbereich} & \\textbf{Kompetenzen und Inhalte des Kurses Medienkunde mit Bezug zum Fachlehrplan} & \\textbf{Fach}\\\\"; 
   
if($_POST['lernbereich_1'] !== "") {$inhalt_1 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Information und Daten & ".$_POST['lernbereich_1']." & ".$_POST['fach_1']."\\\\";
   }
if($_POST['lernbereich_2'] !== "") {$inhalt_2 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Kommunikation und Kooperation & ".$_POST['lernbereich_2']." & ".$_POST['fach_2']."\\\\";
   }
if($_POST['lernbereich_3'] !== "") {$inhalt_3 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Medienproduktion, informatische Modellierung und Interpretation & ".$_POST['lernbereich_3']." & ".$_POST['fach_3']."\\\\";
   }
if($_POST['lernbereich_4'] !== "") {$inhalt_4 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Präsentation & ".$_POST['lernbereich_4']." & ".$_POST['fach_4']."\\\\";
   }
if($_POST['lernbereich_5'] !== "") {$inhalt_5 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Analyse, Begründung und Bewertung & ".$_POST['lernbereich_5']." & ".$_POST['fach_5']."\\\\";
   }
if($_POST['lernbereich_6'] !== "") {$inhalt_6 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Mediengesellschaft & ".$_POST['lernbereich_6']." & ".$_POST['fach_6']."\\\\";
   }
if($_POST['lernbereich_7'] !== "") {$inhalt_7 = "   
	\cmidrule(lr){1-1}\cmidrule(lr){2-2}\cmidrule(rl){3-3}
   Recht, Datensicherheit und Jugendmedienschutz & ".$_POST['lernbereich_7']." & ".$_POST['fach_7']."\\\\";
   }

file_put_contents('medienpass.tex', $seitenbeginn, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_1, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_2, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_3, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_4, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_5, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_6, FILE_APPEND); 
file_put_contents('medienpass.tex', $inhalt_7, FILE_APPEND); 
file_put_contents('medienpass.tex', $seitenende, FILE_APPEND);
};



$abspann="\end{document}";

 
file_put_contents('medienpass.tex', $abspann, FILE_APPEND); 
mysql_close($verbindung);


exec('pdflatex medienpass.tex');
 header('Content-Type: application/pdf');
  $pdf = file_get_contents('medienpass.pdf');
  echo $pdf;
?>

