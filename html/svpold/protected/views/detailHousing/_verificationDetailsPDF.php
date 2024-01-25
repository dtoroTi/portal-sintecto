<?php

$pdf->SetFillColor(220);
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {

  $pdf->AddPage();
  $pdf->SetY(25);    
  $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->MultiCell(175, 5, "VIVIENDA" , 0, 'C', 1, 1, '', '', true);
  $pdf->SetFillColor(220);$pdf->SetTextColor(0);

  $pdf->SetFont('Arial', '', 10);


  $housing = $verificationSection->detailHousing;
  if ($verificationSection->detailHousing) {
    $housingOwnership = HousingOwnership::model()->findByPk($housing->housingOwnership);
    $housingNewType = HousingType::model()->findByPk($housing->newHousingType);
  
    $pdf->Cell(35, '', 'Vive Desde', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($housing->livesSince), 1, 0, 'L');
    $pdf->Cell(45, '', 'Tipo de Vivienda', 1, 0, 'L', 1);
    if(isset($housing->housingType)) {
      $pdf->Cell(39.8, '', CHtml::encode($housing->housingType), 1, 0, 'L');
    } else {
      if(isset($housingNewType)&&$housingNewType!=NULL)
        $pdf->Cell(39.8, '', CHtml::encode($housingNewType->name), 1, 0, 'L');
    }
    
    $pdf->Cell(20, '', 'Estrato', 1, 0, 'L', 1);
    $pdf->Cell(10, '', CHtml::encode($housing->stratum), 1, 1, 'L');
    $pdf->Cell(35, '', 'Servicios Faltantes', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($housing->publicServicesMissing), 1, 0, 'L');
  
    if(isset($housingOwnership)&&$housingOwnership!=NULL){
      $pdf->Cell(45, '', 'Tenencia de vivienda', 1, 0, 'L', 1);
      $pdf->Cell(69.8, '', CHtml::encode($housingOwnership->name), 1, 1, 'L');
    }
  
    $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->Cell(175, '', 'Descripción interna de la vivienda', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);
  
    $pdf->SetFillColor(220);
    $pdf->Cell(77, '', 'Distribución', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->distribution), 1, 'J', false, true);
    $pdf->Cell(77, '', 'Orden y aseo', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->orderAndCleaning), 1, 'J', false, true);
    $pdf->Cell(77, '', 'Iluminación y ventilación', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->iluminationAndVentilation), 1, 'J', false, true);
    $pdf->Cell(77, '', 'Expectativa de cambio', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->changeExpectations), 1, 'J', false, true);
  
    $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
    $pdf->Cell(175, '', 'Descripción externa de la vivienda', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);
  
    $pdf->SetFillColor(220);
    $pdf->Cell(77, '', 'Equipamiento social', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->socialEquipment), 1, 'J', false, true);
    $pdf->Cell(77, '', 'Límites zona', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->zoneLimits), 1, 'J', false, true);
    $pdf->Cell(77, '', 'Factores de inseguridad', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->securityFactors), 1, 'J', false, true);
    $pdf->Cell(77, '', 'Vías principales', 1, 0, 'L', 1);
    $pdf->MultiCell(98, '', CHtml::encode($housing->accessRoads), 1, 'J', false, true);
  
  
      if ($verificationSection->backgroundCheck->studyStartedOn>='2021-03-07') {
  
          $pdf->SetFont('Arial', 'B', 10);$pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
          $pdf->Cell(175, '', 'Círculo social', 1, 1, 'C', 1);
          $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);
  
          $pdf->SetFillColor(220);
          $pdf->Cell(175, '', '¿Cada cuánto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?', 1, 1, 'L', 1);
          $pdf->MultiCell(175, '', CHtml::encode($housing->socialNetwork), 1, 'J', false, true);
          $pdf->Cell(175, '', 'Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo,  participación en la JAC, en movimientos políticos.', 1, 1, 'L', 1);
          $pdf->MultiCell(175, '', CHtml::encode($housing->clubsGroups), 1, 'J', false, true);
          $pdf->Cell(175, '', 'Hobbies, deportes y actividades de tiempo libre.', 1, 1, 'L', 1);
          $pdf->MultiCell(175, '', CHtml::encode($housing->hobbiesActivities), 1, 'J', false, true);
  
  
          $pdf->Cell(40, '', 'Resultado', 1, 0, 'L', 1);
          $pdf->Cell(47.5, '', CHtml::encode($housing->verificationResult->name), 1, 0, 'L');
          $pdf->Cell(40, '', 'Verificado En', 1, 0, 'L', 1);
          $pdf->Cell(47.5, '', CHtml::encode($housing->visitedOn), 1, 1, 'L');
      }
      $pdf->SetFillColor(255);
    }


}else{
$housing = $verificationSection->detailHousing;
if ($verificationSection->detailHousing) {
  $housingOwnership = HousingOwnership::model()->findByPk($housing->housingOwnership);
  $housingNewType = HousingType::model()->findByPk($housing->newHousingType);

  $pdf->Cell(25, '', 'Vive Desde', 1, 0, 'L', 1);
  $pdf->Cell(20, '', CHtml::encode($housing->livesSince), 1, 0, 'L');
  $pdf->Cell(25, '', 'Tipo de Vivienda', 1, 0, 'L', 1);
  if(isset($housing->housingType)) {
    $pdf->Cell(36, '', CHtml::encode($housing->housingType), 1, 0, 'L');
  } else {
    if(isset($housingNewType)&&$housingNewType!=NULL)
      $pdf->Cell(36, '', CHtml::encode($housingNewType->name), 1, 0, 'L');
  }
  
  $pdf->Cell(20, '', 'Estrato', 1, 0, 'L', 1);
  $pdf->Cell(10, '', CHtml::encode($housing->stratum), 1, 0, 'L');
  $pdf->Cell(35, '', 'Servicios Faltantes', 1, 0, 'L', 1);
  $pdf->Cell(25, '', CHtml::encode($housing->publicServicesMissing), 1, 1, 'L');

  if(isset($housingOwnership)&&$housingOwnership!=NULL){
    $pdf->Cell(35, '', 'Tenencia de vivienda', 1, 0, 'L', 1);
    $pdf->Cell(25, '', CHtml::encode($housingOwnership->name), 1, 1, 'L');
  }

  $pdf->SetFillColor(153, 204, 255);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(196, '', 'Descripción interna de la vivienda', 1, 1, 'C', 1);
  $pdf->SetFont('Arial', '', 10);

  $pdf->SetFillColor(220);
  $pdf->Cell(98, '', 'Distribución', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->distribution), 1, 'J', false, true);
  $pdf->Cell(98, '', 'Orden y aseo', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->orderAndCleaning), 1, 'J', false, true);
  $pdf->Cell(98, '', 'Iluminación y ventilación', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->iluminationAndVentilation), 1, 'J', false, true);
  $pdf->Cell(98, '', 'Expectativa de cambio', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->changeExpectations), 1, 'J', false, true);

  $pdf->SetFillColor(153, 204, 255);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(196, '', 'Descripción externa de la vivienda', 1, 1, 'C', 1);
  $pdf->SetFont('Arial', '', 10);

  $pdf->SetFillColor(220);
  $pdf->Cell(98, '', 'Equipamiento social', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->socialEquipment), 1, 'J', false, true);
  $pdf->Cell(98, '', 'Límites zona', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->zoneLimits), 1, 'J', false, true);
  $pdf->Cell(98, '', 'Factores de inseguridad', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->securityFactors), 1, 'J', false, true);
  $pdf->Cell(98, '', 'Vías principales', 1, 0, 'L', 1);
  $pdf->MultiCell(98, '', CHtml::encode($housing->accessRoads), 1, 'J', false, true);


    if ($verificationSection->backgroundCheck->studyStartedOn>='2021-03-07') {

        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'Círculo social', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetFillColor(220);
        $pdf->Cell(196, '', '¿Cada cuánto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($housing->socialNetwork), 1, 'J', false, true);
        $pdf->Cell(196, '', 'Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo,  participación en la JAC, en movimientos políticos.', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($housing->clubsGroups), 1, 'J', false, true);
        $pdf->Cell(196, '', 'Hobbies, deportes y actividades de tiempo libre.', 1, 1, 'L', 1);
        $pdf->MultiCell(196, '', CHtml::encode($housing->hobbiesActivities), 1, 'J', false, true);


        $pdf->Cell(15, '', 'Resultado', 1, 0, 'L', 1);
        $pdf->Cell(30, '', CHtml::encode($housing->verificationResult->name), 1, 1, 'L');
        $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
        $pdf->Cell(20, '', CHtml::encode($housing->visitedOn), 1, 1, 'L');
    }
    $pdf->SetFillColor(255);
  }
}