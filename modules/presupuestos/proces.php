<?php
    session_start();
    require "../../config/database.php";
    if(empty($_SESSION['username'])){
        echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=3'>";
        exit;
    }

    // Insertar presupuesto desde formulario (posible origen: pedido)
    else{
        if($_GET['act']=='insert'){
            if(isset($_POST['Guardar'])){
                $codigo = $_POST['codigo'];
                $cod_pedido = $_POST['cod_pedido'];
                
                $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
                while($row = mysqli_fetch_assoc($sql)) {
                    $codigo_producto = $row['id_producto'];
                    $precio = $row['precio_tmp'];
                    $cantidad = $row['cantidad_tmp'];

                    //Insertar en la tabla detalle_presupuesto
                    $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_presupuesto (cod_producto, cod_presu, cod_deposito, precio, cantidad) 
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

                //Insertar cabecera de presupuesto
                //Definir variables
                $codigo_cliente = $_POST['codigo_cliente'];
                $nro_presu = $_POST['nro_presupuesto'];
                $fecha = $_POST['fecha'];
                $total_presu = $_POST['suma_total'];
                $estado = 'activo';
                $usuario = $_SESSION['id_user'];
                //Insertar
                $query = mysqli_query($mysqli, "INSERT INTO presupuesto(cod_presu, cod_pedido, id_cliente, nro_presu, fecha, estado, id_user, total_presu)
                VALUES($codigo, $cod_pedido, $codigo_cliente, $nro_presu, '$fecha','$estado', $usuario, $total_presu)")
                or die('Error: '.mysqli_error($mysqli));
                if($query){
                    header("Location: ../../main.php?module=presupuestos&alert=1");
                } else{
                    header("Location: ../../main.php?module=presupuestos&alert=3");
                }

            }
        }

        // Eliminar presupuesto (ajustado a tabla 'presupuesto')
        elseif($_GET['act']=='anular'){
            if(isset($_GET['cod_presu'])){
                $codigo = $_GET['cod_presu'];
                //Anular cabecera de presupuesto (cambiar estado a anulado)
                $query = mysqli_query($mysqli, "UPDATE presupuesto SET estado = 'anulado' WHERE cod_presu = $codigo")
                or die('Error: '.mysqli_error($mysqli));

                //Consultar detalle de presupuesto con el codigo que llega por GET
                $sql = mysqli_query($mysqli, "SELECT * FROM detalle_presupuesto WHERE cod_presu = $codigo");
                while($row = mysqli_fetch_assoc($sql)){
                    $codigo_producto = $row['cod_producto'];
                    $codigo_deposito = $row['cod_deposito'];
                    $cantidad = $row['cantidad'];

                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $cantidad
                    WHERE cod_producto = $codigo_producto AND cod_deposito = $codigo_deposito")
                    or die('Error: '.mysqli_error($mysqli));
                }
                if($query){
                    header("Location: ../../main.php?module=presupuestos&alert=2");
                } else{
                    header("Location: ../../main.php?module=presupuestos&alert=3");
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
                    $qpre = mysqli_query($mysqli, "SELECT * FROM presupuesto WHERE cod_presu = $codigo LIMIT 1");
                    if(!$qpre) throw new Exception('Error: '.mysqli_error($mysqli));
                    $pre = mysqli_fetch_assoc($qpre);
                    if(!$pre) throw new Exception('Presupuesto no encontrado');

                    // crear número de orden y cabecera de orden (ajusta columnas según tu tabla)
                    $nro_orden = 'ORD-'.$codigo.'-'.time();
                    $fecha = date('Y-m-d');
                    $total = floatval($pre['total_presu']);
                    $usuario = isset($_SESSION['id_user']) ? intval($_SESSION['id_user']) : 0;

                    $sql = "INSERT INTO orden_compra (nro_orden, fecha, total, estado, id_user)
                            VALUES ('$nro_orden', '$fecha', $total, 'pendiente', $usuario)";
                    if(!mysqli_query($mysqli, $sql)) throw new Exception('Error insert orden: '.mysqli_error($mysqli));
                    $cod_orden = mysqli_insert_id($mysqli);

                    // copiar detalles desde detalle_presupuesto -> detalle_orden
                    $qdet = mysqli_query($mysqli, "SELECT cod_producto, cantidad, precio, subtotal FROM detalle_presupuesto WHERE cod_presu = $codigo");
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
                    $up = mysqli_query($mysqli, "UPDATE presupuesto SET estado = 'aceptado' WHERE cod_presu = $codigo");
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
    }
?>