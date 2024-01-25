<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */

//require_once(dirname(__FILE__) . '/../../extensions/SVGGraph/SVGGraph.php');

$report = $customerGroup->getReportByResult($pdf->getFromStr(),$pdf->getUntilStr());
$reportDetail = $customerGroup->getReportDetailByResult($pdf->getFromStr(),$pdf->getUntilStr());
$pdf->ln(5);

if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
}
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(0, 10, '', 0, 1, 'L');
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, "HALLAZGOS DE LOS ESTUDIOS DE SEGURIDAD"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, 10, '', 0, 1, 'L');
//$pdf->SetFillColor(47,156,214);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '2.1 Conceptos finales generados en los estudios' , 1, 'L', 1, 1, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(0,66,109);
$pdf->SetFont($pdf->defaultFont, '', 10);
$pdf->ln(2);

$results = Result::model()->findAll();
$totalByResult = array();
$totalResults = 0;
foreach ($results as $result) {
    $totalByResult[$result->id] = 0;
    foreach ($pdf->periods as $period) {
        $perQty = (int) @$report[$result->id][$period];
        $totalByResult[$result->id] += $perQty;
    }
    $totalResults+=$totalByResult[$result->id];
}

$colors = array(
    Result::FAVORABLE =>  [125, 169, 100],
    Result::NOT_FINISHED => [24, 150, 243],
    Result::NO_FAVORABLE =>  [195, 76, 71], //00171F
    Result::NO_RESULT => [151, 127, 52],
    Result::PENDING =>     [101, 153, 184], //0277BC
    Result::TO_BE_REVIEWED => [251, 214, 94], //004382
    Result::NOT_FINISHED_FAVORABLE =>[109, 174, 219],
    Result::DESFAVORABLE =>[158, 96, 82],
);

$pdf->setDefaultColors();
$pdf->SetFont($pdf->defaultFont, 'B', 9);
//$pdf->SetY($y + 10 * 4.5);
$pdf->SetFillColor(0,66,109);
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
//$pdf->SetTextColor('999');
$pdf->Cell(44.3, 0, $customerGroup->name, 1, 0, 'C', true);

$total = array();
foreach ($pdf->periods as $period) {
    $pdf->Cell(10, 0, $period, 1, 0, 'C', true);
    $total[$period] = 0;
}
$pdf->Cell(12, 0, 'Total', 1, 0, 'C', true);
$pdf->Cell(14, 0, '%', 1, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 9);

$totalPorc=0;
$PorcIndv=0;
foreach ($results as $result) {
    if (isset($report[$result->id])) {
        $pdf->Cell(44, 0, $result->name, 1, 0, 'L');
        $totalRow = 0;
        foreach ($pdf->periods as $period) {
            $perQty = (int) @$report[$result->id][$period];
            $pdf->Cell(10, 0, HtmlHelper::value($perQty, false, ''), 1, 0, 'C');
            $total[$period] += $perQty;
        }
        $PorcIndv=round($totalByResult[$result->id] / $totalResults * 100, 0);
        $pdf->Cell(12, 0, HtmlHelper::value($totalByResult[$result->id], false, ''), 1, 0, 'C');
        $pdf->Cell(14, 0, $PorcIndv . '%', 1, 0, 'C');
        $total['total']+=$totalRow;
        $totalPorc+=$PorcIndv;
        $pdf->Cell(0, 2, '', 0, 1, 'L');
        //$pdf->ln();
    }
}
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
//$pdf->SetTextColor('999');
$pdf->SetFont($pdf->defaultFont, 'B', 9);
$pdf->Cell(44, 0, 'Total', 1, 0, 'C', true);

foreach ($pdf->periods as $period) {
    $pdf->Cell(10, 0, HtmlHelper::value($total[$period], false, ''), 1, 0, 'C', true);
}
//$pdf->Cell(12, 0, HtmlHelper::value($total['total'], false, ''), 0, 0, 'C', true);
$pdf->Cell(12, 0,$totalResults, 1, 0, 'C', true);
$pdf->Cell(14.3, 0,$totalPorc.'%', 1, 0, 'C', true);

$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 9);

$y = $pdf->GetY()+16;
if ($y > 220) {
    $y=$pdf->AddPage()+40;
}

$xc = 35;
$yc = $y+15;
$r = 20;


$i = 0;
$initialAngle = 0;
$angle = 0;
$pdf->SetFont($pdf->defaultFont, '', 9);
foreach ($results as $result) {
    if ($totalByResult[$result->id] > 0 && ($result->id>=1 && $result->id<=7 || $result->id==9)) { 
        $pdf->SetFillColorArray($colors[$result->id]);
        $pdf->SetLineWidth(0.3);
        $angle = 360 * ($totalByResult[$result->id] / $totalResults);
        $pdf->PieSector($xc, $yc, $r, $initialAngle, $initialAngle + $angle, 'FD', false, 0, 2);
        $pdf->SetXY(70, $y + $i * 6);
        $pdf->Cell(5, 0, '', 1, 0, 'R', 1);
        $pdf->Cell(14, 0, '('.round($totalByResult[$result->id] / $totalResults * 100, 0) . '%)', 0, 0, 'R');
        $pdf->Cell(30, 0, $result->name, 0, 0, 'L');
        $initialAngle+=$angle;

        $i++;
    }
}

