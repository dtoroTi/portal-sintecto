<?php
/*
$pdf->SetFillColor(220);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(76, '', 'Pregunta', 1, 0, 'C', 1);
$pdf->Cell(120, '', 'Respuesta', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);
foreach ($verificationSection->detailQuestions as $question) {
  $pdf->Cell(76, '', $question->sectionTypeQuestion->question, 1, 0, 'L',1);
  $pdf->Cell(120, '', $question->questionAnswer, 1, 1, 'L');
}
$pdf->SetFillColor(255);

*/
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {

  $pdf->AddPage();
  $pdf->Cell('', '', '', '', 1, 'L');
  $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->MultiCell(170, 0, "RECURSOS HUMANOS" , 1, 'C', 1, 1, '', '', true);
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell('', '', '', '', 1, 'L');
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Cargo" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Número" , 1, 'C', 1, 1, '', '', true);
  $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);


 // foreach ($employeesSection->detailCompanyEmployee as $employee) {
         // $pdf->Cell(60, '', CHtml::encode($employee->sectionTypeQuestion->question), 1, 0, 'L');
         // $pdf->Cell(20, '', CHtml::encode($employee->questionAnswer), 1, 1, 'R');

    $pdf->MultiCell(50, 0, "Gerencia" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $verificationSection->detailCompanyEmployee[0]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);	
    $pdf->MultiCell(50, 0, "Directivos" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $verificationSection->detailCompanyEmployee[1]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
       $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Coordinaciones" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $verificationSection->detailCompanyEmployee[2]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Asistenciales" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $verificationSection->detailCompanyEmployee[3]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Operativos" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $verificationSection->detailCompanyEmployee[4]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
    $pdf->MultiCell(50, 0, "Staff" , 1, 'C', 1, 0, '', '', true);
    $pdf->MultiCell(50, 0, $verificationSection->detailCompanyEmployee[5]['questionAnswer'] , 1, 'C', 1, 1, '', '', true);
    $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);

if (isset($verificationSection->detailCompanyEmployee)) {
      $totalEmpleados = $verificationSection->detailCompanyEmployee[0]['questionAnswer']+$verificationSection->detailCompanyEmployee[1]['questionAnswer']+$verificationSection->detailCompanyEmployee[2]['questionAnswer']+$verificationSection->detailCompanyEmployee[3]['questionAnswer']+$verificationSection->detailCompanyEmployee[4]['questionAnswer']+$verificationSection->detailCompanyEmployee[5]['questionAnswer'];
  }

       $pdf->MultiCell(50, 0, "Total Empleados" , 1, 'C', 1, 0, '', '', true);
     $pdf->MultiCell(50, 0, $totalEmpleados , 1, 'C', 1, 1, '', '', true);


  if(!isset($verificationSection->detailCompanyEmployee[6]['questionAnswer']))
       $verificationSection->detailCompanyEmployee[6]['questionAnswer'] = 0;
  if(!isset($verificationSection->detailCompanyEmployee[7]['questionAnswer']))
       $verificationSection->detailCompanyEmployee[7]['questionAnswer'] = 0;
  if(!isset($verificationSection->detailCompanyEmployee[8]['questionAnswer']))
       $verificationSection->detailCompanyEmployee[8]['questionAnswer'] = 0;  
  if(!isset($verificationSection->detailCompanyEmployee[9]['questionAnswer']))
      $verificationSection->detailCompanyEmployee[9]['questionAnswer'] = 0;   
  if(!isset($verificationSection->detailCompanyEmployee[10]['questionAnswer']))
      $verificationSection->detailCompanyEmployee[10]['questionAnswer'] = 0;   

