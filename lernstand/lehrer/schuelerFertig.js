function schuelerFertig(schuelerID){
	
	var http = new XMLHttpRequest();
	var x = null;
	var y = schuelerID;
	if(document.getElementById("fertig"+y).checked == true){x = 1}else{}
	if(document.getElementById("fertig"+y).checked == false){x = 0}else{}
	http.open("GET", "http://www.kunstkombinat5.org/lernstand/lehrer/schuelerFertig.php?fertisch=" +x+"&schueler="+y,true);
	http.send(null);	
	
	//http.onreadystatechange = function()
	//{
	//	if(http.readyState==4){
	//alert(http.readyState + http.responseText);
//	}
//	}
	}