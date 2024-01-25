<?php
/**
 * This is the model class for table "{{InvoiceVisit}}".
 *
 * The followings are the available columns in table '{{InvoiceVisit}}':
 * @property integer $id
 * @property string $from
 * @property string $until
 * @property string $invoiceDate
 * @property string $created
 * @property integer $visitId
 * @property integer $numberStudies
 * @property string $totalValueStudies
 * @property string $totalValueAddStudies
 * @property integer $statusInvoice
 * @property string $description
 *
 * The followings are the available model relations:
 * @property User $visit
 * @property InvoiceVisitDetail[] $invoiceVisitDetails
 */
class InvoiceVisit extends CActiveRecord
{

	public $userName=null;
	public $firstName=null;
	public $lastName=null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{InvoiceVisit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visitId, numberStudies, statusInvoice', 'numerical', 'integerOnly'=>true),
			array('totalValueStudies, totalValueAddStudies', 'length', 'max'=>10),
			array('from, until, invoiceDate, created, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from, until, invoiceDate, created, visitId, numberStudies, totalValueStudies, statusInvoice, description, userName, lastName, firstName, totalValueAddStudies', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'visitId'),
			'invoiceVisitDetails' => array(self::HAS_MANY, 'InvoiceVisitDetail', 'invoiceVisitId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'from' => 'Fecha inicial corte',
			'until' => 'Fecha final corte',
			'invoiceDate'=>'fecha factura',
			'created' => 'creado',
			'visitId' => 'Visitador',
			'numberStudies' => 'Cantidad de Estudios',
			'totalValueStudies' => 'Total pago visitas',
			'totalValueAddStudies'=>'Total adicional pago visitas',
			'statusInvoice' => 'Factura cerrada',
			'description' => 'Descripción Factura',
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.from',$this->from,true);
		$criteria->compare('until',$this->until,true);
		$criteria->compare('invoiceDate',$this->invoiceDate,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('visitId',$this->visitId);
		$criteria->compare('numberStudies',$this->numberStudies);
		$criteria->compare('totalValueStudies',$this->totalValueStudies,true);
		$criteria->compare('statusInvoice',$this->statusInvoice);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('totalValueAddStudies',$this->totalValueAddStudies,true);
		$criteria->compare('user.username', $this->userName,true);
		$criteria->compare('user.firstName', $this->firstName,true);
		$criteria->compare('user.lastName', $this->lastName,true);


		if(Yii::app()->user->getIsByRole()){
            if(Yii::app()->user->getHasGlobalPermissionTo(Permission::ALL_ESTUDIOS)){
			}else{
				$criteria->addCondition('visitId="'.Yii::app()->user->id.'"');
			}
		}else if (!Yii::app()->user->isAdmin) {
			$criteria->addCondition('visitId="'.Yii::app()->user->id.'"');
		}

		$criteria->with=['user'];

		GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
				'pageSize' => 100,
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC',
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvoiceVisit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCanUpdate() {
        return (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole());
    }

	public function getTotalCostTansport() {
        $totaltrans = 0;
        foreach ($this->invoiceVisitDetails as $invoiceVisitDet) {
            $totaltrans+=$invoiceVisitDet->totalValueTransportation;
        }
        return $totaltrans;
    }

	public function getTotalCostFeeding() {
        $totalAliment = 0;
        foreach ($this->invoiceVisitDetails as $invoiceVisitDet) {
            $totalAliment+=$invoiceVisitDet->totalValueFeeding;
        }
        return $totalAliment;
    }

	public function getTotalCostStationery() {
        $totalpapeleria = 0;
        foreach ($this->invoiceVisitDetails as $invoiceVisitDet) {
            $totalpapeleria+=$invoiceVisitDet->totalValueStationery;
        }
        return $totalpapeleria;
    }

	static public function getOpenInvoiceVisit($backgroundCheck) {

		//$assignedUsers =  AssignedUser::model()->findByAttributes(['backgroundCheckId'=>$backgroundCheck->id, 'userRoleId'=>'3']);

		$criteria = new CDbCriteria();
		$criteria->addCondition('t.backgroundCheckId = :bgcId');
        $criteria->addCondition("t.userRoleId=3 AND (verificationSection.verificationSectionTypeId=5 OR verificationSection.verificationSectionTypeId=17 OR verificationSection.verificationSectionTypeId=33 
		OR verificationSection.verificationSectionTypeId=44 OR verificationSection.verificationSectionTypeId=85)"); 
        $criteria->with=['verificationSection'];
		$criteria->params[':bgcId'] = $backgroundCheck->id;
	    $assignedUsers = AssignedUser::model()->find($criteria);

		$finishedAtSection=$assignedUsers->finishedAt;
		$dateAct = new DateTime($finishedAtSection);  
		$datefinist = $dateAct->format("Y-m-d");  

        /* @var $invoice InvoiceVisit */
        $invoiceId = NULL;
        $criteria = new CDbCriteria;
        $criteria->addCondition('curdate() between `t`.`from` and `t`.`until` and `t`.`statusInvoice`=0');
        $criteria->addCondition('user.id = :visitId');
		$criteria->addCondition('"'.$datefinist.'" between t.from and t.until');
        $criteria->with = array('user');
        $criteria->params[':visitId'] = (int) $assignedUsers->userId;
        $criteria->order = ' t.id asc';

        $invoiceVisit = InvoiceVisit::model()->find($criteria);

        if ($invoiceVisit) {
            $invoiceId = $invoiceVisit->id;

			$invoiceVisit->numberStudies=$invoiceVisit->numberStudies+1;
			$invoiceVisit->totalValueStudies=$invoiceVisit->totalValueStudies+$backgroundCheck->customerProduct->invoiceVisitCost->totalVisitCost;
			$invoiceVisit->totalValueAddStudies=$invoiceVisit->totalValueAddStudies+$backgroundCheck->addValueVisit;
			$invoiceVisit->statusInvoice = 0;
		
			if (!$invoiceVisit->update()) {
				throw new CHttpException(500, 'Server Error.');
			}

			$invoiceVisitDetail =  InvoiceVisitDetail::model()->findByAttributes(['backgroundId'=>$backgroundCheck->id]);
			if($invoiceVisitDetail){
				$invoiceVisitDetail->totalValueAddVisit = $backgroundCheck->addValueVisit+0;
				if (!$invoiceVisitDetail->update()) {
					throw new CHttpException(500, 'Server Error.');
				}
			}else{
				$invoiceVisitDt = new InvoiceVisitDetail();
				$invoiceVisitDt->invoiceVisitId = $invoiceId;
				$invoiceVisitDt->backgroundId = $backgroundCheck->id;
				$invoiceVisitDt->productId =$backgroundCheck->customerProductId;
				$invoiceVisitDt->totalValueCostVisit = $backgroundCheck->customerProduct->invoiceVisitCost->totalVisitCost;
				$invoiceVisitDt->totalValueAddVisit = $backgroundCheck->addValueVisit+0;
				$invoiceVisitDt->description = $backgroundCheck->customerProduct->invoiceVisitCost->descriptionCost;

				if (!$invoiceVisitDt->save()) {
					throw new CHttpException(500, 'Server Error.');
				}
			}
        } else {

            $bcDate = new DateTime();

			$dateCut =  VisitInvoiceDate::model()->findAll();

			foreach ($dateCut as $date) {

				if(($datefinist >= $date->invoiceInitialDate) && ($datefinist <= $date->invoiceClosingDate)) {
					$invoice = new InvoiceVisit();
					$invoice->visitId = $assignedUsers->userId;
					$invoice->from = $date->invoiceInitialDate;
					$invoice->until =$date->invoiceClosingDate;
					$invoice->invoiceDate = $date->invoiceDate;
					$invoice->created =  new CDbExpression('NOW()');
					$invoice->numberStudies=1;
					$invoice->totalValueStudies=$backgroundCheck->customerProduct->invoiceVisitCost->totalVisitCost;
					$invoice->totalValueAddStudies=$backgroundCheck->addValueVisit;
					$invoice->statusInvoice = 0;
					$invoice->description = 'Facturas visitador';
		
					if (!$invoice->save()) {
						throw new CHttpException(500, 'Server Error.');
					}

					$invoiceId = $invoice->id;

					$invoiceVisitDt = new InvoiceVisitDetail();
					$invoiceVisitDt->invoiceVisitId = $invoiceId;
					$invoiceVisitDt->backgroundId = $backgroundCheck->id;
					$invoiceVisitDt->productId =$backgroundCheck->customerProductId;
					$invoiceVisitDt->totalValueCostVisit = $backgroundCheck->customerProduct->invoiceVisitCost->totalVisitCost;
					$invoiceVisitDt->totalValueAddVisit = $backgroundCheck->addValueVisit+0;
					$invoiceVisitDt->description = $backgroundCheck->customerProduct->invoiceVisitCost->descriptionCost;

					if (!$invoiceVisitDt->save()) {
						throw new CHttpException(500, 'Server Error.');
					}

				}
			}
        }
		return $invoiceId;
    }

    public function dayslastDateOfInvoices(){
        $how = new DateTime(date('Y-m-d'));
        $dateUntil = new DateTime($this->until);
        if (is_null($dateUntil)){
            $dateUntil=  new DateTime(date('Y-m-d'));
        }
        $diff = $how->diff($dateUntil);
        return $diff->days;
    }

	public function getInvoicePreFactura($id){

		$query_A='SELECT vst.id AS idSection, vs.id AS idverifisection, CONCAT(us.firstName," ",us.lastName) AS nombre,  inv.from, inv.until,
		invs.id as idVisitdetail, invc.descriptionCost, bgc.code, bgc.idNumber, CONCAT(bgc.firstName," ",bgc.lastName) AS nombreCandidato, cus.name, 
		bgc.city, invs.totalValueCostVisit, invs.totalValueAddVisit, invs.totalValueTransportation, invs.totalValueFeeding, invs.totalValueStationery, if(invs.isApprovedOP=1,"Si",if(invs.isApprovedOP=0,"No","")) AS aprobado,CONCAT(usAp.firstName," ",usAp.lastName) AS aprobadoPor,invs.DateApprovedOP, bgc.id AS bgcId
		FROM ses_InvoiceVisitDetail invs 
		JOIN ses_InvoiceVisit inv ON invs.invoiceVisitId=inv.id
		JOIN ses_BackgroundCheck bgc ON invs.backgroundId=bgc.id
		JOIN ses_CustomerProduct cp ON invs.productId=cp.id
		JOIN ses_User us ON inv.visitId=us.id
		JOIN ses_Customer cus ON cus.id=cp.customerId
		JOIN ses_VerificationSection vs ON vs.backgroundCheckId=bgc.id
		JOIN ses_VerificationSectionType vst ON vs.verificationSectionTypeId=vst.id
		JOIN ses_InvoiceVisitCost invc ON invc.id=cp.costVisitId
		LEFT JOIN ses_User usAp ON  usAp.id=invs.ApprovedOPId
		WHERE inv.id="'.$id.'" AND vs.percentCompleted="100" AND (vst.id="5" OR vst.id="17" OR vst.id="33" OR vst.id="44" OR vst.id="85")';
        $invoicePrefac = Yii::app()->db->createCommand($query_A)->queryAll();
        return $invoicePrefac;
		
	}
}
