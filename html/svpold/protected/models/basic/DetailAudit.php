<?php
/**
 * This is the model class for table "{{DetailAudit}}".
 *
 * The followings are the available columns in table '{{DetailAudit}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $relationshipStatusId
 * @property integer $findings
 * @property string $request
 * @property string $description
 * @property string $area
 * @property string $comments
 * @property string $verifiedOn
 *
  * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property VerificationResult $verificationResult
 * @property FindingsAudit $FindingsAudit
 */

class DetailAudit extends SVPActiveRecord {

    public static function model($className = __CLASS__) {
      return parent::model($className);
    }

    public function tableName() {
        return '{{DetailAudit}}';
    }

    public function rules() {
        return array(

            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId', 'numerical', 'integerOnly' => true),
            array('request, description, area, comments, findings', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            // array('id, verificationSectionId, verificationResultId, relationshipStatusId, relation, name, age, workingAt, functions, tel, comments, verifiedOn', 'safe', 'on' => 'search'),
            array('id, verificationSectionId, verificationResultId, request, description, area, comments',
            'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
            'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
            'findingsAudit' => array(self::BELONGS_TO,'FindingsAudit', 'findings'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Sección',
            'verificationResultId' => 'Resultado de verificación',
            'request' => 'Requisito',
            'description' => 'Descripción',
            'area' => 'Proceso o Área',
            'findings' => 'Hallazgo Aud',
            'comments' => 'comentarios',            
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('request', $this->request, true);
        $criteria->compare('description', $this->description, true);
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
        return ($this->request != "");
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }
      
    public static function createBasicRecords($verificationSectionId) {
            
    }
}