<?php

/* @var $customerGroup CustomerGroup */
/* @var $pdf CustomerGroupPDF */

$pdf->SetTextColor('000');

$report = $customerGroup->getReportByCustomerCustomerProduct($pdf->getFromStr(),$pdf->getUntilStr());
if ( $pdf->GetY() > 200) {
    $pdf->AddPage();
}
$pdf->ln(10);
$pdf->SetFont($pdf->defaultFont, 'B', 10);
/*$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(47,156,214);*/
//$pdf->SetFillColor(160,152,152);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(190, 0, '1.3 Cantidad de estudios por subcliente y tipo de estudio' , 1, 'L', 1, 1, '', '', true);
$pdf->ln(2);
$pdf->SetFont($pdf->defaultFont, 'B', 7.5);$pdf->SetFillColor(0,66,109);
//$pdf->SetTextColor('999');
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50, 0, $customerGroup->name, 1, 0, 'C', true);
$pdf->Cell(28, 0, 'Producto', 1, 0, 'C', true);

$total = array();
foreach ($pdf->periods as $period) {
    $pdf->Cell(8.3, 0, $period, 1, 0, 'C', true);
    $total[$period] = 0;
}
$pdf->Cell(12, 0, 'Total', 1, 0, 'C', true);
$total['total'] = 0;
$pdf->ln();
$pdf->SetTextColor('000');
$first = true;
$pdf->SetFont($pdf->defaultFont, '', 8);
foreach ($customerGroup->customers as $customer) {
    if (isset($report[$customer->id])) {
        $customerProductNames = array_keys($report[$customer->id]);
        sort($customerProductNames);
        $newCustomer = true;
        foreach ($customerProductNames as $customerProduct) {
            if (isset($report[$customer->id][$customerProduct])) {
                if (!$first && $newCustomer) {
                    $border = 'TL';
                } else {
                    $border = 'L';
                }
               // $pdf->MultiCell(30, 0, $customer->name, $border, 'L', 0, 0, '', '', true);
                $pdf->Cell(50, 0, $customer->name,$border, 0, 'L');
                $totalRow = 0;
                $pdf->Cell(28, 0, substr($customerProduct,0,50), 1, 0, 'L',false,'',true);
                foreach ($pdf->periods as $period) {
                    $perQty = (int) @$report[$customer->id][$customerProduct][$period];
                    $pdf->Cell(8.3, 0,  HtmlHelper::value($perQty,false,''), 1, 0, 'C');
                    $total[$period] += $perQty;
                    $totalRow+=$perQty;
                }
                $total['total']+=$totalRow;
                $pdf->Cell(12, 0,  HtmlHelper::value($totalRow,false,''), 1, 0, 'C');
                if ($totalRow == 0) {
                    var_dump(@$report[$customerProduct->id]);
                    var_dump($totalRow);
                    var_dump($total);
                    die();
                }
                $pdf->ln();
                $first = false;
                $newCustomer = false;
            }
        }
    }
}
$pdf->SetFillColor(220);
$pdf->SetTextColor(0,0,0);
//$pdf->SetTextColor('999');
$pdf->SetFont($pdf->defaultFont, 'B', 8);
$pdf->Cell(78, 0, 'Total', 1, 0, 'C', true);

foreach ($pdf->periods as $period) {
    $pdf->Cell(8.3, 0,  HtmlHelper::value($total[$period],false,''), 1, 0, 'C', true);
}
$pdf->Cell(12, 0,  HtmlHelper::value($total['total'],false,''), 1, 0, 'C', true);

$pdf->SetTextColor('000');
