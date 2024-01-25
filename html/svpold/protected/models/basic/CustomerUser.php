<?php

use LDAP\Result;

/**
 * This is the model class for table "{{CustomerUser}}".
 *
 * The followings are the available columns in table '{{CustomerUser}}':
 * @property integer $id
 * @property integer $customerId
 * @property string $username
 * @property string $firstName
 * @property string $lastName
 * @property string $created
 * @property string $modified
 * @property integer $isActive
 * @property string $lastLogin
 * @property string $lastLoginIP
 * @property string $sessionValidUntil
 * @property string $sessionKey
 * @property integer $mustChangePassword
 * @property string $seed
 * @property integer $isSupervisor
 * @property string $password
 * @property string $clearPassword1
 * @property string $clearPassword2
 * @property string $otpKey String
 * @property string $otp
 * @property integer $enfoceOtp Boolean default no
 * @property string $pdfPassword property 
 * @property datetime $pdfPasswordChangedOn when was changed the password
 * @property bool $accessToReports User can see reports
 * @property bool $accessToTemporalReports User can see temporal reports
 * @property bool $accessToOfac User can access list
 * @property bool $accessToNegativeReports User can see negative reports
 * @property bool $accessToPdfReport User can see negative reports
 * @property array $mailParam Array Parameters to send the email
 * @property bool $notifyByMail 
 * @property bool $accessToCompanyReports
 * @property bool $accessToCertificates 
 * @property bool $accessToNegativeCertificates 
 * @property integer $enforceOtpG
 * @property string $otpGKey
 * @property string $temporalOtpGKey Otp Temporal 
 * @property datetime $lastPasswordChange 
 * @property boolean $online
 * @property string $email2 Second Notification Email
 * @property string $email3 Third Notification Email
 * @property boolean $accessToCreateBC
 ** @property string $csvSeparator
 * The followings are the available model relations:
 * @property Customer $customer
 * @property bool $compliance Nuevo producto
 * @property boolean $accessToDocumentManagement 
 * @property boolean $certifiedFindings
 */
class CustomerUser extends CActiveRecord {

    public $clearPassword1;
    public $clearPassword2;
    public $otp;
    public $online;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CustomerUser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{CustomerUser}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customerId, username, firstName, lastName, created, '
                . 'mustChangePassword', 'required'),
            array('username,email2,email3', 'email'),
            array('customerId, isActive', 'numerical', 'integerOnly' => true),
            array('mustChangePassword, isSupervisor, isGroupSupervisor, '
                . 'enforceOtp, notifyByMail, certifiedFindings, enforceOtpG', 'boolean'),
            array('username, firstName, lastName, lastLoginIP, sessionKey, '
                . 'seed, clearPassword1, clearPassword2, pdfPassword',
                'length', 'max' => 255),
            array('email2, email3, otp',
                'length', 'max' => 50),
            array('csvSeparator', 'length', 'max' => 1),
            array('modified, lastLogin, sessionValidUntil,clearPassword1,'
                . 'clearPassword2, otp ', 'safe'),
            array('username', 'unique'),
            array('clearPassword1, clearPassword2', 'required', 'on' => 'create'),
