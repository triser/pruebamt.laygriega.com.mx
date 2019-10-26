<?php include './lib/config2.php'; if(!$_SESSION['email']=="" && $_SESSION['rol']=="2"){ ?>
<?php include('./sentencias/consulta.php');?>
                        <?php
           $id = intval($_GET['id']);
			$sql = mysqli_query($con, "SELECT U.idusuario,GE.grado ,EL.nombre,EL.apellidos,U.email_usuario,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,
EP.direccion,D.departamento,P.puesto,T.sangre,EP.telefono,EP.colonia,EP.edad,EP.fecha_naci,E.estado_civil,EL.nss,EL.f_alta_el,EP.fecha_ingreso,U.fecha_update,
CE.nombre_eme,CE.apellidos_eme,CE.colonia_eme,CE.direccion_eme,CE.telefono_eme,CE.telefono_eme2 
FROM  usuario AS U
  LEFT JOIN rol AS R ON U.rol = R.idrol
  LEFT JOIN empleado_laboral AS EL ON   U.id_laboral = EL.idlaboral
  LEFT JOIN puestos AS P ON   EL.id_puesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento
  LEFT JOIN grado_estudio AS GE ON EL.idgrado = GE.id_grado 
  LEFT JOIN empleado_personal AS EP ON  U.id_personal = EP.idpersonal
  LEFT JOIN estado_civil AS E ON  EP.idcivil = E.id_civil
  LEFT JOIN genero AS G ON  EP.id_genero = G.id_genero
  LEFT JOIN tipo_sangre AS T ON EP.id_sangre = T.id_sangre 
  LEFT JOIN contacto_emergencia AS CE ON U.id_emergencia = CE.idemergencia
  WHERE idusuario = '$id'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$user = mysqli_fetch_assoc($sql);
			}
			?>
 <?php

//Get all departamento data
$query = mysqli_query($con,"SELECT * FROM departamento WHERE estatus_dep = 1");

//Count total number of rows
$rowCount = $query-> num_rows;
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

      <?php
if(isset($_POST['update'])){
				$id			= intval($_POST['id']);
                $usuario_update = mysqli_real_escape_string($con,(strip_tags($_POST['usuario'], ENT_QUOTES)));
                $clave_update  	= md5(mysqli_real_escape_string($con,(strip_tags($_POST['clave'], ENT_QUOTES))));
                $clave_update2  	= mysqli_real_escape_string($con,(strip_tags($_POST['clave'], ENT_QUOTES)));
    	        $nombre_update	= mysqli_real_escape_string($con,(strip_tags($_POST['nombre'], ENT_QUOTES)));
				$apellidos_update  	= mysqli_real_escape_string($con,(strip_tags($_POST['apellidos'], ENT_QUOTES)));
				$nss_update		= mysqli_real_escape_string($con,(strip_tags($_POST['nss'], ENT_QUOTES)));
                $grado_update		= mysqli_real_escape_string($con,(strip_tags($_POST['titulo'], ENT_QUOTES)));
             $puesto_update		= mysqli_real_escape_string($con,(strip_tags($_POST['puesto'], ENT_QUOTES)));
              $vicil_update		= mysqli_real_escape_string($con,(strip_tags($_POST['civil'], ENT_QUOTES)));
               
				
				$update = mysqli_query($con, "UPDATE usuario AS U
            LEFT JOIN empleado_laboral AS EL ON   U.id_laboral = EL.idlaboral
             LEFT JOIN empleado_personal AS EP ON  U.id_personal = EP.idpersonal
            SET U.usuario='$usuario_update', U.clave='$clave_update',EL.id_grado='$grado_update' ,EL.nombre='$nombre_update', EL.apellidos='$apellidos_update', EL.nss='$nss_update', EL.id_puesto='$puesto_update', EP.idcivil='$vicil_update' WHERE idusuario='$id'") or die(mysqli_error($con)); 
				if($update){
					echo  '
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
              <img class="profile-user-img img-responsive img-circle" src="img/profiles/<?php echo $user['foto_perfil']?>" alt="User profile picture">

              <h3 class="profile-username text-center text-color"><?php echo utf8_encode($user['grado']); ?> <?php echo utf8_encode($user['nombre']); ?> <?php echo utf8_encode($user['apellidos']); ?></h3>

              <p class="text-muted text-center"><?php echo utf8_encode ($user['departamento'])?></p>

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
            <?php echo utf8_encode ($user['puesto'])?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Direccion y telefono</strong>

              <p class="text-muted"><?php echo utf8_encode ($user['direccion'])?>   </p>   <span class="label label-primary"><i class="fa fa-phone margin-r-5"></i> <?php echo utf8_encode ($user['telefono'])?></span>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Nuemro de Seguro Social y Tipo de Sangre</strong>

              <p>
                <span class="label label-info"><?php echo utf8_encode ($user['nss'])?></span>  <span class="label label-danger"><?php echo utf8_encode ($user['sangre'])?></span>
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
                 
                        <form name="form1" id="form1" class="form-horizontal row-fluid" action="" method="POST" >
                         <input type="hidden" name="id" id="id" value="<?php echo $user['idusuario']?>">
            <div class="col-md-4">
              <!-- /.form-group -->
              <div class="form-group">
                             <label class="col-md-2 control-label">ID</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="<?php echo $user['idusuario']; ?>"  readonly>
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
                                    <input class="form-control" type="text" value="<?php echo $user['email_usuario']; ?>"  readonly>
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
                                    <input class="form-control" type="text" value="<?php echo $user['fecha_alta_sis']; ?>"  readonly>
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
                                    <input class="form-control" type="text" value="<?php echo utf8_encode($user['rol']); ?>" readonly>
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
                                    <input class="form-control" name="usuario" type="text" value="<?php echo utf8_encode($user['usuario']); ?>">
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
                                    <input class="form-control" name="clave" type="password" value="">
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
                                    <input class="form-control" name="nombre" type="text" value="<?php echo utf8_encode($user['nombre']); ?>">
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
                                    <input class="form-control" name="apellidos" type="text" value="<?php echo utf8_encode($user['apellidos']); ?>">
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
                                      <option value="<?php echo $user['id_grado']?>"><?php echo utf8_encode ($user['grado'])?>  (Actual)</option>
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
                                            <select class="form-control" id="departamento">
   <option value="<?php echo $user['id_departamento']?>"><?php echo utf8_encode ($user['departamento'])?>  (Actual)</option>
    <?php
    if($rowCount > 0){
         
        while($row = mysqli_fetch_array($query)){ 
            echo '<option value="'.$row['id_departamento'].'">'.utf8_encode($row['departamento']).'</option>';
        }
    }else{
        echo '<option value="">departamento no disponible</option>';
    }
    ?>
</select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                   </div>
              </div>
                  <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Puesto</label>
                            <div class='col-sm-8'>
                                    <div class="input-group">
                                    <select class="form-control" name="puesto" id="puesto">
    <option value="<?php echo $user['id_puesto']?>"><?php echo utf8_encode ($user['puesto'])?>  (Actual)</option>
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
                                    <input class="form-control" name="colonia" type="text" value="<?php echo utf8_encode($user['colonia']); ?>">
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
                                    <input class="form-control" name="direccion" type="text" value="<?php echo utf8_encode($user['direccion']); ?>">
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
                                    <input class="form-control" name="telefono" type="text" value="<?php echo utf8_encode($user['telefono']); ?>">
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
                                  <option value="<?php echo $user['id_civil']?>"><?php echo utf8_encode ($user['estado_civil'])?> (Actual)</option>
                                    <?php
                                        while($civ = mysqli_fetch_array($civil)) {?>
                                  <option value="<?php echo $civ['id_civil'] ?>"><?php echo utf8_encode($civ['estado_civil']) ?></option>
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
                                    <input class="form-control" name="nss" type="text" value="<?php echo utf8_encode($user['nss']); ?>">
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
                                  <option value="<?php echo $user['id_sangre']?>"><?php echo utf8_encode ($user['sangre'])?> (Actual)</option>
                                    <?php
                                        while($san = mysqli_fetch_array($sangre )) {?>
                                  <option value="<?php echo $san['id_sangre'] ?>"><?php echo utf8_encode($san['sangre']) ?></option>
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
                                       <button type="submit" class="btn btn-sm btn-primary pull-right" name="update" id="update"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                               		<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-sm btn-primary"/>
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
<script type="text/javascript">
$(document).ready(function(){
    $('#departamento').on('change',function(){
        var departamentoID = $(this).val();
        if(departamentoID){
            $.ajax({
                type:'POST',
                url:'./sentencias/select-departamento-puesto.php',
                data:'departamento_id='+departamentoID,
                success:function(html){
                    $('#puesto').html(html);
                
                }
            }); 
        }else{
            $('#puesto').html('<option value="">Seleccione puesto primero</option>');
        }
    });
    
});
</script>
   <script>

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=usuarios"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>


    