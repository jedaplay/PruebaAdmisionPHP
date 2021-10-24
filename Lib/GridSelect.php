<?php
include("../funciones.php");
include("../".$NOM_PAG);

if ($_SESSION['ACCESO_SESION']==1){

?><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?
//<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
//<link href='../estilo.css' rel="stylesheet" type="text/css">
//<i class='fa fa-trash fa-2x'></i>
/*
<table class=grilla_table_min2>
<tr><td>afadfds></td></tr>
<tr><td>jfhfhi></td></tr>
<tr><td>mnhdgfj></td></tr>
</table>
*/
$str="select ".$MATRIX[$wnum][3][1].", ".$MATRIX[$wnum][1]." from ".$MATRIX[$wnum][3][0]." where ".$MATRIX[$wnum][1]." Like '%".$wcar."%' limit 0,20";
//echo "<br>".$str."<br>";
$con = sql_query($str,$cxn);
?>
<table class=grilla_table id=table_editar_select style='width:590px;' ><?
$n=0;
while($fila=mysqli_fetch_row($con)){
	$n++;	
	$contenido=str_replace(" :: ","</td><td>",$fila[1]);
	$contenido=$fila[1];
	$sel="<p style='border:solid 0px black;margin:5px;word-wrap: break-word;'><b>".$fila[1]."</b></p><input type=hidden id=wk".$wnum." value='".$fila[0]."'>";	
	//$sel="<p><b>".$fila[1]."</b></p><input type=hidden id=wk".$wnum." value=".$fila[0].">";	
	//echo "<tr style='cursor:pointer;' onclick=\"FilaSetSelect('".addslashes($sel)."','".$wnum."')\"><td nowrap>".($contenido)."</td></tr>";
	?><tr style='cursor:pointer;' onclick="FilaSetSelect('<? echo addslashes($sel);?>','<?echo $wnum;?>')"><td><?echo $contenido;?></td></tr><?
}
?></table><?
if ($n==1){
	echo "<div id=select_unico_reg>".$sel."</div>";
}

mysqli_close($cxn);
}//ses