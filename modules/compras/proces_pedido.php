<?php

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
}
else{
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $codigo_pedido = $_POST['codigo_pedido'];
            $cod_compra = $_POST['cod_compra'];
            $codigo_deposito = $_POST['codigo_deposito'];

            //Insertar detalle de pedido desde detalle_compra
            $sql = mysqli_query($mysqli, "SELECT * FROM detalle_compra WHERE cod_compra = $cod_compra")
            or die('Error: '.mysqli_error($mysqli));
            
            while($row = mysqli_fetch_assoc($sql)) {
                $codigo_producto = $row['cod_producto'];
                $precio = $row['precio'];
                $cantidad = $row['cantidad'];
                
                //Insertar en la tabla detalle_pedido
                $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_pedido (cod_producto, cod_pedido, cod_deposito, precio, cantidad) 
                VALUES ($codigo_producto, $codigo_pedido, $codigo_deposito, $precio, $cantidad)")
                or die('Error: '.mysqli_error($mysqli));
            }

            //Insertar cabecera de pedido
            $codigo_proveedor = $_POST['codigo_proveedor'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $nro_pedido = $_POST['nro_pedido'];
            $suma_total = $_POST['suma_total'];
            $estado = 'pendiente';
            $usuario = $_SESSION['id_user'];
            
            //Insertar
            $query = mysqli_query($mysqli, "INSERT INTO pedido(cod_pedido, cod_compra, cod_proveedor, cod_deposito,
            id_user, nro_pedido, fecha, estado, hora, total_pedido)
            VALUES($codigo_pedido, $cod_compra, $codigo_proveedor, $codigo_deposito, $usuario, '$nro_pedido', '$fecha',
            '$estado', '$hora', $suma_total)")
            or die('Error: '.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=compras&alert=1");
            } else{
                header("Location: ../../main.php?module=compras&alert=3");
            }
        }
    }

    elseif($_GET['act']=='anular'){
        if(isset($_GET['cod_pedido'])){
            $codigo = $_GET['cod_pedido'];
            
            //Anular cabecera de pedido (cambiar estado a anulado)
            $query = mysqli_query($mysqli, "UPDATE pedido SET estado = 'anulado' WHERE cod_pedido = $codigo")
            or die('Error: '.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=compras&alert=2");
            } else{
                header("Location: ../../main.php?module=compras&alert=3");
            }
        }
    }
}

?>