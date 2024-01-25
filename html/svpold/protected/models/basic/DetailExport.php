<?php

/**
 * This is the model class for table "{{DetailExport}}".
 *
 * The followings are the available columns in table '{{DetailExport}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $Ruc
 * @property string $Export
 * @property string $CountryCode
 * @property string $CountryName
 * @property string $CountryList
 * @property string $AsOfDate
 * @property string $Amount
 * @property string $Currency
 * @property string $Percentage
 *
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailExport extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailExport}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('Ruc, Export, CountryCode, CountryName, CountryList, AsOfDate, Amount, Currency', 'length', 'max' => 255),
            array('Percentage', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, Ruc, Export, CountryCode, CountryName, CountryList, AsOfDate, Amount, Currency, Percentage','safe', 'on' => 'search'),
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
            'Ruc' => 'Ruc',
            'Export' => 'Exportación',
            'CountryCode' => 'Código País',
            'CountryName' => 'Nombre País',
            'CountryList' => 'Listado Países',
            'AsOfDate' => 'Fecha',
            'Amount' => 'Monto',
            'Currency' => 'Moneda',
            'Percentage' => 'Porcentaje',
             
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
        $criteria->compare('Ruc', $this->Ruc, true);
        $criteria->compare('EXport', $this->Export, true);
        $criteria->compare('CountryCode', $this->CountryCode, true);
        $criteria->compare('CountryName', $this->CountryName, true);
        $criteria->compare('CountryList', $this->CountryList, true);
        $criteria->compare('AsOfDate', $this->AsOfDate, true);
        $criteria->compare('Amount', $this->Amount, true);
        $criteria->compare('Currency', $this->Currency, true);
        $criteria->compare('Percentage', $this->Percentage, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailExport the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->Export != ""));
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