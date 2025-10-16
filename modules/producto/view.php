<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=producto">producto</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos del Producto
        <a class="btn btn-primary btn-social pull-right" href="?module=form_producto&form=add" title="Agregar" data-toggle="tooltip">
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
                        <a class="btn btn-warning btn-social pull-right" href="modules/producto/print.php" target="_blank">
                            <i class="fa fa-print"></i>Imprimir
                        </a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de deposito</h2>
                        <thead>
                            <tr>
                               <th class="center">Codigo</th>
                                <th class="center">Tipo Producto</th>
                                <th class="center">unidad de medida</th>
                                <th class="center">Desc. Producto</th>
                                <th class="center">Precio</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nr=1;
                                $query = mysqli_query($mysqli, "SELECT * FROM v_producto") 
                                or die ('error'.mysqli_error($mysqli));
                                
                                while($data = mysqli_fetch_assoc($query)){
                                    $cod_proveedor = $data['cod_producto'];
                                    $t_p_descrip = $data['t_p_descrip']; 
                                    $ruc = $data['u_descrip'];
                                    $direccion = $data['p_descrip'];
                                    $telefono = $data['precio']; 

                                    echo "<tr>
                                    <td class='center'>$cod_proveedor</td>
                                    <td class='center'>$t_p_descrip</td>
                                    <td class='center'>$ruc</td>
                                    <td class='center'>$direccion</td>
                                    <td class='center'>$telefono</td>
                                    <td class='center' width='80'>
                                    <div>
                                    <a data-toggle='tooltip' data-placement='top' title='Modificar datos de Producto' style='margin-right:5px' 
                                    class='btn btn-primary btn-sm' href='?module=form_producto&form=edit&id=$data[cod_producto]'>
                                    <i class='glyphicon glyphicon-edit' style='color:#fff'></i></a>";
                                    ?>
                                    <a data-toggle="tooltip" data-data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm" 
                                    href="modules/producto/proces.php?act=delete&cod_producto=<?php echo $data['cod_producto'];?>"
                                    onclick="return confirm('¿Estás seguro de eliminar <?php echo $data['p_descrip'];?>?')">
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