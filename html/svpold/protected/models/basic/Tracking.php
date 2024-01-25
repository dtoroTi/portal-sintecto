<?php

/**
 * This is the model class for table "{{Tracking}}".
 *
 * The followings are the available columns in table '{{Tracking}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property Date $DateContact
 * @property string $ContactStatus
 * @property string $Responsible
 * @property string $NameContact
 * @property string $Email
 * @property string $Number
 * @property string $Observations
 *
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class Tracking extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Tracking}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('ContactStatus, DateContact, Responsible, NameContact, Email, Number', 'length', 'max' => 255),
            array('Observations', 'safe'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, ContactStatus, DateContact, Responsible, NameContact, Email, Number'.
                'Observations, ','safe', 'on' => 'search'),
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
            'DateContact' => 'Fecha del contacto',
            'ContactStatus' => 'Estado del contacto',
            'Responsible' => 'Responsable',
            'NameContact' => 'Nombre del Contacto',
            'Email' => 'Correo',
            'Number' => 'Telefóno',
            'Observations' => 'Observaciones',
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
        $criteria->compare('DateContact', $this->DateContact, true);
        $criteria->compare('ContactStatus', $this->ContactStatus, true);
        $criteria->compare('Responsible', $this->Responsible, true);
        $criteria->compare('NameContact', $this->NameContact, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Number', $this->Number, true);
        $criteria->compare('Observations', $this->Observations, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tracking the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->DateContact != ""));
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