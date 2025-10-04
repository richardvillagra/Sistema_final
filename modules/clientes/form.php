<?php
    if($_GET['form']=="add"){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Agregar Clientes
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=clientes">Clientes</a></li>
                <li class="active">Agregar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/clientes/proces.php?act=insert" method="POST">
                            <div class="box-body">
                                <?php 
                                // Método para generar código
                                    $query_id = mysqli_query($mysqli, "SELECT MAX(id_cliente) as id FROM clientes")
                                    or die ('error'.mysqli_error($mysqli));
                                    $count = mysqli_num_rows($query_id);
                                    if($count <> 0){
                                        $data_id = mysqli_fetch_assoc($query_id);
                                        $codigo = $data_id['id']+1;
                                    } else{
                                        $codigo=1;
                                    }
                                ?>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $codigo;?>" readonly>
                                    </div>
                                </div>
                                    
                                <!-- Combo buscador -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select class="chosen-select" name="codigo_ciudad" data-placeholder="--Seleccionar Ciudad--" autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_ciu = mysqli_query($mysqli, "SELECT cod_ciudad, dep.id_departamento, dep.dep_descripcion, descrip_ciudad
                                                FROM ciudad ciu
                                                JOIN departamento dep
                                                WHERE ciu.id_departamento=dep.id_departamento ORDER BY cod_ciudad ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_ciu = mysqli_fetch_assoc($query_ciu)){
                                                    echo "<option value=\"$data_ciu[cod_ciudad]\">$data_ciu[dep_descripcion] | $data_ciu[descrip_ciudad]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ruc-Ci</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="ci_ruc" placeholder="Ingresa un ruc o ci" autocomplete="off" 
                                        onkeyPress="return goodchars(event, '0123456789', this)" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="nombre" placeholder="Ingresa tu nombre" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="apellido" placeholder="Ingresa tu apellido" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Direccion</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="direccion" placeholder="Ingresa tu direccion" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="telefono" placeholder="Ingresa tu telefono" autocomplete="off" 
                                        onkeyPress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=clientes" class="btn btn-default btn-reset">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php }
    elseif($_GET['form']=="edit"){
        if(isset($_GET['id'])){
            $query = mysqli_query($mysqli, "SELECT * FROM v_clientes WHERE id_cliente = '$_GET[id]'")
            or die('error'.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($query);
        }?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Modificar Clientes
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=clientes">Clientes</a></li>
                <li class="active">Modificar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/clientes/proces.php?act=update" method="POST">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $data['id_cliente'];?>" readonly>
                                    </div>
                                </div>

                                <!-- Combo buscador -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select class="chosen-select" name="codigo_ciudad" data-placeholder="--Seleccionar Ciudad--" autocomplete="off" required>
                                            <option value="<?php echo $data['cod_ciudad'];?>"><?php echo $data['descrip_ciudad'];?></option>
                                            <?php
                                                $query_ciu = mysqli_query($mysqli, "SELECT cod_ciudad, dep.id_departamento, dep.dep_descripcion, descrip_ciudad
                                                FROM ciudad ciu
                                                JOIN departamento dep
                                                WHERE ciu.id_departamento=dep.id_departamento ORDER BY cod_ciudad ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_ciu = mysqli_fetch_assoc($query_ciu)){
                                                    echo "<option value=\"$data_ciu[cod_ciudad]\">$data_ciu[dep_descripcion] | $data_ciu[descrip_ciudad]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ruc-Ci</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="ci_ruc" value="<?php echo $data['ci_ruc'];?>" autocomplete="off" 
                                        onkeyPress="return goodchars(event, '0123456789', this)" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="nombre" value="<?php echo $data['cli_nombre'];?>" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="apellido" value="<?php echo $data['cli_apellido'];?>" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Direccion</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="direccion" value="<?php echo $data['cli_direccion'];?>" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="telefono" value="<?php echo $data['cli_telefono'];?>" autocomplete="off" 
                                        onkeyPress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=clientes" class="btn btn-default btn-reset">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php }
?>