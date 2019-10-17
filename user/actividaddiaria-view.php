
<?php 
        if(isset($_SESSION['nombre']) && isset($_SESSION['tipo']) && isset($_SESSION['email'])){
        

        if(isset($_POST['fecha_actividad']) && isset($_POST['nombre_act'])){

      
			
          /*Fin codigo numero de ticket*/
		 $nombre_act=  MysqlQuery::RequestPost('nombre_act'); 	
          $fecha_actividad=  MysqlQuery::RequestPost('fecha_actividad');
          $hra_actividad=  MysqlQuery::RequestPost('hra_actividad');    
          $actdiaria=  MysqlQuery::RequestPost('actdiaria');

			
			//Enviamos el mensaje ala Bd
			
			if(MysqlQuery::Guardar("actividad_diaria", " id_usuario,fecha_act, hora_act, descripcion", "'$nombre_act','$fecha_actividad', '$hra_actividad','$actdiaria'")){

        	  /*
            ----------Enviar correo con los datos 
            ----------*/
            	 /*Fin codigo numero de ticket*/
		  $actdiaria = $_POST['actdiaria'];
		  $fecha_actividad = $_POST['fecha_actividad'];
		  $nombre_act = utf8_decode($_POST['nombre_act']);
		 
		
		  //Preparamos el mensaje de contacto
			
		  $cabeceras = "From: SISTEMA MT"; //La persona que envia el correo
		  $asunto= "Registro de Actividad Diaria"; //El asunto
		  $email_to = "email, sistemaom@laygriega.com.mx"; //cambiar por tu email
		  $mensaje_mail="Hola ".$nombre_act.",Gracias por subir tu Actividad diaria,
		  \n Registrado Con Fecha: ". $fecha_actividad.",  y hora: ". $hra_actividad.",
		  \n Para poder Consultar sus Registros de Actividad Diaria, Visitanos en el siguiente Enlace: http://sistemaom.laygriega.com.mx";

		  //Enviamos el mensaje y comprobamos el resultado
		  if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
		  
            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">ACTIVIDAD DIARIA CREADA</h4>
                    <p class="text-center">
                       La Actividad se creado con exito '.$_SESSION['nombre'].'<br>Con Fecha es: <strong>'.$fecha_actividad.'</strong>
                    </p>
                </div>
            ';

          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido Registrar su Actividad. Por favor intente nuevamente.
                    </p>
                </div>
            ';
          }
        }
        
        
        
?>
        <div class="container">
 

          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Panel de Actividad Diaria</strong></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-sm-12 text-center">
                      <p class="text-primary text-justify">Por favor llene el formulario la  actidad diaria. La <strong>Actividad</strong> será enviado una copia a su dirección de correo electronico proporcionada en este formulario.</p>
                    </div>
                    <div class="col-sm-8">
                      <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
                          <fieldset>
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Solicitante:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" name="nombre_act" readonly="" value="<?php echo utf8_encode($_SESSION['nombre_completo']); ?>" readonly="" style="border:f92913; background-color:  #fdebd0 ">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>
                              
                                      <div class="form-group">
                          <label  class="col-sm-2 control-label">Solicitante:</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                               <input type="email" class="form-control" name="email_ticket" readonly="" value="<?php echo $_SESSION['email']; ?>"readonly="" style="border:f92913; background-color:  #fdebd0 ">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>
                              
                              
                              

                              <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha y Hora Creacion:</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
                <input class="form-control" type="text" name="fecha_actividad" value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>" readonly="" style="border:f92913; background-color:#fdebd0">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                   <div class='col-sm-5'>
                                <div class="input-group">
                <input class="form-control color-" type="text" name="hra_actividad" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly="" style="border:f92913; background-color:  #fdebd0">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>


                        
                              
                              
                              <style class="cp-pen-styles">.note-editor {
  margin-bottom: 5rem !important;
}</style>
<div class="container">

  <?php $content_row=0 ; ?>
  <div id="content-row">

    <div class="form-group">
      <label class="col-sm-12">Contenido de página</label>
      <div class="col-sm-11">
        <textarea class="form-control" id="code_preview0" name="actdiaria" style="height: 300px;"></textarea>
      </div>
    </div>
  </div>
  <?php $content_row++; ?>
</div>
<!-- Page - Content End -->


<script type="text/javascript">
  $(document).ready(function() {
    $('#code_preview0').summernote({height: 300});
    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js'></script>
<script >var content_row = 1;

function addContent() {
  html = '<div id="content-row">';
  html += '<div class="form-group">';
  html += '<label class="col-sm-2">Page Content</label>';
  html += '<div class="col-sm-10">';
  html += '<textarea class="form-control"  id="code_preview' + content_row + '" name="page_code[' + content_row + '][code]" style="height: 300px;"></textarea>';
  html += '</div>';
  html += '</div>';
  html += '</div>';
  $('#content-row').append(html);
  $('#code_preview' + content_row).summernote({height: 300});

  content_row++;
}
//# sourceURL=pen.js
</script>
                              
                              
                              
                              
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button  name="guardar" type="submit" class="btn btn-warning">Enviar</button>
                          </div>
                        </div>
                             </fieldset> 
                      </form>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>        </div>
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

