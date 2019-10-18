<?php
$idpuesto= $_GET['param_id'];

  include "../lib/config2.php";//Contiene funcion que conecta a la base de datos

$result = mysqli_query($con,"SELECT EL.idlaboral,EL.nombre,EL.apellidos FROM puestos AS  P 
INNER JOIN empleado_laboral AS EL  
ON P.id_puesto = EL.id_puesto AND EL.id_puesto = $idpuesto");

while ($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['nombre'].' '.$row['apellidos'].'">'.utf8_encode($row['nombre']).'  '.utf8_encode($row['apellidos']).'</option>';
    
    
    
}