<?php

Yii::import('application.extensions.PHPExcel.*');

//ksort($qualityPorc);
$firstRow = 13;
$lastDataRow = 1;
$lastRow = $lastDataRow;

/** Error reporting */
error_reporting(E_ALL);
date_default_timezone_set('America/Bogota');

$date1 = new \DateTime($invoiceVisit->invoiceDate);
$DateFac=$date1->format('d-m-Y');

$date2 = new \DateTime();
$dateAct=$date2->format('d/m/Y H:i:s');

$nomVisitador=$invoiceVisit->user->firstName.' '.$invoiceVisit->user->lastName;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(45);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(40);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(35);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(25);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(25);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(25);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(25);


$gdImage = imagecreatefromjpeg('../svpold/mantenimiento/images/fondo_blanco.jpg');

$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Sample image');
$objDrawing->setDescription('Sample image');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(80);
$objDrawing->setCoordinates('A1');
$objDrawing->setOffsetX(60);                    
$objDrawing->setOffsetY(20);  
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$objPHPExcel->setActiveSheetIndex(0)

        //->setCellValue('A1', $gdImage)
        ->setCellValue('C1', Yii::app()->user->name.' ['.$dateAct.']')
        ->setCellValue('C2', 'FORMATO RELACIÓN DE PUBLICACIONES REALIZADAS '.$DateFac)
        ->setCellValue('A8', 'FECHA DE RELACIÓN')
        ->setCellValue('C8', 'NOMBRE')
        ->setCellValue('D8', $nomVisitador)
        ->setCellValue('A9', 'DESDE')
        ->setCellValue('B9', 'HASTA')
        ->setCellValue('C9', 'CIUDAD DE RESIDENCIA')
        ->setCellValue('D9', $invoiceVisit->user->city)
        ->setCellValue('A10', $invoiceVisit->from)
        ->setCellValue('B10', $invoiceVisit->until);

$style_cell = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ) 
    ); 

//$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(10);    
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setSize(16)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("C2")->getFont()->setSize(16)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("A8")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("A9")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("B9")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("A10")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('C82626');
$objPHPExcel->getActiveSheet()->getStyle("B10")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('C82626');
$objPHPExcel->getActiveSheet()->getStyle("C8")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');
$objPHPExcel->getActiveSheet()->getStyle("C9")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('000000');

$objPHPExcel->getActiveSheet()->getStyle("D8")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('002060');
$objPHPExcel->getActiveSheet()->getStyle("D9")->getFont()->setSize(12)->setBold(true)->getColor()->setRGB('002060');

$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->mergeCells('C1:P1'); 
$objPHPExcel->getActiveSheet()->mergeCells('C2:P6');   
$objPHPExcel->getActiveSheet()->mergeCells('A1:B6');   

$objPHPExcel->getActiveSheet()->mergeCells('A8:B8');   
$objPHPExcel->getActiveSheet()->mergeCells('C8:C8');   
$objPHPExcel->getActiveSheet()->mergeCells("D8:P8");     
$objPHPExcel->getActiveSheet()->mergeCells("A9:A9");   
$objPHPExcel->getActiveSheet()->mergeCells("B9:B9");   
$objPHPExcel->getActiveSheet()->mergeCells("C9:C10");  
$objPHPExcel->getActiveSheet()->mergeCells("D9:P10");  
$objPHPExcel->getActiveSheet()->mergeCells("A10:A10");   
$objPHPExcel->getActiveSheet()->mergeCells("B10:B10");   


$styleArray = array(
    'font' => array(
        'bold' => true
    ),
);

$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($styleArray);

$styleArrayBorder = array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),  //BORDER_DASHED
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_DASHED),
    )
);

