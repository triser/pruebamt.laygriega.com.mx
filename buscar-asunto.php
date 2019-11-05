<?php  header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
include "./lib/config2.php";
if($_SESSION['email']!="" && $_SESSION['rol']=="2"){ ?>  
<?php include('./sentencias/consulta.php');?>
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

           /* Todos los asuntos */
            $num=Mysql::consulta("SELECT G.grado,EL.nombre, EL.apellidos,P.puesto,A.asunto,A.estatus_a FROM asunto AS A
  LEFT JOIN puestos AS P ON  A.idpuesto = P.id_puesto 
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento 
  LEFT JOIN empleado_laboral AS EL ON EL.idpuesto = P.id_puesto 
  LEFT JOIN usuario AS U  ON   U.idusuario = EL.idusuario
  LEFT JOIN empleado_personal AS EP ON  U.idusuario = EP.idusuario
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado");
      $total_asunto = mysqli_num_rows($num);
            /* Altas asuntos*/
            $alta_asunto=Mysql::consulta("SELECT G.grado,EL.nombre, EL.apellidos,P.puesto,A.asunto,A.estatus_a FROM asunto AS A
  LEFT JOIN puestos AS P ON  A.idpuesto = P.id_puesto 
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento 
  LEFT JOIN empleado_laboral AS EL ON EL.idpuesto = P.id_puesto 
  LEFT JOIN usuario AS U  ON   U.idusuario = EL.idusuario
  LEFT JOIN empleado_personal AS EP ON  U.idusuario = EP.idusuario
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado WHERE estatus_a = 1");
            $num_baja_alta = mysqli_num_rows($alta_asunto);
              /* Baja Asunto*/
            $baja_asunto=Mysql::consulta("SELECT G.grado,EL.nombre, EL.apellidos,P.puesto,A.asunto,A.estatus_a FROM asunto AS A
  LEFT JOIN puestos AS P ON  A.idpuesto = P.id_puesto 
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento 
  LEFT JOIN empleado_laboral AS EL ON EL.idpuesto = P.id_puesto 
  LEFT JOIN usuario AS U  ON   U.idusuario = EL.idusuario
  LEFT JOIN empleado_personal AS EP ON  U.idusuario = EP.idusuario
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado WHERE estatus_a = 0");
            $num_baja_asunto = mysqli_num_rows($baja_asunto);
          
        ?>
 <?php
//Get all departamento data
$query = mysqli_query($con,"SELECT * FROM departamento WHERE estatus_dep = 1 LIMIT 1,10");
//Count total number of rows
$rowCount = $query-> num_rows;
?>
		<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    	<?php 
            
            $busqueda = $_REQUEST['busqueda'];
			if(empty($busqueda))
			{
				header("location: ./admin.php?view=asunto-ticket");
			    mysqli_close($con);
			}


		 ?>

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
    Lista Asuntos Asignados a Usuarios para Solicitu de Tickets
        <small>LA Y GRIEGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Administrar Tickets</li>
        <li class="active">Registro de Asuntos para Ticket</li>
      </ol>
    </section>
       <section class="content-header">
    </section>
         <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="nav nav-pills nav-justified">
                        <li ><a href="./admin.php?view=asunto-ticket"><i class="glyphicon glyphicon-flag"></i>&nbsp;&nbsp;Todos&nbsp;&nbsp;<span class="badge label label-info"><?php echo $total_asunto; ?></span></a></li>
                        <li><a href="./admin.php?view=alta-asunto-ticket"><i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Alta Asunto&nbsp;&nbsp;<span class=" badge label label-primary"><?php echo $num_baja_alta; ?></span></a></li>
                        <li><a href="./admin.php?view=baja-asunto-ticket"><i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Baja Asunto&nbsp;&nbsp;<span class=" badge label label-danger"><?php echo $num_baja_asunto; ?></span></a></li>
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
                        include("./modal/alta_asunto.php");
                    ?>  
                

            <div class="btn-group">
                <a href="javascript:location.reload()" class="btn btn-block btn-sm btn-refresh" type="button"><i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Refresh</a>

             </div>
      <div class="col-sm-3 pull-right form-group">
               
<form action="buscar-asunto.php" method="get" class="form_search" >
<div class="form-group">
<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-search"></i></span>
<input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar...." value="<?php echo $busqueda; ?>" >
<span class="input-group-btn">
<button class="btn btn-success" value="Buscar" type="submit">
<i aria-hidden="true"></i> Buscar
</button>
</span>
</div>
</div>
</form>
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
				$puesto = " OR rol LIKE '%37%' ";

			}else if($busqueda == 'COMUNICACIÓN Y SEGURIDAD TI'){

				$puesto = " OR rol LIKE '%38%' ";

			}else if($busqueda == 'Asesor externo'){

				$puesto = " OR rol LIKE '%74%' ";
			}

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM asunto AS A
  LEFT JOIN puestos AS P ON A.idpuesto = P.id_puesto 
  LEFT JOIN departamento AS D ON P.id_depa = D.id_departamento 
  LEFT JOIN empleado_laboral AS EL ON EL.idpuesto = P.id_puesto 
  LEFT JOIN usuario AS U ON U.idusuario = EL.idusuario
  LEFT JOIN empleado_personal AS EP ON U.idusuario = EP.idusuario
  LEFT JOIN grado_estudio AS G ON EL.idgrado = G.id_grado WHERE 
										( EL.nombre LIKE '%$busqueda%' OR 
											 EL.apellidos LIKE '%$busqueda%' OR 
											P.puesto LIKE '%$busqueda%' OR 
                                           D.departamento LIKE '%$busqueda%' OR 
											A.asunto LIKE '%$busqueda%' OR 
											G.grado  LIKE  '%$busqueda%' OR 
                                            A.estatus_a  LIKE  '%$busqueda%')
                                            ORDER BY id_asunto DESC  LIMIT $inicio, $regpagina");

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
                                         <th class="text-center">Departamento</th>
                                         <th class="text-center">Puesto</th>
                                        <th class="text-center">Asunto Asigando</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                   <tbody>
                                   <?php
                                        $ct=$inicio+1;
                                                while ($asunto=mysqli_fetch_array($selusers, MYSQLI_ASSOC)): 
                            $iduser=$asunto['idusuario'];
							$g=$asunto['grado'];
							$n=$asunto['nombre'];
							$a=$asunto['apellidos'];
							$u=$asunto['usuario'];
							$fp=$asunto['foto_perfil'];
                            $d=$asunto['departamento'];	
                            $pu=$asunto['puesto'];	
                            $em=$asunto['email_usuario'];
                                    ?>
                                   <tr>
                                        <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                        <td class="text-center" data-label="Nombre Completo:"><?php echo $g?> <?php echo $n; ?> <?php echo $a?></td>
                                        <td class="text-center" data-label="Departamento:"><?php echo $d?></td>
                                        <td class="text-center" data-label="Puesto:"><?php echo $pu?></td>
                                        <td class="text-center" data-label="asunto:"><?php echo utf8_decode($asunto['asunto']); ?></td>
                                          <td class="text-center" data-label="Solicitado:">
                                        <?php //pintamos de colorores los estados la actividad
	switch ($asunto['estatus_a'])
	{
	case "1":
		echo '<span class="label label-primary">'.($asunto["estatus_a"]= "Alta").'</span>';
		break;
        case "0":
        echo '<span class="label label-danger">'.$asunto["estatus_a"]= "Baja".'</span>';
       break;
	}
	?></td>
                                        <td class="text-center" data-label="Opciones:">
                                      	<a href="#edit<?php echo $asunto['id_asunto']; ?>" data-toggle="modal" class="btn btn-sm btn-warning red-tooltip edit_data" data-toggle="tooltip" data-placement="right" id="tooltipex" title="Editar Asunto"><span class="glyphicon glyphicon-edit" ></span></a> 
							<a href="#del<?php echo $asunto['id_asunto']; ?>" data-toggle="modal" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" id="tooltipex" title="Dar de Baja Asunto"></span></a>
                                    <?php include('modal/edit_asunto.php'); ?>
                                    </td>
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No Existe Ninguna Registro de Busqueda en el sistema Verique su Busqueda</h2>
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
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=asunto-ticket"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>
              <!-- footer link-->
        <?php include "./inc/links-footer.php"; ?> 
    </body>
</html>