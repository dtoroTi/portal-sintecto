<?php

/**
 * This is the model class for table "{{Compliance}}".
 *
 * The followings are the available columns in table '{{Compliance}}':
 * @property integer $id
 * @property string $dateReport
 * @property string $name
 * @property string $lastname
 * @property string $address
 * @property string $IdCompliance
 * @property string $typeLink
 * @property string $unusualOperation
 * @property string $suspiciousOperation
 * @property string $alertsignal
 * @property string $aros
 * @property string $arostimeinit
 * @property string $arostimeend
 * @property string $importance
 * @property string $urgency
 * @property string $currency
 * @property string $laftsource
 * @property string $otherAlerts
 * @property string $counterpartType
 * @property string $operationType
 * @property string $transactionvalue
 * @property string $transactioncurrency
 * @property string $transectiondate
 * @property string $description
 * @property string $analysis
 * @property string $P1lastname1
 * @property string $P1lastname2
 * @property string $P2lastname1
 * @property string $P2lastname2
 * @property string $P3lastname1
 * @property string $P3lastname2
 * @property string $P4lastname1
 * @property string $P4lastname2
 * @property string $P1name
 * @property string $P2name
 * @property string $P3name
 * @property string $P4name
 * @property string $P1id
 * @property string $P2id
 * @property string $P3id
 * @property string $P4id
 * @property string P1typeid
 * @property string P2typeid
 * @property string P3typeid
 * @property string P4typeid
 * @property string $P1address
 * @property string $P2address
 * @property string $P3address
 * @property string $P4address
 * @property string $P1tel
 * @property string $P2tel
 * @property string $P3tel
 * @property string $P4tel
 * @property string $E1businessname
 * @property string $E2businessname
 * @property string $E3businessname
 * @property string $E4businessname
 * @property string $E1nit
 * @property string $E2nit
 * @property string $E3nit
 * @property string $E4nit
 * @property string $E1replegal
 * @property string $E2replegal
 * @property string $E3replegal
 * @property string $E4replegal
 * @property string $E1replegalid
 * @property string $E2replegalid
 * @property string $E3replegalid
 * @property string $E4replegalid
 * @property string $E1typeid
 * @property string $E2typeid
 * @property string $E3typeid
 * @property string $E4typeid
 * @property string $E1address
 * @property string $E2address
 * @property string $E3address
 * @property string $E4address
 * @property string $E1tel
 * @property string $E2tel
 * @property string $E3tel
 * @property string $E4tel
 * @property string $E1ciiu
 * @property string $E2ciiu
 * @property string $E3ciiu
 * @property string $E4ciiu
 * @property string $E1dept
 * @property string $E2dept
 * @property string $E3dept
 * @property string $E4dept
 * @property string $E1product
 * @property string $E2product
 * @property string $E3product
 * @property string $E4product
 * @property string $E1vinculat
 * @property string $E2vinculat
 * @property string $E3vinculat
 * @property string $E4vinculat
 * @property string $additionalremarks
 * @property integer $customerid
 * @property int $userId

 */
