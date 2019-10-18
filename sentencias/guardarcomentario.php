<?php 
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8');
    $hora_actual=strftime("%H:%M:%S");


session_start();
include '../lib/class_mysql.php';
include '../lib/config.php';
    if(isset($_GET['envia'])){
    $comentario=$_GET['comentario'];    
    $id=$_GET['id'];
    $date=date('Y/m/d');
    if( $_SESSION['rol']='1'){
       $nombre_user=$_SESSION['nombreusuario'];
    }
    elseif($_SESSION['rol']='2'){  
        $nombre_user=$_SESSION['nombreadmin'];
    }
    if(MysqlQuery::Guardar("detalle_ticket", "id_ticket,id_usuario,comentario,fecha,hra_coment","'$id','$nombre_user','$comentario','$date','  $hora_actual'")){

      echo '<script>alert("Su comentario se guardo correctamente")</script>';
      /*addslashes($email_edit, $asunto_edit, $mensaje_mail, $cabecera);----------Fin codigo numero de ticket*/
      echo '<script>
      history.back(1)
      </script>';
      
    }
  }
  
  ?>