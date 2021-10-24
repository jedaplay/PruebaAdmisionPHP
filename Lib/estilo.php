<style>
html, body {
	width:100%;
	background-color: white;/*Gainsboro - white; amarillo sss pastel fcfcf2*/		
	/*font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;*/
	font-family: Verdana, Arial, Helvetica, sans-serif;
	margin: 0px;
	padding: 0px;
	background-image: url(https://i.imgur.com/VoOD9rc.jpg);
	/*
	Hojas https://i.imgur.com/j9oZj6h.jpg
	*/
	background-repeat: no-repeat;
	background-size: cover;
	background-attachment: fixed;
}
/*#titulo{
	background-color: CORNFLOWERBLUE;
	color: white;
	border: solid 0px lime;
	margin: 0;
	padding: 0;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	font-size:20px;
	height:32px;
	line-height:32px;		
}
*/
form {
	margin: 0;
	padding: 0;
}
/*br {
  content: "";
  margin: 2em;
  display: block;
  font-size: 24%;
}*/
#pie {
	overflow:auto;
	/*background-color:CORNFLOWERBLUE;*/
	position:absolute;
	bottom:0px;
	width:100%;
	height:25px;
	border: solid 0px black;
	/*padding: 0px 0px 0px 0px;*/
	/*top - right - bottom - left*/
	margin:0px;
	line-height: 25px;
	font-size:12px;
	color:blue;
	/*vertical-align: middle;*/
	text-align: center;
}

.table_portada {
	border-collapse: separate;
	border-spacing: 50px 0px;
	margin:0px;
	padding: 0px;	
	border: solid 0px black;
}

.mensaje0{
	background-color:pink;
	color:red;
	border:solid 0px white;
	text-align:middle;
	margin:0px;
	padding:5px;
	font-size:12px;
	font-weight: normal;
}
.mensaje1{
	background-color:MediumBlue/*4/4*/;
	color:white;
	border:solid 0px white;
	text-align:middle;
	margin:0px;
	padding:5px;
	font-size:12px;
	font-weight: normal;
}

img { border: none; }

.grilla_table {
	background-color:GAINSBORO;
	/*background-color:transparent;*/
	padding: 0px;
	margin:0px;
	border-spacing: 1.1px;
	border: solid 0px GAINSBORO;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}
.grilla_table th{
	text-align:left;
	/*background-color:CORNFLOWERBLUE;*/
	/*background-color:#eaeaea;*/
	/*background-color:GAINSBORO;*/
	/*background-color:#F8F9F9;*/
	background-color:white;
	padding: 2px 0px 2px 10px;
	margin:0px;
	color:black;
	font-size:12px;
	font-weight: bold;
	border: solid 0px GAINSBORO;
	height:35px;
}
.grilla_table .titulo{
	/*background-color:CORNFLOWERBLUE;*/
	/*background-color:#eaeaea;*/
	/*background-color:GAINSBORO;*/
	/*background-color:#F8F9F9;*/
	padding:0px;
	margin:0px;
	color:black;
	padding:7px;
	border: solid 0px gainsboro;
	text-align:left;	
	font-style:italic;
	font-size:12px;
	font-weight: bold;
	/*background: -webkit-linear-gradient(white,gainsboro);
	background: -moz-linear-gradient(white,gainsboro);
	background: -o-linear-gradient(white,gainsboro);*/
	background: -webkit-linear-gradient(gainsboro,white);
	background: -moz-linear-gradient(gainsboro,white);
	background: -o-linear-gradient(gainsboro,white);
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
}
.grilla_table h2{
	background-color:olive;
	padding: 0px;
	margin:0px;
	color:white;
	border: solid 0px black;
}
.grilla_table th select{
	height:30px;
}
.grilla_table th a{
	color:black;
	border: solid 0px lime;
}
.grilla_table td{
	font-size:0.8em;
	padding: 3px;
	margin:0px;
	color:black;
	font-weight: normal;
	border: solid 0px black;	
}
.grilla_table td a{
	color:black;
	border:solid 0px lime;
	text-align:center;
	vertical-align:center;
	padding: 0px; 
	margin:0px;	
	font-size:14px;	
	opacity:1.0;	
}
.grilla_table td a:hover{
	color:black;
	opacity:1.0;	
}
.grilla_table tr:nth-child(even){	
	background-color:white;
}
.grilla_table tr:nth-child(odd){	
	background-color:#F8F9F9;
}
.grilla_table tr:hover{
	color:black;
	background-color: PaleGreen;
}
.grilla_table h3{
	font-size:20px;
	font-weight: 300;
	margin: 5px;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}
