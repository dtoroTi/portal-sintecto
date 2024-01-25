<?php

if ($backgroundCheck->customerProduct->pdfCertificateType) {
    $pdf = $backgroundCheck->customerProduct->pdfCertificateType->getPdfReport($backgroundCheck);
    $backgroundCheck->deletePendingToDelete();
    if ($filename != '') {
        $pdf->Output($filename, 'F');
    } else {
        //$pdf->SetProtection(array('print'));
        echo $pdf->Output('', 'S');
    }
} else {
    if (!$backgroundCheck->isCompanySurvey) {
        $pdf = $this->renderPartial('_pdfViewCertificatePerson', array(
            'backgroundCheck' => $backgroundCheck,
            'filename' => $filename,
                )
                , ($filename != '' ? FALSE : TRUE)
        );
        if ($filename != '') {
           // $pdf->Output($filename, 'F');
        } else {
            //$pdf->SetProtection(array('print'));
            echo $pdf;
        }
    } else {
        $pdf = new SVPPDF($backgroundCheck, null);
        if ($filename != '') {
            $pdf->Output($filename, 'F');
        } else {
            //$pdf->SetProtection(array('print'));
            echo $pdf->Output('', 'S');
        }
    }
}

