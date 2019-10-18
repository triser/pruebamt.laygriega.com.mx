<?php include './lib/config2.php'; if(!$_SESSION['email']=="" && !$_SESSION['rol']==""){ ?>
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
            INNER JOIN empleado_laboral AS EL ON U.id_laboral = EL.idlaboral
            INNER JOIN empleado_personal AS EP ON U.id_personal = EP.idpersonal
            SET U.usuario='$usuario_update',U.clave='$clave_update', EL.nombre='$nombre_update', EL.apellidos='$apellidos_update', EL.nss='$nss_update', EL.id_puesto='$puesto_update', EL.id_departamento='$departamento_update', EL.id_grado='$titulo_update',  EP.colonia='$colonia_update', EP.direccion='$direccion_update',EP.id_sangre='$tsangre_update',EP.id_civil='$civil_update', EP.telefono='$telefono_update'
            WHERE idusuario = '$id_edit'");
          $query_update = mysqli_query($con,$sql);
        if ($query_update){
       /*  

			
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
	$sql = Mysql::consulta(" SELECT U.idusuario,GE.grado ,EL.nombre,EL.apellidos,U.email_usuario,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,
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
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

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
   $san = Mysql::consulta("SELECT id_sangre,sangre FROM tipo_sangre");   
 ?>
<?php
   $civ = Mysql::consulta("SELECT id_civil,estado_civil FROM estado_civil");   
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
        <li class="active">Editar perfil</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
         <!-- SELECT  -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Perfil</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
          <div class="row">
                    <div class="col-md-4">
                        <div class="image view view-first">
                            <img class="thumb-image" style="width: 100%; display: block;" src="img/profiles/<?php echo $reg['foto_perfil']?>" alt="image" />
                        </div>
                        <span class="btn btn-my-button btn-file">
                            <form method="post" id="formulario" enctype="multipart/form-data">
                                 <input type="hidden" name="id_edit" value="<?php echo $reg['idusuario']?>">
                            Cambiar Imagen de perfil: <input type="file" name="file">
                            </form>
                        </span>
                        <div id="respuesta"></div>
                    </div>
                <!-- form start -->
          <form role="form" class="form-horizontal" accept-charset="utf-8" action="" method="POST" >
            <div class="box-body">
                <input type="hidden" name="id_edit" value="<?php echo $reg['idusuario']?>">
                      <div class="col-md-4">
              <div class="form-group">
                          
                      <label class="col-md-2 control-label">ID</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="<?php echo $reg['idusuario']; ?>"  readonly="">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
              </div>  </div>
            <div class="col-md-4">
              <div class="form-group">
                          
                      <label class="col-md-2 control-label">Correo</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" readonly value="<?php echo $reg['email_usuario']; ?>">

                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
              </div>  </div>
                 <div class="col-md-4">
              <!-- /.form-group -->
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
                             <label class="col-md-2 control-label">Contraseña</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                       <input class="form-control" name="clave" type="password" readonly value="<?php echo utf8_encode($reg['clave']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                            <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label text-primary">N Pass</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                   <input type="password" class="form-control" placeholder="Nueva Contraseña" name="clave" required="">
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
                                    <input class="form-control" name="nombre" type="text" value="<?php echo utf8_encode($reg['nombre']); ?>" readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>  </div>
                 <div class="col-md-4">
                              <div class="form-group">
                             <label class="col-md-2 control-label">Apellidos</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="apellidos" type="text" value="<?php echo utf8_encode($reg['apellidos']); ?>" readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div></div>
                 <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Titulo</label>
                            <div class='col-sm-8'>
                                      <div class="input-group">
                                <input class="form-control" name="titulo" type="text" readonly value="<?php echo utf8_encode($reg['grado']); ?> ">
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
                                 <input class="form-control" name="departamento" type="text" readonly value="<?php echo utf8_encode($reg['departamento']); ?> ">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div> </div>
                   </div>
                  <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Puesto</label>
                            <div class='col-sm-8'>
                                    <div class="input-group">
                                 <input class="form-control" name="puesto" type="text" readonly value="<?php echo utf8_encode($reg['puesto']); ?> ">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                   </div>
              </div>
                                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">E Civil</label>
                            <div class='col-sm-8'>
                                    <div class="input-group">
                                    <select class="form-control" name="estado_civil">
                                  <option value="<?php echo $reg['id_civil']?>"><?php echo utf8_encode ($reg['estado_civil'])?> (Actual)</option>
                                    <?php
                                        while($civil = mysqli_fetch_array($civ)) {?>
                                  <option value="<?php echo $civil['id_civil'] ?>"><?php echo utf8_encode($civil['estado_civil']) ?></option>
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
                                    <input class="form-control" name="colonia" type="text" value="<?php echo utf8_encode($reg['colonia']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>     </div>
                          <div class="col-md-4">
                              <div class="form-group">
                             <label class="col-md-2 control-label">Direccion</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                 <input class="form-control" name="direccion" type="text" value="<?php echo utf8_encode($reg['direccion']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                   </div>  </div>
                                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Telefono</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="telefono" type="text" value="<?php echo utf8_encode($reg['telefono']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div> </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">T Sangre</label>
                            <div class='col-sm-8'>
                               <input class="form-control" name="sangre" type="text" readonly value="<?php echo utf8_encode($reg['sangre']); ?> readonly">
                            </div>
                   </div>
              </div>
                           <div class="col-md-4">
                              <div class="form-group">
                             <label class="col-md-2 control-label">NSS</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="nss" type="text" value="<?php echo $reg['nss']; ?>" readonly>
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                   </div>
                
              </div>
             
          </div>
          <!-- /.row -->
                <div class="col-md-12">
             <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-12 text-center">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./index.php?view=perfil-usuario" class="btn btn-success"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                          </div>
                        </div> </div>
          </form>
              </div><!-- /.box footer -->
        </div>
              
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
        <!-- /.row -->
        
    </section>
    <!-- /.content -->
  </div>
        <!-- Footer -->
    <?php include "./inc/footer.php"; ?> 
       </div>
<!-- ./wrapper -->
    <script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "process/update-perfil.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });
</script>
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
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./index.php?view=perfil-usuario"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>