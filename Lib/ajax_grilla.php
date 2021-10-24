<script type="text/javascript">
function formatNumber(num) {
	return "$ "+num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}
function PaginadorClick(){
	objId('idpagAct').value = parseInt(objId('idpagAct').value) + 1;
	
	//JAVASCRIPT HACE EL CALCULO DE LA PAGINACION, LA GRILLA LA HACE EL SERVER. (CONCLUSION MAS EFICIENTE)
	var total=parseInt(objId('idcantreg').value);
	var mostrar=parseInt(objId('idmostrar').value);
	var pagAct=parseInt(objId('idpagAct').value);	
	var hasta=(mostrar*pagAct);
	var datos="<input type=hidden id=idcantreg value='"+total+"'>"
	+"<input type=hidden id=idmostrar value='"+mostrar+"'>"
	+"<input type=hidden id=idpagAct value='"+pagAct+"'>";
	if (hasta<total){
		if (mostrar > (total - hasta)){
			mostrar = total - hasta;
		}
		objId('CapaPaginador').innerHTML=datos+"<b>"+hasta+" de "+total+" Registro(s)&nbsp;</b>"
		+"<a onclick=\"PaginadorClick(1)\">Mostrar "+mostrar+" más <i class='fa fa-forward fa-lg'></i></a>";
	}else{
		hasta=total;
		objId('CapaPaginador').innerHTML=datos+"<b>"+hasta+" de "+total+" Registro(s)&nbsp;</b>";
	}
	
	var vars='';
	for (i=0;i<objId("idcantcampos").value;i++){
		if (objId("filtro"+i)){
			if (objId("filtro_text"+i)){
				if (objId("filtro"+i).style.visibility=='visible'){
					vars+='&wfiltro_text'+i+'='+objId("filtro_text"+i).value+'&wfiltro_opc'+i+'='+objId("filtro_opc"+i).value;
				}
			}else{
				//SELECT				
				if (objId("filtro"+i).style.visibility=='visible'){
					vars+='&wfiltro_sel'+i+'='+objId("filtro_sel"+i).value;
				}
			}
		}
	}
	vars+='&NOM_PAG='+objId("nom_pag").value;
	vars+="&MODULO="+objId('modulo').value;
	vars+='&wname_orden='+objId('name_orden').value;
	vars+='&wtipo_orden='+objId('tipo_orden').value;
	vars+='&wregmostrar='+objId('idregmostrar').value;
	vars+='&wnumpantalla='+objId('idpagAct').value;
	
	//GridRead('Lib/GridRead.php',vars,'CapaConsultar');
	//alert("a");
	var capa=objId('CapaConsultar');
	capa.style.visibility='visible';
	var ajax=nAjax();
	//capa.innerHTML="<tr><td colspan=6><center><i class='fa fa-spinner fa-spin fa-2x'></i><br>Cargando datos...</center></td></tr>";
	ajax.open("POST", 'Lib/GridRead.php', true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	objId('LoadingRead').innerHTML="<i class='fa fa-spinner fa-spin fa-2x'></i>   Procesando...";
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4 && ajax.status == 200){
			capa.innerHTML+=ajax.responseText;
			objId('LoadingRead').innerHTML="";
		}
		if (ajax.readyState == 4 && ajax.status == 0){
			objId('LoadingRead').innerHTML="No hay conexión con el servidor.\n"+ajax.statusText;
		}
	}
}

function CargarGrid(pagina,vars,capa1){
	//alert(pagina);
	var capa=objId(capa1);
	capa.style.visibility='visible';
	
	var ajax=nAjax();
	capa.innerHTML="<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
	ajax.open("POST", pagina, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){			
			capa.innerHTML = ajax.responseText;
			//CellEditAdd('grilla_table','cell_edit_start');
			GridReadPaginador();
		}
	}
}

