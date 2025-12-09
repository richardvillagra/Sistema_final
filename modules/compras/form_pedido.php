<?php
//require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    $form = isset($_GET['form']) ? $_GET['form'] : '';
    $cod_compra = isset($_GET['cod_compra']) ? intval($_GET['cod_compra']) : 0;
    $compra = null;

    if($cod_compra){
        $res = mysqli_query($mysqli, "SELECT * FROM v_compras WHERE cod_compra=$cod_compra LIMIT 1");
        $compra = mysqli_fetch_assoc($res);
    }

    if($form == 'add'){
?>
<section class="content-header">
    <h1>
        <i class="fa fa-shopping-cart"></i> Agregar Pedido
    </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <form method="post" action="modules/compras/proces_pedido.php?act=insert">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Codigo Pedido</label>
                            <input type="text" name="codigo_pedido" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nro Pedido</label>
                            <input type="text" name="nro_pedido" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Compra Relacionada</label>
                            <input type="hidden" name="cod_compra" value="<?php echo $cod_compra; ?>">
                            <input type="text" class="form-control" value="<?php echo $compra ? $compra['nro_factura'] : 'Ninguna'; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Proveedor</label>
                            <input type="hidden" name="codigo_proveedor" value="<?php echo $compra ? $compra['cod_proveedor'] : ''; ?>">
                            <input type="text" class="form-control" value="<?php echo $compra ? htmlspecialchars($compra['razon_social']) : ''; ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Deposito</label>
                            <select name="codigo_deposito" class="form-control" required>
                                <option value="">-- Seleccionar --</option>
                                <?php
                                    $qdepo = mysqli_query($mysqli, "SELECT cod_deposito, descrip FROM deposito");
                                    while($depo = mysqli_fetch_assoc($qdepo)){
                                        echo "<option value='".$depo['cod_deposito']."'>".$depo['descrip']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hora</label>
                            <input type="time" name="hora" class="form-control" value="<?php echo date('H:i'); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Total</label>
                    <input type="number" step="0.01" name="suma_total" class="form-control" value="<?php echo $compra ? $compra['total_compra'] : '0'; ?>" required>
                </div>

                <p class="help-block">Se copiarán automáticamente los ítems de la compra seleccionada.</p>

                <button type="submit" name="Guardar" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar Pedido
                </button>
                <a href="?module=compras" class="btn btn-default">
                    <i class="fa fa-times"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</section>
<?php
    }
}
?>