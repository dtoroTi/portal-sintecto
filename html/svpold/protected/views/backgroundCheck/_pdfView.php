<?php

// Instanciation of inherited class
//if (!$backgroundCheck->approvedBy) {
//  $pdf->waterMark = 'Borrador';
//}
/* @var $backgroundCheck BackgroundCheck */

if (!empty($backgroundCheck->customerProduct->pdfReportType)) {
    $pdf= $backgroundCheck->customerProduct->pdfReportType->getPdfReport($backgroundCheck);
    $backgroundCheck->deletePendingToDelete();
}else if (empty($backgroundCheck->customerProduct->reportFormat)) {
    if ($backgroundCheck->isCompanySurvey) {
        $pdf = new SVPPDFCompany($backgroundCheck,$this);
        $this->renderPartial('_pdfViewCompany', array(
            'backgroundCheck' => $backgroundCheck,
            'pdf' => $pdf,)
        );
    } else {
        $pdf = new SVPPDFPerson($backgroundCheck,$this);
        $this->renderPartial('_pdfViewPerson', array(
            'backgroundCheck' => $backgroundCheck,
            'pdf' => $pdf,)
        );
    }
} else {
    $pdf= new SVPPDFDynamic($backgroundCheck,$this);
        $this->renderPartial('_pdfDynamic', array(
            'backgroundCheck' => $backgroundCheck,
            'pdf' => $pdf,)
        );
}

if ($filename != '') {
    $pdf->Output($filename, 'F');
} else {
    //$pdf->SetProtection(array('print'));
    //$pdf->SetProtection(array('print', 'modify', 'copy', 'annot-forms'));
    //$pdf->SetProtection(array('modify'));
    echo $pdf->Output('', 'S');
}