function TipoBuscarSC(selectBox,i){
	var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	//alert(selectedValue);
	if (selectedValue == 'c1'){
		objId("filtro_sel_text"+i).style.visibility='visible';
		objId("filtro_sel_text"+i).style.height='30px';
	}else if (selectedValue == 'e1'){
		objId("filtro_sel_text"+i).style.visibility='visible';
		objId("filtro_sel_text"+i).style.height='30px';
	}else{
		objId("filtro_sel_text"+i).style.visibility='hidden';
		objId("filtro_sel_text"+i).style.height='0px';
		GridReadPaginador();
	}
}
function GridReadPaginador(){
	var capa=objId('CapaConsultar');
	if (!capa){return false;}
	capa.style.visibility='visible';
	var vars='NOM_PAG='+objId("nom_pag").value;
	vars+='&MODULO='+objId("modulo").value;
	vars+='&wregmostrar='+objId('idregmostrar').value;
	vars+='&wname_orden='+objId('name_orden').value;
	vars+='&wtipo_orden='+objId('tipo_orden').value;
	vars+='&wnumpantalla=1';
	//alert('fg');
	/*if (objId('idpagAct')){
		vars+='&wnumpantalla='+objId('idpagAct').value;
	}else{
		vars+='&wnumpantalla=1';
	}*/
	//alert(vars);
	//alert(objId("idcantcampos").value);
	for (i=0;i<objId("idcantcampos").value;i++){
		if (objId("filtro"+i)){
			if (objId("filtro_text"+i)){
				if (objId("filtro"+i).style.visibility=='visible'){
					vars+='&wfiltro_text'+i+'='+objId("filtro_text"+i).value+'&wfiltro_opc'+i+'='+objId("filtro_opc"+i).value;
				}
			}else{
				//SELECT				
				if (objId("filtro"+i).style.visibility=='visible'){
					vars+='&wfiltro_sel'+i+'='+objId("filtro_sel"+i).value;
				}
				//SELECT (CONTIENE, EMPIESA)
				if (objId("filtro_sel_text"+i).style.visibility=='visible'){
					vars+='&wfiltro_sel_text'+i+'='+objId("filtro_sel_text"+i).value;
				}
			}
		}
	}
	//alert(vars);
	var ajax=nAjax();
	//capa.innerHTML="<tr><td colspan=6><center><i class='fa fa-spinner fa-spin fa-2x'></i><br>Cargando datos...</center></td></tr>";
	objId('LoadingRead').innerHTML="<i class='fa fa-spinner fa-spin fa-2x'></i>   Procesando...";
	ajax.open("POST", "Lib/GridRead.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
	//alert(ajax.readyState+" "+ajax.status);
		if (ajax.readyState == 4 && ajax.status == 200){
		//alert('a');
			capa.innerHTML=ajax.responseText;
			javaEval(ajax.responseText);
			objId('LoadingRead').innerHTML="";
			nuevoAjax("Lib/GridPaginador.php",vars,"CapaPaginador");
			//capa.innerHTML="<tr><td colspan=6 class=td><center><img src='Lib/cargando.gif' valign=middle><br>Cargando datos...</center></td></tr>";
		}
		if (ajax.readyState == 4 && ajax.status == 0){
			objId('LoadingRead').innerHTML="No hay conexión con el servidor.\n"+ajax.statusText;
		}
	}
}

function OrdenarForm(obj){
	var nuevo_orden=1;
	for (i=0;i<objId("idcantcampos").value;i++){
		if (obj==objId("name_orden").value){
			nuevo_orden=0;
		}
	}
	if (nuevo_orden==1){
		objId("tipo_orden").value=0;
		for (i=0;i<objId("idcantcampos").value;i++){
			if (objId("img_orden"+i)){
				objId("img_orden"+i).innerHTML="";
			}
		}
	}
	
	//activar la columna clickeada
	var cadena='';
	switch(objId("tipo_orden").value){
		case '0':
			objId("tipo_orden").value=1;
			//cadena="<img src='Lib/img/up.gif' title='Ordenado Ascendente'>";
			cadena="<b>&uarr;</b>&nbsp;";
			//cadena="<i class='fa fa-caret-up fa-lg' title='Ordenado Ascendente'></i>";
		break;
		case '1':
			objId("tipo_orden").value=2;
			//cadena="<img src='Lib/img/down.gif' title='Ordenado Ascendente'>";
			cadena="<b>&darr;</b>&nbsp;";
			//cadena="<i class='fa fa-caret-down fa-lg' title='Ordenado Descendente'></i>";
		break;
		case '2':
			objId("tipo_orden").value=0;
			cadena="";
		break;
	}
	objId("name_orden").value=obj;
	objId("img_orden"+obj).innerHTML=cadena;
	GridReadPaginador();
}
function nuevoAjax(pagina,vars,capa1){
	var capa=objId(capa1);
	//capa.style.visibility='visible';
	//alert(vars);
	var ajax=nAjax();
	capa.innerHTML="<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
	ajax.open("POST", pagina, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			capa.innerHTML=ajax.responseText;
			javaEval(ajax.responseText);
			return ajax.responseText;
		}
	}
}
/*function submitGuardar(pagina,vars,capa1,java){
	var seguir=1;
	eval(java);
	if (seguir==1){*/
