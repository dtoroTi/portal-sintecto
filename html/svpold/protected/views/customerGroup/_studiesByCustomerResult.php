<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */



$report = $customerGroup->getReportByCustomerResult($pdf->getFromStr(),$pdf->getUntilStr());
$reportDetail = $customerGroup->getReportDetailByResult($pdf->getFromStr(),$pdf->getUntilStr());
$reportTime = $customerGroup->getReportBytimeresp($pdf->getFromStr(),$pdf->getUntilStr());
//$pdf->Cell(0, 3, '', 0, 1, 'L');
if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
    $pdf->ln(10);
}
$pdf->Cell(0, 15, '', 0, 1, 'L');
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont($pdf->defaultFont, 'B', 10);
/*$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(47,156,214);*/
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '2.3 Tipos de concepto por subcliente' , 1, 'L', 1, 1, '', '', true);
$pdf->SetFont($pdf->defaultFont, '', 8);;$pdf->SetFillColor(0,66,109);
$pdf->ln(2);
$pdf->SetFont($pdf->defaultFont, 'B', 8);
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
//$pdf->SetTextColor('999');
$pdf->Cell(53, 0, $customerGroup->name, 1, 0, 'L', true);
$pdf->Cell(28, 0, 'Concepto', 1, 0, 'C', true);

$total = array();
foreach ($pdf->periods as $period) {
    $pdf->Cell(8.4, 0, $period, 1, 0, 'C', true);
    $total[$period] = 0;
}
$pdf->SetFont($pdf->defaultFont, 'B', 8);
$pdf->Cell(8.5, 0, 'Total', 1, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 8);
$first = true;
$results = Result::model()->findAll();
foreach ($customerGroup->customers as $customer) {
    $newCustomer = true;
    foreach ($results as $result) {
        if (isset($report[$customer->id][$result->id])) {
            if (!$first && $newCustomer) {
                $border = 'TL';
            } else {
                $border = 'L';
            }
            $pdf->Cell(53, 0, $customer->name, $border, 0, 'L');
            $totalRow = 0;
            $pdf->Cell(28, 0, $result->name, 1, 0, 'L');
            foreach ($pdf->periods as $period) {
                $perQty = (int) @$report[$customer->id][$result->id][$period];
                $pdf->Cell(8.4, 0,  HtmlHelper::value($perQty,false,''), 1, 0, 'C');
                $total[$period] += $perQty;
                $totalRow+=$perQty;
            }
            $total['total']+=$totalRow;
            $pdf->Cell(8.4, 0,  HtmlHelper::value($totalRow,false,''), 1, 0, 'C');
            $pdf->ln();
            $first = false;
            $newCustomer = false;
        }
    }
}
$pdf->SetFont($pdf->defaultFont, 'B', 9);
//$pdf->SetTextColor('999');
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(81, 0, 'Total', 1, 0, 'C', true);

foreach ($pdf->periods as $period) {
    $pdf->Cell(8.4, 0,  HtmlHelper::value($total[$period],false,''), 1, 0, 'C', true);
}
$pdf->Cell(8.4, 0,  HtmlHelper::value($total['total'],false,''), 1, 1, 'C', true);

$pdf->SetTextColor('000');

// JONATHAN CODIGO


$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(0,0,0);

if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
    $pdf->ln(5);
   // $pdf->Cell(0, 10, '', 0, 1, 'L');
}

$pdf->ln(5);
//$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, "TIEMPOS DE RESPUESTA"  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, 10, '', 0, 1, 'L');
//$pdf->SetFillColor(47,156,214);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '3.1 Tiempos de respuesta por tipo de estudio' , 1, 'L', 1, 1, '', '', true);
$pdf->SetTextColor(0,0,0);$pdf->SetFillColor(0,66,109);
// JONATHAN TABLA REAL
$pdf->ln(2);

