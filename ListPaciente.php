<?php
$TB_STR="paciente";
$REL_STR="";
$QW_FORM='490px';
$QH_FORM='500px';
$TB_KEY="Id";

$MATRIX=array(
array('No. Documento','numero_documento','E','15','*','N',"","float:left;width:450px;","Datos Personales"),
array('Tipo de Documento','Nombre','SC',array('tipos_documento','id','tipo_documento'),'*','S'),
array('Nombre 1','nombre1','T','100','','S'),
array('Nombre 2','nombre2','T','100','','S'),
array('Apellido 1','apellido1','T','100','','S'),
array('Apellido 2','apellido2','T','100','','S'),
array('Genero','Nombre','SC',array('genero','id','genero_id'),'*','S'),
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