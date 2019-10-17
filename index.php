<?php
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
        include "./process/login.php";

    }
     
?>
<?php 

function ae_nocache() 
{
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}

?>
<!DOCTYPE html>
<html>
    <head> 
    <meta http-equiv="Content-Type" content="text/html" charset="UTF8" />
        <title>Sistema OM</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Sistema MT 2019<small> MULTIPLE</small></h1>
                <span class="label label-danger">Distribuidora de la Y Griega S.A de C.V.</span>
                <p class="pull-right text-success">
                  <strong>
                    <!--<span class="glyphicon glyphicon-time"></span>&nbsp;<?php //include "./inc/timezone.php"; ?>-->
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>  
        <?php
            if(isset($_GET['view'])){
                $content=$_GET['view'];
                $WhiteList=["index","soporte","ticket","ticketcon","registro","configuracion","actividaddiaria"];
                if(in_array($content, $WhiteList) && is_file("./user/".$content."-view.php")){
                    include "./user/".$content."-view.php";
                }else{
        ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="img/SadTux.png" alt="Image" class="img-responsive"/><br>
                            <img src="./img/Stop.png" alt="Image" class="img-responsive"/>
                            
                        </div>
                        <div class="col-sm-7 text-center">
                            <h1 class="text-danger">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h1>
                            <h3 class="text-info">Por favor intente nuevamente</h3>
                        </div>
                        <div class="col-sm-1">&nbsp;</div>
                    </div>
                </div>     
               
          <?php
                }
            }else{
                //include "./user/index-view.php";
                ?>
              

        
              <div class="container">    
        <div id="loginbox" style="margin-top:30px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-primary" >
                    <div class="panel-heading">
                        <div class="panel-title"><i class="fa fa-user-circle "></i>&nbsp; Inicio de sesión </div>
                    </div>     
                    <div style="padding-top:25px" class="panel-body" >
                    <div class="avatar">
                    <center><img src="img/lay.png" class="img-responsive" alt="Image"></center>
                </div>
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>  
                        <form action="" method="POST" id="loginform" class="form-horizontal" role="form">     
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                        <input id="login-username" type="text" class="form-control"  name="nombre_login" value="" placeholder="Correo Corporativo" required>                                        
                                    </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="contrasena_login"  placeholder="Contraseña" required>
                                    <!-- Button -->
                                     <input type="hidden" name="optionsRadios" id="radio3" value="user">
                                        <label for="radio3">
                                        </label>
                                    </div>
                                <div class="form-group">
                        
                            
                                    <div class="col-sm-offset-4 col-sm-10">
                                   <button type="submit"  class="btn btn-primary btn-lg login-btn "><i class="glyphicon glyphicon-log-in"></i>&nbsp; &nbsp;Iniciar sesión</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                          Copyright © 2019 todos los derechos reservados
                                             <a href="" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            sistemaom.laygriga.com.mx
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
             
      
                 
      
    </div>
    

<br>
                <?php
            }
        ?>
      <?php include './inc/footer.php'; ?>
    </body>
</html>
