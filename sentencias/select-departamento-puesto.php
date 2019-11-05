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
        echo '<option value="">Seleccione el puesto</option>';
       while($puesto = mysqli_fetch_assoc($consulta_puesto)){ 
            echo '<option value="'.$puesto['id_puesto'].'">'.$puesto['puesto'].'</option>';
        }
    }else{
        echo '<option value="">Puesto no disponible</option>';
    }
}
if(isset($_POST["puesto_id"]) && !empty($_POST["puesto_id"])){
    //Get all city data
    $query = mysqli_query($con,"SELECT * FROM asunto WHERE idpuesto = ".$_POST['puesto_id']." AND estatus_a = 1 ORDER BY asunto ASC");
    
    //Count total number of rows
    $rowCount = $query-> num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Selecione el asunto</option>';
       while($row = mysqli_fetch_assoc($query)){ 
            echo '<option value="'.$row['id_asunto'].'">'.$row['asunto'].'</option>';
        }
    }else{
        echo '<option value="">Asunto no disponible</option>';
    }
}

if(isset($_POST["id_puesto"]) && !empty($_POST["id_puesto"])){
    //Get all city data
    $query = mysqli_query($con,"     SELECT EL.idlaboral,G.grado,EL.nombre,EL.apellidos FROM empleado_laboral AS EL
  INNER JOIN puestos AS P  ON  EL.idpuesto = P.id_puesto
  INNER JOIN usuario AS U ON  U.idusuario = EL.idusuario
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado 
    WHERE EL.idpuesto = ".$_POST['id_puesto']." ORDER BY idlaboral ASC");
    
    //Count total number of rows
    $rowCount = $query-> num_rows;
       while($row = mysqli_fetch_assoc($query)){ 
            echo '<option value="'.$row['grado'].' '.$row['nombre'].' '.utf8_encode($row['apellidos']).'">'.$row['grado'].' '.$row['nombre'].' '.utf8_encode($row['apellidos']).'</option>';
        }
   
}

if(isset($_POST["idpuesto"]) && !empty($_POST["idpuesto"])){
    //Get all city data
    $query = mysqli_query($con,"SELECT U.idusuario,U.email_usuario FROM usuario AS U INNER JOIN empleado_laboral AS EL  ON U.idusuario = EL.idusuario
  INNER JOIN puestos AS P ON EL.idpuesto = P.id_puesto INNER JOIN grado_estudio AS G  ON EL.idgrado = G.id_grado WHERE EL.idpuesto = ".$_POST['idpuesto']." ORDER BY idusuario ASC");
    
    //Count total number of rows
    $rowCount = $query-> num_rows;
       while($row = mysqli_fetch_assoc($query)){ 
            echo '<option value="'.$row['email_usuario'].'">'.$row['email_usuario'].'</option>';
        }
   
}
?>