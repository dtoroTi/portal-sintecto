
<h1>Consultar información de Tus Datos</h1>
<div id="service-status">
</div>

<?php
		// include 'testapi.php';

		$results_url = URLRESULTSTUSDATOS;
		$report_url = URLREPORTTUSDATOS;
		$username = USRTUSDATOS;
        $password = PWTUSDATOS;

        $code = $verificationSection->backgroundCheck->code;//isset($_GET['code'])?$_GET['code']:"";
        $idNumber = $verificationSection->backgroundCheck->idNumber;//isset($_GET['id'])?$_GET['id']:"";
        $tusdatosresp = TusDatosResponse::model()->find("code='$code'");


        if(is_null($tusdatosresp))
        {

        	$tusdatosresp = new TusDatosResponse();
            $curl_response = getTusDatosReg($idNumber);
            
            if ($curl_response === false) {
                $info = curl_getinfo($client);
               
                die(' error occured during curl exec. init service info: ' . var_export($info));
            }
          
            
            $decoded = json_decode($curl_response);


            
            $tusdatosresp->code = $code;
            $tusdatosresp->response = '1';
            if(isset($decoded->jobid)){
            	$tusdatosresp->idTusDatos = $decoded->jobid;	
            }
            if(isset($decoded->id)){
            	$tusdatosresp->idReport= $decoded->id;	
            }
            $tusdatosresp->timestamp = strtotime("now");
            $tusdatosresp->idNumber = $idNumber;
            $ok = $tusdatosresp->save();
				
            echo '<h2>Se ha generado el estudio. Vuelva a consultar luego.</h2>';
        }
        else
        {
        	$jobId = $tusdatosresp->idTusDatos;
        	$reportId = $tusdatosresp->idReport;

        	//$response = getTusDatosResults($jobId,$reportId, $idNumber);
        	echo '<iframe id="infoTusDatos" src ="/testapi.php?jid='.$jobId.'&rid='.$reportId.'&nid='.$idNumber.'" style="border:none; width: 100%; height: 1200px;"></iframe>';	
	        echo $tusdatosresp->savePDF($verificationSection->backgroundCheck->id, $verificationSection->backgroundCheck->idNumber, $verificationSection->id);

        }

 ?>       

