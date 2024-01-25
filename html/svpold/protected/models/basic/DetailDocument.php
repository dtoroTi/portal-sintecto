<?php

/**
 * This is the model class for table "{{DetailDocument}}".
 *
 * The followings are the available columns in table '{{DetailDocument}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $required
 * @property string $name
 * @property string $verifiedOn
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 */
class DetailDocument extends SVPActiveRecord {

  public static function basicDocuments() {
    return array(
        'Certificados de Estudio',
        'Certificados de Trabajo',
        'Documento de Identidad',
    );
  }

  public static function basicDocument($id) {
    $arr = DetailDocument::basicDocuments();
    if (isset($arr[$id])) {
      $ans = $arr[$id];
    } else {
      $ans = null;
    }
    return $ans;
  }

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailDocument the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailDocument}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('verificationSectionId, verificationResultId', 'required'),
        array('verificationSectionId, verificationResultId', 'numerical', 'integerOnly' => true),
        array('verificationResultId', 'default', 'value' => VerificationResult::PENDING),
        array('verifiedOn', 'length', 'max' => 10),
        array('required', 'boolean'),
        array('name', 'length', 'max' => 45),
        array('comments', 'length', 'max' => 255),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, name', 'safe', 'on' => 'search'),
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
        'verificationResultId' => 'Verification',
        'name' => 'Name',
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
    $criteria->compare('required', $this->required);
    $criteria->compare('name', $this->name, true);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function getHasEnoughData() {
    return ($this->name != "");
  }

  public function afterSave() {
    parent::afterSave();
    $this->verificationSection->save();
    return;
  }

  public static function createBasicRecords($verificationSectionId) {
    $values = array(
        'verificationSectionId' => $verificationSectionId,
        'verificationResultId' => VerificationResult::PENDING,
        'required' => TRUE,
    );
    $docNames = DetailDocument::basicDocuments();
    foreach ($docNames as $documentName) {
      $values['name'] = $documentName;
      $doc = new DetailDocument();
      $doc->attributes = $values;
      if (!$doc->save()) {
        Yii::app()->user->setFlash('verificationSection', serialize($doc->getErrors()));
      }
    }
  }

}