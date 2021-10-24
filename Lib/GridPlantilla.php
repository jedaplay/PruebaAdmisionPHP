<?php
include("../funciones.php");
$MODULO=1;
//echo "<br>MODULO: ".$MODULO." :: Priv: ".$_SESSION['PER'][$MODULO]['C'];
//MODULO ABIERTO ACTUAL
//$_SESSION['ACT_PROCESO']=$wproceso;
/*if (isset($wproceso)){
	$_SESSION['ACT_PROCESO']=$wproceso;
}*/
//******************
//echo $cxn;
//echo $SESION_VASIJA;
//$res = sql_query("select * from hc_preg limit 0,1",$cxn);
//$qwe=mysqli_fetch_array($res);
//echo $qwe[0];
sesion_estado($SESION_VASIJA,$llave);
//$PRIV=moduloPri($MODULO,$cxn,$llave);
//echo "plantilla: ".$MODULO."<br>";
if (!isset($act_param)){
	$CAPA="cuerpo";
	$act_param='';
	$_SESSION['ACT_MODULO']=$MODULO;
	$_SESSION['ACT_PAGINA']="ListPaciente.php";
	//echo "sesion".$_SESSION['ACT_MODULO']."<br>";
}else{
	$CAPA="capa_buscar";
	$act_param='&act_param=1';
}

$TIT_STR="Lista de Pacientes";
$_SESSION['MODULO_TITULO']=$TIT_STR;

include("../ListPaciente.php");

if (isset($wproceso)){
	mysqli_close($cxn);
	exit();
}
/*
if (!isset($wproceso) and isset($_SESSION[$SESION_VASIJA]) and comparar_cadena($_SESSION[$SESION_VASIJA],encriptar(session_id(),$llave,1))==true){
	//$wusuario=encriptar($_SESSION['IDUS_COL'],$llave,2);
	//echo "sdsf";
}else{
	mysqli_close($cxn);
	exit();
	//header('Location: ../index.php');
}*/

// enctype='multipart/form-data'
if (!isset($QANCHO)){$QANCHO='70%';}
if (!isset($QALTO)){$QALTO='61%';}
if (!isset($JAVA_FORM_EDITAR)){$JAVA_FORM_EDITAR='';}
if (!isset($wname_orden)){$wname_orden=0;}
if (!isset($wtipo_orden)){$wtipo_orden=0;}
if (!isset($wregmostrar)){$wregmostrar=10;}

$cant_col_read=sizeof($MATRIX);

?>
<!--FONDO GRIS OPACO-->
	
<div id=BlockAlpha></div>

<!--VENTANA DE EDICION-->
<div id=EdicionDataFull>	
	<div id=EdicionDataText></div>
	<div id=EdicionDataClose onclick=CerrarBlock()>
		<img src='img/close.png'> 
	</div>
	<div id=EdicionData></div>
</div>

<!--VENTANA DE ELIMINAR-->
<div id=EliminarData></div>

<!--VENTANA PROCESO-->
<div id=ProcesoFull>
	<div id=ProcesoText></div>
	<div id=ProcesoClose onclick=CerrarBlock()>
		<img src='img/close.png'> 
	</div>
	<div id=Proceso></div>
</div>

<!--VENTANA LISTA RAPIDO FULL-->
<div id=ListaSpeedFull>
	<div id=ListaSpeedText></div>
	<div id=ListaSpeedClose onclick=CerrarBlockListaSpeed()>
		<img src='img/close.png'> 
	</div>
	<div id=ListaSpeed></div>
</div>

<input type=hidden id=tipo_orden value='<? echo $wtipo_orden?>'>
<input type=hidden id=name_orden value='<? echo $wname_orden?>'>
<input type=hidden id=idcantcampos value='<?php echo $cant_col_read;?>'>
<input type=hidden id=nom_pag value='ListPaciente.php'>
<input type=hidden id=modulo value='<?php echo $MODULO;?>'>
<input type=hidden id=JAVA_FORM_EDITAR value="<?echo $JAVA_FORM_EDITAR;?>">
<div style="width:calc(100% - 5px);height:calc(fit-content - 50px);
overflow:auto;
background-color:white;
margin:0 auto;
padding:0px; 
border: solid 0px black;
">
<table class=grilla_table id=grilla_table width='100%'>
<th colspan='<?echo $cant_col_read+1;?>' nowrap class=titulo>
<?

