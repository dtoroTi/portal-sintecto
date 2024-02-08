<?php
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {

    // LEYENDA
    $pdf->AddPage();
    //$pdf->SetY(30);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 12); $pdf->SetTextColor(0);
    $pdf->MultiCell(175, 0, "Convención a Socios y Representantes Legales" , 0, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(175, 0, " - Clinton: Lista Clinton." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - Adversos: Adversos adicionales" , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - Recursos. P.: Maneja o administra Recursos Públicos." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - F. Públicas: En los últimos dos años ha desempeñado funciones públicas destacadas." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - R. Públicos.: Reconocimiento público (Clinton, ONU y Reino Unido)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - B. Prácticas: Reconocimiento normativo de Buenas prácticas (BOE)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - E. Control: Boletines de Entidades de Control (Fiscalía, Procuraduría, Contraloría)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - E. Policiales: Boletines de Entidades Policiales (Policía, DEA, Interpol, FBI, Unión Europea)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - O. Boletines: Otros boletines (Presidencia, SuperFinanciera, Embajadas, Fuerzas Militares, BDM)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - E. Ficticias: Empresas ficticias." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, " - BDM: Boletín de Deudores Morosos." , 0, 'L', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    //$pdf->AddPage();

   // $pdf->SetY(30);
    $pdf->SetFillColor(0, 66, 109);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(175, 0, "VALIDACIÓN LISTAS RESTRICTIVAS-", 0, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(175, 0, "SOCIOS Y REPRESENTANTES LEGALES", 0, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $i = 0;

    foreach ($verificationSection->detailShareholder as $person) {
        if($person->isCompany == 0){
            $isCompany = "P. Natural";
        } else{
            $isCompany = "P. Jurídica";
        };
       /* if($pdf->GetY()>= 220){
            $pdf->AddPage(); $pdf->SetY(30);
        }*/
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(46, 8, "Nombre y Apellido" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(17, 8, "Tipo. Doc" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(21, 8, "No. Identidad"  , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(21, 8, "Clasificación " , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(21, 8, "Participación" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(49, 8, "Cargo" , 1, 'L', 1, 1, '', '', true);

        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        //$pdf->MultiCell(45, 0, $person->firstName . " " . $person->lastName  , 1, 'L', 1, 0, '', '', true);
        $pdf->Cell(46, '', $person->firstName . " " . $person->lastName , 1, 0, 'L', 1);

        if ($person->typeDoc == 'CC') {
            $pdf->SetTextColor(0); $typeDoc = "Cedula";
        }else if ($person->typeDoc == 'NIT') {
            $pdf->SetTextColor(0); $typeDoc = "Nit";
        }else if ($person->typeDoc == 'TI') {
            $pdf->SetTextColor(0); $typeDoc = "Tarjeta Identidad";
        }else if ($person->typeDoc == 'RC') {
            $pdf->SetTextColor(0); $typeDoc = "Registro Civil";
        }else {
            $pdf->SetTextColor(0); $typeDoc = "--";
        };
        $pdf->MultiCell(17, 8, $typeDoc , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(21, 8, $person->idNumber , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(21, 8, $isCompany , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(21, 8, $person->participation . "%" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(49, 8, $person->position , 1, 'L', 1, 1, '', '', true);

        $pdf->SetFont('Arial', '', 4);
        $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(15.9, 0, "Clinton" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "Adversos" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "Recursos P."  , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "F. Públicas" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "R. Públicos" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "B. Prácticas"  , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "E. Control" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "E. Policiales" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "O. Boletines"  , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.9, 0, "E. Ficticias" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(16.1, 0, "BDM" , 1, 'C', 1, 1, '', '', true);
        $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);

        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 10);
        if ($person->appearsInClintonsList == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->appearsInClintonsList == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);

        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 10);
        if ($person->hasAdverseReference == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->hasAdverseReference == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->managepublicresources == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->managepublicresources == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->prominentpublicfunctions == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->prominentpublicfunctions == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->OfacYOnu == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->OfacYOnu == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->Boe == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->Boe == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->entControl == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->entControl == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->entPoliciales == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->entPoliciales == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->otrosBoletines == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->otrosBoletines == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($person->empresasFicticias == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->empresasFicticias == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.9, 0, $ans , 1, 'C', 1, 0, '', '', true);

        if ($person->bDeudoresMorosos == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($person->bDeudoresMorosos == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(16.1, 0, $ans , 1, 'C', 1, 1, '', '', true);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(0);
        if ($person->comments != "" ) {
            $pdf->MultiCell(175.1, 0, $person->comments , 1, 'L', 1, 1, '', '', true);
        }

        $pdf->Cell('', '', '', '', 1, 'L');
        /*if($i == 3){
            $pdf->AddPage();
            $pdf->SetY(30);
            $i=0;
        } else{
            $i++;
        }*/


    }
}
