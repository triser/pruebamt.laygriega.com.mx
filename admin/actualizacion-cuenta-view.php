<?php include './lib/config2.php';if( $_SESSION['email']!="" && $_SESSION['clave']!="" && $_SESSION['rol']=="2"){ ?>

<?php 
      
    
    /* Actualizar cuenta admin */
        
        if(isset($_POST['nombre']) && isset($_POST['apellidos'])&& isset($_POST['password'])){
            $nombre_admin=MysqlQuery::RequestPost('nombre');
            $apellidos_admin=MysqlQuery::RequestPost('apellidos');
            $anterior_pass=md5(MysqlQuery::RequestPost('anterior_pass'));
            $pass_admin=md5(MysqlQuery::RequestPost('password'));
            $email_admin=MysqlQuery::RequestPost('email');

            $act_pass=Mysql::consulta("SELECT * FROM usuario WHERE email_usuario= '$email_admin' AND clave='$anterior_pass'");
            if(mysqli_num_rows($act_pass)>=1){
                      if(MysqlQuery::Actualizar("usuario", "clave='$pass_admin'" , "email_usuario= '$email_admin' AND clave='$anterior_pass'")){
                    $_SESSION['clave']=$pass_admin;
                          
                          
                          
    	
		  //Preparamos el mensaje de contacto
			
		  $cabeceras = "From: ORDEN DE MEJORA LA Y GRIEGA"; //La persona que envia el correo
		  $asunto= "Numero de Folio de Orden de Mejora del Sistema OM"; //El asunto
		  $email_to = "$email_admin, sistemaom@laygriega.com.mx"; //cambiar por tu email
		  $mensaje_mail="Hola ".$nombre_admin." ".$apellidos_admin.",su Contraseña ha cambiado:
		  \n contrase: ".$pass_admin.",
		  \n Para poder Acceder al sistema, ingresar en el siguiente Enlace: http://www.sistemaom.laygriega.com.mx";

		  //Enviamos el mensaje y comprobamos el resultado
		  if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
		  
                    echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">CONTRASEÑA ACTUALIZADA</h4>
                            <p class="text-center">
                           La contraseña se actualizo con exito
                            </p>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                            <p class="text-center">
                                No hemos podido actualizar el administrador
                            </p>
                        </div>
                    ';
                }
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                             Clave Anterior incorrecta
                        </p>
                    </div>
                ';
           }
        }
    
        ?>
<?php include('./sentencias/consulta.php');?>
<div class="wrapper">
  <!-- Main Header -->
  <?php include "./inc/main-header.php"; ?>  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include "./inc/main-sidebar.php"; ?>  
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Actualizar Cuenta
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Configuracion</a></li>
        <li class="active">Actualizar Cuenta</li>
      </ol>
      <br>
    </section>
        <div class="row"><!-- .row -->
            <div class="col-md-12">
            <div class="col-md-1"></div>
                <div class="col-md-3">
                    <!-- Profile Image -->
                        <div class="box box-success">
                            <div class="box-body box-profile">
                            <div id="load_img">
                                <img class="img-responsive" width="100%" src="img/profiles/<?php echo $foto_perfil;?>" alt="Imagen de Perfil">
                                </div>
                                <h3 class="profile-username text-center"><?php echo $grado;?> <?php echo $nombre;?> <?php echo $apellidos;?></h3>
                                <p class="text-muted text-center mail-text"><?php echo $email;?></p>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                 <span class="btn btn-success btn-file" style="width: 100%; margin-top: 5px;">
                           Imagen de perfil: 
                    </span>
                   
                </div> 
                <div class="col-md-1"></div>
                <div class="col-md-6">
                                <div class="box box-success"><!-- general form elements -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Datos Personales: </h3>
                        </div> <!-- /.box-header -->
                         <form role="form" method="post" action="" ><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input name="usuario" type="text" class="form-control" id="usuario" value="<?php echo $usuario;?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $nombre;?>" readonly >
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos:</label>
                                    <input name="apellidos" type="text" class="form-control" id="apellidos" value="<?php echo $apellidos;?>" readonly>
                                </div>
                                   <div class="form-group">
                                    <label for="anterior_password">Contraseña Anterior</label>
                                    <input name="anterior_pass" type="password" class="form-control" id="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Nueva Contraseña</label>
                                    <input name="password" type="password" class="form-control" id="new_password">
                                </div>
                                     <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $email;?>" readonly>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button name="token" type="submit" class="btn btn-success">Actualizar Datos</button>
                            </div>
                        </form>
                                                                    </div><!-- /.box -->
                </div>
                <div class="col-md-1"></div>
                </div>
            </div><!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "./inc/footer.php"; ?> 

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
    <?php
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores de Sistema OT La Y Griega</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>
 <script>

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=actualizacion-cuenta"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>