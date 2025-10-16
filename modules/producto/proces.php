<?php
    session_start();
    require "../../config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    }
    else{
        if($_GET['act']== 'insert'){
            if(isset($_POST['Guardar'])){
                $codigo = $_POST['codigo'];
                $cod_tipo_producto = $_POST['cod_tipo_prod'];
                $id_u_medida = $_POST['id_u_medida'];
                $p_descrip = $_POST['p_descrip'];
                $precio = $_POST['precio'];

                $query = mysqli_query($mysqli, "INSERT INTO producto (cod_producto, cod_tipo_prod, id_u_medida, p_descrip, precio)
                VALUES ('$codigo','$cod_tipo_producto','$id_u_medida','$p_descrip','$precio')") 
                or die('error'.mysqli_error($mysqli));
                if($query){
                    header("Location: ../../main.php?module=producto&alert=1");
                }else{
                    header("Location: ../../main.php?module=producto&alert=4");
                }
            }
        }
        elseif($_GET['act']== 'update'){
            if(isset($_POST['Guardar'])){
                if(isset($_POST['codigo'])){
                    $codigo = $_POST['codigo'];
                    $razon_social = $_POST['razon_social'];
                    $ruc = $_POST['ruc'];

                    if(!empty($_POST['direccion'])){
                        $direccion = $_POST['direccion'];
                    }else{
                        $direccion = "No se encuentran registros";
                    }

                    if(!empty($_POST['telefono'])){
                        $telefono = $_POST['telefono'];
                    }else{
                        $telefono = 000;
                    }

                    $query = mysqli_query($mysqli, "UPDATE proveedor SET cod_proveedor = '$codigo', ruc = '$ruc', 
                    direccion = '$direccion', telefono = '$telefono'
                    WHERE cod_proveedor = '$codigo'") 
                    or die('error'.mysqli_error($mysqli));
                    if($query){
                        header("Location: ../../main.php?module=proveedor&alert=2");
                    }else{
                        header("Location: ../../main.php?module=proveedor&alert=4");
                    }
                }
            }
        }
        elseif($_GET['act']== 'delete'){
            if(isset($_GET['cod_proveedor'])){
                $codigo = $_GET['cod_proveedor'];

                $query = mysqli_query($mysqli, "DELETE FROM proveedor WHERE cod_proveedor = '$codigo'") 
                or die('error'.mysqli_error($mysqli));
                if($query){
                    header("Location: ../../main.php?module=proveedor&alert=3");
                }else{
                    header("Location: ../../main.php?module=proveedor&alert=4");
                }
            }
        }
    }
?>