$objPHPExcel->getActiveSheet()->getStyle('C1:P1')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC'))));
$objPHPExcel->getActiveSheet()->getStyle('C2:P6')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC'))));
$objPHPExcel->getActiveSheet()->getStyle('A1:B6')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC')))); //002060
$objPHPExcel->getActiveSheet()->getStyle('A8:P8')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF'))));
$objPHPExcel->getActiveSheet()->getStyle('A9:P9')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF'))));
$objPHPExcel->getActiveSheet()->getStyle('A10:B10')->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF'))));


$objPHPExcel->getActiveSheet()->getStyle('A8:B8')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('C8')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('D8:P8')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('A9')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B9')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('C9:C10')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('D9:P10')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('A10')->applyFromArray($styleArrayBorder);
$objPHPExcel->getActiveSheet()->getStyle('B10')->applyFromArray($styleArrayBorder);


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
$objPHPExcel->getActiveSheet()->setAutoFilter("A12:P12");

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);


$objPHPExcel->getActiveSheet()
        ->setCellValue('A12', 'ITEM')
        ->setCellValue('B12', 'FECHA DE LA VISITA')
        ->setCellValue('C12', 'REFERENCIA')
        ->setCellValue('D12', 'IDENTIFICACIÓN DEL EVALUADO')
        ->setCellValue('E12', 'NOMBRE')
        ->setCellValue('F12', 'CLIENTE')
        ->setCellValue('G12', 'CIUDAD VISITA')
        ->setCellValue('H12', 'COSTO VISITA')
        ->setCellValue('I12', 'COSTO ADICIONAL VISITA')
        ->setCellValue('j12', 'COSTO TRANSPORTE')
        ->setCellValue('K12', 'COSTO ALIMENTACIÓN')
        ->setCellValue('L12', 'COSTO PAPELERIA')
        ->setCellValue('M12', 'APROBADO')
        ->setCellValue('N12', 'VIÁTICO APROBADO POR')
        ->setCellValue('O12', 'VIÁTICO APROBADO EN')
        ->setCellValue('P12', 'VALOR TOTAL');
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

$objPHPExcel->getActiveSheet()->getStyle("A12:P12")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
$objPHPExcel->getActiveSheet()->getStyle("A12:P12")->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0277BC') ) ) );
$objPHPExcel->getActiveSheet()->getStyle("A12:P12")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$date1 = new \DateTime("");
$Date=$date1->format('Y-m-d');

