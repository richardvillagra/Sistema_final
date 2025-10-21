<?php
require_once '../../assets/plugins/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf; 

ob_start();
include "print_view.php";
$html = ob_get_clean();
$nombre_archivo = 'factura_venta.pdf';

$html2pdf = new Html2Pdf('P','A4','es',true,'UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output($nombre_archivo);
?>