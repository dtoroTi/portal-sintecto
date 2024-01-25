<?php

/**
 * This is the model class for table "{{CustomerProduct}}".
 *
 * The followings are the available columns in table '{{CustomerProduct}}':
 * @property integer $id
 * @property integer $customerId
 * @property string $name
 * @property integer $maxDays
 * @property integer $maxInternalDays
 * @property string $created
 * @property string $modified
 * @property integer $isActive
 * @property float $cost
 * @property float $price
 * @property boolean $generalData this study includes the general data
 * @property boolean $isCompanySurvey This flag is set when the study if for companies
 * @property text $xmlQuestion This is the question in free format
 * @property text $questionFormat This is the question Format
 * @property boolean $notifyByMail
 * @property string $xmlQuestion
 * @property string $questionFormat XML PDF Print format
 * @property string $reportFormat XML PDF Print format for the whole report
 * @property integer $pdfReportTypeId
 * @property integer $pdfCertificateTypeId
 * @property boolean $printSummarySection
 * @property string $expirationInterval
 * @property string $comments
 * @property integer $typeProductId
 * @property integer $attachmentFileId
 * @property integer $viewDynamicForm
 * @property integer $contract_Limit
 * @property integer $preliminary
 * @property integer $costVisitId
 * @property float $priceYearAnt
 * @property float $priceFase1
 * @property float $priceFase2
 * @property float $priceFase3
 * @property string $listFase1
 * @property string $listFase2
 * @property string $listFase3
 * @property string $dateFase1
 * @property string $dateFase2
 * @property string $dateFase3
 * 
 * @property integer $hourExpress
 * @property integer $isStandard
 * @property string $incremental
 * @property integer $attachmentFileId2
 * 
 * @property integer $isTusDatos
 * @property integer $isWC
 * @property integer $isSico
 * @property integer $isRamaUnif
 * @property integer $isMediosAbrt
 * @property integer $isJurad
 * 
 * The followings are the available model relations:
 * @property BackgroundCheck[] $backgroundChecks
 * @property Customer $customer
 * @property VerificationInProduct[] $verificationInProducts
 * @property PdfReportType $pdfReportType
 * @property PdfReportType $pdfCertificateType
 * @property Items $typeProduct
 * @property AttachmentFile $attachmentFileId
 * @property InvoiceVisitCost $costVisitId
 * @property AttachmentFile $attachmentFileId2
 */
class CustomerProduct extends CActiveRecord {

    const NAME = 'EMPRESA';
    const FINISH_WORKING_HOUR=18;
    const START_WORKING_HOUR=7;

    private $_verificationSectionTypes = null;
    static private $_allSections = null;
    static private $_types = array(
        'A' => array(
            524284,
            16
        ),
        'AVR' => array(
            6146,
            508
        ),
        'AVRF' => array(
            518140,
            1020
        ),
        '*P' => array(
            517120,
            1024
        ),
        'EMPRESA SV' => array(
            524268,
            385536
        ),
        'EMPRESA CV' => array(
            524268,
            516608
        ),
        'OTROS' => array(
            0,
            0
        ),
    );
    static public $SummaryTypes = array(
        0 => 'Sin Resumen',
        1 => 'Resultado de secciones y análisis',
        2 => 'Resultado de secciones',
    );
    static public $IntervalTypes = array(
        null => '---',
        'P3M' => '3 Meses',
        'P6M' => '6 Meses',
        'P1Y' => '1 año',
        'P2Y' => '2 años',
        'P3Y' => '3 años',
    );