.grilla_table a:hover{
	color:lime;
	/*background-color: white;*/
}

.selectX2 {
	background-color: whitesmoke;
	color:black;
	font-weight: normal;
	font-size:16px;
	height:35px;
	border: solid 1px silver;
	padding: 7px;
	margin: 0px;
	cursor:pointer;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}

/***/

/*
col:first-child {background: #FF0}
col:nth-child(2n+3) {background: #CCC}
*/
/*top right bottom left*/

a:hover{
	color:lime;	
    opacity:1;
	filter: alpha(opacity=100);
}

.link{
	cursor:pointer;
	color:white;
	text-align:center;
	vertical-align:center;
	padding: 3px; 
	margin:0px;
	border: solid 0px black;
	font-size:14px;
	font-weight: 300;
	line-height:3px;
}
.link:hover{
	color:lime;	
    opacity:1;
	filter: alpha(opacity=100);
}

.link_page{
	cursor:pointer;
	color:black;
	text-align:center;
	vertical-align:center;
	padding: 3px; 
	margin:0px;
	border: solid 0px black;
	font-size:14px;
	font-weight: 300;
	line-height:3px;
}
.link_page:hover{
	color:CORNFLOWERBLUE;
	opacity:1;	
}

.link_edit{
	cursor:pointer;
	color:black;
	opacity:0.5;
}
.link_edit:hover{
	color:black;
    opacity:1;
}

.link_icono{
	cursor:pointer;
	color:white;
	text-align:center;
	vertical-align:center;
	padding: 0px; 
	margin:0px;
	border: solid 0px black;
	/*font-size:14px;
	font-weight: 300;
	line-height:3px;*/
}
.link_icono:hover{
	color:lime;
	/*background-color: white;*/
}

.link_normal{
	cursor:pointer;
	/*color:black;*/
	
}
.link_normal:hover{
	/*color:green;*/
	font-weight: bold;
}

/*p{
	color:black;
	text-align:center;
	vertical-align:center;
	padding: 3px; 
	margin:0px;
	border: solid 0px black;
	font-size:14px;
	font-weight: 300;
	line-height:3px;
}*/

a:link {text-decoration: none;}
a:visited {text-decoration: none;}
a:hover {text-decoration: underline;}
a:active {text-decoration: underline;}
/*a{color:black;}*/

.titulo_index{
	color:black;	
	font-weight:normal;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}
.pie_index {		
	position:absolute;
	bottom:0px;
	width:100%;	
	border: solid 0px black;	
	margin:0px;	
	font-size:15px;
	color:black;
	text-align: center;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}

h1,h2,h3,h4,h5{
	font-weight:normal;
	margin:0;padding:0;	
}
h2{
	font-family: 'Segoe UI Light', Verdana, Arial, Helvetica, sans-serif;
}
* {
    box-sizing: border-box;/*PARA Q EL PADDING NO AFECTE EL TAMAÑO DEL DIV*/
}
.cuadro_super{
	overflow:hidden;/*EXPANDIR AUTO. EL DIV*/
	background-color:whitesmoke;
	border: solid 1px silver;
	margin:auto;
	top:0;left:0;right:0;bottom:0;
	height:fit-content;
	width:fit-content;
	padding:15px;	
	border-radius: 5px;
	box-shadow: 0 0 2px rgba(0,0,0,0.5);
	/*border-bottom-left-radius: 5px;*/
}
.cuadro_super .centro, .icono2 a{
	color:black;
	font-size:15px;
}
.cuadro_super .icono a{
	color:black;
	font-size:20px;
	vertical-align:middle;
}
.cuadro_super .icono {
	/*background-color:fcfcf2;*/
	float:left;
	background-color:fcfcf2;
	font-size:10px;
	padding:10px;
	margin:5px;
	text-align:center;
	color:black;
	/*height:fit-content;*/
	width:170px;
	height:130px;	
	line-height:25px;	
	font-weight: normal;
	border: solid 0px silver;
	border-radius: 5px;
	box-shadow: 0 0 2px rgba(0,0,0,0.5);
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}

