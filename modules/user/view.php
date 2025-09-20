<section class="content-header">
    <h1>
        <i class="fa fa-user icon title"></i> Gestión de Usuarios
        <a class="btn btn-primary btn-social pull-right" href="?module=form_user&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(empty($_GET['alert'])){
                    echo "";
                }
                elseif($_GET['alert']==1){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        Los nuevos datos de usuario se han registrado correctamente
                    </div>";
                }

                elseif($_GET['alert']==2){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        Los datos de usuario se han editado correctamente
                    </div>";
                }

                elseif($_GET['alert']==3){
                    echo "<div class='alert alert-succes aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        El usuario ha sido activado correctamente
                    </div>";
                }

                elseif($_GET['alert']==4){
                    echo "<div class='alert alert-danger aler-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i>Exito!</h4>
                        El usuario ha sido bloqeuado correctamente
                    </div>";
                }
            ?>
        </div>
    </div>
</section>