$i=1;
$row = $firstRow;
$totalPago=0;
$totalCostoVsit=0;
$totalAddVisita=0;
$totaltransporte=0;
$totalAlimento=0;
$totalpapeleria=0;
foreach ($exportInvoicePreFac as $result){
    
    $assignedUser=AssignedUser::model()->findByAttributes(['verificationSectionId'=>$result['idverifisection']]);
    
    if($assignedUser){
        $finishOn=$assignedUser->finishedAt;
    }else{
        $finishOn='';
    }

    if($result['idSection']==5){
        $detailHousing =  DetailHousing::model()->findByAttributes(['verificationSectionId'=>$result['idverifisection']]);
        $visitaOn=$detailHousing->visitedOn; 
    }else if($result['idSection']==17){
        $detailCompanyVisit =  DetailCompanyVisit::model()->findByAttributes(['verificationSectionId'=>$result['idverifisection']]);
        $visitaOn=$detailCompanyVisit->verifiedOn; 
    }else{
        $otherSectionXml =  XmlSection::model()->findByAttributes(['verificationSectionId'=>$result['idverifisection']]);
        $xmlanswer=$otherSectionXml->answer; 

        $XMLQuestionResult = array();
        $resultxml =  unserialize($otherSectionXml->answer) ;
        $XMLQuestionResult = array_merge($XMLQuestionResult, $resultxml);   
        if(isset($XMLQuestionResult['verifiedOn'])){
            $visitaOn=$XMLQuestionResult['verifiedOn'];
        }else{
            $visitaOn='';
        }
    }

    $totalvisita=$result['totalValueCostVisit']+$result['totalValueAddVisit']+$result['totalValueTransportation']+$result['totalValueFeeding']+$result['totalValueStationery'];

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
    $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle('P' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


    $objPHPExcel->getActiveSheet()->getStyle('H'. $row)->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle('I'. $row)->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle('J'. $row)->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle('K'. $row)->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle('L'. $row)->applyFromArray($styleArray);
    $objPHPExcel->getActiveSheet()->getStyle('P'. $row)->applyFromArray($styleArray);

    $objPHPExcel->getActiveSheet()
            ->setCellValue('A' . $row, $i)
            ->setCellValue('B' . $row, $finishOn)
            ->setCellValue('C' . $row, $result['code'])
            ->setCellValue('D' . $row, $result['idNumber'])
            ->setCellValue('E' . $row, $result['nombreCandidato'])
            ->setCellValue('F' . $row, $result['name'])
            ->setCellValue('G' . $row, $result['city'])
            ->setCellValue('H' . $row, $result['totalValueCostVisit'])
            ->setCellValue('I' . $row, $result['totalValueAddVisit'])
            ->setCellValue('J' . $row, $result['totalValueTransportation'])
            ->setCellValue('K' . $row, $result['totalValueFeeding'])
            ->setCellValue('L' . $row, $result['totalValueStationery'])
            ->setCellValue('M' . $row, $result['aprobado'])
            ->setCellValue('N' . $row, $result['aprobadoPor'])
            ->setCellValue('O' . $row, $result['DateApprovedOP'])
            ->setCellValue('P' . $row, $totalvisita);    
            
    $totalCostoVsit=$totalCostoVsit+$result['totalValueCostVisit'];
    $totalAddVisita=$totalAddVisita+$result['totalValueAddVisit'];
    $totaltransporte=$totaltransporte+$result['totalValueTransportation'];
    $totalAlimento=$totalAlimento+$result['totalValueFeeding'];
    $totalpapeleria=$totalpapeleria+$result['totalValueStationery'];
    $totalPago=$totalPago+$totalvisita;
    $i=$i+1;
    $row++;
}

$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':G' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('H' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('I' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('J' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('K' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('L' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('M' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('N' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('O' . $row)->applyFromArray($styleArrayBorderCell);
$objPHPExcel->getActiveSheet()->getStyle('P' . $row)->applyFromArray($styleArrayBorderCell);


$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('P' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':G' .$row)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('H'. $row)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('I'. $row)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('J'. $row)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('K'. $row)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('L'. $row)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('P'. $row)->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':G' .$row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF') ) ) );
$objPHPExcel->getActiveSheet()->getStyle('H'. $row.':P'. $row)->applyFromArray( array( 'fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CFCFCF') ) ) );

$objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $row, '')
        ->setCellValue('B' . $row, '')
        ->setCellValue('C' . $row, '')
        ->setCellValue('D' . $row, '')
        ->setCellValue('E' . $row, '')
        ->setCellValue('F' . $row, '')
        ->setCellValue('G' . $row, 'TOTAL')
        ->setCellValue('H' . $row, $totalCostoVsit)
        ->setCellValue('I' . $row, $totalAddVisita)
        ->setCellValue('J' . $row, $totaltransporte)
        ->setCellValue('K' . $row, $totalAlimento)
        ->setCellValue('L' . $row, $totalpapeleria)
        ->setCellValue('M' . $row, '')
        ->setCellValue('N' . $row, '')
        ->setCellValue('O' . $row, '')
        ->setCellValue('P' . $row, $totalPago);    

WebUser::logAccess("Relación Cuenta de Cobro ".$row." filas.");

$objPHPExcel->getActiveSheet()->setTitle('Relcn_Cuent_Cobro_'.$DateFac);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Relación cuenta de cobro"'.$nomVisitador.'_'.date("Ymd_His").'".xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);

    
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
//END

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
//echo path('public');
$objWriter->save('php://output');
exit;
