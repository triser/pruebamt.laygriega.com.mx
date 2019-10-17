<?php if(!$_SESSION['nombre']==""&&!$_SESSION['tipo']==""){ 
        
        /*Script para eliminar cuenta*/
        if(isset($_POST['usuario_delete']) && isset($_POST['clave_delete'])){
          $usuario_delete=MysqlQuery::RequestPost('usuario_delete');
          $clave_delete=md5(MysqlQuery::RequestPost('clave_delete'));
         
          $sql=Mysql::consulta("SELECT * FROM cliente WHERE nombre_usuario= '$usuario_delete' AND clave='$clave_delete'");

          if(mysqli_num_rows($sql)>=1){
             MysqlQuery::Eliminar("cliente", "nombre_usuario='$usuario_delete' and clave='$clave_delete'");
             echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido eliminar la cuenta por que los datos son incorrectos
                    </p>
                </div>
            '; 
          }
        }
         
         
        /*Script para actualizar datos de cuenta*/
        if(isset($_POST['name_complete_update']) && isset($_POST['old_user_update']) && isset($_POST['new_user_update']) && isset($_POST['old_pass_update']) && isset($_POST['new_pass_update'])){

          $nombre_complete_update=MysqlQuery::RequestPost('name_complete_update');
          $old_user_update=MysqlQuery::RequestPost('old_user_update');
          $new_user_update=MysqlQuery::RequestPost('new_user_update');
          $old_pass_update=md5(MysqlQuery::RequestPost('old_pass_update'));
          $new_pass_update=md5(MysqlQuery::RequestPost('new_pass_update'));
          $email_update=MysqlQuery::RequestPost('email_update');
          
           $sql=Mysql::consulta("SELECT * FROM cliente WHERE nombre_usuario= '$old_user_update' AND clave='$old_pass_update'");
           
          if(mysqli_num_rows($sql)>=1){
            MysqlQuery::Actualizar("cliente", "nombre_completo='$nombre_complete_update', nombre_usuario='$new_user_update', email_cliente='$email_update', clave='$new_pass_update'", "nombre_usuario='$old_user_update' and clave='$old_pass_update'");
         
         //Importamos las variables del formulario/ /
			
        $nombre_complete_update =utf8_decode($_POST['name_complete_update']);
        $new_user_update= $_POST['new_user_update'];
        $new_pass_update = $_POST['new_pass_update'];
        $message = utf8_decode($_POST['message']);
        $email_update = $_POST['email_update'];


        //Preparamos el mensaje de contacto
        $cabeceras = "From: Tu cuenta fue actualizado Exitosamente"; //La persona que envia el correo
        $asunto = "Actualizacion de cuenta"; //El asunto
        $email_to = "$email_update, sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Hola ".$nombre_complete_update.", los siguientes datos de tu cuenta fueron Actualizados y son los siguientes:
        \nNombre Completo: ".$nombre_complete_update."
        \nNombre de usuario : ".$new_user_update."
        \nNueva Clave: ".$new_pass_update."
        \nEmail: ".$email_update."
        \nDudas y Sugerencias Por favor de comunicarse al departamento de Sistemas";

          //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;

            $_SESSION['nombre']=$new_user_update;
            $_SESSION['clave']=$new_pass_update;

            echo '
              <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="text-center">CUENTA ACTUALIZADA</h4>
                  <p class="text-center">
                    ¡Se le ha enviado un correo electrónico con sus Nuevos datos de Actualización!
                  </p>
              </div>
            ';
          }else{
            echo '
              <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="text-center">OCURRIO UN ERROR</h4>
                  <p class="text-center">
                    Asegurese que los datos ingresados son validos. Por favor intente nuevamente</p>
                  </p>
              </div>
            '; 
          }
        }
        ?>
        <div class="container">
          <div class="row well">
            <div class="col-sm-3">
              <img src="img/settings.png" alt="Image" class="img-responsive">
            </div>
            <div class="col-sm-9 lead">
              <h2 class="text-info">Bienvenido a la configuración de cuenta del Sistema OM LA Y GRIEGA</h2>
              <p>Puedes <strong>actualizar los datos</strong> de tu cuenta ó puedes <strong>eliminar tu cuenta</strong> permanentemente si ya no deseas ser usuario del Sistema OM</p>
            </div>
          </div><!--Fin row well-->
          <div class="row">
            <div class="col-sm-8">
              <div class="panel panel-info">
                <div class="panel-heading text-center"><i class="fa fa-retweet"></i>&nbsp;&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                <div class="panel-body">
                    <form action="" method="post" role="form">
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Nombre completo</label>
                      <input type="text" class="form-control" name="name_complete_update" readonly="" value="<?php echo utf8_encode($_SESSION['nombre_completo']); ?>">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-user"></i>&nbsp;&nbsp;Nombre de usuario actual</label>
                      <input type="text" class="form-control" name="old_user_update" readonly="" value="<?php echo utf8_encode($_SESSION['nombre']); ?>">
                    </div>
                      <div class="form-group">
                      <label class="text-primary"><i class="fa fa-key"></i>&nbsp;&nbsp;Contraseña actual</label>
                      <input type="password" class="form-control" name="old_pass_update" placeholder="Ingresar su actual Contraseña" required="">
                    </div>
                    <div class="form-group  has-success has-feedback">
                      <label class="text-danger"><i class="fa fa-user"></i>&nbsp;&nbsp;Nombre de usuario nuevo</label>
                      <input type="text" class="form-control" id="input_user" placeholder="Nombre de usuario nuevo" name="new_user_update" required="" pattern="[a-zA-Z0-9 ]{1,30}" title="Ejemplo7" maxlength="20">
                      <div id="com_form"></div>
                    </div>
                    <div class="form-group">
                      <label class="text-danger"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Contraseña nueva</label>
                      <input type="password" class="form-control" placeholder="Nueva Contraseña" name="new_pass_update" required="">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Email</label>
                      <input type="email" class="form-control" name="email_update" readonly="" value="<?php echo utf8_encode($_SESSION['email']); ?>">
                    </div>
                    <button type="submit" class="btn btn-info">Actualizar datos</button>
                  </form>
                </div>
              </div>
            </div><!--Fin col 8-->
                       <div class="col-sm-4">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="panel panel-danger">
                         <div class="panel-heading text-center"><i class="fa fa-trash-o fa-fw"></i> &nbsp;<strong>¿Deseas eliminar tu cuenta?</strong></div>
                             <br><br><br><br><br>
              <center><img src="img/delete_user.png" alt="Image"></center><br><br><br><br>
              <center><button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash-o fa-fw"></i> &nbsp;&nbsp;Eliminar cuenta</button></center>
              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title text-center text-danger" id="myModalLabel">¿Deseas eliminar tu cuenta?</h4>
                    </div>
                    <form action="" method="post" role="form" style="padding:20px;">
                      <p class="text-warning">Si estas seguro que deseas eliminar tu cuenta por favor introduce tu nombre de usuario y contraseña</p>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="usuario_delete" placeholder="Nombre de usuario" readonly="">
                      </div><br>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="clave_delete" placeholder="Contraseña" readonly="">
                      </div><br>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar cuenta</button>
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <br><br><br><br><br><br><br>
                       </div>
                       </div>
                  </div><!--Fin row-->
              </div><!--Fin class col-md-4-->
          </div>
        </div>
<?php
}else{
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                <img src="img/SadTux.png" alt="Image" class="img-responsive"/>
            </div>
            <div class="col-sm-7 animated flip">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios del Sitema OT LA Y GRIEGA</h1>
                <h3 class="text-info text-center">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function(){
        $("#input_user").keyup(function(){
          $.ajax({
            url:"./process/val.php?id="+$(this).val(),
            success:function(data){
              $("#com_form").html(data);
            }
          });
        });
    });
</script>