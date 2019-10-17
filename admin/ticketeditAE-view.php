<?php
	if(isset($_POST['id_edit']) && isset($_POST['solucion_ticket']) && isset($_POST['estado_ticket']) && isset($_POST['fecha2_ticket'])){
		$id_edit=MysqlQuery::RequestPost('id_edit');
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');
		$solucion_edit=  MysqlQuery::RequestPost('solucion_ticket');
		$radio_email=  MysqlQuery::RequestPost('optionsRadios');
		$fecha2_edit=  MysqlQuery::RequestPost('fecha2_ticket');
        $hra2_edit=  MysqlQuery::RequestPost('hra2_ticket');
	    $email_edit=  MysqlQuery::RequestPost('email_ticket');
	    $name_edit=  MysqlQuery::RequestPost('name_ticket');
	    $serie_edit=MysqlQuery::RequestPost('serie_ticket');

	/*	$cabecera="From: Sistema OT La Y Griega<sistemas2@laygriega.com.mx>";
		$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");*/

		if(MysqlQuery::Actualizar("ticket", "estado_ticket='$estado_edit', solucion='$solucion_edit', fechaE='$fecha2_edit', hra_E='$hra2_edit'", "id='$id_edit'")){

			echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET Actualizado</h4>
                    <p class="text-center">
                        El ticket fue actualizado con exito
                    </p>
                </div>
            ';
			if($radio_email=="option2"){
				/*addslashes($email_edit, $asunto_edit, $mensaje_mail, $cabecera);----------Fin codigo numero de ticket*/

              $name_edit = utf8_decode($_POST['name_ticket']);
              $solucion_edit = utf8_decode($_POST['solucion_ticket']);

          //Preparamos el mensaje de contacto
        $cabeceras = "From: Tu Orden fue actualizado Exitosamente"; //La persona que envia el correo
        $asunto = "Actualizacion de Orden de Mejora"; //El asunto
        $email_to = "$email_edit, sistemaom@laygriega.com.mx"; //cambiar por tu email
        $mensaje_mail="Estimado usuario ".$name_edit." Su Orden de Mejora esta Resuelto con Fecha: ".$fecha2_edit.".
        \nfolio: ".$serie_edit." 
        \n La solución a su problema es la siguiente:".$solucion_edit;
       
       

          //Enviamos el mensaje y comprobamos el resultado
        if (@mail($email_to, $asunto ,$mensaje_mail ,$cabeceras )) ;
			}

		}else{
			echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido actualizar el ticket
                    </p>
                </div>
            '; 
		}
	}     

	     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

?>


        <!--************************************ Page content******************************-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
               <center><img src="./img/Edit.png" alt="Image" class="img-responsive animated tada"></center>
            </div>
            <div class="col-sm-9">
                <a href="./admin.php?view=reporteAE" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Tickets</a>
            </div>
          </div>
        </div>
          <div class="container">
            <div class="col-sm-12">
                 <form class="form-horizontal" role="form" action="" method="POST">
                		<input type="hidden" name="id_edit" value="<?php echo $reg['id']?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha Hrs de Solicitud</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
                                    <input class="form-control" readonly type="text" name="fecha_ticket" readonly=""  style="border:f92913; background-color: #fef9e7" value="<?php echo $reg['fecha']?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                    <div class='col-sm-5'>
                                <div class="input-group">
                                    <input class="form-control" readonly type="text" name="fecha_ticket" readonly=""  style="border:f92913; background-color: #fef9e7" value="<?php echo $reg['hra_creacion']?>">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Serie</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" readonly type="text" name="serie_ticket" readonly="" style="border:f92913; background-color: #ebf5fb
" value="<?php echo $reg['serie']?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <select class="form-control" name="estado_ticket">
                                        <option value="<?php echo $reg['estado_ticket']?>"><?php echo $reg['estado_ticket']?> (Actual)</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="Resuelto">Resuelto</option>
                                        <option value="Cancelado">Cancelado</option>
                                      </select>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly class="form-control"  name="name_ticket" readonly="" style="border:f92913; background-color: #ebf5fb
" value="<?php echo utf8_encode($reg['nombre_usuario']); ?>">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="email" readonly class="form-control"  name="email_ticket" readonly="" style="border:f92913; background-color: #ebf5fb
" value="<?php echo $reg['email_cliente']?>">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Departamento</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly class="form-control"  name="departamento_ticket" readonly="" style="border:f92913; background-color: #ebf5fb
" value="<?php echo $reg['departamento']?>">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly class="form-control"  name="asunto_ticket" readonly="" style="border:f92913; background-color: #ebf5fb
" value="<?php echo utf8_encode($reg['asunto']); ?>">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Mensaje</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" readonly rows="3"  name="mensaje_ticket" readonly="" style="border:f92913; background-color: #ebf5fb"><?php echo utf8_encode($reg['mensaje']); ?></textarea>
                          </div>
                        </div>
                    
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Solución</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="solucion_ticket" required ><?php echo utf8_encode($reg['solucion']); ?></textarea>
                          </div>
                        </div>
                  
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha hra de Entrega</label>
                            <div class='col-sm-5'>
                                <div class="input-group">
            <input required aria-required="true" class="form-control" type="text" value="<?php echo utf8_encode(strftime("%Y-%m-%d")) ?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="fecha2_ticket">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                                    <div class='col-sm-5'>
                                <div class="input-group">
    <input required aria-required="true" class="form-control" type="text" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly="" style="border:f92913; background-color:#e9f7ef" name="hra2_ticket">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                             <div class="row">
                            <div class="col-sm-offset-5">
                            <div class="btn-group btn-group-vertical" data-toggle="buttons">
                            <label class="btn active">
                             <input type="radio" name="optionsRadios" value="option1" checked><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span>&nbsp;&nbsp;No enviar solución al email del usuario</span>
                            </label>
                         <label class="btn">
                         <input type="radio" name="optionsRadios" value="option2"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span>&nbsp;&nbsp;Enviar solución al email del usuario</span>
                        </label>
                         </div>
                        </div>
                         </div>
                    <br>
                        <div class="form-group">
                       <div class="col-sm-offset-2 col-sm-9 text-center">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>&nbsp;Actualizar</button>
                              <a href="./admin.php?view=reporteCS" class="btn btn-success"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver</a>
                          </div>
                        </div>
                      </form>
            </div><!--col-md-12-->
             <script type="text/javascript">
   $(function() {

	$('#fechainput').datepicker({
        dateFormat: 'dd/mm/yy',
        minDate:' 0',
        	firstDay: 1,
					monthNames: ['Enero', 'Febreo', 'Marzo',
					'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre'],
					dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        onSelect: function(datetext){
            var d = new Date(); // for now
            var h = d.getHours();
        		h = (h < 10) ? ("0" + h) : h ;

        		var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

        		datetext = datetext + " " + h + ":" + m ;
            $('#fechainput').val(datetext);
            
        },
    });
});
   
   </script>
   <script type="text/javascript">
     $(document).ready(function(){
      $("#cancelar").click(function(){
       history.back(1);
     });

    });
  </script>
          </div><!--container-->
