<?php
// ...existing code...
    // after inserting cabecera presupuesto
    $cod_presupuesto = mysqli_insert_id($mysqli);

    // copiar detalles desde detalle_pedido si vino cod_pedido
    if(isset($_POST['cod_pedido']) && intval($_POST['cod_pedido'])>0){
        $cod_pedido = intval($_POST['cod_pedido']);
        $q = mysqli_query($mysqli, "SELECT cod_producto, cantidad, precio, subtotal FROM detalle_pedido WHERE cod_pedido=$cod_pedido");
        while($r = mysqli_fetch_assoc($q)){
            $cod_producto = intval($r['cod_producto']);
            $cantidad = floatval($r['cantidad']);
            $precio = floatval($r['precio']);
            $subtotal = floatval($r['subtotal']);
            $ins = "INSERT INTO detalle_presupuesto (cod_presupuesto, cod_producto, cantidad, precio, subtotal)
                    VALUES ($cod_presupuesto, $cod_producto, $cantidad, $precio, $subtotal)";
            mysqli_query($mysqli, $ins) or die(mysqli_error($mysqli));
        }
    }
// ...existing code...