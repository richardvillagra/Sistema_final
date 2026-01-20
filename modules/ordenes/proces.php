<?php
session_start();
require_once "../../config/database.php";
if(empty($_SESSION['username'])) { echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>"; exit; }

if(isset($_GET['act']) && $_GET['act']=='insert' && isset($_POST['Guardar'])){
    $codigo = intval($_POST['codigo']);
    $nro = mysqli_real_escape_string($mysqli, $_POST['nro_orden']);
    $prov = intval($_POST['cod_proveedor']);
    $fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);
    $total = floatval($_POST['total']);
    
    $sql = "INSERT INTO orden_compra (cod_orden, nro_orden, cod_proveedor, fecha, total, estado) 
    VALUES ($codigo,'$nro',$prov,'$fecha',$total,'pendiente')";
    if(mysqli_query($mysqli, $sql)) 
        header("Location: ../../main.php?module=ordenes&alert=1");
    else header("Location: ../../main.php?module=ordenes&alert=3");
    exit;
}

elseif($_GET['act']== 'anular'){
            if(isset($_GET['cod_orden'])){
                $codigo = $_GET['cod_orden'];

                $query = mysqli_query($mysqli, "DELETE FROM orden_compra WHERE cod_orden = '$codigo'") 
                or die('error'.mysqli_error($mysqli));
                if($query){
                    header("Location: ../../main.php?module=ordenes&alert=3");
                }else{
                    header("Location: ../../main.php?module=ordenes&alert=4");
                }
            }
        }
?>