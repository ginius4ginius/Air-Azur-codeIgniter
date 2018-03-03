<?php
require('../lib/fpdf/fpdf.php');

function txt($s) {
    return utf8_decode($s);
}
class Struct extends FPDF
{
  //mise ne page des titres
  function TitreChapitre ($libelle){
      $this->SetFont('Arial','',12);
      $this->SetFillColor(155,207,255);
      $this->Cell(0,6,$libelle,0,1,'L',true);
      $this->Ln(4);
  }

// En-tête
function Header()
{
$this->Image('../img/banniere.png',10,6,190);
$this->SetFont('Arial','B',15);
$this->Cell(80);
$this->Ln(20);
$this->Ln(20);

}
// Pied de page
function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/1',0,0,'C');
}

//fonction code BArre
function Codabar($xpos, $ypos, $code, $start='A', $end='A', $basewidth=0.35, $height=16) {
$barChar = array (
    '0' => array (6.5, 10.4, 6.5, 10.4, 6.5, 24.3, 17.9),
    '1' => array (6.5, 10.4, 6.5, 10.4, 17.9, 24.3, 6.5),
    '2' => array (6.5, 10.0, 6.5, 24.4, 6.5, 10.0, 18.6),
    '3' => array (17.9, 24.3, 6.5, 10.4, 6.5, 10.4, 6.5),
    '4' => array (6.5, 10.4, 17.9, 10.4, 6.5, 24.3, 6.5),
    '5' => array (17.9,    10.4, 6.5, 10.4, 6.5, 24.3, 6.5),
    '6' => array (6.5, 24.3, 6.5, 10.4, 6.5, 10.4, 17.9),
    '7' => array (6.5, 24.3, 6.5, 10.4, 17.9, 10.4, 6.5),
    '8' => array (6.5, 24.3, 17.9, 10.4, 6.5, 10.4, 6.5),
    '9' => array (18.6, 10.0, 6.5, 24.4, 6.5, 10.0, 6.5),
    '$' => array (6.5, 10.0, 18.6, 24.4, 6.5, 10.0, 6.5),
    '-' => array (6.5, 10.0, 6.5, 24.4, 18.6, 10.0, 6.5),
    ':' => array (16.7, 9.3, 6.5, 9.3, 16.7, 9.3, 14.7),
    '/' => array (14.7, 9.3, 16.7, 9.3, 6.5, 9.3, 16.7),
    '.' => array (13.6, 10.1, 14.9, 10.1, 17.2, 10.1, 6.5),
    '+' => array (6.5, 10.1, 17.2, 10.1, 14.9, 10.1, 13.6),
    'A' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
    'T' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
    'B' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
    'N' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
    'C' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
    '*' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
    'D' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
    'E' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
);
$this->SetFont('Arial','',13);

$this->Text($xpos, $ypos + $height + 4, $code);
$this->SetFillColor(0);
$code = strtoupper($start.$code.$end);
for($i=0; $i<strlen($code); $i++){
    $char = $code[$i];
    if(!isset($barChar[$char])){
        $this->Error('Invalid character in barcode: '.$char);
    }
    $seq = $barChar[$char];
    for($bar=0; $bar<7; $bar++){
        $lineWidth = $basewidth*$seq[$bar]/6.5;
        if($bar % 2 == 0){
            $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
        }
        $xpos += $lineWidth;
    }
    $xpos += $basewidth*10.4/6.5;
}
}

}

function mkPdf($aParams) {
    //var_dump($aParams);
    //struture de la page
    $pdf = new Struct('P','mm','A4');
  //  $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();

    $pdf->TitreChapitre('INFORMATION VOL');
    //--------------------------------- vol
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,txt('Vol '.$aParams['vol'])) ;
    $pdf->Line(10,70,200,70);
    $pdf->Ln();
    $pdf->Ln();

    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Départ: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['depart']));
    $pdf->Ln();

    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Arrivée: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['arrivee']));
    $pdf->Ln();
    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Prix du billet: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['prix']." euros"));
    $pdf->Ln();
    $pdf->Ln();

    $pdf->TitreChapitre('INFORMATION CLIENT');
    //--------------------------------- client

    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Client: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['client']));
    $pdf->Ln();

    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Adresse: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['adr_rue']." ".$aParams['adr_cp']." ".$aParams['adr_ville']));
    $pdf->Ln();
    $pdf->Ln();

    $pdf->TitreChapitre('INFORMATION RESERVATION');
    //--------------------------------- reservation
    $pdf->Cell(0,10,"Reservation faite par l'agence numero: ".$aParams['gnc_id'],'C');
    $pdf->Line(10,180,200,180);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Nombre de places: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['nbPlaces']));
    $pdf->Ln();

    $pdf->SetFont('Arial','u',12);
    $pdf->Cell(40,10,txt('Prix total: '));
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,txt($aParams['prix_calc']." euros"));
    $pdf->Ln();

    //code BArre
    $pdf->Codabar(120,190,$aParams['rsr_num']);

    //
    $pdf->Output('I', 'res_'.$aParams['vol'].'.pdf');

    /*
    'gnc_id' => string '1' (length=1)
    'rsr_num' => string '1' (length=1)
    'client' => string 'Dino Zor' (length=8)
    'adr_rue' => string 'Rue des LÃ©zards' (length=16)
    'adr_cp' => string '75014' (length=5)
    'adr_ville' => string 'Paris' (length=5)
    'vol' => string 'AF660' (length=5)
    'depart' => string 'Roissy-CDG: 2018-01-16 08:00:00' (length=31)
    'arrivee' => string 'John-F-Kennedy: 2018-01-16 08:00:00' (length=35)
    'prix' => string '277' (length=3)
    'prix_calc' => string '554' (length=3)
    'nbPlaces' => string '2' (length=1)
    */
}

?>
