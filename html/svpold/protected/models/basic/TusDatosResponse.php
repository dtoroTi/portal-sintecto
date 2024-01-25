<?php

/**
 * This is the model class for table "{{TusDatosResponse}}".
 *
 * The followings are the available columns in table '{{TusDatosResponse}}':
 * @property integer $id
 * @property integer $backgroundcheckId
 * @property string $response
 * @property integer $timestamp
 * @property string $idTusDatos
 * @property string $idNumber
 * @property string $idReport
 * @property string $dateexp
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $htmlReport
 * @property string $created
 * @property string $modified
 * @property string $status
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class TusDatosResponse extends SVPActiveRecord
{

	const STATUS_PENDING="PENDING";
	const STATUS_PROCESSING="PROCESSING";
	const STATUS_GENERATED="GENERATED";

	/**
	* Returns the static model of the specified AR class.
	* @param string $className active record class name.
	* @return TusDatosResponse the static model class
	*/
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{TusDatosResponse}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('backgroundcheckId, timestamp', 'required'),
			array('timestamp', 'numerical', 'integerOnly'=>true),
			array('backgroundcheckId', 'length', 'max'=>12),
			array('id, backgroundcheckId, response, timestamp', 'safe', 'on'=>'search'),
			array('idTusDatos', 'length', 'max'=>45),
			array('idReport', 'length', 'max'=>45),
			array('idNumber', 'length', 'max'=>45),
		);
	}	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
        'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
		'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundcheckId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'backgroundcheckId' => 'backgroundcheckId',
			'response' => 'Response',
			'timestamp' => 'Timestamp',
			'idTusDatos' => 'ID Tus Datos',
			'idNumber' => 'ID Number',
			'idReport' => 'ID Report',
			'verificationSectionId' => 'Verification Section',
        	'verificationResultId' => 'Verificación',
        	'verificationResultId' => 'Reporte Html',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('backgroundcheckId',$this->backgroundcheckId,true);
		$criteria->compare('response',$this->response,true);
		$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('idTusDatos',$this->idTusDatos,true);
		$criteria->compare('idReport',$this->idReport,true);
		$criteria->compare('verificationResultId', $this->verificationResultId);
    	$criteria->compare('verificationSectionId', $this->verificationSectionId);
    	$criteria->compare('created', $this->created);
    	$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function savePDF($backgroundCheckId,$idNumber,$verificationSectionId, $filename, $refresh){

		if($refresh==1){
			$this->deleteDocumentsAut($backgroundCheckId, $idNumber);
		}

		$oldFile = Document::model()->findByTusDatosFile($backgroundCheckId,$idNumber.'_tusDatos');
		
		//ruta del archivo
		//$filename = tempnam(Yii::app()->getRuntimePath(), 'td_');
        //$filename = Yii::app()->getRuntimePath().'/'.$idNumber.'_tusDatos.pdf';
		//echo "ARCHIVO: ".$filename."\n";

        //Información del archivo
        //$pathinfoOrig = pathinfo($filename);
		$name=$idNumber.'_tusDatos';

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
		$criteria->addCondition("t.name=:namedoc");
		$criteria->params=[':backgroundCheckId'=>$backgroundCheckId, ':namedoc'=>$name];
		$documents = Document::model()->findAll($criteria);

		if(!$documents){
			//Pregunta si el archivo existe
			if ($filename != "" && file_exists($filename)) {
				//echo "entro aqui....\n";
				//Crea el nuevo modelo para asignar el nuevo documento
				$document = new Document;
				//Se asignan los atributos al nuevo modelo
				$document->backgroundCheckId = $backgroundCheckId;
				$document->name = $idNumber.'_tusDatos';//$pathinfoOrig['filename'];
				$document->description = 'Archivo agregado automáticamente';
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

	public function deleteRegTD($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('backgroundcheckId', $id);
		$criteria->compare('status', TusDatosResponse::STATUS_PENDING);
		$models = TusDatosResponse::model()->findAll($criteria);

		$bc=BackgroundCheck::model()->findByPk($id);

		if($models){
			$tusdatos= TusDatosResponse::model()->findByAttributes(array('backgroundcheckId' => $id));
			$tusdatos->delete();
			WebUser::logAccess("Se Elimino de manera automatica el registro de la tabla que consulta en tus datos", $bc->code);
		}else{
			WebUser::logAccess("No se Elimino el registro de la tabla que consulta en tus datos, porque su estado no es pendiente.", $bc->code);
		}
	}
	
	//natalia henao
    //27/01/2022 elimina pdfs anteriores al dar clic en refrescar
    public function deleteDocumentsAut($id, $idnumber) {

        $bc=BackgroundCheck::model()->findByPk($id);

        if ($bc->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED || $bc->backgroundCheckStatusId == BackgroundCheckStatus::PROCESSING){
            
			$namearchivo=$idnumber.'_tusDatos';

			$criteria = new CDbCriteria;
			$criteria->addCondition('t.backgroundCheckId=:backgroundCheckId');
			$criteria->addCondition('t.name=:namenum');
			$criteria->params=[':backgroundCheckId'=>$id,  ':namenum'=>$namearchivo];
			$documents = Document::model()->findAll($criteria);

			if($documents){
				foreach ($documents as $document){
					$documentdelet = Document::model()->findByPK($document->id);
					WebUser::logAccess("Borro el archivo anterior, al refrescar: {$document->name}.{$document->extension} [{$document->size}]", $document->backgroundCheck->code);
					$documentdelet->delete();
				}
			}
        }
    }
}
