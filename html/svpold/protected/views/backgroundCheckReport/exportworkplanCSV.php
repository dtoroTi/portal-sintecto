<?php

Yii::import('application.extensions.PHPExcel.*');

$firstRow = 7;
$lastDataRow = 1;
$lastRow = $lastDataRow;

/** Error reporting */
error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');

$date1 = new \DateTime("");
$DateYear=$date1->format('Y');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(20);

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
        ->setCellValue('B1', 'PLAN DE TRABAJO DIARIO '.$DateYear)
        ->setCellValue('P1', 'xxxxxxxx')
        ->setCellValue('P2', 'xxxxxxxx')
        ->setCellValue('P3', 'Pag 1 de 1')
;

$objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->getStyle("P1:P3")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle('P1:P3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->mergeCells('B1:L3');   
$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');   

$styleArray = array(
    'font' => array(
        'bold' => true
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('P1:P3')->applyFromArray($styleArray);

$styleArrayBorder = array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THICK),
    )
);

$objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('P2')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('P3')->applyFromArray($styleArrayBorder);

$objPHPExcel->getActiveSheet()->getStyle('B1:O3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));
$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));
$objPHPExcel->getActiveSheet()->getStyle('P1:P3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));


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


$objPHPExcel->getActiveSheet()->setSharedStyle($headerStyle, "A6:N6");


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
//$objPHPExcel->getActiveSheet()->setSharedStyle($cellStyle, "A1:A5");
//$objPHPExcel->getActiveSheet()->setSharedStyle($cellStyle, "B1:B5");
//$objPHPExcel->getActiveSheet()->setAutoFilter("B1:B1");


$objPHPExcel->getActiveSheet()->setSharedStyle($cellStyle, "A{$firstRow}:P{$lastRow}");
$objPHPExcel->getActiveSheet()->setAutoFilter("A6:P6");

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);


$objPHPExcel->getActiveSheet()
        ->setCellValue('A6', 'Asignado')
        ->setCellValue('B6', 'Cliente')
        ->setCellValue('C6', 'Nombre')
        ->setCellValue('D6', "ID")
        ->setCellValue('E6', "Ref.")
        ->setCellValue('F6', 'Componentes')
        ->setCellValue('G6', 'Cargo')
        ->setCellValue('H6', '% Total Seccion')
        ->setCellValue('I6', '% Total estudio')
        ->setCellValue('J6', 'Días')
        ->setCellValue('K6', 'Solicitud')
        ->setCellValue('L6', 'Límite Cliente')
        ->setCellValue('M6', 'Límite Interno')
        ->setCellValue('N6', 'Sección')
        ->setCellValue('O6', 'Rol')
        ->setCellValue('P6', 'Fecha Asignación');

$styleArray = array(
    'font' => array(
        'bold' => true
    ),
);

$styleArrayBorderCell= array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    )
);

$objPHPExcel->getActiveSheet()->getStyle("A6:P6")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle("A6:P6")->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC') ) ) );
$objPHPExcel->getActiveSheet()->getStyle("A6:P6")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$date1 = new \DateTime("");
$Date=$date1->format('Y-m-d');

$row = $firstRow;

