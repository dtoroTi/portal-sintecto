<?php

/**
 * This is the model class for table "{{DetailPersonExtras}}".
 *
 * The followings are the available columns in table '{{DetailPersonExtras}}':
 * @property integer $id
 * @property integer $verificationSectionId
 * @property string $parentingGuidelines
 * @property string $authorityManagement
 * @property string $decisionMaking
 * @property string $comunication
 * @property string $familyActivities
 * @property string $lastPositiveEvent
 * @property string $lastNegativeEvent
 * @property string $familyProject
 * @property string $personalProject
 * @property string $aspectsToImprove
 * @property string $offerExpectations
 * @property string $familyCompanyKnowledge
 * @property string $visitAttitude
 * @property string $demands
 * @property string $witness
 * @property string $knownFamilyName
 * @property string $knownFamilyRelationship
 * @property string $knownFamilyPosition
 * @property string $knownFamilyCity
 * @property integer $offerNotice
 * @property integer $offerRecomendation
 * @property string $offerWhoRecomended
 * @property string $familyMemberIncome
 * @property string $familyMemberIncome2
 * @property string $familyMemberIncome3
 * @property integer $familyMemberAmount
 * @property integer $familyMemberAmount2
 * @property integer $familyMemberAmount3
 * @property integer $income
 * @property integer $income2
 * @property integer $income3
 * @property integer $additionalIncome
 * @property integer $additionalIncome2
 * @property integer $additionalIncome3
 * @property string $additionalIncomeWhich
 * @property string $additionalIncomeWhich2
 * @property string $additionalIncomeWhich3
 * @property integer $additionalIncomeValue
 * @property integer $additionalIncomeValue2
 * @property integer $additionalIncomeValue3
 * @property integer $expendituresHousing
 * @property integer $expendituresPublicServices
 * @property integer $expendituresFood
 * @property string $expendituresTransportation
 * @property integer $expendituresStudies
 * @property integer $expendituresRecreation
 * @property integer $expendituresClothing
 * @property integer $expendituresLoans
 * @property integer $expendituresCreditCard
 * @property integer $expendituresOthers
 * @property integer $economicCar
 * @property string $economicBrand
 * @property integer $economicModel
 * @property string $economicHouse
 * @property integer $economicRiskCenters
 * @property string $economicRiskCentersWhy
 * @property integer $economicPaymentAgreements
 * @property string $economicPaymentAgreementsWhy
 * @property string $socialNetwork
 * @property string $clubsGroups
 * @property string $hobbiesActivities
 *
 * The followings are the available model relations:
 * @property VerificationSection $verificationSection
 */
