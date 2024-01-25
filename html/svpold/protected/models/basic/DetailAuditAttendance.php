<?php
/**
 * This is the model class for table "{{DetailAuditAttendance}}".
 *
 * The followings are the available columns in table '{{DetailAuditAttendance}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $relationshipStatusId
 * @property string $name
 * @property string $position
 * @property string $area
 * @property string $comments
 * 
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property VerificationResult $verificationResult
 */

class DetailAuditAttendance extends SVPActiveRecord {

    public static function model($className = __CLASS__) {
      return parent::model($className);
    }

    public function tableName() {
        return '{{DetailAuditAttendance}}';
    }

    public function rules() {
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId', 'numerical', 'integerOnly' => true),
            array('name, position, area, comments', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // array('id, verificationSectionId, verificationResultId, relationshipStatusId, relation, name, age, workingAt, functions, tel, comments, verifiedOn', 'safe', 'on' => 'search'),
            array('id, verificationSectionId, verificationResultId, name, position, area, comments',
            'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Sección',
            'verificationResultId' => 'Resultado de verificación',
            'name' => 'Nombre',
            'position' => 'Cargo',
            'area' => 'Proceso o Área',
            'comments' => 'comentarios',            
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('area', $this->area, true);
        $criteria->compare('comments', $this->comments, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /*
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    */

    public function getHasEnoughData() {
        return ($this->name != "");
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }
      
    public static function createBasicRecords($verificationSectionId) {
            
    }
}