<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */

$report = $customerGroup->getReportSectionsInProgress();
$pdf->ln(10);

$pdf->SetFont($pdf->defaultFont, 'B', 10);
$pdf->Cell(0, 0, '4. b. Cantidad de procesos pendientes por seccion.', 0, 1, 'L');
$pdf->SetFont($pdf->defaultFont, '', 8);
$pdf->ln(2);

$pdf->SetTextColor('999');
$pdf->Cell(40, 0, $customerGroup->name, 0, 0, 'C', true);
$pdf->Cell(40, 0, 'Product', 0, 0, 'C', true);

$total = array();
$pdf->Cell(20, 0, 'Finalizado', 0, 0, 'C', true);
$pdf->Cell(20, 0, 'Pendiente', 0, 0, 'C', true);
$pdf->Cell(20, 0, 'Total', 0, 0, 'C', true);
$pdf->Cell(20, 0, '% Pendiente', 0, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');

$customerProductNames = array_keys($report);
sort($customerProductNames);
$first = true;

foreach ($customerProductNames as $customerProduct) {
    $newCustomer = true;

    foreach ($report[$customerProduct] as $sectionName => $sectionRow) {
        if (!$first && $newCustomer) {
            $border = 'T';
        } else {
            $border = '';
        }

        $pdf->Cell(40, 0, $customerProduct, $border, 0, 'L');
        $pdf->Cell(40, 0, $sectionName, $border, 0, 'L');
        $qtyCompleted = (int) @$report[$customerProduct][$sectionName]['qtyCompleted'];
        $qtyPending = (int) @$report[$customerProduct][$sectionName]['qtyPending'];
        $pdf->Cell(20, 0, HtmlHelper::value($qtyCompleted, false, ''), $border, 0, 'R');
        $pdf->Cell(20, 0, HtmlHelper::value($qtyPending, false, ''), $border, 0, 'R');
        $pdf->Cell(20, 0, HtmlHelper::value($qtyPending + $qtyCompleted, false, ''), $border, 0, 'R');
        $pdf->Cell(20, 0, round($qtyPending/($qtyPending + $qtyCompleted)*100).'%', $border, 0, 'R');
        $pdf->ln();
        $total['total']+=$qtyCompleted + $qtyPending;
        $first = false;
        $newCustomer = false;
    }
}
$pdf->Cell(160, 0, '', 0, 0, 'C', true);

////$pdf->SetTextColor('999');
//$pdf->Cell(40, 0, 'Total', 0, 0, 'C', true);
//$pdf->Cell(40, 0, '', 0, 0, 'C', true);
//$pdf->Cell(12, 0, HtmlHelper::value($total['total'], false, ''), 0, 0, 'R', true);

$pdf->SetTextColor('000');
