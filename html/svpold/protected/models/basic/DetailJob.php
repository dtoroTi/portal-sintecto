<?php

/**
 * This is the model class for table "{{DetailJob}}".
 *
 * The followings are the available columns in table '{{DetailJob}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $company
 * @property string $city
 * @property string $country
 * @property string $tel
 * @property string $startedOn
 * @property string $finishedOn
 * @property integer $stillWorking
 * @property string $lastPosition
 * @property string $firstPosition
 * @property string $comments
 * @property string $verifiedOn
 * @property string $nameOfContact
 * @property string $retireReason
 * @property string $workDetail
 * @property string $contractType
 * @property string $strenghts
 * @property string $weaknesses
 * @property string $wouldYouContractAgain
 * @property string $wouldYouRecomend
 * @property string $contactPosition Contact position, not necesarely the applicat boss
 * @property string $immediateBoss
 * @property string $immediateBossContact
 * @property boolean $problemSolving
 * @property boolean $leadership
 * @property boolean $teamWork
 * @property boolean $orientationtoResults
 * @property boolean $adaptability  
 * @property string $historicPension
 * @property string $congruentResume
 * @property string $providedCertificate
 * @property string $salaryEarned 
 * @property integer $bossInmediateContact
 * @property string $email

 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property Verification $verification
 */
class DetailJob extends SVPActiveRecord {

