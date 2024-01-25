<?php

if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
$pdf->SetFillColor(220);

$pdf->AddPage();
$pdf->SetY(25);    
$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 12);
if($verificationSection->verificationSectionType->fieldId=="detailReferences"){
  $pdf->MultiCell(175, 5, "REFERENCIAS" , 0, 'C', 1, 1, '', '', true);
}else if($verificationSection->verificationSectionType->fieldId=="detailFamilyMembers"){
$pdf->MultiCell(175, 5, "FAMILIA" , 0, 'C', 1, 1, '', '', true);
}else{
  $pdf->MultiCell(175, 5, "PERSONAS EN LA VIVIENDA" , 0, 'C', 1, 1, '', '', true);
}
$pdf->SetFillColor(220);$pdf->SetTextColor(0);

$pdf->SetFont('Arial', '', 10);

$pdf->Cell(35, '', 'Número de Personas', 1, 0, 'L', 1);
$pdf->Cell(20, '', count($verificationSection->detailPersons), 1, 1, 'C');

$verificationSectionType = VerificationSectionType::model()->findByPk($verificationSection->verificationSectionTypeId);
$showExtras = $verificationSectionType->hasPersonalExtras == 0 || $verificationSectionType->hasPersonalExtras == NULL ? false : true;
foreach ($verificationSection->detailPersons as $person) {
  if (!$person->isAReference) {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(25, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(23, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(56, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Edad', 1, 0, 'L', 1);
    $pdf->Cell(26, '', CHtml::encode($person->age), 1, 1, 'L');
    $pdf->Cell(25, '', 'Estado Civil', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->relationshipStatus->name), 1, 0, 'L');

    $pdf->Cell(23, '', 'Profesión', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->profession), 1, 0, 'L');
    $pdf->Cell(21, '', 'Trabaja en', 1, 0, 'L', 1);
    $pdf->Cell(36, '', CHtml::encode($person->workingAt), 1, 1, 'L');
    $pdf->Cell(25, '', 'Ocupación', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->functions), 1, 0, 'L');

    $pdf->Cell(30, '', 'Nivel de Educación', 1, 0, 'L', 1);
    $pdf->Cell(49, '', CHtml::encode($person->educationType ? $person->educationType->name : ""), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(26, '', CHtml::encode($person->tel), 1, 1, 'L');

      if ($verificationSection->verificationSectionTypeId==6){

      }else{
          $pdf->Cell(175, '', 'Comunicación', 1, 1, 'L', 1);
          $pdf->MultiCell(175, '', CHtml::encode($person->familyCommunication), 1, 'L', 0, 1);
          // $pdf->Cell(63, '', CHtml::encode($person->familyCommunication), 1, 0, 'L');
          $pdf->Cell(175, '', 'Actividades que comparten', 1, 1, 'L', 1);
          // $pdf->Cell(63, '', CHtml::encode($person->familyActivities), 1, 1, 'L');
          $pdf->MultiCell(175, '', CHtml::encode($person->familyActivities), 1, 'L', 0, 1);

      }
  } else {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(25, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(45, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($person->tel), 1, 1, 'L');

    $pdf->Cell(25, '', 'Lo conoce hace', 1, 0, 'L', 1);
    $pdf->Cell(45, '', CHtml::encode($person->howLongKnowEachOther), 1, 0, 'L');
    $pdf->Cell(30, '', 'Lo recomendaría', 1, 0, 'L', 1);
    $pdf->Cell(75, '', CHtml::encode($person->wouldYouRecomendTheCandidate), 1, 1, 'L');
    $pdf->Cell(25, '', 'Resultado', 1, 0, 'L', 1);
    $pdf->Cell(45, '', CHtml::encode($person->verificationResult->name), 1, 0, 'L');
    $pdf->Cell(30, '', 'Verificado En', 1, 0, 'L', 1);
    $pdf->Cell(75, '', CHtml::encode($person->verifiedOn), 1, 1, 'L');
  }

  if (trim($person->comments) != "") {
    $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
    $pdf->MultiCell(150, '', CHtml::encode($person->comments), 1, 'J', FALSE, TRUE);
  }


  $pdf->Cell(0, '', '', 0, 1, 'L');
}

if ($showExtras ) {
  $extra = DetailPersonExtras::model()->findByAttributes(array('verificationSectionId'=>$verificationSection->id));

  if (isset($extra)&&$extra!=NULL) {

    if($verificationSectionType->id == 6)
    {
        $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->Cell(175, '', 'Dinámica familiar', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);

        $pdf->SetFillColor(220);
        $pdf->Cell(77, '', 'Pautas de crianza', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->parentingGuidelines), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Manejo de autoridad', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->authorityManagement), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Toma de decisiones', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->decisionMaking), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Comunicación', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->comunication), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Actividades en familia', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->familyActivities), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Último evento positivo', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->lastPositiveEvent), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Último evento negativo', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->lastNegativeEvent), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Proyecto familiar', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->familyProject), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Proyecto personal', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->personalProject), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Aspecto a mejorar del evaluado según su familia', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->aspectsToImprove), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Expectativa frente a la oferta/trabajo', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->offerExpectations), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Qué conoce la flia de la empresa', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->familyCompanyKnowledge), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Actitud frente a la visita', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->visitAttitude), 1, 'J', false, true);
        $pdf->Cell(77, '', 'Ha sido demandado (por quién, cuándo, por qué)', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->demands), 1, 'J', false, true);
        $pdf->Cell(87, '', 'Ha sido testigo en algún proceso judicial (de quién, cuándo, por qué)', 1, 0, 'L', 1);
        $pdf->MultiCell(88, '', CHtml::encode($extra->witness), 1, 'J', false, true);

        $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->Cell(175, '', 'Familiares o conocidos que trabajen para esta empresa', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);

        $pdf->SetFillColor(220);
        $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
        $pdf->Cell(67, '', CHtml::encode($extra->knownFamilyName), 1, 0, 'L');
        $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->knownFamilyRelationship), 1, 1, 'L');
        $pdf->Cell(20, '', 'Cargo', 1, 0, 'L', 1);
        $pdf->Cell(67, '', CHtml::encode($extra->knownFamilyPosition), 1, 0, 'L');
        $pdf->Cell(20, '', 'Ciudad', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->knownFamilyCity), 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->Cell(175, '', '¿Cómo se enteró de la oferta/Como se vínculo con la empresa?', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);

        $pdf->SetFillColor(220);
        $pdf->Cell(20, '', 'Aviso', 1, 0, 'L', 1);
        $pdf->Cell(67, '', CHtml::encode($extra->offerNotice ? 'Sí' : 'No'), 1, 0, 'L');
        $pdf->Cell(30, '', 'Recomendación', 1, 0, 'L', 1);
        $pdf->Cell(58, '', CHtml::encode($extra->offerRecomendation ? 'Sí' : 'No'), 1, 1, 'L');
        $pdf->Cell(20, '', 'De quién', 1, 0, 'L', 1);
        $pdf->Cell(155, '', CHtml::encode($extra->offerWhoRecomended), 1, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->Cell(175, '', 'Estudio Socioeconómico', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);

        $pdf->Cell(50, '', 'Quiénes aportan en el hogar (Integrantes)', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->familyMemberIncome), 1, 0, 'L');
        $pdf->Cell(10, '', 'Valor', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->familyMemberAmount), 1, 1, 'L');
        $pdf->Cell(20, '', 'Ingresos', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->income), 1, 0, 'L');
        $pdf->Cell(30, '', 'Posee ingreso adicional', 1, 0, 'L', 1);
        $pdf->Cell(57, '', CHtml::encode($extra->additionalIncome ? 'Sí' : 'No'), 1, 1, 'L');
        $pdf->Cell(20, '', '¿Cuál?', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeWhich), 1, 0, 'L');
        $pdf->Cell(30, '', 'Valor', 1, 0, 'L', 1);
        $pdf->Cell(57, '', CHtml::encode($extra->additionalIncomeValue), 1, 1, 'L');
        $pdf->Cell(20, '', 'Total', 1, 0, 'L', 1);
        $pdf->Cell(155, '', CHtml::encode($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue), 1, 1, 'L');

        $pdf->Cell(61, '', '', 0, 1, 'L');
        

        if($extra->familyMemberIncome2!="" || $extra->familyMemberIncome2!=NULL){
            $pdf->Cell(50, '', 'Quiénes aportan en el hogar (Integrantes)', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->familyMemberIncome2), 1, 0, 'L');
            $pdf->Cell(10, '', 'Valor', 1, 0, 'L', 1);
            $pdf->Cell(47, '', CHtml::encode($extra->familyMemberAmount2), 1, 1, 'L');
            $pdf->Cell(20, '', 'Ingresos', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->income2), 1, 0, 'L');
            $pdf->Cell(30, '', 'Posee ingreso adicional', 1, 0, 'L', 1);
            $pdf->Cell(57, '', CHtml::encode($extra->additionalIncome2 ? 'Sí' : 'No'), 1, 1, 'L');
            $pdf->Cell(20, '', '¿Cuál?', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeWhich2), 1, 0, 'L');
            $pdf->Cell(30, '', 'Valor', 1, 0, 'L', 1);
            $pdf->Cell(57, '', CHtml::encode($extra->additionalIncomeValue2), 1, 1, 'L');
            $totalint2=CHtml::encode($extra->familyMemberAmount2+$extra->income2+$extra->additionalIncomeValue2);
            $pdf->Cell(20, '', 'Total', 1, 0, 'L', 1);
            $pdf->Cell(155, '', CHtml::encode($totalint2), 1, 1, 'L');
            $pdf->Cell(61, '', '', 0, 1, 'L');
        }else{
            $totalint2=0;
        }
        
        if($extra->familyMemberIncome3!="" || $extra->familyMemberIncome3!=NULL){
          $pdf->Cell(50, '', 'Quiénes aportan en el hogar (Integrantes)', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->familyMemberIncome3), 1, 0, 'L');
          $pdf->Cell(10, '', 'Valor', 1, 0, 'L', 1);
          $pdf->Cell(47, '', CHtml::encode($extra->familyMemberAmount3), 1, 1, 'L');
          $pdf->Cell(20, '', 'Ingresos', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->income3), 1, 0, 'L');
          $pdf->Cell(30, '', 'Posee ingreso adicional', 1, 0, 'L', 1);
          $pdf->Cell(57, '', CHtml::encode($extra->additionalIncome3 ? 'Sí' : 'No'), 1, 1, 'L');
          $pdf->Cell(20, '', '¿Cuál?', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeWhich3), 1, 0, 'L');
          $pdf->Cell(20, '', 'Valor', 1, 0, 'L', 1);
          $pdf->Cell(67, '', CHtml::encode($extra->additionalIncomeValue3), 1, 1, 'L');
          $totalint3=CHtml::encode($extra->familyMemberAmount3+$extra->income3+$extra->additionalIncomeValue3);
          $pdf->Cell(30, '', 'Total', 1, 0, 'L', 1);
          $pdf->Cell(145, '', CHtml::encode($totalint3), 1, 1, 'L');
        }else{
            $totalint3=0;
        }

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, '', 'TOTAL GENERAL', 1, 0, 'L', 1);
        $pdf->Cell(145, '', CHtml::encode($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue + $totalint2 + $totalint3), 1, 1, 'L');

        //$pdf->Cell(68, '', CHtml::encode($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue), 1, 1, 'L');
        $pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->Cell(175, '', 'Egresos del hogar "Gastos"', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);

        $pdf->SetFillColor(220);
        $pdf->Cell(50, '', 'Vivienda Arriendo y/o cuota', 1, 0, 'L', 1);
        $pdf->Cell(48, '', CHtml::encode($extra->expendituresHousing), 1, 0, 'L');
        $pdf->Cell(30, '', 'Servicios públicos', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->expendituresPublicServices), 1, 1, 'L');
        $pdf->Cell(30, '', 'Alimentación', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresFood), 1, 0, 'L');
        $pdf->Cell(30, '', 'Transporte', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->expendituresTransportation), 1, 1, 'L');
        $pdf->Cell(30, '', 'Estudios', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresStudies), 1, 0, 'L');
        $pdf->Cell(30, '', 'Recreación', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->expendituresRecreation), 1, 1, 'L');
        $pdf->Cell(30, '', 'Vestuario', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresClothing), 1, 0, 'L');
        $pdf->Cell(30, '', 'Préstamos', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->expendituresLoans), 1, 1, 'L');
        $pdf->Cell(30, '', 'Tarjeta de crédito', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresCreditCard), 1, 0, 'L');
        $pdf->Cell(30, '', 'Otros', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->expendituresOthers), 1, 1, 'L');
        $pdf->Cell(30, '', 'TOTAL', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresHousing + 
                              $extra->expendituresPublicServices + 
                              $extra->expendituresFood + 
                              $extra->expendituresTransportation + 
                              $extra->expendituresStudies + 
                              $extra->expendituresRecreation + 
                              $extra->expendituresClothing + 
                              $extra->expendituresLoans + 
                              $extra->expendituresCreditCard + 
                              $extra->expendituresOthers), 1, 1, 'L');


        $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->Cell(175, '', 'Validación económica', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);

        $pdf->SetFillColor(220);
        $pdf->Cell(30, '', 'Vehículo', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicCar), 1, 0, 'L');
        $pdf->Cell(30, '', 'Marca', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->economicBrand), 1, 1, 'L');
        $pdf->Cell(30, '', 'Modelo', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicModel), 1, 0, 'L');
        $pdf->Cell(30, '', 'Finca raíz', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->economicHouse), 1, 1, 'L');
        $pdf->Cell(85, '', '¿Está reportado negativamente en las centrales de riesgo?', 1, 0, 'L', 1);
        $pdf->Cell(13, '', CHtml::encode($extra->economicRiskCenters ? 'Sí' : 'No'), 1, 0, 'L');
        $pdf->Cell(30, '', '¿Por qué?', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->economicRiskCentersWhy), 1, 1, 'L');
        $pdf->Cell(85, '', '¿Tiene acuerdos de pago?', 1, 0, 'L', 1);
        $pdf->Cell(13, '', CHtml::encode($extra->economicPaymentAgreements ? 'Sí' : 'No'), 1, 0, 'L');
        $pdf->Cell(30, '', '¿Por qué?', 1, 0, 'L', 1);
        $pdf->Cell(47, '', CHtml::encode($extra->economicPaymentAgreementsWhy), 1, 1, 'L');
    }
    if ($verificationSection->backgroundCheck->studyStartedOn<'2021-03-06'){
    if($verificationSectionType->id == 8)
    {
        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Círculo social', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(196, '', '¿Cada cuánto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($extra->socialNetwork), 1, 'J', false, true);
        $pdf->Cell(196, '', 'Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo,  participación en la JAC, en movimientos políticos.', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($extra->clubsGroups), 1, 'J', false, true);
        $pdf->Cell(196, '', 'Hobbies, deportes y actividades de tiempo libre.', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($extra->hobbiesActivities), 1, 'J', false, true);
    }
  
  }
  }
  
}
$pdf->SetFillColor(255);
}else{

  $pdf->SetFillColor(220);

$pdf->Cell(35, '', 'Número de Personas', 1, 0, 'L', 1);
$pdf->Cell(20, '', count($verificationSection->detailPersons), 1, 1, 'C');

$verificationSectionType = VerificationSectionType::model()->findByPk($verificationSection->verificationSectionTypeId);
$showExtras = $verificationSectionType->hasPersonalExtras == 0 || $verificationSectionType->hasPersonalExtras == NULL ? false : true;
foreach ($verificationSection->detailPersons as $person) {
  if (!$person->isAReference) {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(56, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Edad', 1, 0, 'L', 1);
    $pdf->Cell(10, '', CHtml::encode($person->age), 1, 0, 'L');
    $pdf->Cell(25, '', 'Estado Civil', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($person->relationshipStatus->name), 1, 1, 'L');

    $pdf->Cell(25, '', 'Profesión', 1, 0, 'L', 1);
    $pdf->Cell(35, '', CHtml::encode($person->profession), 1, 0, 'L');
    $pdf->Cell(25, '', 'Trabaja en', 1, 0, 'L', 1);
    $pdf->Cell(38, '', CHtml::encode($person->workingAt), 1, 0, 'L');
    $pdf->Cell(25, '', 'Ocupación', 1, 0, 'L', 1);
    $pdf->Cell(48, '', CHtml::encode($person->functions), 1, 1, 'L');

    $pdf->Cell(25, '', 'Nivel de Educación', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->educationType ? $person->educationType->name : ""), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->tel), 1, 0, 'L');
    $pdf->Cell(61, '', '', 1, 1, 'L');

      if ($verificationSection->verificationSectionTypeId==6){

      }else{
          $pdf->Cell(196, '', 'Comunicación', 1, 1, 'L', 1);
          $pdf->MultiCell(196, '', CHtml::encode($person->familyCommunication), 1, 'L', 0, 1);
          // $pdf->Cell(63, '', CHtml::encode($person->familyCommunication), 1, 0, 'L');
          $pdf->Cell(196, '', 'Actividades que comparten', 1, 1, 'L', 1);
          // $pdf->Cell(63, '', CHtml::encode($person->familyActivities), 1, 1, 'L');
          $pdf->MultiCell(196, '', CHtml::encode($person->familyActivities), 1, 'L', 0, 1);

      }
  } else {
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->Cell(20, '', 'Relación', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->relation), 1, 0, 'L');
    $pdf->Cell(20, '', 'Nombre', 1, 0, 'L', 1);
    $pdf->Cell(50, '', CHtml::encode($person->name), 1, 0, 'L');
    $pdf->Cell(10, '', 'Tel', 1, 0, 'L', 1);
    $pdf->Cell(46, '', CHtml::encode($person->tel), 1, 1, 'L');

    $pdf->Cell(25, '', 'Lo conoce hace', 1, 0, 'L', 1);
    $pdf->Cell(15, '', CHtml::encode($person->howLongKnowEachOther), 1, 0, 'L');
    $pdf->Cell(30, '', 'Lo recomendaría', 1, 0, 'L', 1);
    $pdf->Cell(36, '', CHtml::encode($person->wouldYouRecomendTheCandidate), 1, 0, 'L');
    $pdf->Cell(15, '', 'Resultado', 1, 0, 'L', 1);
    $pdf->Cell(30, '', CHtml::encode($person->verificationResult->name), 1, 0, 'L');
    $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
    $pdf->Cell(20, '', CHtml::encode($person->verifiedOn), 1, 1, 'L');
  }

  if (trim($person->comments) != "") {
    $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
    $pdf->MultiCell(171, '', CHtml::encode($person->comments), 1, 'J', FALSE, TRUE);
  }


  $pdf->Cell(0, '', '', 0, 1, 'L');
}

