<?php if($_SESSION['email']!="" && $_SESSION['rol']=="2"){ ?>  
<?php include('./sentencias/consulta.php');?>
  <?php     $status='estatus'; if ($status=1){$status_f="Activo";}else {$status_f="Baja";}  ?>
        <?php 
            if(isset($_POST['id_del'])){
                $id_user=MysqlQuery::RequestPost('id_del');
                 $estatus_edit="0";
                
                if(MysqlQuery::Actualizar("usuario","estatus=' $estatus_edit'","idusuario='$id_user'")){
                    echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">USUARIO ELIMINADO</h4>
                            <p class="text-center">
                                El usuario fue eliminado del sistema con exito
                            </p>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                            <p class="text-center">
                                No hemos podido eliminar el usuario
                            </p>
                        </div>
                    ';
                }
            }

 /* Todos los tickets*/
        $num_ticket_all=Mysql::consulta("SELECT* FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario ORDER BY id DESC");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT* FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario WHERE estatus_tk='Pendiente'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT* FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario WHERE estatus_tk='En proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT* FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario WHERE estatus_tk='Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
                
                 /* Tickets resueltos*/
                $num_ticket_can=Mysql::consulta("SELECT* FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario WHERE estatus_tk='Cancelado'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
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
    Lista Usuarios
        <small>LA Y GRIEGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Administrar Usuarios</li>
        <li class="active">Registro de Usuarios</li>
      </ol>
    </section>
       <section class="content-header">
    </section>
                      <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=tickets&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todas las Ordenes&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./admin.php?view=tickets&ticket=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Ordenes pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./admin.php?view=tickets&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Ordenes en proceso&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./admin.php?view=tickets&ticket=resolved"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Ordenes resueltos&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./admin.php?view=tickets&ticket=cancelled"><i class="fa fa-minus-square"></i>&nbsp;&nbsp;Ordenes Cancelados&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_can; ?></span></a></li>
                        </ul>
                    </div>
                </div>
    <!-- Main content -->
    <section class="content">
            <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <div class="box-tools">
               <!--  <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div> -->
              </div>
                       
        <div class="btn-group">
        <a  href="./admin.php?view=alta-ticket" class="btn btn-sm btn-alta-user"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i><span>&nbsp;&nbsp;Abrir Ticket</span></a>
        </div>

        <div class="btn-group">
        <a  href="./lib/act-diaria-general.php" class="btn btn-block btn-sm btn-pdf" target="_blank"><i class="fa fa-print" aria-hidden="true"></i><span>&nbsp;&nbsp;PDF</span></a>
        </div>
            <div class="btn-group">
                <a href="javascript:location.reload()" class="btn btn-block btn-sm btn-refresh" type="button"><i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Refresh</a>

             </div>
      <div class="col-sm-2 pull-right form-group">
           <div class="input-group">
  <input id="FiltrarContenido" type="text" class="form-control" placeholder="Buscar" aria-label="buscar" aria-describedby="basic-addon1">
           <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
        </div>
  
            </div>
              
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                 <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario
     ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario
     WHERE estatus_tk='Pendiente' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario
     WHERE estatus_tk='En proceso' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario
     WHERE estatus_tk='Resuelto' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="cancelled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario
     WHERE estatus_tk='Cancelado' LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
  INNER JOIN asunto AS A ON T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON  A.idpuesto = PU.id_puesto
  INNER JOIN empleado_laboral AS EL ON  EL.idpuesto = PU.id_puesto
  INNER JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  INNER JOIN usuario AS U ON U.idusuario = EL.idusuario ORDER BY id DESC LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
                                 <table class="table table-hover">
                                  <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">F.Apertura</th>
                                        <th class="text-center" scope="col">Serie</th>
                                        <th class="text-center" scope="col">Nombre del Solicitante</th>
                                        <th class="text-center" scope="col">Estado</th>
                                         <th class="text-center" scope="col">Nombre del Destinatario</th>
                                        <th class="text-center" scope="col">Puesto Solicitado</th>
                                        <th class="text-center" scope="col">Prioridad</th>
                                        <th class="text-center" scope="col">Imagen</th>
                                        <th class="text-center" scope="col">F.Entrega</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                               <tbody  class="BusquedaRapida">
                                   <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                   <tr>
                                       <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                        <td class="text-center" data-label="F.Apertura:"><?php echo $row['fecha_alta']; ?></td>
                                        <td class="text-center" data-label="Serie:"><?php echo $row['serie']; ?></td>
                                        <td class="text-center" data-label="Nombre del Solicitante:"><?php echo $row['grado']; ?>  <?php echo $row['nombre']; ?> <?php echo $row['apellidos']; ?></td>
                                                                <td class="text-center" data-label="Estado:"><?php 
	//pintamos de colorores los estados del ticket
	switch ($row['estatus_tk'])
	{
		case "Resuelto":
		echo '<span class="btn btn-info btn-xs" disabled="disabled">'.$row["estatus_tk"].'</span>';
		break;
        case "En proceso":
        echo '<span class="btn btn-success btn-xs" disabled="disabled">'.$row["estatus_tk"].'</span>';
        break;
		case "Cancelado":
		echo '<span class="btn btn-warning btn-xs" disabled="disabled">'.$row["estatus_tk"].'</span>';
		break;
        case "Pendiente":
        echo '<span class="btn btn-danger btn-xs" disabled="disabled">'.$row["estatus_tk"].'</span>';
       break;
	}

	?>
                                         <td class="text-center" data-label="Nombre del Destinatario:"><?php echo $row['asignado']; ?></td>   
                                       <td class="text-center" data-label="Puesto Asignado:"><?php echo $row['puesto']; ?></td>             
                                       <td class="text-center" data-label="Prioridad:"><?php 
	//pintamos de colorores los estados del ticket
	switch ($row['prioridad'])
	{
		case "Urgente":
		echo '<span class="btn btn-default btn-xs" disabled="disabled" style="color:red">'.$row["prioridad"].'</span>';
		break;
        case "Medio Urgente":
        echo '<spans class="btn btn-default btn-xs" disabled="disabled" style="color:orange">'.$row["prioridad"].'</span>';
        break;
		case "No Urgente":
		echo '<span class="btn btn-default btn-xs" disabled="disabled" style="color:blue">'.$row["prioridad"].'</span>';
		break;
	}

	?>
</td>
                                        <td class="text-center" data-label="Imagen:"><a class="example-image-link" href="<?php echo $row['imagen_tk']; ?>" data-lightbox="example-set" data-title="<?php echo $row['mensaje']; ?>"><img src="<?php echo $row['imagen_tk']; ?>" width="25" height="25" class="property_img"/></a></td>
                                        <td class="text-center" data-label="F.Entrega:"><?php echo $row['fechaE']; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn btn-sm btn-danger" title="Eliminar" data-target="#exampleModalCenter<?php echo $row['id']; ?>" data-toggle="modal" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>                                                                
                                        </td>
                           
                                        
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                         <?php else: ?>
                                <h2 class="text-center">No hay Ordenes registrados en el sistema</h2>
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['ticket'])){
                                $ticketselected=$_GET['ticket'];
                            }else{
                                $ticketselected="all";
                            }
                        ?>
                      <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;&nbsp;Anterior</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=tickets&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=tickets&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=tickets&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;&nbsp;Siguiente</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=tickets&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&rarr;</span>&nbsp;Siguiente
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>

          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
  <!-- Main Footer -->
<?php include "./inc/footer.php"; ?> 
 
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
   </div>
<!-- ./wrapper -->
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
<script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
   <!-- LIGHTBOX PLUS JQUERY -->
    <script src="./js/lightbox-plus-jquery.min.js"></script>