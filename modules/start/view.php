<?php
    if($_SESSION['permisos_acceso'] == 'Super Admin'){?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-title"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p style="font-size=15px">
                        <i class="icon fa fa-user"></i>Bienvenido/a <strong><?php echo $_SESSION['name_user'] ?></strong>
                        a la aplicación: <strong>Sysweb</strong>
                    </p>
                </div>
            </div>
        </div>
    
        <h2>Formulario de Compras</h2>
        <!-- Fila principal de los bloques -->
        <div class="row">
            <!-- Bloque 1 Compras -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#00c0EF; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Compras</strong></p>
                        <ul>
                            <li>Registrar</li>
                            <li>la compra</li>
                            <li>de Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-piggy-bank"></i>
                    </div>
                    <a href="?module=compras" class="small-box-footer" title="Registrar Compras" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 1 Compras -->

            <!-- Bloque Pedidos -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#3c8dbc; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Pedidos</strong></p>
                        <ul>
                            <li>Crear</li>
                            <li>Listar</li>
                            <li>Gestionar pedidos</li>
                        </ul>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="?module=pedidos" class="small-box-footer" title="Ver Pedidos" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque Pedidos -->

            <!-- Bloque 3 Stock -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#EF5800; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Stock de productos</strong></p>
                        <ul>
                            <li>visualizar</li>
                            <li>Stock de</li>
                            <li>Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-area-chart"></i>
                    </div>
                    <a href="?module=stock" class="small-box-footer" title="Ver Stock de productos" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 3 Stock -->

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between"></div>
                </div>
            </div>
        </div>
        <h2>Formulario de Ventas</h2>
        <div class="row">
             <!-- Bloque 2 Ventas -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#00a65a; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Ventas</strong></p>
                        <ul>
                            <li>Registrar</li>
                            <li>Ventas de</li>
                            <li>Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-plus"></i>
                    </div>
                    <a href="?module=ventas" class="small-box-footer" title="Registrar Ventas" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 2 Ventas -->

            <!-- Bloque Nota de Remisión -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#605ca8; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Nota de Remisión</strong></p>
                        <ul>
                            <li>Crear</li>
                            <li>Imprimir</li>
                            <li>Gestionar</li>
                        </ul>
                    </div>
                    <div class="icon">
                        <i class="fa fa-truck"></i>
                    </div>
                    <a href="?module=remisiones" class="small-box-footer" title="Ver Notas de Remisión" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque Nota de Remisión -->
        </div> 
    </section>
<?php } ?>

<?php
    if($_SESSION['permisos_acceso'] == 'Compras'){?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-title"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p style="font-size=15px">
                        <i class="icon fa fa-user"></i>Bienvenido/a <strong><?php echo $_SESSION['name_user'] ?></strong>
                        a la aplicación: <strong>Sysweb</strong>
                    </p>
                </div>
            </div>
        </div>
    
        <h2>Formulario de movimiento</h2>
        <!-- Fila principal de los bloques -->
        <div class="row">
            <!-- Bloque 1 Compras -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#00c0EF; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Compras</strong></p>
                        <ul>
                            <li>Registrar</li>
                            <li>la compra</li>
                            <li>de Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-piggy-bank"></i>
                    </div>
                    <a href="?module=compras" class="small-box-footer" title="Registrar Compras" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 1 Compras -->

             <!-- Bloque Pedidos -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#3c8dbc; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Pedidos</strong></p>
                        <ul>
                            <li>Crear</li>
                            <li>Listar</li>
                            <li>Gestionar pedidos</li>
                        </ul>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="?module=pedidos" class="small-box-footer" title="Ver Pedidos" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque Pedidos -->

            <!-- Bloque 3 Stock -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#EF5800; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Stock de productos</strong></p>
                        <ul>
                            <li>visualizar</li>
                            <li>Stock de</li>
                            <li>Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-area-chart"></i>
                    </div>
                    <a href="?module=stock" class="small-box-footer" title="Ver Stock de productos" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 3 Stock -->

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between"></div>
                </div>
            </div>
        </div> 
    </section>
<?php } ?>

<?php
    if($_SESSION['permisos_acceso'] == 'Ventas'){?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-title"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p style="font-size=15px">
                        <i class="icon fa fa-user"></i>Bienvenido/a <strong><?php echo $_SESSION['name_user'] ?></strong>
                        a la aplicación: <strong>Sysweb</strong>
                    </p>
                </div>
            </div>
        </div>
    
        <h2>Formulario de movimiento</h2>
        <!-- Fila principal de los bloques -->
        <div class="row">
            <!-- Bloque 2 Ventas -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#00a65a; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Ventas</strong></p>
                        <ul>
                            <li>Registrar</li>
                            <li>Ventas de</li>
                            <li>Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-plus"></i>
                    </div>
                    <a href="?module=ventas" class="small-box-footer" title="Registrar Ventas" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 2 Ventas -->

             <!-- Bloque Nota de Remisión -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#605ca8; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Nota de Remisión</strong></p>
                        <ul>
                            <li>Crear</li>
                            <li>Imprimir</li>
                            <li>Gestionar</li>
                        </ul>
                    </div>
                    <div class="icon">
                        <i class="fa fa-truck"></i>
                    </div>
                    <a href="?module=remisiones" class="small-box-footer" title="Ver Notas de Remisión" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque Nota de Remisión -->

            <!-- Bloque 3 Stock -->
            <div class="col-lg-4 col-xs-6">
                <div style="background-color:#EF5800; color:#fff" class="small-box">
                    <div class="inner">
                        <p><strong>Stock de productos</strong></p>
                        <ul>
                            <li>visualizar</li>
                            <li>Stock de</li>
                            <li>Productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-area-chart"></i>
                    </div>
                    <a href="?module=stock" class="small-box-footer" title="Ver Stock de productos" data-toggle="tooltip">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- Fin Bloque 3 Stock -->

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between"></div>
                </div>
            </div>
        </div> 
    </section>
<?php }
?>