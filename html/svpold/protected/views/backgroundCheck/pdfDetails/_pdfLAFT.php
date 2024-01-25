<?php
if ($backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER)->percentCompleted >=100 ) {
    $pdf->AddPage(); $pdf->SetY(30);
    $pdf->SetFillColor(0,66,109);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(170, 0, "VERIFICACIÓN LISTAS - ANTECEDENTES-LAFT " , 0, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, "SOCIOS Y REPRESENTANTES LEGALES " , 0, 'C', 1, 1, '', '', true);
    $pdf->Cell('', '', '', '', 1, 'L');
    $i = 0;
    foreach ($shareholdersSection->detailShareholder as $shareholder) {
        if($shareholder->isCompany == 0){
            $isCompany = "P. Natural";
        } else{
            $isCompany = "P. Jurídica";
        };
        if($pdf->GetY()>= 220){
            $pdf->AddPage(); $pdf->SetY(30);
        }
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(230); $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(45, 0, "Nombre y Apellido" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, "No. Identidad"  , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, "Clasificación " , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, "Participación" , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(50, 0, "Cargo" , 1, 'L', 1, 1, '', '', true);

        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(45, 0, $shareholder->firstName . " " . $shareholder->lastName  , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, $shareholder->idNumber , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, $isCompany , 1, 'L', 1, 0, '', '', true);
        $pdf->MultiCell(25, 0, $shareholder->participation . "%" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(50, 0, $shareholder->position , 1, 'L', 1, 1, '', '', true);

        $pdf->SetFont('Arial', '', 4);
        $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(15.454, 0, "Clinton" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "Adversos" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "Recursos P."  , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "F. Públicas" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "R. Públicos" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "B. Prácticas"  , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "E. Control" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "E. Policiales" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "O. Boletines"  , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "E. Ficticias" , 1, 'C', 1, 0, '', '', true);
        $pdf->MultiCell(15.454, 0, "BDM" , 1, 'C', 1, 1, '', '', true);
        $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);

        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 10);
        if ($shareholder->appearsInClintonsList == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->appearsInClintonsList == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        
        $pdf->SetFillColor(255); $pdf->SetFont('Arial', '', 10);
        if ($shareholder->hasAdverseReference == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->hasAdverseReference == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->managepublicresources == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->managepublicresources == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->prominentpublicfunctions == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->prominentpublicfunctions == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->OfacYOnu == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->OfacYOnu == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->Boe == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->Boe == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->entControl == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->entControl == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->entPoliciales == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->entPoliciales == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->otrosBoletines == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->otrosBoletines == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        if ($shareholder->empresasFicticias == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->empresasFicticias == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 0, '', '', true);
        
        if ($shareholder->bDeudoresMorosos == 1 ) {
            $pdf->SetTextColor(255,0,0); $ans= "SI";
        } else if ($shareholder->bDeudoresMorosos == 2 ){
            $pdf->SetTextColor(0); $ans = "N/A";
        }else{
            $pdf->SetTextColor(0,152,0); $ans = "NO";
        };
        $pdf->MultiCell(15.454, 0, $ans , 1, 'C', 1, 1, '', '', true);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetTextColor(0);
        if ($shareholder->comments != "" ) {
            $pdf->MultiCell(170, 0, $shareholder->comments , 1, 'L', 1, 1, '', '', true);
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

    // COMENTARIOS
    $ansComments = $backgroundCheck->getVerificationSection(VerificationSectionType::DETAIL_SHAREHOLDER)->comments;
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(50,50,50); $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(170, 0, "Comentarios" , 1, 'L', 1, 1, '', '', true);
    $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(170, 0, $ansComments , 1, 'L', 1, 1, '', '', true);

    // LEYENDA
    $pdf->AddPage();
    $pdf->SetY(30);
    $pdf->Cell('', '', '', '', 1, 'L');

    $pdf->SetFont('Arial', 'B', 12); $pdf->SetTextColor(0);
    $pdf->MultiCell(170, 0, "Listas Consultadas a Socios y Representantes Legales" , 0, 'L', 1, 1, '', '', true);
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(170, 0, " - Clinton: Lista Clinton." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - Adversos: Adversos adicionales" , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - Recursos. P.: Maneja o administra Recursos Públicos." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - F. Públicas: En los últimos dos años ha desempeñado funciones públicas destacadas." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - R. Públicos.: Reconocimiento público (Clinton, ONU y Reino Unido)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - B. Prácticas: Reconocimiento normativo de Buenas prácticas (BOE)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - E. Control: Boletines de Entidades de Control (Fiscalía, Procuraduría, Contraloría)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - E. Policiales: Boletines de Entidades Policiales (Policía, DEA, Interpol, FBI, Unión Europea)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - O. Boletines: Otros boletines (Presidencia, SuperFinanciera, Embajadas, Fuerzas Militares, BDM)." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - E. Ficticias: Empresas ficticias." , 0, 'L', 1, 1, '', '', true);
    $pdf->MultiCell(170, 0, " - BDM: Boletín de Deudores Morosos." , 0, 'L', 1, 1, '', '', true);
}