<?php
include("../funciones.php");
include("../".$NOM_PAG);

/*
Client ID: b944e545a34d956
Client secret: 17cf8a00031079f3856a98bf7037560b6b4cf57d
*/
//if (!isset($TituloCapa)){$TituloCapa='';}
if ($_SESSION['ACCESO_SESION']==1){
	$wusuario=encriptar($_SESSION['USU_ID'],$llave,2);
}else{
	mensaje("Ha expirado la sesión.",2);
	mysqli_close($cxn);
	exit();
}

/*?><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><?*/
$TIPO='';$titulo='';
switch($wtipo_edicion){
	case 1:
		$EDITAR=encriptar($WEDITAR,$llave,2);
		//$titulo='Editar Registro ('.$MATRIX[1][0].': '.$EDITAR.')';
		$titulo='Editar Registro ('.$TB_KEY.': '.$EDITAR.')';
		$TIPO='U';
	break;
	case 2:
		$titulo='Nuevo Registro';	
		unset($WEDITAR);
		$TIPO='C';
	break;	
	case 3:
		$EDITAR=encriptar($WEDITAR,$llave,2);
		$titulo='Copiar Registro';
		$WEDITAR;
		$TIPO='C';
	break;
}
/*
<form onsubmit="event.preventDefault();"
width: 25em border-box;
width: 75% content-box;
width: max-content;
width: min-content;
width: available;
width: fit-content;
width: auto;
width: inherit;
width: initial;
width: unset;
*/
?>
<style>
#gptab-c1,#gptab-c2, #gptab-c3{ display: none; }
#gplab1, #gplab2, #gplab3{
	float:left;
	margin:0 5px 0 0;
	background-color: gainsboro;
	border: solid 0px black;
	border-radius: 25px 25px 0 0;
	color: black;
	font-size:16px;
	padding:10px 20px 10px 20px;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}
#gptab-c1:checked ~ #gplab1, 
#gptab-c2:checked ~ #gplab2, 
#gptab-c3:checked ~ #gplab3{
	background-color: CORNFLOWERBLUE;
	border: solid 0px gainsboro;
	border-radius: 25px 25px 0 0;
	color: white;
	font-size:16px;
	font-family: 'Segoe UI Light', 'Open Sans', Verdana, Arial, Helvetica, sans-serif;
}
.gpcontent{
	clear:left;
	background-color: white;
	border: solid 1px gainsboro;
	border-radius: 0 0 25px 25px;
	overflow: auto;
	padding: 0px;
	display:none;
}

#gptab-c1:checked ~ #gpdiv-c1,
#gptab-c2:checked ~ #gpdiv-c2,
#gptab-c3:checked ~ #gpdiv-c3{
	display:block;
}
.sm_hover:hover{
	background-color: lime;
}
</style>