  const INACTIVITY_WARNING_DAYS = 30;

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailJob the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailJob}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('verificationSectionId, verificationResultId', 'required'),
        array('verificationSectionId, verificationResultId, activityTypeId', 'numerical', 'integerOnly' => true),
        array('verifiedOn', 'length', 'max' => 10),
        array('stillWorking', 'boolean'),
        array('company, workDetail, strenghts,weaknesses,congruentResume,providedCertificate, historicPension, contactPosition,immediateBoss,immediateBossContact', 'length', 'max' => 255),
        array('city, country, lastPosition, firstPosition, tel,nameOfContact,retireReason,contractType,wouldYouContractAgain,wouldYouRecomend,problemSolving,leadership,teamWork,orientationtoResults,adaptability,salaryEarned,email,bossInmediateContact', 'length', 'max' => 45),
        array('comments', 'safe'),
        array('startedOn', 'checkStartedOn'),
        array('finishedOn', 'checkFinishedOn'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, company,  city, country, tel, startedOn, finishedOn, stillWorking, bossInmediateContact, problemSolving, leadership, teamWork, orientationtoResults, adaptability, salaryEarned, lastPosition, firstPosition, comments, contactPosition,activityTypeId, email', 'safe', 'on' => 'search'),
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
        'activityType' => array(self::BELONGS_TO, 'ActivityType', 'activityTypeId'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'verificationSectionId' => 'Seccion de verificación',
        'verificationResultId' => 'Verificación',
        'company' => 'Compañía',
        'city' => 'Ciudad',
        'country' => 'País',
        'startedOn' => 'Inició en',
        'finishedOn' => 'Finalizó en',
        'stillWorking' => 'Continua trabajando',
        'lastPosition' => 'Último cargo',
        'FirstPosition' => 'Primer cargo',
        'comments' => 'Comentarios',
        'contactPosition' => 'Cargo de Contacto',
        'immediateBossContact' => 'Contacto jefe',
        'immediateBoss' => 'Jefe inmediato',
        'problemSolving' => 'Solución de Problemas',
        'leadership' => 'Puntualidad',
        'teamWork' => 'Trabajo en Equipo',
        'orientationtoResults' => 'Orientación a Resultados',
        'adaptability' => 'Adaptabilidad',
        'salaryEarned'=>'Salario Devengado,',
        'bossInmediateContact' => 'Contacto Jefe Inmediato',
        'email'=>'Email'
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
    $criteria->compare('company', $this->company, true);
    $criteria->compare('city', $this->city, true);
    $criteria->compare('country', $this->country, true);
    $criteria->compare('tel', $this->country, true);
    $criteria->compare('startedOn', $this->startedOn, true);
    $criteria->compare('finishedOn', $this->finishedOn, true);
    $criteria->compare('stillWorking', $this->stillWorking);
    $criteria->compare('bossInmediateContact', $this->bossInmediateContact);
    $criteria->compare('lastPosition', $this->lastPosition, true);
    $criteria->compare('firstPosition', $this->firstPosition, true);
    $criteria->compare('comments', $this->comments, true);
    $criteria->compare('nameOfContact', $this->nameOfContact, true);
    $criteria->compare('contactPosition', $this->contactPosition, true);
    $criteria->compare('immediateBoss',$this->immediateBoss,true);
    $criteria->compare('immediateBossContact',$this->immediateBossContact,true);
    $criteria->compare('quantitativeEvaluation', $this->quantitativeEvaluation);
    $criteria->compare('email', $this->email);

    
    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function getHasEnoughData() {
    return ($this->company != "" || $this->comments != "");
  }

  public function afterSave() {
    
    parent::afterSave();
    $this->verificationSection->save();
    return;
  }

  public static function createBasicRecords($verificationSectionId) {
    
  }

  public function checkFinishedOn($attribute, $params) {
    $ans = true;

    if ($this->finishedOn != "" && $this->finishedOn != "0000-00-00" && $this->startedOn > $this->finishedOn) {
      $this->addError('finishedOn', 'La fecha de finalización no es válida.');
      $ans = false;
    }
    return $ans;
  }

  public function checkStartedOn($attribute, $params) {
    $ans = true;
    if ($this->startedOn == "") {
      $this->addError('startedOn', 'La fecha de inicio no es válida.');
      $ans = false;
    }
    return $ans;
  }

  public function updateFromJson($verificationSection, $sectiondata){

    if(empty($sectiondata)){ //isset($dateresponse2['sections']) && is_array($dateresponse2['sections'])
      Yii::app()->user->setFlash('backgroundCheck', 'La persona asociada a este estudio no ha diligenciado ningún dato de Información Laboral en el Formulario Dinámico.');
    }else{
      if(isset($sectiondata['work'])){
        foreach($sectiondata['work'] as $sectionwork=>$data){
          if ($verificationSection->backgroundCheck->canUpdate) {
            $job = new DetailJob();
            if(sizeof($data) != 0){
              $job->verificationSectionId=$verificationSection->id;
              $job->verificationResultId=1;
            }
            if(isset($data['company'])){
              $job->company=CHtml::encode($data['company']);
            }
            if(isset($data['activity'])){
              $job->activityTypeId=CHtml::encode($data['activity']);
            }
            if(isset($data['contractType'])){
              $job->contractType=CHtml::encode($data['contractType']);
            }
            if(isset($data['start'])){
              $job->startedOn=CHtml::encode($data['start']);
            }
            if(isset($data['end'])){
              $job->finishedOn=CHtml::encode($data['end']);
            }
            if(isset($data['reasonToQuit'])){
              $job->retireReason=CHtml::encode($data['reasonToQuit']);
            }
            if(isset($data['firstPosition'])){
              $job->firstPosition=CHtml::encode($data['firstPosition']);
            }
            if(isset($data['lastPosition'])){
              $job->lastPosition=CHtml::encode($data['lastPosition']);
            }
            if(isset($data['workCountry'])){
              $job->country=CHtml::encode($data['workCountry']);
            }
            if(isset($data['workCity'])){
              $job->city=CHtml::encode($data['workCity']);
            }
            if(isset($data['companyTel'])){
              $job->tel=CHtml::encode($data['companyTel']);
            }
            if(isset($data['bossName'])){
              $job->immediateBoss=CHtml::encode($data['bossName']);
            }
            if(isset($data['immediateBossContact'])){
              $job->immediateBossContact=CHtml::encode($data['immediateBossContact']);
            }
            if(isset($data['keepworking'])){
              $job->stillWorking=CHtml::encode($data['keepworking']);
            }
            if(isset($data['nameOfContact'])){
              $job->nameOfContact=CHtml::encode($data['nameOfContact']);
            }
            if(isset($data['bossPossition'])){
              $job->contactPosition=CHtml::encode($data['bossPossition']);
            }   

            if(isset($data['afterWorkActivity'])){
              $job->comments=CHtml::encode($data['afterWorkActivity']);
            }
        }
        $job->save();
        }
      }
    }
  }

  public static function automaticCompletionJob($detailJob, $verificationSectionId){
    foreach ($detailJob as $jobDate) {
      $job = new DetailJob();
      $job->verificationSectionId=$verificationSectionId;
      $job->verificationResultId=1;
      $job->company=$jobDate->company;
      $job->city=$jobDate->city;
      $job->country=$jobDate->country;
      $job->startedOn=$jobDate->startedOn;
      $job->finishedOn=$jobDate->finishedOn;
      $job->lastPosition=$jobDate->lastPosition;
      $job->tel=$jobDate->tel;
      $job->nameOfContact=$jobDate->nameOfContact;
      $job->retireReason=$jobDate->retireReason;
      $job->workDetail=$jobDate->workDetail;
      $job->contractType=$jobDate->contractType;
      $job->strenghts=$jobDate->strenghts;
      $job->weaknesses=$jobDate->weaknesses;
      $job->wouldYouContractAgain=$jobDate->wouldYouContractAgain;
      $job->wouldYouRecomend=$jobDate->wouldYouRecomend;
      $job->comments="INFORMACIÓN EXTRAÍDA DEL ESTUDIO ANTERIOR, ".$jobDate->comments;
      $job->contactPosition=$jobDate->contactPosition;
      $job->firstPosition=$jobDate->firstPosition;
      $job->activityTypeId=$jobDate->activityTypeId;
      $job->immediateBoss=$jobDate->immediateBoss;
      $job->immediateBossContact=$jobDate->immediateBossContact;
      $job->problemSolving=$jobDate->problemSolving;
      $job->leadership=$jobDate->leadership;
      $job->teamWork=$jobDate->teamWork;
      $job->orientationtoResults=$jobDate->orientationtoResults;
      $job->adaptability=$jobDate->adaptability;
      $job->providedCertificate=$jobDate->providedCertificate;
      $job->congruentResume=$jobDate->congruentResume;
      $job->historicPension=$jobDate->historicPension;
      $job->save(); 
    }
  }

  public function getDateJobCompany($company){

      $JobcompanyList= JobCompany::model()->findAllByAttributes(['name'=>''.$company.'']);

      $detailJobcompanyList=[];
  
      foreach ($JobcompanyList as $list){
              $detailJobcompanyList[]=[
                  'name'=>$list['name'],
                  'phone'=>$list['phone'],
                  'city'=>$list['city'],
                  'country'=>$list['country'],
                  'email'=>$list['email'],
                  'contact'=>$list['contact']
              ];
      }
      return $detailJobcompanyList;
  }

}
//coment
