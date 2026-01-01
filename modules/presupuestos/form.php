<?php
//session_start();
//require_once "../../config/database.php";
$form = isset($_GET['form']) ? $_GET['form'] : '';
if($form == 'add'){
?>
<section class="content-header">
  <h1><i class="fa fa-file-text"></i> Agregar Presupuesto</h1>
  <ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li><a href="?module=presupuestos">Presupuestos</a></li>
    <li class="active">Agregar</a></li>
  </ol>
</section>
<section class="content"><div class="box box-primary"><div class="box-body">
<form method="post" action="modules/presupuestos/proces.php?act=insert">
  <div class="form-group">
    <label>Nro Presupuesto</label>
  <input name="nro_presupuesto" class="form-control" required></div>
  <div class="form-group"><label>Cliente</label>
    <select name="cod_cliente" class="form-control" required>
      <option value="">-- Seleccionar --</option>
      <?php $qp = mysqli_query($mysqli, "SELECT cod_cliente, razon_social FROM cliente");
            while($p = mysqli_fetch_assoc($qp)) echo "<option value='{$p['cod_cliente']}'>".htmlspecialchars($p['razon_social'])."</option>"; ?>
    </select>
  </div>
  <div class="form-group"><label>Fecha</label><input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div>
  <div class="form-group"><label>Total</label><input type="number" step="0.01" name="total" class="form-control" value="0" required></div>
  <button type="submit" name="Guardar" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
  <a href="?module=presupuestos" class="btn btn-default">Cancelar</a>
</form>
</div></div></section>
<?php } ?>