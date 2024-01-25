<?php

use CandidateCalls as GlobalCandidateCalls;

/**
 * This is the model class for table "{{CandidateCalls}}".
 *
 * The followings are the available columns in table '{{CandidateCalls}}':
 * @property integer $id
 * @property integer $backgroundcheckId
 * @property integer $callManagerId
 * @property integer $callReschedulingManagerId
 * @property string $dateCreate
 * @property string $dateRegistrationEffective
 * @property string $dateRegistrationNotEffective
 * @property string $observation
 * @property string $confirmationVisitId
 * @property string $typeVisit
 * @property string $authorizationFormat
 * @property integer $responsibleVisitId
 * @property string $visitProgramdate
 * @property string $location
 * @property string $referenceAddress
 * @property string $neighborhood
 * @property string $availability
 * @property string $availabilitydate
 * @property string $statusVisit
 * @property string $formVisit
 * @property string $typeEvent
 *
 * The followings are the available model relations:
 * @property BackgroundCheck $backgroundcheck
 * @property User $callManager
 * @property User $responsibleVisit
 * 
 * 
 * @property string $backgroundcheckCode
 * @property string $userName1
 * @property string $backgroundcheckstudyStartedOn
 * @property string $backgroundcheckstudyLimitOn
 * @property string $customerName
 * @property string $userName2
 * @property string $backgroundcheckfirstName
 * @property string $backgroundchecklastName
 * @property string $backgroundcheckidNumber
 * @property string $backgroundcheckcity
 * @property string $backgroundcheckemail
 * @property string $backgroundchecktels
 * @property string $customerProductName
 * @property string $customerProductPreliminary
 * @property string $userNameResVisit
 * @property string $locationSelect
 * 
 * @property date $availabilitydateFrom;
 * @property date $availabilitydateUntil;
 * @property date $visitProgramdateFrom;
 * @property date $visitProgramdateUntil;
 * 
 */
class CandidateCalls extends CActiveRecord
{
	public $backgroundcheckCode=null;
	public $userName1=null;
	public $backgroundcheckstudyStartedOn=null;
	public $backgroundcheckstudyLimitOn=null;
	public $customerName=null;
	public $userName2=null;
	public $userNameResVisit=null;

	public $backgroundcheckfirstName=null;
	public $backgroundchecklastName=null;
	public $backgroundcheckidNumber=null;
	public $backgroundcheckcity=null;
	public $backgroundcheckemail=null;
	public $backgroundchecktels=null;
	public $customerProductName=null;
	public $customerProductPreliminary=null;

