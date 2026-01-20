<?php
    session_start();
    require "../../config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    }
if($_GET['act']== 'update'){
            if(isset($_POST['Guardar'])){
                if(isset($_POST['cantidad'])){
                    $cod_producto = $_POST['codigo'];
                    $cantidad = $_POST['cantidad'];

                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = $cantidad WHERE cod_producto = $cod_producto")
                    or die('Error: '.mysqli_error($mysqli));
                    if($actualizar_stock){
                        header("Location: ../../main.php?module=stock&alert=2");
                    }else{
                        header("Location: ../../main.php?module=stock&alert=4");
                    }
                }
            }
        }
?>