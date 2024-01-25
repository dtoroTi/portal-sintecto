<?php

/**
 * This is the model class for table "{{VerificationSectionType}}".
 *
 * The followings are the available columns in table '{{VerificationSectionType}}':
 * @property integer $id
 * @property string $name
 * @property string $nick
 * @property string $class
 * @property string $fieldId
 * @property string $description
 * @property integer $showOrder
 * @property string $xmlQuestion
 * @property string $questionFormat XML PDF Print format 
 * @property float   $cost
 * @property float   $price
 * @property string $htmlSection This is the HTML Section to print in PDF
 * @property int $verificationSectionGroupId groupId
 * @property string $component
 * @property integer $hasPersonalExtras
 * @property string $bussinessLineSeccion
 * 
 * 
 * The followings are the available model relations:
 * @property VerificationInProduct[] $verificationInProducts
 * @property VerificationSection[] $verificationSections
 * @property VerificationSectionGroup $verificationSectionGroup
 */
class VerificationSectionType extends CActiveRecord {

    const DOCUMENTS = 1;
    const EDUCATION = 2;
    const JOBS = 3;
    const REGISTER = 4;
    const HOUSING = 5;
    const PERSONS_IN_HOUSE = 6;
    const FAMILY = 7;
    const REFERENCES = 8;
    const FINANCIAL = 9;
    const POLYGRAPH = 10;
    const GENERAL_HEALTH = 11;
    const OTHER_INFORMATION = 12;
    const DETAIL_COMPANY_CUSTOMER = 13;
    const DETAIL_COMPANY_PROVIDER = 14;
    const DETAIL_SHAREHOLDER = 15;
    const DETAIL_COMPANY_FINANCE = 16;
    const DETAIL_COMPANY_VISIT = 17;
    const DETAIL_COMPANY_EMPLOYEE = 18;
    const DETAIL_QUESTION_CLASS = 'DetailQuestion';
    const DETAIL_COMPANY_FINANTIAL_ANALYS = 50;

    const DETAIL_AUDIT = 80;
    const DETAIL_AUDIT_ATTENDANCE = 81;

    

    public function getIsXmlSection() {
        return ($this->class == 'XmlSection' );
    }

    public function getIsHtmlSection() {
        return ($this->class == 'HtmlSection');
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VerificationSectionType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{VerificationSectionType}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('showOrder, hasPersonalExtras', 'numerical', 'integerOnly' => true),
            array('name, bussinessLineSeccion, nick, class,fieldId', 'length', 'max' => 45),
            array('component', 'length', 'max' => 10),
            array('description', 'safe'),
            array('cost,price', 'numerical'),
            array('xmlQuestion,questionFormat', 'validateXML'),
            //array('verificationSectionGroupId', 'numerical', 'integerOnly' => true, 'allowNull'=> true),
            array('htmlSection,verificationSectionGroupId', 'safe'),
            array('availableInOffline', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, bussinessLineSeccion, nick, class, fieldId, description, showOrder, verificationSectionGroupId,component,hasPersonalExtras', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationInProducts' => array(self::HAS_MANY, 'VerificationInProduct', 'verificationSectionTypeId'),
            'verificationSections' => array(self::HAS_MANY, 'VerificationSection', 'verificationSectionTypeId'),
            'verificationSectionGroup'=> array(self::BELONGS_TO, 'VerificationSectionGroup', 'verificationSectionGroupId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
	    'nick' => 'Nick',
            'class' => 'Class',
            'description' => 'Description',
            'showOrder' => 'Show Order',
            'XmlQuestion' => 'Formato de Preguntas',
            'HtmlQuestion' => 'Formato de Sección',
            'QuestionFormat' => 'Formato de Impresión',
            'availableInOffline' => 'Disponible Offline',
            'verificationSectionGroupId'=> 'Grupo',
            'component'=> 'Componente',
            'hasPersonalExtras' => 'Has Personal Extras',
            'bussinessLineSeccion' => 'Linea Neg Seccion',
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
	    $criteria->compare('nick', $this->nick, true);
        $criteria->compare('bussinessLineSeccion', $this->bussinessLineSeccion, true);
        $criteria->compare('class', $this->class, true);
        $criteria->compare('fieldId', $this->fieldId, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('showOrder', $this->showOrder);
        $criteria->compare('verificationSectionGroupId',$this->verificationSectionGroupId,true);
        $criteria->compare('component',$this->component,true);
        $criteria->compare('hasPersonalExtras',$this->hasPersonalExtras);
        


        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
            ),
        ));
    }

    public function getControllerName() {
        return strtolower($this->class[0]) . substr($this->class, 1);
    }

    public function scopes() {
        return array(
            'questionType' => array(
                'condition' => 'class=:class',
                'params' => array(':class' => VerificationSectionType::DETAIL_QUESTION_CLASS),
            ),
        );
    }

    public function validateXml($attribute, $params) {
        libxml_use_internal_errors(true);
        $ans = false;
        $xml = simplexml_load_string($this->$attribute);
        if ($xml === false) {
            foreach (libxml_get_errors() as $error) {
                $this->addError($attribute, $error->message);
            }
        } else {
            $ans = true;
        }
        libxml_use_internal_errors(false);
        return $ans;
    }

    function getQuestionsXmlFormat() {
        return simplexml_load_string($this->xmlQuestion);
    }

    function getQuestionsPDFXml() {
        return simplexml_load_string($this->questionFormat);
    }

    function getCanDelete() {
        return false;
//        return $ans;
    }

    static public function findAllAvailable($isPdfReportType) {

        $criteria = new CDbCriteria;

        if ($isPdfReportType) {
            $criteria->addCondition('class=:html');
        } else {
            $criteria->addCondition('class<>:html');            
        }
        $criteria->params=array(':html'=>'HtmlSection');

        $criteria->order = 't.showOrder';
        
        $ans=VerificationSectionType::model()->findAll($criteria);

        return $ans;
    }

}
