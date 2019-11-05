<?php
header('Content-Type: text/html; charset=UTF-8'); 
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
if(isset($_POST['email_login']) && isset($_POST['pass_login'])){
        include "./process/loginadmin.php";
    }  
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in Adminin</title>
        <?php include "./inc/links.php"; ?> 
        <!-- footer link-->
        <?php include "./inc/links-footer.php"; ?> 
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
         <?php
            if(isset($_GET['view'])){
                $content=$_GET['view'];
    $WhiteList=["admin","administrador","asesor-externo"];
                if(in_array($content, $WhiteList) && is_file("./admin/".$content."-view.php")){
                    include "./admin/".$content."-view.php";
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
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        
                        <div class="panel-title"><i class="fa fa-user-secret"></i>&nbsp;Iniciar sesión Administrador</div>
          
                    </div>     

                    <div style="padding-top:25px" class="panel-body" >
                              <div class="avatar">
                    <center><a title="Iniciar Session Administradores" href="index.php"><img src="img/admin.png" class="img-responsive" alt="Image"></a></center>
                </div>

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form action="" method="POST" id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                               
                                        <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>
                                        <input id="login-username" type="text" class="form-control"  name="email_login" value="" placeholder="Usuario Administrador" required>                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="pass_login"  placeholder="Contraseña" required>
                                    </div>
                                    <div style="float:left; font-size: 80%; position: relative; top:-10px"><a href="#">Olvidaste tu contraseña?</a></div>
                                <div style="margin-top:10px" class="form-group">
                                        <div style="margin-bottom: 25px" class="input-group">  
                                     <input type="hidden" name="rol" id="radio3" value="2">
                                        <label for="radio3">
                                        </label>
                                   </div>
                                    <br>
                                    <div class="col-sm-12 controls" style="margin-left:24%">
                                      
                                        <button type="submit" class="btn btn-primary login-btn"><i class="glyphicon glyphicon-log-in"></i> &nbsp; Iniciar sesión</button>
                                         <button  type="reset" value="Borrar" class="btn btn-success"><i class="fa fa-trash-o"></i>&nbsp; Cancelar</button>
                                     

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
             
             
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                      
                         </div>
                    </div>

               
               
      
    </div>
<br>
                <?php
            }
        ?>


     

</body>
</html>
