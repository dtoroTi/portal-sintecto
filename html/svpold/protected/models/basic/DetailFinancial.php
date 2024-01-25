<?php

/**
 * This is the model class for table "{{DetailFinancial}}".
 *
 * The followings are the available columns in table '{{DetailFinancial}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $verifiedOn
 * @property integer $finalResult
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailFinancial extends SVPActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailFinancial the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailFinancial}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('verificationSectionId, verificationResultId, finalResult', 'required'),
        array('verificationSectionId, verificationResultId, finalResult', 'numerical', 'integerOnly' => true),
        array('verifiedOn', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, verifiedOn, finalResult', 'safe', 'on' => 'search'),
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
        'verificationSectionId' => 'Section de Verificación',
        'verificationResultId' => 'Verificación',
        'verifiedOn' => 'Fecha de Verificación',
        'finalResult' => 'Resultado',
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('id', $this->id);
    $criteria->compare('verificationSectionId', $this->verificationSectionId);
    $criteria->compare('verificationResultId', $this->verificationResultId);
    $criteria->compare('verifiedOn', $this->verifiedOn, true);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function afterSave() {
    parent::afterSave();
    $this->verificationSection->save();
    return;
  }

  public static function createBasicRecords($verificationSectionId) {
    $detailFinancial = new DetailFinancial;
    $detailFinancial->verificationSectionId = $verificationSectionId;
    $detailFinancial->verificationResultId = VerificationResult::PENDING;
    if (!$detailFinancial->save()) {
      Yii::app()->user->setFlash('verificationSection', 'Error saving the financial detail ');
      Yii::log("Error Saving the verification section: " . serialize($detailFinancial->getErrors()), "error", "ZWF." . __CLASS__);
    }
  }

  /* Retrieves a list of options for the final result of this section */
  public function getResultStatusOptions(){
      $options = array(
          0=>'Seleccione una opción',
          1=>'No presenta vida crediticia',
          2=>'Presenta cartera castigada',
          3=>'Presenta mora en 2 o mas de sus obligaciones financieras y o comerciales superior a 30 dias',
          4=>'Presenta mora en 1 o mas de sus obligaciones financieras y o comerciales superior a 30 dias',
          5=>'Presenta mora en 1 o mas de sus obligaciones financieras y o comerciales inferior a 30 dias',
          6=>'No presenta mora en sus obligaciones financieras y/o comerciales actualmente.',
          7=>'Obligación en mora, con registro inactivo por falta de reporte sin valores determinados.',
      );

    return $options;
  }

}