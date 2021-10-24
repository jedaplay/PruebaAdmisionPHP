<?php
include("../funciones.php");
include("../".$NOM_PAG);

function ObtenerIP(){
       $ip = "";
       if(isset($_SERVER)){
           if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
               $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }
	}else{
            if ( getenv( 'HTTP_CLIENT_IP' ) )
            {
                $ip = getenv( 'HTTP_CLIENT_IP' );
            }
            elseif( getenv( 'HTTP_X_FORWARDED_FOR' ) )
            {
                $ip = getenv( 'HTTP_X_FORWARDED_FOR' );
            }
            else
            {
                $ip = getenv( 'REMOTE_ADDR' );
            }
       }  
        // En algunos casos muy raros la ip es devuelta repetida dos veces separada por coma 
       if(strstr($ip,',')){
            $ip = array_shift(explode(',',$ip));
       }
       return $ip;
}

//if ($_SESSION['ACCESO_SESION']==1){
$ELIMINAR=encriptar($WELIMINAR,$llave,2);
if (isset($WELIMINAR_ACT)){

	//AUDITORIA AL BORRAR
	$str="select * from ".$TB_STR." where ".$TB_KEY."='".$ELIMINAR."'";
	//echo $str."<br>";
	$res=$cxn->query($str);
	$row=mysqli_fetch_array($res);
	$n=0;
	$campo='';
	while ($fieldinfo=mysqli_fetch_field($res)){
		//$valor=stripcslashes($row[$n]);
		$valor=addslashes($row[$n]);
		//$valor=str_replace(array("'",'"'), array("\\\'",'\\\"'), $row[$n]);
		$campo.=",".($fieldinfo->name)."=[[".$valor."]]";
		
		$n++;
	}
	$campo=substr($campo,1);
	
	$cxn->query("begin");
	//$ip = $_SERVER['REMOTE_ADDR'];
	$ip = ObtenerIP();
	//$wvariablek=str_replace(",'", "[[", $campo);
	$user=encriptar($_SESSION['IDUS_COL'],$llave,2);
	
	$str="insert into auditoria set Evento='D', Tabla='".$TB_STR."', Usuario='".$user."', IP='".$ip."', Fecha='".date("Y-m-d H:i:s")."', Dato=\"".$campo."\"";
	//echo $str;
	$res=$cxn->query($str);
	
	$str="delete from ".$TB_STR." where ".$TB_KEY."='".$ELIMINAR."'";
	$res=$cxn->query($str);
	echo mysqli_error($cxn);
	/*if ($TB_UP=="proyectos"){
		$mask = "files_proyectos/".$WELIMINAR."*";
		array_map( "unlink", glob( $mask ) );
	}*/
	//unlink("files_proyectos/".$WELIMINARc."*");
	/*
	if (file_exists("mifichero.txt")){
		echo "El fichero existe";
	}else{
		echo "El fichero no existe";
	} */
	$cxn->query("commit");
	if ($res==true){
		echo $ELIMINAR."|true";
		mysqli_close($cxn);
		exit();
	}
}//WELIMINAR_ACT

if (isset($WELIMINAR_ACT)){
?><table class=grilla_table111>
<tr><th><br><? 
mensaje("El registro NO se puede eliminar, porque tiene más información relacionada en el sistema.",0);
echo mysqli_error($cxn);
?><br></th></tr>
</table><?
}else{
?>
<center>
<table class=grilla_table111>
<tr><th colspan=2><h3>¿Desea eliminar el registro <?echo $MATRIX[0][0];?> (<?echo $ELIMINAR;?>)?</h3></th></tr>
<tr>
<td><center><input type=button value='     Si     ' Onclick="AjaxEliminar('WELIMINAR_ACT=1&WELIMINAR=<?echo $WELIMINAR;?>');" class=boton></td>
<td><center><input type=button value='     No     ' Onclick=CerrarBlock() class=boton></td>
</tr>
</table><?
}//WACTIVAR
mysqli_close($cxn);
