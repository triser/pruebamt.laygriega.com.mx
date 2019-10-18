<form id="actualidarDatos">
<div class="modal fade" id="dataUpdate<?php echo $row['idusuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    	<?php
		$n=mysqli_query($conn,"select * from usuario where idusuario='".$row['idusuario']."'");
		$nrow=mysqli_fetch_array($n);
	?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificar país:</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>
          <div class="form-group">
            <label for="codigo" class="control-label">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required maxlength="2">
			<input type="hidden" class="form-control" id="id" name="id">
          </div>
		  <div class="form-group">
            <label for="nombre" class="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="45">
          </div>
		  <div class="form-group">
            <label for="moneda" class="control-label">Moneda:</label>
            <input type="text" class="form-control" id="moneda" name="moneda" required maxlength="3">
          </div>
		  <div class="form-group">
            <label for="capital" class="control-label">Capital:</label>
            <input type="text" class="form-control" id="capital" name="capital" required maxlength="30"> 
          </div>
		  <div class="form-group">
            <label for="continente" class="control-label">Continente:</label>
            <input type="text" class="form-control" id="continente" name="continente" required maxlength="15">
          </div>
          			Firstname: <input type="text" value="<?php echo $nrow['firstname']; ?>" id="ufirstname<?php echo $urow['userid']; ?>" class="form-control">
			Lastname: <input type="text" value="<?php echo $nrow['lastname']; ?>" id="ulastname<?php echo $urow['userid']; ?>" class="form-control">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>
      </div>
    </div>
  </div>
</div>
</form>