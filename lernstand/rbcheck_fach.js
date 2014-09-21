function rbcheck_fach(){
var geklickt = document.getElementsByName("Fach");
for(var i = 0; i<8;i++){
if (geklickt[i].checked){
return true
}
};
alert("Auswahl eines Faches fehlt!");
return false;

}