function submitGuardar(pagina,vars,capa1){
	vars+="&NOM_PAG="+objId('nom_pag').value;
	vars+="&MODULO="+objId('modulo').value;
	if (!objId("formEditar").reportValidity()){//VALIDAR CAMPOS NORMALES HTML5
		return false;
	}
	var existe_md=0;
	var cant = objId("idcantcampos").value;
	for (i = 0; i < cant; i++){
		//VALIDAR MaESTRO DETALLE (MD)
		if (objId("md_"+i+"_matrix_campo")){
			//total_campo += objId("md_"+i+"_cant_fila").value * objId("md_"+i+"_cant_campo").value;				
			//alert(total_campo);
			var str_mas = '';
			vars+="&wmd_"+i+"_cant_fila="+objId("md_"+i+"_cant_fila").value;
			for (f = 1; f <= objId("md_"+i+"_cant_fila").value; f++){
				for (c = 1; c <= objId("md_"+i+"_cant_campo").value; c++){
					//alert(objId("md_"+objId("md_matrix_campo").value+"_"+f+"_"+c).value);
					if (objId("md_new_"+i+"_"+f+"_"+c)){
						if (objId("md_new_"+i+"_"+f+"_"+c).reportValidity()){
							vars+="&wmd_"+i+"_"+f+"_modo=C";
							str_mas = objId("md_new_"+i+"_"+f+"_"+c).value;
							str_mas = str_mas.replace(/\+/g,"%2b");// reemplazar signo mas (+) por simbolo url
							vars+="&wmd_"+i+"_"+f+"_"+c+"="+str_mas;
						}else{
							return false;
						}
					}else if (objId("md_up_"+i+"_"+f+"_"+c)){
						if (objId("md_up_"+i+"_"+f+"_"+c).reportValidity()){
							vars+="&wmd_"+i+"_"+f+"_modo=U";
							vars+="&wmd_"+i+"_"+f+"_id="+objId("md_up_"+i+"_"+f+"_id").value;
							str_mas = objId("md_up_"+i+"_"+f+"_"+c).value;
							str_mas = str_mas.replace(/\+/g,"%2b");// reemplazar signo mas (+) por simbolo url
							vars+="&wmd_"+i+"_"+f+"_"+c+"="+str_mas;
						}else{
							return false;
						}
					}
				}
				if (objId("md_del_"+i+"_"+f)){
					vars+="&wmd_"+i+"_"+f+"_modo=D";
					vars+="&wmd_del_"+i+"_"+f+"="+objId("md_del_"+i+"_"+f).value;
				}
				//SI EXISTE UNA CAJA NUEVA O UNA CAJA EN ESTADO EDITABLE (MD)
				if (objId("md_new_"+i+"_"+f+"_1") || objId("md_up_"+i+"_"+f+"_1")){
					existe_md = 1;
				}
			}
			//SI EXISTE AL MENOS UN ENTRADA EN CAMPO (MD)
			if (objId("md"+i+"req") && objId("md"+i+"req").value == "*"){
				if (!objId("md"+i+"_1pred") && existe_md==0){
					alert("Debe agregar al menos una entrada en la lista "+objId("md"+i+"name").value +".");
					return false;
				}
			}
		}
	}
	//SI EXISTE AL MENOS UN SERVICIO AGREGADO SMCT
	if (objId("smct_uni") && objId("smct_uni").value=='$ 0'){
		alert('Debe agregar al menos un servicio.');
		return false;
	}
	//alert(vars);
	//VALIDACION CORRECTA DE TODO EL FORMULARIO
	AjaxGuardar(pagina,vars,capa1);
}

/*for (i = 1; i < objId(capaf).elements.length; i++){if (objId(capaf).elements[i]){
vars=vars+"&"+objId(capaf).elements[i].id+"="+objId(capaf).elements[i].value;*/
function AjaxGuardar(pagina,vars,capa1){
	var cant=objId("idcantcampos").value;
	//alert("+asd+qw");
	for (i = 0; i < cant; i++){
		//TEXT, SELECT
		if (objId("wk"+i)){
			//vars=vars+"&wk"+i+"="+objId("wk"+i).value);
			var str11=objId("wk"+i).value;
			str11=str11.replace(/\+/g,"%2b");// reemplazar signo mas (+) por simbolo url
			vars=vars+"&wk"+i+"="+str11;
		}
		//alert(vars);
		
		//INPUT TYPE RADIO
		if (objId("acum"+i)){
			for (m=1;m<=objId("acum"+i).value;m++){
				//alert("asdf");
				if (objId("wrd"+m+"_"+i).checked){
					vars=vars+"&wk"+i+"="+objId("wrd"+m+"_"+i).value;
				}
			}
		}
		
		//LISTA MULTIPLE
		if (objId("sm"+i+"cant")){
			vars=vars+"&wsm"+i+"cant="+objId("sm"+i+"cant").value;
			for (m=1;m<=objId("sm"+i+"cant").value;m++){
				if (objId("sm"+i+"_"+m+"add")){
					vars=vars+"&wsm"+i+"_"+m+"add="+objId("sm"+i+"_"+m+"add").value;
				}
				if (objId("sm"+i+"_"+m+"del")){
					vars=vars+"&wsm"+i+"_"+m+"del="+objId("sm"+i+"_"+m+"del").value;
				}
			}
		}
		
		//LISTA MULTIPLE SMCT
		if (objId("smct_cant")){
			vars += "&wsmct_cant="+objId("smct_cant").value;//+"&wsmct_porc="+objId("smct_porc").value;+"&wsmct_trab="+objId("smct_trab").value;
			for (m=1;m<=objId("smct_cant").value;m++){
				if (objId("smct_add_cod"+m)){
					vars+="&wsmct_add_cod"+m+"="+objId("smct_add_cod"+m).value;
					vars+="&wsmct_add_precio"+m+"="+objId("smct_add_precio"+m).value;
					vars+="&wsmct_add_cant"+m+"="+objId("smct_add_cant"+m).value;
					vars+="&wsmct_add_descu"+m+"="+objId("smct_add_descu"+m).value;
				}
				if (objId("smct_del"+m)){
					vars+="&wsmct_del"+m+"="+objId("smct_del"+m).value;
				}
			}
		}
		
		//GUARDAR FILE NOMBRE EN BD
		if (objId("wfile"+i) && objId("wfile"+i).value != ""){
			//alert(objId("wfile"+i).value);
			//vars=vars+"&wfilek"+i+"="+objId("wfile"+i).value;
		}
	}
	//alert(vars);
	//objId('btnSave').value="Guardando...";
	objId('btnSave').disabled=true;
	//alert(vars);
	
	var str='';
	var capa=objId(capa1);
	var ajax=nAjax();
	capa.style.visibility='visible';
	capa.innerHTML="<center><p><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
	ajax.open("POST", pagina, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		//alert(ajax.readyState);
		if (ajax.readyState==4){
			str=ajax.responseText;
			//alert(str);
			//alert(str.substr(0,4));
			//if (str.substr(0,4)=='true'){
			var ar = str.split("%");
			if (ar[0] == 'true'){
				//GRABADO CORRECTO ************************
				var tipo_evento = '';
				if (ar[1] == 'U'){
					tipo_evento = "ACTUALIZADO";
				}else{
					tipo_evento = "CREADO";
				}
				//alert(ar[2]);
				capa.innerHTML = "<center><p><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
				//capa.style.visibility='hidden';
				var n = 1;
				var cnt = 0;
				//COMPROBAR SI HAY IMAGENES
				for (i = 0; i < cant; i++){
					if (objId("wfile"+i) && objId("wfile"+i).value != ""){
						cnt++;
					}
				}				
				objId('ListaSpeedFull').style.visibility='hidden';
				objId('ListaSpeedText').innerHTML="";
				if (cnt==0){
					//SI NO HAY ARCHIVOS (VENTANA FINAL LUEGO DE GRABAR)
					objId('EdicionData').innerHTML="<div style='width:400px;'><font color=blue><br>SE HA "+tipo_evento+" EL REGISTRO Id: "+ar[2]+".</font>";
					objId('EdicionData').innerHTML+="<input type=button id=save_ok value='Cerrar' class=boton onclick='closeFade()'></div>";
					//objId('EdicionData').innerHTML+="<input type=button autofocus value='Cerrar' class=boton onclick='loop1=setInterval(closeFade, 10);'></div>";
					objId('save_ok').focus();
				}else{
					for (i = 0; i < cant; i++){
						if (objId("wfile"+i) && objId("wfile"+i).value != ""){
							//CargarFile(objId("wk0").value, objId("NOM_PAG").value, i);
							//CargarFile(key, pagina, i)=function(){
							//CargarFile(objId("wk0").value, objId("nom_pag").value, i, function(){
							CargarFile(parseInt(ar[2]), objId("nom_pag").value, i, function(){
								if (n == cnt) {
									//alert(n+'ss');
									objId('EdicionData').style.width=400;
									objId('EdicionData').style.height=100;
									objId('EdicionData').innerHTML="<font color=blue><br>SE HA "+tipo_evento+" EL REGISTRO Id: "+ar[2]+".</font>";	
									objId('EdicionData').innerHTML+="<input type=button id=save_ok value='Cerrar' class=boton onclick='closeFade()'></font>";
									//objId('EdicionData').innerHTML+="<br><br><input type=button autofocus value='Cerrar' class=boton onclick='loop1=setInterval(closeFade, 10);'></font>";
									objId('save_ok').focus();
								}
								n++;
							});
							//callback****************************************
						}
					}
				}
			}else{
				//ERRORES				
				//capa.innerHTML=ajax.responseText;
				capa.innerHTML="";
				objId('EdicionDataSave').innerHTML = ajax.responseText;
				//alert(ajax.responseText);				
				//objId('btnSave').value = "Guardar Cambios";
				objId('btnSave').disabled = false;
			}
		}
	}
	//contentWindow
}

