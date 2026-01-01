<?php
//session_start();
//require_once "../../config/database.php";
?>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=ordenes">ordenes</a></li>
    </ol><br><hr>
    <h1><i class="fa fa-file-text-o"></i> Ordenes de Compra
        <a class="btn btn-primary btn-social pull-right" href="?module=ordenes&form=add" title="Agregar Orden" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar Orden
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
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        Datos modificados correctamente.
                    </div>";
                }

                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        Datos eliminados correctamente
                    </div>";
                }

                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Error!</h4>
                        No se pudo realizar la operacion
                    </div>";
                }
            ?>
            <div class="box box-primary"><div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Proveedor</th>
                        <th>Nro</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q = mysqli_query($mysqli, "SELECT o.cod_orden, o.nro_orden, o.fecha, o.total, o.estado, p.razon_social
                                            FROM orden_compra o LEFT JOIN proveedor p ON o.cod_proveedor = p.cod_proveedor
                                            ORDER BY o.cod_orden DESC") or die(mysqli_error($mysqli));
                while($r = mysqli_fetch_assoc($q)){
                    echo "<tr>
                            <td>{$r['cod_orden']}</td>
                            <td>".htmlspecialchars($r['razon_social'])."</td>
                            <td>{$r['nro_orden']}</td>
                            <td>{$r['fecha']}</td>
                            <td>{$r['total']}</td>
                            <td>{$r['estado']}</td>
                            <td>
                            <a class='btn btn-info btn-sm' href='?module=ordenes&form=view&cod_orden={$r['cod_orden']}'><i class='fa fa-eye'></i></a>
                            <a class='btn btn-danger btn-sm' href='modules/ordenes/proces.php?act=anular&cod_orden={$r['cod_orden']}' onclick=\"return confirm('¿Anular orden?');\"><i class='glyphicon glyphicon-trash'></i></a>
                            </td>
                        </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>