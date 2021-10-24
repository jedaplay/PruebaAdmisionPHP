<?
session_start();
extract($_POST,EXTR_SKIP);
extract($_SERVER);
extract($_COOKIE);
extract($_FILES);
extract($_ENV);
extract($_REQUEST);
extract($_SESSION);

date_default_timezone_set('America/Bogota');
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type:text/html; charset=iso-8859-1');
/*header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");		// Expira en fecha pasada 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 	// Siempre página modificada 
header("Cache-Control: no-cache, must-revalidate");			// HTTP/1.1 
header("Pragma: no-cache");  */

$llave='fgh#&rtTRon';
$SESION_VASIJA="ses_qwerty";
include('cxn.php');
function sesion_estado($SESION_VASIJA,$llave){
	if (isset($_SESSION[$SESION_VASIJA]) and comparar_cadena($_SESSION[$SESION_VASIJA],encriptar(session_id(),$llave,1))==true){
		$wusuario=encriptar($_SESSION['USU_ID'],$llave,2);
		return $wusuario;
	}else{
		echo "Ha expirado la sesión.";
		//mysqli_close($cxn);
		exit();
	}
}

function sql_query($sql,$cxn){
	$res = $cxn->query($sql);
	if (mysqli_errno($cxn)>0 and mysqli_errno($cxn)!=1062){
		//mysqli_error($res);
		//echo $sql;
		$m='';
		if (isset($_SESSION['ACT_MODULO'])){
			$m=$_SESSION['ACT_MODULO'];
		}
		error_log("MODULO: ".$m." => ".$sql." \n:::: No. Error: ".mysqli_errno($cxn).": ".mysqli_error($cxn)."\n\n", 0);
	}
	return $res;
}

function acceso_seguro($VALOR){
	//$llave='dhf#hf5$%&/()';
	//$SESION_VASIJA="ses_c3541u9";
	if (comparar_cadena($_SESSION[$VALOR[1]],encriptar(session_id(),$VALOR[0],1))==true){
		$_SESSION['ACCESO_SESION']=1;
		return 1;
	}else{
		$_SESSION['ACCESO_SESION']=0;
		return 0;
	}
}

function pie(){
//Derechos reservados, JJnotes Email: jjnotes@mercadoneiva.com Direcci&oacute;n comercial: Cel. 3004307504 - 3167889305
?>
<div id=pie>Copyright © 2017. Todos los derechos reservados.</div>
</body>
</html><?
}

function mensaje($MEN,$TIPO){
	if ($TIPO==0){
		?><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><?
		echo "<div class=mensaje0><center>".$MEN."</div>";
	}else{
		?><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><?
		echo "<div class=mensaje1><center>".$MEN."</div>";
	}
}

function encriptar($CADENA, $LLAVE, $TIPO){
	if ($TIPO==2){
		$CADENA = pack('H*', $CADENA);
	}
	for($i = 0; $i <= 255; $i++){
		$S[$i]=$i;
	}	
	$j=0;
	for($i = 0; $i <= 255; $i++){
		if($j >= strlen($LLAVE)){
			$j=0;
		}
		$K[$i]=ord(substr($LLAVE,$j,1));
		$j=$j+1;
	}
	$j=0;
	for($i = 0; $i <= 255; $i++){
		$j=($j + $S[$i]+$K[$i]) & 255;
		$temp = $S[$i];
		$S[$i] = $S[$j];
		$S[$j] = $temp;
	}	
	$i=0;
	$j=0;
	$len=strlen($CADENA);$outp='';
	for($x = 0; $x < $len; $x++){
		$i=($i+1) & 255;
		$j=($j+$S[$i]) & 255;
		$temp = $S[$i];
		$S[$i] = $S[$j];
		$S[$j] = $temp;
		$t = ($S[$i] + ($S[$j] & 255)) & 255;
		$Y = $S[$t];
		$outp=$outp.chr(ord(substr($CADENA,$x,1))^$Y);
	}
	switch($TIPO){
		case 1:return bin2hex($outp);break;
		case 2:return $outp;break;
	}
}

