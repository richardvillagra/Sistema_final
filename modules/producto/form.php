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
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="cod_tipo_prod" data-placeholder="-- Seleccionar Tipo de producto --" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_prov = mysqli_query($mysqli, "SELECT cod_tipo_prod, t_p_descrip FROM tipo_producto ORDER BY cod_tipo_prod ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    echo "<option value=\"$data_prov[cod_tipo_prod]\">$data_prov[t_p_descrip]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Combo para seleccionar unidad de medida -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unidad de medida</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="id_u_medida" data-placeholder="-- Seleccionar Unidad de medida --" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_prov = mysqli_query($mysqli, "SELECT id_u_medida, u_descrip FROM u_medida ORDER BY id_u_medida ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    echo "<option value=\"$data_prov[id_u_medida]\">$data_prov[u_descrip]</option>";
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
                <i class="fa fa-edit icon-title"></i>Modificar Producto
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
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="cod_tipo_prod" data-placeholder="-- Seleccionar Tipo de producto --" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_prov = mysqli_query($mysqli, "SELECT cod_tipo_prod, t_p_descrip FROM tipo_producto ORDER BY cod_tipo_prod ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    echo "<option value=\"$data_prov[cod_tipo_prod]\">$data_prov[t_p_descrip]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Combo para seleccionar unidad de medida -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unidad de medida</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="id_u_medida" data-placeholder="-- Seleccionar Unidad de medida --" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_prov = mysqli_query($mysqli, "SELECT id_u_medida, u_descrip FROM u_medida ORDER BY id_u_medida ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    echo "<option value=\"$data_prov[id_u_medida]\">$data_prov[u_descrip]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nombre de producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="p_descrip" value="<?php echo $data['p_descrip'];?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Precio</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="precio" value="<?php echo $data['precio'];?>" required>
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