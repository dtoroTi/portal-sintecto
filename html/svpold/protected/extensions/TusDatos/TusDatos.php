<?php

class TusDatos
{
	public function getApiTusdatos(){

		$username="portalsintecto@sintecto.com";
		$password="G0nz4l3z3855";

		return ['username'=>$username, 'password'=>$password];
	}

	public function processPending()
	{
		//consultar Tus datos pendientes con más de una hora de creación y superiores a día de lanzamiento
		$criteria = new CDbCriteria();

		$criteria->compare('status', TusDatosResponse::STATUS_PENDING);
		$criteria->addCondition("t.created < SUBDATE(now(), INTERVAL 4 HOUR) OR t.tusdatosRequestTime >= DATE(NOW()) OR customerProduct.hourExpress>0"); //HOUR
		$criteria->with=['backgroundCheck.customerProduct'];
		$models = TusDatosResponse::model()->findAll($criteria);

		if (!empty($models)) {
			//enviar por cada uno la petición a tus datos
			foreach ($models as $tdRegister) {
				$type = "";
				$number = "";
				if (stristr($tdRegister->idNumber, 'CE') !== false) {
					$type = 'CE';
					$number = substr($tdRegister->idNumber, 2);
				} else if (stristr($tdRegister->idNumber, 'PEP') !== false) {
					$type = 'PEP';
					$number = substr($tdRegister->idNumber, 3);
				} else if (stristr($tdRegister->idNumber, 'PPT') !== false) {
					$type = 'PPT';
					$number = substr($tdRegister->idNumber, 3);
				} else if (stristr($tdRegister->idNumber, 'PP') !== false) {
					$type = 'PP';
					$number = substr($tdRegister->idNumber, 2);
				} else if (stristr($tdRegister->idNumber, 'NIT') !== false) {
					$type = 'NIT';
					$number = substr($tdRegister->idNumber, 3);
				} else {
					$type = 'CC';
					$number = $tdRegister->idNumber;
				}

				if ($tdRegister->dateexp != "" || $tdRegister->dateexp != NULL) {
					if (empty($type) || empty($number)) {
						echo 'ocurrio un error tipo de documento no valido \n';
						continue;
					} else {
						$curl_response = $this->getTusDatosRegExt($number, $type, $tdRegister->dateexp);
					}
				} else {
					$curl_response = $this->getTusDatosReg($number, $type);
				}

				if ($curl_response === false) {
					echo "Ocurrio un error con el estudio # " . $tdRegister->backgroundCheck->code; 
				} else {
					$decoded = json_decode($curl_response);

					//if(isset($decoded->jobid) || (isset($decoded->id) && isset($decoded->cedula))){

						if (!empty($decoded)) {
							if (isset($decoded->jobid)) {
								$tdRegister->response = '1';
								$tdRegister->idTusDatos = $decoded->jobid;
							}else if (isset($decoded->id) && isset($decoded->cedula)) {
								$tdRegister->response = '1';
								$tdRegister->idReport = $decoded->id;
							} else if (isset($decoded->error)){
								$tdRegister->response = '0';
								$tdRegister->idReport = $tdRegister->idNumber;
							}
							
							//WebUser::logAccess("Consulto en Tus Datos.", $tdRegister->backgroundCheck->code);
							$tdRegister->modified = new CDbExpression('NOW()');
							$tdRegister->timestamp = strtotime('now');
							$tdRegister->status = TusDatosResponse::STATUS_PROCESSING;
							if ($tdRegister->save()) {
							}
						}else{
							if (preg_match('/^\s|\s$/', $tdRegister->idNumber)){
								$tdRegister->response = null;
								$tdRegister->idReport = $tdRegister->idNumber;
								$tdRegister->modified = new CDbExpression('NOW()');
								$tdRegister->timestamp = strtotime('now');
								$tdRegister->status = TusDatosResponse::STATUS_PROCESSING;
								if ($tdRegister->save()) {
								}
							}
						}
					//}
				}
					
			}
		} else {
			echo 'No se encontraron registros pendientes\n';
		}
	}

