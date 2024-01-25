<?php

/**
 * This is the model class for table "{{DetailContactPerson}}".
 *
 * The followings are the available columns in table '{{DetailContactPerson}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $ruc
 * @property string $lastName
 * @property string $firstName
 * @property string $title
 * @property string $functionaryCode
 * @property string $function
 * @property string $profession
 * @property string $sex
 * @property string $birthdate
 * @property string $areaCode
 * @property string $city
 * @property string $street
 * @property string $housenumber
 * @property string $country
 * @property string $maritalstate
 * @property string $personalID2
 * @property string $activeSince
 * @property string $email
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailContactPerson extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailContactPerson}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('ruc, lastName, firstName, title, functionaryCode, function, profession, sex, birthdate, areaCode, city, street, housenumber, country, maritalstate, personalID2, activeSince, email', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, ruc, lastName, firstName, title, functionaryCode, function, profession, sex, birthdate, areaCode, city, street, housenumber, country, maritalstate, personalID2, activeSince, email','safe', 'on' => 'search'),
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
            'ruc' => 'ruc',
            'lastName' => 'Apellido',
            'firstName' => 'Primer nombre',
            'title' => 'Título',
            'functionaryCode' => 'Código de funcionario',
            'function' => 'Función',
            'profession' => 'Profesión',
            'sex' => 'Sexo',
            'birthdate' => 'Fecha de nacimiento',
            'areaCode' => 'Codigo de area',
            'city' => 'Ciudad',
            'street' => 'Calle',
            'housenumber' => 'Número de casa',
            'country' => 'País',
            'maritalstate' => 'Estado civil',
            'personalID2' => 'Id personal2',
            'activeSince' => 'Activo desde',
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
        $criteria->compare('ruc', $this->ruc, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('functionaryCode', $this->functionaryCode, true);
        $criteria->compare('function', $this->function, true);
        $criteria->compare('profession', $this->profession, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('birthdate', $this->birthdate, true);
        $criteria->compare('areaCode', $this->areaCode, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('housenumber', $this->housenumber, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('maritalstate', $this->maritalstate, true);
        $criteria->compare('personalID2', $this->personalID2, true);
        $criteria->compare('activeSince', $this->activeSince, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailContactPerson the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->lastName != ""));
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