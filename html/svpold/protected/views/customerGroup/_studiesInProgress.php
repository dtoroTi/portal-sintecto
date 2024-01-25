<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */

$report = $customerGroup->getReportStudiesInProgress();
$pdf->ln(10);

$now=new DateTime('now');
$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->Cell(0, 0, '4. a. Cantidad de procesos pendientes a la fecha.', 0, 1, 'L');
$pdf->SetFont($pdf->defaultFont, '', 8);
$pdf->ln(2);

$pdf->SetTextColor('999');
$pdf->Cell(40, 0, $customerGroup->name, 0, 0, 'C', true);
$pdf->Cell(40, 0, 'Product', 0, 0, 'C', true);

$total = array();
$pdf->Cell(12, 0, 'Total', 0, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');

$customerProductNames = array_keys($report);
sort($customerProductNames);
$border = '';
foreach ($customerProductNames as $customerProduct) {
    $total['customer'] = 0;
    foreach ($customerGroup->customers as $customer) {
        if (isset($report[$customerProduct][$customer->id])) {
            $pdf->Cell(40, 0, substr($customerProduct, 0, 60), $border, 0, 'L', false, '', true);
            $pdf->Cell(40, 0, $customer->name, $border, 0, 'L');
            $perQty = (int) @$report[$customerProduct][$customer->id];
            $pdf->Cell(12, 0, HtmlHelper::value($perQty, false, ''), $border, 0, 'R');
            $pdf->ln();
            $total['total']+=$perQty;
            $total['customer']+=$perQty;
        }
//        $pdf->Cell(10, 0, HtmlHelper::value($totalRow,false,''), 0, 0, 'R');
    }
    if ($total['customer'] > 0) {
        $pdf->SetTextColor('999');
        $pdf->Cell(80, 0, 'Total : ' . $customerProduct, $border, 0, 'L', true);
        $pdf->Cell(12, 0, HtmlHelper::value($total['customer'], false, ''), $border, 0, 'R', true);
        $pdf->SetTextColor('000');
        $pdf->ln();
    }
}
$pdf->SetTextColor('999');


$pdf->Cell(80, 0, 'Gran Total', 'T', 0, 'C', true);

$pdf->Cell(12, 0, HtmlHelper::value($total['total'], false, ''), 'T', 0, 'R', true);

$pdf->SetTextColor('000');