if ($showExtras ) {
  $extra = DetailPersonExtras::model()->findByAttributes(array('verificationSectionId'=>$verificationSection->id));

  if (isset($extra)&&$extra!=NULL) {

    if($verificationSectionType->id == 6)
    {
        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Dinámica familiar', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(98, '', 'Pautas de crianza', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->parentingGuidelines), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Manejo de autoridad', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->authorityManagement), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Toma de decisiones', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->decisionMaking), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Comunicación', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->comunication), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Actividades en familia', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->familyActivities), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Último evento positivo', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->lastPositiveEvent), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Último evento negativo', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->lastNegativeEvent), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Proyecto familiar', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->familyProject), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Proyecto personal', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->personalProject), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Aspecto a mejorar del evaluado según su familia', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->aspectsToImprove), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Expectativa frente a la oferta/trabajo', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->offerExpectations), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Qué conoce la flia de la empresa', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->familyCompanyKnowledge), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Actitud frente a la visita', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->visitAttitude), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Ha sido demandado (por quién, cuándo, por qué)', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->demands), 1, 'J', false, true);
        $pdf->Cell(98, '', 'Ha sido testigo en algún proceso judicial (de quién, cuándo, por qué)', 1, 0, 'L', 1);
        $pdf->MultiCell(98, '', CHtml::encode($extra->witness), 1, 'J', false, true);

        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Familiares o conocidos que trabajen para esta empresa', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(30, '', 'Nombre', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->knownFamilyName), 1, 0, 'L');
        $pdf->Cell(30, '', 'Relación', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->knownFamilyRelationship), 1, 1, 'L');
        $pdf->Cell(30, '', 'Cargo', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->knownFamilyPosition), 1, 0, 'L');
        $pdf->Cell(30, '', 'Ciudad', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->knownFamilyCity), 1, 1, 'L');

        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', '¿Cómo se enteró de la oferta/Como se vínculo con la empresa?', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(30, '', 'Aviso', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->offerNotice ? 'Sí' : 'No'), 1, 0, 'L');
        $pdf->Cell(30, '', 'Recomendación', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->offerRecomendation ? 'Sí' : 'No'), 1, 1, 'L');
        $pdf->Cell(30, '', 'De quién', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->offerWhoRecomended), 1, 1, 'L');

        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Estudio Socioeconómico', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(50, '', 'Quiénes aportan en el hogar (Integrantes)', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->familyMemberIncome), 1, 0, 'L');
        $pdf->Cell(10, '', 'Valor', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->familyMemberAmount), 1, 1, 'L');
        $pdf->Cell(30, '', 'Ingresos', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->income), 1, 0, 'L');
        $pdf->Cell(30, '', 'Posee ingreso adicional', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->additionalIncome ? 'Sí' : 'No'), 1, 1, 'L');
        $pdf->Cell(30, '', '¿Cuál?', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeWhich), 1, 0, 'L');
        $pdf->Cell(30, '', 'Valor', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeValue), 1, 1, 'L');
        $pdf->Cell(30, '', 'Total', 1, 0, 'L', 1);
        $pdf->Cell(166, '', CHtml::encode($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue), 1, 1, 'L');

        $pdf->Cell(61, '', '', 0, 1, 'L');
        

        if($extra->familyMemberIncome2!="" || $extra->familyMemberIncome2!=NULL){
            $pdf->Cell(50, '', 'Quiénes aportan en el hogar (Integrantes)', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->familyMemberIncome2), 1, 0, 'L');
            $pdf->Cell(10, '', 'Valor', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->familyMemberAmount2), 1, 1, 'L');
            $pdf->Cell(30, '', 'Ingresos', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->income2), 1, 0, 'L');
            $pdf->Cell(30, '', 'Posee ingreso adicional', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->additionalIncome2 ? 'Sí' : 'No'), 1, 1, 'L');
            $pdf->Cell(30, '', '¿Cuál?', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeWhich2), 1, 0, 'L');
            $pdf->Cell(30, '', 'Valor', 1, 0, 'L', 1);
            $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeValue2), 1, 1, 'L');
            $totalint2=CHtml::encode($extra->familyMemberAmount2+$extra->income2+$extra->additionalIncomeValue2);
            $pdf->Cell(30, '', 'Total', 1, 0, 'L', 1);
            $pdf->Cell(166, '', CHtml::encode($totalint2), 1, 1, 'L');
            $pdf->Cell(61, '', '', 0, 1, 'L');
        }else{
            $totalint2=0;
        }
        
        if($extra->familyMemberIncome3!="" || $extra->familyMemberIncome3!=NULL){
          $pdf->Cell(50, '', 'Quiénes aportan en el hogar (Integrantes)', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->familyMemberIncome3), 1, 0, 'L');
          $pdf->Cell(10, '', 'Valor', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->familyMemberAmount3), 1, 1, 'L');
          $pdf->Cell(30, '', 'Ingresos', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->income3), 1, 0, 'L');
          $pdf->Cell(30, '', 'Posee ingreso adicional', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->additionalIncome3 ? 'Sí' : 'No'), 1, 1, 'L');
          $pdf->Cell(30, '', '¿Cuál?', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeWhich3), 1, 0, 'L');
          $pdf->Cell(30, '', 'Valor', 1, 0, 'L', 1);
          $pdf->Cell(68, '', CHtml::encode($extra->additionalIncomeValue3), 1, 1, 'L');
          $totalint3=CHtml::encode($extra->familyMemberAmount3+$extra->income3+$extra->additionalIncomeValue3);
          $pdf->Cell(30, '', 'Total', 1, 0, 'L', 1);
          $pdf->Cell(166, '', CHtml::encode($totalint3), 1, 1, 'L');
        }else{
            $totalint3=0;
        }

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, '', 'TOTAL GENERAL', 1, 0, 'L', 1);
        $pdf->Cell(166, '', CHtml::encode($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue + $totalint2 + $totalint3), 1, 1, 'L');

        //$pdf->Cell(68, '', CHtml::encode($extra->familyMemberAmount + $extra->income + $extra->additionalIncomeValue), 1, 1, 'L');

        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Egresos del hogar "Gastos"', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(50, '', 'Vivienda Arriendo y/o cuota', 1, 0, 'L', 1);
        $pdf->Cell(48, '', CHtml::encode($extra->expendituresHousing), 1, 0, 'L');
        $pdf->Cell(30, '', 'Servicios públicos', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresPublicServices), 1, 1, 'L');
        $pdf->Cell(30, '', 'Alimentación', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresFood), 1, 0, 'L');
        $pdf->Cell(30, '', 'Transporte', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresTransportation), 1, 1, 'L');
        $pdf->Cell(30, '', 'Estudios', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresStudies), 1, 0, 'L');
        $pdf->Cell(30, '', 'Recreación', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresRecreation), 1, 1, 'L');
        $pdf->Cell(30, '', 'Vestuario', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresClothing), 1, 0, 'L');
        $pdf->Cell(30, '', 'Préstamos', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresLoans), 1, 1, 'L');
        $pdf->Cell(30, '', 'Tarjeta de crédito', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresCreditCard), 1, 0, 'L');
        $pdf->Cell(30, '', 'Otros', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresOthers), 1, 1, 'L');
        $pdf->Cell(30, '', 'TOTAL', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->expendituresHousing + 
                              $extra->expendituresPublicServices + 
                              $extra->expendituresFood + 
                              $extra->expendituresTransportation + 
                              $extra->expendituresStudies + 
                              $extra->expendituresRecreation + 
                              $extra->expendituresClothing + 
                              $extra->expendituresLoans + 
                              $extra->expendituresCreditCard + 
                              $extra->expendituresOthers), 1, 1, 'L');


        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Validación económica', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(30, '', 'Vehículo', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicCar), 1, 0, 'L');
        $pdf->Cell(30, '', 'Marca', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicBrand), 1, 1, 'L');
        $pdf->Cell(30, '', 'Modelo', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicModel), 1, 0, 'L');
        $pdf->Cell(30, '', 'Finca raíz', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicHouse), 1, 1, 'L');
        $pdf->Cell(85, '', '¿Está reportado negativamente en las centrales de riesgo?', 1, 0, 'L', 1);
        $pdf->Cell(13, '', CHtml::encode($extra->economicRiskCenters ? 'Sí' : 'No'), 1, 0, 'L');
        $pdf->Cell(30, '', '¿Por qué?', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicRiskCentersWhy), 1, 1, 'L');
        $pdf->Cell(85, '', '¿Tiene acuerdos de pago?', 1, 0, 'L', 1);
        $pdf->Cell(13, '', CHtml::encode($extra->economicPaymentAgreements ? 'Sí' : 'No'), 1, 0, 'L');
        $pdf->Cell(30, '', '¿Por qué?', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($extra->economicPaymentAgreementsWhy), 1, 1, 'L');
    }
    if ($verificationSection->backgroundCheck->studyStartedOn<'2021-03-06'){
    if($verificationSectionType->id == 8)
    {
        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Círculo social', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(196, '', '¿Cada cuánto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($extra->socialNetwork), 1, 'J', false, true);
        $pdf->Cell(196, '', 'Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo,  participación en la JAC, en movimientos políticos.', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($extra->clubsGroups), 1, 'J', false, true);
        $pdf->Cell(196, '', 'Hobbies, deportes y actividades de tiempo libre.', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($extra->hobbiesActivities), 1, 'J', false, true);
    }
  
  }
  }
  
}
$pdf->SetFillColor(255);
}