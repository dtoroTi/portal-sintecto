<?php

/**
 * This is the model class for table "{{Event}}".
 *
 * The followings are the available columns in table '{{Event}}':
 * @property integer $id
 * @property integer $backgroundCheckId
 * @property string $detail
 * @property string $created
 * @property string $modified
 * @property string $informedToCustomerOn
 * @property string $newLimitDate
 * @property string $customerComment
 * @property string $customerAnswerLimit
 * @property string $customerAnsweredOn
 * @property string $customerIp
 * @property string $customerAnswerCode
 * @property integer $createdById
 * @property integer $approvedById
 * @property integer $eventTypeId
 * @property integer $eventTypeNewsId
 * 
 * @property string $commentSAC
 * @property string $commentSACDate
 * @property string $reportSACDate
 * @property integer $reportSACByid 

 *
 * The followings are the available model relations:
 * @property BackgroundCheck $backgroundCheck
 */
class Event extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Event the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{Event}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('backgroundCheckId,  detail', 'required'),
            array('backgroundCheckId,createdById,approvedById,eventTypeId,eventTypeNewsId', 'numerical', 'integerOnly' => true),
            array('detail, informedToCustomerOn,modified,customerComment,newLimitDate,eventTypeId,eventTypeNewsId, commentSAC, commentSACDate, reportSACDate, reportSACByid', 'safe'),
            array('newLimitDate', 'date', 'format' => 'yyyy-M-d', 'allowEmpty' => false),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, backgroundCheckId, detail, created, modified, expireOn,informedToCustomerOn,finishedOn,createdById,approvedById,eventTypeId,eventTypeNewsId, commentSAC, commentSACDate, reportSACDate, reportSACByid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'backgroundCheck' => array(self::BELONGS_TO, 'BackgroundCheck', 'backgroundCheckId'),
            'createdBy' => array(self::BELONGS_TO, 'User', 'createdById'),
            'approvedBy' => array(self::BELONGS_TO, 'User', 'approvedById'),
            'eventType'=> array(self::BELONGS_TO,'EventType','eventTypeId'),
            'eventTypeNews'=> array(self::BELONGS_TO,'EventTypeNews','eventTypeNewsId'),
            'reportSACBy' => array(self::BELONGS_TO, 'User', 'reportSACByid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'backgroundCheckId' => 'Background Check',
            'detail' => 'Detalle',
            'created' => 'Creado en',
            'modified' => 'Modificado en',
            'informedToCustomerOn' => 'Informada al cliente en',
            'newLimitDate' => 'Nuevo límite',
            'customerComment' => 'Comentario de Cliente',
            'customerAnswerLimit' => 'Límite de respuesta',
            'customerAnsweredOn' => 'Respuesta de Cliente',
            'customerIp' => 'Ip de Cliente',
            'customerAnswerCode' => 'Codigo',
            'createdById'=>'Creado Por',
            'approvedById'=>'Aprobado Por',
            'eventTypeId'=>'Tipo',
            'eventTypeNewsId'=>'Tipo Retraso',
            'commentSAC'=>'Respuesta SAC', 
            'commentSACDate'=>'Fecha respuesta SAC',
            'reportSACDate'=>'Fecha reporte a SAC',
            'reportSACByid'=>'Reportado a SAC por' 
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
        $criteria->compare('backgroundCheckId', $this->backgroundCheckId);
        $criteria->compare('createdById', $this->createdById);
        $criteria->compare('approvedById', $this->approvedById);
        $criteria->compare('eventTypeId', $this->eventTypeId);
        $criteria->compare('detail', $this->detail, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        
        $criteria->compare('commentSAC', $this->commentSAC, true);
        $criteria->compare('commentSACDate', $this->commentSACDate, true);
        $criteria->compare('reportSACDate', $this->reportSACDate, true);
        $criteria->compare('reportSACByid', $this->reportSACByid, true);
        

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            //You can optionally set the field name options here
            )
        );
    }

    public function getInformedToCustomer() {
        return ($this->informedToCustomerOn > '0001');
    }

    public static function getNewCode() {
        do {
            $ans = md5(uniqid(rand(), true));
            $r = Event::model()->findByAttributes(array('customerAnswerCode' => $ans));
        } while ($r);
        return $ans;
    }
    
    public function getAnswerUrl(){
        return Yii::app()->params['sesApp'].$this->customerAnswerCode;
    }

    public function getNextValidPeriod(){
         $today = new DateTime("now", timezone_open('America/Bogota'));
         $nextDay=  Holiday::addWorkingDaysDateTime($today, 2);
        return $nextDay;
    }

    public function getInsertComentarios($id, $obs, $code){

        $date1 = new \DateTime();
        $fromDate=$date1->format('Y-m-d h:i:s');
        $ip_add = $_SERVER['REMOTE_ADDR'];

        $data = "UPDATE ses_Event SET customerComment='".$obs."', customerAnsweredOn='".$fromDate."', customerIp='".$ip_add."' WHERE id='".$id."'";
        $query = Yii::app()->db->createCommand($data)->execute();
        WebUser::logAccess("El cliente agrego el siguiente comentario en el estudio: ".$obs."", $code);
        Yii::app()->user->setFlash('success', 'Se ingreso el comentario correctamente.');

        return $query;
    }

    public function getEventsStudy($bgkcode){

        $criteria = new CDbCriteria;
        
        $criteria->addCondition('backgroundCheck.code=:code');
        $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
        $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
        $criteria->params=[':code'=>$bgkcode];
        $DetNotificaicones= Event::model()->findAll($criteria);
        
        $notificaciones=[];

        foreach ($DetNotificaicones AS $not){
            $notificaciones[]=[
                'tipo'=>$not->eventType->name,
                'tiporetraso'=>$not->eventTypeNews->name,
                'detail'=>$not->detail,
                'fecha'=>$not->informedToCustomerOn,
                'lastName'=>$not->backgroundCheck->lastName,
                'comment'=>$not->customerComment
            ];
        }
  
        return $DetNotificaicones;

    }

    public function getEventSAC() {
        
        $query_A = "SELECT bgc.idNumber, CONCAT(bgc.firstName,' ',bgc.lastName) AS nombre, bgc.code,
        ev.created, ev.detail, et.nick AS tipo, etn.nick AS tipoRetraso,  CONCAT(us1.firstName,' ',us1.lastName) AS creadoPor, 
        ev.reportSACDate AS fechaReporteSAC, CONCAT(us2.firstName,' ',us2.lastName) AS ReportadoSACPor,
        CONCAT(us.firstName,' ',us.lastName) AS UsuarioSAC, ev.commentSAC AS respuestaNovedad, ev.commentSACDate AS fechaRespuesta
        FROM ses_Event ev 
        JOIN ses_BackgroundCheck bgc ON ev.backgroundCheckId=bgc.id
        JOIN ses_Customer cus ON cus.id=bgc.customerId
        JOIN ses_User us ON us.id=cus.sacId
        JOIN ses_User us1 ON us1.id=ev.createdById 
        LEFT JOIN ses_User us2 ON us2.id=ev.reportSACByid
        JOIN ses_EventType et ON et.id=ev.eventTypeId
        JOIN ses_EventTypeNews etn ON etn.id=ev.eventTypeNewsId
        WHERE ev.reportSACDate > SUBDATE(now(), INTERVAL 2 MONTH)";
        $eventsreportSAC = Yii::app()->db->createCommand($query_A)->queryAll();

        return $eventsreportSAC;
    }

    
    public function getDateEventsAdv($backgroundcheckId, $code, $studyLimit){

        $event = Event::model()->findByAttributes(['backgroundCheckId'=>$backgroundcheckId, 'createdById'=>'1177']);

        if(!$event){
            $date1 = new \DateTime();
            $fromDate=$date1->format('Y-m-d h:i:s');
    
            $detail="Resultado adversos: sin hallazgo.";
    
            $Event = new Event();
            $Event->backgroundCheckId = $backgroundcheckId;
            $Event->created=$fromDate;
            $Event->detail = $detail;
            $Event->newLimitDate = date("Y-m-d", strtotime($studyLimit));
            $Event->createdById = '1796';
            $Event->eventTypeId = 2;
            $Event->eventTypeNewsId = 1;
    
            if (!$Event->save()) {
                throw new CHttpException(500, 'Server Error.');
            }
        }
        
		//WebUser::logAccess("Se realizo la insercion automatica de la novedad de la seccion adversos.", $code);
		return true;
	}

    public function quitarAcentos($cadena) {
        $mapeoCaracteres = array(
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U'
        );
    
        $cadenaSinAcentos = strtr($cadena, $mapeoCaracteres);
        return $cadenaSinAcentos;
    }
    
}
