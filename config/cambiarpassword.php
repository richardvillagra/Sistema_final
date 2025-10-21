<?php 
    include "./database.php";
    $email =$_POST['email'];
    $p1 =$_POST['p1'];
    $p2 =$_POST['p2'];
    if($p1 == $p2){
        $p1=sha1($p1);
        $mysqli->query("UPDATE usuarios SET password='$p1' WHERE email='$email' ")or die('error'.$mysqli->connect_error);
        echo "todo bien";
        header("Location: ./index.php");
    }else{
        echo "no coinciden";
    }
?>