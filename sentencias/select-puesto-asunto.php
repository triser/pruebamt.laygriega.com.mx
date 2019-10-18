 <?php
   include "./lib/config2.php";//Contiene funcion que conecta a la base de datos

    $consulta = "SELECT * from puestos";
    $query = mysql_query($consulta);
    $cant = mysql_num_rows($query);
    if($cant != 0) {
        echo '<option value="0">[SELECCIONE]</option>';
        while ($fila = mysql_fetch_array($query)) {
 
            echo '<option value="'.$fila['id_puesto'].'">'.$fila['puesto'].'</option>';
         }
        };
?> 

