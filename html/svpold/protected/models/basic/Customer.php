<?php

/**
 * This is the model class for table "{{Customer}}".
 *
 * The followings are the available columns in table '{{Customer}}':
 * @property integer $id
 * @property string $name
 * @property string $comments
 * @property string $logo
 * @property string $field1
 * @property string $field2
 * @property string $field3
 * @property string $field4
 * @property string $field5
 * @property string $field6
 * @property string $field7
 * @property string $field8
 * @property string $field9
 * @property string $created
 * @property string $modified
 * @property int $$notifyByMail If true the customer will be notify when the study is updated
 * @property int $accessToReports The user has access to Reports
 * @property int $accessToTemporalReports The user has access to Temporal Reports
 * @property int $accessToanexos
 * @property int $accessToOfac The user has access to Ofac
 * @property int $customerGroupId
 * @property int $userId
 * @property int $salesmanId Salesman
 * @property int $sacId
 * @property int $inquiriesTD
 * @property string $UsuarioTD
 * @property string $ClaveTD
 * @property string $Idcustomer
 * @property string $customerClassification
 * @property string $increaseDateIPC
 * @property string $businessRelationShip
 * @property string $policies
 * @property string $otherIf
 * @property string $inputChannel
 * @property string $contractStartDate
 * @property string $contractEndDate
 * @property string $incremental
 * @property string $Segment
 * @property boolean $businessLine
 * @property int $sendToCertificate
 * @property int $certificateKey
 * @property int $graphicsNews

 *
 * The followings are the available model relations:
 * @property CustomerProduct[] $customerProducts
 * @property User $user
 * @property CustomerGroup $customerGroup
 * @property boolean $accessToCompanyReports
 * @property boolean $accessToCertificates
 * @property boolean $isActive
 * @property boolean $concept
 * @property boolean $quantitativeEvaluation
 * @property string $address
 * @property string $city
 * @property string $optionsField1
 * @property string $optionsField2
 * @property string $optionsField3
 * @property string $optionsField4
 * @property string $optionsField5
 * @property string $optionsField6
 * @property string $optionsField7
 * @property string $optionsField8
 * @property string $optionsField9
 * @property integer $surveyLinkId
 * @property boolean $preliminary 
 * @property string $dateValidation 
 * @property boolean $isPilot
 * @property boolean $salaryEarnedCust
 * @property boolean $isRecover
 * @property int $manyAdvSources
 * @property int isJepms
 * @property int isPolicia
 * @property int isProcuraduria
 * @property int isContaduria
 * @property int isRnmc
 * @property int isInpec
 * @property int isJuzgadostyba
 * @property int isSimit
 * @property int isLibretamilitar
 * @property int isInhabilidades
 * @property int isListaonu
 * @property int isOfac
 * @property int isInterpol
 * 
 * @property SurveyLink $surveyLinkId
 */
class Customer extends ActiveRecord {

    const MAX_FIELDS=9;
    const SES = 'Security & Vision';

