<?php
   if(isset($_POST['email_login']) && isset($_POST['pass_login'])){
        include "./process/login.php";
    }
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
 <?php if(isset($_SESSION['rol']) && isset($_SESSION['email'])): ?>
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
     <?php
            //En el if va la variable con la que identificas al usuario
            if($_SESSION['rol'] == "1"){
        ?>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
         <img src="img/profiles/<?php echo $foto_perfil;?>" class="img-circle"  alt="<?php echo $grado." ".utf8_encode($nombre);?>" >
        </div>
        <div class="pull-left info">
          <p><?php echo $grado." ".utf8_encode($nombre);?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

    
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
   <li class="active">><a href="./index.php?view=usuario"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                  <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Ticket´s Enviados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="./index.php?view=tickets"><i class="fa fa-ticket"></i> Enviados</a></li>
              <li><a href="./index.php?view=alta-ticket"><i class="fa fa-ticket"></i>Alta Ticket´s</a></li>
                <li><a href="./index.php?view=alta-ticket"><i class="fa fa-ticket"></i>Comentarios Ticket´s</a></li>
              </ul>     
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Ticket´s Recibidos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="./index.php?view=tickets-recibidos"><i class="fa fa-ticket"></i> Recibidos</a></li>
                <li><a href="./index.php?view=alta-ticket"><i class="fa fa-ticket"></i>Comentarios Ticket´s</a></li>
              </ul>     
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Configuracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="./index.php?view=perfil-usuario"><i class="fa fa-user"></i> Perfil</a></li>
              <li><a href="./index.php?view=cuenta-datos"><i class="fa fa-user"></i> Actualizar Cuenta</a></li>
              </ul>     
        </li>
          <li><a href="./process/logout.php"><i class="fa fa-power-off"></i> <span>Cerrar Session</span></a></li>
      </ul>
       <!-- /.sidebar-menu -->
         <?php } else if($_SESSION['rol'] == "2") { ?>
         <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
       <img src="img/profiles/<?php echo $foto_perfil ;?>" class="img-circle"  alt="<?php echo $nombre;?>" >
        </div>
        <div class="pull-left info">
          <p><?php echo $grado." ".utf8_encode($nombre);?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

    
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->
     <li><a href="./admin.php?view=administrador"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                  <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Administrar Ticket´s</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./admin.php?view=tickets"><i class="fa fa-ticket"></i> Todos los Ticket´s</a></li>
              <li><a href="./admin.php?view=tickets-enviados"><i class="fa fa-ticket"></i>Ticket´s Enviados</a></li>
                <li><a href="./admin.php?view=tickets-recibidos"><i class="fa fa-ticket"></i>Ticket´s Recibidos</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Administrar Asuntos Tk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
               <li><a href="./admin.php?view=asunto-ticket"><i class="fa fa-ticket"></i>Asuntos Ticket´s</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Administrar Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./admin.php?view=usuarios"><i class="fa fa-user-circle"></i> Usuarios</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Configuracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./admin.php?view=perfil"><i class="fa fa-user"></i> Mi Perfil</a></li>
                <li><a href="./admin.php?view=actualizacion-cuenta"><i class="fa fa-user"></i> Actualizar Cuenta</a></li>
          </ul>
        </li>
          <li><a href="./process/logout.php"><i class="fa fa-power-off"></i> <span>Cerrar Session</span></a></li>
      </ul>
       <!-- /.sidebar-menu -->
         <?php } else if($_SESSION['rol'] == "4") { ?>
     <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
         <img src="img/profiles/<?php echo $foto_perfil ;?>" class="img-circle"  alt="<?php echo $nombre;?>" >
        </div>
        <div class="pull-left info">
         <p><?php echo $grado." ".utf8_encode($nombre);?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

    
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Inicio</li>
        <!-- Optionally, you can add icons to the links -->
   <li class="active">><a href="./index.php?view=usuario"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
                  <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i> <span>Administrar Ticket´s</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./index.php?view=tickets"><i class="fa fa-ticket"></i> Ticket´s</a></li>
              <li><a href="./index.php?view=alta-ticket"><i class="fa fa-ticket"></i>Solicitud Ticket´s</a></li>
          </ul>
        </li>
           <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-o"></i> <span>Administrar Actividad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-folder-open-o"></i> Reporte de Act. Diaria</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-folder-o"></i> Actividad Diaria
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-folder-open-o"></i> Actividad Diaria</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-folder-open-o"></i> Estado Actividad
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Urgente</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Medio Urgente</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>No Urgente</span></a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-folder-o"></i> Actividad Semanal
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-folder-open-o"></i> Actividad Semanal</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-folder-open-o"></i> Estado Actividad
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Urgente</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Medio Urgente</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>No Urgente</span></a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="./index.php?view=configuracion"><i class="fa fa-cogs"></i> <span>Configuracion</span></a></li>
          <li><a href="./process/logout.php"><i class="fa fa-power-off"></i> <span>Cerrar Session</span></a></li>
      </ul>
        <?php } ?>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
        <?php endif; ?>
</aside>
