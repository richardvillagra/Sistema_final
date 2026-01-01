<?php
session_start();

require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
}
else{
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            $codigo_deposito = $_POST['codigo_deposito'];
            //Insertar detalle de compra

            $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
            while($row = mysqli_fetch_assoc($sql)) {
                $codigo_producto = $row['id_producto'];
                $precio = $row['precio_tmp'];
                $cantidad = $row['cantidad_tmp'];

                //Insertar en la tabla detalle_pedido
                $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_pedido (cod_producto, cod_pedido, cod_deposito, precio, cantidad) 
                VALUES ($codigo_producto, $codigo, $codigo_deposito, $precio, $cantidad)")
                or die('Error: '.mysqli_error($mysqli));

                //Insertar stock en la tabla producto
                $query = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto= $codigo_producto AND cod_deposito= $codigo_deposito")
                or die('Error: '.mysqli_error($mysqli));

                if($count = mysqli_num_rows($query)==0){
                    //Insertar
                    $insertar_stock = mysqli_query($mysqli, "INSERT INTO stock(cod_deposito, cod_producto, cantidad)
                    VALUES($codigo_deposito, $codigo_producto, $cantidad)")
                    or die('Error: '.mysqli_error($mysqli));
                }else {
                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad + $cantidad
                    WHERE cod_producto = $codigo_producto AND cod_deposito = $codigo_deposito")
                    or die('Error: '.mysqli_error($mysqli));
                }
            }
            //Insertar cabecera de compra
            //Definir variables
            $codigo_proveedor = $_POST['codigo_proveedor'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $nro_factura = $_POST['nro_pedido'];
            $suma_total = $_POST['suma_total'];
            $estado = 'activo';
            $usuario = $_SESSION['id_user'];
            //Insertar
            $query = mysqli_query($mysqli, "INSERT INTO pedido(cod_pedido, cod_proveedor, cod_deposito,
            id_user, nro_pedido, fecha, estado, hora, total_pedido)
            VALUES($codigo, $codigo_proveedor, $codigo_deposito, $usuario, '$nro_factura', '$fecha',
            '$estado', '$hora',  $suma_total)")
            or die('Error: '.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=pedidos&alert=1");
            } else{
                header("Location: ../../main.php?module=pedidos&alert=3");
            }
        }
    }

    elseif($_GET['act']=='anular'){
        if(isset($_GET['cod_pedido'])){
            $codigo = $_GET['cod_pedido'];
            //Anular cabecera de pedido (cambiar estado a anulado)
            $query = mysqli_query($mysqli, "UPDATE pedido SET estado = 'anulado' WHERE cod_pedido = $codigo")
            or die('Error: '.mysqli_error($mysqli));

            //Consultar detalle de pedido con el codigo que llega por GET
            $sql = mysqli_query($mysqli, "SELECT * FROM detalle_pedido WHERE cod_pedido = $codigo");
            while($row = mysqli_fetch_assoc($sql)){
                $codigo_producto = $row['cod_producto'];
                $codigo_deposito = $row['cod_deposito'];
                $cantidad = $row['cantidad'];

                $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $cantidad
                WHERE cod_producto = $codigo_producto AND cod_deposito = $codigo_deposito")
                or die('Error: '.mysqli_error($mysqli));
            }
            if($query){
                header("Location: ../../main.php?module=pedidos&alert=2");
            } else{
                header("Location: ../../main.php?module=pedidos&alert=3");
            }
        }
    }
}

?>