.table_index{
	overflow:hidden;/*EXPANDIR AUTO. EL DIV*/
	background-color:white;
	border: solid 0px silver;
	margin:auto;
	top:0;
	left:0;
	right:0;
	bottom:0;
	height:fit-content;
	width:800px;
	padding:15px;	
	border-radius: 15px;
	box-shadow: 0 0 55px rgba(0,0,200,0.5);
	/*border-bottom-left-radius: 5px;*/
}

.table_index h2{
	font-size:25px;
	padding:0px;
	margin:0px;
	line-height:40px;
}
.table_index h4{
	font-size:15px;
	padding:0px;
	margin:0px;
	line-height:20px;
}

.table_index .icono a{
	color:black;
	font-size:20px;
	vertical-align:middle;
}
.table_index .icono {
	/*background-color:fcfcf2;*/
	background-color:transparent;
	font-size:20px;
	padding:15px;
	margin:5px;
	text-align:center;
	color:black;
	height:fit-content;
	/*height:148px;*/
	width:fit-content;
	line-height:30px;
	font-weight: normal;
	border: solid 0px silver;
	/*border-radius: 5px;
	box-shadow: 0 0 2px rgba(0,0,0,0.5);*/
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}
/***************/
summary{
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	font-size:20px;
}
.grilla_table111 {
	background-color:white;
	padding: 0px;
	margin:5px;
	border-spacing: 0;
	border: solid 1px gainsboro;
	border-radius: 5px;
}
.grilla_table111 th{
	text-align:left;
	vertical-align:top;
	background-color:whitesmoke;
	padding: 2px 5px 2px 5px;
	margin:0px;
	color:black;
	font-size:12px;
	font-weight: bold;
	border-bottom:solid 1px gainsboro;
	border-left:solid 1px gainsboro;
	border-right:0px;
	border-top:0px;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	/*height:35px;*/
}
.grilla_table111 td{
	font-size:12px;/*0.8em;*/
	padding: 3px;
	margin:0px;
	color:black;
	font-weight: normal;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-bottom:solid 1px gainsboro;
	border-left:solid 1px gainsboro;
	border-right:0px;
	border-top:0px;
	vertical-align:top;
}
.grilla_table111 td:first-child,th:first-child{
	border-left:0;
	border-right:0;
	border-top-left-radius:5px;
}
.grilla_table111 tr:last-child td{
	border-bottom:0;
}
.grilla_table111 tr:first-child,th:last-child{
	border-top-right-radius:5px;
}
.grilla_table111 tr:last-child td:first-child{
	border-bottom-left-radius:5px;
}
.grilla_table111 tr:last-child td:last-child{
	border-bottom-right-radius:5px;
}
.grilla_table111 tr:nth-child(even){
	background-color:white;
}
.grilla_table111 tr:nth-child(odd){
	background-color:#F8F9F9;
}
/*TABLA DE LOS GRUPOS DE CAMPOS*/
.table_editar_grupo {
	/*background-color:Gainsboro;*/
	background-color:transparent;
	border-collapse: separate;
	border-spacing:3px; /*izq top*/
	border: solid 0px gainsboro;
	padding:0;
	margin:0px 2px 0 2px;/*top, right, bottom, left*/
	/*font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;*/
}
.table_editar_grupo .titulo_grupo{
	background: -webkit-linear-gradient(white,gainsboro);
	background: -moz-linear-gradient(white,gainsboro);
	background: -o-linear-gradient(white,gainsboro);
	margin:0px;
	padding:7px;
	border: solid 1px gainsboro;
	text-align:center;
	font-weight:normal;
	font-style:italic;
	font-size:15px;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
}
.table_editar_grupo  th{
	/*border-radius: 10px;*/
	border-top-left-radius: 5px;
	border-bottom-left-radius: 5px;
	/*background-color:CORNFLOWERBLUE;*/
	background-color:LIGHTCYAN;
	font-size:12px;
	color:black;
	text-align:left;
	border: solid 1px Gainsboro;
	padding: 7px;
	margin:0px;
	border-collapse: separate;
	border-spacing: 10px;
	font-weight: normal;
	font-family: Arial, Helvetica, sans-serif;	
	/*font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;*/
}
.table_editar_grupo td{
	border-top-right-radius: 5px;
	border-bottom-right-radius: 5px;
	/*background-color:white;*/
	font-size:12px;
	padding: 0px;
	margin:0px;
	color:black;
	font-family: Arial, Helvetica, sans-serif;
	/*font-weight: bold;*/
	border-style: solid;
	border-width: 1px 1px 1px 0px;/*top, right, bottom, left*/
	border-color: Gainsboro;
}
.table_editar_grupo .sin_borde{
	border: solid 0px silver;
	border-radius: 0px;
	margin:0;
	padding:0;
}
.table_audio {
	background-color:white;
	padding:0px;
	margin:0px 2px 0px 2px;/*top, right, bottom, left*/
	border-spacing:3px; /*izq top*/
	/*border-spacing: 3.057px;*/
}
.table_audio th{
	text-align:center;
	background-color:lightcyan;
	padding:5px;
	margin:0px;
	line-height:18px;
	color:black;
	font-size:12px;
	font-weight: normal;
	border: solid 1px gainsboro;
	font-family: Arial,'Open Sans','Segoe UI Light',Verdana,'Segoe UI Light', Arial, Helvetica, sans-serif;
	/*height:35px;*/
	border-radius: 5px;
}
.table_audio td{
	font-size:12px;
	padding:2px;
	margin:0px;
	line-height:18px;
	color:black;
	font-weight: normal;
	border: solid 1px gainsboro;
	font-family: Arial,'Open Sans','Segoe UI Light',Verdana, Arial, Helvetica, sans-serif;
	border-radius: 0px;	
}
.table_audio input{
	text-align:center;
	padding:0px;
	margin:0px;
	color:black;
	width:auto;
	height:25px;
	background-color:white;
	font-size:12px;
	font-weight: normal;
	border: solid 0px lime;
	font-family: Verdana, Arial
	border-radius: 0px;	
}
.table_basica{
	background-color:gainsboro;
	padding:0px;
	margin:0px;
	border-collapse:separate;
	border-spacing:1.057px;
	border:solid 0px gainsboro;
}
.table_basica th{
	position:relative;
	text-align:left;
	vertical-align:top;
	background-color:whitesmoke;
	padding: 2px 5px 2px 5px;
	margin:0px;
	color:black;
	font-size:12px;
	font-weight: bold;
	border: solid 0px black;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	/*height:35px;*/
	border-radius: 0px;
}
.table_basica td{
	position:relative;
	vertical-align:top;
	background-color:white;
	padding: 3px;
	margin:0px;
	color:black;
	font-size:12px;
	font-weight: normal;
	border: solid 0px black;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-radius: 0px;
}

