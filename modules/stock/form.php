<?php
//session_start();
//require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

$cod_producto = isset($_GET['cod_producto']) ? intval($_GET['cod_producto']) : 0;
$cod_deposito = isset($_GET['cod_deposito']) ? intval($_GET['cod_deposito']) : 0;
$product = null;
$stock_row = null;
if($cod_producto && $cod_deposito){
    $q = mysqli_query($mysqli, "SELECT * FROM v_stock WHERE cod_producto=$cod_producto AND cod_deposito=$cod_deposito LIMIT 1");
    $product = mysqli_fetch_assoc($q);
    $q2 = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto=$cod_producto AND cod_deposito=$cod_deposito LIMIT 1");
    $stock_row = mysqli_fetch_assoc($q2);
}
?>
<section class="content-header">
    <h1><i class="fa fa-edit"></i> Ajuste de Stock</h1>
</section>

<section class="content">
 <div class="box box-primary">
  <div class="box-body">
    <form method="post" action="modules/stock/proces_stock.php?act=adjust">
      <input type="hidden" name="cod_producto" value="<?php echo $cod_producto; ?>">
      <input type="hidden" name="cod_deposito" value="<?php echo $cod_deposito; ?>">

      <div class="form-group">
        <label>Producto</label>
        <input class="form-control" value="<?php echo $product ? htmlspecialchars($product['p_descrip']) : ''; ?>" disabled>
      </div>

      <div class="form-group">
        <label>Stock Actual</label>
        <input class="form-control" value="<?php echo $stock_row ? $stock_row['cantidad'] : 0; ?>" disabled>
      </div>

      <div class="form-group">
        <label>Tipo de ajuste</label>
        <select name="tipo" class="form-control" required>
          <option value="ingreso">Ingreso</option>
          <option value="egreso">Egreso</option>
        </select>
      </div>

      <div class="form-group">
        <label>Cantidad</label>
        <input type="number" step="1" name="cantidad" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Motivo</label>
        <input type="text" name="motivo" class="form-control" placeholder="Motivo del ajuste" required>
      </div>

      <div class="form-group">
        <button type="submit" name="Guardar" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
        <a href="?module=stock" class="btn btn-default"><i class="fa fa-times"></i> Cancelar</a>
      </div>
    </form>
  </div>
 </div>
</section>
<?php
if($_GET['form']=="edit"){
          if(!empty($_POST['codigo_deposito'])){
            $cod_deposito = $_POST['codigo_deposito'];
          }else {
            $cod_deposito=1;
          }
        if(isset($_GET['id'])){
            $query = mysqli_query($mysqli, "SELECT * FROM v_stock WHERE cod_deposito = $cod_deposito")
            or die('error'.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($query);
        }?>
        <section class="content-header">
            <h1>
                <i class="fa fa-edit icon-title"></i>Modificar Stock
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=stock">stock</a></li>
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
                                        <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_deposito'];?>" readonly>
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
?>