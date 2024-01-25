<?php

/**
 * This is the model class for table "{{VerificationSection}}".
 *
 * The followings are the available columns in table '{{VerificationSection}}':
 * @property integer $id
 * @property integer $backgroundCheckId
 * @property integer $verificationSectionTypeId
 * @property string $comments
 * @property integer $percentCompleted
 *
 * The followings are the available model relations:
 * @property DetailDocument[] $detailDocuments
 * @property DetailEducation[] $detailEducations
 * @property DetailJob[] $detailJobs
 * @property DetailRegister[] $detailRegisters
 * @property DetailHousing[] $detailHousing
 * @property DetailPerson[] $detailFamilyMembers
 * @property DetailPerson[] $detailReferences
 * @property DetailPerson[] $detailPersonsInHouse
 * @property DetailPersonExtras[] $detailPersonExtrases
 * @property BackgroundCheck $backgroundCheck
 * @property VerificationSectionType $verificationSectionType
 * @property DetailQuestion[] $detailGeneralHealth
 * @property DetailQuestion[] $detailAdtionInformation
 * @property DetailCompanyCustomer $detailCompanyCustomer Customers
 * @property DetailCompanyProvider $detailCompanyProvider Provider
 * @property DetailShareholder $detailShareholder Shareholders
 * @property DetailCompanyFinance $detailCompanyFinance detailCompanyFinance
 * @property DetailCompanyVisit $detailCompanyVisit detailCompanyFinance
 * @property DetailEmployees $detailEmployees Employees
 * @property sectionDate $sectionDate sectionDate
 * @property sectionBool $sectionBool sectionBool
 * @property int $showOrder 
 * @property string $xmlAnswer Serialized array answer
 * @property string $htmlSection
 * @property Result $result result
 * 
 * @property AssignedUser[] $asignedUsers
 * 
 * @property XmlSection $xmlSection Xml Section
 */
class VerificationSection extends SVPActiveRecord {

