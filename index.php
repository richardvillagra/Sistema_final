<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content='width=device-width, initial-scale=1, maximun-scale=1, user-scalable=yes'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Sysweb">
    <meta name="autor" content="Richard Villagra">
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" Type="text/css">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" Type="text/css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css" Type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" Type="text/css">
    <title>login | SysWeb</title>
</head>
<body>
    <div class="login-box">
        <div style="color:#3c8dbc" class="login-logo">
            <img style="margin-top;-15px" src="assets/img/favicon.ico" alt="Sysweb" heigth="50">
            <b>SysWeb</b>
        </div>

        <?php
            if(empty($_GET['alert'])){
                echo "";
            }
            elseif($_GET['alert']==1){
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-times-circle'></i>Error al iniciar sesión</h4>
                Usuario o contraseña incorrecta, vuelva a verificar sus datos.
                </div>";
            }
            elseif($_GET['alert']==2){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-times-circle'></i>Salida Exitosa</h4>
                Has cerrado tu sesión correctamente.
                </div>";
            }
            elseif($_GET['alert']==3){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-times-circle'></i>Atención</h4>
                Debes ingresar un usuario y contraseña para interactuar dentro del sistema.
                </div>";
            }
        ?>
        <div class="login-box-body">
            <p class="login-box-msg"><i class="fa fa-user icon-title"></i>Porfavor inicie sesión</p>
            <br>
            <form action="login-check.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Usuario" autovomplete="off" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" autovomplete="off" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-xs-12">
                        <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="Ingresar">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12" style="margin-top:10px; text-align: center;">
                        <a href="./restablecer.php">Olvidé mi contraseña</a> <br>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script> src="assets/plugins/jQuery/jQuery-2.1.3.min.js"</script>
    <script> src="assets/js/bootstrap.min.js" type="text/javascript"</script>
</body>
</html>