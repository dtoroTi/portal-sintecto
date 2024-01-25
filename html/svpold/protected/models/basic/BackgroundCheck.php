<?php

/**
 * This is the model class for table "{{BackgroundCheck}}".
 *
 * The followings are the available columns in table '{{BackgroundCheck}}':
 * @property integer $id
 * @property integer $customerProductId
 * @property integer $backgroundCheckStatusId
 * @property integer $requestSystemId
 * @property string $firstName
 * @property string $lastName
 * @property string $idNumber
 * @property string $city
 * @property string $customerField1
 * @property string $customerField2
 * @property string $customerField3
 * @property string $customerField4
 * @property string $customerField5
 * @property string $customerField6
 * @property string $customerField7
 * @property string $customerField8
 * @property string $customerField9
 * @property integer $personContacted
 * @property string $studyStartedOn
 * @property string $studyLimitOn
 * @property string $approvedOn
 * @property string $comments
 * @property string $created
 * @property string $modified
 * @property string $result
 * @property string $customerUserId
 * @property string $idFrom
 * @property string $relationshipStatusId
 * @property integer $birthday
 * @property string $tels
 * @property string $area
 * @property string $address
 * @property string $state
 * @property string $conclusion
 * @property string $createdOn
 * @property string $modifiedOn
 * @property string $actualJob
 * @property string $applyToPosition
 * @property string $customerComments Comments from the customer
 * @property string $code Is the code used to search for the record
 * @property string $seed
 * @property string $findingtextPoly
 * @property string $findingdropPoly
 * @property string $findingtextBackg
 * @property string $findingdropBackg
 * @property string $findingtextrestrList
 * @property string $findingdroprestrList
 * @property string $findingtextDoc
 * @property string $findingdropDoc
 * @property string $findingtextStudy
 * @property string $findingtextLaboral
 * @property integer $age
 * @property integer $days
 * @property integer $cost
 * @property integer $price
 * @property integer $daysStudy
 * @property integer $daysChecker
 * @property integer $eventCounter
 * @property integet $numberOfDownloads Number of downloads by the customers
 * @property integer $reportAvailable Is the report avaiable
 * @property integer $temporalReportAvailable Is the report avaiable
 * @property text $xmlAnswer The Answer of a XML Question
 * @property text $questionFormat Format of the xmlQuestion
 * @property boolean $isPending The Study is not cancelled nor Finished
 * @property string $contactPerson Contact Person in the company
 * @property text $htmlSection The Answer of HTML section
 * @property boolean $inAmendment
 * @property integer $additionalPrice Additional Price
 * @property string $additionalPriceComment Detail of the additional price
 *
 * @property integer $responsibleUserId This field is only for search
 *
 * @property integer $approvedBy The person who approve the study
 * @property integer $approvedOn Date of the study approval
 * @property string $assignedOn The Date time when was assigned
 *
 * The followings are the available model relations:
 * @property RequestSystem $requestSystem
 * @property BackgroundCheckStatus $backgroundCheckStatus
 * @property CustomerProduct $customerProduct
 * @property Event[] $events
 * @property Contact[] $contacts
 * @property LogDynamicForm[] $logDynamicForms
 * @property VerificationSection[] $verificationSections 
 * @property boolean $findingLaboralHistory Finding in the Laboral History
 * @property boolean $findingSocioeconomic Finding in the Socioeconomic History
 * @property boolean $findingVisit Finding in the Visit
 * @property boolean $findingReturn Return Internaly
 * @property date $deliveredToCustomerOn Delivered to the customerOn
 * @property date $returnedByCheckerOn Returned by the Checker
 * @property boolean $hasExtraDay Returned by the Checker
 * @property boolean $isApproved by the Checker
 * @property boolean $notifyByMail return if the study has to be notify by mail
 * @property boolean $findingStudy Finding in the Studies
 * @property boolean $findingPolygraph Finding in the Polygraph
 * @property boolean $findingOther Finding in other
 * @property boolean $findingBackground in Background
 * @property boolean $findingTestPsychote in TestPsychote
 * @property boolean $findingODT in ODT
 * @property boolean $findingfinantAnalys in finantAnalys
 * @property boolean $findingAudit in Audit
 * @property boolean $findingrestricList in restricList
 * @property boolean $findingDoc in Doc

 * @property int $verificationSectionTypeId This property is to search for the typeId
 * @property int $verificationSectionGroupId This property is to search for the groupId
 *
 * @property date $studyLimitOnFrom LimitFrom only for search
 * @property date $studyLimitOnUntil LimitFrom only for search
 * @property date $createdOnFrom created only for search
 * @property date $createdOnUntil created only for search
 * @property Invoice $invoideId reference to Inoivce table
 * @property date $deliveredToCustomerOnFrom deliveredFrom only for search
 * @property date $deliveredToCustomerOnUntil deliveredUntil only for search
 * @property boolean $hasSectionsWithoutUser
 *
 *
 * @property string $absolutePath Absolute Path to the report
 *
 * @property int $assignedUserId user Id for search
 * @property string $customerProductName for search string
 * @property int $customerGroupId  Id of the customer Group
 *
 * @property int $invoiceSelection invoice Selction only for Invoice Search
 * @property boolean $hasInvoice Used in select
 *
 * @property boolean $isOnlyAdvese Search if the sections includes only adverse section
 * @property string $backgroundCheckType Is the type defined by SAV
 *
 * @property integer $isTemporalReportAvailable Is the report avaiable
 * 
 * @property CustomerUser $customerUser 
 * @property Customer $customer Customer Object
 * @property CustomerProduct $customerProduct  CustomerProduct Object
 * @property Result $result Result Object
 * @property boolean $certificateAvailable 
 * 
 * @property boolean $isCompanySurvey Returns if is a CompanySuervey
 * @property string $absolutePath Return getAboslutePath()
 * @property string $absolutePathCert Return getAboslutePathCet()
 * @property boolean $isReportAvailable getIsReportAvailable()
 * 
 * @property date $approvedOnLongFormat delivered on Long Format
 * @property date $oneDayBeforeLimit 
 * @property string $sectionsSummary
 * @property date $expirationDate
 * @property string $fullname
 * @property string formatedIdNumber
 * @property integer $ciiu
 * @property string $descriptionCiiu
 * @property string $email
 * @property string $webPage
 * @property string $supplierClassification
 * @property string $shareholderType
 * @property string $evaluationResult
 * @property string $evaluationValue
 * @property integer $yearsOfActivity
 * @property integer $companySizeByActives
 * @property string $SupplierOrigin
 * @property date $expireIn
 * @property integer $codVerification
 * @property string $typeProduct
 * @property string $typeStudy
 * @property string $datexpedition
 * @property string $pagesPDF 
 * @property date $tempdateRep  
 * @property string $WorkflowID new id return GZF 
 * @property string $observationToCustomer Customer Observations
 * @property integer $bossContact 
 * @property boolean $qualityLaboral
 * @property string $qualitytextLaboral 
 * @property boolean $qualityEducation
 * @property string $qualitytextEducation 
 * @property boolean $qualityFinanlcial
 * @property string $qualitytextFinancial 
 * @property boolean $qualityAdverse
 * @property string $qualitytextAdverse 
 * @property boolean $qualityVisit
 * @property string $qualitytextVisit 
 * @property boolean $qualityPolygraph
 * @property string $qualitytextPolygraph 
 * @property boolean $qualityTest
 * @property string $qualitytextTest 
 * @property integer $qualityReturDev 
 * @property boolean $qualityPQR
 * @property boolean $qualityComplain
 * @property string $mobile
 * @property string $ooidFD
 * @property string $validuntilFD
 * @property boolean $statusFD
 * @property boolean $qualityGesDocument
 * @property string $qualityTextGesDocument
 * @property string $qualityReturn
 * @property string $qualityReturnPer
 * @property boolean $qualityLaboralPNC
 * @property boolean $qualityLaboralPQR
 * @property boolean $qualityEducationPNC
 * @property boolean $qualityEducationPQR
 * @property boolean $qualityFinanlcialPNC
 * @property boolean $qualityFinanlcialPQR
 * @property boolean $qualityAdversePNC
 * @property boolean $qualityAdversePQR
 * @property boolean $qualityVisitPNC
 * @property boolean $qualityVisitPQR
 * @property boolean $qualityPolygraphPNC
 * @property boolean $qualityPolygraphPQR
 * @property boolean $qualityTestPQR
 * @property boolean $qualityTestPNC
 * @property boolean $qualityGesDocumentPQR
 * @property boolean $qualityGesDocumentPNC
 * @property string $dateLimitQuality
 * 
 * @property boolean $qualityShareholder
 * @property string $qualitytextShareholder
 * @property boolean $qualityShareholderPQR
 * @property boolean $qualityShareholderPNC
 * 
 * @property boolean $qualityCustomer
 * @property string $qualitytextCustomer
 * @property boolean $qualityCustomerPQR
 * @property boolean $qualityCustomerPNC
 * 
 * @property boolean $qualityProvider
 * @property string $qualitytextProvider
 * @property boolean $qualityProviderPQR
 * @property boolean $qualityProviderPNC
 * 
 * @property boolean $qualityFinance
 * @property string $qualitytextFinance
 * @property boolean $qualityFinancePQR
 * @property boolean $qualityFinancePNC
 * 
 * @property boolean $qualityFinantialAnalys
 * @property string $qualitytextFinantialAnalys
 * @property boolean $qualityFinantialAnalysPQR
 * @property boolean $qualityFinantialAnalysPNC
 * 
 * @property boolean $qualityCompanyVisit
 * @property string $qualitytextCompanyVisit
 * @property boolean $qualityCompanyVisitPQR
 * @property boolean $qualityCompanyVisitPNC
 * 
 * @property boolean $qualityReference
 * @property string $qualitytextReference
 * @property boolean $qualityReferencePQR
 * @property boolean $qualityReferencePNC
 * 
 * @property string $customerProductPreliminary
 * @property string $salarytobeEarned

 * 
 * @property string $reciptFileooid
 * @property string $reciptExpiration
 * @property boolean $reciptFileStatus
 * 
 * @property boolean $startStudy
 */
class BackgroundCheck extends SVPActiveRecord {

    const S_PENDING = 1;
    const S_ONTIME = 2;
    const S_TOTAL_PENDING = 3;
    const S_TOTAL_PENDING_USER = 4;
    const S_OVERDUE = 5;
    const S_OVERDUE_7 = 6;
    const S_OVERDUE_30 = 7;
    const S_EVENTS = 8;
    const S_NOT_PENDING = 9;
    const S_NOT_APPROVED = 10;
    const S_APPROVED_THIS_MONTH = 11;
    const S_APPROVED_PREVIOUS_MONTH = 12;
    const S_APPROVED_PREVIOUS_2MONTH = 13;
    const S_TOTAL_NOT_PENDING = 14;
    const S_NOT_PUBLISHED = 15;
    const S_NO_PRICE = 16;
    const S_NO_INVOICE = 17;
    const S_OPEN_INVOICE = 18;
    const DEFAULT_COMPANY_FIRSTNAME = 'EMPRESA';

    public $customerId;
    public $blacklist;
    public $createdOnFrom;
    public $createdOnUntil;
    public $studyStartedOnFrom;
    public $studyStartedOnUntil;
    public $studyLimitOnFrom;
    public $studyLimitOnUntil;
    public $deliveredToCustomerOnFrom;
    public $deliveredToCustomerOnUntil;
    public $approvedOnFrom;
    public $approvedOnUntil;
    public $assignedUserId;
    public $customerProductName;
    public $responsibleUserId;
    public $customerGroupId;
    public $invoiceSelection;
    public $hasSectionsWithoutUser;
    public $verificationSectionTypeId;
    public $verificationSectionGroupId;
    public $contactType;
    public $customerProductviewDynamicForm=null;
    public $customerProductPreliminary=null;
    public $document;

    public $expireIn;

    // only for Invoice Module
    public $hasInvoice;
    private $_verificationSectionTypes = null;
    private $_pendindToDelete = array();
    static private $_allSections = null;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BackgroundCheck the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{BackgroundCheck}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'customerProductId, backgroundCheckStatusId, requestSystemId, firstName' .
                ', lastName, idNumber, studyLimitOn, created' .
                ', customerUserId, customerId',
                'required'
            ),
            array(
                'state, city, address, tels, contactPerson, email, mobile',
                'required',
                'on' => 'createCompany'
            ),
            array(
                'applyToPosition,email',
                'required',
                'on' => 'createPerson',
            ),
            array('mobile',
                'match', 
                'pattern'=>'/^([+]?[0-9 ]+)$/', 
                'message'=>'Celular invalido, solo se permiten números.'
            ),
            array(
                'customerProductId, approvedBy, backgroundCheckStatusId, requestSystemId,customerId,numberOfDownloads, yearsOfActivity,codVerification, companySizeByActives, pagesPDF, qualityReturDev',
                'numerical',
                'integerOnly' => true,
                'allowEmpty' => True
            ),
            array(
                'personContacted,findingLaboralHistory, findingSocioeconomic, findingVisit'
                . ',findingReturn,findingStudy,findingPolygraph,findingOther,findingBackground,findingTestPsychote,findingODT,findingfinantAnalys,findingAudit,findingrestricList,findingDoc'
                . ',reportAvailable,temporalReportAvailable,certificateAvailable, bossContact, qualityLaboral, qualityEducation, qualityFinanlcial, qualityAdverse, qualityVisit, qualityPolygraph, qualityTest, qualityPQR, qualityComplain, qualityGesDocument, qualityLaboralPNC, qualityLaboralPQR, qualityEducationPNC, qualityEducationPQR, qualityFinanlcialPNC, qualityFinanlcialPQR, qualityAdversePNC, qualityAdversePQR, 
                qualityVisitPNC, qualityVisitPQR, qualityPolygraphPNC, qualityPolygraphPQR, qualityTestPQR, qualityTestPNC, qualityGesDocumentPQR, qualityGesDocumentPNC, qualityShareholderPQR, qualityShareholderPNC, qualityCustomerPQR, qualityCustomerPNC, qualityProviderPQR, qualityProviderPNC, qualityFinancePQR, qualityFinancePNC, qualityFinantialAnalysPQR, qualityFinantialAnalysPNC, qualityCompanyVisitPQR, qualityCompanyVisitPNC, qualityReferencePQR, qualityReferencePNC, startStudy',
                'boolean'
            ),
            array(
                'firstName, lastName, idNumber, datexpedition,  '
                . 'customerField1,customerField2, customerField3,'
                . 'customerField4,customerField5, customerField6,'
                . 'customerField7,customerField8, customerField9, ciiu,'
                . 'findingtextPoly,findingdropPoly,findingtextBackg,findingdropBackg,findingtextrestrList,findingtextDoc,findingdroprestrList,findingdropDoc,findingtextStudy, findingtextLaboral, address, contactPerson, email, webPage, descriptionCiiu, companySizeByActives, SupplierOrigin, additionalPriceComment, observationToCustomer, WorkflowID, typeProduct, typeStudy, qualitytextLaboral, qualitytextEducation, qualitytextFinancial, qualitytextAdverse, qualitytextVisit, qualitytextPolygraph, qualitytextTest, qualityTextGesDocument, qualityReturn, qualityReturnPer, qualityShareholder, qualitytextShareholder, qualityCustomer, qualitytextCustomer, qualityProvider, qualitytextProvider, qualityFinance, qualitytextFinance, qualityFinantialAnalys, qualitytextFinantialAnalys, qualityCompanyVisit, qualitytextCompanyVisit, qualityReference, qualitytextReference, salarytobeEarned',
                'length',
                'max' => 255
            ),

            array('mobile',
            'length',
            'max' => 10
            ),

            array('applyToPosition, actualJob',
            'length',
            'max' => 200
            ),

            array('tels, state, city, yearsOfActivity, '
            . 'cost, price, additionalPrice',
            'length',
            'max' => 45
            ),
            
            array('birthPlace, area',
            'length',
            'max' => 100
            ),

            array(
                'idFrom, relationshipStatusId, address, tels, birthday, actualJob,' .
                'applyToPosition, comments, modified,resultId, ' .
                'studyStartedOnFrom, studyStartedOnUntil, customerComments, ' .
                'approvedOnFrom, approvedOnUntil, ' .
                'assignedOn, studyStartedOn, approvedOn, expireIn,' .
                'deliveredToCustomerOn, tempdateRep, returnedByCheckerOn, datexpedition, ' .
                'hasExtraDay,cost,price,additionalPrice,additionalPriceComment,invoiceId,contactPerson, '.
                'ciiu, descriptionCiiu,SupplierOrigin, email, webPage, supplierClassification, shareholderType, yearsOfActivity,codVerification, companySizeByActives, evaluationResult, evaluationValue, WorkflowID, pagesPDF, mobile, dateLimitQuality, startStudy' ,
                'safe'
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'retultId', 'checkValidResult', 'on' => 'extraCheck'
            ),
            array(
                'id, customerProductId, backgroundCheckStatusId, requestSystemId, ' .
                'firstName, lastName, idNumber, city, customerField1, customerField2, ' .
                'customerField3, customerField4, customerField5, customerField6, ' .
                'customerField7, customerField8, customerField9, ' .
                'personContacted, studyStartedOn, studyLimitOn, expireIn,' .
                'comments, created, modified,customerUserId,customerId,resultId,relationshipStatus, ' .
                'code,area,numberOfDownloads,reportAvailable,checkerId,visitorId, ' .
                'assignedUserId,simpleSutdy,customerProductName,responsibleUserId, ' .
                'studyLimitOnFrom,studyLimitOnUntil,createdOnFrom,createdOnUntil, ' .
                'customerGroupId,deliveredToCustomerOnFrom,deliveredToCustomerOnUntil,tempdateRep, datexpedition,' .
                'invoiceSelection,hasInvoice,certificateAvailable,inAmendment,additionalPrice, ' .
                'additionalPriceComment,hasSectionsWithoutUser,verificationSectionTypeId,verificationSectionGroupId, '.
                'ciiu, descriptionCiiu,SupplierOrigin, email, webPage, supplierClassification, shareholderType, observationToCustomer, yearsOfActivity,codVerification, companySizeByActives, evaluationResult, evaluationValue, typeProduct, typeStudy, WorkflowID, bossContact, qualityReturDev, mobile, contactType,dateLimitQuality,customerProductPreliminary, document, validuntilFD, reciptExpiration, contactType, startStudy, statusFD, reciptFileStatus',
                'safe',
                'on' => 'search,searchForInvoice,searchForAssign,searchForPiloto, searchRecover',
            ),
            array(
                'customerProductId, code, contactType, customerProductviewDynamicForm, backgroundCheckStatusId, document',
                'safe',
                'on' => 'searchContacts',
            ),
            array(
                'id, commercialName, commercialPosition, commercialEmail, commercialPhone, ',
                'safe'
            ),
                // Default
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'approved' => array(
                self::BELONGS_TO,
                'User',
                'approvedBy'
            ),
            'requestSystem' => array(
                self::BELONGS_TO,
                'RequestSystem',
                'requestSystemId'
            ),
            'backgroundCheckStatus' => array(
                self::BELONGS_TO,
                'BackgroundCheckStatus',
                'backgroundCheckStatusId'
            ),
            'customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customerId'
            ),
            'customerProduct' => array(
                self::BELONGS_TO,
                'CustomerProduct',
                'customerProductId'
            ),
            'customerUser' => array(
                self::BELONGS_TO,
                'CustomerUser',
                'customerUserId'
            ),
            'result' => array(
                self::BELONGS_TO,
                'Result',
                'resultId'
            ),
            'relationshipStatus' => array(
                self::BELONGS_TO,
                'RelationshipStatus',
                'relationshipStatusId'
            ),
            'events' => array(
                self::HAS_MANY,
                'Event',
                'backgroundCheckId',
                'order' => 'events.created DESC'
            ),
            'verificationSections' => array(
                self::HAS_MANY,
                'VerificationSection',
                'backgroundCheckId',
                'with' => 'verificationSectionType',
                'order' => 'verificationSections.showOrder ASC, verificationSectionType.showOrder ASC'
            ),
            'verificationSectionsSearch1' => array(
                self::HAS_MANY,
                'VerificationSection',
                'backgroundCheckId',
            ),
            'verificationSectionsSearch2' => array(
                self::HAS_MANY,
                'VerificationSection',
                'backgroundCheckId',
            ),
            'verificationSectionTypes' => array(
                self::HAS_MANY,
                'VerificationSectionType',
                array('verificationSectionTypeId' => 'id'),
                'through' => 'verificationSections',
            ),
            'verificationSectionGroups' => array(
                self::HAS_MANY,
                'VerificationSectionGroup',
                array('verificationSectionGroupId' => 'id'),
                'through' => 'verificationSectionTypes',
            ),
            'documents' => array(
                self::HAS_MANY,
                'Document',
                'backgroundCheckId',
                'order' => 'showOrder ASC'
            ),
            'assignedUsers' => array(
                self::HAS_MANY,
                'AssignedUser',
                'backgroundCheckId'
            ),
            'assignedUsersSearch' => array(
                self::HAS_MANY,
                'AssignedUser',
                'backgroundCheckId'
            ),
