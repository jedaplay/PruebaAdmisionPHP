<?
include("../funciones.php");
include("../".$NOM_PAG);
if (!isset($wproceso) and isset($_SESSION[$SESION_VASIJA]) and comparar_cadena($_SESSION[$SESION_VASIJA],encriptar(session_id(),$llave,1))==true){
	//$wusuario=encriptar($_SESSION['IDUS_COL'],$llave,2);
	//echo "sdsf";
}else{
	mysqli_close($cxn);
	exit();
	//header('Location: ../index.php');
}

if (!isset($wnumpantalla)){$wnumpantalla=1;}
if (!isset($wregmostrar)){$wregmostrar=10;}
$MCOL='';//$MCOL2='';
$campo='';
$IMPCAMPOS="";
//$OpcCellEdit=1;

//NO REPETIR LLAVE
$m=0;$mc=0;
if ($TB_KEY!=$MATRIX[0][1]){
	//$KEYC=$TB_KEY.",";
	$mc=1;
}
for ($k=0;$k<sizeof($MATRIX);$k++){
	$cad='';
	if (isset($MATRIX[$k][2])){
		if ($MATRIX[$k][2]=="S" or $MATRIX[$k][2]=="SC" or $MATRIX[$k][2]=="CB" or (isset($MATRIX[$k][3][0]) and isset($MATRIX[$k][3][1]) and isset($MATRIX[$k][3][2]) and $MATRIX[$k][2]=='L')){
			//$MCOL2=$MCOL2.",".$MATRIX[$k][3][1];
			$MCOL.=",(select ".$MATRIX[$k][1]." from ".$MATRIX[$k][3][0]." where ".$MATRIX[$k][3][1]."=".$MATRIX[$k][3][2].") alias".$k;
			
			//se enviar ordenar por un campo compuesta
			if ($wname_orden==$k){
				$wname_orden="alias".$k;
			}
		}else if ($MATRIX[$k][2]=="SC2"){
			$MCOL.=",".$MATRIX[$k][1]." alias".$k;
			//$MCOL.=",(municipio_id) alias".$k;
			if ($wname_orden==($k)){
				$wname_orden="alias".$k;
			}
		}else if ($MATRIX[$k][2]=="SM"){
			$MCOL.=",(select count(*) from ".$MATRIX[$k][3][3]." where ".$TB_STR.".".$TB_KEY."=".$MATRIX[$k][3][4].") alias".$k;
			if ($wname_orden==($k)){
				$wname_orden="alias".$k;
			}
		}else if ($MATRIX[$k][2]=="SMCT"){
			$MCOL.=",(select count(*) from ct_carga_serv where ".$TB_STR.".".$TB_KEY."=Cotizacion) alias".$k;
			if ($wname_orden==($k)){
				$wname_orden="alias".$k;
			}
		}else if ($MATRIX[$k][2]=="MD"){
			$MCOL.=",(select count(*) from ".$MATRIX[$k][3][0]." where ".$TB_STR.".".$TB_KEY."=".$MATRIX[$k][1].") alias".$k;
			if ($wname_orden==($k)){
				$wname_orden="alias".$k;
			}
		}else{
			//se enviar ordenar por un campo normal
			if ($TB_KEY!=$MATRIX[$k][1]){
				$MCOL.=",".$MATRIX[$k][1];
			}
			if ($wname_orden==($k)){
				$wname_orden=$MATRIX[$k][1];
			}
		}
		
		$m=$k+$mc;
		if ($MATRIX[$k][2]=='LT'){
			//$cad="\$row[".$m."]=nl2br(\$row[".$m."]);";
			//substr($str, 0, $length);
			$IMPCAMPOS.=";?><td nowrap valign=top><?echo substr(\$row[".($m)."],0,10).'...';?>&nbsp;<?";
			/*
			$IMPCAMPOS.="$cad;?><td nowrap class=td valign=top><textarea cols=70 rows=10 disabled><?echo \$row[".($m)."];?></textarea><?";
			*/
		}else if ($MATRIX[$k][2]=='RGB'){
			$IMPCAMPOS.=";?><td nowrap valign=top><div style='width:50px;background-color:<?echo \$row[".($m)."];?>;'>&nbsp;</div><?";
				
		}else if ($MATRIX[$k][2]=='M'){//moneda
			//number_format($number, 2, ',', ' ');
			$IMPCAMPOS.=";?><td nowrap valign=top><?echo '$ '.number_format(\$row[".($m)."], 0 , ',' , '.');?>.oo<?";
		}else	if ($MATRIX[$k][2]=='FILE'){//moneda
			$IMPCAMPOS.=";
			\$image='';
			if (\$row[".($m)."]){
				if (substr(\$row[".($m)."], 0, 2)=='fo'){
					\$ruta_foto='fotos/".$MATRIX[$k][3][1]."/\".\$row[".($m)."].\"';
				}else{
					\$ruta_foto=\$row[".($m)."];
				}
				\$image=\"<a href='\$ruta_foto' target=_blank>".$MATRIX[$k][3][2]."</a>\";
			}
			echo \"<td nowrap valign=top><center>\$image\";";
		}else if ($MATRIX[$k][2]=='MD'){//MAESTRO DETALLE
			$IMPCAMPOS.=";?><td nowrap valign=top><?echo \$row[".($m)."];?><?";
		}else{
			$IMPCAMPOS.=";?><td nowrap valign=top><?echo \$row[".($m)."];?><?";
		}		
	}else{
		//SI NO EXITE TIPO DEFAULT T		
		//echo $TB_KEY." ".$MATRIX[$k][1]."<br>";
		if ($TB_KEY!=$MATRIX[$k][1]){
			$MCOL.=",".$MATRIX[$k][1];
		}
		if ($wname_orden==($k)){
			$wname_orden=$MATRIX[$k][1];
		}
		$IMPCAMPOS.=";?><td nowrap valign=top><?echo \$row[".($k)."];?><?";
	}
	
	if (isset(${"wfiltro_sel".$k})){
		//CONSULTAR SELECT (CONTIENE, EMPIESA)
		if (isset(${"wfiltro_sel_text".$k})){
			if ($MATRIX[$k][2]=="SC" or ($MATRIX[$k][2]=='L' and isset($MATRIX[$k][3][0]))){
				$comparar="(select ".$MATRIX[$k][1]." from ".$MATRIX[$k][3][0]." where ".$MATRIX[$k][3][1]."=".$MATRIX[$k][3][2].")";
			}else{
				$comparar=$MATRIX[$k][1];
			}
			switch (${"wfiltro_sel".$k}){
				case "c1": $campo.=" and ".$comparar." like '%".${"wfiltro_sel_text".$k}."%' ";break;
				case "e1": $campo.=" and ".$comparar." like '".${"wfiltro_sel_text".$k}."%' ";break;
			}
		}else{
			if ($MATRIX[$k][2]=="SC" or $MATRIX[$k][2]=="CB" or ($MATRIX[$k][2]=='L' and isset($MATRIX[$k][3][0]))){
				if (${"wfiltro_sel".$k}==''){
					$campo.=" and (".$MATRIX[$k][3][2]."='' or ".$MATRIX[$k][3][2]." is null)";
				}else{
					if (${"wfiltro_sel".$k}!='%'){
						$campo.=" and ".$MATRIX[$k][3][2]."='".${"wfiltro_sel".$k}."'";
					}
				}
			}else if ($MATRIX[$k][2]=="SL" or $MATRIX[$k][2]=="CL"){
				if (${"wfiltro_sel".$k}==''){
					$campo.=" and (".$MATRIX[$k][1]."='' or ".$MATRIX[$k][1]." is null)";
				}else{
					if (${"wfiltro_sel".$k}!='%'){
						$campo.=" and ".$MATRIX[$k][1]."='".${"wfiltro_sel".$k}."'";
					}
				}
			}
		}
	}
	if (isset(${"wfiltro_text".$k})){
		if (isset($MATRIX[$k][2])){
			if ($MATRIX[$k][2]=="S"){	
				$comparar="(select ".$MATRIX[$k][1]." from ".$MATRIX[$k][3][0]." where ".$MATRIX[$k][3][1]."=".$MATRIX[$k][3][2].")";
			}else if ($MATRIX[$k][2]=="SM"){
				$comparar="(select count(*) from ".$MATRIX[$k][3][3]." where ".$TB_KEY."=".$MATRIX[$k][3][4].")" ;
			}else if ($MATRIX[$k][2]=="SMCT"){
				$comparar="(select count(*) from ct_carga_serv where Cotizacion=".$TB_STR.".".$TB_KEY.")";
			}else if ($MATRIX[$k][2]=="MD"){
				$comparar="(select count(*) from ".$MATRIX[$k][3][0]." where ".$MATRIX[$k][1]."=".$TB_STR.".".$TB_KEY.")" ;
			}else{
				$comparar=$MATRIX[$k][1];
			}
		}else{			
			$comparar=$MATRIX[$k][1];
		}
		switch (${"wfiltro_opc".$k}){
			case "0": $campo.=" and ".$comparar." like '%".addSlashes(${"wfiltro_text".$k})."%' ";break;
			case "1": $campo.=" and ".$comparar." like '".addSlashes(${"wfiltro_text".$k})."%' ";break;
			case "2": $campo.=" and (".$comparar." = '' or  ".$comparar." is null) ";break;
			case "3": $campo.=" and ".$comparar." != '".${"wfiltro_text".$k}."%' ";break;
			case "4": $campo.=" and ".$comparar." >= ".${"wfiltro_text".$k}." ";break;
			case "5": $campo.=" and ".$comparar." <= ".${"wfiltro_text".$k}." ";break;
			case "6": $campo.=" and ".$comparar." > ".${"wfiltro_text".$k}." ";break;
			case "7": $campo.=" and ".$comparar." < ".${"wfiltro_text".$k}." ";break;
		}
	}
}
//$MCOL=substr($MCOL,1);

