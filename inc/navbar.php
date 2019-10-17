<?php
    if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
        include "./process/login.php";
    }
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand">&nbsp;&nbsp; SISTEMA MLT Y GRIEGA &nbsp;&nbsp;<sup><small><span class="label label-danger">V 1.9.1</span></small></sup></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(isset($_SESSION['tipo']) && isset($_SESSION['nombre'])): ?>
            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-sq-sm" data-toggle="dropdown">
                        <span class="fa fa-user-circle-o" style="color:#f1c40f;"></span> &nbsp;Bienvenido:&nbsp;<strong style="color: #f1c40f ;"><?php echo utf8_encode($_SESSION['nombre']); ?></strong> &nbsp;<b class="caret"></b>
                    </a>
                    
                        <!-- usuarios -->
                        
                        <?php if($_SESSION['tipo']=="user"):  ?>
                    <ul class="dropdown-menu">
                         <li>
                    <a href="./index.php?view=soporte"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Solicitud de Ordenes</a>
                        </li>
                        <li>
                            <a href="./index.php?view=configuracion"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                        </li> 
                        <li >
                            <a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a>
                        </li>
                         
                    </ul>
                       <li>
                    <a href="./index.php?view=soporte"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Solicitud de Ordenes</a>
                        </li>
                  <li>
                    <a href="./index.php?view=actividaddiaria"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Actividades</a>
                        </li>
                        <li>
                            <a href="./index.php?view=configuracion"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                        </li>
                        <?php endif; ?>
                        </li>
                        <!-- admins -->
                        
                 <?php if($_SESSION['tipo']=="admin"): ?>
                        <ul class="dropdown-menu">
                        <li> 
                            <a href="admin.php?view=config"><i class="fa fa-cogs"></i> &nbsp;Configuracion Administrador</a>
                        </li> 
                        <li >
                            <a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                         </li>
                        </ul>
                          <li>
                                <a href="admin.php?view=users"><span class="fa fa-users"></span> &nbsp; Usuarios</a>
                        </li>
                         <li>
                             <a href="admin.php?view=admin"><i class="fa fa-users"></i> &nbsp;Administradores</a>
                        </li>
                         <li>
                            <a href="admin.php?view=ticketadmin"><span class="fa fa-ticket"></span> &nbsp; ADMINISTRAR TICKET</a>
                        </li>  
                        <li>
                             <a href="./index.php?view=soporte"><span class="fa fa-ticket"></span>&nbsp;&nbsp;Solicitud de Ticket</a> 
                        </li> 
                    <li>
                    <a href="#" class="dropdown-toggle btn btn-sq-sm " data-toggle="dropdown"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Reportes <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li>
                            <a href="admin.php?view=reporteAE"><span class="fa fa-line-chart"></span>&nbsp;&nbsp;Reporte Asesor Externo</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="admin.php?view=reporteHS"><span class="fa fa-bar-chart"></span>&nbsp;&nbsp;Reporte Software y Hardware</a>
                        
                        </li>
                         <li class="divider"></li>
                        <li >
                            <a href="admin.php?view=reporteCS"><span class="fa fa-pie-chart"></span>&nbsp;&nbsp;Reporte Comunicacion y Seguridad TI</a>
                        
                        </li>
                    </ul>
                </li>
                        
                       <?php endif; ?>  
                       
                        <li>
                            
                            <a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                        <?php endif; ?>
                        
                        <ul class=" nav navbar-nav navbar-right"> 
                         <?php if(!isset($_SESSION['tipo']) && !isset($_SESSION['nombre'])): ?>
                     <li>
                    <a href="./sup.php"><i class="fa fa-user-secret"></i>&nbsp; Iniciar sesión Administrador</a>
                </li>
                <li>
                    <a href="http://www.laygriega.com.mx/"><span class="glyphicon glyphicon-globe"></span> &nbsp;Web LA Y GRIEGA</a>
                </li>
                <li>
                   <a href="./index.php"><i class="fa fa-user"></i>&nbsp; Iniciar sesión Usuario</a>
                </li>
                <li>
                    <a href="./index.php?view=registro"><i class="fa fa-users"></i>&nbsp;&nbsp;Registro</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
</nav>
<!-- Modal HTML
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header"> 
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<div class="avatar">
				<center><img src="img/lay.png" class="img-responsive" alt="Image"></center>
				</div>				
				<center><h4 class="modal-title">Inicio de Sesion de Ordenes de Mejora</h4></center>	
			</div>
			<div class="modal-body">
				<form action="" method="POST">
				           <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" name="nombre_login" placeholder="Ingrese su nombre de Usuario" required=""/>	
                            </div>
                            <br />
                            <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="contrasena_login" placeholder="Ingrese su contraseña" required=""/>	
                            </div>
				            <br />
				            <h4><p>¿Cómo iniciaras sesión?</h4></p>
                  <div class="radio radio-danger">
                                <input type="radio" name="optionsRadios" id="radio3" value="user"checked="">
                                <label for="radio3">
                                   <h4 class="modal-title text-primary" id="modal-md">Usuario</h4>
                                </label>
                            </div>
                            <div class="radio radio-danger">
                                <input type="radio" name="optionsRadios" id="radio4" value="admin" >
                                <label for="radio4">
                                 <h4 class="modal-title text-primary" id="modal-md">Administrador</h4>
                                </label>
                            </div>
           <div class="modal-footer">
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block login-btn"><i class="glyphicon glyphicon-log-in"></i>&nbsp; &nbsp; Iniciar sesión</button>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>   -->   