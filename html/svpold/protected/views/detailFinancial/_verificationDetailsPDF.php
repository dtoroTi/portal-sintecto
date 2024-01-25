<?php
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
$pdf->SetFillColor(220);

$pdf->AddPage();
$pdf->SetY(25);    
$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(175, 5, "FINANCIERO" , 0, 'C', 1, 1, '', '', true);
$pdf->SetFillColor(220);$pdf->SetTextColor(0);

$pdf->SetFont('Arial', '', 10);


$financial = $verificationSection->detailFinancial;
$opt = DetailFinancial::model()->getResultStatusOptions();
$result = $opt[$financial->finalResult];

//print_r($result);
//exit;

$pdf->Cell(20, '', $financial->getAttributeLabel('finalResult'), 1, 0, 'L', 1);
$pdf->Cell(155, '', CHtml::encode($result), 1, 1, 'L');

$pdf->Cell(20, '', 'Resultado', 1, 0, 'L', 1);
$pdf->Cell(30, '', CHtml::encode($financial->verificationResult->name), 1, 0, 'L');
$pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
$pdf->Cell(25, '', CHtml::encode($financial->verifiedOn), 1, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0,32,96);
$pdf->MultiCell(196, '','', 0, 'J', false, true);
//$pdf->MultiCell(40, '', 'ACLARACIÓN', 0, 'J', false, true);

$pdf->SetFont('Arial', '', 10);
/*$pdf->MultiCell(175, '', 'SOLUCIONES EN INTEGRIDAD Y CUMPLIMIENTO LTDA. - SINTECTO LTDA., atendiendo a la normatividad vigente sobre la Ley 2157 del 29/10/2021 - "Ley de borrón y cuenta nueva", genera el resultado de la consulta financiera (central de riesgo) de manera informativa en el presente estudio de seguridad. La ejecución de la búsqueda, el uso de la información y sus decisiones resultantes son responsabilidad del usuario final.', 0, 'J', false, true);*/

$pdf->MultiCell(196, '','', 0, 'J', false, true);
$pdf->SetTextColor(0);
$pdf->SetFillColor(255);

}else{

    $pdf->SetFillColor(220);

    $financial = $verificationSection->detailFinancial;
    $opt = DetailFinancial::model()->getResultStatusOptions();
    $result = $opt[$financial->finalResult];
    
    //print_r($result);
    //exit;
    
    $pdf->Cell(15, '', $financial->getAttributeLabel('finalResult'), 1, 0, 'L', 1);
    $pdf->Cell(181, '', CHtml::encode($result), 1, 1, 'L');
    
    $pdf->Cell(15, '', 'Resultado', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($financial->verificationResult->name), 1, 0, 'L');
    $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
    $pdf->Cell(20, '', CHtml::encode($financial->verifiedOn), 1, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(0,32,96);
    $pdf->MultiCell(196, '','', 0, 'J', false, true);
    //$pdf->MultiCell(40, '', 'ACLARACIÓN', 0, 'J', false, true);
    
    $pdf->SetFont('Arial', '', 10);
   /*  $pdf->MultiCell(196, '', 'SOLUCIONES EN INTEGRIDAD Y CUMPLIMIENTO LTDA. - SINTECTO LTDA., atendiendo a la normatividad vigente sobre la Ley 2157 del 29/10/2021 - "Ley de borrón y cuenta nueva", genera el resultado de la consulta financiera (central de riesgo) de manera informativa en el presente estudio de seguridad. La ejecución de la búsqueda, el uso de la información y sus decisiones resultantes son responsabilidad del usuario final.', 0, 'J', false, true); */
    
    $pdf->MultiCell(196, '','', 0, 'J', false, true);
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(255);


}