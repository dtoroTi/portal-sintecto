<?php

/**
 * This is the model class for table "{{InvoiceVisitDetail}}".
 *
 * The followings are the available columns in table '{{InvoiceVisitDetail}}':
 * @property integer $id
 * @property integer $invoiceVisitId
 * @property integer $backgroundId
 * @property integer $productId
 * @property string $totalValueCostVisit
 * @property string $totalValueAddVisit
 * @property string $totalValueTransportation
 * @property string $totalValueFeeding
 * @property string $totalValueStationery
 * @property string $description
 * @property integer $isApprovedOP
 * @property integer $ApprovedOPId
 * @property string $DateApprovedOP
 * 
 * 
 * The followings are the available model relations:
 * @property BackgroundCheck $background
 * @property InvoiceVisit $invoiceVisit
 * @property CustomerProduct $product
 */
class InvoiceVisitDetail extends CActiveRecord
{
	public $backgroundcheckCode=null;
	public $firstName=null;
	public $lastName=null;
	public $idNumber=null;
	public $city=null;
	public $customerName=null;
	public $productName=null;
	public $dateSolic=null;
	public $datepublic=null;
	public $userName=null;
	public $visitedOnSection=null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{InvoiceVisitDetail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.

		return array(
			array('invoiceVisitId, backgroundId, productId', 'numerical', 'integerOnly'=>true),
			array('totalValueCostVisit, totalValueAddVisit, totalValueTransportation, totalValueFeeding, totalValueStationery', 'length', 'max'=>10),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoiceVisitId, backgroundId, productId, totalValueCostVisit, totalValueAddVisit, description, backgroundcheckCode, firstName, lastName, idNumber, city, customerName, productName, dateSolic, datepublic, totalValueTransportation, totalValueFeeding, totalValueStationery, isApprovedOP, ApprovedOPId, DateApprovedOP, userName, visitedOnSection', 'safe', 'on'=>'search'),
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
			'background' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundId'),
			'invoiceVisit' => array(self::BELONGS_TO, 'InvoiceVisit', 'invoiceVisitId'),
			'product' => array(self::BELONGS_TO, 'CustomerProduct', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoiceVisitId' => 'Invoice Visit',
			'backgroundId' => 'Background',
			'productId' => 'Product',
			'totalValueCostVisit' => 'Total valor visita',
			'totalValueAddVisit' => 'Total valor adicional visita',
			'totalValueTransportation'=>'Total valor transporte', 
			'totalValueFeeding'=>'Total valor alimentación',
			'totalValueStationery'=>'Total valor papeleria',
			'description' => 'Descripción',
			'isApprovedOP'=>'Aprueba Operaciones',
			'ApprovedOPId'=>'Aprobado por',
			'DateApprovedOP'=>'Fecha de Aprobación',
			'visitedOnSection'=>'Fecha Visita'
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

		$criteria->compare('id',$this->id, true);
		$criteria->compare('t.invoiceVisitId',$this->invoiceVisitId);
		$criteria->compare('backgroundId',$this->backgroundId);
		$criteria->compare('productId',$this->productId);
		$criteria->compare('totalValueCostVisit',$this->totalValueCostVisit,true);
		$criteria->compare('totalValueAddVisit',$this->totalValueAddVisit,true);
		$criteria->compare('totalValueTransportation',$this->totalValueTransportation,true);
		$criteria->compare('totalValueFeeding',$this->totalValueFeeding,true);
		$criteria->compare('totalValueStationery',$this->totalValueStationery,true);
		$criteria->compare('description',$this->description,true);

		$criteria->compare('background.code', $this->backgroundcheckCode,true);
		$criteria->compare('background.firstName', $this->firstName,true);
		$criteria->compare('background.lastName', $this->lastName,true);
		$criteria->compare('background.idNumber', $this->idNumber,true);
		$criteria->compare('background.city', $this->city,true);
		$criteria->compare('customer.name', $this->customerName,true);
		$criteria->compare('customerProduct.name', $this->productName,true);

		$criteria->compare('background.studyStartedOn', $this->dateSolic,true);
		$criteria->compare('background.deliveredToCustomerOn', $this->datepublic,true);
		$criteria->compare('isApprovedOP',$this->isApprovedOP);
		$criteria->compare('user.username',$this->userName);
		$criteria->compare('DateApprovedOP',$this->DateApprovedOP);

		$criteria->with=['background', 'background.customer', 'background.customerProduct'];

		GridViewFilter::setFilter($this, 'search');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvoiceVisitDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCanDelete() {
        return (Yii::app()->user->isAdmin || Yii::app()->user->getIsByRole());
    }

	public function getupdateTotaladd($id) {
		
		$query_A='SELECT SUM(invd.totalValueAddVisit) AS totalVisit, SUM(invd.totalValueCostVisit) AS totalCostVisit FROM ses_InvoiceVisitDetail invd
		WHERE invd.invoiceVisitId="'.$id.'"';
        $sumtotalAdd = Yii::app()->db->createCommand($query_A)->queryAll();

		foreach ( $sumtotalAdd as $datos ) {
			$total=$datos['totalVisit'];
			$totalCostV=$datos['totalCostVisit'];
		}

		$models = InvoiceVisit::model()->findByAttributes(['id'=>$id]);
		$models->totalValueStudies=$totalCostV;
		$models->totalValueAddStudies=$total;
		$models->update();

		/*$data = "UPDATE ses_InvoiceVisit SET totalValueAddStudies='".$total."' WHERE id='".$id."'";
        $query = Yii::app()->db->createCommand($data)->execute();*/
	}

	public function getDeleteRegister($id, $bgkId) {

		$models = InvoiceVisit::model()->findByAttributes(['id'=>$id]);
		$models->numberStudies=$models->numberStudies-1;
		$models->totalValueStudies=$models->totalValueStudies-$this->totalValueCostVisit;
		$models->totalValueAddStudies=$models->totalValueAddStudies-$this->totalValueAddVisit;
		$models->update();

		$modelsbgk = BackgroundCheck::model()->findByAttributes(['id'=>$bgkId]);
		$modelsbgk->invoiceVisitId="";
		$modelsbgk->update();
	}

	public function getExportInvoiceDetail($id){

		$query_A='SELECT us.username, CONCAT(us.firstName," ",us.lastName) AS nombre, inv.id, inv.from, inv.until, inv.invoiceDate, inv.statusInvoice, 
		invs.id as idVisitdetail, cus.name, cp.name as nameproduct, bgc.code, bgc.firstName, bgc.lastName, bgc.idNumber, bgc.city, bgc.studyStartedOn, bgc.deliveredToCustomerOn, invs.totalValueCostVisit,
		invs.totalValueAddVisit, invs.totalValueTransportation, invs.totalValueFeeding, invs.totalValueStationery, invs.description, if(invs.isApprovedOP=1, "Si", if(invs.isApprovedOP=0,"No", "")) AS aprobado, CONCAT(usAp.firstName," ",usAp.lastName) AS aprobadoPor, invs.DateApprovedOP, vs.verificationSectionTypeId AS idSection, vs.id, cus.businessLine
		FROM ses_InvoiceVisitDetail invs 
		JOIN ses_InvoiceVisit inv ON invs.invoiceVisitId=inv.id
		JOIN ses_BackgroundCheck bgc ON invs.backgroundId=bgc.id
		JOIN ses_CustomerProduct cp ON invs.productId=cp.id
		JOIN ses_User us ON inv.visitId=us.id
		JOIN ses_Customer cus ON cus.id=cp.customerId
		LEFT JOIN ses_User usAp ON usAp.id=invs.ApprovedOPId
		JOIN ses_VerificationSection vs ON vs.backgroundCheckId=bgc.id
		WHERE inv.id="'.$id.'" AND (vs.verificationSectionTypeId=5 OR vs.verificationSectionTypeId=17 OR vs.verificationSectionTypeId=33 OR vs.verificationSectionTypeId=44 OR vs.verificationSectionTypeId=85)';
        $dateInvoiceDetail = Yii::app()->db->createCommand($query_A)->queryAll();
        return $dateInvoiceDetail;
		
	}

	public function getVerifcatedOn(){

		$verificationSec = VerificationSection::model()->findAllByAttributes(['backgroundCheckId'=>$this->backgroundId]);

		//var_dump($verificationSec);
		$visitaOn='';
		foreach($verificationSec as $dateReport) {
			//var_dump($dateReport);

			//echo $this->backgroundId;
			//echo $dateReport->verificationSectionTypeId;
			//die();
			if($dateReport->verificationSectionTypeId==5){
				$detailHousing =  DetailHousing::model()->findByAttributes(['verificationSectionId'=>$dateReport['id']]);
				$visitaOn=$detailHousing->visitedOn; 
				return $visitaOn;
			}else if($dateReport->verificationSectionTypeId==17){
				$detailCompanyVisit =  DetailCompanyVisit::model()->findByAttributes(['verificationSectionId'=>$dateReport['id']]);
				$visitaOn=$detailCompanyVisit->verifiedOn; 
				return $visitaOn;
			}else if($dateReport->verificationSectionTypeId==33 || $dateReport->verificationSectionTypeId==44 || $dateReport->verificationSectionTypeId==85){
				$otherSectionXml =  XmlSection::model()->findByAttributes(['verificationSectionId'=>$dateReport['id']]);
				$xmlanswer=$otherSectionXml->answer; 
		
				$XMLQuestionResult = array();
				$resultxml =  unserialize($otherSectionXml->answer) ;
				$XMLQuestionResult = array_merge($XMLQuestionResult, $resultxml);   
				if(isset($XMLQuestionResult['verifiedOn'])){
					$visitaOn=$XMLQuestionResult['verifiedOn'];
				}else{
					$visitaOn='';
				}
				return $visitaOn;
			}
		}

	}

	public function getUptaproveFac($id){

		$models = InvoiceVisitDetail::model()->findByAttributes(['id'=>$id]);
		$models->isApprovedOP=1;
		$models->ApprovedOPId=Yii::app()->user->id;
		$models->DateApprovedOP=new CDbExpression('NOW()');
		$models->update();

		WebUser::logAccess("Se realizo la aprobacion del estudio.", $models->background->code);
		return true;
	}

	public function getUptNotaproveFac($id){

		$models = InvoiceVisitDetail::model()->findByAttributes(['id'=>$id]);
		$models->isApprovedOP=0;
		$models->ApprovedOPId=Yii::app()->user->id;
		$models->DateApprovedOP=new CDbExpression('NOW()');
		$models->update();

		WebUser::logAccess("No se realizo la aprobacion del estudio.", $models->background->code);
		return true;
	}
}
//comment
