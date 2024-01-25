<?php

namespace TcPdf;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SvpTcPdf
 *
 * @author hsugieta
 */
//Yii::import('application.extensions.tcpdf.*');
//Yii::import('application.extensions.fpdi_1_5_4.*');

require_once(dirname(__FILE__) . '/../extensions/tcpdf/TCPDF.php');
require_once(dirname(__FILE__) . '/../extensions/fpdi_1_5_4/fpdf_tpl.php');
require_once(dirname(__FILE__) . '/../extensions/fpdi_1_5_4/fpdi.php');

class SvpTcPdf extends FPDI {

    public $header = '';
    public $footer = '';
    public $footerOffset = -15;
    private $_searchStr = array('/<span name="(pdf_[a-zA-Z0-9_]+)" style="background-color:#ADD8E6">[a-zA-Z0-9_\#\ \n]*<\/span>/');
    public static $allowedVars = array(
        'pdf_pageNo' => array(
            'name' => 'pdf_pageNo',
            'sample' => '1',
            'menu' => 'Número de Página',
            'description' => 'Número de Página',
            'value' => '$this->getAliasNumPage()',
            'sec' => 'Prod',
        ),
        'pdf_numPages' => array(
            'name' => 'pdf_numPages',
            'sample' => '3',
            'menu' => 'Número total de Páginas',
            'description' => 'Número total de Páginas',
            'value' => '$this->getAliasNbPages()',
            'sec' => 'Prod',
        ),
    );

    private function callbackReplaceVar($matches) {
        if (isset(SvpTcPdf::$allowedVars[$matches[1]])) {
            eval('$ans=' . SvpTcPdf::$allowedVars[$matches[1]]['value'] . ';');
        } else {
            $ans = $matches[0];
        }
        return $ans;
    }

    public function replaceVars($var) {
        return preg_replace_callback(
                $this->_searchStr
                , array($this, 'callbackReplaceVar')
                , $var);
    }

    //Page header
    public function Header() {
        $this->writeHTML($this->replaceVars($this->header));
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY($this->footerOffset);
        $this->writeHTML($this->replaceVars($this->footer));
    }

    function pushFont() {
        if (!empty($this->_fontFamily)) {
            array_push($this->_fontArray, array(
                'family' => $this->_fontFamily,
                'style' => $this->_fontStyle,
                'size' => $this->_fontSize));
        }
    }

    function popFont() {
        if (count($this->_fontArray) > 0) {
            $font = array_pop($this->_fontArray);
            $this->SetFont($font['family'], $font['style'], $font['size']);
        }
    }

    function _putstream($s) {
        $this->_out('stream');
        $this->_out($s);
        $this->_out('endstream');
    }

    function Brainwatermark()
    {
        $this->RotatedImage(dirname(__FILE__) .'/../images/Logo_cerebro.png',180,360,360,180,360);
        //$this->RotatedImage(35,190, $this->Image(Yii::app()->basePath . '/images/Logo_cerebro.png',102,145),45);
    }

    function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        //Image rotated around its upper-left corner
        $this->Rotate($angle,$x,$y);
        //$this->Rotate(360,360,360);
        $this->Image($file,65,53,191,195);
        $this->Rotate(0);
    }
    
}
