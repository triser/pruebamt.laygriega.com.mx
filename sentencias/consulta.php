<?php 
    $iduser=$_SESSION['id'];
   $sql=Mysql::consulta("SELECT U.idusuario,U.email_usuario, U.usuario,G.grado,EL.nombre,EL.apellidos,U.clave,U.foto_perfil, U.rol, U.estatus,U.fecha_alta_sis
FROM usuario AS U LEFT JOIN empleado_laboral AS EL ON  EL.idusuario = U.idusuario LEFT JOIN grado_estudio AS G ON  EL.idgrado= G.id_grado WHERE U.idusuario=' $iduser'");
    while ($row=mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
        $grado = $row['grado'];
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $email = $row['email_usuario'];
        $foto_perfil = $row['foto_perfil'];
        $usuario = $row['usuario'];
        $id_usuario = $row['idusuario'];
  
    }



?>