/*.grilla_table111 tr:hover{
	color:black;
	background-color: PaleGreen;
}*/

.table_small {
	background-color:GAINSBORO;
	padding: 0px;
	margin:0px;
	border-spacing: 1px;
	border: solid 0px silver;
	border-radius: 0px;
}
.table_small th{
	text-align:left;
	background-color:whitesmoke;
	padding: 2px;
	margin:0px;
	color:black;
	font-size:12px;
	font-weight: bold;
	border: solid 0px black;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;

	/*height:35px;*/
	border-radius: 0px;
}
.table_small td{
	background-color:white;
	font-size:10px;
	padding: 0px;
	margin:0px;
	color:black;
	font-size:12px;
	font-weight: normal;
	border: solid 0px black;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-radius: 0px;
}

.table_editar_grupo select,
.table_editar_grupo input {
	background-color: transparent;
	color:black;
	font-weight: normal;
	font-size:12px;
	border: solid 0px Gainsboro;
	padding: 0px 0px 0px 5px; 
	height:31px;
}
.table_editar_grupo .select_normal {
	background-color: whitesmoke;
	color:black;
	font-weight: normal;
	font-size:12px;
	height:30px;
	border: solid 1px silver;
	padding: 0px;
	margin: 0px;
	cursor:pointer;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}

.table_editar_grupo textarea {
	background-color: white;
	color:black;
	font-weight: normal;
	font-size:12px;
	border: solid 1px Gainsboro;
	padding: 0px 0px 0px 5px;
}