	public function processProcessing()
	{

		//consultar datos en estado procesing
		//consultar Tus datos pendientes con más de una hora de creación y superiores a día de lanzamiento
		$criteria = new CDbCriteria();
		$criteria->compare('status', TusDatosResponse::STATUS_PROCESSING);
		$criteria->addCondition("t.response='1' AND (backgroundCheck.backgroundCheckStatusId!='4' AND backgroundCheck.backgroundCheckStatusId!='2')"); //HOUR // AND t.modified>=CURDATE()
		$criteria->with=['backgroundCheck'];
		$criteria->order='t.modified ASC';
		$models = TusDatosResponse::model()->findAll($criteria);
		if (!empty($models)) {

			foreach ($models as $tdRegister) {

				$jobId = $tdRegister->idTusDatos;
				//$reportId = $tdRegister->idReport;
				$idNumber = $tdRegister->idNumber;

				if (stristr($tdRegister->idNumber, 'NIT') !== false) {
					$type = 'NIT';
				}else{
					$type = null;
				}
				//$filename = tempnam(Yii::app()->getRuntimePath(), 'td_');

				$bCheck = BackgroundCheck::model()->findByAttributes(array('code' => $tdRegister->backgroundCheck->code));
				$toreplace = array("/", " ", "\\", "*", "CE", "NIT", "PEP", "PPT", "PP");
				$idNumber = str_replace($toreplace, "", $idNumber);

				$decodeData = $this->getTusDatosDataResults($jobId);
				if (!empty($decodeData)) {

					if (isset($decodeData->estado) && strpos($decodeData->estado, 'finalizado') !== false) {

						//print_r($decodeData);
						//$tdRegister->idTusDatos = $jobId;
						//$tdRegister->idReport = $decodeData->id;
						$reportId =$decodeData->id;
						//$ok = $tdRegister->save();

						$responseJSON =$this->getReportJson($idNumber, $reportId);

						if(!empty($responseJSON)){
							$verificationSecadv = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $tdRegister->backgroundCheck->id, 'verificationSectionTypeId' => '4']);
							if($verificationSecadv){
								DetailRegister::getInsertInfTD($responseJSON, $tdRegister->backgroundCheck->id, $refresh=0);
							}
							$verificationSecXML = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $tdRegister->backgroundCheck->id, 'verificationSectionTypeId' => '24']);
							if($verificationSecXML){
								XmlSection::getInsertInfTDXml($responseJSON, $tdRegister->backgroundCheck->id, $refresh=0);
							}		
						}

						$filename = tempnam(Yii::app()->getRuntimePath(), 'td_');
						$response =$this->getTusDatosReportPDF($idNumber, $reportId, $type, $filename);
						//$response = $this->getTusDatosResults($jobId, $reportId, $idNumber, $type, $filename);

						$tdRegister->savePDF($bCheck->id, $idNumber, 0, $filename, $refresh=0);
						$tdRegister->idTusDatos = $jobId;
						$tdRegister->idReport = $reportId;
						$tdRegister->response = '1';
						$tdRegister->modified = new CDbExpression('NOW()');
						$tdRegister->status = TusDatosResponse::STATUS_GENERATED;
						$ok = $tdRegister->save();
					}
				}else{
					if($tdRegister->idReport!=$tdRegister->idNumber && $tdRegister->response=='1' && ($jobId=="" || $jobId==NULL)){
						$reportId = $tdRegister->idReport;

						$responseJSON =$this->getReportJson($idNumber, $reportId);
		
						if(!empty($responseJSON)){

							$verificationSecadv = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $tdRegister->backgroundCheck->id, 'verificationSectionTypeId' => '4']);
							if($verificationSecadv){
								DetailRegister::getInsertInfTD($responseJSON, $tdRegister->backgroundCheck->id, $refresh=0);
							}
							$verificationSecXML = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $tdRegister->backgroundCheck->id, 'verificationSectionTypeId' => '24']);
							if($verificationSecXML){
								XmlSection::getInsertInfTDXml($responseJSON, $tdRegister->backgroundCheck->id, $refresh=0);
							}	
									
						}
						//die();
						
						$filename = tempnam(Yii::app()->getRuntimePath(), 'td_');
						$response =$this->getTusDatosReportPDF($idNumber, $reportId, $type, $filename);
					
						if(!empty($response)){
							$tdRegister->savePDF($bCheck->id, $idNumber, 0, $filename, $refresh=0);
							$tdRegister->idTusDatos = $jobId;
							$tdRegister->idReport = $reportId;
							$tdRegister->response = '1';
							$tdRegister->modified = new CDbExpression('NOW()');
							$tdRegister->status = TusDatosResponse::STATUS_GENERATED;
							$ok = $tdRegister->save();
						}else{
							unlink($filename);
						}
					}
				}
			}
		} else {
			echo 'No se encontraron registros en proceso\n';
		}
	}

	public function getTusDatosPending()
	{
		$filename = "/tmp/tusDatos.lock";

		if(file_exists($filename)){
			$fp = fopen($filename, "r+"); 
		}else{
			$fp = fopen($filename, "w");
		}
		
		if (flock($fp, LOCK_EX | LOCK_NB)) {  // acquire an exclusive lock
			$this->processPending();
			$this->processProcessing();
			flock($fp, LOCK_UN);    // release the lock
		} else {
			echo "YA HAY UN PROCESO EN EJECUCIÓN\n"; 
		}
		fclose($fp);
	}


	function getTusDatosReg($cedula, $tipo)
	{

		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/launch/";
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";

		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json')); 
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($client, CURLOPT_POSTFIELDS, '{"doc":"'.$cedula.'","typedoc":"'.$tipo.'"}');

		$response = curl_exec($client);

		return $response;
	}

	function getTusDatosRegExt($ident, $tipo, $expdate)
	{
		
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/launch/"; 
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json')); 
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($client, CURLOPT_POSTFIELDS, '{"doc":"'.$ident.'","typedoc":"'.$tipo.'","fechaE":"'.$expdate.'"}');

		$response = curl_exec($client);
		return $response;
	}

	function getTusDatosDataResults($jobid)
	{
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/results/" . $jobid;
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_POST, false);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json')); 
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$curl_response = curl_exec($client);

		if ($curl_response === false) {
			$info = curl_getinfo($client);
			curl_close($client);
			die('error occured during curl exec. find results info: id: ' . $jobid . var_export($info));
		}
		$decoded = json_decode($curl_response);
		return $decoded;
	}

	function getTusDatosReport($idNumber)
	{
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/report/" . $idNumber;
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$response = curl_exec($client);
		curl_close($client);
		return $response; 
	}

	function getTusDatosReportCC($idNumber)
	{
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url="https://dash-board.tusdatos.co/api/report_cc/" . $idNumber;
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($client, CURLOPT_POST, true); 
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$response = curl_exec($client);
		curl_close($client);
		return $response; 
	}

	/*function getTusDatosResults($jobid, $id, $idNumber, $type, $filename)
	{
		$url = "https://dash-board.tusdatos.co/api/results/".$jobid;
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($client, CURLOPT_POST, false);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "portalsintecto@sintecto.com:G0nz4l3z3855");

		$curl_response = curl_exec($client);

	
		if ($curl_response === false) {
			$info = curl_getinfo($client);
			curl_close($client);
			die('error occured during curl exec. find results info: id: ' . $jobid . var_export($info));
		}
		$decoded = json_decode($curl_response);
		curl_close($client);

		if (isset($decoded->estado) && $decoded->estado == 'procesando') {
			return '<h2>El estudio está en proceso. Vuelva a intentar después.</h2>';
		} else if (isset($decoded->estado) && strpos($decoded->estado, 'error') !== false) {

			if (empty($idNumber)) {
				$this->getTusDatosReportPDF($idNumber, $decoded->id, $type, $filename);
				return $this->getTusDatosReport($decoded->id);
			} else {
				$this->getTusDatosReportPDF($idNumber, $id, $type, $filename);
				return $this->getTusDatosReportCC($idNumber);
			}

		} else {
			if (isset($decoded->id)) {
				$this->getTusDatosReportPDF($idNumber, $decoded->id, $type, $filename);
				return $this->getTusDatosReport($decoded->id);
			} else if (isset($id) && !empty($id)) {
				$this->getTusDatosReportPDF($idNumber, $id, $type, $filename);
				return $this->getTusDatosReport($id);
			} else {
				$dataUser = json_decode($this->getTusDatosReg($idNumber, null, false));
				if (!isset($dataUser->jobid) && isset($dataUser->id)) {
					$this->getTusDatosReportPDF($idNumber, $dataUser->id, $type, $filename);
					return $this->getTusDatosReport($dataUser->id);
				}
			}

			return '<h2>No se han encontrado resultados para el número de identificación ingresado</h2>';
		}
	}*/

	function getTusDatosReportPDF($idNumber, $id, $type, $fileName)
	{
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$toreplace = array("/", " ", "\\", "*", "CE", "NIT", "PEP", "PPT", "PP");
		$idNumber = str_replace($toreplace, "", $idNumber);

		if (file_exists($fileName) && filesize($fileName) > 1024) {
			echo "El archivo existe " . $fileName . " no se genera otro";
			return false;
		}

		if($type=="NIT"){
			//https://dash-board.tusdatos.co/api/report_nit_pdf/
			$url = "https://dash-board.tusdatos.co/api/v2/report_nit_pdf/" . $id;
		}else{
			//https://dash-board.tusdatos.co/api/report_pdf/
			$url = "https://dash-board.tusdatos.co/api/v2/report_pdf/" . $id;
		}

		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$content = curl_exec($client);
		$decoded = json_decode($content);
		if (isset($decoded->estado) && stristr($decoded->estado, 'error') !== false) {
			return false;
		}

		$response = false;

		if (file_put_contents($fileName, $content)) {
			chmod($fileName, 0775);
			$response = true;
		}

		curl_close($client);
		return $response;
	}

	function getTusDatosRetry($job, $id, $tid, $idnumber, $bckid)
	{
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/retry/".$id."/?typedoc=".$tid;
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_POST, false);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json')); 
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$curl_response = curl_exec($client);

		if ($curl_response === false) {
			$info = curl_getinfo($client);
			curl_close($client);
			die('error occured during curl exec. find results info: id: ' . $job . var_export($info));
		}
		$decoded = json_decode($curl_response);
		curl_close($client);


		if (isset($decoded->error)) {
			echo '<h2>El estudio no es válido</h2>';
		} else {
				/*if ($tid == 'CC') {
				//echo "Entro Aqui";
				//$this->getTusDatosResults($job, $id, $idnumber, null);
				$this->getTusDatosReportPDF($idnumber,$id, $tid);
				$tusDatos = new TusDatosResponse();
				$tusDatos->savePDF($bckid, $idnumber, 0);
			} else {*/
				$filename = tempnam(Yii::app()->getRuntimePath(), 'td_');
				$this->getTusDatosReportPDF($idnumber,$id, $tid, $filename);
				$tusDatos = new TusDatosResponse();
				$tusDatos->savePDF($bckid, $idnumber, 0, $filename, $refresh=1);

				$responseJSON =$this->getReportJson($idnumber, $id);

				if(!empty($responseJSON)){

					$verificationSecadv = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $bckid, 'verificationSectionTypeId' => '4']);
					if($verificationSecadv){
						DetailRegister::getInsertInfTD($responseJSON, $bckid, $refresh=1);
					}
					$verificationSecXML = VerificationSection::model()->findByAttributes(['backgroundCheckId' => $bckid, 'verificationSectionTypeId' => '24']);
					if($verificationSecXML){
						XmlSection::getInsertInfTDXml($responseJSON, $bckid, $refresh=1);
					}

				}
			//}
		}
	}

	function getplanstusdatos(){

		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/plans/";
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";


		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$response = curl_exec($client);
		$decoded = (array) json_decode($response, TRUE);

		curl_close($client);

		return $decoded; 

	}

	function getReportJson($idNumber, $id){
		$user=$this->getApiTusdatos();
		$username=$user['username'];
		$password=$user['password'];

		$url = "https://dash-board.tusdatos.co/api/report_json/".$id;
		$userAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36";

		//$client = curl_init($url);
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, $url);
		curl_setopt($client, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");

		$response = curl_exec($client);
		$decoded = (array) json_decode($response, TRUE);

		curl_close($client);

		return $decoded; 
	}
}
