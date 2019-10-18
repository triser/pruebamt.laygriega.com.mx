<!-- Modal -->
<?php
if (isset($_POST["idusuario"])) {
    $output = '';
    include '../lib/config2.php'; // MySQL Connection
    $query  = "SELECT * FROM usuario WHERE idusuario = '" . $_POST["idusuario"] . "'";
    $result = mysqli_query($con, $query);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-striped">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '  
                <tr>  
                     <td width="30%"><label>Nombre</label></td>  
                     <td width="70%">' . $row["nombre"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Apellidos</label></td>  
                     <td width="70%">' . $row["apellidos"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Correo Corporativo</label></td>  
                     <td width="70%">' . $row["email_usuario"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Usuario</label></td>  
                     <td width="70%">' . $row["usuario"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Colonia</label></td>  
                     <td width="70%">' . $row["colonia"] . ' Year</td>  
                </tr>  
           ';
    }
    $output .= '  
           </table>  
      </div>  
      ';
    echo $output;
}
?>