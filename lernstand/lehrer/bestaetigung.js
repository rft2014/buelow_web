function Bestaetigung (name) {
	
	//das geht mit Sicherheit eleganter aber ich hab es nur
	//so hingekriegt, dass am Ende alle Zahlen, Kommas, Punkte weg waren
	// und die Namen richtig rum standen.
	// TODO regexp studieren
	 
	var a = name.replace(/[^a-zA-ZüöäÜÖÄß]/,""); 
	var b = a.replace(",",""); 
	var Ausdruck = /(\w.+)\s(\w.+)/;
   Ausdruck.exec(b);
  var x = window.confirm("Mit Betätigung dieses Buttons wird " + RegExp.$2 +" " +RegExp.$1 + " aus Ihrer Liste entfernt. OK?  ");
  return x;
}