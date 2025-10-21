<?php
require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT cod_producto, 
tp.cod_tipo_prod, 
tp.t_p_descrip,
u.id_u_medida, 
u.u_descrip,
p_descrip, 
precio
FROM producto pro
JOIN tipo_producto tp, u_medida u
WHERE pro.cod_tipo_prod = tp.cod_tipo_prod
AND pro.id_u_medida = u.id_u_medida")
or die('Error: '.mysqli_error($mysqli));

$count = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Reporte de Producto</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    <head>
        <body>
            <div align="center">
                <img src="../../images/asuncion.jpg">
            </div>
            <div>
                Reporte de Producto
            </div>
            <div align="center">
                cantidad: <?php echo $count; ?>
            </div>
            <hr>
            <div id="tabla">
                <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                    <thead style="background:#e8ecee">
                        <tr class="table-title">
                            <th height="20" align="center" valign="middle"><small>Código</small></th>
                            <th height="30" align="center" valign="middle"><small>Tipo de producto</small></th>
                            <th height="30" align="center" valign="middle"><small>Un. de medida</small></th>
                            <th height="30" align="center" valign="middle"><small>Producto</small></th>
                            <th height="30" align="center" valign="middle"><small>Precio</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($data = mysqli_fetch_assoc($query)){
                            $codigo = $data['cod_producto'];
                            $cod_tipo_prod = $data['cod_tipo_prod'];
                            $t_p_descrip = $data['t_p_descrip'];
                            $id_u_medida = $data['id_u_medida'];
                            $u_descrip = $data['u_descrip'];
                            $p_descrip = $data['p_descrip'];
                            $precio = $data['precio'];

                            echo "<tr>
                                    <td width='100' align='left'>$codigo</td>
                                    <td width='150' align='left'>$t_p_descrip</td>
                                    <td width='150' align='left'>$u_descrip</td>
                                    <td width='150' align='left'>$p_descrip</td>
                                    <td width='150' align='left'>$precio</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </body>
</html>