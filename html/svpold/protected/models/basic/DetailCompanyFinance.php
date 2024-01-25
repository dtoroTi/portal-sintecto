<?php

/**
 * This is the model class for table "{{DetailCompanyFinance}}".
 *
 * The followings are the available columns in table '{{DetailCompanyFinance}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $dateLastBalanceSheet
 * @property string $lastBalanceSheet
 * @property string $liabilities
 * @property string $sanctions
 * 
 * @property string $presentRisk
 * @property string $rup
 * @property string $cecop
 * @property string $deudoresMorosos
 * @property string $otras
 * 
 * @property string $nObligaciones_0
 * @property string $nObligaciones_30
 * @property string $nObligaciones_60
 * @property string $nObligaciones_90
 * @property string $nObligaciones_120
 * @property string $nObligaciones_more120
 * @property string $nObligaciones_castigada
 * 
 * @property string $valorTotal_0
 * @property string $valorTotal_30
 * @property string $valorTotal_60
 * @property string $valorTotal_90
 * @property string $valorTotal_120
 * @property string $valorTotal_more120
 * @property string $valorTotal_castigada
 * 
 * @property string $valorMora_0
 * @property string $valorMora_30
 * @property string $valorMora_60
 * @property string $valorMora_90
 * @property string $valorMora_120
 * @property string $valorMora_more120
 * @property string $valorMora_castigada
 * @property string $refCIFIN
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailCompanyFinance extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailCompanyFinance}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId, ' .
            'nObligaciones_0, nObligaciones_30, nObligaciones_60, nObligaciones_90, nObligaciones_120, nObligaciones_more120, nObligaciones_castigada, '.
            'valorTotal_0, valorTotal_30, valorTotal_60, valorTotal_90, valorTotal_120, valorTotal_more120, valorTotal_castigada, '.
            'valorMora_0, valorMora_30, valorMora_60, valorMora_90, valorMora_120, valorMora_more120, valorMora_castigada, '
            , 'numerical', 'integerOnly' => true),
            
            // DELETE array('dateLastBalanceSheet, lastBalanceSheet, liabilities, sanctions', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            // array('id, verificationSectionId, verificationResultId, dateLastBalanceSheet, lastBalanceSheet, liabilities, sanctions', 'safe', 'on' => 'search'),

            array('dateLastBalanceSheet, lastBalanceSheet, liabilities, sanctions, presentRisk, rup, cecop, deudoresMorosos, otras, nObligaciones_0, nObligaciones_30, nObligaciones_60, nObligaciones_90, nObligaciones_120, nObligaciones_more120, nObligaciones_castigada, valorTotal_0, valorTotal_30, valorTotal_60, valorTotal_90, valorTotal_120, valorTotal_more120, valorTotal_castigada, valorMora_0, valorMora_30, valorMora_60, valorMora_90, valorMora_120, valorMora_more120, valorMora_castigada,refCIFIN' , 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, dateLastBalanceSheet, lastBalanceSheet, liabilities, sanctions, presentRisk, refCIFIN', 'safe', 'on' => 'search'),
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
            'dateLastBalanceSheet' => 'Fecha de último balance',
            'lastBalanceSheet' => 'Balance',
            'liabilities' => 'Obligaciones Financieras',
            'sanctions' => 'Sanciones y Multas',
            'presentRisk' => 'Presenta Novedad en Central de Riesgo',
            'rup' => 'Registro Único de Proponentes',
            'cecop' => 'CECOP 1-2',
            'deudoresMorosos' => 'Boletín de Deudores Morosos',
            'otras' => 'Otras Centrales de Riesgo',
            'nObligaciones_0' => '',
            'nObligaciones_30' => '',
            'nObligaciones_60' => '',
            'nObligaciones_90' => '',
            'nObligaciones_120' => '',
            'nObligaciones_more120' => '',
            'nObligaciones_castigada' => '',
            'valorTotal_0' => '',
            'valorTotal_30' => '',
            'valorTotal_60' => '',
            'valorTotal_90' => '',
            'valorTotal_120' => '',
            'valorTotal_more120' => '',
            'valorTotal_castigada' => '',
            'valorMora_0' => '',
            'valorMora_30' => '',
            'valorMora_60' => '',
            'valorMora_90' => '',
            'valorMora_120' => '',
            'valorMora_more120' => '',
            'valorMora_castigada' => '',
            'refCIFIN' => 'Referencias Bancarias (CIFIN)',
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
        $criteria->compare('dateLastBalanceSheet', $this->dateLastBalanceSheet, true);
        $criteria->compare('lastBalanceSheet', $this->lastBalanceSheet, true);
        $criteria->compare('liabilities', $this->liabilities, true);
        $criteria->compare('sanctions', $this->sanctions, true);
        $criteria->compare('presentRisk', $this->presentRisk, true);
        $criteria->compare('$rup', $this->rup, true);
        $criteria->compare('$cecop', $this->cecop, true);
        $criteria->compare('$deudoresMorosos', $this->deudoresMorosos, true);
        $criteria->compare('$otras', $this->otras, true);
        $criteria->compare('$nObligaciones_0', $this->nObligaciones_0, true);
        $criteria->compare('$nObligaciones_30', $this->nObligaciones_30, true);
        $criteria->compare('$nObligaciones_60', $this->nObligaciones_60, true);
        $criteria->compare('$nObligaciones_90', $this->nObligaciones_90, true);
        $criteria->compare('$nObligaciones_120', $this->nObligaciones_120, true);
        $criteria->compare('$nObligaciones_more120', $this->nObligaciones_more120, true);
        $criteria->compare('$nObligaciones_castigada', $this->nObligaciones_castigada, true);
        $criteria->compare('$valorTotal_0', $this->valorTotal_0, true);
        $criteria->compare('$valorTotal_30', $this->valorTotal_30, true);
        $criteria->compare('$valorTotal_60', $this->valorTotal_60, true);
        $criteria->compare('$valorTotal_90', $this->valorTotal_90, true);
        $criteria->compare('$valorTotal_120', $this->valorTotal_120, true);
        $criteria->compare('$valorTotal_more120', $this->valorTotal_more120, true);
        $criteria->compare('$valorTotal_castigada', $this->valorTotal_castigada, true);
        $criteria->compare('$valorMora_0', $this->valorMora_0, true);
        $criteria->compare('$valorMora_30', $this->valorMora_30, true);
        $criteria->compare('$valorMora_60', $this->valorMora_60, true);
        $criteria->compare('$valorMora_90', $this->valorMora_90, true);
        $criteria->compare('$valorMora_120', $this->valorMora_120, true);
        $criteria->compare('$valorMora_more120', $this->valorMora_more120, true);
        $criteria->compare('$valorMora_castigada', $this->valorMora_castigada, true);
        $criteria->compare('$refCIFIN', $this->refCIFIN, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailCompanyFinance the static model class
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
        $companyFinance = new DetailCompanyFinance;
        $companyFinance->verificationSectionId = $verificationSectionId;
        $companyFinance->verificationResultId = VerificationResult::PENDING;
        if (!$companyFinance->save()) {
            Yii::app()->user->setFlash('verificationSection', 'Error saving the detial Finance');
            Yii::log("Error Saving the verification section: " . serialize($companyFinance->getErrors()), "error", "ZWF." . __CLASS__);
        }
    }

}
