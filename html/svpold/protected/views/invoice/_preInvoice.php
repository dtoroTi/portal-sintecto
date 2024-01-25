<?php

/* @var $invoice Invoice */

Yii::import('application.extensions.PHPExcel.*');


$invoiceDetails = array();
foreach ($invoice->backgroundChecks as $backgrounCheck) {
    $id = $backgrounCheck->customerProduct->name . "_" . $backgrounCheck->price;
    if (!isset($invoiceDetails[$id])) {
        $invoiceDetails[$id] = array('customerProduct' => $backgrounCheck->customerProduct, 'qty' => 0, 'unitPrice' => $backgrounCheck->price, 'price' => 0);
    }
    $invoiceDetails[$id]['qty'] ++;
    $invoiceDetails[$id]['price']+=$backgrounCheck->price;
}

ksort($invoiceDetails);
$firstRow = 15;
$lastDataRow = 15 + count($invoiceDetails) -1;
$lastRow = $lastDataRow + 19;

/** Error reporting */
error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');




// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


// Set document properties
$objPHPExcel->getProperties()->setCreator("Security & Vision")
        ->setLastModifiedBy("Security & Vision")
        ->setTitle("Factura de " . $invoice->customerGroup->name . " de " . $invoice->invoiceDate)
        ->setSubject("Factura de " . $invoice->customerGroup->name . " " . $invoice->invoiceDescriptor)
        ->setDescription("Factura" . $invoice->customerGroup->name)
        ->setKeywords("Factura S&V " . $invoice->customerGroup->name)
        ->setCategory("Factura " . $invoice->customerGroup->name);


$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(8);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(50);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(6);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(12);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(12);


$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A5', 'Fecha:')
        ->setCellValue('B5', $invoice->invoiceDate)
        ->setCellValue('A6', 'Señores')
        ->setCellValue('B6', $invoice->customerGroup->name)
        ->setCellValue('B7', 'NIT:' . $invoice->customerGroup->invoiceClosingDay)
        ->setCellValue('B8', 'Teléfono :')
        ->setCellValue('B9', '-- Dirección --')
        ->setCellValue('B10', '-- Cidudad --')
;

$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A11', 'Atención: ')
        ->setCellValue('B11', 'Sr....')
        ->setCellValue('B12', 'División XXXX')
        ->setCellValue('B12', 'División XXXX')
        ->setCellValue('A13', 'Contrato')
        ->setCellValue('B13', 'XXXXXX')
;


$headerStyle = new PHPExcel_Style();

$headerStyle->applyFromArray(
        array(
//            'fill' => array(
//                'type' => PHPExcel_Style_Fill::FILL_SOLID,
//                'color' => array('argb' => '00276C99')  //39, 108, 153
//            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            ),
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
));

$objPHPExcel->getActiveSheet()->setSharedStyle($headerStyle, "A14:E14");


$cellStyle = new PHPExcel_Style();

$cellStyle->applyFromArray(
        array(
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            )
));

$objPHPExcel->getActiveSheet()->setSharedStyle($cellStyle, "A{$firstRow}:E{$lastRow}");

$objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(30);


$objPHPExcel->getActiveSheet()
        ->setCellValue('A14', 'ITEM')
        ->setCellValue('B14', 'DESCRIPCION')
        ->setCellValue('C14', 'CANT.')
        ->setCellValue('D14', "VALOR \nUNITARIO")
        ->setCellValue('E14', 'VALOR')
;

