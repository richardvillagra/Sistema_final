<?php
    session_start();
    require "../../config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    }
    else{
        if($_GET['act']== 'insert'){
            if(isset($_POST['Guardar'])){
                $codigo = $_POST['id_u_medida'];
                $u_descrip = $_POST['u_descrip'];

                $query = mysqli_query($mysqli, "INSERT INTO u_medida (id_u_medida, u_descrip)
                VALUES ('$codigo', '$u_descrip')") 
                or die('error'.mysqli_error($mysqli));
                if($query){
                    header("Location: ../../main.php?module=unidad&alert=1");
                }else{
                    header("Location: ../../main.php?module=unidad&alert=4");
                }
            }
        }
        elseif($_GET['act']== 'update'){
            if(isset($_POST['Guardar'])){
                if(isset($_POST['codigo'])){
                    $codigo = $_POST['codigo'];
                    $u_descrip = $_POST['u_descrip'];

                    $query = mysqli_query($mysqli, "UPDATE u_medida SET id_u_medida = '$codigo', u_descrip = '$u_descrip'
                    WHERE id_u_medida = '$codigo'") 
                    or die('error'.mysqli_error($mysqli));
                    if($query){
                        header("Location: ../../main.php?module=unidad&alert=2");
                    }else{
                        header("Location: ../../main.php?module=unidad&alert=4");
                    }
                }
            }
        }
        elseif($_GET['act']== 'delete'){
            if(isset($_GET['id_u_medida'])){
                $codigo = $_GET['id_u_medida'];

                $query = mysqli_query($mysqli, "DELETE FROM u_medida WHERE id_u_medida = '$codigo'") 
                or die('error'.mysqli_error($mysqli));
                if($query){
                    header("Location: ../../main.php?module=unidad&alert=3");
                }else{
                    header("Location: ../../main.php?module=unidad&alert=4");
                }
            }
        }
    }
?>