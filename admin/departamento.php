<?php
  include "../lib/config2.php";//Contiene funcion que conecta a la base de datos

$result = mysqli_query($con,"SELECT * FROM departamento WHERE id_departamento = 6 OR id_departamento = 10");

while ($row = mysqli_fetch_array($result)){
	echo '<option value="'.$row['id_departamento'].'">'.utf8_encode($row['departamento']).'</option>';
}
