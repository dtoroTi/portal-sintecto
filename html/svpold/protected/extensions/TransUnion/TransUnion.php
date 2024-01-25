<?php

class TransUnion
{
	public function getApiTransUnion(){

		$post = [
            "username" => Yii::app()->params['transUnion']['username'],
            "password" => Yii::app()->params['transUnion']['password']
        ];

        return $post;
	}

	function getUbicaPlus($bckid, $type, $idnumber, $motConsulta, $codInfo)
	{

		$user=$this->getApiTransUnion();
		$username=$user['username'];
		$password=$user['password'];

		$server = Yii::app()->params['urlAccesApi']['urlTU'];
        $wsdl = "https://$server/ws/UbicaPlusWebService/services/UbicaPlus?wsdl";
        $location = "https://$server/ws/UbicaPlusWebService/services/UbicaPlus/consultaUbicaPlus";

        $client = new SoapClient($wsdl, [
            'location' => $location,
            'uri' => $wsdl,
            //'stream_context' => $context,
            'login' => $username,
            'password' => $password
        ]);

        $data =$client->consultaUbicaPlus(
            [
                'codigoInformacion' => $codInfo,
                'motivoConsulta' => $motConsulta,
                'numeroIdentificacion'=>$idnumber,
                'primerApellido'=>" ",
                'tipoIdentificacion'=>$type
            ]);

        $returndata=json_decode(json_encode($data),true);
        try{
            $data = new SimpleXMLElement($returndata);
            return $data;
        }catch(Exception $e){
            echo $e->getMessage("fallo el envío del documento");
        }
       
	}

	function getInfoComercial($bckid, $type, $idnumber, $motConsulta, $codInfo)
	{
		$user=$this->getApiTransUnion();
		$username=$user['username'];
		$password=$user['password'];

		$server = Yii::app()->params['urlAccesApi']['urlTU'];
        $wsdl = "https://$server/InformacionComercialWS/services/InformacionComercialSeg?wsdl";
        $location = "https://$server/InformacionComercialWS/services/InformacionComercialSeg/consultaXmlConApellido";

		$client = new SoapClient($wsdl, [
            'location' => $location,
            'uri' => $wsdl,
            //'stream_context' => $context,
            'login' => $username,
            'password' => $password
        ]);

		$data =$client->consultaXml(
            [
                'codigoInformacion' => $codInfo,
                'motivoConsulta' => $motConsulta,
                'numeroIdentificacion'=>$idnumber,
                'primerApellido'=>" ",
                'tipoIdentificacion'=>$type
            ]);

        $returndata=json_decode(json_encode($data),true);
        try{
            $data = new SimpleXMLElement($returndata);
            return $data;
        }catch(Exception $e){
            echo $e->getMessage("fallo el envío del documento");
        }

	}

	public function savePDFTU($bckid, $idnumber, $filename, $namePDF){

		$oldFile = Document::model()->findByTusDatosFile($bckid,$idnumber.$namePDF);
		
		$name=$idnumber.$namePDF;

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
		$criteria->addCondition("t.name=:namedoc");
		$criteria->params=[':backgroundCheckId'=>$bckid, ':namedoc'=>$namePDF];
		$documents = Document::model()->findAll($criteria);

		if(!$documents){
			if ($filename != "" && file_exists($filename)) {
				$document = new Document;
				//Se asignan los atributos al nuevo modelo
				$document->backgroundCheckId = $bckid;
				$document->name = $idnumber.$namePDF;
				$document->description = 'Archivo agregado proceso TransUnion';
				$document->extension = 'pdf';
				$document->size = filesize($filename);

				/*echo "backgroundID: ".$document->backgroundCheckId."\n";
				echo "name: ".$document->name."\n";
				echo "extencion: ".$document->extension."\n";
				echo "tmaño: ".$document->extension."\n";*/

				//Salvar el archivo
				if ($document->save()) {

					//Crear nuevo nombre y obtener ruta absoluta del archivo
					$document->checkAbsoluteDir();
					$document->setUniqueFilename();
					//echo 'Ruta archivo destino: '.$document->absolutePath."\n";
					//Copia el archivo a la posición establecida	
					if (copy($filename, $document->absolutePath) && $document->save()) {
						//echo "Se pudo guardar";
						/*if ($document->isPdf) {
							$document->dpi=360; //Alta
							$document->convertToStandardPDF();
						}*/
						//Encripta los archivos
						$document->cryptFile();
						unlink($filename);
					}else{
						echo "Se creo registro. No se pudo guardar";
					}

					return "Archivo guardado";
				} else {
					throw new CHttpException(400, 'El estudio fue solicitado pero no se logró guardar el archivo adjunto. Por favor cárguelo manualmente.');
				}
			}else{
				echo "No se puedo almacenar el archivo no se encontró";
			} 
		}   
	}
}
