<?php

class SVPPDFDynamic extends SVPPDF {

    private $_header = null;
    private $_footer = null;
    public $body = null;
    public $reportXml = null;

    function SVPPDFDynamic($backgroundCheck,$controller=null) {
        parent::SVPPDF($backgroundCheck,$controller);

        $this->reportXml = $backgroundCheck->customerProduct->reportFormatXml;
        if ($this->reportXml->header && $this->reportXml->header[0]) {
            $this->_header = $this->reportXml->header[0];
        }
        if ($this->reportXml->footer && $this->reportXml->footer[0]) {
            $this->_footer = $this->reportXml->footer[0];
        }
        if ($this->reportXml->body && $this->reportXml->body[0]) {
            $this->body = $this->reportXml->body[0];
        }
    }

    function Header() {
        $this->pushFont();

        if ($this->_header) {
            $this->commands($this->_header);
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
        $this->popFont();
    }

// Page footer
    function Footer() {
        $this->pushFont();
        
        if ($this->_footer) {
            $this->commands($this->_footer);
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