function CargarFile(key, pagina, i, miCallback){
	var data = new FormData();
	data.append('warchivo', objId('wfile'+i).files[0]);//archivo fisico
	data.append('warchivo_album', objId('wfile_album'+i).value);//id del album en imgur.com
	data.append('NOM_PAG', pagina);
	data.append('wnum', i);
	data.append('wkey', key);
	var ajax = nAjax();
	ajax.open('POST', 'Lib/GridFileUp.php', true);
	ajax.send(data);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//alert(ajax.responseText);
			miCallback();
		}
	}
}

var loop1;
function closeFade(){
	/*opac=objId('EdicionDataFull').style.opacity;
	opac = opac - 0.01;
	objId('EdicionDataFull').style.opacity=opac;
	if (opac<0){*/
		objId('EdicionData').innerHTML="";
		objId('BlockAlpha').style.visibility='hidden';
		objId('EdicionDataFull').style.visibility='hidden';
		objId('EdicionDataFull').style.opacity=1.0;
		objId('EdicionData').style.width="fit-content";
		objId('EdicionData').style.height="calc(100% - 40px)";
		//clearTimeout(loop1);
		
		GridReadPaginador();
	//}
}

function VerFormulario(vars,tipo,titulo){
	//alert('ss');
	if (objId('cell_edit_act')){objId('cell_edit_act').value=0;}
	objId('EdicionDataFull').style.visibility = 'visible';
	objId('BlockAlpha').style.visibility = 'visible';
	objId('EdicionDataFull').style.opacity=1.0;	
	
	var pagina="";
	vars+="&NOM_PAG="+objId('nom_pag').value+"&wtipo_edicion="+tipo;
	vars+="&MODULO="+objId('modulo').value;
	switch(tipo){
		case 1: case 2: case 3:/*EDITAR - NUEVO - COPIAR*/
			pagina="Lib/GridEditar.php";
		break;
		case 4:/*EXCEL*/
			pagina="Lib/GridExcel.php";
			vars+='&wname_orden='+objId('name_orden').value;
			vars+='&wtipo_orden='+objId('tipo_orden').value;
			
			for (i=0;i<objId("idcantcampos").value;i++){
				if (objId("filtro"+i)){
					if (objId("filtro_text"+i)){
						if (objId("filtro"+i).style.visibility=='visible'){
							vars+='&wfiltro_text'+i+'='+objId("filtro_text"+i).value+'&wfiltro_opc'+i+'='+objId("filtro_opc"+i).value;
						}
					}else{
						//SELECT
						if (objId("filtro"+i).style.visibility=='visible'){
							vars+='&wfiltro_sel'+i+'='+objId("filtro_sel"+i).value;
						}
						//SELECT (CONTIENE, EMPIESA)
						if (objId("filtro_sel_text"+i).style.visibility=='visible'){
							vars+='&wfiltro_sel_text'+i+'='+objId("filtro_sel_text"+i).value;
						}
					}
				}
			}
			//nuevoAjax("Lib/GridExcel.php",vars,'EdicionData');
		break;
		case 5: pagina="Lib/GridProceso.php";break;//PROCESO
		case 6: pagina="Lib/GridEliminar.php";break;//DELETE
		case 7: pagina="Lib/GridImportar.php";break;//IMPORTAR
		break;
	}
		
	var capa=objId('EdicionData');
	//alert(vars);
	var ajax=nAjax();	
	capa.innerHTML="<div style='width:400px;'><center><i class='fa fa-spinner fa-spin fa-2x'></i><br>Cargando...</center></div>";	
	objId('EdicionDataText').innerHTML="<b>"+titulo+"</b>";
	ajax.open("POST", pagina, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			objId('EdicionData').style.width = 990;//dar maximo tamaño para luego ajustar al tanaño real		
			capa.innerHTML=ajax.responseText;
			javaEval(ajax.responseText);
			
			//ubicar cursor en primer caja de texto ó buscar_select
			if (objId("wk0")){			
				objId("wk0").focus();
			}
			if (objId("bs_sel0")){objId("bs_sel0").focus();}
			if (objId("bs_sel1")){objId("bs_sel1").focus();}
				
			if (tipo < 4){
				//AJUSTAR EL TAMAÑO DEL FORMUALRIO EN CASO DE QUE SOBREPASAE EL TAMAÑO VERTICAL PANTALLA (EDITAR, NUEVO, COPIAR)
				//objId('EdicionData').style.width = objId('tableEditar').offsetWidth+20;
				/*if (objId("tableEditar").clientHeight > 500){
					objId('EdicionData').style.height = '590px';
				}else{
					objId('EdicionData').style.height = objId('tableEditar').offsetHeight+50;
				}*/
			}else{
				//OTROS FORMUALRIOS (EXCEL, IMPORTAR)
				//objId('EdicionData').style.width = w;
				//objId('EdicionData').style.height = h;	
			}
			objId('EdicionData').style.width = 'fit-content';
			objId('EdicionData').style.height = 'fit-content';
		}
	}
	
}

