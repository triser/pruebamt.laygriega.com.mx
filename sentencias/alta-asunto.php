<?php
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['asunto'])) {
           $errors[] = "asunto vacío";
		} else if ($_POST['puesto']==""){
			$errors[] = "Selecciona el puesto";
		} else if (
			!empty($_POST['asunto']) &&
			!empty($_POST['puesto'])
		){

        include "../lib/config2.php";//Contiene funcion que conecta a la base de datos
        
		// escaping, additionally removing everything that could be (html/javascript-) code
		$asunto=mysqli_real_escape_string($con,(strip_tags($_POST["asunto"],ENT_QUOTES)));
		$puesto=mysqli_real_escape_string($con,(strip_tags($_POST["puesto"],ENT_QUOTES)));
	
        
			
			$sql="INSERT INTO asunto (asunto, idpuesto) VALUES ('$asunto','$puesto')";
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "El Asunto ha sido ingresado satisfactoriamente.";
                
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
			
		}else{
			$errors []= "Error desconocido.";
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
    <script>
$(document).ready(function () {
window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){{window.top.location="./admin.php?view=asunto-ticket"}
        $(this).remove(); 
    });
}, 1000);
});
</script>