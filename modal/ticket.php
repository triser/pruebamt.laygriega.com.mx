<!-- Delete -->
    <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                      <div class="modal-header2">
       <center> <h5 class="modal-title" id="exampleModalLongTitle">BAJA DE REGISTRO</h5></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<?php
					 $del = Mysql::consulta("SELECT A.id_asunto,G.grado,EL.nombre, EL.apellidos,D.departamento,P.puesto,A.asunto,A.estatus_a FROM
  asunto AS A LEFT JOIN puestos AS P ON A.idpuesto = P.id_puesto LEFT JOIN departamento AS D ON P.id_depa = D.id_departamento LEFT JOIN empleado_laboral AS EL ON EL.idpuesto = P.id_puesto LEFT JOIN grado_estudio AS G ON EL.idgrado = G.id_grado WHERE id_asunto='".$asunto['id_asunto']."'");
					$drow=mysqli_fetch_array($del);
				?>
                     <img src="img/eliminar2.png">
         
     <h3>¿Estás seguro dar de baja este registro?</h3>
  
              <hr>
              <p>Numero Fila: <span class="spantext"><?php echo $ct; ?></span></p>
      <p>Nombre: <span class="spantext"><?php echo $drow['grado']; ?> <?php echo $drow['nombre']; ?> <?php echo $drow['apellidos'];; ?></span></p>
			<p>Puesto: <span class="spantext"><?php echo $drow['puesto']; ?></span></p>
			<p>Asunto: <span class="spantext"><?php echo $drow['asunto']; ?></span></p>
          <hr>
   <h4>¿Deseas continuar? </h4>

			
				</div>
                <div class="modal-footer">
                    
                       <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <form method="POST" action="sentencias/delete-asunto.php?id=<?php echo $asunto['id_asunto']; ?>" style="display: inline-block;">
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash" onclick="pregunta()"></span> Baja</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar Ticket</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit_ticket= Mysql::consulta("SELECT T.id,T.serie,T.fecha_alta,T.hra_creacion,G.grado,EL.nombre,EL.apellidos,U.email_usuario,D.departamento,PU.puesto,T.asignado,T.email_asignado,A.asunto,T.mensaje,T.imagen_tk,T.solucion, T.fechaE,E.id_estatus_tk,E.estatus_tk,P.prioridad FROM usuario AS U
LEFT JOIN tickets AS T ON  U.idusuario = T.id_usuario_tk 
LEFT JOIN empleado_laboral AS EL ON   U.idusuario = EL.idusuario
LEFT JOIN estatus_tk AS E ON T.estatus_tks = E.id_estatus_tk
LEFT JOIN prioridad_tk AS P ON T.id_prioridad_tk = P.id_prioridad_tk
LEFT JOIN asunto AS A ON   T.id_asunto = A.id_asunto
LEFT JOIN grado_estudio AS G  ON  EL.idgrado = G.id_grado 
LEFT JOIN puestos AS PU ON    A.idpuesto = PU.id_puesto
LEFT JOIN departamento AS D ON  PU.id_depa = D.id_departamento WHERE id='".$row['id']."'");
					$trow=mysqli_fetch_array($edit_ticket);
				?>
				<div class="container-fluid">
			<form method="POST" action="sentencias/ticketedit.php?id=<?php echo $trow['id']; ?>">
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Fecha de Solicitud</label>
						</div>
						<div class="col-lg-5">
                              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                            <input class="form-control"  type="text" value="<?php echo $trow['fecha_alta']; ?>" readonly>
						</div>
                        </div>
                        <div class="col-lg-4">
                    <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                            <input class="form-control"  type="text" value="<?php echo $trow['hra_creacion']; ?>" readonly>
                     </div>
						</div>
					</div>
                <div style="height:10px;"></div>
                	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Serie Ticket </label>
						</div>
						<div class="col-lg-9">
                     <input class="form-control"  type="text" name="serie_ticket" value="<?php echo $trow['serie']; ?>" readonly>
						</div>
					</div>
					<div style="height:10px;"></div>
                   	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Estado Ticket </label>
						</div>
						<div class="col-lg-9">
                               <select class="form-control" name="estado_ticket">
                                      <option value="<?php echo $trow['id_estatus_tk']?>"><?php echo $trow['estatus_tk']?>  (Actual)</option>
                               <?php 
                                                $ti = Mysql::consulta ("SELECT * FROM estatus_tk");
                                                while ($valores = mysqli_fetch_array($ti)){
                                                echo "<option value='".$valores['id_estatus_tk']."'>".$valores['estatus_tk']."</option>";
                                                    }?>
                                </select>
						</div>
					</div>
					<div style="height:10px;"></div>
                	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Nombre del Solicitante </label>
						</div>
						<div class="col-lg-9">
                     <input class="form-control"  type="text" name="name_ticket" value="<?php echo $trow['grado']; ?> <?php echo $trow['nombre']; ?> <?php echo $trow['apellidos']; ?>" readonly>
						</div>
					</div>
					<div style="height:10px;"></div>
                	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Email del Solicitante </label>
						</div>
						<div class="col-lg-9">
                     <input class="form-control"  type="text" name="e_solicitante" value="<?php echo $trow['email_asignado']; ?>" readonly>
						</div>
					</div>
					<div style="height:10px;"></div>
                <div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Departamento del Solicitante </label>
						</div>
						<div class="col-lg-9">
                     <input class="form-control"  type="text" value="<?php echo $trow['departamento']; ?>" readonly>
						</div>
					</div>
					<div style="height:10px;"></div>
                <div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Puesto del Solicitante </label>
						</div>
						<div class="col-lg-9">
                     <input class="form-control"  type="text" value="<?php echo $trow['puesto']; ?>" readonly>
						</div>
					</div>
					<div style="height:10px;"></div>
             	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Asunto </label>
						</div>
						<div class="col-lg-9">
                        <textarea  type="text"  rows="2" name="asunto" class="form-control" readonly><?php echo $trow['asunto']; ?> </textarea>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Descripcion </label>
						</div>
						<div class="col-lg-9">
                        <textarea  type="text"  rows="3" name="mensaje" class="form-control" readonly><?php echo $trow['mensaje']; ?> </textarea>
						</div>
					</div>
					<div style="height:10px;"></div>
                	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Solucion </label>
						</div>
						<div class="col-lg-9">
                        <textarea  type="text"  rows="3" name="solucion_ticket" class="form-control"></textarea>
						</div>
					</div>
					<div style="height:10px;"></div>
                	<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Fecha y Hra Entrega</label>
						</div>
						<div class="col-lg-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                            <input class="form-control"  type="text" name="fecha2_ticket" value="<?php echo strftime("%Y-%m-%d") ?>" readonly>
						</div>
                            </div>
                        <div class="col-lg-4">
                    <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                            <input class="form-control"  type="text" name="hra2_ticket" value="<?php date_default_timezone_set('America/Mexico_city'); echo date("h:i:s A");?>" readonly>
						</div>
                    </div>
					</div>
                <div style="height:10px;"></div>
                 <!-- radio -->
              <!-- radio -->
              <div class="form-group">
                <label>
                  <input type="radio" name="optionsRadios" value="option1" class="flat-red" checked>
                   No enviar solución al email del usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
                <label>
                  <input type="radio" name="optionsRadios" value="option2" class="flat-red">
                   Enviar solución al email del usuario
                </label>
                       
              </div>
            
                
            <!-- /.box-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check" onclick="pregunta()"></span> Guardar</button>
                </div>
				</form>
                      </div>
                  </div> 
            </div>
        </div>
    </div>
