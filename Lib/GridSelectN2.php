<?php
include("../funciones.php");
include("../".$NOM_PAG);

if ($_SESSION['ACCESO_SESION']==1){
?><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><?
//$str="select ".$MATRIX[$wnum][3][1].", ".$MATRIX[$wnum][1]." from ".$MATRIX[$wnum][3][0]." where ".$MATRIX[$wnum][2]."=".$wcriterio_n2;

$str=str_replace("&&REL&&",$wcriterio_n2,$MATRIX[$wnum][3][2]);

//$str="select id,nombre from municipios where departamento_id=".$wcriterio_n2;
//echo "<br>".$str."<br>";
$res= sql_query($str,$cxn);
echo "<select id=wk".$wnum." style='width:100%;border:solid 1px gainsboro;' required>";
$n=0;
while($com=mysqli_fetch_row($res)){
	$n++;
	echo "<option value='".$com[0]."'>".$com[1]."</option>";
}
?></select><?

mysqli_close($cxn);
}//ses