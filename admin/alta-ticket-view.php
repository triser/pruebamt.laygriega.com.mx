<?php include './lib/config2.php'; if($_SESSION['email']!="" && $_SESSION['rol']=="2"){ ?> 
<?php include('./sentencias/consulta.php');?>
<?php 
if(isset($_POST['fecha_ticket']) && isset($_POST['descripcion_ticket'])){
    
$nombrefoto1=$_FILES['foto1']['name'];
$ruta1=$_FILES['foto1']['tmp_name'];
if(is_uploaded_file($ruta1))
{ 
if($_FILES['foto1']['type'] == 'image/png' OR $_FILES['foto1']['type'] == 'image/gif' OR $_FILES['foto1']['type'] == 'image/jpeg')
		{
$tips = 'jpg';
$type = array('image/jpeg' => 'jpg');
$name = $nombrefoto1.'.'.$tips;
$destino1 =  "upload_ticket/".$name;
copy($ruta1,$destino1);

$ruta_imagen = $destino1;

$miniatura_ancho_maximo = 700;
$miniatura_alto_maximo = 500;

$info_imagen = getimagesize($ruta_imagen);
$imagen_ancho = $info_imagen[0];
$imagen_alto = $info_imagen[1];
$imagen_tipo = $info_imagen['mime'];

switch ( $imagen_tipo ){
  case "image/jpg":
  case "image/jpeg":
    $imagen = imagecreatefromjpeg( $ruta_imagen );
    break;
  case "image/png":
    $imagen = imagecreatefrompng( $ruta_imagen );
    break;
  case "image/gif":
    $imagen = imagecreatefromgif( $ruta_imagen );
    break;
}
$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);


imagejpeg($lienzo, $destino1, 80);
}
}
    
          /*Este codigo nos servira para generar un numero diferente para cada Orden*/
          $codigo = ""; 
          $longitud = 2; 
          for ($i=1; $i<=$longitud; $i++){ 
            $numero = rand(0,9); 
            $codigo .= $numero; 
          } 
          $num=Mysql::consulta("SELECT * FROM tickets");
          $numero_filas = mysqli_num_rows($num);

          $numero_filas_total=$numero_filas+1;
          $id_ticket="OY".$codigo."N".$numero_filas_total;
			
          /*Fin codigo numero de ticket*/
          $fecha_ticket=  MysqlQuery::RequestPost('fecha_ticket');
          $hra_ticket=  date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");
         $nombre_asignado=  MysqlQuery::RequestPost('nombre_asignado');
         $email_asignado= MysqlQuery::RequestPost('email_asignado');
          $puesto_ticket= MysqlQuery::RequestPost('puesto_ticket');
          $departamento_ticket= MysqlQuery::RequestPost('departamento_ticket');
	      $prioridad_ticket= MysqlQuery::RequestPost('prioridad_ticket');
          $asunto_ticket= MysqlQuery::RequestPost('asunto_ticket');        
          $descripcion_ticket=  MysqlQuery::RequestPost('descripcion_ticket');
			
			//Enviamos el mensaje ala Bd
			
			 
$sql3 = "INSERT INTO tickets (asignado, fecha_alta, hra_creacion, serie ,id_usuario_tk, id_asunto, mensaje, imagen_tk , id_prioridad_tk) VALUES ('$nombre_asignado','$fecha_ticket', '$hra_ticket', '$id_ticket', '$iduser', '$asunto_ticket', '$descripcion_ticket', '$destino1', '$prioridad_ticket')";
$res4=mysqli_query($con,$sql3);//El campo ID de esta tabla es AUTO_INCREMENT  
    
    
           if ($res4){
        $nombre_asignado = utf8_decode($_POST['nombre_asignado']);
        $nombre_s = utf8_decode($_POST['nombre_s']);
        $user_reg = $_POST['user_reg'];
        $clave_reg2 = $_POST['clave_reg'];
        $email_reg = $_POST['email_reg'];

        //Preparamos el mensaje de contacto/ /
        $cabeceras = "From: Registro de cuenta al Sistema de Orden de Mejora LA Y GRIEGA"; //La persona que envia el correo
        $asunto = "Datos de cuenta"; //El asunto
        $email_to = "$email_reg, sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Hola ".$nombre_asignado.", Gracias por registrarte al Sistema OM de Abarrotes LA Y GRIEGA. Los datos de tu cuenta son los siguientes:
         \nNombre Completo: ".$nombre_s."
         \nNombre de usuario: ".$user_reg."
        \nClave: ".$clave_reg2."
        \nEmail: ".$email_reg."
        \n Para poder accesar Visitanos: http://www.sistemaom.laygriega.com.mx";

        //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras ));
/*


    	  /*
            ----------Enviar correo con los datos del
            -------
            	 /*Fin codigo numero de ticket
		  $solicitud_ticket = $_POST['solicitud_ticket'];
		  $fecha_ticket = $_POST['fecha_ticket'];
		  $nombre_ticket = utf8_decode($_POST['name_ticket']);
		  $email_ticket = $_POST['email_ticket'];
		
		  //Preparamos el mensaje de contacto
			
		  $cabeceras = "From: ORDEN DE MEJORA LA Y GRIEGA"; //La persona que envia el correo
		  $asunto= "Numero de Folio de Orden de Mejora del Sistema OM"; //El asunto
		  $email_to = "$email_ticket, sistemaom@laygriega.com.mx"; //cambiar por tu email
		  $mensaje_mail="Hola ".$nombre_ticket.",Gracias por reportarnos su problema! Buscaremos una solucion para su problema lo mas pronto posible. Su Orden ID es: ".$id_ticket.",
		  \n Solicitado Con Fecha: ".$fecha_ticket.",
           \n Dirigido o solicitado al departamento: ".$solicitud_ticket.",
		  \n Para poder Consultar su estatus de Su Orden De Trabajo, Visitanos en el siguiente Enlace: http://sistemaom.laygriega.com.mx";

		  //Enviamos el mensaje y comprobamos el resultado
		  if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;*/
		  
            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">ORDEN DE MEJORA CREADO</h4>
                    <p class="text-center">
                        Orden creado con exito '.$_SESSION['usuario'].'<br>LA ORDEN ID es: <strong>'.$id_ticket.'</strong>
                    </p>
                </div>
            ';

          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido crear la Orden. Por favor intente nuevamente.
                    </p>
                </div>
            ';
          }
        } 