class DetailPersonExtras extends SVPActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{DetailPersonExtras}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verificationSectionId', 'required'),
            array('verificationSectionId, offerNotice, offerRecomendation, familyMemberAmount, income, additionalIncome, additionalIncomeValue, familyMemberAmount2, income2, additionalIncome2, additionalIncomeValue2, familyMemberAmount3, income3, additionalIncome3, additionalIncomeValue3, expendituresHousing, expendituresPublicServices, expendituresFood, expendituresStudies, expendituresRecreation, expendituresClothing, expendituresLoans, expendituresCreditCard, expendituresOthers, economicCar, economicModel, economicRiskCenters, economicPaymentAgreements', 'numerical', 'integerOnly'=>true),

            array('parentingGuidelines, authorityManagement, decisionMaking, comunication, familyActivities, lastPositiveEvent, lastNegativeEvent, familyProject, personalProject, aspectsToImprove, offerExpectations, familyCompanyKnowledge, visitAttitude, demands, witness, economicRiskCentersWhy, economicPaymentAgreementsWhy, socialNetwork, clubsGroups, hobbiesActivities', 'length', 'max'=>500),

            array('knownFamilyName, knownFamilyRelationship, knownFamilyPosition, knownFamilyCity, offerWhoRecomended, familyMemberIncome, additionalIncomeWhich, familyMemberIncome2, additionalIncomeWhich2, familyMemberIncome3, additionalIncomeWhich3, economicBrand, economicHouse', 'length', 'max'=>100),

            array('expendituresTransportation', 'length', 'max'=>45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, verificationSectionId, parentingGuidelines, authorityManagement, decisionMaking, comunication, familyActivities, lastPositiveEvent, lastNegativeEvent, familyProject, personalProject, aspectsToImprove, offerExpectations, familyCompanyKnowledge, visitAttitude, demands, witness, knownFamilyName, knownFamilyRelationship, knownFamilyPosition, knownFamilyCity, offerNotice, offerRecomendation, offerWhoRecomended, familyMemberIncome, familyMemberAmount, income, additionalIncome, additionalIncomeWhich, additionalIncomeValue, familyMemberIncome2, familyMemberAmount2, income2, additionalIncome2, additionalIncomeWhich2, additionalIncomeValue2, familyMemberIncome3, familyMemberAmount3, income3, additionalIncome3, additionalIncomeWhich3, additionalIncomeValue3,expendituresHousing, expendituresPublicServices, expendituresFood, expendituresTransportation, expendituresStudies, expendituresRecreation, expendituresClothing, expendituresLoans, expendituresCreditCard, expendituresOthers, economicCar, economicBrand, economicModel, economicHouse, economicRiskCenters, economicRiskCentersWhy, economicPaymentAgreements, economicPaymentAgreementsWhy', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'verificationSection' => array(self::BELONGS_TO, 'VerificationSection', 'verificationSectionId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'verificationSectionId' => 'Verification Section',
            'parentingGuidelines' => 'Parenting Guidelines',
            'authorityManagement' => 'Authority Management',
            'decisionMaking' => 'Decision Making',
            'comunication' => 'Comunication',
            'familyActivities' => 'Family Activities',
            'lastPositiveEvent' => 'Last Positive Event',
            'lastNegativeEvent' => 'Last Negative Event',
            'familyProject' => 'Family Project',
            'personalProject' => 'Personal Project',
            'aspectsToImprove' => 'Aspects To Improve',
            'offerExpectations' => 'Offer Expectations',
            'familyCompanyKnowledge' => 'Family Company Knowledge',
            'visitAttitude' => 'Visit Attitude',
            'demands' => 'Demands',
            'witness' => 'Witness',
            'knownFamilyName' => 'Known Family Name',
            'knownFamilyRelationship' => 'Known Family Relationship',
            'knownFamilyPosition' => 'Known Family Position',
            'knownFamilyCity' => 'Known Family City',
            'offerNotice' => 'Offer Notice',
            'offerRecomendation' => 'Offer Recomendation',
            'offerWhoRecomended' => 'Offer Who Recomended',
            'familyMemberIncome' => 'Family Member Income',
            'familyMemberAmount' => 'Family Member Amount',
            'income' => 'Income',
            'additionalIncome' => 'Additional Income',
            'additionalIncomeWhich' => 'Additional Income Which',
            'additionalIncomeValue' => 'Additional Income Value',
            'familyMemberIncome2' => 'Family Member Income 2',
            'familyMemberAmount2' => 'Family Member Amount 2',
            'income2' => 'Income 2',
            'additionalIncome2' => 'Additional Income 2',
            'additionalIncomeWhich2' => 'Additional Income Which 2',
            'additionalIncomeValue2' => 'Additional Income Value 2',
            'familyMemberIncome3' => 'Family Member Income 3',
            'familyMemberAmount3' => 'Family Member Amount 3',
            'income3' => 'Income 3',
            'additionalIncome3' => 'Additional Income 3',
            'additionalIncomeWhich3' => 'Additional Income Which 3',
            'additionalIncomeValue3' => 'Additional Income Value 3',
            'expendituresHousing' => 'Expenditures Housing',
            'expendituresPublicServices' => 'Expenditures Public Services',
            'expendituresFood' => 'Expenditures Food',
            'expendituresTransportation' => 'Expenditures Transportation',
            'expendituresStudies' => 'Expenditures Studies',
            'expendituresRecreation' => 'Expenditures Recreation',
            'expendituresClothing' => 'Expenditures Clothing',
            'expendituresLoans' => 'Expenditures Loans',
            'expendituresCreditCard' => 'Expenditures Credit Card',
            'expendituresOthers' => 'Expenditures Others',
            'economicCar' => 'Economic Car',
            'economicBrand' => 'Economic Brand',
            'economicModel' => 'Economic Model',
            'economicHouse' => 'Economic House',
            'economicRiskCenters' => 'Economic Risk Centers',
            'economicRiskCentersWhy' => 'Economic Risk Centers Why',
            'economicPaymentAgreements' => 'Economic Payment Agreements',
            'economicPaymentAgreementsWhy' => 'Economic Payment Agreements Why',
            'socialNetwork' => 'Indague sobre la red social del evaluado tanto en su contexto de barrio como fuera de él  (amigos del trabajo, de la universidad, del colegio, etc) trate de identificar a que se dedican, capture números telefónicos, lugares de trabajo y de residencia, cada cuanto se frecuentan y que actividades comparten, que piensa la familia de su círculo de amigos?',
            'clubsGroups' => 'Pertenencia a un club, grupo juvenil, de la iglesia, cultural, deportivo,  participación en la JAC, en movimientos políticos.',
            'hobbiesActivities' => 'Hobbies, deportes y actividades de tiempo libre.', 
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('verificationSectionId',$this->verificationSectionId);
        $criteria->compare('parentingGuidelines',$this->parentingGuidelines,true);
        $criteria->compare('authorityManagement',$this->authorityManagement,true);
        $criteria->compare('decisionMaking',$this->decisionMaking,true);
        $criteria->compare('comunication',$this->comunication,true);
        $criteria->compare('familyActivities',$this->familyActivities,true);
        $criteria->compare('lastPositiveEvent',$this->lastPositiveEvent,true);
        $criteria->compare('lastNegativeEvent',$this->lastNegativeEvent,true);
        $criteria->compare('familyProject',$this->familyProject,true);
        $criteria->compare('personalProject',$this->personalProject,true);
        $criteria->compare('aspectsToImprove',$this->aspectsToImprove,true);
        $criteria->compare('offerExpectations',$this->offerExpectations,true);
        $criteria->compare('familyCompanyKnowledge',$this->familyCompanyKnowledge,true);
        $criteria->compare('visitAttitude',$this->visitAttitude,true);
        $criteria->compare('demands',$this->demands,true);
        $criteria->compare('witness',$this->witness,true);
        $criteria->compare('knownFamilyName',$this->knownFamilyName,true);
        $criteria->compare('knownFamilyRelationship',$this->knownFamilyRelationship,true);
        $criteria->compare('knownFamilyPosition',$this->knownFamilyPosition,true);
        $criteria->compare('knownFamilyCity',$this->knownFamilyCity,true);
        $criteria->compare('offerNotice',$this->offerNotice);
        $criteria->compare('offerRecomendation',$this->offerRecomendation);
        $criteria->compare('offerWhoRecomended',$this->offerWhoRecomended,true);
        $criteria->compare('familyMemberIncome',$this->familyMemberIncome,true);
        $criteria->compare('familyMemberAmount',$this->familyMemberAmount);
        $criteria->compare('income',$this->income);
        $criteria->compare('additionalIncome',$this->additionalIncome);
        $criteria->compare('additionalIncomeWhich',$this->additionalIncomeWhich,true);
        $criteria->compare('additionalIncomeValue',$this->additionalIncomeValue);
        $criteria->compare('familyMemberIncome2',$this->familyMemberIncome2,true);
        $criteria->compare('familyMemberAmount2',$this->familyMemberAmount2);
        $criteria->compare('income2',$this->income2);
        $criteria->compare('additionalIncome2',$this->additionalIncome2);
        $criteria->compare('additionalIncomeWhich2',$this->additionalIncomeWhich2,true);
        $criteria->compare('additionalIncomeValue2',$this->additionalIncomeValue2);
        $criteria->compare('familyMemberIncome3',$this->familyMemberIncome3,true);
        $criteria->compare('familyMemberAmount3',$this->familyMemberAmount3);
        $criteria->compare('income3',$this->income3);
        $criteria->compare('additionalIncome3',$this->additionalIncome3);
        $criteria->compare('additionalIncomeWhich3',$this->additionalIncomeWhich3,true);
        $criteria->compare('additionalIncomeValue3',$this->additionalIncomeValue3);
        $criteria->compare('expendituresHousing',$this->expendituresHousing);
        $criteria->compare('expendituresPublicServices',$this->expendituresPublicServices);
        $criteria->compare('expendituresFood',$this->expendituresFood);
        $criteria->compare('expendituresTransportation',$this->expendituresTransportation,true);
        $criteria->compare('expendituresStudies',$this->expendituresStudies);
        $criteria->compare('expendituresRecreation',$this->expendituresRecreation);
        $criteria->compare('expendituresClothing',$this->expendituresClothing);
        $criteria->compare('expendituresLoans',$this->expendituresLoans);
        $criteria->compare('expendituresCreditCard',$this->expendituresCreditCard);
        $criteria->compare('expendituresOthers',$this->expendituresOthers);
        $criteria->compare('economicCar',$this->economicCar);
        $criteria->compare('economicBrand',$this->economicBrand,true);
        $criteria->compare('economicModel',$this->economicModel);
        $criteria->compare('economicHouse',$this->economicHouse,true);
        $criteria->compare('economicRiskCenters',$this->economicRiskCenters);
        $criteria->compare('economicRiskCentersWhy',$this->economicRiskCentersWhy,true);
        $criteria->compare('economicPaymentAgreements',$this->economicPaymentAgreements);
        $criteria->compare('economicPaymentAgreementsWhy',$this->economicPaymentAgreementsWhy,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetailPersonExtras the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}