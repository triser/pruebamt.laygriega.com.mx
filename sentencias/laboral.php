
   <?php
 include "../lib/config2.php";//Contiene funcion que conecta a la base de datos
	
if (empty($_GET['id'])){
		$errors[] = "ID está vacío.";
	} elseif (!empty($_GET['id'])){
	// escaping, additionally removing everything that could be (html/javascript-) code
    $nom = mysqli_real_escape_string($con,(strip_tags($_POST["nom"],ENT_QUOTES)));
	$ape = mysqli_real_escape_string($con,(strip_tags($_POST["ape"],ENT_QUOTES)));
	$nss = mysqli_real_escape_string($con,(strip_tags($_POST["nss"],ENT_QUOTES)));
    $pu = mysqli_real_escape_string($con,(strip_tags($_POST["puesto"],ENT_QUOTES)));

	
	$id=intval($_GET['id']);
	// UPDATE data into database
    $sql = "UPDATE empleado_laboral SET nombre='".$nom."', apellidos='".$ape."', nss='".$nss."', idpuesto='".$pu."' WHERE idusuario='".$id."' ";
    $query = mysqli_query($con,$sql); or die(mysqli_error($con)); 
    
    // if product has been added successfully
    if ($query) {
        $messages[] = "El producto ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
	}
if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>			