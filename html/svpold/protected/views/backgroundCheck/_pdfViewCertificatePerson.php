<?php

/* @var $backgroundCheck BackgroundCheck */

class PlainPDF extends SVPPDF {

    public function PlainPDF() {
        parent::SVPPDF(null, null);
    }

   /* public function Header() {
        
    }

    public function Footer() {
        
    }*/

    function Header()
    {
        //Put the watermark
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(0,0,0);
        $this->RotatedImage(Yii::app()->basePath . '/images/Logo_cerebro.png',180,180,180,180,180);
        //$this->RotatedImage(35,190, $this->Image(Yii::app()->basePath . '/images/Logo_cerebro.png',102,145),45);
    }

    function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        $this->Image($file,102,120,$w,$h);
        $this->Rotate(0);
    }

}

$pdf = new PlainPDF($backgroundCheck, null);
$pdf->SetMargins('25', '20');

$pdf->AddPage();

// Logo
$pdf->Image(Yii::app()->basePath . '/images/encabezado.png', 10, 8,200,35);
// Title
//$this->SetFillColor(255);
//$this->SetFont('Arial', 'B', 10);
//$this->Cell(196, 0, 'VERIFICACIÓN DE LAS CONDICIONES DE SEGURIDAD DE PERSONAS', 0, 1, 'C');
//$this->SetFont('Arial', '', 10);
//$this->Cell(0, 10, 'Nombre: ' . $this->backgroundCheck->fullName . ' [Ref:' . $this->backgroundCheck->code . "]", 0, 1, 'C');
//// Line break
//$this->Ln(6);


$pdf->SetXY(25, 65);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell('', '', 'Bogotá D.C., ' . Holiday::dateToStringSp($backgroundCheck->approvedOn), 0, 1, 'L');
$pdf->Cell('', '', '', 0, 1, 'L');
$pdf->Cell('', '', 'Señor(a)', 0, 1, 'L');
$pdf->Cell('', '', $backgroundCheck->customerUser->name, 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell('', '', $backgroundCheck->customer->name, 0, 1, 'L');
if (trim($backgroundCheck->customer->address) != '') {
    $pdf->Cell('', '', $backgroundCheck->customer->address, 0, 1, 'L');
}
if (trim($backgroundCheck->customer->city) != '') {
    $pdf->Cell('', '', $backgroundCheck->customer->city, 0, 1, 'L');    
} else {
    $pdf->Cell('', '', 'Ciudad', 0, 1, 'L');
}

$pdf->Cell('', '', '', 0, 1, 'L');
$pdf->Cell('', '', '', 0, 1, 'L');

$pdf->Cell('', '', 'Apreciado(a) Señor(a):', 0, 1, 'L');

$pdf->Cell('', '', '', 0, 1, 'L');
$pdf->Cell('', '', '', 0, 1, 'L');

$pdf->MultiCell('', '', 'Concluido el proceso de Estudio de Seguridad adelantado '
        . 'con la persona abajo mencionada, aplicando el criterio definido '
        . 'por ' . $backgroundCheck->customer->name
        . ', nos permitimos señalar que se emite el siguiente '
        . 'concepto:', 0, 'J', 0, 1);

$pdf->Cell('', '*2', '', 0, 1, 'L');


$pdf->SetFillColor(101, 151, 183);
$pdf->SetFont('Arial', 'B', 12);

$pdf->SetX(60);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(28, '', 'NOMBRE', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, '', $backgroundCheck->fullName, 1, 1, 'L', 0);

$pdf->SetX(60);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(28, '', 'ID', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, '',  $backgroundCheck->formatedIdNumber, 1, 1, 'L', 0);

$pdf->SetX(60);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(28, '', 'TIPO', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, '',  $backgroundCheck->customerProduct->name, 1, 1, 'L', 0);

$pdf->SetX(60);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(28, '', 'CONCEPTO', 1, 0, 'L', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(70, '',  strtoupper($backgroundCheck->result->name), 1, 1, 'L', 0);

/*$pdf->SetFillColor(101, 151, 183);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(31, '', 'NOMBRE:', 0, 0, 'R', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(140, '', $backgroundCheck->fullName, 0, 'L', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(31, '', 'ID:', 0, 0, 'R', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(140, '', $backgroundCheck->formatedIdNumber, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(31, '', 'TIPO:', 0, 0, 'R', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(140, '', $backgroundCheck->customerProduct->name, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(31, '', 'CONCEPTO:', 0, 0, 'R', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(140, '', strtoupper($backgroundCheck->result->name), 0, 1, 'L');*/
if ($backgroundCheck->customerUser->certifiedFindings==1){

    if ($backgroundCheck->result->nick=='CH' || $backgroundCheck->result->nick=='CHM'){

        $this->renderPartial('/verificationSection/_summaryCertificatePDF', array(
            'verificationSections' => $backgroundCheck->verificationSections,
            'pdf' => $pdf,
                )
        );
    }
}


$pdf->Cell('', '*3', '', 0, 1, 'L');
$pdf->Cell(196, '', 'Cordialmente,', 0, 1, 'L');
$pdf->Cell('', '*7', '', 0, 1, 'L');


if ($backgroundCheck->approved && $backgroundCheck->approved->signature) {
    $imageFile = $backgroundCheck->approved->signature->getImageFileSized(460, 120);
    $x = $pdf->getX();
    $y = $pdf->getY();
    $imageSize = getimagesize($imageFile);
    if ($imageSize[0] < 460) {
        $xdif = 0.5 + 460 / $imageSize[0] * 8;
    } else {
        $xdif = 0.5;
    }
    $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
    unlink($imageFile);
    $pdf->setXY($x, $y);
}

$pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);



$pdf->SetMargins('0', '0');
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetXY(0, 260);

$pdf->SetTextColor(54, 95, 145);
//$pdf->SetFont('Arial', 'BI', 10);
//$pdf->Cell('', '', 'SECURITY AND VISION LTDA.', 0, 1, 'C', 0);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell('', '', 'SINTECTO LTDA. Carrera 45 No. 97 - 50 Ofc 807 Teléfono (571) 9159000 Bogotá D.C. info@svision.co', 0, 1, 'C', 0);
$pdf->SetXY(9, 264);
$pdf->Cell('', '', 'Empresa asesora, consultora e investigadora en seguridad privada. Resolución Supervigilancia Resolución es 20214440004817 de 24 de febrero de 2021', 0, 1, 'L', 0);

if ($filename != '') {
    $pdf->Output($filename, 'F');
} else {
    //$pdf->SetProtection(array('print'));
    echo $pdf->Output('', 'S');
}