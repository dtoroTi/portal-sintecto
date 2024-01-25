<?php

/**
 * This is the model class for table "{{DetailQuestion}}".
 *
 * The followings are the available columns in table '{{DetailQuestion}}':
 * @property integer $id
 * @property integer $sectionTypeQuestionId
 * @property integer $verificationResultId
 * @property integer $verificationSectionId
 * @property string $questionAnswer
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property SectionTypeQuestion $sectionTypeQuestion
 * @property VerificationSection $verificationSection
 */
class DetailQuestion extends SVPActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailQuestion the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailQuestion}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('sectionTypeQuestionId, verificationResultId, verificationSectionId', 'required'),
        array('sectionTypeQuestionId, verificationResultId, verificationSectionId', 'numerical', 'integerOnly' => true),
        array('questionAnswer', 'length', 'max' => 255),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, sectionTypeQuestionId, verificationResultId, verificationSectionId, questionAnswer', 'safe', 'on' => 'search'),
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
        'sectionTypeQuestion' => array(self::BELONGS_TO, 'SectionTypeQuestion', 'sectionTypeQuestionId'),
        'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'sectionTypeQuestionId' => 'Section Type Question',
        'verificationResultId' => 'Verification Result',
        'verificationSectionId' => 'Verification Section',
        'questionAnswer' => 'Question Answer',
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
    $criteria->compare('sectionTypeQuestionId', $this->sectionTypeQuestionId);
    $criteria->compare('verificationResultId', $this->verificationResultId);
    $criteria->compare('verificationSectionId', $this->verificationSectionId);
    $criteria->compare('questionAnswer', $this->questionAnswer, true);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function getHasEnoughData() {
    return (trim($this->questionAnswer) != "");
  }

  public function beforeSave() {
    if ($this->hasEnoughData) {
      $this->verificationResultId = VerificationResult::VERIFIED;
    } else {
      $this->verificationResultId = VerificationResult::PENDING;
    }
    return true;
  }

  public function afterSave() {
    parent::afterSave();
    $this->verificationSection->save();
    return;
  }

  public static function createBasicRecords($verificationSectionId) {
    $verificationSection = VerificationSection::model()->findByPk($verificationSectionId);
    $questions = SectionTypeQuestion::model()->
            findAllByAttributes(array('verificationSectionTypeId' => $verificationSection->verificationSectionTypeId, 'isActive' => TRUE)
    );

    foreach ($questions as $question) {
      $detailQuestion = new DetailQuestion();
      $detailQuestion->sectionTypeQuestionId = $question->id;
      $detailQuestion->verificationSectionId = $verificationSectionId;
      $detailQuestion->verificationResultId = VerificationResult::PENDING;
      $detailQuestion->questionAnswer = '';
      if (!$detailQuestion->save()) {
        Yii::log("Problem saving the question: " . serialize($detailQuestion->getErrors()), "error", "ZWF." . __CLASS__);
      }
    }
  }

}