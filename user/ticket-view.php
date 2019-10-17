<?php
$nombrefoto1=$_FILES['foto1']['name'];
$ruta1=$_FILES['foto1']['tmp_name'];
if(is_uploaded_file($ruta1))
{ 
if($_FILES['foto1']['type'] == 'image/png' OR $_FILES['foto1']['type'] == 'image/gif' OR $_FILES['foto1']['type'] == 'image/jpeg')
		{
$tips = 'jpg';
$type = array('image/jpeg' => 'jpg');
$name = $id.$nombrefoto1.'.'.$tips;
$destino1 =  "imagenes/".$name;
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

?>
<?php 
        if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])){
        

        if(isset($_POST['fecha_ticket']) && isset($_POST['name_ticket']) && isset($_POST['email_ticket'])){

          /*Este codigo nos servira para generar un numero diferente para cada Orden*/
          $codigo = ""; 
          $longitud = 2; 
          for ($i=1; $i<=$longitud; $i++){ 
            $numero = rand(0,9); 
            $codigo .= $numero; 
          } 
          $num=Mysql::consulta("SELECT * FROM ticket");
          $numero_filas = mysqli_num_rows($num);

          $numero_filas_total=$numero_filas+1;
          $id_ticket="OY".$codigo."N".$numero_filas_total;
			
          /*Fin codigo numero de ticket*/
			
          $fecha_ticket=  MysqlQuery::RequestPost('fecha_ticket');
          $hra_ticket=  MysqlQuery::RequestPost('hra_ticket');
          $nombre_ticket=  MysqlQuery::RequestPost('name_ticket');
          $email_ticket= MysqlQuery::RequestPost('email_ticket');
          $departamento_ticket= MysqlQuery::RequestPost('departamento_ticket');
	      $solicitud_ticket= MysqlQuery::RequestPost('solicitud_ticket');
	      $prioridad_ticket= MysqlQuery::RequestPost('prioridad_ticket');
          $asunto_ticket= MysqlQuery::RequestPost('asunto_ticket');        
          $mensaje_ticket=  MysqlQuery::RequestPost('mensaje_ticket');
          $estado_ticket="Pendiente";
          $fecha2_ticket="";
          $hra2_ticket="";
			
			//Enviamos el mensaje ala Bd
			
			if(MysqlQuery::Guardar("ticket", "fecha,hra_creacion, nombre_usuario, email_cliente, departamento, Prioridad, area_solicitada, asunto, mensaje, foto1, fechaE, hra_E, estado_ticket, serie", "'$fecha_ticket', '$hra_ticket','$nombre_ticket', '$email_ticket', '$departamento_ticket','$prioridad_ticket', '$solicitud_ticket', '$asunto_ticket', '$mensaje_ticket','$destino1','$fecha2_ticket','$hra2_ticket','$estado_ticket','$id_ticket'")){

/*


    	  /*
            ----------Enviar correo con los datos del
            ----------*/
            	 /*Fin codigo numero de ticket*/
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
		  if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
		  
            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">ORDEN DE MEJORA CREADO</h4>
                    <p class="text-center">
                        Orden creado con exito '.$_SESSION['nombre'].'<br>LA ORDEN ID es: <strong>'.$id_ticket.'</strong>
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
        <div class="container">
          <div class="row well">
            <div class="col-sm-3">
              <img src="img/ticket.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-9 lead">
              <h2 class="text-info">¿Cómo abrir una Orden de Mejora?</h2>
              <p>Para abrir una nueva orden de Mejora deberá de llenar todos los campos de el siguiente formulario. Usted podra verificar el estado de su Orden de Mejora de Sistema mediante el <strong>Orden ID</strong> que se le proporcionara a usted cuando llene y nos envie el siguiente formulario.</p>
            </div>
          </div><!--fin row 1-->

          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Formulario de Orden de Mejora</strong></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-4 text-center">
                      <br><br><br>
                      <img src="img/write_email.png" alt=""><br><br>
                      <p class="text-primary text-justify">Por favor llene todos los datos de este formulario para abrir una Orden de Mejora de Sistema. La <strong>Orden ID</strong> será enviado a la dirección de correo electronico proporcionada en este formulario.</p>
                    </div>
                    <div class="col-sm-8">
                      <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
                          <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha y Hora Creacion:</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
                <input class="form-control" type="text" name="fecha_ticket" value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>" readonly="" style="border:f92913; background-color:#fdebd0">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                   <div class='col-sm-5'>
                                <div class="input-group">
                <input class="form-control color-" type="text" name="hra_ticket" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly="" style="border:f92913; background-color:  #fdebd0">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Solicitante:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" name="name_ticket" readonly="" value="<?php echo utf8_encode($_SESSION['nombre_completo']); ?>" readonly="" style="border:f92913; background-color:  #fdebd0 ">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Correo Solicitante:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="email" class="form-control" name="email_ticket" readonly="" value="<?php echo $_SESSION['email']; ?>"readonly="" style="border:f92913; background-color:  #fdebd0 ">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Area del Solicitante:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <select class="form-control" name="departamento_ticket" required >
                                 <option disabled value="" selected hidden>Elige una opción</option>
                                 <option value="Asesor Externo">Asesor Externo</option>
                                  <option value="AComercial">Asistente Comercial</option>
                                  <option value="ADirecciòn">Asistente de Direcciòn</option>
                                  <option value="SGC">Sistemas de Gestion de Calidad</option>
                                  <option value="Contabilidad">Contabilidad</option>
                                  <option value="Carga">Carga</option>
                                  <option value="Cobranza">Credito y Cobranza</option>
                                  <option value="Compras">Compras</option>
                                  <option value="CuentasxPagar">Cuentas por pagar</option>
                                  <option value="CuentasxCobrar">Cuentas por Cobrar</option>
                                  <option value="Descarga">Descarga</option>
                                  <option value="Dirección">Dirección</option>
                                  <option value="Distribución">Distribución</option>
                                  <option value="Facturación">Facturación</option>
                                  <option value="Inventarios">Inventarios</option>
                                  <option value="Operaciones">Operaciones</option>
                                  <option value="Mantenimiento">Mantenimiento</option>
                                  <option value="Marketing">Marketing</option>
                                  <option value="Mostrador">Mostrador</option>
                                  <option value="Súper">Súper</option>
                                  <option value="Hard Y Soft">Hardware Y Software</option>
                                  <option value="TI">Seguridad y Comunicación TI</option>
                                </select>
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asignado A:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <select required aria-required="true" class="form-control" id="asignado" name="solicitud_ticket" required></select>
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>
                        
                        
                              <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                               <select required aria-required="true" class="form-control" id="actividad" name="asunto_ticket"  required></select>
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                                   <div class="form-group">
                          <label  class="col-sm-2 control-label">Prioridad:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <select required aria-required="true" class="form-control" name="prioridad_ticket">
                                  <option value="">Elige una opción </option>
                                  <option value="No urgente">No urgente</option>
                                  <option value="Medio Urgente">Medio Urgente</option>
                                  <option value="Urgente">Urgente</option>
                                </select>
                                <span class="input-group-addon"><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                              </div> 
                          </div>
                        </div>

                         <div class="form-group">
                          <label  class="col-sm-2 control-label">Descripción:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  placeholder="Por favor de Describir el problema que presenta"  pattern="[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ.-]+{1,400}" name="mensaje_ticket" required=""></textarea>
                          </div>
                        </div>
                        
                        
                         <div class="form-group">
                          <label  class="col-sm-2 control-label">Subir Imagen:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input class="form-control" name="foto1" type="file" id="foto1">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button  name="guardar" type="submit" class="btn btn-warning">Guardar Orden</button>
                          </div>
                        </div>
                             </fieldset> 
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php
}else{
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/><br>
                <img src="./img/Stop.png" alt="Image" class="img-responsive"/>
                
            </div>
            <div class="col-sm-7 text-center">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en el Sistema OM</h1>
                <h3 class="text-info">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>
   <script type="text/javascript">

   $(document).ready(function(){
    // Cargamos los departamentos
    var asignado = "<option value='' disabled selected>Selecciona el departamento asignado</option>";

    for (var key in actividades) {
        if (actividades.hasOwnProperty(key)) {
            asignado = asignado + "<option value='" + key + "'>" + key + "</option>";
        }
    }

    $('#asignado').html(asignado);

    // Al detectar
    $( "#asignado" ).change(function() {
        var html = "";
        $( "#asignado option:selected" ).each(function() {
            var asignado = $(this).text();
            if(asignado != "Selecciona el departamento asignado"){
                var actividad = actividades[asignado];
                for (var i = 0; i < actividad.length; i++)
                    html += "<option value='" + actividad[i] + "'>" + actividad[i] + "</option>";
            }
        });
        $('#actividad').html(html);
        $('select').material_select('update');
    })
    .trigger( "change" );
});


var actividades = {
                "Asesor Externo":[
                   "Capacitacion ERP Intelisis","Control de Acceso ERP Intelisis","Desarrollo ERP Intelisis","Escenario Contable ERP Intelisis","Mejora ERP Intelisis","Migración ERP Intelisis","Reportes ERP Intelisis"
                    ],
                "Hardware Y Software":[
                    "Actualizacion Sistema de OM","Instalacion y Configuracion de Reportes Intelisis","Mantenimiento Preventivo Equipos Informaticos","Mantenimiento Correctivo Equipos Informaticos","Perfiles de Usuarios Intelisis","Soporte Aplicación Ecommerce","Soporte ERP Intelisis","Soporte Movil Colibri","Soporte del sistema de OM","Soporte General","Timbrado CFDI"
                    ],
                "Comunicacion y Seguridad TI":[
                     "GPS","Antivirus","Camaras de Seguridad","Conectividad de Red","Compra de Consumibles","Correos Corporativos","Conectividad de Red","Estructura de la Red","Firewall","Mantenimiento Preventivo de Impresora","Mantenimiento Correctivo de Impresora","Telefonia","Soporte Aplicacion Ecommerce","Soporte General"
                    ],
                
            }
   </script>