//$orden="order by ".$MATRIX[$wname_orden][1]." asc";
switch ($wtipo_orden){
	case "1": $orden="order by ".$wname_orden." asc";break;
	case "2": $orden="order by ".$wname_orden." desc";break;
	case "0": $orden="order by ".$TB_KEY." asc";break;
}

//CAMPOS DE COTIZACION PARA SOLO EDITAR EL USUARIO
if (isset($MCOL_EXTRA)){
	$MCOL.=$MCOL_EXTRA;	
}
//echo "A:".$MCOL;
$rinicio=($wnumpantalla*$wregmostrar)-$wregmostrar;
$my_consulta=utf8_decode("select $TB_KEY $MCOL from $TB_STR where 1=1 $REL_STR $campo $orden limit $rinicio,$wregmostrar");
if (isset($SHOW_QUERY_READ) and $SHOW_QUERY_READ==1){
	echo "<tr><td colspan=15>".$my_consulta."</tr>";
}
//$result = $cxn->query($my_consulta);
$result = sql_query($my_consulta,$cxn);
echo mysqli_error($cxn);

$EDIT='';$DEL='';
if ($OpsEditar==1){
	$TITULO="Editar Registro (".$MATRIX[0][0].": <?echo \$row[0];?>)";
	$EDIT="?><b class=link_edit onclick=\"VerFormulario('WEDITAR=<?echo encriptar(\$row[0],\$llave,1);?>',1,'".$TITULO."')\"><img src='img/Gedit.png' style='vertical-align:middle;width:24px;height:24px;' title='Modificar Registro'></b>&nbsp;&nbsp;<?";
}
if ((isset($OpsCopiar) and $OpsCopiar==1) or (!isset($OpsCopiar) and $OpsAgregar==1)){
	$TITULO="Copiar Registro (".$MATRIX[0][0].": <?echo \$row[0];?>)";
	$EDIT.="?><b class=link_edit onclick=\"VerFormulario('WEDITAR=<?echo encriptar(\$row[0],\$llave,1);?>',3,'".$TITULO."')\"><img src='img/Gcopy.png' style='vertical-align:middle;width:24px;height:24px;' title='Copiar Registro (Se crea un nuevo registro con los datos de este registro.)'></b>&nbsp;&nbsp;<?";
}
if ($OpsEliminar==1){	
	$DEL="?><b class=link_edit onclick=\"VerFormulario('WELIMINAR=<?echo encriptar(\$row[0],\$llave,1);?>',6,'Eliminar Registro')\"><img src='img/Gdelete.png' style='vertical-align:middle;width:24px;height:24px;' title='Eliminar Registro'></b>&nbsp;&nbsp;<? ";
}
$wreg=0;
//$ESTILO=array("row2","row1");
$numero=0;
$cell_edit_sw=1;
//echo $codigophpA;
while($row=mysqli_fetch_array($result)){
	$wreg++;//=$row[0];
	$numero=1-$numero;
	?><tr><td valign=top nowrap><?
	if (isset($EDIT)){eval($EDIT);}
	if (isset($DEL)){eval($DEL);}
	if (isset($codigophpA)){eval($codigophpA);}
	//$AAA='';
	eval($IMPCAMPOS);
	?></tr><?
	/*if ($wreg=='02..'){
	?><tr><td colspan=6 id=tablechild<?echo $wreg?>><center><table class=table width=800px><tr><td></tr></table></tr><?
	}*/
}
	
//mysql_close();
if ($wreg==0){
	?><tr><td colspan=14 nowrap class=td><center>No se encontraron registros</tr><?
}

mysqli_close($cxn);