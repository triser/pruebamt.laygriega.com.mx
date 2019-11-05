<?php
	
	$id=$_GET['id'];
	$asunto=$_POST['asunto'];
	$id_puesto=$_POST['puesto'];

   include "../lib/config2.php";//Contiene funcion que conecta a la base de datos
	
			
			$sql=("UPDATE asunto set  asunto='$asunto', idpuesto='$id_puesto' where id_asunto='$id'");
			$query_update = mysqli_query($con,$sql);
				if ($query_update){
				echo "<script language=\"javascript\">
window.location.href=\"../admin.php?view=asunto-ticket\";
</script>";
				
                
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}

?>
