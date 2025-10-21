<?php 
    include "./database.php";
    $email =$_POST['email'];
    $new_pass =$_POST['new_pass'];
    $p2 =$_POST['retype_pass'];
    if($new_pass == $p2){
        $new_pass = md5(mysqli_real_escape_string($mysqli, trim($_POST['new_pass'])));
        $mysqli->query("UPDATE usuarios SET password = '$new_pass' WHERE email='$email' ")or die('error'.$mysqli->connect_error);
        echo "<h1>todo bien</h1>";
        header("Location: ../index.php");
    }else{
        echo "<h1>no coinciden</h1>";
    }
?>