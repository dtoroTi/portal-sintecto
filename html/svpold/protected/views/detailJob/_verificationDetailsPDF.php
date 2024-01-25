<?php
if ($verificationSection->backgroundCheck->customerProduct->isCompanySurvey == 1) {
  $pdf->AddPage();
  $pdf->SetY(25);    
  $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->MultiCell(175, 5, "LABORAL" , 0, 'C', 1, 1, '', '', true);
  $pdf->SetFillColor(220);$pdf->SetTextColor(0);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(24, '', 'Inicio', 1, 0, 'C', 1);
  $pdf->Cell(24, '', 'Fin', 1, 0, 'C', 1);
  //$pdf->Cell(12, '', 'Tiempo', 1, 0, 'C', 1);
  $pdf->Cell(40, '', 'Compañía', 1, 0, 'C', 1);
  $pdf->Cell(50, '', 'Cargo', 1, 0, 'C', 1);
  $pdf->Cell(15, '', 'Activo', 1, 0, 'C', 1);
  $pdf->Cell(22, '', 'Verif.', 1, 1, 'C', 1);
  //$pdf->Cell(65, '', 'Comentario', 1, 1, 'C', 1);

  $pdf->SetFont('Arial', '', 8);

  $previousWork = null;

  foreach ($verificationSection->detailJobs as $job) {
    if ($job->activityTypeId<>6) {

      // Se oculpa el letrero rojo que salia de periodo sin descripcion en los pdf
      /*if ($previousWork && VerificationSection::diffTimeIsBiggerThan(
                      $previousWork, $job->startedOn, DetailJob::INACTIVITY_WARNING_DAYS)) {
        $pdf->Cell(12, '', CHtml::encode(substr($previousWork, 0, 10)), 1, 0, 'L');
        $pdf->Cell(12, '', CHtml::encode(substr($job->startedOn, 0, 10)), 1, 0, 'L');
    //    $pdf->Cell(12, '', VerificationSection::diffTime($previousWork, $job->startedOn), 1, 0, 'L');
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(125, '', 'Periodo sin Descripción por más de ' .
                CHtml::encode(DetailJob::INACTIVITY_WARNING_DAYS) .
                ' días', 1, 0, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, '', '', 0, 1, 'L');
      }*/

      $pdf->Cell(24, '', CHtml::encode(substr($job->startedOn, 0, 10)), 1, 0, 'L');
      $pdf->Cell(24, '', CHtml::encode(substr($job->finishedOn, 0, 10)), 1, 0, 'L');
    //  $pdf->Cell(12, '', VerificationSection::diffTime($job->startedOn, $job->finishedOn), 1, 0, 'L');
    //TITULO
      if ($job->activityTypeId == null || $job->activityTypeId == ActivityType::EMPLOYED || $job->activityTypeId == ActivityType::SELF_EMPLOYED) {
        $pdf->Cell(40, '', CHtml::encode($job->company), 1, 0, 'L');
      } else {
        $pdf->Cell(40, '', CHtml::encode($job->activityType->name), 1, 0, 'L');
      }
      $pdf->Cell(50, '', CHtml::encode($job->lastPosition), 1, 0, 'L');
      $pdf->Cell(15, '', CHtml::encode(Controller::stringYesNo($job->stillWorking)), 1, 0, 'L');
      $pdf->Cell(22, '', CHtml::encode($job->verificationResult->name), 1, 0, 'L');
    //  $pdf->Cell(65, '', CHtml::encode($job->comments), 1, 0, 'L');
      $pdf->Cell(0, '', '', 0, 1, 'L');

      $previousWork = $job->finishedOn;
    }
  }

  // Se oculpa el letrero rojo que salia de periodo sin descripcion en los pdf
  /*if ($previousWork
          && !$job->stillWorking
          && VerificationSection::diffTimeIsBiggerThan(
                  $previousWork, "now", DetailJob::INACTIVITY_WARNING_DAYS)) {
    $now = new DateTime("now");
    $pdf->Cell(12, '', CHtml::encode(substr($previousWork, 0, 7)), 1, 0, 'L');
    $pdf->Cell(12, '', CHtml::encode(substr($now->format("Y-m"), 0, 7)), 1, 0, 'L');
  //  $pdf->Cell(12, '', VerificationSection::diffTime($previousWork, "now"), 1, 0, 'L');
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(125, '', 'Periodo sin Descripción por más de ' .
            CHtml::encode(DetailJob::INACTIVITY_WARNING_DAYS) .
            ' días', 1, 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, '', '', 0, 1, 'L');
  }*/


  // Detail


  $pdf->SetFont('Arial', '', 10);
  $pdf->SetFillColor(220);


  foreach ($verificationSection->detailJobs as $job) {
    if ($job->activityTypeId != '6') {
      $pdf->SetFont('Arial', '', 10);
      $pdf->Cell(0, '', '', 0, 1, 'L');
      $pdf->Cell(0, '', "", 0, 1, 'L');
      $pdf->Cell(15, '', 'Inicio', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->startedOn), 1, 0, 'L');
      $pdf->Cell(15, '', 'Fin', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->finishedOn), 1, 0, 'L');
      $pdf->Cell(12, '', 'Dur.', 1, 0, 'L', 1);
      $pdf->Cell(16, '', VerificationSection::diffTime($job->startedOn, $job->finishedOn), 1, 0, 'L');
      // Seccion
      if ($job->activityTypeId == null || $job->activityTypeId == ActivityType::EMPLOYED || $job->activityTypeId == ActivityType::SELF_EMPLOYED) {
        $pdf->Cell(22, '', 'Compañía', 1, 0, 'L', 1);
        $pdf->Cell(55, '', CHtml::encode($job->company), 1, 1, 'L');
      } else {
        $pdf->Cell(22, '', 'Tipo de Actividad', 1, 0, 'L', 1);
        $pdf->Cell(55, '', CHtml::encode($job->activityType->name), 1, 1, 'L');
      }

      $pdf->Cell(30, '', 'Continúa trabajando', 1, 0, 'L', 1);
      $pdf->Cell(10, '', CHtml::encode(Controller::stringYesNo($job->stillWorking)), 1, 0, 'L');
      $pdf->Cell(25, '', 'Tipo de Contrato', 1, 0, 'L', 1);
      $pdf->Cell(33, '', CHtml::encode($job->contractType), 1, 0, 'L');
      $pdf->Cell(22, '', 'Última posición', 1, 0, 'L', 1);
      $pdf->Cell(55, '', CHtml::encode($job->lastPosition), 1, 1, 'L');

      $pdf->Cell(22, '', 'País', 1, 0, 'L', 1);
      $pdf->Cell(30, '', CHtml::encode($job->country), 1, 0, 'L');
      $pdf->Cell(12, '', 'Ciudad', 1, 0, 'L', 1);
      $pdf->Cell(26, '', CHtml::encode($job->city), 1, 0, 'L');
      $pdf->Cell(10, '', 'Tels', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->tel), 1, 0, 'L');
      $pdf->Cell(18, '', 'Contacto', 1, 0, 'L', 1);
      $pdf->Cell(37, '', CHtml::encode($job->nameOfContact), 1, 1, 'L');

      $pdf->Cell(22, '', 'Cargo de Contacto', 1, 0, 'L', 1);
      $pdf->Cell(153, '', CHtml::encode($job->contactPosition), 1, 1, 'L');

      if ($job->workDetail != 'No aplica') {

        $pdf->Cell(22, '', 'Funciones', 1, 0, 'L', 1);
        $pdf->MultiCell(153, '', CHtml::encode($job->workDetail), 1, 'J', false, true);
      }
      $pdf->Cell(22, '', 'Motivo del Retiro', 1, 0, 'L', 1);
      $pdf->MultiCell(153, '', CHtml::encode($job->retireReason), 1, 'J', false, true);

      if ($job->bossInmediateContact == '1') {
        $pdf->Cell(22, '', 'Jefe inmediato', 1, 0, 'L', 1);
        $pdf->MultiCell(153, '', CHtml::encode($job->immediateBoss), 1, 'J', false, true);      

        $pdf->Cell(22, '', 'Contacto jefe', 1, 0, 'L', 1);
        $pdf->MultiCell(153, '', CHtml::encode($job->immediateBossContact), 1, 'J', false, true);
      }
    
      if($verificationSection->backgroundCheck->customer->quantitativeEvaluation==1){ 
        $pdf->Cell(22, '', 'Aportó Certificado', 1, 0, 'L', 1);
        $pdf->MultiCell(153, '',CHtml::encode(Controller::stringYesNo($job->providedCertificate)), 1, 'J', false, true);
      
        $pdf->Cell(22, '', 'HV Congruente', 1, 0, 'L', 1);
        $pdf->MultiCell(153, '', CHtml::encode(Controller::stringYesNo($job->congruentResume)), 1, 'J', false, true);
        
        $pdf->Cell(22, '', 'Hist. Pensional', 1, 0, 'L', 1);
        $pdf->MultiCell(153, '',CHtml::encode(Controller::stringYesNo($job->historicPension)), 1, 'J', false, true);
      }//else{
        if ($job->bossInmediateContact == '1') {
          $pdf->Cell(22, '', 'Fortalezas', 1, 0, 'L', 1);
          $pdf->MultiCell(153, '', CHtml::encode($job->strenghts), 1, 'J', false, true);
        
          $pdf->Cell(22, '', 'Debilidades', 1, 0, 'L', 1);
          $pdf->MultiCell(153, '', CHtml::encode($job->weaknesses), 1, 'J', false, true);
        }
     // }
      if ($job->bossInmediateContact == '1') {
        $pdf->Cell(65, '', 'Lo contrataría nuevamente', 1, 0, 'L', 1);
        $pdf->Cell(28, '', CHtml::encode($job->wouldYouContractAgain), 1, 0, 'L');
      
        $pdf->Cell(32, '', 'Lo recomendaría', 1, 0, 'L', 1);
        $pdf->Cell(50, '', CHtml::encode($job->wouldYouRecomend), 1, 1, 'L');
       }
      if($verificationSection->backgroundCheck->customer->salaryEarnedCust==1){ 
        $pdf->Cell(30, '', 'Salario Devengado', 1, 0, 'L', 1);      
        $pdf->Cell(40, '', CHtml::encode($job->salaryEarned), 1, 0, 'L');
        }
      $pdf->Cell(28, '', 'Resultado', 1, 0, 'L', 1);
      $pdf->Cell(30, '', CHtml::encode($job->verificationResult->name), 1, 0, 'L');
      $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
      $pdf->Cell(95, '', CHtml::encode($job->verifiedOn), 1, 1, 'L');


      $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
      $pdf->MultiCell(150, '', CHtml::encode($job->comments), 1, 'J', FALSE, TRUE);
      if($verificationSection->backgroundCheck->customer->quantitativeEvaluation==1){     

        $pdf->SetFillColor(0,66,109); $pdf->SetTextColor(255);
        $pdf->SetFont('Arial', 'B', 10);$pdf->Cell(0, '', '', 0, 1, 'L');
        $pdf->Cell(175, '', 'EVALUACIÓN CUANTITATIVA Y CUALITATIVA', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);$pdf->SetFillColor(220);$pdf->SetTextColor(0);
        $pdf->MultiCell(175, '', 'De acuerdo con lo que usted observó en los comportamientos de '.$verificationSection->backgroundCheck->firstName." ".$verificationSection->backgroundCheck->lastName.' ¿Cómo calificaría cada una de las siguientes competencias? Siendo:
        0 = No sabe, no responde.
        5 = Su máximo potencial para el cargo que ocupó.', 1, 'J', FALSE, TRUE);  
        $pdf->SetFont('Arial', 'B', 10);     
        $pdf->Cell(35, '', 'Solución de Problemas', 1, 0, 'C', 1);
        $pdf->Cell(35, '', 'Puntualidad', 1, 0, 'C', 1);
        $pdf->Cell(35, '', 'Trabajo en Equipo', 1, 0, 'C', 1);
        $pdf->Cell(35, '', 'Orientación a Resultados', 1, 0, 'C', 1);
        $pdf->Cell(35, '', 'Adaptabilidad', 1, 1, 'C', 1);
      
        $pdf->SetFont('Arial', '', 10);
      
        for( $i=0; $i<=5; $i++ ){    
            $html='<table border="1" >';
            $html.='<tr>';  
        
          if ($i==CHtml::encode($job->problemSolving)){
            if (CHtml::encode($job->problemSolving=='0')){
              $html.='<td width="140" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->problemSolving=='1') || CHtml::encode($job->problemSolving=='2') || CHtml::encode($job->problemSolving=='3')){
              $html.='<td width="140" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->problemSolving=='4') || CHtml::encode($job->problemSolving=='5')){
              $html.='<td width="140" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            }     
          }else{
            $html.='<td width="140" height="30" align="CENTER">'.$i.'';  
          }
          $html.='</td>';
          if ($i==CHtml::encode($job->leadership)){
            if (CHtml::encode($job->leadership=='0')){
              $html.='<td width="140" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->leadership=='1') || CHtml::encode($job->leadership=='2') || CHtml::encode($job->leadership=='3')){
              $html.='<td width="140" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->leadership=='4') || CHtml::encode($job->leadership=='5')){
              $html.='<td width="140" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            }      
          }else{
            $html.='<td width="140" height="30" align="CENTER">'.$i.'';  
          }
          $html.='</td>';
          if ($i==CHtml::encode($job->teamWork)){
            if (CHtml::encode($job->teamWork=='0')){
              $html.='<td width="140" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->teamWork=='1') || CHtml::encode($job->teamWork=='2') || CHtml::encode($job->teamWork=='3')){
              $html.='<td width="140" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->teamWork=='4') || CHtml::encode($job->teamWork=='5')){
              $html.='<td width="140" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            } 
            
          }else{
            $html.='<td width="140" height="30" align="CENTER">'.$i.'';  
          } 
          $html.='</td>';
          if ($i==CHtml::encode($job->orientationtoResults)){
            if (CHtml::encode($job->orientationtoResults=='0')){
              $html.='<td width="140" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->orientationtoResults=='1') || CHtml::encode($job->orientationtoResults=='2') || CHtml::encode($job->orientationtoResults=='3')){
              $html.='<td width="140" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->orientationtoResults=='4') || CHtml::encode($job->orientationtoResults=='5')){
              $html.='<td width="140" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            } 
            
          }else{
            $html.='<td width="140" height="30" align="CENTER">'.$i.'';  
          } 
          $html.='</td>';
          if ($i==CHtml::encode($job->adaptability)){
            if (CHtml::encode($job->adaptability=='0')){
              $html.='<td width="140" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->adaptability=='1') || CHtml::encode($job->adaptability=='2') || CHtml::encode($job->adaptability=='3')){
              $html.='<td width="140" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->adaptability=='4') || CHtml::encode($job->adaptability=='5')){
              $html.='<td width="140" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            } 
            
          }else{
            $html.='<td width="140" height="30" align="CENTER">'.$i.'';  
          } 
          $html.='</td>';
          $html.='</tr></table>';
        
          $pdf->WriteHTML($html);$pdf->SetFillColor(220);
        }
        }
      }
    }
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->SetFillColor(255);
  }else{
  $pdf->SetFillColor(220);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(18, '', 'Inicio', 1, 0, 'C', 1);
  $pdf->Cell(18, '', 'Fin', 1, 0, 'C', 1);
  $pdf->Cell(12, '', 'Tiempo', 1, 0, 'C', 1);
  $pdf->Cell(47, '', 'Compañía', 1, 0, 'C', 1);
  $pdf->Cell(60, '', 'Cargo', 1, 0, 'C', 1);
  $pdf->Cell(16, '', 'Activo', 1, 0, 'C', 1);
  $pdf->Cell(25, '', 'Verif.', 1, 1, 'C', 1);
  //$pdf->Cell(65, '', 'Comentario', 1, 1, 'C', 1);

  $pdf->SetFont('Arial', '', 8);

  $previousWork = null;

  foreach ($verificationSection->detailJobs as $job) {

    if ($job->activityTypeId != '6') {

      // Se oculpa el letrero rojo que salia de periodo sin descripcion en los pdf
      /*if ($previousWork && VerificationSection::diffTimeIsBiggerThan(
                      $previousWork, $job->startedOn, DetailJob::INACTIVITY_WARNING_DAYS)) {
        $pdf->Cell(18, '', CHtml::encode(substr($previousWork, 0, 10)), 1, 0, 'L');
        $pdf->Cell(18, '', CHtml::encode(substr($job->startedOn, 0, 10)), 1, 0, 'L');
        $pdf->Cell(12, '', VerificationSection::diffTime($previousWork, $job->startedOn), 1, 0, 'L');
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(148, '', 'Periodo sin Descripción por más de ' .
                CHtml::encode(DetailJob::INACTIVITY_WARNING_DAYS) .
                ' días', 1, 0, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, '', '', 0, 1, 'L');
      }*/

      $pdf->Cell(18, '', CHtml::encode(substr($job->startedOn, 0, 10)), 1, 0, 'L');
      $pdf->Cell(18, '', CHtml::encode(substr($job->finishedOn, 0, 10)), 1, 0, 'L');
      $pdf->Cell(12, '', VerificationSection::diffTime($job->startedOn, $job->finishedOn), 1, 0, 'L');
      if ($job->activityTypeId == null || $job->activityTypeId == ActivityType::EMPLOYED || $job->activityTypeId == ActivityType::SELF_EMPLOYED) {
        $pdf->Cell(47, '', CHtml::encode($job->company), 1, 0, 'L');
      } else {
        $pdf->Cell(40, '', CHtml::encode($job->activityType->name), 1, 0, 'L');
      }
      $pdf->Cell(60, '', CHtml::encode($job->lastPosition), 1, 0, 'L');
      $pdf->Cell(16, '', CHtml::encode(Controller::stringYesNo($job->stillWorking)), 1, 0, 'L');
      $pdf->Cell(25, '', CHtml::encode($job->verificationResult->name), 1, 0, 'L');
    //  $pdf->Cell(65, '', CHtml::encode($job->comments), 1, 0, 'L');
      $pdf->Cell(0, '', '', 0, 1, 'L');

      $previousWork = $job->finishedOn;
    }
  }

  // Se oculpa el letrero rojo que salia de periodo sin descripcion en los pdf
  /*if ($previousWork
          && !$job->stillWorking
          && VerificationSection::diffTimeIsBiggerThan(
                  $previousWork, "now", DetailJob::INACTIVITY_WARNING_DAYS)) {
    $now = new DateTime("now");
    $pdf->Cell(12, '', CHtml::encode(substr($previousWork, 0, 7)), 1, 0, 'L');
    $pdf->Cell(12, '', CHtml::encode(substr($now->format("Y-m"), 0, 7)), 1, 0, 'L');
  //  $pdf->Cell(12, '', VerificationSection::diffTime($previousWork, "now"), 1, 0, 'L');
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(148, '', 'Periodo sin Descripción por más de ' .
            CHtml::encode(DetailJob::INACTIVITY_WARNING_DAYS) .
            ' días', 1, 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, '', '', 0, 1, 'L');
  }*/


  // Detail


  $pdf->SetFont('Arial', '', 10);
  $pdf->SetFillColor(220);


  foreach ($verificationSection->detailJobs as $job) {
    if ($job->activityTypeId != '6') {
      $pdf->SetFont('Arial', '', 10);
      $pdf->Cell(0, '', '', 0, 1, 'L');
      $pdf->Cell(0, '', "", 0, 1, 'L');
      $pdf->Cell(15, '', 'Inicio', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->startedOn), 1, 0, 'L');
      $pdf->Cell(15, '', 'Fin', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->finishedOn), 1, 0, 'L');
      $pdf->Cell(12, '', 'Dur.', 1, 0, 'L', 1);
      $pdf->Cell(16, '', VerificationSection::diffTime($job->startedOn, $job->finishedOn), 1, 0, 'L');

      if ($job->activityTypeId == null || $job->activityTypeId == ActivityType::EMPLOYED || $job->activityTypeId == ActivityType::SELF_EMPLOYED) {
        $pdf->Cell(22, '', 'Compañía', 1, 0, 'L', 1);
        $pdf->Cell(76, '', CHtml::encode($job->company), 1, 1, 'L');
      } else {
        $pdf->Cell(98, '', CHtml::encode($job->activityType->name), 1, 1, 'L', 1);
      }

      $pdf->Cell(30, '', 'Continúa trabajando', 1, 0, 'L', 1);
      $pdf->Cell(10, '', CHtml::encode(Controller::stringYesNo($job->stillWorking)), 1, 0, 'L');
      $pdf->Cell(25, '', 'Tipo de Contrato', 1, 0, 'L', 1);
      $pdf->Cell(33, '', CHtml::encode($job->contractType), 1, 0, 'L');
      $pdf->Cell(22, '', 'Última posición', 1, 0, 'L', 1);
      $pdf->Cell(76, '', CHtml::encode($job->lastPosition), 1, 1, 'L');

      $pdf->Cell(22, '', 'País', 1, 0, 'L', 1);
      $pdf->Cell(34, '', CHtml::encode($job->country), 1, 0, 'L');
      $pdf->Cell(12, '', 'Ciudad', 1, 0, 'L', 1);
      $pdf->Cell(30, '', CHtml::encode($job->city), 1, 0, 'L');
      $pdf->Cell(10, '', 'Tels', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->tel), 1, 0, 'L');
      $pdf->Cell(18, '', 'Contacto', 1, 0, 'L', 1);
      $pdf->Cell(50, '', CHtml::encode($job->nameOfContact), 1, 1, 'L');

      $pdf->Cell(22, '', 'Cargo de Contacto', 1, 0, 'L', 1);
      $pdf->Cell(174, '', CHtml::encode($job->contactPosition), 1, 1, 'L');

      if ($job->workDetail != 'No aplica') {
        $pdf->Cell(22, '', 'Funciones', 1, 0, 'L', 1);
        $pdf->MultiCell(174, '', CHtml::encode($job->workDetail), 1, 'J', false, true);
      }

      $pdf->Cell(22, '', 'Motivo del Retiro', 1, 0, 'L', 1);
      $pdf->MultiCell(174, '', CHtml::encode($job->retireReason), 1, 'J', false, true);

      if ($job->bossInmediateContact == '1') {
        $pdf->Cell(22, '', 'Jefe inmediato', 1, 0, 'L', 1);
        $pdf->MultiCell(174, '', CHtml::encode($job->immediateBoss), 1, 'J', false, true);

        $pdf->Cell(22, '', 'Contacto jefe', 1, 0, 'L', 1);
        $pdf->MultiCell(174, '', CHtml::encode($job->immediateBossContact), 1, 'J', false, true);
      }
    
      if($verificationSection->backgroundCheck->customer->quantitativeEvaluation==1){ 
        $pdf->Cell(22, '', 'Aportó Certificado', 1, 0, 'L', 1);
        $pdf->MultiCell(174, '',CHtml::encode(Controller::stringYesNo($job->providedCertificate)), 1, 'J', false, true);
      
        $pdf->Cell(22, '', 'HV Congruente', 1, 0, 'L', 1);
        $pdf->MultiCell(174, '', CHtml::encode(Controller::stringYesNo($job->congruentResume)), 1, 'J', false, true);
        
        $pdf->Cell(22, '', 'Hist. Pensional', 1, 0, 'L', 1);
        $pdf->MultiCell(174, '',CHtml::encode(Controller::stringYesNo($job->historicPension)), 1, 'J', false, true);
      }//else{
        if ($job->bossInmediateContact == '1') {
          $pdf->Cell(22, '', 'Fortalezas', 1, 0, 'L', 1);
          $pdf->MultiCell(174, '', CHtml::encode($job->strenghts), 1, 'J', false, true);
        
          $pdf->Cell(22, '', 'Debilidades', 1, 0, 'L', 1);
          $pdf->MultiCell(174, '', CHtml::encode($job->weaknesses), 1, 'J', false, true);
        }
     //}
      if ($job->bossInmediateContact == '1') {
        $pdf->Cell(70, '', 'Lo contrataría nuevamente', 1, 0, 'L', 1);
        $pdf->Cell(28, '', CHtml::encode($job->wouldYouContractAgain), 1, 0, 'L');
      
        $pdf->Cell(30, '', 'Lo recomendaría', 1, 0, 'L', 1);
        $pdf->Cell(68, '', CHtml::encode($job->wouldYouRecomend), 1, 1, 'L');
     }

      if($verificationSection->backgroundCheck->customer->salaryEarnedCust==1){ 
        $pdf->Cell(30, '', 'Salario Devengado', 1, 0, 'L', 1);      
        $pdf->Cell(40, '', CHtml::encode($job->salaryEarned), 1, 0, 'L');
        }
      $pdf->Cell(28, '', 'Resultado', 1, 0, 'L', 1);
      $pdf->Cell(30, '', CHtml::encode($job->verificationResult->name), 1, 0, 'L');
      $pdf->Cell(25, '', 'Verificado En', 1, 0, 'L', 1);
      $pdf->Cell(20, '', CHtml::encode($job->verifiedOn), 1, 1, 'L');


      $pdf->Cell(25, '', 'Comentarios', 1, 0, 'L', 1);
      $pdf->MultiCell(171, '', CHtml::encode($job->comments), 1, 'J', FALSE, TRUE);
      if($verificationSection->backgroundCheck->customer->quantitativeEvaluation==1){     

        $pdf->SetFillColor(153, 204, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, '', 'EVALUACIÓN CUANTITATIVA Y CUALITATIVA', 1, 1, 'C', 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(196, '', 'De acuerdo con lo que usted observó en los comportamientos de '.$verificationSection->backgroundCheck->firstName." ".$verificationSection->backgroundCheck->lastName.' ¿Cómo calificaría cada una de las siguientes competencias? Siendo:
        0 = No sabe, no responde.
        5 = Su máximo potencial para el cargo que ocupó.', 1, 'J', FALSE, TRUE);  
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220);
        $pdf->Cell(41.2, '', 'Solución de Problemas', 1, 0, 'C', 1);
        $pdf->Cell(30.2, '', 'Puntualidad', 1, 0, 'C', 1);
        $pdf->Cell(39.2, '', 'Trabajo en Equipo', 1, 0, 'C', 1);
        $pdf->Cell(46.2, '', 'Orientación a Resultados', 1, 0, 'C', 1);
        $pdf->Cell(39.2, '', 'Adaptabilidad', 1, 1, 'C', 1);
      
        $pdf->SetFont('Arial', '', 10);
      
        for( $i=0; $i<=5; $i++ ){    
            $html='<table border="1" >';
            $html.='<tr>';  
        
          if ($i==CHtml::encode($job->problemSolving)){
            if (CHtml::encode($job->problemSolving=='0')){
              $html.='<td width="165" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->problemSolving=='1') || CHtml::encode($job->problemSolving=='2') || CHtml::encode($job->problemSolving=='3')){
              $html.='<td width="165" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->problemSolving=='4') || CHtml::encode($job->problemSolving=='5')){
              $html.='<td width="165" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            }     
          }else{
            $html.='<td width="165" height="30" align="CENTER">'.$i.'';  
          }
          $html.='</td>';
          if ($i==CHtml::encode($job->leadership)){
            if (CHtml::encode($job->leadership=='0')){
              $html.='<td width="120.5" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->leadership=='1') || CHtml::encode($job->leadership=='2') || CHtml::encode($job->leadership=='3')){
              $html.='<td width="120.5" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->leadership=='4') || CHtml::encode($job->leadership=='5')){
              $html.='<td width="120.5" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            }      
          }else{
            $html.='<td width="120.5" height="30" align="CENTER">'.$i.'';  
          }
          $html.='</td>';
          if ($i==CHtml::encode($job->teamWork)){
            if (CHtml::encode($job->teamWork=='0')){
              $html.='<td width="157" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->teamWork=='1') || CHtml::encode($job->teamWork=='2') || CHtml::encode($job->teamWork=='3')){
              $html.='<td width="157" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->teamWork=='4') || CHtml::encode($job->teamWork=='5')){
              $html.='<td width="157" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            } 
            
          }else{
            $html.='<td width="157" height="30" align="CENTER">'.$i.'';  
          } 
          $html.='</td>';
          if ($i==CHtml::encode($job->orientationtoResults)){
            if (CHtml::encode($job->orientationtoResults=='0')){
              $html.='<td width="185" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->orientationtoResults=='1') || CHtml::encode($job->orientationtoResults=='2') || CHtml::encode($job->orientationtoResults=='3')){
              $html.='<td width="185" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->orientationtoResults=='4') || CHtml::encode($job->orientationtoResults=='5')){
              $html.='<td width="185" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            } 
            
          }else{
            $html.='<td width="185" height="30" align="CENTER">'.$i.'';  
          } 
          $html.='</td>';
          if ($i==CHtml::encode($job->adaptability)){
            if (CHtml::encode($job->adaptability=='0')){
              $html.='<td width="156.5" height="30" bgcolor="#FFE4B5" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->adaptability=='1') || CHtml::encode($job->adaptability=='2') || CHtml::encode($job->adaptability=='3')){
              $html.='<td width="156.5" height="30" bgcolor="#FFC0CB" align="CENTER">'.$i.'';
            }elseif(CHtml::encode($job->adaptability=='4') || CHtml::encode($job->adaptability=='5')){
              $html.='<td width="156.5" height="30" bgcolor="#90EE90" align="CENTER">'.$i.'';
            } 
            
          }else{
            $html.='<td width="156.5" height="30" align="CENTER">'.$i.'';  
          } 
          $html.='</td>';
          $html.='</tr></table>';
        
          $pdf->WriteHTML($html);$pdf->SetFillColor(220);
        }
        }
      }
    }
    $pdf->Cell(0, '', '', 0, 1, 'L');
    $pdf->SetFillColor(255);
}