function comparar_cadena($cad1,$cad2){
	if ($cad1=="" or $cad2==""){return false;}
	$ncar1=strlen($cad1);
	$ncar2=strlen($cad2);
	$mcad=0;
	if ($ncar1==$ncar2){
		for ($I=0;$I<=($ncar1-1);$I++){
			$pcar1=substr($cad1,$I,1);//ELEGIR 1ER CARACTER
			$pcar2=substr($cad2,$I,1);//ELEGIR 1ER CARACTER
			if ($pcar1==$pcar2){
				$mcad++;
			}
		}
		if ($mcad==$ncar1){return true;}else{return false;}
	}else{
		return false;
	}
}
function round_up($val, $precision=0) {
	$val2=floor($val);
	$p = pow ( 10, $precision ); 
	$a = $p * $val; 
	$b = ceil($a); 
	if((round($b - $a, 2) > 0.5)){ 
		$b -= 1.0; 
	}
	return NUMBER_FORMAT($b / $p,1,'.',' ');
}

function round_cop($num, $unidad){
     return  round($num / $unidad) * $unidad;
}

function cadena_azar(){
	$length=10;
	$source = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";	
	for ($i=1; $i<=$length; $i++){
		$car=rand(0,(strlen($source)-1));
		$pal.=substr($source,$car,1);
	}	
	return $pal;
}
function cadena_azar2($len){
	$source = "123456789";$pal='';
	for ($i=1; $i<=$len; $i++){
		$car=rand(0,(strlen($source)-1));
		$pal.=substr($source,$car,1);
	}	
	return $pal;
}
function gen_clave($len){
	$source = "23456789ABCDEFGHJKLMNPQRSTUVWXYZ";$pal='';
	for ($i=1; $i<=$len; $i++){
		$car=rand(0,(strlen($source)-1));
		$pal.=substr($source,$car,1);
	}	
	return $pal;
}

function mes($m){
switch ($m){
	case 1: $mes="ENERO";break;
	case 2: $mes="FEBRERO";break;
	case 3: $mes="MARZO";break;
	case 4: $mes="ABRIL";break;
	case 5: $mes="MAYO";break;
	case 6: $mes="JUNIO";break;
	case 7: $mes="JULIO";break;
	case 8: $mes="AGOSTO";break;
	case 9: $mes="SEPTIEMBRE";break;
	case 10: $mes="OCTUBRE";break;
	case 11: $mes="NOVIEMBRE";break;
	case 12: $mes="DICIEMBRE";break;
}
return $mes;
}

function orderMultiDimensionalArray($toOrderArray, $field, $inverse) {  
    $position = array();  
    $newRow = array();  
    foreach ($toOrderArray as $key => $row) {  
            $position[$key]  = $row[$field];  
            $newRow[$key] = $row;  
    }  
    if ($inverse) {  
        arsort($position);  
    }  
    else {  
        asort($position);  
    }  
    $returnArray = array();  
    foreach ($position as $key => $pos) {       
        $returnArray[] = $newRow[$key];  
    }  
    return $returnArray;  
}

function edad($fecha){
	$cumpleanos = new DateTime($fecha);
	$hoy = new DateTime();
	$annos = $hoy->diff($cumpleanos);
	return $annos->y;
}
function edad_eq($fecha){
	$cumpleanos = new DateTime($fecha);
	$hoy = new DateTime();
	$intervalo = $hoy->diff($cumpleanos);
	//$total=($intervalo->y)." años ".($annos->a)." dias";
	//return $intervalo->y;
	$total="";
	if (($intervalo->y)>0){
		$total.=$intervalo->format('%y años, ');
	}
	if (($intervalo->m)>0){
		$total.=$intervalo->format('%m mes, ');
	}
	if (($intervalo->d)>0){
		$total.=$intervalo->format('%d días');
	}
	return $total;
}