    const GROUP_CENET=941;
    const CUSTOMER_CENET=1075;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Customer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Customer}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, created', 'required'),
            array('name, field1, field2, field3,field4, field5, field6, field7, field8, field9, Idcustomer, address, city', 'length', 'max' => 255),
            array('comments, modified,customerGroupId,address,city,'
                . 'optionsField1,optionsField2,optionsField3,'
                . 'optionsField4,optionsField5,optionsField6,'
                . 'optionsField7,optionsField8,optionsField9,incremental,segment,quantitativeEvaluation, businessLine, '
                . 'userId,salesmanId,sacId,Idcustomer,customerClassification,contractStartDate,contractEndDate, inquiriesTD, UsuarioTD, ClaveTD, accessToanexos, surveyLinkId, increaseDateIPC, businessRelationShip, policies, otherIf, inputChannel, dateValidation', 'safe'),
            array('notifyByMail,accessToReports,accessToOfac,'
                . 'accessToTemporalReports,accessToCompanyReports,isActive,preliminary,'
                . 'accessToCertificates,concept, accessToanexos, sendToCertificate, graphicsNews, isPilot, isRecover, salaryEarnedCust, certificateKey, manyAdvSources, isJepms,isPolicia,isProcuraduria,isContaduria,isRnmc,isInpec,isJuzgadostyba,isSimit,isLibretamilitar,isInhabilidades,isListaonu,isOfac,isInterpol', 'boolean', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, comments, '
                . 'field1, field2, field3,'
                . 'field4, field5, field6,'
                . 'field7, field8, field9,'
                . ' created, modified,'
                . 'notifyByMail,accessToCompanyReports,accessToCertificates,isActive,preliminary,'
                . 'address,city,userId,sacId,salesmanId, inquiriesTD,UsuarioTD, ClaveTD, accessToanexos, sendToCertificate, graphicsNews, surveyLinkId, isPilot, salaryEarnedCust, isRecover, certificateKey, manyAdvSources, isJepms,isPolicia,isProcuraduria,isContaduria,isRnmc,isInpec,isJuzgadostyba,isSimit,isLibretamilitar,isInhabilidades,isListaonu,isOfac,isInterpol', 'safe', 'on' => 'search'),
            array('logo', 'file', 'types'=>'jpg, gif, png', 'safe' => false,'maxSize'=>512000,'allowEmpty'=>true, 'on'=>'update'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customerProducts' => array(self::HAS_MANY, 'CustomerProduct', 'customerId', 'order' => 'customerProducts.name ASC'),

            //Lista Crear un Estudio de Seguridad - Producto de Cliente Activos
            'customerActiveProducts' => array(self::HAS_MANY, 'CustomerProduct', 'customerId','condition' => 'customerActiveProducts.isActive =:active','params' => array(':active' => 1,), 'order' => 'customerActiveProducts.name ASC'),

            'customerUsers' => array(self::HAS_MANY, 'CustomerUser', 'customerId'),
            'customerGroup' => array(self::BELONGS_TO, 'CustomerGroup', 'customerGroupId'),
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'salesman' => array(self::BELONGS_TO, 'User', 'salesmanId'),
            'sac' => array(self::BELONGS_TO, 'User', 'sacId'),
            'surveyLink' => array(self::BELONGS_TO, 'SurveyLink', 'surveyLinkId'),
            'customerProductPersonStudies' => array(
                self::HAS_MANY,
                'CustomerProduct',
                'customerId',
                'condition' => 'customerProductPersonStudies.isCompanySurvey = :companySurvey',
                'params' => array(':companySurvey' => FALSE,),
                'order' => 'customerProductPersonStudies.name ASC'
            ),
            'customerProductCompanyStudies' => array(
                self::HAS_MANY,
                'CustomerProduct',
                'customerId',
                'condition' => 'customerProductCompanyStudies.isCompanySurvey = :companySurvey',
                'params' => array(':companySurvey' => TRUE,),
                'order' => 'customerProductCompanyStudies.name ASC'
            ),);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Cliente',
            'comments' => 'Comentarios',
            'field1' => 'Campo personalizado 1',
            'field2' => 'Campo personalizado 2',
            'field3' => 'Campo personalizado 3',
            'field4' => 'Campo personalizado 4',
            'field5' => 'Campo personalizado 5',
            'field6' => 'Campo personalizado 6',
            'field7' => 'Campo personalizado 7',
            'field8' => 'Campo personalizado 8',
            'field9' => 'Campo personalizado 9',
            'optionsField1' => 'Opciones Campo 1',
            'optionsField2' => 'Opciones Campo 2',
            'optionsField3' => 'Opciones Campo 3',
            'optionsField4' => 'Opciones Campo 4',
            'optionsField5' => 'Opciones Campo 5',
            'optionsField6' => 'Opciones Campo 6',
            'optionsField7' => 'Opciones Campo 7',
            'optionsField8' => 'Opciones Campo 8',
            'optionsField9' => 'Opciones Campo 9',
            'created' => 'Creado',
            'modified' => 'Modificado',
            'notifyByMail' => 'Enviar Correos',
            'sendToCertificate'=> 'Enviar Certificado',
            'certificateKey'=>'Clave Certificado',
            'graphicsNews'=>'Novedades Graficas',
            'accessToReports' => 'Ve Reportes',
            'accessToTemporalReports' => 'Reportes Temporales',
            'accessToOfac' => 'Tiene Accesso a Ofac',
            'customerGroupId' => 'Grupo de Cliente',
            'accessToCompanyReports' => 'Tiene Acceso a Rep. Compañías',
            'accessToCertificates' => 'Tiene Acceso a Certificados',
            'accessToanexos' => 'Tiene Acceso a Rep. sin Anexos',
            'address' => 'Dirección',
            'city' => 'Ciudad',
            'userId' => 'Líder',
            'sacId' => 'SAC',
            'salesmanId' => 'Vendedor',
            'Idcustomer' => 'NIT',
            'customerClassification' => 'Clasificacion de Cliente',
            'increaseDateIPC' => 'Fecha Incremento IPC',
            'businessRelationShip' => 'Relación comercial',
            'policies' => 'Pólizas',
            'otherIf' => 'Otro si',
            'inputChannel' => 'Canal de ingreso',
            'contractStartDate' => 'Inicio de Contrato',
            'contractEndDate' => 'Finalizacion de Contrato',
            'isActive' => 'Activo',
            'preliminary' => 'Reporte PDF Preliminar',
            'concept' => 'Concepto PDF',
            'incremental' => 'Incremental',
            'segment' => 'Segmento',
            'quantitativeEvaluation' => 'Evaluacion Cuantitativa',
            'inquiriesTD' =>'Consultas Cant TD',
            'UsuarioTD'=>'Usuario TD', 
            'ClaveTD' =>'Clave TD',
            'businessLine' => 'Linea de Neg Cliente',
            'surveyLinkId'=>'Encuesta de Satisfacción',
            'dateValidation'=>'Fecha de validación cliente',
            'isPilot'=>'Es Plan Piloto',
            'salaryEarnedCust'=>'Salario Devengado',
            'isRecover'=>'Tiene Recaudo',
            'manyAdvSources'=>'Consulta Varias Fuentes',
            'isJepms'=>'Ramas Jepms',
            'isPolicia'=>'Policia',
            'isProcuraduria'=>'Procuraduria',
            'isContaduria'=>'Contaduria',
            'isRnmc'=>'Rnmc',
            'isInpec'=>'Inpec',
            'isJuzgadostyba'=>'Juzgados Tyba',
            'isSimit'=>'Simit',
            'isLibretamilitar'=>'Libreta militar',
            'isInhabilidades'=>'Inhabilidades',
            'isListaonu'=>'Lista ONU',
            'isOfac'=>'OFAC',
            'isInterpol'=>'Interpol'
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('field1', $this->field1, true);
        $criteria->compare('field2', $this->field2, true);
        $criteria->compare('field3', $this->field3, true);
        $criteria->compare('field4', $this->field4, true);
        $criteria->compare('field5', $this->field5, true);
        $criteria->compare('field6', $this->field6, true);
        $criteria->compare('field7', $this->field7, true);
        $criteria->compare('field8', $this->field8, true);
        $criteria->compare('field9', $this->field9, true);
        $criteria->compare('Idcustomer', $this->Idcustomer, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('customerGroupId', $this->customerGroupId, false);
        $criteria->compare('accessToReports', $this->accessToReports, false);
        $criteria->compare('accessToTemporalReports', $this->accessToTemporalReports, false);
        $criteria->compare('accessToOfac', $this->accessToOfac, false);
        $criteria->compare('notifyByMail', $this->notifyByMail, true);
        $criteria->compare('accessToCompanyReports', $this->accessToCompanyReports, false);
        $criteria->compare('accessToCertificates', $this->accessToCertificates, false);
        $criteria->compare('isActive', $this->isActive, false);
        $criteria->compare('address', $this->address, false);
        $criteria->compare('city', $this->city, false);
        $criteria->compare('userId', $this->userId, false);
        $criteria->compare('salesmanId', $this->salesmanId, false);
        $criteria->compare('sacId', $this->sacId, false);
        $criteria->compare('customerClassification', $this->customerClassification, true);
        $criteria->compare('increaseDateIPC', $this->increaseDateIPC, true);
        $criteria->compare('businessRelationShip', $this->businessRelationShip, true);
        $criteria->compare('policies', $this->policies, true);
        $criteria->compare('otherIf', $this->otherIf, true);
        $criteria->compare('inputChannel', $this->inputChannel, true);
        $criteria->compare('contractStartDate', $this->contractStartDate, true);
        $criteria->compare('contractEndDate', $this->contractEndDate, true);
        $criteria->compare('incremental', $this->incremental, true);
        $criteria->compare('segment', $this->segment, true);
        $criteria->compare('inquiriesTD', $this->inquiriesTD);
        $criteria->compare('UsuarioTD', $this->UsuarioTD);
        $criteria->compare('ClaveTD', $this->ClaveTD);
        $criteria->compare('accessToanexos', $this->accessToanexos, false);
        $criteria->compare('quantitativeEvaluation', $this->quantitativeEvaluation);
        $criteria->compare('businessLine', $this->businessLine);
        $criteria->compare('sendToCertificate', $this->sendToCertificate);
        $criteria->compare('certificateKey', $this->certificateKey);
        $criteria->compare('graphicsNews', $this->graphicsNews);
        $criteria->compare('surveyLinkId', $this->surveyLinkId, true);
        $criteria->compare('preliminary', $this->preliminary);
        $criteria->compare('dateValidation', $this->dateValidation, true);
        $criteria->compare('isPilot', $this->isPilot);
        $criteria->compare('salaryEarnedCust', $this->salaryEarnedCust);
        $criteria->compare('isRecover', $this->isRecover);
        $criteria->compare('manyAdvSources', $this->manyAdvSources);
        $criteria->compare('isJepms', $this->isJepms);
        $criteria->compare('isPolicia', $this->isPolicia);
        $criteria->compare('isProcuraduria', $this->isProcuraduria);
        $criteria->compare('isContaduria', $this->isContaduria);
        $criteria->compare('isRnmc', $this->isRnmc);
        $criteria->compare('isInpec', $this->isInpec);
        $criteria->compare('isJuzgadostyba', $this->isJuzgadostyba);
        $criteria->compare('isSimit', $this->isSimit);
        $criteria->compare('isLibretamilitar', $this->isLibretamilitar);
        $criteria->compare('isInhabilidades', $this->isInhabilidades);
        $criteria->compare('isListaonu', $this->isListaonu);
        $criteria->compare('isOfac', $this->isOfac);
        $criteria->compare('isInterpol', $this->isInterpol);
        
        GridViewFilter::setFilter($this, 'search');


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 20,
            ),
        ));
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            //You can optionally set the field name options here
            )
        );
    }

    public function customersWithUsersAndProducts($companySurveyTypeOnly = false) {
        $customers = Customer::model()->
                //select only the customers with products and users
                with(array(
                    'customerUsers' => array(
                        'select' => false,
                        'joinType' => 'INNER JOIN',
                        'condition' => 'customerUsers.id>0',
                    ),
                    'customerProducts' => array(
                        'select' => false,
                        'joinType' => 'INNER JOIN',
                        'condition' => 'customerProducts.id>0 '
                        . ' and customerProducts.isCompanySurvey=' . ($companySurveyTypeOnly ? 1 : 0)
                        . ' and customerProducts.isActive=1',
                    )
                        )
                )->
                findAll(array(
            'order' => 't.name',));
        return $customers;
    }



    public function getCustomerProductByType($isCompanySurvey) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.customerId', $this->id);
        $criteria->compare('t.isCompanySurvey', ($isCompanySurvey ? 1 : 0));
        $criteria->compare('t.isActive', 1);
        return CustomerProduct::model()->findAll($criteria);
    }

    public function getCustomerProductByTypeintegridad() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.customerId', $this->id);
        $criteria->compare('t.isActive', 1);
        return CustomerProduct::model()->findAll($criteria);
    }

    public function getCustomerActiveProducts() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.customerId', $this->id);
        $criteria->compare('t.isActive', 1);
        return CustomerProduct::model()->findAll($criteria);
    }

    public function hasOptionsInField($id) {
        $ans = false;
        if ($id >= 1 && $id <= Customer::MAX_FIELDS) {
            $field = 'optionsField' . (int) $id;
            $ans = (trim($this->$field) != '');
        }
        return $ans;
    }

    public function optionsInFieldArray($id) {
        $ans = array();
        if ($id >= 1 && $id <= Customer::MAX_FIELDS) {
            $field = 'optionsField' . (int) $id;
            $opt = explode("\r\n", $this->$field);

            foreach ($opt as $val) {
                $val = trim($val);
                if ($val != '') {
                    $ans[$val] = $val;
                }
            }
        }
        return $ans;
    }

    public function getInvoiceClosingDay() {
        return ($this->customerGroup ? $this->customerGroup->invoiceClosingDay : 30);
    }

    public function getPaymentTerms() {
        return ($this->customerGroup ? $this->customerGroup->paymentTerms : '0D');
    }

    public function getInvoiceDay() {
        return ($this->customerGroup ? $this->customerGroup->invoiceDay : '1');
    }

}
