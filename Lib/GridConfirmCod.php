<?php
include("../funciones.php");

include("../".$NOM_PAG);
//echo $wcodigo."<br>";
//echo $NOM_PAG."<br>";
//BUSCAR REPETIDO EN GRILLA (MODO EDITAR)
if ($_SESSION['ACCESO_SESION']==1){
	$str="select ".$TB_KEY." from ".$TB_STR." where ".$TB_KEY."='".$wcodigo."'";
	//echo $str;
	$res = $cxn->query($str);
	if ($com=mysqli_fetch_row($res)){	
		echo encriptar($wcodigo,$llave,1);
	}else{
		echo "";
	}	
}
mysqli_close($cxn);