//            array('pdfPassword', 'required', 'on' => 'updatePdfPassword', 'message' => 'La clave del PDF no puede ser vacia.'),
            array('clearPassword1', 'checkSamePassword'),
            array('otp', 'checkOtp'),
            array('accessToReports,accessToOfac,accessToNegativeReports,'
                . 'accessToPdfReport,accessToTemporalReports,'
                . 'accessToCompanyReports,accessToNegativeCertificates,'
                . 'accessToCertificates,accessToCreateBC, compliance, accessToDocumentManagement', 'boolean', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, customerId, username, firstName, lastName, created, '
                . 'modified, isActive,lastLogin, lastLoginIP, '
                . 'sessionValidUntil, sessionKey, '
                . 'mustChangePassword, seed, isSupervisor, password, '
                . 'enforceOtp, accessToReports,accessToOfac, '
                . 'accessToNegativeReports,accessToCompanyReports,'
                . 'accessToNegativeCertificates,accessToNegativeCertificates, '
                . 'enforceOtpG,lastPasswordChange,online,accessToCreateBC, accessToDocumentManagement',
                'safe',
                'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customer' => array(self::BELONGS_TO, 'Customer', 'customerId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'customerId' => 'Cliente',
            'username' => 'Usuario/Email',
            'firstName' => 'Nombres',
            'lastName' => 'Apellidos',
            'created' => 'Creado',
            'modified' => 'Modificado',
            'isActive' => 'Esta activo',
            'lastLogin' => 'Último Ingreso',
            'lastLoginIP' => 'Última Ip',
            'sessionValidUntil' => 'Sesión valida Hasta',
            'sessionKey' => 'Llave de Sesion',
            'mustChangePassword' => 'Debe cambiar la clave',
            'seed' => 'Semilla',
            'isSupervisor' => 'Es supervisor',
            'isGroupSupervisor' => 'Es Adm de Grupo',
            'password' => 'Clave',
            'clearPassword1' => 'Clave',
            'clearPassword2' => 'Clave(verificación)',
            'otp' => 'Llave',
            'enforceOtp' => 'Llave obligatoria',
            'pdfPassword' => 'Clave del PDF',
            'pdfPasswordChangedOn' => 'Clave del PDF cambio en',
            'accessToReports' => 'Ve Reportes',
            'accessToTemporalReports' => 'Reportes Temporales',
            'accessToNegativeReports' => 'Ve Reportes Negativos',
            'accessToOfac' => 'Tiene Acesso a Ofac',
            'accessToPdfReport' => 'Tiene Acceso a Reporte PDF',
            'accessToCompanyReports' => 'Tiene Acceso a Rep. Compañías',
            'accessToCertificates' => 'Tiene Accesso a Certificados',
            'accessToNegativeCertificates' => 'Tiene Accesso a Cert. Negativos',
            'accessToDocumentManagement'=>'Tiene Accesso a Gestión Documental',
            'enforceOtpG' => 'OTP Google Obligatoria',
            'otpGKey' => 'Segunda Llave',
            'lastPasswordChange' => 'Ultimo cambio de PWD',
            'online' => 'Esta en línea',
            'email2'=>'Segundo Correo',
            'email3'=>'Tercer Correo',
            'accessToCreateBC'=> 'Tiene Accesso a Crear Rep.',
            'name'=> 'Usuario del Cliente',
            'csvSeparator' => 'Separador',
            'compliance' => 'Compliance',
            'certifiedFindings' => 'Hallazgos Certificado',
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
        $criteria->compare('customerId', $this->customerId);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('firstName', $this->firstName, true);
        $criteria->compare('lastName', $this->lastName, true);
        $criteria->compare('t.created', $this->created, true);
        $criteria->compare('t.modified', $this->modified, true);
        $criteria->compare('isActive', $this->isActive);
        $criteria->compare('lastLogin', $this->lastLogin, true);
        $criteria->compare('lastLoginIP', $this->lastLoginIP, true);
        $criteria->compare('sessionValidUntil', $this->sessionValidUntil, true);
        $criteria->compare('sessionKey', $this->sessionKey, true);
        $criteria->compare('mustChangePassword', $this->mustChangePassword);
        $criteria->compare('seed', $this->seed, true);
        $criteria->compare('isSupervisor', $this->isSupervisor);
        $criteria->compare('isGroupSupervisor', $this->isSupervisor);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('enforceOtp', $this->enforceOtp);
        $criteria->compare('accessToReports', $this->accessToReports);
        $criteria->compare('accessToTemporalReports', $this->accessToTemporalReports);
        $criteria->compare('accessToOfac', $this->accessToOfac);
        $criteria->compare('accessToNegativeReports', $this->accessToNegativeReports);
        $criteria->compare('accessToPdfReport', $this->accessToPdfReport);
        $criteria->compare('email2', $this->email2);
        $criteria->compare('email3', $this->email3);
        $criteria->compare('accessToCreateBC',$this->accessToCreateBC);
        $criteria->compare('accessToDocumentManagement',$this->accessToDocumentManagement);

        if ($this->online != NULL) {
            if ($this->online) {
                $criteria->addCondition('sessionValidUntil>=now()');
            } else {
                $criteria->addCondition('sessionValidUntil<now()');
            }
        }

        GridViewFilter::setFilter($this, 'search');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'currentPage' => GridViewFilter::getPage('search'),
                'pageSize' => 20,
            ),
        ));
    }

    public function checkSamePassword($attribute, $params) {
        $ans = true;
        if ($this->isNewRecord && $this->clearPassword1 == "") {
            $this->addError('clearPassword1', 'El Usuario debe tener Clave Incial.');
            $ans = false;
        }
        if (($this->clearPassword1 != "" || $this->clearPassword2 != "") &&
                ($this->clearPassword1 != $this->clearPassword2)) {
            $this->addError('clearPassword1', 'La clave y la clave de verificación deben ser iguales.');
            $this->addError('clearPassword2', 'La clave y la clave de verificación deben ser iguales.');
            $ans = false;
        }
//    if (($this->clearPassword1 != "" || $this->clearPassword2 != "")
//            && get_class(Yii::app()) != "CConsoleApplication"
//            &&
//            (strlen($this->clearPassword1) < 8
//            || preg_match('/[A-Z]/', $this->clearPassword1) == 0
//            || preg_match('/[0-9]/', $this->clearPassword1) == 0
//            )
//    ) {
//      $this->addError('clearPassword1', 'La clave debe ser de mínimo 8 caracteres, y debe incluir al menos 1 número, una mayuscula.');
//      $ans = false;
//    }
        return ($ans);
    }

    public function validatePassword($password) {
        $ans = ($this->password == md5('*->*' . $password . '-' . $this->seed . '*->*'));
        return ($ans);
    }

    public function setPassword($password) {
        $this->seed = md5('*->*' . date('r') . trim(strtolower($this->username)) . '*->*');
        $this->password = md5('*->*' . $password . '-' . $this->seed . '*->*');
        $this->lastPasswordChange = new CDbExpression('NOW()');
    }

    public function setLastLogin() {
        $this->lastLogin = new CDbExpression('NOW()');
        $this->lastLoginIP = $_SERVER["REMOTE_ADDR"];
        $this->sessionKey = md5($this->lastLoginIP . date('r') . $this->username);
        $this->sessionValidUntil = new CDbExpression(' DATE_ADD( NOW( ) , INTERVAL ' .
                SES_SESSION_TIME_OUT . ' SECOND )');

        $ans = $this->save(false, array('lastLogin', 'lastLoginIP', 'sessionKey', 'sessionValidUntil'));
        $this->update();
        return ($ans);
    }

    public function behaviors() {
        return array(
            'AutoTimestampBehavior' => array(
                'class' => 'application.components.AutoTimestampBehavior',
            //You can optionally set the field name options here
            )
        );
    }

    public function beforeSave() {
        $ans = true;
        if ($this->isNewRecord && ($this->clearPassword1 != "" && $this->clearPassword2 == $this->clearPassword1 )) {
            $this->setPassword($this->clearPassword1);
        }
        if (get_class(Yii::app()) == "CWebApplication" &&
                !(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'login') && 
                !Yii::app()->controller->id=='miPlanilla') {
            if (!Yii::app()->user->isValidUser) {
                // without login the user can not be changed
                Yii::log("Without login trying to change the user properties of " . $this->username, "error", "ZWF." . __CLASS__);
                $this->addError('username', 'Incorrect username.');
                $ans = false;
            }
        }
        return $ans;
    }

    public function getName() {
        return ($this->firstName . " " . $this->lastName);
    }

    public function checkOtp($attribute, $params) {
        $ans = true;
        if ($this->enforceOtp && trim($this->otp) != "" && !$this->validateOtp($this->otp)) {
            $this->addError('otp', 'La llave no es válida.');
            $ans = false;
        }
        return $ans;
    }

    public function validateOnlineOtp($otp) {
        Yii::import('application.extensions.yubikey.*');
        $apiID = 14099;
        $signatureKey = "/Efe/hZReEaUeAtEj8wobp5hNrQ=";

        $token = new Yubikey($apiID, $signatureKey);

        $token->setCurlTimeout(20);
        $token->setTimestampTolerance(500);

        $ans = true;
        if (!$token->verify($otp)) {
            Yii::log("Error in OTP\n" .
                    "username: " . $this->username . " (" . $_SERVER['REMOTE_ADDR'] . ")\n" . $otp .
                    "\nError:" . $token->getLastResponse(), "error", "ZWF." . __CLASS__);
            $ans = false;
        }
        return $ans;
    }

    // function verifyOtp verify that key belongs to the user and the otp is valid
    public function validateOtp($otp) {
        $ans = false;
        if (!$this->enforceOtp || $this->otpKey == "") {
            $ans = true;
        } else {
            if ($this->getOtpKeyFromOtp($otp) == $this->otpKey) {
                if ($this->validateOnlineOtp($otp)) {
                    $ans = true;
                }
            }
        }
        return $ans;
    }

    private function getOtpKeyFromOtp($otp) {
        return substr($otp, 0, 12);
    }

    public function setOtpKey($otp) {
        $this->otpKey = $this->getOtpKeyFromOtp($otp);
    }

    public function getHasAccessToReports() {
        return ($this->accessToReports && $this->customer->accessToReports);
    }

    public function getHasAccessToTemporalReports() {
        return ($this->accessToTemporalReports && $this->customer->accessToTemporalReports);
    }

    public function getHasAccessToCertificates() {
        return ($this->accessToCertificates && $this->customer->accessToCertificates);
    }
    
    //   Formulario Compliance
    public function getHasAccessToCompliance() {
        return ($this->compliance);
    }
    
    public function getHasAccessToOfac() {
        return ($this->accessToOfac && $this->customer->accessToOfac);
    }

    public function getCanRequestCompanyReports() {
        return ($this->accessToCompanyReports && $this->customer->accessToCompanyReports && $this->accessToCreateBC);
    }

    public function getCanRequestPersonReport() {
        return ($this->accessToCreateBC && $this->accessToReports );
    }
    static public function getUserUsageReport() {

        $thisMonthDate = new DateTime("now", timezone_open('America/Bogota'));
        $previewsMonthDate = clone $thisMonthDate;
        $previewsMonthDate->sub(new DateInterval('P1M'));

        $thisMonth = $thisMonthDate->format('Y-m');
        $previewsMonth = $previewsMonthDate->format('Y-m');

        $select = array(
            "count(if (date_format(log.created,'%Y-%m')='{$previewsMonth}',1,null)) as 'S_{$previewsMonth}'",
            "count(if (date_format(log.created,'%Y-%m')='{$thisMonth}',1,null)) as 'S_{$thisMonth}'",
        );


        $ans = Yii::app()->db->createCommand()
                ->select('concat(customer.name," - ",customerUser.username) as customer_product, ' . implode(",", $select))
                ->from('{{Log}} log')
                ->join('{{CustomerUser}} customerUser', 'log.customerUserLogin=customerUser.username')
                ->join('{{Customer}} customer', 'customerUser.customerId=customer.id')
                ->where('log.created >= :previewsMonth', array(':previewsMonth' => $previewsMonthDate->format('Y-m-01')))
        ;

        $ans = $ans->group('customerUser.id')
                ->order('customer.name ASC,customerUser.username')
                ->queryAll();

        return array(
            'from' => $previewsMonthDate->format("Y-m-d"),
            'to' => $thisMonthDate->format("Y-m-d"),
            'data' => $ans);
    }

    public function getMailParam() {
        if(substr($this->username, 0, 3)!='___'){
            return array("mail" => $this->username, "name" => $this->name);
        }else{
            return array("mail" => $this->email2, "name" => $this->email2); 
        }
    }

    public function getMailsParam() {
        if(substr($this->username, 0, 3) == '___'){
            $ans=[];
        }else{
            $ans=array(array("mail" => $this->username, "name" => $this->name));
        }
        
        if (trim($this->email2)!=""){
            $ans[]=array("mail" => $this->email2, "name" => $this->email2);
        }
        if (trim($this->email3)!=""){
            $ans[]=array("mail" => $this->email3, "name" => $this->email3);
        }
        return $ans;
    }

    // function verifyOtp verify that key belongs to the user and the otp is valid
    public function validateOtpG($otp) {
        $ans = false;
        if ($this->enforceOtpG) {
            if ($this->otpGKey == '') {
                $ans = true;
            } else {
                $ans = $this->validateOtpGKey($otp);
            }
        } else {
            $ans = true;
        }
        return $ans;
    }

    public function validateOtpGKey($otp, $secretKey = null) {
        Yii::import('application.extensions.googleOtp.*');
        if ($secretKey) {
            $secret = $secretKey;
        } else {
            $secret = $this->otpGKey;
        }
        $g = new GoogleAuthenticator();
        return ($g->checkCode($secret, $otp));
    }

    public function getNewOtpGKey() {
        Yii::import('application.extensions.googleOtp.*');
        $g = new GoogleAuthenticator();
        return $g->getNewOtpGKey();
    }

    public function getOtpGQrTemporalImage() {
        Yii::import('application.extensions.googleOtp.*');
        $g = new GoogleAuthenticator();
        return ($g->getQrCodeHTMLImage($this->shortUsername, $this->userNameDomain, $this->temporalOtpGKey));
    }

    public function getShortUsername() {
        return substr($this->username, 0, strpos($this->username, '@'));
    }

    public function getUsernameDomain() {
        return substr($this->username, strpos($this->username, '@') + 1);
    }

    public function getIsOnline() {
        $now = new DateTime('now', timezone_open('America/Bogota'));
        $validUntil = new DateTime($this->sessionValidUntil, timezone_open('America/Bogota'));
        return ($now < $validUntil);
    }

    //Natalia Henao
    //funcion para return detalle de Secciones por Estudio, con Hallazgo.
    public function getBackgroundchecksInDates($from, $until){

        $criteria = new CDbCriteria;

        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("backgroundCheck.studyStartedOn between :from and :until");
        $criteria->addCondition("t.resultId=:resultId");
        $criteria->with=['backgroundCheck','verificationSectionType'];
        $criteria->params=[':from'=>$from, ':until'=>$until, ':customerId'=>$this->customerId, ':resultId'=> Result::NO_FAVORABLE];
        $seccions= VerificationSection::model()->findAll($criteria);
        
        $detalleSeccion=[];
  
        foreach ($seccions as $section){
            $detalleSeccion[]=[
                'code'=>$section->backgroundCheck->code,
                'id'=>$section->verificationSectionTypeId,
                'Secciones'=>$section->verificationSectionType->name,
                'comments'=>$section->comments,
                'Nombre'=>($section->backgroundCheck->firstName.' '.$section->backgroundCheck->lastName) 
            ];
        }
        
        return $detalleSeccion;
    }
    
    //Natalia Henao
    //funcion para agrupar por Secciones, con Hallazgo.
    public function getVerificationsetionsInDates($from, $until){

        $query_A='SELECT count(vtst.id) AS Total_Secciones, vtst.id AS id_seccion,  vtst.name AS Secciones
                FROM ses_BackgroundCheck bck 
                JOIN ses_VerificationSection vts ON bck.id=vts.backgroundCheckId
                JOIN ses_VerificationSectionType vtst ON vtst.id=vts.verificationSectionTypeId
                WHERE vts.resultId=3 AND bck.customerId="'.$this->customerId.'"
                AND bck.studyStartedOn>="'.$from.'" AND bck.studyStartedOn<="'.$until.'"
                GROUP BY Secciones';
        $totalTipoSecciones = Yii::app()->db->createCommand($query_A)->queryAll();       
        
        return $totalTipoSecciones;
    }
    
    //Natalia Henao
    //funcion para return total de Secciones, con Hallazgo.
    public function getVerificationsetionsAllInDates($from, $until){
  
        $criteria = new CDbCriteria;

        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("backgroundCheck.studyStartedOn between :from and :until");
        $criteria->addCondition("t.resultId=:resultId");
        $criteria->with=['backgroundCheck','verificationSectionType'];
        $criteria->params=[':from'=>$from, ':until'=>$until, ':customerId'=>$this->customerId, ':resultId'=> Result::NO_FAVORABLE];
        $Allseccions=VerificationSection::model()->count($criteria);

        $totalSecciones=[];
        $totalSecciones[]=[
            'Total_Secciones'=>$Allseccions
        ];

        return $totalSecciones;
    }
    
    //Natalia Henao
    //funcion para return total de notificacion.
    public function getAllNovedades($FechaActual){
        
        $criteria = new CDbCriteria;

        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("DATE(STR_TO_DATE(t.informedToCustomerOn, '%Y-%m-%d'))=:FechaActual");
        $criteria->addCondition("backgroundCheck.typeStudy IS NOT NULL");
        $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
        $criteria->addCondition('backgroundCheck.typeStudy<>" "');
        $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
        $criteria->params=[':FechaActual'=>$FechaActual, ':customerId'=>$this->customerId];
        $AllNot= Event::model()->count($criteria);
 
        $totalNot=[];
        $totalNot[]=[
            'totalNovedades'=>$AllNot
        ];

        return $totalNot;
    }
    
    //Natalia Henao
    //funcion para return el detalle de las notificaciones (cumplimiento).
    public function getDetalleAllNovedades($FechaActual){
        
        $criteria = new CDbCriteria;
        
        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("DATE(STR_TO_DATE(t.informedToCustomerOn, '%Y-%m-%d'))=:FechaActual");
        $criteria->addCondition("backgroundCheck.typeStudy IS NOT NULL");
        $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
        $criteria->addCondition('backgroundCheck.typeStudy<>" "');
        $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
        $criteria->params=[':FechaActual'=>$FechaActual, ':customerId'=>$this->customerId];
        $DetNotificaicones= Event::model()->findAll($criteria);
        
        $notificaciones=[];
        
        foreach ($DetNotificaicones AS $not){
            $notificaciones[]=[
                'tipo'=>$not->eventType->name,
                'tiporetraso'=>$not->eventTypeNews->name,
                'detail'=>$not->detail,
                'fecha'=>$not->informedToCustomerOn,
                'code'=>$not->backgroundCheck->code,
                'lastName'=>$not->backgroundCheck->lastName 
            ];
        }
        
        return $notificaciones;
    }
    
    //Natalia Henao
    //funcion return el valor de clasificación de riesgos.
    public function getXMLsection($from, $until){
        
        //vs.verificationSectionTypeId = 107 produccion
        $criteria = new CDbCriteria;
        
        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("backgroundCheck.studyStartedOn between :from and :until");
        $criteria->addCondition('xmlSection.answer != ""');
        $criteria->addCondition("t.verificationSectionTypeId=107");
        $criteria->with=['backgroundCheck','xmlSection'];
        $criteria->params=[':from'=>$from, ':until'=>$until, ':customerId'=>$this->customerId];
        $xmlSection= VerificationSection::model()->findAll($criteria);
        
        $RiesgoSarlaft=[];
        
        foreach ($xmlSection AS $xmlsec){
            $RiesgoSarlaft[]=[
                'verificationSectionTypeId'=>$xmlsec->verificationSectionTypeId,
                'answer'=>$xmlsec->xmlSection->answer
            ];
        }
        return $RiesgoSarlaft;

    }
    
    //Natalia Henao
    //funcion retunr los datos de estudio en este periodo.
    public function getAllDetailStudy($from, $until, $typeStudy=null){
        
        $criteria = new CDbCriteria;
        
        $criteria->addCondition('t.customerId=:customerId');
        $criteria->addCondition("t.studyStartedOn between :from and :until");
        $criteria->addCondition('t.typeStudy IS NOT NULL ');
        $criteria->addCondition('t.typeStudy<>" "');
        $criteria->addCondition("t.backgroundCheckStatusId=4 OR t.backgroundCheckStatusId=5");
        $criteria->params=[':from'=>$from, ':until'=>$until, ':customerId'=>$this->customerId];
       /* if($typeStudy){
            $criteria->addCondition('t.typeStudy=:typeStudy');
            $criteria->params=[':typeStudy']=$typeStudy;
        }*/
        $criteria->order = 't.backgroundCheckStatusId DESC';
        $detStudy= BackgroundCheck::model()->findAll($criteria);
        
        $NumStudytotaldetalle=[];
        
        foreach ($detStudy AS $study){
            if($study->backgroundCheckStatusId==BackgroundCheckStatus::PROCESSING){
                $NumStudytotaldetalle[]=[
                    'typeStudy'=>$study->typeStudy,
                    'code'=>$study->code,
                    'nombre'=>($study->firstName.' '.$study->lastName),   
                    'estado'=>$study->backgroundCheckStatusId,
                    'TipoEstado'=>"Abierto"      
                ];
            }else if($study->backgroundCheckStatusId==BackgroundCheckStatus::FINISHED){
                $NumStudytotaldetalle[]=[
                    'typeStudy'=>$study->typeStudy,
                    'code'=>$study->code,
                    'nombre'=>($study->firstName.' '.$study->lastName),
                    'estado'=>$study->backgroundCheckStatusId,
                    'TipoEstado'=>"Cerrado"    
                ];
            }
            
        }
       
        return $NumStudytotaldetalle;  
    }
    
    //Natalia Henao
    //funcion para return la cantidad de estudios abiertos y cerrados en un periodo
    public function getCountStatusStudy($from, $until) {
        
        $query_A = 'SELECT bgc.typeStudy, COUNT(bgc.typeStudy), bgc.backgroundCheckStatusId AS estado, 
            IF(bgc.backgroundCheckStatusId=5, "Abierto", "Cerrado") AS TipoEstado, 
            COUNT(bgc.backgroundCheckStatusId) AS Cantida_Estado
            FROM ses_BackgroundCheck bgc
            WHERE  bgc.customerId="'.$this->customerId.'" AND bgc.typeStudy IS NOT NULL AND bgc.typeStudy<>" " 
            AND (bgc.backgroundCheckStatusId=4 OR bgc.backgroundCheckStatusId=5) 
            AND bgc.studyStartedOn>="'.$from.'" AND bgc.studyStartedOn<="'.$until.'"
            GROUP BY bgc.typeStudy, bgc.backgroundCheckStatusId
            ORDER BY bgc.typeStudy ASC ';
        $NumStudytotal = Yii::app()->db->createCommand($query_A)->queryAll();
        return $NumStudytotal;
    }
    
    //Natalia Henao
    //funcion return la cantidad de consultas de tus datos permitidas al cliente.
    public function getConsultasTD(){

        $criteria = new CDbCriteria;
        
        $criteria->addCondition('t.id=:id');
        $criteria->params=[':id'=>$this->customerId];
        $cant= Customer::model()->findAll($criteria);
                
        foreach ($cant as $r) {
           $cant_consultas=$r->inquiriesTD;
        }
        return $cant_consultas;
    }

    //Natalia Henao
    //funcion return el usuario y la clave para el acceso a API tus datos
    public function getConsultasUsuarioTD(){

        $criteria = new CDbCriteria;
        
        $criteria->addCondition('t.id=:id');
        $criteria->params=[':id'=>$this->customerId];
        $usutd= Customer::model()->findAll($criteria);

        $usuarioTusDatos=[];        

        foreach ($usutd as $usu) {
            $usuarioTusDatos[]=[
                'usuario'=>$usu->UsuarioTD,
                'clave'=>$usu->ClaveTD,
            ];
        }
        return $usuarioTusDatos;
    }

    //Natalia Henao
    //funcion return el historial de PDF consultados de tus datos.
    public function getInfTusDatos(){
        
        $query_A='SELECT tusdatosId, tipe_Id, numberId, name, created 
                FROM ses_InquiriesTDT WHERE customerId="'.$this->customerId.'"';
        $RegTusdatos = Yii::app()->db->createCommand($query_A)->queryAll();

        return $RegTusdatos;
    }

    //Natalia Henao
    //function ejecuta proceso API para el consumo de la plataforma tus datos
    public function getApiTusDatos($documento, $criteriotd, $fecha_expedicion){

        $decoded=0;

        $query_A='SELECT numberId, name FROM ses_InquiriesTDT WHERE numberId="'.$documento.'" AND customerId="'.$this->customerId.'"';
        $datos = Yii::app()->db->createCommand($query_A)->queryAll();
        
        if(!empty($datos)){
            
            echo '<script type="text/javascript">
                    alert("DOCUMENTO CONSULTADO PREVIAMENTE, POR FAVOR VERIFICAR EN EL HISTORIAL DE REPORTES.");
                </script>';
        }else{

            $usuarioTDs=$this->getConsultasUsuarioTD();

            foreach ( $usuarioTDs as $datos ) {
                $usuarioTD=$datos['usuario'];
                $claveTD=$datos['clave'];
            }

            if($usuarioTD==null || $claveTD==null){
                echo '<script type="text/javascript">
                    alert("¡NO CUENTA CON UN USUARIO Y CONTRASEÑA PARA ESTE PROCESO, POR FAVOR COMUNÍQUESE CON UN ASESOR!");
                </script>';

            }else{

                $query_A='SELECT COUNT(id) AS total FROM ses_InquiriesTDT WHERE customerId="'.$this->customerId.'"';
                $totalConsultas = Yii::app()->db->createCommand($query_A)->queryAll();
        
                foreach ($totalConsultas as $r ) {
                    foreach ( $r as $v ) {
                        $totalDatos=$v;
                    }
                }

                $cant_consultas=$this->getConsultasTD();
                //$cant_consultas = $customerUs->getConsultasTD();  

                if($totalDatos<$cant_consultas){

                    WebUser::logAccess("Genero petición de consulta en tus datos para el documento No: $documento ");

                    if($fecha_expedicion==NULL){
                        $url = "https://dash-board.tusdatos.co/api/launch/";
                        $client = curl_init($url);
                        curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
                        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
                        curl_setopt($client, CURLOPT_POST, true);
                        curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));//$headers);
                        curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($client, CURLOPT_USERPWD, "$usuarioTD:$claveTD");
                        curl_setopt($client, CURLOPT_POSTFIELDS, '{"doc":"'.$documento.'","typedoc":"'.$criteriotd.'"}');
    
                        $response = curl_exec($client);
    
                        curl_close($client);
    
                        $decoresponse = json_decode($response, TRUE);
                    }else{

                        $fecha_expd=(new \DateTime(CHtml::encode($fecha_expedicion)))->format('d/m/Y');

                        $url = "https://dash-board.tusdatos.co/api/launch/"; 
                        $client = curl_init($url);
                        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($client, CURLOPT_POST, true);
                        curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json')); 
                        curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($client, CURLOPT_USERPWD, "$usuarioTD:$claveTD");
                        curl_setopt($client, CURLOPT_POSTFIELDS, '{"doc":"'.$documento.'","typedoc":"'.$criteriotd.'","fechaE":"'.$fecha_expd.'"}');
    
                        $response = curl_exec($client);
    
                        curl_close($client);
    
                        $decoresponse = json_decode($response, TRUE);
                    }
                   
                        if (array_key_exists('jobid', $decoresponse)) {
                            $jobid=$decoresponse['jobid'];

                            $url = "https://dash-board.tusdatos.co/api/results/".$jobid;
                            $client = curl_init($url);
                                curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER,true);
                                curl_setopt($client, CURLOPT_POST, false);
                                curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));//$headers);
                                curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                curl_setopt($client, CURLOPT_USERPWD, "$usuarioTD:$claveTD");

                            $curl_response = curl_exec($client);
                            curl_close($client);

                            $decoded = json_decode($curl_response, TRUE);

                            if(isset($decoded['estado']) && $decoded['estado']== 'procesando')
                            {
                                    echo '<script type="text/javascript">
                                        alert("SE ESTA PROCESANDO EL ESTUDIO, POR FAVOR ESPERE 1 MINUTO, HE INTENTE NUEVAMENTE.");
                                    </script>';
                            }
                            else if(isset($decoded['estado']) && strpos($decoded['estado'],'error')!==false)
                            {
                                echo '<h2>El proceso Expiro.</h2>';
                            }  

                        }else if (array_key_exists('id', $decoresponse)){

                            if($decoresponse['id']!=" "){

                                $fecha= date('Y-m-d h:i:s');
                                $data="INSERT INTO ses_InquiriesTDT (customerId, tusdatosId, tipe_Id, numberId, name, created, dateExpirationDoc)
                                VALUES ('".$this->customerId."', '".$decoresponse['id']."', '".$criteriotd."', '".$documento."', '".$decoresponse['nombre']."', '".$fecha."', '".$fecha_expedicion."')";
                                $query = Yii::app()->db->createCommand($data)->execute(); 

                                $id=$decoresponse['id'];

                                if($criteriotd=="NIT"){
                                    $url = "https://dash-board.tusdatos.co/api/v2/report_nit_pdf/" . $id;
                                }else{
                                    $url = "https://dash-board.tusdatos.co/api/v2/report_pdf/" . $id;
                                }

                                //$url = "https://dash-board.tusdatos.co/api/report_pdf/".$id;
                                $client = curl_init($url);
                                curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
                                curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
                                curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
                                curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                curl_setopt($client, CURLOPT_USERPWD, "$usuarioTD:$claveTD");

                                $content = curl_exec($client);
                                        curl_close($client);
                                $response = false;


                                $fileName = "/var/www/html/sesold/protected/runtime/".$documento."_tusDatos.pdf";

                                if(file_put_contents( $fileName,$content)){

                                        chmod($fileName, 0775);
                                        $response=true;

                                        $name = $documento."_tusDatos.pdf";
                                        header('Content-type: application/pdf');
                                        //header("Content-Type: application/force-download");
                                        header("Content-Disposition: attachment; filename=\"$name\"");
                                        readfile($fileName);  

                                        WebUser::logAccess("Descargo estudio de tus datos No: $documento ");
                                        unlink($fileName);

                                }
                            }

                    }else if (array_key_exists('error', $decoresponse)) {
                        echo '<script type="text/javascript">
                                    alert("Error: Documento no valido.");
                                </script>';
                    }

                }else{
                    
                    echo '<script type="text/javascript">
                            alert("¡¡POR FAVOR COMUNÍQUESE CON UN ASESOR, SU PRUEBA DEMO HA EXPIRADO!!");
                        </script>';
                }
            }
        }
    }

    //Natalia Henao
    //3/08/2022
    //Se adiciona funcion para la recarga de las fuentes caidas en las consultas de tus datos
    function getTusDatosRetry($id, $tid, $idnumber)
	{

        $customerUsr=Yii::app()->user->arUser;
        $usuarioTDs=$this->getConsultasUsuarioTD();

        foreach ( $usuarioTDs as $datos ) {
            $usuarioTD=$datos['usuario'];
            $claveTD=$datos['clave'];
        }

		$url = "https://dash-board.tusdatos.co/api/retry/".$id."/?typedoc=".$tid;

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_POST, false);
		curl_setopt($client, CURLOPT_HTTPHEADER,  array('Content-Type: application/json')); 
		curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($client, CURLOPT_USERPWD, "$usuarioTD:$claveTD");

		$curl_response = curl_exec($client);

		if ($curl_response === false) {
			$info = curl_getinfo($client);
			curl_close($client);
			die('error occured during curl exec. find results info: id: ' . $id . var_export($info));
		}
		$decoded = json_decode($curl_response);
		curl_close($client);
        //echo var_dump($curl_response);

		if (isset($decoded->error)) {
			echo '<h2>El estudio no es válido</h2>';
		} else {
            return true;
            //$filename = tempnam(Yii::app()->getRuntimePath(), 'td_');
            //$this->getTusDatosReportPDF($idnumber,$id, $tid, $filename);
            //$tusDatos = new TusDatosResponse();
            //$tusDatos->savePDF($bckid, $idnumber, 0, $filename, $refresh=1);
		}
	}

    //// FUNCIONES DE DASHBOARD INTEGRIDAD ////
    //Natalia Henao
    //consulta para identificar resultado de evaluacion de estudios en dashboard integridad
    public function getResultStudy($from, $until){
        
        $query_A=' SELECT res.id, res.name, COUNT(res.id) AS resultado
        FROM ses_BackgroundCheck bck  JOIN ses_Result res ON bck.resultId=res.id
        WHERE (res.id=1 OR res.id=2 OR res.id=3 OR res.id=4) AND bck.customerId="'.$this->customerId.'"
        AND bck.studyStartedOn>="'.$from.'" AND bck.studyStartedOn<="'.$until.'"
        GROUP BY res.id';

        $resultforstudy = Yii::app()->db->createCommand($query_A)->queryAll();       

        return $resultforstudy;
    }

    //Natalia Henao
    //consulta para identificar resultado de evaluacion de estudios en dashboard integridad
    public function getDetailResultStudys($from, $until, $id){

        $criteria = new CDbCriteria;
        
        $criteria->addCondition('t.customerId=:customerId');
        $criteria->addCondition("t.studyStartedOn between :from and :until");
        $criteria->addCondition('result.id=:resultId');
        $criteria->with=['result'];
        $criteria->params=[':from'=>$from, ':until'=>$until, ':customerId'=>$this->customerId, ':resultId'=>$id];
        $resultforstudy= BackgroundCheck::model()->findAll($criteria);

        $detresultforstudy=[];
        
        foreach ($resultforstudy AS $study){
            if($id!=1){
                if($study->findingLaboralHistory==1 && $study->findingtextLaboral!=" "){
                    $hallazgolaborar='Hallazgo Laboral: ';
                    $hallazgolaborartext=$study->findingtextLaboral.'<br>';
                }else{
                    $hallazgolaborar='';
                    $hallazgolaborartext='';
                }

                if($study->findingSocioeconomic==1){
                    $hallazgocentralR='Hallazgo Central de Riesgo'.'<br>';
                }else{
                    $hallazgocentralR='';
                }

                if($study->findingVisit==1){
                    $hallazgovisita='Hallazgo en la Visita'.'<br>';
                }else{
                    $hallazgovisita='';
                }
                
                if($study->findingStudy==1 && $study->findingtextStudy!=" "){
                    $hallazgoAcademico='Hallazgo Académico: ';
                    $hallazgoAcademicotext=$study->findingtextStudy.'<br>';
                }else{
                    $hallazgoAcademico='';
                    $hallazgoAcademicotext='';
                }

                if($study->findingPolygraph==1 && $study->findingtextPoly!=" "){
                    $hallazgoPolygraph='Hallazgo en Polígrafo: ';
                    $hallazgoPolygraphtext=$study->findingtextPoly.'<br>';
                }else{
                    $hallazgoPolygraph='';
                    $hallazgoPolygraphtext='';
                }

                if($study->findingOther==1){
                    $hallazgootro='Otros Hallazgo'.'<br>';
                }else{
                    $hallazgootro='';
                }
                
                if($study->findingBackground==1 && $study->findingtextBackg!=" "){
                    $hallazgoBackground='Hallazgo Antecedentes: ';
                    $hallazgotextBackg=$study->findingtextBackg.'<br>';
                }else{
                    $hallazgoBackground='';
                    $hallazgotextBackg='';
                }

                if($study->findingTestPsychote==1){
                    $hallazpruebasPsic='Hallazgo Pruebas Psicotecnicas'.'<br>';
                }else{
                    $hallazpruebasPsic='';
                }

                if($study->findingODT==1){
                    $hallazOTD='Hallazgo ODT'.'<br>';
                }else{
                    $hallazOTD='';
                }

                $detresultforstudy[]=[
                    'code'=>$study->code,
                    'nombre'=>$study->firstName.' '.$study->lastName,
                    'numid'=>$study->idNumber,
                    'hallazgos'=>$hallazgolaborar.$hallazgolaborartext.$hallazgocentralR.$hallazgovisita.$hallazgoAcademico.$hallazgoAcademicotext.$hallazgoPolygraph.$hallazgoPolygraphtext.$hallazgootro.$hallazgoBackground.$hallazgotextBackg.$hallazpruebasPsic.$hallazOTD,
                ]; 
            }else{
                $detresultforstudy[]=[
                    'code'=>$study->code,
                    'nombre'=>$study->firstName.' '.$study->lastName,
                    'numid'=>$study->idNumber,
                    'hallazgos'=>' ',
                ];
            }
          
        }
        
        return $detresultforstudy;
    }

    //Natalia Henao
    //funcion para return el tiempo de respuesta por tipo de estudio con estado finalizado (Integridad)
    public function getDaysfortimestudy($from, $until) {
        
        $query_A = 'SELECT bck.customerProductId, cp.name, cp.maxDays, COUNT(bck.code) AS total_estudios,
        SUM(IF(DATE_FORMAT(bck.deliveredToCustomerOn,"%Y-%m-%d")>bck.studyLimitOn, "1", "0")) cant_fueraTiempo,
        SUM(IF(DATE_FORMAT(bck.deliveredToCustomerOn,"%Y-%m-%d")<=bck.studyLimitOn, "1", "0")) cant_tiempo
        FROM ses_BackgroundCheck bck JOIN ses_CustomerProduct cp ON bck.customerProductId=cp.id
        WHERE bck.customerId="'.$this->customerId.'" AND bck.backgroundCheckStatusId=4 AND bck.studyStartedOn>="'.$from.'" AND bck.studyStartedOn<="'.$until.'"
        GROUP BY bck.customerProductId, cp.name, cp.maxDays
        ORDER BY bck.customerProductId ASC';
        $limitdaysStudy = Yii::app()->db->createCommand($query_A)->queryAll();

        $detaillimitdaysStudy=[];
  
        foreach ($limitdaysStudy as $limit){
                $detaillimitdaysStudy[]=[
                    'idproducto'=>$limit['customerProductId'],
                    'producto'=>$limit['name'],
                    'limite_dias'=>$limit['maxDays'],
                    'total_estudios'=>$limit['total_estudios'],
                    'fuera_tiempo'=>$limit['cant_fueraTiempo'],
                    'a_tiempo'=>$limit['cant_tiempo']
                ];
        }
        return $detaillimitdaysStudy;
    }

    //Natalia Henao
    //funcion para return el detallado del tiempo de respuesta por tipo de estudio con estado finalizado (Integridad)
    public function getDetailStudysforProducts($from, $until, $id) {

        $query_A = 'SELECT bkc.code, bkc.idNumber, bkc.firstName, bkc.lastName, bkc.studyLimitOn AS fecha_limite, 
        DATE_FORMAT(bkc.deliveredToCustomerOn,"%Y-%m-%d") AS fecha_publicado,
        IF(DATE_FORMAT(bkc.deliveredToCustomerOn,"%Y-%m-%d")<=bkc.studyLimitOn, "A Tiempo", "Fuera de Tiempo") AS estado
        FROM ses_BackgroundCheck bkc JOIN ses_CustomerProduct cp ON bkc.customerProductId=cp.id
        LEFT JOIN ses_Event ev ON ev.backgroundCheckId=bkc.id
        WHERE bkc.customerId="'.$this->customerId.'" AND bkc.backgroundCheckStatusId=4 AND bkc.studyStartedOn>="'.$from.'" AND bkc.studyStartedOn<="'.$until.'" AND bkc.customerProductId="'.$id.'"
        GROUP BY bkc.code';
        $StudyforProducts = Yii::app()->db->createCommand($query_A)->queryAll();

        
        $detailProductStudys=[];
  
            foreach ($StudyforProducts as $product){

                $query_Ac = 'SELECT COUNT(ev.id) AS cantidad, bkc.code
                FROM ses_BackgroundCheck bkc JOIN ses_CustomerProduct cp ON bkc.customerProductId=cp.id 
                JOIN ses_Event ev ON ev.backgroundCheckId=bkc.id
                WHERE bkc.customerId="'.$this->customerId.'" AND bkc.backgroundCheckStatusId=4 AND bkc.customerProductId="'.$id.'" AND bkc.code="'.$product['code'].'" AND ev.informedToCustomerOn IS NOT NULL';
                $cannov = Yii::app()->db->createCommand($query_Ac)->queryAll();


                foreach ($cannov as $cant){
                    $cantidad=$cant['cantidad'];
                }

                $detailProductStudys[]=[
                    'code'=>$product['code'],
                    'idnumber'=>$product['idNumber'],
                    'nombre'=>$product['firstName'].' '.$product['lastName'],
                    'fecha_limite'=>$product['fecha_limite'],
                    'fecha_publicado'=>$product['fecha_publicado'],
                    'estado'=>$product['estado'],  
                    'cantNov'=>$cantidad,  
                ];
            }
        return $detailProductStudys;
    }

    //Natalia Henao M
    //return los estudios que estan con estado en curso y solicitados para agregarles una observación (Integridad)
    public function getStudyforObservation(){
            
        $criteria = new CDbCriteria;
        
        $criteria->addCondition('t.customerId=:customerId');
        $criteria->addCondition("t.resultId=1");
        $criteria->params=[ ':customerId'=>$this->customerId];
        $criteria->order = 't.backgroundCheckStatusId DESC';

        $detStudyobs= BackgroundCheck::model()->findAll($criteria);
        
        $StudyObservation=[];
        
        foreach ($detStudyobs AS $studyOb){
        
            $StudyObservation[]=[
                'code'=>$studyOb->code,
                'id_number'=>$studyOb->idNumber,
                'nombre'=>($studyOb->firstName.' '.$studyOb->lastName),   
                'observacion'=>$studyOb->observationToCustomer   
            ];
        }
       
        return $StudyObservation;  
    }

    
    //Natalia Henao
    //funcion para registrar observaciones del usuario a estudios solicitados y en curso (Integridad).
    public function getInsertObservation($code, $obs){

        $data = "UPDATE ses_BackgroundCheck SET observationToCustomer='".$obs."' WHERE code='".$code."'";
        $query = Yii::app()->db->createCommand($data)->execute();
        WebUser::logAccess("El cliente agrego la siguiente observación: ".$obs."", $code);
        Yii::app()->user->setFlash('success', 'Se ingreso la observacion correctamente.');

        return $query;
    }

    //Natalia Henao
    //funcion para return las novedades del tiempo de respuesta de los estudios finalizados (Integridad).
    public function getViewNovResultStudy($code){
        $criteria = new CDbCriteria;
            
        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("backgroundCheck.code=:code");
        $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
        $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
        $criteria->params=[':code'=>$code, ':customerId'=>$this->customerId];
        $DetNotificaicones= Event::model()->findAll($criteria);

        $NovResultStudy=[];
        
        foreach ($DetNotificaicones AS $not){
            $NovResultStudy[]=[
                'fecha'=>$not->informedToCustomerOn,
                'tipo'=>$not->eventType->name,
                'tipoRetraso'=>$not->eventTypeNews->name,
                'detalle'=>$not->detail, 
            ];
        }

        return $NovResultStudy;
    }

    //Natalia Henao
    //funcion para return total de notificacion (Integridad)
    public function getAllNovedadesIn($FechaActual){
        
        $criteria = new CDbCriteria;

        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("DATE(STR_TO_DATE(t.informedToCustomerOn, '%Y-%m-%d'))=:FechaActual");
        $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
        $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
        $criteria->params=[':FechaActual'=>$FechaActual, ':customerId'=>$this->customerId];
        $AllNot= Event::model()->count($criteria);
 
        $totalNot=[];
        $totalNot[]=[
            'totalNovedades'=>$AllNot
        ];

        return $totalNot;
    }

    //Natalia Henao
    //funcion para return el detalle de las notificaciones (Integridad).
    public function getDetalleAllNovedadesIn($FechaActual){
        
        $criteria = new CDbCriteria;
        
        $criteria->addCondition('backgroundCheck.customerId=:customerId');
        $criteria->addCondition("DATE(STR_TO_DATE(t.informedToCustomerOn, '%Y-%m-%d'))=:FechaActual");
        $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
        $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
        $criteria->params=[':FechaActual'=>$FechaActual, ':customerId'=>$this->customerId];
        $DetNotificaicones= Event::model()->findAll($criteria);
        
        $notificaciones=[];
        
        foreach ($DetNotificaicones AS $not){
            $notificaciones[]=[
                'tipo'=>$not->eventType->name,
                'tiporetraso'=>$not->eventTypeNews->name,
                'detail'=>$not->detail,
                'fecha'=>$not->informedToCustomerOn,
                'code'=>$not->backgroundCheck->code,
                'lastName'=>$not->backgroundCheck->lastName 
            ];
        }
        
        return $notificaciones;
    }

    public function getDetailEventClient($customerId, $us){
        
        $criteria = new CDbCriteria;
        
        if($us==1){
            $criteria->addCondition('backgroundCheck.customerId=:customerId');
            $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
            $criteria->addCondition('backgroundCheck.resultId=:result');
            $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
            $criteria->params=[':customerId'=>$customerId, 'result'=>'1'];
        }else if($us==2){
            $criteria->addCondition('customer.customerGroupId=:customergrId');
            $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
            $criteria->addCondition('backgroundCheck.resultId=:result');
            $criteria->with=['backgroundCheck.customer','eventType', 'eventTypeNews'];
            $criteria->params=[':customergrId'=>$customerId, 'result'=>'1'];
        }else{
            $criteria->addCondition('backgroundCheck.customerUserId=:customerUsId');
            $criteria->addCondition('backgroundCheck.customerId=:customerId');
            $criteria->addCondition("t.informedToCustomerOn IS NOT NULL");
            $criteria->addCondition('backgroundCheck.resultId=:result');
            $criteria->with=['backgroundCheck','eventType', 'eventTypeNews'];
            $criteria->params=[':customerUsId'=>$customerId,':customerId'=>Yii::app()->user->arUser->customerId, 'result'=>'1'];
        }
        
        $DetNotificaicones= Event::model()->findAll($criteria);
        
        $notificaciones=[];
        
        foreach ($DetNotificaicones AS $not){
            $notificaciones[]=[
                'customer'=>$not->backgroundCheck->customer->name,
                'customerUser'=>$not->backgroundCheck->customerUser->username,
                'customerProduct'=>$not->backgroundCheck->customerProduct->name,
                'code'=>$not->backgroundCheck->code,
                'idNumber'=>$not->backgroundCheck->idNumber,
                'firtsName'=>$not->backgroundCheck->firstName,
                'lastName'=>$not->backgroundCheck->lastName,
                'tipo'=>$not->eventType->name,
                'tiporetraso'=>$not->eventTypeNews->name,
                'detail'=>$not->detail,
                'fecha'=>$not->informedToCustomerOn
            ];
        }
        
        return $notificaciones;
    }
    
}
