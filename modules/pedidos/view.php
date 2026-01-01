<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=pedidos">Pedidos</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos de Pedidos
        <a class="btn btn-primary btn-social pull-right" href="?module=form_pedidos&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(empty($_GET['alert'])){
                    echo "";
                }
                elseif($_GET['alert']==1){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        Datos registrados correctamente.
                    </div>";
                }

                elseif($_GET['alert']==2){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exitoso!</h4>
                        Datos anulados correctamente.
                    </div>";
                }

                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Error!</h4>
                        No se puede realizar la accion.
                    </div>";
                }
            ?>
            <div class="box box-primary">
                <div class="box-body">
                    <section class="content-header">
                        
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Compras</h2>
                        <thead>
                            <tr>
                                <th class="center">Codigo</th>
                                <th class="center">Nro. Pedido</th>
                                <th class="center">Proveedor</th>
                                <th class="center">Fecha</th>
                                <th class="center">Hora</th>
                                <th class="center">Total</th>
                                <th class="center">Estado</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nr=1;
                                $query = mysqli_query($mysqli, "SELECT * FROM v_pedidos WHERE estado='activo' ") 
                                or die ('error'.mysqli_error($mysqli));
                                
                                while($data = mysqli_fetch_assoc($query)){
                                    $cod = $data['cod_pedido'];
                                    $proveedor = $data['razon_social'];
                                    //$compra = $data['cod_compra'];
                                    $nro_pedido = $data['nro_pedido'];
                                    $fecha = $data['fecha'];
                                    $hora = $data['hora'];
                                    $total_pedido = $data['total_pedido'];
                                    $estado = $data['estado'];


                                    echo "<tr>
                                    <td class='center'>$cod</td>
                                    <td class='center'>$nro_pedido</td>
                                    <td class='center'>$proveedor</td>
                                    <td class='center'>$fecha</td>
                                    <td class='center'>$hora</td>
                                    <td class='center'>$total_pedido</td>
                                    <td class='center'>$estado</td>
                                    <td class='center' width='80'>
                                    <div>";?>
                                    <a data-toogle="tooltip" data-placement="top" title="Anular Compra" class="btn btn-danger btn-sm" 
                                    href="modules/compras/proces.php?act=anular&cod_pedido=<?php echo $data['cod_pedido']; ?>"
                                    onclick="return confirm('¿Estás seguro de anular la factura <?php echo $data['nro_pedido']; ?>?');">
                                        <i style="color:#000" class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    <a data-toggle="tooltip" data-placement="top" title="Imprimir Factura de pedido" class="btn btn-warning btn-sm"
                                    href="modules/pedidos/print.php?act=imprimir&cod_pedido=<?php echo $data['cod_pedido']; ?>" target="_blank">
                                        <i style="color:#000" class="fa fa-print"></i>
                                    </a>
                                    <?php echo " </div>
                                    </td>
                                    </tr>"?>
                                <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>