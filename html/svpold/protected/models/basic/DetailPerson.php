<?php

/**
 * This is the model class for table "{{DetailPerson}}".
 *
 * The followings are the available columns in table '{{DetailPerson}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $relationshipStatusId
 * @property string $relation
 * @property string $name
 * @property integer $age
 * @property string $workingAt
 * @property string $functions
 * @property string $tel
 * @property string $comments
 * @property string $verifiedOn
 * @property string $howLongKnowEachOther
 * @property string $whoLivesWithTheCandidate
 * @property string $neighborhoodOfTheCandidate
 * @property string $wouldYouRecomendTheCandidate
 * @property string $profession 
 * @property int $educationTypeId
 * @property string $familyCommunication
 * @property string $familyActivities
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property VerificationResult $verificationResult
 * @property RelationshipStatus $relationshipStatus
 */
class DetailPerson extends SVPActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailPerson the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailPerson}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('verificationSectionId, verificationResultId', 'required'),
        array('verificationSectionId, verificationResultId, relationshipStatusId, age,educationTypeId', 'numerical', 'integerOnly' => true),
        array('relation, tel, howLongKnowEachOther, wouldYouRecomendTheCandidate', 'length', 'max' => 45),
        array('name, workingAt, functions, comments,whoLivesWithTheCandidate,neighborhoodOfTheCandidate,familyCommunication, familyActivities', 'length', 'max' => 255),
        array('verifiedOn,profession,educationTypeId', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, relationshipStatusId, relation, name, age, workingAt, functions, tel, comments, verifiedOn', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
        'verificationResult' => array(self::BELONGS_TO, 'VerificationResult', 'verificationResultId'),
        'relationshipStatus' => array(self::BELONGS_TO, 'RelationshipStatus', 'relationshipStatusId'),
        'educationType' => array(self::BELONGS_TO, 'EducationType', 'educationTypeId'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'verificationSectionId' => 'Sección',
        'verificationResultId' => 'Resultado de verificación',
        'relationshipStatusId' => 'Estado civil',
        'relation' => 'Relación',
        'name' => 'Nombre',
        'age' => 'Edad',
        'workingAt' => 'Trabaja en',
        'functions' => 'Ocupación',
        'tel' => 'Tel',
        'comments' => 'Comments',
        'verifiedOn' => 'Verified On',
        'howLongKnowEachOther' => 'Lo conoce desde hace cuanto?',
        'whoLivesWithTheCandidate' => 'Conoce con quién vive el candidato?',
        'neighborhoodOfTheCandidate' => 'En que barrio vive el candidato?',
        'wouldYouRecomendTheCandidate' => 'Recomendaría al candidato?',
        'educationTypeId' => 'Nivel de Educación',
        'profession' => 'Profesión',
        'verifiedOn' => 'Verificado en',
        'comments'=>'Comentarios',
        'familyCommunication' => 'Comunicación',
        'familyActivities' => 'Actividades que comparten',
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
    $criteria->compare('relationshipStatusId', $this->relationshipStatusId);
    $criteria->compare('relation', $this->relation, true);
    $criteria->compare('name', $this->name, true);
    $criteria->compare('age', $this->age);
    $criteria->compare('workingAt', $this->workingAt, true);
    $criteria->compare('functions', $this->functions, true);
    $criteria->compare('tel', $this->tel, true);
    $criteria->compare('comments', $this->comments, true);
    $criteria->compare('verifiedOn', $this->verifiedOn, true);
    $criteria->compare('familyCommunication',$this->familyCommunication,true);
    $criteria->compare('familyActivities',$this->familyActivities,true);
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
  
  public function getIsAReference(){
    return ($this->verificationSection->isAReferencePerson?true:false);
  }
  
  public static function createBasicRecords($verificationSectionId) {
        
    }

    public static function updateFromJson($verificationSection, $sectiondata){
      foreach($sectiondata['relativeReference'] as $sectionpersonalF=>$data){
        $reference = new DetailPerson();
        if(sizeof($data) != 0){
          $reference->verificationSectionId=$verificationSection->id;
          $reference->verificationResultId=1;
        }
          if(isset($data['relationship'])){
            $reference->relation=CHtml::encode($data['relationship']);
          }
          if(isset($data['name'])){
            $reference->name=CHtml::encode($data['name']);
          }
          if(isset($data['cel'])){
            $reference->tel=CHtml::encode($data['cel']);
          }
        $reference->save(); 
      }

      foreach($sectiondata['personalReference'] as $sectionpersonalP=>$data){
        $referenceP = new DetailPerson();
          if(sizeof($data) != 0){
            $referenceP->verificationSectionId=$verificationSection->id;
            $referenceP->verificationResultId=1;
          }
          if(isset($data['relationship'])){
            $referenceP->relation=CHtml::encode($data['relationship']);
          }
          if(isset($data['name'])){
            $referenceP->name=CHtml::encode($data['name']);
          }
          if(isset($data['cel'])){
            $referenceP->tel=CHtml::encode($data['cel']);
          }
        $referenceP->save(); 
      }
  }

}