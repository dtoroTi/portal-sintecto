<?php

/**
 * This is the model class for table "{{DetailDatShareHolders}}".
 *
 * The followings are the available columns in table '{{DetailDatShareHolders}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string  $ruc
 * @property integer $shareHolderType
 * @property integer $shareHolderName
 * @property integer $shareHolderCountry
 * @property integer $ownerShipPercentage
 * @property integer $functionaryCode
 * @property integer $function
 * @property integer $hasSharesIn
 * @property integer $shareHolderNameID
 * @property integer $activeSince
 *
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailDatShareHolders extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailDatShareHolders}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('ruc, shareHolderType, shareHolderName, shareHolderCountry, ownerShipPercentage, functionaryCode, function, hasSharesIn, shareHolderNameID, activeSince', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, ruc, shareHolderType, shareHolderName, shareHolderCountry, ownerShipPercentage, functionaryCode, function, hasSharesIn, shareHolderNameID, activeSince','safe', 'on' => 'search'),
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
            'shareHolderType' => 'Tipo Accionista',
            'shareHolderName' => 'Nombre Accionista',
            'shareHolderCountry' => 'Pais Accionista',
            'ownerShipPercentage' => 'Porcentaje de participación',
            'functionaryCode' => 'Codigo de funcionario',
            'function' => 'Funcion',
            'hasSharesIn' => 'Tiene acciones en',
            'shareHolderNameID' => 'ID del nombre del titular de la acción',
            'activeSince' => 'Activado desde',
             
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
        $criteria->compare('shareHolderType', $this->shareHolderType, true);
        $criteria->compare('shareHolderName', $this->shareHolderName, true);
        $criteria->compare('shareHolderCountry', $this->shareHolderCountry, true);
        $criteria->compare('ownerShipPercentage', $this->ownerShipPercentage, true);
        $criteria->compare('functionaryCode', $this->functionaryCode, true);
        $criteria->compare('function', $this->function, true);
        $criteria->compare('hasSharesIn', $this->hasSharesIn, true);
        $criteria->compare('shareHolderNameID', $this->shareHolderNameID, true);
        $criteria->compare('activeSince', $this->activeSince, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailDatShareHolders the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->shareHolderName != ""));
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