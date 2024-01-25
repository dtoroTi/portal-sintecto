<?php

//Yii::import('application.extensions.tcpdf.*');
//Yii::import('application.extensions.fpdi_1_5_4.*');
//include('/var/www/html/svp/protected/extensions/fpdf/fpdf.php');
require_once(dirname(__FILE__) . '/../../extensions/tcpdf/TCPDF.php');

//require_once(dirname(__FILE__) . '/../../extensions/fpdi_1_5_4/fpdf_tpl.php');
//require_once(dirname(__FILE__) . '/../../extensions/fpdi_1_5_4/fpdi.php');

class CustomerGroupPDF extends \TcPdf\TCPDF
{
    
    var $legends;
    var $wLegend;
    var $sum;
    var $NbVal;

    private $_fontSize = 0;
    private $_fontFamily = 0;
    private $_fontStyle = 0;
    private $_fontArray = array();
    public $from = null;
    public $until =null;
    public $periods = null;
    public $reportDate = null;

    const FILL_COLOR = 0x005288;

//    public $defaultFont = 'aefurat';

    public $defaultFont = 'helvetica';

    public function Header()
    {

        $this->pushFont();
        // Logo
        //$this->Image(Yii::app()->basePath . '/images/syv_logo2.gif', 188, 4, 12);
        $this->Image(Yii::app()->basePath . '/images/sintecto_logo.png', 155, 5);

        // Title

        $this->SetFillColor(255);
        $this->SetFont($this->defaultFont, 'B', 14);
        $this->Ln(20);
        $this->SetTextColor(0, 66, 109);
        $this->Cell(0, 0, 'INFORME DE GESTION', 0, 1, 'C');
        $this->SetFont($this->defaultFont, '', 10);
        //$this->Cell(0, 0, 'Desde ' . $_GET['report_fromDate'] . ' hasta ' . $_GET['report_untilDate'], 0, 1, 'C');
        $this->Cell(0, 0, 'Desde ' . $this->from->format('Y-m-d') . ' hasta ' . $this->until->format('Y-m-d'), 0, 1, 'C');

        // Line break
        $this->Ln(15);
        $this->popFont();
    }

    public function Footer()
    {
        $this->pushFont();
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetFont($this->defaultFont, 'I', 8);
        // Page number

        $this->Cell(40, 20, $this->reportDate, 0, 0, 'L');
        $this->Cell(116, 20, '-- Documento Confidencial --', 0, 0, 'C');
        $this->Cell(40, 20, 'Página ' . $this->PageNo() . '/' . $this->getAliasNbPages(), 0, 0, 'R');
        $this->popFont();
    }

    function pushFont()
    {
        if (!empty($this->_fontFamily)) {
            array_push($this->_fontArray, array(
                'family' => $this->_fontFamily,
                'style' => $this->_fontStyle,
                'size' => $this->_fontSize));
        }
    }

    function popFont()
    {
        if (count($this->_fontArray) > 0) {
            $font = array_pop($this->_fontArray);
            $this->SetFont($font['family'], $font['style'], $font['size']);
        }
    }

    function SetFont($family, $style = '', $size = NULL, $fontfile = '', $subset = 'default', $out = true)
    {
        $this->_fontSize = $size;
        $this->_fontFamily = $family;
        $this->_fontStyle = $style;
        parent::SetFont($family, $style, $size);
    }

    function SetFontSize($size, $out = true)
    {
        $this->_fontSize = $size;
        parent::SetFontSize($size);
    }

    function setDefaultColors()
    {
        /*$this->SetFillColor(39, 108, 153);
        $this->SetDrawColor(0, 82, 136);
        $this->SetTextColor('000');*/

        $this->SetFillColor('215');
        $this->SetDrawColor('215');
        $this->SetTextColor('000');
    }

    function getUntilStr()
    {
        return $this->until->format('Y-m-d') . ' 23:59:59';
    }

    function getFromStr()
    {
        return $this->from->format('Y-m-d') . ' 00:00:00';
    }

