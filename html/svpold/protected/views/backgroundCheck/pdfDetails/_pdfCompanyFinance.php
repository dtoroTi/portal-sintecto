<?php
$pdf->AddPage();
$pdf->SetY(25);

// INFORME RIESGO DE CRÉDITO
$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(170, 0, "INFORME RIESGO DE CRÉDITO" , 1, 'C', 1, 1, '', '', true);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->MultiCell(170, 0, "Fecha de último balance reportado: " . $sectionCompanyFinance->dateLastBalanceSheet , 1, 'L', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(170, 0, "Análisis de endeudamiento y comportamiento de pago: " , 1, 'L', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(170, 0, $sectionCompanyFinance->liabilities , 1, 'L', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "Mora" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, "No. Obligaciones" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, "Valor total" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, "Valor en mora" , 1, 'C', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "Al día" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_0 , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_0 , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_0 , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "30" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_30 , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_30 , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_30 , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "60" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_60 , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_60 , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_60 , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "90" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_90 , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_90 , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_90 , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "120" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_120 , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_120 , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_120 , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, ">120" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_more120 , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_more120 , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_more120 , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->MultiCell(20, 0, "Castigada" , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(30, 0, $sectionCompanyFinance->nObligaciones_castigada , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_castigada , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_castigada , 1, 'R', 1, 1, '', '', true);

$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(20, 0, "TOTAL" , 1, 'R', 1, 0, '', '', true);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(30, 0, $nObligaciones_total , 1, 'C', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorTotal_total , 1, 'R', 1, 0, '', '', true);
$pdf->MultiCell(40, 0, $valorMora_total , 1, 'R', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

if ($sectionCompanyFinance->presentRisk == "1"){
    $ans = "Sí";
} else{
    $ans = "No";
}
$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(170, 0, "Presenta Novedad en Central de Riesgo:" , 1, 'L', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(170, 0, $ans , 1, 'L', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');


$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(170, 0, "Sanciones y Multas:" , 1, 'L', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(170, 0, $sectionCompanyFinance->sanctions , 1, 'L', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');

if ($backgroundCheck->customerProductId == 2327 ) {
    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(42.5, 0, "RUP" , 0, "C", 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "CECOP 1 - 2" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "DEUDORES MOROSOS" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(42.5, 0, "OTRAS" , 1, 'C', 1, 1, '', '', true);
    
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', 'B', 8);
    
    $rup = 0;
    $cecop = 0;
    $deudoresMorosos = 1;
    $otrasCentrales = 0;
    
    if ($rup == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(42.5, 0, $ans , 1, "C", 1, 0, '', '', true);
    if ($cecop == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(42.5, 0, $ans , 1, 'C', 1, 0, '', '', true);
    if ($deudoresMorosos == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(42.5, 0, $ans , 1, 'C', 1, 0, '', '', true);
    if ($otrasCentrales == 1 ) { $pdf->SetTextColor(255,0,0); $ans= "CH"; } else{ $pdf->SetTextColor(0,152,0); $ans = "SH"; };
    $pdf->MultiCell(42.5, 0, $ans , 1, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    
};



$ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->comments;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell('', '', '', '', 1, 'L');
$pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
$pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
$pdf->Cell('', '', '', '', 1, 'L');