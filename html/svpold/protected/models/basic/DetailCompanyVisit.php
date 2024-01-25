<?php

/**
 * This is the model class for table "{{DetailCompanyVisit}}".
 *
 * The followings are the available columns in table '{{DetailCompanyVisit}}':
 * @property integer $id
 * @property integer $verificationResultId
 * @property integer $verificationSectionId
 * @property string $contact
 * @property string $contactPosition
 * @property string $services
 * @property string $companyHistory
 * @property string $socialObject
 * @property string $verifiedOn
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property VerificationResult $verificationResult
 */
class DetailCompanyVisit extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailCompanyVisit}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationResultId, verificationSectionId', 'required'),
            array('verificationResultId, verificationSectionId', 'numerical', 'integerOnly' => true),
            array('contact, contactPosition', 'length', 'max' => 255),
            array('services, companyHistory, socialObject, verifiedOn', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationResultId, verificationSectionId, contact, contactPosition, services, companyHistory, socialObject, verifiedOn', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationResultId' => 'Verification Result',
            'verificationSectionId' => 'Verification Section',
            'contact' => 'Contacto',
            'contactPosition' => 'Cargo de Contacto',
            'services' => 'Servicios y/o productos',
            'companyHistory' => 'Reseña histórica',
            'socialObject' => 'Objeto Social',
            'verifiedOn'=>'Visitado en'
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
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('contact', $this->contact, true);
        $criteria->compare('contactPosition', $this->contactPosition, true);
        $criteria->compare('services', $this->services, true);
        $criteria->compare('companyHistory', $this->companyHistory, true);
        $criteria->compare('socialObject', $this->socialObject, true);
        $criteria->compare('verifiedOn', $this->verifiedOn, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailCompanyVisit the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (true);
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }

    public static function createBasicRecords($verificationSectionId) {
        $companyVisit = new DetailCompanyVisit;
        $companyVisit->verificationSectionId = $verificationSectionId;
        $companyVisit->verificationResultId = VerificationResult::PENDING;
        if (!$companyVisit->save()) {
            Yii::app()->user->setFlash('verificationSection', 'Error saving the CompanyVisit');
            Yii::log("Error Saving the verification section: " . serialize($companyVisit->getErrors()), "error", "ZWF." . __CLASS__);
        }
    }

}
