<?php if($_SESSION['nombre']!="" && $_SESSION['rol']=="2"){ ?>  
  <?php     $status='estatus'; if ($status=0){$status_f="Activo";}else {$status_f="Baja";}  ?>
        <?php 
            if(isset($_POST['id_del'])){
                $id_user=MysqlQuery::RequestPost('id_del');
                 $estatus_edit="1";
                
                if(MysqlQuery::Actualizar("usuario","estatus=' $estatus_edit'","idusuario='$id_user'")){
                    echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">USUARIO ELIMINADO</h4>
                            <p class="text-center">
                                El usuario fue dadi de Alta Nuevamente en el sistema con exito
                            </p>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                            <p class="text-center">
                                No hemos podido dar de Alta al usuario
                            </p>
                        </div>
                    ';
                }
            }

            /* Todos los users*/
            $num_user=Mysql::consulta("SELECT U.idusuario,U.nombre,U.apellidos,U.email_usuario,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,U.direccion,U.tipo_sangre,U.telefono,U.nss,U.fechaingreso,T.descrip_titulo,D.departamento,P.puesto
FROM usuario AS U LEFT JOIN titulo AS T ON U.id_titulo = T.id_titulo LEFT JOIN puestos AS P ON  U.id_puesto = P.id_puesto LEFT JOIN  departamento AS D ON  U.id_departamento = D.id_departamento LEFT JOIN  rol AS R ON  U.rol = R.idrol WHERE estatus = 1");
            $num_total_user = mysqli_num_rows($num_user);
              /* Todos los users abaja*/
            $num_user=Mysql::consulta("SELECT U.idusuario,U.nombre,U.apellidos,U.email_usuario,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,U.direccion,U.tipo_sangre,U.telefono,U.nss,U.fechaingreso,T.descrip_titulo,D.departamento,P.puesto
FROM usuario AS U LEFT JOIN titulo AS T ON U.id_titulo = T.id_titulo LEFT JOIN puestos AS P ON  U.id_puesto = P.id_puesto LEFT JOIN  departamento AS D ON  U.id_departamento = D.id_departamento LEFT JOIN  rol AS R ON  U.rol = R.idrol WHERE estatus = 0");
            $num_total_baja = mysqli_num_rows($num_user);
          
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
        <li><a href="./admin.php?view=usuarios">Registro de Usuarios</a></li>
          <li class="active">Baja de Usuarios</li>
      </ol>
    </section>
       <section class="content-header">
    </section>
         <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="./admin.php?view=usuarios"><i class="fa fa-users"></i>&nbsp;&nbsp;Usuarios&nbsp;&nbsp;<span class="badge"><?php echo $num_total_user; ?></span></a></li>
                            <li><a href="./admin.php?view=bajauser"><i class="fa fa-male"></i>&nbsp;&nbsp;Baja&nbsp;&nbsp;<span class="badge"><?php echo $num_total_baja; ?></span></a></li>
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
                       
      
  
            </div>
              
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                    <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * From  usuario AS U LEFT JOIN titulo AS T ON U.id_titulo = T.id_titulo LEFT JOIN puestos AS P ON  U.id_puesto = P.id_puesto LEFT JOIN  departamento AS D ON  U.id_departamento = D.id_departamento LEFT JOIN  rol AS R ON  U.rol = R.idrol WHERE estatus = 0 ORDER BY idusuario LIMIT $inicio, $regpagina");

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                                if(mysqli_num_rows($selusers)>0):
                            ?>
                                 <table class="table table-hover">
                                  <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                         <th class="text-center">Nombre completo</th>
                                         <th class="text-center">Usuario</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Departamento</th>
                                        <th class="text-center">Puesto</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">estatus</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                               <tbody  class="BusquedaRapida">
                                   <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selusers, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                        <td class="text-center" data-label="NOmbre:"><?php echo $row['descrip_titulo']; ?> <?php echo $row['nombre']; ?></td>
                                        <td class="text-center" data-label="NOmbre:"><?php echo $row['usuario']; ?></td>
                                         <td class="text-center" data-label="Foto:"> <a class="example-image-link" href="img/profiles/<?php echo $row['foto_perfil']; ?>" data-lightbox="example-set" data-title="<?php echo $row['nombre']; ?>"><img class="example-image" src="img/profiles/<?php echo $row['foto_perfil']; ?>" width="25" height="25"  alt=""/></a>
                                        <td class="text-center" data-label="Area:"><?php echo $row['departamento']; ?></td>
                                         <td class="text-center" data-label="Prioridad:"><?php echo $row['puesto']; ?> </td>
                                        <td class="text-center" data-label="Solicitado:"><?php echo $row['email_usuario']; ?></td>
                                          <td class="text-center" data-label="Solicitado:"><?php echo $row['rol']; ?></td>
                                          <td class="text-center" data-label="Solicitado:"><?php echo $status_f; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                        <a class="btn btn-sm btn-default" title="ver informacion" data-toggle="modal" data-target="#myModal<?php echo $row['id_cliente']; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a href="admin.php?view=edit-usuario&id=<?php echo $row['idusuario']; ?>" 
                                            class="btn btn-sm btn btn-info red-tooltip" data-toggle="tooltip" data-placement="right" id="tooltipex" title="Editar Usuario"><span class="glyphicon glyphicon-edit"></span></a>
                                           <a class="btn btn-sm btn-alta-user" data-toggle="modal" data-target="#modal-default<?php echo $row['idusuario']; ?>"><i class="fa fa-user-plus" aria-hidden="true" data-toggle="tooltip" data-placement="left" id="tooltipex" title="Alta Usuario"></i></a>

                                        </td>
                            <!------------------------ Inicio modal --------------------------------------->
  <!-- Modal -->
  <div class="modal fade" id="modal-default<?php echo $row['idusuario']; ?>">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header3">
        <h5 class="modal-title" id="exampleModalLongTitle">PANEL DE ALTA DE REGISTRO BORRADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="modal-body">
            <img src="img/sadminiracion.png">
          <hr>
      ¿Estás seguro de dar de Alta a este Usuario?
          <br>
              <hr>
              <p>Numero Fila: <span class="spantext"><?php echo $ct; ?></span></p>
              <p>Nombre: <span class="spantext"><?php echo $row['descrip_titulo']; ?> <?php echo $row['nombre']; ?></span></p>
			<p>usuario: <span class="spantext"><?php echo $row['email_usuario']; ?></span></p>
			<p>Estatus: <span class="spantext"><?php echo $status_f; ?></span></p>     
      <div class="modal-footer">
        
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Salir</button>
            <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['idusuario']; ?>">
                                                <button type="submit" class="btn btn-sm btn-alta-user"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Dar de Alta</button>
                                            </form>
      </div>
    </div>
  </div>
</div> 
  </div></div>
                                        
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay usuarios registrados en el sistema</h2>
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
                                            echo '<li><a href="./admin.php?view=users&pagina='.$i.'">'.$i.'</a></li>';
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
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=usuarios"}
        $(this).remove(); 
    });
}, 1000);
 
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