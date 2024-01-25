<?php

/**
 * This is the model class for table "{{CustomerGroup}}".
 *
 * The followings are the available columns in table '{{CustomerGroup}}':
 * @property integer $id
 * @property string $name
 * @property integer $userId
 * @property integer $invoiceClosingDay Description
 * @property integer $invoiceDay Day that should be used for invoice
 * @property string $paymentTerms  Payment Terms
 * @property boolean $invoicePerCustomer
 * @property int $invoiceFieldId   0-6, describes the number of personal field that describes the invoice
 * @property string $economicSector  sector economico
 * @property string $sizeGroup  tamaño de la empresa
 * @property string $customerAssigned  Comercial Asignado
 * @property boolean $alertGroupDoc
 *
 * The followings are the available model relations:
 * @property Customer[] $customers
 * @property Invoice[] $invoices
 * @property User $user
 * 
 * @property Product[] $customerProducts
 */
class CustomerGroup extends ActiveRecord {

    const SAV_ID = 49;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{CustomerGroup}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'name',
                'length',
                'max' => 200
            ),
            array(
                'paymentTerms',
                'length',
                'max' => 10
            ),
            array(
                'invoiceClosingDay',
                'numerical',
                'min' => 1,
                'max' => 31
            ),
            array(
                'invoiceDay',
                'numerical',
                'min' => 0,
                'max' => 31
            ),
            array('invoicePerCustomer, alertGroupDoc', 'boolean'),
            array(
                'invoiceFieldId',
                'numerical',
                'min' => 0,
                'max' => 6
            ),
            array('userId,invoiceDay', 'numerical', 'allowEmpty' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('economicSector,sizeGroup,customerAssigned',
                'safe'),
            array(
                'id, name, paymentTerms,InvoiceClosingDay,invoiceDay,invoicePerCustomer,invoiceFieldId,economicSector,sizeGroup,customerAssigned, alertGroupDoc',
                'safe',
                'on' => 'search'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customers' => array(
                self::HAS_MANY,
                'Customer',
                'customerGroupId',
                'order' => 'customers.name asc',
            ),
            'invoices' => array(
                self::HAS_MANY,
                'Invoice',
                'customerGroupId'
            ),
            'user' => array(
                self::BELONGS_TO,
                'User',
                'userId',
            ),
            'user2' => array(
                self::BELONGS_TO,
                'User',
                'customerAssigned',
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Grupo de Clientes',
            'paymentTerms' => 'Periodo de Pago',
            'invoiceClosingDay' => 'Día de Cierre',
            'invoiceDay' => 'Día de Facturación',
            'userId' => 'Asignado a',
            'invoicePerCustomer' => 'Factura por Cliente',
            'invoiceFieldId' => 'Campo Personalizado',
            'economicSector' => 'Sector Economico',
            'sizeGroup' => 'Tamaño',
            'customerAssigned' => 'Comercial Asignado',
            'alertGroupDoc'=>'Alerta Grupo'
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('invoiceClosingDay', $this->invoiceClosingDay);
        $criteria->compare('invoiceDay', $this->invoiceDay);
        $criteria->compare('paymentTerms', $this->paymentTerms, true);
        $criteria->compare('userId', $this->userId, true);
        $criteria->compare('invoicePerCustomer', $this->invoicePerCustomer);
        $criteria->compare('invoiceFieldId', $this->invoiceFieldId);
        $criteria->compare('economicSector', $this->economicSector);
        $criteria->compare('sizeGroup', $this->sizeGroup);
        $criteria->compare('customerAssigned', $this->customerAssigned);
        $criteria->compare('alertGroupDoc', $this->alertGroupDoc);
        

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 20,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CustomerGroup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCustomerProducts() {
        $criteria = new CDbCriteria;
        $criteria->compare('customer.customerGroupId', $this->id);
        $criteria->with[] = 'customer';
        return CustomerProduct::model()->findAll($criteria);
    }

    public function getCustomerProductByType($companyStudies = FALSE) {
        $criteria = new CDbCriteria;
        $criteria->compare('customer.customerGroupId', $this->id);
        $criteria->compare('t.isCompanySurvey', ($companyStudies ? 1 : 0));
        $criteria->with[] = 'customer';
        return CustomerProduct::model()->findAll($criteria);
    }

    public function getReportByCustomer($fromDate, $untilDate) {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
      SELECT 
        customer.id as customerId, 
        date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty
            
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.deliveredToCustomerOn IS NOT NULL
        and backgroundCheck.deliveredToCustomerOn >=:fromDate
        and backgroundCheck.deliveredToCustomerOn <=:untilDate

        
    GROUP BY
    customer.id ,
    date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m")
    '
                )
                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            if (!isset($ans[$row['customerId']])) {
                $ans[$row['customerId']] = array();
            }
            if (!isset($ans[$row['customerId']][$row['pDate']])) {
                $ans[$row['customerId']][$row['pDate']] = 0;
            }
            $ans[$row['customerId']][$row['pDate']] += $row['qty'];
        }
        return $ans;
    }

    public function getReportByCustomerCustomerProduct($fromDate , $untilDate ) {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
      SELECT 
        backgroundCheck.customerId as customerId, 
        customerProduct.name as customerProduct, 
        date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty
            
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_CustomerProduct customerProduct on (customerProduct.id=backgroundCheck.customerProductId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.deliveredToCustomerOn IS NOT NULL
        and backgroundCheck.deliveredToCustomerOn >=:fromDate
        and backgroundCheck.deliveredToCustomerOn <=:untilDate

        
    GROUP BY
    backgroundCheck.customerId,
    customerProduct.name,
    date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") 
    '
                )
                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            $customerProduct = ucwords(strtolower(preg_replace('/\.+(\s*)$/', '', $row['customerProduct'])));

            if (!isset($ans[$row['customerId']])) {
                $ans[$row['customerId']] = array();
            }
            if (!isset($ans[$row['customerId']][$customerProduct])) {
                $ans[$row['customerId']][$customerProduct] = array();
            }
            if (!isset($ans[$row['customerId']][$customerProduct][$row['pDate']])) {
                $ans[$row['customerId']][$customerProduct][$row['pDate']] = 0;
            }
            $ans[$row['customerId']][$customerProduct][$row['pDate']] += $row['qty'];
        }

        return $ans;
    }

    public function getReportByProduct($fromDate , $untilDate) {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
      SELECT 
        customerProduct.name as customerProduct, 
        date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty
            
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_CustomerProduct customerProduct on (customerProduct.id=backgroundCheck.customerProductId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.deliveredToCustomerOn IS NOT NULL
        and backgroundCheck.deliveredToCustomerOn >=:fromDate
        and backgroundCheck.deliveredToCustomerOn <=:untilDate
        
        
    GROUP BY
    backgroundCheck.customerProductId ,
    date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") 
    '
                )
                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            $customerProduct = ucwords(strtolower(preg_replace('/\.+(\s*)$/', '', $row['customerProduct'])));
            if (!isset($ans[$customerProduct])) {
                $ans[$customerProduct] = array();
            }
            if (!isset($ans[$customerProduct][$row['pDate']])) {
                $ans[$customerProduct][$row['pDate']] = 0;
            }
            $ans[$customerProduct][$row['pDate']] += $row['qty'];
        }
        return $ans;
    }

    public function getReportByResult($fromDate , $untilDate ) {
        $ans = array();
        //SUM(backgroundCheck.findingReturn) AS retorno,
        $data = Yii::app()->db->createCommand(
            '
      SELECT 
        result.id as resultId, 
        date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty, 
		  SUM(backgroundCheck.findingLaboralHistory) AS laboral, 
		  SUM(backgroundCheck.findingSocioeconomic) AS socioeco,
		  SUM(backgroundCheck.findingVisit) AS visit,
		  SUM(backgroundCheck.findingStudy) AS study,
		  SUM(backgroundCheck.findingPolygraph) as polygraph,
		  SUM(backgroundCheck.findingOther) AS other,
          SUM(backgroundCheck.findingfinantAnalys) AS financiero,     
          SUM(backgroundCheck.findingAudit) AS auditoria,     
          SUM(backgroundCheck.findingBackground) AS antecedentes,     
          SUM(backgroundCheck.findingrestricList) AS listas,     
          SUM(backgroundCheck.findingDoc) AS documentos    
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_Result result on (result.id=backgroundCheck.resultId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.deliveredToCustomerOn IS NOT NULL
        and backgroundCheck.deliveredToCustomerOn >=:fromDate
        and backgroundCheck.deliveredToCustomerOn <=:untilDate
        
        
    GROUP BY
    date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") ,
    backgroundCheck.resultId
    ORDER BY backgroundCheck.resultId ASC
    '
                )
                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            $resultId = $row['resultId'];
            if (!isset($ans[$resultId])) {
                $ans[$resultId] = array();
            }
            if (!isset($ans[$resultId][$row['pDate']])) {
                $ans[$resultId][$row['pDate']] = 0;
            }
            $ans[$resultId][$row['pDate']] += $row['qty'];
        }
        return $ans;
    }
