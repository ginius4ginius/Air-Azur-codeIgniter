<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RPDF extends FPDF
{
        function txt($s) {
        return utf8_decode($s);
        }

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
       $this->Image(img_url('banniere.png'),10,6,190);
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



    foreach($table as $don):
        //var_dump($table);
        $aParams['vol'] = $don->vol;
        $aParams['date_dep'] = $don->date_dep;
        $aParams['date_arr'] = $don->date_arr;
        $aParams['prixPlace'] = $don->prixPlace;
        $aParams['nomClient'] = $don->nomClient.' - '.$don->prenomClient;
        $aParams['adr_rue'] = $don->adr_rue;
        $aParams['adr_cp'] = $don->adr_cp;
        $aParams['adr_ville'] = $don->adr_ville;
        $aParams['gnc_id'] = $don->gnc_id;
        $aParams['place'] = $don->place;
        $aParams['prixTotal'] = $don->prixTotal;
        $aParams['rsr_num'] = $don->rsr_num;
    endforeach;
                    
// Instanciation de la classe dérivée
    $this->myPdf = new RPDF();
    $this->myPdf->AddPage();

    $this->myPdf->TitreChapitre('INFORMATION VOL');
    //--------------------------------- vol
    $this->myPdf->SetFont('Arial','B',16);
    $this->myPdf->Cell(40,10,utf8_decode('Vol '.$aParams['vol'])) ;
    $this->myPdf->Line(10,70,200,70);
    $this->myPdf->Ln();
    $this->myPdf->Ln();

    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Départ: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['date_dep']));
    $this->myPdf->Ln();

    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Arrivée: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['date_arr']));
    $this->myPdf->Ln();
    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Prix du billet: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['prixPlace']." euros"));
    $this->myPdf->Ln();
    $this->myPdf->Ln();

    $this->myPdf->TitreChapitre('INFORMATION CLIENT');
    //--------------------------------- client

    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Client: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['nomClient']));
    $this->myPdf->Ln();

    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Adresse: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['adr_rue']." ".$aParams['adr_cp']." ".$aParams['adr_ville']));
    $this->myPdf->Ln();
    $this->myPdf->Ln();

    $this->myPdf->TitreChapitre('INFORMATION RESERVATION');
    //--------------------------------- reservation
    $this->myPdf->Cell(0,10,utf8_decode("Reservation faite par l'agence: ".$_SESSION["login"]),'C');
    $this->myPdf->Line(10,180,200,180);
    $this->myPdf->Ln();
    $this->myPdf->Ln();
    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Nombre de places: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['place']));
    $this->myPdf->Ln();

    $this->myPdf->SetFont('Arial','u',12);
    $this->myPdf->Cell(40,10,utf8_decode('Prix total: '));
    $this->myPdf->SetFont('Arial','',12);
    $this->myPdf->Cell(40,10,utf8_decode($aParams['prixTotal']." euros"));
    $this->myPdf->Ln();

    //code BArre
    $this->myPdf->Codabar(120,190,$aParams['rsr_num']);

    //
    $this->myPdf->Output('I', 'res_'.$aParams['vol'].'.pdf');
?>
