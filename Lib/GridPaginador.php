<?
include("../funciones.php");
include("../".$NOM_PAG);
if (!isset($wnumpantalla)){$wnumpantalla=1;}
if (!isset($wregmostrar)){$wregmostrar=10;}

$campo='';
for ($k=0;$k<sizeof($MATRIX);$k++){
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
			}
			if ($MATRIX[$k][2]=="SL" or $MATRIX[$k][2]=="CL"){
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
			case "0": $campo.=" and ".$comparar." like '%".${"wfiltro_text".$k}."%' ";break;
			case "1": $campo.=" and ".$comparar." like '".${"wfiltro_text".$k}."%' ";break;
			case "2": $campo.=" and (".$comparar." = '' or  ".$comparar." is null) ";break;
			case "3": $campo.=" and ".$comparar." != '".${"wfiltro_text".$k}."%' ";break;
			case "4": $campo.=" and ".$comparar." >= ".${"wfiltro_text".$k}." ";break;
			case "5": $campo.=" and ".$comparar." <= ".${"wfiltro_text".$k}." ";break;
			case "6": $campo.=" and ".$comparar." > ".${"wfiltro_text".$k}." ";break;
			case "7": $campo.=" and ".$comparar." < ".${"wfiltro_text".$k}." ";break;
		}
	}
}
//***********************************************************************
//PAGINACION
//***********************************************************************
//$reg_consulta="select $TB_KEY from $TB_STR where 1=1 $REL_STR $campo ";
$reg_consulta=utf8_decode("select count($TB_KEY) from $TB_STR where 1=1 $REL_STR $campo ");
//echo $reg_consulta;
$wcantreg=0;
$res = $cxn->query($reg_consulta);
$rowc=mysqli_fetch_row($res);
//$wcantreg++;
$wcantreg = $rowc[0];
$num=$wnumpantalla-1;

//ANCHO PAGINADOR
if (!isset($QANCHO)){$QANCHO='900px';}
//height:20px;
?>
<input type=hidden id=idcantreg value='<?echo $wcantreg;?>'>
<input type=hidden id=idmostrar value='<?echo $wregmostrar;?>'>
<input type=hidden id=idpagAct value='<?echo $wnumpantalla?>'>
<?
$hasta=($wregmostrar*$wnumpantalla);

if ($hasta < $wcantreg){
	//calcular registros faltantes por mostrar
	if ($wregmostrar > ($wcantreg - $hasta)){
		$wregmostrar = $wcantreg - $hasta;
	}
	echo "<b>".$hasta." de ".$wcantreg." Registro(s)&nbsp;</b>
	<a onclick='PaginadorClick()'>Mostrar ".$wregmostrar." más <i class='fa fa-forward fa-lg'></i></a>";
}else{
	$hasta = $wcantreg;
	echo "<b>".$hasta." de ".$wcantreg." Registro(s)&nbsp;</b>";
}

mysqli_close($cxn);
?>