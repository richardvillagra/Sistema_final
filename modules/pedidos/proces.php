<?php
//session_start();
//require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

if(isset($_GET['act']) && $_GET['act']=='insert'){
    if(isset($_POST['Guardar'])){
        $cod_compra = isset($_POST['cod_compra']) ? intval($_POST['cod_compra']) : 0;
        $cod_proveedor = isset($_POST['cod_proveedor']) ? intval($_POST['cod_proveedor']) : 0;
        $cod_deposito = isset($_POST['cod_deposito']) ? intval($_POST['cod_deposito']) : 0;
        $nro_pedido = mysqli_real_escape_string($mysqli, $_POST['nro_pedido']);
        $fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);
        $hora = mysqli_real_escape_string($mysqli, $_POST['hora']);
        $suma_total = isset($_POST['suma_total']) ? floatval($_POST['suma_total']) : 0;
        $usuario = $_SESSION['id_user'];
        $estado = 'pendiente';

        mysqli_begin_transaction($mysqli);

        try {
            // calcular total si viene de compra
            if($cod_compra && ($suma_total == 0 || $suma_total == '')){
                $qtot = mysqli_query($mysqli, "SELECT SUM(cantidad * precio) AS total FROM detalle_compra WHERE cod_compra = $cod_compra");
                $rt = mysqli_fetch_assoc($qtot);
                $suma_total = floatval($rt['total']);
            }

            // insertar cabecera pedido
            $sql = "INSERT INTO pedido (cod_compra, cod_proveedor, cod_deposito, id_user, nro_pedido, fecha, estado, hora, total_pedido)
                    VALUES (".($cod_compra? $cod_compra : "NULL").", $cod_proveedor, $cod_deposito, $usuario, '$nro_pedido', '$fecha', '$estado', '$hora', $suma_total)";
            if(!mysqli_query($mysqli, $sql)){
                throw new Exception('Error insert pedido: '.mysqli_error($mysqli));
            }
            $cod_pedido = mysqli_insert_id($mysqli);

            // copiar detalles desde detalle_compra
            if($cod_compra){
                $q = mysqli_query($mysqli, "SELECT cod_producto, cantidad, precio FROM detalle_compra WHERE cod_compra = $cod_compra");
                while($r = mysqli_fetch_assoc($q)){
                    $cod_producto = intval($r['cod_producto']);
                    $cantidad = floatval($r['cantidad']);
                    $precio = floatval($r['precio']);
                    $subtotal = $cantidad * $precio;
                    $ins = "INSERT INTO detalle_pedido (cod_pedido, cod_producto, cod_deposito, cantidad, precio, subtotal)
                            VALUES ($cod_pedido, $cod_producto, $cod_deposito, $cantidad, $precio, $subtotal)";
                    if(!mysqli_query($mysqli, $ins)){
                        throw new Exception('Error insert detalle_pedido: '.mysqli_error($mysqli));
                    }
                }
            }

            mysqli_commit($mysqli);
            header("Location: ../../main.php?module=pedidos&alert=1");
            exit;

        } catch(Exception $e){
            mysqli_rollback($mysqli);
            error_log($e->getMessage());
            header("Location: ../../main.php?module=pedidos&alert=3");
            exit;
        }
    }
}
elseif(isset($_GET['act']) && $_GET['act']=='anular'){
    if(isset($_GET['cod_pedido'])){
        $codigo = intval($_GET['cod_pedido']);
        $query = mysqli_query($mysqli, "UPDATE pedido SET estado = 'anulado' WHERE cod_pedido = $codigo")
        or die('Error: '.mysqli_error($mysqli));

        if($query){
            header("Location: ../../main.php?module=pedidos&alert=2");
        } else{
            header("Location: ../../main.php?module=pedidos&alert=3");
        }
    }
}
?>