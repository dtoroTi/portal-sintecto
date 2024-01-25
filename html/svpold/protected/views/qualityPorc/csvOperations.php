<?php

//$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
/*$headers = array(
    'APELLIDOS Y NOMBRES',
    'CORREO',
    'CARGO',
    'NOTA DE CALIDAD',
    'PRODUCTIVIDAD',
    'OPORTUNIDAD',
    'NOTA TOTAL',
    'AUSENTISMO'
);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

foreach ($qualityPorc as $value) {
    $valueSection=$value['valueSection'];
    $valuePQR=$value['valuePQR'];
    $valuePNC=$value['valuePNC'];
}
//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
foreach ($csvOperations as $result ){

    $funcionario=$result['firstName'].' '.$result['lastName'];

    $totalprocesos=$result['atiempo']+$result['fueratiempo'];

    if($totalprocesos==0){
        $cumplimiento=0;
    }else{
        $cumplimiento=round(($result['atiempo']*100/$totalprocesos), 2);
    }
   
    if($result['Meta']==0){
        $meta=0;
    }else{
        $meta=round(($totalprocesos*100/$result['Meta']), 2);
    }
  
    $secciones=$result['Laboral']+$result['Academico']+$result['Financiero']+$result['Adversos']+$result['Visita']+$result['Poligrafo']+$result['Pruebas_Psicotecnicas'];

    $pqrs=$result['LaboralPQR']+$result['AcademicoPQR']+$result['FinancieroPQR']+$result['AdversosPQR']+$result['VisitaPQR']+$result['PoligrafoPQR']+$result['PruebaPQR'];

    $pncs=$result['LaboralPNC']+$result['AcademicoPNC']+$result['FinancieroPNC']+$result['AdversosPNC']+$result['VisitaPNC']+$result['PoligrafoPNC']+$result['PruebaPNC'];

    $porcSecciones=$secciones*$valueSection;
    $porcpqrs=$pqrs*$valuePQR;
    $porcpncs=$pncs*$valuePNC;

    $notaCalidad=round(100-($porcSecciones+$porcpqrs+$porcpncs), 2);
    $notatotal=round(($notaCalidad+$cumplimiento+$meta)/3, 2);

    $reportRow = array();

    $reportRow[] =$funcionario;
    $reportRow[] =$result['Usuario'];
    $reportRow[] ='';
    $reportRow[] =$notaCalidad.'%';
    $reportRow[] =$cumplimiento.'%';
    $reportRow[] =$meta.'%';
    $reportRow[] =$notatotal.'%';
    $reportRow[] ='';

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

   }
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Indicadores de Operaciones" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);*/


/* @var $invoice Invoice */

Yii::import('application.extensions.PHPExcel.*');


$date1 = new \DateTime("first day of this Month");
$Date=$date1->format('Y-m');

foreach ($qualityPorc as $value) {
    $valueSection=$value['valueSection'];
    $valuePQR=$value['valuePQR'];
    $valuePNC=$value['valuePNC'];
}

//ksort($qualityPorc);
$firstRow = 12;
$lastDataRow = 1;
$lastRow = $lastDataRow;

/** Error reporting */
error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(40);

$gdImage = imagecreatefromjpeg('../svpold/mantenimiento/images/fondo_blanco.jpg');

$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Sample image');$objDrawing->setDescription('Sample image');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(60);
$objDrawing->setCoordinates('A1');
$objDrawing->setOffsetX(50);                    
$objDrawing->setOffsetY(10);  
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$objPHPExcel->setActiveSheetIndex(0)
        //->setCellValue('A1', $gdImage)
        ->setCellValue('B1', 'INDICADORES DE OPERACIONES')
        ->setCellValue('A5', 'OPERACIÓN')
        ->setCellValue('A7', 'FECHA DE DEFINICIÓN:')
        ->setCellValue('B7', $Date)
        ->setCellValue('A9', 'PROCESO: GESTIÓN DE OPERACIONES')
        ->setCellValue('H1', 'S.GCI-FR-11')
        ->setCellValue('H2', 'Versión 1')
        ->setCellValue('H3', 'Pag 1 de 1')
;

$objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$objPHPExcel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle("H1:H3")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('H1:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->mergeCells('B1:G3');   
$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');   
$objPHPExcel->getActiveSheet()->mergeCells("A5:H5");     
$objPHPExcel->getActiveSheet()->mergeCells("A9:H9");   

$styleArray = array(
    'font' => array(
        'bold' => true
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A9')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('H1:H3')->applyFromArray($styleArray);

$styleArrayBorder = array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
    )
);

$objPHPExcel->getActiveSheet()->getStyle('A5:H5')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('H2')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('H3')->applyFromArray($styleArrayBorder);

$objPHPExcel->getActiveSheet()->getStyle('B1:G3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));
$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));
$objPHPExcel->getActiveSheet()->getStyle('H1:H3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));


$styleArrayBorderCell= array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    )
);

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

$objPHPExcel->getActiveSheet()->setSharedStyle($headerStyle, "A11:H11");


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

$objPHPExcel->getActiveSheet()->setSharedStyle($cellStyle, "A{$firstRow}:H{$lastRow}");

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);


$objPHPExcel->getActiveSheet()
        ->setCellValue('A11', 'APELLIDOS Y NOMBRES')
        ->setCellValue('B11', 'CORREO')
        ->setCellValue('C11', 'CARGO')
        ->setCellValue('D11', "NOTA DE CALIDAD")
        ->setCellValue('E11', 'PRODUCTIVIDAD')
        ->setCellValue('F11', 'OPORTUNIDAD')
        ->setCellValue('G11', 'NOTA TOTAL')
        ->setCellValue('H11', 'AUSENTISMO')
;

$objPHPExcel->getActiveSheet()->getStyle("A11:H11")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('A11:H11')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC') ) ) );

$row = $firstRow;
foreach ($csvOperations as $result ){

    $funcionario=$result['firstName'].' '.$result['lastName'];

    $totalprocesos=$result['atiempo']+$result['fueratiempo'];

    if($totalprocesos==0){
        $cumplimiento=0;
    }else{
        $cumplimiento=round(($result['atiempo']*100/$totalprocesos), 2);
    }
   
    if($result['Meta']==0){
        $meta=0;
    }else{
        $meta=round(($totalprocesos*100/$result['Meta']), 2);
    }
  
    $secciones=$result['Laboral']+$result['Academico']+$result['Financiero']+$result['Adversos']+$result['Visita']+$result['Poligrafo']+$result['Pruebas_Psicotecnicas'];

    $pqrs=$result['LaboralPQR']+$result['AcademicoPQR']+$result['FinancieroPQR']+$result['AdversosPQR']+$result['VisitaPQR']+$result['PoligrafoPQR']+$result['PruebaPQR'];

    $pncs=$result['LaboralPNC']+$result['AcademicoPNC']+$result['FinancieroPNC']+$result['AdversosPNC']+$result['VisitaPNC']+$result['PoligrafoPNC']+$result['PruebaPNC'];

    $porcSecciones=$secciones*$valueSection;
    $porcpqrs=$pqrs*$valuePQR;
    $porcpncs=$pncs*$valuePNC;

    $notaCalidad=round(100-($porcSecciones+$porcpqrs+$porcpncs), 2);
    $notatotal=round(($notaCalidad+$cumplimiento+$meta)/3, 2);

    if($notatotal<=85){
        $colornotatotal="C62F29";
    }else if($notatotal>85 && $notatotal<=95){
        $colornotatotal="FFC300";
    }else{
        $colornotatotal="2C9C69";
    }
    

    $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => $colornotatotal) ) ) );

    $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArrayBorderCell);
    $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->applyFromArray($styleArrayBorderCell);

    $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $objPHPExcel->getActiveSheet()->getStyle('G'. $row)->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()
            ->setCellValue('A' . $row, $funcionario)
            ->setCellValue('B' . $row, $result['Usuario'])
            ->setCellValue('C' . $row, ' ')
            ->setCellValue('D' . $row, $notaCalidad.'%')
            ->setCellValue('E' . $row, $meta.'%')
            ->setCellValue('F' . $row, $cumplimiento.'%')
            ->setCellValue('G' . $row, $notatotal.'%')
            ->setCellValue('H' . $row, ' ')
    ;
    $row++;
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Factura');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Indicadores de Operaciones.xlsx"');
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


