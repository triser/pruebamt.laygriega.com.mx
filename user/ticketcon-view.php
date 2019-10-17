<?php

$email_consul=  MysqlQuery::RequestGet('email_consul');
$id_colsul= MysqlQuery::RequestGet('id_consul');

$consulta_tablaTicket=Mysql::consulta("SELECT * FROM ticket WHERE serie= '$id_colsul' AND email_cliente='$email_consul'");
if(mysqli_num_rows($consulta_tablaTicket)>=1){
  $lsT=mysqli_fetch_array($consulta_tablaTicket, MYSQLI_ASSOC); 
  




	if(isset($_POST['estado_ticket'])){
	
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');

		if(MysqlQuery::Actualizar("ticket", "estado='$estado_edit'")){

			echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET Actualizado</h4>
                    <p class="text-center">
                        El ticket fue actualizado con exito
                    </p>
                </div>
            ';
		
	}  }     

	     
	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

?>
        <div class="container">
            <div class="row well">
            <div class="col-sm-2">
                <img src="img/status.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-10 lead text-justify">
              <h2 class="text-info">Estado de Orden de Mejora</h2>
              <p>Si su <strong>Orden de Mejora</strong> no ha sido solucionado aún, espere pacientemente, estamos trabajando para poder resolver su problema y darle una solución.</p>
            </div>
          </div><!--fin row well-->
          <div class="row">
              <div class="col-sm-12">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center"><h4><i class="fa fa-ticket"></i> Orden &nbsp;#<?php echo $lsT['serie']; ?></h4></div>
                      <div class="panel-body">
                          <div class="container">
                              <div class="col-sm-12">
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <img class="img-responsive" alt="Image" src="img/tux_repair.png">
                                      </div>
                                      <div class="col-sm-8">
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Fecha Inicio:</strong> <?php echo $lsT['fecha']; ?></div>
                                              <div class="col-sm-6"><strong>Estado:</strong> <?php echo $lsT['estado_ticket']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Nombre:</strong><?php echo utf8_encode($lsT['nombre_usuario']); ?></div>
                                              <div class="col-sm-6"><strong>Email:</strong> <?php echo $lsT['email_cliente']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Área:</strong> <?php echo $lsT['departamento']; ?></div>
                                              <div class="col-sm-6"><strong>Solicitado A:</strong> <?php echo $lsT['area_solicitada']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                             <div class="col-sm-6"><strong>Prioridad:</strong> <?php echo $lsT['Prioridad']; ?></div>
                                              <div class="col-sm-6"><strong>Asunto:</strong><?php echo utf8_encode($lsT['asunto']); ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-6"><strong>Fecha de Finalización:</strong> <?php echo $lsT['fechaE']; ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-12"><strong>Problema:</strong><?php echo utf8_encode($lsT['mensaje']); ?></div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-sm-12"><strong>Solución:</strong><?php echo utf8_encode($lsT['solucion']); ?></div>
                                            </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="panel-footer text-center">
                          <div class="row">
                              <h4>Opciones</h4>
                              <div class="col-sm-6">
                                  <form action="" method="POST">
                                      <input type="text" value="<?php echo $lsT['serie']; ?>" name="del_ticket" hidden="">
                                      <button class="btn btn-danger" disabled="disabled"><span class="glyphicon glyphicon-trash"></span>&nbsp;  Eliminar Orden</button>
                                  </form>
                              </div>
                              <br class="hidden-lg hidden-md hidden-sm">
                              <div class="col-sm-6">
                                   <button id="save" class="btn btn-success"  data-id="<?php echo $lsT['serie']; ?>"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar ticket en PDF</button>
                              </div>
                          </div>
                      </div>
                    </div>
              </div>
          </div>
        </div>
 <?php }else{ ?>
        <div class="container">
            <div class="row  animated fadeInDownBig">
                <div class="col-sm-4">
                    <img src="img/error.png" alt="Image" class="img-responsive"/><br>
                    <img src="img/SadTux.png" alt="Image" class="img-responsive"/>
                    
                </div>
                <div class="col-sm-7 text-center">
                    <h1 class="text-danger">Lo sentimos ha ocurrido un error al hacer la consulta, esto se debe a lo siguiente:</h1>
                    <h3 class="text-warning"><i class="fa fa-check"></i> Su Orden de Mejora ha sido eliminado completamente.</h3>
                    <h3 class="text-warning"><i class="fa fa-check"></i> Los datos ingresados no son correctos.</h3>
                    <br>
                    <h3 class="text-primary"> Por favor verifique que su <strong> Orden id</strong> y <strong>email</strong> sean correctos, e intente nuevamente.</h3>
                    <h4><a href="./index.php?view=soporte" class="btn btn-primary"><i class="fa fa-reply"></i> Regresar a soporte</a></h4>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
        
<?php } ?>
<script>
  $(document).ready(function(){
    $("button#save").click(function (){
       window.open ("./lib/pdf_user.php?id="+$(this).attr("data-id"));
    });
  });
</script>