//            'log' => array(
//                self::HAS_MANY,
//                'Log',
//                array('backgroundCheckCode'=>'code'),
//                'order' => 'created ASC'
//            ),
            'invoice' => array(
                self::BELONGS_TO,
                'Invoice',
                'invoiceId'
            ),

            'contacts' => array(
                self::HAS_MANY,
                'Contact',
                'backgroundCheckId',
                'order' => 'contacts.id DESC'
            ),

            'TusDatosResponse' => array(
                self::HAS_MANY,
                'TusDatosResponse',
                'backgroundcheckId',
                'order' => 'TusDatosResponse.id DESC'
            ),

            'logDynamicForms' => array(
                self::HAS_MANY,
                'LogDynamicForm',
                'backgroundCheckId',
                'order' => 'logDynamicForms.id DESC'
            ),

            'requestsSACs' => array(
                self::HAS_MANY,
                'RequestsSAC',
                'backgroundCheckId',
                'order' => 'requestsSACs.id DESC'
            ),

            'candidateCallsAll' => array(
                self::HAS_MANY,
                'CandidateCalls',
                'backgroundCheckId',
                'order' => 'candidateCallsAll.id DESC'
            ),

            'invoiceVisit' => array(
                self::BELONGS_TO,
                'InvoiceVisit',
                'invoiceVisitId'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'customerProductId' => 'Producto de Cliente',
            'backgroundCheckStatusId' => 'Estado del proceso',
            'requestSystemId' => 'Solicitado por medio de:',
            'firstName' => 'Nombres',
            'lastName' => 'Apellidos',
            'idNumber' => 'No. ID',
            'city' => 'Ciudad de Estudio',
            'customerField1' => 'Campo Personalizado1',
            'customerField2' => 'Campo Personalizado2',
            'customerField3' => 'Campo Personalizado3',
            'customerField4' => 'Campo Personalizado4',
            'customerField5' => 'Campo Personalizado5',
            'customerField6' => 'Campo Personalizado6',
            'personContacted' => 'Contactado',
            'studyStartedOn' => 'Solicitado',
            'studyStartedOnFrom' => 'Solicitado desde',
            'studyStartedOnUntil' => 'Solicitado hasta',
            'approvedOnFrom' => 'Aprobado desde',
            'approvedOnUntil' => 'Aprobado hasta',
            'studyLimitOn' => 'Limite',
            'expireIn' => 'Venc.',
            'dateLimitQuality'=> 'Fecha Calidad',
            'comments' => 'Análisis, Observaciones o Conclusiones',
            'created' => 'Creado',
            'modified' => 'Modificado',
            'resultId' => 'Resultado de la Evaluación',
            'customerUserId' => 'Usuario de Cliente',
            'customerId' => 'Empresa',
            'idFrom' => 'Expedida en',
            'relationshipStatusId' => 'Estado civil',
            'birthday' => 'Fecha de Nacimiento',
            'tels' => 'Teléfono',
            'mobile'=>'Celular',
            'area' => 'Barrio',
            'address' => 'Dirección',
            'state' => 'Departamento Est.',
            'conclusion' => 'Conclusión',
            'createdOn' => 'Creado en',
            'modifiedOn' => 'Modificado en',
            'actualJob' => 'Cargo Actual',
            'applyToPosition' => 'Cargo al que Aspira',
            'name' => 'Nombre',
            'customerComments' => 'Comentarios',
            'code' => 'Ref.',
            'age' => 'Edad',
            'assignedOn' => 'Asignado en',
            'approvedBy' => 'Aprob. Por',
            'approvedOn' => 'Aprob. En',
            'findingLaboralHistory' => 'Hallazgo Laboral',
            'findingSocioeconomic' => 'Hallazgo Central de Riesgo',
            'findingVisit' => 'Hallazgo en la Visita',
            'findingReturn' => 'Hallazgo Retornado internamente',
            'findingStudy' => 'Hallazgo Académico',
            'findingPolygraph' => 'Hallazgo en Polígrafo',
            'findingOther' => 'Otros Hallazgo',
            'findingBackground' => 'Hallazgo Antecedentes',
            'findingTestPsychote' => 'Hallazgo Pruebas Psicotecnicas',
            'findingODT' => 'Hallazgo ODT',
            'findingfinantAnalys' => 'Hallazgo Análisis Financiero',
            'findingAudit' => 'Hallazgo Auditoria',
            'findingrestricList' => 'Hallazgo Lista Restric',
            'findingDoc' => 'Hallazgo Documentos',
            'findingtextPoly' => 'Texto Poligrafia',
            'findingdropPoly' => 'Lista Despl Poligrafia',
            'findingtextBackg' => 'Texto Antecedentes',
            'findingdropBackg' => 'Lista Despl Antecedentes',
            'findingdroprestrList' => 'Lista Despl Lista Restric',
            'findingtextrestrList' => 'Texto Lista Restric',
            'findingdropDoc' => 'Lista Despl Documentos',
            'findingtextDoc' => 'Texto Documentos',
            'findingtextStudy' =>'Texto Academico',
            'findingtextLaboral' =>'Texto Laboral',
            'deliveredToCustomerOn' => 'Entregado al Cliente',
            'returnedByCheckerOn' => 'Entrega Profesional',
            'hasExtraDay' => 'Tiene un día Extra',
            'daysStudy' => 'D.Es',
            'daysChecker' => 'D.Ev',
            'numberOfEvents' => 'Nov.',
            'findings' => 'Hallazgo',
            'findingslite' => 'Categoria H.',
            'cost' => 'Costo Estudio',
            'price' => 'Valor al cliente',
            'isApproved' => 'Apr.',
            'birthPlace' => 'Lugar de nacimiento',
            'numberOfDownloads' => 'Número de descargas',
            'responsibleUserId' => 'Responsable',
            'studyLimitOnFrom' => 'Limite Desde',
            'studyLimitOnUntil' => 'Limite Hasta',
            'createdOnFrom' => 'Creado Desde',
            'createdOnUntil' => 'Creado Hasta',
            'deliveredToCustomerOnFrom' => 'Publicado Desde',
            'deliveredToCustomerOnUntil' => 'Publicado Hasta',
            'createdOnUntil' => 'Creado Hasta',
            'invoiceId' => 'Factura',
            'invoiceSelection' => 'Selección de estudios',
            'hasInvoice' => 'fact.',
            'isOnlyAdverse' => 'Solo Aversos',
            'backgroundCheckComponents' => 'Componentes',
            'isEventPendingToAprove' => 'Novedad Pendiente Not.',
            'farthestEvent' => 'Novedad Más Lejana',
            'isPendingToApprove' => 'Pendiente de Aprobación',
            'isPendingToPublish' => 'Pendiente de Publicación',
            'isPendingOverdue' => 'Pendiente Atrasado',
            'isPendingOnTimeWithEvent' => 'Pendientes en tiempo con novedad',
            'isPendingOnTimeWithOutEvent' => 'Pendientes en tiempo sin novedad',
            'contactPerson' => 'Contacto en la compañía',
            'sectionsSummary' => 'Resumen de Secciones',
            'otherReportsOfPerson' => 'Estudios Repetidos',
            'countOfOtherReportsOfPerson' => 'No. de Estudios Repetidos',
            'customerProductName' => 'Nombre de Producto',
            'inAmendment' => 'En Emienda',
            'formatedIdNumber' => 'No. ID',
            'additionalPrice' => 'Valor adicional',
            'additionalPriceComment' => 'Comentario de Valor adicional',
            'totalPrice' => 'Valor Total',
            'hasSectionsWithoutUser' => 'Tiene Secciones sin asignar',
            // NUEVOS LABELS
            'ciiu' => 'CIIU',
            'descriptionCiiu' => 'Descripción CIIU',
            'webPage' => 'Página Web',
            'email' => 'Email',
            'supplierClassification' => 'Clasificación del proveedor',
            'shareholderType' => 'Tipo',
            'yearsOfActivity' => 'Años de actividad de la empresa',
            'companySizeByActives' => 'Tamaño Por Escala de Activos Totales',
            'SupplierOrigin' => 'Origen del Proveedor',
            'codVerification' => 'Dígito de Verificación',
            'typeProduct' => 'Tipo de Producto',
            'typeStudy' => 'Tipo de Estudio',
            'datexpedition' => 'Fecha de Expedición',
            'tempdateRep' => 'Fecha de Publ. Temporal',
            'WorkflowID' => 'ID Workflow',
            'observationToCustomer' => 'Observaciones de Cliente',
            'bossContact'=>'Contactar Jefe Inmediato',
            'quality'=>'Calidad',
            'qualityLaboral'=>'Laboral',
            'qualitytextLaboral'=>'Texto Laboral',
            'qualityEducation'=>'Académico',
            'qualitytextEducation'=>'Texto Académico',
            'qualityFinanlcial'=>'Financiero',
            'qualitytextFinancial'=>'Texto Financiero',
            'qualityAdverse'=>'Adversos',
            'qualitytextAdverse'=>'Texto Adversos',
            'qualityVisit'=>'Visita',
            'qualitytextVisit'=>'Texto Visita',
            'qualityPolygraph'=>'Polígrafo',
            'qualitytextPolygraph'=>'Texto Polígrafo',
            'qualityTest'=>'Pruebas',
            'qualitytextTest'=>'Texto Pruebas',
            'qualityReturDev'=>'Nro. Devoluciones',
            'qualityPQR'=>'PQR',
            'qualityComplain'=>'PNC',
            'qualityGesDocument'=>'Gestion Documental',
            'qualityTextGesDocument'=>'Texto Gestion Documental',
            'qualityReturn'=>'Devuelve:',
            'qualityReturnPer'=>'A qué área Devuelve',
            'qualityLaboralPNC'=>'Laboral PNC',
            'qualityLaboralPQR'=>'Laboral PQR', 
            'qualityEducationPNC'=>'Académico PNC', 
            'qualityEducationPQR'=>'Académico PQR', 
            'qualityFinanlcialPNC'=>'Financiero PNC', 
            'qualityFinanlcialPQR'=>'Financiero PQR', 
            'qualityAdversePNC'=>'Adversos PNC', 
            'qualityAdversePQR'=>'Adversos PQR', 
            'qualityVisitPNC'=>'Visita PNC', 
            'qualityVisitPQR'=>'Visita PQR', 
            'qualityPolygraphPNC'=>'Polígrafo PNC', 
            'qualityPolygraphPQR'=>'Polígrafo PQR', 
            'qualityTestPQR'=>'Pruebas PQR', 
            'qualityTestPNC'=>'Pruebas PNC', 
            'qualityGesDocumentPQR'=>'Gestion Documental PQR',
            'qualityGesDocumentPNC'=>'Gestion Documental PNC',
            'ooidFD'=>'form Dinamico Id',
            'validuntilFD'=>'Limite Formulario Dinámico',
            'statusFD'=>'Estado Formulario Dinámico',

            'qualityShareholder'=>'Socios y Representantes Legales',
            'qualitytextShareholder'=>'Texto Socios y Representantes Legales',
            'qualityShareholderPQR'=>'Socios y Representantes Legales PQR',
            'qualityShareholderPNC'=>'Socios y Representantes Legales PNC',
            
            'qualityCustomer'=>'Clientes',
            'qualitytextCustomer'=>'Texto Clientes',
            'qualityCustomerPQR'=>'Clientes PQR',
            'qualityCustomerPNC'=>'Clientes PNC',

            'qualityProvider'=>'Proveedores',
            'qualitytextProvider'=>'Texto Proveedores',
            'qualityProviderPQR'=>'Proveedores PQR',
            'qualityProviderPNC'=>'Proveedores PNC',

            'qualityFinance'=>'Central de Riesgo',
            'qualitytextFinance'=>'Texto Central de Riesgo',
            'qualityFinancePQR'=>'Central de Riesgo PQR',
            'qualityFinancePNC'=>'Central de Riesgo PNC',

            'qualityFinantialAnalys'=>'Análisis Financiero',
            'qualitytextFinantialAnalys'=>'Texto Análisis Financiero',
            'qualityFinantialAnalysPQR'=>'Análisis Financiero PQR',
            'qualityFinantialAnalysPNC'=>'Análisis Financiero PNC',

            'qualityCompanyVisit'=>'Visita a Empresa',
            'qualitytextCompanyVisit'=>'Texto Visita a Empresa',
            'qualityCompanyVisitPQR'=>'Visita a Empresa PQR',
            'qualityCompanyVisitPNC'=>'Visita a Empresa PNC',

            'qualityReference'=>'Referencias',
            'qualitytextReference'=>'Texto Referencias',
            'qualityReferencePQR'=>'Referencias PQR',
            'qualityReferencePNC'=>'Referencias PNC',
            'salarytobeEarned'=>'Salario a devengar',

            'reciptFileooid'=>'form Dinamico Id',
            'reciptExpiration'=>'Limite Formulario Dinámico',
            'reciptFileStatus'=>'Estado Formulario Dinámico',
            'startStudy'=>'Inicio Estudio'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    private function getSearchCriteria() {

        $criteria = new CDbCriteria;


        $criteria->compare('t.id', $this->id);
        $criteria->compare('customerProductId', $this->customerProductId);

        $addAssignedUsers = false;
        if(Yii::app()->user->getIsByRole()){
            if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIO_SENIOR)){
                $assignedUsers=Yii::app()->user->arUser->assignedUsers;
                $assignedUsersIds=CHtml::listData($assignedUsers, 'id', 'id');
                
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId in ('.implode(",",$assignedUsersIds).')');
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $addAssignedUsers = true;
            }
            else if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIOS_ANALISTA)){
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $addAssignedUsers = true;
            }
            else if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){

                $criteria->addCondition('t.id > 0');
                
                if ($this->assignedUserId == SVPActiveRecord::NULL_VALUE) {
                    $criteria->together = true;
                    $criteria->addCondition('assignedUsersSearch.userId is null');
                    $addAssignedUsers = true;
                } else if ($this->assignedUserId != '') {
                    $criteria->together = true;
                    $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                    $addAssignedUsers = true;
                }
            }
            else{
                $criteria->addCondition('t.id < 0');
            }
        }else if (!Yii::app()->user->isAdmin) {
            $criteria->together = true;
            $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
           // $this->inAmendment==1;
           // $criteria->addCondition('inAmendment==1');
            $criteria->addCondition('assignedUsersSearch.finishedAt is null');
            $criteria->addCondition('approvedBy is null or inAmendment = 1');

            $addAssignedUsers = true;
        } else {
            if ($this->assignedUserId == SVPActiveRecord::NULL_VALUE) {
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId is null');
                $addAssignedUsers = true;
            } else if ($this->assignedUserId != '') {
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                $addAssignedUsers = true;
            }
            if (!empty($this->responsibleUserId)) {
                if ($this->responsibleUserId == SVPActiveRecord::NULL_VALUE) {
                    $criteria->together = true;
                    $criteria->addCondition('assignedUsersSearch.userId is null');
                    $addAssignedUsers = true;
                } else if ($this->responsibleUserId > 0) {
                    $criteria->together = true;
                    $criteria->compare('assignedUsersSearch.userId', $this->responsibleUserId, false);
                    $criteria->compare('assignedUsersSearch.userRoleId', UserRole::ASSIGNED, false);
                    $addAssignedUsers = true;
                }
            }
        }

        $criteria->compare('approvedBy', $this->approvedBy);
        $criteria->compare('approvedOn', $this->approvedOn, true);
        $criteria->compare('t.customerId', $this->customerId);
        $criteria->compare('backgroundCheckStatusId', $this->backgroundCheckStatusId);
        $criteria->compare('requestSystemId', $this->requestSystemId);
        $criteria->compare('t.firstName', $this->firstName, true);
        $criteria->compare('t.lastName', $this->lastName, true);
        $criteria->compare('idNumber', $this->idNumber, true);
        $criteria->compare('t.city', $this->city, true);
        $criteria->compare('customerField1', $this->customerField1, true);
        $criteria->compare('customerField2', $this->customerField2, true);
        $criteria->compare('customerField3', $this->customerField3, true);
        $criteria->compare('customerField4', $this->customerField4, true);
        $criteria->compare('customerField5', $this->customerField5, true);
        $criteria->compare('customerField6', $this->customerField6, true);
        $criteria->compare('personContacted', $this->personContacted);
        $criteria->compare('studyStartedOn', $this->studyStartedOn, true);
        $criteria->compare('t.created', '>=' . $this->createdOnFrom, false, 'and', true);
        $criteria->compare('t.created', '<=' . $this->createdOnUntil, false, 'and', true);
        $criteria->compare('studyStartedOn', '>=' . $this->studyStartedOnFrom, false, 'and', true);
        $criteria->compare('studyStartedOn', '<=' . $this->studyStartedOnUntil, false, 'and', true);
        $criteria->compare('studyLimitOn', $this->studyLimitOn, true);
        $criteria->compare('dateLimitQuality', $this->dateLimitQuality, true);
        $criteria->compare('studyLimitOn', '>=' . $this->studyLimitOnFrom, false, 'and', true);
        $criteria->compare('studyLimitOn', '<=' . $this->studyLimitOnUntil, false, 'and', true);
        $criteria->compare('t.approvedOn', '>=' . $this->approvedOnFrom, false, 'and', true);
        $criteria->compare('t.approvedOn', '<=' . $this->approvedOnUntil, false, 'and', true);
        $criteria->compare('t.deliveredToCustomerOn', '>=' . $this->deliveredToCustomerOnFrom, false, 'and', true);
        $criteria->compare('t.deliveredToCustomerOn', '<=' . $this->deliveredToCustomerOnUntil, false, 'and', true);
        $criteria->compare('approvedOn', $this->approvedOn, true);
        $criteria->compare('t.comments', $this->comments, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('t.resultId', $this->resultId);
        $criteria->compare('customerUserId', $this->customerUserId, true);
        $criteria->compare('WorkflowID', $this->WorkflowID, true);
        $criteria->compare('idFrom', $this->idFrom, true);
        $criteria->compare('relationshipStatusId', $this->relationshipStatusId, true);
        $criteria->compare('birthday', $this->birthday);
        $criteria->compare('tels', $this->tels, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('numberOfDownloads', $this->numberOfDownloads, true);
        $criteria->compare('reportAvailable', $this->reportAvailable, true);
        $criteria->compare('temporalReportAvailable', $this->temporalReportAvailable, true);
        $criteria->compare('certificateAvailable', $this->certificateAvailable, true);
        $criteria->compare('inAmendment', $this->inAmendment);
        $criteria->compare('bossContact', $this->bossContact);  
        $criteria->compare('qualityReturDev', $this->qualityReturDev); 
        $criteria->compare('qualityPQR', $this->qualityPQR); 
        $criteria->compare('qualityComplain', $this->qualityComplain); 
        $criteria->compare('qualityGesDocument', $this->qualityGesDocument); 

        $criteria->compare('customerProduct.name', $this->customerProductName, true);
        $criteria->compare('customerProduct.viewDynamicForm', $this->customerProductviewDynamicForm);

        $criteria->compare('customer.customerGroupId', $this->customerGroupId);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('ooidFD', $this->ooidFD, true);
        //$criteria->compare('validuntilFD', $this->validuntilFD, true);
        $criteria->compare('statusFD',$this->statusFD);
        
        $criteria->compare('reciptFileooid', $this->reciptFileooid, true);
        //$criteria->compare('reciptExpiration', $this->reciptExpiration, true);
        $criteria->compare('reciptFileStatus', $this->reciptFileStatus);
        $criteria->compare('startStudy', $this->startStudy, true);
        

        if (isset($this->hasInvoice) && is_numeric($this->hasInvoice) && $this->hasInvoice == 0) {
            $criteria->addCondition('invoiceId is Null');
        }
        if ($this->hasInvoice == 1) {
            $criteria->addCondition('invoiceId > 0');
        }

        if (!empty($this->customerProductName) || !empty($this->customerProductviewDynamicForm)) {
            $criteria->with[] = 'customerProduct';
        }
        if ($addAssignedUsers) {
            $criteria->with[] = 'assignedUsersSearch';
            $criteria->group = 't.id';
        }
        if (!empty($this->customerGroupId)) {
            $criteria->with[] = 'customer';
        }
        WebUser::logAccess("Ajustò los criterios de busqueda");
        return $criteria;
    }
    //Export de clientes Jonathan
    private function getSearchCliCriteria() {

        $criteria = new CDbCriteria;


        $criteria->compare('t.id', $this->id);
        $criteria->compare('customerProductId', $this->customerProductId);
// Agregado Jonathan
        $addAssignedUsers = false;
        //genera error en el export de clientes ya que tiene que estar Yii::app()->user para que exporte pero afecta el listado de estudios por que muestra todo.
        /* if (!Yii::app()->user) {
            /*
             $criteria->together = true;
             $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
             // $this->inAmendment==1;
             //$criteria->addCondition('inAmendment > 0');
             $criteria->addCondition('assignedUsersSearch.finishedAt is null');
             //$criteria->addCondition('approvedBy is not null AND inAmendment > 0');
             // $criteria->addCondition(' backgroundCheckStatusId = 1 || backgroundCheckStatusId = 2');
             // $criteria->addCondition('inAmendment < 0');
             $criteria->addCondition(' approvedBy is null or inAmendment = 1 ');

             $addAssignedUsers = true;
            */
        /*   } else {
               if ($this//->assignedUserId == SVPActiveRecord::NULL_VALUE
               ) {
                   //$criteria->together = true;
                   //$criteria->addCondition('assignedUsersSearch.userId is null');
                  // $addAssignedUsers = true;
               } else if ($this//->assignedUserId != ''
                   ) {
                  // $criteria->together = true;
                  // $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                 //  $addAssignedUsers = true;
               }*/
        /*  if (!empty($this->responsibleUserId)) {
              if ($this->responsibleUserId == SVPActiveRecord::NULL_VALUE) {
                  $criteria->together = true;
                  $criteria->addCondition('assignedUsersSearch.userId is null');
                  $addAssignedUsers = true;
              } else if ($this->responsibleUserId > 0) {
                  $criteria->together = true;
                  $criteria->compare('assignedUsersSearch.userId', $this->responsibleUserId, false);
                  $criteria->compare('assignedUsersSearch.userRoleId', UserRole::ASSIGNED, false);
                  $addAssignedUsers = true;
              }
          }
    //  }*/

        $criteria->compare('approvedBy', $this->approvedBy);
        $criteria->compare('approvedOn', $this->approvedOn, true);
        if(Yii::app()->user->arUser->isGroupSupervisor==1){
            // $criteria->compare('t.customerId', $this->customerId);
        }else{
            $criteria->compare('t.customerId', $this->customerId);
        }

        $criteria->compare('backgroundCheckStatusId', $this->backgroundCheckStatusId);
        $criteria->compare('requestSystemId', $this->requestSystemId);
        $criteria->compare('t.firstName', $this->firstName, true);
        $criteria->compare('t.lastName', $this->lastName, true);
        $criteria->compare('idNumber', $this->idNumber, true);
        $criteria->compare('t.city', $this->city, true);
        $criteria->compare('customerField1', $this->customerField1, true);
        $criteria->compare('customerField2', $this->customerField2, true);
        $criteria->compare('customerField3', $this->customerField3, true);
        $criteria->compare('customerField4', $this->customerField4, true);
        $criteria->compare('customerField5', $this->customerField5, true);
        $criteria->compare('customerField6', $this->customerField6, true);
        $criteria->compare('personContacted', $this->personContacted);
        $criteria->compare('studyStartedOn', $this->studyStartedOn, true);
        $criteria->compare('t.created', '>=' . $this->createdOnFrom, false, 'and', true);
        $criteria->compare('t.created', '<=' . $this->createdOnUntil, false, 'and', true);
        $criteria->compare('studyStartedOn', '>=' . $this->studyStartedOnFrom, false, 'and', true);
        $criteria->compare('studyStartedOn', '<=' . $this->studyStartedOnUntil, false, 'and', true);
        $criteria->compare('studyLimitOn', $this->studyLimitOn, true);
        $criteria->compare('dateLimitQuality', $this->dateLimitQuality, true);
        $criteria->compare('studyLimitOn', '>=' . $this->studyLimitOnFrom, false, 'and', true);
        $criteria->compare('studyLimitOn', '<=' . $this->studyLimitOnUntil, false, 'and', true);
        $criteria->compare('t.approvedOn', '>=' . $this->approvedOnFrom, false, 'and', true);
        $criteria->compare('t.approvedOn', '<=' . $this->approvedOnUntil, false, 'and', true);
        $criteria->compare('t.deliveredToCustomerOn', '>=' . $this->deliveredToCustomerOnFrom, false, 'and', true);
        $criteria->compare('t.deliveredToCustomerOn', '<=' . $this->deliveredToCustomerOnUntil, false, 'and', true);
        $criteria->compare('approvedOn', $this->approvedOn, true);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('resultId', $this->resultId, true);
        $criteria->compare('customerUserId', $this->customerUserId, true);
        $criteria->compare('WorkflowID', $this->WorkflowID, true);
        $criteria->compare('idFrom', $this->idFrom, true);
        $criteria->compare('relationshipStatusId', $this->relationshipStatusId, true);
        $criteria->compare('birthday', $this->birthday);
        $criteria->compare('tels', $this->tels, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('numberOfDownloads', $this->numberOfDownloads, true);
        $criteria->compare('reportAvailable', $this->reportAvailable, true);
        $criteria->compare('temporalReportAvailable', $this->temporalReportAvailable, true);
        $criteria->compare('certificateAvailable', $this->certificateAvailable, true);
        $criteria->compare('inAmendment', $this->inAmendment);
        $criteria->compare('bossContact', $this->bossContact); 
        $criteria->compare('qualityReturDev', $this->qualityReturDev); 
        $criteria->compare('qualityPQR', $this->qualityPQR);
        $criteria->compare('qualityComplain', $this->qualityComplain); 
        $criteria->compare('qualityGesDocument', $this->qualityGesDocument); 

        $criteria->compare('customerProduct.name', $this->customerProductName, true);
        $criteria->compare('customer.customerGroupId', $this->customerGroupId);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('ooidFD', $this->ooidFD, true);
        $criteria->compare('validuntilFD', $this->validuntilFD, true);
        $criteria->compare('statusFD', $this->statusFD, true);

        $criteria->compare('reciptFileooid', $this->reciptFileooid, true);
        $criteria->compare('reciptExpiration', $this->reciptExpiration, true);
        $criteria->compare('reciptFileStatus', $this->reciptFileStatus, true);
        $criteria->compare('startStudy', $this->startStudy, true);

        if (isset($this->hasInvoice) && is_numeric($this->hasInvoice) && $this->hasInvoice == 0) {
            $criteria->addCondition('invoiceId is Null');
        }
        if ($this->hasInvoice == 1) {
            $criteria->addCondition('invoiceId > 0');
        }

        if (!empty($this->customerProductName)) {
            $criteria->with[] = 'customerProduct';
        }
        if ($addAssignedUsers) {
            $criteria->with[] = 'assignedUsersSearch';
            $criteria->group = 't.id';
        }
        if (!empty($this->customerGroupId)) {
            $criteria->with[] = 'customer';
        }
        WebUser::logAccess("Ajustò los criterios de busqueda");
        return $criteria;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchCli($pageSize = 20) {

        $criteria = $this->getSearchCliCriteria();
        //print_r($criteria);
        GridViewFilter::setFilter($this, 'searchCli');

        $results =  new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchCli'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 'studyStartedOn DESC',
            ),
        ));
        $Blacklist =$this->BlackList();
        $data = $results->getData();

        for($i=0; $i<sizeof($data); $i++){
            if(in_array($data[$i]['idNumber'],$Blacklist)){

                $data[$i]['blacklist']=1;
            }
            else{
                $data[$i]['blacklist']=0;

            }
        }
        $results->setData($data);
        return $results;

        WebUser::logAccess("Hizo la busqueda");
    }
    //Export de clientes Jonathan

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($pageSize = 20) {

        $criteria = $this->getSearchCriteria();
        //print_r($criteria);
        GridViewFilter::setFilter($this, 'search');

        $results =  new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC', //studyStartedOn
            ),
        ));
    $Blacklist =$this->BlackList();
    $data = $results->getData();

        for($i=0; $i<sizeof($data); $i++){
           if(in_array($data[$i]['idNumber'],$Blacklist)){

               $data[$i]['blacklist']=1;
           }
            else{
                $data[$i]['blacklist']=0;

            }
        }
    $results->setData($data);
        return $results;

        WebUser::logAccess("Hizo la busqueda");
    }

    //Function search contacts
    //Hermann, Natalia H y Jonathan 17/11/21
    public function searchContacts($pageSize=20){
        $criteria = $this->getSearchCriteria();
        $criteria->addCondition('customer.isRecover!=1');
        if($this->contactType=='1'){
            $criteria->addCondition('contacts.id is null');
        }else{
            $criteria->compare('contacts.contactType', $this->contactType, true);
        }
            $criteria->with[] = 'contacts';
            $criteria->with[] = 'customer';
            $criteria->together = true;

        //print_r($criteria);
        GridViewFilter::setFilter($this, 'searchContacts');

        $results =  new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchContacts'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 'studyStartedOn DESC',
            ),
        ));
        return $results;
    }

    public function searchRecover($pageSize=50){
        $criteria = $this->getSearchCriteria();
        $criteria->addCondition('customer.isRecover=1');

        if($this->contactType=='1'){
            $criteria->addCondition('contacts.id is null');
        }else{
            $criteria->compare('contacts.contactType', $this->contactType, true);
        }

        if($this->reciptExpiration=='null'){
            $criteria->addCondition('reciptExpiration is null');
        }else{
            $criteria->compare('reciptExpiration', $this->reciptExpiration, false, 'and', true);
        }

        if($this->validuntilFD=='null'){
            $criteria->addCondition('validuntilFD is null');
        }else{
            $criteria->compare('validuntilFD', $this->validuntilFD, false, 'and', true);
        }


        $criteria->with[] = 'contacts';
        $criteria->with[] = 'customer';
        //$criteria->together = true;

        //print_r($criteria);
        GridViewFilter::setFilter($this, 'searchRecover');

        $results =  new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchRecover'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',
            ),
        ));
        return $results;
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchForAssign($pageSize = 40) {
        $criteria = $this->getSearchCriteria();

        $criteria->compare('customerProduct.preliminary', $this->customerProductPreliminary, false);
        $criteria->with[] = 'customerProduct';
        
        if ($this->verificationSectionTypeId || $this->assignedUserId) {
            $criteria->together = true;
            $criteria->compare('verificationSections.verificationSectionTypeId', $this->verificationSectionTypeId, false);
            //$criteria->compare('verificationSectionTypeForSearch.verificationSectionGroupId', $this->verificationSectionGroupId, false);
            $criteria->with[] = 'verificationSections';
            $criteria->with['verificationSectionsSearch1'] = array('alias'=>'verificationSectionSearch1');
            $criteria->with['verificationSectionsSearch2.verificationSectionType'] = array('alias'=>'verificationSectionTypeForSearch');
            $criteria->group = 't.id';
        }
        
        if ($this->verificationSectionGroupId) {
            $criteria->together = true;
            $criteria->compare('verificationSections.verificationSectionTypeId', $this->verificationSectionTypeId, false);
            //$criteria->compare('verificationSectionTypeForSearch.verificationSectionGroupId', $this->verificationSectionGroupId, false);
            $criteria->compare('verificationSectionType.verificationSectionGroupId', $this->verificationSectionGroupId, false);
            $criteria->with[] = 'verificationSections';
            $criteria->with[] = 'verificationSectionType';
            $criteria->with['verificationSectionsSearch1'] = array('alias'=>'verificationSectionSearch1');
            //$criteria->with['verificationSectionsSearch2.verificationSectionType'] = array('alias'=>'verificationSectionTypeForSearch');
            $criteria->group = 't.id';
        } 

        if ($this->hasSectionsWithoutUser) {

            $criteria->together = true;
            $criteria->addCondition('assignedUsers.verificationSectionId is null');
            $criteria->with=['verificationSections.assignedUsers'];
            /*$criteria->with['verificationSections.assignedUsers'] = array(
                'alias' => 'verificationSections_assignedUsers',
                'condition' => 'verificationSections_assignedUsers.verificationSectionId is null',
                'together' => true);*/
        }

		GridViewFilter::setFilter($this, 'search');

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
				'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 'studyStartedOn DESC',
            ),
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchForInvoice($invoice, $pageSize = 20) {

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('customerProductId', $this->customerProductId);

        $addAssignedUsers = false;
        if(Yii::app()->user->getIsByRole()){
            if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIO_SENIOR)){
                $assignedUsers=Yii::app()->user->arUser->assignedUsers;
                $assignedUsersIds=CHtml::listData($assignedUsers, 'id', 'id');
                
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId in ('.implode(",",$assignedUsersIds).')');
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $addAssignedUsers = true;
            }
            else if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIOS_ANALISTA)){
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $addAssignedUsers = true;
            }
            else if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){
                $criteria->addCondition('t.id > 0');
            }
            else{
                $criteria->addCondition('t.id < 0');
            }
        }else if (!Yii::app()->user->isAdmin) {
            $criteria->together = true;
            $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
            $addAssignedUsers = true;
        } else {
            if ($this->assignedUserId == SVPActiveRecord::NULL_VALUE) {
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId is null');
                $addAssignedUsers = true;
            } else if ($this->assignedUserId != '') {
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                $addAssignedUsers = true;
            }
            if (!empty($this->responsibleUserId)) {
                if ($this->responsibleUserId == SVPActiveRecord::NULL_VALUE) {
                    $criteria->together = true;
                    $criteria->addCondition('assignedUsersSearch.userId is null');
                    $addAssignedUsers = true;
                } else if ($this->responsibleUserId > 0) {
                    $criteria->together = true;
                    $criteria->compare('assignedUsersSearch.userId', $this->responsibleUserId, false);
                    $criteria->compare('assignedUsersSearch.userRoleId', UserRole::ASSIGNED, false);
                    $addAssignedUsers = true;
                }
            }
        }

        $criteria->compare('approvedBy', $this->approvedBy);
        $criteria->compare('approvedOn', $this->approvedOn, true);
        $criteria->compare('t.customerId', $this->customerId);
        $criteria->compare('requestSystemId', $this->requestSystemId);
        $criteria->compare('t.firstName', $this->firstName, true);
        $criteria->compare('t.lastName', $this->lastName, true);
        $criteria->compare('idNumber', $this->idNumber, true);
        $criteria->compare('t.city', $this->city, true);
        $criteria->compare('customerField1', $this->customerField1, true);
        $criteria->compare('customerField2', $this->customerField2, true);
        $criteria->compare('customerField3', $this->customerField3, true);
        $criteria->compare('customerField4', $this->customerField4, true);
        $criteria->compare('customerField5', $this->customerField5, true);
        $criteria->compare('customerField6', $this->customerField6, true);
        $criteria->compare('personContacted', $this->personContacted);
        $criteria->compare('studyStartedOn', $this->studyStartedOn, true);
        $criteria->compare('t.created', '>=' . $this->createdOnFrom, false, 'and', true);
        $criteria->compare('t.created', '<=' . $this->createdOnUntil, false, 'and', true);
        $criteria->compare('studyStartedOn', '>=' . HtmlHelper::completeHour($this->studyStartedOnFrom, false), false);
        $criteria->compare('studyStartedOn', '<=' . HtmlHelper::completeHour($this->studyStartedOnUntil, true), false);
        $criteria->compare('studyLimitOn', '>=' . HtmlHelper::completeHour($this->studyLimitOnFrom, false), false);
        $criteria->compare('studyLimitOn', '<=' . HtmlHelper::completeHour($this->studyLimitOnUntil, true), false);
        $criteria->compare('approvedOn', '>=' . HtmlHelper::completeHour($this->approvedOnFrom, false), false);
        $criteria->compare('approvedOn', '<=' . HtmlHelper::completeHour($this->approvedOnUntil, true), false);
        $criteria->compare('deliveredToCustomerOn', '>=' . HtmlHelper::completeHour($this->deliveredToCustomerOnFrom, false), false);
        $criteria->compare('deliveredToCustomerOn', '<=' . HtmlHelper::completeHour($this->deliveredToCustomerOnUntil, true), false);
        $criteria->compare('approvedOn', $this->approvedOn, true);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('customerUserId', $this->customerUserId, true);
        $criteria->compare('WorkflowID', $this->WorkflowID, true);
        $criteria->compare('idFrom', $this->idFrom, true);
        $criteria->compare('relationshipStatusId', $this->relationshipStatusId, true);
        $criteria->compare('birthday', $this->birthday);
        $criteria->compare('tels', $this->tels, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('numberOfDownloads', $this->numberOfDownloads, false);
        $criteria->compare('reportAvailable', $this->reportAvailable, false);
        $criteria->compare('temporalReportAvailable', $this->reportAvailable, false);
        $criteria->compare('customerProduct.Name', $this->customerProductName, true);
        $criteria->compare('resultId', $this->resultId, false);
        $criteria->compare('inAmendment', $this->inAmendment);
        $criteria->compare('additionalPrice', $this->additionalPrice);
        $criteria->compare('additionalPriceComment', $this->additionalPriceComment);
        $criteria->compare('expireIn', $this->expireIn);
        $criteria->compare('bossContact', $this->bossContact); 
        $criteria->compare('qualityReturDev', $this->qualityReturDev); 
        $criteria->compare('qualityPQR', $this->qualityPQR);
        $criteria->compare('qualityComplain', $this->qualityComplain); 
        $criteria->compare('qualityGesDocument', $this->qualityGesDocument);

        $criteria->compare('mobile', $this->mobile, true); 
        $criteria->compare('ooidFD', $this->ooidFD, true);
        $criteria->compare('validuntilFD', $this->validuntilFD, true);
        $criteria->compare('statusFD', $this->statusFD, true);

        $criteria->compare('reciptFileooid', $this->reciptFileooid, true);
        $criteria->compare('reciptExpiration', $this->reciptExpiration, true);
        $criteria->compare('reciptFileStatus', $this->reciptFileStatus, true);
        $criteria->compare('startStudy', $this->startStudy, true);

        switch ($this->invoiceSelection) {

            case Invoice::NOT_ASSIGNED:
                $criteria->addCondition('invoiceId is null');
                $criteria->addCondition('customer.customerGroupId=' . (int) $invoice->customerGroupId);
                break;

            case Invoice::NOT_ASSIGNED_AND_INVOICE:
                $criteria->addCondition('((invoiceId is null and customer.customerGroupId=' . (int) $invoice->customerGroupId . ') or invoiceId=' . $this->invoiceId . ')');
                break;
            case Invoice::ONLY_INVOICE:
            default :
                $criteria->compare('invoiceId', $this->invoiceId);
                break;
        }

        //        $criteria->addCondition('resultId <> ' . Result::PENDING);
        //        $criteria->addCondition('backgroundCheckStatusId = ' . BackgroundCheckStatus::FINISHED);

        $criteria->with[] = 'customer';

        if (!empty($this->customerProductName)) {
            $criteria->with[] = 'customerProduct';
        }
        if ($addAssignedUsers) {
            $criteria->with[] = 'assignedUsersSearch';
        }

        GridViewFilter::setFilter($this, 'searchForInvoice');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchForInvoice'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 'studyStartedOn DESC',
            ),
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchClient($type) {

        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        // This function can only be called from SES app, with the

        $user = CustomerUser::model()->findByPK(Yii::app()->user->id);
        if (!$user || !$user->customerId) {
            Yii::app()->request->redirect('/site/intro');
        }

        $criteria = new CDbCriteria;

        if (Yii::app()->user->getIsGroupSupervisor()) {
            $customer = Customer::model()->findByPk(Yii::app()->user->arUser->customerId);
            $criteria->compare('customer.customerGroupId', $customer->customerGroupId);
            $criteria->with[] = 'customer';
        } elseif (Yii::app()->user->getIsSupervisor()) {
            $criteria->compare('t.customerId', Yii::app()->user->arUser->customerId);
        } else {
            $this->customerUserId = Yii::app()->user->id;
            $criteria->compare('t.customerId', Yii::app()->user->arUser->customerId);
            $criteria->compare('customerUserId', Yii::app()->user->id);
        }

        $type = (int) $type;
        switch ($type) {
            case 1:

                // Pending reports
                $criteria->compare('reportAvailable', 0, true);
                break;

            case 2:

                // With report but not downloaded
                $criteria->compare('reportAvailable', 1, true);
                $criteria->compare('numberOfDownloads', '0', true);
                break;

            case 3:

                // With report already downloaded
                $criteria->compare('reportAvailable', 1, true);
                $criteria->compare('numberOfDownloads', '>0', true);
                break;
        }

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.customerProductId', $this->customerProductId);
        $criteria->compare('t.customerId', $this->customerId);
        $criteria->compare('backgroundCheckStatusId', $this->backgroundCheckStatusId);
        $criteria->compare('requestSystemId', $this->requestSystemId);
        $criteria->compare('t.firstName', $this->firstName, true);
        $criteria->compare('t.lastName', $this->lastName, true);
        $criteria->compare('idNumber', $this->idNumber, true);
        $criteria->compare('t.city', $this->city, true);
        $criteria->compare('customerField1', $this->customerField1, true);
        $criteria->compare('customerField2', $this->customerField2, true);
        $criteria->compare('customerField3', $this->customerField3, true);
        $criteria->compare('customerField4', $this->customerField4, true);
        $criteria->compare('customerField5', $this->customerField5, true);
        $criteria->compare('customerField6', $this->customerField6, true);
        $criteria->compare('personContacted', $this->personContacted);
        $criteria->compare('studyStartedOn', $this->studyStartedOn, true);
        $criteria->compare('studyStartedOn', '>=' . $this->studyStartedOnFrom, false, 'and', false);
        $criteria->compare('studyStartedOn', '<=' . $this->studyStartedOnUntil, false, 'and', false);
        $criteria->compare('studyLimitOn', $this->studyLimitOn, true);
        $criteria->compare('dateLimitQuality', $this->dateLimitQuality, true);
        $criteria->compare('expireIn', $this->expireIn, true);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('resultId', $this->resultId, true);
        $criteria->compare('customerUserId', $this->customerUserId, true);
        $criteria->compare('WorkflowID', $this->WorkflowID, true);
        $criteria->compare('idFrom', $this->idFrom, true);
        $criteria->compare('relationshipStatusId', $this->relationshipStatusId, true);
        $criteria->compare('birthday', $this->birthday);
        $criteria->compare('tels', $this->tels, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('reportAvailable', $this->reportAvailable, true);
        $criteria->compare('temporalReportAvailable', $this->temporalReportAvailable, true);
        $criteria->compare('applyToPosition', $this->applyToPosition, true);
        $criteria->compare('bossContact', $this->bossContact); 
        $criteria->compare('qualityReturDev', $this->qualityReturDev); 
        $criteria->compare('qualityPQR', $this->qualityPQR);
        $criteria->compare('qualityComplain', $this->qualityComplain); 
        $criteria->compare('qualityGesDocument', $this->qualityGesDocument);
        $criteria->compare('mobile', $this->mobile, true); 
        $criteria->compare('ooidFD', $this->ooidFD, true);
        $criteria->compare('validuntilFD', $this->validuntilFD, true);
        $criteria->compare('statusFD', $this->statusFD, true);

        $criteria->compare('reciptFileooid', $this->reciptFileooid, true);
        $criteria->compare('reciptExpiration', $this->reciptExpiration, true);
        $criteria->compare('reciptFileStatus', $this->reciptFileStatus, true);
        $criteria->compare('startStudy', $this->startStudy, true);
        // Do not show to the customer reports older than 2 years

        //$criteria->addCondition('t.backgroundCheckStatusId in (' . BackgroundCheckStatus::REQUESTED . ',' . BackgroundCheckStatus::PROCESSING . ') or t.created>= date_add(NOW(),INTERVAL -2 year)');

        if (!Yii::app()->user->arUser->canRequestCompanyReports) {
            $criteria->compare('customerProduct.isCompanySurvey', 0, true);
        }
        $criteria->addCondition('t.firstName<>"Empresas"');

        $criteria->with[] = 'customerProduct';

        GridViewFilter::setFilter($this, 'searchClient');
       // print_r($criteria);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchClient'),
            ),
            'sort' => array(
                'defaultOrder' => 'studyStartedOn DESC',
            )
        ));
    }

    //Natalia Henao 
    //07/03/2023
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchForPiloto($pageSize=50) {

        $criteria = $this->getSearchCriteria();
       
        //$criteria->together = true;
        //$criteria->addCondition('assignedUsers.finishedAt is not null');

        $criteria->addCondition('customer.isPilot=1');
        $criteria->addCondition('t.approvedOn is not null');
        $criteria->with=['assignedUsers', 'customer'];


		$criteria->order = 't.id desc';

        GridViewFilter::setFilter($this, 'searchForPiloto');

        $results =  new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchForPiloto'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 't.deliveredToCustomerOn DESC',
            ),
        ));
        return $results;
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            ),
        );
    }

    public function getTotal() {
        $ans = 0;
        $weight = array();
        if ($this->customerProduct) {
            foreach ($this->customerProduct->verificationsInProduct as $verificationInProduct) {
                $weight[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct->weight;
            }
            foreach ($this->verificationSections as $section) {
                if (isset($weight[$section->verificationSectionTypeId])) {
                    $ans+= ($weight[$section->verificationSectionTypeId] * $section->percentCompleted / 100);
                }
            }
        }
        return round($ans, 0);
    }


    public function BlackList() {


        $data = Yii::app()->db->createCommand(
            '
      SELECT 
        IdNumber
            
     FROM
     ses_Blacklist
     
    ');

        $ans =  $data->queryAll();
    $results= array();
    foreach($ans as $a){

        $results[]=$a['IdNumber'];

    }

    return $results;
    }

// Creado por Jonathan

    public function getPercentageSummaryComp() {


        $ansStr = "";
        $ans = 0;
        $weight = array();
        foreach ($this->customerProduct->verificationsInProduct as $verificationInProduct) {
            $weight[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct->weight;
        }


        foreach ($this->verificationSections as $section) {
            if (isset($weight[$section->verificationSectionTypeId])) {
                $ans = $weight[$section->verificationSectionTypeId] * $section->percentCompleted / 100;

                switch($section->resultId){
               // $pr = "<font color=#49C42E>EC</font>";
                    case $section->resultId==null:
                        $pr = "";
                    case $section->resultId==1:
                        $pr ="EC";
                        break;
                    case $section->resultId==2:
                        $pr ="<font color=#49C42E><b>SH</b></font>";
                        break;
                    case $section->resultId==3:
                        $pr = "<font color='red'><b>CH</b></font>";
                        break;
                    case $section->resultId==4:
                        $pr = "<font color=#ff9e3d><b>CHM</b></font>";
                        break;

                    default:
                        $pr ="";


                }

                $ansStr.= $section->verificationSectionType->name . ": {$section->percentCompleted}% : {$pr} /  ";
            }
        }
        return $ansStr;
    }

    public function getPercentageSummaryAdv() {
        $ansStr = "";
        $ans = 0;
        $weight = array();
        foreach ($this->customerProduct->verificationsInProduct as $verificationInProduct) {
            $weight[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct->weight;
        }

        foreach ($this->verificationSections as $section) {
            if (isset($weight[$section->verificationSectionTypeId]) && ($section->verificationSectionTypeId==4 || $section->verificationSectionTypeId==9 || $section->verificationSectionTypeId==24)) {
                $ans = $weight[$section->verificationSectionTypeId] * $section->percentCompleted / 100;

                switch($section->resultId){
               // $pr = "<font color=#49C42E>EC</font>";
                    case $section->resultId==null:
                        $pr = "";
                    case $section->resultId==1:
                        $pr ="EC";
                        break;
                    case $section->resultId==2:
                        $pr ="<font color=#49C42E><b>SH</b></font>";
                        break;
                    case $section->resultId==3:
                        $pr = "<font color='red'><b>CH</b></font>";
                        break;
                    case $section->resultId==4:
                        $pr = "<font color=#ff9e3d><b>CHM</b></font>";
                        break;

                    default:
                        $pr ="";
                }
                $ansStr.= $section->verificationSectionType->name.":{$section->percentCompleted}%: {$pr} | ";
            }
        }
        return $ansStr;
    }

// Creado por Jonathan
    public function getPercentageSummary() {
        $ansStr = "";
        $ans = 0;
        $weight = array();
        foreach ($this->customerProduct->verificationsInProduct as $verificationInProduct) {
            $weight[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct->weight;
        }
        foreach ($this->verificationSections as $section) {
            if (isset($weight[$section->verificationSectionTypeId])) {
                $ans = $weight[$section->verificationSectionTypeId] * $section->percentCompleted / 100;
                $ansStr.= $section->verificationSectionType->name . " [" . $weight[$section->verificationSectionTypeId] . "%] : {$section->percentCompleted}% / ";
            }
        }
        return $ansStr;
    }

    public function getResultSummary($withAssignedUser = false) {
        $data = $this->search();

        $ans = Yii::app()->db->createCommand()->select('result.name as Estado, count(t.resultId) as Estudios')->from('{{BackgroundCheck}} t');
        if ($data->criteria->condition != "") {
            $ans = $ans->where($data->criteria->condition, $data->criteria->params);
        }
        $ans = $ans->join('{{Result}} result', 'result.id=t.resultId');
        $ans = $ans->join('{{Customer}} customer', 'customer.id=t.customerId');
        if ($withAssignedUser) {
            $ans = $ans->leftJoin('{{AssignedUser}} assignedUsersSearch', 'assignedUsersSearch.backgroundCheckId=t.id ');
        }
        $ans = $ans->group('t.resultId')->queryAll();

        return $ans;
    }

    public function getResultSummaryByMonth($withAssignedUser) {

        $data = $this->search();

        $results = Result::model()->findAll();

        $select = array();
        foreach ($results as $result) {
            $select[] = "count(if (t.resultId={$result->id},1,null)) as '{$result->name}'";
        }

        $ans = Yii::app()->db->createCommand()->select('date_format(t.studyStartedOn,"%Y-%m") as Mes, ' . implode(",", $select))->from('{{BackgroundCheck}} t')->join('{{Customer}} customer', 't.customerId=customer.id');

        if ($data->criteria->condition != "") {
            $ans = $ans->where($data->criteria->condition, $data->criteria->params);
        }
        if ($withAssignedUser) {
            $ans = $ans->leftJoin('{{AssignedUser}} assignedUsersSearch', 'assignedUsersSearch.backgroundCheckId=t.id ');
        }

        $ans = $ans->group('date_format(t.studyStartedOn,"%Y-%m")')->queryAll();

        return $ans;
    }

    public function getResultSummaryByCustomer($withAssignedUser) {

        $data = $this->search();

        $results = Result::model()->findAll();

        $select = array();
        foreach ($results as $result) {
            $select[] = "count(if (t.resultId={$result->id},1,null)) as '{$result->name}'";
        }

        $ans = Yii::app()->db->createCommand()->select('customer.name as customer, ' . implode(",", $select))->from('{{BackgroundCheck}} t')->join('{{Customer}} customer', 't.customerId=customer.id');

        if ($data->criteria->condition != "") {
            $ans = $ans->where($data->criteria->condition, $data->criteria->params);
        }
        if ($withAssignedUser) {
            $ans = $ans->leftJoin('{{AssignedUser}} assignedUsersSearch', 'assignedUsersSearch.backgroundCheckId=t.id ');
        }

        $ans = $ans->group('t.customerId')->queryAll();

        return $ans;
    }

    public function getResultSummaryByCustomerReportType($withAssignedUser) {

        $data = $this->search();

        $results = Result::model()->findAll();

        $select = array();
        foreach ($results as $result) {
            $select[] = "count(if (t.resultId={$result->id},1,null)) as '{$result->name}'";
        }

        $ans = Yii::app()->db->createCommand()->select('concat(customerGroup.name," - ",upper(customerProduct.name)) as customer_product, ' . implode(",", $select))->from('{{BackgroundCheck}} t')->join('{{Customer}} customer', 't.customerId=customer.id')->join('{{CustomerGroup}} customerGroup', 'customer.customerGroupId=customerGroup.id')->join('{{CustomerProduct}} customerProduct', 't.customerProductId=customerProduct.id');

        if ($data->criteria->condition != "") {
            $ans = $ans->where($data->criteria->condition, $data->criteria->params);
        }
        if ($withAssignedUser) {
            $ans = $ans->leftJoin('{{AssignedUser}} assignedUsersSearch', 'assignedUsersSearch.backgroundCheckId=t.id ');
        }

        $ans = $ans->group('customer.customerGroupId, upper(customerProduct.name)')->order('customerGroup.name,upper(customerProduct.name)')->queryAll();

        return $ans;
    }

    static public function getResultSummaryByCustomerReportTypeDaily() {

        $results = Result::model()->findAll();

        $thisMonthDate = new DateTime("now", timezone_open('America/Bogota'));
        $previewsMonthDate = clone $thisMonthDate;
        $previewsMonthDate->sub(new DateInterval('P1M'));

        $thisMonth = $thisMonthDate->format('Y-m');
        $previewsMonth = $previewsMonthDate->format('Y-m');

        $select = array(
            "count(if (date_format(t.studyStartedOn,'%Y-%m')='{$previewsMonth}',1,null)) as 'previewsPeriodIn'",
            "count(if (date_format(t.approvedOn,'%Y-%m')='{$previewsMonth}',1,null)) as 'previewsPeriodApproved'",
            "count(if (date_format(t.studyStartedOn,'%Y-%m')='{$thisMonth}',1,null)) as 'currentPeriodIn'",
            "count(if (date_format(t.approvedOn,'%Y-%m')='{$thisMonth}',1,null)) as 'currentPeriodApproved'",
            "count(if (t.resultId='" . Result::PENDING . "',1,null)) as 'pending'",
        );

        $ans = Yii::app()->db->createCommand()->select('customer.name as customer,customerProduct.name as product,' . 't.customerId,t.customerProductId, ' . implode(",", $select))->from('{{BackgroundCheck}} t')->join('{{Customer}} customer', 't.customerId=customer.id')->join('{{CustomerProduct}} customerProduct', 't.customerProductId=customerProduct.id')->where('t.studyStartedOn >= :previewsMonth or t.resultId=:resultId', array(
            ':previewsMonth' => $previewsMonthDate->format('Y-m-01'),
            ':resultId' => Result::PENDING
        ));

        $ans = $ans->group('t.customerProductId')->order('customer.name ASC, customerProduct.name ASC')->queryAll();

        return array(
            'from' => $previewsMonthDate->format("Y-m-d"),
            'to' => $thisMonthDate->format("Y-m-d"),
            'data' => $ans
        );
    }

    public function extendLimit($days) {
        $this->studyLimitOn = Holiday::addWorkingDays($this->studyLimitOn, $days);
        $this->save();
    }

    public function setDefaults() {
        $this->backgroundCheckStatusId = BackgroundCheckStatus::REQUESTED;
        $this->requestSystemId = RequestSystem::SES_SYSTEM;
        $this->studyStartedOn = date("Y-m-d");
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            $this->studyLimitOn = new CDbExpression('NOW()');
            $customerProduct = CustomerProduct::model()->findByPK($this->customerProductId);
            if ($customerProduct && $this->studyStartedOn != "" && $this->studyStartedOn > "0000-00-00") {
                $this->studyLimitOn = Holiday::addWorkingDays($this->studyStartedOn, $customerProduct->maxDays);
            }
        }
        return parent::beforeValidate();
    }

    public function getOneDayBeforeLimit() {
        // $timeZone = new DateTimeZone('America/Bogota');
        // $now = new DateTime($this->studyLimitOn, $timeZone);

        // $now->sub(new DateInterval('P1D'));

        // // If is holiday goes to next day.
        // while (!Holiday::isWorkingDay($now)) {
        //     $now->sub(new DateInterval('P1D'));
        // }
        // return $now->format("Y-m-d 16:00:00");

        $customerProduct = CustomerProduct::model()->findByPK($this->customerProductId);
        $internalDays = 0;
        if(isset($customerProduct->maxInternalDays)){
            $internalDays = $customerProduct->maxInternalDays - 1;
        }

        $internalLimit = Holiday::addWorkingDaysDash($this->studyStartedOn, $internalDays);
        return $internalLimit . ' 00:00:00';
    }

    public function beforeSave() {
        
        if ($this->isNewRecord) {
            $this->code = $this->getNewCode();
            $this->seed = $this->getNewSeed();

            $timeZone = new DateTimeZone('America/Bogota');
            $now = new DateTime('now', $timeZone);

            $customerExpress = CustomerProduct::model()->findByPK($this->customerProductId);

            if($customerExpress->hourExpress>0 && ($customerExpress->maxDays==0 || $customerExpress->maxDays==null) && ($customerExpress->maxInternalDays==0 || $customerExpress->maxInternalDays==null)) {          
                
                $nowEnd= clone($now);
                $nowEnd->add(new DateInterval('P0DT'.$customerExpress->hourExpress.'M'));

                if ($nowEnd->format('H') >= CustomerProduct::FINISH_WORKING_HOUR) {
                    $now->add(new DateInterval('P1D'));
                    $this->studyStartedOn = $now->format('Y-m-d '.CustomerProduct::START_WORKING_HOUR.':00:00');

                    $nowExpress = new DateTime($this->studyStartedOn, $timeZone);
                    $nowExpress->add(new DateInterval('P0DT'.$customerExpress->hourExpress.'M'));
                    $this->studyLimitOn = $nowExpress->format('Y-m-d H:i:s');
                }else{
                    $this->studyStartedOn = $now->format('Y-m-d H:i:s');
                    $now->add(new DateInterval('P0DT'.$customerExpress->hourExpress.'M'));
                    $this->studyLimitOn = $now->format('Y-m-d H:i:s');
                }

                // If is holiday goes to next day.
                while (!Holiday::isWorkingDay($now)) {
                    $now->add(new DateInterval('P1D'));
                    $this->studyStartedOn = $now->format('Y-m-d '.CustomerProduct::START_WORKING_HOUR.':00:00');

                    $nowExpress = new DateTime($this->studyStartedOn, $timeZone);
                    $nowExpress->add(new DateInterval('P0DT'.$customerExpress->hourExpress.'M'));
                    $this->studyLimitOn = $nowExpress->format('Y-m-d H:i:s');
                }

            }else{
                // If the product is Ordered after 12 applies the next day.
                if ($now->format('H') >= 12) {
                    $now->add(new DateInterval('P1D'));
                }
                // If is holiday goes to next day.
                while (!Holiday::isWorkingDay($now)) {
                    $now->add(new DateInterval('P1D'));
                }
                $this->studyStartedOn = $now->format('Y-m-d H:i:s');
                $this->studyLimitOn = $this->studyStartedOn;

                $customerProduct = CustomerProduct::model()->findByPK($this->customerProductId);
                if ($customerProduct && $this->studyStartedOn != "" && $this->studyStartedOn > "0000-00-00") {
                    $maxDays = $customerProduct->maxDays - 1;
                    if ($maxDays < 0) {
                        $maxDays = 0;
                    }
                    $this->studyLimitOn = Holiday::addWorkingDays($this->studyStartedOn, $maxDays);
                    //TODO $this->initialStudyLimitOn=$this->studyLimitOn;
                }
            }
        }

        // verify if the firstName and lastName are in camel notation
        // mb_strtoupper($this->lastName, 'UTF8')

        if ($this->backgroundCheckStatusId == BackgroundCheckStatus::CANCELLED ||
                $this->backgroundCheckStatusId == BackgroundCheckStatus::PARTIAL_CANCELLED) {
            $this->resultId = Result::NO_RESULT;
        }

        if (strpos($this->idNumber, '.') !== false || strpos($this->idNumber, "'") !== false) {
            $this->idNumber = str_replace(array("'", "."), "", $this->idNumber);
        }

        $farthesEvent = $this->farthestInformedEvent;
        if ($farthesEvent && $farthesEvent > $this->studyLimitOn) {
            $this->studyLimitOn = $farthesEvent;
        }


        if (!$this->isCompanySurvey) {
            if ($this->firstName != mb_convert_case($this->firstName, MB_CASE_TITLE, 'UTF8')) {
                $this->firstName = mb_convert_case($this->firstName, MB_CASE_TITLE, 'UTF8');
            }
            if ($this->lastName != mb_convert_case($this->lastName, MB_CASE_TITLE, 'UTF8')) {
                $this->lastName = mb_convert_case($this->lastName, MB_CASE_TITLE, 'UTF8');
            }
        }
        return parent::beforeSave();
    }

    public function beforeDelete() {
        $this->deleteReportPdf();
        return parent::beforeDelete();
    }

    public function getNewCode() {
        do {
            $code = $this->calculateCode();
            $ans = BackgroundCheck::model()->findByAttributes(array(
                'code' => $code
            ));
        } while ($ans != NULL);
        return $code;
    }

    private function calculateCode() {
        $posibleCodes = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeLenght = 10;
        $code = '';
        for ($i = 0; $i < $codeLenght; $i++) {
            $code.= $posibleCodes[rand(0, strlen($posibleCodes) - 1)];
        }
        return $code;
    }

    public function getNewSeed() {
        return MD5('SVP' . $this->lastName . date('r') . $this->firstName . microtime(true) . rand(0, 9999999) . 'Security');
    }

    public function getAge() {
        $now = new DateTime('now');
        try {
            $ans = $now->diff(new DateTime($this->birthday))->format('%Y');
        } catch (Exception $e) {
            $this->addError('birthday', "El formato de la fecha está errado.");
            $ans = "**ERR**";
        }
        return $ans;
    }

    static public function findByCode($code) {
        $model=null;
        if(Yii::app()->user->getIsByRole()){
            if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIO_SENIOR)){
                $assignedUsers=Yii::app()->user->arUser->assignedUsers;
                $assignedUsersIds=CHtml::listData($assignedUsers, 'id', 'id');
                
                $criteria = new CDbCriteria;
                $criteria->with = array('assignedUsersSearch');
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId in ('.implode(",",$assignedUsersIds).')');
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->compare('code', $code, false);
                $model = BackgroundCheck::model()->find($criteria);
            }
            else if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ESTUDIOS_ANALISTA)){
                $criteria = new CDbCriteria;
                $criteria->with = array('assignedUsersSearch');
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->compare('code', $code, false);
                $model = BackgroundCheck::model()->find($criteria);
            }else if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){
                $model = BackgroundCheck::model()->findByAttributes(array('code' => $code));
            }
        }else{
            if (Yii::app()->user->isAdmin) {
                $model = BackgroundCheck::model()->findByAttributes(array('code' => $code));
            } else {
                $criteria = new CDbCriteria;
                $criteria->with = array('assignedUsersSearch');
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
                $criteria->addCondition('approvedBy is null or inAmendment = 1');
                $criteria->addCondition('assignedUsersSearch.finishedAt is null');
                $criteria->compare('code', $code, false);
                $model = BackgroundCheck::model()->find($criteria);
            }
        }
       
        if ($model === null) {
            WebUser::logAccess("ERROR: Intento acceder el estudio " . CHtml::encode($code));
        }
        return $model;
    }

    static public function findByCodeCus($code) {
        return BackgroundCheck::model()->findByAttributes(array(
                    'code' => $code
        ));
    }

    public function getFullName() {
        return ($this->isCompanySurvey ? '' : $this->firstName) . " " . $this->lastName;

        //    return $this->firstName . " " . mb_strtoupper($this->lastName, 'UTF8');
    }

    public function getFrontPageImage() {
        $image = Document::model()->findByAttributes(array(
            'backgroundCheckId' => $this->id,
            'imageSizeId' => ImageSize::FRONT_PAGE,
        ));
        return $image;
    }

    public function getHtmlFrontPageImage($size = null) {
        /* @var $portrait Document */
        $portrait = $this->frontPageImage;
        $htmlPortrait = '';
        if ($portrait) {

            if (!$size) {
                $maxWidth = 300;
                $maxWidth = 200;
            } else {
                //TODO: To review 
                $maxWidth = 300;
                $maxWidth = 200;
            }

            $imageFile = $portrait->getTemporalSizedImageWithSize($maxWidth, $maxWidth);
            $this->_pendindToDelete[] = $imageFile;

            $htmlPortrait = '<img alt="portrait" src="' . $imageFile . '" />';
        }
        return $htmlPortrait;
    }

    public function getDaysStudy() {
        $from = $this->studyStartedOn;
        if (!$this->result->isPending()) {
            $until = $this->deliveredToCustomerOn;
        } else {
            $until = "now";
        }
        return Holiday::numOfWorkingDays($from, $until);
    }

    public function getDaysChecker() {
        $from = $this->assignedOn;
        if ($this->returnedByCheckerOn == null || $this->returnedByCheckerOn == "0000-00-00") {
            $until = "now";
        } else {
            $until = $this->returnedByCheckerOn;
        }
        return Holiday::numOfWorkingDays($from, $until);
    }

    public function getNumberOfEvents() {
        $ans = 0;
        foreach ($this->events as $event) {

            // @val Event $event
            if ($event->informedToCustomerOn != null) {
                $ans++;
            }
        }
        return $ans;
    }

    public function getEventsDescription() {
        $ans = '';
        foreach ($this->events as $event) {

            // @val Event $event
            if ($event->informedToCustomerOn != null) {
                $ans.= "[" . $event->created . " : " . $event->detail . "] ";
            }
        }
        return $ans;
    }

    public function getFindings() {
        $ans = "";
        if ($this->findingLaboralHistory)
            $ans.= "Lab.";
        if ($this->findingtextLaboral)
            $ans.="->".$this->findingtextLaboral.".";
        if ($this->findingSocioeconomic)
            $ans.= "CRiesg.";
        if ($this->findingVisit)
            $ans.= "Vis.";
        if ($this->findingReturn)
            $ans.= "Ret.";
        if ($this->findingStudy)
            $ans.= "Aca.";
              if ($this->findingtextStudy)
                  $ans.="->".$this->findingtextStudy.".";
        if ($this->findingPolygraph)
            $ans.= "Pol.";
          if ($this->findingdropPoly==1){
            $ans.="->Admisiones";
             }
             elseif($this->findingdropPoly==2) {
                 $ans .= "->Reaccion";
             }
          if ($this->findingtextPoly)
              $ans.="->".$this->findingtextPoly.".";
        if ($this->findingOther)
            $ans.= "Otro.";
        if ($this->findingBackground)
            $ans.= "Antc.";
              switch ($this->findingdropBackg){
                  case 1:
                      $ans.="->Simit";
                          Break;
                  case 2:
                      $ans.="->Policia";
                      Break;
                  case 3:
                      $ans.="->Rama Judicial";
                      Break;
                  case 4:
                      $ans.="->Contaduría";
                      Break;
                  case 5:
                      $ans.="->Procuraduría";
                      Break;
                  case 6:
                      $ans.="->Libreta Militar";
                      Break;
                  case 7:
                      $ans.="->TYBA";
                      Break;
                  case 8:
                      $ans.="->Listas Restrictivas";
                      Break;
                  case 9:
                      $ans.="->INPEC";
                      Break;
                  case 10:
                      $ans.="->Rama Judicial Unificada";
                      Break;
                  case 11:
                      $ans.="->Simur";
                      Break;
                  case 12:
                      $ans.="->Fiscalia";
                      Break;
                  case 13:
                      $ans.="->Contraloria";
                      Break;
                  case 14:
                      $ans.="->Vehiculos Inmovilizados";
                      Break;
                  case 15:
                      $ans.="->Word Compliance";
                      Break;
                  case 16:
                      $ans.="->Noticiass Reputacionales";
                      Break;
                  case 17:
                      $ans.="->RNCM";
                      Break;
                  case 18:
                      $ans.="->Inhabilidades - Delitos Sexuales";
                      Break;
              }
              if ($this->findingtextBackg)
                     $ans.="->".$this->findingtextBackg.".";
        if ($this->findingTestPsychote)
            $ans.= "Psicotec.";
        if ($this->findingODT)
            $ans.= "ODT.";
        if ($this->findingfinantAnalys)
            $ans.= "A Financiero.";
        if ($this->findingAudit)
            $ans.= "Audit.";
        if ($this->findingrestricList)
            $ans.= "List Restr.";
            switch ($this->findingrestricList) {
                case 1:
                    $ans.= "->Listas Restric";
                    Break;
                case 2:
                    $ans.= "->Nit";
                    Break;
                case 3:
                    $ans.= "->Socios y Rep Leg";
                    Break;
            }
            if ($this->findingtextrestrList)
                $ans.="->".$this->findingtextrestrList.".";

        if ($this->findingDoc)
            $ans.= "Doc.";
             switch ($this->findingdropDoc) {
                 case 1:
                     $ans .= "->Alteración";
                     Break;
                 case 2:
                     $ans .= "->No entrega Doc";
                     Break;
             }
            if ($this->findingtextDoc)
                 $ans.="->".$this->findingtextDoc.".";
        return $ans;
    }

    Public function getFindingslite() {
        $ans = "";
        if ($this->findingLaboralHistory)
            $ans.= "Lab.";      
        if ($this->findingSocioeconomic)
            $ans.= "CRiesg.";
        if ($this->findingVisit)
            $ans.= "Vis.";
        if ($this->findingReturn)
            $ans.= "Ret.";
        if ($this->findingStudy)
            $ans.= "Aca.";              
        if ($this->findingPolygraph)
            $ans.= "Pol.";      
        if ($this->findingOther)
            $ans.= "Otro.";
        if ($this->findingBackground)
            $ans.= "Antc.";
        if ($this->findingTestPsychote)
            $ans.= "Psicotec.";
        if ($this->findingODT)
            $ans.= "ODT.";
        if ($this->findingfinantAnalys)
            $ans.= "A Financiero.";
        if ($this->findingAudit)
            $ans.= "Audit.";
        if ($this->findingrestricList)
            $ans.= "List Restr.";
        if ($this->findingDoc)
            $ans.= "Doc.";            
        return $ans;
    }

    public function getIsApproved() {
        return ($this->approvedBy && ((int) $this->approvedBy) > 0);
    }

    // Functions to save the report

    public function getAbsolutePath() {
        return $this->getAbsoluteDir() . "/" . sprintf("%09d", $this->id) . ".enc";
    }

    public function getAbsolutePathCert() {
        return $this->getAbsoluteDir() . "/" . sprintf("%09d", $this->id) . "_c.enc";
    }

    public function getAbsoluteDir() {
        $idStr = sprintf("%09d", $this->id);
        $dir = Yii::app()->params['reportsDir'] . "/" . substr($idStr, 0, 3) . "/" . substr($idStr, 3, 3);
        return $dir;
    }

    public function checkAbsoluteDir() {
        $dir = $this->getAbsoluteDir();
        if (!file_exists($dir)) {
            mkdir($dir, 0770, true);
        }
    }

    public function saveBackgroundCheckReport($file) {
        $iv = substr(md5("" . $this->id . $this->code, true), 0, 8);
        $key = substr(md5($this->seed, true), 0, 24);

        $this->checkAbsoluteDir();
        if (file_exists($this->absolutePath)) {
            unlink($this->absolutePath);
        }

        $opts = array(
            'iv' => $iv,
            'key' => $key
        );
        $fp = fopen($this->absolutePath, 'wb');
        stream_filter_append($fp, 'mcrypt.tripledes', STREAM_FILTER_WRITE, $opts);
        fwrite($fp, file_get_contents($file));
        fclose($fp);
    }

    public function saveBackgroundCheckCert($file) {
        $iv = substr(md5("" . $this->id . $this->code, true), 0, 8);
        $key = substr(md5($this->seed, true), 0, 24);

        $this->checkAbsoluteDir();
        if (file_exists($this->absolutePathCert)) {
            unlink($this->absolutePathCert);
        }

        $opts = array(
            'iv' => $iv,
            'key' => $key
        );
        $fp = fopen($this->absolutePathCert, 'wb');
        stream_filter_append($fp, 'mcrypt.tripledes', STREAM_FILTER_WRITE, $opts);
        fwrite($fp, file_get_contents($file));
        fclose($fp);
    }

    private function createWatermarkPDF($pdfFilename, $watermarkText) {

        $cmd = "/usr/bin/convert -size 320x460 " . "-channel RGBA  -alpha transparent " . "xc:blue " . "-transparent blue " . "-compose blend " . "-draw \" " . "font-size 48  " . "fill rgba( 240, 240,240 , 0.20 ) stroke rgba( 235, 235,235, 0.18 ) stroke-width 1 " . "translate 20,458 rotate -52 text 0,0 ' " . $watermarkText . " '\" " . "{$pdfFilename} ";
        exec($cmd);
    }

    public function getCryptedPdf($dataIn, $userPassword = null, $canPrint = FALSE, $watermarkText = "", $markX = null, $markY = null, $pages = null, $printWatermark=true) {
        Yii::import('application.extensions.fpdf.*');
        require_once ('fpdf.php');

        // 2014 08 07 Everybody can print LMZ
        //$canPrint=true;

        $data = null;

        $pdfFile = Yii::app()->basePath . "/runtime/" . uniqid("svp_input", true) . ".pdf";
        $pdfFileOutput = Yii::app()->basePath . "/runtime/" . uniqid("svp_output_", true) . ".pdf";
        $pdfFileBackground = Yii::app()->basePath . "/runtime/" . uniqid("svp_background_", true) . ".pdf";
        $pdfFileStamp = Yii::app()->basePath . "/runtime/" . uniqid("svp_stamp_", true) . ".pdf";
        $pdfFileStamp2 = Yii::app()->basePath . "/runtime/" . uniqid("svp_stamp2_", true) . ".pdf";

        $this->createWatermarkPDF($pdfFileStamp, $watermarkText);

        file_put_contents($pdfFile, $dataIn);

        // encrypt the PDF File
        // Instanciation of inherited class
        $mark = 'Descargado por: ' . Yii::app()->user->name . '    Desde:' . $_SERVER['REMOTE_ADDR'] . '   En: ' . Yii::app()->db->createCommand('select now()')->queryScalar();

        if ($markY === null) {
            if ($this->customerProduct->isPdfReportType) {
                $markX = $this->customerProduct->pdfReportType->markX;
                $markY = $this->customerProduct->pdfReportType->markY;
            } else {
                $markY = 10;
                $markX = 0;
            }
        }


        if($pages){
            $pathtemp=tempnam(Yii::app()->runtimePath, 'PDF_').".pdf";

            //casting de (int) interprete la siguiente variable con este tipo, 18/08/21 Herman.
            //$cmd="/usr/bin/gs -dBATCH -dNOPAUSE -sDEVICE=pdfwrite -dFirstPage=1 -dLastPage=".(int)$pages." -sOutputFile={$pathtemp} {$pdfFile} ";
            $cmd = "/usr/bin/pdftk {$pdfFile} cat 1-".(int)$pages." output {$pathtemp} " . "";
            exec($cmd);
            exec("mv {$pathtemp} {$pdfFile}");
        }

        if($printWatermark){

            $pdf = new FPDF();
            $pdf->addPage();
            $pdf->SetAutoPageBreak(true, 0);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetFont('Arial', 'I', 8);
            //$pdf->SetXY($markX, $markY);
            $pdf->SetXY(5, 2);
            $pdf->Cell(196, 5, $mark, 0, 0, 'C');
    
            $pdf->Output($pdfFileBackground, 'F');

            $cmd = "/usr/bin/pdftk {$pdfFileBackground} " . "stamp {$pdfFileStamp} " . "output {$pdfFileStamp2} " . "";
            exec($cmd);
            $printWaterCommand="multistamp {$pdfFileStamp2} ";

        }else{
            $printWaterCommand=" ";
        }

        $cmd = "/usr/bin/pdftk {$pdfFile} " .
               $printWaterCommand . 
               " output {$pdfFileOutput} " . "owner_pw " . md5($this->seed . uniqid()) . " " . 
               (($userPassword && trim($userPassword) != '') ? "user_pw '" . 
               escapeshellcmd(escapeshellarg($userPassword)) . "' " : "") . (($canPrint) ? "allow printing CopyContents" : "") . "";

        exec($cmd);

        $data=file_get_contents($pdfFileOutput);

        if (file_exists($pdfFile)) {
            unlink($pdfFile);
        }
        if (file_exists($pdfFileOutput)) {
            unlink($pdfFileOutput);
        }
        if (file_exists($pdfFileBackground)) {
            unlink($pdfFileBackground);
        }
        if (file_exists($pdfFileStamp)) {
            unlink($pdfFileStamp);
        }
        if (file_exists($pdfFileStamp2)) {
            unlink($pdfFileStamp2);
        }
        return $data;
    }

    public function getBackgroundCheckReport($userPassword = null, $canPrint = FALSE, $watermarkText = "", $markX = 0, $markY = 10, $pages=null, $printWatermark=true) {
        return $this->getBackgroundCheckFile($this->absolutePath, $userPassword, $canPrint, $watermarkText, $markX, $markY, $pages, $printWatermark);
    }

    public function getBackgroundCheckReportCert($userPassword = null, $canPrint = FALSE, $watermarkText = "", $markX = 0, $markY = 10) {
        return $this->getBackgroundCheckFile($this->absolutePathCert, $userPassword, $canPrint, $watermarkText, $markX, $markY);
    }

    private function getBackgroundCheckFile($path, $userPassword = null, $canPrint = FALSE, $watermarkText = "", $markX = 0, $markY = 10, $pages=null, $printWatermark=true) {
        $iv = substr(md5("" . $this->id . $this->code, true), 0, 8);
        $key = substr(md5($this->seed, true), 0, 24);

        $opts = array(
            'iv' => $iv,
            'key' => $key
        );

        if (!file_exists($path)) {
            Yii::log("The file [{$path}] of Study code {$this->code} has a problem", "error", "ZWF." . __CLASS__);
            throw new Exception("File  does not exists.");
        }

        $fp = fopen($path, 'rb');
        stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
        $data = stream_get_contents($fp);
        fclose($fp);

        return $this->getCryptedPdf($data, $userPassword, $canPrint, $watermarkText, $markX, $markY, $pages, $printWatermark);
    }

    public function deleteReportPdf() {
        if (file_exists($this->absolutePath)) {
            unlink($this->absolutePath);
        }
        if (file_exists($this->absolutePathCert)) {
            unlink($this->absolutePathCert);
        }
    }

    public function getAssignedUserNames() {
        $ans = '';
        $users = array();
        foreach ($this->assignedUsers as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            if (!isset($users[$assignedUser->userId . "-" . $assignedUser->userRoleId])) {
                $users[$assignedUser->userId . "-" . $assignedUser->userRoleId] = $assignedUser;
            }
        }
        foreach ($users as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            $ans.= $assignedUser->user->shortUsername . ' [<b>' . $assignedUser->userRole->nick . '</b>]<br/>';
        }
        return $ans;
    }

    public function getSectionGroups() {
        $ans = array();
        foreach ($this->verificationSections as $verificationSection) {
            if ($verificationSection->verificationSectionType->verificationSectionGroupId > 0) {
                if (!isset($ans[$verificationSection->verificationSectionType->verificationSectionGroupId])) {
                    $ans[$verificationSection->verificationSectionType->verificationSectionGroupId] = $verificationSection->verificationSectionType;
                }
            }
        }
        return $ans;
    }

    public function getSectionGroupsStr() {
        $sectionGroups = Yii::app()->db->createCommand()
        ->select(
                'verificationSectionType.name as verificationSectionType, ' .
                'ifnull(verificationSectionGroup.name,"....") as verificationSectionGroup, ' .
                'ifnull(user.username,"*****") as user, ' .
                'userRole.nick as userRole, ' .
                'assignedUser.finishedAt, ' .
                'verificationSection.percentCompleted, ' .
                'verificationSection.resultId, ' .
                'result.nick ' .
                '')
        ->from('{{VerificationSection}} as verificationSection')
        ->join('{{VerificationSectionType}} as verificationSectionType', 'verificationSectionType.id=verificationSection.verificationSectionTypeId')
        ->leftJoin('{{VerificationSectionGroup}} as verificationSectionGroup', 'verificationSectionGroup.id=verificationSectionType.verificationSectionGroupId')
        ->leftJoin('{{AssignedUser}} as assignedUser', 'assignedUser.verificationSectionId=verificationSection.id')
        ->leftJoin('{{User}} as user', 'user.id=assignedUser.userId')
        ->leftJoin('{{UserRole}} as userRole', 'userRole.id=assignedUser.userRoleId')
        ->leftJoin('{{Result}} as result', 'result.id=verificationSection.resultId')
        ->where('verificationSection.backgroundCheckId=:backgroundCheckId', array(':backgroundCheckId' => $this->id))
        ->order('verificationSectionGroup.name,verificationSectionType.name,user.username')
        ->queryAll();

$verificationSectionsGroups = array();
        foreach ($sectionGroups as $sectionGroup) {
            
            if (!isset($verificationSectionsGroups[$sectionGroup['verificationSectionGroup']])) {
                $verificationSectionsGroups[$sectionGroup['verificationSectionGroup']] = array();
            }
            if (!isset($verificationSectionsGroups[$sectionGroup['verificationSectionGroup']][$sectionGroup['verificationSectionType']])) {
                $verificationSectionsGroups[$sectionGroup['verificationSectionGroup']][$sectionGroup['verificationSectionType']] = array();
            }

            switch($sectionGroup['resultId'] ){
                // $pr = "<font color=#49C42E>EC</font>";
                    case $sectionGroup['resultId'] ==null:
                        $pr = "";
                    case $sectionGroup['resultId'] ==1:
                        $pr = "<font color='#000000'><b>EC</b></font>";
                        break;
                    case $sectionGroup['resultId'] ==2:
                        $pr ="<font color=#49C42E><b>SH</b></font>";
                        break;
                    case $sectionGroup['resultId'] ==3:
                        $pr = "<font color='red'><b>CH</b></font>";
                        break;
                    case $sectionGroup['resultId'] ==4:
                        $pr = "<font color=#ff9e3d><b>CHM</b></font>";
                        break;

                    default:
                        $pr ="<font color=#000000><b>".$sectionGroup['nick']."</b></font>";
            }

            $verificationSectionsGroups[$sectionGroup['verificationSectionGroup']][$sectionGroup['verificationSectionType']][] = (strpos($sectionGroup['user'], '@') > 0 ? substr($sectionGroup['user'], 0, strpos($sectionGroup['user'], '@')) . ' [' . $sectionGroup['userRole'] . ']'.'<br>'.'['.$sectionGroup['percentCompleted'].'%]'.$pr : $sectionGroup['user']);

            //$verificationSectionsGroups[$sectionGroup['verificationSectionGroup']][$sectionGroup['verificationSectionType']][] = ('['.$sectionGroup['percentCompleted'].'%]'.' '.$sectionGroup['nick']);
        }

        $ans = "<table>\n";

        foreach ($this->assignedUsers as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            if (!$assignedUser->verificationSection) {
                $ans.="<tr><td>-----</td><td>-----</td><td>{$assignedUser->user->shortUsername}  [{$assignedUser->userRole->nick}]</td><tr>";
            }
        }

        foreach ($verificationSectionsGroups as $sectionGroupName => $sections) {
            $firstSection = true;
            $sectionsSize = 0;
            foreach ($sections as $sectionName => $users) {
                $sectionsSize++;
                foreach ($users as $user) {
                    $sectionsSize++;
                }
                $sectionsSize--;
            }
            foreach ($sections as $sectionName => $users) {
                $firstUser = true;
                foreach ($users as $user) {
                    $ans.="<tr>\n";
                    if ($firstSection) {
                        $ans.='<td rowspan="' . (int) ($sectionsSize) . '">' . $sectionGroupName . '</td>';
                    }
                    if ($firstUser) {
                        $ans.='<td rowspan="' . count($users) . '">' . $sectionName . '</td>';
                    }
                    $ans.='<td style="width:200px;">' . $user. '</td>';
                    $ans.="</tr>\n";
                    $firstSection = false;
                    $firstUser = false;
                }
            }
        }

        $ans.='</table>';
        return $ans;
    }

    public function getAssignedUserNamesFull() {
        $ans = '';
        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);
        $nows = $now->format('A-m-d H:i:s');
        foreach ($this->assignedUsers as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            $ans.= '<span style="color:' . ($assignedUser->limit < $nows ? 'red' : 'black') . '">' .
                    $assignedUser->user->shortUsername . ' [<b>' . $assignedUser->userRole->nick . '</b>]:' . $assignedUser->limit .
                    ($assignedUser->verificationSection ? ':' . $assignedUser->verificationSection->sectionName : '') . '</span><br/>';
        }
        return $ans;
    }

    public function getAssignedUserNamesPlain() {
        $ans = '';
        $first = true;
        foreach ($this->assignedUsers as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            if (!$first) {
                $ans.=' | ';
            } else {
                $first = false;
            }
            $ans.= $assignedUser->user->shortUsername . ' [' . $assignedUser->userRole->nick . ']' .
                    ($assignedUser->verificationSection ? ':' . $assignedUser->verificationSection->sectionName : '') .
                    ' (' . substr($assignedUser->assignedAt, 5) . '->' . substr($assignedUser->finishedAt, 5) . ')';
        }
        return $ans;
    }

    public function getAssignedUserIds() {
        $ans = array();
        foreach ($this->assignedUsers as $assignedUser) {
            $ans[] = $assignedUser->userId;
        }
        return $ans;
    }

    public function getAssignedUserRoleIds() {
        $ans = array();
        foreach ($this->assignedUsers as $assignedUser) {
            $ans[] = $assignedUser->userRoleId;
        }
        return $ans;
    }

    public function getResponsible() {
        $responsible = null;
        foreach ($this->assignedUsers as $assignedUser) {
            if ($assignedUser->userRoleId == UserRole::ASSIGNED) {
                $responsible = $assignedUser;
                break;
            }
        }
        return $responsible;
    }

    public function getResponsibleShortUsername() {
        $ans = null;
        $responsible = $this->getResponsible();
        if ($responsible) {
            $ans = $responsible->user->shortUsername;
        }
        return $ans;
    }

    public function getCountOfOtherReportsOfPerson() {
        return count($this->otherReportsOfPerson);
    }

    public function getOtherReportsOfPerson() {
        $criteria = new CDbCriteria;

        $criteria->addCondition('(t.code<>:code) and ((t.firstName=:firstName and t.lastName=:lastName) or t.idNumber=:idNumber) ');
        $criteria->params = array(
            ':firstName' => $this->firstName,
            ':lastName' => $this->lastName,
            ':idNumber' => $this->idNumber,
            ':code' => $this->code,
        );

        return BackgroundCheck::model()->findAll($criteria);
    }

    static private function checkFilesWithoutLinkInDir($baseDir, $dir) {
        $files = array();
        if (is_dir($baseDir . "/" . $dir)) {
            $dh = opendir($baseDir . "/" . $dir);
            if ($dh) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        if (filetype($baseDir . "/" . $dir . "/" . $file) == 'dir') {
                            $files = array_merge($files, BackgroundCheck::checkFilesWithoutLinkInDir($baseDir, $dir . "/" . $file));
                        } else {
                            $idBackgroundCheck = (int) basename($file, '.enc');
                            $document = BackgroundCheck::model()->findByPk(array(
                                $idBackgroundCheck
                            ));
                            if (!$document) {
                                $files[] = array(
                                    'filename' => $file,
                                    'dir' => $dir,
                                    'size' => filesize($baseDir . "/" . $dir . "/" . $file),
                                    'time' => filemtime($baseDir . "/" . $dir . "/" . $file)
                                );
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }

    static public function getFilesWithoutLink() {
        $files = BackgroundCheck::checkFilesWithoutLinkInDir(Yii::app()->params['reportsDir'], null);
        return $files;
    }

    static public function deleteFileWithoutLink($deleteFilename) {
        if (Yii::app()->user->isAdmin) {
            $deleteFilename = preg_replace(array(
                '/\.\./',
                '/\/\./'
                    ), array(
                '_',
                '_'
                    ), $deleteFilename);
            $idBackgroundCheck = (int) basename($deleteFilename, '.enc');
            $document = BackgroundCheck::model()->findByPk(array(
                $idBackgroundCheck
            ));
            if (!$document) {
                $filename = Yii::app()->params['reportsDir'] . $deleteFilename;
                if (file_exists($filename)) {
                    WebUser::logAccess("Borro el reporte sin enlace : {$filename}");
                    unlink($filename);
                }
            }
        }
    }

    //Funcion que filtra los cancelados en plataforma clientes
    public function getIsCancelarAviable() {
        $fechacreado= $this->created;
        $agregada= date("Y-m-d H:i:s",strtotime($fechacreado."+ 60 minute"));
        $fecha_actual=date('Y-m-d H:i:s');
        // var_dump($fecha_actual);
        // var_dump($agregada);
        $ans = false;
        if ($agregada > $fecha_actual && $this->backgroundCheckStatusId ==1) {
            $ans = true;
        }
        return $ans;
    }
    // This function is only to be called from SES users



    // This function is only to be called from SES users
    public function getIsTemporalReportAvailable() {
        $ans = false;
        if ($this->temporalReportAvailable && Yii::app()->user->arUser->hasAccessToTemporalReports) {
            $ans = true;
        }
        return $ans;
    }

    // This function is only to be called from SES users
    public function getIsReportAvailable() {

        $ans = false;
        if ($this->reportAvailable && Yii::app()->user->arUser->hasAccessToReports) {
            if ($this->resultId == Result::FAVORABLE) {
                $ans = true;
            } else if (Yii::app()->user->arUser->accessToNegativeReports) {
                $ans = true;
            }
        }
        return $ans;
    }

    // This function is only to be called from SES users
    public function getIsCertificateAvailable() {

        $ans = false;
        if ($this->certificateAvailable && Yii::app()->user->arUser->hasAccessToCertificates) {
            if ($this->resultId == Result::FAVORABLE) {
                $ans = true;
            } else if (Yii::app()->user->arUser->accessToNegativeCertificates) {
                $ans = true;
            }
        }
        return $ans;
    }

    public function getOverdueDays() {
        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);
        $studyLimitOn = new DateTime($this->studyLimitOn, $timeZone);

        return (int) $studyLimitOn->diff($now)->format("%R%a");
    }

    public function getIsOverdue() {
        return ($this->overDueDays > 0);
    }

    static public function getPendingReports($untilDate = null) {


        $criteria = new CDbCriteria;
        $criteria->with = array(
            'assignedUsers',
            'assignedUsers.user',
            'customer',
            'customer.customerGroup',
            'customerProduct'
        );


        $criteria->together = true;
        $criteria->addCondition('(approvedOn is Null or approvedOn="0000-00-00 00:00:00" or  deliveredToCustomerOn is null  or deliveredToCustomerOn ="0000-00-00 00:00:00") and ' .
                'customerGroup.id<>:svpId and backgroundCheckStatusId not in (:cancel,:partialCancel)');

        $criteria->params = array(
            ':cancel' => BackgroundCheckStatus::CANCELLED,
            ':partialCancel' => BackgroundCheckStatus::PARTIAL_CANCELLED,
            ':svpId' => CustomerGroup::SAV_ID,
        );

        if ($untilDate) {
            $criteria->addCondition('date_format(studyLimitOn,"%Y/%m/%d")<=:untilDate');
            $criteria->params[':untilDate'] = $untilDate;
        }

        $criteria->order = 'customerGroup.name ASC, studyLimitOn ASC';

        $reports = BackgroundCheck::model()->findAll($criteria);

        return $reports;
    }

    public static function getFullPath($filename) {
        return (Yii::app()->basePath . "/runtime/" . $filename);
    }

    public function getCompanyName() {
        return $this->lastName;
    }

    public function getIsCompanySurvey() {
        return ($this->customerProduct && $this->customerProduct->isCompanySurvey);
    }

    public function getUserHasAccess() {
        $ans = false;
        if (Yii::app()->user->isAdmin || (Yii::app()->user->getIsByRole() && Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS))) {
            $ans = true;
        } else {
            foreach ($this->assignedUsers as $assignedUser) {
                if ($assignedUser->userId == Yii::app()->user->id && empty($assignedUser->finishedAt)) {
                    $ans = true;
                    break;
                }
            }
        }
        return $ans;
    }

    public function getCanUpdate() {
        return (!$this->isApproved || ($this->inAmendment && Yii::app()->user->isAdmin) || Yii::app()->user->isUser || ($this->inAmendment && Yii::app()->user->getIsByRole()));
    }

    public function getDocumentsInVerificationSection($verificationSectionTypeId) {
        $documents = $this->documents;
        $ans = array();
        foreach ($documents as $document) {
            if ((!$verificationSectionTypeId && $document->verificationSection == null) || ($document->verificationSection && $document->verificationSection->verificationSectionTypeId == $verificationSectionTypeId)) {
                $ans[] = $document;
            }
        }
        return $ans;
    }

    public function getVerificationSection($verificationSectionTypeId) {
        $ans = null;
        $sections = $this->verificationSections;
        foreach ($sections as $section) {
            if ($section->verificationSectionTypeId == $verificationSectionTypeId) {
                $ans = $section;
                break;
            }
        }
        return $ans;
    }

    public function getPendingPollsForUser($username) {

        $user = User::model()->findByAttributes(array(
            'username' => $username
        ));
        if ($user) {
            $criteria = new CDbCriteria;
            $criteria->addCondition('(assignedUsersSearch.userRoleId=:visitor or assignedUsersSearch.userRoleId=:assigned) ' . 'and t.approvedOn is Null ' . 'and assignedUsersSearch.userId=:userId');
            $criteria->params = array(
                ':visitor' => UserRole::VISITOR,
                ':assigned' => UserRole::ASSIGNED,
                ':userId' => $user->id,
            );
            $criteria->with[] = 'assignedUsersSearch';
            $backgroundChecks = BackgroundCheck::model()->findAll($criteria);
        } else {
            $backgroundChecks = array();
        }
        return $backgroundChecks;
    }

    public function getFormatedIdNumber() {

        if (is_numeric($this->idNumber)) {
            return number_format($this->idNumber, 0, ",", ".");
        } else {
            return $this->idNumber;
        }
    }

    function getQuestionXmlFormat() {
        return simplexml_load_string($this->customerProduct->xmlQuestion);
    }

    function getXmlAnswerArray() {
        if ($this->xmlAnswer != "") {
            @$ans = unserialize($this->xmlAnswer);
            if ($ans === false || !is_array($ans)) {
                $ans = array();
            }
        } else {
            $ans = array();
        }
        return $ans;
    }

    function getNotifyCustomerByMail() {
        return ($this->customer->notifyByMail && $this->customerProduct->notifyByMail && $this->customerUser->notifyByMail);
    }

    function getIsOnlyAdverse() {
        $ans = false;
        if (count($this->verificationSections) == 1) {
            $section = $this->verificationSections[0];
            $ans = ($section->verificationSectionTypeId == VerificationSectionType::REGISTER);
        }
        return $ans;
    }

    function getVerificationSectionTypes() {
        if (!$this->_verificationSectionTypes) {
            $this->_verificationSectionTypes = 0;
            foreach ($this->verificationSections as $verificationSection) {
                $this->_verificationSectionTypes+= BackgroundCheck::$_allSections[$verificationSection->verificationSectionTypeId];
            }
        }
        return $this->_verificationSectionTypes;
    }

    function getAllSections() {
        if (!BackgroundCheck::$_allSections) {
            BackgroundCheck::$_allSections = array();
            $sections = VerificationSectionType::model()->findAll();
            foreach ($sections as $section) {
                BackgroundCheck::$_allSections[$section->id] = pow(2, $section->id);
            }
        }
        return BackgroundCheck::$_allSections;
    }

    function getBackgroundCheckComponents() {
        $ans = array();

        foreach ($this->verificationSections as $verificationSection) {
            $ans[$verificationSection->verificationSectionType->component] = '';
        }

        return implode('', array_keys($ans));
    }

    function setPartialCostAndPrice() {
        $partialCost = 0;
        $partialPrice = 0;
        $verificationInProducts = array();
        foreach ($this->customerProduct->verificationsInProduct as $verificationInProduct) {
            $verificationInProducts[$verificationInProduct->verificationSectionTypeId] = $verificationInProduct;
        }

        foreach ($this->verificationSections as $verificationSection) {
            if ($verificationSection->percentCompleted >= 100) {
                if (isset($verificationInProducts[$verificationSection->verificationSectionTypeId])) {
                    $verificationInProduct = $verificationInProducts[$verificationSection->verificationSectionTypeId];
                    $partialCost+=$verificationInProduct->cost;
                    $partialPrice+=$verificationInProduct->price;
                }
            }
        }

        $this->cost = $partialCost;
        $this->price = $partialPrice;
    }

    function getCustomerFields() {
        $customerField = "";
        for ($i = 1; $i <= 6; $i++) {
            $field = 'field' . $i;
            if ($this->customer->$field != "") {
                $customerFieldNum = 'customerField' . $i;
                $customerField.=" [" . $this->customer->$field . ":" . $this->$customerFieldNum . "]";
            }
        }
        return $customerField;
    }

    function getIsEventPendingToAprove() {
        $ans = false;
        foreach ($this->events as $event) {
            if (!$event->informedToCustomerOn) {
                $ans = true;
                break;
            }
        }
        return $ans;
    }

    function getFarthestEvent() {
        $ans = null;
        foreach ($this->events as $event) {
            if (!$ans || $ans < $event->newLimitDate) {
                $ans = $event->newLimitDate;
            }
        }
        return $ans;
    }

    function getFarthestInformedEvent() {
        $ans = null;
        foreach ($this->events as $event) {
            if ($event->informedToCustomerOn) {
                if (!$ans || $ans < $event->newLimitDate) {
                    $ans = $event->newLimitDate;
                }
            }
        }
        return $ans;
    }

    function getIsProcessing() {
        return ($this->backgroundCheckStatusId == BackgroundCheckStatus::PROCESSING ||
                $this->backgroundCheckStatusId == BackgroundCheckStatus::REQUESTED );
    }

    function getIsPendingToApprove() {
        return (!$this->isApproved && $this->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED);
    }

    function getIsPendingToPublish() {
        return ($this->isApproved && !$this->reportAvailable);
    }

    function getIsPendingOverdue() {
        return ($this->isOverdue && $this->isProcessing);
    }

    function getIsPendingOnTimeWithEvent() {
        return (!$this->isOverdue && $this->numberOfEvents > 0 && $this->isProcessing);
    }

    function getIsPendingOnTimeWithoutEvent() {
        return (!$this->isOverdue && $this->numberOfEvents == 0 && $this->isProcessing);
    }

    function getEventsText() {
        $ans = '';
        $rows = 0;
        foreach ($this->events as $event) {
            $rows++;
            $ans.=$rows . '. ' . '[' . $event->created . ']:' . ($event->eventType ? $event->eventType->name . ":" : "") .
                    str_replace(
                            array("\n", "\r", '"', "'"), array(" ", " ", ".", "."), $event->detail) .
                    '  Nueva Fecha [' . $event->newLimitDate . ']   ';
        }
        return $ans;
    }

    // Creada Por jonathan Campo de Tipo de retraso

    function getEventsTextNews() {
        $ans = '';
        $rows = 0;
        foreach ($this->events as $event) {
            $rows++;
            $ans.=$rows . '. ' . ($event->eventTypeNews ? $event->eventTypeNews->name . ". " : "");
           //     str_replace(
            //        array("\n", "\r", '"', "'"), array(" ", " ", ".", "."), $event->eventTypeNewsId);
        }
        return $ans;
    }

    //

    public function checkValidResult($attribute, $params) {
        $ans = true;
        if (    ( $this->resultId == Result::NO_FAVORABLE ||
                    $this->resultId == Result::TO_BE_REVIEWED ||
                    $this->resultId == Result::DESFAVORABLE ||
                    $this->resultId == Result::NOT_FINISHED ||
                    $this->resultId == Result::NOT_FINISHED_FAVORABLE
            )
                 &&
                !$this->hasFindings) {
            $this->addError('resultId', 'Si el resultado es negativo debe tener algún tipo de hallazgo');
            $this->addError('findingLaboralHistory', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingSocioeconomic', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingVisit', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingReturn', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingStudy', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingPolygraph', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingOther', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingBackground', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingTestPsychote', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingODT', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingfinantAnalys', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingAudit', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingrestricList', 'El resultado implica algún tipo de hallazgo');
            $this->addError('findingDoc', 'El resultado implica algún tipo de hallazgo');

            $ans = false;
        }
        return $ans;
    }

    public function getHasFindings() {
        return ($this->findingLaboralHistory || $this->findingSocioeconomic || $this->findingVisit || $this->findingReturn || $this->findingStudy || $this->findingPolygraph || $this->findingOther || $this->findingBackground || $this->findingTestPsychote || $this->findingODT || $this->findingfinantAnalys || $this->findingAudit || $this->findingrestricList || $this->findingDoc );
    }

    public function checkCustomerField($attribute, $params) {
        $ans = true;
        if ($this->customer) {
            $customerField = strtolower(substr($attribute, -6));
            if ($this->customer->$customerField != '' && $this->$attribute == '') {
                $this->addError($attribute, $this->customer->$customerField . ': no tiene valor');
                $ans = false;
            }
        }
        return $ans;
    }

    public function checkCustomerFields() {
        $ans = $this->checkCustomerField('customerField1', null) &&
                $this->checkCustomerField('customerField2', null) &&
                $this->checkCustomerField('customerField3', null) &&
                $this->checkCustomerField('customerField4', null) &&
                $this->checkCustomerField('customerField5', null) &&
                $this->checkCustomerField('customerField6', null)
        ;
        return ($ans);
    }

    public function getAllHtmlSections() {
        $ans = '';
        foreach ($this->verificationSections as $verificationSection) {
            $htmlSection = $verificationSection->htmlSection;
            if ($htmlSection) {
                $ans.=$htmlSection->getHtmlReport();
            }
        }
        return $ans;
    }

    public function getHtmlSection($verificationSectionTypeId) {
        $ans = '';
        /* @var $verificationSection VerificationSection */
        foreach ($this->verificationSections as $verificationSection) {
            /* @var $htmlSection HtmlSection */
            $htmlSection = $verificationSection->htmlSection;
            if ($htmlSection && $verificationSectionTypeId == $verificationSection->verificationSectionTypeId) {
                $ans.=$htmlSection->getHtmlReport();
            }
        }
        return $ans;
    }

    public function getHtmlSignatures() {
        $responsibleName = '';
        $responsibleSignature = '';
        $approvedBy = '';
        $approvalSignature = '';

        $responsible = $this->responsible;
        $responsibleName = $responsible ? $responsible->user->name : 'PENDIENTE DE ASIGNACION';


        if ($responsible && $responsible->user->signature) {
            $imageFile = $responsible->user->signature->getImageFileSized(460, 120, 'jpg');
            $this->_pendindToDelete[] = $imageFile;
            $responsibleSignature = '<img alt="firma" src="' . $imageFile . '" />';
        }


        if (!($this->responsible && $this->approved &&
                $this->responsible->user->id == $this->approved->id)) {

            if ($this->approved && $this->approved->signature) {
                $imageFile = $this->approved->signature->getImageFileSized(460, 120);
                $this->_pendindToDelete[] = $imageFile;
                $approvalSignature = '<img alt="" src="' . $imageFile . '" " />';
            }
            $approvedBy = $this->approved ? $this->approved->name : 'PENDIENTE DE APROBACIÓN';
        }
        if ($this->responsible && $this->approved &&
                $this->responsible->user->id == $this->approved->id) {
            $ans = '
<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width: 25%;">&nbsp;</td>
			<td style="text-align: center; width: 50%;">' . $approvalSignature . '</td>
			<td style="width: 25%;">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align: center;">
			___________________________<br/>
			' . $approvedBy . '
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>';
        } else {

            $ans = '
<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width: 5%;">&nbsp;</td>
			<td style="text-align: center; width: 35%;">' . $responsibleSignature . '</td>
			<td style="width: 5%;">&nbsp;</td>
			<td style="text-align: center; width: 35%;">' . $approvalSignature . '</td>
			<td style="width: 5%;">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align: center;">
			___________________________<br/>
			' . $responsibleName . '
			</td>
			<td>&nbsp;</td>
			<td style="text-align: center;">
			___________________________<br/>
			' . $approvedBy . '
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>';
        }

        return $ans;
    }

    public function getHtmlApproveSignature() {
        $responsibleName = '';
        $responsibleSignature = '';
        $approvedBy = '';
        $approvalSignature = '';

        $responsible = $this->responsible;
        $responsibleName = $responsible ? $responsible->user->name : 'PENDIENTE DE ASIGNACION';


        if ($this->responsible && $this->approved) {

            if ($this->approved && $this->approved->signature) {
                $imageFile = $this->approved->signature->getImageFileSized(460, 120);
                $this->_pendindToDelete[] = $imageFile;
                $approvalSignature = '<img alt="" src="' . $imageFile . '" style="height:60px; width:230px" />';
            }
            $approvedBy = $this->approved ? $this->approved->name : 'PENDIENTE DE APROBACIÓN';
        }
        $ans = '
<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
	<tbody>
		<tr>
			<td style="width: 25%;">&nbsp;</td>
			<td style="text-align: center; width: 50%;">' . $approvalSignature . '</td>
			<td style="width: 25%;">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align: center;">
			___________________________<br/>
			' . $approvedBy . '
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>';
        return $ans;
    }

    public function deletePendingToDelete() {
        foreach ($this->_pendindToDelete as $filename) {
            if (file_exists($filename)) {
                unlink($filename);
            }
        }
        $this->_pendindToDelete = array();
    }

    public function getApprovedOnLongFormat() {
        $ans = '';
        if ($this->approvedOn) {
            $ans = Holiday::dateToStringSp($this->approvedOn);
        }
        return $ans;
    }

    public function getHtmlAllEvents($type = null) {
        $ans = '<table border="0" cellpadding="3" cellspacing="3" style="width:710px"><tbody>';
        foreach ($this->events as $event) {
            if ($type == null || ($type == $event->eventTypeId))
                $ans.='<tr><td style="text-align: left; vertical-align: middle; width: 140px;">'
                        . CHtml::encode($event->informedToCustomerOn)
                        . '</td>'
                        . '<td style="text-align: justify; vertical-align: middle; width: 510px;">'
                        . CHtml::encode($event->detail)
                        . '</td></tr>';
        }
        $ans.='</tbody></table>';
        return $ans;
    }

    public function getHtmlAllDelayEvents() {
        return $this->getHtmlAllEvents(EventType::DELAY);
    }

    public function getSectionAnswer($verificationSectionTypeId, $varName) {
        $ans = '';
        /* @var $verficationSection VerificationSection */
        $verificationSection = $this->getVerificationSection($verificationSectionTypeId);
        if ($verificationSection != null && $verificationSection->htmlSection) {
            if ($varName == 'Resultado') {
                $ans = $verificationSection->htmlSection->verificationResult->name;
            } else if ($varName == 'Comentario') {
                $ans = $verificationSection->comments;
            } else {
                $ans = $verificationSection->htmlSection->getAnswer($varName);
            }
        }
        return $ans;
    }

    public function getVerificationSectionByType($verificationSectionTypeId) {
        $ans = null;
        foreach ($this->verificationSections as $verificationSecion) {
            if ($verificationSecion->verificationSectionTypeId == $verificationSectionTypeId) {
                $ans = $verificationSecion;
                break;
            }
        }
        return $ans;
    }

    public function getUserRole($userId, $verificationSectionId) {
        $ans = null;
        foreach ($this->assignedUsers as $assignedUser) {
            if ($assignedUser->userId == $userId && ($assignedUser->verificationSectionId == NULL || $assignedUser->verificationSectionId == $verificationSectionId)) {
                $ans = $assignedUser->userRole;
            }
        }
        return $ans;
    }

    public function getCanBeApproved() {
        return (
                ($this->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED ||
                $this->backgroundCheckStatusId == BackgroundCheckStatus::PARTIAL_CANCELLED) && $this->resultId != Result::PENDING && ($this->total == 100 || $this->backgroundCheckStatusId == BackgroundCheckStatus::PARTIAL_CANCELLED) && !$this->isApproved);
    }

    public function getCanBePublished() {
        return ($this->isApproved && !$this->reportAvailable);
    }

    public function getCanPublishCertificate() {
        return (!$this->certificateAvailable &&
                $this->reportAvailable &&
                $this->backgroundCheckStatusId == BackgroundCheckStatus::FINISHED);
    }

    /*
    public function getfindingdropPolyy() {
        $ans = '';
        if ('findingdropPoly'==1){
            $ans='No APlica';
        }
        elseif ('findingdropPoly'==2)
        {
            $ans='Admisiones';
        }
        else{
            $ans='Reaccion';
        }
        return $ans;
    }
*/


    public function getSectionsSummary() {
        $ans = '';
        $first = true;
        foreach ($this->verificationSections as $verificationSection) {
            if (!$first) {
                $ans.="  ";
            }
            $first = false;
            $ans.=$verificationSection->sectionName
                    . '(' . $verificationSection->percentCompleted . '%):'
                    . '[' . ($verificationSection->result ? $verificationSection->result->nick : "") . ']';
        }
        return $ans;
    }

    public function finishAssignedUsers() {
        foreach ($this->assignedUsers as $assignedUser) {
            if (empty($assignedUser->finishedAt)) {
                $assignedUser->finishedAt = new CDbExpression('NOW()');
                $assignedUser->save();
            }
        }
    }

    public function assignDefaultUser() {
        $defaultUser = null;
        if ($this->customer->userId) {
            $defaultUser = $this->customer->userId;
        } else if (method_exists(Yii::app()->user, 'getIsAdmin') && !Yii::app()->user->isAdmin) {
            $defaultUser = Yii::app()->user->id;
        }
        if ($defaultUser) {
            $assignedUser = new AssignedUser;
            $assignedUser->backgroundCheckId = $this->id;
            $assignedUser->userId = $defaultUser;
            $assignedUser->userRoleId = UserRole::ASSIGNED;
            if (!$assignedUser->save()) {
                WebUser::logAccess("Error asignando el estudio", $this->code);
            } else {
                $this->assignedOn = new CDbExpression('NOW()');
                $this->save();
            }
        }
    }

    public function getResponsibleMail() {
        $ans = array();
        /* @var $responsible User  */
        $resposible = $this->getResponsible();
        if ($resposible) {
            $ans = array(array('mail' => $resposible->user->username, 'name' => $resposible->user->name));
        }

        return $ans;
    }

    public function getExpirationOn() {
        $ans = NULL;
        if ($this->approvedOn &&
                $this->customerProduct->expirationInterval &&
                isset(CustomerProduct::$IntervalTypes[$this->customerProduct->expirationInterval])) {
            $approved = new DateTime($this->approvedOn, timezone_open('America/Bogota'));
            $approved->add(new DateInterval($this->customerProduct->expirationInterval));
            $ans = $approved->format('Y-m-d');
        }
        return $ans;
    }

    public function getExpirationOnLongFormat() {
        $ans = '';
        if ($this->expirationOn) {
            $ans = Holiday::dateToStringSp($this->expirationOn);
        }
        return $ans;
    }

    public function getIsPriceDifferent() {
        return ($this->getPriceDifference() != 0);
    }

    public function getPriceDifference() {
        return ($this->price - $this->customerProduct->price);
    }

    public function getTotalPrice() {
        return ($this->price + $this->additionalPrice);
    }

    public function assignInvoice($overwrite = false) {
        if ($this->deliveredToCustomerOn && (!$this->invoice || $overwrite)) {
            $this->invoiceId = Invoice::getOpenInvoice($this);
        }
    }

    //Natalia Henao Mayorga
    //28/10/2022
    public function assignInvoiceVisit($overwrite = false) {
        if ((!$this->invoiceVisit || $overwrite)) {
            $this->invoiceVisitId = InvoiceVisit::getOpenInvoiceVisit($this);
            $this->update();
        }
    }

    public function getMaxInternalDays() {
        $customerProduct = CustomerProduct::model()->findByPK($this->customerProductId);
        $internalDays = 0;
        if(isset($customerProduct->maxInternalDays)){
            $internalDays = $customerProduct->maxInternalDays - 1;
        } else {
            $internalDays = $customerProduct->maxDays - 1;
        }

        $internalLimit = Holiday::addWorkingDaysDash($this->studyStartedOn, $internalDays);
        return $internalLimit;
    }

    public function daysPublicBackgroundcheck($model){
        $how = new DateTime(date('Y-m-d'));
        $dateApprovedOn = new DateTime($model->approvedOn);
        if (is_null($dateApprovedOn)){
            $dateApprovedOn=  new DateTime(date('Y-m-d'));
        }
        $diff = $how->diff($dateApprovedOn);
        return $diff->days;
    }

    //Update a campo creado en backgroundcheck para almacenar la cantidad de paginas del reporte PDF sin los documentos anexos
    //Natalia H-Jonathan
    //19/08/2021
    public function getPagesPDF($pages){
        $data = "UPDATE ses_BackgroundCheck SET pagesPDF=$pages WHERE code='".$this->code."';";
        $query = Yii::app()->db->createCommand($data)->execute();
    }

    //proceso para ver datos del fieldset de calidad en los export
    //Natalia Henao M. 27/10/2021
    public function getQuality() {
        $ans = "";
        if ($this->qualityLaboral)
            $ans.= "Lab.";
        if ($this->qualitytextLaboral)
            $ans.="->".$this->qualitytextLaboral." [PQR:".$this->qualityLaboralPQR.",PNC:".$this->qualityLaboralPNC."]."; 
        if ($this->qualityEducation)
            $ans.= "Académico.";
        if ($this->qualitytextEducation)
            $ans.="->".$this->qualitytextEducation." [PQR:".$this->qualityEducationPQR.",PNC:".$this->qualityEducationPNC."]."; 
        if ($this->qualityFinanlcial)
            $ans.= "Financiero.";
        if ($this->qualitytextFinancial)
            $ans.="->".$this->qualitytextFinancial." [PQR:".$this->qualityFinanlcialPQR.",PNC:".$this->qualityFinanlcialPNC."]."; 
        if ($this->qualityAdverse)
            $ans.= "Adversos.";
        if ($this->qualitytextAdverse)
            $ans.="->".$this->qualitytextAdverse." [PQR:".$this->qualityAdversePQR.",PNC:".$this->qualityAdversePNC."]."; 
        if ($this->qualityVisit)
            $ans.= "Visita.";
        if ($this->qualitytextVisit)
            $ans.="->".$this->qualitytextVisit." [PQR:".$this->qualityVisitPQR.",PNC:".$this->qualityVisitPNC."]."; 
        if ($this->qualityPolygraph)
            $ans.= "Polígrafo.";
        if ($this->qualitytextPolygraph)
            $ans.="->".$this->qualitytextPolygraph." [PQR:".$this->qualityPolygraphPQR.",PNC:".$this->qualityPolygraphPNC."]."; 
        if ($this->qualityTest)
            $ans.= "Pruebas.";
        if ($this->qualitytextTest)
            $ans.="->".$this->qualitytextTest." [PQR:".$this->qualityTestPQR.",PNC:".$this->qualityTestPNC."]."; 
        if ($this->qualityGesDocument)
            $ans.= "Gestion Documental.";
        if ($this->qualityTextGesDocument)
            $ans.="->".$this->qualityTextGesDocument." [PQR:".$this->qualityGesDocumentPQR.",PNC:".$this->qualityGesDocumentPNC."]."; 

        if ($this->qualityShareholder)
            $ans.= "Socios y Representantes Legales.";
        if ($this->qualitytextShareholder)
            $ans.="->".$this->qualitytextShareholder." [PQR:".$this->qualityShareholderPQR.",PNC:".$this->qualityShareholderPNC."]."; 

        if ($this->qualityCustomer)
            $ans.= "Clientes.";
        if ($this->qualitytextCustomer)
            $ans.="->".$this->qualitytextCustomer." [PQR:".$this->qualityCustomerPQR.",PNC:".$this->qualityCustomerPNC."]."; 

        if ($this->qualityProvider)
            $ans.= "Proveedores.";
        if ($this->qualitytextProvider)
            $ans.="->".$this->qualitytextProvider." [PQR:".$this->qualityProviderPQR.",PNC:".$this->qualityProviderPNC."]."; 

        if ($this->qualityFinance)
            $ans.= "Central de Riesgo.";
        if ($this->qualitytextFinance)
            $ans.="->".$this->qualitytextFinance." [PQR:".$this->qualityFinancePQR.",PNC:".$this->qualityFinancePNC."]."; 
        
        if ($this->qualityFinantialAnalys)
            $ans.= "Análisis Financiero.";
        if ($this->qualitytextFinantialAnalys)
            $ans.="->".$this->qualitytextFinantialAnalys." [PQR:".$this->qualityFinantialAnalysPQR.",PNC:".$this->qualityFinantialAnalysPNC."].";
        
        if ($this->qualityCompanyVisit)
            $ans.= "Visita a Empresa.";
        if ($this->qualitytextCompanyVisit)
            $ans.="->".$this->qualitytextCompanyVisit." [PQR:".$this->qualityCompanyVisitPQR.",PNC:".$this->qualityCompanyVisitPNC."].";

        if ($this->qualityReference)
            $ans.= "Referencias.";
        if ($this->qualitytextReference)
            $ans.="->".$this->qualitytextReference." [PQR:".$this->qualityReferencePQR.",PNC:".$this->qualityReferencePNC."].";

        if ($this->qualityReturn)
            $ans.="Devuelve->".$this->qualityReturn.".";
        if ($this->qualityReturnPer)
            $ans.="A qué área Devuelve->".$this->qualityReturnPer.".";
        
        return $ans;
    }

    //Natalia Henao M. 27/10/2021
    public function getHasQuality() {
        return ($this->qualityLaboral || $this->qualityEducation || $this->qualityFinanlcial || $this->qualityAdverse || $this->qualityVisit || $this->qualityPolygraph || $this->qualityTest);
    }

    public function getMailsParamContact() {
        $ans=array(array("mail" => $this->email, "name" => $this->firstName));
        return $ans;
    }

    public function getDetailContacts() {

        /*$query_A = 'SELECT ct.statusContact, ct.contactType, ct.created  
        FROM ses_Contact ct WHERE ct.backgroundCheckId='.$this->id.' 
        ORDER BY ct.created ASC';
        $detailCont = Yii::app()->db->createCommand($query_A)->queryAll();*/

        $detailCont=$this->contacts;
        
        $ans = "<table>";

        foreach ($detailCont as $contact) {

            $contacttype = ContactType::model()->findByPK($contact['contactType']);
            /* @var $assignedUser AssignedUser */

            if($contact['statusContact']=="1. Request Received"){
                $statuscontac="1. Solicitud recibida";
            }else if($contact['statusContact']=="-3. Invalid Mobile Number"){
                $statuscontac="-3. Número celular inválido";
            }else{
                $statuscontac=$contact['statusContact'];
            }

            $ans.='<tr>
                <td>' . $statuscontac . '</td>
                <td>' . $contacttype->Type. '</td>
                <td>' . $contact['created'] . '</td>
            </tr>';
        }
        $ans.='</table>';
        return $ans;
    }

    //03-02-2022 Consumo servicio de formulario Dinamico tamto para ejecutar servicio desde Formulario dinamico como desde boton en sintecto
    //Natalia Henao M
    public function recordDynamicForm($dateresponse, $validSections, $dynamicForm, $val){
        foreach($dateresponse['sections'] as $section=>$sectiondata){
            if(!in_array($section, $validSections)){
                break;
            }
            if($section=='basicInformation'){
                $this->updateFromJson($sectiondata);
            }else if($section=='documents'){
                if(!empty($dateresponse['sections']['documents'])){ //['files1'][0]
                    //var_dump($dateresponse['sections']['documents'] );
                    foreach($dateresponse['sections']['documents'] as $data){ 
                        if(!empty($data)){
                            foreach($data as $documents){
                                if(!empty($documents)){
                                    if(isset($documents['firstfile'])){
                                        if(empty($documents['firstfile'])) { 
                                            continue;
                                        }
                                        $idDoc=$documents['firstfile'];
                                    }else{
                                        $idDoc=$documents;
                                    }
                                    if($val==1){
                                        $dateresponse=$dynamicForm->dynamicgetFile($this->ooidFD, $idDoc);
                                    }else{
                                        $dateresponse=$dynamicForm->dynamicgetFile($this->reciptFileooid, $idDoc); 
                                    }
            
                                    if(empty($dateresponse)){
                                        break;
                                    }
                                    $idbackground=$this->id;
                                    $document= new Document();
                                    $document->updateFromJson($dateresponse, $idbackground);
                                }
                            }

                        }   
                    }
                }
            }else{
                foreach ($this->verificationSections as $verificationSection) {
                    if($verificationSection->verificationSectionType->name==$section && $verificationSection->percentCompleted<100){
                        $className=$verificationSection->verificationSectionType->class;
                        $detailClass = new $className();
                        $detailClass->updateFromJson($verificationSection, $sectiondata);
                        break;
                    }
                }
            }
        }
    }

    //03-02-2022 Almacenar datos basicos de Formulario dinamico en backgroundCheck
    //Natalia Henao M
    public function updateFromJson($sectiondata){
        if(isset($sectiondata['applicant']['firstname'])){
            $this->firstName=CHtml::encode($sectiondata['applicant']['firstname']);
        }
        if(isset($sectiondata['applicant']['lastname'])){
            $this->lastName=CHtml::encode($sectiondata['applicant']['lastname']);
        }
        if(isset($sectiondata['applicant']['maritalStatus'])){
            $this->relationshipStatusId=CHtml::encode($sectiondata['applicant']['maritalStatus']);
        }
        if(isset($sectiondata['applicant']['idType'])){
            if($sectiondata['applicant']['idType']=="CC"){
                $typeDoc="";
            }else{
                $typeDoc=CHtml::encode($sectiondata['applicant']['idType']);
            }
        }else{
            $typeDoc=""; 
        }
        /*if(isset($sectiondata['applicant']['idNumber'])){
            $this->idNumber=$typeDoc.CHtml::encode($sectiondata['applicant']['idNumber']);
        }*/
        if(isset($sectiondata['applicant']['idIssuedPlace'])){
            $this->idFrom=CHtml::encode($sectiondata['applicant']['idIssuedPlace']);
        }
        if(isset($sectiondata['applicant']['idIssuedOn'])){
            $this->datexpedition=CHtml::encode($sectiondata['applicant']['idIssuedOn']);
        }
        if(isset($sectiondata['applicant']['datebirth'])){
            $this->birthday=CHtml::encode($sectiondata['applicant']['datebirth']);
        }
        if(isset($sectiondata['applicant']['placebirth'])){
            $this->birthPlace=CHtml::encode($sectiondata['applicant']['placebirth']);
        }
        if(isset($sectiondata['applicant']['adress'])){
            $this->address=CHtml::encode($sectiondata['applicant']['adress']);
        }
        if(isset($sectiondata['applicant']['neighborhood'])){
            $this->area=CHtml::encode($sectiondata['applicant']['neighborhood']);
        }

        //campos para empresa
        if(isset($sectiondata['applicant']['codVerification'])){
            $this->codVerification=CHtml::encode($sectiondata['applicant']['codVerification']);
        }
        if(isset($sectiondata['applicant']['state'])){
            $this->state=CHtml::encode($sectiondata['applicant']['state']);
        }
        if(isset($sectiondata['applicant']['city'])){
            $this->city=CHtml::encode($sectiondata['applicant']['city']);
        }
        if(isset($sectiondata['applicant']['companyTel'])){
            $this->tels=CHtml::encode($sectiondata['applicant']['companyTel']);
        }
        if(isset($sectiondata['applicant']['contactPerson'])){
            $this->contactPerson=CHtml::encode($sectiondata['applicant']['contactPerson']);
        }
        if(isset($sectiondata['applicant']['webPage'])){
            $this->webPage=CHtml::encode($sectiondata['applicant']['webPage']);
        }
        if(isset($sectiondata['applicant']['ciiu'])){
            $this->ciiu=CHtml::encode($sectiondata['applicant']['ciiu']);
        }
        if(isset($sectiondata['applicant']['descriptionCiiu'])){
            $this->descriptionCiiu=CHtml::encode($sectiondata['applicant']['descriptionCiiu']);
        }
        if(isset($sectiondata['applicant']['supplierType'])){
            $this->supplierClassification=CHtml::encode($sectiondata['applicant']['supplierType']);
        }
        if(isset($sectiondata['applicant']['companyType'])){
            $this->shareholderType=CHtml::encode($sectiondata['applicant']['companyType']);
        }
        if(isset($sectiondata['applicant']['yearsOfActivity'])){
            $this->yearsOfActivity=CHtml::encode($sectiondata['applicant']['yearsOfActivity']);
        }

        $this->save();
    }


    //15-02-2022 Respuesta al servicio consumido por el Formulario Dinamico (getAnswer)
    //Natalia Henao M
    public function answerDynamicForm($ooid, $prt, $val){

        Yii::import('application.extensions.DynamicForm.*');

        $validSections=['basicInformation','Laboral','Referencias','Académico','documents', 'Socios y Representantes Legales','Clientes','Proveedores'];

        if($this->backgroundCheckStatusId!=BackgroundCheckStatus::REQUESTED && $this->backgroundCheckStatusId!=BackgroundCheckStatus::PROCESSING){
            return "Error, El estado del estudio es diferente a solicitado y en proceso.";
        }else{
            $dynamicForm = new DynamicForm();

            if($prt==1 || $prt==2){
                $dateresponse=$dynamicForm->partialDynamicAnswer($ooid);
            }else{
                $dateresponse=$dynamicForm->dynamicAnswer($ooid);
            }

            if(!empty($dateresponse['error']) || empty($dateresponse['sections']) || !is_array($dateresponse['sections'])){
                if($prt==1){
                    $dateresponse=$dynamicForm->deleteDynamicForm($ooid);
                    $this->statusFD=0;
                    $this->ooidFD='';
                    $this->update();
                    return "Error, El Formulario Dinámico no contiene información o su registro ya no existe, si desea puede realizar el envío de un nuevo formulario.";
                }elseif($prt==2){
                    $dateresponse=$dynamicForm->deleteDynamicForm($ooid);
                    $this->reciptFileStatus=0;
                    $this->reciptFileooid='';
                    $this->update();
                    return "Error, El Formulario Dinámico no contiene información o su registro ya no existe, si desea puede realizar el envío de un nuevo formulario.";
                }else{
                    return "Error, El Formulario Dinámico no contiene información o su registro ya no existe.";
                }
            }else{

                if($val==1){
                    $this->statusFD=1;
                    $this->recordDynamicForm($dateresponse, $validSections, $dynamicForm, $val);
                }else{
                    $this->reciptFileStatus=1;
                    $this->recordDynamicForm($dateresponse, $validSections, $dynamicForm, $val);
                }
         
				$this->update();

                $dateresponse=$dynamicForm->deleteDynamicForm($ooid);
                if(!empty($dateresponse)){
                    return "Se recibió la información ingresada por el candidato y se eliminó el formulario dinámico.";
                    //return "Elimino el formulario dinamico.";
                }else{
                    return "No pudo eliminar el formulario dinámico.";
                }
            }
        }
    }
    
    //10-02-2022 Validar ooid en backgroundcheck para el servicio getAnswer consumido por el formulario Dinamico
    //Natalia Henao M
    public static function getBackgroundCheckByooidFD($ooid){
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.statusFD='0' AND t.ooidFD='$ooid' AND t.validuntilFD>=DATE(NOW())"); //HOUR
        $dynamicForm = BackgroundCheck::model()->find($criteria);
        return  $dynamicForm; //BackgroundCheck::model()->findByAttributes(['ooidFD'=>$ooid]);
    }

    //18-05-2023 Validar reciptFileooid en backgroundcheck para el servicio getAnswer consumido por el formulario Dinamico
    //Natalia Henao M
    public static function getBackgroundCheckByooidFD2($ooid){
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.reciptFileStatus='0' AND t.reciptFileooid='$ooid' AND t.reciptExpiration>=DATE(NOW())"); //HOUR
        $dynamicForm = BackgroundCheck::model()->find($criteria);
        return  $dynamicForm; //BackgroundCheck::model()->findByAttributes(['ooidFD'=>$ooid]);
    }

    //24-03-2022 Recibir el log desde el servicio de consumo al dar clic sobre enviar el fomulario dinamico 
    //Natalia Henao M
    public function logDynamicFormAut($ooid, $val){

        Yii::import('application.extensions.DynamicForm.*');

            if($val==1){
                $backgroundCheck = BackgroundCheck::model()->findByAttributes(['ooidFD'=>$ooid]);
            }else{
                $backgroundCheck = BackgroundCheck::model()->findByAttributes(['reciptFileooid'=>$ooid]);
            }
            
            $dynamicForm = new DynamicForm();
            $dateresponse=$dynamicForm->dynamicgetlog($ooid);
            
            if(empty($dateresponse)){ 
                if($val==1){
                    $this->statusFD=2;
                }else{
                    $this->reciptFileStatus=2;
                }
				$this->update();
                //echo "entro aqui....";
                //return "Error, 'El Formulario Dinámico no existe en verificacion.co.";
            }else if(!empty($dateresponse)){
                Contact::insertToLogDynamicF($dateresponse, $backgroundCheck->id);
                //WebUser::logAccess("Al enviar el formulario dinámico, Actualizo el log.", $backgroundCheck->code);
            }
    }

    static public function getPendingworkplan($untilDate = null) {

        $criteria = new CDbCriteria;
        $criteria->with = array(
            'assignedUsers',
            'assignedUsers.user',
            'customer',
            'customer.customerGroup',
            'customerProduct'
        );

        $criteria->together = true;
        $criteria->addCondition('(approvedOn is Null or approvedOn="0000-00-00 00:00:00" or  deliveredToCustomerOn is null  or deliveredToCustomerOn ="0000-00-00 00:00:00") and ' .
                'customerGroup.id<>:svpId and backgroundCheckStatusId not in (:cancel,:partialCancel)');

        $criteria->params = array(
            ':cancel' => BackgroundCheckStatus::CANCELLED,
            ':partialCancel' => BackgroundCheckStatus::PARTIAL_CANCELLED,
            ':svpId' => CustomerGroup::SAV_ID,
        );

        if ($untilDate) {
            $criteria->addCondition('date_format(studyLimitOn,"%Y/%m/%d")<=:untilDate');
            $criteria->params[':untilDate'] = $untilDate;
        }

        $criteria->order = 'assignedUsers.userId ASC';

        $reports = BackgroundCheck::model()->findAll($criteria);

        return $reports;
    }
    
    static public function getRequestsSAC() {
        $criteria = new CDbCriteria();
        $reportRequests = RequestsSAC::model()->findAll($criteria);
        return $reportRequests;
    }

    public static function getStudyAssing($codes) {
        $backgroundChecks = [];
        $selectedStudiesCodesArray = explode(",", $codes);
        foreach ($selectedStudiesCodesArray as $code) {
            $backgroundCheck = BackgroundCheck::findByCode($code);
            if ($backgroundCheck) {
                $backgroundChecks[] = $backgroundCheck;
            }
        }

        $assignedSection = [];
            foreach ($backgroundChecks as $backgroundCheck) {
            
                $criteria = new CDbCriteria;
                $criteria->addCondition('verificationSections.backgroundCheckId=:bgcId');
                $criteria->with=['verificationSections'];
                $criteria->params=[':bgcId'=>$backgroundCheck->id];
                $seccions= VerificationSectionType::model()->findAll($criteria);
            
                foreach ($seccions as $sectiontypeId) {
                    //print_r($sectiontypeId);
                    $assignedSection[]=[
                        'id'=>$sectiontypeId->id,
                        'name'=>$sectiontypeId->name,
                    ];
                }
            }
        //print_r($assignedSection);

        return $assignedSection;
    }

    public static function getExportAssingSection(){

        $query_A='SELECT cus.name AS cliente, cusp.name AS tipo, bgc.code, CONCAT(bgc.firstName," ",bgc.lastName) AS Nombre, bgc.idNumber, CONCAT(us.firstName," ",us.lastName) AS asignado, us.username, usr.name AS rol, vstg.name AS grupo_seccion, vst.name AS seccion, ass.assignedAt, ass.limitAt, ass.finishedAt, bgc.studyStartedOn, bgc.studyLimitOn
        FROM ses_BackgroundCheck bgc JOIN ses_AssignedUser ass ON bgc.id=ass.backgroundCheckId
        LEFT JOIN ses_VerificationSection vs ON vs.id=ass.verificationSectionId 
        LEFT JOIN ses_VerificationSectionType vst ON vs.verificationSectionTypeId=vst.id
        LEFT JOIN ses_verificationsectiongroup vstg ON vstg.id=vst.verificationSectionGroupId
        JOIN ses_User us ON ass.userId=us.id
        JOIN ses_UserRole usr ON usr.id=ass.userRoleId
        JOIN ses_Customer cus ON cus.id=bgc.customerId
        JOIN ses_CustomerProduct cusp ON cusp.id=bgc.customerProductId
        WHERE bgc.resultId="1"
        ORDER BY bgc.id DESC';
        $resultAssingSection = Yii::app()->db->createCommand($query_A)->queryAll();       
        return $resultAssingSection;
	}

    public static function getExportNotAssingSection(){

        $query_A='SELECT cus.name AS cliente, cusp.name AS tipo, bgc.code, CONCAT(bgc.firstName," ",bgc.lastName) AS Nombre, bgc.idNumber, vstg.name AS grupo_seccion, vst.name AS seccion, ass.userId AS asignado, ass.assignedAt, ass.limitAt, bgc.studyStartedOn, bgc.studyLimitOn
        FROM ses_BackgroundCheck bgc 
        JOIN ses_VerificationSection vs ON bgc.id=vs.backgroundCheckId
        LEFT JOIN ses_AssignedUser ass ON vs.id=ass.verificationSectionId
        LEFT JOIN ses_VerificationSectionType vst ON vs.verificationSectionTypeId=vst.id
        LEFT JOIN ses_verificationsectiongroup vstg ON vstg.id=vst.verificationSectionGroupId
        JOIN ses_Customer cus ON cus.id=bgc.customerId
        JOIN ses_CustomerProduct cusp ON cusp.id=bgc.customerProductId
        WHERE bgc.resultId="1" AND ass.verificationSectionId IS NULL
        ORDER BY bgc.id DESC';
        $resultNotAssingSection = Yii::app()->db->createCommand($query_A)->queryAll();       
        return $resultNotAssingSection;
	}

    public static function getCancelledStudyChannel($code) {

        $backgroundCheck =  BackgroundCheck::model()->findByAttributes(['code'=>$code]);

        $backgroundCheck->backgroundCheckStatusId=BackgroundCheckStatus::CANCELLED;
        $backgroundCheck->resultId=Result::NO_RESULT;
        $backgroundCheck->price=0;
        $backgroundCheck->update();
      
        //WebUser::logAccess("El cliente cancelo el estudio de: " . $backgroundCheck->fullName . " [" . $backgroundCheck->idNumber . "]", $backgroundCheck->code);

        //Eliminar registro de estudio en la tabla TusDatosResponse, si el estudio es cancelado (desde el cliente).
        //Natalia Henao--07/01/2022
        $tusDatos = new TusDatosResponse();
        $tusDatos->deleteRegTD($backgroundCheck->id);

        return $backgroundCheck;
    }

    public static function createBackgroundCheck($attributes, $isCompanySurvey = FALSE){

        if ($isCompanySurvey) {
            $model = new BackgroundCheck('createCompany');
        } else {
            $model = new BackgroundCheck('createPerson');
        }

        if (isset($attributes)) {
            $model->attributes = $attributes;
            $model->cost = @$model->customerProduct->cost;
            if(@$model->customer->isRecover==0){
                $model->price = @$model->customerProduct->price;
            }else{
                $model->price = 0;
            }
            if ($model->isCompanySurvey) {
                $model->firstName = BackgroundCheck::DEFAULT_COMPANY_FIRSTNAME;
            }

            if ($model->save()) {
                foreach ($model->customerProduct->verificationsInProduct as $verificationInProduct) {
                    $verificationSection = new VerificationSection;
                    $verificationSection->backgroundCheckId = $model->id;
                    $verificationSection->verificationSectionTypeId = $verificationInProduct->verificationSectionTypeId;
                    $verificationSection->showOrder = $verificationInProduct->showOrder;
                    if ($verificationSection->save()) {
                        $verificationSection->createBasicRecords();
                    }
                }
            
                $model->dateLimitQuality =  $model->studyLimitOn;
                $model->assignDefaultUser();

                $seccionAdv = VerificationSection::model()->findByAttributes(['verificationSectionTypeId'=>'4', 
                                                                              'backgroundCheckId'=>$model->id]);
                if($seccionAdv && $model->customer->isRecover==0 && $model->customer->businessLine=="Integridad"){
                    $model->createTusDatosRegister();
                }     
            }
        } 
        return $model;
    }

    public function createTusDatosRegister(){

        $models = TusDatosResponse::model()->findByAttributes(['backgroundcheckId'=>$this->id]);

        if(empty($models)){
            $modelTusDatos = new TusDatosResponse();
            $modelTusDatos->backgroundcheckId = $this->id;
            $modelTusDatos->idNumber = $this->idNumber;
            $modelTusDatos->dateexp = $this->datexpedition;
            $modelTusDatos->idReport = $this->idNumber;
            $modelTusDatos->created = new CDbExpression('NOW()');
            $modelTusDatos->status = TusDatosResponse::STATUS_PENDING;
            $modelTusDatos->save(false);
        }
    }

    public function getSectionDateFinis() {
        $sectionFinish = Yii::app()->db->createCommand()
                ->select(
                        'MAX(ass.finishedAt) AS maxTerminado' .
                        '')
                ->from('{{BackgroundCheck}} as bck')
                ->join('{{AssignedUser}} as ass', 'ass.backgroundCheckId=bck.id')
                ->Join('{{CustomerProduct}} as cp', 'bck.customerProductId=cp.id')
                ->Join('{{Customer}} as cus', 'cus.id=bck.customerId')
                ->where('bck.id=:backgroundCheckId', array(':backgroundCheckId' => $this->id))
                ->andWhere('bck.backgroundCheckStatusId=4')
                ->andWhere('ass.finishedAt IS NOT NULL')
                ->andWhere('ass.userRoleId!=1')
                ->group('bck.code, cus.name, bck.approvedOn, cp.maxDays, cp.name')
                ->queryAll();

        $dateFinishSection = array();
        foreach ($sectionFinish as $sectionDateFinsh) {
            $dateFinishSection[] = ($sectionDateFinsh['maxTerminado']);
        }

        $ans = "";

        foreach ($sectionFinish as $sectionDate) {
            $ans.=$sectionDate['maxTerminado'];
        }
        return $ans;
    }

    public function getTimeDelivered() {
        $sectionFinish = Yii::app()->db->createCommand()
                ->select(
                        'bck.code AS ref, ' .
                        'DATE_FORMAT(MAX(ass.finishedAt), "%y-%m-%d" ) AS maxTerminado, ' .
                        'DATE_FORMAT(MAX(ass.finishedAt), "%H:%i:%s" ) AS horTerminado, ' .
                        'DATE_FORMAT(bck.deliveredToCustomerOn, "%y-%m-%d") AS Publicado, ' .
                        'DATE_FORMAT(bck.deliveredToCustomerOn, "%H:%i:%s") AS horPublicado, ' .
                        'DATE_FORMAT(bck.approvedOn , "%y-%m-%d") AS Aprobado, ' .
                        'DATE_FORMAT(bck.approvedOn, "%H:%i:%s") AS horAprobado, ' .
                        'cp.maxDays' .
                        '')
                ->from('{{BackgroundCheck}} as bck')
                ->join('{{AssignedUser}} as ass', 'ass.backgroundCheckId=bck.id')
                ->Join('{{CustomerProduct}} as cp', 'bck.customerProductId=cp.id')
                ->Join('{{Customer}} as cus', 'cus.id=bck.customerId')
                ->where('bck.id=:backgroundCheckId', array(':backgroundCheckId' => $this->id))
                ->andWhere('bck.backgroundCheckStatusId=4')
                ->andWhere('ass.finishedAt IS NOT NULL')
                ->andWhere('ass.userRoleId!=1')
                ->group('bck.code, cus.name, bck.approvedOn, cp.maxDays, cp.name')
                ->queryAll();

        $daysStudy=$this->getDaysStudy();

        $ans = "";

        $dateFinishSection = array();
        foreach ($sectionFinish as $sectionDateFinsh) {

            if($sectionDateFinsh['maxDays']==null || $sectionDateFinsh['maxDays']=="" || $sectionDateFinsh['maxDays']==0){
                $diasClient=0;
            }else{
                $diasClient=$sectionDateFinsh['maxDays'];
            }

            if($sectionDateFinsh['Aprobado']==$sectionDateFinsh['Publicado'] && $sectionDateFinsh['horPublicado']<='18:00:00' && $daysStudy<=$diasClient){
                $ans.="A Tiempo";
            }else if(($sectionDateFinsh['horTerminado']<='17:30:00' && $sectionDateFinsh['horPublicado']>'18:00:00' && $daysStudy<=$diasClient && $sectionDateFinsh['maxTerminado']==$sectionDateFinsh['Publicado']) || ($sectionDateFinsh['maxTerminado']<$sectionDateFinsh['Publicado'] && $daysStudy<=$diasClient)){
                $ans.="Fuera de Tiempo por Publicación";
            }else if($sectionDateFinsh['horTerminado']>'17:30:00' && $sectionDateFinsh['maxTerminado']==$sectionDateFinsh['Publicado'] ||  $daysStudy>$diasClient){
                $ans.="Cerrado Fuera de Tiempo por OPS";
            }
        }
        return $ans;
    }

    public function getExportCustomerPilot($from, $until) {
        
        $query_A='SELECT bck.code AS ref, bck.idNumber, CONCAT(bck.firstName," ",bck.lastName) AS candidato,  cus.name AS cliente, cp.name AS producto, MAX(ass.finishedAt) AS entrega, DATE_FORMAT(MAX(ass.finishedAt), "%y-%m-%d" ) AS maxTerminado, 
        DATE_FORMAT(MAX(ass.finishedAt), "%H:%i:%s" ) AS horTerminado, bck.deliveredToCustomerOn, DATE_FORMAT(bck.deliveredToCustomerOn, "%y-%m-%d" ) AS Publicado, 
        DATE_FORMAT(bck.deliveredToCustomerOn, "%H:%i:%s" ) AS horPublicado, bck.approvedOn, DATE_FORMAT(bck.approvedOn , "%y-%m-%d" ) AS Aprobado, 
        DATE_FORMAT(bck.approvedOn, "%H:%i:%s" ) AS horAprobado, cp.maxDays, cus.isPilot, bck.studyStartedOn
        FROM ses_BackgroundCheck bck 
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bck.id
        JOIN ses_CustomerProduct cp ON bck.customerProductId=cp.id
        JOIN ses_Customer cus ON cus.id=bck.customerId
        WHERE bck.backgroundCheckStatusId="4" AND (bck.deliveredToCustomerOn>="'.$from.'" AND bck.deliveredToCustomerOn<="'.$until.'") AND ass.finishedAt IS NOT NULL AND bck.deliveredToCustomerOn IS NOT NULL
        AND cus.isPilot="1" AND ass.userRoleId!="1"
        GROUP BY bck.code, cus.name, bck.approvedOn, cp.maxDays, cp.name
        ORDER BY deliveredToCustomerOn DESC';
        $customerPilot = Yii::app()->db->createCommand($query_A)->queryAll();
        return $customerPilot;
    }

    public function getPreliminary() {

		$ansStr = "";
		switch($this->customerProduct->preliminary){
			
			case 0:
				$pr ="NO";
				break;
			case 1:
				$pr ="<font color='BD210C'><b>SI</b></font>";
				break;
		}
		$ansStr.= $pr;

		return $ansStr;
    }

    public function getObservation() {
        $CandidateCalls=CandidateCalls::model()->findByAttributes(['backgroundcheckId'=>$this->id]);
        if($CandidateCalls){
            $ansStr=$CandidateCalls->observation;
        }else{
            $ansStr="";
        }
		
		return $ansStr;
    }


    public function getDetailDocuments() {

        $models = Document::model()->findAllByAttributes(['backgroundCheckId'=>$this->id]);
        
        $ans = "<table style='width:150px;'>";

        foreach ($models as $document) {
            $ans.='<tr>
                <td>'. CHtml::link($document->name, array('/document/file', 'id' => $document->id), array('target' => '_blank')).'</td>
            </tr>';
        }
        $ans.='</table>';
        return $ans;
    }

    public function getStartStudy($code){
        
        $model =  BackgroundCheck::model()->findByCode($code);

        $timeZone = new DateTimeZone('America/Bogota');
        $now = new DateTime('now', $timeZone);

        if ($now->format('H') >= 12) {
            $now->add(new DateInterval('P1D'));
        }
        // If is holiday goes to next day.
        while (!Holiday::isWorkingDay($now)) {
            $now->add(new DateInterval('P1D'));
        }
        $model->studyStartedOn = $now->format('Y-m-d H:i:s');
        $model->studyLimitOn = $model->studyStartedOn;

        $customerProduct = CustomerProduct::model()->findByPK($model->customerProductId);
        if ($customerProduct && $model->studyStartedOn != "" && $model->studyStartedOn > "0000-00-00") {
            $maxDays = $customerProduct->maxDays - 1;
            if ($maxDays < 0) {
                $maxDays = 0;
            }
            $model->studyLimitOn = Holiday::addWorkingDays($model->studyStartedOn, $maxDays);
            //TODO $this->initialStudyLimitOn=$this->studyLimitOn;
        }

        $model->dateLimitQuality =  $model->studyLimitOn;

        //$this->dateLimitQuality=$model->dateLimitQuality;
        //$this->studyStartedOn=$model->studyStartedOn;
        //$this->studyLimitOn=$model->studyLimitOn;
        $model->startStudy=1;
        $model->price = @$model->customerProduct->price;
        $model->save();
    
        WebUser::logAccess("Se da Inicio al estudio, cliente con Recaudo.", $model->code);
		return true;
    }

    public function getStatusRecoverFDSP() {

		$ansStr = "";
		switch($this->statusFD){		
            case 0:
                $pr ="<font color='red'><b>Pendiente</b></font>";
				break;
			case 1:
				$pr ="<font color='green'><b>Enviado</b></font>";
				break;
		}
		$ansStr.= $pr;

		return $ansStr;
    }

    public function getStatusRecoverFDDoc() {
        $pr ="";
		$ansStr = "";
		switch($this->reciptFileStatus){		
			case 0:
                $pr ="<font color='red'><b>Pendiente</b></font>";
				break;
            case 1:
                $pr ="<font color='green'><b>Enviado</b></font>";
                break;
		}
		$ansStr.= $pr;

		return $ansStr;
    }

    public function getDetailContactsSP() {

        $criteria = new CDbCriteria;
        $criteria->addCondition("backgroundCheckId=:idbg");
        $criteria->addCondition("statusContact=:value");
        $criteria->params=[':value'=>"Enviado SP", ':idbg'=>$this->id];
        $AllSP= Contact::model()->count($criteria);

        return $AllSP;
    }

    public function getDetailContactsDoc() {

        $criteria = new CDbCriteria;
        $criteria->addCondition("backgroundCheckId=:idbg");
        $criteria->addCondition("statusContact=:value");
        $criteria->params=[':value'=>"Enviado Doc.", ':idbg'=>$this->id];
        $AllDoc= Contact::model()->count($criteria);

        return $AllDoc;
    }

    public function getApiAldeamo(){
        //usuario y clave aldeamo
		$post = [
            "username" => Yii::app()->params['aldeamoApi']['username'],
            "password" => Yii::app()->params['aldeamoApi']['password']
        ];

        return $post;
	}

    public function getSendSMSAssing($userId){
        $us=$this->getApiAldeamo();
		$username=$us['username'];
		$password=$us['password'];

        $user = User::model()->findByPK($userId);

        $UserName=$user->firstName.' '.$user->lastName;
        $nombre=$this->firstName.' '.$this->lastName;     
		$data=[
			"country"=> 57,
			"dateToSend"=> "",
			"message"=> "Sr@. $nombre, le informamos que su visita domiciliaria fue asignada al profesional $UserName, el cual lo estará contactando en las próximas horas, tenga presente que es la única persona autorizada a realizarle la visita, por ende, no permita que otra persona ingrese a su vivienda, si su visita es virtual ninguna otra persona a la ya mencionada está autorizada a contactarlo. gracias.",
			"encoding"=> "",
			"messageFormat"=> 1,
			"addresseeList"=> [
				[
					"mobile"=> $this->mobile,
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
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($client, CURLOPT_POSTFIELDS, $datosJSON);

		$response = curl_exec($client);

		curl_close($client);

		$dateresponse =(array) json_decode($response);
  
		return $dateresponse;
    }

    public function getTypeClient() {
        $tipocliente = 'Antiguo';
    
        $yearDateNow = date('Y');
        $createdCustomerStr =$this->customerProduct->customer->created;
        $createdCustomer = new DateTime($createdCustomerStr);

        $yearCreatedCustomer =  $createdCustomer->format('Y');
        
        if ($yearDateNow == $yearCreatedCustomer){
            $tipocliente = 'Nuevo';
        };
        return $tipocliente;
    }
}
//comment