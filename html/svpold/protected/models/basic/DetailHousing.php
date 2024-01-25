<?php

/**
 * This is the model class for table "{{DetailHousing}}".
 *
 * The followings are the available columns in table '{{DetailHousing}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $stratum
 * @property string $housingType
 * @property string $publicServicesMissing
 * @property string $livesSince
 * @property string $visitedOn
 * @property integer $housingOwnership
 * @property string $otherHousingType
 * @property string $otherHousingOwnership
 * @property string $distribution
 * @property string $orderAndCleaning
 * @property string $iluminationAndVentilation
 * @property string $changeExpectations
 * @property string $socialEquipment
 * @property string $zoneLimits
 * @property string $securityFactors
 * @property string $accessRoads
 * @property integer $newHousingType
 * @property string $socialNetwork
 * @property string $clubsGroups
 * @property string $hobbiesActivities
 * The followings are the available model relations:
 * @property HousingOwnership $housingOwnership0
 * @property HousingType $newHousingType0
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailHousing extends SVPActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailHousing the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailHousing}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
    return array(
        array('verificationSectionId, verificationResultId', 'required'),
        array('verificationSectionId, verificationResultId, stratum, housingOwnership, newHousingType', 'numerical', 'integerOnly' => true),
        array('housingType, publicServicesMissing', 'length', 'max'=>45),
        array('otherHousingType, otherHousingOwnership', 'length', 'max'=>50),
        array('distribution, orderAndCleaning, iluminationAndVentilation, changeExpectations, socialEquipment, zoneLimits, securityFactors, accessRoads, socialNetwork, clubsGroups, hobbiesActivities', 'length', 'max'=>500),
        array('livesSince, visitedOn', 'safe'),
        // The following rule is used by search().
// Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, stratum, housingType, publicServicesMissing, livesSince, visitedOn, housingOwnership, 
        otherHousingType, otherHousingOwnership, distribution, orderAndCleaning, iluminationAndVentilation, changeExpectations, socialEquipment, 
        zoneLimits, securityFactors, accessRoads, socialNetwork, clubsGroups, hobbiesActivities, newHousingType', 'safe', 'on'=>'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
    return array(
        'housingOwnership0' => array(self::BELONGS_TO, 'HousingOwnership', 'housingOwnership'),
        'newHousingType0' => array(self::BELONGS_TO, 'HousingType', 'newHousingType'),
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
        'verificationResultId' => 'Resultado',
        'stratum' => 'Stratum',
        'housingType' => 'Housing Type',
        'publicServicesMissing' => 'Public Services Missing',
        'livesSince' => 'Lives Since',
        'visitedOn' => 'Visited On',
        'housingOwnership' => 'Housing Ownership',
        'otherHousingType' => 'Other Housing Type',
        'otherHousingOwnership' => 'Other Housing Ownership',
        'distribution' => 'Distribution',
        'orderAndCleaning' => 'Order And Cleaning',
        'iluminationAndVentilation' => 'Ilumination And Ventilation',
        'changeExpectations' => 'Change Expectations',
        'socialEquipment' => 'Social Equipment',
        'zoneLimits' => 'Zone Limits',
        'securityFactors' => 'Security Factors',
        'accessRoads' => 'Access Roads',
        'socialNetwork' => 'Social Network',
        'clubsGroups' => 'Clubs Groups',
        'hobbiesActivities' => 'Hobbies Activities',
        'newHousingType' => 'New Housing Type',
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
    $criteria->compare('stratum', $this->stratum);
    $criteria->compare('housingType', $this->housingType, true);
    $criteria->compare('publicServicesMissing', $this->publicServicesMissing, true);
    $criteria->compare('livesSince', $this->livesSince, true);
    $criteria->compare('visitedOn', $this->visitedOn, true);
    $criteria->compare('housingOwnership',$this->housingOwnership);
    $criteria->compare('otherHousingType',$this->otherHousingType,true);
    $criteria->compare('otherHousingOwnership',$this->otherHousingOwnership,true);
    $criteria->compare('distribution',$this->distribution,true);
    $criteria->compare('orderAndCleaning',$this->orderAndCleaning,true);
    $criteria->compare('iluminationAndVentilation',$this->iluminationAndVentilation,true);
    $criteria->compare('changeExpectations',$this->changeExpectations,true);
    $criteria->compare('socialEquipment',$this->socialEquipment,true);
    $criteria->compare('zoneLimits',$this->zoneLimits,true);
    $criteria->compare('securityFactors',$this->securityFactors,true);
    $criteria->compare('accessRoads',$this->accessRoads,true);
    $criteria->compare('newHousingType',$this->newHousingType);
    $criteria->compare('socialNetwork',$this->socialNetwork,true);
    $criteria->compare('clubsGroups',$this->clubsGroups,true);
    $criteria->compare('hobbiesActivities',$this->hobbiesActivities,true);

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
    $detailHousing = new DetailHousing;
    $detailHousing->verificationSectionId = $verificationSectionId;
    $detailHousing->verificationResultId= VerificationResult::PENDING;
    if (!$detailHousing->save()) {
      Yii::app()->user->setFlash('verificationSection', 'Error saving the detial housing');
      Yii::log("Error Saving the verification section: ".serialize($detailHousing->getErrors()), "error", "ZWF." . __CLASS__);
    }
  }

}