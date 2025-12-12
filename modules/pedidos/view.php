<?php
//session_start();
//require_once "../../config/database.php";

?>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=pedidos">Pedidos</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-shopping-cart icon-title"></i>Pedidos
        <a class="btn btn-primary btn-social pull-right" href="?module=form_pedidos&form=add" title="Agregar Pedido" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar Pedido
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
                        Pedido guardado correctamente.
                    </div>";
                }

                elseif($_GET['alert']==2){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exitoso!</h4>
                        Pedido anulado correctamente.
                    </div>";
                }

                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Error!</h4>
                        Ocurrió un error.
                    </div>";
                }
            ?>
            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Pedidos</h2>
                        <thead>
                            <tr>
                                <th class="center">Código</th>
                                <th class="center">Proveedor</th>
                                <th class="center">Nro Pedido</th>
                                <th class="center">Fecha</th>
                                <th class="center">Hora</th>
                                <th class="center">Total</th>
                                <th class="center">Estado</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($mysqli, "SELECT p.cod_pedido, p.nro_pedido, p.fecha, p.hora, p.total_pedido, p.estado, pr.razon_social
                                                           FROM pedido p
                                                           JOIN proveedor pr ON p.cod_proveedor = pr.cod_proveedor
                                                           WHERE p.estado <> 'anulado'
                                                           ORDER BY p.cod_pedido DESC")
                            or die('error'.mysqli_error($mysqli));

                            while($data = mysqli_fetch_assoc($query)){
                                $cod = $data['cod_pedido'];
                                $prov = $data['razon_social'];
                                $nro = $data['nro_pedido'];
                                $fecha = $data['fecha'];
                                $hora = $data['hora'];
                                $total = $data['total_pedido'];
                                $estado = $data['estado'];

                                echo "<tr>
                                        <td class='center'>$cod</td>
                                        <td class='center'>".htmlspecialchars($prov)."</td>
                                        <td class='center'>$nro</td>
                                        <td class='center'>$fecha</td>
                                        <td class='center'>$hora</td>
                                        <td class='center'>$total</td>
                                        <td class='center'>$estado</td>
                                        <td class='center' width='140'>";
                                ?>
                                <a data-toggle="tooltip" title="Ver" class="btn btn-info btn-sm"
                                   href="?module=pedidos&form=view&cod_pedido=<?php echo $cod; ?>">
                                   <i class="fa fa-eye"></i>
                                </a>
                                <a data-toggle="tooltip" title="Anular" class="btn btn-danger btn-sm"
                                   href="modules/pedidos/proces.php?act=anular&cod_pedido=<?php echo $cod; ?>"
                                   onclick="return confirm('¿Estás seguro de anular el pedido <?php echo $nro; ?>?');">
                                   <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <?php echo    
                                "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>