function ajaxFrame(file){
	objId('EdicionData').innerHTML="";
	objId('EdicionData').style.visibility='visible';
	objId('BlockAlpha').style.visibility='visible';
	
	var capa=objId('EdicionData');
	capa.style.visibility='visible';
	capa.innerHTML="<br><center><p><i class='fa fa-spinner fa-spin fa-2x'></i><br>Guardando...</p></center>";
	//alert('sdf');
	var vars='NOM_PAG='+objId("nom_pag").value+'&wregmostrar='+objId('idregmostrar').value;
	vars+='&wname_orden='+objId('name_orden').value;
	vars+='&wtipo_orden='+objId('tipo_orden').value;
	//alert(objId("idcantcampos").value);
	for (i=0;i<objId("idcantcampos").value;i++){
		if (objId("filtro"+i)){
		if (objId("filtro"+i).style.visibility=='visible'){
			vars=vars+'&wfiltro_text'+i+'='+objId("filtro_text"+i).value+'&wfiltro_opc'+i+'='+objId("filtro_opc"+i).value;
		}
		}
	}
	
	var ajax=nAjax();
	capa.innerHTML="<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
	ajax.open("POST", "Lib/GridFrame.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send('');
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			capa.innerHTML=ajax.responseText;			
			//CAMPO GPS GOOGLE MAPS
			objId('iframe_mapa').src=file+"?"+vars;
			//alert(objId('iframe_mapa').src);
			return ajax.responseText;
		}
	}
}

function AjaxEliminar(vars){
	vars+='&NOM_PAG='+objId("nom_pag").value;
	vars+='&MODULO='+objId("modulo").value;
	var capa=objId('EdicionData');
	var str='';
	var ajax=nAjax();
	capa.innerHTML="<div style='width:400px;font-align:center;'><i class='fa fa-spinner fa-spin fa-2x'></i><br>Eliminado...</div>";
	ajax.open("POST", "Lib/GridEliminar.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//ajax.SetRequestHeader("Content-length", vars.Length);
	//ajax.SetRequestHeader("Accept-Charset","UTF-8");
	//ajax.SetRequestHeader("Connection", "close"); 
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//capa.innerHTML= ajax.responseText;
			str=ajax.responseText;
			//alert(str);
			var ar = str.split("|");
			//if (str.substr(0,4)=='true'){
			if (ar[1]=='true'){
			//if (str.substr(str.length-4)=='true'){
				//capa.style.visibility='hidden';
				//capa.innerHTML='';
				objId('EdicionData').innerHTML="<div style='width:400px;'><font color=blue><br>SE HA ELIMINADO EL REGISTRO Id: "+ar[0]+".</font>";	
				objId('EdicionData').innerHTML+="<input type=button id=save_ok value='Cerrar' class=boton onclick='closeFade()'></div>";
				//objId('EdicionData').innerHTML+="<input type=button autofocus value='Cerrar' class=boton onclick='loop1=setInterval(closeFade, 10);'></div>";
				objId('save_ok').focus();
				//GridReadPaginador();
			}else{
				capa.innerHTML=ajax.responseText;
			}
		}
	}
}

