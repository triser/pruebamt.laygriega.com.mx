
<?php if(isset($_SESSION['email']) && isset($_SESSION['rol'])){ ?>
<?php
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT T.usuario_tk, T.serie, T.fecha_alta,T.asignado,T.email_asignado,PU.puesto,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE, E.estatus_tk,P.prioridad
FROM
  tickets AS T
  INNER JOIN prioridad_tk AS P ON  T.id_prioridad_tk = P.id_prioridad_tk
  INNER JOIN estatus_tk AS E ON  T.id_estatus_tk = E.id_estatus_tk 
INNER JOIN asunto AS A ON   T.id_asunto = A.id_asunto
  INNER JOIN puestos AS PU ON   A.id_puesto = PU.id_puesto WHERE id= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
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
    <!-- Main content -->
    <section class="content container-fluid">
<!-- =========================================================== -->

      <div class="row">
        <div class="col-md-12">
          <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Detalle del ticket con Folio&nbsp;<?php echo $reg['serie']?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-default">
              <div class="widget-user-image">
                <img class="example-image img-circle" src="<?php echo $reg['imagen_tk']; ?>" alt=""/>
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $reg['usuario_tk']?></h3>
              <h5 class="widget-user-desc">Lead Developer</h5>
            <div class="box-header">
              <h3 class="box-title">En este apartado podra realizar tus cometarios referente a tu ticket que aparecen en pantalla, dando un click Comentarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped">
      
                <tr>
                  <th>Enviado a:</th>
                  <td><?php echo $reg['asignado']?></td>
                </tr>
                <tr>
                
                  <th>Puesto:</th>
                  <td><?php echo $reg['puesto']?></td>
                </tr>
                <tr>
                 
                   <th>Asunto</th>
                
               <td><?php echo $reg['asunto']?></td>
                </tr>
                <tr>
                 
                  <th>Descripcion</th>
                
               <td><?php echo utf8_encode($reg['mensaje'])?></td>
                </tr>
                <tr>
                    
                  <th>Fecha de Solicitud</th>
                
               <td><?php echo $reg['fecha_alta']?></td>
                </tr>
                       <tr>
                    
                  <th>Estatus</th>
                
               <td> <?php 
  //pintamos de colorores los estados del ticket
  switch ($reg['estatus_tk'])
  {
            
        case "Resuelto":
    echo '<span class="btn btn-info btn-xs">'.$reg["estatus_tk"].'</span>';
    break;
        case "En proceso":
        echo '<span class="btn btn-success btn-xs">'.$reg["estatus_tk"].'</span>';
        break;
    case "Cancelado":
    echo '<span class="btn btn-warning btn-xs">'.$reg["estatus_tk"].'</span>';
    break;
        case "Pendiente":
        echo '<span class="btn btn-danger btn-xs">'.$reg["estatus_tk"].'</span>';
       break;

  }

  ?>
</td>
                </tr>
                      <tr>
                    
                  
                
               
                </tr>
              </table>
                <div class="col-sm-12 col-xs-12" style="display: flex;">
        <button type="button" class="btn btn-success" style="margin-right:10px" id="btncomentar">Comentar</button>
        <button type="button" class="btn btn-primary">Regresar</button>
      </div>
            </div>
        
                                   <!--FORMULARIO QUE ENVIA EL COMENTARIO-->
  <form class="form-horizontal" role="form" id="formcomenta" action="sentencias/guardarcomentario.php" method="GET">
  <div class="form-group" style="margin-right:100px">
    <label for="inputEmail3" class="col-sm-2 control-label">Comentario</label>
    <div class="col-sm-10">
      <textarea type="text" rows="5" class="form-control" name="comentario" id="comentariotext" placeholder="Escriba aqui su comentario" required></textarea>
      <input type="hidden" name="id" value="<?php echo "$id"?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="envia">Guardar</button>
         <a class="btn btn-danger" id="cancelar">Cancelar</a>
    </div>
  </div>
</form>
                  </div>
          <!-- /.box -->
      
          <!-- /.widget-user -->
        </div>
            </div>
            <!-- /.box-body -->
     <div class="container">
                <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
                                          <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM tickets AS tk
 INNER JOIN  detalle_ticket AS dtk ON tk.id=dtk.id_ticket where id_ticket='$id'  LIMIT $inicio, $regpagina");


                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                                if(mysqli_num_rows($selusers)>0):
                            ?>
                <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selusers, MYSQLI_ASSOC)): 
                                    ?>    
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                  <?php echo $row['fecha']?>
                  </span>
            </li>
            <!-- /.timeline-label -->
           
            <!-- timeline item -->
            <li>
 
             
              <div class="timeline-item">

                <span class="time"><i class="fa fa-clock-o"></i> <?php echo utf8_decode($row['hra_coment'])?></span>

                <h3 class="timeline-header"><a href=""><?php echo $ct; ?> <?php echo $row['id_usuario']; ?></a></h3>

                <div class="timeline-body">
                <?php echo $row['comentario']; ?>
                </div>
                
              </div>
            </li>
               <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
            <!-- END timeline item -->
           
              </ul> </div> </div>
            <!-- END timeline item -->
                <br>
                <div class="row">
                    <div class="col-md-12">
                      <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                           
                   
                            <?php else: ?>
                                <h2 class="text-center">No hay comentarios </h2>
                            <?php endif; ?>
                        </div>
                        <?php if($numeropaginas>=1): ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=users&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=users&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./detalleticket.php?id='.$id.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=users&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
              
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
  
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->
        
      


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "./inc/footer.php"; ?> 

  <!-- /.control-sidebar -->
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

<script>
         	$(document).ready(function(){
         	//ocultamos el formulario
         	$("#formcomenta").hide();
         	$("#btncomentar").click(function(){

         		$("#formcomenta").show();
         	});
         	$("#cancelar").click(function(){
            $("#comentariotext").val('');      
         		$("#formcomenta").hide();
         	});
         });

         </script>

