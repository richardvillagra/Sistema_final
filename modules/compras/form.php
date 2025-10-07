<?php
    if($_GET['form']=="add"){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Agregar Compra
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=compras">Compras</a></li>
                <li class="active">Agregar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/compras/proces.php?act=insert" method="POST">
                            <div class="box-body">
                                <?php 
                                // Método para generar código
                                    $query_id = mysqli_query($mysqli, "SELECT MAX(cod_compra) as id FROM compra")
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
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $codigo;?>" readonly>
                                    </div>
                                
                                    <label class="col-sm-1 control-label">Fecha</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="fecha" autocomplete="off" 
                                        value="<?php echo date("j/n/Y"); ?>" readonly>
                                    </div>
                                    
                                    <label class="col-sm-1 control-label">Hora</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control date-picker" data-date-format="H-mm-ss" name="Hora" autocomplete="off" 
                                        value="<?php echo date("H:i:s"); ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Proveedor</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="codigo_proveedor" data-placeholder="-- Seleccionar Proveedor --" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_prov = mysqli_query($mysqli, "SELECT cod_proveedor, razon_social, ruc FROM proveedor ORDER BY cod_proveedor ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    echo "<option value=\"$data_prov[cod_proveedor]\">$data_prov[razon_social] | $data_prov[ruc]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label">N° de Factura</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="nro_factura" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deposito</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="codigo_deposito" data-placeholder="-- Seleccionar Deposito--" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_dep = mysqli_query($mysqli, "SELECT cod_deposito, descrip FROM deposito ORDER BY cod_deposito ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_dep = mysqli_fetch_assoc($query_dep)){
                                                    echo "<option value=\"$data_dep[cod_deposito]\">$data_dep[cod_deposito] | $data_dep[descrip]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="col-sm-2 control-label">Productos</label>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                            <span class="glyphicon glyphicon-plus">Agregar Productos</span>
                                        </button>
                                    </div>
                                </div>

                                <div id="resultados" class="col-md-9"></div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=compras" class="btn btn-default btn-reset">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModallabel">Buscar Productos</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="x" placeholder="Buscar productos" onkeyup="load(1);">
                            </div>
                            <button type="button" class="btn btn-default" onclick="load(1);"><span class="glyphicon glyphicon-search"></span>Buscar</button>
                        </div>
                    </form>
                    <div id="loader" style="position:absolute; text-align:center; top:55px; width:100%; display:none;"></div>
                    <div class="outer_div"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>