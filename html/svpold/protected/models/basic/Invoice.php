<?php

/**
 * This is the model class for table "{{Invoice}}".
 *
 * The followings are the available columns in table '{{Invoice}}':
 * @property integer $id
 * @property string $from
 * @property string $until
 * @property string $dueOn
 * @property string $comments
 * @property boolean $closed
 * @property integer $customerGroupId
 * @property integer $number
 * @property Date $invoiceDate
 * @property Date  $paymentDate
 * @property integer $totalRecieved
 * @property integer $subTotal Is the price of studies plus products
 * @property integer $tax is the tax applied to subTotal-discount
 * @property integer $discount  Is the discount in the invoice
 * @property integer $pendingPayment  Is the calculated payment Payment
 * @property string $invoiceDescriptor  Description of the invoice
 *
 * The followings are the available model relations:
 * @property BackgroundCheck[] $backgroundChecks
 * @property CustomerGroup $customerGroup
 */
class Invoice extends CActiveRecord {

    const ONLY_INVOICE = 1;
    const NOT_ASSIGNED = 2;
    const NOT_ASSIGNED_AND_INVOICE = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Invoice}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customerGroupId', 'required'),
            array('customerGroupId,number,tax,totalReceived,discount', 'numerical', 'integerOnly' => true),
            array('from, until, dueOn, invoiceDate, paymentDate,comments,invoiceDescriptor', 'safe'),
            array('closed', 'boolean'),

            array('invoiceDescriptor',
            'length', 'max' => 255),

            array('number, discount, tax, totalReceived',
            'length', 'max' => 50),
            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, from, until, dueOn, invoiceDate, comments, closed, '
                . 'customerGroupId,paymentDate,tax,totalRecieved,discount,'
                . 'invoiceDescriptor', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'backgroundChecks' => array(self::HAS_MANY, 'BackgroundCheck', 'invoiceId'),
            'customerGroup' => array(self::BELONGS_TO, 'CustomerGroup', 'customerGroupId'),
            'invoiceDetails' => array(self::HAS_MANY, 'InvoiceDetail', 'invoiceId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'from' => 'Facturación Desde',
            'until' => 'Facturación Hasta',
            'dueOn' => 'Factura Vence en',
            'comments' => 'Commentarios',
            'closed' => 'Factura Cerrada',
            'numberOfStudies' => 'Estudios',
            'customerGroupId' => 'Grupo de Clientes',
            'number' => 'Número',
            'total' => 'Total',
            'invoiceDate' => 'Fecha de Factura',
            'paymentDate' => 'Fecha de Pago',
            'totalReceived' => 'Total recibido',
            'subTotal' => 'Subtotal',
            'discount' => 'Descuento',
            'tax' => 'Impuestos',
            'pendingPayment' => 'Pago pendiente',
            'totalWithTax' => 'Total+Imp',
            'totalInvoiceDetail' => 'Total Otros',
            'totalStudies' => 'Total Estdios',
            'numberStudies' => 'Num. Estudios',
            'invoiceDescription' => 'Descriptor',
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
    public function search($pageSize = 20) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('`from`', $this->from, true);
        $criteria->compare('until', $this->until, true);
        $criteria->compare('dueOn', $this->dueOn, true);
        $criteria->compare('comments', $this->comments, true);
        $criteria->compare('closed', $this->closed);
        $criteria->compare('customerGroupId', $this->customerGroupId);
        $criteria->compare('number', $this->number, false);
        $criteria->compare('invoiceDate', $this->invoiceDate, true);
        $criteria->compare('paymentDate', $this->paymentDate, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('tax', $this->tax, true);
        $criteria->compare('totalReceived', $this->totalReceived, true);
        $criteria->compare('invoiceDescriptor', $this->invoiceDescriptor, true);


        $criteria->order = 'until desc';


        GridViewFilter::setFilter($this, 'search');


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => $pageSize,
            ),
            'sort' => array(
                'defaultOrder' => 'invoiceDate DESC',
            ),
        ));
    }

    public function getNumberOfStudies() {
        return count($this->backgroundChecks);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Invoice the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getStudySlection() {
        return array(
            Invoice::ONLY_INVOICE => 'Estudios Asignados',
            Invoice::NOT_ASSIGNED => 'Estudios NO Asignados',
            Invoice::NOT_ASSIGNED_AND_INVOICE => 'Estudios Asignados y NO Asignados',
        );
    }

    public static function getStudySlectionShort() {
        return array(
            Invoice::ONLY_INVOICE => 'Asig',
            Invoice::NOT_ASSIGNED => 'NO Asig',
            Invoice::NOT_ASSIGNED_AND_INVOICE => 'Asig + No',
        );
    }

    public Static function getNextInvoice($customerGroupId) {

        $invoice = new Invoice();

        $invoice->from = Yii::app()->db->createCommand('select now();')->queryScalar();
        $invoice->until = Yii::app()->db->createCommand('select now();')->queryScalar();
        $invoice->invoiceDate = Yii::app()->db->createCommand('select now();')->queryScalar();
        $invoice->dueOn = Yii::app()->db->createCommand('select now();')->queryScalar();

        $customerGroup = CustomerGroup::model()->findByPk($customerGroupId);


        if ($customerGroup) {
            $lastInvoice = Invoice::model()->findByAttributes(
                    array('customerGroupId' => $customerGroupId), array('order' => 'until desc, number desc'));

            if ($lastInvoice && $lastInvoice->until && $lastInvoice->until != '0000-00-00') {

                $until = $lastInvoice->until;
                $invoice->from = Yii::app()->db->createCommand('select date_add("' . $until . '",INTERVAL 1 day);')->queryScalar();
                $invoice->until = Yii::app()->db->createCommand('select date_add(date_add("' . $invoice->from . '",INTERVAL 1 Month),INTERVAL -1 day);')->queryScalar();
                $invoice->invoiceDate = Yii::app()->db->
                                createCommand('select date_add(' .
                                        'date_add(' .
                                        'date_format("' . $invoice->until . '","%Y-%m-%d"),INTERVAL 1 day),' .
                                        'INTERVAL ' . (int) ($customerGroup->invoiceDay - 1) . ' day);')->queryScalar();
                switch (strtolower(substr($customerGroup->paymentTerms, -1))) {
                    case 'd':
                        $totalDays = (int) substr($customerGroup->paymentTerms, 0, strlen($customerGroup->paymentTerms) - 1);
                        $months = (int) $totalDays / 30;
                        $days = (int) $totalDays % 30;
                        $tempDate = $invoice->invoiceDate;
                        if ($months > 0) {
                            $tempDate = Yii::app()->db->createCommand('select date_add("' . $tempDate . '",INTERVAL ' . $months . ' Month);')->queryScalar();
                        }
                        $invoice->dueOn = Yii::app()->db->createCommand('select date_add("' . $tempDate . '",INTERVAL ' . $days . ' Day);')->queryScalar();
                        break;
                    default :
                        $invoice->dueOn = $invoice->invoiceDate;
                        break;
                }
            }
        }
        return $invoice;
    }

    public function getSubTotal() {
        return $this->totalStudies + $this->totalInvoiceDetail;
    }

    public function getTotal() {
        return ($this->subTotal - $this->discount + $this->tax);
    }

    public function getTotalWithTax() {
        return ($this->total + $this->tax);
    }

    public function getPendingPayment() {
        return ($this->total - $this->totalReceived);
    }

    public function getDeletable() {
        return (count($this->backgroundChecks) == 0 && count($this->invoiceDetails) == 0 );
    }

    public function getTotalInvoiceDetail() {
        $total = 0;
        foreach ($this->invoiceDetails as $invoiceDetail) {
            $total+=$invoiceDetail->unitValue * $invoiceDetail->qty;
        }
        return $total;
    }

    public function getTotalStudies() {
        $total = 0;
        foreach ($this->backgroundChecks as $backgroundCheck) {
            $total+=$backgroundCheck->price + $backgroundCheck->additionalPrice;
        }
        return $total;
    }

    public function getNumStudies() {
        return count($this->backgroundChecks);
    }

    /**
     * 
     * @param BackgroundCheck $backgroundCheck
     * @param string $date
     * @param string $option
     * @return integer
     */
    static public function getOpenInvoice($backgroundCheck) {
        /* @var $invoice Invoice */
        $invoiceId = NULL;
        $criteria = new CDbCriteria;
        $criteria->addCondition('curdate() between `t`.`from` and `t`.`until` and `t`.`closed`=0');
        $criteria->addCondition('customerGroup.id = :customerGroupId');
        $criteria->with = array('customerGroup');
        $criteria->params[':customerGroupId'] = (int) $backgroundCheck->customer->customerGroupId;
        $invoiceDescriptor = array();
        $descriptor = '';
        if ($backgroundCheck->customer->customerGroup && $backgroundCheck->customer->customerGroup->invoicePerCustomer) {
            $invoiceDescriptor[] = trim($backgroundCheck->customer->name);
        }
        if ($backgroundCheck->customer->customerGroup && (int) $backgroundCheck->customer->customerGroup->invoiceFieldId > 0 && (int) $backgroundCheck->customer->customerGroup->invoiceFieldId <= 6) {
            $field = 'customerField' . (int) $backgroundCheck->customer->customerGroup->invoiceFieldId;
            $invoiceDescriptor[] = trim($backgroundCheck->$field);
        }
        if (count($invoiceDescriptor) > 0) {
            $descriptor = implode(' , ', $invoiceDescriptor);
            $criteria->addCondition('t.invoiceDescriptor = :descriptor');
            $criteria->params[':descriptor'] = $descriptor;
        }


        $criteria->order = ' t.id asc';

        $invoice = Invoice::model()->find($criteria);

        if ($invoice) {
            $invoiceId = $invoice->id;
        } else {

            $bcDate = new DateTime();

            $closingDay = (int) $backgroundCheck->customer->invoiceClosingDay;

            if ($closingDay == 30 || $closingDay == 31) {
                $firstDateOfInvoice = new DateTime($bcDate->format('Y-m') . '-' . 1);
            } else if ($closingDay > (int) $bcDate->format('d')) {
                $firstDateOfInvoice = new DateTime($bcDate->format('Y-m') . '-' . $closingDay);
                $firstDateOfInvoice->sub(new DateInterval('P1M'));
            } else {
                $bcDate->sub(new DateInterval('P' . (int) ($backgroundCheck->customer->invoiceClosingDay - 1) . 'D'));
                $firstDateOfInvoice = new DateTime($bcDate->format('Y-m') . '-' . (int) $backgroundCheck->customer->invoiceClosingDay);
            }

            $lastDateOfInvoice = clone $firstDateOfInvoice;
            $lastDateOfInvoice->add(new DateInterval('P1M'));
            $lastDateOfInvoice->sub(new DateInterval('P1D'));

            if ($backgroundCheck->customer->getInvoiceDay() == 0) {
                $dateOfInvoice = clone $lastDateOfInvoice;
                $dateOfInvoice->add(new DateInterval('P1D'));
            } else {
                $dateOfInvoice = new DateTime($lastDateOfInvoice->format('Y-m-') . $backgroundCheck->customer->getInvoiceDay());
                if ($dateOfInvoice < $lastDateOfInvoice) {
                    $dateOfInvoice->add(new DateInterval('P1M'));
                }
            }
            $dueOn = clone $dateOfInvoice;

            if (!(preg_match('/\d+[mMdM]/', $backgroundCheck->customer->paymentTerms) === FALSE)) {
                $paymentTerms = ( strtoupper($backgroundCheck->customer->paymentTerms));
                switch ($paymentTerms) {
                    case '30D':$paymentTerms = '1M';
                        break;
                    case '60D':$paymentTerms = '2M';
                        break;
                    case '90D':$paymentTerms = '3M';
                        break;
                }
                $dueOn->add(new DateInterval('P' . $paymentTerms));
                $dueOn->sub(new DateInterval('P1D'));
            }

            $invoice = new Invoice();
            $invoice->customerGroupId = $backgroundCheck->customer->customerGroupId;
            $invoice->from = $firstDateOfInvoice->format('Y-m-d');
            $invoice->until = $lastDateOfInvoice->format('Y-m-d');
            $invoice->invoiceDate = $dateOfInvoice->format('Y-m-d');
            $invoice->dueOn = $dueOn->format('Y-m-d');
            $invoice->closed = FALSE;
            $invoice->invoiceDescriptor = $descriptor;

            if (!$invoice->save()) {
                throw new CHttpException(500, 'Server Error.');
            }

            $invoiceId = $invoice->id;
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

}