// JONATHAN
if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
    $pdf->ln(5);
}else{
    $pdf->ln(25);
}
$pdf->Cell(0, 15, '', 0, 1, 'L');
//$pdf->SetFillColor(47,156,214);
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '2.2 Detalle por tipo de hallazgo ', 1, 'L', 1, 1, '', '', true);
$pdf->ln(2);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0,66,109);
$pdf->SetFont($pdf->defaultFont, '', 10);

$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$nombresHallazgos = array('Lab', 'CRiesg.', 'Vist', 'Aca', 'Polgf', 'Otros', 'Fincr.', 'Antc', 'LRest.', 'Docs');
$pdf->SetFont($pdf->defaultFont, 'B', 8);
$pdf->Cell(25, 0, "Tipo Hallazgo", 1, 0, 'C', true);
foreach($nombresHallazgos as $nombre){
    $pdf->Cell(16.5, 0, $nombre, 1, 0, 'C', true);
}
$pdf->ln();
$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 9);


    /*foreach($results as $result) {

        if($result->id == Result::NO_FAVORABLE ||
            $result->id == Result::TO_BE_REVIEWED){

            $pdf->Cell(40, 0, $result->name, 1, 0, 'L');
            $valorHL = (int)@$reportDetail[3]['laboral'];
            $pdf->Cell(25, 0, HtmlHelper::value($valorHL, false, ''), 1, 0, 'C');
            $valorHS = (int)@$reportDetail[$result->id]['socioeco'];
            $pdf->Cell(25, 0, HtmlHelper::value($valorHS, false, ''), 1, 0, 'C');
            $valorHV = (int)@$reportDetail[$result->id]['visit'];
            $pdf->Cell(25, 0, HtmlHelper::value($valorHV, false, ''), 1, 0, 'C');
            $valorHST = (int)@$reportDetail[$result->id]['study'];
            $pdf->Cell(25, 0, HtmlHelper::value($valorHST, false, ''), 1, 0, 'C');
            $valorHP = (int)@$reportDetail[$result->id]['polygraph'];
            $pdf->Cell(25, 0, HtmlHelper::value($valorHP, false, ''), 1, 0, 'C');
            $valorHO = (int)@$reportDetail[$result->id]['other'];
            $pdf->Cell(25, 0, HtmlHelper::value($valorHO, false, ''), 1, 0, 'C');
            $pdf->ln();
        }
    }*/

    foreach($reportDetail as $result) {

        if($result['resultId'] == Result::NO_FAVORABLE ||
        $result['resultId'] == Result::TO_BE_REVIEWED){

            $pdf->Cell(25, 0, $result['name'], 1, 0, 'L');
            $valorHL = (int)@$result['laboral'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHL, false, ''), 1, 0, 'C');
            $valorHS = (int)@$result['socioeco'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHS, false, ''), 1, 0, 'C');
            $valorHV = (int)@$result['visit'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHV, false, ''), 1, 0, 'C');
            $valorHST = (int)@$result['study'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHST, false, ''), 1, 0, 'C');
            $valorHP = (int)@$result['polygraph'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHP, false, ''), 1, 0, 'C');
            $valorHO = (int)@$result['other'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHO, false, ''), 1, 0, 'C');
            $valorHF = (int)@$result['financiero'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHF, false, ''), 1, 0, 'C');
            $valorHAN = (int)@$result['antecedentes'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHAN, false, ''), 1, 0, 'C');
            $valorHLR = (int)@$result['listas'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHLR, false, ''), 1, 0, 'C');
            $valorHD = (int)@$result['documentos'];
            $pdf->Cell(16.5, 0, HtmlHelper::value($valorHD, false, ''), 1, 0, 'C');
            $pdf->ln();
        }
    }


$pdf->Cell(0, 2, '', 0, 1, 'L');
$pdf->SetFont($pdf->defaultFont, 'B', 9);$pdf->MultiCell(0,0 , '* Se debe tener en cuenta que algunos estudios se van con más de 1 hallazgo, la tabla anterior muestra la tendencia.', 0, 'L', 0, 0, '', '', true);
    //ARRAY HALLAZGO

