<?php
$idpuesto= $_GET['param_id'];

  include "../lib/config2.php";//Contiene funcion que conecta a la base de datos

$result = mysqli_query($con,"SELECT*FROM asunto AS A
  INNER JOIN puestos AS P
    ON A.id_puesto = P.id_puesto 
    AND P.id_puesto = $idpuesto");

while ($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['id_asunto'].'">'.utf8_encode($row['asunto']).'</option>';
}