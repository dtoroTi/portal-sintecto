<?php

/**
 * This is the model class for table "{{DetailEducation}}".
 *
 * The followings are the available columns in table '{{DetailEducation}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property integer $educationTypeId
 * @property string $institution
 * @property string $tel
 * @property string $city
 * @property string $country
 * @property string $startedOn
 * @property string $finishedOn
 * @property string $title
 * @property integer $stillStuding
 * @property integer $didObtainDiploma
 * @property string $comments
 * @property string $verifiedOn
 * @property string $contact
 * @property int $graduationYear
 * @property string $registry
 * @property integer $folio
 * @property integer $book
 * @property integer $minute
 * @property integer $email
 * @property string $contactCharge
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 * @property Verification $verification
 * @property EducationType $educationType
 */
class DetailEducation extends SVPActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return DetailEducation the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{DetailEducation}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    $date = new DateTime("now");
    $actualYear=$date->format("Y");

    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('verificationSectionId, educationTypeId, verificationResultId', 'required'),
        array('verificationSectionId, educationTypeId, stillStuding, verificationResultId', 'numerical', 'integerOnly' => true),
        array('didObtainDiploma', 'boolean'),
        array('institution,  title, contact, email', 'length', 'max' => 255),
        array('tel, city, country', 'length', 'max' => 45),
        array('verifiedOn', 'length', 'max' => 10),
        array('startedOn, finishedOn, comments', 'safe'),
        array('registry', 'length', 'max' => 50),
        //array('registry', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>true),
        array('folio, book, minute', 'numerical', 'integerOnly'=>true),
        array('folio, book, minute', 'length', 'allowEmpty'=>true),
        array('graduationYear','numerical', 'allowEmpty'=>true, 'integerOnly'=>true,'min'=>1930,'max'=>$actualYear,'tooSmall'=>'Debe ser mayor o igual a 1930','tooBig'=>'Debe anterior o igual a '.$actualYear),
        array('contactCharge', 'length', 'max'=>255),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, verificationSectionId, verificationResultId, educationTypeId, institution, tel, city, country, startedOn, finishedOn, title, stillStuding, didObtainDiploma, comments, graduationYear, email', 'safe', 'on' => 'search'),
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
        'educationType' => array(self::BELONGS_TO, 'EducationType', 'educationTypeId'),
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
        'educationTypeId' => 'Education Type',
        'institution' => 'Institution',
        'tel' => 'Tel',
        'city' => 'City',
        'country' => 'Country',
        'startedOn' => 'Started On',
        'finishedOn' => 'Finished On',
        'title' => 'Title',
        'stillStuding' => 'Still Studing',
        'didObtainDiploma' => 'Did Obtain Diploma',
        'comments' => 'Comments',
        'graduationYear'=> 'Año de Grado',
        'registry' => 'Registry',
        'folio' => 'Folio',
        'book' => 'Book',
        'minute' => 'Minute',
        'email' => 'Email',
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
    $criteria->compare('educationTypeId', $this->educationTypeId);
    $criteria->compare('institution', $this->institution, true);
    $criteria->compare('tel', $this->tel, true);
    $criteria->compare('city', $this->city, true);
    $criteria->compare('country', $this->country, true);
    $criteria->compare('startedOn', $this->startedOn, true);
    $criteria->compare('finishedOn', $this->finishedOn, true);
    $criteria->compare('title', $this->title, true);
    $criteria->compare('stillStuding', $this->stillStuding);
    $criteria->compare('didObtainDiploma', $this->didObtainDiploma);
    $criteria->compare('comments', $this->comments, true);
    $criteria->compare('contact', $this->contact, true);
    $criteria->compare('registry',$this->registry);
    $criteria->compare('folio',$this->folio);
    $criteria->compare('book',$this->book);
    $criteria->compare('minute',$this->minute);
    $criteria->compare('email',$this->email);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function getHasEnoughData() {
    return ($this->institution != "");
  }

  public function afterSave() {
    
    parent::afterSave();
    $this->verificationSection->save();
    return;
  }

  public static function createBasicRecords($verificationSectionId) {
    
  }

  public static function updateFromJson($verificationSection, $sectiondata){

    if(isset($sectiondata['icfes']['icfesYear'])){
      $comentYear='Año ICFES: '.CHtml::encode($sectiondata['icfes']['icfesYear']);
    }else{
      $comentYear='';
    }

    if(isset($sectiondata['icfes']['idIcfes'])){
      $comentID=', ID ICFES: '.CHtml::encode($sectiondata['icfes']['idIcfes']);
    }else{
      $comentID='';
    }

    if(isset($sectiondata['icfes']['icferesult'])){
      $comentAC=', Código AC: '.CHtml::encode($sectiondata['icfes']['icferesult']);
    }else{
      $comentAC='';
    }

    if(isset($sectiondata['Tarjeta Profesional']['professionalcard'])){
      $ProfCard='Cuenta con Tarjeta Profesional: '.CHtml::encode($sectiondata['Tarjeta Profesional']['professionalcard']);
    }else{
      $ProfCard='';
    }

    if(isset($sectiondata['Tarjeta Profesional']['numprofessionalcard'])){
      $ProfCardID=', Número: '.CHtml::encode($sectiondata['Tarjeta Profesional']['numprofessionalcard']);
    }else{
      $ProfCardID='';
    }

    if(isset($sectiondata['Tarjeta Profesional']['professionalcardYear'])){
      $ProfCardYear=', Vigencia: '.CHtml::encode($sectiondata['Tarjeta Profesional']['professionalcardYear']);
    }else{
      $ProfCardYear='';
    }

    foreach($sectiondata['study'] as $sectionEducation=>$data){
        $education = new DetailEducation();

        if(sizeof($data) != 0){
          $education->verificationSectionId=$verificationSection->id;
          $education->verificationResultId=1;
        }
        if(isset($data['instituion'])){
          $education->institution=CHtml::encode($data['instituion']);
        }
        if(isset($data['academicLevel'])){
          if($data['academicLevel']==2){
            $education->comments=$comentYear.$comentID.$comentAC."\n".$ProfCard.$ProfCardID.$ProfCardYear;
          }
          $education->educationTypeId=CHtml::encode($data['academicLevel']);
        }
        if(isset($data['title'])){
          $education->title=CHtml::encode($data['title']);
        }
        if(isset($data['graduated'])){
          $education->didObtainDiploma=CHtml::encode($data['graduated']);
        }
        if(isset($data['graduationDate'])){
          $dateAct = new \DateTime($data['graduationDate']); 
          $year=$dateAct->format('Y');
          $education->graduationYear=$year;
        }
        if(isset($data['studyCountry'])){
          $education->country=CHtml::encode($data['studyCountry']);
        }
        if(isset($data['studyCity'])){
          $education->city=CHtml::encode($data['studyCity']);
        }
        if(isset($data['keepstudying'])){
          $education->stillStuding=CHtml::encode($data['keepstudying']);
        }
      $education->save(); 
    }
  }

  public static function automaticCompletionEd($detailEducation, $verificationSectionId){
    foreach ($detailEducation as $educationDate) {
      $education = new DetailEducation();
      $education->verificationSectionId=$verificationSectionId;
      $education->verificationResultId=1;
      $education->educationTypeId=$educationDate->educationTypeId;
      $education->institution=$educationDate->institution;
      $education->tel=$educationDate->tel;
      $education->city=$educationDate->city;
      $education->country=$educationDate->country;
      $education->startedOn=$educationDate->startedOn;
      $education->finishedOn=$educationDate->finishedOn;
      $education->title=$educationDate->title;
      $education->stillStuding=$educationDate->stillStuding;
      $education->didObtainDiploma=$educationDate->didObtainDiploma;
      $education->gotTitle=$educationDate->gotTitle;
      $education->comments="INFORMACIÓN EXTRAÍDA DEL ESTUDIO ANTERIOR, ".$educationDate->comments;
      $education->contact=$educationDate->contact;
      $education->graduationYear=$educationDate->graduationYear;
      $education->registry=$educationDate->registry;
      $education->folio=$educationDate->folio;
      $education->book=$educationDate->book;
      $education->minute=$educationDate->minute;
      $education->save(); 
    }
  }

  public function getDateEduInstitute($institution){

    $EducationList= EducationalInstitution::model()->findAllByAttributes(['name'=>$institution]);

    $detailEducationListList=[];

    foreach ($EducationList as $list){
            $detailEducationListList[]=[
                'name'=>$list['name'],
                'phone'=>$list['phone'],
                'city'=>$list['city'],
                'country'=>$list['country'],
                'email'=>$list['email'],
                'contact'=>$list['contact']
            ];
    }
    return $detailEducationListList;
}

}
//coment
