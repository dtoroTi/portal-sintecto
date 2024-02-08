<?php

/**
 * This is the model class for table "{{DetailPolygraph}}".
 *
 * The followings are the available columns in table '{{DetailPolygraph}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailPolygraph extends SVPActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailPolygraph the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailPolygraph}}';
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
        array('verifiedOn', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, verifiedOn', 'safe', 'on' => 'search'),
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
        'verificationResultId' => 'Verificación',
        'verifiedOn' => 'Fecha de Verificación',
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
    $detailPolygraph = new DetailPolygraph;
    $detailPolygraph->verificationSectionId = $verificationSectionId;
    $detailPolygraph->verificationResultId = VerificationResult::PENDING;
    if (!$detailPolygraph->save()) {
      Yii::app()->user->setFlash('verificationSection', 'Error saving the polygraph detial');
      Yii::log("Error Saving the verification section: " . serialize($detailPolygraph->getErrors()), "error", "ZWF." . __CLASS__);
    }
  }

  public function getComentAdvs($idSection, $val) {
    $models = VerificationSection::model()->findByAttributes(['id'=>$idSection]);

    // Eliminar comentario existente
    $models->comments = '';

    if($val==0){
        $models->comments="Sin alteraciones en poligrafía.";
    }else if($val==1){
        $models->comments="Con alteraciones en poligrafía.";
    }
    $models->update();

    WebUser::logAccess("Se realizo la actualización del comentario en la pestaña poligrafo.", $models->backgroundCheck->code);
    return true;
  }

}