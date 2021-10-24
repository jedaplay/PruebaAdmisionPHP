<?php
//if (!isset($_SESSION['USU_ID'])){mensaje("Ha expirado la sesión.",2);mysqli_close($cxn);exit();}
//$USU=encriptar($_SESSION['USU_ID'],$llave,2);
$TB_STR="paciente";
$REL_STR="";
//$QANCHO='100%';
//$QALTO='75%';
$QW_FORM='490px';
$QH_FORM='500px';
$TB_KEY="Id";

$MATRIX=array(
//NUMERO C (TD), NUMERO FILA (TR)
//array('DATOS',1,'SEP',1,1),
array('No. Documento','numero_documento','E','15','*','N',"","float:left;width:450px;","Datos Personales"),
array('Tipo de Documento','Nombre','SC',array('tipos_documento','id','tipo_documento'),'*','S'),
array('Nombre 1','nombre1','T','100','','S'),
array('Nombre 2','nombre2','T','100','','S'),
array('Apellido 1','apellido1','T','100','','S'),
array('Apellido 2','apellido2','T','100','','S'),
array('Genero','Nombre','SC',array('genero','id','genero_id'),'*','S'),
//array('Departamento','Nombre','SC',array('departamentos','id','departamento_id'),'*','S'),
//array('Municipio','Nombre','SC2',array('departamentos','id','municipios','id','departamento_id','municipio_id'),'*','S'),
array('Departamento',"(select (select nombre from departamentos where id=departamento_id) from municipios where id=municipio_id)",'L'),
array('Municipio',"(select nombre from municipios where id=municipio_id)",'SC2',
	array("select id,nombre from departamentos order by nombre asc"
	,"select departamento_id from municipios where id=&&REL&&"
	,"select id,nombre,departamento_id from municipios where departamento_id=&&REL&& order by nombre asc"
	,'municipio_id'
	),'*','S'),
);

$OpsAgregar=1;
$OpsEditar=1;
$OpsEliminar=1;