<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin"){ ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <center><img src="./img/msj.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-10">
              <p class="lead text-info">Bienvenido administrador, aqui se muestran todos las Ordenes de Mejora LA Y GRIEGA los cuales podra eliminar, modificar, Cancelar e imprimir.</p>
            </div>
          </div>
        </div>
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
                $num_ticket_all=Mysql::consulta("SELECT * FROM ticket ORDER BY id DESC");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Pendiente'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='En proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
                
                 /* Tickets resueltos*/
                $num_ticket_can=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Cancelado'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-md">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=ticketadmin&ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todas las Ordenes&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Ordenes pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Ordenes en proceso&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=resolved"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Ordenes resueltos&nbsp;&nbsp;<span class="label label-info"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./admin.php?view=ticketadmin&ticket=cancelled"><i class="fa fa-minus-square"></i>&nbsp;&nbsp;Ordenes Cancelados&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_can; ?></span></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");
                              

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='En proceso' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Resuelto' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="cancelled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Cancelado' LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket ORDER BY id DESC LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                                
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered points_table_admin ">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">F.Apertura</th>
                                        <th class="text-center" scope="col">Serie</th>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Area</th>
                                        <th class="text-center" scope="col">Solicitado</th>
                                        <th class="text-center" scope="col">Prioridad</th>
                                        <th class="text-center" scope="col">Imagen</th>
                                        <th class="text-center" scope="col">F.Entrega</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                        <td class="text-center" data-label="F.Apertura:"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center" data-label="Serie:"><?php echo $row['serie']; ?></td>
                                        <td class="text-center" data-label="Estado:"><?php 
	//pintamos de colorores los estados del ticket
	switch ($row['estado_ticket'])
	{
		case "Resuelto":
		echo '<span class="btn btn-info btn-xs">'.$row["estado_ticket"].'</span>';
		break;
        case "En proceso":
        echo '<span class="btn btn-success btn-xs">'.$row["estado_ticket"].'</span>';
        break;
		case "Cancelado":
		echo '<span class="btn btn-warning btn-xs">'.$row["estado_ticket"].'</span>';
		break;
        case "Pendiente":
        echo '<span class="btn btn-danger btn-xs">'.$row["estado_ticket"].'</span>';
       break;
	}

	?>
</td>
                                        <td class="text-center" data-label="Area:"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center" data-label="Solicitado:"><?php echo $row['area_solicitada']; ?></td>
                                        <td class="text-center" data-label="Prioridad:"><?php 
	//pintamos de colorores los estados del ticket
	switch ($row['Prioridad'])
	{
		case "Urgente":
		echo '<span style="color:red">'.$row["Prioridad"].'</span>';
		break;
        case "Medio Urgente":
        echo '<spans style="color:orange">'.$row["Prioridad"].'</span>';
        break;
		case "No urgente":
		echo '<span style="color:blue">'.$row["Prioridad"].'</span>';
		break;
	}

	?>
</td>
                                        <td class="text-center" data-label="Imagen:"><a class="example-image-link" href=<?php echo $row['Foto1']; ?> data-lightbox="example-set" data-title="<?php echo $row['mensaje']; ?>"><img src=<?php echo $row['Foto1']; ?> width="25" height="25" class="property_img"/></a></td><div class="property_details">
                                        <td class="text-center" data-label="F.Entrega:"><?php echo $row['fechaE']; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>
                                    
                                               <a href="admin.php?view=admindetalleticket&id=<?php echo $row['id']; ?>" class="btn btn-sm btn btn-info"><i class="fa fa-list" aria-hidden="true"></i></a>
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
                                        <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&rarr;</span>&nbsp;Siguiente
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
                
               <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header2">
        <h5 class="modal-title" id="exampleModalLongTitle">PANEL DE ELIMINACION DE REGISTRO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <img src="img/sadminiracion.png">
          <hr>
      ¿Estás seguro de Eliminar este registro?
          <br>
          <hr>
    Esta operación es irreversible
          
      <div class="modal-footer">
        
          <button type="button" class="btn btn-info btn-lg btn" data-dismiss="modal">Salir</button>
                    <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-lg btn" disabled="disabled">Eliminar</button>
                                            </form>

        
      </div>
    </div>
  </div>
</div>
                
            </div> </div><!--container principal-->
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
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores del Sistema OM La Y Griega</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
        </section>  
    
<?php
}
?>   <script type="text/javascript">
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
   <!-- LIGHTBOX PLUS JQUERY -->
    <script src="./js/lightbox-plus-jquery.min.js"></script>