.table_editar_grupo [type="checkbox"],
.table_editar_grupo [type="submit"],
.table_editar_grupo [type="button"]{
	color:white;
	vertical-align: middle;
	text-align: center;
	background-color: CORNFLOWERBLUE;
	cursor: pointer;
	border: solid 0px silver;
	padding:2px;
	margin:0px;	
	font-size:10px;	
	font-weight: normal;	
}
/*
.table_editar_grupo .grilla_table td{
	font-size:0.8em;
	padding: 3px;
	margin:0px;
	color:black;
	font-weight: normal;
	border: solid 0px black;	
}
.table_editar_grupo .grilla_table tr:nth-child(even){	
	background-color:white;
}
 .table_editar_grupo .grilla_table tr:nth-child(odd){	
	background-color:#F8F9F9;
}
.table_editar_grupo .grilla_table tr:hover{
	color:black;
	background-color: PaleGreen;
}
*/
/****/

.table_normal {
	overflow:hidden;	
	background-color:white;
	vertical-align:top;
	text-align:left;
	font-size:12px;	
	font-style:normal;
	font-family: 'Open Sans', Verdana, Arial;
	padding: 5px;
	margin:5px;
	color:black;
}
.table_normal h2{
	clear:both;
	margin:5px;
	padding:0px;
	vertical-align:top;
	text-align:center;
	font-size:18px;	
	font-style:italic;
}
.table_normal_div{
	overflow:hidden;	
	background-color:white;
	vertical-align:top;
	text-align:left;
	font-size:12px;	
	font-style:normal;	
	padding: 5px;
	margin:5px;
	color:black;
	background-color:fcfcf2;
	border: solid 0px silver;
	border-radius: 5px;
	box-shadow: 0 0 3px rgba(0,0,0,0.5);
}
.table_normal_div ul,li{
	list-style:none;	
	padding: 2px;
	margin:0px;
}
.table_normal_div a{
	color:black;
	font-size:12px;
}
.table_normal_div a:hover{
	color:lime;
}
.table_normal_div select,
.table_normal_div input,
.table_normal_div textarea {
	background-color: white;
	color:black;
	font-weight: normal;
	font-size:12px;
	border: solid 1px silver;
	padding: 0px 0px 0px 5px; 
	height:25px;
	font-family: 'Open Sans', Verdana, Arial;
}
.btn00{
	color:silver;
	vertical-align: middle;
	text-align: center;	
	cursor: pointer;
	border: solid 0px silver;
	padding:4px;
	margin:0px;
	width:fit-content;
	height:40px;
	line-height:30px;
	font-size:14px;
}
.btn11{
	color:CORNFLOWERBLUE;
	vertical-align: middle;
	text-align: center;
	cursor: pointer;
	border: solid 0px blue;
	padding:4px;
	margin:0px;
	width:fit-content;
	height:40px;
	line-height:30px;
	font-size:14px;
}
.btn00:hover,
.btn11:hover{
	color:lime;
}
/*******/

tr.tdTitulo th{
	background-color:CORNFLOWERBLUE;
	font-size:15px;
	padding: 5px;
	margin:0px;
	color:white;
	font-weight: normal;
	border: solid 0px black;
}

select, textarea {
	background-color: white;
	color:black;
	font-weight: normal;
	font-size:12px;
	border: solid 0px silver;	
	padding: 0px 0px 0px 5px; 
	height:25px;
	font-family: 'Open Sans', Verdana, Arial;
}

