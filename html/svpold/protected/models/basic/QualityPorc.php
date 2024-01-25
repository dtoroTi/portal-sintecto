<?php

/**
 * This is the model class for table "{{QualityPorc}}".
 *
 * The followings are the available columns in table '{{QualityPorc}}':
 * @property integer $id
 * @property double $valueSection
 * @property double $valuePQR
 * @property double $valuePNC
 */
class QualityPorc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{QualityPorc}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valueSection, valuePQR, valuePNC', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, valueSection, valuePQR, valuePNC', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'valueSection' => 'Valor Secciones',
			'valuePQR' => 'Valor PQR',
			'valuePNC' => 'Valor PNC',
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
		$criteria->compare('valueSection',$this->valueSection);
		$criteria->compare('valuePQR',$this->valuePQR);
		$criteria->compare('valuePNC',$this->valuePNC);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QualityPorc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function getAllproductivityonTime($from, $until,  $idUser) {

        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") <= DATE_FORMAT(t.dateLimitQuality,"%Y-%m-%d") AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllproductivityonTime= BackgroundCheck::model()->count($criteria);
 
        $productivityonTime=[];
        $productivityonTime[]=[
            'CantProducTiempo'=>$AllproductivityonTime
        ];

        return $productivityonTime;
    }

    public function getAllproductivityOutofTime($from, $until,  $idUser) {
        
        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND (DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") > DATE_FORMAT(t.dateLimitQuality,"%Y-%m-%d") OR DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL) AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllproductivityOutofTime= BackgroundCheck::model()->count($criteria);
 
        $productivityOutofTime=[];
        $productivityOutofTime[]=[
            'CantProducFueradeTiempo'=>$AllproductivityOutofTime
        ];
        return $productivityOutofTime;
    }
    
    public function getAllOpportunityStudies($from, $until,  $idUser) {

        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") < DATE_FORMAT(t.dateLimitQuality,"%Y-%m-%d") AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllopportunityStudies= BackgroundCheck::model()->count($criteria);
 
        $opportunityStudies=[];
        $opportunityStudies[]=[
            'CantEstOportunidad'=>$AllopportunityStudies
        ];
        return $opportunityStudies;
    }

    public function getAllTotalStudies($from, $until,  $idUser) {

        $criteria = new CDbCriteria;

        $criteria->join='JOIN ses_Customer ct ON ct.id=t.customerId
            JOIN ses_AssignedUser ass ON ass.backgroundCheckId=t.id
            JOIN ses_User us ON us.id=ass.userId
            JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
            JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId';
        $criteria->addCondition('us.id=:userId AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") between :from and :until AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"');
        $criteria->params=[':from'=>$from, ':until'=>$until, ':userId'=>$idUser];

        $AllStudies= BackgroundCheck::model()->count($criteria);
 
        $totalStudies=[];
        $totalStudies[]=[
            'CantidadEstudios'=>$AllStudies
        ];
        return $totalStudies;
    }

    public function getgoalUser($idUser) {

        $goaluser = User::model()->findByPk($idUser);
        return $goaluser->goal;
    }

    public function getAllQualityStudies($from, $until,  $idUser) {
        
        $query_A = 'SELECT us.id, ct.name AS nombre, us.username AS Usuario,  COUNT(DISTINCT bc.code) AS CantEstudios,
        SUM(IF(bc.qualityLaboral=1 AND vfst.NAME="Laboral", "1","0")) AS Laboral, SUM(IF(bc.qualityLaboralPQR=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPQR, 
        SUM(IF(bc.qualityLaboralPNC=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPNC,
        SUM(IF(bc.qualityEducation=1 AND vfst.NAME="Académico", "1","0")) AS Academico, SUM(IF(bc.qualityEducationPQR=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPQR, 
        SUM(IF(bc.qualityEducationPNC=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPNC,
        SUM(IF(bc.qualityFinanlcial=1 AND vfst.NAME="Financiero", "1","0")) AS Financiero, SUM(IF(bc.qualityFinanlcialPQR=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPQR, 
        SUM(IF(bc.qualityFinanlcialPNC=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPNC,
        SUM(IF(bc.qualityAdverse=1 AND vfst.NAME="Adversos", "1","0")) AS Adversos, SUM(IF(bc.qualityAdversePQR=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPQR, 
        SUM(IF(bc.qualityAdversePNC=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPNC,
        SUM(IF(bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS Visita, SUM(IF(bc.qualityVisitPQR=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS VisitaPQR, 
        SUM(IF(bc.qualityVisitPNC=1 AND vfst.NAME="Personas en la Vivienda", "1","0"))  AS VisitaPNC, 
        SUM(IF(bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo", "1","0")) AS Poligrafo, SUM(IF(bc.qualityPolygraphPQR=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPQR, 
        SUM(IF(bc.qualityPolygraphPNC=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPNC,
        SUM(IF(bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS Pruebas_Psicotecnicas, SUM(IF(bc.qualityTestPQR=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPQR, 
        SUM(IF(bc.qualityTestPNC=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPNC,
        SUM(IF(bc.qualityReference=1 AND vfst.NAME="Referencias", "1","0")) AS Reference, SUM(IF(bc.qualityReferencePQR=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePQR,
        SUM(IF(bc.qualityReferencePNC=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePNC
        FROM ses_BackgroundCheck bc
        JOIN ses_Customer ct ON ct.id=bc.customerId
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id
        JOIN ses_User us ON us.id=ass.userId
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId
        WHERE us.id="'.$idUser.'" AND ((bc.qualityEducation=1 AND vfst.NAME="Académico")
        OR (bc.qualityLaboral=1 AND vfst.NAME="Laboral")
        OR (bc.qualityFinanlcial=1 AND vfst.NAME="Financiero")
        OR (bc.qualityAdverse=1 AND vfst.NAME="Adversos")
        OR (bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda")
        OR (bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo")
        OR (bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas")
        OR (bc.qualityReference=1 AND vfst.NAME="Referencias"))
        AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        GROUP BY us.username';
        $qualityStudies = Yii::app()->db->createCommand($query_A)->queryAll();
        return $qualityStudies;
    }
    
    public function getqualityPorc(){
        $qualityPorc = QualityPorc::model()->findAll();
        return $qualityPorc;
    }

    public function getcsvProductOpport($from, $until){
        $query_A = 'SELECT ct.NAME AS Nombre, us.username AS Usuario, us.goal AS Meta,
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<=DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0")) atiempo,
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0") OR IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL, "1", "0")) fueratiempo,
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0")) oportunidad
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id
        JOIN ses_User us ON us.id=ass.userId
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId
        WHERE DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"
        GROUP BY ct.NAME, us.username, us.goal
        ORDER BY us.username ASC';
        $csvProductOpports = Yii::app()->db->createCommand($query_A)->queryAll();
        return $csvProductOpports;
    }

    public function getcsvOffTime($from, $until){


        $query_A = 'SELECT ct.NAME AS Nombre, us.username AS Usuario, vfst.name as Seccion, bc.code AS Codigo       
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id
        JOIN ses_User us ON us.id=ass.userId
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId
        WHERE DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91" AND (IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0") OR IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL, "1", "0"))
        ORDER BY bc.code ASC';
        $csvOffTime = Yii::app()->db->createCommand($query_A)->queryAll();
        return $csvOffTime;
    }

    public function getcsvQuality($from, $until){
        $query_A='SELECT ct.name AS nombre, us.username AS Usuario, bc.CODE AS Referencia, 
        SUM(IF(bc.qualityLaboral=1 AND vfst.NAME="Laboral", "1","0")) AS Laboral, SUM(IF(bc.qualityLaboralPQR=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPQR, 
        SUM(IF(bc.qualityLaboralPNC=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPNC, 
        SUM(IF(bc.qualityEducation=1 AND vfst.NAME="Académico", "1","0")) AS Academico, SUM(IF(bc.qualityEducationPQR=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPQR, 
        SUM(IF(bc.qualityEducationPNC=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPNC, 
        SUM(IF(bc.qualityFinanlcial=1 AND vfst.NAME="Financiero", "1","0")) AS Financiero, SUM(IF(bc.qualityFinanlcialPQR=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPQR, 
        SUM(IF(bc.qualityFinanlcialPNC=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPNC, 
        SUM(IF(bc.qualityAdverse=1 AND vfst.NAME="Adversos", "1","0")) AS Adversos, SUM(IF(bc.qualityAdversePQR=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPQR, 
        SUM(IF(bc.qualityAdversePNC=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPNC, 
        SUM(IF(bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS Visita, SUM(IF(bc.qualityVisitPQR=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS VisitaPQR, 
        SUM(IF(bc.qualityVisitPNC=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS VisitaPNC, 
        SUM(IF(bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo", "1","0")) AS Poligrafo, SUM(IF(bc.qualityPolygraphPQR=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPQR, 
        SUM(IF(bc.qualityPolygraphPNC=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPNC, 
        SUM(IF(bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS Pruebas_Psicotecnicas, 
        SUM(IF(bc.qualityTestPQR=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPQR, 
        SUM(IF(bc.qualityTestPNC=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPNC, 
        SUM(IF(bc.qualityReference=1 AND vfst.NAME="Referencias", "1","0")) AS Reference, SUM(IF(bc.qualityReferencePQR=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePQR,
        SUM(IF(bc.qualityReferencePNC=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePNC
        FROM ses_BackgroundCheck bc JOIN ses_Customer ct 
        ON ct.id=bc.customerId JOIN ses_AssignedUser ass 
        ON ass.backgroundCheckId=bc.id JOIN ses_User us 
        ON us.id=ass.userId JOIN ses_VerificationSection vfs 
        ON vfs.id=ass.verificationSectionId JOIN ses_VerificationSectionType vfst 
        ON vfst.id=vfs.verificationSectionTypeId 
        WHERE ((bc.qualityEducation=1 AND vfst.NAME="Académico") OR (bc.qualityLaboral=1 AND vfst.NAME="Laboral") 
        OR (bc.qualityFinanlcial=1 AND vfst.NAME="Financiero") 
        OR (bc.qualityAdverse=1 AND vfst.NAME="Adversos") 
        OR (bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda") 
        OR (bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo") 
        OR (bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas")
        OR (bc.qualityReference=1 AND vfst.NAME="Referencias")) 
        AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        GROUP BY  bc.CODE, ct.name, us.username
        ORDER BY us.username ASC';
        $csvQuality = Yii::app()->db->createCommand($query_A)->queryAll();
        return $csvQuality;
    }

    public function getcsvOperations($from, $until){
        $query_A='SELECT us.firstName, us.lastName , us.username AS Usuario, us.goal AS Meta,
        COUNT(bc.code) AS CantEstudios, 
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<=DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0")) atiempo,
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0") OR IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL, "1", "0")) fueratiempo,
        SUM(IF(bc.qualityLaboral=1 AND vfst.NAME="Laboral", "1","0")) AS Laboral, SUM(IF(bc.qualityLaboralPQR=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPQR, 
        SUM(IF(bc.qualityLaboralPNC=1 AND vfst.NAME="Laboral", "1","0")) AS LaboralPNC, 
        SUM(IF(bc.qualityEducation=1 AND vfst.NAME="Académico", "1","0")) AS Academico, SUM(IF(bc.qualityEducationPQR=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPQR, 
        SUM(IF(bc.qualityEducationPNC=1 AND vfst.NAME="Académico", "1","0")) AS AcademicoPNC, 
        SUM(IF(bc.qualityFinanlcial=1 AND vfst.NAME="Financiero", "1","0")) AS Financiero, SUM(IF(bc.qualityFinanlcialPQR=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPQR, 
        SUM(IF(bc.qualityFinanlcialPNC=1 AND vfst.NAME="Financiero", "1","0")) AS FinancieroPNC, 
        SUM(IF(bc.qualityAdverse=1 AND vfst.NAME="Adversos", "1","0")) AS Adversos, SUM(IF(bc.qualityAdversePQR=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPQR, 
        SUM(IF(bc.qualityAdversePNC=1 AND vfst.NAME="Adversos", "1","0")) AS AdversosPNC, 
        SUM(IF(bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS Visita, SUM(IF(bc.qualityVisitPQR=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS VisitaPQR, 
        SUM(IF(bc.qualityVisitPNC=1 AND vfst.NAME="Personas en la Vivienda", "1","0")) AS VisitaPNC, 
        SUM(IF(bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo", "1","0")) AS Poligrafo, SUM(IF(bc.qualityPolygraphPQR=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPQR, 
        SUM(IF(bc.qualityPolygraphPNC=1 AND vfst.NAME="Polígrafo", "1","0")) AS PoligrafoPNC, 
        SUM(IF(bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS Pruebas_Psicotecnicas, 
        SUM(IF(bc.qualityTestPQR=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPQR, 
        SUM(IF(bc.qualityTestPNC=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0")) AS PruebaPNC,
        SUM(IF(bc.qualityReference=1 AND vfst.NAME="Referencias", "1","0")) AS Reference, SUM(IF(bc.qualityReferencePQR=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePQR,
        SUM(IF(bc.qualityReferencePNC=1 AND vfst.NAME="Referencias", "1","0")) AS ReferencePNC
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId 
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id 
        JOIN ses_User us ON us.id=ass.userId 
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId 
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId 
        WHERE DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        AND vfst.id!="24" AND vfst.id!="8"  AND vfst.id!="91"
        GROUP BY us.username';
        $csvOperations = Yii::app()->db->createCommand($query_A)->queryAll();
        return $csvOperations;
    }

    public function getcsvForUser($from, $until, $idUser){
        $query_A='SELECT ct.NAME AS Nombre, us.username AS Usuario, bc.code AS referencia, ass.finishedAt AS fecha_final, vfst.name AS NombreSeccion,
        IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<=DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0") atiempo, 
        IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0") 
        OR IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL, "1", "0") fueratiempo, 
        IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0") oportunidad
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id
        JOIN ses_User us ON us.id=ass.userId
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId
        WHERE us.id="'.$idUser.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'" AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"
        ORDER BY us.username ASC';
        $csvForUser = Yii::app()->db->createCommand($query_A)->queryAll();
        return $csvForUser;
    }

    public function getQualityResult($from, $until,  $idUser, $name){

        $query_A='SELECT ct.name AS nombre, bc.code,
        IF(bc.qualityLaboral=1 AND vfst.NAME="Laboral", "1","0") AS Laboral, IF(bc.qualityLaboralPQR=1 AND vfst.NAME="Laboral", "1","0") AS LaboralPQR, IF(bc.qualityLaboralPNC=1 AND vfst.NAME="Laboral", "1","0") AS LaboralPNC, bc.qualitytextLaboral,
        IF(bc.qualityEducation=1 AND vfst.NAME="Académico", "1","0") AS Academico,IF(bc.qualityEducationPQR=1 AND vfst.NAME="Académico", "1","0") AS AcademicoPQR, IF(bc.qualityEducationPNC=1 AND vfst.NAME="Académico", "1","0") AS AcademicoPNC, bc.qualitytextEducation,
        IF(bc.qualityFinanlcial=1 AND vfst.NAME="Financiero", "1","0") AS Financiero, IF(bc.qualityFinanlcialPQR=1 AND vfst.NAME="Financiero", "1","0") AS FinancieroPQR,IF(bc.qualityFinanlcialPNC=1 AND vfst.NAME="Financiero", "1","0") AS FinancieroPNC, bc.qualitytextFinancial, 
        IF(bc.qualityAdverse=1 AND vfst.NAME="Adversos", "1","0") AS Adversos, IF(bc.qualityAdversePQR=1 AND vfst.NAME="Adversos", "1","0") AS AdversosPQR,
        IF(bc.qualityAdversePNC=1 AND vfst.NAME="Adversos", "1","0") AS AdversosPNC, bc.qualitytextAdverse,
		  IF(bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda", "1","0") AS Visita, IF(bc.qualityVisitPQR=1 AND vfst.NAME="Personas en la Vivienda", "1","0") AS VisitaPQR, IF(bc.qualityVisitPNC=1 AND vfst.NAME="Personas en la Vivienda", "1","0") AS VisitaPNC, bc.qualitytextVisit,
		  IF(bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo", "1","0") AS Poligrafo, IF(bc.qualityPolygraphPQR=1 AND vfst.NAME="Polígrafo", "1","0") AS PoligrafoPQR, IF(bc.qualityPolygraphPNC=1 AND vfst.NAME="Polígrafo", "1","0") AS PoligrafoPNC,  bc.qualitytextPolygraph,
        IF(bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0") AS Pruebas_Psicotecnicas, IF(bc.qualityTestPQR=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0") AS PruebaPQR, IF(bc.qualityTestPNC=1 AND vfst.NAME="Pruebas Psicotécnicas", "1","0") AS PruebaPNC, bc.qualitytextTest,
        IF(bc.qualityReference=1 AND vfst.NAME="Referencias", "1","0") AS Reference, IF(bc.qualityReferencePQR=1 AND vfst.NAME="Referencias", "1","0") AS ReferencePQR, IF(bc.qualityReferencePNC=1 AND vfst.NAME="Referencias", "1","0") AS ReferencePNC, bc.qualitytextReference
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId 
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id 
        JOIN ses_User us ON us.id=ass.userId 
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId 
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId 
        WHERE us.id="'.$idUser.'"
        AND ((bc.qualityEducation=1 AND vfst.NAME="Académico") OR (bc.qualityLaboral=1 AND vfst.NAME="Laboral") OR (bc.qualityFinanlcial=1 AND vfst.NAME="Financiero") OR (bc.qualityAdverse=1 AND vfst.NAME="Adversos") OR (bc.qualityVisit=1 AND vfst.NAME="Personas en la Vivienda") OR (bc.qualityPolygraph=1 AND vfst.NAME="Polígrafo") OR (bc.qualityTest=1 AND vfst.NAME="Pruebas Psicotécnicas") OR (bc.qualityReference=1 AND vfst.NAME="Referencias")) AND 
        DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        AND vfst.name="'.$name.'"';
        $qualitySectionDetail = Yii::app()->db->createCommand($query_A)->queryAll();
        return $qualitySectionDetail;
    }

    public function getFinishProccess($from, $until){

        $query_A='SELECT us.username AS Usuario,
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<=DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0")) atiempo, 
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0")
        OR IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d") IS NULL, "1", "0")) fueratiempo, 
        SUM(IF(DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<DATE_FORMAT(bc.dateLimitQuality,"%Y-%m-%d"), "1","0")) oportunidad,
        COUNT(bc.code)  AS total_estudios
        FROM ses_BackgroundCheck bc 
        JOIN ses_Customer ct ON ct.id=bc.customerId
        JOIN ses_AssignedUser ass ON ass.backgroundCheckId=bc.id
        JOIN ses_User us ON us.id=ass.userId
        JOIN ses_VerificationSection vfs ON vfs.id=ass.verificationSectionId
        JOIN ses_VerificationSectionType vfst ON vfst.id=vfs.verificationSectionTypeId
        WHERE DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")>="'.$from.'" AND DATE_FORMAT(ass.finishedAt,"%Y-%m-%d")<="'.$until.'"
        AND vfst.id!="24" AND vfst.id!="8" AND vfst.id!="91"
        GROUP BY us.username
        ORDER BY us.username ASC';
        $AllfinishProccess = Yii::app()->db->createCommand($query_A)->queryAll();
        return $AllfinishProccess;
    }
}

