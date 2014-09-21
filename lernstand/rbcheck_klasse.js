function rbcheck_klasse()
{
var geklickt = document.getElementsByName("Klasse");
for(var j=0;j<16;j++){
  	
  	if(geklickt[j].checked){ 
  	return true
  	}};
  	
  	
	alert("Auswahl der Klasse fehlt!");
	return false;
}