foreach ($pendingReports as $pendingReport) {
    //@var $pendingReport BackgroundCheck 

    //$reportRow = array();

    if (count($pendingReport->assignedUsers) > 0) {
        foreach ($pendingReport->assignedUsers as $assignedUser) {
        

            $ans = 0;
            $weight = array();
            if ($pendingReport->customerProduct) {
                foreach ($pendingReport->customerProduct->verificationsInProduct as $verificationInProduct) {
                    $weight[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct->weight;
                }
                foreach ($pendingReport->verificationSections as $section) {
                    if (isset($weight[$section->verificationSectionTypeId])) {
                        $ans+= ($weight[$section->verificationSectionTypeId] * $section->percentCompleted / 100);
                    }
                }
            }
            $totalEstudio=round($ans, 0);
          
            $colorRequests="FFFDFD";
            foreach($requestsReports as $dateRequest){
                if($pendingReport->id==$dateRequest->backgroundcheckId && $dateRequest->typeRequest!="Inmediato"){
                    $colorRequests="8237FC";
                }
            }
            //$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row).":A".($row));

            $dias = (strtotime($Date)-strtotime($pendingReport->maxInternalDays))/86400;
            $retVal = abs($dias);

            $dateStudyLmit = new DateTime($pendingReport->studyLimitOn);
            $DateStudyLim=$dateStudyLmit->format('Y-m-d');
            $diasclient = (strtotime($Date)-strtotime($DateStudyLim))/86400;
            //$retValclient = abs($diasclient);

            $retValclient=Holiday::numOfWorkingDays($Date, $DateStudyLim);
            //echo "fecha cliente:".$DateStudyLim."\n";
            //echo "dias:".$retValclient."\n";

            //$retVal = intval($difference);

            //Si es uno de estos clientes marcar de otro color
            if($pendingReport->customer->customerGroupId=='51' || $pendingReport->customer->customerGroupId=='58' || $pendingReport->customer->customerGroupId=='234' || $pendingReport->customer->customerGroupId=='554' || $pendingReport->customer->customerGroupId=='548' || $pendingReport->customerId=='1130' ||$pendingReport->customerId=='1138' || $pendingReport->customerId=='1139' || $pendingReport->customerId=='1165'){
                $colorCliente="75FDED";
            }else{
                $colorCliente="FFFDFD";
            }

            //Vencimiento del día y anteriores límite al cliente 
            if(date("Y-m-d", strtotime($pendingReport->studyLimitOn))==$Date){ //date("Y-m-d", strtotime($pendingReport->studyLimitOn))<=$Date
                $colorFechaVence="C62F29";
            //Vencimiento del día y anteriores límite interno
            }else if($pendingReport->studyLimitOn>$Date && $retValclient==1){ //$pendingReport->maxInternalDays<=$Date
                $colorFechaVence="FA1B1B";
            //Vencimiento dia siguiente
            }else if($pendingReport->studyLimitOn>$Date && $retValclient==2){ //$pendingReport->maxInternalDays>$Date && $retVal==1
                $colorFechaVence="B3B1B1";
            //No cumple ninguna condicion
            }else{
                $colorFechaVence="FFFDFD";
            }

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $row)->applyFromArray($styleArrayBorderCell);
        
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => $colorCliente) ) ) );

            $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => $colorFechaVence) ) ) );

            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => $colorRequests) ) ) );

            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A' . $row, $assignedUser->user->shortUsername)
                    ->setCellValue('B' . $row, $pendingReport->customer->name)
                    ->setCellValue('C' . $row, $pendingReport->fullName)
                    ->setCellValue('D' . $row, $pendingReport->idNumber)
                    ->setCellValue('E' . $row, $pendingReport->code)
                    ->setCellValue('F' . $row, $pendingReport->backgroundCheckComponents)
                    ->setCellValue('G' . $row, $pendingReport->applyToPosition)
                    ->setCellValue('H' . $row, ($assignedUser->verificationSection ? $assignedUser->verificationSection->percentCompleted : $pendingReport->total))
                    ->setCellValue('I' . $row, ($totalEstudio))
                    ->setCellValue('J' . $row,$pendingReport->daysStudy + 1)
                    ->setCellValue('K' . $row, $pendingReport->studyStartedOn)
                    ->setCellValue('L' . $row,$pendingReport->studyLimitOn)
                    ->setCellValue('M' . $row, $pendingReport->maxInternalDays)
                    ->setCellValue('N' . $row,  ($assignedUser->verificationSection ? $assignedUser->verificationSection->sectionName : ''))
                    ->setCellValue('O' . $row, $assignedUser->userRole->name)
                    ->setCellValue('P' . $row, ($assignedUser ? $assignedUser->assignedAt : ''));
            $row++;
        }
    } else {
        //fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
        //$row++;
    }
}
//die();
WebUser::logAccess("Exporto reporte plan de trabajo diario " . $row . " filas.");



$objPHPExcel->getActiveSheet()->setTitle('Plan de Trabajo Diario'.date("Y"));


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Plan de Trabajo Diario"'.date("Ymd_His").'".xlsx"');
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

//init operation
/*$fp = fopen('php://temp', 'w');

$headers = array(
    'Asignado',
    'Cliente',
    'Nombre',
    'ID',
    'Componentes',
    'Cargo',
    '% Total',
    'Días',
    'Solicitud',
    'limite',
    'limite interno',
    'rol',
    'Seccion',
);

fputcsv($fp, $headers, Yii::app()->user->arUser->csvSeparator);
$rows = 0;

foreach ($pendingReports as $pendingReport) {
    //@var $pendingReport BackgroundCheck 

    $reportRow = array();


    if (count($pendingReport->assignedUsers) > 0) {
        foreach ($pendingReport->assignedUsers as $assignedUser) {
            //@var $assignedUser AssignedUser 
            $reportRow['assignedUser'] = $assignedUser->user->shortUsername;
            $reportRow['customername'] = @$pendingReport->customer->name;
            $reportRow['fullName'] = @$pendingReport->fullName;
            $reportRow['id'] = @$pendingReport->idNumber;
            $reportRow['components'] = @$pendingReport->backgroundCheckComponents;
            $reportRow['applyToPosition'] = @$pendingReport->applyToPosition;
            $reportRow['percent'] = ($assignedUser->verificationSection ? $assignedUser->verificationSection->percentCompleted : $pendingReport->total);
            $reportRow['daysStudy'] = @$pendingReport->daysStudy + 1;
            $reportRow['startedOn'] = @$pendingReport->studyStartedOn;
            $reportRow['limitOn'] = @$pendingReport->studyLimitOn;
            $reportRow['internalLimitOn'] = @$pendingReport->maxInternalDays;
            $reportRow['role'] = $assignedUser->userRole->name;
            $reportRow['section'] = ($assignedUser->verificationSection ? $assignedUser->verificationSection->sectionName : '');
            fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
            $rows++;
        }
    } else {
        fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);
        $rows++;
    }
}

WebUser::logAccess("Exporto reporte de assignación CSV con " . $rows . " filas.");


rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Reports_" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);*/
//comment