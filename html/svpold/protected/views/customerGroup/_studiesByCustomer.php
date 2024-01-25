<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */

$report = $customerGroup->getReportByCustomer($pdf->getFromStr(),$pdf->getUntilStr());
$pdf->ln(10);
//$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->SetFillColor(0,66,109);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->Cell(0, 10,'A continuación presentamos el informe estadístico de las evaluaciones realizadas:', 0, 1, 'L');
$pdf->Cell(0, 8, '', 0, 1, 'L');



//$pdf->SetTextColor(255,255,255);
//$pdf->MultiCell(190, 0, "Periodo Solicitado"  , 1, 'L', 1, 1, '', '', true);
//$pdf->SetTextColor(0,0,0);
//$pdf->Cell(190, 0, 'Desde ' . $pdf->from->format('Y-m-d') . ' hasta ' . $pdf->until->format('Y-m-d'), 1, 1, 'L');
//$pdf->Cell(0, 10, '', 0, 1, 'L');
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, "NUMERO DE ESTUDIOS SOLICITADOS POR SUBCLIENTE Y POR TIPO DE ESTUDIO."  , 1, 'C', 1, 0, '', '', true);
$pdf->Cell(0, 10, '', 0, 1, 'L');
//$pdf->SetFillColor(47,156,214);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '1.1 Cantidad de procesos realizados por mes' , 1, 'L', 1, 1, '', '', true);
$pdf->SetFont($pdf->defaultFont, 'B', 9);$pdf->SetFillColor(0,66,109);
$pdf->ln(2);
$pdf->SetFont($pdf->defaultFont, 'B', 9);
//$pdf->SetTextColor('999');
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(58, 0, $customerGroup->name, 1, 0, 'C', true);

$total = array();
foreach ($pdf->periods as $period) {
    $pdf->Cell(10, 0, $period, 1, 0, 'C', true);
    $total[$period] = 0;
}
$pdf->Cell(12, 0, 'Total', 1, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');
$pdf->SetFont($pdf->defaultFont, '', 9);
foreach ($customerGroup->customers as $customer) {
    if (isset($report[$customer->id])) {
        $pdf->Cell(58, 0, $customer->name, 1, 0, 'L');
        $totalRow = 0;
        foreach ($pdf->periods as $period) {
            $perQty = (int) @$report[$customer->id][$period];
            $pdf->Cell(10, 0,  HtmlHelper::value($perQty,false,''), 1, 0, 'C');
            $total[$period] += $perQty;
            $totalRow+=$perQty;
        }
        $pdf->Cell(12, 0, HtmlHelper::value($totalRow,false,''), 1, 0, 'C');
        $total['total']+=$totalRow;
        $pdf->ln();
    }
}
$pdf->SetFont($pdf->defaultFont, 'B', 9);
//$pdf->SetTextColor('999');
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(58, 0, 'Total', 1, 0, 'C', true);

foreach ($pdf->periods as $period) {
    $pdf->Cell(10, 0, HtmlHelper::value($total[$period],false,''), 1, 0, 'C', true);
}
$pdf->Cell(12, 0, HtmlHelper::value($total['total'],false,''), 1, 0, 'C', true);

$pdf->SetTextColor('000');