echo "<div style='float:left;border:solid 0px black;'><h3>";
//echo "<a class=link_excel title='Lista de Procesos' onclick=\"VerFormulario('NOM_PAG=GridProcesos.php&wmodulo=".$MODULO."&wnum=5','50%','40%',5);\"><img src='img/excel.png'></a>";
//echo "&nbsp;&nbsp;&nbsp;<a class=link_excel title='Crear registros aleatorios' href='Lib/GridRegAzar.php?NOM_PAG=".$NOM_PAG."' target=nuevo_azar><i class='fa fa-cubes fa-lg'></i></a>";
//echo "&nbsp;&nbsp;&nbsp;<a class=link_excel title='Ver los lugares en Google Maps' onclick=GridReadVars(this,'Lib/GridMapaMarket.php?') target=nuevo_mapa><i class='fa fa-map-marker fa-lg'></i></a>";
//echo "&nbsp;&nbsp;&nbsp;<a onclick=\"ajaxFrame('Lib/GridMapaMarket.php');\" class=link_excel><i class='fa fa-map-marker fa-lg'></i></a>";
echo "<a onclick=CargarGrid('Lib/GridPlantilla.php','MODULO=".$MODULO.$act_param."','".$CAPA."');><img src='img/hist2.png' style='vertical-align:middle;width:50px;height:50px;'>&nbsp;&nbsp;&nbsp;".$TIT_STR."</a>";//TITULO
if ($OpsAgregar==1){
	$TITULO="Nuevo Registro";
	echo "&nbsp;&nbsp;<a title='Agregar nuevo registro.' onclick=\"VerFormulario('',2,'".$TITULO."');\"><img src='img/Gnew.png' style='vertical-align:middle;width:24px;height:24px;' title='Agregar Registro'></a>";
}
if (isset($OpsExcel) and $OpsExcel==1){
	$TITULO="Exportar a Excel";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a title='".$TITULO."' onclick=\"VerFormulario('',4,'".$TITULO."');\"><img src='img/excel.png' style='vertical-align:middle;width:32px;'></a>";
}
//if ($OpsEditar==1 and isset($_SESSION['PER'][$MODULO]['U'])){
if (isset($OpsImportar) and $OpsImportar==1){
	$TITULO="Importar Registros";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a title='".$TITULO."' onclick=\"VerFormulario('',7,'".$TITULO."');\"><i class='fa fa-arrow-down fa-lg'></i></a>";
}
if (isset($codigophpB)){
	eval($codigophpB);
}
echo "</h3></div>";
echo "&nbsp;&nbsp;&nbsp;<div style='float:left;font-size:16px;color:black;height:100%;line-height:55px;vertical-align:center;border:solid 0px black;' id=LoadingRead><i class='fa fa-spinner fa-spin fa-2x'></i>   Cargando datos...</div>";
?>
</th>
<tr><th style='font-size:20px;width:50px;' >
<select id=idregmostrar onchange="GridReadPaginador()" title='Cantidad de registros para mostrar.'>
<? $REGM=array(10,25,50,150,250,5000);
for ($k=0;$k<sizeof($REGM);$k++){
echo "<option value=".$REGM[$k];
if ($REGM[$k]==$wregmostrar){echo ' selected';}
echo ">".$REGM[$k]."</option>";
}
/*
<option value=10 <?if ($wregmostrar==10){echo 'selected';}?> >10</option>
<option value=25 <?if ($wregmostrar==25){echo 'selected';}?>>25</option>
<option value=50 <?if ($wregmostrar==50){echo 'selected';}?>>50</option>
<option value=150 <?if ($wregmostrar==150){echo 'selected';}?>>150</option>
<option value=250 <?if ($wregmostrar==250){echo 'selected';}?>>250</option>
<option value=550 <?if ($wregmostrar==550){echo 'selected';}?>>550</option>
<option value=2500 <?if ($wregmostrar==2500){echo 'selected';}?>>2500</option>
*/
?></select></th><?
/*
<!--EXCEL-->
&nbsp;&nbsp;&nbsp;&nbsp;<b class=link onclick="VerFormulario('<?echo $NOM_PAG?>','wcriteriok=<?echo $wcriteriok."&".$datos?>&WEVENTO=I','EXPORTAR A EXCEL')"><img title='Exportar a Excel' src='Lib/img/informe.gif'></b><?
?>
*/
$IMPCAMPOS="";
for ($I=0; $I<sizeof($MATRIX); $I++){
$NORMAL="<a onclick=OrdenarForm('".$I."')><div style='float:left;' id=img_orden".$I."></div>".$MATRIX[$I][0]."</a>
<a onclick=\"OcultarFiltro('".$I."');objId('cell_edit_act').value=0;\"><img src='img/Gfilter.png' style='vertical-align:middle;width:18px;height:18px;' title='Filtrar por esta columna.'></a>
<br><div id=filtro".$I." class=FiltroFind><select id=filtro_opc".$I." style='width:120px;'>
<option value='0'>Contiene</option><option value='1'>Empieza por</option>
<option value='2'>Esta Vacio</option><option value='3'>(<>)Diferente</option>
<option value='4'>(>=)Mayor igual</option><option value='5'>(<=)Menor igual</option>
<option value='6'>(>)Mayor que</option><option value='7'>(<)Menor que</option>
</select><br><input style='width:120px;' type=text id=filtro_text".$I." value='' size=15 onclick=\"objId('cell_edit_act').value=0;\" OnKeyPress=\"if (event.keyCode == 13){GridReadPaginador();}\"></div>";

if (isset($MATRIX[$I][2])){
	
	if ($MATRIX[$I][2]=='SC'){
		echo "<th nowrap><a onclick=OrdenarForm('".$I."')><div style='float:left;' id=img_orden".$I."></div>".$MATRIX[$I][0]."</a>	
		<a onclick=OcultarFiltro('".$I."');><img src='img/Gfilter.png' style='vertical-align:middle;width:18px;height:18px;' title='Filtrar por esta columna.'></a>
		<br><div id=filtro".$I." class=FiltroFind>";
		$str="select ".$MATRIX[$I][3][1].", ".$MATRIX[$I][1]." from ".$MATRIX[$I][3][0]." order by ".$MATRIX[$I][3][1]." asc";
		//$m=0;
		$res = $cxn->query($str);
		//echo $str."<br><br>";
		echo "<select id=filtro_sel".$I." style='width:200px;' onchange=\"TipoBuscarSC(this,'".$I."')\">";
		echo "<option value='%'>(Todos)</option>";
		echo "<option value=''>(Vacíos)</option>";
		echo "<option value='c1'>(Contiene...)</option>";
		echo "<option value='e1'>(Empiesa por...)</option>";
		while ($com=mysqli_fetch_array($res)){
			echo "<option value='".$com[0]."'>".$com[1]."</option>";
		}
		echo "</select>
		<br><input style='width:120px;visibility:hidden' type=text id=filtro_sel_text".$I." value='' size=15 OnKeyPress=\"if (event.keyCode == 13){GridReadPaginador();}\">
		</div>";		
	//}else if ($MATRIX[$I][2]=='MD'){
	//	echo $NORMAL;
	}else if ($MATRIX[$I][2]=='TT'){
	
	}else{
		echo "<th nowrap>".$NORMAL;
	}
}else{
	//SIN TIPO
	echo "<th nowrap>".$NORMAL;
}

}//for
?>
<tbody id=CapaConsultar></tbody>
</table>
<input type=hidden id=cell_edit_col value=0>
<input type=hidden id=cell_edit_col_id value=0>
<input type=hidden id=cell_edit_act value=0>
<div id=capa_cell_save style='width:700px;font-size:10px;color:navy;'></div>
<div id=CapaPaginador style="width:calc(100% - 5px);"></div>
</div>

</body></html>
<?php
mysqli_close($cxn);