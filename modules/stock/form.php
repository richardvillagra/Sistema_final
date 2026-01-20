<?php
if($_GET['form']=="edit"){
        if(isset($_GET['id'])){
            $query = mysqli_query($mysqli, "SELECT * FROM v_stock WHERE cod_producto = '$_GET[id]'")
            or die('error'.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($query);
        }?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Modificar Stock
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=stock">Stock</a></li>
                <li class="active">Modificar</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/stock/proces.php?act=update" method="POST">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_producto'];?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deposito</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip" value="<?php echo $data['descrip'];?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tipo de Producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="t_p_descrip" value="<?php echo $data['t_p_descrip'];?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="p_descrip" value="<?php echo $data['p_descrip'];?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">U. Medida</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="u_descrip" value="<?php echo $data['u_descrip'];?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Cantidad</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cantidad" value="<?php echo $data['cantidad'];?>" required>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=stock" class="btn btn-default btn-reset">Cancelar</a>
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