select:disabled {
    background: gainsboro;
    border: solid 1px silver;
}
/*input[type=text]:enabled {*/
input[type=text]:disabled,input[type=date]:disabled {
    background: gainsboro;
    border: solid 1px silver;
}
input:enabled.boton{
	color:white;
	vertical-align: middle;
	text-align: center;
	background-color: CORNFLOWERBLUE;
	cursor: pointer;
	border: solid 0px white;
	padding:10px;
	margin:10px;
	height:40px;
	font-size:15px;
	font-weight: normal;
	border-radius: 15px;
}
input:enabled.boton2{
	color:white;
	vertical-align: middle;
	text-align: center;
	background-color: CORNFLOWERBLUE;
	cursor: pointer;
	border: solid 0px white;
	padding:0 9px 0 9px;
	margin:0px;
	height:30px;
	font-size:14px;
	font-weight: normal;
	border-radius: 15px;
}
input:disabled.boton2{
	color:gray;
	vertical-align: middle;
	text-align: center;
	background-color: gainsboro;
	cursor: pointer;
	border: solid 1px silver;
	padding:0 9px 0 9px;
	margin:0px;
	height:30px;
	font-size:14px;
	font-weight: normal;
	border-radius: 15px;
}
input:disabled.boton{
	color:gray;
	vertical-align: middle;
	text-align: center;
	background-color: gainsboro;
	cursor: pointer;
	border: solid 0px white;
	padding:10px;
	margin:10px;
	height:40px;
	font-size:15px;
	font-weight: normal;
	border-radius: 15px;
}
#EdicionMensaje{
	color:white;
	background-color:darkred;
	font-size: 12px;
	margin:0px;
	font-weight: bold;
	border: solid 1px blue;
	visibility:hidden;
	position:absolute;
	top:2px;
	left:2px;
	width:400px;
	z-index:110;
}
#EliminarData{
	text-align:center;
	margin:0;
	position:absolute;
	margin:auto;
	top:0;
    bottom:0;
	left:0;
    right:0;
	/*overflow:auto;*/
	color:black;
	background-color:white;
	font-size: 12px;
	font-weight: bold;
	border: solid 0px black;
	visibility:hidden;	
	/*top:100px;left:50px;*/
	width:400px;
	height:200px;
	z-index:110;
}
#EdicionDataFull{
	position:fixed;
	visibility:hidden;	
	margin:auto;
	overflow:hidden;
	top:0;bottom:0;left:0;right:0;
	text-align:center;
	background-color:white;
	border: solid 0px blue;	
	width:fit-content;height:fit-content;
	max-height:95%;max-width:95%;
	font-size:14px;color:white;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-radius: 15px;
	box-shadow: 0 0 50px rgba(0,0,0,0.5);
	z-index:110;
}
#EdicionDataText{
	display:inline-block;
	background-color:CORNFLOWERBLUE;
	border:solid 0px black;text-align:center;	
	width:calc(100% - 40px);
	height:40px;line-height:40px;	
	border-top-left-radius:15px;	
}
#EdicionDataClose{
	display:inline-block;float:right;
	background-color:CORNFLOWERBLUE;
	border: solid 0px black;text-align:center;
	padding-top:4px;
	width:40px;height:40px;line-height:40px;
	cursor:pointer;
	border-top-right-radius:15px;
}
/*  overflow: auto => barra deplazamiento
	overflow: hidden => esconde contenido despues del limite
*/
#EdicionData{
	position:relative;
	width:auto;
	height:auto;
	max-height:80vh;/*90% de la ventana browser*/	
	overflow:auto;
	border: solid 0px pink;
	text-align:center;
	color:black;
	margin: 0 0px 0 0;
	/*width:fit-content;*/
	
}
#ListaSpeedFull{
	position:absolute;
	visibility:hidden;	
	z-index:120;
	background-color:white;
	border: solid 0px gray;
	width:fit-content;height:fit-content;
	font-size:14px;color:black;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-radius: 15px;
	box-shadow: 0 0 50px rgba(0,0,0,0.5);
}
#ListaSpeedText{
	display:inline-block;
	background-color:CORNFLOWERBLUE;
	color:white;
	border:solid 0px black;text-align:center;	
	width:calc(100% - 40px);height:40px;line-height:40px;	
	border-top-left-radius:15px;	
}
#ListaSpeedClose{
	display:inline-block;float:right;
	background-color:CORNFLOWERBLUE;
	border: solid 0px black;text-align:center;
	padding-top:4px;
	color:white;
	width:40px;height:40px;line-height:40px;
	cursor:pointer;
	border-top-right-radius:15px;	
}
#ListaSpeed{
	/*clear:both;
	display:inline-block;	*/	
	overflow:auto;
	border: solid 0px green;
	width:100%;max-height:230px;
	border-bottom-left-radius:15px;	
	border-bottom-right-radius:15px;	
	/*width:fit-content;
	height:90%;*/
}
#ProcesoFull{
	position:absolute;
	visibility:hidden;	
	margin:auto;
	top:0;bottom:0;left:0;right:0;
	text-align:center;
	background-color:white;
	border: solid 0px blue;	
	width:fit-content;height:fit-content;
	font-size:14px;color:white;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	border-radius: 15px;
	box-shadow: 0 0 50px rgba(0,0,0,0.5);
	z-index:110;
}
#ProcesoText{
	display:inline-block;
	background-color:CORNFLOWERBLUE;
	border:solid 0px black;text-align:center;	
	width:calc(100% - 40px);height:40px;line-height:40px;	
	border-top-left-radius:15px;	
}
#ProcesoClose{
	display:inline-block;float:right;
	background-color:CORNFLOWERBLUE;
	border: solid 0px black;text-align:center;
	padding-top:4px;
	width:40px;height:40px;line-height:40px;
	cursor:pointer;
	border-top-right-radius:15px;
}
#Proceso{
	overflow:auto;
	border: solid 0px pink;
	width:fit-content;
	height:fit-content;
	/*height:calc(100% - 40px);*/
	text-align:center;
	color:black;
	/*width:fit-content;
	height:90%;*/
}

