<?php include './lib/config2.php'; if($_SESSION['email']!="" && $_SESSION['rol']){ ?>  
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

            /* Todos los users*/
            $num_user=Mysql::consulta("SELECT U.idusuario,G.grado ,EL.nombre,EL.apellidos,U.email_usuario,D.departamento,P.puesto,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,U.fecha_update
FROM usuario AS U 
 LEFT JOIN rol AS R  ON U.rol = R.idrol
  LEFT JOIN empleado_laboral AS EL ON  EL.idusuario = U.idusuario 
  LEFT JOIN grado_estudio AS G ON  EL.idgrado= G.id_grado
 LEFT JOIN puestos AS P ON   EL.idpuesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento WHERE estatus = 1");
            $num_total_user = mysqli_num_rows($num_user);
              /* Todos los users abaja*/
            $num_user=Mysql::consulta("SELECT U.idusuario,G.grado ,EL.nombre,EL.apellidos,U.email_usuario,D.departamento,P.puesto,U.usuario,U.foto_perfil,R.rol,U.estatus,U.fecha_alta_sis,U.fecha_update
FROM usuario AS U 
 LEFT JOIN rol AS R  ON U.rol = R.idrol
  LEFT JOIN empleado_laboral AS EL ON  EL.idusuario = U.idusuario 
  LEFT JOIN grado_estudio AS G ON  EL.idgrado= G.id_grado
 LEFT JOIN puestos AS P ON   EL.idpuesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento WHERE estatus = 0");
            $num_total_baja = mysqli_num_rows($num_user);
          
        ?>
 <?php

//Get all departamento data
$query = mysqli_query($con,"SELECT * FROM departamento WHERE estatus_dep = 1");

//Count total number of rows
$rowCount = $query-> num_rows;
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
                       
        <div class="btn-group">
        <a  href="./admin.php?view=alta-usuario" class="btn btn-block btn-sm btn-alta"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i><span>&nbsp;&nbsp;Alta Usuario</span></a>
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
               <div id="employee_table">
            <div class="box-body table-responsive no-padding">
                    <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $selusers=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM usuario AS U 
 LEFT JOIN rol AS R  ON U.rol = R.idrol
  LEFT JOIN empleado_laboral AS EL ON  EL.idusuario = U.idusuario 
  LEFT JOIN grado_estudio AS G ON  EL.idgrado= G.id_grado
 LEFT JOIN puestos AS P ON   EL.idpuesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento WHERE estatus
   = 1 ORDER BY U.idusuario LIMIT $inicio, $regpagina");

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
                            $iduser=$row['idusuario'];
							$g=$row['grado'];
							$n=$row['nombre'];
							$a=$row['apellidos'];
							$u=$row['usuario'];
							$fp=$row['foto_perfil'];
                            $d=$row['departamento'];	
                            $pu=$row['puesto'];	
                            $em=$row['email_usuario'];	
                                    ?>
                                    <tr>
                                        <td class="text-center" scope="row" data-label="Registro"><?php echo $ct; ?></td>
                                        <td class="text-center" data-label="NOmbre:"><?php echo $g; ?> <?php echo $n; ?> <?php echo $a; ?></td>
                                        <td class="text-center" data-label="NOmbre:"><?php echo $u; ?></td>
                                         <td class="text-center" data-label="Foto:"> <a class="example-image-link" href="img/profiles/<?php echo $fp; ?>" data-lightbox="example-set" data-title="<?php echo $n; ?>"><img class="example-image" src="img/profiles/<?php echo $row['foto_perfil']; ?>" width="25" height="25"  alt=""/></a>
                                        <td class="text-center" data-label="Area:"><?php echo $d ?></td>
                                         <td class="text-center" data-label="Prioridad:"><?php echo $pu;?> </td>
                                        <td class="text-center" data-label="Solicitado:"><?php echo $em; ?></td>
                                          <td class="text-center" data-label="Solicitado:">                                        <?php //pintamos de colorores los estados la actividad
	switch ($row['rol'])
	{
	case "Usuarios":
		echo '<span class="label label-primary">'.($row["rol"]= "Usuarios").'</span>';
		break;
        case "Administrador":
        echo '<span class="label label-danger">'.$row["rol"]= "Administrador".'</span>';
       break;
       case "SGC":
        echo '<span class="label label-info">'.$row["rol"]= "SGC".'</span>';
       break;
	}
	?></td>
                                          <td class="text-center" data-label="Solicitado:"><?php echo $status_f; ?></td>
                                        <td class="text-center" data-label="Opciones:">
                                        <button type="button" name="view" value="view" id="<?php echo $row["idusuario"]; ?>" class="btn btn-sm btn-default view_data "><span class="glyphicon glyphicon-eye-open"></span></button>
                                           <a href="admin.php?view=edit-usuario&id=<?php echo $iduser; ?>" 
                                            class="btn btn-sm btn btn-info red-tooltip" data-toggle="tooltip" data-placement="right" id="tooltipex" title="Editar Usuario"><span class="glyphicon glyphicon-edit"></span></a>
                                           <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-default<?php echo $row['idusuario']; ?>"><i class="fa fa-trash-o" aria-hidden="true" data-toggle="tooltip" data-placement="left" id="tooltipex" title="Eliminar Usuario"></i></a>
                                                    <?php include('modal/laboral.php'); ?>
                                          
                                        </td> 
                                     
                            <!------------------------ Inicio modal --------------------------------------->
  <!-- Modal -->
  <div class="modal fade" id="modal-default<?php echo $row['idusuario']; ?>">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header2">
        <h5 class="modal-title" id="exampleModalLongTitle">PANEL DE ELIMINACION DE REGISTRO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="modal-body">
            <img src="img/sadminiracion.png">
          <hr>
      ¿Estás seguro de Eliminar este registro?
          <br>
              <hr>
              <p>Numero Fila: <span class="spantext"><?php echo $ct; ?></span></p>
              <p>Nombre: <span class="spantext"><?php echo $row['grado']; ?> <?php echo $row['nombre']; ?> <?php echo $row['apellidos']; ?></span></p>
			<p>usuario: <span class="spantext"><?php echo $row['email_usuario']; ?></span></p>
			<p>Tipo Usuario: <span class="spantext"> <?php //pintamos de colorores los estados la actividad
	switch ($row['rol'])
	{
	case "Usuarios":
		echo '<span class="label label-primary">'.$row["rol"]= "Usuarios".'</span>';
		break;
        case "Administrador":
        echo '<span class="label label-danger">'.$row["rol"]= "Administrador".'</span>';
       break;
       case "SGC":
        echo '<span class="label label-info">'.$row["rol"]= "SGC".'</span>';
       break;
	}?></span></p>
          <hr>
    Esta operación es irreversible

          
      <div class="modal-footer">
        
           <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Salir</button>
            <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['idusuario']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Borrar</button>
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
                   </div>  
                   <!-- Employee Details -->
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
     <?php include('./modal/info-users.php'); ?>
   <?php include('modal/laboral-user.php'); ?>
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
<script>  
		$('#editProductModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
		  var code = button.data('code') 
		  $('#edit_code').val(code)
		  var name = button.data('name') 
		  $('#edit_name').val(name)
		  var id = button.data('id') 
		  $('#edit_id').val(id)
		})

		
		$( "#edit_product" ).submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "ajax/editar_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					load(1);
					$('#editProductModal').modal('hide');
				  }
			});
		  event.preventDefault();
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