function AjaxProceso(vars,h,titulo){
	objId('ProcesoText').innerHTML='<b>'+titulo+'</b>';
	objId('ProcesoFull').style.visibility='visible';
	objId('BlockAlpha').style.visibility='visible';
	objId('ProcesoFull').style.height=h;
	//alert(vars);
	vars+="&h="+h;
	vars+='&NOM_PAG='+objId("nom_pag").value;
	vars+="&MODULO="+objId('modulo').value;
	var capa=objId('Proceso');
	var str='';
	//capa.style.visibility='visible';
	//alert(vars);
	var ajax=nAjax();
	objId('ProcesoFull').style.width = (objId('ProcesoFull').offsetWidth)+'px';
	capa.innerHTML="<center><i class='fa fa-spinner fa-spin fa-2x'></i><br>Procesando...</center>";
	ajax.open("POST", "Lib/GridPlantilla.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	//alert(vars);
	//alert(objId("nom_pag").value);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//alert(ajax.responseText);
			capa.innerHTML = ajax.responseText;
			objId('ProcesoFull').style.height = h;
			objId('ProcesoFull').style.width = 'fit-content';
			objId('Proceso').style.width = '100%';
			objId('Proceso').style.height = 'calc('+h+' - 40px)';
			//objId('ProcesoFull').style.width = (objId('ProcesoFull').offsetWidth+20)+'px';//para eviatar que barra despazamiento de la tabla, se salga del div
			
			javaEval(ajax.responseText);
		}
	}
	//capa.innerHTML = "sssdffbdc";
}

var loopGraph;
function CerrarBlock(){
	objId('BlockAlpha').style.visibility='hidden';
	objId('BlockAlpha').innerHTML="";
	objId('EdicionDataFull').style.visibility='hidden';
	objId('EdicionData').innerHTML="";
	if (objId('ListaSpeedFull')){
		objId('ListaSpeedFull').style.visibility='hidden';
		objId('ListaSpeedText').innerHTML="";
	}
	if (objId('ProcesoFull')){
		objId('ProcesoFull').style.visibility='hidden';
		objId('Proceso').innerHTML="";
	}
	if (objId('EliminarData')){
		objId('EliminarData').style.visibility='hidden';
		objId('EliminarData').innerHTML="";
	}
	if (loop1){clearTimeout(loop1);}
	if (loopGraph){clearInterval(loopGraph);}
	//alert('waaw');
}
function CerrarBlockListaSpeed(){
	objId('ListaSpeedFull').style.visibility='hidden';
	objId('ListaSpeedText').innerHTML="";
}
function OcultarFiltro(obj){
	if (objId("filtro"+obj).style.visibility=='visible'){		
		objId("filtro"+obj).style.visibility='hidden';
		objId("filtro"+obj).style.width='0px';
		objId("filtro"+obj).style.height='0px';
		objId("filtro"+obj).style.overflow='auto';
		objId("filtro_text"+obj).value='';
	}else{
		objId("filtro"+obj).style.visibility='visible';
		objId("filtro"+obj).style.width='auto';
		objId("filtro"+obj).style.height='auto';
		objId("filtro"+obj).style.overflow='auto';
		objId("filtro_text"+obj).focus();
	}
}