/*#EdicionDataSave{
	position:absolute;
	visibility:hidden;
	z-index:130;
	margin:auto;
	top:0;
    bottom:0;
	left:0;
    right:0;
	text-align:center;
	background-color:white;
	border: solid 2px blue;
	width:fit-content;height:fit-content;
	font-size:14px;color:white;
	font-family: 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}*/

#BlockAlpha{
	color:white;
	background-color:black;
	opacity:0.5;
	filter: alpha(opacity=50);
	font-size:12px;
	margin:0px;
	font-weight: bold;
	border: solid 0px black;
	visibility:hidden;
	position:fixed;
	top:0;left:0;
	width:100%;
	height:100%;
	z-index:99;
}
div.FiltroFind{
	visibility:hidden;
	clear:both;
	overflow:auto;
	width:0px;
	height:0px;
	margin:0px;
	border: solid 0px black;
	text-align:left;
}
div,tbody{
	margin:0px;
}
/*
#cuerpo{
	float:left;
	margin:0 auto;
	border: solid 1px black;	
	width:80%;
	vertical-align:top;
	padding: 5px;
	border-spacing: 0px;
	/*line-height:20px;*/
}
*/
a.atras{
	/*background-color: white;*/
	font-size:20px;
	font-weight: 300;
	font-weight: bold;
	margin: 5px;
	text-align:center;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}
/*
	color:gray;
	text-align:center;
	vertical-align:middle;
	padding: 3px; 
	margin:0px;
	border: solid 0px black;
	font-size:14px;
	font-weight: 300;
	line-height:3px;
*/
#CapaPaginador{
	/*background-color:LightGrey;*/
	background-color:white;
	color:black;	
	font-size: 12px;
	text-align:center;
	/*padding: 0px 0px 0px 0px; top - right - bottom - left*/
	margin:3px auto;
	border: solid 0px blue;
	height:35px;
	line-height:35px;
	/*width:400px;*/
}

a{	
	cursor: pointer;
	/*color: blank;
	font-weight: bold;*/
}

fieldset{
	width:fit-content;
	padding:3px;
	margin:0px;
	border:solid 1px cornflowerblue;
	border-radius: 5px;
	/*box-shadow: 0 0 3px rgba(0,0,0,0.5);*/
}
legend {
	font-size:12px;
	font-style:italic;
	font-weight:bold;
}

.tooltip {
    position: relative;
    display: inline-block;
}
.tooltip .tooltiptext {
    visibility: hidden;
    width: fit-content;
    background-color: cornflowerblue;
    color: #fff;
    text-align: left;
    border-radius: 6px;
    padding: 10px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}
.tooltip:hover .tooltiptext {
    visibility: visible;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
	color: blue;
	font-style:italic;
	opacity: 0.5; /* Firefox */
}
* {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
    color-adjust: exact !important;                 /*Firefox*/
}

/*LOGIN Y PORTADA*/
.table_sesion {
	position: absolute;
	margin:auto;
	left: 0;
	right:0;
	top:0;
	bottom:0;
	width:fit-content;
	height:fit-content;	
	border: solid 1px silver;
	background-color:white;
	border-radius:10px;
	box-shadow: 0 0 50px rgba(0,0,200,0.5);
	padding:20px;
}
/*IMAGEN PORTADA*/
.table_sesion div:nth-child(1) {
	float:left;
	border: solid 0px silver;
	margin:20px;
	vertical-align:top;
}

/*CAJA GRANDE LOGIN Y PORTADA */
.login {
	position: absolute;
	margin:auto;
	left: 0;	right:0;
	top:0;	bottom:0;
	width:fit-content;
	height:fit-content;	
	border: solid 1px teal;
	background-color:white;
	border-radius:10px;
	box-shadow: 0 0 50px rgba(0,0,200,0.5);
	padding:20px;
}
.login div:nth-child(1) {/*IMAGEN PORTADA*/
	float:left;
	border: solid 0px silver;
	margin:20px;
	vertical-align:top;
}
.login form {/*FORM LOGIN*/
	float:left;
	margin:20px;
	padding:15px;
	border:solid 1px silver;
	background-color: whitesmoke;
	border-radius:5px;
}
.login form h2 {
	text-align:center;
	color:gray;
	margin-bottom:20px;
}

