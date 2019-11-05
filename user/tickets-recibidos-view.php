<?php if($_SESSION['clave']!="" && isset($_SESSION['id'])){ $nombre_user= $_SESSION['email']; $id_clien= $_SESSION['id'];?>
<?php include('./sentencias/consulta.php');?>
         <?php
                if(isset($_POST['id_del'])){
                    $id = MysqlQuery::RequestPost('id_del');
                    if(MysqlQuery::Eliminar("ticket", "id='$id'")){
                        echo '
                            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">TICKET ELIMINADO</h4>
                                <p class="text-center">
                                    El ticket fue eliminado del sistema con exito
                                </p>
                            </div>
                        ';
                    }else{
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido eliminar el ticket
                                </p>
                            </div>
                        '; 
                    }
                }

                /* Todos los tickets*/
                $num_ticket_all=Mysql::consulta("SELECT T.id,T.serie,T.fecha_alta,G.grado,EL.nombre,EL.apellidos,U.email_usuario,PU.puesto,T.asignado,T.email_asignado,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE,E.estatus_tk,P.prioridad
FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
    WHERE T.email_asignado='$nombre_user' ORDER BY id DESC");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT T.id,T.serie,T.fecha_alta,G.grado,EL.nombre,EL.apellidos,U.email_usuario,PU.puesto,T.asignado,T.email_asignado,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE,E.estatus_tk,P.prioridad
FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='Pendiente' and  T.email_asignado='$nombre_user'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT T.id,T.serie,T.fecha_alta,G.grado,EL.nombre,EL.apellidos,U.email_usuario,PU.puesto,T.asignado,T.email_asignado,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE,E.estatus_tk,P.prioridad
FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='En proceso' and T.email_asignado='$nombre_user'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT T.id,T.serie,T.fecha_alta,G.grado,EL.nombre,EL.apellidos,U.email_usuario,PU.puesto,T.asignado,T.email_asignado,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE,E.estatus_tk,P.prioridad
FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='Resuelto' and T.email_asignado='$nombre_user'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
                
                 /* Tickets Cancelados*/
                $num_ticket_can=Mysql::consulta("SELECT T.id,T.serie,T.fecha_alta,G.grado,EL.nombre,EL.apellidos,U.email_usuario,PU.puesto,T.asignado,T.email_asignado,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE,E.estatus_tk,P.prioridad
FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='Cancelados' and T.email_asignado='$nombre_user'");
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
    Reporte de Tickets Solicitados
        <small>LA Y GRIEGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php?view=usuario"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="./index.php?view=tickets">Administrar Tickets</a></li>
        <li class="active">Registro de Tickets</li>
      </ol>
    </section>
       <section class="content-header">
    </section>
          <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./index.php?view=tickets&ticket&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todas las Ordenes&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./index.php?view=tickets&ticket=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Ordenes pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./index.php?view=tickets&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Ordenes en proceso&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./index.php?view=tickets&ticket=resolved"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Ordenes resueltos&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./index.php?view=tickets&ticket=cancelled"><i class="fa fa-minus-square"></i>&nbsp;&nbsp;Ordenes Cancelados&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_can; ?></span></a></li>
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
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado WHERE T.email_asignado='$nombre_user' ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='Pendiente' and  T.email_asignado='$nombre_user'  LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  LEFT JOIN usuario AS U ON T.usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.id_estatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.id_laboral = EL.idlaboral
LEFT JOIN puestos AS PU ON  EL.id_puesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.id_puesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.id_grado = G.id_grado
  WHERE estatus_tk='En proceso' and  T.email_asignado='$nombre_user'  LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='Resuelto' and  T.email_asignado='$nombre_user' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="cancelled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
  WHERE estatus_tk='Cancelados' and  T.email_asignado='$nombre_user'  LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado WHERE T.email_asignado='$nombre_user' ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS T
  LEFT JOIN usuario AS U ON T.id_usuario_tk = U.idusuario
  LEFT JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
 LEFT JOIN estatus_tk AS E  ON  T.idestatus_tk = E.id_estatus_tk
 LEFT JOIN empleado_laboral AS EL ON  U.idusuario = EL.idusuario
LEFT JOIN puestos AS PU ON  EL.idpuesto = PU.id_puesto
LEFT JOIN asunto AS A ON A.idpuesto = PU.id_puesto AND  T.id_asunto = A.id_asunto
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado WHERE T.email_asignado='$nombre_user' ORDER BY id DESC LIMIT $inicio, $regpagina";
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
                                        <th class="text-center" scope="col">Apertura</th>
                                        <th class="text-center" scope="col">Serie</th>
                                       <th class="text-center" scope="col">Nombre del Solicitante</th>
                                        <th class="text-center" scope="col">Puesto Solicitado</th>
                                        <th class="text-center" scope="col">Prioridad</th>
                                        <th class="text-center" scope="col">Imagen</th>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Cierre</th>
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
                                        <td class="text-center" data-label="Area:"><?php echo $row['grado']; ?> <?php echo $row['nombre']; ?> <?php echo $row['apellidos']; ?></td>
                                             <td class="text-center" data-label="Area:"><?php echo $row['puesto']; ?></td>
                                         <td class="text-center" data-label="Prioridad:"><?php 
	//pintamos de colorores los estados del Ticket
	switch ($row['prioridad'])
	{
		case "Urgente":
		echo '<span class="btn btn-prio-urge btn-xs" disabled="disabled" style="color:red">'.$row["prioridad"].'</span>';
		break;
        case "Medio Urgente":
        echo '<spans class="btn btn-prio-mu btn-xs" disabled="disabled" style="color:blue">'.$row["prioridad"].'</span>';
        break;
		case "No urgente":
		echo '<span class="btn btn-prio-no btn-xs" disabled="disabled" style="color:#00A11E">'.$row["prioridad"].'</span>';
		break;
	}

	?> </td>
                                          <td class="text-center" data-label="Imagen:">      <a class="example-image-link" href="<?php echo $row['Foto1']; ?>" data-lightbox="example-set" data-title="<?php echo $row['mensaje']; ?>"><img class="example-image" src="<?php echo $row['Foto1']; ?>" width="25" height="25"  alt=""/></a>
                                         
                                  <td class="text-center" data-label="Estado:"><?php 	//pintamos de colorores los estados del ticket
	switch ($row['estatus_tk'])
	{
		case "Resuelto":
		echo '<span class="label label-primary">'.$row["estatus_tk"].'</span>';
		break;
        case "En proceso":
        echo '<span class="label label-warning">'.$row["estatus_tk"].'</span>';
       break;
       case "Pendiente":
        echo '<span class="label label-success">'.$row["estatus_tk"].'</span>';
       break;
       case "Cancelado":
        echo '<span class="label label-danger">'.$row["estatus_tk"].'</span>';
       break;
	}

 ?></td>
                                       
                                      
                                        <td class="text-center" data-label="F.Entrega:"><?php echo $row['fechaE']; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                            <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-default<?php echo $row['id']; ?>"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="left" id="tooltipex" title="Ver Informacion"></i></a> 
                                                           <!--ver lista de comentarios-->
                                          <a href="admin.php?view=act-diarias-comentario&id=<?php echo $row['id']; ?>" 
                                            class="btn btn-sm btn btn-info red-tooltip" data-toggle="tooltip" data-placement="top" id="tooltipex" title="Agregar Comentario"><span class="glyphicon glyphicon-comment"></span></a>
                                             <a href="./lib/pdf.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-success" target="_blank" data-toggle="tooltip" data-placement="right" id="tooltipex" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>

                                        <!------------------------ Inicio modal --------------------------------------->
 <div class="modal fade" id="modal-default<?php echo $row['id']; ?>">
    <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informacion del Registro Seleccionado</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div id="info"></div>
          </div>
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
               Informacion Ticket Solicitados
              </div>
        <div class="modal-body">
<dl class="param">
  <dt>Numero de Fila: <?php echo $ct; ?></dt>
</dl> 

<dl class="param">
  <dt>Fecha Alta:</dt>
  <dd> <?php echo $row['fecha_alta']; ?></dd>
</dl>
<dl class="param">
  <dt>Serie:</dt>
  <dd> <?php echo $row['serie']; ?></dd>
</dl>
<dl class="param">
  <dt>Nombre del Solicitante: </dt>
  <dd> <?php echo $row['grado']; ?> <?php echo $row['nombre']; ?>  <?php echo $row['apellidos']; ?></dd>
</dl>
             <dl class="param">
  <dt>Puesto: </dt>
  <dd> <?php echo $row['puesto']; ?></dd>
</dl> 
        <dl class="param">
  <dt>Correo: </dt>
  <dd> <?php echo $row['email_usuario']; ?></dd>
</dl> 
<dl class="param">
  <dt>Prioridad: </dt>
  <dd> <?php 
	//pintamos de colorores la prioridad deL TICKET
	switch ($row['prioridad'])
	{
		case "Urgente":
		echo '<span class="btn btn-prio-urge btn-xs" disabled="disabled" style="color:red">'.$row["prioridad"].'</span>';
		break;
        case "Medio Urgente":
        echo '<spans class="btn btn-prio-mu btn-xs" disabled="disabled" style="color:blue">'.$row["prioridad"].'</span>';
        break;
		case "No urgente":
		echo '<span class="btn btn-prio-no btn-xs" disabled="disabled" style="color:#00A11E">'.$row["prioridad"].'</span>';
		break;
	}

	?>
        </dd>
</dl>
<dl class="param">
  <dt>Asunto: </dt>
  <dd> <?php echo $row['asunto']; ?></dd>
</dl> 
<p><strong>Descripcion:</strong> <?php echo $row['mensaje'];?> </p>
<dl class="param">
  <dt>Estado: </dt>
  <dd> <?php 
	//pintamos de colorores los estados del Ticket
	switch ($row['estatus_tk'])
	{
		case "Resuelto":
		echo '<span class="label label-primary">'.$row["estatus_tk"].'</span>';
		break;
        case "En proceso":
        echo '<span class="label label-warning">'.$row["estatus_tk"].'</span>';
       break;
       case "Pendiente":
        echo '<span class="label label-success">'.$row["estatus_tk"].'</span>';
       break;
       case "Cancelado":
        echo '<span class="label label-danger">'.$row["estatus_tk"].'</span>';
       break;
	}

	?>
        </dd>
</dl>
</div> <!-- card-body.// -->


<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                   
                </div>
</div>

</div>
      
</div>
        </div>
        </div>
    </div>
</div>   
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
      
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay Ordenes registrados en el sistema con este estatus</h2>
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
                                        <a href="./index.php?view=tickets&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./index.php?view=tickets&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./index.php?view=tickets&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./index.php?view=tickets&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
<script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>

  <style type="text/css">
    .red-tooltip + .tooltip > .tooltip-arrow { border-right-color:#428bca; }
    .red-tooltip + .tooltip > .tooltip-inner {background-color: #428bca;}
</style>   
        <script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
  $("a").tooltip();
});
</script>
<script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(800, 0).slideUp(800, function(){
        $(this).remove(); 
    });
}, 2000);
 
});
</script>

<script type="text/javascript">
$(document).ready(function () {
   (function($) {
       $('#FiltrarContenido').keyup(function () {
            var ValorBusqueda = new RegExp($(this).val(), 'i');
            $('.BusquedaRapida tr').hide();
             $('.BusquedaRapida tr').filter(function () {
                return ValorBusqueda.test($(this).text());
              }).show();
                })
      }(jQuery));
});
</script>
<script type="text/javascript">
var activeEl = 0;
$(function() {
    var items = $('.btn-nav');
    $( items[activeEl] ).addClass('active');
    $( ".btn-nav" ).click(function() {
        $( items[activeEl] ).removeClass('active');
        $( this ).addClass('active');
        activeEl = $( ".btn-nav" ).index( this );
    });
});
</script>

    <script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
    </script>