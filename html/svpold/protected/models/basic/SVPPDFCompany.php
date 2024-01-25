<?php
class SVPPDFCompany extends SVPPDF {
  function Header() {
    $this->pushFont();
    if ($this->printHeader) {
      $customer = Customer::model()->findByPk((int)$this->backgroundCheck->customerId);
      // Logo Izquierda (Empresa emisora de la evaluación)
      if ( isset($customer->id) &&
        $customer->id == 1    ||   // TEST COMPANY
        $customer->id == 546  ||   // CLARO
        $customer->id == 525  ||   // PRODECO
        $customer->id == 529  ||   // PRODECO
        $customer->id == 544  ||     // UNIANDES
        $customer->id == 544  ||  // ENLACE
        $customer->id == 617  ||    // LEWIS ENERGY
        $customer->id == 549  ||    // PAR Servicios Integrales S A Cumplimiento
        $customer->id == 648  ||   // RCN
        $customer->id == 698       //Almaviva
      ) {
          $this->Image(Yii::app()->basePath . '/images/par_logo2.png',  $this->w - 207, $this->GetY() - 5, 30, 15);
      } else if(
        isset($customer->id) &&
        $customer->id == 721  // 3+ Security Colombia Ltda
        ){
          $this->Image(Yii::app()->basePath . '/images/3+security_log.png',  $this->w - 207, $this->GetY() - 5, 40, 15);
      }else if(
        $this->backgroundCheck->customerProductId == 2589 // PRODUCTO ENLACE
        ){
          $this->Image(Yii::app()->basePath . '/images/par_logo2.png',  $this->w - 207, $this->GetY() - 5, 30, 15);
      } 
      
      else{
        $this->Image(Yii::app()->basePath . '/images/sintecto_logo.png', 10, 6);
      }

      

      // Logo derecha (Cliente)
      if(isset($customer->logo) && $customer->logo != NULL){
        $this->Cell(50, 20, 
          $this->Image(Yii::app()->basePath . '/../files/logo/' . $customer->logo, 
            $this->w - 25, $this->GetY() - 5, 15, 15));
      } else if (
        $customer->id == 1    || // TEST COMPANY
        $customer->id == 546     // CLARO
        ) {
        $this->Image(Yii::app()->basePath . '/images/claro_logo.png', 
          $this->w - 25, $this->GetY() - 5, 15, 15);
      } else if (
        $customer->id == 525  ||   // PRODECO
        $customer->id == 529       // PRODECO
      ) {
        $this->Image(Yii::app()->basePath . '/images/prodeco_logo.png', 
          $this->w - 45, $this->GetY() - 5, 37, 12);
      } else if (
          $customer->id == 648   // RCN
      ) {
          $this->Image(Yii::app()->basePath . '/images/CanalRCN.png',
              $this->w - 30, $this->GetY() - 5, 20, 15);
      } else if (
        $customer->id == 544      // UNIANDES
      ) {
        $this->Image(Yii::app()->basePath . '/images/uniandes_logo.png', 
        $this->w - 45, $this->GetY() - 5, 37, 12);
      } else if(
        $this->backgroundCheck->customerProductId == 2589
      ) {
        $this->Image(Yii::app()->basePath . '/images/enlace_logo.jpeg', 
        $this->w - 45, $this->GetY() - 5, 37, 15);
      } else if(
          $customer->id == 698  //Almaviva
      ) {
          $this->Image(Yii::app()->basePath . '/images/Almaviva.jpeg',
              $this->w - 45, $this->GetY() - 5, 37, 15);
      } else {
        $this->Cell(50, 20, '', 0, 1, 'C', 0);
      }

      // Title
      $this->SetFillColor(255);
      $this->SetY(9);
      $this->SetTextColor(57, 120, 162);
      $this->SetFont('Arial', 'B', 9);
      $this->Cell(171, 0, 'DOCUMENTO CONFIDENCIAL', 0, 1, 'C');
      $this->SetY(13);
      $this->SetFont('Arial', 'B', 12);
      $this->SetTextColor(0, 0, 0);

      if ( isset($customer->id) &&
        $customer->id == 1    ||   // TEST COMPANY
        $customer->id == 546  ||   // CLARO
        $customer->id == 525  ||   // PRODECO
        $customer->id == 529       // PRODECO
      ) {
        $this->Cell(171, 0, $this->backgroundCheck->customerProduct->name , 0, 1, 'C');
      } else {
        $this->Cell(171, 0, 'INFORME DE EVALUACIÓN DE EMPRESA', 0, 1, 'C');
      }

      //NOMBRE DEL CLIENTE
      $this->SetY(20);
      $this->SetFont('Arial', 'B', 18);
      $this->SetTextColor(0,66,109);
      $this->Cell(171, 0, trim(mb_strtoupper($this->backgroundCheck->companyName, 'UTF8')), 0, 1, 'C');
      $this->SetFont('Arial', '', 9);
      $this->SetY(12);
      $this->Ln(6);

      /*
      $this->SetY(10);
      $this->SetFont('Arial', 'B', 12);
      $this->SetTextColor(0, 0, 0);
      $this->Cell(171, 0, 'ANÁLISIS DE LA EMPRESA: ' . trim(mb_strtoupper($this->backgroundCheck->companyName, 'UTF8')), 0, 1, 'C');
      $this->SetFont('Arial', '', 10);
      $this->SetY(12);
      $this->Ln(6);
      */
    }
    if ($this->waterMark != '') {
      $this->SetFont('Arial', 'B', 85);
      $this->SetTextColor(230, 230, 230);
      $this->Rotate(45, 55, 190);
      $this->Text(55, 190, $this->waterMark);
      $this->Rotate(0);
      $this->SetTextColor(0, 0, 0);
      $this->SetFont('Arial', '', 10);
    }
    $this->popfont();
    $this->SetY(22);
  }

// Page footer
  function Footer() {
    $this->pushFont();
    if ($this->printHeader) {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      $this->SetTextColor(57, 120, 162);
      $this->SetFont('Arial', 'B', 12);
      $this->Cell(171, 20, 'DOCUMENTO CONFIDENCIAL', 0, 0, 'C');
      $this->SetTextColor(0, 0, 0);
      // Arial italic 8
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      // Page number
      $this->Cell(171, 20, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'R');
      $this->SetFont('Arial', '', 10);
    }
    if ($this->footerMark != '') {
      // Position at 1.5 cm from bottom
      $this->SetY(-18);
      // Arial italic 8
      $this->SetFont('Arial', 'I', 8);
      // Page number
      $this->Cell(0, 20, $this->footerMark, 0, 0, 'C');
      $this->SetFont('Arial', '', 10);
    }
    $this->popFont();
  }

}

