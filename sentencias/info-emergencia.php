<?php  
//select.php  
if(isset($_POST["id_usuario"]))
{
 $output = '';
 include '../lib/config2.php'; // MySQL Connection
 $query = "SELECT * FROM  usuario AS U
  LEFT JOIN rol AS R ON U.rol = R.idrol
  LEFT JOIN empleado_laboral AS EL ON  EL.idusuario = U.idusuario 
  LEFT JOIN puestos AS P ON   EL.idpuesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento
  LEFT JOIN grado_estudio AS GE ON EL.idgrado = GE.id_grado 
  LEFT JOIN empleado_personal AS EP ON   EP.idusuario = U.idusuario 
  LEFT JOIN estado_civil AS E ON  EP.idcivil = E.id_civil
  LEFT JOIN genero AS G ON  EP.idgenero = G.id_genero
  LEFT JOIN tipo_sangre AS T ON EP.idsangre = T.id_sangre 
  LEFT JOIN contacto_emergencia AS CE ON U.idusuario = CE.idusuario
  WHERE U.idusuario = '".$_POST["id_usuario"]."'";
 $result = mysqli_query($con, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-striped">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td class = "text-left" width="20%"><label>Personal:</label></td>  
           <td class = "text-left text-blue" width="33%">'.$row["grado"].' '.$row["nombre"].' '.$row["apellidos"].'</td>
            <td class = "text-left"><label>Puesto:</label></td>  
            <td class = "text-blue" width="30%">'.$row["puesto"].'</td>  
        </tr>
        <tr> 
          <td class = "text-left" width="20%"><label>Parentesco:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["parentesco_eme"].'</td> 
            <td class = "text-left"><label>Parentesco (2):</label></td>  
            <td class = "text-blue" width="30%">'.$row["parentesco_eme2"].'</td>   
        </tr>
          <tr> 
        <td class = "text-left" width="20%"><label>Nombre:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["nombre_eme"].'</td> 
            <td class = "text-left"><label>Nombre  (2):</label></td>  
            <td class = "text-blue" width="30%">'.$row["nombre_eme2"].'</td>   
        </tr> 
           <td class = "text-left" width="20%"><label>Telefeno:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["telefono_eme"].'</td> 
            <td class = "text-left"><label>Telefono  (2):</label></td>  
            <td class = "text-blue" width="30%">'.$row["telefono_eme2"].'</td>   
        </tr> 
           <td class = "text-left" width="20%"><label>Direccion:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["direccion_eme"].'</td> 
            <td class = "text-left"><label>Direccion  (2):</label></td>  
            <td class = "text-blue" width="30%">'.$row["direccion_eme2"].'</td>   
        </tr> 
          <tr> 
        <td class = "text-left" width="20%"><label>Colonia:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["colonia_eme"].'</td> 
            <td class = "text-left"><label>Colonia  (2):</label></td>  
            <td class = "text-blue" width="30%">'.$row["colonia_eme2"].'</td>   
        </tr> 
           <td class = "text-left" width="20%"><label>Ciudad:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["ciudad_eme"].'</td> 
            <td class = "text-left"><label>Ciudad  (2):</label></td>  
            <td class = "text-blue" width="30%">'.$row["ciudad_eme2"].'</td>   
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}


?>
