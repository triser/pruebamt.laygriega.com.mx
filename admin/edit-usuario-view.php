<?php include './lib/config2.php'; if(!$_SESSION['email']=="" && $_SESSION['rol']=="2"){ ?>
<?php include('./sentencias/consulta.php');?>
 <?php       
     /*Script para actualizar datos de cuenta*/
      if(isset($_POST['id_edit']) && isset($_POST['usuario']) && isset($_POST['clave'])){
         $id_edit=MysqlQuery::RequestPost('id_edit');
         $usuario_update=MysqlQuery::RequestPost('usuario');
         $clave_update=md5(MysqlQuery::RequestPost('clave'));
         $clave_update2=MysqlQuery::RequestPost('clave');
         $nombre_update=MysqlQuery::RequestPost('nombre');
         $apellidos_update=MysqlQuery::RequestPost('apellidos'); 
         $titulo_update=MysqlQuery::RequestPost('titulo');
         $departamento_update=MysqlQuery::RequestPost('departamento');
         $puesto_update=MysqlQuery::RequestPost('puesto');
         $colonia_update=MysqlQuery::RequestPost('colonia');
         $direccion_update=MysqlQuery::RequestPost('direccion');
         $telefono_update=MysqlQuery::RequestPost('telefono');
         $tsangre_update=MysqlQuery::RequestPost('sangre');
         $nss_update=MysqlQuery::RequestPost('nss');
         $civil_update=MysqlQuery::RequestPost('estado_civil');
           

                 
            $sql=("UPDATE usuario AS U
              INNER JOIN empleado_laboral AS EL ON   U.id_laboral = EL.idlaboral
  INNER  JOIN puestos AS P ON   EL.id_puesto = P.id_puesto
 INNER  JOIN departamento AS D ON  P.id_depa = D.id_departamento
  INNER JOIN grado_estudio AS GE ON EL.id_grado = GE.id_grado 
  INNER  JOIN empleado_personal AS EP ON  U.id_personal = EP.idpersonal
  INNER  JOIN estado_civil AS E ON  EP.id_civil = E.id_civil
  INNER  JOIN genero AS G ON  EP.id_genero = G.id_genero
  INNER  JOIN tipo_sangre AS T ON EP.id_sangre = T.id_sangre 
  INNER  JOIN contacto_emergencia AS CE ON U.id_emergencia
            SET U.usuario='$usuario_update',U.clave='$clave_update', EL.nombre='$nombre_update', EL.apellidos='$apellidos_update', EL.nss='$nss_update', P.id_puesto='$puesto_update', D.id_departamento='$departamento_update', GE.id_grado='$titulo_update',  EP.colonia='$colonia_update', EP.direccion='$direccion_update',EP.id_sangre='$tsangre_update',EP.id_civil='$civil_update', EP.telefono='$telefono_update'
            WHERE idusuario = '$id_edit'");
          $query_update = mysqli_query($con,$sql);
        if ($query_update){
       /*  
         //Importamos las variables del formulario    && isset($_POST['titulo']) && isset($_POST['departamento']) && isset($_POST['puesto']) && isset($_POST['colonia']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['sangre']) && isset($_POST['nss'])
         
         
            if(MysqlQuery::Actualizar("usuario", "nombre='$nombre_update', apellidos='$apellidos_update',usuario='$usuario_update', clave='$clave_update',colonia='$colonia_update', direccion='$direccion_update', tipo_sangre='$tsangre_update', telefono='$telefono_update', nss='$nss_update', id_titulo='$titulo_update', id_departamento=' $departamento_update', id_puesto=' $puesto_update'", "idusuario='$id_edit'")){
         
         
            $email_update=MysqlQuery::RequestPost('correo');
         $titulo_update=MysqlQuery::RequestPost('titulo');
         $departamento_update=MysqlQuery::RequestPost('departamento');
         $puesto_update=MysqlQuery::RequestPost('puesto');
         $colonia_update=MysqlQuery::RequestPost('colonia');
         $direccion_update=MysqlQuery::RequestPost('direccion');
         $telefono_update=MysqlQuery::RequestPost('telefono');
         $tsangre_update=MysqlQuery::RequestPost('sangre');
         $nss_update=MysqlQuery::RequestPost('nss');
         
         
         
         
         
         / /
			
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
            $_SESSION['clave']=$new_pass_update; */

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
	     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM usuario WHERE idusuario = '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

?>
	 <?php
  $query = Mysql::consulta("SELECT U.idusuario,GE.grado ,EL.nombre,EL.apellidos,U.email_usuario,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,
EP.direccion,D.departamento,P.puesto,T.sangre,EP.telefono,EP.colonia,EP.edad,EP.fecha_naci,E.estado_civil,EL.nss,EL.f_alta_el,EP.fecha_ingreso,U.fecha_update,
CE.nombre_eme,CE.apellidos_eme,CE.colonia_eme,CE.direccion_eme,CE.telefono_eme,CE.telefono_eme2 
FROM  usuario AS U
  LEFT JOIN rol AS R ON U.rol = R.idrol
  LEFT JOIN empleado_laboral AS EL ON   U.id_laboral = EL.idlaboral
  LEFT JOIN puestos AS P ON   EL.id_puesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento
  LEFT JOIN grado_estudio AS GE ON EL.id_grado = GE.id_grado 
  LEFT JOIN empleado_personal AS EP ON  U.id_personal = EP.idpersonal
  LEFT JOIN estado_civil AS E ON  EP.id_civil = E.id_civil
  LEFT JOIN genero AS G ON  EP.id_genero = G.id_genero
  LEFT JOIN tipo_sangre AS T ON EP.id_sangre = T.id_sangre 
  LEFT JOIN contacto_emergencia AS CE ON U.id_emergencia = CE.idemergencia
  WHERE idusuario = '$id'");  
	$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
 ?>
 <?php
  $pues = Mysql::consulta("SELECT id_puesto, puesto FROM puestos");   
 ?>
 <?php
   $depa = Mysql::consulta("SELECT id_departamento, departamento FROM departamento");   
 ?>
 <?php
   $titu = Mysql::consulta("SELECT id_grado, grado FROM grado_estudio");   
 ?>
<?php
   $sangre = Mysql::consulta("SELECT id_sangre,sangre FROM tipo_sangre");   
 ?>
<?php
   $civil = Mysql::consulta("SELECT id_civil,estado_civil FROM estado_civil");   
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
   Editar de Usuario
        <small>LA Y GRIEGA</small>
      </h1>
       <ol class="breadcrumb">
        <li><a href="./admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Administrar Usuarios</li>
        <li><a href="./admin.php?view=usuarios"> Lista de Usuarios</a></li>
        <li class="active">Editar Usuarios</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
          <!-- /.box -->
        <div class="row">
 <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="img/profiles/<?php echo $reg['foto_perfil']?>" alt="User profile picture">

              <h3 class="profile-username text-center text-color"><?php echo utf8_encode($row['grado']); ?> <?php echo utf8_encode($row['nombre']); ?> <?php echo utf8_encode($row['apellidos']); ?></h3>

              <p class="text-muted text-center"><?php echo utf8_encode ($row['departamento'])?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Tickets</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Reporte Diario</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Actividades</b> <a class="pull-right">13,287</a>
                </li>
                       <li class="list-group-item">
                  <b>Configuracion</b> <a class="pull-right">100 %</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informacion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Puesto</strong>

              <p class="text-muted">
            <?php echo utf8_encode ($row['puesto'])?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Direccion y telefono</strong>

              <p class="text-muted"><?php echo utf8_encode ($row['direccion'])?>   </p>   <span class="label label-primary"><i class="fa fa-phone margin-r-5"></i> <?php echo utf8_encode ($row['telefono'])?></span>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Nuemro de Seguro Social y Tipo de Sangre</strong>

              <p>
                <span class="label label-info"><?php echo utf8_encode ($row['nss'])?></span>  <span class="label label-danger"><?php echo utf8_encode ($row['sangre'])?></span>
              </p>
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Contactos de Emergencia</strong>

              <p>Default</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Editar</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                          <hr>
                    <form role="form" class="form-horizontal" accept-charset="utf-8" action="" method="POST" >
                         <input type="hidden" name="id_edit" value="<?php echo $reg['idusuario']?>">
            <div class="col-md-4">
              <!-- /.form-group -->
              <div class="form-group">
                             <label class="col-md-2 control-label">ID</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="<?php echo $reg['idusuario']; ?>"  readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>
                   </div>
                 <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Email</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="<?php echo $reg['email_usuario']; ?>"  readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                <div class="col-md-4">
              <!-- /.form-group -->
              <div class="form-group">
                             <label class="col-md-2 control-label">Registro</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="<?php echo $reg['fecha_alta_sis']; ?>"  readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>
                   </div>
                                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Rol</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="<?php echo utf8_encode($row['rol']); ?>" readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
              
                    <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Usuario</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="usuario" type="text" value="<?php echo utf8_encode($reg['usuario']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
              
                 <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Cambio pass</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="clave" type="password" value="" required>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                    <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Nombre</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="nombre" type="text" value="<?php echo utf8_encode($row['nombre']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Apellidos</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="apellidos" type="text" value="<?php echo utf8_encode($row['apellidos']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                                       <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Titulo</label>
                            <div class='col-sm-8'>
                                      <div class="input-group">
                                    <select class="form-control" name="titulo">
                                      <option value="<?php echo $row['id_grado']?>"><?php echo utf8_encode ($row['grado'])?>  (Actual)</option>
                                    <?php while($gra = mysqli_fetch_array($titu))   
                                             { ?>
                                  <option value="<?php echo $gra['id_grado'] ?>"><?php echo utf8_encode($gra['grado']) ?></option>
                                 <?php }   ?>
                                </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                   </div>
              </div>
                        <div class="col-md-4">
                              <div class="form-group">
                             <label class="col-md-2 control-label">Depto</label>
                            <div class='col-sm-8'>
                                  <div class="input-group">
                                    <select class="form-control" name="departamento">
                                     <option value="<?php echo $row['id_departamento']?>"><?php echo utf8_encode ($row['departamento'])?> (Actual)</option>
                                    <?php
                                        while($dep = mysqli_fetch_array($depa)) {?>
                                  <option value="<?php echo $dep['id_departamento'] ?>"><?php echo utf8_encode($dep['departamento']) ?></option>
                                 <?php }  ?>
                                </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div> </div>
                   </div>
                  <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Puesto</label>
                            <div class='col-sm-8'>
                                    <div class="input-group">
                                    <select class="form-control" name="puesto">
                                  <option value="<?php echo $row['id_puesto']?>"><?php echo utf8_encode ($row['puesto'])?> (Actual)</option>
                                    <?php
                                        while($reg = mysqli_fetch_array($pues )) {?>
                                  <option value="<?php echo $reg['id_puesto'] ?>"><?php echo utf8_encode($reg['puesto']) ?></option>
                                 <?php  }  ?>
                                </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                   </div>
              </div>
                 <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Colonia</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="colonia" type="text" value="<?php echo utf8_encode($row['colonia']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
              <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Direccion</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="direccion" type="text" value="<?php echo utf8_encode($row['direccion']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                      <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Telefono</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="telefono" type="text" value="<?php echo utf8_encode($row['telefono']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">ECivil</label>
                                  <div class='col-sm-8'>
                                    <div class="input-group">
                                    <select class="form-control" name="estado_civil">
                                  <option value="<?php echo $row['id_civil']?>"><?php echo utf8_encode ($row['estado_civil'])?> (Actual)</option>
                                    <?php
                                        while($reg = mysqli_fetch_array($civil)) {?>
                                  <option value="<?php echo $reg['id_civil'] ?>"><?php echo utf8_encode($reg['estado_civil']) ?></option>
                                 <?php  }  ?>
                                </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                                 <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">NSS</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="nss" type="text" value="<?php echo utf8_encode($row['nss']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>
                                     
                </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Sangre</label>
                                  <div class='col-sm-8'>
                                    <div class="input-group">
                                    <select class="form-control" name="sangre">
                                  <option value="<?php echo $row['id_sangre']?>"><?php echo utf8_encode ($row['sangre'])?> (Actual)</option>
                                    <?php
                                        while($reg = mysqli_fetch_array($sangre )) {?>
                                  <option value="<?php echo $reg['id_sangre'] ?>"><?php echo utf8_encode($reg['sangre']) ?></option>
                                 <?php  }  ?>
                                </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                       <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./admin.php?view=usuarios" class="btn btn-sm btn-success"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                            </div>
                      </div>
              	</form>
             
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
            
        <!-- /.col -->
    </div>   <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    <?php include "./inc/footer.php"; ?> 
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
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=usuarios"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>
    