$objPHPExcel->getActiveSheet()->getStyle('D14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_DISTRIBUTED);




$row = $firstRow;
foreach ($invoiceDetails as $detail) {
    $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0');

    $objPHPExcel->getActiveSheet()
            ->setCellValue('A' . $row, $row - 14)
            ->setCellValue('B' . $row, $detail['customerProduct']->name)
            ->setCellValue('C' . $row, $detail['qty'])
            ->setCellValue('D' . $row, $detail['unitPrice'])
            ->setCellValue('E' . $row, $detail['price'])
    ;
    $row++;
}

$objPHPExcel->getActiveSheet()->getStyle("D{$firstRow}:E{$lastRow}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);

$row+=3;

$aiuRow=$row;
$objPHPExcel->getActiveSheet()
        ->setCellValue('B' . $aiuRow, 'AIU 10 %')
        ->setCellValue('E' . $aiuRow, '=SUM(E'.$firstRow.':E'.$lastDataRow.')*10%');

$row+=2;

$objPHPExcel->getActiveSheet()->getStyle("B{$row}:E{$row}")->getFont()->setBold(true);

$row+=2;

$discountRow=$row;
$objPHPExcel->getActiveSheet()
        ->setCellValue('B' . $discountRow, 'DESCUENTO COMERCIAL')
        ->setCellValue('E' . $discountRow, (int) $invoice->discount);

$row+=2;

$objPHPExcel->getActiveSheet()->mergeCells("A{$row}:C{$row}");
$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(75);

$objPHPExcel->getActiveSheet()
        ->setCellValue("A{$row}", 'Bajo la gravedad de jurámento manifestamos que SECURITY & '
                . 'VISION ha efectuado los aportes a la seguridad social '
                . 'por los ingresos materia de esta facturación, dando '
                . 'cumplimiento al monto máximo dispuesto por la ley para '
                . 'la base de cotización.El pago de los aportes a seguridad '
                . 'social respectivos se realizó bajo la planilla número '
                . '8307855803 de fecha Noviembre de 2015.');
$row++;

for ($i = 0; $i < 9; $i++) {
    $objPHPExcel->getActiveSheet()->mergeCells("C" . ($row + $i) . ":D" . ($row + $i));
}


$objPHPExcel->getActiveSheet()
        ->setCellValue('C'.($row+0), 'SUBTOTAL ANTES DE DESCUENTOS')
        ->setCellValue('C'.($row+1), 'SUBTOTAL - DESCUENTOS')
        ->setCellValue('C'.($row+2), 'IVA   16 % DEL AIU')
        ->setCellValue('C'.($row+3), 'VALOR TOTAL ')
        ->setCellValue('C'.($row+4), 'DESCUENTOS ')
        ->setCellValue('C'.($row+5), 'Rete FUENTE 2%')
        ->setCellValue('C'.($row+6), 'Rete IVA 15%')
        ->setCellValue('C'.($row+7), 'Rete ICA 1,38%')
        ->setCellValue('C'.($row+8), 'Vr. TOTAL A CANCELAR')
;


$objPHPExcel->getActiveSheet()
        ->setCellValue('E'.($row+0), '=SUM(E'.$firstRow.':E'.$lastDataRow.')')
        ->setCellValue('E'.($row+1), '=E'.($row+0).'-E'.$discountRow)
        ->setCellValue('E'.($row+2), '=+E'.($aiuRow).'*16%')
        ->setCellValue('E'.($row+3), '=SUM(E'.($row+1).':E'.($row+2).')')
        ->setCellValue('E'.($row+4), '')
        ->setCellValue('E'.($row+5), '=SUM(E'.$aiuRow.'*2%)')
        ->setCellValue('E'.($row+6), '=SUM(E'.(($row+2)).'*15%)')
        ->setCellValue('E'.($row+7),'=E'.$aiuRow.'*1.38%')
        ->setCellValue('E'.($row+8), '=E'.($row+3).'-E'.($row+5).'-E'.($row+6).'-E'.($row+7))

;



$objPHPExcel->getActiveSheet()->getStyle('C'.($row+8).':E'.($row+8))->getBorders()->applyFromArray(array('top' => array('style' => PHPExcel_Style_Border::BORDER_THICK),));
$objPHPExcel->getActiveSheet()->getStyle('C'.($row+9).':E'.($row+9))->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+0).':B'.($row+3));
$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+4).':B'.($row+5));
$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+6).':B'.($row+8));
$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+9).':B'.($row+9));

$objPHPExcel->getActiveSheet()->getRowDimension($row+4)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle('A'.($row+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
$objPHPExcel->getActiveSheet()->getStyle('A'.($row+4))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.($row+9))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A'.($row+9).':'.'E'.($row+9))->getBorders()->applyFromArray(array('top' => array('style' => PHPExcel_Style_Border::BORDER_THICK),));
$objPHPExcel->getActiveSheet()->getStyle('A'.($row+9))->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()
        ->setCellValue('A'.($row+4), 'Nota: Recibí los trabajos a satisfacción y en consecuencia pagaré el valor de la presente factura')
        ->setCellValue('A'.($row+9), 'FIRMA Y SELLO DEL CLIENTE')
;


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Factura');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="prefactura ' . $invoice->customerGroup->name . '_' . $invoice->invoiceDate . '_' . $invoice->number . '.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
