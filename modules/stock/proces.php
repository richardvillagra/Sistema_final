<?php
//session_start();
//require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    exit;
}

if(isset($_GET['act']) && $_GET['act']=='adjust' && isset($_POST['Guardar'])){
    $cod_producto = intval($_POST['cod_producto']);
    $cod_deposito = intval($_POST['cod_deposito']);
    $tipo = $_POST['tipo']; // 'ingreso' | 'egreso'
    $cantidad = floatval($_POST['cantidad']);
    $motivo = mysqli_real_escape_string($mysqli, $_POST['motivo']);
    $usuario = $_SESSION['id_user'];
    $fecha = date('Y-m-d H:i:s');

    if($cantidad <= 0){
        header("Location: ../../main.php?module=stock&alert=3");
        exit;
    }

    mysqli_begin_transaction($mysqli);
    try {
        // Obtener stock actual
        $q = mysqli_query($mysqli, "SELECT cantidad FROM stock WHERE cod_producto=$cod_producto AND cod_deposito=$cod_deposito FOR UPDATE");
        if(!$q) throw new Exception(mysqli_error($mysqli));
        if(mysqli_num_rows($q) == 0){
            if($tipo == 'ingreso'){
                // insertar fila de stock
                $ins = mysqli_query($mysqli, "INSERT INTO stock (cod_deposito, cod_producto, cantidad) VALUES ($cod_deposito, $cod_producto, $cantidad)");
                if(!$ins) throw new Exception(mysqli_error($mysqli));
                $nuevo_stock = $cantidad;
            } else {
                // egreso en producto sin stock
                throw new Exception('Sin stock');
            }
        } else {
            $row = mysqli_fetch_assoc($q);
            $stock_actual = floatval($row['cantidad']);
            if($tipo == 'ingreso'){
                $nuevo_stock = $stock_actual + $cantidad;
                $up = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad + $cantidad WHERE cod_producto=$cod_producto AND cod_deposito=$cod_deposito");
                if(!$up) throw new Exception(mysqli_error($mysqli));
            } else {
                // egreso
                if($stock_actual < $cantidad){
                    throw new Exception('Insuficiente');
                }
                $nuevo_stock = $stock_actual - $cantidad;
                $up = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $cantidad WHERE cod_producto=$cod_producto AND cod_deposito=$cod_deposito");
                if(!$up) throw new Exception(mysqli_error($mysqli));
            }
        }

        // Registrar movimiento
        $tipo_mov = ($tipo=='ingreso') ? 'I' : 'E';
        $ins_mov = mysqli_query($mysqli, "INSERT INTO stock_mov (cod_producto, cod_deposito, tipo, cantidad, motivo, usuario, fecha, stock_resultante)
            VALUES ($cod_producto, $cod_deposito, '$tipo_mov', $cantidad, '$motivo', $usuario, '$fecha', $nuevo_stock)");
        if(!$ins_mov) throw new Exception(mysqli_error($mysqli));

        mysqli_commit($mysqli);
        header("Location: ../../main.php?module=stock&alert=1");
        exit;

    } catch(Exception $e){
        mysqli_rollback($mysqli);
        // Si quieres diferenciar mensajes puedes añadir alert=4 para insuficiente
        if(strpos($e->getMessage(),'Insuficiente') !== false || strpos($e->getMessage(),'Sin stock') !== false){
            header("Location: ../../main.php?module=stock&alert=4");
        } else {
            error_log($e->getMessage());
            header("Location: ../../main.php?module=stock&alert=3");
        }
        exit;
    }
}

if($_GET['act']== 'update'){
            if(isset($_POST['Guardar'])){
                if(isset($_POST['codigo'])){
                    $codigo = $_POST['cod_deposito'];
                    $descrip = $_POST['cod_producto'];

                    $query = mysqli_query($mysqli, "UPDATE stock SET descrip = '$descrip' WHERE cantidad = '$codigo'") 
                    or die('error'.mysqli_error($mysqli));
                    if($query){
                        header("Location: ../../main.php?module=stock&alert=2");
                    }else{
                        header("Location: ../../main.php?module=stock&alert=4");
                    }
                }
            }
        }
?>