    private $_verificationInProduct = null;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VerificationSection the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{VerificationSection}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('backgroundCheckId, verificationSectionTypeId', 'required'),
            array('backgroundCheckId, verificationSectionTypeId, percentCompleted', 'numerical', 'integerOnly' => true),
            array('comments,sectionDate,sectionBool,resultId', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, backgroundCheckId, verificationSectionTypeId, comments, percentCompleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'detailDocuments' => array(self::HAS_MANY, 'DetailDocument', 'verificationSectionId'),
            'detailStudies' => array(self::HAS_MANY, 'DetailEducation', 'verificationSectionId', 'order' => 'graduationYear ASC'),
            'detailJobs' => array(self::HAS_MANY, 'DetailJob', 'verificationSectionId', 'order' => 'startedOn ASC'),
            'detailRegisters' => array(self::HAS_MANY, 'DetailRegister', 'verificationSectionId'),
            'detailHousing' => array(self::HAS_ONE, 'DetailHousing', 'verificationSectionId'),
            'detailPersons' => array(self::HAS_MANY, 'DetailPerson', 'verificationSectionId'),
            'detailPersonsInHouse' => array(self::HAS_MANY, 'DetailPerson', 'verificationSectionId'),
            'detailPersonExtrases' => array(self::HAS_MANY, 'DetailPersonExtras', 'verificationSectionId'),
            'detailFamilyMembers' => array(self::HAS_MANY, 'DetailPerson', 'verificationSectionId'),
            'detailReferences' => array(self::HAS_MANY, 'DetailPerson', 'verificationSectionId'),
            'detailFinancial' => array(self::HAS_ONE, 'DetailFinancial', 'verificationSectionId'),
            'detailPolygraph' => array(self::HAS_ONE, 'DetailPolygraph', 'verificationSectionId'),
            'detailQuestions' => array(self::HAS_MANY, 'DetailQuestion', 'verificationSectionId'),
            'detailGeneralHealth' => array(self::HAS_MANY, 'DetailQuestion', 'verificationSectionId'),
            'detailOtherInformation' => array(self::HAS_MANY, 'DetailQuestion', 'verificationSectionId'),
            'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundCheckId'),
            'verificationSectionType' => array(self::BELONGS_TO, 'VerificationSectionType', 'verificationSectionTypeId'),
            'detailCompany' => array(self::HAS_MANY, 'DetailCompany', 'verificationSectionId'),
            'detailAudit' => array(self::HAS_MANY, 'DetailAudit', 'verificationSectionId'),
            'detailAuditAttendance' => array(self::HAS_MANY, 'DetailAuditAttendance', 'verificationSectionId'),
            'detailCompanyCustomer' => array(self::HAS_MANY, 'DetailCompany', 'verificationSectionId'),
            'detailCompanyProvider' => array(self::HAS_MANY, 'DetailCompany', 'verificationSectionId'),
            'detailShareholder' => array(self::HAS_MANY, 'DetailShareholder', 'verificationSectionId'),
            'documents' => array(self::HAS_MANY, 'Document', 'verificationSectionId'),
            'detailCompanyVisit' => array(self::HAS_ONE, 'DetailCompanyVisit', 'verificationSectionId'),
            'detailCompanyFinance' => array(self::HAS_ONE, 'DetailCompanyFinance', 'verificationSectionId'),
            'detailCompanyFinantialAnalys' => array(self::HAS_ONE, 'DetailCompanyFinantialAnalys', 'verificationSectionId'),
            'detailCompanyEmployee' => array(self::HAS_MANY, 'DetailQuestion', 'verificationSectionId'),
            'xmlSection' => array(self::HAS_ONE, 'XmlSection', 'verificationSectionId'),
            'htmlSection' => array(self::HAS_ONE, 'HtmlSection', 'verificationSectionId'),
            'result' => array(self::BELONGS_TO, 'Result', 'resultId'),
            'assignedUsers' => array(self::HAS_MANY, 'AssignedUser', 'verificationSectionId'),
            'tracking' => array(self::HAS_MANY, 'Tracking', 'verificationSectionId'),
            'detailImport' => array(self::HAS_MANY, 'DetailImport', 'verificationSectionId'), 
            'detailExport' => array(self::HAS_MANY, 'DetailExport', 'verificationSectionId'), 
            'detailDatCompany' => array(self::HAS_MANY, 'DetailDatCompany', 'verificationSectionId'), 
            'detailContactPerson' => array(self::HAS_MANY, 'DetailContactPerson', 'verificationSectionId'),
            'detailDatShareHolders' => array(self::HAS_MANY, 'DetailDatShareHolders', 'verificationSectionId'), 
            'detailAddress' => array(self::HAS_MANY, 'DetailAddress', 'verificationSectionId'),
            'detailComments' => array(self::HAS_MANY, 'DetailComments', 'verificationSectionId'),
            'detailCommercialRef' => array(self::HAS_MANY, 'DetailCommercialRef', 'verificationSectionId'), 
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'backgroundCheckId' => 'Background Check',
            'verificationSectionTypeId' => 'Verification Section Type',
            'comments' => 'Comentarios',
            'percentCompleted' => '% avance',
            'sectionDate' => 'Fecha',
            'sectionBool' => 'Bool',
            'resultId' => 'Resultado',
            'numberOfVerifications' => 'Verificaciones',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('backgroundCheckId', $this->backgroundCheckId);
        $criteria->compare('verificationSectionTypeId', $this->verificationSectionTypeId);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('percentCompleted', $this->percentCompleted);
        $criteria->compare('sectiondate', $this->sectionDate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    static public function diffTime($time1, $time2) {
        $ans = "";
        if (substr($time1, 0, 10) == '0000-00-00') {
            $datetime1 = new DateTime('now');
        } else {
            $datetime1 = new DateTime($time1);
        }
        if (substr($time2, 0, 10) == '0000-00-00') {
            $datetime2 = new DateTime('now');
        } else {
            $datetime2 = new DateTime($time2);
        }
        $interval = $datetime2->diff($datetime1);
        $ans = $interval->format('%ya,%mm');
        return $ans;
    }

    static public function diffTimeIsBiggerThan($time1, $time2, $maxDays) {
        $ans = "";
        if (substr($time1, 0, 10) == '0000-00-00') {
            $datetime1 = new DateTime('now');
        } else {
            $datetime1 = new DateTime($time1);
        }
        if (substr($time2, 0, 10) == '0000-00-00') {
            $datetime2 = new DateTime('now');
        } else {
            $datetime2 = new DateTime($time2);
        }
        $interval = $datetime1->diff($datetime2);
        $ans = $interval->format('%R%a');
        return ( (int) $ans > $maxDays);
    }

    public function getHasDetail() {
        $hasDetail = true;
        $field = $this->verificationSectionType->fieldId;
        if (is_array($this->$field)) {
            if (count($this->$field) > 0) {
                $hasDetail = true;
            } else {
                $hasDetail = false;
            }
        } else {
            $hasDetail = true;
        }
        return $hasDetail;
    }

    public function beforeSave() {
        $ansBeforeSave = parent::beforeSave();
        if ($ansBeforeSave && !$this->isNewRecord) {
            $finished = 0;
            $field = $this->verificationSectionType->fieldId;
            if (is_array($this->$field)) {
                $numDetails = count($this->$field);
                foreach ($this->$field as $detail) {       
                    if ($detail->verificationResultId != VerificationResult::PENDING) {
                        $finished++;
                    }
                }
            } else {
                $numDetails = 1;
                if ($this->$field->verificationResultId != VerificationResult::PENDING) {
                    $finished++;
                }
            }
            if ($numDetails > 0) {
                $ans = round($finished / $numDetails * 100, 0);
   
            } else {
                if (strlen($this->comments) > 5) {
              
                    $ans = 100;
                } else {
                    $ans = 0;
                }
            }
            
            if ($ans != $this->percentCompleted) {
                $this->percentCompleted = $ans;
            }
            
        }
        return $ansBeforeSave;
    }

    public function createBasicRecords() {
        call_user_func($this->verificationSectionType->class . "::createBasicRecords", $this->id);
    }

    public function getSectionName() {
        return $this->verificationSectionType->name;
    }
	
    public function getSectionNick() {
        return $this->verificationSectionType->nick;
    }

    public function getNumberOfVerifications() {
        $ans = 0;
        if ($this->percentCompleted>=100) {
            switch ($this->verificationSectionTypeId) {
                case VerificationSectionType::REFERENCES :
                    $ans = count($this->detailReferences);
                    break;
                case VerificationSectionType::EDUCATION :
                    $ans = count($this->detailStudies);
                    break;
                case VerificationSectionType::JOBS:
                    $ans = count($this->detailJobs);
                    break;
                default:
                    $ans = 1;
            }
        }
        return $ans;
    }

    public function getIsAReferencePerson() {
        return ($this->verificationSectionTypeId == VerificationSectionType::REFERENCES ? true : false);
    }

    public function getIsXmlSection() {
        return ($this->verificationSectionType->isXmlSection);
    }

    public function getIsHtmlSection() {
        return ($this->verificationSectionType->isHtmlSection);
    }

    public function userHasAccess($userId) {
        $criteria = new CDbCriteria;
        $criteria->addCondition('userId = :userId');
        $criteria->addCondition('(verificationSectionId = :verificationSectionId or (backgroundCheckId=:backgroundCheckId and verificationSectionId is null))');
        $criteria->addCondition('finishedAt is null');
        $criteria->params = array(
            ':userId' => $userId,
            ':verificationSectionId' => $this->id,
            'backgroundCheckId' => $this->backgroundCheckId,
        );
        $assignedUsers = AssignedUser::model()->count($criteria);
        return ($assignedUsers > 0);
    }

    public function getUserCanFinish($idUser) {
        $ans = false;
        foreach ($this->assignedUsers as $assignedUser) {
            /* @var AssignedUser $assignedUser */
            if ($assignedUser->userId == $idUser) {
                $ans = true;
                break;
            }
        }
        return $ans;
    }

    public function getVerificationInProduct() {
        if (!$this->_verificationInProduct) {
            $this->_verificationInProduct = VerificationInProduct::model()->findByAttributes(
                    array(
                        'customerProductId' => $this->backgroundCheck->customerProductId,
                        'verificationSectionTypeId' => $this->verificationSectionTypeId,
                    )
            );
        }
        return $this->_verificationInProduct;
    }

    public static function sendTextMessageSection($id, $link){
		
		$backgroundCheck = BackgroundCheck::model()->findByPK($id);

		$nombre=CHtml::encode($backgroundCheck->firstName).' '.CHtml::encode($backgroundCheck->lastName);
		$empresa=CHtml::encode($backgroundCheck->customer->name);
		$email=CHtml::encode($backgroundCheck->email);
		$mobil=CHtml::encode($backgroundCheck->mobile);

		$data=[
			"country"=> 57,
			"dateToSend"=> "",
			"message"=> "Hola $nombre, Nuestro visitador nos notifica que ya finalizó tu visita, en SINTECTO te invitamos en el siguiente link para que nos indiques tu satisfacción con la atención y servicio brindado será de gran ayuda. Muchas gracias!",
			"encoding"=> "",
			"messageFormat"=> 1,
			"addresseeList"=> [
				[
					"mobile"=> $mobil,
					"correlationLabel"=> "corelation ejemplo",
					"url"=> "$link"
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

    //proceso de coface
    public function getSectionImport(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailImport dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_verificationresult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsImport = Yii::app()->db->createCommand($query_A)->queryAll();

        /*$criteria = new CDbCriteria;
        $criteria->addCondition('backgroundCheck.customerId=985');
        $criteria->with = array(
            'verificationSection',
            'verificationSection.backgroundCheck',
            'verificationSection.backgroundCheck.customer',
            'verificationSection.backgroundCheck.customer.customerGroup',
            'verificationSection.backgroundCheck.result',
            'verificationResult'
        );

        $criteria->order = 't.id ASC';

        $reports = DetailImport::model()->findAll($criteria);*/
        return $reportsImport;
    }

    public function getSectionExport(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailExport dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_verificationresult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsExport = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsExport;
    }

    public function getSectionCompany(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailDatCompany dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsCompany = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsCompany;
    }

    public function getSectionContactPerson(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName AS backcliente, bc.idNumber AS backidnumber , bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailContactPerson dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsContactPerson = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsContactPerson;
    }

    public function getSectionShareHolders(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailDatShareHolders dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsShareHolders = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsShareHolders;
    }

    public function getSectionAddress(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailAddress dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsAddress = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsAddress;
    }

    public function getSectionComments(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, dcf.* 
        FROM ses_DetailComments dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsComments = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsComments;
    }

    public function getSectionFinantialAnalys(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.lastName, bc.idNumber, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, vs.comments, dcf.* 
        FROM ses_DetailCompanyFinantialAnalys dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";
        $reportsFinantialAnalys = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsFinantialAnalys;
    }

    public function getSectionTraking(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, vs.comments, bc.lastName, bc.idNumber, dcf.* 
        FROM ses_Tracking dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";

        $reportsTraking = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsTraking;
    }

    public function getSectionCommercialRef(){

        $query_A="SELECT cg.NAME AS Grupo_Cliente, ct.NAME AS Cliente, bc.CODE AS Codigo, rs.NAME AS Estado, vr.name AS resultado, 
        vs.comments, bc.lastName, bc.idNumber, dcf.* 
        FROM ses_DetailCommercialRef dcf
        JOIN ses_VerificationSection vs ON (vs.id=dcf.verificationSectionId)
        JOIN ses_BackgroundCheck bc ON ( bc.id=vs.backgroundCheckId)
        JOIN ses_Customer ct ON ( ct.id=bc.customerId)
        JOIN ses_CustomerGroup cg ON ( cg.id=ct.customerGroupId)
        JOIN ses_Result rs ON (rs.id=bc.resultId)
        JOIN ses_VerificationResult vr ON vr.id=dcf.verificationResultId
        WHERE bc.customerId=985";

        $reportsCommercialRef = Yii::app()->db->createCommand($query_A)->queryAll();

        return $reportsCommercialRef;
    }

    
}
//coment