<?
if (isset($WEDITAR) and $WEDITAR!=''){
	$cant_col_read=0;
	$MCOL='';$MCOL2='';
	for ($k=0;$k<sizeof($MATRIX);$k++){
		//FILTROS PARA CONSULTA NO MOSTRAR (H, SEP)
		$cant_col_read++;
		if (isset($MATRIX[$k][2])){
			if ($MATRIX[$k][2]!='H' and $MATRIX[$k][2]!='SM' and $MATRIX[$k][2]!='SMCT'){
				if ($MATRIX[$k][2]=="S" or $MATRIX[$k][2]=="SC" or $MATRIX[$k][2]=="CB" or ($MATRIX[$k][2]=='L' and isset($MATRIX[$k][3][0]))){
					$MCOL2.=",".$MATRIX[$k][3][2];
					$MCOL.=",(select ".$MATRIX[$k][1]." from ".$MATRIX[$k][3][0]." where ".$MATRIX[$k][3][1]."=".$MATRIX[$k][3][2].") alias".$k;
				}else if ($MATRIX[$k][2]=="SC2"){
					$MCOL=$MCOL.",".$MATRIX[$k][3][3];
				}else if ($MATRIX[$k][2]=="MD"){
				
				}else{
					$MCOL=$MCOL.",".$MATRIX[$k][1];
				}
			}
		}//
	}
	$MCOL=substr($MCOL,1);
	$str="select ".$TB_KEY.",".$MCOL." ".$MCOL2." from ".$TB_STR." where ".$TB_KEY."='".$EDITAR."'";
	//echo "EDITAR==>".$str."<br><br>";
	$res = sql_query($str,$cxn);
	echo mysqli_error($cxn);
	$row=mysqli_fetch_array($res);
}
if (!isset($QW_FORM)){$QW_FORM='fit-content';}
if (!isset($QH_FORM)){$QH_FORM='fit-content';}
echo "<form id=formEditar action='' onsubmit='event.preventDefault();' style='padding:15px;width:".$QW_FORM.";height:".$QH_FORM."'>";
//echo "<div class=table_editar id=tableEditar style='width:".$QW_FORM.";height:".$QH_FORM.";overflow:hidden;'>";
//echo "<div class=table_editar id=tableEditar>";
$npesta=0;//numero de pestañas
$varstr='';
for ($I=0; $I<sizeof($MATRIX); $I++){
	//TITULOS DE PESTAÑAS
	if (isset($MATRIX[$I][8])){
		$npesta++;
		echo "<input type=radio style='display:none;' id=gptab-c".$npesta." name=gptab-g ";if ($I==0){echo "checked";}echo ">
		<label for=gptab-c".$npesta." id=gplab".$npesta.">".$MATRIX[$I][8]."</label>";
	}
}
$npesta=0;//numero de pestañas
for ($I=0; $I<sizeof($MATRIX); $I++){
	$req='';
	if (isset($MATRIX[$I][2]) and isset($MATRIX[$I][4]) and $MATRIX[$I][2]!='L' and $MATRIX[$I][2]!='H'){
		if ($MATRIX[$I][4]=='*'){$req='required';}
	}
	if (isset(${"wk".$I}) and ${"wk".$I}!=""){
		//NEW VARIABLES ENVIDAS
		$varstr=stripcslashes(trim(${"wk".$I}));
	}else{
		//EDITAR
		if (isset($row[$MATRIX[$I][1]])){
			//CONVERTIR CARACTERES ESPECIALES (') (")  EN CODIGOS HTML PARA LOS INPUT 
			$varstr=str_replace(array("'",'"'),array("&#39","&quot;"),$row[$MATRIX[$I][1]]);
		}
		
	}
	
	//VALORES PREDETARMINADO EN NEW
	if ($wtipo_edicion==2 and isset($MATRIX_PRED[$I])){
		$varstr=$MATRIX_PRED[$I];
	}
		
	//FINAL DE GRUPO, ANTES DE LLEGAR AL ULTIMO CAMPO
	if (isset($MATRIX[$I][6]) and $I>0){
		echo "</table>";
	}

	//FINAL PESTAÑA, ANTES DE LLEGAR AL ULTIMO CAMPO
	if (isset($MATRIX[$I][8]) and $I>0){
		echo "</div>";
		//echo "<script>alert('dd')</script>";
	}
$GRUPO_PESTA="";
//****INICIO DE PESTAÑA****
if (isset($MATRIX[$I][8])){
	$npesta++;
	echo "<div class=gpcontent id=gpdiv-c".$npesta." style='overflow:hidden;'>";
}else if ($I==0){
	//CREAR PESTAÑA 1th CUANDO NO EXISTE
	//$MATRIX[0][8]='-';
	//$npesta++;
	//$GRUPO_PESTA.="<div class=gpcontent id=gpdiv-c".$npesta.">";
}
/*eliminar PESTAÑAS DE FORMULARIOS SENCILLOS*/

//****BARRA TITULO GRANDES GRANDE****
if (isset($MATRIX_TT[$I])){
	$GRUPO_PESTA.="<table class=table_editar_grupo style='".$MATRIX_TT[$I][1].";border:solid 0px pink;'>";
	$GRUPO_PESTA.="<tr><td colspan=2 class=titulo_grupo>".$MATRIX_TT[$I][0]."</td></tr>";
}
//****INICIO DE GRUPO DE CAMPOS****
if (isset($MATRIX[$I][6])){
	$NEW_MD='';
	if ($MATRIX[$I][2]=="MD"){
		$NEW_MD="&nbsp;&nbsp;<img src='img/Gnew.png' style='vertical-align:middle;width:24px;' onclick=FilaAddMD('md_".$I."_tabla','".$I."','wtipo=1&MODULO=".$MODULO."&wfila='+document.getElementById('md_".$I."_cant_fila').value)>";
	}
	$GRUPO_PESTA.="<table class=table_editar_grupo style='".$MATRIX[$I][7].";margin-top:0px;border:solid 0px pink;'>";
	if ($MATRIX[$I][6]!=''){
		$GRUPO_PESTA.="<tr><td colspan=2 class=titulo_grupo>".$MATRIX[$I][6].$NEW_MD."</td></tr>";
	}
}else if (isset($MATRIX[$I][2]) and $MATRIX[$I][2]=="SMCT"){
	$GRUPO_PESTA.="<table class=table_editar_grupo style='clear:both;float:left;width:100%;'><tr><td colspan=2 class=titulo_grupo>Agregar Servicios</td></tr>";
}else if ($I==0){
	//SI NO EXISTE GRUPO NO EXISTEN PERSTAÑAS
	//$FORM_SENCILLO="";
	//CREAR GRUPO 1th CUANDO NO EXISTE
	//$GRUPO_PESTA="";
	$GRUPO_PESTA.="<table class=table_editar_grupo style='border:solid 0px;'>";
}
echo $GRUPO_PESTA;

switch($MATRIX[$I][2]){
case "FILE": 
if ($wtipo_edicion=='2' and $req!=''){
	$req_file='required';
}else{
	$req_file='';
}
//$nameF=str_replace("IDN", "ID".$EDITAR, $MATRIX[$I][1]);
echo "<tr><th>".$MATRIX[$I][0]."<td>";
if ($varstr!=''){
	//if (substr($varstr, 0, 4)=="http"){
		$ruta_foto=$varstr;
	//}else{
	//	$ruta_foto="'fotos/".$MATRIX[$I][3][1]."/".$varstr."'";
	//}
	echo "<img src='".$ruta_foto."' width='150px' ><br>";
}
break;

case "S":
	//$str="select ".$MATRIX[$I][3][1].",".$MATRIX[$I][1]." from ".$MATRIX[$I][3][0];
	$str="select ".$MATRIX[$I][3][1]." from ".$MATRIX[$I][3][0];
	//echo $str."<br><br>";
	$res = $cxn->query($str);
	
	echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>";
	echo "<td><div id=cap_sel".$I.">";

	if ($wtipo_edicion=='2'){//NUEVO REGISTRO
		echo "<select id=wk".$I." style='width:100%;border-style:solid;border-width:0px 0px 1px 0px;border-color:gainsboro;' required>";
		echo "<option value=''>...</option></select>";
	}else{
		while ($com=mysqli_fetch_array($res)){
			if ($row[$MATRIX[$I][3][2]]==$com[0]){
				echo "<p style='margin:5px;'><b>".$row['alias'.$I]."</b></p><input type=hidden id=wk".$I." value='".$com[0]."'>";
			}
		}
	}
	?></div>
	<p style='margin:0px;height:5px;'></p><input placeholder='Buscar...' style='border-style:solid;border-width:1px 1px 0px 0px;border-color:gainsboro;' 
	type=text id=bs_sel<?echo $I?> onkeypress="javascript:if (event.keyCode == 13){nuevoAjaxSelect('Lib/GridSelect.php',event,'<?echo $I;?>','wcar='+this.value);}" value=''>
	&nbsp;<a class=link onclick=nuevoAjaxSelect('Lib/GridSelect.php',event,'<?echo $I;?>','wcar=%');><font color=black>Ver todo</font></a>
	</td></tr><?
break;

case "SC2"://2 SELECT DE 2 NIVELES
	//echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font>";
	echo "<tr>";
	//echo "<td>";
	//TABLA MUNICIPIO
	$foraneo='';
	if (isset($row[$MATRIX[$I][3][3]])){//foraneo
		$foraneo=$row[$MATRIX[$I][3][3]];
		//$str="select id,nombre,departamento_id from ".$MATRIX[$I][3][2]." where id=".$row['municipio_id'];
		$str=str_replace("&&REL&&",$foraneo,$MATRIX[$I][3][1]);
		//echo $str;
		$res = $cxn->query($str);
		$nivel1=mysqli_fetch_array($res);
	}
	//,(select nombre from departamentos where id=departamento_id)
	
	//VALORES NIVEL 1 (DEPTO)
	//$str="select id,nombre from ".$MATRIX[$I][3][0]." order by nombre asc";
	$str=$MATRIX[$I][3][0];
	//echo $str;
	$res = $cxn->query($str);
	echo "<th>Departamento<font color=red>".$MATRIX[$I][4]."</font><td><select id=wkA".$I." style='width:100%;border:solid 1px gainsboro;' required
	onchange=nuevoAjaxSelectN2('Lib/GridSelectN2.php','".$I."','&wcriterio_n2='+this.value,'capselN2');>";
	if ($wtipo_edicion=='2'){//NUEVO REGISTRO
		echo "<option value=''>...</option>";
		while ($com=mysqli_fetch_array($res)){
			echo "<option value='".$com[0]."'>".$com[1]."</option>";
		}
	}else{
		$SEL='';
		while ($com=mysqli_fetch_array($res)){
			if ($nivel1[0]==$com[0]){
				$SEL='selected';
			}
			echo "<option value='".$com[0]."' ".$SEL.">".$com[1]."</option>";
			$SEL='';
		}
	}
	echo "</select>";
	//echo "</div>";
	echo "<tr><th>Municipio<font color=red>".$MATRIX[$I][4]."</font><td><div id=capselN2".$I.">";
	if ($wtipo_edicion=='2'){//NUEVO REGISTRO
		echo "<select id=wk".$I." style='width:100%;border:solid 1px gainsboro;' required>";
		echo "<option value=''>...</option></select>";
	}else{
		$SEL='';
		//$str="select id,nombre,departamento_id from ".$MATRIX[$I][3][2]." where departamento_id=".$nivel1[2]." order by nombre asc";
		$str=str_replace("&&REL&&",$nivel1[0],$MATRIX[$I][3][2]);
		//echo $str;
		$res = $cxn->query($str);
		echo "<select id=wk".$I." style='width:100%;border:solid 1px gainsboro;' required>";
		while ($com=mysqli_fetch_array($res)){
			if ($foraneo==$com[0]){
				$SEL='selected';
				//echo "<BR>".$nivel1[0];
			}			
			echo "<option value='".$com[0]."' ".$SEL.">".$com[1]."</option>";
			$SEL='';
		}
	}
	echo "</select>";
	echo "</div>";
	/*echo "</div>
	<input type=hidden id=wk".$I." value='".$com[0]."'>
	<p style='margin:0px;height:5px;'></p><input placeholder='Buscar...' style='border-style:solid;border-width:1px 1px 0px 0px;border-color:gainsboro;' 
	type=text id=bs_sel<?echo $I?> onkeypress=\"javascript:if (event.keyCode == 13){nuevoAjaxSelect('Lib/GridSelect.php',event,'".$I."','wcar='+this.value);}\" value=''>
	&nbsp;<a class=link onclick=nuevoAjaxSelect('Lib/GridSelect.php',event,'"$I."','wcar=%');><font color=black>Ver todo</font></a>";
	*/
break;

case "SC":
	$SC_ORDER=(isset($MATRIX[$I][3][3])) ? " order by ".$MATRIX[$I][3][3] : "";
	$str="select ".$MATRIX[$I][3][1].", ".$MATRIX[$I][1]." from ".$MATRIX[$I][3][0].$SC_ORDER;
	$m=0;
	$res = $cxn->query($str);
	//echo $str."<br><br>";
	$JAVA='';
	if (isset($JAVA_SELECT[$I])){$JAVA=$JAVA_SELECT[$I];}
	echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>";
	$REQ_SC="";
	if (isset($MATRIX[$I][4]) and $MATRIX[$I][4]=="*"){$REQ_SC="required";}
	echo "<td><select id=wk".$I." ".$REQ_SC." style='width:100%;' ".$JAVA.">";
	//if ( (isset($row[$MATRIX[$I][3][2]]) and $row[$MATRIX[$I][3][2]]==$com[0]) or (isset($GRILLA_PRED[$I]) and $GRILLA_PRED[$I]==$com[0]) ){echo "selected";}
	if ($wtipo_edicion==2){
		if (!isset($GRILLA_PRED[$I])){echo "<option value=''>...</option>";}
		while ($com=mysqli_fetch_array($res)){
			echo "<option value='".$com[0]."' ";
			if (isset($GRILLA_PRED[$I]) and $GRILLA_PRED[$I]==$com[0]){echo "selected";}
			echo ">".$com[1]."</option>";
		}
	}else{
		echo "<option value=''>...</option>";
		while ($com=mysqli_fetch_array($res)){
			echo "<option value='".$com[0]."' ";
			if (isset($row[$MATRIX[$I][3][2]]) and $row[$MATRIX[$I][3][2]]==$com[0]){echo "selected";}
			echo ">".$com[1]."</option>";
		}
	}
	echo "</select></td></tr>";
break;

case "SMCT":///SELECCCION MULTIPLE COTIZACION
//echo $I."AAAAAAAAA<br>";
?>
<tr><td colspan=2 style='width:100%;border:solid 0px pink;'>

<div style='float:left;border:solid 2px skyblue;padding:5px;height:270px;width:33%;'>
<h3 style='float:left;font-weight:bold;font-style:italic;'>SELECCIONA LA CATEGORÍA</h3>
<select class=select_normal style='clear:both;float:left;width:100%;' id=wct_categoria 
onchange="javascript:nuevoAjax('Lib/GridSelectSMCT.php','NOM_PAG=<?echo $NOM_PAG?>&wnum=<?echo $I?>&wcodigo='+this.value+'&wsede='+objId('wk5').value,'capa_sel_smct');">;<?
$str="select Codigo,Nombre from ct_categoria";
//echo $str."<br>";
$res = sql_query($str,$cxn);	
while ($com=mysqli_fetch_array($res)){
	echo "<option value=".$com[0].">".$com[1]."</option>";
}
?></select>
<div id=capa_sel_smct style='border:solid 0px orange;clear:both;float:left;overflow:auto;height:fit-content;width:100%;max-height:200px;'>
<?
//if (isset($WEDITAR)){
	echo "<table id=smct_table_sel style='float:left;border:solid 0px;width:100%;'><tr><td>Nombre<td nowrap>Precio Base";
	$str="select Codigo,Nombre,Precio".$_SESSION['SEDE_COL']." from ct_serv where Categoria=1";
	//echo $str."<br>";
	$res = sql_query($str,$cxn);
	while ($com=mysqli_fetch_array($res)){
		echo "<tr><td style='cursor:pointer;' class=sm_hover onclick=\"javascript:FilaAddSMCT('".$com[0]."','".$com[1]."','".$com[2]."');\">".$com[1]." <td style='text-align:right;'> ".$com[2];
	}
?>
</table>
</div></div>
<!--SERVICIOS AGREGADOS SMCT-->
<div style='float:left;border:solid 2px skyblue;overflow:auto;padding:5px;margin-left:5px;width:65%;height:270px;'>
<h3 style='float:left;font-weight:bold;font-style:italic;'>SERVICIOS AGREGADOS</h3><table id=smct_table class=table_basica width=100%>
<tr><th><th>Nombre<th>Precio<th>Cantidad<th>Descuento<th>Subtotal
<?
$n=0;$descu=0;$trab=1;
if (isset($WEDITAR)){
	$str="select Descu,Trab,Sede from ct_carga where Id=".$EDITAR;
	$res=$cxn->query($str);	
	$cot=mysqli_fetch_array($res);
	$descu=$cot['Descu'];$trab=$cot['Trab'];$sede=$cot['Sede'];

if ($wtipo_edicion==1){
	//$rt=(isset($MATRIX[$I][3][6])) ? $MATRIX[$I][3][6] : "";
	//$str="select Servicio,(select Nombre from ct_serv where Codigo=Servicio),Precio from ct_carga_serv where Cotizacion=".$EDITAR;
	//,(select Precio".$sede." from ct_serv where Codigo=Servicio) Precio
	$str="select Servicio,(select Nombre from ct_serv where Codigo=Servicio) Nom,Precio,Cant,Descu
	from ct_carga_serv where Cotizacion=".$EDITAR;
	//echo $str."<br>";
	//select Servicio ,(select Nombre from ct_serv where Codigo=Servicio) ,(select Precio from ct_serv where Codigo=Servicio) Precio from ct_carga_serv where Cotizacion=604
	$res = $cxn->query($str);
	while ($com=mysqli_fetch_array($res)){
		$n++;
		//<td class=sin_borde><div class=link_edit><i class='fa fa-trash fa-2x' onclick=FilaDeleteSMCT('".$n."',1); id=smct_id".$com[0]." title='Eliminar Registro'></i></div>
		echo "<tr>
		<td><div class=link_edit><img src='img/Gdelete.png' style='width:20px;' onclick=FilaDeleteSMCT('".$n."',1); id=smct_id".$com['Servicio']." title='Eliminar Registro'></div>
		<td>".$com['Nom']."
		<td class=sin_borde>
		<input id=smct_fijo_cod".$n." type=hidden value='".$com['Servicio']."'>
		<input id=smct_fijo_precio".$n." type=hidden value='".$com['Precio']."'>
		<input id=smct_fijo_descu".$n." type=hidden value='".$com['Descu']."'>
		<input id=smct_fijo_cant".$n." type=hidden value='".$com['Cant']."'>
		<input id=smct_fijo_precio_ver".$n." readonly style='border:solid 0px silver;width:80px;text-align:right;' value='".$com['Precio']."'>
		<td style='width:40px;vertical-align:middle;text-align:center;'>".$com['Cant']."
		<td style='width:120px;vertical-align:middle;text-align:left;'>";
		if ($com['Descu']>=0){
			echo "Descuento ".($com['Descu']*100)."%";
		}else{
			echo "Incremento ".(abs($com['Descu']*100))."%";
		}
		echo "<td class=sin_borde><input id=smct_subtotal".$n." readonly style='border:solid 0px silver;width:80px;text-align:right;padding:2px;color:blue;font-weight:bold' value=''>";
	}
}else if ($wtipo_edicion==3){
	//*****COPIAR COTIZACION
	$COT_COPY='';
	//$rt=(isset($MATRIX[$I][3][6])) ? $MATRIX[$I][3][6] : "";
	$str="select Servicio,(select Nombre from ct_serv where Codigo=Servicio)
	,(select Precio".$sede." from ct_serv where Codigo=Servicio) Precio
	from ct_carga_serv where Cotizacion=".$EDITAR;
	//echo $str."<br>";
	$res = $cxn->query($str);
	while ($com=mysqli_fetch_array($res)){
		$COT_COPY.="<script>FilaAddSMCT('".$com[0]."','".$com[1]."','".$com[2]."');</script>";
	}
}
}//WEDITAR
/*
<tr><td>Cantidad:<td><input id=smct_trab OnKeyUp=CalcularSMCT() style='width:100%;border:solid 1px silver;text-align:right;padding:5px;' value="<?echo $trab;?>">
<input id=smct_trab OnKeyUp=CalcularSMCT() type=hidden style='width:100%;border:solid 1px silver;text-align:right;padding:5px;' value="<?echo $trab;?>">
*/
$res = $cxn->query("select CotCantMax from ajuste");
$mc = mysqli_fetch_array($res);
?></table>
<table class=table_basica width=100%>
<tr><td class=sin_borde style='vertical-align:middle;text-align:right;'>Total Estimado:<td align=right style='width:80px;'>
<input id=smct_total readonly style='border:solid 0px silver;width:100%;height:20px;text-align:right;color:blue;font-weight:bold;' value=''>
</table>
<input type=hidden id=smct_cant value=<?echo $n;?>>
<input type=hidden id=smct_cant_max value=<?echo $mc['CotCantMax'];?>>
</div>
<?
/*
<div style='float:left;border:solid 2px skyblue;padding:5px;margin-left:5px;width:25%;height:270px;display:none;'>
<h3 style='float:left;font-weight:bold;font-style:italic;'>CONDICIONES COMERCIALES</h3>
<table class=table_basica style='float:left;clear:both;width:100%;'>
<tr><td colspan=2>
<select id=smct_porc style='width:100%;border:solid 1px silver;' onchange=CalcularSMCT()><?
for ($f=30;$f>=-30;$f--){
	echo "<option value=".($f/100); 
	if ($descu==($f/100)){
		echo " selected";
	}
	if ($f>=0){
		$textof="Descuento ".$f;
	}else{
		$textof="Incremento ".abs($f);
	}
	echo ">".$textof."%</option>";
}
?></select>

<tr><td nowrap style='font-size:11px;'>Valor Unitario de la Propuesta ($):<td><input id=smct_uni readonly style='width:100%;border:solid 1px silver;text-align:right;padding:5px;font-size:12px;font-weight:bold;color:blue;' value='1'>
<tr><td nowrap style='font-size:11px;'>Valor Estimado del Negocio($):<td><input id=smct_esti readonly style='width:100%;border:solid 1px silver;text-align:right;padding:5px;font-size:12px;font-weight:bold;color:blue;' value='1'>
</table>
</div>
*/
?>
<div id=smct_lista></div>
<?
if ($wtipo_edicion==3){
	echo $COT_COPY;
}
?><script>CalcularSMCT();</script><?

//echo "<p style='margin:0px;height:5px;'></p>";<tr><td colspan=2 class=sin_borde>
//ALMACENA [id=sm"+num+"_"+n+"add]: agregadas
//ALMACENA [id=sm"+num+"_"+n+"del]: eliminadas

break;
//*********

case "SM":/*SELECCCION MULTIPLE*/
	//$str="select ".$MATRIX[$I][3][1]." from ".$MATRIX[$I][3][0];
	//echo $str."<br><br>";
	//$res = $cxn->query($str);
	
echo "<tr><th><center>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></center></th>";
?>
<td><input placeholder='Buscar...' type=text id=bs<?echo $I?> onkeypress="javascript:if (event.keyCode == 13){nuevoAjax('Lib/GridSelectSM.php','NOM_PAG=<?echo $NOM_PAG?>&wnum=<?echo $I?>&wcar='+this.value,'ListaSpeed');ListaSpeedUbicarSM(event,'ListaSpeed');}" value=''>
&nbsp;<a class=link onclick="javascript:nuevoAjax('Lib/GridSelectSM.php','NOM_PAG=<?echo $NOM_PAG?>&wnum=<?echo $I?>&wcar=%','ListaSpeed');ListaSpeedUbicarSM(event,'ListaSpeed');"><font color=black>Ver todo</font></a>
<?
echo "</td></tr>";
echo "<tr><td colspan=2 style='width:100%;border:solid 0px pink;'>
<center><div style='padding:0;overflow:auto;height:fit-content;max-height:200px;'><table id=sm_table".$I.">";

//LISTADO MULTIPLE
$n=0;
if (isset($WEDITAR)){
	$str="select ".$MATRIX[$I][3][5].",(select ".$MATRIX[$I][1]." from ".$MATRIX[$I][3][0]." where ".$MATRIX[$I][3][1]."=".$MATRIX[$I][3][5].") from ".$MATRIX[$I][3][3]." where ".$MATRIX[$I][3][4]."=".$EDITAR;
	//echo $str."<br>";
	$res = sql_query($str,$cxn);	
	//echo mysqli_error($cxn)."<br>";
	while ($com=mysqli_fetch_array($res)){
		$n++;
		echo "<tr><td class=sin_borde><div class=link_edit><img src='img/Gdelete.png' style='width:20px;' onclick=FilaDeleteSM('".$I."','".$n."','".$com[0]."',1,this) title='Eliminar Registro' id='sm_id".$com[0]."'></i></div></td>
		<td class=sin_borde>".$com[1]."</td></tr>";
	}
}
echo "</table></div><hr></td></tr>";
echo "<input type=hidden id=sm".$I."cant value=0>";
//echo "<input type=hidden id=wsm".$I."cant value=".$num.">";

?><tr><td colspan=2 class=sin_borde><?
echo "<p style='margin:0px;height:5px;'></p>";
//ALMACENA [id=sm"+num+"_"+n+"add]: agregadas
//ALMACENA [id=sm"+num+"_"+n+"del]: eliminadas
echo "<div id=sm".$I."lista></div>";
echo "</td></tr>";
break;

case "MD":
	//$str="select ".$MATRIX[$I][3][1].", ".$MATRIX[$I][1]." from ".$MATRIX[$I][3][0]." order by ".$MATRIX[$I][3][1]." asc";
	$m=0;
	//$res = $cxn->query($str);	
	//echo $str."<br><br>";
	echo "<tr><center><td class=sin_borde>
	<input id=md_".$I."_matrix_campo type=hidden value=".$I.">
	<input id=md_".$I."_cant_fila type=hidden value=0>
	<input id=md_".$I."_cant_campo type=hidden value='".(sizeof($MATRIX[$I][3])-2)."'>
	<table id=md_".$I."_tabla class=grilla_table111 style='width:100%;'><tr>";
	for ($m=2; $m < sizeof($MATRIX[$I][3]); $m++){
		echo "<th>".$MATRIX[$I][3][$m][0]."</th>";
	}
	echo "<th colspan=2></th>";//opciones editar, eliminar
	$MD_COL='';
	$MD_COL_ID='';
	for ($m=2; $m < sizeof($MATRIX[$I][3]); $m++){
		if ($MATRIX[$I][3][$m][2]=="T" or $MATRIX[$I][3][$m][2]=="LT" or $MATRIX[$I][3][$m][2]=="F" or $MATRIX[$I][3][$m][2]=="L"){
			$MD_COL.=",".$MATRIX[$I][3][$m][1];
		}else if ($MATRIX[$I][3][$m][2]=="SC"){
			//$MD_COL.=",convert( (select ".$MATRIX[$I][3][$m][1]." from ".$MATRIX[$I][3][$m][3][0]." where ".$MATRIX[$I][3][$m][3][1]."=".$MATRIX[$I][3][$m][3][2].") USING utf8)";
			$MD_COL.=",(select ".$MATRIX[$I][3][$m][1]." from ".$MATRIX[$I][3][$m][3][0]." where ".$MATRIX[$I][3][$m][3][1]."=".$MATRIX[$I][3][$m][3][2].")";
			$MD_COL_ID.=",".$MATRIX[$I][3][$m][3][2];
		}
	}
	//$MD_COL=substr($MD_COL,1);
	//$MD_COL_ID=substr($MD_COL_ID,1);
	if (isset($EDITAR)){
		$ORDER='';
		if (isset($ORDER_MD)){$ORDER=$ORDER_MD;}
		$str="select ".$MATRIX[$I][3][1].$MD_COL.$MD_COL_ID." from ".$MATRIX[$I][3][0]." where ".$MATRIX[$I][1]."='".$EDITAR."' ".$ORDER;
		//echo $str."<br>";
		//echo "</tr>";
		$res = $cxn->query($str);
		$f=0;
		while ($com=mysqli_fetch_array($res)){
			$f++;
			echo "<tr>";
			for ($m=2; $m < sizeof($MATRIX[$I][3]); $m++){
				if ($MATRIX[$I][3][$m][2]=="LT"){
					$md_text=utf8_decode(str_replace("\n","<br>",$com[$m-1]));
				}else if ($MATRIX[$I][3][$m][2]=="SC"){
					$md_text=($com[$m-1]);
				}else{
					$md_text=utf8_decode($com[$m-1]);
				}
				if ($MATRIX[$I][3][$m][2]!="L"){
					echo "<td style='padding:3px;border:solid 1px silver;border-radius:0;'><input type=hidden id=md".$I."_".$f."pred value=1>".($md_text)."</td>";
				}else{
					echo "<td style='padding:3px;border:solid 1px silver;border-radius:0;'>".utf8_decode($md_text)."</td>";
				}
			}
			echo "<td width=58px>";
			//if ($OpsEditar==1 and isset($_SESSION['PER'][$MODULO]['U'])){
			$mostrarup=0;$mostrardel=0;
			//echo $MODULO;
			if (isset($_SESSION['PER'][$MODULO]['U'])){
				$mostrarup=1;
			}
			if (isset($_SESSION['PER'][$MODULO]['D'])){
				$mostrardel=1;
			}
			
			if (isset($EVALMD_UP)){eval($EVALMD_UP);}
			if ($mostrarup==1){
				echo "<b class=link_edit><img src='img/Gedit.png' style='width:20px;' onclick=FilaUpdateMD(this,'".$I."','MODULO=".$MODULO."&wmd_".$I."_editar=".$com[0]."&wtipo=2&wfila='+document.getElementById('md_".$I."_cant_fila').value) title='Actualizar Registro'></b>";
			}
			//echo $mostrardel."dda";
			if ($mostrardel==1){
				echo "&nbsp;&nbsp;&nbsp;<b class=link_edit><img src='img/Gdelete.png' style='width:20px;' onclick=FilaDeleteMD(this,'".$I."','".$com[0]."') title='Eliminar Registro'></b>";
			}
			echo "</td></tr>";
		}
	}
	?></table><br>
	<div id=md_<?echo $I."_delete_lista";?>></div>
	<?
	//if ($MATRIX[$I][4]=="*"){
		echo "<input type=hidden id=md".$I."req value='".$MATRIX[$I][4]."'>";
		echo "<input type=hidden id=md".$I."name value='".$MATRIX[$I][0]."'>";
	//}
	/*
	<input type=button onclick=FilaAddMD('md_<?echo $I;?>_tabla','<?echo $I;?>','wtipo=1&MODULO=<?echo $MODULO;?>&wfila='+document.getElementById('md_<?echo $I;?>_cant_fila').value) id=md_nuevo style='font-size:12px;line-height:10px;width:90px;cursor:pointer;' value='Nuevo'>
	*/
break;

case "SL":/*style='width:100%;'*/
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th><td><select id=wk".$I." name=wk".$I." required style='width:100%;'>";
if ($wtipo_edicion==2 or !isset($MATRIX[$I][3][$k])){echo "<option value=''>...</option>";}
for ($k=0; $k<sizeof($MATRIX[$I][3]); $k++){	
	echo "<option value='".$MATRIX[$I][3][$k]."' "; if ($varstr==$MATRIX[$I][3][$k]){echo "selected";} echo ">".$MATRIX[$I][3][$k]."</option>";
}
echo "</select></td></tr>";
break;

case "CB":	
	$str="select ".$MATRIX[$I][3][1].", ".$MATRIX[$I][1]." from ".$MATRIX[$I][3][0]." order by ".$MATRIX[$I][3][1]." asc";
	//echo $str."<br>";
	$CAD='';$m=0;$campos='';
	$res = $cxn->query($str);
	while ($com=mysqli_fetch_row($res)){	
		$CAD[$m]="<tr><td><input type=radio name=wrd".$I." id=wrd".$m."_".$I." class=boton value='".$com[0]."' ";
		if (isset($row[$MATRIX[$I][3][2]])){
			if ($row[$MATRIX[$I][3][2]]==$com[0]){
				$CAD[$m].="checked";
			}
		}
		$CAD[$m].=">&nbsp;".$com[1]."</td><tr>";
		$m++;
	}
	?><input type=hidden id=acum<?echo $I?> value='<?echo $m?>'><?
	
	echo "<fieldset style='width:250px;font-weight:bold;'><legend>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend>";
	echo "<table class=table_min><td style='vertical-align:top;text-align:left;'>";
	for ($IC = 0; $IC < sizeof($CAD); $IC++){
		if ( $cd > (sizeof($CAD)/2) ){
			$cd=0;
			echo "<td style='vertical-align:top;text-align:left;'>";
		}
		echo "<p>".$CAD[$IC]."</p>";
		$cd++;
	}
	?></table></fieldset><?
break;

case "CL":
echo "<fieldset style='width:250px;font-weight:bold;'><legend>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend>";
//echo "<td nowrap class=td valign=top colspan=2><center><h3>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></h3>
//echo "<table style='width:300px';><tr>";
echo "<table class=table_min><tr>";
$m=0;
for ($k=0; $k<sizeof($MATRIX[$I][3]); $k++){
	$m++;
	echo "<td><input type=radio name=wrd".$I." id=wrd".($m)."_".$I." class=boton value='".$MATRIX[$I][3][$k]."' ";
	if ($varstr==$MATRIX[$I][3][$k]){echo "checked";}
	echo ">".$MATRIX[$I][3][$k]."</td>";
}
echo "</tr></table>";
echo "<input type=hidden id=acum".$I." value='".$m."'>";
echo "</fieldset>";
break;

case "H": echo "<input type=hidden name=wk".$I." id=wk$I value='".$MATRIX[$I][2]."'>";break;
case "T":/*TEXTO*/
case "M":/*MONEDA*/
case "D":/*DECIMAL*/
/*echo "<fieldset style='width:250px'><legend>".$MATRIX[$I][0]." (Max ".$MATRIX[$I][3]." Car.)<font color=red>".$MATRIX[$I][4]."</font></legend>
<input style='width:250px' name=wk$I id=wk$I type=text size=30 maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></fieldset>";*/
//echo "<fieldset style='width:250px;font-weight:bold;'><legend>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend>";
//echo "<input style='width:250px' name=wk$I id=wk$I type=text size=30 ".$req." maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></fieldset>";

echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>";
echo "<td><input style='width:100%;text-transform:uppercase;' onblur='javascript:this.value=this.value.toUpperCase();' name=wk$I id=wk$I type=text ".$req." maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></td></tr>";
break;

case "TN":
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
<td><input style='width:100%;' name=wk$I id=wk$I type=text size=30 ".$req." maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></td></tr>";
break;
case "CLAVE":
if (isset($row[$MATRIX[$I][1]]) and $row[$MATRIX[$I][1]]!=''){
	$clave_emp=$row[$MATRIX[$I][1]];
}else{
	$clave_emp=gen_clave(6);
}
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
<td><input name=wk$I id=wk$I type=text size=30 maxlength=6 value='".$clave_emp."' style='width:100%;'></td>";
break;
case "NIT"://^[0-9]+(-?[0-9])?$ => XXXXX-X
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
<td><input style='width:100%;' name=wk$I id=wk$I type=text size=30 ".$req." maxlength='".$MATRIX[$I][3]."' minlength=7 pattern='^[0-9]*[0-9]$' title='El NIT debe ser contener solo numeros minimo 10 digitos, sin código de verificación.' value='".$varstr."'></td></tr>";
break;
case "E":
if ($I==0){
	if (!isset($QW_FORM)){$QW_FORM='fit-content';}
	if (!isset($QH_FORM)){$QH_FORM='fit-content';}
	$TITULOC="Editar Registro (".$MATRIX[0][0].": <?echo \$row[0];?>)";
	echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
	<td nowrap>";
?>
	<script>
function confirma_cod(valor,capa1){
	//alert('ff');
	var capa=document.getElementById(capa1);
	capa.style.visibility='visible';
	
	var ajax=nAjax();
	capa.innerHTML="<center><i class='fa fa-spinner fa-spin fa-2x'></i></center>";
	ajax.open('POST', 'Lib/GridConfirmCod.php', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send('NOM_PAG=<?echo $NOM_PAG?>&wcodigo='+valor);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//alert(ajax.responseText);
			if (ajax.responseText!=''){
				VerFormulario('WEDITAR='+ajax.responseText,1,'Editar Registro (<?echo $MATRIX[0][0];?>: '+valor+')');
capa.innerHTML="<img src='img/ok.png' style='cursor:pointer;height:32px;' onclick=\"VerFormulario('WEDITAR="+ajax.responseText+"',1,'Editar Registro (<?echo $MATRIX[0][0];?>: "+valor+")')\">";
			}else{
				capa.innerHTML="<img src='img/block.png' style='height:32px;'>"; 
				//VerFormulario('WEDITAR='+ajax.responseText,'".$QW_FORM."','".$QH_FORM."',2,'Nuevo Registro');
			}
		}
	}
}
</script><?
echo "<input style='float:left;' id=wk".$I." type=text ".$req." title='Digite solo numeros enteros.' required pattern='^[0-9]*[0-9]$' style='width:65%;'
	size=30 maxlength='".$MATRIX[$I][3]."' value='".$varstr."'
	onkeypress=\"javascript:if (event.keyCode == 13){confirma_cod(document.getElementById('wk".$I."').value,'capa_confirm');}\">
	<img src='img/lupa.png' style='margin:0 0 0 5px;float:left;vertical-align:center;cursor:pointer;height:30px;border:solid 0px black;' onclick=\"confirma_cod(document.getElementById('wk".$I."').value,'capa_confirm');\">
	<div id=capa_confirm style='float:right;'></div>
	</td></tr>";
}else{
	echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
	<td><input id=wk$I type=text ".$req." title='Digite solo numeros enteros.' pattern='^[0-9]*[0-9]$' style='width:100%;'
	size=30 maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></td></tr>";
}
break;

case "DC": echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
<td><input name=wk$I id=wk$I type=text ".$req." title='Digite solo numeros enteros, puede incluir (-) para separar. Ej: XXXX-XXXX.' pattern='([0-9]|[0-9]{1,}[-]*[0-9]+)'
size=30 maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></td></tr>";
break;
case "L":
// echo "<tr>";
if (isset($MATRIX[$I][5]) and $MATRIX[$I][5]=='S'){
	echo "<tr><th>".$MATRIX[$I][0]."<td>".$varstr."</tr>";
}
//if ($wtipo_edicion==2 or $wtipo_edicion==3){
	//echo "<th>".$MATRIX[$I][0]."</th><td><input readonly value='(Autonúmerico)'></td>";
//}else{
	//echo "<th>".$MATRIX[$I][0]." (Sólo lectura)</th><td style='padding:5px;'>".$varstr."</td>";
	//echo "<th colspan=2>".$MATRIX[$I][0].": ".$varstr."</th>";
//}
break;
case "C":/*EMAIL*/ echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th>
<td><input style='width:100%;' name=wk$I id=wk$I type=text ".$req." title='Digita una dirección de correo válida. (Minúsculas).'
pattern='^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$' size=30 maxlength='".$MATRIX[$I][3]."' value='".$varstr."'></td></tr>";
break;
case "LT": echo "<tr><th colspan=2>".$MATRIX[$I][0]." (Max ".$MATRIX[$I][3]." Car.)<font color=red>".$MATRIX[$I][4]."</font><br>
<textarea onblur='javascript:this.value=this.value.toUpperCase();' style='text-transform:uppercase;width:100%;height:50px;' id=wk$I cols=40 rows=10>".$varstr."</textarea></th></tr>";
break;
case "LTN": echo "<tr><th colspan=2>".$MATRIX[$I][0]." (Max ".$MATRIX[$I][3]." Car.)<font color=red>".$MATRIX[$I][4]."</font><br>
<textarea style='width:100%;height:50px;' id=wk$I cols=40 rows=10>".$varstr."</textarea></th></tr>";
break;
case "RGB": echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font><br>
<td><input style='width:100%;' name=wk$I id=wk$I ".$req." type=color value='".$varstr."'></td></tr>";
break;

case "FP"://FECHA ENTRE HOY HACIA ATRAS (X) DIAS (PASADO)
$fecha = date('Y-m-d');
$nuevafecha = strtotime ('-'.$MATRIX[$I][3].' day',strtotime($fecha)) ;
$nuevafecha = date('Y-m-d', $nuevafecha);
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend></th>
<td><input style='width:250px' name=wk$I id=wk$I size=7 ".$req." min='".$nuevafecha."' max='".date("Y-m-d")."' type=date value='".$varstr."'></td></tr>";
break;

case "FB"://FECHA ENTRE EL PASADO Y HOY 
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend></th>
<td><input style='width:100%;' name=wk$I id=wk$I size=7 ".$req." max='".date("Y-m-d")."' type=date value='".$varstr."'></td></tr>";
break;

case "FA": echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></th><td>
<input name=wk$I id=wk$I maxlength='".$MATRIX[$I][2]."' readonly type=date value='".date("Y-m-d H:i:s")."'>
</fieldset>";break;

case "F": case "FF":
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend></th>";
if (isset($wcot_fecha)){
	$varstr=$wcot_fecha;
}
echo "<td nowrap><input style='width:100%' name=wk$I id=wk$I size=7 ".$req." type=date value='".$varstr."'></td></tr>";
break;
case "AGE":
/*echo "<fieldset style='width:250px'><legend>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend>
<input style='width:250px' name=wk$I id=wk$I maxlength='".$MATRIX[$I][2]."' size=7 type=text value='$varstr' onclick=\"showCalendarControl(this);\">
<br><input type=button class=botonfecha>
</fieldset>";*/
echo "<tr><th>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></legend></th>
<td nowrap><input style='width:50%' name=wk$I id=wk$I size=7 ".$req." max=".date("Y-m-d H:i:s")." type=date value='".$varstr."' 
onchange=calcularEdad(this.value,'wkedad".$I."')><input id=wkedad".$I." style='width:50%' readonly value=''>
<script>calcularEdad(document.getElementById('wk".$I."').value,'wkedad".$I."');</script>
</td></tr>";
break;

case "IM": echo "<th><p class=titulo2>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font><br><b>Actual: ".$varstr."<br>
<b>Nuevo:</b><input name=wk$I id=wk$I type=file size=10 value=''></td>";
break;
case "FI": echo "<th><p class=titulo2>".$MATRIX[$I][0]."<font color=red>".$MATRIX[$I][4]."</font></p></td><td class=table>
<input name=wk".$I." id=wk$I type=file size=10 value='$varstr'></td>";
break;

	}//tipo dato
	
	//CIERRA EL GRUPO FINAL
	if ( $I == (sizeof($MATRIX)-1) ){
		echo "</table>";//cerrar div grupo
		if (isset($MATRIX[0][8])){
			echo "</div>";//cerrar div pestaña
		}
	}
	$varstr='';
}//for

