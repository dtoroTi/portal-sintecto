<?php

$pdf->AddPage();
$portrait = $backgroundCheck->frontPageImage;
if ($portrait) {
    $maxWidth = SVPPDF::IMAGE_MAX_WIDTH;
    $imageFile = $portrait->temporalSizedImage;
    $imageSize = getimagesize($imageFile);
    $prex = $pdf->getX();
    if ($imageSize[0] < $maxWidth) {
        //center the image
        $x = SVPPDF::LINE_MAX_WIDTH - round($imageSize[0] / 2 * 196 / $maxWidth)-10.5;
        $y = 10.5;
    } else {
        $x = $pdf->getX();
    }
    $pdf->Image($imageFile, $x,$y);
    unlink($imageFile);
    $pdf->Cell(196, '', '', 0, 1, 'C');
}


$pdf->SetFillColor(46, 117, 181);
$pdf->SetDrawColor(46, 117, 181);
$pdf->SetTextColor(255);
$pdf->SetFont('', 'B', 10);
$pdf->Cell(196, '', 'IDENTIFICACIÓN DE LA EMPRESA', 1, 1, 'L', 1);
$pdf->SetFont('', '', 10);

$pdf->SetTextColor(0);

$pdf->SetFillColor(46, 117, 181);
$pdf->Cell(0, '', "", "LR", 1, 'L');

$pdf->Cell(5, '', "", "L", 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(220);
$pdf->Cell(33, '', $backgroundCheck->getAttributeLabel('customerId') . " : ", 0, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255);
$pdf->Cell(60, '', $backgroundCheck->customer->name, 0, 0, 'L', 1);

$pdf->Cell(5, '', "", 0, 0, 'L');

$pdf->SetFillColor(220);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, '', "Fecha :", 0, 0, 'L', 1);
$pdf->SetFillColor(255);
$pdf->SetFont('Arial', 'B', 12);


if($backgroundCheck->deliveredToCustomerOn != NULL)
{
    $pdf->Cell(60, '', $backgroundCheck->deliveredToCustomerOn, 0, 0, 'L', 1);    
}
else
{
    $pdf->Cell(60, '', Yii::app()->db->createCommand('select now()')->queryScalar(), 0, 0, 'L', 1);
}


$pdf->Cell(5, '', "", "L", 1, 'L');


$pdf->Cell(5, '', "", "L", 0, 'L');

$pdf->SetFillColor(220);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, '', "Nombre :", 0, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255);
$pdf->Cell(60, '', $backgroundCheck->fullName, 0, 0, 'L', 1);

$pdf->Cell(5, '', "", 0, 0, 'L');

$pdf->SetFillColor(220);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, '', "ID :", 0, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255);
$pdf->Cell(60, '', $backgroundCheck->formatedIdNumber, 0, 0, 'L', 1);

$pdf->Cell(5, '', "", "L", 1, 'L');


$pdf->Cell(5, '', "", "L", 0, 'L');

$pdf->SetFillColor(220);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, '', "Tipo : ", 0, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, '', $backgroundCheck->customerProduct->name, 0, 0, 'L');

$pdf->Cell(5, '', "", 0, 0, 'L');

$pdf->SetFillColor(220);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(33, '', "Solicitado Por : ", 0, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, '', $backgroundCheck->customerUser->name, 0, 0, 'L');

$pdf->Cell(5, '', "", "L", 1, 'L');

$customerField = "";
for ($i = 1; $i <= Customer::MAX_FIELDS; $i++) {
    $field = 'field' . $i;
    if ($backgroundCheck->customer->$field != "") {
        $customerFieldNum = 'customerField' . $i;
        $customerField.=" [" . $backgroundCheck->customer->$field . ":" . $backgroundCheck->$customerFieldNum . "]";
    }
}

$pdf->Cell(5, '', "", "LB", 0, 'L');

$pdf->Cell(186, '', $customerField, "B", 0, 'L');

$pdf->Cell(5, '', "", "RB", 1, 'L');


$pdf->Cell(196, '', '', 0, 1, 'C');


