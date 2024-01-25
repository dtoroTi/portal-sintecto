<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */

$report = $customerGroup->getReportStudiesCancelled($pdf->getFromStr(),$pdf->getUntilStr());
$pdf->ln(10);
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->Cell(0, 0, '3. a. Cantidad de procesos cancelados', 0, 1, 'L');
$pdf->SetFont($pdf->defaultFont, '', 8);
$pdf->ln(2);

//$pdf->SetTextColor('999');
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40, 0, $customerGroup->name, 0, 0, 'C', true);

$total = array();
foreach ($pdf->periods as $period) {
    $pdf->Cell(10, 0, $period, 0, 0, 'C', true);
    $total[$period] = 0;
}
$pdf->Cell(12, 0, 'Total', 0, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');

foreach ($report as $type=>$row) {
    if (isset($report[$type])) {
        $pdf->Cell(40, 0, $type, 0, 0, 'L');
        $totalRow = 0;
        foreach ($pdf->periods as $period) {
            $perQty = (int) @$report[$type][$period];
            $pdf->Cell(10, 0,  HtmlHelper::value($perQty,false,''), 0, 0, 'R');
            $total[$period] += $perQty;
            $totalRow+=$perQty;
        }
        $pdf->Cell(12, 0, HtmlHelper::value($totalRow,false,''), 0, 0, 'R');
        $total['total']+=$totalRow;
        $pdf->ln();
    }
}
//$pdf->SetTextColor('999');
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40, 0, 'Total', 0, 0, 'C', true);

foreach ($pdf->periods as $period) {
    $pdf->Cell(10, 0, HtmlHelper::value($total[$period],false,''), 0, 0, 'R', true);
}
$pdf->Cell(12, 0, HtmlHelper::value($total['total'],false,''), 0, 0, 'R', true);

$pdf->SetTextColor('000');
