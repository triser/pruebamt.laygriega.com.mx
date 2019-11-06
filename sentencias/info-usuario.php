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
$anios=round((time() - strtotime($row['fecha_naci'])) / 31556926);
     $output .= '
     <tr>  
            <td class = "text-left" width="20%"><label>Personal:</label></td>  
            <td class = "text-left text-blue" width="33%">'.$row["grado"].' '.utf8_encode($row["nombre"]).' '.utf8_encode($row["apellidos"]).'</td> 
            <td class = "text-left"><label>Fecha de Alta:</label></td>  
            <td class = "text-blue" width="30%">'.$row["fecha_alta_sis"].'</td>  
        </tr>
        <tr> 
          <td class = "text-left" width="20%"><label>Usuario:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["usuario"].'</td> 
            <td class = "text-left"><label>Ult Actualizacion:</label></td>  
            <td class = "text-blue" width="30%">'.$row["fecha_update"].'</td>   
        </tr>
          <tr> 
        <td class = "text-left" width="20%"><label>Tipo de Usuario:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["rol"].'</td> 
            <td class = "text-left"><label>Estatus:</label></td>  
            <td class = "text-blue" width="30%">'.$row["estatus"].'</td>   
        </tr> 
           <td class = "text-left" width="20%"><label>Departamento:</label></td> 
            <td class = "text-left text-blue" width="33%">'.utf8_encode($row["departamento"]).'</td> 
            <td class = "text-left"><label>puesto:</label></td>  
            <td class = "text-blue" width="30%">'.utf8_encode($row["puesto"]).'</td>   
        </tr>
          <td class = "text-left" width="20%"><label>Email Corporativo:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["email_usuario"].'</td> 
            <td class = "text-left"><label>Genero:</label></td>  
            <td class = "text-blue"width="30%">'.$row["genero"].'</td>   
        </tr> 
          <td class = "text-left" width="20%"><label>Fecha de Nacimiento:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["fecha_naci"].'</td> 
            <td class = "text-left"><label>Edad:</label></td>  
            <td class = "text-blue" width="30%">'.$anios.' Años</td>   
        </tr> 
            <td class = "text-left" width="20%"><label>Estado Civil:</label></td> 
            <td class = "text-left text-blue" width="33%">'.$row["estado_civil"].'</td> 
            <td class = "text-left"><label>Tipo de Sangre:</label></td>  
            <td class = "text-blue" width="30%">'.$row["sangre"].'</td>   
        </tr> 
           </tr> 
            <td class = "text-left" width="20%"><label>Curp:</label></td> 
            <td class = "text-left text-blue"width="33%">'.$row["curp"].'</td> 
            <td class = "text-left"><label>NSS:</label></td>  
            <td class = "text-blue" width="30%">'.$row["nss"].'</td>   
        </tr> 
            </tr> 
            <td class = "text-left" width="20%"><label>Telefono:</label></td> 
            <td class = "text-left text-light-blue" width="33%">'.$row["telefono"].'</td> 
            <td class = "text-left"><label>Telefono 2:</label></td>  
            <td class = "text-blue" width="30%">'.$row["telefono_2"].'</td>   
        </tr> 
          </tr> 
            <td class = "text-left"><label>Direccion:</label></td> 
            <td class = "text-left text-blue">'.$row["direccion"].' '.$row["cp"].'</td>
              <td class = "text-left"><label>Colonia:</label></td>  
            <td class = "text-blue" width="30%">'.$row["colonia"].'</td>   
        </tr> 
          </tr> 
            <td class = "text-left"><label>Poblacion:</label></td> 
            <td class = "text-left text-blue">'.$row["poblacion"].'</td>
              <td class = "text-left"><label>Estado:</label></td>  
            <td class = "text-blue" width="30%">'.$row["estado"].'</td>   
        </tr> 
     ';
    }
    $output .= '</table></div>';
    echo $output;
}


?>

 



