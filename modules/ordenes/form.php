<?php
//session_start();
//require_once "../../config/database.php";
$form = isset($_GET['form']) ? $_GET['form'] : '';
if($form == 'add'){
?>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=ordenes">ordenes</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-file-text-o"></i> Agregar Orden de Compra</h1>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
<form method="post" action="modules/ordenes/proces.php?act=insert">

    <?php 
// Método para generar código
  $query_id = mysqli_query($mysqli, "SELECT MAX(cod_orden) as id FROM orden_compra")
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
        <label>Codigo</label>
        <input name="codigo" class="form-control" value="<?php echo $codigo; ?>" readonly>
    </div>

  <div class="form-group">
    <label>Nro Orden</label>
    <input name="nro_orden" class="form-control" required>
</div>
  <div class="form-group">
    <label>Proveedor</label>
    <select name="cod_proveedor" class="form-control" required>
      <option value="">-- Seleccionar --</option>
      <?php $qp = mysqli_query($mysqli, "SELECT cod_proveedor, razon_social FROM proveedor");
            while($p = mysqli_fetch_assoc($qp)) echo "<option value='{$p['cod_proveedor']}'>".htmlspecialchars($p['razon_social'])."</option>"; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Fecha</label>
  <input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
</div>
  <div class="form-group">
    <label>Total</label>
    <input type="number" step="0.01" name="total" class="form-control" value="0" required>
</div>
  <button type="submit" name="Guardar" class="btn btn-primary">
    <i class="fa fa-save"></i> Guardar</button>
  <a href="?module=ordenes" class="btn btn-default">Cancelar</a>
</form>
</div></div></section>
<?php } ?>