    function PieChart($w, $h, $data, $format, $colors=null)
    {
        $this->SetFont('Courier', '', 10);
        $this->SetLegends($data,$format);

        $XPage = $this->GetX();
        $YPage = $this->GetY();
        $margin = 2;
        $hLegend = 5;
        $radius = min($w - $margin * 4 - $hLegend - $this->wLegend, $h - $margin * 2);
        $radius = floor($radius / 2);
        $XDiag = $XPage + $margin + $radius;
        $YDiag = $YPage + $margin + $radius;
        if($colors == null) {
            for($i = 0; $i < $this->NbVal; $i++) {
                $gray = $i * intval(255 / $this->NbVal);
                $colors[$i] = array($gray,$gray,$gray);
            }
        }

        //Sectors
        $this->SetLineWidth(0.2);
        $angleStart = 0;
        $angleEnd = 0;
        $i = 0;
        foreach($data as $val) {
            $angle = ($val * 360) / doubleval($this->sum);
            if ($angle != 0) {
                $angleEnd = $angleStart + $angle;
                $this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
                $this->Sector($XDiag, $YDiag, $radius, $angleStart, $angleEnd);
                $angleStart += $angle;
            }
            $i++;
        }

        //Legends
        $this->SetFont('Courier', '', 10);
        $x1 = $XPage + 2 * $radius + 4 * $margin;
        $x2 = $x1 + $hLegend + $margin;
        $y1 = $YDiag - $radius + (2 * $radius - $this->NbVal*($hLegend + $margin)) / 2;
        for($i=0; $i<$this->NbVal; $i++) {
            $this->SetFillColor($colors[$i][0],$colors[$i][1],$colors[$i][2]);
            $this->Rect($x1, $y1, $hLegend, $hLegend, 'DF');
            $this->SetXY($x2,$y1);
            $this->Cell(0,$hLegend,$this->legends[$i]);
            $y1+=$hLegend + $margin;
        }
    }


// funcion de diagrama de barras
    function BarDiagram($w, $h, $data, $format, $color = null, $maxVal = 0, $nbDiv = 4)
    {
        $hLegend = 5;
        $colorSet=[
            /*[40, 146, 215], 
            [2,119,188], //0277BC --
            [109, 174, 219], 
            [23, 55, 83], 
            [0, 67, 130], //004382 --
            [0, 23, 31]*/
            [184, 218, 255],
            [251, 214, 94],
            [198, 47, 41], 
            [125, 169, 100 ],
            [101, 153, 184],
            [109, 174, 219], 
            ]; //00171F
        $this->SetFont('Courier', '', 10);
        $this->SetLegends($data, $format);

        $XPage = $this->GetX();
        $YPage = $this->GetY();
        $margin = 2;
        $YDiag = $YPage + $margin;
        $hDiag = floor($h - $margin * 2);
        $XDiag = $XPage + $margin * 2 + $this->wLegend;
        $lDiag = floor($w - $margin * 3 - $this->wLegend);
        if ($color == null)
            $color = array(155, 155, 155);
        if ($maxVal == 0) {
            $maxVal = max($data);
        }
        $valIndRepere = ceil($maxVal / $nbDiv);
        $maxVal = $valIndRepere * $nbDiv;
        $lRepere = floor($lDiag / $nbDiv);
        $lDiag = $lRepere * $nbDiv;
        if($maxVal==0)
            $maxVal=1;
        $unit = $lDiag / $maxVal;
        $hBar = floor($hDiag / ($this->NbVal + 1));
        $hDiag = $hBar * ($this->NbVal + 1);
        $eBaton = floor($hBar * 80 / 100);

        $this->SetLineWidth(0.3);
        $this->Rect($XDiag, $YDiag, $lDiag, $hDiag,'n');

        $this->SetFont('helvetica', '', 10);
        //$this->SetFillColor($color[0], $color[1], $color[2]);
        $i = 0;
        foreach ($data as $val) {
            //Bar
            $cinx = $i%sizeof($colorSet);
            $this->SetFillColor($colorSet[$cinx][0], $colorSet[$cinx][1], $colorSet[$cinx][2]);
            $xval = $XDiag;
            $lval = (int)($val * $unit);
            $yval = $YDiag + ($i + 1) * $hBar - $eBaton / 2;
            $hval = $eBaton;
            $this->Rect($xval, $yval, $lval, $hval, 'DF');
            //Legend
            $this->SetXY(0, $yval);
            $this->Cell($xval - $margin, $hval, $this->legends[$i], 0, 0, 'R');
            $i++;
        }

        //Scales
        for ($i = 0; $i <= $nbDiv; $i++) {
            $xpos = $XDiag + $lRepere * $i;
            $this->Line($xpos, $YDiag, $xpos, $YDiag + $hDiag);
            $val = $i * $valIndRepere;
            $xpos = $XDiag + $lRepere * $i - $this->GetStringWidth($val) / 2;
            $ypos = $YDiag + $hDiag - $margin / 5;
            $this->Text($xpos, $ypos, $val);
        }
    }

