<?php
    
    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "SOCIOS DE LA EMPRESA"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetTextColor(0);
    $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(45, 0, "Nombre y Apellido"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(25, 0, "No. Identidad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(25, 0, "Clasificación " , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(25, 0, "Participación" , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Cargo" , 1, 'L', 1, 1, '', '', true);

    $i = 0;
    foreach ($shareholdersSection->detailShareholder as $shareholder) {
        if($shareholder->isCompany == 0){
            $isCompany = "P. Natural";
        } else{
            $isCompany = "P. Jurídica";
        };
        if( $shareholder->participation > 0){
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
            $pdf->MultiCell(45, 0, $shareholder->firstName . " " . $shareholder->lastName  , 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(25, 0, $shareholder->idNumber , 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(25, 0, $isCompany , 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(25, 0, $shareholder->participation . "%" , 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(50, 0, $shareholder->position , 1, 'L', 1, 1, '', '', true);
            if($i == 6){
                $pdf->AddPage();
                $pdf->SetY(30);
                $i=0;
            } else{
                $i++;
            }
        }
    }
    
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255);
    $pdf->MultiCell(170, 0, "REPRESENTANTES DE LA EMPRESA"  , 0, 'C', 1, 1, '', '', true);
    $pdf->SetTextColor(0);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetTextColor(0);
    $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(45, 0, "Nombre y Apellido"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(25, 0, "No. Identidad"  , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(25, 0, "Clasificación " , 1, 'L', 1, 0, '', '', true);
    $pdf->MultiCell(75, 0, "Cargo" , 1, 'L', 1, 1, '', '', true);

    $i = 0;
    foreach ($shareholdersSection->detailShareholder as $shareholder) {
        if($shareholder->isCompany == 0){
            $isCompany = "P. Natural";
        } else{
            $isCompany = "P. Jurídica";
        };
        if( $shareholder->participation <= 0){
            $pdf->SetTextColor(0);
            $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
            $pdf->MultiCell(45, 0, $shareholder->firstName . " " . $shareholder->lastName  , 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(25, 0, $shareholder->idNumber , 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(25, 0, $isCompany , 1, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(75, 0, $shareholder->position , 1, 'L', 1, 1, '', '', true);
            if($i == 6){
                $pdf->AddPage();
                $pdf->SetY(30);
                $i=0;
            } else{
                $i++;
            }
        }
    }