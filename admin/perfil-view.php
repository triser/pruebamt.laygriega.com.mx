<?php if($_SESSION['email']!="" && $_SESSION['rol']){ ?> 
<?php include('./sentencias/consulta.php');?>
<?php 
            $idA=$_SESSION['id'];
            /* Todos los admins*/
        $users= Mysql::consulta("SELECT * FROM  usuario AS U
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
  WHERE U.idusuario='$idA'");
	$reg=mysqli_fetch_array($users, MYSQLI_ASSOC);
        ?>
<div class="wrapper">

  <!-- Main Header -->
  <?php include "./inc/main-header.php"; ?>  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include "./inc/main-sidebar.php"; ?>  
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    MI PERFIL
        <small>LA Y GRIEGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Configuracion</li>
        <li class="active">Perfil</li>
      </ol>
    </section>
  
    <!-- Main content -->
    <section class="content">
            <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
                            <img class="thumb-image" style="width: 100%; display: block;" src="img/profiles/<?php echo utf8_encode($_SESSION['foto_perfil']); ?>" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                         <label><?php echo $reg['grado']?> <?php echo $reg['nombre']?> <?php echo $reg['apellidos']?></label>
                                    </h5>
                                    <h6>
                                      <?php echo utf8_encode ($reg['departamento'])?>
                                    </h6>
                                    <h6>
                                      <?php echo utf8_encode ($reg['puesto'])?>
                                    </h6>
                        </div>
                    </div>
                    <div class="col-md-2">
                          <a href="admin.php?view=actualizacion-cuenta" 
                                            class="btn btn-sm btn btn-info red-tooltip" data-toggle="tooltip" data-placement="right" id="tooltipex" title="Editar Perfil"><span class="glyphicon glyphicon-edit"></span> Editar Perfil</a>
                    </div>
                </div>
                <div class="row">
                    <br>
                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['idusuario']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nombre</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['nombre']?></p>
                                            </div>
                                        </div>           
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Apellidos</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p> <?php echo $reg['apellidos']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['email_usuario']?></p>
                                            </div>
                                        </div>
                              <div class="row">
                                            <div class="col-md-6">
                                                <label>Fecha de Alta sistema:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['fecha_alta_sis']?></p>
                                            </div>
                                        </div>
                          <div class="row">
                                            <div class="col-md-6">
                                                <label>Departamento</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['departamento']?></p>
                                            </div>
                                        </div>
                          <div class="row">
                                            <div class="col-md-6">
                                                <label>Puesto</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['puesto']?></p>
                                            </div>
                                        </div>
                           <div class="row">
                                            <div class="col-md-6">
                                                <label>Rol</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['rol']?></p>
                                            </div>
                                        </div> 
                          <div class="row">
                                            <div class="col-md-6">
                                                <label>Estatus</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['estatus']?></p>
                                            </div>
                                        </div> 
                        
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                              <div class="row">
                                            <div class="col-md-6">
                                                <label>Fecha de Ingreso</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $reg['fecha_ingreso']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>N. de Seguro Social</label>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo $reg['nss']?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tipo de Sangre</label>
                                            </div>
                                            <div class="col-md-6">
                                              <?php echo $reg['sangre']?>
                                            </div>
                                        </div>
                                 <div class="row">
                                            <div class="col-md-6">
                                                <label>Celular</label>
                                            </div>
                                            <div class="col-md-6">
                                              <?php echo $reg['telefono']?>
                                            </div>
                                        </div>
                                 <div class="row">
                                            <div class="col-md-6">
                                                <label>Direccion</label>
                                            </div>
                                            <div class="col-md-6">
                                              <?php echo $reg['direccion']?>
                                            </div>
                                        </div>
                              <div class="row">
                                            <div class="col-md-6">
                                                <label>Contacto de Emergencia</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p></p>
                                            </div>
                                        </div>
                           <div class="row">
                                            <div class="col-md-6">
                                                <label>Alergias</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p></p>
                                            </div>
                                        </div>
                    
                    </div>
                </div>
            </form>           
        </div>

  </div>
      </div>
           
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "./inc/footer.php"; ?> 
 
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
                <img src="img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                <img src="img/SadTux.png" alt="Image" class="img-responsive"/>
            </div>
            <div class="col-sm-7 animated flip">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios del Sitema OT LA Y GRIEGA</h1>
                <h3 class="text-info text-center"><a href="index.php"> Inicia sesión para poder acceder</a></h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>
<!-- ./wrapper -->
