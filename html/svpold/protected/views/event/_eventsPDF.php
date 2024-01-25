<?php

$events = array();
foreach ($backgroundCheck->events as $event) {
    if ($event->informedToCustomer) {
        $events[] = $event;
    }
}

if ($backgroundCheck->customerProduct->isCompanySurvey == 1) {


    if (count($events)) {
        $pdf->Cell(0, '', "", 0, 1, 'L');
        $pdf->Cell(0, '', "", 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(0, 66, 109);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(170, '', 'HISTÓRICO DE TRAZABILIDAD DEL PROCESO', 1, 1, 'C', 1); 
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(170, '', 'El histórico presentado a continuación es de carácter informativo para el cliente', 0, 1, 'L', 1);

        $pdf->Cell(0, '', '', 0, 1, 'C', 1);

        $pdf->SetFillColor(220);
        foreach ($events as $event) {
            $pdf->Cell(36, '', 'Fecha / Hora', 1, 0, 'C', 1);
            $pdf->Cell(134, '', 'Comentario', 1, 1, 'C', 1);
            $pdf->Cell(36, '', CHtml::encode($event->informedToCustomerOn), 1, 0, 'L');
            $pdf->MultiCell(134, '', CHtml::encode($event->detail), 1, 'J', FALSE, TRUE);
            if ($event->customerAnsweredOn) {
                $pdf->Cell(36, '', CHtml::encode($event->customerAnsweredOn), 1, 0, 'L');
                $pdf->Cell(30, '', 'Comentario de Cliente', 1, 0, 'L',1);
                $pdf->MultiCell(104, '', CHtml::encode($event->customerComment), 1, 'J', FALSE, TRUE);
            }
        }
        $pdf->SetFillColor(255);
    }

}else{

    if (count($events)) {
        $pdf->Cell(0, '', "", 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220);
        $pdf->Cell(196, '', 'HISTÓRICO DE TRAZABILIDAD DEL PROCESO', 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(196, '', 'El histórico presentado a continuación es de carácter informativo para el cliente', 0, 1, 'L', 1);

        $pdf->Cell(0, '', '', 0, 1, 'C', 1);

        $pdf->SetFillColor(220);
        foreach ($events as $event) {
            $pdf->Cell(36, '', CHtml::encode($event->informedToCustomerOn), 1, 0, 'L');
            $pdf->MultiCell(160, '', CHtml::encode($event->detail), 1, 'J', FALSE, TRUE);
            if ($event->customerAnsweredOn) {
                $pdf->Cell(36, '', CHtml::encode($event->customerAnsweredOn), 1, 0, 'L');
                $pdf->Cell(30, '', 'Comentario de Cliente', 1, 0, 'L',1);
                $pdf->MultiCell(130, '', CHtml::encode($event->customerComment), 1, 'J', FALSE, TRUE);
            }
        }
        $pdf->SetFillColor(255);
    }

}
