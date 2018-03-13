<?php
require('../fpdf.php');

$$this->MyPdf = new FPDF();
$$this->MyPdf->AddPage();
$$this->MyPdf->SetFont('Arial','B',16);
$$this->MyPdf->Cell(40,10,'Hello World !');
$$this->MyPdf->Output();
?>
