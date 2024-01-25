<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */
//require_once(dirname(__FILE__) . '/../../extensions/SVGGraph/SVGGraph.php');
/*echo $pdf->getFromStr();
echo $pdf->getUntilStr();*/
$report = $customerGroup->getReportEventDelay($pdf->getFromStr(),$pdf->getUntilStr());
$pdf->ln(5);

if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
}
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(0, 10, '', 0, 1, 'L');
//$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, "RETRASO POR NOVEDADES"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, 10, '', 0, 1, 'L');
//$pdf->SetFillColor(47,156,214);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '4.1 Cantidad de retraso por tipo de Novedad' , 1, 'L', 1, 1, '', '', true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(0,66,109);
$pdf->SetFont($pdf->defaultFont, '', 10);
$pdf->ln(2);

/*$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0,66,109);*/
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->Cell(130, 0, "Tipo Retraso", 1, 0, 'C', true);
$pdf->Cell(30, 0, "Cantidad", 1, 0, 'C', true);
$pdf->Cell(30, 0, "% TOTAL", 1, 0, 'C', true);
$pdf->SetTextColor(0,0,0);

$pdf->ln();
$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 9);

$sumaCant = 0;
foreach ($report as $result) {
    $sumaCant += (int)@$result['cant_retraso'];
}


    $totalporc=0;
    $numero = 0;
    foreach($report as $result) {
        $pdf->Cell(130, 0, $result['tipo_retraso'], 1, 0, 'L');
        $CantRetra = (int)@$result['cant_retraso'];
        $pdf->Cell(30, 0, HtmlHelper::value($CantRetra, false, ''), 1, 0, 'C');
        $valorporcentaje = number_format((((float)$CantRetra)*100/$sumaCant),2);
        $pdf->Cell(30, 0, HtmlHelper::value($valorporcentaje, false, '') . '%', 1, 0, 'C');
        $totalporc=$totalporc+$valorporcentaje;
        $numero += (int)@$result['cant_retraso'];
        $pdf->ln();
    }

    $pdf->SetFont($pdf->defaultFont, 'B', 10);
    //$pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(130, 5,"Total general", 1, 0, 'C', true);
    //$pdf->SetTextColor(0,0,0);
    $pdf->Cell(30, 5,$numero, 1, 0, 'C', true);
    if ($totalporc != null){
        $pdf->Cell(30, 5, round($totalporc). '%', 1, 0, 'C', true);
    }
    else {
        $pdf->Cell(30, 5,'%', 1, 1, 'C', true);
    }
$pdf->Cell(0, 8, '', 0, 1, 'L');

$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 9);
$totalporc=0;
$numero = count($report);

$y = $pdf->GetY();
if ($y > 220) {
    $y=$pdf->AddPage()+40;
}
$xc = 35;
$yc = $y+20;
$r = 20;

//for($i=0;$i<=$numero;++$i){
    $colors = [
        [125, 169, 100],
        [251, 214, 94],
        [195, 76, 71], 
        [101, 153, 184],
        [109, 174, 219],
        [168, 164, 177],
        [223, 185, 77],
        [152, 208, 249],
        [122, 122, 122],
        [167, 90, 120],
        [151, 127, 52],
        [158, 96, 82],
        [125, 169, 100],
        [251, 214, 94],
        [195, 76, 71], 
        [101, 153, 184],
        [109, 174, 219],
        [168, 164, 177],
        [223, 185, 77],
        [152, 208, 249],
        [122, 122, 122],
        [167, 90, 120],
        [151, 127, 52],
        [158, 96, 82],
        [125, 169, 100],
        [251, 214, 94],
        [195, 76, 71], 
        [101, 153, 184],
        [109, 174, 219],
        [168, 164, 177],
        [223, 185, 77],
        [152, 208, 249],
        [122, 122, 122],
        [167, 90, 120],
        [151, 127, 52],
        [158, 96, 82],
    ];
//}

$i = 0;
$initialAngle = 0;
$angle = 0;
    foreach($report as $result) {
        $pdf->SetFillColorArray($colors[$i]);
        $pdf->SetLineWidth(0.3);
        $angle = 360 * ($result['cant_retraso'] / $sumaCant);
        $pdf->PieSector($xc, $yc, $r, $initialAngle, $initialAngle + $angle, 'FD', false, 0, 2);
        $pdf->SetXY(65, $y + $i * 6);
        $pdf->Cell(5, 0, '', 1, 0, 'R', 1);
        $pdf->Cell(16, 0, '('.round($result['cant_retraso']/$sumaCant * 100, 2) . '%)', 0, 0, 'R');
        $pdf->Cell(30, 0, $result['tipo_retraso'], 0, 0, 'L');
        $initialAngle+=$angle;

        $i++;
    }


//Pie chart
/*$data = array('Men' => 1510, 'Women' => 1610, 'Children' => 1400);
//$pdf->Cell(0, 5, '1 - Pie chart', 0, 1);
$pdf->Ln(8);

$pdf->SetFont($pdf->defaultFont, '', 9);
$valX = $pdf->GetX();
$valY = $pdf->GetY();*/

//$ListadoRN=[];
/*foreach($report as $result=>$value) {
    $ListadoRN[]=[$value['tipo_retraso']=>(int)@$value['cant_retraso']];
}

$JsonObject = json_encode($ListadoRN);
$res = preg_replace('/[{\}\\ ]+/', '', $JsonObject);
$resultado = str_replace(':', '=>', $res);
//$array = explode(',', $resultado);
//echo $resultado;
$arr=json_decode($resultado,TRUE);   
//var_dump($arr);
//$data=$arr;
//echo var_dump($data);

$pdf->SetXY(90, $valY);
$col1=array(100,100,255);
$col2=array(255,100,100);
$col3=array(255,255,100);
$col3=array(255,255,100);
$pdf->PieChart(100, 35, $data, '%l (%p)', array($col1,$col2,$col3));
$pdf->SetXY($valX, $valY + 40);*/