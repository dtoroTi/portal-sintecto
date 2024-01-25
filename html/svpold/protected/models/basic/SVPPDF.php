<?php

Yii::import('application.extensions.fpdf.*');
Yii::import('application.extensions.fpdi.*');
Yii::import('application.extensions.fpdf_tpl.*');

//require('FPDI_Protection.php');

require_once('fpdf.php');
require_once('fpdi.php');


/* * **************************************************************************
 * Software: FPDF_Protection                                                 *
 * Version:  1.03                                                            *
 * Date:     2009-11-29                                                      *
 * Author:   Klemen VODOPIVEC                                                *
 * License:  FPDF                                                            *
 *                                                                           *
 * Thanks:  Cpdf (http://www.ros.co.nz/pdf) was my working sample of how to  *
 *          implement protection in pdf.                                     *
 * Source:  http://www.fpdf.org/en/script/script37.php
 * ************************************************************************** */

//if (function_exists('mcrypt_encrypt')) {
//
function RC4($key, $data) {
    return mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $data, MCRYPT_MODE_STREAM, '');
}

class SVPPDF extends FPDI {

    const IMAGE_MAX_WIDTH = 741;
    const LINE_MAX_WIDTH = 196;

    public $backgroundCheck = null;
    public $controller = null;
    public $defaultHeight = 5;
    public $printHeader = true;
    public $waterMark = '';
    public $footerMark = '';
    private $_fontSize = 0;
    private $_fontFamily = 0;
    private $_fontStyle = 0;
    private $_fontArray = array();
    private $angle = 0;
    private $sysCommands = array(
        'dateOrigin' => '',
    );
    private $commandAnswers = array();
    static private $allowedCommands = array(
        '__s' => array(
            'fullName' => true,
            'code' => true,
            'customerFields' => true,
            'actualJob' => true,
            'applyToPosition' => true,
            'birthday' => true,
            'age' => true,
            'relationshipStatus->name' => true,
            'customer->name' => true,
            'formatedIdNumber' => true,
            'customerProduct->name' => true,
            'customerUser->name' => true,
            'evaluationResult' => true,
            'evaluationValue' => true,
        ),
        '__pdf' => array(
            'PageNo()' => true,
            'getImagePath()' => true,
        ),
    );
    // For Protection
    var $encrypted = false;  //whether document is protected
    var $Uvalue;             //U entry in pdf document
    var $Ovalue;             //O entry in pdf document
    var $Pvalue;             //P entry in pdf document
    var $enc_obj_id;         //encryption object id

// Page header

    function getImagePath() {
        return (Yii::app()->basePath . '/images/');
    }

    function SVPPDF($backgroundCheck, $controller = null) {
        $this->backgroundCheck = $backgroundCheck;
        $this->controller = $controller;
        parent::FPDF('P', 'mm', 'Letter');
        $this->AliasNbPages();
        parent::SetFont('Arial', '', 10);
    }

    function SetFont($family, $style = '', $size = 0) {
        $this->_fontSize = $size;
        $this->_fontFamily = $family;
        $this->_fontStyle = $style;
        parent::SetFont($family, $style, $size);
    }