?>
 <?php

//Get all departamento data
$query = mysqli_query($con,"SELECT * FROM departamento WHERE estatus_dep = 1 LIMIT 1,12");

//Count total number of rows
$rowCount = $query-> num_rows;
?>

<div class="wrapper">
  <!-- Main Header -->
  <?php include "./inc/main-header.php"; ?>  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include "./inc/main-sidebar.php"; ?>  
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Solicitud de Ticket
        <small>LA Y GRIEGA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./admin.php?view=administrador"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Administrar Tickets</li>
           <li><a href="./admin.php?view=tickets"><i class="fa fa-ticket"></i> Tickets</a></li>
        <li class="active">Alta de Ticket</li>
      </ol>
    </section>
       <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
  <div class="box box-info">
            
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Formulario de Solicitu de Ticket</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
             <form role="form" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-3">
              <div class="form-group">

                <label >Fecha de Alta:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="fecha_ticket" readonly value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>">
                </div>
                <!-- /.input group -->
              </div>
                
                       <div class="form-group">
              	<label>Departamento Asignado:</label>
		<select class="form-control" id="departamento">
    <option value="">Seleccione depto</option>
    <?php
    if($rowCount > 0){
         
        while($row = mysqli_fetch_assoc($query)){ 
            echo '<option value="'.$row['id_departamento'].'">'.$row['departamento'].'</option>';
        }
    }else{
        echo '<option value="">departamento no disponible</option>';
    }
    ?>
</select>
                        
   
                  <!-- /.input group -->
                </div>
              <!-- /.form-group -->
               
              <!-- /.form-group -->
     		  <div class="form-group">

                <label>Nombre Asignado:</label>
        <select class="form-control" name="nombre_asignado" id="nombre_asignado" readonly>
    <option value="">Seleccione asunto primero</option>
</select> 
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                 <div class="form-group">
                  <label>Nombre del Solicitante:</label>

                  <div class="input-group">
                    <input type="text" class="form-control" name="nombre_s" readonly value="<?php echo $grado." ".utf8_encode($nombre)." ".utf8_encode($apellidos);?>
">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
              <!-- /.form-group -->
       <div class="form-group">
                   <label>Puesto Asignado:</label>
<select class="form-control" name="puesto" id="puesto">
    <option value="">Seleccione departamento primero</option>
</select>

              </div>
              <!-- /.form-group -->
  		<div class = "form-group">
              <label>Email Asignado:</label>
						<select class="form-control" name="email_asignado" id="email_asignado" readonly>
    <option value="">Seleccione puesto primero</option>
