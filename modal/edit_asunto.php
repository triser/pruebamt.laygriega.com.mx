<!-- Delete -->
    <div class="modal fade" id="del<?php echo $asunto['id_asunto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
      <p>Nombre: <span class="spantext"><?php echo $drow['grado']; ?> <?php echo utf8_encode($drow['nombre']); ?> <?php echo utf8_encode($drow['apellidos']);; ?></span></p>
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

<!-- Alta Asunto -->
    <div class="modal fade" id="deli<?php echo $asunto['id_asunto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                      <div class="modal-header3">
       <center> <h5 class="modal-title" id="exampleModalLongTitle">ALTA DE REGISTRO</h5></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<?php
					 $del = Mysql::consulta("SELECT A.id_asunto,G.grado,EL.nombre, EL.apellidos,D.departamento,P.puesto,A.asunto,A.estatus_a FROM
  asunto AS A LEFT JOIN puestos AS P ON A.idpuesto = P.id_puesto LEFT JOIN departamento AS D ON P.id_depa = D.id_departamento LEFT JOIN empleado_laboral AS EL ON EL.idpuesto = P.id_puesto LEFT JOIN grado_estudio AS G ON EL.idgrado = G.id_grado WHERE id_asunto='".$asunto['id_asunto']."'");
					$drow=mysqli_fetch_array($del);
				?>
                     <img src="img/eliminar2.png">
         
     <h3>¿Estás seguro dar de alta este registro?</h3>
  
              <hr>
              <p>Numero Fila: <span class="spantext"><?php echo $ct; ?></span></p>
                <p>Nombre: <span class="spantext"><?php echo $drow['grado']; ?> <?php echo utf8_encode($drow['nombre']); ?> <?php echo utf8_encode($drow['apellidos']);; ?></span></p>
            <p>Departamento: <span class="spantext"><?php echo utf8_encode($drow['departamento']); ?></span></p>
			<p>Puesto: <span class="spantext"><?php echo $drow['puesto']; ?></span></p>
			<p>Asunto: <span class="spantext"><?php echo $drow['asunto']; ?></span></p>
          <hr>
   <h4>¿Deseas continuar? </h4>

			
				</div>
                <div class="modal-footer">
                    
                       <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <form method="POST" action="sentencias/alta-asuntos.php?id_asunto=<?php echo $asunto['id_asunto']; ?>" style="display: inline-block;">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Alta</button>
                        </form>
                </div>
            </div>
        </div>
    </div>


<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $asunto['id_asunto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar el Asunto Ticket</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit= Mysql::consulta("select * from asunto where id_asunto='".$asunto['id_asunto']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
			<form method="POST" action="sentencias/edit-asunto.php?id=<?php echo $erow['id_asunto']; ?>">
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar el Asunto </label>
						</div>
						<div class="col-lg-9">
                        <textarea  type="text"  rows="4" name="asunto" class="form-control"><?php echo $erow['asunto']; ?></textarea>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar Puesto:</label>
						</div>
                        <div class="col-lg-9">
						  <select class="form-control" required name="puesto">
                            <option value="<?php echo $asunto['idpuesto']?>"><?php echo utf8_encode ($asunto['puesto'])?> (Actual)</option>
                                     <?php 
            $query = Mysql::consulta ("SELECT * FROM puestos LIMIT 2,73");
            while ($puesto = mysqli_fetch_array($query)){
            echo "<option value='".$puesto['id_puesto']."'>".utf8_encode ($puesto['puesto'])."</option>";
            }?>
                                
                                
        </select>
				</div>	
					
              
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check" onclick="pregunta()"></span> Guardar</button>
                </div>
				</form>
                      </div>
                  </div> 
            </div>
        </div>
    </div>


