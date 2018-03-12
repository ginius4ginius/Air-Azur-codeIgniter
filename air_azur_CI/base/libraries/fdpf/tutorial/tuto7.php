<?php
define('FPDF_FONTPATH','.');
require('../fpdf.php');

$$this->MyPdf = new FPDF();
$$this->MyPdf->AddFont('Calligrapher','','calligra.php');
$$this->MyPdf->AddPage();
$$this->MyPdf->SetFont('Calligrapher','',35);
$$this->MyPdf->Cell(0,10,'Changez de police avec FPDF !');
$$this->MyPdf->Output();
?>
