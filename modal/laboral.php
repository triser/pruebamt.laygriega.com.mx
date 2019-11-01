<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $iduser; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar el Asunto Ticket</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$edit= Mysql::consulta("SELECT* FROM empleado_laboral AS EL 
  LEFT JOIN usuario  AS U ON EL.idusuario = U.idusuario
  LEFT JOIN grado_estudio AS G ON  EL.idgrado = G.id_grado
LEFT JOIN puestos AS P ON   EL.idpuesto = P.id_puesto
  LEFT JOIN departamento AS D ON  P.id_depa = D.id_departamento WHERE U.idusuario='".$row['idusuario']."'");
					$erow=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
			<form method="POST" action="sentencias/laboral.php?id=<?php echo $erow['idusuario']; ?>">
                <div class="row">
                    <div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar G. Estudio </label>
						</div>
                    <div class="col-lg-9">
                    <select class="form-control" name="titulo">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                      <option value="<?php echo $erow['id_grado']?>"><?php echo utf8_encode ($erow['grado'])?>  (Actual)</option>
                               <?php 
                                                $ti = Mysql::consulta ("SELECT * FROM grado_estudio");
                                                while ($titulo = mysqli_fetch_array($ti)){
                                                echo "<option value='".$titulo['id_grado']."'>".$titulo['grado']."</option>";
                                                    }?>
                                </select>                </div> </div>
                <div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar Nombre </label>
						</div>
						<div class="col-lg-9">
                        <div class="input-group">
                                    <input class="form-control" type="text" name="nom" value="<?php echo utf8_encode($erow['nombre']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar apellidos:</label>
						</div>
                        <div class="col-lg-9">
					  <div class="input-group">
                                    <input class="form-control" type="text" name="ape" value="<?php echo utf8_encode($erow['apellidos']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
				</div>	
					
              
				</div>
                 <div style="height:10px;"></div>
                           <div class="row">
                    <div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar dpto </label>
						</div>
                    <div class="col-lg-9">
                <select class="form-control" id="departamento">
   <option value="<?php echo $erow['id_departamento']?>"><?php echo utf8_encode ($erow['departamento'])?>  (Actual)</option>
    <?php
    if($rowCount > 0){
         
        while($dep = mysqli_fetch_array($query)){ 
            echo '<option value="'.$dep['id_departamento'].'">'.utf8_encode($dep['departamento']).'</option>';
        }
    }else{
        echo '<option value="">departamento no disponible</option>';
    }
    ?>
                                </select>                
                               </div> 
                </div>
                <div style="height:10px;"></div>
                           <div class="row">
                    <div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar G. Estudio </label>
						</div>
                    <div class="col-lg-9">
                     <select class="form-control" name="puesto" id="puesto">
    <option value="<?php echo $erow['id_puesto']?>"><?php echo utf8_encode ($erow['puesto'])?>  (Actual)</option>
</select>              </div> </div>
                <div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-3">
							<label style="position:relative; top:7px;">Editar nss:</label>
						</div>
                        <div class="col-lg-9">
		  <div class="input-group">
                                    <input class="form-control" type="text" name="nss" value="<?php echo utf8_encode($erow['nss']); ?>">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                </div>
				</div>	
					
              
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
                </div>
				</form>
                      </div>
                  </div> 
            </div>
        </div>
    </div>

