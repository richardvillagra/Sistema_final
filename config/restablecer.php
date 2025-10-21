<?php 
    include "./database.php";
    $email =$_POST['email'];
    $bytes = random_bytes(5);
    $token =bin2hex($bytes);

    include "mail_reset.php";
    if($enviado){
        $codigo= rand(1000,9999);
        $fecha_actual=date("Y-m-d h:m:s");
        $mysqli->query("INSERT INTO passwords (email, token, codigo, fecha) 
        VALUES ('$email', '$token', $codigo, '$fecha_actual')")or die($mysqli->connect_error);
        echo "revisa tu correo";
    }
   

?>