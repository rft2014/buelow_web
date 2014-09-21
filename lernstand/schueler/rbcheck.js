function rbcheck(spalte,zeile,fachanzahl)
  {
  
 
  	/*Test der Radiobutton ob Fragen beantwortet sind der Schuelereingabe*/
  	var checked_number = 0;
  	for(var j=0;j<spalte;j++){
  	var geklickt = document.getElementsByName(zeile+"Frage"+j);
  	
  	for (var i = 0; i<4;i++){
	if(geklickt[i].checked == true)  {
	 checked_number = checked_number + 1;
	}		
  		}
  		}
		  		
  	if(checked_number == spalte ){ return true;
  	}else{
  		alert('Sie haben nicht alle Fragen beantwortet!');
  		return false;}
  	
  	}