    static public $optionListsFases = array (
        'Incremento IPC (9,28%)' => 'Incremento IPC (9,28%)',
        'Incremento SMLV (12%)' => 'Incremento SMLV (12%)',
        'Incremento 50% IPC' => 'Incremento 50% IPC',
        'Incremento 3,5% IPC' => 'Incremento 3,5% IPC',
        'Incremento 15%' => 'Incremento 15%',
        'Ajuste EBITDA' => 'Ajuste EBITDA',
        'Sin incremento' => 'Sin incremento',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CustomerProduct the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{CustomerProduct}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customerId, name, created, typeProductId', 'required'),
            array('customerId, maxDays, maxInternalDays, isActive,printSummarySection,typeProductId,contract_Limit,viewDynamicForm, preliminary, isStandard, isTusDatos, isWC, isSico, isRamaUnif, isMediosAbrt, isJurad', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('expirationInterval, cost, price, priceYearAnt, priceFase1, priceFase2, priceFase3', 'length', 'max' => 45),
            array('modified,cost,price,xmlQuestion,description,facturacion,glossary,pdfReportTypeId,pdfCertificateTypeId,typeProductId,contract_Limit,comments,attachmentFileId, preliminary, costVisitId, priceYearAnt, priceFase1, priceFase2, priceFase3, listFase1, listFase2, listFase3, dateFase1, dateFase2, dateFase3, isStandard, incremental, attachmentFileId2, isTusDatos, isWC, isSico, isRamaUnif, isMediosAbrt, isJurad, description2', 'safe'),
            array('generalData,isCompanySurvey,notifyByMail', 'boolean'),
            array('xmlQuestion,questionFormat,reportFormat', 'validateXML'),
            
            array('hourExpress','numerical', 'allowEmpty'=>true, 'integerOnly' => true, 'min'=>0,'max'=>480,'tooSmall'=>'Debe ser mayor o igual a 0','tooBig'=>'Supera los minutos maximos permitidos para el proceso Expres.'),
            array('hourExpress', 'length', 'max' => 3),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, customerId, name, maxDays, maxInternalDays, created, modified, isActive, '
                . 'description,facturacion,glossary,pdfReportTypeId,pdfCertificateTypeId,typeProductId,contract_Limit,viewDynamicForm, '
                . 'expirationInterval,comments,attachmentFileId, preliminary, costVisitId, listFase1, listFase2, listFase3, dateFase1, dateFase2, dateFase3, hourExpress, isStandard, incremental, attachmentFileId2, isTusDatos, isWC, isSico, isRamaUnif, isMediosAbrt, isJurad, description2', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'backgroundChecks' => array(self::HAS_MANY, 'BackgroundCheck', 'customerProductId'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customerId'),
            'pdfReportType' => array(self::BELONGS_TO, 'PdfReportType', 'pdfReportTypeId'),
            'pdfCertificateType' => array(self::BELONGS_TO, 'PdfReportType', 'pdfCertificateTypeId'),
            'typeProduct' => array(self::BELONGS_TO, 'Items', 'typeProductId'),
            'verificationsInProduct' => array(self::HAS_MANY, 'VerificationInProduct', 'customerProductId', 'order' => 'showOrder asc'),
            'attachmentFile' => array(self::BELONGS_TO, 'AttachmentFile', 'attachmentFileId'),
            'invoiceVisitCost' => array(self::BELONGS_TO, 'InvoiceVisitCost', 'costVisitId'),
            'attachmentFile2' => array(self::BELONGS_TO, 'AttachmentFile', 'attachmentFileId2'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'customerId' => 'Cliente',
            'name' => 'Nombre de Producto',
            'maxDays' => 'Límite de días',
            'maxInternalDays' => 'Límite de días interno',
            'created' => 'Creado',
            'modified' => 'Modificado',
            'isActive' => 'Activo',
            'cost' => 'Costo Estudio',
            'price' => 'Valor al cliente',
            'generalData' => 'Incluye inf. General',
            'isCompanySurvey' => 'Estudio de Empresa',
            'xmlQuestion' => 'Preguntas libres',
            'questionFormat' => 'Formato Preguntas',
            'notifyByMail' => 'Notificar por email',
            'reportFormat' => 'Formato Reporte',
            'availableInOffline' => 'Disponible offline',
            'viewDynamicForm'=>'Vista Formulario Dinámico',
            'description' => 'Instrucciones',
            'facturacion' => 'Instrucciones Facturacion',
            'glossary' => 'Glosario',
            'pdfReportTypeId' => 'Tipo de Reporte PDF',
            'pdfCertificateTypeId' => 'Tipo de Certificado PDF',
            'printSummarySection' => 'Sección de Resumen',
            'expirationInterval' => 'Periodo de Expiración',
            'comments' => 'Comentarios',
            'typeProductId' => 'Linea de Negocio',
            'typeProduct.value' => 'Linea de Negocio',
            'attachmentFileId' => 'Archivo Asociado',
            'attachmentFileId2' => 'Archivo Asociado dos',
            'contract_Limit' => 'Limite de Contrato',
            'preliminary' =>'Es preliminar',
            'costVisitId' =>'Tipo costo visita',
            'priceYearAnt'=> 'Valor al cliente año anterior',
            'priceFase1' => 'Precio Fase 1',
            'priceFase2' => 'Precio Fase 2',
            'priceFase3' => 'Precio Fase 3',
            'listFase1' => 'Lista Fase 1',
            'listFase2' => 'Lista Fase 2',
            'listFase3' => 'Lista Fase 3',
            'dateFase1' => 'Fecha Fase 1',
            'dateFase2' => 'Fecha Fase 2',
            'dateFase3' => 'Fecha Fase 3',
            'hourExpress'=>'Limite Expres en Minutos',
            'isStandard'=>'Es estandar',
            'incremental' => 'Incremental Product',
            'isTusDatos'=> 'Tus Datos',
            'isWC'=> 'WC',
            'isSico'=> 'Sico',
            'isRamaUnif'=> 'Rama Unificada',
            'isMediosAbrt'=> 'Medios Abiertos',
            'isJurad'=> 'Jurad',
            'description2'=>'Instrucciones 2'
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
        $criteria->compare('customerId', $this->customerId);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('maxDays', $this->maxDays);
        $criteria->compare('maxInternalDays', $this->maxInternalDays);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('isActive', 1);
        $criteria->compare('generalData', $this->generalData);
        $criteria->compare('pdfReportTypeId', $this->pdfReportTypeId);
        $criteria->compare('comments', $this->comments);
        $criteria->compare('typeProductId', $this->typeProductId);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('attachmentFileId', $this->attachmentFileId, true);
        $criteria->compare('viewDynamicForm', $this->viewDynamicForm, true);
        $criteria->compare('contract_Limit', $this->contract_Limit);
        $criteria->compare('preliminary', $this->preliminary, true);
        $criteria->compare('costVisitId', $this->costVisitId, true);
        $criteria->compare('priceYearAnt', $this->priceYearAnt, true);
        $criteria->compare('priceFase1', $this->priceFase1, true);
        $criteria->compare('priceFase2', $this->priceFase2, true);
        $criteria->compare('priceFase3', $this->priceFase3, true);
        $criteria->compare('listFase1', $this->listFase1, true);
        $criteria->compare('listFase2', $this->listFase2, true);
        $criteria->compare('listFase3', $this->listFase3, true);
        $criteria->compare('dateFase1', $this->dateFase1, true);
        $criteria->compare('dateFase2', $this->dateFase2, true);
        $criteria->compare('dateFase3', $this->dateFase3, true);

        $criteria->compare('hourExpress', $this->hourExpress, true);
        $criteria->compare('isStandard', $this->isStandard, true);
        $criteria->compare('incremental', $this->incremental, true);
        $criteria->compare('attachmentFileId2', $this->attachmentFileId2, true);

        $criteria->compare('isTusDatos', $this->isTusDatos, true);
        $criteria->compare('isWC', $this->isWC, true);
        $criteria->compare('isSico', $this->isSico, true);
        $criteria->compare('isRamaUnif', $this->isRamaUnif, true);
        $criteria->compare('isMediosAbrt', $this->isMediosAbrt, true);
        $criteria->compare('isJurad', $this->isJurad, true);

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
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

    public function getTotalWeight() {
        $total = 0;
        foreach ($this->verificationsInProduct as $verification) {
            $total+=$verification->weight;
        }
        return ($total );
    }

    public function getSectionsName() {
        $sections = array();
        foreach ($this->verificationsInProduct as $verification) {
            $sections[] = "{$verification->verificationSectionType->name}({$verification->weight})";
        }
        return (implode(', ', $sections));
    }

    public function getPendingStudies() {
        $ans = array('onTime' => 0, 'overdue' => 0);

        $criteria = new CDbCriteria;

        $criteria->addCondition('resultId=:resultId');
        $criteria->addCondition('customerProductId=:customerProductId');
        $criteria->params = array(':resultId' => Result::PENDING,
            ':customerProductId' => $this->id);

        $studies = BackgroundCheck::model()->findAll($criteria);

        foreach ($studies as $study) {
            if ($study->isOverdue) {
                $ans['overdue']+=1;
            } else {
                $ans['onTime']+=1;
            }
        }

        return $ans;
    }

    public function getCompanySurvey() {
        return $this->isCompanySurvey;
    }

    public function hasXmlQuestion() {
        return !empty($this->xmlQuestion);
    }

    public function validateXml($attribute, $params) {
        libxml_use_internal_errors(true);
        $ans = false;
        $xml = simplexml_load_string($this->$attribute);
        if ($xml === false) {
            foreach (libxml_get_errors() as $error) {
                $this->addError($attribute, $error->message);
            }
        } else {
            $ans = true;
        }
        libxml_use_internal_errors(false);
        return $ans;
    }

    public function getQuestionFormatXml() {
        return simplexml_load_string($this->questionFormat);
    }

    public function getReportFormatXml() {
        return simplexml_load_string($this->reportFormat);
    }

    public function getShortName() {
        if (strlen($this->name) > 30) {
            $ans = substr($this->name, 0, 15) . '.....' . substr($this->name, -15);
        } else {
            $ans = $this->name;
        }
        return $ans;
    }

    function getAllSections() {
        if (!CustomerProduct::$_allSections) {
            CustomerProduct::$_allSections = array();
            $sections = VerificationSectionType::model()->findAll();
            foreach ($sections as $section) {
                CustomerProduct::$_allSections[$section->id] = pow(2, $section->id);
            }
        }
        return CustomerProduct::$_allSections;
    }

    function getVerificationSectionTypes() {
        if (!$this->_verificationSectionTypes) {
            $this->_verificationSectionTypes = 0;
            foreach ($this->verificationsInProduct as $verificationInProduct) {
                $this->_verificationSectionTypes+= CustomerProduct::$_allSections[$verificationInProduct->verificationSectionTypeId];
            }
        }
        return $this->_verificationSectionTypes;
    }

    function getComponents() {
        $ans = '';
        if ($this->verificationSectionTypes & $this->allSections[VerificationSectionType::REGISTER]) {
            $ans.= 'A';
        }
        if ($this->verificationSectionTypes & $this->allSections[VerificationSectionType::HOUSING]) {
            $ans.= 'V';
        }
        if ($this->verificationSectionTypes & $this->allSections[VerificationSectionType::REFERENCES]) {
            $ans.= 'R';
        }
        if ($this->verificationSectionTypes & $this->allSections[VerificationSectionType::FINANCIAL]) {
            $ans.= 'F';
        }
        if ($this->verificationSectionTypes & $this->allSections[VerificationSectionType::POLYGRAPH]) {
            $ans.= 'P';
        }
        if ($this->verificationSectionTypes & $this->allSections[VerificationSectionType::DETAIL_COMPANY_PROVIDER]) {
            $ans.= 'E';
        }
        return $ans;
    }

    function getIsPdfReportType() {
        return ($this->pdfReportTypeId > 0);
    }

    public static function createproductmiplanilla($idproduct, $idCustomer){

        $dateProduct = CustomerProduct::model()->findByPk(['id'=>$idproduct]);
        $models = CustomerProduct::model()->findByAttributes(['name'=>$dateProduct->name, 'customerId'=>$idCustomer]);
        if ($models) {
                $models->customerId = $idCustomer;
                $models->typeProductId = $dateProduct->typeProductId;
                $models->attachmentFileId=$dateProduct->attachmentFileId;
                $models->costVisitId=$dateProduct->costVisitId;
                $models->name = $dateProduct->name;
                $models->maxDays= $dateProduct->maxDays;
                $models->maxInternalDays= $dateProduct->maxInternalDays;
                $models->contract_Limit= $dateProduct->contract_Limit;
                $models->pdfReportTypeId= $dateProduct->pdfReportTypeId;
                $models->pdfCertificateTypeId= $dateProduct->pdfCertificateTypeId;
                $models->generalData= $dateProduct->generalData;
                $models->printSummarySection= $dateProduct->printSummarySection;
                $models->notifyByMail= $dateProduct->notifyByMail;
                $models->isActive= $dateProduct->isActive;
                $models->viewDynamicForm= $dateProduct->viewDynamicForm;
                $models->preliminary= $dateProduct->preliminary;
                $models->cost = $dateProduct->cost;
                $models->price =$dateProduct->price;
                $models->expirationInterval= $dateProduct->expirationInterval;
                $models->priceFase1 = $dateProduct->priceFase1;
                $models->listFase1 =$dateProduct->listFase1;
                $models->dateFase1= $dateProduct->dateFase1;
                $models->priceFase2 = $dateProduct->priceFase2;
                $models->listFase2 =$dateProduct->listFase2;
                $models->dateFase2= $dateProduct->dateFase2;
                $models->priceFase3 = $dateProduct->priceFase3;
                $models->listFase3 =$dateProduct->listFase3;
                $models->dateFase3= $dateProduct->dateFase3;
                $models->isStandard= $dateProduct->isStandard;
                $models->modified = new CDbExpression('NOW()');
                if ($models->update()) {
                    $verificationProduct = VerificationInProduct::model()->findAllByAttributes(['customerProductId'=>$idproduct]);
                    $verificationProdmodels = VerificationInProduct::model()->findAllByAttributes(['customerProductId'=>$models->id]);
                    foreach($verificationProduct as $verificationProd){
                        if($verificationProdmodels){
                            foreach($verificationProdmodels as $Prod){
                                $Prod->delete();   
                            }
                        }
                            $Prod = new VerificationInProduct();

                            $Prod->customerProductId=$models->id;
                            $Prod->verificationSectionTypeId=$verificationProd->verificationSectionTypeId;
                            $Prod->weight=$verificationProd->weight;
                            $Prod->showOrder=$verificationProd->showOrder;
                            $Prod->price=$verificationProd->price;
                            $Prod->cost=$verificationProd->cost;
                            $Prod->comments=$verificationProd->comments;
                            if ($Prod->save()) {
                            }
                    }     
                }
            return $models;
        }else{
            $modelCustomerProd = new CustomerProduct();

            $modelCustomerProd->customerId = $idCustomer;
            $modelCustomerProd->typeProductId = $dateProduct->typeProductId;
            $modelCustomerProd->attachmentFileId=$dateProduct->attachmentFileId;
            $modelCustomerProd->costVisitId=$dateProduct->costVisitId;
            $modelCustomerProd->name = $dateProduct->name;
            $modelCustomerProd->maxDays= $dateProduct->maxDays;
            $modelCustomerProd->maxInternalDays= $dateProduct->maxInternalDays;
            $modelCustomerProd->contract_Limit= $dateProduct->contract_Limit;
            $modelCustomerProd->pdfReportTypeId= $dateProduct->pdfReportTypeId;
            $modelCustomerProd->pdfCertificateTypeId= $dateProduct->pdfCertificateTypeId;
            $modelCustomerProd->generalData= $dateProduct->generalData;
            $modelCustomerProd->printSummarySection= $dateProduct->printSummarySection;
            $modelCustomerProd->notifyByMail= $dateProduct->notifyByMail;
            $modelCustomerProd->isActive= $dateProduct->isActive;
            $modelCustomerProd->viewDynamicForm= $dateProduct->viewDynamicForm;
            $modelCustomerProd->preliminary= $dateProduct->preliminary;
            $modelCustomerProd->cost = $dateProduct->cost;
            $modelCustomerProd->price =$dateProduct->price;
            $modelCustomerProd->expirationInterval= $dateProduct->expirationInterval;
            $modelCustomerProd->priceFase1 = $dateProduct->priceFase1;
            $modelCustomerProd->listFase1 =$dateProduct->listFase1;
            $modelCustomerProd->dateFase1= $dateProduct->dateFase1;
            $modelCustomerProd->priceFase2 = $dateProduct->priceFase2;
            $modelCustomerProd->listFase2 =$dateProduct->listFase2;
            $modelCustomerProd->dateFase2= $dateProduct->dateFase2;
            $modelCustomerProd->priceFase3 = $dateProduct->priceFase3;
            $modelCustomerProd->listFase3 =$dateProduct->listFase3;
            $modelCustomerProd->dateFase3= $dateProduct->dateFase3;
            $modelCustomerProd->isStandard= $dateProduct->isStandard;
            $modelCustomerProd->created = new CDbExpression('NOW()');
            if ($modelCustomerProd->save()) {
                $verificationProduct = VerificationInProduct::model()->findAllByAttributes(['customerProductId'=>$idproduct]);
                    foreach($verificationProduct as $verificationProd){
                        $Prod = new VerificationInProduct();

                        $Prod->customerProductId=$modelCustomerProd->id;
                        $Prod->verificationSectionTypeId=$verificationProd->verificationSectionTypeId;
                        $Prod->weight=$verificationProd->weight;
                        $Prod->showOrder=$verificationProd->showOrder;
                        $Prod->price=$verificationProd->price;
                        $Prod->cost=$verificationProd->cost;
                        $Prod->comments=$verificationProd->comments;

                        if ($Prod->save()) {
                        } 
                    } 
            }
            return $modelCustomerProd;
        }
    }

        

}
