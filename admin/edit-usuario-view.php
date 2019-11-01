<?php include './lib/config2.php'; if(!$_SESSION['email']=="" && $_SESSION['rol']=="2"){ ?>
<?php include('./sentencias/consulta.php');?>
                        <?php
           $id = intval($_GET['id']);
			$sql = mysqli_query($con, "SELECT * FROM  usuario AS U
  LEFT JOIN rol AS R ON U.rol = R.idrol
 LEFT JOIN empleado_laboral AS EL ON  EL.idusuario = U.idusuario 
  LEFT JOIN puestos AS P ON   EL.idpuesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento
  LEFT JOIN grado_estudio AS GE ON EL.idgrado = GE.id_grado 
  LEFT JOIN empleado_personal AS EP ON   EP.idusuario = U.idusuario 
  LEFT JOIN estado_civil AS E ON  EP.idcivil = E.id_civil
  LEFT JOIN genero AS G ON  EP.idgenero = G.id_genero
  LEFT JOIN tipo_sangre AS T ON EP.idsangre = T.id_sangre 
  LEFT JOIN contacto_emergencia AS CE ON U.idusuario = CE.idusuario
  WHERE U.idusuario = '$id'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$user = mysqli_fetch_assoc($sql);
			}
			?>
 <?php

//Get all departamento data
$query = mysqli_query($con,"SELECT * FROM departamento WHERE estatus_dep = 1 LIMIT 1,12");

//Count total number of rows
$rowCount = $query-> num_rows;
?>



      <?php
if(isset($_POST['update'])){
				$id			= intval($_POST['id']);
                $usuario_update = mysqli_real_escape_string($con,(strip_tags($_POST['usuario'], ENT_QUOTES)));
                $clave_update  	= md5(mysqli_real_escape_string($con,(strip_tags($_POST['clave'], ENT_QUOTES))));
                $clave_update2  	= mysqli_real_escape_string($con,(strip_tags($_POST['clave'], ENT_QUOTES)));
    
    
        		$update = mysqli_query($con, "UPDATE usuario as U
            SET U.usuario='$usuario_update', U.clave='$clave_update' WHERE U.idusuario='$id'") or die(mysqli_error($con)); 
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

   <?php
                                                                                        
if(isset($_POST['update2'])){
				$id			= intval($_POST['id']);
    
    	        $nombre_update	= mysqli_real_escape_string($con,(strip_tags($_POST['nombre'], ENT_QUOTES)));
				$apellidos_update  	= mysqli_real_escape_string($con,(strip_tags($_POST['apellidos'], ENT_QUOTES)));
				$nss_update		= mysqli_real_escape_string($con,(strip_tags($_POST['nss'], ENT_QUOTES)));
                $grado_update		= mysqli_real_escape_string($con,(strip_tags($_POST['titulo'], ENT_QUOTES)));
                $puesto_update		= mysqli_real_escape_string($con,(strip_tags($_POST['puesto'], ENT_QUOTES)));
                $g_update		= mysqli_real_escape_string($con,(strip_tags($_POST['genero'], ENT_QUOTES))); 
                $fn_update	 = strtotime($_POST['fn']);
                $inicio = date('Y-m-d',$fn_update);
                $cp_update		= mysqli_real_escape_string($con,(strip_tags($_POST['cp'], ENT_QUOTES))); 
                $curp_update		= mysqli_real_escape_string($con,(strip_tags($_POST['curp'], ENT_QUOTES))); 
                $c_update		= mysqli_real_escape_string($con,(strip_tags($_POST['colonia'], ENT_QUOTES))); 
                $d_update		= mysqli_real_escape_string($con,(strip_tags($_POST['direccion'], ENT_QUOTES)));
                $t_update		= mysqli_real_escape_string($con,(strip_tags($_POST['telefono'], ENT_QUOTES)));
                $vicil_update		= mysqli_real_escape_string($con,(strip_tags($_POST['e_civil'], ENT_QUOTES)));
                $sangre_update		= mysqli_real_escape_string($con,(strip_tags($_POST['sangre'], ENT_QUOTES)));
                $generto_update		= mysqli_real_escape_string($con,(strip_tags($_POST['puesto'], ENT_QUOTES)));
               
				
        		$update2 = mysqli_query($con, "UPDATE usuario AS U
            LEFT JOIN empleado_laboral AS EL ON   U.idusuario = EL.idusuario
             LEFT JOIN empleado_personal AS EP ON  U.idusuario = EP.idusuario
            SET EL.idgrado='$grado_update' ,EL.nombre='$nombre_update', EL.apellidos='$apellidos_update', EL.nss='$nss_update', EP.telefono='$t_update', EP.colonia='$c_update', EP.direccion='$d_update', EP.cp='$cp_update', EP.curp='$curp_update', EP.fecha_naci='$inicio', EL.idpuesto='$puesto_update', EP.idcivil='$vicil_update',  EP.idgenero='$g_update', EP.idsangre='$sangre_update' WHERE U.idusuario='$id'") or die(mysqli_error($con)); 
				if($update2){
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
   <?php                                                                                      
if(isset($_POST['update3'])){
				$id			= intval($_POST['id']);
    
    	        $pa_update	= mysqli_real_escape_string($con,(strip_tags($_POST['parentesco_eme'], ENT_QUOTES)));
				$nom_update  	= mysqli_real_escape_string($con,(strip_tags($_POST['nombre_eme'], ENT_QUOTES)));
				$t_update		= mysqli_real_escape_string($con,(strip_tags($_POST['telefono_eme'], ENT_QUOTES)));
                $d_update		= mysqli_real_escape_string($con,(strip_tags($_POST['direccion_eme'], ENT_QUOTES)));
                $c_update		= mysqli_real_escape_string($con,(strip_tags($_POST['colonia_eme'], ENT_QUOTES)));
                $ci_update		= mysqli_real_escape_string($con,(strip_tags($_POST['ciudad_eme'], ENT_QUOTES)));
                $pa2_update	= mysqli_real_escape_string($con,(strip_tags($_POST['parentesco_eme2'], ENT_QUOTES)));
				$nom2_update  	= mysqli_real_escape_string($con,(strip_tags($_POST['nombre_eme2'], ENT_QUOTES)));
				$t2_update		= mysqli_real_escape_string($con,(strip_tags($_POST['telefono_eme2'], ENT_QUOTES)));
                $d2_update		= mysqli_real_escape_string($con,(strip_tags($_POST['direccion_eme2'], ENT_QUOTES)));
                $c2_update		= mysqli_real_escape_string($con,(strip_tags($_POST['colonia_eme2'], ENT_QUOTES)));
                $ci2_update		= mysqli_real_escape_string($con,(strip_tags($_POST['ciudad_eme2'], ENT_QUOTES)));
				
				
        		$update3 = mysqli_query($con, "UPDATE usuario AS U
             LEFT JOIN contacto_emergencia AS CE ON  U.idusuario = CE.idusuario
            SET CE.Parentesco_eme='$pa_update' ,CE.nombre_eme='$nom_update', CE.telefono_eme='$t_update', CE.direccion_eme='$d_update', CE.colonia_eme='$c_update', CE.ciudad_eme='$ci_update', CE.parentesco_eme2='$pa2_update' ,CE.nombre_eme2='$nom2_update', CE.telefono_eme2='$t2_update', CE.direccion_eme2='$d2_update', CE.colonia_eme2='$c2_update', CE.ciudad_eme2='$ci2_update' WHERE U.idusuario='$id'") or die(mysqli_error($con)); 
				if($update3){
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
                <li class="active"><a href="#activity" data-toggle="tab">Editar Datos de Usuario</a></li>
              <li><a href="#timeline" data-toggle="tab">Datos Personales</a></li>
              <li><a href="#settings" data-toggle="tab">Datos Emergencia</a></li>
                
                
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                        <form name="form1" id="form1" class="form-horizontal row-fluid" action="" method="POST" >
                         <input type="hidden" name="id" id="id" value="<?php echo $user['idusuario']?>">
       
                   
                            
                           <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">ID</label>

                    <div class="col-sm-10">
                  <input class="form-control"  type="text" value="<?php echo utf8_encode($user['idusuario']); ?>" readonly>
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Fecha de Registro</label>

                    <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo $user['fecha_alta_sis']; ?>"  readonly>
                    </div>
                  </div>
                            <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Correo Coorporativo</label>

                    <div class="col-sm-10">
                  <input class="form-control"  type="text" value="<?php echo utf8_encode($user['email_usuario']); ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Rol de Usuario</label>

                    <div class="col-sm-10">
                  <input class="form-control"  type="text" value="<?php echo utf8_encode($user['rol']); ?>" readonly>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10">
                  <input class="form-control" name="usuario" type="text" value="<?php echo utf8_encode($user['usuario']); ?>">
                    </div>
                  </div>
                      <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nueva Contraseña</label>
                    <div class="col-sm-10">
                  <input class="form-control" name="clave" type="password" value="" required>
                    </div>
                  </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                 <button type="submit" class="btn btn-sm btn-primary pull-right" name="update2" id="update2"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./admin.php?view=usuarios" class="btn btn-sm btn-success"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                            </div>
                      </div>
              	</form>
             
              </div>
              <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                <!-- The timeline -->
               <form class="form-horizontal" action="" method="POST">
                   <input type="hidden" name="id" id="id" value="<?php echo $user['idusuario']?>">
                    
                   
                         <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Titulo</label>
                            <div class='col-sm-8'>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                    <select class="form-control" name="titulo">
                                      <option value="<?php echo $user['idgrado']?>"><?php echo utf8_encode($user['grado'])?>  (Actual)</option>
                               <?php 
                                                $ti = Mysql::consulta ("SELECT * FROM grado_estudio LIMIT 1,9");
                                                while ($valores = mysqli_fetch_array($ti)){
                                                echo "<option value='".$valores['id_grado']."'>".$valores['grado']."</option>";
                                                    }?>
                                </select>
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
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
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
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
            
                     <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Depto</label>
                            <div class='col-sm-8'>
                                    <div class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                            <select class="form-control" id="departamento">
   <option value="<?php echo $user['id_departamento']?>"><?php echo utf8_encode ($user['departamento'])?>  (Actual)</option>
    <?php
    if($rowCount > 0){
         
        while($row = mysqli_fetch_array($query)){ 
            echo '<option value="'.$row['id_departamento'].'">'.utf8_encode($row['departamento']).'</option>';
        }}
    ?>
</select>
                                </div>
                            </div>
                   </div>
              </div>
                  <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Puesto</label>
                            <div class='col-sm-8'>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                    <select class="form-control" name="puesto" id="puesto">
    <option value="<?php echo $user['idpuesto']?>"><?php echo utf8_encode ($user['puesto'])?>  (Actual)</option>
</select>
                                </div>
                            </div>
                   </div>
              </div>
                                            <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Genero</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                       <span class="input-group-addon"><i class="fa fa-child"></i></span>
                                       <select class="form-control" name="genero">
                                  <option value="<?php echo $user['idgenero']?>"><?php echo utf8_encode ($user['genero'])?> (Actual)</option>
                                    <?php 
                                                $civil = Mysql::consulta ("SELECT * FROM genero LIMIT 1,3");
                                                while ($e_civil = mysqli_fetch_array($civil)){
                                                echo "<option value='".$e_civil['id_genero']."'>".$e_civil['genero']."</option>";
                                                    }?>
                                </select>
                                </div>
                            </div>
                   </div>  
                </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">F. Nac</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="fn" type="date" value="<?php echo utf8_encode($user['fecha_naci']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                 <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">ECivil</label>
                                  <div class='col-sm-8'>
                                    <div class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                    <select class="form-control" name="e_civil">
                                  <option value="<?php echo $user['idcivil']?>"><?php echo utf8_encode ($user['estado_civil'])?> (Actual)</option>
                                    <?php 
                                                $civil = Mysql::consulta ("SELECT * FROM estado_civil LIMIT 1,8");
                                                while ($e_civil = mysqli_fetch_array($civil)){
                                                echo "<option value='".$e_civil['id_civil']."'>".$e_civil['estado_civil']."</option>";
                                                    }?>
                                </select>
                                </div>
                            </div>
                   </div>  
                </div>
        
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Sangre</label>
                                  <div class='col-sm-8'>
                                    <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-heartbeat"></i></span>
                                    <select class="form-control" name="sangre">
                                  <option value="<?php echo $user['id_sangre']?>"><?php echo utf8_encode ($user['sangre'])?> (Actual)</option>
                                    <?php
                                    $san = Mysql::consulta ("SELECT * FROM tipo_sangre LIMIT 1,9");
                                                while ($valores = mysqli_fetch_array($san)){
                                                echo "<option value='".$valores['id_sangre']."'>".$valores['sangre']."</option>";
                                                    }?>
                                </select>
                                </div>
                            </div>
                   </div>  
                </div>
     
                            <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Curp</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="curp" type="text" value="<?php echo utf8_encode($user['curp']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
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
                             <label class="col-md-2 control-label">Telefono</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="telefono" type="text" value="<?php echo utf8_encode($user['telefono']); ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
        
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Calle</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="direccion" type="text" value="<?php echo utf8_encode($user['direccion']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">No</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="direccion" type="text" value="<?php echo utf8_encode($user['direccion']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
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
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
             <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">Ciudad</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="colonia" type="text" value="<?php echo utf8_encode($user['colonia']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                <div class="col-md-4">
                 <div class="form-group">
                             <label class="col-md-2 control-label">CP</label>
                            <div class='col-sm-8'>
                                <div class="input-group">
                                    <input class="form-control" name="cp" type="text" value="<?php echo utf8_encode($user['cp']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
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
                                    <span class="input-group-addon"><i class="fa fa-road "></i></span>
                                </div>
                            </div>
                   </div>  
                </div>
                   
                   
                   
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                       <button type="submit" class="btn btn-sm btn-primary pull-right" name="update2" id="update2"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./admin.php?view=usuarios" class="btn btn-sm btn-success"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                            </div>
                      </div>
                </form>
              </div>
              <!-- /.tab-pane -->
                   <!-- /.tab-pane -->
  <br>
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="" method="POST">
                   <input type="hidden" name="id" id="id" value="<?php echo $user['idusuario']?>">                
                               <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Parentesco</label>
                <div class="col-sm-10">
                    <div class="input-group">
                                 <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>  
                <input class="form-control" name="parentesco_eme" type="text" value="<?php echo utf8_encode($user['parentesco_eme']); ?>">      
                </div> 
                </div></div>
                       <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre completo</label>
                    <div class="col-sm-10">
                               <div class="input-group">
                              <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>  
                  <input class="form-control" name="nombre_eme" type="text" value="<?php echo utf8_encode($user['nombre_eme']); ?>">
                    </div>
                  </div></div>
                    
                    
                      <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-10">
                               <div class="input-group">
                              <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>  
                  <input class="form-control" name="telefono_eme" type="text" value="<?php echo utf8_encode($user['telefono_eme']); ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                  </div></div>
                            <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>
                    <div class="col-sm-10">
                               <div class="input-group">
                              <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>  
                  <input class="form-control" name="direccion_eme" type="text" value="<?php echo utf8_encode($user['direccion_eme']); ?>">
                    </div>
                      </div>           
                  </div>
                                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Colonia</label>
                    <div class="col-sm-10">
                                    <div class="input-group">
                              <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input class="form-control" name="colonia_eme" type="text" value="<?php echo utf8_encode($user['colonia_eme']); ?>">
                    </div>
                  </div>  </div>
                                     <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Ciudad</label>
                    <div class="col-sm-10">
                                    <div class="input-group">
                              <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input class="form-control" name="ciudad_eme" type="text" value="<?php echo utf8_encode($user['ciudad_eme']); ?>">
                    </div>
                  </div>  </div>
                     <h4 class="page-header">Datos de Emergercia 2</h4>
                               <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Parentesco</label>
                <div class="col-sm-10">
                    <div class="input-group">
                            
                <input class="form-control" name="parentesco_eme2" type="text" value="<?php echo utf8_encode($user['parentesco_eme2']); ?>">
                     <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>      
                </div> 
                </div></div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre completo</label>
                    <div class="col-sm-10">
                    <div class="input-group">
                  <input class="form-control" name="nombre_eme2" type="text" value="<?php echo utf8_encode($user['nombre_eme2']); ?>">
                          <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>      
                </div> 
                </div></div>
                      <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-10">
                                    <div class="input-group">
                  <input class="form-control" name="telefono_eme2" type="text" value="<?php echo utf8_encode($user['telefono_eme2']); ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                 <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    </div>
                  </div>  </div>
                            <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>
                    <div class="col-sm-10">
                                    <div class="input-group">
                  <input class="form-control" name="direccion_eme2" type="text" value="<?php echo utf8_encode($user['direccion_eme2']); ?>">
                                                 <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    </div>
                  </div>  </div>
                                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Colonia</label>
                    <div class="col-sm-10">
                                    <div class="input-group">
                  <input class="form-control" name="colonia_eme2" type="text" value="<?php echo utf8_encode($user['colonia_eme2']); ?>">
                                                 <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    </div>
                  </div>  </div>
                                     <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Ciudad</label>
                    <div class="col-sm-10">
                                    <div class="input-group">
                  <input class="form-control" name="ciudad_eme2" type="text" value="<?php echo utf8_encode($user['ciudad_eme2']); ?>">
                                                 <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    </div>
                  </div>  </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                       <button type="submit" class="btn btn-sm btn-primary pull-right" name="update3" id="update3"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
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

        <!-- /.col -->
  
  <!-- /.content-wrapper -->
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


    