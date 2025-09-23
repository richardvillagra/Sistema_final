<section class="content-header">
    <h1>
        <i class="fa fa-user icon title"></i> Gestión de Usuarios
        <a class="btn btn-primary btn-social pull-right" href="?module=form_user&form=add" title="Agregar" data-toggle="tooltip">
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
                        Los nuevos datos de usuario se han registrado correctamente
                    </div>";
                }

                elseif($_GET['alert']==2){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        Los datos de usuario se han editado correctamente
                    </div>";
                }

                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        El usuario ha sido activado correctamente
                    </div>";
                }

                elseif($_GET['alert']==4){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        El usuario ha sido bloqueado correctamente
                    </div>";
                }

                elseif($_GET['alert']==5){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-times-circle'></i>Error!</h4>
                        Asegurese de que la imagen es del formato indicado.
                    </div>";
                }

                elseif($_GET['alert']==6){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-times-circle'></i>Error!</h4>
                        El archivo debe ser menor a 1 MB.
                    </div>";
                }

                elseif($_GET['alert']==7){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-times-circle'></i>Error!</h4>
                        Asegurese de que el tipo de archivo es: *.JPEG *.JPEG *.PNG.
                    </div>";
                }
            ?>
            
            <!-- Aplicar datatables -->
            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">Nro</th>
                                <th class="center">Foto</th>
                                <th class="center">Nombre del usuario</th>
                                <th class="center">Nombre</th>
                                <th class="center">Permisos de acceso</th>
                                <th class="center">Status</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nro=1;
                                $query = mysqli_query($mysqli, "SELECT * FROM usuarios ORDER BY id_user DESC")
                                or die('error'.mysqli_error($mysqli));
                                while($data = mysqli_fetch_assoc($query)){
                                    echo "<tr>
                                        <td width='50' class='center'>$nro</td>";
                                        if($data['foto']==""){?>
                                        <td class="center"><img class="img-user" src="images/user/use-default-png" width="45"></td>
                                    <?php }else{  ?>
                                        <td class="center"><img class="img-user" src="images/user/<?php echo $data['foto']; ?>" width="45"></td>
                                    <?php }
                                    echo "<td>$data[username]</td>
                                        <td>$data[name_user]</td>
                                        <td>$data[permisos_acceso]</td>
                                        <td>$data[status]</td>
                                        <td class='center' width='100'>
                                        <div>";
                                        if($data['status']=='activo'){ ?>
                                            <a data-toggle="tooltip" data-placement="top" title="Bloqueado" style="margin-rigth:5px" 
                                                class="btn btn-warning btn-sm" href="modules/user/proces.php?act=off&id=<?php echo $data['id_user'];?>">
                                                <i class="glyphicon glyphicon-off"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a data-toggle="tooltip" data-placement="top" title="Bloqueado" style="margin-rigth:5px" 
                                                class="btn btn-warning btn-sm" href="modules/user/proces.php?act=on&id=<?php echo $data['id_user'];?>">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </a>
                                        <?php }
                                        
                                        echo "<a data-togglr='tooltip' data-placement='top' title='Modificar' class='btn btn-primary btn-sm'
                                        href='?module=form_user&form=edit&id=$data[id_user]'>
                                        <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                        </a>
                                        </div>
                                        </td>
                                        </tr>";
                                        $nro++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>