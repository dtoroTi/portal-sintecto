<?php
/**
 * This is the model class for table "{{DetailCompany}}".
 *
 * The followings are the available columns in table '{{DetailCompany}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $companyName
 * @property string $contactName
 * @property string $tel
 * @property string $services
 * @property string $comments
 * 
 * @property integer $presentsDebts
 * @property integer $supplierQualification
 * @property integer $suppliersDatabase
 * @property integer $periodicEvaluation
 * 
 * @property integer $deliveryCompliance
 * @property integer $productsQuality
 * @property integer $customerService
 * @property integer $prices
 * @property integer $postSalesService
 * @property integer $relationAge
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailCompany extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailCompany}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId, relationAge', 'numerical', 'integerOnly' => true),
            // array('companyName, contactName, tel, services', 'length', 'max' => 255),
            array('companyName, contactName, tel, services, presentsDebts, supplierQualification, '.
                'suppliersDatabase, periodicEvaluation, deliveryCompliance, productsQuality, '.
                'customerService, prices, postSalesService,relationAge,', 'length', 'max' => 255),
            array('comments', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            //array('id, verificationSectionId, verificationResultId, companyName, contactName, tel, services', 'safe', 'on' => 'search'),
            array('id, verificationSectionId, verificationResultId, companyName, contactName, tel,'.
                'services, presentsDebts, supplierQualification, suppliersDatabase, periodicEvaluation, '.
                'deliveryCompliance, productsQuality, customerService, prices, postSalesService, '.
                'relationAge,', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Verification Section',
            'verificationResultId' => 'Verification Result',
            'companyName' => 'Empresa',
            'contactName' => 'Contacto',
            'tel' => 'Tel',
            'services' => 'Servicios y/o Productos',
            'comments' => 'Comentarios',

            'presentsDebts' => 'Presenta deudas vencidas',
            'supplierQualification' => 'Calificación del proveedor como cliente',
            'suppliersDatabase' => 'Base de datos de Proveedores',
            'periodicEvaluation' => 'Evaluación periódica de sus proveedores',
            
            'deliveryCompliance' => 'Cumplimiento en la entrega de los productos, bienes o servicios',
            'productsQuality' => 'Calidad de los bienes, productoS y/o Servicios',
            'customerService' => 'Servicio al cliente',
            'prices' => 'Precio de los productos, bienes o servicios frente a la competencia',
            'postSalesService' => 'Rápidez para atender quejas y reclamos',
            'relationAge' => 'Antigüedad como proveedor(años)',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('companyName', $this->companyName, true);
        $criteria->compare('contactName', $this->contactName, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('services', $this->services, true);
        $criteria->compare('comments', $this->comments, true);

        $criteria->compare('presentsDebts', $this->presentsDebts, true);
        $criteria->compare('supplierQualification', $this->supplierQualification, true);
        $criteria->compare('suppliersDatabase', $this->suppliersDatabase, true);
        $criteria->compare('periodicEvaluation', $this->periodicEvaluation, true);
        $criteria->compare('deliveryCompliance', $this->deliveryCompliance, true);
        $criteria->compare('productsQuality', $this->productsQuality, true);
        $criteria->compare('customerService', $this->customerService, true);
        $criteria->compare('prices', $this->prices, true);
        $criteria->compare('postSalesService', $this->postSalesService, true);
        $criteria->compare('relationAge', $this->relationAge, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailCompany the static model class
     */
    
    /*
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }*/

    public function getHasEnoughData() {
        return ($this->companyName != "");
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }

    public function getName() {
        return ($this->companyName);
    }

    public static function createBasicRecords($verificationSectionId) {

    }

    public function updateFromJson($verificationSection, $sectiondata){

        if(empty($sectiondata)){ //isset($dateresponse2['sections']) && is_array($dateresponse2['sections'])
          Yii::app()->user->setFlash('backgroundCheck', 'La empresa asociada a este estudio no ha diligenciado ningún dato.');
        }else{
            var_dump($verificationSection);
            var_dump($sectiondata);
            if ($verificationSection->verificationSectionType->name == "Clientes"){
                foreach($sectiondata['ClientsEv'] as $sectionclientEV=>$data){
                    $clientsEv = new DetailCompany();
      
                    if(sizeof($data) != 0){
                      $clientsEv->verificationSectionId=$verificationSection->id;
                      $clientsEv->verificationResultId=1;
                    }
                    if(isset($data['companyName'])){
                      $clientsEv->companyName=CHtml::encode($data['companyName']);
                    }
                    if(isset($data['contactName'])){
                      $clientsEv->contactName=CHtml::encode($data['contactName']);
                    }
                    if(isset($data['tel'])){
                      $clientsEv->tel=CHtml::encode($data['tel']);
                    }
                $clientsEv->save();
                }      
            }
          
            if ($verificationSection->verificationSectionType->name == "Proveedores"){
                foreach($sectiondata['ProveedoresEv'] as $sectionProvidersEV=>$data){
                    $providersEv = new DetailCompany();
        
                    if(sizeof($data) != 0){
                      $providersEv->verificationSectionId=$verificationSection->id;
                      $providersEv->verificationResultId=1;
                    }
                    if(isset($data['companyNamePr'])){
                      $providersEv->companyName=CHtml::encode($data['companyNamePr']);
                    }
                    if(isset($data['contactNamePr'])){
                      $providersEv->contactName=CHtml::encode($data['contactNamePr']);
                    }
                    if(isset($data['telPr'])){
                      $providersEv->tel=CHtml::encode($data['telPr']);
                    }
                $providersEv->save();
                }
            }
        }
    }

}