    function SetFontSize($size) {
        $this->_fontSize = $size;
        parent::SetFontSize($size);
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

    function Header() {
        $this->pushFont();
        if ($this->printHeader) {
            // Logo
            //$this->Image(Yii::app()->basePath . '/images/syv_logo.png', 10, 6);
            $this->Image(Yii::app()->basePath . '/images/sintecto_logo.png', 10, 6);
            // Title
            $this->SetFillColor(255);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(196, 0, 'VERIFICACIÓN DE LAS CONDICIONES DE SEGURIDAD DE PERSONAS', 0, 1, 'C');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 10, 'Nombre: ' . $this->backgroundCheck->fullName . ' [Ref:' . $this->backgroundCheck->code . "]", 0, 1, 'C');
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

    function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '') {
        $this->pushFont();
        // Redifined to accept UFT
        $txt=CHtml::decode($txt);
        $width = parent::GetStringWidth($txt);
        $size = $this->_fontSize;
        $newSize = $size;
        while (($width + 1) > $w && $w != 0) {
            $newSize--;
            $this->SetFontSize($newSize);
            $width = parent::GetStringWidth($txt);
        }
        if ($h === null || $h === '') {
            $h = $this->defaultHeight;
        } else if ($h[0] === '*') {
            $times = substr($h, 1);
            $h = $this->defaultHeight * (int) $times;
        } else if ($h[0] === '+') {
            $times = substr($h, 1);
            $h = $this->defaultHeight + (int) $times;
        }
        parent::Cell($w, $h, mb_convert_encoding($txt, 'ISO-8859-1', 'UTF8'), $border, $ln, $align, $fill, $link);

        $this->popFont();
    }

    function MultiCell($w, $h, $txt, $border = 0, $align = 'J', $fill = false, $ln = FALSE) {
        $this->pushFont();
        $x = $this->GetX();
        $y = $this->GetY();

//    parent::MultiCell($w, NULL, $txt, 0, $align, $fill);
//
//    $this->SetXY($x, $y);
//    parent::MultiCell($w, $h, "", $border, $align, $fill);
        $txt=CHtml::decode($txt);
        parent::MultiCell($w, null, $txt, $border, $align, $fill);

        if (!$ln) {
            $this->SetXY($x + $w, $y);
        }
        $this->popFont();
    }

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle*=M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    static function imageMaxWidth($isLandscape = 0) {
        return ($isLandscape == 1 ? 260 / 196 * SVPPDF::IMAGE_MAX_WIDTH : SVPPDF::IMAGE_MAX_WIDTH);
    }

    /**
     * Function to set permissions as well as user and owner passwords
     *
     * - permissions is an array with values taken from the following list:
     *   copy, print, modify, annot-forms
     *   If a value is present it means that the permission is granted
     * - If a user password is set, user will be prompted before document is opened
     * - If an owner password is set, document can be opened in privilege mode with no
     *   restriction if that password is entered
     */
    function SetProtection($permissions = array(), $user_pass = '', $owner_pass = null) {
        $options = array('print' => 4, 'modify' => 8, 'copy' => 16, 'annot-forms' => 32);
        $protection = 192;
        foreach ($permissions as $permission) {
            if (!isset($options[$permission]))
                $this->Error('Incorrect permission: ' . $permission);
            $protection += $options[$permission];
        }
        if ($owner_pass === null)
            $owner_pass = uniqid(rand());
        $this->encrypted = true;
        $this->padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08" .
                "\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";
        $this->_generateencryptionkey($user_pass, $owner_pass, $protection);
    }

    /*     * **************************************************************************
     *                                                                           *
     *                              Private methods                              *
     *                                                                           *
     * ************************************************************************** */

    function _putstream($s) {
        if ($this->encrypted) {
            $s = RC4($this->_objectkey($this->n), $s);
        }
        parent::_putstream($s);
    }

    function _textstring($s) {
        if ($this->encrypted) {
            $s = RC4($this->_objectkey($this->n), $s);
        }
        return parent::_textstring($s);
    }

    /**
     * Compute key depending on object number where the encrypted data is stored
     */
    function _objectkey($n) {
        return substr($this->_md5_16($this->encryption_key . pack('VXxx', $n)), 0, 10);
    }

    function _putresources() {
        parent::_putresources();
        if ($this->encrypted) {
            $this->_newobj();
            $this->enc_obj_id = $this->n;
            $this->_out('<<');
            $this->_putencryption();
            $this->_out('>>');
            $this->_out('endobj');
        }
    }

    function _putencryption() {
        $this->_out('/Filter /Standard');
        $this->_out('/V 1');
        $this->_out('/R 2');
        $this->_out('/O (' . $this->_escape($this->Ovalue) . ')');
        $this->_out('/U (' . $this->_escape($this->Uvalue) . ')');
        $this->_out('/P ' . $this->Pvalue);
    }

    function _puttrailer() {
        parent::_puttrailer();
        if ($this->encrypted) {
            $this->_out('/Encrypt ' . $this->enc_obj_id . ' 0 R');
            $id = isset($this->fileidentifier) ? $this->fileidentifier : '';
            $this->_out('/ID [<' . $id . '><' . $id . '>]');
//      $this->_out('/ID [()()]');
        }
    }

    /**
     * Get MD5 as binary string
     */
    function _md5_16($string) {
        return pack('H*', md5($string));
    }

    /**
     * Compute O value
     */
    function _Ovalue($user_pass, $owner_pass) {
        $tmp = $this->_md5_16($owner_pass);
        $owner_RC4_key = substr($tmp, 0, 5);
        return RC4($owner_RC4_key, $user_pass);
    }

    /**
     * Compute U value
     */
    function _Uvalue() {
        return RC4($this->encryption_key, $this->padding);
    }

    /**
     * Compute encryption key
     */
    function _generateencryptionkey($user_pass, $owner_pass, $protection) {
        // Pad passwords
        $user_pass = substr($user_pass . $this->padding, 0, 32);
        $owner_pass = substr($owner_pass . $this->padding, 0, 32);
        // Compute O value
        $this->Ovalue = $this->_Ovalue($user_pass, $owner_pass);
        // Compute encyption key
        $tmp = $this->_md5_16($user_pass . $this->Ovalue . chr($protection) . "\xFF\xFF\xFF");
        $this->encryption_key = substr($tmp, 0, 5);
        // Compute U value
        $this->Uvalue = $this->_Uvalue();
        // Compute P value
        $this->Pvalue = -(($protection ^ 255) + 1);
    }

    function checkNewPage($maxY = 230) {
        if ($this->GetY() > $maxY) {
            $this->AddPage();
        }
    }

    function replaceCommand($matches) {
        $ans = $matches[0];
        if (count($matches) == 4) {
            if (isset(SVPPDF::$allowedCommands[$matches[1]][$matches[3]])) {
                $function = (string) $matches[3];
                switch ($matches[1]) {
                    case '__s':
                        eval('$ans = $this->backgroundCheck->' . $function . ';');
                        break;
                    case '__pdf':
                        eval('$ans = $this->' . $function . ';');
                        break;
                }
            }
        } else {
            
        }
        return $ans;
    }

    function evaluateStr($str) {
        return (preg_replace_callback('/{(\_\_[^\-]*)(->)([^}]*)}/', array($this, 'replaceCommand'), $str));
    }

    function formatTxt($command, $txt) {
        $format = (string) $command['format'];
        if ($command['noPrintIf'] && $command['noPrintIf'] == $txt) {
            $txt = '';
        } else if ($format == "money") {
            $txt = '$' . number_format((int) $txt, 0);
        } else {
            if ($format != '') {
                $txt = sprintf($format, $txt);
            }
        }
        return $txt;
    }

    function commandPdf($command) {


        if ((string) $command['var'] != '') {
            $var = (string) $command['var'];
            $txt = @$this->commandAnswers[$var];
        } elseif ((string) $command['txt'] != '') {
            $txt = @$this->evaluateStr((string) $command['txt']);
        } else {
            $txt = (string) $command['txt'];
        }

        $txt = $this->formatTxt($command, $txt);

        switch ($command['type']) {
            case ('Cell'):
                $this->Cell((string) $command['width'], (string) $command['height'], $txt, (string) $command['border'], (string) $command['newLine'], (string) $command['align'], (string) $command['fill']);
                break;
            case ('MultiCell'):
                $this->MultiCell((string) $command['width'], (string) $command['height'], $txt, (string) $command['border'], (string) $command['align'], (string) $command['fill'], (string) $command['newLine']);
                break;
            case ('SetFillColor'):
                $this->SetFillColor((string) $command['r'], (string) $command['g'], (string) $command['b']);
                break;
            case ('SetTextColor'):
                $this->SetTextColor((string) $command['r'], (string) $command['g'], (string) $command['b']);
                break;
            case ('SetFont'):
                $this->SetFont((string) $command['font'], (string) $command['style'], (string) $command['size']);
                break;
            case ('SetX'):
                $this->SetX((int) $command['x']);
                break;
            case ('SetY'):
                $this->SetY((int) $command['y']);
                break;
            case ('Image'):
                $this->Image($this->evaluateStr((string) $command['filename']), (string) $command['x'], (string) $command['y']);
                break;
            case ('Ln'):
                $this->Ln((string) $command['qty']);
                break;
            case ('AddPage'):
                $this->AddPage();
                break;
            case ('Sections'):
                $this->Sections($command);
                break;
            case ('Documents'):
                $this->Documents($command);
                break;
            case ('AssignedPersonSignature'):
                $this->AssignedPersonSignature($command);
                break;

            default:
        }
    }

    function commandAssignVar($command) {
        if ((string) $command['var'] != '') {
            $varName = (string) $command['var'];
            // Remove whitespaces
//            $equation = preg_replace('/\s+/', '',  (string) $command);
            $equation = (string) $command;

            $number = '(?:-?\d+(?:[,.]\d+)?|pi|π)'; // What is a number
            $functions = '(?:sinh?|cosh?|tanh?|abs|acosh?|asinh?|atanh?|exp|log10|deg2rad|rad2deg|sqrt|ceil|floor|round)'; // Allowed PHP functions
            $operators = '[+\/*\^%-\.]'; // Allowed math operators
            $localVars = '{{([_a-zA-Z][_a-zA-Z0-9]*)}}'; // Allowed math operators
            $strings = '\"[^\"]*"'; // Allowed math operators
            $regexp = '/^(((\s*)|' . $localVars . '|' . $strings . '|' . $number . '|' . $functions . '\s*\((?1)+\)|\((?1)+\))(?:' . $operators . '(?1))?)+$/'; // Final regexp, heavily using recursive patterns

            if (preg_match($regexp, $equation)) {
                $equation = preg_replace('!pi|π!', 'pi()', $equation); // Replace pi with pi function
                $equation = preg_replace('/' . $localVars . '/', '$this->commandAnswers["$1"]', $equation); // Replace pi with pi function
                @eval('$this->commandAnswers["' . $varName . '"] = ' . $equation . ';');
            } else {
                $this->commandAnswers[$varName] = "Error";
            }
        }
    }

    function commands($commands, $answers = null, $verificationSection = null) {
        $this->commandAnswers = $answers;
        
        foreach ($commands->children() as $commandType => $command) {
            switch ($commandType) {
                case 'pdf':
                    $this->commandPdf($command);
                    break;
                case 'assignVar':
                    $this->commandAssignVar($command);
                    break;
            }
        }
        
    }

    protected function AssignedPersonSignature($command) {
        // Signature
        $this->Cell(0, '*4', "", 0, 1, 'L');

        $this->Cell(20, '', "", 0, 0, 'L', 0);

        $responsible = $this->backgroundCheck->responsible;


        if ($responsible && $responsible->user->signature) {
            $imageFile = $responsible->user->signature->getImageFileSized(460, 120);
            $x = $this->getX();
            $y = $this->getY();
            $imageSize = getimagesize($imageFile);
            if ($imageSize[0] < 460) {
                $xdif = 0.5 + 460 / $imageSize[0] * 8;
            } else {
                $xdif = 0.5;
            }
            $imageSize = getimagesize($imageFile);
            $this->Image($imageFile, $x + $xdif, $y - 17, -180);
            unlink($imageFile);
            $this->setXY($x, $y);
        }


        $this->Cell(66, '', ($responsible ? $responsible->user->name : 'PENDIENTE DE ASIGNACION'), "T", 0, 'C', 0);
        $this->Cell(20, '', "", 0, 0, 'L', 0);

        if (!($this->backgroundCheck->responsible && $this->backgroundCheck->approved &&
                $this->backgroundCheck->responsible->user->id == $this->backgroundCheck->approved->id)) {

            if ($this->backgroundCheck->approved && $this->backgroundCheck->approved->signature) {
                $imageFile = $this->backgroundCheck->approved->signature->getImageFileSized(460, 120);
                $x = $this->getX();
                $y = $this->getY();
                $imageSize = getimagesize($imageFile);
                if ($imageSize[0] < 460) {
                    $xdif = 0.5 + 460 / $imageSize[0] * 8;
                } else {
                    $xdif = 0.5;
                }
                $this->Image($imageFile, $x + $xdif, $y - 17, -180);
                unlink($imageFile);
                $this->setXY($x, $y);
            }

            $this->Cell(66, '', ($this->backgroundCheck->approved ? $this->backgroundCheck->approved->name : 'PENDIENTE DE APROBACIÓN'), "T", 1, 'C', 0);
        }
    }

    protected function Sections($command) {
        if (!empty($this->controller)) {
            foreach ($this->backgroundCheck->verificationSections as $verificationSection) {
                /* @var $command array */
                if (empty($command['name']) || ((string) $command['name'] === $verificationSection->verificationSectionType->name )) {
                    $this->controller->renderPartial('/verificationSection/_verificationSectionPDF', array(
                        'verificationSection' => $verificationSection,
                        'height' => '',
                        'pdf' => $this,
                            )
                    );
                }
            }
        }
    }

    protected function Documents($command) {
        if (!empty($this->controller)) {
            if (empty($command['name'])) {
                $this->controller->renderPartial('/document/_documentsPDF', array(
                    'backgroundCheck' => $this->backgroundCheck,
                    'height' => '',
                    'documents' => $this->backgroundCheck->documents,
                    'pdf' => $this,
                        )
                );
            } else {
                $headerHeight = 20;
                $pageMaxWidth = SVPPDF::imageMaxWidth();
                foreach ($this->backgroundCheck->documents as $file) {
                    if ($file->name == (string) $command['name']) {
                        try {
                            if ($file->isImage && $file->imageSizeId && $file->imageSizeId != ImageSize::FRONT_PAGE) {

                                $imageFile = $file->getTemporalSizedImageWithSize((int) $command['width'], (int) $command['height']);
                                $imageSize = getimagesize($imageFile);

                                $x = $this->getX();
                                $y = $this->getY();

                                if ((float) $command['x'] != 0) {
                                    $x = (float) $command['x'];
                                }
                                if ((float) $command['y'] != 0) {
                                    $y = (float) $command['y'];
                                }

                                if ($y > 120) {
                                    $this->addPage();
                                    $y = $headerHeight;
                                }
                                $this->Image($imageFile, $x, $y);

                                if ($command['newLine'] == '' || $command['newLine'] == 1) {
                                    $y = $y + ($imageSize[1] + 10 ) * 196 / $pageMaxWidth;
                                    $x = 10;
                                } else {
                                    $x = $x + ($imageSize[0] ) * 196 / $pageMaxWidth;
                                }

                                $this->SetXY($x, $y);

                                unlink($imageFile);
                            } else if ($file->isPDF) {

                                $thisFile = $file->temporalRawFile;
                                if (file_exists($thisFile)) {
                                    $pagecount = $this->setSourceFile($thisFile);
                                    for ($i = 1; $i <= $pagecount; $i++) {
                                        $tplidx = $this->importPage($i, '/MediaBox');
                                        $this->addPage();
                                        $this->useTemplate($tplidx, 10, $headerHeight, 196);
                                    }
                                    unlink($thisFile);
                                }
                                $this->SetX(40);
                                $this->SetY(210);
                            }
                        } catch (Exception $e) {
                            Yii::log("The file [{$file->name}] of Study code {$this->backgroundCheck->code} has a problem. {$e->getMessage()}", "error", "ZWF." . __CLASS__);
                        }
                    }
                }
            }
        }
    }

}
