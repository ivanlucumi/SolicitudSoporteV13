 <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{!! url('/tecnico/Solicitudes')!!}"><i class="fa fa-gavel"></i> <span>Crear Solicitudes</span></a></li>
        <li><a href="{!! url('/tecnico/missolicitudes')!!}"><i class="fa fa-address-book"></i> <span>Revisar mis Solicitudes</span></a></li>
        <li><a href="{!! url('/tecnico/ciudad')!!}"><i class=" fa fa-plane" ></i> <span></span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span></span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>