if ($backgroundCheck->customerProduct->generalData) {
/// General Section
    
    $pdf->SetDrawColor(46, 117, 181);
    $pdf->SetFillColor(255);

    $pdf->SetFont('', 'B', 10);
    $pdf->SetFillColor(46, 117, 181);
    $pdf->SetTextColor(255);
    $pdf->Cell(196, '', "INFORMACIÓN GENERAL ", 1, 1, 'L', 1);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Cell(0, '', "", "LR", 1, 'L');

    $pdf->Cell(5, '', "", "L", 0, 'L');

    $pdf->SetFont('', '', 10);
    $pdf->SetFillColor(220);
    $pdf->Cell(33, '', $backgroundCheck->getAttributeLabel('actualJob'), 0, 0, 'L', 1);
    $pdf->Cell(60, '', $backgroundCheck->actualJob, 0, 0, 'L');

    
    $pdf->Cell(33, '', $backgroundCheck->getAttributeLabel('applyToPosition'), 0, 0, 'L', 1);
    $pdf->Cell(60, '', $backgroundCheck->applyToPosition, 0, 0, 'L');

    $pdf->Cell(5, '', "", "R", 1, 'L');
    $pdf->Cell(5, '', "", "L", 0, 'L');


    $pdf->Cell(33, '', $backgroundCheck->getAttributeLabel('birthday'), 0, 0, 'L', 1);
    $pdf->Cell(60, '', $backgroundCheck->birthday, 0, 0, 'L');
    $pdf->Cell(33, '', RelationshipStatus::model()->getAttributeLabel('name'), 0, 0, 'L', 1);
    $pdf->Cell(60, '', ($backgroundCheck->relationshipStatus ? $backgroundCheck->relationshipStatus->name : ''), 0, 0, 'L');
    
    $pdf->Cell(5, '', "", "R", 1, 'L');
    $pdf->Cell(5, '', "", "L", 0, 'L');
    
    $pdf->Cell(33, '', $backgroundCheck->getAttributeLabel('age'), 0, 0, 'L', 1);
    $pdf->Cell(60, '', $backgroundCheck->age, 0, 0, 'C');
    $pdf->Cell(33, '', $backgroundCheck->getAttributeLabel('birthPlace'), 0, 0, 'L', 1);
    $pdf->Cell(60, '', $backgroundCheck->birthPlace, 0, 0, 'L');
    
    $pdf->Cell(5, '', "", "R", 1, 'L');
    $pdf->Cell(5, '*2', "", "L", 0, 'L');
    
    $pdf->Cell(33, '*2', $backgroundCheck->getAttributeLabel('tels'), 0, 0, 'L', 1);
    $pdf->Cell(60, '*2', $backgroundCheck->tels, 0, 0, 'L');
    $pdf->Cell(33, '*2', $backgroundCheck->getAttributeLabel('address') . ", " . $backgroundCheck->getAttributeLabel('area'), 0, 0, 'L', TRUE);
    $pdf->MultiCell(60, '*2', $backgroundCheck->address . ", " . $backgroundCheck->area, 
            0, 'L', FALSE);
    
    $pdf->Cell(5, '*2', "", "R", 1, 'L');
    $pdf->Cell(5, '*2', "", "L", 0, 'L');

    $pdf->Multicell(33, '*2', $backgroundCheck->getAttributeLabel('city') . ", " .
            $backgroundCheck->getAttributeLabel('state'),
            0, 'L', TRUE);
    $pdf->MultiCell(60, '*2', $backgroundCheck->city . ", " . $backgroundCheck->state, 
            0, 'L', FALSE);
    if(!empty($backgroundCheck->salarytobeEarned)) {
        $pdf->Multicell(33, '*2', $backgroundCheck->getAttributeLabel('salarytobeEarned'),0, 'L', TRUE);
        $pdf->MultiCell(60, '*2', $backgroundCheck->salarytobeEarned, 
            0, 'L', FALSE);
    }
    //$pdf->Cell(93, '*2', "", 0, 0, 'L');
    $pdf->Cell(98, '*2', "", "R", 1, 'L');
}


