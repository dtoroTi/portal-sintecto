<?php

    // RESUMEN LAFT Y SOCIOS
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_prodeco/_pdfProdecoResumenLAFT.php');

    
    // VALIDACIÓN EN LISTAS RESTRICTIVAS
    include_once(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfValidacionListasRestrictivas.php');
    include(Yii::app()->basePath . '/views/backgroundCheck/pdfDetails/_pdfLAFT.php');

    /*
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');

    // CONCEPTO FINAL
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "CONCEPTO FINAL"  , 0, 'C', 1, 0, '', '', true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', '', 12);
    */
    // Always use the Result Ignore the comments
    if (true || trim($backgroundCheck->comments) == "") {
        if ($backgroundCheck->resultId == Result::FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que NO '
                    . 'presenta ningún aspecto que amerite emitir un concepto '
                    . 'negativo para su contratación, de acuerdo con las '
                    . 'actividades que puede desarrollar según su Objeto Social.';
            $resultString = "APTO";
        } elseif ($backgroundCheck->resultId == Result::NO_FAVORABLE) {
            $finalComments = 'Realizada la Evaluación de la Empresa '
                    . $backgroundCheck->companyName . ' Nit ' . $backgroundCheck->formatedIdNumber . ' '
                    . 'se puede concluir que Presenta '
                    . 'aspectos que ameritan emitir un concepto No Favorable '
                    . 'para su contratación, de acuerdo con las actividades '
                    . 'que puede desarrollar según su Objeto Social.';
            $resultString = "NO APTO";
        } else {
            $finalComments = ' ************    ESTE ESTUDIO NO TIENE RESULTADO AUN  *********** ';
            $resultString = "NO TIENE RESULTADO AUN";
        }
    } else {
        $finalComments = $backgroundCheck->comments;
    }

    // $pdf->MultiCell(171, '', $finalComments, 0, 'J', FALSE, TRUE);
    /*

    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->Cell('', '', '', '', 1, 'L');
    $pdf->SetX(80);


    if ($backgroundCheck->approved && $backgroundCheck->approved->signature) {
        $imageFile = $backgroundCheck->approved->signature->getImageFileSized(460, 120);
        $x = $pdf->getX();
        $y = $pdf->getY();
        $imageSize = getimagesize($imageFile);
        if ($imageSize[0] < 460) {
            $xdif = 0.5 + 460 / $imageSize[0] * 8;
        } else {
            $xdif = 0.5;
        }
        $pdf->Image($imageFile, $x + $xdif, $y - 17, -180);
        unlink($imageFile);
        $pdf->setXY($x, $y);
    }

    $pdf->Cell(66, '', ($backgroundCheck->approved ? $backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);
    */

    $evalResulCal= "---";
    // $resultString = $backgroundCheck->resultId == Result::FAVORABLE;
    $query = "UPDATE ses_BackgroundCheck SET evaluationResult='".$resultString."', evaluationValue='".$evalResulCal."' WHERE  id=".$backgroundCheck->id.";";
    Yii::app()->db->createCommand($query)->execute();