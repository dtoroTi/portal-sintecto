<?php
class SVPPDFPerson extends SVPPDF {


  function Header() {
    $this->pushFont();
    if ($this->printHeader) {
      // Logo
      $this->SetDrawColor(46, 117, 181);
      $this->SetFillColor(255);
      $customer = Customer::model()->findByPk((int)$this->backgroundCheck->customerId);

      if(
        isset($customer->id) &&
        $customer->id == 721  // 3+ Security Colombia Ltda
        ){ $this->Cell(50, 20, 
           $this->Image(Yii::app()->basePath . '/images/3+security_log.png', $this->w - 201, $this->GetY() + 2, 40, 15), 
           1, 0, 'C', 0);
           $this->Multicell(100, 20, "\nVERIFICACIÓN DE LAS CONDICIONES\nDE SEGURIDAD DE PERSONAS\n\n", 1, 'C', 1);

      }else{ $this->Cell(50, 20, 
        $this->Image(Yii::app()->basePath . '/images/sintecto_logo.png', $this->GetX() + 5, $this->GetY() + 5), 
        1, 0, 'C', 0);
      //$this->Cell(100, 20, "VERIFICACIÓN DE LAS CONDICIONES\nDE SEGURIDAD DE PERSONAS", 1, 0, 'C', 1);
      $this->Multicell(100, 20, "\nVERIFICACIÓN DE LAS CONDICIONES\nDE SEGURIDAD DE PERSONAS\n\n", 1, 'C', 1);
    }
      // Logo cliente
      $customer = Customer::model()->findByPk((int)$this->backgroundCheck->customerId);

      if(isset($customer->logo) && $customer->logo != NULL){
        $this->Cell(50, 20, 
          $this->Image(Yii::app()->basePath . '/../files/logo/' . $customer->logo, 
            $this->GetX() + 15, $this->GetY() + 3, 15, 15), 1, 1, 'C', 0);
      } else {
        $this->Cell(50, 20, '', 1, 1, 'C', 0);
      }

      

      
      // Title
      $this->SetFillColor(255);
      $this->SetFont('Arial', 'B', 10);
      //$this->Cell(196, 0, 'VERIFICACIÓN DE LAS CONDICIONES DE SEGURIDAD DE PERSONAS', 0, 1, 'C');
      $this->SetFont('Arial', '', 10);
      //$this->Cell(0, 10, 'Nombre: ' . $this->backgroundCheck->fullName . ' [Ref:' . $this->backgroundCheck->code . "]", 0, 1, 'C');
      // Line break
      $this->Ln(6);
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
  }

// Page footer
  function Footer() {
    $this->pushFont();
    if ($this->printHeader) {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial', 'I', 8);
      // Page number
      $this->Cell(0, 20, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
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

