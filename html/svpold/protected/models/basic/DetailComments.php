<?php

/**
 * This is the model class for table "{{DetailComments}}".
 *
 * The followings are the available columns in table '{{DetailComments}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $ruc
 * @property string $socialNetworks
 * @property string $commercialReferences
 * @property string $paymentConditions
 * @property string $checkoutExperience
 * @property string $providersName
 * @property string $grades
 * @property string $stateProvider
 * @property string $incompleteProvider
 * @property string $history
 * @property string $relatedCompanies
 * @property string $name
 * @property string $taxIdentification
 * @property string $countryOrigin
 * @property string $relationshipPercentage
 * @property string $trademarks
 * @property string $identificationBrands
 * @property string $stockExchangeReg
 * @property string $market
 * @property string $insurancePolicies
 * @property string $pressReleases
 * @property string $negativeInformation
 * @property string $registeredDebts
 * @property string $classificationsRankings
 * @property string $registeredCourtCases
 *
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailComments extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailComments}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('ruc, socialNetworks, commercialReferences, paymentConditions, checkoutExperience, providersName, grades, stateProvider, incompleteProvider, relatedCompanies, name, taxIdentification, countryOrigin, relationshipPercentage, trademarks, identificationBrands, insurancePolicies, classificationsRankings, registeredCourtCases', 'length', 'max' => 255),
            array('history, market, registeredDebts, negativeInformation, stockExchangeReg, pressReleases', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, ruc, socialNetworks, commercialReferences, paymentConditions, checkoutExperience, providersName, grades, stateProvider, incompleteProvider, history, relatedCompanies, name, taxIdentification, countryOrigin, relationshipPercentage, trademarks, identificationBrands, stockExchangeReg, market, insurancePolicies, pressReleases, negativeInformation, registeredDebts, classificationsRankings, registeredCourtCases','safe', 'on' => 'search'),
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
            'socialNetworks' => 'Redes sociales',
            'commercialReferences' => 'Referencias comerciales',
            'paymentConditions' => 'Condiciones de pago',
            'checkoutExperience' => 'Experiencia de pago',
            'providersName' => 'Nombre del Proveedor',
            'grades' => 'Notas',
            'stateProvider' => 'Proveedor del estado',
            'incompleteProvider' => 'Proveedor Incumplido',
            'history' => 'Historia',
            'relatedCompanies' => 'Compañías vinculadas',
            'name' => 'Nombre',
            'taxIdentification' => 'Identificación tributaria ID',
            'countryOrigin' => 'País de Origen',
            'relationshipPercentage' => 'Pocentaje de relación',
            'trademarks' => 'Marcas registradas',
            'identificationBrands' => 'Identificación de marcas: Propio, Franquicia u otro',
            'stockExchangeReg' => 'Registro de bolsa de valores',
            'market' => 'Mercado',
            'insurancePolicies' => 'Pólizas de seguro',
            'pressReleases' => 'Publicaciones de prensa',
            'negativeInformation' => 'Información negativa',
            'registeredDebts' => 'Deudas registradas',
            'classificationsRankings' => 'Clasificaciones - rankings',
            'registeredCourtCases' => 'Casos judiciales registrados',
             
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
        $criteria->compare('socialNetworks', $this->socialNetworks, true);
        $criteria->compare('commercialReferences', $this->commercialReferences, true);
        $criteria->compare('paymentConditions', $this->paymentConditions, true);
        $criteria->compare('checkoutExperience', $this->checkoutExperience, true);
        $criteria->compare('providersName', $this->providersName, true);
        $criteria->compare('grades', $this->grades, true);
        $criteria->compare('stateProvider', $this->stateProvider, true);
        $criteria->compare('incompleteProvider', $this->incompleteProvider, true);
        $criteria->compare('history', $this->history, true);
        $criteria->compare('relatedCompanies', $this->relatedCompanies, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('taxIdentification', $this->taxIdentification, true);
        $criteria->compare('relationshipPercentage', $this->relationshipPercentage, true);
        $criteria->compare('trademarks', $this->trademarks, true);
        $criteria->compare('identificationBrands', $this->identificationBrands, true);
        $criteria->compare('stockExchangeReg', $this->stockExchangeReg, true);
        $criteria->compare('market', $this->market, true);
        $criteria->compare('insurancePolicies', $this->insurancePolicies, true);
        $criteria->compare('pressReleases', $this->pressReleases, true);
        $criteria->compare('negativeInformation', $this->negativeInformation, true);
        $criteria->compare('registeredDebts', $this->registeredDebts, true);
        $criteria->compare('classificationsRankings', $this->classificationsRankings, true);
        $criteria->compare('registeredCourtCases', $this->registeredCourtCases, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailComments the static model class
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