<?php

/**
 * This is the model class for table "{{DetailAddress}}".
 *
 * The followings are the available columns in table '{{DetailAddress}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $ruc
 * @property string $addressType
 * @property string $zipcode
 * @property string $city
 * @property string $street
 * @property string $houseNumber
 * @property string $country
 * @property string $telephoneArea
 * @property string $telephoneNumber
 * @property string $faxArea
 * @property string $faxNumber
 * @property string $telex
 * @property string $email
 * @property string $webSite
 * @property string $telephoneArea2
 * @property string $telephoneArea3
 * @property string $telephoneArea4
 * @property string $telephoneArea5
 * @property string $telephoneNumber2
 * @property string $telephoneNumber3
 * @property string $telephoneNumber4
 * @property string $telephoneNumber5
 * @property string $additionalAddressLine
 * @property string $lastChangedOn
 * @property string $region
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailAddress extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailAddress}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('ruc, addressType, zipcode, city, street, houseNumber, country, telephoneArea, telephoneNumber, faxArea, faxNumber, telex, email, webSite, telephoneArea2, telephoneArea3, telephoneArea4, telephoneArea5, telephoneNumber2, telephoneNumber3, telephoneNumber4, telephoneNumber5, additionalAddressLine, lastChangedOn, region', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, ruc, addressType, zipcode, city, street, houseNumber, country, telephoneArea, telephoneNumber, faxArea, faxNumber, telex, email, webSite, telephoneArea2, telephoneArea3, telephoneArea4, telephoneArea5, telephoneNumber2, telephoneNumber3, telephoneNumber4, telephoneNumber5, additionalAddressLine, lastChangedOn, region','safe', 'on' => 'search'),
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
            'ruc' => 'RUC',
            'addressType' => 'Tipo de dirección',
            'zipcode' => 'Código postal',
            'city' => 'Ciudad',
            'street' => 'Barrio',
            'houseNumber' => 'Dirección',
            'country' => 'País',
            'telephoneArea' => 'Área de Teléfono',
            'telephoneNumber' => 'Número de teléfono',
            'faxArea' => 'Área de fax',
            'faxNumber' => 'Número de fax',
            'telex' => 'Télex',
            'email' => 'Email',
            'webSite' => 'Sitio web',
            'telephoneArea2' => 'Teléfono Área',
            'telephoneArea3' => 'Teléfono Área',
            'telephoneArea4' => 'Teléfono Área',
            'telephoneArea5' => 'Teléfono Área',
            'telephoneNumber2' => 'Número de teléfono',
            'telephoneNumber3' => 'Número de teléfono',
            'telephoneNumber4' => 'Número de teléfono',
            'telephoneNumber5' => 'Número de teléfono',
            'additionalAddressLine' => 'Línea de dirección adicional',
            'lastChangedOn' => 'Última modificación',
            'region' => 'Última modificación',
             
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
        $criteria->compare('ruc', $this->ruc, true);
        $criteria->compare('addressType', $this->addressType, true);
        $criteria->compare('zipcode', $this->zipcode, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('houseNumber', $this->houseNumber, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('telephoneArea', $this->telephoneArea, true);
        $criteria->compare('telephoneNumber', $this->telephoneNumber, true);
        $criteria->compare('faxNumber', $this->faxNumber, true);
        $criteria->compare('telex', $this->telex, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('webSite', $this->webSite, true);
        $criteria->compare('telephoneArea2', $this->telephoneArea2, true);
        $criteria->compare('telephoneArea3', $this->telephoneArea3, true);
        $criteria->compare('telephoneArea4', $this->telephoneArea4, true);
        $criteria->compare('telephoneArea5', $this->telephoneArea5, true);
        $criteria->compare('telephoneNumber2', $this->telephoneNumber2, true);
        $criteria->compare('telephoneNumber3', $this->telephoneNumber3, true);
        $criteria->compare('telephoneNumber4', $this->telephoneNumber4, true);
        $criteria->compare('telephoneNumber5', $this->telephoneNumber5, true);
        $criteria->compare('additionalAddressLine', $this->additionalAddressLine, true);
        $criteria->compare('lastChangedOn', $this->lastChangedOn, true);
        $criteria->compare('region', $this->region, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailAddress the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->ruc != ""));
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