/*$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(47,156,214);*/
/*$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);*/
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190.2, 6, "Días Hábiles", 1, 1, 'C', true);
//$pdf->SetFillColor(0,66,109);
$diashabiles = array('0', '1', '2', '3', '4', '5', '>5');
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->Cell(32, 10, "Tipo de Estudio", 1, 0, 'C', true);
$pdf->Cell(20, 10, "Días Limite", 1, 0, 'C', true);
foreach($diashabiles as $dhabiles){
    $pdf->Cell(12, 10, $dhabiles, 1, 0, 'C', true);
}

$pdf->Cell(24.3, 10, "Tot.General", 1, 0, 'C', true);
$pdf->Cell(30, 10, "% Tip.Estudio", 1, 1, 'C', true);
$pdf->SetTextColor(0,0,0);

$total_estudios=$customerGroup->getReportBytimeTotal($pdf->getFromStr(),$pdf->getUntilStr());
$total = $total_estudios[0]['total_mayor_cinco'];
if($total!=0){

foreach($reportTime as $time) {
    $pdf->SetFont($pdf->defaultFont, '', 10);
    $pdf->Cell(32, 0,substr(@$time['nombre'], 0, 18) , 1, 0, 'L');
    $pdf->Cell(20, 0,substr(@$time['maxDaysCustomer'], 0, 18) , 1, 0, 'C');
    $valorcero = (int)@$time['cero'];

    //echo $time['maxDaysCustomer'];
    if($time['maxDaysCustomer']<0){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $pdf->Cell(12, 0, HtmlHelper::value($valorcero, false, ''), 1, 0, 'C');
    if($time['maxDaysCustomer']<1){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $valoruno = (int)@$time['uno'];
    $pdf->Cell(12, 0, HtmlHelper::value($valoruno, false, ''), 1, 0, 'C');
    if($time['maxDaysCustomer']<2){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $valordos = (int)@$time['dos'];
    $pdf->Cell(12, 0, HtmlHelper::value($valordos, false, ''), 1, 0, 'C');
    if($time['maxDaysCustomer']<3){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $valorTres = (int)@$time['tres'];
    $pdf->Cell(12, 0, HtmlHelper::value($valorTres, false, ''), 1, 0, 'C');
    if($time['maxDaysCustomer']<4){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $valorcuatro = (int)@$time['cuatro'];
    $pdf->Cell(12, 0, HtmlHelper::value($valorcuatro, false, ''), 1, 0, 'C');
    if($time['maxDaysCustomer']<5){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $valorcinco = (int)@$time['cinco'];
    $pdf->Cell(12, 0, HtmlHelper::value($valorcinco, false, ''), 1, 0, 'C');

    if($time['maxDaysCustomer']<100){
        $pdf->SetFont($pdf->defaultFont, 'B', 10);
        $pdf->SetTextColor(101, 153, 184);
    }else{
        $pdf->SetTextColor(0, 0, 0);
    }
    $valormayor5 = (int)@$time['mayor5'];
    $pdf->Cell(12, 0, HtmlHelper::value($valormayor5, false, ''), 1, 0, 'C');

    $pdf->SetFillColor(220);
    $pdf->SetTextColor(0, 0, 0);
    $valortotal = (int)@$time['total_hasta_cinco']+(int)@$time['mayor5'];
    $pdf->Cell(24.3, 0, HtmlHelper::value($valortotal, false, ''), 1, 0, 'C');
    $valorporcentaje = number_format(((float)$valortotal/$total)*100,2);
    $pdf->SetFont($pdf->defaultFont, 'B', 10);
    $pdf->Cell(29.7, 0, HtmlHelper::value($valorporcentaje, false, '') . '%', 1, 0, 'C');
    $pdf->ln();

}
$total0=0;
$total1=0;
$total2=0;
$total3=0;
$total4=0;
$total5=0;
$totalmayor5=0;
$totalgeneral=0;
foreach($reportTime as $time) {
    $total0=$total0+$time['cero'];
    $total1=$total1+$time['uno'];
    $total2=$total2+$time['dos'];
    $total3=$total3+$time['tres'];
    $total4=$total4+$time['cuatro'];
    $total5=$total5+$time['cinco'];
    $totalmayor5=$totalmayor5+$time['mayor5'];
    $totalgeneral=$totalgeneral+$time['total_mayor_cinco'];
  }

//$pdf->SetTextColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(52, 8,"Total general", 1, 0, 'C', true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(12, 8,$total0, 1, 0, 'C', false);
$pdf->Cell(12, 8,$total1, 1, 0, 'C', false);
$pdf->Cell(12, 8,$total2, 1, 0, 'C', false);
$pdf->Cell(12, 8,$total3, 1, 0, 'C', false);
$pdf->Cell(12, 8,$total4, 1, 0, 'C', false);
$pdf->Cell(12, 8,$total5, 1, 0, 'C', false);
$pdf->Cell(12, 8,$totalmayor5, 1, 0, 'C', false);
$pdf->Cell(24.3, 8,$totalgeneral, 1, 0, 'C', false);
    if ($valortotal != null){
        $pdf->Cell(29.7, 8,$valortotal/$valortotal*100 . '%', 1, 0, 'C', false);
    }
    else {
        $pdf->Cell(29.7, 8,'%', 1, 1, 'C', false);
    }
$pdf->ln();
//$pdf->SetTextColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(52, 8,"% Entrega", 1, 0, 'C', true);
$pdf->SetTextColor(0,0,0);
$vporc0 = number_format(((float)$total0/$total)*100,2);
$vporc1 = number_format(((float)$total1/$total)*100,2);
$vporc2 = number_format(((float)$total2/$total)*100,2);
$vporc3 = number_format(((float)$total3/$total)*100,2);
$vporc4 = number_format(((float)$total4/$total)*100,2);
$vporc5 = number_format(((float)$total5/$total)*100,2);
$vporcmayor5 = number_format(((float)$totalmayor5/$total)*100,2);

$vporctotal = number_format(((float)$totalgeneral/$total)*100,2);
$totalGen=$total0+$total1+$total2+$total3+$total4+$total5;
$general= number_format(((float)$totalGen/$total)*100,2);


$pdf->Cell(12, 8, HtmlHelper::value($vporc0, false, '') . '%', 1, 0, 'C');
$pdf->Cell(12, 8, HtmlHelper::value($vporc1, false, '') . '%', 1, 0, 'C');
$pdf->Cell(12, 8, HtmlHelper::value($vporc2, false, '') . '%', 1, 0, 'C');
$pdf->Cell(12, 8, HtmlHelper::value($vporc3, false, '') . '%', 1, 0, 'C');
$pdf->Cell(12, 8, HtmlHelper::value($vporc4, false, '') . '%', 1, 0, 'C');
$pdf->Cell(12, 8, HtmlHelper::value($vporc5, false, '') . '%', 1, 0, 'C');
$pdf->Cell(12, 8, HtmlHelper::value($vporcmayor5, false, '') . '%', 1, 0, 'C');

//$pdf->Cell(30, 0, HtmlHelper::value($vporctotal, false, '') . '%', 1, 0, 'C');
$pdf->Cell(24.3, 8,"", 1, 0, 'C', false);
$pdf->Cell(29.7, 8,"", 1, 1, 'C', false);
//$pdf->SetTextColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(52, 8,"General", 1, 0, 'C', true);
$pdf->SetTextColor(0,0,0);
//$pdf->SetFillColor(47,156,214);
$pdf->SetFillColor(184, 218, 255);
$pdf->Cell(72, 8,$general . '%', 1, 0, 'C', true);
/*$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(255,255,255);*/
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(12, 8,$vporcmayor5 . '%', 1, 0, 'C', true);

}