.login form .uno
,.login form .dos
,.login form .boton_login{
	float:left;
	line-height:30px;
	padding:10px;
	margin-bottom:10px;
	border:solid 1px silver;
	font-family:Arial;
	font-size:18px;
	color:black;
}
.login form .uno{
	border-radius:10px 0 0 10px;
}
.login form .uno img{
	margin:0;width:30px;
}
.login form .dos{
	width:250px;
	border-left: solid 0px silver;
	border-radius:0 10px 10px 0;
}
.login form .dos:focus{
	border-color:#66afe9;
	outline:0;
	-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
	box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
}
.login form .dos::placeholder {
  color: silver;
}
.login form .boton_login{	
	width:100%;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
	color:white;
	background-color:CORNFLOWERBLUE;
	border: solid 0px silver;
	border-radius:10px;
	cursor:pointer;
}
.login form .boton_login:focus{
	border-color:#66afe9;
	outline:0;
	-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
	box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
}

/********************************************************/
/************C H A T********************/
/********************************************************/
#jd-chat{
	font-family:Arial;
	font-size:12px;
	position:fixed;
	bottom:0;
	float:right;
	right:0px;
}

#jd-chat .jd-user{
	margin-right:10px;
}
#jd-chat .jd-user,.jd-online{
	width:250px;
	display:inline-block;
	line-height:20px;
	border:solid 0px silver;
	border-radius:10px 10px 0px 0px;
	vertical-align:bottom;
}

#jd-chat  .light{
	display:inline-block;
	font-weight:bold;
	text-decoration:none;
	color:lime;
	font-size:30px;
	text-transform:none;
	vertical-align:middle;
	border:solid 0px silver;
}

#jd-chat  .nolight{
	display:inline-block;
	font-weight:bold;
	text-decoration:none;
	color:gray;
	font-size:30px;
	text-transform:none;
	vertical-align:middle;
	border:solid 0px silver;
}

#jd-chat .jd-header .close-this{
	float:right;
	width:fit-content;
	border:solid 0px;
	cursor:pointer;
}
#jd-chat .jd-header{
	padding:5px;
	background:limegreen;
	color:white;
	overflow:hidden;
	border-radius:10px 10px 0px 0px;
}

#jd-chat .jd-body{
	border:solid 0px silver;
}

#jd-chat .jd-body .jd-online_user{
	clear:both;
	float:left;
	padding-top:5px;
	cursor:pointer;
	width:100%;
	border-bottom:solid 0px silver;
	border:solid 0px silver;
}
#jd-chat .jd-online_user:hover{
	background:#f8f8f8;
	cursor:pointer;
}
#jd-chat .jd-user_name{
	float:left;
	padding:5px;
	border-bottom:solid 0px silver;
	border:solid 0px silver;
	width:50px;
	line-height:20px;
}
#jd-chat .luz{
	float:left;
	background:#2ecc71;
	height:10px;
	width:10px;
	left:10px;
	top:10px;
	padding-top:10px;
	padding-bottom:2px;
	border-radius:7px;
}

#jd-chat .jd-body{
	-webkit-transition: height 0.3s ease;
	overflow:auto;
	height:300px;
	/*min-height:250px; ~*/
	background:#F0FDDA;
	border-bottom:solid 0px silver;
}

#jd-chat input:checked + .jd-body {
	height: 0px;
}

#jd-chat .jd-body  span.me{
	clear:both;
	float:right;
	color:white;
	padding:7px;
	border-radius:10px;
	margin:2px;
	width:fit-content;
	background-color:teal;
}

#jd-chat .jd-body span.other{
clear:both;
	float:left;
	color:white;
	padding:7px;
	border-radius:10px;
	margin:2px;
	width:fit-content;
	background-color:gray;
}

#jd-chat .jd-footer{
	background:teal;
	color:white;
	overflow:hidden;
}

#jd-chat .jd-footer input{
	padding:5px;
	width:100%;
}

</style>