<?php
require_once '../../assets/plugins/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML('<h1>Hola Mundo</h1>Con archivo pdf con HTML2PDF');
$html2pdf->output('ejemplo.pdf');
?>