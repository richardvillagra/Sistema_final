<?php
    if($_GET['form']=="add"){ ?>
        <section class="content-header">
            <h1>
                <i class="fa fa-shopping-cart icon-title"></i>Agregar Pedido
            </h1>
            <ol class="breadcrumb">
                <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
                <li><a href="?module=pedidos">Pedidos</a></li>
                <li class="active">Agregar</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form role="form" class="form-horizontal" action="modules/pedidos/proces.php?act=insert" method="POST">
                            <div class="box-body">
                                <?php 
                                // Generar código automático para pedido
                                    $query_id = mysqli_query($mysqli, "SELECT MAX(cod_pedido) as id FROM pedido")
                                    or die ('error'.mysqli_error($mysqli));
                                    $count = mysqli_num_rows($query_id);
                                    if($count <> 0){
                                        $data_id = mysqli_fetch_assoc($query_id);
                                        $codigo = $data_id['id']+1;
                                    } else{
                                        $codigo=1;
                                    }

                                    // Si viene cod_pedido por GET, traer datos para prefills
                                    $cod_pedido = isset($_GET['cod_pedido']) ? intval($_GET['cod_pedido']) : 0;
                                    $pedido = null;
                                    if($cod_pedido){
                                        $qped = mysqli_query($mysqli, "SELECT * FROM v_pedidos WHERE cod_pedido = $cod_pedido LIMIT 1");
                                        if($qped) $pedido = mysqli_fetch_assoc($qped);
                                    }
                                ?>
                                <!-- formulario de registro -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Código</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="codigo_pedido" value="<?php echo $codigo;?>" readonly>
                                    </div>
                                
                                    <label class="col-sm-1 control-label">Fecha</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="fecha" autocomplete="off" 
                                        value="<?php echo date('Y-m-d'); ?>" readonly>
                                    </div>
                                    
                                    <label class="col-sm-1 control-label">Hora</label>
                                    <div class="col-sm-2">
                                        <input type="time" class="form-control" name="hora" autocomplete="off" 
                                        value="<?php echo date("H:i"); ?>" readonly>
                                    </div>
                                </div>
                                
                                <!-- proveedor -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Proveedor</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="cod_proveedor" data-placeholder="-- Seleccionar Proveedor --" autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                // Si viene compra, seleccionar automaticamente
                                                $query_prov = mysqli_query($mysqli, "SELECT cod_proveedor, razon_social, ruc FROM proveedor ORDER BY cod_proveedor ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    $sel = ($compra && $compra['cod_proveedor']==$data_prov['cod_proveedor']) ? "selected" : "";
                                                    echo "<option value=\"$data_prov[cod_proveedor]\" $sel>$data_prov[razon_social] | $data_prov[ruc]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 control-label">Nro Pedido</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="nro_pedido" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deposito</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="cod_deposito" data-placeholder="-- Seleccionar Deposito--" autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_dep = mysqli_query($mysqli, "SELECT cod_deposito, descrip FROM deposito ORDER BY cod_deposito ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_dep = mysqli_fetch_assoc($query_dep)){
                                                    echo "<option value=\"$data_dep[cod_deposito]\">$data_dep[cod_deposito] | $data_dep[descrip]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Clientes</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="codigo_cliente" data-placeholder="-- Seleccionar Cliente --" 
                                        autocomplete="off" required>
                                            <option value=""></option>
                                            <?php
                                                $query_cli = mysqli_query($mysqli, "SELECT id_cliente, cli_nombre, ci_ruc FROM clientes ORDER BY id_cliente ASC")
                                                or die('error'.mysqli_error($mysqli));
                                                while($data_cli = mysqli_fetch_assoc($query_cli)){
                                                    echo "<option value=\"$data_cli[id_cliente]\">$data_cli[cli_nombre] | $data_cli[ci_ruc]</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="col-sm-2 control-label">Productos</label>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                            <span class="glyphicon glyphicon-plus">Agregar Productos</span>
                                        </button>
                                    </div>
                                </div>

                                <div id="resultados" class="col-md-9"></div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="hidden" name="cod_pedido" value="<?php echo $cod_pedido; ?>">
                                            <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=pedidos" class="btn btn-default btn-reset">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

    <script>
        $(document).ready(function(){
            load(1);
        });
        function load(page){
            var x = $("#x").val();
            var parametros = {"action":"ajax","page":page,"x":x};
            $("#loader").fadeIn('slow');
            $.ajax({
                url:'./ajax/productos_pedido.php',
                data: parametros,
                beforeSend: function(objeto){
                    $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
                },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $('#loader').html('');
                }
            });
        }
    </script>
    <script>
        function agregar (id){
            var precio_compra = $('#precio_compra_'+id).val();
            var cantidad = $('#cantidad_'+id).val();
            //Inicia validacion
            if (isNaN(cantidad)){
                alert('Esto no es un numero');
                document.getElementById('cantidad_'+id).focus();
                return false;
            }
            if (isNaN(precio_compra)){
                alert('Esto no es un numero');
                document.getElementById('precio_compra_'+id).focus();
                return false;
            }
            //Fin validacion
            var parametros = {"id":id,"precio_compra_":precio_compra,"cantidad":cantidad};
            $.ajax({
                type: "POST",
                url: "./ajax/agregar_pedido.php",
                data: parametros,
                beforeSend: function(objeto){
                    $("#resultados").html("Mensaje: Cargando...");
                },
                success: function(datos){
                    $("#resultados").html(datos);
                }
            });
        }
        function eliminar (id){
            $.ajax({
                type: "GET",
                url: "./ajax/agregar_pedido.php",
                data: "id="+id,
                beforeSend: function(objeto){
                    $("#resultados").html("Mensaje: Cargando...");
                },
                success: function(datos){
                    $("#resultados").html(datos);
                }
            });
        }
    </script>

    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModallabel">Buscar Productos</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="x" placeholder="Buscar productos" onkeyup="load(1);">
                            </div>
                            <button type="button" class="btn btn-default" onclick="load(1);"><span class="glyphicon glyphicon-search"></span>Buscar</button>
                        </div>
                    </form>
                    <div id="loader" style="position:absolute; text-align:center; top:55px; width:100%; display:none;"></div>
                    <div class="outer_div"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>