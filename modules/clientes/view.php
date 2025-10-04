<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=clientes">Clientes</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos de Clientes
        <a class="btn btn-primary btn-social pull-right" href="?module=form_clientes&form=add" title="Agregar" data-toggle="tooltip">
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
            <div class="box box-primary">
                <div class="box-body">
                    <section class="content-header">
                        <a class="btn btn-warning btn-social pull-right" href="modules/clientes/print.php" target="_blank">
                            <i class="fa fa-print"></i>Imprimir
                        </a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Clientes</h2>
                        <thead>
                            <tr>
                                <th class="center">Codigo</th>
                                <th class="center">Ruc</th>
                                <th class="center">Dpto.</th>
                                <th class="center">ciudad</th>
                                <th class="center">Nombre</th>
                                <th class="center">Apellido</th>
                                <th class="center">Teléfono</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nr=1;
                                $query = mysqli_query($mysqli, "SELECT * FROM v_clientes") 
                                or die ('error'.mysqli_error($mysqli));
                                
                                while($data = mysqli_fetch_assoc($query)){
                                    $id_cliente = $data['id_cliente'];
                                    $ci_ruc = $data['ci_ruc'];
                                    $dep_descripcion = $data['dep_descripcion'];
                                    $descrip_ciudad = $data['descrip_ciudad'];
                                    $cli_nombre = $data['cli_nombre'];
                                    $cli_apellido = $data['cli_apellido'];
                                    $cli_telefono = $data['cli_telefono'];
                                    

                                    echo "<tr>
                                    <td class='center'>$id_cliente</td>
                                    <td class='center'>$ci_ruc</td>
                                    <td class='center'>$dep_descripcion</td>
                                    <td class='center'>$descrip_ciudad</td>
                                    <td class='center'>$cli_nombre</td>
                                    <td class='center'>$cli_apellido</td>
                                    <td class='center'>$cli_telefono</td>
                                    <td class='center' width='80'>
                                    <div>
                                    <a data-toggle='tooltip' data-placement='top' title='Modificar datos de Cliente' style='margin-right:5px' 
                                    class='btn btn-primary btn-sm' href='?module=form_clientes&form=edit&id=$data[id_cliente]'>
                                    <i class='glyphicon glyphicon-edit' style='color:#fff'></i></a>";
                                    ?>
                                    <a data-toggle="tooltip" data-data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm" 
                                    href="modules/clientes/proces.php?act=delete&id_cliente=<?php echo $data['id_cliente'];?>"
                                    onclick="return confirm('¿Estás seguro de eliminar <?php echo $data['cli_nombre'];?>?')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    <?php 
                                    echo " 
                                    </div>
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