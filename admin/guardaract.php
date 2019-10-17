<?php 
session_start();
include '../lib/class_mysql.php';
include '../lib/config.php';
    if(isset($_GET['envia'])){
    $comentario=$_GET['comentario'];    
    $id=$_GET['id'];
    $date=date('Y/m/d');
    if( $_SESSION['tipo']=='user'){
       $nombre_user=$_SESSION['nombreusuario'];
    }
    else{  
        $nombre_user=$_SESSION['nombreadmin'];
    }
    if(MysqlQuery::Guardar("detalle_ticket", "id_ticket,id_usuario,comentario,fecha","'$id','$nombre_user','$comentario','$date'")){

      echo '<script>alert("Su comentario se guardo correctamente")</script>';
      /*addslashes($email_edit, $asunto_edit, $mensaje_mail, $cabecera);----------Fin codigo numero de ticket*/
      echo '<script>
      history.back(1)
      </script>';
      
    }
  }
  
  ?>