class Compliance extends ActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Compliance the static model class
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return '{{Compliance}}';
    }
    /**
     * @return array validation rules for model attributes.
     */

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, dateReport', 'required'),
            array('lastname, address,IdCompliance,typeLink,unusualOperation,'
                . 'suspiciousOperation,alertsignal,aros,'
                . 'arostimeinit,arostimeend,importance,'
                . 'urgency,currency,laftsource,'
                . 'otherAlerts,counterpartType,operationType,transactionvalue,transactioncurrency,'
                .'transectiondate,description,analysis,P1lastname1,P1lastname2,P2lastname1,P2lastname2,'
                .'P3lastname1,P3lastname2,P4lastname1,P4lastname2,P1name,P2name,P3name,P4name,P1id,P2id,P3id,P4id,'
                .'P1typeid,P2typeid,P3typeid,P4typeid,'
                .'P1address,P2address,P3address,P4address,P1tel,P2tel,P3tel,P4tel,'
                .'E1businessname,E2businessname,E3businessname,E4businessname,E1nit,E2nit,E3nit,E4nit,'
                .'E1replegal,E2replegal,E3replegal,E4replegal,E1replegalid,E2replegalid,E3replegalid,E4replegalid,'
                .'E1typeid,E2typeid,E3typeid,E4typeid,E1address,E2address,E3address,E4address,E1tel,E2tel,E3tel,E4tel,'
                .'E1ciiu,E2ciiu,E3ciiu,E4ciiu,E1dept,E2dept,E3dept,E4dept,E1product,E2product,E3product,E4product,'
                .'E1vinculat,E2vinculat,E3vinculat,E4vinculat,additionalremarks,customerid,userId', 'safe'),

            array('name, lastname, IdCompliance, address, transactionvalue, P1id, P1lastname1, P1lastname2,'
                .' P1name, P1address, P1tel, P2id, P2lastname1, P2lastname2, P2name, P2address, P2tel,'
                .' P3id, P3lastname1, P3lastname2, P3name, P3address, P3tel, P4id, P4lastname1, P4lastname2, P4name, P4address, P4tel',
                'length',
                'max' => 50),

            array('E1businessname, E1nit, E1replegal, E1replegalid, E1address, E1tel, E1ciiu, E1dept, E1product, '
                .'E2businessname, E2nit, E2replegal, E2replegalid, E2address, E2tel, E2ciiu, E2dept, E2product, '
                .'E3businessname, E3nit, E3replegal, E3replegalid, E3address, E3tel, E3ciiu, E3dept, E3product, '
                .'E4businessname, E4nit, E4replegal, E4replegalid, E4address, E4tel, E4ciiu, E4dept, E4product',
                'length',
                'max' => 250),
    

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, dateReport, '.
                'lastname, address,IdCompliance,typeLink,unusualOperation,'
                . 'suspiciousOperation,alertsignal,aros,'
                . 'arostimeinit,arostimeend,importance,'
                . 'urgency,currency,laftsource,'
                . 'otherAlerts,counterpartType,operationType,transactionvalue,transactioncurrency,'
                .'transectiondate,description,analysis,P1lastname1,P1lastname2,P2lastname1,P2lastname2,'
                .'P3lastname1,P3lastname2,P4lastname1,P4lastname2,P1name,P2name,P3name,P4name,P1id,P2id,P3id,P4id,'
                .'P1typeid,P2typeid,P3typeid,P4typeid,'
                .'P1address,P2address,P3address,P4address,P1tel,P2tel,P3tel,P4tel,'
                .'E1businessname,E2businessname,E3businessname,E4businessname,E1nit,E2nit,E3nit,E4nit,'
                .'E1replegal,E2replegal,E3replegal,E4replegal,E1replegalid,E2replegalid,E3replegalid,E4replegalid,'
                .'E1typeid,E2typeid,E3typeid,E4typeid,E1address,E2address,E3address,E4address,E1tel,E2tel,E3tel,E4tel,'
                .'E1ciiu,E2ciiu,E3ciiu,E4ciiu,E1dept,E2dept,E3dept,E4dept,E1product,E2product,E3product,E4product,'
                .'E1vinculat,E2vinculat,E3vinculat,E4vinculat,additionalremarks,customerid,userId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customer' => array(self::HAS_MANY, 'Customer', 'customerid'),
            'customerUser' => array(self::HAS_MANY, 'CustomerUser', 'userId'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dateReport' => 'Fecha del Reporte',
            'name' => 'Nombre',
            'lastname' => 'Apellido',
            'address' => 'Dirección(Área)',
            'IdCompliance' => 'Nit ó Cedula',
            'typeLink' => 'Tipo de Vinculo',
            'unusualOperation' => 'Operación Inusual',
            'suspiciousOperation' => 'Operación Sospechosa',
            'alertsignal' => 'Señal de Alerta',
            'aros' => 'Ausencia ROS (AROS)',
            'arostimeinit' => 'Trimestre del AROS (Fecha Inicial)',
            'arostimeend' => 'Trimestre del AROS (Fecha Final)',
            'importance' => 'Importancia',
            'urgency' => 'Urgencia',
            'currency' => 'Moneda 1',
            'laftsource' => 'Fuente LAFT',
            'otherAlerts' => 'Otras Alertas',
            'counterpartType' => 'Tipo de Contraparte',
            'operationType' => 'Tipo de Operación',
            'transactionvalue' => 'Valor de la transacción',
            'transactioncurrency' => 'Moneda 2',
            'transectiondate' => 'Fecha',
            'description' => 'Descripción de la Operación o Señal de Alerta',
            'analysis' => 'Análisis Interno de la Operación (OFICIAL DE CUMPLIMIENTO)',
            'P1lastname1'=>'Apellido 1',
            'P1lastname2'=>'Apellido 2',
            'P1name'=>'Nombres',
            'P1typeid'=>'Tipo de Identificación',
            'P1id'=>'Identificación',
            'P1address'=>'Dirección',
            'P1tel'=>'Telefono',
            'E1businessname'=>'Razón Social',
            'E1nit'=>'NIT',
            'E1replegal'=>'Representante Legal',
            'E1replegalid'=>'Identificación',
            'E1typeid'=>'Tipo de Identificación',
            'E1address'=>'Dirección',
            'E1tel'=>'Teléfono',
            'E1ciiu'=>'CIIU',
            'E1dept'=>'Departamento',
            'E1product'=>'Producto',
            'E1vinculat'=>'Vinculación',
            'additionalremarks'=>'Observaciones Adicionales',
            'customerid'=>'Empresa',
            'userId'=>'Usuario',
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

        $criteria->compare('customerid', Yii::app()->user->arUser->customerId, true);
        $criteria->compare('id', $this->id);
        $criteria->compare('customerid', $this->customerid);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('dateReport', $this->dateReport, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('IdCompliance', $this->IdCompliance, true);
        $criteria->compare('typeLink', $this->typeLink, true);
        $criteria->compare('unusualOperation', $this->unusualOperation, true);
        $criteria->compare('suspiciousOperation', $this->suspiciousOperation, true);
        $criteria->compare('alertsignal', $this->alertsignal, true);
        $criteria->compare('aros', $this->aros, true);
        $criteria->compare('arostimeinit', $this->arostimeinit, true);
        $criteria->compare('arostimeend', $this->arostimeend, true);
        $criteria->compare('importance', $this->importance, true);
        $criteria->compare('urgency', $this->urgency, true);
        $criteria->compare('currency', $this->currency, true);
        $criteria->compare('laftsource', $this->laftsource, true);
        $criteria->compare('otherAlerts', $this->otherAlerts, true);
        $criteria->compare('counterpartType', $this->counterpartType, true);
        $criteria->compare('operationType', $this->operationType, true);
        $criteria->compare('transactionvalue', $this->transactionvalue, true);
        $criteria->compare('transactioncurrency', $this->transactioncurrency, true);
        $criteria->compare('transectiondate', $this->transectiondate, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('analysis', $this->analysis, true);
        $criteria->compare('userId', $this->userId, false);



        GridViewFilter::setFilter($this, 'search');


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 20,
            ),
        ));
    }





}