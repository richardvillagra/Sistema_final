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
            if($_GET['module']=="start"){ ?>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#" target="_blank"><i class="fa fa-circle-o"></i>Ciudad</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-file-text"></i><span>Referenciales de compras</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i>Deposito</a></li>
                    </ul>
                </li>
        <?php } ?>
    </ul>
<?php 
}
?>