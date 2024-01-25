<?php

Yii::import('application.extensions.PHPExcel.*');

$from = CHtml::encode($_GET['from']);
$until =CHtml::encode($_GET['until']);

//ksort($qualityPorc);
$firstRow = 10;
$lastDataRow = 1;
$lastRow = $lastDataRow;

/** Error reporting */
error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(40);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(15);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(10);
//$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(10);

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
        ->setCellValue('B1', 'INDICADORES DE PRODUCTIVIDAD SENIOR')
        ->setCellValue('A5', 'FECHA DE CORTE')
        ->setCellValue('A6', 'DESDE')
        ->setCellValue('B6', 'HASTA')
        ->setCellValue('A7', $from)
        ->setCellValue('B7', $until);

$style_cell = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ) 
    ); 

//$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(10);    

$objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setSize(16)->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("A6")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("B6")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('C82626');
$objPHPExcel->getActiveSheet()->getStyle("B7")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('C82626');

$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->mergeCells('B1:F3');   
$objPHPExcel->getActiveSheet()->mergeCells('A1:A3');   

$objPHPExcel->getActiveSheet()->mergeCells('A5:B5');   
$objPHPExcel->getActiveSheet()->mergeCells("A6:A6");   
$objPHPExcel->getActiveSheet()->mergeCells("B6:B6");   
$objPHPExcel->getActiveSheet()->mergeCells("A7:A7");   
$objPHPExcel->getActiveSheet()->mergeCells("B7:B7");   

$styleArray = array(
    'font' => array(
        'bold' => true
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);

$styleArrayBorder = array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),  //BORDER_DASHED
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),
    )
);

$objPHPExcel->getActiveSheet()->getStyle('B1:F3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));
$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002060'))));
$objPHPExcel->getActiveSheet()->getStyle('A5:B5')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF'))));
$objPHPExcel->getActiveSheet()->getStyle('A6:B6')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF'))));
$objPHPExcel->getActiveSheet()->getStyle('A7:B7')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF'))));

$objPHPExcel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleArrayBorder);

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


//$objPHPExcel->getActiveSheet()->setSharedStyle($headerStyle, "A9:J9");


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

$objPHPExcel->getActiveSheet()->setSharedStyle($cellStyle, "A{$firstRow}:I{$lastRow}");
$objPHPExcel->getActiveSheet()->setAutoFilter("A9:F9");

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);


$objPHPExcel->getActiveSheet()
        ->setCellValue('A9', 'SENIOR')
        ->setCellValue('B9', 'ANALISTA')
        ->setCellValue('C9', 'META SEMANA')
        ->setCellValue('D9', 'CERRADOS/PRODUCTIVIDAD')
        ->setCellValue('E9', 'PENDIENTES')
        ->setCellValue('F9', 'META TOTAL');
        //->setCellValue('G9', 'FALTAN');

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