if(!isset($verificationSection->detailCompanyEmployee[11]['questionAnswer']))
      $verificationSection->detailCompanyEmployee[11]['questionAnswer'] = 0;
  if(!isset($verificationSection->detailCompanyEmployee[12]['questionAnswer']))
      $verificationSection->detailCompanyEmployee[12]['questionAnswer'] = 0;
  if(!isset($verificationSection->detailCompanyEmployee[13]['questionAnswer']))
      $verificationSection->detailCompanyEmployee[13]['questionAnswer'] = 0;

  
  $totalContratacion = (isset($verificationSection->detailCompanyEmployee[6]['questionAnswer'])?$verificationSection->detailCompanyEmployee[6]['questionAnswer']:0)+
      (isset($verificationSection->detailCompanyEmployee[7]['questionAnswer'])?$verificationSection->detailCompanyEmployee[7]['questionAnswer']:0)+
      (isset($verificationSection->detailCompanyEmployee[11]['questionAnswer'])?$verificationSection->detailCompanyEmployee[11]['questionAnswer']:0)+
      (isset($verificationSection->detailCompanyEmployee[12]['questionAnswer'])?$verificationSection->detailCompanyEmployee[12]['questionAnswer']:0)+
      (isset($verificationSection->detailCompanyEmployee[13]['questionAnswer'])?$verificationSection->detailCompanyEmployee[13]['questionAnswer']:0);

  

  $totalContratacionMode = 
      (isset($verificationSection->detailCompanyEmployee[8]['questionAnswer'])?$verificationSection->detailCompanyEmployee[8]['questionAnswer']:0)+
      (isset($verificationSection->detailCompanyEmployee[9]['questionAnswer'])?$verificationSection->detailCompanyEmployee[9]['questionAnswer']:0)+
      (isset($verificationSection->detailCompanyEmployee[10]['questionAnswer'])?$verificationSection->detailCompanyEmployee[10]['questionAnswer']:0);

 function percentNumber($a){
      $ans = number_format(($a * 100), 2) . '%';
      return $ans;
  }


function divideNumbers($a, $b){
      if ($a != 0 && $b != 0) {
          $ans = $a / $b;
      } else {
          $ans = '0';
      }
      return $ans;
  }


  
  $contratacionFijo = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[6]['questionAnswer'], $totalContratacion));
  $contratacionIndefinido = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[7]['questionAnswer'], $totalContratacion));
  
  $contratacionObraLabor = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[11]['questionAnswer'], $totalContratacion));
  $contratacionAprendiz = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[12]['questionAnswer'], $totalContratacion));
  $contratacionServicios = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[13]['questionAnswer'], $totalContratacion));
  
  
  $contratacionDirecto = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[8]['questionAnswer'], $totalContratacionMode));
  $contratacionTemporal = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[9]['questionAnswer'], $totalContratacionMode));
  $contratacionOtros = percentNumber(divideNumbers($verificationSection->detailCompanyEmployee[10]['questionAnswer'], $totalContratacionMode));

  

  
  $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell('', '', '', '', 1, 'L');
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Tipo de Contrato " , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, "100%" , 1, 'C', 1, 1, '', '', true);
  
  $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Fijo" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionFijo , 1, 'C', 1, 1, '', '', true);

  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Indefinido" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionIndefinido , 1, 'C', 1, 1, '', '', true);
  
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Obra Labor" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionObraLabor , 1, 'C', 1, 1, '', '', true);
  
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Aprendiz" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionAprendiz , 1, 'C', 1, 1, '', '', true);
  
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Servicios" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionServicios , 1, 'C', 1, 1, '', '', true);
  
  
  $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255,255,255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell('', '', '', '', 1, 'L');
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Modalidad de Contratación" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, "100%" , 1, 'C', 1, 1, '', '', true);

  $pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0,0,0);
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Directo" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionDirecto , 1, 'C', 1, 1, '', '', true);
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Temporal" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionTemporal , 1, 'C', 1, 1, '', '', true);
  $pdf->MultiCell(35, 0, "" , 0, 'C', 0, 0, '', '', true);
  $pdf->MultiCell(50, 0, "Otros" , 1, 'C', 1, 0, '', '', true);
  $pdf->MultiCell(50, 0, $contratacionOtros , 1, 'C', 1, 1, '', '', true);
  $pdf->Cell('', '', '', '', 1, 'L');

}else {

    $pdf->SetFillColor(220);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(76, '', 'Pregunta', 1, 0, 'C', 1);
    $pdf->Cell(120, '', 'Respuesta', 1, 1, 'C', 1);
    
    $pdf->SetFont('Arial', '', 10);
    foreach ($verificationSection->detailQuestions as $question) {
      $pdf->Cell(76, '', $question->sectionTypeQuestion->question, 1, 0, 'L',1);
      $pdf->Cell(120, '', $question->questionAnswer, 1, 1, 'L');
    }
    $pdf->SetFillColor(255);
    }