//*****************
function FilaAddSMCT(codigo,nombre,precio){
	if (!objId("smct_id"+codigo)){//NO REPETIR
	//alert("lleno: "+objId("smct_cant").value);
	//if (parseInt(objId("smct_cant").value) >= 5){
	if ((objId("smct_table").rows.length-1) >= objId("smct_cant_max").value){
		alert("Maximo "+(objId("smct_table").rows.length-1)+" servicios por cotización.");
		return false;
	}
		//INCREMENAR CANTIDAD (LISTA ADD)
		objId("smct_cant").value = parseInt(objId("smct_cant").value)+1;
		var n = objId("smct_cant").value;
		var existe = 0;
		
		//ADD OBJ A LA (LISTA ADD)
		/*objId("smct_lista").innerHTML +=
		"<input id=smct_add_cod"+n+" type=hidden size=1 value='"+codigo+"'>"
		+"<input id=smct_add_precio"+n+" type=hidden size=1 value='"+precio+"'>"
		;*/
		var todo = "<td class=sin_borde>"
		+"<div class=link_edit><img src='img/Gdelete.png' style='width:20px;' onclick=FilaDeleteSMCT('"+n+"',"+existe+") id=smct_id"+codigo+" title='Eliminar Registro'></i></div>"
		+"<td class=sin_borde>"+nombre
		//+"<td class=sin_borde><span id=smct_serv_val"+n+" style='border:solid 1px silver;padding:3px;'>"+precio+"</span>"
		+"<td class=sin_borde><input id=smct_add_precio_ver"+n+" readonly style='border:solid 1px silver;width:80px;text-align:right;padding:2px;' value='"+formatNumber(precio)+"'>"
		+"<input id=smct_add_cod"+n+" type=hidden value='"+codigo+"'>"
		+"<input id=smct_add_precio"+n+" type=hidden value='"+precio+"'>"
		+"<td class=sin_borde style='width:40px;'>"
		+"<input id=smct_add_cant"+n+" onclick=CalcularSMCT() type=number title='Cantidad' min=1 step=1 style='border:solid 1px silver;width:100%;text-align:center;padding:2px;' value=1>"
		+"<td class=sin_borde style='width:120px;'>"
		+"<select id=smct_add_descu"+n+" onchange=CalcularSMCT() style='width:100%;border:solid 0px silver;'>";
		var textof='';
		for (var f=10;f>=-10;f--){
			todo += "<option value="+(f/100);
			if (f >= 0){
				textof="Descuento "+f;
			}else{
				textof="Incremento "+Math.abs(f);
			}
			if (f == 0){
				todo +=" selected";
			}
			todo += ">"+textof+"%</option>";
		}
		todo += "</select><td class=sin_borde><input id=smct_subtotal"+n+" readonly style='border:solid 0px silver;width:80px;text-align:right;padding:2px;color:blue;font-weight:bold' value=''>";

		var row = document.createElement("tr");
		row.innerHTML = todo;
		objId("smct_table").appendChild(row);
		CalcularSMCT();
	}
}
function round_cop(num, unidad){
     return  Math.round(num / unidad) * unidad; 
}
function CalcularSMCT(){
	var f = 0;
	var cant = parseInt(objId("smct_cant").value);
	var precio=0;
	var precio_descu=0;
	var cantidad=0;
	var descu=0.0;
	var subtotal=0.0;
	var total=0.0;
	for (f = 1; f <= cant; f++){
		if (objId("smct_fijo_precio_ver"+f)){//SERVICIOS EN EL EDITAR
			precio = parseInt(objId("smct_fijo_precio"+f).value);
			descu = parseFloat(objId("smct_fijo_descu"+f).value);
			//precio_descu = Math.round(precio * (1.0 - descu));
			precio_descu = round_cop(precio * (1.0 - descu),100);
			cantidad = parseInt(objId("smct_fijo_cant"+f).value);
			objId("smct_fijo_precio_ver"+f).value = formatNumber( precio_descu );
		}
		if (objId("smct_add_precio_ver"+f)){//NUEVOS SERVICIOS
			precio = parseInt(objId("smct_add_precio"+f).value);
			descu = parseFloat(objId("smct_add_descu"+f).value);
			precio_descu = round_cop(precio * (1.0 - descu),100);
			cantidad = parseInt(objId("smct_add_cant"+f).value);
			objId("smct_add_precio_ver"+f).value = formatNumber( precio_descu );
		}
			
		if (objId("smct_subtotal"+f)){
			subtotal = Math.round(precio_descu * cantidad);
			//subtotal = round_cop(precio_descu * cantidad ,50);
			objId("smct_subtotal"+f).value = formatNumber(subtotal);//SUBTOTAL
			total += subtotal;
		}
	}
	objId("smct_total").value = formatNumber( Math.round( total ) );//TOTAL
}