if ($wtipo_edicion==3){//EDICION COPIAR
	unset($WEDITAR);
}
//ECHO "SSS<br>";
if (isset($WEDITAR)){
	//$FUNC="AjaxGuardar('Lib/GridEditarSave.php','NOM_PAG=".$NOM_PAG."&WGUARDAR=U&WEDITAR=".$WEDITAR."','EdicionDataSave');";	
	$var1='Guardar Cambios';//$bt="onClick=".$FUNC;
	$VARS="wtipo_edicion=".$wtipo_edicion."&WGUARDAR=".$TIPO."&WEDITAR=".$WEDITAR;
}else{
	//$FUNC="GuardarForm('NOM_PAG=".$NOM_PAG."&WGUARDAR=C&WEDITAR=".$WEDITAR."')";
	//$FUNC="AjaxGuardar('Lib/GridEditarSave.php','NOM_PAG=".$NOM_PAG."&WGUARDAR=C','EdicionDataSave');";
	$var1='Crear Registro';//$bt="onClick=".$FUNC;
	$VARS="wtipo_edicion=".$wtipo_edicion."&WGUARDAR=".$TIPO;
}
echo "<input type=hidden id=btnNombre value='".$var1."'>";
/*<br><input type=button <?echo $bt;?> id=btnSave class=boton value='<?echo $var1;?>'>*/
if (!isset($JAVASCRIPT)){$JAVASCRIPT='';}
//if (!isset($WEDITAR)){$WEDITAR='';}

//echo "</div>";//<!--  FINAL DE DIV table_editar-->
?>
<div style='clear:left;' id=EdicionDataSave></div>
<!--<p style='margin:0px;height:5px;'></p>-->
<div style='clear:left;'>
<input type=button id=btnSave class=boton onclick="submitGuardar('Lib/GridEditarSave.php','<?echo $VARS;?>','EdicionDataSave');" value='<?echo $var1;?>'>
</div>

<script>

<? if (isset($JAVA_FORM_EDITAR)){echo $JAVA_FORM_EDITAR;} ?>
//document.getElementById('EdicionData').style.width = '<?echo $QW_FORM;?>';
//document.getElementById('EdicionData').style.height = '<?echo $QH_FORM;?>';
</script>

</form>
<?
mysqli_close($cxn);
//}//sesd