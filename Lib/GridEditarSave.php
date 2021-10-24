<?php
include("../funciones.php");
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
include("../".$NOM_PAG);

//if (!isset($TituloCapa)){$TituloCapa='';}
if ($_SESSION['ACCESO_SESION']!=1){
	exit();mysqli_close($cxn);
}
/*?><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><?*/
//if (!isset($WEDITAR)){$WEDITAR="";}

if (isset($WGUARDAR)){
	//ACCION DE EDITAR
	$ultimo_id=0;
	$A='';$LM='';
	if (isset($WEDITAR)){
		$editar=encriptar($WEDITAR,$llave,2);
	}
	for ($I=0; $I<(sizeof($MATRIX)); $I++){
		if (!isset(${"wk".$I})){${"wk".$I}='';}
	
		${"wk".$I}=addslashes(utf8_decode(${"wk".$I}));
		if (isset($MATRIX[$I][2]) and $MATRIX[$I][2]!="CALC" and $MATRIX[$I][2]!="MD" and $MATRIX[$I][2]!="L" 
		and $MATRIX[$I][2]!="LS" and $MATRIX[$I][2]!="LC" and $MATRIX[$I][2]!="SMCT" and $MATRIX[$I][2]!="SM"){
			//echo $I." ".${"wk".$I}."<br>";
			
			if (isset(${"wk".$I})){
				$val=trim(${"wk".$I});
				if ($val==''){
					//if ($WGUARDAR=='U' and $MATRIX[$I][2]!="FILE"){
					switch($MATRIX[$I][2]){
						case "S":case "SC": case "CB": $A.=",".$MATRIX[$I][3][2]."=null";break;
						case "T":case "TN": $A.=",".$MATRIX[$I][1]."=null";break;
					}
				}else{
					switch($MATRIX[$I][2]){
						case "S":case "SC": case "CB": $A.=",".$MATRIX[$I][3][2]."='".$val."'";break;
						case "SC2": $A.=",".$MATRIX[$I][3][3]."='".$val."'";break;
						case "FB": if (strtotime(${"wk".$I})<=time()){$A.=",".$MATRIX[$I][1]."='".$val."'";}else{mensaje("El campo [".$MATRIX[$I][0]."] debe ser igual o menor a la fecha actual.",0);exit();mysqli_close($cxn);};break;
						case "FF": if (strtotime(${"wk".$I})>=time()){$A.=",".$MATRIX[$I][1]."='".$val."'";}else{mensaje("El campo [".$MATRIX[$I][0]."] debe ser igual o mayor a la fecha actual.",0);exit();mysqli_close($cxn);};break;
						case "HR": $A.=",".$MATRIX[$I][1]."='".date("H:i",strtotime(${"wkh1".$I}.":".${"wkh2".$I}." ".${"wkh3".$I}))."'";break;
						case "H": $A.=",".$MATRIX[$I][1]."='".$val."'";break;
						case "T":$A.=",".$MATRIX[$I][1]."='".strtoupper($val)."'";break;
						case "TN":$A.=",".$MATRIX[$I][1]."='".$val."'";break;
						//case "FILE": $A.="";break;
						default: $A.=",".$MATRIX[$I][1]."='".$val."'";
					}
				}
			}
		}//filtrar tipos
	}//for
	//echo $A;
	//AUDITORIA
	if ($WGUARDAR=='U'){
		if (isset($AUD_U)){$A.=$AUD_U;}
	}else{
		if (isset($AUD_C)){$A.=$AUD_C;}
	}
	
	if (isset($DATO_EXTRA)){
		$A.=$DATO_EXTRA;
	}
	$A=substr($A,1);//eliminar primer caracter
	
		$cxn->query("begin");
		$res=false;
		if ($WGUARDAR=='U'){
			$str="update $TB_STR set $A where ".$TB_KEY."='".$editar."'";
			//echo $str."<br>";
			$res = $cxn->query($str);
			$ultimo_id = $editar;
		}else{
			$str="insert into $TB_STR set ".$A;
			//echo $str."<br>";
			$res = $cxn->query($str);
			$ultimo_id = mysqli_insert_id($cxn);
			if ($ultimo_id==0){
				$ultimo_id = $wk0;
			}
			//echo "id: ".$ultimo_id."<br>";
		}
		if (mysqli_errno($cxn)==1062 or mysqli_errno($cxn)==1761){
			//ERROR  DUPLICADO
			mensaje("Registro duplicado, intenta otro valor en el campo llave.",0);
			mysqli_close($cxn);exit();
		}
		for ($I=0; $I<(sizeof($MATRIX)); $I++){
			if ($MATRIX[$I][2]=='SM'){
				//LISTA MULTIPLE (SM)
				for ($sm=1;$sm<=${'wsm'.$I.'cant'};$sm++){
					if (isset(${'wsm'.$I.'_'.$sm.'del'})){
						$DELSM="delete from ".$MATRIX[$I][3][3]." where ".$MATRIX[$I][3][4]."='".$ultimo_id."' and ".$MATRIX[$I][3][5]."='".${'wsm'.$I.'_'.$sm.'del'}."'";
						$res_mul = $cxn->query($DELSM);
						//echo $LM."<br>";
					}
					if (isset(${'wsm'.$I.'_'.$sm.'add'})){
						$LM="insert into ".$MATRIX[$I][3][3]." set ".$MATRIX[$I][3][4]."='".$ultimo_id."',".$MATRIX[$I][3][5]."='".${'wsm'.$I.'_'.$sm.'add'}."'";
						$res_mul = $cxn->query($LM);
						//echo $LM."<br>";
					}
				}
			
			}
		}
		$cxn->query("commit");
		//echo "<br>".$WGUARDAR." ".$str;
		//IPS
		if ($res==true){
			if ($WGUARDAR=='U'){
				if (isset($codigophpC)){eval($codigophpC);}
				//mensaje("Se han guardado los cambios correctamente.",1);
				//$ultimo_id = $editar;
			}
			echo "true%".$WGUARDAR."%".$ultimo_id;
			$WGUARDAR='';
		}else{
			mensaje("Error al guardar datos.<br>".$str."<br>".addslashes(mysqli_error($cxn)),0);
		}
	
	//$WEDITAR=encriptar($WEDITAR,$llave,1);
}//wguardar
mysqli_close($cxn);