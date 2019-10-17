<?php 
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
if($_SESSION['clave']!=""){ $nombre_user= $_SESSION['email'];?>

    <!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Reporte Usuario</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <br>
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Reporte de Ticket Solicitados</h1>
                <span class="label label-danger">Sistema de Ordenes de Mejora LA Y GRIEGA</span>
                <p class="pull-right text-success">
                  <strong>
                  <span class="glyphicon glyphicon-time"></span>&nbsp;<?php include "./inc/timezone.php"; ?>
                 </strong>
               </p>
              </div>
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
                $num_ticket_all=Mysql::consulta("SELECT * FROM ticket where email_cliente='$nombre_user' ORDER BY id DESC");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Pendiente' and email_cliente='$nombre_user'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='En proceso' and email_cliente='$nombre_user'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Resuelto' and email_cliente='$nombre_user'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
                
                 /* Tickets resueltos*/
                $num_ticket_can=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Cancelado' and email_cliente='nombre_user'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./ticketusuario.php?ticket=all"><i class="fa fa-list"></i>&nbsp;&nbsp;Todas las Ordenes&nbsp;&nbsp;<span class="label label-primary"><?php echo $num_total_all; ?></span></a></li>
                            <li><a href="./ticketusuario.php?ticket=pending"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Ordenes pendientes&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_pend; ?></span></a></li>
                            <li><a href="./ticketusuario.php?ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Ordenes en proceso&nbsp;&nbsp;<span class="label label-warning"><?php echo $num_total_proceso; ?></span></a></li>
                            <li><a href="./ticketusuario.php?ticket=resolved"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Ordenes resueltos&nbsp;&nbsp;<span class="label label-success"><?php echo $num_total_res; ?></span></a></li>
                            <li><a href="./ticketusuario.php?ticket=cancelled"><i class="fa fa-minus-square"></i>&nbsp;&nbsp;Ordenes Cancelados&nbsp;&nbsp;<span class="label label-danger"><?php echo $num_total_can; ?></span></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where email_cliente='$nombre_user' ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' and  email_cliente='$nombre_user'  LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='En proceso' and  email_cliente='$nombre_user'  LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Resuelto' and  email_cliente='$nombre_user' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="cancelled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Cancelado' and  email_cliente='$nombre_user'  LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where email_cliente='$nombre_user' ORDER BY id DESC LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where email_cliente='$nombre_user' ORDER BY id DESC LIMIT $inicio, $regpagina";
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
                                        <th class="text-center" scope="col">Prioridad</th>
                                        <th class="text-center" scope="col">Area</th>
                                        <th class="text-center" scope="col">Solicitado</th>
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
                                        <td class="text-center" data-label="Estado:"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center" data-label="Prioridad:"><?php echo $row['Prioridad']; ?></td>
                                        <td class="text-center" data-label="Area:"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center" data-label="Solicitado:"><?php echo $row['area_solicitada']; ?></td>
                                        <td class="text-center" data-label="Imagen:"><a class="example-image-link" href=<?php echo $row['Foto1']; ?> data-lightbox="example-set" data-title="<?php echo $row['mensaje']; ?>"><img src=<?php echo $row['Foto1']; ?> width="25" height="25" class="property_img"/></a></td><div class="property_details">
                                        <td class="text-center" data-label="F.Entrega:"><?php echo $row['fechaE']; ?></td>
                                        <td class="text-center" data-label="Opciones:">

                                            <a href="./lib/pdf.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                               <a href="detalleticket.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-list" aria-hidden="true"></i></a>
                                        </td>
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
                                        <a href="./ticketusuario.php=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&larr;</span>&nbsp;Anterior
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./ticketusuario.php?ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./ticketusuario.php?ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./ticketusuario.php?ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&rarr;</span>&nbsp;Siguiente
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!--container principal-->
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
        </body>
        </html>
    
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
       <?php include './inc/footer.php'; ?>