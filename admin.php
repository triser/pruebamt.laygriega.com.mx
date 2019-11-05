<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');

if($_SESSION['rol']!="2"){
    session_unset();
    session_destroy();
    header("Location: ./index.php"); 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administracion</title>
        <?php include "./inc/links.php"; ?>    
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php
            $WhiteList=["administrador","asesor-externo","usuarios","alta-usuario","config","edit-usuario","perfil","edit-perfil","actualizacion-cuenta","bajauser","tickets","alta-ticket","asunto-ticket","alta-asunto","alta-asunto-ticket","baja-asunto-ticket","tickets-recibidos","tickets-enviados","admin-detalle-tickets"];
            if(isset($_GET['view']) && in_array($_GET['view'], $WhiteList) && is_file("./admin/".$_GET['view']."-view.php")){
                include "./admin/".$_GET['view']."-view.php";
            }else{
                echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
            }
        ?>


      <?php include "./inc/links-footer.php"; ?>   
        <script>
        $(document).ready(function (){

            $("#input_user").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form").html(data);
                    }
                });
            });


            $("#input_user2").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form2").html(data);
                    }
                });
            });

        });
 </script>
</body>
</html>