$objPHPExcel->getActiveSheet()->getStyle("A9:F9")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle("A9:F9")->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC') ) ) );
$objPHPExcel->getActiveSheet()->getStyle("A9:F9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$date1 = new \DateTime("");
$Date=$date1->format('Y-m-d');


$row = $firstRow;

$criteriaSen = new CDbCriteria;
$criteriaSen->addCondition('userSeniorId='.Yii::app()->user->id.' AND userSeniorId!=215');
$isSenior= User::model()->findAll($criteriaSen);
if ($isSenior) {
    $totalFinish=0;
    $totalSemana=0;
    $totalPendientes=0;
    $totalgoal=0;
    $qualitySeniorF =Yii::app()->user->arUser->getProcessSeniorExport($from, $until,Yii::app()->user->id);
    if($qualitySeniorF){
        foreach ($qualitySeniorF as $result){
            //if($resultSenior['id']==$result['userSeniorId']){
                if($result['goal']>0){
                    $metasemana=round($result['goal']/4); 
                    $pendientes=$result['goal']-$result['processFina'];
                }else{
                    $metasemana=0;
                    $pendientes=0;
                }

                $detailUserSen =  User::model()->findByPk($result['userSeniorId']);
                if($detailUserSen){
                    $senior=$detailUserSen->firstName.' '.$detailUserSen->lastName; 
                }

                $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArrayBorderCell);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArrayBorderCell);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArrayBorderCell);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArrayBorderCell);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArrayBorderCell);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArrayBorderCell);
                //$objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArrayBorderCell);


                $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //$objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $objPHPExcel->getActiveSheet()
                        ->setCellValue('A' . $row, $senior)
                        ->setCellValue('B' . $row, $result['Analista'])
                        ->setCellValue('C' . $row, $metasemana)
                        ->setCellValue('D' . $row, $result['processFina'])
                        ->setCellValue('E' . $row, $pendientes)
                        ->setCellValue('F' . $row, $result['goal']);
                        //->setCellValue('G' . $row, $pendientes);   
                $row++;
                $totalFinish = $totalFinish+$result['processFina'];
                $totalSemana = $totalSemana+$metasemana;
                $totalPendientes = $totalPendientes+$pendientes;
                $totalgoal = $totalgoal+$result['goal'];
        }

        $cumplimiento=round(($totalFinish*100/$totalgoal), 2);
        $objPHPExcel->getActiveSheet()->getStyle("B".$row.":H".$row)->applyFromArray($styleArrayBorderCell);
        $objPHPExcel->getActiveSheet()->getStyle("B".$row.":F".$row)->getFont()->setBold(true)->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("B".$row.":F".$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF') ) ) );
        $objPHPExcel->getActiveSheet()->getStyle("B".$row.":G".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle("G".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle("G".$row)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $objPHPExcel->getActiveSheet()->getStyle("G".$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC') ) ) );
        $objPHPExcel->getActiveSheet()->getStyle("H".$row)->getFont()->setBold(true)->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle("H".$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF') ) ) );

        $objPHPExcel->getActiveSheet()
            ->setCellValue('B' . $row, 'TOTAL')
            ->setCellValue('C' . $row, $totalSemana)
            ->setCellValue('D' . $row, $totalFinish)
            ->setCellValue('E' . $row, $totalPendientes)
            ->setCellValue('F' . $row, $totalgoal)
            ->setCellValue('G' . $row, 'CUMPLIMIENTO')
            ->setCellValue('H' . $row,  $cumplimiento.'%');
            //->setCellValue('I' . $row, $cumplimiento.'%');
        $row++;
    }
}else{
    $criteria = new CDbCriteria;
    $criteria->addCondition('userSeniorType=1');
    $modelSenior = User::model()->findAll($criteria);
    foreach ($modelSenior as $resultSenior){
        $totalFinish=0;
        $totalSemana=0;
        $totalPendientes=0;
        $totalgoal=0;
        $qualitySeniorF =Yii::app()->user->arUser->getProcessSeniorExport($from, $until,$resultSenior['id']);
        if($qualitySeniorF){
            foreach ($qualitySeniorF as $result){
                //if($resultSenior['id']==$result['userSeniorId']){
                    if($result['goal']>0){
                        $metasemana=round($result['goal']/4); 
                        $pendientes=$result['goal']-$result['processFina'];
                    }else{
                        $metasemana=0;
                        $pendientes=0;
                    }

                    $detailUserSen =  User::model()->findByPk($result['userSeniorId']);
                    if($detailUserSen){
                        $senior=$detailUserSen->firstName.' '.$detailUserSen->lastName; 
                    }

                    $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArrayBorderCell);
                    $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArrayBorderCell);
                    $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArrayBorderCell);
                    $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArrayBorderCell);
                    $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArrayBorderCell);
                    $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArrayBorderCell);
                    //$objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArrayBorderCell);


                    $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //$objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                    $objPHPExcel->getActiveSheet()
                            ->setCellValue('A' . $row, $senior)
                            ->setCellValue('B' . $row, $result['Analista'])
                            ->setCellValue('C' . $row, $metasemana)
                            ->setCellValue('D' . $row, $result['processFina'])
                            ->setCellValue('E' . $row, $pendientes)
                            ->setCellValue('F' . $row, $result['goal']);
                            //->setCellValue('G' . $row, $pendientes);   
                    $row++;
                    $totalFinish = $totalFinish+$result['processFina'];
                    $totalSemana = $totalSemana+$metasemana;
                    $totalPendientes = $totalPendientes+$pendientes;
                    $totalgoal = $totalgoal+$result['goal'];
            }

            $cumplimiento=round(($totalFinish*100/$totalgoal), 2);
            $objPHPExcel->getActiveSheet()->getStyle("B".$row.":H".$row)->applyFromArray($styleArrayBorderCell);
            $objPHPExcel->getActiveSheet()->getStyle("B".$row.":F".$row)->getFont()->setBold(true)->getColor()->setRGB('000000');
            $objPHPExcel->getActiveSheet()->getStyle("B".$row.":F".$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF') ) ) );
            $objPHPExcel->getActiveSheet()->getStyle("B".$row.":G".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle("G".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle("G".$row)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
            $objPHPExcel->getActiveSheet()->getStyle("G".$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC') ) ) );
            $objPHPExcel->getActiveSheet()->getStyle("H".$row)->getFont()->setBold(true)->getColor()->setRGB('000000');
            $objPHPExcel->getActiveSheet()->getStyle("H".$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF') ) ) );

            $objPHPExcel->getActiveSheet()
                ->setCellValue('B' . $row, 'TOTAL')
                ->setCellValue('C' . $row, $totalSemana)
                ->setCellValue('D' . $row, $totalFinish)
                ->setCellValue('E' . $row, $totalPendientes)
                ->setCellValue('F' . $row, $totalgoal)
                ->setCellValue('G' . $row, 'CUMPLIMIENTO')
                ->setCellValue('H' . $row,  $cumplimiento.'%');
                //->setCellValue('I' . $row, $cumplimiento.'%');
            $row++;
        }
    }
}

WebUser::logAccess("Indicadores de productividad Senior ".$row." filas.");

$objPHPExcel->getActiveSheet()->setTitle('Indicadores_Senior');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Indicadores Senior_'.date("Ymd_His").'".xlsx"');
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
