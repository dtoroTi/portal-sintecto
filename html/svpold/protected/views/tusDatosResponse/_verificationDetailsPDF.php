<?php


$results_url = URLRESULTSTUSDATOS;
$reportpdf_url = URLPDFTUSDATOS;
$username = USRTUSDATOS;
$password = PWTUSDATOS;

$backgroundCheck = BackgroundCheck::model()->findByAttributes(
                    array('id' => $verificationSection->backgroundCheckId));



$pdf->SetFillColor(220);
$pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(10, '', 'Información Tus Datos', 1, 0, 'C', 1);

$pdf->SetFont('Arial', '', 8);

$tusdatosresp = TusDatosResponse::model()->find("code='" . $backgroundCheck->code . "'");



$jobid = $tusdatosresp->idTusDatos;

$curl = curl_init($results_url . $jobid);
$headers = [
    'Content-Type: application/json',
];

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);

$curl_response = curl_exec($curl);


if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);

  
if(isset($decoded->estado) && $decoded->estado == 'procesando')
{
  echo '<h2>El estudio está en proceso. Vuelva a intentar después.</h2>';
}
else
{
  
  /*$curl2 = curl_init($reportpdf_url . $decoded->id);
  $headers = [
      'Content-Type: application/json',
  ];

  curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl2, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($curl2, CURLOPT_USERPWD, $username . ":" . $password);
  
  $curl2_response = curl_exec($curl2);


  if ($curl2_response === false) {
      $info = curl_getinfo($curl2);
      curl_close($curl2);
      die('error occured during curl exec. Additioanl info: ' . var_export($info));
  }
  curl_close($curl2);
  

  //echo $curl2_response;

  // And a path where the file will be created
  $path = '/tmp/newly_created_file.pdf';

  // Then just save it like this
  file_put_contents( $path, $curl2_response );

  $headerHeight = 31;

  $pagecount = $pdf->setSourceFile($path);
  for ($i = 1; $i <= $pagecount; $i++) {
    $tplidx = $pdf->importPage($i, '/MediaBox');
    $pdf->addPage();
    $pdf->useTemplate($tplidx, 10, $headerHeight, 196);
  }
  unlink($path);*/
  //$pdf->Write($curl2_response);
}




$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255);
