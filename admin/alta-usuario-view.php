<?php include './lib/config2.php';  if($_SESSION['email']!="" && $_SESSION['rol']=="2"){ ?>  
<?php
    if(isset($_POST['user_reg']) && isset($_POST['clave_reg']) && isset($_POST['nom_complete_reg']) && isset($_POST['apellidos_reg']))  {
        $nombre_reg=MysqlQuery::RequestPost('nom_complete_reg');
        $apellidos_reg=MysqlQuery::RequestPost('apellidos_reg');
        $user_reg=MysqlQuery::RequestPost('user_reg');
        $clave_reg=md5(MysqlQuery::RequestPost('clave_reg'));
        $clave_reg2=MysqlQuery::RequestPost('clave_reg');
        $rol_reg=MysqlQuery::RequestPost('rol_acceso');
        $email_reg=MysqlQuery::RequestPost('email_reg');
        $foto_perfil_reg="default.png";
        $estatus="1";
        $f_alta=date("Y-m-d");
        $f_ingreso=date("Y-m-d");
        $relacion="1";
 

        
$sql="INSERT INTO usuario (idusuario,email_usuario, usuario, clave, foto_perfil, rol, estatus, fecha_alta_sis) VALUES (null,'$email_reg', '$user_reg', '$clave_reg', '$foto_perfil_reg', '$rol_reg', '$estatus', '$f_alta')";
 $res=mysqli_query($con,$sql);//El campo ID de esta tabla es AUTO_INCREMENT
   $last_id = mysqli_insert_id($con);  //<<<---Aqui--->>>
        
$sql1="INSERT INTO empleado_laboral (nombre, apellidos,f_alta_el,idpuesto,idgrado,idusuario) VALUES ('$nombre_reg','$apellidos_reg','$f_alta','$relacion','$relacion','$last_id')";
$res2=mysqli_query($con,$sql1);//El campo ID de esta tabla es AUTO_INCREMENT  
        
                
$sql2="INSERT INTO empleado_personal (fecha_ingreso, idsangre, idgenero, idcivil, idusuario) VALUES ('$f_ingreso','$relacion','$relacion','$relacion','$last_id')";
$res3=mysqli_query($con,$sql2);//El campo ID de esta tabla es AUTO_INCREMENT  
        
                
$sql3="INSERT INTO contacto_emergencia (idusuario) VALUES ('$last_id')";
$res4=mysqli_query($con,$sql3);//El campo ID de esta tabla es AUTO_INCREMENT  
        
// $sql="INSERT INTO empleado_laboral (idusuario, nombre, apellidos) VALUES (null,'$nombre_reg','$apellidos_reg')";
// $res=mysqli_query($con,$sql);//El campo ID de esta tabla es AUTO_INCREMENT
//$last_id = mysqli_insert_id($con);  //<<<---Aqui--->>>
        
        
//$sql1="INSERT INTO empleado_personal (idpersonal, fecha_ingreso) VALUES (null,'$f_ingreso')";
// $res1=mysqli_query($con,$sql1);//El campo ID de esta tabla es AUTO_INCREMENT
//$last_id1 = mysqli_insert_id($con);  //<<<---Aqui--->>>
        
//$sql2="INSERT INTO contacto_emergencia (idemergencia, f_alta) VALUES (null,'$f_ingreso')";
//$res2=mysqli_query($con,$sql2);//El campo ID de esta tabla es AUTO_INCREMENT
//$last_id2 = mysqli_insert_id($con);  //<<<---Aqui--->>>


 //  $sql3="INSERT INTO usuario (email_usuario, usuario, clave, foto_perfil, rol, estatus, fecha_alta_sis, id_laboral,id_personal,id_emergencia) VALUES ('$email_reg', '$user_reg', '$clave_reg', '$foto_perfil_reg', '$rol_reg', '$estatus', '$f_alta' ,'$last_id' ,'$last_id1' ,'$last_id2')";
//$res3=mysqli_query($con,$sql3); //En esta consulta quisiera guardar el mismo id generado con el formulario anterior para guardarlo en id_empresa

        
        if ($res4){
            
        $nombre_reg = utf8_decode($_POST['nom_complete_reg']);
        $apellidos_reg= utf8_decode($_POST['apellidos_reg']);
        $user_reg = $_POST['user_reg'];
        $clave_reg2 = $_POST['clave_reg'];
        $email_reg = $_POST['email_reg'];

        //Preparamos el mensaje de contacto/ /
        $cabeceras = "From: Registro de cuenta al Sistema de Orden de Mejora LA Y GRIEGA"; //La persona que envia el correo
        $asunto = "Datos de cuenta"; //El asunto
        $email_to = "$email_reg, sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Hola ".$nombre_reg.", Gracias por registrarte al Sistema OM de Abarrotes LA Y GRIEGA. Los datos de tu cuenta son los siguientes:
         \nNombre Completo: ".$nombre_reg."
        \nApellidos: ".$apellidos_reg."
         \nNombre de usuario: ".$user_reg."
        \nClave: ".$clave_reg2."
        \nEmail: ".$email_reg."
        \n Para poder accesar Visitanos: http://www.sistemaom.laygriega.com.mx";

        //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras ));
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
<?php include('./sentencias/consulta.php');?>
<?php
   $titu = Mysql::consulta("SELECT * FROM grado_estudio");   
 ?>
<div class="wrapper">
  <!-- Main Header -->
  <?php include "./inc/main-header.php"; ?>  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include "./inc/main-sidebar.php"; ?>  
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
   Alta de Usuario
        <small>LA Y GRIEGA</small>
      </h1>
       <ol class="breadcrumb">
        <li><a href="./admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Administrar Usuarios</li>
        <li><a href="./admin.php?view=usuarios"> Lista de Usuarios</a></li>
        <li class="active">Alta de Usuarios</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">

          <!-- /.box -->
        <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
 
          <!-- form start -->
          <form role="form" class="form-horizontal" accept-charset="utf-8" action="" method="POST" >
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nom_complete_reg" autocomplete="off" value="" required>
                </div>
              </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellidos_reg" autocomplete="off" value="" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Usuario</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="user_reg" autocomplete="off" value="" required>
                </div>
              </div>

        <div class="form-group has-success has-feedback">
            <label class="col-sm-2 control-label">Corrreo Corporativo</label>
             <div class="col-sm-5">
              <input type="email" id="input_email" class="form-control" name="email_reg"  placeholder="Escriba su Email Corporativo" required="">
              <div id="com_form"></div>
            </div>  </div>
        
                   <div class="form-group">
               <label class="col-sm-2 control-label">Pasword</label>
                       <div class="col-sm-5">
              <input type="password" class="form-control" name="clave_reg" placeholder="Contraseña" required="">
            </div>
                </div> 
            <div class="form-group">
                <label class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-5">
                  <br/>
                  <img style="border:1px solid #eaeaea;border-radius:5px;" src="img/profiles/default.png" width="128">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Roles de acceso</label>
                <div class="col-sm-5">
                  <select class="form-control" name="rol_acceso" required>
                    <option value="" selected>-- Selecciona rol --</option>
                <?php 
                                                $query = Mysql::consulta ("SELECT * FROM rol");
                                                while ($valores = mysqli_fetch_array($query)){
                                                echo "<option value='".$valores['idrol']."'>".$valores['rol']."</option>";
                                                    }?>
                  </select>
                </div>
              </div>
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary btn-submit">Crear cuenta</button>
                
                  <a href="./admin.php?view=usuarios" class="btn btn-default btn-reset">Cancelar</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
       <!-- /walper -->
  </div>
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
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
<!-- ./wrapper -->
      <!-- Main Footer -->
<?php include "./inc/footer.php"; ?> 
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

    <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=usuarios"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>