<?php
    require "config/database.php";

    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
    }
    else{
        if($_GET['module'] =='start'){
            include "modules/start/view.php";
        }
        elseif($_GET['module']=='password'){
            include "modules/password/view.php";
        }

        elseif($_GET['module']=='user'){
            include "modules/user/view.php";
        }
        elseif($_GET['module']=='form_user'){
            include "modules/user/form.php";
        }

        elseif($_GET['module']=='perfil'){
            include "modules/perfil/view.php";
        }
        elseif($_GET['module']=='form_perfil'){
            include "modules/perfil/form.php";
        }

        elseif($_GET['module']=='departamento'){
            include "modules/departamento/view.php";
        }
        elseif($_GET['module']=='form_departamento'){
            include "modules/departamento/form.php";
        }
    }
?>