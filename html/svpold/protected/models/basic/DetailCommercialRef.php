<?php

/**
 * This is the model class for table "{{DetailCommercialRef}}".
 *
 * The followings are the available columns in table '{{DetailCommercialRef}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId 
 * @property integer $companyName
 * @property integer $taxIdClient
 * @property integer $yearConnection
 * @property integer $lineCreditGranted
 * @property integer $paymentTerms
 * @property integer $paymentMethod
 * @property integer $dateLastPurchase
 * @property integer $lastPurchaseAmount
 * @property integer $averageMonthlyPurchase
 * @property integer $pastPortfolio
 * @property integer $averageDaysPastDue
 * @property integer $productServiceProvide
 * @property integer $concept
 * @property integer $socialName
 * @property integer $taxIdCompany
 * @property integer $contactedPhone
 * @property integer $contactedPerson
 * @property integer $email
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailCommercialRef extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailCommercialRef}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('companyName, taxIdClient, yearConnection, lineCreditGranted, paymentTerms, paymentMethod, dateLastPurchase, lastPurchaseAmount, averageMonthlyPurchase, pastPortfolio, averageDaysPastDue, productServiceProvide, concept, socialName, taxIdCompany, contactedPhone, contactedPerson, email', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, companyName, taxIdClient, yearConnection, lineCreditGranted, paymentTerms, paymentMethod, dateLastPurchase, lastPurchaseAmount, averageMonthlyPurchase, pastPortfolio, averageDaysPastDue, productServiceProvide, concept, socialName, taxIdCompany, contactedPhone, contactedPerson, email','safe', 'on' => 'search'),
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
            'companyName' => 'Razon social',
            'taxIdClient' => 'TAX ID cliente',
            'yearConnection' => 'Año de vinculación',
            'lineCreditGranted' => 'Linea de credito otorgada',
            'paymentTerms' => 'Terminos de pago',
            'paymentMethod' => 'Metodo de pago',
            'dateLastPurchase' => 'Fecha de ultima compra',
            'lastPurchaseAmount' => 'Importe de ultima compra',
            'averageMonthlyPurchase' => 'Promedio de compra mensual',
            'pastPortfolio' => 'Cartera vencida',
            'averageDaysPastDue' => 'Promedio de días vencidos',
            'productServiceProvide' => 'Producto / Servicios que proveen',
            'concept' => 'Concepto',
            'socialName' => 'Razon social',
            'taxIdCompany' => 'TAX ID empresa',
            'contactedPhone' => 'Telefono contactado',
            'contactedPerson' => 'Persona contactada',
            'email' => 'Email',
            
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
        $criteria->compare('taxIdClient', $this->taxIdClient, true);
        $criteria->compare('yearConnection', $this->yearConnection, true);
        $criteria->compare('lineCreditGranted', $this->lineCreditGranted, true);
        $criteria->compare('paymentTerms', $this->paymentTerms, true);
        $criteria->compare('paymentMethod', $this->paymentMethod, true);
        $criteria->compare('dateLastPurchase', $this->dateLastPurchase, true);
        $criteria->compare('lastPurchaseAmount', $this->lastPurchaseAmount, true);
        $criteria->compare('averageMonthlyPurchase', $this->averageMonthlyPurchase, true);
        $criteria->compare('pastPortfolio', $this->pastPortfolio, true);
        $criteria->compare('averageDaysPastDue', $this->averageDaysPastDue, true);
        $criteria->compare('productServiceProvide', $this->productServiceProvide, true);
        $criteria->compare('concept', $this->concept, true);
        $criteria->compare('socialName', $this->socialName, true);
        $criteria->compare('taxIdCompany', $this->taxIdCompany, true);
        $criteria->compare('contactedPhone', $this->contactedPhone, true);
        $criteria->compare('contactedPerson', $this->contactedPerson, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailCommercialRef the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->companyName != ""));
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }
    /*
        public function getName() {
            return ($this->firstName . " " . $this->lastName);
        }
    */
    public static function createBasicRecords($verificationSectionId) {

    }

}