<?php  header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include '../lib/class_mysql.php';
include '../lib/config.php';
include "../lib/config2.php";
if($_SESSION['nombre']!="" && $_SESSION['rol']=="2"){ ?>  

  <?php     $status='estatus_a'; if ($status=1){$status_f="Alta";}else {$status_f="Baja";}  ?>
        <?php 
            if(isset($_POST['id_del'])){
                $id_user=MysqlQuery::RequestPost('id_del');
                 $estatus_edit="0";
                
                if(MysqlQuery::Actualizar("asunto","estatus_a=' $estatus_edit'","id_asunto='$id_user'")){
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

            /* Todos los users*/
            $num_user=Mysql::consulta("SELECT T.descrip_titulo,U.nombre,  U.apellidos, P.puesto, A.asunto, A.estatus_a
FROM asunto AS A  LEFT JOIN puestos AS P ON   A.id_puesto = P.id_puesto LEFT JOIN usuario AS U ON  U.id_puesto = P.id_puesto LEFT JOIN titulo AS T ON U.id_titulo =T.id_titulo 	WHERE estatus_a = 1");
            $num_total_user = mysqli_num_rows($num_user);
              /* Todos los users abaja*/
            $num_user=Mysql::consulta("SELECT T.descrip_titulo,U.nombre,  U.apellidos, P.puesto, A.asunto, A.estatus_a
FROM asunto AS A  LEFT JOIN puestos AS P ON   A.id_puesto = P.id_puesto LEFT JOIN usuario AS U ON  U.id_puesto = P.id_puesto LEFT JOIN titulo AS T ON U.id_titulo =T.id_titulo WHERE  estatus_a = 0");
            $num_total_baja = mysqli_num_rows($num_user);
          
        ?>
		<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
        <?php include "../inc/links.php"; ?>        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    	<?php 

			$busqueda = $_GET['busqueda'];
			if(empty($busqueda))
			{
				header("location: ../admin.php?view=asunto-ticket");
			    mysqli_close($con);
			}


		 ?>

  <!-- Main Header -->
  <?php include "../inc/main-header.php"; ?>  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include "../inc/main-sidebar.php"; ?>  
  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Lista Asuntos Asignados a Usuarios para Solicitu de Tickets
        <small>LA Y GRIEGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Administrar Tickets</li>
        <li class="active">Registro de Asuntos para Ticket</li>
      </ol>
    </section>
       <section class="content-header">
    </section>
         <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="../admin.php?view=alta-"><i class="fa fa-users"></i>&nbsp;&nbsp;Usuarios&nbsp;&nbsp;<span class="badge"><?php echo $num_total_user; ?></span></a></li>
                            <li><a href="../admin.php?view=baja"><i class="fa fa-male"></i>&nbsp;&nbsp;Baja&nbsp;&nbsp;<span class="badge"><?php echo $num_total_baja; ?></span></a></li>
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
                      <?php
                        include("../modal/alta_asunto.php");
                    ?>  
                
                
		<form action="busqueda/buscar-asunto.php" method="get" class="form_search">
				<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>
        <div class="btn-group">
     <button type="button" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-block btn-sm btn-warning">Alta Asunto</button>
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
                                                     
    	//Paginador
			$puesto = '';
			if($busqueda == 'SOFTWARE Y HARDWARE')
			{
				$puesto = " OR rol LIKE '%36%' ";

			}else if($busqueda == 'SCOMUNICACIÓN Y SEGURIDAD TI'){

				$puesto = " OR rol LIKE '%37%' ";

			}else if($busqueda == 'Asesor externo'){

				$puesto = " OR rol LIKE '%3%' ";
			}

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * From asunto AS A  LEFT JOIN puestos AS P ON   A.id_puesto = P.id_puesto LEFT JOIN usuario AS U ON  U.id_puesto = P.id_puesto LEFT JOIN titulo AS T ON U.id_titulo = T.id_titulo WHERE 
										( U.nombre LIKE '%$busqueda%' OR 
											 U.apellidos LIKE '%$busqueda%' OR 
											P.puesto LIKE '%$busqueda%' OR 
											A.asunto LIKE '%$busqueda%' OR 
											T.descrip_titulo  LIKE  '%$busqueda%' ) 
										AND estatus_a = 1 ORDER BY id_asunto DESC  LIMIT $inicio, $regpagina");

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
                                         <th class="text-center">Puesto</th>
                                        <th class="text-center">Asunto Asigando</th>
                                        <th class="text-center">Estatus</th>
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
                                        <td class="text-center" data-label="Nombre Completo:"><?php echo $row['descrip_titulo']; ?> <?php echo $row['nombre']; ?> <?php echo $row['apellidos']; ?></td>
                                        <td class="text-center" data-label="asunto:"><?php echo $row['puesto']; ?></td>
                                        <td class="text-center" data-label="asunto:"><?php echo $row['asunto']; ?></td>
                                          <td class="text-center" data-label="Solicitado:"><?php echo $status_f; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                        <a class="btn btn-sm btn-default" title="ver informacion" data-toggle="modal" data-target="#myModal<?php echo $row['id_asunto']; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a data-toggle="modal" data-target="#edit_data_Modal"
                                            class="btn btn-sm btn btn-info red-tooltip edit_data" data-toggle="tooltip" data-placement="right" id="tooltipex" title="Editar Asunto"><span class="glyphicon glyphicon-edit"></span></a>
                                           <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-default<?php echo $row['id_asunto']; ?>"><i class="fa fa-trash-o" aria-hidden="true" data-toggle="tooltip" data-placement="left" id="tooltipex" title="Dar de Baja Asunto"></i></a> 
                                      	<a href="#edit<?php echo $row['id_asunto']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> || 
							<a href="#del<?php echo $row['id_asunto']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
						 <?php
                        include("modal/edit_asunto.php");
                    ?> 
                                        </td>
                                  
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay Asuntos para Tickets registrados en el sistema</h2>
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
                                        <a href="./admin.php?view=asunto-ticket&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=asunto-ticket&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=asunto-ticket&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=asunto-ticket&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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

  <!-- Main Footer -->
<?php include "../inc/footer.php"; ?> 
 
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
$("#add_user" ).submit(function( event ) {
    $('#save_data').attr("disabled", true);
  
    var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "sentencias/alta-asunto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user").html(datos);
            $('#save_data').attr("disabled", false);
          
          }
    });
  event.preventDefault();
})
// success
</script>

  <script>
    $(document).ready(function(){
    $("#provincia").load('sentencias/select-puesto-asunto.php');
                            });
    </script>


    <script>

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=asunto-ticket"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>
              <!-- footer link-->
        <?php include "../inc/links-footer.php"; ?> 
    </body>
</html>