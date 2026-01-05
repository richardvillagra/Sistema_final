<?php
//session_start();
//require_once "../../config/database.php";
$form = isset($_GET['form']) ? $_GET['form'] : '';
  if($form == 'add'){
    $cod_pedido = isset($_GET['cod_pedido']) ? intval($_GET['cod_pedido']) : 0;
    $pedido = null;
    if($cod_pedido){
        $qp = mysqli_query($mysqli, "SELECT p.*, pr.razon_social FROM pedido p 
        JOIN proveedor pr ON p.cod_proveedor=pr.cod_proveedor WHERE p.cod_pedido=$cod_pedido LIMIT 1");
        if($qp) $pedido = mysqli_fetch_assoc($qp);
    }
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
    <select name="id_cliente" class="form-control" required>
      <option value="">-- Seleccionar --</option>
      <?php $qp = mysqli_query($mysqli, "SELECT id_cliente, ci_ruc FROM cliente");
            while($p = mysqli_fetch_assoc($qp)) echo "<option value='{$p['id_cliente']}'>".htmlspecialchars($p['ci_ruc'])."</option>"; ?>
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

  <?php if($pedido){ ?>
    <div class="form-group">
        <label>Nro Pedido origen</label>
        <input type="text" class="form-control" value="<?php echo htmlspecialchars($pedido['nro_pedido'].' - '.$pedido['razon_social']); ?>" disabled>
        <input type="hidden" name="cod_pedido" value="<?php echo $cod_pedido; ?>">
    </div>

    <div class="form-group">
        <label>Total (desde pedido)</label>
        <input type="number" step="0.01" name="total" class="form-control" value="<?php echo $pedido['total_pedido']; ?>" required>
    </div>

    <!-- Lista de items del pedido -->
    <div class="form-group">
        <label>Items del Pedido</label>
        <div class="col-sm-12" style="padding-left:0;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qdet = mysqli_query($mysqli, "SELECT dp.cod_producto, pr.p_descrip, dp.cantidad, dp.precio, dp.subtotal FROM detalle_pedido dp LEFT JOIN producto pr ON dp.cod_producto = pr.cod_producto WHERE dp.cod_pedido = $cod_pedido")
                    or die('Error: '.mysqli_error($mysqli));
                    while($it = mysqli_fetch_assoc($qdet)){
                        echo "<tr>
                                <td>".htmlspecialchars($it['p_descrip'])."</td>
                                <td class='text-center'>".$it['cantidad']."</td>
                                <td class='text-right'>".$it['precio']."</td>
                                <td class='text-right'>".$it['subtotal']."</td>
                              </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
  <?php } ?>
  <button type="submit" name="Guardar" class="btn btn-primary">
    <i class="fa fa-save"></i> Guardar</button>
  <a href="?module=presupuestos" class="btn btn-default">Cancelar</a>
</form>
</div></div></section>
<?php } ?>