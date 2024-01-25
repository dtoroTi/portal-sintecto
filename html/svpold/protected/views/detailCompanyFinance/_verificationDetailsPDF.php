<?php

$pdf->SetFillColor(220);

//$pdf->Cell(35, '', 'Número de Personas', 1, 0, 'L', 1);
//$pdf->Cell(20, '', count($verificationSection->detailPersons), 1, 1, 'C');

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
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
      $pdf->AddPage();
      $pdf->Cell('', '', '', '', 1, 'L');
      $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->MultiCell(175, 0, "INFORME RIESGO DE CRÉDITO" , 1, 'C', 1, 1, '', '', true);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
      $pdf->MultiCell(175, 0, "Fecha de último balance reportado: " . $verificationSection->detailCompanyFinance->dateLastBalanceSheet , 1, 'L', 1, 1, '', '', true);
      $pdf->Cell('', '', '', '', 1, 'L');

      
      $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
      $pdf->MultiCell(175, 0, "Análisis de endeudamiento y comportamiento de pago: " , 1, 'L', 1, 1, '', '', true);
      $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
      $pdf->MultiCell(175, 0, $verificationSection->detailCompanyFinance->liabilities , 1, 'L', 1, 1, '', '', true);
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
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_0 , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_0 , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_0 , 1, 'R', 1, 1, '', '', true);

      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->MultiCell(20, 0, "30" , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_30 , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_30 , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_30 , 1, 'R', 1, 1, '', '', true);

      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->MultiCell(20, 0, "60" , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_60 , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_60 , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_60 , 1, 'R', 1, 1, '', '', true);

      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->MultiCell(20, 0, "90" , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_90 , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_90 , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_90 , 1, 'R', 1, 1, '', '', true);

      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->MultiCell(20, 0, "120" , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_120 , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_120 , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_120 , 1, 'R', 1, 1, '', '', true);

      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->MultiCell(20, 0, ">120" , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_more120 , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_more120 , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_more120 , 1, 'R', 1, 1, '', '', true);

      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->MultiCell(20, 0, "Castigada" , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(30, 0, $verificationSection->detailCompanyFinance->nObligaciones_castigada , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorTotal_castigada , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $verificationSection->detailCompanyFinance->valorMora_castigada , 1, 'R', 1, 1, '', '', true);



      $nObligaciones_total= $verificationSection->detailCompanyFinance->nObligaciones_0 + $verificationSection->detailCompanyFinance->nObligaciones_30 + 
      $verificationSection->detailCompanyFinance->nObligaciones_60 + $verificationSection->detailCompanyFinance->nObligaciones_90 + 
      $verificationSection->detailCompanyFinance->nObligaciones_120 + $verificationSection->detailCompanyFinance->nObligaciones_more120 + 
      $verificationSection->detailCompanyFinance->nObligaciones_castigada;

      $valorTotal_total= $verificationSection->detailCompanyFinance->valorTotal_0 + $verificationSection->detailCompanyFinance->valorTotal_30 + 
      $verificationSection->detailCompanyFinance->valorTotal_60 + $verificationSection->detailCompanyFinance->valorTotal_90 + 
      $verificationSection->detailCompanyFinance->valorTotal_120 + $verificationSection->detailCompanyFinance->valorTotal_more120 + 
      $verificationSection->detailCompanyFinance->valorTotal_castigada;

      $valorMora_total= $verificationSection->detailCompanyFinance->valorMora_0 + $verificationSection->detailCompanyFinance->valorMora_30 + 
      $verificationSection->detailCompanyFinance->valorMora_60 + $verificationSection->detailCompanyFinance->valorMora_90 + 
      $verificationSection->detailCompanyFinance->valorMora_120 + $verificationSection->detailCompanyFinance->valorMora_more120 + 
      $verificationSection->detailCompanyFinance->valorMora_castigada;


      $pdf->MultiCell(20,0,"",0,"L",0,0,'','',true);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->MultiCell(20, 0, "TOTAL" , 1, 'R', 1, 0, '', '', true);
      $pdf->SetFont('Arial', '', 9);
      $pdf->MultiCell(30, 0, $nObligaciones_total , 1, 'C', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $valorTotal_total , 1, 'R', 1, 0, '', '', true);
      $pdf->MultiCell(40, 0, $valorMora_total , 1, 'R', 1, 1, '', '', true);
      $pdf->Cell('', '', '', '', 1, 'L');


      if ($verificationSection->detailCompanyFinance->presentRisk == "1"){
          $ans = "Sí";
        } else{
            $ans = "No";
        }


      $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
      $pdf->MultiCell(175, 0, "Presenta Novedad en Central de Riesgo:" , 1, 'L', 1, 1, '', '', true);
      $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
      $pdf->MultiCell(175, 0, $ans , 1, 'L', 1, 1, '', '', true);
      $pdf->Cell('', '', '', '', 1, 'L');

      $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);$pdf->SetFont('Arial', 'B', 9);
      $pdf->MultiCell(175, 0, "Sanciones y Multas:" , 1, 'L', 1, 1, '', '', true);
      $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0); $pdf->SetFont('Arial', '', 8);
      $pdf->MultiCell(175, 0, $verificationSection->detailCompanyFinance->sanctions , 1, 'L', 1, 1, '', '', true);
      $pdf->Cell('', '', '', '', 1, 'L');
    }