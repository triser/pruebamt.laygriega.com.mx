<?php 
    $email=MysqlQuery::RequestPost("email_login");
    $clave=md5(MysqlQuery::RequestPost("pass_login"));
    if($email!="" && $clave!=""){
            $sql=Mysql::consulta("SELECT U.idusuario,U.email_usuario, U.usuario,G.grado,EL.nombre,EL.apellidos,U.clave,U.foto_perfil, U.rol, U.estatus,U.fecha_alta_sis
FROM usuario  AS U INNER JOIN empleado_laboral AS EL ON U.idusuario = EL.idusuario INNER JOIN grado_estudio AS G ON EL.idgrado = G.id_grado WHERE email_usuario= '$email' AND clave='$clave' AND rol='2' AND estatus ='1'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
               $_SESSION['active'] = true;
                $_SESSION['id']=$reg['idusuario'];
                $_SESSION['email']=$reg['email_usuario'];
                $_SESSION['clave']=$clave;
                $_SESSION['rol']="2";
                $_SESSION['usuario']=$reg['usuario'];
                $_SESSION['foto_perfil']=$reg['foto_perfil'];
                $_SESSION['fecha_alta']=$reg['fecha_alta_sis'];
                $_SESSION['nombreadmin']=$reg['nombre'];
                
             if($_SESSION['rol']="2"){   
           echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center"> Te damos la más cordial Bienvenida: ' . $email . ' </h4>
                    <p class="text-center">
                        ¡¡ Inicio de Session Exitoso !!
                    </p>
                </div>
            ';
  echo '<script>
  location.href="admin.php?view=administrador";
  </script>' ;   
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
        
        }       
           elseif($_SESSION['rol']="1") {   
            $sql=Mysql::consulta("SELECT U.idusuario,U.email_usuario, U.usuario,G.grado,EL.nombre,EL.apellidos,U.clave,U.foto_perfil, U.rol, U.estatus,U.fecha_alta_sis
FROM usuario  AS U INNER JOIN empleado_laboral AS EL ON U.idusuario = EL.idusuario INNER JOIN grado_estudio AS G ON EL.idgrado = G.id_grado WHERE email_usuario= '$email' AND clave='$clave' AND rol='1' AND estatus ='1'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
               $_SESSION['active'] = true;
                $_SESSION['id']=$reg['idusuario'];
                $_SESSION['email']=$reg['email_usuario'];
                $_SESSION['clave']=$clave;
                $_SESSION['rol']="1";
                $_SESSION['usuario']=$reg['usuario'];
                $_SESSION['foto_perfil']=$reg['foto_perfil'];
                $_SESSION['fecha_alta']=$reg['fecha_alta_sis'];
                $_SESSION['nombreusuario']=$reg['nombre'];
               
 echo '<script>
  location.href="index.php?view=usuario";
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
        } elseif($_SESSION['rol']="4") {   
            $sql=Mysql::consulta("SELECT U.idusuario,U.email_usuario, U.usuario,G.grado,EL.nombre,EL.apellidos,U.clave,U.foto_perfil, U.rol, U.estatus,U.fecha_alta_sis
FROM usuario  AS U INNER JOIN empleado_laboral AS EL ON U.idusuario = EL.idusuario INNER JOIN grado_estudio AS G ON EL.idgrado = G.id_grado WHERE email_usuario= '$email' AND clave='$clave' AND rol='4' AND estatus ='1'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
               $_SESSION['active'] = true;
                $_SESSION['id']=$reg['idusuario'];
                $_SESSION['email']=$reg['email_usuario'];
                $_SESSION['clave']=$clave;
                $_SESSION['rol']="4";
                $_SESSION['usuario']=$reg['usuario'];
                $_SESSION['foto_perfil']=$reg['foto_perfil'];
                $_SESSION['fecha_alta']=$reg['fecha_alta_sis'];
           echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center"> Te damos la más cordial Bienvenida: ' . $email . ' </h4>
                    <p class="text-center">
                        ¡¡ Inicio de Session Exitoso !!
                    </p>
                </div>
            ';
  echo '<script>
  location.href="index.php?view=usuario";
  </script>' ;   
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
        
        }       
else{
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

