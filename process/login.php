<?php 
    $nombre=MysqlQuery::RequestPost("nombre_login");
    $clave=md5(MysqlQuery::RequestPost("contrasena_login"));
    $radio=MysqlQuery::RequestPost('optionsRadios');
    if($nombre!="" && $clave!="" && $radio!=""){
        if($radio=="admin"){
            $sql=Mysql::consulta("SELECT * FROM administrador WHERE nombre_admin= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_admin'];
                $_SESSION['id']=$reg['id_admin'];
                $_SESSION['nombre_completo']=$reg['nombre_completo'];
                $_SESSION['email']=$reg['email_admin'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="admin";
                $_SESSION['nombreadmin']=$reg['nombre_admin'];
                     
           echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center"> Te damos la más cordial Bienvenida: ' . $nombre . ' </h4>
                    <p class="text-center">
                        ¡¡ Inicio de Session Exitoso !!
                    </p>
                </div>
            ';
              
  echo '<script>
  location.href="admin.php?view=ticketadmin";
  </script>';       
                
            }else{
               echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        
        }elseif($radio=="user"){
            $sql=Mysql::consulta("SELECT * FROM cliente WHERE email_cliente= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){   
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['nombre_completo']=$reg['nombre_completo'];
                $_SESSION['email']=$reg['email_cliente'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="user";
                $_SESSION['nombre_usuario']=$nombre_usuario;
                $_SESSION['id_cliente']=$reg['id_cliente'];
                $_SESSION['nombreusuario']=$reg['nombre_usuario'];
               
  echo '<script>
  location.href="index.php?view=soporte";
  </script>';     
           echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">¡¡ Te damos la más Cordial Bienvenida: ' . $nombre . ' !! </h4>
                    <p class="text-center">
                       ¡ Inicio de Session Exitoso !
                    </p>
                </div>
            ';
       
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No has seleccionado un usuario valido
                    </p>
                </div>
            ';
        }
    }else{
        echo '
            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                <p class="text-center">
                    No puedes dejar ningún campo vacío
                </p>
            </div>
        ';
        
        
    }