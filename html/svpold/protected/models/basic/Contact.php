<?php

use Contact as GlobalContact;

/**
 * This is the model class for table "{{Contact}}".
 *
 * The followings are the available columns in table '{{Contact}}':
 * @property integer $id
 * @property integer $backgroundCheckId
 * @property string $comments
 * @property integer $statusContact
 * @property integer $contactType
 * @property string $created
 * @property string $modified
 * @property string $transactionId
 *
 * The followings are the available model relations:
 * @property BackgroundCheck $backgroundCheck
 */
class Contact extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('backgroundCheckId, contactType', 'numerical', 'integerOnly'=>true),
			array('comments, statusContact, created, modified, transactionId', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, backgroundCheckId, comments, statusContact, contactType, created, modified, transactionId', 'safe', 'on'=>'search'),
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
			'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundCheckId'),
			'contactTypes' => array(self::BELONGS_TO, 'ContactType', 'contactType'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'backgroundCheckId' => 'Background Check',
			'comments' => 'Comentario',
			'statusContact' => 'Estado Contacto',
			'contactType' => 'Tipo Contacto',
			'created' => 'Fecha y Hora de Envío',
			'modified' => 'Modified',
			'transactionId'=>'ID de transacción Aldeamo'
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
		$criteria->compare('backgroundCheckId',$this->backgroundCheckId);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('statusContact',$this->statusContact);
		$criteria->compare('contactType.Type', $this->contactTypeType, true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('transactionId',$this->transactionId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function idDinamicForm($backgroundCheck){
		
		Yii::import('application.extensions.DynamicForm.*');
		
		if($backgroundCheck){
			echo "ooid: ".$backgroundCheck->ooidFD;
			if($backgroundCheck->ooidFD=="" || is_null($backgroundCheck->ooidFD)){
				echo "retunr: ".$backgroundCheck->ooidFD;
				$NumId=CHtml::encode($backgroundCheck->idNumber);

				$idAttachment=$backgroundCheck->customerProduct->attachmentFileId;
				if($idAttachment!=""){
					$attachment = AttachmentFile::model()->findByPK($idAttachment);
					$dynamicForm = DynamicFormJSON::model()->findByPK($attachment->idFDJson);
					$questionnaire=$dynamicForm->questionnaireJSON;
				}

				$Object = new DateTime();  
				$time = $Object->format("h:i:s");  
	
				$valid_until=$backgroundCheck->maxInternalDays.' '.$time;
				$dynamicForm = new DynamicForm();
				$toreplace = array("/", " ", "\\", "*", "CE", "NIT", "PEP", "PPT", "PP", "TI");
				$idNumber = str_replace($toreplace, "", $NumId);
				$dateresponse=$dynamicForm->dynamicQuestion($idNumber, $questionnaire, $valid_until);

				$backgroundCheck->ooidFD=$dateresponse['ooid'];
				$backgroundCheck->validuntilFD=$valid_until;
				$backgroundCheck->update();
			}
		}
		echo "no tiene oiid para registrar.";
	}

	public static function insertContactMail($id){
		
		$dateAct = new \DateTime(" ");
		$Fecha=$dateAct->format('Y-m-d H:i:s');

		$contact = new Contact();
		$contact->backgroundCheckId = $id;
		$contact->comments = '';
		$contact->statusContact = 'Enviado';
		$contact->contactType = '2';
		$contact->created = $Fecha;
		$contact->modified = '';
		$contact->transactionId = '';

		if (!$contact->save()) {
			throw new CHttpException(500, 'Server Error.');
		}

		/*$data="INSERT INTO ses_Contact (backgroundCheckId, comments, statusContact, contactType, created, modified, transactionId)
		VALUES ('".$id."', ' ', 'Enviado', '2', '".$Fecha."', '', '')";
		$query = Yii::app()->db->createCommand($data)->execute(); */

	}

	public static function sendTextMessage($id){
		
		$backgroundCheck = BackgroundCheck::model()->findByPK($id);

		$nombre=CHtml::encode($backgroundCheck->firstName).' '.CHtml::encode($backgroundCheck->lastName);
		$empresa=CHtml::encode($backgroundCheck->customer->name);
		$email=CHtml::encode($backgroundCheck->email);
		$mobil=CHtml::encode($backgroundCheck->mobile);

		$data=[
			"country"=> 57,
			"dateToSend"=> "",
			"message"=> "Apreciad@ $nombre, lo saludamos de la empresa SINTECTO LTDA, empresa autorizada por la compañía: $empresa, para su estudio de seguridad, agradecemos revisar su correo electrónico: $email, en el cual se comparten las instrucciones a seguir en este proceso. Feliz día.",
			"encoding"=> "",
			"messageFormat"=> 1,
			"addresseeList"=> [
				[
					"mobile"=> $mobil,
					"correlationLabel"=> "corelation ejemplo",
					"url"=> ""
				]
			]
		];

		$datosJSON = json_encode($data);

		$url = "https://apitellit.aldeamo.com/SmsiWS/smsSendPost/";
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));//$headers);
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "NataliaGonzalez:MzAxNTQ2MjA2NQ==");
		curl_setopt($client, CURLOPT_POSTFIELDS, $datosJSON);

		$response = curl_exec($client);

		curl_close($client);

		$dateresponse =(array) json_decode($response);

		return $dateresponse;
	} 

	public static function insertTextMessage($IdBackgroundCheck, $statusContact, $Created, $idtransaction){
		
		$contact = new Contact();
		$contact->backgroundCheckId = $IdBackgroundCheck;
		$contact->comments = '';
		$contact->statusContact = $statusContact;
		$contact->contactType = '3';
		$contact->created = $Created;
		$contact->modified = '';
		$contact->transactionId = $idtransaction;

		if (!$contact->save()) {
			throw new CHttpException(500, 'Server Error.');
		}

		/*$data="INSERT INTO ses_Contact (backgroundCheckId, comments, statusContact, contactType, created, modified, transactionId)
		VALUES ('".$IdBackgroundCheck."', '', '".$statusContact."', '3', '".$Created."', '','".$idtransaction."')";
		$query = Yii::app()->db->createCommand($data)->execute(); */
	}


	public static function sendToCall($id){
		$backgroundCheck = BackgroundCheck::model()->findByPK($id);

		$nombre=CHtml::encode($backgroundCheck->firstName).' '.CHtml::encode($backgroundCheck->lastName);
		$empresa=CHtml::encode($backgroundCheck->customer->name);
		$email=CHtml::encode($backgroundCheck->email);
		$mobil=CHtml::encode($backgroundCheck->mobile);

		$data=[
			"country"=> 57,
			"type"=> "TTS",
			"message"=> "Este es un texto que será convertido a audio",
			"paramsTTS"=> [
				"language"=> "es-MX",
				"voice"=> "es-MX-DaliaNeural"
			],
			"paramsAttempts"=> [
				"totalRetries"=> 1,
				"timeRetry" => 60
			],
			"addresseeList"=> [
				[
					"message"=> "Apreciado $nombre, lo saludamos de la empresa SINTECTO LTDA, empresa autorizada por la compañía: $empresa, para su estudio de seguridad, agradecemos revisar su correo electrónico: $email, en el cual se comparten las instrucciones a seguir en este proceso. Feliz día.",
					"mobile"=> $mobil
				]
			]
		];

		$datosJSON = json_encode($data);

		$url = "https://apitellitvoice.aldeamo.com/voice/sendPost";
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));//$headers);
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "NataliaGonzalez:MzAxNTQ2MjA2NQ==");
		curl_setopt($client, CURLOPT_POSTFIELDS, $datosJSON);

		$response = curl_exec($client);

		curl_close($client);

		$dateresponse =(array) json_decode($response);

		return $dateresponse;

	}

	public static function insertToCall($IdBackgroundCheck, $statusContact, $Created, $idtransaction){

		$contact = new Contact();
		$contact->backgroundCheckId = $IdBackgroundCheck;
		$contact->comments = '';
		$contact->statusContact = $statusContact;
		$contact->contactType = '4';
		$contact->created = $Created;
		$contact->modified = '';
		$contact->transactionId = $idtransaction;

		if (!$contact->save()) {
			throw new CHttpException(500, 'Server Error.');
		}

		/*$data="INSERT INTO ses_Contact (backgroundCheckId, comments, statusContact, contactType, created, modified, transactionId)
		VALUES ('".$IdBackgroundCheck."', '', '".$statusContact."', '4', '".$Created."', '','".$idtransaction."')";
		$query = Yii::app()->db->createCommand($data)->execute(); */
	}

	//15-02-2022 Natalia Henao m
	//Insertar registros del log de formulario dinamico en la tabla ses_LogDynamicForm
	public static function insertToLogDynamicF($dateresponse, $bkgid){

		foreach($dateresponse['ans'] as $logdynamicform=>$datalog){
			$logrecorddata=LogDynamicForm::model()->findByAttributes(['idDynamicForm'=>$datalog['id'], 'backgroundcheckId'=>$bkgid]);
			if(!$logrecorddata){
				$logDynamicForm = new LogDynamicForm();
				$logDynamicForm->idDynamicForm=	$datalog['id'];
				$logDynamicForm->backgroundcheckId=	$bkgid;
				$logDynamicForm->ip=$datalog['ip_address'];
				$logDynamicForm->detail=$datalog['detail'];
				$logDynamicForm->createdAt=$datalog['created_at'];
				if (!$logDynamicForm->save()) {
					WebUser::logAccess("Error ingresando el log de formulario Dinámico", $logDynamicForm->backgroundcheck->code);
				}
			}
		}
	}

	public static function getCountContactType($bkgid){

		$query_A='SELECT ct.statusContact, ctp.Type, COUNT(ct.contactType) AS consultas
		FROM ses_Contact ct 
		JOIN ses_ContactType ctp ON ct.contactType=ctp.id
		WHERE ct.backgroundCheckId="'.$bkgid.'"
		GROUP BY ctp.Type, ct.statusContact';
		$allContact = Yii::app()->db->createCommand($query_A)->queryAll();       

        return $allContact;
	}


	public static function idDinamicFormRecover($backgroundCheck, $val){
		
		Yii::import('application.extensions.DynamicForm.*');
		
		if($val==1){
			$ooidFD=$backgroundCheck->ooidFD;
		}else{
			$ooidFD=$backgroundCheck->reciptFileooid;
		}

		if($backgroundCheck){
			if($ooidFD=="" || is_null($ooidFD)){
				$NumId=CHtml::encode($backgroundCheck->idNumber);

				if($val==1){		
					$idAttachment=$backgroundCheck->customerProduct->attachmentFileId;
				}else{		
					$idAttachment=$backgroundCheck->customerProduct->attachmentFileId2;
				}

				if($idAttachment!=""){
					$attachment = AttachmentFile::model()->findByPK($idAttachment);
					$dynamicForm = DynamicFormJSON::model()->findByPK($attachment->idFDJson);
					$questionnaire=$dynamicForm->questionnaireJSON;
				}

				$Object = new DateTime();  
				$time = $Object->format("h:i:s");  
	
				$valid_until=$backgroundCheck->maxInternalDays.' '.$time;
				$dynamicForm = new DynamicForm();
				$toreplace = array("/", " ", "\\", "*", "CE", "NIT", "PEP", "PPT", "PP", "TI");
				$idNumber = str_replace($toreplace, "", $NumId);
				$dateresponse=$dynamicForm->dynamicQuestion($idNumber, $questionnaire, $valid_until);
				if($val==1){
					$backgroundCheck->ooidFD=$dateresponse['ooid'];
					$backgroundCheck->validuntilFD=$valid_until;
					$backgroundCheck->update();
				}else{
					$backgroundCheck->reciptFileooid=$dateresponse['ooid'];
					$backgroundCheck->reciptExpiration=$valid_until;
					$backgroundCheck->update();
				}
			}
		}
	}

	public static function insertContactMailRecover($id){
		
		$dateAct = new \DateTime(" ");
		$Fecha=$dateAct->format('Y-m-d H:i:s');

		$contact = new Contact();
		$contact->backgroundCheckId = $id;
		$contact->comments = '';
		$contact->statusContact = 'Enviado SP';
		$contact->contactType = '2';
		$contact->created = $Fecha;
		$contact->modified = '';
		$contact->transactionId = '';

		if (!$contact->save()) {
			throw new CHttpException(500, 'Server Error.');
		}
	}

	public static function insertContactMailRecoverDoc($id){
		
		$dateAct = new \DateTime(" ");
		$Fecha=$dateAct->format('Y-m-d H:i:s');

		$contact = new Contact();
		$contact->backgroundCheckId = $id;
		$contact->comments = '';
		$contact->statusContact = 'Enviado Doc.';
		$contact->contactType = '2';
		$contact->created = $Fecha;
		$contact->modified = '';
		$contact->transactionId = '';

		if (!$contact->save()) {
			throw new CHttpException(500, 'Server Error.');
		}
	}

	public static function idDinamicFormMasive($bgcId){
		
		Yii::import('application.extensions.DynamicForm.*');
		
		$backgroundCheck = BackgroundCheck::model()->findByPK($bgcId);
		if($backgroundCheck){
			if($backgroundCheck->ooidFD=="" || is_null($backgroundCheck->ooidFD)){
				$NumId=CHtml::encode($backgroundCheck->idNumber);
				$idAttachment=$backgroundCheck->customerProduct->attachmentFileId;
				if($idAttachment!=""){
					$attachment = AttachmentFile::model()->findByPK($idAttachment);
					$dynamicForm = DynamicFormJSON::model()->findByPK($attachment->idFDJson);
					$questionnaire=$dynamicForm->questionnaireJSON;
				}

				$Object = new DateTime();  
				$time = $Object->format("h:i:s");  
	
				$valid_until=$backgroundCheck->maxInternalDays.' '.$time;
				$dynamicForm = new DynamicForm();
				$toreplace = array("/", " ", "\\", "*", "CE", "NIT", "PEP", "PPT", "PP", "TI");
				$idNumber = str_replace($toreplace, "", $NumId);
				$dateresponse=$dynamicForm->dynamicQuestion($idNumber, $questionnaire, $valid_until);

				$backgroundCheck->ooidFD=$dateresponse['ooid'];
				$backgroundCheck->validuntilFD=$valid_until;
				$backgroundCheck->update();
			}
		}
		echo "no tiene oiid para registrar"."\n";
	}

	public static function insertContactMailMasive($id){
		
		$dateAct = new \DateTime(" ");
		$Fecha=$dateAct->format('Y-m-d H:i:s');

		$contact = new Contact();
		$contact->backgroundCheckId = $id;
		$contact->comments = '';
		$contact->statusContact = 'Enviado Masivo';
		$contact->contactType = '2';
		$contact->created = $Fecha;
		$contact->modified = '';
		$contact->transactionId = '';

		if (!$contact->save()) {
			throw new CHttpException(500, 'Server Error.');
		}
	}
//coment
}
