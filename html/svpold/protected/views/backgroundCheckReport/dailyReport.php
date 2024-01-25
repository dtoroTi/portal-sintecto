<?php
$style = array(
    'table' => 'border-spacing: 0;border-collapse: collapse;padding: 0pt;font:normal 10pt Arial,Helvetica,sans-serif;',
    'trth' => 'border: 1pt solid #00518A;background-color: #00518A;color:white;',
    'thPending' => 'background-color:#95B6C5',
    'th'=> 'border: 1pt solid #00518A;',
    'trtd' => 'border: 1pt solid #00518A;',
    'td' => 'border: 1pt solid #00518A;',
    'tdValue'=>'border: 1pt solid #00518A;text-align: right;', 
    'trTotal'=>'margin-bottom: 0pt;border-bottom: 2pt solid #00518A;font-weight: bold;',
);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body style="font:normal 10pt Arial,Helvetica,sans-serif;">
        <h2>Para uso exclusivo interno</h2>
        <h2>Reporte de Estudios de Security &  Vision</h2>

        <?= $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/customersReport.php', array('report' => $report, 'style' => $style)) ?>
        <?= $this->renderInternal(Yii::app()->basePath . '/views/backgroundCheckReport/usersReport.php', array('report' => $report, 'style' => $style)) ?>

    </body>


</html>