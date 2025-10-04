<!-- Menú lateral -->
<?php 
if($_SESSION['permisos_acceso']=='Super Admin'){ ?>
    <ul class="sidebar-menu">
        <li class="header">Menú</li>
        <?php 
            if($_GET["module"]=="start"){
                $active_home="active";
            }else{
                $active_home="";
            }
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
        </li>

        <?php 
            //if($_GET['module']=="start"){ ?>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="?module=departamento"><i class="fa fa-circle-o"></i>Departamento</a></li>
                        <li><a href="?module=ciudad" ><i class="fa fa-circle-o"></i>Ciudad</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales de compras</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i>Deposito</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Proveedor</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Producto</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales de Ventas</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="?module=clientes"><i class="fa fa-circle-o"></i>Clientes</a></li>
                    </ul>
                </li>

                <?php 
                    if($_GET['module']=="user" || $_GET['module']=="form_user"){ ?>
                        <li class="active">
                            <a href="?module=user"><i class="fa fa-user"></i>Administrar usuarios</a>
                        </li>
                <?php }
                    else{ ?>
                        <li>
                            <a href="?module=user"><i class="fa fa-user"></i>Administrar usuarios</a>
                        </li>
                    <?php  }

                    if($_GET['module']=="password"){ ?>
                        <li class="active">
                            <a href="?module=password"><i class="fa fa-user"></i>Cambiar Contraseña</a>
                        </li>
                <?php }
                    else{ ?>
                        <li>
                            <a href="?module=password"><i class="fa fa-user"></i>Cambiar Contraseña</a>
                        </li>
                    <?php  }
                ?>
        <?php// } ?>
    </ul>
<?php 
}
elseif($_SESSION['permisos_acceso']=='Compras'){ ?>
    <ul class="sidebar-menu">
        <li class="header">Menú</li>
        <?php 
            if($_GET["module"]=="start"){
                $active_home="active";
            }else{
                $active_home="";
            }
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
        </li>

        <?php 
            //if($_GET['module']=="start"){ ?>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="?module=departamento"><i class="fa fa-circle-o"></i>Departamento</a></li>
                        <li><a href="?module=ciudad" ><i class="fa fa-circle-o"></i>Ciudad</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales de compras</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i>Deposito</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Proveedor</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Producto</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
                    </ul>
                </li>
                    <?php
                    if($_GET['module']=="password"){ ?>
                        <li class="active">
                            <a href="?module=password"><i class="fa fa-user"></i>Cambiar Contraseña</a>
                        </li>
                <?php }
                    else{ ?>
                        <li>
                            <a href="?module=password"><i class="fa fa-user"></i>Cambiar Contraseña</a>
                        </li>
                    <?php  }
                ?>
    </ul>
<?php }
elseif($_SESSION['permisos_acceso']=='Ventas'){?>
    <ul class="sidebar-menu">
        <li class="header">Menú</li>
        <?php 
            if($_GET["module"]=="start"){
                $active_home="active";
            }else{
                $active_home="";
            }
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
        </li>

        <?php 
            //if($_GET['module']=="start"){ ?>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="?module=departamento"><i class="fa fa-circle-o"></i>Departamento</a></li>
                        <li><a href="?module=ciudad" ><i class="fa fa-circle-o"></i>Ciudad</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales de Ventas</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="?module=clientes"><i class="fa fa-circle-o"></i>Clientes</a></li>
                    </ul>
                </li>
                    <?php 
                    if($_GET['module']=="password"){ ?>
                        <li class="active">
                            <a href="?module=password"><i class="fa fa-user"></i>Cambiar Contraseña</a>
                        </li>
                <?php }
                    else{ ?>
                        <li>
                            <a href="?module=password"><i class="fa fa-user"></i>Cambiar Contraseña</a>
                        </li>
                    <?php  }
                ?>
    </ul>
<?php }
?>