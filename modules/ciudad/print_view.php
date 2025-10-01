<?php
require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT cod_ciudad, descrip_ciudad, dep.id_departamento, dep.dep_descripcion
FROM ciudad ciu
JOIN departamento dep
WHERE ciu.id_departamento=dep.id_departamento")
or die('Error: '.mysqli_error($mysqli));

$count = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte de Ciudad</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    <head>
        <body>
            <div align="center">
                <img src="../../images/asuncion.jpg">
            </div>
            <div>
                Reporte de Ciudad
            </div>
            <div align="center">
                cantidad: <?php echo $count; ?>
            </div>
            <hr>
            <div id="tabla">
                <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                    <thead style="background:#e8ecee">
                        <tr class="table-title">
                            <th height="20" width="100" align="center" valign="middle"><small>Código</small></th>
                            <th height="30" width="150" align="center" valign="middle"><small>Ciudad</small></th>
                            <th height="30" width="150" align="center" valign="middle"><small>Departamento</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($data = mysqli_fetch_assoc($query)){
                            $codigo = $data['cod_ciudad'];
                            $descrip_ciudad = $data['descrip_ciudad'];
                            $dep_descripcion = $data['dep_descripcion'];

                            echo "<tr>
                                    <td width='100%' align='left'>$codigo</td>
                                    <td width='150%' align='left'>$descrip_ciudad</td>
                                    <td width='150%' align='left'>$dep_descripcion</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </body>
</html>