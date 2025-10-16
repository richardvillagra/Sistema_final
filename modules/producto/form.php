<?php
    if($_GET['form']=="add"){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Agregar Producto
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=producto">Producto</a></li>
                <li class="active">Agregar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/producto/proces.php?act=insert" method="POST">
                            <div class="box-body">
                                <?php 
                                // Método para generar código
                                    $query_id = mysqli_query($mysqli, "SELECT MAX(cod_producto) as id FROM producto")
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
                                    
                                <!-- Combo para seleccionar un tipo de producto -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tipo de producto</label>
                                    <div class="col-sm-5">
                                        <select name="tipo_producto" class="form-control">
                                            <option value=""></option>
                                            <?php
                                                $query = mysqli_query($mysqli, "SELECT * FROM tipo_producto")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data2 = mysqli_fetch_assoc($query)){
                                                    echo "<option value='".$data2['cod_tipo_prod']."'";
                                                    if($_POST['tipo_producto']==$data2['cod_tipo_prod']){
                                                        echo "selected";
                                                        echo ">";
                                                        echo $data2['t_p_descrip'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Combo para seleccionar unidad de medida -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unidad de medida</label>
                                    <div class="col-sm-5">
                                        <select name="u_medida" class="form-control">
                                            <option value=""></option>
                                            <?php
                                                $query = mysqli_query($mysqli, "SELECT * FROM u_medida")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data3 = mysqli_fetch_assoc($query)){
                                                    echo "<option value='".$data3['id_u_medida']."'";
                                                    if($_POST['u_medida']==$data3['id_u_medida']){
                                                        echo "selected";
                                                        echo ">";
                                                        echo $data3['u_descrip'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre de producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="p_descrip" placeholder="Ingresa el producto" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Precio</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="precio" placeholder="Ingresa tu precio" autocomplete="off" 
                                        onkeyPress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=producto" class="btn btn-default btn-reset">Cancelar</a>
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
            $query = mysqli_query($mysqli, "SELECT * FROM producto WHERE cod_producto = '$_GET[id]'")
            or die('error'.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($query);
        }?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Modificar Proveedor
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=producto">Producto</a></li>
                <li class="active">Modificar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/producto/proces.php?act=update" method="POST">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_producto'];?>" readonly>
                                    </div>
                                </div>

                                <!-- Combo para seleccionar un tipo de producto -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tipo de producto</label>
                                    <div class="col-sm-5">
                                        <select name="producto" class="form-control">
                                            <option value="<?php $data['cod_producto']?>"><?php $data['t_p_descrip']?></option>
                                            <?php
                                                $query = mysqli_query($mysqli, "SELECT * FROM departamento")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data2 = mysqli_fetch_assoc($query)){
                                                    echo "<option value='".$data2['cod_producto']."'";
                                                    if($_POST['producto']==$data2['cod_producto']){
                                                        echo "selected";
                                                        echo ">";
                                                        echo $data2['t_p_descrip'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Combo para seleccionar unidad de medida -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unidad de medida</label>
                                    <div class="col-sm-5">
                                        <select name="tipo" class="form-control">
                                            <option value="<?php $data['id_u_medida']?>"><?php $data['u_descrip']?></option>
                                            <?php
                                                $query = mysqli_query($mysqli, "SELECT * FROM departamento")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data2 = mysqli_fetch_assoc($query)){
                                                    echo "<option value='".$data2['id_u_medida']."'";
                                                    if($_POST['tipo_']==$data2['id_u_medida']){
                                                        echo "selected";
                                                        echo ">";
                                                        echo $data2['u_descrip'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre de producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="p_descrip" placeholder="Ingresa el producto" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Precio</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="precio" placeholder="Ingresa tu precio" autocomplete="off" 
                                        onkeyPress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=producto" class="btn btn-default btn-reset">Cancelar</a>
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