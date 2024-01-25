<?php

$fp = fopen('php://temp', 'w');

/*
 * Write a header of csv file
 */
$headers = array(
    'Resultado',
    'Ref',
    'No ID',
    'Nombre',
    'Hallazgos',
);

$row = array();
foreach ($headers as $header) {
    if (is_array($header)) {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header['header']);
    } else {
        $row[] = BackgroundCheck::model()->getAttributeLabel($header);
    }
}
fputcsv($fp, $row, Yii::app()->user->arUser->csvSeparator);

//The Admin user can export up to 200 records
//filtro de lo que exporta!!!!
$customerUser = Yii::app()->user->arUser->customerId;
        $query_A='SELECT res.id, res.name, bck.code, bck.firstName, bck.lastName, bck.idNumber, bck.findingLaboralHistory, bck.findingtextLaboral,
        bck.findingSocioeconomic, bck.findingVisit, bck.findingStudy, bck.findingtextStudy, bck.findingPolygraph, bck.findingtextPoly,
        bck.findingOther, bck.findingBackground, bck.findingtextBackg, bck.findingTestPsychote, bck.findingODT
        FROM ses_BackgroundCheck bck  JOIN ses_Result res ON bck.resultId=res.id
        WHERE (res.id=1 OR res.id=2 OR res.id=3 OR res.id=4) AND bck.customerId="'.$customerUser.'"  AND bck.studyStartedOn>="'.$_GET['from'].'" AND bck.studyStartedOn<="'.$_GET['until'].'"';
$resultforstudy= Yii::app()->db->createCommand($query_A)->queryAll();

foreach ($resultforstudy AS $study){
        if($study['findingLaboralHistory']==1 && $study['findingtextLaboral']!=" "){
            $hallazgolaborar='Hallazgo Laboral: ';
            $hallazgolaborartext=$study['findingtextLaboral']."\n";
        }else{
            $hallazgolaborar='';
            $hallazgolaborartext='';
        }

        if($study['findingSocioeconomic']==1){
            $hallazgocentralR='Hallazgo Central de Riesgo'."\n";
        }else{
            $hallazgocentralR='';
        }

        if($study['findingVisit']==1){
            $hallazgovisita='Hallazgo en la Visita'."\n";
        }else{
            $hallazgovisita='';
        }
        
        if($study['findingStudy']==1 && $study['findingtextStudy']!=" "){
            $hallazgoAcademico='Hallazgo Académico: ';
            $hallazgoAcademicotext=$study['findingtextStudy']."\n";
        }else{
            $hallazgoAcademico='';
            $hallazgoAcademicotext='';
        }

        if($study['findingPolygraph']==1 && $study['findingtextPoly']!=" "){
            $hallazgoPolygraph='Hallazgo en Polígrafo: ';
            $hallazgoPolygraphtext=$study['findingtextPoly']."\n";
        }else{
            $hallazgoPolygraph='';
            $hallazgoPolygraphtext='';
        }

        if($study['findingOther']==1){
            $hallazgootro='Otros Hallazgo'."\n";
        }else{
            $hallazgootro='';
        }
        
        if($study['findingBackground']==1 && $study['findingtextBackg']!=" "){
            $hallazgoBackground='Hallazgo Antecedentes: ';
            $hallazgotextBackg=$study['findingtextBackg']."\n";
        }else{
            $hallazgoBackground='';
            $hallazgotextBackg='';
        }

        if($study['findingTestPsychote']==1){
            $hallazpruebasPsic='Hallazgo Pruebas Psicotecnicas'."\n";
        }else{
            $hallazpruebasPsic='';
        }

        if($study['findingODT']==1){
            $hallazOTD='Hallazgo ODT'."\n";
        }else{
            $hallazOTD='';
        }

//WebUser::logAccess("Exporto " . count($models) . " estudios a un CSV.");
/*foreach ($RegSecciones as $result ){*/

    $reportRow = array();

    $reportRow[] =$study['name'];
    $reportRow[] =$study['code'];
    $reportRow[] =$study['firstName'].' '.$study['lastName'];
    $reportRow[] =$study['idNumber'];
    $reportRow[] =$hallazgolaborar.$hallazgolaborartext.$hallazgocentralR.$hallazgovisita.$hallazgoAcademico.$hallazgoAcademicotext.$hallazgoPolygraph.$hallazgoPolygraphtext.$hallazgootro.$hallazgoBackground.$hallazgotextBackg.$hallazpruebasPsic.$hallazOTD;

    fputcsv($fp, $reportRow, Yii::app()->user->arUser->csvSeparator);

}
//print_r($result);

rewind($fp);

//  It is important to send the first three characters of UTF8  \xEF\xBB\xBF
Yii::app()->request->sendFile("Resultado Estudios" . date("Ymd_His") . ".csv", "\xEF\xBB\xBF" . stream_get_contents($fp), "text/csv", true);
fclose($fp);