	public $availabilitydateFrom;
    public $availabilitydateUntil;
	public $visitProgramdateFrom;
    public $visitProgramdateUntil;
	public $assignedUserId;
	public $locationSelect=[];
	public $citySelect=[];

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CandidateCalls the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{CandidateCalls}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array(
                'location, referenceAddress, neighborhood, availability, statusVisit, observation',
                'required'
            ),*/
			array('backgroundcheckId, callManagerId, responsibleVisitId, callReschedulingManagerId, confirmationVisitId', 'numerical', 'integerOnly'=>true),
			//array('confirmationVisit', 'length', 'max'=>250),
			array('location, referenceAddress, neighborhood, availability', 'length', 'max'=>150),
			array('dateCreate, dateRegistrationEffective, dateRegistrationNotEffective, observation, visitProgramdate, availabilitydate, statusVisit, confirmationVisitId, typeVisit, authorizationFormat, formVisit, typeEvent, availabilitydateFrom, availabilitydateUntil, visitProgramdateFrom, visitProgramdateUntil, assignedUserId', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, backgroundcheckId, callManagerId, dateCreate, dateRegistrationEffective, dateRegistrationNotEffective, observation, confirmationVisitId, typeVisit, authorizationFormat, responsibleVisitId, visitProgramdate, location, referenceAddress, neighborhood, availability, availabilitydate, statusVisit, backgroundcheckCode, userName1, backgroundcheckstudyStartedOn, backgroundcheckstudyLimitOn, customerName, callReschedulingManagerId, userName2, backgroundcheckfirstName, backgroundchecklastName, backgroundcheckidNumber, backgroundcheckcity, backgroundcheckemail, backgroundchecktels, customerProductName, formVisit, customerProductPreliminary, typeEvent, userNameResVisit, availabilitydateFrom, availabilitydateUntil, assignedUserId, locationSelect', 'safe', 'on'=>'searchCallstoManager, searchallCalls'),

			array('id, backgroundcheckId, callManagerId, dateCreate, backgroundcheckCode, userName1, backgroundcheckstudyStartedOn, backgroundcheckstudyLimitOn, customerName, callReschedulingManagerId, userName2, backgroundcheckfirstName, backgroundchecklastName, backgroundcheckidNumber, customerProductName, customerProductPreliminary, userNameResVisit, availabilitydateFrom, availabilitydateUntil, assignedUserId, locationSelect, backgroundcheckcity, citySelect', 'safe', 'on'=>'searchcallManager'),
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
			'backgroundcheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundcheckId'),
			'callManager' => array(self::BELONGS_TO, 'User', 'callManagerId'),
			'responsibleVisit' => array(self::BELONGS_TO, 'User', 'responsibleVisitId'),
			'confirmationVisit' => array(self::BELONGS_TO, 'User', 'confirmationVisitId'),
			'callReschedulingManager' => array(self::BELONGS_TO, 'User', 'callReschedulingManagerId'),
			'assignedUsersSearch' => array(
                self::HAS_MANY,
                'AssignedUser',
                'backgroundCheckId'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'backgroundcheckId' => 'Referencia del Estudio',
			'callManagerId' => 'Responsable de Llamada Inicial',
			'callReschedulingManagerId'=>'Responsable de Llamada reprogramación',
			'dateCreate'=>'Fecha asignación',
			'dateRegistrationEffective' => 'Fecha envio correo (Llamada efectiva)',
			'dateRegistrationNotEffective' => 'Fecha envio correo (Llamada no efectiva)',
			'observation' => 'Observaciones',
			'confirmationVisitId' => 'Confirmación Visista',
			'typeVisit' => 'Tipo de Visita',
			'authorizationFormat' => 'Formato de Autorizacion',
			'responsibleVisitId' => 'Responsable de la Visita',
			'visitProgramdate' => 'Programación',
			'location' => 'Localidad',
			'locationSelect'=>'Localidades',
			'referenceAddress' => 'Dirección punto de Referencia',
			'neighborhood' => 'Barrio',
			'availability' => 'Disponibilidad',
			'availabilitydate' => 'Fecha de disponibilidad',
			'statusVisit' => 'Estado Visita',
			'formVisit' => 'Forma de Visita',
			'typeEvent' => 'Tipo de Novedad',
			'availabilitydateFrom' => 'Fecha disponibilidad desde',
            'availabilitydateUntil' => 'Fecha disponibilidad hasta',
			'visitProgramdateFrom'=>'Fecha Programación desde',
			'visitProgramdateUntil'=>'Fecha Programación hasta',
			'citySelect'=>'Ciudades'
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

	//Search con todos los registros de estudios asociados a los responsables de llamadas
	public function searchallCalls($pagesize=100)
	{
		$criteria=new CDbCriteria;

		
		$criteria->compare('t.id',$this->id, true);
		$criteria->compare('backgroundcheckId',$this->backgroundcheckId);

		$addAssignedUsers = false;
		/*if(Yii::app()->user->getIsByRole()){
			if ($this->assignedUserId == SVPActiveRecord::NULL_VALUE) {
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId is null');
                $addAssignedUsers = true;
            } else if ($this->assignedUserId != '') {
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                $addAssignedUsers = true;
            }
            if (!empty($this->responsibleUserId)) {
                if ($this->responsibleUserId == SVPActiveRecord::NULL_VALUE) {
                    $criteria->together = true;
                    $criteria->addCondition('assignedUsersSearch.userId is null');
                    $addAssignedUsers = true;
                } else if ($this->responsibleUserId > 0) {
                    $criteria->together = true;
                    $criteria->compare('assignedUsersSearch.userId', $this->responsibleUserId, false);
                    $criteria->compare('assignedUsersSearch.userRoleId', UserRole::ASSIGNED, false);
                    $addAssignedUsers = true;
                }
            }
        }else if (!Yii::app()->user->isAdmin) {
            $criteria->together = true;
            $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
           // $this->inAmendment==1;
           // $criteria->addCondition('inAmendment==1');
            $criteria->addCondition('assignedUsersSearch.finishedAt is null');
            $criteria->addCondition('approvedBy is null or inAmendment = 1');

            $addAssignedUsers = true;
        } else {*/
            if ($this->assignedUserId == SVPActiveRecord::NULL_VALUE) {
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId is null');
                $addAssignedUsers = true;
            } else if ($this->assignedUserId != '') {
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                $addAssignedUsers = true;
            }
            if (!empty($this->responsibleUserId)) {
                if ($this->responsibleUserId == SVPActiveRecord::NULL_VALUE) {
                    $criteria->together = true;
                    $criteria->addCondition('assignedUsersSearch.userId is null');
                    $addAssignedUsers = true;
                } else if ($this->responsibleUserId > 0) {
                    $criteria->together = true;
                    $criteria->compare('assignedUsersSearch.userId', $this->responsibleUserId, false);
                    $criteria->compare('assignedUsersSearch.userRoleId', UserRole::ASSIGNED, false);
                    $addAssignedUsers = true;
                }
            }
        //}
		$criteria->compare('callManagerId',$this->callManagerId);
		$criteria->compare('callReschedulingManagerId',$this->callReschedulingManagerId);
		$criteria->compare('dateCreate',$this->dateCreate, true);
		$criteria->compare('dateRegistrationEffective',$this->dateRegistrationEffective,true);
		$criteria->compare('dateRegistrationNotEffective',$this->dateRegistrationNotEffective,true);
		$criteria->compare('observation',$this->observation,true);
		$criteria->compare('confirmationVisitId',$this->confirmationVisitId,true);
		$criteria->compare('t.typeVisit',$this->typeVisit);
		$criteria->compare('authorizationFormat',$this->authorizationFormat);
		$criteria->compare('responsibleVisitId',$this->responsibleVisitId);
		$criteria->compare('visitProgramdate',$this->visitProgramdate,true);
		$criteria->compare('location',$this->location);
		$criteria->compare('referenceAddress',$this->referenceAddress,true);
		$criteria->compare('neighborhood',$this->neighborhood,true);
		$criteria->compare('availability',$this->availability,true);
		$criteria->compare('availabilitydate',$this->availabilitydate,true);
		$criteria->compare('statusVisit',$this->statusVisit);
		$criteria->compare('formVisit',$this->formVisit);

		$criteria->compare('backgroundcheck.code', $this->backgroundcheckCode,true);
		$criteria->compare('callManager.username', $this->userName1,true);
		$criteria->compare('backgroundcheck.studyStartedOn', $this->backgroundcheckstudyStartedOn,true);
		$criteria->compare('backgroundcheck.studyLimitOn', $this->backgroundcheckstudyLimitOn,true);
		$criteria->compare('customer.name', $this->customerName,true);
		$criteria->compare('callReschedulingManager.username', $this->userName2,true);
		$criteria->compare('backgroundcheck.firstName',$this->backgroundcheckfirstName,true);
		$criteria->compare('backgroundcheck.lastName',$this->backgroundchecklastName,true);
		$criteria->compare('backgroundcheck.idNumber',$this->backgroundcheckidNumber);
		$criteria->compare('backgroundcheck.city',$this->backgroundcheckcity);
		$criteria->compare('backgroundcheck.email',$this->backgroundcheckemail);
		$criteria->compare('backgroundcheck.tels',$this->backgroundchecktels);
		$criteria->compare('customerProduct.name', $this->customerProductName,true);
		$criteria->compare('customerProduct.preliminary', $this->customerProductPreliminary);
		$criteria->compare('typeEvent',$this->typeEvent);
		$criteria->compare('responsibleVisit.username', $this->userNameResVisit,true);

		$criteria->compare('availabilitydate', '>=' . $this->availabilitydateFrom, false, 'and', true);
        $criteria->compare('availabilitydate', '<=' . $this->availabilitydateUntil, false, 'and', true);

		$criteria->compare('visitProgramdate', '>=' . $this->visitProgramdateFrom, false, 'and', true);
        $criteria->compare('visitProgramdate', '<=' . $this->visitProgramdateUntil, false, 'and', true);
	
		if(is_array($this->locationSelect) && count($this->locationSelect)>0){

			$newArraylocat=[];
			foreach ($this->locationSelect AS $locationCand){
				$newArraylocat[]="'".CHtml::encode($locationCand)."'";

			}

			$arrayString='location in ('.implode(', ',$newArraylocat).')';;
			$criteria->addCondition($arrayString);
		}


		//$criteria->addCondition('backgroundcheck.backgroundCheckStatusId='.BackgroundCheckStatus::REQUESTED.' or backgroundcheck.backgroundCheckStatusId='.BackgroundCheckStatus::PROCESSING);
		$criteria->with=['backgroundcheck.customerProduct', 'backgroundcheck.customer', 'callManager', 'responsibleVisit', 'callReschedulingManager', 'backgroundcheck.assignedUsersSearch', 'confirmationVisit'];

		$criteria->order = 't.id desc';

		GridViewFilter::setFilter($this, 'searchallCalls');

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchallCalls'),
				'pageSize' => $pagesize,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',
            ),
        ));
	}

	//Serch filtrado por usuario responsable de las llamadas
	public function searchCallstoManager($pagesize=100)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$addAssignedUsers = false;
        /*if (!Yii::app()->user->isAdmin) {
            $criteria->together = true;
            $criteria->compare('assignedUsersSearch.userId', Yii::app()->user->id, false);
           // $this->inAmendment==1;
           // $criteria->addCondition('inAmendment==1');
            $criteria->addCondition('assignedUsersSearch.finishedAt is null');
            $criteria->addCondition('approvedBy is null or inAmendment = 1');

            $addAssignedUsers = true;
        } else {*/
            if ($this->assignedUserId == SVPActiveRecord::NULL_VALUE) {
                $criteria->together = true;
                $criteria->addCondition('assignedUsersSearch.userId is null');
                $addAssignedUsers = true;
            } else if ($this->assignedUserId != '') {
                $criteria->together = true;
                $criteria->compare('assignedUsersSearch.userId', $this->assignedUserId, false);
                $addAssignedUsers = true;
            }
            if (!empty($this->responsibleUserId)) {
                if ($this->responsibleUserId == SVPActiveRecord::NULL_VALUE) {
                    $criteria->together = true;
                    $criteria->addCondition('assignedUsersSearch.userId is null');
                    $addAssignedUsers = true;
                } else if ($this->responsibleUserId > 0) {
                    $criteria->together = true;
                    $criteria->compare('assignedUsersSearch.userId', $this->responsibleUserId, false);
                    $criteria->compare('assignedUsersSearch.userRoleId', UserRole::ASSIGNED, false);
                    $addAssignedUsers = true;
                }
            }
        //}

		$criteria->compare('t.id',$this->id);
		$criteria->compare('backgroundcheckId',$this->backgroundcheckId);
		$criteria->compare('callManagerId',$this->callManagerId);
		$criteria->compare('callReschedulingManagerId',$this->callReschedulingManagerId);
		$criteria->compare('dateCreate',$this->dateCreate, true);
		$criteria->compare('dateRegistrationEffective',$this->dateRegistrationEffective,true);
		$criteria->compare('dateRegistrationNotEffective',$this->dateRegistrationNotEffective,true);
		$criteria->compare('observation',$this->observation,true);
		$criteria->compare('confirmationVisitId',$this->confirmationVisitId,true);
		$criteria->compare('t.typeVisit',$this->typeVisit);
		$criteria->compare('authorizationFormat',$this->authorizationFormat);
		$criteria->compare('responsibleVisitId',$this->responsibleVisitId);
		$criteria->compare('visitProgramdate',$this->visitProgramdate,true);
		$criteria->compare('location',$this->location);
		$criteria->compare('referenceAddress',$this->referenceAddress,true);
		$criteria->compare('neighborhood',$this->neighborhood,true);
		$criteria->compare('availability',$this->availability,true);
		$criteria->compare('availabilitydate',$this->availabilitydate,true);
		$criteria->compare('statusVisit',$this->statusVisit);
		$criteria->compare('formVisit',$this->formVisit);

		$criteria->compare('backgroundcheck.code', $this->backgroundcheckCode,true);
		$criteria->compare('callManager.username', $this->userName1,true);
		$criteria->compare('backgroundcheck.studyStartedOn', $this->backgroundcheckstudyStartedOn,true);
		$criteria->compare('backgroundcheck.studyLimitOn', $this->backgroundcheckstudyLimitOn,true);
		$criteria->compare('customer.name', $this->customerName,true);
		$criteria->compare('callReschedulingManager.username', $this->userName2,true);
		$criteria->compare('backgroundcheck.firstName',$this->backgroundcheckfirstName,true);
		$criteria->compare('backgroundcheck.lastName',$this->backgroundchecklastName,true);
		$criteria->compare('backgroundcheck.idNumber',$this->backgroundcheckidNumber);
		$criteria->compare('backgroundcheck.city',$this->backgroundcheckcity);
		$criteria->compare('backgroundcheck.email',$this->backgroundcheckemail);
		$criteria->compare('backgroundcheck.tels',$this->backgroundchecktels);
		$criteria->compare('customerProduct.name', $this->customerProductName,true);
		$criteria->compare('customerProduct.preliminary', $this->customerProductPreliminary);
		$criteria->compare('typeEvent',$this->typeEvent);
		$criteria->compare('responsibleVisit.username', $this->userNameResVisit,true);

		if(is_array($this->locationSelect) && count($this->locationSelect)>0){

			$newArraylocat=[];
			foreach ($this->locationSelect AS $locationCand){
				$newArraylocat[]="'".CHtml::encode($locationCand)."'";

			}

			$arrayString='location in ('.implode(', ',$newArraylocat).')';;
			$criteria->addCondition($arrayString);
		}
		//$criteria->addCondition('backgroundcheck.backgroundCheckStatusId='.BackgroundCheckStatus::REQUESTED.' or backgroundcheck.backgroundCheckStatusId='.BackgroundCheckStatus::PROCESSING);
		$criteria->addCondition('callManager.id="'.Yii::app()->user->id.'" OR callReschedulingManager.id="'.Yii::app()->user->id.'"');

		$criteria->with=['backgroundcheck.customerProduct', 'backgroundcheck.customer', 'callManager', 'responsibleVisit', 'callReschedulingManager', 'confirmationVisit', 'backgroundcheck.assignedUsersSearch'];
		$criteria->order = 't.id desc';

		GridViewFilter::setFilter($this, 'searchCallstoManager');

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchCallstoManager'),
				'pageSize' => $pagesize,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',
            ),
        ));
	}


    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
	//Search para responsable de asignacion de llamadas
	public function searchcallManager($pagesize=100)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('backgroundcheckId',$this->backgroundcheckId);
		$criteria->compare('callManagerId',$this->callManagerId);
		$criteria->compare('callReschedulingManagerId',$this->callReschedulingManagerId);
		$criteria->compare('dateCreate',$this->dateCreate, true);
		$criteria->compare('backgroundcheck.code', $this->backgroundcheckCode,true);
		$criteria->compare('callManager.username', $this->userName1,true);
		$criteria->compare('backgroundcheck.studyStartedOn', $this->backgroundcheckstudyStartedOn, true);
		$criteria->compare('backgroundcheck.studyLimitOn', $this->backgroundcheckstudyLimitOn, true);
		$criteria->compare('customer.name', $this->customerName,true);
		$criteria->compare('statusVisit',$this->statusVisit);
		$criteria->compare('callReschedulingManager.username', $this->userName2,true);
		$criteria->compare('backgroundcheck.firstName',$this->backgroundcheckfirstName,true);
		$criteria->compare('backgroundcheck.lastName',$this->backgroundchecklastName,true);
		$criteria->compare('backgroundcheck.idNumber',$this->backgroundcheckidNumber);
		$criteria->compare('customerProduct.name', $this->customerProductName,true);
		$criteria->compare('confirmationVisitId',$this->confirmationVisitId,true);
		$criteria->compare('customerProduct.preliminary', $this->customerProductPreliminary);
		$criteria->compare('typeEvent',$this->typeEvent);
		$criteria->compare('responsibleVisit.username', $this->userNameResVisit,true);
		$criteria->compare('backgroundcheck.city',$this->backgroundcheckcity);

		if(is_array($this->citySelect) && count($this->citySelect)>0){

			$newArraycity=[];
			foreach ($this->citySelect AS $cityCand){
				$newArraycity[]="'".CHtml::encode($cityCand)."'";

			}

			$arrayString='backgroundcheck.city in ('.implode(', ',$newArraycity).')';;
			$criteria->addCondition($arrayString);
		}
		//$criteria->addCondition('backgroundcheck.backgroundCheckStatusId='.BackgroundCheckStatus::REQUESTED.' or backgroundcheck.backgroundCheckStatusId='.BackgroundCheckStatus::PROCESSING);
		$criteria->with=['callManager', 'backgroundcheck.customerProduct', 'backgroundcheck', 'backgroundcheck.customer', 'callReschedulingManager'];
		//$criteria->order = 't.id desc';

		GridViewFilter::setFilter($this, 'searchcallManager');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('searchcallManager'),
				'pageSize' => $pagesize,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',
            ),
        ));
	}


	public function getAllUserCalls(){
        
        $criteria = new CDbCriteria;

        $criteria->addCondition('t.callManager=:callmanager');
        $criteria->params=[':callmanager'=>1];
        $AllCall= User::model()->count($criteria);
 
        $totalCalls=[];
        $totalCalls[]=[
            'totalCalls'=>$AllCall
        ];

        return $totalCalls;
    }

	public function getAllStudy(){
        
        $criteria = new CDbCriteria;
        $criteria->addCondition("t.backgroundCheckStatusId=1 OR t.backgroundCheckStatusId=5");
		$criteria->addCondition("t.studyStartedOn>='2023-06-15'");
        $AllStudy= BackgroundCheck::model()->count($criteria);
 
        $totalStudys=[];
        $totalStudys[]=[
            'totalStudys'=>$AllStudy
        ];

        return $totalStudys;
    }

	public function getDetailUserCalls(){
        
        $criteria = new CDbCriteria;

        $criteria->addCondition('t.callManager=:callmanager');
        $criteria->params=[':callmanager'=>1];
        $DetailUsers= User::model()->findAll($criteria);
 
        $DetUsers=[];
        
        foreach ($DetailUsers AS $users){
            $DetUsers[]=[
                'id'=>$users->id,
				'nameUser'=>$users->username,
            ];
        }
        
        return $DetUsers;
    }

	public function getDetailStudys(){
        
		/*$query_A = "SELECT t1.id
			FROM ses_BackgroundCheck t1
			LEFT JOIN ses_CandidateCalls t2 ON t2.backgroundcheckId=t1.id
			JOIN ses_VerificationSection vs ON vs.backgroundCheckId=t1.id
			WHERE t2.backgroundcheckId IS NULL AND (t1.backgroundCheckStatusId='1' OR t1.backgroundCheckStatusId='5') 
			AND (vs.verificationSectionTypeId='2' OR vs.verificationSectionTypeId='3' OR vs.verificationSectionTypeId='5' OR vs.verificationSectionTypeId='6')
			GROUP BY t1.id ORDER BY t1.id DESC";*/
			
		$query_A = "SELECT t1.id, t1.studyStartedOn
			FROM ses_BackgroundCheck t1
			LEFT JOIN ses_CandidateCalls t2 ON t2.backgroundcheckId=t1.id
			JOIN ses_VerificationSection vs ON vs.backgroundCheckId=t1.id
			JOIN ses_Customer cus ON cus.id=t1.customerId
			WHERE t2.backgroundcheckId IS NULL AND (t1.backgroundCheckStatusId='1' OR t1.backgroundCheckStatusId='5') 
			AND (vs.verificationSectionTypeId='2' OR vs.verificationSectionTypeId='3' OR vs.verificationSectionTypeId='5' OR vs.verificationSectionTypeId='6' OR vs.verificationSectionTypeId='8') 
			AND cus.businessLine='Integridad' AND t1.studyStartedOn>='2023-06-15'
			GROUP BY t1.id, t1.studyStartedOn ORDER BY t1.id DESC";
        $DetailStudys = Yii::app()->db->createCommand($query_A)->queryAll();

        return $DetailStudys;
    }

	public function getAlltoAssignStudys(){

		$totalUserCall=$this->getAllUserCalls();
		foreach ($totalUserCall as $r) {
			foreach ( $r as $v ) {
				$totalUsers=$v;
			}
		}

		$totalStudys=$this->getAllStudy();
		foreach ($totalStudys as $r) {
			foreach ( $r as $v ) {
				$totalStudysCall=$v;
			}
		}

		$DetailUsers=$this->getDetailUserCalls();
		$DetailStudys=$this->getDetailStudys();

		for ($i=1; $i<=$totalStudysCall; $i++) {
			foreach($DetailUsers as $DetUser){
				$recordCandidateCall = new CandidateCalls();
				foreach($DetailStudys as $DetStudys){
					$recordCandidateCalls=CandidateCalls::model()->findByAttributes(['backgroundcheckId'=>$DetStudys['id']]);
					if(!$recordCandidateCalls){
						$recordCandidateCall->backgroundcheckId=$DetStudys['id'];
						$recordCandidateCall->callManagerId=$DetUser['id'];
						$recordCandidateCall->dateCreate=$DetStudys['studyStartedOn'];
						$recordCandidateCall->statusVisit="PENDIENTE";
						if (!$recordCandidateCall->save()) {
							WebUser::logAccess("Error ingresando el registro de asignacion llamada", $recordCandidateCall->backgroundcheck->code);
						}
					}
				}
			}
		}

		WebUser::logAccess("Se realizo la asignacion masiva de llamadas.");
	}


	public function getResponsible() {
        $responsible = null;
        foreach ($this->backgroundcheck->assignedUsers as $assignedUser) {
            if ($assignedUser->userRoleId == UserRole::ASSIGNED) {
                $responsible = $assignedUser;
                break;
            }
        }
        return $responsible;
    }

	public function getAssignedUserNamesPlain() {
        $ans = '';
        $first = true;
        foreach ($this->backgroundcheck->assignedUsers as $assignedUser) {
            /* @var $assignedUser AssignedUser */
            if (!$first) {
                $ans.=" | ";
            } else {
                $first = false;
            }
				$ans.= $assignedUser->user->firstName.' '.$assignedUser->user->firstName . ' [' . $assignedUser->userRole->nick . ']' .($assignedUser->verificationSection ? ':' . $assignedUser->verificationSection->sectionName : '');
        }
        return $ans;
    }

	public function getDateEventsVisit($backgroundcheckId,$visitprogram, $formVisit, $code, $studyLimit){

			$date1 = new \DateTime();
			$fromDate=$date1->format('Y-m-d h:i:s');

			$datevisit = new \DateTime($visitprogram);
			$visitprogramd=$datevisit->format('d');
			$visitprogramm=$datevisit->format('m');
			$visitprogramy=$datevisit->format('Y');
			$visitprogramh=$datevisit->format('h:i');

			$detail="Visita domiciliaria programada para el día: ".$visitprogramd." de ".$visitprogramm." del año ".$visitprogramy." a las ".$visitprogramh." de tipo: ". $formVisit.".";

			$Event = new Event();
			$Event->backgroundCheckId = $backgroundcheckId;
			$Event->created=$fromDate;
			$Event->detail = $detail;
			$Event->newLimitDate = date("Y-m-d", strtotime($studyLimit));
			$Event->createdById = Yii::app()->user->id;
			$Event->eventTypeId = 2;
			$Event->eventTypeNewsId = 1;
	
			if (!$Event->save()) {
				throw new CHttpException(500, 'Server Error.');
			}
			WebUser::logAccess("Se realizo la insercion de la novedad de visita programada del estudio.", $code);

			return true;
	}

	public function getDateEventsDocument($backgroundcheckId, $email, $code, $studyLimit){

		$date1 = new \DateTime();
		$fromDate=$date1->format('Y-m-d h:i:s');

		$detail="Se realiza la solicitud de documentación al correo, ".$email.". Quedamos a la espera de los mismos.";

		$Event = new Event();
		$Event->backgroundCheckId = $backgroundcheckId;
		$Event->created=$fromDate;
		$Event->detail = $detail;
		$Event->newLimitDate = date("Y-m-d", strtotime($studyLimit));
		$Event->createdById = Yii::app()->user->id;
		$Event->eventTypeId = 2;
		$Event->eventTypeNewsId = 1;

		if (!$Event->save()) {
			throw new CHttpException(500, 'Server Error.');
		}
		WebUser::logAccess("Se realizo la insercion de la novedad de documentos del estudio.", $code);

		return true;
	}

	public function getAssingVisit($backgroundcheckId, $idUser, $limit, $code){

		$date1 = new \DateTime();
		$fromDate=$date1->format('Y-m-d h:i:s');

		$recordVerificationSection=VerificationSection::model()->findByAttributes(['backgroundCheckId'=>$backgroundcheckId,'verificationSectionTypeId'=>'5']);

		$assignedUsers =  AssignedUser::model()->findByAttributes(['backgroundCheckId'=>$backgroundcheckId, 'userRoleId'=>UserRole::VISITOR]);

		if($recordVerificationSection){

			if(!$assignedUsers && $this->responsibleVisitId!=""){
				$Assing = new AssignedUser();
				$Assing->userRoleId = UserRole::VISITOR;
				$Assing->backgroundCheckId=$backgroundcheckId;
				$Assing->userId = $idUser;
				$Assing->assignedAt = $fromDate;
				$Assing->verificationSectionId = $recordVerificationSection->id;
				$Assing->limitAt = $limit;
	
				if (!$Assing->save()) {
					throw new CHttpException(500, 'Server Error.');
				}
				WebUser::logAccess("Se realizo la asignacion del responsable de la visita.", $code);
			}else if($this->responsibleVisitId!=""){
				if($assignedUsers->finishedAt=="" || $assignedUsers->finishedAt==null){
					$assignedUsers->userId = $idUser;
					$assignedUsers->assignedAt = $fromDate;
		
					if (!$assignedUsers->save()) {
						throw new CHttpException(500, 'Server Error.');
					}
					WebUser::logAccess("Se realizo la actualizacion del responsable de la visita.", $code);
				}
			}
			
		}

		return true;
	}

	public function getStatusVisitPend() {

		$ansStr = "";
		switch($this->statusVisit){
		
			case $this->statusVisit=="PENDIENTE":
				$pr ="<font color='red'><b>PENDIENTE</b></font>";
				break;
			case $this->statusVisit=="Programada":
				$pr =$this->statusVisit;
				break;
			case $this->statusVisit=="Visita Ok":
				$pr =$this->statusVisit;
				break;
			case $this->statusVisit=="No Aplica":
				$pr = $this->statusVisit;
				break;
			case $this->statusVisit=="Sin Realizar":
				$pr =$this->statusVisit;
				break;
			case $this->statusVisit=="En Proceso":
				$pr =$this->statusVisit;
				break;
			/*default:
				$pr ="<font color='red'><b>PENDIENTE</b></font>";*/
		}
		$ansStr.= $pr;

		return $ansStr;
    }

	public function getVerificationCity() {

		$ansStr = "";
		switch($this->backgroundcheck->city){
		
			case $this->backgroundcheck->city==" ":
				$pr ="<font color='orange'><b>CONFIRMAR</b></font>";
				break;
			case $this->backgroundcheck->city!=" ":
				$pr =$this->backgroundcheck->city;
				break;
		}
		$ansStr.= $pr;

		return $ansStr;
    }

	public function getResreprogram() {

		$ansStr = "";
		switch($this->callReschedulingManager){
		
			case $this->callReschedulingManager==" ":
				$pr =" ";
				break;
			case $this->callReschedulingManager!=" ":
				$pr ="<font color='green'><b>".$this->callReschedulingManager->username."</b></font>";
				break;
		}
		$ansStr.= $pr;

		return $ansStr;
    }

	public function getPreliminary() {

		$ansStr = "";
		switch($this->backgroundcheck->customerProduct->preliminary){
			
			case 0:
				$pr ="NO";
				break;
			case 1:
				$pr ="<font color='BD210C'><b>SI</b></font>";
				break;
		}
		$ansStr.= $pr;

		return $ansStr;
    }

	public function getUptNotAssignmassive($id){

		$models = CandidateCalls::model()->findByAttributes(['id'=>$id]);
		$models->callManagerId=null;
		$models->callReschedulingManagerId=null;
		$models->statusVisit="No Aplica";
		$models->update();

		WebUser::logAccess("Se realizo la actualización para quitar el responsable de la llamada.", $models->backgroundcheck->code);
		return true;
	}

	public function getUptNotCV($id){

		$models = CandidateCalls::model()->findByAttributes(['id'=>$id]);
		$models->observation="Sin HDV";
		$models->update();

		WebUser::logAccess("Se realizo la inserción de la observación: Sin HDV.", $models->backgroundcheck->code);
		return true;
	}

	public function getUptPresencialNac($id){

		$models = CandidateCalls::model()->findByAttributes(['id'=>$id]);
		$models->observation="Presencial Nacional";
		$models->update();

		WebUser::logAccess("Se realizo la inserción de la observación: Presencial Nacional.", $models->backgroundcheck->code);
		return true;
	}

	public function getUptPresencial($id){

		$models = CandidateCalls::model()->findByAttributes(['id'=>$id]);
		$models->observation="Presencial";
		$models->update();

		WebUser::logAccess("Se realizo la inserción de la observación: Presencial.", $models->backgroundcheck->code);
		return true;
	}

}
