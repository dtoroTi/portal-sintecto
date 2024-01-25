<?php

/**
 * This is the model class for table "{{DetailShareholder}}".
 *
 * The followings are the available columns in table '{{DetailShareholder}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property integer $verificationResultId
 * @property string $firstName
 * @property string $lastName
 * @property string $idNumber
 * @property string $participation
 * @property integer $isCompany
 * @property string $comments
 * 
 * @property integer $managepublicresources
 * @property integer $prominentpublicfunctions
 * @property integer $OfacYOnu
 * @property integer $Boe
 * @property integer $entControl
 * @property integer $entPoliciales
 * @property integer $otrosBoletines
 * @property integer $empresasFicticias
 * @property integer $compliance
 * @property integer $bDeudoresMorosos
 * @property integer $laft
 *
 * The followings are the available model relations:
 * @property VerificationResult $verificationResult
 * @property VerificationSection $verificationSection
 */
class DetailShareholder extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{DetailShareholder}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId, verificationResultId', 'required'),
            array('verificationSectionId, verificationResultId, isCompany', 'numerical', 'integerOnly' => true),
            array('firstName, lastName, idNumber,position', 'length', 'max' => 255),
            array('participation', 'length', 'max' => 45),
            array('appearsInClintonsList,hasAdverseReference','boolean'),
            array('comments', 'safe'),
            array('managepublicresources','safe'),
            array('prominentpublicfunctions','safe'),
            array('OfacYOnu','safe'),
            array('Boe','safe'),
            array('entControl','safe'),
            array('entPoliciales','safe'),
            array('otrosBoletines','safe'),
            array('empresasFicticias','safe'),
            array('compliance','safe'),
            array('bDeudoresMorosos','safe'),
            array('laft,','safe'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, verificationResultId, firstName, lastName, idNumber, participation, isCompany,'.
                'managepublicresources, prominentpublicfunctions, OfacYOnu, Boe, entControl, entPoliciales, otrosBoletines, empresasFicticias, compliance, laft,',
                'safe', 'on' => 'search'),
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
            'verificationResultId' => 'Verification Result',
            'firstName' => 'Nombre',
            'lastName' => 'Apellido/Empresa',
            'idNumber' => 'Num. ID',
            'participation' => 'Participación',
            'isCompany' => 'Es Empresa',
            'comments' => 'Comentarios',
            'position' => 'Cargo',
            'appearsInClintonsList'=>'Esta en Lista Clinton',
            'hasAdverseReference'=>'Adversos',
            'bDeudoresMorosos'=>'Boletín de Deudores Morosos',
            
            'managepublicresources' => 'Maneja o administra Recursos Públicos',
            'prominentpublicfunctions' => 'En los últimos dos años ha desempeñado funciones públicas destacadas',
            
            'OfacYOnu' => 'Reconocimiento público (OFAC-Clinton, ONU y Reino Unido)',
            'Boe' => 'Reconocimiento normativo de Buenas prácticas (BOE)',
            'entControl' => 'Boletines de Entidades de Control (Fiscalía, Procuraduría, Contraloría)',
            'entPoliciales' => 'Boletines de Entidades Policiales (Policía, DEA, Interpol, FBI, Unión Europea)',
            'otrosBoletines' => 'Otros boletines (Presidencia, SuperFinanciera, Embajadas, Fuerzas Militares)',
            'empresasFicticias' => 'Empresas Ficticias',
            'compliance' => 'Alerta Compliance',
            'laft' => 'Alerta LAFT',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('verificationSectionId', $this->verificationSectionId);
        $criteria->compare('verificationResultId', $this->verificationResultId);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('idNumber', $this->idNumber, true);
        $criteria->compare('participation', $this->participation, true);
        $criteria->compare('isCompany', $this->isCompany);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('position', $this->comments, true);        
        $criteria->compare('appearsInClintonsList', $this->appearsInClintonsList, true);
        $criteria->compare('hasAdverseReference', $this->hasAdverseReference, true);

        $criteria->compare('managepublicresources', $this->managepublicresources, true);
        $criteria->compare('prominentpublicfunctions', $this->prominentpublicfunctions, true);
        $criteria->compare('OfacYOnu', $this->OfacYOnu, true);
        $criteria->compare('Boe', $this->Boe, true);
        $criteria->compare('entControl', $this->entControl, true);
        $criteria->compare('entPoliciales', $this->entPoliciales, true);
        $criteria->compare('otrosBoletines', $this->otrosBoletines, true);
        $criteria->compare('empresasFicticias', $this->empresasFicticias, true);
        $criteria->compare('compliance', $this->compliance, true);
        $criteria->compare('bDeudoresMorosos', $this->compliance, true);
        $criteria->compare('laft', $this->laft, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailShareholder the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHasEnoughData() {
        return (($this->idNumber != "") && ($this->lastName != ""));
    }

    public function afterSave() {
        parent::afterSave();
        $this->verificationSection->save();
        return;
    }

    public function getName() {
        return ($this->firstName . " " . $this->lastName);
    }

    public static function createBasicRecords($verificationSectionId) {

    }

    public function updateFromJson($verificationSection, $sectiondata){

        if(empty($sectiondata)){ //isset($dateresponse2['sections']) && is_array($dateresponse2['sections'])
          Yii::app()->user->setFlash('backgroundCheck', 'La persona asociada a este estudio no ha diligenciado ningún dato de socios y representantes.');
        }else{
          foreach($sectiondata['partnersRep'] as $sectionpartnersRep=>$data){
              $partnersRep = new DetailShareholder();

              if(sizeof($data) != 0){
                $partnersRep->verificationSectionId=$verificationSection->id;
                $partnersRep->verificationResultId=1;
              }
              if(isset($data['RepfirstName'])){
                $partnersRep->firstName=CHtml::encode($data['RepfirstName']);
              }
              if(isset($data['ReplastName'])){
                $partnersRep->lastName=CHtml::encode($data['ReplastName']);
              }
              if(isset($data['idNumber'])){
                $partnersRep->idNumber=CHtml::encode($data['idNumber']);
              }
              if(isset($data['participation'])){
                $partnersRep->participation=CHtml::encode($data['participation']);
              }
              if(isset($data['isCompany'])){
                $partnersRep->isCompany=CHtml::encode($data['isCompany']);
              }
              if(isset($data['position'])){
                $partnersRep->position=CHtml::encode($data['position']);
              }
          $partnersRep->save();
          }
        }
    }
    
}
