<?php
//session_start();
//require_once "../../config/database.php";
?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li class="active"><a href="?module=presupuestos">Presupuestos</a></li>
  </ol><br><hr>
  <h1><i class="fa fa-file-text"></i> Presupuestos
    <a class="btn btn-primary btn-social pull-right" href="?module=form_presupuestos&form=add"><i class="fa fa-plus"></i>Agregar</a>
  </h1>
</section>
<section class="content">
 <div class="box box-primary"><div class="box-body">
  <?php if(!empty($_GET['alert'])) {
     if($_GET['alert']==1) echo "<div class='alert alert-success'>Guardado correctamente.</div>";
     elseif($_GET['alert']==2) echo "<div class='alert alert-success'>Anulado correctamente.</div>";
     else echo "<div class='alert alert-danger'>Ocurrió un error.</div>";
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
                    p.nro_presu, p.fecha, 
                    p.total_presu, p.estado, c.ci_ruc
                    FROM presupuesto p 
                    JOIN clientes c 
                    ON p.id_cliente = c.id_cliente
                    ORDER BY p.cod_presu DESC") 
                    or die(mysqli_error($mysqli));
      while($r = mysqli_fetch_assoc($q)){
          echo "<tr>
                  <td>{$r['cod_presu']}</td>
                  <td>".htmlspecialchars($r['ci_ruc'])."</td>
                  <td>{$r['nro_presu']}</td>
                  <td>{$r['fecha']}</td>
                  <td>{$r['total_presu']}</td>
                  <td>{$r['estado']}</td>
                  <td>
                    <a class='btn btn-info btn-sm' href='?module=presupuestos&form=view&cod_presupuesto={$r['cod_presu']}'><i class='fa fa-eye'></i></a>
                    <a class='btn btn-danger btn-sm' href='modules/presupuestos/proces.php?act=anular&cod_presupuesto={$r['cod_presu']}' onclick=\"return confirm('¿Anular presupuesto?');\"><i class='glyphicon glyphicon-trash'></i></a>
                  </td>
                </tr>";
      }
      ?>
    </tbody>
  </table>
 </div></div>
</section>