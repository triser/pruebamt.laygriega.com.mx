<?php
	
	$id=$_GET['id'];
    $estado_edit=$_POST['estado_ticket'];
	$solucion_edit=$_POST['solucion_ticket'];
$radio_email=$_POST['optionsRadios'];
$fecha2_edit=$_POST['fecha2_ticket'];
$hra2_edit=$_POST['hra2_ticket'];
 $name_edit=$_POST['name_ticket'];
$serie_edit=$_POST['serie_ticket'];


   include "../lib/config2.php";//Contiene funcion que conecta a la base de datos
	
			
			$sql=("UPDATE tickets set  estatus_tks='$estado_edit', solucion='$solucion_edit', fechaE='$fecha2_edit', hra_E='$hra2_edit' where id='$id'");
			$query_update = mysqli_query($con,$sql);
				if ($query_update){
                    
				echo "<script language=\"javascript\">
window.location.href=\"../admin.php?view=tickets-recibidos\";
</script>";
				if($radio_email=="option2"){
				/*addslashes($email_edit, $asunto_edit, $mensaje_mail, $cabecera);----------Fin codigo numero de ticket*/

              $name_edit = utf8_decode($_POST['name_ticket']);
              $solucion_edit = utf8_decode($_POST['solucion_ticket']);

          //Preparamos el mensaje de contacto
        $cabeceras = "From: Tu Orden fue actualizado Exitosamente"; //La persona que envia el correo
        $asunto = "Actualizacion de Orden de Mejora"; //El asunto
        $email_to = "$email_edit, sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Estimado usuario ".$name_edit." Su Orden de Mejora esta Resuelto con Fecha: ".$fecha2_edit.".
        \nfolio: ".$serie_edit." 
        \n La solución a su problema es la siguiente:".$solucion_edit;
       
       

          //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
			}
                
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}

?>