/*foreach($results as $result) {

    if($result->id == Result::NO_FAVORABLE){


        $valorHL = (int)@$reportDetail[3]['laboral'];
        $valorHS = (int)@$reportDetail[$result->id]['socioeco'];
        $valorHV = (int)@$reportDetail[$result->id]['visit'];
        $valorHST = (int)@$reportDetail[$result->id]['study'];
        $valorHP = (int)@$reportDetail[$result->id]['polygraph'];
        $valorHO = (int)@$reportDetail[$result->id]['other'];
        $pdf->ln();

        $ListadoH= array(

            'Laboral'=> $valorHL,
            'Financiero'=>$valorHS,
            'Visita'=>$valorHV,
            'Académico'=>$valorHST, 
            'Poligrafía'=>$valorHP,
            'Otros'=>$valorHO


        );

    }

}*/
$ListadoH=[];
foreach($reportDetail as $result) {

    if($result['resultId']==Result::NO_FAVORABLE){

        $valorHL = (int)@$result['laboral'];
        $valorHS = (int)@$result['socioeco'];
        $valorHV = (int)@$result['visit'];
        $valorHST = (int)@$result['study'];
        $valorHP = (int)@$result['polygraph'];
        $valorHO = (int)@$result['other'];
        $valorHF = (int)@$result['financiero'];
        $valorHAN = (int)@$result['antecedentes'];
        $valorHLR = (int)@$result['listas'];
        $valorHD = (int)@$result['documentos'];
        $pdf->ln();

        $ListadoH= array(
            'Laboral'=> $valorHL,
            'Central Riesgo'=>$valorHS,
            'Visita'=>$valorHV,
            'Académico'=>$valorHST,
            'Poligrafía'=>$valorHP,
            'Otros'=>$valorHO,
            'Financiero'=>$valorHF,
            'Antecedentes'=>$valorHAN,
            'Lista Restrictiva'=>$valorHLR,
            'Documentos'=>$valorHD
        );

    }

}

//ARRAY HALLAZGO MENOR

/*foreach($results as $result) {

    if($result->id == Result::TO_BE_REVIEWED){

        $valorHL = (int)@$reportDetail[3]['laboral'];
        $valorHS = (int)@$reportDetail[$result->id]['socioeco'];
        $valorHV = (int)@$reportDetail[$result->id]['visit'];
        $valorHST = (int)@$reportDetail[$result->id]['study'];
        $valorHP = (int)@$reportDetail[$result->id]['polygraph'];
        $valorHO = (int)@$reportDetail[$result->id]['other'];
        $pdf->ln();

        $ListadoHM= array(

            'Laboral'=> $valorHL,
            'Financiero'=>$valorHS,
            'Visita'=>$valorHV,
            'Académico'=>$valorHST,
            'Poligrafía'=>$valorHP,
            'Otros'=>$valorHO


        );



    }

}*/
$ListadoHM=[];
foreach($reportDetail as $result) {

    if($result['resultId'] == Result::TO_BE_REVIEWED){

        $valorHL = (int)@$result['laboral'];
        $valorHS = (int)@$result['socioeco'];
        $valorHV = (int)@$result['visit'];
        $valorHST = (int)@$result['study'];
        $valorHP = (int)@$result['polygraph'];
        $valorHO = (int)@$result['other'];
        $valorHF = (int)@$result['financiero'];
        $valorHAN = (int)@$result['antecedentes'];
        $valorHLR = (int)@$result['listas'];
        $valorHD = (int)@$result['documentos'];
        $pdf->ln();

        $ListadoHM= array(
            'Laboral'=> $valorHL,
            'Central Riesgo'=>$valorHS,
            'Visita'=>$valorHV,
            'Académico'=>$valorHST,
            'Poligrafía'=>$valorHP,
            'Otros'=>$valorHO,
            'Financiero'=>$valorHF,
            'Antecedentes'=>$valorHAN,
            'Lista Restrictiva'=>$valorHLR,
            'Documentos'=>$valorHD
        );
    }
}

if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
}

$data = $ListadoH;
if(!empty($data) && array_sum($data)>0){
    $pdf->SetFont($pdf->defaultFont, 'B', 12);
    $pdf->Cell(0, 5, '', 0, 1, 'C');
    //$pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(190, 0, 'Categoría de Hallazgo', 1, 'C', 1, 1, '', '', true);
    $pdf->Ln(4);
    $pdf->SetTextColor(0,0,0);
    $valX = $pdf->GetX();
    $valY = $pdf->GetY();

        $pdf->BarDiagram(150, 60, $data, '%l : %v (%p)', array(44, 156, 105)); //51, 233, 255
        $pdf->SetXY($valX, $valY + 60);


    /*if($pdf->GetY()>= 220){
        $pdf->AddPage(); 
        $pdf->SetY(30);
    }*/
}


if($pdf->GetY()> 200){
    $pdf->AddPage(); 
    $pdf->SetY(25);
}
$data = $ListadoHM;
if(!empty($data) && array_sum($data)>0){
    $pdf->SetFont($pdf->defaultFont, 'B', 12);
    $pdf->Cell(0, 8, '', 0, 1, 'C');
    /*$pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);*/
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(190, 0, 'Categoría de Hallazgo Menor', 1, 'C', 1, 1, '', '', true);
    $pdf->Ln(4);
    $pdf->SetTextColor(0,0,0);
    $valX = $pdf->GetX();
    $valY = $pdf->GetY();
    $pdf->SetFillColorArray($colors);
    $pdf->BarDiagram(150, 60, $data, '%l : %v (%p)', array(44, 156, 105)); //51, 233, 255
    $pdf->SetXY($valX, $valY + 60);
}    
