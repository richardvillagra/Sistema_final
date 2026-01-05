<?php
//session_start();
//require_once "../../config/database.php";
?>
<section class="content-header">
  <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=presupuestos">Presupuesto</a></li>
    </ol><br><hr>
    <h1><i class="fa fa-file-text"></i> Presupuestos
        <a class="btn btn-primary btn-social pull-right" href="?module=form_presupuestos&form=add"><i class="fa fa-plus"></i>Agregar</a>
    </h1>
</section>
<section class="content">
 <div class="box box-primary"><div class="box-body">
  <?php if(!empty($_GET['alert'])) {
     if($_GET['alert']==1) echo "<div class='alert alert-success'>
     Guardado correctamente.</div>";
     elseif($_GET['alert']==2) echo "<div class='alert alert-success'>
     Anulado correctamente.</div>";
     elseif($_GET['alert']==3) echo "<div class='alert alert-danger'>
     Ocurrió un error.</div>";
     elseif($_GET['alert']==4) echo "<div class='alert alert-success'>
     Presupuesto aceptado y orden generada.</div>";
  } ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Código</th>
        <th>Cliente</th>
        <th>Nro</th>
        <th>Fecha</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = mysqli_query($mysqli, "SELECT p.cod_presu, 
        p.nro_presu, 
        p.fecha, 
        p.total_presu, 
        p.estado, 
        c.ci_ruc
        FROM presupuesto p 
        JOIN clientes c 
        ON p.id_cliente = c.id_cliente
          ORDER BY p.cod_presu ASC") or die(mysqli_error($mysqli));
      while($r = mysqli_fetch_assoc($q)){
            $cod = $r['cod_presu'];
            $cliente = $r['ci_ruc'];
            $nro_pedido = $r['nro_presu'];
            $fecha = $r['fecha'];
            $total_presu = $r['total_presu'];
            $estado = $r['estado'];

            echo "<tr>
                  <td>$cod</td>
                  <td>$cliente</td>
                  <td>$nro_pedido</td>
                  <td>$fecha</td>
                  <td>$total_presu</td>
                  <td>$estado</td>
                  <td>";
                  ?>
                    <a data-toggle='tooltip' data-placement='top' title='Aceptar Presupuesto' class='btn btn-success btn-sm' 
                      href='main.php?module=ordenes&form_ordenes=aceptar&cod_presu=<?php echo $r['cod_presu']; ?>'
                      onclick="return confirm('¿Aceptar el presupuesto <?php echo $r['nro_presu']; ?>?');">
                      <i class='fa fa-check'></i>
                    </a>
                    <a class='btn btn-info btn-sm' 
                    href='modules/presupuestos/vista.php?act=vista&cod_presupuesto=<?php echo $r['cod_presu']; ?>'>
                    <i class='fa fa-eye'></i>
                    </a>
                    <a class='btn btn-danger btn-sm' 
                    href='modules/presupuestos/proces.php?act=anular&cod_presupuesto=<?php echo $r['cod_presu']; ?>' 
                    onclick="return confirm('¿Anular presupuesto?');">
                    <i class='glyphicon glyphicon-trash'></i>
                    </a>
                  </td>
                </tr>
      <?php }
      ?>
    </tbody>
  </table>
 </div></div>
</section>