<?php /*
$pdf->AddPage();
$pdf->SetY(25);


//if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->percentCompleted >=100) {


 //   $section = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE);

$section = null;

if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE))
    $section = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE);

if($section != null)
{

    $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->MultiCell(170, 0, "INFORME RIESGO DE CRÉDITO" , 1, 'C', 1, 1, '', '', true);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
	$pdf->MultiCell(170, 0, "Fecha de último balance reportado: " . $section->detailCompanyFinance->dateLastBalanceSheet , 1, 'L', 1, 1, '', '', true);
	$pdf->Cell('', '', '', '', 1, 'L');

   
	$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
	$pdf->MultiCell(170, 0, "Análisis de endeudamiento y comportamiento de pago: " , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
	$pdf->MultiCell(170, 0, $section->detailCompanyFinance->liabilities , 1, 'L', 1, 1, '', '', true);
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
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_0 , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_0 , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_0 , 1, 'R', 1, 1, '', '', true);

	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->MultiCell(20, 0, "30" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_30 , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_30 , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_30 , 1, 'R', 1, 1, '', '', true);

	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->MultiCell(20, 0, "60" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_60 , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_60 , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_60 , 1, 'R', 1, 1, '', '', true);

	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->MultiCell(20, 0, "90" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_90 , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_90 , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_90 , 1, 'R', 1, 1, '', '', true);

	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->MultiCell(20, 0, "120" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_120 , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_120 , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_120 , 1, 'R', 1, 1, '', '', true);

	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->MultiCell(20, 0, ">120" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_more120 , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_more120 , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_more120 , 1, 'R', 1, 1, '', '', true);

	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->MultiCell(20, 0, "Castigada" , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(30, 0, $section->detailCompanyFinance->nObligaciones_castigada , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorTotal_castigada , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $section->detailCompanyFinance->valorMora_castigada , 1, 'R', 1, 1, '', '', true);



	$nObligaciones_total= $section->detailCompanyFinance->nObligaciones_0 + $section->detailCompanyFinance->nObligaciones_30 + 
	$section->detailCompanyFinance->nObligaciones_60 + $section->detailCompanyFinance->nObligaciones_90 + 
	$section->detailCompanyFinance->nObligaciones_120 + $section->detailCompanyFinance->nObligaciones_more120 + 
	$section->detailCompanyFinance->nObligaciones_castigada;

	$valorTotal_total= $section->detailCompanyFinance->valorTotal_0 + $section->detailCompanyFinance->valorTotal_30 + 
	$section->detailCompanyFinance->valorTotal_60 + $section->detailCompanyFinance->valorTotal_90 + 
	$section->detailCompanyFinance->valorTotal_120 + $section->detailCompanyFinance->valorTotal_more120 + 
	$section->detailCompanyFinance->valorTotal_castigada;

	$valorMora_total= $section->detailCompanyFinance->valorMora_0 + $section->detailCompanyFinance->valorMora_30 + 
	$section->detailCompanyFinance->valorMora_60 + $section->detailCompanyFinance->valorMora_90 + 
	$section->detailCompanyFinance->valorMora_120 + $section->detailCompanyFinance->valorMora_more120 + 
	$section->detailCompanyFinance->valorMora_castigada;


	$pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->MultiCell(20, 0, "TOTAL" , 1, 'R', 1, 0, '', '', true);
	$pdf->SetFont('Arial', '', 9);
	$pdf->MultiCell(30, 0, $nObligaciones_total , 1, 'C', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $valorTotal_total , 1, 'R', 1, 0, '', '', true);
	$pdf->MultiCell(40, 0, $valorMora_total , 1, 'R', 1, 1, '', '', true);
	$pdf->Cell('', '', '', '', 1, 'L');


	if ($section->detailCompanyFinance->presentRisk == "1"){
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
	$pdf->MultiCell(170, 0, $section->detailCompanyFinance->sanctions , 1, 'L', 1, 1, '', '', true);
	$pdf->Cell('', '', '', '', 1, 'L');

	$ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE)->comments;
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell('', '', '', '', 1, 'L');
	$pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
	$pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
	$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial', 'I', 9);
	$pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);
	$pdf->Cell('', '', '', '', 1, 'L');

    $this->renderPartial('/document/_documentsPDF', array(
        'backgroundCheck' => $backgroundCheck,
        'height' => '',
        'documents' => $backgroundCheck->getDocumentsInVerificationSection(VerificationSectionType::DETAIL_COMPANY_FINANCE),
        'pdf' => $pdf,
            )
    );
}
$pdf->popFont();

*/