function FilaDeleteSMCT(fila, existe){
	//BORRAR FILA EN TABLA
	var cad='';
	if (existe==1 && objId('smct_fijo_cod'+fila)){
		objId("smct_cant").value = parseInt(objId("smct_cant").value)+1;
		var n = objId("smct_cant").value;
		//alert('ssR'+fila);
		objId("smct_lista").innerHTML += "<input id=smct_del"+n+" type=hidden size=1 value='"+objId('smct_fijo_cod'+fila).value+"'>";
	}
	if (existe==1){
		cad='smct_fijo_cod';
	}else{
		cad='smct_add_cod';
	}
	var tr = objId(cad+fila).parentNode.parentNode;
	var table = tr.parentNode.removeChild(tr);
	CalcularSMCT();
}
//*********
function FilaAddSM(num,codigo,nombre){
	//BUSCAR REPETIDO EN LOS PREDEFINIDOS
	if (!objId("sm_id"+codigo)){//NO REPETIR
		var cant = objId("sm"+num+"cant").value;
		var existe = 0;
		for (f = 1; f <= cant; f++){
			if (objId("sm"+num+"_"+f+"del")){
				if (codigo == objId("sm"+num+"_"+f+"del").value){
					var del = objId("sm"+num+"_"+f+"del");
					del.parentNode.removeChild(del);
					existe = 1;
				}
			}
		}
		if (existe == 0){
			//ADD A LA (LISTA ADD)
			objId("sm"+num+"cant").value = parseInt(objId("sm"+num+"cant").value)+1;
			var n = objId("sm"+num+"cant").value;
				
			objId("sm"+num+"lista").innerHTML +=
			"<input id=sm"+num+"_"+n+"add type=hidden size=1 value='"+codigo+"'>";
		}
		var row = document.createElement("tr");
		row.innerHTML = "<td class=sin_borde>"
		+"<div class=link_edit><i class='fa fa-trash fa-2x' onclick=FilaDeleteSM('"+num+"','"+n+"','"+codigo+"',"+existe+",this) title='Eliminar Registro' id=sm_id"+codigo+"></i></div>"
		+"</td><td class=sin_borde>"+nombre+"</td>";
		objId("sm_table"+num).appendChild(row);
	}
}
function FilaDeleteSM(num, fila, codigo, def, obj){
	//BORRAR FILA EN TABLA
	var tr = obj.parentNode.parentNode.parentNode;
	var table = tr.parentNode.removeChild(tr);
	if (def==1){
		//DELETE LOS YA PREDEFINIDOS -- ADD A LA (LISTA ADD)
		objId("sm"+num+"cant").value = parseInt(objId("sm"+num+"cant").value)+1;
		var n = objId("sm"+num+"cant").value;
		
		objId("sm"+num+"lista").innerHTML +=
		"<input id=sm"+num+"_"+n+"del type=hidden size=1 value='"+codigo+"'>";
	}else{
		//BORRAR ELEMENTO HIDDEN DELETE
		if (objId("sm"+num+"_"+fila+"add")){
			var del = objId("sm"+num+"_"+fila+"add");
			del.parentNode.removeChild(del);
		}
	}
}
function ListaSpeedUbicarSM(event,capa){
	//alert('ss');
	var x = event.clientX;
	var y = event.clientY;
	var cuadro = objId(capa+"Full");
	cuadro.style.visibility = 'visible';
	objId(capa+"Text").innerHTML="Lista Completa";
	////alert(x+" "+cuadro.offsetHeight);
	//cuadro.style.left = x + 30;
	//cuadro.style.top = y - cuadro.offsetHeight;
	
	cuadro.style.left = (screen.width/2)-225;
	cuadro.style.top = (screen.height/2)-200;
}
function ListaSpeedUbicar(objRefName,titulo){
	var cuadro = objId("ListaSpeedFull");
	cuadro.style.visibility = 'visible';
	objId("ListaSpeedText").innerHTML=titulo;
	UbicarCapa(objRefName,"ListaSpeedFull");
}
function UbicarCapa(objRefName, capa){
	var objRef = objId(objRefName);
	var base = objRef.getBoundingClientRect();
	var x = parseInt(base.left);
	var y = parseInt(base.top);
	var cuadro = objId(capa);
	cuadro.style.visibility = 'visible';
	//alert(x +","+y+" screen2: "+(screen.height/2)+" "+screen.height);
	if (x > (window.innerWidth/2)){
		//MOSTRAR DERECHA
		cuadro.style.left = x - cuadro.offsetWidth;
	}else{
		//MOSTRAR IZQUIERDA
		cuadro.style.left = x + 50;
	}
	//alert(window.innerWidth+" "+window.innerHeight);
	if (y > (window.innerHeight/2)){
		//MOSTRAR ARRIBA
		cuadro.style.top = y - cuadro.offsetHeight - 20;
	}else{
		//MOSTRAR ABAJO		
		cuadro.style.top = y + 40;
	}
}

function nuevoAjaxSelect(pagina,event,num,vars){
	var x = event.clientX;
	var y = event.clientY;
	var titulo='ListaSpeed';
	var cuadro = objId(titulo+"Full");
	cuadro.style.visibility = 'visible';
	objId(titulo+"Text").innerHTML="Lista Rapida";
	//alert(x+" "+screen.width+" :: "+y+" "+screen.height);
	//screen.availWidth
	if (x > (screen.width/2)){
		//CLIC LADO DERECHO
		cuadro.style.left = x - 550;
	}else{
		//CLIC LADO IZQUIERDO
		cuadro.style.left = x + 10;
	}
	if (y > (screen.height/2)){
		//CLIC ABAJO
		cuadro.style.top = y - 270;
	}else{
		//CLIC ARRIBA
		cuadro.style.top = y + 10;
	}
	//cuadro.style.top = y - cuadro.offsetHeight;
	var capa=objId(titulo);
	vars+='&NOM_PAG='+objId("nom_pag").value+'&wnum='+num;
	//capa.style.visibility='visible';
	
	//alert(vars);
	var ajax=nAjax();
	capa.innerHTML="<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
	ajax.open("POST", pagina, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//VERIFICAR SI ES UN SOLO REGISTRO
			capa.innerHTML=ajax.responseText;
			//alert(cuadro.style.left);
			if (objId('select_unico_reg')){
				objId('cap_sel'+num).innerHTML = objId('select_unico_reg').innerHTML;
				objId("ListaSpeedFull").style.visibility = 'hidden';
			}else{
				capa.innerHTML=ajax.responseText;
			}
		}
	}
}
function nuevoAjaxSelectN2(pagina,num,vars,capa_titulo){
	var ajax=nAjax();
	var capa=objId(capa_titulo+num);
	vars+='&NOM_PAG='+objId("nom_pag").value+'&wnum='+num;
	capa.innerHTML="<center><img src='Lib/cargando.gif' valign=middle></center>";
	ajax.open("POST", pagina, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			capa.innerHTML=ajax.responseText;
		}
	}
}
//**********

function calcularEdad(fecha,obj) {
	if (fecha){
		var hoy = new Date();
		var cumpleanos = new Date(fecha);
		var edad = hoy.getFullYear() - cumpleanos.getFullYear();
		var m = hoy.getMonth() - cumpleanos.getMonth();
		if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
			edad--;
		}
		objId(obj).value = edad+" Años";
	}
}

</script>