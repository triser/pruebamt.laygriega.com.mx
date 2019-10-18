
<?php
$iddepto = $_GET['param_id'];

  include "../lib/config2.php";//Contiene funcion que conecta a la base de datos

$result = mysqli_query($con,"SELECT*
FROM empleado_laboral AS EL 
  INNER JOIN puestos AS P
    ON EL.id_puesto = P.id_puesto
  INNER JOIN departamento AS D
    ON EL.id_departamento = D.id_departamento AND D.id_departamento = $iddepto");

while ($row = mysqli_fetch_array($result)){
	echo  '<option value="'.$row['id_puesto'].'">'.utf8_encode($row['puesto']).'</option>';
}