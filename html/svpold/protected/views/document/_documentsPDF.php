<?php

//$pdf->Cell(170, '', '', 0, 1, 'C' );
$previewsType = NULL;
$pdf->SetFont('Arial', 'B', 10);
$numberOfImageInRow = 0;
$headerHeight = 25;
$pageMaxWidth = SVPPDF::imageMaxWidth();
foreach ($documents as $file) {
  try {
    if ($file->isImage && $file->imageSizeId && $file->imageSizeId != ImageSize::FRONT_PAGE) {
      if ($previewsType != $file->imageSizeId) {
        $pageMaxWidth = SVPPDF::imageMaxWidth($file->imageSize->landscape);
        $orientation = $file->imageSize->landscape == 1 ? 'L' : 'P';
        $pdf->addPage($orientation);
        $pdf->Cell(0, '', "", 0, 1, 'L');
//      $pdf->SetFont('Arial', 'B', 10);
//      $pdf->SetFillColor(153, 204, 255);
//      $pdf->Cell(0, '', "ANEXOS {$pageMaxWidth}", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(40);
        $pdf->SetY($headerHeight);
      }
      $previewsType = $file->imageSizeId;
      $imageFile = $file->temporalSizedImage;
      $imageSize = getimagesize($imageFile);
      $x = $pdf->getX();
      $y = $pdf->getY();
      if ($file->imageSize->imagesPerRow == 1) {
        if ($imageSize[0] < $file->imageSize->maxWidth) {
//center the image
          $x = $pdf->getX() + round(($pageMaxWidth - $imageSize[0]) / 2 * 170 / $pageMaxWidth);
        } else {
          $x = $pdf->getX();
        }
        if ($y > 200) {
          $pdf->addPage($orientation);
          $y = $headerHeight;
        }
        $pdf->Image($imageFile, $x, $y);
        $y = $y + ($file->imageSize->maxHeight + 30 ) * 170 / $pageMaxWidth;
        $numberOfImageInRow = 0;
      } else if ($file->imageSize->imagesPerRow > 1) {
        $x = $numberOfImageInRow * ($file->imageSize->maxWidth + ($file->imageSize->maxWidth - $imageSize[0]) / 2 + 100) * 260 / $pageMaxWidth + 22;
        if ($y > 120) {
          $pdf->addPage($orientation);
          $y = $headerHeight;
        }
        $pdf->Image($imageFile, $x, $y);
        $numberOfImageInRow++;
        if ($numberOfImageInRow >= $file->imageSize->imagesPerRow) {
          $numberOfImageInRow = 0;
          // new row
          $x = 0;
          $y = $y + ($file->imageSize->maxHeight + 30 ) * 170 / $pageMaxWidth;
        }
      }
      $pdf->SetX($x);
      $pdf->SetY($y);
      unlink($imageFile);
      //    $pdf->Cell(170, '', $file->description.":".$x, 0, 1, 'C');
      //    $pdf->Cell(170, '', '', 0, 1, 'C');
    } else if ($file->isPDF) {

      $pdfFile = $file->temporalRawFile;
      if (file_exists($pdfFile)) {
        $pagecount = $pdf->setSourceFile($pdfFile);
        for ($i = 1; $i <= $pagecount; $i++) {
          $tplidx = $pdf->importPage($i, '/MediaBox');
          $pdf->addPage();
          $pdf->useTemplate($tplidx, 10, $headerHeight, 170, 245);
        }
        unlink($pdfFile);
      }
      $pdf->SetX(40);
      $pdf->SetY(210);

      // 24-05-2017
      // TODO: ARREGLO TEMPORAL PARA LA ARMADA
      // GRUPO DE CLIENTE 239
      // CAMBIAR PARA QUE NO SE HAGA SOLO PARA ESTE CLIENTE
      if(isset($file->pdfText) && $backgroundCheck->customer->customerGroupId == 239){
        $pdf->SetFillColor(46, 117, 181);
        $pdf->SetDrawColor(46, 117, 181);
        $pdf->SetTextColor(255);
        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(170, '', "Texto del documento PDF", 1, 1, 'C', 1);
        $pdf->SetFont('', '', 10);
        $pdf->SetTextColor(0);
        $pdf->Multicell(170, '', $file->pdfText, 0, 'L');
        $pdf->Cell(170, '', '', 0, 1, 'C');  
      }
      
    }
  } catch (Exception $e) {
    Yii::log("The file [{$file->name}] of Study code {$backgroundCheck->code} has a problem. {$e->getMessage()}", "error", "ZWF." . __CLASS__);
  }
}
$pdf->SetFont('Arial', '', 10);