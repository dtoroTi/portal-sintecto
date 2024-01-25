<?php

$pdf->SetFillColor(220);

//$pdf->Cell(35, '', 'Número de Personas', 1, 0, 'L', 1);
//$pdf->Cell(20, '', count($verificationSection->detailPersons), 1, 1, 'C');
//Esta funcion llama el compañia
/* foreach ($verificationSection->detailCompanyVisit as $detailCompanyVisit) {

  $pdf->AddPage();
  $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
  $pdf->AddPage();

}*/
/*
foreach ($verificationSection->detailPersons as $person) {
  if (!$person->isAReference) {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(56, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Edad', 1, 0, 'L', 1);
    $pdf->Cell(10, '', CHtml::encode($person->age), 1, 0, 'L');
    $pdf->Cell(25, '', 'Estado Civil', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($person->relationshipStatus->name), 1, 1, 'L');

    $pdf->Cell(25, '', 'Profesión', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->profession), 1, 0, 'L');
    $pdf->Cell(25, '', 'Trabaja en', 1, 0, 'L', 1);
    $pdf->Cell(38, '', CHtml::encode($person->workingAt), 1, 0, 'L');
    $pdf->Cell(25, '', 'Ocupación', 1, 0, 'L', 1);
    $pdf->Cell(48, '', CHtml::encode($person->functions), 1, 1, 'L');

    $pdf->Cell(25, '', 'Nivel de Educación', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->educationType ? $person->educationType->name : ""), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->tel), 1, 0, 'L');
    $pdf->Cell(61, '', '', 1, 1, 'L');
  } else {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(46, '', CHtml::encode($person->tel), 1, 1, 'L');

    $pdf->Cell(25, '', 'Lo conoce hace', 1, 0, 'L', 1);
    $pdf->Cell(15, '', CHtml::encode($person->howLongKnowEachOther), 1, 0, 'L');
    $pdf->Cell(30, '', 'Lo recomendaría', 1, 0, 'L', 1);
    $pdf->Cell(36, '', CHtml::encode($person->wouldYouRecomendTheCandidate), 1, 0, 'L');
    $pdf->Cell(15, '', 'Resultado', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($person->verificationResult->name), 1, 0, 'L');
    $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
    $pdf->Cell(20, '', CHtml::encode($person->verifiedOn), 1, 1, 'L');
  }

  if (trim($person->comments) != "") {
    $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
    $pdf->MultiCell(171, '', CHtml::encode($person->comments), 1, 'J', FALSE, TRUE);
  }
}


$pdf->SetFillColor(255);
*/



// VISITA EMPRESA
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
    $pdf->pushFont();
    $pdf->AddPage();
    //$pdf->SetY(30);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(175, 5, "VISITA EMPRESARIAL " , 0, 'C', 1, 1, '', '', true);
    $pdf->SetFillColor(176,196,222);$pdf->SetTextColor(0);    
    //$pdf->SetY(40);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(171, '', 'Durante la visita que se realizó a sus dependencias se pudo determinar lo siguiente:'
            , 0, 'J', FALSE, TRUE);
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Razón Social" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->backgroundCheck->companyName , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "NIT" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->backgroundCheck->formatedIdNumber , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Dirección" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->backgroundCheck->address , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Barrio" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->backgroundCheck->area , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Ciudad" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->backgroundCheck->city , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Teléfono" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->backgroundCheck->tels , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Contacto" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->detailCompanyVisit->contact , 1, 'L', 1, 1, '', '', true);

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(50, 0, "Cargo" , 1, 'L', 1, 0, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(125, 0, $verificationSection->detailCompanyVisit->contactPosition , 1, 'L', 1, 1, '', '', true);
    $pdf->Cell('', 2, '', '', 1, 'L');

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(175, 0, "Objeto Social" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(175, 0, $verificationSection->detailCompanyVisit->socialObject , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', 2, '', '', 1, 'L');

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(175, 0, "Servicios y/o productos" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(175, 0, $verificationSection->detailCompanyVisit->services , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell('', 2, '', '', 1, 'L');

    $pdf->SetFillColor(200,200,200);
    $pdf->MultiCell(175, 0, "Reseña Historica de la Empresa" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255);
    $pdf->MultiCell(175, 0, $verificationSection->detailCompanyVisit->companyHistory , 1, 'J', 1, 1, '', '', true);
    $pdf->Cell(10, '', '', '', 1, 'L');

    $pdf->SetFillColor(255);
  }