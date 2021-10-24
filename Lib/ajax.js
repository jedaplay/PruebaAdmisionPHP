//PERFILES PERMISOS (TABLA CRUZADA)
/*
function SubmitEnter(key){
    var unicode
    if (key.charCode)
    {unicode=key.charCode;}
    else
    {unicode=key.keyCode;}
    //alert(unicode); // Para saber que codigo de tecla presiono , descomentar
   
    if (unicode == 13){
        //alert('Presiono enter');
	document.consultar_pl.submit();
    }
}
function SetContainerHTML(id_contenedor,responseText){
mydiv = document.getElementById(id_contenedor); 
mydiv.innerHTML = responseText; 
var elementos = mydiv.getElementsByTagName('script'); 
for(i=0;i<elementos.length;i++) { 
old=document.getElementById('prefix'+i); 
if(old)mydiv.removeChild(old) 
var elemento = elementos[i]; 
nuevoScript = document.createElement('script'); 
nuevoScript.text = elemento.innerHTML; 
nuevoScript.type = 'text/javascript'; 
nuevoScript.id = 'prefix'+i; 
if(elemento.src!=null && elemento.src.length>0) 
{nuevoScript.src = elemento.src;} 
elemento.parentNode.replaceChild(nuevoScript,elemento); 
} 
}
*/
function nAjax(){
	var xmlhttp=false; 
	try{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e){ 
		try{
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp;
}

/*para resolver el problema de  enviar caracter (+)*/
function cmas(valor){
	var str = valor;
	str = str.replace(/\+/g,"%2b");
	return str;
}