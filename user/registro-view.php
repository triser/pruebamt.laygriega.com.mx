<?php
    if(isset($_POST['user_reg']) && isset($_POST['clave_reg']) && isset($_POST['nom_complete_reg'])){
        $nombre_reg=MysqlQuery::RequestPost('nom_complete_reg');
        $user_reg=MysqlQuery::RequestPost('user_reg');
        $clave_reg=md5(MysqlQuery::RequestPost('clave_reg'));
        $clave_reg2=MysqlQuery::RequestPost('clave_reg');
        $email_reg=MysqlQuery::RequestPost('email_reg');

        if(MysqlQuery::Guardar("cliente", "nombre_completo, nombre_usuario, email_cliente, clave", "'$nombre_reg', '$user_reg', '$email_reg', '$clave_reg'")){

            /*----------  Enviar correo con los datos de la cuenta 
                mail($email_reg, $asunto, $mensaje_mail, $cabecera);
            ----------*/
		//Importamos las variables del formulario/ /
			
        $nombre_reg = utf8_decode($_POST['nom_complete_reg']);
        $user_reg = $_POST['user_reg'];
        $clave_reg2 = $_POST['clave_reg'];
        $mensaje_mail = utf8_decode($_POST['message']);
        $email_reg = $_POST['email_reg'];

        //Preparamos el mensaje de contacto/ /
        $cabeceras = "From: Registro de cuenta al Sistema de Orden de Mejora LA Y GRIEGA"; //La persona que envia el correo
        $asunto = "Datos de cuenta"; //El asunto
        $email_to = "$email_reg, sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Hola ".$nombre_reg.", Gracias por registrarte al Sistema OM de Abarrotes LA Y GRIEGA. Los datos de tu cuenta son los siguientes:
         \nNombre Completo: ".$nombre_reg."
         \nNombre de usuario: ".$user_reg."
        \nClave: ".$clave_reg2."
        \nEmail: ".$email_reg."
        \n Para poder accesar Visitanos: http://www.sistemaom.laygriega.com.mx";

        //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">REGISTRO EXITOSO</h4>
                    <p class="text-center">
                      ¡ Se le ha enviado un correo electrónico con sus datos de Registro !
                    </p>
                </div>
            ';
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        ERROR AL REGISTRARSE: Por favor intente nuevamente.
                    </p>
                </div>
            '; 
        }
    }
?>
 <div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrarte debes de llenar todos los campos de este formulario</strong></div><br>
        <div class="panel-body">
            <form accept-charset="utf-8" role="form" action="" method="POST">
            <div class="form-group">
              <label><i class="fa fa-user-circle"></i>&nbsp;Nombre completo</label>
              <input type="text" class="form-control" name="nom_complete_reg" placeholder="Nombre completo" required="" pattern="[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ.-]+{1,40}" title="Nombre Apellido" maxlength="40">
            </div>
            <div class="form-group">
              <label><i class="fa fa-user-o"></i>&nbsp;Usuario</label>
              <input type="text" class="form-control" name="user_reg" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="20">
              <div></div>
            </div>
            <div class="form-group has-success has-feedback">
              <label class="control-label"><i class="fa fa-envelope-o"></i>&nbsp;Corrreo Corporativo</label>
              <input type="email" id="input_email" class="form-control" name="email_reg"  placeholder="Escriba su Email Corporativo" required="">
              <div id="com_form"></div>
            </div>
        
            <div class="form-group">
              <label><i class="fa fa-key"></i>&nbsp;Contraseña</label>
              <input type="password" class="form-control" name="clave_reg" placeholder="Contraseña" required="">
            </div>
    
            <br>
            <button type="submit" class="btn btn-danger">Crear cuenta</button>
          </form>
        </div>
      </div>
    </div>
    <br>
    <div class="col-sm-4 text-center hidden-xs">
        <h2 class="text-primary">¡ Panel de registro ! SISTEMA MLT</h2>
      <img src="img/linux.png" class="img-responsive" alt="Image">
        <strong>Por favor de ingresar su Correo Corporativo Correctamente, el sistema le enviara los datos de inicio de session</strong>
        
    </div>
  </div>
</div>
<br>
<script>
    $(document).ready(function(){
        $("#input_email").keyup(function(){
            $.ajax({
                url:"./process/val.php?id="+$(this).val(),
                success:function(data){
                    $("#com_form").html(data);
                }
            });
        });
    });
</script>