<?php
	
	$id=$_GET['id'];
	$baja="0";

   include "../lib/config2.php";//Contiene funcion que conecta a la base de datos
	
			
			$sql=("UPDATE asunto set  estatus_a='$baja' where id_asunto='$id'");
			$query_update = mysqli_query($con,$sql);
				if ($query_update){
				echo "<script language=\"javascript\">
window.location.href=\"../admin.php?view=asunto-ticket\";
</script>";
				
                
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}

?>