/// General Result
// If ther is no comments it suppress the section
if (trim($backgroundCheck->comments) != "") {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(153, 204, 255);
    $pdf->Cell(196, '', "ANÁLISIS, OBSERVACIONES O CONCLUSIONES", 1, 1, 'C', 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(255);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(196, '*25', $backgroundCheck->comments, 1, 'J', FALSE, TRUE);
}

$pdf->SetFillColor(220);
$pdf->Cell(5, '', "", "L", 0, 'L');
$pdf->Cell(33, '', BackgroundCheckStatus::model()->getAttributeLabel('name'), 0, 0, 'L', 1);
$pdf->Cell(60, '', $backgroundCheck->backgroundCheckStatus->name, 0, 0, 'L');
$pdf->Cell(33, '', Result::model()->getAttributeLabel('name'), 0, 0, 'L', 1);
$pdf->Cell(60, '', $backgroundCheck->result->name, 0, 0, 'L');
$pdf->Cell(5, '', "", "R", 1, 'L');


$pdf->Cell(196, '', '', "LBR", 0, 'L');



if ($backgroundCheck->customerProduct->hasXmlQuestion()) {
    $pdf->commands($backgroundCheck->customerProduct->questionFormatXml, $backgroundCheck->xmlAnswerArray);
}



if ($backgroundCheck->customerProduct->printSummarySection >= 1) {
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    $this->renderPartial('/verificationSection/_summarySectionPDF', array(
        'verificationSections' => $backgroundCheck->verificationSections,
        'pdf' => $pdf,
            )
    );

    $maxY = $pdf->GetY();

    $pdf->SetY($y);

    $this->renderPartial('/document/_summaryDocumentsPDF', array(
        'backgroundCheck' => $backgroundCheck,
        'pdf' => $pdf,
        'x' => 100,
            )
    );

    if ($pdf->GetY() < $maxY) {
        $pdf->SetY($maxY);
    }

    $pdf->Cell(0, '*1', "", 0, 1, 'L');
}

// Signature Jonathan
$pdf->Cell(0, '*4', "", 0, 1, 'L');

$pdf->Cell(20, '', "", 0, 0, 'L', 0);

$responsible = $backgroundCheck->responsible;

/*
if ($responsible && $responsible->user->signature) { 
    $imageFile = $responsible->user->signature->getImageFileSized(460, 120);
    $x = $pdf->getX();
    $y = $pdf->getY();
    $imageSize = getimagesize($imageFile);
    if ($imageSize[0] < 460) {
        $xdif = 0.5 + 460 / $imageSize[0] * 8;
    } else {
        $xdif = 0.5;
    }
    $imageSize = getimagesize($imageFile);
    $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
    unlink($imageFile);
    $pdf->setXY($x, $y); 
}
*/

//$pdf->Cell(66, '', ($responsible ? $responsible->user->name : 'PENDIENTE DE ASIGNACION'), "T", 0, 'C', 0);
$pdf->Cell(45, '', "", 0, 0, 'L', 0);

/*if (!($backgroundCheck->responsible && $backgroundCheck->approved &&
        $backgroundCheck->responsible->user->id == $backgroundCheck->approved->id)) {*/

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
    $pdf->Cell(196, '', 'Revisado y Aprobado',0, 1, 'C', 0);
//}


// If ther is no comments it suppress page break
if (trim($backgroundCheck->comments) != "" || $backgroundCheck->customerProduct->hasXmlQuestion()) {
    $pdf->AddPage();
    $newPage = true;
} else {
    $newPage = false;
}


if ($backgroundCheck->customerProduct->printSummarySection == 1) {
    if (!$newPage) {
        $pdf->AddPage();
    }
    $this->renderPartial('/verificationSection/_summarySectionCommentsPDF', array(
        'verificationSections' => $backgroundCheck->verificationSections,
        'pdf' => $pdf,
            )
    );
}

//Nuevo//
$lnks=0;
foreach ($backgroundCheck->verificationSections as $verificationSection) {

    $lnks=$lnks+1;
    //@var $verificationSection VerificationSection
    if ($verificationSection->backgroundCheck->customer->preliminary == 1) {

        $posY=$pdf->GetY($verificationSection->verificationSectionType->description);
        $pageP=$pdf->PageNo($verificationSection->verificationSectionType->description);
        $pdf->SetLink($lnks, $y=$posY, $page=$pageP);
        /*echo $verificationSection->verificationSectionType->description."<br>";
        echo "pos Y: ".$posY."<br>";
        echo "pageP: ".$pageP."<br><br>";*/

            $this->renderPartial('/verificationSection/_verificationSectionPDF', array(
                'verificationSection' => $verificationSection,
                'height' => '',
                'pdf' => $pdf,
            )
        );
    } elseif($verificationSection->percentCompleted >= 100) {

        $posY=$pdf->GetY($verificationSection->verificationSectionType->description);
        $pageP=$pdf->PageNo($verificationSection->verificationSectionType->description);
        $pdf->SetLink($lnks, $y=$posY, $page=$pageP);

            $this->renderPartial('/verificationSection/_verificationSectionPDF', array(
                'verificationSection' => $verificationSection,
                'height' => '',
                'pdf' => $pdf,
            )
        );
    }
}
//

//Anterior---
/*foreach ($backgroundCheck->verificationSections as $verificationSection) {
    //@var $verificationSection VerificationSection 
    if ($verificationSection->percentCompleted >= 100) {
        $this->renderPartial('/verificationSection/_verificationSectionPDF', array(
            'verificationSection' => $verificationSection,
            'height' => '',
            'pdf' => $pdf,
                )
        );
    }
}*/

$this->renderPartial('/event/_eventsPDF', array(
    'backgroundCheck' => $backgroundCheck,
    'height' => '',
    'pdf' => $pdf,
        )
);

if($_GET['valor']==2){
    $pages=$pdf->PageNo();
    $NumStudytotal = $backgroundCheck->getPagesPDF($pages); 
}

if($_GET['valor']==1){
    $this->renderPartial('/document/_documentsPDF', array(
        'backgroundCheck' => $backgroundCheck,
        'height' => '',
        'documents' => $backgroundCheck->documents,
        'pdf' => $pdf,
            )
    );
}

// Se incluye la información de Servicios Web en el reporte
/*$this->renderPartial('_pdfViewServiceResponse', array(
    'model' => $backgroundCheck,
    'pdf' => $pdf,)
);*/