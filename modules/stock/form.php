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