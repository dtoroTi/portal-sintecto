<?php

class RefreshTD
{
	public function getApiTusdatos(){

		$username="portalsintecto@sintecto.com";
		$password="G0nz4l3z3855";

		return ['username'=>$username, 'password'=>$password];
	}

	public function processRefresh()
	{
		//consultar Tus datos pendientes con más de una hora de creación y superiores a día de lanzamiento
		$criteria = new CDbCriteria();

		$criteria->compare('status', TusDatosResponse::STATUS_GENERATED);
		$criteria->addCondition("((t.created>='2023-09-16 00:00:32' AND t.created<='2023-09-21 23:59:59') OR (t.modified>='2023-09-16 00:00:32' AND t.modified<='2023-09-21 23:59:59'))"); //HOUR
		//$criteria->addCondition("t.idNumber='1152704330'");
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

                $job=$tdRegister->idTusDatos;
                $id=$tdRegister->idReport;
                $bckid=$tdRegister->backgroundcheckId;
                
                $curl_response = $this->getTusDatosRetry($job, $id, $type, $number, $bckid);
                if ($curl_response === false) {
					echo "Ocurrio un error con el estudio # " . $tdRegister->backgroundCheck->code; 
				} else {
					//echo "dato: ".var_dump($curl_response);
                }
                //$this->getTusDatosRegExt($number, $type, $tdRegister->dateexp);
            }
		} else {
			echo 'No se encontraron registros pendientes\n';
		}
	}

	

	public function getTusDatosRefresh()
	{
		$filename = "/tmp/tusDatosRefrsh.lock";

		if(file_exists($filename)){
			$fp = fopen($filename, "r+"); 
		}else{
			$fp = fopen($filename, "w");
		}
		
		if (flock($fp, LOCK_EX | LOCK_NB)) {  // acquire an exclusive lock
			$this->processRefresh();
			flock($fp, LOCK_UN);    // release the lock
		} else {
			echo "YA HAY UN PROCESO para refrescar\n"; 
		}
		fclose($fp);
	}

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
            $filename = tempnam(Yii::app()->getRuntimePath(), 'td_');
            $this->getTusDatosReportPDF($idnumber,$id, $tid, $filename);
            //$tusDatos = new TusDatosResponse();
            $this->savePDF($bckid, $idnumber, 0, $filename, $refresh=1);
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


    public function savePDF($backgroundCheckId,$idNumber,$verificationSectionId, $filename, $refresh){

		if($refresh==1){
			$this->deleteDocumentsAut($backgroundCheckId, $idNumber);
		}

		$oldFile = Document::model()->findByTusDatosFile($backgroundCheckId,$idNumber.'_tusDatos');
		
		$name=$idNumber.'_tusDatos';

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
		$criteria->addCondition("t.name=:namedoc");
		$criteria->params=[':backgroundCheckId'=>$backgroundCheckId, ':namedoc'=>$name];
		$documents = Document::model()->findAll($criteria);

		if(!$documents){
			//Pregunta si el archivo existe
			if ($filename != "" && file_exists($filename)) {
				//Crea el nuevo modelo para asignar el nuevo documento
				$document = new Document;
				//Se asignan los atributos al nuevo modelo
				$document->backgroundCheckId = $backgroundCheckId;
				$document->name = $idNumber.'_tusDatos';//$pathinfoOrig['filename'];
				$document->description = 'Archivo agregado automáticamente';
				$document->extension = 'pdf';
				$document->size = filesize($filename);

				//Salvar el archivo
				if ($document->save()) {

					//Crear nuevo nombre y obtener ruta absoluta del archivo
					$document->checkAbsoluteDir();
					$document->setUniqueFilename();
					//echo 'Ruta archivo destino: '.$document->absolutePath."\n";
					//Copia el archivo a la posición establecida	
					if (copy($filename, $document->absolutePath) && $document->save()) {
					
						//Encripta los archivos
						$document->cryptFile();
						unlink($filename);
					}else{
						echo "Se creo registro. No se pudo guardar";
					}

					echo "Guardado el Archivo: ".$idNumber."\n";
				} else {
					throw new CHttpException(400, 'El estudio fue solicitado pero no se logró guardar el archivo adjunto. Por favor cárguelo manualmente.');
				}
			}else{
				echo "No se puedo almacenar el archivo no se encontró";
			} 
		}   
	}

    public function deleteDocumentsAut($id, $idnumber) {

        $bc=BackgroundCheck::model()->findByPk($id);

        //if ($bc->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED || $bc->backgroundCheckStatusId == BackgroundCheckStatus::PROCESSING){
            
			$namearchivo=$idnumber.'_tusDatos';

			$criteria = new CDbCriteria;
			$criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
			$criteria->addCondition('t.name=:namenum');
			$criteria->params=[':backgroundCheckId'=>$id,  ':namenum'=>$namearchivo];
			$documents = Document::model()->findAll($criteria);

			if($documents){
				foreach ($documents as $document){
					$documentdelet = Document::model()->findByPK($document->id);
					$documentdelet->delete();
                    echo "Borro el archivo.".$idnumber."\n";
				}
			}
        //}
    }
}
