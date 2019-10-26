<?php
//Include database configuration file
 include '../lib/config2.php'; // MySQL Connection

if(isset($_POST["departamento_id"]) && !empty($_POST["departamento_id"])){
    //Get all puesto data
   $consulta_puesto = mysqli_query($con,"SELECT * FROM puestos WHERE id_depa = ".$_POST['departamento_id']." AND estatus_pu = 1 ");
    
    //Count total number of rows
    $rowCount = $consulta_puesto-> num_rows;
    
    //Display puestos list
    if($rowCount > 0){
        echo '<option value="">Selecione el puesto</option>';
       while($puesto = mysqli_fetch_array($consulta_puesto)){ 
            echo '<option value="'.$puesto['id_puesto'].'">'.$puesto['puesto'].'</option>';
        }
    }else{
        echo '<option value="">Puesto no disponible</option>';
    }
}
?>