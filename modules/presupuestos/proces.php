<?php
    session_start();
    require "../../config/database.php";

    // Insertar presupuesto desde formulario (posible origen: pedido)
    if(isset($_GET['act']) && $_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            if(empty($_SESSION['username'])){
                echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
                exit;
            }

            $nro = mysqli_real_escape_string($mysqli, $_POST['nro_presupuesto']);
            $cod_cliente = intval($_POST['cod_cliente']);
            $fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);
            $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
            $usuario = isset($_SESSION['id_user']) ? intval($_SESSION['id_user']) : 0;
            $estado = 'emitido';

            mysqli_begin_transaction($mysqli);
            try {
                $sql = "INSERT INTO presupuesto (nro_presupuesto, cod_cliente, fecha, total_presupuesto, estado, id_user)
                        VALUES ('$nro', $cod_cliente, '$fecha', $total, '$estado', $usuario)";
                if(!mysqli_query($mysqli, $sql)){
                    throw new Exception('Error insert presupuesto: '.mysqli_error($mysqli));
                }
                $cod_presupuesto = mysqli_insert_id($mysqli);

                // Si vino cod_pedido, copiar detalles
                if(isset($_POST['cod_pedido']) && intval($_POST['cod_pedido'])>0){
                    $cod_pedido = intval($_POST['cod_pedido']);
                    $q = mysqli_query($mysqli, "SELECT cod_producto, cantidad, precio, subtotal FROM detalle_pedido WHERE cod_pedido = $cod_pedido")
                    or throw new Exception('Error detalles: '.mysqli_error($mysqli));

                    while($r = mysqli_fetch_assoc($q)){
                        $cod_producto = intval($r['cod_producto']);
                        $cantidad = floatval($r['cantidad']);
                        $precio = floatval($r['precio']);
                        $subtotal = floatval($r['subtotal']);
                        $ins = "INSERT INTO detalle_presupuesto (cod_presupuesto, cod_producto, cantidad, precio, subtotal)
                                VALUES ($cod_presupuesto, $cod_producto, $cantidad, $precio, $subtotal)";
                        if(!mysqli_query($mysqli, $ins)){
                            throw new Exception('Error insert detalle_presupuesto: '.mysqli_error($mysqli));
                        }
                    }
                }

                mysqli_commit($mysqli);
                header("Location: ../../main.php?module=presupuestos&alert=1");
                exit;

            } catch(Exception $e){
                mysqli_rollback($mysqli);
                error_log($e->getMessage());
                header("Location: ../../main.php?module=presupuestos&alert=3");
                exit;
            }
        }
    }

    // Eliminar presupuesto (ajustado a tabla 'presupuesto')
    if($_GET['act']== 'delete'){
        if(isset($_GET['cod_presu'])){
            $codigo = intval($_GET['cod_presu']);
            $query = mysqli_query($mysqli, "DELETE FROM presupuesto WHERE cod_presupuesto = $codigo") 
            or die('error'.mysqli_error($mysqli));
            if($query){
                header("Location: ../../main.php?module=presupuestos&alert=3");
            }else{
                header("Location: ../../main.php?module=presupuestos&alert=4");
            }
        }
    }

    // Aceptar presupuesto (marcar como 'aceptado' y generar orden copiando ítems)
    if(isset($_GET['act']) && $_GET['act']=='aceptar'){
        if(empty($_SESSION['username'])){
            echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
            exit;
        }
        if(isset($_GET['cod_presu'])){
            $codigo = intval($_GET['cod_presu']);

            mysqli_begin_transaction($mysqli);
            try {
                // obtener presupuesto
                $qpre = mysqli_query($mysqli, "SELECT * FROM presupuesto WHERE cod_presupuesto = $codigo LIMIT 1");
                if(!$qpre) throw new Exception('Error: '.mysqli_error($mysqli));
                $pre = mysqli_fetch_assoc($qpre);
                if(!$pre) throw new Exception('Presupuesto no encontrado');

                // crear número de orden y cabecera de orden (ajusta columnas según tu tabla)
                $nro_orden = 'ORD-'.$codigo.'-'.time();
                $fecha = date('Y-m-d');
                $total = floatval($pre['total_presupuesto']);
                $usuario = isset($_SESSION['id_user']) ? intval($_SESSION['id_user']) : 0;

                $sql = "INSERT INTO orden_compra (nro_orden, fecha, total, estado, id_user)
                        VALUES ('$nro_orden', '$fecha', $total, 'pendiente', $usuario)";
                if(!mysqli_query($mysqli, $sql)) throw new Exception('Error insert orden: '.mysqli_error($mysqli));
                $cod_orden = mysqli_insert_id($mysqli);

                // copiar detalles desde detalle_presupuesto -> detalle_orden
                $qdet = mysqli_query($mysqli, "SELECT cod_producto, cantidad, precio, subtotal FROM detalle_presupuesto WHERE cod_presupuesto = $codigo");
                if(!$qdet) throw new Exception('Error detalles: '.mysqli_error($mysqli));
                while($r = mysqli_fetch_assoc($qdet)){
                    $cod_producto = intval($r['cod_producto']);
                    $cantidad = floatval($r['cantidad']);
                    $precio = floatval($r['precio']);
                    $subtotal = floatval($r['subtotal']);
                    $ins = "INSERT INTO detalle_orden (cod_orden, cod_producto, cantidad, precio, subtotal)
                            VALUES ($cod_orden, $cod_producto, $cantidad, $precio, $subtotal)";
                    if(!mysqli_query($mysqli, $ins)) throw new Exception('Error insert detalle_orden: '.mysqli_error($mysqli));
                }

                // actualizar estado del presupuesto a aceptado
                $up = mysqli_query($mysqli, "UPDATE presupuesto SET estado = 'aceptado' WHERE cod_presupuesto = $codigo");
                if(!$up) throw new Exception('Error update presupuesto: '.mysqli_error($mysqli));

                mysqli_commit($mysqli);
                header("Location: ../../main.php?module=presupuestos&alert=4&cod_orden=$cod_orden");
                exit;
            } catch(Exception $e){
                mysqli_rollback($mysqli);
                error_log($e->getMessage());
                header("Location: ../../main.php?module=presupuestos&alert=3");
                exit;
            }
        }
    }
?>