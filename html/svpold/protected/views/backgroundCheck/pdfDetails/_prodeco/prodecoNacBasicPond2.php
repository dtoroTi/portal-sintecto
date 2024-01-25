<?php

//Condicional de seguridad vial

if (isset($SeguridadVial)){
$SeguridadVial = $XMLQuestionResult['SecurtyVial'];
} else{
$SeguridadVial = "N/A";
}
//Condicional OEA
if( $backgroundCheck->getVerificationSection(101)!=null){
if( isset($XMLQuestionResult['Tipoasociado_1'])){
switch ($XMLQuestionResult['Tipoasociado_1'] && $XMLQuestionResult['Tipoasociado_2']) {
case $XMLQuestionResult['Tipoasociado_1'] == 'Sí' && $XMLQuestionResult['Tipoasociado_2'] == 'Sí':
$TipoAsociadoScore = 150;
break;
case $XMLQuestionResult['Tipoasociado_1'] == 'No' && $XMLQuestionResult['Tipoasociado_2'] == 'Sí':
$TipoAsociadoScore = 150;
break;
case $XMLQuestionResult['Tipoasociado_1'] == 'Sí' && $XMLQuestionResult['Tipoasociado_2'] == 'No':
$TipoAsociadoScore = 90;
break;
case $XMLQuestionResult['Tipoasociado_1'] == 'No' && $XMLQuestionResult['Tipoasociado_2'] == 'No':
$TipoAsociadoScore = 30;
break;
}
switch ($XMLQuestionResult['AccesoInfor_1'] && $XMLQuestionResult['AccesoInfor_2']) {
case $XMLQuestionResult['AccesoInfor_1'] == 'Sí' && $XMLQuestionResult['AccesoInfor_2'] == 'Sí':
$AccesoInfoScore = 125;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'No' && $XMLQuestionResult['AccesoInfor_2'] == 'Sí':
$AccesoInfoScore = 125;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'Sí' && $XMLQuestionResult['AccesoInfor_2'] == 'No':
$AccesoInfoScore = 25;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'No' && $XMLQuestionResult['AccesoInfor_2'] == 'No':
$AccesoInfoScore = 125;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'No Aplica' && $XMLQuestionResult['AccesoInfor_2'] == 'Sí':
$AccesoInfoScore = 125;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'No Aplica' && $XMLQuestionResult['AccesoInfor_2'] == 'No':
$AccesoInfoScore = 25;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'No Aplica' && $XMLQuestionResult['AccesoInfor_2'] == 'No Aplica':
$AccesoInfoScore = 25;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'Sí' && $XMLQuestionResult['AccesoInfor_2'] == 'No Aplica':
$AccesoInfoScore = 25;
break;
case $XMLQuestionResult['AccesoInfor_1'] == 'No' && $XMLQuestionResult['AccesoInfor_2'] == 'No Aplica':
$AccesoInfoScore = 125;
break;
}
switch ($XMLQuestionResult['Trayectoria_1']) {
case $XMLQuestionResult['Trayectoria_1'] == 'Mas 5 años':
$TrayectoriaScore = 10;
break;
case $XMLQuestionResult['Trayectoria_1'] == 'Entre 1-5 años':
$TrayectoriaScore = 30;
break;
case $XMLQuestionResult['Trayectoria_1'] == 'Menos 1 año':
$TrayectoriaScore = 50;
break;
}
switch ($XMLQuestionResult['Experiencia_1']) {
case $XMLQuestionResult['Experiencia_1'] == 'Mas 5 años':
$ExperienciaScore = 5;
break;
case $XMLQuestionResult['Experiencia_1'] == 'Entre 1-5 años':
$ExperienciaScore = 15;
break;
case $XMLQuestionResult['Experiencia_1'] == 'Menos 1 año':
$ExperienciaScore = 25;
break;
}
switch ($XMLQuestionResult['paraisosFiscales']) {
case $XMLQuestionResult['paraisosFiscales'] == 'SI':
$ParaisosFiscScore = 100;
break;
case $XMLQuestionResult['paraisosFiscales'] == 'NO':
$ParaisosFiscScore = 20;
break;
}
switch ($XMLQuestionResult['Certificaciones_1'] && $XMLQuestionResult['Certificaciones_2']) {
case $XMLQuestionResult['Certificaciones_1'] == 'Sí' && $XMLQuestionResult['Certificaciones_2'] == 'Sí':
$CertificacionesScore = 10;
break;
case $XMLQuestionResult['Certificaciones_1'] == 'No' && $XMLQuestionResult['Certificaciones_2'] == 'Sí':
$CertificacionesScore = 30;
break;
case $XMLQuestionResult['Certificaciones_1'] == 'Sí' && $XMLQuestionResult['Certificaciones_2'] == 'No':
$CertificacionesScore = 10;
break;
case $XMLQuestionResult['Certificaciones_1'] == 'No' && $XMLQuestionResult['Certificaciones_2'] == 'No':
$CertificacionesScore = 50;
break;
}
$TotalScore = $TipoAsociadoScore + $AccesoInfoScore + $TrayectoriaScore + $ExperienciaScore + $ParaisosFiscScore + $CertificacionesScore;
if($TotalScore <= 200){
$resultOEAScore = 'BAJO';
}elseif ($TotalScore > 200 && $TotalScore <= 300){

$resultOEAScore = 'MEDIO';
}else{
$resultOEAScore = 'ALTO';
}

}
}