</select>
						</div>
                
                         <!-- /.form-group -->
        
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
            <div class="form-group">
                <label >Correo del Solicitante:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control"  name="email_ticket"readonly value="<?php echo utf8_encode($_SESSION['email']); ?>">
                </div>
                <!-- /.input group -->
              </div>
               <!-- /.form-group -->
  		<div class = "form-group">
              <label>Asunto:</label>
						<select class="form-control" name="asunto_ticket" id="asunto">
    <option value="">Seleccione puesto primero</option>
</select>
						</div>
              <!-- /.form-group -->
                    <div class="form-group">
                   <label>Prioridad:</label>
                       <select class="form-control" required name="prioridad_ticket">
                                <option value="0">Seleccione un Priridad:</option>
                                     <?php 
            $query = Mysql::consulta ("SELECT * FROM prioridad_tk");
            while ($puesto = mysqli_fetch_array($query)){
            echo "<option value='".$puesto['id_prioridad_tk']."'>".$puesto['prioridad']."</option>";
            }?>                 
        </select>
              </div>
              <!-- /.form-group -->
            </div>
                               <!-- /.form-group -
                      <div class="col-md-1">
              <div class="form-group">
                              <div class="image view view-first">
                            <img class="thumb-image" style="width: 100%; display: block;" src="img/tickets.jpg" alt="image" />
                        </div>
                  </input group 
                </div>--
       
            </div>-->
                 <div class="col-md-9">
  		<div class = "form-group">
					<label>Requerimiento:</label>
                  <textarea class="form-control" rows="4"  name="descripcion_ticket" placeholder="Por favor de Describir el problema que presenta"  pattern="[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ.-]+{1,400}" ></textarea>
						</div></div>
                    
              <div class="col-md-9">
              <div class="form-group">
                  <label for="exampleInputFile">Subir Imagen:</label>
 <input id="file_url" name="foto1" type="file" id="foto1">
                  <p class="help-block">Formatos Soportado Jpg, Png y Gif</p>
                <img id="img_destino" alt="Tu imagen" width="300" class="img-responsive" >
                <!-- /.input group -->
              </div>
                  </div>
            <!-- /.col -->
                         <div class="row no-print">
        <div class="col-xs-6">
          <button name="guardar" type="submit" class="btn btn-primary pull-right"><i class="fa fa-credit-card"></i> Guardar
          </button>
            <a href="./admin.php?view=tickets" class="btn btn-default pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Cancelar</a>
      
        </div>
      </div>
                 </form>
          </div>
          <!-- /.row -->
        </div>
           
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
          </div>

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
                    $('#asunto').html('<option value="">Seleccione departamento primero</option>'); 
                    $('#nombre_asignado').html('<option value="">Seleccione nombre primero</option>'); 
                     $('#email_asignado').html('<option value="">Seleccione email primero</option>'); 
                }
            }); 
        }else{
            $('#puesto').html('<option value="">Seleccione puesto primero</option>');
            $('#asunto').html('<option value="">Seleccione asunto primero</option>'); 
            $('#nombre_asignado').html('<option value="">Seleccione nombre primero</option>'); 
            $('#email_asignado').html('<option value="">Seleccione email primero</option>'); 
        }
    });
    
    $('#puesto').on('change',function(){
        var puestoID = $(this).val();
        if(puestoID){
            $.ajax({
                type:'POST',
                url:'./sentencias/select-departamento-puesto.php',
                data:'puesto_id='+puestoID,
                success:function(html){
                    $('#asunto').html(html);
                }
            }); 
        }else{
            $('#asunto').html('<option value="">Seleccione puesto primero</option>'); 
        }
    });
        $('#puesto').on('change',function(){
        var puestoID = $(this).val();
        if(puestoID){
            $.ajax({
                type:'POST',
                url:'./sentencias/select-departamento-puesto.php',
                data:'id_puesto='+puestoID,
                success:function(html){
                    $('#nombre_asignado').html(html);
                }
            }); 
        }else{
            $('#nombre_asignado').html('<option value="">Seleccione puesto primero</option>'); 
        }
    });

            $('#puesto').on('change',function(){
        var puestoID = $(this).val();
        if(puestoID){
            $.ajax({
                type:'POST',
                url:'./sentencias/select-departamento-puesto.php',
                data:'idpuesto='+puestoID,
                success:function(html){
                    $('#email_asignado').html(html);
                }
            }); 
        }else{
            $('#email_asignado').html('<option value="">Seleccione puesto primero</option>'); 
        }
    });
});
</script>
 <script>
function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#img_destino').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
 }
}
 
$("#file_url").change(function(){
 mostrarImagen(this);
});
</script>

 <script>

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=alta-ticket"}
        $(this).remove(); 
    });
}, 1000);
 
});
</script>