    function SetLegends($data, $format)
    {
        $this->legends = array();
        $this->wLegend = 0;
        $this->sum = array_sum($data);
        $this->NbVal = count($data);
         foreach ($data as $l => $val) {

                    if($this->sum <1 ){
                        continue;
                    }
                    $p = sprintf('%.2f', $val / $this->sum * 100) . '%';
                    $legend = str_replace(array('%l', '%v', '%p'), array($l, $val, $p), $format);
                    $this->legends[] = $legend;
                    $this->wLegend = max($this->GetStringWidth($legend), $this->wLegend);
                }
            }

        function SetDrawColorIG($r, $g = null, $b = null) {
            // Set color for all stroking operations
            if (($r == 0 && $g == 0 && $b == 0) || $g === null)
                $this->DrawColor = sprintf('%.3F G', $r / 255);
            else
                $this->DrawColor = sprintf('%.3F %.3F %.3F RG', $r / 255, $g / 255, $b / 255);
            if ($this->page > 0)
                $this->_out($this->DrawColor);
        }

        function GenerateRandomColor()
        {
            $color = '#';
            $colorHexLighter = array("9","A","B","C","D","E","F" );
            for($x=0; $x < 6; $x++):
                $color .= $colorHexLighter[array_rand($colorHexLighter, 1)]  ;
            endfor;
            return substr($color, 0, 7);
        }
}


/* @var $dispatches Dispatches[] */

/* @var $this CustomerGroupController */
/* @var $customerGroup CustomerGroup */

$now = new DateTime();

$pdf = new CustomerGroupPDF;

$reportDate= $data = Yii::app()->db->createCommand('select now();')->queryScalar();


$pdf->from = $from;
$pdf->until = $until;
$pdf->periods = $periods;
$pdf->reportDate=$reportDate;

$pdf->SetMargins(10, 25);

$pdf->SetFont($pdf->defaultFont, '', 8);

$pdf->AddPage();
//$pdf->SetDrawColorIG(255);

$pdf->setDefaultColors();


$this->renderPartial('_studiesByCustomer', array(
    'pdf' => $pdf,
    'customerGroup' => $customerGroup,
        )
);


$this->renderPartial('_studiesByProduct', array(
    'pdf' => $pdf,
    'customerGroup' => $customerGroup,
        )
);

$this->renderPartial('_studiesByCustomerCustomerProduct', array(
        'pdf' => $pdf,
        'customerGroup' => $customerGroup,
    )
);

$this->renderPartial('_studiesByResult', array(
    'pdf' => $pdf,
    'customerGroup' => $customerGroup,
        )
);

$this->renderPartial('_studiesByCustomerResult', array(
    'pdf' => $pdf,
    'customerGroup' => $customerGroup,
        )
);

$this->renderPartial('_studiesByEventDelay', array(
    'pdf' => $pdf,
    'customerGroup' => $customerGroup,
        )
);
/*
$this->renderPartial('_studiesCancelled', array(
    'pdf' => $pdf,
    'customerGroup' => $customerGroup,
        )
);


//$this->renderPartial('_studiesInProgressBySection', array(
//    'pdf' => $pdf,
//    'customerGroup' => $customerGroup,
//        )
//);

$this->renderPartial('_studiesInProgress', array(
        'pdf' => $pdf,
        'customerGroup' => $customerGroup,
    )
);
*/

$pdf->Output('customerReport_' . $now->format('Ymd_His') . '.pdf', 'I');