//Creada por Jeimy
    public function getReportDetailByResult($fromDate , $untilDate ) {
        $ans = array();
        //SUM(backgroundCheck.findingReturn) AS retorno,

        $data = Yii::app()->db->createCommand(
            '
      SELECT 
      result.name,
        backgroundCheck.resultId as resultId, 
        date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty, 
        SUM(backgroundCheck.findingLaboralHistory) AS laboral, 
        SUM(backgroundCheck.findingSocioeconomic) AS socioeco,
        SUM(backgroundCheck.findingVisit) AS visit,
        SUM(backgroundCheck.findingStudy) AS study,
        SUM(backgroundCheck.findingPolygraph) as polygraph,
        SUM(backgroundCheck.findingOther) AS other,
        SUM(backgroundCheck.findingfinantAnalys) AS financiero,     
        SUM(backgroundCheck.findingAudit) AS auditoria,     
        SUM(backgroundCheck.findingBackground) AS antecedentes,     
        SUM(backgroundCheck.findingrestricList) AS listas,     
        SUM(backgroundCheck.findingDoc) AS documentos                
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_Result result on (result.id=backgroundCheck.resultId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.deliveredToCustomerOn IS NOT NULL
        and backgroundCheck.deliveredToCustomerOn >=:fromDate
        and backgroundCheck.deliveredToCustomerOn <=:untilDate
        
        
    GROUP BY
    backgroundCheck.resultId
    ORDER BY backgroundCheck.resultId ASC
    '
        )
            ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            $resultId = $row['resultId'];
            $ans[$resultId]=$row;
        }
        return $ans;
    }


  // Actualizada por Jonathan
  public function getReportBytimeTotal($fromDate, $untilDate) {
       

    $data = Yii::app()->db->createCommand(
        'select 
          SUM(IF(DATEDIFF(bc.`deliveredToCustomerOn`,bc.`studyStartedOn`)<=5,1,0)) as total_hasta_cinco,
          SUM(IF(DATEDIFF(bc.`deliveredToCustomerOn`,bc.`studyStartedOn`)<100,1,0)) as total_mayor_cinco
        from ses_BackgroundCheck bc
        join ses_Customer c on (bc.`customerId`=c.`id`) 
        join ses_CustomerProduct cp on (bc.`customerProductId`=cp.`id`)
        where bc.`deliveredToCustomerOn`  between :fromDate and  :untilDate
        and c.`customerGroupId`=' . $this->id
)

        ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));
      
       return $data;

}


    // Actualizada por Jonathan
    public function getReportBytimeresp($fromDate, $untilDate) {

        //Holiday::numOfWorkingDays($from, $until);
        $datad="DELETE FROM ses_TempDaysInfG";
        $query = Yii::app()->db->createCommand($datad)->execute();

        $dataReg = Yii::app()->db->createCommand(
            '
            SELECT 
            c.customerGroupId, cp.name as nombre, bc.code, 
            bc.deliveredToCustomerOn,bc.studyStartedOn, cp.maxDays
            from ses_BackgroundCheck bc
            join ses_Customer c on (bc.customerId=c.id) 
            join ses_CustomerProduct cp on (bc.customerProductId=cp.id)
            where c.customerGroupId="' . $this->id . '"
            and bc.deliveredToCustomerOn IS NOT NULL
            and bc.deliveredToCustomerOn >=:fromDate
            and bc.deliveredToCustomerOn <=:untilDate
            GROUP BY  cp.name, bc.code, 
            bc.deliveredToCustomerOn,bc.studyStartedOn')
        ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($dataReg as $row) {

            $days=Holiday::numOfWorkingDays($row['studyStartedOn'], $row['deliveredToCustomerOn']);
            $data="INSERT INTO ses_TempDaysInfG (idCustomerGroup, typeProduct, code, deliveredToCustomerOn, studyStartedOn, daysStudy, maxDaysCustomer)
                   VALUES ('".$row['customerGroupId']."', '".$row['nombre']."', '".$row['code']."', '".$row['deliveredToCustomerOn']."', '".$row['studyStartedOn']."', '".$days."', '".$row['maxDays']."')";
            $query = Yii::app()->db->createCommand($data)->execute();


        }
        
        /*$ans = array();

        $data = Yii::app()->db->createCommand(
            '
            SELECT 

            cp.name as nombre, count(bc.customerProductId) total_estudios, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)<1,1,0)) as cero, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)=1,1,0)) as uno, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)=2,1,0)) as dos, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)=3,1,0)) as tres, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)=4,1,0)) as cuatro, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)=5,1,0)) as cinco, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)>5,1,0)) as mayor5, 
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)<=5,1,0)) as total_hasta_cinco,
            SUM(IF(DATEDIFF(bc.deliveredToCustomerOn,bc.studyStartedOn)<100,1,0)) as total_mayor_cinco

            from ses_BackgroundCheck bc
            join ses_Customer c on (bc.customerId=c.id) 
            join ses_CustomerProduct cp on (bc.customerProductId=cp.id)
            where c.customerGroupId="' . $this->id . '"
                and bc.deliveredToCustomerOn IS NOT NULL
                and bc.deliveredToCustomerOn >=:fromDate
                and bc.deliveredToCustomerOn <=:untilDate
                
            GROUP BY cp.name
            '
        )

            ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));
        foreach ($data as $row) {
            $total_estudios = $row['nombre'];
            $ans[$total_estudios]=$row;
        }
        return $ans;*/

        $ans = array();

        $data = Yii::app()->db->createCommand(
            '
            SELECT 
            td.typeProduct as nombre, td.maxDaysCustomer, count(td.idCustomerGroup) total_estudios, 
            MAX(td.daysStudy) AS dias_estudio,
            SUM(IF(td.daysStudy<1,1,0)) as cero, 
            SUM(IF(td.daysStudy=1,1,0)) as uno, 
            SUM(IF(td.daysStudy=2,1,0)) as dos, 
            SUM(IF(td.daysStudy=3,1,0)) as tres, 
            SUM(IF(td.daysStudy=4,1,0)) as cuatro, 
            SUM(IF(td.daysStudy=5,1,0)) as cinco, 
            SUM(IF(td.daysStudy>5,1,0)) as mayor5, 
            SUM(IF(td.daysStudy<=5,1,0)) as total_hasta_cinco,
            SUM(IF(td.daysStudy<100,1,0)) as total_mayor_cinco
            from ses_TempDaysInfG td
            where td.idCustomerGroup="' . $this->id . '"
                and td.deliveredToCustomerOn IS NOT NULL
                and td.deliveredToCustomerOn >=:fromDate
                and td.deliveredToCustomerOn <=:untilDate
            GROUP BY td.typeProduct, td.maxDaysCustomer
            '
        )

            ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));
        foreach ($data as $row) {
            $total_estudios = $row['nombre'];
            $ans[$total_estudios]=$row;
        }
        return $ans;

    }

    public function getReportByCustomerResult($fromDate, $untilDate) {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
      SELECT 
        backgroundCheck.customerId as customerId, 
        backgroundCheck.resultId as resultId, 
        date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty
            
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.deliveredToCustomerOn IS NOT NULL
        and backgroundCheck.deliveredToCustomerOn >=:fromDate
        and backgroundCheck.deliveredToCustomerOn <=:untilDate
        
    GROUP BY
    customer.id ,
    backgroundCheck.resultId,
    date_format(backgroundCheck.deliveredToCustomerOn,"%y-%m") 
    '
                )
                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            if (!isset($ans[$row['customerId']])) {
                $ans[$row['customerId']] = array();
            }
            if (!isset($ans[$row['customerId']][$row['resultId']])) {
                $ans[$row['customerId']][$row['resultId']] = array();
            }
            if (!isset($ans[$row['customerId']][$row['resultId']][$row['pDate']])) {
                $ans[$row['customerId']][$row['resultId']][$row['pDate']] = 0;
            }
            $ans[$row['customerId']][$row['resultId']][$row['pDate']] += $row['qty'];
        }
        return $ans;
    }

    public function getReportStudiesCancelled($fromDate , $untilDate) {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
      SELECT 
        backgroundCheckStatus.name as backgroundCheckStatus, 
        date_format(backgroundCheck.studyLimitOn,"%y-%m") as pDate,
        count(backgroundCheck.id) as qty
            
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_BackgroundCheckStatus backgroundCheckStatus on (backgroundCheckStatus.id=backgroundCheck.backgroundCheckStatusId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
        and backgroundCheck.studyLimitOn >=:fromDate
        and backgroundCheck.studyLimitOn <=:untilDate
        and (
        backgroundCheck.backgroundCheckStatusId=' . BackgroundCheckStatus::CANCELLED . '
        or backgroundCheck.backgroundCheckStatusId=' . BackgroundCheckStatus::PARTIAL_CANCELLED . '
    )
        
    GROUP BY
    backgroundCheck.backgroundCheckStatusId ,
    date_format(backgroundCheck.studyLimitOn,"%y-%m")
    '
                )
                ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

        foreach ($data as $row) {
            if (!isset($ans[$row['backgroundCheckStatus']])) {
                $ans[$row['backgroundCheckStatus']] = array();
            }
            if (!isset($ans[$row['backgroundCheckStatus']][$row['pDate']])) {
                $ans[$row['backgroundCheckStatus']][$row['pDate']] = 0;
            }
            $ans[$row['backgroundCheckStatus']][$row['pDate']] += $row['qty'];
        }
        return $ans;
    }

    public function getReportStudiesInProgress() {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
      SELECT 
        customer.id as customerId, 
        customerProduct.name as customerProduct, 
        count(backgroundCheck.id) as qty
            
     FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_CustomerProduct customerProduct on (customerProduct.id=backgroundCheck.customerProductId)
     
WHERE 
    customer.customerGroupId="' . $this->id . '"
          and (
        backgroundCheck.backgroundCheckStatusId=' . BackgroundCheckStatus::REQUESTED . '
        or backgroundCheck.backgroundCheckStatusId=' . BackgroundCheckStatus::PROCESSING . '
         )
        
    GROUP BY
        customer.id , 
    customerProduct.name 
    '
                )
                ->queryAll(TRUE, array());

        foreach ($data as $row) {
            $customerProduct = ucwords(strtolower(preg_replace('/\.+(\s*)$/', '', $row['customerProduct'])));
            if (!isset($ans[$customerProduct])) {
                $ans[$customerProduct] = array();
            }
            if (!isset($ans[$customerProduct][$row['customerId']])) {
                $ans[$customerProduct][$row['customerId']] = 0;
            }
            $ans[$customerProduct][$row['customerId']] += $row['qty'];
        }
        return $ans;
    }

    public function getReportSectionsInProgress() {
        $ans = array();

        $data = Yii::app()->db->createCommand(
                        '
    SELECT 
        verificationSectionType.name as verificationSectionType, 
        customerProduct.name as customerProduct, 
        sum(if(verificationSection.percentCompleted>=100,1,0)) as qtyCompleted,
        sum(if(verificationSection.percentCompleted<100,1,0)) as qtyPending
            
    FROM
     ses_BackgroundCheck backgroundCheck
     join ses_Customer customer on (customer.id=backgroundCheck.customerId)
     join ses_CustomerProduct customerProduct on (customerProduct.id=backgroundCheck.customerProductId)
     join ses_VerificationSection verificationSection on (verificationSection.backgroundCheckId=backgroundCheck.id)
     join ses_VerificationSectionType verificationSectionType on (verificationSectionType.id=verificationSection.verificationSectionTypeId)
     
    WHERE 
        customer.customerGroupId="' . $this->id . '"
        and (
            backgroundCheck.backgroundCheckStatusId=' . BackgroundCheckStatus::REQUESTED . '
            or backgroundCheck.backgroundCheckStatusId=' . BackgroundCheckStatus::PROCESSING . '
         )
        
    GROUP BY
        verificationSectionType.id , 
        customerProduct.name
    '
                )
                ->queryAll(TRUE, array());

        foreach ($data as $row) {
            $customerProduct = ucwords(strtolower(preg_replace('/\.+(\s*)$/', '', $row['customerProduct'])));
            if (!isset($ans[$customerProduct])) {
                $ans[$customerProduct] = array();
            }
            if (!isset($ans[$customerProduct][$row['verificationSectionType']])) {
                $ans[$customerProduct][$row['verificationSectionType']] = array('qtyCompleted' => 0, 'qtyPending' => 0);
            }
            $ans[$customerProduct][$row['verificationSectionType']]['qtyCompleted'] += $row['qtyCompleted'];
            $ans[$customerProduct][$row['verificationSectionType']]['qtyPending'] += $row['qtyPending'];
        }
        return $ans;
    }


    public function getReportEventDelay($fromDate , $untilDate) {
        $ans = array();

        /*/$data = Yii::app()->db->createCommand(
            '
            SELECT evtn.name AS tipo_retraso, COUNT(evtn.name) AS cant_retraso
            FROM
            ses_BackgroundCheck backgroundCheck
            join ses_Customer customer on (customer.id=backgroundCheck.customerId)
            JOIN ses_Event ev ON (ev.backgroundCheckId=backgroundCheck.id)
            JOIN ses_EventType evt ON (evt.id=ev.eventTypeId)
            JOIN ses_EventTypeNews evtn ON (evtn.id=ev.eventTypeNewsId)
            WHERE
            customer.customerGroupId="'.$this->id.'"
            and backgroundCheck.deliveredToCustomerOn IS NOT NULL
            and backgroundCheck.deliveredToCustomerOn >=:fromDate
            and backgroundCheck.deliveredToCustomerOn <=:untilDate
            AND ev.eventTypeId="1" AND ev.eventTypeNewsId!="1" AND ev.informedToCustomerOn IS NOT NULL
            GROUP BY
            evtn.name
            ORDER BY cant_retraso DESC'
                )

            ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));*/
            /*$data = Yii::app()->db->createCommand(    
                '
                SELECT evtn.name AS tipo_retraso, COUNT(evtn.id) AS cant_retraso
                FROM ses_Event ev 
                JOIN ses_EventType evt ON (evt.id=ev.eventTypeId)
                JOIN ses_EventTypeNews evtn ON (evtn.id=ev.eventTypeNewsId)
                WHERE ev.eventTypeId="1" AND ev.eventTypeNewsId!="1" AND ev.informedToCustomerOn IS NOT NULL 
                AND ev.id IN (SELECT MAX(ev.id) FROM  ses_BackgroundCheck bgc 
                                                JOIN ses_Event ev ON (ev.backgroundCheckId=bgc.id)
                                                JOIN ses_Customer cus ON (bgc.customerId=cus.id)
                                                WHERE
                                                cus.customerGroupId="'.$this->id.'"
                                                and bgc.deliveredToCustomerOn IS NOT NULL
                                                and bgc.deliveredToCustomerOn >=:fromDate
                                                AND bgc.deliveredToCustomerOn <=:untilDate
                                                GROUP BY ev.backgroundCheckId)
                GROUP BY evtn.name
                ORDER BY cant_retraso DESC
                '
            )*/
            $data = Yii::app()->db->createCommand(    
                '
                SELECT evtn.name AS tipo_retraso, COUNT(TypeEventid) AS cant_retraso
                FROM (
                    SELECT ev.eventTypeNewsId AS TypeEventid, MAX(ev.informedToCustomerOn) AS MaxDate, ev.eventTypeId, ev.backgroundCheckId
                    FROM ses_Event ev
                    JOIN ses_BackgroundCheck bgc ON (ev.backgroundCheckId=bgc.id)
                    JOIN ses_Customer cus ON (bgc.customerId=cus.id)
                    WHERE cus.customerGroupId="'.$this->id.'" AND bgc.deliveredToCustomerOn IS NOT NULL 
                    AND bgc.deliveredToCustomerOn >=:fromDate AND bgc.deliveredToCustomerOn <=:untilDate
                    AND ev.eventTypeId="1" AND ev.eventTypeNewsId!="1" AND ev.informedToCustomerOn IS NOT NULL
                    GROUP BY ev.backgroundCheckId
                    ) t1
                JOIN ses_EventTypeNews evtn ON (evtn.id=t1.TypeEventid)
                GROUP BY t1.TypeEventid
                ORDER BY cant_retraso DESC
                '
                )
            ->queryAll(TRUE, array(':fromDate' => $fromDate, ':untilDate' => $untilDate));

            foreach ($data as $row) {
                $total_retraso = $row['tipo_retraso'];
                $ans[$total_retraso]=$row;
            }
        return $ans;
    }

}
