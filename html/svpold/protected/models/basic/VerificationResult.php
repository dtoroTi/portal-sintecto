<?php

/**
 * This is the model class for table "{{VerificationResult}}".
 *
 * The followings are the available columns in table '{{VerificationResult}}':
 * @property integer $id
 * @property string $name
 * @property integer $completed
 *
 * The followings are the available model relations:
 * @property Verification[] $verifications
 */
class VerificationResult extends CActiveRecord {

  const PENDING = 1;
  const VERIFIED = 2;
  const INCONSITENT = 3;
  const UNVERIFIABLE = 4;

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return VerificationResult the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{VerificationResult}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('completed', 'numerical', 'integerOnly' => true),
        array('name', 'length', 'max' => 45),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, name, completed', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'detailDocuments' => array(self::HAS_MANY, 'DetailDocument', 'verificationResultId'),
        'detailStudies' => array(self::HAS_MANY, 'DetailEducation', 'verificationResultId'),
        'detailJobs' => array(self::HAS_MANY, 'DetailJob', 'verificationResultId'),
        'detailRegisters' => array(self::HAS_MANY, 'DetailRegister', 'verificationResultId'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'name' => 'Name',
        'completed' => 'Completed',
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
    $criteria->compare('name', $this->name, true);
    $criteria->compare('completed', $this->completed);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

}