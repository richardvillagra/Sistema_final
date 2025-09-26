<?php
    if($_GET['form']=="add"){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Agregar Ciudad
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=ciudad">Ciudad</a></li>
                <li class="active">Agregar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/ciudad/proces.php?act=insert" method="POST">
                            <div class="box-body">
                                <?php 
                                // Método para generar código
                                    $query_id = mysqli_query($mysqli, "SELECT MAX(cod_ciudad) as id FROM ciudad")
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
                                    
                                <!-- Combo para seleccionar un departamento -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <select name="departamento" class="form-control">
                                            <option value=""></option>
                                            <?php
                                                $query = mysqli_query($mysqli, "SELECT * FROM departamento")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data = mysqli_fetch_assoc($query)){
                                                    echo "<option value='".$data['id_departamento']."'";
                                                    if($_POST['departamento']==$data['id_departamento']){
                                                        echo "selected";
                                                        echo ">";
                                                        echo $data['dep_descripcion'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip_ciudad" placeholder="Ingresa una ciudad" required>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=ciudad" class="btn btn-default btn-reset">Cancelar</a>
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
            $query = mysqli_query($mysqli, "SELECT * FROM ciudad WHERE cod_ciudad = '$_GET[id]'")
            or die('error'.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($query);
        }?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Modificar Ciudad
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=ciudad">ciudad</a></li>
                <li class="active">Modificar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/ciudad/proces.php?act=update" method="POST">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_ciudad'];?>" readonly>
                                    </div>
                                </div>

                                <!-- Combo para seleccionar un departamento -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <select name="departamento" class="form-control">
                                            <option value="<?php $data['id_departamento']?>"><?php $data['dep_descripcion']?></option>
                                            <?php
                                                $query = mysqli_query($mysqli, "SELECT * FROM departamento")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data2 = mysqli_fetch_assoc($query)){
                                                    echo "<option value='".$data2['id_departamento']."'";
                                                    if($_POST['departamento']==$data2['id_departamento']){
                                                        echo "selected";
                                                        echo ">";
                                                        echo $data2['dep_descripcion'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip_ciudad" value="<?php echo $data['descrip_ciudad'];?>" required>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=ciudad" class="btn btn-default btn-reset">Cancelar</a>
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