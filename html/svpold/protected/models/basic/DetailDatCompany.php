<?php

/**
 * This is the model class for table "{{DetailDatCompany}}".
 *
 * The followings are the available columns in table '{{DetailDatCompany}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $companyName
 * @property string $companyShortName
 * @property string $ruc
 * @property string $registrationNumber
 * @property string $registrationCountry
 * @property string $legalForm
 * @property string $legalFormText
 * @property string $validityDate
 * @property string $taxNumber
 * @property string $nace1
 * @property string $nace1Text
 * @property string $nace2
 * @property string $nace2Text
 * @property string $nace3
 * @property string $nace3Text
 * @property string $usdShareCapitalDate
 * @property string $originalShareCapital
 * @property string $originalShareCapitalCurrency
 * @property string $employees
 * @property string $employeesDate
 * @property string $registrationDate
 * @property string $establishedDate
 * @property string $activityStatus
 * @property string $activityStatusDate
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailDatCompany extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailDatCompany}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('companyName, companyShortName, ruc, registrationNumber, registrationCountry, legalForm, legalFormText, validityDate, taxNumber, nace1, nace1Text, nace2, nace2Text, nace3, nace3Text, usdShareCapitalDate, originalShareCapital, originalShareCapitalCurrency, employees, employeesDate, registrationDate, establishedDate, activityStatus', 'length', 'max' => 255),
            array('activityStatusDate', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, companyName, companyShortName, ruc, registrationNumber, registrationCountry, legalForm, legalFormText, validityDate, taxNumber, nace1, nace1Text, nace2, nace2Text, nace3, nace3Text, usdShareCapitalDate, originalShareCapital, originalShareCapitalCurrency, employees, employeesDate, registrationDate, establishedDate, activityStatus, activityStatusDate','safe', 'on' => 'search'),
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
            'companyName' => 'Nombre de la compañía',
            'companyShortName' => 'Nombre corto de la empresa',
            'ruc' => 'RUC',
            'registrationNumber' => 'Número de expediente',
            'registrationCountry' => 'País de registro',
            'legalForm' => 'Forma Lega',
            'legalFormText' => 'Forma Legal Texto',
            'validityDate' => 'Fecha de la investigación',
            'taxNumber' => 'Numero TAX',
            'nace1' => 'Actividad',
            'nace1Text' => 'Actividad económica principal',
            'nace2' => 'Actividad',
            'nace2Text' => 'Actividad económica',
            'nace3' => 'Actividad',
            'nace3Text' => 'Actividad económica',
            'usdShareCapitalDate' => 'USD Fecha de capital social',
            'originalShareCapital' => 'Capital social original',
            'originalShareCapitalCurrency' => 'Moneda original del capital social',
            'employees' => 'Empleados',
            'employeesDate' => 'Fecha Empleados',
            'registrationDate' => 'Fecha de registro ',
            'establishedDate' => 'Fecha establecida',
            'activityStatus' => 'Estado de actividad',
            'activityStatusDate' => 'Fecha de estado de actividad',
             
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
        $criteria->compare('companyShortName', $this->companyShortName, true);
        $criteria->compare('ruc', $this->ruc, true);
        $criteria->compare('registrationNumber', $this->registrationNumber, true);
        $criteria->compare('registrationCountry', $this->registrationCountry, true);
        $criteria->compare('legalForm', $this->legalForm, true);
        $criteria->compare('legalFormText', $this->legalFormText, true);
        $criteria->compare('validityDate', $this->validityDate, true);
        $criteria->compare('taxNumber', $this->taxNumber, true);
        $criteria->compare('nace1', $this->nace1, true);
        $criteria->compare('nace1Text', $this->nace1Text, true);
        $criteria->compare('nace2', $this->nace2, true);
        $criteria->compare('nace2Text', $this->nace2Text, true);
        $criteria->compare('nace3', $this->nace3, true);
        $criteria->compare('nace3Text', $this->nace3Text, true);
        $criteria->compare('usdShareCapitalDate', $this->usdShareCapitalDate, true);
        $criteria->compare('originalShareCapital', $this->originalShareCapital, true);
        $criteria->compare('originalShareCapitalCurrency', $this->originalShareCapitalCurrency, true);
        $criteria->compare('employees', $this->employees, true);
        $criteria->compare('employeesDate', $this->employeesDate, true);
        $criteria->compare('registrationDate', $this->registrationDate, true);
        $criteria->compare('establishedDate', $this->establishedDate, true);
        $criteria->compare('activityStatus', $this->activityStatus, true);
        $criteria->compare('activityStatusDate', $this->activityStatusDate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailDatCompany the static model class
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